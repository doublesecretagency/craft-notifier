import { ref, computed } from 'vue';
import { defineStore } from 'pinia';

export const useNotificationStore = defineStore('notification', () => {

    // ========================================================================= //
    // State

    // Current trigger type
    const triggerType = ref('');

    // Available trigger types
    const triggerTypeOptions = ref({
        entries: 'Entries',
        assets:  'Assets',
        users:   'Users',
    });

    // Currently selected event
    const eventSelected = ref('');

    // Available events for all trigger types
    const eventOptionsAll = ref({
        entries: [
            {
                label: 'When an entry is fully saved and propagated',
                value: 'craft\\elements\\Entry::EVENT_AFTER_PROPAGATE'
            }
        ],
        assets: [
            {
                label: 'When a file is uploaded',
                value: 'upload'
            }
        ],
        users: [
            {
                label: 'When a new user is added',
                value: 'new-user'
            }
        ]
    });

    // Current message type
    const messageType = ref('');

    // Available message types
    const messageTypeOptions = ref({
        email:        'Email',
        sms:          'SMS (Text Message)',
        announcement: 'Announcement',
        flash:        'Flash Message',
    });

    // Current flash message type
    const flashType = ref('notice');

    // Available flash message types
    const flashTypeOptions = ref({
        success: 'Success',
        notice:  'Notice',
        error:   'Error',
    });

    // Current recipient type
    const recipientType = ref('');

    // Available recipient types
    const recipientTypeOptions = ref({
        'current-user':        'Current User',
        'all-admins':          'All Admins',
        'all-users':           'All Users',
        'all-users-in-groups': 'All Users in Group(s)',
        'custom-recipients':   'Custom Recipients',
    });

    // ========================================================================= //
    // Getters

    /**
     * Get label of the current trigger type.
     */
    const trigger = computed(() => {
        return triggerTypeOptions.value[triggerType.value];
    });

    /**
     * Get list of events based on the current trigger type.
     */
    const eventOptions = computed(() => {
        return eventOptionsAll.value[triggerType.value];
    });

    // ========================================================================= //
    // Actions

    /**
     * Send a test notification.
     */
    function testNotification()
    {
        alert('Provide dummy variable data like Formie (?) does.');
    }

    // ========================================================================= //

    // Return reactive values
    return {
        // State
        triggerType,
        triggerTypeOptions,
        eventSelected,
        messageType,
        messageTypeOptions,
        flashType,
        flashTypeOptions,
        recipientType,
        recipientTypeOptions,

        // Getters
        trigger,
        eventOptions,

        // Actions
        testNotification,
    }

})
