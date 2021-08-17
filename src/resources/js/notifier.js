/**
 * Initialize Vue-based trigger block.
 *
 * @param id
 */
function triggerBlock(id) {
    new Vue({
        el: '#trigger-'+id,
        delimiters: ['[[', ']]'],
        data: {
            'expanded': false
        },
        methods: {
            deleteTrigger(id) {
                // Get container block
                const $block = this.$el;
                // Warning message prior to deletion
                const warning = 'Are you sure you want to delete this trigger? Please be aware, this will also delete all corresponding messages.';
                // If deletion is confirmed
                if (confirm(Craft.t('notifier', warning))) {
                    // Make AJAX call to delete trigger
                    Craft.postActionRequest('notifier/trigger/delete', {id: id}, function(response, textStatus) {
                        // If error occurred, display it and bail
                        if (textStatus !== 'success') {
                            Craft.cp.displayError(Craft.t('notifier', 'Unable to delete the trigger, something went wrong.'));
                            return;
                        }
                        // Delete all trigger messages
                        $($block).next('.trigger-messages').remove();
                        // Delete trigger block
                        $block.remove();
                        // Display success message
                        Craft.cp.displayNotice(Craft.t('notifier', 'Trigger deleted.'));
                        // If no more notification blocks are visible
                        if (0 === $('.notifier-block').length) {
                            // Reload the page
                            window.location.reload();
                        }
                    });
                }
            }
        }
    });
}

/**
 * Initialize Vue-based message block.
 *
 * @param id
 */
function messageBlock(id) {
    new Vue({
        el: '#message-'+id,
        delimiters: ['[[', ']]'],
        data: {
            'expanded': false
        },
        methods: {
            deleteMessage(id) {
                // Get container block
                const $block = this.$el;
                // Warning message prior to deletion
                const warning = 'Are you sure you want to delete this message?';
                // If deletion is confirmed
                if (confirm(Craft.t('notifier', warning))) {
                    // Make AJAX call to delete message
                    Craft.postActionRequest('notifier/message/delete', {id: id}, function(response, textStatus) {
                        // If error occurred, display it and bail
                        if (textStatus !== 'success') {
                            Craft.cp.displayError(Craft.t('notifier', 'Unable to delete the message, something went wrong.'));
                            return;
                        }
                        // Delete message block
                        $block.remove();
                        // Display success message
                        Craft.cp.displayNotice(Craft.t('notifier', 'Message deleted.'));
                    });
                }
            }
        }
    });
}
