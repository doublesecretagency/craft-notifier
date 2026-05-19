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
    'View notifications'              => '通知を表示',
    'Save notifications'              => '通知を保存',
    'Use the Dynamic Recipients type' => '動的受信者タイプを使用',
    'Test notifications'              => '通知をテスト',
    'Delete notifications'            => '通知を削除',
    'View notification log'           => '通知ログを表示',
    'Delete notification log'         => '通知ログを削除',

    // Notification editor: tabs
    'Meta'       => 'メタ',
    'Event'      => 'イベント',
    'Message'    => 'メッセージ',
    'Recipients' => '受信者',

    // Event tab: type selector
    'Event Type'                                           => 'イベントタイプ',
    'What type of event will activate the notification?'   => 'どのタイプのイベントが通知を発動しますか?',
    'Which specific event will activate the notification?' => 'どの具体的なイベントが通知を発動しますか?',

    // Event tab: event types
    'Assets Event'                   => 'アセットイベント',
    'Commerce Orders Event'          => 'Commerce 注文イベント',
    'Commerce Products Event'        => 'Commerce 製品イベント',
    'Digital Products Event'         => 'Digital Products イベント',
    'Digital Product Licenses Event' => 'Digital Products ライセンスイベント',
    'Solspace Calendar Event'        => 'Solspace Calendar イベント',
    'Entries Event'                  => 'エントリイベント',
    'Users Event'                    => 'ユーザーイベント',
    'Ungrouped Users'                => 'グループ外のユーザー',

    // Field and element conditions
    'Field Conditions'             => 'フィールド条件',
    'Send the message only when the saved element matches the following conditions.' => '保存された要素が次の条件に一致する場合にのみメッセージを送信します。',
    'has changed'                  => 'が変更された',
    '#{elementType} Event Filters' => '#{elementType} のイベントフィルタ',
    'No filters match this event.' => 'このイベントに一致するフィルタはありません。',
    'Determine whether each message should be sent based on specified conditions.' => '指定した条件に基づいて、各メッセージを送信するかどうかを決定します。',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => '要素が初めて保存されます',
    'Must be a new entry'                       => '新しいエントリでなければならない',
    'Must be an existing entry'                 => '既存のエントリでなければならない',
    'Can be existing or new'                    => '既存または新規のいずれでも可',

    // Filters: new elements
    'Element is new'         => '要素は新規',
    'New elements only'      => '新規の要素のみ',
    'Existing elements only' => '既存の要素のみ',

    // Filters: enabled state
    'Element is enabled'         => '要素は有効',
    'Must be enabled'            => '有効でなければならない',
    'Must be disabled'           => '無効でなければならない',
    'Can be enabled or disabled' => '有効または無効のいずれでも可',

    // Filters: drafts
    'Element is a draft'          => '要素は下書き',
    'Must be a draft'             => '下書きでなければならない',
    'Must not be a draft'         => '下書きであってはならない',
    'Can be a draft or non-draft' => '下書きでも下書きでなくても可',

    // Filters: provisional drafts
    'Element is a provisional draft'                => '要素は仮の下書き',
    'Must be a provisional draft'                   => '仮の下書きでなければならない',
    'Must not be a provisional draft'               => '仮の下書きであってはならない',
    'Can be a provisional draft or non-provisional' => '仮の下書きでもそうでなくても可',

    // Filters: revisions
    'Element is a revision'             => '要素はリビジョン',
    'Must be a revision'                => 'リビジョンでなければならない',
    'Must not be a revision'            => 'リビジョンであってはならない',
    'Can be a revision or non-revision' => 'リビジョンでもそうでなくても可',

    // Filters: duplication
    'Element is being duplicated'         => '要素が複製されています',
    'Must be duplicating the element'     => '要素を複製している必要がある',
    'Must not be duplicating the element' => '要素を複製していてはならない',

    // Filters: propagation
    'Element is being propagated'     => '要素が伝播されています',
    'Element must be propagating'     => '要素は伝播中でなければならない',
    'Element must not be propagating' => '要素は伝播中であってはならない',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => '要素が一括再保存されています',
    'Must be bulk-resaving the element'     => '要素を一括再保存している必要がある',
    'Must not be bulk-resaving the element' => '要素を一括再保存していてはならない',

    // Filters: common output
    'Unnamed filter'                => '名前なしのフィルタ',
    'Must be TRUE to send message'  => 'メッセージ送信のため TRUE でなければならない',
    'Must be FALSE to send message' => 'メッセージ送信のため FALSE でなければならない',
    'No effect'                     => '効果なし',

    // Message tab: type selector and queue
    'Message Type'                       => 'メッセージタイプ',
    'What type of message will be sent?' => 'どのタイプのメッセージが送信されますか?',
    'Send Message via Queue'             => 'キュー経由でメッセージを送信',
    'Should the message be sent via the [jobs queue]({queueUrl})?' => 'メッセージは [ジョブキュー]({queueUrl}) 経由で送信しますか?',
    'Send immediately' => '即時送信',
    'Add to queue' => 'キューに追加',

    // Message tab: Email fields
    "User's Email Address Field" => 'ユーザーのメールアドレスフィールド',
    'Email Subject'              => 'メールの件名',
    'Email Body'                 => 'メール本文',

    // Message tab: SMS fields
    "User's Phone Number Field" => 'ユーザーの電話番号フィールド',
    'SMS Message Body'          => 'SMS メッセージ本文',

    // Message tab: Announcement fields
    'Announcement Title'   => 'アナウンスのタイトル',
    'Announcement Message' => 'アナウンスのメッセージ',

    // Message tab: Flash fields
    'Flash Message Type'                         => 'フラッシュメッセージのタイプ',
    'Flash Message Title'                        => 'フラッシュメッセージのタイトル',
    'Flash Message Details'                      => 'フラッシュメッセージの詳細',
    'Which type of flash message should appear?' => 'どのタイプのフラッシュメッセージを表示しますか?',

    // Message tab: Pushover fields
    "Field containing each user's Pushover key" => 'ユーザーの Pushover キーフィールド',
    'The Pushover application token is configured in [Settings → Pushover](url).' => 'Pushover アプリケーショントークンは [設定 → Pushover](url) で設定します。',

    // Message tab: ntfy fields
    'Priority'           => '優先度',
    'Tags'               => 'タグ',
    'Click URL'          => 'クリック URL',
    'Render as Markdown' => 'Markdown としてレンダリング',

    // Message tab: Slack fields
    'Slack Message Body' => 'Slack メッセージ本文',

    // Message tab: Bluesky fields
    'Post Body' => '投稿本文',
    'Generate Link Preview' => 'リンクプレビューを生成',
    "When the post body contains a URL, automatically generate a preview card with the linked page's image, title, and description." => '投稿本文に URL が含まれている場合、リンク先ページのタイトル、説明、画像を含むプレビューカードを添付します。',
    'No card' => 'カードなし',
    'Generate preview card' => 'プレビューカードを生成',

    // Message tab: Title / Body / Trix toolbar
    'Title'         => 'タイトル',
    'Body'          => '本文',
    'Rich Text'     => 'リッチテキスト',
    'Bold'          => '太字',
    'Italic'        => '斜体',
    'Underline'     => '下線',
    'Strikethrough' => '取り消し線',
    'Bullets'       => '箇条書き',
    'Numbers'       => '番号付き',
    'Heading'       => '見出し',
    'Code'          => 'コード',
    'Undo'          => '元に戻す',
    'Redo'          => 'やり直し',
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => '送信メールの本文。<a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">特殊変数</a>を使用したり、<a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">受信者をスキップ</a>することもできます。',

    // Recipients tab: common
    'Recipients Type'                             => '受信者タイプ',
    'Who will receive this message?'              => '誰がこのメッセージを受け取りますか?',
    'Add a message recipient'                     => '受信者を追加',
    'Select User(s)'                              => 'ユーザーを選択',
    'Which users will receive the message?'       => 'どのユーザーがメッセージを受け取りますか?',
    'Which user groups will receive the message?' => 'どのユーザーグループがメッセージを受け取りますか?',
    'Twig Snippet to Determine Recipients'        => '受信者を決定する Twig スニペット',

    // Recipients tab: per-provider pickers
    'Select Slack channel(s)'                           => 'Slack チャンネルを選択',
    'Which Slack channels should receive this message?' => 'どの Slack チャンネルがこのメッセージを受け取りますか?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Slack チャンネルが設定されていません。[設定 → Slack]({url}) で追加してください。',
    'Select ntfy topic(s)'                              => 'ntfy トピックを選択',
    'Which ntfy topics should receive this message?'    => 'どの ntfy トピックがこのメッセージを受け取りますか?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'ntfy トピックが設定されていません。[設定 → ntfy]({url}) で追加してください。',
    'Select Bluesky account(s)'                         => 'Bluesky アカウントを選択',
    'Which Bluesky accounts should post this message?'  => 'どの Bluesky アカウントがこのメッセージを投稿しますか?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Bluesky アカウントが設定されていません。[設定 → Bluesky]({url}) で追加してください。',

    // Settings: page chrome
    'Notifier Settings' => 'Notifier 設定',
    'General'           => '一般',
    'Twilio'            => 'Twilio',
    'Pushover'          => 'Pushover',
    'Slack'             => 'Slack',
    'Bluesky'           => 'Bluesky',
    'ntfy'              => 'ntfy',

    // Settings: Logging
    'Logging'                             => 'ロギング',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier は送信されたメッセージのログを継続的に保持します。通常は不要ですが、データベースに記録するログイベントの数を制限できます。',
    'Enable Logging'                      => 'ロギングを有効化',
    'When disabled, Notifier will not write anything to the notification log.' => '無効にすると、Notifier は通知ログに何も書き込みません。',
    'Number of days to retain log events' => 'ログイベントを保持する日数',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'ログイベントを最大でこの日数だけ保持します。制限なしの場合は空のままにします。',
    'Number of log events to retain'      => '保持するログイベント数',
    'At most, keep this many log events. Leave blank for no limit.' => '最大でこの数のログイベントを保持します。制限なしの場合は空のままにします。',

    // Settings: Twilio
    'Twilio API Credentials'                       => 'Twilio API 認証情報',
    'If using the Twilio API to send SMS messages, the following credentials are required.' => 'SMS の送信に Twilio API を使用する場合、以下の認証情報が必要です。',
    'Twilio Account SID'                           => 'Twilio アカウント SID',
    'Twilio Auth Token'                            => 'Twilio 認証トークン',
    'Twilio phone number (sends each SMS message)' => 'Twilio 電話番号 (各 SMS の送信元)',
    'SMS Testing'                                  => 'SMS テスト',
    'Optional. When set, every SMS dispatched will be sent to this number instead of the resolved recipient.' => '任意。設定されている場合、送信されるすべての SMS は解決された受信者ではなくこの番号に送られます。',
    'Test phone number'                            => 'テスト用電話番号',

    // Settings: Pushover
    "[Pushover](https://pushover.net) sends push notifications to a registered user's devices. Each Craft user needs a custom field on their profile storing their Pushover user key; you select which field on each Notification's Message tab. For full setup instructions, see the [Pushover getting-started docs](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover)." => '[Pushover](https://pushover.net) は登録ユーザーのデバイスにプッシュ通知を送信します。各 Craft ユーザーは自分のプロフィールに Pushover ユーザーキーを保存するカスタムフィールドが必要です。各通知のメッセージタブでどのフィールドを使うか選択します。詳細なセットアップ手順は [Pushover の入門ドキュメント](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover)を参照してください。',
    'Application API Token'                                      => 'アプリケーション API トークン',
    'The 30-character app token from your Pushover application.' => 'Pushover アプリケーションの 30 文字のアプリトークン。',

    // Settings: ntfy
    'ntfy.sh is a free HTTP-based push notification service. Subscribers receive messages on the ntfy app, web, or any compatible client by joining a topic.' => 'ntfy.sh は無料の HTTP ベースのプッシュ通知サービスです。購読者はトピックに参加することで、ntfy アプリ、ウェブ、または互換クライアントでメッセージを受け取ります。',
    'Server URL'   => 'サーバー URL',
    'Defaults to https://ntfy.sh. Point at a self-hosted ntfy instance if applicable.' => 'デフォルトは https://ntfy.sh です。該当する場合は自前ホストの ntfy インスタンスを指定してください。',
    'Access token' => 'アクセストークン',
    'Optional. Required for protected topics or self-hosted instances with auth.' => '任意。保護されたトピックや認証付き自前ホストインスタンスでは必要です。',
    'ntfy Topics'  => 'ntfy トピック',
    'Named list of ntfy topics. Each topic becomes selectable on the notification edit screen.' => 'ntfy トピックの名前付きリスト。各トピックは通知編集画面で選択できるようになります。',
    'Topics'       => 'トピック',
    'Add one row per topic name. Use the **Test** button to send a quick test message to the topic.' => 'トピック名ごとに 1 行追加します。**Test** ボタンを使ってトピックに簡単なテストメッセージを送信できます。',
    'Topic'        => 'トピック',
    'Add a topic'  => 'トピックを追加',
    'Save first to persist a row, then click its **Test** button to fire a sanity check against ntfy.' => 'まず保存して行を永続化してから、その **Test** ボタンをクリックして ntfy に対する簡易チェックを実行します。',

    // Settings: Slack
    'Slack Channels' => 'Slack チャンネル',
    'Channels'       => 'チャンネル',
    'Each Slack channel needs its own Incoming Webhook URL. Use the **Test** button to fire a quick sanity check after saving.' => '各 Slack チャンネルには独自の Incoming Webhook URL が必要です。保存後、**Test** ボタンで簡単な動作確認を行えます。',
    'Webhook URL'    => 'Webhook URL',
    'Add a channel'  => 'チャンネルを追加',
    'Save first to persist a row, then click its **Test** button to fire a sanity check against Slack.' => 'まず保存して行を永続化してから、その **Test** ボタンをクリックして Slack に対する簡易チェックを実行します。',

    // Settings: Bluesky
    "[Bluesky](https://bsky.app) posts publish to the configured account's feed via the ATProto API. App passwords are generated at [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). An app password is a secret, so store it in a `.env` variable and reference that variable (e.g. `\$BLUESKY_APP_PASSWORD`) rather than pasting the password directly." => '[Bluesky](https://bsky.app) の投稿は ATProto API を介して設定されたアカウントのフィードに公開されます。アプリパスワードは [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords) で生成されます。アプリパスワードは機密情報であるため、パスワードを直接貼り付けるのではなく、`.env` 変数に保存し、その変数(例: `$BLUESKY_APP_PASSWORD`)を参照してください。',
    'PDS URL'          => 'PDS URL',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'デフォルトは https://bsky.social です。インストールがフェデレートしている場合はカスタム PDS を指定してください。',
    'Bluesky Accounts' => 'Bluesky アカウント',
    'Named list of Bluesky accounts. Each account becomes selectable on the notification edit screen.' => 'Bluesky アカウントの名前付きリスト。各アカウントは通知編集画面で選択できるようになります。',
    'Accounts'         => 'アカウント',
    'Add one row per Bluesky account. Use **Test** to verify the credentials authenticate.' => 'Bluesky アカウントごとに 1 行追加します。**Test** で資格情報が認証されるか確認できます。',
    'Label'            => 'ラベル',
    'Handle'           => 'ハンドル',
    'App password'     => 'アプリパスワード',
    'Add an account'   => 'アカウントを追加',
    'Save first to persist a row, then click its **Test** button to verify the credentials authenticate.' => 'まず保存して行を永続化してから、その **Test** ボタンをクリックして資格情報が認証されるか確認します。',

    // Test notification (UI)
    'Send a test message'           => 'テストメッセージを送信',
    'Are you certain you want to send a test notification?\\n\\nThe configured message will be sent to the configured recipient(s).' => 'テスト通知を送信してもよろしいですか?\\n\\n設定されたメッセージが設定された受信者に送信されます。',
    'Test'                          => 'テスト',
    'Test notification dispatched.' => 'テスト通知を送信しました。',
    'No messages were dispatched. Check the recipient configuration.' => 'メッセージは送信されませんでした。受信者の設定を確認してください。',

    // Settings: save / test action responses
    "Couldn't save settings."                 => '設定を保存できませんでした。',
    'Settings saved.'                         => '設定を保存しました。',
    'Topic is empty.'                         => 'トピックが空です。',
    'Server URL is not configured.'           => 'サーバー URL が設定されていません。',
    'Test message from Notifier.'             => 'Notifier からのテストメッセージです。',
    'HTTP {status}'                           => 'HTTP {status}',
    'Test message sent successfully.'         => 'テストメッセージを正常に送信しました。',
    'HTTP {status}: {body}'                   => 'HTTP {status}: {body}',
    'Handle and app password are required.'   => 'ハンドルとアプリパスワードは必須です。',
    'Authentication failed.'                  => '認証に失敗しました。',
    'Successfully authenticated. No messages were posted.' => '認証に成功しました。メッセージは投稿されていません。',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.'          => '{recipient} に {messageType} を送信中。',
    'Adding message to queue.'                       => 'メッセージをキューに追加中。',
    'Sending message immediately (bypassing queue).' => 'メッセージを即時送信中(キューをバイパス)。',
    'Log events deleted.'                            => 'ログイベントを削除しました。',
    'notification'                                   => '通知',

    // Outbound: Email log messages
    'Unable to send email, no recipient specified.'     => 'メールを送信できません。受信者が指定されていません。',
    'Unable to send email, the message body was empty.' => 'メールを送信できません。メッセージ本文が空でした。',
    "Unable to send the email using Craft's native email handling." => 'Craft のネイティブメール処理でメールを送信できません。',
    'Check your general email settings within Craft.'   => 'Craft の一般的なメール設定を確認してください。',
    'Successfully sent email message!'                  => 'メールを正常に送信しました!',

    // Outbound: SMS log messages
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[Twilio の認証情報が無効です。]({url}) {missing} がありません。',
    'Unable to send SMS, no Twilio phone number exists.'      => 'SMS を送信できません。Twilio の電話番号がありません。',
    'Unable to send SMS, no recipient phone number exists.'   => 'SMS を送信できません。受信者の電話番号がありません。',
    'Unable to send SMS, recipient phone number is invalid.'  => 'SMS を送信できません。受信者の電話番号が無効です。',
    'Successfully sent SMS message!'                          => 'SMS を正常に送信しました!',

    // Outbound: Announcement log messages
    'Unable to post announcement, no recipient userId specified.' => 'アナウンスを投稿できません。受信者の userId が指定されていません。',
    'Successfully posted announcement!' => 'アナウンスを正常に投稿しました!',

    // Outbound: Flash log messages
    'Unable to send the flash message, invalid flash type.' => 'フラッシュメッセージを送信できません。フラッシュタイプが無効です。',
    'Successfully sent flash message!'                      => 'フラッシュメッセージを正常に送信しました!',

    // Outbound: Pushover log messages
    '[Invalid Pushover credentials.]({url}) Missing app token.'  => '[Pushover の認証情報が無効です。]({url}) アプリトークンがありません。',
    'Unable to send Pushover message, no user key on recipient.' => 'Pushover メッセージを送信できません。受信者にユーザーキーがありません。',
    'Pushover POST failed: {reason}'                             => 'Pushover POST が失敗しました: {reason}',
    'Successfully sent Pushover message!'                        => 'Pushover メッセージを正常に送信しました!',

    // Outbound: ntfy log messages
    'Unable to send ntfy message, no server URL configured.' => 'ntfy メッセージを送信できません。サーバー URL が設定されていません。',
    'Unable to send ntfy message, no topic specified.'       => 'ntfy メッセージを送信できません。トピックが指定されていません。',
    'ntfy POST failed with HTTP {status}: {reason}'          => 'ntfy POST が HTTP {status} で失敗しました: {reason}',
    'ntfy POST failed: {reason}'                             => 'ntfy POST が失敗しました: {reason}',
    'Successfully sent ntfy message to topic "{topic}".'     => 'トピック「{topic}」に ntfy メッセージを正常に送信しました。',

    // Outbound: Slack log messages
    'Unable to send Slack message, no webhook URL.' => 'Slack メッセージを送信できません。Webhook URL がありません。',
    'Unable to send Slack message, webhook URL is not valid.' => 'Slack メッセージを送信できません。Webhook URL が無効です。',
    'Unable to send Slack message, body is empty.'  => 'Slack メッセージを送信できません。本文が空です。',
    'Slack POST failed (HTTP {status}): {reason}'   => 'Slack POST が失敗しました (HTTP {status}): {reason}',
    'Slack POST failed: {reason}'                   => 'Slack POST が失敗しました: {reason}',
    'Successfully sent Slack message to "{label}".' => '"{label}" に Slack メッセージを正常に送信しました。',

    // Outbound: Bluesky log messages
    'Unable to send Bluesky post, recipient is missing credentials.' => 'Bluesky 投稿を送信できません。受信者の認証情報がありません。',
    'Body exceeded {max} characters, truncated.'          => '本文が {max} 文字を超えたため切り詰められました。',
    'Successfully posted to Bluesky as "{label}".'        => '"{label}" として Bluesky に正常に投稿しました。',
    'Bluesky auth failed for {handle}: {reason}'          => '{handle} の Bluesky 認証に失敗しました: {reason}',
    'Bluesky auth failed: {reason}'                       => 'Bluesky 認証に失敗しました: {reason}',
    'Bluesky post failed: {reason}'                       => 'Bluesky 投稿に失敗しました: {reason}',
    'Bluesky link preview skipped: {reason}'              => 'Bluesky のリンクプレビューをスキップしました: {reason}',

    // Recipient-strategy warnings
    'Recipient "{name}" has no email address.'       => '受信者「{name}」にはメールアドレスがありません。',
    'Recipient "{name}" has no phone number.'        => '受信者「{name}」には電話番号がありません。',
    'Recipient "{name}" has no associated User; cannot send announcement.' => '受信者「{name}」に関連付けられたユーザーがないため、アナウンスを送信できません。',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => '受信者「{name}」はコントロールパネルにアクセスできないため、アナウンスを送信できません。',
    'Pushover user-key field is not configured on this notification.' => 'この通知に Pushover ユーザーキーフィールドが設定されていません。',
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => '受信者「{name}」に関連付けられたユーザーがないため、Pushover メッセージを送信できません。',
    '[SKIPPED] User "{name}" has no Pushover key.'   => '[スキップ] ユーザー「{name}」には Pushover キーがありません。',
    'Recipient "{name}" has no ntfy topic.'          => '受信者「{name}」には ntfy トピックがありません。',
    'Recipient "{name}" has no Slack webhook URL.'   => '受信者「{name}」には Slack Webhook URL がありません。',
    'Recipient "{name}" has no Bluesky credentials.' => '受信者「{name}」には Bluesky の認証情報がありません。',

    // Errors / exceptions
    'Invalid element event: {class}'                         => '無効な要素イベント: {class}',
    'Invalid notification ID: {id}'                          => '無効な通知 ID: {id}',
    'Invalid email message mode.'                            => '無効なメールメッセージモードです。',
    'You do not have permission to use the Dynamic Recipients type.' => '動的受信者タイプを使用する権限がありません。',
    'Dynamic recipients snippet did not call setRecipients.' => '動的受信者スニペットは setRecipients を呼び出しませんでした。',
    'setRecipients was called with an empty value.'          => 'setRecipients が空の値で呼び出されました。',
    'Unrecognized recipient of type "{type}".'               => 'タイプ「{type}」の受信者が認識できません。',
    'Unrecognized recipient "{value}".'                      => '受信者「{value}」が認識できません。',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => '設定された {kind} はプラグイン設定に存在しません (uid: {uid})。',
    'Invalid settings section: {section}'                    => '無効な設定セクション: {section}',
    'User not authorized to save this notification.'         => 'この通知を保存する権限がユーザーにありません。',
    'User not authorized to view this notification.'         => 'この通知を表示する権限がユーザーにありません。',
    'User not authorized to delete this notification.'       => 'この通知を削除する権限がユーザーにありません。',
    'Notification not found'                                 => '通知が見つかりません',

    // Misc config-file note
    'This is being set in the config file. [{file}]' => 'これは設定ファイルで設定されています。[{file}]',

    // Slack, ntfy, and Bluesky message types
    "Add the Bluesky accounts you'd like to post from. Each account becomes available as a recipient on the **Recipients** tab when configuring a notification." => '投稿元にしたい Bluesky アカウントを追加します。各アカウントは通知の設定時に **受信者** タブで受信者として利用できるようになります。',
    "Click any row's **Test** button to confirm the account authenticates." => '任意の行の **Test** ボタンをクリックして、アカウントが認証されることを確認します。',
    "Add an [Incoming Webhook](https://api.slack.com/messaging/webhooks) for each Slack channel you'd like to post into. Each webhook becomes available as a recipient on the **Recipients** tab when configuring a notification. A webhook URL is a secret, so store it in a `.env` variable and reference that variable (e.g. `\$SLACK_WEBHOOK_URL`) rather than pasting the URL directly." => '投稿先にしたい Slack チャンネルごとに [Incoming Webhook](https://api.slack.com/messaging/webhooks) を追加します。各 Webhook は通知の設定時に **受信者** タブで受信者として利用できるようになります。Webhook URL は機密情報であるため、URL を直接貼り付けるのではなく、`.env` 変数に保存し、その変数(例: `$SLACK_WEBHOOK_URL`)を参照してください。',
    "Click any row's **Test** button to send a quick test message to that channel." => '任意の行の **Test** ボタンをクリックして、そのチャンネルに簡単なテストメッセージを送信します。',
    "Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`." => '任意。該当する場合は自前ホストの ntfy インスタンスを指定します。デフォルトは `https://ntfy.sh` です。',
    'Optional, required for protected topics or self-hosted instances with auth.' => '任意。保護されたトピックや認証付きの自前ホストインスタンスでは必要です。',
    "Add the ntfy topics you'd like to send messages to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification." => 'メッセージの送信先にしたい ntfy トピックを追加します。各トピックは通知の設定時に **受信者** タブで受信者として利用できるようになります。',
    "Click any row's **Test** button to send a quick test message to that topic." => '任意の行の **Test** ボタンをクリックして、そのトピックに簡単なテストメッセージを送信します。',
    'Enable Markdown' => 'Markdown を有効化',
    'Link URL' => 'リンク URL',
    'Not a valid Webhook URL. Must start with https://hooks.slack.com/services/' => '有効な Webhook URL ではありません。https://hooks.slack.com/services/ で始まる必要があります。',

    // Manual triggers
    'Send Notification'                                            => '通知を送信',
    'Send manual notifications'                                    => '手動通知を送信',
    'Are you sure you want to send this notification?'             => 'この通知を送信してもよろしいですか？',
    'This notification cannot be triggered manually.'              => 'この通知は手動でトリガーできません。',
    'This notification no longer applies to the selected element.' => 'この通知は選択された要素には適用されなくなりました。',
    'Notification sent.'                                           => '通知を送信しました。',
    'Element not found'                                            => '要素が見つかりません',
    'Trigger Label'                                                => 'トリガーのラベル',
    'An element action label (helps to differentiate multiple triggers).'        => '要素アクションのラベル（複数のトリガーを区別しやすくします）。',

    // Event tab: date trigger
    'On'                                                          => '当日',
    'days before'                                                 => '日前',
    'days after'                                                  => '日後',
    'Relevant Date'                                               => '関連する日付',
    'Send the notification relative to a chosen date.'            => '選択した日付を基準に通知を送信します。',
    "Fires when an entry's Post Date passes and it becomes Live." => 'エントリの投稿日に達し、ライブになったときに実行されます。',

    // Scheduled sending
    'Scheduled Sending' => 'スケジュール送信',
    'Shared secret for authenticating scheduled-run web requests. Required only when the schedule is triggered via the web endpoint.' => 'スケジュール実行のWebリクエストを認証するための共有シークレット。Webエンドポイント経由でスケジュールを起動する場合のみ必要です。',
    'Scheduled-Run Token' => 'スケジュール実行トークン',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => '各リクエストとともに X-Notifier-Token ヘッダーまたは token ボディパラメータとして送信されます。',
];
