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
    'All notifications' => 'すべての通知',
    'Notification Log' => '通知ログ',
    'Logs' => 'ログ',
    'View Notifications' => '通知を表示',
    'Add a New Notification' => '新しい通知を追加',
    'notification' => '通知',

    // Permissions
    'View notifications' => '通知を表示',
    'Save notifications' => '通知を保存',
    'Use the Dynamic Recipients type' => '動的受信者タイプを使用',
    'Use the Dynamic Data type' => '動的データタイプを使用',
    'Test notifications' => '通知をテスト',
    'Send manual notifications' => '手動通知を送信',
    'Delete notifications' => '通知を削除',
    'View notification log' => '通知ログを表示',
    'Delete notification log' => '通知ログを削除',

    // ========================================================
    // NOTIFICATION EDITOR
    // ========================================================

    // Editor: tabs
    'Meta' => 'メタ',
    'Event' => 'イベント',
    'Message' => 'メッセージ',
    'Recipients' => '受信者',

    // Event tab: type selector
    'Event Type' => 'イベントタイプ',
    'What type of event will activate the notification?' => 'どのタイプのイベントが通知を発動しますか?',
    'Which specific event will activate the notification?' => 'どの具体的なイベントが通知を発動しますか?',

    // Event tab: event types
    'Assets Event' => 'アセットイベント',
    'Commerce Orders Event' => 'Commerce 注文イベント',
    'Commerce Products Event' => 'Commerce 製品イベント',
    'Digital Products Event' => 'Digital Products イベント',
    'Digital Product Licenses Event' => 'Digital Products ライセンスイベント',
    'Solspace Calendar Event' => 'Solspace Calendar イベント',
    'Entries Event' => 'エントリイベント',
    'Users Event' => 'ユーザーイベント',
    'Ungrouped Users' => 'グループ外のユーザー',

    // Event tab: Feed
    'Feed URL' => 'フィード URL',
    'The URL of the RSS, Atom, or JSON feed to watch.' => '監視する RSS、Atom、または JSON フィードの URL。',

    // Event tab: field conditions
    'Field Conditions' => 'フィールド条件',
    'Send the message only when the saved element matches the following conditions.' => '保存された要素が次の条件に一致する場合にのみメッセージを送信します。',
    'has changed' => 'が変更された',

    // Event tab: element filters (panel chrome + common output)
    '#{elementType} Event Filters' => '#{elementType} のイベントフィルタ',
    'No filters match this event.' => 'このイベントに一致するフィルタはありません。',
    'Determine whether each message should be sent based on specified conditions.' => '指定した条件に基づいて、各メッセージを送信するかどうかを決定します。',
    'Unnamed filter' => '名前なしのフィルタ',
    'Must be TRUE to send message' => 'メッセージ送信のため TRUE でなければならない',
    'Must be FALSE to send message' => 'メッセージ送信のため FALSE でなければならない',
    'No effect' => '効果なし',

    // Event tab: element filter rules
    'Element is being saved for the first time' => '要素が初めて保存されます',
    'Must be a new entry' => '新しいエントリでなければならない',
    'Must be an existing entry' => '既存のエントリでなければならない',
    'Can be existing or new' => '既存または新規のいずれでも可',
    'Element is new' => '要素は新規',
    'New elements only' => '新規の要素のみ',
    'Existing elements only' => '既存の要素のみ',
    'Element is enabled' => '要素は有効',
    'Must be enabled' => '有効でなければならない',
    'Must be disabled' => '無効でなければならない',
    'Can be enabled or disabled' => '有効または無効のいずれでも可',
    'Element is a draft' => '要素は下書き',
    'Must be a draft' => '下書きでなければならない',
    'Must not be a draft' => '下書きであってはならない',
    'Can be a draft or non-draft' => '下書きでも下書きでなくても可',
    'Element is a provisional draft' => '要素は仮の下書き',
    'Must be a provisional draft' => '仮の下書きでなければならない',
    'Must not be a provisional draft' => '仮の下書きであってはならない',
    'Can be a provisional draft or non-provisional' => '仮の下書きでもそうでなくても可',
    'Element is a revision' => '要素はリビジョン',
    'Must be a revision' => 'リビジョンでなければならない',
    'Must not be a revision' => 'リビジョンであってはならない',
    'Can be a revision or non-revision' => 'リビジョンでもそうでなくても可',
    'Element is being duplicated' => '要素が複製されています',
    'Must be duplicating the element' => '要素を複製している必要がある',
    'Must not be duplicating the element' => '要素を複製していてはならない',
    'Element is being propagated' => '要素が伝播されています',
    'Element must be propagating' => '要素は伝播中でなければならない',
    'Element must not be propagating' => '要素は伝播中であってはならない',
    'Element is being bulk-resaved' => '要素が一括再保存されています',
    'Must be bulk-resaving the element' => '要素を一括再保存している必要がある',
    'Must not be bulk-resaving the element' => '要素を一括再保存していてはならない',

    // Event tab: date trigger
    'On' => '当日',
    'days before' => '日前',
    'days after' => '日後',
    'Relevant Date' => '関連する日付',
    'Send the notification relative to a chosen date.' => '選択した日付を基準に通知を送信します。',

    // Event tab: recurring schedule
    'Every' => '間隔',
    'on' => '曜日',
    'on day' => '日',
    'at' => '時刻',
    'Starting on' => '開始日',
    'Day' => '曜日',
    'Date' => '日付',
    'Time' => '時刻',
    'day(s)' => '日',
    'week(s)' => '週間',
    'month(s)' => 'か月',
    'year(s)' => '年',
    'day' => '日',
    'days' => '日',
    'week' => '週間',
    'weeks' => '週間',
    'month' => 'か月',
    'months' => 'か月',
    'year' => '年',
    'years' => '年',
    'Manual only' => '手動のみ',
    'Scheduled sending' => 'スケジュール送信',
    'Generate report on a recurring schedule' => '繰り返しスケジュールでレポートを生成',
    'Generate report on demand' => '手動でレポートを生成',
    'Send on a Recurring Schedule' => '繰り返しスケジュールで送信',
    'Configure Recurring Schedule' => '繰り返しスケジュールを設定',
    'System timezone set to {timezone}' => 'システムのタイムゾーンは {timezone} に設定されています',
    'Notifications will be sent on the following schedule...' => '通知は次のスケジュールで送信されます...',
    '... and every {cadence} after that.' => '... 以降は {cadence} ごとに送信されます。',
    'On what recurring schedule should the notification be sent?' => 'どの繰り返しスケジュールで通知を送信しますか？',
    'Whether the message should be sent on a schedule, or only triggered manually.' => 'メッセージをスケジュールで送信するか、手動でのみ実行するか。',
    'The message can always be sent using the "Send system snapshot" button above.' => 'メッセージは上の「システムスナップショットを送信」ボタンでいつでも送信できます。',
    'The message can always be sent using the "Send data report" button above.' => 'メッセージは上の「データレポートを送信」ボタンでいつでも送信できます。',

    // Event tab: Dynamic Data snippet field
    'Twig Snippet to Determine Data' => 'データを決定する Twig スニペット',
    'Enter a custom Twig snippet to [determine which data will be included]({url}).' => '[含めるデータを決定する]({url})ためのカスタムTwigスニペットを入力してください。',
    'The snippet **must** include a `{% setData %}` tag.' => 'スニペットには`{% setData %}`タグを**必ず**含める必要があります。',
    'You do not have permission to edit dynamic data.' => '動的データを編集する権限がありません。',

    // Event tab: manual trigger
    'Trigger Label' => 'トリガーのラベル',
    'An element action label (helps to differentiate multiple triggers).' => '要素アクションのラベル（複数のトリガーを区別しやすくします）。',
    'Send Notification' => '通知を送信',

    // Message tab: type selector
    'Message Type' => 'メッセージタイプ',
    'What type of message will be sent?' => 'どのタイプのメッセージが送信されますか?',
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are also supported.' => '[テンプレート]({templatingUrl}) と [特殊変数]({variablesUrl}) もサポートされています。',

    // Details sidebar: queue
    'Use Queue' => 'キューを使用',
    'Immediate' => '即時',
    'Queue' => 'キュー',
    'jobs queue' => 'ジョブキュー',
    'Whether the message will be sent immediately, or added to the {link}.' => 'メッセージを即時に送信するか、{link}に追加するか。',
    'Flash messages never use the queue.' => 'Flash メッセージはキューを使用しません。',
    'Announcements always use the queue.' => 'アナウンスは常にキューを使用します。',

    // Message tab: Email
    "User's Email Address Field" => 'ユーザーのメールアドレスフィールド',
    'Select which User field contains the recipient\'s email address.' => '受信者のメールアドレスが格納されているユーザーフィールドを選択してください。',
    'Email Subject' => 'メールの件名',
    'Subject line of the email.' => 'メールの件名。',
    'Dynamic Subject Line' => '動的な件名',
    'Email Body' => 'メール本文',
    'Body of the email. Supports HTML.' => 'メールの本文。HTML をサポート。',

    // Message tab: rich-text (Trix) toolbar
    'Rich Text' => 'リッチテキスト',
    'Bold' => '太字',
    'Italic' => '斜体',
    'Underline' => '下線',
    'Strikethrough' => '取り消し線',
    'Bullets' => '箇条書き',
    'Numbers' => '番号付き',
    'Heading' => '見出し',
    'Code' => 'コード',
    'Undo' => '元に戻す',
    'Redo' => 'やり直し',

    // Message tab: SMS
    "User's Phone Number Field" => 'ユーザーの電話番号フィールド',
    'Select which User field contains the recipient\'s phone number.' => '受信者の電話番号が格納されているユーザーフィールドを選択してください。',
    'SMS Message Body' => 'SMS メッセージ本文',
    'Body of the SMS (text message). Plain text only.' => 'SMS (テキストメッセージ) の本文。プレーンテキストのみ。',

    // Message tab: Announcement
    'Announcement Title' => 'アナウンスのタイトル',
    'Heading of the announcement.' => 'アナウンスの見出し。',
    'Dynamic Announcement Title' => '動的なアナウンスタイトル',
    'Announcement Message' => 'アナウンスのメッセージ',
    'Body of the announcement. Supports Markdown.' => 'アナウンスの本文。Markdown をサポート。',

    // Message tab: Flash
    'Flash Message Type' => 'フラッシュメッセージのタイプ',
    'Which type of flash message should appear?' => 'どのタイプのフラッシュメッセージを表示しますか?',
    'Flash Message Title' => 'フラッシュメッセージのタイトル',
    'Heading of the flash message.' => 'フラッシュメッセージの見出し。',
    'Dynamic Flash Message Title' => '動的なフラッシュメッセージのタイトル',
    'Flash Message Details' => 'フラッシュメッセージの詳細',
    'Optionally include details below the heading. Supports Markdown and HTML.' => 'オプションで見出しの下に詳細を含めます。Markdown と HTML をサポート。',

    // Message tab: Pushover
    "Field containing each user's Pushover key" => 'ユーザーの Pushover キーフィールド',
    'Select which User field contains the recipient\'s Pushover user key.' => '受信者のPushoverキーが格納されているユーザーフィールドを選択してください。',
    'Pushover Title' => 'Pushover タイトル',
    'Optionally include a heading above the body.' => 'オプションで本文の上に見出しを含めます。',
    'Dynamic Pushover Title' => '動的な Pushover タイトル',
    'Pushover Body' => 'Pushover 本文',
    'Body of the Pushover notification. Plain text only.' => 'Pushover 通知の本文。プレーンテキストのみ。',

    // Message tab: ntfy
    'Priority' => '優先度',
    'Priority level of the ntfy message.' => 'ntfy メッセージの優先度レベル。',
    'Tags' => 'タグ',
    'Optionally include comma-separated [emoji shortcodes](https://docs.ntfy.sh/emojis/).' => 'オプションでカンマ区切りの [絵文字ショートコード](https://docs.ntfy.sh/emojis/) を含めます。',
    'ntfy Title' => 'ntfy タイトル',
    'Dynamic ntfy Title' => '動的な ntfy タイトル',
    'ntfy Body' => 'ntfy 本文',
    'Body of the ntfy notification.' => 'ntfy 通知の本文。',
    'ntfy Link URL' => 'ntfy リンク URL',
    'Optionally open a URL when the notification is clicked.' => 'オプションで、通知がクリックされたときに URL を開きます。',
    'Enable Markdown' => 'Markdown を有効化',
    'Whether to parse the body as Markdown in supported clients.' => '対応クライアントで本文を Markdown として解析するかどうか。',
    'Regular text only' => '通常のテキストのみ',
    'Markdown enabled' => 'Markdown 有効',

    // Message tab: Slack
    'Slack Message Body' => 'Slack メッセージ本文',
    'Supports standard [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) syntax. Optionally supports HTML _(see below)_.' => '標準の[Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting)構文をサポートします。オプションでHTMLもサポートします _(下記参照)_。',
    'Render Message Body as HTML' => 'メッセージ本文をHTMLとしてレンダリング',
    'Whether to only parse as [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), or additionally parse it as HTML.' => '[Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting)のみとして解析するか、HTMLも追加で解析するか。',
    'Render Link Previews' => 'リンクプレビューを表示',
    'Whether Slack should unfurl link previews for URLs in the message body.' => 'メッセージ本文のURLに対してSlackがリンクプレビューを展開するかどうか。',
    'Don\'t unfurl' => '展開しない',
    'Expand link previews' => 'リンクプレビューを展開',
    'Bot Name' => 'ユーザー名',
    'Optionally override the app\'s display name.' => 'オプションでアプリの表示名を上書きします。',
    'Dynamic Bot Name' => '動的なボット名',
    'Bot Icon URL' => 'アイコンURL',
    'Optionally override the app\'s icon with a URL.' => 'オプションでアプリのアイコンを URL で上書きします。',
    'Bot Emoji' => 'アイコン絵文字',
    'Optionally override the app\'s icon with an emoji. Used only when Bot Icon URL is empty.' => 'オプションでアプリのアイコンを絵文字で上書きします。Bot Icon URL が空のときのみ使用されます。',

    // Message tab: Discord
    'Discord Message Body' => 'Discord メッセージ本文',
    'Supports standard Markdown, and optionally HTML _(see below)_. Max 2000 characters.' => '標準の Markdown と、オプションで HTML をサポートします _(下記参照)_。最大 2000 文字。',
    'Whether to only parse as Markdown, or additionally parse it as HTML.' => 'Markdown のみとして解析するか、HTML も追加で解析するか。',
    'Markdown only' => 'Markdown のみ',
    'Markdown + HTML' => 'Markdown + HTML',
    'Whether Discord should unfurl link previews for URLs in the message body.' => 'メッセージ本文の URL に対して Discord がリンクプレビューを表示するかどうか。',
    'Webhook Username' => 'Webhook ユーザー名',
    'Optionally override the webhook\'s display name.' => 'オプションで Webhook の表示名を上書きします。',
    'Dynamic Username' => '動的なユーザー名',
    'Webhook Avatar URL' => 'Webhook アバター URL',
    'Optionally override the webhook\'s avatar with a URL.' => 'オプションで Webhook のアバターを URL で上書きします。',

    // Message tab: Bluesky
    'Post Body' => '投稿本文',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => 'プレーンテキスト、最大 300 文字。URL と `@handle.tld` のメンションは自動的にリンクになります。',
    'Generate Link Preview' => 'リンクプレビューを生成',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => '投稿本文に URL が含まれる場合、自動的にプレビューカードを生成します。',
    'No card' => 'カードなし',
    'Generate preview card' => 'プレビューカードを生成',

    // Message tab: Mastodon
    'Plain text, max 500 characters. URLs will unfurl automatically.' => 'プレーンテキスト、最大 500 文字。URL は自動的に展開されます。',
    'Visibility' => '公開範囲',
    'Who will be able to see this post?' => 'この投稿を誰が閲覧できますか?',

    // Message tab: MQTT
    'Payload' => 'ペイロード',
    'The JSON or plain text message published to the MQTT topic.' => 'MQTT トピックに公開される JSON またはプレーンテキストのメッセージ。',
    'Quality of Service' => 'サービス品質',
    'Delivery guarantee for this message.' => 'このメッセージの配信保証。',
    'Retain' => '保持',
    'Whether the broker keeps this as the topic\'s last message for future subscribers.' => 'ブローカーがこれをトピックの最新メッセージとして保持し、今後の購読者に配信するかどうか。',
    'Don\'t retain' => '保持しない',

    // Recipients tab: type selector & user/group pickers
    'Recipients Type' => '受信者タイプ',
    'Who will receive this message?' => '誰がこのメッセージを受け取りますか?',
    'Add a message recipient' => '受信者を追加',
    'Select User(s)' => 'ユーザーを選択',
    'Which users will receive the message?' => 'どのユーザーがメッセージを受け取りますか?',
    'Which user groups will receive the message?' => 'どのユーザーグループがメッセージを受け取りますか?',

    // Recipients tab: channel pickers (ntfy, Slack, Discord, Bluesky, Mastodon, MQTT)
    'Select ntfy topic(s)' => 'ntfy トピックを選択',
    'Which topics should receive this message?' => 'どのトピックがこのメッセージを受信しますか?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'ntfy トピックが設定されていません。[設定 → ntfy]({url}) で追加してください。',
    'No ntfy topics configured. Topics can only be added in an environment that allows administrative changes.' => 'ntfy トピックが設定されていません。トピックは、管理者による変更が許可された環境でのみ追加できます。',
    'Select Slack channel(s)' => 'Slack チャンネルを選択',
    'Which channels should receive this message?' => 'どのチャンネルがこのメッセージを受信しますか?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Slack チャンネルが設定されていません。[設定 → Slack]({url}) で追加してください。',
    'No Slack channels configured. Channels can only be added in an environment that allows administrative changes.' => 'Slack チャンネルが設定されていません。チャンネルは、管理者による変更が許可された環境でのみ追加できます。',
    'Select Discord channel(s)' => 'Discord チャンネルを選択',
    'No Discord channels configured. Add one in [Settings → Discord]({url}).' => 'Discord チャンネルが設定されていません。[設定 → Discord]({url}) で追加してください。',
    'No Discord channels configured. Channels can only be added in an environment that allows administrative changes.' => 'Discord チャンネルが設定されていません。チャンネルは、管理者による変更が許可された環境でのみ追加できます。',
    'Select Bluesky account(s)' => 'Bluesky アカウントを選択',
    'Which accounts should post this message?' => 'どのアカウントがこのメッセージを投稿しますか?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Bluesky アカウントが設定されていません。[設定 → Bluesky]({url}) で追加してください。',
    'No Bluesky accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Bluesky アカウントが設定されていません。アカウントは、管理者による変更が許可された環境でのみ追加できます。',
    'Select Mastodon account(s)' => 'Mastodon アカウントを選択',
    'No Mastodon accounts configured. Add one in [Settings → Mastodon]({url}).' => 'Mastodon アカウントが設定されていません。[設定 → Mastodon]({url}) で追加してください。',
    'No Mastodon accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Mastodon アカウントが設定されていません。アカウントは、管理者による変更が許可された環境でのみ追加できます。',
    'Select MQTT topic(s)' => 'MQTT トピックを選択',
    'No MQTT topics configured. Add one in [Settings → MQTT]({url}).' => 'MQTT トピックが設定されていません。[設定 → MQTT]({url}) で追加してください。',
    'No MQTT topics configured. Topics can only be added in an environment that allows administrative changes.' => 'MQTT トピックが設定されていません。トピックは、管理者による変更が許可された環境でのみ追加できます。',
    'Not a valid topic. Must not be empty or contain the `+` or `#` wildcards.' => '有効なトピックではありません。空にしたり、ワイルドカード `+` や `#` を含めたりすることはできません。',

    // Recipients tab: dynamic recipients snippet
    'Twig Snippet to Determine Recipients' => '受信者を決定する Twig スニペット',
    'Enter a custom Twig snippet to [determine who will receive the message]({url}).' => '[メッセージの受信者を決定する]({url})ためのカスタムTwigスニペットを入力してください。',
    'The snippet **must** include a `{% setRecipients %}` tag.' => 'スニペットには`{% setRecipients %}`タグを**必ず**含める必要があります。',

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

    // Settings: shared intro lines
    'Consult the [{name} setup guide]({url}) for complete instructions.' => '詳しい手順については、[{name} セットアップガイド]({url}) を参照してください。',
    'Sensitive values can be stored in your `.env` file and referenced here.' => '機密性の高い値は `.env` ファイルに保存し、ここから参照できます。',

    // Settings: Notification order
    'Notification Order' => '通知の並び順',
    'Notifications can be dragged into any order on the index page. Choose where new notifications land in that order.' => '通知は一覧ページでドラッグして好きな順序に並べ替えられます。新しい通知をその順序のどこに追加するかを選択します。',
    'Default Placement' => 'デフォルトの配置',
    'Where new notifications are added to the list.' => '新しい通知をリストのどこに追加するか。',
    'Before other notifications' => '他の通知より前',
    'After other notifications' => '他の通知より後',

    // Settings: Logging
    'Logging' => 'ロギング',
    "Notifier keeps a running log of every message it sends. You usually won't need to change this, but you can limit how many log entries are kept in the database." => 'Notifier は送信されたメッセージのログを継続的に保持します。通常は不要ですが、データベースに記録するログイベントの数を制限できます。',
    'Enable Logging' => 'ロギングを有効化',
    'When disabled, Notifier will not write anything to the notification log.' => '無効にすると、Notifier は通知ログに何も書き込みません。',
    'Number of days to retain log events' => 'ログイベントを保持する日数',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'ログイベントを最大でこの日数だけ保持します。制限なしの場合は空のままにします。',
    'Number of log events to retain' => '保持するログイベント数',
    'At most, keep this many log events. Leave blank for no limit.' => '最大でこの数のログイベントを保持します。制限なしの場合は空のままにします。',

    // Settings: Scheduled sending
    'Scheduled Sending' => 'スケジュール送信',
    'A shared secret that authenticates scheduled runs triggered over the web. You only need this if you trigger the schedule from the web endpoint.' => 'スケジュール実行のWebリクエストを認証するための共有シークレット。Webエンドポイント経由でスケジュールを起動する場合のみ必要です。',
    'Scheduled-Run Token' => 'スケジュール実行トークン',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => '各リクエストとともに X-Notifier-Token ヘッダーまたは token ボディパラメータとして送信されます。',

    // Settings: Twilio
    'Send SMS text messages through [Twilio](https://www.twilio.com).' => '[Twilio](https://www.twilio.com) を通じて SMS テキストメッセージを送信します。',
    'Twilio Account SID' => 'Twilio アカウント SID',
    'Twilio Auth Token' => 'Twilio 認証トークン',
    'Twilio phone number (sends each SMS message)' => 'Twilio 電話番号 (各 SMS の送信元)',
    'SMS Testing' => 'SMS テスト',
    'Optional. When set, every SMS is sent to this number instead of the actual recipient.' => '任意。設定されている場合、送信されるすべての SMS は解決された受信者ではなくこの番号に送られます。',
    'Test phone number' => 'テスト用電話番号',

    // Settings: Pushover
    'Send push notifications through [Pushover](https://pushover.net).' => '[Pushover](https://pushover.net) を通じてプッシュ通知を送信します。',
    'Application API Token' => 'アプリケーション API トークン',
    'The 30-character app token from your Pushover application.' => 'Pushover アプリケーションの 30 文字のアプリトークン。',

    // Settings: ntfy
    'Send push notifications through [ntfy](https://ntfy.sh).' => '[ntfy](https://ntfy.sh) を通じてプッシュ通知を送信します。',
    'Server URL' => 'サーバー URL',
    "Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`." => '任意。該当する場合は自前ホストの ntfy インスタンスを指定します。デフォルトは `https://ntfy.sh` です。',
    'Access token' => 'アクセストークン',
    'Optional, required for protected topics or self-hosted instances with auth.' => '任意。保護されたトピックや認証付きの自前ホストインスタンスでは必要です。',
    'ntfy Topics' => 'ntfy トピック',
    'Add the ntfy topics you want to send to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'メッセージの送信先にしたい ntfy トピックを追加します。各トピックは通知の設定時に **受信者** タブで受信者として利用できるようになります。',
    'Topics' => 'トピック',
    "Click any row's **Test** button to send a quick test message to that topic." => '任意の行の **テスト** ボタンをクリックして、そのトピックに簡単なテストメッセージを送信します。',
    'Label' => 'ラベル',
    'Topic' => 'トピック',
    'Add a topic' => 'トピックを追加',

    // Settings: Slack
    'Post messages to your Slack channels.' => 'Slack チャンネルにメッセージを送信します。',
    'Channels' => 'チャンネル',
    "Click any row's **Test** button to send a quick test message to that channel." => '任意の行の **テスト** ボタンをクリックして、そのチャンネルに簡単なテストメッセージを送信します。',
    'Bot Token' => 'ボットトークン',
    'Channel ID' => 'チャンネルID',
    'Add a channel' => 'チャンネルを追加',
    'Not a valid Bot Token. Must start with `xoxb-`.' => '有効なボットトークンではありません。`xoxb-`で始まる必要があります。',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => '有効なチャンネルIDではありません。`C01234ABCD`のような形式である必要があります。',

    // Settings: Discord
    'Post messages to your Discord channels.' => 'Discord チャンネルにメッセージを送信します。',
    'Webhook URL' => 'Webhook URL',
    'Not a valid Webhook URL. Must start with `https://discord.com/api/webhooks/`.' => '有効な Webhook URL ではありません。`https://discord.com/api/webhooks/` で始まる必要があります。',

    // Settings: Bluesky
    'Publish posts to your [Bluesky](https://bsky.app) accounts.' => '[Bluesky](https://bsky.app) アカウントに投稿します。',
    'PDS URL' => 'PDS URL',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'デフォルトは https://bsky.social です。インストールがフェデレートしている場合はカスタム PDS を指定してください。',
    'Bluesky Accounts' => 'Bluesky アカウント',
    'Add the Bluesky accounts you want to post from. Each account becomes available as a recipient on the **Recipients** tab when you set up a notification.' => '投稿元にしたい Bluesky アカウントを追加します。各アカウントは通知の設定時に **受信者** タブで受信者として利用できるようになります。',
    'Accounts' => 'アカウント',
    "Click any row's **Test** button to confirm the account authenticates." => '任意の行の **テスト** ボタンをクリックして、アカウントが認証されることを確認します。',
    'Handle' => 'ハンドル',
    'App password' => 'アプリパスワード',
    'Add an account' => 'アカウントを追加',

    // Settings: Mastodon
    'Publish posts to your [Mastodon](https://joinmastodon.org) accounts.' => '[Mastodon](https://joinmastodon.org) アカウントに投稿します。',
    'Click any row\'s **Test** button to verify that account\'s credentials. No posts are made.' => '任意の行の **テスト** ボタンをクリックして、そのアカウントの認証情報を検証します。投稿は行われません。',
    'Instance URL' => 'インスタンス URL',
    'Access Token' => 'アクセストークン',

    // Settings: MQTT
    'Publish messages to an MQTT broker, handy for IoT and home-automation setups.' => 'MQTT ブローカーにメッセージを公開します。IoT やホームオートメーションの構成に便利です。',
    'Host' => 'ホスト',
    'Broker hostname, without a protocol or port.' => 'ブローカーのホスト名(プロトコルやポートは含めません)。',
    'Port' => 'ポート',
    'Optional. Defaults to 8883 when TLS is enabled, otherwise 1883.' => '任意。TLS が有効な場合は既定で 8883、それ以外は 1883 です。',
    'Use TLS' => 'TLS を使用',
    'Whether to connect to the broker over a secure TLS socket.' => 'セキュアな TLS ソケットでブローカーに接続するかどうか。',
    'Username' => 'ユーザー名',
    'Optional, for brokers that require username/password authentication.' => '任意。ユーザー名/パスワード認証を必要とするブローカー向けです。',
    'Password' => 'パスワード',
    'MQTT Version' => 'MQTT バージョン',
    'Protocol version sent to the broker.' => 'ブローカーに送信するプロトコルバージョン。',
    'Client ID' => 'クライアント ID',
    'Optional. A unique client ID is generated automatically when left blank.' => '任意。空欄の場合、一意のクライアント ID が自動生成されます。',
    'Mutual TLS' => '相互 TLS',
    'Optional. Needed for brokers that authenticate clients with certificates, such as AWS IoT Core. Enter the server file paths to your certificate files. You can use a `.env` variable or `@alias` reference.' => '任意。AWS IoT Core など、証明書でクライアントを認証するブローカーに必要です。証明書ファイルへのサーバーファイルパスを指定してください(`.env` 変数または `@alias` 参照を使用できます)。',
    'CA Certificate File' => 'CA 証明書ファイル',
    'Path to the certificate authority (CA) file.' => '認証局(CA)ファイルへのパス。',
    'Client Certificate File' => 'クライアント証明書ファイル',
    'Path to the client certificate file.' => 'クライアント証明書ファイルへのパス。',
    'Client Key File' => 'クライアントキーファイル',
    'Path to the client private key file.' => 'クライアントの秘密鍵ファイルへのパス。',
    'MQTT Topics' => 'MQTT トピック',
    'Add the MQTT topics you want to publish to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => '発行先にしたい MQTT トピックを追加します。各トピックは通知の設定時に **受信者** タブで受信者として利用できるようになります。',
    'Click any row\'s **Test** button to publish a quick test message to that topic.' => '任意の行の **テスト** ボタンをクリックして、そのトピックに簡単なテストメッセージを発行します。',

    // ========================================================
    // MANUAL SEND & TEST
    // ========================================================

    // Manual send & test
    'Send a test message' => 'テストメッセージを送信',
    'Send a REAL test notification?\\n\\n⚠️ Uses a random sample of real data.\\n⚠️ Sends a real message via the configured channel.\\n⚠️ Delivers to the real configured recipient(s).' => '本当にテスト通知を送信しますか?\\n\\n⚠️ 実際のデータからランダムなサンプルを使用します。\\n⚠️ 設定されたチャネル経由で実際のメッセージを送信します。\\n⚠️ 実際の設定された受信者に配信されます。',
    'Test' => 'テスト',
    'Send system snapshot' => 'システムスナップショットを送信',
    'Send data report' => 'データレポートを送信',
    'Are you sure you want to send this notification?' => 'この通知を送信してもよろしいですか？',
    'This notification cannot be triggered manually.' => 'この通知は手動でトリガーできません。',
    'This notification no longer applies to the selected element.' => 'この通知は選択された要素には適用されなくなりました。',

    // ========================================================
    // RUNTIME OUTPUT
    // ========================================================

    // Runtime: dispatch log feedback
    'Sending {messageType} to {recipient}.' => '{recipient} に {messageType} を送信中。',
    'Adding message to queue.' => 'メッセージをキューに追加中。',
    'Sending message immediately (bypassing queue).' => 'メッセージを即時送信中(キューをバイパス)。',
    'Unable to parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => 'フィードを解析できません。PHP の `simplexml` および `libxml` 拡張機能が必要です。',
    'Unable to parse the feed.' => 'フィードを解析できません。',
    'Unable to fetch the feed: {message}' => 'フィードを取得できません: {message}',
    'Initial feed scan failed: {message}' => '初回のフィードスキャンに失敗しました: {message}',

    // Runtime: controller responses
    'Test notification dispatched.' => 'テスト通知を送信しました。',
    'No messages were dispatched. Check the recipient configuration.' => 'メッセージは送信されませんでした。受信者の設定を確認してください。',
    'Unable to send test: the feed could not be read or has no items.' => 'テストを送信できません：フィードを読み取れないか、項目がありません。',
    'Unable to send test: no element matches the configured filters.' => 'テストを送信できません：設定されたフィルターに一致する要素がありません。',
    "Couldn't save settings." => '設定を保存できませんでした。',
    'Settings saved.' => '設定を保存しました。',
    'Topic is empty.' => 'トピックが空です。',
    'Server URL is not configured.' => 'サーバー URL が設定されていません。',
    'Test message from Notifier.' => 'Notifier からのテストメッセージです。',
    'HTTP {status}' => 'HTTP {status}',
    'Test message sent successfully.' => 'テストメッセージを正常に送信しました。',
    'Handle and app password are required.' => 'ハンドルとアプリパスワードは必須です。',
    'Authentication failed.' => '認証に失敗しました。',
    'Successfully authenticated. No messages were posted.' => '認証に成功しました。メッセージは投稿されていません。',
    'Log events deleted.' => 'ログイベントを削除しました。',
    'Notification sent.' => '通知を送信しました。',
    'Notification was not sent. Check the Notification Log for details.' => '通知は送信されませんでした。詳細は通知ログをご確認ください。',
    'Instance URL and access token are required.' => 'インスタンス URL とアクセストークンは必須です。',
    'Mastodon rejected the request: {error}' => 'Mastodon がリクエストを拒否しました: {error}',
    'Successfully authenticated as @{handle}. No posts were made.' => '@{handle} として認証に成功しました。投稿は行われていません。',
    'Broker host is not configured.' => 'ブローカーのホストが設定されていません。',

    // Outbound: per-channel send results
    'Unable to send email, no recipient specified.' => 'メールを送信できません。受信者が指定されていません。',
    'Unable to send email, the message body was empty.' => 'メールを送信できません。メッセージ本文が空でした。',
    "Unable to send the email using Craft's native email handling." => 'Craft のネイティブメール処理でメールを送信できません。',
    'Check your general email settings within Craft.' => 'Craft の一般的なメール設定を確認してください。',
    'Successfully sent email message!' => 'メールを正常に送信しました!',
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[Twilio の認証情報が無効です。]({url}) {missing} がありません。',
    'Unable to send SMS, no Twilio phone number exists.' => 'SMS を送信できません。Twilio の電話番号がありません。',
    'Unable to send SMS, no recipient phone number exists.' => 'SMS を送信できません。受信者の電話番号がありません。',
    'Unable to send SMS, recipient phone number is invalid.' => 'SMS を送信できません。受信者の電話番号が無効です。',
    'Successfully sent SMS message!' => 'SMS を正常に送信しました!',
    'Unable to post announcement, no recipient userId specified.' => 'アナウンスを投稿できません。受信者の userId が指定されていません。',
    'Successfully posted announcement!' => 'アナウンスを正常に投稿しました!',
    'Unable to send the flash message, invalid flash type.' => 'フラッシュメッセージを送信できません。フラッシュタイプが無効です。',
    'Successfully sent flash message!' => 'フラッシュメッセージを正常に送信しました!',
    '[Invalid Pushover credentials.]({url}) Missing app token.' => '[Pushover の認証情報が無効です。]({url}) アプリトークンがありません。',
    'Unable to send Pushover message, no user key on recipient.' => 'Pushover メッセージを送信できません。受信者にユーザーキーがありません。',
    'Pushover POST failed: {reason}' => 'Pushover POST が失敗しました: {reason}',
    'Successfully sent Pushover message!' => 'Pushover メッセージを正常に送信しました!',
    'Unable to send ntfy message, no topic specified.' => 'ntfy メッセージを送信できません。トピックが指定されていません。',
    'ntfy POST failed with HTTP {status}: {reason}' => 'ntfy POST が HTTP {status} で失敗しました: {reason}',
    'ntfy POST failed: {reason}' => 'ntfy POST が失敗しました: {reason}',
    'Successfully sent ntfy message to topic "{topic}".' => 'トピック「{topic}」に ntfy メッセージを正常に送信しました。',
    'Unable to send Slack message, no bot token.' => 'Slackメッセージを送信できません: ボットトークンがありません。',
    'Unable to send Slack message, no channel ID.' => 'Slackメッセージを送信できません: チャンネルIDがありません。',
    'Unable to send Slack message, body is empty.' => 'Slack メッセージを送信できません。本文が空です。',
    'Slack rejected the message: {error}' => 'Slackがメッセージを拒否しました: {error}',
    'Slack POST failed: {reason}' => 'Slack POST が失敗しました: {reason}',
    'Successfully sent Slack message to "{label}".' => '"{label}" に Slack メッセージを正常に送信しました。',
    'Unable to send Discord message, no webhook URL.' => 'Discord メッセージを送信できません。Webhook URL がありません。',
    'Unable to send Discord message, body is empty.' => 'Discord メッセージを送信できません。本文が空です。',
    'Unable to send Discord message, body exceeds the 2000-character limit.' => 'Discord メッセージを送信できません。本文が 2000 文字の制限を超えています。',
    'Discord rejected the message: {error}' => 'Discord がメッセージを拒否しました: {error}',
    'Discord POST failed: {reason}' => 'Discord POST が失敗しました: {reason}',
    'Successfully sent Discord message to "{label}".' => '"{label}" に Discord メッセージを正常に送信しました。',
    'Unable to send Bluesky post, recipient is missing credentials.' => 'Bluesky 投稿を送信できません。受信者の認証情報がありません。',
    'Body exceeded {max} characters, truncated.' => '本文が {max} 文字を超えたため切り詰められました。',
    'Successfully posted to Bluesky as "{label}".' => '"{label}" として Bluesky に正常に投稿しました。',
    'Bluesky auth failed for {handle}: {reason}' => '{handle} の Bluesky 認証に失敗しました: {reason}',
    'Bluesky auth failed: {reason}' => 'Bluesky 認証に失敗しました: {reason}',
    'Bluesky post failed: {reason}' => 'Bluesky 投稿に失敗しました: {reason}',
    'Bluesky link preview skipped: {reason}' => 'Bluesky のリンクプレビューをスキップしました: {reason}',
    'Unable to send Mastodon post, no instance URL.' => 'Mastodon の投稿を送信できません。インスタンス URL がありません。',
    'Unable to send Mastodon post, no access token.' => 'Mastodon の投稿を送信できません。アクセストークンがありません。',
    'Unable to send Mastodon post, body is empty.' => 'Mastodon の投稿を送信できません。本文が空です。',
    'Mastodon rejected the post: {error}' => 'Mastodon が投稿を拒否しました: {error}',
    'Mastodon POST failed: {reason}' => 'Mastodon POST が失敗しました: {reason}',
    'Successfully sent Mastodon post to "{label}".' => '"{label}" に Mastodon の投稿を正常に送信しました。',
    'Unable to send MQTT message, no broker host configured.' => 'MQTT メッセージを送信できません。ブローカーのホストが設定されていません。',
    'Unable to send MQTT message, no topic specified.' => 'MQTT メッセージを送信できません。トピックが指定されていません。',
    'Unable to send MQTT message, the payload is empty.' => 'MQTT メッセージを送信できません。ペイロードが空です。',
    'MQTT publish failed: {reason}' => 'MQTT の発行に失敗しました: {reason}',
    'Successfully sent MQTT message to topic "{topic}".' => 'トピック「{topic}」に MQTT メッセージを送信しました。',

    // Recipient warnings
    'Recipient "{name}" has no email address.' => '受信者「{name}」にはメールアドレスがありません。',
    'Recipient "{name}" has no phone number.' => '受信者「{name}」には電話番号がありません。',
    'Recipient "{name}" has no associated User; cannot send announcement.' => '受信者「{name}」に関連付けられたユーザーがないため、アナウンスを送信できません。',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => '受信者「{name}」はコントロールパネルにアクセスできないため、アナウンスを送信できません。',
    'Pushover user-key field is not configured on this notification.' => 'この通知に Pushover ユーザーキーフィールドが設定されていません。',
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => '受信者「{name}」に関連付けられたユーザーがないため、Pushover メッセージを送信できません。',
    '[SKIPPED] User "{name}" has no Pushover key.' => '[スキップ] ユーザー「{name}」には Pushover キーがありません。',
    'Recipient "{name}" has no ntfy topic.' => '受信者「{name}」には ntfy トピックがありません。',
    'Recipient "{name}" has no Slack bot token.' => '受信者「{name}」にSlackボットトークンがありません。',
    'Recipient "{name}" has no Slack channel ID.' => '受信者「{name}」にSlackチャンネルIDがありません。',
    'Recipient "{name}" has no Discord webhook URL.' => '受信者「{name}」には Discord の Webhook URL がありません。',
    'Recipient "{name}" has no Bluesky credentials.' => '受信者「{name}」には Bluesky の認証情報がありません。',
    'Recipient "{name}" has no Mastodon credentials.' => '受信者「{name}」には Mastodon の認証情報がありません。',
    'Recipient "{name}" has no MQTT topic.' => '受信者「{name}」に MQTT トピックがありません。',

    // Errors & exceptions
    'Invalid element event: {class}' => '無効な要素イベント: {class}',
    'Invalid notification ID: {id}' => '無効な通知 ID: {id}',
    'Invalid email message mode.' => '無効なメールメッセージモードです。',
    'You do not have permission to use the Dynamic Recipients type.' => '動的受信者タイプを使用する権限がありません。',
    'Dynamic recipients snippet did not call setRecipients.' => '動的受信者スニペットは setRecipients を呼び出しませんでした。',
    'setRecipients was called with an empty value.' => 'setRecipients が空の値で呼び出されました。',
    'Unrecognized recipient of type "{type}".' => 'タイプ「{type}」の受信者が認識できません。',
    'Unrecognized recipient "{value}".' => '受信者「{value}」が認識できません。',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => '設定された {kind} はプラグイン設定に存在しません (uid: {uid})。',
    'Invalid settings section: {section}' => '無効な設定セクション: {section}',
    'User not authorized to save this notification.' => 'この通知を保存する権限がユーザーにありません。',
    'User not authorized to view this notification.' => 'この通知を表示する権限がユーザーにありません。',
    'User not authorized to delete this notification.' => 'この通知を削除する権限がユーザーにありません。',
    'Notification not found' => '通知が見つかりません',
    'Element not found' => '要素が見つかりません',
    'You do not have permission to use the Dynamic Data type.' => '動的データタイプを使用する権限がありません。',
    'The Dynamic Data snippet did not call the {tag} tag.' => 'Twig スニペットが {tag} タグを呼び出しませんでした。',

    // Config-file override note
    'This is being set in the config file. [{file}]' => 'これは設定ファイルで設定されています。[{file}]',

    // ========================================================
    // JAVASCRIPT UI
    // ========================================================

    // JavaScript: log utility & buttons
    'Test notification failed.' => 'テスト通知に失敗しました。',
    'Unable to get the notification, something went wrong.' => '通知を取得できませんでした。問題が発生しました。',
    'Something went wrong.' => '問題が発生しました。',
    'Invalid notification ID.' => '通知IDが無効です。',
    'Unable to delete the log event, something went wrong.' => 'ログイベントを削除できませんでした。問題が発生しました。',
    'Log event deleted.' => 'ログイベントを削除しました。',
    'Unable to delete log events, something went wrong.' => 'ログイベントを削除できませんでした。問題が発生しました。',
    'Are you sure you want to delete all logs from {date}?' => '{date}のすべてのログを削除してもよろしいですか？',
];
