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
    'Notifications' => 'Уведомления',
    'Notification' => 'Уведомление',
    'All notifications' => 'Все уведомления',
    'Notification Log' => 'Журнал уведомлений',
    'Logs' => 'Журналы',
    'View Notifications' => 'Просмотр уведомлений',
    'Add a New Notification' => 'Добавить новое уведомление',
    'notification' => 'уведомление',

    // Permissions
    'View notifications' => 'Просматривать уведомления',
    'Save notifications' => 'Сохранять уведомления',
    'Use the Dynamic Recipients type' => 'Использовать тип «Динамические получатели»',
    'Use the Dynamic Data type' => 'Использовать тип «Динамические данные»',
    'Test notifications' => 'Тестировать уведомления',
    'Send manual notifications' => 'Отправлять уведомления вручную',
    'Delete notifications' => 'Удалять уведомления',
    'View notification log' => 'Просматривать журнал уведомлений',
    'Delete notification log' => 'Удалять журнал уведомлений',

    // ========================================================
    // NOTIFICATION EDITOR
    // ========================================================

    // Editor: tabs
    'Meta' => 'Мета',
    'Event' => 'Событие',
    'Message' => 'Сообщение',
    'Recipients' => 'Получатели',

    // Event tab: type selector
    'Event Type' => 'Тип события',
    'What type of event will activate the notification?' => 'Какой тип события активирует уведомление?',
    'Which specific event will activate the notification?' => 'Какое именно событие активирует уведомление?',

    // Event tab: event types
    'Assets Event' => 'Событие ресурса',
    'Commerce Orders Event' => 'Событие заказа Commerce',
    'Commerce Products Event' => 'Событие товара Commerce',
    'Digital Products Event' => 'Событие Digital Products',
    'Digital Product Licenses Event' => 'Событие лицензии Digital Products',
    'Solspace Calendar Event' => 'Событие Solspace Calendar',
    'Entries Event' => 'Событие записей',
    'Users Event' => 'Событие пользователя',
    'Ungrouped Users' => 'Пользователи без группы',

    // Event tab: Feed
    'Feed URL' => 'URL канала',
    'The URL of the RSS, Atom, or JSON feed to watch.' => 'URL отслеживаемого RSS-, Atom- или JSON-канала.',

    // Event tab: field conditions
    'Field Conditions' => 'Условия поля',
    'Send the message only when the saved element matches the following conditions.' => 'Отправлять сообщение только когда сохранённый элемент соответствует следующим условиям.',
    'has changed' => 'изменилось',

    // Event tab: element filters (panel chrome + common output)
    '#{elementType} Event Filters' => 'Фильтры событий для #{elementType}',
    'No filters match this event.' => 'Ни один фильтр не соответствует этому событию.',
    'Determine whether each message should be sent based on specified conditions.' => 'Определите на основе указанных условий, следует ли отправлять каждое сообщение.',
    'Unnamed filter' => 'Безымянный фильтр',
    'Must be TRUE to send message' => 'Должно быть TRUE для отправки сообщения',
    'Must be FALSE to send message' => 'Должно быть FALSE для отправки сообщения',
    'No effect' => 'Без эффекта',

    // Event tab: element filter rules
    'Element is being saved for the first time' => 'Элемент сохраняется впервые',
    'Must be a new entry' => 'Должна быть новая запись',
    'Must be an existing entry' => 'Должна быть существующая запись',
    'Can be existing or new' => 'Может быть существующим или новым',
    'Element is new' => 'Элемент новый',
    'New elements only' => 'Только новые элементы',
    'Existing elements only' => 'Только существующие элементы',
    'Element is enabled' => 'Элемент включён',
    'Must be enabled' => 'Должен быть включён',
    'Must be disabled' => 'Должен быть отключён',
    'Can be enabled or disabled' => 'Может быть включён или отключён',
    'Element is a draft' => 'Элемент — черновик',
    'Must be a draft' => 'Должен быть черновиком',
    'Must not be a draft' => 'Не должен быть черновиком',
    'Can be a draft or non-draft' => 'Может быть черновиком или нет',
    'Element is a provisional draft' => 'Элемент — предварительный черновик',
    'Must be a provisional draft' => 'Должен быть предварительным черновиком',
    'Must not be a provisional draft' => 'Не должен быть предварительным черновиком',
    'Can be a provisional draft or non-provisional' => 'Может быть предварительным черновиком или нет',
    'Element is a revision' => 'Элемент — версия',
    'Must be a revision' => 'Должен быть версией',
    'Must not be a revision' => 'Не должен быть версией',
    'Can be a revision or non-revision' => 'Может быть версией или нет',
    'Element is being duplicated' => 'Элемент дублируется',
    'Must be duplicating the element' => 'Должен дублировать элемент',
    'Must not be duplicating the element' => 'Не должен дублировать элемент',
    'Element is being propagated' => 'Элемент распространяется',
    'Element must be propagating' => 'Элемент должен распространяться',
    'Element must not be propagating' => 'Элемент не должен распространяться',
    'Element is being bulk-resaved' => 'Элемент массово пересохраняется',
    'Must be bulk-resaving the element' => 'Должен массово пересохранять элемент',
    'Must not be bulk-resaving the element' => 'Не должен массово пересохранять элемент',

    // Event tab: date trigger
    'On' => 'В день',
    'days before' => 'дней до',
    'days after' => 'дней после',
    'Relevant Date' => 'Соответствующая дата',
    'Send the notification relative to a chosen date.' => 'Отправляйте уведомление относительно выбранной даты.',

    // Event tab: recurring schedule
    'Every' => 'Каждые',
    'on' => 'в',
    'on day' => 'в день',
    'at' => 'в',
    'Starting on' => 'Начиная с',
    'Day' => 'День',
    'Date' => 'Дата',
    'Time' => 'Время',
    'day(s)' => 'дн.',
    'week(s)' => 'нед.',
    'month(s)' => 'мес.',
    'year(s)' => 'г.',
    'day' => 'день',
    'days' => 'дней',
    'week' => 'неделя',
    'weeks' => 'недель',
    'month' => 'месяц',
    'months' => 'месяцев',
    'year' => 'год',
    'years' => 'лет',
    'Manual only' => 'Только вручную',
    'Scheduled sending' => 'Отправка по расписанию',
    'Generate report on a recurring schedule' => 'Создавать отчёт по повторяющемуся расписанию',
    'Generate report on demand' => 'Создавать отчёт по требованию',
    'Send on a Recurring Schedule' => 'Отправлять по повторяющемуся расписанию',
    'Configure Recurring Schedule' => 'Настроить повторяющееся расписание',
    'System timezone set to {timezone}' => 'Часовой пояс системы: {timezone}',
    'Notifications will be sent on the following schedule...' => 'Уведомления будут отправляться по следующему расписанию...',
    '... and every {cadence} after that.' => '... и далее каждые {cadence}.',
    'On what recurring schedule should the notification be sent?' => 'По какому повторяющемуся расписанию отправлять уведомление?',
    'Whether the message should be sent on a schedule, or only triggered manually.' => 'Отправлять ли сообщение по расписанию или запускать только вручную.',
    'The message can always be sent using the "Send system snapshot" button above.' => 'Сообщение всегда можно отправить кнопкой «Отправить снимок системы» выше.',
    'The message can always be sent using the "Send data report" button above.' => 'Сообщение всегда можно отправить кнопкой «Отправить отчёт о данных» выше.',

    // Event tab: Dynamic Data snippet field
    'Twig Snippet to Determine Data' => 'Сниппет Twig для определения данных',
    'Enter a custom Twig snippet to [determine which data will be included]({url}).' => 'Введите пользовательский фрагмент Twig, чтобы [определить, какие данные будут включены]({url}).',
    'The snippet **must** include a `{% setData %}` tag.' => 'Фрагмент **должен** содержать тег `{% setData %}`.',
    'You do not have permission to edit dynamic data.' => 'У вас нет прав на редактирование динамических данных.',

    // Event tab: manual trigger
    'Trigger Label' => 'Метка триггера',
    'An element action label (helps to differentiate multiple triggers).' => 'Метка действия элемента (помогает различать несколько триггеров).',
    'Send Notification' => 'Отправить уведомление',

    // Message tab: type selector
    'Message Type' => 'Тип сообщения',
    'What type of message will be sent?' => 'Какой тип сообщения будет отправлен?',
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are supported.' => '[Шаблоны]({templatingUrl}) и [специальные переменные]({variablesUrl}) поддерживаются.',

    // Details sidebar: queue
    'Use Queue' => 'Использовать очередь',
    'Immediate' => 'Немедленно',
    'Queue' => 'Очередь',
    'jobs queue' => 'очередь задач',
    'Whether the message will be sent immediately, or added to the {link}.' => 'Будет ли сообщение отправлено немедленно или добавлено в {link}.',
    'Flash messages never use the queue.' => 'Flash-сообщения никогда не используют очередь.',
    'Announcements always use the queue.' => 'Объявления всегда используют очередь.',

    // Message tab: Email
    "User's Email Address Field" => 'Поле электронной почты пользователя',
    'Select which User field contains the recipient\'s email address.' => 'Выберите поле пользователя, содержащее адрес электронной почты получателя.',
    'Email Subject' => 'Тема письма',
    'Subject line of the email.' => 'Тема письма.',
    'Dynamic Subject Line' => 'Динамическая тема',
    'Email Body' => 'Тело письма',
    'Body of the email. Supports HTML.' => 'Текст письма. Поддерживает HTML.',

    // Message tab: rich-text (Trix) toolbar
    'Rich Text' => 'Форматированный текст',
    'Bold' => 'Полужирный',
    'Italic' => 'Курсив',
    'Underline' => 'Подчёркнутый',
    'Strikethrough' => 'Зачёркнутый',
    'Bullets' => 'Маркеры',
    'Numbers' => 'Нумерация',
    'Heading' => 'Заголовок',
    'Code' => 'Код',
    'Undo' => 'Отменить',
    'Redo' => 'Повторить',

    // Message tab: SMS
    "User's Phone Number Field" => 'Поле телефона пользователя',
    'Select which User field contains the recipient\'s phone number.' => 'Выберите поле пользователя, содержащее номер телефона получателя.',
    'SMS Message Body' => 'Тело SMS-сообщения',
    'Body of the SMS (text message). Plain text only.' => 'Текст SMS (текстового сообщения). Только обычный текст.',

    // Message tab: Announcement
    'Announcement Title' => 'Заголовок объявления',
    'Heading of the announcement.' => 'Заголовок анонса.',
    'Dynamic Announcement Title' => 'Динамический заголовок анонса',
    'Announcement Message' => 'Текст объявления',
    'Body of the announcement. Supports Markdown.' => 'Текст анонса. Поддерживает Markdown.',

    // Message tab: Flash
    'Flash Message Type' => 'Тип flash-сообщения',
    'Which type of flash message should appear?' => 'Какой тип flash-сообщения должен появиться?',
    'Flash Message Title' => 'Заголовок flash-сообщения',
    'Heading of the flash message.' => 'Заголовок flash-сообщения.',
    'Dynamic Flash Message Title' => 'Динамический заголовок Flash-сообщения',
    'Flash Message Details' => 'Подробности flash-сообщения',
    'Optionally include details below the heading. Supports Markdown and HTML.' => 'При необходимости добавьте детали под заголовком. Поддерживает Markdown и HTML.',

    // Message tab: Pushover
    "Field containing each user's Pushover key" => 'Поле ключа Pushover пользователя',
    'Select which User field contains the recipient\'s Pushover user key.' => 'Выберите поле пользователя, содержащее ключ Pushover получателя.',
    'Pushover Title' => 'Заголовок Pushover',
    'Optionally include a heading above the body.' => 'При необходимости добавьте заголовок над текстом.',
    'Dynamic Pushover Title' => 'Динамический заголовок Pushover',
    'Pushover Body' => 'Текст Pushover',
    'Body of the Pushover notification. Plain text only.' => 'Текст Pushover-уведомления. Только обычный текст.',

    // Message tab: ntfy
    'Priority' => 'Приоритет',
    'Priority level of the ntfy message.' => 'Уровень приоритета ntfy-сообщения.',
    'Tags' => 'Метки',
    'Optionally include comma-separated [emoji shortcodes](https://docs.ntfy.sh/emojis/).' => 'При необходимости укажите [emoji-коды](https://docs.ntfy.sh/emojis/) через запятую.',
    'ntfy Title' => 'Заголовок ntfy',
    'Dynamic ntfy Title' => 'Динамический заголовок ntfy',
    'ntfy Body' => 'Текст ntfy',
    'Body of the ntfy notification.' => 'Текст ntfy-уведомления.',
    'ntfy Link URL' => 'URL ссылки ntfy',
    'Optionally open a URL when the notification is clicked.' => 'При необходимости открывать URL при клике по уведомлению.',
    'Enable Markdown' => 'Включить Markdown',
    'Whether to parse the body as Markdown in supported clients.' => 'Должен ли текст обрабатываться как Markdown в поддерживающих клиентах.',
    'Regular text only' => 'Только обычный текст',
    'Markdown enabled' => 'Markdown включён',

    // Message tab: Slack
    'Slack Message Body' => 'Тело сообщения Slack',
    'Supports standard [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) syntax. Optionally supports HTML _(see below)_.' => 'Поддерживает стандартный синтаксис [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting). Опционально поддерживает HTML _(см. ниже)_.',
    'Render Message Body as HTML' => 'Отображать содержимое сообщения как HTML',
    'Whether to only parse as [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), or additionally parse it as HTML.' => 'Анализировать только как [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) или также как HTML.',
    'Render Link Previews' => 'Показывать превью ссылок',
    'Whether Slack should unfurl link previews for URLs in the message body.' => 'Должен ли Slack показывать превью ссылок для URL-адресов в тексте сообщения.',
    'Don\'t unfurl' => 'Не разворачивать',
    'Expand link previews' => 'Развернуть превью ссылок',
    'Bot Name' => 'Имя пользователя',
    'Optionally override the app\'s display name.' => 'При необходимости переопределите отображаемое имя приложения.',
    'Dynamic Bot Name' => 'Динамическое имя бота',
    'Bot Icon URL' => 'URL значка',
    'Optionally override the app\'s icon with a URL.' => 'При необходимости переопределите иконку приложения через URL.',
    'Bot Emoji' => 'Эмодзи значка',
    'Optionally override the app\'s icon with an emoji. Used only when Bot Icon URL is empty.' => 'При необходимости переопределите иконку приложения через эмодзи. Используется, только если Bot Icon URL пуст.',

    // Message tab: Discord
    'Discord Message Body' => 'Тело сообщения Discord',
    'Supports standard Markdown, and optionally HTML _(see below)_. Max 2000 characters.' => 'Поддерживает стандартный Markdown и, опционально, HTML _(см. ниже)_. Не более 2000 символов.',
    'Whether to only parse as Markdown, or additionally parse it as HTML.' => 'Анализировать только как Markdown или также как HTML.',
    'Markdown only' => 'только Markdown',
    'Markdown + HTML' => 'Markdown + HTML',
    'Whether Discord should unfurl link previews for URLs in the message body.' => 'Должен ли Discord показывать превью ссылок для URL-адресов в тексте сообщения.',
    'Webhook Username' => 'Имя пользователя Webhook',
    'Optionally override the webhook\'s display name.' => 'При необходимости переопределите отображаемое имя Webhook.',
    'Dynamic Username' => 'Динамическое имя пользователя',
    'Webhook Avatar URL' => 'URL аватара Webhook',
    'Optionally override the webhook\'s avatar with a URL.' => 'При необходимости переопределите аватар Webhook через URL.',

    // Message tab: Facebook
    'Message Body' => 'Тело сообщения',
    'The text of your Facebook post.' => 'Текст вашего поста Facebook.',
    'Preview Card URL' => 'URL карточки-превью',
    'Optionally add a link to generate a preview card.' => 'При необходимости добавьте ссылку для создания карточки-превью.',

    // Message tab: Instagram
    'Caption' => 'Подпись',
    'Image Attachment' => 'Вложение изображения',
    'Optional caption, max 2200 characters.' => 'Необязательная подпись, максимум 2200 символов.',

    // Message tab: X (Twitter)
    'Plain text, max 280 characters.' => 'Обычный текст, максимум 280 символов.',

    // Message tab: Media
    'Attach an image by calling `{% setMedia %}` in a [custom Twig snippet]({url}).' => 'Прикрепите изображение, вызвав `{% setMedia %}` в [пользовательском фрагменте Twig]({url}).',

    // Message tab: Bluesky
    'Post Body' => 'Текст поста',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => 'Обычный текст, максимум 300 символов. URL-адреса и упоминания вида `@handle.tld` автоматически становятся ссылками.',
    'Generate Link Preview' => 'Создать предпросмотр ссылки',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => 'Автоматически создавать карточку-превью, когда в теле поста есть URL.',
    'No card' => 'Без карточки',
    'Generate preview card' => 'Создать карточку предпросмотра',

    // Message tab: Mastodon
    'Plain text, max 500 characters. URLs will unfurl automatically.' => 'Обычный текст, не более 500 символов. URL-адреса разворачиваются автоматически.',
    'Visibility' => 'Видимость',
    'Who will be able to see this post?' => 'Кто сможет увидеть этот пост?',

    // Message tab: LinkedIn
    'LinkedIn' => 'LinkedIn',
    'The text of your LinkedIn post.' => 'Текст вашего поста в LinkedIn.',

    // Message tab: MQTT
    'Payload' => 'Содержимое',
    'The JSON or plain text message published to the MQTT topic.' => 'Сообщение в формате JSON или в виде обычного текста, публикуемое в теме MQTT.',
    'Quality of Service' => 'Качество обслуживания',
    'Delivery guarantee for this message.' => 'Гарантия доставки этого сообщения.',
    'Retain' => 'Сохранять',
    'Whether the broker keeps this as the topic\'s last message for future subscribers.' => 'Сохраняет ли брокер это сообщение как последнее в теме и доставляет ли его будущим подписчикам.',
    'Don\'t retain' => 'Не сохранять',

    // Recipients tab: type selector & user/group pickers
    'Recipients Type' => 'Тип получателей',
    'Who will receive this message?' => 'Кто получит это сообщение?',
    'Add a message recipient' => 'Добавить получателя',
    'Select User(s)' => 'Выберите пользователя(ей)',
    'Which users will receive the message?' => 'Какие пользователи получат сообщение?',
    'Which user groups will receive the message?' => 'Какие группы пользователей получат сообщение?',

    // Recipients tab: channel pickers (ntfy, Slack, Discord, Bluesky, Mastodon, MQTT)
    'Select ntfy topic(s)' => 'Выберите тему(ы) ntfy',
    'Which topics should receive this message?' => 'Какие темы должны получить это сообщение?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'Темы ntfy не настроены. Добавьте в [Настройки → ntfy]({url}).',
    'No ntfy topics configured. Topics can only be added in an environment that allows administrative changes.' => 'Темы ntfy не настроены. Темы можно добавлять только в среде, где разрешены административные изменения.',
    'Select Slack channel(s)' => 'Выберите канал(ы) Slack',
    'Which channels should receive this message?' => 'Какие каналы должны получить это сообщение?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Каналы Slack не настроены. Добавьте в [Настройки → Slack]({url}).',
    'No Slack channels configured. Channels can only be added in an environment that allows administrative changes.' => 'Каналы Slack не настроены. Каналы можно добавлять только в среде, где разрешены административные изменения.',
    'Select Discord channel(s)' => 'Выберите канал(ы) Discord',
    'No Discord channels configured. Add one in [Settings → Discord]({url}).' => 'Каналы Discord не настроены. Добавьте в [Настройки → Discord]({url}).',
    'No Discord channels configured. Channels can only be added in an environment that allows administrative changes.' => 'Каналы Discord не настроены. Каналы можно добавлять только в среде, где разрешены административные изменения.',
    'Select Facebook page(s)' => 'Выберите страницу(ы) Facebook',
    'Which pages should post this message?' => 'Какие страницы должны опубликовать это сообщение?',
    'No Facebook pages configured. Add one in [Settings → Facebook]({url}).' => 'Страницы Facebook не настроены. Добавьте в [Настройки → Facebook]({url}).',
    'No Facebook pages configured. Pages can only be added in an environment that allows administrative changes.' => 'Страницы Facebook не настроены. Страницы можно добавлять только в среде, где разрешены административные изменения.',
    'Select Instagram account(s)' => 'Выберите аккаунт(ы) Instagram',
    'No Instagram accounts configured. Add one in [Settings → Instagram]({url}).' => 'Аккаунты Instagram не настроены. Добавьте в [Настройки → Instagram]({url}).',
    'No Instagram accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Аккаунты Instagram не настроены. Аккаунты можно добавлять только в среде, где разрешены административные изменения.',
    'Select X (Twitter) account(s)' => 'Выберите аккаунт(ы) X (Twitter)',
    'No X (Twitter) accounts configured. Add one in [Settings → X (Twitter)]({url}).' => 'Аккаунты X (Twitter) не настроены. Добавьте в [Настройки → X (Twitter)]({url}).',
    'No X (Twitter) accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Аккаунты X (Twitter) не настроены. Аккаунты можно добавлять только в среде, где разрешены административные изменения.',
    'Select Bluesky account(s)' => 'Выберите аккаунт(ы) Bluesky',
    'Which accounts should post this message?' => 'Какие аккаунты должны опубликовать это сообщение?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Аккаунты Bluesky не настроены. Добавьте в [Настройки → Bluesky]({url}).',
    'No Bluesky accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Аккаунты Bluesky не настроены. Аккаунты можно добавлять только в среде, где разрешены административные изменения.',
    'Select Mastodon account(s)' => 'Выберите аккаунт(ы) Mastodon',
    'No Mastodon accounts configured. Add one in [Settings → Mastodon]({url}).' => 'Аккаунты Mastodon не настроены. Добавьте в [Настройки → Mastodon]({url}).',
    'No Mastodon accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Аккаунты Mastodon не настроены. Аккаунты можно добавлять только в среде, где разрешены административные изменения.',
    'Select MQTT topic(s)' => 'Выберите тему(ы) MQTT',
    'No MQTT topics configured. Add one in [Settings → MQTT]({url}).' => 'Темы MQTT не настроены. Добавьте тему в [Настройки → MQTT]({url}).',
    'No MQTT topics configured. Topics can only be added in an environment that allows administrative changes.' => 'Темы MQTT не настроены. Темы можно добавлять только в среде, где разрешены административные изменения.',
    'Not a valid topic. Must not be empty or contain the `+` or `#` wildcards.' => 'Недопустимая тема. Не должна быть пустой и не должна содержать подстановочные знаки `+` или `#`.',

    // Recipients tab: LinkedIn picker
    'Select LinkedIn account(s)' => 'Выберите аккаунт(ы) LinkedIn',
    'Which page or member should post this message?' => 'Какая страница или участник должны опубликовать это сообщение?',
    'No LinkedIn accounts connected. Connect one in [Settings → LinkedIn]({url}).' => 'Аккаунты LinkedIn не подключены. Подключите в [Настройки → LinkedIn]({url}).',
    'No LinkedIn accounts connected. Accounts can only be connected in an environment that allows administrative changes.' => 'Аккаунты LinkedIn не подключены. Аккаунты можно подключать только в среде, где разрешены административные изменения.',

    // Recipients tab: dynamic recipients snippet
    'Twig Snippet to Determine Recipients' => 'Фрагмент Twig для определения получателей',
    'Enter a custom Twig snippet to [determine who will receive the message]({url}).' => 'Введите пользовательский фрагмент Twig, чтобы [определить, кто получит сообщение]({url}).',
    'The snippet **must** include a `{% setRecipients %}` tag.' => 'Фрагмент **должен** содержать тег `{% setRecipients %}`.',

    // ========================================================
    // SETTINGS
    // ========================================================

    // Settings: nav & page chrome
    'Notifier Settings' => 'Настройки Notifier',
    'General' => 'Общие',
    'Twilio' => 'Twilio',
    'Pushover' => 'Pushover',
    'ntfy' => 'ntfy',
    'Slack' => 'Slack',
    'Discord' => 'Discord',
    'Bluesky' => 'Bluesky',
    'Mastodon' => 'Mastodon',
    'MQTT' => 'MQTT',

    // Settings: nav group headings
    'Push Notifications' => 'Push-уведомления',
    'Chat Platforms' => 'Чат-платформы',
    'Social Media' => 'Социальные сети',
    'Internet of Things' => 'Интернет вещей',
    'Expand {heading}' => 'Развернуть {heading}',

    // Settings: shared intro lines
    'Consult the [{name} setup guide]({url}) for complete instructions.' => 'Полные инструкции см. в [руководстве по настройке {name}]({url}).',
    'Sensitive values can be stored in your `.env` file and referenced here.' => 'Конфиденциальные значения можно хранить в вашем файле `.env` и ссылаться на них здесь.',

    // Settings: Notification order
    'Notification Order' => 'Порядок уведомлений',
    'Notifications can be dragged into any order on the index page. Choose where new notifications land in that order.' => 'Уведомления можно перетаскивать, задавая произвольный порядок на странице списка. Выберите, куда добавляются новые уведомления в этом порядке.',
    'Default Placement' => 'Размещение по умолчанию',
    'Where new notifications are added to the list.' => 'Куда добавляются новые уведомления в списке.',
    'Before other notifications' => 'Перед другими уведомлениями',
    'After other notifications' => 'После других уведомлений',

    // Settings: Logging
    'Logging' => 'Журналирование',
    "Notifier keeps a running log of every message it sends. You usually won't need to change this, but you can limit how many log entries are kept in the database." => 'Notifier ведёт постоянный журнал отправленных сообщений. Обычно это не нужно, но вы можете ограничить количество событий, записываемых в базу данных.',
    'Enable Logging' => 'Включить журналирование',
    'When disabled, Notifier will not write anything to the notification log.' => 'Когда отключено, Notifier ничего не записывает в журнал уведомлений.',
    'Number of days to retain log events' => 'Число дней хранения событий журнала',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Хранить события журнала не более этого числа дней. Пусто означает без ограничения.',
    'Number of log events to retain' => 'Число сохраняемых событий журнала',
    'At most, keep this many log events. Leave blank for no limit.' => 'Хранить не более этого числа событий. Пусто означает без ограничения.',

    // Settings: Scheduled sending
    'Scheduled Sending' => 'Запланированная отправка',
    'A shared secret that authenticates scheduled runs triggered over the web. You only need this if you trigger the schedule from the web endpoint.' => 'Общий секрет для аутентификации веб-запросов запланированного запуска. Требуется только при запуске расписания через веб-конечную точку.',
    'Scheduled-Run Token' => 'Токен запланированного запуска',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => 'Отправляется с каждым запросом как заголовок X-Notifier-Token или параметр token в теле запроса.',

    // Settings: Twilio
    'Send SMS text messages through [Twilio](https://www.twilio.com).' => 'Отправляйте SMS-сообщения через [Twilio](https://www.twilio.com).',
    'Twilio Account SID' => 'Twilio Account SID',
    'Twilio Auth Token' => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)' => 'Номер телефона Twilio (отправляет каждое SMS-сообщение)',
    'SMS Testing' => 'Тестирование SMS',
    'Optional. When set, every SMS is sent to this number instead of the actual recipient.' => 'Необязательно. Если установлено, каждое отправленное SMS будет направлено на этот номер вместо реального получателя.',
    'Test phone number' => 'Тестовый номер телефона',

    // Settings: Pushover
    'Send push notifications through [Pushover](https://pushover.net).' => 'Отправляйте push-уведомления через [Pushover](https://pushover.net).',
    'Application API Token' => 'Токен API приложения',
    'The 30-character app token from your Pushover application.' => '30-символьный токен приложения из вашего приложения Pushover.',

    // Settings: ntfy
    'Send push notifications through [ntfy](https://ntfy.sh).' => 'Отправляйте push-уведомления через [ntfy](https://ntfy.sh).',
    'Server URL' => 'URL сервера',
    'Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`.' => 'Необязательно, укажите свою ntfy-инстанцию (если применимо). По умолчанию `https://ntfy.sh`.',
    'Access token' => 'Токен доступа',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Необязательно, требуется для защищённых тем или self-hosted инстанций с авторизацией.',
    'ntfy Topics' => 'Темы ntfy',
    'Add the ntfy topics you want to send to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Добавьте темы ntfy, в которые вы хотите отправлять сообщения. Каждая тема становится доступна как получатель на вкладке **Получатели** при настройке уведомления.',
    'Topics' => 'Темы',
    "Click any row's **Test** button to send a quick test message to that topic." => 'Нажмите кнопку **Тест** в любой строке, чтобы отправить быстрое тестовое сообщение в эту тему.',
    'Label' => 'Метка',
    'Topic' => 'Тема',
    'Add a topic' => 'Добавить тему',

    // Settings: Slack
    'Post messages to your Slack channels.' => 'Отправляйте сообщения в свои каналы Slack.',
    'Channels' => 'Каналы',
    "Click any row's **Test** button to send a quick test message to that channel." => 'Нажмите кнопку **Тест** в любой строке, чтобы отправить быстрое тестовое сообщение в этот канал.',
    'Bot Token' => 'Токен бота',
    'Channel ID' => 'ID канала',
    'Add a channel' => 'Добавить канал',
    'Not a valid Bot Token. Must start with `xoxb-`.' => 'Недействительный токен бота. Должен начинаться с `xoxb-`.',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => 'Недействительный ID канала. Должен выглядеть как `C01234ABCD`.',

    // Settings: Discord
    'Post messages to your Discord channels.' => 'Отправляйте сообщения в свои каналы Discord.',
    'Webhook URL' => 'URL Webhook',
    'Not a valid Webhook URL. Must start with `https://discord.com/api/webhooks/`.' => 'Недействительный URL Webhook. Должен начинаться с `https://discord.com/api/webhooks/`.',

    // Settings: Facebook
    'Facebook' => 'Facebook',
    'Publish posts to your [Facebook](https://facebook.com) pages.' => 'Публикуйте посты на своих страницах [Facebook](https://facebook.com).',
    'Pages' => 'Страницы',
    'Page ID' => 'Page ID',
    'Page Access Token' => 'Page Access Token',
    'Add a page' => 'Добавить страницу',
    "Click any row's **Test** button to verify that page's credentials. No posts are made." => 'Нажмите кнопку **Тест** в любой строке, чтобы проверить учётные данные этой страницы. Посты не публикуются.',

    // Settings: Instagram
    'Instagram' => 'Instagram',
    'Publish posts to your [Instagram](https://instagram.com) Business accounts.' => 'Публикуйте посты в своих бизнес-аккаунтах [Instagram](https://instagram.com).',
    "Click any row's **Test** button to resolve the linked Instagram account. No posts are made." => 'Нажмите кнопку **Тест** в любой строке, чтобы определить связанный аккаунт Instagram. Посты не публикуются.',

    // Settings: X (Twitter)
    'X (Twitter)' => 'X (Twitter)',
    'Publish posts to your [X (Twitter)](https://x.com) accounts.' => 'Публикуйте посты в своих аккаунтах [X (Twitter)](https://x.com).',
    'Consumer Key' => 'Consumer Key',
    'Consumer Key Secret' => 'Consumer Key Secret',
    'Access Token Secret' => 'Access Token Secret',

    // Settings: Bluesky
    'Publish posts to your [Bluesky](https://bsky.app) accounts.' => 'Публикуйте посты в своих аккаунтах [Bluesky](https://bsky.app).',
    'PDS URL' => 'URL PDS',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'По умолчанию https://bsky.social. Укажите свой PDS, если ваша установка федерирована.',
    'Bluesky Accounts' => 'Аккаунты Bluesky',
    'Add the Bluesky accounts you want to post from. Each account becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Добавьте аккаунты Bluesky, от имени которых вы хотите публиковать. Каждый аккаунт становится доступен как получатель на вкладке **Получатели** при настройке уведомления.',
    'Accounts' => 'Аккаунты',
    "Click any row's **Test** button to confirm the account authenticates." => 'Нажмите кнопку **Тест** в любой строке, чтобы убедиться, что аккаунт проходит аутентификацию.',
    'Handle' => 'Хэндл',
    'App password' => 'Пароль приложения',
    'Add an account' => 'Добавить аккаунт',

    // Settings: Mastodon
    'Publish posts to your [Mastodon](https://joinmastodon.org) accounts.' => 'Публикуйте посты в своих аккаунтах [Mastodon](https://joinmastodon.org).',
    'Click any row\'s **Test** button to verify that account\'s credentials. No posts are made.' => 'Нажмите кнопку **Тест** в любой строке, чтобы проверить учётные данные этого аккаунта. Посты не публикуются.',
    'Instance URL' => 'URL инстанции',
    'Access Token' => 'Токен доступа',

    // Settings: LinkedIn
    'Publish posts to your [LinkedIn](https://linkedin.com) profile.' => 'Публикуйте посты в своём профиле [LinkedIn](https://linkedin.com).',
    'The Client ID of your LinkedIn app.' => 'Идентификатор клиента вашего приложения LinkedIn.',
    'Client Secret' => 'Секрет клиента',
    'The Primary Client Secret of your LinkedIn app.' => 'Основной секрет клиента вашего приложения LinkedIn.',
    'Enable organization posting' => 'Включить публикацию от имени организации',
    'Copy this redirect URL' => 'Скопируйте этот URL перенаправления',
    'When configuring the LinkedIn app, <strong>copy this URL</strong> to use as an "Authorized redirect URL".' => 'При настройке приложения LinkedIn <strong>скопируйте этот URL</strong>, чтобы использовать его как "Authorized redirect URL".',
    'Also request access to post as organization pages you administer. Requires Community Management API approval from LinkedIn.' => 'Также запросите доступ для публикации от имени администрируемых вами страниц организаций. Требуется одобрение Community Management API от LinkedIn.',
    'Connections' => 'Подключения',
    'Each connection becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Каждое подключение становится доступным как получатель на вкладке **Получатели** при настройке уведомления.',
    'Account' => 'Аккаунт',
    'Type' => 'Тип',
    'Status' => 'Статус',
    'Organization' => 'Организация',
    'Member' => 'Участник',
    'Reconnect needed' => 'Требуется переподключение',
    'Expires' => 'Истекает',
    'Connected' => 'Подключено',
    'Disconnect' => 'Отключить',
    'No LinkedIn accounts are connected yet.' => 'Аккаунты LinkedIn ещё не подключены.',
    'Connect to LinkedIn' => 'Подключиться к LinkedIn',
    'Provide valid credentials to connect with LinkedIn.' => 'Укажите действительные учётные данные для подключения к LinkedIn.',
    'Disconnect this LinkedIn account?' => 'Отключить этот аккаунт LinkedIn?',

    // Settings: MQTT
    'Publish messages to an MQTT broker, handy for IoT and home-automation setups.' => 'Публикуйте сообщения в брокер MQTT, удобно для конфигураций IoT и домашней автоматизации.',
    'Host' => 'Хост',
    'Broker hostname, without a protocol or port.' => 'Имя хоста брокера, без протокола и порта.',
    'Port' => 'Порт',
    'Optional. Defaults to 8883 when TLS is enabled, otherwise 1883.' => 'Необязательно. По умолчанию 8883, если TLS включён, иначе 1883.',
    'Use TLS' => 'Использовать TLS',
    'Whether to connect to the broker over a secure TLS socket.' => 'Подключаться ли к брокеру через защищённый сокет TLS.',
    'Username' => 'Имя пользователя',
    'Optional, for brokers that require username/password authentication.' => 'Необязательно, для брокеров, требующих аутентификации по имени пользователя/паролю.',
    'Password' => 'Пароль',
    'MQTT Version' => 'Версия MQTT',
    'Protocol version sent to the broker.' => 'Версия протокола, отправляемая брокеру.',
    'Client ID' => 'Идентификатор клиента',
    'Optional. A unique client ID is generated automatically when left blank.' => 'Необязательно. Если оставить поле пустым, уникальный идентификатор клиента создаётся автоматически.',
    'Mutual TLS' => 'Взаимный TLS',
    'Optional. Needed for brokers that authenticate clients with certificates, such as AWS IoT Core. Enter the server file paths to your certificate files. You can use a `.env` variable or `@alias` reference.' => 'Необязательно. Требуется для брокеров, проверяющих клиентов по сертификатам, например AWS IoT Core. Укажите серверные пути к файлам сертификатов (допускается переменная `.env` или ссылка `@alias`).',
    'CA Certificate File' => 'Файл сертификата CA',
    'Path to the certificate authority (CA) file.' => 'Путь к файлу центра сертификации (CA).',
    'Client Certificate File' => 'Файл сертификата клиента',
    'Path to the client certificate file.' => 'Путь к файлу сертификата клиента.',
    'Client Key File' => 'Файл ключа клиента',
    'Path to the client private key file.' => 'Путь к файлу закрытого ключа клиента.',
    'MQTT Topics' => 'Темы MQTT',
    'Add the MQTT topics you want to publish to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Добавьте темы MQTT, в которые вы хотите публиковать. Каждая тема становится доступна как получатель на вкладке **Получатели** при настройке уведомления.',
    'Click any row\'s **Test** button to publish a quick test message to that topic.' => 'Нажмите кнопку **Тест** в любой строке, чтобы опубликовать быстрое тестовое сообщение в эту тему.',

    // ========================================================
    // MANUAL SEND & TEST
    // ========================================================

    // Manual send & test
    'Send a test message' => 'Отправить тестовое сообщение',
    'Send a REAL test notification?\\n\\n⚠️ Uses a random sample of real data.\\n⚠️ Sends a real message via the configured channel.\\n⚠️ Delivers to the real configured recipient(s).' => 'Отправить НАСТОЯЩЕЕ тестовое уведомление?\\n\\n⚠️ Использует случайную выборку реальных данных.\\n⚠️ Отправляет настоящее сообщение через настроенный канал.\\n⚠️ Доставляется настоящим настроенным получателям.',
    'Test' => 'Тест',
    'Send system snapshot' => 'Отправить снимок системы',
    'Send data report' => 'Отправить отчёт о данных',
    'Are you sure you want to send this notification?' => 'Вы уверены, что хотите отправить это уведомление?',
    'This notification cannot be triggered manually.' => 'Это уведомление нельзя запустить вручную.',
    'This notification no longer applies to the selected element.' => 'Это уведомление больше не применяется к выбранному элементу.',

    // ========================================================
    // RUNTIME OUTPUT
    // ========================================================

    // Runtime: dispatch log feedback
    'Sending {messageType} to {recipient}.' => 'Отправка {messageType} для {recipient}.',
    'Adding message to queue.' => 'Сообщение добавляется в очередь.',
    'Sending message immediately (bypassing queue).' => 'Отправка сообщения немедленно (минуя очередь).',

    // Runtime: controller responses
    'Test notification dispatched.' => 'Тестовое уведомление отправлено.',
    'No messages were dispatched. Check the recipient configuration.' => 'Сообщения не были отправлены. Проверьте конфигурацию получателей.',
    'Unable to send test: the feed could not be read or has no items.' => 'Невозможно отправить тест: не удалось прочитать ленту или в ней нет элементов.',
    'Unable to send test: no element matches the configured filters.' => 'Невозможно отправить тест: ни один элемент не соответствует настроенным фильтрам.',
    "Couldn't save settings." => 'Не удалось сохранить настройки.',
    'Settings saved.' => 'Настройки сохранены.',
    'Topic is empty.' => 'Тема пуста.',
    'Server URL is not configured.' => 'URL сервера не настроен.',
    'Test message from Notifier.' => 'Тестовое сообщение от Notifier.',
    'HTTP {status}' => 'HTTP {status}',
    'Test message sent successfully.' => 'Тестовое сообщение успешно отправлено.',
    'Page ID and Page Access Token are required.' => 'Page ID и Page Access Token обязательны.',
    'Facebook rejected the request: {error}' => 'Facebook отклонил запрос: {error}',
    'Successfully connected to "{name}". No posts were made.' => 'Успешно подключено к "{name}". Посты не публиковались.',
    'No Instagram Business account is linked to this Page.' => 'К этой странице не привязан бизнес-аккаунт Instagram.',
    'Successfully connected to @{handle}. No posts were made.' => 'Успешно подключено к @{handle}. Посты не публиковались.',
    'All four credentials are required.' => 'Все четыре учётных данных обязательны.',
    'X (Twitter) rejected the request: {error}' => 'X (Twitter) отклонил запрос: {error}',
    'Successfully authenticated as @{username}. No posts were made.' => 'Аутентификация выполнена успешно как @{username}. Посты не публиковались.',
    'Handle and app password are required.' => 'Хэндл и пароль приложения обязательны.',
    'Authentication failed.' => 'Аутентификация не удалась.',
    'Successfully authenticated. No messages were posted.' => 'Аутентификация выполнена успешно. Сообщения не были опубликованы.',
    'Log events deleted.' => 'События журнала удалены.',
    'Notification sent.' => 'Уведомление отправлено.',
    'Notification was not sent. Check the Notification Log for details.' => 'Уведомление не отправлено. Подробности см. в Журнале уведомлений.',
    'Instance URL and access token are required.' => 'URL инстанции и токен доступа обязательны.',
    'Mastodon rejected the request: {error}' => 'Mastodon отклонил запрос: {error}',
    'Successfully authenticated as @{handle}. No posts were made.' => 'Аутентификация выполнена успешно как @{handle}. Посты не публиковались.',
    'Broker host is not configured.' => 'Хост брокера не настроен.',

    // Runtime: LinkedIn connect flow
    'Add your LinkedIn app credentials before connecting.' => 'Добавьте учётные данные приложения LinkedIn перед подключением.',
    'LinkedIn authorization failed: {error}' => 'Не удалось авторизоваться в LinkedIn: {error}',
    'LinkedIn authorization failed: invalid state.' => 'Не удалось авторизоваться в LinkedIn: неверный state.',
    'LinkedIn authorization failed: no code returned.' => 'Не удалось авторизоваться в LinkedIn: код не возвращён.',
    'Connected to LinkedIn.' => 'Подключено к LinkedIn.',
    'Disconnected from LinkedIn.' => 'Отключено от LinkedIn.',

    // Outbound: per-channel send results
    'Successfully sent email message!' => 'Письмо успешно отправлено!',
    'Successfully sent SMS message!' => 'SMS-сообщение успешно отправлено!',
    'Successfully posted announcement!' => 'Объявление успешно опубликовано!',
    'Successfully sent flash message!' => 'Flash-сообщение успешно отправлено!',
    'Successfully sent Pushover message!' => 'Сообщение Pushover успешно отправлено!',
    'Successfully sent ntfy message to topic "{topic}".' => 'Сообщение ntfy успешно отправлено в тему "{topic}".',
    'Slack rejected the message: {error}' => 'Slack отклонил сообщение: {error}',
    'Successfully sent Slack message to "{label}".' => 'Сообщение Slack успешно отправлено в "{label}".',
    'Discord rejected the message: {error}' => 'Discord отклонил сообщение: {error}',
    'Successfully sent Discord message to "{label}".' => 'Сообщение Discord успешно отправлено в "{label}".',
    'Successfully sent Facebook post to "{label}".' => 'Пост Facebook успешно отправлен в "{label}".',
    'the attached image could not be read' => 'не удалось прочитать прикреплённое изображение',
    'Successfully sent X (Twitter) post as "{label}".' => 'Пост X (Twitter) успешно отправлен как "{label}".',
    'Successfully posted to Bluesky as "{label}".' => 'Опубликовано в Bluesky как "{label}".',
    'Successfully sent Mastodon post to "{label}".' => 'Пост Mastodon успешно отправлен в "{label}".',
    'Successfully sent MQTT message to topic "{topic}".' => 'Сообщение MQTT отправлено в тему "{topic}".',

    // Outbound: LinkedIn send results & skips
    'Successfully sent LinkedIn post to "{label}".' => 'Пост LinkedIn успешно отправлен в "{label}".',
    '[EMPTY BODY] The LinkedIn post body is empty.' => '[EMPTY BODY] Текст поста LinkedIn пуст.',
    '[NO RECIPIENT] No LinkedIn connection was specified.' => '[NO RECIPIENT] Подключение LinkedIn не указано.',
    '[RECONNECT REQUIRED] {reason}' => '[RECONNECT REQUIRED] {reason}',
    '[REJECTED BY LINKEDIN] {error}' => '[REJECTED BY LINKEDIN] {error}',
    'LinkedIn app credentials are not configured.' => 'Учётные данные приложения LinkedIn не настроены.',
    'The LinkedIn access token has expired. Please reconnect.' => 'Срок действия токена доступа LinkedIn истёк. Подключитесь заново.',
    'The LinkedIn connection no longer exists.' => 'Подключение LinkedIn больше не существует.',
    'My LinkedIn Profile' => 'Мой профиль LinkedIn',
    '[SKIPPED] Recipient "{name}" has no LinkedIn connection.' => '[SKIPPED] У получателя "{name}" нет подключения LinkedIn.',
    '[SKIPPED] The configured LinkedIn connection no longer exists (uid: {uid}).' => '[SKIPPED] Настроенное подключение LinkedIn больше не существует (uid: {uid}).',

    // Media attachments
    'Videos are not yet supported on {channel}.' => 'Видео пока не поддерживается в {channel}.',
    'The image could not be resized to fit.' => 'Не удалось изменить размер изображения до подходящего.',
    'The image could not be read.' => 'Не удалось прочитать изображение.',
    'The image failed to upload.' => 'Не удалось загрузить изображение.',
    'The upload response had no media ID.' => 'В ответе на загрузку отсутствовал ID медиа.',
    'The upload response had no blob.' => 'В ответе на загрузку отсутствовал blob.',
    '[NOT ATTACHED] Unable to attach image. {reason}' => '[НЕ ПРИКРЕПЛЕНО] Не удалось прикрепить изображение. {reason}',

    // Recipient warnings
    '[SKIPPED] User "{name}" has no Pushover key.' => '[ПРОПУЩЕНО] У пользователя "{name}" нет ключа Pushover.',

    // Errors & exceptions
    'Invalid element event: {class}' => 'Недействительное событие элемента: {class}',
    'Invalid notification ID: {id}' => 'Недействительный ID уведомления: {id}',
    'Invalid email message mode.' => 'Недействительный режим электронного письма.',
    'You do not have permission to use the Dynamic Recipients type.' => 'У вас нет разрешения на использование типа «Динамические получатели».',
    'Invalid settings section: {section}' => 'Недопустимый раздел настроек: {section}',
    'User not authorized to save this notification.' => 'Пользователю запрещено сохранять это уведомление.',
    'User not authorized to view this notification.' => 'Пользователю запрещено просматривать это уведомление.',
    'User not authorized to delete this notification.' => 'Пользователю запрещено удалять это уведомление.',
    'Notification not found' => 'Уведомление не найдено',
    'Element not found' => 'Элемент не найден',
    'You do not have permission to use the Dynamic Data type.' => 'У вас нет прав на использование типа «Динамические данные».',
    '[NO DATA] The Dynamic Data snippet did not call the {tag} tag.' => '[НЕТ ДАННЫХ] Сниппет Twig не вызвал тег {tag}.',

    // Config-file override note
    'This is being set in the config file. [{file}]' => 'Это задано в файле конфигурации. [{file}]',

    // ========================================================
    // JAVASCRIPT UI
    // ========================================================

    // JavaScript: log utility & buttons
    'Test notification failed.' => 'Не удалось отправить тестовое уведомление.',
    'Unable to get the notification, something went wrong.' => 'Не удалось получить уведомление, что-то пошло не так.',
    'Something went wrong.' => 'Что-то пошло не так.',
    'Invalid notification ID.' => 'Недопустимый идентификатор уведомления.',
    'Unable to delete the log event, something went wrong.' => 'Не удалось удалить событие журнала, что-то пошло не так.',
    'Log event deleted.' => 'Событие журнала удалено.',
    'Unable to delete log events, something went wrong.' => 'Не удалось удалить события журнала, что-то пошло не так.',
    'Are you sure you want to delete all logs from {date}?' => 'Вы уверены, что хотите удалить все журналы за {date}?',

    // Reworded outbound + dispatch log messages
    'Successfully posted to "{label}" Instagram account.' => 'Опубликовано в аккаунте Instagram «{label}».',
    '[BAD CREDENTIALS] Missing app token. [Configure Pushover]({url}).' => '[НЕВЕРНЫЕ УЧЁТНЫЕ ДАННЫЕ] Отсутствует токен приложения. [Настроить Pushover]({url}).',
    '[BAD CREDENTIALS] Missing {missing}. [Configure Twilio]({url}).' => '[НЕВЕРНЫЕ УЧЁТНЫЕ ДАННЫЕ] Отсутствует {missing}. [Настроить Twilio]({url}).',
    '[BAD CREDENTIALS] No Discord webhook URL is configured.' => '[НЕВЕРНЫЕ УЧЁТНЫЕ ДАННЫЕ] URL вебхука Discord не настроен.',
    '[BAD CREDENTIALS] No MQTT broker host is configured.' => '[НЕВЕРНЫЕ УЧЁТНЫЕ ДАННЫЕ] Хост брокера MQTT не настроен.',
    '[BAD CREDENTIALS] No Mastodon access token is configured.' => '[НЕВЕРНЫЕ УЧЁТНЫЕ ДАННЫЕ] Токен доступа Mastodon не настроен.',
    '[BAD CREDENTIALS] No Mastodon instance URL is configured.' => '[НЕВЕРНЫЕ УЧЁТНЫЕ ДАННЫЕ] URL экземпляра Mastodon не настроен.',
    '[BAD CREDENTIALS] No Slack bot token is configured.' => '[НЕВЕРНЫЕ УЧЁТНЫЕ ДАННЫЕ] Токен бота Slack не настроен.',
    '[BAD CREDENTIALS] No Twilio phone number is configured.' => '[НЕВЕРНЫЕ УЧЁТНЫЕ ДАННЫЕ] Номер телефона Twilio не настроен.',
    '[BAD CREDENTIALS] The recipient is missing Bluesky credentials.' => '[НЕВЕРНЫЕ УЧЁТНЫЕ ДАННЫЕ] У получателя нет учётных данных Bluesky.',
    '[BAD CREDENTIALS] The recipient is missing Facebook credentials.' => '[НЕВЕРНЫЕ УЧЁТНЫЕ ДАННЫЕ] У получателя нет учётных данных Facebook.',
    '[BAD CREDENTIALS] The recipient is missing X (Twitter) credentials.' => '[НЕВЕРНЫЕ УЧЁТНЫЕ ДАННЫЕ] У получателя нет учётных данных X (Twitter).',
    '[BAD CREDENTIALS] Unable to post, recipient is missing credentials.' => '[НЕВЕРНЫЕ УЧЁТНЫЕ ДАННЫЕ] Не удалось опубликовать: у получателя нет учётных данных.',
    '[EMPTY BODY] The Discord message body is empty.' => '[ПУСТОЙ ТЕКСТ] Текст сообщения Discord пуст.',
    '[EMPTY BODY] The Facebook post body is empty.' => '[ПУСТОЙ ТЕКСТ] Текст публикации Facebook пуст.',
    '[EMPTY BODY] The MQTT payload is empty.' => '[ПУСТОЙ ТЕКСТ] Полезная нагрузка MQTT пуст.',
    '[EMPTY BODY] The Mastodon post body is empty.' => '[ПУСТОЙ ТЕКСТ] Текст публикации Mastodon пуст.',
    '[EMPTY BODY] The Slack message body is empty.' => '[ПУСТОЙ ТЕКСТ] Текст сообщения Slack пуст.',
    '[EMPTY BODY] The X (Twitter) post body is empty.' => '[ПУСТОЙ ТЕКСТ] Текст публикации X (Twitter) пуст.',
    '[EMPTY BODY] The email message body was empty.' => '[ПУСТОЙ ТЕКСТ] Текст письма был пустым.',
    '[FEED ERROR] Could not fetch the feed: {message}' => '[ОШИБКА ЛЕНТЫ] Не удалось получить ленту: {message}',
    '[FEED ERROR] Could not parse the feed.' => '[ОШИБКА ЛЕНТЫ] Не удалось разобрать ленту.',
    '[FEED ERROR] Could not parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => '[ОШИБКА ЛЕНТЫ] Не удалось разобрать ленту. Требуются расширения PHP `simplexml` и `libxml`.',
    '[FEED ERROR] Initial feed scan failed: {message}' => '[ОШИБКА ЛЕНТЫ] Не удалось выполнить первичное сканирование ленты: {message}',
    '[INVALID NUMBER] The recipient phone number is invalid.' => '[НЕВЕРНЫЙ НОМЕР] Номер телефона получателя неверен.',
    '[INVALID TYPE] The flash message type is invalid.' => '[НЕВЕРНЫЙ ТИП] Тип флеш-сообщения неверен.',
    '[LINK PREVIEW SKIPPED] {reason}' => '[ПРЕВЬЮ ССЫЛКИ ПРОПУЩЕНО] {reason}',
    '[MISSING IMAGE] Image Attachment field never called the {tag} tag.' => '[НЕТ ИЗОБРАЖЕНИЯ] Поле Вложение изображения ни разу не вызвало тег {tag}.',
    '[MISSING IMAGE] Image Attachment field was empty.' => '[НЕТ ИЗОБРАЖЕНИЯ] Поле Вложение изображения было пустым.',
    '[MISSING IMAGE] The {tag} tag was called, but returned an invalid image.' => '[НЕТ ИЗОБРАЖЕНИЯ] Тег {tag} был вызван, но вернул недопустимое изображение.',
    '[MISSING IMAGE] Unable to send Instagram post, the image needs a public URL.' => '[НЕТ ИЗОБРАЖЕНИЯ] Не удалось отправить публикацию в Instagram: изображению нужен публичный URL.',
    '[NO MEDIA] No image was attached because the {tag} tag was never invoked in the Image Attachment field.' => '[НЕТ МЕДИА] Изображение не было прикреплено, так как тег {tag} ни разу не был вызван в поле Вложение изображения.',
    '[NO RECIPIENTS] The Dynamic Recipients snippet did not call setRecipients.' => '[НЕТ ПОЛУЧАТЕЛЕЙ] Сниппет динамических получателей не вызвал setRecipients.',
    '[NO RECIPIENTS] setRecipients was called with an empty value.' => '[НЕТ ПОЛУЧАТЕЛЕЙ] setRecipients был вызван с пустым значением.',
    '[NO RECIPIENT] No MQTT topic was specified.' => '[НЕТ ПОЛУЧАТЕЛЯ] Тема MQTT не указана.',
    '[NO RECIPIENT] No Slack channel ID was specified.' => '[НЕТ ПОЛУЧАТЕЛЯ] Идентификатор канала Slack не указан.',
    '[NO RECIPIENT] No ntfy topic was specified.' => '[НЕТ ПОЛУЧАТЕЛЯ] Тема ntfy не указана.',
    '[NO RECIPIENT] No recipient user was specified for the announcement.' => '[НЕТ ПОЛУЧАТЕЛЯ] Для объявления не указан получатель.',
    '[NO RECIPIENT] No recipient was specified for the email.' => '[НЕТ ПОЛУЧАТЕЛЯ] Для письма не указан получатель.',
    '[NO RECIPIENT] The recipient has no Pushover user key.' => '[НЕТ ПОЛУЧАТЕЛЯ] У получателя нет пользовательского ключа Pushover.',
    '[NO RECIPIENT] The recipient has no phone number.' => '[НЕТ ПОЛУЧАТЕЛЯ] У получателя нет номера телефона.',
    '[REJECTED BY DISCORD] {error}' => '[ОТКЛОНЕНО: DISCORD] {error}',
    '[REJECTED BY FACEBOOK] {error}' => '[ОТКЛОНЕНО: FACEBOOK] {error}',
    '[REJECTED BY INSTAGRAM] {error}' => '[ОТКЛОНЕНО: INSTAGRAM] {error}',
    '[REJECTED BY MASTODON] {error}' => '[ОТКЛОНЕНО: MASTODON] {error}',
    '[REJECTED BY SLACK] {error}' => '[ОТКЛОНЕНО: SLACK] {error}',
    '[REJECTED BY X (TWITTER)] {error}' => '[ОТКЛОНЕНО: X (TWITTER)] {error}',
    '[SEND FAILED] Authentication failed for {handle}: {reason}' => '[ОШИБКА ОТПРАВКИ] Не удалось пройти аутентификацию для {handle}: {reason}',
    '[SEND FAILED] Authentication failed: {reason}' => '[ОШИБКА ОТПРАВКИ] Не удалось пройти аутентификацию: {reason}',
    "[SEND FAILED] Could not send the email using Craft's native handling. Check your general email settings within Craft." => '[ОШИБКА ОТПРАВКИ] Не удалось отправить письмо средствами Craft. Проверьте общие настройки электронной почты в Craft.',
    '[SEND FAILED] HTTP {status}: {reason}' => '[ОШИБКА ОТПРАВКИ] HTTP {status}: {reason}',
    '[SEND FAILED] {error}' => '[ОШИБКА ОТПРАВКИ] {error}',
    '[SEND FAILED] {reason}' => '[ОШИБКА ОТПРАВКИ] {reason}',
    '[SKIPPED] Pushover user-key field is not configured on this notification.' => '[ПРОПУЩЕНО] Поле пользовательского ключа Pushover не настроено в этом уведомлении.',
    '[SKIPPED] Recipient "{name}" cannot access the control panel.' => '[ПРОПУЩЕНО] Получатель «{name}» не имеет доступа к панели управления.',
    '[SKIPPED] Recipient "{name}" has no Bluesky credentials.' => '[ПРОПУЩЕНО] У получателя «{name}» нет учётных данных Bluesky.',
    '[SKIPPED] Recipient "{name}" has no Craft user account.' => '[ПРОПУЩЕНО] У получателя «{name}» нет учётной записи Craft.',
    '[SKIPPED] Recipient "{name}" has no Discord webhook URL.' => '[ПРОПУЩЕНО] У получателя «{name}» нет URL вебхука Discord.',
    '[SKIPPED] Recipient "{name}" has no Facebook credentials.' => '[ПРОПУЩЕНО] У получателя «{name}» нет учётных данных Facebook.',
    '[SKIPPED] Recipient "{name}" has no Instagram credentials.' => '[ПРОПУЩЕНО] У получателя «{name}» нет учётных данных Instagram.',
    '[SKIPPED] Recipient "{name}" has no MQTT topic.' => '[ПРОПУЩЕНО] У получателя «{name}» нет темы MQTT.',
    '[SKIPPED] Recipient "{name}" has no Mastodon credentials.' => '[ПРОПУЩЕНО] У получателя «{name}» нет учётных данных Mastodon.',
    '[SKIPPED] Recipient "{name}" has no Slack bot token.' => '[ПРОПУЩЕНО] У получателя «{name}» нет токена бота Slack.',
    '[SKIPPED] Recipient "{name}" has no Slack channel ID.' => '[ПРОПУЩЕНО] У получателя «{name}» нет идентификатора канала Slack.',
    '[SKIPPED] Recipient "{name}" has no X (Twitter) credentials.' => '[ПРОПУЩЕНО] У получателя «{name}» нет учётных данных X (Twitter).',
    '[SKIPPED] Recipient "{name}" has no email address.' => '[ПРОПУЩЕНО] У получателя «{name}» нет адреса электронной почты.',
    '[SKIPPED] Recipient "{name}" has no ntfy topic.' => '[ПРОПУЩЕНО] У получателя «{name}» нет темы ntfy.',
    '[SKIPPED] Recipient "{name}" has no phone number.' => '[ПРОПУЩЕНО] У получателя «{name}» нет номера телефона.',
    '[SKIPPED] The configured {kind} no longer exists in the plugin settings (uid: {uid}).' => '[ПРОПУЩЕНО] Настроенный {kind} больше не существует в настройках плагина (uid: {uid}).',
    '[SKIPPED] Unrecognized recipient "{value}".' => '[ПРОПУЩЕНО] Нераспознанный получатель «{value}».',
    '[SKIPPED] Unrecognized recipient of type "{type}".' => '[ПРОПУЩЕНО] Нераспознанный тип получателя «{type}».',
    '[TOO LONG] The Discord message body exceeds the 2000-character limit.' => '[СЛИШКОМ ДЛИННО] Текст сообщения Discord превышает лимит в 2000 символов.',
    '[TRUNCATED] Body exceeded {max} characters.' => '[ОБРЕЗАНО] Текст превысил {max} символов.',
    '[TRUNCATED] Caption exceeded {max} characters.' => '[ОБРЕЗАНО] Подпись превысила {max} символов.',
];
