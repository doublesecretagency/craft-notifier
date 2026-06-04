/**
 * Send a report-type notification (System Snapshot, Dynamic Data) on demand.
 *
 * Bound via event delegation so the handler still works after htmx swaps,
 * slideout editors, or any other late-mounted DOM. The button declares its
 * notification id and pre-translated confirm text via data- attributes.
 */
(function () {

    // Bind once at document level
    document.addEventListener('click', function (event) {

        // Walk up to the nearest send-report button
        const btn = event.target.closest('[data-notifier-send-id]');

        // If the click wasn't on the button, do nothing
        if (!btn) {
            return;
        }

        // Read the notification id and the pre-translated confirm message.
        // Translate any literal \n sequences (Twig single-quoted strings don't
        // interpret escapes) into real newlines before passing to confirm().
        const notificationId = parseInt(btn.dataset.notifierSendId, 10);
        const confirmMsg = (btn.dataset.notifierSendConfirm || '').replace(/\\n/g, '\n');

        // If the operator cancels the confirm dialog, do nothing
        if (!confirm(confirmMsg)) {
            return;
        }

        // Make AJAX call to send the report
        Craft.postActionRequest('notifier/notifications/send-report', {notificationId: notificationId}, function (response, textStatus) {

            // If transport-level failure, display generic error
            if (textStatus !== 'success') {
                Craft.cp.displayError(Craft.t('notifier', 'Notification was not sent. Check the Notification Log for details.'));
                return;
            }

            // If the dispatch returned a soft failure, surface its message
            if (!(response.success || null)) {
                Craft.cp.displayError(response.message || Craft.t('notifier', 'Notification was not sent. Check the Notification Log for details.'));
                return;
            }

            // Display the success message returned by the controller
            Craft.cp.displaySuccess(response.message);

        });

    });

})();
