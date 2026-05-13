<?php
/**
 * Notifier plugin for Craft CMS
 *
 * Send custom Twig messages when Craft events are triggered.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

return [

    // Plugin name and nav
    'Notifier'               => 'Notifier',
    'Notifications'          => 'Benachrichtigungen',
    'Notification'           => 'Benachrichtigung',
    'All notifications'      => 'Alle Benachrichtigungen',
    'Notification Log'       => 'Benachrichtigungsprotokoll',
    'Logs'                   => 'Protokolle',
    'View Notifications'     => 'Benachrichtigungen anzeigen',
    'Add a New Notification' => 'Neue Benachrichtigung hinzufügen',

    // Permissions
    'View notifications'              => 'Benachrichtigungen anzeigen',
    'Save notifications'              => 'Benachrichtigungen speichern',
    'Use the Dynamic Recipients type' => 'Den Typ Dynamische Empfänger verwenden',
    'Test notifications'              => 'Benachrichtigungen testen',
    'Delete notifications'            => 'Benachrichtigungen löschen',
    'View notification log'           => 'Benachrichtigungsprotokoll anzeigen',
    'Delete notification log'         => 'Benachrichtigungsprotokoll löschen',

    // Notification editor: tabs
    'Meta'       => 'Meta',
    'Event'      => 'Ereignis',
    'Message'    => 'Nachricht',
    'Recipients' => 'Empfänger',

    // Event tab: type selector
    'Event Type'                                           => 'Ereignistyp',
    'What type of event will activate the notification?'   => 'Welche Art von Ereignis löst die Benachrichtigung aus?',
    'Which specific event will activate the notification?' => 'Welches konkrete Ereignis löst die Benachrichtigung aus?',

    // Event tab: event types
    'Assets Event'                   => 'Asset-Ereignis',
    'Commerce Orders Event'          => 'Commerce-Bestellungsereignis',
    'Commerce Products Event'        => 'Commerce-Produktereignis',
    'Digital Products Event'         => 'Digital Products-Ereignis',
    'Digital Product Licenses Event' => 'Digital Products-Lizenzereignis',
    'Solspace Calendar Event'        => 'Solspace Calendar-Ereignis',
    'Entries Event'                  => 'Eintragsereignis',
    'Users Event'                    => 'Benutzerereignis',
    'Ungrouped Users'                => 'Benutzer ohne Gruppe',

    // Field and element conditions
    'Field Conditions'             => 'Feldbedingungen',
    'Send the message only when the saved element matches the following conditions.' => 'Die Nachricht nur senden, wenn das gespeicherte Element die folgenden Bedingungen erfüllt.',
    'has changed'                  => 'wurde geändert',
    '#{elementType} Event Filters' => 'Ereignisfilter für #{elementType}',
    'No filters match this event.' => 'Keine Filter passen zu diesem Ereignis.',
    'Determine whether each message should be sent based on specified conditions.' => 'Bestimmen Sie anhand festgelegter Bedingungen, ob die jeweilige Nachricht gesendet werden soll.',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => 'Das Element wird zum ersten Mal gespeichert',
    'Must be a new entry'                       => 'Muss ein neuer Eintrag sein',
    'Must be an existing entry'                 => 'Muss ein vorhandener Eintrag sein',
    'Can be existing or new'                    => 'Kann vorhanden oder neu sein',

    // Filters: new elements
    'Element is new'         => 'Das Element ist neu',
    'New elements only'      => 'Nur neue Elemente',
    'Existing elements only' => 'Nur vorhandene Elemente',

    // Filters: enabled state
    'Element is enabled'         => 'Das Element ist aktiviert',
    'Must be enabled'            => 'Muss aktiviert sein',
    'Must be disabled'           => 'Muss deaktiviert sein',
    'Can be enabled or disabled' => 'Kann aktiviert oder deaktiviert sein',

    // Filters: drafts
    'Element is a draft'          => 'Das Element ist ein Entwurf',
    'Must be a draft'             => 'Muss ein Entwurf sein',
    'Must not be a draft'         => 'Darf kein Entwurf sein',
    'Can be a draft or non-draft' => 'Kann Entwurf oder kein Entwurf sein',

    // Filters: provisional drafts
    'Element is a provisional draft'                => 'Das Element ist ein provisorischer Entwurf',
    'Must be a provisional draft'                   => 'Muss ein provisorischer Entwurf sein',
    'Must not be a provisional draft'               => 'Darf kein provisorischer Entwurf sein',
    'Can be a provisional draft or non-provisional' => 'Kann provisorischer Entwurf oder regulär sein',

    // Filters: revisions
    'Element is a revision'             => 'Das Element ist eine Revision',
    'Must be a revision'                => 'Muss eine Revision sein',
    'Must not be a revision'            => 'Darf keine Revision sein',
    'Can be a revision or non-revision' => 'Kann Revision oder keine Revision sein',

    // Filters: duplication
    'Element is being duplicated'         => 'Das Element wird dupliziert',
    'Must be duplicating the element'     => 'Das Element muss dupliziert werden',
    'Must not be duplicating the element' => 'Das Element darf nicht dupliziert werden',

    // Filters: propagation
    'Element is being propagated'     => 'Das Element wird propagiert',
    'Element must be propagating'     => 'Das Element muss propagiert werden',
    'Element must not be propagating' => 'Das Element darf nicht propagiert werden',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => 'Das Element wird im Stapel neu gespeichert',
    'Must be bulk-resaving the element'     => 'Das Element muss im Stapel neu gespeichert werden',
    'Must not be bulk-resaving the element' => 'Das Element darf nicht im Stapel neu gespeichert werden',

    // Filters: common output
    'Unnamed filter'                => 'Unbenannter Filter',
    'Must be TRUE to send message'  => 'Muss TRUE sein, um die Nachricht zu senden',
    'Must be FALSE to send message' => 'Muss FALSE sein, um die Nachricht zu senden',
    'No effect'                     => 'Keine Wirkung',

    // Message tab: type selector and queue
    'Message Type'                       => 'Nachrichtentyp',
    'What type of message will be sent?' => 'Welche Art von Nachricht wird gesendet?',
    'Send Message via Queue'             => 'Nachricht über Warteschlange senden',
    'Should the message be sent via the [jobs queue]({queueUrl})?' => 'Soll die Nachricht über die [Auftrags-Warteschlange]({queueUrl}) gesendet werden?',
    'Send immediately' => 'Sofort senden',
    'Add to queue' => 'Zur Warteschlange hinzufügen',

    // Message tab: Email fields
    "User's Email Address Field" => 'Benutzerfeld für E-Mail-Adresse',
    'Email Subject'              => 'E-Mail-Betreff',
    'Email Body'                 => 'E-Mail-Text',

    // Message tab: SMS fields
    "User's Phone Number Field" => 'Benutzerfeld für Telefonnummer',
    'SMS Message Body'          => 'SMS-Nachrichtentext',

    // Message tab: Announcement fields
    'Announcement Title'   => 'Ankündigungstitel',
    'Announcement Message' => 'Ankündigungstext',

    // Message tab: Flash fields
    'Flash Message Type'                         => 'Flash-Nachrichtentyp',
    'Flash Message Title'                        => 'Flash-Nachrichtentitel',
    'Flash Message Details'                      => 'Flash-Nachrichtendetails',
    'Which type of flash message should appear?' => 'Welche Art von Flash-Nachricht soll erscheinen?',

    // Message tab: Pushover fields
    "Field containing each user's Pushover key" => 'Pushover-Schlüsselfeld des Benutzers',
    'The Pushover application token is configured in [Settings → Pushover](url).' => 'Das Pushover-Anwendungstoken wird unter [Einstellungen → Pushover](url) konfiguriert.',

    // Message tab: ntfy fields
    'Priority'           => 'Priorität',
    'Tags'               => 'Tags',
    'Click URL'          => 'Klick-URL',
    'Render as Markdown' => 'Als Markdown rendern',

    // Message tab: Slack fields
    'Slack Message Body' => 'Slack-Nachrichtentext',

    // Message tab: Bluesky fields
    'Post Body' => 'Beitragstext',
    'Generate Link Preview' => 'Linkvorschau erzeugen',
    "When the post body contains a URL, automatically generate a preview card with the linked page's image, title, and description." => 'Wenn der Beitragstext eine URL enthält, wird eine Vorschaukarte mit Titel, Beschreibung und Bild der verlinkten Seite angehängt.',
    'No card' => 'Keine Karte',
    'Generate preview card' => 'Vorschaukarte erzeugen',

    // Message tab: Title / Body / Trix toolbar
    'Title'         => 'Titel',
    'Body'          => 'Text',
    'Rich Text'     => 'Rich Text',
    'Bold'          => 'Fett',
    'Italic'        => 'Kursiv',
    'Underline'     => 'Unterstrichen',
    'Strikethrough' => 'Durchgestrichen',
    'Bullets'       => 'Aufzählung',
    'Numbers'       => 'Nummerierung',
    'Heading'       => 'Überschrift',
    'Code'          => 'Code',
    'Undo'          => 'Rückgängig',
    'Redo'          => 'Wiederholen',
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => 'Text der ausgehenden E-Mail. Sie können <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">spezielle Variablen</a> verwenden oder sogar <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">Empfänger überspringen</a>.',

    // Recipients tab: common
    'Recipients Type'                             => 'Empfängertyp',
    'Who will receive this message?'              => 'Wer soll diese Nachricht erhalten?',
    'Add a message recipient'                     => 'Empfänger hinzufügen',
    'Select User(s)'                              => 'Benutzer auswählen',
    'Which users will receive the message?'       => 'Welche Benutzer sollen die Nachricht erhalten?',
    'Which user groups will receive the message?' => 'Welche Benutzergruppen sollen die Nachricht erhalten?',
    'Twig Snippet to Determine Recipients'        => 'Twig-Snippet zur Bestimmung der Empfänger',

    // Recipients tab: per-provider pickers
    'Select Slack channel(s)'                           => 'Slack-Kanal/Kanäle auswählen',
    'Which Slack channels should receive this message?' => 'Welche Slack-Kanäle sollen diese Nachricht erhalten?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Keine Slack-Kanäle konfiguriert. Fügen Sie einen unter [Einstellungen → Slack]({url}) hinzu.',
    'Select ntfy topic(s)'                              => 'ntfy-Thema/Themen auswählen',
    'Which ntfy topics should receive this message?'    => 'Welche ntfy-Themen sollen diese Nachricht erhalten?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'Keine ntfy-Themen konfiguriert. Fügen Sie eines unter [Einstellungen → ntfy]({url}) hinzu.',
    'Select Bluesky account(s)'                         => 'Bluesky-Konto/Konten auswählen',
    'Which Bluesky accounts should post this message?'  => 'Welche Bluesky-Konten sollen diese Nachricht veröffentlichen?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Keine Bluesky-Konten konfiguriert. Fügen Sie eines unter [Einstellungen → Bluesky]({url}) hinzu.',

    // Settings: page chrome
    'Notifier Settings' => 'Notifier-Einstellungen',
    'General'           => 'Allgemein',
    'Twilio'            => 'Twilio',
    'Pushover'          => 'Pushover',
    'Slack'             => 'Slack',
    'Bluesky'           => 'Bluesky',
    'ntfy'              => 'ntfy',

    // Settings: Logging
    'Logging'                             => 'Protokollierung',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier führt ein fortlaufendes Protokoll der gesendeten Nachrichten. Normalerweise nicht erforderlich, aber Sie können die Anzahl der in der Datenbank gespeicherten Protokollereignisse begrenzen.',
    'Enable Logging'                      => 'Protokollierung aktivieren',
    'When disabled, Notifier will not write anything to the notification log.' => 'Bei Deaktivierung schreibt Notifier nichts in das Benachrichtigungsprotokoll.',
    'Number of days to retain log events' => 'Anzahl der Tage, an denen Protokollereignisse aufbewahrt werden',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Protokollereignisse höchstens so viele Tage aufbewahren. Leer lassen für kein Limit.',
    'Number of log events to retain'      => 'Anzahl der zu behaltenden Protokollereignisse',
    'At most, keep this many log events. Leave blank for no limit.' => 'Höchstens diese Anzahl an Protokollereignissen behalten. Leer lassen für kein Limit.',

    // Settings: Twilio
    'Twilio API Credentials'                       => 'Twilio-API-Zugangsdaten',
    'If using the Twilio API to send SMS messages, the following credentials are required.' => 'Wenn die Twilio-API zum Versenden von SMS-Nachrichten verwendet wird, sind die folgenden Zugangsdaten erforderlich.',
    'Twilio Account SID'                           => 'Twilio Account SID',
    'Twilio Auth Token'                            => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)' => 'Twilio-Telefonnummer (versendet jede SMS-Nachricht)',
    'SMS Testing'                                  => 'SMS-Test',
    'Optional. When set, every SMS dispatched will be sent to this number instead of the resolved recipient.' => 'Optional. Wenn gesetzt, wird jede gesendete SMS an diese Nummer statt an den ursprünglichen Empfänger zugestellt.',
    'Test phone number'                            => 'Test-Telefonnummer',

    // Settings: Pushover
    "[Pushover](https://pushover.net) sends push notifications to a registered user's devices. Each Craft user needs a custom field on their profile storing their Pushover user key; you select which field on each Notification's Message tab. For full setup instructions, see the [Pushover getting-started docs](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover)." => '[Pushover](https://pushover.net) sendet Push-Benachrichtigungen an die Geräte eines registrierten Benutzers. Jeder Craft-Benutzer benötigt ein benutzerdefiniertes Feld auf seinem Profil, das den Pushover-Schlüssel speichert. Sie wählen das Feld auf dem Tab Nachricht jeder Benachrichtigung aus. Vollständige Einrichtungsanweisungen finden Sie in der [Pushover-Einstiegsdokumentation](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover).',
    'Application API Token'                                      => 'Anwendungs-API-Token',
    'The 30-character app token from your Pushover application.' => 'Das 30-stellige App-Token aus Ihrer Pushover-Anwendung.',

    // Settings: ntfy
    'ntfy.sh is a free HTTP-based push notification service. Subscribers receive messages on the ntfy app, web, or any compatible client by joining a topic.' => 'ntfy.sh ist ein kostenloser HTTP-basierter Push-Benachrichtigungsdienst. Abonnenten erhalten Nachrichten in der ntfy-App, im Web oder über jeden kompatiblen Client, indem sie einem Thema beitreten.',
    'Server URL'   => 'Server-URL',
    'Defaults to https://ntfy.sh. Point at a self-hosted ntfy instance if applicable.' => 'Standard ist https://ntfy.sh. Verweisen Sie auf eine selbst gehostete ntfy-Instanz, falls zutreffend.',
    'Access token' => 'Zugriffstoken',
    'Optional. Required for protected topics or self-hosted instances with auth.' => 'Optional. Erforderlich für geschützte Themen oder selbst gehostete Instanzen mit Authentifizierung.',
    'ntfy Topics'  => 'ntfy-Themen',
    'Named list of ntfy topics. Each topic becomes selectable on the notification edit screen.' => 'Benannte Liste von ntfy-Themen. Jedes Thema wird auf der Bearbeitungsseite der Benachrichtigung auswählbar.',
    'Topics'       => 'Themen',
    'Add one row per topic name. Use the **Test** button to send a quick test message to the topic.' => 'Fügen Sie eine Zeile pro Themenname hinzu. Verwenden Sie die Schaltfläche **Test**, um eine schnelle Testnachricht an das Thema zu senden.',
    'Topic'        => 'Thema',
    'Add a topic'  => 'Thema hinzufügen',
    'Save first to persist a row, then click its **Test** button to fire a sanity check against ntfy.' => 'Speichern Sie zuerst, um eine Zeile zu sichern, und klicken Sie dann auf die Schaltfläche **Test**, um eine Plausibilitätsprüfung gegen ntfy auszulösen.',

    // Settings: Slack
    'Slack Channels' => 'Slack-Kanäle',
    'Channels'       => 'Kanäle',
    'Each Slack channel needs its own Incoming Webhook URL. Use the **Test** button to fire a quick sanity check after saving.' => 'Jeder Slack-Kanal benötigt seine eigene Incoming-Webhook-URL. Verwenden Sie die Schaltfläche **Test**, um nach dem Speichern eine schnelle Plausibilitätsprüfung auszulösen.',
    'Webhook URL'    => 'Webhook-URL',
    'Add a channel'  => 'Kanal hinzufügen',
    'Save first to persist a row, then click its **Test** button to fire a sanity check against Slack.' => 'Speichern Sie zuerst, um eine Zeile zu sichern, und klicken Sie dann auf die Schaltfläche **Test**, um eine Plausibilitätsprüfung gegen Slack auszulösen.',

    // Settings: Bluesky
    "[Bluesky](https://bsky.app) posts publish to the configured account's feed via the ATProto API. App passwords are generated at [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). An app password is a secret, so store it in a `.env` variable and reference that variable (e.g. `\$BLUESKY_APP_PASSWORD`) rather than pasting the password directly." => '[Bluesky](https://bsky.app)-Beiträge werden über die ATProto-API im Feed des konfigurierten Kontos veröffentlicht. App-Passwörter werden unter [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords) erstellt. Ein App-Passwort ist ein Geheimnis, speichern Sie es daher in einer `.env`-Variable und verweisen Sie auf diese Variable (z. B. `$BLUESKY_APP_PASSWORD`), anstatt das Passwort direkt einzufügen.',
    'PDS URL'          => 'PDS-URL',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'Standard ist https://bsky.social. Verweisen Sie auf eine eigene PDS, falls Ihre Installation föderiert.',
    'Bluesky Accounts' => 'Bluesky-Konten',
    'Named list of Bluesky accounts. Each account becomes selectable on the notification edit screen.' => 'Benannte Liste von Bluesky-Konten. Jedes Konto wird auf der Bearbeitungsseite der Benachrichtigung auswählbar.',
    'Accounts'         => 'Konten',
    'Add one row per Bluesky account. Use **Test** to verify the credentials authenticate.' => 'Fügen Sie eine Zeile pro Bluesky-Konto hinzu. Verwenden Sie **Test**, um zu prüfen, ob die Anmeldedaten authentifizieren.',
    'Label'            => 'Bezeichnung',
    'Handle'           => 'Handle',
    'App password'     => 'App-Passwort',
    'Add an account'   => 'Konto hinzufügen',
    'Save first to persist a row, then click its **Test** button to verify the credentials authenticate.' => 'Speichern Sie zuerst, um eine Zeile zu sichern, und klicken Sie dann auf die Schaltfläche **Test**, um zu prüfen, ob die Anmeldedaten authentifizieren.',

    // Test notification (UI)
    'Send a test message'           => 'Testnachricht senden',
    'Are you certain you want to send a test notification?\\n\\nThe configured message will be sent to the configured recipient(s).' => 'Möchten Sie wirklich eine Testbenachrichtigung senden?\\n\\nDie konfigurierte Nachricht wird an die konfigurierten Empfänger gesendet.',
    'Test'                          => 'Test',
    'Test notification dispatched.' => 'Testbenachrichtigung gesendet.',
    'No messages were dispatched. Check the recipient configuration.' => 'Es wurden keine Nachrichten gesendet. Überprüfen Sie die Empfängerkonfiguration.',

    // Settings: save / test action responses
    "Couldn't save settings."                 => 'Einstellungen konnten nicht gespeichert werden.',
    'Settings saved.'                         => 'Einstellungen gespeichert.',
    'Topic is empty.'                         => 'Thema ist leer.',
    'Server URL is not configured.'           => 'Server-URL ist nicht konfiguriert.',
    'Test message from Notifier.'             => 'Testnachricht von Notifier.',
    'HTTP {status}'                           => 'HTTP {status}',
    'Test message sent successfully.'         => 'Testnachricht erfolgreich gesendet.',
    'HTTP {status}: {body}'                   => 'HTTP {status}: {body}',
    'Handle and app password are required.'   => 'Handle und App-Passwort sind erforderlich.',
    'Authentication failed.'                  => 'Authentifizierung fehlgeschlagen.',
    'Successfully authenticated. No messages were posted.' => 'Erfolgreich authentifiziert. Es wurden keine Nachrichten gepostet.',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.'          => 'Sende {messageType} an {recipient}.',
    'Adding message to queue.'                       => 'Nachricht zur Warteschlange hinzugefügt.',
    'Sending message immediately (bypassing queue).' => 'Nachricht wird sofort gesendet (Warteschlange wird umgangen).',
    'Log events deleted.'                            => 'Protokollereignisse gelöscht.',
    'notification'                                   => 'Benachrichtigung',

    // Outbound: Email log messages
    'Unable to send email, no recipient specified.'     => 'E-Mail kann nicht gesendet werden, kein Empfänger angegeben.',
    'Unable to send email, the message body was empty.' => 'E-Mail kann nicht gesendet werden, der Nachrichtentext war leer.',
    "Unable to send the email using Craft's native email handling." => 'Die E-Mail kann nicht über Crafts integrierte E-Mail-Verarbeitung gesendet werden.',
    'Check your general email settings within Craft.'   => 'Überprüfen Sie Ihre allgemeinen E-Mail-Einstellungen in Craft.',
    'Successfully sent email message!'                  => 'E-Mail erfolgreich gesendet!',

    // Outbound: SMS log messages
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[Ungültige Twilio-Zugangsdaten.]({url}) Es fehlen {missing}.',
    'Unable to send SMS, no Twilio phone number exists.'      => 'SMS kann nicht gesendet werden, keine Twilio-Telefonnummer vorhanden.',
    'Unable to send SMS, no recipient phone number exists.'   => 'SMS kann nicht gesendet werden, keine Empfänger-Telefonnummer vorhanden.',
    'Unable to send SMS, recipient phone number is invalid.'  => 'SMS kann nicht gesendet werden, die Telefonnummer des Empfängers ist ungültig.',
    'Successfully sent SMS message!'                          => 'SMS-Nachricht erfolgreich gesendet!',

    // Outbound: Announcement log messages
    'Unable to post announcement, no recipient userId specified.' => 'Ankündigung kann nicht veröffentlicht werden: keine Empfänger-userId angegeben.',
    'Successfully posted announcement!' => 'Ankündigung erfolgreich veröffentlicht!',

    // Outbound: Flash log messages
    'Unable to send the flash message, invalid flash type.' => 'Flash-Nachricht kann nicht gesendet werden, ungültiger Flash-Typ.',
    'Successfully sent flash message!'                      => 'Flash-Nachricht erfolgreich gesendet!',

    // Outbound: Pushover log messages
    '[Invalid Pushover credentials.]({url}) Missing app token.'  => '[Ungültige Pushover-Zugangsdaten.]({url}) App-Token fehlt.',
    'Unable to send Pushover message, no user key on recipient.' => 'Pushover-Nachricht kann nicht gesendet werden, kein Benutzerschlüssel am Empfänger.',
    'Pushover POST failed: {reason}'                             => 'Pushover-POST fehlgeschlagen: {reason}',
    'Successfully sent Pushover message!'                        => 'Pushover-Nachricht erfolgreich gesendet!',

    // Outbound: ntfy log messages
    'Unable to send ntfy message, no server URL configured.' => 'ntfy-Nachricht kann nicht gesendet werden, keine Server-URL konfiguriert.',
    'Unable to send ntfy message, no topic specified.'       => 'ntfy-Nachricht kann nicht gesendet werden, kein Thema angegeben.',
    'ntfy POST failed with HTTP {status}: {reason}'          => 'ntfy-POST fehlgeschlagen mit HTTP {status}: {reason}',
    'ntfy POST failed: {reason}'                             => 'ntfy-POST fehlgeschlagen: {reason}',
    'Successfully sent ntfy message to topic "{topic}".'     => 'ntfy-Nachricht erfolgreich an Thema "{topic}" gesendet.',

    // Outbound: Slack log messages
    'Unable to send Slack message, no webhook URL.' => 'Slack-Nachricht kann nicht gesendet werden, keine Webhook-URL.',
    'Unable to send Slack message, webhook URL is not valid.' => 'Slack-Nachricht kann nicht gesendet werden, Webhook-URL ist ungültig.',
    'Unable to send Slack message, body is empty.'  => 'Slack-Nachricht kann nicht gesendet werden, der Text ist leer.',
    'Slack POST failed (HTTP {status}): {reason}'   => 'Slack-POST fehlgeschlagen (HTTP {status}): {reason}',
    'Slack POST failed: {reason}'                   => 'Slack-POST fehlgeschlagen: {reason}',
    'Successfully sent Slack message to "{label}".' => 'Slack-Nachricht erfolgreich an "{label}" gesendet.',

    // Outbound: Bluesky log messages
    'Unable to send Bluesky post, recipient is missing credentials.' => 'Bluesky-Beitrag kann nicht gesendet werden, Empfänger fehlen Zugangsdaten.',
    'Body exceeded {max} characters, truncated.'          => 'Text überschritt {max} Zeichen und wurde gekürzt.',
    'Successfully posted to Bluesky as "{label}".'        => 'Erfolgreich als "{label}" auf Bluesky veröffentlicht.',
    'Bluesky auth failed for {handle}: {reason}'          => 'Bluesky-Authentifizierung fehlgeschlagen für {handle}: {reason}',
    'Bluesky auth failed: {reason}'                       => 'Bluesky-Authentifizierung fehlgeschlagen: {reason}',
    'Bluesky post failed: {reason}'                       => 'Bluesky-Beitrag fehlgeschlagen: {reason}',
    'Bluesky link preview skipped: {reason}'              => 'Bluesky-Linkvorschau übersprungen: {reason}',

    // Recipient-strategy warnings
    'Recipient "{name}" has no email address.'       => 'Empfänger "{name}" hat keine E-Mail-Adresse.',
    'Recipient "{name}" has no phone number.'        => 'Empfänger "{name}" hat keine Telefonnummer.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => 'Empfänger "{name}" hat keinen zugeordneten Benutzer; Ankündigung kann nicht gesendet werden.',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => 'Empfänger "{name}" hat keinen Zugriff auf das Control Panel; Ankündigung kann nicht gesendet werden.',
    'Pushover user-key field is not configured on this notification.' => 'Das Pushover-Benutzerschlüsselfeld ist für diese Benachrichtigung nicht konfiguriert.',
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => 'Empfänger "{name}" hat keinen zugeordneten Benutzer; Pushover-Nachricht kann nicht gesendet werden.',
    '[SKIPPED] User "{name}" has no Pushover key.'   => '[ÜBERSPRUNGEN] Benutzer "{name}" hat keinen Pushover-Schlüssel.',
    'Recipient "{name}" has no ntfy topic.'          => 'Empfänger "{name}" hat kein ntfy-Thema.',
    'Recipient "{name}" has no Slack webhook URL.'   => 'Empfänger "{name}" hat keine Slack-Webhook-URL.',
    'Recipient "{name}" has no Bluesky credentials.' => 'Empfänger "{name}" hat keine Bluesky-Zugangsdaten.',

    // Errors / exceptions
    'Invalid element event: {class}'                         => 'Ungültiges Element-Ereignis: {class}',
    'Invalid notification ID: {id}'                          => 'Ungültige Benachrichtigungs-ID: {id}',
    'Invalid email message mode.'                            => 'Ungültiger E-Mail-Nachrichtenmodus.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Sie haben keine Berechtigung, den Typ Dynamische Empfänger zu verwenden.',
    'Dynamic recipients snippet did not call setRecipients.' => 'Das Snippet für dynamische Empfänger hat setRecipients nicht aufgerufen.',
    'setRecipients was called with an empty value.'          => 'setRecipients wurde mit einem leeren Wert aufgerufen.',
    'Unrecognized recipient of type "{type}".'               => 'Unbekannter Empfänger vom Typ "{type}".',
    'Unrecognized recipient "{value}".'                      => 'Unbekannter Empfänger "{value}".',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => 'Konfiguriertes {kind} existiert nicht mehr in den Plug-in-Einstellungen (uid: {uid}).',
    'Invalid settings section: {section}'                    => 'Ungültiger Einstellungsabschnitt: {section}',
    'User not authorized to save this notification.'         => 'Benutzer ist nicht berechtigt, diese Benachrichtigung zu speichern.',
    'User not authorized to view this notification.'         => 'Benutzer ist nicht berechtigt, diese Benachrichtigung anzuzeigen.',
    'User not authorized to delete this notification.'       => 'Benutzer ist nicht berechtigt, diese Benachrichtigung zu löschen.',
    'Notification not found'                                 => 'Benachrichtigung nicht gefunden',

    // Misc config-file note
    'This is being set in the config file. [{file}]' => 'Dies wird in der Konfigurationsdatei festgelegt. [{file}]',

    // Slack, ntfy, and Bluesky message types
    "Add the Bluesky accounts you'd like to post from. Each account becomes available as a recipient on the **Recipients** tab when configuring a notification." => 'Fügen Sie die Bluesky-Konten hinzu, von denen Sie posten möchten. Jedes Konto wird beim Konfigurieren einer Benachrichtigung als Empfänger auf dem Tab **Empfänger** verfügbar.',
    "Click any row's **Test** button to confirm the account authenticates." => 'Klicken Sie auf die Schaltfläche **Test** einer beliebigen Zeile, um zu bestätigen, dass sich das Konto authentifiziert.',
    "Add an [Incoming Webhook](https://api.slack.com/messaging/webhooks) for each Slack channel you'd like to post into. Each webhook becomes available as a recipient on the **Recipients** tab when configuring a notification. A webhook URL is a secret, so store it in a `.env` variable and reference that variable (e.g. `\$SLACK_WEBHOOK_URL`) rather than pasting the URL directly." => 'Fügen Sie für jeden Slack-Kanal, in den Sie posten möchten, einen [Incoming Webhook](https://api.slack.com/messaging/webhooks) hinzu. Jeder Webhook wird beim Konfigurieren einer Benachrichtigung als Empfänger auf dem Tab **Empfänger** verfügbar. Eine Webhook-URL ist ein Geheimnis, speichern Sie sie daher in einer `.env`-Variable und verweisen Sie auf diese Variable (z. B. `$SLACK_WEBHOOK_URL`), anstatt die URL direkt einzufügen.',
    "Click any row's **Test** button to send a quick test message to that channel." => 'Klicken Sie auf die Schaltfläche **Test** einer beliebigen Zeile, um eine schnelle Testnachricht an diesen Kanal zu senden.',
    "Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`." => 'Optional, verweisen Sie auf eine selbst gehostete ntfy-Instanz (falls zutreffend). Standard ist `https://ntfy.sh`.',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Optional, erforderlich für geschützte Themen oder selbst gehostete Instanzen mit Authentifizierung.',
    "Add the ntfy topics you'd like to send messages to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification." => 'Fügen Sie die ntfy-Themen hinzu, an die Sie Nachrichten senden möchten. Jedes Thema wird beim Konfigurieren einer Benachrichtigung als Empfänger auf dem Tab **Empfänger** verfügbar.',
    "Click any row's **Test** button to send a quick test message to that topic." => 'Klicken Sie auf die Schaltfläche **Test** einer beliebigen Zeile, um eine schnelle Testnachricht an dieses Thema zu senden.',
    'Enable Markdown' => 'Markdown aktivieren',
    'Link URL' => 'Link-URL',
    'Not a valid Webhook URL. Must start with https://hooks.slack.com/services/' => 'Keine gültige Webhook-URL. Muss mit https://hooks.slack.com/services/ beginnen.',
];
