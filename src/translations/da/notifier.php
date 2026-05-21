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
    'Notifications'          => 'Notifikationer',
    'Notification'           => 'Notifikation',
    'All notifications'      => 'Alle notifikationer',
    'Notification Log'       => 'Notifikationslog',
    'Logs'                   => 'Logfiler',
    'View Notifications'     => 'Vis notifikationer',
    'Add a New Notification' => 'Tilføj en ny notifikation',

    // Permissions
    'View notifications'              => 'Vis notifikationer',
    'Save notifications'              => 'Gem notifikationer',
    'Use the Dynamic Recipients type' => 'Brug typen Dynamiske modtagere',
    'Test notifications'              => 'Test notifikationer',
    'Delete notifications'            => 'Slet notifikationer',
    'View notification log'           => 'Vis notifikationslog',
    'Delete notification log'         => 'Slet notifikationslog',

    // Notification editor: tabs
    'Meta'       => 'Meta',
    'Event'      => 'Hændelse',
    'Message'    => 'Besked',
    'Recipients' => 'Modtagere',

    // Event tab: type selector
    'Event Type'                                           => 'Hændelsestype',
    'What type of event will activate the notification?'   => 'Hvilken type hændelse skal aktivere notifikationen?',
    'Which specific event will activate the notification?' => 'Hvilken specifik hændelse skal aktivere notifikationen?',

    // Event tab: event types
    'Assets Event'                   => 'Aktiv-hændelse',
    'Commerce Orders Event'          => 'Commerce-ordrehændelse',
    'Commerce Products Event'        => 'Commerce-produkthændelse',
    'Digital Products Event'         => 'Digital Products-hændelse',
    'Digital Product Licenses Event' => 'Digital Products-licenshændelse',
    'Solspace Calendar Event'        => 'Solspace Calendar-hændelse',
    'Entries Event'                  => 'Indlægshændelse',
    'Users Event'                    => 'Brugerhændelse',
    'Ungrouped Users'                => 'Brugere uden gruppe',

    // Feed
    'Feed Event' => 'Feed-hændelse',
    'Feed URL' => 'Feed-URL',
    'The URL of the RSS, Atom, or JSON feed to watch.' => "URL'en til RSS-, Atom- eller JSON-feedet, der skal overvåges.",
    // Field and element conditions
    'Field Conditions'             => 'Feltbetingelser',
    'Send the message only when the saved element matches the following conditions.' => 'Send kun beskeden, når det gemte element opfylder følgende betingelser.',
    'has changed'                  => 'er ændret',
    '#{elementType} Event Filters' => 'Hændelsesfiltre for #{elementType}',
    'No filters match this event.' => 'Ingen filtre matcher denne hændelse.',
    'Determine whether each message should be sent based on specified conditions.' => 'Bestem ud fra angivne betingelser, om hver besked skal sendes.',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => 'Elementet gemmes for første gang',
    'Must be a new entry'                       => 'Skal være et nyt indlæg',
    'Must be an existing entry'                 => 'Skal være et eksisterende indlæg',
    'Can be existing or new'                    => 'Kan være eksisterende eller ny',

    // Filters: new elements
    'Element is new'         => 'Elementet er nyt',
    'New elements only'      => 'Kun nye elementer',
    'Existing elements only' => 'Kun eksisterende elementer',

    // Filters: enabled state
    'Element is enabled'         => 'Elementet er aktiveret',
    'Must be enabled'            => 'Skal være aktiveret',
    'Must be disabled'           => 'Skal være deaktiveret',
    'Can be enabled or disabled' => 'Kan være aktiveret eller deaktiveret',

    // Filters: drafts
    'Element is a draft'          => 'Elementet er et udkast',
    'Must be a draft'             => 'Skal være et udkast',
    'Must not be a draft'         => 'Må ikke være et udkast',
    'Can be a draft or non-draft' => 'Kan være udkast eller ej',

    // Filters: provisional drafts
    'Element is a provisional draft'                => 'Elementet er et foreløbigt udkast',
    'Must be a provisional draft'                   => 'Skal være et foreløbigt udkast',
    'Must not be a provisional draft'               => 'Må ikke være et foreløbigt udkast',
    'Can be a provisional draft or non-provisional' => 'Kan være foreløbigt udkast eller ej',

    // Filters: revisions
    'Element is a revision'             => 'Elementet er en revision',
    'Must be a revision'                => 'Skal være en revision',
    'Must not be a revision'            => 'Må ikke være en revision',
    'Can be a revision or non-revision' => 'Kan være revision eller ej',

    // Filters: duplication
    'Element is being duplicated'         => 'Elementet duplikeres',
    'Must be duplicating the element'     => 'Skal duplikere elementet',
    'Must not be duplicating the element' => 'Må ikke duplikere elementet',

    // Filters: propagation
    'Element is being propagated'     => 'Elementet udbredes',
    'Element must be propagating'     => 'Elementet skal udbredes',
    'Element must not be propagating' => 'Elementet må ikke udbredes',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => 'Elementet bulk-gemmes igen',
    'Must be bulk-resaving the element'     => 'Skal bulk-gemme elementet igen',
    'Must not be bulk-resaving the element' => 'Må ikke bulk-gemme elementet igen',

    // Filters: common output
    'Unnamed filter'                => 'Unavngivet filter',
    'Must be TRUE to send message'  => 'Skal være TRUE for at sende beskeden',
    'Must be FALSE to send message' => 'Skal være FALSE for at sende beskeden',
    'No effect'                     => 'Ingen virkning',

    // Message tab: type selector and queue
    'Message Type'                       => 'Beskedtype',
    'What type of message will be sent?' => 'Hvilken type besked sendes?',
    'Send Message via Queue'             => 'Send besked via kø',
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are also supported.' => '[Templating]({templatingUrl}) og [specialvariabler]({variablesUrl}) understøttes også.',
    'Send immediately' => 'Send med det samme',
    'Add to queue' => 'Føj til kø',

    // Message tab: Email fields
    "User's Email Address Field" => 'Brugerfelt for e-mailadresse',
    'Email Subject'              => 'E-mailemne',
    'Email Body'                 => 'E-mailtekst',

    // Message tab: SMS fields
    "User's Phone Number Field" => 'Brugerfelt for telefonnummer',
    'SMS Message Body'          => 'SMS-beskedtekst',

    // Message tab: Announcement fields
    'Announcement Title'   => 'Bekendtgørelsestitel',
    'Announcement Message' => 'Bekendtgørelsestekst',

    // Message tab: Flash fields
    'Flash Message Type'                         => 'Flash-beskedtype',
    'Flash Message Title'                        => 'Flash-beskedtitel',
    'Flash Message Details'                      => 'Flash-beskeddetaljer',
    'Which type of flash message should appear?' => 'Hvilken type flash-besked skal vises?',

    // Message tab: Pushover fields
    "Field containing each user's Pushover key" => 'Brugerens Pushover-nøglefelt',

    // Message tab: ntfy fields
    'Priority'           => 'Prioritet',
    'Tags'               => 'Tags',
    'Click URL'          => 'Klik-URL',
    'Render as Markdown' => 'Vis som Markdown',

    // Message tab: Slack fields
    'Slack Message Body' => 'Slack-beskedtekst',
    'Bot Icon URL' => 'Ikon-URL',
    "A URL for the icon to display alongside this message. Leave blank to use the app's default." => 'En URL til ikonet, der skal vises ved siden af denne besked. Lad være tomt for at bruge kanalens standard.',

    // Message tab: Bluesky fields
    'Post Body' => 'Indlægstekst',
    'Generate Link Preview' => 'Generér linkforhåndsvisning',
    "When the post body contains a URL, automatically generate a preview card with the linked page's image, title, and description." => 'Når indlæggets tekst indeholder en URL, vedhæftes et forhåndsvisningskort med den linkede sides titel, beskrivelse og billede.',
    'No card' => 'Intet kort',
    'Generate preview card' => 'Generér forhåndsvisningskort',

    // Message tab: Title / Body / Trix toolbar
    'Title'         => 'Titel',
    'Body'          => 'Tekst',
    'Rich Text'     => 'Rich Text',
    'Bold'          => 'Fed',
    'Italic'        => 'Kursiv',
    'Underline'     => 'Understreget',
    'Strikethrough' => 'Gennemstreget',
    'Bullets'       => 'Punkttegn',
    'Numbers'       => 'Numre',
    'Heading'       => 'Overskrift',
    'Code'          => 'Kode',
    'Undo'          => 'Fortryd',
    'Redo'          => 'Annuller fortryd',
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => 'Teksten i den udgående e-mail. Du kan bruge <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">særlige variabler</a> eller endda <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">springe modtagere over</a>.',

    // Recipients tab: common
    'Recipients Type'                             => 'Modtagertype',
    'Who will receive this message?'              => 'Hvem skal modtage denne besked?',
    'Add a message recipient'                     => 'Tilføj en modtager',
    'Select User(s)'                              => 'Vælg bruger(e)',
    'Which users will receive the message?'       => 'Hvilke brugere skal modtage beskeden?',
    'Which user groups will receive the message?' => 'Hvilke brugergrupper skal modtage beskeden?',
    'Twig Snippet to Determine Recipients'        => 'Twig-snippet til at bestemme modtagere',

    // Recipients tab: per-provider pickers
    'Select Slack channel(s)'                           => 'Vælg Slack-kanal(er)',
    'Which Slack channels should receive this message?' => 'Hvilke Slack-kanaler skal modtage denne besked?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Ingen Slack-kanaler er konfigureret. Tilføj en i [Indstillinger → Slack]({url}).',
    'Select ntfy topic(s)'                              => 'Vælg ntfy-emne(r)',
    'Which ntfy topics should receive this message?'    => 'Hvilke ntfy-emner skal modtage denne besked?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'Ingen ntfy-emner er konfigureret. Tilføj et i [Indstillinger → ntfy]({url}).',
    'Select Bluesky account(s)'                         => 'Vælg Bluesky-konto(er)',
    'Which Bluesky accounts should post this message?'  => 'Hvilke Bluesky-konti skal udgive denne besked?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Ingen Bluesky-konti er konfigureret. Tilføj en i [Indstillinger → Bluesky]({url}).',

    // Settings: page chrome
    'Notifier Settings' => 'Notifier-indstillinger',
    'General'           => 'Generelt',
    'Twilio'            => 'Twilio',
    'Pushover'          => 'Pushover',
    'Slack'             => 'Slack',
    'Bluesky'           => 'Bluesky',
    'ntfy'              => 'ntfy',

    // Settings: Logging
    'Logging'                             => 'Logning',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier fører en løbende log over sendte beskeder. Det er normalt ikke nødvendigt, men du kan begrænse antallet af loghændelser, der gemmes i databasen.',
    'Enable Logging'                      => 'Aktivér logning',
    'When disabled, Notifier will not write anything to the notification log.' => 'Når deaktiveret, skriver Notifier intet til notifikationsloggen.',
    'Number of days to retain log events' => 'Antal dage loghændelser skal opbevares',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Opbevar højst loghændelser i dette antal dage. Lad være tom for ingen grænse.',
    'Number of log events to retain'      => 'Antal loghændelser, der skal opbevares',
    'At most, keep this many log events. Leave blank for no limit.' => 'Opbevar højst dette antal loghændelser. Lad være tom for ingen grænse.',

    // Settings: Twilio
    'Twilio API Credentials'                       => 'Twilio API-legitimationsoplysninger',
    'If using the Twilio API to send SMS messages, the following credentials are required.' => 'Hvis Twilio API bruges til at sende SMS-beskeder, kræves følgende legitimationsoplysninger.',
    'Twilio Account SID'                           => 'Twilio Account SID',
    'Twilio Auth Token'                            => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)' => 'Twilio-telefonnummer (sender hver SMS-besked)',
    'SMS Testing'                                  => 'SMS-test',
    'Optional. When set, every SMS dispatched will be sent to this number instead of the resolved recipient.' => 'Valgfrit. Når angivet, sendes hver afsendt SMS til dette nummer i stedet for den oprindelige modtager.',
    'Test phone number'                            => 'Test-telefonnummer',

    // Settings: Pushover
    "[Pushover](https://pushover.net) sends push notifications to a registered user's devices. Each Craft user needs a custom field on their profile storing their Pushover user key; you select which field on each Notification's Message tab. For full setup instructions, see the [Pushover getting-started docs](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover)." => '[Pushover](https://pushover.net) sender push-notifikationer til en registreret brugers enheder. Hver Craft-bruger har brug for et brugerdefineret felt på sin profil, der gemmer brugerens Pushover-nøgle. Du vælger feltet på fanen Besked på hver notifikation. Se [Pushover-kom-i-gang-dokumentationen](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover) for fuld konfigurationsvejledning.',
    'Application API Token'                                      => 'Applikations-API-token',
    'The 30-character app token from your Pushover application.' => 'Det 30-tegns app-token fra din Pushover-applikation.',

    // Settings: ntfy
    'ntfy.sh is a free HTTP-based push notification service. Subscribers receive messages on the ntfy app, web, or any compatible client by joining a topic.' => 'ntfy.sh er en gratis HTTP-baseret push-notifikationstjeneste. Abonnenter modtager beskeder i ntfy-appen, på nettet eller via en kompatibel klient ved at tilmelde sig et emne.',
    'Server URL'   => 'Server-URL',
    'Defaults to https://ntfy.sh. Point at a self-hosted ntfy instance if applicable.' => 'Standard er https://ntfy.sh. Peg på en selvhostet ntfy-instans, hvis det er relevant.',
    'Access token' => 'Adgangstoken',
    'Optional. Required for protected topics or self-hosted instances with auth.' => 'Valgfrit. Kræves til beskyttede emner eller selvhostede instanser med godkendelse.',
    'ntfy Topics'  => 'ntfy-emner',
    'Named list of ntfy topics. Each topic becomes selectable on the notification edit screen.' => 'Navngivet liste over ntfy-emner. Hvert emne bliver valgbart på notifikationsredigeringsskærmen.',
    'Topics'       => 'Emner',
    'Add one row per topic name. Use the **Test** button to send a quick test message to the topic.' => 'Tilføj én række pr. emnenavn. Brug knappen **Test** til at sende en hurtig testbesked til emnet.',
    'Topic'        => 'Emne',
    'Add a topic'  => 'Tilføj et emne',
    'Save first to persist a row, then click its **Test** button to fire a sanity check against ntfy.' => 'Gem først for at gemme en række, og klik derefter på dens **Test**-knap for at udføre en hurtig kontrol mod ntfy.',

    // Settings: Slack
    'Slack Channels' => 'Slack-kanaler',
    'Create a [Slack app](https://api.slack.com/apps) with the `chat:write`, `chat:write.customize`, and `chat:write.public` scopes, then add a row for each channel you\'d like to post into. Each channel becomes available as a recipient on the **Recipients** tab when configuring a notification. A bot token is a secret, so store it in a `.env` variable and reference that variable (e.g. `$SLACK_BOT_TOKEN`) rather than pasting the token directly.' => 'Opret en [Slack-app](https://api.slack.com/apps) med scopes `chat:write`, `chat:write.customize` og `chat:write.public`, og tilføj derefter en række for hver kanal, du gerne vil sende beskeder til. Hver kanal bliver tilgængelig som modtager på fanen **Recipients** ved konfiguration af en notifikation. Et bot-token er en hemmelighed, så gem det i en `.env`-variabel og henvis til den variabel (f.eks. `$SLACK_BOT_TOKEN`) i stedet for at indsætte tokenet direkte.',
    'Channels'       => 'Kanaler',
    'Each Slack channel needs its own Incoming Webhook URL. Use the **Test** button to fire a quick sanity check after saving.' => 'Hver Slack-kanal har brug for sin egen Incoming Webhook-URL. Brug knappen **Test** til at udføre en hurtig kontrol efter gemning.',
    'Add a channel'  => 'Tilføj en kanal',
    'Bot Token' => 'Bot-token',
    'Channel ID' => 'Kanal-ID',
    'Bot Emoji' => 'Ikon-emoji',
    'Bot Name' => 'Brugernavn',
    'Show link previews' => 'Vis linkforhåndsvisninger',
    'An emoji shortcode to display alongside this message, e.g. `:rocket:`. Used only when Bot Icon URL is empty.' => 'En emoji-shortcode, der vises ved siden af denne besked, f.eks. `:rocket:`. Bruges kun, når ikon-URL er tom.',
    "A display name for this message. Leave blank to use the app's default." => 'Et visningsnavn til denne besked. Lad være tomt for at bruge appens standard.',
    'Whether Slack should unfurl link previews for URLs in the message body.' => "Om Slack skal vise linkforhåndsvisninger for URL'er i beskedteksten.",
    'Not a valid Bot Token. Must start with `xoxb-`.' => 'Ugyldigt bot-token. Skal starte med `xoxb-`.',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => 'Ugyldigt kanal-ID. Skal ligne `C01234ABCD`.',
    'Unable to send Slack message, no bot token.' => 'Kan ikke sende Slack-besked: intet bot-token.',
    'Unable to send Slack message, no channel ID.' => 'Kan ikke sende Slack-besked: intet kanal-ID.',
    'Recipient "{name}" has no Slack bot token.' => 'Modtageren "{name}" har intet Slack bot-token.',
    'Recipient "{name}" has no Slack channel ID.' => 'Modtageren "{name}" har intet Slack kanal-ID.',
    'Slack rejected the message: {error}' => 'Slack afviste beskeden: {error}',
    'Save first to persist a row, then click its **Test** button to fire a sanity check against Slack.' => 'Gem først for at gemme en række, og klik derefter på dens **Test**-knap for at udføre en hurtig kontrol mod Slack.',

    // Settings: Bluesky
    "[Bluesky](https://bsky.app) posts publish to the configured account's feed via the ATProto API. App passwords are generated at [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). An app password is a secret, so store it in a `.env` variable and reference that variable (e.g. `\$BLUESKY_APP_PASSWORD`) rather than pasting the password directly." => '[Bluesky](https://bsky.app)-indlæg udgives på den konfigurerede kontos feed via ATProto API. App-adgangskoder genereres på [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). En app-adgangskode er en hemmelighed, så gem den i en `.env`-variabel og henvis til den variabel (f.eks. `$BLUESKY_APP_PASSWORD`) i stedet for at indsætte adgangskoden direkte.',
    'PDS URL'          => 'PDS-URL',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'Standard er https://bsky.social. Peg på en brugerdefineret PDS, hvis din installation fødererer.',
    'Bluesky Accounts' => 'Bluesky-konti',
    'Named list of Bluesky accounts. Each account becomes selectable on the notification edit screen.' => 'Navngivet liste over Bluesky-konti. Hver konto bliver valgbar på notifikationsredigeringsskærmen.',
    'Accounts'         => 'Konti',
    'Add one row per Bluesky account. Use **Test** to verify the credentials authenticate.' => 'Tilføj én række pr. Bluesky-konto. Brug **Test** for at bekræfte, at legitimationsoplysningerne kan godkendes.',
    'Label'            => 'Etiket',
    'Handle'           => 'Handle',
    'App password'     => 'App-adgangskode',
    'Add an account'   => 'Tilføj en konto',
    'Save first to persist a row, then click its **Test** button to verify the credentials authenticate.' => 'Gem først for at gemme en række, og klik derefter på dens **Test**-knap for at bekræfte, at legitimationsoplysningerne kan godkendes.',

    // Test notification (UI)
    'Send a test message'           => 'Send en testbesked',
    'Are you certain you want to send a test notification?\\n\\nThe configured message will be sent to the configured recipient(s).' => 'Er du sikker på, at du vil sende en testnotifikation?\\n\\nDen konfigurerede besked sendes til de konfigurerede modtagere.',
    'Test'                          => 'Test',
    'Test notification dispatched.' => 'Testnotifikation afsendt.',
    'No messages were dispatched. Check the recipient configuration.' => 'Der blev ikke sendt nogen beskeder. Tjek modtagerkonfigurationen.',

    // Settings: save / test action responses
    "Couldn't save settings."                 => 'Kunne ikke gemme indstillingerne.',
    'Settings saved.'                         => 'Indstillinger gemt.',
    'Topic is empty.'                         => 'Emnet er tomt.',
    'Server URL is not configured.'           => 'Server-URL er ikke konfigureret.',
    'Test message from Notifier.'             => 'Testbesked fra Notifier.',
    'HTTP {status}'                           => 'HTTP {status}',
    'Test message sent successfully.'         => 'Testbesked sendt.',
    'HTTP {status}: {body}'                   => 'HTTP {status}: {body}',
    'Handle and app password are required.'   => 'Handle og app-adgangskode er påkrævet.',
    'Authentication failed.'                  => 'Godkendelse mislykkedes.',
    'Successfully authenticated. No messages were posted.' => 'Godkendt. Der blev ikke sendt nogen beskeder.',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.'          => 'Sender {messageType} til {recipient}.',
    'Adding message to queue.'                       => 'Tilføjer besked til køen.',
    'Unable to parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => 'Kan ikke parse feedet. PHP-udvidelserne `simplexml` og `libxml` er påkrævet.',
    'Unable to parse the feed.' => 'Kan ikke parse feedet.',
    'Unable to fetch the feed: {message}' => 'Kan ikke hente feedet: {message}',
    'Initial feed scan failed: {message}' => 'Indledende feed-scanning mislykkedes: {message}',
    'Sending message immediately (bypassing queue).' => 'Sender beskeden med det samme (springer køen over).',
    'Log events deleted.'                            => 'Loghændelser slettet.',
    'notification'                                   => 'notifikation',

    // Outbound: Email log messages
    'Unable to send email, no recipient specified.'     => 'Kan ikke sende e-mail: ingen modtager angivet.',
    'Unable to send email, the message body was empty.' => 'Kan ikke sende e-mail: beskedteksten var tom.',
    "Unable to send the email using Craft's native email handling." => 'Kan ikke sende e-mailen via Crafts indbyggede e-mailhåndtering.',
    'Check your general email settings within Craft.'   => 'Tjek dine generelle e-mailindstillinger i Craft.',
    'Successfully sent email message!'                  => 'E-mail sendt!',

    // Outbound: SMS log messages
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[Ugyldige Twilio-legitimationsoplysninger.]({url}) Mangler {missing}.',
    'Unable to send SMS, no Twilio phone number exists.'      => 'Kan ikke sende SMS, intet Twilio-telefonnummer findes.',
    'Unable to send SMS, no recipient phone number exists.'   => 'Kan ikke sende SMS, intet modtagertelefonnummer findes.',
    'Unable to send SMS, recipient phone number is invalid.'  => 'Kan ikke sende SMS, modtagerens telefonnummer er ugyldigt.',
    'Successfully sent SMS message!'                          => 'SMS sendt!',

    // Outbound: Announcement log messages
    'Unable to post announcement, no recipient userId specified.' => 'Kan ikke udgive bekendtgørelse: ingen modtager-userId angivet.',
    'Successfully posted announcement!' => 'Bekendtgørelse udgivet!',

    // Outbound: Flash log messages
    'Unable to send the flash message, invalid flash type.' => 'Kan ikke sende flash-beskeden: ugyldig flash-type.',
    'Successfully sent flash message!'                      => 'Flash-besked sendt!',

    // Outbound: Pushover log messages
    '[Invalid Pushover credentials.]({url}) Missing app token.'  => '[Ugyldige Pushover-legitimationsoplysninger.]({url}) App-token mangler.',
    'Unable to send Pushover message, no user key on recipient.' => 'Kan ikke sende Pushover-besked: ingen brugernøgle på modtageren.',
    'Pushover POST failed: {reason}'                             => 'Pushover POST mislykkedes: {reason}',
    'Successfully sent Pushover message!'                        => 'Pushover-besked sendt!',

    // Outbound: ntfy log messages
    'Unable to send ntfy message, no server URL configured.' => 'Kan ikke sende ntfy-besked: ingen server-URL konfigureret.',
    'Unable to send ntfy message, no topic specified.'       => 'Kan ikke sende ntfy-besked: intet emne angivet.',
    'ntfy POST failed with HTTP {status}: {reason}'          => 'ntfy POST mislykkedes med HTTP {status}: {reason}',
    'ntfy POST failed: {reason}'                             => 'ntfy POST mislykkedes: {reason}',
    'Successfully sent ntfy message to topic "{topic}".'     => 'ntfy-besked sendt til emnet "{topic}".',

    // Outbound: Slack log messages
    'Unable to send Slack message, body is empty.'  => 'Kan ikke sende Slack-besked: teksten er tom.',
    'Slack POST failed: {reason}'                   => 'Slack POST mislykkedes: {reason}',
    'Successfully sent Slack message to "{label}".' => 'Slack-besked sendt til "{label}".',

    // Outbound: Bluesky log messages
    'Unable to send Bluesky post, recipient is missing credentials.' => 'Kan ikke sende Bluesky-indlæg: modtageren mangler legitimationsoplysninger.',
    'Body exceeded {max} characters, truncated.'          => 'Teksten oversteg {max} tegn og blev afkortet.',
    'Successfully posted to Bluesky as "{label}".'        => 'Udgivet på Bluesky som "{label}".',
    'Bluesky auth failed for {handle}: {reason}'          => 'Bluesky-godkendelse mislykkedes for {handle}: {reason}',
    'Bluesky auth failed: {reason}'                       => 'Bluesky-godkendelse mislykkedes: {reason}',
    'Bluesky post failed: {reason}'                       => 'Bluesky-indlæg mislykkedes: {reason}',
    'Bluesky link preview skipped: {reason}'              => 'Bluesky-linkforhåndsvisning sprunget over: {reason}',

    // Recipient-strategy warnings
    'Recipient "{name}" has no email address.'       => 'Modtageren "{name}" har ingen e-mailadresse.',
    'Recipient "{name}" has no phone number.'        => 'Modtageren "{name}" har intet telefonnummer.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => 'Modtageren "{name}" har ingen tilknyttet bruger; kan ikke sende bekendtgørelse.',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => 'Modtageren "{name}" har ikke adgang til kontrolpanelet; kan ikke sende bekendtgørelse.',
    'Pushover user-key field is not configured on this notification.' => 'Pushover-brugernøglefeltet er ikke konfigureret på denne notifikation.',
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => 'Modtageren "{name}" har ingen tilknyttet bruger; kan ikke sende Pushover-besked.',
    '[SKIPPED] User "{name}" has no Pushover key.'   => '[OVERSPRUNGET] Brugeren "{name}" har ingen Pushover-nøgle.',
    'Recipient "{name}" has no ntfy topic.'          => 'Modtageren "{name}" har intet ntfy-emne.',
    'Recipient "{name}" has no Bluesky credentials.' => 'Modtageren "{name}" har ingen Bluesky-legitimationsoplysninger.',

    // Errors / exceptions
    'Invalid element event: {class}'                         => 'Ugyldig elementhændelse: {class}',
    'Invalid notification ID: {id}'                          => 'Ugyldigt notifikations-id: {id}',
    'Invalid email message mode.'                            => 'Ugyldig e-mailbeskedtilstand.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Du har ikke tilladelse til at bruge typen Dynamiske modtagere.',
    'Dynamic recipients snippet did not call setRecipients.' => 'Snippet til dynamiske modtagere kaldte ikke setRecipients.',
    'setRecipients was called with an empty value.'          => 'setRecipients blev kaldt med en tom værdi.',
    'Unrecognized recipient of type "{type}".'               => 'Ukendt modtager af typen "{type}".',
    'Unrecognized recipient "{value}".'                      => 'Ukendt modtager "{value}".',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => 'Konfigureret {kind} findes ikke længere i pluginindstillingerne (uid: {uid}).',
    'Invalid settings section: {section}'                    => 'Ugyldig indstillingssektion: {section}',
    'User not authorized to save this notification.'         => 'Brugeren har ikke tilladelse til at gemme denne notifikation.',
    'User not authorized to view this notification.'         => 'Brugeren har ikke tilladelse til at vise denne notifikation.',
    'User not authorized to delete this notification.'       => 'Brugeren har ikke tilladelse til at slette denne notifikation.',
    'Notification not found'                                 => 'Notifikation ikke fundet',

    // Misc config-file note
    'This is being set in the config file. [{file}]' => 'Dette indstilles i konfigurationsfilen. [{file}]',

    // Slack, ntfy, and Bluesky message types
    "Add the Bluesky accounts you'd like to post from. Each account becomes available as a recipient on the **Recipients** tab when configuring a notification." => 'Tilføj de Bluesky-konti, du vil udgive fra. Hver konto bliver tilgængelig som modtager på fanen **Modtagere**, når du konfigurerer en notifikation.',
    "Click any row's **Test** button to confirm the account authenticates." => 'Klik på en vilkårlig rækkes **Test**-knap for at bekræfte, at kontoen kan godkendes.',
    "Click any row's **Test** button to send a quick test message to that channel." => 'Klik på en vilkårlig rækkes **Test**-knap for at sende en hurtig testbesked til den kanal.',
    "Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`." => 'Valgfrit, peg på en selvhostet ntfy-instans (hvis relevant). Standard er `https://ntfy.sh`.',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Valgfrit, kræves til beskyttede emner eller selvhostede instanser med godkendelse.',
    "Add the ntfy topics you'd like to send messages to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification." => 'Tilføj de ntfy-emner, du vil sende beskeder til. Hvert emne bliver tilgængeligt som modtager på fanen **Modtagere**, når du konfigurerer en notifikation.',
    "Click any row's **Test** button to send a quick test message to that topic." => 'Klik på en vilkårlig rækkes **Test**-knap for at sende en hurtig testbesked til det emne.',
    'Enable Markdown' => 'Aktivér Markdown',
    'Link URL' => 'Link-URL',

    // Manual triggers
    'Send Notification'                                            => 'Send notifikation',
    'Send manual notifications'                                    => 'Send manuelle notifikationer',
    'Are you sure you want to send this notification?'             => 'Er du sikker på, at du vil sende denne notifikation?',
    'This notification cannot be triggered manually.'              => 'Denne notifikation kan ikke udløses manuelt.',
    'This notification no longer applies to the selected element.' => 'Denne notifikation gælder ikke længere for det valgte element.',
    'Notification was not sent. Check the Notification Log for details.' => 'Notifikationen blev ikke sendt. Tjek Notifikationslog for detaljer.',
    'Notification sent.'                                           => 'Notifikation sendt.',
    'Element not found'                                            => 'Element ikke fundet',
    'Trigger Label'                                                => 'Udløser-etiket',
    'An element action label (helps to differentiate multiple triggers).'        => 'En etiket for elementhandlingen (hjælper med at skelne mellem flere udløsere).',

    // Event tab: date trigger
    'On'                                                          => 'På',
    'days before'                                                 => 'dage før',
    'days after'                                                  => 'dage efter',
    'Relevant Date'                                               => 'Relevant dato',
    'Send the notification relative to a chosen date.'            => 'Send notifikationen i forhold til en valgt dato.',
    "Fires when an entry's Post Date passes and it becomes Live." => 'Udløses, når en indtastnings udgivelsesdato nås, og den bliver live.',

    // Scheduled sending
    'Scheduled Sending' => 'Planlagt afsendelse',
    'Shared secret for authenticating scheduled-run web requests. Required only when the schedule is triggered via the web endpoint.' => 'Delt hemmelighed til at autentificere planlagte kørselsanmodninger over web. Kræves kun, når tidsplanen udløses via webendpointet.',
    'Scheduled-Run Token' => 'Token til planlagt kørsel',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => 'Sendes med hver forespørgsel som headeren X-Notifier-Token eller som parameteren token i brødteksten.',
    'Pushover Title' => 'Pushover-titel',
    'Pushover Body' => 'Pushover-tekst',
    'ntfy Title' => 'ntfy-titel',
    'ntfy Body' => 'ntfy-tekst',
    'ntfy Link URL' => 'ntfy-link-URL',
    'Render Link Previews' => 'Vis linkforhåndsvisninger',
    'Don\'t unfurl' => 'Foldé ikke ud',
    'Expand link previews' => 'Udvid linkforhåndsvisninger',
    'Regular text only' => 'Kun almindelig tekst',
    'Markdown enabled' => 'Markdown aktiveret',
    'Dynamic Pushover Title' => 'Dynamisk Pushover-titel',
    'Dynamic Subject Line' => 'Dynamisk emnelinje',
    'Dynamic Bot Name' => 'Dynamisk botnavn',
    'Dynamic ntfy Title' => 'Dynamisk ntfy-titel',
    'Dynamic Announcement Title' => 'Dynamisk annonceringstitel',
    'Dynamic Flash Message Title' => 'Dynamisk flash-besked-titel',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => 'Ren tekst, maks. 300 tegn. URL\'er og `@handle.tld`-omtaler bliver automatisk links.',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => 'Generér automatisk et forhåndsvisningskort, når der er en URL i indlæggets tekst.',
    'Whether the message be sent via the [jobs queue]({queueUrl}).' => 'Om beskeden skal sendes via [job-køen]({queueUrl}).',
    'Priority level of the ntfy message.' => 'Prioritetsniveau for ntfy-beskeden.',
    'Optionally include comma-separated [emoji shortcodes](https://docs.ntfy.sh/emojis/).' => 'Inkludér eventuelt komma-separerede [emoji-koder](https://docs.ntfy.sh/emojis/).',
    'Body of the ntfy notification.' => 'Indhold i ntfy-notifikationen.',
    'Optionally open a URL when the notification is clicked.' => 'Åbn eventuelt en URL, når notifikationen klikkes.',
    'Whether to parse the body as Markdown in supported clients.' => 'Om brødteksten skal læses som Markdown i klienter, der understøtter det.',
    'Heading of the announcement.' => 'Overskrift på annonceringen.',
    'Body of the announcement. Supports Markdown.' => 'Indhold i annonceringen. Understøtter Markdown.',
    'Heading of the flash message.' => 'Overskrift på flash-beskeden.',
    'Optionally include details below the heading. Supports Markdown and HTML.' => 'Inkludér eventuelt detaljer under overskriften. Understøtter Markdown og HTML.',
    'Optionally include a heading above the body.' => 'Inkludér eventuelt en overskrift over indholdet.',
    'Body of the SMS (text message). Plain text only.' => 'Indhold i SMS\'en (tekstbesked). Kun ren tekst.',
    'Body of the Pushover notification. Plain text only.' => 'Indhold i Pushover-notifikationen. Kun ren tekst.',
    'Subject line of the email.' => 'Emnelinje på e-mailen.',
    'Body of the email. Supports HTML.' => 'Indhold i e-mailen. Understøtter HTML.',
    'Body of the Slack message. Supports [Slack mrkdwn](https://api.slack.com/reference/surfaces/formatting) syntax.' => 'Indhold i Slack-beskeden. Understøtter [Slack mrkdwn](https://api.slack.com/reference/surfaces/formatting)-syntaks.',
    'Optionally override the app\'s display name.' => 'Overskriv eventuelt appens visningsnavn.',
    'Optionally override the app\'s icon with a URL.' => 'Overskriv eventuelt appens ikon med en URL.',
    'Optionally override the app\'s icon with an emoji. Used only when Bot Icon URL is empty.' => 'Overskriv eventuelt appens ikon med en emoji. Bruges kun, når Bot Icon URL er tom.',
];
