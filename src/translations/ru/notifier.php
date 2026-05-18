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
    'Notifications'          => 'Уведомления',
    'Notification'           => 'Уведомление',
    'All notifications'      => 'Все уведомления',
    'Notification Log'       => 'Журнал уведомлений',
    'Logs'                   => 'Журналы',
    'View Notifications'     => 'Просмотр уведомлений',
    'Add a New Notification' => 'Добавить новое уведомление',

    // Permissions
    'View notifications'              => 'Просматривать уведомления',
    'Save notifications'              => 'Сохранять уведомления',
    'Use the Dynamic Recipients type' => 'Использовать тип «Динамические получатели»',
    'Test notifications'              => 'Тестировать уведомления',
    'Delete notifications'            => 'Удалять уведомления',
    'View notification log'           => 'Просматривать журнал уведомлений',
    'Delete notification log'         => 'Удалять журнал уведомлений',

    // Notification editor: tabs
    'Meta'       => 'Мета',
    'Event'      => 'Событие',
    'Message'    => 'Сообщение',
    'Recipients' => 'Получатели',

    // Event tab: type selector
    'Event Type'                                           => 'Тип события',
    'What type of event will activate the notification?'   => 'Какой тип события активирует уведомление?',
    'Which specific event will activate the notification?' => 'Какое именно событие активирует уведомление?',

    // Event tab: event types
    'Assets Event'                   => 'Событие ресурса',
    'Commerce Orders Event'          => 'Событие заказа Commerce',
    'Commerce Products Event'        => 'Событие товара Commerce',
    'Digital Products Event'         => 'Событие Digital Products',
    'Digital Product Licenses Event' => 'Событие лицензии Digital Products',
    'Solspace Calendar Event'        => 'Событие Solspace Calendar',
    'Entries Event'                  => 'Событие записей',
    'Users Event'                    => 'Событие пользователя',
    'Ungrouped Users'                => 'Пользователи без группы',

    // Field and element conditions
    'Field Conditions'             => 'Условия поля',
    'Send the message only when the saved element matches the following conditions.' => 'Отправлять сообщение только когда сохранённый элемент соответствует следующим условиям.',
    'has changed'                  => 'изменилось',
    '#{elementType} Event Filters' => 'Фильтры событий для #{elementType}',
    'No filters match this event.' => 'Ни один фильтр не соответствует этому событию.',
    'Determine whether each message should be sent based on specified conditions.' => 'Определите на основе указанных условий, следует ли отправлять каждое сообщение.',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => 'Элемент сохраняется впервые',
    'Must be a new entry'                       => 'Должна быть новая запись',
    'Must be an existing entry'                 => 'Должна быть существующая запись',
    'Can be existing or new'                    => 'Может быть существующим или новым',

    // Filters: new elements
    'Element is new'         => 'Элемент новый',
    'New elements only'      => 'Только новые элементы',
    'Existing elements only' => 'Только существующие элементы',

    // Filters: enabled state
    'Element is enabled'         => 'Элемент включён',
    'Must be enabled'            => 'Должен быть включён',
    'Must be disabled'           => 'Должен быть отключён',
    'Can be enabled or disabled' => 'Может быть включён или отключён',

    // Filters: drafts
    'Element is a draft'          => 'Элемент — черновик',
    'Must be a draft'             => 'Должен быть черновиком',
    'Must not be a draft'         => 'Не должен быть черновиком',
    'Can be a draft or non-draft' => 'Может быть черновиком или нет',

    // Filters: provisional drafts
    'Element is a provisional draft'                => 'Элемент — предварительный черновик',
    'Must be a provisional draft'                   => 'Должен быть предварительным черновиком',
    'Must not be a provisional draft'               => 'Не должен быть предварительным черновиком',
    'Can be a provisional draft or non-provisional' => 'Может быть предварительным черновиком или нет',

    // Filters: revisions
    'Element is a revision'             => 'Элемент — версия',
    'Must be a revision'                => 'Должен быть версией',
    'Must not be a revision'            => 'Не должен быть версией',
    'Can be a revision or non-revision' => 'Может быть версией или нет',

    // Filters: duplication
    'Element is being duplicated'         => 'Элемент дублируется',
    'Must be duplicating the element'     => 'Должен дублировать элемент',
    'Must not be duplicating the element' => 'Не должен дублировать элемент',

    // Filters: propagation
    'Element is being propagated'     => 'Элемент распространяется',
    'Element must be propagating'     => 'Элемент должен распространяться',
    'Element must not be propagating' => 'Элемент не должен распространяться',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => 'Элемент массово пересохраняется',
    'Must be bulk-resaving the element'     => 'Должен массово пересохранять элемент',
    'Must not be bulk-resaving the element' => 'Не должен массово пересохранять элемент',

    // Filters: common output
    'Unnamed filter'                => 'Безымянный фильтр',
    'Must be TRUE to send message'  => 'Должно быть TRUE для отправки сообщения',
    'Must be FALSE to send message' => 'Должно быть FALSE для отправки сообщения',
    'No effect'                     => 'Без эффекта',

    // Message tab: type selector and queue
    'Message Type'                       => 'Тип сообщения',
    'What type of message will be sent?' => 'Какой тип сообщения будет отправлен?',
    'Send Message via Queue'             => 'Отправить сообщение через очередь',
    'Should the message be sent via the [jobs queue]({queueUrl})?' => 'Отправлять сообщение через [очередь задач]({queueUrl})?',
    'Send immediately' => 'Отправить немедленно',
    'Add to queue' => 'Добавить в очередь',

    // Message tab: Email fields
    "User's Email Address Field" => 'Поле электронной почты пользователя',
    'Email Subject'              => 'Тема письма',
    'Email Body'                 => 'Тело письма',

    // Message tab: SMS fields
    "User's Phone Number Field" => 'Поле телефона пользователя',
    'SMS Message Body'          => 'Тело SMS-сообщения',

    // Message tab: Announcement fields
    'Announcement Title'   => 'Заголовок объявления',
    'Announcement Message' => 'Текст объявления',

    // Message tab: Flash fields
    'Flash Message Type'                         => 'Тип flash-сообщения',
    'Flash Message Title'                        => 'Заголовок flash-сообщения',
    'Flash Message Details'                      => 'Подробности flash-сообщения',
    'Which type of flash message should appear?' => 'Какой тип flash-сообщения должен появиться?',

    // Message tab: Pushover fields
    "Field containing each user's Pushover key" => 'Поле ключа Pushover пользователя',
    'The Pushover application token is configured in [Settings → Pushover](url).' => 'Токен приложения Pushover настраивается в [Настройки → Pushover](url).',

    // Message tab: ntfy fields
    'Priority'           => 'Приоритет',
    'Tags'               => 'Метки',
    'Click URL'          => 'URL по клику',
    'Render as Markdown' => 'Отображать как Markdown',

    // Message tab: Slack fields
    'Slack Message Body' => 'Тело сообщения Slack',

    // Message tab: Bluesky fields
    'Post Body' => 'Текст поста',
    'Generate Link Preview' => 'Создать предпросмотр ссылки',
    "When the post body contains a URL, automatically generate a preview card with the linked page's image, title, and description." => 'Когда текст поста содержит URL-адрес, к нему прикрепляется карточка предпросмотра с заголовком, описанием и изображением связанной страницы.',
    'No card' => 'Без карточки',
    'Generate preview card' => 'Создать карточку предпросмотра',

    // Message tab: Title / Body / Trix toolbar
    'Title'         => 'Заголовок',
    'Body'          => 'Текст',
    'Rich Text'     => 'Форматированный текст',
    'Bold'          => 'Полужирный',
    'Italic'        => 'Курсив',
    'Underline'     => 'Подчёркнутый',
    'Strikethrough' => 'Зачёркнутый',
    'Bullets'       => 'Маркеры',
    'Numbers'       => 'Нумерация',
    'Heading'       => 'Заголовок',
    'Code'          => 'Код',
    'Undo'          => 'Отменить',
    'Redo'          => 'Повторить',
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => 'Текст исходящего письма. Можно использовать <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">специальные переменные</a> или даже <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">пропускать получателей</a>.',

    // Recipients tab: common
    'Recipients Type'                             => 'Тип получателей',
    'Who will receive this message?'              => 'Кто получит это сообщение?',
    'Add a message recipient'                     => 'Добавить получателя',
    'Select User(s)'                              => 'Выберите пользователя(ей)',
    'Which users will receive the message?'       => 'Какие пользователи получат сообщение?',
    'Which user groups will receive the message?' => 'Какие группы пользователей получат сообщение?',
    'Twig Snippet to Determine Recipients'        => 'Фрагмент Twig для определения получателей',

    // Recipients tab: per-provider pickers
    'Select Slack channel(s)'                           => 'Выберите канал(ы) Slack',
    'Which Slack channels should receive this message?' => 'Какие каналы Slack получат это сообщение?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Каналы Slack не настроены. Добавьте в [Настройки → Slack]({url}).',
    'Select ntfy topic(s)'                              => 'Выберите тему(ы) ntfy',
    'Which ntfy topics should receive this message?'    => 'Какие темы ntfy получат это сообщение?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'Темы ntfy не настроены. Добавьте в [Настройки → ntfy]({url}).',
    'Select Bluesky account(s)'                         => 'Выберите аккаунт(ы) Bluesky',
    'Which Bluesky accounts should post this message?'  => 'Какие аккаунты Bluesky должны опубликовать это сообщение?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Аккаунты Bluesky не настроены. Добавьте в [Настройки → Bluesky]({url}).',

    // Settings: page chrome
    'Notifier Settings' => 'Настройки Notifier',
    'General'           => 'Общие',
    'Twilio'            => 'Twilio',
    'Pushover'          => 'Pushover',
    'Slack'             => 'Slack',
    'Bluesky'           => 'Bluesky',
    'ntfy'              => 'ntfy',

    // Settings: Logging
    'Logging'                             => 'Журналирование',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier ведёт постоянный журнал отправленных сообщений. Обычно это не нужно, но вы можете ограничить количество событий, записываемых в базу данных.',
    'Enable Logging'                      => 'Включить журналирование',
    'When disabled, Notifier will not write anything to the notification log.' => 'Когда отключено, Notifier ничего не записывает в журнал уведомлений.',
    'Number of days to retain log events' => 'Число дней хранения событий журнала',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Хранить события журнала не более этого числа дней. Пусто означает без ограничения.',
    'Number of log events to retain'      => 'Число сохраняемых событий журнала',
    'At most, keep this many log events. Leave blank for no limit.' => 'Хранить не более этого числа событий. Пусто означает без ограничения.',

    // Settings: Twilio
    'Twilio API Credentials'                       => 'Учётные данные API Twilio',
    'If using the Twilio API to send SMS messages, the following credentials are required.' => 'При отправке SMS через Twilio API требуются следующие учётные данные.',
    'Twilio Account SID'                           => 'Twilio Account SID',
    'Twilio Auth Token'                            => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)' => 'Номер телефона Twilio (отправляет каждое SMS-сообщение)',
    'SMS Testing'                                  => 'Тестирование SMS',
    'Optional. When set, every SMS dispatched will be sent to this number instead of the resolved recipient.' => 'Необязательно. Если установлено, каждое отправленное SMS будет направлено на этот номер вместо реального получателя.',
    'Test phone number'                            => 'Тестовый номер телефона',

    // Settings: Pushover
    "[Pushover](https://pushover.net) sends push notifications to a registered user's devices. Each Craft user needs a custom field on their profile storing their Pushover user key; you select which field on each Notification's Message tab. For full setup instructions, see the [Pushover getting-started docs](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover)." => '[Pushover](https://pushover.net) отправляет push-уведомления на устройства зарегистрированного пользователя. Каждому пользователю Craft нужно пользовательское поле в профиле для хранения ключа Pushover; вы выбираете, какое поле использовать, на вкладке Сообщение каждого уведомления. Полную инструкцию по настройке смотрите в [документации Pushover для начинающих](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover).',
    'Application API Token'                                      => 'Токен API приложения',
    'The 30-character app token from your Pushover application.' => '30-символьный токен приложения из вашего приложения Pushover.',

    // Settings: ntfy
    'ntfy.sh is a free HTTP-based push notification service. Subscribers receive messages on the ntfy app, web, or any compatible client by joining a topic.' => 'ntfy.sh — бесплатный HTTP-сервис push-уведомлений. Подписчики получают сообщения в приложении ntfy, в Интернете или в любом совместимом клиенте, подключаясь к теме.',
    'Server URL'   => 'URL сервера',
    'Defaults to https://ntfy.sh. Point at a self-hosted ntfy instance if applicable.' => 'По умолчанию https://ntfy.sh. При необходимости укажите свою ntfy-инстанцию.',
    'Access token' => 'Токен доступа',
    'Optional. Required for protected topics or self-hosted instances with auth.' => 'Необязательно. Требуется для защищённых тем или self-hosted инстанций с авторизацией.',
    'ntfy Topics'  => 'Темы ntfy',
    'Named list of ntfy topics. Each topic becomes selectable on the notification edit screen.' => 'Именованный список тем ntfy. Каждая тема становится выбираемой на экране редактирования уведомления.',
    'Topics'       => 'Темы',
    'Add one row per topic name. Use the **Test** button to send a quick test message to the topic.' => 'Добавьте по одной строке для каждого названия темы. Используйте кнопку **Test** для быстрой проверки темы.',
    'Topic'        => 'Тема',
    'Add a topic'  => 'Добавить тему',
    'Save first to persist a row, then click its **Test** button to fire a sanity check against ntfy.' => 'Сначала сохраните, чтобы строка осталась, затем нажмите её кнопку **Test** для быстрой проверки ntfy.',

    // Settings: Slack
    'Slack Channels' => 'Каналы Slack',
    'Channels'       => 'Каналы',
    'Each Slack channel needs its own Incoming Webhook URL. Use the **Test** button to fire a quick sanity check after saving.' => 'Каждому каналу Slack нужен свой URL Incoming Webhook. Используйте кнопку **Test** для быстрой проверки после сохранения.',
    'Webhook URL'    => 'URL webhook',
    'Add a channel'  => 'Добавить канал',
    'Save first to persist a row, then click its **Test** button to fire a sanity check against Slack.' => 'Сначала сохраните, чтобы строка осталась, затем нажмите её кнопку **Test** для быстрой проверки Slack.',

    // Settings: Bluesky
    "[Bluesky](https://bsky.app) posts publish to the configured account's feed via the ATProto API. App passwords are generated at [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). An app password is a secret, so store it in a `.env` variable and reference that variable (e.g. `\$BLUESKY_APP_PASSWORD`) rather than pasting the password directly." => 'Посты [Bluesky](https://bsky.app) публикуются в ленте настроенного аккаунта через ATProto API. Пароли приложений создаются на [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). Пароль приложения является секретом, поэтому храните его в переменной `.env` и ссылайтесь на эту переменную (например, `$BLUESKY_APP_PASSWORD`), а не вставляйте пароль напрямую.',
    'PDS URL'          => 'URL PDS',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'По умолчанию https://bsky.social. Укажите свой PDS, если ваша установка федерирована.',
    'Bluesky Accounts' => 'Аккаунты Bluesky',
    'Named list of Bluesky accounts. Each account becomes selectable on the notification edit screen.' => 'Именованный список аккаунтов Bluesky. Каждый аккаунт становится выбираемым на экране редактирования уведомления.',
    'Accounts'         => 'Аккаунты',
    'Add one row per Bluesky account. Use **Test** to verify the credentials authenticate.' => 'Добавьте по одной строке для каждого аккаунта Bluesky. Используйте **Test** для проверки, что учётные данные проходят аутентификацию.',
    'Label'            => 'Метка',
    'Handle'           => 'Хэндл',
    'App password'     => 'Пароль приложения',
    'Add an account'   => 'Добавить аккаунт',
    'Save first to persist a row, then click its **Test** button to verify the credentials authenticate.' => 'Сначала сохраните, чтобы строка осталась, затем нажмите её кнопку **Test** для проверки аутентификации.',

    // Test notification (UI)
    'Send a test message'           => 'Отправить тестовое сообщение',
    'Are you certain you want to send a test notification?\\n\\nThe configured message will be sent to the configured recipient(s).' => 'Действительно отправить тестовое уведомление?\\n\\nНастроенное сообщение будет отправлено настроенным получателям.',
    'Test'                          => 'Тест',
    'Test notification dispatched.' => 'Тестовое уведомление отправлено.',
    'No messages were dispatched. Check the recipient configuration.' => 'Сообщения не были отправлены. Проверьте конфигурацию получателей.',

    // Settings: save / test action responses
    "Couldn't save settings."                 => 'Не удалось сохранить настройки.',
    'Settings saved.'                         => 'Настройки сохранены.',
    'Topic is empty.'                         => 'Тема пуста.',
    'Server URL is not configured.'           => 'URL сервера не настроен.',
    'Test message from Notifier.'             => 'Тестовое сообщение от Notifier.',
    'HTTP {status}'                           => 'HTTP {status}',
    'Test message sent successfully.'         => 'Тестовое сообщение успешно отправлено.',
    'HTTP {status}: {body}'                   => 'HTTP {status}: {body}',
    'Handle and app password are required.'   => 'Хэндл и пароль приложения обязательны.',
    'Authentication failed.'                  => 'Аутентификация не удалась.',
    'Successfully authenticated. No messages were posted.' => 'Аутентификация выполнена успешно. Сообщения не были опубликованы.',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.'          => 'Отправка {messageType} для {recipient}.',
    'Adding message to queue.'                       => 'Сообщение добавляется в очередь.',
    'Sending message immediately (bypassing queue).' => 'Отправка сообщения немедленно (минуя очередь).',
    'Log events deleted.'                            => 'События журнала удалены.',
    'notification'                                   => 'уведомление',

    // Outbound: Email log messages
    'Unable to send email, no recipient specified.'     => 'Невозможно отправить письмо: получатель не указан.',
    'Unable to send email, the message body was empty.' => 'Невозможно отправить письмо: тело сообщения пустое.',
    "Unable to send the email using Craft's native email handling." => 'Невозможно отправить письмо через встроенный почтовый обработчик Craft.',
    'Check your general email settings within Craft.'   => 'Проверьте общие настройки почты в Craft.',
    'Successfully sent email message!'                  => 'Письмо успешно отправлено!',

    // Outbound: SMS log messages
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[Неверные учётные данные Twilio.]({url}) Отсутствует {missing}.',
    'Unable to send SMS, no Twilio phone number exists.'      => 'Невозможно отправить SMS, нет номера телефона Twilio.',
    'Unable to send SMS, no recipient phone number exists.'   => 'Невозможно отправить SMS, нет номера телефона получателя.',
    'Unable to send SMS, recipient phone number is invalid.'  => 'Невозможно отправить SMS, номер телефона получателя недействителен.',
    'Successfully sent SMS message!'                          => 'SMS-сообщение успешно отправлено!',

    // Outbound: Announcement log messages
    'Unable to post announcement, no recipient userId specified.' => 'Невозможно опубликовать объявление: userId получателя не указан.',
    'Successfully posted announcement!' => 'Объявление успешно опубликовано!',

    // Outbound: Flash log messages
    'Unable to send the flash message, invalid flash type.' => 'Невозможно отправить flash-сообщение: недействительный flash-тип.',
    'Successfully sent flash message!'                      => 'Flash-сообщение успешно отправлено!',

    // Outbound: Pushover log messages
    '[Invalid Pushover credentials.]({url}) Missing app token.'  => '[Неверные учётные данные Pushover.]({url}) Отсутствует токен приложения.',
    'Unable to send Pushover message, no user key on recipient.' => 'Невозможно отправить сообщение Pushover: у получателя нет пользовательского ключа.',
    'Pushover POST failed: {reason}'                             => 'Pushover POST не удался: {reason}',
    'Successfully sent Pushover message!'                        => 'Сообщение Pushover успешно отправлено!',

    // Outbound: ntfy log messages
    'Unable to send ntfy message, no server URL configured.' => 'Невозможно отправить сообщение ntfy: URL сервера не настроен.',
    'Unable to send ntfy message, no topic specified.'       => 'Невозможно отправить сообщение ntfy: тема не указана.',
    'ntfy POST failed with HTTP {status}: {reason}'          => 'ntfy POST не удался с HTTP {status}: {reason}',
    'ntfy POST failed: {reason}'                             => 'ntfy POST не удался: {reason}',
    'Successfully sent ntfy message to topic "{topic}".'     => 'Сообщение ntfy успешно отправлено в тему "{topic}".',

    // Outbound: Slack log messages
    'Unable to send Slack message, no webhook URL.' => 'Невозможно отправить сообщение Slack: нет URL webhook.',
    'Unable to send Slack message, webhook URL is not valid.' => 'Невозможно отправить сообщение Slack: URL webhook недействителен.',
    'Unable to send Slack message, body is empty.'  => 'Невозможно отправить сообщение Slack: тело пустое.',
    'Slack POST failed (HTTP {status}): {reason}'   => 'Slack POST не удался (HTTP {status}): {reason}',
    'Slack POST failed: {reason}'                   => 'Slack POST не удался: {reason}',
    'Successfully sent Slack message to "{label}".' => 'Сообщение Slack успешно отправлено в "{label}".',

    // Outbound: Bluesky log messages
    'Unable to send Bluesky post, recipient is missing credentials.' => 'Невозможно отправить пост Bluesky: у получателя нет учётных данных.',
    'Body exceeded {max} characters, truncated.'          => 'Тело превысило {max} символов и было обрезано.',
    'Successfully posted to Bluesky as "{label}".'        => 'Опубликовано в Bluesky как "{label}".',
    'Bluesky auth failed for {handle}: {reason}'          => 'Аутентификация Bluesky не удалась для {handle}: {reason}',
    'Bluesky auth failed: {reason}'                       => 'Аутентификация Bluesky не удалась: {reason}',
    'Bluesky post failed: {reason}'                       => 'Публикация в Bluesky не удалась: {reason}',
    'Bluesky link preview skipped: {reason}'              => 'Предпросмотр ссылки Bluesky пропущен: {reason}',

    // Recipient-strategy warnings
    'Recipient "{name}" has no email address.'       => 'У получателя "{name}" нет адреса электронной почты.',
    'Recipient "{name}" has no phone number.'        => 'У получателя "{name}" нет номера телефона.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => 'У получателя "{name}" нет связанного пользователя; объявление невозможно отправить.',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => 'У получателя "{name}" нет доступа к панели управления; объявление невозможно отправить.',
    'Pushover user-key field is not configured on this notification.' => 'Поле пользовательского ключа Pushover не настроено в этом уведомлении.',
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => 'У получателя "{name}" нет связанного пользователя; сообщение Pushover невозможно отправить.',
    '[SKIPPED] User "{name}" has no Pushover key.'   => '[ПРОПУЩЕНО] У пользователя "{name}" нет ключа Pushover.',
    'Recipient "{name}" has no ntfy topic.'          => 'У получателя "{name}" нет темы ntfy.',
    'Recipient "{name}" has no Slack webhook URL.'   => 'У получателя "{name}" нет URL webhook Slack.',
    'Recipient "{name}" has no Bluesky credentials.' => 'У получателя "{name}" нет учётных данных Bluesky.',

    // Errors / exceptions
    'Invalid element event: {class}'                         => 'Недействительное событие элемента: {class}',
    'Invalid notification ID: {id}'                          => 'Недействительный ID уведомления: {id}',
    'Invalid email message mode.'                            => 'Недействительный режим электронного письма.',
    'You do not have permission to use the Dynamic Recipients type.' => 'У вас нет разрешения на использование типа «Динамические получатели».',
    'Dynamic recipients snippet did not call setRecipients.' => 'Сниппет динамических получателей не вызвал setRecipients.',
    'setRecipients was called with an empty value.'          => 'setRecipients вызван с пустым значением.',
    'Unrecognized recipient of type "{type}".'               => 'Нераспознанный получатель типа "{type}".',
    'Unrecognized recipient "{value}".'                      => 'Нераспознанный получатель "{value}".',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => 'Настроенный {kind} больше не существует в настройках плагина (uid: {uid}).',
    'Invalid settings section: {section}'                    => 'Недопустимый раздел настроек: {section}',
    'User not authorized to save this notification.'         => 'Пользователю запрещено сохранять это уведомление.',
    'User not authorized to view this notification.'         => 'Пользователю запрещено просматривать это уведомление.',
    'User not authorized to delete this notification.'       => 'Пользователю запрещено удалять это уведомление.',
    'Notification not found'                                 => 'Уведомление не найдено',

    // Misc config-file note
    'This is being set in the config file. [{file}]' => 'Это задано в файле конфигурации. [{file}]',

    // Slack, ntfy, and Bluesky message types
    "Add the Bluesky accounts you'd like to post from. Each account becomes available as a recipient on the **Recipients** tab when configuring a notification." => 'Добавьте аккаунты Bluesky, от имени которых вы хотите публиковать. Каждый аккаунт становится доступен как получатель на вкладке **Получатели** при настройке уведомления.',
    "Click any row's **Test** button to confirm the account authenticates." => 'Нажмите кнопку **Test** в любой строке, чтобы убедиться, что аккаунт проходит аутентификацию.',
    "Add an [Incoming Webhook](https://api.slack.com/messaging/webhooks) for each Slack channel you'd like to post into. Each webhook becomes available as a recipient on the **Recipients** tab when configuring a notification. A webhook URL is a secret, so store it in a `.env` variable and reference that variable (e.g. `\$SLACK_WEBHOOK_URL`) rather than pasting the URL directly." => 'Добавьте [Incoming Webhook](https://api.slack.com/messaging/webhooks) для каждого канала Slack, в который вы хотите публиковать. Каждый webhook становится доступен как получатель на вкладке **Получатели** при настройке уведомления. URL webhook является секретом, поэтому храните его в переменной `.env` и ссылайтесь на эту переменную (например, `$SLACK_WEBHOOK_URL`), а не вставляйте URL напрямую.',
    "Click any row's **Test** button to send a quick test message to that channel." => 'Нажмите кнопку **Test** в любой строке, чтобы отправить быстрое тестовое сообщение в этот канал.',
    'Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`.' => 'Необязательно, укажите свою ntfy-инстанцию (если применимо). По умолчанию `https://ntfy.sh`.',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Необязательно, требуется для защищённых тем или self-hosted инстанций с авторизацией.',
    'Add the ntfy topics you\'d like to send messages to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification.' => 'Добавьте темы ntfy, в которые вы хотите отправлять сообщения. Каждая тема становится доступна как получатель на вкладке **Получатели** при настройке уведомления.',
    "Click any row's **Test** button to send a quick test message to that topic." => 'Нажмите кнопку **Test** в любой строке, чтобы отправить быстрое тестовое сообщение в эту тему.',
    'Enable Markdown' => 'Включить Markdown',
    'Link URL' => 'URL ссылки',
    'Not a valid Webhook URL. Must start with https://hooks.slack.com/services/' => 'Недействительный URL webhook. Должен начинаться с https://hooks.slack.com/services/',

    // Manual triggers
    'Send Notification'                                            => 'Отправить уведомление',
    'Send manual notifications'                                    => 'Отправлять уведомления вручную',
    'Are you sure you want to send this notification?'             => 'Вы уверены, что хотите отправить это уведомление?',
    'This notification cannot be triggered manually.'              => 'Это уведомление нельзя запустить вручную.',
    'This notification no longer applies to the selected element.' => 'Это уведомление больше не применяется к выбранному элементу.',
    'Notification sent.'                                           => 'Уведомление отправлено.',
    'Element not found'                                            => 'Элемент не найден',
    'Manual Trigger Label'                                         => 'Метка ручного триггера',
    'An element action label (helps to differentiate multiple manual triggers).' => 'Метка действия элемента (помогает различать несколько ручных триггеров).',
];
