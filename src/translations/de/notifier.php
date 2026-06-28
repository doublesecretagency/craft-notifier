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

    // ========================================================
    // PLUGIN & PERMISSIONS
    // ========================================================

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

    // ========================================================
    // NOTIFICATION EDITOR
    // ========================================================

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
    'Generate report on a recurring schedule' => 'Bericht nach einem wiederkehrenden Zeitplan erstellen',
    'Generate report on demand' => 'Bericht bei Bedarf erstellen',
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
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are supported.' => '[Templating]({templatingUrl}) und [spezielle Variablen]({variablesUrl}) werden unterstützt.',

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

    // Message tab: Discord
    'Discord Message Body' => 'Discord-Nachrichtentext',
    'Supports standard Markdown, and optionally HTML _(see below)_. Max 2000 characters.' => 'Unterstützt Standard-Markdown und optional HTML _(siehe unten)_. Max. 2000 Zeichen.',
    'Whether to only parse as Markdown, or additionally parse it as HTML.' => 'Ob nur als Markdown verarbeitet werden soll oder zusätzlich als HTML.',
    'Markdown only' => 'Nur Markdown',
    'Markdown + HTML' => 'Markdown + HTML',
    'Whether Discord should unfurl link previews for URLs in the message body.' => 'Ob Discord Linkvorschauen für URLs im Nachrichtentext anzeigen soll.',
    'Webhook Username' => 'Webhook-Benutzername',
    'Optionally override the webhook\'s display name.' => 'Optional den Anzeigenamen des Webhooks überschreiben.',
    'Dynamic Username' => 'Dynamischer Benutzername',
    'Webhook Avatar URL' => 'Webhook-Avatar-URL',
    'Optionally override the webhook\'s avatar with a URL.' => 'Optional den Avatar des Webhooks per URL überschreiben.',

    // Message tab: Facebook
    'Message Body' => 'Nachrichtentext',
    'The text of your Facebook post.' => 'Der Text Ihres Facebook-Beitrags.',
    'Preview Card URL' => 'Vorschaukarten-URL',
    'Optionally add a link to generate a preview card.' => 'Optional einen Link hinzufügen, um eine Vorschaukarte zu generieren.',

    // Message tab: Instagram
    'Caption' => 'Bildunterschrift',
    'Image Attachment' => 'Bildanhang',
    'Optional caption, max 2200 characters.' => 'Optionale Bildunterschrift, max. 2200 Zeichen.',

    // Message tab: X (Twitter)
    'Plain text, max 280 characters.' => 'Klartext, max. 280 Zeichen.',

    // Message tab: Media
    'Attach an image by calling `{% setMedia %}` in a [custom Twig snippet]({url}).' => 'Hängen Sie ein Bild an, indem Sie `{% setMedia %}` in einem [benutzerdefinierten Twig-Snippet]({url}) aufrufen.',

    // Message tab: Bluesky
    'Post Body' => 'Beitragstext',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => 'Klartext, maximal 300 Zeichen. URLs und `@handle.tld`-Erwähnungen werden automatisch verlinkt.',
    'Generate Link Preview' => 'Linkvorschau erzeugen',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => 'Automatisch eine Vorschaukarte generieren, wenn der Beitragstext eine URL enthält.',
    'No card' => 'Keine Karte',
    'Generate preview card' => 'Vorschaukarte erzeugen',

    // Message tab: Mastodon
    'Plain text, max 500 characters. URLs will unfurl automatically.' => 'Nur Text, max. 500 Zeichen. URLs werden automatisch entfaltet.',
    'Visibility' => 'Sichtbarkeit',
    'Who will be able to see this post?' => 'Wer wird diesen Beitrag sehen können?',

    // Message tab: LinkedIn
    'LinkedIn' => 'LinkedIn',
    'The text of your LinkedIn post.' => 'Der Text deines LinkedIn-Beitrags.',

    // Message tab: MQTT
    'Payload' => 'Inhalt',
    'The JSON or plain text message published to the MQTT topic.' => 'Die JSON- oder Klartextnachricht, die im MQTT-Thema veröffentlicht wird.',
    'Quality of Service' => 'Dienstgüte',
    'Delivery guarantee for this message.' => 'Zustellgarantie für diese Nachricht.',
    'Retain' => 'Beibehalten',
    'Whether the broker keeps this as the topic\'s last message for future subscribers.' => 'Ob der Broker diese als letzte Nachricht des Themas beibehält und an künftige Abonnenten zustellt.',
    'Don\'t retain' => 'Nicht beibehalten',

    // Recipients tab: type selector & user/group pickers
    'Recipients Type' => 'Empfängertyp',
    'Who will receive this message?' => 'Wer soll diese Nachricht erhalten?',
    'Add a message recipient' => 'Empfänger hinzufügen',
    'Select User(s)' => 'Benutzer auswählen',
    'Which users will receive the message?' => 'Welche Benutzer sollen die Nachricht erhalten?',
    'Which user groups will receive the message?' => 'Welche Benutzergruppen sollen die Nachricht erhalten?',

    // Recipients tab: channel pickers (ntfy, Slack, Discord, Bluesky, Mastodon, MQTT)
    'Select ntfy topic(s)' => 'ntfy-Thema/Themen auswählen',
    'Which topics should receive this message?' => 'Welche Themen sollen diese Nachricht erhalten?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'Keine ntfy-Themen konfiguriert. Fügen Sie eines unter [Einstellungen → ntfy]({url}) hinzu.',
    'No ntfy topics configured. Topics can only be added in an environment that allows administrative changes.' => 'Keine ntfy-Themen konfiguriert. Themen können nur in einer Umgebung hinzugefügt werden, die administrative Änderungen zulässt.',
    'Select Slack channel(s)' => 'Slack-Kanal/Kanäle auswählen',
    'Which channels should receive this message?' => 'Welche Kanäle sollen diese Nachricht erhalten?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Keine Slack-Kanäle konfiguriert. Fügen Sie einen unter [Einstellungen → Slack]({url}) hinzu.',
    'No Slack channels configured. Channels can only be added in an environment that allows administrative changes.' => 'Keine Slack-Kanäle konfiguriert. Kanäle können nur in einer Umgebung hinzugefügt werden, die administrative Änderungen zulässt.',
    'Select Discord channel(s)' => 'Discord-Kanal/Kanäle auswählen',
    'No Discord channels configured. Add one in [Settings → Discord]({url}).' => 'Keine Discord-Kanäle konfiguriert. Fügen Sie einen unter [Einstellungen → Discord]({url}) hinzu.',
    'No Discord channels configured. Channels can only be added in an environment that allows administrative changes.' => 'Keine Discord-Kanäle konfiguriert. Kanäle können nur in einer Umgebung hinzugefügt werden, die administrative Änderungen zulässt.',
    'Select Facebook page(s)' => 'Facebook-Seite(n) auswählen',
    'Which pages should post this message?' => 'Welche Seiten sollen diese Nachricht veröffentlichen?',
    'No Facebook pages configured. Add one in [Settings → Facebook]({url}).' => 'Keine Facebook-Seiten konfiguriert. Fügen Sie eine unter [Einstellungen → Facebook]({url}) hinzu.',
    'No Facebook pages configured. Pages can only be added in an environment that allows administrative changes.' => 'Keine Facebook-Seiten konfiguriert. Seiten können nur in einer Umgebung hinzugefügt werden, die administrative Änderungen zulässt.',
    'Select Instagram account(s)' => 'Instagram-Konto/Konten auswählen',
    'No Instagram accounts configured. Add one in [Settings → Instagram]({url}).' => 'Keine Instagram-Konten konfiguriert. Fügen Sie eines unter [Einstellungen → Instagram]({url}) hinzu.',
    'No Instagram accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Keine Instagram-Konten konfiguriert. Konten können nur in einer Umgebung hinzugefügt werden, die administrative Änderungen zulässt.',
    'Select X (Twitter) account(s)' => 'X (Twitter)-Konto/Konten auswählen',
    'No X (Twitter) accounts configured. Add one in [Settings → X (Twitter)]({url}).' => 'Keine X (Twitter)-Konten konfiguriert. Fügen Sie eines unter [Einstellungen → X (Twitter)]({url}) hinzu.',
    'No X (Twitter) accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Keine X (Twitter)-Konten konfiguriert. Konten können nur in einer Umgebung hinzugefügt werden, die administrative Änderungen zulässt.',
    'Select Bluesky account(s)' => 'Bluesky-Konto/Konten auswählen',
    'Which accounts should post this message?' => 'Welche Konten sollen diese Nachricht veröffentlichen?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Keine Bluesky-Konten konfiguriert. Fügen Sie eines unter [Einstellungen → Bluesky]({url}) hinzu.',
    'No Bluesky accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Keine Bluesky-Konten konfiguriert. Konten können nur in einer Umgebung hinzugefügt werden, die administrative Änderungen zulässt.',
    'Select Mastodon account(s)' => 'Mastodon-Konto/Konten auswählen',
    'No Mastodon accounts configured. Add one in [Settings → Mastodon]({url}).' => 'Keine Mastodon-Konten konfiguriert. Fügen Sie eines unter [Einstellungen → Mastodon]({url}) hinzu.',
    'No Mastodon accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Keine Mastodon-Konten konfiguriert. Konten können nur in einer Umgebung hinzugefügt werden, die administrative Änderungen zulässt.',
    'Select MQTT topic(s)' => 'MQTT-Thema(en) auswählen',
    'No MQTT topics configured. Add one in [Settings → MQTT]({url}).' => 'Keine MQTT-Themen konfiguriert. Fügen Sie eines unter [Einstellungen → MQTT]({url}) hinzu.',
    'No MQTT topics configured. Topics can only be added in an environment that allows administrative changes.' => 'Keine MQTT-Themen konfiguriert. Themen können nur in einer Umgebung hinzugefügt werden, die administrative Änderungen zulässt.',
    'Not a valid topic. Must not be empty or contain the `+` or `#` wildcards.' => 'Kein gültiges Thema. Darf nicht leer sein oder die Platzhalter `+` oder `#` enthalten.',

    // Recipients tab: LinkedIn picker
    'Select LinkedIn account(s)' => 'LinkedIn-Konto/-Konten auswählen',
    'Which page or member should post this message?' => 'Welche Seite oder welches Mitglied soll diese Nachricht posten?',
    'No LinkedIn accounts connected. Connect one in [Settings → LinkedIn]({url}).' => 'Keine LinkedIn-Konten verbunden. Verbinde eines unter [Einstellungen → LinkedIn]({url}).',
    'No LinkedIn accounts connected. Accounts can only be connected in an environment that allows administrative changes.' => 'Keine LinkedIn-Konten verbunden. Konten können nur in einer Umgebung verbunden werden, die administrative Änderungen zulässt.',

    // Recipients tab: dynamic recipients snippet
    'Twig Snippet to Determine Recipients' => 'Twig-Snippet zur Bestimmung der Empfänger',
    'Enter a custom Twig snippet to [determine who will receive the message]({url}).' => 'Geben Sie ein eigenes Twig-Snippet ein, um [zu bestimmen, wer die Nachricht erhält]({url}).',
    'The snippet **must** include a `{% setRecipients %}` tag.' => 'Das Snippet **muss** ein `{% setRecipients %}`-Tag enthalten.',

    // ========================================================
    // SETTINGS
    // ========================================================

    // Settings: nav & page chrome
    'Notifier Settings' => 'Notifier-Einstellungen',
    'General' => 'Allgemein',
    'Twilio' => 'Twilio',
    'Pushover' => 'Pushover',
    'ntfy' => 'ntfy',
    'Slack' => 'Slack',
    'Discord' => 'Discord',
    'Bluesky' => 'Bluesky',
    'Mastodon' => 'Mastodon',
    'MQTT' => 'MQTT',

    // Settings: nav group headings
    'Push Notifications' => 'Push-Benachrichtigungen',
    'Chat Platforms' => 'Chat-Plattformen',
    'Social Media' => 'Soziale Medien',
    'Internet of Things' => 'Internet der Dinge',
    'Expand {heading}' => '{heading} aufklappen',

    // Settings: shared intro lines
    'Consult the [{name} setup guide]({url}) for complete instructions.' => 'Im [{name}-Einrichtungsleitfaden]({url}) finden Sie vollständige Anweisungen.',
    'Sensitive values can be stored in your `.env` file and referenced here.' => 'Vertrauliche Werte können in Ihrer `.env`-Datei gespeichert und hier referenziert werden.',

    // Settings: Notification order
    'Notification Order' => 'Reihenfolge der Benachrichtigungen',
    'Notifications can be dragged into any order on the index page. Choose where new notifications land in that order.' => 'Benachrichtigungen können auf der Übersichtsseite in eine eigene Reihenfolge gezogen werden. Wählen Sie, wo neue Benachrichtigungen in dieser Reihenfolge hinzugefügt werden.',
    'Default Placement' => 'Standardplatzierung',
    'Where new notifications are added to the list.' => 'Wo neue Benachrichtigungen zur Liste hinzugefügt werden.',
    'Before other notifications' => 'Vor anderen Benachrichtigungen',
    'After other notifications' => 'Nach anderen Benachrichtigungen',

    // Settings: Logging
    'Logging' => 'Protokollierung',
    "Notifier keeps a running log of every message it sends. You usually won't need to change this, but you can limit how many log entries are kept in the database." => 'Notifier führt ein fortlaufendes Protokoll der gesendeten Nachrichten. Normalerweise nicht erforderlich, aber Sie können die Anzahl der in der Datenbank gespeicherten Protokollereignisse begrenzen.',
    'Enable Logging' => 'Protokollierung aktivieren',
    'When disabled, Notifier will not write anything to the notification log.' => 'Bei Deaktivierung schreibt Notifier nichts in das Benachrichtigungsprotokoll.',
    'Number of days to retain log events' => 'Anzahl der Tage, an denen Protokollereignisse aufbewahrt werden',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Protokollereignisse höchstens so viele Tage aufbewahren. Leer lassen für kein Limit.',
    'Number of log events to retain' => 'Anzahl der zu behaltenden Protokollereignisse',
    'At most, keep this many log events. Leave blank for no limit.' => 'Höchstens diese Anzahl an Protokollereignissen behalten. Leer lassen für kein Limit.',

    // Settings: Scheduled sending
    'Scheduled Sending' => 'Geplanter Versand',
    'A shared secret that authenticates scheduled runs triggered over the web. You only need this if you trigger the schedule from the web endpoint.' => 'Geteiltes Geheimnis zur Authentifizierung von Web-Anfragen für die geplante Ausführung. Nur erforderlich, wenn der Zeitplan über den Web-Endpunkt ausgelöst wird.',
    'Scheduled-Run Token' => 'Token für geplante Ausführung',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => 'Wird bei jeder Anfrage als X-Notifier-Token-Header oder als token-Body-Parameter gesendet.',

    // Settings: Twilio
    'Send SMS text messages through [Twilio](https://www.twilio.com).' => 'Senden Sie SMS-Textnachrichten über [Twilio](https://www.twilio.com).',
    'Twilio Account SID' => 'Twilio Account SID',
    'Twilio Auth Token' => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)' => 'Twilio-Telefonnummer (versendet jede SMS-Nachricht)',
    'SMS Testing' => 'SMS-Test',
    'Optional. When set, every SMS is sent to this number instead of the actual recipient.' => 'Optional. Wenn gesetzt, wird jede gesendete SMS an diese Nummer statt an den ursprünglichen Empfänger zugestellt.',
    'Test phone number' => 'Test-Telefonnummer',

    // Settings: Pushover
    'Send push notifications through [Pushover](https://pushover.net).' => 'Senden Sie Push-Benachrichtigungen über [Pushover](https://pushover.net).',
    'Application API Token' => 'Anwendungs-API-Token',
    'The 30-character app token from your Pushover application.' => 'Das 30-stellige App-Token aus Ihrer Pushover-Anwendung.',

    // Settings: ntfy
    'Send push notifications through [ntfy](https://ntfy.sh).' => 'Senden Sie Push-Benachrichtigungen über [ntfy](https://ntfy.sh).',
    'Server URL' => 'Server-URL',
    "Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`." => 'Optional, verweisen Sie auf eine selbst gehostete ntfy-Instanz (falls zutreffend). Standard ist `https://ntfy.sh`.',
    'Access token' => 'Zugriffstoken',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Optional, erforderlich für geschützte Themen oder selbst gehostete Instanzen mit Authentifizierung.',
    'ntfy Topics' => 'ntfy-Themen',
    'Add the ntfy topics you want to send to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Fügen Sie die ntfy-Themen hinzu, an die Sie Nachrichten senden möchten. Jedes Thema wird beim Konfigurieren einer Benachrichtigung als Empfänger auf dem Tab **Empfänger** verfügbar.',
    'Topics' => 'Themen',
    "Click any row's **Test** button to send a quick test message to that topic." => 'Klicken Sie auf die Schaltfläche **Test** einer beliebigen Zeile, um eine schnelle Testnachricht an dieses Thema zu senden.',
    'Label' => 'Bezeichnung',
    'Topic' => 'Thema',
    'Add a topic' => 'Thema hinzufügen',

    // Settings: Slack
    'Post messages to your Slack channels.' => 'Senden Sie Nachrichten an Ihre Slack-Kanäle.',
    'Channels' => 'Kanäle',
    "Click any row's **Test** button to send a quick test message to that channel." => 'Klicken Sie auf die Schaltfläche **Test** einer beliebigen Zeile, um eine schnelle Testnachricht an diesen Kanal zu senden.',
    'Bot Token' => 'Bot-Token',
    'Channel ID' => 'Kanal-ID',
    'Add a channel' => 'Kanal hinzufügen',
    'Not a valid Bot Token. Must start with `xoxb-`.' => 'Kein gültiges Bot-Token. Muss mit `xoxb-` beginnen.',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => 'Keine gültige Kanal-ID. Muss wie `C01234ABCD` aussehen.',

    // Settings: Discord
    'Post messages to your Discord channels.' => 'Senden Sie Nachrichten an Ihre Discord-Kanäle.',
    'Webhook URL' => 'Webhook-URL',
    'Not a valid Webhook URL. Must start with `https://discord.com/api/webhooks/`.' => 'Keine gültige Webhook-URL. Muss mit `https://discord.com/api/webhooks/` beginnen.',

    // Settings: Facebook
    'Facebook' => 'Facebook',
    'Publish posts to your [Facebook](https://facebook.com) pages.' => 'Veröffentlichen Sie Beiträge auf Ihren [Facebook](https://facebook.com)-Seiten.',
    'Pages' => 'Seiten',
    'Page ID' => 'Page ID',
    'Page Access Token' => 'Page Access Token',
    'Add a page' => 'Seite hinzufügen',
    "Click any row's **Test** button to verify that page's credentials. No posts are made." => 'Klicken Sie auf die Schaltfläche **Test** einer beliebigen Zeile, um die Zugangsdaten dieser Seite zu überprüfen. Es werden keine Beiträge veröffentlicht.',

    // Settings: Instagram
    'Instagram' => 'Instagram',
    'Publish posts to your [Instagram](https://instagram.com) Business accounts.' => 'Veröffentlichen Sie Beiträge in Ihren [Instagram](https://instagram.com)-Business-Konten.',
    "Click any row's **Test** button to resolve the linked Instagram account. No posts are made." => 'Klicken Sie auf die Schaltfläche **Test** einer beliebigen Zeile, um das verknüpfte Instagram-Konto zu ermitteln. Es werden keine Beiträge veröffentlicht.',

    // Settings: X (Twitter)
    'X (Twitter)' => 'X (Twitter)',
    'Publish posts to your [X (Twitter)](https://x.com) accounts.' => 'Veröffentlichen Sie Beiträge in Ihren [X (Twitter)](https://x.com)-Konten.',
    'Consumer Key' => 'Consumer Key',
    'Consumer Key Secret' => 'Consumer Key Secret',
    'Access Token Secret' => 'Access Token Secret',

    // Settings: Bluesky
    'Publish posts to your [Bluesky](https://bsky.app) accounts.' => 'Veröffentlichen Sie Beiträge in Ihren [Bluesky](https://bsky.app)-Konten.',
    'PDS URL' => 'PDS-URL',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'Standard ist https://bsky.social. Verweisen Sie auf eine eigene PDS, falls Ihre Installation föderiert.',
    'Bluesky Accounts' => 'Bluesky-Konten',
    'Add the Bluesky accounts you want to post from. Each account becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Fügen Sie die Bluesky-Konten hinzu, von denen Sie posten möchten. Jedes Konto wird beim Konfigurieren einer Benachrichtigung als Empfänger auf dem Tab **Empfänger** verfügbar.',
    'Accounts' => 'Konten',
    "Click any row's **Test** button to confirm the account authenticates." => 'Klicken Sie auf die Schaltfläche **Test** einer beliebigen Zeile, um zu bestätigen, dass sich das Konto authentifiziert.',
    'Handle' => 'Handle',
    'App password' => 'App-Passwort',
    'Add an account' => 'Konto hinzufügen',

    // Settings: Mastodon
    'Publish posts to your [Mastodon](https://joinmastodon.org) accounts.' => 'Veröffentlichen Sie Beiträge in Ihren [Mastodon](https://joinmastodon.org)-Konten.',
    'Click any row\'s **Test** button to verify that account\'s credentials. No posts are made.' => 'Klicken Sie auf die Schaltfläche **Test** einer beliebigen Zeile, um die Zugangsdaten dieses Kontos zu überprüfen. Es werden keine Beiträge veröffentlicht.',
    'Instance URL' => 'Instanz-URL',
    'Access Token' => 'Zugriffstoken',

    // Settings: LinkedIn
    'Publish posts to your [LinkedIn](https://linkedin.com) profile.' => 'Veröffentliche Beiträge auf deinem [LinkedIn](https://linkedin.com)-Profil.',
    'The Client ID of your LinkedIn app.' => 'Die Client-ID deiner LinkedIn-App.',
    'Client Secret' => 'Client-Secret',
    'The Primary Client Secret of your LinkedIn app.' => 'Das primäre Client-Secret deiner LinkedIn-App.',
    'Enable organization posting' => 'Veröffentlichung für Organisationen aktivieren',
    'Copy this redirect URL' => 'Diese Weiterleitungs-URL kopieren',
    'When configuring the LinkedIn app, <strong>copy this URL</strong> to use as an "Authorized redirect URL".' => 'Beim Konfigurieren der LinkedIn-App <strong>kopiere diese URL</strong>, um sie als "Authorized redirect URL" zu verwenden.',
    'Also request access to post as organization pages you administer. Requires Community Management API approval from LinkedIn.' => 'Fordere auch Zugriff an, um als von dir verwaltete Organisationsseiten zu posten. Erfordert die Genehmigung der Community Management API durch LinkedIn.',
    'Connections' => 'Verbindungen',
    'Each connection becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Jede Verbindung wird als Empfänger auf der Registerkarte **Empfänger** verfügbar, wenn du eine Benachrichtigung einrichtest.',
    'Account' => 'Konto',
    'Type' => 'Typ',
    'Status' => 'Status',
    'Organization' => 'Organisation',
    'Member' => 'Mitglied',
    'Reconnect needed' => 'Neuverbindung erforderlich',
    'Expires' => 'Läuft ab',
    'Connected' => 'Verbunden',
    'Disconnect' => 'Trennen',
    'No LinkedIn accounts are connected yet.' => 'Es sind noch keine LinkedIn-Konten verbunden.',
    'Connect to LinkedIn' => 'Mit LinkedIn verbinden',
    'Provide valid credentials to connect with LinkedIn.' => 'Gib gültige Anmeldedaten an, um eine Verbindung zu LinkedIn herzustellen.',
    'Disconnect this LinkedIn account?' => 'Dieses LinkedIn-Konto trennen?',

    // Settings: MQTT
    'Publish messages to an MQTT broker, handy for IoT and home-automation setups.' => 'Veröffentlichen Sie Nachrichten an einen MQTT-Broker, praktisch für IoT- und Heimautomatisierungs-Setups.',
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
    'Optional. Needed for brokers that authenticate clients with certificates, such as AWS IoT Core. Enter the server file paths to your certificate files. You can use a `.env` variable or `@alias` reference.' => 'Optional. Erforderlich für Broker, die Clients mit Zertifikaten authentifizieren, z. B. AWS IoT Core. Geben Sie Server-Dateipfade zu den Zertifikatsdateien an (eine `.env`-Variable oder ein `@alias`-Verweis ist zulässig).',
    'CA Certificate File' => 'CA-Zertifikatsdatei',
    'Path to the certificate authority (CA) file.' => 'Pfad zur Zertifizierungsstellen-Datei (CA).',
    'Client Certificate File' => 'Client-Zertifikatsdatei',
    'Path to the client certificate file.' => 'Pfad zur Client-Zertifikatsdatei.',
    'Client Key File' => 'Client-Schlüsseldatei',
    'Path to the client private key file.' => 'Pfad zur privaten Schlüsseldatei des Clients.',
    'MQTT Topics' => 'MQTT-Themen',
    'Add the MQTT topics you want to publish to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Fügen Sie die MQTT-Themen hinzu, an die Sie veröffentlichen möchten. Jedes Thema wird beim Konfigurieren einer Benachrichtigung als Empfänger auf dem Tab **Empfänger** verfügbar.',
    'Click any row\'s **Test** button to publish a quick test message to that topic.' => 'Klicken Sie auf die Schaltfläche **Test** einer beliebigen Zeile, um eine schnelle Testnachricht an dieses Thema zu veröffentlichen.',

    // ========================================================
    // MANUAL SEND & TEST
    // ========================================================

    // Manual send & test
    'Send a test message' => 'Testnachricht senden',
    'Send a REAL test notification?\\n\\n⚠️ Uses a random sample of real data.\\n⚠️ Sends a real message via the configured channel.\\n⚠️ Delivers to the real configured recipient(s).' => 'ECHTE Testbenachrichtigung senden?\\n\\n⚠️ Verwendet eine zufällige Stichprobe echter Daten.\\n⚠️ Sendet eine echte Nachricht über den konfigurierten Kanal.\\n⚠️ Wird an die echten konfigurierten Empfänger zugestellt.',
    'Test' => 'Test',
    'Send system snapshot' => 'System-Snapshot senden',
    'Send data report' => 'Datenbericht senden',
    'Are you sure you want to send this notification?' => 'Möchten Sie diese Benachrichtigung wirklich senden?',
    'This notification cannot be triggered manually.' => 'Diese Benachrichtigung kann nicht manuell ausgelöst werden.',
    'This notification no longer applies to the selected element.' => 'Diese Benachrichtigung trifft auf das ausgewählte Element nicht mehr zu.',

    // ========================================================
    // RUNTIME OUTPUT
    // ========================================================

    // Runtime: dispatch log feedback
    'Sending {messageType} to {recipient}.' => 'Sende {messageType} an {recipient}.',
    'Adding message to queue.' => 'Nachricht zur Warteschlange hinzugefügt.',
    'Sending message immediately (bypassing queue).' => 'Nachricht wird sofort gesendet (Warteschlange wird umgangen).',

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
    'Page ID and Page Access Token are required.' => 'Page ID und Page Access Token sind erforderlich.',
    'Facebook rejected the request: {error}' => 'Facebook hat die Anfrage abgelehnt: {error}',
    'Successfully connected to "{name}". No posts were made.' => 'Erfolgreich mit "{name}" verbunden. Es wurden keine Beiträge veröffentlicht.',
    'No Instagram Business account is linked to this Page.' => 'Mit dieser Seite ist kein Instagram-Business-Konto verknüpft.',
    'Successfully connected to @{handle}. No posts were made.' => 'Erfolgreich mit @{handle} verbunden. Es wurden keine Beiträge veröffentlicht.',
    'All four credentials are required.' => 'Alle vier Zugangsdaten sind erforderlich.',
    'X (Twitter) rejected the request: {error}' => 'X (Twitter) hat die Anfrage abgelehnt: {error}',
    'Successfully authenticated as @{username}. No posts were made.' => 'Erfolgreich als @{username} authentifiziert. Es wurden keine Beiträge veröffentlicht.',
    'Handle and app password are required.' => 'Handle und App-Passwort sind erforderlich.',
    'Authentication failed.' => 'Authentifizierung fehlgeschlagen.',
    'Successfully authenticated. No messages were posted.' => 'Erfolgreich authentifiziert. Es wurden keine Nachrichten gepostet.',
    'Log events deleted.' => 'Protokollereignisse gelöscht.',
    'Notification sent.' => 'Benachrichtigung gesendet.',
    'Notification was not sent. Check the Notification Log for details.' => 'Benachrichtigung wurde nicht gesendet. Details finden Sie im Benachrichtigungsprotokoll.',
    'Instance URL and access token are required.' => 'Instanz-URL und Zugriffstoken sind erforderlich.',
    'Mastodon rejected the request: {error}' => 'Mastodon hat die Anfrage abgelehnt: {error}',
    'Successfully authenticated as @{handle}. No posts were made.' => 'Erfolgreich als @{handle} authentifiziert. Es wurden keine Beiträge veröffentlicht.',
    'Broker host is not configured.' => 'Broker-Host ist nicht konfiguriert.',

    // Runtime: LinkedIn connect flow
    'Add your LinkedIn app credentials before connecting.' => 'Füge deine LinkedIn-App-Anmeldedaten hinzu, bevor du dich verbindest.',
    'LinkedIn authorization failed: {error}' => 'LinkedIn-Autorisierung fehlgeschlagen: {error}',
    'LinkedIn authorization failed: invalid state.' => 'LinkedIn-Autorisierung fehlgeschlagen: ungültiger Status.',
    'LinkedIn authorization failed: no code returned.' => 'LinkedIn-Autorisierung fehlgeschlagen: kein Code zurückgegeben.',
    'Connected to LinkedIn.' => 'Mit LinkedIn verbunden.',
    'Disconnected from LinkedIn.' => 'Verbindung zu LinkedIn getrennt.',

    // Outbound: per-channel send results
    'Successfully sent an email to {name}.' => 'E-Mail erfolgreich an {name} gesendet.',
    'Successfully sent an SMS message to {name}.' => 'SMS-Nachricht erfolgreich an {name} gesendet.',
    'Successfully sent a Pushover notification to {name}.' => 'Pushover-Benachrichtigung erfolgreich an {name} gesendet.',
    'Successfully posted an announcement for {name}.' => 'Ankündigung erfolgreich für {name} veröffentlicht.',
    'Successfully sent a flash message to {name}.' => 'Flash-Nachricht erfolgreich an {name} gesendet.',
    'Successfully posted to Slack in channel "{label}".' => 'Erfolgreich in Slack im Kanal "{label}" veröffentlicht.',
    'Successfully posted to Discord in channel "{label}".' => 'Erfolgreich in Discord im Kanal "{label}" veröffentlicht.',
    'Successfully posted to Facebook as "{label}" account.' => 'Erfolgreich auf Facebook als Konto "{label}" veröffentlicht.',
    'Successfully posted to Instagram as "{label}" account.' => 'Erfolgreich auf Instagram als Konto "{label}" veröffentlicht.',
    'Successfully posted to X (Twitter) as "{label}" account.' => 'Erfolgreich auf X (Twitter) als Konto "{label}" veröffentlicht.',
    'Successfully posted to Bluesky as "{label}" account.' => 'Erfolgreich auf Bluesky als Konto "{label}" veröffentlicht.',
    'Successfully posted to Mastodon as "{label}" account.' => 'Erfolgreich auf Mastodon als Konto "{label}" veröffentlicht.',
    'Successfully posted to LinkedIn as "{label}" account.' => 'Erfolgreich auf LinkedIn als Konto "{label}" veröffentlicht.',
    'Successfully sent ntfy message to topic "{topic}".' => 'ntfy-Nachricht erfolgreich an Thema "{topic}" gesendet.',
    'Slack rejected the message: {error}' => 'Slack hat die Nachricht abgelehnt: {error}',
    'Discord rejected the message: {error}' => 'Discord hat die Nachricht abgelehnt: {error}',
    'the attached image could not be read' => 'das angehängte Bild konnte nicht gelesen werden',
    'Successfully sent MQTT message to topic "{topic}".' => 'MQTT-Nachricht erfolgreich an Thema "{topic}" gesendet.',

    // Outbound: LinkedIn send results & skips
    '[EMPTY BODY] The LinkedIn post body is empty.' => '[EMPTY BODY] Der Text des LinkedIn-Beitrags ist leer.',
    '[NO RECIPIENT] No LinkedIn connection was specified.' => '[NO RECIPIENT] Es wurde keine LinkedIn-Verbindung angegeben.',
    '[RECONNECT REQUIRED] {reason}' => '[RECONNECT REQUIRED] {reason}',
    '[REJECTED BY LINKEDIN] {error}' => '[REJECTED BY LINKEDIN] {error}',
    'LinkedIn app credentials are not configured.' => 'LinkedIn-App-Anmeldedaten sind nicht konfiguriert.',
    'The LinkedIn access token has expired. Please reconnect.' => 'Das LinkedIn-Zugriffstoken ist abgelaufen. Bitte erneut verbinden.',
    'The LinkedIn connection no longer exists.' => 'Die LinkedIn-Verbindung existiert nicht mehr.',
    'My LinkedIn Profile' => 'Mein LinkedIn-Profil',
    '[SKIPPED] Recipient "{name}" has no LinkedIn connection.' => '[SKIPPED] Empfänger "{name}" hat keine LinkedIn-Verbindung.',
    '[SKIPPED] The configured LinkedIn connection no longer exists (uid: {uid}).' => '[SKIPPED] Die konfigurierte LinkedIn-Verbindung existiert nicht mehr (uid: {uid}).',

    // Media attachments
    'Videos are not yet supported on {channel}.' => 'Videos werden auf {channel} noch nicht unterstützt.',
    'The image could not be resized to fit.' => 'Das Bild konnte nicht auf die passende Größe gebracht werden.',
    'The image could not be read.' => 'Das Bild konnte nicht gelesen werden.',
    'The image failed to upload.' => 'Das Bild konnte nicht hochgeladen werden.',
    'The upload response had no media ID.' => 'Die Upload-Antwort enthielt keine Medien-ID.',
    'The upload response had no blob.' => 'Die Upload-Antwort enthielt keinen Blob.',
    '[NOT ATTACHED] Unable to attach image. {reason}' => '[NICHT ANGEHÄNGT] Bild konnte nicht angehängt werden. {reason}',

    // Recipient warnings
    '[SKIPPED] User "{name}" has no Pushover key.' => '[ÜBERSPRUNGEN] Benutzer "{name}" hat keinen Pushover-Schlüssel.',

    // Errors & exceptions
    'Invalid element event: {class}' => 'Ungültiges Element-Ereignis: {class}',
    'Invalid notification ID: {id}' => 'Ungültige Benachrichtigungs-ID: {id}',
    'Invalid email message mode.' => 'Ungültiger E-Mail-Nachrichtenmodus.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Sie haben keine Berechtigung, den Typ Dynamische Empfänger zu verwenden.',
    'Invalid settings section: {section}' => 'Ungültiger Einstellungsabschnitt: {section}',
    'User not authorized to save this notification.' => 'Benutzer ist nicht berechtigt, diese Benachrichtigung zu speichern.',
    'User not authorized to view this notification.' => 'Benutzer ist nicht berechtigt, diese Benachrichtigung anzuzeigen.',
    'User not authorized to delete this notification.' => 'Benutzer ist nicht berechtigt, diese Benachrichtigung zu löschen.',
    'Notification not found' => 'Benachrichtigung nicht gefunden',
    'Element not found' => 'Element nicht gefunden',
    'You do not have permission to use the Dynamic Data type.' => 'Du hast keine Berechtigung, den Typ Dynamische Daten zu verwenden.',
    '[NO DATA] The Dynamic Data snippet did not call the {tag} tag.' => '[KEINE DATEN] Das Twig-Snippet hat das {tag}-Tag nicht aufgerufen.',

    // Config-file override note
    'This is being set in the config file. [{file}]' => 'Dies wird in der Konfigurationsdatei festgelegt. [{file}]',

    // ========================================================
    // JAVASCRIPT UI
    // ========================================================

    // JavaScript: log utility & buttons
    'Test notification failed.' => 'Testbenachrichtigung fehlgeschlagen.',
    'Unable to get the notification, something went wrong.' => 'Die Benachrichtigung konnte nicht abgerufen werden, etwas ist schiefgelaufen.',
    'Something went wrong.' => 'Etwas ist schiefgelaufen.',
    'Invalid notification ID.' => 'Ungültige Benachrichtigungs-ID.',
    'Unable to delete the log event, something went wrong.' => 'Das Protokollereignis konnte nicht gelöscht werden, etwas ist schiefgelaufen.',
    'Log event deleted.' => 'Protokollereignis gelöscht.',
    'Unable to delete log events, something went wrong.' => 'Protokollereignisse konnten nicht gelöscht werden, etwas ist schiefgelaufen.',
    'Are you sure you want to delete all logs from {date}?' => 'Möchten Sie wirklich alle Protokolle vom {date} löschen?',
    // Reworded outbound + dispatch log messages
    '[BAD CREDENTIALS] Missing app token. [Configure Pushover]({url}).' => '[UNGÜLTIGE ANMELDEDATEN] App-Token fehlt. [Pushover konfigurieren]({url}).',
    '[BAD CREDENTIALS] Missing {missing}. [Configure Twilio]({url}).' => '[UNGÜLTIGE ANMELDEDATEN] {missing} fehlt. [Twilio konfigurieren]({url}).',
    '[BAD CREDENTIALS] No Discord webhook URL is configured.' => '[UNGÜLTIGE ANMELDEDATEN] Es ist keine Discord-Webhook-URL konfiguriert.',
    '[BAD CREDENTIALS] No MQTT broker host is configured.' => '[UNGÜLTIGE ANMELDEDATEN] Es ist kein MQTT-Broker-Host konfiguriert.',
    '[BAD CREDENTIALS] No Mastodon access token is configured.' => '[UNGÜLTIGE ANMELDEDATEN] Es ist kein Mastodon-Zugriffstoken konfiguriert.',
    '[BAD CREDENTIALS] No Mastodon instance URL is configured.' => '[UNGÜLTIGE ANMELDEDATEN] Es ist keine Mastodon-Instanz-URL konfiguriert.',
    '[BAD CREDENTIALS] No Slack bot token is configured.' => '[UNGÜLTIGE ANMELDEDATEN] Es ist kein Slack-Bot-Token konfiguriert.',
    '[BAD CREDENTIALS] No Twilio phone number is configured.' => '[UNGÜLTIGE ANMELDEDATEN] Es ist keine Twilio-Telefonnummer konfiguriert.',
    '[BAD CREDENTIALS] The recipient is missing Bluesky credentials.' => '[UNGÜLTIGE ANMELDEDATEN] Dem Empfänger fehlen die Bluesky-Anmeldedaten.',
    '[BAD CREDENTIALS] The recipient is missing Facebook credentials.' => '[UNGÜLTIGE ANMELDEDATEN] Dem Empfänger fehlen die Facebook-Anmeldedaten.',
    '[BAD CREDENTIALS] The recipient is missing X (Twitter) credentials.' => '[UNGÜLTIGE ANMELDEDATEN] Dem Empfänger fehlen die X (Twitter)-Anmeldedaten.',
    '[BAD CREDENTIALS] Unable to post, recipient is missing credentials.' => '[UNGÜLTIGE ANMELDEDATEN] Posten nicht möglich; dem Empfänger fehlen Anmeldedaten.',
    '[EMPTY BODY] The Discord message body is empty.' => '[LEERER INHALT] Der Discord-Nachrichtentext ist leer.',
    '[EMPTY BODY] The Facebook post body is empty.' => '[LEERER INHALT] Der Facebook-Beitragstext ist leer.',
    '[EMPTY BODY] The MQTT payload is empty.' => '[LEERER INHALT] Die MQTT-Nutzlast ist leer.',
    '[EMPTY BODY] The Mastodon post body is empty.' => '[LEERER INHALT] Der Mastodon-Beitragstext ist leer.',
    '[EMPTY BODY] The Slack message body is empty.' => '[LEERER INHALT] Der Slack-Nachrichtentext ist leer.',
    '[EMPTY BODY] The X (Twitter) post body is empty.' => '[LEERER INHALT] Der X (Twitter)-Beitragstext ist leer.',
    '[EMPTY BODY] The email message body was empty.' => '[LEERER INHALT] Der E-Mail-Text war leer.',
    '[FEED ERROR] Could not fetch the feed: {message}' => '[FEED-FEHLER] Feed konnte nicht abgerufen werden: {message}',
    '[FEED ERROR] Could not parse the feed.' => '[FEED-FEHLER] Feed konnte nicht verarbeitet werden.',
    '[FEED ERROR] Could not parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => '[FEED-FEHLER] Feed konnte nicht verarbeitet werden. Die PHP-Erweiterungen `simplexml` und `libxml` sind erforderlich.',
    '[FEED ERROR] Initial feed scan failed: {message}' => '[FEED-FEHLER] Der erste Feed-Scan ist fehlgeschlagen: {message}',
    '[INVALID NUMBER] The recipient phone number is invalid.' => '[UNGÜLTIGE NUMMER] Die Telefonnummer des Empfängers ist ungültig.',
    '[INVALID TYPE] The flash message type is invalid.' => '[UNGÜLTIGER TYP] Der Flash-Nachrichtentyp ist ungültig.',
    '[LINK PREVIEW SKIPPED] {reason}' => '[LINKVORSCHAU ÜBERSPRUNGEN] {reason}',
    '[MISSING IMAGE] Image Attachment field never called the {tag} tag.' => '[FEHLENDES BILD] Das Feld „Bildanhang“ hat das {tag}-Tag nie aufgerufen.',
    '[MISSING IMAGE] Image Attachment field was empty.' => '[FEHLENDES BILD] Das Feld „Bildanhang“ war leer.',
    '[MISSING IMAGE] The {tag} tag was called, but returned an invalid image.' => '[FEHLENDES BILD] Das {tag}-Tag wurde aufgerufen, gab aber ein ungültiges Bild zurück.',
    '[MISSING IMAGE] Unable to send Instagram post, the image needs a public URL.' => '[FEHLENDES BILD] Instagram-Beitrag kann nicht gesendet werden; das Bild benötigt eine öffentliche URL.',
    '[NO MEDIA] No image was attached because the {tag} tag was never invoked in the Image Attachment field.' => '[KEINE MEDIEN] Es wurde kein Bild angehängt, weil das {tag}-Tag im Feld „Bildanhang“ nie aufgerufen wurde.',
    '[NO RECIPIENTS] The Dynamic Recipients snippet did not call setRecipients.' => '[KEINE EMPFÄNGER] Das Snippet für dynamische Empfänger hat setRecipients nicht aufgerufen.',
    '[NO RECIPIENTS] setRecipients was called with an empty value.' => '[KEINE EMPFÄNGER] setRecipients wurde mit einem leeren Wert aufgerufen.',
    '[NO RECIPIENT] No MQTT topic was specified.' => '[KEIN EMPFÄNGER] Es wurde kein MQTT-Thema angegeben.',
    '[NO RECIPIENT] No Slack channel ID was specified.' => '[KEIN EMPFÄNGER] Es wurde keine Slack-Kanal-ID angegeben.',
    '[NO RECIPIENT] No ntfy topic was specified.' => '[KEIN EMPFÄNGER] Es wurde kein ntfy-Thema angegeben.',
    '[NO RECIPIENT] No recipient user was specified for the announcement.' => '[KEIN EMPFÄNGER] Für die Ankündigung wurde kein Empfänger-Benutzer angegeben.',
    '[NO RECIPIENT] No recipient was specified for the email.' => '[KEIN EMPFÄNGER] Für die E-Mail wurde kein Empfänger angegeben.',
    '[NO RECIPIENT] The recipient has no Pushover user key.' => '[KEIN EMPFÄNGER] Der Empfänger hat keinen Pushover-Benutzerschlüssel.',
    '[NO RECIPIENT] The recipient has no phone number.' => '[KEIN EMPFÄNGER] Der Empfänger hat keine Telefonnummer.',
    '[REJECTED BY DISCORD] {error}' => '[ABGELEHNT VON DISCORD] {error}',
    '[REJECTED BY FACEBOOK] {error}' => '[ABGELEHNT VON FACEBOOK] {error}',
    '[REJECTED BY INSTAGRAM] {error}' => '[ABGELEHNT VON INSTAGRAM] {error}',
    '[REJECTED BY MASTODON] {error}' => '[ABGELEHNT VON MASTODON] {error}',
    '[REJECTED BY SLACK] {error}' => '[ABGELEHNT VON SLACK] {error}',
    '[REJECTED BY X (TWITTER)] {error}' => '[ABGELEHNT VON X (TWITTER)] {error}',
    '[SEND FAILED] Authentication failed for {handle}: {reason}' => '[SENDEN FEHLGESCHLAGEN] Authentifizierung für {handle} fehlgeschlagen: {reason}',
    '[SEND FAILED] Authentication failed: {reason}' => '[SENDEN FEHLGESCHLAGEN] Authentifizierung fehlgeschlagen: {reason}',
    "[SEND FAILED] Could not send the email using Craft's native handling. Check your general email settings within Craft." => '[SENDEN FEHLGESCHLAGEN] Die E-Mail konnte nicht über die native Verarbeitung von Craft gesendet werden. Überprüfe deine allgemeinen E-Mail-Einstellungen in Craft.',
    '[SEND FAILED] HTTP {status}: {reason}' => '[SENDEN FEHLGESCHLAGEN] HTTP {status}: {reason}',
    '[SEND FAILED] {error}' => '[SENDEN FEHLGESCHLAGEN] {error}',
    '[SEND FAILED] {reason}' => '[SENDEN FEHLGESCHLAGEN] {reason}',
    '[SKIPPED] Pushover user-key field is not configured on this notification.' => '[ÜBERSPRUNGEN] Das Pushover-Benutzerschlüssel-Feld ist für diese Benachrichtigung nicht konfiguriert.',
    '[SKIPPED] Recipient "{name}" cannot access the control panel.' => '[ÜBERSPRUNGEN] Empfänger „{name}“ kann nicht auf das Control Panel zugreifen.',
    '[SKIPPED] Recipient "{name}" has no Bluesky credentials.' => '[ÜBERSPRUNGEN] Empfänger „{name}“ hat keine Bluesky-Anmeldedaten.',
    '[SKIPPED] Recipient "{name}" has no Craft user account.' => '[ÜBERSPRUNGEN] Empfänger „{name}“ hat kein Craft-Benutzerkonto.',
    '[SKIPPED] Recipient "{name}" has no Discord webhook URL.' => '[ÜBERSPRUNGEN] Empfänger „{name}“ hat keine Discord-Webhook-URL.',
    '[SKIPPED] Recipient "{name}" has no Facebook credentials.' => '[ÜBERSPRUNGEN] Empfänger „{name}“ hat keine Facebook-Anmeldedaten.',
    '[SKIPPED] Recipient "{name}" has no Instagram credentials.' => '[ÜBERSPRUNGEN] Empfänger „{name}“ hat keine Instagram-Anmeldedaten.',
    '[SKIPPED] Recipient "{name}" has no MQTT topic.' => '[ÜBERSPRUNGEN] Empfänger „{name}“ hat kein MQTT-Thema.',
    '[SKIPPED] Recipient "{name}" has no Mastodon credentials.' => '[ÜBERSPRUNGEN] Empfänger „{name}“ hat keine Mastodon-Anmeldedaten.',
    '[SKIPPED] Recipient "{name}" has no Slack bot token.' => '[ÜBERSPRUNGEN] Empfänger „{name}“ hat kein Slack-Bot-Token.',
    '[SKIPPED] Recipient "{name}" has no Slack channel ID.' => '[ÜBERSPRUNGEN] Empfänger „{name}“ hat keine Slack-Kanal-ID.',
    '[SKIPPED] Recipient "{name}" has no X (Twitter) credentials.' => '[ÜBERSPRUNGEN] Empfänger „{name}“ hat keine X (Twitter)-Anmeldedaten.',
    '[SKIPPED] Recipient "{name}" has no email address.' => '[ÜBERSPRUNGEN] Empfänger „{name}“ hat keine E-Mail-Adresse.',
    '[SKIPPED] Recipient "{name}" has no ntfy topic.' => '[ÜBERSPRUNGEN] Empfänger „{name}“ hat kein ntfy-Thema.',
    '[SKIPPED] Recipient "{name}" has no phone number.' => '[ÜBERSPRUNGEN] Empfänger „{name}“ hat keine Telefonnummer.',
    '[SKIPPED] The configured {kind} no longer exists in the plugin settings (uid: {uid}).' => '[ÜBERSPRUNGEN] Der konfigurierte {kind} ist in den Plugin-Einstellungen nicht mehr vorhanden (uid: {uid}).',
    '[SKIPPED] Unrecognized recipient "{value}".' => '[ÜBERSPRUNGEN] Unbekannter Empfänger „{value}“.',
    '[SKIPPED] Unrecognized recipient of type "{type}".' => '[ÜBERSPRUNGEN] Unbekannter Empfängertyp „{type}“.',
    '[TOO LONG] The Discord message body exceeds the 2000-character limit.' => '[ZU LANG] Der Discord-Nachrichtentext überschreitet das Limit von 2000 Zeichen.',
    '[TRUNCATED] Body exceeded {max} characters.' => '[GEKÜRZT] Der Inhalt hat {max} Zeichen überschritten.',
    '[TRUNCATED] Caption exceeded {max} characters.' => '[GEKÜRZT] Die Bildunterschrift hat {max} Zeichen überschritten.',
];
