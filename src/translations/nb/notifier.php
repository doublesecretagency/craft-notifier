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
    'Notifications'          => 'Varsler',
    'Notification'           => 'Varsel',
    'All notifications'      => 'Alle varsler',
    'Notification Log'       => 'Varslingslogg',
    'Logs'                   => 'Logger',
    'View Notifications'     => 'Vis varsler',
    'Add a New Notification' => 'Legg til et nytt varsel',

    // Permissions
    'View notifications'              => 'Vis varsler',
    'Save notifications'              => 'Lagre varsler',
    'Use the Dynamic Recipients type' => 'Bruk typen Dynamiske mottakere',
    'Test notifications'              => 'Test varsler',
    'Delete notifications'            => 'Slett varsler',
    'View notification log'           => 'Vis varslingsloggen',
    'Delete notification log'         => 'Slett varslingsloggen',

    // Notification editor: tabs
    'Meta'       => 'Meta',
    'Event'      => 'Hendelse',
    'Message'    => 'Melding',
    'Recipients' => 'Mottakere',

    // Event tab: type selector
    'Event Type'                                           => 'Hendelsestype',
    'What type of event will activate the notification?'   => 'Hvilken type hendelse skal utløse varselet?',
    'Which specific event will activate the notification?' => 'Hvilken spesifikk hendelse skal utløse varselet?',

    // Event tab: event types
    'Assets Event'                   => 'Asset-hendelse',
    'Commerce Orders Event'          => 'Commerce-ordrehendelse',
    'Commerce Products Event'        => 'Commerce-produkthendelse',
    'Digital Products Event'         => 'Digital Products-hendelse',
    'Digital Product Licenses Event' => 'Digital Products-lisenshendelse',
    'Solspace Calendar Event'        => 'Solspace Calendar-hendelse',
    'Entries Event'                  => 'Innleggshendelse',
    'Users Event'                    => 'Brukerhendelse',
    'Ungrouped Users'                => 'Brukere uten gruppe',

    // Feed
    'Feed URL' => 'Feed-URL',
    'The URL of the RSS, Atom, or JSON feed to watch.' => 'URL-en til RSS-, Atom- eller JSON-feeden som skal overvåkes.',
    // Field and element conditions
    'Field Conditions'             => 'Feltvilkår',
    'Send the message only when the saved element matches the following conditions.' => 'Send meldingen kun når det lagrede elementet oppfyller følgende vilkår.',
    'has changed'                  => 'er endret',
    '#{elementType} Event Filters' => 'Hendelsesfiltre for #{elementType}',
    'No filters match this event.' => 'Ingen filtre passer til denne hendelsen.',
    'Determine whether each message should be sent based on specified conditions.' => 'Bestem ut fra angitte vilkår om hver melding skal sendes.',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => 'Elementet lagres for første gang',
    'Must be a new entry'                       => 'Må være et nytt innlegg',
    'Must be an existing entry'                 => 'Må være et eksisterende innlegg',
    'Can be existing or new'                    => 'Kan være eksisterende eller ny',

    // Filters: new elements
    'Element is new'         => 'Elementet er nytt',
    'New elements only'      => 'Kun nye elementer',
    'Existing elements only' => 'Kun eksisterende elementer',

    // Filters: enabled state
    'Element is enabled'         => 'Elementet er aktivert',
    'Must be enabled'            => 'Må være aktivert',
    'Must be disabled'           => 'Må være deaktivert',
    'Can be enabled or disabled' => 'Kan være aktivert eller deaktivert',

    // Filters: drafts
    'Element is a draft'          => 'Elementet er et utkast',
    'Must be a draft'             => 'Må være et utkast',
    'Must not be a draft'         => 'Må ikke være et utkast',
    'Can be a draft or non-draft' => 'Kan være utkast eller ikke',

    // Filters: provisional drafts
    'Element is a provisional draft'                => 'Elementet er et foreløpig utkast',
    'Must be a provisional draft'                   => 'Må være et foreløpig utkast',
    'Must not be a provisional draft'               => 'Må ikke være et foreløpig utkast',
    'Can be a provisional draft or non-provisional' => 'Kan være foreløpig utkast eller ikke',

    // Filters: revisions
    'Element is a revision'             => 'Elementet er en revisjon',
    'Must be a revision'                => 'Må være en revisjon',
    'Must not be a revision'            => 'Må ikke være en revisjon',
    'Can be a revision or non-revision' => 'Kan være revisjon eller ikke',

    // Filters: duplication
    'Element is being duplicated'         => 'Elementet dupliseres',
    'Must be duplicating the element'     => 'Må duplisere elementet',
    'Must not be duplicating the element' => 'Må ikke duplisere elementet',

    // Filters: propagation
    'Element is being propagated'     => 'Elementet propageres',
    'Element must be propagating'     => 'Elementet må propageres',
    'Element must not be propagating' => 'Elementet må ikke propageres',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => 'Elementet lagres på nytt i bulk',
    'Must be bulk-resaving the element'     => 'Må lagre elementet på nytt i bulk',
    'Must not be bulk-resaving the element' => 'Må ikke lagre elementet på nytt i bulk',

    // Filters: common output
    'Unnamed filter'                => 'Filter uten navn',
    'Must be TRUE to send message'  => 'Må være TRUE for å sende meldingen',
    'Must be FALSE to send message' => 'Må være FALSE for å sende meldingen',
    'No effect'                     => 'Ingen virkning',

    // Message tab: type selector and queue
    'Message Type'                       => 'Meldingstype',
    'What type of message will be sent?' => 'Hvilken type melding skal sendes?',
    'Send Message via Queue'             => 'Send melding via kø',
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are also supported.' => '[Templating]({templatingUrl}) og [spesielle variabler]({variablesUrl}) støttes også.',
    'Send immediately' => 'Send umiddelbart',
    'Add to queue' => 'Legg til i kø',

    // Message tab: Email fields
    "User's Email Address Field" => 'Brukerfelt for e-postadresse',
    'Email Subject'              => 'E-postemne',
    'Email Body'                 => 'E-posttekst',

    // Message tab: SMS fields
    "User's Phone Number Field" => 'Brukerfelt for telefonnummer',
    'SMS Message Body'          => 'SMS-meldingstekst',

    // Message tab: Announcement fields
    'Announcement Title'   => 'Kunngjøringstittel',
    'Announcement Message' => 'Kunngjøringsmelding',

    // Message tab: Flash fields
    'Flash Message Type'                         => 'Type for flash-melding',
    'Flash Message Title'                        => 'Tittel for flash-melding',
    'Flash Message Details'                      => 'Detaljer for flash-melding',
    'Which type of flash message should appear?' => 'Hvilken type flash-melding skal vises?',

    // Message tab: Pushover fields
    "Field containing each user's Pushover key" => 'Brukerens Pushover-nøkkelfelt',

    // Message tab: ntfy fields
    'Priority'           => 'Prioritet',
    'Tags'               => 'Etiketter',

    // Message tab: Slack fields
    'Slack Message Body' => 'Slack-meldingstekst',
    'Bot Icon URL' => 'Ikon-URL',

    // Message tab: Bluesky fields
    'Post Body' => 'Innleggstekst',
    'Generate Link Preview' => 'Generer lenkeforhåndsvisning',
    'No card' => 'Ingen kort',
    'Generate preview card' => 'Generer forhåndsvisningskort',

    // Message tab: Title / Body / Trix toolbar
    'Rich Text'     => 'Rik tekst',
    'Bold'          => 'Fet',
    'Italic'        => 'Kursiv',
    'Underline'     => 'Understreket',
    'Strikethrough' => 'Gjennomstreket',
    'Bullets'       => 'Punktliste',
    'Numbers'       => 'Nummerering',
    'Heading'       => 'Overskrift',
    'Code'          => 'Kode',
    'Undo'          => 'Angre',
    'Redo'          => 'Gjør om',

    // Recipients tab: common
    'Recipients Type'                             => 'Mottakertype',
    'Who will receive this message?'              => 'Hvem skal motta denne meldingen?',
    'Add a message recipient'                     => 'Legg til en mottaker',
    'Select User(s)'                              => 'Velg bruker(e)',
    'Which users will receive the message?'       => 'Hvilke brukere skal motta meldingen?',
    'Which user groups will receive the message?' => 'Hvilke brukergrupper skal motta meldingen?',
    'Twig Snippet to Determine Recipients'        => 'Twig-utdrag for å bestemme mottakere',

    // Recipients tab: per-provider pickers
    'Select Slack channel(s)'                           => 'Velg Slack-kanal(er)',
    'Which Slack channels should receive this message?' => 'Hvilke Slack-kanaler skal motta denne meldingen?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Ingen Slack-kanaler konfigurert. Legg til en i [Innstillinger → Slack]({url}).',
    'Select ntfy topic(s)'                              => 'Velg ntfy-emne(r)',
    'Which ntfy topics should receive this message?'    => 'Hvilke ntfy-emner skal motta denne meldingen?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'Ingen ntfy-emner konfigurert. Legg til ett i [Innstillinger → ntfy]({url}).',
    'Select Bluesky account(s)'                         => 'Velg Bluesky-konto(er)',
    'Which Bluesky accounts should post this message?'  => 'Hvilke Bluesky-kontoer skal publisere denne meldingen?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Ingen Bluesky-kontoer konfigurert. Legg til en i [Innstillinger → Bluesky]({url}).',

    // Settings: page chrome
    'Notifier Settings' => 'Notifier-innstillinger',
    'General'           => 'Generelt',
    'Twilio'            => 'Twilio',
    'Pushover'          => 'Pushover',
    'Slack'             => 'Slack',
    'Bluesky'           => 'Bluesky',
    'ntfy'              => 'ntfy',

    // Settings: Logging
    'Logging'                             => 'Logging',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier fører en løpende logg over sendte meldinger. Det er vanligvis ikke nødvendig, men du kan begrense antall logghendelser som lagres i databasen.',
    'Enable Logging'                      => 'Aktiver logging',
    'When disabled, Notifier will not write anything to the notification log.' => 'Når deaktivert, skriver Notifier ingenting til varslingsloggen.',
    'Number of days to retain log events' => 'Antall dager logghendelser skal beholdes',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Behold logghendelser i høyst dette antall dager. La stå tomt for ingen grense.',
    'Number of log events to retain'      => 'Antall logghendelser som skal beholdes',
    'At most, keep this many log events. Leave blank for no limit.' => 'Behold høyst dette antall logghendelser. La stå tomt for ingen grense.',

    // Settings: Twilio
    'Twilio API Credentials'                       => 'Twilio API-legitimasjon',
    'If using the Twilio API to send SMS messages, the following credentials are required.' => 'Hvis du bruker Twilio API til å sende SMS, kreves følgende legitimasjon.',
    'Twilio Account SID'                           => 'Twilio Account SID',
    'Twilio Auth Token'                            => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)' => 'Twilio-telefonnummer (sender hver SMS-melding)',
    'SMS Testing'                                  => 'SMS-testing',
    'Optional. When set, every SMS dispatched will be sent to this number instead of the resolved recipient.' => 'Valgfritt. Hvis satt, sendes hver SMS til dette nummeret i stedet for den faktiske mottakeren.',
    'Test phone number'                            => 'Testtelefonnummer',

    // Settings: Pushover
    "[Pushover](https://pushover.net) sends push notifications to a registered user's devices. Each Craft user needs a custom field on their profile storing their Pushover user key; you select which field on each Notification's Message tab. For full setup instructions, see the [Pushover getting-started docs](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover)." => '[Pushover](https://pushover.net) sender push-varsler til en registrert brukers enheter. Hver Craft-bruker trenger et tilpasset felt på profilen sin som lagrer Pushover-nøkkelen; du velger hvilket felt på Melding-fanen for hvert varsel. For fullstendige oppsettsinstruksjoner, se [Pushover-kom-i-gang-dokumentasjonen](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover).',
    'Application API Token'                                      => 'API-token for applikasjon',
    'The 30-character app token from your Pushover application.' => '30-tegns app-token fra Pushover-applikasjonen din.',

    // Settings: ntfy
    'ntfy.sh is a free HTTP-based push notification service. Subscribers receive messages on the ntfy app, web, or any compatible client by joining a topic.' => 'ntfy.sh er en gratis HTTP-basert push-varslingstjeneste. Abonnenter mottar meldinger i ntfy-appen, på nettet eller via en kompatibel klient ved å bli med på et emne.',
    'Server URL'   => 'Server-URL',
    'Access token' => 'Tilgangstoken',
    'ntfy Topics'  => 'ntfy-emner',
    'Topics'       => 'Emner',
    'Topic'        => 'Emne',
    'Add a topic'  => 'Legg til et emne',

    // Settings: Slack
    'Slack Channels' => 'Slack-kanaler',
    'Create a [Slack app](https://api.slack.com/apps) with the `chat:write`, `chat:write.customize`, and `chat:write.public` scopes, then add a row for each channel you\'d like to post into. Each channel becomes available as a recipient on the **Recipients** tab when configuring a notification. A bot token is a secret, so store it in a `.env` variable and reference that variable (e.g. `$SLACK_BOT_TOKEN`) rather than pasting the token directly.' => 'Opprett en [Slack-app](https://api.slack.com/apps) med scope-ene `chat:write`, `chat:write.customize` og `chat:write.public`, og legg så til en rad for hver kanal du vil poste i. Hver kanal blir tilgjengelig som mottaker på fanen **Mottakere** når du konfigurerer en notifikasjon. Et bot-token er en hemmelighet, så lagre det i en `.env`-variabel og referer til den variabelen (f.eks. `$SLACK_BOT_TOKEN`) i stedet for å lime inn tokenet direkte.',
    'Channels'       => 'Kanaler',
    'Add a channel'  => 'Legg til en kanal',
    'Bot Token' => 'Bot-token',
    'Channel ID' => 'Kanal-ID',
    'Bot Emoji' => 'Ikon-emoji',
    'Bot Name' => 'Brukernavn',
    'Whether Slack should unfurl link previews for URLs in the message body.' => 'Om Slack skal vise koblingsforhåndsvisninger for URL-er i meldingsteksten.',
    'Not a valid Bot Token. Must start with `xoxb-`.' => 'Ugyldig bot-token. Må starte med `xoxb-`.',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => 'Ugyldig kanal-ID. Må se ut som `C01234ABCD`.',
    'Unable to send Slack message, no bot token.' => 'Kan ikke sende Slack-melding: ingen bot-token.',
    'Unable to send Slack message, no channel ID.' => 'Kan ikke sende Slack-melding: ingen kanal-ID.',
    'Recipient "{name}" has no Slack bot token.' => 'Mottakeren "{name}" har ingen Slack bot-token.',
    'Recipient "{name}" has no Slack channel ID.' => 'Mottakeren "{name}" har ingen Slack kanal-ID.',
    'Slack rejected the message: {error}' => 'Slack avviste meldingen: {error}',

    // Settings: Bluesky
    "[Bluesky](https://bsky.app) posts publish to the configured account's feed via the ATProto API. App passwords are generated at [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). An app password is a secret, so store it in a `.env` variable and reference that variable (e.g. `\$BLUESKY_APP_PASSWORD`) rather than pasting the password directly." => '[Bluesky](https://bsky.app)-innlegg publiseres til den konfigurerte kontoens feed via ATProto-API. App-passord genereres på [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). Et app-passord er en hemmelighet, så lagre det i en `.env`-variabel og referer til den variabelen (f.eks. `$BLUESKY_APP_PASSWORD`) i stedet for å lime inn passordet direkte.',
    'PDS URL'          => 'PDS-URL',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'Standard er https://bsky.social. Pek på en egendefinert PDS hvis installasjonen din federerer.',
    'Bluesky Accounts' => 'Bluesky-kontoer',
    'Accounts'         => 'Kontoer',
    'Label'            => 'Etikett',
    'Handle'           => 'Handle',
    'App password'     => 'App-passord',
    'Add an account'   => 'Legg til en konto',

    // Test notification (UI)
    'Send a test message'           => 'Send en testmelding',
    'Send a REAL test notification?\\n\\n⚠️ Uses a random sample of real data.\\n⚠️ Sends a real message via the configured channel.\\n⚠️ Delivers to the real configured recipient(s).' => 'Send et EKTE testvarsel?\\n\\n⚠️ Bruker et tilfeldig utvalg av ekte data.\\n⚠️ Sender en ekte melding via den konfigurerte kanalen.\\n⚠️ Leveres til de ekte konfigurerte mottakerne.',
    'Test'                          => 'Test',
    'Test notification dispatched.' => 'Testvarsel sendt.',
    'No messages were dispatched. Check the recipient configuration.' => 'Ingen meldinger ble sendt. Sjekk mottakerkonfigurasjonen.',
    'Unable to send test: the feed could not be read or has no items.' => 'Kan ikke sende test: feeden kunne ikke leses eller har ingen elementer.',
    'Unable to send test: no element matches the configured filters.' => 'Kan ikke sende test: ingen element samsvarer med de konfigurerte filtrene.',

    // Settings: save / test action responses
    "Couldn't save settings."                 => 'Klarte ikke å lagre innstillingene.',
    'Settings saved.'                         => 'Innstillinger lagret.',
    'Topic is empty.'                         => 'Emnet er tomt.',
    'Server URL is not configured.'           => 'Server-URL er ikke konfigurert.',
    'Test message from Notifier.'             => 'Testmelding fra Notifier.',
    'HTTP {status}'                           => 'HTTP {status}',
    'Test message sent successfully.'         => 'Testmelding sendt.',
    'Handle and app password are required.'   => 'Handle og app-passord kreves.',
    'Authentication failed.'                  => 'Autentisering mislyktes.',
    'Successfully authenticated. No messages were posted.' => 'Autentisering vellykket. Ingen meldinger ble publisert.',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.'          => 'Sender {messageType} til {recipient}.',
    'Adding message to queue.'                       => 'Legger meldingen i køen.',
    'Unable to parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => 'Kan ikke parse feeden. PHP-utvidelsene `simplexml` og `libxml` er påkrevd.',
    'Unable to parse the feed.' => 'Kan ikke parse feeden.',
    'Unable to fetch the feed: {message}' => 'Kan ikke hente feeden: {message}',
    'Initial feed scan failed: {message}' => 'Innledende feed-skanning mislyktes: {message}',
    'Sending message immediately (bypassing queue).' => 'Sender meldingen umiddelbart (hopper over køen).',
    'Log events deleted.'                            => 'Logghendelser slettet.',
    'notification'                                   => 'varsel',

    // Outbound: Email log messages
    'Unable to send email, no recipient specified.'     => 'Kan ikke sende e-post, ingen mottaker angitt.',
    'Unable to send email, the message body was empty.' => 'Kan ikke sende e-post, meldingsteksten var tom.',
    "Unable to send the email using Craft's native email handling." => 'Kan ikke sende e-posten med Crafts innebygde e-posthåndtering.',
    'Check your general email settings within Craft.'   => 'Sjekk de generelle e-postinnstillingene i Craft.',
    'Successfully sent email message!'                  => 'E-postmelding sendt!',

    // Outbound: SMS log messages
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[Ugyldig Twilio-legitimasjon.]({url}) Mangler {missing}.',
    'Unable to send SMS, no Twilio phone number exists.'      => 'Kan ikke sende SMS, ingen Twilio-telefonnummer eksisterer.',
    'Unable to send SMS, no recipient phone number exists.'   => 'Kan ikke sende SMS, ingen mottakertelefonnummer eksisterer.',
    'Unable to send SMS, recipient phone number is invalid.'  => 'Kan ikke sende SMS, mottakerens telefonnummer er ugyldig.',
    'Successfully sent SMS message!'                          => 'SMS-melding sendt!',

    // Outbound: Announcement log messages
    'Unable to post announcement, no recipient userId specified.' => 'Kan ikke publisere kunngjøring: ingen mottaker-userId angitt.',
    'Successfully posted announcement!' => 'Kunngjøring publisert!',

    // Outbound: Flash log messages
    'Unable to send the flash message, invalid flash type.' => 'Kan ikke sende flash-meldingen, ugyldig flash-type.',
    'Successfully sent flash message!'                      => 'Flash-melding sendt!',

    // Outbound: Pushover log messages
    '[Invalid Pushover credentials.]({url}) Missing app token.'  => '[Ugyldig Pushover-legitimasjon.]({url}) App-token mangler.',
    'Unable to send Pushover message, no user key on recipient.' => 'Kan ikke sende Pushover-melding: ingen brukernøkkel på mottakeren.',
    'Pushover POST failed: {reason}'                             => 'Pushover POST mislyktes: {reason}',
    'Successfully sent Pushover message!'                        => 'Pushover-melding sendt!',

    // Outbound: ntfy log messages
    'Unable to send ntfy message, no topic specified.'       => 'Kan ikke sende ntfy-melding: intet emne angitt.',
    'ntfy POST failed with HTTP {status}: {reason}'          => 'ntfy POST mislyktes med HTTP {status}: {reason}',
    'ntfy POST failed: {reason}'                             => 'ntfy POST mislyktes: {reason}',
    'Successfully sent ntfy message to topic "{topic}".'     => 'ntfy-melding sendt til emnet "{topic}".',

    // Outbound: Slack log messages
    'Unable to send Slack message, body is empty.'  => 'Kan ikke sende Slack-melding: innholdet er tomt.',
    'Slack POST failed: {reason}'                   => 'Slack POST mislyktes: {reason}',
    'Successfully sent Slack message to "{label}".' => 'Slack-melding sendt til "{label}".',

    // Outbound: Bluesky log messages
    'Unable to send Bluesky post, recipient is missing credentials.' => 'Kan ikke sende Bluesky-innlegg: mottakeren mangler legitimasjon.',
    'Body exceeded {max} characters, truncated.'          => 'Innholdet oversteg {max} tegn og ble kuttet.',
    'Successfully posted to Bluesky as "{label}".'        => 'Publisert til Bluesky som "{label}".',
    'Bluesky auth failed for {handle}: {reason}'          => 'Bluesky-autentisering mislyktes for {handle}: {reason}',
    'Bluesky auth failed: {reason}'                       => 'Bluesky-autentisering mislyktes: {reason}',
    'Bluesky post failed: {reason}'                       => 'Bluesky-innlegg mislyktes: {reason}',
    'Bluesky link preview skipped: {reason}'              => 'Bluesky-lenkeforhåndsvisning hoppet over: {reason}',

    // Recipient-strategy warnings
    'Recipient "{name}" has no email address.'       => 'Mottakeren "{name}" har ingen e-postadresse.',
    'Recipient "{name}" has no phone number.'        => 'Mottakeren "{name}" har intet telefonnummer.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => 'Mottakeren "{name}" har ingen tilknyttet bruker; kunngjøringen kan ikke sendes.',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => 'Mottakeren "{name}" har ikke tilgang til kontrollpanelet; kunngjøringen kan ikke sendes.',
    'Pushover user-key field is not configured on this notification.' => 'Pushover-brukernøkkelfeltet er ikke konfigurert på dette varselet.',
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => 'Mottakeren "{name}" har ingen tilknyttet bruker; Pushover-melding kan ikke sendes.',
    '[SKIPPED] User "{name}" has no Pushover key.'   => '[HOPPET OVER] Brukeren "{name}" har ingen Pushover-nøkkel.',
    'Recipient "{name}" has no ntfy topic.'          => 'Mottakeren "{name}" har intet ntfy-emne.',
    'Recipient "{name}" has no Bluesky credentials.' => 'Mottakeren "{name}" har ingen Bluesky-legitimasjon.',

    // Errors / exceptions
    'Invalid element event: {class}'                         => 'Ugyldig elementhendelse: {class}',
    'Invalid notification ID: {id}'                          => 'Ugyldig varsel-ID: {id}',
    'Invalid email message mode.'                            => 'Ugyldig e-postmeldingsmodus.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Du har ikke tillatelse til å bruke typen Dynamiske mottakere.',
    'Dynamic recipients snippet did not call setRecipients.' => 'Utdrag for dynamiske mottakere kalte ikke setRecipients.',
    'setRecipients was called with an empty value.'          => 'setRecipients ble kalt med en tom verdi.',
    'Unrecognized recipient of type "{type}".'               => 'Ukjent mottaker av typen "{type}".',
    'Unrecognized recipient "{value}".'                      => 'Ukjent mottaker "{value}".',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => 'Konfigurert {kind} finnes ikke lenger i innstillingene for tilleggsmodulen (uid: {uid}).',
    'Invalid settings section: {section}'                    => 'Ugyldig innstillingsseksjon: {section}',
    'User not authorized to save this notification.'         => 'Brukeren har ikke tillatelse til å lagre dette varselet.',
    'User not authorized to view this notification.'         => 'Brukeren har ikke tillatelse til å vise dette varselet.',
    'User not authorized to delete this notification.'       => 'Brukeren har ikke tillatelse til å slette dette varselet.',
    'Notification not found'                                 => 'Varsel ikke funnet',

    // Misc config-file note
    'This is being set in the config file. [{file}]' => 'Dette settes i konfigurasjonsfilen. [{file}]',

    // Slack, ntfy, and Bluesky message types
    "Add the Bluesky accounts you'd like to post from. Each account becomes available as a recipient on the **Recipients** tab when configuring a notification." => 'Legg til Bluesky-kontoene du vil publisere fra. Hver konto blir tilgjengelig som mottaker på **Mottakere**-fanen når du konfigurerer et varsel.',
    "Click any row's **Test** button to confirm the account authenticates." => 'Klikk på **Test**-knappen på en rad for å bekrefte at kontoen autentiseres.',
    "Click any row's **Test** button to send a quick test message to that channel." => 'Klikk på **Test**-knappen på en rad for å sende en rask testmelding til den kanalen.',
    "Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`." => 'Valgfritt. Pek på en selvhostet ntfy-instans hvis aktuelt. Standard er `https://ntfy.sh`.',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Valgfritt. Kreves for beskyttede emner eller selvhostede instanser med autentisering.',
    "Add the ntfy topics you'd like to send messages to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification." => 'Legg til ntfy-emnene du vil sende meldinger til. Hvert emne blir tilgjengelig som mottaker på **Mottakere**-fanen når du konfigurerer et varsel.',
    "Click any row's **Test** button to send a quick test message to that topic." => 'Klikk på **Test**-knappen på en rad for å sende en rask testmelding til det emnet.',
    'Enable Markdown' => 'Aktiver Markdown',

    // Manual triggers
    'Send Notification'                                            => 'Send varsel',
    'Send manual notifications'                                    => 'Send manuelle varsler',
    'Are you sure you want to send this notification?'             => 'Er du sikker på at du vil sende dette varselet?',
    'This notification cannot be triggered manually.'              => 'Dette varselet kan ikke utløses manuelt.',
    'This notification no longer applies to the selected element.' => 'Dette varselet gjelder ikke lenger for det valgte elementet.',
    'Notification was not sent. Check the Notification Log for details.' => 'Varselet ble ikke sendt. Sjekk Varslingsloggen for detaljer.',
    'Notification sent.'                                           => 'Varsel sendt.',
    'Element not found'                                            => 'Fant ikke elementet',
    'Trigger Label'                                                => 'Etikett for utløser',
    'An element action label (helps to differentiate multiple triggers).'        => 'En etikett for elementhandlingen (hjelper med å skille flere utløsere).',

    // Event tab: date trigger
    'On'                                                          => 'På',
    'days before'                                                 => 'dager før',
    'days after'                                                  => 'dager etter',
    'Relevant Date'                                               => 'Relevant dato',
    'Send the notification relative to a chosen date.'            => 'Send varselet i forhold til en valgt dato.',

    // Scheduled sending
    'Scheduled Sending' => 'Planlagt sending',
    'Shared secret for authenticating scheduled-run web requests. Required only when the schedule is triggered via the web endpoint.' => 'Delt hemmelighet for å autentisere webforespørsler om planlagt kjøring. Kreves bare når planen utløses via webendepunktet.',
    'Scheduled-Run Token' => 'Token for planlagt kjøring',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => 'Sendes med hver forespørsel som headeren X-Notifier-Token eller som parameteren token i meldingsteksten.',
    'Pushover Title' => 'Pushover-tittel',
    'Pushover Body' => 'Pushover-tekst',
    'ntfy Title' => 'ntfy-tittel',
    'ntfy Body' => 'ntfy-tekst',
    'ntfy Link URL' => 'ntfy-lenke-URL',
    'Render Link Previews' => 'Vis lenkeforhåndsvisninger',
    'Don\'t unfurl' => 'Ikke utvid',
    'Expand link previews' => 'Utvid lenkeforhåndsvisninger',
    'Regular text only' => 'Kun vanlig tekst',
    'Markdown enabled' => 'Markdown aktivert',
    'Dynamic Pushover Title' => 'Dynamisk Pushover-tittel',
    'Dynamic Subject Line' => 'Dynamisk emnelinje',
    'Dynamic Bot Name' => 'Dynamisk botnavn',
    'Dynamic ntfy Title' => 'Dynamisk ntfy-tittel',
    'Dynamic Announcement Title' => 'Dynamisk kunngjøringstittel',
    'Dynamic Flash Message Title' => 'Dynamisk Flash-meldingstittel',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => 'Ren tekst, maks 300 tegn. URL-er og `@handle.tld`-omtaler blir automatisk lenker.',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => 'Generer automatisk et forhåndsvisningskort når innleggets tekst inneholder en URL.',
    'Whether the message be sent via the [jobs queue]({queueUrl}).' => 'Om meldingen skal sendes via [jobbkøen]({queueUrl}).',
    'Priority level of the ntfy message.' => 'Prioritetsnivå for ntfy-meldingen.',
    'Optionally include comma-separated [emoji shortcodes](https://docs.ntfy.sh/emojis/).' => 'Inkluder eventuelt kommaseparerte [emojikoder](https://docs.ntfy.sh/emojis/).',
    'Body of the ntfy notification.' => 'Innhold i ntfy-varselet.',
    'Optionally open a URL when the notification is clicked.' => 'Åpne eventuelt en URL når varselet klikkes.',
    'Whether to parse the body as Markdown in supported clients.' => 'Om innholdet skal tolkes som Markdown i klienter som støtter det.',
    'Heading of the announcement.' => 'Overskrift på kunngjøringen.',
    'Body of the announcement. Supports Markdown.' => 'Innhold i kunngjøringen. Støtter Markdown.',
    'Heading of the flash message.' => 'Overskrift på flash-meldingen.',
    'Optionally include details below the heading. Supports Markdown and HTML.' => 'Inkluder eventuelt detaljer under overskriften. Støtter Markdown og HTML.',
    'Optionally include a heading above the body.' => 'Inkluder eventuelt en overskrift over innholdet.',
    'Body of the SMS (text message). Plain text only.' => 'Innhold i SMS-en (tekstmelding). Kun ren tekst.',
    'Body of the Pushover notification. Plain text only.' => 'Innhold i Pushover-varselet. Kun ren tekst.',
    'Subject line of the email.' => 'Emnelinje for e-posten.',
    'Body of the email. Supports HTML.' => 'Innhold i e-posten. Støtter HTML.',
    'Optionally override the app\'s display name.' => 'Overstyr eventuelt appens visningsnavn.',
    'Optionally override the app\'s icon with a URL.' => 'Overstyr eventuelt appens ikon med en URL.',
    'Optionally override the app\'s icon with an emoji. Used only when Bot Icon URL is empty.' => 'Overstyr eventuelt appens ikon med en emoji. Brukes kun når Bot Icon URL er tomt.',
    'Invalid Slack body format.' => 'Ugyldig Slack-innholdsformat.',
    'Supports standard [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) syntax. Optionally supports HTML _(see below)_.' => 'Støtter standard [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting)-syntaks. Støtter valgfritt HTML _(se nedenfor)_.',
    'Render Message Body as HTML' => 'Vis meldingsinnhold som HTML',
    'Whether to only parse as [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), or additionally parse it as HTML.' => 'Velg om kun [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) skal parses, eller om HTML også skal parses.',
    'mrkdwn only' => 'kun mrkdwn',
    'mrkdwn + HTML' => 'mrkdwn + HTML',
];
