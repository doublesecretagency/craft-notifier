<template>
    <div class="heading"><label id="eventType-label" for="eventType">Event Type</label></div>
    <div class="input ltr">
        <div class="selectize select">
            <select
                v-model="notificationStore.eventType"
                id="eventType"
                name="eventType"
                aria-labelledby="eventType-label"
                @change="notificationStore.eventSelected=''"
            >
                <option value=""></option>
                <option v-for="(label, value) in notificationStore.eventTypeOptions" :value="value">
                    {{ label }}
                </option>
            </select>
        </div>
    </div>
</template>

<script>
// Import Pinia
import { mapStores } from 'pinia';
import { useNotificationStore } from '../stores/NotificationStore';

export default {
    computed: {
        // Load Pinia store
        ...mapStores(useNotificationStore)
    },
    watch: {
        'notificationStore.eventType'() {
            // When the Event Type is changed,
            // highlight Event Type if no value is selected
            this.highlightEventType();
        }
    },
    created: function () {
        // On page load,
        // highlight Event Type if no value is selected
        this.highlightEventType();
    },
    methods: {
        // Highlight the Event Type field
        // if no value has been selected
        highlightEventType: function () {
            // Get the Pinia store
            const notificationStore = useNotificationStore();
            // Get class list of the Event Type field container
            const classList = document.getElementById('eventType-field').classList;
            // Whether a Event Type was selected
            notificationStore.eventType
                ? classList.remove('highlight-event-type')
                : classList.add('highlight-event-type');
        }
    }
}
</script>

<style lang="scss">
/*
 * When no Event Type has been selected,
 * highlight the field.
 */
#eventType-field.highlight-event-type {
    background-color: #fff3c4;
}
</style>
