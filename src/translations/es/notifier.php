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
    'Notifications' => 'Notificaciones',
    'Notification' => 'Notificación',
    'All notifications' => 'Todas las notificaciones',
    'Notification Log' => 'Registro de notificaciones',
    'Logs' => 'Registros',
    'View Notifications' => 'Ver notificaciones',
    'Add a New Notification' => 'Añadir una notificación nueva',
    'notification' => 'notificación',

    // Permissions
    'View notifications' => 'Ver notificaciones',
    'Save notifications' => 'Guardar notificaciones',
    'Use the Dynamic Recipients type' => 'Usar el tipo de destinatarios dinámicos',
    'Use the Dynamic Data type' => 'Usar el tipo de datos dinámicos',
    'Test notifications' => 'Probar notificaciones',
    'Send manual notifications' => 'Enviar notificaciones manuales',
    'Delete notifications' => 'Eliminar notificaciones',
    'View notification log' => 'Ver registro de notificaciones',
    'Delete notification log' => 'Eliminar registro de notificaciones',

    // ========================================================
    // NOTIFICATION EDITOR
    // ========================================================

    // Editor: tabs
    'Meta' => 'Meta',
    'Event' => 'Evento',
    'Message' => 'Mensaje',
    'Recipients' => 'Destinatarios',

    // Event tab: type selector
    'Event Type' => 'Tipo de evento',
    'What type of event will activate the notification?' => '¿Qué tipo de evento activará la notificación?',
    'Which specific event will activate the notification?' => '¿Qué evento específico activará la notificación?',

    // Event tab: event types
    'Assets Event' => 'Evento de Assets',
    'Commerce Orders Event' => 'Evento de pedidos de Commerce',
    'Commerce Products Event' => 'Evento de productos de Commerce',
    'Digital Products Event' => 'Evento de Digital Products',
    'Digital Product Licenses Event' => 'Evento de licencias de Digital Products',
    'Solspace Calendar Event' => 'Evento de Solspace Calendar',
    'Entries Event' => 'Evento de entradas',
    'Users Event' => 'Evento de usuarios',
    'Ungrouped Users' => 'Usuarios sin grupo',

    // Event tab: Feed
    'Feed URL' => 'URL del feed',
    'The URL of the RSS, Atom, or JSON feed to watch.' => 'La URL del feed RSS, Atom o JSON a monitorizar.',

    // Event tab: field conditions
    'Field Conditions' => 'Condiciones de campo',
    'Send the message only when the saved element matches the following conditions.' => 'Enviar el mensaje solo cuando el elemento guardado cumpla las siguientes condiciones.',
    'has changed' => 'ha cambiado',

    // Event tab: element filters (panel chrome + common output)
    '#{elementType} Event Filters' => 'Filtros de eventos para #{elementType}',
    'No filters match this event.' => 'Ningún filtro coincide con este evento.',
    'Determine whether each message should be sent based on specified conditions.' => 'Determine si cada mensaje debe enviarse según las condiciones especificadas.',
    'Unnamed filter' => 'Filtro sin nombre',
    'Must be TRUE to send message' => 'Debe ser TRUE para enviar el mensaje',
    'Must be FALSE to send message' => 'Debe ser FALSE para enviar el mensaje',
    'No effect' => 'Sin efecto',

    // Event tab: element filter rules
    'Element is being saved for the first time' => 'El elemento se está guardando por primera vez',
    'Must be a new entry' => 'Debe ser una entrada nueva',
    'Must be an existing entry' => 'Debe ser una entrada existente',
    'Can be existing or new' => 'Puede ser existente o nuevo',
    'Element is new' => 'El elemento es nuevo',
    'New elements only' => 'Solo elementos nuevos',
    'Existing elements only' => 'Solo elementos existentes',
    'Element is enabled' => 'El elemento está habilitado',
    'Must be enabled' => 'Debe estar habilitado',
    'Must be disabled' => 'Debe estar deshabilitado',
    'Can be enabled or disabled' => 'Puede estar habilitado o deshabilitado',
    'Element is a draft' => 'El elemento es un borrador',
    'Must be a draft' => 'Debe ser un borrador',
    'Must not be a draft' => 'No debe ser un borrador',
    'Can be a draft or non-draft' => 'Puede ser un borrador o no',
    'Element is a provisional draft' => 'El elemento es un borrador provisional',
    'Must be a provisional draft' => 'Debe ser un borrador provisional',
    'Must not be a provisional draft' => 'No debe ser un borrador provisional',
    'Can be a provisional draft or non-provisional' => 'Puede ser un borrador provisional o no',
    'Element is a revision' => 'El elemento es una revisión',
    'Must be a revision' => 'Debe ser una revisión',
    'Must not be a revision' => 'No debe ser una revisión',
    'Can be a revision or non-revision' => 'Puede ser una revisión o no',
    'Element is being duplicated' => 'El elemento se está duplicando',
    'Must be duplicating the element' => 'Debe estar duplicando el elemento',
    'Must not be duplicating the element' => 'No debe estar duplicando el elemento',
    'Element is being propagated' => 'El elemento se está propagando',
    'Element must be propagating' => 'El elemento debe estar propagándose',
    'Element must not be propagating' => 'El elemento no debe estar propagándose',
    'Element is being bulk-resaved' => 'El elemento se está volviendo a guardar en bloque',
    'Must be bulk-resaving the element' => 'Debe estar volviendo a guardar el elemento en bloque',
    'Must not be bulk-resaving the element' => 'No debe estar volviendo a guardar el elemento en bloque',

    // Event tab: date trigger
    'On' => 'En',
    'days before' => 'días antes',
    'days after' => 'días después',
    'Relevant Date' => 'Fecha relevante',
    'Send the notification relative to a chosen date.' => 'Envía la notificación en relación con una fecha elegida.',

    // Event tab: recurring schedule
    'Every' => 'Cada',
    'on' => 'el',
    'on day' => 'el día',
    'at' => 'a las',
    'Starting on' => 'A partir del',
    'Day' => 'Día',
    'Date' => 'Fecha',
    'Time' => 'Hora',
    'day(s)' => 'día(s)',
    'week(s)' => 'semana(s)',
    'month(s)' => 'mes(es)',
    'year(s)' => 'año(s)',
    'day' => 'día',
    'days' => 'días',
    'week' => 'semana',
    'weeks' => 'semanas',
    'month' => 'mes',
    'months' => 'meses',
    'year' => 'año',
    'years' => 'años',
    'Manual only' => 'Solo manual',
    'Scheduled sending' => 'Envío programado',
    'Generate report on a recurring schedule' => 'Generar informe según una programación periódica',
    'Generate report on demand' => 'Generar informe bajo demanda',
    'Send on a Recurring Schedule' => 'Enviar según una programación periódica',
    'Configure Recurring Schedule' => 'Configurar programación periódica',
    'System timezone set to {timezone}' => 'Zona horaria del sistema configurada en {timezone}',
    'Notifications will be sent on the following schedule...' => 'Las notificaciones se enviarán según la siguiente programación...',
    '... and every {cadence} after that.' => '... y cada {cadence} a partir de entonces.',
    'On what recurring schedule should the notification be sent?' => '¿Con qué programación periódica debe enviarse la notificación?',
    'Whether the message should be sent on a schedule, or only triggered manually.' => 'Si el mensaje debe enviarse según una programación o solo activarse manualmente.',
    'The message can always be sent using the "Send system snapshot" button above.' => 'El mensaje siempre puede enviarse con el botón "Enviar instantánea del sistema" de arriba.',
    'The message can always be sent using the "Send data report" button above.' => 'El mensaje siempre puede enviarse con el botón "Enviar informe de datos" de arriba.',

    // Event tab: Dynamic Data snippet field
    'Twig Snippet to Determine Data' => 'Fragmento Twig para determinar los datos',
    'Enter a custom Twig snippet to [determine which data will be included]({url}).' => 'Introduzca un fragmento de Twig personalizado para [determinar qué datos se incluirán]({url}).',
    'The snippet **must** include a `{% setData %}` tag.' => 'El fragmento **debe** incluir una etiqueta `{% setData %}`.',
    'You do not have permission to edit dynamic data.' => 'No tienes permiso para editar datos dinámicos.',

    // Event tab: manual trigger
    'Trigger Label' => 'Etiqueta del activador',
    'An element action label (helps to differentiate multiple triggers).' => 'Una etiqueta de acción de elemento (ayuda a diferenciar varios activadores).',
    'Send Notification' => 'Enviar notificación',

    // Message tab: type selector
    'Message Type' => 'Tipo de mensaje',
    'What type of message will be sent?' => '¿Qué tipo de mensaje se enviará?',
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are also supported.' => '[Plantillas]({templatingUrl}) y [variables especiales]({variablesUrl}) también son compatibles.',

    // Details sidebar: queue
    'Use Queue' => 'Usar cola',
    'Immediate' => 'Inmediato',
    'Queue' => 'Cola',
    'jobs queue' => 'cola de tareas',
    'Whether the message will be sent immediately, or added to the {link}.' => 'Si el mensaje se enviará de inmediato o se añadirá a la {link}.',
    'Flash messages never use the queue.' => 'Los mensajes flash nunca usan la cola.',
    'Announcements always use the queue.' => 'Los anuncios siempre usan la cola.',

    // Message tab: Email
    "User's Email Address Field" => 'Campo de dirección de correo del usuario',
    'Select which User field contains the recipient\'s email address.' => 'Seleccione el campo de usuario que contiene la dirección de correo electrónico del destinatario.',
    'Email Subject' => 'Asunto del correo',
    'Subject line of the email.' => 'Línea de asunto del correo.',
    'Dynamic Subject Line' => 'Línea de asunto dinámica',
    'Email Body' => 'Cuerpo del correo',
    'Body of the email. Supports HTML.' => 'Cuerpo del correo. Compatible con HTML.',

    // Message tab: rich-text (Trix) toolbar
    'Rich Text' => 'Texto enriquecido',
    'Bold' => 'Negrita',
    'Italic' => 'Cursiva',
    'Underline' => 'Subrayado',
    'Strikethrough' => 'Tachado',
    'Bullets' => 'Viñetas',
    'Numbers' => 'Numeración',
    'Heading' => 'Encabezado',
    'Code' => 'Código',
    'Undo' => 'Deshacer',
    'Redo' => 'Rehacer',

    // Message tab: SMS
    "User's Phone Number Field" => 'Campo de número de teléfono del usuario',
    'Select which User field contains the recipient\'s phone number.' => 'Seleccione el campo de usuario que contiene el número de teléfono del destinatario.',
    'SMS Message Body' => 'Cuerpo del mensaje SMS',
    'Body of the SMS (text message). Plain text only.' => 'Cuerpo del SMS (mensaje de texto). Solo texto sin formato.',

    // Message tab: Announcement
    'Announcement Title' => 'Título del anuncio',
    'Heading of the announcement.' => 'Encabezado del anuncio.',
    'Dynamic Announcement Title' => 'Título de anuncio dinámico',
    'Announcement Message' => 'Mensaje del anuncio',
    'Body of the announcement. Supports Markdown.' => 'Cuerpo del anuncio. Compatible con Markdown.',

    // Message tab: Flash
    'Flash Message Type' => 'Tipo de mensaje flash',
    'Which type of flash message should appear?' => '¿Qué tipo de mensaje flash debe aparecer?',
    'Flash Message Title' => 'Título del mensaje flash',
    'Heading of the flash message.' => 'Encabezado del mensaje flash.',
    'Dynamic Flash Message Title' => 'Título de Flash dinámico',
    'Flash Message Details' => 'Detalles del mensaje flash',
    'Optionally include details below the heading. Supports Markdown and HTML.' => 'Opcionalmente incluye detalles debajo del encabezado. Compatible con Markdown y HTML.',

    // Message tab: Pushover
    "Field containing each user's Pushover key" => 'Campo de clave de Pushover del usuario',
    'Select which User field contains the recipient\'s Pushover user key.' => 'Seleccione el campo de usuario que contiene la clave de Pushover del destinatario.',
    'Pushover Title' => 'Título de Pushover',
    'Optionally include a heading above the body.' => 'Opcionalmente incluye un encabezado sobre el cuerpo.',
    'Dynamic Pushover Title' => 'Título de Pushover dinámico',
    'Pushover Body' => 'Cuerpo de Pushover',
    'Body of the Pushover notification. Plain text only.' => 'Cuerpo de la notificación Pushover. Solo texto sin formato.',

    // Message tab: ntfy
    'Priority' => 'Prioridad',
    'Priority level of the ntfy message.' => 'Nivel de prioridad del mensaje ntfy.',
    'Tags' => 'Etiquetas',
    'Optionally include comma-separated [emoji shortcodes](https://docs.ntfy.sh/emojis/).' => 'Opcionalmente incluye [códigos de emoji](https://docs.ntfy.sh/emojis/) separados por comas.',
    'ntfy Title' => 'Título de ntfy',
    'Dynamic ntfy Title' => 'Título de ntfy dinámico',
    'ntfy Body' => 'Cuerpo de ntfy',
    'Body of the ntfy notification.' => 'Cuerpo de la notificación ntfy.',
    'ntfy Link URL' => 'URL del enlace de ntfy',
    'Optionally open a URL when the notification is clicked.' => 'Opcionalmente abre una URL cuando se hace clic en la notificación.',
    'Enable Markdown' => 'Habilitar Markdown',
    'Whether to parse the body as Markdown in supported clients.' => 'Si el cuerpo debe renderizarse como Markdown en los clientes compatibles.',
    'Regular text only' => 'Solo texto sin formato',
    'Markdown enabled' => 'Markdown habilitado',

    // Message tab: Slack
    'Slack Message Body' => 'Cuerpo del mensaje de Slack',
    'Supports standard [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) syntax. Optionally supports HTML _(see below)_.' => 'Admite la sintaxis estándar [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting). Opcionalmente admite HTML _(ver abajo)_.',
    'Render Message Body as HTML' => 'Renderizar cuerpo del mensaje como HTML',
    'Whether to only parse as [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), or additionally parse it as HTML.' => 'Procesar solo como [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), o procesar adicionalmente como HTML.',
    'Render Link Previews' => 'Mostrar vistas previas de enlaces',
    'Whether Slack should unfurl link previews for URLs in the message body.' => 'Si Slack debe desplegar previsualizaciones de enlaces para las URL en el cuerpo del mensaje.',
    'Don\'t unfurl' => 'No expandir',
    'Expand link previews' => 'Expandir vistas previas',
    'Bot Name' => 'Nombre de usuario',
    'Optionally override the app\'s display name.' => 'Opcionalmente sobrescribe el nombre mostrado de la aplicación.',
    'Dynamic Bot Name' => 'Nombre de bot dinámico',
    'Bot Icon URL' => 'URL del icono',
    'Optionally override the app\'s icon with a URL.' => 'Opcionalmente sobrescribe el icono de la aplicación con una URL.',
    'Bot Emoji' => 'Emoji del icono',
    'Optionally override the app\'s icon with an emoji. Used only when Bot Icon URL is empty.' => 'Opcionalmente sobrescribe el icono de la aplicación con un emoji. Se usa solo cuando Bot Icon URL está vacío.',

    // Message tab: Discord
    'Discord Message Body' => 'Cuerpo del mensaje de Discord',
    'Supports standard Markdown, and optionally HTML _(see below)_. Max 2000 characters.' => 'Admite Markdown estándar y, opcionalmente, HTML _(ver abajo)_. Máx. 2000 caracteres.',
    'Whether to only parse as Markdown, or additionally parse it as HTML.' => 'Procesar solo como Markdown, o procesar adicionalmente como HTML.',
    'Markdown only' => 'Solo Markdown',
    'Markdown + HTML' => 'Markdown + HTML',
    'Whether Discord should unfurl link previews for URLs in the message body.' => 'Si Discord debe mostrar vistas previas de enlaces para las URL en el cuerpo del mensaje.',
    'Webhook Username' => 'Nombre de usuario del webhook',
    'Optionally override the webhook\'s display name.' => 'Opcionalmente sobrescribe el nombre mostrado del webhook.',
    'Dynamic Username' => 'Nombre de usuario dinámico',
    'Webhook Avatar URL' => 'URL del avatar del webhook',
    'Optionally override the webhook\'s avatar with a URL.' => 'Opcionalmente sobrescribe el avatar del webhook con una URL.',

    // Message tab: Bluesky
    'Post Body' => 'Cuerpo de la publicación',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => 'Texto sin formato, máximo 300 caracteres. Las URLs y las menciones `@handle.tld` se enlazan automáticamente.',
    'Generate Link Preview' => 'Generar vista previa del enlace',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => 'Generar automáticamente una tarjeta de vista previa cuando el cuerpo del post incluye una URL.',
    'No card' => 'Sin tarjeta',
    'Generate preview card' => 'Generar tarjeta de vista previa',

    // Message tab: Mastodon
    'Plain text, max 500 characters. URLs will unfurl automatically.' => 'Texto plano, máx. 500 caracteres. Las URL se despliegan automáticamente.',
    'Visibility' => 'Visibilidad',
    'Who will be able to see this post?' => '¿Quién podrá ver esta publicación?',

    // Message tab: MQTT
    'Payload' => 'Contenido',
    'The JSON or plain text message published to the MQTT topic.' => 'El mensaje JSON o de texto plano publicado en el tema MQTT.',
    'Quality of Service' => 'Calidad de servicio',
    'Delivery guarantee for this message.' => 'Garantía de entrega para este mensaje.',
    'Retain' => 'Retener',
    'Whether the broker keeps this as the topic\'s last message for future subscribers.' => 'Si el broker conserva este como el último mensaje del tema y lo entrega a futuros suscriptores.',
    'Don\'t retain' => 'No retener',

    // Recipients tab: type selector & user/group pickers
    'Recipients Type' => 'Tipo de destinatarios',
    'Who will receive this message?' => '¿Quién recibirá este mensaje?',
    'Add a message recipient' => 'Añadir un destinatario',
    'Select User(s)' => 'Seleccionar usuario(s)',
    'Which users will receive the message?' => '¿Qué usuarios recibirán el mensaje?',
    'Which user groups will receive the message?' => '¿Qué grupos de usuarios recibirán el mensaje?',

    // Recipients tab: channel pickers (ntfy, Slack, Discord, Bluesky, Mastodon, MQTT)
    'Select ntfy topic(s)' => 'Seleccionar tema(s) de ntfy',
    'Which topics should receive this message?' => '¿Qué temas deben recibir este mensaje?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'No hay temas de ntfy configurados. Añada uno en [Configuración → ntfy]({url}).',
    'No ntfy topics configured. Topics can only be added in an environment that allows administrative changes.' => 'No hay temas de ntfy configurados. Los temas solo se pueden añadir en un entorno que permita cambios administrativos.',
    'Select Slack channel(s)' => 'Seleccionar canal(es) de Slack',
    'Which channels should receive this message?' => '¿Qué canales deben recibir este mensaje?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'No hay canales de Slack configurados. Añada uno en [Configuración → Slack]({url}).',
    'No Slack channels configured. Channels can only be added in an environment that allows administrative changes.' => 'No hay canales de Slack configurados. Los canales solo se pueden añadir en un entorno que permita cambios administrativos.',
    'Select Discord channel(s)' => 'Seleccionar canal(es) de Discord',
    'No Discord channels configured. Add one in [Settings → Discord]({url}).' => 'No hay canales de Discord configurados. Añada uno en [Configuración → Discord]({url}).',
    'No Discord channels configured. Channels can only be added in an environment that allows administrative changes.' => 'No hay canales de Discord configurados. Los canales solo se pueden añadir en un entorno que permita cambios administrativos.',
    'Select Bluesky account(s)' => 'Seleccionar cuenta(s) de Bluesky',
    'Which accounts should post this message?' => '¿Qué cuentas deben publicar este mensaje?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'No hay cuentas de Bluesky configuradas. Añada una en [Configuración → Bluesky]({url}).',
    'No Bluesky accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'No hay cuentas de Bluesky configuradas. Las cuentas solo se pueden añadir en un entorno que permita cambios administrativos.',
    'Select Mastodon account(s)' => 'Seleccionar cuenta(s) de Mastodon',
    'No Mastodon accounts configured. Add one in [Settings → Mastodon]({url}).' => 'No hay cuentas de Mastodon configuradas. Añada una en [Configuración → Mastodon]({url}).',
    'No Mastodon accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'No hay cuentas de Mastodon configuradas. Las cuentas solo se pueden añadir en un entorno que permita cambios administrativos.',
    'Select MQTT topic(s)' => 'Seleccionar tema(s) MQTT',
    'No MQTT topics configured. Add one in [Settings → MQTT]({url}).' => 'No hay temas MQTT configurados. Añada uno en [Ajustes → MQTT]({url}).',
    'No MQTT topics configured. Topics can only be added in an environment that allows administrative changes.' => 'No hay temas MQTT configurados. Los temas solo se pueden añadir en un entorno que permita cambios administrativos.',
    'Not a valid topic. Must not be empty or contain the `+` or `#` wildcards.' => 'No es un tema válido. No debe estar vacío ni contener los comodines `+` o `#`.',

    // Recipients tab: dynamic recipients snippet
    'Twig Snippet to Determine Recipients' => 'Fragmento Twig para determinar los destinatarios',
    'Enter a custom Twig snippet to [determine who will receive the message]({url}).' => 'Introduzca un fragmento de Twig personalizado para [determinar quién recibirá el mensaje]({url}).',
    'The snippet **must** include a `{% setRecipients %}` tag.' => 'El fragmento **debe** incluir una etiqueta `{% setRecipients %}`.',

    // ========================================================
    // SETTINGS
    // ========================================================

    // Settings: nav & page chrome
    'Notifier Settings' => 'Configuración de Notifier',
    'General' => 'General',
    'Twilio' => 'Twilio',
    'Pushover' => 'Pushover',
    'ntfy' => 'ntfy',
    'Slack' => 'Slack',
    'Discord' => 'Discord',
    'Bluesky' => 'Bluesky',
    'Mastodon' => 'Mastodon',
    'MQTT' => 'MQTT',

    // Settings: shared intro lines
    'Consult the [{name} setup guide]({url}) for complete instructions.' => 'Consulte la [guía de configuración de {name}]({url}) para obtener instrucciones completas.',
    'Sensitive values can be stored in your `.env` file and referenced here.' => 'Los valores sensibles pueden almacenarse en su archivo `.env` y referenciarse aquí.',

    // Settings: Notification order
    'Notification Order' => 'Orden de las notificaciones',
    'Notifications can be dragged into any order on the index page. Choose where new notifications land in that order.' => 'Las notificaciones se pueden arrastrar para crear un orden personalizado en la página de índice. Aquí se define dónde se añaden las nuevas notificaciones a ese orden.',
    'Default Placement' => 'Ubicación predeterminada',
    'Where new notifications are added to the list.' => 'Dónde se añaden las nuevas notificaciones a la lista.',
    'Before other notifications' => 'Antes de las demás notificaciones',
    'After other notifications' => 'Después de las demás notificaciones',

    // Settings: Logging
    'Logging' => 'Registro',
    "Notifier keeps a running log of every message it sends. You usually won't need to change this, but you can limit how many log entries are kept in the database." => 'Notifier mantiene un registro continuo de los mensajes enviados. Aunque normalmente no es necesario, puede limitar la cantidad de eventos de registro guardados en la base de datos.',
    'Enable Logging' => 'Habilitar registro',
    'When disabled, Notifier will not write anything to the notification log.' => 'Cuando se deshabilita, Notifier no escribirá nada en el registro de notificaciones.',
    'Number of days to retain log events' => 'Días de retención de los eventos de registro',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Conservar los eventos de registro como máximo este número de días. Dejar en blanco para no aplicar límite.',
    'Number of log events to retain' => 'Número de eventos de registro a conservar',
    'At most, keep this many log events. Leave blank for no limit.' => 'Conservar como máximo este número de eventos de registro. Dejar en blanco para no aplicar límite.',

    // Settings: Scheduled sending
    'Scheduled Sending' => 'Envío programado',
    'A shared secret that authenticates scheduled runs triggered over the web. You only need this if you trigger the schedule from the web endpoint.' => 'Secreto compartido para autenticar las solicitudes web de ejecución programada. Solo es necesario cuando la programación se activa a través del endpoint web.',
    'Scheduled-Run Token' => 'Token de ejecución programada',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => 'Se envía con cada solicitud como cabecera X-Notifier-Token o parámetro token del cuerpo.',

    // Settings: Twilio
    'Send SMS text messages through [Twilio](https://www.twilio.com).' => 'Envíe mensajes de texto SMS a través de [Twilio](https://www.twilio.com).',
    'Twilio Account SID' => 'Twilio Account SID',
    'Twilio Auth Token' => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)' => 'Número de teléfono de Twilio (envía cada SMS)',
    'SMS Testing' => 'Pruebas de SMS',
    'Optional. When set, every SMS is sent to this number instead of the actual recipient.' => 'Opcional. Si se establece, cada SMS enviado se enviará a este número en lugar del destinatario resuelto.',
    'Test phone number' => 'Número de teléfono de prueba',

    // Settings: Pushover
    'Send push notifications through [Pushover](https://pushover.net).' => 'Envíe notificaciones push a través de [Pushover](https://pushover.net).',
    'Application API Token' => 'Token de API de la aplicación',
    'The 30-character app token from your Pushover application.' => 'El token de aplicación de 30 caracteres de su aplicación de Pushover.',

    // Settings: ntfy
    'Send push notifications through [ntfy](https://ntfy.sh).' => 'Envíe notificaciones push a través de [ntfy](https://ntfy.sh).',
    'Server URL' => 'URL del servidor',
    "Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`." => 'Opcional, apunte a una instancia ntfy autoalojada (si corresponde). Por defecto `https://ntfy.sh`.',
    'Access token' => 'Token de acceso',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Opcional, necesario para temas protegidos o instancias autoalojadas con autenticación.',
    'ntfy Topics' => 'Temas de ntfy',
    'Add the ntfy topics you want to send to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Añada los temas de ntfy a los que quiera enviar mensajes. Cada tema queda disponible como destinatario en la pestaña **Destinatarios** al configurar una notificación.',
    'Topics' => 'Temas',
    "Click any row's **Test** button to send a quick test message to that topic." => 'Haga clic en el botón **Probar** de cualquier fila para enviar un mensaje de prueba rápido a ese tema.',
    'Label' => 'Etiqueta',
    'Topic' => 'Tema',
    'Add a topic' => 'Añadir un tema',

    // Settings: Slack
    'Post messages to your Slack channels.' => 'Envíe mensajes a sus canales de Slack.',
    'Channels' => 'Canales',
    "Click any row's **Test** button to send a quick test message to that channel." => 'Haga clic en el botón **Probar** de cualquier fila para enviar un mensaje de prueba rápido a ese canal.',
    'Bot Token' => 'Token del bot',
    'Channel ID' => 'ID del canal',
    'Add a channel' => 'Añadir un canal',
    'Not a valid Bot Token. Must start with `xoxb-`.' => 'No es un Token del bot válido. Debe empezar con `xoxb-`.',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => 'No es un ID de canal válido. Debe verse como `C01234ABCD`.',

    // Settings: Discord
    'Post messages to your Discord channels.' => 'Envíe mensajes a sus canales de Discord.',
    'Webhook URL' => 'URL del webhook',
    'Not a valid Webhook URL. Must start with `https://discord.com/api/webhooks/`.' => 'No es una URL de webhook válida. Debe empezar con `https://discord.com/api/webhooks/`.',

    // Settings: Bluesky
    'Publish posts to your [Bluesky](https://bsky.app) accounts.' => 'Publique mensajes en sus cuentas de [Bluesky](https://bsky.app).',
    'PDS URL' => 'URL del PDS',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'Por defecto https://bsky.social. Apunte a un PDS personalizado si su instalación está federada.',
    'Bluesky Accounts' => 'Cuentas de Bluesky',
    'Add the Bluesky accounts you want to post from. Each account becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Añada las cuentas de Bluesky desde las que quiera publicar. Cada cuenta queda disponible como destinatario en la pestaña **Destinatarios** al configurar una notificación.',
    'Accounts' => 'Cuentas',
    "Click any row's **Test** button to confirm the account authenticates." => 'Haga clic en el botón **Probar** de cualquier fila para confirmar que la cuenta se autentica.',
    'Handle' => 'Identificador',
    'App password' => 'Contraseña de aplicación',
    'Add an account' => 'Añadir una cuenta',

    // Settings: Mastodon
    'Publish posts to your [Mastodon](https://joinmastodon.org) accounts.' => 'Publique mensajes en sus cuentas de [Mastodon](https://joinmastodon.org).',
    'Click any row\'s **Test** button to verify that account\'s credentials. No posts are made.' => 'Haga clic en el botón **Probar** de cualquier fila para verificar las credenciales de esa cuenta. No se realiza ninguna publicación.',
    'Instance URL' => 'URL de instancia',
    'Access Token' => 'Token de acceso',

    // Settings: MQTT
    'Publish messages to an MQTT broker, handy for IoT and home-automation setups.' => 'Publique mensajes en un broker MQTT, práctico para configuraciones de IoT y domótica.',
    'Host' => 'Host',
    'Broker hostname, without a protocol or port.' => 'Nombre de host del broker, sin protocolo ni puerto.',
    'Port' => 'Puerto',
    'Optional. Defaults to 8883 when TLS is enabled, otherwise 1883.' => 'Opcional. El valor predeterminado es 8883 cuando TLS está habilitado; de lo contrario, 1883.',
    'Use TLS' => 'Usar TLS',
    'Whether to connect to the broker over a secure TLS socket.' => 'Si se debe conectar al broker mediante un socket TLS seguro.',
    'Username' => 'Nombre de usuario',
    'Optional, for brokers that require username/password authentication.' => 'Opcional, para brokers que requieren autenticación con nombre de usuario/contraseña.',
    'Password' => 'Contraseña',
    'MQTT Version' => 'Versión de MQTT',
    'Protocol version sent to the broker.' => 'Versión del protocolo enviada al broker.',
    'Client ID' => 'ID de cliente',
    'Optional. A unique client ID is generated automatically when left blank.' => 'Opcional. Se genera automáticamente un ID de cliente único cuando se deja en blanco.',
    'Mutual TLS' => 'TLS mutuo',
    'Optional. Needed for brokers that authenticate clients with certificates, such as AWS IoT Core. Enter the server file paths to your certificate files. You can use a `.env` variable or `@alias` reference.' => 'Opcional. Necesario para brokers que autentican a los clientes con certificados, como AWS IoT Core. Indique rutas de archivo del servidor a los archivos de certificado (se permite una variable `.env` o una referencia `@alias`).',
    'CA Certificate File' => 'Archivo de certificado CA',
    'Path to the certificate authority (CA) file.' => 'Ruta al archivo de la autoridad de certificación (CA).',
    'Client Certificate File' => 'Archivo de certificado de cliente',
    'Path to the client certificate file.' => 'Ruta al archivo de certificado de cliente.',
    'Client Key File' => 'Archivo de clave de cliente',
    'Path to the client private key file.' => 'Ruta al archivo de clave privada del cliente.',
    'MQTT Topics' => 'Temas MQTT',
    'Add the MQTT topics you want to publish to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Añada los temas MQTT en los que quiera publicar. Cada tema queda disponible como destinatario en la pestaña **Destinatarios** al configurar una notificación.',
    'Click any row\'s **Test** button to publish a quick test message to that topic.' => 'Haga clic en el botón **Probar** de cualquier fila para publicar un mensaje de prueba rápido en ese tema.',

    // ========================================================
    // MANUAL SEND & TEST
    // ========================================================

    // Manual send & test
    'Send a test message' => 'Enviar un mensaje de prueba',
    'Send a REAL test notification?\\n\\n⚠️ Uses a random sample of real data.\\n⚠️ Sends a real message via the configured channel.\\n⚠️ Delivers to the real configured recipient(s).' => '¿Enviar una notificación de prueba REAL?\\n\\n⚠️ Usa una muestra aleatoria de datos reales.\\n⚠️ Envía un mensaje real por el canal configurado.\\n⚠️ Se entrega a los destinatarios reales configurados.',
    'Test' => 'Probar',
    'Send system snapshot' => 'Enviar instantánea del sistema',
    'Send data report' => 'Enviar informe de datos',
    'Are you sure you want to send this notification?' => '¿Seguro que quiere enviar esta notificación?',
    'This notification cannot be triggered manually.' => 'Esta notificación no se puede activar manualmente.',
    'This notification no longer applies to the selected element.' => 'Esta notificación ya no se aplica al elemento seleccionado.',

    // ========================================================
    // RUNTIME OUTPUT
    // ========================================================

    // Runtime: dispatch log feedback
    'Sending {messageType} to {recipient}.' => 'Enviando {messageType} a {recipient}.',
    'Adding message to queue.' => 'Añadiendo mensaje a la cola.',
    'Sending message immediately (bypassing queue).' => 'Enviando el mensaje inmediatamente (omitiendo la cola).',
    'Unable to parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => 'No se puede analizar el feed. Se requieren las extensiones de PHP `simplexml` y `libxml`.',
    'Unable to parse the feed.' => 'No se puede analizar el feed.',
    'Unable to fetch the feed: {message}' => 'No se puede obtener el feed: {message}',
    'Initial feed scan failed: {message}' => 'Falló el escaneo inicial del feed: {message}',

    // Runtime: controller responses
    'Test notification dispatched.' => 'Notificación de prueba enviada.',
    'No messages were dispatched. Check the recipient configuration.' => 'No se enviaron mensajes. Compruebe la configuración de los destinatarios.',
    'Unable to send test: the feed could not be read or has no items.' => 'No se puede enviar la prueba: no se pudo leer el feed o no contiene elementos.',
    'Unable to send test: no element matches the configured filters.' => 'No se puede enviar la prueba: ningún elemento coincide con los filtros configurados.',
    "Couldn't save settings." => 'No se pudo guardar la configuración.',
    'Settings saved.' => 'Configuración guardada.',
    'Topic is empty.' => 'El tema está vacío.',
    'Server URL is not configured.' => 'La URL del servidor no está configurada.',
    'Test message from Notifier.' => 'Mensaje de prueba de Notifier.',
    'HTTP {status}' => 'HTTP {status}',
    'Test message sent successfully.' => 'Mensaje de prueba enviado correctamente.',
    'Handle and app password are required.' => 'Se requieren el identificador y la contraseña de aplicación.',
    'Authentication failed.' => 'Autenticación fallida.',
    'Successfully authenticated. No messages were posted.' => 'Autenticado correctamente. No se publicó ningún mensaje.',
    'Log events deleted.' => 'Eventos de registro eliminados.',
    'Notification sent.' => 'Notificación enviada.',
    'Notification was not sent. Check the Notification Log for details.' => 'La notificación no se envió. Consulta el Registro de notificaciones para más detalles.',
    'Instance URL and access token are required.' => 'Se requieren la URL de instancia y el token de acceso.',
    'Mastodon rejected the request: {error}' => 'Mastodon rechazó la solicitud: {error}',
    'Successfully authenticated as @{handle}. No posts were made.' => 'Autenticado correctamente como @{handle}. No se realizó ninguna publicación.',
    'Broker host is not configured.' => 'El host del broker no está configurado.',

    // Outbound: per-channel send results
    'Unable to send email, no recipient specified.' => 'No se puede enviar el correo: no se ha especificado un destinatario.',
    'Unable to send email, the message body was empty.' => 'No se puede enviar el correo: el cuerpo del mensaje estaba vacío.',
    "Unable to send the email using Craft's native email handling." => 'No se puede enviar el correo mediante el gestor nativo de Craft.',
    'Check your general email settings within Craft.' => 'Compruebe la configuración general de correo en Craft.',
    'Successfully sent email message!' => '¡Correo enviado correctamente!',
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[Credenciales de Twilio no válidas.]({url}) Falta {missing}.',
    'Unable to send SMS, no Twilio phone number exists.' => 'No se puede enviar el SMS: no hay número de teléfono de Twilio.',
    'Unable to send SMS, no recipient phone number exists.' => 'No se puede enviar el SMS: no hay número de teléfono del destinatario.',
    'Unable to send SMS, recipient phone number is invalid.' => 'No se puede enviar el SMS: el número del destinatario no es válido.',
    'Successfully sent SMS message!' => '¡SMS enviado correctamente!',
    'Unable to post announcement, no recipient userId specified.' => 'No se puede publicar el anuncio: no se especificó el userId del destinatario.',
    'Successfully posted announcement!' => '¡Anuncio publicado correctamente!',
    'Unable to send the flash message, invalid flash type.' => 'No se puede enviar el mensaje flash: tipo de flash no válido.',
    'Successfully sent flash message!' => '¡Mensaje flash enviado correctamente!',
    '[Invalid Pushover credentials.]({url}) Missing app token.' => '[Credenciales de Pushover no válidas.]({url}) Falta el token de la aplicación.',
    'Unable to send Pushover message, no user key on recipient.' => 'No se puede enviar el mensaje Pushover: el destinatario no tiene clave de usuario.',
    'Pushover POST failed: {reason}' => 'Falló el POST de Pushover: {reason}',
    'Successfully sent Pushover message!' => '¡Mensaje de Pushover enviado correctamente!',
    'Unable to send ntfy message, no topic specified.' => 'No se puede enviar el mensaje ntfy: no se especificó el tema.',
    'ntfy POST failed with HTTP {status}: {reason}' => 'Falló el POST de ntfy con HTTP {status}: {reason}',
    'ntfy POST failed: {reason}' => 'Falló el POST de ntfy: {reason}',
    'Successfully sent ntfy message to topic "{topic}".' => 'Mensaje ntfy enviado correctamente al tema "{topic}".',
    'Unable to send Slack message, no bot token.' => 'No se puede enviar el mensaje de Slack: no hay token del bot.',
    'Unable to send Slack message, no channel ID.' => 'No se puede enviar el mensaje de Slack: no hay ID del canal.',
    'Unable to send Slack message, body is empty.' => 'No se puede enviar el mensaje de Slack: el cuerpo está vacío.',
    'Slack rejected the message: {error}' => 'Slack rechazó el mensaje: {error}',
    'Slack POST failed: {reason}' => 'Falló el POST de Slack: {reason}',
    'Successfully sent Slack message to "{label}".' => 'Mensaje de Slack enviado correctamente a "{label}".',
    'Unable to send Discord message, no webhook URL.' => 'No se puede enviar el mensaje de Discord: no hay URL de webhook.',
    'Unable to send Discord message, body is empty.' => 'No se puede enviar el mensaje de Discord: el cuerpo está vacío.',
    'Unable to send Discord message, body exceeds the 2000-character limit.' => 'No se puede enviar el mensaje de Discord: el cuerpo supera el límite de 2000 caracteres.',
    'Discord rejected the message: {error}' => 'Discord rechazó el mensaje: {error}',
    'Discord POST failed: {reason}' => 'Falló el POST de Discord: {reason}',
    'Successfully sent Discord message to "{label}".' => 'Mensaje de Discord enviado correctamente a "{label}".',
    'Unable to send Bluesky post, recipient is missing credentials.' => 'No se puede enviar la publicación de Bluesky: faltan credenciales del destinatario.',
    'Body exceeded {max} characters, truncated.' => 'El cuerpo superó los {max} caracteres y se truncó.',
    'Successfully posted to Bluesky as "{label}".' => 'Publicado correctamente en Bluesky como "{label}".',
    'Bluesky auth failed for {handle}: {reason}' => 'Falló la autenticación de Bluesky para {handle}: {reason}',
    'Bluesky auth failed: {reason}' => 'Falló la autenticación de Bluesky: {reason}',
    'Bluesky post failed: {reason}' => 'Falló la publicación en Bluesky: {reason}',
    'Bluesky link preview skipped: {reason}' => 'Vista previa del enlace de Bluesky omitida: {reason}',
    'Unable to send Mastodon post, no instance URL.' => 'No se puede enviar la publicación de Mastodon: no hay URL de instancia.',
    'Unable to send Mastodon post, no access token.' => 'No se puede enviar la publicación de Mastodon: no hay token de acceso.',
    'Unable to send Mastodon post, body is empty.' => 'No se puede enviar la publicación de Mastodon: el cuerpo está vacío.',
    'Mastodon rejected the post: {error}' => 'Mastodon rechazó la publicación: {error}',
    'Mastodon POST failed: {reason}' => 'Falló el POST de Mastodon: {reason}',
    'Successfully sent Mastodon post to "{label}".' => 'Publicación de Mastodon enviada correctamente a "{label}".',
    'Unable to send MQTT message, no broker host configured.' => 'No se puede enviar el mensaje MQTT, no hay ningún host de broker configurado.',
    'Unable to send MQTT message, no topic specified.' => 'No se puede enviar el mensaje MQTT, no se especificó ningún tema.',
    'Unable to send MQTT message, the payload is empty.' => 'No se puede enviar el mensaje MQTT, el contenido está vacío.',
    'MQTT publish failed: {reason}' => 'Error al publicar en MQTT: {reason}',
    'Successfully sent MQTT message to topic "{topic}".' => 'Mensaje MQTT enviado correctamente al tema "{topic}".',

    // Recipient warnings
    'Recipient "{name}" has no email address.' => 'El destinatario "{name}" no tiene dirección de correo.',
    'Recipient "{name}" has no phone number.' => 'El destinatario "{name}" no tiene número de teléfono.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => 'El destinatario "{name}" no tiene un usuario asociado; no se puede enviar el anuncio.',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => 'El destinatario "{name}" no puede acceder al panel de control; no se puede enviar el anuncio.',
    'Pushover user-key field is not configured on this notification.' => 'El campo de clave de usuario de Pushover no está configurado en esta notificación.',
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => 'El destinatario "{name}" no tiene un usuario asociado; no se puede enviar el mensaje Pushover.',
    '[SKIPPED] User "{name}" has no Pushover key.' => '[OMITIDO] El usuario "{name}" no tiene clave de Pushover.',
    'Recipient "{name}" has no ntfy topic.' => 'El destinatario "{name}" no tiene tema de ntfy.',
    'Recipient "{name}" has no Slack bot token.' => 'El destinatario "{name}" no tiene token de bot de Slack.',
    'Recipient "{name}" has no Slack channel ID.' => 'El destinatario "{name}" no tiene ID de canal de Slack.',
    'Recipient "{name}" has no Discord webhook URL.' => 'El destinatario "{name}" no tiene URL de webhook de Discord.',
    'Recipient "{name}" has no Bluesky credentials.' => 'El destinatario "{name}" no tiene credenciales de Bluesky.',
    'Recipient "{name}" has no Mastodon credentials.' => 'El destinatario "{name}" no tiene credenciales de Mastodon.',
    'Recipient "{name}" has no MQTT topic.' => 'El destinatario "{name}" no tiene tema MQTT.',

    // Errors & exceptions
    'Invalid element event: {class}' => 'Evento de elemento no válido: {class}',
    'Invalid notification ID: {id}' => 'ID de notificación no válido: {id}',
    'Invalid email message mode.' => 'Modo de mensaje de correo no válido.',
    'You do not have permission to use the Dynamic Recipients type.' => 'No tiene permiso para usar el tipo Destinatarios dinámicos.',
    'Dynamic recipients snippet did not call setRecipients.' => 'El fragmento de destinatarios dinámicos no llamó a setRecipients.',
    'setRecipients was called with an empty value.' => 'Se llamó a setRecipients con un valor vacío.',
    'Unrecognized recipient of type "{type}".' => 'Destinatario de tipo "{type}" no reconocido.',
    'Unrecognized recipient "{value}".' => 'Destinatario "{value}" no reconocido.',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => 'El {kind} configurado ya no existe en la configuración del plugin (uid: {uid}).',
    'Invalid settings section: {section}' => 'Sección de configuración no válida: {section}',
    'User not authorized to save this notification.' => 'El usuario no está autorizado para guardar esta notificación.',
    'User not authorized to view this notification.' => 'El usuario no está autorizado para ver esta notificación.',
    'User not authorized to delete this notification.' => 'El usuario no está autorizado para eliminar esta notificación.',
    'Notification not found' => 'Notificación no encontrada',
    'Element not found' => 'Elemento no encontrado',
    'You do not have permission to use the Dynamic Data type.' => 'No tienes permiso para usar el tipo de datos dinámicos.',
    'The Dynamic Data snippet did not call the {tag} tag.' => 'El fragmento Twig no llamó a la etiqueta {tag}.',

    // Config-file override note
    'This is being set in the config file. [{file}]' => 'Esto se establece en el archivo de configuración. [{file}]',

    // ========================================================
    // JAVASCRIPT UI
    // ========================================================

    // JavaScript: log utility & buttons
    'Test notification failed.' => 'La notificación de prueba falló.',
    'Unable to get the notification, something went wrong.' => 'No se pudo obtener la notificación, algo salió mal.',
    'Something went wrong.' => 'Algo salió mal.',
    'Invalid notification ID.' => 'ID de notificación no válido.',
    'Unable to delete the log event, something went wrong.' => 'No se pudo eliminar el evento de registro, algo salió mal.',
    'Log event deleted.' => 'Evento de registro eliminado.',
    'Unable to delete log events, something went wrong.' => 'No se pudieron eliminar los eventos de registro, algo salió mal.',
    'Are you sure you want to delete all logs from {date}?' => '¿Está seguro de que desea eliminar todos los registros del {date}?',
];
