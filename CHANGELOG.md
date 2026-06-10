# Changelog

## Unreleased

### Added
- Added the ability to send a [System Snapshot](https://plugins.doublesecretagency.com/notifier/events/types/system-snapshot/).
- Added the ability to send [Dynamic Data](https://plugins.doublesecretagency.com/notifier/events/types/dynamic-data/).
- Added user permissions for authoring Dynamic Data snippets.
- Added support for sending [MQTT](https://plugins.doublesecretagency.com/notifier/messages/types/mqtt) notifications.
- Added the [MQTT topics](https://plugins.doublesecretagency.com/notifier/recipients/types/mqtt-topics) recipient type for posting to one or more MQTT topics.

### Changed
- Moved the ["Use Queue"](https://plugins.doublesecretagency.com/notifier/messages/queue) setting to the right sidebar, below "Enabled".

## 3.0.2 - 2026-05-28

### Changed
- "Send a test message" now tests against real data.
- Hide the "Send a test message" button until notification has been saved at least once.

### Fixed
- Protect against uninstalled plugins with remaining composer packages.

## 3.0.1 - 2026-05-27

### Fixed
- Improved Craft 4 compatibility.

## 3.0.0 - 2026-05-26

### Added
- Added support for sending [Pushover](https://plugins.doublesecretagency.com/notifier/messages/types/pushover) notifications via [Pushover](https://pushover.net). ([#19](https://github.com/doublesecretagency/craft-notifier/issues/19))
- Added support for sending [ntfy](https://plugins.doublesecretagency.com/notifier/messages/types/ntfy) notifications via [ntfy.sh](https://ntfy.sh).
- Added support for posting [Slack](https://plugins.doublesecretagency.com/notifier/messages/types/slack) messages via [chat.postMessage](https://docs.slack.dev/reference/methods/chat.postMessage).
- Added support for publishing [Bluesky](https://plugins.doublesecretagency.com/notifier/messages/types/bluesky) posts via the [ATProto](https://atproto.com) API.
- Added the ability to track an [RSS/JSON Feed](https://plugins.doublesecretagency.com/notifier/events/types/feed/). ([#10](https://github.com/doublesecretagency/craft-notifier/issues/10))
- Added the ability to [manually send](https://plugins.doublesecretagency.com/notifier/events/manual-sending) a notification on demand, against a specific element.
- Added the ability to [schedule sending](https://plugins.doublesecretagency.com/notifier/events/scheduled-sending) of time-based notifications. ([#10](https://github.com/doublesecretagency/craft-notifier/issues/10))
- Added trigger event ["When a scheduled date is reached"](https://plugins.doublesecretagency.com/notifier/events/types/entries/date-reached). ([#10](https://github.com/doublesecretagency/craft-notifier/issues/10))
- Added trigger event ["When an entry changes from Pending to Live"](https://plugins.doublesecretagency.com/notifier/events/types/entries/pending-to-live). ([#10](https://github.com/doublesecretagency/craft-notifier/issues/10))
- Added trigger event ["When an entry is deleted"](https://plugins.doublesecretagency.com/notifier/events/types/entries/entry-deleted). ([#2](https://github.com/doublesecretagency/craft-notifier/issues/2))
- Added trigger event ["When an entry is restored"](https://plugins.doublesecretagency.com/notifier/events/types/entries/entry-restored).
- Added trigger event ["When a user is updated"](https://plugins.doublesecretagency.com/notifier/events/types/users/user-updated). ([#2](https://github.com/doublesecretagency/craft-notifier/issues/2))
- Added trigger event ["When a user is assigned to one or more groups"](https://plugins.doublesecretagency.com/notifier/events/types/users/user-assigned-to-groups). ([#2](https://github.com/doublesecretagency/craft-notifier/issues/2))
- Added trigger event ["When a user is deleted"](https://plugins.doublesecretagency.com/notifier/events/types/users/user-deleted). ([#2](https://github.com/doublesecretagency/craft-notifier/issues/2))
- Added trigger event ["When a user is restored"](https://plugins.doublesecretagency.com/notifier/events/types/users/user-restored).
- Added trigger event ["When an asset is moved"](https://plugins.doublesecretagency.com/notifier/events/types/assets/asset-moved).
- Added trigger event ["When an asset is updated"](https://plugins.doublesecretagency.com/notifier/events/types/assets/asset-updated).
- Added trigger event ["When an asset is deleted"](https://plugins.doublesecretagency.com/notifier/events/types/assets/asset-deleted). ([#2](https://github.com/doublesecretagency/craft-notifier/issues/2))
- Added trigger event ["When an asset is restored"](https://plugins.doublesecretagency.com/notifier/events/types/assets/asset-restored).
- Added trigger event ["When an order is completed (placed)"](https://plugins.doublesecretagency.com/notifier/events/types/craft-commerce/order-completed) for [Craft Commerce](https://plugins.craftcms.com/commerce). ([#33](https://github.com/doublesecretagency/craft-notifier/pull/33)) (thanks @chasegiunta)
- Added trigger event ["When an order is fully paid"](https://plugins.doublesecretagency.com/notifier/events/types/craft-commerce/order-fully-paid) for [Craft Commerce](https://plugins.craftcms.com/commerce). ([#33](https://github.com/doublesecretagency/craft-notifier/pull/33)) (thanks @chasegiunta)
- Added trigger event ["When a product is saved"](https://plugins.doublesecretagency.com/notifier/events/types/craft-commerce/product-saved) for [Craft Commerce](https://plugins.craftcms.com/commerce). ([#2](https://github.com/doublesecretagency/craft-notifier/issues/2))
- Added trigger event ["When a product is deleted"](https://plugins.doublesecretagency.com/notifier/events/types/craft-commerce/product-deleted) for [Craft Commerce](https://plugins.craftcms.com/commerce). ([#2](https://github.com/doublesecretagency/craft-notifier/issues/2))
- Added trigger event ["When a product is restored"](https://plugins.doublesecretagency.com/notifier/events/types/craft-commerce/product-restored) for [Craft Commerce](https://plugins.craftcms.com/commerce).
- Added trigger event ["When a product is saved"](https://plugins.doublesecretagency.com/notifier/events/types/digital-products/product-saved) for [Digital Products](https://plugins.craftcms.com/digital-products). ([#2](https://github.com/doublesecretagency/craft-notifier/issues/2))
- Added trigger event ["When a product is deleted"](https://plugins.doublesecretagency.com/notifier/events/types/digital-products/product-deleted) for [Digital Products](https://plugins.craftcms.com/digital-products). ([#2](https://github.com/doublesecretagency/craft-notifier/issues/2))
- Added trigger event ["When a product is restored"](https://plugins.doublesecretagency.com/notifier/events/types/digital-products/product-restored) for [Digital Products](https://plugins.craftcms.com/digital-products).
- Added trigger event ["When a license is saved"](https://plugins.doublesecretagency.com/notifier/events/types/digital-products/license-saved) for [Digital Products](https://plugins.craftcms.com/digital-products).
- Added trigger event ["When a license is deleted"](https://plugins.doublesecretagency.com/notifier/events/types/digital-products/license-deleted) for [Digital Products](https://plugins.craftcms.com/digital-products).
- Added trigger event ["When a license is restored"](https://plugins.doublesecretagency.com/notifier/events/types/digital-products/license-restored) for [Digital Products](https://plugins.craftcms.com/digital-products).
- Added trigger event ["When an event is saved"](https://plugins.doublesecretagency.com/notifier/events/types/solspace-calendar/event-saved) for [Solspace Calendar](https://plugins.craftcms.com/calendar).
- Added trigger event ["When an event is deleted"](https://plugins.doublesecretagency.com/notifier/events/types/solspace-calendar/event-deleted) for [Solspace Calendar](https://plugins.craftcms.com/calendar).
- Added trigger event ["When an event is restored"](https://plugins.doublesecretagency.com/notifier/events/types/solspace-calendar/event-restored) for [Solspace Calendar](https://plugins.craftcms.com/calendar).
- Added the [ntfy Topics](https://plugins.doublesecretagency.com/notifier/recipients/types/ntfy-topics) recipient type for posting to one or more ntfy topics.
- Added the [Slack Channels](https://plugins.doublesecretagency.com/notifier/recipients/types/slack-channels) recipient type for posting to one or more Slack channels.
- Added the [Bluesky Accounts](https://plugins.doublesecretagency.com/notifier/recipients/types/bluesky-accounts) recipient type for posting to one or more Bluesky accounts.
- Added the [Dynamic Recipients](https://plugins.doublesecretagency.com/notifier/recipients/types/dynamic-recipients) recipient type.
- Added a [`{% setRecipients %}`](https://plugins.doublesecretagency.com/notifier/recipients/types/dynamic-recipients#how-to-use) Twig tag for use inside Dynamic Recipients snippets.
- Announcement notifications now support every standard [recipient type](https://plugins.doublesecretagency.com/notifier/recipients/types/).
- Added [Volume filtering](https://plugins.doublesecretagency.com/notifier/events/types/assets) for Asset events.
- Added [User Group filtering](https://plugins.doublesecretagency.com/notifier/events/types/users) for User events.
- Added field-level [conditions](https://craftcms.com/docs/5.x/extend/conditions.html) to all element events.
- Added a ["has changed" operator](https://plugins.doublesecretagency.com/notifier/events/types/entries/entry-saved-per-site#has-changed-operator) to field condition rules.
- Added a ["Send a test message"](https://plugins.doublesecretagency.com/notifier/testing) button to each Notification's edit screen.
- Added a [Rich Text editor](https://plugins.doublesecretagency.com/notifier/messages/types/email#body-editor) option for the email message body. ([#12](https://github.com/doublesecretagency/craft-notifier/issues/12))
- Added comprehensive unit tests.
- Added [translations](https://plugins.doublesecretagency.com/notifier/translations) for eighteen locales.
- Added [`loggingEnabled`](https://plugins.doublesecretagency.com/notifier/logging#restricting-log-size) setting to disable writing to the notification log.
- Added [`logRetentionDays`](https://plugins.doublesecretagency.com/notifier/logging#restricting-log-size) setting to limit log retention by age.
- Added [`logRetentionRecords`](https://plugins.doublesecretagency.com/notifier/logging#restricting-log-size) setting to limit log retention by event count.
- Added user permissions for viewing, saving, testing, and deleting notifications. ([#28](https://github.com/doublesecretagency/craft-notifier/issues/28))
- Added user permissions for authoring Dynamic Recipients snippets.
- Added user permissions for viewing and deleting the notification log.

### Changed
- The Notification Log utility is now hidden from users without the "View notification log" permission.
- The "Delete notification" action is now hidden from users without the "Delete notifications" permission.
- Creating a notification draft now requires the "Save notifications" permission.
- Renamed the entry trigger labels for clarity.
- The "saved and propagated" trigger now fires after the entry-save transaction commits.

### Fixed
- Fixed `{{ entry.currentRevision }}` returning `null` in notification templates. ([#7](https://github.com/doublesecretagency/craft-notifier/issues/7))
- Fixed per-site notifications rendering with the request's current site, instead of the entry's site.
- Fixed a fatal error when viewing the Notifications index in Card View. ([#25](https://github.com/doublesecretagency/craft-notifier/issues/25))
- Fixed bug where the Notification Log appeared empty on databases missing timezone tables. ([#30](https://github.com/doublesecretagency/craft-notifier/pull/30)) (thanks @chasegiunta)
- Fixed bug where the `user` template alias was not set for the User Activated trigger. ([#31](https://github.com/doublesecretagency/craft-notifier/issues/31)) (thanks @chasegiunta)
- Fixed `{% skipMessage %}` not being recognized inside the Twig sandbox. ([#29](https://github.com/doublesecretagency/craft-notifier/issues/29))

### Removed
- Removed the deprecated `twigSandbox` config setting. Use [`config/notifier-sandbox.php`](https://plugins.doublesecretagency.com/notifier/messages/twig-sandbox) instead.

## 2.1.0 - 2025-02-25

### Added
- Added filtering by selected Sites. ([#5](https://github.com/doublesecretagency/craft-notifier/issues/5))
- Added slideouts for Notification elements.
- Added support for the [Closure](https://github.com/nystudio107/craft-closure) module.
- Added buttons linking between Notifications and log.
- Added action to "Save and add another".
- Added action to "Delete notification".
- Added trigger event ["When an entry is saved (per each site)"](https://plugins.doublesecretagency.com/notifier/events/types/entries).

### Changed
- New filtering mechanism borrowed heavily from the [Webhooks](https://github.com/craftcms/webhooks/blob/9c901be4d98c8584893c1cbce2b7dad217fbc480/README.md#filtering-events) plugin.
- Twig template fields now use the [nystudio107/craft-code-editor](https://github.com/nystudio107/craft-code-editor) package.
- Refactored the [Twig sandbox](https://plugins.doublesecretagency.com/notifier/messages/twig-sandbox) to use [nystudio107/craft-twig-sandbox](https://github.com/nystudio107/craft-twig-sandbox).

### Fixed
- Fixed "Save and continue editing" behavior.
- Improved user authorization checks.
- Corrected "Recipients Type" column of Notifications index.
- Reintroduced filters for Section & Entry Types. ([#22](https://github.com/doublesecretagency/craft-notifier/issues/22))
- Reintroduced filters for New vs Existing entries. ([#22](https://github.com/doublesecretagency/craft-notifier/issues/22))
- Reintroduced filters for entry Drafts and Revisions. ([#22](https://github.com/doublesecretagency/craft-notifier/issues/22))

## 2.0.1 - 2024-03-15

### Changed
- Improved log error messages. ([#20](https://github.com/doublesecretagency/craft-notifier/issues/20), [#21](https://github.com/doublesecretagency/craft-notifier/issues/21))

## 2.0.0 - 2024-03-15

### Changed
- Determined stable for Craft 5.

## 2.0.0-beta.1 - 2024-03-12

### Changed
- Craft 5 compatibility.

## 1.0.0 - 2024-03-11

### Added
- Added a new ["Notification" element type](https://plugins.doublesecretagency.com/notifier/elements).
- Added support for sending [SMS (Text Messages)](https://plugins.doublesecretagency.com/notifier/messages/types/sms-text) via Twilio.
- Added support for sending [Announcements](https://plugins.doublesecretagency.com/notifier/messages/types/announcement).
- Added support for sending [Flash Messages](https://plugins.doublesecretagency.com/notifier/messages/types/flash).
- Added trigger event ["When a new user is created"](https://plugins.doublesecretagency.com/notifier/events/types/users).
- Added trigger event ["When a user is activated"](https://plugins.doublesecretagency.com/notifier/events/types/users).
- Added trigger event ["When a new file is uploaded and saved"](https://plugins.doublesecretagency.com/notifier/events/types/assets).
- Added [Current User](https://plugins.doublesecretagency.com/notifier/recipients/types/current-user) recipient type.
- Added [Selected Users](https://plugins.doublesecretagency.com/notifier/recipients/types/selected-users) recipient type.
- Now parses messages in a secure [Twig sandbox](https://plugins.doublesecretagency.com/notifier/messages/twig-sandbox).

### Changed
- Completely overhauled the entire UX.
- Completely overhauled logging system.
- Completely rewritten documentation.

## 0.10.1 - 2022-12-22

### Fixed
- Fixed reference to core method which was renamed in Craft 4. ([#16](https://github.com/doublesecretagency/craft-notifier/issues/16))

## 0.10.0 - 2022-04-25

### Added
- Craft 4 compatibility.

## 0.9.5 - 2022-04-10

### Added
- Prevent duplicate email messages from being sent unintentionally. ([#11](https://github.com/doublesecretagency/craft-notifier/issues/11))

## 0.9.4 - 2022-04-09

### Changed
- Various minor UX improvements.

## 0.9.3 - 2021-09-28

### Added
- Added ability to filter by Entry Types. ([#4](https://github.com/doublesecretagency/craft-notifier/issues/4))

### Changed
- Requires a minimum of Craft 3.7.10.
- Improved UI and stability of setting to determine New vs Existing.
- Improved UI and stability of setting to determine Draft vs Published.

### Fixed
- Prevent trigger activation during a bulk resave.

## 0.9.2 - 2021-08-28

### Added
- Added link to request new trigger events.

### Changed
- Various minor UX improvements.
- Ensure events are not triggered while plugin is being installed.

### Fixed
- Corrected the schema version.

## 0.9.1 - 2021-08-24

**Public beta release.**

## 0.9.0 - 2021-08-18

**Private beta release.**
