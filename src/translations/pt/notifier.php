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
    'Delete notifications'            => 'Eliminar notificações',
    'View notification log'           => 'Ver o registo de notificações',
    'Delete notification log'         => 'Eliminar o registo de notificações',

    // Notification editor: tabs
    'Meta'       => 'Meta',
    'Event'      => 'Evento',
    'Message'    => 'Mensagem',
    'Recipients' => 'Destinatários',

    // Event tab
    'Event Type'                                           => 'Tipo de evento',
    'What type of event will activate the notification?'   => 'Que tipo de evento ativará a notificação?',
    'Which specific event will activate the notification?' => 'Que evento específico ativará a notificação?',
    'Assets Event'                                         => 'Evento de Recursos',
    'Commerce Orders Event'                                => 'Evento de Encomendas Commerce',
    'Entries Event'                                        => 'Evento de Entradas',
    'Users Event'                                          => 'Evento de Utilizadores',

    // Field and element conditions
    'Field Conditions'                                                               => 'Condições de campo',
    'Send the message only when the saved element matches the following conditions.' => 'Enviar a mensagem apenas quando o elemento guardado cumprir as seguintes condições.',
    'has changed'                                                                    => 'foi alterado',
    '#{elementType} Event Filters'                                                   => 'Filtros de evento de #{elementType}',
    'No filters match this event.'                                                   => 'Nenhum filtro corresponde a este evento.',
    'Determine whether each message should be sent based on specified conditions.'   => 'Determinar se cada mensagem deve ser enviada com base nas condições especificadas.',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => 'O elemento está a ser guardado pela primeira vez',
    'Must be a new entry'                       => 'Deve ser uma nova entrada',
    'Must be an existing entry'                 => 'Deve ser uma entrada existente',
    'Can be existing or new'                    => 'Pode ser existente ou nova',

    // Filters: new elements
    'Element is new'         => 'O elemento é novo',
    'New elements only'      => 'Apenas elementos novos',
    'Existing elements only' => 'Apenas elementos existentes',

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
    'Element is being duplicated'         => 'O elemento está a ser duplicado',
    'Must be duplicating the element'     => 'Deve estar a duplicar o elemento',
    'Must not be duplicating the element' => 'Não deve estar a duplicar o elemento',

    // Filters: propagation
    'Element is being propagated'     => 'O elemento está a ser propagado',
    'Element must be propagating'     => 'O elemento deve estar a ser propagado',
    'Element must not be propagating' => 'O elemento não deve estar a ser propagado',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => 'O elemento está a ser regravado em lote',
    'Must be bulk-resaving the element'     => 'Deve estar a regravar o elemento em lote',
    'Must not be bulk-resaving the element' => 'Não deve estar a regravar o elemento em lote',

    // Filters: common output
    'Unnamed filter'                => 'Filtro sem nome',
    'Must be TRUE to send message'  => 'Deve ser TRUE para enviar a mensagem',
    'Must be FALSE to send message' => 'Deve ser FALSE para enviar a mensagem',
    'No effect'                     => 'Sem efeito',

    // Message tab: type selector and queue
    'Message Type'                                                 => 'Tipo de mensagem',
    'What type of message will be sent?'                           => 'Que tipo de mensagem será enviada?',
    'Send Message via Queue'                                       => 'Enviar a mensagem através da fila',
    'Should the message be sent via the [jobs queue]({queueUrl})?' => 'A mensagem deve ser enviada através da [fila de tarefas]({queueUrl})?',

    // Email message
    'Email Subject'              => 'Assunto do email',
    'Email Body'                 => 'Corpo do email',
    "User's Email Address Field" => 'Campo de endereço de email do utilizador',

    // SMS message
    'SMS Message Body'          => 'Corpo da mensagem SMS',
    "User's Phone Number Field" => 'Campo de número de telefone do utilizador',

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
    'Strikethrough' => 'Rasurado',
    'Bullets'       => 'Marcadores',
    'Numbers'       => 'Numeração',
    'Heading'       => 'Título',
    'Code'          => 'Código',
    'Undo'          => 'Anular',
    'Redo'          => 'Refazer',

    // Email body instructions (HTML)
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => 'Corpo do email a enviar. Pode utilizar <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">variáveis especiais</a>, ou até <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">ignorar destinatários</a>.',

    // Recipients tab
    'Recipients Type'                             => 'Tipo de destinatários',
    'Who will receive this message?'              => 'Quem receberá esta mensagem?',
    'Add a message recipient'                     => 'Adicionar um destinatário',
    'Select User(s)'                              => 'Selecionar utilizador(es)',
    'Which users will receive the message?'       => 'Que utilizadores receberão a mensagem?',
    'Which user groups will receive the message?' => 'Que grupos de utilizadores receberão a mensagem?',
    'Restricted to Admins Only?'                  => 'Restrito apenas a administradores?',
    'Ungrouped Users'                             => 'Utilizadores sem grupo',
    'Twig Snippet to Determine Recipients'        => 'Excerto Twig para determinar destinatários',

    // Settings: Twilio
    'Twilio Account SID'                             => 'Twilio Account SID',
    'Twilio Auth Token'                              => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)'   => 'Número de telefone Twilio (envia cada mensagem SMS)',
    'This is being set in the config file. [{file}]' => 'Definido no ficheiro de configuração. [{file}]',

    // Settings: Logging
    'Logging'                                                                                                                                         => 'Registo',
    'Enable Logging'                                                                                                                                  => 'Ativar registo',
    'When disabled, Notifier will not write anything to the notification log.'                                                                        => 'Quando desativado, o Notifier não escreverá nada no registo de notificações.',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'O Notifier mantém um registo contínuo das mensagens enviadas. Embora normalmente não seja necessário, pode limitar a quantidade de eventos guardados na base de dados.',
    'Number of log events to retain'                                                                                                                  => 'Número de eventos do registo a manter',
    'At most, keep this many log events. Leave blank for no limit.'                                                                                   => 'Manter no máximo este número de eventos do registo. Deixar em branco para nenhum limite.',
    'Number of days to retain log events'                                                                                                             => 'Número de dias para manter os eventos do registo',
    'At most, keep log events for this many days. Leave blank for no limit.'                                                                          => 'Manter os eventos do registo durante no máximo este número de dias. Deixar em branco para nenhum limite.',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.' => 'A enviar {messageType} para {recipient}.',
    'Log events deleted.'                   => 'Eventos do registo eliminados.',
    'notification'                          => 'notificação',

    // Errors
    'Invalid email message mode.'                                    => 'Modo de mensagem de email inválido.',
    'Dynamic recipients snippet did not call setRecipients.'         => 'O excerto de destinatários dinâmicos não chamou setRecipients.',
    'setRecipients was called with an empty value.'                  => 'setRecipients foi chamado com um valor vazio.',
    'Unrecognized recipient "{value}".'                              => 'Destinatário não reconhecido "{value}".',
    'Unrecognized recipient of type "{type}".'                       => 'Destinatário do tipo "{type}" não reconhecido.',
    'Recipient "{name}" has no email address.'                       => 'O destinatário "{name}" não tem endereço de email.',
    'Recipient "{name}" has no phone number.'                        => 'O destinatário "{name}" não tem número de telefone.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Não tem permissão para utilizar o tipo Destinatários dinâmicos.',

];
