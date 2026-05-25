<?php
/**
 * Notifier plugin for Craft CMS
 *
 * First-class Notifications for Craft CMS
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

return [

    // Plugin name and nav
    'Notifier'               => 'Notifier',
    'Notifications'          => 'Notificações',
    'Notification'           => 'Notificação',
    'All notifications'      => 'Todas as notificações',
    'Notification Log'       => 'Registro de notificações',
    'Logs'                   => 'Registros',
    'View Notifications'     => 'Ver notificações',
    'Add a New Notification' => 'Adicionar uma nova notificação',

    // Permissions
    'View notifications'              => 'Ver notificações',
    'Save notifications'              => 'Salvar notificações',
    'Use the Dynamic Recipients type' => 'Usar o tipo Destinatários dinâmicos',
    'Test notifications'              => 'Testar notificações',
    'Delete notifications'            => 'Excluir notificações',
    'View notification log'           => 'Ver registro de notificações',
    'Delete notification log'         => 'Excluir registro de notificações',

    // Notification editor: tabs
    'Meta'       => 'Meta',
    'Event'      => 'Evento',
    'Message'    => 'Mensagem',
    'Recipients' => 'Destinatários',

    // Event tab: type selector
    'Event Type'                                           => 'Tipo de evento',
    'What type of event will activate the notification?'   => 'Que tipo de evento ativará a notificação?',
    'Which specific event will activate the notification?' => 'Que evento específico ativará a notificação?',

    // Event tab: event types
    'Assets Event'                   => 'Evento de Asset',
    'Commerce Orders Event'          => 'Evento de pedido Commerce',
    'Commerce Products Event'        => 'Evento de produto Commerce',
    'Digital Products Event'         => 'Evento Digital Products',
    'Digital Product Licenses Event' => 'Evento de licença Digital Products',
    'Solspace Calendar Event'        => 'Evento Solspace Calendar',
    'Entries Event'                  => 'Evento de entradas',
    'Users Event'                    => 'Evento de usuários',
    'Ungrouped Users'                => 'Usuários sem grupo',

    // Feed
    'Feed URL' => 'URL do feed',
    'The URL of the RSS, Atom, or JSON feed to watch.' => 'A URL do feed RSS, Atom ou JSON a ser monitorado.',
    // Field and element conditions
    'Field Conditions'             => 'Condições de campo',
    'Send the message only when the saved element matches the following conditions.' => 'Enviar a mensagem apenas quando o elemento salvo corresponder às seguintes condições.',
    'has changed'                  => 'foi alterado',
    '#{elementType} Event Filters' => 'Filtros de eventos para #{elementType}',
    'No filters match this event.' => 'Nenhum filtro corresponde a este evento.',
    'Determine whether each message should be sent based on specified conditions.' => 'Determine, com base nas condições especificadas, se cada mensagem deve ser enviada.',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => 'O elemento está sendo salvo pela primeira vez',
    'Must be a new entry'                       => 'Deve ser uma nova entrada',
    'Must be an existing entry'                 => 'Deve ser uma entrada existente',
    'Can be existing or new'                    => 'Pode ser existente ou novo',

    // Filters: new elements
    'Element is new'         => 'O elemento é novo',
    'New elements only'      => 'Apenas elementos novos',
    'Existing elements only' => 'Apenas elementos existentes',

    // Filters: enabled state
    'Element is enabled'         => 'O elemento está habilitado',
    'Must be enabled'            => 'Deve estar habilitado',
    'Must be disabled'           => 'Deve estar desabilitado',
    'Can be enabled or disabled' => 'Pode estar habilitado ou desabilitado',

    // Filters: drafts
    'Element is a draft'          => 'O elemento é um rascunho',
    'Must be a draft'             => 'Deve ser um rascunho',
    'Must not be a draft'         => 'Não pode ser um rascunho',
    'Can be a draft or non-draft' => 'Pode ser rascunho ou não',

    // Filters: provisional drafts
    'Element is a provisional draft'                => 'O elemento é um rascunho provisório',
    'Must be a provisional draft'                   => 'Deve ser um rascunho provisório',
    'Must not be a provisional draft'               => 'Não pode ser um rascunho provisório',
    'Can be a provisional draft or non-provisional' => 'Pode ser provisório ou não',

    // Filters: revisions
    'Element is a revision'             => 'O elemento é uma revisão',
    'Must be a revision'                => 'Deve ser uma revisão',
    'Must not be a revision'            => 'Não pode ser uma revisão',
    'Can be a revision or non-revision' => 'Pode ser revisão ou não',

    // Filters: duplication
    'Element is being duplicated'         => 'O elemento está sendo duplicado',
    'Must be duplicating the element'     => 'Deve estar duplicando o elemento',
    'Must not be duplicating the element' => 'Não pode estar duplicando o elemento',

    // Filters: propagation
    'Element is being propagated'     => 'O elemento está sendo propagado',
    'Element must be propagating'     => 'O elemento deve estar propagando',
    'Element must not be propagating' => 'O elemento não pode estar propagando',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => 'O elemento está sendo regravado em massa',
    'Must be bulk-resaving the element'     => 'Deve estar regravando o elemento em massa',
    'Must not be bulk-resaving the element' => 'Não pode estar regravando o elemento em massa',

    // Filters: common output
    'Unnamed filter'                => 'Filtro sem nome',
    'Must be TRUE to send message'  => 'Deve ser TRUE para enviar a mensagem',
    'Must be FALSE to send message' => 'Deve ser FALSE para enviar a mensagem',
    'No effect'                     => 'Sem efeito',

    // Message tab: type selector and queue
    'Message Type'                       => 'Tipo de mensagem',
    'What type of message will be sent?' => 'Que tipo de mensagem será enviado?',
    'Send Message via Queue'             => 'Enviar mensagem pela fila',
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are also supported.' => 'Também são suportados [templates]({templatingUrl}) e [variáveis especiais]({variablesUrl}).',
    'Send immediately' => 'Enviar imediatamente',
    'Add to queue' => 'Adicionar à fila',

    // Message tab: Email fields
    "User's Email Address Field" => 'Campo de endereço de e-mail do usuário',
    'Email Subject'              => 'Assunto do e-mail',
    'Email Body'                 => 'Corpo do e-mail',

    // Message tab: SMS fields
    "User's Phone Number Field" => 'Campo de número de telefone do usuário',
    'SMS Message Body'          => 'Corpo da mensagem SMS',

    // Message tab: Announcement fields
    'Announcement Title'   => 'Título do anúncio',
    'Announcement Message' => 'Mensagem do anúncio',

    // Message tab: Flash fields
    'Flash Message Type'                         => 'Tipo de mensagem flash',
    'Flash Message Title'                        => 'Título da mensagem flash',
    'Flash Message Details'                      => 'Detalhes da mensagem flash',
    'Which type of flash message should appear?' => 'Que tipo de mensagem flash deve aparecer?',

    // Message tab: Pushover fields
    "Field containing each user's Pushover key" => 'Campo da chave Pushover do usuário',

    // Message tab: ntfy fields
    'Priority'           => 'Prioridade',
    'Tags'               => 'Tags',

    // Message tab: Slack fields
    'Slack Message Body' => 'Corpo da mensagem Slack',
    'Bot Icon URL' => 'URL do ícone',

    // Message tab: Bluesky fields
    'Post Body' => 'Corpo da publicação',
    'Generate Link Preview' => 'Gerar prévia do link',
    'No card' => 'Sem cartão',
    'Generate preview card' => 'Gerar cartão de prévia',

    // Message tab: Title / Body / Trix toolbar
    'Rich Text'     => 'Texto formatado',
    'Bold'          => 'Negrito',
    'Italic'        => 'Itálico',
    'Underline'     => 'Sublinhado',
    'Strikethrough' => 'Tachado',
    'Bullets'       => 'Marcadores',
    'Numbers'       => 'Numeração',
    'Heading'       => 'Cabeçalho',
    'Code'          => 'Código',
    'Undo'          => 'Desfazer',
    'Redo'          => 'Refazer',

    // Recipients tab: common
    'Recipients Type'                             => 'Tipo de destinatários',
    'Who will receive this message?'              => 'Quem receberá esta mensagem?',
    'Add a message recipient'                     => 'Adicionar um destinatário',
    'Select User(s)'                              => 'Selecionar usuário(s)',
    'Which users will receive the message?'       => 'Quais usuários receberão a mensagem?',
    'Which user groups will receive the message?' => 'Quais grupos de usuários receberão a mensagem?',
    'Twig Snippet to Determine Recipients'        => 'Trecho Twig para determinar os destinatários',

    // Recipients tab: per-provider pickers
    'Select Slack channel(s)'                           => 'Selecionar canal(is) do Slack',
    'Which Slack channels should receive this message?' => 'Quais canais do Slack receberão esta mensagem?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Nenhum canal do Slack configurado. Adicione um em [Configurações → Slack]({url}).',
    'Select ntfy topic(s)'                              => 'Selecionar tópico(s) do ntfy',
    'Which ntfy topics should receive this message?'    => 'Quais tópicos ntfy receberão esta mensagem?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'Nenhum tópico ntfy configurado. Adicione um em [Configurações → ntfy]({url}).',
    'Select Bluesky account(s)'                         => 'Selecionar conta(s) Bluesky',
    'Which Bluesky accounts should post this message?'  => 'Quais contas Bluesky devem postar esta mensagem?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Nenhuma conta Bluesky configurada. Adicione uma em [Configurações → Bluesky]({url}).',

    // Settings: page chrome
    'Notifier Settings' => 'Configurações Notifier',
    'General'           => 'Geral',
    'Twilio'            => 'Twilio',
    'Pushover'          => 'Pushover',
    'Slack'             => 'Slack',
    'Bluesky'           => 'Bluesky',
    'ntfy'              => 'ntfy',

    // Settings: Logging
    'Logging'                             => 'Registro',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'O Notifier mantém um registro contínuo das mensagens enviadas. Normalmente não é necessário, mas você pode limitar a quantidade de eventos registrados no banco de dados.',
    'Enable Logging'                      => 'Habilitar registro',
    'When disabled, Notifier will not write anything to the notification log.' => 'Quando desabilitado, o Notifier não escreve nada no registro de notificações.',
    'Number of days to retain log events' => 'Número de dias para reter eventos de registro',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Reter eventos de registro no máximo por estes dias. Deixe em branco para sem limite.',
    'Number of log events to retain'      => 'Número de eventos de registro a reter',
    'At most, keep this many log events. Leave blank for no limit.' => 'Reter no máximo este número de eventos. Deixe em branco para sem limite.',

    // Settings: Twilio
    'Twilio API Credentials'                       => 'Credenciais da API Twilio',
    'If using the Twilio API to send SMS messages, the following credentials are required.' => 'Se você usar a API Twilio para enviar mensagens SMS, as seguintes credenciais são necessárias.',
    'Twilio Account SID'                           => 'Twilio Account SID',
    'Twilio Auth Token'                            => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)' => 'Número de telefone Twilio (envia cada SMS)',
    'SMS Testing'                                  => 'Testes de SMS',
    'Optional. When set, every SMS dispatched will be sent to this number instead of the resolved recipient.' => 'Opcional. Quando definido, todo SMS enviado será para este número em vez do destinatário resolvido.',
    'Test phone number'                            => 'Número de telefone de teste',

    // Settings: Pushover
    "[Pushover](https://pushover.net) sends push notifications to a registered user's devices. Each Craft user needs a custom field on their profile storing their Pushover user key; you select which field on each Notification's Message tab. For full setup instructions, see the [Pushover getting-started docs](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover)." => 'O [Pushover](https://pushover.net) envia notificações push para os dispositivos de um usuário registrado. Cada usuário Craft precisa de um campo personalizado no perfil que armazene sua chave Pushover; você seleciona qual campo na aba Mensagem de cada notificação. Para instruções completas de configuração, consulte a [documentação inicial do Pushover](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover).',
    'Application API Token'                                      => 'Token de API do aplicativo',
    'The 30-character app token from your Pushover application.' => 'O token de aplicativo de 30 caracteres do seu aplicativo Pushover.',

    // Settings: ntfy
    'ntfy.sh is a free HTTP-based push notification service. Subscribers receive messages on the ntfy app, web, or any compatible client by joining a topic.' => 'O ntfy.sh é um serviço gratuito de notificações push baseado em HTTP. Os assinantes recebem mensagens no aplicativo ntfy, na web ou em qualquer cliente compatível ao inscrever-se em um tópico.',
    'Server URL'   => 'URL do servidor',
    'Access token' => 'Token de acesso',
    'ntfy Topics'  => 'Tópicos ntfy',
    'Topics'       => 'Tópicos',
    'Topic'        => 'Tópico',
    'Add a topic'  => 'Adicionar um tópico',

    // Settings: Slack
    'Slack Channels' => 'Canais do Slack',
    'Create a [Slack app](https://api.slack.com/apps) with the `chat:write`, `chat:write.customize`, and `chat:write.public` scopes, then add a row for each channel you\'d like to post into. Each channel becomes available as a recipient on the **Recipients** tab when configuring a notification. A bot token is a secret, so store it in a `.env` variable and reference that variable (e.g. `$SLACK_BOT_TOKEN`) rather than pasting the token directly.' => 'Crie um [app Slack](https://api.slack.com/apps) com os scopes `chat:write`, `chat:write.customize` e `chat:write.public`, e depois adicione uma linha para cada canal onde queira publicar. Cada canal fica disponível como destinatário na aba **Destinatários** ao configurar uma notificação. Um token do bot é um segredo, então armazene-o em uma variável `.env` e referencie essa variável (por exemplo `$SLACK_BOT_TOKEN`) em vez de colar o token diretamente.',
    'Channels'       => 'Canais',
    'Add a channel'  => 'Adicionar um canal',
    'Bot Token' => 'Token do bot',
    'Channel ID' => 'ID do canal',
    'Bot Emoji' => 'Emoji do ícone',
    'Bot Name' => 'Nome de usuário',
    'Whether Slack should unfurl link previews for URLs in the message body.' => 'Se o Slack deve exibir pré-visualizações de links para URLs no corpo da mensagem.',
    'Not a valid Bot Token. Must start with `xoxb-`.' => 'Token do bot inválido. Deve começar com `xoxb-`.',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => 'ID de canal inválido. Deve se parecer com `C01234ABCD`.',
    'Unable to send Slack message, no bot token.' => 'Não foi possível enviar a mensagem do Slack: sem token do bot.',
    'Unable to send Slack message, no channel ID.' => 'Não foi possível enviar a mensagem do Slack: sem ID de canal.',
    'Recipient "{name}" has no Slack bot token.' => 'O destinatário "{name}" não tem token do bot Slack.',
    'Recipient "{name}" has no Slack channel ID.' => 'O destinatário "{name}" não tem ID de canal do Slack.',
    'Slack rejected the message: {error}' => 'O Slack rejeitou a mensagem: {error}',

    // Settings: Bluesky
    "[Bluesky](https://bsky.app) posts publish to the configured account's feed via the ATProto API. App passwords are generated at [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). An app password is a secret, so store it in a `.env` variable and reference that variable (e.g. `\$BLUESKY_APP_PASSWORD`) rather than pasting the password directly." => 'As publicações no [Bluesky](https://bsky.app) são divulgadas no feed da conta configurada pela API ATProto. As senhas de aplicativo são geradas em [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). Uma senha de aplicativo é um segredo, portanto armazene-a em uma variável `.env` e referencie essa variável (ex.: `$BLUESKY_APP_PASSWORD`) em vez de colar a senha diretamente.',
    'PDS URL'          => 'URL do PDS',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'Padrão https://bsky.social. Aponte para um PDS personalizado se sua instalação federar.',
    'Bluesky Accounts' => 'Contas Bluesky',
    'Accounts'         => 'Contas',
    'Label'            => 'Etiqueta',
    'Handle'           => 'Identificador',
    'App password'     => 'Senha do aplicativo',
    'Add an account'   => 'Adicionar uma conta',

    // Test notification (UI)
    'Send a test message'           => 'Enviar uma mensagem de teste',
    'Are you certain you want to send a test notification?\\n\\nThe configured message will be sent to the configured recipient(s).' => 'Você tem certeza de que deseja enviar uma notificação de teste?\\n\\nA mensagem configurada será enviada aos destinatários configurados.',
    'Test'                          => 'Testar',
    'Test notification dispatched.' => 'Notificação de teste enviada.',
    'No messages were dispatched. Check the recipient configuration.' => 'Nenhuma mensagem foi enviada. Verifique a configuração dos destinatários.',

    // Settings: save / test action responses
    "Couldn't save settings."                 => 'Não foi possível salvar as configurações.',
    'Settings saved.'                         => 'Configurações salvas.',
    'Topic is empty.'                         => 'O tópico está vazio.',
    'Server URL is not configured.'           => 'URL do servidor não configurado.',
    'Test message from Notifier.'             => 'Mensagem de teste do Notifier.',
    'HTTP {status}'                           => 'HTTP {status}',
    'Test message sent successfully.'         => 'Mensagem de teste enviada com sucesso.',
    'Handle and app password are required.'   => 'O identificador e a senha do aplicativo são obrigatórios.',
    'Authentication failed.'                  => 'Falha de autenticação.',
    'Successfully authenticated. No messages were posted.' => 'Autenticação bem-sucedida. Nenhuma mensagem foi publicada.',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.'          => 'Enviando {messageType} para {recipient}.',
    'Adding message to queue.'                       => 'Adicionando mensagem à fila.',
    'Unable to parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => 'Não foi possível analisar o feed. As extensões PHP `simplexml` e `libxml` são necessárias.',
    'Unable to parse the feed.' => 'Não foi possível analisar o feed.',
    'Unable to fetch the feed: {message}' => 'Não foi possível obter o feed: {message}',
    'Initial feed scan failed: {message}' => 'Falha na verificação inicial do feed: {message}',
    'Sending message immediately (bypassing queue).' => 'Enviando a mensagem imediatamente (ignorando a fila).',
    'Log events deleted.'                            => 'Eventos de registro excluídos.',
    'notification'                                   => 'notificação',

    // Outbound: Email log messages
    'Unable to send email, no recipient specified.'     => 'Não é possível enviar o e-mail: nenhum destinatário especificado.',
    'Unable to send email, the message body was empty.' => 'Não é possível enviar o e-mail: o corpo da mensagem estava vazio.',
    "Unable to send the email using Craft's native email handling." => 'Não é possível enviar o e-mail usando o gerenciamento nativo de e-mails do Craft.',
    'Check your general email settings within Craft.'   => 'Verifique as configurações gerais de e-mail no Craft.',
    'Successfully sent email message!'                  => 'E-mail enviado com sucesso!',

    // Outbound: SMS log messages
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[Credenciais Twilio inválidas.]({url}) Faltando: {missing}.',
    'Unable to send SMS, no Twilio phone number exists.'      => 'Não é possível enviar o SMS: nenhum número de telefone Twilio existe.',
    'Unable to send SMS, no recipient phone number exists.'   => 'Não é possível enviar o SMS: nenhum número de telefone do destinatário existe.',
    'Unable to send SMS, recipient phone number is invalid.'  => 'Não é possível enviar o SMS: o número de telefone do destinatário é inválido.',
    'Successfully sent SMS message!'                          => 'SMS enviado com sucesso!',

    // Outbound: Announcement log messages
    'Unable to post announcement, no recipient userId specified.' => 'Não é possível postar o anúncio: nenhum userId do destinatário especificado.',
    'Successfully posted announcement!' => 'Anúncio postado com sucesso!',

    // Outbound: Flash log messages
    'Unable to send the flash message, invalid flash type.' => 'Não é possível enviar a mensagem flash: tipo de flash inválido.',
    'Successfully sent flash message!'                      => 'Mensagem flash enviada com sucesso!',

    // Outbound: Pushover log messages
    '[Invalid Pushover credentials.]({url}) Missing app token.'  => '[Credenciais Pushover inválidas.]({url}) Token do aplicativo em falta.',
    'Unable to send Pushover message, no user key on recipient.' => 'Não é possível enviar a mensagem Pushover: nenhuma chave de usuário no destinatário.',
    'Pushover POST failed: {reason}'                             => 'POST Pushover falhou: {reason}',
    'Successfully sent Pushover message!'                        => 'Mensagem Pushover enviada com sucesso!',

    // Outbound: ntfy log messages
    'Unable to send ntfy message, no topic specified.'       => 'Não é possível enviar a mensagem ntfy: nenhum tópico especificado.',
    'ntfy POST failed with HTTP {status}: {reason}'          => 'POST ntfy falhou com HTTP {status}: {reason}',
    'ntfy POST failed: {reason}'                             => 'POST ntfy falhou: {reason}',
    'Successfully sent ntfy message to topic "{topic}".'     => 'Mensagem ntfy enviada com sucesso para o tópico "{topic}".',

    // Outbound: Slack log messages
    'Unable to send Slack message, body is empty.'  => 'Não é possível enviar a mensagem Slack: o corpo está vazio.',
    'Slack POST failed: {reason}'                   => 'POST Slack falhou: {reason}',
    'Successfully sent Slack message to "{label}".' => 'Mensagem Slack enviada com sucesso para "{label}".',

    // Outbound: Bluesky log messages
    'Unable to send Bluesky post, recipient is missing credentials.' => 'Não é possível enviar a publicação Bluesky: o destinatário não tem credenciais.',
    'Body exceeded {max} characters, truncated.'          => 'O corpo ultrapassou {max} caracteres e foi truncado.',
    'Successfully posted to Bluesky as "{label}".'        => 'Publicado com sucesso no Bluesky como "{label}".',
    'Bluesky auth failed for {handle}: {reason}'          => 'Falha de autenticação Bluesky para {handle}: {reason}',
    'Bluesky auth failed: {reason}'                       => 'Falha de autenticação Bluesky: {reason}',
    'Bluesky post failed: {reason}'                       => 'Publicação Bluesky falhou: {reason}',
    'Bluesky link preview skipped: {reason}'              => 'Visualização do link Bluesky ignorada: {reason}',

    // Recipient-strategy warnings
    'Recipient "{name}" has no email address.'       => 'O destinatário "{name}" não tem endereço de e-mail.',
    'Recipient "{name}" has no phone number.'        => 'O destinatário "{name}" não tem número de telefone.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => 'O destinatário "{name}" não tem usuário associado; não é possível enviar o anúncio.',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => 'O destinatário "{name}" não tem acesso ao painel de controle; não é possível enviar o anúncio.',
    'Pushover user-key field is not configured on this notification.' => 'O campo da chave de usuário Pushover não está configurado nesta notificação.',
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => 'O destinatário "{name}" não tem usuário associado; não é possível enviar a mensagem Pushover.',
    '[SKIPPED] User "{name}" has no Pushover key.'   => '[IGNORADO] O usuário "{name}" não tem chave Pushover.',
    'Recipient "{name}" has no ntfy topic.'          => 'O destinatário "{name}" não tem tópico ntfy.',
    'Recipient "{name}" has no Bluesky credentials.' => 'O destinatário "{name}" não tem credenciais Bluesky.',

    // Errors / exceptions
    'Invalid element event: {class}'                         => 'Evento de elemento inválido: {class}',
    'Invalid notification ID: {id}'                          => 'ID de notificação inválido: {id}',
    'Invalid email message mode.'                            => 'Modo de mensagem de e-mail inválido.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Você não tem permissão para usar o tipo Destinatários dinâmicos.',
    'Dynamic recipients snippet did not call setRecipients.' => 'O trecho de destinatários dinâmicos não chamou setRecipients.',
    'setRecipients was called with an empty value.'          => 'setRecipients foi chamado com um valor vazio.',
    'Unrecognized recipient of type "{type}".'               => 'Destinatário de tipo "{type}" não reconhecido.',
    'Unrecognized recipient "{value}".'                      => 'Destinatário "{value}" não reconhecido.',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => 'O {kind} configurado não existe mais nas configurações do plug-in (uid: {uid}).',
    'Invalid settings section: {section}'                    => 'Seção de configurações inválida: {section}',
    'User not authorized to save this notification.'         => 'O usuário não tem autorização para salvar esta notificação.',
    'User not authorized to view this notification.'         => 'O usuário não tem autorização para visualizar esta notificação.',
    'User not authorized to delete this notification.'       => 'O usuário não tem autorização para excluir esta notificação.',
    'Notification not found'                                 => 'Notificação não encontrada',

    // Misc config-file note
    'This is being set in the config file. [{file}]' => 'Isto está sendo definido no arquivo de configuração. [{file}]',

    // Slack, ntfy, and Bluesky message types
    "Add the Bluesky accounts you'd like to post from. Each account becomes available as a recipient on the **Recipients** tab when configuring a notification." => 'Adicione as contas Bluesky a partir das quais você deseja publicar. Cada conta fica disponível como destinatário na aba **Destinatários** ao configurar uma notificação.',
    "Click any row's **Test** button to confirm the account authenticates." => 'Clique no botão **Testar** de qualquer linha para confirmar que a conta autentica.',
    "Click any row's **Test** button to send a quick test message to that channel." => 'Clique no botão **Testar** de qualquer linha para enviar uma mensagem de teste rápida a esse canal.',
    'Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`.' => 'Opcional, aponte para uma instância ntfy auto-hospedada (se aplicável). Padrão `https://ntfy.sh`.',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Opcional, necessário para tópicos protegidos ou instâncias auto-hospedadas com autenticação.',
    'Add the ntfy topics you\'d like to send messages to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification.' => 'Adicione os tópicos ntfy para os quais você deseja enviar mensagens. Cada tópico fica disponível como destinatário na aba **Destinatários** ao configurar uma notificação.',
    "Click any row's **Test** button to send a quick test message to that topic." => 'Clique no botão **Testar** de qualquer linha para enviar uma mensagem de teste rápida a esse tópico.',
    'Enable Markdown' => 'Habilitar Markdown',

    // Manual triggers
    'Send Notification'                                            => 'Enviar notificação',
    'Send manual notifications'                                    => 'Enviar notificações manuais',
    'Are you sure you want to send this notification?'             => 'Tem certeza de que deseja enviar esta notificação?',
    'This notification cannot be triggered manually.'              => 'Esta notificação não pode ser acionada manualmente.',
    'This notification no longer applies to the selected element.' => 'Esta notificação não se aplica mais ao elemento selecionado.',
    'Notification was not sent. Check the Notification Log for details.' => 'A notificação não foi enviada. Consulte o Registro de notificações para mais detalhes.',
    'Notification sent.'                                           => 'Notificação enviada.',
    'Element not found'                                            => 'Elemento não encontrado',
    'Trigger Label'                                                => 'Rótulo do acionador',
    'An element action label (helps to differentiate multiple triggers).'        => 'Um rótulo de ação de elemento (ajuda a diferenciar vários acionadores).',

    // Event tab: date trigger
    'On'                                                          => 'Em',
    'days before'                                                 => 'dias antes',
    'days after'                                                  => 'dias depois',
    'Relevant Date'                                               => 'Data relevante',
    'Send the notification relative to a chosen date.'            => 'Envie a notificação em relação a uma data escolhida.',

    // Scheduled sending
    'Scheduled Sending' => 'Envio agendado',
    'Shared secret for authenticating scheduled-run web requests. Required only when the schedule is triggered via the web endpoint.' => 'Segredo compartilhado para autenticar solicitações web de execução agendada. Necessário apenas quando o agendamento é acionado através do endpoint web.',
    'Scheduled-Run Token' => 'Token de execução agendada',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => 'Enviado em cada solicitação como o cabeçalho X-Notifier-Token ou parâmetro token no corpo.',
    'Pushover Title' => 'Título Pushover',
    'Pushover Body' => 'Corpo Pushover',
    'ntfy Title' => 'Título ntfy',
    'ntfy Body' => 'Corpo ntfy',
    'ntfy Link URL' => 'URL do link ntfy',
    'Render Link Previews' => 'Mostrar pré-visualizações',
    'Don\'t unfurl' => 'Não expandir',
    'Expand link previews' => 'Expandir pré-visualizações',
    'Regular text only' => 'Apenas texto simples',
    'Markdown enabled' => 'Markdown ativado',
    'Dynamic Pushover Title' => 'Título Pushover dinâmico',
    'Dynamic Subject Line' => 'Linha de assunto dinâmica',
    'Dynamic Bot Name' => 'Nome do bot dinâmico',
    'Dynamic ntfy Title' => 'Título ntfy dinâmico',
    'Dynamic Announcement Title' => 'Título de anúncio dinâmico',
    'Dynamic Flash Message Title' => 'Título da mensagem Flash dinâmica',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => 'Texto simples, máximo 300 caracteres. URLs e menções `@handle.tld` viram links automaticamente.',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => 'Gerar automaticamente um card de pré-visualização quando o corpo do post incluir uma URL.',
    'Whether the message be sent via the [jobs queue]({queueUrl}).' => 'Se a mensagem deve ser enviada pela [fila de tarefas]({queueUrl}).',
    'Priority level of the ntfy message.' => 'Nível de prioridade da mensagem ntfy.',
    'Optionally include comma-separated [emoji shortcodes](https://docs.ntfy.sh/emojis/).' => 'Opcionalmente inclua [códigos de emoji](https://docs.ntfy.sh/emojis/) separados por vírgulas.',
    'Body of the ntfy notification.' => 'Corpo da notificação ntfy.',
    'Optionally open a URL when the notification is clicked.' => 'Opcionalmente abra uma URL quando a notificação for clicada.',
    'Whether to parse the body as Markdown in supported clients.' => 'Se o corpo deve ser renderizado como Markdown em clientes compatíveis.',
    'Heading of the announcement.' => 'Título do anúncio.',
    'Body of the announcement. Supports Markdown.' => 'Corpo do anúncio. Compatível com Markdown.',
    'Heading of the flash message.' => 'Título da mensagem Flash.',
    'Optionally include details below the heading. Supports Markdown and HTML.' => 'Opcionalmente inclua detalhes abaixo do título. Compatível com Markdown e HTML.',
    'Optionally include a heading above the body.' => 'Opcionalmente inclua um título acima do corpo.',
    'Body of the SMS (text message). Plain text only.' => 'Corpo do SMS (mensagem de texto). Apenas texto simples.',
    'Body of the Pushover notification. Plain text only.' => 'Corpo da notificação Pushover. Apenas texto simples.',
    'Subject line of the email.' => 'Linha de assunto do e-mail.',
    'Body of the email. Supports HTML.' => 'Corpo do e-mail. Compatível com HTML.',
    'Optionally override the app\'s display name.' => 'Opcionalmente substitua o nome de exibição do app.',
    'Optionally override the app\'s icon with a URL.' => 'Opcionalmente substitua o ícone do app por uma URL.',
    'Optionally override the app\'s icon with an emoji. Used only when Bot Icon URL is empty.' => 'Opcionalmente substitua o ícone do app por um emoji. Usado apenas quando Bot Icon URL está vazio.',
    'Invalid Slack body format.' => 'Formato de corpo Slack inválido.',
    'Supports standard [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) syntax. Optionally supports HTML _(see below)_.' => 'Suporta a sintaxe [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) padrão. Opcionalmente suporta HTML _(ver abaixo)_.',
    'Render Message Body as HTML' => 'Renderizar corpo da mensagem como HTML',
    'Whether to only parse as [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), or additionally parse it as HTML.' => 'Analisar apenas como [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), ou também como HTML.',
    'mrkdwn only' => 'apenas mrkdwn',
    'mrkdwn + HTML' => 'mrkdwn + HTML',
];
