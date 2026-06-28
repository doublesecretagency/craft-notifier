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
    'Notifications' => 'Bildirimler',
    'Notification' => 'Bildirim',
    'All notifications' => 'Tüm bildirimler',
    'Notification Log' => 'Bildirim günlüğü',
    'Logs' => 'Günlükler',
    'View Notifications' => 'Bildirimleri görüntüle',
    'Add a New Notification' => 'Yeni bir bildirim ekle',
    'notification' => 'bildirim',

    // Permissions
    'View notifications' => 'Bildirimleri görüntüle',
    'Save notifications' => 'Bildirimleri kaydet',
    'Use the Dynamic Recipients type' => 'Dinamik Alıcılar türünü kullan',
    'Use the Dynamic Data type' => 'Dinamik Veri türünü kullan',
    'Test notifications' => 'Bildirimleri test et',
    'Send manual notifications' => 'Manuel bildirim gönder',
    'Delete notifications' => 'Bildirimleri sil',
    'View notification log' => 'Bildirim günlüğünü görüntüle',
    'Delete notification log' => 'Bildirim günlüğünü sil',

    // ========================================================
    // NOTIFICATION EDITOR
    // ========================================================

    // Editor: tabs
    'Meta' => 'Meta',
    'Event' => 'Olay',
    'Message' => 'Mesaj',
    'Recipients' => 'Alıcılar',

    // Event tab: type selector
    'Event Type' => 'Olay türü',
    'What type of event will activate the notification?' => 'Hangi tür olay bildirimi etkinleştirecek?',
    'Which specific event will activate the notification?' => 'Hangi belirli olay bildirimi etkinleştirecek?',

    // Event tab: event types
    'Assets Event' => 'Varlık olayı',
    'Commerce Orders Event' => 'Commerce sipariş olayı',
    'Commerce Products Event' => 'Commerce ürün olayı',
    'Digital Products Event' => 'Digital Products olayı',
    'Digital Product Licenses Event' => 'Digital Products lisans olayı',
    'Solspace Calendar Event' => 'Solspace Calendar olayı',
    'Entries Event' => 'Giriş olayı',
    'Users Event' => 'Kullanıcı olayı',
    'Ungrouped Users' => 'Grupsuz kullanıcılar',

    // Event tab: Feed
    'Feed URL' => "Besleme URL'si",
    'The URL of the RSS, Atom, or JSON feed to watch.' => "İzlenecek RSS, Atom veya JSON beslemesinin URL'si.",

    // Event tab: field conditions
    'Field Conditions' => 'Alan koşulları',
    'Send the message only when the saved element matches the following conditions.' => 'Mesajı yalnızca kaydedilen öğe aşağıdaki koşulları karşıladığında gönder.',
    'has changed' => 'değişti',

    // Event tab: element filters (panel chrome + common output)
    '#{elementType} Event Filters' => '#{elementType} olay filtreleri',
    'No filters match this event.' => 'Bu olayla eşleşen filtre yok.',
    'Determine whether each message should be sent based on specified conditions.' => 'Belirtilen koşullara göre her mesajın gönderilip gönderilmeyeceğini belirleyin.',
    'Unnamed filter' => 'Adsız filtre',
    'Must be TRUE to send message' => 'Mesajı göndermek için TRUE olmalı',
    'Must be FALSE to send message' => 'Mesajı göndermek için FALSE olmalı',
    'No effect' => 'Etkisiz',

    // Event tab: element filter rules
    'Element is being saved for the first time' => 'Öğe ilk kez kaydediliyor',
    'Must be a new entry' => 'Yeni bir giriş olmalı',
    'Must be an existing entry' => 'Mevcut bir giriş olmalı',
    'Can be existing or new' => 'Mevcut veya yeni olabilir',
    'Element is new' => 'Öğe yeni',
    'New elements only' => 'Yalnızca yeni öğeler',
    'Existing elements only' => 'Yalnızca mevcut öğeler',
    'Element is enabled' => 'Öğe etkin',
    'Must be enabled' => 'Etkin olmalı',
    'Must be disabled' => 'Devre dışı olmalı',
    'Can be enabled or disabled' => 'Etkin veya devre dışı olabilir',
    'Element is a draft' => 'Öğe taslak',
    'Must be a draft' => 'Taslak olmalı',
    'Must not be a draft' => 'Taslak olmamalı',
    'Can be a draft or non-draft' => 'Taslak veya taslak olmayan olabilir',
    'Element is a provisional draft' => 'Öğe geçici taslak',
    'Must be a provisional draft' => 'Geçici taslak olmalı',
    'Must not be a provisional draft' => 'Geçici taslak olmamalı',
    'Can be a provisional draft or non-provisional' => 'Geçici taslak veya değil olabilir',
    'Element is a revision' => 'Öğe revizyon',
    'Must be a revision' => 'Revizyon olmalı',
    'Must not be a revision' => 'Revizyon olmamalı',
    'Can be a revision or non-revision' => 'Revizyon veya revizyon olmayan olabilir',
    'Element is being duplicated' => 'Öğe çoğaltılıyor',
    'Must be duplicating the element' => 'Öğeyi çoğaltıyor olmalı',
    'Must not be duplicating the element' => 'Öğeyi çoğaltıyor olmamalı',
    'Element is being propagated' => 'Öğe yayılıyor',
    'Element must be propagating' => 'Öğe yayılıyor olmalı',
    'Element must not be propagating' => 'Öğe yayılıyor olmamalı',
    'Element is being bulk-resaved' => 'Öğe toplu olarak yeniden kaydediliyor',
    'Must be bulk-resaving the element' => 'Öğeyi toplu olarak yeniden kaydediyor olmalı',
    'Must not be bulk-resaving the element' => 'Öğeyi toplu olarak yeniden kaydediyor olmamalı',

    // Event tab: date trigger
    'On' => 'Tarihinde',
    'days before' => 'gün önce',
    'days after' => 'gün sonra',
    'Relevant Date' => 'İlgili Tarih',
    'Send the notification relative to a chosen date.' => 'Bildirimi seçilen bir tarihe göre gönderin.',

    // Event tab: recurring schedule
    'Every' => 'Her',
    'on' => 'günü',
    'on day' => 'ayın günü',
    'at' => 'saat',
    'Starting on' => 'Başlangıç',
    'Day' => 'Gün',
    'Date' => 'Tarih',
    'Time' => 'Saat',
    'day(s)' => 'gün',
    'week(s)' => 'hafta',
    'month(s)' => 'ay',
    'year(s)' => 'yıl',
    'day' => 'gün',
    'days' => 'gün',
    'week' => 'hafta',
    'weeks' => 'hafta',
    'month' => 'ay',
    'months' => 'ay',
    'year' => 'yıl',
    'years' => 'yıl',
    'Manual only' => 'Yalnızca manuel',
    'Scheduled sending' => 'Zamanlanmış gönderim',
    'Generate report on a recurring schedule' => 'Yinelenen bir zamanlamayla rapor oluştur',
    'Generate report on demand' => 'İstek üzerine rapor oluştur',
    'Send on a Recurring Schedule' => 'Yinelenen bir zamanlamayla gönder',
    'Configure Recurring Schedule' => 'Yinelenen zamanlamayı yapılandır',
    'System timezone set to {timezone}' => 'Sistem saat dilimi {timezone} olarak ayarlandı',
    'Notifications will be sent on the following schedule...' => 'Bildirimler aşağıdaki zamanlamayla gönderilecek...',
    '... and every {cadence} after that.' => '... ve sonrasında her {cadence}.',
    'On what recurring schedule should the notification be sent?' => 'Bildirim hangi yinelenen zamanlamayla gönderilsin?',
    'Whether the message should be sent on a schedule, or only triggered manually.' => 'Mesajın bir zamanlamayla mı gönderileceği yoksa yalnızca manuel olarak mı tetikleneceği.',
    'The message can always be sent using the "Send system snapshot" button above.' => 'Mesaj her zaman yukarıdaki "Sistem anlık görüntüsü gönder" düğmesiyle gönderilebilir.',
    'The message can always be sent using the "Send data report" button above.' => 'Mesaj her zaman yukarıdaki "Veri raporu gönder" düğmesiyle gönderilebilir.',

    // Event tab: Dynamic Data snippet field
    'Twig Snippet to Determine Data' => 'Veriyi belirleyecek Twig parçacığı',
    'Enter a custom Twig snippet to [determine which data will be included]({url}).' => '[Hangi verilerin dahil edileceğini belirlemek]({url}) için özel bir Twig parçacığı girin.',
    'The snippet **must** include a `{% setData %}` tag.' => 'Parçacık **mutlaka** bir `{% setData %}` etiketi içermelidir.',
    'You do not have permission to edit dynamic data.' => 'Dinamik verileri düzenleme izniniz yok.',

    // Event tab: manual trigger
    'Trigger Label' => 'Tetikleyici etiketi',
    'An element action label (helps to differentiate multiple triggers).' => 'Öge eylemi etiketi (birden fazla tetikleyiciyi ayırt etmeye yardımcı olur).',
    'Send Notification' => 'Bildirim gönder',

    // Message tab: type selector
    'Message Type' => 'Mesaj türü',
    'What type of message will be sent?' => 'Hangi tür mesaj gönderilecek?',
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are supported.' => '[Şablonlama]({templatingUrl}) ve [özel değişkenler]({variablesUrl}) desteklenir.',

    // Details sidebar: queue
    'Use Queue' => 'Kuyruğu kullan',
    'Immediate' => 'Hemen',
    'Queue' => 'Kuyruk',
    'jobs queue' => 'iş kuyruğuna',
    'Whether the message will be sent immediately, or added to the {link}.' => 'Mesaj hemen mi gönderilsin, yoksa {link} mı eklensin.',
    'Flash messages never use the queue.' => 'Flash mesajları kuyruğu asla kullanmaz.',
    'Announcements always use the queue.' => 'Duyurular her zaman kuyruğu kullanır.',

    // Message tab: Email
    "User's Email Address Field" => 'Kullanıcı e-posta adresi alanı',
    'Select which User field contains the recipient\'s email address.' => 'Alıcının e-posta adresini içeren kullanıcı alanını seçin.',
    'Email Subject' => 'E-posta konusu',
    'Subject line of the email.' => 'E-postanın konu satırı.',
    'Dynamic Subject Line' => 'Dinamik Konu Satırı',
    'Email Body' => 'E-posta gövdesi',
    'Body of the email. Supports HTML.' => 'E-postanın gövdesi. HTML\'i destekler.',

    // Message tab: rich-text (Trix) toolbar
    'Rich Text' => 'Zengin metin',
    'Bold' => 'Kalın',
    'Italic' => 'İtalik',
    'Underline' => 'Altı çizili',
    'Strikethrough' => 'Üstü çizili',
    'Bullets' => 'Madde işaretleri',
    'Numbers' => 'Numaralandırma',
    'Heading' => 'Başlık',
    'Code' => 'Kod',
    'Undo' => 'Geri al',
    'Redo' => 'Yinele',

    // Message tab: SMS
    "User's Phone Number Field" => 'Kullanıcı telefon numarası alanı',
    'Select which User field contains the recipient\'s phone number.' => 'Alıcının telefon numarasını içeren kullanıcı alanını seçin.',
    'SMS Message Body' => 'SMS mesaj gövdesi',
    'Body of the SMS (text message). Plain text only.' => 'SMS (kısa mesaj) gövdesi. Yalnızca düz metin.',

    // Message tab: Announcement
    'Announcement Title' => 'Duyuru başlığı',
    'Heading of the announcement.' => 'Duyurunun başlığı.',
    'Dynamic Announcement Title' => 'Dinamik Duyuru Başlığı',
    'Announcement Message' => 'Duyuru mesajı',
    'Body of the announcement. Supports Markdown.' => 'Duyurunun gövdesi. Markdown\'ı destekler.',

    // Message tab: Flash
    'Flash Message Type' => 'Flash mesaj türü',
    'Which type of flash message should appear?' => 'Hangi tür flash mesaj görünmeli?',
    'Flash Message Title' => 'Flash mesaj başlığı',
    'Heading of the flash message.' => 'Flash mesajının başlığı.',
    'Dynamic Flash Message Title' => 'Dinamik Flash Mesaj Başlığı',
    'Flash Message Details' => 'Flash mesaj ayrıntıları',
    'Optionally include details below the heading. Supports Markdown and HTML.' => 'İsteğe bağlı olarak başlığın altına ayrıntı ekleyin. Markdown ve HTML\'i destekler.',

    // Message tab: Pushover
    "Field containing each user's Pushover key" => 'Kullanıcının Pushover anahtar alanı',
    'Select which User field contains the recipient\'s Pushover user key.' => 'Alıcının Pushover anahtarını içeren kullanıcı alanını seçin.',
    'Pushover Title' => 'Pushover Başlık',
    'Optionally include a heading above the body.' => 'İsteğe bağlı olarak gövdenin üstüne bir başlık ekleyin.',
    'Dynamic Pushover Title' => 'Dinamik Pushover Başlık',
    'Pushover Body' => 'Pushover Gövde',
    'Body of the Pushover notification. Plain text only.' => 'Pushover bildiriminin gövdesi. Yalnızca düz metin.',

    // Message tab: ntfy
    'Priority' => 'Öncelik',
    'Priority level of the ntfy message.' => 'ntfy mesajının öncelik seviyesi.',
    'Tags' => 'Etiketler',
    'Optionally include comma-separated [emoji shortcodes](https://docs.ntfy.sh/emojis/).' => 'İsteğe bağlı olarak virgülle ayrılmış [emoji kısa kodları](https://docs.ntfy.sh/emojis/) ekleyin.',
    'ntfy Title' => 'ntfy Başlık',
    'Dynamic ntfy Title' => 'Dinamik ntfy Başlık',
    'ntfy Body' => 'ntfy Gövde',
    'Body of the ntfy notification.' => 'ntfy bildiriminin gövdesi.',
    'ntfy Link URL' => 'ntfy Bağlantı URL\'si',
    'Optionally open a URL when the notification is clicked.' => 'İsteğe bağlı olarak, bildirime tıklandığında bir URL açın.',
    'Enable Markdown' => 'Markdown\'ı etkinleştir',
    'Whether to parse the body as Markdown in supported clients.' => 'Gövdenin desteklenen istemcilerde Markdown olarak işlenip işlenmeyeceği.',
    'Regular text only' => 'Yalnızca düz metin',
    'Markdown enabled' => 'Markdown etkin',

    // Message tab: Slack
    'Slack Message Body' => 'Slack mesaj gövdesi',
    'Supports standard [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) syntax. Optionally supports HTML _(see below)_.' => 'Standart [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) sözdizimini destekler. Opsiyonel olarak HTML\'i destekler _(aşağıya bakın)_.',
    'Render Message Body as HTML' => 'Mesaj gövdesini HTML olarak işle',
    'Whether to only parse as [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), or additionally parse it as HTML.' => 'Yalnızca [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) olarak mı yoksa ayrıca HTML olarak da mı işlensin.',
    'Render Link Previews' => 'Bağlantı önizlemelerini göster',
    'Whether Slack should unfurl link previews for URLs in the message body.' => "Slack'in mesaj gövdesindeki URL'ler için bağlantı önizlemelerini gösterip göstermeyeceği.",
    'Don\'t unfurl' => 'Genişletme',
    'Expand link previews' => 'Bağlantı önizlemelerini genişlet',
    'Bot Name' => 'Kullanıcı Adı',
    'Optionally override the app\'s display name.' => 'İsteğe bağlı olarak uygulamanın görünen adını geçersiz kılın.',
    'Dynamic Bot Name' => 'Dinamik Bot Adı',
    'Bot Icon URL' => "Simge URL'si",
    'Optionally override the app\'s icon with a URL.' => 'İsteğe bağlı olarak uygulamanın simgesini bir URL ile geçersiz kılın.',
    'Bot Emoji' => 'Simge Emojisi',
    'Optionally override the app\'s icon with an emoji. Used only when Bot Icon URL is empty.' => 'İsteğe bağlı olarak uygulamanın simgesini bir emoji ile geçersiz kılın. Yalnızca Bot Icon URL boşken kullanılır.',

    // Message tab: Discord
    'Discord Message Body' => 'Discord Mesaj Gövdesi',
    'Supports standard Markdown, and optionally HTML _(see below)_. Max 2000 characters.' => 'Standart Markdown\'ı ve isteğe bağlı olarak HTML\'i destekler _(aşağıya bakın)_. En fazla 2.000 karakter.',
    'Whether to only parse as Markdown, or additionally parse it as HTML.' => 'Yalnızca Markdown olarak mı yoksa ayrıca HTML olarak da mı işlensin.',
    'Markdown only' => 'Yalnızca Markdown',
    'Markdown + HTML' => 'Markdown + HTML',
    'Whether Discord should unfurl link previews for URLs in the message body.' => 'Discord\'un mesaj gövdesindeki URL\'ler için bağlantı önizlemelerini gösterip göstermeyeceği.',
    'Webhook Username' => 'Webhook Kullanıcı Adı',
    'Optionally override the webhook\'s display name.' => 'İsteğe bağlı olarak webhook\'un görünen adını geçersiz kılın.',
    'Dynamic Username' => 'Dinamik Kullanıcı Adı',
    'Webhook Avatar URL' => 'Webhook Avatar URL\'si',
    'Optionally override the webhook\'s avatar with a URL.' => 'İsteğe bağlı olarak webhook\'un avatarını bir URL ile geçersiz kılın.',

    // Message tab: Facebook
    'Message Body' => 'Mesaj gövdesi',
    'The text of your Facebook post.' => 'Facebook gönderinizin metni.',
    'Preview Card URL' => "Önizleme kartı URL'si",
    'Optionally add a link to generate a preview card.' => 'İsteğe bağlı olarak bir önizleme kartı oluşturmak için bir bağlantı ekleyin.',

    // Message tab: Instagram
    'Caption' => 'Açıklama',
    'Image Attachment' => 'Görsel eki',
    'Optional caption, max 2200 characters.' => 'İsteğe bağlı açıklama, en fazla 2.200 karakter.',

    // Message tab: X (Twitter)
    'Plain text, max 280 characters.' => 'Düz metin, en fazla 280 karakter.',

    // Message tab: Media
    'Attach an image by calling `{% setMedia %}` in a [custom Twig snippet]({url}).' => 'Bir [özel Twig parçacığında]({url}) `{% setMedia %}` çağırarak bir görüntü ekleyin.',

    // Message tab: Bluesky
    'Post Body' => 'Gönderi gövdesi',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => 'Düz metin, en fazla 300 karakter. URL\'ler ve `@handle.tld` etiketlemeleri otomatik olarak bağlantıya dönüşür.',
    'Generate Link Preview' => 'Bağlantı önizlemesi oluştur',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => 'Gönderi gövdesinde bir URL olduğunda otomatik olarak önizleme kartı oluşturur.',
    'No card' => 'Kart yok',
    'Generate preview card' => 'Önizleme kartı oluştur',

    // Message tab: Mastodon
    'Plain text, max 500 characters. URLs will unfurl automatically.' => 'Düz metin, en fazla 500 karakter. URL\'ler otomatik olarak açılır.',
    'Visibility' => 'Görünürlük',
    'Who will be able to see this post?' => 'Bu gönderiyi kimler görebilir?',

    // Message tab: LinkedIn
    'LinkedIn' => 'LinkedIn',
    'The text of your LinkedIn post.' => 'LinkedIn gönderinizin metni.',

    // Message tab: MQTT
    'Payload' => 'Yük',
    'The JSON or plain text message published to the MQTT topic.' => 'MQTT konusunda yayınlanan JSON veya düz metin mesajı.',
    'Quality of Service' => 'Hizmet kalitesi',
    'Delivery guarantee for this message.' => 'Bu mesaj için teslim garantisi.',
    'Retain' => 'Sakla',
    'Whether the broker keeps this as the topic\'s last message for future subscribers.' => 'Broker\'ın bunu konunun son mesajı olarak saklayıp gelecekteki abonelere teslim edip etmeyeceği.',
    'Don\'t retain' => 'Saklama',

    // Recipients tab: type selector & user/group pickers
    'Recipients Type' => 'Alıcı türü',
    'Who will receive this message?' => 'Bu mesajı kim alacak?',
    'Add a message recipient' => 'Bir alıcı ekle',
    'Select User(s)' => 'Kullanıcı(lar) seç',
    'Which users will receive the message?' => 'Mesajı hangi kullanıcılar alacak?',
    'Which user groups will receive the message?' => 'Mesajı hangi kullanıcı grupları alacak?',

    // Recipients tab: channel pickers (ntfy, Slack, Discord, Bluesky, Mastodon, MQTT)
    'Select ntfy topic(s)' => 'ntfy konu(ları)nu seç',
    'Which topics should receive this message?' => 'Bu mesajı hangi konular almalı?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'ntfy konusu yapılandırılmamış. [Ayarlar → ntfy]({url}) bölümünden bir tane ekleyin.',
    'No ntfy topics configured. Topics can only be added in an environment that allows administrative changes.' => 'ntfy konusu yapılandırılmamış. Konular yalnızca yönetimsel değişikliklere izin veren bir ortamda eklenebilir.',
    'Select Slack channel(s)' => 'Slack kanal(lar)ı seç',
    'Which channels should receive this message?' => 'Bu mesajı hangi kanallar almalı?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Slack kanalı yapılandırılmamış. [Ayarlar → Slack]({url}) bölümünden bir tane ekleyin.',
    'No Slack channels configured. Channels can only be added in an environment that allows administrative changes.' => 'Slack kanalı yapılandırılmamış. Kanallar yalnızca yönetimsel değişikliklere izin veren bir ortamda eklenebilir.',
    'Select Discord channel(s)' => 'Discord kanal(lar)ı seç',
    'No Discord channels configured. Add one in [Settings → Discord]({url}).' => 'Discord kanalı yapılandırılmamış. [Ayarlar → Discord]({url}) bölümünden bir tane ekleyin.',
    'No Discord channels configured. Channels can only be added in an environment that allows administrative changes.' => 'Discord kanalı yapılandırılmamış. Kanallar yalnızca yönetimsel değişikliklere izin veren bir ortamda eklenebilir.',
    'Select Facebook page(s)' => 'Facebook sayfa(lar)ı seç',
    'Which pages should post this message?' => 'Bu mesajı hangi sayfalar paylaşmalı?',
    'No Facebook pages configured. Add one in [Settings → Facebook]({url}).' => 'Facebook sayfası yapılandırılmamış. [Ayarlar → Facebook]({url}) bölümünden bir tane ekleyin.',
    'No Facebook pages configured. Pages can only be added in an environment that allows administrative changes.' => 'Facebook sayfası yapılandırılmamış. Sayfalar yalnızca yönetimsel değişikliklere izin veren bir ortamda eklenebilir.',
    'Select Instagram account(s)' => 'Instagram hesap(lar)ı seç',
    'No Instagram accounts configured. Add one in [Settings → Instagram]({url}).' => 'Instagram hesabı yapılandırılmamış. [Ayarlar → Instagram]({url}) bölümünden bir tane ekleyin.',
    'No Instagram accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Instagram hesabı yapılandırılmamış. Hesaplar yalnızca yönetimsel değişikliklere izin veren bir ortamda eklenebilir.',
    'Select X (Twitter) account(s)' => 'X (Twitter) hesap(lar)ı seç',
    'No X (Twitter) accounts configured. Add one in [Settings → X (Twitter)]({url}).' => 'X (Twitter) hesabı yapılandırılmamış. [Ayarlar → X (Twitter)]({url}) bölümünden bir tane ekleyin.',
    'No X (Twitter) accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'X (Twitter) hesabı yapılandırılmamış. Hesaplar yalnızca yönetimsel değişikliklere izin veren bir ortamda eklenebilir.',
    'Select Bluesky account(s)' => 'Bluesky hesap(lar)ı seç',
    'Which accounts should post this message?' => 'Bu mesajı hangi hesaplar paylaşmalı?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Bluesky hesabı yapılandırılmamış. [Ayarlar → Bluesky]({url}) bölümünden bir tane ekleyin.',
    'No Bluesky accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Bluesky hesabı yapılandırılmamış. Hesaplar yalnızca yönetimsel değişikliklere izin veren bir ortamda eklenebilir.',
    'Select Mastodon account(s)' => 'Mastodon hesap(lar)ı seç',
    'No Mastodon accounts configured. Add one in [Settings → Mastodon]({url}).' => 'Mastodon hesabı yapılandırılmamış. [Ayarlar → Mastodon]({url}) bölümünden bir tane ekleyin.',
    'No Mastodon accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Mastodon hesabı yapılandırılmamış. Hesaplar yalnızca yönetimsel değişikliklere izin veren bir ortamda eklenebilir.',
    'Select MQTT topic(s)' => 'MQTT konularını seçin',
    'No MQTT topics configured. Add one in [Settings → MQTT]({url}).' => 'Yapılandırılmış MQTT konusu yok. [Ayarlar → MQTT]({url}) bölümünden bir tane ekleyin.',
    'No MQTT topics configured. Topics can only be added in an environment that allows administrative changes.' => 'Yapılandırılmış MQTT konusu yok. Konular yalnızca yönetimsel değişikliklere izin veren bir ortamda eklenebilir.',
    'Not a valid topic. Must not be empty or contain the `+` or `#` wildcards.' => 'Geçerli bir konu değil. Boş olamaz veya `+` ya da `#` joker karakterlerini içeremez.',

    // Recipients tab: LinkedIn picker
    'Select LinkedIn account(s)' => 'LinkedIn hesaplarını seçin',
    'Which page or member should post this message?' => 'Bu mesajı hangi sayfa veya üye yayınlamalı?',
    'No LinkedIn accounts connected. Connect one in [Settings → LinkedIn]({url}).' => 'Bağlı LinkedIn hesabı yok. [Ayarlar → LinkedIn]({url}) bölümünden bir tane bağlayın.',
    'No LinkedIn accounts connected. Accounts can only be connected in an environment that allows administrative changes.' => 'Bağlı LinkedIn hesabı yok. Hesaplar yalnızca yönetimsel değişikliklere izin veren bir ortamda bağlanabilir.',

    // Recipients tab: dynamic recipients snippet
    'Twig Snippet to Determine Recipients' => 'Alıcıları belirleyen Twig parçacığı',
    'Enter a custom Twig snippet to [determine who will receive the message]({url}).' => 'Mesajı [kimin alacağını belirlemek]({url}) için özel bir Twig parçacığı girin.',
    'The snippet **must** include a `{% setRecipients %}` tag.' => 'Parçacık **mutlaka** bir `{% setRecipients %}` etiketi içermelidir.',

    // ========================================================
    // SETTINGS
    // ========================================================

    // Settings: nav & page chrome
    'Notifier Settings' => 'Notifier ayarları',
    'General' => 'Genel',
    'Twilio' => 'Twilio',
    'Pushover' => 'Pushover',
    'ntfy' => 'ntfy',
    'Slack' => 'Slack',
    'Discord' => 'Discord',
    'Bluesky' => 'Bluesky',
    'Mastodon' => 'Mastodon',
    'MQTT' => 'MQTT',

    // Settings: nav group headings
    'Push Notifications' => 'Anlık bildirimler',
    'Chat Platforms' => 'Sohbet platformları',
    'Social Media' => 'Sosyal medya',
    'Internet of Things' => 'Nesnelerin interneti',
    'Expand {heading}' => '{heading} bölümünü genişlet',

    // Settings: shared intro lines
    'Consult the [{name} setup guide]({url}) for complete instructions.' => 'Eksiksiz talimatlar için [{name} kurulum kılavuzuna]({url}) bakın.',
    'Sensitive values can be stored in your `.env` file and referenced here.' => 'Hassas değerler `.env` dosyanızda saklanabilir ve buradan referans verilebilir.',

    // Settings: Notification order
    'Notification Order' => 'Bildirim sırası',
    'Notifications can be dragged into any order on the index page. Choose where new notifications land in that order.' => 'Bildirimler dizin sayfasında sürüklenerek özel bir sıraya dizilebilir. Yeni bildirimlerin bu sıraya nereye ekleneceğini seçin.',
    'Default Placement' => 'Varsayılan yerleşim',
    'Where new notifications are added to the list.' => 'Yeni bildirimlerin listeye nereye ekleneceği.',
    'Before other notifications' => 'Diğer bildirimlerden önce',
    'After other notifications' => 'Diğer bildirimlerden sonra',

    // Settings: Logging
    'Logging' => 'Günlüğe kaydetme',
    "Notifier keeps a running log of every message it sends. You usually won't need to change this, but you can limit how many log entries are kept in the database." => 'Notifier gönderilen mesajların sürekli bir günlüğünü tutar. Genellikle gerekli olmasa da veritabanına kaydedilen günlük olaylarının sayısını sınırlayabilirsiniz.',
    'Enable Logging' => 'Günlüğe kaydetmeyi etkinleştir',
    'When disabled, Notifier will not write anything to the notification log.' => 'Devre dışı bırakıldığında, Notifier bildirim günlüğüne hiçbir şey yazmaz.',
    'Number of days to retain log events' => 'Günlük olaylarının saklanacağı gün sayısı',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Günlük olaylarını en fazla bu kadar gün sakla. Sınır olmaması için boş bırakın.',
    'Number of log events to retain' => 'Saklanacak günlük olayı sayısı',
    'At most, keep this many log events. Leave blank for no limit.' => 'En fazla bu kadar günlük olayı sakla. Sınır olmaması için boş bırakın.',

    // Settings: Scheduled sending
    'Scheduled Sending' => 'Zamanlanmış gönderim',
    'A shared secret that authenticates scheduled runs triggered over the web. You only need this if you trigger the schedule from the web endpoint.' => 'Zamanlanmış çalıştırma web isteklerinin kimliğini doğrulamak için paylaşılan gizli anahtar. Yalnızca zamanlama web uç noktası üzerinden tetiklendiğinde gereklidir.',
    'Scheduled-Run Token' => 'Zamanlanmış çalıştırma belirteci',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => 'Her istekle birlikte X-Notifier-Token başlığı veya token gövde parametresi olarak gönderilir.',

    // Settings: Twilio
    'Send SMS text messages through [Twilio](https://www.twilio.com).' => '[Twilio](https://www.twilio.com) üzerinden SMS metin mesajları gönderin.',
    'Twilio Account SID' => 'Twilio Hesap SID',
    'Twilio Auth Token' => 'Twilio Kimlik Doğrulama Anahtarı',
    'Twilio phone number (sends each SMS message)' => "Twilio telefon numarası (her SMS'i gönderir)",
    'SMS Testing' => 'SMS testi',
    'Optional. When set, every SMS is sent to this number instead of the actual recipient.' => 'İsteğe bağlı. Ayarlandığında, gönderilen her SMS gerçek alıcı yerine bu numaraya iletilir.',
    'Test phone number' => 'Test telefon numarası',

    // Settings: Pushover
    'Send push notifications through [Pushover](https://pushover.net).' => '[Pushover](https://pushover.net) üzerinden anlık bildirimler gönderin.',
    'Application API Token' => 'Uygulama API anahtarı',
    'The 30-character app token from your Pushover application.' => 'Pushover uygulamanızdan 30 karakterli uygulama anahtarı.',

    // Settings: ntfy
    'Send push notifications through [ntfy](https://ntfy.sh).' => '[ntfy](https://ntfy.sh) üzerinden anlık bildirimler gönderin.',
    'Server URL' => "Sunucu URL'si",
    'Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`.' => 'İsteğe bağlı, kendi sunucunuzda barındırdığınız bir ntfy örneğini gösterin (geçerliyse). Varsayılan `https://ntfy.sh`.',
    'Access token' => 'Erişim anahtarı',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'İsteğe bağlı, korumalı konular veya kimlik doğrulamalı kendi sunucunuzda barındırdığınız örnekler için gereklidir.',
    'ntfy Topics' => 'ntfy konuları',
    'Add the ntfy topics you want to send to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Mesaj göndermek istediğiniz ntfy konularını ekleyin. Bir bildirim yapılandırırken her konu **Alıcılar** sekmesinde alıcı olarak kullanılabilir hale gelir.',
    'Topics' => 'Konular',
    "Click any row's **Test** button to send a quick test message to that topic." => 'O konuya hızlı bir test mesajı göndermek için herhangi bir satırın **Test** düğmesine tıklayın.',
    'Label' => 'Etiket',
    'Topic' => 'Konu',
    'Add a topic' => 'Bir konu ekle',

    // Settings: Slack
    'Post messages to your Slack channels.' => 'Slack kanallarınıza mesaj gönderin.',
    'Channels' => 'Kanallar',
    "Click any row's **Test** button to send a quick test message to that channel." => 'O kanala hızlı bir test mesajı göndermek için herhangi bir satırın **Test** düğmesine tıklayın.',
    'Bot Token' => 'Bot Belirteci',
    'Channel ID' => 'Kanal Kimliği',
    'Add a channel' => 'Bir kanal ekle',
    'Not a valid Bot Token. Must start with `xoxb-`.' => 'Geçerli bir Bot Belirteci değil. `xoxb-` ile başlamalıdır.',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => 'Geçerli bir Kanal Kimliği değil. `C01234ABCD` gibi görünmelidir.',

    // Settings: Discord
    'Post messages to your Discord channels.' => 'Discord kanallarınıza mesaj gönderin.',
    'Webhook URL' => 'Webhook URL',
    'Not a valid Webhook URL. Must start with `https://discord.com/api/webhooks/`.' => 'Geçerli bir Webhook URL\'si değil. `https://discord.com/api/webhooks/` ile başlamalıdır.',

    // Settings: Facebook
    'Facebook' => 'Facebook',
    'Publish posts to your [Facebook](https://facebook.com) pages.' => '[Facebook](https://facebook.com) sayfalarınıza gönderi yayınlayın.',
    'Pages' => 'Sayfalar',
    'Page ID' => 'Page ID',
    'Page Access Token' => 'Page Access Token',
    'Add a page' => 'Bir sayfa ekle',
    "Click any row's **Test** button to verify that page's credentials. No posts are made." => 'O sayfanın kimlik bilgilerini doğrulamak için herhangi bir satırın **Test** düğmesine tıklayın. Hiçbir gönderi yapılmaz.',

    // Settings: Instagram
    'Instagram' => 'Instagram',
    'Publish posts to your [Instagram](https://instagram.com) Business accounts.' => '[Instagram](https://instagram.com) Business hesaplarınıza gönderi yayınlayın.',
    "Click any row's **Test** button to resolve the linked Instagram account. No posts are made." => 'Bağlı Instagram hesabını çözümlemek için herhangi bir satırın **Test** düğmesine tıklayın. Hiçbir gönderi yapılmaz.',

    // Settings: X (Twitter)
    'X (Twitter)' => 'X (Twitter)',
    'Publish posts to your [X (Twitter)](https://x.com) accounts.' => '[X (Twitter)](https://x.com) hesaplarınıza gönderi yayınlayın.',
    'Consumer Key' => 'Consumer Key',
    'Consumer Key Secret' => 'Consumer Key Secret',
    'Access Token Secret' => 'Access Token Secret',

    // Settings: Bluesky
    'Publish posts to your [Bluesky](https://bsky.app) accounts.' => '[Bluesky](https://bsky.app) hesaplarınıza gönderi yayınlayın.',
    'PDS URL' => "PDS URL'si",
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => "Varsayılan https://bsky.social. Kurulumunuz federasyon yapıyorsa özel bir PDS'i gösterin.",
    'Bluesky Accounts' => 'Bluesky hesapları',
    'Add the Bluesky accounts you want to post from. Each account becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Gönderim yapmak istediğiniz Bluesky hesaplarını ekleyin. Bir bildirim yapılandırırken her hesap **Alıcılar** sekmesinde alıcı olarak kullanılabilir hale gelir.',
    'Accounts' => 'Hesaplar',
    "Click any row's **Test** button to confirm the account authenticates." => 'Hesabın kimlik doğrulamasından geçtiğini onaylamak için herhangi bir satırın **Test** düğmesine tıklayın.',
    'Handle' => 'Tanıtıcı',
    'App password' => 'Uygulama parolası',
    'Add an account' => 'Bir hesap ekle',

    // Settings: Mastodon
    'Publish posts to your [Mastodon](https://joinmastodon.org) accounts.' => '[Mastodon](https://joinmastodon.org) hesaplarınıza gönderi yayınlayın.',
    'Click any row\'s **Test** button to verify that account\'s credentials. No posts are made.' => 'O hesabın kimlik bilgilerini doğrulamak için herhangi bir satırın **Test** düğmesine tıklayın. Hiçbir gönderi yapılmaz.',
    'Instance URL' => 'Instance URL',
    'Access Token' => 'Erişim Belirteci',

    // Settings: LinkedIn
    'Publish posts to your [LinkedIn](https://linkedin.com) profile.' => '[LinkedIn](https://linkedin.com) profilinize gönderi yayınlayın.',
    'The Client ID of your LinkedIn app.' => 'LinkedIn uygulamanızın İstemci Kimliği.',
    'Client Secret' => 'İstemci Gizli Anahtarı',
    'The Primary Client Secret of your LinkedIn app.' => 'LinkedIn uygulamanızın Birincil İstemci Gizli Anahtarı.',
    'Enable organization posting' => 'Kuruluş gönderimini etkinleştir',
    'Copy this redirect URL' => 'Bu yönlendirme URL\'sini kopyalayın',
    'When configuring the LinkedIn app, <strong>copy this URL</strong> to use as an "Authorized redirect URL".' => 'LinkedIn uygulamasını yapılandırırken <strong>bu URL\'yi kopyalayın</strong> ve "Authorized redirect URL" olarak kullanın.',
    'Also request access to post as organization pages you administer. Requires Community Management API approval from LinkedIn.' => 'Yönettiğiniz kuruluş sayfaları olarak gönderi yapmak için de erişim isteyin. LinkedIn\'den Community Management API onayı gerektirir.',
    'Connections' => 'Bağlantılar',
    'Each connection becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Bir bildirim ayarladığınızda her bağlantı **Alıcılar** sekmesinde alıcı olarak kullanılabilir hale gelir.',
    'Account' => 'Hesap',
    'Type' => 'Tür',
    'Status' => 'Durum',
    'Organization' => 'Kuruluş',
    'Member' => 'Üye',
    'Reconnect needed' => 'Yeniden bağlanma gerekli',
    'Expires' => 'Sona eriyor',
    'Connected' => 'Bağlandı',
    'Disconnect' => 'Bağlantıyı kes',
    'No LinkedIn accounts are connected yet.' => 'Henüz bağlı LinkedIn hesabı yok.',
    'Connect to LinkedIn' => 'LinkedIn\'e bağlan',
    'Provide valid credentials to connect with LinkedIn.' => 'LinkedIn\'e bağlanmak için geçerli kimlik bilgileri girin.',
    'Disconnect this LinkedIn account?' => 'Bu LinkedIn hesabının bağlantısı kesilsin mi?',

    // Settings: MQTT
    'Publish messages to an MQTT broker, handy for IoT and home-automation setups.' => 'Bir MQTT aracısına (broker) mesaj yayınlayın; IoT ve ev otomasyonu kurulumları için kullanışlıdır.',
    'Host' => 'Ana bilgisayar',
    'Broker hostname, without a protocol or port.' => 'Protokol veya port olmadan broker ana bilgisayar adı.',
    'Port' => 'Port',
    'Optional. Defaults to 8883 when TLS is enabled, otherwise 1883.' => 'İsteğe bağlı. TLS etkinken varsayılan 8883, aksi takdirde 1883\'tür.',
    'Use TLS' => 'TLS Kullan',
    'Whether to connect to the broker over a secure TLS socket.' => 'Broker\'a güvenli bir TLS soketi üzerinden bağlanılıp bağlanılmayacağı.',
    'Username' => 'Kullanıcı adı',
    'Optional, for brokers that require username/password authentication.' => 'İsteğe bağlı, kullanıcı adı/parola kimlik doğrulaması gerektiren broker\'lar için.',
    'Password' => 'Parola',
    'MQTT Version' => 'MQTT Sürümü',
    'Protocol version sent to the broker.' => 'Broker\'a gönderilen protokol sürümü.',
    'Client ID' => 'İstemci Kimliği',
    'Optional. A unique client ID is generated automatically when left blank.' => 'İsteğe bağlı. Boş bırakıldığında benzersiz bir istemci kimliği otomatik olarak oluşturulur.',
    'Mutual TLS' => 'Karşılıklı TLS',
    'Optional. Needed for brokers that authenticate clients with certificates, such as AWS IoT Core. Enter the server file paths to your certificate files. You can use a `.env` variable or `@alias` reference.' => 'İsteğe bağlı. AWS IoT Core gibi istemcileri sertifikalarla doğrulayan broker\'lar için gereklidir. Sertifika dosyalarına sunucu dosya yollarını belirtin (bir `.env` değişkeni veya `@alias` referansı kullanılabilir).',
    'CA Certificate File' => 'CA Sertifika Dosyası',
    'Path to the certificate authority (CA) file.' => 'Sertifika yetkilisi (CA) dosyasının yolu.',
    'Client Certificate File' => 'İstemci Sertifika Dosyası',
    'Path to the client certificate file.' => 'İstemci sertifika dosyasının yolu.',
    'Client Key File' => 'İstemci Anahtar Dosyası',
    'Path to the client private key file.' => 'İstemcinin özel anahtar dosyasının yolu.',
    'MQTT Topics' => 'MQTT Konuları',
    'Add the MQTT topics you want to publish to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Yayın yapmak istediğiniz MQTT konularını ekleyin. Bir bildirim yapılandırırken her konu **Alıcılar** sekmesinde alıcı olarak kullanılabilir hale gelir.',
    'Click any row\'s **Test** button to publish a quick test message to that topic.' => 'O konuya hızlı bir test mesajı yayınlamak için herhangi bir satırın **Test** düğmesine tıklayın.',

    // ========================================================
    // MANUAL SEND & TEST
    // ========================================================

    // Manual send & test
    'Send a test message' => 'Bir test mesajı gönder',
    'Send a REAL test notification?\\n\\n⚠️ Uses a random sample of real data.\\n⚠️ Sends a real message via the configured channel.\\n⚠️ Delivers to the real configured recipient(s).' => 'GERÇEK bir test bildirimi gönderilsin mi?\\n\\n⚠️ Gerçek verilerden rastgele bir örnek kullanır.\\n⚠️ Yapılandırılmış kanal üzerinden gerçek bir mesaj gönderir.\\n⚠️ Gerçek yapılandırılmış alıcılara teslim edilir.',
    'Test' => 'Test',
    'Send system snapshot' => 'Sistem anlık görüntüsü gönder',
    'Send data report' => 'Veri raporu gönder',
    'Are you sure you want to send this notification?' => 'Bu bildirimi göndermek istediğinizden emin misiniz?',
    'This notification cannot be triggered manually.' => 'Bu bildirim manuel olarak tetiklenemez.',
    'This notification no longer applies to the selected element.' => 'Bu bildirim artık seçili öğeye uygulanmıyor.',

    // ========================================================
    // RUNTIME OUTPUT
    // ========================================================

    // Runtime: dispatch log feedback
    'Sending {messageType} to {recipient}.' => '{recipient} alıcısına {messageType} gönderiliyor.',
    'Adding message to queue.' => 'Mesaj kuyruğa ekleniyor.',
    'Sending message immediately (bypassing queue).' => 'Mesaj hemen gönderiliyor (kuyruk atlanıyor).',

    // Runtime: controller responses
    'Test notification dispatched.' => 'Test bildirimi gönderildi.',
    'No messages were dispatched. Check the recipient configuration.' => 'Hiçbir mesaj gönderilmedi. Alıcı yapılandırmasını kontrol edin.',
    'Unable to send test: the feed could not be read or has no items.' => 'Test gönderilemiyor: akış okunamadı veya öğe içermiyor.',
    'Unable to send test: no element matches the configured filters.' => 'Test gönderilemiyor: yapılandırılan filtrelerle eşleşen öğe yok.',
    "Couldn't save settings." => 'Ayarlar kaydedilemedi.',
    'Settings saved.' => 'Ayarlar kaydedildi.',
    'Topic is empty.' => 'Konu boş.',
    'Server URL is not configured.' => "Sunucu URL'si yapılandırılmadı.",
    'Test message from Notifier.' => "Notifier'dan test mesajı.",
    'HTTP {status}' => 'HTTP {status}',
    'Test message sent successfully.' => 'Test mesajı başarıyla gönderildi.',
    'Page ID and Page Access Token are required.' => 'Page ID ve Page Access Token gereklidir.',
    'Facebook rejected the request: {error}' => 'Facebook isteği reddetti: {error}',
    'Successfully connected to "{name}". No posts were made.' => '"{name}" hesabına başarıyla bağlanıldı. Hiçbir gönderi yapılmadı.',
    'No Instagram Business account is linked to this Page.' => 'Bu sayfaya bağlı bir Instagram Business hesabı yok.',
    'Successfully connected to @{handle}. No posts were made.' => '@{handle} hesabına başarıyla bağlanıldı. Hiçbir gönderi yapılmadı.',
    'All four credentials are required.' => 'Dört kimlik bilgisinin tamamı gereklidir.',
    'X (Twitter) rejected the request: {error}' => 'X (Twitter) isteği reddetti: {error}',
    'Successfully authenticated as @{username}. No posts were made.' => '@{username} olarak kimlik doğrulaması başarılı. Hiçbir gönderi yapılmadı.',
    'Handle and app password are required.' => 'Tanıtıcı ve uygulama parolası gerekli.',
    'Authentication failed.' => 'Kimlik doğrulama başarısız.',
    'Successfully authenticated. No messages were posted.' => 'Kimlik doğrulama başarılı. Hiçbir mesaj gönderilmedi.',
    'Log events deleted.' => 'Günlük olayları silindi.',
    'Notification sent.' => 'Bildirim gönderildi.',
    'Notification was not sent. Check the Notification Log for details.' => 'Bildirim gönderilmedi. Ayrıntılar için Bildirim günlüğüne bakın.',
    'Instance URL and access token are required.' => 'Instance URL\'si ve erişim belirteci gereklidir.',
    'Mastodon rejected the request: {error}' => 'Mastodon isteği reddetti: {error}',
    'Successfully authenticated as @{handle}. No posts were made.' => '@{handle} olarak kimlik doğrulaması başarılı. Hiçbir gönderi yapılmadı.',
    'Broker host is not configured.' => 'Broker ana bilgisayarı yapılandırılmadı.',

    // Runtime: LinkedIn connect flow
    'Add your LinkedIn app credentials before connecting.' => 'Bağlanmadan önce LinkedIn uygulama kimlik bilgilerinizi ekleyin.',
    'LinkedIn authorization failed: {error}' => 'LinkedIn yetkilendirmesi başarısız oldu: {error}',
    'LinkedIn authorization failed: invalid state.' => 'LinkedIn yetkilendirmesi başarısız oldu: geçersiz durum.',
    'LinkedIn authorization failed: no code returned.' => 'LinkedIn yetkilendirmesi başarısız oldu: kod döndürülmedi.',
    'Connected to LinkedIn.' => 'LinkedIn\'e bağlanıldı.',
    'Disconnected from LinkedIn.' => 'LinkedIn bağlantısı kesildi.',

    // Outbound: per-channel send results
    'Successfully sent an email to {name}.' => 'E-posta {name} adlı alıcıya başarıyla gönderildi.',
    'Successfully sent an SMS message to {name}.' => 'SMS {name} adlı alıcıya başarıyla gönderildi.',
    'Successfully sent a Pushover notification to {name}.' => 'Pushover bildirimi {name} adlı alıcıya başarıyla gönderildi.',
    'Successfully posted an announcement for {name}.' => 'Duyuru {name} için başarıyla yayımlandı.',
    'Successfully sent a flash message to {name}.' => 'Flash mesajı {name} adlı alıcıya başarıyla gönderildi.',
    'Successfully posted to Slack in channel "{label}".' => '"{label}" Slack kanalında başarıyla paylaşıldı.',
    'Successfully posted to Discord in channel "{label}".' => '"{label}" Discord kanalında başarıyla paylaşıldı.',
    'Successfully posted to Facebook as "{label}" account.' => '"{label}" Facebook hesabıyla başarıyla paylaşıldı.',
    'Successfully posted to Instagram as "{label}" account.' => '"{label}" Instagram hesabıyla başarıyla paylaşıldı.',
    'Successfully posted to X (Twitter) as "{label}" account.' => '"{label}" X (Twitter) hesabıyla başarıyla paylaşıldı.',
    'Successfully posted to Bluesky as "{label}" account.' => '"{label}" Bluesky hesabıyla başarıyla paylaşıldı.',
    'Successfully posted to Mastodon as "{label}" account.' => '"{label}" Mastodon hesabıyla başarıyla paylaşıldı.',
    'Successfully posted to LinkedIn as "{label}" account.' => '"{label}" LinkedIn hesabıyla başarıyla paylaşıldı.',
    'Successfully sent ntfy message to topic "{topic}".' => '"{topic}" konusuna ntfy mesajı başarıyla gönderildi.',
    'Slack rejected the message: {error}' => 'Slack mesajı reddetti: {error}',
    'Discord rejected the message: {error}' => 'Discord mesajı reddetti: {error}',
    'the attached image could not be read' => 'eklenen görüntü okunamadı',
    'Successfully sent MQTT message to topic "{topic}".' => 'MQTT mesajı "{topic}" konusuna gönderildi.',

    // Outbound: LinkedIn send results & skips
    '[EMPTY BODY] The LinkedIn post body is empty.' => '[EMPTY BODY] LinkedIn gönderi gövdesi boş.',
    '[NO RECIPIENT] No LinkedIn connection was specified.' => '[NO RECIPIENT] Hiçbir LinkedIn bağlantısı belirtilmedi.',
    '[RECONNECT REQUIRED] {reason}' => '[RECONNECT REQUIRED] {reason}',
    '[REJECTED BY LINKEDIN] {error}' => '[REJECTED BY LINKEDIN] {error}',
    'LinkedIn app credentials are not configured.' => 'LinkedIn uygulama kimlik bilgileri yapılandırılmamış.',
    'The LinkedIn access token has expired. Please reconnect.' => 'LinkedIn erişim belirteci sona erdi. Lütfen yeniden bağlanın.',
    'The LinkedIn connection no longer exists.' => 'LinkedIn bağlantısı artık mevcut değil.',
    'My LinkedIn Profile' => 'LinkedIn Profilim',
    '[SKIPPED] Recipient "{name}" has no LinkedIn connection.' => '[SKIPPED] Alıcı "{name}" hiçbir LinkedIn bağlantısına sahip değil.',
    '[SKIPPED] The configured LinkedIn connection no longer exists (uid: {uid}).' => '[SKIPPED] Yapılandırılmış LinkedIn bağlantısı artık mevcut değil (uid: {uid}).',

    // Media attachments
    'Videos are not yet supported on {channel}.' => '{channel} üzerinde videolar henüz desteklenmiyor.',
    'The image could not be resized to fit.' => 'Görüntü, sığacak şekilde yeniden boyutlandırılamadı.',
    'The image could not be read.' => 'Görsel okunamadı.',
    'The image failed to upload.' => 'Görsel yüklenemedi.',
    'The upload response had no media ID.' => "Yükleme yanıtında medya ID'si yoktu.",
    'The upload response had no blob.' => 'Yükleme yanıtında blob yoktu.',
    '[NOT ATTACHED] Unable to attach image. {reason}' => '[EKLENMEDİ] Görüntü eklenemedi. {reason}',

    // Recipient warnings
    '[SKIPPED] User "{name}" has no Pushover key.' => '[ATLANDI] "{name}" kullanıcısının Pushover anahtarı yok.',

    // Errors & exceptions
    'Invalid element event: {class}' => 'Geçersiz öğe olayı: {class}',
    'Invalid notification ID: {id}' => 'Geçersiz bildirim kimliği: {id}',
    'Invalid email message mode.' => 'Geçersiz e-posta mesaj modu.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Dinamik Alıcılar türünü kullanma izniniz yok.',
    'Invalid settings section: {section}' => 'Geçersiz ayar bölümü: {section}',
    'User not authorized to save this notification.' => 'Kullanıcı bu bildirimi kaydetme yetkisine sahip değil.',
    'User not authorized to view this notification.' => 'Kullanıcı bu bildirimi görüntüleme yetkisine sahip değil.',
    'User not authorized to delete this notification.' => 'Kullanıcı bu bildirimi silme yetkisine sahip değil.',
    'Notification not found' => 'Bildirim bulunamadı',
    'Element not found' => 'Öğe bulunamadı',
    'You do not have permission to use the Dynamic Data type.' => 'Dinamik Veri türünü kullanma izniniz yok.',
    '[NO DATA] The Dynamic Data snippet did not call the {tag} tag.' => '[VERİ YOK] Twig parçacığı {tag} etiketini çağırmadı.',

    // Config-file override note
    'This is being set in the config file. [{file}]' => 'Bu, yapılandırma dosyasında ayarlanır. [{file}]',

    // ========================================================
    // JAVASCRIPT UI
    // ========================================================

    // JavaScript: log utility & buttons
    'Test notification failed.' => 'Test bildirimi başarısız oldu.',
    'Unable to get the notification, something went wrong.' => 'Bildirim alınamadı, bir şeyler ters gitti.',
    'Something went wrong.' => 'Bir şeyler ters gitti.',
    'Invalid notification ID.' => 'Geçersiz bildirim kimliği.',
    'Unable to delete the log event, something went wrong.' => 'Günlük olayı silinemedi, bir şeyler ters gitti.',
    'Log event deleted.' => 'Günlük olayı silindi.',
    'Unable to delete log events, something went wrong.' => 'Günlük olayları silinemedi, bir şeyler ters gitti.',
    'Are you sure you want to delete all logs from {date}?' => '{date} tarihindeki tüm günlükleri silmek istediğinizden emin misiniz?',
    // Reworded outbound + dispatch log messages
    '[BAD CREDENTIALS] Missing app token. [Configure Pushover]({url}).' => '[GEÇERSİZ KİMLİK BİLGİLERİ] Uygulama jetonu eksik. [Pushover’ı yapılandır]({url}).',
    '[BAD CREDENTIALS] Missing {missing}. [Configure Twilio]({url}).' => '[GEÇERSİZ KİMLİK BİLGİLERİ] {missing} eksik. [Twilio’yu yapılandır]({url}).',
    '[BAD CREDENTIALS] No Discord webhook URL is configured.' => '[GEÇERSİZ KİMLİK BİLGİLERİ] Yapılandırılmış bir Discord webhook URL’si yok.',
    '[BAD CREDENTIALS] No MQTT broker host is configured.' => '[GEÇERSİZ KİMLİK BİLGİLERİ] Yapılandırılmış bir MQTT aracı ana bilgisayarı yok.',
    '[BAD CREDENTIALS] No Mastodon access token is configured.' => '[GEÇERSİZ KİMLİK BİLGİLERİ] Yapılandırılmış bir Mastodon erişim jetonu yok.',
    '[BAD CREDENTIALS] No Mastodon instance URL is configured.' => '[GEÇERSİZ KİMLİK BİLGİLERİ] Yapılandırılmış bir Mastodon örnek URL’si yok.',
    '[BAD CREDENTIALS] No Slack bot token is configured.' => '[GEÇERSİZ KİMLİK BİLGİLERİ] Yapılandırılmış bir Slack bot jetonu yok.',
    '[BAD CREDENTIALS] No Twilio phone number is configured.' => '[GEÇERSİZ KİMLİK BİLGİLERİ] Yapılandırılmış bir Twilio telefon numarası yok.',
    '[BAD CREDENTIALS] The recipient is missing Bluesky credentials.' => '[GEÇERSİZ KİMLİK BİLGİLERİ] Alıcının Bluesky kimlik bilgileri eksik.',
    '[BAD CREDENTIALS] The recipient is missing Facebook credentials.' => '[GEÇERSİZ KİMLİK BİLGİLERİ] Alıcının Facebook kimlik bilgileri eksik.',
    '[BAD CREDENTIALS] The recipient is missing X (Twitter) credentials.' => '[GEÇERSİZ KİMLİK BİLGİLERİ] Alıcının X (Twitter) kimlik bilgileri eksik.',
    '[BAD CREDENTIALS] Unable to post, recipient is missing credentials.' => '[GEÇERSİZ KİMLİK BİLGİLERİ] Paylaşılamıyor; alıcının kimlik bilgileri eksik.',
    '[EMPTY BODY] The Discord message body is empty.' => '[BOŞ İÇERİK] Discord mesaj içeriği boş.',
    '[EMPTY BODY] The Facebook post body is empty.' => '[BOŞ İÇERİK] Facebook gönderi içeriği boş.',
    '[EMPTY BODY] The MQTT payload is empty.' => '[BOŞ İÇERİK] MQTT yükü boş.',
    '[EMPTY BODY] The Mastodon post body is empty.' => '[BOŞ İÇERİK] Mastodon gönderi içeriği boş.',
    '[EMPTY BODY] The Slack message body is empty.' => '[BOŞ İÇERİK] Slack mesaj içeriği boş.',
    '[EMPTY BODY] The X (Twitter) post body is empty.' => '[BOŞ İÇERİK] X (Twitter) gönderi içeriği boş.',
    '[EMPTY BODY] The email message body was empty.' => '[BOŞ İÇERİK] E-posta içeriği boştu.',
    '[FEED ERROR] Could not fetch the feed: {message}' => '[BESLEME HATASI] Besleme alınamadı: {message}',
    '[FEED ERROR] Could not parse the feed.' => '[BESLEME HATASI] Besleme ayrıştırılamadı.',
    '[FEED ERROR] Could not parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => '[BESLEME HATASI] Besleme ayrıştırılamadı. PHP `simplexml` ve `libxml` uzantıları gereklidir.',
    '[FEED ERROR] Initial feed scan failed: {message}' => '[BESLEME HATASI] İlk besleme taraması başarısız oldu: {message}',
    '[INVALID NUMBER] The recipient phone number is invalid.' => '[GEÇERSİZ NUMARA] Alıcının telefon numarası geçersiz.',
    '[INVALID TYPE] The flash message type is invalid.' => '[GEÇERSİZ TÜR] Flash mesaj türü geçersiz.',
    '[LINK PREVIEW SKIPPED] {reason}' => '[BAĞLANTI ÖNİZLEMESİ ATLANDI] {reason}',
    '[MISSING IMAGE] Image Attachment field never called the {tag} tag.' => '[GÖRSEL EKSİK] Görsel eki alanı {tag} etiketini hiç çağırmadı.',
    '[MISSING IMAGE] Image Attachment field was empty.' => '[GÖRSEL EKSİK] Görsel eki alanı boştu.',
    '[MISSING IMAGE] The {tag} tag was called, but returned an invalid image.' => '[GÖRSEL EKSİK] {tag} etiketi çağrıldı ancak geçersiz bir görsel döndürdü.',
    '[MISSING IMAGE] Unable to send Instagram post, the image needs a public URL.' => '[GÖRSEL EKSİK] Instagram gönderisi gönderilemiyor; görselin herkese açık bir URL’ye ihtiyacı var.',
    '[NO MEDIA] No image was attached because the {tag} tag was never invoked in the Image Attachment field.' => '[MEDYA YOK] Görsel eki alanında {tag} etiketi hiç çağrılmadığı için hiçbir görsel eklenmedi.',
    '[NO RECIPIENTS] The Dynamic Recipients snippet did not call setRecipients.' => '[ALICI YOK] Dinamik alıcılar snippet’i setRecipients’i çağırmadı.',
    '[NO RECIPIENTS] setRecipients was called with an empty value.' => '[ALICI YOK] setRecipients boş bir değerle çağrıldı.',
    '[NO RECIPIENT] No MQTT topic was specified.' => '[ALICI YOK] MQTT konusu belirtilmedi.',
    '[NO RECIPIENT] No Slack channel ID was specified.' => '[ALICI YOK] Slack kanal kimliği belirtilmedi.',
    '[NO RECIPIENT] No ntfy topic was specified.' => '[ALICI YOK] ntfy konusu belirtilmedi.',
    '[NO RECIPIENT] No recipient user was specified for the announcement.' => '[ALICI YOK] Duyuru için alıcı kullanıcı belirtilmedi.',
    '[NO RECIPIENT] No recipient was specified for the email.' => '[ALICI YOK] E-posta için alıcı belirtilmedi.',
    '[NO RECIPIENT] The recipient has no Pushover user key.' => '[ALICI YOK] Alıcının Pushover kullanıcı anahtarı yok.',
    '[NO RECIPIENT] The recipient has no phone number.' => '[ALICI YOK] Alıcının telefon numarası yok.',
    '[REJECTED BY DISCORD] {error}' => '[REDDETTİ: DISCORD] {error}',
    '[REJECTED BY FACEBOOK] {error}' => '[REDDETTİ: FACEBOOK] {error}',
    '[REJECTED BY INSTAGRAM] {error}' => '[REDDETTİ: INSTAGRAM] {error}',
    '[REJECTED BY MASTODON] {error}' => '[REDDETTİ: MASTODON] {error}',
    '[REJECTED BY SLACK] {error}' => '[REDDETTİ: SLACK] {error}',
    '[REJECTED BY X (TWITTER)] {error}' => '[REDDETTİ: X (TWITTER)] {error}',
    '[SEND FAILED] Authentication failed for {handle}: {reason}' => '[GÖNDERİM BAŞARISIZ] {handle} için kimlik doğrulama başarısız: {reason}',
    '[SEND FAILED] Authentication failed: {reason}' => '[GÖNDERİM BAŞARISIZ] Kimlik doğrulama başarısız: {reason}',
    "[SEND FAILED] Could not send the email using Craft's native handling. Check your general email settings within Craft." => '[GÖNDERİM BAŞARISIZ] E-posta Craft’ın yerleşik gönderimiyle gönderilemedi. Craft’taki genel e-posta ayarlarını kontrol edin.',
    '[SEND FAILED] HTTP {status}: {reason}' => '[GÖNDERİM BAŞARISIZ] HTTP {status}: {reason}',
    '[SEND FAILED] {error}' => '[GÖNDERİM BAŞARISIZ] {error}',
    '[SEND FAILED] {reason}' => '[GÖNDERİM BAŞARISIZ] {reason}',
    '[SKIPPED] Pushover user-key field is not configured on this notification.' => '[ATLANDI] Bu bildirimde Pushover kullanıcı anahtarı alanı yapılandırılmamış.',
    '[SKIPPED] Recipient "{name}" cannot access the control panel.' => '[ATLANDI] "{name}" alıcısı kontrol paneline erişemiyor.',
    '[SKIPPED] Recipient "{name}" has no Bluesky credentials.' => '[ATLANDI] "{name}" alıcısının Bluesky kimlik bilgileri yok.',
    '[SKIPPED] Recipient "{name}" has no Craft user account.' => '[ATLANDI] "{name}" alıcısının Craft kullanıcı hesabı yok.',
    '[SKIPPED] Recipient "{name}" has no Discord webhook URL.' => '[ATLANDI] "{name}" alıcısının Discord webhook URL’si yok.',
    '[SKIPPED] Recipient "{name}" has no Facebook credentials.' => '[ATLANDI] "{name}" alıcısının Facebook kimlik bilgileri yok.',
    '[SKIPPED] Recipient "{name}" has no Instagram credentials.' => '[ATLANDI] "{name}" alıcısının Instagram kimlik bilgileri yok.',
    '[SKIPPED] Recipient "{name}" has no MQTT topic.' => '[ATLANDI] "{name}" alıcısının MQTT konusu yok.',
    '[SKIPPED] Recipient "{name}" has no Mastodon credentials.' => '[ATLANDI] "{name}" alıcısının Mastodon kimlik bilgileri yok.',
    '[SKIPPED] Recipient "{name}" has no Slack bot token.' => '[ATLANDI] "{name}" alıcısının Slack bot jetonu yok.',
    '[SKIPPED] Recipient "{name}" has no Slack channel ID.' => '[ATLANDI] "{name}" alıcısının Slack kanal kimliği yok.',
    '[SKIPPED] Recipient "{name}" has no X (Twitter) credentials.' => '[ATLANDI] "{name}" alıcısının X (Twitter) kimlik bilgileri yok.',
    '[SKIPPED] Recipient "{name}" has no email address.' => '[ATLANDI] "{name}" alıcısının e-posta adresi yok.',
    '[SKIPPED] Recipient "{name}" has no ntfy topic.' => '[ATLANDI] "{name}" alıcısının ntfy konusu yok.',
    '[SKIPPED] Recipient "{name}" has no phone number.' => '[ATLANDI] "{name}" alıcısının telefon numarası yok.',
    '[SKIPPED] The configured {kind} no longer exists in the plugin settings (uid: {uid}).' => '[ATLANDI] Yapılandırılan {kind} artık eklenti ayarlarında yok (uid: {uid}).',
    '[SKIPPED] Unrecognized recipient "{value}".' => '[ATLANDI] Tanınmayan alıcı "{value}".',
    '[SKIPPED] Unrecognized recipient of type "{type}".' => '[ATLANDI] Tanınmayan alıcı türü "{type}".',
    '[TOO LONG] The Discord message body exceeds the 2000-character limit.' => '[ÇOK UZUN] Discord mesaj içeriği 2000 karakter sınırını aşıyor.',
    '[TRUNCATED] Body exceeded {max} characters.' => '[KISALTILDI] İçerik {max} karakteri aştı.',
    '[TRUNCATED] Caption exceeded {max} characters.' => '[KISALTILDI] Başlık {max} karakteri aştı.',
];
