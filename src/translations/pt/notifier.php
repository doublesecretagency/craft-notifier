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
    'Notifications' => 'Notificações',
    'Notification' => 'Notificação',
    'All notifications' => 'Todas as notificações',
    'Notification Log' => 'Registo de notificações',
    'Logs' => 'Registos',
    'View Notifications' => 'Ver notificações',
    'Add a New Notification' => 'Adicionar uma nova notificação',
    'notification' => 'notificação',

    // Permissions
    'View notifications' => 'Ver notificações',
    'Save notifications' => 'Guardar notificações',
    'Use the Dynamic Recipients type' => 'Utilizar o tipo Destinatários dinâmicos',
    'Use the Dynamic Data type' => 'Usar o tipo Dados dinâmicos',
    'Test notifications' => 'Testar notificações',
    'Send manual notifications' => 'Enviar notificações manuais',
    'Delete notifications' => 'Eliminar notificações',
    'View notification log' => 'Ver registo de notificações',
    'Delete notification log' => 'Eliminar registo de notificações',

    // ============================================================
    // NOTIFICATION EDITOR
    // ============================================================

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
    'Commerce Orders Event' => 'Evento de encomenda Commerce',
    'Commerce Products Event' => 'Evento de produto Commerce',
    'Digital Products Event' => 'Evento Digital Products',
    'Digital Product Licenses Event' => 'Evento de licença Digital Products',
    'Solspace Calendar Event' => 'Evento Solspace Calendar',
    'Entries Event' => 'Evento de entradas',
    'Users Event' => 'Evento de utilizadores',
    'Ungrouped Users' => 'Utilizadores sem grupo',

    // Event tab: Feed
    'Feed URL' => 'URL do feed',
    'The URL of the RSS, Atom, or JSON feed to watch.' => 'O URL do feed RSS, Atom ou JSON a monitorizar.',

    // Event tab: field conditions
    'Field Conditions' => 'Condições de campo',
    'Send the message only when the saved element matches the following conditions.' => 'Enviar a mensagem apenas quando o elemento guardado corresponder às condições seguintes.',
    'has changed' => 'foi alterado',

    // Event tab: element filters (panel chrome + common output)
    '#{elementType} Event Filters' => 'Filtros de eventos para #{elementType}',
    'No filters match this event.' => 'Nenhum filtro corresponde a este evento.',
    'Determine whether each message should be sent based on specified conditions.' => 'Determine, com base nas condições especificadas, se cada mensagem deve ser enviada.',
    'Unnamed filter' => 'Filtro sem nome',
    'Must be TRUE to send message' => 'Tem de ser TRUE para enviar a mensagem',
    'Must be FALSE to send message' => 'Tem de ser FALSE para enviar a mensagem',
    'No effect' => 'Sem efeito',

    // Event tab: element filter rules
    'Element is being saved for the first time' => 'O elemento está a ser guardado pela primeira vez',
    'Must be a new entry' => 'Tem de ser uma nova entrada',
    'Must be an existing entry' => 'Tem de ser uma entrada existente',
    'Can be existing or new' => 'Pode ser existente ou novo',
    'Element is new' => 'O elemento é novo',
    'New elements only' => 'Apenas elementos novos',
    'Existing elements only' => 'Apenas elementos existentes',
    'Element is enabled' => 'O elemento está ativado',
    'Must be enabled' => 'Tem de estar ativado',
    'Must be disabled' => 'Tem de estar desativado',
    'Can be enabled or disabled' => 'Pode estar ativado ou desativado',
    'Element is a draft' => 'O elemento é um rascunho',
    'Must be a draft' => 'Tem de ser um rascunho',
    'Must not be a draft' => 'Não pode ser um rascunho',
    'Can be a draft or non-draft' => 'Pode ser rascunho ou não',
    'Element is a provisional draft' => 'O elemento é um rascunho provisório',
    'Must be a provisional draft' => 'Tem de ser um rascunho provisório',
    'Must not be a provisional draft' => 'Não pode ser um rascunho provisório',
    'Can be a provisional draft or non-provisional' => 'Pode ser provisório ou não',
    'Element is a revision' => 'O elemento é uma revisão',
    'Must be a revision' => 'Tem de ser uma revisão',
    'Must not be a revision' => 'Não pode ser uma revisão',
    'Can be a revision or non-revision' => 'Pode ser revisão ou não',
    'Element is being duplicated' => 'O elemento está a ser duplicado',
    'Must be duplicating the element' => 'Tem de estar a duplicar o elemento',
    'Must not be duplicating the element' => 'Não pode estar a duplicar o elemento',
    'Element is being propagated' => 'O elemento está a ser propagado',
    'Element must be propagating' => 'O elemento tem de estar a propagar',
    'Element must not be propagating' => 'O elemento não pode estar a propagar',
    'Element is being bulk-resaved' => 'O elemento está a ser regravado em massa',
    'Must be bulk-resaving the element' => 'Tem de estar a regravar o elemento em massa',
    'Must not be bulk-resaving the element' => 'Não pode estar a regravar o elemento em massa',

    // Event tab: date trigger
    'On' => 'Em',
    'days before' => 'dias antes',
    'days after' => 'dias depois',
    'Relevant Date' => 'Data relevante',
    'Send the notification relative to a chosen date.' => 'Envie a notificação em relação a uma data escolhida.',

    // Event tab: recurring schedule
    'Every' => 'A cada',
    'on' => 'à',
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
    'On a recurring schedule' => 'Segundo um agendamento recorrente',
    'On demand' => 'A pedido',
    'Send on a Recurring Schedule' => 'Enviar segundo um agendamento recorrente',
    'Configure Recurring Schedule' => 'Configurar agendamento recorrente',
    'System timezone set to {timezone}' => 'Fuso horário do sistema definido para {timezone}',
    'Notifications will be sent on the following schedule...' => 'As notificações serão enviadas segundo o seguinte agendamento...',
    '... and every {cadence} after that.' => '... e depois a cada {cadence}.',
    'On what recurring schedule should the notification be sent?' => 'Segundo que agendamento recorrente deve a notificação ser enviada?',
    'Whether the message should be sent on a schedule, or only triggered manually.' => 'Se a mensagem deve ser enviada segundo um agendamento ou apenas acionada manualmente.',
    'The message can always be sent using the "Send system snapshot" button above.' => 'A mensagem pode sempre ser enviada com o botão "Enviar instantâneo do sistema" acima.',
    'The message can always be sent using the "Send data report" button above.' => 'A mensagem pode sempre ser enviada com o botão "Enviar relatório de dados" acima.',

    // Event tab: Dynamic Data snippet field
    'Twig Snippet to Determine Data' => 'Fragmento Twig para determinar os dados',
    'Enter a custom Twig snippet to [determine which data will be included]({url}).' => 'Introduza um snippet Twig personalizado para [determinar que dados serão incluídos]({url}).',
    'The snippet **must** include a `{% setData %}` tag.' => 'O snippet **deve** incluir uma etiqueta `{% setData %}`.',
    'You do not have permission to edit dynamic data.' => 'Não tem permissão para editar dados dinâmicos.',

    // Event tab: manual trigger
    'Trigger Label' => 'Rótulo do acionador',
    'An element action label (helps to differentiate multiple triggers).' => 'Um rótulo de ação de elemento (ajuda a diferenciar vários acionadores).',
    'Send Notification' => 'Enviar notificação',

    // Message tab: type selector & queue
    'Message Type' => 'Tipo de mensagem',
    'What type of message will be sent?' => 'Que tipo de mensagem será enviado?',
    'Send Message via Queue' => 'Enviar mensagem através da fila',
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are also supported.' => 'Também são suportados [templates]({templatingUrl}) e [variáveis especiais]({variablesUrl}).',
    'Send immediately' => 'Enviar de imediato',
    'Add to queue' => 'Adicionar à fila',
    'Whether the message should be sent via the [jobs queue]({queueUrl}).' => 'Se a mensagem deve ser enviada através da [fila de tarefas]({queueUrl}).',

    // Message tab: Email
    "User's Email Address Field" => 'Campo de endereço de e-mail do utilizador',
    'Select which User field contains the recipient\'s email address.' => 'Selecione o campo de utilizador que contém o endereço de e-mail do destinatário.',
    'Email Subject' => 'Assunto do e-mail',
    'Subject line of the email.' => 'Assunto do e-mail.',
    'Dynamic Subject Line' => 'Linha de assunto dinâmica',
    'Email Body' => 'Corpo do e-mail',
    'Body of the email. Supports HTML.' => 'Corpo do e-mail. Compatível com HTML.',

    // Message tab: rich-text (Trix) toolbar
    'Rich Text' => 'Texto formatado',
    'Bold' => 'Negrito',
    'Italic' => 'Itálico',
    'Underline' => 'Sublinhado',
    'Strikethrough' => 'Rasurado',
    'Bullets' => 'Marcadores',
    'Numbers' => 'Numeração',
    'Heading' => 'Cabeçalho',
    'Code' => 'Código',
    'Undo' => 'Anular',
    'Redo' => 'Refazer',

    // Message tab: SMS
    "User's Phone Number Field" => 'Campo de número de telefone do utilizador',
    'Select which User field contains the recipient\'s phone number.' => 'Selecione o campo de utilizador que contém o número de telefone do destinatário.',
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
    "Field containing each user's Pushover key" => 'Campo da chave Pushover do utilizador',
    'Select which User field contains the recipient\'s Pushover user key.' => 'Selecione o campo de utilizador que contém a chave Pushover do destinatário.',
    'Pushover Title' => 'Título Pushover',
    'Optionally include a heading above the body.' => 'Opcionalmente inclua um título acima do corpo.',
    'Dynamic Pushover Title' => 'Título Pushover dinâmico',
    'Pushover Body' => 'Corpo Pushover',
    'Body of the Pushover notification. Plain text only.' => 'Corpo da notificação Pushover. Apenas texto simples.',

    // Message tab: ntfy
    'Priority' => 'Prioridade',
    'Priority level of the ntfy message.' => 'Nível de prioridade da mensagem ntfy.',
    'Tags' => 'Etiquetas',
    'Optionally include comma-separated [emoji shortcodes](https://docs.ntfy.sh/emojis/).' => 'Opcionalmente inclua [códigos de emoji](https://docs.ntfy.sh/emojis/) separados por vírgulas.',
    'ntfy Title' => 'Título ntfy',
    'Dynamic ntfy Title' => 'Título ntfy dinâmico',
    'ntfy Body' => 'Corpo ntfy',
    'Body of the ntfy notification.' => 'Corpo da notificação ntfy.',
    'ntfy Link URL' => 'URL da ligação ntfy',
    'Optionally open a URL when the notification is clicked.' => 'Opcionalmente abra um URL quando a notificação for clicada.',
    'Enable Markdown' => 'Ativar Markdown',
    'Whether to parse the body as Markdown in supported clients.' => 'Se o corpo deve ser interpretado como Markdown em clientes compatíveis.',
    'Regular text only' => 'Apenas texto simples',
    'Markdown enabled' => 'Markdown ativado',

    // Message tab: Slack
    'Slack Message Body' => 'Corpo da mensagem Slack',
    'Supports standard [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) syntax. Optionally supports HTML _(see below)_.' => 'Suporta a sintaxe [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) padrão. Opcionalmente suporta HTML _(ver abaixo)_.',
    'Render Message Body as HTML' => 'Renderizar corpo da mensagem como HTML',
    'Whether to only parse as [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), or additionally parse it as HTML.' => 'Analisar apenas como [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), ou também como HTML.',
    'mrkdwn only' => 'apenas mrkdwn',
    'mrkdwn + HTML' => 'mrkdwn + HTML',
    'Render Link Previews' => 'Mostrar pré-visualizações',
    'Whether Slack should unfurl link previews for URLs in the message body.' => 'Se o Slack deve apresentar pré-visualizações de ligações para URLs no corpo da mensagem.',
    'Don\'t unfurl' => 'Não expandir',
    'Expand link previews' => 'Expandir pré-visualizações',
    'Bot Name' => 'Nome de utilizador',
    'Optionally override the app\'s display name.' => 'Opcionalmente substitua o nome de apresentação da aplicação.',
    'Dynamic Bot Name' => 'Nome do bot dinâmico',
    'Bot Icon URL' => 'URL do ícone',
    'Optionally override the app\'s icon with a URL.' => 'Opcionalmente substitua o ícone da aplicação por um URL.',
    'Bot Emoji' => 'Emoji do ícone',
    'Optionally override the app\'s icon with an emoji. Used only when Bot Icon URL is empty.' => 'Opcionalmente substitua o ícone da aplicação por um emoji. Utilizado apenas quando Bot Icon URL está vazio.',

    // Message tab: Bluesky
    'Post Body' => 'Corpo da publicação',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => 'Texto simples, máximo 300 caracteres. URLs e menções `@handle.tld` são transformadas em links automaticamente.',
    'Generate Link Preview' => 'Gerar pré-visualização da ligação',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => 'Gerar automaticamente um cartão de pré-visualização quando o corpo do post incluir um URL.',
    'No card' => 'Sem cartão',
    'Generate preview card' => 'Gerar cartão de pré-visualização',

    // Recipients tab: type selector & user/group pickers
    'Recipients Type' => 'Tipo de destinatários',
    'Who will receive this message?' => 'Quem receberá esta mensagem?',
    'Add a message recipient' => 'Adicionar um destinatário',
    'Select User(s)' => 'Selecionar utilizador(es)',
    'Which users will receive the message?' => 'Que utilizadores receberão a mensagem?',
    'Which user groups will receive the message?' => 'Que grupos de utilizadores receberão a mensagem?',

    // Recipients tab: channel pickers (Slack / ntfy / Bluesky)
    'Select Slack channel(s)' => 'Selecionar canal/canais de Slack',
    'Which Slack channels should receive this message?' => 'Que canais do Slack receberão esta mensagem?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Sem canais de Slack configurados. Adicione um em [Definições → Slack]({url}).',
    'Select ntfy topic(s)' => 'Selecionar tópico(s) ntfy',
    'Which ntfy topics should receive this message?' => 'Que tópicos ntfy receberão esta mensagem?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'Sem tópicos ntfy configurados. Adicione um em [Definições → ntfy]({url}).',
    'Select Bluesky account(s)' => 'Selecionar conta(s) Bluesky',
    'Which Bluesky accounts should post this message?' => 'Que contas Bluesky devem publicar esta mensagem?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Sem contas Bluesky configuradas. Adicione uma em [Definições → Bluesky]({url}).',

    // Recipients tab: dynamic recipients snippet
    'Twig Snippet to Determine Recipients' => 'Fragmento Twig para determinar os destinatários',
    'Enter a custom Twig snippet to [determine who will receive the message]({url}).' => 'Introduza um snippet Twig personalizado para [determinar quem receberá a mensagem]({url}).',
    'The snippet **must** include a `{% setRecipients %}` tag.' => 'O snippet **deve** incluir uma etiqueta `{% setRecipients %}`.',

    // ============================================================
    // SETTINGS
    // ============================================================

    // Settings: nav & page chrome
    'Notifier Settings' => 'Definições Notifier',
    'General' => 'Geral',
    'Twilio' => 'Twilio',
    'Pushover' => 'Pushover',
    'Slack' => 'Slack',
    'Bluesky' => 'Bluesky',
    'ntfy' => 'ntfy',

    // Settings: Logging
    'Logging' => 'Registo',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'O Notifier mantém um registo contínuo das mensagens enviadas. Normalmente não é necessário, mas pode limitar a quantidade de eventos guardados na base de dados.',
    'Enable Logging' => 'Ativar registo',
    'When disabled, Notifier will not write anything to the notification log.' => 'Quando desativado, o Notifier não escreve nada no registo de notificações.',
    'Number of days to retain log events' => 'Número de dias para reter eventos de registo',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Reter eventos de registo no máximo durante estes dias. Deixe vazio para sem limite.',
    'Number of log events to retain' => 'Número de eventos de registo a reter',
    'At most, keep this many log events. Leave blank for no limit.' => 'Reter no máximo este número de eventos. Deixe vazio para sem limite.',

    // Settings: Scheduled sending
    'Scheduled Sending' => 'Envio agendado',
    'Shared secret for authenticating scheduled-run web requests. Required only when the schedule is triggered via the web endpoint.' => 'Segredo partilhado para autenticar pedidos web de execução agendada. Necessário apenas quando o agendamento é acionado através do endpoint web.',
    'Scheduled-Run Token' => 'Token de execução agendada',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => 'Enviado em cada pedido como o cabeçalho X-Notifier-Token ou parâmetro token no corpo.',

    // Settings: Twilio
    'Twilio API Credentials' => 'Credenciais da API Twilio',
    'If using the Twilio API to send SMS messages, the following credentials are required.' => 'Se utilizar a API Twilio para enviar mensagens SMS, são necessárias as credenciais seguintes.',
    'Twilio Account SID' => 'Twilio Account SID',
    'Twilio Auth Token' => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)' => 'Número de telefone Twilio (envia cada SMS)',
    'SMS Testing' => 'Testes de SMS',
    'Optional. When set, every SMS dispatched will be sent to this number instead of the resolved recipient.' => 'Opcional. Quando definido, todos os SMS enviados serão para este número em vez do destinatário resolvido.',
    'Test phone number' => 'Número de telefone de teste',

    // Settings: Pushover
    "[Pushover](https://pushover.net) sends push notifications to a registered user's devices. Each Craft user needs a custom field on their profile storing their Pushover user key; you select which field on each Notification's Message tab. For full setup instructions, see the [Pushover getting-started docs](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover)." => 'O [Pushover](https://pushover.net) envia notificações push para os dispositivos de um utilizador registado. Cada utilizador Craft precisa de um campo personalizado no perfil que armazene a sua chave Pushover; selecione qual campo no separador Mensagem de cada notificação. Para instruções completas de configuração, consulte a [documentação inicial do Pushover](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover).',
    'Application API Token' => 'Token de API da aplicação',
    'The 30-character app token from your Pushover application.' => 'O token de aplicação de 30 caracteres da sua aplicação Pushover.',

    // Settings: ntfy
    'ntfy.sh is a free HTTP-based push notification service. Subscribers receive messages on the ntfy app, web, or any compatible client by joining a topic.' => 'O ntfy.sh é um serviço gratuito de notificações push baseado em HTTP. Os subscritores recebem mensagens na aplicação ntfy, na web ou em qualquer cliente compatível ao subscrever um tópico.',
    'Server URL' => 'URL do servidor',
    "Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`." => 'Opcional. Aponte para uma instância ntfy auto-hospedada, se aplicável. Predefinição `https://ntfy.sh`.',
    'Access token' => 'Token de acesso',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Opcional. Necessário para tópicos protegidos ou instâncias auto-hospedadas com autenticação.',
    'ntfy Topics' => 'Tópicos ntfy',
    "Add the ntfy topics you'd like to send messages to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification." => 'Adicione os tópicos ntfy para os quais pretende enviar mensagens. Cada tópico fica disponível como destinatário no separador **Destinatários** ao configurar uma notificação.',
    'Topics' => 'Tópicos',
    "Click any row's **Test** button to send a quick test message to that topic." => 'Clique no botão **Testar** de qualquer linha para enviar uma mensagem de teste rápida a esse tópico.',
    'Label' => 'Etiqueta',
    'Topic' => 'Tópico',
    'Add a topic' => 'Adicionar um tópico',

    // Settings: Slack
    'Slack Channels' => 'Canais de Slack',
    'Create a [Slack app](https://api.slack.com/apps) with the `chat:write`, `chat:write.customize`, and `chat:write.public` scopes, then add a row for each channel you\'d like to post into. Each channel becomes available as a recipient on the **Recipients** tab when configuring a notification. A bot token is a secret, so store it in a `.env` variable and reference that variable (e.g. `$SLACK_BOT_TOKEN`) rather than pasting the token directly.' => 'Crie uma [app Slack](https://api.slack.com/apps) com os scopes `chat:write`, `chat:write.customize` e `chat:write.public`, e depois adicione uma linha para cada canal onde queira publicar. Cada canal fica disponível como destinatário no separador **Destinatários** ao configurar uma notificação. Um token do bot é um segredo, por isso guarde-o numa variável `.env` e referencie essa variável (por exemplo `$SLACK_BOT_TOKEN`) em vez de colar o token diretamente.',
    'Channels' => 'Canais',
    "Click any row's **Test** button to send a quick test message to that channel." => 'Clique no botão **Testar** de qualquer linha para enviar uma mensagem de teste rápida a esse canal.',
    'Bot Token' => 'Token do bot',
    'Channel ID' => 'ID do canal',
    'Add a channel' => 'Adicionar um canal',
    'Not a valid Bot Token. Must start with `xoxb-`.' => 'Token do bot inválido. Deve começar com `xoxb-`.',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => 'ID de canal inválido. Deve parecer-se com `C01234ABCD`.',

    // Settings: Bluesky
    '[Bluesky](https://bsky.app) posts publish to the configured account\'s feed via the ATProto API. App passwords are generated at [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). An app password is a secret, so store it in a `.env` variable and reference that variable (e.g. `$BLUESKY_APP_PASSWORD`) rather than pasting the password directly.' => 'As publicações do [Bluesky](https://bsky.app) são publicadas no feed da conta configurada através da API ATProto. As palavras-passe de aplicação são geradas em [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). Uma palavra-passe de aplicação é um segredo, por isso guarde-a numa variável `.env` e referencie essa variável (por exemplo, `$BLUESKY_APP_PASSWORD`) em vez de colar a palavra-passe diretamente.',
    'PDS URL' => 'URL do PDS',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'Predefinição https://bsky.social. Aponte para um PDS personalizado se a sua instalação federar.',
    'Bluesky Accounts' => 'Contas Bluesky',
    "Add the Bluesky accounts you'd like to post from. Each account becomes available as a recipient on the **Recipients** tab when configuring a notification." => 'Adicione as contas Bluesky a partir das quais pretende publicar. Cada conta fica disponível como destinatário no separador **Destinatários** ao configurar uma notificação.',
    'Accounts' => 'Contas',
    "Click any row's **Test** button to confirm the account authenticates." => 'Clique no botão **Testar** de qualquer linha para confirmar que a conta autentica.',
    'Handle' => 'Identificador',
    'App password' => 'Palavra-passe de aplicação',
    'Add an account' => 'Adicionar uma conta',

    // ============================================================
    // MANUAL SEND & TEST
    // ============================================================

    // Manual send & test
    'Send a test message' => 'Enviar uma mensagem de teste',
    'Send a REAL test notification?\\n\\n⚠️ Uses a random sample of real data.\\n⚠️ Sends a real message via the configured channel.\\n⚠️ Delivers to the real configured recipient(s).' => 'Enviar uma notificação de teste REAL?\\n\\n⚠️ Usa uma amostra aleatória de dados reais.\\n⚠️ Envia uma mensagem real através do canal configurado.\\n⚠️ É entregue aos destinatários reais configurados.',
    'Test' => 'Testar',
    'Send system snapshot' => 'Enviar instantâneo do sistema',
    'Send data report' => 'Enviar relatório de dados',
    'Are you sure you want to send this notification?' => 'Tem a certeza de que pretende enviar esta notificação?',
    'This notification cannot be triggered manually.' => 'Esta notificação não pode ser acionada manualmente.',
    'This notification no longer applies to the selected element.' => 'Esta notificação já não se aplica ao elemento selecionado.',

    // ============================================================
    // RUNTIME OUTPUT
    // ============================================================

    // Runtime: dispatch log feedback
    'Sending {messageType} to {recipient}.' => 'A enviar {messageType} para {recipient}.',
    'Adding message to queue.' => 'A adicionar mensagem à fila.',
    'Sending message immediately (bypassing queue).' => 'A enviar a mensagem de imediato (a ignorar a fila).',
    'Unable to parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => 'Não foi possível analisar o feed. As extensões PHP `simplexml` e `libxml` são necessárias.',
    'Unable to parse the feed.' => 'Não foi possível analisar o feed.',
    'Unable to fetch the feed: {message}' => 'Não foi possível obter o feed: {message}',
    'Initial feed scan failed: {message}' => 'Falha na verificação inicial do feed: {message}',

    // Runtime: controller responses
    'Test notification dispatched.' => 'Notificação de teste enviada.',
    'No messages were dispatched. Check the recipient configuration.' => 'Não foram enviadas mensagens. Verifique a configuração dos destinatários.',
    'Unable to send test: the feed could not be read or has no items.' => 'Não foi possível enviar o teste: o feed não pôde ser lido ou não contém itens.',
    'Unable to send test: no element matches the configured filters.' => 'Não foi possível enviar o teste: nenhum elemento corresponde aos filtros configurados.',
    "Couldn't save settings." => 'Não foi possível guardar as definições.',
    'Settings saved.' => 'Definições guardadas.',
    'Topic is empty.' => 'O tópico está vazio.',
    'Server URL is not configured.' => 'URL do servidor não configurado.',
    'Test message from Notifier.' => 'Mensagem de teste do Notifier.',
    'HTTP {status}' => 'HTTP {status}',
    'Test message sent successfully.' => 'Mensagem de teste enviada com sucesso.',
    'Handle and app password are required.' => 'O identificador e a palavra-passe de aplicação são obrigatórios.',
    'Authentication failed.' => 'Falha de autenticação.',
    'Successfully authenticated. No messages were posted.' => 'Autenticação bem-sucedida. Não foi publicada nenhuma mensagem.',
    'Log events deleted.' => 'Eventos de registo eliminados.',
    'Notification sent.' => 'Notificação enviada.',
    'Notification was not sent. Check the Notification Log for details.' => 'A notificação não foi enviada. Consulte o Registo de notificações para mais detalhes.',

    // Outbound: per-channel send results
    'Unable to send email, no recipient specified.' => 'Não é possível enviar o e-mail: nenhum destinatário especificado.',
    'Unable to send email, the message body was empty.' => 'Não é possível enviar o e-mail: o corpo da mensagem estava vazio.',
    "Unable to send the email using Craft's native email handling." => 'Não é possível enviar o e-mail utilizando a gestão de e-mails nativa do Craft.',
    'Check your general email settings within Craft.' => 'Verifique as definições gerais de e-mail no Craft.',
    'Successfully sent email message!' => 'E-mail enviado com sucesso!',
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[Credenciais Twilio inválidas.]({url}) Em falta: {missing}.',
    'Unable to send SMS, no Twilio phone number exists.' => 'Não é possível enviar o SMS: nenhum número de telefone Twilio existe.',
    'Unable to send SMS, no recipient phone number exists.' => 'Não é possível enviar o SMS: nenhum número de telefone do destinatário existe.',
    'Unable to send SMS, recipient phone number is invalid.' => 'Não é possível enviar o SMS: o número de telefone do destinatário é inválido.',
    'Successfully sent SMS message!' => 'SMS enviado com sucesso!',
    'Unable to post announcement, no recipient userId specified.' => 'Não é possível publicar o anúncio: nenhum userId do destinatário especificado.',
    'Successfully posted announcement!' => 'Anúncio publicado com sucesso!',
    'Unable to send the flash message, invalid flash type.' => 'Não é possível enviar a mensagem flash: tipo de flash inválido.',
    'Successfully sent flash message!' => 'Mensagem flash enviada com sucesso!',
    '[Invalid Pushover credentials.]({url}) Missing app token.' => '[Credenciais Pushover inválidas.]({url}) Token de aplicação em falta.',
    'Unable to send Pushover message, no user key on recipient.' => 'Não é possível enviar a mensagem Pushover: nenhuma chave de utilizador no destinatário.',
    'Pushover POST failed: {reason}' => 'POST Pushover falhou: {reason}',
    'Successfully sent Pushover message!' => 'Mensagem Pushover enviada com sucesso!',
    'Unable to send ntfy message, no topic specified.' => 'Não é possível enviar a mensagem ntfy: nenhum tópico especificado.',
    'ntfy POST failed with HTTP {status}: {reason}' => 'POST ntfy falhou com HTTP {status}: {reason}',
    'ntfy POST failed: {reason}' => 'POST ntfy falhou: {reason}',
    'Successfully sent ntfy message to topic "{topic}".' => 'Mensagem ntfy enviada com sucesso para o tópico "{topic}".',
    'Unable to send Slack message, no bot token.' => 'Não foi possível enviar a mensagem do Slack: sem token do bot.',
    'Unable to send Slack message, no channel ID.' => 'Não foi possível enviar a mensagem do Slack: sem ID de canal.',
    'Unable to send Slack message, body is empty.' => 'Não é possível enviar a mensagem Slack: o corpo está vazio.',
    'Slack rejected the message: {error}' => 'O Slack rejeitou a mensagem: {error}',
    'Slack POST failed: {reason}' => 'POST Slack falhou: {reason}',
    'Successfully sent Slack message to "{label}".' => 'Mensagem Slack enviada com sucesso para "{label}".',
    'Unable to send Bluesky post, recipient is missing credentials.' => 'Não é possível enviar a publicação Bluesky: o destinatário não tem credenciais.',
    'Body exceeded {max} characters, truncated.' => 'O corpo ultrapassou {max} carateres e foi truncado.',
    'Successfully posted to Bluesky as "{label}".' => 'Publicado com sucesso no Bluesky como "{label}".',
    'Bluesky auth failed for {handle}: {reason}' => 'Falha de autenticação Bluesky para {handle}: {reason}',
    'Bluesky auth failed: {reason}' => 'Falha de autenticação Bluesky: {reason}',
    'Bluesky post failed: {reason}' => 'Publicação Bluesky falhou: {reason}',
    'Bluesky link preview skipped: {reason}' => 'Pré-visualização da ligação Bluesky ignorada: {reason}',

    // Recipient warnings
    'Recipient "{name}" has no email address.' => 'O destinatário "{name}" não tem endereço de e-mail.',
    'Recipient "{name}" has no phone number.' => 'O destinatário "{name}" não tem número de telefone.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => 'O destinatário "{name}" não tem utilizador associado; não é possível enviar o anúncio.',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => 'O destinatário "{name}" não tem acesso ao painel de controlo; não é possível enviar o anúncio.',
    'Pushover user-key field is not configured on this notification.' => 'O campo da chave de utilizador Pushover não está configurado nesta notificação.',
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => 'O destinatário "{name}" não tem utilizador associado; não é possível enviar a mensagem Pushover.',
    '[SKIPPED] User "{name}" has no Pushover key.' => '[IGNORADO] O utilizador "{name}" não tem chave Pushover.',
    'Recipient "{name}" has no ntfy topic.' => 'O destinatário "{name}" não tem tópico ntfy.',
    'Recipient "{name}" has no Bluesky credentials.' => 'O destinatário "{name}" não tem credenciais Bluesky.',
    'Recipient "{name}" has no Slack bot token.' => 'O destinatário "{name}" não tem token do bot Slack.',
    'Recipient "{name}" has no Slack channel ID.' => 'O destinatário "{name}" não tem ID de canal do Slack.',

    // Errors & exceptions
    'Invalid element event: {class}' => 'Evento de elemento inválido: {class}',
    'Invalid notification ID: {id}' => 'ID de notificação inválido: {id}',
    'Invalid email message mode.' => 'Modo de mensagem de e-mail inválido.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Não tem permissão para usar o tipo Destinatários dinâmicos.',
    'Dynamic recipients snippet did not call setRecipients.' => 'O fragmento de destinatários dinâmicos não chamou setRecipients.',
    'setRecipients was called with an empty value.' => 'setRecipients foi chamado com um valor vazio.',
    'Unrecognized recipient of type "{type}".' => 'Destinatário de tipo "{type}" não reconhecido.',
    'Unrecognized recipient "{value}".' => 'Destinatário "{value}" não reconhecido.',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => 'O {kind} configurado já não existe nas definições do plug-in (uid: {uid}).',
    'Invalid settings section: {section}' => 'Secção de definições inválida: {section}',
    'User not authorized to save this notification.' => 'O utilizador não tem autorização para guardar esta notificação.',
    'User not authorized to view this notification.' => 'O utilizador não tem autorização para ver esta notificação.',
    'User not authorized to delete this notification.' => 'O utilizador não tem autorização para eliminar esta notificação.',
    'Notification not found' => 'Notificação não encontrada',
    'Element not found' => 'Elemento não encontrado',
    'You do not have permission to use the Dynamic Data type.' => 'Não tens permissão para usar o tipo Dados dinâmicos.',
    'The Dynamic Data snippet did not call the {tag} tag.' => 'O fragmento Twig não chamou a tag {tag}.',
    'Invalid Slack body format.' => 'Formato de corpo Slack inválido.',

    // Config-file override note
    'This is being set in the config file. [{file}]' => 'Isto está a ser definido no ficheiro de configuração. [{file}]',

    // ============================================================
    // JAVASCRIPT UI
    // ============================================================

    // JavaScript: log utility & buttons
    'Test notification failed.' => 'Falha na notificação de teste.',
    'Unable to get the notification, something went wrong.' => 'Não foi possível obter a notificação, algo correu mal.',
    'Something went wrong.' => 'Algo correu mal.',
    'Invalid notification ID.' => 'ID de notificação inválido.',
    'Unable to delete the log event, something went wrong.' => 'Não foi possível eliminar o evento de registo, algo correu mal.',
    'Log event deleted.' => 'Evento de registo eliminado.',
    'Unable to delete log events, something went wrong.' => 'Não foi possível eliminar os eventos de registo, algo correu mal.',
    'Are you sure you want to delete this log event?' => 'Tem a certeza de que pretende eliminar este evento de registo?',
    'Are you sure you want to delete all logs from {date}?' => 'Tem a certeza de que pretende eliminar todos os registos de {date}?',

    // ============================================================
    // MQTT
    // ============================================================

    'Recipient "{name}" has no MQTT topic.' => 'O destinatário "{name}" não tem tópico MQTT.',
    'Unable to send MQTT message, no broker host configured.' => 'Não foi possível enviar a mensagem MQTT, nenhum host de broker configurado.',
    'Unable to send MQTT message, no topic specified.' => 'Não foi possível enviar a mensagem MQTT, nenhum tópico especificado.',
    'Unable to send MQTT message, the payload is empty.' => 'Não foi possível enviar a mensagem MQTT, o conteúdo está vazio.',
    'MQTT publish failed: {reason}' => 'Falha ao publicar no MQTT: {reason}',
    'Successfully sent MQTT message to topic "{topic}".' => 'Mensagem MQTT enviada para o tópico "{topic}".',
    'MQTT Broker' => 'Broker MQTT',
    'Notifier publishes to an MQTT broker (such as Mosquitto, EMQX, HiveMQ, or AWS IoT Core). Enter the broker connection details below. Sensitive values can be stored in a `.env` variable and referenced here (e.g. `$MQTT_PASSWORD`).' => 'O Notifier publica num broker MQTT (como Mosquitto, EMQX, HiveMQ ou AWS IoT Core). Introduza abaixo os detalhes de ligação do broker. Os valores sensíveis podem ser armazenados numa variável `.env` e referenciados aqui (por exemplo `$MQTT_PASSWORD`).',
    'Host' => 'Host',
    'Broker hostname, without a protocol or port.' => 'Nome de host do broker, sem protocolo ou porta.',
    'Port' => 'Porta',
    'Optional. Defaults to 8883 when TLS is enabled, otherwise 1883.' => 'Opcional. O valor predefinido é 8883 quando o TLS está ativado; caso contrário, 1883.',
    'Use TLS' => 'Usar TLS',
    'Whether to connect to the broker over a secure TLS socket.' => 'Se deve ligar-se ao broker através de um socket TLS seguro.',
    'Username' => 'Nome de utilizador',
    'Optional, for brokers that require username/password authentication.' => 'Opcional, para brokers que exigem autenticação com nome de utilizador/palavra-passe.',
    'Password' => 'Palavra-passe',
    'MQTT Version' => 'Versão do MQTT',
    'Protocol version sent to the broker.' => 'Versão do protocolo enviada ao broker.',
    'Client ID' => 'ID do cliente',
    'Optional. A unique client ID is generated automatically when left blank.' => 'Opcional. É gerado automaticamente um ID de cliente único quando deixado em branco.',
    'Mutual TLS' => 'TLS mútuo',
    'Optional. Required for brokers that authenticate clients with certificates, such as AWS IoT Core. Provide server file paths to the certificate files (a `.env` variable or `@alias` reference is allowed).' => 'Opcional. Necessário para brokers que autenticam clientes com certificados, como o AWS IoT Core. Indique os caminhos de ficheiro no servidor para os ficheiros de certificado (é permitida uma variável `.env` ou uma referência `@alias`).',
    'CA Certificate File' => 'Ficheiro de certificado da CA',
    'Path to the certificate authority (CA) file.' => 'Caminho para o ficheiro da autoridade de certificação (CA).',
    'Client Certificate File' => 'Ficheiro de certificado do cliente',
    'Path to the client certificate file.' => 'Caminho para o ficheiro de certificado do cliente.',
    'Client Key File' => 'Ficheiro de chave do cliente',
    'Path to the client private key file.' => 'Caminho para o ficheiro de chave privada do cliente.',
    'MQTT Topics' => 'Tópicos MQTT',
    'Add the MQTT topics you\'d like to publish to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification.' => 'Adicione os tópicos MQTT nos quais pretende publicar. Cada tópico fica disponível como destinatário no separador **Destinatários** ao configurar uma notificação.',
    'Click any row\'s **Test** button to publish a quick test message to that topic.' => 'Clique no botão **Testar** de qualquer linha para publicar uma mensagem de teste rápida nesse tópico.',
    'MQTT' => 'MQTT',
    'Payload' => 'Conteúdo',
    'The message published to the topic. Can be plain text or a Twig-rendered JSON object.' => 'A mensagem publicada no tópico. Pode ser texto simples ou um objeto JSON renderizado com Twig.',
    'Quality of Service' => 'Qualidade de serviço',
    'Delivery guarantee for this message.' => 'Garantia de entrega desta mensagem.',
    'Retain' => 'Reter',
    'Whether the broker keeps this as the topic\'s last message for future subscribers.' => 'Se o broker mantém esta como a última mensagem do tópico, entregando-a a futuros subscritores.',
    'Don\'t retain' => 'Não reter',
    'Select MQTT topic(s)' => 'Selecionar tópico(s) MQTT',
    'Which topics should receive this message?' => 'Que tópicos devem receber esta mensagem?',
    'No MQTT topics configured. Add one in [Settings → MQTT]({url}).' => 'Nenhum tópico MQTT configurado. Adicione um em [Definições → MQTT]({url}).',
    'Not a valid topic. Must not be empty or contain the `+` or `#` wildcards.' => 'Tópico inválido. Não pode estar vazio nem conter os caracteres universais `+` ou `#`.',
    'Broker host is not configured.' => 'O host do broker não está configurado.',

    // ============================================================
    // Recipient empty-state (administrative changes disabled)
    // ============================================================

    'No ntfy topics configured. Topics can only be added in an environment that allows administrative changes.' => 'Sem tópicos ntfy configurados. Os tópicos só podem ser adicionados num ambiente que permita alterações administrativas.',
    'No Slack channels configured. Channels can only be added in an environment that allows administrative changes.' => 'Sem canais de Slack configurados. Os canais só podem ser adicionados num ambiente que permita alterações administrativas.',
    'No Bluesky accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Sem contas Bluesky configuradas. As contas só podem ser adicionadas num ambiente que permita alterações administrativas.',
    'No MQTT topics configured. Topics can only be added in an environment that allows administrative changes.' => 'Nenhum tópico MQTT configurado. Os tópicos só podem ser adicionados num ambiente que permita alterações administrativas.',
];
