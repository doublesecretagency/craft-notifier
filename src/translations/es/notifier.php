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
    'Add a New Notification' => 'Añadir una notificación nueva',

    // Permissions
    'View notifications'              => 'Ver notificaciones',
    'Save notifications'              => 'Guardar notificaciones',
    'Use the Dynamic Recipients type' => 'Usar el tipo de destinatarios dinámicos',
    'Test notifications'              => 'Probar notificaciones',
    'Delete notifications'            => 'Eliminar notificaciones',
    'View notification log'           => 'Ver registro de notificaciones',
    'Delete notification log'         => 'Eliminar registro de notificaciones',

    // Notification editor: tabs
    'Meta'       => 'Meta',
    'Event'      => 'Evento',
    'Message'    => 'Mensaje',
    'Recipients' => 'Destinatarios',

    // Event tab: type selector
    'Event Type'                                           => 'Tipo de evento',
    'What type of event will activate the notification?'   => '¿Qué tipo de evento activará la notificación?',
    'Which specific event will activate the notification?' => '¿Qué evento específico activará la notificación?',

    // Event tab: event types
    'Assets Event'                   => 'Evento de Assets',
    'Commerce Orders Event'          => 'Evento de pedidos de Commerce',
    'Commerce Products Event'        => 'Evento de productos de Commerce',
    'Digital Products Event'         => 'Evento de Digital Products',
    'Digital Product Licenses Event' => 'Evento de licencias de Digital Products',
    'Solspace Calendar Event'        => 'Evento de Solspace Calendar',
    'Entries Event'                  => 'Evento de entradas',
    'Users Event'                    => 'Evento de usuarios',
    'Ungrouped Users'                => 'Usuarios sin grupo',

    // Field and element conditions
    'Field Conditions'             => 'Condiciones de campo',
    'Send the message only when the saved element matches the following conditions.' => 'Enviar el mensaje solo cuando el elemento guardado cumpla las siguientes condiciones.',
    'has changed'                  => 'ha cambiado',
    '#{elementType} Event Filters' => 'Filtros de eventos para #{elementType}',
    'No filters match this event.' => 'Ningún filtro coincide con este evento.',
    'Determine whether each message should be sent based on specified conditions.' => 'Determine si cada mensaje debe enviarse según las condiciones especificadas.',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => 'El elemento se está guardando por primera vez',
    'Must be a new entry'                       => 'Debe ser una entrada nueva',
    'Must be an existing entry'                 => 'Debe ser una entrada existente',
    'Can be existing or new'                    => 'Puede ser existente o nuevo',

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
    'Can be a draft or non-draft' => 'Puede ser un borrador o no',

    // Filters: provisional drafts
    'Element is a provisional draft'                => 'El elemento es un borrador provisional',
    'Must be a provisional draft'                   => 'Debe ser un borrador provisional',
    'Must not be a provisional draft'               => 'No debe ser un borrador provisional',
    'Can be a provisional draft or non-provisional' => 'Puede ser un borrador provisional o no',

    // Filters: revisions
    'Element is a revision'             => 'El elemento es una revisión',
    'Must be a revision'                => 'Debe ser una revisión',
    'Must not be a revision'            => 'No debe ser una revisión',
    'Can be a revision or non-revision' => 'Puede ser una revisión o no',

    // Filters: duplication
    'Element is being duplicated'         => 'El elemento se está duplicando',
    'Must be duplicating the element'     => 'Debe estar duplicando el elemento',
    'Must not be duplicating the element' => 'No debe estar duplicando el elemento',

    // Filters: propagation
    'Element is being propagated'     => 'El elemento se está propagando',
    'Element must be propagating'     => 'El elemento debe estar propagándose',
    'Element must not be propagating' => 'El elemento no debe estar propagándose',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => 'El elemento se está volviendo a guardar en bloque',
    'Must be bulk-resaving the element'     => 'Debe estar volviendo a guardar el elemento en bloque',
    'Must not be bulk-resaving the element' => 'No debe estar volviendo a guardar el elemento en bloque',

    // Filters: common output
    'Unnamed filter'                => 'Filtro sin nombre',
    'Must be TRUE to send message'  => 'Debe ser TRUE para enviar el mensaje',
    'Must be FALSE to send message' => 'Debe ser FALSE para enviar el mensaje',
    'No effect'                     => 'Sin efecto',

    // Message tab: type selector and queue
    'Message Type'                       => 'Tipo de mensaje',
    'What type of message will be sent?' => '¿Qué tipo de mensaje se enviará?',
    'Send Message via Queue'             => 'Enviar el mensaje a través de la cola',
    'Should the message be sent via the [jobs queue]({queueUrl})?' => '¿Debe enviarse el mensaje a través de la [cola de trabajos]({queueUrl})?',
    'Send immediately' => 'Enviar inmediatamente',
    'Add to queue' => 'Añadir a la cola',

    // Message tab: Email fields
    "User's Email Address Field" => 'Campo de dirección de correo del usuario',
    'Email Subject'              => 'Asunto del correo',
    'Email Body'                 => 'Cuerpo del correo',

    // Message tab: SMS fields
    "User's Phone Number Field" => 'Campo de número de teléfono del usuario',
    'SMS Message Body'          => 'Cuerpo del mensaje SMS',

    // Message tab: Announcement fields
    'Announcement Title'   => 'Título del anuncio',
    'Announcement Message' => 'Mensaje del anuncio',

    // Message tab: Flash fields
    'Flash Message Type'                         => 'Tipo de mensaje flash',
    'Flash Message Title'                        => 'Título del mensaje flash',
    'Flash Message Details'                      => 'Detalles del mensaje flash',
    'Which type of flash message should appear?' => '¿Qué tipo de mensaje flash debe aparecer?',

    // Message tab: Pushover fields
    "Field containing each user's Pushover key" => 'Campo de clave de Pushover del usuario',
    'The Pushover application token is configured in [Settings → Pushover](url).' => 'El token de aplicación de Pushover se configura en [Configuración → Pushover](url).',

    // Message tab: ntfy fields
    'Priority'           => 'Prioridad',
    'Tags'               => 'Etiquetas',
    'Click URL'          => 'URL de clic',
    'Render as Markdown' => 'Renderizar como Markdown',

    // Message tab: Slack fields
    'Slack Message Body' => 'Cuerpo del mensaje de Slack',

    // Message tab: Bluesky fields
    'Post Body' => 'Cuerpo de la publicación',
    'Generate Link Preview' => 'Generar vista previa del enlace',
    "When the post body contains a URL, automatically generate a preview card with the linked page's image, title, and description." => 'Cuando el cuerpo de la publicación contiene una URL, se adjunta una tarjeta de vista previa con el título, la descripción y la imagen de la página enlazada.',
    'No card' => 'Sin tarjeta',
    'Generate preview card' => 'Generar tarjeta de vista previa',

    // Message tab: Title / Body / Trix toolbar
    'Title'         => 'Título',
    'Body'          => 'Cuerpo',
    'Rich Text'     => 'Texto enriquecido',
    'Bold'          => 'Negrita',
    'Italic'        => 'Cursiva',
    'Underline'     => 'Subrayado',
    'Strikethrough' => 'Tachado',
    'Bullets'       => 'Viñetas',
    'Numbers'       => 'Numeración',
    'Heading'       => 'Encabezado',
    'Code'          => 'Código',
    'Undo'          => 'Deshacer',
    'Redo'          => 'Rehacer',
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => 'Cuerpo del correo saliente. Puede usar <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">variables especiales</a>, o incluso <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">omitir destinatarios</a>.',

    // Recipients tab: common
    'Recipients Type'                             => 'Tipo de destinatarios',
    'Who will receive this message?'              => '¿Quién recibirá este mensaje?',
    'Add a message recipient'                     => 'Añadir un destinatario',
    'Select User(s)'                              => 'Seleccionar usuario(s)',
    'Which users will receive the message?'       => '¿Qué usuarios recibirán el mensaje?',
    'Which user groups will receive the message?' => '¿Qué grupos de usuarios recibirán el mensaje?',
    'Twig Snippet to Determine Recipients'        => 'Fragmento Twig para determinar los destinatarios',

    // Recipients tab: per-provider pickers
    'Select Slack channel(s)'                           => 'Seleccionar canal(es) de Slack',
    'Which Slack channels should receive this message?' => '¿Qué canales de Slack deben recibir este mensaje?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'No hay canales de Slack configurados. Añada uno en [Configuración → Slack]({url}).',
    'Select ntfy topic(s)'                              => 'Seleccionar tema(s) de ntfy',
    'Which ntfy topics should receive this message?'    => '¿Qué temas de ntfy deben recibir este mensaje?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'No hay temas de ntfy configurados. Añada uno en [Configuración → ntfy]({url}).',
    'Select Bluesky account(s)'                         => 'Seleccionar cuenta(s) de Bluesky',
    'Which Bluesky accounts should post this message?'  => '¿Qué cuentas de Bluesky deben publicar este mensaje?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'No hay cuentas de Bluesky configuradas. Añada una en [Configuración → Bluesky]({url}).',

    // Settings: page chrome
    'Notifier Settings' => 'Configuración de Notifier',
    'General'           => 'General',
    'Twilio'            => 'Twilio',
    'Pushover'          => 'Pushover',
    'Slack'             => 'Slack',
    'Bluesky'           => 'Bluesky',
    'ntfy'              => 'ntfy',

    // Settings: Logging
    'Logging'                             => 'Registro',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier mantiene un registro continuo de los mensajes enviados. Aunque normalmente no es necesario, puede limitar la cantidad de eventos de registro guardados en la base de datos.',
    'Enable Logging'                      => 'Habilitar registro',
    'When disabled, Notifier will not write anything to the notification log.' => 'Cuando se deshabilita, Notifier no escribirá nada en el registro de notificaciones.',
    'Number of days to retain log events' => 'Días de retención de los eventos de registro',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Conservar los eventos de registro como máximo este número de días. Dejar en blanco para no aplicar límite.',
    'Number of log events to retain'      => 'Número de eventos de registro a conservar',
    'At most, keep this many log events. Leave blank for no limit.' => 'Conservar como máximo este número de eventos de registro. Dejar en blanco para no aplicar límite.',

    // Settings: Twilio
    'Twilio API Credentials'                       => 'Credenciales de API de Twilio',
    'If using the Twilio API to send SMS messages, the following credentials are required.' => 'Si utiliza la API de Twilio para enviar mensajes SMS, se requieren las siguientes credenciales.',
    'Twilio Account SID'                           => 'Twilio Account SID',
    'Twilio Auth Token'                            => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)' => 'Número de teléfono de Twilio (envía cada SMS)',
    'SMS Testing'                                  => 'Pruebas de SMS',
    'Optional. When set, every SMS dispatched will be sent to this number instead of the resolved recipient.' => 'Opcional. Si se establece, cada SMS enviado se enviará a este número en lugar del destinatario resuelto.',
    'Test phone number'                            => 'Número de teléfono de prueba',

    // Settings: Pushover
    "[Pushover](https://pushover.net) sends push notifications to a registered user's devices. Each Craft user needs a custom field on their profile storing their Pushover user key; you select which field on each Notification's Message tab. For full setup instructions, see the [Pushover getting-started docs](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover)." => '[Pushover](https://pushover.net) envía notificaciones push a los dispositivos de un usuario registrado. Cada usuario de Craft necesita un campo personalizado en su perfil que almacene su clave de Pushover; usted selecciona qué campo en la pestaña Mensaje de cada notificación. Para instrucciones completas de configuración, consulte la [documentación de inicio de Pushover](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover).',
    'Application API Token'                                      => 'Token de API de la aplicación',
    'The 30-character app token from your Pushover application.' => 'El token de aplicación de 30 caracteres de su aplicación de Pushover.',

    // Settings: ntfy
    'ntfy.sh is a free HTTP-based push notification service. Subscribers receive messages on the ntfy app, web, or any compatible client by joining a topic.' => 'ntfy.sh es un servicio gratuito de notificaciones push basado en HTTP. Los suscriptores reciben mensajes en la aplicación ntfy, en la web o en cualquier cliente compatible al unirse a un tema.',
    'Server URL'   => 'URL del servidor',
    'Defaults to https://ntfy.sh. Point at a self-hosted ntfy instance if applicable.' => 'Por defecto https://ntfy.sh. Apunte a una instancia ntfy autoalojada si corresponde.',
    'Access token' => 'Token de acceso',
    'Optional. Required for protected topics or self-hosted instances with auth.' => 'Opcional. Necesario para temas protegidos o instancias autoalojadas con autenticación.',
    'ntfy Topics'  => 'Temas de ntfy',
    'Named list of ntfy topics. Each topic becomes selectable on the notification edit screen.' => 'Lista con nombre de temas de ntfy. Cada tema se podrá seleccionar en la pantalla de edición de notificaciones.',
    'Topics'       => 'Temas',
    'Add one row per topic name. Use the **Test** button to send a quick test message to the topic.' => 'Añada una fila por nombre de tema. Use el botón **Test** para enviar un mensaje de prueba rápido al tema.',
    'Topic'        => 'Tema',
    'Add a topic'  => 'Añadir un tema',
    'Save first to persist a row, then click its **Test** button to fire a sanity check against ntfy.' => 'Guarde primero para conservar una fila, luego haga clic en su botón **Test** para lanzar una comprobación rápida contra ntfy.',

    // Settings: Slack
    'Slack Channels' => 'Canales de Slack',
    'Channels'       => 'Canales',
    'Each Slack channel needs its own Incoming Webhook URL. Use the **Test** button to fire a quick sanity check after saving.' => 'Cada canal de Slack necesita su propia URL de Incoming Webhook. Use el botón **Test** para realizar una comprobación rápida tras guardar.',
    'Webhook URL'    => 'URL del webhook',
    'Add a channel'  => 'Añadir un canal',
    'Save first to persist a row, then click its **Test** button to fire a sanity check against Slack.' => 'Guarde primero para conservar una fila, luego haga clic en su botón **Test** para lanzar una comprobación rápida contra Slack.',

    // Settings: Bluesky
    "[Bluesky](https://bsky.app) posts publish to the configured account's feed via the ATProto API. App passwords are generated at [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). An app password is a secret, so store it in a `.env` variable and reference that variable (e.g. `\$BLUESKY_APP_PASSWORD`) rather than pasting the password directly." => 'Las publicaciones de [Bluesky](https://bsky.app) se publican en el feed de la cuenta configurada a través de la API de ATProto. Las contraseñas de aplicación se generan en [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). Una contraseña de aplicación es un secreto, así que guárdela en una variable `.env` y haga referencia a esa variable (p. ej. `$BLUESKY_APP_PASSWORD`) en lugar de pegar la contraseña directamente.',
    'PDS URL'          => 'URL del PDS',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'Por defecto https://bsky.social. Apunte a un PDS personalizado si su instalación está federada.',
    'Bluesky Accounts' => 'Cuentas de Bluesky',
    'Named list of Bluesky accounts. Each account becomes selectable on the notification edit screen.' => 'Lista con nombre de cuentas de Bluesky. Cada cuenta se podrá seleccionar en la pantalla de edición de notificaciones.',
    'Accounts'         => 'Cuentas',
    'Add one row per Bluesky account. Use **Test** to verify the credentials authenticate.' => 'Añada una fila por cuenta de Bluesky. Use **Test** para verificar que las credenciales se autentican.',
    'Label'            => 'Etiqueta',
    'Handle'           => 'Identificador',
    'App password'     => 'Contraseña de aplicación',
    'Add an account'   => 'Añadir una cuenta',
    'Save first to persist a row, then click its **Test** button to verify the credentials authenticate.' => 'Guarde primero para conservar una fila, luego haga clic en su botón **Test** para verificar que las credenciales se autentican.',

    // Test notification (UI)
    'Send a test message'           => 'Enviar un mensaje de prueba',
    'Are you certain you want to send a test notification?\\n\\nThe configured message will be sent to the configured recipient(s).' => '¿Está seguro de que desea enviar una notificación de prueba?\\n\\nEl mensaje configurado se enviará a los destinatarios configurados.',
    'Test'                          => 'Probar',
    'Test notification dispatched.' => 'Notificación de prueba enviada.',
    'No messages were dispatched. Check the recipient configuration.' => 'No se enviaron mensajes. Compruebe la configuración de los destinatarios.',

    // Settings: save / test action responses
    "Couldn't save settings."                 => 'No se pudo guardar la configuración.',
    'Settings saved.'                         => 'Configuración guardada.',
    'Topic is empty.'                         => 'El tema está vacío.',
    'Server URL is not configured.'           => 'La URL del servidor no está configurada.',
    'Test message from Notifier.'             => 'Mensaje de prueba de Notifier.',
    'HTTP {status}'                           => 'HTTP {status}',
    'Test message sent successfully.'         => 'Mensaje de prueba enviado correctamente.',
    'HTTP {status}: {body}'                   => 'HTTP {status}: {body}',
    'Handle and app password are required.'   => 'Se requieren el identificador y la contraseña de aplicación.',
    'Authentication failed.'                  => 'Autenticación fallida.',
    'Successfully authenticated. No messages were posted.' => 'Autenticado correctamente. No se publicó ningún mensaje.',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.'          => 'Enviando {messageType} a {recipient}.',
    'Adding message to queue.'                       => 'Añadiendo mensaje a la cola.',
    'Sending message immediately (bypassing queue).' => 'Enviando el mensaje inmediatamente (omitiendo la cola).',
    'Log events deleted.'                            => 'Eventos de registro eliminados.',
    'notification'                                   => 'notificación',

    // Outbound: Email log messages
    'Unable to send email, no recipient specified.'     => 'No se puede enviar el correo: no se ha especificado un destinatario.',
    'Unable to send email, the message body was empty.' => 'No se puede enviar el correo: el cuerpo del mensaje estaba vacío.',
    "Unable to send the email using Craft's native email handling." => 'No se puede enviar el correo mediante el gestor nativo de Craft.',
    'Check your general email settings within Craft.'   => 'Compruebe la configuración general de correo en Craft.',
    'Successfully sent email message!'                  => '¡Correo enviado correctamente!',

    // Outbound: SMS log messages
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[Credenciales de Twilio no válidas.]({url}) Falta {missing}.',
    'Unable to send SMS, no Twilio phone number exists.'      => 'No se puede enviar el SMS: no hay número de teléfono de Twilio.',
    'Unable to send SMS, no recipient phone number exists.'   => 'No se puede enviar el SMS: no hay número de teléfono del destinatario.',
    'Unable to send SMS, recipient phone number is invalid.'  => 'No se puede enviar el SMS: el número del destinatario no es válido.',
    'Successfully sent SMS message!'                          => '¡SMS enviado correctamente!',

    // Outbound: Announcement log messages
    'Unable to post announcement, no recipient userId specified.' => 'No se puede publicar el anuncio: no se especificó el userId del destinatario.',
    'Successfully posted announcement!' => '¡Anuncio publicado correctamente!',

    // Outbound: Flash log messages
    'Unable to send the flash message, invalid flash type.' => 'No se puede enviar el mensaje flash: tipo de flash no válido.',
    'Successfully sent flash message!'                      => '¡Mensaje flash enviado correctamente!',

    // Outbound: Pushover log messages
    '[Invalid Pushover credentials.]({url}) Missing app token.'  => '[Credenciales de Pushover no válidas.]({url}) Falta el token de la aplicación.',
    'Unable to send Pushover message, no user key on recipient.' => 'No se puede enviar el mensaje Pushover: el destinatario no tiene clave de usuario.',
    'Pushover POST failed: {reason}'                             => 'Falló el POST de Pushover: {reason}',
    'Successfully sent Pushover message!'                        => '¡Mensaje de Pushover enviado correctamente!',

    // Outbound: ntfy log messages
    'Unable to send ntfy message, no server URL configured.' => 'No se puede enviar el mensaje ntfy: no se ha configurado la URL del servidor.',
    'Unable to send ntfy message, no topic specified.'       => 'No se puede enviar el mensaje ntfy: no se especificó el tema.',
    'ntfy POST failed with HTTP {status}: {reason}'          => 'Falló el POST de ntfy con HTTP {status}: {reason}',
    'ntfy POST failed: {reason}'                             => 'Falló el POST de ntfy: {reason}',
    'Successfully sent ntfy message to topic "{topic}".'     => 'Mensaje ntfy enviado correctamente al tema "{topic}".',

    // Outbound: Slack log messages
    'Unable to send Slack message, no webhook URL.' => 'No se puede enviar el mensaje de Slack: no hay URL de webhook.',
    'Unable to send Slack message, webhook URL is not valid.' => 'No se puede enviar el mensaje de Slack: la URL del webhook no es válida.',
    'Unable to send Slack message, body is empty.'  => 'No se puede enviar el mensaje de Slack: el cuerpo está vacío.',
    'Slack POST failed (HTTP {status}): {reason}'   => 'Falló el POST de Slack (HTTP {status}): {reason}',
    'Slack POST failed: {reason}'                   => 'Falló el POST de Slack: {reason}',
    'Successfully sent Slack message to "{label}".' => 'Mensaje de Slack enviado correctamente a "{label}".',

    // Outbound: Bluesky log messages
    'Unable to send Bluesky post, recipient is missing credentials.' => 'No se puede enviar la publicación de Bluesky: faltan credenciales del destinatario.',
    'Body exceeded {max} characters, truncated.'          => 'El cuerpo superó los {max} caracteres y se truncó.',
    'Successfully posted to Bluesky as "{label}".'        => 'Publicado correctamente en Bluesky como "{label}".',
    'Bluesky auth failed for {handle}: {reason}'          => 'Falló la autenticación de Bluesky para {handle}: {reason}',
    'Bluesky auth failed: {reason}'                       => 'Falló la autenticación de Bluesky: {reason}',
    'Bluesky post failed: {reason}'                       => 'Falló la publicación en Bluesky: {reason}',
    'Bluesky link preview skipped: {reason}'              => 'Vista previa del enlace de Bluesky omitida: {reason}',

    // Recipient-strategy warnings
    'Recipient "{name}" has no email address.'       => 'El destinatario "{name}" no tiene dirección de correo.',
    'Recipient "{name}" has no phone number.'        => 'El destinatario "{name}" no tiene número de teléfono.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => 'El destinatario "{name}" no tiene un usuario asociado; no se puede enviar el anuncio.',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => 'El destinatario "{name}" no puede acceder al panel de control; no se puede enviar el anuncio.',
    'Pushover user-key field is not configured on this notification.' => 'El campo de clave de usuario de Pushover no está configurado en esta notificación.',
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => 'El destinatario "{name}" no tiene un usuario asociado; no se puede enviar el mensaje Pushover.',
    '[SKIPPED] User "{name}" has no Pushover key.'   => '[OMITIDO] El usuario "{name}" no tiene clave de Pushover.',
    'Recipient "{name}" has no ntfy topic.'          => 'El destinatario "{name}" no tiene tema de ntfy.',
    'Recipient "{name}" has no Slack webhook URL.'   => 'El destinatario "{name}" no tiene URL de webhook de Slack.',
    'Recipient "{name}" has no Bluesky credentials.' => 'El destinatario "{name}" no tiene credenciales de Bluesky.',

    // Errors / exceptions
    'Invalid element event: {class}'                         => 'Evento de elemento no válido: {class}',
    'Invalid notification ID: {id}'                          => 'ID de notificación no válido: {id}',
    'Invalid email message mode.'                            => 'Modo de mensaje de correo no válido.',
    'You do not have permission to use the Dynamic Recipients type.' => 'No tiene permiso para usar el tipo Destinatarios dinámicos.',
    'Dynamic recipients snippet did not call setRecipients.' => 'El fragmento de destinatarios dinámicos no llamó a setRecipients.',
    'setRecipients was called with an empty value.'          => 'Se llamó a setRecipients con un valor vacío.',
    'Unrecognized recipient of type "{type}".'               => 'Destinatario de tipo "{type}" no reconocido.',
    'Unrecognized recipient "{value}".'                      => 'Destinatario "{value}" no reconocido.',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => 'El {kind} configurado ya no existe en la configuración del plugin (uid: {uid}).',
    'Invalid settings section: {section}'                    => 'Sección de configuración no válida: {section}',
    'User not authorized to save this notification.'         => 'El usuario no está autorizado para guardar esta notificación.',
    'User not authorized to view this notification.'         => 'El usuario no está autorizado para ver esta notificación.',
    'User not authorized to delete this notification.'       => 'El usuario no está autorizado para eliminar esta notificación.',
    'Notification not found'                                 => 'Notificación no encontrada',

    // Misc config-file note
    'This is being set in the config file. [{file}]' => 'Esto se establece en el archivo de configuración. [{file}]',

    // Slack, ntfy, and Bluesky message types
    "Add the Bluesky accounts you'd like to post from. Each account becomes available as a recipient on the **Recipients** tab when configuring a notification." => 'Añada las cuentas de Bluesky desde las que quiera publicar. Cada cuenta queda disponible como destinatario en la pestaña **Destinatarios** al configurar una notificación.',
    "Click any row's **Test** button to confirm the account authenticates." => 'Haga clic en el botón **Test** de cualquier fila para confirmar que la cuenta se autentica.',
    "Add an [Incoming Webhook](https://api.slack.com/messaging/webhooks) for each Slack channel you'd like to post into. Each webhook becomes available as a recipient on the **Recipients** tab when configuring a notification. A webhook URL is a secret, so store it in a `.env` variable and reference that variable (e.g. `\$SLACK_WEBHOOK_URL`) rather than pasting the URL directly." => 'Añada un [Incoming Webhook](https://api.slack.com/messaging/webhooks) por cada canal de Slack en el que quiera publicar. Cada webhook queda disponible como destinatario en la pestaña **Destinatarios** al configurar una notificación. La URL de un webhook es un secreto, así que guárdela en una variable `.env` y haga referencia a esa variable (p. ej. `$SLACK_WEBHOOK_URL`) en lugar de pegar la URL directamente.',
    "Click any row's **Test** button to send a quick test message to that channel." => 'Haga clic en el botón **Test** de cualquier fila para enviar un mensaje de prueba rápido a ese canal.',
    "Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`." => 'Opcional, apunte a una instancia ntfy autoalojada (si corresponde). Por defecto `https://ntfy.sh`.',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Opcional, necesario para temas protegidos o instancias autoalojadas con autenticación.',
    "Add the ntfy topics you'd like to send messages to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification." => 'Añada los temas de ntfy a los que quiera enviar mensajes. Cada tema queda disponible como destinatario en la pestaña **Destinatarios** al configurar una notificación.',
    "Click any row's **Test** button to send a quick test message to that topic." => 'Haga clic en el botón **Test** de cualquier fila para enviar un mensaje de prueba rápido a ese tema.',
    'Enable Markdown' => 'Habilitar Markdown',
    'Link URL' => 'URL del enlace',
    'Not a valid Webhook URL. Must start with https://hooks.slack.com/services/' => 'No es una URL de webhook válida. Debe comenzar con https://hooks.slack.com/services/',
];
