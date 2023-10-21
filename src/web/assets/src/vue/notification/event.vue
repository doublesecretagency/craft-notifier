<template>
    <div
        class="flex-fields"
        v-show="notificationStore.triggerType"
    >
        <hr style="margin-top:0 !important">
        <div id="event-field" class="field" data-attribute="event">
            <div class="heading">
                <label id="event-label" for="event">{{ notificationStore.trigger }} Trigger<span class="visually-hidden">Required</span><span class="required" aria-hidden="true"></span></label>
            </div>
            <div id="event-instructions" class="instructions">
                <p>Which event will activate the notification?</p>
            </div>
            <div class="input ltr">
                <div class="select">
                    <select
                        v-model="notificationStore.eventSelected"
                        id="event"
                        name="event"
                        aria-describedby="event-instructions"
                        aria-labelledby="event-label"
                    >
                        <option value="">Select a trigger event... </option>
                        <option v-for="option in notificationStore.eventOptions" :value="option.value">
                            {{ option.label }}
                        </option>
                    </select>
                </div>
            </div>
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
    }
}
</script>
