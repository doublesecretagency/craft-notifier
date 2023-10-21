<template>
    <div class="heading"><label id="triggerType-label" for="triggerType">Triggered By</label></div>
    <div class="input ltr">
        <div class="selectize select">
            <select
                v-model="notificationStore.triggerType"
                id="triggerType"
                name="triggerType"
                aria-labelledby="triggerType-label"
                @change="notificationStore.eventSelected=''"
            >
                <option value=""></option>
                <option v-for="(label, value) in notificationStore.triggerTypeOptions" :value="value">
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
        'notificationStore.trigger'() {
            // Highlight field when value changes
            this.highlightTriggerType();
        }
    },
    created: function () {
        // Highlight field when page is loaded
        this.highlightTriggerType();
    },
    methods: {
        // Highlight the Trigger Type field
        // if no value has been selected
        highlightTriggerType: function () {
            // Get the Pinia store
            const notificationStore = useNotificationStore();
            // Get class list of the Trigger Type field container
            const classList = document.getElementById('triggerType-field').classList;
            // Whether a Trigger Type was selected
            notificationStore.triggerType
                ? classList.remove('highlight-trigger-types')
                : classList.add('highlight-trigger-types');
        }
    }
}
</script>

<style lang="scss">
/*
 * When no Trigger Type has been selected,
 * highlight the field.
 */
#triggerType-field.highlight-trigger-types {
    background-color: #fff3c4;
}
</style>
