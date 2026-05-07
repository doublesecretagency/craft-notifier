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
    'Notifications'          => 'Aviseringar',
    'Notification'           => 'Avisering',
    'All notifications'      => 'Alla aviseringar',
    'Notification Log'       => 'Aviseringslogg',
    'Logs'                   => 'Loggar',
    'View Notifications'     => 'Visa aviseringar',
    'Add a New Notification' => 'Lägg till en ny avisering',

    // Permissions
    'View notifications'              => 'Visa aviseringar',
    'Save notifications'              => 'Spara aviseringar',
    'Use the Dynamic Recipients type' => 'Använda typen Dynamiska mottagare',
    'Delete notifications'            => 'Ta bort aviseringar',
    'View notification log'           => 'Visa aviseringsloggen',
    'Delete notification log'         => 'Ta bort aviseringsloggen',

    // Notification editor: tabs
    'Meta'       => 'Meta',
    'Event'      => 'Händelse',
    'Message'    => 'Meddelande',
    'Recipients' => 'Mottagare',

    // Event tab
    'Event Type'                                           => 'Händelsetyp',
    'What type of event will activate the notification?'   => 'Vilken typ av händelse ska aktivera aviseringen?',
    'Which specific event will activate the notification?' => 'Vilken specifik händelse ska aktivera aviseringen?',
    'Assets Event'                                         => 'Asset-händelse',
    'Commerce Orders Event'                                => 'Commerce-orderhändelse',
    'Entries Event'                                        => 'Inläggshändelse',
    'Users Event'                                          => 'Användarhändelse',

    // Field and element conditions
    'Field Conditions'                                                               => 'Fältvillkor',
    'Send the message only when the saved element matches the following conditions.' => 'Skicka meddelandet endast när det sparade elementet uppfyller följande villkor.',
    '#{elementType} Event Filters'                                                   => 'Händelsefilter för #{elementType}',
    'No filters match this event.'                                                   => 'Inga filter matchar den här händelsen.',
    'Determine whether each message should be sent based on specified conditions.'   => 'Avgör om varje meddelande ska skickas baserat på angivna villkor.',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => 'Elementet sparas för första gången',
    'Must be a new entry'                       => 'Måste vara ett nytt inlägg',
    'Must be an existing entry'                 => 'Måste vara ett befintligt inlägg',
    'Can be existing or new'                    => 'Kan vara befintligt eller nytt',

    // Filters: new elements
    'Element is new'         => 'Elementet är nytt',
    'New elements only'      => 'Endast nya element',
    'Existing elements only' => 'Endast befintliga element',

    // Filters: enabled state
    'Element is enabled'         => 'Elementet är aktiverat',
    'Must be enabled'            => 'Måste vara aktiverat',
    'Must be disabled'           => 'Måste vara inaktiverat',
    'Can be enabled or disabled' => 'Kan vara aktiverat eller inaktiverat',

    // Filters: drafts
    'Element is a draft'          => 'Elementet är ett utkast',
    'Must be a draft'             => 'Måste vara ett utkast',
    'Must not be a draft'         => 'Får inte vara ett utkast',
    'Can be a draft or non-draft' => 'Kan vara utkast eller inte',

    // Filters: provisional drafts
    'Element is a provisional draft'                => 'Elementet är ett provisoriskt utkast',
    'Must be a provisional draft'                   => 'Måste vara ett provisoriskt utkast',
    'Must not be a provisional draft'               => 'Får inte vara ett provisoriskt utkast',
    'Can be a provisional draft or non-provisional' => 'Kan vara provisoriskt eller inte',

    // Filters: revisions
    'Element is a revision'             => 'Elementet är en revision',
    'Must be a revision'                => 'Måste vara en revision',
    'Must not be a revision'            => 'Får inte vara en revision',
    'Can be a revision or non-revision' => 'Kan vara en revision eller inte',

    // Filters: duplication
    'Element is being duplicated'         => 'Elementet dupliceras',
    'Must be duplicating the element'     => 'Måste hålla på att duplicera elementet',
    'Must not be duplicating the element' => 'Får inte hålla på att duplicera elementet',

    // Filters: propagation
    'Element is being propagated'     => 'Elementet propageras',
    'Element must be propagating'     => 'Elementet måste vara under propagering',
    'Element must not be propagating' => 'Elementet får inte vara under propagering',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => 'Elementet sparas om i ett bulkjobb',
    'Must be bulk-resaving the element'     => 'Måste hålla på att spara om elementet i ett bulkjobb',
    'Must not be bulk-resaving the element' => 'Får inte hålla på att spara om elementet i ett bulkjobb',

    // Filters: common output
    'Unnamed filter'                => 'Namnlöst filter',
    'Must be TRUE to send message'  => 'Måste vara TRUE för att skicka meddelandet',
    'Must be FALSE to send message' => 'Måste vara FALSE för att skicka meddelandet',
    'No effect'                     => 'Ingen effekt',

    // Message tab: type selector and queue
    'Message Type'                                                 => 'Meddelandetyp',
    'What type of message will be sent?'                           => 'Vilken typ av meddelande ska skickas?',
    'Send Message via Queue'                                       => 'Skicka meddelande via kö',
    'Should the message be sent via the [jobs queue]({queueUrl})?' => 'Ska meddelandet skickas via [jobbkön]({queueUrl})?',

    // Email message
    'Email Subject'              => 'Ämnesrad',
    'Email Body'                 => 'E-postinnehåll',
    "User's Email Address Field" => 'Användarens e-postadressfält',

    // SMS message
    'SMS Message Body'          => 'Innehåll för SMS-meddelande',
    "User's Phone Number Field" => 'Användarens telefonnummerfält',

    // Announcement message
    'Announcement Title'   => 'Tillkännagivandets titel',
    'Announcement Message' => 'Tillkännagivandets meddelande',

    // Flash message
    'Flash Message Type'                         => 'Typ av flashmeddelande',
    'Flash Message Title'                        => 'Titel för flashmeddelande',
    'Flash Message Details'                      => 'Detaljer för flashmeddelande',
    'Which type of flash message should appear?' => 'Vilken typ av flashmeddelande ska visas?',

    // Trix toolbar (rich-text editing)
    'Rich Text'     => 'Formaterad text',
    'Bold'          => 'Fetstil',
    'Italic'        => 'Kursiv',
    'Underline'     => 'Understruken',
    'Strikethrough' => 'Genomstruken',
    'Bullets'       => 'Punktlista',
    'Numbers'       => 'Numrerad lista',
    'Heading'       => 'Rubrik',
    'Code'          => 'Kod',
    'Undo'          => 'Ångra',
    'Redo'          => 'Gör om',

    // Email body instructions (HTML)
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => 'Innehåll för utgående e-post. Du kan använda <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">specialvariabler</a>, eller till och med <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">hoppa över mottagare</a>.',

    // Recipients tab
    'Recipients Type'                             => 'Typ av mottagare',
    'Who will receive this message?'              => 'Vem ska ta emot meddelandet?',
    'Add a message recipient'                     => 'Lägg till en mottagare',
    'Select User(s)'                              => 'Välj användare',
    'Which users will receive the message?'       => 'Vilka användare ska ta emot meddelandet?',
    'Which user groups will receive the message?' => 'Vilka användargrupper ska ta emot meddelandet?',
    'Restricted to Admins Only?'                  => 'Endast för administratörer?',
    'Ungrouped Users'                             => 'Användare utan grupp',
    'Twig Snippet to Determine Recipients'        => 'Twig-snutt för att bestämma mottagare',

    // Settings: Twilio
    'Twilio Account SID'                             => 'Twilio Account SID',
    'Twilio Auth Token'                              => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)'   => 'Twilio-telefonnummer (skickar varje SMS-meddelande)',
    'This is being set in the config file. [{file}]' => 'Anges i konfigurationsfilen. [{file}]',

    // Settings: Logging
    'Logging'                                                                                                                                         => 'Loggning',
    'Enable Logging'                                                                                                                                  => 'Aktivera loggning',
    'When disabled, Notifier will not write anything to the notification log.'                                                                        => 'När det är inaktiverat skriver Notifier ingenting till aviseringsloggen.',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier för en löpande logg över skickade meddelanden. Det är vanligtvis inte nödvändigt, men du kan begränsa antalet loggposter i databasen.',
    'Number of log events to retain'                                                                                                                  => 'Antal loggposter att behålla',
    'At most, keep this many log events. Leave blank for no limit.'                                                                                   => 'Behåll högst det här antalet loggposter. Lämna tomt för ingen gräns.',
    'Number of days to retain log events'                                                                                                             => 'Antal dagar att behålla loggposter',
    'At most, keep log events for this many days. Leave blank for no limit.'                                                                          => 'Behåll loggposter i högst det här antalet dagar. Lämna tomt för ingen gräns.',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.' => 'Skickar {messageType} till {recipient}.',
    'Log events deleted.'                   => 'Loggposter borttagna.',
    'notification'                          => 'avisering',

    // Errors
    'Invalid email message mode.'                                    => 'Ogiltigt e-postmeddelandeläge.',
    'Dynamic recipients snippet did not call setRecipients.'         => 'Snutten för dynamiska mottagare anropade inte setRecipients.',
    'setRecipients was called with an empty value.'                  => 'setRecipients anropades med ett tomt värde.',
    'Unrecognized recipient "{value}".'                              => 'Okänd mottagare "{value}".',
    'Unrecognized recipient of type "{type}".'                       => 'Okänd mottagare av typen "{type}".',
    'Recipient "{name}" has no email address.'                       => 'Mottagaren "{name}" har ingen e-postadress.',
    'Recipient "{name}" has no phone number.'                        => 'Mottagaren "{name}" har inget telefonnummer.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Du har inte behörighet att använda typen Dynamiska mottagare.',

];
