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
    'Notifications'          => '通知',
    'Notification'           => '通知',
    'All notifications'      => '所有通知',
    'Notification Log'       => '通知日志',
    'Logs'                   => '日志',
    'View Notifications'     => '查看通知',
    'Add a New Notification' => '添加新通知',

    // Permissions
    'View notifications'              => '查看通知',
    'Save notifications'              => '保存通知',
    'Use the Dynamic Recipients type' => '使用动态收件人类型',
    'Test notifications'              => '测试通知',
    'Delete notifications'            => '删除通知',
    'View notification log'           => '查看通知日志',
    'Delete notification log'         => '删除通知日志',

    // Notification editor: tabs
    'Meta'       => '元数据',
    'Event'      => '事件',
    'Message'    => '消息',
    'Recipients' => '收件人',

    // Event tab
    'Event Type'                                           => '事件类型',
    'What type of event will activate the notification?'   => '哪种类型的事件会触发通知?',
    'Which specific event will activate the notification?' => '哪个具体事件会触发通知?',
    'Assets Event'                                         => '资源事件',
    'Commerce Orders Event'                                => 'Commerce 订单事件',
    'Entries Event'                                        => '条目事件',
    'Users Event'                                          => '用户事件',

    // Field and element conditions
    'Field Conditions'                                                               => '字段条件',
    'Send the message only when the saved element matches the following conditions.' => '仅当保存的元素满足以下条件时发送消息。',
    'has changed'                                                                    => '已更改',
    '#{elementType} Event Filters'                                                   => '#{elementType} 事件筛选器',
    'No filters match this event.'                                                   => '没有筛选器匹配此事件。',
    'Determine whether each message should be sent based on specified conditions.'   => '根据指定的条件决定是否发送每条消息。',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => '元素正在被首次保存',
    'Must be a new entry'                       => '必须为新条目',
    'Must be an existing entry'                 => '必须为现有条目',
    'Can be existing or new'                    => '可为现有或新条目',

    // Filters: new elements
    'Element is new'         => '元素是新的',
    'New elements only'      => '仅新元素',
    'Existing elements only' => '仅现有元素',

    // Filters: enabled state
    'Element is enabled'         => '元素已启用',
    'Must be enabled'            => '必须启用',
    'Must be disabled'           => '必须禁用',
    'Can be enabled or disabled' => '可启用或禁用',

    // Filters: drafts
    'Element is a draft'          => '元素是草稿',
    'Must be a draft'             => '必须为草稿',
    'Must not be a draft'         => '不能为草稿',
    'Can be a draft or non-draft' => '可为草稿或非草稿',

    // Filters: provisional drafts
    'Element is a provisional draft'                => '元素是临时草稿',
    'Must be a provisional draft'                   => '必须为临时草稿',
    'Must not be a provisional draft'               => '不能为临时草稿',
    'Can be a provisional draft or non-provisional' => '可为临时或非临时',

    // Filters: revisions
    'Element is a revision'             => '元素是修订',
    'Must be a revision'                => '必须为修订',
    'Must not be a revision'            => '不能为修订',
    'Can be a revision or non-revision' => '可为修订或非修订',

    // Filters: duplication
    'Element is being duplicated'         => '元素正在被复制',
    'Must be duplicating the element'     => '必须正在复制该元素',
    'Must not be duplicating the element' => '不能正在复制该元素',

    // Filters: propagation
    'Element is being propagated'     => '元素正在被传播',
    'Element must be propagating'     => '元素必须正在传播',
    'Element must not be propagating' => '元素不能正在传播',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => '元素正在被批量重新保存',
    'Must be bulk-resaving the element'     => '必须正在批量重新保存该元素',
    'Must not be bulk-resaving the element' => '不能正在批量重新保存该元素',

    // Filters: common output
    'Unnamed filter'                => '未命名筛选器',
    'Must be TRUE to send message'  => '必须为 TRUE 才能发送消息',
    'Must be FALSE to send message' => '必须为 FALSE 才能发送消息',
    'No effect'                     => '无效果',

    // Message tab: type selector and queue
    'Message Type'                                                 => '消息类型',
    'What type of message will be sent?'                           => '将发送哪种类型的消息?',
    'Send Message via Queue'                                       => '通过队列发送消息',
    'Should the message be sent via the [jobs queue]({queueUrl})?' => '是否通过[任务队列]({queueUrl})发送消息?',

    // Email message
    'Email Subject'              => '邮件主题',
    'Email Body'                 => '邮件正文',
    "User's Email Address Field" => '用户的电子邮件地址字段',

    // SMS message
    'SMS Message Body'          => '短信消息正文',
    "User's Phone Number Field" => '用户的电话号码字段',

    // Announcement message
    'Announcement Title'   => '公告标题',
    'Announcement Message' => '公告内容',

    // Flash message
    'Flash Message Type'                         => 'Flash 消息类型',
    'Flash Message Title'                        => 'Flash 消息标题',
    'Flash Message Details'                      => 'Flash 消息详情',
    'Which type of flash message should appear?' => '应显示哪种类型的 Flash 消息?',

    // Trix toolbar (rich-text editing)
    'Rich Text'     => '富文本',
    'Bold'          => '加粗',
    'Italic'        => '斜体',
    'Underline'     => '下划线',
    'Strikethrough' => '删除线',
    'Bullets'       => '项目符号',
    'Numbers'       => '编号列表',
    'Heading'       => '标题',
    'Code'          => '代码',
    'Undo'          => '撤销',
    'Redo'          => '重做',

    // Email body instructions (HTML)
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => '发送邮件的正文。您可以使用<a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">特殊变量</a>,甚至可以<a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">跳过收件人</a>。',

    // Recipients tab
    'Recipients Type'                             => '收件人类型',
    'Who will receive this message?'              => '谁将接收此消息?',
    'Add a message recipient'                     => '添加收件人',
    'Select User(s)'                              => '选择用户',
    'Which users will receive the message?'       => '哪些用户将接收此消息?',
    'Which user groups will receive the message?' => '哪些用户组将接收此消息?',
    'Restricted to Admins Only?'                  => '仅限管理员吗?',
    'Ungrouped Users'                             => '未分组的用户',
    'Twig Snippet to Determine Recipients'        => '用于确定收件人的 Twig 代码段',

    // Settings: Twilio
    'Twilio Account SID'                             => 'Twilio Account SID',
    'Twilio Auth Token'                              => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)'   => 'Twilio 电话号码(发送每条短信消息)',
    'This is being set in the config file. [{file}]' => '在配置文件中设置。[{file}]',

    // Settings: Logging
    'Logging'                                                                                                                                         => '日志记录',
    'Enable Logging'                                                                                                                                  => '启用日志记录',
    'When disabled, Notifier will not write anything to the notification log.'                                                                        => '禁用时,Notifier 不会向通知日志写入任何内容。',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier 持续记录已发送消息的日志。虽然通常不必,但您可以限制数据库中记录的日志事件数量。',
    'Number of log events to retain'                                                                                                                  => '要保留的日志事件数量',
    'At most, keep this many log events. Leave blank for no limit.'                                                                                   => '最多保留这么多日志事件。留空表示不限制。',
    'Number of days to retain log events'                                                                                                             => '保留日志事件的天数',
    'At most, keep log events for this many days. Leave blank for no limit.'                                                                          => '最多保留日志事件这么多天。留空表示不限制。',

    // Test notification
    'Send a test message'                                                                                                          => '发送测试消息',
    'Are you certain you want to send a test notification?\n\nThe configured message will be sent to the configured recipient(s).' => '确定要发送测试通知吗?\n\n配置的消息将发送给已配置的收件人。',
    'Test'                                                                                                                         => '测试',
    'Test notification dispatched.'                                                                                                => '测试通知已发送。',
    'No messages were dispatched. Check the recipient configuration.'                                                              => '未发送任何消息。请检查收件人配置。',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.' => '正在向 {recipient} 发送 {messageType}。',
    'Log events deleted.'                   => '已删除日志事件。',
    'notification'                          => '通知',

    // Errors
    'Invalid email message mode.'                                    => '无效的电子邮件消息模式。',
    'Dynamic recipients snippet did not call setRecipients.'         => '动态收件人代码段未调用 setRecipients。',
    'setRecipients was called with an empty value.'                  => 'setRecipients 以空值被调用。',
    'Unrecognized recipient "{value}".'                              => '无法识别的收件人 "{value}"。',
    'Unrecognized recipient of type "{type}".'                       => '无法识别的 "{type}" 类型收件人。',
    'Recipient "{name}" has no email address.'                       => '收件人 "{name}" 没有电子邮件地址。',
    'Recipient "{name}" has no phone number.'                        => '收件人 "{name}" 没有电话号码。',
    'You do not have permission to use the Dynamic Recipients type.' => '您没有使用动态收件人类型的权限。',

];
