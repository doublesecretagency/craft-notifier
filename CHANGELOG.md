# Changelog

## Unreleased

### Added
- Added slideouts for Notification elements.
- Added support for the [Closure](https://github.com/nystudio107/craft-closure) module.
- Added buttons linking between Notifications and log.
- Added action to "Save and add another".
- Added action to "Delete notification".
- Added trigger event ["When an entry is saved (per each site)"](https://plugins.doublesecretagency.com/notifier/events/types/entries).

### Changed
- New filtering mechanism borrowed heavily from the [Webhooks](https://github.com/craftcms/webhooks/blob/9c901be4d98c8584893c1cbce2b7dad217fbc480/README.md#filtering-events) plugin.
- Improved behavior of the secure [Twig sandbox](https://plugins.doublesecretagency.com/notifier/messages/twig-sandbox).

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
