/**
 * Send a test of the configured notification.
 *
 * Bound via event delegation so the handler still works after htmx swaps,
 * slideout editors, or any other late-mounted DOM. The button declares
 * its notification id and pre-translated confirm text via data- attributes.
 */
(function () {

    // Bind once at document level
    document.addEventListener('click', function (event) {

        // Walk up to the nearest test-notification button
        const btn = event.target.closest('[data-notifier-test-id]');

        // If the click wasn't on the button, do nothing
        if (!btn) {
            return;
        }

        // Read the notification id and the pre-translated confirm message.
        // Translate any literal \n sequences (Twig single-quoted strings don't
        // interpret escapes) into real newlines before passing to confirm().
        const notificationId = parseInt(btn.dataset.notifierTestId, 10);
        const confirmMsg = (btn.dataset.notifierTestConfirm || '').replace(/\\n/g, '\n');

        // If the operator cancels the confirm dialog, do nothing
        if (!confirm(confirmMsg)) {
            return;
        }

        // Make AJAX call to dispatch the test
        Craft.postActionRequest('notifier/notifications/test', {notificationId: notificationId}, function (response, textStatus) {

            // If transport-level failure, display generic error
            if (textStatus !== 'success') {
                Craft.cp.displayError(Craft.t('notifier', 'Test notification failed.'));
                return;
            }

            // If the dispatch returned a soft failure, surface its message
            if (!(response.success || null)) {
                Craft.cp.displayError(response.message || Craft.t('notifier', 'Test notification failed.'));
                return;
            }

            // Display the success message returned by the controller
            Craft.cp.displaySuccess(response.message);

        });

    });

})();
