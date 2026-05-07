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
    'Notifications'          => 'Benachrichtigungen',
    'Notification'           => 'Benachrichtigung',
    'All notifications'      => 'Alle Benachrichtigungen',
    'Notification Log'       => 'Benachrichtigungsprotokoll',
    'Logs'                   => 'Protokolle',
    'View Notifications'     => 'Benachrichtigungen anzeigen',
    'Add a New Notification' => 'Neue Benachrichtigung hinzufügen',

    // Permissions
    'View notifications'              => 'Benachrichtigungen anzeigen',
    'Save notifications'              => 'Benachrichtigungen speichern',
    'Use the Dynamic Recipients type' => 'Den Typ Dynamische Empfänger verwenden',
    'Delete notifications'            => 'Benachrichtigungen löschen',
    'View notification log'           => 'Benachrichtigungsprotokoll anzeigen',
    'Delete notification log'         => 'Benachrichtigungsprotokoll löschen',

    // Notification editor: tabs
    'Meta'       => 'Meta',
    'Event'      => 'Ereignis',
    'Message'    => 'Nachricht',
    'Recipients' => 'Empfänger',

    // Event tab
    'Event Type'                                           => 'Ereignistyp',
    'What type of event will activate the notification?'   => 'Welche Art von Ereignis löst die Benachrichtigung aus?',
    'Which specific event will activate the notification?' => 'Welches konkrete Ereignis löst die Benachrichtigung aus?',
    'Assets Event'                                         => 'Asset-Ereignis',
    'Commerce Orders Event'                                => 'Commerce-Bestellungsereignis',
    'Entries Event'                                        => 'Eintragsereignis',
    'Users Event'                                          => 'Benutzerereignis',

    // Field and element conditions
    'Field Conditions'                                                               => 'Feldbedingungen',
    'Send the message only when the saved element matches the following conditions.' => 'Die Nachricht nur senden, wenn das gespeicherte Element die folgenden Bedingungen erfüllt.',
    '#{elementType} Event Filters'                                                   => 'Ereignisfilter für #{elementType}',
    'No filters match this event.'                                                   => 'Keine Filter passen zu diesem Ereignis.',
    'Determine whether each message should be sent based on specified conditions.'   => 'Bestimmen Sie anhand festgelegter Bedingungen, ob die jeweilige Nachricht gesendet werden soll.',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => 'Das Element wird zum ersten Mal gespeichert',
    'Must be a new entry'                       => 'Muss ein neuer Eintrag sein',
    'Must be an existing entry'                 => 'Muss ein vorhandener Eintrag sein',
    'Can be existing or new'                    => 'Kann vorhanden oder neu sein',

    // Filters: new elements
    'Element is new'         => 'Das Element ist neu',
    'New elements only'      => 'Nur neue Elemente',
    'Existing elements only' => 'Nur vorhandene Elemente',

    // Filters: enabled state
    'Element is enabled'         => 'Das Element ist aktiviert',
    'Must be enabled'            => 'Muss aktiviert sein',
    'Must be disabled'           => 'Muss deaktiviert sein',
    'Can be enabled or disabled' => 'Kann aktiviert oder deaktiviert sein',

    // Filters: drafts
    'Element is a draft'          => 'Das Element ist ein Entwurf',
    'Must be a draft'             => 'Muss ein Entwurf sein',
    'Must not be a draft'         => 'Darf kein Entwurf sein',
    'Can be a draft or non-draft' => 'Kann Entwurf oder kein Entwurf sein',

    // Filters: provisional drafts
    'Element is a provisional draft'                => 'Das Element ist ein provisorischer Entwurf',
    'Must be a provisional draft'                   => 'Muss ein provisorischer Entwurf sein',
    'Must not be a provisional draft'               => 'Darf kein provisorischer Entwurf sein',
    'Can be a provisional draft or non-provisional' => 'Kann provisorischer Entwurf oder regulär sein',

    // Filters: revisions
    'Element is a revision'             => 'Das Element ist eine Revision',
    'Must be a revision'                => 'Muss eine Revision sein',
    'Must not be a revision'            => 'Darf keine Revision sein',
    'Can be a revision or non-revision' => 'Kann Revision oder keine Revision sein',

    // Filters: duplication
    'Element is being duplicated'         => 'Das Element wird dupliziert',
    'Must be duplicating the element'     => 'Das Element muss dupliziert werden',
    'Must not be duplicating the element' => 'Das Element darf nicht dupliziert werden',

    // Filters: propagation
    'Element is being propagated'     => 'Das Element wird propagiert',
    'Element must be propagating'     => 'Das Element muss propagiert werden',
    'Element must not be propagating' => 'Das Element darf nicht propagiert werden',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => 'Das Element wird im Stapel neu gespeichert',
    'Must be bulk-resaving the element'     => 'Das Element muss im Stapel neu gespeichert werden',
    'Must not be bulk-resaving the element' => 'Das Element darf nicht im Stapel neu gespeichert werden',

    // Filters: common output
    'Unnamed filter'                => 'Unbenannter Filter',
    'Must be TRUE to send message'  => 'Muss TRUE sein, um die Nachricht zu senden',
    'Must be FALSE to send message' => 'Muss FALSE sein, um die Nachricht zu senden',
    'No effect'                     => 'Keine Wirkung',

    // Message tab: type selector and queue
    'Message Type'                                                 => 'Nachrichtentyp',
    'What type of message will be sent?'                           => 'Welche Art von Nachricht wird gesendet?',
    'Send Message via Queue'                                       => 'Nachricht über Warteschlange senden',
    'Should the message be sent via the [jobs queue]({queueUrl})?' => 'Soll die Nachricht über die [Auftrags-Warteschlange]({queueUrl}) gesendet werden?',

    // Email message
    'Email Subject'              => 'E-Mail-Betreff',
    'Email Body'                 => 'E-Mail-Text',
    "User's Email Address Field" => 'Benutzerfeld für E-Mail-Adresse',

    // SMS message
    'SMS Message Body'          => 'SMS-Nachrichtentext',
    "User's Phone Number Field" => 'Benutzerfeld für Telefonnummer',

    // Announcement message
    'Announcement Title'   => 'Ankündigungstitel',
    'Announcement Message' => 'Ankündigungstext',

    // Flash message
    'Flash Message Type'                         => 'Flash-Nachrichtentyp',
    'Flash Message Title'                        => 'Flash-Nachrichtentitel',
    'Flash Message Details'                      => 'Flash-Nachrichtendetails',
    'Which type of flash message should appear?' => 'Welche Art von Flash-Nachricht soll erscheinen?',

    // Trix toolbar (rich-text editing)
    'Rich Text'     => 'Rich Text',
    'Bold'          => 'Fett',
    'Italic'        => 'Kursiv',
    'Underline'     => 'Unterstrichen',
    'Strikethrough' => 'Durchgestrichen',
    'Bullets'       => 'Aufzählung',
    'Numbers'       => 'Nummerierung',
    'Heading'       => 'Überschrift',
    'Code'          => 'Code',
    'Undo'          => 'Rückgängig',
    'Redo'          => 'Wiederholen',

    // Email body instructions (HTML)
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => 'Text der ausgehenden E-Mail. Sie können <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">spezielle Variablen</a> verwenden oder sogar <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">Empfänger überspringen</a>.',

    // Recipients tab
    'Recipients Type'                             => 'Empfängertyp',
    'Who will receive this message?'              => 'Wer soll diese Nachricht erhalten?',
    'Add a message recipient'                     => 'Empfänger hinzufügen',
    'Select User(s)'                              => 'Benutzer auswählen',
    'Which users will receive the message?'       => 'Welche Benutzer sollen die Nachricht erhalten?',
    'Which user groups will receive the message?' => 'Welche Benutzergruppen sollen die Nachricht erhalten?',
    'Restricted to Admins Only?'                  => 'Nur für Administratoren?',
    'Ungrouped Users'                             => 'Benutzer ohne Gruppe',
    'Twig Snippet to Determine Recipients'        => 'Twig-Snippet zur Bestimmung der Empfänger',

    // Settings: Twilio
    'Twilio Account SID'                             => 'Twilio Account SID',
    'Twilio Auth Token'                              => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)'   => 'Twilio-Telefonnummer (versendet jede SMS-Nachricht)',
    'This is being set in the config file. [{file}]' => 'Dies wird in der Konfigurationsdatei festgelegt. [{file}]',

    // Settings: Logging
    'Logging'                                                                                                                                         => 'Protokollierung',
    'Enable Logging'                                                                                                                                  => 'Protokollierung aktivieren',
    'When disabled, Notifier will not write anything to the notification log.'                                                                        => 'Bei Deaktivierung schreibt Notifier nichts in das Benachrichtigungsprotokoll.',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier führt ein fortlaufendes Protokoll der gesendeten Nachrichten. Normalerweise nicht erforderlich, aber Sie können die Anzahl der in der Datenbank gespeicherten Protokollereignisse begrenzen.',
    'Number of log events to retain'                                                                                                                  => 'Anzahl der zu behaltenden Protokollereignisse',
    'At most, keep this many log events. Leave blank for no limit.'                                                                                   => 'Höchstens diese Anzahl an Protokollereignissen behalten. Leer lassen für kein Limit.',
    'Number of days to retain log events'                                                                                                             => 'Anzahl der Tage, an denen Protokollereignisse aufbewahrt werden',
    'At most, keep log events for this many days. Leave blank for no limit.'                                                                          => 'Protokollereignisse höchstens so viele Tage aufbewahren. Leer lassen für kein Limit.',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.' => 'Sende {messageType} an {recipient}.',
    'Log events deleted.'                   => 'Protokollereignisse gelöscht.',
    'notification'                          => 'Benachrichtigung',

    // Errors
    'Invalid email message mode.'                                    => 'Ungültiger E-Mail-Nachrichtenmodus.',
    'Dynamic recipients snippet did not call setRecipients.'         => 'Das Snippet für dynamische Empfänger hat setRecipients nicht aufgerufen.',
    'setRecipients was called with an empty value.'                  => 'setRecipients wurde mit einem leeren Wert aufgerufen.',
    'Unrecognized recipient "{value}".'                              => 'Unbekannter Empfänger "{value}".',
    'Unrecognized recipient of type "{type}".'                       => 'Unbekannter Empfänger vom Typ "{type}".',
    'Recipient "{name}" has no email address.'                       => 'Empfänger "{name}" hat keine E-Mail-Adresse.',
    'Recipient "{name}" has no phone number.'                        => 'Empfänger "{name}" hat keine Telefonnummer.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Sie haben keine Berechtigung, den Typ Dynamische Empfänger zu verwenden.',

];
