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
    'Delete notifications'            => 'Poista ilmoitukset',
    'View notification log'           => 'Näytä ilmoitusloki',
    'Delete notification log'         => 'Poista ilmoitusloki',

    // Notification editor: tabs
    'Meta'       => 'Meta',
    'Event'      => 'Tapahtuma',
    'Message'    => 'Viesti',
    'Recipients' => 'Vastaanottajat',

    // Event tab
    'Event Type'                                           => 'Tapahtuman tyyppi',
    'What type of event will activate the notification?'   => 'Minkä tyyppinen tapahtuma laukaisee ilmoituksen?',
    'Which specific event will activate the notification?' => 'Mikä yksittäinen tapahtuma laukaisee ilmoituksen?',
    'Assets Event'                                         => 'Asset-tapahtuma',
    'Commerce Orders Event'                                => 'Commerce-tilaustapahtuma',
    'Entries Event'                                        => 'Merkintätapahtuma',
    'Users Event'                                          => 'Käyttäjätapahtuma',

    // Field and element conditions
    'Field Conditions'                                                               => 'Kenttäehdot',
    'Send the message only when the saved element matches the following conditions.' => 'Lähetä viesti vain, kun tallennettu elementti täyttää seuraavat ehdot.',
    'has changed'                                                                    => 'on muuttunut',
    '#{elementType} Event Filters'                                                   => '#{elementType}-tapahtumasuodattimet',
    'No filters match this event.'                                                   => 'Yksikään suodatin ei vastaa tätä tapahtumaa.',
    'Determine whether each message should be sent based on specified conditions.'   => 'Määritä, lähetetäänkö kukin viesti annettujen ehtojen perusteella.',

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
    'Must be enabled'            => 'Oltava käytössä',
    'Must be disabled'           => 'Oltava poissa käytöstä',
    'Can be enabled or disabled' => 'Voi olla käytössä tai poissa käytöstä',

    // Filters: drafts
    'Element is a draft'          => 'Elementti on luonnos',
    'Must be a draft'             => 'Oltava luonnos',
    'Must not be a draft'         => 'Ei saa olla luonnos',
    'Can be a draft or non-draft' => 'Voi olla luonnos tai ei',

    // Filters: provisional drafts
    'Element is a provisional draft'                => 'Elementti on tilapäinen luonnos',
    'Must be a provisional draft'                   => 'Oltava tilapäinen luonnos',
    'Must not be a provisional draft'               => 'Ei saa olla tilapäinen luonnos',
    'Can be a provisional draft or non-provisional' => 'Voi olla tilapäinen tai ei',

    // Filters: revisions
    'Element is a revision'             => 'Elementti on revisio',
    'Must be a revision'                => 'Oltava revisio',
    'Must not be a revision'            => 'Ei saa olla revisio',
    'Can be a revision or non-revision' => 'Voi olla revisio tai ei',

    // Filters: duplication
    'Element is being duplicated'         => 'Elementtiä monistetaan',
    'Must be duplicating the element'     => 'Elementtiä on monistettava',
    'Must not be duplicating the element' => 'Elementtiä ei saa monistaa',

    // Filters: propagation
    'Element is being propagated'     => 'Elementtiä propagoidaan',
    'Element must be propagating'     => 'Elementin on oltava propagoitumassa',
    'Element must not be propagating' => 'Elementti ei saa olla propagoitumassa',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => 'Elementtiä tallennetaan uudelleen joukkoajossa',
    'Must be bulk-resaving the element'     => 'Elementtiä on tallennettava uudelleen joukkoajossa',
    'Must not be bulk-resaving the element' => 'Elementtiä ei saa tallentaa uudelleen joukkoajossa',

    // Filters: common output
    'Unnamed filter'                => 'Nimetön suodatin',
    'Must be TRUE to send message'  => 'Oltava TRUE viestin lähettämiseksi',
    'Must be FALSE to send message' => 'Oltava FALSE viestin lähettämiseksi',
    'No effect'                     => 'Ei vaikutusta',

    // Message tab: type selector and queue
    'Message Type'                                                 => 'Viestityyppi',
    'What type of message will be sent?'                           => 'Minkä tyyppinen viesti lähetetään?',
    'Send Message via Queue'                                       => 'Lähetä viesti jonon kautta',
    'Should the message be sent via the [jobs queue]({queueUrl})?' => 'Lähetetäänkö viesti [työjonon]({queueUrl}) kautta?',

    // Email message
    'Email Subject'              => 'Sähköpostin aihe',
    'Email Body'                 => 'Sähköpostin sisältö',
    "User's Email Address Field" => 'Käyttäjän sähköpostiosoitteen kenttä',

    // SMS message
    'SMS Message Body'          => 'SMS-viestin sisältö',
    "User's Phone Number Field" => 'Käyttäjän puhelinnumerokenttä',

    // Announcement message
    'Announcement Title'   => 'Ilmoituksen otsikko',
    'Announcement Message' => 'Ilmoituksen viesti',

    // Flash message
    'Flash Message Type'                         => 'Flash-viestin tyyppi',
    'Flash Message Title'                        => 'Flash-viestin otsikko',
    'Flash Message Details'                      => 'Flash-viestin tiedot',
    'Which type of flash message should appear?' => 'Minkä tyyppisen flash-viestin pitäisi näkyä?',

    // Trix toolbar (rich-text editing)
    'Rich Text'     => 'Muotoiltu teksti',
    'Bold'          => 'Lihavointi',
    'Italic'        => 'Kursivointi',
    'Underline'     => 'Alleviivaus',
    'Strikethrough' => 'Yliviivaus',
    'Bullets'       => 'Luettelomerkit',
    'Numbers'       => 'Numerointi',
    'Heading'       => 'Otsikko',
    'Code'          => 'Koodi',
    'Undo'          => 'Kumoa',
    'Redo'          => 'Tee uudelleen',

    // Email body instructions (HTML)
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => 'Lähtevän sähköpostin sisältö. Voit käyttää <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">erityisiä muuttujia</a> tai jopa <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">ohittaa vastaanottajat</a>.',

    // Recipients tab
    'Recipients Type'                             => 'Vastaanottajatyyppi',
    'Who will receive this message?'              => 'Kuka vastaanottaa tämän viestin?',
    'Add a message recipient'                     => 'Lisää vastaanottaja',
    'Select User(s)'                              => 'Valitse käyttäjä(t)',
    'Which users will receive the message?'       => 'Mitkä käyttäjät vastaanottavat viestin?',
    'Which user groups will receive the message?' => 'Mitkä käyttäjäryhmät vastaanottavat viestin?',
    'Ungrouped Users'                             => 'Ryhmättömät käyttäjät',
    'Twig Snippet to Determine Recipients'        => 'Twig-katkelma vastaanottajien määrittämiseen',

    // Settings: Twilio
    'Twilio Account SID'                             => 'Twilio Account SID',
    'Twilio Auth Token'                              => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)'   => 'Twilio-puhelinnumero (lähettää jokaisen SMS-viestin)',
    'This is being set in the config file. [{file}]' => 'Asetetaan asetustiedostossa. [{file}]',

    // Settings: Logging
    'Logging'                                                                                                                                         => 'Lokitus',
    'Enable Logging'                                                                                                                                  => 'Ota lokitus käyttöön',
    'When disabled, Notifier will not write anything to the notification log.'                                                                        => 'Kun lokitus on poissa käytöstä, Notifier ei kirjoita mitään ilmoituslokiin.',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier ylläpitää jatkuvaa lokia lähetetyistä viesteistä. Yleensä se ei ole tarpeen, mutta voit rajoittaa tietokantaan tallennettavien lokitapahtumien määrää.',
    'Number of log events to retain'                                                                                                                  => 'Säilytettävien lokitapahtumien määrä',
    'At most, keep this many log events. Leave blank for no limit.'                                                                                   => 'Säilytä enintään tämän verran lokitapahtumia. Jätä tyhjäksi, ettei rajaa ole.',
    'Number of days to retain log events'                                                                                                             => 'Päivien määrä, jotka lokitapahtumia säilytetään',
    'At most, keep log events for this many days. Leave blank for no limit.'                                                                          => 'Säilytä lokitapahtumia enintään tämän monen päivän ajan. Jätä tyhjäksi, ettei rajaa ole.',

    // Test notification
    'Send a test message'                                                                                                          => 'Lähetä testiviesti',
    'Are you certain you want to send a test notification?\n\nThe configured message will be sent to the configured recipient(s).' => 'Haluatko varmasti lähettää testi-ilmoituksen?\n\nMääritetty viesti lähetetään määritetyille vastaanottajille.',
    'Test'                                                                                                                         => 'Testi',
    'Test notification dispatched.'                                                                                                => 'Testi-ilmoitus lähetetty.',
    'No messages were dispatched. Check the recipient configuration.'                                                              => 'Yhtään viestiä ei lähetetty. Tarkista vastaanottajien määritykset.',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.' => 'Lähetetään {messageType} vastaanottajalle {recipient}.',
    'Log events deleted.'                   => 'Lokitapahtumat poistettu.',
    'notification'                          => 'ilmoitus',

    // Errors
    'Invalid email message mode.'                                    => 'Virheellinen sähköpostiviestin tila.',
    'Dynamic recipients snippet did not call setRecipients.'         => 'Dynaamisten vastaanottajien katkelma ei kutsunut setRecipients-funktiota.',
    'setRecipients was called with an empty value.'                  => 'setRecipients kutsuttiin tyhjällä arvolla.',
    'Unrecognized recipient "{value}".'                              => 'Tuntematon vastaanottaja "{value}".',
    'Unrecognized recipient of type "{type}".'                       => 'Tuntematon vastaanottaja, tyyppi "{type}".',
    'Recipient "{name}" has no email address.'                       => 'Vastaanottajalla "{name}" ei ole sähköpostiosoitetta.',
    'Recipient "{name}" has no phone number.'                        => 'Vastaanottajalla "{name}" ei ole puhelinnumeroa.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => 'Vastaanottajalla "{name}" ei ole liitettyä käyttäjää; ilmoitusta ei voida lähettää.',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => 'Vastaanottajalla "{name}" ei ole pääsyä hallintapaneeliin; ilmoitusta ei voida lähettää.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Sinulla ei ole oikeutta käyttää Dynaamiset vastaanottajat -tyyppiä.',

];
