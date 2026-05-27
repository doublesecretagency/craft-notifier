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
    'Notifications'          => 'Ilmoitukset',
    'Notification'           => 'Ilmoitus',
    'All notifications'      => 'Kaikki ilmoitukset',
    'Notification Log'       => 'Ilmoitusloki',
    'Logs'                   => 'Lokit',
    'View Notifications'     => 'Näytä ilmoitukset',
    'Add a New Notification' => 'Lisää uusi ilmoitus',

    // Permissions
    'View notifications'              => 'Näytä ilmoitukset',
    'Save notifications'              => 'Tallenna ilmoitukset',
    'Use the Dynamic Recipients type' => 'Käytä Dynaamiset vastaanottajat -tyyppiä',
    'Test notifications'              => 'Testaa ilmoituksia',
    'Delete notifications'            => 'Poista ilmoituksia',
    'View notification log'           => 'Näytä ilmoitusloki',
    'Delete notification log'         => 'Poista ilmoitusloki',

    // Notification editor: tabs
    'Meta'       => 'Meta',
    'Event'      => 'Tapahtuma',
    'Message'    => 'Viesti',
    'Recipients' => 'Vastaanottajat',

    // Event tab: type selector
    'Event Type'                                           => 'Tapahtumatyyppi',
    'What type of event will activate the notification?'   => 'Minkä tyyppinen tapahtuma aktivoi ilmoituksen?',
    'Which specific event will activate the notification?' => 'Mikä tarkka tapahtuma aktivoi ilmoituksen?',

    // Event tab: event types
    'Assets Event'                   => 'Asset-tapahtuma',
    'Commerce Orders Event'          => 'Commerce-tilaustapahtuma',
    'Commerce Products Event'        => 'Commerce-tuotetapahtuma',
    'Digital Products Event'         => 'Digital Products -tapahtuma',
    'Digital Product Licenses Event' => 'Digital Products -lisenssitapahtuma',
    'Solspace Calendar Event'        => 'Solspace Calendar -tapahtuma',
    'Entries Event'                  => 'Merkintätapahtuma',
    'Users Event'                    => 'Käyttäjätapahtuma',
    'Ungrouped Users'                => 'Käyttäjät ilman ryhmää',

    // Feed
    'Feed URL' => 'Syötteen URL',
    'The URL of the RSS, Atom, or JSON feed to watch.' => 'Seurattavan RSS-, Atom- tai JSON-syötteen URL.',
    // Field and element conditions
    'Field Conditions'             => 'Kenttäehdot',
    'Send the message only when the saved element matches the following conditions.' => 'Lähetä viesti vain, kun tallennettu elementti vastaa seuraavia ehtoja.',
    'has changed'                  => 'on muuttunut',
    '#{elementType} Event Filters' => 'Tapahtumasuodattimet kohteelle #{elementType}',
    'No filters match this event.' => 'Mikään suodatin ei vastaa tätä tapahtumaa.',
    'Determine whether each message should be sent based on specified conditions.' => 'Määritä määriteltyjen ehtojen perusteella, lähetetäänkö kukin viesti.',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => 'Elementti tallennetaan ensimmäistä kertaa',
    'Must be a new entry'                       => 'On oltava uusi merkintä',
    'Must be an existing entry'                 => 'On oltava olemassa oleva merkintä',
    'Can be existing or new'                    => 'Voi olla olemassa oleva tai uusi',

    // Filters: new elements
    'Element is new'         => 'Elementti on uusi',
    'New elements only'      => 'Vain uudet elementit',
    'Existing elements only' => 'Vain olemassa olevat elementit',

    // Filters: enabled state
    'Element is enabled'         => 'Elementti on käytössä',
    'Must be enabled'            => 'On oltava käytössä',
    'Must be disabled'           => 'On oltava pois käytöstä',
    'Can be enabled or disabled' => 'Voi olla käytössä tai pois käytöstä',

    // Filters: drafts
    'Element is a draft'          => 'Elementti on luonnos',
    'Must be a draft'             => 'On oltava luonnos',
    'Must not be a draft'         => 'Ei saa olla luonnos',
    'Can be a draft or non-draft' => 'Voi olla luonnos tai ei',

    // Filters: provisional drafts
    'Element is a provisional draft'                => 'Elementti on alustava luonnos',
    'Must be a provisional draft'                   => 'On oltava alustava luonnos',
    'Must not be a provisional draft'               => 'Ei saa olla alustava luonnos',
    'Can be a provisional draft or non-provisional' => 'Voi olla alustava luonnos tai ei',

    // Filters: revisions
    'Element is a revision'             => 'Elementti on versio',
    'Must be a revision'                => 'On oltava versio',
    'Must not be a revision'            => 'Ei saa olla versio',
    'Can be a revision or non-revision' => 'Voi olla versio tai ei',

    // Filters: duplication
    'Element is being duplicated'         => 'Elementtiä monistetaan',
    'Must be duplicating the element'     => 'Elementtiä on monistettava',
    'Must not be duplicating the element' => 'Elementtiä ei saa monistaa',

    // Filters: propagation
    'Element is being propagated'     => 'Elementtiä siirretään muille sivustoille',
    'Element must be propagating'     => 'Elementin on oltava siirtymässä',
    'Element must not be propagating' => 'Elementti ei saa olla siirtymässä',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => 'Elementti tallennetaan uudelleen massana',
    'Must be bulk-resaving the element'     => 'Elementti on tallennettava uudelleen massana',
    'Must not be bulk-resaving the element' => 'Elementtiä ei saa tallentaa uudelleen massana',

    // Filters: common output
    'Unnamed filter'                => 'Nimetön suodatin',
    'Must be TRUE to send message'  => 'On oltava TRUE viestin lähettämiseksi',
    'Must be FALSE to send message' => 'On oltava FALSE viestin lähettämiseksi',
    'No effect'                     => 'Ei vaikutusta',

    // Message tab: type selector and queue
    'Message Type'                       => 'Viestin tyyppi',
    'What type of message will be sent?' => 'Minkä tyyppinen viesti lähetetään?',
    'Send Message via Queue'             => 'Lähetä viesti jonon kautta',
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are also supported.' => '[Mallintaminen]({templatingUrl}) ja [erityismuuttujat]({variablesUrl}) ovat myös tuettuja.',
    'Send immediately' => 'Lähetä välittömästi',
    'Add to queue' => 'Lisää jonoon',

    // Message tab: Email fields
    "User's Email Address Field" => 'Käyttäjän sähköpostikenttä',
    'Email Subject'              => 'Sähköpostin aihe',
    'Email Body'                 => 'Sähköpostin sisältö',

    // Message tab: SMS fields
    "User's Phone Number Field" => 'Käyttäjän puhelinkenttä',
    'SMS Message Body'          => 'SMS-viestin sisältö',

    // Message tab: Announcement fields
    'Announcement Title'   => 'Ilmoituksen otsikko',
    'Announcement Message' => 'Ilmoituksen viesti',

    // Message tab: Flash fields
    'Flash Message Type'                         => 'Flash-viestin tyyppi',
    'Flash Message Title'                        => 'Flash-viestin otsikko',
    'Flash Message Details'                      => 'Flash-viestin tiedot',
    'Which type of flash message should appear?' => 'Minkä tyyppinen flash-viesti näytetään?',

    // Message tab: Pushover fields
    "Field containing each user's Pushover key" => 'Käyttäjän Pushover-avainkenttä',

    // Message tab: ntfy fields
    'Priority'           => 'Prioriteetti',
    'Tags'               => 'Tunnisteet',

    // Message tab: Slack fields
    'Slack Message Body' => 'Slack-viestin sisältö',
    'Bot Icon URL' => 'Kuvakkeen URL',

    // Message tab: Bluesky fields
    'Post Body' => 'Julkaisun sisältö',
    'Generate Link Preview' => 'Luo linkin esikatselu',
    'No card' => 'Ei korttia',
    'Generate preview card' => 'Luo esikatselukortti',

    // Message tab: Title / Body / Trix toolbar
    'Rich Text'     => 'Rikastettu teksti',
    'Bold'          => 'Lihavoitu',
    'Italic'        => 'Kursivoitu',
    'Underline'     => 'Alleviivattu',
    'Strikethrough' => 'Yliviivattu',
    'Bullets'       => 'Luettelo',
    'Numbers'       => 'Numerointi',
    'Heading'       => 'Otsikko',
    'Code'          => 'Koodi',
    'Undo'          => 'Kumoa',
    'Redo'          => 'Tee uudelleen',

    // Recipients tab: common
    'Recipients Type'                             => 'Vastaanottajatyyppi',
    'Who will receive this message?'              => 'Kuka vastaanottaa tämän viestin?',
    'Add a message recipient'                     => 'Lisää vastaanottaja',
    'Select User(s)'                              => 'Valitse käyttäjä(t)',
    'Which users will receive the message?'       => 'Mitkä käyttäjät vastaanottavat viestin?',
    'Which user groups will receive the message?' => 'Mitkä käyttäjäryhmät vastaanottavat viestin?',
    'Twig Snippet to Determine Recipients'        => 'Twig-katkelma vastaanottajien määrittämiseen',

    // Recipients tab: per-provider pickers
    'Select Slack channel(s)'                           => 'Valitse Slack-kanava(t)',
    'Which Slack channels should receive this message?' => 'Mitkä Slack-kanavat vastaanottavat tämän viestin?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Slack-kanavia ei ole määritetty. Lisää sellainen kohdassa [Asetukset → Slack]({url}).',
    'Select ntfy topic(s)'                              => 'Valitse ntfy-aihe(et)',
    'Which ntfy topics should receive this message?'    => 'Mitkä ntfy-aiheet vastaanottavat tämän viestin?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'ntfy-aiheita ei ole määritetty. Lisää sellainen kohdassa [Asetukset → ntfy]({url}).',
    'Select Bluesky account(s)'                         => 'Valitse Bluesky-tili(t)',
    'Which Bluesky accounts should post this message?'  => 'Mitkä Bluesky-tilit julkaisevat tämän viestin?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Bluesky-tilejä ei ole määritetty. Lisää sellainen kohdassa [Asetukset → Bluesky]({url}).',

    // Settings: page chrome
    'Notifier Settings' => 'Notifier-asetukset',
    'General'           => 'Yleiset',
    'Twilio'            => 'Twilio',
    'Pushover'          => 'Pushover',
    'Slack'             => 'Slack',
    'Bluesky'           => 'Bluesky',
    'ntfy'              => 'ntfy',

    // Settings: Logging
    'Logging'                             => 'Lokitus',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier pitää jatkuvaa lokia lähetetyistä viesteistä. Yleensä se ei ole tarpeen, mutta voit rajoittaa tietokantaan tallennettujen lokitapahtumien määrää.',
    'Enable Logging'                      => 'Ota lokitus käyttöön',
    'When disabled, Notifier will not write anything to the notification log.' => 'Kun pois käytöstä, Notifier ei kirjoita ilmoituslokiin.',
    'Number of days to retain log events' => 'Lokitapahtumien säilytyspäivien määrä',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Säilytä lokitapahtumia enintään näin monta päivää. Tyhjä tarkoittaa ei rajaa.',
    'Number of log events to retain'      => 'Säilytettävien lokitapahtumien määrä',
    'At most, keep this many log events. Leave blank for no limit.' => 'Säilytä enintään tämä määrä lokitapahtumia. Tyhjä tarkoittaa ei rajaa.',

    // Settings: Twilio
    'Twilio API Credentials'                       => 'Twilion API-tunnistetiedot',
    'If using the Twilio API to send SMS messages, the following credentials are required.' => 'Jos SMS-viestejä lähetetään Twilion API:n kautta, seuraavat tunnistetiedot ovat pakollisia.',
    'Twilio Account SID'                           => 'Twilio Account SID',
    'Twilio Auth Token'                            => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)' => 'Twilio-puhelinnumero (lähettää jokaisen SMS-viestin)',
    'SMS Testing'                                  => 'SMS-testaus',
    'Optional. When set, every SMS dispatched will be sent to this number instead of the resolved recipient.' => 'Valinnainen. Asetettuna jokainen lähetetty SMS lähetetään tähän numeroon todellisen vastaanottajan sijaan.',
    'Test phone number'                            => 'Testipuhelinnumero',

    // Settings: Pushover
    "[Pushover](https://pushover.net) sends push notifications to a registered user's devices. Each Craft user needs a custom field on their profile storing their Pushover user key; you select which field on each Notification's Message tab. For full setup instructions, see the [Pushover getting-started docs](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover)." => '[Pushover](https://pushover.net) lähettää push-ilmoituksia rekisteröityneen käyttäjän laitteisiin. Jokainen Craft-käyttäjä tarvitsee profiilissaan mukautetun kentän, johon hänen Pushover-avaimensa tallennetaan. Valitse kenttä kunkin ilmoituksen Viesti-välilehdellä. Täydet käyttöönotto-ohjeet löytyvät [Pushover-aloituskäyttöoppaasta](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover).',
    'Application API Token'                                      => 'Sovelluksen API-tunniste',
    'The 30-character app token from your Pushover application.' => '30 merkin sovellustunniste Pushover-sovelluksestasi.',

    // Settings: ntfy
    'ntfy.sh is a free HTTP-based push notification service. Subscribers receive messages on the ntfy app, web, or any compatible client by joining a topic.' => 'ntfy.sh on ilmainen HTTP-pohjainen push-ilmoituspalvelu. Tilaajat saavat viestit ntfy-sovelluksessa, verkossa tai missä tahansa yhteensopivassa asiakassovelluksessa liittymällä aiheeseen.',
    'Server URL'   => 'Palvelimen URL',
    'Access token' => 'Käyttötunniste',
    'ntfy Topics'  => 'ntfy-aiheet',
    'Topics'       => 'Aiheet',
    'Topic'        => 'Aihe',
    'Add a topic'  => 'Lisää aihe',

    // Settings: Slack
    'Slack Channels' => 'Slack-kanavat',
    'Create a [Slack app](https://api.slack.com/apps) with the `chat:write`, `chat:write.customize`, and `chat:write.public` scopes, then add a row for each channel you\'d like to post into. Each channel becomes available as a recipient on the **Recipients** tab when configuring a notification. A bot token is a secret, so store it in a `.env` variable and reference that variable (e.g. `$SLACK_BOT_TOKEN`) rather than pasting the token directly.' => 'Luo [Slack-sovellus](https://api.slack.com/apps), jolla on oikeudet `chat:write`, `chat:write.customize` ja `chat:write.public`, ja lisää sitten rivi jokaiselle kanavalle, johon haluat lähettää viestejä. Jokainen kanava tulee saataville vastaanottajaksi **Vastaanottajat**-välilehdellä, kun määrität ilmoituksen. Bot-token on salainen, joten tallenna se `.env`-muuttujaan ja viittaa siihen (esim. `$SLACK_BOT_TOKEN`) sen sijaan, että liittäisit tokenin suoraan.',
    'Channels'       => 'Kanavat',
    'Add a channel'  => 'Lisää kanava',
    'Bot Token' => 'Bot-token',
    'Channel ID' => 'Kanavan tunnus',
    'Bot Emoji' => 'Kuvakkeen emoji',
    'Bot Name' => 'Käyttäjänimi',
    'Whether Slack should unfurl link previews for URLs in the message body.' => 'Pitäisikö Slackin avata linkkien esikatselut viestin sisällön URL-osoitteille.',
    'Not a valid Bot Token. Must start with `xoxb-`.' => 'Virheellinen bot-token. Täytyy alkaa `xoxb-`.',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => 'Virheellinen kanavan tunnus. Pitää näyttää `C01234ABCD`.',
    'Unable to send Slack message, no bot token.' => 'Slack-viestiä ei voi lähettää: ei bot-tokenia.',
    'Unable to send Slack message, no channel ID.' => 'Slack-viestiä ei voi lähettää: ei kanavan tunnusta.',
    'Recipient "{name}" has no Slack bot token.' => 'Vastaanottajalla "{name}" ei ole Slack-bot-tokenia.',
    'Recipient "{name}" has no Slack channel ID.' => 'Vastaanottajalla "{name}" ei ole Slack-kanavan tunnusta.',
    'Slack rejected the message: {error}' => 'Slack hylkäsi viestin: {error}',

    // Settings: Bluesky
    "[Bluesky](https://bsky.app) posts publish to the configured account's feed via the ATProto API. App passwords are generated at [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). An app password is a secret, so store it in a `.env` variable and reference that variable (e.g. `\$BLUESKY_APP_PASSWORD`) rather than pasting the password directly." => '[Bluesky](https://bsky.app)-julkaisut julkaistaan määritetyn tilin syötteeseen ATProto-API:n kautta. Sovellussalasanat luodaan osoitteessa [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). Sovellussalasana on salaisuus, joten tallenna se `.env`-muuttujaan ja viittaa kyseiseen muuttujaan (esim. `$BLUESKY_APP_PASSWORD`) sen sijaan, että liittäisit salasanan suoraan.',
    'PDS URL'          => 'PDS-URL',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'Oletus on https://bsky.social. Osoita mukautettuun PDS-instanssiin, jos asennuksesi federoituu.',
    'Bluesky Accounts' => 'Bluesky-tilit',
    'Accounts'         => 'Tilit',
    'Label'            => 'Otsikko',
    'Handle'           => 'Tunnus',
    'App password'     => 'Sovellussalasana',
    'Add an account'   => 'Lisää tili',

    // Test notification (UI)
    'Send a test message'           => 'Lähetä testiviesti',
    'Send a REAL test notification?\\n\\n⚠️ Uses a random sample of real data.\\n⚠️ Sends a real message via the configured channel.\\n⚠️ Delivers to the real configured recipient(s).' => 'Lähetetäänkö TODELLINEN testi-ilmoitus?\\n\\n⚠️ Käyttää satunnaista otosta todellisista tiedoista.\\n⚠️ Lähettää todellisen viestin määritetyn kanavan kautta.\\n⚠️ Toimitetaan todellisille määritetyille vastaanottajille.',
    'Test'                          => 'Testi',
    'Test notification dispatched.' => 'Testi-ilmoitus lähetetty.',
    'No messages were dispatched. Check the recipient configuration.' => 'Viestejä ei lähetetty. Tarkista vastaanottajakokoonpano.',
    'Unable to send test: the feed could not be read or has no items.' => 'Testiä ei voi lähettää: syötettä ei voitu lukea tai siinä ei ole kohteita.',
    'Unable to send test: no element matches the configured filters.' => 'Testiä ei voi lähettää: yksikään elementti ei vastaa määritettyjä suodattimia.',

    // Settings: save / test action responses
    "Couldn't save settings."                 => 'Asetuksia ei voitu tallentaa.',
    'Settings saved.'                         => 'Asetukset tallennettu.',
    'Topic is empty.'                         => 'Aihe on tyhjä.',
    'Server URL is not configured.'           => 'Palvelimen URL:ää ei ole määritetty.',
    'Test message from Notifier.'             => 'Testiviesti Notifierista.',
    'HTTP {status}'                           => 'HTTP {status}',
    'Test message sent successfully.'         => 'Testiviesti lähetetty onnistuneesti.',
    'Handle and app password are required.'   => 'Tunnus ja sovellussalasana ovat pakollisia.',
    'Authentication failed.'                  => 'Todennus epäonnistui.',
    'Successfully authenticated. No messages were posted.' => 'Todennus onnistui. Viestejä ei lähetetty.',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.'          => 'Lähetetään {messageType} kohteelle {recipient}.',
    'Adding message to queue.'                       => 'Lisätään viesti jonoon.',
    'Unable to parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => 'Syötettä ei voi jäsentää. PHP:n `simplexml`- ja `libxml`-laajennukset vaaditaan.',
    'Unable to parse the feed.' => 'Syötettä ei voi jäsentää.',
    'Unable to fetch the feed: {message}' => 'Syötettä ei voi hakea: {message}',
    'Initial feed scan failed: {message}' => 'Syötteen ensimmäinen tarkistus epäonnistui: {message}',
    'Sending message immediately (bypassing queue).' => 'Lähetetään viesti välittömästi (jono ohitetaan).',
    'Log events deleted.'                            => 'Lokitapahtumat poistettu.',
    'notification'                                   => 'ilmoitus',

    // Outbound: Email log messages
    'Unable to send email, no recipient specified.'     => 'Sähköpostia ei voi lähettää: vastaanottajaa ei ole määritetty.',
    'Unable to send email, the message body was empty.' => 'Sähköpostia ei voi lähettää: viestin sisältö oli tyhjä.',
    "Unable to send the email using Craft's native email handling." => 'Sähköpostia ei voi lähettää Craftin natiivilla sähköpostinkäsittelyllä.',
    'Check your general email settings within Craft.'   => 'Tarkista Craftin yleiset sähköpostiasetukset.',
    'Successfully sent email message!'                  => 'Sähköposti lähetetty!',

    // Outbound: SMS log messages
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[Virheelliset Twilio-tunnistetiedot.]({url}) Puuttuu: {missing}.',
    'Unable to send SMS, no Twilio phone number exists.'      => 'SMS:ää ei voi lähettää, Twilio-puhelinnumeroa ei ole.',
    'Unable to send SMS, no recipient phone number exists.'   => 'SMS:ää ei voi lähettää, vastaanottajan puhelinnumeroa ei ole.',
    'Unable to send SMS, recipient phone number is invalid.'  => 'SMS:ää ei voi lähettää, vastaanottajan puhelinnumero on virheellinen.',
    'Successfully sent SMS message!'                          => 'SMS-viesti lähetetty!',

    // Outbound: Announcement log messages
    'Unable to post announcement, no recipient userId specified.' => 'Ilmoitusta ei voi julkaista: vastaanottajan userId puuttuu.',
    'Successfully posted announcement!' => 'Ilmoitus julkaistu!',

    // Outbound: Flash log messages
    'Unable to send the flash message, invalid flash type.' => 'Flash-viestiä ei voi lähettää: virheellinen flash-tyyppi.',
    'Successfully sent flash message!'                      => 'Flash-viesti lähetetty!',

    // Outbound: Pushover log messages
    '[Invalid Pushover credentials.]({url}) Missing app token.'  => '[Virheelliset Pushover-tunnistetiedot.]({url}) Sovellustunniste puuttuu.',
    'Unable to send Pushover message, no user key on recipient.' => 'Pushover-viestiä ei voi lähettää, vastaanottajalla ei ole käyttäjäavainta.',
    'Pushover POST failed: {reason}'                             => 'Pushover POST epäonnistui: {reason}',
    'Successfully sent Pushover message!'                        => 'Pushover-viesti lähetetty!',

    // Outbound: ntfy log messages
    'Unable to send ntfy message, no topic specified.'       => 'ntfy-viestiä ei voi lähettää: aihetta ei ole määritetty.',
    'ntfy POST failed with HTTP {status}: {reason}'          => 'ntfy POST epäonnistui HTTP {status}: {reason}',
    'ntfy POST failed: {reason}'                             => 'ntfy POST epäonnistui: {reason}',
    'Successfully sent ntfy message to topic "{topic}".'     => 'ntfy-viesti lähetetty aiheelle "{topic}".',

    // Outbound: Slack log messages
    'Unable to send Slack message, body is empty.'  => 'Slack-viestiä ei voi lähettää: sisältö on tyhjä.',
    'Slack POST failed: {reason}'                   => 'Slack POST epäonnistui: {reason}',
    'Successfully sent Slack message to "{label}".' => 'Slack-viesti lähetetty kohteelle "{label}".',

    // Outbound: Bluesky log messages
    'Unable to send Bluesky post, recipient is missing credentials.' => 'Bluesky-julkaisua ei voi lähettää: vastaanottajalta puuttuvat tunnistetiedot.',
    'Body exceeded {max} characters, truncated.'          => 'Sisältö ylitti {max} merkkiä ja se typistettiin.',
    'Successfully posted to Bluesky as "{label}".'        => 'Julkaistu Blueskyssä nimellä "{label}".',
    'Bluesky auth failed for {handle}: {reason}'          => 'Bluesky-todennus epäonnistui käyttäjälle {handle}: {reason}',
    'Bluesky auth failed: {reason}'                       => 'Bluesky-todennus epäonnistui: {reason}',
    'Bluesky post failed: {reason}'                       => 'Bluesky-julkaisu epäonnistui: {reason}',
    'Bluesky link preview skipped: {reason}'              => 'Bluesky-linkin esikatselu ohitettu: {reason}',

    // Recipient-strategy warnings
    'Recipient "{name}" has no email address.'       => 'Vastaanottajalla "{name}" ei ole sähköpostiosoitetta.',
    'Recipient "{name}" has no phone number.'        => 'Vastaanottajalla "{name}" ei ole puhelinnumeroa.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => 'Vastaanottajalla "{name}" ei ole liitettyä käyttäjää; ilmoitusta ei voi lähettää.',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => 'Vastaanottaja "{name}" ei pääse hallintapaneeliin; ilmoitusta ei voi lähettää.',
    'Pushover user-key field is not configured on this notification.' => 'Pushover-käyttäjäavainkenttää ei ole määritetty tähän ilmoitukseen.',
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => 'Vastaanottajalla "{name}" ei ole liitettyä käyttäjää; Pushover-viestiä ei voi lähettää.',
    '[SKIPPED] User "{name}" has no Pushover key.'   => '[OHITETTU] Käyttäjällä "{name}" ei ole Pushover-avainta.',
    'Recipient "{name}" has no ntfy topic.'          => 'Vastaanottajalla "{name}" ei ole ntfy-aihetta.',
    'Recipient "{name}" has no Bluesky credentials.' => 'Vastaanottajalla "{name}" ei ole Bluesky-tunnistetietoja.',

    // Errors / exceptions
    'Invalid element event: {class}'                         => 'Virheellinen elementtitapahtuma: {class}',
    'Invalid notification ID: {id}'                          => 'Virheellinen ilmoitustunniste: {id}',
    'Invalid email message mode.'                            => 'Virheellinen sähköpostiviestin tila.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Sinulla ei ole oikeutta käyttää Dynaamiset vastaanottajat -tyyppiä.',
    'Dynamic recipients snippet did not call setRecipients.' => 'Dynaamisten vastaanottajien katkelma ei kutsunut setRecipients-funktiota.',
    'setRecipients was called with an empty value.'          => 'setRecipients kutsuttiin tyhjällä arvolla.',
    'Unrecognized recipient of type "{type}".'               => 'Tunnistamaton tyypin "{type}" vastaanottaja.',
    'Unrecognized recipient "{value}".'                      => 'Tunnistamaton vastaanottaja "{value}".',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => 'Määritettyä {kind}-kohdetta ei ole enää lisäosan asetuksissa (uid: {uid}).',
    'Invalid settings section: {section}'                    => 'Virheellinen asetusosa: {section}',
    'User not authorized to save this notification.'         => 'Käyttäjällä ei ole oikeutta tallentaa tätä ilmoitusta.',
    'User not authorized to view this notification.'         => 'Käyttäjällä ei ole oikeutta tarkastella tätä ilmoitusta.',
    'User not authorized to delete this notification.'       => 'Käyttäjällä ei ole oikeutta poistaa tätä ilmoitusta.',
    'Notification not found'                                 => 'Ilmoitusta ei löytynyt',

    // Misc config-file note
    'This is being set in the config file. [{file}]' => 'Tämä asetetaan asetustiedostossa. [{file}]',

    // Slack, ntfy, and Bluesky message types
    "Add the Bluesky accounts you'd like to post from. Each account becomes available as a recipient on the **Recipients** tab when configuring a notification." => 'Lisää Bluesky-tilit, joilta haluat julkaista. Kukin tili on käytettävissä vastaanottajana **Vastaanottajat**-välilehdellä, kun määrität ilmoituksen.',
    "Click any row's **Test** button to confirm the account authenticates." => 'Napsauta minkä tahansa rivin **Testi**-painiketta varmistaaksesi, että tili tunnistautuu.',
    "Click any row's **Test** button to send a quick test message to that channel." => 'Napsauta minkä tahansa rivin **Testi**-painiketta lähettääksesi nopean testiviestin kyseiselle kanavalle.',
    "Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`." => 'Valinnainen, osoita itse isännöityyn ntfy-instanssiin (tarvittaessa). Oletus on `https://ntfy.sh`.',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Valinnainen, pakollinen suojattuihin aiheisiin tai itse isännöityihin instansseihin, joissa on todennus.',
    "Add the ntfy topics you'd like to send messages to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification." => 'Lisää ntfy-aiheet, joihin haluat lähettää viestejä. Kukin aihe on käytettävissä vastaanottajana **Vastaanottajat**-välilehdellä, kun määrität ilmoituksen.',
    "Click any row's **Test** button to send a quick test message to that topic." => 'Napsauta minkä tahansa rivin **Testi**-painiketta lähettääksesi nopean testiviestin kyseiselle aiheelle.',
    'Enable Markdown' => 'Ota Markdown käyttöön',

    // Manual triggers
    'Send Notification'                                            => 'Lähetä ilmoitus',
    'Send manual notifications'                                    => 'Lähetä manuaalisia ilmoituksia',
    'Are you sure you want to send this notification?'             => 'Haluatko varmasti lähettää tämän ilmoituksen?',
    'This notification cannot be triggered manually.'              => 'Tätä ilmoitusta ei voi käynnistää manuaalisesti.',
    'This notification no longer applies to the selected element.' => 'Tämä ilmoitus ei enää koske valittua elementtiä.',
    'Notification was not sent. Check the Notification Log for details.' => 'Ilmoitusta ei lähetetty. Katso lisätietoja Ilmoituslokista.',
    'Notification sent.'                                           => 'Ilmoitus lähetetty.',
    'Element not found'                                            => 'Elementtiä ei löytynyt',
    'Trigger Label'                                                => 'Liipaisimen nimi',
    'An element action label (helps to differentiate multiple triggers).'        => 'Elementtitoiminnon nimi (auttaa erottamaan useat liipaisimet).',

    // Event tab: date trigger
    'On'                                                          => 'Päivänä',
    'days before'                                                 => 'päivää ennen',
    'days after'                                                  => 'päivää jälkeen',
    'Relevant Date'                                               => 'Olennainen päivämäärä',
    'Send the notification relative to a chosen date.'            => 'Lähetä ilmoitus suhteessa valittuun päivämäärään.',

    // Scheduled sending
    'Scheduled Sending' => 'Ajastettu lähetys',
    'Shared secret for authenticating scheduled-run web requests. Required only when the schedule is triggered via the web endpoint.' => 'Jaettu salaisuus ajastetun suorituksen verkkopyyntöjen todentamiseen. Vaaditaan vain, kun aikataulu käynnistetään verkko-osoitteen kautta.',
    'Scheduled-Run Token' => 'Ajastetun suorituksen tunnus',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => 'Lähetetään jokaisen pyynnön mukana joko X-Notifier-Token-otsikkona tai token-parametrina pyynnön rungossa.',
    'Pushover Title' => 'Pushover-otsikko',
    'Pushover Body' => 'Pushover-sisältö',
    'ntfy Title' => 'ntfy-otsikko',
    'ntfy Body' => 'ntfy-sisältö',
    'ntfy Link URL' => 'ntfy-linkin URL',
    'Render Link Previews' => 'Näytä linkin esikatselut',
    'Don\'t unfurl' => 'Älä laajenna',
    'Expand link previews' => 'Laajenna linkin esikatselut',
    'Regular text only' => 'Vain tavallinen teksti',
    'Markdown enabled' => 'Markdown käytössä',
    'Dynamic Pushover Title' => 'Dynaaminen Pushover-otsikko',
    'Dynamic Subject Line' => 'Dynaaminen aiherivi',
    'Dynamic Bot Name' => 'Dynaaminen botin nimi',
    'Dynamic ntfy Title' => 'Dynaaminen ntfy-otsikko',
    'Dynamic Announcement Title' => 'Dynaaminen ilmoituksen otsikko',
    'Dynamic Flash Message Title' => 'Dynaaminen Flash-viestin otsikko',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => 'Tavallinen teksti, enintään 300 merkkiä. URL-osoitteet ja `@handle.tld`-maininnat linkittyvät automaattisesti.',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => 'Luo automaattisesti esikatselukortti, kun julkaisun rungossa on URL.',
    'Whether the message be sent via the [jobs queue]({queueUrl}).' => 'Lähetetäänkö viesti [työjonon]({queueUrl}) kautta.',
    'Priority level of the ntfy message.' => 'ntfy-viestin prioriteettitaso.',
    'Optionally include comma-separated [emoji shortcodes](https://docs.ntfy.sh/emojis/).' => 'Sisällytä halutessasi pilkuilla erotetut [emoji-koodit](https://docs.ntfy.sh/emojis/).',
    'Body of the ntfy notification.' => 'ntfy-ilmoituksen sisältö.',
    'Optionally open a URL when the notification is clicked.' => 'Avaa halutessasi URL, kun ilmoitusta napsautetaan.',
    'Whether to parse the body as Markdown in supported clients.' => 'Käsitelläänkö runko Markdownina tuetuissa asiakasohjelmissa.',
    'Heading of the announcement.' => 'Ilmoituksen otsikko.',
    'Body of the announcement. Supports Markdown.' => 'Ilmoituksen sisältö. Tukee Markdownia.',
    'Heading of the flash message.' => 'Flash-viestin otsikko.',
    'Optionally include details below the heading. Supports Markdown and HTML.' => 'Sisällytä halutessasi yksityiskohtia otsikon alle. Tukee Markdownia ja HTML:ää.',
    'Optionally include a heading above the body.' => 'Sisällytä halutessasi otsikko sisällön yläpuolelle.',
    'Body of the SMS (text message). Plain text only.' => 'SMS:n (tekstiviestin) sisältö. Vain tavallinen teksti.',
    'Body of the Pushover notification. Plain text only.' => 'Pushover-ilmoituksen sisältö. Vain tavallinen teksti.',
    'Subject line of the email.' => 'Sähköpostin aiherivi.',
    'Body of the email. Supports HTML.' => 'Sähköpostin sisältö. Tukee HTML:ää.',
    'Optionally override the app\'s display name.' => 'Korvaa halutessasi sovelluksen näyttönimi.',
    'Optionally override the app\'s icon with a URL.' => 'Korvaa halutessasi sovelluksen kuvake URL:lla.',
    'Optionally override the app\'s icon with an emoji. Used only when Bot Icon URL is empty.' => 'Korvaa halutessasi sovelluksen kuvake emojilla. Käytetään vain, kun Bot Icon URL on tyhjä.',
    'Invalid Slack body format.' => 'Virheellinen Slack-sisältömuoto.',
    'Supports standard [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) syntax. Optionally supports HTML _(see below)_.' => 'Tukee tavallista [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) -syntaksia. Tukee valinnaisesti HTML:ää _(katso alla)_.',
    'Render Message Body as HTML' => 'Renderöi viestin sisältö HTML:nä',
    'Whether to only parse as [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), or additionally parse it as HTML.' => 'Käsitelläänkö vain [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) vai myös HTML.',
    'mrkdwn only' => 'vain mrkdwn',
    'mrkdwn + HTML' => 'mrkdwn + HTML',
];
