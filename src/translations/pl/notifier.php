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
    'Use the Dynamic Recipients type' => 'Użyj typu Dynamiczni odbiorcy',
    'Test notifications'              => 'Testowanie powiadomień',
    'Delete notifications'            => 'Usuwanie powiadomień',
    'View notification log'           => 'Wyświetlanie dziennika powiadomień',
    'Delete notification log'         => 'Usuwanie dziennika powiadomień',

    // Notification editor: tabs
    'Meta'       => 'Meta',
    'Event'      => 'Zdarzenie',
    'Message'    => 'Wiadomość',
    'Recipients' => 'Odbiorcy',

    // Event tab: type selector
    'Event Type'                                           => 'Typ zdarzenia',
    'What type of event will activate the notification?'   => 'Jaki typ zdarzenia uruchomi powiadomienie?',
    'Which specific event will activate the notification?' => 'Które konkretne zdarzenie uruchomi powiadomienie?',

    // Event tab: event types
    'Assets Event'                   => 'Zdarzenie zasobów',
    'Commerce Orders Event'          => 'Zdarzenie zamówień Commerce',
    'Commerce Products Event'        => 'Zdarzenie produktów Commerce',
    'Digital Products Event'         => 'Zdarzenie Digital Products',
    'Digital Product Licenses Event' => 'Zdarzenie licencji Digital Products',
    'Solspace Calendar Event'        => 'Zdarzenie Solspace Calendar',
    'Entries Event'                  => 'Zdarzenie wpisów',
    'Users Event'                    => 'Zdarzenie użytkowników',
    'Ungrouped Users'                => 'Użytkownicy bez grupy',

    // Field and element conditions
    'Field Conditions'             => 'Warunki pola',
    'Send the message only when the saved element matches the following conditions.' => 'Wyślij wiadomość tylko wtedy, gdy zapisany element spełnia następujące warunki.',
    'has changed'                  => 'uległo zmianie',
    '#{elementType} Event Filters' => 'Filtry zdarzeń dla #{elementType}',
    'No filters match this event.' => 'Żaden filtr nie pasuje do tego zdarzenia.',
    'Determine whether each message should be sent based on specified conditions.' => 'Ustal w oparciu o określone warunki, czy każda wiadomość powinna zostać wysłana.',

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
    'Can be a provisional draft or non-provisional' => 'Może być tymczasową wersją roboczą lub nie',

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
    'Element is being bulk-resaved'         => 'Element jest zapisywany ponownie zbiorczo',
    'Must be bulk-resaving the element'     => 'Musi zapisywać element ponownie zbiorczo',
    'Must not be bulk-resaving the element' => 'Nie może zapisywać elementu ponownie zbiorczo',

    // Filters: common output
    'Unnamed filter'                => 'Filtr bez nazwy',
    'Must be TRUE to send message'  => 'Musi być TRUE, aby wysłać wiadomość',
    'Must be FALSE to send message' => 'Musi być FALSE, aby wysłać wiadomość',
    'No effect'                     => 'Brak efektu',

    // Message tab: type selector and queue
    'Message Type'                       => 'Typ wiadomości',
    'What type of message will be sent?' => 'Jaki typ wiadomości zostanie wysłany?',
    'Send Message via Queue'             => 'Wyślij wiadomość przez kolejkę',
    'Should the message be sent via the [jobs queue]({queueUrl})?' => 'Czy wiadomość powinna zostać wysłana przez [kolejkę zadań]({queueUrl})?',
    'Send immediately' => 'Wyślij natychmiast',
    'Add to queue' => 'Dodaj do kolejki',

    // Message tab: Email fields
    "User's Email Address Field" => 'Pole adresu e-mail użytkownika',
    'Email Subject'              => 'Temat e-maila',
    'Email Body'                 => 'Treść e-maila',

    // Message tab: SMS fields
    "User's Phone Number Field" => 'Pole numeru telefonu użytkownika',
    'SMS Message Body'          => 'Treść wiadomości SMS',

    // Message tab: Announcement fields
    'Announcement Title'   => 'Tytuł ogłoszenia',
    'Announcement Message' => 'Treść ogłoszenia',

    // Message tab: Flash fields
    'Flash Message Type'                         => 'Typ wiadomości flash',
    'Flash Message Title'                        => 'Tytuł wiadomości flash',
    'Flash Message Details'                      => 'Szczegóły wiadomości flash',
    'Which type of flash message should appear?' => 'Jaki typ wiadomości flash powinien się pojawić?',

    // Message tab: Pushover fields
    "Field containing each user's Pushover key" => 'Pole klucza Pushover użytkownika',
    'The Pushover application token is configured in [Settings → Pushover](url).' => 'Token aplikacji Pushover konfiguruje się w [Ustawienia → Pushover](url).',

    // Message tab: ntfy fields
    'Priority'           => 'Priorytet',
    'Tags'               => 'Tagi',
    'Click URL'          => 'URL kliknięcia',
    'Render as Markdown' => 'Renderuj jako Markdown',

    // Message tab: Slack fields
    'Slack Message Body' => 'Treść wiadomości Slack',

    // Message tab: Bluesky fields
    'Post Body' => 'Treść posta',
    'Generate Link Preview' => 'Generuj podgląd linku',
    "When the post body contains a URL, automatically generate a preview card with the linked page's image, title, and description." => 'Gdy treść posta zawiera adres URL, dołączana jest karta podglądu z tytułem, opisem i obrazem połączonej strony.',
    'No card' => 'Bez karty',
    'Generate preview card' => 'Generuj kartę podglądu',

    // Message tab: Title / Body / Trix toolbar
    'Title'         => 'Tytuł',
    'Body'          => 'Treść',
    'Rich Text'     => 'Tekst sformatowany',
    'Bold'          => 'Pogrubienie',
    'Italic'        => 'Kursywa',
    'Underline'     => 'Podkreślenie',
    'Strikethrough' => 'Przekreślenie',
    'Bullets'       => 'Wypunktowanie',
    'Numbers'       => 'Numeracja',
    'Heading'       => 'Nagłówek',
    'Code'          => 'Kod',
    'Undo'          => 'Cofnij',
    'Redo'          => 'Ponów',
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => 'Treść wychodzącego e-maila. Możesz użyć <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">zmiennych specjalnych</a>, a nawet <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">pominąć odbiorców</a>.',

    // Recipients tab: common
    'Recipients Type'                             => 'Typ odbiorców',
    'Who will receive this message?'              => 'Kto otrzyma tę wiadomość?',
    'Add a message recipient'                     => 'Dodaj odbiorcę',
    'Select User(s)'                              => 'Wybierz użytkownika(-ów)',
    'Which users will receive the message?'       => 'Którzy użytkownicy otrzymają wiadomość?',
    'Which user groups will receive the message?' => 'Które grupy użytkowników otrzymają wiadomość?',
    'Twig Snippet to Determine Recipients'        => 'Fragment Twig do określenia odbiorców',

    // Recipients tab: per-provider pickers
    'Select Slack channel(s)'                           => 'Wybierz kanał(y) Slack',
    'Which Slack channels should receive this message?' => 'Które kanały Slack otrzymają tę wiadomość?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Brak skonfigurowanych kanałów Slack. Dodaj jeden w [Ustawienia → Slack]({url}).',
    'Select ntfy topic(s)'                              => 'Wybierz temat(y) ntfy',
    'Which ntfy topics should receive this message?'    => 'Które tematy ntfy otrzymają tę wiadomość?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'Brak skonfigurowanych tematów ntfy. Dodaj jeden w [Ustawienia → ntfy]({url}).',
    'Select Bluesky account(s)'                         => 'Wybierz konto(a) Bluesky',
    'Which Bluesky accounts should post this message?'  => 'Które konta Bluesky powinny opublikować tę wiadomość?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Brak skonfigurowanych kont Bluesky. Dodaj jedno w [Ustawienia → Bluesky]({url}).',

    // Settings: page chrome
    'Notifier Settings' => 'Ustawienia Notifier',
    'General'           => 'Ogólne',
    'Twilio'            => 'Twilio',
    'Pushover'          => 'Pushover',
    'Slack'             => 'Slack',
    'Bluesky'           => 'Bluesky',
    'ntfy'              => 'ntfy',

    // Settings: Logging
    'Logging'                             => 'Rejestrowanie',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier prowadzi bieżący dziennik wysłanych wiadomości. Zwykle nie jest to konieczne, ale możesz ograniczyć liczbę zdarzeń zapisanych w bazie danych.',
    'Enable Logging'                      => 'Włącz rejestrowanie',
    'When disabled, Notifier will not write anything to the notification log.' => 'Gdy wyłączone, Notifier nie zapisuje nic w dzienniku powiadomień.',
    'Number of days to retain log events' => 'Liczba dni przechowywania zdarzeń dziennika',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Przechowuj zdarzenia dziennika maksymalnie tyle dni. Pozostaw puste, aby nie ustawiać limitu.',
    'Number of log events to retain'      => 'Liczba zdarzeń dziennika do przechowywania',
    'At most, keep this many log events. Leave blank for no limit.' => 'Przechowuj maksymalnie tyle zdarzeń dziennika. Pozostaw puste, aby nie ustawiać limitu.',

    // Settings: Twilio
    'Twilio API Credentials'                       => 'Dane uwierzytelniające API Twilio',
    'If using the Twilio API to send SMS messages, the following credentials are required.' => 'Jeśli używasz API Twilio do wysyłania wiadomości SMS, wymagane są poniższe dane.',
    'Twilio Account SID'                           => 'Twilio Account SID',
    'Twilio Auth Token'                            => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)' => 'Numer telefonu Twilio (wysyła każdą wiadomość SMS)',
    'SMS Testing'                                  => 'Testowanie SMS',
    'Optional. When set, every SMS dispatched will be sent to this number instead of the resolved recipient.' => 'Opcjonalne. Po ustawieniu każda wysłana wiadomość SMS trafi pod ten numer zamiast do faktycznego odbiorcy.',
    'Test phone number'                            => 'Testowy numer telefonu',

    // Settings: Pushover
    "[Pushover](https://pushover.net) sends push notifications to a registered user's devices. Each Craft user needs a custom field on their profile storing their Pushover user key; you select which field on each Notification's Message tab. For full setup instructions, see the [Pushover getting-started docs](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover)." => '[Pushover](https://pushover.net) wysyła powiadomienia push na urządzenia zarejestrowanego użytkownika. Każdy użytkownik Craft potrzebuje niestandardowego pola w swoim profilu przechowującego klucz Pushover; wybierasz, które pole w zakładce Wiadomość każdego powiadomienia. Pełną instrukcję konfiguracji znajdziesz w [dokumentacji Pushover na początek](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover).',
    'Application API Token'                                      => 'Token API aplikacji',
    'The 30-character app token from your Pushover application.' => '30-znakowy token aplikacji z aplikacji Pushover.',

    // Settings: ntfy
    'ntfy.sh is a free HTTP-based push notification service. Subscribers receive messages on the ntfy app, web, or any compatible client by joining a topic.' => 'ntfy.sh to bezpłatna usługa powiadomień push oparta na HTTP. Subskrybenci otrzymują wiadomości w aplikacji ntfy, w sieci lub w dowolnym kompatybilnym kliencie po dołączeniu do tematu.',
    'Server URL'   => 'Adres URL serwera',
    'Defaults to https://ntfy.sh. Point at a self-hosted ntfy instance if applicable.' => 'Domyślnie https://ntfy.sh. W razie potrzeby wskaż samodzielnie hostowaną instancję ntfy.',
    'Access token' => 'Token dostępu',
    'Optional. Required for protected topics or self-hosted instances with auth.' => 'Opcjonalne. Wymagane dla zabezpieczonych tematów lub samodzielnie hostowanych instancji z uwierzytelnianiem.',
    'ntfy Topics'  => 'Tematy ntfy',
    'Named list of ntfy topics. Each topic becomes selectable on the notification edit screen.' => 'Nazwana lista tematów ntfy. Każdy temat staje się dostępny do wyboru w ekranie edycji powiadomienia.',
    'Topics'       => 'Tematy',
    'Add one row per topic name. Use the **Test** button to send a quick test message to the topic.' => 'Dodaj jeden wiersz na nazwę tematu. Użyj przycisku **Test**, aby wysłać szybką wiadomość testową do tematu.',
    'Topic'        => 'Temat',
    'Add a topic'  => 'Dodaj temat',
    'Save first to persist a row, then click its **Test** button to fire a sanity check against ntfy.' => 'Najpierw zapisz, aby zachować wiersz, a następnie kliknij jego przycisk **Test**, aby przeprowadzić szybką weryfikację względem ntfy.',

    // Settings: Slack
    'Slack Channels' => 'Kanały Slack',
    'Channels'       => 'Kanały',
    'Each Slack channel needs its own Incoming Webhook URL. Use the **Test** button to fire a quick sanity check after saving.' => 'Każdy kanał Slack potrzebuje własnego adresu URL Incoming Webhook. Po zapisaniu użyj przycisku **Test**, aby przeprowadzić szybką weryfikację.',
    'Webhook URL'    => 'URL webhooka',
    'Add a channel'  => 'Dodaj kanał',
    'Save first to persist a row, then click its **Test** button to fire a sanity check against Slack.' => 'Najpierw zapisz, aby zachować wiersz, a następnie kliknij jego przycisk **Test**, aby przeprowadzić szybką weryfikację względem Slack.',

    // Settings: Bluesky
    "[Bluesky](https://bsky.app) posts publish to the configured account's feed via the ATProto API. App passwords are generated at [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). An app password is a secret, so store it in a `.env` variable and reference that variable (e.g. `\$BLUESKY_APP_PASSWORD`) rather than pasting the password directly." => 'Posty [Bluesky](https://bsky.app) są publikowane w kanale skonfigurowanego konta za pośrednictwem API ATProto. Hasła aplikacji generuje się na [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). Hasło aplikacji jest sekretem, dlatego zapisz je w zmiennej `.env` i odwołuj się do tej zmiennej (np. `$BLUESKY_APP_PASSWORD`) zamiast wklejać hasło bezpośrednio.',
    'PDS URL'          => 'URL PDS',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'Domyślnie https://bsky.social. Wskaż własny PDS, jeśli Twoja instalacja federuje.',
    'Bluesky Accounts' => 'Konta Bluesky',
    'Named list of Bluesky accounts. Each account becomes selectable on the notification edit screen.' => 'Nazwana lista kont Bluesky. Każde konto staje się dostępne do wyboru w ekranie edycji powiadomienia.',
    'Accounts'         => 'Konta',
    'Add one row per Bluesky account. Use **Test** to verify the credentials authenticate.' => 'Dodaj jeden wiersz na konto Bluesky. Użyj **Test**, aby zweryfikować, że dane logowania uwierzytelniają się.',
    'Label'            => 'Etykieta',
    'Handle'           => 'Identyfikator',
    'App password'     => 'Hasło aplikacji',
    'Add an account'   => 'Dodaj konto',
    'Save first to persist a row, then click its **Test** button to verify the credentials authenticate.' => 'Najpierw zapisz, aby zachować wiersz, a następnie kliknij jego przycisk **Test**, aby zweryfikować, że dane logowania uwierzytelniają się.',

    // Test notification (UI)
    'Send a test message'           => 'Wyślij wiadomość testową',
    'Are you certain you want to send a test notification?\\n\\nThe configured message will be sent to the configured recipient(s).' => 'Czy na pewno chcesz wysłać powiadomienie testowe?\\n\\nSkonfigurowana wiadomość zostanie wysłana do skonfigurowanych odbiorców.',
    'Test'                          => 'Testuj',
    'Test notification dispatched.' => 'Wysłano powiadomienie testowe.',
    'No messages were dispatched. Check the recipient configuration.' => 'Nie wysłano żadnych wiadomości. Sprawdź konfigurację odbiorców.',

    // Settings: save / test action responses
    "Couldn't save settings."                 => 'Nie udało się zapisać ustawień.',
    'Settings saved.'                         => 'Ustawienia zapisane.',
    'Topic is empty.'                         => 'Temat jest pusty.',
    'Server URL is not configured.'           => 'URL serwera nie został skonfigurowany.',
    'Test message from Notifier.'             => 'Wiadomość testowa z Notifier.',
    'HTTP {status}'                           => 'HTTP {status}',
    'Test message sent successfully.'         => 'Pomyślnie wysłano wiadomość testową.',
    'HTTP {status}: {body}'                   => 'HTTP {status}: {body}',
    'Handle and app password are required.'   => 'Identyfikator i hasło aplikacji są wymagane.',
    'Authentication failed.'                  => 'Uwierzytelnianie nie powiodło się.',
    'Successfully authenticated. No messages were posted.' => 'Uwierzytelnianie powiodło się. Nie opublikowano żadnych wiadomości.',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.'          => 'Wysyłanie {messageType} do {recipient}.',
    'Adding message to queue.'                       => 'Dodawanie wiadomości do kolejki.',
    'Sending message immediately (bypassing queue).' => 'Wysyłanie wiadomości natychmiast (z pominięciem kolejki).',
    'Log events deleted.'                            => 'Usunięto zdarzenia dziennika.',
    'notification'                                   => 'powiadomienie',

    // Outbound: Email log messages
    'Unable to send email, no recipient specified.'     => 'Nie można wysłać e-maila: nie podano odbiorcy.',
    'Unable to send email, the message body was empty.' => 'Nie można wysłać e-maila: treść wiadomości była pusta.',
    "Unable to send the email using Craft's native email handling." => 'Nie można wysłać e-maila przy użyciu natywnej obsługi e-maili Craft.',
    'Check your general email settings within Craft.'   => 'Sprawdź ogólne ustawienia e-maila w Craft.',
    'Successfully sent email message!'                  => 'Pomyślnie wysłano wiadomość e-mail!',

    // Outbound: SMS log messages
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[Nieprawidłowe dane Twilio.]({url}) Brak {missing}.',
    'Unable to send SMS, no Twilio phone number exists.'      => "Nie można wysłać SMS'a: brak numeru telefonu Twilio.",
    'Unable to send SMS, no recipient phone number exists.'   => "Nie można wysłać SMS'a: brak numeru telefonu odbiorcy.",
    'Unable to send SMS, recipient phone number is invalid.'  => "Nie można wysłać SMS'a: numer telefonu odbiorcy jest nieprawidłowy.",
    'Successfully sent SMS message!'                          => 'Pomyślnie wysłano wiadomość SMS!',

    // Outbound: Announcement log messages
    'Unable to post announcement, no recipient userId specified.' => 'Nie można opublikować ogłoszenia: nie podano userId odbiorcy.',
    'Successfully posted announcement!' => 'Pomyślnie opublikowano ogłoszenie!',

    // Outbound: Flash log messages
    'Unable to send the flash message, invalid flash type.' => 'Nie można wysłać wiadomości flash: nieprawidłowy typ flash.',
    'Successfully sent flash message!'                      => 'Pomyślnie wysłano wiadomość flash!',

    // Outbound: Pushover log messages
    '[Invalid Pushover credentials.]({url}) Missing app token.'  => '[Nieprawidłowe dane Pushover.]({url}) Brak tokena aplikacji.',
    'Unable to send Pushover message, no user key on recipient.' => 'Nie można wysłać wiadomości Pushover: brak klucza użytkownika u odbiorcy.',
    'Pushover POST failed: {reason}'                             => 'POST Pushover nie powiódł się: {reason}',
    'Successfully sent Pushover message!'                        => 'Pomyślnie wysłano wiadomość Pushover!',

    // Outbound: ntfy log messages
    'Unable to send ntfy message, no server URL configured.' => 'Nie można wysłać wiadomości ntfy: brak skonfigurowanego URL serwera.',
    'Unable to send ntfy message, no topic specified.'       => 'Nie można wysłać wiadomości ntfy: nie podano tematu.',
    'ntfy POST failed with HTTP {status}: {reason}'          => 'POST ntfy nie powiódł się z HTTP {status}: {reason}',
    'ntfy POST failed: {reason}'                             => 'POST ntfy nie powiódł się: {reason}',
    'Successfully sent ntfy message to topic "{topic}".'     => 'Pomyślnie wysłano wiadomość ntfy do tematu "{topic}".',

    // Outbound: Slack log messages
    'Unable to send Slack message, no webhook URL.' => 'Nie można wysłać wiadomości Slack: brak URL webhooka.',
    'Unable to send Slack message, webhook URL is not valid.' => 'Nie można wysłać wiadomości Slack: URL webhooka jest nieprawidłowy.',
    'Unable to send Slack message, body is empty.'  => 'Nie można wysłać wiadomości Slack: treść jest pusta.',
    'Slack POST failed (HTTP {status}): {reason}'   => 'POST Slack nie powiódł się (HTTP {status}): {reason}',
    'Slack POST failed: {reason}'                   => 'POST Slack nie powiódł się: {reason}',
    'Successfully sent Slack message to "{label}".' => 'Pomyślnie wysłano wiadomość Slack do "{label}".',

    // Outbound: Bluesky log messages
    'Unable to send Bluesky post, recipient is missing credentials.' => 'Nie można wysłać posta Bluesky: u odbiorcy brak danych logowania.',
    'Body exceeded {max} characters, truncated.'          => 'Treść przekroczyła {max} znaków i została skrócona.',
    'Successfully posted to Bluesky as "{label}".'        => 'Pomyślnie opublikowano w Bluesky jako "{label}".',
    'Bluesky auth failed for {handle}: {reason}'          => 'Uwierzytelnianie Bluesky nie powiodło się dla {handle}: {reason}',
    'Bluesky auth failed: {reason}'                       => 'Uwierzytelnianie Bluesky nie powiodło się: {reason}',
    'Bluesky post failed: {reason}'                       => 'Publikacja w Bluesky nie powiodła się: {reason}',
    'Bluesky link preview skipped: {reason}'              => 'Pominięto podgląd linku Bluesky: {reason}',

    // Recipient-strategy warnings
    'Recipient "{name}" has no email address.'       => 'Odbiorca "{name}" nie ma adresu e-mail.',
    'Recipient "{name}" has no phone number.'        => 'Odbiorca "{name}" nie ma numeru telefonu.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => 'Odbiorca "{name}" nie ma powiązanego użytkownika; nie można wysłać ogłoszenia.',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => 'Odbiorca "{name}" nie ma dostępu do panelu sterowania; nie można wysłać ogłoszenia.',
    'Pushover user-key field is not configured on this notification.' => 'Pole klucza użytkownika Pushover nie jest skonfigurowane w tym powiadomieniu.',
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => 'Odbiorca "{name}" nie ma powiązanego użytkownika; nie można wysłać wiadomości Pushover.',
    '[SKIPPED] User "{name}" has no Pushover key.'   => '[POMINIĘTO] Użytkownik "{name}" nie ma klucza Pushover.',
    'Recipient "{name}" has no ntfy topic.'          => 'Odbiorca "{name}" nie ma tematu ntfy.',
    'Recipient "{name}" has no Slack webhook URL.'   => 'Odbiorca "{name}" nie ma URL webhooka Slack.',
    'Recipient "{name}" has no Bluesky credentials.' => 'Odbiorca "{name}" nie ma danych logowania Bluesky.',

    // Errors / exceptions
    'Invalid element event: {class}'                         => 'Nieprawidłowe zdarzenie elementu: {class}',
    'Invalid notification ID: {id}'                          => 'Nieprawidłowy identyfikator powiadomienia: {id}',
    'Invalid email message mode.'                            => 'Nieprawidłowy tryb wiadomości e-mail.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Nie masz uprawnień do używania typu Dynamiczni odbiorcy.',
    'Dynamic recipients snippet did not call setRecipients.' => 'Fragment dynamicznych odbiorców nie wywołał setRecipients.',
    'setRecipients was called with an empty value.'          => 'setRecipients zostało wywołane z pustą wartością.',
    'Unrecognized recipient of type "{type}".'               => 'Nierozpoznany odbiorca typu "{type}".',
    'Unrecognized recipient "{value}".'                      => 'Nierozpoznany odbiorca "{value}".',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => 'Skonfigurowany element {kind} nie istnieje już w ustawieniach wtyczki (uid: {uid}).',
    'Invalid settings section: {section}'                    => 'Nieprawidłowa sekcja ustawień: {section}',
    'User not authorized to save this notification.'         => 'Użytkownik nie ma uprawnień do zapisania tego powiadomienia.',
    'User not authorized to view this notification.'         => 'Użytkownik nie ma uprawnień do wyświetlania tego powiadomienia.',
    'User not authorized to delete this notification.'       => 'Użytkownik nie ma uprawnień do usunięcia tego powiadomienia.',
    'Notification not found'                                 => 'Powiadomienie nie znalezione',

    // Misc config-file note
    'This is being set in the config file. [{file}]' => 'To jest ustawiane w pliku konfiguracyjnym. [{file}]',

    // Slack, ntfy, and Bluesky message types
    "Add the Bluesky accounts you'd like to post from. Each account becomes available as a recipient on the **Recipients** tab when configuring a notification." => 'Dodaj konta Bluesky, z których chcesz publikować. Każde konto staje się dostępne jako odbiorca w zakładce **Odbiorcy** podczas konfigurowania powiadomienia.',
    "Click any row's **Test** button to confirm the account authenticates." => 'Kliknij przycisk **Test** w dowolnym wierszu, aby potwierdzić, że konto się uwierzytelnia.',
    "Add an [Incoming Webhook](https://api.slack.com/messaging/webhooks) for each Slack channel you'd like to post into. Each webhook becomes available as a recipient on the **Recipients** tab when configuring a notification. A webhook URL is a secret, so store it in a `.env` variable and reference that variable (e.g. `\$SLACK_WEBHOOK_URL`) rather than pasting the URL directly." => 'Dodaj [Incoming Webhook](https://api.slack.com/messaging/webhooks) dla każdego kanału Slack, na który chcesz publikować. Każdy webhook staje się dostępny jako odbiorca w zakładce **Odbiorcy** podczas konfigurowania powiadomienia. URL webhooka jest sekretem, dlatego zapisz go w zmiennej `.env` i odwołuj się do tej zmiennej (np. `$SLACK_WEBHOOK_URL`) zamiast wklejać URL bezpośrednio.',
    "Click any row's **Test** button to send a quick test message to that channel." => 'Kliknij przycisk **Test** w dowolnym wierszu, aby wysłać szybką wiadomość testową na ten kanał.',
    "Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`." => 'Opcjonalne. W razie potrzeby wskaż samodzielnie hostowaną instancję ntfy. Domyślnie `https://ntfy.sh`.',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Opcjonalne. Wymagane dla zabezpieczonych tematów lub samodzielnie hostowanych instancji z uwierzytelnianiem.',
    "Add the ntfy topics you'd like to send messages to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification." => 'Dodaj tematy ntfy, do których chcesz wysyłać wiadomości. Każdy temat staje się dostępny jako odbiorca w zakładce **Odbiorcy** podczas konfigurowania powiadomienia.',
    "Click any row's **Test** button to send a quick test message to that topic." => 'Kliknij przycisk **Test** w dowolnym wierszu, aby wysłać szybką wiadomość testową do tego tematu.',
    'Enable Markdown' => 'Włącz Markdown',
    'Link URL' => 'URL odnośnika',
    'Not a valid Webhook URL. Must start with https://hooks.slack.com/services/' => 'Nieprawidłowy URL webhooka. Musi zaczynać się od https://hooks.slack.com/services/',

    // Manual triggers
    'Send Notification'                                            => 'Wyślij powiadomienie',
    'Send manual notifications'                                    => 'Wysyłaj powiadomienia ręczne',
    'Are you sure you want to send this notification?'             => 'Czy na pewno chcesz wysłać to powiadomienie?',
    'This notification cannot be triggered manually.'              => 'Tego powiadomienia nie można wyzwolić ręcznie.',
    'This notification no longer applies to the selected element.' => 'To powiadomienie nie dotyczy już wybranego elementu.',
    'Notification sent.'                                           => 'Powiadomienie wysłane.',
    'Element not found'                                            => 'Nie znaleziono elementu',
    'Manual Trigger Label'                                         => 'Etykieta wyzwalacza ręcznego',
    'An element action label (helps to differentiate multiple manual triggers).' => 'Etykieta akcji elementu (pomaga rozróżnić wiele wyzwalaczy ręcznych).',
];
