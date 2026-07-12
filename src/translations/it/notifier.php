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
    'Adds "Notifications" to the control panel navigation.' => 'Aggiunge "Notifiche" alla navigazione del pannello di controllo.',
    'Save notifications' => 'Salva le notifiche',
    'Edit the Event tab' => 'Modifica la scheda Evento',
    'Edit the Message tab' => 'Modifica la scheda Messaggio',
    'Edit the Recipients tab' => 'Modifica la scheda Destinatari',
    'Use the Dynamic Recipients type' => 'Usa il tipo Destinatari dinamici',
    'Use the Dynamic Data type' => 'Usa il tipo Dati dinamici',
    'Send test notifications' => 'Invia notifiche di prova',
    'Send manual notifications' => 'Invia notifiche manuali',
    'Delete notifications' => 'Elimina le notifiche',
    'View notification log' => 'Vedi il registro notifiche',
    'Adds "Notification Log" to the control panel Utilities.' => 'Aggiunge "Registro notifiche" alle Utilità del pannello di controllo.',
    'Delete notification log' => 'Elimina il registro notifiche',
    'Runs custom Twig code when a message is sent. Only grant this to highly trusted users!' => 'Esegue codice Twig personalizzato quando viene inviato un messaggio. Concedi questo permesso solo a utenti altamente fidati!',

    // ========================================================
    // NOTIFICATION EDITOR
    // ========================================================

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

    // Event tab: Formie
    'Submission Outcome' => "Esito dell'invio",
    'Trigger based on the success or failure of a submission.' => 'Attiva in base al successo o al fallimento di un invio.',
    'Successful submissions only' => 'Solo invii riusciti',
    'Failed submissions only' => 'Solo invii non riusciti',
    'All submissions' => 'Tutti gli invii',

    // Event tab: Feed
    'Feed URL' => 'URL del feed',
    'The URL of the RSS, Atom, or JSON feed to watch.' => "L'URL del feed RSS, Atom o JSON da monitorare.",
    'Feed Timeout' => 'Timeout del feed',
    'How long to wait when the feed is loading slowly. Default {default} seconds, max {max}.' => 'Quanto attendere quando il feed si carica lentamente. Predefinito {default} secondi, max {max}.',
    'seconds' => 'secondi',

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
    'Generate report on a recurring schedule' => 'Genera rapporto secondo una pianificazione ricorrente',
    'Generate report on demand' => 'Genera rapporto su richiesta',
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

    // Message tab: type selector
    'Message Type' => 'Tipo di messaggio',
    'What type of message will be sent?' => 'Quale tipo di messaggio verrà inviato?',
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are supported.' => 'Sono supportati [templating]({templatingUrl}) e [variabili speciali]({variablesUrl}).',

    // Details sidebar: queue
    'Use Queue' => 'Usa coda',
    'Immediate' => 'Immediato',
    'Queue' => 'Coda',
    'jobs queue' => 'coda dei processi',
    'Whether the message will be sent immediately, or added to the {link}.' => 'Se il messaggio verrà inviato immediatamente o aggiunto alla {link}.',
    'Flash messages never use the queue.' => 'I messaggi flash non usano mai la coda.',
    'Announcements always use the queue.' => 'Gli annunci usano sempre la coda.',

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

    // Message tab: Discord
    'Discord Message Body' => 'Corpo del messaggio Discord',
    'Supports standard Markdown, and optionally HTML _(see below)_. Max 2000 characters.' => 'Supporta il Markdown standard e, facoltativamente, HTML _(vedi sotto)_. Max 2000 caratteri.',
    'Whether to only parse as Markdown, or additionally parse it as HTML.' => 'Analizzare solo come Markdown, o anche come HTML.',
    'Markdown only' => 'Solo Markdown',
    'Markdown + HTML' => 'Markdown + HTML',
    'Whether Discord should unfurl link previews for URLs in the message body.' => 'Se Discord deve mostrare le anteprime dei link per gli URL nel corpo del messaggio.',
    'Webhook Username' => 'Nome utente del webhook',
    'Optionally override the webhook\'s display name.' => 'Sostituisci facoltativamente il nome visualizzato del webhook.',
    'Dynamic Username' => 'Nome utente dinamico',
    'Webhook Avatar URL' => "URL dell'avatar del webhook",
    'Optionally override the webhook\'s avatar with a URL.' => "Sostituisci facoltativamente l'avatar del webhook con un URL.",

    // Message tab: Facebook
    'Message Body' => 'Corpo del messaggio',
    'The text of your Facebook post.' => 'Il testo del tuo post Facebook.',
    'Preview Card URL' => 'URL della scheda di anteprima',
    'Optionally add a link to generate a preview card.' => 'Aggiungi facoltativamente un link per generare una scheda di anteprima.',

    // Message tab: Instagram
    'Caption' => 'Didascalia',
    'Image Attachment' => 'Allegato immagine',
    'Optional caption, max 2200 characters.' => 'Didascalia facoltativa, massimo 2200 caratteri.',

    // Message tab: X (Twitter)
    'Plain text, max 280 characters.' => 'Testo normale, massimo 280 caratteri.',

    // Message tab: Media
    'Attach an image by calling `{% setMedia %}` in a [custom Twig snippet]({url}).' => "Allega un'immagine chiamando `{% setMedia %}` in uno [snippet Twig personalizzato]({url}).",

    // Message tab: Bluesky
    'Post Body' => 'Corpo del post',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => 'Testo normale, massimo 300 caratteri. Gli URL e le menzioni `@handle.tld` diventano automaticamente link.',
    'Generate Link Preview' => 'Genera anteprima del link',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => 'Genera automaticamente una scheda di anteprima quando il corpo del post contiene un URL.',
    'No card' => 'Nessuna scheda',
    'Generate preview card' => 'Genera scheda di anteprima',

    // Message tab: Mastodon
    'Plain text, max 500 characters. URLs will unfurl automatically.' => 'Solo testo, max 500 caratteri. Gli URL si espandono automaticamente.',
    'Visibility' => 'Visibilità',
    'Who will be able to see this post?' => 'Chi potrà vedere questo post?',

    // Message tab: LinkedIn
    'LinkedIn' => 'LinkedIn',
    'The text of your LinkedIn post.' => 'Il testo del tuo post LinkedIn.',

    // Message tab: MQTT
    'Payload' => 'Contenuto',
    'The JSON or plain text message published to the MQTT topic.' => 'Il messaggio JSON o di testo semplice pubblicato sull\'argomento MQTT.',
    'Quality of Service' => 'Qualità del servizio',
    'Delivery guarantee for this message.' => 'Garanzia di consegna per questo messaggio.',
    'Retain' => 'Conserva',
    'Whether the broker keeps this as the topic\'s last message for future subscribers.' => 'Se il broker conserva questo come ultimo messaggio dell\'argomento, consegnandolo ai futuri sottoscrittori.',
    'Don\'t retain' => 'Non conservare',

    // Recipients tab: type selector & user/group pickers
    'Recipients Type' => 'Tipo di destinatari',
    'Who will receive this message?' => 'Chi riceverà questo messaggio?',
    'Add a message recipient' => 'Aggiungi un destinatario',
    'Select User(s)' => 'Seleziona utente/i',
    'Which users will receive the message?' => 'Quali utenti riceveranno il messaggio?',
    'Which user groups will receive the message?' => 'Quali gruppi di utenti riceveranno il messaggio?',

    // Recipients tab: channel pickers (ntfy, Slack, Discord, Bluesky, Mastodon, MQTT)
    'Select ntfy topic(s)' => 'Seleziona argomento/i ntfy',
    'Which topics should receive this message?' => 'Quali argomenti devono ricevere questo messaggio?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'Nessun argomento ntfy configurato. Aggiungine uno in [Impostazioni → ntfy]({url}).',
    'No ntfy topics configured. Topics can only be added in an environment that allows administrative changes.' => 'Nessun argomento ntfy configurato. Gli argomenti possono essere aggiunti solo in un ambiente che consente le modifiche amministrative.',
    'Select Slack channel(s)' => 'Seleziona canale/i Slack',
    'Which channels should receive this message?' => 'Quali canali devono ricevere questo messaggio?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Nessun canale Slack configurato. Aggiungine uno in [Impostazioni → Slack]({url}).',
    'No Slack channels configured. Channels can only be added in an environment that allows administrative changes.' => 'Nessun canale Slack configurato. I canali possono essere aggiunti solo in un ambiente che consente le modifiche amministrative.',
    'Select Discord channel(s)' => 'Seleziona canale/i Discord',
    'No Discord channels configured. Add one in [Settings → Discord]({url}).' => 'Nessun canale Discord configurato. Aggiungine uno in [Impostazioni → Discord]({url}).',
    'No Discord channels configured. Channels can only be added in an environment that allows administrative changes.' => 'Nessun canale Discord configurato. I canali possono essere aggiunti solo in un ambiente che consente le modifiche amministrative.',
    'Select Facebook page(s)' => 'Seleziona pagina/e Facebook',
    'Which pages should post this message?' => 'Quali pagine devono pubblicare questo messaggio?',
    'No Facebook pages configured. Add one in [Settings → Facebook]({url}).' => 'Nessuna pagina Facebook configurata. Aggiungine una in [Impostazioni → Facebook]({url}).',
    'No Facebook pages configured. Pages can only be added in an environment that allows administrative changes.' => 'Nessuna pagina Facebook configurata. Le pagine possono essere aggiunte solo in un ambiente che consente le modifiche amministrative.',
    'Select Instagram account(s)' => 'Seleziona account Instagram',
    'No Instagram accounts configured. Add one in [Settings → Instagram]({url}).' => 'Nessun account Instagram configurato. Aggiungine uno in [Impostazioni → Instagram]({url}).',
    'No Instagram accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Nessun account Instagram configurato. Gli account possono essere aggiunti solo in un ambiente che consente le modifiche amministrative.',
    'Select X (Twitter) account(s)' => 'Seleziona account X (Twitter)',
    'No X (Twitter) accounts configured. Add one in [Settings → X (Twitter)]({url}).' => 'Nessun account X (Twitter) configurato. Aggiungine uno in [Impostazioni → X (Twitter)]({url}).',
    'No X (Twitter) accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Nessun account X (Twitter) configurato. Gli account possono essere aggiunti solo in un ambiente che consente le modifiche amministrative.',
    'Select Bluesky account(s)' => 'Seleziona account Bluesky',
    'Which accounts should post this message?' => 'Quali account devono pubblicare questo messaggio?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Nessun account Bluesky configurato. Aggiungine uno in [Impostazioni → Bluesky]({url}).',
    'No Bluesky accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Nessun account Bluesky configurato. Gli account possono essere aggiunti solo in un ambiente che consente le modifiche amministrative.',
    'Select Mastodon account(s)' => 'Seleziona account Mastodon',
    'No Mastodon accounts configured. Add one in [Settings → Mastodon]({url}).' => 'Nessun account Mastodon configurato. Aggiungine uno in [Impostazioni → Mastodon]({url}).',
    'No Mastodon accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Nessun account Mastodon configurato. Gli account possono essere aggiunti solo in un ambiente che consente le modifiche amministrative.',
    'Select MQTT topic(s)' => 'Seleziona argomento/i MQTT',
    'No MQTT topics configured. Add one in [Settings → MQTT]({url}).' => 'Nessun argomento MQTT configurato. Aggiungine uno in [Impostazioni → MQTT]({url}).',
    'No MQTT topics configured. Topics can only be added in an environment that allows administrative changes.' => 'Nessun argomento MQTT configurato. Gli argomenti possono essere aggiunti solo in un ambiente che consente le modifiche amministrative.',
    'Not a valid topic. Must not be empty or contain the `+` or `#` wildcards.' => 'Argomento non valido. Non deve essere vuoto né contenere i caratteri jolly `+` o `#`.',

    // Recipients tab: LinkedIn picker
    'Select LinkedIn account(s)' => 'Seleziona l\'account o gli account LinkedIn',
    'Which page or member should post this message?' => 'Quale pagina o membro deve pubblicare questo messaggio?',
    'No LinkedIn accounts connected. Connect one in [Settings → LinkedIn]({url}).' => 'Nessun account LinkedIn connesso. Connettine uno in [Impostazioni → LinkedIn]({url}).',
    'No LinkedIn accounts connected. Accounts can only be connected in an environment that allows administrative changes.' => 'Nessun account LinkedIn connesso. Gli account possono essere connessi solo in un ambiente che consente le modifiche amministrative.',

    // Recipients tab: dynamic recipients snippet
    'Twig Snippet to Determine Recipients' => 'Snippet Twig per determinare i destinatari',
    'Enter a custom Twig snippet to [determine who will receive the message]({url}).' => 'Inserisci uno snippet Twig personalizzato per [determinare chi riceverà il messaggio]({url}).',
    'The snippet **must** include a `{% setRecipients %}` tag.' => 'Lo snippet **deve** includere un tag `{% setRecipients %}`.',

    // ========================================================
    // SETTINGS
    // ========================================================

    // Settings: nav & page chrome
    'Notifier Settings' => 'Impostazioni Notifier',
    'General' => 'Generale',
    'Notification Fields' => 'Campi di notifica',
    'Fields saved.' => 'Campi salvati.',
    'Couldn’t save fields.' => 'Impossibile salvare i campi.',
    'Notification fields can’t be edited when admin changes are disabled.' => 'I campi di notifica non possono essere modificati quando le modifiche amministrative sono disabilitate.',
    'Twilio' => 'Twilio',
    'Pushover' => 'Pushover',
    'ntfy' => 'ntfy',
    'Slack' => 'Slack',
    'Discord' => 'Discord',
    'Bluesky' => 'Bluesky',
    'Mastodon' => 'Mastodon',
    'MQTT' => 'MQTT',

    // Settings: nav group headings
    'Push Notifications' => 'Notifiche push',
    'Chat Platforms' => 'Piattaforme di chat',
    'Social Media' => 'Social media',
    'Internet of Things' => 'Internet delle cose',
    'Expand {heading}' => 'Espandi {heading}',

    // Settings: shared intro lines
    'Consult the [{name} setup guide]({url}) for complete instructions.' => 'Consulta la [guida alla configurazione di {name}]({url}) per istruzioni complete.',
    'Sensitive values can be stored in your `.env` file and referenced here.' => 'I valori sensibili possono essere memorizzati nel tuo file `.env` e referenziati qui.',

    // Settings: Notification order
    'Notification Order' => 'Ordine delle notifiche',
    'Notifications can be dragged into any order on the index page. Choose where new notifications land in that order.' => "Le notifiche possono essere trascinate per creare un ordine personalizzato nella pagina dell'elenco. Scegli dove vengono aggiunte le nuove notifiche in quell'ordine.",
    'Default Placement' => 'Posizione predefinita',
    'Where new notifications are added to the list.' => "Dove vengono aggiunte le nuove notifiche all'elenco.",
    'Before other notifications' => 'Prima delle altre notifiche',
    'After other notifications' => 'Dopo le altre notifiche',

    // Settings: Logging
    'Logging' => 'Registrazione',
    "Notifier keeps a running log of every message it sends. You usually won't need to change this, but you can limit how many log entries are kept in the database." => 'Notifier mantiene un registro continuo dei messaggi inviati. In genere non è necessario, ma puoi limitare la quantità di eventi di log registrati nel database.',
    'Enable Logging' => 'Abilita la registrazione',
    'When disabled, Notifier will not write anything to the notification log.' => 'Quando disabilitato, Notifier non scrive nulla nel registro delle notifiche.',
    'Number of days to retain log events' => 'Numero di giorni di conservazione degli eventi di log',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Conserva gli eventi di log al massimo per questo numero di giorni. Lascia vuoto per nessun limite.',
    'Number of log events to retain' => 'Numero di eventi di log da conservare',
    'At most, keep this many log events. Leave blank for no limit.' => 'Conserva al massimo questo numero di eventi di log. Lascia vuoto per nessun limite.',

    // Settings: Scheduled sending
    'Scheduled Sending' => 'Invio programmato',
    'A shared secret that authenticates scheduled runs triggered over the web. You only need this if you trigger the schedule from the web endpoint.' => "Segreto condiviso per autenticare le richieste web dell'esecuzione programmata. Richiesto solo quando la pianificazione viene attivata tramite l'endpoint web.",
    'Scheduled-Run Token' => 'Token di esecuzione programmata',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => 'Inviato con ogni richiesta come header X-Notifier-Token o come parametro token nel corpo.',

    // Settings: Twilio
    'Send SMS text messages through [Twilio](https://www.twilio.com).' => 'Invia messaggi di testo SMS tramite [Twilio](https://www.twilio.com).',
    'Twilio Account SID' => 'Twilio Account SID',
    'Twilio Auth Token' => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)' => 'Numero di telefono Twilio (invia ogni SMS)',
    'SMS Testing' => 'Test SMS',
    'Optional. When set, every SMS is sent to this number instead of the actual recipient.' => 'Opzionale. Se impostato, ogni SMS inviato sarà recapitato a questo numero invece che al destinatario risolto.',
    'Test phone number' => 'Numero di telefono di prova',

    // Settings: Pushover
    'Send push notifications through [Pushover](https://pushover.net).' => 'Invia notifiche push tramite [Pushover](https://pushover.net).',
    'Application API Token' => "Token API dell'applicazione",
    'The 30-character app token from your Pushover application.' => 'Il token applicativo di 30 caratteri della tua applicazione Pushover.',

    // Settings: ntfy
    'Send push notifications through [ntfy](https://ntfy.sh).' => 'Invia notifiche push tramite [ntfy](https://ntfy.sh).',
    'Server URL' => 'URL del server',
    "Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`." => "Opzionale, punta a un'istanza ntfy self-hosted (se necessario). Predefinito `https://ntfy.sh`.",
    'Access token' => 'Token di accesso',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Opzionale, richiesto per argomenti protetti o istanze self-hosted con autenticazione.',
    'ntfy Topics' => 'Argomenti ntfy',
    'Add the ntfy topics you want to send to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => "Aggiungi gli argomenti ntfy a cui vuoi inviare messaggi. Ogni argomento diventa disponibile come destinatario nella scheda **Destinatari** durante la configurazione di una notifica.",
    'Topics' => 'Argomenti',
    "Click any row's **Test** button to send a quick test message to that topic." => "Fai clic sul pulsante **Prova** di una qualsiasi riga per inviare un rapido messaggio di prova a quell'argomento.",
    'Label' => 'Etichetta',
    'Topic' => 'Argomento',
    'Add a topic' => 'Aggiungi un argomento',

    // Settings: Slack
    'Post messages to your Slack channels.' => 'Pubblica messaggi nei tuoi canali Slack.',
    'Channels' => 'Canali',
    "Click any row's **Test** button to send a quick test message to that channel." => 'Fai clic sul pulsante **Prova** di una qualsiasi riga per inviare un rapido messaggio di prova a quel canale.',
    'Bot Token' => 'Token del bot',
    'Channel ID' => 'ID del canale',
    'Add a channel' => 'Aggiungi un canale',
    'Not a valid Bot Token. Must start with `xoxb-`.' => 'Token del bot non valido. Deve iniziare con `xoxb-`.',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => 'ID del canale non valido. Deve apparire come `C01234ABCD`.',

    // Settings: Discord
    'Post messages to your Discord channels.' => 'Pubblica messaggi nei tuoi canali Discord.',
    'Webhook URL' => 'Webhook URL',
    'Not a valid Webhook URL. Must start with `https://discord.com/api/webhooks/`.' => 'Webhook URL non valido. Deve iniziare con `https://discord.com/api/webhooks/`.',

    // Settings: Facebook
    'Facebook' => 'Facebook',
    'Publish posts to your [Facebook](https://facebook.com) pages.' => 'Pubblica post sulle tue pagine [Facebook](https://facebook.com).',
    'Pages' => 'Pagine',
    'Page ID' => 'Page ID',
    'Page Access Token' => 'Page Access Token',
    'Add a page' => 'Aggiungi una pagina',
    "Click any row's **Test** button to verify that page's credentials. No posts are made." => "Fai clic sul pulsante **Prova** di una qualsiasi riga per verificare le credenziali di quella pagina. Non viene effettuata alcuna pubblicazione.",

    // Settings: Instagram
    'Instagram' => 'Instagram',
    'Publish posts to your [Instagram](https://instagram.com) Business accounts.' => 'Pubblica post sui tuoi account Business [Instagram](https://instagram.com).',
    "Click any row's **Test** button to resolve the linked Instagram account. No posts are made." => "Fai clic sul pulsante **Prova** di una qualsiasi riga per risolvere l'account Instagram collegato. Non viene effettuata alcuna pubblicazione.",

    // Settings: X (Twitter)
    'X (Twitter)' => 'X (Twitter)',
    'Publish posts to your [X (Twitter)](https://x.com) accounts.' => 'Pubblica post sui tuoi account [X (Twitter)](https://x.com).',
    'Consumer Key' => 'Consumer Key',
    'Consumer Key Secret' => 'Consumer Key Secret',
    'Access Token Secret' => 'Access Token Secret',

    // Settings: Bluesky
    'Publish posts to your [Bluesky](https://bsky.app) accounts.' => 'Pubblica post sui tuoi account [Bluesky](https://bsky.app).',
    'PDS URL' => 'URL del PDS',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'Predefinito https://bsky.social. Punta a un PDS personalizzato se la tua installazione si federa.',
    'Bluesky Accounts' => 'Account Bluesky',
    'Add the Bluesky accounts you want to post from. Each account becomes available as a recipient on the **Recipients** tab when you set up a notification.' => "Aggiungi gli account Bluesky da cui vuoi pubblicare. Ogni account diventa disponibile come destinatario nella scheda **Destinatari** durante la configurazione di una notifica.",
    'Accounts' => 'Account',
    "Click any row's **Test** button to confirm the account authenticates." => "Fai clic sul pulsante **Prova** di una qualsiasi riga per confermare che l'account si autentichi.",
    'Handle' => 'Handle',
    'App password' => 'Password applicativa',
    'Add an account' => 'Aggiungi un account',

    // Settings: Mastodon
    'Publish posts to your [Mastodon](https://joinmastodon.org) accounts.' => 'Pubblica post sui tuoi account [Mastodon](https://joinmastodon.org).',
    'Click any row\'s **Test** button to verify that account\'s credentials. No posts are made.' => "Fai clic sul pulsante **Prova** di una qualsiasi riga per verificare le credenziali di quell'account. Non viene effettuata alcuna pubblicazione.",
    'Instance URL' => "URL dell'istanza",
    'Access Token' => 'Token di accesso',

    // Settings: LinkedIn
    'Publish posts to your [LinkedIn](https://linkedin.com) profile.' => 'Pubblica post sul tuo profilo [LinkedIn](https://linkedin.com).',
    'The Client ID of your LinkedIn app.' => 'L\'ID client della tua app LinkedIn.',
    'Client Secret' => 'Client secret',
    'The Primary Client Secret of your LinkedIn app.' => 'Il client secret principale della tua app LinkedIn.',
    'Enable organization posting' => 'Abilita la pubblicazione per le organizzazioni',
    'Copy this redirect URL' => 'Copia questo URL di reindirizzamento',
    'When configuring the LinkedIn app, <strong>copy this URL</strong> to use as an "Authorized redirect URL".' => 'Durante la configurazione dell\'app LinkedIn, <strong>copia questo URL</strong> da usare come "Authorized redirect URL".',
    'Also request access to post as organization pages you administer. Requires Community Management API approval from LinkedIn.' => 'Richiedi anche l\'accesso per pubblicare come le pagine dell\'organizzazione che amministri. Richiede l\'approvazione della Community Management API da parte di LinkedIn.',
    'Connections' => 'Connessioni',
    'Each connection becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Ogni connessione diventa disponibile come destinatario nella scheda **Destinatari** quando configuri una notifica.',
    'Account' => 'Account',
    'Type' => 'Tipo',
    'Status' => 'Stato',
    'Organization' => 'Organizzazione',
    'Member' => 'Membro',
    'Reconnect needed' => 'Riconnessione necessaria',
    'Expires' => 'Scade',
    'Connected' => 'Connesso',
    'Disconnect' => 'Disconnetti',
    'No LinkedIn accounts are connected yet.' => 'Nessun account LinkedIn è ancora connesso.',
    'Connect to LinkedIn' => 'Connetti a LinkedIn',
    'Provide valid credentials to connect with LinkedIn.' => 'Fornisci credenziali valide per connetterti a LinkedIn.',
    'Disconnect this LinkedIn account?' => 'Disconnettere questo account LinkedIn?',

    // Settings: MQTT
    'Publish messages to an MQTT broker, handy for IoT and home-automation setups.' => 'Pubblica messaggi su un broker MQTT, comodo per configurazioni IoT e di domotica.',
    'Host' => 'Host',
    'Broker hostname, without a protocol or port.' => 'Nome host del broker, senza protocollo o porta.',
    'Port' => 'Porta',
    'Optional. Defaults to 8883 when TLS is enabled, otherwise 1883.' => 'Facoltativo. Il valore predefinito è 8883 quando TLS è abilitato, altrimenti 1883.',
    'Use TLS' => 'Usa TLS',
    'Whether to connect to the broker over a secure TLS socket.' => 'Se connettersi al broker tramite un socket TLS sicuro.',
    'Username' => 'Nome utente',
    'Optional, for brokers that require username/password authentication.' => 'Facoltativo, per i broker che richiedono l\'autenticazione con nome utente/password.',
    'Password' => 'Password',
    'MQTT Version' => 'Versione MQTT',
    'Protocol version sent to the broker.' => 'Versione del protocollo inviata al broker.',
    'Client ID' => 'ID client',
    'Optional. A unique client ID is generated automatically when left blank.' => 'Facoltativo. Un ID client univoco viene generato automaticamente quando il campo è vuoto.',
    'Mutual TLS' => 'TLS reciproco',
    'Optional. Needed for brokers that authenticate clients with certificates, such as AWS IoT Core. Enter the server file paths to your certificate files. You can use a `.env` variable or `@alias` reference.' => 'Facoltativo. Necessario per i broker che autenticano i client con certificati, come AWS IoT Core. Indica i percorsi dei file sul server verso i file di certificato (è consentita una variabile `.env` o un riferimento `@alias`).',
    'CA Certificate File' => 'File del certificato CA',
    'Path to the certificate authority (CA) file.' => 'Percorso del file dell\'autorità di certificazione (CA).',
    'Client Certificate File' => 'File del certificato client',
    'Path to the client certificate file.' => 'Percorso del file del certificato client.',
    'Client Key File' => 'File della chiave client',
    'Path to the client private key file.' => 'Percorso del file della chiave privata del client.',
    'MQTT Topics' => 'Argomenti MQTT',
    'Add the MQTT topics you want to publish to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Aggiungi gli argomenti MQTT su cui vuoi pubblicare. Ogni argomento diventa disponibile come destinatario nella scheda **Destinatari** durante la configurazione di una notifica.',
    'Click any row\'s **Test** button to publish a quick test message to that topic.' => 'Fai clic sul pulsante **Prova** di una qualsiasi riga per pubblicare un rapido messaggio di prova su quell\'argomento.',

    // ========================================================
    // MANUAL SEND & TEST
    // ========================================================

    // Manual send & test
    'Send a test message' => 'Invia un messaggio di prova',
    'Send a REAL test notification?\\n\\n⚠️ Uses a random sample of real data.\\n⚠️ Sends a real message via the configured channel.\\n⚠️ Delivers to the real configured recipient(s).' => 'Inviare una notifica di prova REALE?\\n\\n⚠️ Usa un campione casuale di dati reali.\\n⚠️ Invia un messaggio reale tramite il canale configurato.\\n⚠️ Viene consegnato ai destinatari reali configurati.',
    'Test' => 'Prova',
    'Send system snapshot' => 'Invia istantanea del sistema',
    'Send data report' => 'Invia report dei dati',
    'Are you sure you want to send this notification?' => 'Sei sicuro di voler inviare questa notifica?',
    'This notification cannot be triggered manually.' => 'Questa notifica non può essere attivata manualmente.',
    'This notification no longer applies to the selected element.' => "Questa notifica non si applica più all'elemento selezionato.",

    // ========================================================
    // RUNTIME OUTPUT
    // ========================================================

    // Runtime: dispatch log feedback
    'Sending {messageType} to {recipient}.' => 'Invio di {messageType} a {recipient}.',
    'Sending "{title}".' => 'Invio di "{title}".',
    '[invalid recipient]' => '[destinatario non valido]',
    'Scanning feed {url}.' => 'Scansione del feed {url}.',
    'Adding message to queue.' => 'Aggiunta del messaggio alla coda.',
    'Sending message immediately (bypassing queue).' => 'Invio immediato del messaggio (bypass della coda).',

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
    'Page ID and Page Access Token are required.' => 'Page ID e Page Access Token sono obbligatori.',
    'Facebook rejected the request: {error}' => 'Facebook ha rifiutato la richiesta: {error}',
    'Successfully connected to "{name}". No posts were made.' => 'Connesso con successo a "{name}". Nessuna pubblicazione è stata effettuata.',
    'No Instagram Business account is linked to this Page.' => 'Nessun account Instagram Business è collegato a questa pagina.',
    'Successfully connected to @{handle}. No posts were made.' => 'Connesso con successo a @{handle}. Nessuna pubblicazione è stata effettuata.',
    'All four credentials are required.' => 'Sono richieste tutte e quattro le credenziali.',
    'X (Twitter) rejected the request: {error}' => 'X (Twitter) ha rifiutato la richiesta: {error}',
    'Successfully authenticated as @{username}. No posts were made.' => 'Autenticato con successo come @{username}. Nessuna pubblicazione è stata effettuata.',
    'Handle and app password are required.' => 'Handle e password applicativa sono obbligatori.',
    'Authentication failed.' => 'Autenticazione non riuscita.',
    'Successfully authenticated. No messages were posted.' => 'Autenticazione riuscita. Nessun messaggio è stato pubblicato.',
    'Log events deleted.' => 'Eventi di log eliminati.',
    'Notification sent.' => 'Notifica inviata.',
    'Notification was not sent. Check the Notification Log for details.' => 'La notifica non è stata inviata. Consulta il Registro notifiche per i dettagli.',
    'Instance URL and access token are required.' => "L'URL dell'istanza e il token di accesso sono obbligatori.",
    'Mastodon rejected the request: {error}' => 'Mastodon ha rifiutato la richiesta: {error}',
    'Successfully authenticated as @{handle}. No posts were made.' => 'Autenticato con successo come @{handle}. Nessuna pubblicazione è stata effettuata.',
    'Broker host is not configured.' => 'L\'host del broker non è configurato.',

    // Runtime: LinkedIn connect flow
    'Add your LinkedIn app credentials before connecting.' => 'Aggiungi le credenziali della tua app LinkedIn prima di connetterti.',
    'LinkedIn authorization failed: {error}' => 'Autorizzazione LinkedIn non riuscita: {error}',
    'LinkedIn authorization failed: invalid state.' => 'Autorizzazione LinkedIn non riuscita: stato non valido.',
    'LinkedIn authorization failed: no code returned.' => 'Autorizzazione LinkedIn non riuscita: nessun codice restituito.',
    'Connected to LinkedIn.' => 'Connesso a LinkedIn.',
    'Disconnected from LinkedIn.' => 'Disconnesso da LinkedIn.',

    // Outbound: per-channel send results
    'Successfully sent an email to {name}.' => 'Email inviata con successo a {name}.',
    'Successfully sent an SMS message to {name}.' => 'SMS inviato con successo a {name}.',
    'Successfully sent a Pushover notification to {name}.' => 'Notifica Pushover inviata con successo a {name}.',
    'Successfully posted an announcement for {name}.' => 'Annuncio pubblicato con successo per {name}.',
    'Successfully sent a flash message to {name}.' => 'Messaggio flash inviato con successo a {name}.',
    'Successfully posted to Slack in channel "{label}".' => 'Pubblicato con successo su Slack nel canale "{label}".',
    'Successfully posted to Discord in channel "{label}".' => 'Pubblicato con successo su Discord nel canale "{label}".',
    'Successfully posted to Facebook as "{label}" account.' => 'Pubblicato con successo su Facebook come account "{label}".',
    'Successfully posted to Instagram as "{label}" account.' => 'Pubblicato con successo su Instagram come account "{label}".',
    'Successfully posted to X (Twitter) as "{label}" account.' => 'Pubblicato con successo su X (Twitter) come account "{label}".',
    'Successfully posted to Bluesky as "{label}" account.' => 'Pubblicato con successo su Bluesky come account "{label}".',
    'Successfully posted to Mastodon as "{label}" account.' => 'Pubblicato con successo su Mastodon come account "{label}".',
    'Successfully posted to LinkedIn as "{label}" account.' => 'Pubblicato con successo su LinkedIn come account "{label}".',
    'Successfully sent ntfy message to topic "{topic}".' => "Messaggio ntfy inviato con successo all'argomento \"{topic}\".",
    'Slack rejected the message: {error}' => 'Slack ha rifiutato il messaggio: {error}',
    'Discord rejected the message: {error}' => 'Discord ha rifiutato il messaggio: {error}',
    'the attached image could not be read' => "non è stato possibile leggere l'immagine allegata",
    'Successfully sent MQTT message to topic "{topic}".' => 'Messaggio MQTT inviato correttamente all\'argomento "{topic}".',

    // Outbound: LinkedIn send results & skips
    '[EMPTY BODY] The LinkedIn post body is empty.' => '[EMPTY BODY] Il corpo del post LinkedIn è vuoto.',
    '[NO RECIPIENT] No LinkedIn connection was specified.' => '[NO RECIPIENT] Nessuna connessione LinkedIn specificata.',
    '[RECONNECT REQUIRED] {reason}' => '[RECONNECT REQUIRED] {reason}',
    '[REJECTED BY LINKEDIN] {error}' => '[REJECTED BY LINKEDIN] {error}',
    'LinkedIn app credentials are not configured.' => 'Le credenziali dell\'app LinkedIn non sono configurate.',
    'The LinkedIn access token has expired. Please reconnect.' => 'Il token di accesso LinkedIn è scaduto. Riconnettiti.',
    'The LinkedIn connection no longer exists.' => 'La connessione LinkedIn non esiste più.',
    'My LinkedIn Profile' => 'Il mio profilo LinkedIn',
    '[SKIPPED] Recipient "{name}" has no LinkedIn connection.' => '[SKIPPED] Il destinatario "{name}" non ha alcuna connessione LinkedIn.',
    '[SKIPPED] The configured LinkedIn connection no longer exists (uid: {uid}).' => '[SKIPPED] La connessione LinkedIn configurata non esiste più (uid: {uid}).',

    // Media attachments
    'Videos are not yet supported on {channel}.' => 'I video non sono ancora supportati su {channel}.',
    'The image could not be resized to fit.' => "Impossibile ridimensionare l'immagine per adattarla.",
    'The image could not be read.' => "Impossibile leggere l'immagine.",
    'The image failed to upload.' => "Caricamento dell'immagine non riuscito.",
    'The upload response had no media ID.' => 'La risposta di caricamento non conteneva alcun ID media.',
    'The upload response had no blob.' => 'La risposta di caricamento non conteneva alcun blob.',
    '[NOT ATTACHED] Unable to attach image. {reason}' => "[NON ALLEGATO] Impossibile allegare l'immagine. {reason}",

    // Recipient warnings
    '[SKIPPED] User "{name}" has no Pushover key.' => "[IGNORATO] L'utente \"{name}\" non ha una chiave Pushover.",

    // Errors & exceptions
    'Invalid element event: {class}' => 'Evento elemento non valido: {class}',
    'Invalid notification ID: {id}' => 'ID notifica non valido: {id}',
    'Invalid email message mode.' => 'Modalità messaggio email non valida.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Non hai i permessi per usare il tipo Destinatari dinamici.',
    'Invalid settings section: {section}' => 'Sezione di impostazioni non valida: {section}',
    'User not authorized to save this notification.' => "L'utente non è autorizzato a salvare questa notifica.",
    'User not authorized to view this notification.' => "L'utente non è autorizzato a visualizzare questa notifica.",
    'User not authorized to delete this notification.' => "L'utente non è autorizzato a eliminare questa notifica.",
    'Notification not found' => 'Notifica non trovata',
    'Element not found' => 'Elemento non trovato',
    'You do not have permission to use the Dynamic Data type.' => 'Non hai il permesso di usare il tipo Dati dinamici.',
    '[NO DATA] The Dynamic Data snippet did not call the {tag} tag.' => '[NESSUN DATO] Lo snippet Twig non ha richiamato il tag {tag}.',

    // Config-file override note
    'This is being set in the config file. [{file}]' => 'Questo viene impostato nel file di configurazione. [{file}]',

    // ========================================================
    // JAVASCRIPT UI
    // ========================================================

    // JavaScript: log utility & buttons
    'Test notification failed.' => 'Notifica di prova non riuscita.',
    'Unable to get the notification, something went wrong.' => 'Impossibile recuperare la notifica, qualcosa è andato storto.',
    'Something went wrong.' => 'Qualcosa è andato storto.',
    'Invalid notification ID.' => 'ID notifica non valido.',
    'Unable to delete the log event, something went wrong.' => 'Impossibile eliminare l\'evento di registro, qualcosa è andato storto.',
    'Log event deleted.' => 'Evento di registro eliminato.',
    'Unable to delete log events, something went wrong.' => 'Impossibile eliminare gli eventi di registro, qualcosa è andato storto.',
    'Are you sure you want to delete all logs from {date}?' => 'Vuoi davvero eliminare tutti i registri del {date}?',
    // Reworded outbound + dispatch log messages
    '[BAD CREDENTIALS] Missing app token. [Configure Pushover]({url}).' => '[CREDENZIALI NON VALIDE] Token dell’app mancante. [Configura Pushover]({url}).',
    '[BAD CREDENTIALS] Missing {missing}. [Configure Twilio]({url}).' => '[CREDENZIALI NON VALIDE] {missing} mancante. [Configura Twilio]({url}).',
    '[BAD CREDENTIALS] No Discord webhook URL is configured.' => '[CREDENZIALI NON VALIDE] Nessun URL webhook di Discord configurato.',
    '[BAD CREDENTIALS] No MQTT broker host is configured.' => '[CREDENZIALI NON VALIDE] Nessun host del broker MQTT configurato.',
    '[BAD CREDENTIALS] No Mastodon access token is configured.' => '[CREDENZIALI NON VALIDE] Nessun token di accesso Mastodon configurato.',
    '[BAD CREDENTIALS] No Mastodon instance URL is configured.' => '[CREDENZIALI NON VALIDE] Nessun URL dell’istanza Mastodon configurato.',
    '[BAD CREDENTIALS] No Slack bot token is configured.' => '[CREDENZIALI NON VALIDE] Nessun token bot di Slack configurato.',
    '[BAD CREDENTIALS] No Twilio phone number is configured.' => '[CREDENZIALI NON VALIDE] Nessun numero di telefono Twilio configurato.',
    '[BAD CREDENTIALS] The recipient is missing Bluesky credentials.' => '[CREDENZIALI NON VALIDE] Al destinatario mancano le credenziali Bluesky.',
    '[BAD CREDENTIALS] The recipient is missing Facebook credentials.' => '[CREDENZIALI NON VALIDE] Al destinatario mancano le credenziali Facebook.',
    '[BAD CREDENTIALS] The recipient is missing X (Twitter) credentials.' => '[CREDENZIALI NON VALIDE] Al destinatario mancano le credenziali X (Twitter).',
    '[BAD CREDENTIALS] Unable to post, recipient is missing credentials.' => '[CREDENZIALI NON VALIDE] Impossibile pubblicare; al destinatario mancano le credenziali.',
    '[EMPTY BODY] The Discord message body is empty.' => '[CORPO VUOTO] Il corpo del messaggio Discord è vuoto.',
    '[EMPTY BODY] The Facebook post body is empty.' => '[CORPO VUOTO] Il corpo del post di Facebook è vuoto.',
    '[EMPTY BODY] The MQTT payload is empty.' => '[CORPO VUOTO] Il payload MQTT è vuoto.',
    '[EMPTY BODY] The Mastodon post body is empty.' => '[CORPO VUOTO] Il corpo del post di Mastodon è vuoto.',
    '[EMPTY BODY] The Slack message body is empty.' => '[CORPO VUOTO] Il corpo del messaggio Slack è vuoto.',
    '[EMPTY BODY] The X (Twitter) post body is empty.' => '[CORPO VUOTO] Il corpo del post di X (Twitter) è vuoto.',
    '[EMPTY BODY] The email message body was empty.' => '[CORPO VUOTO] Il corpo dell’e-mail era vuoto.',
    '[FEED ERROR] Could not fetch the feed: {message}' => '[ERRORE FEED] Impossibile recuperare il feed: {message}',
    '[FEED ERROR] Could not parse the feed.' => '[ERRORE FEED] Impossibile analizzare il feed.',
    '[FEED ERROR] Could not parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => '[ERRORE FEED] Impossibile analizzare il feed. Sono necessarie le estensioni PHP `simplexml` e `libxml`.',
    '[FEED ERROR] Initial feed scan failed: {message}' => '[ERRORE FEED] La scansione iniziale del feed non è riuscita: {message}',
    '[INVALID NUMBER] The recipient phone number is invalid.' => '[NUMERO NON VALIDO] Il numero di telefono del destinatario non è valido.',
    '[INVALID TYPE] The flash message type is invalid.' => '[TIPO NON VALIDO] Il tipo di messaggio flash non è valido.',
    '[LINK PREVIEW SKIPPED] {reason}' => '[ANTEPRIMA LINK IGNORATA] {reason}',
    '[MISSING IMAGE] Image Attachment field never called the {tag} tag.' => '[IMMAGINE MANCANTE] Il campo Allegato immagine non ha mai invocato il tag {tag}.',
    '[MISSING IMAGE] Image Attachment field was empty.' => '[IMMAGINE MANCANTE] Il campo Allegato immagine era vuoto.',
    '[MISSING IMAGE] The {tag} tag was called, but returned an invalid image.' => '[IMMAGINE MANCANTE] Il tag {tag} è stato invocato, ma ha restituito un’immagine non valida.',
    '[MISSING IMAGE] Unable to send Instagram post, the image needs a public URL.' => '[IMMAGINE MANCANTE] Impossibile inviare il post di Instagram; l’immagine richiede un URL pubblico.',
    '[NO CALENDAR] No calendars are selected, this notification will never be triggered.' => '[NESSUN CALENDARIO] Nessun calendario è selezionato, questa notifica non verrà mai attivata.',
    '[NO DIGITAL PRODUCT TYPE] No digital product types are selected, this notification will never be triggered.' => '[NESSUN TIPO DI PRODOTTO DIGITALE] Nessun tipo di prodotto digitale è selezionato, questa notifica non verrà mai attivata.',
    '[NO ENTRY TYPE] No sections or entry types are selected, this notification will never be triggered.' => '[NESSUN TIPO DI VOCE] Nessuna sezione o tipo di voce è selezionato, questa notifica non verrà mai attivata.',
    '[NO FORM] No forms are selected, this notification will never be triggered.' => '[NESSUN MODULO] Nessun modulo è selezionato, questa notifica non verrà mai attivata.',
    '[NO PRODUCT TYPE] No product types are selected, this notification will never be triggered.' => '[NESSUN TIPO DI PRODOTTO] Nessun tipo di prodotto è selezionato, questa notifica non verrà mai attivata.',
    '[NO USER GROUP] No user groups are selected, this notification will never be triggered.' => '[NESSUN GRUPPO DI UTENTI] Nessun gruppo di utenti è selezionato, questa notifica non verrà mai attivata.',
    '[NO VOLUME] No volumes are selected, this notification will never be triggered.' => '[NESSUN VOLUME] Nessun volume è selezionato, questa notifica non verrà mai attivata.',
    '[NO MEDIA] No image was attached because the {tag} tag was never invoked in the Image Attachment field.' => '[NESSUN MEDIA] Nessuna immagine è stata allegata perché il tag {tag} non è mai stato invocato nel campo Allegato immagine.',
    '[NO RECIPIENTS] The Dynamic Recipients snippet did not call setRecipients.' => '[NESSUN DESTINATARIO] Lo snippet dei destinatari dinamici non ha chiamato setRecipients.',
    '[NO RECIPIENTS] setRecipients was called with an empty value.' => '[NESSUN DESTINATARIO] setRecipients è stato chiamato con un valore vuoto.',
    '[NO RECIPIENT] No MQTT topic was specified.' => '[NESSUN DESTINATARIO] Nessun argomento MQTT specificato.',
    '[NO RECIPIENT] No Slack channel ID was specified.' => '[NESSUN DESTINATARIO] Nessun ID canale Slack specificato.',
    '[NO RECIPIENT] No ntfy topic was specified.' => '[NESSUN DESTINATARIO] Nessun argomento ntfy specificato.',
    '[NO RECIPIENT] No recipient user was specified for the announcement.' => '[NESSUN DESTINATARIO] Nessun utente destinatario specificato per l’annuncio.',
    '[NO RECIPIENT] No recipient was specified for the email.' => '[NESSUN DESTINATARIO] Nessun destinatario specificato per l’e-mail.',
    '[NO RECIPIENT] The recipient has no Pushover user key.' => '[NESSUN DESTINATARIO] Il destinatario non ha una chiave utente Pushover.',
    '[NO RECIPIENT] The recipient has no phone number.' => '[NESSUN DESTINATARIO] Il destinatario non ha un numero di telefono.',
    '[REJECTED BY DISCORD] {error}' => '[RIFIUTATO DA DISCORD] {error}',
    '[REJECTED BY FACEBOOK] {error}' => '[RIFIUTATO DA FACEBOOK] {error}',
    '[REJECTED BY INSTAGRAM] {error}' => '[RIFIUTATO DA INSTAGRAM] {error}',
    '[REJECTED BY MASTODON] {error}' => '[RIFIUTATO DA MASTODON] {error}',
    '[REJECTED BY SLACK] {error}' => '[RIFIUTATO DA SLACK] {error}',
    '[REJECTED BY X (TWITTER)] {error}' => '[RIFIUTATO DA X (TWITTER)] {error}',
    '[SEND FAILED] Authentication failed for {handle}: {reason}' => '[INVIO NON RIUSCITO] Autenticazione non riuscita per {handle}: {reason}',
    '[SEND FAILED] Authentication failed: {reason}' => '[INVIO NON RIUSCITO] Autenticazione non riuscita: {reason}',
    "[SEND FAILED] Could not send the email using Craft's native handling. Check your general email settings within Craft." => '[INVIO NON RIUSCITO] Impossibile inviare l’e-mail tramite la gestione nativa di Craft. Controlla le impostazioni e-mail generali in Craft.',
    '[SEND FAILED] HTTP {status}: {reason}' => '[INVIO NON RIUSCITO] HTTP {status}: {reason}',
    '[SEND FAILED] {error}' => '[INVIO NON RIUSCITO] {error}',
    '[SEND FAILED] {reason}' => '[INVIO NON RIUSCITO] {reason}',
    '[SKIPPED] Pushover user-key field is not configured on this notification.' => '[IGNORATO] Il campo della chiave utente Pushover non è configurato in questa notifica.',
    '[SKIPPED] Recipient "{name}" cannot access the control panel.' => '[IGNORATO] Il destinatario "{name}" non può accedere al pannello di controllo.',
    '[SKIPPED] Recipient "{name}" has no Bluesky credentials.' => '[IGNORATO] Il destinatario "{name}" non ha le credenziali Bluesky.',
    '[SKIPPED] Recipient "{name}" has no Craft user account.' => '[IGNORATO] Il destinatario "{name}" non ha un account utente Craft.',
    '[SKIPPED] Recipient "{name}" has no Discord webhook URL.' => '[IGNORATO] Il destinatario "{name}" non ha un URL webhook di Discord.',
    '[SKIPPED] Recipient "{name}" has no Facebook credentials.' => '[IGNORATO] Il destinatario "{name}" non ha le credenziali Facebook.',
    '[SKIPPED] Recipient "{name}" has no Instagram credentials.' => '[IGNORATO] Il destinatario "{name}" non ha le credenziali Instagram.',
    '[SKIPPED] Recipient "{name}" has no MQTT topic.' => '[IGNORATO] Il destinatario "{name}" non ha un argomento MQTT.',
    '[SKIPPED] Recipient "{name}" has no Mastodon credentials.' => '[IGNORATO] Il destinatario "{name}" non ha le credenziali Mastodon.',
    '[SKIPPED] Recipient "{name}" has no Slack bot token.' => '[IGNORATO] Il destinatario "{name}" non ha un token bot di Slack.',
    '[SKIPPED] Recipient "{name}" has no Slack channel ID.' => '[IGNORATO] Il destinatario "{name}" non ha un ID canale Slack.',
    '[SKIPPED] Recipient "{name}" has no X (Twitter) credentials.' => '[IGNORATO] Il destinatario "{name}" non ha le credenziali X (Twitter).',
    '[SKIPPED] Recipient "{name}" has no email address.' => '[IGNORATO] Il destinatario "{name}" non ha un indirizzo e-mail.',
    '[SKIPPED] Recipient "{name}" has no ntfy topic.' => '[IGNORATO] Il destinatario "{name}" non ha un argomento ntfy.',
    '[SKIPPED] Recipient "{name}" has no phone number.' => '[IGNORATO] Il destinatario "{name}" non ha un numero di telefono.',
    '[SKIPPED] The configured {kind} no longer exists in the plugin settings (uid: {uid}).' => '[IGNORATO] Il {kind} configurato non esiste più nelle impostazioni del plugin (uid: {uid}).',
    '[SKIPPED] Unrecognized recipient "{value}".' => '[IGNORATO] Destinatario non riconosciuto "{value}".',
    '[SKIPPED] Unrecognized recipient of type "{type}".' => '[IGNORATO] Destinatario di tipo non riconosciuto "{type}".',
    '[TOO LONG] The Discord message body exceeds the 2000-character limit.' => '[TROPPO LUNGO] Il corpo del messaggio Discord supera il limite di 2000 caratteri.',
    '[TRUNCATED] Body exceeded {max} characters.' => '[TRONCATO] Il corpo ha superato i {max} caratteri.',
    '[TRUNCATED] Caption exceeded {max} characters.' => '[TRONCATO] La didascalia ha superato i {max} caratteri.',
];
