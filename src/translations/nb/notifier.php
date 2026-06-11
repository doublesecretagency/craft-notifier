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
    'Notifications' => 'Varsler',
    'Notification' => 'Varsel',
    'All notifications' => 'Alle varsler',
    'Notification Log' => 'Varslingslogg',
    'Logs' => 'Logger',
    'View Notifications' => 'Vis varsler',
    'Add a New Notification' => 'Legg til et nytt varsel',
    'notification' => 'varsel',

    // Permissions
    'View notifications' => 'Vis varsler',
    'Save notifications' => 'Lagre varsler',
    'Use the Dynamic Recipients type' => 'Bruk typen Dynamiske mottakere',
    'Use the Dynamic Data type' => 'Bruk typen Dynamiske data',
    'Test notifications' => 'Test varsler',
    'Send manual notifications' => 'Send manuelle varsler',
    'Delete notifications' => 'Slett varsler',
    'View notification log' => 'Vis varslingsloggen',
    'Delete notification log' => 'Slett varslingsloggen',

    // ========================================================
    // NOTIFICATION EDITOR
    // ========================================================

    // Editor: tabs
    'Meta' => 'Meta',
    'Event' => 'Hendelse',
    'Message' => 'Melding',
    'Recipients' => 'Mottakere',

    // Event tab: type selector
    'Event Type' => 'Hendelsestype',
    'What type of event will activate the notification?' => 'Hvilken type hendelse skal utløse varselet?',
    'Which specific event will activate the notification?' => 'Hvilken spesifikk hendelse skal utløse varselet?',

    // Event tab: event types
    'Assets Event' => 'Asset-hendelse',
    'Commerce Orders Event' => 'Commerce-ordrehendelse',
    'Commerce Products Event' => 'Commerce-produkthendelse',
    'Digital Products Event' => 'Digital Products-hendelse',
    'Digital Product Licenses Event' => 'Digital Products-lisenshendelse',
    'Solspace Calendar Event' => 'Solspace Calendar-hendelse',
    'Entries Event' => 'Innleggshendelse',
    'Users Event' => 'Brukerhendelse',
    'Ungrouped Users' => 'Brukere uten gruppe',

    // Event tab: Feed
    'Feed URL' => 'Feed-URL',
    'The URL of the RSS, Atom, or JSON feed to watch.' => 'URL-en til RSS-, Atom- eller JSON-feeden som skal overvåkes.',

    // Event tab: field conditions
    'Field Conditions' => 'Feltvilkår',
    'Send the message only when the saved element matches the following conditions.' => 'Send meldingen kun når det lagrede elementet oppfyller følgende vilkår.',
    'has changed' => 'er endret',

    // Event tab: element filters (panel chrome + common output)
    '#{elementType} Event Filters' => 'Hendelsesfiltre for #{elementType}',
    'No filters match this event.' => 'Ingen filtre passer til denne hendelsen.',
    'Determine whether each message should be sent based on specified conditions.' => 'Bestem ut fra angitte vilkår om hver melding skal sendes.',
    'Unnamed filter' => 'Filter uten navn',
    'Must be TRUE to send message' => 'Må være TRUE for å sende meldingen',
    'Must be FALSE to send message' => 'Må være FALSE for å sende meldingen',
    'No effect' => 'Ingen virkning',

    // Event tab: element filter rules
    'Element is being saved for the first time' => 'Elementet lagres for første gang',
    'Must be a new entry' => 'Må være et nytt innlegg',
    'Must be an existing entry' => 'Må være et eksisterende innlegg',
    'Can be existing or new' => 'Kan være eksisterende eller ny',
    'Element is new' => 'Elementet er nytt',
    'New elements only' => 'Kun nye elementer',
    'Existing elements only' => 'Kun eksisterende elementer',
    'Element is enabled' => 'Elementet er aktivert',
    'Must be enabled' => 'Må være aktivert',
    'Must be disabled' => 'Må være deaktivert',
    'Can be enabled or disabled' => 'Kan være aktivert eller deaktivert',
    'Element is a draft' => 'Elementet er et utkast',
    'Must be a draft' => 'Må være et utkast',
    'Must not be a draft' => 'Må ikke være et utkast',
    'Can be a draft or non-draft' => 'Kan være utkast eller ikke',
    'Element is a provisional draft' => 'Elementet er et foreløpig utkast',
    'Must be a provisional draft' => 'Må være et foreløpig utkast',
    'Must not be a provisional draft' => 'Må ikke være et foreløpig utkast',
    'Can be a provisional draft or non-provisional' => 'Kan være foreløpig utkast eller ikke',
    'Element is a revision' => 'Elementet er en revisjon',
    'Must be a revision' => 'Må være en revisjon',
    'Must not be a revision' => 'Må ikke være en revisjon',
    'Can be a revision or non-revision' => 'Kan være revisjon eller ikke',
    'Element is being duplicated' => 'Elementet dupliseres',
    'Must be duplicating the element' => 'Må duplisere elementet',
    'Must not be duplicating the element' => 'Må ikke duplisere elementet',
    'Element is being propagated' => 'Elementet propageres',
    'Element must be propagating' => 'Elementet må propageres',
    'Element must not be propagating' => 'Elementet må ikke propageres',
    'Element is being bulk-resaved' => 'Elementet lagres på nytt i bulk',
    'Must be bulk-resaving the element' => 'Må lagre elementet på nytt i bulk',
    'Must not be bulk-resaving the element' => 'Må ikke lagre elementet på nytt i bulk',

    // Event tab: date trigger
    'On' => 'På',
    'days before' => 'dager før',
    'days after' => 'dager etter',
    'Relevant Date' => 'Relevant dato',
    'Send the notification relative to a chosen date.' => 'Send varselet i forhold til en valgt dato.',

    // Event tab: recurring schedule
    'Every' => 'Hver',
    'on' => 'på',
    'on day' => 'på dag',
    'at' => 'kl.',
    'Starting on' => 'Fra og med',
    'Day' => 'Dag',
    'Date' => 'Dato',
    'Time' => 'Tidspunkt',
    'day(s)' => 'dag(er)',
    'week(s)' => 'uke(r)',
    'month(s)' => 'måned(er)',
    'year(s)' => 'år',
    'day' => 'dag',
    'days' => 'dager',
    'week' => 'uke',
    'weeks' => 'uker',
    'month' => 'måned',
    'months' => 'måneder',
    'year' => 'år',
    'years' => 'år',
    'Manual only' => 'Kun manuelt',
    'Scheduled sending' => 'Planlagt sending',
    'Generate report on a recurring schedule' => 'Generer rapport etter en gjentakende tidsplan',
    'Generate report on demand' => 'Generer rapport ved behov',
    'Send on a Recurring Schedule' => 'Send etter en gjentakende tidsplan',
    'Configure Recurring Schedule' => 'Konfigurer gjentakende tidsplan',
    'System timezone set to {timezone}' => 'Systemets tidssone er satt til {timezone}',
    'Notifications will be sent on the following schedule...' => 'Varsler sendes etter følgende tidsplan...',
    '... and every {cadence} after that.' => '... og deretter hver {cadence}.',
    'On what recurring schedule should the notification be sent?' => 'Etter hvilken gjentakende tidsplan skal varselet sendes?',
    'Whether the message should be sent on a schedule, or only triggered manually.' => 'Om meldingen skal sendes etter en tidsplan eller bare utløses manuelt.',
    'The message can always be sent using the "Send system snapshot" button above.' => 'Meldingen kan alltid sendes med knappen «Send systemøyeblikksbilde» ovenfor.',
    'The message can always be sent using the "Send data report" button above.' => 'Meldingen kan alltid sendes med knappen «Send datarapport» ovenfor.',

    // Event tab: Dynamic Data snippet field
    'Twig Snippet to Determine Data' => 'Twig-snippet for å bestemme data',
    'Enter a custom Twig snippet to [determine which data will be included]({url}).' => 'Skriv inn et egendefinert Twig-snippet for å [bestemme hvilke data som skal inkluderes]({url}).',
    'The snippet **must** include a `{% setData %}` tag.' => 'Snippeten **må** inneholde en `{% setData %}`-tagg.',
    'You do not have permission to edit dynamic data.' => 'Du har ikke tillatelse til å redigere dynamiske data.',

    // Event tab: manual trigger
    'Trigger Label' => 'Etikett for utløser',
    'An element action label (helps to differentiate multiple triggers).' => 'En etikett for elementhandlingen (hjelper med å skille flere utløsere).',
    'Send Notification' => 'Send varsel',

    // Message tab: type selector
    'Message Type' => 'Meldingstype',
    'What type of message will be sent?' => 'Hvilken type melding skal sendes?',
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are also supported.' => '[Templating]({templatingUrl}) og [spesielle variabler]({variablesUrl}) støttes også.',

    // Details sidebar: queue
    'Use Queue' => 'Bruk kø',
    'Immediate' => 'Umiddelbart',
    'Queue' => 'Kø',
    'jobs queue' => 'jobbkøen',
    'Whether the message will be sent immediately, or added to the {link}.' => 'Om meldingen sendes umiddelbart eller legges til i {link}.',
    'Flash messages never use the queue.' => 'Flash-meldinger bruker aldri køen.',
    'Announcements always use the queue.' => 'Kunngjøringer bruker alltid køen.',

    // Message tab: Email
    "User's Email Address Field" => 'Brukerfelt for e-postadresse',
    'Select which User field contains the recipient\'s email address.' => 'Velg brukerfeltet som inneholder mottakerens e-postadresse.',
    'Email Subject' => 'E-postemne',
    'Subject line of the email.' => 'Emnelinje for e-posten.',
    'Dynamic Subject Line' => 'Dynamisk emnelinje',
    'Email Body' => 'E-posttekst',
    'Body of the email. Supports HTML.' => 'Innhold i e-posten. Støtter HTML.',

    // Message tab: rich-text (Trix) toolbar
    'Rich Text' => 'Rik tekst',
    'Bold' => 'Fet',
    'Italic' => 'Kursiv',
    'Underline' => 'Understreket',
    'Strikethrough' => 'Gjennomstreket',
    'Bullets' => 'Punktliste',
    'Numbers' => 'Nummerering',
    'Heading' => 'Overskrift',
    'Code' => 'Kode',
    'Undo' => 'Angre',
    'Redo' => 'Gjør om',

    // Message tab: SMS
    "User's Phone Number Field" => 'Brukerfelt for telefonnummer',
    'Select which User field contains the recipient\'s phone number.' => 'Velg brukerfeltet som inneholder mottakerens telefonnummer.',
    'SMS Message Body' => 'SMS-meldingstekst',
    'Body of the SMS (text message). Plain text only.' => 'Innhold i SMS-en (tekstmelding). Kun ren tekst.',

    // Message tab: Announcement
    'Announcement Title' => 'Kunngjøringstittel',
    'Heading of the announcement.' => 'Overskrift på kunngjøringen.',
    'Dynamic Announcement Title' => 'Dynamisk kunngjøringstittel',
    'Announcement Message' => 'Kunngjøringsmelding',
    'Body of the announcement. Supports Markdown.' => 'Innhold i kunngjøringen. Støtter Markdown.',

    // Message tab: Flash
    'Flash Message Type' => 'Type for flash-melding',
    'Which type of flash message should appear?' => 'Hvilken type flash-melding skal vises?',
    'Flash Message Title' => 'Tittel for flash-melding',
    'Heading of the flash message.' => 'Overskrift på flash-meldingen.',
    'Dynamic Flash Message Title' => 'Dynamisk Flash-meldingstittel',
    'Flash Message Details' => 'Detaljer for flash-melding',
    'Optionally include details below the heading. Supports Markdown and HTML.' => 'Inkluder eventuelt detaljer under overskriften. Støtter Markdown og HTML.',

    // Message tab: Pushover
    "Field containing each user's Pushover key" => 'Brukerens Pushover-nøkkelfelt',
    'Select which User field contains the recipient\'s Pushover user key.' => 'Velg brukerfeltet som inneholder mottakerens Pushover-nøkkel.',
    'Pushover Title' => 'Pushover-tittel',
    'Optionally include a heading above the body.' => 'Inkluder eventuelt en overskrift over innholdet.',
    'Dynamic Pushover Title' => 'Dynamisk Pushover-tittel',
    'Pushover Body' => 'Pushover-tekst',
    'Body of the Pushover notification. Plain text only.' => 'Innhold i Pushover-varselet. Kun ren tekst.',

    // Message tab: ntfy
    'Priority' => 'Prioritet',
    'Priority level of the ntfy message.' => 'Prioritetsnivå for ntfy-meldingen.',
    'Tags' => 'Etiketter',
    'Optionally include comma-separated [emoji shortcodes](https://docs.ntfy.sh/emojis/).' => 'Inkluder eventuelt kommaseparerte [emojikoder](https://docs.ntfy.sh/emojis/).',
    'ntfy Title' => 'ntfy-tittel',
    'Dynamic ntfy Title' => 'Dynamisk ntfy-tittel',
    'ntfy Body' => 'ntfy-tekst',
    'Body of the ntfy notification.' => 'Innhold i ntfy-varselet.',
    'ntfy Link URL' => 'ntfy-lenke-URL',
    'Optionally open a URL when the notification is clicked.' => 'Åpne eventuelt en URL når varselet klikkes.',
    'Enable Markdown' => 'Aktiver Markdown',
    'Whether to parse the body as Markdown in supported clients.' => 'Om innholdet skal tolkes som Markdown i klienter som støtter det.',
    'Regular text only' => 'Kun vanlig tekst',
    'Markdown enabled' => 'Markdown aktivert',

    // Message tab: Slack
    'Slack Message Body' => 'Slack-meldingstekst',
    'Supports standard [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) syntax. Optionally supports HTML _(see below)_.' => 'Støtter standard [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting)-syntaks. Støtter valgfritt HTML _(se nedenfor)_.',
    'Render Message Body as HTML' => 'Vis meldingsinnhold som HTML',
    'Whether to only parse as [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), or additionally parse it as HTML.' => 'Velg om kun [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) skal parses, eller om HTML også skal parses.',
    'Render Link Previews' => 'Vis lenkeforhåndsvisninger',
    'Whether Slack should unfurl link previews for URLs in the message body.' => 'Om Slack skal vise koblingsforhåndsvisninger for URL-er i meldingsteksten.',
    'Don\'t unfurl' => 'Ikke utvid',
    'Expand link previews' => 'Utvid lenkeforhåndsvisninger',
    'Bot Name' => 'Brukernavn',
    'Optionally override the app\'s display name.' => 'Overstyr eventuelt appens visningsnavn.',
    'Dynamic Bot Name' => 'Dynamisk botnavn',
    'Bot Icon URL' => 'Ikon-URL',
    'Optionally override the app\'s icon with a URL.' => 'Overstyr eventuelt appens ikon med en URL.',
    'Bot Emoji' => 'Ikon-emoji',
    'Optionally override the app\'s icon with an emoji. Used only when Bot Icon URL is empty.' => 'Overstyr eventuelt appens ikon med en emoji. Brukes kun når Bot Icon URL er tomt.',

    // Message tab: Discord
    'Discord Message Body' => 'Discord-meldingstekst',
    'Supports standard Markdown, and optionally HTML _(see below)_. Max 2000 characters.' => 'Støtter standard Markdown og valgfritt HTML _(se nedenfor)_. Maks. 2000 tegn.',
    'Whether to only parse as Markdown, or additionally parse it as HTML.' => 'Velg om kun Markdown skal parses, eller om HTML også skal parses.',
    'Markdown only' => 'kun Markdown',
    'Markdown + HTML' => 'Markdown + HTML',
    'Whether Discord should unfurl link previews for URLs in the message body.' => 'Om Discord skal vise lenkeforhåndsvisninger for URL-er i meldingsteksten.',
    'Webhook Username' => 'Webhook-brukernavn',
    'Optionally override the webhook\'s display name.' => 'Overstyr eventuelt webhookens visningsnavn.',
    'Dynamic Username' => 'Dynamisk brukernavn',
    'Webhook Avatar URL' => 'Webhook-avatar-URL',
    'Optionally override the webhook\'s avatar with a URL.' => 'Overstyr eventuelt webhookens avatar med en URL.',

    // Message tab: Bluesky
    'Post Body' => 'Innleggstekst',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => 'Ren tekst, maks 300 tegn. URL-er og `@handle.tld`-omtaler blir automatisk lenker.',
    'Generate Link Preview' => 'Generer lenkeforhåndsvisning',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => 'Generer automatisk et forhåndsvisningskort når innleggets tekst inneholder en URL.',
    'No card' => 'Ingen kort',
    'Generate preview card' => 'Generer forhåndsvisningskort',

    // Message tab: Mastodon
    'Plain text, max 500 characters. URLs will unfurl automatically.' => 'Ren tekst, maks. 500 tegn. URL-er utvides automatisk.',
    'Visibility' => 'Synlighet',
    'Who will be able to see this post?' => 'Hvem vil kunne se dette innlegget?',

    // Message tab: MQTT
    'Payload' => 'Innhold',
    'The JSON or plain text message published to the MQTT topic.' => 'JSON- eller ren tekst-meldingen som publiseres til MQTT-emnet.',
    'Quality of Service' => 'Tjenestekvalitet',
    'Delivery guarantee for this message.' => 'Leveringsgaranti for denne meldingen.',
    'Retain' => 'Behold',
    'Whether the broker keeps this as the topic\'s last message for future subscribers.' => 'Om brokeren beholder denne som den siste meldingen på emnet og leverer den til fremtidige abonnenter.',
    'Don\'t retain' => 'Ikke behold',

    // Recipients tab: type selector & user/group pickers
    'Recipients Type' => 'Mottakertype',
    'Who will receive this message?' => 'Hvem skal motta denne meldingen?',
    'Add a message recipient' => 'Legg til en mottaker',
    'Select User(s)' => 'Velg bruker(e)',
    'Which users will receive the message?' => 'Hvilke brukere skal motta meldingen?',
    'Which user groups will receive the message?' => 'Hvilke brukergrupper skal motta meldingen?',

    // Recipients tab: channel pickers (ntfy, Slack, Discord, Bluesky, Mastodon, MQTT)
    'Select ntfy topic(s)' => 'Velg ntfy-emne(r)',
    'Which topics should receive this message?' => 'Hvilke emner skal motta denne meldingen?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'Ingen ntfy-emner konfigurert. Legg til ett i [Innstillinger → ntfy]({url}).',
    'No ntfy topics configured. Topics can only be added in an environment that allows administrative changes.' => 'Ingen ntfy-emner konfigurert. Emner kan bare legges til i et miljø som tillater administrative endringer.',
    'Select Slack channel(s)' => 'Velg Slack-kanal(er)',
    'Which channels should receive this message?' => 'Hvilke kanaler skal motta denne meldingen?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Ingen Slack-kanaler konfigurert. Legg til en i [Innstillinger → Slack]({url}).',
    'No Slack channels configured. Channels can only be added in an environment that allows administrative changes.' => 'Ingen Slack-kanaler konfigurert. Kanaler kan bare legges til i et miljø som tillater administrative endringer.',
    'Select Discord channel(s)' => 'Velg Discord-kanal(er)',
    'No Discord channels configured. Add one in [Settings → Discord]({url}).' => 'Ingen Discord-kanaler konfigurert. Legg til en i [Innstillinger → Discord]({url}).',
    'No Discord channels configured. Channels can only be added in an environment that allows administrative changes.' => 'Ingen Discord-kanaler konfigurert. Kanaler kan bare legges til i et miljø som tillater administrative endringer.',
    'Select Bluesky account(s)' => 'Velg Bluesky-konto(er)',
    'Which accounts should post this message?' => 'Hvilke kontoer skal publisere denne meldingen?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Ingen Bluesky-kontoer konfigurert. Legg til en i [Innstillinger → Bluesky]({url}).',
    'No Bluesky accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Ingen Bluesky-kontoer konfigurert. Kontoer kan bare legges til i et miljø som tillater administrative endringer.',
    'Select Mastodon account(s)' => 'Velg Mastodon-konto(er)',
    'No Mastodon accounts configured. Add one in [Settings → Mastodon]({url}).' => 'Ingen Mastodon-kontoer konfigurert. Legg til en i [Innstillinger → Mastodon]({url}).',
    'No Mastodon accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Ingen Mastodon-kontoer konfigurert. Kontoer kan bare legges til i et miljø som tillater administrative endringer.',
    'Select MQTT topic(s)' => 'Velg MQTT-emne(r)',
    'No MQTT topics configured. Add one in [Settings → MQTT]({url}).' => 'Ingen MQTT-emner konfigurert. Legg til ett under [Innstillinger → MQTT]({url}).',
    'No MQTT topics configured. Topics can only be added in an environment that allows administrative changes.' => 'Ingen MQTT-emner konfigurert. Emner kan bare legges til i et miljø som tillater administrative endringer.',
    'Not a valid topic. Must not be empty or contain the `+` or `#` wildcards.' => 'Ikke et gyldig emne. Kan ikke være tomt eller inneholde jokertegnene `+` eller `#`.',

    // Recipients tab: dynamic recipients snippet
    'Twig Snippet to Determine Recipients' => 'Twig-utdrag for å bestemme mottakere',
    'Enter a custom Twig snippet to [determine who will receive the message]({url}).' => 'Skriv inn et egendefinert Twig-snippet for å [bestemme hvem som skal motta meldingen]({url}).',
    'The snippet **must** include a `{% setRecipients %}` tag.' => 'Snippeten **må** inneholde en `{% setRecipients %}`-tagg.',

    // ========================================================
    // SETTINGS
    // ========================================================

    // Settings: nav & page chrome
    'Notifier Settings' => 'Notifier-innstillinger',
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
    'Consult the [{name} setup guide]({url}) for complete instructions.' => 'Se [{name}-oppsettsguiden]({url}) for fullstendige instruksjoner.',
    'Sensitive values can be stored in your `.env` file and referenced here.' => 'Sensitive verdier kan lagres i `.env`-filen din og refereres her.',

    // Settings: Notification order
    'Notification Order' => 'Rekkefølge på varsler',
    'Notifications can be dragged into any order on the index page. Choose where new notifications land in that order.' => 'Varsler kan dras til en egendefinert rekkefølge på oversiktssiden. Velg hvor nye varsler legges til i den rekkefølgen.',
    'Default Placement' => 'Standardplassering',
    'Where new notifications are added to the list.' => 'Hvor nye varsler legges til i listen.',
    'Before other notifications' => 'Før andre varsler',
    'After other notifications' => 'Etter andre varsler',

    // Settings: Logging
    'Logging' => 'Logging',
    "Notifier keeps a running log of every message it sends. You usually won't need to change this, but you can limit how many log entries are kept in the database." => 'Notifier fører en løpende logg over sendte meldinger. Det er vanligvis ikke nødvendig, men du kan begrense antall logghendelser som lagres i databasen.',
    'Enable Logging' => 'Aktiver logging',
    'When disabled, Notifier will not write anything to the notification log.' => 'Når deaktivert, skriver Notifier ingenting til varslingsloggen.',
    'Number of days to retain log events' => 'Antall dager logghendelser skal beholdes',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Behold logghendelser i høyst dette antall dager. La stå tomt for ingen grense.',
    'Number of log events to retain' => 'Antall logghendelser som skal beholdes',
    'At most, keep this many log events. Leave blank for no limit.' => 'Behold høyst dette antall logghendelser. La stå tomt for ingen grense.',

    // Settings: Scheduled sending
    'Scheduled Sending' => 'Planlagt sending',
    'A shared secret that authenticates scheduled runs triggered over the web. You only need this if you trigger the schedule from the web endpoint.' => 'Delt hemmelighet for å autentisere webforespørsler om planlagt kjøring. Kreves bare når planen utløses via webendepunktet.',
    'Scheduled-Run Token' => 'Token for planlagt kjøring',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => 'Sendes med hver forespørsel som headeren X-Notifier-Token eller som parameteren token i meldingsteksten.',

    // Settings: Twilio
    'Send SMS text messages through [Twilio](https://www.twilio.com).' => 'Send SMS-tekstmeldinger via [Twilio](https://www.twilio.com).',
    'Twilio Account SID' => 'Twilio Account SID',
    'Twilio Auth Token' => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)' => 'Twilio-telefonnummer (sender hver SMS-melding)',
    'SMS Testing' => 'SMS-testing',
    'Optional. When set, every SMS is sent to this number instead of the actual recipient.' => 'Valgfritt. Hvis satt, sendes hver SMS til dette nummeret i stedet for den faktiske mottakeren.',
    'Test phone number' => 'Testtelefonnummer',

    // Settings: Pushover
    'Send push notifications through [Pushover](https://pushover.net).' => 'Send push-varsler via [Pushover](https://pushover.net).',
    'Application API Token' => 'API-token for applikasjon',
    'The 30-character app token from your Pushover application.' => '30-tegns app-token fra Pushover-applikasjonen din.',

    // Settings: ntfy
    'Send push notifications through [ntfy](https://ntfy.sh).' => 'Send push-varsler via [ntfy](https://ntfy.sh).',
    'Server URL' => 'Server-URL',
    "Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`." => 'Valgfritt. Pek på en selvhostet ntfy-instans hvis aktuelt. Standard er `https://ntfy.sh`.',
    'Access token' => 'Tilgangstoken',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Valgfritt. Kreves for beskyttede emner eller selvhostede instanser med autentisering.',
    'ntfy Topics' => 'ntfy-emner',
    'Add the ntfy topics you want to send to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Legg til ntfy-emnene du vil sende meldinger til. Hvert emne blir tilgjengelig som mottaker på **Mottakere**-fanen når du konfigurerer et varsel.',
    'Topics' => 'Emner',
    "Click any row's **Test** button to send a quick test message to that topic." => 'Klikk på **Test**-knappen på en rad for å sende en rask testmelding til det emnet.',
    'Label' => 'Etikett',
    'Topic' => 'Emne',
    'Add a topic' => 'Legg til et emne',

    // Settings: Slack
    'Post messages to your Slack channels.' => 'Send meldinger til Slack-kanalene dine.',
    'Channels' => 'Kanaler',
    "Click any row's **Test** button to send a quick test message to that channel." => 'Klikk på **Test**-knappen på en rad for å sende en rask testmelding til den kanalen.',
    'Bot Token' => 'Bot-token',
    'Channel ID' => 'Kanal-ID',
    'Add a channel' => 'Legg til en kanal',
    'Not a valid Bot Token. Must start with `xoxb-`.' => 'Ugyldig bot-token. Må starte med `xoxb-`.',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => 'Ugyldig kanal-ID. Må se ut som `C01234ABCD`.',

    // Settings: Discord
    'Post messages to your Discord channels.' => 'Send meldinger til Discord-kanalene dine.',
    'Webhook URL' => 'Webhook-URL',
    'Not a valid Webhook URL. Must start with `https://discord.com/api/webhooks/`.' => 'Ugyldig webhook-URL. Må starte med `https://discord.com/api/webhooks/`.',

    // Settings: Bluesky
    'Publish posts to your [Bluesky](https://bsky.app) accounts.' => 'Publiser innlegg til [Bluesky](https://bsky.app)-kontoene dine.',
    'PDS URL' => 'PDS-URL',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'Standard er https://bsky.social. Pek på en egendefinert PDS hvis installasjonen din federerer.',
    'Bluesky Accounts' => 'Bluesky-kontoer',
    'Add the Bluesky accounts you want to post from. Each account becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Legg til Bluesky-kontoene du vil publisere fra. Hver konto blir tilgjengelig som mottaker på **Mottakere**-fanen når du konfigurerer et varsel.',
    'Accounts' => 'Kontoer',
    "Click any row's **Test** button to confirm the account authenticates." => 'Klikk på **Test**-knappen på en rad for å bekrefte at kontoen autentiseres.',
    'Handle' => 'Handle',
    'App password' => 'App-passord',
    'Add an account' => 'Legg til en konto',

    // Settings: Mastodon
    'Publish posts to your [Mastodon](https://joinmastodon.org) accounts.' => 'Publiser innlegg til [Mastodon](https://joinmastodon.org)-kontoene dine.',
    'Click any row\'s **Test** button to verify that account\'s credentials. No posts are made.' => 'Klikk på **Test**-knappen på en rad for å verifisere den kontoens legitimasjon. Det publiseres ingen innlegg.',
    'Instance URL' => 'Instans-URL',
    'Access Token' => 'Tilgangstoken',

    // Settings: MQTT
    'Publish messages to an MQTT broker, handy for IoT and home-automation setups.' => 'Publiser meldinger til en MQTT-megler, praktisk for IoT- og hjemmeautomasjonsoppsett.',
    'Host' => 'Vert',
    'Broker hostname, without a protocol or port.' => 'Brokerens vertsnavn, uten protokoll eller port.',
    'Port' => 'Port',
    'Optional. Defaults to 8883 when TLS is enabled, otherwise 1883.' => 'Valgfritt. Standard er 8883 når TLS er aktivert, ellers 1883.',
    'Use TLS' => 'Bruk TLS',
    'Whether to connect to the broker over a secure TLS socket.' => 'Om det skal kobles til brokeren via en sikker TLS-socket.',
    'Username' => 'Brukernavn',
    'Optional, for brokers that require username/password authentication.' => 'Valgfritt, for brokere som krever autentisering med brukernavn/passord.',
    'Password' => 'Passord',
    'MQTT Version' => 'MQTT-versjon',
    'Protocol version sent to the broker.' => 'Protokollversjon som sendes til brokeren.',
    'Client ID' => 'Klient-ID',
    'Optional. A unique client ID is generated automatically when left blank.' => 'Valgfritt. En unik klient-ID genereres automatisk når feltet er tomt.',
    'Mutual TLS' => 'Gjensidig TLS',
    'Optional. Needed for brokers that authenticate clients with certificates, such as AWS IoT Core. Enter the server file paths to your certificate files. You can use a `.env` variable or `@alias` reference.' => 'Valgfritt. Kreves for brokere som autentiserer klienter med sertifikater, som AWS IoT Core. Angi serverfilstier til sertifikatfilene (en `.env`-variabel eller `@alias`-referanse er tillatt).',
    'CA Certificate File' => 'CA-sertifikatfil',
    'Path to the certificate authority (CA) file.' => 'Sti til sertifiseringsinstansens (CA) fil.',
    'Client Certificate File' => 'Klientsertifikatfil',
    'Path to the client certificate file.' => 'Sti til klientsertifikatfilen.',
    'Client Key File' => 'Klientnøkkelfil',
    'Path to the client private key file.' => 'Sti til klientens private nøkkelfil.',
    'MQTT Topics' => 'MQTT-emner',
    'Add the MQTT topics you want to publish to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Legg til MQTT-emnene du vil publisere til. Hvert emne blir tilgjengelig som mottaker på **Mottakere**-fanen når du konfigurerer et varsel.',
    'Click any row\'s **Test** button to publish a quick test message to that topic.' => 'Klikk på **Test**-knappen på en rad for å publisere en rask testmelding til det emnet.',

    // ========================================================
    // MANUAL SEND & TEST
    // ========================================================

    // Manual send & test
    'Send a test message' => 'Send en testmelding',
    'Send a REAL test notification?\\n\\n⚠️ Uses a random sample of real data.\\n⚠️ Sends a real message via the configured channel.\\n⚠️ Delivers to the real configured recipient(s).' => 'Send et EKTE testvarsel?\\n\\n⚠️ Bruker et tilfeldig utvalg av ekte data.\\n⚠️ Sender en ekte melding via den konfigurerte kanalen.\\n⚠️ Leveres til de ekte konfigurerte mottakerne.',
    'Test' => 'Test',
    'Send system snapshot' => 'Send systemøyeblikksbilde',
    'Send data report' => 'Send datarapport',
    'Are you sure you want to send this notification?' => 'Er du sikker på at du vil sende dette varselet?',
    'This notification cannot be triggered manually.' => 'Dette varselet kan ikke utløses manuelt.',
    'This notification no longer applies to the selected element.' => 'Dette varselet gjelder ikke lenger for det valgte elementet.',

    // ========================================================
    // RUNTIME OUTPUT
    // ========================================================

    // Runtime: dispatch log feedback
    'Sending {messageType} to {recipient}.' => 'Sender {messageType} til {recipient}.',
    'Adding message to queue.' => 'Legger meldingen i køen.',
    'Sending message immediately (bypassing queue).' => 'Sender meldingen umiddelbart (hopper over køen).',
    'Unable to parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => 'Kan ikke parse feeden. PHP-utvidelsene `simplexml` og `libxml` er påkrevd.',
    'Unable to parse the feed.' => 'Kan ikke parse feeden.',
    'Unable to fetch the feed: {message}' => 'Kan ikke hente feeden: {message}',
    'Initial feed scan failed: {message}' => 'Innledende feed-skanning mislyktes: {message}',

    // Runtime: controller responses
    'Test notification dispatched.' => 'Testvarsel sendt.',
    'No messages were dispatched. Check the recipient configuration.' => 'Ingen meldinger ble sendt. Sjekk mottakerkonfigurasjonen.',
    'Unable to send test: the feed could not be read or has no items.' => 'Kan ikke sende test: feeden kunne ikke leses eller har ingen elementer.',
    'Unable to send test: no element matches the configured filters.' => 'Kan ikke sende test: ingen element samsvarer med de konfigurerte filtrene.',
    "Couldn't save settings." => 'Klarte ikke å lagre innstillingene.',
    'Settings saved.' => 'Innstillinger lagret.',
    'Topic is empty.' => 'Emnet er tomt.',
    'Server URL is not configured.' => 'Server-URL er ikke konfigurert.',
    'Test message from Notifier.' => 'Testmelding fra Notifier.',
    'HTTP {status}' => 'HTTP {status}',
    'Test message sent successfully.' => 'Testmelding sendt.',
    'Handle and app password are required.' => 'Handle og app-passord kreves.',
    'Authentication failed.' => 'Autentisering mislyktes.',
    'Successfully authenticated. No messages were posted.' => 'Autentisering vellykket. Ingen meldinger ble publisert.',
    'Log events deleted.' => 'Logghendelser slettet.',
    'Notification sent.' => 'Varsel sendt.',
    'Notification was not sent. Check the Notification Log for details.' => 'Varselet ble ikke sendt. Sjekk Varslingsloggen for detaljer.',
    'Instance URL and access token are required.' => 'Instans-URL og tilgangstoken kreves.',
    'Mastodon rejected the request: {error}' => 'Mastodon avviste forespørselen: {error}',
    'Successfully authenticated as @{handle}. No posts were made.' => 'Autentisering vellykket som @{handle}. Det ble ikke publisert noen innlegg.',
    'Broker host is not configured.' => 'Broker-verten er ikke konfigurert.',

    // Outbound: per-channel send results
    'Unable to send email, no recipient specified.' => 'Kan ikke sende e-post, ingen mottaker angitt.',
    'Unable to send email, the message body was empty.' => 'Kan ikke sende e-post, meldingsteksten var tom.',
    "Unable to send the email using Craft's native email handling." => 'Kan ikke sende e-posten med Crafts innebygde e-posthåndtering.',
    'Check your general email settings within Craft.' => 'Sjekk de generelle e-postinnstillingene i Craft.',
    'Successfully sent email message!' => 'E-postmelding sendt!',
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[Ugyldig Twilio-legitimasjon.]({url}) Mangler {missing}.',
    'Unable to send SMS, no Twilio phone number exists.' => 'Kan ikke sende SMS, ingen Twilio-telefonnummer eksisterer.',
    'Unable to send SMS, no recipient phone number exists.' => 'Kan ikke sende SMS, ingen mottakertelefonnummer eksisterer.',
    'Unable to send SMS, recipient phone number is invalid.' => 'Kan ikke sende SMS, mottakerens telefonnummer er ugyldig.',
    'Successfully sent SMS message!' => 'SMS-melding sendt!',
    'Unable to post announcement, no recipient userId specified.' => 'Kan ikke publisere kunngjøring: ingen mottaker-userId angitt.',
    'Successfully posted announcement!' => 'Kunngjøring publisert!',
    'Unable to send the flash message, invalid flash type.' => 'Kan ikke sende flash-meldingen, ugyldig flash-type.',
    'Successfully sent flash message!' => 'Flash-melding sendt!',
    '[Invalid Pushover credentials.]({url}) Missing app token.' => '[Ugyldig Pushover-legitimasjon.]({url}) App-token mangler.',
    'Unable to send Pushover message, no user key on recipient.' => 'Kan ikke sende Pushover-melding: ingen brukernøkkel på mottakeren.',
    'Pushover POST failed: {reason}' => 'Pushover POST mislyktes: {reason}',
    'Successfully sent Pushover message!' => 'Pushover-melding sendt!',
    'Unable to send ntfy message, no topic specified.' => 'Kan ikke sende ntfy-melding: intet emne angitt.',
    'ntfy POST failed with HTTP {status}: {reason}' => 'ntfy POST mislyktes med HTTP {status}: {reason}',
    'ntfy POST failed: {reason}' => 'ntfy POST mislyktes: {reason}',
    'Successfully sent ntfy message to topic "{topic}".' => 'ntfy-melding sendt til emnet "{topic}".',
    'Unable to send Slack message, no bot token.' => 'Kan ikke sende Slack-melding: ingen bot-token.',
    'Unable to send Slack message, no channel ID.' => 'Kan ikke sende Slack-melding: ingen kanal-ID.',
    'Unable to send Slack message, body is empty.' => 'Kan ikke sende Slack-melding: innholdet er tomt.',
    'Slack rejected the message: {error}' => 'Slack avviste meldingen: {error}',
    'Slack POST failed: {reason}' => 'Slack POST mislyktes: {reason}',
    'Successfully sent Slack message to "{label}".' => 'Slack-melding sendt til "{label}".',
    'Unable to send Discord message, no webhook URL.' => 'Kan ikke sende Discord-melding: ingen webhook-URL.',
    'Unable to send Discord message, body is empty.' => 'Kan ikke sende Discord-melding: innholdet er tomt.',
    'Unable to send Discord message, body exceeds the 2000-character limit.' => 'Kan ikke sende Discord-melding: innholdet overstiger grensen på 2000 tegn.',
    'Discord rejected the message: {error}' => 'Discord avviste meldingen: {error}',
    'Discord POST failed: {reason}' => 'Discord POST mislyktes: {reason}',
    'Successfully sent Discord message to "{label}".' => 'Discord-melding sendt til "{label}".',
    'Unable to send Bluesky post, recipient is missing credentials.' => 'Kan ikke sende Bluesky-innlegg: mottakeren mangler legitimasjon.',
    'Body exceeded {max} characters, truncated.' => 'Innholdet oversteg {max} tegn og ble kuttet.',
    'Successfully posted to Bluesky as "{label}".' => 'Publisert til Bluesky som "{label}".',
    'Bluesky auth failed for {handle}: {reason}' => 'Bluesky-autentisering mislyktes for {handle}: {reason}',
    'Bluesky auth failed: {reason}' => 'Bluesky-autentisering mislyktes: {reason}',
    'Bluesky post failed: {reason}' => 'Bluesky-innlegg mislyktes: {reason}',
    'Bluesky link preview skipped: {reason}' => 'Bluesky-lenkeforhåndsvisning hoppet over: {reason}',
    'Unable to send Mastodon post, no instance URL.' => 'Kan ikke sende Mastodon-innlegg: ingen instans-URL.',
    'Unable to send Mastodon post, no access token.' => 'Kan ikke sende Mastodon-innlegg: ingen tilgangstoken.',
    'Unable to send Mastodon post, body is empty.' => 'Kan ikke sende Mastodon-innlegg: innholdet er tomt.',
    'Mastodon rejected the post: {error}' => 'Mastodon avviste innlegget: {error}',
    'Mastodon POST failed: {reason}' => 'Mastodon POST mislyktes: {reason}',
    'Successfully sent Mastodon post to "{label}".' => 'Mastodon-innlegg sendt til "{label}".',
    'Unable to send MQTT message, no broker host configured.' => 'Kan ikke sende MQTT-melding, ingen broker-vert er konfigurert.',
    'Unable to send MQTT message, no topic specified.' => 'Kan ikke sende MQTT-melding, ingen emne angitt.',
    'Unable to send MQTT message, the payload is empty.' => 'Kan ikke sende MQTT-melding, innholdet er tomt.',
    'MQTT publish failed: {reason}' => 'MQTT-publisering mislyktes: {reason}',
    'Successfully sent MQTT message to topic "{topic}".' => 'MQTT-melding sendt til emnet "{topic}".',

    // Recipient warnings
    'Recipient "{name}" has no email address.' => 'Mottakeren "{name}" har ingen e-postadresse.',
    'Recipient "{name}" has no phone number.' => 'Mottakeren "{name}" har intet telefonnummer.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => 'Mottakeren "{name}" har ingen tilknyttet bruker; kunngjøringen kan ikke sendes.',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => 'Mottakeren "{name}" har ikke tilgang til kontrollpanelet; kunngjøringen kan ikke sendes.',
    'Pushover user-key field is not configured on this notification.' => 'Pushover-brukernøkkelfeltet er ikke konfigurert på dette varselet.',
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => 'Mottakeren "{name}" har ingen tilknyttet bruker; Pushover-melding kan ikke sendes.',
    '[SKIPPED] User "{name}" has no Pushover key.' => '[HOPPET OVER] Brukeren "{name}" har ingen Pushover-nøkkel.',
    'Recipient "{name}" has no ntfy topic.' => 'Mottakeren "{name}" har intet ntfy-emne.',
    'Recipient "{name}" has no Slack bot token.' => 'Mottakeren "{name}" har ingen Slack bot-token.',
    'Recipient "{name}" has no Slack channel ID.' => 'Mottakeren "{name}" har ingen Slack kanal-ID.',
    'Recipient "{name}" has no Discord webhook URL.' => 'Mottakeren "{name}" har ingen Discord-webhook-URL.',
    'Recipient "{name}" has no Bluesky credentials.' => 'Mottakeren "{name}" har ingen Bluesky-legitimasjon.',
    'Recipient "{name}" has no Mastodon credentials.' => 'Mottakeren "{name}" har ingen Mastodon-legitimasjon.',
    'Recipient "{name}" has no MQTT topic.' => 'Mottakeren "{name}" har ikke noe MQTT-emne.',

    // Errors & exceptions
    'Invalid element event: {class}' => 'Ugyldig elementhendelse: {class}',
    'Invalid notification ID: {id}' => 'Ugyldig varsel-ID: {id}',
    'Invalid email message mode.' => 'Ugyldig e-postmeldingsmodus.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Du har ikke tillatelse til å bruke typen Dynamiske mottakere.',
    'Dynamic recipients snippet did not call setRecipients.' => 'Utdrag for dynamiske mottakere kalte ikke setRecipients.',
    'setRecipients was called with an empty value.' => 'setRecipients ble kalt med en tom verdi.',
    'Unrecognized recipient of type "{type}".' => 'Ukjent mottaker av typen "{type}".',
    'Unrecognized recipient "{value}".' => 'Ukjent mottaker "{value}".',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => 'Konfigurert {kind} finnes ikke lenger i innstillingene for tilleggsmodulen (uid: {uid}).',
    'Invalid settings section: {section}' => 'Ugyldig innstillingsseksjon: {section}',
    'User not authorized to save this notification.' => 'Brukeren har ikke tillatelse til å lagre dette varselet.',
    'User not authorized to view this notification.' => 'Brukeren har ikke tillatelse til å vise dette varselet.',
    'User not authorized to delete this notification.' => 'Brukeren har ikke tillatelse til å slette dette varselet.',
    'Notification not found' => 'Varsel ikke funnet',
    'Element not found' => 'Fant ikke elementet',
    'You do not have permission to use the Dynamic Data type.' => 'Du har ikke tillatelse til å bruke typen Dynamiske data.',
    'The Dynamic Data snippet did not call the {tag} tag.' => 'Twig-snippet kalte ikke {tag}-taggen.',

    // Config-file override note
    'This is being set in the config file. [{file}]' => 'Dette settes i konfigurasjonsfilen. [{file}]',

    // ========================================================
    // JAVASCRIPT UI
    // ========================================================

    // JavaScript: log utility & buttons
    'Test notification failed.' => 'Testvarsel mislyktes.',
    'Unable to get the notification, something went wrong.' => 'Kunne ikke hente varselet, noe gikk galt.',
    'Something went wrong.' => 'Noe gikk galt.',
    'Invalid notification ID.' => 'Ugyldig varsel-ID.',
    'Unable to delete the log event, something went wrong.' => 'Kunne ikke slette logghendelsen, noe gikk galt.',
    'Log event deleted.' => 'Logghendelse slettet.',
    'Unable to delete log events, something went wrong.' => 'Kunne ikke slette logghendelser, noe gikk galt.',
    'Are you sure you want to delete all logs from {date}?' => 'Er du sikker på at du vil slette alle logger fra {date}?',
];
