---
description: Attach your own custom fields to notifications, then use their values in dynamic message templates.
---

# Custom Fields

Beyond the native **Title** field, add any number of custom fields to the **Meta** tab of a Notification.

<img class="dropshadow" src="/images/custom-fields/meta-tab.png" alt="The Meta tab of a notification, showing several custom fields below the Title" style="width:640px; margin-top:18px; margin-bottom:40px">

Custom fields give you greater control over _what the client can edit_. Field values are available under `notification.<handle>` in outbound messages.

If desired, you can restrict the client's [user permissions](/getting-started/permissions), allowing them to edit _only_ the **Meta** tab.

## Configuring custom fields

Go to **Settings → Plugins → Notifier → Notification Fields**.

Drag and drop which fields you'd like to include under the **Meta** tab.

<img class="dropshadow" src="/images/settings/settings-fields.png" alt="Screenshot of the Custom Fields settings sub-page" style="width:640px; margin-top:10px">

## Using custom fields in a dynamic Twig template

Each custom field will be available to you within dynamic templates as `notification.<handle>`.

```twig
{# A plain text field #}
{{ notification.examplePlainText }}

{# A dropdown field #}
{{ notification.exampleDropdown.value }}

{# A relation field #}
{% set element = notification.exampleRelation.one() %}
```

## The deprecated "Description" field

Prior to v3.2.0, each Notification included a fixed **Description** field. This has been migrated to a Plain Text custom field as `notifierDescription`.

:::tip Updating templates for v3.2
If you were using `notification.description` in your Twig templates prior to v3.2.0, update it to use `notification.notifierDescription` instead.
:::

## Reserved field handles

To prevent conflicts with the native fields of Notifications, the following field handles are reserved:

| Handle             | Already exists as                       |
|:-------------------|:----------------------------------------|
| `eventType`        | Type of trigger event.                  |
| `event`            | Specific trigger event.                 |
| `eventConfig`      | Configuration of the trigger event.     |
| `messageType`      | Type of message to send.                |
| `messageConfig`    | Configuration of the message.           |
| `recipientsType`   | Type of recipient to send to.           |
| `recipientsConfig` | Configuration of the target recipients. |
| `queue`            | Whether or not to send via the queue.   |
| `log`              | Internal logging.                       |

Using any of these as your custom field handle may cause collisions.

## Twig sandbox

The default [Twig sandbox](/messages/twig-sandbox) configuration will automatically whitelist the `notification.*` variable

If you need to customize the sandbox, ensure that `notification.*` remains available if you are using it in your templates.
