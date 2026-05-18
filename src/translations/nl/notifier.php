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
    'Notifications'          => 'Meldingen',
    'Notification'           => 'Melding',
    'All notifications'      => 'Alle meldingen',
    'Notification Log'       => 'Meldingenlogboek',
    'Logs'                   => 'Logboeken',
    'View Notifications'     => 'Meldingen bekijken',
    'Add a New Notification' => 'Een nieuwe melding toevoegen',

    // Permissions
    'View notifications'              => 'Meldingen bekijken',
    'Save notifications'              => 'Meldingen opslaan',
    'Use the Dynamic Recipients type' => 'Het type Dynamische ontvangers gebruiken',
    'Test notifications'              => 'Meldingen testen',
    'Delete notifications'            => 'Meldingen verwijderen',
    'View notification log'           => 'Meldingenlogboek bekijken',
    'Delete notification log'         => 'Meldingenlogboek verwijderen',

    // Notification editor: tabs
    'Meta'       => 'Meta',
    'Event'      => 'Gebeurtenis',
    'Message'    => 'Bericht',
    'Recipients' => 'Ontvangers',

    // Event tab: type selector
    'Event Type'                                           => 'Gebeurtenistype',
    'What type of event will activate the notification?'   => 'Welk type gebeurtenis activeert de melding?',
    'Which specific event will activate the notification?' => 'Welke specifieke gebeurtenis activeert de melding?',

    // Event tab: event types
    'Assets Event'                   => 'Asset-gebeurtenis',
    'Commerce Orders Event'          => 'Commerce-bestellingsgebeurtenis',
    'Commerce Products Event'        => 'Commerce-productgebeurtenis',
    'Digital Products Event'         => 'Digital Products-gebeurtenis',
    'Digital Product Licenses Event' => 'Digital Products-licentiegebeurtenis',
    'Solspace Calendar Event'        => 'Solspace Calendar-gebeurtenis',
    'Entries Event'                  => 'Invoer-gebeurtenis',
    'Users Event'                    => 'Gebruiker-gebeurtenis',
    'Ungrouped Users'                => 'Gebruikers zonder groep',

    // Field and element conditions
    'Field Conditions'             => 'Veldvoorwaarden',
    'Send the message only when the saved element matches the following conditions.' => 'Verzend het bericht alleen wanneer het opgeslagen element aan de volgende voorwaarden voldoet.',
    'has changed'                  => 'is gewijzigd',
    '#{elementType} Event Filters' => 'Gebeurtenisfilters voor #{elementType}',
    'No filters match this event.' => 'Geen filters komen overeen met deze gebeurtenis.',
    'Determine whether each message should be sent based on specified conditions.' => 'Bepaal op basis van opgegeven voorwaarden of elk bericht verzonden moet worden.',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => 'Het element wordt voor het eerst opgeslagen',
    'Must be a new entry'                       => 'Moet een nieuwe invoer zijn',
    'Must be an existing entry'                 => 'Moet een bestaande invoer zijn',
    'Can be existing or new'                    => 'Kan bestaand of nieuw zijn',

    // Filters: new elements
    'Element is new'         => 'Het element is nieuw',
    'New elements only'      => 'Alleen nieuwe elementen',
    'Existing elements only' => 'Alleen bestaande elementen',

    // Filters: enabled state
    'Element is enabled'         => 'Het element is ingeschakeld',
    'Must be enabled'            => 'Moet ingeschakeld zijn',
    'Must be disabled'           => 'Moet uitgeschakeld zijn',
    'Can be enabled or disabled' => 'Kan ingeschakeld of uitgeschakeld zijn',

    // Filters: drafts
    'Element is a draft'          => 'Het element is een concept',
    'Must be a draft'             => 'Moet een concept zijn',
    'Must not be a draft'         => 'Mag geen concept zijn',
    'Can be a draft or non-draft' => 'Kan een concept of geen concept zijn',

    // Filters: provisional drafts
    'Element is a provisional draft'                => 'Het element is een voorlopig concept',
    'Must be a provisional draft'                   => 'Moet een voorlopig concept zijn',
    'Must not be a provisional draft'               => 'Mag geen voorlopig concept zijn',
    'Can be a provisional draft or non-provisional' => 'Kan een voorlopig of niet-voorlopig concept zijn',

    // Filters: revisions
    'Element is a revision'             => 'Het element is een revisie',
    'Must be a revision'                => 'Moet een revisie zijn',
    'Must not be a revision'            => 'Mag geen revisie zijn',
    'Can be a revision or non-revision' => 'Kan een revisie of geen revisie zijn',

    // Filters: duplication
    'Element is being duplicated'         => 'Het element wordt gedupliceerd',
    'Must be duplicating the element'     => 'Moet het element dupliceren',
    'Must not be duplicating the element' => 'Mag het element niet dupliceren',

    // Filters: propagation
    'Element is being propagated'     => 'Het element wordt verspreid',
    'Element must be propagating'     => 'Het element moet aan het verspreiden zijn',
    'Element must not be propagating' => 'Het element mag niet aan het verspreiden zijn',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => 'Het element wordt in bulk opnieuw opgeslagen',
    'Must be bulk-resaving the element'     => 'Moet het element in bulk opnieuw opslaan',
    'Must not be bulk-resaving the element' => 'Mag het element niet in bulk opnieuw opslaan',

    // Filters: common output
    'Unnamed filter'                => 'Naamloos filter',
    'Must be TRUE to send message'  => 'Moet TRUE zijn om het bericht te verzenden',
    'Must be FALSE to send message' => 'Moet FALSE zijn om het bericht te verzenden',
    'No effect'                     => 'Geen effect',

    // Message tab: type selector and queue
    'Message Type'                       => 'Berichttype',
    'What type of message will be sent?' => 'Welk type bericht wordt verzonden?',
    'Send Message via Queue'             => 'Bericht via wachtrij verzenden',
    'Should the message be sent via the [jobs queue]({queueUrl})?' => 'Moet het bericht via de [taakwachtrij]({queueUrl}) worden verzonden?',
    'Send immediately' => 'Direct verzenden',
    'Add to queue' => 'Aan wachtrij toevoegen',

    // Message tab: Email fields
    "User's Email Address Field" => 'Gebruikersveld voor e-mailadres',
    'Email Subject'              => 'E-mailonderwerp',
    'Email Body'                 => 'E-mailtekst',

    // Message tab: SMS fields
    "User's Phone Number Field" => 'Gebruikersveld voor telefoonnummer',
    'SMS Message Body'          => 'SMS-berichttekst',

    // Message tab: Announcement fields
    'Announcement Title'   => 'Aankondigingstitel',
    'Announcement Message' => 'Aankondigingsbericht',

    // Message tab: Flash fields
    'Flash Message Type'                         => 'Flash-berichttype',
    'Flash Message Title'                        => 'Flash-berichttitel',
    'Flash Message Details'                      => 'Flash-berichtdetails',
    'Which type of flash message should appear?' => 'Welk type flash-bericht moet verschijnen?',

    // Message tab: Pushover fields
    "Field containing each user's Pushover key" => 'Pushover-sleutelveld van gebruiker',
    'The Pushover application token is configured in [Settings → Pushover](url).' => 'Het Pushover-applicatietoken wordt geconfigureerd in [Instellingen → Pushover](url).',

    // Message tab: ntfy fields
    'Priority'           => 'Prioriteit',
    'Tags'               => 'Tags',
    'Click URL'          => 'Klik-URL',
    'Render as Markdown' => 'Renderen als Markdown',

    // Message tab: Slack fields
    'Slack Message Body' => 'Slack-berichttekst',

    // Message tab: Bluesky fields
    'Post Body' => 'Berichttekst',
    'Generate Link Preview' => 'Linkvoorbeeld genereren',
    "When the post body contains a URL, automatically generate a preview card with the linked page's image, title, and description." => 'Wanneer de berichttekst een URL bevat, wordt een voorbeeldkaart toegevoegd met de titel, beschrijving en afbeelding van de gekoppelde pagina.',
    'No card' => 'Geen kaart',
    'Generate preview card' => 'Voorbeeldkaart genereren',

    // Message tab: Title / Body / Trix toolbar
    'Title'         => 'Titel',
    'Body'          => 'Tekst',
    'Rich Text'     => 'Opgemaakte tekst',
    'Bold'          => 'Vet',
    'Italic'        => 'Cursief',
    'Underline'     => 'Onderstreept',
    'Strikethrough' => 'Doorgestreept',
    'Bullets'       => 'Opsommingstekens',
    'Numbers'       => 'Nummering',
    'Heading'       => 'Kop',
    'Code'          => 'Code',
    'Undo'          => 'Ongedaan maken',
    'Redo'          => 'Opnieuw',
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => 'Tekst van de uitgaande e-mail. Je kunt <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">speciale variabelen</a> gebruiken, of zelfs <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">ontvangers overslaan</a>.',

    // Recipients tab: common
    'Recipients Type'                             => 'Type ontvangers',
    'Who will receive this message?'              => 'Wie ontvangt dit bericht?',
    'Add a message recipient'                     => 'Een ontvanger toevoegen',
    'Select User(s)'                              => 'Gebruiker(s) selecteren',
    'Which users will receive the message?'       => 'Welke gebruikers ontvangen het bericht?',
    'Which user groups will receive the message?' => 'Welke gebruikersgroepen ontvangen het bericht?',
    'Twig Snippet to Determine Recipients'        => 'Twig-fragment om ontvangers te bepalen',

    // Recipients tab: per-provider pickers
    'Select Slack channel(s)'                           => 'Slack-kana(a)l(en) selecteren',
    'Which Slack channels should receive this message?' => 'Welke Slack-kanalen ontvangen dit bericht?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Geen Slack-kanalen geconfigureerd. Voeg er een toe in [Instellingen → Slack]({url}).',
    'Select ntfy topic(s)'                              => 'ntfy-onderwerp(en) selecteren',
    'Which ntfy topics should receive this message?'    => 'Welke ntfy-onderwerpen ontvangen dit bericht?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'Geen ntfy-onderwerpen geconfigureerd. Voeg er een toe in [Instellingen → ntfy]({url}).',
    'Select Bluesky account(s)'                         => 'Bluesky-account(s) selecteren',
    'Which Bluesky accounts should post this message?'  => 'Welke Bluesky-accounts moeten dit bericht plaatsen?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Geen Bluesky-accounts geconfigureerd. Voeg er een toe in [Instellingen → Bluesky]({url}).',

    // Settings: page chrome
    'Notifier Settings' => 'Notifier-instellingen',
    'General'           => 'Algemeen',
    'Twilio'            => 'Twilio',
    'Pushover'          => 'Pushover',
    'Slack'             => 'Slack',
    'Bluesky'           => 'Bluesky',
    'ntfy'              => 'ntfy',

    // Settings: Logging
    'Logging'                             => 'Logboek',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier houdt een doorlopend logboek bij van verzonden berichten. Meestal niet nodig, maar je kunt het aantal in de database opgenomen logboekgebeurtenissen beperken.',
    'Enable Logging'                      => 'Logboek inschakelen',
    'When disabled, Notifier will not write anything to the notification log.' => 'Indien uitgeschakeld, schrijft Notifier niets naar het meldingenlogboek.',
    'Number of days to retain log events' => 'Aantal dagen om logboekgebeurtenissen te bewaren',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Bewaar logboekgebeurtenissen maximaal dit aantal dagen. Laat leeg voor geen limiet.',
    'Number of log events to retain'      => 'Aantal logboekgebeurtenissen om te bewaren',
    'At most, keep this many log events. Leave blank for no limit.' => 'Bewaar maximaal dit aantal logboekgebeurtenissen. Laat leeg voor geen limiet.',

    // Settings: Twilio
    'Twilio API Credentials'                       => 'Twilio API-referenties',
    'If using the Twilio API to send SMS messages, the following credentials are required.' => 'Bij gebruik van de Twilio API voor het versturen van SMS-berichten zijn de volgende referenties vereist.',
    'Twilio Account SID'                           => 'Twilio Account SID',
    'Twilio Auth Token'                            => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)' => 'Twilio-telefoonnummer (verzendt elk SMS-bericht)',
    'SMS Testing'                                  => 'SMS-tests',
    'Optional. When set, every SMS dispatched will be sent to this number instead of the resolved recipient.' => 'Optioneel. Indien ingesteld, wordt elk verzonden SMS naar dit nummer gestuurd in plaats van naar de daadwerkelijke ontvanger.',
    'Test phone number'                            => 'Testtelefoonnummer',

    // Settings: Pushover
    "[Pushover](https://pushover.net) sends push notifications to a registered user's devices. Each Craft user needs a custom field on their profile storing their Pushover user key; you select which field on each Notification's Message tab. For full setup instructions, see the [Pushover getting-started docs](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover)." => '[Pushover](https://pushover.net) verzendt pushmeldingen naar de apparaten van een geregistreerde gebruiker. Elke Craft-gebruiker heeft een aangepast veld op zijn profiel nodig dat de Pushover-sleutel opslaat; je selecteert welk veld op het tabblad Bericht van elke melding. Voor volledige installatie-instructies, zie de [Pushover-startersgids](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover).',
    'Application API Token'                                      => 'Applicatie-API-token',
    'The 30-character app token from your Pushover application.' => 'Het 30-tekens app-token van je Pushover-applicatie.',

    // Settings: ntfy
    'ntfy.sh is a free HTTP-based push notification service. Subscribers receive messages on the ntfy app, web, or any compatible client by joining a topic.' => 'ntfy.sh is een gratis HTTP-gebaseerde pushmeldingenservice. Abonnees ontvangen berichten in de ntfy-app, op het web of via een compatibele client door zich aan te melden bij een onderwerp.',
    'Server URL'   => 'Server-URL',
    'Defaults to https://ntfy.sh. Point at a self-hosted ntfy instance if applicable.' => 'Standaard https://ntfy.sh. Wijs naar een zelf-gehoste ntfy-instantie indien van toepassing.',
    'Access token' => 'Toegangstoken',
    'Optional. Required for protected topics or self-hosted instances with auth.' => 'Optioneel. Vereist voor beschermde onderwerpen of zelf-gehoste instanties met authenticatie.',
    'ntfy Topics'  => 'ntfy-onderwerpen',
    'Named list of ntfy topics. Each topic becomes selectable on the notification edit screen.' => 'Benoemde lijst met ntfy-onderwerpen. Elk onderwerp wordt selecteerbaar op het bewerkingsscherm van de melding.',
    'Topics'       => 'Onderwerpen',
    'Add one row per topic name. Use the **Test** button to send a quick test message to the topic.' => 'Voeg één rij per onderwerpnaam toe. Gebruik de knop **Test** om een snel testbericht naar het onderwerp te sturen.',
    'Topic'        => 'Onderwerp',
    'Add a topic'  => 'Een onderwerp toevoegen',
    'Save first to persist a row, then click its **Test** button to fire a sanity check against ntfy.' => 'Sla eerst op om een rij te bewaren en klik vervolgens op de **Test**-knop om een snelle controle tegen ntfy uit te voeren.',

    // Settings: Slack
    'Slack Channels' => 'Slack-kanalen',
    'Channels'       => 'Kanalen',
    'Each Slack channel needs its own Incoming Webhook URL. Use the **Test** button to fire a quick sanity check after saving.' => 'Elk Slack-kanaal heeft een eigen Incoming Webhook-URL nodig. Gebruik de knop **Test** voor een snelle controle na opslaan.',
    'Webhook URL'    => 'Webhook-URL',
    'Add a channel'  => 'Een kanaal toevoegen',
    'Save first to persist a row, then click its **Test** button to fire a sanity check against Slack.' => 'Sla eerst op om een rij te bewaren en klik vervolgens op de **Test**-knop om een snelle controle tegen Slack uit te voeren.',

    // Settings: Bluesky
    "[Bluesky](https://bsky.app) posts publish to the configured account's feed via the ATProto API. App passwords are generated at [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). An app password is a secret, so store it in a `.env` variable and reference that variable (e.g. `\$BLUESKY_APP_PASSWORD`) rather than pasting the password directly." => '[Bluesky](https://bsky.app)-berichten worden via de ATProto-API gepubliceerd op de feed van het geconfigureerde account. App-wachtwoorden worden gegenereerd op [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). Een app-wachtwoord is een geheim, dus sla het op in een `.env`-variabele en verwijs naar die variabele (bijv. `$BLUESKY_APP_PASSWORD`) in plaats van het wachtwoord rechtstreeks te plakken.',
    'PDS URL'          => 'PDS-URL',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'Standaard https://bsky.social. Wijs naar een aangepaste PDS als je installatie federeert.',
    'Bluesky Accounts' => 'Bluesky-accounts',
    'Named list of Bluesky accounts. Each account becomes selectable on the notification edit screen.' => 'Benoemde lijst met Bluesky-accounts. Elk account wordt selecteerbaar op het bewerkingsscherm van de melding.',
    'Accounts'         => 'Accounts',
    'Add one row per Bluesky account. Use **Test** to verify the credentials authenticate.' => 'Voeg één rij per Bluesky-account toe. Gebruik **Test** om te controleren of de inloggegevens authenticeren.',
    'Label'            => 'Label',
    'Handle'           => 'Handle',
    'App password'     => 'App-wachtwoord',
    'Add an account'   => 'Een account toevoegen',
    'Save first to persist a row, then click its **Test** button to verify the credentials authenticate.' => 'Sla eerst op om een rij te bewaren en klik vervolgens op de **Test**-knop om te controleren of de inloggegevens authenticeren.',

    // Test notification (UI)
    'Send a test message'           => 'Een testbericht verzenden',
    'Are you certain you want to send a test notification?\\n\\nThe configured message will be sent to the configured recipient(s).' => 'Weet je zeker dat je een testmelding wilt verzenden?\\n\\nHet geconfigureerde bericht wordt verzonden naar de geconfigureerde ontvangers.',
    'Test'                          => 'Testen',
    'Test notification dispatched.' => 'Testmelding verzonden.',
    'No messages were dispatched. Check the recipient configuration.' => 'Er zijn geen berichten verzonden. Controleer de ontvangersconfiguratie.',

    // Settings: save / test action responses
    "Couldn't save settings."                 => 'Kon de instellingen niet opslaan.',
    'Settings saved.'                         => 'Instellingen opgeslagen.',
    'Topic is empty.'                         => 'Onderwerp is leeg.',
    'Server URL is not configured.'           => 'Server-URL is niet geconfigureerd.',
    'Test message from Notifier.'             => 'Testbericht van Notifier.',
    'HTTP {status}'                           => 'HTTP {status}',
    'Test message sent successfully.'         => 'Testbericht succesvol verzonden.',
    'HTTP {status}: {body}'                   => 'HTTP {status}: {body}',
    'Handle and app password are required.'   => 'Handle en app-wachtwoord zijn vereist.',
    'Authentication failed.'                  => 'Authenticatie mislukt.',
    'Successfully authenticated. No messages were posted.' => 'Verificatie geslaagd. Er zijn geen berichten geplaatst.',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.'          => '{messageType} verzenden naar {recipient}.',
    'Adding message to queue.'                       => 'Bericht aan wachtrij toevoegen.',
    'Sending message immediately (bypassing queue).' => 'Bericht direct verzenden (wachtrij overslaan).',
    'Log events deleted.'                            => 'Logboekgebeurtenissen verwijderd.',
    'notification'                                   => 'melding',

    // Outbound: Email log messages
    'Unable to send email, no recipient specified.'     => 'Kan e-mail niet verzenden: geen ontvanger opgegeven.',
    'Unable to send email, the message body was empty.' => 'Kan e-mail niet verzenden: de berichttekst was leeg.',
    "Unable to send the email using Craft's native email handling." => 'Kan de e-mail niet verzenden met de native e-mailafhandeling van Craft.',
    'Check your general email settings within Craft.'   => 'Controleer je algemene e-mailinstellingen in Craft.',
    'Successfully sent email message!'                  => 'E-mailbericht succesvol verzonden!',

    // Outbound: SMS log messages
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[Ongeldige Twilio-referenties.]({url}) {missing} ontbreekt.',
    'Unable to send SMS, no Twilio phone number exists.'      => 'Kan SMS niet verzenden: er is geen Twilio-telefoonnummer.',
    'Unable to send SMS, no recipient phone number exists.'   => 'Kan SMS niet verzenden: er is geen telefoonnummer van de ontvanger.',
    'Unable to send SMS, recipient phone number is invalid.'  => 'Kan SMS niet verzenden: telefoonnummer van de ontvanger is ongeldig.',
    'Successfully sent SMS message!'                          => 'SMS-bericht succesvol verzonden!',

    // Outbound: Announcement log messages
    'Unable to post announcement, no recipient userId specified.' => 'Kan aankondiging niet plaatsen: geen ontvanger-userId opgegeven.',
    'Successfully posted announcement!' => 'Aankondiging succesvol geplaatst!',

    // Outbound: Flash log messages
    'Unable to send the flash message, invalid flash type.' => 'Kan flash-bericht niet verzenden: ongeldig flash-type.',
    'Successfully sent flash message!'                      => 'Flash-bericht succesvol verzonden!',

    // Outbound: Pushover log messages
    '[Invalid Pushover credentials.]({url}) Missing app token.'  => '[Ongeldige Pushover-referenties.]({url}) App-token ontbreekt.',
    'Unable to send Pushover message, no user key on recipient.' => 'Kan Pushover-bericht niet verzenden: geen gebruikerssleutel bij de ontvanger.',
    'Pushover POST failed: {reason}'                             => 'Pushover POST mislukt: {reason}',
    'Successfully sent Pushover message!'                        => 'Pushover-bericht succesvol verzonden!',

    // Outbound: ntfy log messages
    'Unable to send ntfy message, no server URL configured.' => 'Kan ntfy-bericht niet verzenden: geen server-URL geconfigureerd.',
    'Unable to send ntfy message, no topic specified.'       => 'Kan ntfy-bericht niet verzenden: geen onderwerp opgegeven.',
    'ntfy POST failed with HTTP {status}: {reason}'          => 'ntfy POST mislukt met HTTP {status}: {reason}',
    'ntfy POST failed: {reason}'                             => 'ntfy POST mislukt: {reason}',
    'Successfully sent ntfy message to topic "{topic}".'     => 'ntfy-bericht succesvol verzonden naar onderwerp "{topic}".',

    // Outbound: Slack log messages
    'Unable to send Slack message, no webhook URL.' => 'Kan Slack-bericht niet verzenden: geen webhook-URL.',
    'Unable to send Slack message, webhook URL is not valid.' => 'Kan Slack-bericht niet verzenden: webhook-URL is niet geldig.',
    'Unable to send Slack message, body is empty.'  => 'Kan Slack-bericht niet verzenden: tekst is leeg.',
    'Slack POST failed (HTTP {status}): {reason}'   => 'Slack POST mislukt (HTTP {status}): {reason}',
    'Slack POST failed: {reason}'                   => 'Slack POST mislukt: {reason}',
    'Successfully sent Slack message to "{label}".' => 'Slack-bericht succesvol verzonden naar "{label}".',

    // Outbound: Bluesky log messages
    'Unable to send Bluesky post, recipient is missing credentials.' => 'Kan Bluesky-bericht niet verzenden: ontvanger mist referenties.',
    'Body exceeded {max} characters, truncated.'          => 'Tekst overschreed {max} tekens en werd afgekapt.',
    'Successfully posted to Bluesky as "{label}".'        => 'Succesvol op Bluesky geplaatst als "{label}".',
    'Bluesky auth failed for {handle}: {reason}'          => 'Bluesky-authenticatie mislukt voor {handle}: {reason}',
    'Bluesky auth failed: {reason}'                       => 'Bluesky-authenticatie mislukt: {reason}',
    'Bluesky post failed: {reason}'                       => 'Bluesky-bericht mislukt: {reason}',
    'Bluesky link preview skipped: {reason}'              => 'Bluesky-linkvoorbeeld overgeslagen: {reason}',

    // Recipient-strategy warnings
    'Recipient "{name}" has no email address.'       => 'Ontvanger "{name}" heeft geen e-mailadres.',
    'Recipient "{name}" has no phone number.'        => 'Ontvanger "{name}" heeft geen telefoonnummer.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => 'Ontvanger "{name}" heeft geen gekoppelde gebruiker; kan aankondiging niet verzenden.',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => 'Ontvanger "{name}" heeft geen toegang tot het control panel; kan aankondiging niet verzenden.',
    'Pushover user-key field is not configured on this notification.' => 'Het Pushover-gebruikerssleutelveld is niet geconfigureerd op deze melding.',
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => 'Ontvanger "{name}" heeft geen gekoppelde gebruiker; kan Pushover-bericht niet verzenden.',
    '[SKIPPED] User "{name}" has no Pushover key.'   => '[OVERGESLAGEN] Gebruiker "{name}" heeft geen Pushover-sleutel.',
    'Recipient "{name}" has no ntfy topic.'          => 'Ontvanger "{name}" heeft geen ntfy-onderwerp.',
    'Recipient "{name}" has no Slack webhook URL.'   => 'Ontvanger "{name}" heeft geen Slack-webhook-URL.',
    'Recipient "{name}" has no Bluesky credentials.' => 'Ontvanger "{name}" heeft geen Bluesky-referenties.',

    // Errors / exceptions
    'Invalid element event: {class}'                         => 'Ongeldige elementgebeurtenis: {class}',
    'Invalid notification ID: {id}'                          => 'Ongeldig meldings-ID: {id}',
    'Invalid email message mode.'                            => 'Ongeldige e-mailberichtmodus.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Je hebt geen toestemming om het type Dynamische ontvangers te gebruiken.',
    'Dynamic recipients snippet did not call setRecipients.' => 'Fragment voor dynamische ontvangers heeft setRecipients niet aangeroepen.',
    'setRecipients was called with an empty value.'          => 'setRecipients is aangeroepen met een lege waarde.',
    'Unrecognized recipient of type "{type}".'               => 'Niet-herkende ontvanger van type "{type}".',
    'Unrecognized recipient "{value}".'                      => 'Niet-herkende ontvanger "{value}".',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => 'Geconfigureerde {kind} bestaat niet meer in de plug-ininstellingen (uid: {uid}).',
    'Invalid settings section: {section}'                    => 'Ongeldige instellingen-sectie: {section}',
    'User not authorized to save this notification.'         => 'Gebruiker is niet bevoegd om deze melding op te slaan.',
    'User not authorized to view this notification.'         => 'Gebruiker is niet bevoegd om deze melding te bekijken.',
    'User not authorized to delete this notification.'       => 'Gebruiker is niet bevoegd om deze melding te verwijderen.',
    'Notification not found'                                 => 'Melding niet gevonden',

    // Misc config-file note
    'This is being set in the config file. [{file}]' => 'Dit wordt ingesteld in het configuratiebestand. [{file}]',

    // Slack, ntfy, and Bluesky message types
    "Add the Bluesky accounts you'd like to post from. Each account becomes available as a recipient on the **Recipients** tab when configuring a notification." => 'Voeg de Bluesky-accounts toe waarvandaan je wilt posten. Elk account wordt beschikbaar als ontvanger op het tabblad **Ontvangers** bij het configureren van een melding.',
    "Click any row's **Test** button to confirm the account authenticates." => 'Klik op de knop **Test** van een rij om te bevestigen dat het account authenticeert.',
    "Add an [Incoming Webhook](https://api.slack.com/messaging/webhooks) for each Slack channel you'd like to post into. Each webhook becomes available as a recipient on the **Recipients** tab when configuring a notification. A webhook URL is a secret, so store it in a `.env` variable and reference that variable (e.g. `\$SLACK_WEBHOOK_URL`) rather than pasting the URL directly." => 'Voeg een [Incoming Webhook](https://api.slack.com/messaging/webhooks) toe voor elk Slack-kanaal waarin je wilt posten. Elke webhook wordt beschikbaar als ontvanger op het tabblad **Ontvangers** bij het configureren van een melding. Een webhook-URL is een geheim, dus sla deze op in een `.env`-variabele en verwijs naar die variabele (bijv. `$SLACK_WEBHOOK_URL`) in plaats van de URL rechtstreeks te plakken.',
    "Click any row's **Test** button to send a quick test message to that channel." => 'Klik op de knop **Test** van een rij om een snel testbericht naar dat kanaal te sturen.',
    "Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`." => 'Optioneel. Wijs naar een zelf-gehoste ntfy-instantie indien van toepassing. Standaard `https://ntfy.sh`.',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Optioneel. Vereist voor beschermde onderwerpen of zelf-gehoste instanties met authenticatie.',
    "Add the ntfy topics you'd like to send messages to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification." => 'Voeg de ntfy-onderwerpen toe waarnaar je berichten wilt sturen. Elk onderwerp wordt beschikbaar als ontvanger op het tabblad **Ontvangers** bij het configureren van een melding.',
    "Click any row's **Test** button to send a quick test message to that topic." => 'Klik op de knop **Test** van een rij om een snel testbericht naar dat onderwerp te sturen.',
    'Enable Markdown' => 'Markdown inschakelen',
    'Link URL' => 'Link-URL',
    'Not a valid Webhook URL. Must start with https://hooks.slack.com/services/' => 'Geen geldige webhook-URL. Moet beginnen met https://hooks.slack.com/services/',

    // Manual triggers
    'Send Notification'                                            => 'Notificatie verzenden',
    'Send manual notifications'                                    => 'Handmatige notificaties verzenden',
    'Are you sure you want to send this notification?'             => 'Weet je zeker dat je deze notificatie wilt verzenden?',
    'This notification cannot be triggered manually.'              => 'Deze notificatie kan niet handmatig worden geactiveerd.',
    'This notification no longer applies to the selected element.' => 'Deze notificatie is niet langer van toepassing op het geselecteerde element.',
    'Notification sent.'                                           => 'Notificatie verzonden.',
    'Element not found'                                            => 'Element niet gevonden',
    'Manual Trigger Label'                                         => 'Label voor handmatige trigger',
    'An element action label (helps to differentiate multiple manual triggers).' => 'Een label voor de elementactie (helpt meerdere handmatige triggers te onderscheiden).',
];
