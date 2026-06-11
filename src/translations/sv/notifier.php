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
    'Notifications' => 'Aviseringar',
    'Notification' => 'Avisering',
    'All notifications' => 'Alla aviseringar',
    'Notification Log' => 'Aviseringslogg',
    'Logs' => 'Loggar',
    'View Notifications' => 'Visa aviseringar',
    'Add a New Notification' => 'Lägg till en ny avisering',
    'notification' => 'avisering',

    // Permissions
    'View notifications' => 'Visa aviseringar',
    'Save notifications' => 'Spara aviseringar',
    'Use the Dynamic Recipients type' => 'Använd typen Dynamiska mottagare',
    'Use the Dynamic Data type' => 'Använd typen Dynamiska data',
    'Test notifications' => 'Testa aviseringar',
    'Send manual notifications' => 'Skicka manuella aviseringar',
    'Delete notifications' => 'Ta bort aviseringar',
    'View notification log' => 'Visa aviseringsloggen',
    'Delete notification log' => 'Ta bort aviseringsloggen',

    // ========================================================
    // NOTIFICATION EDITOR
    // ========================================================

    // Editor: tabs
    'Meta' => 'Meta',
    'Event' => 'Händelse',
    'Message' => 'Meddelande',
    'Recipients' => 'Mottagare',

    // Event tab: type selector
    'Event Type' => 'Händelsetyp',
    'What type of event will activate the notification?' => 'Vilken typ av händelse ska aktivera aviseringen?',
    'Which specific event will activate the notification?' => 'Vilken specifik händelse ska aktivera aviseringen?',

    // Event tab: event types
    'Assets Event' => 'Asset-händelse',
    'Commerce Orders Event' => 'Commerce-orderhändelse',
    'Commerce Products Event' => 'Commerce-produkthändelse',
    'Digital Products Event' => 'Digital Products-händelse',
    'Digital Product Licenses Event' => 'Digital Products-licenshändelse',
    'Solspace Calendar Event' => 'Solspace Calendar-händelse',
    'Entries Event' => 'Inläggshändelse',
    'Users Event' => 'Användarhändelse',
    'Ungrouped Users' => 'Användare utan grupp',

    // Event tab: Feed
    'Feed URL' => 'Flödes-URL',
    'The URL of the RSS, Atom, or JSON feed to watch.' => 'URL till RSS-, Atom- eller JSON-flödet som ska bevakas.',

    // Event tab: field conditions
    'Field Conditions' => 'Fältvillkor',
    'Send the message only when the saved element matches the following conditions.' => 'Skicka meddelandet endast när det sparade elementet uppfyller följande villkor.',
    'has changed' => 'har ändrats',

    // Event tab: element filters (panel chrome + common output)
    '#{elementType} Event Filters' => 'Händelsefilter för #{elementType}',
    'No filters match this event.' => 'Inga filter matchar denna händelse.',
    'Determine whether each message should be sent based on specified conditions.' => 'Avgör utifrån angivna villkor om varje meddelande ska skickas.',
    'Unnamed filter' => 'Namnlöst filter',
    'Must be TRUE to send message' => 'Måste vara TRUE för att skicka meddelandet',
    'Must be FALSE to send message' => 'Måste vara FALSE för att skicka meddelandet',
    'No effect' => 'Ingen effekt',

    // Event tab: element filter rules
    'Element is being saved for the first time' => 'Elementet sparas för första gången',
    'Must be a new entry' => 'Måste vara ett nytt inlägg',
    'Must be an existing entry' => 'Måste vara ett befintligt inlägg',
    'Can be existing or new' => 'Kan vara befintlig eller ny',
    'Element is new' => 'Elementet är nytt',
    'New elements only' => 'Endast nya element',
    'Existing elements only' => 'Endast befintliga element',
    'Element is enabled' => 'Elementet är aktiverat',
    'Must be enabled' => 'Måste vara aktiverat',
    'Must be disabled' => 'Måste vara inaktiverat',
    'Can be enabled or disabled' => 'Kan vara aktiverat eller inaktiverat',
    'Element is a draft' => 'Elementet är ett utkast',
    'Must be a draft' => 'Måste vara ett utkast',
    'Must not be a draft' => 'Får inte vara ett utkast',
    'Can be a draft or non-draft' => 'Kan vara ett utkast eller inte',
    'Element is a provisional draft' => 'Elementet är ett preliminärt utkast',
    'Must be a provisional draft' => 'Måste vara ett preliminärt utkast',
    'Must not be a provisional draft' => 'Får inte vara ett preliminärt utkast',
    'Can be a provisional draft or non-provisional' => 'Kan vara ett preliminärt utkast eller inte',
    'Element is a revision' => 'Elementet är en revision',
    'Must be a revision' => 'Måste vara en revision',
    'Must not be a revision' => 'Får inte vara en revision',
    'Can be a revision or non-revision' => 'Kan vara revision eller inte',
    'Element is being duplicated' => 'Elementet dupliceras',
    'Must be duplicating the element' => 'Måste duplicera elementet',
    'Must not be duplicating the element' => 'Får inte duplicera elementet',
    'Element is being propagated' => 'Elementet propageras',
    'Element must be propagating' => 'Elementet måste propageras',
    'Element must not be propagating' => 'Elementet får inte propageras',
    'Element is being bulk-resaved' => 'Elementet sparas om i bulk',
    'Must be bulk-resaving the element' => 'Måste spara om elementet i bulk',
    'Must not be bulk-resaving the element' => 'Får inte spara om elementet i bulk',

    // Event tab: date trigger
    'On' => 'På',
    'days before' => 'dagar före',
    'days after' => 'dagar efter',
    'Relevant Date' => 'Relevant datum',
    'Send the notification relative to a chosen date.' => 'Skicka aviseringen i förhållande till ett valt datum.',

    // Event tab: recurring schedule
    'Every' => 'Var',
    'on' => 'på',
    'on day' => 'på dag',
    'at' => 'kl.',
    'Starting on' => 'Med början',
    'Day' => 'Dag',
    'Date' => 'Datum',
    'Time' => 'Tid',
    'day(s)' => 'dag(ar)',
    'week(s)' => 'vecka/veckor',
    'month(s)' => 'månad(er)',
    'year(s)' => 'år',
    'day' => 'dag',
    'days' => 'dagar',
    'week' => 'vecka',
    'weeks' => 'veckor',
    'month' => 'månad',
    'months' => 'månader',
    'year' => 'år',
    'years' => 'år',
    'Manual only' => 'Endast manuellt',
    'Scheduled sending' => 'Schemalagd sändning',
    'Generate report on a recurring schedule' => 'Generera rapport enligt ett återkommande schema',
    'Generate report on demand' => 'Generera rapport vid behov',
    'Send on a Recurring Schedule' => 'Skicka enligt ett återkommande schema',
    'Configure Recurring Schedule' => 'Konfigurera återkommande schema',
    'System timezone set to {timezone}' => 'Systemets tidszon inställd på {timezone}',
    'Notifications will be sent on the following schedule...' => 'Aviseringar skickas enligt följande schema...',
    '... and every {cadence} after that.' => '... och därefter var {cadence}.',
    'On what recurring schedule should the notification be sent?' => 'Enligt vilket återkommande schema ska aviseringen skickas?',
    'Whether the message should be sent on a schedule, or only triggered manually.' => 'Om meddelandet ska skickas enligt ett schema eller endast utlösas manuellt.',
    'The message can always be sent using the "Send system snapshot" button above.' => 'Meddelandet kan alltid skickas med knappen "Skicka systemögonblicksbild" ovan.',
    'The message can always be sent using the "Send data report" button above.' => 'Meddelandet kan alltid skickas med knappen "Skicka datarapport" ovan.',

    // Event tab: Dynamic Data snippet field
    'Twig Snippet to Determine Data' => 'Twig-utdrag för att bestämma data',
    'Enter a custom Twig snippet to [determine which data will be included]({url}).' => 'Ange ett anpassat Twig-snippet för att [bestämma vilka data som ska inkluderas]({url}).',
    'The snippet **must** include a `{% setData %}` tag.' => 'Snippeten **måste** innehålla en `{% setData %}`-tagg.',
    'You do not have permission to edit dynamic data.' => 'Du har inte behörighet att redigera dynamiska data.',

    // Event tab: manual trigger
    'Trigger Label' => 'Etikett för utlösare',
    'An element action label (helps to differentiate multiple triggers).' => 'En etikett för elementåtgärden (hjälper till att skilja flera utlösare åt).',
    'Send Notification' => 'Skicka avisering',

    // Message tab: type selector
    'Message Type' => 'Meddelandetyp',
    'What type of message will be sent?' => 'Vilken typ av meddelande ska skickas?',
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are also supported.' => '[Templating]({templatingUrl}) och [specialvariabler]({variablesUrl}) stöds också.',

    // Details sidebar: queue
    'Use Queue' => 'Använd kö',
    'Immediate' => 'Direkt',
    'Queue' => 'Kö',
    'jobs queue' => 'jobbkön',
    'Whether the message will be sent immediately, or added to the {link}.' => 'Om meddelandet skickas direkt eller läggs till i {link}.',
    'Flash messages never use the queue.' => 'Flash-meddelanden använder aldrig kön.',
    'Announcements always use the queue.' => 'Kungörelser använder alltid kön.',

    // Message tab: Email
    "User's Email Address Field" => 'Användarfält för e-postadress',
    'Select which User field contains the recipient\'s email address.' => 'Välj användarfältet som innehåller mottagarens e-postadress.',
    'Email Subject' => 'E-postämne',
    'Subject line of the email.' => 'Ämnesrad för e-postmeddelandet.',
    'Dynamic Subject Line' => 'Dynamisk ämnesrad',
    'Email Body' => 'E-postinnehåll',
    'Body of the email. Supports HTML.' => 'Innehåll i e-postmeddelandet. Stöder HTML.',

    // Message tab: rich-text (Trix) toolbar
    'Rich Text' => 'Rik text',
    'Bold' => 'Fetstil',
    'Italic' => 'Kursiv',
    'Underline' => 'Understruken',
    'Strikethrough' => 'Genomstruken',
    'Bullets' => 'Punktlista',
    'Numbers' => 'Numrering',
    'Heading' => 'Rubrik',
    'Code' => 'Kod',
    'Undo' => 'Ångra',
    'Redo' => 'Gör om',

    // Message tab: SMS
    "User's Phone Number Field" => 'Användarfält för telefonnummer',
    'Select which User field contains the recipient\'s phone number.' => 'Välj användarfältet som innehåller mottagarens telefonnummer.',
    'SMS Message Body' => 'SMS-meddelandetext',
    'Body of the SMS (text message). Plain text only.' => 'Innehåll i SMS:et (textmeddelande). Endast vanlig text.',

    // Message tab: Announcement
    'Announcement Title' => 'Tillkännagivandets titel',
    'Heading of the announcement.' => 'Rubrik på meddelandet.',
    'Dynamic Announcement Title' => 'Dynamisk meddelandetitel',
    'Announcement Message' => 'Tillkännagivandets meddelande',
    'Body of the announcement. Supports Markdown.' => 'Innehåll i meddelandet. Stöder Markdown.',

    // Message tab: Flash
    'Flash Message Type' => 'Typ av flash-meddelande',
    'Which type of flash message should appear?' => 'Vilken typ av flash-meddelande ska visas?',
    'Flash Message Title' => 'Titel för flash-meddelande',
    'Heading of the flash message.' => 'Rubrik på flash-meddelandet.',
    'Dynamic Flash Message Title' => 'Dynamisk Flash-meddelandetitel',
    'Flash Message Details' => 'Detaljer för flash-meddelande',
    'Optionally include details below the heading. Supports Markdown and HTML.' => 'Inkludera eventuellt detaljer under rubriken. Stöder Markdown och HTML.',

    // Message tab: Pushover
    "Field containing each user's Pushover key" => 'Användarens Pushover-nyckelfält',
    'Select which User field contains the recipient\'s Pushover user key.' => 'Välj användarfältet som innehåller mottagarens Pushover-nyckel.',
    'Pushover Title' => 'Pushover-titel',
    'Optionally include a heading above the body.' => 'Inkludera eventuellt en rubrik ovanför innehållet.',
    'Dynamic Pushover Title' => 'Dynamisk Pushover-titel',
    'Pushover Body' => 'Pushover-innehåll',
    'Body of the Pushover notification. Plain text only.' => 'Innehåll i Pushover-aviseringen. Endast vanlig text.',

    // Message tab: ntfy
    'Priority' => 'Prioritet',
    'Priority level of the ntfy message.' => 'Prioritetsnivå för ntfy-meddelandet.',
    'Tags' => 'Taggar',
    'Optionally include comma-separated [emoji shortcodes](https://docs.ntfy.sh/emojis/).' => 'Inkludera eventuellt kommaseparerade [emoji-koder](https://docs.ntfy.sh/emojis/).',
    'ntfy Title' => 'ntfy-titel',
    'Dynamic ntfy Title' => 'Dynamisk ntfy-titel',
    'ntfy Body' => 'ntfy-innehåll',
    'Body of the ntfy notification.' => 'Innehåll i ntfy-aviseringen.',
    'ntfy Link URL' => 'ntfy-länk-URL',
    'Optionally open a URL when the notification is clicked.' => 'Öppna eventuellt en URL när aviseringen klickas.',
    'Enable Markdown' => 'Aktivera Markdown',
    'Whether to parse the body as Markdown in supported clients.' => 'Om innehållet ska tolkas som Markdown i klienter som stöder det.',
    'Regular text only' => 'Endast vanlig text',
    'Markdown enabled' => 'Markdown aktiverat',

    // Message tab: Slack
    'Slack Message Body' => 'Slack-meddelandetext',
    'Supports standard [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) syntax. Optionally supports HTML _(see below)_.' => 'Stödjer standard [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting)-syntax. Stödjer valfritt HTML _(se nedan)_.',
    'Render Message Body as HTML' => 'Rendera meddelandeinnehåll som HTML',
    'Whether to only parse as [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), or additionally parse it as HTML.' => 'Om endast [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) ska tolkas, eller även HTML.',
    'Render Link Previews' => 'Visa länkförhandsgranskningar',
    'Whether Slack should unfurl link previews for URLs in the message body.' => 'Om Slack ska visa länkförhandsvisningar för URL:er i meddelandetexten.',
    'Don\'t unfurl' => 'Expandera inte',
    'Expand link previews' => 'Expandera länkförhandsgranskningar',
    'Bot Name' => 'Användarnamn',
    'Optionally override the app\'s display name.' => 'Skriv eventuellt över appens visningsnamn.',
    'Dynamic Bot Name' => 'Dynamiskt botnamn',
    'Bot Icon URL' => 'Ikon-URL',
    'Optionally override the app\'s icon with a URL.' => 'Skriv eventuellt över appens ikon med en URL.',
    'Bot Emoji' => 'Ikon-emoji',
    'Optionally override the app\'s icon with an emoji. Used only when Bot Icon URL is empty.' => 'Skriv eventuellt över appens ikon med en emoji. Används endast när Bot Icon URL är tom.',

    // Message tab: Discord
    'Discord Message Body' => 'Discord-meddelandetext',
    'Supports standard Markdown, and optionally HTML _(see below)_. Max 2000 characters.' => 'Stöder standard-Markdown och valfritt HTML _(se nedan)_. Max 2000 tecken.',
    'Whether to only parse as Markdown, or additionally parse it as HTML.' => 'Om endast Markdown ska tolkas, eller även HTML.',
    'Markdown only' => 'endast Markdown',
    'Markdown + HTML' => 'Markdown + HTML',
    'Whether Discord should unfurl link previews for URLs in the message body.' => 'Om Discord ska visa länkförhandsvisningar för URL:er i meddelandetexten.',
    'Webhook Username' => 'Webhook-användarnamn',
    'Optionally override the webhook\'s display name.' => 'Skriv eventuellt över Webhookens visningsnamn.',
    'Dynamic Username' => 'Dynamiskt användarnamn',
    'Webhook Avatar URL' => 'Webhook-avatar-URL',
    'Optionally override the webhook\'s avatar with a URL.' => 'Skriv eventuellt över Webhookens avatar med en URL.',

    // Message tab: Bluesky
    'Post Body' => 'Inläggstext',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => 'Vanlig text, max 300 tecken. URL:er och `@handle.tld`-omnämnanden länkas automatiskt.',
    'Generate Link Preview' => 'Generera länkförhandsvisning',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => 'Generera automatiskt ett förhandsgranskningskort när inläggets text innehåller en URL.',
    'No card' => 'Inget kort',
    'Generate preview card' => 'Generera förhandsvisningskort',

    // Message tab: Mastodon
    'Plain text, max 500 characters. URLs will unfurl automatically.' => 'Vanlig text, max 500 tecken. URL:er fälls ut automatiskt.',
    'Visibility' => 'Synlighet',
    'Who will be able to see this post?' => 'Vem kommer att kunna se det här inlägget?',

    // Message tab: MQTT
    'Payload' => 'Innehåll',
    'The JSON or plain text message published to the MQTT topic.' => 'JSON- eller klartextmeddelandet som publiceras till MQTT-ämnet.',
    'Quality of Service' => 'Tjänstekvalitet',
    'Delivery guarantee for this message.' => 'Leveransgaranti för detta meddelande.',
    'Retain' => 'Behåll',
    'Whether the broker keeps this as the topic\'s last message for future subscribers.' => 'Om brokern behåller detta som det senaste meddelandet på ämnet och levererar det till framtida prenumeranter.',
    'Don\'t retain' => 'Behåll inte',

    // Recipients tab: type selector & user/group pickers
    'Recipients Type' => 'Mottagartyp',
    'Who will receive this message?' => 'Vem ska få det här meddelandet?',
    'Add a message recipient' => 'Lägg till en mottagare',
    'Select User(s)' => 'Välj användare',
    'Which users will receive the message?' => 'Vilka användare ska få meddelandet?',
    'Which user groups will receive the message?' => 'Vilka användargrupper ska få meddelandet?',

    // Recipients tab: channel pickers (ntfy, Slack, Discord, Bluesky, Mastodon, MQTT)
    'Select ntfy topic(s)' => 'Välj ntfy-ämne(n)',
    'Which topics should receive this message?' => 'Vilka ämnen ska ta emot detta meddelande?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'Inga ntfy-ämnen konfigurerade. Lägg till ett i [Inställningar → ntfy]({url}).',
    'No ntfy topics configured. Topics can only be added in an environment that allows administrative changes.' => 'Inga ntfy-ämnen konfigurerade. Ämnen kan endast läggas till i en miljö som tillåter administrativa ändringar.',
    'Select Slack channel(s)' => 'Välj Slack-kanal(er)',
    'Which channels should receive this message?' => 'Vilka kanaler ska ta emot detta meddelande?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Inga Slack-kanaler konfigurerade. Lägg till en i [Inställningar → Slack]({url}).',
    'No Slack channels configured. Channels can only be added in an environment that allows administrative changes.' => 'Inga Slack-kanaler konfigurerade. Kanaler kan endast läggas till i en miljö som tillåter administrativa ändringar.',
    'Select Discord channel(s)' => 'Välj Discord-kanal(er)',
    'No Discord channels configured. Add one in [Settings → Discord]({url}).' => 'Inga Discord-kanaler konfigurerade. Lägg till en i [Inställningar → Discord]({url}).',
    'No Discord channels configured. Channels can only be added in an environment that allows administrative changes.' => 'Inga Discord-kanaler konfigurerade. Kanaler kan endast läggas till i en miljö som tillåter administrativa ändringar.',
    'Select Bluesky account(s)' => 'Välj Bluesky-konto(n)',
    'Which accounts should post this message?' => 'Vilka konton ska publicera detta meddelande?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Inga Bluesky-konton konfigurerade. Lägg till ett i [Inställningar → Bluesky]({url}).',
    'No Bluesky accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Inga Bluesky-konton konfigurerade. Konton kan endast läggas till i en miljö som tillåter administrativa ändringar.',
    'Select Mastodon account(s)' => 'Välj Mastodon-konto(n)',
    'No Mastodon accounts configured. Add one in [Settings → Mastodon]({url}).' => 'Inga Mastodon-konton konfigurerade. Lägg till ett i [Inställningar → Mastodon]({url}).',
    'No Mastodon accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Inga Mastodon-konton konfigurerade. Konton kan endast läggas till i en miljö som tillåter administrativa ändringar.',
    'Select MQTT topic(s)' => 'Välj MQTT-ämne(n)',
    'No MQTT topics configured. Add one in [Settings → MQTT]({url}).' => 'Inga MQTT-ämnen konfigurerade. Lägg till ett under [Inställningar → MQTT]({url}).',
    'No MQTT topics configured. Topics can only be added in an environment that allows administrative changes.' => 'Inga MQTT-ämnen konfigurerade. Ämnen kan endast läggas till i en miljö som tillåter administrativa ändringar.',
    'Not a valid topic. Must not be empty or contain the `+` or `#` wildcards.' => 'Inte ett giltigt ämne. Får inte vara tomt eller innehålla jokertecknen `+` eller `#`.',

    // Recipients tab: dynamic recipients snippet
    'Twig Snippet to Determine Recipients' => 'Twig-utdrag för att bestämma mottagare',
    'Enter a custom Twig snippet to [determine who will receive the message]({url}).' => 'Ange ett anpassat Twig-snippet för att [bestämma vem som ska få meddelandet]({url}).',
    'The snippet **must** include a `{% setRecipients %}` tag.' => 'Snippeten **måste** innehålla en `{% setRecipients %}`-tagg.',

    // ========================================================
    // SETTINGS
    // ========================================================

    // Settings: nav & page chrome
    'Notifier Settings' => 'Notifier-inställningar',
    'General' => 'Allmänt',
    'Twilio' => 'Twilio',
    'Pushover' => 'Pushover',
    'ntfy' => 'ntfy',
    'Slack' => 'Slack',
    'Discord' => 'Discord',
    'Bluesky' => 'Bluesky',
    'Mastodon' => 'Mastodon',
    'MQTT' => 'MQTT',

    // Settings: shared intro lines
    'Consult the [{name} setup guide]({url}) for complete instructions.' => 'Se [{name}-installationsguiden]({url}) för fullständiga instruktioner.',
    'Sensitive values can be stored in your `.env` file and referenced here.' => 'Känsliga värden kan lagras i din `.env`-fil och refereras här.',

    // Settings: Notification order
    'Notification Order' => 'Ordning för aviseringar',
    'Notifications can be dragged into any order on the index page. Choose where new notifications land in that order.' => 'Aviseringar kan dras till en egen ordning på listsidan. Välj var nya aviseringar läggs till i den ordningen.',
    'Default Placement' => 'Standardplacering',
    'Where new notifications are added to the list.' => 'Var nya aviseringar läggs till i listan.',
    'Before other notifications' => 'Före andra aviseringar',
    'After other notifications' => 'Efter andra aviseringar',

    // Settings: Logging
    'Logging' => 'Loggning',
    "Notifier keeps a running log of every message it sends. You usually won't need to change this, but you can limit how many log entries are kept in the database." => 'Notifier för en löpande logg över skickade meddelanden. Det är vanligtvis inte nödvändigt, men du kan begränsa antalet logghändelser som registreras i databasen.',
    'Enable Logging' => 'Aktivera loggning',
    'When disabled, Notifier will not write anything to the notification log.' => 'När inaktiverat skriver Notifier ingenting till aviseringsloggen.',
    'Number of days to retain log events' => 'Antal dagar att behålla logghändelser',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Behåll logghändelser i högst så här många dagar. Lämna tomt för ingen gräns.',
    'Number of log events to retain' => 'Antal logghändelser att behålla',
    'At most, keep this many log events. Leave blank for no limit.' => 'Behåll högst så här många logghändelser. Lämna tomt för ingen gräns.',

    // Settings: Scheduled sending
    'Scheduled Sending' => 'Schemalagd sändning',
    'A shared secret that authenticates scheduled runs triggered over the web. You only need this if you trigger the schedule from the web endpoint.' => 'Delad hemlighet för att autentisera webbförfrågningar för schemalagd körning. Krävs endast när schemat utlöses via webbslutpunkten.',
    'Scheduled-Run Token' => 'Token för schemalagd körning',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => 'Skickas med varje förfrågan som X-Notifier-Token-rubrik eller token-parameter i kroppen.',

    // Settings: Twilio
    'Send SMS text messages through [Twilio](https://www.twilio.com).' => 'Skicka SMS-textmeddelanden via [Twilio](https://www.twilio.com).',
    'Twilio Account SID' => 'Twilio Account SID',
    'Twilio Auth Token' => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)' => 'Twilio-telefonnummer (skickar varje SMS-meddelande)',
    'SMS Testing' => 'SMS-testning',
    'Optional. When set, every SMS is sent to this number instead of the actual recipient.' => 'Valfritt. Om angivet skickas varje SMS till detta nummer i stället för den faktiska mottagaren.',
    'Test phone number' => 'Testtelefonnummer',

    // Settings: Pushover
    'Send push notifications through [Pushover](https://pushover.net).' => 'Skicka push-aviseringar via [Pushover](https://pushover.net).',
    'Application API Token' => 'Programmets API-token',
    'The 30-character app token from your Pushover application.' => 'Det 30-teckens app-token från din Pushover-applikation.',

    // Settings: ntfy
    'Send push notifications through [ntfy](https://ntfy.sh).' => 'Skicka push-aviseringar via [ntfy](https://ntfy.sh).',
    'Server URL' => 'Server-URL',
    'Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`.' => 'Valfritt, peka på en självhostad ntfy-instans (om aktuellt). Standard `https://ntfy.sh`.',
    'Access token' => 'Åtkomsttoken',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Valfritt, krävs för skyddade ämnen eller självhostade instanser med autentisering.',
    'ntfy Topics' => 'ntfy-ämnen',
    'Add the ntfy topics you want to send to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Lägg till de ntfy-ämnen du vill skicka meddelanden till. Varje ämne blir tillgängligt som mottagare på fliken **Mottagare** när du konfigurerar en avisering.',
    'Topics' => 'Ämnen',
    "Click any row's **Test** button to send a quick test message to that topic." => 'Klicka på **Testa**-knappen på valfri rad för att skicka ett snabbt testmeddelande till det ämnet.',
    'Label' => 'Etikett',
    'Topic' => 'Ämne',
    'Add a topic' => 'Lägg till ett ämne',

    // Settings: Slack
    'Post messages to your Slack channels.' => 'Skicka meddelanden till dina Slack-kanaler.',
    'Channels' => 'Kanaler',
    "Click any row's **Test** button to send a quick test message to that channel." => 'Klicka på **Testa**-knappen på valfri rad för att skicka ett snabbt testmeddelande till den kanalen.',
    'Bot Token' => 'Bot-token',
    'Channel ID' => 'Kanal-ID',
    'Add a channel' => 'Lägg till en kanal',
    'Not a valid Bot Token. Must start with `xoxb-`.' => 'Ogiltigt bot-token. Måste börja med `xoxb-`.',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => 'Ogiltigt kanal-ID. Måste se ut som `C01234ABCD`.',

    // Settings: Discord
    'Post messages to your Discord channels.' => 'Skicka meddelanden till dina Discord-kanaler.',
    'Webhook URL' => 'Webhook-URL',
    'Not a valid Webhook URL. Must start with `https://discord.com/api/webhooks/`.' => 'Ogiltig Webhook-URL. Måste börja med `https://discord.com/api/webhooks/`.',

    // Settings: Bluesky
    'Publish posts to your [Bluesky](https://bsky.app) accounts.' => 'Publicera inlägg till dina [Bluesky](https://bsky.app)-konton.',
    'PDS URL' => 'PDS-URL',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'Standard https://bsky.social. Peka på en anpassad PDS om din installation federerar.',
    'Bluesky Accounts' => 'Bluesky-konton',
    'Add the Bluesky accounts you want to post from. Each account becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Lägg till de Bluesky-konton du vill publicera från. Varje konto blir tillgängligt som mottagare på fliken **Mottagare** när du konfigurerar en avisering.',
    'Accounts' => 'Konton',
    "Click any row's **Test** button to confirm the account authenticates." => 'Klicka på **Testa**-knappen på valfri rad för att bekräfta att kontot autentiseras.',
    'Handle' => 'Handle',
    'App password' => 'App-lösenord',
    'Add an account' => 'Lägg till ett konto',

    // Settings: Mastodon
    'Publish posts to your [Mastodon](https://joinmastodon.org) accounts.' => 'Publicera inlägg till dina [Mastodon](https://joinmastodon.org)-konton.',
    'Click any row\'s **Test** button to verify that account\'s credentials. No posts are made.' => 'Klicka på **Testa**-knappen på valfri rad för att verifiera det kontots uppgifter. Inga inlägg görs.',
    'Instance URL' => 'Instans-URL',
    'Access Token' => 'Åtkomsttoken',

    // Settings: MQTT
    'Publish messages to an MQTT broker, handy for IoT and home-automation setups.' => 'Publicera meddelanden till en MQTT-broker, praktiskt för IoT- och hemautomationsuppsättningar.',
    'Host' => 'Värd',
    'Broker hostname, without a protocol or port.' => 'Brokerns värdnamn, utan protokoll eller port.',
    'Port' => 'Port',
    'Optional. Defaults to 8883 when TLS is enabled, otherwise 1883.' => 'Valfritt. Standard är 8883 när TLS är aktiverat, annars 1883.',
    'Use TLS' => 'Använd TLS',
    'Whether to connect to the broker over a secure TLS socket.' => 'Om anslutningen till brokern ska ske via en säker TLS-socket.',
    'Username' => 'Användarnamn',
    'Optional, for brokers that require username/password authentication.' => 'Valfritt, för brokers som kräver autentisering med användarnamn/lösenord.',
    'Password' => 'Lösenord',
    'MQTT Version' => 'MQTT-version',
    'Protocol version sent to the broker.' => 'Protokollversion som skickas till brokern.',
    'Client ID' => 'Klient-ID',
    'Optional. A unique client ID is generated automatically when left blank.' => 'Valfritt. Ett unikt klient-ID genereras automatiskt när fältet lämnas tomt.',
    'Mutual TLS' => 'Ömsesidig TLS',
    'Optional. Needed for brokers that authenticate clients with certificates, such as AWS IoT Core. Enter the server file paths to your certificate files. You can use a `.env` variable or `@alias` reference.' => 'Valfritt. Krävs för brokers som autentiserar klienter med certifikat, som AWS IoT Core. Ange serverfilsökvägar till certifikatfilerna (en `.env`-variabel eller `@alias`-referens tillåts).',
    'CA Certificate File' => 'CA-certifikatfil',
    'Path to the certificate authority (CA) file.' => 'Sökväg till certifikatutfärdarens (CA) fil.',
    'Client Certificate File' => 'Klientcertifikatfil',
    'Path to the client certificate file.' => 'Sökväg till klientcertifikatfilen.',
    'Client Key File' => 'Klientnyckelfil',
    'Path to the client private key file.' => 'Sökväg till klientens privata nyckelfil.',
    'MQTT Topics' => 'MQTT-ämnen',
    'Add the MQTT topics you want to publish to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Lägg till de MQTT-ämnen du vill publicera till. Varje ämne blir tillgängligt som mottagare på fliken **Mottagare** när du konfigurerar en avisering.',
    'Click any row\'s **Test** button to publish a quick test message to that topic.' => 'Klicka på **Testa**-knappen på valfri rad för att publicera ett snabbt testmeddelande till det ämnet.',

    // ========================================================
    // MANUAL SEND & TEST
    // ========================================================

    // Manual send & test
    'Send a test message' => 'Skicka ett testmeddelande',
    'Send a REAL test notification?\\n\\n⚠️ Uses a random sample of real data.\\n⚠️ Sends a real message via the configured channel.\\n⚠️ Delivers to the real configured recipient(s).' => 'Skicka en RIKTIG testavisering?\\n\\n⚠️ Använder ett slumpmässigt urval av riktiga data.\\n⚠️ Skickar ett riktigt meddelande via den konfigurerade kanalen.\\n⚠️ Levereras till de riktiga konfigurerade mottagarna.',
    'Test' => 'Testa',
    'Send system snapshot' => 'Skicka systemögonblicksbild',
    'Send data report' => 'Skicka datarapport',
    'Are you sure you want to send this notification?' => 'Är du säker på att du vill skicka den här aviseringen?',
    'This notification cannot be triggered manually.' => 'Den här aviseringen kan inte utlösas manuellt.',
    'This notification no longer applies to the selected element.' => 'Den här aviseringen gäller inte längre det valda elementet.',

    // ========================================================
    // RUNTIME OUTPUT
    // ========================================================

    // Runtime: dispatch log feedback
    'Sending {messageType} to {recipient}.' => 'Skickar {messageType} till {recipient}.',
    'Adding message to queue.' => 'Lägger till meddelandet i kön.',
    'Sending message immediately (bypassing queue).' => 'Skickar meddelandet direkt (köen kringgås).',
    'Unable to parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => 'Kan inte tolka flödet. PHP-tilläggen `simplexml` och `libxml` krävs.',
    'Unable to parse the feed.' => 'Kan inte tolka flödet.',
    'Unable to fetch the feed: {message}' => 'Kan inte hämta flödet: {message}',
    'Initial feed scan failed: {message}' => 'Inledande genomsökning av flödet misslyckades: {message}',

    // Runtime: controller responses
    'Test notification dispatched.' => 'Testavisering skickad.',
    'No messages were dispatched. Check the recipient configuration.' => 'Inga meddelanden skickades. Kontrollera mottagarkonfigurationen.',
    'Unable to send test: the feed could not be read or has no items.' => 'Kan inte skicka test: flödet kunde inte läsas eller saknar objekt.',
    'Unable to send test: no element matches the configured filters.' => 'Kan inte skicka test: inget element matchar de konfigurerade filtren.',
    "Couldn't save settings." => 'Inställningarna kunde inte sparas.',
    'Settings saved.' => 'Inställningar sparade.',
    'Topic is empty.' => 'Ämnet är tomt.',
    'Server URL is not configured.' => 'Server-URL är inte konfigurerad.',
    'Test message from Notifier.' => 'Testmeddelande från Notifier.',
    'HTTP {status}' => 'HTTP {status}',
    'Test message sent successfully.' => 'Testmeddelande skickat.',
    'Handle and app password are required.' => 'Handle och app-lösenord krävs.',
    'Authentication failed.' => 'Autentisering misslyckades.',
    'Successfully authenticated. No messages were posted.' => 'Autentiseringen lyckades. Inga meddelanden publicerades.',
    'Log events deleted.' => 'Logghändelser borttagna.',
    'Notification sent.' => 'Avisering skickad.',
    'Notification was not sent. Check the Notification Log for details.' => 'Aviseringen skickades inte. Se Aviseringsloggen för mer information.',
    'Instance URL and access token are required.' => 'Instans-URL och åtkomsttoken krävs.',
    'Mastodon rejected the request: {error}' => 'Mastodon avvisade förfrågan: {error}',
    'Successfully authenticated as @{handle}. No posts were made.' => 'Autentiserad som @{handle}. Inga inlägg gjordes.',
    'Broker host is not configured.' => 'Broker-värden är inte konfigurerad.',

    // Outbound: per-channel send results
    'Unable to send email, no recipient specified.' => 'Det går inte att skicka e-post, ingen mottagare angiven.',
    'Unable to send email, the message body was empty.' => 'Det går inte att skicka e-post, meddelandets innehåll var tomt.',
    "Unable to send the email using Craft's native email handling." => 'Det går inte att skicka e-post med Crafts inbyggda e-posthantering.',
    'Check your general email settings within Craft.' => 'Kontrollera de allmänna e-postinställningarna i Craft.',
    'Successfully sent email message!' => 'E-postmeddelande skickat!',
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[Ogiltiga Twilio-uppgifter.]({url}) {missing} saknas.',
    'Unable to send SMS, no Twilio phone number exists.' => 'Det går inte att skicka SMS, inget Twilio-telefonnummer finns.',
    'Unable to send SMS, no recipient phone number exists.' => 'Det går inte att skicka SMS, inget mottagartelefonnummer finns.',
    'Unable to send SMS, recipient phone number is invalid.' => 'Det går inte att skicka SMS, mottagarens telefonnummer är ogiltigt.',
    'Successfully sent SMS message!' => 'SMS-meddelande skickat!',
    'Unable to post announcement, no recipient userId specified.' => 'Det går inte att publicera tillkännagivandet: inget userId för mottagaren angivet.',
    'Successfully posted announcement!' => 'Tillkännagivande publicerat!',
    'Unable to send the flash message, invalid flash type.' => 'Det går inte att skicka flash-meddelandet, ogiltig flash-typ.',
    'Successfully sent flash message!' => 'Flash-meddelande skickat!',
    '[Invalid Pushover credentials.]({url}) Missing app token.' => '[Ogiltiga Pushover-uppgifter.]({url}) App-token saknas.',
    'Unable to send Pushover message, no user key on recipient.' => 'Det går inte att skicka Pushover-meddelande: ingen användarnyckel hos mottagaren.',
    'Pushover POST failed: {reason}' => 'Pushover POST misslyckades: {reason}',
    'Successfully sent Pushover message!' => 'Pushover-meddelande skickat!',
    'Unable to send ntfy message, no topic specified.' => 'Det går inte att skicka ntfy-meddelande: inget ämne angivet.',
    'ntfy POST failed with HTTP {status}: {reason}' => 'ntfy POST misslyckades med HTTP {status}: {reason}',
    'ntfy POST failed: {reason}' => 'ntfy POST misslyckades: {reason}',
    'Successfully sent ntfy message to topic "{topic}".' => 'ntfy-meddelande skickat till ämnet "{topic}".',
    'Unable to send Slack message, no bot token.' => 'Kan inte skicka Slack-meddelande: inget bot-token.',
    'Unable to send Slack message, no channel ID.' => 'Kan inte skicka Slack-meddelande: inget kanal-ID.',
    'Unable to send Slack message, body is empty.' => 'Det går inte att skicka Slack-meddelande: innehållet är tomt.',
    'Slack rejected the message: {error}' => 'Slack avvisade meddelandet: {error}',
    'Slack POST failed: {reason}' => 'Slack POST misslyckades: {reason}',
    'Successfully sent Slack message to "{label}".' => 'Slack-meddelande skickat till "{label}".',
    'Unable to send Discord message, no webhook URL.' => 'Det går inte att skicka Discord-meddelande: ingen Webhook-URL.',
    'Unable to send Discord message, body is empty.' => 'Det går inte att skicka Discord-meddelande: innehållet är tomt.',
    'Unable to send Discord message, body exceeds the 2000-character limit.' => 'Det går inte att skicka Discord-meddelande: innehållet överstiger gränsen på 2000 tecken.',
    'Discord rejected the message: {error}' => 'Discord avvisade meddelandet: {error}',
    'Discord POST failed: {reason}' => 'Discord POST misslyckades: {reason}',
    'Successfully sent Discord message to "{label}".' => 'Discord-meddelande skickat till "{label}".',
    'Unable to send Bluesky post, recipient is missing credentials.' => 'Det går inte att skicka Bluesky-inlägg: mottagaren saknar uppgifter.',
    'Body exceeded {max} characters, truncated.' => 'Innehållet översteg {max} tecken och trunkerades.',
    'Successfully posted to Bluesky as "{label}".' => 'Publicerat på Bluesky som "{label}".',
    'Bluesky auth failed for {handle}: {reason}' => 'Bluesky-autentisering misslyckades för {handle}: {reason}',
    'Bluesky auth failed: {reason}' => 'Bluesky-autentisering misslyckades: {reason}',
    'Bluesky post failed: {reason}' => 'Bluesky-inlägg misslyckades: {reason}',
    'Bluesky link preview skipped: {reason}' => 'Bluesky-länkförhandsvisning hoppades över: {reason}',
    'Unable to send Mastodon post, no instance URL.' => 'Det går inte att skicka Mastodon-inlägg: ingen instans-URL.',
    'Unable to send Mastodon post, no access token.' => 'Det går inte att skicka Mastodon-inlägg: ingen åtkomsttoken.',
    'Unable to send Mastodon post, body is empty.' => 'Det går inte att skicka Mastodon-inlägg: innehållet är tomt.',
    'Mastodon rejected the post: {error}' => 'Mastodon avvisade inlägget: {error}',
    'Mastodon POST failed: {reason}' => 'Mastodon POST misslyckades: {reason}',
    'Successfully sent Mastodon post to "{label}".' => 'Mastodon-inlägg skickat till "{label}".',
    'Unable to send MQTT message, no broker host configured.' => 'Det går inte att skicka MQTT-meddelandet, ingen broker-värd är konfigurerad.',
    'Unable to send MQTT message, no topic specified.' => 'Det går inte att skicka MQTT-meddelandet, inget ämne angivet.',
    'Unable to send MQTT message, the payload is empty.' => 'Det går inte att skicka MQTT-meddelandet, innehållet är tomt.',
    'MQTT publish failed: {reason}' => 'MQTT-publicering misslyckades: {reason}',
    'Successfully sent MQTT message to topic "{topic}".' => 'MQTT-meddelande skickat till ämnet "{topic}".',

    // Recipient warnings
    'Recipient "{name}" has no email address.' => 'Mottagaren "{name}" har ingen e-postadress.',
    'Recipient "{name}" has no phone number.' => 'Mottagaren "{name}" har inget telefonnummer.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => 'Mottagaren "{name}" har ingen kopplad användare; tillkännagivandet kan inte skickas.',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => 'Mottagaren "{name}" har inte åtkomst till kontrollpanelen; tillkännagivandet kan inte skickas.',
    'Pushover user-key field is not configured on this notification.' => 'Pushover-användarnyckelfältet är inte konfigurerat på denna avisering.',
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => 'Mottagaren "{name}" har ingen kopplad användare; Pushover-meddelandet kan inte skickas.',
    '[SKIPPED] User "{name}" has no Pushover key.' => '[ÖVERHOPPAD] Användaren "{name}" har ingen Pushover-nyckel.',
    'Recipient "{name}" has no ntfy topic.' => 'Mottagaren "{name}" har inget ntfy-ämne.',
    'Recipient "{name}" has no Slack bot token.' => 'Mottagaren "{name}" har inget Slack-bot-token.',
    'Recipient "{name}" has no Slack channel ID.' => 'Mottagaren "{name}" har inget Slack-kanal-ID.',
    'Recipient "{name}" has no Discord webhook URL.' => 'Mottagaren "{name}" har ingen Discord-Webhook-URL.',
    'Recipient "{name}" has no Bluesky credentials.' => 'Mottagaren "{name}" har inga Bluesky-uppgifter.',
    'Recipient "{name}" has no Mastodon credentials.' => 'Mottagaren "{name}" har inga Mastodon-uppgifter.',
    'Recipient "{name}" has no MQTT topic.' => 'Mottagaren "{name}" har inget MQTT-ämne.',

    // Errors & exceptions
    'Invalid element event: {class}' => 'Ogiltig elementhändelse: {class}',
    'Invalid notification ID: {id}' => 'Ogiltigt aviserings-ID: {id}',
    'Invalid email message mode.' => 'Ogiltigt e-postmeddelandeläge.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Du har inte behörighet att använda typen Dynamiska mottagare.',
    'Dynamic recipients snippet did not call setRecipients.' => 'Utdraget för dynamiska mottagare anropade inte setRecipients.',
    'setRecipients was called with an empty value.' => 'setRecipients anropades med ett tomt värde.',
    'Unrecognized recipient of type "{type}".' => 'Okänd mottagare av typen "{type}".',
    'Unrecognized recipient "{value}".' => 'Okänd mottagare "{value}".',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => 'Konfigurerad {kind} finns inte längre i plug-in-inställningarna (uid: {uid}).',
    'Invalid settings section: {section}' => 'Ogiltig inställningssektion: {section}',
    'User not authorized to save this notification.' => 'Användaren har inte behörighet att spara denna avisering.',
    'User not authorized to view this notification.' => 'Användaren har inte behörighet att visa denna avisering.',
    'User not authorized to delete this notification.' => 'Användaren har inte behörighet att ta bort denna avisering.',
    'Notification not found' => 'Avisering hittades inte',
    'Element not found' => 'Elementet hittades inte',
    'You do not have permission to use the Dynamic Data type.' => 'Du har inte behörighet att använda typen Dynamiska data.',
    'The Dynamic Data snippet did not call the {tag} tag.' => 'Twig-utdraget anropade inte taggen {tag}.',

    // Config-file override note
    'This is being set in the config file. [{file}]' => 'Detta anges i konfigurationsfilen. [{file}]',

    // ========================================================
    // JAVASCRIPT UI
    // ========================================================

    // JavaScript: log utility & buttons
    'Test notification failed.' => 'Testaviseringen misslyckades.',
    'Unable to get the notification, something went wrong.' => 'Det gick inte att hämta aviseringen, något gick fel.',
    'Something went wrong.' => 'Något gick fel.',
    'Invalid notification ID.' => 'Ogiltigt aviserings-ID.',
    'Unable to delete the log event, something went wrong.' => 'Det gick inte att ta bort logghändelsen, något gick fel.',
    'Log event deleted.' => 'Logghändelse borttagen.',
    'Unable to delete log events, something went wrong.' => 'Det gick inte att ta bort logghändelser, något gick fel.',
    'Are you sure you want to delete all logs from {date}?' => 'Är du säker på att du vill ta bort alla loggar från {date}?',
];
