/**
 * Open envelope details.
 *
 * @param envelopeId
 */
window.openDetails = function (envelopeId) {
    $(`#details-${envelopeId}`).slideToggle();
}

/**
 * Open notification configuration.
 *
 * @param notificationId
 */
window.openConfig = function (notificationId) {

    // Make AJAX call to delete envelope
    Craft.postActionRequest('notifier/log/get-notification', {notificationId: notificationId}, function(response, textStatus) {

        // If error occurred, display it and bail
        if (textStatus !== 'success') {
            Craft.cp.displayError(Craft.t('notifier', 'Unable to get the notification, something went wrong.'));
            return;
        }

        // If error occurred, display it and bail
        if (!(response.success || null)) {
            Craft.cp.displayError(response.message || Craft.t('notifier', 'Something went wrong.'));
            return;
        }

        // Get notification
        let notification = response.notification;

        // If error occurred, display it and bail
        if (!notification) {
            Craft.cp.displayError(Craft.t('notifier', 'Invalid notification ID.'));
            return;
        }

        // Set element type
        let elementType = "doublesecretagency\\notifier\\elements\\Notification";

        // Open slideout editor
        Craft.createElementEditor(elementType, {
            siteId: notification.siteId,
            elementId: notification.id,
            draftId: notification.draftId,
            params: {
                fresh: 1,
            },
        });

    });

}

/**
 * Delete specified envelope.
 *
 * @param envelopeId
 */
window.deleteEnvelope = function (envelopeId) {

    // Warning message prior to deletion
    const warning = 'Are you sure you want to delete this log event?';

    // If deletion is not confirmed, do nothing
    if (!confirm(Craft.t('notifier', warning))) {
        return;
    }

    // Make AJAX call to delete envelope
    Craft.postActionRequest('notifier/log/delete', {envelopeId: envelopeId}, function(response, textStatus) {

        // If error occurred, display it and bail
        if (textStatus !== 'success') {
            Craft.cp.displayError(Craft.t('notifier', 'Unable to delete the log event, something went wrong.'));
            return;
        }

        // If error occurred, display it and bail
        if (!(response.success || null)) {
            Craft.cp.displayError(response.message || Craft.t('notifier', 'Something went wrong.'));
            return;
        }

        // Hide deleted envelope
        $(`#envelope-${envelopeId}`).slideUp(400, () => {
            // If no envelopes remain
            if (!$('.envelope').filter(':visible').length) {
                // Reload the page
                window.location.reload();
            }
        });

        // Display success message
        Craft.cp.displaySuccess(Craft.t('notifier', 'Log event deleted.'));

    });

}

/**
 * Delete all logs on specified day.
 *
 * @param date
 */
window.deleteDay = function (date) {

    // Warning message prior to deletion
    const warning = `Are you sure you want to delete all logs from ${date}?`;

    // If deletion is not confirmed, do nothing
    if (!confirm(warning)) {
        return;
    }

    // Make AJAX call to delete all logs on specified day
    Craft.postActionRequest('notifier/log/delete-day', {date: date}, function(response, textStatus) {

        // If error occurred, display it and bail
        if (textStatus !== 'success') {
            Craft.cp.displayError(Craft.t('notifier', 'Unable to delete log events, something went wrong.'));
            return;
        }

        // Reload the page
        window.location.reload();

    });

}
