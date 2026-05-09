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
    'View notification log'           => 'Ver o registro de notificações',
    'Delete notification log'         => 'Excluir o registro de notificações',

    // Notification editor: tabs
    'Meta'       => 'Meta',
    'Event'      => 'Evento',
    'Message'    => 'Mensagem',
    'Recipients' => 'Destinatários',

    // Event tab
    'Event Type'                                           => 'Tipo de evento',
    'What type of event will activate the notification?'   => 'Que tipo de evento ativará a notificação?',
    'Which specific event will activate the notification?' => 'Qual evento específico ativará a notificação?',
    'Assets Event'                                         => 'Evento de Recursos',
    'Commerce Orders Event'                                => 'Evento de Pedidos do Commerce',
    'Entries Event'                                        => 'Evento de Entradas',
    'Users Event'                                          => 'Evento de Usuários',

    // Field and element conditions
    'Field Conditions'                                                               => 'Condições de campo',
    'Send the message only when the saved element matches the following conditions.' => 'Enviar a mensagem somente quando o elemento salvo atender às condições a seguir.',
    'has changed'                                                                    => 'foi alterado',
    '#{elementType} Event Filters'                                                   => 'Filtros de evento de #{elementType}',
    'No filters match this event.'                                                   => 'Nenhum filtro corresponde a este evento.',
    'Determine whether each message should be sent based on specified conditions.'   => 'Defina se cada mensagem deve ser enviada com base nas condições especificadas.',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => 'O elemento está sendo salvo pela primeira vez',
    'Must be a new entry'                       => 'Deve ser uma nova entrada',
    'Must be an existing entry'                 => 'Deve ser uma entrada existente',
    'Can be existing or new'                    => 'Pode ser existente ou nova',

    // Filters: new elements
    'Element is new'         => 'O elemento é novo',
    'New elements only'      => 'Somente elementos novos',
    'Existing elements only' => 'Somente elementos existentes',

    // Filters: enabled state
    'Element is enabled'         => 'O elemento está ativado',
    'Must be enabled'            => 'Deve estar ativado',
    'Must be disabled'           => 'Deve estar desativado',
    'Can be enabled or disabled' => 'Pode estar ativado ou desativado',

    // Filters: drafts
    'Element is a draft'          => 'O elemento é um rascunho',
    'Must be a draft'             => 'Deve ser um rascunho',
    'Must not be a draft'         => 'Não deve ser um rascunho',
    'Can be a draft or non-draft' => 'Pode ser rascunho ou não',

    // Filters: provisional drafts
    'Element is a provisional draft'                => 'O elemento é um rascunho provisório',
    'Must be a provisional draft'                   => 'Deve ser um rascunho provisório',
    'Must not be a provisional draft'               => 'Não deve ser um rascunho provisório',
    'Can be a provisional draft or non-provisional' => 'Pode ser provisório ou não provisório',

    // Filters: revisions
    'Element is a revision'             => 'O elemento é uma revisão',
    'Must be a revision'                => 'Deve ser uma revisão',
    'Must not be a revision'            => 'Não deve ser uma revisão',
    'Can be a revision or non-revision' => 'Pode ser revisão ou não',

    // Filters: duplication
    'Element is being duplicated'         => 'O elemento está sendo duplicado',
    'Must be duplicating the element'     => 'Deve estar duplicando o elemento',
    'Must not be duplicating the element' => 'Não deve estar duplicando o elemento',

    // Filters: propagation
    'Element is being propagated'     => 'O elemento está sendo propagado',
    'Element must be propagating'     => 'O elemento deve estar sendo propagado',
    'Element must not be propagating' => 'O elemento não deve estar sendo propagado',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => 'O elemento está sendo ressalvo em lote',
    'Must be bulk-resaving the element'     => 'Deve estar ressalvando o elemento em lote',
    'Must not be bulk-resaving the element' => 'Não deve estar ressalvando o elemento em lote',

    // Filters: common output
    'Unnamed filter'                => 'Filtro sem nome',
    'Must be TRUE to send message'  => 'Deve ser TRUE para enviar a mensagem',
    'Must be FALSE to send message' => 'Deve ser FALSE para enviar a mensagem',
    'No effect'                     => 'Sem efeito',

    // Message tab: type selector and queue
    'Message Type'                                                 => 'Tipo de mensagem',
    'What type of message will be sent?'                           => 'Que tipo de mensagem será enviada?',
    'Send Message via Queue'                                       => 'Enviar mensagem pela fila',
    'Should the message be sent via the [jobs queue]({queueUrl})?' => 'A mensagem deve ser enviada pela [fila de tarefas]({queueUrl})?',

    // Email message
    'Email Subject'              => 'Assunto do e-mail',
    'Email Body'                 => 'Corpo do e-mail',
    "User's Email Address Field" => 'Campo de endereço de e-mail do usuário',

    // SMS message
    'SMS Message Body'          => 'Corpo da mensagem SMS',
    "User's Phone Number Field" => 'Campo de número de telefone do usuário',

    // Announcement message
    'Announcement Title'   => 'Título do anúncio',
    'Announcement Message' => 'Mensagem do anúncio',

    // Flash message
    'Flash Message Type'                         => 'Tipo de mensagem flash',
    'Flash Message Title'                        => 'Título da mensagem flash',
    'Flash Message Details'                      => 'Detalhes da mensagem flash',
    'Which type of flash message should appear?' => 'Que tipo de mensagem flash deve aparecer?',

    // Trix toolbar (rich-text editing)
    'Rich Text'     => 'Texto formatado',
    'Bold'          => 'Negrito',
    'Italic'        => 'Itálico',
    'Underline'     => 'Sublinhado',
    'Strikethrough' => 'Tachado',
    'Bullets'       => 'Marcadores',
    'Numbers'       => 'Numeração',
    'Heading'       => 'Título',
    'Code'          => 'Código',
    'Undo'          => 'Desfazer',
    'Redo'          => 'Refazer',

    // Email body instructions (HTML)
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => 'Corpo do e-mail enviado. Você pode usar <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">variáveis especiais</a>, ou até <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">pular destinatários</a>.',

    // Recipients tab
    'Recipients Type'                             => 'Tipo de destinatários',
    'Who will receive this message?'              => 'Quem receberá esta mensagem?',
    'Add a message recipient'                     => 'Adicionar um destinatário',
    'Select User(s)'                              => 'Selecionar usuário(s)',
    'Which users will receive the message?'       => 'Quais usuários receberão a mensagem?',
    'Which user groups will receive the message?' => 'Quais grupos de usuários receberão a mensagem?',
    'Ungrouped Users'                             => 'Usuários sem grupo',
    'Twig Snippet to Determine Recipients'        => 'Trecho Twig para determinar destinatários',

    // Settings: Twilio
    'Twilio Account SID'                             => 'Twilio Account SID',
    'Twilio Auth Token'                              => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)'   => 'Número de telefone do Twilio (envia cada mensagem SMS)',
    'This is being set in the config file. [{file}]' => 'Definido no arquivo de configuração. [{file}]',

    // Settings: Logging
    'Logging'                                                                                                                                         => 'Registro',
    'Enable Logging'                                                                                                                                  => 'Ativar registro',
    'When disabled, Notifier will not write anything to the notification log.'                                                                        => 'Quando desativado, o Notifier não escreverá nada no registro de notificações.',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'O Notifier mantém um registro contínuo das mensagens enviadas. Embora normalmente não seja necessário, você pode limitar a quantidade de eventos gravados no banco de dados.',
    'Number of log events to retain'                                                                                                                  => 'Número de eventos do registro a manter',
    'At most, keep this many log events. Leave blank for no limit.'                                                                                   => 'Manter no máximo essa quantidade de eventos do registro. Deixe em branco para nenhum limite.',
    'Number of days to retain log events'                                                                                                             => 'Número de dias para manter os eventos do registro',
    'At most, keep log events for this many days. Leave blank for no limit.'                                                                          => 'Manter os eventos do registro por no máximo essa quantidade de dias. Deixe em branco para nenhum limite.',

    // Test notification
    'Send a test message'                                                                                                          => 'Enviar uma mensagem de teste',
    'Are you certain you want to send a test notification?\n\nThe configured message will be sent to the configured recipient(s).' => 'Tem certeza de que deseja enviar uma notificação de teste?\n\nA mensagem configurada será enviada aos destinatários configurados.',
    'Test'                                                                                                                         => 'Teste',
    'Test notification dispatched.'                                                                                                => 'Notificação de teste enviada.',
    'No messages were dispatched. Check the recipient configuration.'                                                              => 'Nenhuma mensagem foi enviada. Verifique a configuração dos destinatários.',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.' => 'Enviando {messageType} para {recipient}.',
    'Log events deleted.'                   => 'Eventos do registro excluídos.',
    'notification'                          => 'notificação',

    // Errors
    'Invalid email message mode.'                                    => 'Modo de mensagem de e-mail inválido.',
    'Dynamic recipients snippet did not call setRecipients.'         => 'O trecho de destinatários dinâmicos não chamou setRecipients.',
    'setRecipients was called with an empty value.'                  => 'setRecipients foi chamado com um valor vazio.',
    'Unrecognized recipient "{value}".'                              => 'Destinatário não reconhecido "{value}".',
    'Unrecognized recipient of type "{type}".'                       => 'Destinatário do tipo "{type}" não reconhecido.',
    'Recipient "{name}" has no email address.'                       => 'O destinatário "{name}" não tem endereço de e-mail.',
    'Recipient "{name}" has no phone number.'                        => 'O destinatário "{name}" não tem número de telefone.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => 'O destinatário "{name}" não tem um usuário associado; não é possível enviar o anúncio.',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => 'O destinatário "{name}" não pode acessar o painel de controle; não é possível enviar o anúncio.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Você não tem permissão para usar o tipo Destinatários dinâmicos.',

];
