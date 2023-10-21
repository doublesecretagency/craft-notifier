<template>
    <div
        class="flex-fields"
        v-show="notificationStore.triggerType && notificationStore.eventSelected && notificationStore.messageType"
    >
        <hr>
        <div
            id="messageType-field"
            class="field"
            data-attribute="messageType"
        >
            <div class="heading">
                <label id="messageType-label" for="messageType">Recipients<span class="visually-hidden">Required</span><span class="required" aria-hidden="true"></span></label>
            </div>
            <div id="messageType-instructions" class="instructions">
                <p>Who will receive this message?</p>
            </div>
            <div class="input ltr">
                <div class="select">
                    <select v-model="notificationStore.recipientType" id="messageType" name="messageType" aria-labelledby="messageType-label">
                        <option value="">Select recipient(s)... </option>
                        <option v-for="(label, value) in notificationStore.recipientTypeOptions" :value="value">
                            {{ label }}
                        </option>
                    </select>
                </div>
            </div>
        </div>
        <div
            class="readable"
            style="margin-top:-16px !important"
            v-show="notificationStore.recipientType"
        >
            <blockquote class="note tip">
                <p v-html="recipientTypeSummary"></p>
            </blockquote>
        </div>

        <fieldset
            id="config-recipients-groups-field"
            class="field"
            data-attribute="config-recipients-groups"
            v-show="'all-users-in-groups'===notificationStore.recipientType"
        >
            <legend class="visually-hidden" data-label="Select User Group(s)">Select User Group(s)</legend>
            <div class="heading">
                <legend id="config-recipients-groups-label" aria-hidden="true">Select User Group(s)</legend>
            </div>
            <div id="config-recipients-groups-instructions" class="instructions"><p>Which user groups will receive the notification?</p></div>
            <div class="input ltr">
                <fieldset class="checkbox-select">
                    <div>
                        <input type="hidden" name="config[recipients][groups]" value="" />
                        <input type="checkbox" id="checkbox2042499779" class="all checkbox" name="config[recipients][groups]" value="*" aria-describedby="config-recipients-groups-instructions" />
                        <label for="checkbox2042499779">
                            <b>All</b>
                        </label>
                    </div>
                    <div>
                        <input type="checkbox" id="checkbox804410199" class="checkbox" name="config[recipients][groups][]" value="33" />
                        <label for="checkbox804410199">
                            Dude
                        </label>
                    </div>
                    <div>
                        <input type="checkbox" id="checkbox334697430" class="checkbox" name="config[recipients][groups][]" value="42" />
                        <label for="checkbox334697430">
                            Sweet
                        </label>
                    </div>
                </fieldset>
            </div>
        </fieldset>

        <div
            id="customRecipients-field"
            class="field"
            data-attribute="customRecipients"
            v-show="'custom-recipients'===notificationStore.recipientType"
        >
            <div class="heading">
                <label id="customRecipients-label" for="customRecipients">Custom Recipients<span class="visually-hidden">Required</span><span class="required" aria-hidden="true"></span></label>
            </div>
            <div id="customRecipients-instructions" class="instructions">
                <p>Learn more about <a href="https://plugins.doublesecretagency.com/notifier/messages/variables/" rel="noopener" target="_blank">automatic variables</a>.</p>
            </div>
            <div class="input ltr">
                <textarea
                    id="customRecipients"
                    class="code text fullwidth"
                    name="customRecipients"
                    :rows="6"
                    cols="50"
                    :placeholder="customRecipientsPlaceholder"
                    aria-describedby="customRecipients-instructions"
                ></textarea>
            </div>
        </div>

    </div>
</template>

<script>
// Import Pinia
import { mapStores } from 'pinia';
import { useNotificationStore } from '../stores/NotificationStore';

export default {
    data: () => {
        return {
            customRecipientsPlaceholder:
`{{ setRecipients([
    'alice@example.com',
    'bob@example.com'
]) }}`
        }
    },
    computed: {
        // Load Pinia store
        ...mapStores(useNotificationStore),
        recipientTypeSummary: () => {
            // Get the Pinia store
            const notificationStore = useNotificationStore();
            // Prescript
            const sendTo = `Message will be sent to`;
            // Postscript for current user
            const currentUser = `<br><br>In other words, the person who activated the trigger.`;
            // Postscript for more info on template filtering
            const templateFiltering = `<br><br>Additional filtering can be done at the template level.`;
            // Postscript for more info on custom recipients
            const customRecipients = `<br><br>See the documentation for more information.`;
            // All recipient type summaries
            const summaries = {
                'current-user':        `${sendTo} <strong>the current user when the event occurred</strong>. ${currentUser}`,
                'all-admins':          `${sendTo} <strong>all Admin Users</strong>. ${templateFiltering}`,
                'all-users':           `${sendTo} <strong>all Users in the system</strong>. ${templateFiltering}`,
                'all-users-in-groups': `${sendTo} <strong>all Users in selected User Group(s)</strong>. ${templateFiltering}`,
                'custom-recipients':   `${sendTo} <strong>a custom selection of recipients</strong>. ${customRecipients}`,
            }
            // Return the matching summary
            return summaries[notificationStore.recipientType] ?? '';
        }
    }
}
</script>
