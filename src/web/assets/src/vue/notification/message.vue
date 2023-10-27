<template>
    <div
        class="flex-fields"
        v-show="notificationStore.eventType && notificationStore.eventSelected"
    >
        <hr>
        <div
            id="messageType-field"
            class="field"
            data-attribute="messageType"
        >
            <div class="heading">
                <label id="messageType-label" for="messageType">Message Type<span class="visually-hidden">Required</span><span class="required" aria-hidden="true"></span></label>
            </div>
            <div id="messageType-instructions" class="instructions">
                <p>Select what type of message will be sent.</p>
            </div>
            <div class="input ltr">
                <div class="select">
                    <select v-model="notificationStore.messageType" id="messageType" name="messageType" aria-labelledby="messageType-label">
                        <option value=""></option>
                        <option v-for="(label, value) in notificationStore.messageTypeOptions" :value="value">
                            {{ label }}
                        </option>
                    </select>
                </div>
            </div>
        </div>

        <div
            id="messageConfig-emailSubject-field"
            class="field width-100"
            data-attribute="messageConfig-emailSubject"
            v-show="'email' === notificationStore.messageType"
        >
            <div class="heading">
                <label id="messageConfig-emailSubject-label" for="messageConfig-emailSubject">Email Subject<span class="visually-hidden">Required</span><span class="required" aria-hidden="true"></span></label>
                <div class="flex-grow"></div>
            </div>
            <div class="input ltr">
                <input
                    type="text"
                    v-model="notificationStore.messageConfig.emailSubject"
                    id="messageConfig-emailSubject"
                    class="nicetext text fullwidth"
                    name="messageConfig[emailSubject]"
                    autocomplete="off"
                    dir="ltr"
                />
            </div>
        </div>

        <div
            id="messageConfig-announcementTitle-field"
            class="field width-100"
            data-attribute="messageConfig-announcementTitle"
            v-show="'announcement' === notificationStore.messageType"
        >
            <div class="heading">
                <label id="messageConfig-announcementTitle-label" for="messageConfig-announcementTitle">Announcement Title<span class="visually-hidden">Required</span><span class="required" aria-hidden="true"></span></label>
                <div class="flex-grow"></div>
            </div>
            <div class="input ltr">
                <input
                    type="text"
                    v-model="notificationStore.messageConfig.announcementTitle"
                    id="messageConfig-announcementTitle"
                    class="nicetext text fullwidth"
                    name="messageConfig[announcementTitle]"
                    autocomplete="off"
                    dir="ltr"
                />
            </div>
        </div>

        <div
            id="messageConfig-flashType-field"
            class="field width-100"
            data-attribute="messageConfig-flashType"
            v-show="'flash' === notificationStore.messageType"
        >
            <div class="heading">
                <label id="messageConfig-flashType-label" for="messageConfig-flashType">Flash Message Type<span class="visually-hidden">Required</span><span class="required" aria-hidden="true"></span></label>
                <div class="flex-grow"></div>
            </div>
            <div class="input ltr">
                <div class="select">
                    <select v-model="notificationStore.messageConfig.flashType" id="messageConfig-flashType" name="messageConfig[flashType]" aria-labelledby="messageConfig-flashType-label">
                        <option v-for="(label, value) in notificationStore.flashTypeOptions" :value="value">
                            {{ flashIcon(value) }}&nbsp; {{ label }}
                        </option>
                    </select>
                </div>
            </div>
        </div>

        <div
            id="messageBody-field"
            class="field"
            data-attribute="messageBody"
            v-show="notificationStore.messageType"
        >
            <div class="heading">
                <label id="messageBody-label" for="messageBody">Message Body<span class="visually-hidden">Required</span><span class="required" aria-hidden="true"></span></label>
            </div>
            <div id="messageBody-instructions" class="instructions">
                <p>Learn more about <a href="https://plugins.doublesecretagency.com/notifier/messages/variables/" rel="noopener" target="_blank">automatic variables</a>.</p>
            </div>
            <div class="input ltr">
                <textarea
                    id="messageBody"
                    class="code text fullwidth"
                    name="messageBody"
                    :rows="messageBodySize"
                    cols="50"
                    placeholder="{% include 'path/to/template' %}"
                    aria-describedby="messageBody-instructions"
                >{{ notificationStore.messageBody }}</textarea>
            </div>
        </div>
        <div
            class="readable"
            style="margin-top:-18px !important"
            v-show="'email' === notificationStore.messageType"
        >
            <blockquote class="note tip">
                <p><strong>Need to write a longer message?</strong> You can <code>{% include %}</code> a separate Twig template to make the message as long as desired.</p>
            </blockquote>
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
        ...mapStores(useNotificationStore),
        messageBodySize: () => {
            // Get the Pinia store
            const notificationStore = useNotificationStore();
            // Determine size of message body field
            // based on the current message type
            switch (notificationStore.messageType) {
                case 'email':        return 6;
                case 'sms':          return 3;
                case 'announcement': return 3;
                case 'flash':        return 2;
                default:             return 4;
            }
        }
    },
    methods: {
        flashIcon: (type) => {
            // Return the icon for each flash type
            switch (type) {
                case 'success': return '✅';
                case 'notice':  return '💡';
                case 'error':   return '❌';
                default:        return '';
            }
        }
    }
}
</script>
