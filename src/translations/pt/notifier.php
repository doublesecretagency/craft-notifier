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
    'Notifications'          => 'Notificações',
    'Notification'           => 'Notificação',
    'All notifications'      => 'Todas as notificações',
    'Notification Log'       => 'Registo de notificações',
    'Logs'                   => 'Registos',
    'View Notifications'     => 'Ver notificações',
    'Add a New Notification' => 'Adicionar uma nova notificação',

    // Permissions
    'View notifications'              => 'Ver notificações',
    'Save notifications'              => 'Guardar notificações',
    'Use the Dynamic Recipients type' => 'Utilizar o tipo Destinatários dinâmicos',
    'Test notifications'              => 'Testar notificações',
    'Delete notifications'            => 'Eliminar notificações',
    'View notification log'           => 'Ver registo de notificações',
    'Delete notification log'         => 'Eliminar registo de notificações',

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
    'Commerce Orders Event'          => 'Evento de encomenda Commerce',
    'Commerce Products Event'        => 'Evento de produto Commerce',
    'Digital Products Event'         => 'Evento Digital Products',
    'Digital Product Licenses Event' => 'Evento de licença Digital Products',
    'Solspace Calendar Event'        => 'Evento Solspace Calendar',
    'Entries Event'                  => 'Evento de entradas',
    'Users Event'                    => 'Evento de utilizadores',
    'Ungrouped Users'                => 'Utilizadores sem grupo',

    // Field and element conditions
    'Field Conditions'             => 'Condições de campo',
    'Send the message only when the saved element matches the following conditions.' => 'Enviar a mensagem apenas quando o elemento guardado corresponder às condições seguintes.',
    'has changed'                  => 'foi alterado',
    '#{elementType} Event Filters' => 'Filtros de eventos para #{elementType}',
    'No filters match this event.' => 'Nenhum filtro corresponde a este evento.',
    'Determine whether each message should be sent based on specified conditions.' => 'Determine, com base nas condições especificadas, se cada mensagem deve ser enviada.',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => 'O elemento está a ser guardado pela primeira vez',
    'Must be a new entry'                       => 'Tem de ser uma nova entrada',
    'Must be an existing entry'                 => 'Tem de ser uma entrada existente',
    'Can be existing or new'                    => 'Pode ser existente ou novo',

    // Filters: new elements
    'Element is new'         => 'O elemento é novo',
    'New elements only'      => 'Apenas elementos novos',
    'Existing elements only' => 'Apenas elementos existentes',

    // Filters: enabled state
    'Element is enabled'         => 'O elemento está ativado',
    'Must be enabled'            => 'Tem de estar ativado',
    'Must be disabled'           => 'Tem de estar desativado',
    'Can be enabled or disabled' => 'Pode estar ativado ou desativado',

    // Filters: drafts
    'Element is a draft'          => 'O elemento é um rascunho',
    'Must be a draft'             => 'Tem de ser um rascunho',
    'Must not be a draft'         => 'Não pode ser um rascunho',
    'Can be a draft or non-draft' => 'Pode ser rascunho ou não',

    // Filters: provisional drafts
    'Element is a provisional draft'                => 'O elemento é um rascunho provisório',
    'Must be a provisional draft'                   => 'Tem de ser um rascunho provisório',
    'Must not be a provisional draft'               => 'Não pode ser um rascunho provisório',
    'Can be a provisional draft or non-provisional' => 'Pode ser provisório ou não',

    // Filters: revisions
    'Element is a revision'             => 'O elemento é uma revisão',
    'Must be a revision'                => 'Tem de ser uma revisão',
    'Must not be a revision'            => 'Não pode ser uma revisão',
    'Can be a revision or non-revision' => 'Pode ser revisão ou não',

    // Filters: duplication
    'Element is being duplicated'         => 'O elemento está a ser duplicado',
    'Must be duplicating the element'     => 'Tem de estar a duplicar o elemento',
    'Must not be duplicating the element' => 'Não pode estar a duplicar o elemento',

    // Filters: propagation
    'Element is being propagated'     => 'O elemento está a ser propagado',
    'Element must be propagating'     => 'O elemento tem de estar a propagar',
    'Element must not be propagating' => 'O elemento não pode estar a propagar',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => 'O elemento está a ser regravado em massa',
    'Must be bulk-resaving the element'     => 'Tem de estar a regravar o elemento em massa',
    'Must not be bulk-resaving the element' => 'Não pode estar a regravar o elemento em massa',

    // Filters: common output
    'Unnamed filter'                => 'Filtro sem nome',
    'Must be TRUE to send message'  => 'Tem de ser TRUE para enviar a mensagem',
    'Must be FALSE to send message' => 'Tem de ser FALSE para enviar a mensagem',
    'No effect'                     => 'Sem efeito',

    // Message tab: type selector and queue
    'Message Type'                       => 'Tipo de mensagem',
    'What type of message will be sent?' => 'Que tipo de mensagem será enviado?',
    'Send Message via Queue'             => 'Enviar mensagem através da fila',
    'Should the message be sent via the [jobs queue]({queueUrl})?' => 'A mensagem deve ser enviada através da [fila de tarefas]({queueUrl})?',
    'Send immediately' => 'Enviar de imediato',
    'Add to queue' => 'Adicionar à fila',

    // Message tab: Email fields
    "User's Email Address Field" => 'Campo de endereço de e-mail do utilizador',
    'Email Subject'              => 'Assunto do e-mail',
    'Email Body'                 => 'Corpo do e-mail',

    // Message tab: SMS fields
    "User's Phone Number Field" => 'Campo de número de telefone do utilizador',
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
    "Field containing each user's Pushover key" => 'Campo da chave Pushover do utilizador',
    'The Pushover application token is configured in [Settings → Pushover](url).' => 'O token de aplicação Pushover é configurado em [Definições → Pushover](url).',

    // Message tab: ntfy fields
    'Priority'           => 'Prioridade',
    'Tags'               => 'Etiquetas',
    'Click URL'          => 'URL de clique',
    'Render as Markdown' => 'Renderizar como Markdown',

    // Message tab: Slack fields
    'Slack Message Body' => 'Corpo da mensagem Slack',

    // Message tab: Bluesky fields
    'Post Body' => 'Corpo da publicação',
    'Generate Link Preview' => 'Gerar pré-visualização da ligação',
    "When the post body contains a URL, automatically generate a preview card with the linked page's image, title, and description." => 'Quando o corpo da publicação contém um URL, é anexado um cartão de pré-visualização com o título, a descrição e a imagem da página ligada.',
    'No card' => 'Sem cartão',
    'Generate preview card' => 'Gerar cartão de pré-visualização',

    // Message tab: Title / Body / Trix toolbar
    'Title'         => 'Título',
    'Body'          => 'Corpo',
    'Rich Text'     => 'Texto formatado',
    'Bold'          => 'Negrito',
    'Italic'        => 'Itálico',
    'Underline'     => 'Sublinhado',
    'Strikethrough' => 'Rasurado',
    'Bullets'       => 'Marcadores',
    'Numbers'       => 'Numeração',
    'Heading'       => 'Cabeçalho',
    'Code'          => 'Código',
    'Undo'          => 'Anular',
    'Redo'          => 'Refazer',
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => 'Corpo do e-mail enviado. Pode usar <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">variáveis especiais</a>, ou até <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">ignorar destinatários</a>.',

    // Recipients tab: common
    'Recipients Type'                             => 'Tipo de destinatários',
    'Who will receive this message?'              => 'Quem receberá esta mensagem?',
    'Add a message recipient'                     => 'Adicionar um destinatário',
    'Select User(s)'                              => 'Selecionar utilizador(es)',
    'Which users will receive the message?'       => 'Que utilizadores receberão a mensagem?',
    'Which user groups will receive the message?' => 'Que grupos de utilizadores receberão a mensagem?',
    'Twig Snippet to Determine Recipients'        => 'Fragmento Twig para determinar os destinatários',

    // Recipients tab: per-provider pickers
    'Select Slack channel(s)'                           => 'Selecionar canal/canais de Slack',
    'Which Slack channels should receive this message?' => 'Que canais do Slack receberão esta mensagem?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Sem canais de Slack configurados. Adicione um em [Definições → Slack]({url}).',
    'Select ntfy topic(s)'                              => 'Selecionar tópico(s) ntfy',
    'Which ntfy topics should receive this message?'    => 'Que tópicos ntfy receberão esta mensagem?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'Sem tópicos ntfy configurados. Adicione um em [Definições → ntfy]({url}).',
    'Select Bluesky account(s)'                         => 'Selecionar conta(s) Bluesky',
    'Which Bluesky accounts should post this message?'  => 'Que contas Bluesky devem publicar esta mensagem?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Sem contas Bluesky configuradas. Adicione uma em [Definições → Bluesky]({url}).',

    // Settings: page chrome
    'Notifier Settings' => 'Definições Notifier',
    'General'           => 'Geral',
    'Twilio'            => 'Twilio',
    'Pushover'          => 'Pushover',
    'Slack'             => 'Slack',
    'Bluesky'           => 'Bluesky',
    'ntfy'              => 'ntfy',

    // Settings: Logging
    'Logging'                             => 'Registo',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'O Notifier mantém um registo contínuo das mensagens enviadas. Normalmente não é necessário, mas pode limitar a quantidade de eventos guardados na base de dados.',
    'Enable Logging'                      => 'Ativar registo',
    'When disabled, Notifier will not write anything to the notification log.' => 'Quando desativado, o Notifier não escreve nada no registo de notificações.',
    'Number of days to retain log events' => 'Número de dias para reter eventos de registo',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Reter eventos de registo no máximo durante estes dias. Deixe vazio para sem limite.',
    'Number of log events to retain'      => 'Número de eventos de registo a reter',
    'At most, keep this many log events. Leave blank for no limit.' => 'Reter no máximo este número de eventos. Deixe vazio para sem limite.',

    // Settings: Twilio
    'Twilio API Credentials'                       => 'Credenciais da API Twilio',
    'If using the Twilio API to send SMS messages, the following credentials are required.' => 'Se utilizar a API Twilio para enviar mensagens SMS, são necessárias as credenciais seguintes.',
    'Twilio Account SID'                           => 'Twilio Account SID',
    'Twilio Auth Token'                            => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)' => 'Número de telefone Twilio (envia cada SMS)',
    'SMS Testing'                                  => 'Testes de SMS',
    'Optional. When set, every SMS dispatched will be sent to this number instead of the resolved recipient.' => 'Opcional. Quando definido, todos os SMS enviados serão para este número em vez do destinatário resolvido.',
    'Test phone number'                            => 'Número de telefone de teste',

    // Settings: Pushover
    "[Pushover](https://pushover.net) sends push notifications to a registered user's devices. Each Craft user needs a custom field on their profile storing their Pushover user key; you select which field on each Notification's Message tab. For full setup instructions, see the [Pushover getting-started docs](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover)." => 'O [Pushover](https://pushover.net) envia notificações push para os dispositivos de um utilizador registado. Cada utilizador Craft precisa de um campo personalizado no perfil que armazene a sua chave Pushover; selecione qual campo no separador Mensagem de cada notificação. Para instruções completas de configuração, consulte a [documentação inicial do Pushover](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover).',
    'Application API Token'                                      => 'Token de API da aplicação',
    'The 30-character app token from your Pushover application.' => 'O token de aplicação de 30 caracteres da sua aplicação Pushover.',

    // Settings: ntfy
    'ntfy.sh is a free HTTP-based push notification service. Subscribers receive messages on the ntfy app, web, or any compatible client by joining a topic.' => 'O ntfy.sh é um serviço gratuito de notificações push baseado em HTTP. Os subscritores recebem mensagens na aplicação ntfy, na web ou em qualquer cliente compatível ao subscrever um tópico.',
    'Server URL'   => 'URL do servidor',
    'Defaults to https://ntfy.sh. Point at a self-hosted ntfy instance if applicable.' => 'Predefinição https://ntfy.sh. Aponte para uma instância ntfy auto-hospedada, se aplicável.',
    'Access token' => 'Token de acesso',
    'Optional. Required for protected topics or self-hosted instances with auth.' => 'Opcional. Necessário para tópicos protegidos ou instâncias auto-hospedadas com autenticação.',
    'ntfy Topics'  => 'Tópicos ntfy',
    'Named list of ntfy topics. Each topic becomes selectable on the notification edit screen.' => 'Lista nomeada de tópicos ntfy. Cada tópico fica selecionável no ecrã de edição da notificação.',
    'Topics'       => 'Tópicos',
    'Add one row per topic name. Use the **Test** button to send a quick test message to the topic.' => 'Adicione uma linha por nome de tópico. Use o botão **Test** para enviar uma mensagem de teste rápida ao tópico.',
    'Topic'        => 'Tópico',
    'Add a topic'  => 'Adicionar um tópico',
    'Save first to persist a row, then click its **Test** button to fire a sanity check against ntfy.' => 'Guarde primeiro para preservar uma linha e clique no seu botão **Test** para realizar uma verificação rápida ao ntfy.',

    // Settings: Slack
    'Slack Channels' => 'Canais de Slack',
    'Channels'       => 'Canais',
    'Each Slack channel needs its own Incoming Webhook URL. Use the **Test** button to fire a quick sanity check after saving.' => 'Cada canal Slack precisa do seu próprio URL Incoming Webhook. Use o botão **Test** para fazer uma verificação rápida após guardar.',
    'Webhook URL'    => 'URL do webhook',
    'Add a channel'  => 'Adicionar um canal',
    'Save first to persist a row, then click its **Test** button to fire a sanity check against Slack.' => 'Guarde primeiro para preservar uma linha e clique no seu botão **Test** para realizar uma verificação rápida ao Slack.',

    // Settings: Bluesky
    '[Bluesky](https://bsky.app) posts publish to the configured account\'s feed via the ATProto API. App passwords are generated at [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). An app password is a secret, so store it in a `.env` variable and reference that variable (e.g. `$BLUESKY_APP_PASSWORD`) rather than pasting the password directly.' => 'As publicações do [Bluesky](https://bsky.app) são publicadas no feed da conta configurada através da API ATProto. As palavras-passe de aplicação são geradas em [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). Uma palavra-passe de aplicação é um segredo, por isso guarde-a numa variável `.env` e referencie essa variável (por exemplo, `$BLUESKY_APP_PASSWORD`) em vez de colar a palavra-passe diretamente.',
    'PDS URL'          => 'URL do PDS',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'Predefinição https://bsky.social. Aponte para um PDS personalizado se a sua instalação federar.',
    'Bluesky Accounts' => 'Contas Bluesky',
    'Named list of Bluesky accounts. Each account becomes selectable on the notification edit screen.' => 'Lista nomeada de contas Bluesky. Cada conta fica selecionável no ecrã de edição da notificação.',
    'Accounts'         => 'Contas',
    'Add one row per Bluesky account. Use **Test** to verify the credentials authenticate.' => 'Adicione uma linha por conta Bluesky. Use **Test** para verificar se as credenciais autenticam.',
    'Label'            => 'Etiqueta',
    'Handle'           => 'Identificador',
    'App password'     => 'Palavra-passe de aplicação',
    'Add an account'   => 'Adicionar uma conta',
    'Save first to persist a row, then click its **Test** button to verify the credentials authenticate.' => 'Guarde primeiro para preservar uma linha e clique no seu botão **Test** para verificar se as credenciais autenticam.',

    // Test notification (UI)
    'Send a test message'           => 'Enviar uma mensagem de teste',
    'Are you certain you want to send a test notification?\\n\\nThe configured message will be sent to the configured recipient(s).' => 'Tem a certeza de que pretende enviar uma notificação de teste?\\n\\nA mensagem configurada será enviada aos destinatários configurados.',
    'Test'                          => 'Testar',
    'Test notification dispatched.' => 'Notificação de teste enviada.',
    'No messages were dispatched. Check the recipient configuration.' => 'Não foram enviadas mensagens. Verifique a configuração dos destinatários.',

    // Settings: save / test action responses
    "Couldn't save settings."                 => 'Não foi possível guardar as definições.',
    'Settings saved.'                         => 'Definições guardadas.',
    'Topic is empty.'                         => 'O tópico está vazio.',
    'Server URL is not configured.'           => 'URL do servidor não configurado.',
    'Test message from Notifier.'             => 'Mensagem de teste do Notifier.',
    'HTTP {status}'                           => 'HTTP {status}',
    'Test message sent successfully.'         => 'Mensagem de teste enviada com sucesso.',
    'HTTP {status}: {body}'                   => 'HTTP {status}: {body}',
    'Handle and app password are required.'   => 'O identificador e a palavra-passe de aplicação são obrigatórios.',
    'Authentication failed.'                  => 'Falha de autenticação.',
    'Successfully authenticated. No messages were posted.' => 'Autenticação bem-sucedida. Não foi publicada nenhuma mensagem.',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.'          => 'A enviar {messageType} para {recipient}.',
    'Adding message to queue.'                       => 'A adicionar mensagem à fila.',
    'Sending message immediately (bypassing queue).' => 'A enviar a mensagem de imediato (a ignorar a fila).',
    'Log events deleted.'                            => 'Eventos de registo eliminados.',
    'notification'                                   => 'notificação',

    // Outbound: Email log messages
    'Unable to send email, no recipient specified.'     => 'Não é possível enviar o e-mail: nenhum destinatário especificado.',
    'Unable to send email, the message body was empty.' => 'Não é possível enviar o e-mail: o corpo da mensagem estava vazio.',
    "Unable to send the email using Craft's native email handling." => 'Não é possível enviar o e-mail utilizando a gestão de e-mails nativa do Craft.',
    'Check your general email settings within Craft.'   => 'Verifique as definições gerais de e-mail no Craft.',
    'Successfully sent email message!'                  => 'E-mail enviado com sucesso!',

    // Outbound: SMS log messages
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[Credenciais Twilio inválidas.]({url}) Em falta: {missing}.',
    'Unable to send SMS, no Twilio phone number exists.'      => 'Não é possível enviar o SMS: nenhum número de telefone Twilio existe.',
    'Unable to send SMS, no recipient phone number exists.'   => 'Não é possível enviar o SMS: nenhum número de telefone do destinatário existe.',
    'Unable to send SMS, recipient phone number is invalid.'  => 'Não é possível enviar o SMS: o número de telefone do destinatário é inválido.',
    'Successfully sent SMS message!'                          => 'SMS enviado com sucesso!',

    // Outbound: Announcement log messages
    'Unable to post announcement, no recipient userId specified.' => 'Não é possível publicar o anúncio: nenhum userId do destinatário especificado.',
    'Successfully posted announcement!' => 'Anúncio publicado com sucesso!',

    // Outbound: Flash log messages
    'Unable to send the flash message, invalid flash type.' => 'Não é possível enviar a mensagem flash: tipo de flash inválido.',
    'Successfully sent flash message!'                      => 'Mensagem flash enviada com sucesso!',

    // Outbound: Pushover log messages
    '[Invalid Pushover credentials.]({url}) Missing app token.'  => '[Credenciais Pushover inválidas.]({url}) Token de aplicação em falta.',
    'Unable to send Pushover message, no user key on recipient.' => 'Não é possível enviar a mensagem Pushover: nenhuma chave de utilizador no destinatário.',
    'Pushover POST failed: {reason}'                             => 'POST Pushover falhou: {reason}',
    'Successfully sent Pushover message!'                        => 'Mensagem Pushover enviada com sucesso!',

    // Outbound: ntfy log messages
    'Unable to send ntfy message, no server URL configured.' => 'Não é possível enviar a mensagem ntfy: URL do servidor não configurado.',
    'Unable to send ntfy message, no topic specified.'       => 'Não é possível enviar a mensagem ntfy: nenhum tópico especificado.',
    'ntfy POST failed with HTTP {status}: {reason}'          => 'POST ntfy falhou com HTTP {status}: {reason}',
    'ntfy POST failed: {reason}'                             => 'POST ntfy falhou: {reason}',
    'Successfully sent ntfy message to topic "{topic}".'     => 'Mensagem ntfy enviada com sucesso para o tópico "{topic}".',

    // Outbound: Slack log messages
    'Unable to send Slack message, no webhook URL.' => 'Não é possível enviar a mensagem Slack: nenhum URL de webhook.',
    'Unable to send Slack message, webhook URL is not valid.' => 'Não é possível enviar a mensagem Slack: URL do webhook não é válido.',
    'Unable to send Slack message, body is empty.'  => 'Não é possível enviar a mensagem Slack: o corpo está vazio.',
    'Slack POST failed (HTTP {status}): {reason}'   => 'POST Slack falhou (HTTP {status}): {reason}',
    'Slack POST failed: {reason}'                   => 'POST Slack falhou: {reason}',
    'Successfully sent Slack message to "{label}".' => 'Mensagem Slack enviada com sucesso para "{label}".',

    // Outbound: Bluesky log messages
    'Unable to send Bluesky post, recipient is missing credentials.' => 'Não é possível enviar a publicação Bluesky: o destinatário não tem credenciais.',
    'Body exceeded {max} characters, truncated.'          => 'O corpo ultrapassou {max} carateres e foi truncado.',
    'Successfully posted to Bluesky as "{label}".'        => 'Publicado com sucesso no Bluesky como "{label}".',
    'Bluesky auth failed for {handle}: {reason}'          => 'Falha de autenticação Bluesky para {handle}: {reason}',
    'Bluesky auth failed: {reason}'                       => 'Falha de autenticação Bluesky: {reason}',
    'Bluesky post failed: {reason}'                       => 'Publicação Bluesky falhou: {reason}',
    'Bluesky link preview skipped: {reason}'              => 'Pré-visualização da ligação Bluesky ignorada: {reason}',

    // Recipient-strategy warnings
    'Recipient "{name}" has no email address.'       => 'O destinatário "{name}" não tem endereço de e-mail.',
    'Recipient "{name}" has no phone number.'        => 'O destinatário "{name}" não tem número de telefone.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => 'O destinatário "{name}" não tem utilizador associado; não é possível enviar o anúncio.',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => 'O destinatário "{name}" não tem acesso ao painel de controlo; não é possível enviar o anúncio.',
    'Pushover user-key field is not configured on this notification.' => 'O campo da chave de utilizador Pushover não está configurado nesta notificação.',
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => 'O destinatário "{name}" não tem utilizador associado; não é possível enviar a mensagem Pushover.',
    '[SKIPPED] User "{name}" has no Pushover key.'   => '[IGNORADO] O utilizador "{name}" não tem chave Pushover.',
    'Recipient "{name}" has no ntfy topic.'          => 'O destinatário "{name}" não tem tópico ntfy.',
    'Recipient "{name}" has no Slack webhook URL.'   => 'O destinatário "{name}" não tem URL de webhook Slack.',
    'Recipient "{name}" has no Bluesky credentials.' => 'O destinatário "{name}" não tem credenciais Bluesky.',

    // Errors / exceptions
    'Invalid element event: {class}'                         => 'Evento de elemento inválido: {class}',
    'Invalid notification ID: {id}'                          => 'ID de notificação inválido: {id}',
    'Invalid email message mode.'                            => 'Modo de mensagem de e-mail inválido.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Não tem permissão para usar o tipo Destinatários dinâmicos.',
    'Dynamic recipients snippet did not call setRecipients.' => 'O fragmento de destinatários dinâmicos não chamou setRecipients.',
    'setRecipients was called with an empty value.'          => 'setRecipients foi chamado com um valor vazio.',
    'Unrecognized recipient of type "{type}".'               => 'Destinatário de tipo "{type}" não reconhecido.',
    'Unrecognized recipient "{value}".'                      => 'Destinatário "{value}" não reconhecido.',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => 'O {kind} configurado já não existe nas definições do plug-in (uid: {uid}).',
    'Invalid settings section: {section}'                    => 'Secção de definições inválida: {section}',
    'User not authorized to save this notification.'         => 'O utilizador não tem autorização para guardar esta notificação.',
    'User not authorized to view this notification.'         => 'O utilizador não tem autorização para ver esta notificação.',
    'User not authorized to delete this notification.'       => 'O utilizador não tem autorização para eliminar esta notificação.',
    'Notification not found'                                 => 'Notificação não encontrada',

    // Misc config-file note
    'This is being set in the config file. [{file}]' => 'Isto está a ser definido no ficheiro de configuração. [{file}]',

    // Slack, ntfy, and Bluesky message types
    "Add the Bluesky accounts you'd like to post from. Each account becomes available as a recipient on the **Recipients** tab when configuring a notification." => 'Adicione as contas Bluesky a partir das quais pretende publicar. Cada conta fica disponível como destinatário no separador **Destinatários** ao configurar uma notificação.',
    "Click any row's **Test** button to confirm the account authenticates." => 'Clique no botão **Test** de qualquer linha para confirmar que a conta autentica.',
    'Add an [Incoming Webhook](https://api.slack.com/messaging/webhooks) for each Slack channel you\'d like to post into. Each webhook becomes available as a recipient on the **Recipients** tab when configuring a notification. A webhook URL is a secret, so store it in a `.env` variable and reference that variable (e.g. `$SLACK_WEBHOOK_URL`) rather than pasting the URL directly.' => 'Adicione um [Incoming Webhook](https://api.slack.com/messaging/webhooks) para cada canal do Slack onde quer publicar. Cada webhook fica disponível como destinatário no separador **Recipients** ao configurar uma notificação. Um URL de webhook é um segredo, por isso guarde-o numa variável `.env` e referencie essa variável (por exemplo, `$SLACK_WEBHOOK_URL`) em vez de colar o URL diretamente.',
    "Click any row's **Test** button to send a quick test message to that channel." => 'Clique no botão **Test** de qualquer linha para enviar uma mensagem de teste rápida a esse canal.',
    "Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`." => 'Opcional. Aponte para uma instância ntfy auto-hospedada, se aplicável. Predefinição `https://ntfy.sh`.',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Opcional. Necessário para tópicos protegidos ou instâncias auto-hospedadas com autenticação.',
    "Add the ntfy topics you'd like to send messages to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification." => 'Adicione os tópicos ntfy para os quais pretende enviar mensagens. Cada tópico fica disponível como destinatário no separador **Destinatários** ao configurar uma notificação.',
    "Click any row's **Test** button to send a quick test message to that topic." => 'Clique no botão **Test** de qualquer linha para enviar uma mensagem de teste rápida a esse tópico.',
    'Enable Markdown' => 'Ativar Markdown',
    'Link URL' => 'URL da ligação',
    'Not a valid Webhook URL. Must start with https://hooks.slack.com/services/' => 'URL de webhook inválido. Tem de começar por https://hooks.slack.com/services/',
];
