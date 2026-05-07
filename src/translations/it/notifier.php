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
    'Notification Log'       => 'Registro delle notifiche',
    'Logs'                   => 'Registri',
    'View Notifications'     => 'Visualizza le notifiche',
    'Add a New Notification' => 'Aggiungi una nuova notifica',

    // Permissions
    'View notifications'              => 'Visualizza notifiche',
    'Save notifications'              => 'Salva notifiche',
    'Use the Dynamic Recipients type' => 'Usa il tipo Destinatari dinamici',
    'Delete notifications'            => 'Elimina notifiche',
    'View notification log'           => 'Visualizza il registro delle notifiche',
    'Delete notification log'         => 'Elimina il registro delle notifiche',

    // Notification editor: tabs
    'Meta'       => 'Meta',
    'Event'      => 'Evento',
    'Message'    => 'Messaggio',
    'Recipients' => 'Destinatari',

    // Event tab
    'Event Type'                                           => 'Tipo di evento',
    'What type of event will activate the notification?'   => 'Quale tipo di evento attiverà la notifica?',
    'Which specific event will activate the notification?' => 'Quale evento specifico attiverà la notifica?',
    'Assets Event'                                         => 'Evento risorsa',
    'Commerce Orders Event'                                => 'Evento ordine Commerce',
    'Entries Event'                                        => 'Evento voce',
    'Users Event'                                          => 'Evento utente',

    // Field and element conditions
    'Field Conditions'                                                               => 'Condizioni di campo',
    'Send the message only when the saved element matches the following conditions.' => 'Invia il messaggio solo quando l’elemento salvato soddisfa le seguenti condizioni.',
    '#{elementType} Event Filters'                                                   => 'Filtri evento #{elementType}',
    'No filters match this event.'                                                   => 'Nessun filtro corrisponde a questo evento.',
    'Determine whether each message should be sent based on specified conditions.'   => 'Determina se ogni messaggio debba essere inviato in base alle condizioni specificate.',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => 'L’elemento viene salvato per la prima volta',
    'Must be a new entry'                       => 'Deve essere una nuova voce',
    'Must be an existing entry'                 => 'Deve essere una voce esistente',
    'Can be existing or new'                    => 'Può essere esistente o nuova',

    // Filters: new elements
    'Element is new'         => 'L’elemento è nuovo',
    'New elements only'      => 'Solo nuovi elementi',
    'Existing elements only' => 'Solo elementi esistenti',

    // Filters: enabled state
    'Element is enabled'         => 'L’elemento è abilitato',
    'Must be enabled'            => 'Deve essere abilitato',
    'Must be disabled'           => 'Deve essere disabilitato',
    'Can be enabled or disabled' => 'Può essere abilitato o disabilitato',

    // Filters: drafts
    'Element is a draft'          => 'L’elemento è una bozza',
    'Must be a draft'             => 'Deve essere una bozza',
    'Must not be a draft'         => 'Non deve essere una bozza',
    'Can be a draft or non-draft' => 'Può essere bozza o non bozza',

    // Filters: provisional drafts
    'Element is a provisional draft'                => 'L’elemento è una bozza provvisoria',
    'Must be a provisional draft'                   => 'Deve essere una bozza provvisoria',
    'Must not be a provisional draft'               => 'Non deve essere una bozza provvisoria',
    'Can be a provisional draft or non-provisional' => 'Può essere provvisoria o non provvisoria',

    // Filters: revisions
    'Element is a revision'             => 'L’elemento è una revisione',
    'Must be a revision'                => 'Deve essere una revisione',
    'Must not be a revision'            => 'Non deve essere una revisione',
    'Can be a revision or non-revision' => 'Può essere revisione o non revisione',

    // Filters: duplication
    'Element is being duplicated'         => 'L’elemento è in fase di duplicazione',
    'Must be duplicating the element'     => 'Deve duplicare l’elemento',
    'Must not be duplicating the element' => 'Non deve duplicare l’elemento',

    // Filters: propagation
    'Element is being propagated'     => 'L’elemento è in fase di propagazione',
    'Element must be propagating'     => 'L’elemento deve essere in propagazione',
    'Element must not be propagating' => 'L’elemento non deve essere in propagazione',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => 'L’elemento è in fase di risalvataggio massivo',
    'Must be bulk-resaving the element'     => 'Deve risalvare l’elemento in modo massivo',
    'Must not be bulk-resaving the element' => 'Non deve risalvare l’elemento in modo massivo',

    // Filters: common output
    'Unnamed filter'                => 'Filtro senza nome',
    'Must be TRUE to send message'  => 'Deve essere TRUE per inviare il messaggio',
    'Must be FALSE to send message' => 'Deve essere FALSE per inviare il messaggio',
    'No effect'                     => 'Nessun effetto',

    // Message tab: type selector and queue
    'Message Type'                                                 => 'Tipo di messaggio',
    'What type of message will be sent?'                           => 'Quale tipo di messaggio verrà inviato?',
    'Send Message via Queue'                                       => 'Invia il messaggio tramite coda',
    'Should the message be sent via the [jobs queue]({queueUrl})?' => 'Inviare il messaggio tramite la [coda dei processi]({queueUrl})?',

    // Email message
    'Email Subject'              => 'Oggetto dell’email',
    'Email Body'                 => 'Corpo dell’email',
    "User's Email Address Field" => 'Campo indirizzo email dell’utente',

    // SMS message
    'SMS Message Body'          => 'Corpo del messaggio SMS',
    "User's Phone Number Field" => 'Campo numero di telefono dell’utente',

    // Announcement message
    'Announcement Title'   => 'Titolo dell’annuncio',
    'Announcement Message' => 'Messaggio dell’annuncio',

    // Flash message
    'Flash Message Type'                         => 'Tipo di messaggio flash',
    'Flash Message Title'                        => 'Titolo del messaggio flash',
    'Flash Message Details'                      => 'Dettagli del messaggio flash',
    'Which type of flash message should appear?' => 'Quale tipo di messaggio flash deve apparire?',

    // Trix toolbar (rich-text editing)
    'Rich Text'     => 'Testo formattato',
    'Bold'          => 'Grassetto',
    'Italic'        => 'Corsivo',
    'Underline'     => 'Sottolineato',
    'Strikethrough' => 'Barrato',
    'Bullets'       => 'Elenco puntato',
    'Numbers'       => 'Elenco numerato',
    'Heading'       => 'Titolo',
    'Code'          => 'Codice',
    'Undo'          => 'Annulla',
    'Redo'          => 'Ripristina',

    // Email body instructions (HTML)
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => 'Corpo dell’email in uscita. Puoi usare <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">variabili speciali</a>, o anche <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">saltare i destinatari</a>.',

    // Recipients tab
    'Recipients Type'                             => 'Tipo di destinatari',
    'Who will receive this message?'              => 'Chi riceverà questo messaggio?',
    'Add a message recipient'                     => 'Aggiungi un destinatario',
    'Select User(s)'                              => 'Seleziona utente/i',
    'Which users will receive the message?'       => 'Quali utenti riceveranno il messaggio?',
    'Which user groups will receive the message?' => 'Quali gruppi di utenti riceveranno il messaggio?',
    'Restricted to Admins Only?'                  => 'Riservato solo agli amministratori?',
    'Ungrouped Users'                             => 'Utenti senza gruppo',
    'Twig Snippet to Determine Recipients'        => 'Snippet Twig per determinare i destinatari',

    // Settings: Twilio
    'Twilio Account SID'                             => 'Twilio Account SID',
    'Twilio Auth Token'                              => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)'   => 'Numero di telefono Twilio (invia ogni messaggio SMS)',
    'This is being set in the config file. [{file}]' => 'Impostato nel file di configurazione. [{file}]',

    // Settings: Logging
    'Logging'                                                                                                                                         => 'Registrazione',
    'Enable Logging'                                                                                                                                  => 'Attiva la registrazione',
    'When disabled, Notifier will not write anything to the notification log.'                                                                        => 'Quando disattivata, Notifier non scriverà nulla nel registro delle notifiche.',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier mantiene un registro continuo dei messaggi inviati. Anche se non è in genere necessario, puoi limitare il numero di eventi registrati nel database.',
    'Number of log events to retain'                                                                                                                  => 'Numero di eventi del registro da conservare',
    'At most, keep this many log events. Leave blank for no limit.'                                                                                   => 'Conserva al massimo questo numero di eventi del registro. Lascia vuoto per nessun limite.',
    'Number of days to retain log events'                                                                                                             => 'Numero di giorni di conservazione degli eventi del registro',
    'At most, keep log events for this many days. Leave blank for no limit.'                                                                          => 'Conserva gli eventi del registro per questo numero di giorni al massimo. Lascia vuoto per nessun limite.',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.' => 'Invio di {messageType} a {recipient}.',
    'Log events deleted.'                   => 'Eventi del registro eliminati.',
    'notification'                          => 'notifica',

    // Errors
    'Invalid email message mode.'                                    => 'Modalità del messaggio email non valida.',
    'Dynamic recipients snippet did not call setRecipients.'         => 'Lo snippet dei destinatari dinamici non ha chiamato setRecipients.',
    'setRecipients was called with an empty value.'                  => 'setRecipients è stato chiamato con un valore vuoto.',
    'Unrecognized recipient "{value}".'                              => 'Destinatario non riconosciuto "{value}".',
    'Unrecognized recipient of type "{type}".'                       => 'Destinatario di tipo "{type}" non riconosciuto.',
    'Recipient "{name}" has no email address.'                       => 'Il destinatario "{name}" non ha un indirizzo email.',
    'Recipient "{name}" has no phone number.'                        => 'Il destinatario "{name}" non ha un numero di telefono.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Non hai il permesso di usare il tipo Destinatari dinamici.',

];
