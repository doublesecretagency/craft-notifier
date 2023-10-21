<template>
    <div
        class="flex-fields"
        v-show="notificationStore.triggerType && notificationStore.eventSelected && notificationStore.messageType && notificationStore.recipientType"
    >
        <hr>
        <p>Save the notification before submitting a test message!</p>
        <div class="buttons">
            <input
                type="button"
                class="btn submit"
                value="Send a test message..."
                @click="notificationStore.testNotification()"
            >
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

<style lang="scss" scoped>
.buttons {
    display: block;
    text-align: center;
    input {
        font-size: 15px;
        margin-top: 12px;
        margin-bottom: 18px;
        padding: 7px 20px 9px;
    }
}
</style>
