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

    // ============================================================
    // PLUGIN & PERMISSIONS
    // ============================================================

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
    'Save notifications' => '保存通知',
    'Use the Dynamic Recipients type' => '使用动态收件人类型',
    'Use the Dynamic Data type' => '使用动态数据类型',
    'Test notifications' => '测试通知',
    'Send manual notifications' => '发送手动通知',
    'Delete notifications' => '删除通知',
    'View notification log' => '查看通知日志',
    'Delete notification log' => '删除通知日志',

    // ============================================================
    // NOTIFICATION EDITOR
    // ============================================================

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

    // Event tab: Feed
    'Feed URL' => 'Feed URL',
    'The URL of the RSS, Atom, or JSON feed to watch.' => '要监控的 RSS、Atom 或 JSON Feed 的 URL。',

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
    'On a recurring schedule' => '按重复计划',
    'On demand' => '按需',
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

    // Message tab: type selector & queue
    'Message Type' => '消息类型',
    'What type of message will be sent?' => '将发送什么类型的消息?',
    'Send Message via Queue' => '通过队列发送消息',
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are also supported.' => '也支持[模板]({templatingUrl})和[特殊变量]({variablesUrl})。',
    'Send immediately' => '立即发送',
    'Add to queue' => '加入队列',
    'Whether the message should be sent via the [jobs queue]({queueUrl}).' => '消息是否应通过[任务队列]({queueUrl})发送。',

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
    'mrkdwn only' => '仅 mrkdwn',
    'mrkdwn + HTML' => 'mrkdwn + HTML',
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

    // Message tab: Bluesky
    'Post Body' => '帖子正文',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => '纯文本,最多 300 个字符。URL 和 `@handle.tld` 提及会自动转为链接。',
    'Generate Link Preview' => '生成链接预览',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => '当帖子正文包含 URL 时,自动生成预览卡片。',
    'No card' => '无卡片',
    'Generate preview card' => '生成预览卡片',

    // Recipients tab: type selector & user/group pickers
    'Recipients Type' => '收件人类型',
    'Who will receive this message?' => '谁将收到此消息?',
    'Add a message recipient' => '添加消息收件人',
    'Select User(s)' => '选择用户',
    'Which users will receive the message?' => '哪些用户将收到此消息?',
    'Which user groups will receive the message?' => '哪些用户组将收到此消息?',

    // Recipients tab: channel pickers (Slack / ntfy / Bluesky)
    'Select Slack channel(s)' => '选择 Slack 频道',
    'Which Slack channels should receive this message?' => '哪些 Slack 频道应收到此消息?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => '未配置 Slack 频道。请在[设置 → Slack]({url})中添加一个。',
    'Select ntfy topic(s)' => '选择 ntfy 主题',
    'Which ntfy topics should receive this message?' => '哪些 ntfy 主题应收到此消息?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => '未配置 ntfy 主题。请在[设置 → ntfy]({url})中添加一个。',
    'Select Bluesky account(s)' => '选择 Bluesky 账号',
    'Which Bluesky accounts should post this message?' => '哪些 Bluesky 账号应发布此消息?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => '未配置 Bluesky 账号。请在[设置 → Bluesky]({url})中添加一个。',

    // Recipients tab: dynamic recipients snippet
    'Twig Snippet to Determine Recipients' => '用于确定收件人的 Twig 代码片段',
    'Enter a custom Twig snippet to [determine who will receive the message]({url}).' => '输入自定义 Twig 代码片段以[确定谁将接收消息]({url})。',
    'The snippet **must** include a `{% setRecipients %}` tag.' => '代码片段**必须**包含 `{% setRecipients %}` 标签。',

    // ============================================================
    // SETTINGS
    // ============================================================

    // Settings: nav & page chrome
    'Notifier Settings' => 'Notifier 设置',
    'General' => '常规',
    'Twilio' => 'Twilio',
    'Pushover' => 'Pushover',
    'Slack' => 'Slack',
    'Bluesky' => 'Bluesky',
    'ntfy' => 'ntfy',

    // Settings: Logging
    'Logging' => '日志记录',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier 持续记录已发送消息的日志。通常不需要,但您可以限制存入数据库的日志事件数量。',
    'Enable Logging' => '启用日志记录',
    'When disabled, Notifier will not write anything to the notification log.' => '禁用时,Notifier 不会向通知日志写入任何内容。',
    'Number of days to retain log events' => '保留日志事件的天数',
    'At most, keep log events for this many days. Leave blank for no limit.' => '最多保留这么多天的日志事件。留空表示无限制。',
    'Number of log events to retain' => '要保留的日志事件数量',
    'At most, keep this many log events. Leave blank for no limit.' => '最多保留这么多日志事件。留空表示无限制。',

    // Settings: Scheduled sending
    'Scheduled Sending' => '定时发送',
    'Shared secret for authenticating scheduled-run web requests. Required only when the schedule is triggered via the web endpoint.' => '用于验证定时运行 Web 请求的共享密钥。仅在通过 Web 端点触发计划时才需要。',
    'Scheduled-Run Token' => '定时运行令牌',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => '随每个请求一起发送,作为 X-Notifier-Token 标头或 token 主体参数。',

    // Settings: Twilio
    'Twilio API Credentials' => 'Twilio API 凭证',
    'If using the Twilio API to send SMS messages, the following credentials are required.' => '如果使用 Twilio API 发送 SMS,则需要以下凭证。',
    'Twilio Account SID' => 'Twilio 账户 SID',
    'Twilio Auth Token' => 'Twilio 认证令牌',
    'Twilio phone number (sends each SMS message)' => 'Twilio 电话号码(发送每条短信)',
    'SMS Testing' => '短信测试',
    'Optional. When set, every SMS dispatched will be sent to this number instead of the resolved recipient.' => '可选。设置后,每条 SMS 将发送到此号码,而不是实际的收件人。',
    'Test phone number' => '测试电话号码',

    // Settings: Pushover
    "[Pushover](https://pushover.net) sends push notifications to a registered user's devices. Each Craft user needs a custom field on their profile storing their Pushover user key; you select which field on each Notification's Message tab. For full setup instructions, see the [Pushover getting-started docs](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover)." => '[Pushover](https://pushover.net) 向已注册用户的设备发送推送通知。每个 Craft 用户的个人资料上需要一个自定义字段,用于存储其 Pushover 用户密钥;在每个通知的"消息"选项卡上选择使用哪个字段。完整的设置说明请参阅 [Pushover 入门文档](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover)。',
    'Application API Token' => '应用 API 令牌',
    'The 30-character app token from your Pushover application.' => '来自您 Pushover 应用的 30 个字符的应用令牌。',

    // Settings: ntfy
    'ntfy.sh is a free HTTP-based push notification service. Subscribers receive messages on the ntfy app, web, or any compatible client by joining a topic.' => 'ntfy.sh 是一个免费的基于 HTTP 的推送通知服务。订阅者通过加入主题在 ntfy 应用、网页或任何兼容客户端上接收消息。',
    'Server URL' => '服务器 URL',
    'Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`.' => '可选,指向自托管的 ntfy 实例(如适用)。默认为 `https://ntfy.sh`。',
    'Access token' => '访问令牌',
    'Optional, required for protected topics or self-hosted instances with auth.' => '可选,用于受保护主题或带身份验证的自托管实例时必填。',
    'ntfy Topics' => 'ntfy 主题',
    'Add the ntfy topics you\'d like to send messages to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification.' => '添加您希望发送消息的 ntfy 主题。配置通知时,每个主题都可在**收件人**选项卡中作为收件人使用。',
    'Topics' => '主题',
    "Click any row's **Test** button to send a quick test message to that topic." => '点击任意行的 **测试** 按钮以向该主题发送快速测试消息。',
    'Label' => '标签',
    'Topic' => '主题',
    'Add a topic' => '添加主题',

    // Settings: Slack
    'Slack Channels' => 'Slack 频道',
    'Create a [Slack app](https://api.slack.com/apps) with the `chat:write`, `chat:write.customize`, and `chat:write.public` scopes, then add a row for each channel you\'d like to post into. Each channel becomes available as a recipient on the **Recipients** tab when configuring a notification. A bot token is a secret, so store it in a `.env` variable and reference that variable (e.g. `$SLACK_BOT_TOKEN`) rather than pasting the token directly.' => '创建一个具有 `chat:write`、`chat:write.customize` 和 `chat:write.public` 权限范围的 [Slack 应用](https://api.slack.com/apps),然后为你想发布消息的每个频道添加一行。配置通知时,每个频道都可在 **收件人** 标签页中作为收件人使用。机器人令牌是机密,因此请将其存储在 `.env` 变量中并引用该变量(例如 `$SLACK_BOT_TOKEN`),而不是直接粘贴令牌。',
    'Channels' => '频道',
    "Click any row's **Test** button to send a quick test message to that channel." => '点击任意行的 **测试** 按钮以向该频道发送快速测试消息。',
    'Bot Token' => '机器人令牌',
    'Channel ID' => '频道 ID',
    'Add a channel' => '添加频道',
    'Not a valid Bot Token. Must start with `xoxb-`.' => '无效的机器人令牌。必须以 `xoxb-` 开头。',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => '无效的频道 ID。必须类似 `C01234ABCD`。',

    // Settings: Bluesky
    '[Bluesky](https://bsky.app) posts publish to the configured account\'s feed via the ATProto API. App passwords are generated at [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). An app password is a secret, so store it in a `.env` variable and reference that variable (e.g. `$BLUESKY_APP_PASSWORD`) rather than pasting the password directly.' => '[Bluesky](https://bsky.app) 帖子通过 ATProto API 发布到所配置账户的信息流中。应用专用密码在 [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords) 生成。应用专用密码是机密信息，因此请将其保存在 `.env` 变量中，并引用该变量（例如 `$BLUESKY_APP_PASSWORD`），而不是直接粘贴密码。',
    'PDS URL' => 'PDS URL',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => '默认为 https://bsky.social。如您的安装支持联邦,可指向自定义 PDS。',
    'Bluesky Accounts' => 'Bluesky 账号',
    "Add the Bluesky accounts you'd like to post from. Each account becomes available as a recipient on the **Recipients** tab when configuring a notification." => '添加您希望用于发布的 Bluesky 账号。配置通知时,每个账号都可在**收件人**选项卡中作为收件人使用。',
    'Accounts' => '账号',
    "Click any row's **Test** button to confirm the account authenticates." => '点击任意行的 **测试** 按钮以确认该账号能通过认证。',
    'Handle' => '句柄',
    'App password' => '应用密码',
    'Add an account' => '添加账号',

    // ============================================================
    // MANUAL SEND & TEST
    // ============================================================

    // Manual send & test
    'Send a test message' => '发送测试消息',
    'Send a REAL test notification?\\n\\n⚠️ Uses a random sample of real data.\\n⚠️ Sends a real message via the configured channel.\\n⚠️ Delivers to the real configured recipient(s).' => '发送真实的测试通知?\\n\\n⚠️ 使用真实数据的随机样本。\\n⚠️ 通过配置的渠道发送真实消息。\\n⚠️ 发送给配置的真实收件人。',
    'Test' => '测试',
    'Send system snapshot' => '发送系统快照',
    'Send data report' => '发送数据报告',
    'Are you sure you want to send this notification?' => '确定要发送此通知吗？',
    'This notification cannot be triggered manually.' => '此通知无法手动触发。',
    'This notification no longer applies to the selected element.' => '此通知不再适用于所选元素。',

    // ============================================================
    // RUNTIME OUTPUT
    // ============================================================

    // Runtime: dispatch log feedback
    'Sending {messageType} to {recipient}.' => '正在向 {recipient} 发送 {messageType}。',
    'Adding message to queue.' => '正在将消息添加到队列。',
    'Sending message immediately (bypassing queue).' => '立即发送消息(绕过队列)。',
    'Unable to parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => '无法解析订阅源。需要 PHP 的 `simplexml` 和 `libxml` 扩展。',
    'Unable to parse the feed.' => '无法解析订阅源。',
    'Unable to fetch the feed: {message}' => '无法获取订阅源：{message}',
    'Initial feed scan failed: {message}' => '首次订阅源扫描失败：{message}',

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
    'Handle and app password are required.' => '句柄和应用密码为必填项。',
    'Authentication failed.' => '身份验证失败。',
    'Successfully authenticated. No messages were posted.' => '身份验证成功。未发布任何消息。',
    'Log events deleted.' => '日志事件已删除。',
    'Notification sent.' => '通知已发送。',
    'Notification was not sent. Check the Notification Log for details.' => '通知未发送。详情请查看通知日志。',

    // Outbound: per-channel send results
    'Unable to send email, no recipient specified.' => '无法发送邮件:未指定收件人。',
    'Unable to send email, the message body was empty.' => '无法发送邮件:消息正文为空。',
    "Unable to send the email using Craft's native email handling." => '无法使用 Craft 原生邮件处理发送邮件。',
    'Check your general email settings within Craft.' => '请检查 Craft 中的常规邮件设置。',
    'Successfully sent email message!' => '邮件发送成功!',
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[Twilio 凭证无效。]({url}) 缺少 {missing}。',
    'Unable to send SMS, no Twilio phone number exists.' => '无法发送短信:不存在 Twilio 电话号码。',
    'Unable to send SMS, no recipient phone number exists.' => '无法发送短信:不存在收件人电话号码。',
    'Unable to send SMS, recipient phone number is invalid.' => '无法发送短信:收件人电话号码无效。',
    'Successfully sent SMS message!' => '短信发送成功!',
    'Unable to post announcement, no recipient userId specified.' => '无法发布公告:未指定收件人 userId。',
    'Successfully posted announcement!' => '公告发布成功!',
    'Unable to send the flash message, invalid flash type.' => '无法发送闪现消息:闪现类型无效。',
    'Successfully sent flash message!' => '闪现消息发送成功!',
    '[Invalid Pushover credentials.]({url}) Missing app token.' => '[Pushover 凭证无效。]({url}) 缺少应用令牌。',
    'Unable to send Pushover message, no user key on recipient.' => '无法发送 Pushover 消息:收件人没有用户密钥。',
    'Pushover POST failed: {reason}' => 'Pushover POST 失败:{reason}',
    'Successfully sent Pushover message!' => 'Pushover 消息发送成功!',
    'Unable to send ntfy message, no topic specified.' => '无法发送 ntfy 消息:未指定主题。',
    'ntfy POST failed with HTTP {status}: {reason}' => 'ntfy POST 失败,HTTP {status}:{reason}',
    'ntfy POST failed: {reason}' => 'ntfy POST 失败:{reason}',
    'Successfully sent ntfy message to topic "{topic}".' => '已成功发送 ntfy 消息到主题 "{topic}"。',
    'Unable to send Slack message, no bot token.' => '无法发送 Slack 消息：没有机器人令牌。',
    'Unable to send Slack message, no channel ID.' => '无法发送 Slack 消息:没有频道 ID。',
    'Unable to send Slack message, body is empty.' => '无法发送 Slack 消息:正文为空。',
    'Slack rejected the message: {error}' => 'Slack 拒绝了消息：{error}',
    'Slack POST failed: {reason}' => 'Slack POST 失败:{reason}',
    'Successfully sent Slack message to "{label}".' => '已成功发送 Slack 消息到 "{label}"。',
    'Unable to send Bluesky post, recipient is missing credentials.' => '无法发送 Bluesky 帖子:收件人缺少凭据。',
    'Body exceeded {max} characters, truncated.' => '正文超过 {max} 个字符,已截断。',
    'Successfully posted to Bluesky as "{label}".' => '已成功以 "{label}" 在 Bluesky 上发布。',
    'Bluesky auth failed for {handle}: {reason}' => '{handle} 的 Bluesky 身份验证失败:{reason}',
    'Bluesky auth failed: {reason}' => 'Bluesky 身份验证失败:{reason}',
    'Bluesky post failed: {reason}' => 'Bluesky 帖子失败:{reason}',
    'Bluesky link preview skipped: {reason}' => '已跳过 Bluesky 链接预览：{reason}',

    // Recipient warnings
    'Recipient "{name}" has no email address.' => '收件人 "{name}" 没有电子邮件地址。',
    'Recipient "{name}" has no phone number.' => '收件人 "{name}" 没有电话号码。',
    'Recipient "{name}" has no associated User; cannot send announcement.' => '收件人 "{name}" 没有关联的用户;无法发送公告。',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => '收件人 "{name}" 无法访问控制面板;无法发送公告。',
    'Pushover user-key field is not configured on this notification.' => '此通知未配置 Pushover 用户密钥字段。',
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => '收件人 "{name}" 没有关联的用户;无法发送 Pushover 消息。',
    '[SKIPPED] User "{name}" has no Pushover key.' => '[已跳过] 用户 "{name}" 没有 Pushover 密钥。',
    'Recipient "{name}" has no ntfy topic.' => '收件人 "{name}" 没有 ntfy 主题。',
    'Recipient "{name}" has no Bluesky credentials.' => '收件人 "{name}" 没有 Bluesky 凭据。',
    'Recipient "{name}" has no Slack bot token.' => '收件人 "{name}" 没有 Slack 机器人令牌。',
    'Recipient "{name}" has no Slack channel ID.' => '收件人 "{name}" 没有 Slack 频道 ID。',

    // Errors & exceptions
    'Invalid element event: {class}' => '无效的元素事件:{class}',
    'Invalid notification ID: {id}' => '通知 ID 无效:{id}',
    'Invalid email message mode.' => '无效的邮件消息模式。',
    'You do not have permission to use the Dynamic Recipients type.' => '您没有权限使用动态收件人类型。',
    'Dynamic recipients snippet did not call setRecipients.' => '动态收件人代码片段未调用 setRecipients。',
    'setRecipients was called with an empty value.' => 'setRecipients 调用时传入了空值。',
    'Unrecognized recipient of type "{type}".' => '未识别的 "{type}" 类型收件人。',
    'Unrecognized recipient "{value}".' => '未识别的收件人 "{value}"。',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => '已配置的 {kind} 不再存在于插件设置中 (uid: {uid})。',
    'Invalid settings section: {section}' => '无效的设置部分:{section}',
    'User not authorized to save this notification.' => '用户无权保存此通知。',
    'User not authorized to view this notification.' => '用户无权查看此通知。',
    'User not authorized to delete this notification.' => '用户无权删除此通知。',
    'Notification not found' => '未找到通知',
    'Element not found' => '未找到元素',
    'You do not have permission to use the Dynamic Data type.' => '您无权使用动态数据类型。',
    'The Dynamic Data snippet did not call the {tag} tag.' => 'Twig 代码片段未调用 {tag} 标签。',
    'Invalid Slack body format.' => '无效的 Slack 正文格式。',

    // Config-file override note
    'This is being set in the config file. [{file}]' => '此项在配置文件中设置。[{file}]',

    // ============================================================
    // JAVASCRIPT UI
    // ============================================================

    // JavaScript: log utility & buttons
    'Test notification failed.' => '测试通知失败。',
    'Unable to get the notification, something went wrong.' => '无法获取通知，出错了。',
    'Something went wrong.' => '出错了。',
    'Invalid notification ID.' => '通知 ID 无效。',
    'Unable to delete the log event, something went wrong.' => '无法删除日志事件，出错了。',
    'Log event deleted.' => '日志事件已删除。',
    'Unable to delete log events, something went wrong.' => '无法删除日志事件，出错了。',
    'Are you sure you want to delete this log event?' => '确定要删除此日志事件吗？',
    'Are you sure you want to delete all logs from {date}?' => '确定要删除 {date} 的所有日志吗？',

    // ============================================================
    // MQTT
    // ============================================================

    'Recipient "{name}" has no MQTT topic.' => '收件人“{name}”没有 MQTT 主题。',
    'Unable to send MQTT message, no broker host configured.' => '无法发送 MQTT 消息,未配置代理主机。',
    'Unable to send MQTT message, no topic specified.' => '无法发送 MQTT 消息,未指定主题。',
    'Unable to send MQTT message, the payload is empty.' => '无法发送 MQTT 消息,内容为空。',
    'MQTT publish failed: {reason}' => 'MQTT 发布失败:{reason}',
    'Successfully sent MQTT message to topic "{topic}".' => '已成功向主题“{topic}”发送 MQTT 消息。',
    'MQTT Broker' => 'MQTT 代理',
    'Notifier publishes to an MQTT broker (such as Mosquitto, EMQX, HiveMQ, or AWS IoT Core). Enter the broker connection details below. Sensitive values can be stored in a `.env` variable and referenced here (e.g. `$MQTT_PASSWORD`).' => 'Notifier 会向 MQTT 代理(如 Mosquitto、EMQX、HiveMQ 或 AWS IoT Core)发布消息。请在下方输入代理的连接信息。敏感值可以存储在 `.env` 变量中并在此引用(例如 `$MQTT_PASSWORD`)。',
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
    'Optional. Required for brokers that authenticate clients with certificates, such as AWS IoT Core. Provide server file paths to the certificate files (a `.env` variable or `@alias` reference is allowed).' => '可选。适用于使用证书验证客户端的代理(如 AWS IoT Core)。请提供证书文件的服务器文件路径(允许使用 `.env` 变量或 `@alias` 引用)。',
    'CA Certificate File' => 'CA 证书文件',
    'Path to the certificate authority (CA) file.' => '证书颁发机构(CA)文件的路径。',
    'Client Certificate File' => '客户端证书文件',
    'Path to the client certificate file.' => '客户端证书文件的路径。',
    'Client Key File' => '客户端密钥文件',
    'Path to the client private key file.' => '客户端私钥文件的路径。',
    'MQTT Topics' => 'MQTT 主题',
    'Add the MQTT topics you\'d like to publish to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification.' => '添加您希望发布的 MQTT 主题。配置通知时,每个主题都可在**收件人**选项卡中作为收件人使用。',
    'Click any row\'s **Test** button to publish a quick test message to that topic.' => '点击任意行的 **测试** 按钮以向该主题发布快速测试消息。',
    'MQTT' => 'MQTT',
    'Payload' => '负载',
    'The message published to the topic. Can be plain text or a Twig-rendered JSON object.' => '发布到主题的消息。可以是纯文本或由 Twig 渲染的 JSON 对象。',
    'Quality of Service' => '服务质量',
    'Delivery guarantee for this message.' => '此消息的传递保证。',
    'Retain' => '保留',
    'Whether the broker keeps this as the topic\'s last message for future subscribers.' => '代理是否将其保留为该主题的最后一条消息,并传递给将来的订阅者。',
    'Don\'t retain' => '不保留',
    'Select MQTT topic(s)' => '选择 MQTT 主题',
    'Which topics should receive this message?' => '哪些主题应接收此消息?',
    'No MQTT topics configured. Add one in [Settings → MQTT]({url}).' => '未配置 MQTT 主题。请在[设置 → MQTT]({url})中添加一个。',
    'Not a valid topic. Must not be empty or contain the `+` or `#` wildcards.' => '不是有效的主题。不能为空,也不能包含通配符 `+` 或 `#`。',
    'Broker host is not configured.' => '未配置代理主机。',

    // ============================================================
    // Recipient empty-state (administrative changes disabled)
    // ============================================================

    'No ntfy topics configured. Topics can only be added in an environment that allows administrative changes.' => '未配置 ntfy 主题。主题只能在允许管理更改的环境中添加。',
    'No Slack channels configured. Channels can only be added in an environment that allows administrative changes.' => '未配置 Slack 频道。频道只能在允许管理更改的环境中添加。',
    'No Bluesky accounts configured. Accounts can only be added in an environment that allows administrative changes.' => '未配置 Bluesky 账号。账号只能在允许管理更改的环境中添加。',
    'No MQTT topics configured. Topics can only be added in an environment that allows administrative changes.' => '未配置 MQTT 主题。主题只能在允许管理更改的环境中添加。',
];
