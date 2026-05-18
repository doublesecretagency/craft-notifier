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
    'Notification Log'       => '通知日誌',
    'Logs'                   => '日誌',
    'View Notifications'     => '查看通知',
    'Add a New Notification' => '新增通知',

    // Permissions
    'View notifications'              => '查看通知',
    'Save notifications'              => '儲存通知',
    'Use the Dynamic Recipients type' => '使用動態收件者類型',
    'Test notifications'              => '測試通知',
    'Delete notifications'            => '刪除通知',
    'View notification log'           => '查看通知日誌',
    'Delete notification log'         => '刪除通知日誌',

    // Notification editor: tabs
    'Meta'       => '中繼資料',
    'Event'      => '事件',
    'Message'    => '訊息',
    'Recipients' => '收件者',

    // Event tab: type selector
    'Event Type'                                           => '事件類型',
    'What type of event will activate the notification?'   => '哪種類型的事件將觸發此通知?',
    'Which specific event will activate the notification?' => '哪個具體事件將觸發此通知?',

    // Event tab: event types
    'Assets Event'                   => '資產事件',
    'Commerce Orders Event'          => 'Commerce 訂單事件',
    'Commerce Products Event'        => 'Commerce 產品事件',
    'Digital Products Event'         => 'Digital Products 事件',
    'Digital Product Licenses Event' => 'Digital Products 授權事件',
    'Solspace Calendar Event'        => 'Solspace Calendar 事件',
    'Entries Event'                  => '條目事件',
    'Users Event'                    => '使用者事件',
    'Ungrouped Users'                => '未分組使用者',

    // Field and element conditions
    'Field Conditions'             => '欄位條件',
    'Send the message only when the saved element matches the following conditions.' => '僅在儲存的元素符合以下條件時傳送訊息。',
    'has changed'                  => '已變更',
    '#{elementType} Event Filters' => '#{elementType} 事件篩選器',
    'No filters match this event.' => '沒有篩選器符合此事件。',
    'Determine whether each message should be sent based on specified conditions.' => '根據指定的條件決定是否傳送每則訊息。',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => '元素正在首次儲存',
    'Must be a new entry'                       => '必須是新條目',
    'Must be an existing entry'                 => '必須是現有條目',
    'Can be existing or new'                    => '可以是現有或新的',

    // Filters: new elements
    'Element is new'         => '元素是新的',
    'New elements only'      => '僅限新元素',
    'Existing elements only' => '僅限現有元素',

    // Filters: enabled state
    'Element is enabled'         => '元素已啟用',
    'Must be enabled'            => '必須啟用',
    'Must be disabled'           => '必須停用',
    'Can be enabled or disabled' => '可以啟用或停用',

    // Filters: drafts
    'Element is a draft'          => '元素是草稿',
    'Must be a draft'             => '必須是草稿',
    'Must not be a draft'         => '不得為草稿',
    'Can be a draft or non-draft' => '可以是草稿或非草稿',

    // Filters: provisional drafts
    'Element is a provisional draft'                => '元素是暫存草稿',
    'Must be a provisional draft'                   => '必須是暫存草稿',
    'Must not be a provisional draft'               => '不得為暫存草稿',
    'Can be a provisional draft or non-provisional' => '可以是暫存草稿或非暫存草稿',

    // Filters: revisions
    'Element is a revision'             => '元素是修訂版本',
    'Must be a revision'                => '必須是修訂版本',
    'Must not be a revision'            => '不得為修訂版本',
    'Can be a revision or non-revision' => '可以是修訂版本或非修訂版本',

    // Filters: duplication
    'Element is being duplicated'         => '元素正在被複製',
    'Must be duplicating the element'     => '必須正在複製元素',
    'Must not be duplicating the element' => '不得正在複製元素',

    // Filters: propagation
    'Element is being propagated'     => '元素正在傳播',
    'Element must be propagating'     => '元素必須正在傳播',
    'Element must not be propagating' => '元素不得正在傳播',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => '元素正在批次重新儲存',
    'Must be bulk-resaving the element'     => '必須正在批次重新儲存元素',
    'Must not be bulk-resaving the element' => '不得正在批次重新儲存元素',

    // Filters: common output
    'Unnamed filter'                => '未命名篩選器',
    'Must be TRUE to send message'  => '必須為 TRUE 才能傳送訊息',
    'Must be FALSE to send message' => '必須為 FALSE 才能傳送訊息',
    'No effect'                     => '無效',

    // Message tab: type selector and queue
    'Message Type'                       => '訊息類型',
    'What type of message will be sent?' => '將傳送什麼類型的訊息?',
    'Send Message via Queue'             => '透過佇列傳送訊息',
    'Should the message be sent via the [jobs queue]({queueUrl})?' => '是否透過[工作佇列]({queueUrl})傳送訊息?',
    'Send immediately' => '立即傳送',
    'Add to queue' => '加入佇列',

    // Message tab: Email fields
    "User's Email Address Field" => '使用者的電子郵件地址欄位',
    'Email Subject'              => '郵件主旨',
    'Email Body'                 => '郵件內文',

    // Message tab: SMS fields
    "User's Phone Number Field" => '使用者的電話號碼欄位',
    'SMS Message Body'          => '簡訊內容',

    // Message tab: Announcement fields
    'Announcement Title'   => '公告標題',
    'Announcement Message' => '公告訊息',

    // Message tab: Flash fields
    'Flash Message Type'                         => '即時訊息類型',
    'Flash Message Title'                        => '即時訊息標題',
    'Flash Message Details'                      => '即時訊息詳情',
    'Which type of flash message should appear?' => '應顯示什麼類型的即時訊息?',

    // Message tab: Pushover fields
    "Field containing each user's Pushover key" => '使用者的 Pushover 金鑰欄位',
    'The Pushover application token is configured in [Settings → Pushover](url).' => 'Pushover 應用程式金鑰在[設定 → Pushover](url)中設定。',

    // Message tab: ntfy fields
    'Priority'           => '優先順序',
    'Tags'               => '標籤',
    'Click URL'          => '點擊 URL',
    'Render as Markdown' => '以 Markdown 呈現',

    // Message tab: Slack fields
    'Slack Message Body' => 'Slack 訊息內文',

    // Message tab: Bluesky fields
    'Post Body' => '貼文內文',
    'Generate Link Preview' => '產生連結預覽',
    "When the post body contains a URL, automatically generate a preview card with the linked page's image, title, and description." => '當貼文內文包含 URL 時，附加一張預覽卡片，顯示所連結頁面的標題、描述與圖片。',
    'No card' => '無卡片',
    'Generate preview card' => '產生預覽卡片',

    // Message tab: Title / Body / Trix toolbar
    'Title'         => '標題',
    'Body'          => '內文',
    'Rich Text'     => '格式化文字',
    'Bold'          => '粗體',
    'Italic'        => '斜體',
    'Underline'     => '底線',
    'Strikethrough' => '刪除線',
    'Bullets'       => '項目符號',
    'Numbers'       => '編號',
    'Heading'       => '標題',
    'Code'          => '程式碼',
    'Undo'          => '復原',
    'Redo'          => '重做',
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => '外送郵件的內文。您可以使用<a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">特殊變數</a>,甚至<a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">略過收件者</a>。',

    // Recipients tab: common
    'Recipients Type'                             => '收件者類型',
    'Who will receive this message?'              => '誰將收到此訊息?',
    'Add a message recipient'                     => '新增訊息收件者',
    'Select User(s)'                              => '選擇使用者',
    'Which users will receive the message?'       => '哪些使用者將收到訊息?',
    'Which user groups will receive the message?' => '哪些使用者群組將收到訊息?',
    'Twig Snippet to Determine Recipients'        => '用於決定收件者的 Twig 程式碼片段',

    // Recipients tab: per-provider pickers
    'Select Slack channel(s)'                           => '選擇 Slack 頻道',
    'Which Slack channels should receive this message?' => '哪些 Slack 頻道應收到此訊息?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => '未設定 Slack 頻道。請在[設定 → Slack]({url})中新增一個。',
    'Select ntfy topic(s)'                              => '選擇 ntfy 主題',
    'Which ntfy topics should receive this message?'    => '哪些 ntfy 主題應收到此訊息?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => '未設定 ntfy 主題。請在[設定 → ntfy]({url})中新增一個。',
    'Select Bluesky account(s)'                         => '選擇 Bluesky 帳號',
    'Which Bluesky accounts should post this message?'  => '哪些 Bluesky 帳號應發布此訊息?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => '未設定 Bluesky 帳號。請在[設定 → Bluesky]({url})中新增一個。',

    // Settings: page chrome
    'Notifier Settings' => 'Notifier 設定',
    'General'           => '一般',
    'Twilio'            => 'Twilio',
    'Pushover'          => 'Pushover',
    'Slack'             => 'Slack',
    'Bluesky'           => 'Bluesky',
    'ntfy'              => 'ntfy',

    // Settings: Logging
    'Logging'                             => '日誌記錄',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier 持續記錄已傳送訊息的日誌。通常不需要,但您可以限制儲存到資料庫的日誌事件數量。',
    'Enable Logging'                      => '啟用日誌記錄',
    'When disabled, Notifier will not write anything to the notification log.' => '停用時,Notifier 不會寫入任何內容到通知日誌。',
    'Number of days to retain log events' => '保留日誌事件的天數',
    'At most, keep log events for this many days. Leave blank for no limit.' => '最多保留這麼多天的日誌事件。留空表示無限制。',
    'Number of log events to retain'      => '要保留的日誌事件數量',
    'At most, keep this many log events. Leave blank for no limit.' => '最多保留這麼多日誌事件。留空表示無限制。',

    // Settings: Twilio
    'Twilio API Credentials'                       => 'Twilio API 憑證',
    'If using the Twilio API to send SMS messages, the following credentials are required.' => '如果使用 Twilio API 傳送簡訊,則需要以下憑證。',
    'Twilio Account SID'                           => 'Twilio 帳號 SID',
    'Twilio Auth Token'                            => 'Twilio 驗證權杖',
    'Twilio phone number (sends each SMS message)' => 'Twilio 電話號碼(傳送每則簡訊)',
    'SMS Testing'                                  => '簡訊測試',
    'Optional. When set, every SMS dispatched will be sent to this number instead of the resolved recipient.' => '選用。設定後,每則簡訊將傳送到此號碼,而非實際收件者。',
    'Test phone number'                            => '測試電話號碼',

    // Settings: Pushover
    "[Pushover](https://pushover.net) sends push notifications to a registered user's devices. Each Craft user needs a custom field on their profile storing their Pushover user key; you select which field on each Notification's Message tab. For full setup instructions, see the [Pushover getting-started docs](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover)." => '[Pushover](https://pushover.net) 向已註冊使用者的裝置傳送推播通知。每位 Craft 使用者的個人資料上需要一個自訂欄位來儲存其 Pushover 使用者金鑰;在每個通知的「訊息」分頁上選擇使用哪個欄位。完整的設定說明請參閱 [Pushover 入門文件](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover)。',
    'Application API Token'                                      => '應用程式 API 金鑰',
    'The 30-character app token from your Pushover application.' => '來自您 Pushover 應用程式的 30 個字元應用程式金鑰。',

    // Settings: ntfy
    'ntfy.sh is a free HTTP-based push notification service. Subscribers receive messages on the ntfy app, web, or any compatible client by joining a topic.' => 'ntfy.sh 是一個免費的基於 HTTP 的推播通知服務。訂閱者透過加入主題在 ntfy 應用程式、網頁或任何相容客戶端上接收訊息。',
    'Server URL'   => '伺服器 URL',
    'Defaults to https://ntfy.sh. Point at a self-hosted ntfy instance if applicable.' => '預設為 https://ntfy.sh。如適用,可指向自架的 ntfy 實例。',
    'Access token' => '存取權杖',
    'Optional. Required for protected topics or self-hosted instances with auth.' => '選用。用於受保護主題或具有身分驗證的自架實例時必填。',
    'ntfy Topics'  => 'ntfy 主題',
    'Named list of ntfy topics. Each topic becomes selectable on the notification edit screen.' => '命名的 ntfy 主題清單。每個主題都可以在通知編輯畫面中選擇。',
    'Topics'       => '主題',
    'Add one row per topic name. Use the **Test** button to send a quick test message to the topic.' => '每個主題名稱新增一列。使用 **Test** 按鈕向主題傳送快速測試訊息。',
    'Topic'        => '主題',
    'Add a topic'  => '新增主題',
    'Save first to persist a row, then click its **Test** button to fire a sanity check against ntfy.' => '先儲存以保留一列,然後點擊其 **Test** 按鈕對 ntfy 進行快速檢查。',

    // Settings: Slack
    'Slack Channels' => 'Slack 頻道',
    'Channels'       => '頻道',
    'Each Slack channel needs its own Incoming Webhook URL. Use the **Test** button to fire a quick sanity check after saving.' => '每個 Slack 頻道需要自己的 Incoming Webhook URL。儲存後,使用 **Test** 按鈕進行快速檢查。',
    'Webhook URL'    => 'Webhook URL',
    'Add a channel'  => '新增頻道',
    'Save first to persist a row, then click its **Test** button to fire a sanity check against Slack.' => '先儲存以保留一列,然後點擊其 **Test** 按鈕對 Slack 進行快速檢查。',

    // Settings: Bluesky
    '[Bluesky](https://bsky.app) posts publish to the configured account\'s feed via the ATProto API. App passwords are generated at [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). An app password is a secret, so store it in a `.env` variable and reference that variable (e.g. `$BLUESKY_APP_PASSWORD`) rather than pasting the password directly.' => '[Bluesky](https://bsky.app) 貼文會透過 ATProto API 發佈到所設定帳戶的動態消息中。應用程式密碼在 [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords) 產生。應用程式密碼是機密資訊，因此請將其儲存在 `.env` 變數中，並參照該變數（例如 `$BLUESKY_APP_PASSWORD`），而不要直接貼上密碼。',
    'PDS URL'          => 'PDS URL',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => '預設為 https://bsky.social。如您的安裝支援聯邦,可指向自訂 PDS。',
    'Bluesky Accounts' => 'Bluesky 帳號',
    'Named list of Bluesky accounts. Each account becomes selectable on the notification edit screen.' => '命名的 Bluesky 帳號清單。每個帳號都可以在通知編輯畫面中選擇。',
    'Accounts'         => '帳號',
    'Add one row per Bluesky account. Use **Test** to verify the credentials authenticate.' => '每個 Bluesky 帳號新增一列。使用 **Test** 驗證憑證是否能通過認證。',
    'Label'            => '標籤',
    'Handle'           => '代號',
    'App password'     => '應用程式密碼',
    'Add an account'   => '新增帳號',
    'Save first to persist a row, then click its **Test** button to verify the credentials authenticate.' => '先儲存以保留一列,然後點擊其 **Test** 按鈕驗證憑證是否能通過認證。',

    // Test notification (UI)
    'Send a test message'           => '傳送測試訊息',
    'Are you certain you want to send a test notification?\\n\\nThe configured message will be sent to the configured recipient(s).' => '確定要傳送測試通知嗎?\\n\\n設定的訊息將傳送給設定的收件者。',
    'Test'                          => '測試',
    'Test notification dispatched.' => '已傳送測試通知。',
    'No messages were dispatched. Check the recipient configuration.' => '未傳送任何訊息。請檢查收件者設定。',

    // Settings: save / test action responses
    "Couldn't save settings."                 => '無法儲存設定。',
    'Settings saved.'                         => '設定已儲存。',
    'Topic is empty.'                         => '主題為空。',
    'Server URL is not configured.'           => '伺服器 URL 未設定。',
    'Test message from Notifier.'             => '來自 Notifier 的測試訊息。',
    'HTTP {status}'                           => 'HTTP {status}',
    'Test message sent successfully.'         => '測試訊息傳送成功。',
    'HTTP {status}: {body}'                   => 'HTTP {status}: {body}',
    'Handle and app password are required.'   => '代號和應用程式密碼為必填項目。',
    'Authentication failed.'                  => '身分驗證失敗。',
    'Successfully authenticated. No messages were posted.' => '驗證成功。未發佈任何訊息。',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.'          => '正在向 {recipient} 傳送 {messageType}。',
    'Adding message to queue.'                       => '正在將訊息加入佇列。',
    'Sending message immediately (bypassing queue).' => '立即傳送訊息(略過佇列)。',
    'Log events deleted.'                            => '日誌事件已刪除。',
    'notification'                                   => '通知',

    // Outbound: Email log messages
    'Unable to send email, no recipient specified.'     => '無法傳送郵件:未指定收件者。',
    'Unable to send email, the message body was empty.' => '無法傳送郵件:訊息內文為空。',
    "Unable to send the email using Craft's native email handling." => '無法使用 Craft 原生郵件處理傳送郵件。',
    'Check your general email settings within Craft.'   => '請檢查 Craft 中的一般郵件設定。',
    'Successfully sent email message!'                  => '郵件傳送成功!',

    // Outbound: SMS log messages
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[Twilio 憑證無效。]({url}) 缺少 {missing}。',
    'Unable to send SMS, no Twilio phone number exists.'      => '無法傳送簡訊:不存在 Twilio 電話號碼。',
    'Unable to send SMS, no recipient phone number exists.'   => '無法傳送簡訊:不存在收件者電話號碼。',
    'Unable to send SMS, recipient phone number is invalid.'  => '無法傳送簡訊:收件者電話號碼無效。',
    'Successfully sent SMS message!'                          => '簡訊傳送成功!',

    // Outbound: Announcement log messages
    'Unable to post announcement, no recipient userId specified.' => '無法發布公告:未指定收件者 userId。',
    'Successfully posted announcement!' => '公告發布成功!',

    // Outbound: Flash log messages
    'Unable to send the flash message, invalid flash type.' => '無法傳送即時訊息:即時訊息類型無效。',
    'Successfully sent flash message!'                      => '即時訊息傳送成功!',

    // Outbound: Pushover log messages
    '[Invalid Pushover credentials.]({url}) Missing app token.'  => '[Pushover 憑證無效。]({url}) 缺少應用程式金鑰。',
    'Unable to send Pushover message, no user key on recipient.' => '無法傳送 Pushover 訊息:收件者沒有使用者金鑰。',
    'Pushover POST failed: {reason}'                             => 'Pushover POST 失敗:{reason}',
    'Successfully sent Pushover message!'                        => 'Pushover 訊息傳送成功!',

    // Outbound: ntfy log messages
    'Unable to send ntfy message, no server URL configured.' => '無法傳送 ntfy 訊息:未設定伺服器 URL。',
    'Unable to send ntfy message, no topic specified.'       => '無法傳送 ntfy 訊息:未指定主題。',
    'ntfy POST failed with HTTP {status}: {reason}'          => 'ntfy POST 失敗,HTTP {status}:{reason}',
    'ntfy POST failed: {reason}'                             => 'ntfy POST 失敗:{reason}',
    'Successfully sent ntfy message to topic "{topic}".'     => '已成功傳送 ntfy 訊息到主題「{topic}」。',

    // Outbound: Slack log messages
    'Unable to send Slack message, no webhook URL.' => '無法傳送 Slack 訊息:沒有 webhook URL。',
    'Unable to send Slack message, webhook URL is not valid.' => '無法傳送 Slack 訊息:webhook URL 無效。',
    'Unable to send Slack message, body is empty.'  => '無法傳送 Slack 訊息:內文為空。',
    'Slack POST failed (HTTP {status}): {reason}'   => 'Slack POST 失敗 (HTTP {status}):{reason}',
    'Slack POST failed: {reason}'                   => 'Slack POST 失敗:{reason}',
    'Successfully sent Slack message to "{label}".' => '已成功傳送 Slack 訊息到「{label}」。',

    // Outbound: Bluesky log messages
    'Unable to send Bluesky post, recipient is missing credentials.' => '無法傳送 Bluesky 貼文:收件者缺少憑證。',
    'Body exceeded {max} characters, truncated.'          => '內文超過 {max} 個字元,已截斷。',
    'Successfully posted to Bluesky as "{label}".'        => '已成功以「{label}」在 Bluesky 上發布。',
    'Bluesky auth failed for {handle}: {reason}'          => '{handle} 的 Bluesky 身分驗證失敗:{reason}',
    'Bluesky auth failed: {reason}'                       => 'Bluesky 身分驗證失敗:{reason}',
    'Bluesky post failed: {reason}'                       => 'Bluesky 貼文失敗:{reason}',
    'Bluesky link preview skipped: {reason}'              => '已略過 Bluesky 連結預覽：{reason}',

    // Recipient-strategy warnings
    'Recipient "{name}" has no email address.'       => '收件者「{name}」沒有電子郵件地址。',
    'Recipient "{name}" has no phone number.'        => '收件者「{name}」沒有電話號碼。',
    'Recipient "{name}" has no associated User; cannot send announcement.' => '收件者「{name}」沒有關聯的使用者;無法傳送公告。',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => '收件者「{name}」無法存取控制台;無法傳送公告。',
    'Pushover user-key field is not configured on this notification.' => '此通知未設定 Pushover 使用者金鑰欄位。',
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => '收件者「{name}」沒有關聯的使用者;無法傳送 Pushover 訊息。',
    '[SKIPPED] User "{name}" has no Pushover key.'   => '[已略過] 使用者「{name}」沒有 Pushover 金鑰。',
    'Recipient "{name}" has no ntfy topic.'          => '收件者「{name}」沒有 ntfy 主題。',
    'Recipient "{name}" has no Slack webhook URL.'   => '收件者「{name}」沒有 Slack webhook URL。',
    'Recipient "{name}" has no Bluesky credentials.' => '收件者「{name}」沒有 Bluesky 憑證。',

    // Errors / exceptions
    'Invalid element event: {class}'                         => '無效的元素事件:{class}',
    'Invalid notification ID: {id}'                          => '通知 ID 無效:{id}',
    'Invalid email message mode.'                            => '無效的郵件訊息模式。',
    'You do not have permission to use the Dynamic Recipients type.' => '您沒有權限使用動態收件者類型。',
    'Dynamic recipients snippet did not call setRecipients.' => '動態收件者程式碼片段未呼叫 setRecipients。',
    'setRecipients was called with an empty value.'          => 'setRecipients 呼叫時傳入了空值。',
    'Unrecognized recipient of type "{type}".'               => '未識別的「{type}」類型收件者。',
    'Unrecognized recipient "{value}".'                      => '未識別的收件者「{value}」。',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => '已設定的 {kind} 不再存在於外掛設定中 (uid: {uid})。',
    'Invalid settings section: {section}'                    => '無效的設定區段:{section}',
    'User not authorized to save this notification.'         => '使用者無權儲存此通知。',
    'User not authorized to view this notification.'         => '使用者無權查看此通知。',
    'User not authorized to delete this notification.'       => '使用者無權刪除此通知。',
    'Notification not found'                                 => '找不到通知',

    // Misc config-file note
    'This is being set in the config file. [{file}]' => '此項在設定檔中設定。[{file}]',

    // Slack, ntfy, and Bluesky message types
    "Add the Bluesky accounts you'd like to post from. Each account becomes available as a recipient on the **Recipients** tab when configuring a notification." => '新增您希望用於發布的 Bluesky 帳號。設定通知時,每個帳號都可在**收件者**分頁中作為收件者使用。',
    "Click any row's **Test** button to confirm the account authenticates." => '點擊任一列的 **Test** 按鈕以確認該帳號能通過認證。',
    'Add an [Incoming Webhook](https://api.slack.com/messaging/webhooks) for each Slack channel you\'d like to post into. Each webhook becomes available as a recipient on the **Recipients** tab when configuring a notification. A webhook URL is a secret, so store it in a `.env` variable and reference that variable (e.g. `$SLACK_WEBHOOK_URL`) rather than pasting the URL directly.' => '為每個要發佈到的 Slack 頻道新增一個 [Incoming Webhook](https://api.slack.com/messaging/webhooks)。設定通知時，每個 webhook 都會在 **Recipients** 標籤頁中作為收件者顯示。webhook URL 是機密資訊，因此請將其儲存在 `.env` 變數中，並參照該變數（例如 `$SLACK_WEBHOOK_URL`），而不要直接貼上 URL。',
    "Click any row's **Test** button to send a quick test message to that channel." => '點擊任一列的 **Test** 按鈕以向該頻道傳送快速測試訊息。',
    'Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`.' => '選用,指向自架的 ntfy 實例(如適用)。預設為 `https://ntfy.sh`。',
    'Optional, required for protected topics or self-hosted instances with auth.' => '選用,用於受保護主題或具有身分驗證的自架實例時必填。',
    'Add the ntfy topics you\'d like to send messages to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification.' => '新增您希望傳送訊息的 ntfy 主題。設定通知時,每個主題都可在**收件者**分頁中作為收件者使用。',
    "Click any row's **Test** button to send a quick test message to that topic." => '點擊任一列的 **Test** 按鈕以向該主題傳送快速測試訊息。',
    'Enable Markdown' => '啟用 Markdown',
    'Link URL' => '連結 URL',
    'Not a valid Webhook URL. Must start with https://hooks.slack.com/services/' => 'Webhook URL 無效。必須以 https://hooks.slack.com/services/ 開頭。',

    // Manual triggers
    'Send Notification'                                            => '傳送通知',
    'Send manual notifications'                                    => '傳送手動通知',
    'Are you sure you want to send this notification?'             => '確定要傳送此通知嗎？',
    'This notification cannot be triggered manually.'              => '此通知無法手動觸發。',
    'This notification no longer applies to the selected element.' => '此通知不再適用於所選元素。',
    'Notification sent.'                                           => '通知已傳送。',
    'Element not found'                                            => '找不到元素',
    'Manual Trigger Label'                                         => '手動觸發標籤',
    'An element action label (helps to differentiate multiple manual triggers).' => '元素動作標籤（有助於區分多個手動觸發）。',
];
