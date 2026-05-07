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
    'Notifications'          => '알림',
    'Notification'           => '알림',
    'All notifications'      => '모든 알림',
    'Notification Log'       => '알림 로그',
    'Logs'                   => '로그',
    'View Notifications'     => '알림 보기',
    'Add a New Notification' => '새 알림 추가',

    // Permissions
    'View notifications'              => '알림 보기',
    'Save notifications'              => '알림 저장',
    'Use the Dynamic Recipients type' => '동적 수신자 유형 사용',
    'Delete notifications'            => '알림 삭제',
    'View notification log'           => '알림 로그 보기',
    'Delete notification log'         => '알림 로그 삭제',

    // Notification editor: tabs
    'Meta'       => '메타',
    'Event'      => '이벤트',
    'Message'    => '메시지',
    'Recipients' => '수신자',

    // Event tab
    'Event Type'                                           => '이벤트 유형',
    'What type of event will activate the notification?'   => '어떤 유형의 이벤트로 알림을 활성화하시겠습니까?',
    'Which specific event will activate the notification?' => '어떤 구체적인 이벤트로 알림을 활성화하시겠습니까?',
    'Assets Event'                                         => '에셋 이벤트',
    'Commerce Orders Event'                                => 'Commerce 주문 이벤트',
    'Entries Event'                                        => '엔트리 이벤트',
    'Users Event'                                          => '사용자 이벤트',

    // Field and element conditions
    'Field Conditions'                                                               => '필드 조건',
    'Send the message only when the saved element matches the following conditions.' => '저장된 요소가 다음 조건과 일치할 때만 메시지를 보냅니다.',
    '#{elementType} Event Filters'                                                   => '#{elementType} 이벤트 필터',
    'No filters match this event.'                                                   => '이 이벤트와 일치하는 필터가 없습니다.',
    'Determine whether each message should be sent based on specified conditions.'   => '지정한 조건에 따라 각 메시지를 보낼지 결정합니다.',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => '요소가 처음으로 저장되고 있습니다',
    'Must be a new entry'                       => '새 엔트리여야 합니다',
    'Must be an existing entry'                 => '기존 엔트리여야 합니다',
    'Can be existing or new'                    => '기존이거나 새 엔트리일 수 있습니다',

    // Filters: new elements
    'Element is new'         => '요소가 새로 작성되었습니다',
    'New elements only'      => '새 요소만',
    'Existing elements only' => '기존 요소만',

    // Filters: enabled state
    'Element is enabled'         => '요소가 활성화되어 있습니다',
    'Must be enabled'            => '활성화되어 있어야 합니다',
    'Must be disabled'           => '비활성화되어 있어야 합니다',
    'Can be enabled or disabled' => '활성화 또는 비활성화될 수 있습니다',

    // Filters: drafts
    'Element is a draft'          => '요소가 임시저장본입니다',
    'Must be a draft'             => '임시저장본이어야 합니다',
    'Must not be a draft'         => '임시저장본이 아니어야 합니다',
    'Can be a draft or non-draft' => '임시저장본이거나 아닐 수 있습니다',

    // Filters: provisional drafts
    'Element is a provisional draft'                => '요소가 잠정 임시저장본입니다',
    'Must be a provisional draft'                   => '잠정 임시저장본이어야 합니다',
    'Must not be a provisional draft'               => '잠정 임시저장본이 아니어야 합니다',
    'Can be a provisional draft or non-provisional' => '잠정이거나 아닐 수 있습니다',

    // Filters: revisions
    'Element is a revision'             => '요소가 리비전입니다',
    'Must be a revision'                => '리비전이어야 합니다',
    'Must not be a revision'            => '리비전이 아니어야 합니다',
    'Can be a revision or non-revision' => '리비전이거나 아닐 수 있습니다',

    // Filters: duplication
    'Element is being duplicated'         => '요소가 복제되고 있습니다',
    'Must be duplicating the element'     => '요소를 복제 중이어야 합니다',
    'Must not be duplicating the element' => '요소를 복제 중이 아니어야 합니다',

    // Filters: propagation
    'Element is being propagated'     => '요소가 전파되고 있습니다',
    'Element must be propagating'     => '요소가 전파 중이어야 합니다',
    'Element must not be propagating' => '요소가 전파 중이 아니어야 합니다',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => '요소가 일괄 재저장되고 있습니다',
    'Must be bulk-resaving the element'     => '요소를 일괄 재저장 중이어야 합니다',
    'Must not be bulk-resaving the element' => '요소를 일괄 재저장 중이 아니어야 합니다',

    // Filters: common output
    'Unnamed filter'                => '이름 없는 필터',
    'Must be TRUE to send message'  => '메시지를 보내려면 TRUE여야 합니다',
    'Must be FALSE to send message' => '메시지를 보내려면 FALSE여야 합니다',
    'No effect'                     => '효과 없음',

    // Message tab: type selector and queue
    'Message Type'                                                 => '메시지 유형',
    'What type of message will be sent?'                           => '어떤 유형의 메시지를 보내시겠습니까?',
    'Send Message via Queue'                                       => '대기열로 메시지 보내기',
    'Should the message be sent via the [jobs queue]({queueUrl})?' => '메시지를 [작업 대기열]({queueUrl})로 보내시겠습니까?',

    // Email message
    'Email Subject'              => '이메일 제목',
    'Email Body'                 => '이메일 본문',
    "User's Email Address Field" => '사용자의 이메일 주소 필드',

    // SMS message
    'SMS Message Body'          => 'SMS 메시지 본문',
    "User's Phone Number Field" => '사용자의 전화번호 필드',

    // Announcement message
    'Announcement Title'   => '공지 제목',
    'Announcement Message' => '공지 메시지',

    // Flash message
    'Flash Message Type'                         => '플래시 메시지 유형',
    'Flash Message Title'                        => '플래시 메시지 제목',
    'Flash Message Details'                      => '플래시 메시지 세부 정보',
    'Which type of flash message should appear?' => '어떤 유형의 플래시 메시지를 표시하시겠습니까?',

    // Trix toolbar (rich-text editing)
    'Rich Text'     => '서식 있는 텍스트',
    'Bold'          => '굵게',
    'Italic'        => '기울임꼴',
    'Underline'     => '밑줄',
    'Strikethrough' => '취소선',
    'Bullets'       => '글머리 기호',
    'Numbers'       => '번호 매기기',
    'Heading'       => '제목',
    'Code'          => '코드',
    'Undo'          => '실행 취소',
    'Redo'          => '다시 실행',

    // Email body instructions (HTML)
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => '보낼 이메일의 본문입니다. <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">특수 변수</a>를 사용하거나 <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">수신자를 건너뛰기</a>도 할 수 있습니다.',

    // Recipients tab
    'Recipients Type'                             => '수신자 유형',
    'Who will receive this message?'              => '이 메시지를 누가 받습니까?',
    'Add a message recipient'                     => '수신자 추가',
    'Select User(s)'                              => '사용자 선택',
    'Which users will receive the message?'       => '어떤 사용자가 메시지를 받습니까?',
    'Which user groups will receive the message?' => '어떤 사용자 그룹이 메시지를 받습니까?',
    'Restricted to Admins Only?'                  => '관리자 전용으로 제한하시겠습니까?',
    'Ungrouped Users'                             => '그룹에 속하지 않은 사용자',
    'Twig Snippet to Determine Recipients'        => '수신자를 결정할 Twig 스니펫',

    // Settings: Twilio
    'Twilio Account SID'                             => 'Twilio Account SID',
    'Twilio Auth Token'                              => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)'   => 'Twilio 전화번호 (각 SMS 메시지를 발송합니다)',
    'This is being set in the config file. [{file}]' => '구성 파일에서 설정되고 있습니다. [{file}]',

    // Settings: Logging
    'Logging'                                                                                                                                         => '로깅',
    'Enable Logging'                                                                                                                                  => '로깅 활성화',
    'When disabled, Notifier will not write anything to the notification log.'                                                                        => '비활성화되면 Notifier는 알림 로그에 아무것도 기록하지 않습니다.',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier는 발송된 메시지의 지속적인 로그를 유지합니다. 일반적으로 필요하지는 않지만 데이터베이스에 기록되는 로그 이벤트 수를 제한할 수 있습니다.',
    'Number of log events to retain'                                                                                                                  => '보관할 로그 이벤트 수',
    'At most, keep this many log events. Leave blank for no limit.'                                                                                   => '최대 이만큼의 로그 이벤트를 보관합니다. 제한 없이 두려면 비워 두십시오.',
    'Number of days to retain log events'                                                                                                             => '로그 이벤트를 보관할 일수',
    'At most, keep log events for this many days. Leave blank for no limit.'                                                                          => '최대 이만큼의 일수 동안 로그 이벤트를 보관합니다. 제한 없이 두려면 비워 두십시오.',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.' => '{recipient}(으)로 {messageType}을(를) 보내고 있습니다.',
    'Log events deleted.'                   => '로그 이벤트가 삭제되었습니다.',
    'notification'                          => '알림',

    // Errors
    'Invalid email message mode.'                                    => '잘못된 이메일 메시지 모드입니다.',
    'Dynamic recipients snippet did not call setRecipients.'         => '동적 수신자 스니펫이 setRecipients를 호출하지 않았습니다.',
    'setRecipients was called with an empty value.'                  => 'setRecipients가 빈 값으로 호출되었습니다.',
    'Unrecognized recipient "{value}".'                              => '인식되지 않는 수신자 "{value}"입니다.',
    'Unrecognized recipient of type "{type}".'                       => '인식되지 않는 유형 "{type}"의 수신자입니다.',
    'Recipient "{name}" has no email address.'                       => '수신자 "{name}"에게 이메일 주소가 없습니다.',
    'Recipient "{name}" has no phone number.'                        => '수신자 "{name}"에게 전화번호가 없습니다.',
    'You do not have permission to use the Dynamic Recipients type.' => '동적 수신자 유형을 사용할 권한이 없습니다.',

];
