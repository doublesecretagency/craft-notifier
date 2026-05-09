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
    'View Notifications'     => 'Просмотреть уведомления',
    'Add a New Notification' => 'Добавить новое уведомление',

    // Permissions
    'View notifications'              => 'Просмотр уведомлений',
    'Save notifications'              => 'Сохранение уведомлений',
    'Use the Dynamic Recipients type' => 'Использование типа «Динамические получатели»',
    'Test notifications'              => 'Тестировать уведомления',
    'Delete notifications'            => 'Удаление уведомлений',
    'View notification log'           => 'Просмотр журнала уведомлений',
    'Delete notification log'         => 'Удаление журнала уведомлений',

    // Notification editor: tabs
    'Meta'       => 'Мета',
    'Event'      => 'Событие',
    'Message'    => 'Сообщение',
    'Recipients' => 'Получатели',

    // Event tab
    'Event Type'                                           => 'Тип события',
    'What type of event will activate the notification?'   => 'Какой тип события активирует уведомление?',
    'Which specific event will activate the notification?' => 'Какое конкретное событие активирует уведомление?',
    'Assets Event'                                         => 'Событие ресурса',
    'Commerce Orders Event'                                => 'Событие заказа Commerce',
    'Entries Event'                                        => 'Событие записи',
    'Users Event'                                          => 'Событие пользователя',

    // Field and element conditions
    'Field Conditions'                                                               => 'Условия поля',
    'Send the message only when the saved element matches the following conditions.' => 'Отправлять сообщение только при соответствии сохранённого элемента следующим условиям.',
    'has changed'                                                                    => 'изменилось',
    '#{elementType} Event Filters'                                                   => 'Фильтры событий #{elementType}',
    'No filters match this event.'                                                   => 'Нет фильтров, соответствующих этому событию.',
    'Determine whether each message should be sent based on specified conditions.'   => 'Определите, нужно ли отправлять каждое сообщение, на основании заданных условий.',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => 'Элемент сохраняется впервые',
    'Must be a new entry'                       => 'Должна быть новая запись',
    'Must be an existing entry'                 => 'Должна быть существующая запись',
    'Can be existing or new'                    => 'Может быть существующей или новой',

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
    'Element is a draft'          => 'Элемент является черновиком',
    'Must be a draft'             => 'Должен быть черновиком',
    'Must not be a draft'         => 'Не должен быть черновиком',
    'Can be a draft or non-draft' => 'Может быть черновиком или нет',

    // Filters: provisional drafts
    'Element is a provisional draft'                => 'Элемент является временным черновиком',
    'Must be a provisional draft'                   => 'Должен быть временным черновиком',
    'Must not be a provisional draft'               => 'Не должен быть временным черновиком',
    'Can be a provisional draft or non-provisional' => 'Может быть временным или нет',

    // Filters: revisions
    'Element is a revision'             => 'Элемент является редакцией',
    'Must be a revision'                => 'Должен быть редакцией',
    'Must not be a revision'            => 'Не должен быть редакцией',
    'Can be a revision or non-revision' => 'Может быть редакцией или нет',

    // Filters: duplication
    'Element is being duplicated'         => 'Элемент дублируется',
    'Must be duplicating the element'     => 'Должен дублировать элемент',
    'Must not be duplicating the element' => 'Не должен дублировать элемент',

    // Filters: propagation
    'Element is being propagated'     => 'Элемент распространяется',
    'Element must be propagating'     => 'Элемент должен распространяться',
    'Element must not be propagating' => 'Элемент не должен распространяться',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => 'Элемент пересохраняется в массовой операции',
    'Must be bulk-resaving the element'     => 'Должен пересохранять элемент в массовой операции',
    'Must not be bulk-resaving the element' => 'Не должен пересохранять элемент в массовой операции',

    // Filters: common output
    'Unnamed filter'                => 'Безымянный фильтр',
    'Must be TRUE to send message'  => 'Должно быть TRUE для отправки сообщения',
    'Must be FALSE to send message' => 'Должно быть FALSE для отправки сообщения',
    'No effect'                     => 'Без эффекта',

    // Message tab: type selector and queue
    'Message Type'                                                 => 'Тип сообщения',
    'What type of message will be sent?'                           => 'Какой тип сообщения будет отправлен?',
    'Send Message via Queue'                                       => 'Отправлять сообщение через очередь',
    'Should the message be sent via the [jobs queue]({queueUrl})?' => 'Отправлять сообщение через [очередь задач]({queueUrl})?',

    // Email message
    'Email Subject'              => 'Тема письма',
    'Email Body'                 => 'Текст письма',
    "User's Email Address Field" => 'Поле адреса электронной почты пользователя',

    // SMS message
    'SMS Message Body'          => 'Текст SMS-сообщения',
    "User's Phone Number Field" => 'Поле номера телефона пользователя',

    // Announcement message
    'Announcement Title'   => 'Заголовок объявления',
    'Announcement Message' => 'Текст объявления',

    // Flash message
    'Flash Message Type'                         => 'Тип flash-сообщения',
    'Flash Message Title'                        => 'Заголовок flash-сообщения',
    'Flash Message Details'                      => 'Подробности flash-сообщения',
    'Which type of flash message should appear?' => 'Какой тип flash-сообщения должен появляться?',

    // Trix toolbar (rich-text editing)
    'Rich Text'     => 'Форматированный текст',
    'Bold'          => 'Полужирный',
    'Italic'        => 'Курсив',
    'Underline'     => 'Подчёркнутый',
    'Strikethrough' => 'Зачёркнутый',
    'Bullets'       => 'Маркированный список',
    'Numbers'       => 'Нумерованный список',
    'Heading'       => 'Заголовок',
    'Code'          => 'Код',
    'Undo'          => 'Отменить',
    'Redo'          => 'Повторить',

    // Email body instructions (HTML)
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => 'Текст исходящего письма. Можно использовать <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">специальные переменные</a> или даже <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">пропустить получателей</a>.',

    // Recipients tab
    'Recipients Type'                             => 'Тип получателей',
    'Who will receive this message?'              => 'Кто получит это сообщение?',
    'Add a message recipient'                     => 'Добавить получателя',
    'Select User(s)'                              => 'Выберите пользователя или пользователей',
    'Which users will receive the message?'       => 'Какие пользователи получат сообщение?',
    'Which user groups will receive the message?' => 'Какие группы пользователей получат сообщение?',
    'Ungrouped Users'                             => 'Пользователи без группы',
    'Twig Snippet to Determine Recipients'        => 'Twig-фрагмент для определения получателей',

    // Settings: Twilio
    'Twilio Account SID'                             => 'Twilio Account SID',
    'Twilio Auth Token'                              => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)'   => 'Номер телефона Twilio (отправляет каждое SMS-сообщение)',
    'This is being set in the config file. [{file}]' => 'Задаётся в конфигурационном файле. [{file}]',

    // Settings: Logging
    'Logging'                                                                                                                                         => 'Журналирование',
    'Enable Logging'                                                                                                                                  => 'Включить журналирование',
    'When disabled, Notifier will not write anything to the notification log.'                                                                        => 'Когда отключено, Notifier ничего не записывает в журнал уведомлений.',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier ведёт постоянный журнал отправленных сообщений. Это, как правило, не обязательно, но вы можете ограничить количество записей журнала в базе данных.',
    'Number of log events to retain'                                                                                                                  => 'Количество записей журнала для хранения',
    'At most, keep this many log events. Leave blank for no limit.'                                                                                   => 'Хранить не более этого количества записей журнала. Оставьте пустым, чтобы не ограничивать.',
    'Number of days to retain log events'                                                                                                             => 'Количество дней хранения записей журнала',
    'At most, keep log events for this many days. Leave blank for no limit.'                                                                          => 'Хранить записи журнала не дольше этого количества дней. Оставьте пустым, чтобы не ограничивать.',

    // Test notification
    'Send a test message'                                                                                                          => 'Отправить тестовое сообщение',
    'Are you certain you want to send a test notification?\n\nThe configured message will be sent to the configured recipient(s).' => 'Вы уверены, что хотите отправить тестовое уведомление?\n\nНастроенное сообщение будет отправлено настроенным получателям.',
    'Test'                                                                                                                         => 'Тест',
    'Test notification dispatched.'                                                                                                => 'Тестовое уведомление отправлено.',
    'No messages were dispatched. Check the recipient configuration.'                                                              => 'Сообщения не были отправлены. Проверьте конфигурацию получателей.',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.' => 'Отправка {messageType} получателю {recipient}.',
    'Log events deleted.'                   => 'Записи журнала удалены.',
    'notification'                          => 'уведомление',

    // Errors
    'Invalid email message mode.'                                    => 'Недопустимый режим электронного сообщения.',
    'Dynamic recipients snippet did not call setRecipients.'         => 'Фрагмент динамических получателей не вызвал setRecipients.',
    'setRecipients was called with an empty value.'                  => 'setRecipients был вызван с пустым значением.',
    'Unrecognized recipient "{value}".'                              => 'Неизвестный получатель «{value}».',
    'Unrecognized recipient of type "{type}".'                       => 'Неизвестный получатель типа «{type}».',
    'Recipient "{name}" has no email address.'                       => 'У получателя «{name}» нет адреса электронной почты.',
    'Recipient "{name}" has no phone number.'                        => 'У получателя «{name}» нет номера телефона.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => 'У получателя «{name}» нет связанного пользователя; объявление не может быть отправлено.',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => 'У получателя «{name}» нет доступа к панели управления; объявление не может быть отправлено.',
    'You do not have permission to use the Dynamic Recipients type.' => 'У вас нет прав на использование типа «Динамические получатели».',

];
