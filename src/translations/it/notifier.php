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

    // ============================================================
    // PLUGIN & PERMISSIONS
    // ============================================================

    // Plugin & navigation
    'Notifier' => 'Notifier',
    'Notifications' => 'Notifiche',
    'Notification' => 'Notifica',
    'All notifications' => 'Tutte le notifiche',
    'Notification Log' => 'Registro notifiche',
    'Logs' => 'Registri',
    'View Notifications' => 'Vedi notifiche',
    'Add a New Notification' => 'Aggiungi una nuova notifica',
    'notification' => 'notifica',

    // Permissions
    'View notifications' => 'Vedi le notifiche',
    'Save notifications' => 'Salva le notifiche',
    'Use the Dynamic Recipients type' => 'Usa il tipo Destinatari dinamici',
    'Use the Dynamic Data type' => 'Usa il tipo Dati dinamici',
    'Test notifications' => 'Prova le notifiche',
    'Send manual notifications' => 'Invia notifiche manuali',
    'Delete notifications' => 'Elimina le notifiche',
    'View notification log' => 'Vedi il registro notifiche',
    'Delete notification log' => 'Elimina il registro notifiche',

    // ============================================================
    // NOTIFICATION EDITOR
    // ============================================================

    // Editor: tabs
    'Meta' => 'Meta',
    'Event' => 'Evento',
    'Message' => 'Messaggio',
    'Recipients' => 'Destinatari',

    // Event tab: type selector
    'Event Type' => 'Tipo di evento',
    'What type of event will activate the notification?' => 'Quale tipo di evento attiverà la notifica?',
    'Which specific event will activate the notification?' => 'Quale evento specifico attiverà la notifica?',

    // Event tab: event types
    'Assets Event' => 'Evento Asset',
    'Commerce Orders Event' => 'Evento ordini Commerce',
    'Commerce Products Event' => 'Evento prodotti Commerce',
    'Digital Products Event' => 'Evento Digital Products',
    'Digital Product Licenses Event' => 'Evento licenze Digital Products',
    'Solspace Calendar Event' => 'Evento Solspace Calendar',
    'Entries Event' => 'Evento voci',
    'Users Event' => 'Evento utenti',
    'Ungrouped Users' => 'Utenti senza gruppo',

    // Event tab: Feed
    'Feed URL' => 'URL del feed',
    'The URL of the RSS, Atom, or JSON feed to watch.' => "L'URL del feed RSS, Atom o JSON da monitorare.",

    // Event tab: field conditions
    'Field Conditions' => 'Condizioni del campo',
    'Send the message only when the saved element matches the following conditions.' => "Invia il messaggio solo quando l'elemento salvato soddisfa le seguenti condizioni.",
    'has changed' => 'è cambiato',

    // Event tab: element filters (panel chrome + common output)
    '#{elementType} Event Filters' => 'Filtri eventi per #{elementType}',
    'No filters match this event.' => 'Nessun filtro corrisponde a questo evento.',
    'Determine whether each message should be sent based on specified conditions.' => 'Determina se ogni messaggio debba essere inviato in base alle condizioni specificate.',
    'Unnamed filter' => 'Filtro senza nome',
    'Must be TRUE to send message' => 'Deve essere TRUE per inviare il messaggio',
    'Must be FALSE to send message' => 'Deve essere FALSE per inviare il messaggio',
    'No effect' => 'Nessun effetto',

    // Event tab: element filter rules
    'Element is being saved for the first time' => "L'elemento viene salvato per la prima volta",
    'Must be a new entry' => 'Deve essere una voce nuova',
    'Must be an existing entry' => 'Deve essere una voce esistente',
    'Can be existing or new' => 'Può essere esistente o nuovo',
    'Element is new' => "L'elemento è nuovo",
    'New elements only' => 'Solo elementi nuovi',
    'Existing elements only' => 'Solo elementi esistenti',
    'Element is enabled' => "L'elemento è abilitato",
    'Must be enabled' => 'Deve essere abilitato',
    'Must be disabled' => 'Deve essere disabilitato',
    'Can be enabled or disabled' => 'Può essere abilitato o disabilitato',
    'Element is a draft' => "L'elemento è una bozza",
    'Must be a draft' => 'Deve essere una bozza',
    'Must not be a draft' => 'Non deve essere una bozza',
    'Can be a draft or non-draft' => 'Può essere una bozza o no',
    'Element is a provisional draft' => "L'elemento è una bozza provvisoria",
    'Must be a provisional draft' => 'Deve essere una bozza provvisoria',
    'Must not be a provisional draft' => 'Non deve essere una bozza provvisoria',
    'Can be a provisional draft or non-provisional' => 'Può essere una bozza provvisoria o no',
    'Element is a revision' => "L'elemento è una revisione",
    'Must be a revision' => 'Deve essere una revisione',
    'Must not be a revision' => 'Non deve essere una revisione',
    'Can be a revision or non-revision' => 'Può essere una revisione o no',
    'Element is being duplicated' => "L'elemento è in duplicazione",
    'Must be duplicating the element' => "L'elemento deve essere in duplicazione",
    'Must not be duplicating the element' => "L'elemento non deve essere in duplicazione",
    'Element is being propagated' => "L'elemento è in propagazione",
    'Element must be propagating' => "L'elemento deve essere in propagazione",
    'Element must not be propagating' => "L'elemento non deve essere in propagazione",
    'Element is being bulk-resaved' => "L'elemento è in salvataggio massivo",
    'Must be bulk-resaving the element' => "L'elemento deve essere in salvataggio massivo",
    'Must not be bulk-resaving the element' => "L'elemento non deve essere in salvataggio massivo",

    // Event tab: date trigger
    'On' => 'Il',
    'days before' => 'giorni prima',
    'days after' => 'giorni dopo',
    'Relevant Date' => 'Data rilevante',
    'Send the notification relative to a chosen date.' => 'Invia la notifica in relazione a una data scelta.',

    // Event tab: recurring schedule
    'Every' => 'Ogni',
    'on' => 'di',
    'on day' => 'il giorno',
    'at' => 'alle',
    'Starting on' => 'A partire dal',
    'Day' => 'Giorno',
    'Date' => 'Data',
    'Time' => 'Ora',
    'day(s)' => 'giorno/i',
    'week(s)' => 'settimana/e',
    'month(s)' => 'mese/i',
    'year(s)' => 'anno/i',
    'day' => 'giorno',
    'days' => 'giorni',
    'week' => 'settimana',
    'weeks' => 'settimane',
    'month' => 'mese',
    'months' => 'mesi',
    'year' => 'anno',
    'years' => 'anni',
    'Manual only' => 'Solo manuale',
    'Scheduled sending' => 'Invio programmato',
    'On a recurring schedule' => 'Secondo una pianificazione ricorrente',
    'On demand' => 'Su richiesta',
    'Send on a Recurring Schedule' => 'Invia secondo una pianificazione ricorrente',
    'Configure Recurring Schedule' => 'Configura pianificazione ricorrente',
    'System timezone set to {timezone}' => 'Fuso orario del sistema impostato su {timezone}',
    'Notifications will be sent on the following schedule...' => 'Le notifiche verranno inviate secondo la seguente pianificazione...',
    '... and every {cadence} after that.' => '... e successivamente ogni {cadence}.',
    'On what recurring schedule should the notification be sent?' => 'Con quale pianificazione ricorrente deve essere inviata la notifica?',
    'Whether the message should be sent on a schedule, or only triggered manually.' => 'Se il messaggio deve essere inviato in base a una pianificazione o attivato solo manualmente.',
    'The message can always be sent using the "Send system snapshot" button above.' => 'Il messaggio può sempre essere inviato con il pulsante "Invia istantanea del sistema" sopra.',
    'The message can always be sent using the "Send data report" button above.' => 'Il messaggio può sempre essere inviato con il pulsante "Invia report dei dati" sopra.',

    // Event tab: Dynamic Data snippet field
    'Twig Snippet to Determine Data' => 'Snippet Twig per determinare i dati',
    'Enter a custom Twig snippet to [determine which data will be included]({url}).' => 'Inserisci uno snippet Twig personalizzato per [determinare quali dati verranno inclusi]({url}).',
    'The snippet **must** include a `{% setData %}` tag.' => 'Lo snippet **deve** includere un tag `{% setData %}`.',
    'You do not have permission to edit dynamic data.' => 'Non disponi dell\'autorizzazione per modificare i dati dinamici.',

    // Event tab: manual trigger
    'Trigger Label' => 'Etichetta del trigger',
    'An element action label (helps to differentiate multiple triggers).' => "Un'etichetta per l'azione dell'elemento (aiuta a distinguere più trigger).",
    'Send Notification' => 'Invia notifica',

    // Message tab: type selector & queue
    'Message Type' => 'Tipo di messaggio',
    'What type of message will be sent?' => 'Quale tipo di messaggio verrà inviato?',
    'Send Message via Queue' => 'Invia il messaggio tramite coda',
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are also supported.' => 'Sono supportati anche [templating]({templatingUrl}) e [variabili speciali]({variablesUrl}).',
    'Send immediately' => 'Invia immediatamente',
    'Add to queue' => 'Aggiungi alla coda',
    'Whether the message should be sent via the [jobs queue]({queueUrl}).' => 'Se il messaggio deve essere inviato tramite la [coda dei processi]({queueUrl}).',

    // Message tab: Email
    "User's Email Address Field" => "Campo email dell'utente",
    'Select which User field contains the recipient\'s email address.' => 'Seleziona il campo utente che contiene l\'indirizzo email del destinatario.',
    'Email Subject' => 'Oggetto email',
    'Subject line of the email.' => 'Oggetto dell\'e-mail.',
    'Dynamic Subject Line' => 'Oggetto dinamico',
    'Email Body' => 'Corpo email',
    'Body of the email. Supports HTML.' => 'Corpo dell\'e-mail. Supporta HTML.',

    // Message tab: rich-text (Trix) toolbar
    'Rich Text' => 'Testo formattato',
    'Bold' => 'Grassetto',
    'Italic' => 'Corsivo',
    'Underline' => 'Sottolineato',
    'Strikethrough' => 'Barrato',
    'Bullets' => 'Elenco puntato',
    'Numbers' => 'Elenco numerato',
    'Heading' => 'Intestazione',
    'Code' => 'Codice',
    'Undo' => 'Annulla',
    'Redo' => 'Ripeti',

    // Message tab: SMS
    "User's Phone Number Field" => "Campo telefono dell'utente",
    'Select which User field contains the recipient\'s phone number.' => 'Seleziona il campo utente che contiene il numero di telefono del destinatario.',
    'SMS Message Body' => 'Corpo del messaggio SMS',
    'Body of the SMS (text message). Plain text only.' => 'Corpo dell\'SMS (messaggio di testo). Solo testo normale.',

    // Message tab: Announcement
    'Announcement Title' => "Titolo dell'annuncio",
    'Heading of the announcement.' => 'Intestazione dell\'annuncio.',
    'Dynamic Announcement Title' => 'Titolo dell\'annuncio dinamico',
    'Announcement Message' => "Messaggio dell'annuncio",
    'Body of the announcement. Supports Markdown.' => 'Corpo dell\'annuncio. Supporta Markdown.',

    // Message tab: Flash
    'Flash Message Type' => 'Tipo di messaggio flash',
    'Which type of flash message should appear?' => 'Quale tipo di messaggio flash deve apparire?',
    'Flash Message Title' => 'Titolo del messaggio flash',
    'Heading of the flash message.' => 'Intestazione del messaggio flash.',
    'Dynamic Flash Message Title' => 'Titolo del messaggio Flash dinamico',
    'Flash Message Details' => 'Dettagli del messaggio flash',
    'Optionally include details below the heading. Supports Markdown and HTML.' => 'Includi facoltativamente dettagli sotto l\'intestazione. Supporta Markdown e HTML.',

    // Message tab: Pushover
    "Field containing each user's Pushover key" => "Campo della chiave Pushover dell'utente",
    'Select which User field contains the recipient\'s Pushover user key.' => 'Seleziona il campo utente che contiene la chiave Pushover del destinatario.',
    'Pushover Title' => 'Titolo Pushover',
    'Optionally include a heading above the body.' => 'Includi facoltativamente un\'intestazione sopra il corpo.',
    'Dynamic Pushover Title' => 'Titolo Pushover dinamico',
    'Pushover Body' => 'Corpo Pushover',
    'Body of the Pushover notification. Plain text only.' => 'Corpo della notifica Pushover. Solo testo normale.',

    // Message tab: ntfy
    'Priority' => 'Priorità',
    'Priority level of the ntfy message.' => 'Livello di priorità del messaggio ntfy.',
    'Tags' => 'Tag',
    'Optionally include comma-separated [emoji shortcodes](https://docs.ntfy.sh/emojis/).' => 'Includi facoltativamente [codici emoji](https://docs.ntfy.sh/emojis/) separati da virgole.',
    'ntfy Title' => 'Titolo ntfy',
    'Dynamic ntfy Title' => 'Titolo ntfy dinamico',
    'ntfy Body' => 'Corpo ntfy',
    'Body of the ntfy notification.' => 'Corpo della notifica ntfy.',
    'ntfy Link URL' => 'URL del link ntfy',
    'Optionally open a URL when the notification is clicked.' => 'Apri facoltativamente un URL quando si fa clic sulla notifica.',
    'Enable Markdown' => 'Abilita Markdown',
    'Whether to parse the body as Markdown in supported clients.' => 'Se il corpo debba essere interpretato come Markdown nei client che lo supportano.',
    'Regular text only' => 'Solo testo normale',
    'Markdown enabled' => 'Markdown abilitato',

    // Message tab: Slack
    'Slack Message Body' => 'Corpo del messaggio Slack',
    'Supports standard [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) syntax. Optionally supports HTML _(see below)_.' => 'Supporta la sintassi standard [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting). Supporta opzionalmente HTML _(vedi sotto)_.',
    'Render Message Body as HTML' => 'Renderizza il corpo del messaggio come HTML',
    'Whether to only parse as [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), or additionally parse it as HTML.' => 'Analizzare solo come [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), o anche come HTML.',
    'mrkdwn only' => 'solo mrkdwn',
    'mrkdwn + HTML' => 'mrkdwn + HTML',
    'Render Link Previews' => 'Mostra anteprime dei link',
    'Whether Slack should unfurl link previews for URLs in the message body.' => 'Se Slack deve mostrare le anteprime dei link per gli URL nel corpo del messaggio.',
    'Don\'t unfurl' => 'Non espandere',
    'Expand link previews' => 'Espandi anteprime dei link',
    'Bot Name' => 'Nome utente',
    'Optionally override the app\'s display name.' => 'Sostituisci facoltativamente il nome visualizzato dell\'app.',
    'Dynamic Bot Name' => 'Nome bot dinamico',
    'Bot Icon URL' => "URL dell'icona",
    'Optionally override the app\'s icon with a URL.' => 'Sostituisci facoltativamente l\'icona dell\'app con un URL.',
    'Bot Emoji' => "Emoji dell'icona",
    'Optionally override the app\'s icon with an emoji. Used only when Bot Icon URL is empty.' => 'Sostituisci facoltativamente l\'icona dell\'app con un\'emoji. Usato solo quando Bot Icon URL è vuoto.',

    // Message tab: Bluesky
    'Post Body' => 'Corpo del post',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => 'Testo normale, massimo 300 caratteri. Gli URL e le menzioni `@handle.tld` diventano automaticamente link.',
    'Generate Link Preview' => 'Genera anteprima del link',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => 'Genera automaticamente una scheda di anteprima quando il corpo del post contiene un URL.',
    'No card' => 'Nessuna scheda',
    'Generate preview card' => 'Genera scheda di anteprima',

    // Recipients tab: type selector & user/group pickers
    'Recipients Type' => 'Tipo di destinatari',
    'Who will receive this message?' => 'Chi riceverà questo messaggio?',
    'Add a message recipient' => 'Aggiungi un destinatario',
    'Select User(s)' => 'Seleziona utente/i',
    'Which users will receive the message?' => 'Quali utenti riceveranno il messaggio?',
    'Which user groups will receive the message?' => 'Quali gruppi di utenti riceveranno il messaggio?',

    // Recipients tab: channel pickers (Slack / ntfy / Bluesky)
    'Select Slack channel(s)' => 'Seleziona canale/i Slack',
    'Which Slack channels should receive this message?' => 'Quali canali Slack devono ricevere questo messaggio?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Nessun canale Slack configurato. Aggiungine uno in [Impostazioni → Slack]({url}).',
    'Select ntfy topic(s)' => 'Seleziona argomento/i ntfy',
    'Which ntfy topics should receive this message?' => 'Quali argomenti ntfy devono ricevere questo messaggio?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'Nessun argomento ntfy configurato. Aggiungine uno in [Impostazioni → ntfy]({url}).',
    'Select Bluesky account(s)' => 'Seleziona account Bluesky',
    'Which Bluesky accounts should post this message?' => 'Quali account Bluesky devono pubblicare questo messaggio?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Nessun account Bluesky configurato. Aggiungine uno in [Impostazioni → Bluesky]({url}).',

    // Recipients tab: dynamic recipients snippet
    'Twig Snippet to Determine Recipients' => 'Snippet Twig per determinare i destinatari',
    'Enter a custom Twig snippet to [determine who will receive the message]({url}).' => 'Inserisci uno snippet Twig personalizzato per [determinare chi riceverà il messaggio]({url}).',
    'The snippet **must** include a `{% setRecipients %}` tag.' => 'Lo snippet **deve** includere un tag `{% setRecipients %}`.',

    // ============================================================
    // SETTINGS
    // ============================================================

    // Settings: nav & page chrome
    'Notifier Settings' => 'Impostazioni Notifier',
    'General' => 'Generale',
    'Twilio' => 'Twilio',
    'Pushover' => 'Pushover',
    'Slack' => 'Slack',
    'Bluesky' => 'Bluesky',
    'ntfy' => 'ntfy',

    // Settings: Logging
    'Logging' => 'Registrazione',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier mantiene un registro continuo dei messaggi inviati. In genere non è necessario, ma puoi limitare la quantità di eventi di log registrati nel database.',
    'Enable Logging' => 'Abilita la registrazione',
    'When disabled, Notifier will not write anything to the notification log.' => 'Quando disabilitato, Notifier non scrive nulla nel registro delle notifiche.',
    'Number of days to retain log events' => 'Numero di giorni di conservazione degli eventi di log',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Conserva gli eventi di log al massimo per questo numero di giorni. Lascia vuoto per nessun limite.',
    'Number of log events to retain' => 'Numero di eventi di log da conservare',
    'At most, keep this many log events. Leave blank for no limit.' => 'Conserva al massimo questo numero di eventi di log. Lascia vuoto per nessun limite.',

    // Settings: Scheduled sending
    'Scheduled Sending' => 'Invio programmato',
    'Shared secret for authenticating scheduled-run web requests. Required only when the schedule is triggered via the web endpoint.' => "Segreto condiviso per autenticare le richieste web dell'esecuzione programmata. Richiesto solo quando la pianificazione viene attivata tramite l'endpoint web.",
    'Scheduled-Run Token' => 'Token di esecuzione programmata',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => 'Inviato con ogni richiesta come header X-Notifier-Token o come parametro token nel corpo.',

    // Settings: Twilio
    'Twilio API Credentials' => 'Credenziali API Twilio',
    'If using the Twilio API to send SMS messages, the following credentials are required.' => "Se utilizzi l'API Twilio per inviare SMS, sono richieste le seguenti credenziali.",
    'Twilio Account SID' => 'Twilio Account SID',
    'Twilio Auth Token' => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)' => 'Numero di telefono Twilio (invia ogni SMS)',
    'SMS Testing' => 'Test SMS',
    'Optional. When set, every SMS dispatched will be sent to this number instead of the resolved recipient.' => 'Opzionale. Se impostato, ogni SMS inviato sarà recapitato a questo numero invece che al destinatario risolto.',
    'Test phone number' => 'Numero di telefono di prova',

    // Settings: Pushover
    "[Pushover](https://pushover.net) sends push notifications to a registered user's devices. Each Craft user needs a custom field on their profile storing their Pushover user key; you select which field on each Notification's Message tab. For full setup instructions, see the [Pushover getting-started docs](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover)." => '[Pushover](https://pushover.net) invia notifiche push ai dispositivi di un utente registrato. Ogni utente Craft ha bisogno di un campo personalizzato sul proprio profilo che memorizza la chiave Pushover; selezioni quale campo nella scheda Messaggio di ogni notifica. Per le istruzioni complete consulta la [documentazione introduttiva di Pushover](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover).',
    'Application API Token' => "Token API dell'applicazione",
    'The 30-character app token from your Pushover application.' => 'Il token applicativo di 30 caratteri della tua applicazione Pushover.',

    // Settings: ntfy
    'ntfy.sh is a free HTTP-based push notification service. Subscribers receive messages on the ntfy app, web, or any compatible client by joining a topic.' => "ntfy.sh è un servizio gratuito di notifiche push basato su HTTP. Gli iscritti ricevono i messaggi nell'app ntfy, sul web o tramite qualsiasi client compatibile unendosi a un argomento.",
    'Server URL' => 'URL del server',
    "Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`." => "Opzionale, punta a un'istanza ntfy self-hosted (se necessario). Predefinito `https://ntfy.sh`.",
    'Access token' => 'Token di accesso',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Opzionale, richiesto per argomenti protetti o istanze self-hosted con autenticazione.',
    'ntfy Topics' => 'Argomenti ntfy',
    "Add the ntfy topics you'd like to send messages to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification." => "Aggiungi gli argomenti ntfy a cui vuoi inviare messaggi. Ogni argomento diventa disponibile come destinatario nella scheda **Destinatari** durante la configurazione di una notifica.",
    'Topics' => 'Argomenti',
    "Click any row's **Test** button to send a quick test message to that topic." => "Fai clic sul pulsante **Prova** di una qualsiasi riga per inviare un rapido messaggio di prova a quell'argomento.",
    'Label' => 'Etichetta',
    'Topic' => 'Argomento',
    'Add a topic' => 'Aggiungi un argomento',

    // Settings: Slack
    'Slack Channels' => 'Canali Slack',
    'Create a [Slack app](https://api.slack.com/apps) with the `chat:write`, `chat:write.customize`, and `chat:write.public` scopes, then add a row for each channel you\'d like to post into. Each channel becomes available as a recipient on the **Recipients** tab when configuring a notification. A bot token is a secret, so store it in a `.env` variable and reference that variable (e.g. `$SLACK_BOT_TOKEN`) rather than pasting the token directly.' => 'Crei un\'[app Slack](https://api.slack.com/apps) con gli scope `chat:write`, `chat:write.customize` e `chat:write.public`, poi aggiunga una riga per ogni canale in cui desidera pubblicare. Ogni canale diventa disponibile come destinatario nella scheda **Destinatari** durante la configurazione di una notifica. Un token del bot è un segreto, quindi lo memorizzi in una variabile `.env` e faccia riferimento a quella variabile (es. `$SLACK_BOT_TOKEN`) invece di incollare il token direttamente.',
    'Channels' => 'Canali',
    "Click any row's **Test** button to send a quick test message to that channel." => 'Fai clic sul pulsante **Prova** di una qualsiasi riga per inviare un rapido messaggio di prova a quel canale.',
    'Bot Token' => 'Token del bot',
    'Channel ID' => 'ID del canale',
    'Add a channel' => 'Aggiungi un canale',
    'Not a valid Bot Token. Must start with `xoxb-`.' => 'Token del bot non valido. Deve iniziare con `xoxb-`.',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => 'ID del canale non valido. Deve apparire come `C01234ABCD`.',

    // Settings: Bluesky
    "[Bluesky](https://bsky.app) posts publish to the configured account's feed via the ATProto API. App passwords are generated at [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). An app password is a secret, so store it in a `.env` variable and reference that variable (e.g. `\$BLUESKY_APP_PASSWORD`) rather than pasting the password directly." => "I post [Bluesky](https://bsky.app) vengono pubblicati nel feed dell'account configurato tramite l'API ATProto. Le password applicative si generano su [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). Una password applicativa è un segreto, quindi la memorizzi in una variabile `.env` e faccia riferimento a quella variabile (ad es. `\$BLUESKY_APP_PASSWORD`) anziché incollare la password direttamente.",
    'PDS URL' => 'URL del PDS',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'Predefinito https://bsky.social. Punta a un PDS personalizzato se la tua installazione si federa.',
    'Bluesky Accounts' => 'Account Bluesky',
    "Add the Bluesky accounts you'd like to post from. Each account becomes available as a recipient on the **Recipients** tab when configuring a notification." => "Aggiungi gli account Bluesky da cui vuoi pubblicare. Ogni account diventa disponibile come destinatario nella scheda **Destinatari** durante la configurazione di una notifica.",
    'Accounts' => 'Account',
    "Click any row's **Test** button to confirm the account authenticates." => "Fai clic sul pulsante **Prova** di una qualsiasi riga per confermare che l'account si autentichi.",
    'Handle' => 'Handle',
    'App password' => 'Password applicativa',
    'Add an account' => 'Aggiungi un account',

    // ============================================================
    // MANUAL SEND & TEST
    // ============================================================

    // Manual send & test
    'Send a test message' => 'Invia un messaggio di prova',
    'Send a REAL test notification?\\n\\n⚠️ Uses a random sample of real data.\\n⚠️ Sends a real message via the configured channel.\\n⚠️ Delivers to the real configured recipient(s).' => 'Inviare una notifica di prova REALE?\\n\\n⚠️ Usa un campione casuale di dati reali.\\n⚠️ Invia un messaggio reale tramite il canale configurato.\\n⚠️ Viene consegnato ai destinatari reali configurati.',
    'Test' => 'Prova',
    'Send system snapshot' => 'Invia istantanea del sistema',
    'Send data report' => 'Invia report dei dati',
    'Are you sure you want to send this notification?' => 'Sei sicuro di voler inviare questa notifica?',
    'This notification cannot be triggered manually.' => 'Questa notifica non può essere attivata manualmente.',
    'This notification no longer applies to the selected element.' => "Questa notifica non si applica più all'elemento selezionato.",

    // ============================================================
    // RUNTIME OUTPUT
    // ============================================================

    // Runtime: dispatch log feedback
    'Sending {messageType} to {recipient}.' => 'Invio di {messageType} a {recipient}.',
    'Adding message to queue.' => 'Aggiunta del messaggio alla coda.',
    'Sending message immediately (bypassing queue).' => 'Invio immediato del messaggio (bypass della coda).',
    'Unable to parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => 'Impossibile analizzare il feed. Le estensioni PHP `simplexml` e `libxml` sono richieste.',
    'Unable to parse the feed.' => 'Impossibile analizzare il feed.',
    'Unable to fetch the feed: {message}' => 'Impossibile recuperare il feed: {message}',
    'Initial feed scan failed: {message}' => 'Scansione iniziale del feed non riuscita: {message}',

    // Runtime: controller responses
    'Test notification dispatched.' => 'Notifica di prova inviata.',
    'No messages were dispatched. Check the recipient configuration.' => 'Nessun messaggio è stato inviato. Controlla la configurazione dei destinatari.',
    'Unable to send test: the feed could not be read or has no items.' => 'Impossibile inviare il test: il feed non può essere letto o non contiene elementi.',
    'Unable to send test: no element matches the configured filters.' => 'Impossibile inviare il test: nessun elemento corrisponde ai filtri configurati.',
    "Couldn't save settings." => 'Impossibile salvare le impostazioni.',
    'Settings saved.' => 'Impostazioni salvate.',
    'Topic is empty.' => "L'argomento è vuoto.",
    'Server URL is not configured.' => "L'URL del server non è configurato.",
    'Test message from Notifier.' => 'Messaggio di prova da Notifier.',
    'HTTP {status}' => 'HTTP {status}',
    'Test message sent successfully.' => 'Messaggio di prova inviato con successo.',
    'Handle and app password are required.' => 'Handle e password applicativa sono obbligatori.',
    'Authentication failed.' => 'Autenticazione non riuscita.',
    'Successfully authenticated. No messages were posted.' => 'Autenticazione riuscita. Nessun messaggio è stato pubblicato.',
    'Log events deleted.' => 'Eventi di log eliminati.',
    'Notification sent.' => 'Notifica inviata.',
    'Notification was not sent. Check the Notification Log for details.' => 'La notifica non è stata inviata. Consulta il Registro notifiche per i dettagli.',

    // Outbound: per-channel send results
    'Unable to send email, no recipient specified.' => "Impossibile inviare l'email: nessun destinatario specificato.",
    'Unable to send email, the message body was empty.' => "Impossibile inviare l'email: il corpo del messaggio era vuoto.",
    "Unable to send the email using Craft's native email handling." => "Impossibile inviare l'email utilizzando la gestione email nativa di Craft.",
    'Check your general email settings within Craft.' => 'Controlla le impostazioni email generali in Craft.',
    'Successfully sent email message!' => 'Email inviata con successo!',
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[Credenziali Twilio non valide.]({url}) Manca {missing}.',
    'Unable to send SMS, no Twilio phone number exists.' => 'Impossibile inviare SMS, nessun numero di telefono Twilio.',
    'Unable to send SMS, no recipient phone number exists.' => 'Impossibile inviare SMS, nessun numero di telefono del destinatario.',
    'Unable to send SMS, recipient phone number is invalid.' => 'Impossibile inviare SMS, il numero del destinatario non è valido.',
    'Successfully sent SMS message!' => 'SMS inviato con successo!',
    'Unable to post announcement, no recipient userId specified.' => "Impossibile pubblicare l'annuncio: nessun userId del destinatario specificato.",
    'Successfully posted announcement!' => 'Annuncio pubblicato con successo!',
    'Unable to send the flash message, invalid flash type.' => 'Impossibile inviare il messaggio flash: tipo flash non valido.',
    'Successfully sent flash message!' => 'Messaggio flash inviato con successo!',
    '[Invalid Pushover credentials.]({url}) Missing app token.' => '[Credenziali Pushover non valide.]({url}) Manca il token applicativo.',
    'Unable to send Pushover message, no user key on recipient.' => 'Impossibile inviare il messaggio Pushover: nessuna chiave utente sul destinatario.',
    'Pushover POST failed: {reason}' => 'POST Pushover non riuscito: {reason}',
    'Successfully sent Pushover message!' => 'Messaggio Pushover inviato con successo!',
    'Unable to send ntfy message, no topic specified.' => 'Impossibile inviare il messaggio ntfy: nessun argomento specificato.',
    'ntfy POST failed with HTTP {status}: {reason}' => 'POST ntfy non riuscito con HTTP {status}: {reason}',
    'ntfy POST failed: {reason}' => 'POST ntfy non riuscito: {reason}',
    'Successfully sent ntfy message to topic "{topic}".' => "Messaggio ntfy inviato con successo all'argomento \"{topic}\".",
    'Unable to send Slack message, no bot token.' => 'Impossibile inviare il messaggio Slack: nessun token del bot.',
    'Unable to send Slack message, no channel ID.' => 'Impossibile inviare il messaggio Slack: nessun ID del canale.',
    'Unable to send Slack message, body is empty.' => 'Impossibile inviare il messaggio Slack: il corpo è vuoto.',
    'Slack rejected the message: {error}' => 'Slack ha rifiutato il messaggio: {error}',
    'Slack POST failed: {reason}' => 'POST Slack non riuscito: {reason}',
    'Successfully sent Slack message to "{label}".' => 'Messaggio Slack inviato con successo a "{label}".',
    'Unable to send Bluesky post, recipient is missing credentials.' => 'Impossibile inviare il post Bluesky: al destinatario mancano le credenziali.',
    'Body exceeded {max} characters, truncated.' => 'Il corpo ha superato {max} caratteri ed è stato troncato.',
    'Successfully posted to Bluesky as "{label}".' => 'Pubblicato con successo su Bluesky come "{label}".',
    'Bluesky auth failed for {handle}: {reason}' => 'Autenticazione Bluesky non riuscita per {handle}: {reason}',
    'Bluesky auth failed: {reason}' => 'Autenticazione Bluesky non riuscita: {reason}',
    'Bluesky post failed: {reason}' => 'Post Bluesky non riuscito: {reason}',
    'Bluesky link preview skipped: {reason}' => 'Anteprima del link Bluesky saltata: {reason}',

    // Recipient warnings
    'Recipient "{name}" has no email address.' => 'Il destinatario "{name}" non ha un indirizzo email.',
    'Recipient "{name}" has no phone number.' => 'Il destinatario "{name}" non ha un numero di telefono.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => "Il destinatario \"{name}\" non ha un utente associato; impossibile inviare l'annuncio.",
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => "Il destinatario \"{name}\" non può accedere al pannello di controllo; impossibile inviare l'annuncio.",
    'Pushover user-key field is not configured on this notification.' => 'Il campo della chiave utente Pushover non è configurato per questa notifica.',
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => 'Il destinatario "{name}" non ha un utente associato; impossibile inviare il messaggio Pushover.',
    '[SKIPPED] User "{name}" has no Pushover key.' => "[IGNORATO] L'utente \"{name}\" non ha una chiave Pushover.",
    'Recipient "{name}" has no ntfy topic.' => 'Il destinatario "{name}" non ha un argomento ntfy.',
    'Recipient "{name}" has no Bluesky credentials.' => 'Il destinatario "{name}" non ha credenziali Bluesky.',
    'Recipient "{name}" has no Slack bot token.' => 'Il destinatario "{name}" non ha un token del bot Slack.',
    'Recipient "{name}" has no Slack channel ID.' => 'Il destinatario "{name}" non ha un ID del canale Slack.',

    // Errors & exceptions
    'Invalid element event: {class}' => 'Evento elemento non valido: {class}',
    'Invalid notification ID: {id}' => 'ID notifica non valido: {id}',
    'Invalid email message mode.' => 'Modalità messaggio email non valida.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Non hai i permessi per usare il tipo Destinatari dinamici.',
    'Dynamic recipients snippet did not call setRecipients.' => 'Lo snippet dei destinatari dinamici non ha chiamato setRecipients.',
    'setRecipients was called with an empty value.' => 'setRecipients è stato chiamato con un valore vuoto.',
    'Unrecognized recipient of type "{type}".' => 'Destinatario di tipo "{type}" non riconosciuto.',
    'Unrecognized recipient "{value}".' => 'Destinatario "{value}" non riconosciuto.',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => 'Il {kind} configurato non esiste più nelle impostazioni del plugin (uid: {uid}).',
    'Invalid settings section: {section}' => 'Sezione di impostazioni non valida: {section}',
    'User not authorized to save this notification.' => "L'utente non è autorizzato a salvare questa notifica.",
    'User not authorized to view this notification.' => "L'utente non è autorizzato a visualizzare questa notifica.",
    'User not authorized to delete this notification.' => "L'utente non è autorizzato a eliminare questa notifica.",
    'Notification not found' => 'Notifica non trovata',
    'Element not found' => 'Elemento non trovato',
    'You do not have permission to use the Dynamic Data type.' => 'Non hai il permesso di usare il tipo Dati dinamici.',
    'The Dynamic Data snippet did not call the {tag} tag.' => 'Lo snippet Twig non ha richiamato il tag {tag}.',
    'Invalid Slack body format.' => 'Formato del corpo Slack non valido.',

    // Config-file override note
    'This is being set in the config file. [{file}]' => 'Questo viene impostato nel file di configurazione. [{file}]',

    // ============================================================
    // JAVASCRIPT UI
    // ============================================================

    // JavaScript: log utility & buttons
    'Test notification failed.' => 'Notifica di prova non riuscita.',
    'Unable to get the notification, something went wrong.' => 'Impossibile recuperare la notifica, qualcosa è andato storto.',
    'Something went wrong.' => 'Qualcosa è andato storto.',
    'Invalid notification ID.' => 'ID notifica non valido.',
    'Unable to delete the log event, something went wrong.' => 'Impossibile eliminare l\'evento di registro, qualcosa è andato storto.',
    'Log event deleted.' => 'Evento di registro eliminato.',
    'Unable to delete log events, something went wrong.' => 'Impossibile eliminare gli eventi di registro, qualcosa è andato storto.',
    'Are you sure you want to delete this log event?' => 'Vuoi davvero eliminare questo evento di registro?',
    'Are you sure you want to delete all logs from {date}?' => 'Vuoi davvero eliminare tutti i registri del {date}?',
];
