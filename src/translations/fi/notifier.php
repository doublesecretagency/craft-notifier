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

    // ============================================================
    // PLUGIN & PERMISSIONS
    // ============================================================

    // Plugin & navigation
    'Notifier' => 'Notifier',
    'Notifications' => 'Ilmoitukset',
    'Notification' => 'Ilmoitus',
    'All notifications' => 'Kaikki ilmoitukset',
    'Notification Log' => 'Ilmoitusloki',
    'Logs' => 'Lokit',
    'View Notifications' => 'Näytä ilmoitukset',
    'Add a New Notification' => 'Lisää uusi ilmoitus',
    'notification' => 'ilmoitus',

    // Permissions
    'View notifications' => 'Näytä ilmoitukset',
    'Save notifications' => 'Tallenna ilmoitukset',
    'Use the Dynamic Recipients type' => 'Käytä Dynaamiset vastaanottajat -tyyppiä',
    'Use the Dynamic Data type' => 'Käytä dynaamisen datan tyyppiä',
    'Test notifications' => 'Testaa ilmoituksia',
    'Send manual notifications' => 'Lähetä manuaalisia ilmoituksia',
    'Delete notifications' => 'Poista ilmoituksia',
    'View notification log' => 'Näytä ilmoitusloki',
    'Delete notification log' => 'Poista ilmoitusloki',

    // ============================================================
    // NOTIFICATION EDITOR
    // ============================================================

    // Editor: tabs
    'Meta' => 'Meta',
    'Event' => 'Tapahtuma',
    'Message' => 'Viesti',
    'Recipients' => 'Vastaanottajat',

    // Event tab: type selector
    'Event Type' => 'Tapahtumatyyppi',
    'What type of event will activate the notification?' => 'Minkä tyyppinen tapahtuma aktivoi ilmoituksen?',
    'Which specific event will activate the notification?' => 'Mikä tarkka tapahtuma aktivoi ilmoituksen?',

    // Event tab: event types
    'Assets Event' => 'Asset-tapahtuma',
    'Commerce Orders Event' => 'Commerce-tilaustapahtuma',
    'Commerce Products Event' => 'Commerce-tuotetapahtuma',
    'Digital Products Event' => 'Digital Products -tapahtuma',
    'Digital Product Licenses Event' => 'Digital Products -lisenssitapahtuma',
    'Solspace Calendar Event' => 'Solspace Calendar -tapahtuma',
    'Entries Event' => 'Merkintätapahtuma',
    'Users Event' => 'Käyttäjätapahtuma',
    'Ungrouped Users' => 'Käyttäjät ilman ryhmää',

    // Event tab: Feed
    'Feed URL' => 'Syötteen URL',
    'The URL of the RSS, Atom, or JSON feed to watch.' => 'Seurattavan RSS-, Atom- tai JSON-syötteen URL.',

    // Event tab: field conditions
    'Field Conditions' => 'Kenttäehdot',
    'Send the message only when the saved element matches the following conditions.' => 'Lähetä viesti vain, kun tallennettu elementti vastaa seuraavia ehtoja.',
    'has changed' => 'on muuttunut',

    // Event tab: element filters (panel chrome + common output)
    '#{elementType} Event Filters' => 'Tapahtumasuodattimet kohteelle #{elementType}',
    'No filters match this event.' => 'Mikään suodatin ei vastaa tätä tapahtumaa.',
    'Determine whether each message should be sent based on specified conditions.' => 'Määritä määriteltyjen ehtojen perusteella, lähetetäänkö kukin viesti.',
    'Unnamed filter' => 'Nimetön suodatin',
    'Must be TRUE to send message' => 'On oltava TRUE viestin lähettämiseksi',
    'Must be FALSE to send message' => 'On oltava FALSE viestin lähettämiseksi',
    'No effect' => 'Ei vaikutusta',

    // Event tab: element filter rules
    'Element is being saved for the first time' => 'Elementti tallennetaan ensimmäistä kertaa',
    'Must be a new entry' => 'On oltava uusi merkintä',
    'Must be an existing entry' => 'On oltava olemassa oleva merkintä',
    'Can be existing or new' => 'Voi olla olemassa oleva tai uusi',
    'Element is new' => 'Elementti on uusi',
    'New elements only' => 'Vain uudet elementit',
    'Existing elements only' => 'Vain olemassa olevat elementit',
    'Element is enabled' => 'Elementti on käytössä',
    'Must be enabled' => 'On oltava käytössä',
    'Must be disabled' => 'On oltava pois käytöstä',
    'Can be enabled or disabled' => 'Voi olla käytössä tai pois käytöstä',
    'Element is a draft' => 'Elementti on luonnos',
    'Must be a draft' => 'On oltava luonnos',
    'Must not be a draft' => 'Ei saa olla luonnos',
    'Can be a draft or non-draft' => 'Voi olla luonnos tai ei',
    'Element is a provisional draft' => 'Elementti on alustava luonnos',
    'Must be a provisional draft' => 'On oltava alustava luonnos',
    'Must not be a provisional draft' => 'Ei saa olla alustava luonnos',
    'Can be a provisional draft or non-provisional' => 'Voi olla alustava luonnos tai ei',
    'Element is a revision' => 'Elementti on versio',
    'Must be a revision' => 'On oltava versio',
    'Must not be a revision' => 'Ei saa olla versio',
    'Can be a revision or non-revision' => 'Voi olla versio tai ei',
    'Element is being duplicated' => 'Elementtiä monistetaan',
    'Must be duplicating the element' => 'Elementtiä on monistettava',
    'Must not be duplicating the element' => 'Elementtiä ei saa monistaa',
    'Element is being propagated' => 'Elementtiä siirretään muille sivustoille',
    'Element must be propagating' => 'Elementin on oltava siirtymässä',
    'Element must not be propagating' => 'Elementti ei saa olla siirtymässä',
    'Element is being bulk-resaved' => 'Elementti tallennetaan uudelleen massana',
    'Must be bulk-resaving the element' => 'Elementti on tallennettava uudelleen massana',
    'Must not be bulk-resaving the element' => 'Elementtiä ei saa tallentaa uudelleen massana',

    // Event tab: date trigger
    'On' => 'Päivänä',
    'days before' => 'päivää ennen',
    'days after' => 'päivää jälkeen',
    'Relevant Date' => 'Olennainen päivämäärä',
    'Send the notification relative to a chosen date.' => 'Lähetä ilmoitus suhteessa valittuun päivämäärään.',

    // Event tab: recurring schedule
    'Every' => 'Joka',
    'on' => 'päivänä',
    'on day' => 'kuukauden päivänä',
    'at' => 'klo',
    'Starting on' => 'Alkaen',
    'Day' => 'Päivä',
    'Date' => 'Päivämäärä',
    'Time' => 'Aika',
    'day(s)' => 'päivä(ä)',
    'week(s)' => 'viikko(a)',
    'month(s)' => 'kuukausi(a)',
    'year(s)' => 'vuosi/-tta',
    'day' => 'päivä',
    'days' => 'päivää',
    'week' => 'viikko',
    'weeks' => 'viikkoa',
    'month' => 'kuukausi',
    'months' => 'kuukautta',
    'year' => 'vuosi',
    'years' => 'vuotta',
    'Manual only' => 'Vain manuaalisesti',
    'Scheduled sending' => 'Ajastettu lähetys',
    'On a recurring schedule' => 'Toistuvan aikataulun mukaan',
    'On demand' => 'Tarvittaessa',
    'Send on a Recurring Schedule' => 'Lähetä toistuvan aikataulun mukaan',
    'Configure Recurring Schedule' => 'Määritä toistuva aikataulu',
    'System timezone set to {timezone}' => 'Järjestelmän aikavyöhyke on {timezone}',
    'Notifications will be sent on the following schedule...' => 'Ilmoitukset lähetetään seuraavan aikataulun mukaan...',
    '... and every {cadence} after that.' => '... ja sen jälkeen aina {cadence} välein.',
    'On what recurring schedule should the notification be sent?' => 'Minkä toistuvan aikataulun mukaan ilmoitus lähetetään?',
    'Whether the message should be sent on a schedule, or only triggered manually.' => 'Lähetetäänkö viesti aikataulun mukaan vai vain manuaalisesti käynnistettynä.',
    'The message can always be sent using the "Send system snapshot" button above.' => 'Viestin voi aina lähettää yllä olevalla "Lähetä järjestelmän tilannekuva" -painikkeella.',
    'The message can always be sent using the "Send data report" button above.' => 'Viestin voi aina lähettää yllä olevalla "Lähetä tietoraportti" -painikkeella.',

    // Event tab: Dynamic Data snippet field
    'Twig Snippet to Determine Data' => 'Twig-katkelma datan määrittämiseen',
    'Enter a custom Twig snippet to [determine which data will be included]({url}).' => 'Anna mukautettu Twig-katkelma, joka [määrittää, mitkä tiedot sisällytetään]({url}).',
    'The snippet **must** include a `{% setData %}` tag.' => 'Katkelman **täytyy** sisältää `{% setData %}`-tunniste.',
    'You do not have permission to edit dynamic data.' => 'Sinulla ei ole oikeutta muokata dynaamista dataa.',

    // Event tab: manual trigger
    'Trigger Label' => 'Liipaisimen nimi',
    'An element action label (helps to differentiate multiple triggers).' => 'Elementtitoiminnon nimi (auttaa erottamaan useat liipaisimet).',
    'Send Notification' => 'Lähetä ilmoitus',

    // Message tab: type selector & queue
    'Message Type' => 'Viestin tyyppi',
    'What type of message will be sent?' => 'Minkä tyyppinen viesti lähetetään?',
    'Send Message via Queue' => 'Lähetä viesti jonon kautta',
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are also supported.' => '[Mallintaminen]({templatingUrl}) ja [erityismuuttujat]({variablesUrl}) ovat myös tuettuja.',
    'Send immediately' => 'Lähetä välittömästi',
    'Add to queue' => 'Lisää jonoon',
    'Whether the message should be sent via the [jobs queue]({queueUrl}).' => 'Lähetetäänkö viesti [työjonon]({queueUrl}) kautta.',

    // Message tab: Email
    "User's Email Address Field" => 'Käyttäjän sähköpostikenttä',
    'Select which User field contains the recipient\'s email address.' => 'Valitse käyttäjäkenttä, joka sisältää vastaanottajan sähköpostiosoitteen.',
    'Email Subject' => 'Sähköpostin aihe',
    'Subject line of the email.' => 'Sähköpostin aiherivi.',
    'Dynamic Subject Line' => 'Dynaaminen aiherivi',
    'Email Body' => 'Sähköpostin sisältö',
    'Body of the email. Supports HTML.' => 'Sähköpostin sisältö. Tukee HTML:ää.',

    // Message tab: rich-text (Trix) toolbar
    'Rich Text' => 'Rikastettu teksti',
    'Bold' => 'Lihavoitu',
    'Italic' => 'Kursivoitu',
    'Underline' => 'Alleviivattu',
    'Strikethrough' => 'Yliviivattu',
    'Bullets' => 'Luettelo',
    'Numbers' => 'Numerointi',
    'Heading' => 'Otsikko',
    'Code' => 'Koodi',
    'Undo' => 'Kumoa',
    'Redo' => 'Tee uudelleen',

    // Message tab: SMS
    "User's Phone Number Field" => 'Käyttäjän puhelinkenttä',
    'Select which User field contains the recipient\'s phone number.' => 'Valitse käyttäjäkenttä, joka sisältää vastaanottajan puhelinnumeron.',
    'SMS Message Body' => 'SMS-viestin sisältö',
    'Body of the SMS (text message). Plain text only.' => 'SMS:n (tekstiviestin) sisältö. Vain tavallinen teksti.',

    // Message tab: Announcement
    'Announcement Title' => 'Ilmoituksen otsikko',
    'Heading of the announcement.' => 'Ilmoituksen otsikko.',
    'Dynamic Announcement Title' => 'Dynaaminen ilmoituksen otsikko',
    'Announcement Message' => 'Ilmoituksen viesti',
    'Body of the announcement. Supports Markdown.' => 'Ilmoituksen sisältö. Tukee Markdownia.',

    // Message tab: Flash
    'Flash Message Type' => 'Flash-viestin tyyppi',
    'Which type of flash message should appear?' => 'Minkä tyyppinen flash-viesti näytetään?',
    'Flash Message Title' => 'Flash-viestin otsikko',
    'Heading of the flash message.' => 'Flash-viestin otsikko.',
    'Dynamic Flash Message Title' => 'Dynaaminen Flash-viestin otsikko',
    'Flash Message Details' => 'Flash-viestin tiedot',
    'Optionally include details below the heading. Supports Markdown and HTML.' => 'Sisällytä halutessasi yksityiskohtia otsikon alle. Tukee Markdownia ja HTML:ää.',

    // Message tab: Pushover
    "Field containing each user's Pushover key" => 'Käyttäjän Pushover-avainkenttä',
    'Select which User field contains the recipient\'s Pushover user key.' => 'Valitse käyttäjäkenttä, joka sisältää vastaanottajan Pushover-avaimen.',
    'Pushover Title' => 'Pushover-otsikko',
    'Optionally include a heading above the body.' => 'Sisällytä halutessasi otsikko sisällön yläpuolelle.',
    'Dynamic Pushover Title' => 'Dynaaminen Pushover-otsikko',
    'Pushover Body' => 'Pushover-sisältö',
    'Body of the Pushover notification. Plain text only.' => 'Pushover-ilmoituksen sisältö. Vain tavallinen teksti.',

    // Message tab: ntfy
    'Priority' => 'Prioriteetti',
    'Priority level of the ntfy message.' => 'ntfy-viestin prioriteettitaso.',
    'Tags' => 'Tunnisteet',
    'Optionally include comma-separated [emoji shortcodes](https://docs.ntfy.sh/emojis/).' => 'Sisällytä halutessasi pilkuilla erotetut [emoji-koodit](https://docs.ntfy.sh/emojis/).',
    'ntfy Title' => 'ntfy-otsikko',
    'Dynamic ntfy Title' => 'Dynaaminen ntfy-otsikko',
    'ntfy Body' => 'ntfy-sisältö',
    'Body of the ntfy notification.' => 'ntfy-ilmoituksen sisältö.',
    'ntfy Link URL' => 'ntfy-linkin URL',
    'Optionally open a URL when the notification is clicked.' => 'Avaa halutessasi URL, kun ilmoitusta napsautetaan.',
    'Enable Markdown' => 'Ota Markdown käyttöön',
    'Whether to parse the body as Markdown in supported clients.' => 'Käsitelläänkö runko Markdownina tuetuissa asiakasohjelmissa.',
    'Regular text only' => 'Vain tavallinen teksti',
    'Markdown enabled' => 'Markdown käytössä',

    // Message tab: Slack
    'Slack Message Body' => 'Slack-viestin sisältö',
    'Supports standard [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) syntax. Optionally supports HTML _(see below)_.' => 'Tukee tavallista [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) -syntaksia. Tukee valinnaisesti HTML:ää _(katso alla)_.',
    'Render Message Body as HTML' => 'Renderöi viestin sisältö HTML:nä',
    'Whether to only parse as [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), or additionally parse it as HTML.' => 'Käsitelläänkö vain [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) vai myös HTML.',
    'mrkdwn only' => 'vain mrkdwn',
    'mrkdwn + HTML' => 'mrkdwn + HTML',
    'Render Link Previews' => 'Näytä linkin esikatselut',
    'Whether Slack should unfurl link previews for URLs in the message body.' => 'Pitäisikö Slackin avata linkkien esikatselut viestin sisällön URL-osoitteille.',
    'Don\'t unfurl' => 'Älä laajenna',
    'Expand link previews' => 'Laajenna linkin esikatselut',
    'Bot Name' => 'Käyttäjänimi',
    'Optionally override the app\'s display name.' => 'Korvaa halutessasi sovelluksen näyttönimi.',
    'Dynamic Bot Name' => 'Dynaaminen botin nimi',
    'Bot Icon URL' => 'Kuvakkeen URL',
    'Optionally override the app\'s icon with a URL.' => 'Korvaa halutessasi sovelluksen kuvake URL:lla.',
    'Bot Emoji' => 'Kuvakkeen emoji',
    'Optionally override the app\'s icon with an emoji. Used only when Bot Icon URL is empty.' => 'Korvaa halutessasi sovelluksen kuvake emojilla. Käytetään vain, kun Bot Icon URL on tyhjä.',

    // Message tab: Bluesky
    'Post Body' => 'Julkaisun sisältö',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => 'Tavallinen teksti, enintään 300 merkkiä. URL-osoitteet ja `@handle.tld`-maininnat linkittyvät automaattisesti.',
    'Generate Link Preview' => 'Luo linkin esikatselu',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => 'Luo automaattisesti esikatselukortti, kun julkaisun rungossa on URL.',
    'No card' => 'Ei korttia',
    'Generate preview card' => 'Luo esikatselukortti',

    // Recipients tab: type selector & user/group pickers
    'Recipients Type' => 'Vastaanottajatyyppi',
    'Who will receive this message?' => 'Kuka vastaanottaa tämän viestin?',
    'Add a message recipient' => 'Lisää vastaanottaja',
    'Select User(s)' => 'Valitse käyttäjä(t)',
    'Which users will receive the message?' => 'Mitkä käyttäjät vastaanottavat viestin?',
    'Which user groups will receive the message?' => 'Mitkä käyttäjäryhmät vastaanottavat viestin?',

    // Recipients tab: channel pickers (Slack / ntfy / Bluesky)
    'Select Slack channel(s)' => 'Valitse Slack-kanava(t)',
    'Which Slack channels should receive this message?' => 'Mitkä Slack-kanavat vastaanottavat tämän viestin?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Slack-kanavia ei ole määritetty. Lisää sellainen kohdassa [Asetukset → Slack]({url}).',
    'Select ntfy topic(s)' => 'Valitse ntfy-aihe(et)',
    'Which ntfy topics should receive this message?' => 'Mitkä ntfy-aiheet vastaanottavat tämän viestin?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'ntfy-aiheita ei ole määritetty. Lisää sellainen kohdassa [Asetukset → ntfy]({url}).',
    'Select Bluesky account(s)' => 'Valitse Bluesky-tili(t)',
    'Which Bluesky accounts should post this message?' => 'Mitkä Bluesky-tilit julkaisevat tämän viestin?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Bluesky-tilejä ei ole määritetty. Lisää sellainen kohdassa [Asetukset → Bluesky]({url}).',

    // Recipients tab: dynamic recipients snippet
    'Twig Snippet to Determine Recipients' => 'Twig-katkelma vastaanottajien määrittämiseen',
    'Enter a custom Twig snippet to [determine who will receive the message]({url}).' => 'Anna mukautettu Twig-katkelma, joka [määrittää, kuka vastaanottaa viestin]({url}).',
    'The snippet **must** include a `{% setRecipients %}` tag.' => 'Katkelman **täytyy** sisältää `{% setRecipients %}`-tunniste.',

    // ============================================================
    // SETTINGS
    // ============================================================

    // Settings: nav & page chrome
    'Notifier Settings' => 'Notifier-asetukset',
    'General' => 'Yleiset',
    'Twilio' => 'Twilio',
    'Pushover' => 'Pushover',
    'Slack' => 'Slack',
    'Bluesky' => 'Bluesky',
    'ntfy' => 'ntfy',

    // Settings: Logging
    'Logging' => 'Lokitus',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier pitää jatkuvaa lokia lähetetyistä viesteistä. Yleensä se ei ole tarpeen, mutta voit rajoittaa tietokantaan tallennettujen lokitapahtumien määrää.',
    'Enable Logging' => 'Ota lokitus käyttöön',
    'When disabled, Notifier will not write anything to the notification log.' => 'Kun pois käytöstä, Notifier ei kirjoita ilmoituslokiin.',
    'Number of days to retain log events' => 'Lokitapahtumien säilytyspäivien määrä',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Säilytä lokitapahtumia enintään näin monta päivää. Tyhjä tarkoittaa ei rajaa.',
    'Number of log events to retain' => 'Säilytettävien lokitapahtumien määrä',
    'At most, keep this many log events. Leave blank for no limit.' => 'Säilytä enintään tämä määrä lokitapahtumia. Tyhjä tarkoittaa ei rajaa.',

    // Settings: Scheduled sending
    'Scheduled Sending' => 'Ajastettu lähetys',
    'Shared secret for authenticating scheduled-run web requests. Required only when the schedule is triggered via the web endpoint.' => 'Jaettu salaisuus ajastetun suorituksen verkkopyyntöjen todentamiseen. Vaaditaan vain, kun aikataulu käynnistetään verkko-osoitteen kautta.',
    'Scheduled-Run Token' => 'Ajastetun suorituksen tunnus',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => 'Lähetetään jokaisen pyynnön mukana joko X-Notifier-Token-otsikkona tai token-parametrina pyynnön rungossa.',

    // Settings: Twilio
    'Twilio API Credentials' => 'Twilion API-tunnistetiedot',
    'If using the Twilio API to send SMS messages, the following credentials are required.' => 'Jos SMS-viestejä lähetetään Twilion API:n kautta, seuraavat tunnistetiedot ovat pakollisia.',
    'Twilio Account SID' => 'Twilio Account SID',
    'Twilio Auth Token' => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)' => 'Twilio-puhelinnumero (lähettää jokaisen SMS-viestin)',
    'SMS Testing' => 'SMS-testaus',
    'Optional. When set, every SMS dispatched will be sent to this number instead of the resolved recipient.' => 'Valinnainen. Asetettuna jokainen lähetetty SMS lähetetään tähän numeroon todellisen vastaanottajan sijaan.',
    'Test phone number' => 'Testipuhelinnumero',

    // Settings: Pushover
    "[Pushover](https://pushover.net) sends push notifications to a registered user's devices. Each Craft user needs a custom field on their profile storing their Pushover user key; you select which field on each Notification's Message tab. For full setup instructions, see the [Pushover getting-started docs](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover)." => '[Pushover](https://pushover.net) lähettää push-ilmoituksia rekisteröityneen käyttäjän laitteisiin. Jokainen Craft-käyttäjä tarvitsee profiilissaan mukautetun kentän, johon hänen Pushover-avaimensa tallennetaan. Valitse kenttä kunkin ilmoituksen Viesti-välilehdellä. Täydet käyttöönotto-ohjeet löytyvät [Pushover-aloituskäyttöoppaasta](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover).',
    'Application API Token' => 'Sovelluksen API-tunniste',
    'The 30-character app token from your Pushover application.' => '30 merkin sovellustunniste Pushover-sovelluksestasi.',

    // Settings: ntfy
    'ntfy.sh is a free HTTP-based push notification service. Subscribers receive messages on the ntfy app, web, or any compatible client by joining a topic.' => 'ntfy.sh on ilmainen HTTP-pohjainen push-ilmoituspalvelu. Tilaajat saavat viestit ntfy-sovelluksessa, verkossa tai missä tahansa yhteensopivassa asiakassovelluksessa liittymällä aiheeseen.',
    'Server URL' => 'Palvelimen URL',
    "Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`." => 'Valinnainen, osoita itse isännöityyn ntfy-instanssiin (tarvittaessa). Oletus on `https://ntfy.sh`.',
    'Access token' => 'Käyttötunniste',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Valinnainen, pakollinen suojattuihin aiheisiin tai itse isännöityihin instansseihin, joissa on todennus.',
    'ntfy Topics' => 'ntfy-aiheet',
    "Add the ntfy topics you'd like to send messages to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification." => 'Lisää ntfy-aiheet, joihin haluat lähettää viestejä. Kukin aihe on käytettävissä vastaanottajana **Vastaanottajat**-välilehdellä, kun määrität ilmoituksen.',
    'Topics' => 'Aiheet',
    "Click any row's **Test** button to send a quick test message to that topic." => 'Napsauta minkä tahansa rivin **Testi**-painiketta lähettääksesi nopean testiviestin kyseiselle aiheelle.',
    'Label' => 'Otsikko',
    'Topic' => 'Aihe',
    'Add a topic' => 'Lisää aihe',

    // Settings: Slack
    'Slack Channels' => 'Slack-kanavat',
    'Create a [Slack app](https://api.slack.com/apps) with the `chat:write`, `chat:write.customize`, and `chat:write.public` scopes, then add a row for each channel you\'d like to post into. Each channel becomes available as a recipient on the **Recipients** tab when configuring a notification. A bot token is a secret, so store it in a `.env` variable and reference that variable (e.g. `$SLACK_BOT_TOKEN`) rather than pasting the token directly.' => 'Luo [Slack-sovellus](https://api.slack.com/apps), jolla on oikeudet `chat:write`, `chat:write.customize` ja `chat:write.public`, ja lisää sitten rivi jokaiselle kanavalle, johon haluat lähettää viestejä. Jokainen kanava tulee saataville vastaanottajaksi **Vastaanottajat**-välilehdellä, kun määrität ilmoituksen. Bot-token on salainen, joten tallenna se `.env`-muuttujaan ja viittaa siihen (esim. `$SLACK_BOT_TOKEN`) sen sijaan, että liittäisit tokenin suoraan.',
    'Channels' => 'Kanavat',
    "Click any row's **Test** button to send a quick test message to that channel." => 'Napsauta minkä tahansa rivin **Testi**-painiketta lähettääksesi nopean testiviestin kyseiselle kanavalle.',
    'Bot Token' => 'Bot-token',
    'Channel ID' => 'Kanavan tunnus',
    'Add a channel' => 'Lisää kanava',
    'Not a valid Bot Token. Must start with `xoxb-`.' => 'Virheellinen bot-token. Täytyy alkaa `xoxb-`.',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => 'Virheellinen kanavan tunnus. Pitää näyttää `C01234ABCD`.',

    // Settings: Bluesky
    "[Bluesky](https://bsky.app) posts publish to the configured account's feed via the ATProto API. App passwords are generated at [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). An app password is a secret, so store it in a `.env` variable and reference that variable (e.g. `\$BLUESKY_APP_PASSWORD`) rather than pasting the password directly." => '[Bluesky](https://bsky.app)-julkaisut julkaistaan määritetyn tilin syötteeseen ATProto-API:n kautta. Sovellussalasanat luodaan osoitteessa [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). Sovellussalasana on salaisuus, joten tallenna se `.env`-muuttujaan ja viittaa kyseiseen muuttujaan (esim. `$BLUESKY_APP_PASSWORD`) sen sijaan, että liittäisit salasanan suoraan.',
    'PDS URL' => 'PDS-URL',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'Oletus on https://bsky.social. Osoita mukautettuun PDS-instanssiin, jos asennuksesi federoituu.',
    'Bluesky Accounts' => 'Bluesky-tilit',
    "Add the Bluesky accounts you'd like to post from. Each account becomes available as a recipient on the **Recipients** tab when configuring a notification." => 'Lisää Bluesky-tilit, joilta haluat julkaista. Kukin tili on käytettävissä vastaanottajana **Vastaanottajat**-välilehdellä, kun määrität ilmoituksen.',
    'Accounts' => 'Tilit',
    "Click any row's **Test** button to confirm the account authenticates." => 'Napsauta minkä tahansa rivin **Testi**-painiketta varmistaaksesi, että tili tunnistautuu.',
    'Handle' => 'Tunnus',
    'App password' => 'Sovellussalasana',
    'Add an account' => 'Lisää tili',

    // ============================================================
    // MANUAL SEND & TEST
    // ============================================================

    // Manual send & test
    'Send a test message' => 'Lähetä testiviesti',
    'Send a REAL test notification?\\n\\n⚠️ Uses a random sample of real data.\\n⚠️ Sends a real message via the configured channel.\\n⚠️ Delivers to the real configured recipient(s).' => 'Lähetetäänkö TODELLINEN testi-ilmoitus?\\n\\n⚠️ Käyttää satunnaista otosta todellisista tiedoista.\\n⚠️ Lähettää todellisen viestin määritetyn kanavan kautta.\\n⚠️ Toimitetaan todellisille määritetyille vastaanottajille.',
    'Test' => 'Testi',
    'Send system snapshot' => 'Lähetä järjestelmän tilannekuva',
    'Send data report' => 'Lähetä tietoraportti',
    'Are you sure you want to send this notification?' => 'Haluatko varmasti lähettää tämän ilmoituksen?',
    'This notification cannot be triggered manually.' => 'Tätä ilmoitusta ei voi käynnistää manuaalisesti.',
    'This notification no longer applies to the selected element.' => 'Tämä ilmoitus ei enää koske valittua elementtiä.',

    // ============================================================
    // RUNTIME OUTPUT
    // ============================================================

    // Runtime: dispatch log feedback
    'Sending {messageType} to {recipient}.' => 'Lähetetään {messageType} kohteelle {recipient}.',
    'Adding message to queue.' => 'Lisätään viesti jonoon.',
    'Sending message immediately (bypassing queue).' => 'Lähetetään viesti välittömästi (jono ohitetaan).',
    'Unable to parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => 'Syötettä ei voi jäsentää. PHP:n `simplexml`- ja `libxml`-laajennukset vaaditaan.',
    'Unable to parse the feed.' => 'Syötettä ei voi jäsentää.',
    'Unable to fetch the feed: {message}' => 'Syötettä ei voi hakea: {message}',
    'Initial feed scan failed: {message}' => 'Syötteen ensimmäinen tarkistus epäonnistui: {message}',

    // Runtime: controller responses
    'Test notification dispatched.' => 'Testi-ilmoitus lähetetty.',
    'No messages were dispatched. Check the recipient configuration.' => 'Viestejä ei lähetetty. Tarkista vastaanottajakokoonpano.',
    'Unable to send test: the feed could not be read or has no items.' => 'Testiä ei voi lähettää: syötettä ei voitu lukea tai siinä ei ole kohteita.',
    'Unable to send test: no element matches the configured filters.' => 'Testiä ei voi lähettää: yksikään elementti ei vastaa määritettyjä suodattimia.',
    "Couldn't save settings." => 'Asetuksia ei voitu tallentaa.',
    'Settings saved.' => 'Asetukset tallennettu.',
    'Topic is empty.' => 'Aihe on tyhjä.',
    'Server URL is not configured.' => 'Palvelimen URL:ää ei ole määritetty.',
    'Test message from Notifier.' => 'Testiviesti Notifierista.',
    'HTTP {status}' => 'HTTP {status}',
    'Test message sent successfully.' => 'Testiviesti lähetetty onnistuneesti.',
    'Handle and app password are required.' => 'Tunnus ja sovellussalasana ovat pakollisia.',
    'Authentication failed.' => 'Todennus epäonnistui.',
    'Successfully authenticated. No messages were posted.' => 'Todennus onnistui. Viestejä ei lähetetty.',
    'Log events deleted.' => 'Lokitapahtumat poistettu.',
    'Notification sent.' => 'Ilmoitus lähetetty.',
    'Notification was not sent. Check the Notification Log for details.' => 'Ilmoitusta ei lähetetty. Katso lisätietoja Ilmoituslokista.',

    // Outbound: per-channel send results
    'Unable to send email, no recipient specified.' => 'Sähköpostia ei voi lähettää: vastaanottajaa ei ole määritetty.',
    'Unable to send email, the message body was empty.' => 'Sähköpostia ei voi lähettää: viestin sisältö oli tyhjä.',
    "Unable to send the email using Craft's native email handling." => 'Sähköpostia ei voi lähettää Craftin natiivilla sähköpostinkäsittelyllä.',
    'Check your general email settings within Craft.' => 'Tarkista Craftin yleiset sähköpostiasetukset.',
    'Successfully sent email message!' => 'Sähköposti lähetetty!',
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[Virheelliset Twilio-tunnistetiedot.]({url}) Puuttuu: {missing}.',
    'Unable to send SMS, no Twilio phone number exists.' => 'SMS:ää ei voi lähettää, Twilio-puhelinnumeroa ei ole.',
    'Unable to send SMS, no recipient phone number exists.' => 'SMS:ää ei voi lähettää, vastaanottajan puhelinnumeroa ei ole.',
    'Unable to send SMS, recipient phone number is invalid.' => 'SMS:ää ei voi lähettää, vastaanottajan puhelinnumero on virheellinen.',
    'Successfully sent SMS message!' => 'SMS-viesti lähetetty!',
    'Unable to post announcement, no recipient userId specified.' => 'Ilmoitusta ei voi julkaista: vastaanottajan userId puuttuu.',
    'Successfully posted announcement!' => 'Ilmoitus julkaistu!',
    'Unable to send the flash message, invalid flash type.' => 'Flash-viestiä ei voi lähettää: virheellinen flash-tyyppi.',
    'Successfully sent flash message!' => 'Flash-viesti lähetetty!',
    '[Invalid Pushover credentials.]({url}) Missing app token.' => '[Virheelliset Pushover-tunnistetiedot.]({url}) Sovellustunniste puuttuu.',
    'Unable to send Pushover message, no user key on recipient.' => 'Pushover-viestiä ei voi lähettää, vastaanottajalla ei ole käyttäjäavainta.',
    'Pushover POST failed: {reason}' => 'Pushover POST epäonnistui: {reason}',
    'Successfully sent Pushover message!' => 'Pushover-viesti lähetetty!',
    'Unable to send ntfy message, no topic specified.' => 'ntfy-viestiä ei voi lähettää: aihetta ei ole määritetty.',
    'ntfy POST failed with HTTP {status}: {reason}' => 'ntfy POST epäonnistui HTTP {status}: {reason}',
    'ntfy POST failed: {reason}' => 'ntfy POST epäonnistui: {reason}',
    'Successfully sent ntfy message to topic "{topic}".' => 'ntfy-viesti lähetetty aiheelle "{topic}".',
    'Unable to send Slack message, no bot token.' => 'Slack-viestiä ei voi lähettää: ei bot-tokenia.',
    'Unable to send Slack message, no channel ID.' => 'Slack-viestiä ei voi lähettää: ei kanavan tunnusta.',
    'Unable to send Slack message, body is empty.' => 'Slack-viestiä ei voi lähettää: sisältö on tyhjä.',
    'Slack rejected the message: {error}' => 'Slack hylkäsi viestin: {error}',
    'Slack POST failed: {reason}' => 'Slack POST epäonnistui: {reason}',
    'Successfully sent Slack message to "{label}".' => 'Slack-viesti lähetetty kohteelle "{label}".',
    'Unable to send Bluesky post, recipient is missing credentials.' => 'Bluesky-julkaisua ei voi lähettää: vastaanottajalta puuttuvat tunnistetiedot.',
    'Body exceeded {max} characters, truncated.' => 'Sisältö ylitti {max} merkkiä ja se typistettiin.',
    'Successfully posted to Bluesky as "{label}".' => 'Julkaistu Blueskyssä nimellä "{label}".',
    'Bluesky auth failed for {handle}: {reason}' => 'Bluesky-todennus epäonnistui käyttäjälle {handle}: {reason}',
    'Bluesky auth failed: {reason}' => 'Bluesky-todennus epäonnistui: {reason}',
    'Bluesky post failed: {reason}' => 'Bluesky-julkaisu epäonnistui: {reason}',
    'Bluesky link preview skipped: {reason}' => 'Bluesky-linkin esikatselu ohitettu: {reason}',

    // Recipient warnings
    'Recipient "{name}" has no email address.' => 'Vastaanottajalla "{name}" ei ole sähköpostiosoitetta.',
    'Recipient "{name}" has no phone number.' => 'Vastaanottajalla "{name}" ei ole puhelinnumeroa.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => 'Vastaanottajalla "{name}" ei ole liitettyä käyttäjää; ilmoitusta ei voi lähettää.',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => 'Vastaanottaja "{name}" ei pääse hallintapaneeliin; ilmoitusta ei voi lähettää.',
    'Pushover user-key field is not configured on this notification.' => 'Pushover-käyttäjäavainkenttää ei ole määritetty tähän ilmoitukseen.',
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => 'Vastaanottajalla "{name}" ei ole liitettyä käyttäjää; Pushover-viestiä ei voi lähettää.',
    '[SKIPPED] User "{name}" has no Pushover key.' => '[OHITETTU] Käyttäjällä "{name}" ei ole Pushover-avainta.',
    'Recipient "{name}" has no ntfy topic.' => 'Vastaanottajalla "{name}" ei ole ntfy-aihetta.',
    'Recipient "{name}" has no Bluesky credentials.' => 'Vastaanottajalla "{name}" ei ole Bluesky-tunnistetietoja.',
    'Recipient "{name}" has no Slack bot token.' => 'Vastaanottajalla "{name}" ei ole Slack-bot-tokenia.',
    'Recipient "{name}" has no Slack channel ID.' => 'Vastaanottajalla "{name}" ei ole Slack-kanavan tunnusta.',

    // Errors & exceptions
    'Invalid element event: {class}' => 'Virheellinen elementtitapahtuma: {class}',
    'Invalid notification ID: {id}' => 'Virheellinen ilmoitustunniste: {id}',
    'Invalid email message mode.' => 'Virheellinen sähköpostiviestin tila.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Sinulla ei ole oikeutta käyttää Dynaamiset vastaanottajat -tyyppiä.',
    'Dynamic recipients snippet did not call setRecipients.' => 'Dynaamisten vastaanottajien katkelma ei kutsunut setRecipients-funktiota.',
    'setRecipients was called with an empty value.' => 'setRecipients kutsuttiin tyhjällä arvolla.',
    'Unrecognized recipient of type "{type}".' => 'Tunnistamaton tyypin "{type}" vastaanottaja.',
    'Unrecognized recipient "{value}".' => 'Tunnistamaton vastaanottaja "{value}".',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => 'Määritettyä {kind}-kohdetta ei ole enää lisäosan asetuksissa (uid: {uid}).',
    'Invalid settings section: {section}' => 'Virheellinen asetusosa: {section}',
    'User not authorized to save this notification.' => 'Käyttäjällä ei ole oikeutta tallentaa tätä ilmoitusta.',
    'User not authorized to view this notification.' => 'Käyttäjällä ei ole oikeutta tarkastella tätä ilmoitusta.',
    'User not authorized to delete this notification.' => 'Käyttäjällä ei ole oikeutta poistaa tätä ilmoitusta.',
    'Notification not found' => 'Ilmoitusta ei löytynyt',
    'Element not found' => 'Elementtiä ei löytynyt',
    'You do not have permission to use the Dynamic Data type.' => 'Sinulla ei ole oikeutta käyttää dynaamisen datan tyyppiä.',
    'The Dynamic Data snippet did not call the {tag} tag.' => 'Twig-katkelma ei kutsunut {tag}-tunnistetta.',
    'Invalid Slack body format.' => 'Virheellinen Slack-sisältömuoto.',

    // Config-file override note
    'This is being set in the config file. [{file}]' => 'Tämä asetetaan asetustiedostossa. [{file}]',

    // ============================================================
    // JAVASCRIPT UI
    // ============================================================

    // JavaScript: log utility & buttons
    'Test notification failed.' => 'Testi-ilmoitus epäonnistui.',
    'Unable to get the notification, something went wrong.' => 'Ilmoitusta ei voitu hakea, jokin meni vikaan.',
    'Something went wrong.' => 'Jokin meni vikaan.',
    'Invalid notification ID.' => 'Virheellinen ilmoitustunnus.',
    'Unable to delete the log event, something went wrong.' => 'Lokitapahtuman poistaminen epäonnistui, jokin meni vikaan.',
    'Log event deleted.' => 'Lokitapahtuma poistettu.',
    'Unable to delete log events, something went wrong.' => 'Lokitapahtumien poistaminen epäonnistui, jokin meni vikaan.',
    'Are you sure you want to delete this log event?' => 'Haluatko varmasti poistaa tämän lokitapahtuman?',
    'Are you sure you want to delete all logs from {date}?' => 'Haluatko varmasti poistaa kaikki lokit päivältä {date}?',
];
