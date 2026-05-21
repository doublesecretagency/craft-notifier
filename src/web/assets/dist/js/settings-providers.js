/**
 * Notifier - Settings Providers
 *
 * Injects a dedicated Test-button cell into each row of the ntfy / Slack /
 * Bluesky editableTables, and wires up the click handler that calls the
 * corresponding test action.
 *
 * Uses a MutationObserver so newly-added rows (via "+ Add") also get the
 * Test cell automatically.
 */
(function () {
    'use strict';

    var TABLES = {
        ntfyTopics:      'ntfy',
        slackChannels:   'slack',
        blueskyAccounts: 'bluesky'
    };

    document.addEventListener('DOMContentLoaded', function () {
        Object.keys(TABLES).forEach(function (tableId) {
            var table = document.getElementById(tableId);
            if (!table) {
                return;
            }
            injectHeaderCell(table);
            table.querySelectorAll('tbody tr').forEach(function (row) {
                injectTestCell(row, TABLES[tableId]);
            });
            // Watch for new rows added via "+ Add" so they get the cell too
            new MutationObserver(function (mutations) {
                mutations.forEach(function (m) {
                    m.addedNodes.forEach(function (node) {
                        if (node.nodeType === 1 && node.tagName === 'TR') {
                            injectTestCell(node, TABLES[tableId]);
                        }
                    });
                });
            }).observe(table.querySelector('tbody') || table, { childList: true });
        });
    });

    /**
     * Insert a blank <th> header cell aligned with the Test column.
     * The action column header in Craft's editableTable uses colspan=2 to
     * cover the reorder + delete cells; the Test column sits before it.
     */
    function injectHeaderCell(table) {
        var headerRow = table.querySelector('thead tr');
        if (!headerRow || headerRow.querySelector('.notifier-test-th')) {
            return;
        }
        // Find the action group header (the colspan="2" cell labeled "Row actions")
        var actionTh = Array.from(headerRow.children).find(function (th) {
            return th.getAttribute('scope') === 'colgroup'
                || th.hasAttribute('colspan');
        });
        var th = document.createElement('th');
        th.className = 'notifier-test-th';
        th.scope = 'col';
        if (actionTh) {
            headerRow.insertBefore(th, actionTh);
        } else {
            headerRow.appendChild(th);
        }
    }

    /**
     * Insert a `<td>` containing the Test button before the first `td.action`
     * in the row, so the button sits in its own column to the left of the
     * row's structural actions (reorder, menu, delete).
     */
    function injectTestCell(row, provider) {
        if (row.querySelector('[data-notifier-test]')) {
            return;
        }
        var firstActionCell = row.querySelector('td.action');
        if (!firstActionCell) {
            return;
        }
        // Intentionally NOT using the `action` class - Craft's
        // `table.editable td.action button { width: var(--touch-target-size) }`
        // rule would force the Test button into a 24px icon-sized square.
        var td = document.createElement('td');
        td.className = 'thin notifier-test-cell';
        var btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'btn';
        btn.dataset.notifierTest = provider;
        btn.textContent = Craft.t('notifier', 'Test');
        td.appendChild(btn);
        row.insertBefore(td, firstActionCell);
    }

    // Handle clicks on any Test button across the settings sub-pages
    document.addEventListener('click', function (event) {
        var btn = event.target.closest('[data-notifier-test]');
        if (!btn) {
            return;
        }
        event.preventDefault();

        var provider = btn.dataset.notifierTest;
        var row = btn.closest('tr');
        if (!row) {
            return;
        }

        var payload = collectRowPayload(provider, row);
        if (!payload) {
            return;
        }

        var originalLabel = btn.textContent;
        btn.disabled = true;
        btn.textContent = Craft.t('notifier', 'Sending…');

        Craft.sendActionRequest('POST', 'notifier/settings-providers/test-' + provider, {
            data: payload
        }).then(function (response) {
            var data = response.data || {};
            if (data.success) {
                Craft.cp.displaySuccess(data.message || Craft.t('notifier', 'Test message sent successfully.'));
            } else {
                Craft.cp.displayError(data.message || Craft.t('notifier', 'Test failed.'));
            }
        }).catch(function (e) {
            var msg = (e && e.response && e.response.data && e.response.data.message)
                ? e.response.data.message
                : Craft.t('notifier', 'Test failed.');
            Craft.cp.displayError(msg);
        }).finally(function () {
            btn.disabled = false;
            btn.textContent = originalLabel;
        });
    });

    function collectRowPayload(provider, row) {
        if ('ntfy' === provider) {
            return { topic: readInputValue(row, '[topic]'), uid: readInputValue(row, '[uid]') };
        }
        if ('slack' === provider) {
            return {
                botToken: readInputValue(row, '[botToken]'),
                channelId: readInputValue(row, '[channelId]'),
                uid: readInputValue(row, '[uid]')
            };
        }
        if ('bluesky' === provider) {
            return {
                handle: readInputValue(row, '[handle]'),
                appPassword: readInputValue(row, '[appPassword]'),
                uid: readInputValue(row, '[uid]')
            };
        }
        return null;
    }

    function readInputValue(row, nameSuffix) {
        var input = row.querySelector(
            'input[name*="' + nameSuffix + '"], ' +
            'textarea[name*="' + nameSuffix + '"], ' +
            'select[name*="' + nameSuffix + '"]'
        );
        return input ? input.value : '';
    }

})();
