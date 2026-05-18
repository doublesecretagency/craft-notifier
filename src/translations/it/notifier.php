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
    'Notifications'          => 'Notifiche',
    'Notification'           => 'Notifica',
    'All notifications'      => 'Tutte le notifiche',
    'Notification Log'       => 'Registro notifiche',
    'Logs'                   => 'Registri',
    'View Notifications'     => 'Vedi notifiche',
    'Add a New Notification' => 'Aggiungi una nuova notifica',

    // Permissions
    'View notifications'              => 'Vedi le notifiche',
    'Save notifications'              => 'Salva le notifiche',
    'Use the Dynamic Recipients type' => 'Usa il tipo Destinatari dinamici',
    'Test notifications'              => 'Prova le notifiche',
    'Delete notifications'            => 'Elimina le notifiche',
    'View notification log'           => 'Vedi il registro notifiche',
    'Delete notification log'         => 'Elimina il registro notifiche',

    // Notification editor: tabs
    'Meta'       => 'Meta',
    'Event'      => 'Evento',
    'Message'    => 'Messaggio',
    'Recipients' => 'Destinatari',

    // Event tab: type selector
    'Event Type'                                           => 'Tipo di evento',
    'What type of event will activate the notification?'   => 'Quale tipo di evento attiverà la notifica?',
    'Which specific event will activate the notification?' => 'Quale evento specifico attiverà la notifica?',

    // Event tab: event types
    'Assets Event'                   => 'Evento Asset',
    'Commerce Orders Event'          => 'Evento ordini Commerce',
    'Commerce Products Event'        => 'Evento prodotti Commerce',
    'Digital Products Event'         => 'Evento Digital Products',
    'Digital Product Licenses Event' => 'Evento licenze Digital Products',
    'Solspace Calendar Event'        => 'Evento Solspace Calendar',
    'Entries Event'                  => 'Evento voci',
    'Users Event'                    => 'Evento utenti',
    'Ungrouped Users'                => 'Utenti senza gruppo',

    // Field and element conditions
    'Field Conditions'             => 'Condizioni del campo',
    'Send the message only when the saved element matches the following conditions.' => "Invia il messaggio solo quando l'elemento salvato soddisfa le seguenti condizioni.",
    'has changed'                  => 'è cambiato',
    '#{elementType} Event Filters' => 'Filtri eventi per #{elementType}',
    'No filters match this event.' => 'Nessun filtro corrisponde a questo evento.',
    'Determine whether each message should be sent based on specified conditions.' => 'Determina se ogni messaggio debba essere inviato in base alle condizioni specificate.',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => "L'elemento viene salvato per la prima volta",
    'Must be a new entry'                       => 'Deve essere una voce nuova',
    'Must be an existing entry'                 => 'Deve essere una voce esistente',
    'Can be existing or new'                    => 'Può essere esistente o nuovo',

    // Filters: new elements
    'Element is new'         => "L'elemento è nuovo",
    'New elements only'      => 'Solo elementi nuovi',
    'Existing elements only' => 'Solo elementi esistenti',

    // Filters: enabled state
    'Element is enabled'         => "L'elemento è abilitato",
    'Must be enabled'            => 'Deve essere abilitato',
    'Must be disabled'           => 'Deve essere disabilitato',
    'Can be enabled or disabled' => 'Può essere abilitato o disabilitato',

    // Filters: drafts
    'Element is a draft'          => "L'elemento è una bozza",
    'Must be a draft'             => 'Deve essere una bozza',
    'Must not be a draft'         => 'Non deve essere una bozza',
    'Can be a draft or non-draft' => 'Può essere una bozza o no',

    // Filters: provisional drafts
    'Element is a provisional draft'                => "L'elemento è una bozza provvisoria",
    'Must be a provisional draft'                   => 'Deve essere una bozza provvisoria',
    'Must not be a provisional draft'               => 'Non deve essere una bozza provvisoria',
    'Can be a provisional draft or non-provisional' => 'Può essere una bozza provvisoria o no',

    // Filters: revisions
    'Element is a revision'             => "L'elemento è una revisione",
    'Must be a revision'                => 'Deve essere una revisione',
    'Must not be a revision'            => 'Non deve essere una revisione',
    'Can be a revision or non-revision' => 'Può essere una revisione o no',

    // Filters: duplication
    'Element is being duplicated'         => "L'elemento è in duplicazione",
    'Must be duplicating the element'     => "L'elemento deve essere in duplicazione",
    'Must not be duplicating the element' => "L'elemento non deve essere in duplicazione",

    // Filters: propagation
    'Element is being propagated'     => "L'elemento è in propagazione",
    'Element must be propagating'     => "L'elemento deve essere in propagazione",
    'Element must not be propagating' => "L'elemento non deve essere in propagazione",

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => "L'elemento è in salvataggio massivo",
    'Must be bulk-resaving the element'     => "L'elemento deve essere in salvataggio massivo",
    'Must not be bulk-resaving the element' => "L'elemento non deve essere in salvataggio massivo",

    // Filters: common output
    'Unnamed filter'                => 'Filtro senza nome',
    'Must be TRUE to send message'  => 'Deve essere TRUE per inviare il messaggio',
    'Must be FALSE to send message' => 'Deve essere FALSE per inviare il messaggio',
    'No effect'                     => 'Nessun effetto',

    // Message tab: type selector and queue
    'Message Type'                       => 'Tipo di messaggio',
    'What type of message will be sent?' => 'Quale tipo di messaggio verrà inviato?',
    'Send Message via Queue'             => 'Invia il messaggio tramite coda',
    'Should the message be sent via the [jobs queue]({queueUrl})?' => 'Il messaggio deve essere inviato tramite la [coda dei job]({queueUrl})?',
    'Send immediately' => 'Invia immediatamente',
    'Add to queue' => 'Aggiungi alla coda',

    // Message tab: Email fields
    "User's Email Address Field" => "Campo email dell'utente",
    'Email Subject'              => 'Oggetto email',
    'Email Body'                 => 'Corpo email',

    // Message tab: SMS fields
    "User's Phone Number Field" => "Campo telefono dell'utente",
    'SMS Message Body'          => 'Corpo del messaggio SMS',

    // Message tab: Announcement fields
    'Announcement Title'   => "Titolo dell'annuncio",
    'Announcement Message' => "Messaggio dell'annuncio",

    // Message tab: Flash fields
    'Flash Message Type'                         => 'Tipo di messaggio flash',
    'Flash Message Title'                        => 'Titolo del messaggio flash',
    'Flash Message Details'                      => 'Dettagli del messaggio flash',
    'Which type of flash message should appear?' => 'Quale tipo di messaggio flash deve apparire?',

    // Message tab: Pushover fields
    "Field containing each user's Pushover key" => "Campo della chiave Pushover dell'utente",
    'The Pushover application token is configured in [Settings → Pushover](url).' => "Il token dell'applicazione Pushover si configura in [Impostazioni → Pushover](url).",

    // Message tab: ntfy fields
    'Priority'           => 'Priorità',
    'Tags'               => 'Tag',
    'Click URL'          => 'URL al clic',
    'Render as Markdown' => 'Renderizza come Markdown',

    // Message tab: Slack fields
    'Slack Message Body' => 'Corpo del messaggio Slack',

    // Message tab: Bluesky fields
    'Post Body' => 'Corpo del post',
    'Generate Link Preview' => 'Genera anteprima del link',
    "When the post body contains a URL, automatically generate a preview card with the linked page's image, title, and description." => 'Quando il corpo del post contiene un URL, viene allegata una scheda di anteprima con titolo, descrizione e immagine della pagina collegata.',
    'No card' => 'Nessuna scheda',
    'Generate preview card' => 'Genera scheda di anteprima',

    // Message tab: Title / Body / Trix toolbar
    'Title'         => 'Titolo',
    'Body'          => 'Corpo',
    'Rich Text'     => 'Testo formattato',
    'Bold'          => 'Grassetto',
    'Italic'        => 'Corsivo',
    'Underline'     => 'Sottolineato',
    'Strikethrough' => 'Barrato',
    'Bullets'       => 'Elenco puntato',
    'Numbers'       => 'Elenco numerato',
    'Heading'       => 'Intestazione',
    'Code'          => 'Codice',
    'Undo'          => 'Annulla',
    'Redo'          => 'Ripeti',
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => "Corpo dell'email in uscita. Puoi usare <a href=\"https://plugins.doublesecretagency.com/notifier/messages/variables\" target=\"_blank\">variabili speciali</a>, o anche <a href=\"https://plugins.doublesecretagency.com/notifier/messages/skip\" target=\"_blank\">saltare destinatari</a>.",

    // Recipients tab: common
    'Recipients Type'                             => 'Tipo di destinatari',
    'Who will receive this message?'              => 'Chi riceverà questo messaggio?',
    'Add a message recipient'                     => 'Aggiungi un destinatario',
    'Select User(s)'                              => 'Seleziona utente/i',
    'Which users will receive the message?'       => 'Quali utenti riceveranno il messaggio?',
    'Which user groups will receive the message?' => 'Quali gruppi di utenti riceveranno il messaggio?',
    'Twig Snippet to Determine Recipients'        => 'Snippet Twig per determinare i destinatari',

    // Recipients tab: per-provider pickers
    'Select Slack channel(s)'                           => 'Seleziona canale/i Slack',
    'Which Slack channels should receive this message?' => 'Quali canali Slack devono ricevere questo messaggio?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Nessun canale Slack configurato. Aggiungine uno in [Impostazioni → Slack]({url}).',
    'Select ntfy topic(s)'                              => 'Seleziona argomento/i ntfy',
    'Which ntfy topics should receive this message?'    => 'Quali argomenti ntfy devono ricevere questo messaggio?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'Nessun argomento ntfy configurato. Aggiungine uno in [Impostazioni → ntfy]({url}).',
    'Select Bluesky account(s)'                         => 'Seleziona account Bluesky',
    'Which Bluesky accounts should post this message?'  => 'Quali account Bluesky devono pubblicare questo messaggio?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Nessun account Bluesky configurato. Aggiungine uno in [Impostazioni → Bluesky]({url}).',

    // Settings: page chrome
    'Notifier Settings' => 'Impostazioni Notifier',
    'General'           => 'Generale',
    'Twilio'            => 'Twilio',
    'Pushover'          => 'Pushover',
    'Slack'             => 'Slack',
    'Bluesky'           => 'Bluesky',
    'ntfy'              => 'ntfy',

    // Settings: Logging
    'Logging'                             => 'Registrazione',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier mantiene un registro continuo dei messaggi inviati. In genere non è necessario, ma puoi limitare la quantità di eventi di log registrati nel database.',
    'Enable Logging'                      => 'Abilita la registrazione',
    'When disabled, Notifier will not write anything to the notification log.' => 'Quando disabilitato, Notifier non scrive nulla nel registro delle notifiche.',
    'Number of days to retain log events' => 'Numero di giorni di conservazione degli eventi di log',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Conserva gli eventi di log al massimo per questo numero di giorni. Lascia vuoto per nessun limite.',
    'Number of log events to retain'      => 'Numero di eventi di log da conservare',
    'At most, keep this many log events. Leave blank for no limit.' => 'Conserva al massimo questo numero di eventi di log. Lascia vuoto per nessun limite.',

    // Settings: Twilio
    'Twilio API Credentials'                       => 'Credenziali API Twilio',
    'If using the Twilio API to send SMS messages, the following credentials are required.' => "Se utilizzi l'API Twilio per inviare SMS, sono richieste le seguenti credenziali.",
    'Twilio Account SID'                           => 'Twilio Account SID',
    'Twilio Auth Token'                            => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)' => 'Numero di telefono Twilio (invia ogni SMS)',
    'SMS Testing'                                  => 'Test SMS',
    'Optional. When set, every SMS dispatched will be sent to this number instead of the resolved recipient.' => 'Opzionale. Se impostato, ogni SMS inviato sarà recapitato a questo numero invece che al destinatario risolto.',
    'Test phone number'                            => 'Numero di telefono di prova',

    // Settings: Pushover
    "[Pushover](https://pushover.net) sends push notifications to a registered user's devices. Each Craft user needs a custom field on their profile storing their Pushover user key; you select which field on each Notification's Message tab. For full setup instructions, see the [Pushover getting-started docs](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover)." => '[Pushover](https://pushover.net) invia notifiche push ai dispositivi di un utente registrato. Ogni utente Craft ha bisogno di un campo personalizzato sul proprio profilo che memorizza la chiave Pushover; selezioni quale campo nella scheda Messaggio di ogni notifica. Per le istruzioni complete consulta la [documentazione introduttiva di Pushover](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover).',
    'Application API Token'                                      => "Token API dell'applicazione",
    'The 30-character app token from your Pushover application.' => 'Il token applicativo di 30 caratteri della tua applicazione Pushover.',

    // Settings: ntfy
    'ntfy.sh is a free HTTP-based push notification service. Subscribers receive messages on the ntfy app, web, or any compatible client by joining a topic.' => "ntfy.sh è un servizio gratuito di notifiche push basato su HTTP. Gli iscritti ricevono i messaggi nell'app ntfy, sul web o tramite qualsiasi client compatibile unendosi a un argomento.",
    'Server URL'   => 'URL del server',
    'Defaults to https://ntfy.sh. Point at a self-hosted ntfy instance if applicable.' => "Predefinito https://ntfy.sh. Punta a un'istanza ntfy self-hosted se necessario.",
    'Access token' => 'Token di accesso',
    'Optional. Required for protected topics or self-hosted instances with auth.' => 'Opzionale. Richiesto per argomenti protetti o istanze self-hosted con autenticazione.',
    'ntfy Topics'  => 'Argomenti ntfy',
    'Named list of ntfy topics. Each topic becomes selectable on the notification edit screen.' => 'Elenco di argomenti ntfy con nome. Ogni argomento diventa selezionabile nella schermata di modifica della notifica.',
    'Topics'       => 'Argomenti',
    'Add one row per topic name. Use the **Test** button to send a quick test message to the topic.' => "Aggiungi una riga per nome di argomento. Usa il pulsante **Test** per inviare un rapido messaggio di prova all'argomento.",
    'Topic'        => 'Argomento',
    'Add a topic'  => 'Aggiungi un argomento',
    'Save first to persist a row, then click its **Test** button to fire a sanity check against ntfy.' => 'Salva prima per mantenere una riga, quindi fai clic sul suo pulsante **Test** per eseguire un controllo rapido contro ntfy.',

    // Settings: Slack
    'Slack Channels' => 'Canali Slack',
    'Channels'       => 'Canali',
    'Each Slack channel needs its own Incoming Webhook URL. Use the **Test** button to fire a quick sanity check after saving.' => 'Ogni canale Slack ha bisogno del proprio URL Incoming Webhook. Usa il pulsante **Test** per un controllo rapido dopo il salvataggio.',
    'Webhook URL'    => 'URL del webhook',
    'Add a channel'  => 'Aggiungi un canale',
    'Save first to persist a row, then click its **Test** button to fire a sanity check against Slack.' => 'Salva prima per mantenere una riga, quindi fai clic sul suo pulsante **Test** per eseguire un controllo rapido contro Slack.',

    // Settings: Bluesky
    "[Bluesky](https://bsky.app) posts publish to the configured account's feed via the ATProto API. App passwords are generated at [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). An app password is a secret, so store it in a `.env` variable and reference that variable (e.g. `\$BLUESKY_APP_PASSWORD`) rather than pasting the password directly." => "I post [Bluesky](https://bsky.app) vengono pubblicati nel feed dell'account configurato tramite l'API ATProto. Le password applicative si generano su [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). Una password applicativa è un segreto, quindi memorizzala in una variabile `.env` e fai riferimento a quella variabile (ad es. `\$BLUESKY_APP_PASSWORD`) anziché incollare la password direttamente.",
    'PDS URL'          => 'URL del PDS',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'Predefinito https://bsky.social. Punta a un PDS personalizzato se la tua installazione si federa.',
    'Bluesky Accounts' => 'Account Bluesky',
    'Named list of Bluesky accounts. Each account becomes selectable on the notification edit screen.' => 'Elenco di account Bluesky con nome. Ogni account diventa selezionabile nella schermata di modifica della notifica.',
    'Accounts'         => 'Account',
    'Add one row per Bluesky account. Use **Test** to verify the credentials authenticate.' => 'Aggiungi una riga per account Bluesky. Usa **Test** per verificare che le credenziali si autentichino.',
    'Label'            => 'Etichetta',
    'Handle'           => 'Handle',
    'App password'     => 'Password applicativa',
    'Add an account'   => 'Aggiungi un account',
    'Save first to persist a row, then click its **Test** button to verify the credentials authenticate.' => 'Salva prima per mantenere una riga, quindi fai clic sul suo pulsante **Test** per verificare che le credenziali si autentichino.',

    // Test notification (UI)
    'Send a test message'           => 'Invia un messaggio di prova',
    'Are you certain you want to send a test notification?\\n\\nThe configured message will be sent to the configured recipient(s).' => 'Sei sicuro di voler inviare una notifica di prova?\\n\\nIl messaggio configurato verrà inviato ai destinatari configurati.',
    'Test'                          => 'Prova',
    'Test notification dispatched.' => 'Notifica di prova inviata.',
    'No messages were dispatched. Check the recipient configuration.' => 'Nessun messaggio è stato inviato. Controlla la configurazione dei destinatari.',

    // Settings: save / test action responses
    "Couldn't save settings."                 => 'Impossibile salvare le impostazioni.',
    'Settings saved.'                         => 'Impostazioni salvate.',
    'Topic is empty.'                         => "L'argomento è vuoto.",
    'Server URL is not configured.'           => "L'URL del server non è configurato.",
    'Test message from Notifier.'             => 'Messaggio di prova da Notifier.',
    'HTTP {status}'                           => 'HTTP {status}',
    'Test message sent successfully.'         => 'Messaggio di prova inviato con successo.',
    'HTTP {status}: {body}'                   => 'HTTP {status}: {body}',
    'Handle and app password are required.'   => 'Handle e password applicativa sono obbligatori.',
    'Authentication failed.'                  => 'Autenticazione non riuscita.',
    'Successfully authenticated. No messages were posted.' => 'Autenticazione riuscita. Nessun messaggio è stato pubblicato.',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.'          => 'Invio di {messageType} a {recipient}.',
    'Adding message to queue.'                       => 'Aggiunta del messaggio alla coda.',
    'Sending message immediately (bypassing queue).' => 'Invio immediato del messaggio (bypass della coda).',
    'Log events deleted.'                            => 'Eventi di log eliminati.',
    'notification'                                   => 'notifica',

    // Outbound: Email log messages
    'Unable to send email, no recipient specified.'     => "Impossibile inviare l'email: nessun destinatario specificato.",
    'Unable to send email, the message body was empty.' => "Impossibile inviare l'email: il corpo del messaggio era vuoto.",
    "Unable to send the email using Craft's native email handling." => "Impossibile inviare l'email utilizzando la gestione email nativa di Craft.",
    'Check your general email settings within Craft.'   => 'Controlla le impostazioni email generali in Craft.',
    'Successfully sent email message!'                  => 'Email inviata con successo!',

    // Outbound: SMS log messages
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[Credenziali Twilio non valide.]({url}) Manca {missing}.',
    'Unable to send SMS, no Twilio phone number exists.'      => 'Impossibile inviare SMS, nessun numero di telefono Twilio.',
    'Unable to send SMS, no recipient phone number exists.'   => 'Impossibile inviare SMS, nessun numero di telefono del destinatario.',
    'Unable to send SMS, recipient phone number is invalid.'  => 'Impossibile inviare SMS, il numero del destinatario non è valido.',
    'Successfully sent SMS message!'                          => 'SMS inviato con successo!',

    // Outbound: Announcement log messages
    'Unable to post announcement, no recipient userId specified.' => "Impossibile pubblicare l'annuncio: nessun userId del destinatario specificato.",
    'Successfully posted announcement!' => 'Annuncio pubblicato con successo!',

    // Outbound: Flash log messages
    'Unable to send the flash message, invalid flash type.' => 'Impossibile inviare il messaggio flash: tipo flash non valido.',
    'Successfully sent flash message!'                      => 'Messaggio flash inviato con successo!',

    // Outbound: Pushover log messages
    '[Invalid Pushover credentials.]({url}) Missing app token.'  => '[Credenziali Pushover non valide.]({url}) Manca il token applicativo.',
    'Unable to send Pushover message, no user key on recipient.' => 'Impossibile inviare il messaggio Pushover: nessuna chiave utente sul destinatario.',
    'Pushover POST failed: {reason}'                             => 'POST Pushover non riuscito: {reason}',
    'Successfully sent Pushover message!'                        => 'Messaggio Pushover inviato con successo!',

    // Outbound: ntfy log messages
    'Unable to send ntfy message, no server URL configured.' => 'Impossibile inviare il messaggio ntfy: nessun URL del server configurato.',
    'Unable to send ntfy message, no topic specified.'       => 'Impossibile inviare il messaggio ntfy: nessun argomento specificato.',
    'ntfy POST failed with HTTP {status}: {reason}'          => 'POST ntfy non riuscito con HTTP {status}: {reason}',
    'ntfy POST failed: {reason}'                             => 'POST ntfy non riuscito: {reason}',
    'Successfully sent ntfy message to topic "{topic}".'     => "Messaggio ntfy inviato con successo all'argomento \"{topic}\".",

    // Outbound: Slack log messages
    'Unable to send Slack message, no webhook URL.' => 'Impossibile inviare il messaggio Slack: nessun URL del webhook.',
    'Unable to send Slack message, webhook URL is not valid.' => "Impossibile inviare il messaggio Slack: l'URL del webhook non è valido.",
    'Unable to send Slack message, body is empty.'  => 'Impossibile inviare il messaggio Slack: il corpo è vuoto.',
    'Slack POST failed (HTTP {status}): {reason}'   => 'POST Slack non riuscito (HTTP {status}): {reason}',
    'Slack POST failed: {reason}'                   => 'POST Slack non riuscito: {reason}',
    'Successfully sent Slack message to "{label}".' => 'Messaggio Slack inviato con successo a "{label}".',

    // Outbound: Bluesky log messages
    'Unable to send Bluesky post, recipient is missing credentials.' => 'Impossibile inviare il post Bluesky: al destinatario mancano le credenziali.',
    'Body exceeded {max} characters, truncated.'          => 'Il corpo ha superato {max} caratteri ed è stato troncato.',
    'Successfully posted to Bluesky as "{label}".'        => 'Pubblicato con successo su Bluesky come "{label}".',
    'Bluesky auth failed for {handle}: {reason}'          => 'Autenticazione Bluesky non riuscita per {handle}: {reason}',
    'Bluesky auth failed: {reason}'                       => 'Autenticazione Bluesky non riuscita: {reason}',
    'Bluesky post failed: {reason}'                       => 'Post Bluesky non riuscito: {reason}',
    'Bluesky link preview skipped: {reason}'              => 'Anteprima del link Bluesky saltata: {reason}',

    // Recipient-strategy warnings
    'Recipient "{name}" has no email address.'       => 'Il destinatario "{name}" non ha un indirizzo email.',
    'Recipient "{name}" has no phone number.'        => 'Il destinatario "{name}" non ha un numero di telefono.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => "Il destinatario \"{name}\" non ha un utente associato; impossibile inviare l'annuncio.",
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => "Il destinatario \"{name}\" non può accedere al pannello di controllo; impossibile inviare l'annuncio.",
    'Pushover user-key field is not configured on this notification.' => 'Il campo della chiave utente Pushover non è configurato per questa notifica.',
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => 'Il destinatario "{name}" non ha un utente associato; impossibile inviare il messaggio Pushover.',
    '[SKIPPED] User "{name}" has no Pushover key.'   => "[IGNORATO] L'utente \"{name}\" non ha una chiave Pushover.",
    'Recipient "{name}" has no ntfy topic.'          => 'Il destinatario "{name}" non ha un argomento ntfy.',
    'Recipient "{name}" has no Slack webhook URL.'   => 'Il destinatario "{name}" non ha un URL del webhook Slack.',
    'Recipient "{name}" has no Bluesky credentials.' => 'Il destinatario "{name}" non ha credenziali Bluesky.',

    // Errors / exceptions
    'Invalid element event: {class}'                         => 'Evento elemento non valido: {class}',
    'Invalid notification ID: {id}'                          => 'ID notifica non valido: {id}',
    'Invalid email message mode.'                            => 'Modalità messaggio email non valida.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Non hai i permessi per usare il tipo Destinatari dinamici.',
    'Dynamic recipients snippet did not call setRecipients.' => 'Lo snippet dei destinatari dinamici non ha chiamato setRecipients.',
    'setRecipients was called with an empty value.'          => 'setRecipients è stato chiamato con un valore vuoto.',
    'Unrecognized recipient of type "{type}".'               => 'Destinatario di tipo "{type}" non riconosciuto.',
    'Unrecognized recipient "{value}".'                      => 'Destinatario "{value}" non riconosciuto.',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => 'Il {kind} configurato non esiste più nelle impostazioni del plugin (uid: {uid}).',
    'Invalid settings section: {section}'                    => 'Sezione di impostazioni non valida: {section}',
    'User not authorized to save this notification.'         => "L'utente non è autorizzato a salvare questa notifica.",
    'User not authorized to view this notification.'         => "L'utente non è autorizzato a visualizzare questa notifica.",
    'User not authorized to delete this notification.'       => "L'utente non è autorizzato a eliminare questa notifica.",
    'Notification not found'                                 => 'Notifica non trovata',

    // Misc config-file note
    'This is being set in the config file. [{file}]' => 'Questo viene impostato nel file di configurazione. [{file}]',

    // Slack, ntfy, and Bluesky message types
    "Add the Bluesky accounts you'd like to post from. Each account becomes available as a recipient on the **Recipients** tab when configuring a notification." => "Aggiungi gli account Bluesky da cui vuoi pubblicare. Ogni account diventa disponibile come destinatario nella scheda **Destinatari** durante la configurazione di una notifica.",
    "Click any row's **Test** button to confirm the account authenticates." => "Fai clic sul pulsante **Test** di una qualsiasi riga per confermare che l'account si autentichi.",
    'Add an [Incoming Webhook](https://api.slack.com/messaging/webhooks) for each Slack channel you\'d like to post into. Each webhook becomes available as a recipient on the **Recipients** tab when configuring a notification. A webhook URL is a secret, so store it in a `.env` variable and reference that variable (e.g. `$SLACK_WEBHOOK_URL`) rather than pasting the URL directly.' => 'Aggiungi un [Incoming Webhook](https://api.slack.com/messaging/webhooks) per ogni canale Slack su cui vuoi pubblicare. Ogni webhook diventa disponibile come destinatario nella scheda **Recipients** durante la configurazione di una notifica. L\'URL di un webhook è un segreto, quindi salvalo in una variabile `.env` e fai riferimento a quella variabile (ad es. `$SLACK_WEBHOOK_URL`) invece di incollare l\'URL direttamente.',
    "Click any row's **Test** button to send a quick test message to that channel." => 'Fai clic sul pulsante **Test** di una qualsiasi riga per inviare un rapido messaggio di prova a quel canale.',
    "Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`." => "Opzionale, punta a un'istanza ntfy self-hosted (se necessario). Predefinito `https://ntfy.sh`.",
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Opzionale, richiesto per argomenti protetti o istanze self-hosted con autenticazione.',
    "Add the ntfy topics you'd like to send messages to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification." => "Aggiungi gli argomenti ntfy a cui vuoi inviare messaggi. Ogni argomento diventa disponibile come destinatario nella scheda **Destinatari** durante la configurazione di una notifica.",
    "Click any row's **Test** button to send a quick test message to that topic." => "Fai clic sul pulsante **Test** di una qualsiasi riga per inviare un rapido messaggio di prova a quell'argomento.",
    'Enable Markdown' => 'Abilita Markdown',
    'Link URL' => 'URL del link',
    'Not a valid Webhook URL. Must start with https://hooks.slack.com/services/' => 'URL del webhook non valido. Deve iniziare con https://hooks.slack.com/services/',

    // Manual triggers
    'Send Notification'                                            => 'Invia notifica',
    'Send manual notifications'                                    => 'Invia notifiche manuali',
    'Are you sure you want to send this notification?'             => 'Sei sicuro di voler inviare questa notifica?',
    'This notification cannot be triggered manually.'              => 'Questa notifica non può essere attivata manualmente.',
    'This notification no longer applies to the selected element.' => "Questa notifica non si applica più all'elemento selezionato.",
    'Notification sent.'                                           => 'Notifica inviata.',
    'Element not found'                                            => 'Elemento non trovato',
    'Manual Trigger Label'                                         => 'Etichetta del trigger manuale',
    'An element action label (helps to differentiate multiple manual triggers).' => "Un'etichetta per l'azione dell'elemento (aiuta a distinguere più trigger manuali).",
];
