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
    'All notifications'      => 'すべての通知',
    'Notification Log'       => '通知ログ',
    'Logs'                   => 'ログ',
    'View Notifications'     => '通知を表示',
    'Add a New Notification' => '新しい通知を追加',

    // Permissions
    'View notifications'              => '通知の表示',
    'Save notifications'              => '通知の保存',
    'Use the Dynamic Recipients type' => '動的受信者タイプの使用',
    'Test notifications'              => '通知をテスト',
    'Delete notifications'            => '通知の削除',
    'View notification log'           => '通知ログの表示',
    'Delete notification log'         => '通知ログの削除',

    // Notification editor: tabs
    'Meta'       => 'メタ',
    'Event'      => 'イベント',
    'Message'    => 'メッセージ',
    'Recipients' => '受信者',

    // Event tab
    'Event Type'                                           => 'イベントタイプ',
    'What type of event will activate the notification?'   => 'どの種類のイベントで通知を起動しますか?',
    'Which specific event will activate the notification?' => 'どの具体的なイベントで通知を起動しますか?',
    'Assets Event'                                         => 'アセットイベント',
    'Commerce Orders Event'                                => 'Commerce 注文イベント',
    'Entries Event'                                        => 'エントリイベント',
    'Users Event'                                          => 'ユーザーイベント',

    // Field and element conditions
    'Field Conditions'                                                               => 'フィールド条件',
    'Send the message only when the saved element matches the following conditions.' => '保存された要素が次の条件を満たした場合のみメッセージを送信します。',
    'has changed'                                                                    => '変更されました',
    '#{elementType} Event Filters'                                                   => '#{elementType} イベントフィルター',
    'No filters match this event.'                                                   => 'このイベントに一致するフィルターはありません。',
    'Determine whether each message should be sent based on specified conditions.'   => '指定した条件に基づいて、各メッセージを送信するかどうかを決定します。',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => '要素が初めて保存されています',
    'Must be a new entry'                       => '新しいエントリである必要があります',
    'Must be an existing entry'                 => '既存のエントリである必要があります',
    'Can be existing or new'                    => '既存または新規のいずれでも構いません',

    // Filters: new elements
    'Element is new'         => '要素は新規です',
    'New elements only'      => '新規要素のみ',
    'Existing elements only' => '既存要素のみ',

    // Filters: enabled state
    'Element is enabled'         => '要素は有効です',
    'Must be enabled'            => '有効である必要があります',
    'Must be disabled'           => '無効である必要があります',
    'Can be enabled or disabled' => '有効または無効のいずれでも構いません',

    // Filters: drafts
    'Element is a draft'          => '要素は下書きです',
    'Must be a draft'             => '下書きである必要があります',
    'Must not be a draft'         => '下書きであってはなりません',
    'Can be a draft or non-draft' => '下書きでもそうでなくても構いません',

    // Filters: provisional drafts
    'Element is a provisional draft'                => '要素は暫定下書きです',
    'Must be a provisional draft'                   => '暫定下書きである必要があります',
    'Must not be a provisional draft'               => '暫定下書きであってはなりません',
    'Can be a provisional draft or non-provisional' => '暫定下書きでもそうでなくても構いません',

    // Filters: revisions
    'Element is a revision'             => '要素はリビジョンです',
    'Must be a revision'                => 'リビジョンである必要があります',
    'Must not be a revision'            => 'リビジョンであってはなりません',
    'Can be a revision or non-revision' => 'リビジョンでもそうでなくても構いません',

    // Filters: duplication
    'Element is being duplicated'         => '要素は複製されています',
    'Must be duplicating the element'     => '要素を複製している必要があります',
    'Must not be duplicating the element' => '要素を複製していてはなりません',

    // Filters: propagation
    'Element is being propagated'     => '要素は伝播されています',
    'Element must be propagating'     => '要素は伝播中である必要があります',
    'Element must not be propagating' => '要素は伝播中であってはなりません',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => '要素は一括再保存されています',
    'Must be bulk-resaving the element'     => '要素を一括再保存している必要があります',
    'Must not be bulk-resaving the element' => '要素を一括再保存していてはなりません',

    // Filters: common output
    'Unnamed filter'                => '名前のないフィルター',
    'Must be TRUE to send message'  => 'メッセージを送信するには TRUE である必要があります',
    'Must be FALSE to send message' => 'メッセージを送信するには FALSE である必要があります',
    'No effect'                     => '効果なし',

    // Message tab: type selector and queue
    'Message Type'                                                 => 'メッセージタイプ',
    'What type of message will be sent?'                           => 'どの種類のメッセージを送信しますか?',
    'Send Message via Queue'                                       => 'キューでメッセージを送信',
    'Should the message be sent via the [jobs queue]({queueUrl})?' => 'メッセージを [ジョブキュー]({queueUrl}) で送信しますか?',

    // Email message
    'Email Subject'              => 'メールの件名',
    'Email Body'                 => 'メールの本文',
    "User's Email Address Field" => 'ユーザーのメールアドレスフィールド',

    // SMS message
    'SMS Message Body'          => 'SMS メッセージの本文',
    "User's Phone Number Field" => 'ユーザーの電話番号フィールド',

    // Announcement message
    'Announcement Title'   => 'アナウンスのタイトル',
    'Announcement Message' => 'アナウンスのメッセージ',

    // Flash message
    'Flash Message Type'                         => 'フラッシュメッセージのタイプ',
    'Flash Message Title'                        => 'フラッシュメッセージのタイトル',
    'Flash Message Details'                      => 'フラッシュメッセージの詳細',
    'Which type of flash message should appear?' => 'どの種類のフラッシュメッセージを表示しますか?',

    // Trix toolbar (rich-text editing)
    'Rich Text'     => 'リッチテキスト',
    'Bold'          => '太字',
    'Italic'        => '斜体',
    'Underline'     => '下線',
    'Strikethrough' => '取り消し線',
    'Bullets'       => '箇条書き',
    'Numbers'       => '番号付きリスト',
    'Heading'       => '見出し',
    'Code'          => 'コード',
    'Undo'          => '元に戻す',
    'Redo'          => 'やり直し',

    // Email body instructions (HTML)
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => '送信メールの本文です。<a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">特殊変数</a>を使用したり、<a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">受信者をスキップ</a>することもできます。',

    // Recipients tab
    'Recipients Type'                             => '受信者タイプ',
    'Who will receive this message?'              => 'このメッセージを誰が受信しますか?',
    'Add a message recipient'                     => '受信者を追加',
    'Select User(s)'                              => 'ユーザーを選択',
    'Which users will receive the message?'       => 'どのユーザーがメッセージを受信しますか?',
    'Which user groups will receive the message?' => 'どのユーザーグループがメッセージを受信しますか?',
    'Restricted to Admins Only?'                  => '管理者のみに制限しますか?',
    'Ungrouped Users'                             => 'グループ未所属のユーザー',
    'Twig Snippet to Determine Recipients'        => '受信者を決定する Twig スニペット',

    // Settings: Twilio
    'Twilio Account SID'                             => 'Twilio Account SID',
    'Twilio Auth Token'                              => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)'   => 'Twilio の電話番号 (各 SMS メッセージを送信します)',
    'This is being set in the config file. [{file}]' => '設定ファイルで指定されています。[{file}]',

    // Settings: Logging
    'Logging'                                                                                                                                         => 'ロギング',
    'Enable Logging'                                                                                                                                  => 'ロギングを有効にする',
    'When disabled, Notifier will not write anything to the notification log.'                                                                        => '無効にすると、Notifier は通知ログに何も書き込みません。',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier は送信されたメッセージの継続的なログを保持します。通常は必要ありませんが、データベースに記録されるログイベントの数を制限することができます。',
    'Number of log events to retain'                                                                                                                  => '保持するログイベントの件数',
    'At most, keep this many log events. Leave blank for no limit.'                                                                                   => '保持するログイベントの最大数です。制限なしにする場合は空のままにしてください。',
    'Number of days to retain log events'                                                                                                             => 'ログイベントを保持する日数',
    'At most, keep log events for this many days. Leave blank for no limit.'                                                                          => 'ログイベントを保持する最大日数です。制限なしにする場合は空のままにしてください。',

    // Test notification
    'Send a test message'                                                                                                          => 'テストメッセージを送信',
    'Are you certain you want to send a test notification?\n\nThe configured message will be sent to the configured recipient(s).' => 'テスト通知を送信してもよろしいですか?\n\n設定されたメッセージが、設定された受信者に送信されます。',
    'Test'                                                                                                                         => 'テスト',
    'Test notification dispatched.'                                                                                                => 'テスト通知を送信しました。',
    'No messages were dispatched. Check the recipient configuration.'                                                              => 'メッセージは送信されませんでした。受信者の設定を確認してください。',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.' => '{messageType} を {recipient} に送信中です。',
    'Log events deleted.'                   => 'ログイベントを削除しました。',
    'notification'                          => '通知',

    // Errors
    'Invalid email message mode.'                                    => '無効なメールメッセージモードです。',
    'Dynamic recipients snippet did not call setRecipients.'         => '動的受信者のスニペットが setRecipients を呼び出しませんでした。',
    'setRecipients was called with an empty value.'                  => 'setRecipients が空の値で呼び出されました。',
    'Unrecognized recipient "{value}".'                              => '認識されない受信者「{value}」です。',
    'Unrecognized recipient of type "{type}".'                       => '認識されないタイプ「{type}」の受信者です。',
    'Recipient "{name}" has no email address.'                       => '受信者「{name}」にはメールアドレスがありません。',
    'Recipient "{name}" has no phone number.'                        => '受信者「{name}」には電話番号がありません。',
    'You do not have permission to use the Dynamic Recipients type.' => '動的受信者タイプを使用する権限がありません。',

];
