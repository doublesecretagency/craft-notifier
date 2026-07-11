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

    // Event tab: Formie
    'Submission Outcome' => '送信結果',
    'Trigger based on the success or failure of a submission.' => '送信の成功または失敗に基づいてトリガーします。',
    'Successful submissions only' => '成功した送信のみ',
    'Failed submissions only' => '失敗した送信のみ',
    'All submissions' => 'すべての送信',

    // Event tab: Feed
    'Feed URL' => 'フィード URL',
    'The URL of the RSS, Atom, or JSON feed to watch.' => '監視する RSS、Atom、または JSON フィードの URL。',
    'Feed Timeout' => 'フィードのタイムアウト',
    'How long to wait when the feed is loading slowly. Default {default} seconds, max {max}.' => 'フィードの読み込みが遅いときに待機する時間。デフォルト {default} 秒、最大 {max}。',
    'seconds' => '秒',

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
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are supported.' => '[テンプレート]({templatingUrl}) と [特殊変数]({variablesUrl}) がサポートされています。',

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

    // Message tab: Facebook
    'Message Body' => 'メッセージ本文',
    'The text of your Facebook post.' => 'Facebook 投稿のテキスト。',
    'Preview Card URL' => 'プレビューカード URL',
    'Optionally add a link to generate a preview card.' => 'オプションでリンクを追加してプレビューカードを生成します。',

    // Message tab: Instagram
    'Caption' => 'キャプション',
    'Image Attachment' => '画像の添付',
    'Optional caption, max 2200 characters.' => '任意のキャプション、最大 2200 文字。',

    // Message tab: X (Twitter)
    'Plain text, max 280 characters.' => 'プレーンテキスト、最大 280 文字。',

    // Message tab: Media
    'Attach an image by calling `{% setMedia %}` in a [custom Twig snippet]({url}).' => '[カスタム Twig スニペット]({url})で `{% setMedia %}` を呼び出して画像を添付します。',

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

    // Message tab: LinkedIn
    'LinkedIn' => 'LinkedIn',
    'The text of your LinkedIn post.' => 'LinkedIn 投稿の本文です。',

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
    'Select Facebook page(s)' => 'Facebook ページを選択',
    'Which pages should post this message?' => 'どのページがこのメッセージを投稿しますか?',
    'No Facebook pages configured. Add one in [Settings → Facebook]({url}).' => 'Facebook ページが設定されていません。[設定 → Facebook]({url}) で追加してください。',
    'No Facebook pages configured. Pages can only be added in an environment that allows administrative changes.' => 'Facebook ページが設定されていません。ページは、管理者による変更が許可された環境でのみ追加できます。',
    'Select Instagram account(s)' => 'Instagram アカウントを選択',
    'No Instagram accounts configured. Add one in [Settings → Instagram]({url}).' => 'Instagram アカウントが設定されていません。[設定 → Instagram]({url}) で追加してください。',
    'No Instagram accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Instagram アカウントが設定されていません。アカウントは、管理者による変更が許可された環境でのみ追加できます。',
    'Select X (Twitter) account(s)' => 'X (Twitter) アカウントを選択',
    'No X (Twitter) accounts configured. Add one in [Settings → X (Twitter)]({url}).' => 'X (Twitter) アカウントが設定されていません。[設定 → X (Twitter)]({url}) で追加してください。',
    'No X (Twitter) accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'X (Twitter) アカウントが設定されていません。アカウントは、管理者による変更が許可された環境でのみ追加できます。',
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

    // Recipients tab: LinkedIn picker
    'Select LinkedIn account(s)' => 'LinkedIn アカウントを選択',
    'Which page or member should post this message?' => 'どのページまたはメンバーがこのメッセージを投稿しますか？',
    'No LinkedIn accounts connected. Connect one in [Settings → LinkedIn]({url}).' => 'LinkedIn アカウントが接続されていません。[設定 → LinkedIn]({url}) で接続してください。',
    'No LinkedIn accounts connected. Accounts can only be connected in an environment that allows administrative changes.' => 'LinkedIn アカウントが接続されていません。アカウントは、管理者による変更が許可された環境でのみ接続できます。',

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

    // Settings: nav group headings
    'Push Notifications' => 'プッシュ通知',
    'Chat Platforms' => 'チャットプラットフォーム',
    'Social Media' => 'ソーシャルメディア',
    'Internet of Things' => 'モノのインターネット',
    'Expand {heading}' => '{heading}を展開',

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

    // Settings: Facebook
    'Facebook' => 'Facebook',
    'Publish posts to your [Facebook](https://facebook.com) pages.' => '[Facebook](https://facebook.com) ページに投稿します。',
    'Pages' => 'ページ',
    'Page ID' => 'Page ID',
    'Page Access Token' => 'Page Access Token',
    'Add a page' => 'ページを追加',
    "Click any row's **Test** button to verify that page's credentials. No posts are made." => '任意の行の **テスト** ボタンをクリックして、そのページの認証情報を検証します。投稿は行われません。',

    // Settings: Instagram
    'Instagram' => 'Instagram',
    'Publish posts to your [Instagram](https://instagram.com) Business accounts.' => '[Instagram](https://instagram.com) ビジネスアカウントに投稿します。',
    "Click any row's **Test** button to resolve the linked Instagram account. No posts are made." => '任意の行の **テスト** ボタンをクリックして、リンクされた Instagram アカウントを解決します。投稿は行われません。',

    // Settings: X (Twitter)
    'X (Twitter)' => 'X (Twitter)',
    'Publish posts to your [X (Twitter)](https://x.com) accounts.' => '[X (Twitter)](https://x.com) アカウントに投稿します。',
    'Consumer Key' => 'Consumer Key',
    'Consumer Key Secret' => 'Consumer Key Secret',
    'Access Token Secret' => 'Access Token Secret',

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

    // Settings: LinkedIn
    'Publish posts to your [LinkedIn](https://linkedin.com) profile.' => '[LinkedIn](https://linkedin.com) のプロフィールに投稿します。',
    'The Client ID of your LinkedIn app.' => 'LinkedIn アプリのクライアント ID です。',
    'Client Secret' => 'クライアントシークレット',
    'The Primary Client Secret of your LinkedIn app.' => 'LinkedIn アプリのプライマリクライアントシークレットです。',
    'Enable organization posting' => '組織としての投稿を有効にする',
    'Copy this redirect URL' => 'このリダイレクト URL をコピー',
    'When configuring the LinkedIn app, <strong>copy this URL</strong> to use as an "Authorized redirect URL".' => 'LinkedIn アプリを設定する際は、<strong>この URL をコピー</strong>して "Authorized redirect URL" として使用してください。',
    'Also request access to post as organization pages you administer. Requires Community Management API approval from LinkedIn.' => 'あなたが管理する組織ページとして投稿するためのアクセスも要求します。LinkedIn による Community Management API の承認が必要です。',
    'Connections' => '接続',
    'Each connection becomes available as a recipient on the **Recipients** tab when you set up a notification.' => '通知を設定すると、各接続が **受信者** タブで受信者として利用できるようになります。',
    'Account' => 'アカウント',
    'Type' => '種類',
    'Status' => 'ステータス',
    'Organization' => '組織',
    'Member' => 'メンバー',
    'Reconnect needed' => '再接続が必要',
    'Expires' => '有効期限',
    'Connected' => '接続済み',
    'Disconnect' => '切断',
    'No LinkedIn accounts are connected yet.' => 'まだ LinkedIn アカウントが接続されていません。',
    'Connect to LinkedIn' => 'LinkedIn に接続',
    'Provide valid credentials to connect with LinkedIn.' => 'LinkedIn に接続するには、有効な認証情報を入力してください。',
    'Disconnect this LinkedIn account?' => 'この LinkedIn アカウントを切断しますか？',

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
    'Sending "{title}".' => '「{title}」を送信中。',
    '[invalid recipient]' => '[無効な受信者]',
    'Scanning feed {url}.' => 'フィード {url} をスキャン中。',
    'Adding message to queue.' => 'メッセージをキューに追加中。',
    'Sending message immediately (bypassing queue).' => 'メッセージを即時送信中(キューをバイパス)。',

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
    'Page ID and Page Access Token are required.' => 'Page ID と Page Access Token は必須です。',
    'Facebook rejected the request: {error}' => 'Facebook がリクエストを拒否しました: {error}',
    'Successfully connected to "{name}". No posts were made.' => '「{name}」に正常に接続しました。投稿は行われていません。',
    'No Instagram Business account is linked to this Page.' => 'このページにリンクされた Instagram ビジネスアカウントがありません。',
    'Successfully connected to @{handle}. No posts were made.' => '@{handle} に正常に接続しました。投稿は行われていません。',
    'All four credentials are required.' => '4 つの認証情報すべてが必須です。',
    'X (Twitter) rejected the request: {error}' => 'X (Twitter) がリクエストを拒否しました: {error}',
    'Successfully authenticated as @{username}. No posts were made.' => '@{username} として認証に成功しました。投稿は行われていません。',
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

    // Runtime: LinkedIn connect flow
    'Add your LinkedIn app credentials before connecting.' => '接続する前に LinkedIn アプリの認証情報を追加してください。',
    'LinkedIn authorization failed: {error}' => 'LinkedIn の認証に失敗しました: {error}',
    'LinkedIn authorization failed: invalid state.' => 'LinkedIn の認証に失敗しました: 無効な state です。',
    'LinkedIn authorization failed: no code returned.' => 'LinkedIn の認証に失敗しました: コードが返されませんでした。',
    'Connected to LinkedIn.' => 'LinkedIn に接続しました。',
    'Disconnected from LinkedIn.' => 'LinkedIn から切断しました。',

    // Outbound: per-channel send results
    'Successfully sent an email to {name}.' => '{name} にメールを正常に送信しました。',
    'Successfully sent an SMS message to {name}.' => '{name} に SMS を正常に送信しました。',
    'Successfully sent a Pushover notification to {name}.' => '{name} に Pushover 通知を正常に送信しました。',
    'Successfully posted an announcement for {name}.' => '{name} のアナウンスを正常に投稿しました。',
    'Successfully sent a flash message to {name}.' => '{name} にフラッシュメッセージを正常に送信しました。',
    'Successfully posted to Slack in channel "{label}".' => 'Slack のチャンネル「{label}」に正常に投稿しました。',
    'Successfully posted to Discord in channel "{label}".' => 'Discord のチャンネル「{label}」に正常に投稿しました。',
    'Successfully posted to Facebook as "{label}" account.' => 'アカウント「{label}」として Facebook に正常に投稿しました。',
    'Successfully posted to Instagram as "{label}" account.' => 'アカウント「{label}」として Instagram に正常に投稿しました。',
    'Successfully posted to X (Twitter) as "{label}" account.' => 'アカウント「{label}」として X (Twitter) に正常に投稿しました。',
    'Successfully posted to Bluesky as "{label}" account.' => 'アカウント「{label}」として Bluesky に正常に投稿しました。',
    'Successfully posted to Mastodon as "{label}" account.' => 'アカウント「{label}」として Mastodon に正常に投稿しました。',
    'Successfully posted to LinkedIn as "{label}" account.' => 'アカウント「{label}」として LinkedIn に正常に投稿しました。',
    'Successfully sent ntfy message to topic "{topic}".' => 'トピック「{topic}」に ntfy メッセージを正常に送信しました。',
    'Slack rejected the message: {error}' => 'Slackがメッセージを拒否しました: {error}',
    'Discord rejected the message: {error}' => 'Discord がメッセージを拒否しました: {error}',
    'the attached image could not be read' => '添付された画像を読み取れませんでした',
    'Successfully sent MQTT message to topic "{topic}".' => 'トピック「{topic}」に MQTT メッセージを送信しました。',

    // Outbound: LinkedIn send results & skips
    '[EMPTY BODY] The LinkedIn post body is empty.' => '[EMPTY BODY] LinkedIn 投稿の本文が空です。',
    '[NO RECIPIENT] No LinkedIn connection was specified.' => '[NO RECIPIENT] LinkedIn の接続が指定されていません。',
    '[RECONNECT REQUIRED] {reason}' => '[RECONNECT REQUIRED] {reason}',
    '[REJECTED BY LINKEDIN] {error}' => '[REJECTED BY LINKEDIN] {error}',
    'LinkedIn app credentials are not configured.' => 'LinkedIn アプリの認証情報が設定されていません。',
    'The LinkedIn access token has expired. Please reconnect.' => 'LinkedIn のアクセストークンが期限切れです。再接続してください。',
    'The LinkedIn connection no longer exists.' => 'その LinkedIn 接続は存在しません。',
    'My LinkedIn Profile' => '自分の LinkedIn プロフィール',
    '[SKIPPED] Recipient "{name}" has no LinkedIn connection.' => '[SKIPPED] 受信者 "{name}" には LinkedIn の接続がありません。',
    '[SKIPPED] The configured LinkedIn connection no longer exists (uid: {uid}).' => '[SKIPPED] 設定された LinkedIn 接続は存在しません (uid: {uid})。',

    // Media attachments
    'Videos are not yet supported on {channel}.' => '動画は {channel} ではまだサポートされていません。',
    'The image could not be resized to fit.' => '画像をサイズ調整できませんでした。',
    'The image could not be read.' => '画像を読み込めませんでした。',
    'The image failed to upload.' => '画像のアップロードに失敗しました。',
    'The upload response had no media ID.' => 'アップロード応答にメディアIDがありませんでした。',
    'The upload response had no blob.' => 'アップロード応答にblobがありませんでした。',
    '[NOT ATTACHED] Unable to attach image. {reason}' => '[未添付] 画像を添付できませんでした。{reason}',

    // Recipient warnings
    '[SKIPPED] User "{name}" has no Pushover key.' => '[スキップ] ユーザー「{name}」には Pushover キーがありません。',

    // Errors & exceptions
    'Invalid element event: {class}' => '無効な要素イベント: {class}',
    'Invalid notification ID: {id}' => '無効な通知 ID: {id}',
    'Invalid email message mode.' => '無効なメールメッセージモードです。',
    'You do not have permission to use the Dynamic Recipients type.' => '動的受信者タイプを使用する権限がありません。',
    'Invalid settings section: {section}' => '無効な設定セクション: {section}',
    'User not authorized to save this notification.' => 'この通知を保存する権限がユーザーにありません。',
    'User not authorized to view this notification.' => 'この通知を表示する権限がユーザーにありません。',
    'User not authorized to delete this notification.' => 'この通知を削除する権限がユーザーにありません。',
    'Notification not found' => '通知が見つかりません',
    'Element not found' => '要素が見つかりません',
    'You do not have permission to use the Dynamic Data type.' => '動的データタイプを使用する権限がありません。',
    '[NO DATA] The Dynamic Data snippet did not call the {tag} tag.' => '[データなし] Twig スニペットが {tag} タグを呼び出しませんでした。',

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
    // Reworded outbound + dispatch log messages
    '[BAD CREDENTIALS] Missing app token. [Configure Pushover]({url}).' => '[認証情報エラー] アプリトークンがありません。[Pushover を設定]({url})。',
    '[BAD CREDENTIALS] Missing {missing}. [Configure Twilio]({url}).' => '[認証情報エラー] {missing} がありません。[Twilio を設定]({url})。',
    '[BAD CREDENTIALS] No Discord webhook URL is configured.' => '[認証情報エラー] Discord の Webhook URL が設定されていません。',
    '[BAD CREDENTIALS] No MQTT broker host is configured.' => '[認証情報エラー] MQTT ブローカーのホストが設定されていません。',
    '[BAD CREDENTIALS] No Mastodon access token is configured.' => '[認証情報エラー] Mastodon のアクセストークンが設定されていません。',
    '[BAD CREDENTIALS] No Mastodon instance URL is configured.' => '[認証情報エラー] Mastodon のインスタンス URL が設定されていません。',
    '[BAD CREDENTIALS] No Slack bot token is configured.' => '[認証情報エラー] Slack のボットトークンが設定されていません。',
    '[BAD CREDENTIALS] No Twilio phone number is configured.' => '[認証情報エラー] Twilio の電話番号が設定されていません。',
    '[BAD CREDENTIALS] The recipient is missing Bluesky credentials.' => '[認証情報エラー] 宛先に Bluesky の認証情報がありません。',
    '[BAD CREDENTIALS] The recipient is missing Facebook credentials.' => '[認証情報エラー] 宛先に Facebook の認証情報がありません。',
    '[BAD CREDENTIALS] The recipient is missing X (Twitter) credentials.' => '[認証情報エラー] 宛先に X (Twitter) の認証情報がありません。',
    '[BAD CREDENTIALS] Unable to post, recipient is missing credentials.' => '[認証情報エラー] 投稿できません。宛先に認証情報がありません。',
    '[EMPTY BODY] The Discord message body is empty.' => '[本文が空] Discord メッセージの本文が空です。',
    '[EMPTY BODY] The Facebook post body is empty.' => '[本文が空] Facebook 投稿の本文が空です。',
    '[EMPTY BODY] The MQTT payload is empty.' => '[本文が空] MQTT ペイロードが空です。',
    '[EMPTY BODY] The Mastodon post body is empty.' => '[本文が空] Mastodon 投稿の本文が空です。',
    '[EMPTY BODY] The Slack message body is empty.' => '[本文が空] Slack メッセージの本文が空です。',
    '[EMPTY BODY] The X (Twitter) post body is empty.' => '[本文が空] X (Twitter) 投稿の本文が空です。',
    '[EMPTY BODY] The email message body was empty.' => '[本文が空] メール本文が空でした。',
    '[FEED ERROR] Could not fetch the feed: {message}' => '[フィードエラー] フィードを取得できませんでした: {message}',
    '[FEED ERROR] Could not parse the feed.' => '[フィードエラー] フィードを解析できませんでした。',
    '[FEED ERROR] Could not parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => '[フィードエラー] フィードを解析できませんでした。PHP の `simplexml` および `libxml` 拡張機能が必要です。',
    '[FEED ERROR] Initial feed scan failed: {message}' => '[フィードエラー] 最初のフィードスキャンに失敗しました: {message}',
    '[INVALID NUMBER] The recipient phone number is invalid.' => '[無効な番号] 宛先の電話番号が無効です。',
    '[INVALID TYPE] The flash message type is invalid.' => '[無効なタイプ] フラッシュメッセージのタイプが無効です。',
    '[LINK PREVIEW SKIPPED] {reason}' => '[リンクプレビューをスキップ] {reason}',
    '[MISSING IMAGE] Image Attachment field never called the {tag} tag.' => '[画像なし] 画像の添付フィールドが {tag} タグを一度も呼び出しませんでした。',
    '[MISSING IMAGE] Image Attachment field was empty.' => '[画像なし] 画像の添付フィールドが空でした。',
    '[MISSING IMAGE] The {tag} tag was called, but returned an invalid image.' => '[画像なし] {tag} タグが呼び出されましたが、無効な画像が返されました。',
    '[MISSING IMAGE] Unable to send Instagram post, the image needs a public URL.' => '[画像なし] Instagram の投稿を送信できません。画像には公開 URL が必要です。',
    '[NO CALENDAR] No calendars are selected, this notification will never be triggered.' => '[カレンダーなし] カレンダーが選択されていないため、この通知はトリガーされません。',
    '[NO DIGITAL PRODUCT TYPE] No digital product types are selected, this notification will never be triggered.' => '[デジタル製品タイプなし] デジタル製品タイプが選択されていないため、この通知はトリガーされません。',
    '[NO ENTRY TYPE] No sections or entry types are selected, this notification will never be triggered.' => '[エントリタイプなし] セクションまたはエントリタイプが選択されていないため、この通知はトリガーされません。',
    '[NO FORM] No forms are selected, this notification will never be triggered.' => '[フォームなし] フォームが選択されていないため、この通知はトリガーされません。',
    '[NO PRODUCT TYPE] No product types are selected, this notification will never be triggered.' => '[製品タイプなし] 製品タイプが選択されていないため、この通知はトリガーされません。',
    '[NO USER GROUP] No user groups are selected, this notification will never be triggered.' => '[ユーザーグループなし] ユーザーグループが選択されていないため、この通知はトリガーされません。',
    '[NO VOLUME] No volumes are selected, this notification will never be triggered.' => '[ボリュームなし] ボリュームが選択されていないため、この通知はトリガーされません。',
    '[NO MEDIA] No image was attached because the {tag} tag was never invoked in the Image Attachment field.' => '[メディアなし] 画像の添付フィールドで {tag} タグが一度も呼び出されなかったため、画像が添付されませんでした。',
    '[NO RECIPIENTS] The Dynamic Recipients snippet did not call setRecipients.' => '[宛先なし] 動的受信者のスニペットが setRecipients を呼び出しませんでした。',
    '[NO RECIPIENTS] setRecipients was called with an empty value.' => '[宛先なし] setRecipients が空の値で呼び出されました。',
    '[NO RECIPIENT] No MQTT topic was specified.' => '[宛先なし] MQTT のトピックが指定されていません。',
    '[NO RECIPIENT] No Slack channel ID was specified.' => '[宛先なし] Slack のチャンネル ID が指定されていません。',
    '[NO RECIPIENT] No ntfy topic was specified.' => '[宛先なし] ntfy のトピックが指定されていません。',
    '[NO RECIPIENT] No recipient user was specified for the announcement.' => '[宛先なし] お知らせの宛先ユーザーが指定されていません。',
    '[NO RECIPIENT] No recipient was specified for the email.' => '[宛先なし] メールの宛先が指定されていません。',
    '[NO RECIPIENT] The recipient has no Pushover user key.' => '[宛先なし] 宛先に Pushover のユーザーキーがありません。',
    '[NO RECIPIENT] The recipient has no phone number.' => '[宛先なし] 宛先に電話番号がありません。',
    '[REJECTED BY DISCORD] {error}' => '[拒否: DISCORD] {error}',
    '[REJECTED BY FACEBOOK] {error}' => '[拒否: FACEBOOK] {error}',
    '[REJECTED BY INSTAGRAM] {error}' => '[拒否: INSTAGRAM] {error}',
    '[REJECTED BY MASTODON] {error}' => '[拒否: MASTODON] {error}',
    '[REJECTED BY SLACK] {error}' => '[拒否: SLACK] {error}',
    '[REJECTED BY X (TWITTER)] {error}' => '[拒否: X (TWITTER)] {error}',
    '[SEND FAILED] Authentication failed for {handle}: {reason}' => '[送信失敗] {handle} の認証に失敗しました: {reason}',
    '[SEND FAILED] Authentication failed: {reason}' => '[送信失敗] 認証に失敗しました: {reason}',
    "[SEND FAILED] Could not send the email using Craft's native handling. Check your general email settings within Craft." => '[送信失敗] Craft のネイティブ処理ではメールを送信できませんでした。Craft の一般メール設定を確認してください。',
    '[SEND FAILED] HTTP {status}: {reason}' => '[送信失敗] HTTP {status}: {reason}',
    '[SEND FAILED] {error}' => '[送信失敗] {error}',
    '[SEND FAILED] {reason}' => '[送信失敗] {reason}',
    '[SKIPPED] Pushover user-key field is not configured on this notification.' => '[スキップ] この通知では Pushover ユーザーキーのフィールドが設定されていません。',
    '[SKIPPED] Recipient "{name}" cannot access the control panel.' => '[スキップ] 宛先「{name}」はコントロールパネルにアクセスできません。',
    '[SKIPPED] Recipient "{name}" has no Bluesky credentials.' => '[スキップ] 宛先「{name}」にBluesky の認証情報がありません。',
    '[SKIPPED] Recipient "{name}" has no Craft user account.' => '[スキップ] 宛先「{name}」には Craft のユーザーアカウントがありません。',
    '[SKIPPED] Recipient "{name}" has no Discord webhook URL.' => '[スキップ] 宛先「{name}」にDiscord Webhook URLがありません。',
    '[SKIPPED] Recipient "{name}" has no Facebook credentials.' => '[スキップ] 宛先「{name}」にFacebook の認証情報がありません。',
    '[SKIPPED] Recipient "{name}" has no Instagram credentials.' => '[スキップ] 宛先「{name}」にInstagram の認証情報がありません。',
    '[SKIPPED] Recipient "{name}" has no MQTT topic.' => '[スキップ] 宛先「{name}」にMQTT トピックがありません。',
    '[SKIPPED] Recipient "{name}" has no Mastodon credentials.' => '[スキップ] 宛先「{name}」にMastodon の認証情報がありません。',
    '[SKIPPED] Recipient "{name}" has no Slack bot token.' => '[スキップ] 宛先「{name}」にSlack ボットトークンがありません。',
    '[SKIPPED] Recipient "{name}" has no Slack channel ID.' => '[スキップ] 宛先「{name}」にSlack チャンネル IDがありません。',
    '[SKIPPED] Recipient "{name}" has no X (Twitter) credentials.' => '[スキップ] 宛先「{name}」にX (Twitter) の認証情報がありません。',
    '[SKIPPED] Recipient "{name}" has no email address.' => '[スキップ] 宛先「{name}」にメールアドレスがありません。',
    '[SKIPPED] Recipient "{name}" has no ntfy topic.' => '[スキップ] 宛先「{name}」にntfy トピックがありません。',
    '[SKIPPED] Recipient "{name}" has no phone number.' => '[スキップ] 宛先「{name}」に電話番号がありません。',
    '[SKIPPED] The configured {kind} no longer exists in the plugin settings (uid: {uid}).' => '[スキップ] 設定された {kind} はプラグイン設定に存在しません (uid: {uid})。',
    '[SKIPPED] Unrecognized recipient "{value}".' => '[スキップ] 認識できない宛先「{value}」。',
    '[SKIPPED] Unrecognized recipient of type "{type}".' => '[スキップ] 認識できない宛先タイプ「{type}」。',
    '[TOO LONG] The Discord message body exceeds the 2000-character limit.' => '[長すぎます] Discord メッセージの本文が 2000 文字の上限を超えています。',
    '[TRUNCATED] Body exceeded {max} characters.' => '[切り詰め] 本文が {max} 文字を超えました。',
    '[TRUNCATED] Caption exceeded {max} characters.' => '[切り詰め] キャプションが {max} 文字を超えました。',
];
