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

    // ========================================================
    // NOTIFICATION EDITOR
    // ========================================================

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
    'Generate report on a recurring schedule' => 'Luo raportti toistuvan aikataulun mukaan',
    'Generate report on demand' => 'Luo raportti tarvittaessa',
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

    // Message tab: type selector
    'Message Type' => 'Viestin tyyppi',
    'What type of message will be sent?' => 'Minkä tyyppinen viesti lähetetään?',
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are supported.' => '[Mallintaminen]({templatingUrl}) ja [erityismuuttujat]({variablesUrl}) ovat tuettuja.',

    // Details sidebar: queue
    'Use Queue' => 'Käytä jonoa',
    'Immediate' => 'Välittömästi',
    'Queue' => 'Jono',
    'jobs queue' => 'työjonoon',
    'Whether the message will be sent immediately, or added to the {link}.' => 'Lähetetäänkö viesti välittömästi vai lisätäänkö se {link}.',
    'Flash messages never use the queue.' => 'Flash-viestit eivät koskaan käytä jonoa.',
    'Announcements always use the queue.' => 'Ilmoitukset käyttävät aina jonoa.',

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

    // Message tab: Discord
    'Discord Message Body' => 'Discord-viestin sisältö',
    'Supports standard Markdown, and optionally HTML _(see below)_. Max 2000 characters.' => 'Tukee tavallista Markdownia ja valinnaisesti HTML:ää _(katso alla)_. Enintään 2000 merkkiä.',
    'Whether to only parse as Markdown, or additionally parse it as HTML.' => 'Käsitelläänkö vain Markdownina vai myös HTML:nä.',
    'Markdown only' => 'Vain Markdown',
    'Markdown + HTML' => 'Markdown + HTML',
    'Whether Discord should unfurl link previews for URLs in the message body.' => 'Pitäisikö Discordin näyttää linkkien esikatselut viestin sisällön URL-osoitteille.',
    'Webhook Username' => 'Webhook-käyttäjänimi',
    'Optionally override the webhook\'s display name.' => 'Korvaa halutessasi webhookin näyttönimi.',
    'Dynamic Username' => 'Dynaaminen käyttäjänimi',
    'Webhook Avatar URL' => 'Webhookin avatar-URL',
    'Optionally override the webhook\'s avatar with a URL.' => 'Korvaa halutessasi webhookin avatar URL:lla.',

    // Message tab: Facebook
    'Message Body' => 'Viestin sisältö',
    'The text of your Facebook post.' => 'Facebook-julkaisusi teksti.',
    'Preview Card URL' => 'Esikatselukortin URL',
    'Optionally add a link to generate a preview card.' => 'Lisää halutessasi linkki esikatselukortin luomiseksi.',

    // Message tab: Instagram
    'Caption' => 'Kuvateksti',
    'Image Attachment' => 'Kuvaliite',
    'Optional caption, max 2200 characters.' => 'Valinnainen kuvateksti, enintään 2200 merkkiä.',

    // Message tab: X (Twitter)
    'Plain text, max 280 characters.' => 'Pelkkää tekstiä, enintään 280 merkkiä.',

    // Message tab: Media
    'Attach an image by calling `{% setMedia %}` in a [custom Twig snippet]({url}).' => 'Liitä kuva kutsumalla `{% setMedia %}` [mukautetussa Twig-katkelmassa]({url}).',

    // Message tab: Bluesky
    'Post Body' => 'Julkaisun sisältö',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => 'Tavallinen teksti, enintään 300 merkkiä. URL-osoitteet ja `@handle.tld`-maininnat linkittyvät automaattisesti.',
    'Generate Link Preview' => 'Luo linkin esikatselu',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => 'Luo automaattisesti esikatselukortti, kun julkaisun rungossa on URL.',
    'No card' => 'Ei korttia',
    'Generate preview card' => 'Luo esikatselukortti',

    // Message tab: Mastodon
    'Plain text, max 500 characters. URLs will unfurl automatically.' => 'Pelkkää tekstiä, enintään 500 merkkiä. URL-osoitteet avautuvat automaattisesti.',
    'Visibility' => 'Näkyvyys',
    'Who will be able to see this post?' => 'Kuka voi nähdä tämän julkaisun?',

    // Message tab: MQTT
    'Payload' => 'Sisältö',
    'The JSON or plain text message published to the MQTT topic.' => 'JSON- tai pelkkä tekstiviesti, joka julkaistaan MQTT-aiheeseen.',
    'Quality of Service' => 'Palvelun laatu',
    'Delivery guarantee for this message.' => 'Tämän viestin toimitustakuu.',
    'Retain' => 'Säilytä',
    'Whether the broker keeps this as the topic\'s last message for future subscribers.' => 'Säilyttääkö broker tämän aiheen viimeisimpänä viestinä ja toimittaa sen tuleville tilaajille.',
    'Don\'t retain' => 'Älä säilytä',

    // Recipients tab: type selector & user/group pickers
    'Recipients Type' => 'Vastaanottajatyyppi',
    'Who will receive this message?' => 'Kuka vastaanottaa tämän viestin?',
    'Add a message recipient' => 'Lisää vastaanottaja',
    'Select User(s)' => 'Valitse käyttäjä(t)',
    'Which users will receive the message?' => 'Mitkä käyttäjät vastaanottavat viestin?',
    'Which user groups will receive the message?' => 'Mitkä käyttäjäryhmät vastaanottavat viestin?',

    // Recipients tab: channel pickers (ntfy, Slack, Discord, Bluesky, Mastodon, MQTT)
    'Select ntfy topic(s)' => 'Valitse ntfy-aihe(et)',
    'Which topics should receive this message?' => 'Mitkä aiheet saavat tämän viestin?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'ntfy-aiheita ei ole määritetty. Lisää sellainen kohdassa [Asetukset → ntfy]({url}).',
    'No ntfy topics configured. Topics can only be added in an environment that allows administrative changes.' => 'ntfy-aiheita ei ole määritetty. Aiheita voi lisätä vain ympäristössä, joka sallii hallinnolliset muutokset.',
    'Select Slack channel(s)' => 'Valitse Slack-kanava(t)',
    'Which channels should receive this message?' => 'Mitkä kanavat saavat tämän viestin?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Slack-kanavia ei ole määritetty. Lisää sellainen kohdassa [Asetukset → Slack]({url}).',
    'No Slack channels configured. Channels can only be added in an environment that allows administrative changes.' => 'Slack-kanavia ei ole määritetty. Kanavia voi lisätä vain ympäristössä, joka sallii hallinnolliset muutokset.',
    'Select Discord channel(s)' => 'Valitse Discord-kanava(t)',
    'No Discord channels configured. Add one in [Settings → Discord]({url}).' => 'Discord-kanavia ei ole määritetty. Lisää sellainen kohdassa [Asetukset → Discord]({url}).',
    'No Discord channels configured. Channels can only be added in an environment that allows administrative changes.' => 'Discord-kanavia ei ole määritetty. Kanavia voi lisätä vain ympäristössä, joka sallii hallinnolliset muutokset.',
    'Select Facebook page(s)' => 'Valitse Facebook-sivu(t)',
    'Which pages should post this message?' => 'Mitkä sivut julkaisevat tämän viestin?',
    'No Facebook pages configured. Add one in [Settings → Facebook]({url}).' => 'Facebook-sivuja ei ole määritetty. Lisää sellainen kohdassa [Asetukset → Facebook]({url}).',
    'No Facebook pages configured. Pages can only be added in an environment that allows administrative changes.' => 'Facebook-sivuja ei ole määritetty. Sivuja voi lisätä vain ympäristössä, joka sallii hallinnolliset muutokset.',
    'Select Instagram account(s)' => 'Valitse Instagram-tili(t)',
    'No Instagram accounts configured. Add one in [Settings → Instagram]({url}).' => 'Instagram-tilejä ei ole määritetty. Lisää sellainen kohdassa [Asetukset → Instagram]({url}).',
    'No Instagram accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Instagram-tilejä ei ole määritetty. Tilejä voi lisätä vain ympäristössä, joka sallii hallinnolliset muutokset.',
    'Select X (Twitter) account(s)' => 'Valitse X (Twitter) -tili(t)',
    'No X (Twitter) accounts configured. Add one in [Settings → X (Twitter)]({url}).' => 'X (Twitter) -tilejä ei ole määritetty. Lisää sellainen kohdassa [Asetukset → X (Twitter)]({url}).',
    'No X (Twitter) accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'X (Twitter) -tilejä ei ole määritetty. Tilejä voi lisätä vain ympäristössä, joka sallii hallinnolliset muutokset.',
    'Select Bluesky account(s)' => 'Valitse Bluesky-tili(t)',
    'Which accounts should post this message?' => 'Mitkä tilit julkaisevat tämän viestin?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Bluesky-tilejä ei ole määritetty. Lisää sellainen kohdassa [Asetukset → Bluesky]({url}).',
    'No Bluesky accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Bluesky-tilejä ei ole määritetty. Tilejä voi lisätä vain ympäristössä, joka sallii hallinnolliset muutokset.',
    'Select Mastodon account(s)' => 'Valitse Mastodon-tili(t)',
    'No Mastodon accounts configured. Add one in [Settings → Mastodon]({url}).' => 'Mastodon-tilejä ei ole määritetty. Lisää sellainen kohdassa [Asetukset → Mastodon]({url}).',
    'No Mastodon accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Mastodon-tilejä ei ole määritetty. Tilejä voi lisätä vain ympäristössä, joka sallii hallinnolliset muutokset.',
    'Select MQTT topic(s)' => 'Valitse MQTT-aihe(et)',
    'No MQTT topics configured. Add one in [Settings → MQTT]({url}).' => 'MQTT-aiheita ei ole määritetty. Lisää sellainen kohdassa [Asetukset → MQTT]({url}).',
    'No MQTT topics configured. Topics can only be added in an environment that allows administrative changes.' => 'MQTT-aiheita ei ole määritetty. Aiheita voi lisätä vain ympäristössä, joka sallii hallinnolliset muutokset.',
    'Not a valid topic. Must not be empty or contain the `+` or `#` wildcards.' => 'Virheellinen aihe. Ei saa olla tyhjä eikä sisältää jokerimerkkejä `+` tai `#`.',

    // Recipients tab: dynamic recipients snippet
    'Twig Snippet to Determine Recipients' => 'Twig-katkelma vastaanottajien määrittämiseen',
    'Enter a custom Twig snippet to [determine who will receive the message]({url}).' => 'Anna mukautettu Twig-katkelma, joka [määrittää, kuka vastaanottaa viestin]({url}).',
    'The snippet **must** include a `{% setRecipients %}` tag.' => 'Katkelman **täytyy** sisältää `{% setRecipients %}`-tunniste.',

    // ========================================================
    // SETTINGS
    // ========================================================

    // Settings: nav & page chrome
    'Notifier Settings' => 'Notifier-asetukset',
    'General' => 'Yleiset',
    'Twilio' => 'Twilio',
    'Pushover' => 'Pushover',
    'ntfy' => 'ntfy',
    'Slack' => 'Slack',
    'Discord' => 'Discord',
    'Bluesky' => 'Bluesky',
    'Mastodon' => 'Mastodon',
    'MQTT' => 'MQTT',

    // Settings: shared intro lines
    'Consult the [{name} setup guide]({url}) for complete instructions.' => 'Katso täydelliset ohjeet [{name}-määritysoppaasta]({url}).',
    'Sensitive values can be stored in your `.env` file and referenced here.' => 'Arkaluonteiset arvot voidaan tallentaa `.env`-tiedostoosi ja viitata niihin tästä.',

    // Settings: Notification order
    'Notification Order' => 'Ilmoitusten järjestys',
    'Notifications can be dragged into any order on the index page. Choose where new notifications land in that order.' => 'Ilmoituksia voi vetää haluttuun järjestykseen luettelosivulla. Valitse, mihin kohtaan uudet ilmoitukset lisätään tässä järjestyksessä.',
    'Default Placement' => 'Oletussijainti',
    'Where new notifications are added to the list.' => 'Mihin kohtaan uudet ilmoitukset lisätään luettelossa.',
    'Before other notifications' => 'Ennen muita ilmoituksia',
    'After other notifications' => 'Muiden ilmoitusten jälkeen',

    // Settings: Logging
    'Logging' => 'Lokitus',
    "Notifier keeps a running log of every message it sends. You usually won't need to change this, but you can limit how many log entries are kept in the database." => 'Notifier pitää jatkuvaa lokia lähetetyistä viesteistä. Yleensä se ei ole tarpeen, mutta voit rajoittaa tietokantaan tallennettujen lokitapahtumien määrää.',
    'Enable Logging' => 'Ota lokitus käyttöön',
    'When disabled, Notifier will not write anything to the notification log.' => 'Kun pois käytöstä, Notifier ei kirjoita ilmoituslokiin.',
    'Number of days to retain log events' => 'Lokitapahtumien säilytyspäivien määrä',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Säilytä lokitapahtumia enintään näin monta päivää. Tyhjä tarkoittaa ei rajaa.',
    'Number of log events to retain' => 'Säilytettävien lokitapahtumien määrä',
    'At most, keep this many log events. Leave blank for no limit.' => 'Säilytä enintään tämä määrä lokitapahtumia. Tyhjä tarkoittaa ei rajaa.',

    // Settings: Scheduled sending
    'Scheduled Sending' => 'Ajastettu lähetys',
    'A shared secret that authenticates scheduled runs triggered over the web. You only need this if you trigger the schedule from the web endpoint.' => 'Jaettu salaisuus ajastetun suorituksen verkkopyyntöjen todentamiseen. Vaaditaan vain, kun aikataulu käynnistetään verkko-osoitteen kautta.',
    'Scheduled-Run Token' => 'Ajastetun suorituksen tunnus',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => 'Lähetetään jokaisen pyynnön mukana joko X-Notifier-Token-otsikkona tai token-parametrina pyynnön rungossa.',

    // Settings: Twilio
    'Send SMS text messages through [Twilio](https://www.twilio.com).' => 'Lähetä SMS-tekstiviestejä [Twilion](https://www.twilio.com) kautta.',
    'Twilio Account SID' => 'Twilio Account SID',
    'Twilio Auth Token' => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)' => 'Twilio-puhelinnumero (lähettää jokaisen SMS-viestin)',
    'SMS Testing' => 'SMS-testaus',
    'Optional. When set, every SMS is sent to this number instead of the actual recipient.' => 'Valinnainen. Asetettuna jokainen lähetetty SMS lähetetään tähän numeroon todellisen vastaanottajan sijaan.',
    'Test phone number' => 'Testipuhelinnumero',

    // Settings: Pushover
    'Send push notifications through [Pushover](https://pushover.net).' => 'Lähetä push-ilmoituksia [Pushoverin](https://pushover.net) kautta.',
    'Application API Token' => 'Sovelluksen API-tunniste',
    'The 30-character app token from your Pushover application.' => '30 merkin sovellustunniste Pushover-sovelluksestasi.',

    // Settings: ntfy
    'Send push notifications through [ntfy](https://ntfy.sh).' => 'Lähetä push-ilmoituksia [ntfyn](https://ntfy.sh) kautta.',
    'Server URL' => 'Palvelimen URL',
    "Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`." => 'Valinnainen, osoita itse isännöityyn ntfy-instanssiin (tarvittaessa). Oletus on `https://ntfy.sh`.',
    'Access token' => 'Käyttötunniste',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Valinnainen, pakollinen suojattuihin aiheisiin tai itse isännöityihin instansseihin, joissa on todennus.',
    'ntfy Topics' => 'ntfy-aiheet',
    'Add the ntfy topics you want to send to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Lisää ntfy-aiheet, joihin haluat lähettää viestejä. Kukin aihe on käytettävissä vastaanottajana **Vastaanottajat**-välilehdellä, kun määrität ilmoituksen.',
    'Topics' => 'Aiheet',
    "Click any row's **Test** button to send a quick test message to that topic." => 'Napsauta minkä tahansa rivin **Testi**-painiketta lähettääksesi nopean testiviestin kyseiselle aiheelle.',
    'Label' => 'Otsikko',
    'Topic' => 'Aihe',
    'Add a topic' => 'Lisää aihe',

    // Settings: Slack
    'Post messages to your Slack channels.' => 'Lähetä viestejä Slack-kanaviisi.',
    'Channels' => 'Kanavat',
    "Click any row's **Test** button to send a quick test message to that channel." => 'Napsauta minkä tahansa rivin **Testi**-painiketta lähettääksesi nopean testiviestin kyseiselle kanavalle.',
    'Bot Token' => 'Bot-token',
    'Channel ID' => 'Kanavan tunnus',
    'Add a channel' => 'Lisää kanava',
    'Not a valid Bot Token. Must start with `xoxb-`.' => 'Virheellinen bot-token. Täytyy alkaa `xoxb-`.',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => 'Virheellinen kanavan tunnus. Pitää näyttää `C01234ABCD`.',

    // Settings: Discord
    'Post messages to your Discord channels.' => 'Lähetä viestejä Discord-kanaviisi.',
    'Webhook URL' => 'Webhook URL',
    'Not a valid Webhook URL. Must start with `https://discord.com/api/webhooks/`.' => 'Virheellinen Webhook URL. Täytyy alkaa `https://discord.com/api/webhooks/`.',

    // Settings: Facebook
    'Facebook' => 'Facebook',
    'Publish posts to your [Facebook](https://facebook.com) pages.' => 'Julkaise viestejä [Facebook](https://facebook.com)-sivuillesi.',
    'Pages' => 'Sivut',
    'Page ID' => 'Page ID',
    'Page Access Token' => 'Page Access Token',
    'Add a page' => 'Lisää sivu',
    "Click any row's **Test** button to verify that page's credentials. No posts are made." => 'Napsauta minkä tahansa rivin **Testi**-painiketta varmistaaksesi kyseisen sivun tunnistetiedot. Julkaisuja ei tehdä.',

    // Settings: Instagram
    'Instagram' => 'Instagram',
    'Publish posts to your [Instagram](https://instagram.com) Business accounts.' => 'Julkaise viestejä [Instagram](https://instagram.com) Business -tileillesi.',
    "Click any row's **Test** button to resolve the linked Instagram account. No posts are made." => 'Napsauta minkä tahansa rivin **Testi**-painiketta selvittääksesi liitetyn Instagram-tilin. Julkaisuja ei tehdä.',

    // Settings: X (Twitter)
    'X (Twitter)' => 'X (Twitter)',
    'Publish posts to your [X (Twitter)](https://x.com) accounts.' => 'Julkaise viestejä [X (Twitter)](https://x.com) -tileillesi.',
    'Consumer Key' => 'Consumer Key',
    'Consumer Key Secret' => 'Consumer Key Secret',
    'Access Token Secret' => 'Access Token Secret',

    // Settings: Bluesky
    'Publish posts to your [Bluesky](https://bsky.app) accounts.' => 'Julkaise viestejä [Bluesky](https://bsky.app)-tileillesi.',
    'PDS URL' => 'PDS-URL',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'Oletus on https://bsky.social. Osoita mukautettuun PDS-instanssiin, jos asennuksesi federoituu.',
    'Bluesky Accounts' => 'Bluesky-tilit',
    'Add the Bluesky accounts you want to post from. Each account becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Lisää Bluesky-tilit, joilta haluat julkaista. Kukin tili on käytettävissä vastaanottajana **Vastaanottajat**-välilehdellä, kun määrität ilmoituksen.',
    'Accounts' => 'Tilit',
    "Click any row's **Test** button to confirm the account authenticates." => 'Napsauta minkä tahansa rivin **Testi**-painiketta varmistaaksesi, että tili tunnistautuu.',
    'Handle' => 'Tunnus',
    'App password' => 'Sovellussalasana',
    'Add an account' => 'Lisää tili',

    // Settings: Mastodon
    'Publish posts to your [Mastodon](https://joinmastodon.org) accounts.' => 'Julkaise viestejä [Mastodon](https://joinmastodon.org)-tileillesi.',
    'Click any row\'s **Test** button to verify that account\'s credentials. No posts are made.' => 'Napsauta minkä tahansa rivin **Testi**-painiketta varmistaaksesi kyseisen tilin tunnistetiedot. Julkaisuja ei tehdä.',
    'Instance URL' => 'Instanssin URL',
    'Access Token' => 'Käyttötunniste',

    // Settings: MQTT
    'Publish messages to an MQTT broker, handy for IoT and home-automation setups.' => 'Julkaise viestejä MQTT-välittäjälle, kätevä IoT- ja kotiautomaatiokokoonpanoihin.',
    'Host' => 'Isäntä',
    'Broker hostname, without a protocol or port.' => 'Brokerin isäntänimi, ilman protokollaa tai porttia.',
    'Port' => 'Portti',
    'Optional. Defaults to 8883 when TLS is enabled, otherwise 1883.' => 'Valinnainen. Oletus on 8883, kun TLS on käytössä, muuten 1883.',
    'Use TLS' => 'Käytä TLS:ää',
    'Whether to connect to the broker over a secure TLS socket.' => 'Yhdistetäänkö brokeriin suojatun TLS-soketin kautta.',
    'Username' => 'Käyttäjätunnus',
    'Optional, for brokers that require username/password authentication.' => 'Valinnainen, brokereille jotka vaativat käyttäjätunnus/salasana-todennuksen.',
    'Password' => 'Salasana',
    'MQTT Version' => 'MQTT-versio',
    'Protocol version sent to the broker.' => 'Brokerille lähetettävä protokollaversio.',
    'Client ID' => 'Asiakastunnus',
    'Optional. A unique client ID is generated automatically when left blank.' => 'Valinnainen. Yksilöllinen asiakastunnus luodaan automaattisesti, kun kenttä jätetään tyhjäksi.',
    'Mutual TLS' => 'Molemminpuolinen TLS',
    'Optional. Needed for brokers that authenticate clients with certificates, such as AWS IoT Core. Enter the server file paths to your certificate files. You can use a `.env` variable or `@alias` reference.' => 'Valinnainen. Vaaditaan brokereille jotka todentavat asiakkaat varmenteilla, kuten AWS IoT Core. Anna palvelimen tiedostopolut varmennetiedostoihin (`.env`-muuttuja tai `@alias`-viittaus on sallittu).',
    'CA Certificate File' => 'CA-varmennetiedosto',
    'Path to the certificate authority (CA) file.' => 'Polku varmenneviranomaisen (CA) tiedostoon.',
    'Client Certificate File' => 'Asiakasvarmennetiedosto',
    'Path to the client certificate file.' => 'Polku asiakasvarmennetiedostoon.',
    'Client Key File' => 'Asiakasavaintiedosto',
    'Path to the client private key file.' => 'Polku asiakkaan yksityiseen avaintiedostoon.',
    'MQTT Topics' => 'MQTT-aiheet',
    'Add the MQTT topics you want to publish to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Lisää MQTT-aiheet, joihin haluat julkaista. Kukin aihe on käytettävissä vastaanottajana **Vastaanottajat**-välilehdellä, kun määrität ilmoituksen.',
    'Click any row\'s **Test** button to publish a quick test message to that topic.' => 'Napsauta minkä tahansa rivin **Testi**-painiketta julkaistaksesi nopean testiviestin kyseiseen aiheeseen.',

    // ========================================================
    // MANUAL SEND & TEST
    // ========================================================

    // Manual send & test
    'Send a test message' => 'Lähetä testiviesti',
    'Send a REAL test notification?\\n\\n⚠️ Uses a random sample of real data.\\n⚠️ Sends a real message via the configured channel.\\n⚠️ Delivers to the real configured recipient(s).' => 'Lähetetäänkö TODELLINEN testi-ilmoitus?\\n\\n⚠️ Käyttää satunnaista otosta todellisista tiedoista.\\n⚠️ Lähettää todellisen viestin määritetyn kanavan kautta.\\n⚠️ Toimitetaan todellisille määritetyille vastaanottajille.',
    'Test' => 'Testi',
    'Send system snapshot' => 'Lähetä järjestelmän tilannekuva',
    'Send data report' => 'Lähetä tietoraportti',
    'Are you sure you want to send this notification?' => 'Haluatko varmasti lähettää tämän ilmoituksen?',
    'This notification cannot be triggered manually.' => 'Tätä ilmoitusta ei voi käynnistää manuaalisesti.',
    'This notification no longer applies to the selected element.' => 'Tämä ilmoitus ei enää koske valittua elementtiä.',

    // ========================================================
    // RUNTIME OUTPUT
    // ========================================================

    // Runtime: dispatch log feedback
    'Sending {messageType} to {recipient}.' => 'Lähetetään {messageType} kohteelle {recipient}.',
    'Adding message to queue.' => 'Lisätään viesti jonoon.',
    'Sending message immediately (bypassing queue).' => 'Lähetetään viesti välittömästi (jono ohitetaan).',

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
    'Page ID and Page Access Token are required.' => 'Page ID ja Page Access Token ovat pakollisia.',
    'Facebook rejected the request: {error}' => 'Facebook hylkäsi pyynnön: {error}',
    'Successfully connected to "{name}". No posts were made.' => 'Yhteys kohteeseen "{name}" muodostettu onnistuneesti. Julkaisuja ei tehty.',
    'No Instagram Business account is linked to this Page.' => 'Tähän sivuun ei ole liitetty Instagram Business -tiliä.',
    'Successfully connected to @{handle}. No posts were made.' => 'Yhteys kohteeseen @{handle} muodostettu onnistuneesti. Julkaisuja ei tehty.',
    'All four credentials are required.' => 'Kaikki neljä tunnistetietoa ovat pakollisia.',
    'X (Twitter) rejected the request: {error}' => 'X (Twitter) hylkäsi pyynnön: {error}',
    'Successfully authenticated as @{username}. No posts were made.' => 'Todennettu onnistuneesti nimellä @{username}. Julkaisuja ei tehty.',
    'Handle and app password are required.' => 'Tunnus ja sovellussalasana ovat pakollisia.',
    'Authentication failed.' => 'Todennus epäonnistui.',
    'Successfully authenticated. No messages were posted.' => 'Todennus onnistui. Viestejä ei lähetetty.',
    'Log events deleted.' => 'Lokitapahtumat poistettu.',
    'Notification sent.' => 'Ilmoitus lähetetty.',
    'Notification was not sent. Check the Notification Log for details.' => 'Ilmoitusta ei lähetetty. Katso lisätietoja Ilmoituslokista.',
    'Instance URL and access token are required.' => 'Instanssin URL ja käyttötunniste ovat pakollisia.',
    'Mastodon rejected the request: {error}' => 'Mastodon hylkäsi pyynnön: {error}',
    'Successfully authenticated as @{handle}. No posts were made.' => 'Todennettu onnistuneesti nimellä @{handle}. Julkaisuja ei tehty.',
    'Broker host is not configured.' => 'Brokerin isäntää ei ole määritetty.',

    // Outbound: per-channel send results
    'Successfully sent email message!' => 'Sähköposti lähetetty!',
    'Successfully sent SMS message!' => 'SMS-viesti lähetetty!',
    'Successfully posted announcement!' => 'Ilmoitus julkaistu!',
    'Successfully sent flash message!' => 'Flash-viesti lähetetty!',
    'Successfully sent Pushover message!' => 'Pushover-viesti lähetetty!',
    'Successfully sent ntfy message to topic "{topic}".' => 'ntfy-viesti lähetetty aiheelle "{topic}".',
    'Slack rejected the message: {error}' => 'Slack hylkäsi viestin: {error}',
    'Successfully sent Slack message to "{label}".' => 'Slack-viesti lähetetty kohteelle "{label}".',
    'Discord rejected the message: {error}' => 'Discord hylkäsi viestin: {error}',
    'Successfully sent Discord message to "{label}".' => 'Discord-viesti lähetetty kohteelle "{label}".',
    'Successfully sent Facebook post to "{label}".' => 'Facebook-julkaisu lähetetty kohteelle "{label}".',
    'the attached image could not be read' => 'liitettyä kuvaa ei voitu lukea',
    'Successfully sent X (Twitter) post as "{label}".' => 'X (Twitter) -julkaisu lähetetty nimellä "{label}".',
    'Successfully posted to Bluesky as "{label}".' => 'Julkaistu Blueskyssä nimellä "{label}".',
    'Successfully sent Mastodon post to "{label}".' => 'Mastodon-julkaisu lähetetty kohteelle "{label}".',
    'Successfully sent MQTT message to topic "{topic}".' => 'MQTT-viesti lähetettiin aiheeseen "{topic}".',

    // Media attachments
    'Videos are not yet supported on {channel}.' => 'Videoita ei vielä tueta kanavalla {channel}.',
    'The image could not be resized to fit.' => 'Kuvan kokoa ei voitu muuttaa sopivaksi.',
    '[NOT ATTACHED] Unable to attach image. {reason}' => '[EI LIITETTY] Kuvaa ei voitu liittää. {reason}',

    // Recipient warnings
    '[SKIPPED] User "{name}" has no Pushover key.' => '[OHITETTU] Käyttäjällä "{name}" ei ole Pushover-avainta.',

    // Errors & exceptions
    'Invalid element event: {class}' => 'Virheellinen elementtitapahtuma: {class}',
    'Invalid notification ID: {id}' => 'Virheellinen ilmoitustunniste: {id}',
    'Invalid email message mode.' => 'Virheellinen sähköpostiviestin tila.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Sinulla ei ole oikeutta käyttää Dynaamiset vastaanottajat -tyyppiä.',
    'Invalid settings section: {section}' => 'Virheellinen asetusosa: {section}',
    'User not authorized to save this notification.' => 'Käyttäjällä ei ole oikeutta tallentaa tätä ilmoitusta.',
    'User not authorized to view this notification.' => 'Käyttäjällä ei ole oikeutta tarkastella tätä ilmoitusta.',
    'User not authorized to delete this notification.' => 'Käyttäjällä ei ole oikeutta poistaa tätä ilmoitusta.',
    'Notification not found' => 'Ilmoitusta ei löytynyt',
    'Element not found' => 'Elementtiä ei löytynyt',
    'You do not have permission to use the Dynamic Data type.' => 'Sinulla ei ole oikeutta käyttää dynaamisen datan tyyppiä.',
    '[NO DATA] The Dynamic Data snippet did not call the {tag} tag.' => '[EI TIETOJA] Twig-katkelma ei kutsunut {tag}-tunnistetta.',

    // Config-file override note
    'This is being set in the config file. [{file}]' => 'Tämä asetetaan asetustiedostossa. [{file}]',

    // ========================================================
    // JAVASCRIPT UI
    // ========================================================

    // JavaScript: log utility & buttons
    'Test notification failed.' => 'Testi-ilmoitus epäonnistui.',
    'Unable to get the notification, something went wrong.' => 'Ilmoitusta ei voitu hakea, jokin meni vikaan.',
    'Something went wrong.' => 'Jokin meni vikaan.',
    'Invalid notification ID.' => 'Virheellinen ilmoitustunnus.',
    'Unable to delete the log event, something went wrong.' => 'Lokitapahtuman poistaminen epäonnistui, jokin meni vikaan.',
    'Log event deleted.' => 'Lokitapahtuma poistettu.',
    'Unable to delete log events, something went wrong.' => 'Lokitapahtumien poistaminen epäonnistui, jokin meni vikaan.',
    'Are you sure you want to delete all logs from {date}?' => 'Haluatko varmasti poistaa kaikki lokit päivältä {date}?',
    // Reworded outbound + dispatch log messages
    'Successfully posted to "{label}" Instagram account.' => 'Julkaistu Instagram-tilille "{label}".',
    '[BAD CREDENTIALS] Missing app token. [Configure Pushover]({url}).' => '[VIRHEELLISET TUNNUKSET] Sovellustunnus puuttuu. [Määritä Pushover]({url}).',
    '[BAD CREDENTIALS] Missing {missing}. [Configure Twilio]({url}).' => '[VIRHEELLISET TUNNUKSET] {missing} puuttuu. [Määritä Twilio]({url}).',
    '[BAD CREDENTIALS] No Discord webhook URL is configured.' => '[VIRHEELLISET TUNNUKSET] Discord-webhook-URL-osoitetta ei ole määritetty.',
    '[BAD CREDENTIALS] No MQTT broker host is configured.' => '[VIRHEELLISET TUNNUKSET] MQTT-välittäjän isäntää ei ole määritetty.',
    '[BAD CREDENTIALS] No Mastodon access token is configured.' => '[VIRHEELLISET TUNNUKSET] Mastodon-käyttötunnusta ei ole määritetty.',
    '[BAD CREDENTIALS] No Mastodon instance URL is configured.' => '[VIRHEELLISET TUNNUKSET] Mastodon-instanssin URL-osoitetta ei ole määritetty.',
    '[BAD CREDENTIALS] No Slack bot token is configured.' => '[VIRHEELLISET TUNNUKSET] Slack-bottitunnusta ei ole määritetty.',
    '[BAD CREDENTIALS] No Twilio phone number is configured.' => '[VIRHEELLISET TUNNUKSET] Twilio-puhelinnumeroa ei ole määritetty.',
    '[BAD CREDENTIALS] The recipient is missing Bluesky credentials.' => '[VIRHEELLISET TUNNUKSET] Vastaanottajalta puuttuvat Bluesky-tunnukset.',
    '[BAD CREDENTIALS] The recipient is missing Facebook credentials.' => '[VIRHEELLISET TUNNUKSET] Vastaanottajalta puuttuvat Facebook-tunnukset.',
    '[BAD CREDENTIALS] The recipient is missing X (Twitter) credentials.' => '[VIRHEELLISET TUNNUKSET] Vastaanottajalta puuttuvat X (Twitter)-tunnukset.',
    '[BAD CREDENTIALS] Unable to post, recipient is missing credentials.' => '[VIRHEELLISET TUNNUKSET] Julkaisu ei onnistu; vastaanottajalta puuttuvat tunnukset.',
    '[EMPTY BODY] The Discord message body is empty.' => '[TYHJÄ SISÄLTÖ] Discord-viestin sisältö on tyhjä.',
    '[EMPTY BODY] The Facebook post body is empty.' => '[TYHJÄ SISÄLTÖ] Facebook-julkaisun sisältö on tyhjä.',
    '[EMPTY BODY] The MQTT payload is empty.' => '[TYHJÄ SISÄLTÖ] MQTT-hyötykuorma on tyhjä.',
    '[EMPTY BODY] The Mastodon post body is empty.' => '[TYHJÄ SISÄLTÖ] Mastodon-julkaisun sisältö on tyhjä.',
    '[EMPTY BODY] The Slack message body is empty.' => '[TYHJÄ SISÄLTÖ] Slack-viestin sisältö on tyhjä.',
    '[EMPTY BODY] The X (Twitter) post body is empty.' => '[TYHJÄ SISÄLTÖ] X (Twitter) -julkaisun sisältö on tyhjä.',
    '[EMPTY BODY] The email message body was empty.' => '[TYHJÄ SISÄLTÖ] Sähköpostin sisältö oli tyhjä.',
    '[FEED ERROR] Could not fetch the feed: {message}' => '[SYÖTEVIRHE] Syötettä ei voitu hakea: {message}',
    '[FEED ERROR] Could not parse the feed.' => '[SYÖTEVIRHE] Syötettä ei voitu jäsentää.',
    '[FEED ERROR] Could not parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => '[SYÖTEVIRHE] Syötettä ei voitu jäsentää. PHP-laajennukset `simplexml` ja `libxml` vaaditaan.',
    '[FEED ERROR] Initial feed scan failed: {message}' => '[SYÖTEVIRHE] Syötteen ensimmäinen skannaus epäonnistui: {message}',
    '[INVALID NUMBER] The recipient phone number is invalid.' => '[VIRHEELLINEN NUMERO] Vastaanottajan puhelinnumero on virheellinen.',
    '[INVALID TYPE] The flash message type is invalid.' => '[VIRHEELLINEN TYYPPI] Flash-viestin tyyppi on virheellinen.',
    '[LINK PREVIEW SKIPPED] {reason}' => '[LINKIN ESIKATSELU OHITETTU] {reason}',
    '[MISSING IMAGE] Image Attachment field never called the {tag} tag.' => '[KUVA PUUTTUU] Kuvaliite-kenttä ei koskaan kutsunut {tag}-tagia.',
    '[MISSING IMAGE] Image Attachment field was empty.' => '[KUVA PUUTTUU] Kuvaliite-kenttä oli tyhjä.',
    '[MISSING IMAGE] The {tag} tag was called, but returned an invalid image.' => '[KUVA PUUTTUU] {tag}-tagia kutsuttiin, mutta se palautti virheellisen kuvan.',
    '[MISSING IMAGE] Unable to send Instagram post, the image needs a public URL.' => '[KUVA PUUTTUU] Instagram-julkaisua ei voi lähettää; kuva tarvitsee julkisen URL-osoitteen.',
    '[NO MEDIA] No image was attached because the {tag} tag was never invoked in the Image Attachment field.' => '[EI MEDIAA] Kuvaa ei liitetty, koska {tag}-tagia ei koskaan kutsuttu Kuvaliite-kentässä.',
    '[NO RECIPIENTS] The Dynamic Recipients snippet did not call setRecipients.' => '[EI VASTAANOTTAJIA] Dynaamisten vastaanottajien snippet ei kutsunut setRecipients-funktiota.',
    '[NO RECIPIENTS] setRecipients was called with an empty value.' => '[EI VASTAANOTTAJIA] setRecipients-funktiota kutsuttiin tyhjällä arvolla.',
    '[NO RECIPIENT] No MQTT topic was specified.' => '[EI VASTAANOTTAJAA] MQTT-aihetta ei määritetty.',
    '[NO RECIPIENT] No Slack channel ID was specified.' => '[EI VASTAANOTTAJAA] Slack-kanavan tunnusta ei määritetty.',
    '[NO RECIPIENT] No ntfy topic was specified.' => '[EI VASTAANOTTAJAA] ntfy-aihetta ei määritetty.',
    '[NO RECIPIENT] No recipient user was specified for the announcement.' => '[EI VASTAANOTTAJAA] Ilmoitukselle ei määritetty vastaanottajakäyttäjää.',
    '[NO RECIPIENT] No recipient was specified for the email.' => '[EI VASTAANOTTAJAA] Sähköpostille ei määritetty vastaanottajaa.',
    '[NO RECIPIENT] The recipient has no Pushover user key.' => '[EI VASTAANOTTAJAA] Vastaanottajalla ei ole Pushover-käyttäjäavainta.',
    '[NO RECIPIENT] The recipient has no phone number.' => '[EI VASTAANOTTAJAA] Vastaanottajalla ei ole puhelinnumeroa.',
    '[REJECTED BY DISCORD] {error}' => '[HYLÄTTY: DISCORD] {error}',
    '[REJECTED BY FACEBOOK] {error}' => '[HYLÄTTY: FACEBOOK] {error}',
    '[REJECTED BY INSTAGRAM] {error}' => '[HYLÄTTY: INSTAGRAM] {error}',
    '[REJECTED BY MASTODON] {error}' => '[HYLÄTTY: MASTODON] {error}',
    '[REJECTED BY SLACK] {error}' => '[HYLÄTTY: SLACK] {error}',
    '[REJECTED BY X (TWITTER)] {error}' => '[HYLÄTTY: X (TWITTER)] {error}',
    '[SEND FAILED] Authentication failed for {handle}: {reason}' => '[LÄHETYS EPÄONNISTUI] Todennus epäonnistui kahvalle {handle}: {reason}',
    '[SEND FAILED] Authentication failed: {reason}' => '[LÄHETYS EPÄONNISTUI] Todennus epäonnistui: {reason}',
    "[SEND FAILED] Could not send the email using Craft's native handling. Check your general email settings within Craft." => '[LÄHETYS EPÄONNISTUI] Sähköpostia ei voitu lähettää Craftin natiivikäsittelyllä. Tarkista Craftin yleiset sähköpostiasetukset.',
    '[SEND FAILED] HTTP {status}: {reason}' => '[LÄHETYS EPÄONNISTUI] HTTP {status}: {reason}',
    '[SEND FAILED] {error}' => '[LÄHETYS EPÄONNISTUI] {error}',
    '[SEND FAILED] {reason}' => '[LÄHETYS EPÄONNISTUI] {reason}',
    '[SKIPPED] Pushover user-key field is not configured on this notification.' => '[OHITETTU] Pushover-käyttäjäavainkenttää ei ole määritetty tähän ilmoitukseen.',
    '[SKIPPED] Recipient "{name}" cannot access the control panel.' => '[OHITETTU] Vastaanottaja "{name}" ei voi käyttää hallintapaneelia.',
    '[SKIPPED] Recipient "{name}" has no Bluesky credentials.' => '[OHITETTU] Vastaanottajalla "{name}" ei ole Bluesky-tunnuksia.',
    '[SKIPPED] Recipient "{name}" has no Craft user account.' => '[OHITETTU] Vastaanottajalla "{name}" ei ole Craft-käyttäjätiliä.',
    '[SKIPPED] Recipient "{name}" has no Discord webhook URL.' => '[OHITETTU] Vastaanottajalla "{name}" ei ole Discord-webhook-URL-osoitetta.',
    '[SKIPPED] Recipient "{name}" has no Facebook credentials.' => '[OHITETTU] Vastaanottajalla "{name}" ei ole Facebook-tunnuksia.',
    '[SKIPPED] Recipient "{name}" has no Instagram credentials.' => '[OHITETTU] Vastaanottajalla "{name}" ei ole Instagram-tunnuksia.',
    '[SKIPPED] Recipient "{name}" has no MQTT topic.' => '[OHITETTU] Vastaanottajalla "{name}" ei ole MQTT-aihetta.',
    '[SKIPPED] Recipient "{name}" has no Mastodon credentials.' => '[OHITETTU] Vastaanottajalla "{name}" ei ole Mastodon-tunnuksia.',
    '[SKIPPED] Recipient "{name}" has no Slack bot token.' => '[OHITETTU] Vastaanottajalla "{name}" ei ole Slack-bottitunnusta.',
    '[SKIPPED] Recipient "{name}" has no Slack channel ID.' => '[OHITETTU] Vastaanottajalla "{name}" ei ole Slack-kanavan tunnusta.',
    '[SKIPPED] Recipient "{name}" has no X (Twitter) credentials.' => '[OHITETTU] Vastaanottajalla "{name}" ei ole X (Twitter)-tunnuksia.',
    '[SKIPPED] Recipient "{name}" has no email address.' => '[OHITETTU] Vastaanottajalla "{name}" ei ole sähköpostiosoitetta.',
    '[SKIPPED] Recipient "{name}" has no ntfy topic.' => '[OHITETTU] Vastaanottajalla "{name}" ei ole ntfy-aihetta.',
    '[SKIPPED] Recipient "{name}" has no phone number.' => '[OHITETTU] Vastaanottajalla "{name}" ei ole puhelinnumeroa.',
    '[SKIPPED] The configured {kind} no longer exists in the plugin settings (uid: {uid}).' => '[OHITETTU] Määritettyä kohdetta {kind} ei ole enää laajennuksen asetuksissa (uid: {uid}).',
    '[SKIPPED] Unrecognized recipient "{value}".' => '[OHITETTU] Tuntematon vastaanottaja "{value}".',
    '[SKIPPED] Unrecognized recipient of type "{type}".' => '[OHITETTU] Tuntematon vastaanottajatyyppi "{type}".',
    '[TOO LONG] The Discord message body exceeds the 2000-character limit.' => '[LIIAN PITKÄ] Discord-viestin sisältö ylittää 2000 merkin rajan.',
    '[TRUNCATED] Body exceeded {max} characters.' => '[TYPISTETTY] Sisältö ylitti {max} merkkiä.',
    '[TRUNCATED] Caption exceeded {max} characters.' => '[TYPISTETTY] Kuvateksti ylitti {max} merkkiä.',
];
