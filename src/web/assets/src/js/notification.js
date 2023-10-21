// Import Vue components
import { createApp } from 'vue';
import { createPinia } from 'pinia';

import TriggerType from '../vue/notification/trigger-type';
import Event from '../vue/notification/event';
import Message from '../vue/notification/message';
import Recipients from '../vue/notification/recipients';
import TestButtonTop from '../vue/notification/test-button-top';
import TestButtonBottom from '../vue/notification/test-button-bottom';

// Initialize Vue instance
window.initNotification = () => {

    // Get instance of Pinia
    const pinia = createPinia();

    // Trigger type management
    createApp(TriggerType)
        .use(pinia)
        .mount("#triggerType-field");

    // Event management
    createApp(Event)
        .use(pinia)
        .mount("#notification-event");

    // Message management
    createApp(Message)
        .use(pinia)
        .mount("#notification-message");

    // Recipients management
    createApp(Recipients)
        .use(pinia)
        .mount("#notification-recipients");

    // Test button (top)
    createApp(TestButtonTop)
        .use(pinia)
        .mount("#notification-test-button-top");

    // Test button (bottom)
    createApp(TestButtonBottom)
        .use(pinia)
        .mount("#notification-test-button-bottom");

}
