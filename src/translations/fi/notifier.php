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
    'Should the message be sent via the [jobs queue]({queueUrl})?' => 'Tuleeko viesti lähettää [työjonon]({queueUrl}) kautta?',
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
    'The Pushover application token is configured in [Settings → Pushover](url).' => 'Pushover-sovellustunniste määritetään kohdassa [Asetukset → Pushover](url).',

    // Message tab: ntfy fields
    'Priority'           => 'Prioriteetti',
    'Tags'               => 'Tunnisteet',
    'Click URL'          => 'Klikkaus-URL',
    'Render as Markdown' => 'Renderöi Markdownina',

    // Message tab: Slack fields
    'Slack Message Body' => 'Slack-viestin sisältö',

    // Message tab: Bluesky fields
    'Post Body' => 'Julkaisun sisältö',
    'Generate Link Preview' => 'Luo linkin esikatselu',
    "When the post body contains a URL, automatically generate a preview card with the linked page's image, title, and description." => 'Kun julkaisun sisältö sisältää URL-osoitteen, siihen liitetään esikatselukortti, jossa näkyy linkitetyn sivun otsikko, kuvaus ja kuva.',
    'No card' => 'Ei korttia',
    'Generate preview card' => 'Luo esikatselukortti',

    // Message tab: Title / Body / Trix toolbar
    'Title'         => 'Otsikko',
    'Body'          => 'Sisältö',
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
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => 'Lähtevän sähköpostin sisältö. Voit käyttää <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">erityismuuttujia</a> tai jopa <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">ohittaa vastaanottajia</a>.',

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
    'Defaults to https://ntfy.sh. Point at a self-hosted ntfy instance if applicable.' => 'Oletus on https://ntfy.sh. Osoita itse isännöityyn ntfy-instanssiin tarvittaessa.',
    'Access token' => 'Käyttötunniste',
    'Optional. Required for protected topics or self-hosted instances with auth.' => 'Valinnainen. Pakollinen suojattuihin aiheisiin tai itse isännöityihin instansseihin, joissa on todennus.',
    'ntfy Topics'  => 'ntfy-aiheet',
    'Named list of ntfy topics. Each topic becomes selectable on the notification edit screen.' => 'Nimettyjen ntfy-aiheiden luettelo. Jokainen aihe on valittavissa ilmoituksen muokkausnäytöltä.',
    'Topics'       => 'Aiheet',
    'Add one row per topic name. Use the **Test** button to send a quick test message to the topic.' => 'Lisää yksi rivi aihettä kohti. Käytä **Test**-painiketta lähettääksesi nopean testiviestin aiheelle.',
    'Topic'        => 'Aihe',
    'Add a topic'  => 'Lisää aihe',
    'Save first to persist a row, then click its **Test** button to fire a sanity check against ntfy.' => 'Tallenna ensin, jotta rivi pysyy, ja napsauta sitten sen **Test**-painiketta tehdäksesi pikatestin ntfy:tä vasten.',

    // Settings: Slack
    'Slack Channels' => 'Slack-kanavat',
    'Channels'       => 'Kanavat',
    'Each Slack channel needs its own Incoming Webhook URL. Use the **Test** button to fire a quick sanity check after saving.' => 'Jokaisella Slack-kanavalla on oltava oma Incoming Webhook -URL. Käytä **Test**-painiketta nopeaan tarkistukseen tallennuksen jälkeen.',
    'Webhook URL'    => 'Webhook-URL',
    'Add a channel'  => 'Lisää kanava',
    'Save first to persist a row, then click its **Test** button to fire a sanity check against Slack.' => 'Tallenna ensin, jotta rivi pysyy, ja napsauta sitten sen **Test**-painiketta tehdäksesi pikatestin Slackiä vasten.',

    // Settings: Bluesky
    "[Bluesky](https://bsky.app) posts publish to the configured account's feed via the ATProto API. App passwords are generated at [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). An app password is a secret, so store it in a `.env` variable and reference that variable (e.g. `\$BLUESKY_APP_PASSWORD`) rather than pasting the password directly." => '[Bluesky](https://bsky.app)-julkaisut julkaistaan määritetyn tilin syötteeseen ATProto-API:n kautta. Sovellussalasanat luodaan osoitteessa [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). Sovellussalasana on salaisuus, joten tallenna se `.env`-muuttujaan ja viittaa kyseiseen muuttujaan (esim. `$BLUESKY_APP_PASSWORD`) sen sijaan, että liittäisit salasanan suoraan.',
    'PDS URL'          => 'PDS-URL',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'Oletus on https://bsky.social. Osoita mukautettuun PDS-instanssiin, jos asennuksesi federoituu.',
    'Bluesky Accounts' => 'Bluesky-tilit',
    'Named list of Bluesky accounts. Each account becomes selectable on the notification edit screen.' => 'Nimettyjen Bluesky-tilien luettelo. Jokainen tili on valittavissa ilmoituksen muokkausnäytöltä.',
    'Accounts'         => 'Tilit',
    'Add one row per Bluesky account. Use **Test** to verify the credentials authenticate.' => 'Lisää yksi rivi Bluesky-tiliä kohti. Käytä **Test**iä tarkistaaksesi, että tunnistetiedot toimivat.',
    'Label'            => 'Otsikko',
    'Handle'           => 'Tunnus',
    'App password'     => 'Sovellussalasana',
    'Add an account'   => 'Lisää tili',
    'Save first to persist a row, then click its **Test** button to verify the credentials authenticate.' => 'Tallenna ensin, jotta rivi pysyy, ja napsauta sitten sen **Test**-painiketta tarkistaaksesi, että tunnistetiedot toimivat.',

    // Test notification (UI)
    'Send a test message'           => 'Lähetä testiviesti',
    'Are you certain you want to send a test notification?\\n\\nThe configured message will be sent to the configured recipient(s).' => 'Haluatko varmasti lähettää testi-ilmoituksen?\\n\\nMääritetty viesti lähetetään määritetyille vastaanottajille.',
    'Test'                          => 'Testi',
    'Test notification dispatched.' => 'Testi-ilmoitus lähetetty.',
    'No messages were dispatched. Check the recipient configuration.' => 'Viestejä ei lähetetty. Tarkista vastaanottajakokoonpano.',

    // Settings: save / test action responses
    "Couldn't save settings."                 => 'Asetuksia ei voitu tallentaa.',
    'Settings saved.'                         => 'Asetukset tallennettu.',
    'Topic is empty.'                         => 'Aihe on tyhjä.',
    'Server URL is not configured.'           => 'Palvelimen URL:ää ei ole määritetty.',
    'Test message from Notifier.'             => 'Testiviesti Notifierista.',
    'HTTP {status}'                           => 'HTTP {status}',
    'Test message sent successfully.'         => 'Testiviesti lähetetty onnistuneesti.',
    'HTTP {status}: {body}'                   => 'HTTP {status}: {body}',
    'Handle and app password are required.'   => 'Tunnus ja sovellussalasana ovat pakollisia.',
    'Authentication failed.'                  => 'Todennus epäonnistui.',
    'Successfully authenticated. No messages were posted.' => 'Todennus onnistui. Viestejä ei lähetetty.',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.'          => 'Lähetetään {messageType} kohteelle {recipient}.',
    'Adding message to queue.'                       => 'Lisätään viesti jonoon.',
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
    'Unable to send ntfy message, no server URL configured.' => 'ntfy-viestiä ei voi lähettää: palvelimen URL puuttuu.',
    'Unable to send ntfy message, no topic specified.'       => 'ntfy-viestiä ei voi lähettää: aihetta ei ole määritetty.',
    'ntfy POST failed with HTTP {status}: {reason}'          => 'ntfy POST epäonnistui HTTP {status}: {reason}',
    'ntfy POST failed: {reason}'                             => 'ntfy POST epäonnistui: {reason}',
    'Successfully sent ntfy message to topic "{topic}".'     => 'ntfy-viesti lähetetty aiheelle "{topic}".',

    // Outbound: Slack log messages
    'Unable to send Slack message, no webhook URL.' => 'Slack-viestiä ei voi lähettää: webhook-URL puuttuu.',
    'Unable to send Slack message, webhook URL is not valid.' => 'Slack-viestiä ei voi lähettää: webhook-URL ei ole kelvollinen.',
    'Unable to send Slack message, body is empty.'  => 'Slack-viestiä ei voi lähettää: sisältö on tyhjä.',
    'Slack POST failed (HTTP {status}): {reason}'   => 'Slack POST epäonnistui (HTTP {status}): {reason}',
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
    'Recipient "{name}" has no Slack webhook URL.'   => 'Vastaanottajalla "{name}" ei ole Slack-webhook-URL:ää.',
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
    "Click any row's **Test** button to confirm the account authenticates." => 'Napsauta minkä tahansa rivin **Test**-painiketta varmistaaksesi, että tili tunnistautuu.',
    "Add an [Incoming Webhook](https://api.slack.com/messaging/webhooks) for each Slack channel you'd like to post into. Each webhook becomes available as a recipient on the **Recipients** tab when configuring a notification. A webhook URL is a secret, so store it in a `.env` variable and reference that variable (e.g. `\$SLACK_WEBHOOK_URL`) rather than pasting the URL directly." => 'Lisää [Incoming Webhook](https://api.slack.com/messaging/webhooks) jokaiselle Slack-kanavalle, johon haluat lähettää. Kukin webhook on käytettävissä vastaanottajana **Vastaanottajat**-välilehdellä, kun määrität ilmoituksen. Webhook-URL on salaisuus, joten tallenna se `.env`-muuttujaan ja viittaa kyseiseen muuttujaan (esim. `$SLACK_WEBHOOK_URL`) sen sijaan, että liittäisit URL-osoitteen suoraan.',
    "Click any row's **Test** button to send a quick test message to that channel." => 'Napsauta minkä tahansa rivin **Test**-painiketta lähettääksesi nopean testiviestin kyseiselle kanavalle.',
    "Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`." => 'Valinnainen, osoita itse isännöityyn ntfy-instanssiin (tarvittaessa). Oletus on `https://ntfy.sh`.',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Valinnainen, pakollinen suojattuihin aiheisiin tai itse isännöityihin instansseihin, joissa on todennus.',
    "Add the ntfy topics you'd like to send messages to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification." => 'Lisää ntfy-aiheet, joihin haluat lähettää viestejä. Kukin aihe on käytettävissä vastaanottajana **Vastaanottajat**-välilehdellä, kun määrität ilmoituksen.',
    "Click any row's **Test** button to send a quick test message to that topic." => 'Napsauta minkä tahansa rivin **Test**-painiketta lähettääksesi nopean testiviestin kyseiselle aiheelle.',
    'Enable Markdown' => 'Ota Markdown käyttöön',
    'Link URL' => 'Linkin URL',
    'Not a valid Webhook URL. Must start with https://hooks.slack.com/services/' => 'Ei kelvollinen Webhook-URL. Sen on alettava merkeillä https://hooks.slack.com/services/',

    // Manual triggers
    'Send Notification'                                            => 'Lähetä ilmoitus',
    'Send manual notifications'                                    => 'Lähetä manuaalisia ilmoituksia',
    'Are you sure you want to send this notification?'             => 'Haluatko varmasti lähettää tämän ilmoituksen?',
    'This notification cannot be triggered manually.'              => 'Tätä ilmoitusta ei voi käynnistää manuaalisesti.',
    'This notification no longer applies to the selected element.' => 'Tämä ilmoitus ei enää koske valittua elementtiä.',
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
    "Fires when an entry's Post Date passes and it becomes Live." => 'Laukeaa, kun merkinnän julkaisupäivä koittaa ja se muuttuu julkaistuksi.',

    // Scheduled sending
    'Scheduled Sending' => 'Ajastettu lähetys',
    'Shared secret for authenticating scheduled-run web requests. Required only when the schedule is triggered via the web endpoint.' => 'Jaettu salaisuus ajastetun suorituksen verkkopyyntöjen todentamiseen. Vaaditaan vain, kun aikataulu käynnistetään verkko-osoitteen kautta.',
    'Scheduled-Run Token' => 'Ajastetun suorituksen tunnus',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => 'Lähetetään jokaisen pyynnön mukana joko X-Notifier-Token-otsikkona tai token-parametrina pyynnön rungossa.',
];
