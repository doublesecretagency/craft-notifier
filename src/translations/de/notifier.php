<?php
/**
 * Notifier plugin for Craft CMS
 *
 * First-class Notifications for Craft CMS.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

return [

    // ============================================================
    // PLUGIN & PERMISSIONS
    // ============================================================

    // Plugin & navigation
    'Notifier' => 'Notifier',
    'Notifications' => 'Benachrichtigungen',
    'Notification' => 'Benachrichtigung',
    'All notifications' => 'Alle Benachrichtigungen',
    'Notification Log' => 'Benachrichtigungsprotokoll',
    'Logs' => 'Protokolle',
    'View Notifications' => 'Benachrichtigungen anzeigen',
    'Add a New Notification' => 'Neue Benachrichtigung hinzufügen',
    'notification' => 'Benachrichtigung',

    // Permissions
    'View notifications' => 'Benachrichtigungen anzeigen',
    'Save notifications' => 'Benachrichtigungen speichern',
    'Use the Dynamic Recipients type' => 'Den Typ Dynamische Empfänger verwenden',
    'Use the Dynamic Data type' => 'Den Typ Dynamische Daten verwenden',
    'Test notifications' => 'Benachrichtigungen testen',
    'Send manual notifications' => 'Manuelle Benachrichtigungen senden',
    'Delete notifications' => 'Benachrichtigungen löschen',
    'View notification log' => 'Benachrichtigungsprotokoll anzeigen',
    'Delete notification log' => 'Benachrichtigungsprotokoll löschen',

    // ============================================================
    // NOTIFICATION EDITOR
    // ============================================================

    // Editor: tabs
    'Meta' => 'Meta',
    'Event' => 'Ereignis',
    'Message' => 'Nachricht',
    'Recipients' => 'Empfänger',

    // Event tab: type selector
    'Event Type' => 'Ereignistyp',
    'What type of event will activate the notification?' => 'Welche Art von Ereignis löst die Benachrichtigung aus?',
    'Which specific event will activate the notification?' => 'Welches konkrete Ereignis löst die Benachrichtigung aus?',

    // Event tab: event types
    'Assets Event' => 'Asset-Ereignis',
    'Commerce Orders Event' => 'Commerce-Bestellungsereignis',
    'Commerce Products Event' => 'Commerce-Produktereignis',
    'Digital Products Event' => 'Digital Products-Ereignis',
    'Digital Product Licenses Event' => 'Digital Products-Lizenzereignis',
    'Solspace Calendar Event' => 'Solspace Calendar-Ereignis',
    'Entries Event' => 'Eintragsereignis',
    'Users Event' => 'Benutzerereignis',
    'Ungrouped Users' => 'Benutzer ohne Gruppe',

    // Event tab: Feed
    'Feed URL' => 'Feed-URL',
    'The URL of the RSS, Atom, or JSON feed to watch.' => 'Die URL des zu überwachenden RSS-, Atom- oder JSON-Feeds.',

    // Event tab: field conditions
    'Field Conditions' => 'Feldbedingungen',
    'Send the message only when the saved element matches the following conditions.' => 'Die Nachricht nur senden, wenn das gespeicherte Element die folgenden Bedingungen erfüllt.',
    'has changed' => 'wurde geändert',

    // Event tab: element filters (panel chrome + common output)
    '#{elementType} Event Filters' => 'Ereignisfilter für #{elementType}',
    'No filters match this event.' => 'Keine Filter passen zu diesem Ereignis.',
    'Determine whether each message should be sent based on specified conditions.' => 'Bestimmen Sie anhand festgelegter Bedingungen, ob die jeweilige Nachricht gesendet werden soll.',
    'Unnamed filter' => 'Unbenannter Filter',
    'Must be TRUE to send message' => 'Muss TRUE sein, um die Nachricht zu senden',
    'Must be FALSE to send message' => 'Muss FALSE sein, um die Nachricht zu senden',
    'No effect' => 'Keine Wirkung',

    // Event tab: element filter rules
    'Element is being saved for the first time' => 'Das Element wird zum ersten Mal gespeichert',
    'Must be a new entry' => 'Muss ein neuer Eintrag sein',
    'Must be an existing entry' => 'Muss ein vorhandener Eintrag sein',
    'Can be existing or new' => 'Kann vorhanden oder neu sein',
    'Element is new' => 'Das Element ist neu',
    'New elements only' => 'Nur neue Elemente',
    'Existing elements only' => 'Nur vorhandene Elemente',
    'Element is enabled' => 'Das Element ist aktiviert',
    'Must be enabled' => 'Muss aktiviert sein',
    'Must be disabled' => 'Muss deaktiviert sein',
    'Can be enabled or disabled' => 'Kann aktiviert oder deaktiviert sein',
    'Element is a draft' => 'Das Element ist ein Entwurf',
    'Must be a draft' => 'Muss ein Entwurf sein',
    'Must not be a draft' => 'Darf kein Entwurf sein',
    'Can be a draft or non-draft' => 'Kann Entwurf oder kein Entwurf sein',
    'Element is a provisional draft' => 'Das Element ist ein provisorischer Entwurf',
    'Must be a provisional draft' => 'Muss ein provisorischer Entwurf sein',
    'Must not be a provisional draft' => 'Darf kein provisorischer Entwurf sein',
    'Can be a provisional draft or non-provisional' => 'Kann provisorischer Entwurf oder regulär sein',
    'Element is a revision' => 'Das Element ist eine Revision',
    'Must be a revision' => 'Muss eine Revision sein',
    'Must not be a revision' => 'Darf keine Revision sein',
    'Can be a revision or non-revision' => 'Kann Revision oder keine Revision sein',
    'Element is being duplicated' => 'Das Element wird dupliziert',
    'Must be duplicating the element' => 'Das Element muss dupliziert werden',
    'Must not be duplicating the element' => 'Das Element darf nicht dupliziert werden',
    'Element is being propagated' => 'Das Element wird propagiert',
    'Element must be propagating' => 'Das Element muss propagiert werden',
    'Element must not be propagating' => 'Das Element darf nicht propagiert werden',
    'Element is being bulk-resaved' => 'Das Element wird im Stapel neu gespeichert',
    'Must be bulk-resaving the element' => 'Das Element muss im Stapel neu gespeichert werden',
    'Must not be bulk-resaving the element' => 'Das Element darf nicht im Stapel neu gespeichert werden',

    // Event tab: date trigger
    'On' => 'Am',
    'days before' => 'Tage vorher',
    'days after' => 'Tage danach',
    'Relevant Date' => 'Relevantes Datum',
    'Send the notification relative to a chosen date.' => 'Senden Sie die Benachrichtigung relativ zu einem ausgewählten Datum.',

    // Event tab: recurring schedule
    'Every' => 'Alle',
    'on' => 'am',
    'on day' => 'am Tag',
    'at' => 'um',
    'Starting on' => 'Beginnend am',
    'Day' => 'Tag',
    'Date' => 'Datum',
    'Time' => 'Uhrzeit',
    'day(s)' => 'Tag(e)',
    'week(s)' => 'Woche(n)',
    'month(s)' => 'Monat(e)',
    'year(s)' => 'Jahr(e)',
    'day' => 'Tag',
    'days' => 'Tage',
    'week' => 'Woche',
    'weeks' => 'Wochen',
    'month' => 'Monat',
    'months' => 'Monate',
    'year' => 'Jahr',
    'years' => 'Jahre',
    'Manual only' => 'Nur manuell',
    'Scheduled sending' => 'Geplanter Versand',
    'On a recurring schedule' => 'Nach einem wiederkehrenden Zeitplan',
    'On demand' => 'Bei Bedarf',
    'Send on a Recurring Schedule' => 'Nach einem wiederkehrenden Zeitplan senden',
    'Configure Recurring Schedule' => 'Wiederkehrenden Zeitplan konfigurieren',
    'System timezone set to {timezone}' => 'Systemzeitzone ist auf {timezone} eingestellt',
    'Notifications will be sent on the following schedule...' => 'Benachrichtigungen werden nach folgendem Zeitplan gesendet...',
    '... and every {cadence} after that.' => '... und danach alle {cadence}.',
    'On what recurring schedule should the notification be sent?' => 'Nach welchem wiederkehrenden Zeitplan soll die Benachrichtigung gesendet werden?',
    'Whether the message should be sent on a schedule, or only triggered manually.' => 'Ob die Nachricht nach einem Zeitplan gesendet oder nur manuell ausgelöst wird.',
    'The message can always be sent using the "Send system snapshot" button above.' => 'Die Nachricht kann jederzeit über die Schaltfläche „System-Snapshot senden“ oben gesendet werden.',
    'The message can always be sent using the "Send data report" button above.' => 'Die Nachricht kann jederzeit über die Schaltfläche „Datenbericht senden“ oben gesendet werden.',

    // Event tab: Dynamic Data snippet field
    'Twig Snippet to Determine Data' => 'Twig-Snippet zur Bestimmung der Daten',
    'Enter a custom Twig snippet to [determine which data will be included]({url}).' => 'Geben Sie ein eigenes Twig-Snippet ein, um [zu bestimmen, welche Daten einbezogen werden]({url}).',
    'The snippet **must** include a `{% setData %}` tag.' => 'Das Snippet **muss** ein `{% setData %}`-Tag enthalten.',
    'You do not have permission to edit dynamic data.' => 'Sie haben keine Berechtigung, dynamische Daten zu bearbeiten.',

    // Event tab: manual trigger
    'Trigger Label' => 'Bezeichnung des Auslösers',
    'An element action label (helps to differentiate multiple triggers).' => 'Eine Bezeichnung für die Elementaktion (hilft, mehrere Auslöser zu unterscheiden).',
    'Send Notification' => 'Benachrichtigung senden',

    // Message tab: type selector
    'Message Type' => 'Nachrichtentyp',
    'What type of message will be sent?' => 'Welche Art von Nachricht wird gesendet?',
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are also supported.' => '[Templating]({templatingUrl}) und [spezielle Variablen]({variablesUrl}) werden ebenfalls unterstützt.',

    // Details sidebar: queue
    'Use Queue' => 'Warteschlange verwenden',
    'Immediate' => 'Sofort',
    'Queue' => 'Warteschlange',
    'jobs queue' => 'Aufgabenwarteschlange',
    'Whether the message will be sent immediately, or added to the {link}.' => 'Ob die Nachricht sofort gesendet oder zur {link} hinzugefügt wird.',
    'Flash messages never use the queue.' => 'Flash-Nachrichten verwenden nie die Warteschlange.',
    'Announcements always use the queue.' => 'Ankündigungen verwenden immer die Warteschlange.',

    // Message tab: Email
    "User's Email Address Field" => 'Benutzerfeld für E-Mail-Adresse',
    'Select which User field contains the recipient\'s email address.' => 'Wählen Sie das Benutzerfeld, das die E-Mail-Adresse des Empfängers enthält.',
    'Email Subject' => 'E-Mail-Betreff',
    'Subject line of the email.' => 'Betreffzeile der E-Mail.',
    'Dynamic Subject Line' => 'Dynamische Betreffzeile',
    'Email Body' => 'E-Mail-Text',
    'Body of the email. Supports HTML.' => 'Inhalt der E-Mail. Unterstützt HTML.',

    // Message tab: rich-text (Trix) toolbar
    'Rich Text' => 'Rich Text',
    'Bold' => 'Fett',
    'Italic' => 'Kursiv',
    'Underline' => 'Unterstrichen',
    'Strikethrough' => 'Durchgestrichen',
    'Bullets' => 'Aufzählung',
    'Numbers' => 'Nummerierung',
    'Heading' => 'Überschrift',
    'Code' => 'Code',
    'Undo' => 'Rückgängig',
    'Redo' => 'Wiederholen',

    // Message tab: SMS
    "User's Phone Number Field" => 'Benutzerfeld für Telefonnummer',
    'Select which User field contains the recipient\'s phone number.' => 'Wählen Sie das Benutzerfeld, das die Telefonnummer des Empfängers enthält.',
    'SMS Message Body' => 'SMS-Nachrichtentext',
    'Body of the SMS (text message). Plain text only.' => 'Inhalt der SMS (Textnachricht). Nur Klartext.',

    // Message tab: Announcement
    'Announcement Title' => 'Ankündigungstitel',
    'Heading of the announcement.' => 'Überschrift der Ankündigung.',
    'Dynamic Announcement Title' => 'Dynamischer Ankündigungstitel',
    'Announcement Message' => 'Ankündigungstext',
    'Body of the announcement. Supports Markdown.' => 'Inhalt der Ankündigung. Unterstützt Markdown.',

    // Message tab: Flash
    'Flash Message Type' => 'Flash-Nachrichtentyp',
    'Which type of flash message should appear?' => 'Welche Art von Flash-Nachricht soll erscheinen?',
    'Flash Message Title' => 'Flash-Nachrichtentitel',
    'Heading of the flash message.' => 'Überschrift der Flash-Nachricht.',
    'Dynamic Flash Message Title' => 'Dynamischer Flash-Titel',
    'Flash Message Details' => 'Flash-Nachrichtendetails',
    'Optionally include details below the heading. Supports Markdown and HTML.' => 'Optional Details unter der Überschrift einfügen. Unterstützt Markdown und HTML.',

    // Message tab: Pushover
    "Field containing each user's Pushover key" => 'Pushover-Schlüsselfeld des Benutzers',
    'Select which User field contains the recipient\'s Pushover user key.' => 'Wählen Sie das Benutzerfeld, das den Pushover-Schlüssel des Empfängers enthält.',
    'Pushover Title' => 'Pushover-Titel',
    'Optionally include a heading above the body.' => 'Optional eine Überschrift über dem Inhalt einfügen.',
    'Dynamic Pushover Title' => 'Dynamischer Pushover-Titel',
    'Pushover Body' => 'Pushover-Text',
    'Body of the Pushover notification. Plain text only.' => 'Inhalt der Pushover-Benachrichtigung. Nur Klartext.',

    // Message tab: ntfy
    'Priority' => 'Priorität',
    'Priority level of the ntfy message.' => 'Prioritätsstufe der ntfy-Nachricht.',
    'Tags' => 'Tags',
    'Optionally include comma-separated [emoji shortcodes](https://docs.ntfy.sh/emojis/).' => 'Optional kommagetrennte [Emoji-Codes](https://docs.ntfy.sh/emojis/) angeben.',
    'ntfy Title' => 'ntfy-Titel',
    'Dynamic ntfy Title' => 'Dynamischer ntfy-Titel',
    'ntfy Body' => 'ntfy-Text',
    'Body of the ntfy notification.' => 'Inhalt der ntfy-Benachrichtigung.',
    'ntfy Link URL' => 'ntfy-Link-URL',
    'Optionally open a URL when the notification is clicked.' => 'Optional eine URL öffnen, wenn die Benachrichtigung angeklickt wird.',
    'Enable Markdown' => 'Markdown aktivieren',
    'Whether to parse the body as Markdown in supported clients.' => 'Ob der Inhalt in unterstützten Clients als Markdown gerendert wird.',
    'Regular text only' => 'Nur normaler Text',
    'Markdown enabled' => 'Markdown aktiviert',

    // Message tab: Slack
    'Slack Message Body' => 'Slack-Nachrichtentext',
    'Supports standard [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) syntax. Optionally supports HTML _(see below)_.' => 'Unterstützt die standardmäßige [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting)-Syntax. Unterstützt optional HTML _(siehe unten)_.',
    'Render Message Body as HTML' => 'Nachrichteninhalt als HTML rendern',
    'Whether to only parse as [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), or additionally parse it as HTML.' => 'Ob nur als [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) verarbeitet werden soll oder zusätzlich als HTML.',
    'mrkdwn only' => 'nur mrkdwn',
    'mrkdwn + HTML' => 'mrkdwn + HTML',
    'Render Link Previews' => 'Linkvorschauen anzeigen',
    'Whether Slack should unfurl link previews for URLs in the message body.' => 'Ob Slack Linkvorschauen für URLs im Nachrichtentext anzeigen soll.',
    'Don\'t unfurl' => 'Nicht entfalten',
    'Expand link previews' => 'Linkvorschauen anzeigen',
    'Bot Name' => 'Benutzername',
    'Optionally override the app\'s display name.' => 'Optional den Anzeigenamen der App überschreiben.',
    'Dynamic Bot Name' => 'Dynamischer Bot-Name',
    'Bot Icon URL' => 'Symbol-URL',
    'Optionally override the app\'s icon with a URL.' => 'Optional das App-Symbol per URL überschreiben.',
    'Bot Emoji' => 'Symbol-Emoji',
    'Optionally override the app\'s icon with an emoji. Used only when Bot Icon URL is empty.' => 'Optional das App-Symbol per Emoji überschreiben. Wird nur verwendet, wenn Bot Icon URL leer ist.',

    // Message tab: Bluesky
    'Post Body' => 'Beitragstext',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => 'Klartext, maximal 300 Zeichen. URLs und `@handle.tld`-Erwähnungen werden automatisch verlinkt.',
    'Generate Link Preview' => 'Linkvorschau erzeugen',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => 'Automatisch eine Vorschaukarte generieren, wenn der Beitragstext eine URL enthält.',
    'No card' => 'Keine Karte',
    'Generate preview card' => 'Vorschaukarte erzeugen',

    // Recipients tab: type selector & user/group pickers
    'Recipients Type' => 'Empfängertyp',
    'Who will receive this message?' => 'Wer soll diese Nachricht erhalten?',
    'Add a message recipient' => 'Empfänger hinzufügen',
    'Select User(s)' => 'Benutzer auswählen',
    'Which users will receive the message?' => 'Welche Benutzer sollen die Nachricht erhalten?',
    'Which user groups will receive the message?' => 'Welche Benutzergruppen sollen die Nachricht erhalten?',

    // Recipients tab: channel pickers (Slack / ntfy / Bluesky)
    'Select Slack channel(s)' => 'Slack-Kanal/Kanäle auswählen',
    'Which Slack channels should receive this message?' => 'Welche Slack-Kanäle sollen diese Nachricht erhalten?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Keine Slack-Kanäle konfiguriert. Fügen Sie einen unter [Einstellungen → Slack]({url}) hinzu.',
    'Select ntfy topic(s)' => 'ntfy-Thema/Themen auswählen',
    'Which ntfy topics should receive this message?' => 'Welche ntfy-Themen sollen diese Nachricht erhalten?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'Keine ntfy-Themen konfiguriert. Fügen Sie eines unter [Einstellungen → ntfy]({url}) hinzu.',
    'Select Bluesky account(s)' => 'Bluesky-Konto/Konten auswählen',
    'Which Bluesky accounts should post this message?' => 'Welche Bluesky-Konten sollen diese Nachricht veröffentlichen?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Keine Bluesky-Konten konfiguriert. Fügen Sie eines unter [Einstellungen → Bluesky]({url}) hinzu.',

    // Recipients tab: dynamic recipients snippet
    'Twig Snippet to Determine Recipients' => 'Twig-Snippet zur Bestimmung der Empfänger',
    'Enter a custom Twig snippet to [determine who will receive the message]({url}).' => 'Geben Sie ein eigenes Twig-Snippet ein, um [zu bestimmen, wer die Nachricht erhält]({url}).',
    'The snippet **must** include a `{% setRecipients %}` tag.' => 'Das Snippet **muss** ein `{% setRecipients %}`-Tag enthalten.',

    // ============================================================
    // SETTINGS
    // ============================================================

    // Settings: nav & page chrome
    'Notifier Settings' => 'Notifier-Einstellungen',
    'General' => 'Allgemein',
    'Twilio' => 'Twilio',
    'Pushover' => 'Pushover',
    'Slack' => 'Slack',
    'Bluesky' => 'Bluesky',
    'ntfy' => 'ntfy',

    // Settings: Logging
    'Logging' => 'Protokollierung',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier führt ein fortlaufendes Protokoll der gesendeten Nachrichten. Normalerweise nicht erforderlich, aber Sie können die Anzahl der in der Datenbank gespeicherten Protokollereignisse begrenzen.',
    'Enable Logging' => 'Protokollierung aktivieren',
    'When disabled, Notifier will not write anything to the notification log.' => 'Bei Deaktivierung schreibt Notifier nichts in das Benachrichtigungsprotokoll.',
    'Number of days to retain log events' => 'Anzahl der Tage, an denen Protokollereignisse aufbewahrt werden',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Protokollereignisse höchstens so viele Tage aufbewahren. Leer lassen für kein Limit.',
    'Number of log events to retain' => 'Anzahl der zu behaltenden Protokollereignisse',
    'At most, keep this many log events. Leave blank for no limit.' => 'Höchstens diese Anzahl an Protokollereignissen behalten. Leer lassen für kein Limit.',

    // Settings: Scheduled sending
    'Scheduled Sending' => 'Geplanter Versand',
    'Shared secret for authenticating scheduled-run web requests. Required only when the schedule is triggered via the web endpoint.' => 'Geteiltes Geheimnis zur Authentifizierung von Web-Anfragen für die geplante Ausführung. Nur erforderlich, wenn der Zeitplan über den Web-Endpunkt ausgelöst wird.',
    'Scheduled-Run Token' => 'Token für geplante Ausführung',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => 'Wird bei jeder Anfrage als X-Notifier-Token-Header oder als token-Body-Parameter gesendet.',

    // Settings: Twilio
    'Twilio API Credentials' => 'Twilio-API-Zugangsdaten',
    'If using the Twilio API to send SMS messages, the following credentials are required.' => 'Wenn die Twilio-API zum Versenden von SMS-Nachrichten verwendet wird, sind die folgenden Zugangsdaten erforderlich.',
    'Twilio Account SID' => 'Twilio Account SID',
    'Twilio Auth Token' => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)' => 'Twilio-Telefonnummer (versendet jede SMS-Nachricht)',
    'SMS Testing' => 'SMS-Test',
    'Optional. When set, every SMS dispatched will be sent to this number instead of the resolved recipient.' => 'Optional. Wenn gesetzt, wird jede gesendete SMS an diese Nummer statt an den ursprünglichen Empfänger zugestellt.',
    'Test phone number' => 'Test-Telefonnummer',

    // Settings: Pushover
    "[Pushover](https://pushover.net) sends push notifications to a registered user's devices. Each Craft user needs a custom field on their profile storing their Pushover user key; you select which field on each Notification's Message tab. For full setup instructions, see the [Pushover getting-started docs](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover)." => '[Pushover](https://pushover.net) sendet Push-Benachrichtigungen an die Geräte eines registrierten Benutzers. Jeder Craft-Benutzer benötigt ein benutzerdefiniertes Feld auf seinem Profil, das den Pushover-Schlüssel speichert. Sie wählen das Feld auf dem Tab Nachricht jeder Benachrichtigung aus. Vollständige Einrichtungsanweisungen finden Sie in der [Pushover-Einstiegsdokumentation](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover).',
    'Application API Token' => 'Anwendungs-API-Token',
    'The 30-character app token from your Pushover application.' => 'Das 30-stellige App-Token aus Ihrer Pushover-Anwendung.',

    // Settings: ntfy
    'ntfy.sh is a free HTTP-based push notification service. Subscribers receive messages on the ntfy app, web, or any compatible client by joining a topic.' => 'ntfy.sh ist ein kostenloser HTTP-basierter Push-Benachrichtigungsdienst. Abonnenten erhalten Nachrichten in der ntfy-App, im Web oder über jeden kompatiblen Client, indem sie einem Thema beitreten.',
    'Server URL' => 'Server-URL',
    "Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`." => 'Optional, verweisen Sie auf eine selbst gehostete ntfy-Instanz (falls zutreffend). Standard ist `https://ntfy.sh`.',
    'Access token' => 'Zugriffstoken',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Optional, erforderlich für geschützte Themen oder selbst gehostete Instanzen mit Authentifizierung.',
    'ntfy Topics' => 'ntfy-Themen',
    "Add the ntfy topics you'd like to send messages to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification." => 'Fügen Sie die ntfy-Themen hinzu, an die Sie Nachrichten senden möchten. Jedes Thema wird beim Konfigurieren einer Benachrichtigung als Empfänger auf dem Tab **Empfänger** verfügbar.',
    'Topics' => 'Themen',
    "Click any row's **Test** button to send a quick test message to that topic." => 'Klicken Sie auf die Schaltfläche **Test** einer beliebigen Zeile, um eine schnelle Testnachricht an dieses Thema zu senden.',
    'Label' => 'Bezeichnung',
    'Topic' => 'Thema',
    'Add a topic' => 'Thema hinzufügen',

    // Settings: Slack
    'Slack Channels' => 'Slack-Kanäle',
    'Create a [Slack app](https://api.slack.com/apps) with the `chat:write`, `chat:write.customize`, and `chat:write.public` scopes, then add a row for each channel you\'d like to post into. Each channel becomes available as a recipient on the **Recipients** tab when configuring a notification. A bot token is a secret, so store it in a `.env` variable and reference that variable (e.g. `$SLACK_BOT_TOKEN`) rather than pasting the token directly.' => 'Erstellen Sie eine [Slack-App](https://api.slack.com/apps) mit den Scopes `chat:write`, `chat:write.customize` und `chat:write.public`, und fügen Sie dann für jeden Kanal, in den Sie posten möchten, eine Zeile hinzu. Jeder Kanal wird auf der **Empfänger**-Registerkarte beim Konfigurieren einer Benachrichtigung als Empfänger verfügbar. Ein Bot-Token ist ein Geheimnis, daher sollten Sie es in einer `.env`-Variable speichern und auf diese Variable verweisen (z. B. `$SLACK_BOT_TOKEN`), anstatt das Token direkt einzufügen.',
    'Channels' => 'Kanäle',
    "Click any row's **Test** button to send a quick test message to that channel." => 'Klicken Sie auf die Schaltfläche **Test** einer beliebigen Zeile, um eine schnelle Testnachricht an diesen Kanal zu senden.',
    'Bot Token' => 'Bot-Token',
    'Channel ID' => 'Kanal-ID',
    'Add a channel' => 'Kanal hinzufügen',
    'Not a valid Bot Token. Must start with `xoxb-`.' => 'Kein gültiges Bot-Token. Muss mit `xoxb-` beginnen.',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => 'Keine gültige Kanal-ID. Muss wie `C01234ABCD` aussehen.',

    // Settings: Bluesky
    "[Bluesky](https://bsky.app) posts publish to the configured account's feed via the ATProto API. App passwords are generated at [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). An app password is a secret, so store it in a `.env` variable and reference that variable (e.g. `\$BLUESKY_APP_PASSWORD`) rather than pasting the password directly." => '[Bluesky](https://bsky.app)-Beiträge werden über die ATProto-API im Feed des konfigurierten Kontos veröffentlicht. App-Passwörter werden unter [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords) erstellt. Ein App-Passwort ist ein Geheimnis, speichern Sie es daher in einer `.env`-Variable und verweisen Sie auf diese Variable (z. B. `$BLUESKY_APP_PASSWORD`), anstatt das Passwort direkt einzufügen.',
    'PDS URL' => 'PDS-URL',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'Standard ist https://bsky.social. Verweisen Sie auf eine eigene PDS, falls Ihre Installation föderiert.',
    'Bluesky Accounts' => 'Bluesky-Konten',
    "Add the Bluesky accounts you'd like to post from. Each account becomes available as a recipient on the **Recipients** tab when configuring a notification." => 'Fügen Sie die Bluesky-Konten hinzu, von denen Sie posten möchten. Jedes Konto wird beim Konfigurieren einer Benachrichtigung als Empfänger auf dem Tab **Empfänger** verfügbar.',
    'Accounts' => 'Konten',
    "Click any row's **Test** button to confirm the account authenticates." => 'Klicken Sie auf die Schaltfläche **Test** einer beliebigen Zeile, um zu bestätigen, dass sich das Konto authentifiziert.',
    'Handle' => 'Handle',
    'App password' => 'App-Passwort',
    'Add an account' => 'Konto hinzufügen',

    // ============================================================
    // MANUAL SEND & TEST
    // ============================================================

    // Manual send & test
    'Send a test message' => 'Testnachricht senden',
    'Send a REAL test notification?\\n\\n⚠️ Uses a random sample of real data.\\n⚠️ Sends a real message via the configured channel.\\n⚠️ Delivers to the real configured recipient(s).' => 'ECHTE Testbenachrichtigung senden?\\n\\n⚠️ Verwendet eine zufällige Stichprobe echter Daten.\\n⚠️ Sendet eine echte Nachricht über den konfigurierten Kanal.\\n⚠️ Wird an die echten konfigurierten Empfänger zugestellt.',
    'Test' => 'Test',
    'Send system snapshot' => 'System-Snapshot senden',
    'Send data report' => 'Datenbericht senden',
    'Are you sure you want to send this notification?' => 'Möchten Sie diese Benachrichtigung wirklich senden?',
    'This notification cannot be triggered manually.' => 'Diese Benachrichtigung kann nicht manuell ausgelöst werden.',
    'This notification no longer applies to the selected element.' => 'Diese Benachrichtigung trifft auf das ausgewählte Element nicht mehr zu.',

    // ============================================================
    // RUNTIME OUTPUT
    // ============================================================

    // Runtime: dispatch log feedback
    'Sending {messageType} to {recipient}.' => 'Sende {messageType} an {recipient}.',
    'Adding message to queue.' => 'Nachricht zur Warteschlange hinzugefügt.',
    'Sending message immediately (bypassing queue).' => 'Nachricht wird sofort gesendet (Warteschlange wird umgangen).',
    'Unable to parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => 'Feed kann nicht verarbeitet werden. Die PHP-Erweiterungen `simplexml` und `libxml` sind erforderlich.',
    'Unable to parse the feed.' => 'Feed kann nicht verarbeitet werden.',
    'Unable to fetch the feed: {message}' => 'Feed kann nicht abgerufen werden: {message}',
    'Initial feed scan failed: {message}' => 'Erste Feed-Überprüfung fehlgeschlagen: {message}',

    // Runtime: controller responses
    'Test notification dispatched.' => 'Testbenachrichtigung gesendet.',
    'No messages were dispatched. Check the recipient configuration.' => 'Es wurden keine Nachrichten gesendet. Überprüfen Sie die Empfängerkonfiguration.',
    'Unable to send test: the feed could not be read or has no items.' => 'Test kann nicht gesendet werden: Der Feed konnte nicht gelesen werden oder enthält keine Elemente.',
    'Unable to send test: no element matches the configured filters.' => 'Test kann nicht gesendet werden: Kein Element entspricht den konfigurierten Filtern.',
    "Couldn't save settings." => 'Einstellungen konnten nicht gespeichert werden.',
    'Settings saved.' => 'Einstellungen gespeichert.',
    'Topic is empty.' => 'Thema ist leer.',
    'Server URL is not configured.' => 'Server-URL ist nicht konfiguriert.',
    'Test message from Notifier.' => 'Testnachricht von Notifier.',
    'HTTP {status}' => 'HTTP {status}',
    'Test message sent successfully.' => 'Testnachricht erfolgreich gesendet.',
    'Handle and app password are required.' => 'Handle und App-Passwort sind erforderlich.',
    'Authentication failed.' => 'Authentifizierung fehlgeschlagen.',
    'Successfully authenticated. No messages were posted.' => 'Erfolgreich authentifiziert. Es wurden keine Nachrichten gepostet.',
    'Log events deleted.' => 'Protokollereignisse gelöscht.',
    'Notification sent.' => 'Benachrichtigung gesendet.',
    'Notification was not sent. Check the Notification Log for details.' => 'Benachrichtigung wurde nicht gesendet. Details finden Sie im Benachrichtigungsprotokoll.',

    // Outbound: per-channel send results
    'Unable to send email, no recipient specified.' => 'E-Mail kann nicht gesendet werden, kein Empfänger angegeben.',
    'Unable to send email, the message body was empty.' => 'E-Mail kann nicht gesendet werden, der Nachrichtentext war leer.',
    "Unable to send the email using Craft's native email handling." => 'Die E-Mail kann nicht über Crafts integrierte E-Mail-Verarbeitung gesendet werden.',
    'Check your general email settings within Craft.' => 'Überprüfen Sie Ihre allgemeinen E-Mail-Einstellungen in Craft.',
    'Successfully sent email message!' => 'E-Mail erfolgreich gesendet!',
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[Ungültige Twilio-Zugangsdaten.]({url}) Es fehlen {missing}.',
    'Unable to send SMS, no Twilio phone number exists.' => 'SMS kann nicht gesendet werden, keine Twilio-Telefonnummer vorhanden.',
    'Unable to send SMS, no recipient phone number exists.' => 'SMS kann nicht gesendet werden, keine Empfänger-Telefonnummer vorhanden.',
    'Unable to send SMS, recipient phone number is invalid.' => 'SMS kann nicht gesendet werden, die Telefonnummer des Empfängers ist ungültig.',
    'Successfully sent SMS message!' => 'SMS-Nachricht erfolgreich gesendet!',
    'Unable to post announcement, no recipient userId specified.' => 'Ankündigung kann nicht veröffentlicht werden: keine Empfänger-userId angegeben.',
    'Successfully posted announcement!' => 'Ankündigung erfolgreich veröffentlicht!',
    'Unable to send the flash message, invalid flash type.' => 'Flash-Nachricht kann nicht gesendet werden, ungültiger Flash-Typ.',
    'Successfully sent flash message!' => 'Flash-Nachricht erfolgreich gesendet!',
    '[Invalid Pushover credentials.]({url}) Missing app token.' => '[Ungültige Pushover-Zugangsdaten.]({url}) App-Token fehlt.',
    'Unable to send Pushover message, no user key on recipient.' => 'Pushover-Nachricht kann nicht gesendet werden, kein Benutzerschlüssel am Empfänger.',
    'Pushover POST failed: {reason}' => 'Pushover-POST fehlgeschlagen: {reason}',
    'Successfully sent Pushover message!' => 'Pushover-Nachricht erfolgreich gesendet!',
    'Unable to send ntfy message, no topic specified.' => 'ntfy-Nachricht kann nicht gesendet werden, kein Thema angegeben.',
    'ntfy POST failed with HTTP {status}: {reason}' => 'ntfy-POST fehlgeschlagen mit HTTP {status}: {reason}',
    'ntfy POST failed: {reason}' => 'ntfy-POST fehlgeschlagen: {reason}',
    'Successfully sent ntfy message to topic "{topic}".' => 'ntfy-Nachricht erfolgreich an Thema "{topic}" gesendet.',
    'Unable to send Slack message, no bot token.' => 'Slack-Nachricht kann nicht gesendet werden: kein Bot-Token.',
    'Unable to send Slack message, no channel ID.' => 'Slack-Nachricht kann nicht gesendet werden: keine Kanal-ID.',
    'Unable to send Slack message, body is empty.' => 'Slack-Nachricht kann nicht gesendet werden, der Text ist leer.',
    'Slack rejected the message: {error}' => 'Slack hat die Nachricht abgelehnt: {error}',
    'Slack POST failed: {reason}' => 'Slack-POST fehlgeschlagen: {reason}',
    'Successfully sent Slack message to "{label}".' => 'Slack-Nachricht erfolgreich an "{label}" gesendet.',
    'Unable to send Bluesky post, recipient is missing credentials.' => 'Bluesky-Beitrag kann nicht gesendet werden, Empfänger fehlen Zugangsdaten.',
    'Body exceeded {max} characters, truncated.' => 'Text überschritt {max} Zeichen und wurde gekürzt.',
    'Successfully posted to Bluesky as "{label}".' => 'Erfolgreich als "{label}" auf Bluesky veröffentlicht.',
    'Bluesky auth failed for {handle}: {reason}' => 'Bluesky-Authentifizierung fehlgeschlagen für {handle}: {reason}',
    'Bluesky auth failed: {reason}' => 'Bluesky-Authentifizierung fehlgeschlagen: {reason}',
    'Bluesky post failed: {reason}' => 'Bluesky-Beitrag fehlgeschlagen: {reason}',
    'Bluesky link preview skipped: {reason}' => 'Bluesky-Linkvorschau übersprungen: {reason}',

    // Recipient warnings
    'Recipient "{name}" has no email address.' => 'Empfänger "{name}" hat keine E-Mail-Adresse.',
    'Recipient "{name}" has no phone number.' => 'Empfänger "{name}" hat keine Telefonnummer.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => 'Empfänger "{name}" hat keinen zugeordneten Benutzer; Ankündigung kann nicht gesendet werden.',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => 'Empfänger "{name}" hat keinen Zugriff auf das Control Panel; Ankündigung kann nicht gesendet werden.',
    'Pushover user-key field is not configured on this notification.' => 'Das Pushover-Benutzerschlüsselfeld ist für diese Benachrichtigung nicht konfiguriert.',
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => 'Empfänger "{name}" hat keinen zugeordneten Benutzer; Pushover-Nachricht kann nicht gesendet werden.',
    '[SKIPPED] User "{name}" has no Pushover key.' => '[ÜBERSPRUNGEN] Benutzer "{name}" hat keinen Pushover-Schlüssel.',
    'Recipient "{name}" has no ntfy topic.' => 'Empfänger "{name}" hat kein ntfy-Thema.',
    'Recipient "{name}" has no Bluesky credentials.' => 'Empfänger "{name}" hat keine Bluesky-Zugangsdaten.',
    'Recipient "{name}" has no Slack bot token.' => 'Empfänger "{name}" hat kein Slack-Bot-Token.',
    'Recipient "{name}" has no Slack channel ID.' => 'Empfänger "{name}" hat keine Slack-Kanal-ID.',

    // Errors & exceptions
    'Invalid element event: {class}' => 'Ungültiges Element-Ereignis: {class}',
    'Invalid notification ID: {id}' => 'Ungültige Benachrichtigungs-ID: {id}',
    'Invalid email message mode.' => 'Ungültiger E-Mail-Nachrichtenmodus.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Sie haben keine Berechtigung, den Typ Dynamische Empfänger zu verwenden.',
    'Dynamic recipients snippet did not call setRecipients.' => 'Das Snippet für dynamische Empfänger hat setRecipients nicht aufgerufen.',
    'setRecipients was called with an empty value.' => 'setRecipients wurde mit einem leeren Wert aufgerufen.',
    'Unrecognized recipient of type "{type}".' => 'Unbekannter Empfänger vom Typ "{type}".',
    'Unrecognized recipient "{value}".' => 'Unbekannter Empfänger "{value}".',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => 'Konfiguriertes {kind} existiert nicht mehr in den Plug-in-Einstellungen (uid: {uid}).',
    'Invalid settings section: {section}' => 'Ungültiger Einstellungsabschnitt: {section}',
    'User not authorized to save this notification.' => 'Benutzer ist nicht berechtigt, diese Benachrichtigung zu speichern.',
    'User not authorized to view this notification.' => 'Benutzer ist nicht berechtigt, diese Benachrichtigung anzuzeigen.',
    'User not authorized to delete this notification.' => 'Benutzer ist nicht berechtigt, diese Benachrichtigung zu löschen.',
    'Notification not found' => 'Benachrichtigung nicht gefunden',
    'Element not found' => 'Element nicht gefunden',
    'You do not have permission to use the Dynamic Data type.' => 'Du hast keine Berechtigung, den Typ Dynamische Daten zu verwenden.',
    'The Dynamic Data snippet did not call the {tag} tag.' => 'Das Twig-Snippet hat das {tag}-Tag nicht aufgerufen.',
    'Invalid Slack body format.' => 'Ungültiges Slack-Inhaltsformat.',

    // Config-file override note
    'This is being set in the config file. [{file}]' => 'Dies wird in der Konfigurationsdatei festgelegt. [{file}]',

    // ============================================================
    // JAVASCRIPT UI
    // ============================================================

    // JavaScript: log utility & buttons
    'Test notification failed.' => 'Testbenachrichtigung fehlgeschlagen.',
    'Unable to get the notification, something went wrong.' => 'Die Benachrichtigung konnte nicht abgerufen werden, etwas ist schiefgelaufen.',
    'Something went wrong.' => 'Etwas ist schiefgelaufen.',
    'Invalid notification ID.' => 'Ungültige Benachrichtigungs-ID.',
    'Unable to delete the log event, something went wrong.' => 'Das Protokollereignis konnte nicht gelöscht werden, etwas ist schiefgelaufen.',
    'Log event deleted.' => 'Protokollereignis gelöscht.',
    'Unable to delete log events, something went wrong.' => 'Protokollereignisse konnten nicht gelöscht werden, etwas ist schiefgelaufen.',
    'Are you sure you want to delete this log event?' => 'Möchten Sie dieses Protokollereignis wirklich löschen?',
    'Are you sure you want to delete all logs from {date}?' => 'Möchten Sie wirklich alle Protokolle vom {date} löschen?',

    // ============================================================
    // MQTT
    // ============================================================

    'Recipient "{name}" has no MQTT topic.' => 'Empfänger "{name}" hat kein MQTT-Thema.',
    'Unable to send MQTT message, no broker host configured.' => 'MQTT-Nachricht kann nicht gesendet werden, kein Broker-Host konfiguriert.',
    'Unable to send MQTT message, no topic specified.' => 'MQTT-Nachricht kann nicht gesendet werden, kein Thema angegeben.',
    'Unable to send MQTT message, the payload is empty.' => 'MQTT-Nachricht kann nicht gesendet werden, der Inhalt ist leer.',
    'MQTT publish failed: {reason}' => 'MQTT-Veröffentlichung fehlgeschlagen: {reason}',
    'Successfully sent MQTT message to topic "{topic}".' => 'MQTT-Nachricht erfolgreich an Thema "{topic}" gesendet.',
    'MQTT Broker' => 'MQTT-Broker',
    'Notifier publishes to an MQTT broker (such as Mosquitto, EMQX, HiveMQ, or AWS IoT Core). Enter the broker connection details below. Sensitive values can be stored in a `.env` variable and referenced here (e.g. `$MQTT_PASSWORD`).' => 'Notifier veröffentlicht an einen MQTT-Broker (z. B. Mosquitto, EMQX, HiveMQ oder AWS IoT Core). Geben Sie unten die Verbindungsdaten des Brokers ein. Sensible Werte können in einer `.env`-Variable gespeichert und hier referenziert werden (z. B. `$MQTT_PASSWORD`).',
    'Host' => 'Host',
    'Broker hostname, without a protocol or port.' => 'Hostname des Brokers, ohne Protokoll oder Port.',
    'Port' => 'Port',
    'Optional. Defaults to 8883 when TLS is enabled, otherwise 1883.' => 'Optional. Standardmäßig 8883, wenn TLS aktiviert ist, andernfalls 1883.',
    'Use TLS' => 'TLS verwenden',
    'Whether to connect to the broker over a secure TLS socket.' => 'Ob die Verbindung zum Broker über einen sicheren TLS-Socket hergestellt werden soll.',
    'Username' => 'Benutzername',
    'Optional, for brokers that require username/password authentication.' => 'Optional, für Broker, die eine Authentifizierung mit Benutzername/Passwort erfordern.',
    'Password' => 'Passwort',
    'MQTT Version' => 'MQTT-Version',
    'Protocol version sent to the broker.' => 'An den Broker gesendete Protokollversion.',
    'Client ID' => 'Client-ID',
    'Optional. A unique client ID is generated automatically when left blank.' => 'Optional. Eine eindeutige Client-ID wird automatisch generiert, wenn das Feld leer bleibt.',
    'Mutual TLS' => 'Gegenseitiges TLS',
    'Optional. Required for brokers that authenticate clients with certificates, such as AWS IoT Core. Provide server file paths to the certificate files (a `.env` variable or `@alias` reference is allowed).' => 'Optional. Erforderlich für Broker, die Clients mit Zertifikaten authentifizieren, z. B. AWS IoT Core. Geben Sie Server-Dateipfade zu den Zertifikatsdateien an (eine `.env`-Variable oder ein `@alias`-Verweis ist zulässig).',
    'CA Certificate File' => 'CA-Zertifikatsdatei',
    'Path to the certificate authority (CA) file.' => 'Pfad zur Zertifizierungsstellen-Datei (CA).',
    'Client Certificate File' => 'Client-Zertifikatsdatei',
    'Path to the client certificate file.' => 'Pfad zur Client-Zertifikatsdatei.',
    'Client Key File' => 'Client-Schlüsseldatei',
    'Path to the client private key file.' => 'Pfad zur privaten Schlüsseldatei des Clients.',
    'MQTT Topics' => 'MQTT-Themen',
    'Add the MQTT topics you\'d like to publish to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification.' => 'Fügen Sie die MQTT-Themen hinzu, an die Sie veröffentlichen möchten. Jedes Thema wird beim Konfigurieren einer Benachrichtigung als Empfänger auf dem Tab **Empfänger** verfügbar.',
    'Click any row\'s **Test** button to publish a quick test message to that topic.' => 'Klicken Sie auf die Schaltfläche **Test** einer beliebigen Zeile, um eine schnelle Testnachricht an dieses Thema zu veröffentlichen.',
    'MQTT' => 'MQTT',
    'Payload' => 'Inhalt',
    'The JSON or plain text message published to the MQTT topic.' => 'Die JSON- oder Klartextnachricht, die im MQTT-Thema veröffentlicht wird.',
    'The message published to the topic. Can be plain text or a Twig-rendered JSON object.' => 'Die an das Thema veröffentlichte Nachricht. Kann reiner Text oder ein per Twig gerendertes JSON-Objekt sein.',
    'Quality of Service' => 'Dienstgüte',
    'Delivery guarantee for this message.' => 'Zustellgarantie für diese Nachricht.',
    'Retain' => 'Beibehalten',
    'Whether the broker keeps this as the topic\'s last message for future subscribers.' => 'Ob der Broker diese als letzte Nachricht des Themas beibehält und an künftige Abonnenten zustellt.',
    'Don\'t retain' => 'Nicht beibehalten',
    'Select MQTT topic(s)' => 'MQTT-Thema(en) auswählen',
    'Which topics should receive this message?' => 'Welche Themen sollen diese Nachricht erhalten?',
    'No MQTT topics configured. Add one in [Settings → MQTT]({url}).' => 'Keine MQTT-Themen konfiguriert. Fügen Sie eines unter [Einstellungen → MQTT]({url}) hinzu.',
    'Not a valid topic. Must not be empty or contain the `+` or `#` wildcards.' => 'Kein gültiges Thema. Darf nicht leer sein oder die Platzhalter `+` oder `#` enthalten.',
    'Broker host is not configured.' => 'Broker-Host ist nicht konfiguriert.',

    // ============================================================
    // Recipient empty-state (administrative changes disabled)
    // ============================================================

    'No ntfy topics configured. Topics can only be added in an environment that allows administrative changes.' => 'Keine ntfy-Themen konfiguriert. Themen können nur in einer Umgebung hinzugefügt werden, die administrative Änderungen zulässt.',
    'No Slack channels configured. Channels can only be added in an environment that allows administrative changes.' => 'Keine Slack-Kanäle konfiguriert. Kanäle können nur in einer Umgebung hinzugefügt werden, die administrative Änderungen zulässt.',
    'No Bluesky accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Keine Bluesky-Konten konfiguriert. Konten können nur in einer Umgebung hinzugefügt werden, die administrative Änderungen zulässt.',
    'No MQTT topics configured. Topics can only be added in an environment that allows administrative changes.' => 'Keine MQTT-Themen konfiguriert. Themen können nur in einer Umgebung hinzugefügt werden, die administrative Änderungen zulässt.',
];
