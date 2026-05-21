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
    'Notifications'          => 'Bildirimler',
    'Notification'           => 'Bildirim',
    'All notifications'      => 'Tüm bildirimler',
    'Notification Log'       => 'Bildirim günlüğü',
    'Logs'                   => 'Günlükler',
    'View Notifications'     => 'Bildirimleri görüntüle',
    'Add a New Notification' => 'Yeni bir bildirim ekle',

    // Permissions
    'View notifications'              => 'Bildirimleri görüntüle',
    'Save notifications'              => 'Bildirimleri kaydet',
    'Use the Dynamic Recipients type' => 'Dinamik Alıcılar türünü kullan',
    'Test notifications'              => 'Bildirimleri test et',
    'Delete notifications'            => 'Bildirimleri sil',
    'View notification log'           => 'Bildirim günlüğünü görüntüle',
    'Delete notification log'         => 'Bildirim günlüğünü sil',

    // Notification editor: tabs
    'Meta'       => 'Meta',
    'Event'      => 'Olay',
    'Message'    => 'Mesaj',
    'Recipients' => 'Alıcılar',

    // Event tab: type selector
    'Event Type'                                           => 'Olay türü',
    'What type of event will activate the notification?'   => 'Hangi tür olay bildirimi etkinleştirecek?',
    'Which specific event will activate the notification?' => 'Hangi belirli olay bildirimi etkinleştirecek?',

    // Event tab: event types
    'Assets Event'                   => 'Varlık olayı',
    'Commerce Orders Event'          => 'Commerce sipariş olayı',
    'Commerce Products Event'        => 'Commerce ürün olayı',
    'Digital Products Event'         => 'Digital Products olayı',
    'Digital Product Licenses Event' => 'Digital Products lisans olayı',
    'Solspace Calendar Event'        => 'Solspace Calendar olayı',
    'Entries Event'                  => 'Giriş olayı',
    'Users Event'                    => 'Kullanıcı olayı',
    'Ungrouped Users'                => 'Grupsuz kullanıcılar',

    // Feed
    'Feed Event' => 'Besleme Olayı',
    'Feed URL' => "Besleme URL'si",
    'The URL of the RSS, Atom, or JSON feed to watch.' => "İzlenecek RSS, Atom veya JSON beslemesinin URL'si.",
    // Field and element conditions
    'Field Conditions'             => 'Alan koşulları',
    'Send the message only when the saved element matches the following conditions.' => 'Mesajı yalnızca kaydedilen öğe aşağıdaki koşulları karşıladığında gönder.',
    'has changed'                  => 'değişti',
    '#{elementType} Event Filters' => '#{elementType} olay filtreleri',
    'No filters match this event.' => 'Bu olayla eşleşen filtre yok.',
    'Determine whether each message should be sent based on specified conditions.' => 'Belirtilen koşullara göre her mesajın gönderilip gönderilmeyeceğini belirleyin.',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => 'Öğe ilk kez kaydediliyor',
    'Must be a new entry'                       => 'Yeni bir giriş olmalı',
    'Must be an existing entry'                 => 'Mevcut bir giriş olmalı',
    'Can be existing or new'                    => 'Mevcut veya yeni olabilir',

    // Filters: new elements
    'Element is new'         => 'Öğe yeni',
    'New elements only'      => 'Yalnızca yeni öğeler',
    'Existing elements only' => 'Yalnızca mevcut öğeler',

    // Filters: enabled state
    'Element is enabled'         => 'Öğe etkin',
    'Must be enabled'            => 'Etkin olmalı',
    'Must be disabled'           => 'Devre dışı olmalı',
    'Can be enabled or disabled' => 'Etkin veya devre dışı olabilir',

    // Filters: drafts
    'Element is a draft'          => 'Öğe taslak',
    'Must be a draft'             => 'Taslak olmalı',
    'Must not be a draft'         => 'Taslak olmamalı',
    'Can be a draft or non-draft' => 'Taslak veya taslak olmayan olabilir',

    // Filters: provisional drafts
    'Element is a provisional draft'                => 'Öğe geçici taslak',
    'Must be a provisional draft'                   => 'Geçici taslak olmalı',
    'Must not be a provisional draft'               => 'Geçici taslak olmamalı',
    'Can be a provisional draft or non-provisional' => 'Geçici taslak veya değil olabilir',

    // Filters: revisions
    'Element is a revision'             => 'Öğe revizyon',
    'Must be a revision'                => 'Revizyon olmalı',
    'Must not be a revision'            => 'Revizyon olmamalı',
    'Can be a revision or non-revision' => 'Revizyon veya revizyon olmayan olabilir',

    // Filters: duplication
    'Element is being duplicated'         => 'Öğe çoğaltılıyor',
    'Must be duplicating the element'     => 'Öğeyi çoğaltıyor olmalı',
    'Must not be duplicating the element' => 'Öğeyi çoğaltıyor olmamalı',

    // Filters: propagation
    'Element is being propagated'     => 'Öğe yayılıyor',
    'Element must be propagating'     => 'Öğe yayılıyor olmalı',
    'Element must not be propagating' => 'Öğe yayılıyor olmamalı',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => 'Öğe toplu olarak yeniden kaydediliyor',
    'Must be bulk-resaving the element'     => 'Öğeyi toplu olarak yeniden kaydediyor olmalı',
    'Must not be bulk-resaving the element' => 'Öğeyi toplu olarak yeniden kaydediyor olmamalı',

    // Filters: common output
    'Unnamed filter'                => 'Adsız filtre',
    'Must be TRUE to send message'  => 'Mesajı göndermek için TRUE olmalı',
    'Must be FALSE to send message' => 'Mesajı göndermek için FALSE olmalı',
    'No effect'                     => 'Etkisiz',

    // Message tab: type selector and queue
    'Message Type'                       => 'Mesaj türü',
    'What type of message will be sent?' => 'Hangi tür mesaj gönderilecek?',
    'Send Message via Queue'             => 'Mesajı kuyruk üzerinden gönder',
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are also supported.' => '[Şablonlama]({templatingUrl}) ve [özel değişkenler]({variablesUrl}) de desteklenir.',
    'Send immediately' => 'Hemen gönder',
    'Add to queue' => 'Kuyruğa ekle',

    // Message tab: Email fields
    "User's Email Address Field" => 'Kullanıcı e-posta adresi alanı',
    'Email Subject'              => 'E-posta konusu',
    'Email Body'                 => 'E-posta gövdesi',

    // Message tab: SMS fields
    "User's Phone Number Field" => 'Kullanıcı telefon numarası alanı',
    'SMS Message Body'          => 'SMS mesaj gövdesi',

    // Message tab: Announcement fields
    'Announcement Title'   => 'Duyuru başlığı',
    'Announcement Message' => 'Duyuru mesajı',

    // Message tab: Flash fields
    'Flash Message Type'                         => 'Flash mesaj türü',
    'Flash Message Title'                        => 'Flash mesaj başlığı',
    'Flash Message Details'                      => 'Flash mesaj ayrıntıları',
    'Which type of flash message should appear?' => 'Hangi tür flash mesaj görünmeli?',

    // Message tab: Pushover fields
    "Field containing each user's Pushover key" => 'Kullanıcının Pushover anahtar alanı',

    // Message tab: ntfy fields
    'Priority'           => 'Öncelik',
    'Tags'               => 'Etiketler',
    'Click URL'          => "Tıklama URL'si",
    'Render as Markdown' => 'Markdown olarak görüntüle',

    // Message tab: Slack fields
    'Slack Message Body' => 'Slack mesaj gövdesi',
    'Bot Icon URL' => "Simge URL'si",
    "A URL for the icon to display alongside this message. Leave blank to use the app's default." => "Bu mesajın yanında gösterilecek simgenin URL'si. Kanalın varsayılanını kullanmak için boş bırakın.",

    // Message tab: Bluesky fields
    'Post Body' => 'Gönderi gövdesi',
    'Generate Link Preview' => 'Bağlantı önizlemesi oluştur',
    "When the post body contains a URL, automatically generate a preview card with the linked page's image, title, and description." => 'Gönderi gövdesi bir URL içerdiğinde, bağlantılı sayfanın başlığını, açıklamasını ve görselini içeren bir önizleme kartı eklenir.',
    'No card' => 'Kart yok',
    'Generate preview card' => 'Önizleme kartı oluştur',

    // Message tab: Title / Body / Trix toolbar
    'Title'         => 'Başlık',
    'Body'          => 'Gövde',
    'Rich Text'     => 'Zengin metin',
    'Bold'          => 'Kalın',
    'Italic'        => 'İtalik',
    'Underline'     => 'Altı çizili',
    'Strikethrough' => 'Üstü çizili',
    'Bullets'       => 'Madde işaretleri',
    'Numbers'       => 'Numaralandırma',
    'Heading'       => 'Başlık',
    'Code'          => 'Kod',
    'Undo'          => 'Geri al',
    'Redo'          => 'Yinele',
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => 'Giden e-postanın gövdesi. <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">Özel değişkenler</a> kullanabilir, hatta <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">alıcıları atlayabilirsiniz</a>.',

    // Recipients tab: common
    'Recipients Type'                             => 'Alıcı türü',
    'Who will receive this message?'              => 'Bu mesajı kim alacak?',
    'Add a message recipient'                     => 'Bir alıcı ekle',
    'Select User(s)'                              => 'Kullanıcı(lar) seç',
    'Which users will receive the message?'       => 'Mesajı hangi kullanıcılar alacak?',
    'Which user groups will receive the message?' => 'Mesajı hangi kullanıcı grupları alacak?',
    'Twig Snippet to Determine Recipients'        => 'Alıcıları belirleyen Twig parçacığı',

    // Recipients tab: per-provider pickers
    'Select Slack channel(s)'                           => 'Slack kanal(lar)ı seç',
    'Which Slack channels should receive this message?' => 'Bu mesajı hangi Slack kanalları almalı?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Slack kanalı yapılandırılmamış. [Ayarlar → Slack]({url}) bölümünden bir tane ekleyin.',
    'Select ntfy topic(s)'                              => 'ntfy konu(ları)nu seç',
    'Which ntfy topics should receive this message?'    => 'Bu mesajı hangi ntfy konuları almalı?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'ntfy konusu yapılandırılmamış. [Ayarlar → ntfy]({url}) bölümünden bir tane ekleyin.',
    'Select Bluesky account(s)'                         => 'Bluesky hesap(lar)ı seç',
    'Which Bluesky accounts should post this message?'  => 'Bu mesajı hangi Bluesky hesapları paylaşmalı?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Bluesky hesabı yapılandırılmamış. [Ayarlar → Bluesky]({url}) bölümünden bir tane ekleyin.',

    // Settings: page chrome
    'Notifier Settings' => 'Notifier ayarları',
    'General'           => 'Genel',
    'Twilio'            => 'Twilio',
    'Pushover'          => 'Pushover',
    'Slack'             => 'Slack',
    'Bluesky'           => 'Bluesky',
    'ntfy'              => 'ntfy',

    // Settings: Logging
    'Logging'                             => 'Günlüğe kaydetme',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier gönderilen mesajların sürekli bir günlüğünü tutar. Genellikle gerekli olmasa da veritabanına kaydedilen günlük olaylarının sayısını sınırlayabilirsiniz.',
    'Enable Logging'                      => 'Günlüğe kaydetmeyi etkinleştir',
    'When disabled, Notifier will not write anything to the notification log.' => 'Devre dışı bırakıldığında, Notifier bildirim günlüğüne hiçbir şey yazmaz.',
    'Number of days to retain log events' => 'Günlük olaylarının saklanacağı gün sayısı',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Günlük olaylarını en fazla bu kadar gün sakla. Sınır olmaması için boş bırakın.',
    'Number of log events to retain'      => 'Saklanacak günlük olayı sayısı',
    'At most, keep this many log events. Leave blank for no limit.' => 'En fazla bu kadar günlük olayı sakla. Sınır olmaması için boş bırakın.',

    // Settings: Twilio
    'Twilio API Credentials'                       => 'Twilio API kimlik bilgileri',
    'If using the Twilio API to send SMS messages, the following credentials are required.' => 'SMS göndermek için Twilio API kullanılıyorsa aşağıdaki kimlik bilgileri gereklidir.',
    'Twilio Account SID'                           => 'Twilio Hesap SID',
    'Twilio Auth Token'                            => 'Twilio Kimlik Doğrulama Anahtarı',
    'Twilio phone number (sends each SMS message)' => "Twilio telefon numarası (her SMS'i gönderir)",
    'SMS Testing'                                  => 'SMS testi',
    'Optional. When set, every SMS dispatched will be sent to this number instead of the resolved recipient.' => 'İsteğe bağlı. Ayarlandığında, gönderilen her SMS gerçek alıcı yerine bu numaraya iletilir.',
    'Test phone number'                            => 'Test telefon numarası',

    // Settings: Pushover
    "[Pushover](https://pushover.net) sends push notifications to a registered user's devices. Each Craft user needs a custom field on their profile storing their Pushover user key; you select which field on each Notification's Message tab. For full setup instructions, see the [Pushover getting-started docs](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover)." => '[Pushover](https://pushover.net) kayıtlı bir kullanıcının cihazlarına anlık bildirim gönderir. Her Craft kullanıcısının profilinde Pushover anahtarını saklayan özel bir alana ihtiyacı vardır; hangi alanın kullanılacağını her bildirimin Mesaj sekmesinde seçersiniz. Tüm kurulum yönergeleri için [Pushover başlangıç belgelerine](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover) bakın.',
    'Application API Token'                                      => 'Uygulama API anahtarı',
    'The 30-character app token from your Pushover application.' => 'Pushover uygulamanızdan 30 karakterli uygulama anahtarı.',

    // Settings: ntfy
    'ntfy.sh is a free HTTP-based push notification service. Subscribers receive messages on the ntfy app, web, or any compatible client by joining a topic.' => "ntfy.sh, ücretsiz HTTP tabanlı bir anlık bildirim hizmetidir. Aboneler bir konuya katılarak mesajları ntfy uygulamasında, web'de veya uyumlu herhangi bir istemcide alır.",
    'Server URL'   => "Sunucu URL'si",
    'Defaults to https://ntfy.sh. Point at a self-hosted ntfy instance if applicable.' => 'Varsayılan https://ntfy.sh. Geçerliyse kendi sunucunuzda barındırdığınız bir ntfy örneğini gösterin.',
    'Access token' => 'Erişim anahtarı',
    'Optional. Required for protected topics or self-hosted instances with auth.' => 'İsteğe bağlı. Korumalı konular veya kimlik doğrulamalı kendi sunucunuzda barındırdığınız örnekler için gereklidir.',
    'ntfy Topics'  => 'ntfy konuları',
    'Named list of ntfy topics. Each topic becomes selectable on the notification edit screen.' => 'Adlandırılmış ntfy konuları listesi. Her konu bildirim düzenleme ekranında seçilebilir hale gelir.',
    'Topics'       => 'Konular',
    'Add one row per topic name. Use the **Test** button to send a quick test message to the topic.' => 'Her konu adı için bir satır ekleyin. Konuya hızlı bir test mesajı göndermek için **Test** düğmesini kullanın.',
    'Topic'        => 'Konu',
    'Add a topic'  => 'Bir konu ekle',
    'Save first to persist a row, then click its **Test** button to fire a sanity check against ntfy.' => 'Önce kaydedip satırı kalıcı hale getirin, ardından ntfy üzerinde hızlı bir kontrol için **Test** düğmesine tıklayın.',

    // Settings: Slack
    'Slack Channels' => 'Slack kanalları',
    'Create a [Slack app](https://api.slack.com/apps) with the `chat:write`, `chat:write.customize`, and `chat:write.public` scopes, then add a row for each channel you\'d like to post into. Each channel becomes available as a recipient on the **Recipients** tab when configuring a notification. A bot token is a secret, so store it in a `.env` variable and reference that variable (e.g. `$SLACK_BOT_TOKEN`) rather than pasting the token directly.' => '`chat:write`, `chat:write.customize` ve `chat:write.public` kapsamlarına sahip bir [Slack uygulaması](https://api.slack.com/apps) oluşturun, ardından paylaşım yapmak istediğiniz her kanal için bir satır ekleyin. Bir bildirim yapılandırılırken her kanal **Recipients** sekmesinde alıcı olarak kullanılabilir hale gelir. Bot belirteci bir sırdır, bu nedenle onu doğrudan yapıştırmak yerine bir `.env` değişkeninde saklayın ve o değişkene başvurun (örn. `$SLACK_BOT_TOKEN`).',
    'Channels'       => 'Kanallar',
    'Each Slack channel needs its own Incoming Webhook URL. Use the **Test** button to fire a quick sanity check after saving.' => "Her Slack kanalı kendi Gelen Web Kancası URL'sine ihtiyaç duyar. Kaydettikten sonra hızlı bir kontrol için **Test** düğmesini kullanın.",
    'Add a channel'  => 'Bir kanal ekle',
    'Bot Token' => 'Bot Belirteci',
    'Channel ID' => 'Kanal Kimliği',
    'Bot Emoji' => 'Simge Emojisi',
    'Bot Name' => 'Kullanıcı Adı',
    'Show link previews' => 'Bağlantı önizlemelerini göster',
    'An emoji shortcode to display alongside this message, e.g. `:rocket:`. Used only when Bot Icon URL is empty.' => "Bu mesajın yanında gösterilecek emoji kısayolu, örn. `:rocket:`. Yalnızca Simge URL'si boş olduğunda kullanılır.",
    "A display name for this message. Leave blank to use the app's default." => 'Bu mesaj için bir görünen ad. Uygulamanın varsayılanını kullanmak için boş bırakın.',
    'Whether Slack should unfurl link previews for URLs in the message body.' => "Slack'in mesaj gövdesindeki URL'ler için bağlantı önizlemelerini gösterip göstermeyeceği.",
    'Not a valid Bot Token. Must start with `xoxb-`.' => 'Geçerli bir Bot Belirteci değil. `xoxb-` ile başlamalıdır.',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => 'Geçerli bir Kanal Kimliği değil. `C01234ABCD` gibi görünmelidir.',
    'Unable to send Slack message, no bot token.' => 'Slack mesajı gönderilemiyor: bot belirteci yok.',
    'Unable to send Slack message, no channel ID.' => 'Slack mesajı gönderilemiyor: kanal kimliği yok.',
    'Recipient "{name}" has no Slack bot token.' => 'Alıcı "{name}" Slack bot belirtecine sahip değil.',
    'Recipient "{name}" has no Slack channel ID.' => 'Alıcı "{name}" Slack kanal kimliğine sahip değil.',
    'Slack rejected the message: {error}' => 'Slack mesajı reddetti: {error}',
    'Save first to persist a row, then click its **Test** button to fire a sanity check against Slack.' => 'Önce kaydedip satırı kalıcı hale getirin, ardından Slack üzerinde hızlı bir kontrol için **Test** düğmesine tıklayın.',

    // Settings: Bluesky
    "[Bluesky](https://bsky.app) posts publish to the configured account's feed via the ATProto API. App passwords are generated at [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). An app password is a secret, so store it in a `.env` variable and reference that variable (e.g. `\$BLUESKY_APP_PASSWORD`) rather than pasting the password directly." => "[Bluesky](https://bsky.app) gönderileri ATProto API üzerinden yapılandırılmış hesabın akışına yayımlanır. Uygulama parolaları [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords) adresinde oluşturulur. Bir uygulama parolası gizli bir bilgidir; bu nedenle parolayı doğrudan yapıştırmak yerine bir `.env` değişkeninde saklayın ve o değişkene (örn. `\$BLUESKY_APP_PASSWORD`) başvurun.",
    'PDS URL'          => "PDS URL'si",
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => "Varsayılan https://bsky.social. Kurulumunuz federasyon yapıyorsa özel bir PDS'i gösterin.",
    'Bluesky Accounts' => 'Bluesky hesapları',
    'Named list of Bluesky accounts. Each account becomes selectable on the notification edit screen.' => 'Adlandırılmış Bluesky hesapları listesi. Her hesap bildirim düzenleme ekranında seçilebilir hale gelir.',
    'Accounts'         => 'Hesaplar',
    'Add one row per Bluesky account. Use **Test** to verify the credentials authenticate.' => "Her Bluesky hesabı için bir satır ekleyin. Kimlik bilgilerinin doğrulanıp doğrulanmadığını görmek için **Test**'i kullanın.",
    'Label'            => 'Etiket',
    'Handle'           => 'Tanıtıcı',
    'App password'     => 'Uygulama parolası',
    'Add an account'   => 'Bir hesap ekle',
    'Save first to persist a row, then click its **Test** button to verify the credentials authenticate.' => 'Önce kaydedip satırı kalıcı hale getirin, ardından kimlik bilgilerinin doğrulanıp doğrulanmadığını görmek için **Test** düğmesine tıklayın.',

    // Test notification (UI)
    'Send a test message'           => 'Bir test mesajı gönder',
    'Are you certain you want to send a test notification?\\n\\nThe configured message will be sent to the configured recipient(s).' => 'Bir test bildirimi göndermek istediğinizden emin misiniz?\\n\\nYapılandırılmış mesaj, yapılandırılmış alıcı(lar)a gönderilecektir.',
    'Test'                          => 'Test',
    'Test notification dispatched.' => 'Test bildirimi gönderildi.',
    'No messages were dispatched. Check the recipient configuration.' => 'Hiçbir mesaj gönderilmedi. Alıcı yapılandırmasını kontrol edin.',

    // Settings: save / test action responses
    "Couldn't save settings."                 => 'Ayarlar kaydedilemedi.',
    'Settings saved.'                         => 'Ayarlar kaydedildi.',
    'Topic is empty.'                         => 'Konu boş.',
    'Server URL is not configured.'           => "Sunucu URL'si yapılandırılmadı.",
    'Test message from Notifier.'             => "Notifier'dan test mesajı.",
    'HTTP {status}'                           => 'HTTP {status}',
    'Test message sent successfully.'         => 'Test mesajı başarıyla gönderildi.',
    'HTTP {status}: {body}'                   => 'HTTP {status}: {body}',
    'Handle and app password are required.'   => 'Tanıtıcı ve uygulama parolası gerekli.',
    'Authentication failed.'                  => 'Kimlik doğrulama başarısız.',
    'Successfully authenticated. No messages were posted.' => 'Kimlik doğrulama başarılı. Hiçbir mesaj gönderilmedi.',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.'          => '{recipient} alıcısına {messageType} gönderiliyor.',
    'Adding message to queue.'                       => 'Mesaj kuyruğa ekleniyor.',
    'Unable to parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => 'Akış ayrıştırılamıyor. PHP `simplexml` ve `libxml` uzantıları gereklidir.',
    'Unable to parse the feed.' => 'Akış ayrıştırılamıyor.',
    'Unable to fetch the feed: {message}' => 'Akış alınamıyor: {message}',
    'Initial feed scan failed: {message}' => 'İlk akış taraması başarısız: {message}',
    'Sending message immediately (bypassing queue).' => 'Mesaj hemen gönderiliyor (kuyruk atlanıyor).',
    'Log events deleted.'                            => 'Günlük olayları silindi.',
    'notification'                                   => 'bildirim',

    // Outbound: Email log messages
    'Unable to send email, no recipient specified.'     => 'E-posta gönderilemiyor, alıcı belirtilmedi.',
    'Unable to send email, the message body was empty.' => 'E-posta gönderilemiyor, mesaj gövdesi boş.',
    "Unable to send the email using Craft's native email handling." => "Craft'in yerleşik e-posta yönetimini kullanarak e-posta gönderilemiyor.",
    'Check your general email settings within Craft.'   => "Craft'taki genel e-posta ayarlarınızı kontrol edin.",
    'Successfully sent email message!'                  => 'E-posta başarıyla gönderildi!',

    // Outbound: SMS log messages
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[Geçersiz Twilio kimlik bilgileri.]({url}) Eksik: {missing}.',
    'Unable to send SMS, no Twilio phone number exists.'      => 'SMS gönderilemiyor, Twilio telefon numarası yok.',
    'Unable to send SMS, no recipient phone number exists.'   => 'SMS gönderilemiyor, alıcı telefon numarası yok.',
    'Unable to send SMS, recipient phone number is invalid.'  => 'SMS gönderilemiyor, alıcı telefon numarası geçersiz.',
    'Successfully sent SMS message!'                          => 'SMS başarıyla gönderildi!',

    // Outbound: Announcement log messages
    'Unable to post announcement, no recipient userId specified.' => 'Duyuru yayımlanamıyor: alıcı userId belirtilmedi.',
    'Successfully posted announcement!' => 'Duyuru başarıyla yayımlandı!',

    // Outbound: Flash log messages
    'Unable to send the flash message, invalid flash type.' => 'Flash mesaj gönderilemiyor: geçersiz flash türü.',
    'Successfully sent flash message!'                      => 'Flash mesajı başarıyla gönderildi!',

    // Outbound: Pushover log messages
    '[Invalid Pushover credentials.]({url}) Missing app token.'  => '[Geçersiz Pushover kimlik bilgileri.]({url}) Uygulama anahtarı eksik.',
    'Unable to send Pushover message, no user key on recipient.' => 'Pushover mesajı gönderilemiyor: alıcıda kullanıcı anahtarı yok.',
    'Pushover POST failed: {reason}'                             => 'Pushover POST başarısız: {reason}',
    'Successfully sent Pushover message!'                        => 'Pushover mesajı başarıyla gönderildi!',

    // Outbound: ntfy log messages
    'Unable to send ntfy message, no server URL configured.' => "ntfy mesajı gönderilemiyor: sunucu URL'si yapılandırılmamış.",
    'Unable to send ntfy message, no topic specified.'       => 'ntfy mesajı gönderilemiyor: konu belirtilmedi.',
    'ntfy POST failed with HTTP {status}: {reason}'          => 'ntfy POST HTTP {status} ile başarısız: {reason}',
    'ntfy POST failed: {reason}'                             => 'ntfy POST başarısız: {reason}',
    'Successfully sent ntfy message to topic "{topic}".'     => '"{topic}" konusuna ntfy mesajı başarıyla gönderildi.',

    // Outbound: Slack log messages
    'Unable to send Slack message, body is empty.'  => 'Slack mesajı gönderilemiyor: gövde boş.',
    'Slack POST failed: {reason}'                   => 'Slack POST başarısız: {reason}',
    'Successfully sent Slack message to "{label}".' => "\"{label}\"'a Slack mesajı başarıyla gönderildi.",

    // Outbound: Bluesky log messages
    'Unable to send Bluesky post, recipient is missing credentials.' => 'Bluesky gönderisi gönderilemiyor: alıcının kimlik bilgileri eksik.',
    'Body exceeded {max} characters, truncated.'          => 'Gövde {max} karakteri aştı, kısaltıldı.',
    'Successfully posted to Bluesky as "{label}".'        => "\"{label}\" olarak Bluesky'da başarıyla yayımlandı.",
    'Bluesky auth failed for {handle}: {reason}'          => '{handle} için Bluesky kimlik doğrulaması başarısız: {reason}',
    'Bluesky auth failed: {reason}'                       => 'Bluesky kimlik doğrulaması başarısız: {reason}',
    'Bluesky post failed: {reason}'                       => 'Bluesky gönderisi başarısız: {reason}',
    'Bluesky link preview skipped: {reason}'              => 'Bluesky bağlantı önizlemesi atlandı: {reason}',

    // Recipient-strategy warnings
    'Recipient "{name}" has no email address.'       => '"{name}" alıcısının e-posta adresi yok.',
    'Recipient "{name}" has no phone number.'        => '"{name}" alıcısının telefon numarası yok.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => '"{name}" alıcısı için ilişkilendirilmiş bir Kullanıcı yok; duyuru gönderilemez.',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => '"{name}" alıcısı kontrol paneline erişemez; duyuru gönderilemez.',
    'Pushover user-key field is not configured on this notification.' => 'Bu bildirimde Pushover kullanıcı anahtarı alanı yapılandırılmamış.',
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => '"{name}" alıcısı için ilişkilendirilmiş bir Kullanıcı yok; Pushover mesajı gönderilemez.',
    '[SKIPPED] User "{name}" has no Pushover key.'   => '[ATLANDI] "{name}" kullanıcısının Pushover anahtarı yok.',
    'Recipient "{name}" has no ntfy topic.'          => '"{name}" alıcısının ntfy konusu yok.',
    'Recipient "{name}" has no Bluesky credentials.' => '"{name}" alıcısının Bluesky kimlik bilgileri yok.',

    // Errors / exceptions
    'Invalid element event: {class}'                         => 'Geçersiz öğe olayı: {class}',
    'Invalid notification ID: {id}'                          => 'Geçersiz bildirim kimliği: {id}',
    'Invalid email message mode.'                            => 'Geçersiz e-posta mesaj modu.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Dinamik Alıcılar türünü kullanma izniniz yok.',
    'Dynamic recipients snippet did not call setRecipients.' => 'Dinamik alıcılar parçacığı setRecipients çağırmadı.',
    'setRecipients was called with an empty value.'          => 'setRecipients boş bir değerle çağrıldı.',
    'Unrecognized recipient of type "{type}".'               => 'Tanınmayan "{type}" türünde alıcı.',
    'Unrecognized recipient "{value}".'                      => 'Tanınmayan alıcı "{value}".',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => 'Yapılandırılmış {kind} artık eklenti ayarlarında yok (uid: {uid}).',
    'Invalid settings section: {section}'                    => 'Geçersiz ayar bölümü: {section}',
    'User not authorized to save this notification.'         => 'Kullanıcı bu bildirimi kaydetme yetkisine sahip değil.',
    'User not authorized to view this notification.'         => 'Kullanıcı bu bildirimi görüntüleme yetkisine sahip değil.',
    'User not authorized to delete this notification.'       => 'Kullanıcı bu bildirimi silme yetkisine sahip değil.',
    'Notification not found'                                 => 'Bildirim bulunamadı',

    // Misc config-file note
    'This is being set in the config file. [{file}]' => 'Bu, yapılandırma dosyasında ayarlanır. [{file}]',

    // Slack, ntfy, and Bluesky message types
    "Add the Bluesky accounts you'd like to post from. Each account becomes available as a recipient on the **Recipients** tab when configuring a notification." => 'Gönderim yapmak istediğiniz Bluesky hesaplarını ekleyin. Bir bildirim yapılandırırken her hesap **Alıcılar** sekmesinde alıcı olarak kullanılabilir hale gelir.',
    "Click any row's **Test** button to confirm the account authenticates." => 'Hesabın kimlik doğrulamasından geçtiğini onaylamak için herhangi bir satırın **Test** düğmesine tıklayın.',
    "Click any row's **Test** button to send a quick test message to that channel." => 'O kanala hızlı bir test mesajı göndermek için herhangi bir satırın **Test** düğmesine tıklayın.',
    'Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`.' => 'İsteğe bağlı, kendi sunucunuzda barındırdığınız bir ntfy örneğini gösterin (geçerliyse). Varsayılan `https://ntfy.sh`.',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'İsteğe bağlı, korumalı konular veya kimlik doğrulamalı kendi sunucunuzda barındırdığınız örnekler için gereklidir.',
    'Add the ntfy topics you\'d like to send messages to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification.' => 'Mesaj göndermek istediğiniz ntfy konularını ekleyin. Bir bildirim yapılandırırken her konu **Alıcılar** sekmesinde alıcı olarak kullanılabilir hale gelir.',
    "Click any row's **Test** button to send a quick test message to that topic." => 'O konuya hızlı bir test mesajı göndermek için herhangi bir satırın **Test** düğmesine tıklayın.',
    'Enable Markdown' => 'Markdown\'ı etkinleştir',
    'Link URL' => "Bağlantı URL'si",

    // Manual triggers
    'Send Notification'                                            => 'Bildirim gönder',
    'Send manual notifications'                                    => 'Manuel bildirim gönder',
    'Are you sure you want to send this notification?'             => 'Bu bildirimi göndermek istediğinizden emin misiniz?',
    'This notification cannot be triggered manually.'              => 'Bu bildirim manuel olarak tetiklenemez.',
    'This notification no longer applies to the selected element.' => 'Bu bildirim artık seçili öğeye uygulanmıyor.',
    'Notification was not sent. Check the Notification Log for details.' => 'Bildirim gönderilmedi. Ayrıntılar için Bildirim günlüğüne bakın.',
    'Notification sent.'                                           => 'Bildirim gönderildi.',
    'Element not found'                                            => 'Öğe bulunamadı',
    'Trigger Label'                                                => 'Tetikleyici etiketi',
    'An element action label (helps to differentiate multiple triggers).'        => 'Öge eylemi etiketi (birden fazla tetikleyiciyi ayırt etmeye yardımcı olur).',

    // Event tab: date trigger
    'On'                                                          => 'Tarihinde',
    'days before'                                                 => 'gün önce',
    'days after'                                                  => 'gün sonra',
    'Relevant Date'                                               => 'İlgili Tarih',
    'Send the notification relative to a chosen date.'            => 'Bildirimi seçilen bir tarihe göre gönderin.',
    "Fires when an entry's Post Date passes and it becomes Live." => 'Bir girdinin yayın tarihi geldiğinde ve yayına geçtiğinde tetiklenir.',

    // Scheduled sending
    'Scheduled Sending' => 'Zamanlanmış gönderim',
    'Shared secret for authenticating scheduled-run web requests. Required only when the schedule is triggered via the web endpoint.' => 'Zamanlanmış çalıştırma web isteklerinin kimliğini doğrulamak için paylaşılan gizli anahtar. Yalnızca zamanlama web uç noktası üzerinden tetiklendiğinde gereklidir.',
    'Scheduled-Run Token' => 'Zamanlanmış çalıştırma belirteci',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => 'Her istekle birlikte X-Notifier-Token başlığı veya token gövde parametresi olarak gönderilir.',
    'Pushover Title' => 'Pushover Başlık',
    'Pushover Body' => 'Pushover Gövde',
    'ntfy Title' => 'ntfy Başlık',
    'ntfy Body' => 'ntfy Gövde',
    'ntfy Link URL' => 'ntfy Bağlantı URL\'si',
    'Render Link Previews' => 'Bağlantı önizlemelerini göster',
    'Don\'t unfurl' => 'Genişletme',
    'Expand link previews' => 'Bağlantı önizlemelerini genişlet',
    'Regular text only' => 'Yalnızca düz metin',
    'Markdown enabled' => 'Markdown etkin',
    'Dynamic Pushover Title' => 'Dinamik Pushover Başlık',
    'Dynamic Subject Line' => 'Dinamik Konu Satırı',
    'Dynamic Bot Name' => 'Dinamik Bot Adı',
    'Dynamic ntfy Title' => 'Dinamik ntfy Başlık',
    'Dynamic Announcement Title' => 'Dinamik Duyuru Başlığı',
    'Dynamic Flash Message Title' => 'Dinamik Flash Mesaj Başlığı',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => 'Düz metin, en fazla 300 karakter. URL\'ler ve `@handle.tld` etiketlemeleri otomatik olarak bağlantıya dönüşür.',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => 'Gönderi gövdesinde bir URL olduğunda otomatik olarak önizleme kartı oluşturur.',
    'Whether the message be sent via the [jobs queue]({queueUrl}).' => 'Mesajın [iş kuyruğu]({queueUrl}) üzerinden gönderilip gönderilmeyeceği.',
    'Priority level of the ntfy message.' => 'ntfy mesajının öncelik seviyesi.',
    'Optionally include comma-separated [emoji shortcodes](https://docs.ntfy.sh/emojis/).' => 'İsteğe bağlı olarak virgülle ayrılmış [emoji kısa kodları](https://docs.ntfy.sh/emojis/) ekleyin.',
    'Body of the ntfy notification.' => 'ntfy bildiriminin gövdesi.',
    'Optionally open a URL when the notification is clicked.' => 'İsteğe bağlı olarak, bildirime tıklandığında bir URL açın.',
    'Whether to parse the body as Markdown in supported clients.' => 'Gövdenin desteklenen istemcilerde Markdown olarak işlenip işlenmeyeceği.',
    'Heading of the announcement.' => 'Duyurunun başlığı.',
    'Body of the announcement. Supports Markdown.' => 'Duyurunun gövdesi. Markdown\'ı destekler.',
    'Heading of the flash message.' => 'Flash mesajının başlığı.',
    'Optionally include details below the heading. Supports Markdown and HTML.' => 'İsteğe bağlı olarak başlığın altına ayrıntı ekleyin. Markdown ve HTML\'i destekler.',
    'Optionally include a heading above the body.' => 'İsteğe bağlı olarak gövdenin üstüne bir başlık ekleyin.',
    'Body of the SMS (text message). Plain text only.' => 'SMS (kısa mesaj) gövdesi. Yalnızca düz metin.',
    'Body of the Pushover notification. Plain text only.' => 'Pushover bildiriminin gövdesi. Yalnızca düz metin.',
    'Subject line of the email.' => 'E-postanın konu satırı.',
    'Body of the email. Supports HTML.' => 'E-postanın gövdesi. HTML\'i destekler.',
    'Body of the Slack message. Supports [Slack mrkdwn](https://api.slack.com/reference/surfaces/formatting) syntax.' => 'Slack mesajının gövdesi. [Slack mrkdwn](https://api.slack.com/reference/surfaces/formatting) söz dizimini destekler.',
    'Optionally override the app\'s display name.' => 'İsteğe bağlı olarak uygulamanın görünen adını geçersiz kılın.',
    'Optionally override the app\'s icon with a URL.' => 'İsteğe bağlı olarak uygulamanın simgesini bir URL ile geçersiz kılın.',
    'Optionally override the app\'s icon with an emoji. Used only when Bot Icon URL is empty.' => 'İsteğe bağlı olarak uygulamanın simgesini bir emoji ile geçersiz kılın. Yalnızca Bot Icon URL boşken kullanılır.',
];
