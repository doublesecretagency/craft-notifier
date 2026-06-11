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
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are also supported.' => '[Шаблоны]({templatingUrl}) и [специальные переменные]({variablesUrl}) также поддерживаются.',

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
    'Unable to parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => 'Не удалось разобрать ленту. Необходимы расширения PHP `simplexml` и `libxml`.',
    'Unable to parse the feed.' => 'Не удалось разобрать ленту.',
    'Unable to fetch the feed: {message}' => 'Не удалось получить ленту: {message}',
    'Initial feed scan failed: {message}' => 'Не удалось выполнить первоначальную проверку ленты: {message}',

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

    // Outbound: per-channel send results
    'Unable to send email, no recipient specified.' => 'Невозможно отправить письмо: получатель не указан.',
    'Unable to send email, the message body was empty.' => 'Невозможно отправить письмо: тело сообщения пустое.',
    "Unable to send the email using Craft's native email handling." => 'Невозможно отправить письмо через встроенный почтовый обработчик Craft.',
    'Check your general email settings within Craft.' => 'Проверьте общие настройки почты в Craft.',
    'Successfully sent email message!' => 'Письмо успешно отправлено!',
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[Неверные учётные данные Twilio.]({url}) Отсутствует {missing}.',
    'Unable to send SMS, no Twilio phone number exists.' => 'Невозможно отправить SMS, нет номера телефона Twilio.',
    'Unable to send SMS, no recipient phone number exists.' => 'Невозможно отправить SMS, нет номера телефона получателя.',
    'Unable to send SMS, recipient phone number is invalid.' => 'Невозможно отправить SMS, номер телефона получателя недействителен.',
    'Successfully sent SMS message!' => 'SMS-сообщение успешно отправлено!',
    'Unable to post announcement, no recipient userId specified.' => 'Невозможно опубликовать объявление: userId получателя не указан.',
    'Successfully posted announcement!' => 'Объявление успешно опубликовано!',
    'Unable to send the flash message, invalid flash type.' => 'Невозможно отправить flash-сообщение: недействительный flash-тип.',
    'Successfully sent flash message!' => 'Flash-сообщение успешно отправлено!',
    '[Invalid Pushover credentials.]({url}) Missing app token.' => '[Неверные учётные данные Pushover.]({url}) Отсутствует токен приложения.',
    'Unable to send Pushover message, no user key on recipient.' => 'Невозможно отправить сообщение Pushover: у получателя нет пользовательского ключа.',
    'Pushover POST failed: {reason}' => 'Pushover POST не удался: {reason}',
    'Successfully sent Pushover message!' => 'Сообщение Pushover успешно отправлено!',
    'Unable to send ntfy message, no topic specified.' => 'Невозможно отправить сообщение ntfy: тема не указана.',
    'ntfy POST failed with HTTP {status}: {reason}' => 'ntfy POST не удался с HTTP {status}: {reason}',
    'ntfy POST failed: {reason}' => 'ntfy POST не удался: {reason}',
    'Successfully sent ntfy message to topic "{topic}".' => 'Сообщение ntfy успешно отправлено в тему "{topic}".',
    'Unable to send Slack message, no bot token.' => 'Не удалось отправить сообщение Slack: нет токена бота.',
    'Unable to send Slack message, no channel ID.' => 'Не удалось отправить сообщение Slack: нет ID канала.',
    'Unable to send Slack message, body is empty.' => 'Невозможно отправить сообщение Slack: тело пустое.',
    'Slack rejected the message: {error}' => 'Slack отклонил сообщение: {error}',
    'Slack POST failed: {reason}' => 'Slack POST не удался: {reason}',
    'Successfully sent Slack message to "{label}".' => 'Сообщение Slack успешно отправлено в "{label}".',
    'Unable to send Discord message, no webhook URL.' => 'Невозможно отправить сообщение Discord: нет URL Webhook.',
    'Unable to send Discord message, body is empty.' => 'Невозможно отправить сообщение Discord: тело пустое.',
    'Unable to send Discord message, body exceeds the 2000-character limit.' => 'Невозможно отправить сообщение Discord: тело превышает ограничение в 2000 символов.',
    'Discord rejected the message: {error}' => 'Discord отклонил сообщение: {error}',
    'Discord POST failed: {reason}' => 'Discord POST не удался: {reason}',
    'Successfully sent Discord message to "{label}".' => 'Сообщение Discord успешно отправлено в "{label}".',
    'Unable to send Bluesky post, recipient is missing credentials.' => 'Невозможно отправить пост Bluesky: у получателя нет учётных данных.',
    'Body exceeded {max} characters, truncated.' => 'Тело превысило {max} символов и было обрезано.',
    'Successfully posted to Bluesky as "{label}".' => 'Опубликовано в Bluesky как "{label}".',
    'Bluesky auth failed for {handle}: {reason}' => 'Аутентификация Bluesky не удалась для {handle}: {reason}',
    'Bluesky auth failed: {reason}' => 'Аутентификация Bluesky не удалась: {reason}',
    'Bluesky post failed: {reason}' => 'Публикация в Bluesky не удалась: {reason}',
    'Bluesky link preview skipped: {reason}' => 'Предпросмотр ссылки Bluesky пропущен: {reason}',
    'Unable to send Mastodon post, no instance URL.' => 'Невозможно отправить пост Mastodon: нет URL инстанции.',
    'Unable to send Mastodon post, no access token.' => 'Невозможно отправить пост Mastodon: нет токена доступа.',
    'Unable to send Mastodon post, body is empty.' => 'Невозможно отправить пост Mastodon: тело пустое.',
    'Mastodon rejected the post: {error}' => 'Mastodon отклонил пост: {error}',
    'Mastodon POST failed: {reason}' => 'Mastodon POST не удался: {reason}',
    'Successfully sent Mastodon post to "{label}".' => 'Пост Mastodon успешно отправлен в "{label}".',
    'Unable to send MQTT message, no broker host configured.' => 'Не удалось отправить сообщение MQTT: не настроен хост брокера.',
    'Unable to send MQTT message, no topic specified.' => 'Не удалось отправить сообщение MQTT: не указана тема.',
    'Unable to send MQTT message, the payload is empty.' => 'Не удалось отправить сообщение MQTT: содержимое пусто.',
    'MQTT publish failed: {reason}' => 'Не удалось опубликовать в MQTT: {reason}',
    'Successfully sent MQTT message to topic "{topic}".' => 'Сообщение MQTT отправлено в тему "{topic}".',

    // Recipient warnings
    'Recipient "{name}" has no email address.' => 'У получателя "{name}" нет адреса электронной почты.',
    'Recipient "{name}" has no phone number.' => 'У получателя "{name}" нет номера телефона.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => 'У получателя "{name}" нет связанного пользователя; объявление невозможно отправить.',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => 'У получателя "{name}" нет доступа к панели управления; объявление невозможно отправить.',
    'Pushover user-key field is not configured on this notification.' => 'Поле пользовательского ключа Pushover не настроено в этом уведомлении.',
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => 'У получателя "{name}" нет связанного пользователя; сообщение Pushover невозможно отправить.',
    '[SKIPPED] User "{name}" has no Pushover key.' => '[ПРОПУЩЕНО] У пользователя "{name}" нет ключа Pushover.',
    'Recipient "{name}" has no ntfy topic.' => 'У получателя "{name}" нет темы ntfy.',
    'Recipient "{name}" has no Slack bot token.' => 'У получателя "{name}" нет токена бота Slack.',
    'Recipient "{name}" has no Slack channel ID.' => 'У получателя "{name}" нет ID канала Slack.',
    'Recipient "{name}" has no Discord webhook URL.' => 'У получателя "{name}" нет URL Webhook для Discord.',
    'Recipient "{name}" has no Bluesky credentials.' => 'У получателя "{name}" нет учётных данных Bluesky.',
    'Recipient "{name}" has no Mastodon credentials.' => 'У получателя "{name}" нет учётных данных Mastodon.',
    'Recipient "{name}" has no MQTT topic.' => 'У получателя "{name}" нет темы MQTT.',

    // Errors & exceptions
    'Invalid element event: {class}' => 'Недействительное событие элемента: {class}',
    'Invalid notification ID: {id}' => 'Недействительный ID уведомления: {id}',
    'Invalid email message mode.' => 'Недействительный режим электронного письма.',
    'You do not have permission to use the Dynamic Recipients type.' => 'У вас нет разрешения на использование типа «Динамические получатели».',
    'Dynamic recipients snippet did not call setRecipients.' => 'Сниппет динамических получателей не вызвал setRecipients.',
    'setRecipients was called with an empty value.' => 'setRecipients вызван с пустым значением.',
    'Unrecognized recipient of type "{type}".' => 'Нераспознанный получатель типа "{type}".',
    'Unrecognized recipient "{value}".' => 'Нераспознанный получатель "{value}".',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => 'Настроенный {kind} больше не существует в настройках плагина (uid: {uid}).',
    'Invalid settings section: {section}' => 'Недопустимый раздел настроек: {section}',
    'User not authorized to save this notification.' => 'Пользователю запрещено сохранять это уведомление.',
    'User not authorized to view this notification.' => 'Пользователю запрещено просматривать это уведомление.',
    'User not authorized to delete this notification.' => 'Пользователю запрещено удалять это уведомление.',
    'Notification not found' => 'Уведомление не найдено',
    'Element not found' => 'Элемент не найден',
    'You do not have permission to use the Dynamic Data type.' => 'У вас нет прав на использование типа «Динамические данные».',
    'The Dynamic Data snippet did not call the {tag} tag.' => 'Сниппет Twig не вызвал тег {tag}.',

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
];
