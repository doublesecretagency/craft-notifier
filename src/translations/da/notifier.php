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
    'Logs'                   => 'Logge',
    'View Notifications'     => 'Se notifikationer',
    'Add a New Notification' => 'Tilføj en ny notifikation',

    // Permissions
    'View notifications'              => 'Se notifikationer',
    'Save notifications'              => 'Gem notifikationer',
    'Use the Dynamic Recipients type' => 'Brug typen Dynamiske modtagere',
    'Delete notifications'            => 'Slet notifikationer',
    'View notification log'           => 'Se notifikationsloggen',
    'Delete notification log'         => 'Slet notifikationsloggen',

    // Notification editor: tabs
    'Meta'       => 'Meta',
    'Event'      => 'Hændelse',
    'Message'    => 'Besked',
    'Recipients' => 'Modtagere',

    // Event tab
    'Event Type'                                           => 'Hændelsestype',
    'What type of event will activate the notification?'   => 'Hvilken type hændelse aktiverer notifikationen?',
    'Which specific event will activate the notification?' => 'Hvilken specifik hændelse aktiverer notifikationen?',
    'Assets Event'                                         => 'Asset-hændelse',
    'Commerce Orders Event'                                => 'Commerce-ordrehændelse',
    'Entries Event'                                        => 'Indlægshændelse',
    'Users Event'                                          => 'Brugerhændelse',

    // Field and element conditions
    'Field Conditions'                                                               => 'Feltbetingelser',
    'Send the message only when the saved element matches the following conditions.' => 'Send kun beskeden, når det gemte element opfylder følgende betingelser.',
    '#{elementType} Event Filters'                                                   => 'Hændelsesfiltre for #{elementType}',
    'No filters match this event.'                                                   => 'Ingen filtre matcher denne hændelse.',
    'Determine whether each message should be sent based on specified conditions.'   => 'Afgør, om hver besked skal sendes ud fra de angivne betingelser.',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => 'Elementet bliver gemt for første gang',
    'Must be a new entry'                       => 'Skal være et nyt indlæg',
    'Must be an existing entry'                 => 'Skal være et eksisterende indlæg',
    'Can be existing or new'                    => 'Kan være eksisterende eller nyt',

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
    'Can be a draft or non-draft' => 'Kan være udkast eller ikke',

    // Filters: provisional drafts
    'Element is a provisional draft'                => 'Elementet er et midlertidigt udkast',
    'Must be a provisional draft'                   => 'Skal være et midlertidigt udkast',
    'Must not be a provisional draft'               => 'Må ikke være et midlertidigt udkast',
    'Can be a provisional draft or non-provisional' => 'Kan være midlertidigt eller ikke',

    // Filters: revisions
    'Element is a revision'             => 'Elementet er en revision',
    'Must be a revision'                => 'Skal være en revision',
    'Must not be a revision'            => 'Må ikke være en revision',
    'Can be a revision or non-revision' => 'Kan være en revision eller ikke',

    // Filters: duplication
    'Element is being duplicated'         => 'Elementet bliver duplikeret',
    'Must be duplicating the element'     => 'Skal være ved at duplikere elementet',
    'Must not be duplicating the element' => 'Må ikke være ved at duplikere elementet',

    // Filters: propagation
    'Element is being propagated'     => 'Elementet bliver propageret',
    'Element must be propagating'     => 'Elementet skal være under propagering',
    'Element must not be propagating' => 'Elementet må ikke være under propagering',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => 'Elementet bliver gemt igen i et bulk-job',
    'Must be bulk-resaving the element'     => 'Skal være ved at gemme elementet igen i et bulk-job',
    'Must not be bulk-resaving the element' => 'Må ikke være ved at gemme elementet igen i et bulk-job',

    // Filters: common output
    'Unnamed filter'                => 'Filter uden navn',
    'Must be TRUE to send message'  => 'Skal være TRUE for at sende beskeden',
    'Must be FALSE to send message' => 'Skal være FALSE for at sende beskeden',
    'No effect'                     => 'Ingen effekt',

    // Message tab: type selector and queue
    'Message Type'                                                 => 'Beskedtype',
    'What type of message will be sent?'                           => 'Hvilken type besked sendes der?',
    'Send Message via Queue'                                       => 'Send besked via kø',
    'Should the message be sent via the [jobs queue]({queueUrl})?' => 'Skal beskeden sendes via [opgavekøen]({queueUrl})?',

    // Email message
    'Email Subject'              => 'Emnefelt',
    'Email Body'                 => 'E-mailindhold',
    "User's Email Address Field" => 'Brugerens e-mailadressefelt',

    // SMS message
    'SMS Message Body'          => 'Indhold af SMS-besked',
    "User's Phone Number Field" => 'Brugerens telefonnummerfelt',

    // Announcement message
    'Announcement Title'   => 'Meddelelsens titel',
    'Announcement Message' => 'Meddelelsens besked',

    // Flash message
    'Flash Message Type'                         => 'Type af flashbesked',
    'Flash Message Title'                        => 'Titel på flashbesked',
    'Flash Message Details'                      => 'Detaljer for flashbesked',
    'Which type of flash message should appear?' => 'Hvilken type flashbesked skal vises?',

    // Trix toolbar (rich-text editing)
    'Rich Text'     => 'Formateret tekst',
    'Bold'          => 'Fed',
    'Italic'        => 'Kursiv',
    'Underline'     => 'Understreget',
    'Strikethrough' => 'Gennemstreget',
    'Bullets'       => 'Punktopstilling',
    'Numbers'       => 'Nummereret liste',
    'Heading'       => 'Overskrift',
    'Code'          => 'Kode',
    'Undo'          => 'Fortryd',
    'Redo'          => 'Annullér fortryd',

    // Email body instructions (HTML)
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => 'Indhold af udgående e-mail. Du kan bruge <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">specielle variabler</a>, eller endda <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">springe modtagere over</a>.',

    // Recipients tab
    'Recipients Type'                             => 'Type af modtagere',
    'Who will receive this message?'              => 'Hvem skal modtage beskeden?',
    'Add a message recipient'                     => 'Tilføj en modtager',
    'Select User(s)'                              => 'Vælg bruger(e)',
    'Which users will receive the message?'       => 'Hvilke brugere modtager beskeden?',
    'Which user groups will receive the message?' => 'Hvilke brugergrupper modtager beskeden?',
    'Restricted to Admins Only?'                  => 'Kun for administratorer?',
    'Ungrouped Users'                             => 'Brugere uden gruppe',
    'Twig Snippet to Determine Recipients'        => 'Twig-snippet til at bestemme modtagere',

    // Settings: Twilio
    'Twilio Account SID'                             => 'Twilio Account SID',
    'Twilio Auth Token'                              => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)'   => 'Twilio-telefonnummer (sender hver SMS-besked)',
    'This is being set in the config file. [{file}]' => 'Indstilles i konfigurationsfilen. [{file}]',

    // Settings: Logging
    'Logging'                                                                                                                                         => 'Logning',
    'Enable Logging'                                                                                                                                  => 'Aktivér logning',
    'When disabled, Notifier will not write anything to the notification log.'                                                                        => 'Når deaktiveret skriver Notifier intet til notifikationsloggen.',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier fører en løbende log over sendte beskeder. Det er normalt ikke nødvendigt, men du kan begrænse antallet af logposter i databasen.',
    'Number of log events to retain'                                                                                                                  => 'Antal logposter der skal gemmes',
    'At most, keep this many log events. Leave blank for no limit.'                                                                                   => 'Gem højst dette antal logposter. Lad feltet stå tomt for ingen grænse.',
    'Number of days to retain log events'                                                                                                             => 'Antal dage logposter skal gemmes',
    'At most, keep log events for this many days. Leave blank for no limit.'                                                                          => 'Gem logposter i højst dette antal dage. Lad feltet stå tomt for ingen grænse.',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.' => 'Sender {messageType} til {recipient}.',
    'Log events deleted.'                   => 'Logposter slettet.',
    'notification'                          => 'notifikation',

    // Errors
    'Invalid email message mode.'                                    => 'Ugyldig e-mailbeskedtilstand.',
    'Dynamic recipients snippet did not call setRecipients.'         => 'Snippet til dynamiske modtagere kaldte ikke setRecipients.',
    'setRecipients was called with an empty value.'                  => 'setRecipients blev kaldt med en tom værdi.',
    'Unrecognized recipient "{value}".'                              => 'Ukendt modtager "{value}".',
    'Unrecognized recipient of type "{type}".'                       => 'Ukendt modtager af typen "{type}".',
    'Recipient "{name}" has no email address.'                       => 'Modtageren "{name}" har ingen e-mailadresse.',
    'Recipient "{name}" has no phone number.'                        => 'Modtageren "{name}" har intet telefonnummer.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Du har ikke tilladelse til at bruge typen Dynamiske modtagere.',

];
