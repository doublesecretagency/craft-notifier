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
    'View notifications'              => 'Bildirimleri görüntüleme',
    'Save notifications'              => 'Bildirimleri kaydetme',
    'Use the Dynamic Recipients type' => 'Dinamik Alıcılar türünü kullanma',
    'Test notifications'              => 'Bildirimleri test et',
    'Delete notifications'            => 'Bildirimleri silme',
    'View notification log'           => 'Bildirim günlüğünü görüntüleme',
    'Delete notification log'         => 'Bildirim günlüğünü silme',

    // Notification editor: tabs
    'Meta'       => 'Meta',
    'Event'      => 'Olay',
    'Message'    => 'Mesaj',
    'Recipients' => 'Alıcılar',

    // Event tab
    'Event Type'                                           => 'Olay türü',
    'What type of event will activate the notification?'   => 'Bildirimi hangi olay türü tetikler?',
    'Which specific event will activate the notification?' => 'Bildirimi hangi belirli olay tetikler?',
    'Assets Event'                                         => 'Asset olayı',
    'Commerce Orders Event'                                => 'Commerce sipariş olayı',
    'Entries Event'                                        => 'Giriş olayı',
    'Users Event'                                          => 'Kullanıcı olayı',

    // Field and element conditions
    'Field Conditions'                                                               => 'Alan koşulları',
    'Send the message only when the saved element matches the following conditions.' => 'Mesajı yalnızca kaydedilen öge aşağıdaki koşulları karşıladığında gönder.',
    'has changed'                                                                    => 'değişti',
    '#{elementType} Event Filters'                                                   => '#{elementType} olay filtreleri',
    'No filters match this event.'                                                   => 'Bu olayla eşleşen filtre yok.',
    'Determine whether each message should be sent based on specified conditions.'   => 'Belirtilen koşullara göre her mesajın gönderilip gönderilmeyeceğini belirleyin.',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => 'Öge ilk kez kaydediliyor',
    'Must be a new entry'                       => 'Yeni bir giriş olmalıdır',
    'Must be an existing entry'                 => 'Mevcut bir giriş olmalıdır',
    'Can be existing or new'                    => 'Mevcut ya da yeni olabilir',

    // Filters: new elements
    'Element is new'         => 'Öge yeni',
    'New elements only'      => 'Yalnızca yeni ögeler',
    'Existing elements only' => 'Yalnızca mevcut ögeler',

    // Filters: enabled state
    'Element is enabled'         => 'Öge etkin',
    'Must be enabled'            => 'Etkin olmalıdır',
    'Must be disabled'           => 'Devre dışı olmalıdır',
    'Can be enabled or disabled' => 'Etkin ya da devre dışı olabilir',

    // Filters: drafts
    'Element is a draft'          => 'Öge bir taslaktır',
    'Must be a draft'             => 'Taslak olmalıdır',
    'Must not be a draft'         => 'Taslak olmamalıdır',
    'Can be a draft or non-draft' => 'Taslak ya da değil olabilir',

    // Filters: provisional drafts
    'Element is a provisional draft'                => 'Öge geçici bir taslaktır',
    'Must be a provisional draft'                   => 'Geçici taslak olmalıdır',
    'Must not be a provisional draft'               => 'Geçici taslak olmamalıdır',
    'Can be a provisional draft or non-provisional' => 'Geçici ya da değil olabilir',

    // Filters: revisions
    'Element is a revision'             => 'Öge bir revizyondur',
    'Must be a revision'                => 'Revizyon olmalıdır',
    'Must not be a revision'            => 'Revizyon olmamalıdır',
    'Can be a revision or non-revision' => 'Revizyon ya da değil olabilir',

    // Filters: duplication
    'Element is being duplicated'         => 'Öge çoğaltılıyor',
    'Must be duplicating the element'     => 'Ögeyi çoğaltıyor olmalıdır',
    'Must not be duplicating the element' => 'Ögeyi çoğaltıyor olmamalıdır',

    // Filters: propagation
    'Element is being propagated'     => 'Öge yayılıyor',
    'Element must be propagating'     => 'Öge yayılıyor olmalıdır',
    'Element must not be propagating' => 'Öge yayılıyor olmamalıdır',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => 'Öge toplu olarak yeniden kaydediliyor',
    'Must be bulk-resaving the element'     => 'Ögeyi toplu olarak yeniden kaydediyor olmalıdır',
    'Must not be bulk-resaving the element' => 'Ögeyi toplu olarak yeniden kaydediyor olmamalıdır',

    // Filters: common output
    'Unnamed filter'                => 'İsimsiz filtre',
    'Must be TRUE to send message'  => 'Mesajı göndermek için TRUE olmalıdır',
    'Must be FALSE to send message' => 'Mesajı göndermek için FALSE olmalıdır',
    'No effect'                     => 'Etkisiz',

    // Message tab: type selector and queue
    'Message Type'                                                 => 'Mesaj türü',
    'What type of message will be sent?'                           => 'Hangi tür mesaj gönderilecek?',
    'Send Message via Queue'                                       => 'Mesajı kuyruk üzerinden gönder',
    'Should the message be sent via the [jobs queue]({queueUrl})?' => 'Mesaj [iş kuyruğu]({queueUrl}) üzerinden gönderilsin mi?',

    // Email message
    'Email Subject'              => 'E-posta konusu',
    'Email Body'                 => 'E-posta içeriği',
    "User's Email Address Field" => 'Kullanıcının e-posta adresi alanı',

    // SMS message
    'SMS Message Body'          => 'SMS mesaj içeriği',
    "User's Phone Number Field" => 'Kullanıcının telefon numarası alanı',

    // Announcement message
    'Announcement Title'   => 'Duyuru başlığı',
    'Announcement Message' => 'Duyuru mesajı',

    // Flash message
    'Flash Message Type'                         => 'Flash mesaj türü',
    'Flash Message Title'                        => 'Flash mesaj başlığı',
    'Flash Message Details'                      => 'Flash mesaj ayrıntıları',
    'Which type of flash message should appear?' => 'Hangi tür flash mesaj görünmelidir?',

    // Trix toolbar (rich-text editing)
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
    'Redo'          => 'Yeniden uygula',

    // Email body instructions (HTML)
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => 'Giden e-postanın gövdesi. <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">Özel değişkenler</a> kullanabilir, hatta <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">alıcıları atlayabilirsiniz</a>.',

    // Recipients tab
    'Recipients Type'                             => 'Alıcı türü',
    'Who will receive this message?'              => 'Bu mesajı kim alacak?',
    'Add a message recipient'                     => 'Bir alıcı ekle',
    'Select User(s)'                              => 'Kullanıcı seçin',
    'Which users will receive the message?'       => 'Mesajı hangi kullanıcılar alacak?',
    'Which user groups will receive the message?' => 'Mesajı hangi kullanıcı grupları alacak?',
    'Ungrouped Users'                             => 'Grupsuz kullanıcılar',
    'Twig Snippet to Determine Recipients'        => 'Alıcıları belirlemek için Twig parçası',

    // Settings: Twilio
    'Twilio Account SID'                             => 'Twilio Account SID',
    'Twilio Auth Token'                              => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)'   => 'Twilio telefon numarası (her SMS mesajını gönderir)',
    'This is being set in the config file. [{file}]' => 'Yapılandırma dosyasında ayarlanıyor. [{file}]',

    // Settings: Logging
    'Logging'                                                                                                                                         => 'Günlükleme',
    'Enable Logging'                                                                                                                                  => 'Günlüklemeyi etkinleştir',
    'When disabled, Notifier will not write anything to the notification log.'                                                                        => 'Devre dışı bırakıldığında Notifier bildirim günlüğüne hiçbir şey yazmaz.',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier gönderilen mesajların sürekli bir günlüğünü tutar. Genellikle gerekli değildir, ancak veritabanında kaydedilen günlük olaylarının sayısını sınırlayabilirsiniz.',
    'Number of log events to retain'                                                                                                                  => 'Saklanacak günlük olay sayısı',
    'At most, keep this many log events. Leave blank for no limit.'                                                                                   => 'En fazla bu kadar günlük olayını saklayın. Sınır olmaması için boş bırakın.',
    'Number of days to retain log events'                                                                                                             => 'Günlük olaylarının saklanacağı gün sayısı',
    'At most, keep log events for this many days. Leave blank for no limit.'                                                                          => 'Günlük olaylarını en fazla bu kadar gün saklayın. Sınır olmaması için boş bırakın.',

    // Test notification
    'Send a test message'                                                                                                          => 'Test mesajı gönder',
    'Are you certain you want to send a test notification?\n\nThe configured message will be sent to the configured recipient(s).' => 'Test bildirimi göndermek istediğinizden emin misiniz?\n\nYapılandırılan mesaj, yapılandırılan alıcılara gönderilecek.',
    'Test'                                                                                                                         => 'Test',
    'Test notification dispatched.'                                                                                                => 'Test bildirimi gönderildi.',
    'No messages were dispatched. Check the recipient configuration.'                                                              => 'Hiçbir mesaj gönderilmedi. Alıcı yapılandırmasını kontrol edin.',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.' => '{messageType} {recipient} alıcısına gönderiliyor.',
    'Log events deleted.'                   => 'Günlük olayları silindi.',
    'notification'                          => 'bildirim',

    // Errors
    'Invalid email message mode.'                                    => 'Geçersiz e-posta mesajı modu.',
    'Dynamic recipients snippet did not call setRecipients.'         => 'Dinamik alıcılar parçası setRecipients çağrısını yapmadı.',
    'setRecipients was called with an empty value.'                  => 'setRecipients boş bir değerle çağrıldı.',
    'Unrecognized recipient "{value}".'                              => 'Tanınmayan alıcı "{value}".',
    'Unrecognized recipient of type "{type}".'                       => '"{type}" türünde tanınmayan alıcı.',
    'Recipient "{name}" has no email address.'                       => '"{name}" alıcısının e-posta adresi yok.',
    'Recipient "{name}" has no phone number.'                        => '"{name}" alıcısının telefon numarası yok.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => '"{name}" alıcısının ilişkili bir kullanıcısı yok; duyuru gönderilemiyor.',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => '"{name}" alıcısı kontrol paneline erişemiyor; duyuru gönderilemiyor.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Dinamik Alıcılar türünü kullanma izniniz yok.',

];
