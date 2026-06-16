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
    'Notifications' => 'Notifikationer',
    'Notification' => 'Notifikation',
    'All notifications' => 'Alle notifikationer',
    'Notification Log' => 'Notifikationslog',
    'Logs' => 'Logfiler',
    'View Notifications' => 'Vis notifikationer',
    'Add a New Notification' => 'Tilføj en ny notifikation',
    'notification' => 'notifikation',

    // Permissions
    'View notifications' => 'Vis notifikationer',
    'Save notifications' => 'Gem notifikationer',
    'Use the Dynamic Recipients type' => 'Brug typen Dynamiske modtagere',
    'Use the Dynamic Data type' => 'Brug typen Dynamiske data',
    'Test notifications' => 'Test notifikationer',
    'Send manual notifications' => 'Send manuelle notifikationer',
    'Delete notifications' => 'Slet notifikationer',
    'View notification log' => 'Vis notifikationslog',
    'Delete notification log' => 'Slet notifikationslog',

    // ========================================================
    // NOTIFICATION EDITOR
    // ========================================================

    // Editor: tabs
    'Meta' => 'Meta',
    'Event' => 'Hændelse',
    'Message' => 'Besked',
    'Recipients' => 'Modtagere',

    // Event tab: type selector
    'Event Type' => 'Hændelsestype',
    'What type of event will activate the notification?' => 'Hvilken type hændelse skal aktivere notifikationen?',
    'Which specific event will activate the notification?' => 'Hvilken specifik hændelse skal aktivere notifikationen?',

    // Event tab: event types
    'Assets Event' => 'Aktiv-hændelse',
    'Commerce Orders Event' => 'Commerce-ordrehændelse',
    'Commerce Products Event' => 'Commerce-produkthændelse',
    'Digital Products Event' => 'Digital Products-hændelse',
    'Digital Product Licenses Event' => 'Digital Products-licenshændelse',
    'Solspace Calendar Event' => 'Solspace Calendar-hændelse',
    'Entries Event' => 'Indlægshændelse',
    'Users Event' => 'Brugerhændelse',
    'Ungrouped Users' => 'Brugere uden gruppe',

    // Event tab: Feed
    'Feed URL' => 'Feed-URL',
    'The URL of the RSS, Atom, or JSON feed to watch.' => "URL'en til RSS-, Atom- eller JSON-feedet, der skal overvåges.",

    // Event tab: field conditions
    'Field Conditions' => 'Feltbetingelser',
    'Send the message only when the saved element matches the following conditions.' => 'Send kun beskeden, når det gemte element opfylder følgende betingelser.',
    'has changed' => 'er ændret',

    // Event tab: element filters (panel chrome + common output)
    '#{elementType} Event Filters' => 'Hændelsesfiltre for #{elementType}',
    'No filters match this event.' => 'Ingen filtre matcher denne hændelse.',
    'Determine whether each message should be sent based on specified conditions.' => 'Bestem ud fra angivne betingelser, om hver besked skal sendes.',
    'Unnamed filter' => 'Unavngivet filter',
    'Must be TRUE to send message' => 'Skal være TRUE for at sende beskeden',
    'Must be FALSE to send message' => 'Skal være FALSE for at sende beskeden',
    'No effect' => 'Ingen virkning',

    // Event tab: element filter rules
    'Element is being saved for the first time' => 'Elementet gemmes for første gang',
    'Must be a new entry' => 'Skal være et nyt indlæg',
    'Must be an existing entry' => 'Skal være et eksisterende indlæg',
    'Can be existing or new' => 'Kan være eksisterende eller ny',
    'Element is new' => 'Elementet er nyt',
    'New elements only' => 'Kun nye elementer',
    'Existing elements only' => 'Kun eksisterende elementer',
    'Element is enabled' => 'Elementet er aktiveret',
    'Must be enabled' => 'Skal være aktiveret',
    'Must be disabled' => 'Skal være deaktiveret',
    'Can be enabled or disabled' => 'Kan være aktiveret eller deaktiveret',
    'Element is a draft' => 'Elementet er et udkast',
    'Must be a draft' => 'Skal være et udkast',
    'Must not be a draft' => 'Må ikke være et udkast',
    'Can be a draft or non-draft' => 'Kan være udkast eller ej',
    'Element is a provisional draft' => 'Elementet er et foreløbigt udkast',
    'Must be a provisional draft' => 'Skal være et foreløbigt udkast',
    'Must not be a provisional draft' => 'Må ikke være et foreløbigt udkast',
    'Can be a provisional draft or non-provisional' => 'Kan være foreløbigt udkast eller ej',
    'Element is a revision' => 'Elementet er en revision',
    'Must be a revision' => 'Skal være en revision',
    'Must not be a revision' => 'Må ikke være en revision',
    'Can be a revision or non-revision' => 'Kan være revision eller ej',
    'Element is being duplicated' => 'Elementet duplikeres',
    'Must be duplicating the element' => 'Skal duplikere elementet',
    'Must not be duplicating the element' => 'Må ikke duplikere elementet',
    'Element is being propagated' => 'Elementet udbredes',
    'Element must be propagating' => 'Elementet skal udbredes',
    'Element must not be propagating' => 'Elementet må ikke udbredes',
    'Element is being bulk-resaved' => 'Elementet bulk-gemmes igen',
    'Must be bulk-resaving the element' => 'Skal bulk-gemme elementet igen',
    'Must not be bulk-resaving the element' => 'Må ikke bulk-gemme elementet igen',

    // Event tab: date trigger
    'On' => 'På',
    'days before' => 'dage før',
    'days after' => 'dage efter',
    'Relevant Date' => 'Relevant dato',
    'Send the notification relative to a chosen date.' => 'Send notifikationen i forhold til en valgt dato.',

    // Event tab: recurring schedule
    'Every' => 'Hver',
    'on' => 'på',
    'on day' => 'på dag',
    'at' => 'kl.',
    'Starting on' => 'Startende den',
    'Day' => 'Dag',
    'Date' => 'Dato',
    'Time' => 'Tidspunkt',
    'day(s)' => 'dag(e)',
    'week(s)' => 'uge(r)',
    'month(s)' => 'måned(er)',
    'year(s)' => 'år',
    'day' => 'dag',
    'days' => 'dage',
    'week' => 'uge',
    'weeks' => 'uger',
    'month' => 'måned',
    'months' => 'måneder',
    'year' => 'år',
    'years' => 'år',
    'Manual only' => 'Kun manuelt',
    'Scheduled sending' => 'Planlagt afsendelse',
    'Generate report on a recurring schedule' => 'Generer rapport efter en tilbagevendende tidsplan',
    'Generate report on demand' => 'Generer rapport efter behov',
    'Send on a Recurring Schedule' => 'Send efter en tilbagevendende tidsplan',
    'Configure Recurring Schedule' => 'Konfigurer tilbagevendende tidsplan',
    'System timezone set to {timezone}' => 'Systemets tidszone er sat til {timezone}',
    'Notifications will be sent on the following schedule...' => 'Notifikationer sendes efter følgende tidsplan...',
    '... and every {cadence} after that.' => '... og hver {cadence} derefter.',
    'On what recurring schedule should the notification be sent?' => 'Efter hvilken tilbagevendende tidsplan skal notifikationen sendes?',
    'Whether the message should be sent on a schedule, or only triggered manually.' => 'Om beskeden skal sendes efter en tidsplan eller kun udløses manuelt.',
    'The message can always be sent using the "Send system snapshot" button above.' => 'Beskeden kan altid sendes med knappen "Send systemøjebliksbillede" ovenfor.',
    'The message can always be sent using the "Send data report" button above.' => 'Beskeden kan altid sendes med knappen "Send datarapport" ovenfor.',

    // Event tab: Dynamic Data snippet field
    'Twig Snippet to Determine Data' => 'Twig-snippet til at bestemme data',
    'Enter a custom Twig snippet to [determine which data will be included]({url}).' => 'Indtast et brugerdefineret Twig-snippet for at [bestemme, hvilke data der skal inkluderes]({url}).',
    'The snippet **must** include a `{% setData %}` tag.' => 'Snippettet **skal** indeholde et `{% setData %}`-tag.',
    'You do not have permission to edit dynamic data.' => 'Du har ikke tilladelse til at redigere dynamiske data.',

    // Event tab: manual trigger
    'Trigger Label' => 'Udløser-etiket',
    'An element action label (helps to differentiate multiple triggers).' => 'En etiket for elementhandlingen (hjælper med at skelne mellem flere udløsere).',
    'Send Notification' => 'Send notifikation',

    // Message tab: type selector
    'Message Type' => 'Beskedtype',
    'What type of message will be sent?' => 'Hvilken type besked sendes?',
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are supported.' => '[Templating]({templatingUrl}) og [specialvariabler]({variablesUrl}) understøttes.',

    // Details sidebar: queue
    'Use Queue' => 'Brug kø',
    'Immediate' => 'Med det samme',
    'Queue' => 'Kø',
    'jobs queue' => 'jobkøen',
    'Whether the message will be sent immediately, or added to the {link}.' => 'Om beskeden sendes med det samme eller føjes til {link}.',
    'Flash messages never use the queue.' => 'Flash-beskeder bruger aldrig køen.',
    'Announcements always use the queue.' => 'Bekendtgørelser bruger altid køen.',

    // Message tab: Email
    "User's Email Address Field" => 'Brugerfelt for e-mailadresse',
    'Select which User field contains the recipient\'s email address.' => 'Vælg det brugerfelt, der indeholder modtagerens e-mailadresse.',
    'Email Subject' => 'E-mailemne',
    'Subject line of the email.' => 'Emnelinje på e-mailen.',
    'Dynamic Subject Line' => 'Dynamisk emnelinje',
    'Email Body' => 'E-mailtekst',
    'Body of the email. Supports HTML.' => 'Indhold i e-mailen. Understøtter HTML.',

    // Message tab: rich-text (Trix) toolbar
    'Rich Text' => 'Rich Text',
    'Bold' => 'Fed',
    'Italic' => 'Kursiv',
    'Underline' => 'Understreget',
    'Strikethrough' => 'Gennemstreget',
    'Bullets' => 'Punkttegn',
    'Numbers' => 'Numre',
    'Heading' => 'Overskrift',
    'Code' => 'Kode',
    'Undo' => 'Fortryd',
    'Redo' => 'Annuller fortryd',

    // Message tab: SMS
    "User's Phone Number Field" => 'Brugerfelt for telefonnummer',
    'Select which User field contains the recipient\'s phone number.' => 'Vælg det brugerfelt, der indeholder modtagerens telefonnummer.',
    'SMS Message Body' => 'SMS-beskedtekst',
    'Body of the SMS (text message). Plain text only.' => 'Indhold i SMS\'en (tekstbesked). Kun ren tekst.',

    // Message tab: Announcement
    'Announcement Title' => 'Bekendtgørelsestitel',
    'Heading of the announcement.' => 'Overskrift på annonceringen.',
    'Dynamic Announcement Title' => 'Dynamisk annonceringstitel',
    'Announcement Message' => 'Bekendtgørelsestekst',
    'Body of the announcement. Supports Markdown.' => 'Indhold i annonceringen. Understøtter Markdown.',

    // Message tab: Flash
    'Flash Message Type' => 'Flash-beskedtype',
    'Which type of flash message should appear?' => 'Hvilken type flash-besked skal vises?',
    'Flash Message Title' => 'Flash-beskedtitel',
    'Heading of the flash message.' => 'Overskrift på flash-beskeden.',
    'Dynamic Flash Message Title' => 'Dynamisk flash-besked-titel',
    'Flash Message Details' => 'Flash-beskeddetaljer',
    'Optionally include details below the heading. Supports Markdown and HTML.' => 'Inkludér eventuelt detaljer under overskriften. Understøtter Markdown og HTML.',

    // Message tab: Pushover
    "Field containing each user's Pushover key" => 'Brugerens Pushover-nøglefelt',
    'Select which User field contains the recipient\'s Pushover user key.' => 'Vælg det brugerfelt, der indeholder modtagerens Pushover-nøgle.',
    'Pushover Title' => 'Pushover-titel',
    'Optionally include a heading above the body.' => 'Inkludér eventuelt en overskrift over indholdet.',
    'Dynamic Pushover Title' => 'Dynamisk Pushover-titel',
    'Pushover Body' => 'Pushover-tekst',
    'Body of the Pushover notification. Plain text only.' => 'Indhold i Pushover-notifikationen. Kun ren tekst.',

    // Message tab: ntfy
    'Priority' => 'Prioritet',
    'Priority level of the ntfy message.' => 'Prioritetsniveau for ntfy-beskeden.',
    'Tags' => 'Tags',
    'Optionally include comma-separated [emoji shortcodes](https://docs.ntfy.sh/emojis/).' => 'Inkludér eventuelt komma-separerede [emoji-koder](https://docs.ntfy.sh/emojis/).',
    'ntfy Title' => 'ntfy-titel',
    'Dynamic ntfy Title' => 'Dynamisk ntfy-titel',
    'ntfy Body' => 'ntfy-tekst',
    'Body of the ntfy notification.' => 'Indhold i ntfy-notifikationen.',
    'ntfy Link URL' => 'ntfy-link-URL',
    'Optionally open a URL when the notification is clicked.' => 'Åbn eventuelt en URL, når notifikationen klikkes.',
    'Enable Markdown' => 'Aktivér Markdown',
    'Whether to parse the body as Markdown in supported clients.' => 'Om brødteksten skal læses som Markdown i klienter, der understøtter det.',
    'Regular text only' => 'Kun almindelig tekst',
    'Markdown enabled' => 'Markdown aktiveret',

    // Message tab: Slack
    'Slack Message Body' => 'Slack-beskedtekst',
    'Supports standard [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) syntax. Optionally supports HTML _(see below)_.' => 'Understøtter standard [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting)-syntaks. Understøtter valgfrit HTML _(se nedenfor)_.',
    'Render Message Body as HTML' => 'Vis indhold som HTML',
    'Whether to only parse as [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), or additionally parse it as HTML.' => 'Vælg om kun [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) skal parses, eller om HTML også skal parses.',
    'Render Link Previews' => 'Vis linkforhåndsvisninger',
    'Whether Slack should unfurl link previews for URLs in the message body.' => "Om Slack skal vise linkforhåndsvisninger for URL'er i beskedteksten.",
    'Don\'t unfurl' => 'Foldé ikke ud',
    'Expand link previews' => 'Udvid linkforhåndsvisninger',
    'Bot Name' => 'Brugernavn',
    'Optionally override the app\'s display name.' => 'Overskriv eventuelt appens visningsnavn.',
    'Dynamic Bot Name' => 'Dynamisk botnavn',
    'Bot Icon URL' => 'Ikon-URL',
    'Optionally override the app\'s icon with a URL.' => 'Overskriv eventuelt appens ikon med en URL.',
    'Bot Emoji' => 'Ikon-emoji',
    'Optionally override the app\'s icon with an emoji. Used only when Bot Icon URL is empty.' => 'Overskriv eventuelt appens ikon med en emoji. Bruges kun, når Bot Icon URL er tom.',

    // Message tab: Discord
    'Discord Message Body' => 'Discord-beskedtekst',
    'Supports standard Markdown, and optionally HTML _(see below)_. Max 2000 characters.' => 'Understøtter standard-Markdown og valgfrit HTML _(se nedenfor)_. Maks. 2000 tegn.',
    'Whether to only parse as Markdown, or additionally parse it as HTML.' => 'Vælg om der kun skal parses som Markdown, eller om HTML også skal parses.',
    'Markdown only' => 'Kun Markdown',
    'Markdown + HTML' => 'Markdown + HTML',
    'Whether Discord should unfurl link previews for URLs in the message body.' => 'Om Discord skal vise linkforhåndsvisninger for URL\'er i beskedteksten.',
    'Webhook Username' => 'Webhook-brugernavn',
    'Optionally override the webhook\'s display name.' => 'Overskriv eventuelt webhookens visningsnavn.',
    'Dynamic Username' => 'Dynamisk brugernavn',
    'Webhook Avatar URL' => 'Webhook-avatar-URL',
    'Optionally override the webhook\'s avatar with a URL.' => 'Overskriv eventuelt webhookens avatar med en URL.',

    // Message tab: Facebook
    'Message Body' => 'Beskedtekst',
    'The text of your Facebook post.' => 'Teksten i dit Facebook-indlæg.',
    'Preview Card URL' => 'Forhåndsvisningskort-URL',
    'Optionally add a link to generate a preview card.' => 'Tilføj eventuelt et link for at generere et forhåndsvisningskort.',

    // Message tab: Instagram
    'Caption' => 'Billedtekst',
    'Image Attachment' => 'Billedvedhæftning',
    'Optional caption, max 2200 characters.' => 'Valgfri billedtekst, maks. 2200 tegn.',

    // Message tab: X (Twitter)
    'Plain text, max 280 characters.' => 'Almindelig tekst, maks. 280 tegn.',

    // Message tab: Media
    'Attach an image by calling `{% setMedia %}` in a [custom Twig snippet]({url}).' => 'Vedhæft et billede ved at kalde `{% setMedia %}` i et [brugerdefineret Twig-snippet]({url}).',

    // Message tab: Bluesky
    'Post Body' => 'Indlægstekst',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => 'Ren tekst, maks. 300 tegn. URL\'er og `@handle.tld`-omtaler bliver automatisk links.',
    'Generate Link Preview' => 'Generér linkforhåndsvisning',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => 'Generér automatisk et forhåndsvisningskort, når der er en URL i indlæggets tekst.',
    'No card' => 'Intet kort',
    'Generate preview card' => 'Generér forhåndsvisningskort',

    // Message tab: Mastodon
    'Plain text, max 500 characters. URLs will unfurl automatically.' => 'Almindelig tekst, maks. 500 tegn. URL\'er udfoldes automatisk.',
    'Visibility' => 'Synlighed',
    'Who will be able to see this post?' => 'Hvem vil kunne se dette indlæg?',

    // Message tab: MQTT
    'Payload' => 'Indhold',
    'The JSON or plain text message published to the MQTT topic.' => 'JSON- eller almindelig tekstbesked, der publiceres til MQTT-emnet.',
    'Quality of Service' => 'Servicekvalitet',
    'Delivery guarantee for this message.' => 'Leveringsgaranti for denne besked.',
    'Retain' => 'Behold',
    'Whether the broker keeps this as the topic\'s last message for future subscribers.' => 'Om brokeren beholder denne som den seneste besked på emnet og leverer den til fremtidige abonnenter.',
    'Don\'t retain' => 'Behold ikke',

    // Recipients tab: type selector & user/group pickers
    'Recipients Type' => 'Modtagertype',
    'Who will receive this message?' => 'Hvem skal modtage denne besked?',
    'Add a message recipient' => 'Tilføj en modtager',
    'Select User(s)' => 'Vælg bruger(e)',
    'Which users will receive the message?' => 'Hvilke brugere skal modtage beskeden?',
    'Which user groups will receive the message?' => 'Hvilke brugergrupper skal modtage beskeden?',

    // Recipients tab: channel pickers (ntfy, Slack, Discord, Bluesky, Mastodon, MQTT)
    'Select ntfy topic(s)' => 'Vælg ntfy-emne(r)',
    'Which topics should receive this message?' => 'Hvilke emner skal modtage denne besked?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'Ingen ntfy-emner er konfigureret. Tilføj et i [Indstillinger → ntfy]({url}).',
    'No ntfy topics configured. Topics can only be added in an environment that allows administrative changes.' => 'Ingen ntfy-emner er konfigureret. Emner kan kun tilføjes i et miljø, der tillader administrative ændringer.',
    'Select Slack channel(s)' => 'Vælg Slack-kanal(er)',
    'Which channels should receive this message?' => 'Hvilke kanaler skal modtage denne besked?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Ingen Slack-kanaler er konfigureret. Tilføj en i [Indstillinger → Slack]({url}).',
    'No Slack channels configured. Channels can only be added in an environment that allows administrative changes.' => 'Ingen Slack-kanaler er konfigureret. Kanaler kan kun tilføjes i et miljø, der tillader administrative ændringer.',
    'Select Discord channel(s)' => 'Vælg Discord-kanal(er)',
    'No Discord channels configured. Add one in [Settings → Discord]({url}).' => 'Ingen Discord-kanaler er konfigureret. Tilføj en i [Indstillinger → Discord]({url}).',
    'No Discord channels configured. Channels can only be added in an environment that allows administrative changes.' => 'Ingen Discord-kanaler er konfigureret. Kanaler kan kun tilføjes i et miljø, der tillader administrative ændringer.',
    'Select Facebook page(s)' => 'Vælg Facebook-side(r)',
    'Which pages should post this message?' => 'Hvilke sider skal udgive denne besked?',
    'No Facebook pages configured. Add one in [Settings → Facebook]({url}).' => 'Ingen Facebook-sider er konfigureret. Tilføj en i [Indstillinger → Facebook]({url}).',
    'No Facebook pages configured. Pages can only be added in an environment that allows administrative changes.' => 'Ingen Facebook-sider er konfigureret. Sider kan kun tilføjes i et miljø, der tillader administrative ændringer.',
    'Select Instagram account(s)' => 'Vælg Instagram-konto(er)',
    'No Instagram accounts configured. Add one in [Settings → Instagram]({url}).' => 'Ingen Instagram-konti er konfigureret. Tilføj en i [Indstillinger → Instagram]({url}).',
    'No Instagram accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Ingen Instagram-konti er konfigureret. Konti kan kun tilføjes i et miljø, der tillader administrative ændringer.',
    'Select X (Twitter) account(s)' => 'Vælg X (Twitter)-konto(er)',
    'No X (Twitter) accounts configured. Add one in [Settings → X (Twitter)]({url}).' => 'Ingen X (Twitter)-konti er konfigureret. Tilføj en i [Indstillinger → X (Twitter)]({url}).',
    'No X (Twitter) accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Ingen X (Twitter)-konti er konfigureret. Konti kan kun tilføjes i et miljø, der tillader administrative ændringer.',
    'Select Bluesky account(s)' => 'Vælg Bluesky-konto(er)',
    'Which accounts should post this message?' => 'Hvilke konti skal udgive denne besked?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Ingen Bluesky-konti er konfigureret. Tilføj en i [Indstillinger → Bluesky]({url}).',
    'No Bluesky accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Ingen Bluesky-konti er konfigureret. Konti kan kun tilføjes i et miljø, der tillader administrative ændringer.',
    'Select Mastodon account(s)' => 'Vælg Mastodon-konto(er)',
    'No Mastodon accounts configured. Add one in [Settings → Mastodon]({url}).' => 'Ingen Mastodon-konti er konfigureret. Tilføj en i [Indstillinger → Mastodon]({url}).',
    'No Mastodon accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Ingen Mastodon-konti er konfigureret. Konti kan kun tilføjes i et miljø, der tillader administrative ændringer.',
    'Select MQTT topic(s)' => 'Vælg MQTT-emne(r)',
    'No MQTT topics configured. Add one in [Settings → MQTT]({url}).' => 'Ingen MQTT-emner konfigureret. Tilføj et under [Indstillinger → MQTT]({url}).',
    'No MQTT topics configured. Topics can only be added in an environment that allows administrative changes.' => 'Ingen MQTT-emner konfigureret. Emner kan kun tilføjes i et miljø, der tillader administrative ændringer.',
    'Not a valid topic. Must not be empty or contain the `+` or `#` wildcards.' => 'Ikke et gyldigt emne. Må ikke være tomt eller indeholde wildcards `+` eller `#`.',

    // Recipients tab: dynamic recipients snippet
    'Twig Snippet to Determine Recipients' => 'Twig-snippet til at bestemme modtagere',
    'Enter a custom Twig snippet to [determine who will receive the message]({url}).' => 'Indtast et brugerdefineret Twig-snippet for at [bestemme, hvem der skal modtage beskeden]({url}).',
    'The snippet **must** include a `{% setRecipients %}` tag.' => 'Snippettet **skal** indeholde et `{% setRecipients %}`-tag.',

    // ========================================================
    // SETTINGS
    // ========================================================

    // Settings: nav & page chrome
    'Notifier Settings' => 'Notifier-indstillinger',
    'General' => 'Generelt',
    'Twilio' => 'Twilio',
    'Pushover' => 'Pushover',
    'ntfy' => 'ntfy',
    'Slack' => 'Slack',
    'Discord' => 'Discord',
    'Bluesky' => 'Bluesky',
    'Mastodon' => 'Mastodon',
    'MQTT' => 'MQTT',

    // Settings: shared intro lines
    'Consult the [{name} setup guide]({url}) for complete instructions.' => 'Se [{name}-opsætningsguiden]({url}) for fuldstændige instruktioner.',
    'Sensitive values can be stored in your `.env` file and referenced here.' => 'Følsomme værdier kan gemmes i din `.env`-fil og refereres her.',

    // Settings: Notification order
    'Notification Order' => 'Rækkefølge af notifikationer',
    'Notifications can be dragged into any order on the index page. Choose where new notifications land in that order.' => 'Notifikationer kan trækkes til en valgfri rækkefølge på oversigtssiden. Vælg, hvor nye notifikationer tilføjes i den rækkefølge.',
    'Default Placement' => 'Standardplacering',
    'Where new notifications are added to the list.' => 'Hvor nye notifikationer tilføjes på listen.',
    'Before other notifications' => 'Før andre notifikationer',
    'After other notifications' => 'Efter andre notifikationer',

    // Settings: Logging
    'Logging' => 'Logning',
    "Notifier keeps a running log of every message it sends. You usually won't need to change this, but you can limit how many log entries are kept in the database." => 'Notifier fører en løbende log over sendte beskeder. Det er normalt ikke nødvendigt, men du kan begrænse antallet af loghændelser, der gemmes i databasen.',
    'Enable Logging' => 'Aktivér logning',
    'When disabled, Notifier will not write anything to the notification log.' => 'Når deaktiveret, skriver Notifier intet til notifikationsloggen.',
    'Number of days to retain log events' => 'Antal dage loghændelser skal opbevares',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Opbevar højst loghændelser i dette antal dage. Lad være tom for ingen grænse.',
    'Number of log events to retain' => 'Antal loghændelser, der skal opbevares',
    'At most, keep this many log events. Leave blank for no limit.' => 'Opbevar højst dette antal loghændelser. Lad være tom for ingen grænse.',

    // Settings: Scheduled sending
    'Scheduled Sending' => 'Planlagt afsendelse',
    'A shared secret that authenticates scheduled runs triggered over the web. You only need this if you trigger the schedule from the web endpoint.' => 'Delt hemmelighed til at autentificere planlagte kørselsanmodninger over web. Kræves kun, når tidsplanen udløses via webendpointet.',
    'Scheduled-Run Token' => 'Token til planlagt kørsel',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => 'Sendes med hver forespørgsel som headeren X-Notifier-Token eller som parameteren token i brødteksten.',

    // Settings: Twilio
    'Send SMS text messages through [Twilio](https://www.twilio.com).' => 'Send SMS-tekstbeskeder via [Twilio](https://www.twilio.com).',
    'Twilio Account SID' => 'Twilio Account SID',
    'Twilio Auth Token' => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)' => 'Twilio-telefonnummer (sender hver SMS-besked)',
    'SMS Testing' => 'SMS-test',
    'Optional. When set, every SMS is sent to this number instead of the actual recipient.' => 'Valgfrit. Når angivet, sendes hver afsendt SMS til dette nummer i stedet for den oprindelige modtager.',
    'Test phone number' => 'Test-telefonnummer',

    // Settings: Pushover
    'Send push notifications through [Pushover](https://pushover.net).' => 'Send push-notifikationer via [Pushover](https://pushover.net).',
    'Application API Token' => 'Applikations-API-token',
    'The 30-character app token from your Pushover application.' => 'Det 30-tegns app-token fra din Pushover-applikation.',

    // Settings: ntfy
    'Send push notifications through [ntfy](https://ntfy.sh).' => 'Send push-notifikationer via [ntfy](https://ntfy.sh).',
    'Server URL' => 'Server-URL',
    "Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`." => 'Valgfrit, peg på en selvhostet ntfy-instans (hvis relevant). Standard er `https://ntfy.sh`.',
    'Access token' => 'Adgangstoken',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Valgfrit, kræves til beskyttede emner eller selvhostede instanser med godkendelse.',
    'ntfy Topics' => 'ntfy-emner',
    'Add the ntfy topics you want to send to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Tilføj de ntfy-emner, du vil sende beskeder til. Hvert emne bliver tilgængeligt som modtager på fanen **Modtagere**, når du konfigurerer en notifikation.',
    'Topics' => 'Emner',
    "Click any row's **Test** button to send a quick test message to that topic." => 'Klik på en vilkårlig rækkes **Test**-knap for at sende en hurtig testbesked til det emne.',
    'Label' => 'Etiket',
    'Topic' => 'Emne',
    'Add a topic' => 'Tilføj et emne',

    // Settings: Slack
    'Post messages to your Slack channels.' => 'Send beskeder til dine Slack-kanaler.',
    'Channels' => 'Kanaler',
    "Click any row's **Test** button to send a quick test message to that channel." => 'Klik på en vilkårlig rækkes **Test**-knap for at sende en hurtig testbesked til den kanal.',
    'Bot Token' => 'Bot-token',
    'Channel ID' => 'Kanal-ID',
    'Add a channel' => 'Tilføj en kanal',
    'Not a valid Bot Token. Must start with `xoxb-`.' => 'Ugyldigt bot-token. Skal starte med `xoxb-`.',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => 'Ugyldigt kanal-ID. Skal ligne `C01234ABCD`.',

    // Settings: Discord
    'Post messages to your Discord channels.' => 'Send beskeder til dine Discord-kanaler.',
    'Webhook URL' => 'Webhook-URL',
    'Not a valid Webhook URL. Must start with `https://discord.com/api/webhooks/`.' => 'Ugyldig webhook-URL. Skal starte med `https://discord.com/api/webhooks/`.',

    // Settings: Facebook
    'Facebook' => 'Facebook',
    'Publish posts to your [Facebook](https://facebook.com) pages.' => 'Udgiv indlæg til dine [Facebook](https://facebook.com)-sider.',
    'Pages' => 'Sider',
    'Page ID' => 'Page ID',
    'Page Access Token' => 'Page Access Token',
    'Add a page' => 'Tilføj en side',
    "Click any row's **Test** button to verify that page's credentials. No posts are made." => 'Klik på en vilkårlig rækkes **Test**-knap for at verificere den sides legitimationsoplysninger. Der sendes ingen indlæg.',

    // Settings: Instagram
    'Instagram' => 'Instagram',
    'Publish posts to your [Instagram](https://instagram.com) Business accounts.' => 'Udgiv indlæg til dine [Instagram](https://instagram.com) Business-konti.',
    "Click any row's **Test** button to resolve the linked Instagram account. No posts are made." => 'Klik på en vilkårlig rækkes **Test**-knap for at finde den tilknyttede Instagram-konto. Der sendes ingen indlæg.',

    // Settings: X (Twitter)
    'X (Twitter)' => 'X (Twitter)',
    'Publish posts to your [X (Twitter)](https://x.com) accounts.' => 'Udgiv indlæg til dine [X (Twitter)](https://x.com)-konti.',
    'Consumer Key' => 'Consumer Key',
    'Consumer Key Secret' => 'Consumer Key Secret',
    'Access Token Secret' => 'Access Token Secret',

    // Settings: Bluesky
    'Publish posts to your [Bluesky](https://bsky.app) accounts.' => 'Udgiv opslag til dine [Bluesky](https://bsky.app)-konti.',
    'PDS URL' => 'PDS-URL',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'Standard er https://bsky.social. Peg på en brugerdefineret PDS, hvis din installation fødererer.',
    'Bluesky Accounts' => 'Bluesky-konti',
    'Add the Bluesky accounts you want to post from. Each account becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Tilføj de Bluesky-konti, du vil udgive fra. Hver konto bliver tilgængelig som modtager på fanen **Modtagere**, når du konfigurerer en notifikation.',
    'Accounts' => 'Konti',
    "Click any row's **Test** button to confirm the account authenticates." => 'Klik på en vilkårlig rækkes **Test**-knap for at bekræfte, at kontoen kan godkendes.',
    'Handle' => 'Handle',
    'App password' => 'App-adgangskode',
    'Add an account' => 'Tilføj en konto',

    // Settings: Mastodon
    'Publish posts to your [Mastodon](https://joinmastodon.org) accounts.' => 'Udgiv opslag til dine [Mastodon](https://joinmastodon.org)-konti.',
    'Click any row\'s **Test** button to verify that account\'s credentials. No posts are made.' => 'Klik på en vilkårlig rækkes **Test**-knap for at verificere den kontos legitimationsoplysninger. Der sendes ingen indlæg.',
    'Instance URL' => 'Instans-URL',
    'Access Token' => 'Adgangstoken',

    // Settings: MQTT
    'Publish messages to an MQTT broker, handy for IoT and home-automation setups.' => 'Udgiv beskeder til en MQTT-broker, praktisk til IoT- og home automation-opsætninger.',
    'Host' => 'Vært',
    'Broker hostname, without a protocol or port.' => 'Brokerens værtsnavn, uden protokol eller port.',
    'Port' => 'Port',
    'Optional. Defaults to 8883 when TLS is enabled, otherwise 1883.' => 'Valgfri. Standard er 8883, når TLS er aktiveret, ellers 1883.',
    'Use TLS' => 'Brug TLS',
    'Whether to connect to the broker over a secure TLS socket.' => 'Om der skal oprettes forbindelse til brokeren via en sikker TLS-socket.',
    'Username' => 'Brugernavn',
    'Optional, for brokers that require username/password authentication.' => 'Valgfri, for brokere der kræver godkendelse med brugernavn/adgangskode.',
    'Password' => 'Adgangskode',
    'MQTT Version' => 'MQTT-version',
    'Protocol version sent to the broker.' => 'Protokolversion sendt til brokeren.',
    'Client ID' => 'Klient-ID',
    'Optional. A unique client ID is generated automatically when left blank.' => 'Valgfri. Et unikt klient-ID genereres automatisk, når feltet er tomt.',
    'Mutual TLS' => 'Gensidig TLS',
    'Optional. Needed for brokers that authenticate clients with certificates, such as AWS IoT Core. Enter the server file paths to your certificate files. You can use a `.env` variable or `@alias` reference.' => 'Valgfri. Kræves for brokere der godkender klienter med certifikater, såsom AWS IoT Core. Angiv serverfilstier til certifikatfilerne (en `.env`-variabel eller `@alias`-reference er tilladt).',
    'CA Certificate File' => 'CA-certifikatfil',
    'Path to the certificate authority (CA) file.' => 'Sti til certifikatautoritetsfilen (CA).',
    'Client Certificate File' => 'Klientcertifikatfil',
    'Path to the client certificate file.' => 'Sti til klientcertifikatfilen.',
    'Client Key File' => 'Klientnøglefil',
    'Path to the client private key file.' => 'Sti til klientens private nøglefil.',
    'MQTT Topics' => 'MQTT-emner',
    'Add the MQTT topics you want to publish to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Tilføj de MQTT-emner, du vil publicere til. Hvert emne bliver tilgængeligt som modtager på fanen **Modtagere**, når du konfigurerer en notifikation.',
    'Click any row\'s **Test** button to publish a quick test message to that topic.' => 'Klik på en vilkårlig rækkes **Test**-knap for at publicere en hurtig testbesked til det emne.',

    // ========================================================
    // MANUAL SEND & TEST
    // ========================================================

    // Manual send & test
    'Send a test message' => 'Send en testbesked',
    'Send a REAL test notification?\\n\\n⚠️ Uses a random sample of real data.\\n⚠️ Sends a real message via the configured channel.\\n⚠️ Delivers to the real configured recipient(s).' => 'Send en RIGTIG testnotifikation?\\n\\n⚠️ Bruger en tilfældig stikprøve af rigtige data.\\n⚠️ Sender en rigtig besked via den konfigurerede kanal.\\n⚠️ Leveres til de rigtige konfigurerede modtagere.',
    'Test' => 'Test',
    'Send system snapshot' => 'Send systemøjebliksbillede',
    'Send data report' => 'Send datarapport',
    'Are you sure you want to send this notification?' => 'Er du sikker på, at du vil sende denne notifikation?',
    'This notification cannot be triggered manually.' => 'Denne notifikation kan ikke udløses manuelt.',
    'This notification no longer applies to the selected element.' => 'Denne notifikation gælder ikke længere for det valgte element.',

    // ========================================================
    // RUNTIME OUTPUT
    // ========================================================

    // Runtime: dispatch log feedback
    'Sending {messageType} to {recipient}.' => 'Sender {messageType} til {recipient}.',
    'Adding message to queue.' => 'Tilføjer besked til køen.',
    'Sending message immediately (bypassing queue).' => 'Sender beskeden med det samme (springer køen over).',

    // Runtime: controller responses
    'Test notification dispatched.' => 'Testnotifikation afsendt.',
    'No messages were dispatched. Check the recipient configuration.' => 'Der blev ikke sendt nogen beskeder. Tjek modtagerkonfigurationen.',
    'Unable to send test: the feed could not be read or has no items.' => 'Kan ikke sende test: feedet kunne ikke læses eller indeholder ingen elementer.',
    'Unable to send test: no element matches the configured filters.' => 'Kan ikke sende test: ingen elementer matcher de konfigurerede filtre.',
    "Couldn't save settings." => 'Kunne ikke gemme indstillingerne.',
    'Settings saved.' => 'Indstillinger gemt.',
    'Topic is empty.' => 'Emnet er tomt.',
    'Server URL is not configured.' => 'Server-URL er ikke konfigureret.',
    'Test message from Notifier.' => 'Testbesked fra Notifier.',
    'HTTP {status}' => 'HTTP {status}',
    'Test message sent successfully.' => 'Testbesked sendt.',
    'Page ID and Page Access Token are required.' => 'Page ID og Page Access Token er påkrævet.',
    'Facebook rejected the request: {error}' => 'Facebook afviste anmodningen: {error}',
    'Successfully connected to "{name}". No posts were made.' => 'Forbundet til "{name}". Der blev ikke sendt nogen indlæg.',
    'No Instagram Business account is linked to this Page.' => 'Ingen Instagram Business-konto er tilknyttet denne side.',
    'Successfully connected to @{handle}. No posts were made.' => 'Forbundet til @{handle}. Der blev ikke sendt nogen indlæg.',
    'All four credentials are required.' => 'Alle fire legitimationsoplysninger er påkrævet.',
    'X (Twitter) rejected the request: {error}' => 'X (Twitter) afviste anmodningen: {error}',
    'Successfully authenticated as @{username}. No posts were made.' => 'Godkendt som @{username}. Der blev ikke sendt nogen indlæg.',
    'Handle and app password are required.' => 'Handle og app-adgangskode er påkrævet.',
    'Authentication failed.' => 'Godkendelse mislykkedes.',
    'Successfully authenticated. No messages were posted.' => 'Godkendt. Der blev ikke sendt nogen beskeder.',
    'Log events deleted.' => 'Loghændelser slettet.',
    'Notification sent.' => 'Notifikation sendt.',
    'Notification was not sent. Check the Notification Log for details.' => 'Notifikationen blev ikke sendt. Tjek Notifikationslog for detaljer.',
    'Instance URL and access token are required.' => 'Instans-URL og adgangstoken er påkrævet.',
    'Mastodon rejected the request: {error}' => 'Mastodon afviste anmodningen: {error}',
    'Successfully authenticated as @{handle}. No posts were made.' => 'Godkendt som @{handle}. Der blev ikke sendt nogen indlæg.',
    'Broker host is not configured.' => 'Broker-vært er ikke konfigureret.',

    // Outbound: per-channel send results
    'Successfully sent email message!' => 'E-mail sendt!',
    'Successfully sent SMS message!' => 'SMS sendt!',
    'Successfully posted announcement!' => 'Bekendtgørelse udgivet!',
    'Successfully sent flash message!' => 'Flash-besked sendt!',
    'Successfully sent Pushover message!' => 'Pushover-besked sendt!',
    'Successfully sent ntfy message to topic "{topic}".' => 'ntfy-besked sendt til emnet "{topic}".',
    'Slack rejected the message: {error}' => 'Slack afviste beskeden: {error}',
    'Successfully sent Slack message to "{label}".' => 'Slack-besked sendt til "{label}".',
    'Discord rejected the message: {error}' => 'Discord afviste beskeden: {error}',
    'Successfully sent Discord message to "{label}".' => 'Discord-besked sendt til "{label}".',
    'Successfully sent Facebook post to "{label}".' => 'Facebook-indlæg sendt til "{label}".',
    'the attached image could not be read' => 'det vedhæftede billede kunne ikke læses',
    'Successfully sent X (Twitter) post as "{label}".' => 'X (Twitter)-indlæg sendt som "{label}".',
    'Successfully posted to Bluesky as "{label}".' => 'Udgivet på Bluesky som "{label}".',
    'Successfully sent Mastodon post to "{label}".' => 'Mastodon-indlæg sendt til "{label}".',
    'Successfully sent MQTT message to topic "{topic}".' => 'MQTT-besked sendt til emnet "{topic}".',

    // Media attachments
    'Videos are not yet supported on {channel}.' => 'Videoer understøttes endnu ikke på {channel}.',
    'The image could not be resized to fit.' => 'Billedet kunne ikke tilpasses størrelsen.',
    '[NOT ATTACHED] Unable to attach image. {reason}' => '[IKKE VEDHÆFTET] Kunne ikke vedhæfte billedet. {reason}',

    // Recipient warnings
    '[SKIPPED] User "{name}" has no Pushover key.' => '[OVERSPRUNGET] Brugeren "{name}" har ingen Pushover-nøgle.',

    // Errors & exceptions
    'Invalid element event: {class}' => 'Ugyldig elementhændelse: {class}',
    'Invalid notification ID: {id}' => 'Ugyldigt notifikations-id: {id}',
    'Invalid email message mode.' => 'Ugyldig e-mailbeskedtilstand.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Du har ikke tilladelse til at bruge typen Dynamiske modtagere.',
    'Invalid settings section: {section}' => 'Ugyldig indstillingssektion: {section}',
    'User not authorized to save this notification.' => 'Brugeren har ikke tilladelse til at gemme denne notifikation.',
    'User not authorized to view this notification.' => 'Brugeren har ikke tilladelse til at vise denne notifikation.',
    'User not authorized to delete this notification.' => 'Brugeren har ikke tilladelse til at slette denne notifikation.',
    'Notification not found' => 'Notifikation ikke fundet',
    'Element not found' => 'Element ikke fundet',
    'You do not have permission to use the Dynamic Data type.' => 'Du har ikke tilladelse til at bruge typen Dynamiske data.',
    '[NO DATA] The Dynamic Data snippet did not call the {tag} tag.' => '[INGEN DATA] Twig-snippet kaldte ikke {tag}-tagget.',

    // Config-file override note
    'This is being set in the config file. [{file}]' => 'Dette indstilles i konfigurationsfilen. [{file}]',

    // ========================================================
    // JAVASCRIPT UI
    // ========================================================

    // JavaScript: log utility & buttons
    'Test notification failed.' => 'Testnotifikation mislykkedes.',
    'Unable to get the notification, something went wrong.' => 'Kunne ikke hente notifikationen, noget gik galt.',
    'Something went wrong.' => 'Noget gik galt.',
    'Invalid notification ID.' => 'Ugyldigt notifikations-ID.',
    'Unable to delete the log event, something went wrong.' => 'Kunne ikke slette loghændelsen, noget gik galt.',
    'Log event deleted.' => 'Loghændelse slettet.',
    'Unable to delete log events, something went wrong.' => 'Kunne ikke slette loghændelser, noget gik galt.',
    'Are you sure you want to delete all logs from {date}?' => 'Er du sikker på, at du vil slette alle logfiler fra {date}?',
    // Reworded outbound + dispatch log messages
    'Successfully posted to "{label}" Instagram account.' => 'Indlæg sendt til Instagram-kontoen "{label}".',
    '[BAD CREDENTIALS] Missing app token. [Configure Pushover]({url}).' => '[UGYLDIGE LEGITIMATIONSOPLYSNINGER] Mangler app-token. [Konfigurer Pushover]({url}).',
    '[BAD CREDENTIALS] Missing {missing}. [Configure Twilio]({url}).' => '[UGYLDIGE LEGITIMATIONSOPLYSNINGER] Mangler {missing}. [Konfigurer Twilio]({url}).',
    '[BAD CREDENTIALS] No Discord webhook URL is configured.' => '[UGYLDIGE LEGITIMATIONSOPLYSNINGER] Der er ikke konfigureret nogen Discord-webhook-URL.',
    '[BAD CREDENTIALS] No MQTT broker host is configured.' => '[UGYLDIGE LEGITIMATIONSOPLYSNINGER] Der er ikke konfigureret nogen MQTT-broker-vært.',
    '[BAD CREDENTIALS] No Mastodon access token is configured.' => '[UGYLDIGE LEGITIMATIONSOPLYSNINGER] Der er ikke konfigureret nogen Mastodon-adgangstoken.',
    '[BAD CREDENTIALS] No Mastodon instance URL is configured.' => '[UGYLDIGE LEGITIMATIONSOPLYSNINGER] Der er ikke konfigureret nogen Mastodon-instans-URL.',
    '[BAD CREDENTIALS] No Slack bot token is configured.' => '[UGYLDIGE LEGITIMATIONSOPLYSNINGER] Der er ikke konfigureret nogen Slack-bot-token.',
    '[BAD CREDENTIALS] No Twilio phone number is configured.' => '[UGYLDIGE LEGITIMATIONSOPLYSNINGER] Der er ikke konfigureret noget Twilio-telefonnummer.',
    '[BAD CREDENTIALS] The recipient is missing Bluesky credentials.' => '[UGYLDIGE LEGITIMATIONSOPLYSNINGER] Modtageren mangler Bluesky-legitimationsoplysninger.',
    '[BAD CREDENTIALS] The recipient is missing Facebook credentials.' => '[UGYLDIGE LEGITIMATIONSOPLYSNINGER] Modtageren mangler Facebook-legitimationsoplysninger.',
    '[BAD CREDENTIALS] The recipient is missing X (Twitter) credentials.' => '[UGYLDIGE LEGITIMATIONSOPLYSNINGER] Modtageren mangler X (Twitter)-legitimationsoplysninger.',
    '[BAD CREDENTIALS] Unable to post, recipient is missing credentials.' => '[UGYLDIGE LEGITIMATIONSOPLYSNINGER] Kan ikke poste; modtageren mangler legitimationsoplysninger.',
    '[EMPTY BODY] The Discord message body is empty.' => '[TOM TEKST] Discord-beskedens tekst er tom.',
    '[EMPTY BODY] The Facebook post body is empty.' => '[TOM TEKST] Facebook-indlæggets tekst er tom.',
    '[EMPTY BODY] The MQTT payload is empty.' => '[TOM TEKST] MQTT-nyttelasten er tom.',
    '[EMPTY BODY] The Mastodon post body is empty.' => '[TOM TEKST] Mastodon-indlæggets tekst er tom.',
    '[EMPTY BODY] The Slack message body is empty.' => '[TOM TEKST] Slack-beskedens tekst er tom.',
    '[EMPTY BODY] The X (Twitter) post body is empty.' => '[TOM TEKST] X (Twitter)-indlæggets tekst er tom.',
    '[EMPTY BODY] The email message body was empty.' => '[TOM TEKST] E-mailens tekst var tom.',
    '[FEED ERROR] Could not fetch the feed: {message}' => '[FEED-FEJL] Kunne ikke hente feedet: {message}',
    '[FEED ERROR] Could not parse the feed.' => '[FEED-FEJL] Kunne ikke fortolke feedet.',
    '[FEED ERROR] Could not parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => '[FEED-FEJL] Kunne ikke fortolke feedet. PHP-udvidelserne `simplexml` og `libxml` er påkrævet.',
    '[FEED ERROR] Initial feed scan failed: {message}' => '[FEED-FEJL] Den indledende feedscanning mislykkedes: {message}',
    '[INVALID NUMBER] The recipient phone number is invalid.' => '[UGYLDIGT NUMMER] Modtagerens telefonnummer er ugyldigt.',
    '[INVALID TYPE] The flash message type is invalid.' => '[UGYLDIG TYPE] Flash-beskedtypen er ugyldig.',
    '[LINK PREVIEW SKIPPED] {reason}' => '[LINKVISNING SPRUNGET OVER] {reason}',
    '[MISSING IMAGE] Image Attachment field never called the {tag} tag.' => '[MANGLENDE BILLEDE] Feltet Billedvedhæftning kaldte aldrig {tag}-tagget.',
    '[MISSING IMAGE] Image Attachment field was empty.' => '[MANGLENDE BILLEDE] Feltet Billedvedhæftning var tomt.',
    '[MISSING IMAGE] The {tag} tag was called, but returned an invalid image.' => '[MANGLENDE BILLEDE] {tag}-tagget blev kaldt, men returnerede et ugyldigt billede.',
    '[MISSING IMAGE] Unable to send Instagram post, the image needs a public URL.' => '[MANGLENDE BILLEDE] Kan ikke sende Instagram-indlæg; billedet kræver en offentlig URL.',
    '[NO MEDIA] No image was attached because the {tag} tag was never invoked in the Image Attachment field.' => '[INGEN MEDIER] Der blev ikke vedhæftet noget billede, fordi {tag}-tagget aldrig blev kaldt i feltet Billedvedhæftning.',
    '[NO RECIPIENTS] The Dynamic Recipients snippet did not call setRecipients.' => '[INGEN MODTAGERE] Snippet til dynamiske modtagere kaldte ikke setRecipients.',
    '[NO RECIPIENTS] setRecipients was called with an empty value.' => '[INGEN MODTAGERE] setRecipients blev kaldt med en tom værdi.',
    '[NO RECIPIENT] No MQTT topic was specified.' => '[INGEN MODTAGER] Der blev ikke angivet noget MQTT-emne.',
    '[NO RECIPIENT] No Slack channel ID was specified.' => '[INGEN MODTAGER] Der blev ikke angivet noget Slack-kanal-ID.',
    '[NO RECIPIENT] No ntfy topic was specified.' => '[INGEN MODTAGER] Der blev ikke angivet noget ntfy-emne.',
    '[NO RECIPIENT] No recipient user was specified for the announcement.' => '[INGEN MODTAGER] Der blev ikke angivet nogen modtagerbruger til meddelelsen.',
    '[NO RECIPIENT] No recipient was specified for the email.' => '[INGEN MODTAGER] Der blev ikke angivet nogen modtager til e-mailen.',
    '[NO RECIPIENT] The recipient has no Pushover user key.' => '[INGEN MODTAGER] Modtageren har ingen Pushover-brugernøgle.',
    '[NO RECIPIENT] The recipient has no phone number.' => '[INGEN MODTAGER] Modtageren har intet telefonnummer.',
    '[REJECTED BY DISCORD] {error}' => '[AFVIST AF DISCORD] {error}',
    '[REJECTED BY FACEBOOK] {error}' => '[AFVIST AF FACEBOOK] {error}',
    '[REJECTED BY INSTAGRAM] {error}' => '[AFVIST AF INSTAGRAM] {error}',
    '[REJECTED BY MASTODON] {error}' => '[AFVIST AF MASTODON] {error}',
    '[REJECTED BY SLACK] {error}' => '[AFVIST AF SLACK] {error}',
    '[REJECTED BY X (TWITTER)] {error}' => '[AFVIST AF X (TWITTER)] {error}',
    '[SEND FAILED] Authentication failed for {handle}: {reason}' => '[AFSENDELSE MISLYKKEDES] Godkendelse mislykkedes for {handle}: {reason}',
    '[SEND FAILED] Authentication failed: {reason}' => '[AFSENDELSE MISLYKKEDES] Godkendelse mislykkedes: {reason}',
    "[SEND FAILED] Could not send the email using Craft's native handling. Check your general email settings within Craft." => '[AFSENDELSE MISLYKKEDES] Kunne ikke sende e-mailen via Crafts indbyggede håndtering. Tjek dine generelle e-mailindstillinger i Craft.',
    '[SEND FAILED] HTTP {status}: {reason}' => '[AFSENDELSE MISLYKKEDES] HTTP {status}: {reason}',
    '[SEND FAILED] {error}' => '[AFSENDELSE MISLYKKEDES] {error}',
    '[SEND FAILED] {reason}' => '[AFSENDELSE MISLYKKEDES] {reason}',
    '[SKIPPED] Pushover user-key field is not configured on this notification.' => '[OVERSPRUNGET] Pushover-brugernøglefeltet er ikke konfigureret på denne notifikation.',
    '[SKIPPED] Recipient "{name}" cannot access the control panel.' => '[OVERSPRUNGET] Modtageren "{name}" har ikke adgang til kontrolpanelet.',
    '[SKIPPED] Recipient "{name}" has no Bluesky credentials.' => '[OVERSPRUNGET] Modtageren "{name}" har ingen Bluesky-legitimationsoplysninger.',
    '[SKIPPED] Recipient "{name}" has no Craft user account.' => '[OVERSPRUNGET] Modtageren "{name}" har ingen Craft-brugerkonto.',
    '[SKIPPED] Recipient "{name}" has no Discord webhook URL.' => '[OVERSPRUNGET] Modtageren "{name}" har ingen Discord-webhook-URL.',
    '[SKIPPED] Recipient "{name}" has no Facebook credentials.' => '[OVERSPRUNGET] Modtageren "{name}" har ingen Facebook-legitimationsoplysninger.',
    '[SKIPPED] Recipient "{name}" has no Instagram credentials.' => '[OVERSPRUNGET] Modtageren "{name}" har ingen Instagram-legitimationsoplysninger.',
    '[SKIPPED] Recipient "{name}" has no MQTT topic.' => '[OVERSPRUNGET] Modtageren "{name}" har ingen MQTT-emne.',
    '[SKIPPED] Recipient "{name}" has no Mastodon credentials.' => '[OVERSPRUNGET] Modtageren "{name}" har ingen Mastodon-legitimationsoplysninger.',
    '[SKIPPED] Recipient "{name}" has no Slack bot token.' => '[OVERSPRUNGET] Modtageren "{name}" har ingen Slack-bot-token.',
    '[SKIPPED] Recipient "{name}" has no Slack channel ID.' => '[OVERSPRUNGET] Modtageren "{name}" har ingen Slack-kanal-ID.',
    '[SKIPPED] Recipient "{name}" has no X (Twitter) credentials.' => '[OVERSPRUNGET] Modtageren "{name}" har ingen X (Twitter)-legitimationsoplysninger.',
    '[SKIPPED] Recipient "{name}" has no email address.' => '[OVERSPRUNGET] Modtageren "{name}" har ingen e-mailadresse.',
    '[SKIPPED] Recipient "{name}" has no ntfy topic.' => '[OVERSPRUNGET] Modtageren "{name}" har ingen ntfy-emne.',
    '[SKIPPED] Recipient "{name}" has no phone number.' => '[OVERSPRUNGET] Modtageren "{name}" har ingen telefonnummer.',
    '[SKIPPED] The configured {kind} no longer exists in the plugin settings (uid: {uid}).' => '[OVERSPRUNGET] Den konfigurerede {kind} findes ikke længere i plugin-indstillingerne (uid: {uid}).',
    '[SKIPPED] Unrecognized recipient "{value}".' => '[OVERSPRUNGET] Ukendt modtager "{value}".',
    '[SKIPPED] Unrecognized recipient of type "{type}".' => '[OVERSPRUNGET] Ukendt modtagertype "{type}".',
    '[TOO LONG] The Discord message body exceeds the 2000-character limit.' => '[FOR LANG] Discord-beskedens tekst overstiger grænsen på 2000 tegn.',
    '[TRUNCATED] Body exceeded {max} characters.' => '[AFKORTET] Teksten oversteg {max} tegn.',
    '[TRUNCATED] Caption exceeded {max} characters.' => '[AFKORTET] Billedteksten oversteg {max} tegn.',
];
