<template>
    <div
        class="flex-fields"
        v-show="notificationStore.eventType && notificationStore.eventSelected && notificationStore.messageType"
    >
        <hr>
        <div
            id="recipientsType-field"
            class="field"
            data-attribute="recipientsType"
        >
            <div class="heading">
                <label id="recipientsType-label" for="recipientsType">Recipients<span class="visually-hidden">Required</span><span class="required" aria-hidden="true"></span></label>
            </div>
            <div id="recipientsType-instructions" class="instructions">
                <p>Who will receive this message?</p>
            </div>
            <div class="input ltr">
                <div class="select">
                    <select v-model="notificationStore.recipientsType" id="recipientsType" name="recipientsType" aria-labelledby="recipientsType-label">
                        <option value=""></option>
                        <option v-for="(label, value) in notificationStore.recipientsTypeOptions" :value="value">
                            {{ label }}
                        </option>
                    </select>
                </div>
            </div>
        </div>
<!--        <div-->
<!--            class="readable"-->
<!--            style="margin-top:-16px !important"-->
<!--            v-show="notificationStore.recipientsType"-->
<!--        >-->
<!--            <blockquote class="note tip">-->
<!--                <p v-html="recipientsTypeSummary"></p>-->
<!--            </blockquote>-->
<!--        </div>-->

        <fieldset
            id="recipientsConfig-selectedUserGroups-field"
            class="field"
            data-attribute="recipientsConfig-selectedUserGroups"
            v-show="'all-users-in-groups'===notificationStore.recipientsType"
        >
            <legend class="visually-hidden" data-label="Select User Group(s)">Select User Group(s)</legend>
            <div class="heading">
                <legend id="recipientsConfig-selectedUserGroups-label" aria-hidden="true">Select User Group(s)</legend>
            </div>
            <div id="recipientsConfig-selectedUserGroups-instructions" class="instructions"><p>Which user groups will receive the notification?</p></div>
            <div class="input ltr">
                <fieldset class="checkbox-select">
                    <div>
                        <input type="hidden" name="recipientsConfig[selectedUserGroups]" value="" />
                        <input type="checkbox" id="checkbox2042499779" class="all checkbox" name="recipientsConfig[selectedUserGroups]" value="*" aria-describedby="recipientsConfig-selectedUserGroups-instructions" />
                        <label for="checkbox2042499779">
                            <b>All</b>
                        </label>
                    </div>
                    <div>
                        <input type="checkbox" id="checkbox804410199" class="checkbox" name="recipientsConfig[selectedUserGroups][]" value="33" />
                        <label for="checkbox804410199">
                            Dude
                        </label>
                    </div>
                    <div>
                        <input type="checkbox" id="checkbox334697430" class="checkbox" name="recipientsConfig[selectedUserGroups][]" value="42" />
                        <label for="checkbox334697430">
                            Sweet
                        </label>
                    </div>
                </fieldset>
            </div>
        </fieldset>

        <div
            id="recipientsConfig-customRecipients-field"
            class="field"
            data-attribute="recipientsConfig-customRecipients"
            v-show="'custom-recipients'===notificationStore.recipientsType"
        >
            <div class="heading">
                <label id="recipientsConfig-customRecipients-label" for="recipientsConfig-customRecipients">Custom Recipients<span class="visually-hidden">Required</span><span class="required" aria-hidden="true"></span></label>
            </div>
            <div id="recipientsConfig-customRecipients-instructions" class="instructions">
                <p>Learn more about <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" rel="noopener" target="_blank">special variables</a>.</p>
            </div>
            <div class="input ltr">
                <textarea
                    id="recipientsConfig-customRecipients"
                    class="code text fullwidth"
                    name="recipientsConfig[customRecipients]"
                    :rows="6"
                    cols="50"
                    :placeholder="customRecipientsPlaceholder"
                    v-model="notificationStore.recipientsConfig.customRecipients"
                    aria-describedby="recipientsConfig-customRecipients-instructions"
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
        recipientsTypeSummary: () => {
            // Get the Pinia store
            const notificationStore = useNotificationStore();
            // Prescript
            const sendTo = `Message will be sent to`;
            // Postscript for current user
            const currentUser = `<br><br>In other words, the person who activated the trigger event.`;
            // Postscript for more info on template filtering
            const templateFiltering = `<br><br>Additional filtering can be done at the template level.`;
            // Postscript for more info on custom recipients
            const customRecipients = `<br><br>See the documentation for more information.`;
            // All recipient type summaries
            const summaries = {
                'current-user':        `${sendTo} <strong>the current user when the event occurs</strong>. ${currentUser}`,
                'all-admins':          `${sendTo} <strong>all Admin Users</strong>. ${templateFiltering}`,
                'all-users':           `${sendTo} <strong>all Users in the system</strong>. ${templateFiltering}`,
                'all-users-in-groups': `${sendTo} <strong>all Users in selected User Group(s)</strong>. ${templateFiltering}`,
                'custom-recipients':   `${sendTo} <strong>a custom selection of recipients</strong>. ${customRecipients}`,
            }
            // Return the matching summary
            return summaries[notificationStore.recipientsType] ?? '';
        }
    }
}
</script>
