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
    'Feed Timeout' => 'Limit czasu kanału',
    'How long to wait when the feed is loading slowly. Default {default} seconds, max {max}.' => 'Jak długo czekać, gdy kanał ładuje się wolno. Domyślnie {default} sekund, maks. {max}.',
    'seconds' => 'sekundy',

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
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are supported.' => 'Obsługiwane są [szablony]({templatingUrl}) i [zmienne specjalne]({variablesUrl}).',

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

    // Message tab: Facebook
    'Message Body' => 'Treść wiadomości',
    'The text of your Facebook post.' => 'Tekst Twojego posta Facebook.',
    'Preview Card URL' => 'URL karty podglądu',
    'Optionally add a link to generate a preview card.' => 'Opcjonalnie dodaj link, aby wygenerować kartę podglądu.',

    // Message tab: Instagram
    'Caption' => 'Podpis',
    'Image Attachment' => 'Załącznik obrazu',
    'Optional caption, max 2200 characters.' => 'Opcjonalny podpis, maks. 2200 znaków.',

    // Message tab: X (Twitter)
    'Plain text, max 280 characters.' => 'Zwykły tekst, maks. 280 znaków.',

    // Message tab: Media
    'Attach an image by calling `{% setMedia %}` in a [custom Twig snippet]({url}).' => 'Dołącz obraz, wywołując `{% setMedia %}` w [niestandardowym fragmencie Twig]({url}).',

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

    // Message tab: LinkedIn
    'LinkedIn' => 'LinkedIn',
    'The text of your LinkedIn post.' => 'Treść Twojego posta LinkedIn.',

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
    'Select Facebook page(s)' => 'Wybierz stronę(y) Facebook',
    'Which pages should post this message?' => 'Które strony powinny opublikować tę wiadomość?',
    'No Facebook pages configured. Add one in [Settings → Facebook]({url}).' => 'Brak skonfigurowanych stron Facebook. Dodaj jedną w [Ustawienia → Facebook]({url}).',
    'No Facebook pages configured. Pages can only be added in an environment that allows administrative changes.' => 'Brak skonfigurowanych stron Facebook. Strony można dodawać tylko w środowisku, które zezwala na zmiany administracyjne.',
    'Select Instagram account(s)' => 'Wybierz konto(a) Instagram',
    'No Instagram accounts configured. Add one in [Settings → Instagram]({url}).' => 'Brak skonfigurowanych kont Instagram. Dodaj jedno w [Ustawienia → Instagram]({url}).',
    'No Instagram accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Brak skonfigurowanych kont Instagram. Konta można dodawać tylko w środowisku, które zezwala na zmiany administracyjne.',
    'Select X (Twitter) account(s)' => 'Wybierz konto(a) X (Twitter)',
    'No X (Twitter) accounts configured. Add one in [Settings → X (Twitter)]({url}).' => 'Brak skonfigurowanych kont X (Twitter). Dodaj jedno w [Ustawienia → X (Twitter)]({url}).',
    'No X (Twitter) accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Brak skonfigurowanych kont X (Twitter). Konta można dodawać tylko w środowisku, które zezwala na zmiany administracyjne.',
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

    // Recipients tab: LinkedIn picker
    'Select LinkedIn account(s)' => 'Wybierz konto(-a) LinkedIn',
    'Which page or member should post this message?' => 'Która strona lub członek ma opublikować tę wiadomość?',
    'No LinkedIn accounts connected. Connect one in [Settings → LinkedIn]({url}).' => 'Brak połączonych kont LinkedIn. Połącz jedno w [Ustawienia → LinkedIn]({url}).',
    'No LinkedIn accounts connected. Accounts can only be connected in an environment that allows administrative changes.' => 'Brak połączonych kont LinkedIn. Konta można łączyć tylko w środowisku, które zezwala na zmiany administracyjne.',

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

    // Settings: nav group headings
    'Push Notifications' => 'Powiadomienia push',
    'Chat Platforms' => 'Platformy czatu',
    'Social Media' => 'Media społecznościowe',
    'Internet of Things' => 'Internet rzeczy',
    'Expand {heading}' => 'Rozwiń {heading}',

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

    // Settings: Facebook
    'Facebook' => 'Facebook',
    'Publish posts to your [Facebook](https://facebook.com) pages.' => 'Publikuj posty na swoich stronach [Facebook](https://facebook.com).',
    'Pages' => 'Strony',
    'Page ID' => 'Page ID',
    'Page Access Token' => 'Page Access Token',
    'Add a page' => 'Dodaj stronę',
    "Click any row's **Test** button to verify that page's credentials. No posts are made." => 'Kliknij przycisk **Testuj** w dowolnym wierszu, aby zweryfikować dane logowania tej strony. Nie są publikowane żadne posty.',

    // Settings: Instagram
    'Instagram' => 'Instagram',
    'Publish posts to your [Instagram](https://instagram.com) Business accounts.' => 'Publikuj posty na swoich kontach [Instagram](https://instagram.com) Business.',
    "Click any row's **Test** button to resolve the linked Instagram account. No posts are made." => 'Kliknij przycisk **Testuj** w dowolnym wierszu, aby ustalić powiązane konto Instagram. Nie są publikowane żadne posty.',

    // Settings: X (Twitter)
    'X (Twitter)' => 'X (Twitter)',
    'Publish posts to your [X (Twitter)](https://x.com) accounts.' => 'Publikuj posty na swoich kontach [X (Twitter)](https://x.com).',
    'Consumer Key' => 'Consumer Key',
    'Consumer Key Secret' => 'Consumer Key Secret',
    'Access Token Secret' => 'Access Token Secret',

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

    // Settings: LinkedIn
    'Publish posts to your [LinkedIn](https://linkedin.com) profile.' => 'Publikuj posty na swoim profilu [LinkedIn](https://linkedin.com).',
    'The Client ID of your LinkedIn app.' => 'Identyfikator klienta Twojej aplikacji LinkedIn.',
    'Client Secret' => 'Sekret klienta',
    'The Primary Client Secret of your LinkedIn app.' => 'Główny sekret klienta Twojej aplikacji LinkedIn.',
    'Enable organization posting' => 'Włącz publikowanie jako organizacja',
    'Copy this redirect URL' => 'Skopiuj ten URL przekierowania',
    'When configuring the LinkedIn app, <strong>copy this URL</strong> to use as an "Authorized redirect URL".' => 'Podczas konfigurowania aplikacji LinkedIn <strong>skopiuj ten URL</strong>, aby użyć go jako "Authorized redirect URL".',
    'Also request access to post as organization pages you administer. Requires Community Management API approval from LinkedIn.' => 'Poproś również o dostęp do publikowania jako strony organizacji, którymi zarządzasz. Wymaga zatwierdzenia Community Management API przez LinkedIn.',
    'Connections' => 'Połączenia',
    'Each connection becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Każde połączenie staje się dostępne jako odbiorca na karcie **Odbiorcy** podczas konfigurowania powiadomienia.',
    'Account' => 'Konto',
    'Type' => 'Typ',
    'Status' => 'Status',
    'Organization' => 'Organizacja',
    'Member' => 'Członek',
    'Reconnect needed' => 'Wymagane ponowne połączenie',
    'Expires' => 'Wygasa',
    'Connected' => 'Połączono',
    'Disconnect' => 'Rozłącz',
    'No LinkedIn accounts are connected yet.' => 'Nie połączono jeszcze żadnych kont LinkedIn.',
    'Connect to LinkedIn' => 'Połącz z LinkedIn',
    'Provide valid credentials to connect with LinkedIn.' => 'Podaj prawidłowe dane uwierzytelniające, aby połączyć się z LinkedIn.',
    'Disconnect this LinkedIn account?' => 'Rozłączyć to konto LinkedIn?',

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
    'Sending "{title}".' => 'Wysyłanie "{title}".',
    '[invalid recipient]' => '[nieprawidłowy odbiorca]',
    'Scanning feed {url}.' => 'Skanowanie kanału {url}.',
    'Adding message to queue.' => 'Dodawanie wiadomości do kolejki.',
    'Sending message immediately (bypassing queue).' => 'Wysyłanie wiadomości natychmiast (z pominięciem kolejki).',

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
    'Page ID and Page Access Token are required.' => 'Page ID i Page Access Token są wymagane.',
    'Facebook rejected the request: {error}' => 'Facebook odrzucił żądanie: {error}',
    'Successfully connected to "{name}". No posts were made.' => 'Pomyślnie połączono z "{name}". Nie opublikowano żadnych postów.',
    'No Instagram Business account is linked to this Page.' => 'Z tą stroną nie jest powiązane żadne konto Instagram Business.',
    'Successfully connected to @{handle}. No posts were made.' => 'Pomyślnie połączono z @{handle}. Nie opublikowano żadnych postów.',
    'All four credentials are required.' => 'Wszystkie cztery dane logowania są wymagane.',
    'X (Twitter) rejected the request: {error}' => 'X (Twitter) odrzucił żądanie: {error}',
    'Successfully authenticated as @{username}. No posts were made.' => 'Pomyślnie uwierzytelniono jako @{username}. Nie opublikowano żadnych postów.',
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

    // Runtime: LinkedIn connect flow
    'Add your LinkedIn app credentials before connecting.' => 'Dodaj poświadczenia aplikacji LinkedIn przed połączeniem.',
    'LinkedIn authorization failed: {error}' => 'Autoryzacja LinkedIn nie powiodła się: {error}',
    'LinkedIn authorization failed: invalid state.' => 'Autoryzacja LinkedIn nie powiodła się: nieprawidłowy stan.',
    'LinkedIn authorization failed: no code returned.' => 'Autoryzacja LinkedIn nie powiodła się: nie zwrócono kodu.',
    'Connected to LinkedIn.' => 'Połączono z LinkedIn.',
    'Disconnected from LinkedIn.' => 'Rozłączono z LinkedIn.',

    // Outbound: per-channel send results
    'Successfully sent an email to {name}.' => 'Pomyślnie wysłano wiadomość e-mail do {name}.',
    'Successfully sent an SMS message to {name}.' => 'Pomyślnie wysłano wiadomość SMS do {name}.',
    'Successfully sent a Pushover notification to {name}.' => 'Pomyślnie wysłano powiadomienie Pushover do {name}.',
    'Successfully posted an announcement for {name}.' => 'Pomyślnie opublikowano ogłoszenie dla {name}.',
    'Successfully sent a flash message to {name}.' => 'Pomyślnie wysłano wiadomość flash do {name}.',
    'Successfully posted to Slack in channel "{label}".' => 'Pomyślnie opublikowano w Slack na kanale "{label}".',
    'Successfully posted to Discord in channel "{label}".' => 'Pomyślnie opublikowano w Discord na kanale "{label}".',
    'Successfully posted to Facebook as "{label}" account.' => 'Pomyślnie opublikowano na Facebook jako konto "{label}".',
    'Successfully posted to Instagram as "{label}" account.' => 'Pomyślnie opublikowano na Instagram jako konto "{label}".',
    'Successfully posted to X (Twitter) as "{label}" account.' => 'Pomyślnie opublikowano na X (Twitter) jako konto "{label}".',
    'Successfully posted to Bluesky as "{label}" account.' => 'Pomyślnie opublikowano na Bluesky jako konto "{label}".',
    'Successfully posted to Mastodon as "{label}" account.' => 'Pomyślnie opublikowano na Mastodon jako konto "{label}".',
    'Successfully posted to LinkedIn as "{label}" account.' => 'Pomyślnie opublikowano na LinkedIn jako konto "{label}".',
    'Successfully sent ntfy message to topic "{topic}".' => 'Pomyślnie wysłano wiadomość ntfy do tematu "{topic}".',
    'Slack rejected the message: {error}' => 'Slack odrzucił wiadomość: {error}',
    'Discord rejected the message: {error}' => 'Discord odrzucił wiadomość: {error}',
    'the attached image could not be read' => 'nie udało się odczytać załączonego obrazu',
    'Successfully sent MQTT message to topic "{topic}".' => 'Wysłano wiadomość MQTT do tematu "{topic}".',

    // Outbound: LinkedIn send results & skips
    '[EMPTY BODY] The LinkedIn post body is empty.' => '[EMPTY BODY] Treść posta LinkedIn jest pusta.',
    '[NO RECIPIENT] No LinkedIn connection was specified.' => '[NO RECIPIENT] Nie określono połączenia LinkedIn.',
    '[RECONNECT REQUIRED] {reason}' => '[RECONNECT REQUIRED] {reason}',
    '[REJECTED BY LINKEDIN] {error}' => '[REJECTED BY LINKEDIN] {error}',
    'LinkedIn app credentials are not configured.' => 'Poświadczenia aplikacji LinkedIn nie są skonfigurowane.',
    'The LinkedIn access token has expired. Please reconnect.' => 'Token dostępu LinkedIn wygasł. Połącz ponownie.',
    'The LinkedIn connection no longer exists.' => 'Połączenie LinkedIn już nie istnieje.',
    'My LinkedIn Profile' => 'Mój profil LinkedIn',
    '[SKIPPED] Recipient "{name}" has no LinkedIn connection.' => '[SKIPPED] Odbiorca "{name}" nie ma połączenia LinkedIn.',
    '[SKIPPED] The configured LinkedIn connection no longer exists (uid: {uid}).' => '[SKIPPED] Skonfigurowane połączenie LinkedIn już nie istnieje (uid: {uid}).',

    // Media attachments
    'Videos are not yet supported on {channel}.' => 'Wideo nie jest jeszcze obsługiwane na {channel}.',
    'The image could not be resized to fit.' => 'Nie udało się zmienić rozmiaru obrazu, aby pasował.',
    'The image could not be read.' => 'Nie można odczytać obrazu.',
    'The image failed to upload.' => 'Nie udało się przesłać obrazu.',
    'The upload response had no media ID.' => 'Odpowiedź przesyłania nie zawierała ID multimediów.',
    'The upload response had no blob.' => 'Odpowiedź przesyłania nie zawierała bloba.',
    '[NOT ATTACHED] Unable to attach image. {reason}' => '[NIE DOŁĄCZONO] Nie można dołączyć obrazu. {reason}',

    // Recipient warnings
    '[SKIPPED] User "{name}" has no Pushover key.' => '[POMINIĘTO] Użytkownik "{name}" nie ma klucza Pushover.',

    // Errors & exceptions
    'Invalid element event: {class}' => 'Nieprawidłowe zdarzenie elementu: {class}',
    'Invalid notification ID: {id}' => 'Nieprawidłowy identyfikator powiadomienia: {id}',
    'Invalid email message mode.' => 'Nieprawidłowy tryb wiadomości e-mail.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Nie masz uprawnień do używania typu Dynamiczni odbiorcy.',
    'Invalid settings section: {section}' => 'Nieprawidłowa sekcja ustawień: {section}',
    'User not authorized to save this notification.' => 'Użytkownik nie ma uprawnień do zapisania tego powiadomienia.',
    'User not authorized to view this notification.' => 'Użytkownik nie ma uprawnień do wyświetlania tego powiadomienia.',
    'User not authorized to delete this notification.' => 'Użytkownik nie ma uprawnień do usunięcia tego powiadomienia.',
    'Notification not found' => 'Powiadomienie nie znalezione',
    'Element not found' => 'Nie znaleziono elementu',
    'You do not have permission to use the Dynamic Data type.' => 'Nie masz uprawnień do używania typu Dane dynamiczne.',
    '[NO DATA] The Dynamic Data snippet did not call the {tag} tag.' => '[BRAK DANYCH] Fragment Twig nie wywołał znacznika {tag}.',

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
    // Reworded outbound + dispatch log messages
    '[BAD CREDENTIALS] Missing app token. [Configure Pushover]({url}).' => '[NIEPRAWIDŁOWE DANE] Brak tokenu aplikacji. [Skonfiguruj Pushover]({url}).',
    '[BAD CREDENTIALS] Missing {missing}. [Configure Twilio]({url}).' => '[NIEPRAWIDŁOWE DANE] Brak {missing}. [Skonfiguruj Twilio]({url}).',
    '[BAD CREDENTIALS] No Discord webhook URL is configured.' => '[NIEPRAWIDŁOWE DANE] Nie skonfigurowano adresu URL webhooka Discord.',
    '[BAD CREDENTIALS] No MQTT broker host is configured.' => '[NIEPRAWIDŁOWE DANE] Nie skonfigurowano hosta brokera MQTT.',
    '[BAD CREDENTIALS] No Mastodon access token is configured.' => '[NIEPRAWIDŁOWE DANE] Nie skonfigurowano tokenu dostępu Mastodon.',
    '[BAD CREDENTIALS] No Mastodon instance URL is configured.' => '[NIEPRAWIDŁOWE DANE] Nie skonfigurowano adresu URL instancji Mastodon.',
    '[BAD CREDENTIALS] No Slack bot token is configured.' => '[NIEPRAWIDŁOWE DANE] Nie skonfigurowano tokenu bota Slack.',
    '[BAD CREDENTIALS] No Twilio phone number is configured.' => '[NIEPRAWIDŁOWE DANE] Nie skonfigurowano numeru telefonu Twilio.',
    '[BAD CREDENTIALS] The recipient is missing Bluesky credentials.' => '[NIEPRAWIDŁOWE DANE] Odbiorcy brakuje danych logowania Bluesky.',
    '[BAD CREDENTIALS] The recipient is missing Facebook credentials.' => '[NIEPRAWIDŁOWE DANE] Odbiorcy brakuje danych logowania Facebook.',
    '[BAD CREDENTIALS] The recipient is missing X (Twitter) credentials.' => '[NIEPRAWIDŁOWE DANE] Odbiorcy brakuje danych logowania X (Twitter).',
    '[BAD CREDENTIALS] Unable to post, recipient is missing credentials.' => '[NIEPRAWIDŁOWE DANE] Nie można opublikować; odbiorcy brakuje danych logowania.',
    '[EMPTY BODY] The Discord message body is empty.' => '[PUSTA TREŚĆ] Treść wiadomości Discord jest pusta.',
    '[EMPTY BODY] The Facebook post body is empty.' => '[PUSTA TREŚĆ] Treść posta na Facebooku jest pusta.',
    '[EMPTY BODY] The MQTT payload is empty.' => '[PUSTA TREŚĆ] Ładunek MQTT jest pusta.',
    '[EMPTY BODY] The Mastodon post body is empty.' => '[PUSTA TREŚĆ] Treść posta na Mastodonie jest pusta.',
    '[EMPTY BODY] The Slack message body is empty.' => '[PUSTA TREŚĆ] Treść wiadomości Slack jest pusta.',
    '[EMPTY BODY] The X (Twitter) post body is empty.' => '[PUSTA TREŚĆ] Treść posta na X (Twitter) jest pusta.',
    '[EMPTY BODY] The email message body was empty.' => '[PUSTA TREŚĆ] Treść wiadomości e-mail była pusta.',
    '[FEED ERROR] Could not fetch the feed: {message}' => '[BŁĄD KANAŁU] Nie można pobrać kanału: {message}',
    '[FEED ERROR] Could not parse the feed.' => '[BŁĄD KANAŁU] Nie można przeanalizować kanału.',
    '[FEED ERROR] Could not parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => '[BŁĄD KANAŁU] Nie można przeanalizować kanału. Wymagane są rozszerzenia PHP `simplexml` i `libxml`.',
    '[FEED ERROR] Initial feed scan failed: {message}' => '[BŁĄD KANAŁU] Wstępne skanowanie kanału nie powiodło się: {message}',
    '[INVALID NUMBER] The recipient phone number is invalid.' => '[NIEPRAWIDŁOWY NUMER] Numer telefonu odbiorcy jest nieprawidłowy.',
    '[INVALID TYPE] The flash message type is invalid.' => '[NIEPRAWIDŁOWY TYP] Typ wiadomości flash jest nieprawidłowy.',
    '[LINK PREVIEW SKIPPED] {reason}' => '[POMINIĘTO PODGLĄD LINKU] {reason}',
    '[MISSING IMAGE] Image Attachment field never called the {tag} tag.' => '[BRAK OBRAZU] Pole Załącznik obrazu nigdy nie wywołało tagu {tag}.',
    '[MISSING IMAGE] Image Attachment field was empty.' => '[BRAK OBRAZU] Pole Załącznik obrazu było puste.',
    '[MISSING IMAGE] The {tag} tag was called, but returned an invalid image.' => '[BRAK OBRAZU] Tag {tag} został wywołany, ale zwrócił nieprawidłowy obraz.',
    '[MISSING IMAGE] Unable to send Instagram post, the image needs a public URL.' => '[BRAK OBRAZU] Nie można wysłać posta na Instagramie; obraz wymaga publicznego adresu URL.',
    '[NO CALENDAR] No calendars are selected, this notification will never be triggered.' => '[BRAK KALENDARZA] Nie wybrano żadnych kalendarzy, to powiadomienie nigdy nie zostanie wyzwolone.',
    '[NO DIGITAL PRODUCT TYPE] No digital product types are selected, this notification will never be triggered.' => '[BRAK TYPU PRODUKTU CYFROWEGO] Nie wybrano żadnych typów produktów cyfrowych, to powiadomienie nigdy nie zostanie wyzwolone.',
    '[NO ENTRY TYPE] No sections or entry types are selected, this notification will never be triggered.' => '[BRAK TYPU WPISU] Nie wybrano żadnych sekcji ani typów wpisów, to powiadomienie nigdy nie zostanie wyzwolone.',
    '[NO PRODUCT TYPE] No product types are selected, this notification will never be triggered.' => '[BRAK TYPU PRODUKTU] Nie wybrano żadnych typów produktów, to powiadomienie nigdy nie zostanie wyzwolone.',
    '[NO USER GROUP] No user groups are selected, this notification will never be triggered.' => '[BRAK GRUPY UŻYTKOWNIKÓW] Nie wybrano żadnych grup użytkowników, to powiadomienie nigdy nie zostanie wyzwolone.',
    '[NO VOLUME] No volumes are selected, this notification will never be triggered.' => '[BRAK WOLUMINU] Nie wybrano żadnych woluminów, to powiadomienie nigdy nie zostanie wyzwolone.',
    '[NO MEDIA] No image was attached because the {tag} tag was never invoked in the Image Attachment field.' => '[BRAK MEDIÓW] Nie załączono żadnego obrazu, ponieważ tag {tag} nigdy nie został wywołany w polu Załącznik obrazu.',
    '[NO RECIPIENTS] The Dynamic Recipients snippet did not call setRecipients.' => '[BRAK ODBIORCÓW] Fragment dynamicznych odbiorców nie wywołał setRecipients.',
    '[NO RECIPIENTS] setRecipients was called with an empty value.' => '[BRAK ODBIORCÓW] Wywołano setRecipients z pustą wartością.',
    '[NO RECIPIENT] No MQTT topic was specified.' => '[BRAK ODBIORCY] Nie określono tematu MQTT.',
    '[NO RECIPIENT] No Slack channel ID was specified.' => '[BRAK ODBIORCY] Nie określono identyfikatora kanału Slack.',
    '[NO RECIPIENT] No ntfy topic was specified.' => '[BRAK ODBIORCY] Nie określono tematu ntfy.',
    '[NO RECIPIENT] No recipient user was specified for the announcement.' => '[BRAK ODBIORCY] Nie określono użytkownika odbiorcy ogłoszenia.',
    '[NO RECIPIENT] No recipient was specified for the email.' => '[BRAK ODBIORCY] Nie określono odbiorcy wiadomości e-mail.',
    '[NO RECIPIENT] The recipient has no Pushover user key.' => '[BRAK ODBIORCY] Odbiorca nie ma klucza użytkownika Pushover.',
    '[NO RECIPIENT] The recipient has no phone number.' => '[BRAK ODBIORCY] Odbiorca nie ma numeru telefonu.',
    '[REJECTED BY DISCORD] {error}' => '[ODRZUCONE PRZEZ DISCORD] {error}',
    '[REJECTED BY FACEBOOK] {error}' => '[ODRZUCONE PRZEZ FACEBOOK] {error}',
    '[REJECTED BY INSTAGRAM] {error}' => '[ODRZUCONE PRZEZ INSTAGRAM] {error}',
    '[REJECTED BY MASTODON] {error}' => '[ODRZUCONE PRZEZ MASTODON] {error}',
    '[REJECTED BY SLACK] {error}' => '[ODRZUCONE PRZEZ SLACK] {error}',
    '[REJECTED BY X (TWITTER)] {error}' => '[ODRZUCONE PRZEZ X (TWITTER)] {error}',
    '[SEND FAILED] Authentication failed for {handle}: {reason}' => '[WYSYŁANIE NIEUDANE] Uwierzytelnianie nie powiodło się dla {handle}: {reason}',
    '[SEND FAILED] Authentication failed: {reason}' => '[WYSYŁANIE NIEUDANE] Uwierzytelnianie nie powiodło się: {reason}',
    "[SEND FAILED] Could not send the email using Craft's native handling. Check your general email settings within Craft." => '[WYSYŁANIE NIEUDANE] Nie można wysłać wiadomości e-mail za pomocą natywnej obsługi Craft. Sprawdź ogólne ustawienia e-mail w Craft.',
    '[SEND FAILED] HTTP {status}: {reason}' => '[WYSYŁANIE NIEUDANE] HTTP {status}: {reason}',
    '[SEND FAILED] {error}' => '[WYSYŁANIE NIEUDANE] {error}',
    '[SEND FAILED] {reason}' => '[WYSYŁANIE NIEUDANE] {reason}',
    '[SKIPPED] Pushover user-key field is not configured on this notification.' => '[POMINIĘTO] Pole klucza użytkownika Pushover nie jest skonfigurowane w tym powiadomieniu.',
    '[SKIPPED] Recipient "{name}" cannot access the control panel.' => '[POMINIĘTO] Odbiorca "{name}" nie ma dostępu do panelu sterowania.',
    '[SKIPPED] Recipient "{name}" has no Bluesky credentials.' => '[POMINIĘTO] Odbiorca "{name}" nie ma danych logowania Bluesky.',
    '[SKIPPED] Recipient "{name}" has no Craft user account.' => '[POMINIĘTO] Odbiorca "{name}" nie ma konta użytkownika Craft.',
    '[SKIPPED] Recipient "{name}" has no Discord webhook URL.' => '[POMINIĘTO] Odbiorca "{name}" nie ma adresu URL webhooka Discord.',
    '[SKIPPED] Recipient "{name}" has no Facebook credentials.' => '[POMINIĘTO] Odbiorca "{name}" nie ma danych logowania Facebook.',
    '[SKIPPED] Recipient "{name}" has no Instagram credentials.' => '[POMINIĘTO] Odbiorca "{name}" nie ma danych logowania Instagram.',
    '[SKIPPED] Recipient "{name}" has no MQTT topic.' => '[POMINIĘTO] Odbiorca "{name}" nie ma tematu MQTT.',
    '[SKIPPED] Recipient "{name}" has no Mastodon credentials.' => '[POMINIĘTO] Odbiorca "{name}" nie ma danych logowania Mastodon.',
    '[SKIPPED] Recipient "{name}" has no Slack bot token.' => '[POMINIĘTO] Odbiorca "{name}" nie ma tokenu bota Slack.',
    '[SKIPPED] Recipient "{name}" has no Slack channel ID.' => '[POMINIĘTO] Odbiorca "{name}" nie ma identyfikatora kanału Slack.',
    '[SKIPPED] Recipient "{name}" has no X (Twitter) credentials.' => '[POMINIĘTO] Odbiorca "{name}" nie ma danych logowania X (Twitter).',
    '[SKIPPED] Recipient "{name}" has no email address.' => '[POMINIĘTO] Odbiorca "{name}" nie ma adresu e-mail.',
    '[SKIPPED] Recipient "{name}" has no ntfy topic.' => '[POMINIĘTO] Odbiorca "{name}" nie ma tematu ntfy.',
    '[SKIPPED] Recipient "{name}" has no phone number.' => '[POMINIĘTO] Odbiorca "{name}" nie ma numeru telefonu.',
    '[SKIPPED] The configured {kind} no longer exists in the plugin settings (uid: {uid}).' => '[POMINIĘTO] Skonfigurowany {kind} już nie istnieje w ustawieniach wtyczki (uid: {uid}).',
    '[SKIPPED] Unrecognized recipient "{value}".' => '[POMINIĘTO] Nierozpoznany odbiorca "{value}".',
    '[SKIPPED] Unrecognized recipient of type "{type}".' => '[POMINIĘTO] Nierozpoznany typ odbiorcy "{type}".',
    '[TOO LONG] The Discord message body exceeds the 2000-character limit.' => '[ZA DŁUGI] Treść wiadomości Discord przekracza limit 2000 znaków.',
    '[TRUNCATED] Body exceeded {max} characters.' => '[SKRÓCONO] Treść przekroczyła {max} znaków.',
    '[TRUNCATED] Caption exceeded {max} characters.' => '[SKRÓCONO] Podpis przekroczył {max} znaków.',
];
