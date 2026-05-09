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
    'Notifications'          => 'Powiadomienia',
    'Notification'           => 'Powiadomienie',
    'All notifications'      => 'Wszystkie powiadomienia',
    'Notification Log'       => 'Dziennik powiadomień',
    'Logs'                   => 'Dzienniki',
    'View Notifications'     => 'Wyświetl powiadomienia',
    'Add a New Notification' => 'Dodaj nowe powiadomienie',

    // Permissions
    'View notifications'              => 'Wyświetlanie powiadomień',
    'Save notifications'              => 'Zapisywanie powiadomień',
    'Use the Dynamic Recipients type' => 'Używanie typu Dynamiczni odbiorcy',
    'Test notifications'              => 'Testuj powiadomienia',
    'Delete notifications'            => 'Usuwanie powiadomień',
    'View notification log'           => 'Wyświetlanie dziennika powiadomień',
    'Delete notification log'         => 'Usuwanie dziennika powiadomień',

    // Notification editor: tabs
    'Meta'       => 'Meta',
    'Event'      => 'Zdarzenie',
    'Message'    => 'Wiadomość',
    'Recipients' => 'Odbiorcy',

    // Event tab
    'Event Type'                                           => 'Typ zdarzenia',
    'What type of event will activate the notification?'   => 'Jaki typ zdarzenia uruchomi powiadomienie?',
    'Which specific event will activate the notification?' => 'Które konkretne zdarzenie uruchomi powiadomienie?',
    'Assets Event'                                         => 'Zdarzenie zasobu',
    'Commerce Orders Event'                                => 'Zdarzenie zamówienia Commerce',
    'Entries Event'                                        => 'Zdarzenie wpisu',
    'Users Event'                                          => 'Zdarzenie użytkownika',

    // Field and element conditions
    'Field Conditions'                                                               => 'Warunki pola',
    'Send the message only when the saved element matches the following conditions.' => 'Wyślij wiadomość tylko wtedy, gdy zapisany element spełnia poniższe warunki.',
    'has changed'                                                                    => 'zostało zmienione',
    '#{elementType} Event Filters'                                                   => 'Filtry zdarzeń #{elementType}',
    'No filters match this event.'                                                   => 'Żadne filtry nie pasują do tego zdarzenia.',
    'Determine whether each message should be sent based on specified conditions.'   => 'Określ, czy każda wiadomość ma być wysłana na podstawie wskazanych warunków.',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => 'Element jest zapisywany po raz pierwszy',
    'Must be a new entry'                       => 'Musi być nowym wpisem',
    'Must be an existing entry'                 => 'Musi być istniejącym wpisem',
    'Can be existing or new'                    => 'Może być istniejący lub nowy',

    // Filters: new elements
    'Element is new'         => 'Element jest nowy',
    'New elements only'      => 'Tylko nowe elementy',
    'Existing elements only' => 'Tylko istniejące elementy',

    // Filters: enabled state
    'Element is enabled'         => 'Element jest włączony',
    'Must be enabled'            => 'Musi być włączony',
    'Must be disabled'           => 'Musi być wyłączony',
    'Can be enabled or disabled' => 'Może być włączony lub wyłączony',

    // Filters: drafts
    'Element is a draft'          => 'Element jest wersją roboczą',
    'Must be a draft'             => 'Musi być wersją roboczą',
    'Must not be a draft'         => 'Nie może być wersją roboczą',
    'Can be a draft or non-draft' => 'Może być wersją roboczą lub nie',

    // Filters: provisional drafts
    'Element is a provisional draft'                => 'Element jest tymczasową wersją roboczą',
    'Must be a provisional draft'                   => 'Musi być tymczasową wersją roboczą',
    'Must not be a provisional draft'               => 'Nie może być tymczasową wersją roboczą',
    'Can be a provisional draft or non-provisional' => 'Może być tymczasowy lub nie',

    // Filters: revisions
    'Element is a revision'             => 'Element jest rewizją',
    'Must be a revision'                => 'Musi być rewizją',
    'Must not be a revision'            => 'Nie może być rewizją',
    'Can be a revision or non-revision' => 'Może być rewizją lub nie',

    // Filters: duplication
    'Element is being duplicated'         => 'Element jest duplikowany',
    'Must be duplicating the element'     => 'Musi duplikować element',
    'Must not be duplicating the element' => 'Nie może duplikować elementu',

    // Filters: propagation
    'Element is being propagated'     => 'Element jest propagowany',
    'Element must be propagating'     => 'Element musi być propagowany',
    'Element must not be propagating' => 'Element nie może być propagowany',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => 'Element jest zapisywany ponownie w trybie zbiorczym',
    'Must be bulk-resaving the element'     => 'Musi ponownie zapisywać element w trybie zbiorczym',
    'Must not be bulk-resaving the element' => 'Nie może ponownie zapisywać elementu w trybie zbiorczym',

    // Filters: common output
    'Unnamed filter'                => 'Filtr bez nazwy',
    'Must be TRUE to send message'  => 'Musi mieć wartość TRUE, aby wysłać wiadomość',
    'Must be FALSE to send message' => 'Musi mieć wartość FALSE, aby wysłać wiadomość',
    'No effect'                     => 'Bez efektu',

    // Message tab: type selector and queue
    'Message Type'                                                 => 'Typ wiadomości',
    'What type of message will be sent?'                           => 'Jaki typ wiadomości zostanie wysłany?',
    'Send Message via Queue'                                       => 'Wyślij wiadomość przez kolejkę',
    'Should the message be sent via the [jobs queue]({queueUrl})?' => 'Czy wiadomość ma zostać wysłana przez [kolejkę zadań]({queueUrl})?',

    // Email message
    'Email Subject'              => 'Temat wiadomości',
    'Email Body'                 => 'Treść wiadomości',
    "User's Email Address Field" => 'Pole adresu e-mail użytkownika',

    // SMS message
    'SMS Message Body'          => 'Treść wiadomości SMS',
    "User's Phone Number Field" => 'Pole numeru telefonu użytkownika',

    // Announcement message
    'Announcement Title'   => 'Tytuł ogłoszenia',
    'Announcement Message' => 'Treść ogłoszenia',

    // Flash message
    'Flash Message Type'                         => 'Typ wiadomości flash',
    'Flash Message Title'                        => 'Tytuł wiadomości flash',
    'Flash Message Details'                      => 'Szczegóły wiadomości flash',
    'Which type of flash message should appear?' => 'Jaki typ wiadomości flash powinien się pojawić?',

    // Trix toolbar (rich-text editing)
    'Rich Text'     => 'Tekst sformatowany',
    'Bold'          => 'Pogrubienie',
    'Italic'        => 'Kursywa',
    'Underline'     => 'Podkreślenie',
    'Strikethrough' => 'Przekreślenie',
    'Bullets'       => 'Wypunktowanie',
    'Numbers'       => 'Numerowanie',
    'Heading'       => 'Nagłówek',
    'Code'          => 'Kod',
    'Undo'          => 'Cofnij',
    'Redo'          => 'Ponów',

    // Email body instructions (HTML)
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => 'Treść wychodzącej wiadomości e-mail. Możesz użyć <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">specjalnych zmiennych</a> lub nawet <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">pominąć odbiorców</a>.',

    // Recipients tab
    'Recipients Type'                             => 'Typ odbiorców',
    'Who will receive this message?'              => 'Kto otrzyma tę wiadomość?',
    'Add a message recipient'                     => 'Dodaj odbiorcę',
    'Select User(s)'                              => 'Wybierz użytkownika lub użytkowników',
    'Which users will receive the message?'       => 'Którzy użytkownicy otrzymają wiadomość?',
    'Which user groups will receive the message?' => 'Które grupy użytkowników otrzymają wiadomość?',
    'Ungrouped Users'                             => 'Użytkownicy bez grupy',
    'Twig Snippet to Determine Recipients'        => 'Fragment Twig do określenia odbiorców',

    // Settings: Twilio
    'Twilio Account SID'                             => 'Twilio Account SID',
    'Twilio Auth Token'                              => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)'   => 'Numer telefonu Twilio (wysyła każdą wiadomość SMS)',
    'This is being set in the config file. [{file}]' => 'Ustawiane w pliku konfiguracyjnym. [{file}]',

    // Settings: Logging
    'Logging'                                                                                                                                         => 'Rejestrowanie',
    'Enable Logging'                                                                                                                                  => 'Włącz rejestrowanie',
    'When disabled, Notifier will not write anything to the notification log.'                                                                        => 'Gdy wyłączone, Notifier nie zapisze niczego w dzienniku powiadomień.',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier prowadzi bieżący dziennik wysłanych wiadomości. Zazwyczaj nie jest to konieczne, ale możesz ograniczyć liczbę zdarzeń zapisywanych w bazie danych.',
    'Number of log events to retain'                                                                                                                  => 'Liczba zdarzeń dziennika do zachowania',
    'At most, keep this many log events. Leave blank for no limit.'                                                                                   => 'Zachowaj co najwyżej tę liczbę zdarzeń dziennika. Pozostaw puste, aby nie ustawiać limitu.',
    'Number of days to retain log events'                                                                                                             => 'Liczba dni przechowywania zdarzeń dziennika',
    'At most, keep log events for this many days. Leave blank for no limit.'                                                                          => 'Przechowuj zdarzenia dziennika przez co najwyżej tyle dni. Pozostaw puste, aby nie ustawiać limitu.',

    // Test notification
    'Send a test message'                                                                                                          => 'Wyślij wiadomość testową',
    'Are you certain you want to send a test notification?\n\nThe configured message will be sent to the configured recipient(s).' => 'Czy na pewno chcesz wysłać powiadomienie testowe?\n\nSkonfigurowana wiadomość zostanie wysłana do skonfigurowanych odbiorców.',
    'Test'                                                                                                                         => 'Test',
    'Test notification dispatched.'                                                                                                => 'Powiadomienie testowe wysłane.',
    'No messages were dispatched. Check the recipient configuration.'                                                              => 'Nie wysłano żadnych wiadomości. Sprawdź konfigurację odbiorców.',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.' => 'Wysyłanie {messageType} do {recipient}.',
    'Log events deleted.'                   => 'Zdarzenia dziennika usunięte.',
    'notification'                          => 'powiadomienie',

    // Errors
    'Invalid email message mode.'                                    => 'Nieprawidłowy tryb wiadomości e-mail.',
    'Dynamic recipients snippet did not call setRecipients.'         => 'Fragment dynamicznych odbiorców nie wywołał funkcji setRecipients.',
    'setRecipients was called with an empty value.'                  => 'setRecipients zostało wywołane z pustą wartością.',
    'Unrecognized recipient "{value}".'                              => 'Nierozpoznany odbiorca "{value}".',
    'Unrecognized recipient of type "{type}".'                       => 'Nierozpoznany odbiorca typu "{type}".',
    'Recipient "{name}" has no email address.'                       => 'Odbiorca "{name}" nie ma adresu e-mail.',
    'Recipient "{name}" has no phone number.'                        => 'Odbiorca "{name}" nie ma numeru telefonu.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => 'Odbiorca "{name}" nie ma powiązanego użytkownika; nie można wysłać ogłoszenia.',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => 'Odbiorca "{name}" nie ma dostępu do panelu sterowania; nie można wysłać ogłoszenia.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Nie masz uprawnień do używania typu Dynamiczni odbiorcy.',

];
