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
    'Notifications' => '通知',
    'Notification' => '通知',
    'All notifications' => '所有通知',
    'Notification Log' => '通知日志',
    'Logs' => '日志',
    'View Notifications' => '查看通知',
    'Add a New Notification' => '添加新通知',
    'notification' => '通知',

    // Permissions
    'View notifications' => '查看通知',
    'Adds "Notifications" to the control panel navigation.' => '在控制面板导航中添加"通知"。',
    'Save notifications' => '保存通知',
    'Edit the Event tab' => '编辑“事件”选项卡',
    'Edit the Message tab' => '编辑“消息”选项卡',
    'Edit the Recipients tab' => '编辑“收件人”选项卡',
    'Use the Dynamic Recipients type' => '使用动态收件人类型',
    'Use the Dynamic Data type' => '使用动态数据类型',
    'Send test notifications' => '发送测试通知',
    'Send manual notifications' => '发送手动通知',
    'Delete notifications' => '删除通知',
    'View notification log' => '查看通知日志',
    'Adds "Notification Log" to the control panel Utilities.' => '在控制面板实用工具中添加"通知日志"。',
    'Delete notification log' => '删除通知日志',
    'Runs custom Twig code when a message is sent. Only grant this to highly trusted users!' => '发送消息时运行自定义 Twig 代码。请仅向高度信任的用户授予此权限！',

    // ========================================================
    // NOTIFICATION EDITOR
    // ========================================================

    // Editor: tabs
    'Meta' => '元信息',
    'Event' => '事件',
    'Message' => '消息',
    'Recipients' => '收件人',

    // Event tab: type selector
    'Event Type' => '事件类型',
    'What type of event will activate the notification?' => '什么类型的事件将激活此通知?',
    'Which specific event will activate the notification?' => '哪个具体事件将激活此通知?',

    // Event tab: event types
    'Assets Event' => '资源事件',
    'Commerce Orders Event' => 'Commerce 订单事件',
    'Commerce Products Event' => 'Commerce 产品事件',
    'Digital Products Event' => 'Digital Products 事件',
    'Digital Product Licenses Event' => 'Digital Products 许可证事件',
    'Solspace Calendar Event' => 'Solspace Calendar 事件',
    'Entries Event' => '条目事件',
    'Users Event' => '用户事件',
    'Ungrouped Users' => '未分组用户',

    // Event tab: Formie
    'Submission Outcome' => '提交结果',
    'Trigger based on the success or failure of a submission.' => '根据提交的成功或失败进行触发。',
    'Successful submissions only' => '仅成功的提交',
    'Failed submissions only' => '仅失败的提交',
    'All submissions' => '所有提交',

    // Event tab: Feed
    'Feed URL' => 'Feed URL',
    'The URL of the RSS, Atom, or JSON feed to watch.' => '要监控的 RSS、Atom 或 JSON Feed 的 URL。',
    'Feed Timeout' => 'Feed 超时',
    'How long to wait when the feed is loading slowly. Default {default} seconds, max {max}.' => 'Feed 加载缓慢时等待的时长。默认 {default} 秒，最大 {max}。',
    'seconds' => '秒',

    // Event tab: field conditions
    'Field Conditions' => '字段条件',
    'Send the message only when the saved element matches the following conditions.' => '仅在保存的元素符合以下条件时发送消息。',
    'has changed' => '已更改',

    // Event tab: element filters (panel chrome + common output)
    '#{elementType} Event Filters' => '#{elementType} 事件筛选条件',
    'No filters match this event.' => '没有筛选条件匹配此事件。',
    'Determine whether each message should be sent based on specified conditions.' => '根据指定的条件确定是否发送每条消息。',
    'Unnamed filter' => '未命名筛选条件',
    'Must be TRUE to send message' => '必须为 TRUE 才能发送消息',
    'Must be FALSE to send message' => '必须为 FALSE 才能发送消息',
    'No effect' => '无效',

    // Event tab: element filter rules
    'Element is being saved for the first time' => '元素正在首次保存',
    'Must be a new entry' => '必须是新条目',
    'Must be an existing entry' => '必须是现有条目',
    'Can be existing or new' => '可以是现有或新的',
    'Element is new' => '元素是新的',
    'New elements only' => '仅限新元素',
    'Existing elements only' => '仅限现有元素',
    'Element is enabled' => '元素已启用',
    'Must be enabled' => '必须启用',
    'Must be disabled' => '必须禁用',
    'Can be enabled or disabled' => '可以启用或禁用',
    'Element is a draft' => '元素是草稿',
    'Must be a draft' => '必须是草稿',
    'Must not be a draft' => '不得为草稿',
    'Can be a draft or non-draft' => '可以是草稿或非草稿',
    'Element is a provisional draft' => '元素是临时草稿',
    'Must be a provisional draft' => '必须是临时草稿',
    'Must not be a provisional draft' => '不得为临时草稿',
    'Can be a provisional draft or non-provisional' => '可以是临时草稿或非临时草稿',
    'Element is a revision' => '元素是版本',
    'Must be a revision' => '必须是版本',
    'Must not be a revision' => '不得为版本',
    'Can be a revision or non-revision' => '可以是版本或非版本',
    'Element is being duplicated' => '元素正在被复制',
    'Must be duplicating the element' => '必须正在复制元素',
    'Must not be duplicating the element' => '不得正在复制元素',
    'Element is being propagated' => '元素正在传播',
    'Element must be propagating' => '元素必须正在传播',
    'Element must not be propagating' => '元素不得正在传播',
    'Element is being bulk-resaved' => '元素正在批量重新保存',
    'Must be bulk-resaving the element' => '必须正在批量重新保存元素',
    'Must not be bulk-resaving the element' => '不得正在批量重新保存元素',

    // Event tab: date trigger
    'On' => '当天',
    'days before' => '天前',
    'days after' => '天后',
    'Relevant Date' => '相关日期',
    'Send the notification relative to a chosen date.' => '相对于选定日期发送通知。',

    // Event tab: recurring schedule
    'Every' => '每',
    'on' => '在',
    'on day' => '在每月',
    'at' => '在',
    'Starting on' => '开始日期',
    'Day' => '星期',
    'Date' => '日期',
    'Time' => '时间',
    'day(s)' => '天',
    'week(s)' => '周',
    'month(s)' => '个月',
    'year(s)' => '年',
    'day' => '天',
    'days' => '天',
    'week' => '周',
    'weeks' => '周',
    'month' => '个月',
    'months' => '个月',
    'year' => '年',
    'years' => '年',
    'Manual only' => '仅手动',
    'Scheduled sending' => '计划发送',
    'Generate report on a recurring schedule' => '按重复计划生成报告',
    'Generate report on demand' => '按需生成报告',
    'Send on a Recurring Schedule' => '按重复计划发送',
    'Configure Recurring Schedule' => '配置重复计划',
    'System timezone set to {timezone}' => '系统时区设置为 {timezone}',
    'Notifications will be sent on the following schedule...' => '通知将按以下计划发送...',
    '... and every {cadence} after that.' => '... 此后每 {cadence} 发送一次。',
    'On what recurring schedule should the notification be sent?' => '应按什么重复计划发送通知？',
    'Whether the message should be sent on a schedule, or only triggered manually.' => '消息是按计划发送，还是仅手动触发。',
    'The message can always be sent using the "Send system snapshot" button above.' => '始终可以使用上方的“发送系统快照”按钮发送该消息。',
    'The message can always be sent using the "Send data report" button above.' => '始终可以使用上方的“发送数据报告”按钮发送该消息。',

    // Event tab: Dynamic Data snippet field
    'Twig Snippet to Determine Data' => '用于确定数据的 Twig 代码片段',
    'Enter a custom Twig snippet to [determine which data will be included]({url}).' => '输入自定义 Twig 代码片段以[确定将包含哪些数据]({url})。',
    'The snippet **must** include a `{% setData %}` tag.' => '代码片段**必须**包含 `{% setData %}` 标签。',
    'You do not have permission to edit dynamic data.' => '您没有编辑动态数据的权限。',

    // Event tab: manual trigger
    'Trigger Label' => '触发标签',
    'An element action label (helps to differentiate multiple triggers).' => '元素操作标签（有助于区分多个触发）。',
    'Send Notification' => '发送通知',

    // Message tab: type selector
    'Message Type' => '消息类型',
    'What type of message will be sent?' => '将发送什么类型的消息?',
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are supported.' => '支持[模板]({templatingUrl})和[特殊变量]({variablesUrl})。',

    // Details sidebar: queue
    'Use Queue' => '使用队列',
    'Immediate' => '立即',
    'Queue' => '队列',
    'jobs queue' => '任务队列',
    'Whether the message will be sent immediately, or added to the {link}.' => '消息是立即发送，还是添加到{link}。',
    'Flash messages never use the queue.' => 'Flash 消息从不使用队列。',
    'Announcements always use the queue.' => '公告始终使用队列。',

    // Message tab: Email
    "User's Email Address Field" => '用户的电子邮件地址字段',
    'Select which User field contains the recipient\'s email address.' => '选择包含收件人电子邮件地址的用户字段。',
    'Email Subject' => '邮件主题',
    'Subject line of the email.' => '电子邮件主题。',
    'Dynamic Subject Line' => '动态主题行',
    'Email Body' => '邮件正文',
    'Body of the email. Supports HTML.' => '电子邮件正文。支持 HTML。',

    // Message tab: rich-text (Trix) toolbar
    'Rich Text' => '富文本',
    'Bold' => '粗体',
    'Italic' => '斜体',
    'Underline' => '下划线',
    'Strikethrough' => '删除线',
    'Bullets' => '项目符号',
    'Numbers' => '编号',
    'Heading' => '标题',
    'Code' => '代码',
    'Undo' => '撤销',
    'Redo' => '重做',

    // Message tab: SMS
    "User's Phone Number Field" => '用户的电话号码字段',
    'Select which User field contains the recipient\'s phone number.' => '选择包含收件人电话号码的用户字段。',
    'SMS Message Body' => '短信内容',
    'Body of the SMS (text message). Plain text only.' => 'SMS(短信)正文。仅纯文本。',

    // Message tab: Announcement
    'Announcement Title' => '公告标题',
    'Heading of the announcement.' => '公告的标题。',
    'Dynamic Announcement Title' => '动态公告标题',
    'Announcement Message' => '公告消息',
    'Body of the announcement. Supports Markdown.' => '公告的正文。支持 Markdown。',

    // Message tab: Flash
    'Flash Message Type' => '闪现消息类型',
    'Which type of flash message should appear?' => '应显示什么类型的闪现消息?',
    'Flash Message Title' => '闪现消息标题',
    'Heading of the flash message.' => 'Flash 消息的标题。',
    'Dynamic Flash Message Title' => '动态 Flash 消息标题',
    'Flash Message Details' => '闪现消息详情',
    'Optionally include details below the heading. Supports Markdown and HTML.' => '可选在标题下方添加详细信息。支持 Markdown 和 HTML。',

    // Message tab: Pushover
    "Field containing each user's Pushover key" => '用户的 Pushover 密钥字段',
    'Select which User field contains the recipient\'s Pushover user key.' => '选择包含收件人 Pushover 密钥的用户字段。',
    'Pushover Title' => 'Pushover 标题',
    'Optionally include a heading above the body.' => '可选在正文上方添加标题。',
    'Dynamic Pushover Title' => '动态 Pushover 标题',
    'Pushover Body' => 'Pushover 正文',
    'Body of the Pushover notification. Plain text only.' => 'Pushover 通知的正文。仅纯文本。',

    // Message tab: ntfy
    'Priority' => '优先级',
    'Priority level of the ntfy message.' => 'ntfy 消息的优先级。',
    'Tags' => '标签',
    'Optionally include comma-separated [emoji shortcodes](https://docs.ntfy.sh/emojis/).' => '可选填入逗号分隔的[emoji 短代码](https://docs.ntfy.sh/emojis/)。',
    'ntfy Title' => 'ntfy 标题',
    'Dynamic ntfy Title' => '动态 ntfy 标题',
    'ntfy Body' => 'ntfy 正文',
    'Body of the ntfy notification.' => 'ntfy 通知的正文。',
    'ntfy Link URL' => 'ntfy 链接 URL',
    'Optionally open a URL when the notification is clicked.' => '可选在点击通知时打开一个 URL。',
    'Enable Markdown' => '启用 Markdown',
    'Whether to parse the body as Markdown in supported clients.' => '是否在受支持的客户端中将正文解析为 Markdown。',
    'Regular text only' => '仅纯文本',
    'Markdown enabled' => 'Markdown 已启用',

    // Message tab: Slack
    'Slack Message Body' => 'Slack 消息正文',
    'Supports standard [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) syntax. Optionally supports HTML _(see below)_.' => '支持标准 [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) 语法。可选支持 HTML _（见下文）_。',
    'Render Message Body as HTML' => '将消息正文渲染为 HTML',
    'Whether to only parse as [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), or additionally parse it as HTML.' => '是否仅解析为 [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting)，或同时解析为 HTML。',
    'Render Link Previews' => '显示链接预览',
    'Whether Slack should unfurl link previews for URLs in the message body.' => 'Slack 是否应展开消息正文中 URL 的链接预览。',
    'Don\'t unfurl' => '不展开',
    'Expand link previews' => '展开链接预览',
    'Bot Name' => '用户名',
    'Optionally override the app\'s display name.' => '可选覆盖应用的显示名称。',
    'Dynamic Bot Name' => '动态 Bot 名称',
    'Bot Icon URL' => '图标 URL',
    'Optionally override the app\'s icon with a URL.' => '可选用 URL 覆盖应用的图标。',
    'Bot Emoji' => '图标表情',
    'Optionally override the app\'s icon with an emoji. Used only when Bot Icon URL is empty.' => '可选用 emoji 覆盖应用的图标。仅在 Bot Icon URL 为空时使用。',

    // Message tab: Discord
    'Discord Message Body' => 'Discord 消息正文',
    'Supports standard Markdown, and optionally HTML _(see below)_. Max 2000 characters.' => '支持标准 Markdown，以及可选的 HTML _（见下文）_。最多 2000 个字符。',
    'Whether to only parse as Markdown, or additionally parse it as HTML.' => '是否仅解析为 Markdown,或同时解析为 HTML。',
    'Markdown only' => '仅 Markdown',
    'Markdown + HTML' => 'Markdown + HTML',
    'Whether Discord should unfurl link previews for URLs in the message body.' => 'Discord 是否应显示消息正文中 URL 的链接预览。',
    'Webhook Username' => 'Webhook 用户名',
    'Optionally override the webhook\'s display name.' => '可选覆盖 Webhook 的显示名称。',
    'Dynamic Username' => '动态用户名',
    'Webhook Avatar URL' => 'Webhook 头像 URL',
    'Optionally override the webhook\'s avatar with a URL.' => '可选用 URL 覆盖 Webhook 的头像。',

    // Message tab: Facebook
    'Message Body' => '消息正文',
    'The text of your Facebook post.' => '您 Facebook 帖子的文本。',
    'Preview Card URL' => '预览卡片 URL',
    'Optionally add a link to generate a preview card.' => '可选添加链接以生成预览卡片。',

    // Message tab: Instagram
    'Caption' => '说明文字',
    'Image Attachment' => '图片附件',
    'Optional caption, max 2200 characters.' => '可选说明文字,最多 2200 个字符。',

    // Message tab: X (Twitter)
    'Plain text, max 280 characters.' => '纯文本,最多 280 个字符。',

    // Message tab: Media
    'Attach an image by calling `{% setMedia %}` in a [custom Twig snippet]({url}).' => '通过在[自定义 Twig 代码片段]({url})中调用 `{% setMedia %}` 来附加图片。',

    // Message tab: Bluesky
    'Post Body' => '帖子正文',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => '纯文本,最多 300 个字符。URL 和 `@handle.tld` 提及会自动转为链接。',
    'Generate Link Preview' => '生成链接预览',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => '当帖子正文包含 URL 时,自动生成预览卡片。',
    'No card' => '无卡片',
    'Generate preview card' => '生成预览卡片',

    // Message tab: Mastodon
    'Plain text, max 500 characters. URLs will unfurl automatically.' => '纯文本，最多 500 个字符。URL 会自动展开。',
    'Visibility' => '可见性',
    'Who will be able to see this post?' => '谁可以看到此帖子?',

    // Message tab: LinkedIn
    'LinkedIn' => 'LinkedIn',
    'The text of your LinkedIn post.' => '你的 LinkedIn 帖子的文本。',

    // Message tab: MQTT
    'Payload' => '负载',
    'The JSON or plain text message published to the MQTT topic.' => '发布到 MQTT 主题的 JSON 或纯文本消息。',
    'Quality of Service' => '服务质量',
    'Delivery guarantee for this message.' => '此消息的传递保证。',
    'Retain' => '保留',
    'Whether the broker keeps this as the topic\'s last message for future subscribers.' => '代理是否将其保留为该主题的最后一条消息,并传递给将来的订阅者。',
    'Don\'t retain' => '不保留',

    // Recipients tab: type selector & user/group pickers
    'Recipients Type' => '收件人类型',
    'Who will receive this message?' => '谁将收到此消息?',
    'Add a message recipient' => '添加消息收件人',
    'Select User(s)' => '选择用户',
    'Which users will receive the message?' => '哪些用户将收到此消息?',
    'Which user groups will receive the message?' => '哪些用户组将收到此消息?',

    // Recipients tab: channel pickers (ntfy, Slack, Discord, Bluesky, Mastodon, MQTT)
    'Select ntfy topic(s)' => '选择 ntfy 主题',
    'Which topics should receive this message?' => '哪些主题应接收此消息?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => '未配置 ntfy 主题。请在[设置 → ntfy]({url})中添加一个。',
    'No ntfy topics configured. Topics can only be added in an environment that allows administrative changes.' => '未配置 ntfy 主题。主题只能在允许管理更改的环境中添加。',
    'Select Slack channel(s)' => '选择 Slack 频道',
    'Which channels should receive this message?' => '哪些频道应接收此消息?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => '未配置 Slack 频道。请在[设置 → Slack]({url})中添加一个。',
    'No Slack channels configured. Channels can only be added in an environment that allows administrative changes.' => '未配置 Slack 频道。频道只能在允许管理更改的环境中添加。',
    'Select Discord channel(s)' => '选择 Discord 频道',
    'No Discord channels configured. Add one in [Settings → Discord]({url}).' => '未配置 Discord 频道。请在[设置 → Discord]({url})中添加一个。',
    'No Discord channels configured. Channels can only be added in an environment that allows administrative changes.' => '未配置 Discord 频道。频道只能在允许管理更改的环境中添加。',
    'Select Facebook page(s)' => '选择 Facebook 页面',
    'Which pages should post this message?' => '哪些页面应发布此消息?',
    'No Facebook pages configured. Add one in [Settings → Facebook]({url}).' => '未配置 Facebook 页面。请在[设置 → Facebook]({url})中添加一个。',
    'No Facebook pages configured. Pages can only be added in an environment that allows administrative changes.' => '未配置 Facebook 页面。页面只能在允许管理更改的环境中添加。',
    'Select Instagram account(s)' => '选择 Instagram 账号',
    'No Instagram accounts configured. Add one in [Settings → Instagram]({url}).' => '未配置 Instagram 账号。请在[设置 → Instagram]({url})中添加一个。',
    'No Instagram accounts configured. Accounts can only be added in an environment that allows administrative changes.' => '未配置 Instagram 账号。账号只能在允许管理更改的环境中添加。',
    'Select X (Twitter) account(s)' => '选择 X (Twitter) 账号',
    'No X (Twitter) accounts configured. Add one in [Settings → X (Twitter)]({url}).' => '未配置 X (Twitter) 账号。请在[设置 → X (Twitter)]({url})中添加一个。',
    'No X (Twitter) accounts configured. Accounts can only be added in an environment that allows administrative changes.' => '未配置 X (Twitter) 账号。账号只能在允许管理更改的环境中添加。',
    'Select Bluesky account(s)' => '选择 Bluesky 账号',
    'Which accounts should post this message?' => '哪些账号应发布此消息?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => '未配置 Bluesky 账号。请在[设置 → Bluesky]({url})中添加一个。',
    'No Bluesky accounts configured. Accounts can only be added in an environment that allows administrative changes.' => '未配置 Bluesky 账号。账号只能在允许管理更改的环境中添加。',
    'Select Mastodon account(s)' => '选择 Mastodon 账号',
    'No Mastodon accounts configured. Add one in [Settings → Mastodon]({url}).' => '未配置 Mastodon 账号。请在[设置 → Mastodon]({url})中添加一个。',
    'No Mastodon accounts configured. Accounts can only be added in an environment that allows administrative changes.' => '未配置 Mastodon 账号。账号只能在允许管理更改的环境中添加。',
    'Select MQTT topic(s)' => '选择 MQTT 主题',
    'No MQTT topics configured. Add one in [Settings → MQTT]({url}).' => '未配置 MQTT 主题。请在[设置 → MQTT]({url})中添加一个。',
    'No MQTT topics configured. Topics can only be added in an environment that allows administrative changes.' => '未配置 MQTT 主题。主题只能在允许管理更改的环境中添加。',
    'Not a valid topic. Must not be empty or contain the `+` or `#` wildcards.' => '不是有效的主题。不能为空,也不能包含通配符 `+` 或 `#`。',

    // Recipients tab: LinkedIn picker
    'Select LinkedIn account(s)' => '选择 LinkedIn 账户',
    'Which page or member should post this message?' => '哪个页面或成员应发布此消息？',
    'No LinkedIn accounts connected. Connect one in [Settings → LinkedIn]({url}).' => '未连接 LinkedIn 账户。请在[设置 → LinkedIn]({url})中连接一个。',
    'No LinkedIn accounts connected. Accounts can only be connected in an environment that allows administrative changes.' => '未连接 LinkedIn 账户。账户只能在允许管理更改的环境中连接。',

    // Recipients tab: dynamic recipients snippet
    'Twig Snippet to Determine Recipients' => '用于确定收件人的 Twig 代码片段',
    'Enter a custom Twig snippet to [determine who will receive the message]({url}).' => '输入自定义 Twig 代码片段以[确定谁将接收消息]({url})。',
    'The snippet **must** include a `{% setRecipients %}` tag.' => '代码片段**必须**包含 `{% setRecipients %}` 标签。',

    // ========================================================
    // SETTINGS
    // ========================================================

    // Settings: nav & page chrome
    'Notifier Settings' => 'Notifier 设置',
    'General' => '常规',
    'Notification Fields' => '通知字段',
    'Fields saved.' => '字段已保存。',
    'Couldn’t save fields.' => '无法保存字段。',
    'Notification fields can’t be edited when admin changes are disabled.' => '禁用管理员更改时，无法编辑通知字段。',
    'Twilio' => 'Twilio',
    'Pushover' => 'Pushover',
    'ntfy' => 'ntfy',
    'Slack' => 'Slack',
    'Discord' => 'Discord',
    'Bluesky' => 'Bluesky',
    'Mastodon' => 'Mastodon',
    'MQTT' => 'MQTT',

    // Settings: nav group headings
    'Push Notifications' => '推送通知',
    'Chat Platforms' => '聊天平台',
    'Social Media' => '社交媒体',
    'Internet of Things' => '物联网',
    'Expand {heading}' => '展开{heading}',

    // Settings: shared intro lines
    'Consult the [{name} setup guide]({url}) for complete instructions.' => '请参阅 [{name} 设置指南]({url}) 获取完整说明。',
    'Sensitive values can be stored in your `.env` file and referenced here.' => '敏感值可以存储在您的 `.env` 文件中并在此引用。',

    // Settings: Notification order
    'Notification Order' => '通知排序',
    'Notifications can be dragged into any order on the index page. Choose where new notifications land in that order.' => '可以在列表页面拖动通知以自定义顺序。选择新通知在该顺序中的添加位置。',
    'Default Placement' => '默认位置',
    'Where new notifications are added to the list.' => '新通知添加到列表的位置。',
    'Before other notifications' => '在其他通知之前',
    'After other notifications' => '在其他通知之后',

    // Settings: Logging
    'Logging' => '日志记录',
    "Notifier keeps a running log of every message it sends. You usually won't need to change this, but you can limit how many log entries are kept in the database." => 'Notifier 持续记录已发送消息的日志。通常不需要,但您可以限制存入数据库的日志事件数量。',
    'Enable Logging' => '启用日志记录',
    'When disabled, Notifier will not write anything to the notification log.' => '禁用时,Notifier 不会向通知日志写入任何内容。',
    'Number of days to retain log events' => '保留日志事件的天数',
    'At most, keep log events for this many days. Leave blank for no limit.' => '最多保留这么多天的日志事件。留空表示无限制。',
    'Number of log events to retain' => '要保留的日志事件数量',
    'At most, keep this many log events. Leave blank for no limit.' => '最多保留这么多日志事件。留空表示无限制。',

    // Settings: Scheduled sending
    'Scheduled Sending' => '定时发送',
    'A shared secret that authenticates scheduled runs triggered over the web. You only need this if you trigger the schedule from the web endpoint.' => '用于验证定时运行 Web 请求的共享密钥。仅在通过 Web 端点触发计划时才需要。',
    'Scheduled-Run Token' => '定时运行令牌',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => '随每个请求一起发送,作为 X-Notifier-Token 标头或 token 主体参数。',

    // Settings: Twilio
    'Send SMS text messages through [Twilio](https://www.twilio.com).' => '通过 [Twilio](https://www.twilio.com) 发送 SMS 短信。',
    'Twilio Account SID' => 'Twilio 账户 SID',
    'Twilio Auth Token' => 'Twilio 认证令牌',
    'Twilio phone number (sends each SMS message)' => 'Twilio 电话号码(发送每条短信)',
    'SMS Testing' => '短信测试',
    'Optional. When set, every SMS is sent to this number instead of the actual recipient.' => '可选。设置后,每条 SMS 将发送到此号码,而不是实际的收件人。',
    'Test phone number' => '测试电话号码',

    // Settings: Pushover
    'Send push notifications through [Pushover](https://pushover.net).' => '通过 [Pushover](https://pushover.net) 发送推送通知。',
    'Application API Token' => '应用 API 令牌',
    'The 30-character app token from your Pushover application.' => '来自您 Pushover 应用的 30 个字符的应用令牌。',

    // Settings: ntfy
    'Send push notifications through [ntfy](https://ntfy.sh).' => '通过 [ntfy](https://ntfy.sh) 发送推送通知。',
    'Server URL' => '服务器 URL',
    'Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`.' => '可选,指向自托管的 ntfy 实例(如适用)。默认为 `https://ntfy.sh`。',
    'Access token' => '访问令牌',
    'Optional, required for protected topics or self-hosted instances with auth.' => '可选,用于受保护主题或带身份验证的自托管实例时必填。',
    'ntfy Topics' => 'ntfy 主题',
    'Add the ntfy topics you want to send to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => '添加您希望发送消息的 ntfy 主题。配置通知时,每个主题都可在**收件人**选项卡中作为收件人使用。',
    'Topics' => '主题',
    "Click any row's **Test** button to send a quick test message to that topic." => '点击任意行的 **测试** 按钮以向该主题发送快速测试消息。',
    'Label' => '标签',
    'Topic' => '主题',
    'Add a topic' => '添加主题',

    // Settings: Slack
    'Post messages to your Slack channels.' => '向您的 Slack 频道发送消息。',
    'Channels' => '频道',
    "Click any row's **Test** button to send a quick test message to that channel." => '点击任意行的 **测试** 按钮以向该频道发送快速测试消息。',
    'Bot Token' => '机器人令牌',
    'Channel ID' => '频道 ID',
    'Add a channel' => '添加频道',
    'Not a valid Bot Token. Must start with `xoxb-`.' => '无效的机器人令牌。必须以 `xoxb-` 开头。',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => '无效的频道 ID。必须类似 `C01234ABCD`。',

    // Settings: Discord
    'Post messages to your Discord channels.' => '向您的 Discord 频道发送消息。',
    'Webhook URL' => 'Webhook URL',
    'Not a valid Webhook URL. Must start with `https://discord.com/api/webhooks/`.' => '无效的 Webhook URL。必须以 `https://discord.com/api/webhooks/` 开头。',

    // Settings: Facebook
    'Facebook' => 'Facebook',
    'Publish posts to your [Facebook](https://facebook.com) pages.' => '向您的 [Facebook](https://facebook.com) 页面发布帖子。',
    'Pages' => '页面',
    'Page ID' => 'Page ID',
    'Page Access Token' => 'Page Access Token',
    'Add a page' => '添加页面',
    "Click any row's **Test** button to verify that page's credentials. No posts are made." => '点击任意行的 **Test** 按钮以验证该页面的凭据。不会发布任何帖子。',

    // Settings: Instagram
    'Instagram' => 'Instagram',
    'Publish posts to your [Instagram](https://instagram.com) Business accounts.' => '向您的 [Instagram](https://instagram.com) Business 账号发布帖子。',
    "Click any row's **Test** button to resolve the linked Instagram account. No posts are made." => '点击任意行的 **Test** 按钮以解析关联的 Instagram 账号。不会发布任何帖子。',

    // Settings: X (Twitter)
    'X (Twitter)' => 'X (Twitter)',
    'Publish posts to your [X (Twitter)](https://x.com) accounts.' => '向您的 [X (Twitter)](https://x.com) 账号发布帖子。',
    'Consumer Key' => 'Consumer Key',
    'Consumer Key Secret' => 'Consumer Key Secret',
    'Access Token Secret' => 'Access Token Secret',

    // Settings: Bluesky
    'Publish posts to your [Bluesky](https://bsky.app) accounts.' => '向您的 [Bluesky](https://bsky.app) 账号发布帖子。',
    'PDS URL' => 'PDS URL',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => '默认为 https://bsky.social。如您的安装支持联邦,可指向自定义 PDS。',
    'Bluesky Accounts' => 'Bluesky 账号',
    'Add the Bluesky accounts you want to post from. Each account becomes available as a recipient on the **Recipients** tab when you set up a notification.' => '添加您希望用于发布的 Bluesky 账号。配置通知时,每个账号都可在**收件人**选项卡中作为收件人使用。',
    'Accounts' => '账号',
    "Click any row's **Test** button to confirm the account authenticates." => '点击任意行的 **测试** 按钮以确认该账号能通过认证。',
    'Handle' => '句柄',
    'App password' => '应用密码',
    'Add an account' => '添加账号',

    // Settings: Mastodon
    'Publish posts to your [Mastodon](https://joinmastodon.org) accounts.' => '向您的 [Mastodon](https://joinmastodon.org) 账号发布帖子。',
    'Click any row\'s **Test** button to verify that account\'s credentials. No posts are made.' => '点击任意行的 **Test** 按钮以验证该账号的凭据。不会发布任何帖子。',
    'Instance URL' => '实例 URL',
    'Access Token' => '访问令牌',

    // Settings: LinkedIn
    'Publish posts to your [LinkedIn](https://linkedin.com) profile.' => '向你的 [LinkedIn](https://linkedin.com) 个人主页发布帖子。',
    'The Client ID of your LinkedIn app.' => '你的 LinkedIn 应用的客户端 ID。',
    'Client Secret' => '客户端密钥',
    'The Primary Client Secret of your LinkedIn app.' => '你的 LinkedIn 应用的主客户端密钥。',
    'Enable organization posting' => '启用组织发布',
    'Copy this redirect URL' => '复制此重定向 URL',
    'When configuring the LinkedIn app, <strong>copy this URL</strong> to use as an "Authorized redirect URL".' => '配置 LinkedIn 应用时，<strong>复制此 URL</strong> 以用作 "Authorized redirect URL"。',
    'Also request access to post as organization pages you administer. Requires Community Management API approval from LinkedIn.' => '同时请求以你管理的组织页面身份发帖的权限。需要 LinkedIn 批准 Community Management API。',
    'Connections' => '连接',
    'Each connection becomes available as a recipient on the **Recipients** tab when you set up a notification.' => '设置通知时，每个连接都会作为收件人显示在 **收件人** 选项卡中。',
    'Account' => '账户',
    'Type' => '类型',
    'Status' => '状态',
    'Organization' => '组织',
    'Member' => '成员',
    'Reconnect needed' => '需要重新连接',
    'Expires' => '到期',
    'Connected' => '已连接',
    'Disconnect' => '断开连接',
    'No LinkedIn accounts are connected yet.' => '尚未连接任何 LinkedIn 账户。',
    'Connect to LinkedIn' => '连接到 LinkedIn',
    'Provide valid credentials to connect with LinkedIn.' => '请提供有效的凭据以连接到 LinkedIn。',
    'Disconnect this LinkedIn account?' => '断开此 LinkedIn 账户的连接吗？',

    // Settings: MQTT
    'Publish messages to an MQTT broker, handy for IoT and home-automation setups.' => '向 MQTT 代理发布消息，适用于物联网和家庭自动化配置。',
    'Host' => '主机',
    'Broker hostname, without a protocol or port.' => '代理的主机名,不含协议或端口。',
    'Port' => '端口',
    'Optional. Defaults to 8883 when TLS is enabled, otherwise 1883.' => '可选。启用 TLS 时默认为 8883,否则为 1883。',
    'Use TLS' => '使用 TLS',
    'Whether to connect to the broker over a secure TLS socket.' => '是否通过安全的 TLS 套接字连接到代理。',
    'Username' => '用户名',
    'Optional, for brokers that require username/password authentication.' => '可选,适用于需要用户名/密码身份验证的代理。',
    'Password' => '密码',
    'MQTT Version' => 'MQTT 版本',
    'Protocol version sent to the broker.' => '发送给代理的协议版本。',
    'Client ID' => '客户端 ID',
    'Optional. A unique client ID is generated automatically when left blank.' => '可选。留空时会自动生成唯一的客户端 ID。',
    'Mutual TLS' => '双向 TLS',
    'Optional. Needed for brokers that authenticate clients with certificates, such as AWS IoT Core. Enter the server file paths to your certificate files. You can use a `.env` variable or `@alias` reference.' => '可选。适用于使用证书验证客户端的代理(如 AWS IoT Core)。请提供证书文件的服务器文件路径(允许使用 `.env` 变量或 `@alias` 引用)。',
    'CA Certificate File' => 'CA 证书文件',
    'Path to the certificate authority (CA) file.' => '证书颁发机构(CA)文件的路径。',
    'Client Certificate File' => '客户端证书文件',
    'Path to the client certificate file.' => '客户端证书文件的路径。',
    'Client Key File' => '客户端密钥文件',
    'Path to the client private key file.' => '客户端私钥文件的路径。',
    'MQTT Topics' => 'MQTT 主题',
    'Add the MQTT topics you want to publish to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => '添加您希望发布的 MQTT 主题。配置通知时,每个主题都可在**收件人**选项卡中作为收件人使用。',
    'Click any row\'s **Test** button to publish a quick test message to that topic.' => '点击任意行的 **测试** 按钮以向该主题发布快速测试消息。',

    // ========================================================
    // MANUAL SEND & TEST
    // ========================================================

    // Manual send & test
    'Send a test message' => '发送测试消息',
    'Send a REAL test notification?\\n\\n⚠️ Uses a random sample of real data.\\n⚠️ Sends a real message via the configured channel.\\n⚠️ Delivers to the real configured recipient(s).' => '发送真实的测试通知?\\n\\n⚠️ 使用真实数据的随机样本。\\n⚠️ 通过配置的渠道发送真实消息。\\n⚠️ 发送给配置的真实收件人。',
    'Test' => '测试',
    'Send system snapshot' => '发送系统快照',
    'Send data report' => '发送数据报告',
    'Are you sure you want to send this notification?' => '确定要发送此通知吗？',
    'This notification cannot be triggered manually.' => '此通知无法手动触发。',
    'This notification no longer applies to the selected element.' => '此通知不再适用于所选元素。',

    // ========================================================
    // RUNTIME OUTPUT
    // ========================================================

    // Runtime: dispatch log feedback
    'Sending {messageType} to {recipient}.' => '正在向 {recipient} 发送 {messageType}。',
    'Sending "{title}".' => '正在发送“{title}”。',
    '[invalid recipient]' => '[无效收件人]',
    'Scanning feed {url}.' => '正在扫描 Feed {url}。',
    'Adding message to queue.' => '正在将消息添加到队列。',
    'Sending message immediately (bypassing queue).' => '立即发送消息(绕过队列)。',

    // Runtime: controller responses
    'Test notification dispatched.' => '已发送测试通知。',
    'No messages were dispatched. Check the recipient configuration.' => '未发送任何消息。请检查收件人配置。',
    'Unable to send test: the feed could not be read or has no items.' => '无法发送测试：无法读取订阅源或没有条目。',
    'Unable to send test: no element matches the configured filters.' => '无法发送测试：没有元素与配置的筛选器匹配。',
    "Couldn't save settings." => '无法保存设置。',
    'Settings saved.' => '设置已保存。',
    'Topic is empty.' => '主题为空。',
    'Server URL is not configured.' => '服务器 URL 未配置。',
    'Test message from Notifier.' => '来自 Notifier 的测试消息。',
    'HTTP {status}' => 'HTTP {status}',
    'Test message sent successfully.' => '测试消息发送成功。',
    'Page ID and Page Access Token are required.' => 'Page ID 和 Page Access Token 为必填项。',
    'Facebook rejected the request: {error}' => 'Facebook 拒绝了请求:{error}',
    'Successfully connected to "{name}". No posts were made.' => '已成功连接到 "{name}"。未发布任何帖子。',
    'No Instagram Business account is linked to this Page.' => '没有 Instagram Business 账号关联到此页面。',
    'Successfully connected to @{handle}. No posts were made.' => '已成功连接到 @{handle}。未发布任何帖子。',
    'All four credentials are required.' => '四项凭据均为必填项。',
    'X (Twitter) rejected the request: {error}' => 'X (Twitter) 拒绝了请求:{error}',
    'Successfully authenticated as @{username}. No posts were made.' => '已成功以 @{username} 身份进行认证。未发布任何帖子。',
    'Handle and app password are required.' => '句柄和应用密码为必填项。',
    'Authentication failed.' => '身份验证失败。',
    'Successfully authenticated. No messages were posted.' => '身份验证成功。未发布任何消息。',
    'Log events deleted.' => '日志事件已删除。',
    'Notification sent.' => '通知已发送。',
    'Notification was not sent. Check the Notification Log for details.' => '通知未发送。详情请查看通知日志。',
    'Instance URL and access token are required.' => '实例 URL 和访问令牌为必填项。',
    'Mastodon rejected the request: {error}' => 'Mastodon 拒绝了请求：{error}',
    'Successfully authenticated as @{handle}. No posts were made.' => '已成功以 @{handle} 身份进行认证。未发布任何帖子。',
    'Broker host is not configured.' => '未配置代理主机。',

    // Runtime: LinkedIn connect flow
    'Add your LinkedIn app credentials before connecting.' => '连接前请先添加你的 LinkedIn 应用凭据。',
    'LinkedIn authorization failed: {error}' => 'LinkedIn 授权失败：{error}',
    'LinkedIn authorization failed: invalid state.' => 'LinkedIn 授权失败：状态无效。',
    'LinkedIn authorization failed: no code returned.' => 'LinkedIn 授权失败：未返回授权码。',
    'Connected to LinkedIn.' => '已连接到 LinkedIn。',
    'Disconnected from LinkedIn.' => '已断开与 LinkedIn 的连接。',

    // Outbound: per-channel send results
    'Successfully sent an email to {name}.' => '已成功向 {name} 发送邮件。',
    'Successfully sent an SMS message to {name}.' => '已成功向 {name} 发送短信。',
    'Successfully sent a Pushover notification to {name}.' => '已成功向 {name} 发送 Pushover 通知。',
    'Successfully posted an announcement for {name}.' => '已成功为 {name} 发布公告。',
    'Successfully sent a flash message to {name}.' => '已成功向 {name} 发送闪现消息。',
    'Successfully posted to Slack in channel "{label}".' => '已成功发布到 Slack 频道 "{label}"。',
    'Successfully posted to Discord in channel "{label}".' => '已成功发布到 Discord 频道 "{label}"。',
    'Successfully posted to Facebook as "{label}" account.' => '已成功以账户 "{label}" 发布到 Facebook。',
    'Successfully posted to Instagram as "{label}" account.' => '已成功以账户 "{label}" 发布到 Instagram。',
    'Successfully posted to X (Twitter) as "{label}" account.' => '已成功以账户 "{label}" 发布到 X (Twitter)。',
    'Successfully posted to Bluesky as "{label}" account.' => '已成功以账户 "{label}" 发布到 Bluesky。',
    'Successfully posted to Mastodon as "{label}" account.' => '已成功以账户 "{label}" 发布到 Mastodon。',
    'Successfully posted to LinkedIn as "{label}" account.' => '已成功以账户 "{label}" 发布到 LinkedIn。',
    'Successfully sent ntfy message to topic "{topic}".' => '已成功发送 ntfy 消息到主题 "{topic}"。',
    'Slack rejected the message: {error}' => 'Slack 拒绝了消息：{error}',
    'Discord rejected the message: {error}' => 'Discord 拒绝了消息：{error}',
    'the attached image could not be read' => '无法读取附加的图片',
    'Successfully sent MQTT message to topic "{topic}".' => '已成功向主题“{topic}”发送 MQTT 消息。',

    // Outbound: LinkedIn send results & skips
    '[EMPTY BODY] The LinkedIn post body is empty.' => '[EMPTY BODY] LinkedIn 帖子正文为空。',
    '[NO RECIPIENT] No LinkedIn connection was specified.' => '[NO RECIPIENT] 未指定 LinkedIn 连接。',
    '[RECONNECT REQUIRED] {reason}' => '[RECONNECT REQUIRED] {reason}',
    '[REJECTED BY LINKEDIN] {error}' => '[REJECTED BY LINKEDIN] {error}',
    'LinkedIn app credentials are not configured.' => '未配置 LinkedIn 应用凭据。',
    'The LinkedIn access token has expired. Please reconnect.' => 'LinkedIn 访问令牌已过期。请重新连接。',
    'The LinkedIn connection no longer exists.' => '该 LinkedIn 连接已不存在。',
    'My LinkedIn Profile' => '我的 LinkedIn 个人主页',
    '[SKIPPED] Recipient "{name}" has no LinkedIn connection.' => '[SKIPPED] 收件人 "{name}" 没有 LinkedIn 连接。',
    '[SKIPPED] The configured LinkedIn connection no longer exists (uid: {uid}).' => '[SKIPPED] 配置的 LinkedIn 连接已不存在 (uid: {uid})。',

    // Media attachments
    'Videos are not yet supported on {channel}.' => '{channel} 尚不支持视频。',
    'The image could not be resized to fit.' => '无法将图片调整为合适的大小。',
    'The image could not be read.' => '无法读取图片。',
    'The image failed to upload.' => '图片上传失败。',
    'The upload response had no media ID.' => '上传响应中没有媒体 ID。',
    'The upload response had no blob.' => '上传响应中没有 blob。',
    '[NOT ATTACHED] Unable to attach image. {reason}' => '[未附加] 无法附加图片。{reason}',

    // Recipient warnings
    '[SKIPPED] User "{name}" has no Pushover key.' => '[已跳过] 用户 "{name}" 没有 Pushover 密钥。',

    // Errors & exceptions
    'Invalid element event: {class}' => '无效的元素事件:{class}',
    'Invalid notification ID: {id}' => '通知 ID 无效:{id}',
    'Invalid email message mode.' => '无效的邮件消息模式。',
    'You do not have permission to use the Dynamic Recipients type.' => '您没有权限使用动态收件人类型。',
    'Invalid settings section: {section}' => '无效的设置部分:{section}',
    'User not authorized to save this notification.' => '用户无权保存此通知。',
    'User not authorized to view this notification.' => '用户无权查看此通知。',
    'User not authorized to delete this notification.' => '用户无权删除此通知。',
    'Notification not found' => '未找到通知',
    'Element not found' => '未找到元素',
    'You do not have permission to use the Dynamic Data type.' => '您无权使用动态数据类型。',
    '[NO DATA] The Dynamic Data snippet did not call the {tag} tag.' => '[无数据] Twig 代码片段未调用 {tag} 标签。',

    // Config-file override note
    'This is being set in the config file. [{file}]' => '此项在配置文件中设置。[{file}]',

    // ========================================================
    // JAVASCRIPT UI
    // ========================================================

    // JavaScript: log utility & buttons
    'Test notification failed.' => '测试通知失败。',
    'Unable to get the notification, something went wrong.' => '无法获取通知，出错了。',
    'Something went wrong.' => '出错了。',
    'Invalid notification ID.' => '通知 ID 无效。',
    'Unable to delete the log event, something went wrong.' => '无法删除日志事件，出错了。',
    'Log event deleted.' => '日志事件已删除。',
    'Unable to delete log events, something went wrong.' => '无法删除日志事件，出错了。',
    'Are you sure you want to delete all logs from {date}?' => '确定要删除 {date} 的所有日志吗？',
    // Reworded outbound + dispatch log messages
    '[BAD CREDENTIALS] Missing app token. [Configure Pushover]({url}).' => '[凭据无效] 缺少应用令牌。[配置 Pushover]({url})。',
    '[BAD CREDENTIALS] Missing {missing}. [Configure Twilio]({url}).' => '[凭据无效] 缺少 {missing}。[配置 Twilio]({url})。',
    '[BAD CREDENTIALS] No Discord webhook URL is configured.' => '[凭据无效] 未配置 Discord webhook URL。',
    '[BAD CREDENTIALS] No MQTT broker host is configured.' => '[凭据无效] 未配置 MQTT broker 主机。',
    '[BAD CREDENTIALS] No Mastodon access token is configured.' => '[凭据无效] 未配置 Mastodon 访问令牌。',
    '[BAD CREDENTIALS] No Mastodon instance URL is configured.' => '[凭据无效] 未配置 Mastodon 实例 URL。',
    '[BAD CREDENTIALS] No Slack bot token is configured.' => '[凭据无效] 未配置 Slack bot 令牌。',
    '[BAD CREDENTIALS] No Twilio phone number is configured.' => '[凭据无效] 未配置 Twilio 电话号码。',
    '[BAD CREDENTIALS] The recipient is missing Bluesky credentials.' => '[凭据无效] 收件人缺少 Bluesky 凭据。',
    '[BAD CREDENTIALS] The recipient is missing Facebook credentials.' => '[凭据无效] 收件人缺少 Facebook 凭据。',
    '[BAD CREDENTIALS] The recipient is missing X (Twitter) credentials.' => '[凭据无效] 收件人缺少 X (Twitter) 凭据。',
    '[BAD CREDENTIALS] Unable to post, recipient is missing credentials.' => '[凭据无效] 无法发布；收件人缺少凭据。',
    '[EMPTY BODY] The Discord message body is empty.' => '[内容为空] Discord 消息正文为空。',
    '[EMPTY BODY] The Facebook post body is empty.' => '[内容为空] Facebook 帖子正文为空。',
    '[EMPTY BODY] The MQTT payload is empty.' => '[内容为空] MQTT 负载为空。',
    '[EMPTY BODY] The Mastodon post body is empty.' => '[内容为空] Mastodon 帖子正文为空。',
    '[EMPTY BODY] The Slack message body is empty.' => '[内容为空] Slack 消息正文为空。',
    '[EMPTY BODY] The X (Twitter) post body is empty.' => '[内容为空] X (Twitter) 帖子正文为空。',
    '[EMPTY BODY] The email message body was empty.' => '[内容为空] 邮件正文为空。',
    '[FEED ERROR] Could not fetch the feed: {message}' => '[Feed 错误] 无法获取 Feed：{message}',
    '[FEED ERROR] Could not parse the feed.' => '[Feed 错误] 无法解析 Feed。',
    '[FEED ERROR] Could not parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => '[Feed 错误] 无法解析 Feed。需要 PHP `simplexml` 和 `libxml` 扩展。',
    '[FEED ERROR] Initial feed scan failed: {message}' => '[Feed 错误] 初始 Feed 扫描失败：{message}',
    '[INVALID NUMBER] The recipient phone number is invalid.' => '[号码无效] 收件人的电话号码无效。',
    '[INVALID TYPE] The flash message type is invalid.' => '[类型无效] Flash 消息类型无效。',
    '[LINK PREVIEW SKIPPED] {reason}' => '[已跳过链接预览] {reason}',
    '[MISSING IMAGE] Image Attachment field never called the {tag} tag.' => '[缺少图片] 图片附件字段从未调用 {tag} 标签。',
    '[MISSING IMAGE] Image Attachment field was empty.' => '[缺少图片] 图片附件字段为空。',
    '[MISSING IMAGE] The {tag} tag was called, but returned an invalid image.' => '[缺少图片] 已调用 {tag} 标签，但返回了无效的图片。',
    '[MISSING IMAGE] Unable to send Instagram post, the image needs a public URL.' => '[缺少图片] 无法发送 Instagram 帖子，图片需要公开的 URL。',
    '[NO CALENDAR] No calendars are selected, this notification will never be triggered.' => '[无日历] 未选择任何日历，此通知将永远不会触发。',
    '[NO DIGITAL PRODUCT TYPE] No digital product types are selected, this notification will never be triggered.' => '[无数字产品类型] 未选择任何数字产品类型，此通知将永远不会触发。',
    '[NO ENTRY TYPE] No sections or entry types are selected, this notification will never be triggered.' => '[无条目类型] 未选择任何板块或条目类型，此通知将永远不会触发。',
    '[NO FORM] No forms are selected, this notification will never be triggered.' => '[无表单] 未选择任何表单，此通知将永远不会触发。',
    '[NO PRODUCT TYPE] No product types are selected, this notification will never be triggered.' => '[无产品类型] 未选择任何产品类型，此通知将永远不会触发。',
    '[NO USER GROUP] No user groups are selected, this notification will never be triggered.' => '[无用户组] 未选择任何用户组，此通知将永远不会触发。',
    '[NO VOLUME] No volumes are selected, this notification will never be triggered.' => '[无卷] 未选择任何卷，此通知将永远不会触发。',
    '[NO MEDIA] No image was attached because the {tag} tag was never invoked in the Image Attachment field.' => '[无媒体] 未附加任何图片，因为从未在图片附件字段中调用 {tag} 标签。',
    '[NO RECIPIENTS] The Dynamic Recipients snippet did not call setRecipients.' => '[无收件人] 动态收件人代码段未调用 setRecipients。',
    '[NO RECIPIENTS] setRecipients was called with an empty value.' => '[无收件人] setRecipients 以空值被调用。',
    '[NO RECIPIENT] No MQTT topic was specified.' => '[无收件人] 未指定 MQTT 主题。',
    '[NO RECIPIENT] No Slack channel ID was specified.' => '[无收件人] 未指定 Slack 频道 ID。',
    '[NO RECIPIENT] No ntfy topic was specified.' => '[无收件人] 未指定 ntfy 主题。',
    '[NO RECIPIENT] No recipient user was specified for the announcement.' => '[无收件人] 未为公告指定收件用户。',
    '[NO RECIPIENT] No recipient was specified for the email.' => '[无收件人] 未为邮件指定收件人。',
    '[NO RECIPIENT] The recipient has no Pushover user key.' => '[无收件人] 收件人没有 Pushover 用户密钥。',
    '[NO RECIPIENT] The recipient has no phone number.' => '[无收件人] 收件人没有电话号码。',
    '[REJECTED BY DISCORD] {error}' => '[被拒绝: DISCORD] {error}',
    '[REJECTED BY FACEBOOK] {error}' => '[被拒绝: FACEBOOK] {error}',
    '[REJECTED BY INSTAGRAM] {error}' => '[被拒绝: INSTAGRAM] {error}',
    '[REJECTED BY MASTODON] {error}' => '[被拒绝: MASTODON] {error}',
    '[REJECTED BY SLACK] {error}' => '[被拒绝: SLACK] {error}',
    '[REJECTED BY X (TWITTER)] {error}' => '[被拒绝: X (TWITTER)] {error}',
    '[SEND FAILED] Authentication failed for {handle}: {reason}' => '[发送失败] {handle} 的身份验证失败：{reason}',
    '[SEND FAILED] Authentication failed: {reason}' => '[发送失败] 身份验证失败：{reason}',
    "[SEND FAILED] Could not send the email using Craft's native handling. Check your general email settings within Craft." => '[发送失败] 无法使用 Craft 的原生处理发送邮件。请检查 Craft 中的常规邮件设置。',
    '[SEND FAILED] HTTP {status}: {reason}' => '[发送失败] HTTP {status}: {reason}',
    '[SEND FAILED] {error}' => '[发送失败] {error}',
    '[SEND FAILED] {reason}' => '[发送失败] {reason}',
    '[SKIPPED] Pushover user-key field is not configured on this notification.' => '[已跳过] 此通知未配置 Pushover 用户密钥字段。',
    '[SKIPPED] Recipient "{name}" cannot access the control panel.' => '[已跳过] 收件人“{name}”无法访问控制面板。',
    '[SKIPPED] Recipient "{name}" has no Bluesky credentials.' => '[已跳过] 收件人“{name}”没有Bluesky 凭据。',
    '[SKIPPED] Recipient "{name}" has no Craft user account.' => '[已跳过] 收件人“{name}”没有 Craft 用户账户。',
    '[SKIPPED] Recipient "{name}" has no Discord webhook URL.' => '[已跳过] 收件人“{name}”没有Discord webhook URL。',
    '[SKIPPED] Recipient "{name}" has no Facebook credentials.' => '[已跳过] 收件人“{name}”没有Facebook 凭据。',
    '[SKIPPED] Recipient "{name}" has no Instagram credentials.' => '[已跳过] 收件人“{name}”没有Instagram 凭据。',
    '[SKIPPED] Recipient "{name}" has no MQTT topic.' => '[已跳过] 收件人“{name}”没有MQTT 主题。',
    '[SKIPPED] Recipient "{name}" has no Mastodon credentials.' => '[已跳过] 收件人“{name}”没有Mastodon 凭据。',
    '[SKIPPED] Recipient "{name}" has no Slack bot token.' => '[已跳过] 收件人“{name}”没有Slack bot 令牌。',
    '[SKIPPED] Recipient "{name}" has no Slack channel ID.' => '[已跳过] 收件人“{name}”没有Slack 频道 ID。',
    '[SKIPPED] Recipient "{name}" has no X (Twitter) credentials.' => '[已跳过] 收件人“{name}”没有X (Twitter) 凭据。',
    '[SKIPPED] Recipient "{name}" has no email address.' => '[已跳过] 收件人“{name}”没有电子邮件地址。',
    '[SKIPPED] Recipient "{name}" has no ntfy topic.' => '[已跳过] 收件人“{name}”没有ntfy 主题。',
    '[SKIPPED] Recipient "{name}" has no phone number.' => '[已跳过] 收件人“{name}”没有电话号码。',
    '[SKIPPED] The configured {kind} no longer exists in the plugin settings (uid: {uid}).' => '[已跳过] 配置的 {kind} 已不存在于插件设置中（uid: {uid}）。',
    '[SKIPPED] Unrecognized recipient "{value}".' => '[已跳过] 无法识别的收件人“{value}”。',
    '[SKIPPED] Unrecognized recipient of type "{type}".' => '[已跳过] 无法识别的收件人类型“{type}”。',
    '[TOO LONG] The Discord message body exceeds the 2000-character limit.' => '[过长] Discord 消息正文超过了 2000 字符的限制。',
    '[TRUNCATED] Body exceeded {max} characters.' => '[已截断] 正文超过了 {max} 个字符。',
    '[TRUNCATED] Caption exceeded {max} characters.' => '[已截断] 说明文字超过了 {max} 个字符。',
];
