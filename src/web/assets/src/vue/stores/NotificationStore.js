import { ref, computed } from 'vue';
import { defineStore } from 'pinia';

export const useNotificationStore = defineStore('notification', () => {

    // ========================================================================= //
    // State

    // Initialize options
    const eventTypeOptions = ref({});
    const messageTypeOptions = ref({});
    const flashTypeOptions = ref({});
    const recipientsTypeOptions = ref({});

    // Initialize data
    const eventType = ref('');
    const eventSelected = ref('');
    const eventConfig = ref({});
    const messageType = ref('');
    const messageConfig = ref({});
    const messageBody = ref('');
    const recipientsType = ref('');
    const recipientsConfig = ref({});

    // ========================================================================= //
    // Getters

    /**
     * Get label of the current event type.
     */
    const event = computed(() => {
        // Return label of the currently selected event type
        return eventTypeOptions.value[eventType.value] ?? null;
    });

    /**
     * Get list of events based on the current event type.
     */
    const eventOptions = computed(() => {
        // Get all events
        const allEvents = window.notificationOptions['allEvents'] ?? null;
        // Return events of currently selected event type
        return allEvents[eventType.value] ?? null;
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

    // Populate options based on PHP data
    eventTypeOptions.value      = window.notificationOptions['eventType']      ?? null;
    messageTypeOptions.value    = window.notificationOptions['messageType']    ?? null;
    flashTypeOptions.value      = window.notificationOptions['flashType']      ?? null;
    recipientsTypeOptions.value = window.notificationOptions['recipientsType'] ?? null;

    // Populate values from existing element data
    eventType.value        = window.notificationData['eventType']        ?? null;
    eventSelected.value    = window.notificationData['eventSelected']    ?? null;
    eventConfig.value      = window.notificationData['eventConfig']      ?? null;
    messageType.value      = window.notificationData['messageType']      ?? null;
    messageConfig.value    = window.notificationData['messageConfig']    ?? null;
    messageBody.value      = window.notificationData['messageBody']      ?? null;
    recipientsType.value   = window.notificationData['recipientsType']   ?? null;
    recipientsConfig.value = window.notificationData['recipientsConfig'] ?? null;

    // Return reactive values
    return {
        // State: Options
        eventTypeOptions,
        messageTypeOptions,
        flashTypeOptions,
        recipientsTypeOptions,
        // State: Data
        eventType,
        eventSelected,
        eventConfig,
        messageType,
        messageConfig,
        messageBody,
        recipientsType,
        recipientsConfig,

        // Getters
        event,
        eventOptions,

        // Actions
        testNotification,
    }

})
