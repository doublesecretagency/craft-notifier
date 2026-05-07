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
    'Notification Log'       => '通知記錄',
    'Logs'                   => '記錄',
    'View Notifications'     => '檢視通知',
    'Add a New Notification' => '新增通知',

    // Permissions
    'View notifications'              => '檢視通知',
    'Save notifications'              => '儲存通知',
    'Use the Dynamic Recipients type' => '使用動態收件者類型',
    'Delete notifications'            => '刪除通知',
    'View notification log'           => '檢視通知記錄',
    'Delete notification log'         => '刪除通知記錄',

    // Notification editor: tabs
    'Meta'       => '中繼資料',
    'Event'      => '事件',
    'Message'    => '訊息',
    'Recipients' => '收件者',

    // Event tab
    'Event Type'                                           => '事件類型',
    'What type of event will activate the notification?'   => '哪種類型的事件會觸發通知?',
    'Which specific event will activate the notification?' => '哪個具體事件會觸發通知?',
    'Assets Event'                                         => 'Asset 事件',
    'Commerce Orders Event'                                => 'Commerce 訂單事件',
    'Entries Event'                                        => '項目事件',
    'Users Event'                                          => '使用者事件',

    // Field and element conditions
    'Field Conditions'                                                               => '欄位條件',
    'Send the message only when the saved element matches the following conditions.' => '僅當儲存的元素符合以下條件時才傳送訊息。',
    'has changed'                                                                    => '已變更',
    '#{elementType} Event Filters'                                                   => '#{elementType} 事件篩選器',
    'No filters match this event.'                                                   => '沒有篩選器符合此事件。',
    'Determine whether each message should be sent based on specified conditions.'   => '根據指定的條件決定是否傳送每則訊息。',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => '元素正在首次儲存',
    'Must be a new entry'                       => '必須為新項目',
    'Must be an existing entry'                 => '必須為現有項目',
    'Can be existing or new'                    => '可為現有或新項目',

    // Filters: new elements
    'Element is new'         => '元素為新項目',
    'New elements only'      => '僅新元素',
    'Existing elements only' => '僅現有元素',

    // Filters: enabled state
    'Element is enabled'         => '元素已啟用',
    'Must be enabled'            => '必須啟用',
    'Must be disabled'           => '必須停用',
    'Can be enabled or disabled' => '可啟用或停用',

    // Filters: drafts
    'Element is a draft'          => '元素為草稿',
    'Must be a draft'             => '必須為草稿',
    'Must not be a draft'         => '不能為草稿',
    'Can be a draft or non-draft' => '可為草稿或非草稿',

    // Filters: provisional drafts
    'Element is a provisional draft'                => '元素為暫定草稿',
    'Must be a provisional draft'                   => '必須為暫定草稿',
    'Must not be a provisional draft'               => '不能為暫定草稿',
    'Can be a provisional draft or non-provisional' => '可為暫定或非暫定',

    // Filters: revisions
    'Element is a revision'             => '元素為修訂版本',
    'Must be a revision'                => '必須為修訂版本',
    'Must not be a revision'            => '不能為修訂版本',
    'Can be a revision or non-revision' => '可為修訂版本或非修訂版本',

    // Filters: duplication
    'Element is being duplicated'         => '元素正在被複製',
    'Must be duplicating the element'     => '必須正在複製該元素',
    'Must not be duplicating the element' => '不能正在複製該元素',

    // Filters: propagation
    'Element is being propagated'     => '元素正在傳播',
    'Element must be propagating'     => '元素必須正在傳播',
    'Element must not be propagating' => '元素不能正在傳播',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => '元素正在批次重新儲存',
    'Must be bulk-resaving the element'     => '必須正在批次重新儲存該元素',
    'Must not be bulk-resaving the element' => '不能正在批次重新儲存該元素',

    // Filters: common output
    'Unnamed filter'                => '未命名篩選器',
    'Must be TRUE to send message'  => '必須為 TRUE 才能傳送訊息',
    'Must be FALSE to send message' => '必須為 FALSE 才能傳送訊息',
    'No effect'                     => '無效果',

    // Message tab: type selector and queue
    'Message Type'                                                 => '訊息類型',
    'What type of message will be sent?'                           => '將傳送哪種類型的訊息?',
    'Send Message via Queue'                                       => '透過佇列傳送訊息',
    'Should the message be sent via the [jobs queue]({queueUrl})?' => '是否透過[工作佇列]({queueUrl})傳送訊息?',

    // Email message
    'Email Subject'              => '郵件主旨',
    'Email Body'                 => '郵件內文',
    "User's Email Address Field" => '使用者的電子郵件地址欄位',

    // SMS message
    'SMS Message Body'          => '簡訊訊息內文',
    "User's Phone Number Field" => '使用者的電話號碼欄位',

    // Announcement message
    'Announcement Title'   => '公告標題',
    'Announcement Message' => '公告內容',

    // Flash message
    'Flash Message Type'                         => 'Flash 訊息類型',
    'Flash Message Title'                        => 'Flash 訊息標題',
    'Flash Message Details'                      => 'Flash 訊息詳細資料',
    'Which type of flash message should appear?' => '應顯示哪種類型的 Flash 訊息?',

    // Trix toolbar (rich-text editing)
    'Rich Text'     => '格式化文字',
    'Bold'          => '粗體',
    'Italic'        => '斜體',
    'Underline'     => '底線',
    'Strikethrough' => '刪除線',
    'Bullets'       => '項目符號',
    'Numbers'       => '編號清單',
    'Heading'       => '標題',
    'Code'          => '程式碼',
    'Undo'          => '復原',
    'Redo'          => '取消復原',

    // Email body instructions (HTML)
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => '寄出郵件的內文。您可以使用<a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">特殊變數</a>,甚至可以<a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">略過收件者</a>。',

    // Recipients tab
    'Recipients Type'                             => '收件者類型',
    'Who will receive this message?'              => '誰會收到此訊息?',
    'Add a message recipient'                     => '新增收件者',
    'Select User(s)'                              => '選取使用者',
    'Which users will receive the message?'       => '哪些使用者會收到訊息?',
    'Which user groups will receive the message?' => '哪些使用者群組會收到訊息?',
    'Restricted to Admins Only?'                  => '僅限管理員嗎?',
    'Ungrouped Users'                             => '未分組的使用者',
    'Twig Snippet to Determine Recipients'        => '用於決定收件者的 Twig 程式片段',

    // Settings: Twilio
    'Twilio Account SID'                             => 'Twilio Account SID',
    'Twilio Auth Token'                              => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)'   => 'Twilio 電話號碼(傳送每則簡訊訊息)',
    'This is being set in the config file. [{file}]' => '在設定檔中設定。[{file}]',

    // Settings: Logging
    'Logging'                                                                                                                                         => '記錄',
    'Enable Logging'                                                                                                                                  => '啟用記錄',
    'When disabled, Notifier will not write anything to the notification log.'                                                                        => '停用時,Notifier 不會向通知記錄寫入任何內容。',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier 持續維護已傳送訊息的記錄。通常不必,但您可以限制資料庫中記錄的記錄事件數量。',
    'Number of log events to retain'                                                                                                                  => '要保留的記錄事件數量',
    'At most, keep this many log events. Leave blank for no limit.'                                                                                   => '最多保留這麼多記錄事件。留空表示不限制。',
    'Number of days to retain log events'                                                                                                             => '保留記錄事件的天數',
    'At most, keep log events for this many days. Leave blank for no limit.'                                                                          => '最多保留記錄事件這麼多天。留空表示不限制。',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.' => '正在向 {recipient} 傳送 {messageType}。',
    'Log events deleted.'                   => '已刪除記錄事件。',
    'notification'                          => '通知',

    // Errors
    'Invalid email message mode.'                                    => '無效的電子郵件訊息模式。',
    'Dynamic recipients snippet did not call setRecipients.'         => '動態收件者程式片段未呼叫 setRecipients。',
    'setRecipients was called with an empty value.'                  => 'setRecipients 以空值被呼叫。',
    'Unrecognized recipient "{value}".'                              => '無法辨識的收件者「{value}」。',
    'Unrecognized recipient of type "{type}".'                       => '無法辨識的「{type}」類型收件者。',
    'Recipient "{name}" has no email address.'                       => '收件者「{name}」沒有電子郵件地址。',
    'Recipient "{name}" has no phone number.'                        => '收件者「{name}」沒有電話號碼。',
    'You do not have permission to use the Dynamic Recipients type.' => '您沒有使用動態收件者類型的權限。',

];
