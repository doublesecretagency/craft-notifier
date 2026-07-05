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
    'Notification Log' => '通知日誌',
    'Logs' => '日誌',
    'View Notifications' => '查看通知',
    'Add a New Notification' => '新增通知',
    'notification' => '通知',

    // Permissions
    'View notifications' => '查看通知',
    'Save notifications' => '儲存通知',
    'Use the Dynamic Recipients type' => '使用動態收件者類型',
    'Use the Dynamic Data type' => '使用動態資料類型',
    'Test notifications' => '測試通知',
    'Send manual notifications' => '傳送手動通知',
    'Delete notifications' => '刪除通知',
    'View notification log' => '查看通知日誌',
    'Delete notification log' => '刪除通知日誌',

    // ========================================================
    // NOTIFICATION EDITOR
    // ========================================================

    // Editor: tabs
    'Meta' => '中繼資料',
    'Event' => '事件',
    'Message' => '訊息',
    'Recipients' => '收件者',

    // Event tab: type selector
    'Event Type' => '事件類型',
    'What type of event will activate the notification?' => '哪種類型的事件將觸發此通知?',
    'Which specific event will activate the notification?' => '哪個具體事件將觸發此通知?',

    // Event tab: event types
    'Assets Event' => '資產事件',
    'Commerce Orders Event' => 'Commerce 訂單事件',
    'Commerce Products Event' => 'Commerce 產品事件',
    'Digital Products Event' => 'Digital Products 事件',
    'Digital Product Licenses Event' => 'Digital Products 授權事件',
    'Solspace Calendar Event' => 'Solspace Calendar 事件',
    'Entries Event' => '條目事件',
    'Users Event' => '使用者事件',
    'Ungrouped Users' => '未分組使用者',

    // Event tab: Feed
    'Feed URL' => 'Feed URL',
    'The URL of the RSS, Atom, or JSON feed to watch.' => '要監控的 RSS、Atom 或 JSON Feed 的 URL。',
    'Feed Timeout' => 'Feed 逾時',
    'How long to wait when the feed is loading slowly. Default {default} seconds, max {max}.' => 'Feed 載入緩慢時等待的時長。預設 {default} 秒，最大 {max}。',
    'seconds' => '秒',

    // Event tab: field conditions
    'Field Conditions' => '欄位條件',
    'Send the message only when the saved element matches the following conditions.' => '僅在儲存的元素符合以下條件時傳送訊息。',
    'has changed' => '已變更',

    // Event tab: element filters (panel chrome + common output)
    '#{elementType} Event Filters' => '#{elementType} 事件篩選器',
    'No filters match this event.' => '沒有篩選器符合此事件。',
    'Determine whether each message should be sent based on specified conditions.' => '根據指定的條件決定是否傳送每則訊息。',
    'Unnamed filter' => '未命名篩選器',
    'Must be TRUE to send message' => '必須為 TRUE 才能傳送訊息',
    'Must be FALSE to send message' => '必須為 FALSE 才能傳送訊息',
    'No effect' => '無效',

    // Event tab: element filter rules
    'Element is being saved for the first time' => '元素正在首次儲存',
    'Must be a new entry' => '必須是新條目',
    'Must be an existing entry' => '必須是現有條目',
    'Can be existing or new' => '可以是現有或新的',
    'Element is new' => '元素是新的',
    'New elements only' => '僅限新元素',
    'Existing elements only' => '僅限現有元素',
    'Element is enabled' => '元素已啟用',
    'Must be enabled' => '必須啟用',
    'Must be disabled' => '必須停用',
    'Can be enabled or disabled' => '可以啟用或停用',
    'Element is a draft' => '元素是草稿',
    'Must be a draft' => '必須是草稿',
    'Must not be a draft' => '不得為草稿',
    'Can be a draft or non-draft' => '可以是草稿或非草稿',
    'Element is a provisional draft' => '元素是暫存草稿',
    'Must be a provisional draft' => '必須是暫存草稿',
    'Must not be a provisional draft' => '不得為暫存草稿',
    'Can be a provisional draft or non-provisional' => '可以是暫存草稿或非暫存草稿',
    'Element is a revision' => '元素是修訂版本',
    'Must be a revision' => '必須是修訂版本',
    'Must not be a revision' => '不得為修訂版本',
    'Can be a revision or non-revision' => '可以是修訂版本或非修訂版本',
    'Element is being duplicated' => '元素正在被複製',
    'Must be duplicating the element' => '必須正在複製元素',
    'Must not be duplicating the element' => '不得正在複製元素',
    'Element is being propagated' => '元素正在傳播',
    'Element must be propagating' => '元素必須正在傳播',
    'Element must not be propagating' => '元素不得正在傳播',
    'Element is being bulk-resaved' => '元素正在批次重新儲存',
    'Must be bulk-resaving the element' => '必須正在批次重新儲存元素',
    'Must not be bulk-resaving the element' => '不得正在批次重新儲存元素',

    // Event tab: date trigger
    'On' => '當天',
    'days before' => '天前',
    'days after' => '天後',
    'Relevant Date' => '相關日期',
    'Send the notification relative to a chosen date.' => '相對於選定日期傳送通知。',

    // Event tab: recurring schedule
    'Every' => '每',
    'on' => '在',
    'on day' => '在每月',
    'at' => '在',
    'Starting on' => '開始日期',
    'Day' => '星期',
    'Date' => '日期',
    'Time' => '時間',
    'day(s)' => '天',
    'week(s)' => '週',
    'month(s)' => '個月',
    'year(s)' => '年',
    'day' => '天',
    'days' => '天',
    'week' => '週',
    'weeks' => '週',
    'month' => '個月',
    'months' => '個月',
    'year' => '年',
    'years' => '年',
    'Manual only' => '僅手動',
    'Scheduled sending' => '排程發送',
    'Generate report on a recurring schedule' => '依重複排程產生報告',
    'Generate report on demand' => '依需求產生報告',
    'Send on a Recurring Schedule' => '依重複排程發送',
    'Configure Recurring Schedule' => '設定重複排程',
    'System timezone set to {timezone}' => '系統時區設定為 {timezone}',
    'Notifications will be sent on the following schedule...' => '通知將依下列排程發送...',
    '... and every {cadence} after that.' => '... 此後每 {cadence} 發送一次。',
    'On what recurring schedule should the notification be sent?' => '應依什麼重複排程發送通知？',
    'Whether the message should be sent on a schedule, or only triggered manually.' => '訊息要依排程發送，還是僅手動觸發。',
    'The message can always be sent using the "Send system snapshot" button above.' => '隨時可使用上方的「發送系統快照」按鈕發送此訊息。',
    'The message can always be sent using the "Send data report" button above.' => '隨時可使用上方的「發送資料報告」按鈕發送此訊息。',

    // Event tab: Dynamic Data snippet field
    'Twig Snippet to Determine Data' => '用於決定資料的 Twig 程式碼片段',
    'Enter a custom Twig snippet to [determine which data will be included]({url}).' => '輸入自訂 Twig 程式碼片段以[決定將包含哪些資料]({url})。',
    'The snippet **must** include a `{% setData %}` tag.' => '程式碼片段**必須**包含 `{% setData %}` 標籤。',
    'You do not have permission to edit dynamic data.' => '您沒有編輯動態資料的權限。',

    // Event tab: manual trigger
    'Trigger Label' => '觸發標籤',
    'An element action label (helps to differentiate multiple triggers).' => '元素動作標籤（有助於區分多個觸發）。',
    'Send Notification' => '傳送通知',

    // Message tab: type selector
    'Message Type' => '訊息類型',
    'What type of message will be sent?' => '將傳送什麼類型的訊息?',
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are supported.' => '支援[範本]({templatingUrl})和[特殊變數]({variablesUrl})。',

    // Details sidebar: queue
    'Use Queue' => '使用佇列',
    'Immediate' => '立即',
    'Queue' => '佇列',
    'jobs queue' => '任務佇列',
    'Whether the message will be sent immediately, or added to the {link}.' => '訊息是立即傳送，還是加入{link}。',
    'Flash messages never use the queue.' => 'Flash 訊息從不使用佇列。',
    'Announcements always use the queue.' => '公告一律使用佇列。',

    // Message tab: Email
    "User's Email Address Field" => '使用者的電子郵件地址欄位',
    'Select which User field contains the recipient\'s email address.' => '選擇包含收件者電子郵件地址的使用者欄位。',
    'Email Subject' => '郵件主旨',
    'Subject line of the email.' => '電子郵件主旨。',
    'Dynamic Subject Line' => '動態主旨列',
    'Email Body' => '郵件內文',
    'Body of the email. Supports HTML.' => '電子郵件內文。支援 HTML。',

    // Message tab: rich-text (Trix) toolbar
    'Rich Text' => '格式化文字',
    'Bold' => '粗體',
    'Italic' => '斜體',
    'Underline' => '底線',
    'Strikethrough' => '刪除線',
    'Bullets' => '項目符號',
    'Numbers' => '編號',
    'Heading' => '標題',
    'Code' => '程式碼',
    'Undo' => '復原',
    'Redo' => '重做',

    // Message tab: SMS
    "User's Phone Number Field" => '使用者的電話號碼欄位',
    'Select which User field contains the recipient\'s phone number.' => '選擇包含收件者電話號碼的使用者欄位。',
    'SMS Message Body' => '簡訊內容',
    'Body of the SMS (text message). Plain text only.' => 'SMS(簡訊)內文。僅純文字。',

    // Message tab: Announcement
    'Announcement Title' => '公告標題',
    'Heading of the announcement.' => '公告的標題。',
    'Dynamic Announcement Title' => '動態公告標題',
    'Announcement Message' => '公告訊息',
    'Body of the announcement. Supports Markdown.' => '公告的內文。支援 Markdown。',

    // Message tab: Flash
    'Flash Message Type' => '即時訊息類型',
    'Which type of flash message should appear?' => '應顯示什麼類型的即時訊息?',
    'Flash Message Title' => '即時訊息標題',
    'Heading of the flash message.' => 'Flash 訊息的標題。',
    'Dynamic Flash Message Title' => '動態 Flash 訊息標題',
    'Flash Message Details' => '即時訊息詳情',
    'Optionally include details below the heading. Supports Markdown and HTML.' => '可選擇在標題下方加入詳細資訊。支援 Markdown 和 HTML。',

    // Message tab: Pushover
    "Field containing each user's Pushover key" => '使用者的 Pushover 金鑰欄位',
    'Select which User field contains the recipient\'s Pushover user key.' => '選擇包含收件者 Pushover 金鑰的使用者欄位。',
    'Pushover Title' => 'Pushover 標題',
    'Optionally include a heading above the body.' => '可選擇在內文上方加入標題。',
    'Dynamic Pushover Title' => '動態 Pushover 標題',
    'Pushover Body' => 'Pushover 內文',
    'Body of the Pushover notification. Plain text only.' => 'Pushover 通知的內文。僅純文字。',

    // Message tab: ntfy
    'Priority' => '優先順序',
    'Priority level of the ntfy message.' => 'ntfy 訊息的優先層級。',
    'Tags' => '標籤',
    'Optionally include comma-separated [emoji shortcodes](https://docs.ntfy.sh/emojis/).' => '可選擇加入以逗號分隔的[emoji 短代碼](https://docs.ntfy.sh/emojis/)。',
    'ntfy Title' => 'ntfy 標題',
    'Dynamic ntfy Title' => '動態 ntfy 標題',
    'ntfy Body' => 'ntfy 內文',
    'Body of the ntfy notification.' => 'ntfy 通知的內文。',
    'ntfy Link URL' => 'ntfy 連結 URL',
    'Optionally open a URL when the notification is clicked.' => '可選擇在點擊通知時開啟一個 URL。',
    'Enable Markdown' => '啟用 Markdown',
    'Whether to parse the body as Markdown in supported clients.' => '是否在支援的客戶端中將內文解析為 Markdown。',
    'Regular text only' => '僅純文字',
    'Markdown enabled' => 'Markdown 已啟用',

    // Message tab: Slack
    'Slack Message Body' => 'Slack 訊息內文',
    'Supports standard [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) syntax. Optionally supports HTML _(see below)_.' => '支援標準 [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) 語法。可選支援 HTML _（見下文）_。',
    'Render Message Body as HTML' => '將訊息內容呈現為 HTML',
    'Whether to only parse as [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), or additionally parse it as HTML.' => '是否僅解析為 [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting)，或同時解析為 HTML。',
    'Render Link Previews' => '顯示連結預覽',
    'Whether Slack should unfurl link previews for URLs in the message body.' => 'Slack 是否應為訊息內容中的 URL 展開連結預覽。',
    'Don\'t unfurl' => '不展開',
    'Expand link previews' => '展開連結預覽',
    'Bot Name' => '使用者名稱',
    'Optionally override the app\'s display name.' => '可選擇覆寫應用程式的顯示名稱。',
    'Dynamic Bot Name' => '動態 Bot 名稱',
    'Bot Icon URL' => '圖示 URL',
    'Optionally override the app\'s icon with a URL.' => '可選擇以 URL 覆寫應用程式的圖示。',
    'Bot Emoji' => '圖示表情',
    'Optionally override the app\'s icon with an emoji. Used only when Bot Icon URL is empty.' => '可選擇以 emoji 覆寫應用程式的圖示。僅在 Bot Icon URL 為空時使用。',

    // Message tab: Discord
    'Discord Message Body' => 'Discord 訊息內文',
    'Supports standard Markdown, and optionally HTML _(see below)_. Max 2000 characters.' => '支援標準 Markdown，以及可選的 HTML _（見下文）_。最多 2000 個字元。',
    'Whether to only parse as Markdown, or additionally parse it as HTML.' => '是否僅解析為 Markdown,或同時解析為 HTML。',
    'Markdown only' => '僅 Markdown',
    'Markdown + HTML' => 'Markdown + HTML',
    'Whether Discord should unfurl link previews for URLs in the message body.' => 'Discord 是否應顯示訊息內文中 URL 的連結預覽。',
    'Webhook Username' => 'Webhook 使用者名稱',
    'Optionally override the webhook\'s display name.' => '可選擇覆寫 Webhook 的顯示名稱。',
    'Dynamic Username' => '動態使用者名稱',
    'Webhook Avatar URL' => 'Webhook 頭像 URL',
    'Optionally override the webhook\'s avatar with a URL.' => '可選擇以 URL 覆寫 Webhook 的頭像。',

    // Message tab: Facebook
    'Message Body' => '訊息內文',
    'The text of your Facebook post.' => '您 Facebook 貼文的文字內容。',
    'Preview Card URL' => '預覽卡片 URL',
    'Optionally add a link to generate a preview card.' => '可選擇新增連結以產生預覽卡片。',

    // Message tab: Instagram
    'Caption' => '說明文字',
    'Image Attachment' => '圖片附件',
    'Optional caption, max 2200 characters.' => '選用說明文字,最多 2200 個字元。',

    // Message tab: X (Twitter)
    'Plain text, max 280 characters.' => '純文字,最多 280 個字元。',

    // Message tab: Media
    'Attach an image by calling `{% setMedia %}` in a [custom Twig snippet]({url}).' => '透過在[自訂 Twig 程式碼片段]({url})中呼叫 `{% setMedia %}` 來附加圖片。',

    // Message tab: Bluesky
    'Post Body' => '貼文內文',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => '純文字,最多 300 個字元。URL 和 `@handle.tld` 提及會自動轉為連結。',
    'Generate Link Preview' => '產生連結預覽',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => '當貼文內文包含 URL 時,自動產生預覽卡片。',
    'No card' => '無卡片',
    'Generate preview card' => '產生預覽卡片',

    // Message tab: Mastodon
    'Plain text, max 500 characters. URLs will unfurl automatically.' => '純文字，最多 500 個字元。URL 會自動展開。',
    'Visibility' => '可見性',
    'Who will be able to see this post?' => '誰可以看到此貼文?',

    // Message tab: LinkedIn
    'LinkedIn' => 'LinkedIn',
    'The text of your LinkedIn post.' => '你的 LinkedIn 貼文的文字。',

    // Message tab: MQTT
    'Payload' => '負載',
    'The JSON or plain text message published to the MQTT topic.' => '發布到 MQTT 主題的 JSON 或純文字訊息。',
    'Quality of Service' => '服務品質',
    'Delivery guarantee for this message.' => '此訊息的傳遞保證。',
    'Retain' => '保留',
    'Whether the broker keeps this as the topic\'s last message for future subscribers.' => '代理是否將其保留為該主題的最後一則訊息,並傳遞給未來的訂閱者。',
    'Don\'t retain' => '不保留',

    // Recipients tab: type selector & user/group pickers
    'Recipients Type' => '收件者類型',
    'Who will receive this message?' => '誰將收到此訊息?',
    'Add a message recipient' => '新增訊息收件者',
    'Select User(s)' => '選擇使用者',
    'Which users will receive the message?' => '哪些使用者將收到訊息?',
    'Which user groups will receive the message?' => '哪些使用者群組將收到訊息?',

    // Recipients tab: channel pickers (ntfy, Slack, Discord, Bluesky, Mastodon, MQTT)
    'Select ntfy topic(s)' => '選擇 ntfy 主題',
    'Which topics should receive this message?' => '哪些主題應接收此訊息?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => '未設定 ntfy 主題。請在[設定 → ntfy]({url})中新增一個。',
    'No ntfy topics configured. Topics can only be added in an environment that allows administrative changes.' => '未設定 ntfy 主題。主題只能在允許管理變更的環境中新增。',
    'Select Slack channel(s)' => '選擇 Slack 頻道',
    'Which channels should receive this message?' => '哪些頻道應接收此訊息?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => '未設定 Slack 頻道。請在[設定 → Slack]({url})中新增一個。',
    'No Slack channels configured. Channels can only be added in an environment that allows administrative changes.' => '未設定 Slack 頻道。頻道只能在允許管理變更的環境中新增。',
    'Select Discord channel(s)' => '選擇 Discord 頻道',
    'No Discord channels configured. Add one in [Settings → Discord]({url}).' => '未設定 Discord 頻道。請在[設定 → Discord]({url})中新增一個。',
    'No Discord channels configured. Channels can only be added in an environment that allows administrative changes.' => '未設定 Discord 頻道。頻道只能在允許管理變更的環境中新增。',
    'Select Facebook page(s)' => '選擇 Facebook 頁面',
    'Which pages should post this message?' => '哪些頁面應發布此訊息?',
    'No Facebook pages configured. Add one in [Settings → Facebook]({url}).' => '未設定 Facebook 頁面。請在[設定 → Facebook]({url})中新增一個。',
    'No Facebook pages configured. Pages can only be added in an environment that allows administrative changes.' => '未設定 Facebook 頁面。頁面只能在允許管理變更的環境中新增。',
    'Select Instagram account(s)' => '選擇 Instagram 帳號',
    'No Instagram accounts configured. Add one in [Settings → Instagram]({url}).' => '未設定 Instagram 帳號。請在[設定 → Instagram]({url})中新增一個。',
    'No Instagram accounts configured. Accounts can only be added in an environment that allows administrative changes.' => '未設定 Instagram 帳號。帳號只能在允許管理變更的環境中新增。',
    'Select X (Twitter) account(s)' => '選擇 X (Twitter) 帳號',
    'No X (Twitter) accounts configured. Add one in [Settings → X (Twitter)]({url}).' => '未設定 X (Twitter) 帳號。請在[設定 → X (Twitter)]({url})中新增一個。',
    'No X (Twitter) accounts configured. Accounts can only be added in an environment that allows administrative changes.' => '未設定 X (Twitter) 帳號。帳號只能在允許管理變更的環境中新增。',
    'Select Bluesky account(s)' => '選擇 Bluesky 帳號',
    'Which accounts should post this message?' => '哪些帳號應發布此訊息?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => '未設定 Bluesky 帳號。請在[設定 → Bluesky]({url})中新增一個。',
    'No Bluesky accounts configured. Accounts can only be added in an environment that allows administrative changes.' => '未設定 Bluesky 帳號。帳號只能在允許管理變更的環境中新增。',
    'Select Mastodon account(s)' => '選擇 Mastodon 帳號',
    'No Mastodon accounts configured. Add one in [Settings → Mastodon]({url}).' => '未設定 Mastodon 帳號。請在[設定 → Mastodon]({url})中新增一個。',
    'No Mastodon accounts configured. Accounts can only be added in an environment that allows administrative changes.' => '未設定 Mastodon 帳號。帳號只能在允許管理變更的環境中新增。',
    'Select MQTT topic(s)' => '選擇 MQTT 主題',
    'No MQTT topics configured. Add one in [Settings → MQTT]({url}).' => '未設定 MQTT 主題。請在[設定 → MQTT]({url})中新增一個。',
    'No MQTT topics configured. Topics can only be added in an environment that allows administrative changes.' => '未設定 MQTT 主題。主題只能在允許管理變更的環境中新增。',
    'Not a valid topic. Must not be empty or contain the `+` or `#` wildcards.' => '不是有效的主題。不能為空,也不能包含萬用字元 `+` 或 `#`。',

    // Recipients tab: LinkedIn picker
    'Select LinkedIn account(s)' => '選擇 LinkedIn 帳戶',
    'Which page or member should post this message?' => '哪個頁面或成員應發布此訊息？',
    'No LinkedIn accounts connected. Connect one in [Settings → LinkedIn]({url}).' => '未連接 LinkedIn 帳戶。請在[設定 → LinkedIn]({url})中連接一個。',
    'No LinkedIn accounts connected. Accounts can only be connected in an environment that allows administrative changes.' => '未連接 LinkedIn 帳戶。帳戶只能在允許管理變更的環境中連接。',

    // Recipients tab: dynamic recipients snippet
    'Twig Snippet to Determine Recipients' => '用於決定收件者的 Twig 程式碼片段',
    'Enter a custom Twig snippet to [determine who will receive the message]({url}).' => '輸入自訂 Twig 程式碼片段以[決定誰將接收訊息]({url})。',
    'The snippet **must** include a `{% setRecipients %}` tag.' => '程式碼片段**必須**包含 `{% setRecipients %}` 標籤。',

    // ========================================================
    // SETTINGS
    // ========================================================

    // Settings: nav & page chrome
    'Notifier Settings' => 'Notifier 設定',
    'General' => '一般',
    'Twilio' => 'Twilio',
    'Pushover' => 'Pushover',
    'ntfy' => 'ntfy',
    'Slack' => 'Slack',
    'Discord' => 'Discord',
    'Bluesky' => 'Bluesky',
    'Mastodon' => 'Mastodon',
    'MQTT' => 'MQTT',

    // Settings: nav group headings
    'Push Notifications' => '推播通知',
    'Chat Platforms' => '聊天平台',
    'Social Media' => '社群媒體',
    'Internet of Things' => '物聯網',
    'Expand {heading}' => '展開{heading}',

    // Settings: shared intro lines
    'Consult the [{name} setup guide]({url}) for complete instructions.' => '請參閱 [{name} 設定指南]({url}) 以取得完整說明。',
    'Sensitive values can be stored in your `.env` file and referenced here.' => '敏感值可以儲存在您的 `.env` 檔案中並於此處引用。',

    // Settings: Notification order
    'Notification Order' => '通知排序',
    'Notifications can be dragged into any order on the index page. Choose where new notifications land in that order.' => '可以在清單頁面拖曳通知以自訂順序。選擇新通知在該順序中的新增位置。',
    'Default Placement' => '預設位置',
    'Where new notifications are added to the list.' => '新通知加入清單的位置。',
    'Before other notifications' => '在其他通知之前',
    'After other notifications' => '在其他通知之後',

    // Settings: Logging
    'Logging' => '日誌記錄',
    "Notifier keeps a running log of every message it sends. You usually won't need to change this, but you can limit how many log entries are kept in the database." => 'Notifier 持續記錄已傳送訊息的日誌。通常不需要,但您可以限制儲存到資料庫的日誌事件數量。',
    'Enable Logging' => '啟用日誌記錄',
    'When disabled, Notifier will not write anything to the notification log.' => '停用時,Notifier 不會寫入任何內容到通知日誌。',
    'Number of days to retain log events' => '保留日誌事件的天數',
    'At most, keep log events for this many days. Leave blank for no limit.' => '最多保留這麼多天的日誌事件。留空表示無限制。',
    'Number of log events to retain' => '要保留的日誌事件數量',
    'At most, keep this many log events. Leave blank for no limit.' => '最多保留這麼多日誌事件。留空表示無限制。',

    // Settings: Scheduled sending
    'Scheduled Sending' => '排程傳送',
    'A shared secret that authenticates scheduled runs triggered over the web. You only need this if you trigger the schedule from the web endpoint.' => '用於驗證排程執行 Web 請求的共用密鑰。僅在透過 Web 端點觸發排程時才需要。',
    'Scheduled-Run Token' => '排程執行權杖',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => '隨每個請求一起傳送,作為 X-Notifier-Token 標頭或 token 主體參數。',

    // Settings: Twilio
    'Send SMS text messages through [Twilio](https://www.twilio.com).' => '透過 [Twilio](https://www.twilio.com) 傳送 SMS 簡訊。',
    'Twilio Account SID' => 'Twilio 帳號 SID',
    'Twilio Auth Token' => 'Twilio 驗證權杖',
    'Twilio phone number (sends each SMS message)' => 'Twilio 電話號碼(傳送每則簡訊)',
    'SMS Testing' => '簡訊測試',
    'Optional. When set, every SMS is sent to this number instead of the actual recipient.' => '選用。設定後,每則簡訊將傳送到此號碼,而非實際收件者。',
    'Test phone number' => '測試電話號碼',

    // Settings: Pushover
    'Send push notifications through [Pushover](https://pushover.net).' => '透過 [Pushover](https://pushover.net) 傳送推播通知。',
    'Application API Token' => '應用程式 API 金鑰',
    'The 30-character app token from your Pushover application.' => '來自您 Pushover 應用程式的 30 個字元應用程式金鑰。',

    // Settings: ntfy
    'Send push notifications through [ntfy](https://ntfy.sh).' => '透過 [ntfy](https://ntfy.sh) 傳送推播通知。',
    'Server URL' => '伺服器 URL',
    'Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`.' => '選用,指向自架的 ntfy 實例(如適用)。預設為 `https://ntfy.sh`。',
    'Access token' => '存取權杖',
    'Optional, required for protected topics or self-hosted instances with auth.' => '選用,用於受保護主題或具有身分驗證的自架實例時必填。',
    'ntfy Topics' => 'ntfy 主題',
    'Add the ntfy topics you want to send to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => '新增您希望傳送訊息的 ntfy 主題。設定通知時,每個主題都可在**收件者**分頁中作為收件者使用。',
    'Topics' => '主題',
    "Click any row's **Test** button to send a quick test message to that topic." => '點擊任一列的 **測試** 按鈕以向該主題傳送快速測試訊息。',
    'Label' => '標籤',
    'Topic' => '主題',
    'Add a topic' => '新增主題',

    // Settings: Slack
    'Post messages to your Slack channels.' => '向您的 Slack 頻道傳送訊息。',
    'Channels' => '頻道',
    "Click any row's **Test** button to send a quick test message to that channel." => '點擊任一列的 **測試** 按鈕以向該頻道傳送快速測試訊息。',
    'Bot Token' => '機器人權杖',
    'Channel ID' => '頻道 ID',
    'Add a channel' => '新增頻道',
    'Not a valid Bot Token. Must start with `xoxb-`.' => '無效的機器人權杖。必須以 `xoxb-` 開頭。',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => '無效的頻道 ID。必須類似 `C01234ABCD`。',

    // Settings: Discord
    'Post messages to your Discord channels.' => '向您的 Discord 頻道傳送訊息。',
    'Webhook URL' => 'Webhook URL',
    'Not a valid Webhook URL. Must start with `https://discord.com/api/webhooks/`.' => '無效的 Webhook URL。必須以 `https://discord.com/api/webhooks/` 開頭。',

    // Settings: Facebook
    'Facebook' => 'Facebook',
    'Publish posts to your [Facebook](https://facebook.com) pages.' => '向您的 [Facebook](https://facebook.com) 頁面發布貼文。',
    'Pages' => '頁面',
    'Page ID' => 'Page ID',
    'Page Access Token' => 'Page Access Token',
    'Add a page' => '新增頁面',
    "Click any row's **Test** button to verify that page's credentials. No posts are made." => '點擊任一列的 **測試** 按鈕以驗證該頁面的憑證。不會發布任何貼文。',

    // Settings: Instagram
    'Instagram' => 'Instagram',
    'Publish posts to your [Instagram](https://instagram.com) Business accounts.' => '向您的 [Instagram](https://instagram.com) 商業帳號發布貼文。',
    "Click any row's **Test** button to resolve the linked Instagram account. No posts are made." => '點擊任一列的 **測試** 按鈕以解析連結的 Instagram 帳號。不會發布任何貼文。',

    // Settings: X (Twitter)
    'X (Twitter)' => 'X (Twitter)',
    'Publish posts to your [X (Twitter)](https://x.com) accounts.' => '向您的 [X (Twitter)](https://x.com) 帳號發布貼文。',
    'Consumer Key' => 'Consumer Key',
    'Consumer Key Secret' => 'Consumer Key Secret',
    'Access Token Secret' => 'Access Token Secret',

    // Settings: Bluesky
    'Publish posts to your [Bluesky](https://bsky.app) accounts.' => '向您的 [Bluesky](https://bsky.app) 帳號發布貼文。',
    'PDS URL' => 'PDS URL',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => '預設為 https://bsky.social。如您的安裝支援聯邦,可指向自訂 PDS。',
    'Bluesky Accounts' => 'Bluesky 帳號',
    'Add the Bluesky accounts you want to post from. Each account becomes available as a recipient on the **Recipients** tab when you set up a notification.' => '新增您希望用於發布的 Bluesky 帳號。設定通知時,每個帳號都可在**收件者**分頁中作為收件者使用。',
    'Accounts' => '帳號',
    "Click any row's **Test** button to confirm the account authenticates." => '點擊任一列的 **測試** 按鈕以確認該帳號能通過認證。',
    'Handle' => '代號',
    'App password' => '應用程式密碼',
    'Add an account' => '新增帳號',

    // Settings: Mastodon
    'Publish posts to your [Mastodon](https://joinmastodon.org) accounts.' => '向您的 [Mastodon](https://joinmastodon.org) 帳號發布貼文。',
    'Click any row\'s **Test** button to verify that account\'s credentials. No posts are made.' => '點擊任一列的 **Test** 按鈕以驗證該帳號的憑證。不會發布任何貼文。',
    'Instance URL' => '實例 URL',
    'Access Token' => '存取權杖',

    // Settings: LinkedIn
    'Publish posts to your [LinkedIn](https://linkedin.com) profile.' => '向你的 [LinkedIn](https://linkedin.com) 個人檔案發布貼文。',
    'The Client ID of your LinkedIn app.' => '你的 LinkedIn 應用程式的用戶端 ID。',
    'Client Secret' => '用戶端密鑰',
    'The Primary Client Secret of your LinkedIn app.' => '你的 LinkedIn 應用程式的主要用戶端密鑰。',
    'Enable organization posting' => '啟用組織發布',
    'Copy this redirect URL' => '複製此重新導向 URL',
    'When configuring the LinkedIn app, <strong>copy this URL</strong> to use as an "Authorized redirect URL".' => '設定 LinkedIn 應用程式時，<strong>複製此 URL</strong> 以用作 "Authorized redirect URL"。',
    'Also request access to post as organization pages you administer. Requires Community Management API approval from LinkedIn.' => '同時請求以你管理的組織頁面身分發文的權限。需要 LinkedIn 核准 Community Management API。',
    'Connections' => '連線',
    'Each connection becomes available as a recipient on the **Recipients** tab when you set up a notification.' => '設定通知時，每個連線都會作為收件者顯示在 **收件者** 索引標籤中。',
    'Account' => '帳戶',
    'Type' => '類型',
    'Status' => '狀態',
    'Organization' => '組織',
    'Member' => '成員',
    'Reconnect needed' => '需要重新連接',
    'Expires' => '到期',
    'Connected' => '已連接',
    'Disconnect' => '中斷連接',
    'No LinkedIn accounts are connected yet.' => '尚未連接任何 LinkedIn 帳戶。',
    'Connect to LinkedIn' => '連接到 LinkedIn',
    'Provide valid credentials to connect with LinkedIn.' => '請提供有效的憑證以連接到 LinkedIn。',
    'Disconnect this LinkedIn account?' => '要中斷此 LinkedIn 帳戶的連接嗎？',

    // Settings: MQTT
    'Publish messages to an MQTT broker, handy for IoT and home-automation setups.' => '向 MQTT 代理發布訊息，適用於物聯網和家庭自動化設定。',
    'Host' => '主機',
    'Broker hostname, without a protocol or port.' => '代理的主機名稱,不含通訊協定或連接埠。',
    'Port' => '連接埠',
    'Optional. Defaults to 8883 when TLS is enabled, otherwise 1883.' => '選用。啟用 TLS 時預設為 8883,否則為 1883。',
    'Use TLS' => '使用 TLS',
    'Whether to connect to the broker over a secure TLS socket.' => '是否透過安全的 TLS 通訊端連線至代理。',
    'Username' => '使用者名稱',
    'Optional, for brokers that require username/password authentication.' => '選用,適用於需要使用者名稱/密碼驗證的代理。',
    'Password' => '密碼',
    'MQTT Version' => 'MQTT 版本',
    'Protocol version sent to the broker.' => '傳送給代理的通訊協定版本。',
    'Client ID' => '用戶端 ID',
    'Optional. A unique client ID is generated automatically when left blank.' => '選用。留空時會自動產生唯一的用戶端 ID。',
    'Mutual TLS' => '雙向 TLS',
    'Optional. Needed for brokers that authenticate clients with certificates, such as AWS IoT Core. Enter the server file paths to your certificate files. You can use a `.env` variable or `@alias` reference.' => '選用。適用於使用憑證驗證用戶端的代理(如 AWS IoT Core)。請提供憑證檔案的伺服器檔案路徑(允許使用 `.env` 變數或 `@alias` 參考)。',
    'CA Certificate File' => 'CA 憑證檔案',
    'Path to the certificate authority (CA) file.' => '憑證授權單位(CA)檔案的路徑。',
    'Client Certificate File' => '用戶端憑證檔案',
    'Path to the client certificate file.' => '用戶端憑證檔案的路徑。',
    'Client Key File' => '用戶端金鑰檔案',
    'Path to the client private key file.' => '用戶端私密金鑰檔案的路徑。',
    'MQTT Topics' => 'MQTT 主題',
    'Add the MQTT topics you want to publish to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => '新增您希望發布的 MQTT 主題。設定通知時,每個主題都可在**收件者**分頁中作為收件者使用。',
    'Click any row\'s **Test** button to publish a quick test message to that topic.' => '點擊任一列的 **測試** 按鈕以向該主題發布快速測試訊息。',

    // ========================================================
    // MANUAL SEND & TEST
    // ========================================================

    // Manual send & test
    'Send a test message' => '傳送測試訊息',
    'Send a REAL test notification?\\n\\n⚠️ Uses a random sample of real data.\\n⚠️ Sends a real message via the configured channel.\\n⚠️ Delivers to the real configured recipient(s).' => '傳送真實的測試通知?\\n\\n⚠️ 使用真實資料的隨機樣本。\\n⚠️ 透過設定的通道傳送真實訊息。\\n⚠️ 傳送給設定的真實收件者。',
    'Test' => '測試',
    'Send system snapshot' => '發送系統快照',
    'Send data report' => '發送資料報告',
    'Are you sure you want to send this notification?' => '確定要傳送此通知嗎？',
    'This notification cannot be triggered manually.' => '此通知無法手動觸發。',
    'This notification no longer applies to the selected element.' => '此通知不再適用於所選元素。',

    // ========================================================
    // RUNTIME OUTPUT
    // ========================================================

    // Runtime: dispatch log feedback
    'Sending {messageType} to {recipient}.' => '正在向 {recipient} 傳送 {messageType}。',
    'Sending "{title}".' => '正在傳送「{title}」。',
    '[invalid recipient]' => '[無效收件人]',
    'Scanning feed {url}.' => '正在掃描 Feed {url}。',
    'Adding message to queue.' => '正在將訊息加入佇列。',
    'Sending message immediately (bypassing queue).' => '立即傳送訊息(略過佇列)。',

    // Runtime: controller responses
    'Test notification dispatched.' => '已傳送測試通知。',
    'No messages were dispatched. Check the recipient configuration.' => '未傳送任何訊息。請檢查收件者設定。',
    'Unable to send test: the feed could not be read or has no items.' => '無法傳送測試:無法讀取訂閱源或沒有項目。',
    'Unable to send test: no element matches the configured filters.' => '無法傳送測試:沒有元素符合設定的篩選器。',
    "Couldn't save settings." => '無法儲存設定。',
    'Settings saved.' => '設定已儲存。',
    'Topic is empty.' => '主題為空。',
    'Server URL is not configured.' => '伺服器 URL 未設定。',
    'Test message from Notifier.' => '來自 Notifier 的測試訊息。',
    'HTTP {status}' => 'HTTP {status}',
    'Test message sent successfully.' => '測試訊息傳送成功。',
    'Page ID and Page Access Token are required.' => 'Page ID 和 Page Access Token 為必填。',
    'Facebook rejected the request: {error}' => 'Facebook 拒絕了請求：{error}',
    'Successfully connected to "{name}". No posts were made.' => '已成功連線至「{name}」。未發布任何貼文。',
    'No Instagram Business account is linked to this Page.' => '此頁面未連結任何 Instagram 商業帳號。',
    'Successfully connected to @{handle}. No posts were made.' => '已成功連線至 @{handle}。未發布任何貼文。',
    'All four credentials are required.' => '四項憑證皆為必填。',
    'X (Twitter) rejected the request: {error}' => 'X (Twitter) 拒絕了請求：{error}',
    'Successfully authenticated as @{username}. No posts were made.' => '已成功以 @{username} 身分進行驗證。未發布任何貼文。',
    'Handle and app password are required.' => '代號和應用程式密碼為必填項目。',
    'Authentication failed.' => '身分驗證失敗。',
    'Successfully authenticated. No messages were posted.' => '驗證成功。未發佈任何訊息。',
    'Log events deleted.' => '日誌事件已刪除。',
    'Notification sent.' => '通知已傳送。',
    'Notification was not sent. Check the Notification Log for details.' => '通知未傳送。詳情請查看通知日誌。',
    'Instance URL and access token are required.' => '實例 URL 和存取權杖為必填項目。',
    'Mastodon rejected the request: {error}' => 'Mastodon 拒絕了請求：{error}',
    'Successfully authenticated as @{handle}. No posts were made.' => '已成功以 @{handle} 身分進行驗證。未發布任何貼文。',
    'Broker host is not configured.' => '未設定代理主機。',

    // Runtime: LinkedIn connect flow
    'Add your LinkedIn app credentials before connecting.' => '連接前請先新增你的 LinkedIn 應用程式憑證。',
    'LinkedIn authorization failed: {error}' => 'LinkedIn 授權失敗：{error}',
    'LinkedIn authorization failed: invalid state.' => 'LinkedIn 授權失敗：狀態無效。',
    'LinkedIn authorization failed: no code returned.' => 'LinkedIn 授權失敗：未返回授權碼。',
    'Connected to LinkedIn.' => '已連接到 LinkedIn。',
    'Disconnected from LinkedIn.' => '已中斷與 LinkedIn 的連接。',

    // Outbound: per-channel send results
    'Successfully sent an email to {name}.' => '已成功向 {name} 傳送郵件。',
    'Successfully sent an SMS message to {name}.' => '已成功向 {name} 傳送簡訊。',
    'Successfully sent a Pushover notification to {name}.' => '已成功向 {name} 傳送 Pushover 通知。',
    'Successfully posted an announcement for {name}.' => '已成功為 {name} 發布公告。',
    'Successfully sent a flash message to {name}.' => '已成功向 {name} 傳送即時訊息。',
    'Successfully posted to Slack in channel "{label}".' => '已成功發布到 Slack 頻道「{label}」。',
    'Successfully posted to Discord in channel "{label}".' => '已成功發布到 Discord 頻道「{label}」。',
    'Successfully posted to Facebook as "{label}" account.' => '已成功以帳戶「{label}」發布到 Facebook。',
    'Successfully posted to Instagram as "{label}" account.' => '已成功以帳戶「{label}」發布到 Instagram。',
    'Successfully posted to X (Twitter) as "{label}" account.' => '已成功以帳戶「{label}」發布到 X (Twitter)。',
    'Successfully posted to Bluesky as "{label}" account.' => '已成功以帳戶「{label}」發布到 Bluesky。',
    'Successfully posted to Mastodon as "{label}" account.' => '已成功以帳戶「{label}」發布到 Mastodon。',
    'Successfully posted to LinkedIn as "{label}" account.' => '已成功以帳戶「{label}」發布到 LinkedIn。',
    'Successfully sent ntfy message to topic "{topic}".' => '已成功傳送 ntfy 訊息到主題「{topic}」。',
    'Slack rejected the message: {error}' => 'Slack 拒絕了訊息：{error}',
    'Discord rejected the message: {error}' => 'Discord 拒絕了訊息：{error}',
    'the attached image could not be read' => '無法讀取附加的圖片',
    'Successfully sent MQTT message to topic "{topic}".' => '已成功向主題「{topic}」傳送 MQTT 訊息。',

    // Outbound: LinkedIn send results & skips
    '[EMPTY BODY] The LinkedIn post body is empty.' => '[EMPTY BODY] LinkedIn 貼文內文為空。',
    '[NO RECIPIENT] No LinkedIn connection was specified.' => '[NO RECIPIENT] 未指定 LinkedIn 連線。',
    '[RECONNECT REQUIRED] {reason}' => '[RECONNECT REQUIRED] {reason}',
    '[REJECTED BY LINKEDIN] {error}' => '[REJECTED BY LINKEDIN] {error}',
    'LinkedIn app credentials are not configured.' => '未設定 LinkedIn 應用程式憑證。',
    'The LinkedIn access token has expired. Please reconnect.' => 'LinkedIn 存取權杖已過期。請重新連接。',
    'The LinkedIn connection no longer exists.' => '該 LinkedIn 連線已不存在。',
    'My LinkedIn Profile' => '我的 LinkedIn 個人檔案',
    '[SKIPPED] Recipient "{name}" has no LinkedIn connection.' => '[SKIPPED] 收件者「{name}」沒有 LinkedIn 連線。',
    '[SKIPPED] The configured LinkedIn connection no longer exists (uid: {uid}).' => '[SKIPPED] 設定的 LinkedIn 連線已不存在 (uid: {uid})。',

    // Media attachments
    'Videos are not yet supported on {channel}.' => '{channel} 尚不支援影片。',
    'The image could not be resized to fit.' => '無法將圖片調整為合適的大小。',
    'The image could not be read.' => '無法讀取圖片。',
    'The image failed to upload.' => '圖片上傳失敗。',
    'The upload response had no media ID.' => '上傳回應中沒有媒體 ID。',
    'The upload response had no blob.' => '上傳回應中沒有 blob。',
    '[NOT ATTACHED] Unable to attach image. {reason}' => '[未附加] 無法附加圖片。{reason}',

    // Recipient warnings
    '[SKIPPED] User "{name}" has no Pushover key.' => '[已略過] 使用者「{name}」沒有 Pushover 金鑰。',

    // Errors & exceptions
    'Invalid element event: {class}' => '無效的元素事件:{class}',
    'Invalid notification ID: {id}' => '通知 ID 無效:{id}',
    'Invalid email message mode.' => '無效的郵件訊息模式。',
    'You do not have permission to use the Dynamic Recipients type.' => '您沒有權限使用動態收件者類型。',
    'Invalid settings section: {section}' => '無效的設定區段:{section}',
    'User not authorized to save this notification.' => '使用者無權儲存此通知。',
    'User not authorized to view this notification.' => '使用者無權查看此通知。',
    'User not authorized to delete this notification.' => '使用者無權刪除此通知。',
    'Notification not found' => '找不到通知',
    'Element not found' => '找不到元素',
    'You do not have permission to use the Dynamic Data type.' => '您沒有權限使用動態資料類型。',
    '[NO DATA] The Dynamic Data snippet did not call the {tag} tag.' => '[無資料] Twig 程式碼片段未呼叫 {tag} 標籤。',

    // Config-file override note
    'This is being set in the config file. [{file}]' => '此項在設定檔中設定。[{file}]',

    // ========================================================
    // JAVASCRIPT UI
    // ========================================================

    // JavaScript: log utility & buttons
    'Test notification failed.' => '測試通知失敗。',
    'Unable to get the notification, something went wrong.' => '無法取得通知，發生錯誤。',
    'Something went wrong.' => '發生錯誤。',
    'Invalid notification ID.' => '通知 ID 無效。',
    'Unable to delete the log event, something went wrong.' => '無法刪除日誌事件，發生錯誤。',
    'Log event deleted.' => '日誌事件已刪除。',
    'Unable to delete log events, something went wrong.' => '無法刪除日誌事件，發生錯誤。',
    'Are you sure you want to delete all logs from {date}?' => '確定要刪除 {date} 的所有日誌嗎？',
    // Reworded outbound + dispatch log messages
    '[BAD CREDENTIALS] Missing app token. [Configure Pushover]({url}).' => '[憑證無效] 缺少應用程式權杖。[設定 Pushover]({url})。',
    '[BAD CREDENTIALS] Missing {missing}. [Configure Twilio]({url}).' => '[憑證無效] 缺少 {missing}。[設定 Twilio]({url})。',
    '[BAD CREDENTIALS] No Discord webhook URL is configured.' => '[憑證無效] 未設定 Discord webhook URL。',
    '[BAD CREDENTIALS] No MQTT broker host is configured.' => '[憑證無效] 未設定 MQTT broker 主機。',
    '[BAD CREDENTIALS] No Mastodon access token is configured.' => '[憑證無效] 未設定 Mastodon 存取權杖。',
    '[BAD CREDENTIALS] No Mastodon instance URL is configured.' => '[憑證無效] 未設定 Mastodon 實例 URL。',
    '[BAD CREDENTIALS] No Slack bot token is configured.' => '[憑證無效] 未設定 Slack bot 權杖。',
    '[BAD CREDENTIALS] No Twilio phone number is configured.' => '[憑證無效] 未設定 Twilio 電話號碼。',
    '[BAD CREDENTIALS] The recipient is missing Bluesky credentials.' => '[憑證無效] 收件人缺少 Bluesky 憑證。',
    '[BAD CREDENTIALS] The recipient is missing Facebook credentials.' => '[憑證無效] 收件人缺少 Facebook 憑證。',
    '[BAD CREDENTIALS] The recipient is missing X (Twitter) credentials.' => '[憑證無效] 收件人缺少 X (Twitter) 憑證。',
    '[BAD CREDENTIALS] Unable to post, recipient is missing credentials.' => '[憑證無效] 無法發佈；收件人缺少憑證。',
    '[EMPTY BODY] The Discord message body is empty.' => '[內容為空] Discord 訊息內容為空。',
    '[EMPTY BODY] The Facebook post body is empty.' => '[內容為空] Facebook 貼文內容為空。',
    '[EMPTY BODY] The MQTT payload is empty.' => '[內容為空] MQTT 負載為空。',
    '[EMPTY BODY] The Mastodon post body is empty.' => '[內容為空] Mastodon 貼文內容為空。',
    '[EMPTY BODY] The Slack message body is empty.' => '[內容為空] Slack 訊息內容為空。',
    '[EMPTY BODY] The X (Twitter) post body is empty.' => '[內容為空] X (Twitter) 貼文內容為空。',
    '[EMPTY BODY] The email message body was empty.' => '[內容為空] 郵件內容為空。',
    '[FEED ERROR] Could not fetch the feed: {message}' => '[Feed 錯誤] 無法取得 Feed：{message}',
    '[FEED ERROR] Could not parse the feed.' => '[Feed 錯誤] 無法解析 Feed。',
    '[FEED ERROR] Could not parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => '[Feed 錯誤] 無法解析 Feed。需要 PHP `simplexml` 和 `libxml` 擴充功能。',
    '[FEED ERROR] Initial feed scan failed: {message}' => '[Feed 錯誤] 初始 Feed 掃描失敗：{message}',
    '[INVALID NUMBER] The recipient phone number is invalid.' => '[號碼無效] 收件人的電話號碼無效。',
    '[INVALID TYPE] The flash message type is invalid.' => '[類型無效] Flash 訊息類型無效。',
    '[LINK PREVIEW SKIPPED] {reason}' => '[已略過連結預覽] {reason}',
    '[MISSING IMAGE] Image Attachment field never called the {tag} tag.' => '[缺少圖片] 圖片附件欄位從未呼叫 {tag} 標籤。',
    '[MISSING IMAGE] Image Attachment field was empty.' => '[缺少圖片] 圖片附件欄位為空。',
    '[MISSING IMAGE] The {tag} tag was called, but returned an invalid image.' => '[缺少圖片] 已呼叫 {tag} 標籤，但傳回了無效的圖片。',
    '[MISSING IMAGE] Unable to send Instagram post, the image needs a public URL.' => '[缺少圖片] 無法傳送 Instagram 貼文，圖片需要公開的 URL。',
    '[NO CALENDAR] No calendars are selected, this notification will never be triggered.' => '[無行事曆] 未選擇任何行事曆，此通知將永遠不會觸發。',
    '[NO DIGITAL PRODUCT TYPE] No digital product types are selected, this notification will never be triggered.' => '[無數位產品類型] 未選擇任何數位產品類型，此通知將永遠不會觸發。',
    '[NO ENTRY TYPE] No sections or entry types are selected, this notification will never be triggered.' => '[無項目類型] 未選擇任何區塊或項目類型，此通知將永遠不會觸發。',
    '[NO PRODUCT TYPE] No product types are selected, this notification will never be triggered.' => '[無產品類型] 未選擇任何產品類型，此通知將永遠不會觸發。',
    '[NO USER GROUP] No user groups are selected, this notification will never be triggered.' => '[無使用者群組] 未選擇任何使用者群組，此通知將永遠不會觸發。',
    '[NO VOLUME] No volumes are selected, this notification will never be triggered.' => '[無磁碟區] 未選擇任何磁碟區，此通知將永遠不會觸發。',
    '[NO MEDIA] No image was attached because the {tag} tag was never invoked in the Image Attachment field.' => '[無媒體] 未附加任何圖片，因為從未在圖片附件欄位中呼叫 {tag} 標籤。',
    '[NO RECIPIENTS] The Dynamic Recipients snippet did not call setRecipients.' => '[無收件人] 動態收件人程式碼片段未呼叫 setRecipients。',
    '[NO RECIPIENTS] setRecipients was called with an empty value.' => '[無收件人] setRecipients 以空值被呼叫。',
    '[NO RECIPIENT] No MQTT topic was specified.' => '[無收件人] 未指定 MQTT 主題。',
    '[NO RECIPIENT] No Slack channel ID was specified.' => '[無收件人] 未指定 Slack 頻道 ID。',
    '[NO RECIPIENT] No ntfy topic was specified.' => '[無收件人] 未指定 ntfy 主題。',
    '[NO RECIPIENT] No recipient user was specified for the announcement.' => '[無收件人] 未為公告指定收件使用者。',
    '[NO RECIPIENT] No recipient was specified for the email.' => '[無收件人] 未為郵件指定收件人。',
    '[NO RECIPIENT] The recipient has no Pushover user key.' => '[無收件人] 收件人沒有 Pushover 使用者金鑰。',
    '[NO RECIPIENT] The recipient has no phone number.' => '[無收件人] 收件人沒有電話號碼。',
    '[REJECTED BY DISCORD] {error}' => '[被拒絕: DISCORD] {error}',
    '[REJECTED BY FACEBOOK] {error}' => '[被拒絕: FACEBOOK] {error}',
    '[REJECTED BY INSTAGRAM] {error}' => '[被拒絕: INSTAGRAM] {error}',
    '[REJECTED BY MASTODON] {error}' => '[被拒絕: MASTODON] {error}',
    '[REJECTED BY SLACK] {error}' => '[被拒絕: SLACK] {error}',
    '[REJECTED BY X (TWITTER)] {error}' => '[被拒絕: X (TWITTER)] {error}',
    '[SEND FAILED] Authentication failed for {handle}: {reason}' => '[發送失敗] {handle} 的身分驗證失敗：{reason}',
    '[SEND FAILED] Authentication failed: {reason}' => '[發送失敗] 身分驗證失敗：{reason}',
    "[SEND FAILED] Could not send the email using Craft's native handling. Check your general email settings within Craft." => '[發送失敗] 無法使用 Craft 的原生處理傳送郵件。請檢查 Craft 中的一般郵件設定。',
    '[SEND FAILED] HTTP {status}: {reason}' => '[發送失敗] HTTP {status}: {reason}',
    '[SEND FAILED] {error}' => '[發送失敗] {error}',
    '[SEND FAILED] {reason}' => '[發送失敗] {reason}',
    '[SKIPPED] Pushover user-key field is not configured on this notification.' => '[已略過] 此通知未設定 Pushover 使用者金鑰欄位。',
    '[SKIPPED] Recipient "{name}" cannot access the control panel.' => '[已略過] 收件人「{name}」無法存取控制面板。',
    '[SKIPPED] Recipient "{name}" has no Bluesky credentials.' => '[已略過] 收件人「{name}」沒有Bluesky 憑證。',
    '[SKIPPED] Recipient "{name}" has no Craft user account.' => '[已略過] 收件人「{name}」沒有 Craft 使用者帳戶。',
    '[SKIPPED] Recipient "{name}" has no Discord webhook URL.' => '[已略過] 收件人「{name}」沒有Discord webhook URL。',
    '[SKIPPED] Recipient "{name}" has no Facebook credentials.' => '[已略過] 收件人「{name}」沒有Facebook 憑證。',
    '[SKIPPED] Recipient "{name}" has no Instagram credentials.' => '[已略過] 收件人「{name}」沒有Instagram 憑證。',
    '[SKIPPED] Recipient "{name}" has no MQTT topic.' => '[已略過] 收件人「{name}」沒有MQTT 主題。',
    '[SKIPPED] Recipient "{name}" has no Mastodon credentials.' => '[已略過] 收件人「{name}」沒有Mastodon 憑證。',
    '[SKIPPED] Recipient "{name}" has no Slack bot token.' => '[已略過] 收件人「{name}」沒有Slack bot 權杖。',
    '[SKIPPED] Recipient "{name}" has no Slack channel ID.' => '[已略過] 收件人「{name}」沒有Slack 頻道 ID。',
    '[SKIPPED] Recipient "{name}" has no X (Twitter) credentials.' => '[已略過] 收件人「{name}」沒有X (Twitter) 憑證。',
    '[SKIPPED] Recipient "{name}" has no email address.' => '[已略過] 收件人「{name}」沒有電子郵件地址。',
    '[SKIPPED] Recipient "{name}" has no ntfy topic.' => '[已略過] 收件人「{name}」沒有ntfy 主題。',
    '[SKIPPED] Recipient "{name}" has no phone number.' => '[已略過] 收件人「{name}」沒有電話號碼。',
    '[SKIPPED] The configured {kind} no longer exists in the plugin settings (uid: {uid}).' => '[已略過] 設定的 {kind} 已不存在於外掛設定中（uid: {uid}）。',
    '[SKIPPED] Unrecognized recipient "{value}".' => '[已略過] 無法辨識的收件人「{value}」。',
    '[SKIPPED] Unrecognized recipient of type "{type}".' => '[已略過] 無法辨識的收件人類型「{type}」。',
    '[TOO LONG] The Discord message body exceeds the 2000-character limit.' => '[過長] Discord 訊息內容超過了 2000 字元的限制。',
    '[TRUNCATED] Body exceeded {max} characters.' => '[已截斷] 內容超過了 {max} 個字元。',
    '[TRUNCATED] Caption exceeded {max} characters.' => '[已截斷] 說明文字超過了 {max} 個字元。',
];
