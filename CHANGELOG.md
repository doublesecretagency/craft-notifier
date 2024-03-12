# Changelog

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
