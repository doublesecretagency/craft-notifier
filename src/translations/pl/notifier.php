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
    'Notifications' => 'Powiadomienia',
    'Notification' => 'Powiadomienie',
    'All notifications' => 'Wszystkie powiadomienia',
    'Notification Log' => 'Dziennik powiadomień',
    'Logs' => 'Dzienniki',
    'View Notifications' => 'Wyświetl powiadomienia',
    'Add a New Notification' => 'Dodaj nowe powiadomienie',
    'notification' => 'powiadomienie',

    // Permissions
    'View notifications' => 'Wyświetlanie powiadomień',
    'Save notifications' => 'Zapisywanie powiadomień',
    'Use the Dynamic Recipients type' => 'Użyj typu Dynamiczni odbiorcy',
    'Use the Dynamic Data type' => 'Użyj typu Dane dynamiczne',
    'Test notifications' => 'Testowanie powiadomień',
    'Send manual notifications' => 'Wysyłaj powiadomienia ręczne',
    'Delete notifications' => 'Usuwanie powiadomień',
    'View notification log' => 'Wyświetlanie dziennika powiadomień',
    'Delete notification log' => 'Usuwanie dziennika powiadomień',

    // ========================================================
    // NOTIFICATION EDITOR
    // ========================================================

    // Editor: tabs
    'Meta' => 'Meta',
    'Event' => 'Zdarzenie',
    'Message' => 'Wiadomość',
    'Recipients' => 'Odbiorcy',

    // Event tab: type selector
    'Event Type' => 'Typ zdarzenia',
    'What type of event will activate the notification?' => 'Jaki typ zdarzenia uruchomi powiadomienie?',
    'Which specific event will activate the notification?' => 'Które konkretne zdarzenie uruchomi powiadomienie?',

    // Event tab: event types
    'Assets Event' => 'Zdarzenie zasobów',
    'Commerce Orders Event' => 'Zdarzenie zamówień Commerce',
    'Commerce Products Event' => 'Zdarzenie produktów Commerce',
    'Digital Products Event' => 'Zdarzenie Digital Products',
    'Digital Product Licenses Event' => 'Zdarzenie licencji Digital Products',
    'Solspace Calendar Event' => 'Zdarzenie Solspace Calendar',
    'Entries Event' => 'Zdarzenie wpisów',
    'Users Event' => 'Zdarzenie użytkowników',
    'Ungrouped Users' => 'Użytkownicy bez grupy',

    // Event tab: Feed
    'Feed URL' => 'URL kanału',
    'The URL of the RSS, Atom, or JSON feed to watch.' => 'URL kanału RSS, Atom lub JSON do monitorowania.',

    // Event tab: field conditions
    'Field Conditions' => 'Warunki pola',
    'Send the message only when the saved element matches the following conditions.' => 'Wyślij wiadomość tylko wtedy, gdy zapisany element spełnia następujące warunki.',
    'has changed' => 'uległo zmianie',

    // Event tab: element filters (panel chrome + common output)
    '#{elementType} Event Filters' => 'Filtry zdarzeń dla #{elementType}',
    'No filters match this event.' => 'Żaden filtr nie pasuje do tego zdarzenia.',
    'Determine whether each message should be sent based on specified conditions.' => 'Ustal w oparciu o określone warunki, czy każda wiadomość powinna zostać wysłana.',
    'Unnamed filter' => 'Filtr bez nazwy',
    'Must be TRUE to send message' => 'Musi być TRUE, aby wysłać wiadomość',
    'Must be FALSE to send message' => 'Musi być FALSE, aby wysłać wiadomość',
    'No effect' => 'Brak efektu',

    // Event tab: element filter rules
    'Element is being saved for the first time' => 'Element jest zapisywany po raz pierwszy',
    'Must be a new entry' => 'Musi być nowym wpisem',
    'Must be an existing entry' => 'Musi być istniejącym wpisem',
    'Can be existing or new' => 'Może być istniejący lub nowy',
    'Element is new' => 'Element jest nowy',
    'New elements only' => 'Tylko nowe elementy',
    'Existing elements only' => 'Tylko istniejące elementy',
    'Element is enabled' => 'Element jest włączony',
    'Must be enabled' => 'Musi być włączony',
    'Must be disabled' => 'Musi być wyłączony',
    'Can be enabled or disabled' => 'Może być włączony lub wyłączony',
    'Element is a draft' => 'Element jest wersją roboczą',
    'Must be a draft' => 'Musi być wersją roboczą',
    'Must not be a draft' => 'Nie może być wersją roboczą',
    'Can be a draft or non-draft' => 'Może być wersją roboczą lub nie',
    'Element is a provisional draft' => 'Element jest tymczasową wersją roboczą',
    'Must be a provisional draft' => 'Musi być tymczasową wersją roboczą',
    'Must not be a provisional draft' => 'Nie może być tymczasową wersją roboczą',
    'Can be a provisional draft or non-provisional' => 'Może być tymczasową wersją roboczą lub nie',
    'Element is a revision' => 'Element jest rewizją',
    'Must be a revision' => 'Musi być rewizją',
    'Must not be a revision' => 'Nie może być rewizją',
    'Can be a revision or non-revision' => 'Może być rewizją lub nie',
    'Element is being duplicated' => 'Element jest duplikowany',
    'Must be duplicating the element' => 'Musi duplikować element',
    'Must not be duplicating the element' => 'Nie może duplikować elementu',
    'Element is being propagated' => 'Element jest propagowany',
    'Element must be propagating' => 'Element musi być propagowany',
    'Element must not be propagating' => 'Element nie może być propagowany',
    'Element is being bulk-resaved' => 'Element jest zapisywany ponownie zbiorczo',
    'Must be bulk-resaving the element' => 'Musi zapisywać element ponownie zbiorczo',
    'Must not be bulk-resaving the element' => 'Nie może zapisywać elementu ponownie zbiorczo',

    // Event tab: date trigger
    'On' => 'W dniu',
    'days before' => 'dni przed',
    'days after' => 'dni po',
    'Relevant Date' => 'Istotna data',
    'Send the notification relative to a chosen date.' => 'Wyślij powiadomienie względem wybranej daty.',

    // Event tab: recurring schedule
    'Every' => 'Co',
    'on' => 'w',
    'on day' => 'w dniu',
    'at' => 'o',
    'Starting on' => 'Począwszy od',
    'Day' => 'Dzień',
    'Date' => 'Data',
    'Time' => 'Godzina',
    'day(s)' => 'dzień/dni',
    'week(s)' => 'tydzień/tygodnie',
    'month(s)' => 'miesiąc/miesiące',
    'year(s)' => 'rok/lata',
    'day' => 'dzień',
    'days' => 'dni',
    'week' => 'tydzień',
    'weeks' => 'tygodnie',
    'month' => 'miesiąc',
    'months' => 'miesiące',
    'year' => 'rok',
    'years' => 'lata',
    'Manual only' => 'Tylko ręcznie',
    'Scheduled sending' => 'Wysyłka zaplanowana',
    'Generate report on a recurring schedule' => 'Generuj raport według harmonogramu cyklicznego',
    'Generate report on demand' => 'Generuj raport na żądanie',
    'Send on a Recurring Schedule' => 'Wysyłaj według harmonogramu cyklicznego',
    'Configure Recurring Schedule' => 'Skonfiguruj harmonogram cykliczny',
    'System timezone set to {timezone}' => 'Strefa czasowa systemu ustawiona na {timezone}',
    'Notifications will be sent on the following schedule...' => 'Powiadomienia będą wysyłane według następującego harmonogramu...',
    '... and every {cadence} after that.' => '... a następnie co {cadence}.',
    'On what recurring schedule should the notification be sent?' => 'Według jakiego harmonogramu cyklicznego ma być wysyłane powiadomienie?',
    'Whether the message should be sent on a schedule, or only triggered manually.' => 'Czy wiadomość ma być wysyłana według harmonogramu, czy tylko uruchamiana ręcznie.',
    'The message can always be sent using the "Send system snapshot" button above.' => 'Wiadomość zawsze można wysłać przyciskiem „Wyślij migawkę systemu” powyżej.',
    'The message can always be sent using the "Send data report" button above.' => 'Wiadomość zawsze można wysłać przyciskiem „Wyślij raport danych” powyżej.',

    // Event tab: Dynamic Data snippet field
    'Twig Snippet to Determine Data' => 'Fragment Twig określający dane',
    'Enter a custom Twig snippet to [determine which data will be included]({url}).' => 'Wprowadź własny fragment Twig, aby [określić, które dane zostaną uwzględnione]({url}).',
    'The snippet **must** include a `{% setData %}` tag.' => 'Fragment **musi** zawierać tag `{% setData %}`.',
    'You do not have permission to edit dynamic data.' => 'Nie masz uprawnień do edytowania danych dynamicznych.',

    // Event tab: manual trigger
    'Trigger Label' => 'Etykieta wyzwalacza',
    'An element action label (helps to differentiate multiple triggers).' => 'Etykieta akcji elementu (pomaga rozróżnić wiele wyzwalaczy).',
    'Send Notification' => 'Wyślij powiadomienie',

    // Message tab: type selector
    'Message Type' => 'Typ wiadomości',
    'What type of message will be sent?' => 'Jaki typ wiadomości zostanie wysłany?',
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are also supported.' => 'Obsługiwane są również [szablony]({templatingUrl}) i [zmienne specjalne]({variablesUrl}).',

    // Details sidebar: queue
    'Use Queue' => 'Użyj kolejki',
    'Immediate' => 'Natychmiast',
    'Queue' => 'Kolejka',
    'jobs queue' => 'kolejki zadań',
    'Whether the message will be sent immediately, or added to the {link}.' => 'Czy wiadomość zostanie wysłana natychmiast, czy dodana do {link}.',
    'Flash messages never use the queue.' => 'Wiadomości flash nigdy nie używają kolejki.',
    'Announcements always use the queue.' => 'Ogłoszenia zawsze używają kolejki.',

    // Message tab: Email
    "User's Email Address Field" => 'Pole adresu e-mail użytkownika',
    'Select which User field contains the recipient\'s email address.' => 'Wybierz pole użytkownika zawierające adres e-mail odbiorcy.',
    'Email Subject' => 'Temat e-maila',
    'Subject line of the email.' => 'Temat wiadomości e-mail.',
    'Dynamic Subject Line' => 'Dynamiczny temat',
    'Email Body' => 'Treść e-maila',
    'Body of the email. Supports HTML.' => 'Treść wiadomości e-mail. Obsługuje HTML.',

    // Message tab: rich-text (Trix) toolbar
    'Rich Text' => 'Tekst sformatowany',
    'Bold' => 'Pogrubienie',
    'Italic' => 'Kursywa',
    'Underline' => 'Podkreślenie',
    'Strikethrough' => 'Przekreślenie',
    'Bullets' => 'Wypunktowanie',
    'Numbers' => 'Numeracja',
    'Heading' => 'Nagłówek',
    'Code' => 'Kod',
    'Undo' => 'Cofnij',
    'Redo' => 'Ponów',

    // Message tab: SMS
    "User's Phone Number Field" => 'Pole numeru telefonu użytkownika',
    'Select which User field contains the recipient\'s phone number.' => 'Wybierz pole użytkownika zawierające numer telefonu odbiorcy.',
    'SMS Message Body' => 'Treść wiadomości SMS',
    'Body of the SMS (text message). Plain text only.' => 'Treść SMS-a (wiadomości tekstowej). Tylko zwykły tekst.',

    // Message tab: Announcement
    'Announcement Title' => 'Tytuł ogłoszenia',
    'Heading of the announcement.' => 'Nagłówek ogłoszenia.',
    'Dynamic Announcement Title' => 'Dynamiczny tytuł ogłoszenia',
    'Announcement Message' => 'Treść ogłoszenia',
    'Body of the announcement. Supports Markdown.' => 'Treść ogłoszenia. Obsługuje Markdown.',

    // Message tab: Flash
    'Flash Message Type' => 'Typ wiadomości flash',
    'Which type of flash message should appear?' => 'Jaki typ wiadomości flash powinien się pojawić?',
    'Flash Message Title' => 'Tytuł wiadomości flash',
    'Heading of the flash message.' => 'Nagłówek komunikatu Flash.',
    'Dynamic Flash Message Title' => 'Dynamiczny tytuł komunikatu Flash',
    'Flash Message Details' => 'Szczegóły wiadomości flash',
    'Optionally include details below the heading. Supports Markdown and HTML.' => 'Opcjonalnie dołącz szczegóły pod nagłówkiem. Obsługuje Markdown i HTML.',

    // Message tab: Pushover
    "Field containing each user's Pushover key" => 'Pole klucza Pushover użytkownika',
    'Select which User field contains the recipient\'s Pushover user key.' => 'Wybierz pole użytkownika zawierające klucz Pushover odbiorcy.',
    'Pushover Title' => 'Tytuł Pushover',
    'Optionally include a heading above the body.' => 'Opcjonalnie dołącz nagłówek nad treścią.',
    'Dynamic Pushover Title' => 'Dynamiczny tytuł Pushover',
    'Pushover Body' => 'Treść Pushover',
    'Body of the Pushover notification. Plain text only.' => 'Treść powiadomienia Pushover. Tylko zwykły tekst.',

    // Message tab: ntfy
    'Priority' => 'Priorytet',
    'Priority level of the ntfy message.' => 'Poziom priorytetu wiadomości ntfy.',
    'Tags' => 'Tagi',
    'Optionally include comma-separated [emoji shortcodes](https://docs.ntfy.sh/emojis/).' => 'Opcjonalnie dołącz oddzielone przecinkami [kody emoji](https://docs.ntfy.sh/emojis/).',
    'ntfy Title' => 'Tytuł ntfy',
    'Dynamic ntfy Title' => 'Dynamiczny tytuł ntfy',
    'ntfy Body' => 'Treść ntfy',
    'Body of the ntfy notification.' => 'Treść powiadomienia ntfy.',
    'ntfy Link URL' => 'URL odnośnika ntfy',
    'Optionally open a URL when the notification is clicked.' => 'Opcjonalnie otwórz URL po kliknięciu powiadomienia.',
    'Enable Markdown' => 'Włącz Markdown',
    'Whether to parse the body as Markdown in supported clients.' => 'Czy treść ma być renderowana jako Markdown w obsługujących klientach.',
    'Regular text only' => 'Tylko zwykły tekst',
    'Markdown enabled' => 'Markdown włączony',

    // Message tab: Slack
    'Slack Message Body' => 'Treść wiadomości Slack',
    'Supports standard [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) syntax. Optionally supports HTML _(see below)_.' => 'Obsługuje standardową składnię [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting). Opcjonalnie obsługuje HTML _(patrz poniżej)_.',
    'Render Message Body as HTML' => 'Renderuj treść wiadomości jako HTML',
    'Whether to only parse as [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), or additionally parse it as HTML.' => 'Czy parsować tylko jako [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), czy także jako HTML.',
    'Render Link Previews' => 'Pokaż podglądy linków',
    'Whether Slack should unfurl link previews for URLs in the message body.' => 'Czy Slack ma rozwijać podglądy linków dla adresów URL w treści wiadomości.',
    'Don\'t unfurl' => 'Nie rozwijaj',
    'Expand link previews' => 'Rozwiń podglądy linków',
    'Bot Name' => 'Nazwa użytkownika',
    'Optionally override the app\'s display name.' => 'Opcjonalnie zastąp nazwę wyświetlaną aplikacji.',
    'Dynamic Bot Name' => 'Dynamiczna nazwa bota',
    'Bot Icon URL' => 'URL ikony',
    'Optionally override the app\'s icon with a URL.' => 'Opcjonalnie zastąp ikonę aplikacji adresem URL.',
    'Bot Emoji' => 'Emoji ikony',
    'Optionally override the app\'s icon with an emoji. Used only when Bot Icon URL is empty.' => 'Opcjonalnie zastąp ikonę aplikacji emoji. Używane tylko, gdy Bot Icon URL jest pusty.',

    // Message tab: Discord
    'Discord Message Body' => 'Treść wiadomości Discord',
    'Supports standard Markdown, and optionally HTML _(see below)_. Max 2000 characters.' => 'Obsługuje standardowy Markdown i opcjonalnie HTML _(patrz poniżej)_. Maks. 2000 znaków.',
    'Whether to only parse as Markdown, or additionally parse it as HTML.' => 'Czy parsować tylko jako Markdown, czy także jako HTML.',
    'Markdown only' => 'Tylko Markdown',
    'Markdown + HTML' => 'Markdown + HTML',
    'Whether Discord should unfurl link previews for URLs in the message body.' => 'Czy Discord ma wyświetlać podglądy linków dla adresów URL w treści wiadomości.',
    'Webhook Username' => 'Nazwa użytkownika webhooka',
    'Optionally override the webhook\'s display name.' => 'Opcjonalnie zastąp nazwę wyświetlaną webhooka.',
    'Dynamic Username' => 'Dynamiczna nazwa użytkownika',
    'Webhook Avatar URL' => 'URL awatara webhooka',
    'Optionally override the webhook\'s avatar with a URL.' => 'Opcjonalnie zastąp awatar webhooka adresem URL.',

    // Message tab: Bluesky
    'Post Body' => 'Treść posta',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => 'Zwykły tekst, maks. 300 znaków. URL-e i wzmianki `@handle.tld` zostaną automatycznie podlinkowane.',
    'Generate Link Preview' => 'Generuj podgląd linku',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => 'Automatycznie generuj kartę podglądu, gdy treść posta zawiera URL.',
    'No card' => 'Bez karty',
    'Generate preview card' => 'Generuj kartę podglądu',

    // Message tab: Mastodon
    'Plain text, max 500 characters. URLs will unfurl automatically.' => 'Zwykły tekst, maks. 500 znaków. URL-e rozwijają się automatycznie.',
    'Visibility' => 'Widoczność',
    'Who will be able to see this post?' => 'Kto będzie mógł zobaczyć ten post?',

    // Message tab: MQTT
    'Payload' => 'Zawartość',
    'The JSON or plain text message published to the MQTT topic.' => 'Wiadomość JSON lub zwykły tekst publikowana w temacie MQTT.',
    'Quality of Service' => 'Jakość usługi',
    'Delivery guarantee for this message.' => 'Gwarancja dostarczenia tej wiadomości.',
    'Retain' => 'Zachowaj',
    'Whether the broker keeps this as the topic\'s last message for future subscribers.' => 'Czy broker zachowuje ją jako ostatnią wiadomość tematu i dostarcza ją przyszłym subskrybentom.',
    'Don\'t retain' => 'Nie zachowuj',

    // Recipients tab: type selector & user/group pickers
    'Recipients Type' => 'Typ odbiorców',
    'Who will receive this message?' => 'Kto otrzyma tę wiadomość?',
    'Add a message recipient' => 'Dodaj odbiorcę',
    'Select User(s)' => 'Wybierz użytkownika(-ów)',
    'Which users will receive the message?' => 'Którzy użytkownicy otrzymają wiadomość?',
    'Which user groups will receive the message?' => 'Które grupy użytkowników otrzymają wiadomość?',

    // Recipients tab: channel pickers (ntfy, Slack, Discord, Bluesky, Mastodon, MQTT)
    'Select ntfy topic(s)' => 'Wybierz temat(y) ntfy',
    'Which topics should receive this message?' => 'Które tematy mają otrzymać tę wiadomość?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'Brak skonfigurowanych tematów ntfy. Dodaj jeden w [Ustawienia → ntfy]({url}).',
    'No ntfy topics configured. Topics can only be added in an environment that allows administrative changes.' => 'Brak skonfigurowanych tematów ntfy. Tematy można dodawać tylko w środowisku, które zezwala na zmiany administracyjne.',
    'Select Slack channel(s)' => 'Wybierz kanał(y) Slack',
    'Which channels should receive this message?' => 'Które kanały mają otrzymać tę wiadomość?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Brak skonfigurowanych kanałów Slack. Dodaj jeden w [Ustawienia → Slack]({url}).',
    'No Slack channels configured. Channels can only be added in an environment that allows administrative changes.' => 'Brak skonfigurowanych kanałów Slack. Kanały można dodawać tylko w środowisku, które zezwala na zmiany administracyjne.',
    'Select Discord channel(s)' => 'Wybierz kanał(y) Discord',
    'No Discord channels configured. Add one in [Settings → Discord]({url}).' => 'Brak skonfigurowanych kanałów Discord. Dodaj jeden w [Ustawienia → Discord]({url}).',
    'No Discord channels configured. Channels can only be added in an environment that allows administrative changes.' => 'Brak skonfigurowanych kanałów Discord. Kanały można dodawać tylko w środowisku, które zezwala na zmiany administracyjne.',
    'Select Bluesky account(s)' => 'Wybierz konto(a) Bluesky',
    'Which accounts should post this message?' => 'Które konta powinny opublikować tę wiadomość?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Brak skonfigurowanych kont Bluesky. Dodaj jedno w [Ustawienia → Bluesky]({url}).',
    'No Bluesky accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Brak skonfigurowanych kont Bluesky. Konta można dodawać tylko w środowisku, które zezwala na zmiany administracyjne.',
    'Select Mastodon account(s)' => 'Wybierz konto(a) Mastodon',
    'No Mastodon accounts configured. Add one in [Settings → Mastodon]({url}).' => 'Brak skonfigurowanych kont Mastodon. Dodaj jedno w [Ustawienia → Mastodon]({url}).',
    'No Mastodon accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Brak skonfigurowanych kont Mastodon. Konta można dodawać tylko w środowisku, które zezwala na zmiany administracyjne.',
    'Select MQTT topic(s)' => 'Wybierz temat(y) MQTT',
    'No MQTT topics configured. Add one in [Settings → MQTT]({url}).' => 'Nie skonfigurowano tematów MQTT. Dodaj jeden w [Ustawienia → MQTT]({url}).',
    'No MQTT topics configured. Topics can only be added in an environment that allows administrative changes.' => 'Nie skonfigurowano tematów MQTT. Tematy można dodawać tylko w środowisku, które zezwala na zmiany administracyjne.',
    'Not a valid topic. Must not be empty or contain the `+` or `#` wildcards.' => 'Nieprawidłowy temat. Nie może być pusty ani zawierać symboli wieloznacznych `+` lub `#`.',

    // Recipients tab: dynamic recipients snippet
    'Twig Snippet to Determine Recipients' => 'Fragment Twig do określenia odbiorców',
    'Enter a custom Twig snippet to [determine who will receive the message]({url}).' => 'Wprowadź własny fragment Twig, aby [określić, kto otrzyma wiadomość]({url}).',
    'The snippet **must** include a `{% setRecipients %}` tag.' => 'Fragment **musi** zawierać tag `{% setRecipients %}`.',

    // ========================================================
    // SETTINGS
    // ========================================================

    // Settings: nav & page chrome
    'Notifier Settings' => 'Ustawienia Notifier',
    'General' => 'Ogólne',
    'Twilio' => 'Twilio',
    'Pushover' => 'Pushover',
    'ntfy' => 'ntfy',
    'Slack' => 'Slack',
    'Discord' => 'Discord',
    'Bluesky' => 'Bluesky',
    'Mastodon' => 'Mastodon',
    'MQTT' => 'MQTT',

    // Settings: shared intro lines
    'Consult the [{name} setup guide]({url}) for complete instructions.' => 'Zajrzyj do [przewodnika konfiguracji {name}]({url}), aby uzyskać pełne instrukcje.',
    'Sensitive values can be stored in your `.env` file and referenced here.' => 'Wartości wrażliwe można przechowywać w pliku `.env` i odwoływać się do nich tutaj.',

    // Settings: Notification order
    'Notification Order' => 'Kolejność powiadomień',
    'Notifications can be dragged into any order on the index page. Choose where new notifications land in that order.' => 'Powiadomienia można przeciągać, aby ustawić własną kolejność na stronie listy. Wybierz, gdzie nowe powiadomienia są dodawane w tej kolejności.',
    'Default Placement' => 'Domyślne umiejscowienie',
    'Where new notifications are added to the list.' => 'Gdzie nowe powiadomienia są dodawane do listy.',
    'Before other notifications' => 'Przed innymi powiadomieniami',
    'After other notifications' => 'Po innych powiadomieniach',

    // Settings: Logging
    'Logging' => 'Rejestrowanie',
    "Notifier keeps a running log of every message it sends. You usually won't need to change this, but you can limit how many log entries are kept in the database." => 'Notifier prowadzi bieżący dziennik wysłanych wiadomości. Zwykle nie jest to konieczne, ale możesz ograniczyć liczbę zdarzeń zapisanych w bazie danych.',
    'Enable Logging' => 'Włącz rejestrowanie',
    'When disabled, Notifier will not write anything to the notification log.' => 'Gdy wyłączone, Notifier nie zapisuje nic w dzienniku powiadomień.',
    'Number of days to retain log events' => 'Liczba dni przechowywania zdarzeń dziennika',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Przechowuj zdarzenia dziennika maksymalnie tyle dni. Pozostaw puste, aby nie ustawiać limitu.',
    'Number of log events to retain' => 'Liczba zdarzeń dziennika do przechowywania',
    'At most, keep this many log events. Leave blank for no limit.' => 'Przechowuj maksymalnie tyle zdarzeń dziennika. Pozostaw puste, aby nie ustawiać limitu.',

    // Settings: Scheduled sending
    'Scheduled Sending' => 'Wysyłanie zaplanowane',
    'A shared secret that authenticates scheduled runs triggered over the web. You only need this if you trigger the schedule from the web endpoint.' => 'Wspólny sekret do uwierzytelniania żądań sieciowych zaplanowanego uruchomienia. Wymagany tylko wtedy, gdy harmonogram jest wyzwalany przez punkt końcowy sieci Web.',
    'Scheduled-Run Token' => 'Token zaplanowanego uruchomienia',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => 'Wysyłane z każdym żądaniem jako nagłówek X-Notifier-Token lub parametr token w treści.',

    // Settings: Twilio
    'Send SMS text messages through [Twilio](https://www.twilio.com).' => 'Wysyłaj wiadomości SMS przez [Twilio](https://www.twilio.com).',
    'Twilio Account SID' => 'Twilio Account SID',
    'Twilio Auth Token' => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)' => 'Numer telefonu Twilio (wysyła każdą wiadomość SMS)',
    'SMS Testing' => 'Testowanie SMS',
    'Optional. When set, every SMS is sent to this number instead of the actual recipient.' => 'Opcjonalne. Po ustawieniu każda wysłana wiadomość SMS trafi pod ten numer zamiast do faktycznego odbiorcy.',
    'Test phone number' => 'Testowy numer telefonu',

    // Settings: Pushover
    'Send push notifications through [Pushover](https://pushover.net).' => 'Wysyłaj powiadomienia push przez [Pushover](https://pushover.net).',
    'Application API Token' => 'Token API aplikacji',
    'The 30-character app token from your Pushover application.' => '30-znakowy token aplikacji z aplikacji Pushover.',

    // Settings: ntfy
    'Send push notifications through [ntfy](https://ntfy.sh).' => 'Wysyłaj powiadomienia push przez [ntfy](https://ntfy.sh).',
    'Server URL' => 'Adres URL serwera',
    "Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`." => 'Opcjonalne. W razie potrzeby wskaż samodzielnie hostowaną instancję ntfy. Domyślnie `https://ntfy.sh`.',
    'Access token' => 'Token dostępu',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Opcjonalne. Wymagane dla zabezpieczonych tematów lub samodzielnie hostowanych instancji z uwierzytelnianiem.',
    'ntfy Topics' => 'Tematy ntfy',
    'Add the ntfy topics you want to send to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Dodaj tematy ntfy, do których chcesz wysyłać wiadomości. Każdy temat staje się dostępny jako odbiorca w zakładce **Odbiorcy** podczas konfigurowania powiadomienia.',
    'Topics' => 'Tematy',
    "Click any row's **Test** button to send a quick test message to that topic." => 'Kliknij przycisk **Testuj** w dowolnym wierszu, aby wysłać szybką wiadomość testową do tego tematu.',
    'Label' => 'Etykieta',
    'Topic' => 'Temat',
    'Add a topic' => 'Dodaj temat',

    // Settings: Slack
    'Post messages to your Slack channels.' => 'Wysyłaj wiadomości do swoich kanałów Slack.',
    'Channels' => 'Kanały',
    "Click any row's **Test** button to send a quick test message to that channel." => 'Kliknij przycisk **Testuj** w dowolnym wierszu, aby wysłać szybką wiadomość testową na ten kanał.',
    'Bot Token' => 'Token bota',
    'Channel ID' => 'ID kanału',
    'Add a channel' => 'Dodaj kanał',
    'Not a valid Bot Token. Must start with `xoxb-`.' => 'Nieprawidłowy token bota. Musi zaczynać się od `xoxb-`.',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => 'Nieprawidłowy ID kanału. Musi wyglądać jak `C01234ABCD`.',

    // Settings: Discord
    'Post messages to your Discord channels.' => 'Wysyłaj wiadomości do swoich kanałów Discord.',
    'Webhook URL' => 'URL webhooka',
    'Not a valid Webhook URL. Must start with `https://discord.com/api/webhooks/`.' => 'Nieprawidłowy URL webhooka. Musi zaczynać się od `https://discord.com/api/webhooks/`.',

    // Settings: Bluesky
    'Publish posts to your [Bluesky](https://bsky.app) accounts.' => 'Publikuj wpisy na swoich kontach [Bluesky](https://bsky.app).',
    'PDS URL' => 'URL PDS',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'Domyślnie https://bsky.social. Wskaż własny PDS, jeśli Twoja instalacja federuje.',
    'Bluesky Accounts' => 'Konta Bluesky',
    'Add the Bluesky accounts you want to post from. Each account becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Dodaj konta Bluesky, z których chcesz publikować. Każde konto staje się dostępne jako odbiorca w zakładce **Odbiorcy** podczas konfigurowania powiadomienia.',
    'Accounts' => 'Konta',
    "Click any row's **Test** button to confirm the account authenticates." => 'Kliknij przycisk **Testuj** w dowolnym wierszu, aby potwierdzić, że konto się uwierzytelnia.',
    'Handle' => 'Identyfikator',
    'App password' => 'Hasło aplikacji',
    'Add an account' => 'Dodaj konto',

    // Settings: Mastodon
    'Publish posts to your [Mastodon](https://joinmastodon.org) accounts.' => 'Publikuj wpisy na swoich kontach [Mastodon](https://joinmastodon.org).',
    'Click any row\'s **Test** button to verify that account\'s credentials. No posts are made.' => 'Kliknij przycisk **Testuj** w dowolnym wierszu, aby zweryfikować dane logowania tego konta. Nie są publikowane żadne posty.',
    'Instance URL' => 'URL instancji',
    'Access Token' => 'Token dostępu',

    // Settings: MQTT
    'Publish messages to an MQTT broker, handy for IoT and home-automation setups.' => 'Publikuj wiadomości do brokera MQTT, przydatne w konfiguracjach IoT i automatyki domowej.',
    'Host' => 'Host',
    'Broker hostname, without a protocol or port.' => 'Nazwa hosta brokera, bez protokołu i portu.',
    'Port' => 'Port',
    'Optional. Defaults to 8883 when TLS is enabled, otherwise 1883.' => 'Opcjonalnie. Domyślnie 8883, gdy TLS jest włączony, w przeciwnym razie 1883.',
    'Use TLS' => 'Użyj TLS',
    'Whether to connect to the broker over a secure TLS socket.' => 'Czy łączyć się z brokerem przez bezpieczne gniazdo TLS.',
    'Username' => 'Nazwa użytkownika',
    'Optional, for brokers that require username/password authentication.' => 'Opcjonalnie, dla brokerów wymagających uwierzytelniania nazwą użytkownika/hasłem.',
    'Password' => 'Hasło',
    'MQTT Version' => 'Wersja MQTT',
    'Protocol version sent to the broker.' => 'Wersja protokołu wysyłana do brokera.',
    'Client ID' => 'Identyfikator klienta',
    'Optional. A unique client ID is generated automatically when left blank.' => 'Opcjonalnie. Po pozostawieniu pustego pola automatycznie generowany jest unikalny identyfikator klienta.',
    'Mutual TLS' => 'Wzajemny TLS',
    'Optional. Needed for brokers that authenticate clients with certificates, such as AWS IoT Core. Enter the server file paths to your certificate files. You can use a `.env` variable or `@alias` reference.' => 'Opcjonalnie. Wymagane dla brokerów uwierzytelniających klientów certyfikatami, takich jak AWS IoT Core. Podaj ścieżki plików na serwerze do plików certyfikatów (dozwolona jest zmienna `.env` lub odwołanie `@alias`).',
    'CA Certificate File' => 'Plik certyfikatu CA',
    'Path to the certificate authority (CA) file.' => 'Ścieżka do pliku urzędu certyfikacji (CA).',
    'Client Certificate File' => 'Plik certyfikatu klienta',
    'Path to the client certificate file.' => 'Ścieżka do pliku certyfikatu klienta.',
    'Client Key File' => 'Plik klucza klienta',
    'Path to the client private key file.' => 'Ścieżka do pliku klucza prywatnego klienta.',
    'MQTT Topics' => 'Tematy MQTT',
    'Add the MQTT topics you want to publish to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Dodaj tematy MQTT, do których chcesz publikować. Każdy temat staje się dostępny jako odbiorca w zakładce **Odbiorcy** podczas konfigurowania powiadomienia.',
    'Click any row\'s **Test** button to publish a quick test message to that topic.' => 'Kliknij przycisk **Testuj** w dowolnym wierszu, aby opublikować szybką wiadomość testową do tego tematu.',

    // ========================================================
    // MANUAL SEND & TEST
    // ========================================================

    // Manual send & test
    'Send a test message' => 'Wyślij wiadomość testową',
    'Send a REAL test notification?\\n\\n⚠️ Uses a random sample of real data.\\n⚠️ Sends a real message via the configured channel.\\n⚠️ Delivers to the real configured recipient(s).' => 'Wysłać PRAWDZIWE powiadomienie testowe?\\n\\n⚠️ Używa losowej próbki rzeczywistych danych.\\n⚠️ Wysyła prawdziwą wiadomość przez skonfigurowany kanał.\\n⚠️ Jest dostarczane do prawdziwych skonfigurowanych odbiorców.',
    'Test' => 'Testuj',
    'Send system snapshot' => 'Wyślij migawkę systemu',
    'Send data report' => 'Wyślij raport danych',
    'Are you sure you want to send this notification?' => 'Czy na pewno chcesz wysłać to powiadomienie?',
    'This notification cannot be triggered manually.' => 'Tego powiadomienia nie można wyzwolić ręcznie.',
    'This notification no longer applies to the selected element.' => 'To powiadomienie nie dotyczy już wybranego elementu.',

    // ========================================================
    // RUNTIME OUTPUT
    // ========================================================

    // Runtime: dispatch log feedback
    'Sending {messageType} to {recipient}.' => 'Wysyłanie {messageType} do {recipient}.',
    'Adding message to queue.' => 'Dodawanie wiadomości do kolejki.',
    'Sending message immediately (bypassing queue).' => 'Wysyłanie wiadomości natychmiast (z pominięciem kolejki).',
    'Unable to parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => 'Nie można sparsować kanału. Wymagane są rozszerzenia PHP `simplexml` i `libxml`.',
    'Unable to parse the feed.' => 'Nie można sparsować kanału.',
    'Unable to fetch the feed: {message}' => 'Nie można pobrać kanału: {message}',
    'Initial feed scan failed: {message}' => 'Wstępne skanowanie kanału nie powiodło się: {message}',

    // Runtime: controller responses
    'Test notification dispatched.' => 'Wysłano powiadomienie testowe.',
    'No messages were dispatched. Check the recipient configuration.' => 'Nie wysłano żadnych wiadomości. Sprawdź konfigurację odbiorców.',
    'Unable to send test: the feed could not be read or has no items.' => 'Nie można wysłać testu: nie można odczytać kanału lub nie zawiera elementów.',
    'Unable to send test: no element matches the configured filters.' => 'Nie można wysłać testu: żaden element nie pasuje do skonfigurowanych filtrów.',
    "Couldn't save settings." => 'Nie udało się zapisać ustawień.',
    'Settings saved.' => 'Ustawienia zapisane.',
    'Topic is empty.' => 'Temat jest pusty.',
    'Server URL is not configured.' => 'URL serwera nie został skonfigurowany.',
    'Test message from Notifier.' => 'Wiadomość testowa z Notifier.',
    'HTTP {status}' => 'HTTP {status}',
    'Test message sent successfully.' => 'Pomyślnie wysłano wiadomość testową.',
    'Handle and app password are required.' => 'Identyfikator i hasło aplikacji są wymagane.',
    'Authentication failed.' => 'Uwierzytelnianie nie powiodło się.',
    'Successfully authenticated. No messages were posted.' => 'Uwierzytelnianie powiodło się. Nie opublikowano żadnych wiadomości.',
    'Log events deleted.' => 'Usunięto zdarzenia dziennika.',
    'Notification sent.' => 'Powiadomienie wysłane.',
    'Notification was not sent. Check the Notification Log for details.' => 'Powiadomienie nie zostało wysłane. Sprawdź Dziennik powiadomień, aby uzyskać szczegóły.',
    'Instance URL and access token are required.' => 'URL instancji i token dostępu są wymagane.',
    'Mastodon rejected the request: {error}' => 'Mastodon odrzucił żądanie: {error}',
    'Successfully authenticated as @{handle}. No posts were made.' => 'Pomyślnie uwierzytelniono jako @{handle}. Nie opublikowano żadnych postów.',
    'Broker host is not configured.' => 'Host brokera nie jest skonfigurowany.',

    // Outbound: per-channel send results
    'Unable to send email, no recipient specified.' => 'Nie można wysłać e-maila: nie podano odbiorcy.',
    'Unable to send email, the message body was empty.' => 'Nie można wysłać e-maila: treść wiadomości była pusta.',
    "Unable to send the email using Craft's native email handling." => 'Nie można wysłać e-maila przy użyciu natywnej obsługi e-maili Craft.',
    'Check your general email settings within Craft.' => 'Sprawdź ogólne ustawienia e-maila w Craft.',
    'Successfully sent email message!' => 'Pomyślnie wysłano wiadomość e-mail!',
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[Nieprawidłowe dane Twilio.]({url}) Brak {missing}.',
    'Unable to send SMS, no Twilio phone number exists.' => "Nie można wysłać SMS'a: brak numeru telefonu Twilio.",
    'Unable to send SMS, no recipient phone number exists.' => "Nie można wysłać SMS'a: brak numeru telefonu odbiorcy.",
    'Unable to send SMS, recipient phone number is invalid.' => "Nie można wysłać SMS'a: numer telefonu odbiorcy jest nieprawidłowy.",
    'Successfully sent SMS message!' => 'Pomyślnie wysłano wiadomość SMS!',
    'Unable to post announcement, no recipient userId specified.' => 'Nie można opublikować ogłoszenia: nie podano userId odbiorcy.',
    'Successfully posted announcement!' => 'Pomyślnie opublikowano ogłoszenie!',
    'Unable to send the flash message, invalid flash type.' => 'Nie można wysłać wiadomości flash: nieprawidłowy typ flash.',
    'Successfully sent flash message!' => 'Pomyślnie wysłano wiadomość flash!',
    '[Invalid Pushover credentials.]({url}) Missing app token.' => '[Nieprawidłowe dane Pushover.]({url}) Brak tokena aplikacji.',
    'Unable to send Pushover message, no user key on recipient.' => 'Nie można wysłać wiadomości Pushover: brak klucza użytkownika u odbiorcy.',
    'Pushover POST failed: {reason}' => 'POST Pushover nie powiódł się: {reason}',
    'Successfully sent Pushover message!' => 'Pomyślnie wysłano wiadomość Pushover!',
    'Unable to send ntfy message, no topic specified.' => 'Nie można wysłać wiadomości ntfy: nie podano tematu.',
    'ntfy POST failed with HTTP {status}: {reason}' => 'POST ntfy nie powiódł się z HTTP {status}: {reason}',
    'ntfy POST failed: {reason}' => 'POST ntfy nie powiódł się: {reason}',
    'Successfully sent ntfy message to topic "{topic}".' => 'Pomyślnie wysłano wiadomość ntfy do tematu "{topic}".',
    'Unable to send Slack message, no bot token.' => 'Nie można wysłać wiadomości Slack: brak tokena bota.',
    'Unable to send Slack message, no channel ID.' => 'Nie można wysłać wiadomości Slack: brak ID kanału.',
    'Unable to send Slack message, body is empty.' => 'Nie można wysłać wiadomości Slack: treść jest pusta.',
    'Slack rejected the message: {error}' => 'Slack odrzucił wiadomość: {error}',
    'Slack POST failed: {reason}' => 'POST Slack nie powiódł się: {reason}',
    'Successfully sent Slack message to "{label}".' => 'Pomyślnie wysłano wiadomość Slack do "{label}".',
    'Unable to send Discord message, no webhook URL.' => 'Nie można wysłać wiadomości Discord: brak adresu URL webhooka.',
    'Unable to send Discord message, body is empty.' => 'Nie można wysłać wiadomości Discord: treść jest pusta.',
    'Unable to send Discord message, body exceeds the 2000-character limit.' => 'Nie można wysłać wiadomości Discord: treść przekracza limit 2000 znaków.',
    'Discord rejected the message: {error}' => 'Discord odrzucił wiadomość: {error}',
    'Discord POST failed: {reason}' => 'POST Discord nie powiódł się: {reason}',
    'Successfully sent Discord message to "{label}".' => 'Pomyślnie wysłano wiadomość Discord do "{label}".',
    'Unable to send Bluesky post, recipient is missing credentials.' => 'Nie można wysłać posta Bluesky: u odbiorcy brak danych logowania.',
    'Body exceeded {max} characters, truncated.' => 'Treść przekroczyła {max} znaków i została skrócona.',
    'Successfully posted to Bluesky as "{label}".' => 'Pomyślnie opublikowano w Bluesky jako "{label}".',
    'Bluesky auth failed for {handle}: {reason}' => 'Uwierzytelnianie Bluesky nie powiodło się dla {handle}: {reason}',
    'Bluesky auth failed: {reason}' => 'Uwierzytelnianie Bluesky nie powiodło się: {reason}',
    'Bluesky post failed: {reason}' => 'Publikacja w Bluesky nie powiodła się: {reason}',
    'Bluesky link preview skipped: {reason}' => 'Pominięto podgląd linku Bluesky: {reason}',
    'Unable to send Mastodon post, no instance URL.' => 'Nie można wysłać posta Mastodon: brak adresu URL instancji.',
    'Unable to send Mastodon post, no access token.' => 'Nie można wysłać posta Mastodon: brak tokena dostępu.',
    'Unable to send Mastodon post, body is empty.' => 'Nie można wysłać posta Mastodon: treść jest pusta.',
    'Mastodon rejected the post: {error}' => 'Mastodon odrzucił post: {error}',
    'Mastodon POST failed: {reason}' => 'POST Mastodon nie powiódł się: {reason}',
    'Successfully sent Mastodon post to "{label}".' => 'Pomyślnie wysłano post Mastodon do "{label}".',
    'Unable to send MQTT message, no broker host configured.' => 'Nie można wysłać wiadomości MQTT, nie skonfigurowano hosta brokera.',
    'Unable to send MQTT message, no topic specified.' => 'Nie można wysłać wiadomości MQTT, nie określono tematu.',
    'Unable to send MQTT message, the payload is empty.' => 'Nie można wysłać wiadomości MQTT, zawartość jest pusta.',
    'MQTT publish failed: {reason}' => 'Publikacja MQTT nie powiodła się: {reason}',
    'Successfully sent MQTT message to topic "{topic}".' => 'Wysłano wiadomość MQTT do tematu "{topic}".',

    // Recipient warnings
    'Recipient "{name}" has no email address.' => 'Odbiorca "{name}" nie ma adresu e-mail.',
    'Recipient "{name}" has no phone number.' => 'Odbiorca "{name}" nie ma numeru telefonu.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => 'Odbiorca "{name}" nie ma powiązanego użytkownika; nie można wysłać ogłoszenia.',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => 'Odbiorca "{name}" nie ma dostępu do panelu sterowania; nie można wysłać ogłoszenia.',
    'Pushover user-key field is not configured on this notification.' => 'Pole klucza użytkownika Pushover nie jest skonfigurowane w tym powiadomieniu.',
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => 'Odbiorca "{name}" nie ma powiązanego użytkownika; nie można wysłać wiadomości Pushover.',
    '[SKIPPED] User "{name}" has no Pushover key.' => '[POMINIĘTO] Użytkownik "{name}" nie ma klucza Pushover.',
    'Recipient "{name}" has no ntfy topic.' => 'Odbiorca "{name}" nie ma tematu ntfy.',
    'Recipient "{name}" has no Slack bot token.' => 'Odbiorca "{name}" nie ma tokena bota Slack.',
    'Recipient "{name}" has no Slack channel ID.' => 'Odbiorca "{name}" nie ma ID kanału Slack.',
    'Recipient "{name}" has no Discord webhook URL.' => 'Odbiorca "{name}" nie ma adresu URL webhooka Discord.',
    'Recipient "{name}" has no Bluesky credentials.' => 'Odbiorca "{name}" nie ma danych logowania Bluesky.',
    'Recipient "{name}" has no Mastodon credentials.' => 'Odbiorca "{name}" nie ma danych logowania Mastodon.',
    'Recipient "{name}" has no MQTT topic.' => 'Odbiorca "{name}" nie ma tematu MQTT.',

    // Errors & exceptions
    'Invalid element event: {class}' => 'Nieprawidłowe zdarzenie elementu: {class}',
    'Invalid notification ID: {id}' => 'Nieprawidłowy identyfikator powiadomienia: {id}',
    'Invalid email message mode.' => 'Nieprawidłowy tryb wiadomości e-mail.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Nie masz uprawnień do używania typu Dynamiczni odbiorcy.',
    'Dynamic recipients snippet did not call setRecipients.' => 'Fragment dynamicznych odbiorców nie wywołał setRecipients.',
    'setRecipients was called with an empty value.' => 'setRecipients zostało wywołane z pustą wartością.',
    'Unrecognized recipient of type "{type}".' => 'Nierozpoznany odbiorca typu "{type}".',
    'Unrecognized recipient "{value}".' => 'Nierozpoznany odbiorca "{value}".',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => 'Skonfigurowany element {kind} nie istnieje już w ustawieniach wtyczki (uid: {uid}).',
    'Invalid settings section: {section}' => 'Nieprawidłowa sekcja ustawień: {section}',
    'User not authorized to save this notification.' => 'Użytkownik nie ma uprawnień do zapisania tego powiadomienia.',
    'User not authorized to view this notification.' => 'Użytkownik nie ma uprawnień do wyświetlania tego powiadomienia.',
    'User not authorized to delete this notification.' => 'Użytkownik nie ma uprawnień do usunięcia tego powiadomienia.',
    'Notification not found' => 'Powiadomienie nie znalezione',
    'Element not found' => 'Nie znaleziono elementu',
    'You do not have permission to use the Dynamic Data type.' => 'Nie masz uprawnień do używania typu Dane dynamiczne.',
    'The Dynamic Data snippet did not call the {tag} tag.' => 'Fragment Twig nie wywołał znacznika {tag}.',

    // Config-file override note
    'This is being set in the config file. [{file}]' => 'To jest ustawiane w pliku konfiguracyjnym. [{file}]',

    // ========================================================
    // JAVASCRIPT UI
    // ========================================================

    // JavaScript: log utility & buttons
    'Test notification failed.' => 'Powiadomienie testowe nie powiodło się.',
    'Unable to get the notification, something went wrong.' => 'Nie udało się pobrać powiadomienia, coś poszło nie tak.',
    'Something went wrong.' => 'Coś poszło nie tak.',
    'Invalid notification ID.' => 'Nieprawidłowy identyfikator powiadomienia.',
    'Unable to delete the log event, something went wrong.' => 'Nie udało się usunąć zdarzenia dziennika, coś poszło nie tak.',
    'Log event deleted.' => 'Zdarzenie dziennika zostało usunięte.',
    'Unable to delete log events, something went wrong.' => 'Nie udało się usunąć zdarzeń dziennika, coś poszło nie tak.',
    'Are you sure you want to delete all logs from {date}?' => 'Czy na pewno chcesz usunąć wszystkie dzienniki z dnia {date}?',
];
