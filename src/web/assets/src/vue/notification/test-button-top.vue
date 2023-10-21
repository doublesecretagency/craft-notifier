<template>
    <input
        type="button"
        class="btn"
        value="Send Test Message"
        @click="notificationStore.testNotification()"
    >
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
