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
    'Notifications'          => 'Notificaciones',
    'Notification'           => 'Notificación',
    'All notifications'      => 'Todas las notificaciones',
    'Notification Log'       => 'Registro de notificaciones',
    'Logs'                   => 'Registros',
    'View Notifications'     => 'Ver notificaciones',
    'Add a New Notification' => 'Añadir una nueva notificación',

    // Permissions
    'View notifications'              => 'Ver notificaciones',
    'Save notifications'              => 'Guardar notificaciones',
    'Use the Dynamic Recipients type' => 'Usar el tipo Destinatarios dinámicos',
    'Test notifications'              => 'Probar notificaciones',
    'Delete notifications'            => 'Eliminar notificaciones',
    'View notification log'           => 'Ver el registro de notificaciones',
    'Delete notification log'         => 'Eliminar el registro de notificaciones',

    // Notification editor: tabs
    'Meta'       => 'Meta',
    'Event'      => 'Evento',
    'Message'    => 'Mensaje',
    'Recipients' => 'Destinatarios',

    // Event tab
    'Event Type'                                           => 'Tipo de evento',
    'What type of event will activate the notification?'   => '¿Qué tipo de evento activará la notificación?',
    'Which specific event will activate the notification?' => '¿Qué evento específico activará la notificación?',
    'Assets Event'                                         => 'Evento de recursos',
    'Commerce Orders Event'                                => 'Evento de pedidos de Commerce',
    'Entries Event'                                        => 'Evento de entradas',
    'Users Event'                                          => 'Evento de usuarios',

    // Field and element conditions
    'Field Conditions'                                                               => 'Condiciones de campo',
    'Send the message only when the saved element matches the following conditions.' => 'Enviar el mensaje solo cuando el elemento guardado cumpla las siguientes condiciones.',
    'has changed'                                                                    => 'ha cambiado',
    '#{elementType} Event Filters'                                                   => 'Filtros de evento de #{elementType}',
    'No filters match this event.'                                                   => 'Ningún filtro coincide con este evento.',
    'Determine whether each message should be sent based on specified conditions.'   => 'Determinar si cada mensaje debe enviarse según las condiciones especificadas.',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => 'El elemento se está guardando por primera vez',
    'Must be a new entry'                       => 'Debe ser una nueva entrada',
    'Must be an existing entry'                 => 'Debe ser una entrada existente',
    'Can be existing or new'                    => 'Puede ser existente o nueva',

    // Filters: new elements
    'Element is new'         => 'El elemento es nuevo',
    'New elements only'      => 'Solo elementos nuevos',
    'Existing elements only' => 'Solo elementos existentes',

    // Filters: enabled state
    'Element is enabled'         => 'El elemento está habilitado',
    'Must be enabled'            => 'Debe estar habilitado',
    'Must be disabled'           => 'Debe estar deshabilitado',
    'Can be enabled or disabled' => 'Puede estar habilitado o deshabilitado',

    // Filters: drafts
    'Element is a draft'          => 'El elemento es un borrador',
    'Must be a draft'             => 'Debe ser un borrador',
    'Must not be a draft'         => 'No debe ser un borrador',
    'Can be a draft or non-draft' => 'Puede ser borrador o no',

    // Filters: provisional drafts
    'Element is a provisional draft'                => 'El elemento es un borrador provisional',
    'Must be a provisional draft'                   => 'Debe ser un borrador provisional',
    'Must not be a provisional draft'               => 'No debe ser un borrador provisional',
    'Can be a provisional draft or non-provisional' => 'Puede ser provisional o no provisional',

    // Filters: revisions
    'Element is a revision'             => 'El elemento es una revisión',
    'Must be a revision'                => 'Debe ser una revisión',
    'Must not be a revision'            => 'No debe ser una revisión',
    'Can be a revision or non-revision' => 'Puede ser revisión o no',

    // Filters: duplication
    'Element is being duplicated'         => 'El elemento se está duplicando',
    'Must be duplicating the element'     => 'Debe estar duplicando el elemento',
    'Must not be duplicating the element' => 'No debe estar duplicando el elemento',

    // Filters: propagation
    'Element is being propagated'     => 'El elemento se está propagando',
    'Element must be propagating'     => 'El elemento debe estar propagándose',
    'Element must not be propagating' => 'El elemento no debe estar propagándose',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => 'El elemento se está reguardando en lote',
    'Must be bulk-resaving the element'     => 'Debe estar reguardando el elemento en lote',
    'Must not be bulk-resaving the element' => 'No debe estar reguardando el elemento en lote',

    // Filters: common output
    'Unnamed filter'                => 'Filtro sin nombre',
    'Must be TRUE to send message'  => 'Debe ser TRUE para enviar el mensaje',
    'Must be FALSE to send message' => 'Debe ser FALSE para enviar el mensaje',
    'No effect'                     => 'Sin efecto',

    // Message tab: type selector and queue
    'Message Type'                                                 => 'Tipo de mensaje',
    'What type of message will be sent?'                           => '¿Qué tipo de mensaje se enviará?',
    'Send Message via Queue'                                       => 'Enviar mensaje mediante la cola',
    'Should the message be sent via the [jobs queue]({queueUrl})?' => '¿Debe enviarse el mensaje mediante la [cola de tareas]({queueUrl})?',

    // Email message
    'Email Subject'              => 'Asunto del correo',
    'Email Body'                 => 'Cuerpo del correo',
    "User's Email Address Field" => 'Campo de dirección de correo del usuario',

    // SMS message
    'SMS Message Body'          => 'Cuerpo del mensaje SMS',
    "User's Phone Number Field" => 'Campo de número de teléfono del usuario',

    // Announcement message
    'Announcement Title'   => 'Título del anuncio',
    'Announcement Message' => 'Mensaje del anuncio',

    // Flash message
    'Flash Message Type'                         => 'Tipo de mensaje flash',
    'Flash Message Title'                        => 'Título del mensaje flash',
    'Flash Message Details'                      => 'Detalles del mensaje flash',
    'Which type of flash message should appear?' => '¿Qué tipo de mensaje flash debe aparecer?',

    // Trix toolbar (rich-text editing)
    'Rich Text'     => 'Texto enriquecido',
    'Bold'          => 'Negrita',
    'Italic'        => 'Cursiva',
    'Underline'     => 'Subrayado',
    'Strikethrough' => 'Tachado',
    'Bullets'       => 'Viñetas',
    'Numbers'       => 'Números',
    'Heading'       => 'Encabezado',
    'Code'          => 'Código',
    'Undo'          => 'Deshacer',
    'Redo'          => 'Rehacer',

    // Email body instructions (HTML)
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => 'Cuerpo del correo saliente. Puede usar <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">variables especiales</a>, o incluso <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">omitir destinatarios</a>.',

    // Recipients tab
    'Recipients Type'                             => 'Tipo de destinatarios',
    'Who will receive this message?'              => '¿Quién recibirá este mensaje?',
    'Add a message recipient'                     => 'Añadir un destinatario del mensaje',
    'Select User(s)'                              => 'Seleccionar usuario(s)',
    'Which users will receive the message?'       => '¿Qué usuarios recibirán el mensaje?',
    'Which user groups will receive the message?' => '¿Qué grupos de usuarios recibirán el mensaje?',
    'Ungrouped Users'                             => 'Usuarios sin grupo',
    'Twig Snippet to Determine Recipients'        => 'Fragmento de Twig para determinar destinatarios',

    // Settings: Twilio
    'Twilio Account SID'                             => 'Twilio Account SID',
    'Twilio Auth Token'                              => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)'   => 'Número de teléfono de Twilio (envía cada mensaje SMS)',
    'This is being set in the config file. [{file}]' => 'Esto se está definiendo en el archivo de configuración. [{file}]',

    // Settings: Logging
    'Logging'                                                                                                                                         => 'Registro',
    'Enable Logging'                                                                                                                                  => 'Activar el registro',
    'When disabled, Notifier will not write anything to the notification log.'                                                                        => 'Cuando está desactivado, Notifier no escribirá nada en el registro de notificaciones.',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier mantiene un registro continuo de los mensajes enviados. Aunque normalmente no es necesario, puede limitar la cantidad de eventos registrados en la base de datos.',
    'Number of log events to retain'                                                                                                                  => 'Número de eventos de registro a conservar',
    'At most, keep this many log events. Leave blank for no limit.'                                                                                   => 'Como máximo, conservar esta cantidad de eventos de registro. Dejar en blanco para no aplicar límite.',
    'Number of days to retain log events'                                                                                                             => 'Número de días para conservar los eventos de registro',
    'At most, keep log events for this many days. Leave blank for no limit.'                                                                          => 'Como máximo, conservar los eventos de registro durante esta cantidad de días. Dejar en blanco para no aplicar límite.',

    // Test notification
    'Send a test message'                                                                                                          => 'Enviar un mensaje de prueba',
    'Are you certain you want to send a test notification?\n\nThe configured message will be sent to the configured recipient(s).' => '¿Está seguro de que desea enviar una notificación de prueba?\n\nEl mensaje configurado se enviará a los destinatarios configurados.',
    'Test'                                                                                                                         => 'Prueba',
    'Test notification dispatched.'                                                                                                => 'Notificación de prueba enviada.',
    'No messages were dispatched. Check the recipient configuration.'                                                              => 'No se envió ningún mensaje. Compruebe la configuración de destinatarios.',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.' => 'Enviando {messageType} a {recipient}.',
    'Log events deleted.'                   => 'Eventos de registro eliminados.',
    'notification'                          => 'notificación',

    // Errors
    'Invalid email message mode.'                                    => 'Modo de mensaje de correo no válido.',
    'Dynamic recipients snippet did not call setRecipients.'         => 'El fragmento de destinatarios dinámicos no llamó a setRecipients.',
    'setRecipients was called with an empty value.'                  => 'setRecipients se llamó con un valor vacío.',
    'Unrecognized recipient "{value}".'                              => 'Destinatario no reconocido "{value}".',
    'Unrecognized recipient of type "{type}".'                       => 'Destinatario de tipo "{type}" no reconocido.',
    'Recipient "{name}" has no email address.'                       => 'El destinatario "{name}" no tiene dirección de correo electrónico.',
    'Recipient "{name}" has no phone number.'                        => 'El destinatario "{name}" no tiene número de teléfono.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => 'El destinatario "{name}" no tiene un usuario asociado; no se puede enviar el anuncio.',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => 'El destinatario "{name}" no puede acceder al panel de control; no se puede enviar el anuncio.',
    'You do not have permission to use the Dynamic Recipients type.' => 'No tiene permiso para usar el tipo Destinatarios dinámicos.',

];
