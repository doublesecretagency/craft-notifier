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
    'Notifications' => 'Meldingen',
    'Notification' => 'Melding',
    'All notifications' => 'Alle meldingen',
    'Notification Log' => 'Meldingenlogboek',
    'Logs' => 'Logboeken',
    'View Notifications' => 'Meldingen bekijken',
    'Add a New Notification' => 'Een nieuwe melding toevoegen',
    'notification' => 'melding',

    // Permissions
    'View notifications' => 'Meldingen bekijken',
    'Save notifications' => 'Meldingen opslaan',
    'Use the Dynamic Recipients type' => 'Het type Dynamische ontvangers gebruiken',
    'Use the Dynamic Data type' => 'Het type Dynamische data gebruiken',
    'Test notifications' => 'Meldingen testen',
    'Send manual notifications' => 'Handmatige notificaties verzenden',
    'Delete notifications' => 'Meldingen verwijderen',
    'View notification log' => 'Meldingenlogboek bekijken',
    'Delete notification log' => 'Meldingenlogboek verwijderen',

    // ========================================================
    // NOTIFICATION EDITOR
    // ========================================================

    // Editor: tabs
    'Meta' => 'Meta',
    'Event' => 'Gebeurtenis',
    'Message' => 'Bericht',
    'Recipients' => 'Ontvangers',

    // Event tab: type selector
    'Event Type' => 'Gebeurtenistype',
    'What type of event will activate the notification?' => 'Welk type gebeurtenis activeert de melding?',
    'Which specific event will activate the notification?' => 'Welke specifieke gebeurtenis activeert de melding?',

    // Event tab: event types
    'Assets Event' => 'Asset-gebeurtenis',
    'Commerce Orders Event' => 'Commerce-bestellingsgebeurtenis',
    'Commerce Products Event' => 'Commerce-productgebeurtenis',
    'Digital Products Event' => 'Digital Products-gebeurtenis',
    'Digital Product Licenses Event' => 'Digital Products-licentiegebeurtenis',
    'Solspace Calendar Event' => 'Solspace Calendar-gebeurtenis',
    'Entries Event' => 'Invoer-gebeurtenis',
    'Users Event' => 'Gebruiker-gebeurtenis',
    'Ungrouped Users' => 'Gebruikers zonder groep',

    // Event tab: Formie
    'Submission Outcome' => 'Inzendingsresultaat',
    'Trigger based on the success or failure of a submission.' => 'Activeren op basis van het slagen of mislukken van een inzending.',
    'Successful submissions only' => 'Alleen geslaagde inzendingen',
    'Failed submissions only' => 'Alleen mislukte inzendingen',
    'All submissions' => 'Alle inzendingen',

    // Event tab: Feed
    'Feed URL' => 'Feed-URL',
    'The URL of the RSS, Atom, or JSON feed to watch.' => 'De URL van de te bewaken RSS-, Atom- of JSON-feed.',
    'Feed Timeout' => 'Feed-time-out',
    'How long to wait when the feed is loading slowly. Default {default} seconds, max {max}.' => 'Hoe lang moet worden gewacht wanneer de feed langzaam laadt. Standaard {default} seconden, max. {max}.',
    'seconds' => 'seconden',

    // Event tab: field conditions
    'Field Conditions' => 'Veldvoorwaarden',
    'Send the message only when the saved element matches the following conditions.' => 'Verzend het bericht alleen wanneer het opgeslagen element aan de volgende voorwaarden voldoet.',
    'has changed' => 'is gewijzigd',

    // Event tab: element filters (panel chrome + common output)
    '#{elementType} Event Filters' => 'Gebeurtenisfilters voor #{elementType}',
    'No filters match this event.' => 'Geen filters komen overeen met deze gebeurtenis.',
    'Determine whether each message should be sent based on specified conditions.' => 'Bepaal op basis van opgegeven voorwaarden of elk bericht verzonden moet worden.',
    'Unnamed filter' => 'Naamloos filter',
    'Must be TRUE to send message' => 'Moet TRUE zijn om het bericht te verzenden',
    'Must be FALSE to send message' => 'Moet FALSE zijn om het bericht te verzenden',
    'No effect' => 'Geen effect',

    // Event tab: element filter rules
    'Element is being saved for the first time' => 'Het element wordt voor het eerst opgeslagen',
    'Must be a new entry' => 'Moet een nieuwe invoer zijn',
    'Must be an existing entry' => 'Moet een bestaande invoer zijn',
    'Can be existing or new' => 'Kan bestaand of nieuw zijn',
    'Element is new' => 'Het element is nieuw',
    'New elements only' => 'Alleen nieuwe elementen',
    'Existing elements only' => 'Alleen bestaande elementen',
    'Element is enabled' => 'Het element is ingeschakeld',
    'Must be enabled' => 'Moet ingeschakeld zijn',
    'Must be disabled' => 'Moet uitgeschakeld zijn',
    'Can be enabled or disabled' => 'Kan ingeschakeld of uitgeschakeld zijn',
    'Element is a draft' => 'Het element is een concept',
    'Must be a draft' => 'Moet een concept zijn',
    'Must not be a draft' => 'Mag geen concept zijn',
    'Can be a draft or non-draft' => 'Kan een concept of geen concept zijn',
    'Element is a provisional draft' => 'Het element is een voorlopig concept',
    'Must be a provisional draft' => 'Moet een voorlopig concept zijn',
    'Must not be a provisional draft' => 'Mag geen voorlopig concept zijn',
    'Can be a provisional draft or non-provisional' => 'Kan een voorlopig of niet-voorlopig concept zijn',
    'Element is a revision' => 'Het element is een revisie',
    'Must be a revision' => 'Moet een revisie zijn',
    'Must not be a revision' => 'Mag geen revisie zijn',
    'Can be a revision or non-revision' => 'Kan een revisie of geen revisie zijn',
    'Element is being duplicated' => 'Het element wordt gedupliceerd',
    'Must be duplicating the element' => 'Moet het element dupliceren',
    'Must not be duplicating the element' => 'Mag het element niet dupliceren',
    'Element is being propagated' => 'Het element wordt verspreid',
    'Element must be propagating' => 'Het element moet aan het verspreiden zijn',
    'Element must not be propagating' => 'Het element mag niet aan het verspreiden zijn',
    'Element is being bulk-resaved' => 'Het element wordt in bulk opnieuw opgeslagen',
    'Must be bulk-resaving the element' => 'Moet het element in bulk opnieuw opslaan',
    'Must not be bulk-resaving the element' => 'Mag het element niet in bulk opnieuw opslaan',

    // Event tab: date trigger
    'On' => 'Op',
    'days before' => 'dagen ervoor',
    'days after' => 'dagen erna',
    'Relevant Date' => 'Relevante datum',
    'Send the notification relative to a chosen date.' => 'Verstuur de melding ten opzichte van een gekozen datum.',

    // Event tab: recurring schedule
    'Every' => 'Elke',
    'on' => 'op',
    'on day' => 'op dag',
    'at' => 'om',
    'Starting on' => 'Vanaf',
    'Day' => 'Dag',
    'Date' => 'Datum',
    'Time' => 'Tijd',
    'day(s)' => 'dag(en)',
    'week(s)' => 'week/weken',
    'month(s)' => 'maand(en)',
    'year(s)' => 'jaar/jaren',
    'day' => 'dag',
    'days' => 'dagen',
    'week' => 'week',
    'weeks' => 'weken',
    'month' => 'maand',
    'months' => 'maanden',
    'year' => 'jaar',
    'years' => 'jaren',
    'Manual only' => 'Alleen handmatig',
    'Scheduled sending' => 'Geplande verzending',
    'Generate report on a recurring schedule' => 'Rapport genereren volgens een terugkerend schema',
    'Generate report on demand' => 'Rapport genereren op aanvraag',
    'Send on a Recurring Schedule' => 'Verzenden volgens een terugkerend schema',
    'Configure Recurring Schedule' => 'Terugkerend schema configureren',
    'System timezone set to {timezone}' => 'Systeemtijdzone ingesteld op {timezone}',
    'Notifications will be sent on the following schedule...' => 'Meldingen worden volgens het volgende schema verzonden...',
    '... and every {cadence} after that.' => '... en daarna elke {cadence}.',
    'On what recurring schedule should the notification be sent?' => 'Volgens welk terugkerend schema moet de melding worden verzonden?',
    'Whether the message should be sent on a schedule, or only triggered manually.' => 'Of het bericht volgens een schema wordt verzonden of alleen handmatig wordt geactiveerd.',
    'The message can always be sent using the "Send system snapshot" button above.' => 'Het bericht kan altijd worden verzonden met de knop "Systeemmomentopname verzenden" hierboven.',
    'The message can always be sent using the "Send data report" button above.' => 'Het bericht kan altijd worden verzonden met de knop "Datarapport verzenden" hierboven.',

    // Event tab: Dynamic Data snippet field
    'Twig Snippet to Determine Data' => 'Twig-snippet om de data te bepalen',
    'Enter a custom Twig snippet to [determine which data will be included]({url}).' => 'Voer een aangepast Twig-snippet in om [te bepalen welke gegevens worden opgenomen]({url}).',
    'The snippet **must** include a `{% setData %}` tag.' => 'Het snippet **moet** een `{% setData %}`-tag bevatten.',
    'You do not have permission to edit dynamic data.' => 'Je hebt geen toestemming om dynamische data te bewerken.',

    // Event tab: manual trigger
    'Trigger Label' => 'Label voor trigger',
    'An element action label (helps to differentiate multiple triggers).' => 'Een label voor de elementactie (helpt meerdere triggers te onderscheiden).',
    'Send Notification' => 'Notificatie verzenden',

    // Message tab: type selector
    'Message Type' => 'Berichttype',
    'What type of message will be sent?' => 'Welk type bericht wordt verzonden?',
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are supported.' => '[Templating]({templatingUrl}) en [speciale variabelen]({variablesUrl}) worden ondersteund.',

    // Details sidebar: queue
    'Use Queue' => 'Wachtrij gebruiken',
    'Immediate' => 'Direct',
    'Queue' => 'Wachtrij',
    'jobs queue' => 'takenwachtrij',
    'Whether the message will be sent immediately, or added to the {link}.' => 'Of het bericht direct wordt verzonden of aan de {link} wordt toegevoegd.',
    'Flash messages never use the queue.' => 'Flash-berichten gebruiken nooit de wachtrij.',
    'Announcements always use the queue.' => 'Aankondigingen gebruiken altijd de wachtrij.',

    // Message tab: Email
    "User's Email Address Field" => 'Gebruikersveld voor e-mailadres',
    'Select which User field contains the recipient\'s email address.' => 'Selecteer het gebruikersveld dat het e-mailadres van de ontvanger bevat.',
    'Email Subject' => 'E-mailonderwerp',
    'Subject line of the email.' => 'Onderwerpregel van de e-mail.',
    'Dynamic Subject Line' => 'Dynamische onderwerpregel',
    'Email Body' => 'E-mailtekst',
    'Body of the email. Supports HTML.' => 'Inhoud van de e-mail. Ondersteunt HTML.',

    // Message tab: rich-text (Trix) toolbar
    'Rich Text' => 'Opgemaakte tekst',
    'Bold' => 'Vet',
    'Italic' => 'Cursief',
    'Underline' => 'Onderstreept',
    'Strikethrough' => 'Doorgestreept',
    'Bullets' => 'Opsommingstekens',
    'Numbers' => 'Nummering',
    'Heading' => 'Kop',
    'Code' => 'Code',
    'Undo' => 'Ongedaan maken',
    'Redo' => 'Opnieuw',

    // Message tab: SMS
    "User's Phone Number Field" => 'Gebruikersveld voor telefoonnummer',
    'Select which User field contains the recipient\'s phone number.' => 'Selecteer het gebruikersveld dat het telefoonnummer van de ontvanger bevat.',
    'SMS Message Body' => 'SMS-berichttekst',
    'Body of the SMS (text message). Plain text only.' => 'Inhoud van het sms-bericht. Alleen platte tekst.',

    // Message tab: Announcement
    'Announcement Title' => 'Aankondigingstitel',
    'Heading of the announcement.' => 'Kop van de aankondiging.',
    'Dynamic Announcement Title' => 'Dynamische aankondigingstitel',
    'Announcement Message' => 'Aankondigingsbericht',
    'Body of the announcement. Supports Markdown.' => 'Inhoud van de aankondiging. Ondersteunt Markdown.',

    // Message tab: Flash
    'Flash Message Type' => 'Flash-berichttype',
    'Which type of flash message should appear?' => 'Welk type flash-bericht moet verschijnen?',
    'Flash Message Title' => 'Flash-berichttitel',
    'Heading of the flash message.' => 'Kop van het flash-bericht.',
    'Dynamic Flash Message Title' => 'Dynamische Flash-berichttitel',
    'Flash Message Details' => 'Flash-berichtdetails',
    'Optionally include details below the heading. Supports Markdown and HTML.' => 'Optioneel details onder de kop opnemen. Ondersteunt Markdown en HTML.',

    // Message tab: Pushover
    "Field containing each user's Pushover key" => 'Pushover-sleutelveld van gebruiker',
    'Select which User field contains the recipient\'s Pushover user key.' => 'Selecteer het gebruikersveld dat de Pushover-sleutel van de ontvanger bevat.',
    'Pushover Title' => 'Pushover-titel',
    'Optionally include a heading above the body.' => 'Optioneel een kop boven de inhoud opnemen.',
    'Dynamic Pushover Title' => 'Dynamische Pushover-titel',
    'Pushover Body' => 'Pushover-tekst',
    'Body of the Pushover notification. Plain text only.' => 'Inhoud van de Pushover-melding. Alleen platte tekst.',

    // Message tab: ntfy
    'Priority' => 'Prioriteit',
    'Priority level of the ntfy message.' => 'Prioriteitsniveau van het ntfy-bericht.',
    'Tags' => 'Tags',
    'Optionally include comma-separated [emoji shortcodes](https://docs.ntfy.sh/emojis/).' => 'Optioneel kommagescheiden [emoji-codes](https://docs.ntfy.sh/emojis/) opnemen.',
    'ntfy Title' => 'ntfy-titel',
    'Dynamic ntfy Title' => 'Dynamische ntfy-titel',
    'ntfy Body' => 'ntfy-tekst',
    'Body of the ntfy notification.' => 'Inhoud van de ntfy-melding.',
    'ntfy Link URL' => 'ntfy-link-URL',
    'Optionally open a URL when the notification is clicked.' => 'Optioneel een URL openen wanneer op de melding wordt geklikt.',
    'Enable Markdown' => 'Markdown inschakelen',
    'Whether to parse the body as Markdown in supported clients.' => 'Of de inhoud in ondersteunde clients als Markdown moet worden gerenderd.',
    'Regular text only' => 'Alleen platte tekst',
    'Markdown enabled' => 'Markdown ingeschakeld',

    // Message tab: Slack
    'Slack Message Body' => 'Slack-berichttekst',
    'Supports standard [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) syntax. Optionally supports HTML _(see below)_.' => 'Ondersteunt standaard [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting)-syntaxis. Ondersteunt optioneel HTML _(zie hieronder)_.',
    'Render Message Body as HTML' => 'Berichtinhoud renderen als HTML',
    'Whether to only parse as [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), or additionally parse it as HTML.' => 'Alleen parsen als [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), of ook als HTML.',
    'Render Link Previews' => 'Linkvoorvertoningen tonen',
    'Whether Slack should unfurl link previews for URLs in the message body.' => "Of Slack linkvoorbeelden moet weergeven voor URL's in het berichtinhoud.",
    'Don\'t unfurl' => 'Niet uitklappen',
    'Expand link previews' => 'Linkvoorvertoningen uitklappen',
    'Bot Name' => 'Gebruikersnaam',
    'Optionally override the app\'s display name.' => 'Optioneel de weergavenaam van de app overschrijven.',
    'Dynamic Bot Name' => 'Dynamische botnaam',
    'Bot Icon URL' => 'Pictogram-URL',
    'Optionally override the app\'s icon with a URL.' => 'Optioneel het pictogram van de app overschrijven met een URL.',
    'Bot Emoji' => 'Pictogram-emoji',
    'Optionally override the app\'s icon with an emoji. Used only when Bot Icon URL is empty.' => 'Optioneel het pictogram van de app overschrijven met een emoji. Alleen gebruikt wanneer Bot Icon URL leeg is.',

    // Message tab: Discord
    'Discord Message Body' => 'Discord-berichttekst',
    'Supports standard Markdown, and optionally HTML _(see below)_. Max 2000 characters.' => 'Ondersteunt standaard Markdown en optioneel HTML _(zie hieronder)_. Max. 2000 tekens.',
    'Whether to only parse as Markdown, or additionally parse it as HTML.' => 'Alleen parsen als Markdown, of ook als HTML.',
    'Markdown only' => 'Alleen Markdown',
    'Markdown + HTML' => 'Markdown + HTML',
    'Whether Discord should unfurl link previews for URLs in the message body.' => 'Of Discord linkvoorvertoningen moet tonen voor URL\'s in de berichttekst.',
    'Webhook Username' => 'Webhook-gebruikersnaam',
    'Optionally override the webhook\'s display name.' => 'Optioneel de weergavenaam van de webhook overschrijven.',
    'Dynamic Username' => 'Dynamische gebruikersnaam',
    'Webhook Avatar URL' => 'Webhook-avatar-URL',
    'Optionally override the webhook\'s avatar with a URL.' => 'Optioneel de avatar van de webhook overschrijven met een URL.',

    // Message tab: Facebook
    'Message Body' => 'Berichttekst',
    'The text of your Facebook post.' => 'De tekst van je Facebook-bericht.',
    'Preview Card URL' => 'Voorbeeldkaart-URL',
    'Optionally add a link to generate a preview card.' => 'Voeg optioneel een link toe om een voorbeeldkaart te genereren.',

    // Message tab: Instagram
    'Caption' => 'Bijschrift',
    'Image Attachment' => 'Afbeeldingsbijlage',
    'Optional caption, max 2200 characters.' => 'Optioneel bijschrift, max. 2200 tekens.',

    // Message tab: X (Twitter)
    'Plain text, max 280 characters.' => 'Platte tekst, max. 280 tekens.',

    // Message tab: Media
    'Attach an image by calling `{% setMedia %}` in a [custom Twig snippet]({url}).' => 'Voeg een afbeelding toe door `{% setMedia %}` aan te roepen in een [aangepast Twig-snippet]({url}).',

    // Message tab: Bluesky
    'Post Body' => 'Berichttekst',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => 'Platte tekst, maximaal 300 tekens. URL\'s en `@handle.tld`-vermeldingen worden automatisch links.',
    'Generate Link Preview' => 'Linkvoorbeeld genereren',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => 'Genereer automatisch een previewkaart wanneer de tekst van het bericht een URL bevat.',
    'No card' => 'Geen kaart',
    'Generate preview card' => 'Voorbeeldkaart genereren',

    // Message tab: Mastodon
    'Plain text, max 500 characters. URLs will unfurl automatically.' => 'Platte tekst, max. 500 tekens. URL\'s worden automatisch uitgevouwen.',
    'Visibility' => 'Zichtbaarheid',
    'Who will be able to see this post?' => 'Wie zal dit bericht kunnen zien?',

    // Message tab: LinkedIn
    'LinkedIn' => 'LinkedIn',
    'The text of your LinkedIn post.' => 'De tekst van je LinkedIn-bericht.',

    // Message tab: MQTT
    'Payload' => 'Inhoud',
    'The JSON or plain text message published to the MQTT topic.' => 'Het JSON- of platte-tekstbericht dat naar het MQTT-onderwerp wordt gepubliceerd.',
    'Quality of Service' => 'Servicekwaliteit',
    'Delivery guarantee for this message.' => 'Leveringsgarantie voor dit bericht.',
    'Retain' => 'Behouden',
    'Whether the broker keeps this as the topic\'s last message for future subscribers.' => 'Of de broker dit als het laatste bericht op het onderwerp behoudt en aan toekomstige abonnees levert.',
    'Don\'t retain' => 'Niet behouden',

    // Recipients tab: type selector & user/group pickers
    'Recipients Type' => 'Type ontvangers',
    'Who will receive this message?' => 'Wie ontvangt dit bericht?',
    'Add a message recipient' => 'Een ontvanger toevoegen',
    'Select User(s)' => 'Gebruiker(s) selecteren',
    'Which users will receive the message?' => 'Welke gebruikers ontvangen het bericht?',
    'Which user groups will receive the message?' => 'Welke gebruikersgroepen ontvangen het bericht?',

    // Recipients tab: channel pickers (ntfy, Slack, Discord, Bluesky, Mastodon, MQTT)
    'Select ntfy topic(s)' => 'ntfy-onderwerp(en) selecteren',
    'Which topics should receive this message?' => 'Welke onderwerpen moeten dit bericht ontvangen?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'Geen ntfy-onderwerpen geconfigureerd. Voeg er een toe in [Instellingen → ntfy]({url}).',
    'No ntfy topics configured. Topics can only be added in an environment that allows administrative changes.' => 'Geen ntfy-onderwerpen geconfigureerd. Onderwerpen kunnen alleen worden toegevoegd in een omgeving die administratieve wijzigingen toestaat.',
    'Select Slack channel(s)' => 'Slack-kana(a)l(en) selecteren',
    'Which channels should receive this message?' => 'Welke kanalen moeten dit bericht ontvangen?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Geen Slack-kanalen geconfigureerd. Voeg er een toe in [Instellingen → Slack]({url}).',
    'No Slack channels configured. Channels can only be added in an environment that allows administrative changes.' => 'Geen Slack-kanalen geconfigureerd. Kanalen kunnen alleen worden toegevoegd in een omgeving die administratieve wijzigingen toestaat.',
    'Select Discord channel(s)' => 'Discord-kana(a)l(en) selecteren',
    'No Discord channels configured. Add one in [Settings → Discord]({url}).' => 'Geen Discord-kanalen geconfigureerd. Voeg er een toe in [Instellingen → Discord]({url}).',
    'No Discord channels configured. Channels can only be added in an environment that allows administrative changes.' => 'Geen Discord-kanalen geconfigureerd. Kanalen kunnen alleen worden toegevoegd in een omgeving die administratieve wijzigingen toestaat.',
    'Select Facebook page(s)' => 'Facebook-pagina(\'s) selecteren',
    'Which pages should post this message?' => 'Welke pagina\'s moeten dit bericht plaatsen?',
    'No Facebook pages configured. Add one in [Settings → Facebook]({url}).' => 'Geen Facebook-pagina\'s geconfigureerd. Voeg er een toe in [Instellingen → Facebook]({url}).',
    'No Facebook pages configured. Pages can only be added in an environment that allows administrative changes.' => 'Geen Facebook-pagina\'s geconfigureerd. Pagina\'s kunnen alleen worden toegevoegd in een omgeving die administratieve wijzigingen toestaat.',
    'Select Instagram account(s)' => 'Instagram-account(s) selecteren',
    'No Instagram accounts configured. Add one in [Settings → Instagram]({url}).' => 'Geen Instagram-accounts geconfigureerd. Voeg er een toe in [Instellingen → Instagram]({url}).',
    'No Instagram accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Geen Instagram-accounts geconfigureerd. Accounts kunnen alleen worden toegevoegd in een omgeving die administratieve wijzigingen toestaat.',
    'Select X (Twitter) account(s)' => 'X (Twitter)-account(s) selecteren',
    'No X (Twitter) accounts configured. Add one in [Settings → X (Twitter)]({url}).' => 'Geen X (Twitter)-accounts geconfigureerd. Voeg er een toe in [Instellingen → X (Twitter)]({url}).',
    'No X (Twitter) accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Geen X (Twitter)-accounts geconfigureerd. Accounts kunnen alleen worden toegevoegd in een omgeving die administratieve wijzigingen toestaat.',
    'Select Bluesky account(s)' => 'Bluesky-account(s) selecteren',
    'Which accounts should post this message?' => 'Welke accounts moeten dit bericht plaatsen?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Geen Bluesky-accounts geconfigureerd. Voeg er een toe in [Instellingen → Bluesky]({url}).',
    'No Bluesky accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Geen Bluesky-accounts geconfigureerd. Accounts kunnen alleen worden toegevoegd in een omgeving die administratieve wijzigingen toestaat.',
    'Select Mastodon account(s)' => 'Mastodon-account(s) selecteren',
    'No Mastodon accounts configured. Add one in [Settings → Mastodon]({url}).' => 'Geen Mastodon-accounts geconfigureerd. Voeg er een toe in [Instellingen → Mastodon]({url}).',
    'No Mastodon accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Geen Mastodon-accounts geconfigureerd. Accounts kunnen alleen worden toegevoegd in een omgeving die administratieve wijzigingen toestaat.',
    'Select MQTT topic(s)' => 'MQTT-onderwerp(en) selecteren',
    'No MQTT topics configured. Add one in [Settings → MQTT]({url}).' => 'Geen MQTT-onderwerpen geconfigureerd. Voeg er een toe in [Instellingen → MQTT]({url}).',
    'No MQTT topics configured. Topics can only be added in an environment that allows administrative changes.' => 'Geen MQTT-onderwerpen geconfigureerd. Onderwerpen kunnen alleen worden toegevoegd in een omgeving die administratieve wijzigingen toestaat.',
    'Not a valid topic. Must not be empty or contain the `+` or `#` wildcards.' => 'Geen geldig onderwerp. Mag niet leeg zijn of de jokertekens `+` of `#` bevatten.',

    // Recipients tab: LinkedIn picker
    'Select LinkedIn account(s)' => 'Selecteer LinkedIn-account(s)',
    'Which page or member should post this message?' => 'Welke pagina of welk lid moet dit bericht plaatsen?',
    'No LinkedIn accounts connected. Connect one in [Settings → LinkedIn]({url}).' => 'Geen LinkedIn-accounts verbonden. Verbind er een in [Instellingen → LinkedIn]({url}).',
    'No LinkedIn accounts connected. Accounts can only be connected in an environment that allows administrative changes.' => 'Geen LinkedIn-accounts verbonden. Accounts kunnen alleen worden verbonden in een omgeving die administratieve wijzigingen toestaat.',

    // Recipients tab: dynamic recipients snippet
    'Twig Snippet to Determine Recipients' => 'Twig-fragment om ontvangers te bepalen',
    'Enter a custom Twig snippet to [determine who will receive the message]({url}).' => 'Voer een aangepast Twig-snippet in om [te bepalen wie het bericht ontvangt]({url}).',
    'The snippet **must** include a `{% setRecipients %}` tag.' => 'Het snippet **moet** een `{% setRecipients %}`-tag bevatten.',

    // ========================================================
    // SETTINGS
    // ========================================================

    // Settings: nav & page chrome
    'Notifier Settings' => 'Notifier-instellingen',
    'General' => 'Algemeen',
    'Twilio' => 'Twilio',
    'Pushover' => 'Pushover',
    'ntfy' => 'ntfy',
    'Slack' => 'Slack',
    'Discord' => 'Discord',
    'Bluesky' => 'Bluesky',
    'Mastodon' => 'Mastodon',
    'MQTT' => 'MQTT',

    // Settings: nav group headings
    'Push Notifications' => 'Pushmeldingen',
    'Chat Platforms' => 'Chatplatforms',
    'Social Media' => 'Sociale media',
    'Internet of Things' => 'Internet of Things',
    'Expand {heading}' => '{heading} uitvouwen',

    // Settings: shared intro lines
    'Consult the [{name} setup guide]({url}) for complete instructions.' => 'Raadpleeg de [{name}-installatiegids]({url}) voor volledige instructies.',
    'Sensitive values can be stored in your `.env` file and referenced here.' => 'Gevoelige waarden kunnen worden opgeslagen in je `.env`-bestand en hier worden gerefereerd.',

    // Settings: Notification order
    'Notification Order' => 'Volgorde van meldingen',
    'Notifications can be dragged into any order on the index page. Choose where new notifications land in that order.' => 'Meldingen kunnen op de overzichtspagina in een eigen volgorde worden gesleept. Kies waar nieuwe meldingen aan die volgorde worden toegevoegd.',
    'Default Placement' => 'Standaardplaatsing',
    'Where new notifications are added to the list.' => 'Waar nieuwe meldingen aan de lijst worden toegevoegd.',
    'Before other notifications' => 'Vóór andere meldingen',
    'After other notifications' => 'Na andere meldingen',

    // Settings: Logging
    'Logging' => 'Logboek',
    "Notifier keeps a running log of every message it sends. You usually won't need to change this, but you can limit how many log entries are kept in the database." => 'Notifier houdt een doorlopend logboek bij van verzonden berichten. Meestal niet nodig, maar je kunt het aantal in de database opgenomen logboekgebeurtenissen beperken.',
    'Enable Logging' => 'Logboek inschakelen',
    'When disabled, Notifier will not write anything to the notification log.' => 'Indien uitgeschakeld, schrijft Notifier niets naar het meldingenlogboek.',
    'Number of days to retain log events' => 'Aantal dagen om logboekgebeurtenissen te bewaren',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Bewaar logboekgebeurtenissen maximaal dit aantal dagen. Laat leeg voor geen limiet.',
    'Number of log events to retain' => 'Aantal logboekgebeurtenissen om te bewaren',
    'At most, keep this many log events. Leave blank for no limit.' => 'Bewaar maximaal dit aantal logboekgebeurtenissen. Laat leeg voor geen limiet.',

    // Settings: Scheduled sending
    'Scheduled Sending' => 'Geplande verzending',
    'A shared secret that authenticates scheduled runs triggered over the web. You only need this if you trigger the schedule from the web endpoint.' => 'Gedeeld geheim om webverzoeken voor een geplande uitvoering te authenticeren. Alleen vereist wanneer de planning via het webeindpunt wordt geactiveerd.',
    'Scheduled-Run Token' => 'Token voor geplande uitvoering',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => 'Wordt met elk verzoek meegestuurd als de X-Notifier-Token header of de token body parameter.',

    // Settings: Twilio
    'Send SMS text messages through [Twilio](https://www.twilio.com).' => 'Verstuur sms-tekstberichten via [Twilio](https://www.twilio.com).',
    'Twilio Account SID' => 'Twilio Account SID',
    'Twilio Auth Token' => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)' => 'Twilio-telefoonnummer (verzendt elk SMS-bericht)',
    'SMS Testing' => 'SMS-tests',
    'Optional. When set, every SMS is sent to this number instead of the actual recipient.' => 'Optioneel. Indien ingesteld, wordt elk verzonden SMS naar dit nummer gestuurd in plaats van naar de daadwerkelijke ontvanger.',
    'Test phone number' => 'Testtelefoonnummer',

    // Settings: Pushover
    'Send push notifications through [Pushover](https://pushover.net).' => 'Verstuur pushmeldingen via [Pushover](https://pushover.net).',
    'Application API Token' => 'Applicatie-API-token',
    'The 30-character app token from your Pushover application.' => 'Het 30-tekens app-token van je Pushover-applicatie.',

    // Settings: ntfy
    'Send push notifications through [ntfy](https://ntfy.sh).' => 'Verstuur pushmeldingen via [ntfy](https://ntfy.sh).',
    'Server URL' => 'Server-URL',
    "Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`." => 'Optioneel. Wijs naar een zelf-gehoste ntfy-instantie indien van toepassing. Standaard `https://ntfy.sh`.',
    'Access token' => 'Toegangstoken',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Optioneel. Vereist voor beschermde onderwerpen of zelf-gehoste instanties met authenticatie.',
    'ntfy Topics' => 'ntfy-onderwerpen',
    'Add the ntfy topics you want to send to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Voeg de ntfy-onderwerpen toe waarnaar je berichten wilt sturen. Elk onderwerp wordt beschikbaar als ontvanger op het tabblad **Ontvangers** bij het configureren van een melding.',
    'Topics' => 'Onderwerpen',
    "Click any row's **Test** button to send a quick test message to that topic." => 'Klik op de knop **Testen** van een rij om een snel testbericht naar dat onderwerp te sturen.',
    'Label' => 'Label',
    'Topic' => 'Onderwerp',
    'Add a topic' => 'Een onderwerp toevoegen',

    // Settings: Slack
    'Post messages to your Slack channels.' => 'Plaats berichten in je Slack-kanalen.',
    'Channels' => 'Kanalen',
    "Click any row's **Test** button to send a quick test message to that channel." => 'Klik op de knop **Testen** van een rij om een snel testbericht naar dat kanaal te sturen.',
    'Bot Token' => 'Bot-token',
    'Channel ID' => 'Kanaal-ID',
    'Add a channel' => 'Een kanaal toevoegen',
    'Not a valid Bot Token. Must start with `xoxb-`.' => 'Geen geldig Bot-token. Moet beginnen met `xoxb-`.',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => 'Geen geldig kanaal-ID. Moet eruitzien als `C01234ABCD`.',

    // Settings: Discord
    'Post messages to your Discord channels.' => 'Plaats berichten in je Discord-kanalen.',
    'Webhook URL' => 'Webhook-URL',
    'Not a valid Webhook URL. Must start with `https://discord.com/api/webhooks/`.' => 'Geen geldige Webhook-URL. Moet beginnen met `https://discord.com/api/webhooks/`.',

    // Settings: Facebook
    'Facebook' => 'Facebook',
    'Publish posts to your [Facebook](https://facebook.com) pages.' => 'Publiceer berichten naar je [Facebook](https://facebook.com)-pagina\'s.',
    'Pages' => 'Pagina\'s',
    'Page ID' => 'Page ID',
    'Page Access Token' => 'Page Access Token',
    'Add a page' => 'Een pagina toevoegen',
    "Click any row's **Test** button to verify that page's credentials. No posts are made." => 'Klik op de knop **Testen** van een rij om de referenties van die pagina te verifiëren. Er worden geen berichten geplaatst.',

    // Settings: Instagram
    'Instagram' => 'Instagram',
    'Publish posts to your [Instagram](https://instagram.com) Business accounts.' => 'Publiceer berichten naar je [Instagram](https://instagram.com) Business-accounts.',
    "Click any row's **Test** button to resolve the linked Instagram account. No posts are made." => 'Klik op de knop **Testen** van een rij om het gekoppelde Instagram-account op te halen. Er worden geen berichten geplaatst.',

    // Settings: X (Twitter)
    'X (Twitter)' => 'X (Twitter)',
    'Publish posts to your [X (Twitter)](https://x.com) accounts.' => 'Publiceer berichten naar je [X (Twitter)](https://x.com)-accounts.',
    'Consumer Key' => 'Consumer Key',
    'Consumer Key Secret' => 'Consumer Key Secret',
    'Access Token Secret' => 'Access Token Secret',

    // Settings: Bluesky
    'Publish posts to your [Bluesky](https://bsky.app) accounts.' => 'Publiceer berichten naar je [Bluesky](https://bsky.app)-accounts.',
    'PDS URL' => 'PDS-URL',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'Standaard https://bsky.social. Wijs naar een aangepaste PDS als je installatie federeert.',
    'Bluesky Accounts' => 'Bluesky-accounts',
    'Add the Bluesky accounts you want to post from. Each account becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Voeg de Bluesky-accounts toe waarvandaan je wilt posten. Elk account wordt beschikbaar als ontvanger op het tabblad **Ontvangers** bij het configureren van een melding.',
    'Accounts' => 'Accounts',
    "Click any row's **Test** button to confirm the account authenticates." => 'Klik op de knop **Testen** van een rij om te bevestigen dat het account authenticeert.',
    'Handle' => 'Handle',
    'App password' => 'App-wachtwoord',
    'Add an account' => 'Een account toevoegen',

    // Settings: Mastodon
    'Publish posts to your [Mastodon](https://joinmastodon.org) accounts.' => 'Publiceer berichten naar je [Mastodon](https://joinmastodon.org)-accounts.',
    'Click any row\'s **Test** button to verify that account\'s credentials. No posts are made.' => 'Klik op de knop **Testen** van een rij om de referenties van dat account te verifiëren. Er worden geen berichten geplaatst.',
    'Instance URL' => 'Instance-URL',
    'Access Token' => 'Toegangstoken',

    // Settings: LinkedIn
    'Publish posts to your [LinkedIn](https://linkedin.com) profile.' => 'Publiceer berichten naar je [LinkedIn](https://linkedin.com)-profiel.',
    'The Client ID of your LinkedIn app.' => 'De Client-ID van je LinkedIn-app.',
    'Client Secret' => 'Client-secret',
    'The Primary Client Secret of your LinkedIn app.' => 'Het primaire Client-secret van je LinkedIn-app.',
    'Enable organization posting' => 'Plaatsen als organisatie inschakelen',
    'Copy this redirect URL' => 'Kopieer deze redirect-URL',
    'When configuring the LinkedIn app, <strong>copy this URL</strong> to use as an "Authorized redirect URL".' => 'Wanneer je de LinkedIn-app configureert, <strong>kopieer deze URL</strong> om te gebruiken als een "Authorized redirect URL".',
    'Also request access to post as organization pages you administer. Requires Community Management API approval from LinkedIn.' => 'Vraag ook toegang aan om te plaatsen als de organisatiepagina\'s die je beheert. Vereist goedkeuring van de Community Management API door LinkedIn.',
    'Connections' => 'Verbindingen',
    'Each connection becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Elke verbinding wordt beschikbaar als ontvanger op het tabblad **Ontvangers** wanneer je een melding instelt.',
    'Account' => 'Account',
    'Type' => 'Type',
    'Status' => 'Status',
    'Organization' => 'Organisatie',
    'Member' => 'Lid',
    'Reconnect needed' => 'Opnieuw verbinden vereist',
    'Expires' => 'Verloopt',
    'Connected' => 'Verbonden',
    'Disconnect' => 'Verbinding verbreken',
    'No LinkedIn accounts are connected yet.' => 'Er zijn nog geen LinkedIn-accounts verbonden.',
    'Connect to LinkedIn' => 'Verbinden met LinkedIn',
    'Provide valid credentials to connect with LinkedIn.' => 'Geef geldige inloggegevens op om verbinding te maken met LinkedIn.',
    'Disconnect this LinkedIn account?' => 'Verbinding met dit LinkedIn-account verbreken?',

    // Settings: MQTT
    'Publish messages to an MQTT broker, handy for IoT and home-automation setups.' => 'Publiceer berichten naar een MQTT-broker, handig voor IoT- en domotica-opstellingen.',
    'Host' => 'Host',
    'Broker hostname, without a protocol or port.' => 'Hostnaam van de broker, zonder protocol of poort.',
    'Port' => 'Poort',
    'Optional. Defaults to 8883 when TLS is enabled, otherwise 1883.' => 'Optioneel. Standaard 8883 wanneer TLS is ingeschakeld, anders 1883.',
    'Use TLS' => 'TLS gebruiken',
    'Whether to connect to the broker over a secure TLS socket.' => 'Of er via een beveiligde TLS-socket verbinding met de broker wordt gemaakt.',
    'Username' => 'Gebruikersnaam',
    'Optional, for brokers that require username/password authentication.' => 'Optioneel, voor brokers die authenticatie met gebruikersnaam/wachtwoord vereisen.',
    'Password' => 'Wachtwoord',
    'MQTT Version' => 'MQTT-versie',
    'Protocol version sent to the broker.' => 'Protocolversie die naar de broker wordt verzonden.',
    'Client ID' => 'Client-ID',
    'Optional. A unique client ID is generated automatically when left blank.' => 'Optioneel. Er wordt automatisch een unieke client-ID gegenereerd wanneer dit leeg wordt gelaten.',
    'Mutual TLS' => 'Wederzijdse TLS',
    'Optional. Needed for brokers that authenticate clients with certificates, such as AWS IoT Core. Enter the server file paths to your certificate files. You can use a `.env` variable or `@alias` reference.' => 'Optioneel. Vereist voor brokers die clients authenticeren met certificaten, zoals AWS IoT Core. Geef serverbestandspaden naar de certificaatbestanden op (een `.env`-variabele of `@alias`-referentie is toegestaan).',
    'CA Certificate File' => 'CA-certificaatbestand',
    'Path to the certificate authority (CA) file.' => 'Pad naar het bestand van de certificeringsinstantie (CA).',
    'Client Certificate File' => 'Clientcertificaatbestand',
    'Path to the client certificate file.' => 'Pad naar het clientcertificaatbestand.',
    'Client Key File' => 'Clientsleutelbestand',
    'Path to the client private key file.' => 'Pad naar het privésleutelbestand van de client.',
    'MQTT Topics' => 'MQTT-onderwerpen',
    'Add the MQTT topics you want to publish to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Voeg de MQTT-onderwerpen toe waarnaar je wilt publiceren. Elk onderwerp wordt beschikbaar als ontvanger op het tabblad **Ontvangers** bij het configureren van een melding.',
    'Click any row\'s **Test** button to publish a quick test message to that topic.' => 'Klik op de knop **Testen** van een rij om een snel testbericht naar dat onderwerp te publiceren.',

    // ========================================================
    // MANUAL SEND & TEST
    // ========================================================

    // Manual send & test
    'Send a test message' => 'Een testbericht verzenden',
    'Send a REAL test notification?\\n\\n⚠️ Uses a random sample of real data.\\n⚠️ Sends a real message via the configured channel.\\n⚠️ Delivers to the real configured recipient(s).' => 'Een ECHTE testmelding verzenden?\\n\\n⚠️ Gebruikt een willekeurige steekproef van echte gegevens.\\n⚠️ Verzendt een echt bericht via het geconfigureerde kanaal.\\n⚠️ Wordt afgeleverd aan de echte geconfigureerde ontvangers.',
    'Test' => 'Testen',
    'Send system snapshot' => 'Systeemmomentopname verzenden',
    'Send data report' => 'Datarapport verzenden',
    'Are you sure you want to send this notification?' => 'Weet je zeker dat je deze notificatie wilt verzenden?',
    'This notification cannot be triggered manually.' => 'Deze notificatie kan niet handmatig worden geactiveerd.',
    'This notification no longer applies to the selected element.' => 'Deze notificatie is niet langer van toepassing op het geselecteerde element.',

    // ========================================================
    // RUNTIME OUTPUT
    // ========================================================

    // Runtime: dispatch log feedback
    'Sending {messageType} to {recipient}.' => '{messageType} verzenden naar {recipient}.',
    'Sending "{title}".' => '"{title}" verzenden.',
    '[invalid recipient]' => '[ongeldige ontvanger]',
    'Scanning feed {url}.' => 'Feed {url} scannen.',
    'Adding message to queue.' => 'Bericht aan wachtrij toevoegen.',
    'Sending message immediately (bypassing queue).' => 'Bericht direct verzenden (wachtrij overslaan).',

    // Runtime: controller responses
    'Test notification dispatched.' => 'Testmelding verzonden.',
    'No messages were dispatched. Check the recipient configuration.' => 'Er zijn geen berichten verzonden. Controleer de ontvangersconfiguratie.',
    'Unable to send test: the feed could not be read or has no items.' => 'Kan test niet verzenden: de feed kon niet worden gelezen of bevat geen items.',
    'Unable to send test: no element matches the configured filters.' => 'Kan test niet verzenden: geen element komt overeen met de geconfigureerde filters.',
    "Couldn't save settings." => 'Kon de instellingen niet opslaan.',
    'Settings saved.' => 'Instellingen opgeslagen.',
    'Topic is empty.' => 'Onderwerp is leeg.',
    'Server URL is not configured.' => 'Server-URL is niet geconfigureerd.',
    'Test message from Notifier.' => 'Testbericht van Notifier.',
    'HTTP {status}' => 'HTTP {status}',
    'Test message sent successfully.' => 'Testbericht succesvol verzonden.',
    'Page ID and Page Access Token are required.' => 'Page ID en Page Access Token zijn vereist.',
    'Facebook rejected the request: {error}' => 'Facebook heeft het verzoek geweigerd: {error}',
    'Successfully connected to "{name}". No posts were made.' => 'Succesvol verbonden met "{name}". Er zijn geen berichten geplaatst.',
    'No Instagram Business account is linked to this Page.' => 'Er is geen Instagram Business-account aan deze pagina gekoppeld.',
    'Successfully connected to @{handle}. No posts were made.' => 'Succesvol verbonden met @{handle}. Er zijn geen berichten geplaatst.',
    'All four credentials are required.' => 'Alle vier de referenties zijn vereist.',
    'X (Twitter) rejected the request: {error}' => 'X (Twitter) heeft het verzoek geweigerd: {error}',
    'Successfully authenticated as @{username}. No posts were made.' => 'Succesvol geverifieerd als @{username}. Er zijn geen berichten geplaatst.',
    'Handle and app password are required.' => 'Handle en app-wachtwoord zijn vereist.',
    'Authentication failed.' => 'Authenticatie mislukt.',
    'Successfully authenticated. No messages were posted.' => 'Verificatie geslaagd. Er zijn geen berichten geplaatst.',
    'Log events deleted.' => 'Logboekgebeurtenissen verwijderd.',
    'Notification sent.' => 'Notificatie verzonden.',
    'Notification was not sent. Check the Notification Log for details.' => 'Notificatie is niet verzonden. Bekijk het Meldingenlogboek voor details.',
    'Instance URL and access token are required.' => 'Instance-URL en toegangstoken zijn vereist.',
    'Mastodon rejected the request: {error}' => 'Mastodon heeft het verzoek geweigerd: {error}',
    'Successfully authenticated as @{handle}. No posts were made.' => 'Succesvol geverifieerd als @{handle}. Er zijn geen berichten geplaatst.',
    'Broker host is not configured.' => 'Broker-host is niet geconfigureerd.',

    // Runtime: LinkedIn connect flow
    'Add your LinkedIn app credentials before connecting.' => 'Voeg je LinkedIn-app-inloggegevens toe voordat je verbinding maakt.',
    'LinkedIn authorization failed: {error}' => 'LinkedIn-autorisatie mislukt: {error}',
    'LinkedIn authorization failed: invalid state.' => 'LinkedIn-autorisatie mislukt: ongeldige status.',
    'LinkedIn authorization failed: no code returned.' => 'LinkedIn-autorisatie mislukt: geen code geretourneerd.',
    'Connected to LinkedIn.' => 'Verbonden met LinkedIn.',
    'Disconnected from LinkedIn.' => 'Verbinding met LinkedIn verbroken.',

    // Outbound: per-channel send results
    'Successfully sent an email to {name}.' => 'E-mailbericht succesvol verzonden naar {name}.',
    'Successfully sent an SMS message to {name}.' => 'SMS-bericht succesvol verzonden naar {name}.',
    'Successfully sent a Pushover notification to {name}.' => 'Pushover-melding succesvol verzonden naar {name}.',
    'Successfully posted an announcement for {name}.' => 'Aankondiging succesvol geplaatst voor {name}.',
    'Successfully sent a flash message to {name}.' => 'Flash-bericht succesvol verzonden naar {name}.',
    'Successfully posted to Slack in channel "{label}".' => 'Succesvol op Slack geplaatst in kanaal "{label}".',
    'Successfully posted to Discord in channel "{label}".' => 'Succesvol op Discord geplaatst in kanaal "{label}".',
    'Successfully posted to Facebook as "{label}" account.' => 'Succesvol op Facebook geplaatst als account "{label}".',
    'Successfully posted to Instagram as "{label}" account.' => 'Succesvol op Instagram geplaatst als account "{label}".',
    'Successfully posted to X (Twitter) as "{label}" account.' => 'Succesvol op X (Twitter) geplaatst als account "{label}".',
    'Successfully posted to Bluesky as "{label}" account.' => 'Succesvol op Bluesky geplaatst als account "{label}".',
    'Successfully posted to Mastodon as "{label}" account.' => 'Succesvol op Mastodon geplaatst als account "{label}".',
    'Successfully posted to LinkedIn as "{label}" account.' => 'Succesvol op LinkedIn geplaatst als account "{label}".',
    'Successfully sent ntfy message to topic "{topic}".' => 'ntfy-bericht succesvol verzonden naar onderwerp "{topic}".',
    'Slack rejected the message: {error}' => 'Slack heeft het bericht geweigerd: {error}',
    'Discord rejected the message: {error}' => 'Discord heeft het bericht geweigerd: {error}',
    'the attached image could not be read' => 'de bijgevoegde afbeelding kon niet worden gelezen',
    'Successfully sent MQTT message to topic "{topic}".' => 'MQTT-bericht verzonden naar onderwerp "{topic}".',

    // Outbound: LinkedIn send results & skips
    '[EMPTY BODY] The LinkedIn post body is empty.' => '[EMPTY BODY] De tekst van het LinkedIn-bericht is leeg.',
    '[NO RECIPIENT] No LinkedIn connection was specified.' => '[NO RECIPIENT] Er is geen LinkedIn-verbinding opgegeven.',
    '[RECONNECT REQUIRED] {reason}' => '[RECONNECT REQUIRED] {reason}',
    '[REJECTED BY LINKEDIN] {error}' => '[REJECTED BY LINKEDIN] {error}',
    'LinkedIn app credentials are not configured.' => 'LinkedIn-app-inloggegevens zijn niet geconfigureerd.',
    'The LinkedIn access token has expired. Please reconnect.' => 'Het LinkedIn-toegangstoken is verlopen. Maak opnieuw verbinding.',
    'The LinkedIn connection no longer exists.' => 'De LinkedIn-verbinding bestaat niet meer.',
    'My LinkedIn Profile' => 'Mijn LinkedIn-profiel',
    '[SKIPPED] Recipient "{name}" has no LinkedIn connection.' => '[SKIPPED] Ontvanger "{name}" heeft geen LinkedIn-verbinding.',
    '[SKIPPED] The configured LinkedIn connection no longer exists (uid: {uid}).' => '[SKIPPED] De geconfigureerde LinkedIn-verbinding bestaat niet meer (uid: {uid}).',

    // Media attachments
    'Videos are not yet supported on {channel}.' => "Video's worden nog niet ondersteund op {channel}.",
    'The image could not be resized to fit.' => 'De afbeelding kon niet passend worden geschaald.',
    'The image could not be read.' => 'De afbeelding kon niet worden gelezen.',
    'The image failed to upload.' => 'Het uploaden van de afbeelding is mislukt.',
    'The upload response had no media ID.' => 'Het uploadantwoord bevatte geen media-ID.',
    'The upload response had no blob.' => 'Het uploadantwoord bevatte geen blob.',
    '[NOT ATTACHED] Unable to attach image. {reason}' => '[NIET BIJGEVOEGD] Kan de afbeelding niet bijvoegen. {reason}',

    // Recipient warnings
    '[SKIPPED] User "{name}" has no Pushover key.' => '[OVERGESLAGEN] Gebruiker "{name}" heeft geen Pushover-sleutel.',

    // Errors & exceptions
    'Invalid element event: {class}' => 'Ongeldige elementgebeurtenis: {class}',
    'Invalid notification ID: {id}' => 'Ongeldig meldings-ID: {id}',
    'Invalid email message mode.' => 'Ongeldige e-mailberichtmodus.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Je hebt geen toestemming om het type Dynamische ontvangers te gebruiken.',
    'Invalid settings section: {section}' => 'Ongeldige instellingen-sectie: {section}',
    'User not authorized to save this notification.' => 'Gebruiker is niet bevoegd om deze melding op te slaan.',
    'User not authorized to view this notification.' => 'Gebruiker is niet bevoegd om deze melding te bekijken.',
    'User not authorized to delete this notification.' => 'Gebruiker is niet bevoegd om deze melding te verwijderen.',
    'Notification not found' => 'Melding niet gevonden',
    'Element not found' => 'Element niet gevonden',
    'You do not have permission to use the Dynamic Data type.' => 'Je hebt geen toestemming om het type Dynamische data te gebruiken.',
    '[NO DATA] The Dynamic Data snippet did not call the {tag} tag.' => '[GEEN GEGEVENS] De Twig-snippet heeft de {tag}-tag niet aangeroepen.',

    // Config-file override note
    'This is being set in the config file. [{file}]' => 'Dit wordt ingesteld in het configuratiebestand. [{file}]',

    // ========================================================
    // JAVASCRIPT UI
    // ========================================================

    // JavaScript: log utility & buttons
    'Test notification failed.' => 'Testmelding mislukt.',
    'Unable to get the notification, something went wrong.' => 'Kan de melding niet ophalen, er is iets misgegaan.',
    'Something went wrong.' => 'Er is iets misgegaan.',
    'Invalid notification ID.' => 'Ongeldige melding-ID.',
    'Unable to delete the log event, something went wrong.' => 'Kan de loggebeurtenis niet verwijderen, er is iets misgegaan.',
    'Log event deleted.' => 'Loggebeurtenis verwijderd.',
    'Unable to delete log events, something went wrong.' => 'Kan loggebeurtenissen niet verwijderen, er is iets misgegaan.',
    'Are you sure you want to delete all logs from {date}?' => 'Weet je zeker dat je alle logboeken van {date} wilt verwijderen?',

    // Reworded outbound + dispatch log messages
    '[BAD CREDENTIALS] Missing app token. [Configure Pushover]({url}).' => '[ONGELDIGE GEGEVENS] App-token ontbreekt. [Pushover configureren]({url}).',
    '[BAD CREDENTIALS] Missing {missing}. [Configure Twilio]({url}).' => '[ONGELDIGE GEGEVENS] {missing} ontbreekt. [Twilio configureren]({url}).',
    '[BAD CREDENTIALS] No Discord webhook URL is configured.' => '[ONGELDIGE GEGEVENS] Er is geen Discord-webhook-URL geconfigureerd.',
    '[BAD CREDENTIALS] No MQTT broker host is configured.' => '[ONGELDIGE GEGEVENS] Er is geen MQTT-brokerhost geconfigureerd.',
    '[BAD CREDENTIALS] No Mastodon access token is configured.' => '[ONGELDIGE GEGEVENS] Er is geen Mastodon-toegangstoken geconfigureerd.',
    '[BAD CREDENTIALS] No Mastodon instance URL is configured.' => '[ONGELDIGE GEGEVENS] Er is geen Mastodon-instantie-URL geconfigureerd.',
    '[BAD CREDENTIALS] No Slack bot token is configured.' => '[ONGELDIGE GEGEVENS] Er is geen Slack-bottoken geconfigureerd.',
    '[BAD CREDENTIALS] No Twilio phone number is configured.' => '[ONGELDIGE GEGEVENS] Er is geen Twilio-telefoonnummer geconfigureerd.',
    '[BAD CREDENTIALS] The recipient is missing Bluesky credentials.' => '[ONGELDIGE GEGEVENS] De ontvanger mist Bluesky-gegevens.',
    '[BAD CREDENTIALS] The recipient is missing Facebook credentials.' => '[ONGELDIGE GEGEVENS] De ontvanger mist Facebook-gegevens.',
    '[BAD CREDENTIALS] The recipient is missing X (Twitter) credentials.' => '[ONGELDIGE GEGEVENS] De ontvanger mist X (Twitter)-gegevens.',
    '[BAD CREDENTIALS] Unable to post, recipient is missing credentials.' => '[ONGELDIGE GEGEVENS] Kan niet posten; de ontvanger mist gegevens.',
    '[EMPTY BODY] The Discord message body is empty.' => '[LEGE INHOUD] De Discord-berichttekst is leeg.',
    '[EMPTY BODY] The Facebook post body is empty.' => '[LEGE INHOUD] De Facebook-berichttekst is leeg.',
    '[EMPTY BODY] The MQTT payload is empty.' => '[LEGE INHOUD] De MQTT-payload is leeg.',
    '[EMPTY BODY] The Mastodon post body is empty.' => '[LEGE INHOUD] De Mastodon-berichttekst is leeg.',
    '[EMPTY BODY] The Slack message body is empty.' => '[LEGE INHOUD] De Slack-berichttekst is leeg.',
    '[EMPTY BODY] The X (Twitter) post body is empty.' => '[LEGE INHOUD] De X (Twitter)-berichttekst is leeg.',
    '[EMPTY BODY] The email message body was empty.' => '[LEGE INHOUD] De e-mailtekst was leeg.',
    '[FEED ERROR] Could not fetch the feed: {message}' => '[FEED-FOUT] Kan de feed niet ophalen: {message}',
    '[FEED ERROR] Could not parse the feed.' => '[FEED-FOUT] Kan de feed niet verwerken.',
    '[FEED ERROR] Could not parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => '[FEED-FOUT] Kan de feed niet verwerken. De PHP-extensies `simplexml` en `libxml` zijn vereist.',
    '[FEED ERROR] Initial feed scan failed: {message}' => '[FEED-FOUT] De eerste feedscan is mislukt: {message}',
    '[INVALID NUMBER] The recipient phone number is invalid.' => '[ONGELDIG NUMMER] Het telefoonnummer van de ontvanger is ongeldig.',
    '[INVALID TYPE] The flash message type is invalid.' => '[ONGELDIG TYPE] Het type flashbericht is ongeldig.',
    '[LINK PREVIEW SKIPPED] {reason}' => '[LINKVOORBEELD OVERGESLAGEN] {reason}',
    '[MISSING IMAGE] Image Attachment field never called the {tag} tag.' => '[ONTBREKENDE AFBEELDING] Het veld Afbeeldingsbijlage heeft de {tag}-tag nooit aangeroepen.',
    '[MISSING IMAGE] Image Attachment field was empty.' => '[ONTBREKENDE AFBEELDING] Het veld Afbeeldingsbijlage was leeg.',
    '[MISSING IMAGE] The {tag} tag was called, but returned an invalid image.' => '[ONTBREKENDE AFBEELDING] De {tag}-tag is aangeroepen, maar gaf een ongeldige afbeelding terug.',
    '[MISSING IMAGE] Unable to send Instagram post, the image needs a public URL.' => '[ONTBREKENDE AFBEELDING] Kan Instagram-bericht niet verzenden; de afbeelding heeft een openbare URL nodig.',
    '[NO CALENDAR] No calendars are selected, this notification will never be triggered.' => '[GEEN KALENDER] Er zijn geen kalenders geselecteerd, deze melding wordt nooit geactiveerd.',
    '[NO DIGITAL PRODUCT TYPE] No digital product types are selected, this notification will never be triggered.' => '[GEEN DIGITAAL PRODUCTTYPE] Er zijn geen digitale producttypen geselecteerd, deze melding wordt nooit geactiveerd.',
    '[NO ENTRY TYPE] No sections or entry types are selected, this notification will never be triggered.' => '[GEEN ITEMTYPE] Er zijn geen secties of itemtypen geselecteerd, deze melding wordt nooit geactiveerd.',
    '[NO FORM] No forms are selected, this notification will never be triggered.' => '[GEEN FORMULIER] Er zijn geen formulieren geselecteerd, deze melding wordt nooit geactiveerd.',
    '[NO PRODUCT TYPE] No product types are selected, this notification will never be triggered.' => '[GEEN PRODUCTTYPE] Er zijn geen producttypen geselecteerd, deze melding wordt nooit geactiveerd.',
    '[NO USER GROUP] No user groups are selected, this notification will never be triggered.' => '[GEEN GEBRUIKERSGROEP] Er zijn geen gebruikersgroepen geselecteerd, deze melding wordt nooit geactiveerd.',
    '[NO VOLUME] No volumes are selected, this notification will never be triggered.' => '[GEEN VOLUME] Er zijn geen volumes geselecteerd, deze melding wordt nooit geactiveerd.',
    '[NO MEDIA] No image was attached because the {tag} tag was never invoked in the Image Attachment field.' => '[GEEN MEDIA] Er is geen afbeelding bijgevoegd omdat de {tag}-tag nooit is aangeroepen in het veld Afbeeldingsbijlage.',
    '[NO RECIPIENTS] The Dynamic Recipients snippet did not call setRecipients.' => '[GEEN ONTVANGERS] Het fragment voor dynamische ontvangers heeft setRecipients niet aangeroepen.',
    '[NO RECIPIENTS] setRecipients was called with an empty value.' => '[GEEN ONTVANGERS] setRecipients is aangeroepen met een lege waarde.',
    '[NO RECIPIENT] No MQTT topic was specified.' => '[GEEN ONTVANGER] Er is geen MQTT-onderwerp opgegeven.',
    '[NO RECIPIENT] No Slack channel ID was specified.' => '[GEEN ONTVANGER] Er is geen Slack-kanaal-ID opgegeven.',
    '[NO RECIPIENT] No ntfy topic was specified.' => '[GEEN ONTVANGER] Er is geen ntfy-onderwerp opgegeven.',
    '[NO RECIPIENT] No recipient user was specified for the announcement.' => '[GEEN ONTVANGER] Er is geen ontvangende gebruiker opgegeven voor de aankondiging.',
    '[NO RECIPIENT] No recipient was specified for the email.' => '[GEEN ONTVANGER] Er is geen ontvanger opgegeven voor de e-mail.',
    '[NO RECIPIENT] The recipient has no Pushover user key.' => '[GEEN ONTVANGER] De ontvanger heeft geen Pushover-gebruikerssleutel.',
    '[NO RECIPIENT] The recipient has no phone number.' => '[GEEN ONTVANGER] De ontvanger heeft geen telefoonnummer.',
    '[REJECTED BY DISCORD] {error}' => '[GEWEIGERD DOOR DISCORD] {error}',
    '[REJECTED BY FACEBOOK] {error}' => '[GEWEIGERD DOOR FACEBOOK] {error}',
    '[REJECTED BY INSTAGRAM] {error}' => '[GEWEIGERD DOOR INSTAGRAM] {error}',
    '[REJECTED BY MASTODON] {error}' => '[GEWEIGERD DOOR MASTODON] {error}',
    '[REJECTED BY SLACK] {error}' => '[GEWEIGERD DOOR SLACK] {error}',
    '[REJECTED BY X (TWITTER)] {error}' => '[GEWEIGERD DOOR X (TWITTER)] {error}',
    '[SEND FAILED] Authentication failed for {handle}: {reason}' => '[VERZENDEN MISLUKT] Verificatie mislukt voor {handle}: {reason}',
    '[SEND FAILED] Authentication failed: {reason}' => '[VERZENDEN MISLUKT] Verificatie mislukt: {reason}',
    "[SEND FAILED] Could not send the email using Craft's native handling. Check your general email settings within Craft." => '[VERZENDEN MISLUKT] Kan de e-mail niet verzenden via de native verwerking van Craft. Controleer je algemene e-mailinstellingen in Craft.',
    '[SEND FAILED] HTTP {status}: {reason}' => '[VERZENDEN MISLUKT] HTTP {status}: {reason}',
    '[SEND FAILED] {error}' => '[VERZENDEN MISLUKT] {error}',
    '[SEND FAILED] {reason}' => '[VERZENDEN MISLUKT] {reason}',
    '[SKIPPED] Pushover user-key field is not configured on this notification.' => '[OVERGESLAGEN] Het Pushover-gebruikerssleutelveld is niet geconfigureerd voor deze melding.',
    '[SKIPPED] Recipient "{name}" cannot access the control panel.' => '[OVERGESLAGEN] Ontvanger "{name}" heeft geen toegang tot het control panel.',
    '[SKIPPED] Recipient "{name}" has no Bluesky credentials.' => '[OVERGESLAGEN] Ontvanger "{name}" heeft geen Bluesky-gegevens.',
    '[SKIPPED] Recipient "{name}" has no Craft user account.' => '[OVERGESLAGEN] Ontvanger "{name}" heeft geen Craft-gebruikersaccount.',
    '[SKIPPED] Recipient "{name}" has no Discord webhook URL.' => '[OVERGESLAGEN] Ontvanger "{name}" heeft geen Discord-webhook-URL.',
    '[SKIPPED] Recipient "{name}" has no Facebook credentials.' => '[OVERGESLAGEN] Ontvanger "{name}" heeft geen Facebook-gegevens.',
    '[SKIPPED] Recipient "{name}" has no Instagram credentials.' => '[OVERGESLAGEN] Ontvanger "{name}" heeft geen Instagram-gegevens.',
    '[SKIPPED] Recipient "{name}" has no MQTT topic.' => '[OVERGESLAGEN] Ontvanger "{name}" heeft geen MQTT-onderwerp.',
    '[SKIPPED] Recipient "{name}" has no Mastodon credentials.' => '[OVERGESLAGEN] Ontvanger "{name}" heeft geen Mastodon-gegevens.',
    '[SKIPPED] Recipient "{name}" has no Slack bot token.' => '[OVERGESLAGEN] Ontvanger "{name}" heeft geen Slack-bottoken.',
    '[SKIPPED] Recipient "{name}" has no Slack channel ID.' => '[OVERGESLAGEN] Ontvanger "{name}" heeft geen Slack-kanaal-ID.',
    '[SKIPPED] Recipient "{name}" has no X (Twitter) credentials.' => '[OVERGESLAGEN] Ontvanger "{name}" heeft geen X (Twitter)-gegevens.',
    '[SKIPPED] Recipient "{name}" has no email address.' => '[OVERGESLAGEN] Ontvanger "{name}" heeft geen e-mailadres.',
    '[SKIPPED] Recipient "{name}" has no ntfy topic.' => '[OVERGESLAGEN] Ontvanger "{name}" heeft geen ntfy-onderwerp.',
    '[SKIPPED] Recipient "{name}" has no phone number.' => '[OVERGESLAGEN] Ontvanger "{name}" heeft geen telefoonnummer.',
    '[SKIPPED] The configured {kind} no longer exists in the plugin settings (uid: {uid}).' => '[OVERGESLAGEN] De geconfigureerde {kind} bestaat niet meer in de plugin-instellingen (uid: {uid}).',
    '[SKIPPED] Unrecognized recipient "{value}".' => '[OVERGESLAGEN] Onbekende ontvanger "{value}".',
    '[SKIPPED] Unrecognized recipient of type "{type}".' => '[OVERGESLAGEN] Onbekend ontvangertype "{type}".',
    '[TOO LONG] The Discord message body exceeds the 2000-character limit.' => '[TE LANG] De Discord-berichttekst overschrijdt de limiet van 2000 tekens.',
    '[TRUNCATED] Body exceeded {max} characters.' => '[INGEKORT] De inhoud overschreed {max} tekens.',
    '[TRUNCATED] Caption exceeded {max} characters.' => '[INGEKORT] Het bijschrift overschreed {max} tekens.',
];
