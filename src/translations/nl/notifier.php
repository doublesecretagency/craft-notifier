<?php
/**
 * Notifier plugin for Craft CMS
 *
 * First-class Notifications for Craft CMS
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

    // Feed
    'Feed URL' => 'Feed-URL',
    'The URL of the RSS, Atom, or JSON feed to watch.' => 'De URL van de te bewaken RSS-, Atom- of JSON-feed.',
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
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are also supported.' => '[Templating]({templatingUrl}) en [speciale variabelen]({variablesUrl}) worden ook ondersteund.',
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

    // Message tab: ntfy fields
    'Priority'           => 'Prioriteit',
    'Tags'               => 'Tags',

    // Message tab: Slack fields
    'Slack Message Body' => 'Slack-berichttekst',
    'Bot Icon URL' => 'Pictogram-URL',

    // Message tab: Bluesky fields
    'Post Body' => 'Berichttekst',
    'Generate Link Preview' => 'Linkvoorbeeld genereren',
    'No card' => 'Geen kaart',
    'Generate preview card' => 'Voorbeeldkaart genereren',

    // Message tab: Title / Body / Trix toolbar
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
    'Access token' => 'Toegangstoken',
    'ntfy Topics'  => 'ntfy-onderwerpen',
    'Topics'       => 'Onderwerpen',
    'Topic'        => 'Onderwerp',
    'Add a topic'  => 'Een onderwerp toevoegen',

    // Settings: Slack
    'Slack Channels' => 'Slack-kanalen',
    'Create a [Slack app](https://api.slack.com/apps) with the `chat:write`, `chat:write.customize`, and `chat:write.public` scopes, then add a row for each channel you\'d like to post into. Each channel becomes available as a recipient on the **Recipients** tab when configuring a notification. A bot token is a secret, so store it in a `.env` variable and reference that variable (e.g. `$SLACK_BOT_TOKEN`) rather than pasting the token directly.' => 'Maak een [Slack-app](https://api.slack.com/apps) met de scopes `chat:write`, `chat:write.customize` en `chat:write.public`, en voeg vervolgens een rij toe voor elk kanaal waarin je wilt posten. Elk kanaal wordt beschikbaar als ontvanger op het tabblad **Ontvangers** bij het configureren van een notificatie. Een bot-token is een geheim, dus sla het op in een `.env`-variabele en verwijs naar die variabele (bijv. `$SLACK_BOT_TOKEN`) in plaats van het token direct te plakken.',
    'Channels'       => 'Kanalen',
    'Add a channel'  => 'Een kanaal toevoegen',
    'Bot Token' => 'Bot-token',
    'Channel ID' => 'Kanaal-ID',
    'Bot Emoji' => 'Pictogram-emoji',
    'Bot Name' => 'Gebruikersnaam',
    'Whether Slack should unfurl link previews for URLs in the message body.' => "Of Slack linkvoorbeelden moet weergeven voor URL's in het berichtinhoud.",
    'Not a valid Bot Token. Must start with `xoxb-`.' => 'Geen geldig Bot-token. Moet beginnen met `xoxb-`.',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => 'Geen geldig kanaal-ID. Moet eruitzien als `C01234ABCD`.',
    'Unable to send Slack message, no bot token.' => 'Kan Slack-bericht niet verzenden: geen bot-token.',
    'Unable to send Slack message, no channel ID.' => 'Kan Slack-bericht niet verzenden: geen kanaal-ID.',
    'Recipient "{name}" has no Slack bot token.' => 'Ontvanger "{name}" heeft geen Slack-bot-token.',
    'Recipient "{name}" has no Slack channel ID.' => 'Ontvanger "{name}" heeft geen Slack-kanaal-ID.',
    'Slack rejected the message: {error}' => 'Slack heeft het bericht geweigerd: {error}',

    // Settings: Bluesky
    "[Bluesky](https://bsky.app) posts publish to the configured account's feed via the ATProto API. App passwords are generated at [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). An app password is a secret, so store it in a `.env` variable and reference that variable (e.g. `\$BLUESKY_APP_PASSWORD`) rather than pasting the password directly." => '[Bluesky](https://bsky.app)-berichten worden via de ATProto-API gepubliceerd op de feed van het geconfigureerde account. App-wachtwoorden worden gegenereerd op [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). Een app-wachtwoord is een geheim, dus sla het op in een `.env`-variabele en verwijs naar die variabele (bijv. `$BLUESKY_APP_PASSWORD`) in plaats van het wachtwoord rechtstreeks te plakken.',
    'PDS URL'          => 'PDS-URL',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'Standaard https://bsky.social. Wijs naar een aangepaste PDS als je installatie federeert.',
    'Bluesky Accounts' => 'Bluesky-accounts',
    'Accounts'         => 'Accounts',
    'Label'            => 'Label',
    'Handle'           => 'Handle',
    'App password'     => 'App-wachtwoord',
    'Add an account'   => 'Een account toevoegen',

    // Test notification (UI)
    'Send a test message'           => 'Een testbericht verzenden',
    'Send a REAL test notification?\\n\\n⚠️ Uses a random sample of real data.\\n⚠️ Sends a real message via the configured channel.\\n⚠️ Delivers to the real configured recipient(s).' => 'Een ECHTE testmelding verzenden?\\n\\n⚠️ Gebruikt een willekeurige steekproef van echte gegevens.\\n⚠️ Verzendt een echt bericht via het geconfigureerde kanaal.\\n⚠️ Wordt afgeleverd aan de echte geconfigureerde ontvangers.',
    'Test'                          => 'Testen',
    'Test notification dispatched.' => 'Testmelding verzonden.',
    'No messages were dispatched. Check the recipient configuration.' => 'Er zijn geen berichten verzonden. Controleer de ontvangersconfiguratie.',
    'Unable to send test: the feed could not be read or has no items.' => 'Kan test niet verzenden: de feed kon niet worden gelezen of bevat geen items.',
    'Unable to send test: no element matches the configured filters.' => 'Kan test niet verzenden: geen element komt overeen met de geconfigureerde filters.',

    // Settings: save / test action responses
    "Couldn't save settings."                 => 'Kon de instellingen niet opslaan.',
    'Settings saved.'                         => 'Instellingen opgeslagen.',
    'Topic is empty.'                         => 'Onderwerp is leeg.',
    'Server URL is not configured.'           => 'Server-URL is niet geconfigureerd.',
    'Test message from Notifier.'             => 'Testbericht van Notifier.',
    'HTTP {status}'                           => 'HTTP {status}',
    'Test message sent successfully.'         => 'Testbericht succesvol verzonden.',
    'Handle and app password are required.'   => 'Handle en app-wachtwoord zijn vereist.',
    'Authentication failed.'                  => 'Authenticatie mislukt.',
    'Successfully authenticated. No messages were posted.' => 'Verificatie geslaagd. Er zijn geen berichten geplaatst.',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.'          => '{messageType} verzenden naar {recipient}.',
    'Adding message to queue.'                       => 'Bericht aan wachtrij toevoegen.',
    'Unable to parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => 'Kan de feed niet verwerken. De PHP-extensies `simplexml` en `libxml` zijn vereist.',
    'Unable to parse the feed.' => 'Kan de feed niet verwerken.',
    'Unable to fetch the feed: {message}' => 'Kan de feed niet ophalen: {message}',
    'Initial feed scan failed: {message}' => 'Eerste feed-scan mislukt: {message}',
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
    'Unable to send ntfy message, no topic specified.'       => 'Kan ntfy-bericht niet verzenden: geen onderwerp opgegeven.',
    'ntfy POST failed with HTTP {status}: {reason}'          => 'ntfy POST mislukt met HTTP {status}: {reason}',
    'ntfy POST failed: {reason}'                             => 'ntfy POST mislukt: {reason}',
    'Successfully sent ntfy message to topic "{topic}".'     => 'ntfy-bericht succesvol verzonden naar onderwerp "{topic}".',

    // Outbound: Slack log messages
    'Unable to send Slack message, body is empty.'  => 'Kan Slack-bericht niet verzenden: tekst is leeg.',
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
    "Click any row's **Test** button to confirm the account authenticates." => 'Klik op de knop **Testen** van een rij om te bevestigen dat het account authenticeert.',
    "Click any row's **Test** button to send a quick test message to that channel." => 'Klik op de knop **Testen** van een rij om een snel testbericht naar dat kanaal te sturen.',
    "Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`." => 'Optioneel. Wijs naar een zelf-gehoste ntfy-instantie indien van toepassing. Standaard `https://ntfy.sh`.',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Optioneel. Vereist voor beschermde onderwerpen of zelf-gehoste instanties met authenticatie.',
    "Add the ntfy topics you'd like to send messages to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification." => 'Voeg de ntfy-onderwerpen toe waarnaar je berichten wilt sturen. Elk onderwerp wordt beschikbaar als ontvanger op het tabblad **Ontvangers** bij het configureren van een melding.',
    "Click any row's **Test** button to send a quick test message to that topic." => 'Klik op de knop **Testen** van een rij om een snel testbericht naar dat onderwerp te sturen.',
    'Enable Markdown' => 'Markdown inschakelen',

    // Manual triggers
    'Send Notification'                                            => 'Notificatie verzenden',
    'Send manual notifications'                                    => 'Handmatige notificaties verzenden',
    'Are you sure you want to send this notification?'             => 'Weet je zeker dat je deze notificatie wilt verzenden?',
    'This notification cannot be triggered manually.'              => 'Deze notificatie kan niet handmatig worden geactiveerd.',
    'This notification no longer applies to the selected element.' => 'Deze notificatie is niet langer van toepassing op het geselecteerde element.',
    'Notification was not sent. Check the Notification Log for details.' => 'Notificatie is niet verzonden. Bekijk het Meldingenlogboek voor details.',
    'Notification sent.'                                           => 'Notificatie verzonden.',
    'Element not found'                                            => 'Element niet gevonden',
    'Trigger Label'                                                => 'Label voor trigger',
    'An element action label (helps to differentiate multiple triggers).'        => 'Een label voor de elementactie (helpt meerdere triggers te onderscheiden).',

    // Event tab: date trigger
    'On'                                                          => 'Op',
    'days before'                                                 => 'dagen ervoor',
    'days after'                                                  => 'dagen erna',
    'Relevant Date'                                               => 'Relevante datum',
    'Send the notification relative to a chosen date.'            => 'Verstuur de melding ten opzichte van een gekozen datum.',

    // Scheduled sending
    'Scheduled Sending' => 'Geplande verzending',
    'Shared secret for authenticating scheduled-run web requests. Required only when the schedule is triggered via the web endpoint.' => 'Gedeeld geheim om webverzoeken voor een geplande uitvoering te authenticeren. Alleen vereist wanneer de planning via het webeindpunt wordt geactiveerd.',
    'Scheduled-Run Token' => 'Token voor geplande uitvoering',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => 'Wordt met elk verzoek meegestuurd als de X-Notifier-Token header of de token body parameter.',
    'Pushover Title' => 'Pushover-titel',
    'Pushover Body' => 'Pushover-tekst',
    'ntfy Title' => 'ntfy-titel',
    'ntfy Body' => 'ntfy-tekst',
    'ntfy Link URL' => 'ntfy-link-URL',
    'Render Link Previews' => 'Linkvoorvertoningen tonen',
    'Don\'t unfurl' => 'Niet uitklappen',
    'Expand link previews' => 'Linkvoorvertoningen uitklappen',
    'Regular text only' => 'Alleen platte tekst',
    'Markdown enabled' => 'Markdown ingeschakeld',
    'Dynamic Pushover Title' => 'Dynamische Pushover-titel',
    'Dynamic Subject Line' => 'Dynamische onderwerpregel',
    'Dynamic Bot Name' => 'Dynamische botnaam',
    'Dynamic ntfy Title' => 'Dynamische ntfy-titel',
    'Dynamic Announcement Title' => 'Dynamische aankondigingstitel',
    'Dynamic Flash Message Title' => 'Dynamische Flash-berichttitel',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => 'Platte tekst, maximaal 300 tekens. URL\'s en `@handle.tld`-vermeldingen worden automatisch links.',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => 'Genereer automatisch een previewkaart wanneer de tekst van het bericht een URL bevat.',
    'Whether the message be sent via the [jobs queue]({queueUrl}).' => 'Of het bericht via de [taakwachtrij]({queueUrl}) moet worden verzonden.',
    'Priority level of the ntfy message.' => 'Prioriteitsniveau van het ntfy-bericht.',
    'Optionally include comma-separated [emoji shortcodes](https://docs.ntfy.sh/emojis/).' => 'Optioneel kommagescheiden [emoji-codes](https://docs.ntfy.sh/emojis/) opnemen.',
    'Body of the ntfy notification.' => 'Inhoud van de ntfy-melding.',
    'Optionally open a URL when the notification is clicked.' => 'Optioneel een URL openen wanneer op de melding wordt geklikt.',
    'Whether to parse the body as Markdown in supported clients.' => 'Of de inhoud in ondersteunde clients als Markdown moet worden gerenderd.',
    'Heading of the announcement.' => 'Kop van de aankondiging.',
    'Body of the announcement. Supports Markdown.' => 'Inhoud van de aankondiging. Ondersteunt Markdown.',
    'Heading of the flash message.' => 'Kop van het flash-bericht.',
    'Optionally include details below the heading. Supports Markdown and HTML.' => 'Optioneel details onder de kop opnemen. Ondersteunt Markdown en HTML.',
    'Optionally include a heading above the body.' => 'Optioneel een kop boven de inhoud opnemen.',
    'Body of the SMS (text message). Plain text only.' => 'Inhoud van het sms-bericht. Alleen platte tekst.',
    'Body of the Pushover notification. Plain text only.' => 'Inhoud van de Pushover-melding. Alleen platte tekst.',
    'Subject line of the email.' => 'Onderwerpregel van de e-mail.',
    'Body of the email. Supports HTML.' => 'Inhoud van de e-mail. Ondersteunt HTML.',
    'Optionally override the app\'s display name.' => 'Optioneel de weergavenaam van de app overschrijven.',
    'Optionally override the app\'s icon with a URL.' => 'Optioneel het pictogram van de app overschrijven met een URL.',
    'Optionally override the app\'s icon with an emoji. Used only when Bot Icon URL is empty.' => 'Optioneel het pictogram van de app overschrijven met een emoji. Alleen gebruikt wanneer Bot Icon URL leeg is.',
    'Invalid Slack body format.' => 'Ongeldig Slack-inhoudsformaat.',
    'Supports standard [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) syntax. Optionally supports HTML _(see below)_.' => 'Ondersteunt standaard [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting)-syntaxis. Ondersteunt optioneel HTML _(zie hieronder)_.',
    'Render Message Body as HTML' => 'Berichtinhoud renderen als HTML',
    'Whether to only parse as [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), or additionally parse it as HTML.' => 'Alleen parsen als [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), of ook als HTML.',
    'mrkdwn only' => 'alleen mrkdwn',
    'mrkdwn + HTML' => 'mrkdwn + HTML',
];
