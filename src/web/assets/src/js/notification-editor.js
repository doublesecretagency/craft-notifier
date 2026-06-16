// Notification edit screen behavior: keep Monaco editors correct across the
// read-only fieldset and the tab/toggle show-hide that Craft applies. Monaco is
// JS-driven, so it ignores both the parent <fieldset disabled> and the CSS that
// hides inactive wrappers, and needs nudging in code.
(function () {

    // Flip every Monaco editor to read-only mode
    const flipMonacoToReadOnly = () => {
        if (!window.monacoEditorInstances) {
            return;
        }
        Object.keys(window.monacoEditorInstances).forEach((editorId) => {
            const instance = window.monacoEditorInstances[editorId];
            if (instance && typeof instance.updateOptions === 'function') {
                instance.updateOptions({readOnly: true});
            }
        });
    };

    // Wrappers that can contain a Monaco editor and start hidden
    const wrapperSelectors = [
        '#event',
        '#message',
        '#recipients',
        '.event-type-dynamic-data',
        '.message-type-email',
        '.message-type-announcement',
        '.message-type-flash',
        '.message-type-sms',
        '.message-type-pushover',
        '.message-type-ntfy',
        '.message-type-slack',
        '.message-type-discord',
        '.message-type-facebook',
        '.message-type-instagram',
        '.message-type-x-twitter',
        '.message-type-bluesky',
        '.message-type-mastodon',
        '.message-type-mqtt',
        '.recipients-type-dynamic-recipients'
    ];

    // Re-layout the Monaco editors inside a now-visible wrapper
    const refreshMonacoInside = (wrap) => {
        if (!window.monacoEditorInstances) {
            return;
        }
        Object.keys(window.monacoEditorInstances).forEach((editorId) => {
            const container = document.getElementById(editorId + '-monaco-editor');
            if (!container || !wrap.contains(container)) {
                return;
            }
            const instance = window.monacoEditorInstances[editorId];
            if (!instance) {
                return;
            }

            // Clear stale inline dimensions from the hidden-init pass so Monaco
            // re-measures fresh against the now-visible container
            container.style.width = '';
            container.style.height = '';
            instance.layout();

            // The CodeEditor package's internal updateHeight() is wired only to
            // Monaco's `onDidContentSizeChange`, a viewport-only layout() call
            // doesn't fire it, so the inflated height from the hidden-init pass
            // (~rows+2) would stick until the user's first keystroke. Normalize
            // it manually: cap to max(textarea.rows × lineHeight, contentHeight).
            const textArea = document.getElementById(editorId);
            if (textArea && textArea instanceof HTMLTextAreaElement && textArea.rows > 0) {
                // Read the rendered line height from Monaco's own view-line element
                // (Monaco applies CSS line-height based on computed font metrics)
                const viewLine = container.querySelector('.view-line');
                const lineHeight = viewLine
                    ? parseFloat(window.getComputedStyle(viewLine).lineHeight)
                    : 19;
                const minHeight = textArea.rows * lineHeight;
                const contentHeight = instance.getContentHeight();
                const target = Math.max(minHeight, contentHeight);
                container.style.height = target + 'px';
                instance.layout({
                    width: instance.getLayoutInfo().width,
                    height: target
                });
            }
        });
    };

    // Double-tap refresh: first pass after the class-flip settles,
    // second pass after any follow-up layout/CSS-transition pass completes
    const scheduleRefresh = (wrap) => {
        window.setTimeout(() => refreshMonacoInside(wrap), 50);
        window.setTimeout(() => refreshMonacoInside(wrap), 300);
    };

    // Toggle the sidebar "Use Queue" control vs. a per-type note based on the
    // selected message type. Flash and Announcement route around the queue in
    // PHP, so the toggle is hidden and an explanatory note is shown instead.
    // The saved value is left untouched, so switching back restores it.
    const setupQueueControl = () => {
        const messageType = document.getElementById('messageType');
        const queueEl = document.getElementById('queue');
        if (!messageType || !queueEl) {
            return;
        }
        const queueField = queueEl.closest('.field');
        const notes = document.querySelectorAll('.notifier-queue-note');
        const sync = () => {
            const value = messageType.value;
            const routed = ('flash' === value || 'announcement' === value);
            queueField.style.display = routed ? 'none' : '';
            notes.forEach((note) => {
                note.style.display = (note.dataset.messageType === value) ? '' : 'none';
            });
        };
        messageType.addEventListener('change', sync);
        sync();
    };

    // Wire up the page
    const init = () => {

        // Wire the sidebar "Use Queue" control to the message type select
        setupQueueControl();

        // If the form rendered read-only, flip Monaco to read-only too
        // (the fieldset can't reach Monaco, so detect the state from its class)
        if (document.querySelector('.notifier-edit-fieldset--readonly')) {
            // First pass after page load, second pass after Monaco's deferred init
            window.setTimeout(flipMonacoToReadOnly, 100);
            window.setTimeout(flipMonacoToReadOnly, 600);
        }

        // Watch every Monaco wrapper for show-hide and re-layout on reveal
        wrapperSelectors.forEach((selector) => {
            const wrap = document.querySelector(selector);
            if (!wrap) {
                return;
            }
            // Fire when the wrapper's class list changes (Craft's tab/toggle JS adds/removes `hidden`)
            const observer = new MutationObserver((mutations) => {
                for (let i = 0; i < mutations.length; i++) {
                    if (mutations[i].attributeName === 'class' && !wrap.classList.contains('hidden')) {
                        scheduleRefresh(wrap);
                        return;
                    }
                }
            });
            observer.observe(wrap, {attributes: true, attributeFilter: ['class']});
            // Also refresh on initial load for any wrapper that starts visible
            // (e.g. editing a saved notification whose type matches this wrapper)
            if (!wrap.classList.contains('hidden')) {
                scheduleRefresh(wrap);
            }
        });

    };

    // Run once the DOM is ready
    if ('loading' === document.readyState) {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
