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
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are also supported.' => '[Şablonlama]({templatingUrl}) ve [özel değişkenler]({variablesUrl}) de desteklenir.',

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
    'Supports standard Markdown, and optionally HTML _(see below)_. Max 2000 characters.' => 'Standart Markdown\'ı ve isteğe bağlı olarak HTML\'i destekler _(aşağıya bakın)_. En fazla 2000 karakter.',
    'Whether to only parse as Markdown, or additionally parse it as HTML.' => 'Yalnızca Markdown olarak mı yoksa ayrıca HTML olarak da mı işlensin.',
    'Markdown only' => 'Yalnızca Markdown',
    'Markdown + HTML' => 'Markdown + HTML',
    'Whether Discord should unfurl link previews for URLs in the message body.' => 'Discord\'un mesaj gövdesindeki URL\'ler için bağlantı önizlemelerini gösterip göstermeyeceği.',
    'Webhook Username' => 'Webhook Kullanıcı Adı',
    'Optionally override the webhook\'s display name.' => 'İsteğe bağlı olarak webhook\'un görünen adını geçersiz kılın.',
    'Dynamic Username' => 'Dinamik Kullanıcı Adı',
    'Webhook Avatar URL' => 'Webhook Avatar URL\'si',
    'Optionally override the webhook\'s avatar with a URL.' => 'İsteğe bağlı olarak webhook\'un avatarını bir URL ile geçersiz kılın.',

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
    'Unable to parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => 'Akış ayrıştırılamıyor. PHP `simplexml` ve `libxml` uzantıları gereklidir.',
    'Unable to parse the feed.' => 'Akış ayrıştırılamıyor.',
    'Unable to fetch the feed: {message}' => 'Akış alınamıyor: {message}',
    'Initial feed scan failed: {message}' => 'İlk akış taraması başarısız: {message}',

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

    // Outbound: per-channel send results
    'Unable to send email, no recipient specified.' => 'E-posta gönderilemiyor, alıcı belirtilmedi.',
    'Unable to send email, the message body was empty.' => 'E-posta gönderilemiyor, mesaj gövdesi boş.',
    "Unable to send the email using Craft's native email handling." => "Craft'in yerleşik e-posta yönetimini kullanarak e-posta gönderilemiyor.",
    'Check your general email settings within Craft.' => "Craft'taki genel e-posta ayarlarınızı kontrol edin.",
    'Successfully sent email message!' => 'E-posta başarıyla gönderildi!',
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[Geçersiz Twilio kimlik bilgileri.]({url}) Eksik: {missing}.',
    'Unable to send SMS, no Twilio phone number exists.' => 'SMS gönderilemiyor, Twilio telefon numarası yok.',
    'Unable to send SMS, no recipient phone number exists.' => 'SMS gönderilemiyor, alıcı telefon numarası yok.',
    'Unable to send SMS, recipient phone number is invalid.' => 'SMS gönderilemiyor, alıcı telefon numarası geçersiz.',
    'Successfully sent SMS message!' => 'SMS başarıyla gönderildi!',
    'Unable to post announcement, no recipient userId specified.' => 'Duyuru yayımlanamıyor: alıcı userId belirtilmedi.',
    'Successfully posted announcement!' => 'Duyuru başarıyla yayımlandı!',
    'Unable to send the flash message, invalid flash type.' => 'Flash mesaj gönderilemiyor: geçersiz flash türü.',
    'Successfully sent flash message!' => 'Flash mesajı başarıyla gönderildi!',
    '[Invalid Pushover credentials.]({url}) Missing app token.' => '[Geçersiz Pushover kimlik bilgileri.]({url}) Uygulama anahtarı eksik.',
    'Unable to send Pushover message, no user key on recipient.' => 'Pushover mesajı gönderilemiyor: alıcıda kullanıcı anahtarı yok.',
    'Pushover POST failed: {reason}' => 'Pushover POST başarısız: {reason}',
    'Successfully sent Pushover message!' => 'Pushover mesajı başarıyla gönderildi!',
    'Unable to send ntfy message, no topic specified.' => 'ntfy mesajı gönderilemiyor: konu belirtilmedi.',
    'ntfy POST failed with HTTP {status}: {reason}' => 'ntfy POST HTTP {status} ile başarısız: {reason}',
    'ntfy POST failed: {reason}' => 'ntfy POST başarısız: {reason}',
    'Successfully sent ntfy message to topic "{topic}".' => '"{topic}" konusuna ntfy mesajı başarıyla gönderildi.',
    'Unable to send Slack message, no bot token.' => 'Slack mesajı gönderilemiyor: bot belirteci yok.',
    'Unable to send Slack message, no channel ID.' => 'Slack mesajı gönderilemiyor: kanal kimliği yok.',
    'Unable to send Slack message, body is empty.' => 'Slack mesajı gönderilemiyor: gövde boş.',
    'Slack rejected the message: {error}' => 'Slack mesajı reddetti: {error}',
    'Slack POST failed: {reason}' => 'Slack POST başarısız: {reason}',
    'Successfully sent Slack message to "{label}".' => "\"{label}\"'a Slack mesajı başarıyla gönderildi.",
    'Unable to send Discord message, no webhook URL.' => 'Discord mesajı gönderilemiyor: webhook URL\'si yok.',
    'Unable to send Discord message, body is empty.' => 'Discord mesajı gönderilemiyor: gövde boş.',
    'Unable to send Discord message, body exceeds the 2000-character limit.' => 'Discord mesajı gönderilemiyor: gövde 2000 karakter sınırını aşıyor.',
    'Discord rejected the message: {error}' => 'Discord mesajı reddetti: {error}',
    'Discord POST failed: {reason}' => 'Discord POST başarısız: {reason}',
    'Successfully sent Discord message to "{label}".' => '"{label}" hedefine Discord mesajı başarıyla gönderildi.',
    'Unable to send Bluesky post, recipient is missing credentials.' => 'Bluesky gönderisi gönderilemiyor: alıcının kimlik bilgileri eksik.',
    'Body exceeded {max} characters, truncated.' => 'Gövde {max} karakteri aştı, kısaltıldı.',
    'Successfully posted to Bluesky as "{label}".' => "\"{label}\" olarak Bluesky'da başarıyla yayımlandı.",
    'Bluesky auth failed for {handle}: {reason}' => '{handle} için Bluesky kimlik doğrulaması başarısız: {reason}',
    'Bluesky auth failed: {reason}' => 'Bluesky kimlik doğrulaması başarısız: {reason}',
    'Bluesky post failed: {reason}' => 'Bluesky gönderisi başarısız: {reason}',
    'Bluesky link preview skipped: {reason}' => 'Bluesky bağlantı önizlemesi atlandı: {reason}',
    'Unable to send Mastodon post, no instance URL.' => 'Mastodon gönderisi gönderilemiyor: instance URL\'si yok.',
    'Unable to send Mastodon post, no access token.' => 'Mastodon gönderisi gönderilemiyor: erişim belirteci yok.',
    'Unable to send Mastodon post, body is empty.' => 'Mastodon gönderisi gönderilemiyor: gövde boş.',
    'Mastodon rejected the post: {error}' => 'Mastodon gönderiyi reddetti: {error}',
    'Mastodon POST failed: {reason}' => 'Mastodon POST başarısız: {reason}',
    'Successfully sent Mastodon post to "{label}".' => '"{label}" hedefine Mastodon gönderisi başarıyla gönderildi.',
    'Unable to send MQTT message, no broker host configured.' => 'MQTT mesajı gönderilemiyor, hiçbir broker ana bilgisayarı yapılandırılmadı.',
    'Unable to send MQTT message, no topic specified.' => 'MQTT mesajı gönderilemiyor, hiçbir konu belirtilmedi.',
    'Unable to send MQTT message, the payload is empty.' => 'MQTT mesajı gönderilemiyor, içerik boş.',
    'MQTT publish failed: {reason}' => 'MQTT yayını başarısız oldu: {reason}',
    'Successfully sent MQTT message to topic "{topic}".' => 'MQTT mesajı "{topic}" konusuna gönderildi.',

    // Recipient warnings
    'Recipient "{name}" has no email address.' => '"{name}" alıcısının e-posta adresi yok.',
    'Recipient "{name}" has no phone number.' => '"{name}" alıcısının telefon numarası yok.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => '"{name}" alıcısı için ilişkilendirilmiş bir Kullanıcı yok; duyuru gönderilemez.',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => '"{name}" alıcısı kontrol paneline erişemez; duyuru gönderilemez.',
    'Pushover user-key field is not configured on this notification.' => 'Bu bildirimde Pushover kullanıcı anahtarı alanı yapılandırılmamış.',
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => '"{name}" alıcısı için ilişkilendirilmiş bir Kullanıcı yok; Pushover mesajı gönderilemez.',
    '[SKIPPED] User "{name}" has no Pushover key.' => '[ATLANDI] "{name}" kullanıcısının Pushover anahtarı yok.',
    'Recipient "{name}" has no ntfy topic.' => '"{name}" alıcısının ntfy konusu yok.',
    'Recipient "{name}" has no Slack bot token.' => 'Alıcı "{name}" Slack bot belirtecine sahip değil.',
    'Recipient "{name}" has no Slack channel ID.' => 'Alıcı "{name}" Slack kanal kimliğine sahip değil.',
    'Recipient "{name}" has no Discord webhook URL.' => '"{name}" alıcısının Discord webhook URL\'si yok.',
    'Recipient "{name}" has no Bluesky credentials.' => '"{name}" alıcısının Bluesky kimlik bilgileri yok.',
    'Recipient "{name}" has no Mastodon credentials.' => '"{name}" alıcısının Mastodon kimlik bilgileri yok.',
    'Recipient "{name}" has no MQTT topic.' => '"{name}" alıcısının MQTT konusu yok.',

    // Errors & exceptions
    'Invalid element event: {class}' => 'Geçersiz öğe olayı: {class}',
    'Invalid notification ID: {id}' => 'Geçersiz bildirim kimliği: {id}',
    'Invalid email message mode.' => 'Geçersiz e-posta mesaj modu.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Dinamik Alıcılar türünü kullanma izniniz yok.',
    'Dynamic recipients snippet did not call setRecipients.' => 'Dinamik alıcılar parçacığı setRecipients çağırmadı.',
    'setRecipients was called with an empty value.' => 'setRecipients boş bir değerle çağrıldı.',
    'Unrecognized recipient of type "{type}".' => 'Tanınmayan "{type}" türünde alıcı.',
    'Unrecognized recipient "{value}".' => 'Tanınmayan alıcı "{value}".',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => 'Yapılandırılmış {kind} artık eklenti ayarlarında yok (uid: {uid}).',
    'Invalid settings section: {section}' => 'Geçersiz ayar bölümü: {section}',
    'User not authorized to save this notification.' => 'Kullanıcı bu bildirimi kaydetme yetkisine sahip değil.',
    'User not authorized to view this notification.' => 'Kullanıcı bu bildirimi görüntüleme yetkisine sahip değil.',
    'User not authorized to delete this notification.' => 'Kullanıcı bu bildirimi silme yetkisine sahip değil.',
    'Notification not found' => 'Bildirim bulunamadı',
    'Element not found' => 'Öğe bulunamadı',
    'You do not have permission to use the Dynamic Data type.' => 'Dinamik Veri türünü kullanma izniniz yok.',
    'The Dynamic Data snippet did not call the {tag} tag.' => 'Twig parçacığı {tag} etiketini çağırmadı.',

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
];
