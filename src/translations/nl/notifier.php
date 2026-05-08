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
    'Notifications'          => 'Meldingen',
    'Notification'           => 'Melding',
    'All notifications'      => 'Alle meldingen',
    'Notification Log'       => 'Meldingenlogboek',
    'Logs'                   => 'Logs',
    'View Notifications'     => 'Meldingen bekijken',
    'Add a New Notification' => 'Nieuwe melding toevoegen',

    // Permissions
    'View notifications'              => 'Meldingen bekijken',
    'Save notifications'              => 'Meldingen opslaan',
    'Use the Dynamic Recipients type' => 'Het type Dynamische ontvangers gebruiken',
    'Test notifications'              => 'Notificaties testen',
    'Delete notifications'            => 'Meldingen verwijderen',
    'View notification log'           => 'Meldingenlogboek bekijken',
    'Delete notification log'         => 'Meldingenlogboek verwijderen',

    // Notification editor: tabs
    'Meta'       => 'Meta',
    'Event'      => 'Gebeurtenis',
    'Message'    => 'Bericht',
    'Recipients' => 'Ontvangers',

    // Event tab
    'Event Type'                                           => 'Soort gebeurtenis',
    'What type of event will activate the notification?'   => 'Welk soort gebeurtenis activeert de melding?',
    'Which specific event will activate the notification?' => 'Welke specifieke gebeurtenis activeert de melding?',
    'Assets Event'                                         => 'Asset-gebeurtenis',
    'Commerce Orders Event'                                => 'Commerce-bestellingsgebeurtenis',
    'Entries Event'                                        => 'Entry-gebeurtenis',
    'Users Event'                                          => 'Gebruikersgebeurtenis',

    // Field and element conditions
    'Field Conditions'                                                               => 'Veldcondities',
    'Send the message only when the saved element matches the following conditions.' => 'Verstuur het bericht alleen wanneer het opgeslagen element aan de volgende condities voldoet.',
    'has changed'                                                                    => 'is gewijzigd',
    '#{elementType} Event Filters'                                                   => 'Gebeurtenisfilters voor #{elementType}',
    'No filters match this event.'                                                   => 'Geen filters komen overeen met deze gebeurtenis.',
    'Determine whether each message should be sent based on specified conditions.'   => 'Bepaal of elk bericht verstuurd moet worden op basis van opgegeven condities.',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => 'Het element wordt voor het eerst opgeslagen',
    'Must be a new entry'                       => 'Moet een nieuwe entry zijn',
    'Must be an existing entry'                 => 'Moet een bestaande entry zijn',
    'Can be existing or new'                    => 'Kan bestaand of nieuw zijn',

    // Filters: new elements
    'Element is new'         => 'Het element is nieuw',
    'New elements only'      => 'Alleen nieuwe elementen',
    'Existing elements only' => 'Alleen bestaande elementen',

    // Filters: enabled state
    'Element is enabled'         => 'Het element is ingeschakeld',
    'Must be enabled'            => 'Moet ingeschakeld zijn',
    'Must be disabled'           => 'Moet uitgeschakeld zijn',
    'Can be enabled or disabled' => 'Kan in- of uitgeschakeld zijn',

    // Filters: drafts
    'Element is a draft'          => 'Het element is een concept',
    'Must be a draft'             => 'Moet een concept zijn',
    'Must not be a draft'         => 'Mag geen concept zijn',
    'Can be a draft or non-draft' => 'Kan een concept zijn of niet',

    // Filters: provisional drafts
    'Element is a provisional draft'                => 'Het element is een voorlopig concept',
    'Must be a provisional draft'                   => 'Moet een voorlopig concept zijn',
    'Must not be a provisional draft'               => 'Mag geen voorlopig concept zijn',
    'Can be a provisional draft or non-provisional' => 'Kan voorlopig zijn of niet',

    // Filters: revisions
    'Element is a revision'             => 'Het element is een revisie',
    'Must be a revision'                => 'Moet een revisie zijn',
    'Must not be a revision'            => 'Mag geen revisie zijn',
    'Can be a revision or non-revision' => 'Kan een revisie zijn of niet',

    // Filters: duplication
    'Element is being duplicated'         => 'Het element wordt gedupliceerd',
    'Must be duplicating the element'     => 'Moet het element dupliceren',
    'Must not be duplicating the element' => 'Mag het element niet dupliceren',

    // Filters: propagation
    'Element is being propagated'     => 'Het element wordt doorgevoerd',
    'Element must be propagating'     => 'Het element moet doorgevoerd worden',
    'Element must not be propagating' => 'Het element mag niet doorgevoerd worden',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => 'Het element wordt in bulk opnieuw opgeslagen',
    'Must be bulk-resaving the element'     => 'Moet het element in bulk opnieuw opslaan',
    'Must not be bulk-resaving the element' => 'Mag het element niet in bulk opnieuw opslaan',

    // Filters: common output
    'Unnamed filter'                => 'Naamloos filter',
    'Must be TRUE to send message'  => 'Moet TRUE zijn om het bericht te versturen',
    'Must be FALSE to send message' => 'Moet FALSE zijn om het bericht te versturen',
    'No effect'                     => 'Geen effect',

    // Message tab: type selector and queue
    'Message Type'                                                 => 'Berichttype',
    'What type of message will be sent?'                           => 'Welk type bericht wordt verstuurd?',
    'Send Message via Queue'                                       => 'Bericht via wachtrij versturen',
    'Should the message be sent via the [jobs queue]({queueUrl})?' => 'Moet het bericht via de [taakwachtrij]({queueUrl}) verstuurd worden?',

    // Email message
    'Email Subject'              => 'E-mailonderwerp',
    'Email Body'                 => 'E-mailtekst',
    "User's Email Address Field" => 'Veld voor e-mailadres van gebruiker',

    // SMS message
    'SMS Message Body'          => 'SMS-berichttekst',
    "User's Phone Number Field" => 'Veld voor telefoonnummer van gebruiker',

    // Announcement message
    'Announcement Title'   => 'Aankondigingstitel',
    'Announcement Message' => 'Aankondigingsbericht',

    // Flash message
    'Flash Message Type'                         => 'Type flashbericht',
    'Flash Message Title'                        => 'Titel van flashbericht',
    'Flash Message Details'                      => 'Details van flashbericht',
    'Which type of flash message should appear?' => 'Welk type flashbericht moet verschijnen?',

    // Trix toolbar (rich-text editing)
    'Rich Text'     => 'Opgemaakte tekst',
    'Bold'          => 'Vet',
    'Italic'        => 'Cursief',
    'Underline'     => 'Onderstreept',
    'Strikethrough' => 'Doorgehaald',
    'Bullets'       => 'Opsomming',
    'Numbers'       => 'Genummerd',
    'Heading'       => 'Kop',
    'Code'          => 'Code',
    'Undo'          => 'Ongedaan maken',
    'Redo'          => 'Opnieuw',

    // Email body instructions (HTML)
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => 'Tekst van uitgaande e-mail. Je kunt <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">speciale variabelen</a> gebruiken, of zelfs <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">ontvangers overslaan</a>.',

    // Recipients tab
    'Recipients Type'                             => 'Type ontvangers',
    'Who will receive this message?'              => 'Wie ontvangt dit bericht?',
    'Add a message recipient'                     => 'Een ontvanger toevoegen',
    'Select User(s)'                              => 'Gebruiker(s) selecteren',
    'Which users will receive the message?'       => 'Welke gebruikers ontvangen het bericht?',
    'Which user groups will receive the message?' => 'Welke gebruikersgroepen ontvangen het bericht?',
    'Restricted to Admins Only?'                  => 'Alleen voor beheerders?',
    'Ungrouped Users'                             => 'Gebruikers zonder groep',
    'Twig Snippet to Determine Recipients'        => 'Twig-snippet om ontvangers te bepalen',

    // Settings: Twilio
    'Twilio Account SID'                             => 'Twilio Account SID',
    'Twilio Auth Token'                              => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)'   => 'Twilio-telefoonnummer (verstuurt elk SMS-bericht)',
    'This is being set in the config file. [{file}]' => 'Dit wordt ingesteld in het configuratiebestand. [{file}]',

    // Settings: Logging
    'Logging'                                                                                                                                         => 'Logboekregistratie',
    'Enable Logging'                                                                                                                                  => 'Logboekregistratie inschakelen',
    'When disabled, Notifier will not write anything to the notification log.'                                                                        => 'Wanneer uitgeschakeld, schrijft Notifier niets in het meldingenlogboek.',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier houdt een doorlopend logboek bij van verstuurde berichten. Hoewel doorgaans niet nodig, kun je het aantal logboekgebeurtenissen in de database beperken.',
    'Number of log events to retain'                                                                                                                  => 'Aantal logboekgebeurtenissen dat bewaard wordt',
    'At most, keep this many log events. Leave blank for no limit.'                                                                                   => 'Bewaar maximaal dit aantal logboekgebeurtenissen. Laat leeg voor geen limiet.',
    'Number of days to retain log events'                                                                                                             => 'Aantal dagen dat logboekgebeurtenissen bewaard worden',
    'At most, keep log events for this many days. Leave blank for no limit.'                                                                          => 'Bewaar logboekgebeurtenissen maximaal dit aantal dagen. Laat leeg voor geen limiet.',

    // Test notification
    'Send a test message'                                                                                                          => 'Testbericht verzenden',
    'Are you certain you want to send a test notification?\n\nThe configured message will be sent to the configured recipient(s).' => 'Weet je zeker dat je een testmelding wilt verzenden?\n\nHet geconfigureerde bericht wordt naar de geconfigureerde ontvangers gestuurd.',
    'Test'                                                                                                                         => 'Test',
    'Test notification dispatched.'                                                                                                => 'Testmelding verzonden.',
    'No messages were dispatched. Check the recipient configuration.'                                                              => 'Er zijn geen berichten verzonden. Controleer de ontvangersconfiguratie.',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.' => '{messageType} versturen naar {recipient}.',
    'Log events deleted.'                   => 'Logboekgebeurtenissen verwijderd.',
    'notification'                          => 'melding',

    // Errors
    'Invalid email message mode.'                                    => 'Ongeldige e-mailmodus.',
    'Dynamic recipients snippet did not call setRecipients.'         => 'Het snippet voor dynamische ontvangers heeft setRecipients niet aangeroepen.',
    'setRecipients was called with an empty value.'                  => 'setRecipients is aangeroepen met een lege waarde.',
    'Unrecognized recipient "{value}".'                              => 'Onbekende ontvanger "{value}".',
    'Unrecognized recipient of type "{type}".'                       => 'Onbekende ontvanger van type "{type}".',
    'Recipient "{name}" has no email address.'                       => 'Ontvanger "{name}" heeft geen e-mailadres.',
    'Recipient "{name}" has no phone number.'                        => 'Ontvanger "{name}" heeft geen telefoonnummer.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Je hebt geen toestemming om het type Dynamische ontvangers te gebruiken.',

];
