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

    // Event tab: Feed
    'Feed URL' => 'Feed-URL',
    'The URL of the RSS, Atom, or JSON feed to watch.' => 'De URL van de te bewaken RSS-, Atom- of JSON-feed.',

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
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are also supported.' => '[Templating]({templatingUrl}) en [speciale variabelen]({variablesUrl}) worden ook ondersteund.',

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
    'Adding message to queue.' => 'Bericht aan wachtrij toevoegen.',
    'Sending message immediately (bypassing queue).' => 'Bericht direct verzenden (wachtrij overslaan).',
    'Unable to parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => 'Kan de feed niet verwerken. De PHP-extensies `simplexml` en `libxml` zijn vereist.',
    'Unable to parse the feed.' => 'Kan de feed niet verwerken.',
    'Unable to fetch the feed: {message}' => 'Kan de feed niet ophalen: {message}',
    'Initial feed scan failed: {message}' => 'Eerste feed-scan mislukt: {message}',

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

    // Outbound: per-channel send results
    'Unable to send email, no recipient specified.' => 'Kan e-mail niet verzenden: geen ontvanger opgegeven.',
    'Unable to send email, the message body was empty.' => 'Kan e-mail niet verzenden: de berichttekst was leeg.',
    "Unable to send the email using Craft's native email handling." => 'Kan de e-mail niet verzenden met de native e-mailafhandeling van Craft.',
    'Check your general email settings within Craft.' => 'Controleer je algemene e-mailinstellingen in Craft.',
    'Successfully sent email message!' => 'E-mailbericht succesvol verzonden!',
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[Ongeldige Twilio-referenties.]({url}) {missing} ontbreekt.',
    'Unable to send SMS, no Twilio phone number exists.' => 'Kan SMS niet verzenden: er is geen Twilio-telefoonnummer.',
    'Unable to send SMS, no recipient phone number exists.' => 'Kan SMS niet verzenden: er is geen telefoonnummer van de ontvanger.',
    'Unable to send SMS, recipient phone number is invalid.' => 'Kan SMS niet verzenden: telefoonnummer van de ontvanger is ongeldig.',
    'Successfully sent SMS message!' => 'SMS-bericht succesvol verzonden!',
    'Unable to post announcement, no recipient userId specified.' => 'Kan aankondiging niet plaatsen: geen ontvanger-userId opgegeven.',
    'Successfully posted announcement!' => 'Aankondiging succesvol geplaatst!',
    'Unable to send the flash message, invalid flash type.' => 'Kan flash-bericht niet verzenden: ongeldig flash-type.',
    'Successfully sent flash message!' => 'Flash-bericht succesvol verzonden!',
    '[Invalid Pushover credentials.]({url}) Missing app token.' => '[Ongeldige Pushover-referenties.]({url}) App-token ontbreekt.',
    'Unable to send Pushover message, no user key on recipient.' => 'Kan Pushover-bericht niet verzenden: geen gebruikerssleutel bij de ontvanger.',
    'Pushover POST failed: {reason}' => 'Pushover POST mislukt: {reason}',
    'Successfully sent Pushover message!' => 'Pushover-bericht succesvol verzonden!',
    'Unable to send ntfy message, no topic specified.' => 'Kan ntfy-bericht niet verzenden: geen onderwerp opgegeven.',
    'ntfy POST failed with HTTP {status}: {reason}' => 'ntfy POST mislukt met HTTP {status}: {reason}',
    'ntfy POST failed: {reason}' => 'ntfy POST mislukt: {reason}',
    'Successfully sent ntfy message to topic "{topic}".' => 'ntfy-bericht succesvol verzonden naar onderwerp "{topic}".',
    'Unable to send Slack message, no bot token.' => 'Kan Slack-bericht niet verzenden: geen bot-token.',
    'Unable to send Slack message, no channel ID.' => 'Kan Slack-bericht niet verzenden: geen kanaal-ID.',
    'Unable to send Slack message, body is empty.' => 'Kan Slack-bericht niet verzenden: tekst is leeg.',
    'Slack rejected the message: {error}' => 'Slack heeft het bericht geweigerd: {error}',
    'Slack POST failed: {reason}' => 'Slack POST mislukt: {reason}',
    'Successfully sent Slack message to "{label}".' => 'Slack-bericht succesvol verzonden naar "{label}".',
    'Unable to send Discord message, no webhook URL.' => 'Kan Discord-bericht niet verzenden: geen webhook-URL.',
    'Unable to send Discord message, body is empty.' => 'Kan Discord-bericht niet verzenden: tekst is leeg.',
    'Unable to send Discord message, body exceeds the 2000-character limit.' => 'Kan Discord-bericht niet verzenden: tekst overschrijdt de limiet van 2000 tekens.',
    'Discord rejected the message: {error}' => 'Discord heeft het bericht geweigerd: {error}',
    'Discord POST failed: {reason}' => 'Discord POST mislukt: {reason}',
    'Successfully sent Discord message to "{label}".' => 'Discord-bericht succesvol verzonden naar "{label}".',
    'Unable to send Bluesky post, recipient is missing credentials.' => 'Kan Bluesky-bericht niet verzenden: ontvanger mist referenties.',
    'Body exceeded {max} characters, truncated.' => 'Tekst overschreed {max} tekens en werd afgekapt.',
    'Successfully posted to Bluesky as "{label}".' => 'Succesvol op Bluesky geplaatst als "{label}".',
    'Bluesky auth failed for {handle}: {reason}' => 'Bluesky-authenticatie mislukt voor {handle}: {reason}',
    'Bluesky auth failed: {reason}' => 'Bluesky-authenticatie mislukt: {reason}',
    'Bluesky post failed: {reason}' => 'Bluesky-bericht mislukt: {reason}',
    'Bluesky link preview skipped: {reason}' => 'Bluesky-linkvoorbeeld overgeslagen: {reason}',
    'Unable to send Mastodon post, no instance URL.' => 'Kan Mastodon-bericht niet verzenden: geen instance-URL.',
    'Unable to send Mastodon post, no access token.' => 'Kan Mastodon-bericht niet verzenden: geen toegangstoken.',
    'Unable to send Mastodon post, body is empty.' => 'Kan Mastodon-bericht niet verzenden: tekst is leeg.',
    'Mastodon rejected the post: {error}' => 'Mastodon heeft het bericht geweigerd: {error}',
    'Mastodon POST failed: {reason}' => 'Mastodon POST mislukt: {reason}',
    'Successfully sent Mastodon post to "{label}".' => 'Mastodon-bericht succesvol verzonden naar "{label}".',
    'Unable to send MQTT message, no broker host configured.' => 'Kan MQTT-bericht niet verzenden, geen broker-host geconfigureerd.',
    'Unable to send MQTT message, no topic specified.' => 'Kan MQTT-bericht niet verzenden, geen onderwerp opgegeven.',
    'Unable to send MQTT message, the payload is empty.' => 'Kan MQTT-bericht niet verzenden, de inhoud is leeg.',
    'MQTT publish failed: {reason}' => 'MQTT-publicatie mislukt: {reason}',
    'Successfully sent MQTT message to topic "{topic}".' => 'MQTT-bericht verzonden naar onderwerp "{topic}".',

    // Recipient warnings
    'Recipient "{name}" has no email address.' => 'Ontvanger "{name}" heeft geen e-mailadres.',
    'Recipient "{name}" has no phone number.' => 'Ontvanger "{name}" heeft geen telefoonnummer.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => 'Ontvanger "{name}" heeft geen gekoppelde gebruiker; kan aankondiging niet verzenden.',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => 'Ontvanger "{name}" heeft geen toegang tot het control panel; kan aankondiging niet verzenden.',
    'Pushover user-key field is not configured on this notification.' => 'Het Pushover-gebruikerssleutelveld is niet geconfigureerd op deze melding.',
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => 'Ontvanger "{name}" heeft geen gekoppelde gebruiker; kan Pushover-bericht niet verzenden.',
    '[SKIPPED] User "{name}" has no Pushover key.' => '[OVERGESLAGEN] Gebruiker "{name}" heeft geen Pushover-sleutel.',
    'Recipient "{name}" has no ntfy topic.' => 'Ontvanger "{name}" heeft geen ntfy-onderwerp.',
    'Recipient "{name}" has no Slack bot token.' => 'Ontvanger "{name}" heeft geen Slack-bot-token.',
    'Recipient "{name}" has no Slack channel ID.' => 'Ontvanger "{name}" heeft geen Slack-kanaal-ID.',
    'Recipient "{name}" has no Discord webhook URL.' => 'Ontvanger "{name}" heeft geen Discord-webhook-URL.',
    'Recipient "{name}" has no Bluesky credentials.' => 'Ontvanger "{name}" heeft geen Bluesky-referenties.',
    'Recipient "{name}" has no Mastodon credentials.' => 'Ontvanger "{name}" heeft geen Mastodon-referenties.',
    'Recipient "{name}" has no MQTT topic.' => 'Ontvanger "{name}" heeft geen MQTT-onderwerp.',

    // Errors & exceptions
    'Invalid element event: {class}' => 'Ongeldige elementgebeurtenis: {class}',
    'Invalid notification ID: {id}' => 'Ongeldig meldings-ID: {id}',
    'Invalid email message mode.' => 'Ongeldige e-mailberichtmodus.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Je hebt geen toestemming om het type Dynamische ontvangers te gebruiken.',
    'Dynamic recipients snippet did not call setRecipients.' => 'Fragment voor dynamische ontvangers heeft setRecipients niet aangeroepen.',
    'setRecipients was called with an empty value.' => 'setRecipients is aangeroepen met een lege waarde.',
    'Unrecognized recipient of type "{type}".' => 'Niet-herkende ontvanger van type "{type}".',
    'Unrecognized recipient "{value}".' => 'Niet-herkende ontvanger "{value}".',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => 'Geconfigureerde {kind} bestaat niet meer in de plug-ininstellingen (uid: {uid}).',
    'Invalid settings section: {section}' => 'Ongeldige instellingen-sectie: {section}',
    'User not authorized to save this notification.' => 'Gebruiker is niet bevoegd om deze melding op te slaan.',
    'User not authorized to view this notification.' => 'Gebruiker is niet bevoegd om deze melding te bekijken.',
    'User not authorized to delete this notification.' => 'Gebruiker is niet bevoegd om deze melding te verwijderen.',
    'Notification not found' => 'Melding niet gevonden',
    'Element not found' => 'Element niet gevonden',
    'You do not have permission to use the Dynamic Data type.' => 'Je hebt geen toestemming om het type Dynamische data te gebruiken.',
    'The Dynamic Data snippet did not call the {tag} tag.' => 'De Twig-snippet heeft de {tag}-tag niet aangeroepen.',

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
];
