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
    'Notifications'          => 'Varsler',
    'Notification'           => 'Varsel',
    'All notifications'      => 'Alle varsler',
    'Notification Log'       => 'Varsellogg',
    'Logs'                   => 'Logger',
    'View Notifications'     => 'Vis varsler',
    'Add a New Notification' => 'Legg til et nytt varsel',

    // Permissions
    'View notifications'              => 'Vis varsler',
    'Save notifications'              => 'Lagre varsler',
    'Use the Dynamic Recipients type' => 'Bruk typen Dynamiske mottakere',
    'Test notifications'              => 'Test varsler',
    'Delete notifications'            => 'Slett varsler',
    'View notification log'           => 'Vis varselloggen',
    'Delete notification log'         => 'Slett varselloggen',

    // Notification editor: tabs
    'Meta'       => 'Meta',
    'Event'      => 'Hendelse',
    'Message'    => 'Melding',
    'Recipients' => 'Mottakere',

    // Event tab
    'Event Type'                                           => 'Hendelsestype',
    'What type of event will activate the notification?'   => 'Hvilken type hendelse skal aktivere varselet?',
    'Which specific event will activate the notification?' => 'Hvilken spesifikk hendelse skal aktivere varselet?',
    'Assets Event'                                         => 'Asset-hendelse',
    'Commerce Orders Event'                                => 'Commerce-ordrehendelse',
    'Commerce Products Event'                              => 'Commerce-produkthendelse',
    'Digital Products Event'                               => 'Digital Products-hendelse',
    'Digital Product Licenses Event'                       => 'Digital Products-lisenshendelse',
    'Solspace Calendar Event'                              => 'Solspace Calendar-hendelse',
    'Entries Event'                                        => 'Innleggshendelse',
    'Users Event'                                          => 'Brukerhendelse',

    // Field and element conditions
    'Field Conditions'                                                               => 'Feltbetingelser',
    'Send the message only when the saved element matches the following conditions.' => 'Send meldingen kun når det lagrede elementet oppfyller følgende betingelser.',
    'has changed'                                                                    => 'har endret seg',
    '#{elementType} Event Filters'                                                   => 'Hendelsesfiltre for #{elementType}',
    'No filters match this event.'                                                   => 'Ingen filtre samsvarer med denne hendelsen.',
    'Determine whether each message should be sent based on specified conditions.'   => 'Avgjør om hver melding skal sendes basert på angitte betingelser.',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => 'Elementet lagres for første gang',
    'Must be a new entry'                       => 'Må være et nytt innlegg',
    'Must be an existing entry'                 => 'Må være et eksisterende innlegg',
    'Can be existing or new'                    => 'Kan være eksisterende eller nytt',

    // Filters: new elements
    'Element is new'         => 'Elementet er nytt',
    'New elements only'      => 'Bare nye elementer',
    'Existing elements only' => 'Bare eksisterende elementer',

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
    'Element is a provisional draft'                => 'Elementet er et midlertidig utkast',
    'Must be a provisional draft'                   => 'Må være et midlertidig utkast',
    'Must not be a provisional draft'               => 'Må ikke være et midlertidig utkast',
    'Can be a provisional draft or non-provisional' => 'Kan være midlertidig eller ikke',

    // Filters: revisions
    'Element is a revision'             => 'Elementet er en revisjon',
    'Must be a revision'                => 'Må være en revisjon',
    'Must not be a revision'            => 'Må ikke være en revisjon',
    'Can be a revision or non-revision' => 'Kan være en revisjon eller ikke',

    // Filters: duplication
    'Element is being duplicated'         => 'Elementet dupliseres',
    'Must be duplicating the element'     => 'Må være i ferd med å duplisere elementet',
    'Must not be duplicating the element' => 'Må ikke være i ferd med å duplisere elementet',

    // Filters: propagation
    'Element is being propagated'     => 'Elementet propageres',
    'Element must be propagating'     => 'Elementet må være under propagering',
    'Element must not be propagating' => 'Elementet må ikke være under propagering',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => 'Elementet lagres på nytt i en bulkjobb',
    'Must be bulk-resaving the element'     => 'Må være i ferd med å lagre elementet på nytt i en bulkjobb',
    'Must not be bulk-resaving the element' => 'Må ikke være i ferd med å lagre elementet på nytt i en bulkjobb',

    // Filters: common output
    'Unnamed filter'                => 'Filter uten navn',
    'Must be TRUE to send message'  => 'Må være TRUE for å sende meldingen',
    'Must be FALSE to send message' => 'Må være FALSE for å sende meldingen',
    'No effect'                     => 'Ingen effekt',

    // Message tab: type selector and queue
    'Message Type'                                                 => 'Meldingstype',
    'What type of message will be sent?'                           => 'Hvilken type melding skal sendes?',
    'Send Message via Queue'                                       => 'Send melding via kø',
    'Should the message be sent via the [jobs queue]({queueUrl})?' => 'Skal meldingen sendes via [oppgavekøen]({queueUrl})?',

    // Email message
    'Email Subject'              => 'E-postemne',
    'Email Body'                 => 'E-postinnhold',
    "User's Email Address Field" => 'Brukerens e-postadressefelt',

    // SMS message
    'SMS Message Body'          => 'Innhold for SMS-melding',
    "User's Phone Number Field" => 'Brukerens telefonnummerfelt',

    // Announcement message
    'Announcement Title'   => 'Kunngjøringstittel',
    'Announcement Message' => 'Kunngjøringsmelding',

    // Flash message
    'Flash Message Type'                         => 'Type flashmelding',
    'Flash Message Title'                        => 'Tittel for flashmelding',
    'Flash Message Details'                      => 'Detaljer for flashmelding',
    'Which type of flash message should appear?' => 'Hvilken type flashmelding skal vises?',

    // Trix toolbar (rich-text editing)
    'Rich Text'     => 'Formatert tekst',
    'Bold'          => 'Fet',
    'Italic'        => 'Kursiv',
    'Underline'     => 'Understreket',
    'Strikethrough' => 'Gjennomstreket',
    'Bullets'       => 'Punktliste',
    'Numbers'       => 'Nummerert liste',
    'Heading'       => 'Overskrift',
    'Code'          => 'Kode',
    'Undo'          => 'Angre',
    'Redo'          => 'Gjør om',

    // Email body instructions (HTML)
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => 'Innhold for utgående e-post. Du kan bruke <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">spesielle variabler</a>, eller til og med <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">hoppe over mottakere</a>.',

    // Recipients tab
    'Recipients Type'                             => 'Type mottakere',
    'Who will receive this message?'              => 'Hvem skal motta meldingen?',
    'Add a message recipient'                     => 'Legg til en mottaker',
    'Select User(s)'                              => 'Velg bruker(e)',
    'Which users will receive the message?'       => 'Hvilke brukere skal motta meldingen?',
    'Which user groups will receive the message?' => 'Hvilke brukergrupper skal motta meldingen?',
    'Ungrouped Users'                             => 'Brukere uten gruppe',
    'Twig Snippet to Determine Recipients'        => 'Twig-snutt for å bestemme mottakere',

    // Settings: Twilio
    'Twilio Account SID'                             => 'Twilio Account SID',
    'Twilio Auth Token'                              => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)'   => 'Twilio-telefonnummer (sender hver SMS-melding)',
    'This is being set in the config file. [{file}]' => 'Settes i konfigurasjonsfilen. [{file}]',

    // Settings: Logging
    'Logging'                                                                                                                                         => 'Logging',
    'Enable Logging'                                                                                                                                  => 'Aktiver logging',
    'When disabled, Notifier will not write anything to the notification log.'                                                                        => 'Når deaktivert skriver ikke Notifier noe til varselloggen.',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier fører en kontinuerlig logg over sendte meldinger. Det er som regel ikke nødvendig, men du kan begrense antallet loggoppføringer i databasen.',
    'Number of log events to retain'                                                                                                                  => 'Antall loggoppføringer som skal beholdes',
    'At most, keep this many log events. Leave blank for no limit.'                                                                                   => 'Behold maksimalt dette antallet loggoppføringer. La feltet stå tomt for ingen grense.',
    'Number of days to retain log events'                                                                                                             => 'Antall dager loggoppføringer skal beholdes',
    'At most, keep log events for this many days. Leave blank for no limit.'                                                                          => 'Behold loggoppføringer i maksimalt dette antallet dager. La feltet stå tomt for ingen grense.',

    // Test notification
    'Send a test message'                                                                                                          => 'Send testmelding',
    'Are you certain you want to send a test notification?\n\nThe configured message will be sent to the configured recipient(s).' => 'Er du sikker på at du vil sende et testvarsel?\n\nDen konfigurerte meldingen sendes til de konfigurerte mottakerne.',
    'Test'                                                                                                                         => 'Test',
    'Test notification dispatched.'                                                                                                => 'Testvarsel sendt.',
    'No messages were dispatched. Check the recipient configuration.'                                                              => 'Ingen meldinger ble sendt. Sjekk mottakerkonfigurasjonen.',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.' => 'Sender {messageType} til {recipient}.',
    'Log events deleted.'                   => 'Loggoppføringer slettet.',
    'notification'                          => 'varsel',

    // Errors
    'Invalid email message mode.'                                    => 'Ugyldig modus for e-postmelding.',
    'Dynamic recipients snippet did not call setRecipients.'         => 'Snutten for dynamiske mottakere kalte ikke setRecipients.',
    'setRecipients was called with an empty value.'                  => 'setRecipients ble kalt med en tom verdi.',
    'Unrecognized recipient "{value}".'                              => 'Ukjent mottaker "{value}".',
    'Unrecognized recipient of type "{type}".'                       => 'Ukjent mottaker av typen "{type}".',
    'Recipient "{name}" has no email address.'                       => 'Mottakeren "{name}" har ingen e-postadresse.',
    'Recipient "{name}" has no phone number.'                        => 'Mottakeren "{name}" har intet telefonnummer.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => 'Mottakeren "{name}" har ingen tilknyttet bruker; kunngjøringen kan ikke sendes.',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => 'Mottakeren "{name}" har ikke tilgang til kontrollpanelet; kunngjøringen kan ikke sendes.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Du har ikke tillatelse til å bruke typen Dynamiske mottakere.',

];
