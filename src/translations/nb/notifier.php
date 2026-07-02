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
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are supported.' => '[Templating]({templatingUrl}) og [spesielle variabler]({variablesUrl}) støttes.',

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

    // Message tab: Facebook
    'Message Body' => 'Meldingstekst',
    'The text of your Facebook post.' => 'Teksten i Facebook-innlegget ditt.',
    'Preview Card URL' => 'Forhåndsvisningskort-URL',
    'Optionally add a link to generate a preview card.' => 'Legg eventuelt til en lenke for å generere et forhåndsvisningskort.',

    // Message tab: Instagram
    'Caption' => 'Bildetekst',
    'Image Attachment' => 'Bildevedlegg',
    'Optional caption, max 2200 characters.' => 'Valgfri bildetekst, maks 2200 tegn.',

    // Message tab: X (Twitter)
    'Plain text, max 280 characters.' => 'Ren tekst, maks 280 tegn.',

    // Message tab: Media
    'Attach an image by calling `{% setMedia %}` in a [custom Twig snippet]({url}).' => 'Legg ved et bilde ved å kalle `{% setMedia %}` i et [egendefinert Twig-snippet]({url}).',

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

    // Message tab: LinkedIn
    'LinkedIn' => 'LinkedIn',
    'The text of your LinkedIn post.' => 'Teksten i LinkedIn-innlegget ditt.',

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
    'Select Facebook page(s)' => 'Velg Facebook-side(r)',
    'Which pages should post this message?' => 'Hvilke sider skal publisere denne meldingen?',
    'No Facebook pages configured. Add one in [Settings → Facebook]({url}).' => 'Ingen Facebook-sider konfigurert. Legg til en i [Innstillinger → Facebook]({url}).',
    'No Facebook pages configured. Pages can only be added in an environment that allows administrative changes.' => 'Ingen Facebook-sider konfigurert. Sider kan bare legges til i et miljø som tillater administrative endringer.',
    'Select Instagram account(s)' => 'Velg Instagram-konto(er)',
    'No Instagram accounts configured. Add one in [Settings → Instagram]({url}).' => 'Ingen Instagram-kontoer konfigurert. Legg til en i [Innstillinger → Instagram]({url}).',
    'No Instagram accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Ingen Instagram-kontoer konfigurert. Kontoer kan bare legges til i et miljø som tillater administrative endringer.',
    'Select X (Twitter) account(s)' => 'Velg X (Twitter)-konto(er)',
    'No X (Twitter) accounts configured. Add one in [Settings → X (Twitter)]({url}).' => 'Ingen X (Twitter)-kontoer konfigurert. Legg til en i [Innstillinger → X (Twitter)]({url}).',
    'No X (Twitter) accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Ingen X (Twitter)-kontoer konfigurert. Kontoer kan bare legges til i et miljø som tillater administrative endringer.',
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

    // Recipients tab: LinkedIn picker
    'Select LinkedIn account(s)' => 'Velg LinkedIn-konto(er)',
    'Which page or member should post this message?' => 'Hvilken side eller medlem skal publisere denne meldingen?',
    'No LinkedIn accounts connected. Connect one in [Settings → LinkedIn]({url}).' => 'Ingen LinkedIn-kontoer tilkoblet. Koble til en i [Innstillinger → LinkedIn]({url}).',
    'No LinkedIn accounts connected. Accounts can only be connected in an environment that allows administrative changes.' => 'Ingen LinkedIn-kontoer tilkoblet. Kontoer kan bare kobles til i et miljø som tillater administrative endringer.',

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

    // Settings: nav group headings
    'Push Notifications' => 'Push-varsler',
    'Chat Platforms' => 'Chatplattformer',
    'Social Media' => 'Sosiale medier',
    'Internet of Things' => 'Tingenes internett',
    'Expand {heading}' => 'Utvid {heading}',

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

    // Settings: Facebook
    'Facebook' => 'Facebook',
    'Publish posts to your [Facebook](https://facebook.com) pages.' => 'Publiser innlegg til [Facebook](https://facebook.com)-sidene dine.',
    'Pages' => 'Sider',
    'Page ID' => 'Page ID',
    'Page Access Token' => 'Page Access Token',
    'Add a page' => 'Legg til en side',
    "Click any row's **Test** button to verify that page's credentials. No posts are made." => 'Klikk på **Test**-knappen på en rad for å verifisere den sidens legitimasjon. Det publiseres ingen innlegg.',

    // Settings: Instagram
    'Instagram' => 'Instagram',
    'Publish posts to your [Instagram](https://instagram.com) Business accounts.' => 'Publiser innlegg til [Instagram](https://instagram.com) Business-kontoene dine.',
    "Click any row's **Test** button to resolve the linked Instagram account. No posts are made." => 'Klikk på **Test**-knappen på en rad for å finne den tilknyttede Instagram-kontoen. Det publiseres ingen innlegg.',

    // Settings: X (Twitter)
    'X (Twitter)' => 'X (Twitter)',
    'Publish posts to your [X (Twitter)](https://x.com) accounts.' => 'Publiser innlegg til [X (Twitter)](https://x.com)-kontoene dine.',
    'Consumer Key' => 'Consumer Key',
    'Consumer Key Secret' => 'Consumer Key Secret',
    'Access Token Secret' => 'Access Token Secret',

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

    // Settings: LinkedIn
    'Publish posts to your [LinkedIn](https://linkedin.com) profile.' => 'Publiser innlegg til [LinkedIn](https://linkedin.com)-profilen din.',
    'The Client ID of your LinkedIn app.' => 'Klient-ID-en til LinkedIn-appen din.',
    'Client Secret' => 'Klienthemmelighet',
    'The Primary Client Secret of your LinkedIn app.' => 'Den primære klienthemmeligheten til LinkedIn-appen din.',
    'Enable organization posting' => 'Aktiver publisering for organisasjoner',
    'Copy this redirect URL' => 'Kopiér denne omdirigerings-URL',
    'When configuring the LinkedIn app, <strong>copy this URL</strong> to use as an "Authorized redirect URL".' => 'Når du konfigurerer LinkedIn-appen, <strong>kopier denne URL-en</strong> for å bruke den som en "Authorized redirect URL".',
    'Also request access to post as organization pages you administer. Requires Community Management API approval from LinkedIn.' => 'Be også om tilgang til å publisere som organisasjonssidene du administrerer. Krever godkjenning av Community Management API fra LinkedIn.',
    'Connections' => 'Tilkoblinger',
    'Each connection becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Hver tilkobling blir tilgjengelig som mottaker under fanen **Mottakere** når du setter opp et varsel.',
    'Account' => 'Konto',
    'Type' => 'Type',
    'Status' => 'Status',
    'Organization' => 'Organisasjon',
    'Member' => 'Medlem',
    'Reconnect needed' => 'Tilkobling på nytt kreves',
    'Expires' => 'Utløper',
    'Connected' => 'Tilkoblet',
    'Disconnect' => 'Koble fra',
    'No LinkedIn accounts are connected yet.' => 'Ingen LinkedIn-kontoer er tilkoblet ennå.',
    'Connect to LinkedIn' => 'Koble til LinkedIn',
    'Provide valid credentials to connect with LinkedIn.' => 'Oppgi gyldig påloggingsinformasjon for å koble til LinkedIn.',
    'Disconnect this LinkedIn account?' => 'Koble fra denne LinkedIn-kontoen?',

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
    'Sending "{title}".' => 'Sender "{title}".',
    '[invalid recipient]' => '[ugyldig mottaker]',
    'Scanning feed {url}.' => 'Skanner feedet {url}.',
    'Adding message to queue.' => 'Legger meldingen i køen.',
    'Sending message immediately (bypassing queue).' => 'Sender meldingen umiddelbart (hopper over køen).',

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
    'Page ID and Page Access Token are required.' => 'Page ID og Page Access Token kreves.',
    'Facebook rejected the request: {error}' => 'Facebook avviste forespørselen: {error}',
    'Successfully connected to "{name}". No posts were made.' => 'Tilkobling vellykket til "{name}". Det ble ikke publisert noen innlegg.',
    'No Instagram Business account is linked to this Page.' => 'Ingen Instagram Business-konto er tilknyttet denne siden.',
    'Successfully connected to @{handle}. No posts were made.' => 'Tilkobling vellykket til @{handle}. Det ble ikke publisert noen innlegg.',
    'All four credentials are required.' => 'Alle fire legitimasjonene kreves.',
    'X (Twitter) rejected the request: {error}' => 'X (Twitter) avviste forespørselen: {error}',
    'Successfully authenticated as @{username}. No posts were made.' => 'Autentisering vellykket som @{username}. Det ble ikke publisert noen innlegg.',
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

    // Runtime: LinkedIn connect flow
    'Add your LinkedIn app credentials before connecting.' => 'Legg til LinkedIn-app-legitimasjonen din før du kobler til.',
    'LinkedIn authorization failed: {error}' => 'LinkedIn-autorisering mislyktes: {error}',
    'LinkedIn authorization failed: invalid state.' => 'LinkedIn-autorisering mislyktes: ugyldig tilstand.',
    'LinkedIn authorization failed: no code returned.' => 'LinkedIn-autorisering mislyktes: ingen kode returnert.',
    'Connected to LinkedIn.' => 'Koblet til LinkedIn.',
    'Disconnected from LinkedIn.' => 'Koblet fra LinkedIn.',

    // Outbound: per-channel send results
    'Successfully sent an email to {name}.' => 'E-post sendt til {name}.',
    'Successfully sent an SMS message to {name}.' => 'SMS-melding sendt til {name}.',
    'Successfully sent a Pushover notification to {name}.' => 'Pushover-varsel sendt til {name}.',
    'Successfully posted an announcement for {name}.' => 'Kunngjøring publisert for {name}.',
    'Successfully sent a flash message to {name}.' => 'Flash-melding sendt til {name}.',
    'Successfully posted to Slack in channel "{label}".' => 'Publisert til Slack i kanalen "{label}".',
    'Successfully posted to Discord in channel "{label}".' => 'Publisert til Discord i kanalen "{label}".',
    'Successfully posted to Facebook as "{label}" account.' => 'Publisert til Facebook som kontoen "{label}".',
    'Successfully posted to Instagram as "{label}" account.' => 'Publisert til Instagram som kontoen "{label}".',
    'Successfully posted to X (Twitter) as "{label}" account.' => 'Publisert til X (Twitter) som kontoen "{label}".',
    'Successfully posted to Bluesky as "{label}" account.' => 'Publisert til Bluesky som kontoen "{label}".',
    'Successfully posted to Mastodon as "{label}" account.' => 'Publisert til Mastodon som kontoen "{label}".',
    'Successfully posted to LinkedIn as "{label}" account.' => 'Publisert til LinkedIn som kontoen "{label}".',
    'Successfully sent ntfy message to topic "{topic}".' => 'ntfy-melding sendt til emnet "{topic}".',
    'Slack rejected the message: {error}' => 'Slack avviste meldingen: {error}',
    'Discord rejected the message: {error}' => 'Discord avviste meldingen: {error}',
    'the attached image could not be read' => 'det vedlagte bildet kunne ikke leses',
    'Successfully sent MQTT message to topic "{topic}".' => 'MQTT-melding sendt til emnet "{topic}".',

    // Outbound: LinkedIn send results & skips
    '[EMPTY BODY] The LinkedIn post body is empty.' => '[EMPTY BODY] Teksten i LinkedIn-innlegget er tom.',
    '[NO RECIPIENT] No LinkedIn connection was specified.' => '[NO RECIPIENT] Ingen LinkedIn-tilkobling ble angitt.',
    '[RECONNECT REQUIRED] {reason}' => '[RECONNECT REQUIRED] {reason}',
    '[REJECTED BY LINKEDIN] {error}' => '[REJECTED BY LINKEDIN] {error}',
    'LinkedIn app credentials are not configured.' => 'LinkedIn-app-legitimasjon er ikke konfigurert.',
    'The LinkedIn access token has expired. Please reconnect.' => 'LinkedIn-tilgangstokenet har utløpt. Koble til på nytt.',
    'The LinkedIn connection no longer exists.' => 'LinkedIn-tilkoblingen finnes ikke lenger.',
    'My LinkedIn Profile' => 'Min LinkedIn-profil',
    '[SKIPPED] Recipient "{name}" has no LinkedIn connection.' => '[SKIPPED] Mottakeren "{name}" har ingen LinkedIn-tilkobling.',
    '[SKIPPED] The configured LinkedIn connection no longer exists (uid: {uid}).' => '[SKIPPED] Den konfigurerte LinkedIn-tilkoblingen finnes ikke lenger (uid: {uid}).',

    // Media attachments
    'Videos are not yet supported on {channel}.' => 'Videoer støttes ennå ikke på {channel}.',
    'The image could not be resized to fit.' => 'Bildet kunne ikke skaleres for å passe.',
    'The image could not be read.' => 'Bildet kunne ikke leses.',
    'The image failed to upload.' => 'Opplasting av bildet mislyktes.',
    'The upload response had no media ID.' => 'Opplastingssvaret inneholdt ingen medie-ID.',
    'The upload response had no blob.' => 'Opplastingssvaret inneholdt ingen blob.',
    '[NOT ATTACHED] Unable to attach image. {reason}' => '[IKKE VEDLAGT] Kunne ikke legge ved bildet. {reason}',

    // Recipient warnings
    '[SKIPPED] User "{name}" has no Pushover key.' => '[HOPPET OVER] Brukeren "{name}" har ingen Pushover-nøkkel.',

    // Errors & exceptions
    'Invalid element event: {class}' => 'Ugyldig elementhendelse: {class}',
    'Invalid notification ID: {id}' => 'Ugyldig varsel-ID: {id}',
    'Invalid email message mode.' => 'Ugyldig e-postmeldingsmodus.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Du har ikke tillatelse til å bruke typen Dynamiske mottakere.',
    'Invalid settings section: {section}' => 'Ugyldig innstillingsseksjon: {section}',
    'User not authorized to save this notification.' => 'Brukeren har ikke tillatelse til å lagre dette varselet.',
    'User not authorized to view this notification.' => 'Brukeren har ikke tillatelse til å vise dette varselet.',
    'User not authorized to delete this notification.' => 'Brukeren har ikke tillatelse til å slette dette varselet.',
    'Notification not found' => 'Varsel ikke funnet',
    'Element not found' => 'Fant ikke elementet',
    'You do not have permission to use the Dynamic Data type.' => 'Du har ikke tillatelse til å bruke typen Dynamiske data.',
    '[NO DATA] The Dynamic Data snippet did not call the {tag} tag.' => '[INGEN DATA] Twig-snippet kalte ikke {tag}-taggen.',

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
    // Reworded outbound + dispatch log messages
    '[BAD CREDENTIALS] Missing app token. [Configure Pushover]({url}).' => '[UGYLDIG LEGITIMASJON] Mangler app-token. [Konfigurer Pushover]({url}).',
    '[BAD CREDENTIALS] Missing {missing}. [Configure Twilio]({url}).' => '[UGYLDIG LEGITIMASJON] Mangler {missing}. [Konfigurer Twilio]({url}).',
    '[BAD CREDENTIALS] No Discord webhook URL is configured.' => '[UGYLDIG LEGITIMASJON] Ingen Discord-webhook-URL er konfigurert.',
    '[BAD CREDENTIALS] No MQTT broker host is configured.' => '[UGYLDIG LEGITIMASJON] Ingen MQTT-megler-vert er konfigurert.',
    '[BAD CREDENTIALS] No Mastodon access token is configured.' => '[UGYLDIG LEGITIMASJON] Ingen Mastodon-tilgangstoken er konfigurert.',
    '[BAD CREDENTIALS] No Mastodon instance URL is configured.' => '[UGYLDIG LEGITIMASJON] Ingen Mastodon-instans-URL er konfigurert.',
    '[BAD CREDENTIALS] No Slack bot token is configured.' => '[UGYLDIG LEGITIMASJON] Ingen Slack-bot-token er konfigurert.',
    '[BAD CREDENTIALS] No Twilio phone number is configured.' => '[UGYLDIG LEGITIMASJON] Ingen Twilio-telefonnummer er konfigurert.',
    '[BAD CREDENTIALS] The recipient is missing Bluesky credentials.' => '[UGYLDIG LEGITIMASJON] Mottakeren mangler Bluesky-legitimasjon.',
    '[BAD CREDENTIALS] The recipient is missing Facebook credentials.' => '[UGYLDIG LEGITIMASJON] Mottakeren mangler Facebook-legitimasjon.',
    '[BAD CREDENTIALS] The recipient is missing X (Twitter) credentials.' => '[UGYLDIG LEGITIMASJON] Mottakeren mangler X (Twitter)-legitimasjon.',
    '[BAD CREDENTIALS] Unable to post, recipient is missing credentials.' => '[UGYLDIG LEGITIMASJON] Kan ikke publisere; mottakeren mangler legitimasjon.',
    '[EMPTY BODY] The Discord message body is empty.' => '[TOMT INNHOLD] Discord-meldingens innhold er tomt.',
    '[EMPTY BODY] The Facebook post body is empty.' => '[TOMT INNHOLD] Facebook-innleggets innhold er tomt.',
    '[EMPTY BODY] The MQTT payload is empty.' => '[TOMT INNHOLD] MQTT-nyttelasten er tomt.',
    '[EMPTY BODY] The Mastodon post body is empty.' => '[TOMT INNHOLD] Mastodon-innleggets innhold er tomt.',
    '[EMPTY BODY] The Slack message body is empty.' => '[TOMT INNHOLD] Slack-meldingens innhold er tomt.',
    '[EMPTY BODY] The X (Twitter) post body is empty.' => '[TOMT INNHOLD] X (Twitter)-innleggets innhold er tomt.',
    '[EMPTY BODY] The email message body was empty.' => '[TOMT INNHOLD] E-postens innhold var tomt.',
    '[FEED ERROR] Could not fetch the feed: {message}' => '[FEED-FEIL] Kunne ikke hente feedet: {message}',
    '[FEED ERROR] Could not parse the feed.' => '[FEED-FEIL] Kunne ikke tolke feedet.',
    '[FEED ERROR] Could not parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => '[FEED-FEIL] Kunne ikke tolke feedet. PHP-utvidelsene `simplexml` og `libxml` kreves.',
    '[FEED ERROR] Initial feed scan failed: {message}' => '[FEED-FEIL] Den første feedskanningen mislyktes: {message}',
    '[INVALID NUMBER] The recipient phone number is invalid.' => '[UGYLDIG NUMMER] Mottakerens telefonnummer er ugyldig.',
    '[INVALID TYPE] The flash message type is invalid.' => '[UGYLDIG TYPE] Flash-meldingstypen er ugyldig.',
    '[LINK PREVIEW SKIPPED] {reason}' => '[FORHÅNDSVISNING HOPPET OVER] {reason}',
    '[MISSING IMAGE] Image Attachment field never called the {tag} tag.' => '[MANGLENDE BILDE] Feltet Bildevedlegg kalte aldri {tag}-taggen.',
    '[MISSING IMAGE] Image Attachment field was empty.' => '[MANGLENDE BILDE] Feltet Bildevedlegg var tomt.',
    '[MISSING IMAGE] The {tag} tag was called, but returned an invalid image.' => '[MANGLENDE BILDE] {tag}-taggen ble kalt, men returnerte et ugyldig bilde.',
    '[MISSING IMAGE] Unable to send Instagram post, the image needs a public URL.' => '[MANGLENDE BILDE] Kan ikke sende Instagram-innlegg; bildet trenger en offentlig URL.',
    '[NO CALENDAR] No calendars are selected, this notification will never be triggered.' => '[INGEN KALENDER] Ingen kalendere er valgt, dette varselet utløses aldri.',
    '[NO DIGITAL PRODUCT TYPE] No digital product types are selected, this notification will never be triggered.' => '[INGEN DIGITAL PRODUKTTYPE] Ingen digitale produkttyper er valgt, dette varselet utløses aldri.',
    '[NO ENTRY TYPE] No sections or entry types are selected, this notification will never be triggered.' => '[INGEN OPPFØRINGSTYPE] Ingen seksjoner eller oppføringstyper er valgt, dette varselet utløses aldri.',
    '[NO PRODUCT TYPE] No product types are selected, this notification will never be triggered.' => '[INGEN PRODUKTTYPE] Ingen produkttyper er valgt, dette varselet utløses aldri.',
    '[NO USER GROUP] No user groups are selected, this notification will never be triggered.' => '[INGEN BRUKERGRUPPE] Ingen brukergrupper er valgt, dette varselet utløses aldri.',
    '[NO VOLUME] No volumes are selected, this notification will never be triggered.' => '[INGEN VOLUM] Ingen volumer er valgt, dette varselet utløses aldri.',
    '[NO MEDIA] No image was attached because the {tag} tag was never invoked in the Image Attachment field.' => '[INGEN MEDIER] Det ble ikke lagt ved noe bilde fordi {tag}-taggen aldri ble kalt i feltet Bildevedlegg.',
    '[NO RECIPIENTS] The Dynamic Recipients snippet did not call setRecipients.' => '[INGEN MOTTAKERE] Kodebiten for dynamiske mottakere kalte ikke setRecipients.',
    '[NO RECIPIENTS] setRecipients was called with an empty value.' => '[INGEN MOTTAKERE] setRecipients ble kalt med en tom verdi.',
    '[NO RECIPIENT] No MQTT topic was specified.' => '[INGEN MOTTAKER] Det ble ikke angitt noe MQTT-emne.',
    '[NO RECIPIENT] No Slack channel ID was specified.' => '[INGEN MOTTAKER] Det ble ikke angitt noen Slack-kanal-ID.',
    '[NO RECIPIENT] No ntfy topic was specified.' => '[INGEN MOTTAKER] Det ble ikke angitt noe ntfy-emne.',
    '[NO RECIPIENT] No recipient user was specified for the announcement.' => '[INGEN MOTTAKER] Det ble ikke angitt noen mottakerbruker for kunngjøringen.',
    '[NO RECIPIENT] No recipient was specified for the email.' => '[INGEN MOTTAKER] Det ble ikke angitt noen mottaker for e-posten.',
    '[NO RECIPIENT] The recipient has no Pushover user key.' => '[INGEN MOTTAKER] Mottakeren har ingen Pushover-brukernøkkel.',
    '[NO RECIPIENT] The recipient has no phone number.' => '[INGEN MOTTAKER] Mottakeren har ikke noe telefonnummer.',
    '[REJECTED BY DISCORD] {error}' => '[AVVIST AV DISCORD] {error}',
    '[REJECTED BY FACEBOOK] {error}' => '[AVVIST AV FACEBOOK] {error}',
    '[REJECTED BY INSTAGRAM] {error}' => '[AVVIST AV INSTAGRAM] {error}',
    '[REJECTED BY MASTODON] {error}' => '[AVVIST AV MASTODON] {error}',
    '[REJECTED BY SLACK] {error}' => '[AVVIST AV SLACK] {error}',
    '[REJECTED BY X (TWITTER)] {error}' => '[AVVIST AV X (TWITTER)] {error}',
    '[SEND FAILED] Authentication failed for {handle}: {reason}' => '[SENDING MISLYKTES] Autentisering mislyktes for {handle}: {reason}',
    '[SEND FAILED] Authentication failed: {reason}' => '[SENDING MISLYKTES] Autentisering mislyktes: {reason}',
    "[SEND FAILED] Could not send the email using Craft's native handling. Check your general email settings within Craft." => '[SENDING MISLYKTES] Kunne ikke sende e-posten med Crafts innebygde håndtering. Sjekk de generelle e-postinnstillingene i Craft.',
    '[SEND FAILED] HTTP {status}: {reason}' => '[SENDING MISLYKTES] HTTP {status}: {reason}',
    '[SEND FAILED] {error}' => '[SENDING MISLYKTES] {error}',
    '[SEND FAILED] {reason}' => '[SENDING MISLYKTES] {reason}',
    '[SKIPPED] Pushover user-key field is not configured on this notification.' => '[HOPPET OVER] Pushover-brukernøkkelfeltet er ikke konfigurert på dette varselet.',
    '[SKIPPED] Recipient "{name}" cannot access the control panel.' => '[HOPPET OVER] Mottakeren "{name}" har ikke tilgang til kontrollpanelet.',
    '[SKIPPED] Recipient "{name}" has no Bluesky credentials.' => '[HOPPET OVER] Mottakeren "{name}" har ingen Bluesky-legitimasjon.',
    '[SKIPPED] Recipient "{name}" has no Craft user account.' => '[HOPPET OVER] Mottakeren "{name}" har ingen Craft-brukerkonto.',
    '[SKIPPED] Recipient "{name}" has no Discord webhook URL.' => '[HOPPET OVER] Mottakeren "{name}" har ingen Discord-webhook-URL.',
    '[SKIPPED] Recipient "{name}" has no Facebook credentials.' => '[HOPPET OVER] Mottakeren "{name}" har ingen Facebook-legitimasjon.',
    '[SKIPPED] Recipient "{name}" has no Instagram credentials.' => '[HOPPET OVER] Mottakeren "{name}" har ingen Instagram-legitimasjon.',
    '[SKIPPED] Recipient "{name}" has no MQTT topic.' => '[HOPPET OVER] Mottakeren "{name}" har ingen MQTT-emne.',
    '[SKIPPED] Recipient "{name}" has no Mastodon credentials.' => '[HOPPET OVER] Mottakeren "{name}" har ingen Mastodon-legitimasjon.',
    '[SKIPPED] Recipient "{name}" has no Slack bot token.' => '[HOPPET OVER] Mottakeren "{name}" har ingen Slack-bot-token.',
    '[SKIPPED] Recipient "{name}" has no Slack channel ID.' => '[HOPPET OVER] Mottakeren "{name}" har ingen Slack-kanal-ID.',
    '[SKIPPED] Recipient "{name}" has no X (Twitter) credentials.' => '[HOPPET OVER] Mottakeren "{name}" har ingen X (Twitter)-legitimasjon.',
    '[SKIPPED] Recipient "{name}" has no email address.' => '[HOPPET OVER] Mottakeren "{name}" har ingen e-postadresse.',
    '[SKIPPED] Recipient "{name}" has no ntfy topic.' => '[HOPPET OVER] Mottakeren "{name}" har ingen ntfy-emne.',
    '[SKIPPED] Recipient "{name}" has no phone number.' => '[HOPPET OVER] Mottakeren "{name}" har ingen telefonnummer.',
    '[SKIPPED] The configured {kind} no longer exists in the plugin settings (uid: {uid}).' => '[HOPPET OVER] Den konfigurerte {kind} finnes ikke lenger i plugin-innstillingene (uid: {uid}).',
    '[SKIPPED] Unrecognized recipient "{value}".' => '[HOPPET OVER] Ukjent mottaker "{value}".',
    '[SKIPPED] Unrecognized recipient of type "{type}".' => '[HOPPET OVER] Ukjent mottakertype "{type}".',
    '[TOO LONG] The Discord message body exceeds the 2000-character limit.' => '[FOR LANG] Discord-meldingens innhold overstiger grensen på 2000 tegn.',
    '[TRUNCATED] Body exceeded {max} characters.' => '[AVKORTET] Innholdet oversteg {max} tegn.',
    '[TRUNCATED] Caption exceeded {max} characters.' => '[AVKORTET] Bildeteksten oversteg {max} tegn.',
];
