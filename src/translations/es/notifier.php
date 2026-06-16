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
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are supported.' => '[Plantillas]({templatingUrl}) y [variables especiales]({variablesUrl}) son compatibles.',

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

    // Message tab: Facebook
    'Message Body' => 'Cuerpo del mensaje',
    'The text of your Facebook post.' => 'El texto de su publicación de Facebook.',
    'Preview Card URL' => 'URL de la tarjeta de vista previa',
    'Optionally add a link to generate a preview card.' => 'Opcionalmente añada un enlace para generar una tarjeta de vista previa.',

    // Message tab: Instagram
    'Caption' => 'Pie de foto',
    'Image Attachment' => 'Imagen adjunta',
    'Optional caption, max 2200 characters.' => 'Pie de foto opcional, máx. 2200 caracteres.',

    // Message tab: X (Twitter)
    'Plain text, max 280 characters.' => 'Texto sin formato, máximo 280 caracteres.',

    // Message tab: Media
    'Attach an image by calling `{% setMedia %}` in a [custom Twig snippet]({url}).' => 'Adjunte una imagen llamando a `{% setMedia %}` en un [fragmento de Twig personalizado]({url}).',

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
    'Select Facebook page(s)' => 'Seleccionar página(s) de Facebook',
    'Which pages should post this message?' => '¿Qué páginas deben publicar este mensaje?',
    'No Facebook pages configured. Add one in [Settings → Facebook]({url}).' => 'No hay páginas de Facebook configuradas. Añada una en [Configuración → Facebook]({url}).',
    'No Facebook pages configured. Pages can only be added in an environment that allows administrative changes.' => 'No hay páginas de Facebook configuradas. Las páginas solo se pueden añadir en un entorno que permita cambios administrativos.',
    'Select Instagram account(s)' => 'Seleccionar cuenta(s) de Instagram',
    'No Instagram accounts configured. Add one in [Settings → Instagram]({url}).' => 'No hay cuentas de Instagram configuradas. Añada una en [Configuración → Instagram]({url}).',
    'No Instagram accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'No hay cuentas de Instagram configuradas. Las cuentas solo se pueden añadir en un entorno que permita cambios administrativos.',
    'Select X (Twitter) account(s)' => 'Seleccionar cuenta(s) de X (Twitter)',
    'No X (Twitter) accounts configured. Add one in [Settings → X (Twitter)]({url}).' => 'No hay cuentas de X (Twitter) configuradas. Añada una en [Configuración → X (Twitter)]({url}).',
    'No X (Twitter) accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'No hay cuentas de X (Twitter) configuradas. Las cuentas solo se pueden añadir en un entorno que permita cambios administrativos.',
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

    // Settings: Facebook
    'Facebook' => 'Facebook',
    'Publish posts to your [Facebook](https://facebook.com) pages.' => 'Publique mensajes en sus páginas de [Facebook](https://facebook.com).',
    'Pages' => 'Páginas',
    'Page ID' => 'Page ID',
    'Page Access Token' => 'Page Access Token',
    'Add a page' => 'Añadir una página',
    "Click any row's **Test** button to verify that page's credentials. No posts are made." => 'Haga clic en el botón **Probar** de cualquier fila para verificar las credenciales de esa página. No se realiza ninguna publicación.',

    // Settings: Instagram
    'Instagram' => 'Instagram',
    'Publish posts to your [Instagram](https://instagram.com) Business accounts.' => 'Publique mensajes en sus cuentas de [Instagram](https://instagram.com) Business.',
    "Click any row's **Test** button to resolve the linked Instagram account. No posts are made." => 'Haga clic en el botón **Probar** de cualquier fila para resolver la cuenta de Instagram vinculada. No se realiza ninguna publicación.',

    // Settings: X (Twitter)
    'X (Twitter)' => 'X (Twitter)',
    'Publish posts to your [X (Twitter)](https://x.com) accounts.' => 'Publique mensajes en sus cuentas de [X (Twitter)](https://x.com).',
    'Consumer Key' => 'Consumer Key',
    'Consumer Key Secret' => 'Consumer Key Secret',
    'Access Token Secret' => 'Access Token Secret',

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
    'Page ID and Page Access Token are required.' => 'Se requieren el Page ID y el Page Access Token.',
    'Facebook rejected the request: {error}' => 'Facebook rechazó la solicitud: {error}',
    'Successfully connected to "{name}". No posts were made.' => 'Conectado correctamente a "{name}". No se realizó ninguna publicación.',
    'No Instagram Business account is linked to this Page.' => 'No hay ninguna cuenta de Instagram Business vinculada a esta página.',
    'Successfully connected to @{handle}. No posts were made.' => 'Conectado correctamente a @{handle}. No se realizó ninguna publicación.',
    'All four credentials are required.' => 'Se requieren las cuatro credenciales.',
    'X (Twitter) rejected the request: {error}' => 'X (Twitter) rechazó la solicitud: {error}',
    'Successfully authenticated as @{username}. No posts were made.' => 'Autenticado correctamente como @{username}. No se realizó ninguna publicación.',
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
    'Successfully sent email message!' => '¡Correo enviado correctamente!',
    'Successfully sent SMS message!' => '¡SMS enviado correctamente!',
    'Successfully posted announcement!' => '¡Anuncio publicado correctamente!',
    'Successfully sent flash message!' => '¡Mensaje flash enviado correctamente!',
    'Successfully sent Pushover message!' => '¡Mensaje de Pushover enviado correctamente!',
    'Successfully sent ntfy message to topic "{topic}".' => 'Mensaje ntfy enviado correctamente al tema "{topic}".',
    'Slack rejected the message: {error}' => 'Slack rechazó el mensaje: {error}',
    'Successfully sent Slack message to "{label}".' => 'Mensaje de Slack enviado correctamente a "{label}".',
    'Discord rejected the message: {error}' => 'Discord rechazó el mensaje: {error}',
    'Successfully sent Discord message to "{label}".' => 'Mensaje de Discord enviado correctamente a "{label}".',
    'Successfully sent Facebook post to "{label}".' => 'Publicación de Facebook enviada correctamente a "{label}".',
    'the attached image could not be read' => 'no se pudo leer la imagen adjunta',
    'Successfully sent X (Twitter) post as "{label}".' => 'Publicación de X (Twitter) enviada correctamente como "{label}".',
    'Successfully posted to Bluesky as "{label}".' => 'Publicado correctamente en Bluesky como "{label}".',
    'Successfully sent Mastodon post to "{label}".' => 'Publicación de Mastodon enviada correctamente a "{label}".',
    'Successfully sent MQTT message to topic "{topic}".' => 'Mensaje MQTT enviado correctamente al tema "{topic}".',

    // Media attachments
    'Videos are not yet supported on {channel}.' => 'Los vídeos aún no son compatibles en {channel}.',
    'The image could not be resized to fit.' => 'No se pudo redimensionar la imagen para que se ajuste.',
    '[NOT ATTACHED] Unable to attach image. {reason}' => '[NO ADJUNTADO] No se pudo adjuntar la imagen. {reason}',

    // Recipient warnings
    '[SKIPPED] User "{name}" has no Pushover key.' => '[OMITIDO] El usuario "{name}" no tiene clave de Pushover.',

    // Errors & exceptions
    'Invalid element event: {class}' => 'Evento de elemento no válido: {class}',
    'Invalid notification ID: {id}' => 'ID de notificación no válido: {id}',
    'Invalid email message mode.' => 'Modo de mensaje de correo no válido.',
    'You do not have permission to use the Dynamic Recipients type.' => 'No tiene permiso para usar el tipo Destinatarios dinámicos.',
    'Invalid settings section: {section}' => 'Sección de configuración no válida: {section}',
    'User not authorized to save this notification.' => 'El usuario no está autorizado para guardar esta notificación.',
    'User not authorized to view this notification.' => 'El usuario no está autorizado para ver esta notificación.',
    'User not authorized to delete this notification.' => 'El usuario no está autorizado para eliminar esta notificación.',
    'Notification not found' => 'Notificación no encontrada',
    'Element not found' => 'Elemento no encontrado',
    'You do not have permission to use the Dynamic Data type.' => 'No tienes permiso para usar el tipo de datos dinámicos.',
    '[NO DATA] The Dynamic Data snippet did not call the {tag} tag.' => '[SIN DATOS] El fragmento Twig no llamó a la etiqueta {tag}.',

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
    // Reworded outbound + dispatch log messages
    'Successfully posted to "{label}" Instagram account.' => 'Publicado en la cuenta de Instagram "{label}".',
    '[BAD CREDENTIALS] Missing app token. [Configure Pushover]({url}).' => '[CREDENCIALES NO VÁLIDAS] Falta el token de la app. [Configurar Pushover]({url}).',
    '[BAD CREDENTIALS] Missing {missing}. [Configure Twilio]({url}).' => '[CREDENCIALES NO VÁLIDAS] Falta {missing}. [Configurar Twilio]({url}).',
    '[BAD CREDENTIALS] No Discord webhook URL is configured.' => '[CREDENCIALES NO VÁLIDAS] No hay configurada ninguna URL de webhook de Discord.',
    '[BAD CREDENTIALS] No MQTT broker host is configured.' => '[CREDENCIALES NO VÁLIDAS] No hay configurado ningún host de bróker MQTT.',
    '[BAD CREDENTIALS] No Mastodon access token is configured.' => '[CREDENCIALES NO VÁLIDAS] No hay configurado ningún token de acceso de Mastodon.',
    '[BAD CREDENTIALS] No Mastodon instance URL is configured.' => '[CREDENCIALES NO VÁLIDAS] No hay configurada ninguna URL de instancia de Mastodon.',
    '[BAD CREDENTIALS] No Slack bot token is configured.' => '[CREDENCIALES NO VÁLIDAS] No hay configurado ningún token de bot de Slack.',
    '[BAD CREDENTIALS] No Twilio phone number is configured.' => '[CREDENCIALES NO VÁLIDAS] No hay configurado ningún número de teléfono de Twilio.',
    '[BAD CREDENTIALS] The recipient is missing Bluesky credentials.' => '[CREDENCIALES NO VÁLIDAS] Al destinatario le faltan las credenciales de Bluesky.',
    '[BAD CREDENTIALS] The recipient is missing Facebook credentials.' => '[CREDENCIALES NO VÁLIDAS] Al destinatario le faltan las credenciales de Facebook.',
    '[BAD CREDENTIALS] The recipient is missing X (Twitter) credentials.' => '[CREDENCIALES NO VÁLIDAS] Al destinatario le faltan las credenciales de X (Twitter).',
    '[BAD CREDENTIALS] Unable to post, recipient is missing credentials.' => '[CREDENCIALES NO VÁLIDAS] No se puede publicar; al destinatario le faltan credenciales.',
    '[EMPTY BODY] The Discord message body is empty.' => '[CUERPO VACÍO] El cuerpo del mensaje de Discord está vacío.',
    '[EMPTY BODY] The Facebook post body is empty.' => '[CUERPO VACÍO] El cuerpo de la publicación de Facebook está vacío.',
    '[EMPTY BODY] The MQTT payload is empty.' => '[CUERPO VACÍO] La carga útil de MQTT está vacío.',
    '[EMPTY BODY] The Mastodon post body is empty.' => '[CUERPO VACÍO] El cuerpo de la publicación de Mastodon está vacío.',
    '[EMPTY BODY] The Slack message body is empty.' => '[CUERPO VACÍO] El cuerpo del mensaje de Slack está vacío.',
    '[EMPTY BODY] The X (Twitter) post body is empty.' => '[CUERPO VACÍO] El cuerpo de la publicación de X (Twitter) está vacío.',
    '[EMPTY BODY] The email message body was empty.' => '[CUERPO VACÍO] El cuerpo del correo estaba vacío.',
    '[FEED ERROR] Could not fetch the feed: {message}' => '[ERROR DE FEED] No se pudo obtener el feed: {message}',
    '[FEED ERROR] Could not parse the feed.' => '[ERROR DE FEED] No se pudo analizar el feed.',
    '[FEED ERROR] Could not parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => '[ERROR DE FEED] No se pudo analizar el feed. Se requieren las extensiones de PHP `simplexml` y `libxml`.',
    '[FEED ERROR] Initial feed scan failed: {message}' => '[ERROR DE FEED] El primer escaneo del feed falló: {message}',
    '[INVALID NUMBER] The recipient phone number is invalid.' => '[NÚMERO NO VÁLIDO] El número de teléfono del destinatario no es válido.',
    '[INVALID TYPE] The flash message type is invalid.' => '[TIPO NO VÁLIDO] El tipo de mensaje flash no es válido.',
    '[LINK PREVIEW SKIPPED] {reason}' => '[VISTA PREVIA OMITIDA] {reason}',
    '[MISSING IMAGE] Image Attachment field never called the {tag} tag.' => '[FALTA IMAGEN] El campo Imagen adjunta nunca invocó la etiqueta {tag}.',
    '[MISSING IMAGE] Image Attachment field was empty.' => '[FALTA IMAGEN] El campo Imagen adjunta estaba vacío.',
    '[MISSING IMAGE] The {tag} tag was called, but returned an invalid image.' => '[FALTA IMAGEN] Se invocó la etiqueta {tag}, pero devolvió una imagen no válida.',
    '[MISSING IMAGE] Unable to send Instagram post, the image needs a public URL.' => '[FALTA IMAGEN] No se puede enviar la publicación de Instagram; la imagen necesita una URL pública.',
    '[NO MEDIA] No image was attached because the {tag} tag was never invoked in the Image Attachment field.' => '[SIN MEDIOS] No se adjuntó ninguna imagen porque la etiqueta {tag} nunca se invocó en el campo Imagen adjunta.',
    '[NO RECIPIENTS] The Dynamic Recipients snippet did not call setRecipients.' => '[SIN DESTINATARIOS] El fragmento de destinatarios dinámicos no llamó a setRecipients.',
    '[NO RECIPIENTS] setRecipients was called with an empty value.' => '[SIN DESTINATARIOS] Se llamó a setRecipients con un valor vacío.',
    '[NO RECIPIENT] No MQTT topic was specified.' => '[SIN DESTINATARIO] No se especificó ningún tema de MQTT.',
    '[NO RECIPIENT] No Slack channel ID was specified.' => '[SIN DESTINATARIO] No se especificó ningún ID de canal de Slack.',
    '[NO RECIPIENT] No ntfy topic was specified.' => '[SIN DESTINATARIO] No se especificó ningún tema de ntfy.',
    '[NO RECIPIENT] No recipient user was specified for the announcement.' => '[SIN DESTINATARIO] No se especificó ningún usuario destinatario para el anuncio.',
    '[NO RECIPIENT] No recipient was specified for the email.' => '[SIN DESTINATARIO] No se especificó ningún destinatario para el correo.',
    '[NO RECIPIENT] The recipient has no Pushover user key.' => '[SIN DESTINATARIO] El destinatario no tiene clave de usuario de Pushover.',
    '[NO RECIPIENT] The recipient has no phone number.' => '[SIN DESTINATARIO] El destinatario no tiene número de teléfono.',
    '[REJECTED BY DISCORD] {error}' => '[RECHAZADO POR DISCORD] {error}',
    '[REJECTED BY FACEBOOK] {error}' => '[RECHAZADO POR FACEBOOK] {error}',
    '[REJECTED BY INSTAGRAM] {error}' => '[RECHAZADO POR INSTAGRAM] {error}',
    '[REJECTED BY MASTODON] {error}' => '[RECHAZADO POR MASTODON] {error}',
    '[REJECTED BY SLACK] {error}' => '[RECHAZADO POR SLACK] {error}',
    '[REJECTED BY X (TWITTER)] {error}' => '[RECHAZADO POR X (TWITTER)] {error}',
    '[SEND FAILED] Authentication failed for {handle}: {reason}' => '[ENVÍO FALLIDO] Falló la autenticación de {handle}: {reason}',
    '[SEND FAILED] Authentication failed: {reason}' => '[ENVÍO FALLIDO] Falló la autenticación: {reason}',
    "[SEND FAILED] Could not send the email using Craft's native handling. Check your general email settings within Craft." => '[ENVÍO FALLIDO] No se pudo enviar el correo mediante el manejo nativo de Craft. Revisa tu configuración general de correo en Craft.',
    '[SEND FAILED] HTTP {status}: {reason}' => '[ENVÍO FALLIDO] HTTP {status}: {reason}',
    '[SEND FAILED] {error}' => '[ENVÍO FALLIDO] {error}',
    '[SEND FAILED] {reason}' => '[ENVÍO FALLIDO] {reason}',
    '[SKIPPED] Pushover user-key field is not configured on this notification.' => '[OMITIDO] El campo de clave de usuario de Pushover no está configurado en esta notificación.',
    '[SKIPPED] Recipient "{name}" cannot access the control panel.' => '[OMITIDO] El destinatario "{name}" no puede acceder al panel de control.',
    '[SKIPPED] Recipient "{name}" has no Bluesky credentials.' => '[OMITIDO] El destinatario "{name}" no tiene credenciales de Bluesky.',
    '[SKIPPED] Recipient "{name}" has no Craft user account.' => '[OMITIDO] El destinatario "{name}" no tiene una cuenta de usuario de Craft.',
    '[SKIPPED] Recipient "{name}" has no Discord webhook URL.' => '[OMITIDO] El destinatario "{name}" no tiene URL de webhook de Discord.',
    '[SKIPPED] Recipient "{name}" has no Facebook credentials.' => '[OMITIDO] El destinatario "{name}" no tiene credenciales de Facebook.',
    '[SKIPPED] Recipient "{name}" has no Instagram credentials.' => '[OMITIDO] El destinatario "{name}" no tiene credenciales de Instagram.',
    '[SKIPPED] Recipient "{name}" has no MQTT topic.' => '[OMITIDO] El destinatario "{name}" no tiene tema de MQTT.',
    '[SKIPPED] Recipient "{name}" has no Mastodon credentials.' => '[OMITIDO] El destinatario "{name}" no tiene credenciales de Mastodon.',
    '[SKIPPED] Recipient "{name}" has no Slack bot token.' => '[OMITIDO] El destinatario "{name}" no tiene token de bot de Slack.',
    '[SKIPPED] Recipient "{name}" has no Slack channel ID.' => '[OMITIDO] El destinatario "{name}" no tiene ID de canal de Slack.',
    '[SKIPPED] Recipient "{name}" has no X (Twitter) credentials.' => '[OMITIDO] El destinatario "{name}" no tiene credenciales de X (Twitter).',
    '[SKIPPED] Recipient "{name}" has no email address.' => '[OMITIDO] El destinatario "{name}" no tiene dirección de correo electrónico.',
    '[SKIPPED] Recipient "{name}" has no ntfy topic.' => '[OMITIDO] El destinatario "{name}" no tiene tema de ntfy.',
    '[SKIPPED] Recipient "{name}" has no phone number.' => '[OMITIDO] El destinatario "{name}" no tiene número de teléfono.',
    '[SKIPPED] The configured {kind} no longer exists in the plugin settings (uid: {uid}).' => '[OMITIDO] El {kind} configurado ya no existe en la configuración del plugin (uid: {uid}).',
    '[SKIPPED] Unrecognized recipient "{value}".' => '[OMITIDO] Destinatario no reconocido "{value}".',
    '[SKIPPED] Unrecognized recipient of type "{type}".' => '[OMITIDO] Destinatario de tipo no reconocido "{type}".',
    '[TOO LONG] The Discord message body exceeds the 2000-character limit.' => '[DEMASIADO LARGO] El cuerpo del mensaje de Discord supera el límite de 2000 caracteres.',
    '[TRUNCATED] Body exceeded {max} characters.' => '[TRUNCADO] El cuerpo superó los {max} caracteres.',
    '[TRUNCATED] Caption exceeded {max} characters.' => '[TRUNCADO] La descripción superó los {max} caracteres.',
];
