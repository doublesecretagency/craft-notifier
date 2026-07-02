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
    'Notifications' => 'Notificações',
    'Notification' => 'Notificação',
    'All notifications' => 'Todas as notificações',
    'Notification Log' => 'Registro de notificações',
    'Logs' => 'Registros',
    'View Notifications' => 'Ver notificações',
    'Add a New Notification' => 'Adicionar uma nova notificação',
    'notification' => 'notificação',

    // Permissions
    'View notifications' => 'Ver notificações',
    'Save notifications' => 'Salvar notificações',
    'Use the Dynamic Recipients type' => 'Usar o tipo Destinatários dinâmicos',
    'Use the Dynamic Data type' => 'Usar o tipo Dados dinâmicos',
    'Test notifications' => 'Testar notificações',
    'Send manual notifications' => 'Enviar notificações manuais',
    'Delete notifications' => 'Excluir notificações',
    'View notification log' => 'Ver registro de notificações',
    'Delete notification log' => 'Excluir registro de notificações',

    // ========================================================
    // NOTIFICATION EDITOR
    // ========================================================

    // Editor: tabs
    'Meta' => 'Meta',
    'Event' => 'Evento',
    'Message' => 'Mensagem',
    'Recipients' => 'Destinatários',

    // Event tab: type selector
    'Event Type' => 'Tipo de evento',
    'What type of event will activate the notification?' => 'Que tipo de evento ativará a notificação?',
    'Which specific event will activate the notification?' => 'Que evento específico ativará a notificação?',

    // Event tab: event types
    'Assets Event' => 'Evento de Asset',
    'Commerce Orders Event' => 'Evento de pedido Commerce',
    'Commerce Products Event' => 'Evento de produto Commerce',
    'Digital Products Event' => 'Evento Digital Products',
    'Digital Product Licenses Event' => 'Evento de licença Digital Products',
    'Solspace Calendar Event' => 'Evento Solspace Calendar',
    'Entries Event' => 'Evento de entradas',
    'Users Event' => 'Evento de usuários',
    'Ungrouped Users' => 'Usuários sem grupo',

    // Event tab: Feed
    'Feed URL' => 'URL do feed',
    'The URL of the RSS, Atom, or JSON feed to watch.' => 'A URL do feed RSS, Atom ou JSON a ser monitorado.',

    // Event tab: field conditions
    'Field Conditions' => 'Condições de campo',
    'Send the message only when the saved element matches the following conditions.' => 'Enviar a mensagem apenas quando o elemento salvo corresponder às seguintes condições.',
    'has changed' => 'foi alterado',

    // Event tab: element filters (panel chrome + common output)
    '#{elementType} Event Filters' => 'Filtros de eventos para #{elementType}',
    'No filters match this event.' => 'Nenhum filtro corresponde a este evento.',
    'Determine whether each message should be sent based on specified conditions.' => 'Determine, com base nas condições especificadas, se cada mensagem deve ser enviada.',
    'Unnamed filter' => 'Filtro sem nome',
    'Must be TRUE to send message' => 'Deve ser TRUE para enviar a mensagem',
    'Must be FALSE to send message' => 'Deve ser FALSE para enviar a mensagem',
    'No effect' => 'Sem efeito',

    // Event tab: element filter rules
    'Element is being saved for the first time' => 'O elemento está sendo salvo pela primeira vez',
    'Must be a new entry' => 'Deve ser uma nova entrada',
    'Must be an existing entry' => 'Deve ser uma entrada existente',
    'Can be existing or new' => 'Pode ser existente ou novo',
    'Element is new' => 'O elemento é novo',
    'New elements only' => 'Apenas elementos novos',
    'Existing elements only' => 'Apenas elementos existentes',
    'Element is enabled' => 'O elemento está habilitado',
    'Must be enabled' => 'Deve estar habilitado',
    'Must be disabled' => 'Deve estar desabilitado',
    'Can be enabled or disabled' => 'Pode estar habilitado ou desabilitado',
    'Element is a draft' => 'O elemento é um rascunho',
    'Must be a draft' => 'Deve ser um rascunho',
    'Must not be a draft' => 'Não pode ser um rascunho',
    'Can be a draft or non-draft' => 'Pode ser rascunho ou não',
    'Element is a provisional draft' => 'O elemento é um rascunho provisório',
    'Must be a provisional draft' => 'Deve ser um rascunho provisório',
    'Must not be a provisional draft' => 'Não pode ser um rascunho provisório',
    'Can be a provisional draft or non-provisional' => 'Pode ser provisório ou não',
    'Element is a revision' => 'O elemento é uma revisão',
    'Must be a revision' => 'Deve ser uma revisão',
    'Must not be a revision' => 'Não pode ser uma revisão',
    'Can be a revision or non-revision' => 'Pode ser revisão ou não',
    'Element is being duplicated' => 'O elemento está sendo duplicado',
    'Must be duplicating the element' => 'Deve estar duplicando o elemento',
    'Must not be duplicating the element' => 'Não pode estar duplicando o elemento',
    'Element is being propagated' => 'O elemento está sendo propagado',
    'Element must be propagating' => 'O elemento deve estar propagando',
    'Element must not be propagating' => 'O elemento não pode estar propagando',
    'Element is being bulk-resaved' => 'O elemento está sendo regravado em massa',
    'Must be bulk-resaving the element' => 'Deve estar regravando o elemento em massa',
    'Must not be bulk-resaving the element' => 'Não pode estar regravando o elemento em massa',

    // Event tab: date trigger
    'On' => 'Em',
    'days before' => 'dias antes',
    'days after' => 'dias depois',
    'Relevant Date' => 'Data relevante',
    'Send the notification relative to a chosen date.' => 'Envie a notificação em relação a uma data escolhida.',

    // Event tab: recurring schedule
    'Every' => 'A cada',
    'on' => 'na',
    'on day' => 'no dia',
    'at' => 'às',
    'Starting on' => 'A partir de',
    'Day' => 'Dia',
    'Date' => 'Data',
    'Time' => 'Hora',
    'day(s)' => 'dia(s)',
    'week(s)' => 'semana(s)',
    'month(s)' => 'mês(es)',
    'year(s)' => 'ano(s)',
    'day' => 'dia',
    'days' => 'dias',
    'week' => 'semana',
    'weeks' => 'semanas',
    'month' => 'mês',
    'months' => 'meses',
    'year' => 'ano',
    'years' => 'anos',
    'Manual only' => 'Apenas manual',
    'Scheduled sending' => 'Envio agendado',
    'Generate report on a recurring schedule' => 'Gerar relatório em um agendamento recorrente',
    'Generate report on demand' => 'Gerar relatório sob demanda',
    'Send on a Recurring Schedule' => 'Enviar em um agendamento recorrente',
    'Configure Recurring Schedule' => 'Configurar agendamento recorrente',
    'System timezone set to {timezone}' => 'Fuso horário do sistema definido como {timezone}',
    'Notifications will be sent on the following schedule...' => 'As notificações serão enviadas no seguinte agendamento...',
    '... and every {cadence} after that.' => '... e depois a cada {cadence}.',
    'On what recurring schedule should the notification be sent?' => 'Em qual agendamento recorrente a notificação deve ser enviada?',
    'Whether the message should be sent on a schedule, or only triggered manually.' => 'Se a mensagem deve ser enviada em um agendamento ou apenas acionada manualmente.',
    'The message can always be sent using the "Send system snapshot" button above.' => 'A mensagem sempre pode ser enviada usando o botão "Enviar instantâneo do sistema" acima.',
    'The message can always be sent using the "Send data report" button above.' => 'A mensagem sempre pode ser enviada usando o botão "Enviar relatório de dados" acima.',

    // Event tab: Dynamic Data snippet field
    'Twig Snippet to Determine Data' => 'Snippet Twig para determinar os dados',
    'Enter a custom Twig snippet to [determine which data will be included]({url}).' => 'Insira um snippet Twig personalizado para [determinar quais dados serão incluídos]({url}).',
    'The snippet **must** include a `{% setData %}` tag.' => 'O snippet **deve** incluir uma tag `{% setData %}`.',
    'You do not have permission to edit dynamic data.' => 'Você não tem permissão para editar dados dinâmicos.',

    // Event tab: manual trigger
    'Trigger Label' => 'Rótulo do acionador',
    'An element action label (helps to differentiate multiple triggers).' => 'Um rótulo de ação de elemento (ajuda a diferenciar vários acionadores).',
    'Send Notification' => 'Enviar notificação',

    // Message tab: type selector
    'Message Type' => 'Tipo de mensagem',
    'What type of message will be sent?' => 'Que tipo de mensagem será enviado?',
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are supported.' => 'São suportados [templates]({templatingUrl}) e [variáveis especiais]({variablesUrl}).',

    // Details sidebar: queue
    'Use Queue' => 'Usar fila',
    'Immediate' => 'Imediato',
    'Queue' => 'Fila',
    'jobs queue' => 'fila de tarefas',
    'Whether the message will be sent immediately, or added to the {link}.' => 'Se a mensagem será enviada imediatamente ou adicionada à {link}.',
    'Flash messages never use the queue.' => 'As mensagens flash nunca usam a fila.',
    'Announcements always use the queue.' => 'Os anúncios sempre usam a fila.',

    // Message tab: Email
    "User's Email Address Field" => 'Campo de endereço de e-mail do usuário',
    'Select which User field contains the recipient\'s email address.' => 'Selecione o campo de usuário que contém o endereço de e-mail do destinatário.',
    'Email Subject' => 'Assunto do e-mail',
    'Subject line of the email.' => 'Linha de assunto do e-mail.',
    'Dynamic Subject Line' => 'Linha de assunto dinâmica',
    'Email Body' => 'Corpo do e-mail',
    'Body of the email. Supports HTML.' => 'Corpo do e-mail. Compatível com HTML.',

    // Message tab: rich-text (Trix) toolbar
    'Rich Text' => 'Texto formatado',
    'Bold' => 'Negrito',
    'Italic' => 'Itálico',
    'Underline' => 'Sublinhado',
    'Strikethrough' => 'Tachado',
    'Bullets' => 'Marcadores',
    'Numbers' => 'Numeração',
    'Heading' => 'Cabeçalho',
    'Code' => 'Código',
    'Undo' => 'Desfazer',
    'Redo' => 'Refazer',

    // Message tab: SMS
    "User's Phone Number Field" => 'Campo de número de telefone do usuário',
    'Select which User field contains the recipient\'s phone number.' => 'Selecione o campo de usuário que contém o número de telefone do destinatário.',
    'SMS Message Body' => 'Corpo da mensagem SMS',
    'Body of the SMS (text message). Plain text only.' => 'Corpo do SMS (mensagem de texto). Apenas texto simples.',

    // Message tab: Announcement
    'Announcement Title' => 'Título do anúncio',
    'Heading of the announcement.' => 'Título do anúncio.',
    'Dynamic Announcement Title' => 'Título de anúncio dinâmico',
    'Announcement Message' => 'Mensagem do anúncio',
    'Body of the announcement. Supports Markdown.' => 'Corpo do anúncio. Compatível com Markdown.',

    // Message tab: Flash
    'Flash Message Type' => 'Tipo de mensagem flash',
    'Which type of flash message should appear?' => 'Que tipo de mensagem flash deve aparecer?',
    'Flash Message Title' => 'Título da mensagem flash',
    'Heading of the flash message.' => 'Título da mensagem Flash.',
    'Dynamic Flash Message Title' => 'Título da mensagem Flash dinâmica',
    'Flash Message Details' => 'Detalhes da mensagem flash',
    'Optionally include details below the heading. Supports Markdown and HTML.' => 'Opcionalmente inclua detalhes abaixo do título. Compatível com Markdown e HTML.',

    // Message tab: Pushover
    "Field containing each user's Pushover key" => 'Campo da chave Pushover do usuário',
    'Select which User field contains the recipient\'s Pushover user key.' => 'Selecione o campo de usuário que contém a chave Pushover do destinatário.',
    'Pushover Title' => 'Título Pushover',
    'Optionally include a heading above the body.' => 'Opcionalmente inclua um título acima do corpo.',
    'Dynamic Pushover Title' => 'Título Pushover dinâmico',
    'Pushover Body' => 'Corpo Pushover',
    'Body of the Pushover notification. Plain text only.' => 'Corpo da notificação Pushover. Apenas texto simples.',

    // Message tab: ntfy
    'Priority' => 'Prioridade',
    'Priority level of the ntfy message.' => 'Nível de prioridade da mensagem ntfy.',
    'Tags' => 'Tags',
    'Optionally include comma-separated [emoji shortcodes](https://docs.ntfy.sh/emojis/).' => 'Opcionalmente inclua [códigos de emoji](https://docs.ntfy.sh/emojis/) separados por vírgulas.',
    'ntfy Title' => 'Título ntfy',
    'Dynamic ntfy Title' => 'Título ntfy dinâmico',
    'ntfy Body' => 'Corpo ntfy',
    'Body of the ntfy notification.' => 'Corpo da notificação ntfy.',
    'ntfy Link URL' => 'URL do link ntfy',
    'Optionally open a URL when the notification is clicked.' => 'Opcionalmente abra uma URL quando a notificação for clicada.',
    'Enable Markdown' => 'Habilitar Markdown',
    'Whether to parse the body as Markdown in supported clients.' => 'Se o corpo deve ser renderizado como Markdown em clientes compatíveis.',
    'Regular text only' => 'Apenas texto simples',
    'Markdown enabled' => 'Markdown ativado',

    // Message tab: Slack
    'Slack Message Body' => 'Corpo da mensagem Slack',
    'Supports standard [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) syntax. Optionally supports HTML _(see below)_.' => 'Suporta a sintaxe [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) padrão. Opcionalmente suporta HTML _(ver abaixo)_.',
    'Render Message Body as HTML' => 'Renderizar corpo da mensagem como HTML',
    'Whether to only parse as [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), or additionally parse it as HTML.' => 'Analisar apenas como [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), ou também como HTML.',
    'Render Link Previews' => 'Mostrar pré-visualizações',
    'Whether Slack should unfurl link previews for URLs in the message body.' => 'Se o Slack deve exibir pré-visualizações de links para URLs no corpo da mensagem.',
    'Don\'t unfurl' => 'Não expandir',
    'Expand link previews' => 'Expandir pré-visualizações',
    'Bot Name' => 'Nome de usuário',
    'Optionally override the app\'s display name.' => 'Opcionalmente substitua o nome de exibição do app.',
    'Dynamic Bot Name' => 'Nome do bot dinâmico',
    'Bot Icon URL' => 'URL do ícone',
    'Optionally override the app\'s icon with a URL.' => 'Opcionalmente substitua o ícone do app por uma URL.',
    'Bot Emoji' => 'Emoji do ícone',
    'Optionally override the app\'s icon with an emoji. Used only when Bot Icon URL is empty.' => 'Opcionalmente substitua o ícone do app por um emoji. Usado apenas quando Bot Icon URL está vazio.',

    // Message tab: Discord
    'Discord Message Body' => 'Corpo da mensagem Discord',
    'Supports standard Markdown, and optionally HTML _(see below)_. Max 2000 characters.' => 'Suporta Markdown padrão e, opcionalmente, HTML _(ver abaixo)_. Máx. 2000 caracteres.',
    'Whether to only parse as Markdown, or additionally parse it as HTML.' => 'Analisar apenas como Markdown, ou também como HTML.',
    'Markdown only' => 'Apenas Markdown',
    'Markdown + HTML' => 'Markdown + HTML',
    'Whether Discord should unfurl link previews for URLs in the message body.' => 'Se o Discord deve exibir pré-visualizações de links para URLs no corpo da mensagem.',
    'Webhook Username' => 'Nome de usuário do webhook',
    'Optionally override the webhook\'s display name.' => 'Opcionalmente substitua o nome de exibição do webhook.',
    'Dynamic Username' => 'Nome de usuário dinâmico',
    'Webhook Avatar URL' => 'URL do avatar do webhook',
    'Optionally override the webhook\'s avatar with a URL.' => 'Opcionalmente substitua o avatar do webhook por uma URL.',

    // Message tab: Facebook
    'Message Body' => 'Corpo da mensagem',
    'The text of your Facebook post.' => 'O texto da sua publicação do Facebook.',
    'Preview Card URL' => 'URL do cartão de pré-visualização',
    'Optionally add a link to generate a preview card.' => 'Opcionalmente adicione um link para gerar um cartão de pré-visualização.',

    // Message tab: Instagram
    'Caption' => 'Legenda',
    'Image Attachment' => 'Anexo de imagem',
    'Optional caption, max 2200 characters.' => 'Legenda opcional, máx. 2200 caracteres.',

    // Message tab: X (Twitter)
    'Plain text, max 280 characters.' => 'Texto simples, máx. 280 caracteres.',

    // Message tab: Media
    'Attach an image by calling `{% setMedia %}` in a [custom Twig snippet]({url}).' => 'Anexe uma imagem chamando `{% setMedia %}` em um [snippet Twig personalizado]({url}).',

    // Message tab: Bluesky
    'Post Body' => 'Corpo da publicação',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => 'Texto simples, máximo 300 caracteres. URLs e menções `@handle.tld` viram links automaticamente.',
    'Generate Link Preview' => 'Gerar prévia do link',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => 'Gerar automaticamente um card de pré-visualização quando o corpo do post incluir uma URL.',
    'No card' => 'Sem cartão',
    'Generate preview card' => 'Gerar cartão de prévia',

    // Message tab: Mastodon
    'Plain text, max 500 characters. URLs will unfurl automatically.' => 'Texto simples, máx. 500 caracteres. As URLs se expandem automaticamente.',
    'Visibility' => 'Visibilidade',
    'Who will be able to see this post?' => 'Quem poderá ver esta publicação?',

    // Message tab: LinkedIn
    'LinkedIn' => 'LinkedIn',
    'The text of your LinkedIn post.' => 'O texto da sua publicação no LinkedIn.',

    // Message tab: MQTT
    'Payload' => 'Conteúdo',
    'The JSON or plain text message published to the MQTT topic.' => 'A mensagem JSON ou de texto simples publicada no tópico MQTT.',
    'Quality of Service' => 'Qualidade de serviço',
    'Delivery guarantee for this message.' => 'Garantia de entrega desta mensagem.',
    'Retain' => 'Reter',
    'Whether the broker keeps this as the topic\'s last message for future subscribers.' => 'Se o broker mantém esta como a última mensagem do tópico, entregando-a a futuros assinantes.',
    'Don\'t retain' => 'Não reter',

    // Recipients tab: type selector & user/group pickers
    'Recipients Type' => 'Tipo de destinatários',
    'Who will receive this message?' => 'Quem receberá esta mensagem?',
    'Add a message recipient' => 'Adicionar um destinatário',
    'Select User(s)' => 'Selecionar usuário(s)',
    'Which users will receive the message?' => 'Quais usuários receberão a mensagem?',
    'Which user groups will receive the message?' => 'Quais grupos de usuários receberão a mensagem?',

    // Recipients tab: channel pickers (ntfy, Slack, Discord, Bluesky, Mastodon, MQTT)
    'Select ntfy topic(s)' => 'Selecionar tópico(s) do ntfy',
    'Which topics should receive this message?' => 'Quais tópicos devem receber esta mensagem?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'Nenhum tópico ntfy configurado. Adicione um em [Configurações → ntfy]({url}).',
    'No ntfy topics configured. Topics can only be added in an environment that allows administrative changes.' => 'Nenhum tópico ntfy configurado. Os tópicos só podem ser adicionados em um ambiente que permita alterações administrativas.',
    'Select Slack channel(s)' => 'Selecionar canal(is) do Slack',
    'Which channels should receive this message?' => 'Quais canais devem receber esta mensagem?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Nenhum canal do Slack configurado. Adicione um em [Configurações → Slack]({url}).',
    'No Slack channels configured. Channels can only be added in an environment that allows administrative changes.' => 'Nenhum canal do Slack configurado. Os canais só podem ser adicionados em um ambiente que permita alterações administrativas.',
    'Select Discord channel(s)' => 'Selecionar canal(is) do Discord',
    'No Discord channels configured. Add one in [Settings → Discord]({url}).' => 'Nenhum canal do Discord configurado. Adicione um em [Configurações → Discord]({url}).',
    'No Discord channels configured. Channels can only be added in an environment that allows administrative changes.' => 'Nenhum canal do Discord configurado. Os canais só podem ser adicionados em um ambiente que permita alterações administrativas.',
    'Select Facebook page(s)' => 'Selecionar página(s) do Facebook',
    'Which pages should post this message?' => 'Quais páginas devem postar esta mensagem?',
    'No Facebook pages configured. Add one in [Settings → Facebook]({url}).' => 'Nenhuma página do Facebook configurada. Adicione uma em [Configurações → Facebook]({url}).',
    'No Facebook pages configured. Pages can only be added in an environment that allows administrative changes.' => 'Nenhuma página do Facebook configurada. As páginas só podem ser adicionadas em um ambiente que permita alterações administrativas.',
    'Select Instagram account(s)' => 'Selecionar conta(s) do Instagram',
    'No Instagram accounts configured. Add one in [Settings → Instagram]({url}).' => 'Nenhuma conta do Instagram configurada. Adicione uma em [Configurações → Instagram]({url}).',
    'No Instagram accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Nenhuma conta do Instagram configurada. As contas só podem ser adicionadas em um ambiente que permita alterações administrativas.',
    'Select X (Twitter) account(s)' => 'Selecionar conta(s) do X (Twitter)',
    'No X (Twitter) accounts configured. Add one in [Settings → X (Twitter)]({url}).' => 'Nenhuma conta do X (Twitter) configurada. Adicione uma em [Configurações → X (Twitter)]({url}).',
    'No X (Twitter) accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Nenhuma conta do X (Twitter) configurada. As contas só podem ser adicionadas em um ambiente que permita alterações administrativas.',
    'Select Bluesky account(s)' => 'Selecionar conta(s) Bluesky',
    'Which accounts should post this message?' => 'Quais contas devem postar esta mensagem?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Nenhuma conta Bluesky configurada. Adicione uma em [Configurações → Bluesky]({url}).',
    'No Bluesky accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Nenhuma conta Bluesky configurada. As contas só podem ser adicionadas em um ambiente que permita alterações administrativas.',
    'Select Mastodon account(s)' => 'Selecionar conta(s) Mastodon',
    'No Mastodon accounts configured. Add one in [Settings → Mastodon]({url}).' => 'Nenhuma conta Mastodon configurada. Adicione uma em [Configurações → Mastodon]({url}).',
    'No Mastodon accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Nenhuma conta Mastodon configurada. As contas só podem ser adicionadas em um ambiente que permita alterações administrativas.',
    'Select MQTT topic(s)' => 'Selecionar tópico(s) MQTT',
    'No MQTT topics configured. Add one in [Settings → MQTT]({url}).' => 'Nenhum tópico MQTT configurado. Adicione um em [Configurações → MQTT]({url}).',
    'No MQTT topics configured. Topics can only be added in an environment that allows administrative changes.' => 'Nenhum tópico MQTT configurado. Os tópicos só podem ser adicionados em um ambiente que permita alterações administrativas.',
    'Not a valid topic. Must not be empty or contain the `+` or `#` wildcards.' => 'Tópico inválido. Não pode estar vazio nem conter os curingas `+` ou `#`.',

    // Recipients tab: LinkedIn picker
    'Select LinkedIn account(s)' => 'Selecione a(s) conta(s) do LinkedIn',
    'Which page or member should post this message?' => 'Qual página ou membro deve publicar esta mensagem?',
    'No LinkedIn accounts connected. Connect one in [Settings → LinkedIn]({url}).' => 'Nenhuma conta do LinkedIn conectada. Conecte uma em [Configurações → LinkedIn]({url}).',
    'No LinkedIn accounts connected. Accounts can only be connected in an environment that allows administrative changes.' => 'Nenhuma conta do LinkedIn conectada. As contas só podem ser conectadas em um ambiente que permita alterações administrativas.',

    // Recipients tab: dynamic recipients snippet
    'Twig Snippet to Determine Recipients' => 'Trecho Twig para determinar os destinatários',
    'Enter a custom Twig snippet to [determine who will receive the message]({url}).' => 'Insira um snippet Twig personalizado para [determinar quem receberá a mensagem]({url}).',
    'The snippet **must** include a `{% setRecipients %}` tag.' => 'O snippet **deve** incluir uma tag `{% setRecipients %}`.',

    // ========================================================
    // SETTINGS
    // ========================================================

    // Settings: nav & page chrome
    'Notifier Settings' => 'Configurações Notifier',
    'General' => 'Geral',
    'Twilio' => 'Twilio',
    'Pushover' => 'Pushover',
    'ntfy' => 'ntfy',
    'Slack' => 'Slack',
    'Discord' => 'Discord',
    'Bluesky' => 'Bluesky',
    'Mastodon' => 'Mastodon',
    'MQTT' => 'MQTT',

    // Settings: nav group headings
    'Push Notifications' => 'Notificações push',
    'Chat Platforms' => 'Plataformas de chat',
    'Social Media' => 'Redes sociais',
    'Internet of Things' => 'Internet das coisas',
    'Expand {heading}' => 'Expandir {heading}',

    // Settings: shared intro lines
    'Consult the [{name} setup guide]({url}) for complete instructions.' => 'Consulte o [guia de configuração do {name}]({url}) para instruções completas.',
    'Sensitive values can be stored in your `.env` file and referenced here.' => 'Valores sensíveis podem ser armazenados no seu arquivo `.env` e referenciados aqui.',

    // Settings: Notification order
    'Notification Order' => 'Ordem das notificações',
    'Notifications can be dragged into any order on the index page. Choose where new notifications land in that order.' => 'As notificações podem ser arrastadas para uma ordem personalizada na página de índice. Escolha onde as novas notificações são adicionadas nessa ordem.',
    'Default Placement' => 'Posicionamento padrão',
    'Where new notifications are added to the list.' => 'Onde as novas notificações são adicionadas à lista.',
    'Before other notifications' => 'Antes das outras notificações',
    'After other notifications' => 'Depois das outras notificações',

    // Settings: Logging
    'Logging' => 'Registro',
    "Notifier keeps a running log of every message it sends. You usually won't need to change this, but you can limit how many log entries are kept in the database." => 'O Notifier mantém um registro contínuo das mensagens enviadas. Normalmente não é necessário, mas você pode limitar a quantidade de eventos registrados no banco de dados.',
    'Enable Logging' => 'Habilitar registro',
    'When disabled, Notifier will not write anything to the notification log.' => 'Quando desabilitado, o Notifier não escreve nada no registro de notificações.',
    'Number of days to retain log events' => 'Número de dias para reter eventos de registro',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Reter eventos de registro no máximo por estes dias. Deixe em branco para sem limite.',
    'Number of log events to retain' => 'Número de eventos de registro a reter',
    'At most, keep this many log events. Leave blank for no limit.' => 'Reter no máximo este número de eventos. Deixe em branco para sem limite.',

    // Settings: Scheduled sending
    'Scheduled Sending' => 'Envio agendado',
    'A shared secret that authenticates scheduled runs triggered over the web. You only need this if you trigger the schedule from the web endpoint.' => 'Segredo compartilhado para autenticar solicitações web de execução agendada. Necessário apenas quando o agendamento é acionado através do endpoint web.',
    'Scheduled-Run Token' => 'Token de execução agendada',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => 'Enviado em cada solicitação como o cabeçalho X-Notifier-Token ou parâmetro token no corpo.',

    // Settings: Twilio
    'Send SMS text messages through [Twilio](https://www.twilio.com).' => 'Envie mensagens de texto SMS pelo [Twilio](https://www.twilio.com).',
    'Twilio Account SID' => 'Twilio Account SID',
    'Twilio Auth Token' => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)' => 'Número de telefone Twilio (envia cada SMS)',
    'SMS Testing' => 'Testes de SMS',
    'Optional. When set, every SMS is sent to this number instead of the actual recipient.' => 'Opcional. Quando definido, todo SMS enviado será para este número em vez do destinatário resolvido.',
    'Test phone number' => 'Número de telefone de teste',

    // Settings: Pushover
    'Send push notifications through [Pushover](https://pushover.net).' => 'Envie notificações push pelo [Pushover](https://pushover.net).',
    'Application API Token' => 'Token de API do aplicativo',
    'The 30-character app token from your Pushover application.' => 'O token de aplicativo de 30 caracteres do seu aplicativo Pushover.',

    // Settings: ntfy
    'Send push notifications through [ntfy](https://ntfy.sh).' => 'Envie notificações push pelo [ntfy](https://ntfy.sh).',
    'Server URL' => 'URL do servidor',
    'Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`.' => 'Opcional, aponte para uma instância ntfy auto-hospedada (se aplicável). Padrão `https://ntfy.sh`.',
    'Access token' => 'Token de acesso',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Opcional, necessário para tópicos protegidos ou instâncias auto-hospedadas com autenticação.',
    'ntfy Topics' => 'Tópicos ntfy',
    'Add the ntfy topics you want to send to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Adicione os tópicos ntfy para os quais você deseja enviar mensagens. Cada tópico fica disponível como destinatário na aba **Destinatários** ao configurar uma notificação.',
    'Topics' => 'Tópicos',
    "Click any row's **Test** button to send a quick test message to that topic." => 'Clique no botão **Testar** de qualquer linha para enviar uma mensagem de teste rápida a esse tópico.',
    'Label' => 'Etiqueta',
    'Topic' => 'Tópico',
    'Add a topic' => 'Adicionar um tópico',

    // Settings: Slack
    'Post messages to your Slack channels.' => 'Poste mensagens nos seus canais do Slack.',
    'Channels' => 'Canais',
    "Click any row's **Test** button to send a quick test message to that channel." => 'Clique no botão **Testar** de qualquer linha para enviar uma mensagem de teste rápida a esse canal.',
    'Bot Token' => 'Token do bot',
    'Channel ID' => 'ID do canal',
    'Add a channel' => 'Adicionar um canal',
    'Not a valid Bot Token. Must start with `xoxb-`.' => 'Token do bot inválido. Deve começar com `xoxb-`.',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => 'ID de canal inválido. Deve se parecer com `C01234ABCD`.',

    // Settings: Discord
    'Post messages to your Discord channels.' => 'Poste mensagens nos seus canais do Discord.',
    'Webhook URL' => 'URL do webhook',
    'Not a valid Webhook URL. Must start with `https://discord.com/api/webhooks/`.' => 'URL de webhook inválida. Deve começar com `https://discord.com/api/webhooks/`.',

    // Settings: Facebook
    'Facebook' => 'Facebook',
    'Publish posts to your [Facebook](https://facebook.com) pages.' => 'Publique posts nas suas páginas do [Facebook](https://facebook.com).',
    'Pages' => 'Páginas',
    'Page ID' => 'Page ID',
    'Page Access Token' => 'Page Access Token',
    'Add a page' => 'Adicionar uma página',
    "Click any row's **Test** button to verify that page's credentials. No posts are made." => 'Clique no botão **Testar** de qualquer linha para verificar as credenciais dessa página. Nenhuma publicação é feita.',

    // Settings: Instagram
    'Instagram' => 'Instagram',
    'Publish posts to your [Instagram](https://instagram.com) Business accounts.' => 'Publique posts nas suas contas comerciais do [Instagram](https://instagram.com).',
    "Click any row's **Test** button to resolve the linked Instagram account. No posts are made." => 'Clique no botão **Testar** de qualquer linha para resolver a conta do Instagram vinculada. Nenhuma publicação é feita.',

    // Settings: X (Twitter)
    'X (Twitter)' => 'X (Twitter)',
    'Publish posts to your [X (Twitter)](https://x.com) accounts.' => 'Publique posts nas suas contas do [X (Twitter)](https://x.com).',
    'Consumer Key' => 'Consumer Key',
    'Consumer Key Secret' => 'Consumer Key Secret',
    'Access Token Secret' => 'Access Token Secret',

    // Settings: Bluesky
    'Publish posts to your [Bluesky](https://bsky.app) accounts.' => 'Publique posts nas suas contas do [Bluesky](https://bsky.app).',
    'PDS URL' => 'URL do PDS',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'Padrão https://bsky.social. Aponte para um PDS personalizado se sua instalação federar.',
    'Bluesky Accounts' => 'Contas Bluesky',
    'Add the Bluesky accounts you want to post from. Each account becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Adicione as contas Bluesky a partir das quais você deseja publicar. Cada conta fica disponível como destinatário na aba **Destinatários** ao configurar uma notificação.',
    'Accounts' => 'Contas',
    "Click any row's **Test** button to confirm the account authenticates." => 'Clique no botão **Testar** de qualquer linha para confirmar que a conta autentica.',
    'Handle' => 'Identificador',
    'App password' => 'Senha do aplicativo',
    'Add an account' => 'Adicionar uma conta',

    // Settings: Mastodon
    'Publish posts to your [Mastodon](https://joinmastodon.org) accounts.' => 'Publique posts nas suas contas do [Mastodon](https://joinmastodon.org).',
    'Click any row\'s **Test** button to verify that account\'s credentials. No posts are made.' => 'Clique no botão **Testar** de qualquer linha para verificar as credenciais dessa conta. Nenhuma publicação é feita.',
    'Instance URL' => 'URL da instância',
    'Access Token' => 'Token de acesso',

    // Settings: LinkedIn
    'Publish posts to your [LinkedIn](https://linkedin.com) profile.' => 'Publique no seu perfil do [LinkedIn](https://linkedin.com).',
    'The Client ID of your LinkedIn app.' => 'O ID do cliente do seu aplicativo do LinkedIn.',
    'Client Secret' => 'Segredo do cliente',
    'The Primary Client Secret of your LinkedIn app.' => 'O segredo do cliente principal do seu aplicativo do LinkedIn.',
    'Enable organization posting' => 'Ativar publicação de organização',
    'Copy this redirect URL' => 'Copie este URL de redirecionamento',
    'When configuring the LinkedIn app, <strong>copy this URL</strong> to use as an "Authorized redirect URL".' => 'Ao configurar o aplicativo do LinkedIn, <strong>copie este URL</strong> para usar como um "Authorized redirect URL".',
    'Also request access to post as organization pages you administer. Requires Community Management API approval from LinkedIn.' => 'Solicite também acesso para publicar como as páginas de organização que você administra. Requer aprovação da Community Management API pelo LinkedIn.',
    'Connections' => 'Conexões',
    'Each connection becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Cada conexão fica disponível como destinatário na aba **Destinatários** quando você configura uma notificação.',
    'Account' => 'Conta',
    'Type' => 'Tipo',
    'Status' => 'Status',
    'Organization' => 'Organização',
    'Member' => 'Membro',
    'Reconnect needed' => 'Reconexão necessária',
    'Expires' => 'Expira',
    'Connected' => 'Conectado',
    'Disconnect' => 'Desconectar',
    'No LinkedIn accounts are connected yet.' => 'Ainda não há contas do LinkedIn conectadas.',
    'Connect to LinkedIn' => 'Conectar ao LinkedIn',
    'Provide valid credentials to connect with LinkedIn.' => 'Forneça credenciais válidas para se conectar ao LinkedIn.',
    'Disconnect this LinkedIn account?' => 'Desconectar esta conta do LinkedIn?',

    // Settings: MQTT
    'Publish messages to an MQTT broker, handy for IoT and home-automation setups.' => 'Publique mensagens em um broker MQTT, útil para configurações de IoT e automação residencial.',
    'Host' => 'Host',
    'Broker hostname, without a protocol or port.' => 'Nome de host do broker, sem protocolo ou porta.',
    'Port' => 'Porta',
    'Optional. Defaults to 8883 when TLS is enabled, otherwise 1883.' => 'Opcional. O padrão é 8883 quando o TLS está habilitado; caso contrário, 1883.',
    'Use TLS' => 'Usar TLS',
    'Whether to connect to the broker over a secure TLS socket.' => 'Se deve conectar ao broker por meio de um socket TLS seguro.',
    'Username' => 'Nome de usuário',
    'Optional, for brokers that require username/password authentication.' => 'Opcional, para brokers que exigem autenticação com nome de usuário/senha.',
    'Password' => 'Senha',
    'MQTT Version' => 'Versão do MQTT',
    'Protocol version sent to the broker.' => 'Versão do protocolo enviada ao broker.',
    'Client ID' => 'ID do cliente',
    'Optional. A unique client ID is generated automatically when left blank.' => 'Opcional. Um ID de cliente exclusivo é gerado automaticamente quando deixado em branco.',
    'Mutual TLS' => 'TLS mútuo',
    'Optional. Needed for brokers that authenticate clients with certificates, such as AWS IoT Core. Enter the server file paths to your certificate files. You can use a `.env` variable or `@alias` reference.' => 'Opcional. Necessário para brokers que autenticam clientes com certificados, como o AWS IoT Core. Informe os caminhos de arquivo no servidor para os arquivos de certificado (uma variável `.env` ou referência `@alias` é permitida).',
    'CA Certificate File' => 'Arquivo de certificado da CA',
    'Path to the certificate authority (CA) file.' => 'Caminho para o arquivo da autoridade certificadora (CA).',
    'Client Certificate File' => 'Arquivo de certificado do cliente',
    'Path to the client certificate file.' => 'Caminho para o arquivo de certificado do cliente.',
    'Client Key File' => 'Arquivo de chave do cliente',
    'Path to the client private key file.' => 'Caminho para o arquivo de chave privada do cliente.',
    'MQTT Topics' => 'Tópicos MQTT',
    'Add the MQTT topics you want to publish to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Adicione os tópicos MQTT nos quais você deseja publicar. Cada tópico fica disponível como destinatário na aba **Destinatários** ao configurar uma notificação.',
    'Click any row\'s **Test** button to publish a quick test message to that topic.' => 'Clique no botão **Testar** de qualquer linha para publicar uma mensagem de teste rápida nesse tópico.',

    // ========================================================
    // MANUAL SEND & TEST
    // ========================================================

    // Manual send & test
    'Send a test message' => 'Enviar uma mensagem de teste',
    'Send a REAL test notification?\\n\\n⚠️ Uses a random sample of real data.\\n⚠️ Sends a real message via the configured channel.\\n⚠️ Delivers to the real configured recipient(s).' => 'Enviar uma notificação de teste REAL?\\n\\n⚠️ Usa uma amostra aleatória de dados reais.\\n⚠️ Envia uma mensagem real pelo canal configurado.\\n⚠️ É entregue aos destinatários reais configurados.',
    'Test' => 'Testar',
    'Send system snapshot' => 'Enviar instantâneo do sistema',
    'Send data report' => 'Enviar relatório de dados',
    'Are you sure you want to send this notification?' => 'Tem certeza de que deseja enviar esta notificação?',
    'This notification cannot be triggered manually.' => 'Esta notificação não pode ser acionada manualmente.',
    'This notification no longer applies to the selected element.' => 'Esta notificação não se aplica mais ao elemento selecionado.',

    // ========================================================
    // RUNTIME OUTPUT
    // ========================================================

    // Runtime: dispatch log feedback
    'Sending {messageType} to {recipient}.' => 'Enviando {messageType} para {recipient}.',
    'Sending "{title}".' => 'Enviando "{title}".',
    '[invalid recipient]' => '[destinatário inválido]',
    'Scanning feed {url}.' => 'Varredura do feed {url}.',
    'Adding message to queue.' => 'Adicionando mensagem à fila.',
    'Sending message immediately (bypassing queue).' => 'Enviando a mensagem imediatamente (ignorando a fila).',

    // Runtime: controller responses
    'Test notification dispatched.' => 'Notificação de teste enviada.',
    'No messages were dispatched. Check the recipient configuration.' => 'Nenhuma mensagem foi enviada. Verifique a configuração dos destinatários.',
    'Unable to send test: the feed could not be read or has no items.' => 'Não foi possível enviar o teste: o feed não pôde ser lido ou não contém itens.',
    'Unable to send test: no element matches the configured filters.' => 'Não foi possível enviar o teste: nenhum elemento corresponde aos filtros configurados.',
    "Couldn't save settings." => 'Não foi possível salvar as configurações.',
    'Settings saved.' => 'Configurações salvas.',
    'Topic is empty.' => 'O tópico está vazio.',
    'Server URL is not configured.' => 'URL do servidor não configurado.',
    'Test message from Notifier.' => 'Mensagem de teste do Notifier.',
    'HTTP {status}' => 'HTTP {status}',
    'Test message sent successfully.' => 'Mensagem de teste enviada com sucesso.',
    'Page ID and Page Access Token are required.' => 'Page ID e Page Access Token são obrigatórios.',
    'Facebook rejected the request: {error}' => 'O Facebook rejeitou a solicitação: {error}',
    'Successfully connected to "{name}". No posts were made.' => 'Conectado com sucesso a "{name}". Nenhuma publicação foi feita.',
    'No Instagram Business account is linked to this Page.' => 'Nenhuma conta comercial do Instagram está vinculada a esta página.',
    'Successfully connected to @{handle}. No posts were made.' => 'Conectado com sucesso a @{handle}. Nenhuma publicação foi feita.',
    'All four credentials are required.' => 'Todas as quatro credenciais são obrigatórias.',
    'X (Twitter) rejected the request: {error}' => 'O X (Twitter) rejeitou a solicitação: {error}',
    'Successfully authenticated as @{username}. No posts were made.' => 'Autenticado com sucesso como @{username}. Nenhuma publicação foi feita.',
    'Handle and app password are required.' => 'O identificador e a senha do aplicativo são obrigatórios.',
    'Authentication failed.' => 'Falha de autenticação.',
    'Successfully authenticated. No messages were posted.' => 'Autenticação bem-sucedida. Nenhuma mensagem foi publicada.',
    'Log events deleted.' => 'Eventos de registro excluídos.',
    'Notification sent.' => 'Notificação enviada.',
    'Notification was not sent. Check the Notification Log for details.' => 'A notificação não foi enviada. Consulte o Registro de notificações para mais detalhes.',
    'Instance URL and access token are required.' => 'A URL da instância e o token de acesso são obrigatórios.',
    'Mastodon rejected the request: {error}' => 'O Mastodon rejeitou a solicitação: {error}',
    'Successfully authenticated as @{handle}. No posts were made.' => 'Autenticado com sucesso como @{handle}. Nenhuma publicação foi feita.',
    'Broker host is not configured.' => 'O host do broker não está configurado.',

    // Runtime: LinkedIn connect flow
    'Add your LinkedIn app credentials before connecting.' => 'Adicione as credenciais do seu aplicativo do LinkedIn antes de conectar.',
    'LinkedIn authorization failed: {error}' => 'Falha na autorização do LinkedIn: {error}',
    'LinkedIn authorization failed: invalid state.' => 'Falha na autorização do LinkedIn: estado inválido.',
    'LinkedIn authorization failed: no code returned.' => 'Falha na autorização do LinkedIn: nenhum código retornado.',
    'Connected to LinkedIn.' => 'Conectado ao LinkedIn.',
    'Disconnected from LinkedIn.' => 'Desconectado do LinkedIn.',

    // Outbound: per-channel send results
    'Successfully sent an email to {name}.' => 'E-mail enviado com sucesso para {name}.',
    'Successfully sent an SMS message to {name}.' => 'SMS enviado com sucesso para {name}.',
    'Successfully sent a Pushover notification to {name}.' => 'Notificação Pushover enviada com sucesso para {name}.',
    'Successfully posted an announcement for {name}.' => 'Anúncio postado com sucesso para {name}.',
    'Successfully sent a flash message to {name}.' => 'Mensagem flash enviada com sucesso para {name}.',
    'Successfully posted to Slack in channel "{label}".' => 'Publicado com sucesso no Slack no canal "{label}".',
    'Successfully posted to Discord in channel "{label}".' => 'Publicado com sucesso no Discord no canal "{label}".',
    'Successfully posted to Facebook as "{label}" account.' => 'Publicado com sucesso no Facebook como conta "{label}".',
    'Successfully posted to Instagram as "{label}" account.' => 'Publicado com sucesso no Instagram como conta "{label}".',
    'Successfully posted to X (Twitter) as "{label}" account.' => 'Publicado com sucesso no X (Twitter) como conta "{label}".',
    'Successfully posted to Bluesky as "{label}" account.' => 'Publicado com sucesso no Bluesky como conta "{label}".',
    'Successfully posted to Mastodon as "{label}" account.' => 'Publicado com sucesso no Mastodon como conta "{label}".',
    'Successfully posted to LinkedIn as "{label}" account.' => 'Publicado com sucesso no LinkedIn como conta "{label}".',
    'Successfully sent ntfy message to topic "{topic}".' => 'Mensagem ntfy enviada com sucesso para o tópico "{topic}".',
    'Slack rejected the message: {error}' => 'O Slack rejeitou a mensagem: {error}',
    'Discord rejected the message: {error}' => 'O Discord rejeitou a mensagem: {error}',
    'the attached image could not be read' => 'a imagem anexada não pôde ser lida',
    'Successfully sent MQTT message to topic "{topic}".' => 'Mensagem MQTT enviada para o tópico "{topic}".',

    // Outbound: LinkedIn send results & skips
    '[EMPTY BODY] The LinkedIn post body is empty.' => '[EMPTY BODY] O corpo da publicação do LinkedIn está vazio.',
    '[NO RECIPIENT] No LinkedIn connection was specified.' => '[NO RECIPIENT] Nenhuma conexão do LinkedIn foi especificada.',
    '[RECONNECT REQUIRED] {reason}' => '[RECONNECT REQUIRED] {reason}',
    '[REJECTED BY LINKEDIN] {error}' => '[REJECTED BY LINKEDIN] {error}',
    'LinkedIn app credentials are not configured.' => 'As credenciais do aplicativo do LinkedIn não estão configuradas.',
    'The LinkedIn access token has expired. Please reconnect.' => 'O token de acesso do LinkedIn expirou. Conecte novamente.',
    'The LinkedIn connection no longer exists.' => 'A conexão do LinkedIn não existe mais.',
    'My LinkedIn Profile' => 'Meu perfil do LinkedIn',
    '[SKIPPED] Recipient "{name}" has no LinkedIn connection.' => '[SKIPPED] O destinatário "{name}" não tem conexão do LinkedIn.',
    '[SKIPPED] The configured LinkedIn connection no longer exists (uid: {uid}).' => '[SKIPPED] A conexão do LinkedIn configurada não existe mais (uid: {uid}).',

    // Media attachments
    'Videos are not yet supported on {channel}.' => 'Os vídeos ainda não são compatíveis no {channel}.',
    'The image could not be resized to fit.' => 'Não foi possível redimensionar a imagem para caber.',
    'The image could not be read.' => 'Não foi possível ler a imagem.',
    'The image failed to upload.' => 'Falha ao enviar a imagem.',
    'The upload response had no media ID.' => 'A resposta de envio não continha nenhum ID de mídia.',
    'The upload response had no blob.' => 'A resposta de envio não continha nenhum blob.',
    '[NOT ATTACHED] Unable to attach image. {reason}' => '[NÃO ANEXADO] Não foi possível anexar a imagem. {reason}',

    // Recipient warnings
    '[SKIPPED] User "{name}" has no Pushover key.' => '[IGNORADO] O usuário "{name}" não tem chave Pushover.',

    // Errors & exceptions
    'Invalid element event: {class}' => 'Evento de elemento inválido: {class}',
    'Invalid notification ID: {id}' => 'ID de notificação inválido: {id}',
    'Invalid email message mode.' => 'Modo de mensagem de e-mail inválido.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Você não tem permissão para usar o tipo Destinatários dinâmicos.',
    'Invalid settings section: {section}' => 'Seção de configurações inválida: {section}',
    'User not authorized to save this notification.' => 'O usuário não tem autorização para salvar esta notificação.',
    'User not authorized to view this notification.' => 'O usuário não tem autorização para visualizar esta notificação.',
    'User not authorized to delete this notification.' => 'O usuário não tem autorização para excluir esta notificação.',
    'Notification not found' => 'Notificação não encontrada',
    'Element not found' => 'Elemento não encontrado',
    'You do not have permission to use the Dynamic Data type.' => 'Você não tem permissão para usar o tipo Dados dinâmicos.',
    '[NO DATA] The Dynamic Data snippet did not call the {tag} tag.' => '[SEM DADOS] O snippet Twig não chamou a tag {tag}.',

    // Config-file override note
    'This is being set in the config file. [{file}]' => 'Isto está sendo definido no arquivo de configuração. [{file}]',

    // ========================================================
    // JAVASCRIPT UI
    // ========================================================

    // JavaScript: log utility & buttons
    'Test notification failed.' => 'Falha na notificação de teste.',
    'Unable to get the notification, something went wrong.' => 'Não foi possível obter a notificação, algo deu errado.',
    'Something went wrong.' => 'Algo deu errado.',
    'Invalid notification ID.' => 'ID de notificação inválido.',
    'Unable to delete the log event, something went wrong.' => 'Não foi possível excluir o evento de registro, algo deu errado.',
    'Log event deleted.' => 'Evento de registro excluído.',
    'Unable to delete log events, something went wrong.' => 'Não foi possível excluir os eventos de registro, algo deu errado.',
    'Are you sure you want to delete all logs from {date}?' => 'Tem certeza de que deseja excluir todos os registros de {date}?',
    // Reworded outbound + dispatch log messages
    '[BAD CREDENTIALS] Missing app token. [Configure Pushover]({url}).' => '[CREDENCIAIS INVÁLIDAS] Token do app ausente. [Configurar o Pushover]({url}).',
    '[BAD CREDENTIALS] Missing {missing}. [Configure Twilio]({url}).' => '[CREDENCIAIS INVÁLIDAS] Falta {missing}. [Configurar o Twilio]({url}).',
    '[BAD CREDENTIALS] No Discord webhook URL is configured.' => '[CREDENCIAIS INVÁLIDAS] Nenhum URL de webhook do Discord está configurado.',
    '[BAD CREDENTIALS] No MQTT broker host is configured.' => '[CREDENCIAIS INVÁLIDAS] Nenhum host de broker MQTT está configurado.',
    '[BAD CREDENTIALS] No Mastodon access token is configured.' => '[CREDENCIAIS INVÁLIDAS] Nenhum token de acesso do Mastodon está configurado.',
    '[BAD CREDENTIALS] No Mastodon instance URL is configured.' => '[CREDENCIAIS INVÁLIDAS] Nenhum URL de instância do Mastodon está configurado.',
    '[BAD CREDENTIALS] No Slack bot token is configured.' => '[CREDENCIAIS INVÁLIDAS] Nenhum token de bot do Slack está configurado.',
    '[BAD CREDENTIALS] No Twilio phone number is configured.' => '[CREDENCIAIS INVÁLIDAS] Nenhum número de telefone do Twilio está configurado.',
    '[BAD CREDENTIALS] The recipient is missing Bluesky credentials.' => '[CREDENCIAIS INVÁLIDAS] O destinatário não tem as credenciais do Bluesky.',
    '[BAD CREDENTIALS] The recipient is missing Facebook credentials.' => '[CREDENCIAIS INVÁLIDAS] O destinatário não tem as credenciais do Facebook.',
    '[BAD CREDENTIALS] The recipient is missing X (Twitter) credentials.' => '[CREDENCIAIS INVÁLIDAS] O destinatário não tem as credenciais do X (Twitter).',
    '[BAD CREDENTIALS] Unable to post, recipient is missing credentials.' => '[CREDENCIAIS INVÁLIDAS] Não é possível publicar; o destinatário não tem credenciais.',
    '[EMPTY BODY] The Discord message body is empty.' => '[CORPO VAZIO] O corpo da mensagem do Discord está vazio.',
    '[EMPTY BODY] The Facebook post body is empty.' => '[CORPO VAZIO] O corpo da publicação do Facebook está vazio.',
    '[EMPTY BODY] The MQTT payload is empty.' => '[CORPO VAZIO] A carga útil MQTT está vazio.',
    '[EMPTY BODY] The Mastodon post body is empty.' => '[CORPO VAZIO] O corpo da publicação do Mastodon está vazio.',
    '[EMPTY BODY] The Slack message body is empty.' => '[CORPO VAZIO] O corpo da mensagem do Slack está vazio.',
    '[EMPTY BODY] The X (Twitter) post body is empty.' => '[CORPO VAZIO] O corpo da publicação no X (Twitter) está vazio.',
    '[EMPTY BODY] The email message body was empty.' => '[CORPO VAZIO] O corpo do e-mail estava vazio.',
    '[FEED ERROR] Could not fetch the feed: {message}' => '[ERRO DE FEED] Não foi possível obter o feed: {message}',
    '[FEED ERROR] Could not parse the feed.' => '[ERRO DE FEED] Não foi possível analisar o feed.',
    '[FEED ERROR] Could not parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => '[ERRO DE FEED] Não foi possível analisar o feed. As extensões PHP `simplexml` e `libxml` são obrigatórias.',
    '[FEED ERROR] Initial feed scan failed: {message}' => '[ERRO DE FEED] A varredura inicial do feed falhou: {message}',
    '[INVALID NUMBER] The recipient phone number is invalid.' => '[NÚMERO INVÁLIDO] O número de telefone do destinatário é inválido.',
    '[INVALID TYPE] The flash message type is invalid.' => '[TIPO INVÁLIDO] O tipo de mensagem flash é inválido.',
    '[LINK PREVIEW SKIPPED] {reason}' => '[PRÉVIA DE LINK IGNORADA] {reason}',
    '[MISSING IMAGE] Image Attachment field never called the {tag} tag.' => '[IMAGEM AUSENTE] O campo Anexo de imagem nunca invocou a tag {tag}.',
    '[MISSING IMAGE] Image Attachment field was empty.' => '[IMAGEM AUSENTE] O campo Anexo de imagem estava vazio.',
    '[MISSING IMAGE] The {tag} tag was called, but returned an invalid image.' => '[IMAGEM AUSENTE] A tag {tag} foi invocada, mas retornou uma imagem inválida.',
    '[MISSING IMAGE] Unable to send Instagram post, the image needs a public URL.' => '[IMAGEM AUSENTE] Não é possível enviar a publicação do Instagram; a imagem precisa de um URL público.',
    '[NO CALENDAR] No calendars are selected, this notification will never be triggered.' => '[SEM CALENDÁRIO] Nenhum calendário foi selecionado, esta notificação nunca será acionada.',
    '[NO DIGITAL PRODUCT TYPE] No digital product types are selected, this notification will never be triggered.' => '[SEM TIPO DE PRODUTO DIGITAL] Nenhum tipo de produto digital foi selecionado, esta notificação nunca será acionada.',
    '[NO ENTRY TYPE] No sections or entry types are selected, this notification will never be triggered.' => '[SEM TIPO DE ENTRADA] Nenhuma seção ou tipo de entrada foi selecionado, esta notificação nunca será acionada.',
    '[NO PRODUCT TYPE] No product types are selected, this notification will never be triggered.' => '[SEM TIPO DE PRODUTO] Nenhum tipo de produto foi selecionado, esta notificação nunca será acionada.',
    '[NO USER GROUP] No user groups are selected, this notification will never be triggered.' => '[SEM GRUPO DE USUÁRIOS] Nenhum grupo de usuários foi selecionado, esta notificação nunca será acionada.',
    '[NO VOLUME] No volumes are selected, this notification will never be triggered.' => '[SEM VOLUME] Nenhum volume foi selecionado, esta notificação nunca será acionada.',
    '[NO MEDIA] No image was attached because the {tag} tag was never invoked in the Image Attachment field.' => '[SEM MÍDIA] Nenhuma imagem foi anexada porque a tag {tag} nunca foi invocada no campo Anexo de imagem.',
    '[NO RECIPIENTS] The Dynamic Recipients snippet did not call setRecipients.' => '[SEM DESTINATÁRIOS] O snippet de destinatários dinâmicos não chamou setRecipients.',
    '[NO RECIPIENTS] setRecipients was called with an empty value.' => '[SEM DESTINATÁRIOS] setRecipients foi chamado com um valor vazio.',
    '[NO RECIPIENT] No MQTT topic was specified.' => '[SEM DESTINATÁRIO] Nenhum tópico MQTT foi especificado.',
    '[NO RECIPIENT] No Slack channel ID was specified.' => '[SEM DESTINATÁRIO] Nenhum ID de canal do Slack foi especificado.',
    '[NO RECIPIENT] No ntfy topic was specified.' => '[SEM DESTINATÁRIO] Nenhum tópico do ntfy foi especificado.',
    '[NO RECIPIENT] No recipient user was specified for the announcement.' => '[SEM DESTINATÁRIO] Nenhum usuário destinatário foi especificado para o aviso.',
    '[NO RECIPIENT] No recipient was specified for the email.' => '[SEM DESTINATÁRIO] Nenhum destinatário foi especificado para o e-mail.',
    '[NO RECIPIENT] The recipient has no Pushover user key.' => '[SEM DESTINATÁRIO] O destinatário não tem chave de usuário do Pushover.',
    '[NO RECIPIENT] The recipient has no phone number.' => '[SEM DESTINATÁRIO] O destinatário não tem número de telefone.',
    '[REJECTED BY DISCORD] {error}' => '[REJEITADO POR DISCORD] {error}',
    '[REJECTED BY FACEBOOK] {error}' => '[REJEITADO POR FACEBOOK] {error}',
    '[REJECTED BY INSTAGRAM] {error}' => '[REJEITADO POR INSTAGRAM] {error}',
    '[REJECTED BY MASTODON] {error}' => '[REJEITADO POR MASTODON] {error}',
    '[REJECTED BY SLACK] {error}' => '[REJEITADO POR SLACK] {error}',
    '[REJECTED BY X (TWITTER)] {error}' => '[REJEITADO POR X (TWITTER)] {error}',
    '[SEND FAILED] Authentication failed for {handle}: {reason}' => '[FALHA NO ENVIO] Falha na autenticação de {handle}: {reason}',
    '[SEND FAILED] Authentication failed: {reason}' => '[FALHA NO ENVIO] Falha na autenticação: {reason}',
    "[SEND FAILED] Could not send the email using Craft's native handling. Check your general email settings within Craft." => '[FALHA NO ENVIO] Não foi possível enviar o e-mail usando o tratamento nativo do Craft. Verifique as configurações gerais de e-mail no Craft.',
    '[SEND FAILED] HTTP {status}: {reason}' => '[FALHA NO ENVIO] HTTP {status}: {reason}',
    '[SEND FAILED] {error}' => '[FALHA NO ENVIO] {error}',
    '[SEND FAILED] {reason}' => '[FALHA NO ENVIO] {reason}',
    '[SKIPPED] Pushover user-key field is not configured on this notification.' => '[IGNORADO] O campo de chave de usuário do Pushover não está configurado nesta notificação.',
    '[SKIPPED] Recipient "{name}" cannot access the control panel.' => '[IGNORADO] O destinatário "{name}" não pode acessar o painel de controle.',
    '[SKIPPED] Recipient "{name}" has no Bluesky credentials.' => '[IGNORADO] O destinatário "{name}" não tem as credenciais do Bluesky.',
    '[SKIPPED] Recipient "{name}" has no Craft user account.' => '[IGNORADO] O destinatário "{name}" não tem uma conta de usuário do Craft.',
    '[SKIPPED] Recipient "{name}" has no Discord webhook URL.' => '[IGNORADO] O destinatário "{name}" não tem URL de webhook do Discord.',
    '[SKIPPED] Recipient "{name}" has no Facebook credentials.' => '[IGNORADO] O destinatário "{name}" não tem as credenciais do Facebook.',
    '[SKIPPED] Recipient "{name}" has no Instagram credentials.' => '[IGNORADO] O destinatário "{name}" não tem as credenciais do Instagram.',
    '[SKIPPED] Recipient "{name}" has no MQTT topic.' => '[IGNORADO] O destinatário "{name}" não tem tópico MQTT.',
    '[SKIPPED] Recipient "{name}" has no Mastodon credentials.' => '[IGNORADO] O destinatário "{name}" não tem as credenciais do Mastodon.',
    '[SKIPPED] Recipient "{name}" has no Slack bot token.' => '[IGNORADO] O destinatário "{name}" não tem token de bot do Slack.',
    '[SKIPPED] Recipient "{name}" has no Slack channel ID.' => '[IGNORADO] O destinatário "{name}" não tem ID de canal do Slack.',
    '[SKIPPED] Recipient "{name}" has no X (Twitter) credentials.' => '[IGNORADO] O destinatário "{name}" não tem as credenciais do X (Twitter).',
    '[SKIPPED] Recipient "{name}" has no email address.' => '[IGNORADO] O destinatário "{name}" não tem endereço de e-mail.',
    '[SKIPPED] Recipient "{name}" has no ntfy topic.' => '[IGNORADO] O destinatário "{name}" não tem tópico do ntfy.',
    '[SKIPPED] Recipient "{name}" has no phone number.' => '[IGNORADO] O destinatário "{name}" não tem número de telefone.',
    '[SKIPPED] The configured {kind} no longer exists in the plugin settings (uid: {uid}).' => '[IGNORADO] O {kind} configurado não existe mais nas configurações do plugin (uid: {uid}).',
    '[SKIPPED] Unrecognized recipient "{value}".' => '[IGNORADO] Destinatário não reconhecido "{value}".',
    '[SKIPPED] Unrecognized recipient of type "{type}".' => '[IGNORADO] Destinatário de tipo não reconhecido "{type}".',
    '[TOO LONG] The Discord message body exceeds the 2000-character limit.' => '[MUITO LONGO] O corpo da mensagem do Discord excede o limite de 2000 caracteres.',
    '[TRUNCATED] Body exceeded {max} characters.' => '[TRUNCADO] O corpo excedeu {max} caracteres.',
    '[TRUNCATED] Caption exceeded {max} characters.' => '[TRUNCADO] A legenda excedeu {max} caracteres.',
];
