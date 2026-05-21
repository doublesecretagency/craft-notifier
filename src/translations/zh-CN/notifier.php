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
    'Meta'       => '元信息',
    'Event'      => '事件',
    'Message'    => '消息',
    'Recipients' => '收件人',

    // Event tab: type selector
    'Event Type'                                           => '事件类型',
    'What type of event will activate the notification?'   => '什么类型的事件将激活此通知?',
    'Which specific event will activate the notification?' => '哪个具体事件将激活此通知?',

    // Event tab: event types
    'Assets Event'                   => '资源事件',
    'Commerce Orders Event'          => 'Commerce 订单事件',
    'Commerce Products Event'        => 'Commerce 产品事件',
    'Digital Products Event'         => 'Digital Products 事件',
    'Digital Product Licenses Event' => 'Digital Products 许可证事件',
    'Solspace Calendar Event'        => 'Solspace Calendar 事件',
    'Entries Event'                  => '条目事件',
    'Users Event'                    => '用户事件',
    'Ungrouped Users'                => '未分组用户',

    // Feed
    'Feed Event' => 'Feed 事件',
    'Feed URL' => 'Feed URL',
    'The URL of the RSS, Atom, or JSON feed to watch.' => '要监控的 RSS、Atom 或 JSON Feed 的 URL。',
    // Field and element conditions
    'Field Conditions'             => '字段条件',
    'Send the message only when the saved element matches the following conditions.' => '仅在保存的元素符合以下条件时发送消息。',
    'has changed'                  => '已更改',
    '#{elementType} Event Filters' => '#{elementType} 事件筛选条件',
    'No filters match this event.' => '没有筛选条件匹配此事件。',
    'Determine whether each message should be sent based on specified conditions.' => '根据指定的条件确定是否发送每条消息。',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => '元素正在首次保存',
    'Must be a new entry'                       => '必须是新条目',
    'Must be an existing entry'                 => '必须是现有条目',
    'Can be existing or new'                    => '可以是现有或新的',

    // Filters: new elements
    'Element is new'         => '元素是新的',
    'New elements only'      => '仅限新元素',
    'Existing elements only' => '仅限现有元素',

    // Filters: enabled state
    'Element is enabled'         => '元素已启用',
    'Must be enabled'            => '必须启用',
    'Must be disabled'           => '必须禁用',
    'Can be enabled or disabled' => '可以启用或禁用',

    // Filters: drafts
    'Element is a draft'          => '元素是草稿',
    'Must be a draft'             => '必须是草稿',
    'Must not be a draft'         => '不得为草稿',
    'Can be a draft or non-draft' => '可以是草稿或非草稿',

    // Filters: provisional drafts
    'Element is a provisional draft'                => '元素是临时草稿',
    'Must be a provisional draft'                   => '必须是临时草稿',
    'Must not be a provisional draft'               => '不得为临时草稿',
    'Can be a provisional draft or non-provisional' => '可以是临时草稿或非临时草稿',

    // Filters: revisions
    'Element is a revision'             => '元素是版本',
    'Must be a revision'                => '必须是版本',
    'Must not be a revision'            => '不得为版本',
    'Can be a revision or non-revision' => '可以是版本或非版本',

    // Filters: duplication
    'Element is being duplicated'         => '元素正在被复制',
    'Must be duplicating the element'     => '必须正在复制元素',
    'Must not be duplicating the element' => '不得正在复制元素',

    // Filters: propagation
    'Element is being propagated'     => '元素正在传播',
    'Element must be propagating'     => '元素必须正在传播',
    'Element must not be propagating' => '元素不得正在传播',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => '元素正在批量重新保存',
    'Must be bulk-resaving the element'     => '必须正在批量重新保存元素',
    'Must not be bulk-resaving the element' => '不得正在批量重新保存元素',

    // Filters: common output
    'Unnamed filter'                => '未命名筛选条件',
    'Must be TRUE to send message'  => '必须为 TRUE 才能发送消息',
    'Must be FALSE to send message' => '必须为 FALSE 才能发送消息',
    'No effect'                     => '无效',

    // Message tab: type selector and queue
    'Message Type'                       => '消息类型',
    'What type of message will be sent?' => '将发送什么类型的消息?',
    'Send Message via Queue'             => '通过队列发送消息',
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are also supported.' => '也支持[模板]({templatingUrl})和[特殊变量]({variablesUrl})。',
    'Send immediately' => '立即发送',
    'Add to queue' => '加入队列',

    // Message tab: Email fields
    "User's Email Address Field" => '用户的电子邮件地址字段',
    'Email Subject'              => '邮件主题',
    'Email Body'                 => '邮件正文',

    // Message tab: SMS fields
    "User's Phone Number Field" => '用户的电话号码字段',
    'SMS Message Body'          => '短信内容',

    // Message tab: Announcement fields
    'Announcement Title'   => '公告标题',
    'Announcement Message' => '公告消息',

    // Message tab: Flash fields
    'Flash Message Type'                         => '闪现消息类型',
    'Flash Message Title'                        => '闪现消息标题',
    'Flash Message Details'                      => '闪现消息详情',
    'Which type of flash message should appear?' => '应显示什么类型的闪现消息?',

    // Message tab: Pushover fields
    "Field containing each user's Pushover key" => '用户的 Pushover 密钥字段',

    // Message tab: ntfy fields
    'Priority'           => '优先级',
    'Tags'               => '标签',
    'Click URL'          => '点击 URL',
    'Render as Markdown' => '渲染为 Markdown',

    // Message tab: Slack fields
    'Slack Message Body' => 'Slack 消息正文',
    'Bot Icon URL' => '图标 URL',
    "A URL for the icon to display alongside this message. Leave blank to use the app's default." => '在此消息旁显示的图标的 URL。留空以使用频道默认值。',

    // Message tab: Bluesky fields
    'Post Body' => '帖子正文',
    'Generate Link Preview' => '生成链接预览',
    "When the post body contains a URL, automatically generate a preview card with the linked page's image, title, and description." => '当帖子正文包含 URL 时，附加一张预览卡片，显示所链接页面的标题、描述和图片。',
    'No card' => '无卡片',
    'Generate preview card' => '生成预览卡片',

    // Message tab: Title / Body / Trix toolbar
    'Title'         => '标题',
    'Body'          => '正文',
    'Rich Text'     => '富文本',
    'Bold'          => '粗体',
    'Italic'        => '斜体',
    'Underline'     => '下划线',
    'Strikethrough' => '删除线',
    'Bullets'       => '项目符号',
    'Numbers'       => '编号',
    'Heading'       => '标题',
    'Code'          => '代码',
    'Undo'          => '撤销',
    'Redo'          => '重做',
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => '外发邮件正文。您可以使用<a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">特殊变量</a>,甚至<a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">跳过收件人</a>。',

    // Recipients tab: common
    'Recipients Type'                             => '收件人类型',
    'Who will receive this message?'              => '谁将收到此消息?',
    'Add a message recipient'                     => '添加消息收件人',
    'Select User(s)'                              => '选择用户',
    'Which users will receive the message?'       => '哪些用户将收到此消息?',
    'Which user groups will receive the message?' => '哪些用户组将收到此消息?',
    'Twig Snippet to Determine Recipients'        => '用于确定收件人的 Twig 代码片段',

    // Recipients tab: per-provider pickers
    'Select Slack channel(s)'                           => '选择 Slack 频道',
    'Which Slack channels should receive this message?' => '哪些 Slack 频道应收到此消息?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => '未配置 Slack 频道。请在[设置 → Slack]({url})中添加一个。',
    'Select ntfy topic(s)'                              => '选择 ntfy 主题',
    'Which ntfy topics should receive this message?'    => '哪些 ntfy 主题应收到此消息?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => '未配置 ntfy 主题。请在[设置 → ntfy]({url})中添加一个。',
    'Select Bluesky account(s)'                         => '选择 Bluesky 账号',
    'Which Bluesky accounts should post this message?'  => '哪些 Bluesky 账号应发布此消息?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => '未配置 Bluesky 账号。请在[设置 → Bluesky]({url})中添加一个。',

    // Settings: page chrome
    'Notifier Settings' => 'Notifier 设置',
    'General'           => '常规',
    'Twilio'            => 'Twilio',
    'Pushover'          => 'Pushover',
    'Slack'             => 'Slack',
    'Bluesky'           => 'Bluesky',
    'ntfy'              => 'ntfy',

    // Settings: Logging
    'Logging'                             => '日志记录',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier 持续记录已发送消息的日志。通常不需要,但您可以限制存入数据库的日志事件数量。',
    'Enable Logging'                      => '启用日志记录',
    'When disabled, Notifier will not write anything to the notification log.' => '禁用时,Notifier 不会向通知日志写入任何内容。',
    'Number of days to retain log events' => '保留日志事件的天数',
    'At most, keep log events for this many days. Leave blank for no limit.' => '最多保留这么多天的日志事件。留空表示无限制。',
    'Number of log events to retain'      => '要保留的日志事件数量',
    'At most, keep this many log events. Leave blank for no limit.' => '最多保留这么多日志事件。留空表示无限制。',

    // Settings: Twilio
    'Twilio API Credentials'                       => 'Twilio API 凭证',
    'If using the Twilio API to send SMS messages, the following credentials are required.' => '如果使用 Twilio API 发送 SMS,则需要以下凭证。',
    'Twilio Account SID'                           => 'Twilio 账户 SID',
    'Twilio Auth Token'                            => 'Twilio 认证令牌',
    'Twilio phone number (sends each SMS message)' => 'Twilio 电话号码(发送每条短信)',
    'SMS Testing'                                  => '短信测试',
    'Optional. When set, every SMS dispatched will be sent to this number instead of the resolved recipient.' => '可选。设置后,每条 SMS 将发送到此号码,而不是实际的收件人。',
    'Test phone number'                            => '测试电话号码',

    // Settings: Pushover
    "[Pushover](https://pushover.net) sends push notifications to a registered user's devices. Each Craft user needs a custom field on their profile storing their Pushover user key; you select which field on each Notification's Message tab. For full setup instructions, see the [Pushover getting-started docs](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover)." => '[Pushover](https://pushover.net) 向已注册用户的设备发送推送通知。每个 Craft 用户的个人资料上需要一个自定义字段,用于存储其 Pushover 用户密钥;在每个通知的"消息"选项卡上选择使用哪个字段。完整的设置说明请参阅 [Pushover 入门文档](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover)。',
    'Application API Token'                                      => '应用 API 令牌',
    'The 30-character app token from your Pushover application.' => '来自您 Pushover 应用的 30 个字符的应用令牌。',

    // Settings: ntfy
    'ntfy.sh is a free HTTP-based push notification service. Subscribers receive messages on the ntfy app, web, or any compatible client by joining a topic.' => 'ntfy.sh 是一个免费的基于 HTTP 的推送通知服务。订阅者通过加入主题在 ntfy 应用、网页或任何兼容客户端上接收消息。',
    'Server URL'   => '服务器 URL',
    'Defaults to https://ntfy.sh. Point at a self-hosted ntfy instance if applicable.' => '默认为 https://ntfy.sh。如适用,可指向自托管的 ntfy 实例。',
    'Access token' => '访问令牌',
    'Optional. Required for protected topics or self-hosted instances with auth.' => '可选。用于受保护主题或带身份验证的自托管实例时必填。',
    'ntfy Topics'  => 'ntfy 主题',
    'Named list of ntfy topics. Each topic becomes selectable on the notification edit screen.' => '命名的 ntfy 主题列表。每个主题都可以在通知编辑界面中选择。',
    'Topics'       => '主题',
    'Add one row per topic name. Use the **Test** button to send a quick test message to the topic.' => '每个主题名称添加一行。使用 **Test** 按钮向主题发送快速测试消息。',
    'Topic'        => '主题',
    'Add a topic'  => '添加主题',
    'Save first to persist a row, then click its **Test** button to fire a sanity check against ntfy.' => '先保存以保留一行,然后点击其 **Test** 按钮对 ntfy 进行快速检查。',

    // Settings: Slack
    'Slack Channels' => 'Slack 频道',
    'Create a [Slack app](https://api.slack.com/apps) with the `chat:write`, `chat:write.customize`, and `chat:write.public` scopes, then add a row for each channel you\'d like to post into. Each channel becomes available as a recipient on the **Recipients** tab when configuring a notification. A bot token is a secret, so store it in a `.env` variable and reference that variable (e.g. `$SLACK_BOT_TOKEN`) rather than pasting the token directly.' => '创建一个具有 `chat:write`、`chat:write.customize` 和 `chat:write.public` 权限范围的 [Slack 应用](https://api.slack.com/apps),然后为你想发布消息的每个频道添加一行。配置通知时,每个频道都可在 **Recipients** 标签页中作为收件人使用。机器人令牌是机密,因此请将其存储在 `.env` 变量中并引用该变量(例如 `$SLACK_BOT_TOKEN`),而不是直接粘贴令牌。',
    'Channels'       => '频道',
    'Each Slack channel needs its own Incoming Webhook URL. Use the **Test** button to fire a quick sanity check after saving.' => '每个 Slack 频道需要自己的 Incoming Webhook URL。保存后,使用 **Test** 按钮进行快速检查。',
    'Add a channel'  => '添加频道',
    'Bot Token' => '机器人令牌',
    'Channel ID' => '频道 ID',
    'Bot Emoji' => '图标表情',
    'Bot Name' => '用户名',
    'Show link previews' => '显示链接预览',
    'An emoji shortcode to display alongside this message, e.g. `:rocket:`. Used only when Bot Icon URL is empty.' => '在此消息旁显示的表情快捷码，例如 `:rocket:`。仅在图标 URL 为空时使用。',
    "A display name for this message. Leave blank to use the app's default." => '此消息的显示名称。留空以使用应用的默认值。',
    'Whether Slack should unfurl link previews for URLs in the message body.' => 'Slack 是否应展开消息正文中 URL 的链接预览。',
    'Not a valid Bot Token. Must start with `xoxb-`.' => '无效的机器人令牌。必须以 `xoxb-` 开头。',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => '无效的频道 ID。必须类似 `C01234ABCD`。',
    'Unable to send Slack message, no bot token.' => '无法发送 Slack 消息：没有机器人令牌。',
    'Unable to send Slack message, no channel ID.' => '无法发送 Slack 消息:没有频道 ID。',
    'Recipient "{name}" has no Slack bot token.' => '收件人 "{name}" 没有 Slack 机器人令牌。',
    'Recipient "{name}" has no Slack channel ID.' => '收件人 "{name}" 没有 Slack 频道 ID。',
    'Slack rejected the message: {error}' => 'Slack 拒绝了消息：{error}',
    'Save first to persist a row, then click its **Test** button to fire a sanity check against Slack.' => '先保存以保留一行,然后点击其 **Test** 按钮对 Slack 进行快速检查。',

    // Settings: Bluesky
    '[Bluesky](https://bsky.app) posts publish to the configured account\'s feed via the ATProto API. App passwords are generated at [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). An app password is a secret, so store it in a `.env` variable and reference that variable (e.g. `$BLUESKY_APP_PASSWORD`) rather than pasting the password directly.' => '[Bluesky](https://bsky.app) 帖子通过 ATProto API 发布到所配置账户的信息流中。应用专用密码在 [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords) 生成。应用专用密码是机密信息，因此请将其保存在 `.env` 变量中，并引用该变量（例如 `$BLUESKY_APP_PASSWORD`），而不是直接粘贴密码。',
    'PDS URL'          => 'PDS URL',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => '默认为 https://bsky.social。如您的安装支持联邦,可指向自定义 PDS。',
    'Bluesky Accounts' => 'Bluesky 账号',
    'Named list of Bluesky accounts. Each account becomes selectable on the notification edit screen.' => '命名的 Bluesky 账号列表。每个账号都可以在通知编辑界面中选择。',
    'Accounts'         => '账号',
    'Add one row per Bluesky account. Use **Test** to verify the credentials authenticate.' => '每个 Bluesky 账号添加一行。使用 **Test** 验证凭据是否能通过认证。',
    'Label'            => '标签',
    'Handle'           => '句柄',
    'App password'     => '应用密码',
    'Add an account'   => '添加账号',
    'Save first to persist a row, then click its **Test** button to verify the credentials authenticate.' => '先保存以保留一行,然后点击其 **Test** 按钮验证凭据是否能通过认证。',

    // Test notification (UI)
    'Send a test message'           => '发送测试消息',
    'Are you certain you want to send a test notification?\\n\\nThe configured message will be sent to the configured recipient(s).' => '确定要发送测试通知吗?\\n\\n配置的消息将发送给配置的收件人。',
    'Test'                          => '测试',
    'Test notification dispatched.' => '已发送测试通知。',
    'No messages were dispatched. Check the recipient configuration.' => '未发送任何消息。请检查收件人配置。',

    // Settings: save / test action responses
    "Couldn't save settings."                 => '无法保存设置。',
    'Settings saved.'                         => '设置已保存。',
    'Topic is empty.'                         => '主题为空。',
    'Server URL is not configured.'           => '服务器 URL 未配置。',
    'Test message from Notifier.'             => '来自 Notifier 的测试消息。',
    'HTTP {status}'                           => 'HTTP {status}',
    'Test message sent successfully.'         => '测试消息发送成功。',
    'HTTP {status}: {body}'                   => 'HTTP {status}: {body}',
    'Handle and app password are required.'   => '句柄和应用密码为必填项。',
    'Authentication failed.'                  => '身份验证失败。',
    'Successfully authenticated. No messages were posted.' => '身份验证成功。未发布任何消息。',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.'          => '正在向 {recipient} 发送 {messageType}。',
    'Adding message to queue.'                       => '正在将消息添加到队列。',
    'Unable to parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => '无法解析订阅源。需要 PHP 的 `simplexml` 和 `libxml` 扩展。',
    'Unable to parse the feed.' => '无法解析订阅源。',
    'Unable to fetch the feed: {message}' => '无法获取订阅源：{message}',
    'Initial feed scan failed: {message}' => '首次订阅源扫描失败：{message}',
    'Sending message immediately (bypassing queue).' => '立即发送消息(绕过队列)。',
    'Log events deleted.'                            => '日志事件已删除。',
    'notification'                                   => '通知',

    // Outbound: Email log messages
    'Unable to send email, no recipient specified.'     => '无法发送邮件:未指定收件人。',
    'Unable to send email, the message body was empty.' => '无法发送邮件:消息正文为空。',
    "Unable to send the email using Craft's native email handling." => '无法使用 Craft 原生邮件处理发送邮件。',
    'Check your general email settings within Craft.'   => '请检查 Craft 中的常规邮件设置。',
    'Successfully sent email message!'                  => '邮件发送成功!',

    // Outbound: SMS log messages
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[Twilio 凭证无效。]({url}) 缺少 {missing}。',
    'Unable to send SMS, no Twilio phone number exists.'      => '无法发送短信:不存在 Twilio 电话号码。',
    'Unable to send SMS, no recipient phone number exists.'   => '无法发送短信:不存在收件人电话号码。',
    'Unable to send SMS, recipient phone number is invalid.'  => '无法发送短信:收件人电话号码无效。',
    'Successfully sent SMS message!'                          => '短信发送成功!',

    // Outbound: Announcement log messages
    'Unable to post announcement, no recipient userId specified.' => '无法发布公告:未指定收件人 userId。',
    'Successfully posted announcement!' => '公告发布成功!',

    // Outbound: Flash log messages
    'Unable to send the flash message, invalid flash type.' => '无法发送闪现消息:闪现类型无效。',
    'Successfully sent flash message!'                      => '闪现消息发送成功!',

    // Outbound: Pushover log messages
    '[Invalid Pushover credentials.]({url}) Missing app token.'  => '[Pushover 凭证无效。]({url}) 缺少应用令牌。',
    'Unable to send Pushover message, no user key on recipient.' => '无法发送 Pushover 消息:收件人没有用户密钥。',
    'Pushover POST failed: {reason}'                             => 'Pushover POST 失败:{reason}',
    'Successfully sent Pushover message!'                        => 'Pushover 消息发送成功!',

    // Outbound: ntfy log messages
    'Unable to send ntfy message, no server URL configured.' => '无法发送 ntfy 消息:未配置服务器 URL。',
    'Unable to send ntfy message, no topic specified.'       => '无法发送 ntfy 消息:未指定主题。',
    'ntfy POST failed with HTTP {status}: {reason}'          => 'ntfy POST 失败,HTTP {status}:{reason}',
    'ntfy POST failed: {reason}'                             => 'ntfy POST 失败:{reason}',
    'Successfully sent ntfy message to topic "{topic}".'     => '已成功发送 ntfy 消息到主题 "{topic}"。',

    // Outbound: Slack log messages
    'Unable to send Slack message, body is empty.'  => '无法发送 Slack 消息:正文为空。',
    'Slack POST failed: {reason}'                   => 'Slack POST 失败:{reason}',
    'Successfully sent Slack message to "{label}".' => '已成功发送 Slack 消息到 "{label}"。',

    // Outbound: Bluesky log messages
    'Unable to send Bluesky post, recipient is missing credentials.' => '无法发送 Bluesky 帖子:收件人缺少凭据。',
    'Body exceeded {max} characters, truncated.'          => '正文超过 {max} 个字符,已截断。',
    'Successfully posted to Bluesky as "{label}".'        => '已成功以 "{label}" 在 Bluesky 上发布。',
    'Bluesky auth failed for {handle}: {reason}'          => '{handle} 的 Bluesky 身份验证失败:{reason}',
    'Bluesky auth failed: {reason}'                       => 'Bluesky 身份验证失败:{reason}',
    'Bluesky post failed: {reason}'                       => 'Bluesky 帖子失败:{reason}',
    'Bluesky link preview skipped: {reason}'              => '已跳过 Bluesky 链接预览：{reason}',

    // Recipient-strategy warnings
    'Recipient "{name}" has no email address.'       => '收件人 "{name}" 没有电子邮件地址。',
    'Recipient "{name}" has no phone number.'        => '收件人 "{name}" 没有电话号码。',
    'Recipient "{name}" has no associated User; cannot send announcement.' => '收件人 "{name}" 没有关联的用户;无法发送公告。',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => '收件人 "{name}" 无法访问控制面板;无法发送公告。',
    'Pushover user-key field is not configured on this notification.' => '此通知未配置 Pushover 用户密钥字段。',
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => '收件人 "{name}" 没有关联的用户;无法发送 Pushover 消息。',
    '[SKIPPED] User "{name}" has no Pushover key.'   => '[已跳过] 用户 "{name}" 没有 Pushover 密钥。',
    'Recipient "{name}" has no ntfy topic.'          => '收件人 "{name}" 没有 ntfy 主题。',
    'Recipient "{name}" has no Bluesky credentials.' => '收件人 "{name}" 没有 Bluesky 凭据。',

    // Errors / exceptions
    'Invalid element event: {class}'                         => '无效的元素事件:{class}',
    'Invalid notification ID: {id}'                          => '通知 ID 无效:{id}',
    'Invalid email message mode.'                            => '无效的邮件消息模式。',
    'You do not have permission to use the Dynamic Recipients type.' => '您没有权限使用动态收件人类型。',
    'Dynamic recipients snippet did not call setRecipients.' => '动态收件人代码片段未调用 setRecipients。',
    'setRecipients was called with an empty value.'          => 'setRecipients 调用时传入了空值。',
    'Unrecognized recipient of type "{type}".'               => '未识别的 "{type}" 类型收件人。',
    'Unrecognized recipient "{value}".'                      => '未识别的收件人 "{value}"。',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => '已配置的 {kind} 不再存在于插件设置中 (uid: {uid})。',
    'Invalid settings section: {section}'                    => '无效的设置部分:{section}',
    'User not authorized to save this notification.'         => '用户无权保存此通知。',
    'User not authorized to view this notification.'         => '用户无权查看此通知。',
    'User not authorized to delete this notification.'       => '用户无权删除此通知。',
    'Notification not found'                                 => '未找到通知',

    // Misc config-file note
    'This is being set in the config file. [{file}]' => '此项在配置文件中设置。[{file}]',

    // Slack, ntfy, and Bluesky message types
    "Add the Bluesky accounts you'd like to post from. Each account becomes available as a recipient on the **Recipients** tab when configuring a notification." => '添加您希望用于发布的 Bluesky 账号。配置通知时,每个账号都可在**收件人**选项卡中作为收件人使用。',
    "Click any row's **Test** button to confirm the account authenticates." => '点击任意行的 **Test** 按钮以确认该账号能通过认证。',
    "Click any row's **Test** button to send a quick test message to that channel." => '点击任意行的 **Test** 按钮以向该频道发送快速测试消息。',
    'Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`.' => '可选,指向自托管的 ntfy 实例(如适用)。默认为 `https://ntfy.sh`。',
    'Optional, required for protected topics or self-hosted instances with auth.' => '可选,用于受保护主题或带身份验证的自托管实例时必填。',
    'Add the ntfy topics you\'d like to send messages to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification.' => '添加您希望发送消息的 ntfy 主题。配置通知时,每个主题都可在**收件人**选项卡中作为收件人使用。',
    "Click any row's **Test** button to send a quick test message to that topic." => '点击任意行的 **Test** 按钮以向该主题发送快速测试消息。',
    'Enable Markdown' => '启用 Markdown',
    'Link URL' => '链接 URL',

    // Manual triggers
    'Send Notification'                                            => '发送通知',
    'Send manual notifications'                                    => '发送手动通知',
    'Are you sure you want to send this notification?'             => '确定要发送此通知吗？',
    'This notification cannot be triggered manually.'              => '此通知无法手动触发。',
    'This notification no longer applies to the selected element.' => '此通知不再适用于所选元素。',
    'Notification was not sent. Check the Notification Log for details.' => '通知未发送。详情请查看通知日志。',
    'Notification sent.'                                           => '通知已发送。',
    'Element not found'                                            => '未找到元素',
    'Trigger Label'                                                => '触发标签',
    'An element action label (helps to differentiate multiple triggers).'        => '元素操作标签（有助于区分多个触发）。',

    // Event tab: date trigger
    'On'                                                          => '当天',
    'days before'                                                 => '天前',
    'days after'                                                  => '天后',
    'Relevant Date'                                               => '相关日期',
    'Send the notification relative to a chosen date.'            => '相对于选定日期发送通知。',
    "Fires when an entry's Post Date passes and it becomes Live." => '当条目的发布日期到达并变为已发布状态时触发。',

    // Scheduled sending
    'Scheduled Sending' => '定时发送',
    'Shared secret for authenticating scheduled-run web requests. Required only when the schedule is triggered via the web endpoint.' => '用于验证定时运行 Web 请求的共享密钥。仅在通过 Web 端点触发计划时才需要。',
    'Scheduled-Run Token' => '定时运行令牌',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => '随每个请求一起发送,作为 X-Notifier-Token 标头或 token 主体参数。',
    'Pushover Title' => 'Pushover 标题',
    'Pushover Body' => 'Pushover 正文',
    'ntfy Title' => 'ntfy 标题',
    'ntfy Body' => 'ntfy 正文',
    'ntfy Link URL' => 'ntfy 链接 URL',
    'Render Link Previews' => '显示链接预览',
    'Don\'t unfurl' => '不展开',
    'Expand link previews' => '展开链接预览',
    'Regular text only' => '仅纯文本',
    'Markdown enabled' => 'Markdown 已启用',
    'Dynamic Pushover Title' => '动态 Pushover 标题',
    'Dynamic Subject Line' => '动态主题行',
    'Dynamic Bot Name' => '动态 Bot 名称',
    'Dynamic ntfy Title' => '动态 ntfy 标题',
    'Dynamic Announcement Title' => '动态公告标题',
    'Dynamic Flash Message Title' => '动态 Flash 消息标题',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => '纯文本,最多 300 个字符。URL 和 `@handle.tld` 提及会自动转为链接。',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => '当帖子正文包含 URL 时,自动生成预览卡片。',
    'Whether the message be sent via the [jobs queue]({queueUrl}).' => '是否通过[任务队列]({queueUrl})发送消息。',
    'Priority level of the ntfy message.' => 'ntfy 消息的优先级。',
    'Optionally include comma-separated [emoji shortcodes](https://docs.ntfy.sh/emojis/).' => '可选填入逗号分隔的[emoji 短代码](https://docs.ntfy.sh/emojis/)。',
    'Body of the ntfy notification.' => 'ntfy 通知的正文。',
    'Optionally open a URL when the notification is clicked.' => '可选在点击通知时打开一个 URL。',
    'Whether to parse the body as Markdown in supported clients.' => '是否在受支持的客户端中将正文解析为 Markdown。',
    'Heading of the announcement.' => '公告的标题。',
    'Body of the announcement. Supports Markdown.' => '公告的正文。支持 Markdown。',
    'Heading of the flash message.' => 'Flash 消息的标题。',
    'Optionally include details below the heading. Supports Markdown and HTML.' => '可选在标题下方添加详细信息。支持 Markdown 和 HTML。',
    'Optionally include a heading above the body.' => '可选在正文上方添加标题。',
    'Body of the SMS (text message). Plain text only.' => 'SMS(短信)正文。仅纯文本。',
    'Body of the Pushover notification. Plain text only.' => 'Pushover 通知的正文。仅纯文本。',
    'Subject line of the email.' => '电子邮件主题。',
    'Body of the email. Supports HTML.' => '电子邮件正文。支持 HTML。',
    'Body of the Slack message. Supports [Slack mrkdwn](https://api.slack.com/reference/surfaces/formatting) syntax.' => 'Slack 消息正文。支持 [Slack mrkdwn](https://api.slack.com/reference/surfaces/formatting) 语法。',
    'Optionally override the app\'s display name.' => '可选覆盖应用的显示名称。',
    'Optionally override the app\'s icon with a URL.' => '可选用 URL 覆盖应用的图标。',
    'Optionally override the app\'s icon with an emoji. Used only when Bot Icon URL is empty.' => '可选用 emoji 覆盖应用的图标。仅在 Bot Icon URL 为空时使用。',
];
