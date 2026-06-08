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

    // ============================================================
    // NOTIFICATION EDITOR
    // ============================================================

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
    'On a recurring schedule' => 'Enligt ett återkommande schema',
    'On demand' => 'Vid behov',
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

    // Message tab: type selector & queue
    'Message Type' => 'Meddelandetyp',
    'What type of message will be sent?' => 'Vilken typ av meddelande ska skickas?',
    'Send Message via Queue' => 'Skicka meddelandet via kö',
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are also supported.' => '[Templating]({templatingUrl}) och [specialvariabler]({variablesUrl}) stöds också.',
    'Send immediately' => 'Skicka direkt',
    'Add to queue' => 'Lägg till i kö',
    'Whether the message should be sent via the [jobs queue]({queueUrl}).' => 'Om meddelandet ska skickas via [jobbkön]({queueUrl}).',

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
    'mrkdwn only' => 'endast mrkdwn',
    'mrkdwn + HTML' => 'mrkdwn + HTML',
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

    // Message tab: Bluesky
    'Post Body' => 'Inläggstext',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => 'Vanlig text, max 300 tecken. URL:er och `@handle.tld`-omnämnanden länkas automatiskt.',
    'Generate Link Preview' => 'Generera länkförhandsvisning',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => 'Generera automatiskt ett förhandsgranskningskort när inläggets text innehåller en URL.',
    'No card' => 'Inget kort',
    'Generate preview card' => 'Generera förhandsvisningskort',

    // Recipients tab: type selector & user/group pickers
    'Recipients Type' => 'Mottagartyp',
    'Who will receive this message?' => 'Vem ska få det här meddelandet?',
    'Add a message recipient' => 'Lägg till en mottagare',
    'Select User(s)' => 'Välj användare',
    'Which users will receive the message?' => 'Vilka användare ska få meddelandet?',
    'Which user groups will receive the message?' => 'Vilka användargrupper ska få meddelandet?',

    // Recipients tab: channel pickers (Slack / ntfy / Bluesky)
    'Select Slack channel(s)' => 'Välj Slack-kanal(er)',
    'Which Slack channels should receive this message?' => 'Vilka Slack-kanaler ska få det här meddelandet?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Inga Slack-kanaler konfigurerade. Lägg till en i [Inställningar → Slack]({url}).',
    'Select ntfy topic(s)' => 'Välj ntfy-ämne(n)',
    'Which ntfy topics should receive this message?' => 'Vilka ntfy-ämnen ska få det här meddelandet?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'Inga ntfy-ämnen konfigurerade. Lägg till ett i [Inställningar → ntfy]({url}).',
    'Select Bluesky account(s)' => 'Välj Bluesky-konto(n)',
    'Which Bluesky accounts should post this message?' => 'Vilka Bluesky-konton ska publicera detta meddelande?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Inga Bluesky-konton konfigurerade. Lägg till ett i [Inställningar → Bluesky]({url}).',

    // Recipients tab: dynamic recipients snippet
    'Twig Snippet to Determine Recipients' => 'Twig-utdrag för att bestämma mottagare',
    'Enter a custom Twig snippet to [determine who will receive the message]({url}).' => 'Ange ett anpassat Twig-snippet för att [bestämma vem som ska få meddelandet]({url}).',
    'The snippet **must** include a `{% setRecipients %}` tag.' => 'Snippeten **måste** innehålla en `{% setRecipients %}`-tagg.',

    // ============================================================
    // SETTINGS
    // ============================================================

    // Settings: nav & page chrome
    'Notifier Settings' => 'Notifier-inställningar',
    'General' => 'Allmänt',
    'Twilio' => 'Twilio',
    'Pushover' => 'Pushover',
    'Slack' => 'Slack',
    'Bluesky' => 'Bluesky',
    'ntfy' => 'ntfy',

    // Settings: Logging
    'Logging' => 'Loggning',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier för en löpande logg över skickade meddelanden. Det är vanligtvis inte nödvändigt, men du kan begränsa antalet logghändelser som registreras i databasen.',
    'Enable Logging' => 'Aktivera loggning',
    'When disabled, Notifier will not write anything to the notification log.' => 'När inaktiverat skriver Notifier ingenting till aviseringsloggen.',
    'Number of days to retain log events' => 'Antal dagar att behålla logghändelser',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Behåll logghändelser i högst så här många dagar. Lämna tomt för ingen gräns.',
    'Number of log events to retain' => 'Antal logghändelser att behålla',
    'At most, keep this many log events. Leave blank for no limit.' => 'Behåll högst så här många logghändelser. Lämna tomt för ingen gräns.',

    // Settings: Scheduled sending
    'Scheduled Sending' => 'Schemalagd sändning',
    'Shared secret for authenticating scheduled-run web requests. Required only when the schedule is triggered via the web endpoint.' => 'Delad hemlighet för att autentisera webbförfrågningar för schemalagd körning. Krävs endast när schemat utlöses via webbslutpunkten.',
    'Scheduled-Run Token' => 'Token för schemalagd körning',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => 'Skickas med varje förfrågan som X-Notifier-Token-rubrik eller token-parameter i kroppen.',

    // Settings: Twilio
    'Twilio API Credentials' => 'Twilio API-uppgifter',
    'If using the Twilio API to send SMS messages, the following credentials are required.' => 'Om du använder Twilio API för att skicka SMS krävs följande uppgifter.',
    'Twilio Account SID' => 'Twilio Account SID',
    'Twilio Auth Token' => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)' => 'Twilio-telefonnummer (skickar varje SMS-meddelande)',
    'SMS Testing' => 'SMS-testning',
    'Optional. When set, every SMS dispatched will be sent to this number instead of the resolved recipient.' => 'Valfritt. Om angivet skickas varje SMS till detta nummer i stället för den faktiska mottagaren.',
    'Test phone number' => 'Testtelefonnummer',

    // Settings: Pushover
    "[Pushover](https://pushover.net) sends push notifications to a registered user's devices. Each Craft user needs a custom field on their profile storing their Pushover user key; you select which field on each Notification's Message tab. For full setup instructions, see the [Pushover getting-started docs](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover)." => '[Pushover](https://pushover.net) skickar push-aviseringar till en registrerad användares enheter. Varje Craft-användare behöver ett anpassat fält i sin profil som lagrar Pushover-nyckeln; du väljer vilket fält på Meddelande-fliken för varje avisering. För fullständiga konfigurationsinstruktioner, se [Pushover-introduktionsdokumentationen](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover).',
    'Application API Token' => 'Programmets API-token',
    'The 30-character app token from your Pushover application.' => 'Det 30-teckens app-token från din Pushover-applikation.',

    // Settings: ntfy
    'ntfy.sh is a free HTTP-based push notification service. Subscribers receive messages on the ntfy app, web, or any compatible client by joining a topic.' => 'ntfy.sh är en gratis HTTP-baserad push-aviseringstjänst. Prenumeranter får meddelanden i ntfy-appen, på webben eller via valfri kompatibel klient genom att ansluta till ett ämne.',
    'Server URL' => 'Server-URL',
    'Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`.' => 'Valfritt, peka på en självhostad ntfy-instans (om aktuellt). Standard `https://ntfy.sh`.',
    'Access token' => 'Åtkomsttoken',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Valfritt, krävs för skyddade ämnen eller självhostade instanser med autentisering.',
    'ntfy Topics' => 'ntfy-ämnen',
    'Add the ntfy topics you\'d like to send messages to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification.' => 'Lägg till de ntfy-ämnen du vill skicka meddelanden till. Varje ämne blir tillgängligt som mottagare på fliken **Mottagare** när du konfigurerar en avisering.',
    'Topics' => 'Ämnen',
    "Click any row's **Test** button to send a quick test message to that topic." => 'Klicka på **Testa**-knappen på valfri rad för att skicka ett snabbt testmeddelande till det ämnet.',
    'Label' => 'Etikett',
    'Topic' => 'Ämne',
    'Add a topic' => 'Lägg till ett ämne',

    // Settings: Slack
    'Slack Channels' => 'Slack-kanaler',
    'Create a [Slack app](https://api.slack.com/apps) with the `chat:write`, `chat:write.customize`, and `chat:write.public` scopes, then add a row for each channel you\'d like to post into. Each channel becomes available as a recipient on the **Recipients** tab when configuring a notification. A bot token is a secret, so store it in a `.env` variable and reference that variable (e.g. `$SLACK_BOT_TOKEN`) rather than pasting the token directly.' => 'Skapa en [Slack-app](https://api.slack.com/apps) med scope-en `chat:write`, `chat:write.customize` och `chat:write.public`, och lägg sedan till en rad för varje kanal du vill posta i. Varje kanal blir tillgänglig som mottagare på fliken **Mottagare** när du konfigurerar en notifikation. En bot-token är en hemlighet, så lagra den i en `.env`-variabel och referera till den variabeln (t.ex. `$SLACK_BOT_TOKEN`) istället för att klistra in tokenet direkt.',
    'Channels' => 'Kanaler',
    "Click any row's **Test** button to send a quick test message to that channel." => 'Klicka på **Testa**-knappen på valfri rad för att skicka ett snabbt testmeddelande till den kanalen.',
    'Bot Token' => 'Bot-token',
    'Channel ID' => 'Kanal-ID',
    'Add a channel' => 'Lägg till en kanal',
    'Not a valid Bot Token. Must start with `xoxb-`.' => 'Ogiltigt bot-token. Måste börja med `xoxb-`.',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => 'Ogiltigt kanal-ID. Måste se ut som `C01234ABCD`.',

    // Settings: Bluesky
    "[Bluesky](https://bsky.app) posts publish to the configured account's feed via the ATProto API. App passwords are generated at [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). An app password is a secret, so store it in a `.env` variable and reference that variable (e.g. `\$BLUESKY_APP_PASSWORD`) rather than pasting the password directly." => '[Bluesky](https://bsky.app)-inlägg publiceras till det konfigurerade kontots flöde via ATProto-API. App-lösenord genereras på [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). Ett app-lösenord är en hemlighet, så lagra det i en `.env`-variabel och referera till den variabeln (t.ex. `$BLUESKY_APP_PASSWORD`) i stället för att klistra in lösenordet direkt.',
    'PDS URL' => 'PDS-URL',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'Standard https://bsky.social. Peka på en anpassad PDS om din installation federerar.',
    'Bluesky Accounts' => 'Bluesky-konton',
    "Add the Bluesky accounts you'd like to post from. Each account becomes available as a recipient on the **Recipients** tab when configuring a notification." => 'Lägg till de Bluesky-konton du vill publicera från. Varje konto blir tillgängligt som mottagare på fliken **Mottagare** när du konfigurerar en avisering.',
    'Accounts' => 'Konton',
    "Click any row's **Test** button to confirm the account authenticates." => 'Klicka på **Testa**-knappen på valfri rad för att bekräfta att kontot autentiseras.',
    'Handle' => 'Handle',
    'App password' => 'App-lösenord',
    'Add an account' => 'Lägg till ett konto',

    // ============================================================
    // MANUAL SEND & TEST
    // ============================================================

    // Manual send & test
    'Send a test message' => 'Skicka ett testmeddelande',
    'Send a REAL test notification?\\n\\n⚠️ Uses a random sample of real data.\\n⚠️ Sends a real message via the configured channel.\\n⚠️ Delivers to the real configured recipient(s).' => 'Skicka en RIKTIG testavisering?\\n\\n⚠️ Använder ett slumpmässigt urval av riktiga data.\\n⚠️ Skickar ett riktigt meddelande via den konfigurerade kanalen.\\n⚠️ Levereras till de riktiga konfigurerade mottagarna.',
    'Test' => 'Testa',
    'Send system snapshot' => 'Skicka systemögonblicksbild',
    'Send data report' => 'Skicka datarapport',
    'Are you sure you want to send this notification?' => 'Är du säker på att du vill skicka den här aviseringen?',
    'This notification cannot be triggered manually.' => 'Den här aviseringen kan inte utlösas manuellt.',
    'This notification no longer applies to the selected element.' => 'Den här aviseringen gäller inte längre det valda elementet.',

    // ============================================================
    // RUNTIME OUTPUT
    // ============================================================

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
    'Unable to send Bluesky post, recipient is missing credentials.' => 'Det går inte att skicka Bluesky-inlägg: mottagaren saknar uppgifter.',
    'Body exceeded {max} characters, truncated.' => 'Innehållet översteg {max} tecken och trunkerades.',
    'Successfully posted to Bluesky as "{label}".' => 'Publicerat på Bluesky som "{label}".',
    'Bluesky auth failed for {handle}: {reason}' => 'Bluesky-autentisering misslyckades för {handle}: {reason}',
    'Bluesky auth failed: {reason}' => 'Bluesky-autentisering misslyckades: {reason}',
    'Bluesky post failed: {reason}' => 'Bluesky-inlägg misslyckades: {reason}',
    'Bluesky link preview skipped: {reason}' => 'Bluesky-länkförhandsvisning hoppades över: {reason}',

    // Recipient warnings
    'Recipient "{name}" has no email address.' => 'Mottagaren "{name}" har ingen e-postadress.',
    'Recipient "{name}" has no phone number.' => 'Mottagaren "{name}" har inget telefonnummer.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => 'Mottagaren "{name}" har ingen kopplad användare; tillkännagivandet kan inte skickas.',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => 'Mottagaren "{name}" har inte åtkomst till kontrollpanelen; tillkännagivandet kan inte skickas.',
    'Pushover user-key field is not configured on this notification.' => 'Pushover-användarnyckelfältet är inte konfigurerat på denna avisering.',
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => 'Mottagaren "{name}" har ingen kopplad användare; Pushover-meddelandet kan inte skickas.',
    '[SKIPPED] User "{name}" has no Pushover key.' => '[ÖVERHOPPAD] Användaren "{name}" har ingen Pushover-nyckel.',
    'Recipient "{name}" has no ntfy topic.' => 'Mottagaren "{name}" har inget ntfy-ämne.',
    'Recipient "{name}" has no Bluesky credentials.' => 'Mottagaren "{name}" har inga Bluesky-uppgifter.',
    'Recipient "{name}" has no Slack bot token.' => 'Mottagaren "{name}" har inget Slack-bot-token.',
    'Recipient "{name}" has no Slack channel ID.' => 'Mottagaren "{name}" har inget Slack-kanal-ID.',

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
    'Invalid Slack body format.' => 'Ogiltigt Slack-innehållsformat.',

    // Config-file override note
    'This is being set in the config file. [{file}]' => 'Detta anges i konfigurationsfilen. [{file}]',

    // ============================================================
    // JAVASCRIPT UI
    // ============================================================

    // JavaScript: log utility & buttons
    'Test notification failed.' => 'Testaviseringen misslyckades.',
    'Unable to get the notification, something went wrong.' => 'Det gick inte att hämta aviseringen, något gick fel.',
    'Something went wrong.' => 'Något gick fel.',
    'Invalid notification ID.' => 'Ogiltigt aviserings-ID.',
    'Unable to delete the log event, something went wrong.' => 'Det gick inte att ta bort logghändelsen, något gick fel.',
    'Log event deleted.' => 'Logghändelse borttagen.',
    'Unable to delete log events, something went wrong.' => 'Det gick inte att ta bort logghändelser, något gick fel.',
    'Are you sure you want to delete this log event?' => 'Är du säker på att du vill ta bort den här logghändelsen?',
    'Are you sure you want to delete all logs from {date}?' => 'Är du säker på att du vill ta bort alla loggar från {date}?',

    // ============================================================
    // MQTT
    // ============================================================

    'Recipient "{name}" has no MQTT topic.' => 'Mottagaren "{name}" har inget MQTT-ämne.',
    'Unable to send MQTT message, no broker host configured.' => 'Det går inte att skicka MQTT-meddelandet, ingen broker-värd är konfigurerad.',
    'Unable to send MQTT message, no topic specified.' => 'Det går inte att skicka MQTT-meddelandet, inget ämne angivet.',
    'Unable to send MQTT message, the payload is empty.' => 'Det går inte att skicka MQTT-meddelandet, innehållet är tomt.',
    'MQTT publish failed: {reason}' => 'MQTT-publicering misslyckades: {reason}',
    'Successfully sent MQTT message to topic "{topic}".' => 'MQTT-meddelande skickat till ämnet "{topic}".',
    'MQTT Broker' => 'MQTT-broker',
    'Notifier publishes to an MQTT broker (such as Mosquitto, EMQX, HiveMQ, or AWS IoT Core). Enter the broker connection details below. Sensitive values can be stored in a `.env` variable and referenced here (e.g. `$MQTT_PASSWORD`).' => 'Notifier publicerar till en MQTT-broker (som Mosquitto, EMQX, HiveMQ eller AWS IoT Core). Ange brokerns anslutningsuppgifter nedan. Känsliga värden kan lagras i en `.env`-variabel och refereras här (t.ex. `$MQTT_PASSWORD`).',
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
    'Optional. Required for brokers that authenticate clients with certificates, such as AWS IoT Core. Provide server file paths to the certificate files (a `.env` variable or `@alias` reference is allowed).' => 'Valfritt. Krävs för brokers som autentiserar klienter med certifikat, som AWS IoT Core. Ange serverfilsökvägar till certifikatfilerna (en `.env`-variabel eller `@alias`-referens tillåts).',
    'CA Certificate File' => 'CA-certifikatfil',
    'Path to the certificate authority (CA) file.' => 'Sökväg till certifikatutfärdarens (CA) fil.',
    'Client Certificate File' => 'Klientcertifikatfil',
    'Path to the client certificate file.' => 'Sökväg till klientcertifikatfilen.',
    'Client Key File' => 'Klientnyckelfil',
    'Path to the client private key file.' => 'Sökväg till klientens privata nyckelfil.',
    'MQTT Topics' => 'MQTT-ämnen',
    'Add the MQTT topics you\'d like to publish to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification.' => 'Lägg till de MQTT-ämnen du vill publicera till. Varje ämne blir tillgängligt som mottagare på fliken **Mottagare** när du konfigurerar en avisering.',
    'Click any row\'s **Test** button to publish a quick test message to that topic.' => 'Klicka på **Testa**-knappen på valfri rad för att publicera ett snabbt testmeddelande till det ämnet.',
    'MQTT' => 'MQTT',
    'Payload' => 'Innehåll',
    'The message published to the topic. Can be plain text or a Twig-rendered JSON object.' => 'Meddelandet som publiceras till ämnet. Kan vara ren text eller ett JSON-objekt renderat med Twig.',
    'Quality of Service' => 'Tjänstekvalitet',
    'Delivery guarantee for this message.' => 'Leveransgaranti för detta meddelande.',
    'Retain' => 'Behåll',
    'Whether the broker keeps this as the topic\'s last message for future subscribers.' => 'Om brokern behåller detta som det senaste meddelandet på ämnet och levererar det till framtida prenumeranter.',
    'Don\'t retain' => 'Behåll inte',
    'Select MQTT topic(s)' => 'Välj MQTT-ämne(n)',
    'Which topics should receive this message?' => 'Vilka ämnen ska ta emot detta meddelande?',
    'No MQTT topics configured. Add one in [Settings → MQTT]({url}).' => 'Inga MQTT-ämnen konfigurerade. Lägg till ett under [Inställningar → MQTT]({url}).',
    'Not a valid topic. Must not be empty or contain the `+` or `#` wildcards.' => 'Inte ett giltigt ämne. Får inte vara tomt eller innehålla jokertecknen `+` eller `#`.',
    'Broker host is not configured.' => 'Broker-värden är inte konfigurerad.',

    // ============================================================
    // Recipient empty-state (administrative changes disabled)
    // ============================================================

    'No ntfy topics configured. Topics can only be added in an environment that allows administrative changes.' => 'Inga ntfy-ämnen konfigurerade. Ämnen kan endast läggas till i en miljö som tillåter administrativa ändringar.',
    'No Slack channels configured. Channels can only be added in an environment that allows administrative changes.' => 'Inga Slack-kanaler konfigurerade. Kanaler kan endast läggas till i en miljö som tillåter administrativa ändringar.',
    'No Bluesky accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Inga Bluesky-konton konfigurerade. Konton kan endast läggas till i en miljö som tillåter administrativa ändringar.',
    'No MQTT topics configured. Topics can only be added in an environment that allows administrative changes.' => 'Inga MQTT-ämnen konfigurerade. Ämnen kan endast läggas till i en miljö som tillåter administrativa ändringar.',
];
