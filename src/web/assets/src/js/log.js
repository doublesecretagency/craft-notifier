/**
 * Open envelope details.
 *
 * @param id
 */
window.openDetails = function (id) {
    $(`#details-${id}`).slideToggle();
}

/**
 * Delete specified envelope.
 *
 * @param id
 */
window.deleteEnvelope = function (id) {

    // Warning message prior to deletion
    const warning = 'Are you sure you want to delete this log event?';

    // If deletion is not confirmed, do nothing
    if (!confirm(Craft.t('notifier', warning))) {
        return;
    }

    // Make AJAX call to delete envelope
    Craft.postActionRequest('notifier/log/delete', {id: id}, function(response, textStatus) {

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
        $(`#envelope-${id}`).slideUp(400, () => {
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
