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
    'Notifications' => '알림',
    'Notification' => '알림',
    'All notifications' => '모든 알림',
    'Notification Log' => '알림 로그',
    'Logs' => '로그',
    'View Notifications' => '알림 보기',
    'Add a New Notification' => '새 알림 추가',
    'notification' => '알림',

    // Permissions
    'View notifications' => '알림 보기',
    'Save notifications' => '알림 저장',
    'Use the Dynamic Recipients type' => '동적 수신자 유형 사용',
    'Use the Dynamic Data type' => '동적 데이터 유형 사용',
    'Test notifications' => '알림 테스트',
    'Send manual notifications' => '수동 알림 보내기',
    'Delete notifications' => '알림 삭제',
    'View notification log' => '알림 로그 보기',
    'Delete notification log' => '알림 로그 삭제',

    // ============================================================
    // NOTIFICATION EDITOR
    // ============================================================

    // Editor: tabs
    'Meta' => '메타',
    'Event' => '이벤트',
    'Message' => '메시지',
    'Recipients' => '수신자',

    // Event tab: type selector
    'Event Type' => '이벤트 유형',
    'What type of event will activate the notification?' => '어떤 유형의 이벤트가 알림을 활성화합니까?',
    'Which specific event will activate the notification?' => '어떤 특정 이벤트가 알림을 활성화합니까?',

    // Event tab: event types
    'Assets Event' => '에셋 이벤트',
    'Commerce Orders Event' => 'Commerce 주문 이벤트',
    'Commerce Products Event' => 'Commerce 제품 이벤트',
    'Digital Products Event' => 'Digital Products 이벤트',
    'Digital Product Licenses Event' => 'Digital Products 라이선스 이벤트',
    'Solspace Calendar Event' => 'Solspace Calendar 이벤트',
    'Entries Event' => '엔트리 이벤트',
    'Users Event' => '사용자 이벤트',
    'Ungrouped Users' => '그룹 없는 사용자',

    // Event tab: Feed
    'Feed URL' => '피드 URL',
    'The URL of the RSS, Atom, or JSON feed to watch.' => '모니터링할 RSS, Atom 또는 JSON 피드의 URL입니다.',

    // Event tab: field conditions
    'Field Conditions' => '필드 조건',
    'Send the message only when the saved element matches the following conditions.' => '저장된 요소가 다음 조건과 일치하는 경우에만 메시지를 보냅니다.',
    'has changed' => '이(가) 변경됨',

    // Event tab: element filters (panel chrome + common output)
    '#{elementType} Event Filters' => '#{elementType} 이벤트 필터',
    'No filters match this event.' => '이 이벤트와 일치하는 필터가 없습니다.',
    'Determine whether each message should be sent based on specified conditions.' => '지정된 조건에 따라 각 메시지를 보낼지 여부를 결정합니다.',
    'Unnamed filter' => '이름 없는 필터',
    'Must be TRUE to send message' => '메시지를 보내려면 TRUE 여야 함',
    'Must be FALSE to send message' => '메시지를 보내려면 FALSE 여야 함',
    'No effect' => '효과 없음',

    // Event tab: element filter rules
    'Element is being saved for the first time' => '요소가 처음 저장됨',
    'Must be a new entry' => '새 엔트리여야 함',
    'Must be an existing entry' => '기존 엔트리여야 함',
    'Can be existing or new' => '기존 또는 신규 모두 가능',
    'Element is new' => '요소가 새것임',
    'New elements only' => '새 요소만',
    'Existing elements only' => '기존 요소만',
    'Element is enabled' => '요소가 활성화됨',
    'Must be enabled' => '활성화되어 있어야 함',
    'Must be disabled' => '비활성화되어 있어야 함',
    'Can be enabled or disabled' => '활성화 또는 비활성화 모두 가능',
    'Element is a draft' => '요소가 초안임',
    'Must be a draft' => '초안이어야 함',
    'Must not be a draft' => '초안이 아니어야 함',
    'Can be a draft or non-draft' => '초안 또는 비초안 모두 가능',
    'Element is a provisional draft' => '요소가 임시 초안임',
    'Must be a provisional draft' => '임시 초안이어야 함',
    'Must not be a provisional draft' => '임시 초안이 아니어야 함',
    'Can be a provisional draft or non-provisional' => '임시 초안 또는 비임시 모두 가능',
    'Element is a revision' => '요소가 리비전임',
    'Must be a revision' => '리비전이어야 함',
    'Must not be a revision' => '리비전이 아니어야 함',
    'Can be a revision or non-revision' => '리비전 또는 비리비전 모두 가능',
    'Element is being duplicated' => '요소가 복제되고 있음',
    'Must be duplicating the element' => '요소를 복제해야 함',
    'Must not be duplicating the element' => '요소를 복제하지 않아야 함',
    'Element is being propagated' => '요소가 전파되고 있음',
    'Element must be propagating' => '요소가 전파되어야 함',
    'Element must not be propagating' => '요소가 전파되지 않아야 함',
    'Element is being bulk-resaved' => '요소가 일괄 재저장되고 있음',
    'Must be bulk-resaving the element' => '요소를 일괄 재저장해야 함',
    'Must not be bulk-resaving the element' => '요소를 일괄 재저장하지 않아야 함',

    // Event tab: date trigger
    'On' => '당일',
    'days before' => '일 전',
    'days after' => '일 후',
    'Relevant Date' => '관련 날짜',
    'Send the notification relative to a chosen date.' => '선택한 날짜를 기준으로 알림을 보냅니다.',

    // Event tab: recurring schedule
    'Every' => '간격',
    'on' => '요일',
    'on day' => '일',
    'at' => '시각',
    'Starting on' => '시작일',
    'Day' => '요일',
    'Date' => '날짜',
    'Time' => '시간',
    'day(s)' => '일',
    'week(s)' => '주',
    'month(s)' => '개월',
    'year(s)' => '년',
    'day' => '일',
    'days' => '일',
    'week' => '주',
    'weeks' => '주',
    'month' => '개월',
    'months' => '개월',
    'year' => '년',
    'years' => '년',
    'Manual only' => '수동 전용',
    'Scheduled sending' => '예약 발송',
    'On a recurring schedule' => '반복 일정에 따라',
    'On demand' => '필요 시',
    'Send on a Recurring Schedule' => '반복 일정에 따라 발송',
    'Configure Recurring Schedule' => '반복 일정 구성',
    'System timezone set to {timezone}' => '시스템 시간대가 {timezone}(으)로 설정됨',
    'Notifications will be sent on the following schedule...' => '알림은 다음 일정에 따라 발송됩니다...',
    '... and every {cadence} after that.' => '... 이후 {cadence}마다 발송됩니다.',
    'On what recurring schedule should the notification be sent?' => '어떤 반복 일정으로 알림을 보낼까요?',
    'Whether the message should be sent on a schedule, or only triggered manually.' => '메시지를 일정에 따라 보낼지, 아니면 수동으로만 실행할지 여부.',
    'The message can always be sent using the "Send system snapshot" button above.' => '메시지는 위의 "시스템 스냅샷 보내기" 버튼으로 언제든지 보낼 수 있습니다.',
    'The message can always be sent using the "Send data report" button above.' => '메시지는 위의 "데이터 보고서 보내기" 버튼으로 언제든지 보낼 수 있습니다.',

    // Event tab: Dynamic Data snippet field
    'Twig Snippet to Determine Data' => '데이터를 결정하는 Twig 스니펫',
    'Enter a custom Twig snippet to [determine which data will be included]({url}).' => '[포함할 데이터를 결정할]({url}) 사용자 지정 Twig 스니펫을 입력하세요.',
    'The snippet **must** include a `{% setData %}` tag.' => '스니펫에는 `{% setData %}` 태그가 **반드시** 포함되어야 합니다.',
    'You do not have permission to edit dynamic data.' => '동적 데이터를 편집할 권한이 없습니다.',

    // Event tab: manual trigger
    'Trigger Label' => '트리거 레이블',
    'An element action label (helps to differentiate multiple triggers).' => '요소 작업 레이블 (여러 트리거를 구분하는 데 도움이 됩니다).',
    'Send Notification' => '알림 보내기',

    // Message tab: type selector & queue
    'Message Type' => '메시지 유형',
    'What type of message will be sent?' => '어떤 유형의 메시지가 전송됩니까?',
    'Send Message via Queue' => '대기열을 통해 메시지 보내기',
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are also supported.' => '[템플릿]({templatingUrl})과 [특수 변수]({variablesUrl})도 지원됩니다.',
    'Send immediately' => '즉시 전송',
    'Add to queue' => '대기열에 추가',
    'Whether the message should be sent via the [jobs queue]({queueUrl}).' => '메시지를 [작업 대기열]({queueUrl})을 통해 보낼지 여부.',

    // Message tab: Email
    "User's Email Address Field" => '사용자 이메일 주소 필드',
    'Select which User field contains the recipient\'s email address.' => '수신자의 이메일 주소가 저장된 사용자 필드를 선택하세요.',
    'Email Subject' => '이메일 제목',
    'Subject line of the email.' => '이메일의 제목 줄.',
    'Dynamic Subject Line' => '동적 제목 줄',
    'Email Body' => '이메일 본문',
    'Body of the email. Supports HTML.' => '이메일의 본문. HTML을 지원합니다.',

    // Message tab: rich-text (Trix) toolbar
    'Rich Text' => '서식 있는 텍스트',
    'Bold' => '굵게',
    'Italic' => '기울임꼴',
    'Underline' => '밑줄',
    'Strikethrough' => '취소선',
    'Bullets' => '글머리 기호',
    'Numbers' => '번호 매기기',
    'Heading' => '제목',
    'Code' => '코드',
    'Undo' => '실행 취소',
    'Redo' => '다시 실행',

    // Message tab: SMS
    "User's Phone Number Field" => '사용자 전화번호 필드',
    'Select which User field contains the recipient\'s phone number.' => '수신자의 전화번호가 저장된 사용자 필드를 선택하세요.',
    'SMS Message Body' => 'SMS 메시지 본문',
    'Body of the SMS (text message). Plain text only.' => 'SMS(문자 메시지)의 본문. 일반 텍스트만 지원됩니다.',

    // Message tab: Announcement
    'Announcement Title' => '공지 제목',
    'Heading of the announcement.' => '공지의 제목.',
    'Dynamic Announcement Title' => '동적 공지 제목',
    'Announcement Message' => '공지 메시지',
    'Body of the announcement. Supports Markdown.' => '공지의 본문. Markdown을 지원합니다.',

    // Message tab: Flash
    'Flash Message Type' => '플래시 메시지 유형',
    'Which type of flash message should appear?' => '어떤 유형의 플래시 메시지가 표시되어야 합니까?',
    'Flash Message Title' => '플래시 메시지 제목',
    'Heading of the flash message.' => '플래시 메시지의 제목.',
    'Dynamic Flash Message Title' => '동적 플래시 메시지 제목',
    'Flash Message Details' => '플래시 메시지 세부 정보',
    'Optionally include details below the heading. Supports Markdown and HTML.' => '선택적으로 제목 아래에 세부 정보를 포함합니다. Markdown과 HTML을 지원합니다.',

    // Message tab: Pushover
    "Field containing each user's Pushover key" => '사용자의 Pushover 키 필드',
    'Select which User field contains the recipient\'s Pushover user key.' => '수신자의 Pushover 키가 저장된 사용자 필드를 선택하세요.',
    'Pushover Title' => 'Pushover 제목',
    'Optionally include a heading above the body.' => '선택적으로 본문 위에 제목을 포함합니다.',
    'Dynamic Pushover Title' => '동적 Pushover 제목',
    'Pushover Body' => 'Pushover 본문',
    'Body of the Pushover notification. Plain text only.' => 'Pushover 알림의 본문. 일반 텍스트만 지원됩니다.',

    // Message tab: ntfy
    'Priority' => '우선순위',
    'Priority level of the ntfy message.' => 'ntfy 메시지의 우선 순위.',
    'Tags' => '태그',
    'Optionally include comma-separated [emoji shortcodes](https://docs.ntfy.sh/emojis/).' => '선택적으로 쉼표로 구분된 [이모지 단축 코드](https://docs.ntfy.sh/emojis/)를 포함합니다.',
    'ntfy Title' => 'ntfy 제목',
    'Dynamic ntfy Title' => '동적 ntfy 제목',
    'ntfy Body' => 'ntfy 본문',
    'Body of the ntfy notification.' => 'ntfy 알림의 본문.',
    'ntfy Link URL' => 'ntfy 링크 URL',
    'Optionally open a URL when the notification is clicked.' => '선택적으로 알림을 클릭했을 때 URL을 엽니다.',
    'Enable Markdown' => 'Markdown 활성화',
    'Whether to parse the body as Markdown in supported clients.' => '지원되는 클라이언트에서 본문을 Markdown으로 처리할지 여부.',
    'Regular text only' => '일반 텍스트만',
    'Markdown enabled' => 'Markdown 활성화',

    // Message tab: Slack
    'Slack Message Body' => 'Slack 메시지 본문',
    'Supports standard [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) syntax. Optionally supports HTML _(see below)_.' => '표준 [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) 구문을 지원합니다. 선택적으로 HTML도 지원합니다 _(아래 참조)_.',
    'Render Message Body as HTML' => '메시지 본문을 HTML로 렌더링',
    'Whether to only parse as [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), or additionally parse it as HTML.' => '[Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting)으로만 파싱할지, HTML도 추가로 파싱할지 여부.',
    'mrkdwn only' => 'mrkdwn만',
    'mrkdwn + HTML' => 'mrkdwn + HTML',
    'Render Link Previews' => '링크 미리보기 표시',
    'Whether Slack should unfurl link previews for URLs in the message body.' => 'Slack이 메시지 본문의 URL에 대해 링크 미리보기를 펼칠지 여부입니다.',
    'Don\'t unfurl' => '펼치지 않기',
    'Expand link previews' => '링크 미리보기 펼치기',
    'Bot Name' => '사용자 이름',
    'Optionally override the app\'s display name.' => '선택적으로 앱의 표시 이름을 재정의합니다.',
    'Dynamic Bot Name' => '동적 봇 이름',
    'Bot Icon URL' => '아이콘 URL',
    'Optionally override the app\'s icon with a URL.' => '선택적으로 앱의 아이콘을 URL로 재정의합니다.',
    'Bot Emoji' => '아이콘 이모지',
    'Optionally override the app\'s icon with an emoji. Used only when Bot Icon URL is empty.' => '선택적으로 앱의 아이콘을 이모지로 재정의합니다. Bot Icon URL이 비어 있을 때만 사용됩니다.',

    // Message tab: Bluesky
    'Post Body' => '게시물 본문',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => '일반 텍스트, 최대 300자. URL과 `@handle.tld` 멘션은 자동으로 링크됩니다.',
    'Generate Link Preview' => '링크 미리보기 생성',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => '게시물 본문에 URL이 포함되어 있을 때 미리보기 카드를 자동으로 생성합니다.',
    'No card' => '카드 없음',
    'Generate preview card' => '미리보기 카드 생성',

    // Recipients tab: type selector & user/group pickers
    'Recipients Type' => '수신자 유형',
    'Who will receive this message?' => '누가 이 메시지를 받습니까?',
    'Add a message recipient' => '수신자 추가',
    'Select User(s)' => '사용자 선택',
    'Which users will receive the message?' => '어떤 사용자가 메시지를 받습니까?',
    'Which user groups will receive the message?' => '어떤 사용자 그룹이 메시지를 받습니까?',

    // Recipients tab: channel pickers (Slack / ntfy / Bluesky)
    'Select Slack channel(s)' => 'Slack 채널 선택',
    'Which Slack channels should receive this message?' => '어떤 Slack 채널이 이 메시지를 받습니까?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => '구성된 Slack 채널이 없습니다. [설정 → Slack]({url})에서 추가하세요.',
    'Select ntfy topic(s)' => 'ntfy 토픽 선택',
    'Which ntfy topics should receive this message?' => '어떤 ntfy 토픽이 이 메시지를 받습니까?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => '구성된 ntfy 토픽이 없습니다. [설정 → ntfy]({url})에서 추가하세요.',
    'Select Bluesky account(s)' => 'Bluesky 계정 선택',
    'Which Bluesky accounts should post this message?' => '어떤 Bluesky 계정이 이 메시지를 게시합니까?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => '구성된 Bluesky 계정이 없습니다. [설정 → Bluesky]({url})에서 추가하세요.',

    // Recipients tab: dynamic recipients snippet
    'Twig Snippet to Determine Recipients' => '수신자를 결정하는 Twig 스니펫',
    'Enter a custom Twig snippet to [determine who will receive the message]({url}).' => '[메시지를 받을 대상을 결정할]({url}) 사용자 지정 Twig 스니펫을 입력하세요.',
    'The snippet **must** include a `{% setRecipients %}` tag.' => '스니펫에는 `{% setRecipients %}` 태그가 **반드시** 포함되어야 합니다.',

    // ============================================================
    // SETTINGS
    // ============================================================

    // Settings: nav & page chrome
    'Notifier Settings' => 'Notifier 설정',
    'General' => '일반',
    'Twilio' => 'Twilio',
    'Pushover' => 'Pushover',
    'Slack' => 'Slack',
    'Bluesky' => 'Bluesky',
    'ntfy' => 'ntfy',

    // Settings: Logging
    'Logging' => '로깅',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier 는 보낸 메시지를 지속적으로 기록합니다. 일반적으로 필요하지 않지만 데이터베이스에 기록되는 로그 이벤트 수를 제한할 수 있습니다.',
    'Enable Logging' => '로깅 활성화',
    'When disabled, Notifier will not write anything to the notification log.' => '비활성화 시 Notifier 는 알림 로그에 아무것도 기록하지 않습니다.',
    'Number of days to retain log events' => '로그 이벤트를 보관할 일수',
    'At most, keep log events for this many days. Leave blank for no limit.' => '로그 이벤트를 최대 이 일수만큼만 보관합니다. 제한 없음으로 두려면 비워두세요.',
    'Number of log events to retain' => '보관할 로그 이벤트 수',
    'At most, keep this many log events. Leave blank for no limit.' => '최대 이만큼의 로그 이벤트를 보관합니다. 제한 없음으로 두려면 비워두세요.',

    // Settings: Scheduled sending
    'Scheduled Sending' => '예약 발송',
    'Shared secret for authenticating scheduled-run web requests. Required only when the schedule is triggered via the web endpoint.' => '예약 실행 웹 요청을 인증하기 위한 공유 비밀입니다. 일정이 웹 엔드포인트를 통해 트리거되는 경우에만 필요합니다.',
    'Scheduled-Run Token' => '예약 실행 토큰',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => '각 요청과 함께 X-Notifier-Token 헤더 또는 token 본문 매개변수로 전송됩니다.',

    // Settings: Twilio
    'Twilio API Credentials' => 'Twilio API 자격 증명',
    'If using the Twilio API to send SMS messages, the following credentials are required.' => 'SMS 메시지를 보내기 위해 Twilio API 를 사용한다면, 다음 자격 증명이 필요합니다.',
    'Twilio Account SID' => 'Twilio 계정 SID',
    'Twilio Auth Token' => 'Twilio 인증 토큰',
    'Twilio phone number (sends each SMS message)' => 'Twilio 전화번호 (각 SMS 메시지 발신)',
    'SMS Testing' => 'SMS 테스트',
    'Optional. When set, every SMS dispatched will be sent to this number instead of the resolved recipient.' => '선택 사항. 설정하면 발송되는 모든 SMS 가 실제 수신자 대신 이 번호로 전송됩니다.',
    'Test phone number' => '테스트 전화번호',

    // Settings: Pushover
    "[Pushover](https://pushover.net) sends push notifications to a registered user's devices. Each Craft user needs a custom field on their profile storing their Pushover user key; you select which field on each Notification's Message tab. For full setup instructions, see the [Pushover getting-started docs](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover)." => '[Pushover](https://pushover.net) 는 등록된 사용자의 기기에 푸시 알림을 보냅니다. 각 Craft 사용자는 프로필에 Pushover 사용자 키를 저장하는 사용자 정의 필드가 필요하며, 각 알림의 메시지 탭에서 어떤 필드를 사용할지 선택합니다. 자세한 설정 방법은 [Pushover 시작 문서](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover)를 참고하세요.',
    'Application API Token' => '애플리케이션 API 토큰',
    'The 30-character app token from your Pushover application.' => 'Pushover 애플리케이션의 30자 앱 토큰입니다.',

    // Settings: ntfy
    'ntfy.sh is a free HTTP-based push notification service. Subscribers receive messages on the ntfy app, web, or any compatible client by joining a topic.' => 'ntfy.sh 는 무료 HTTP 기반 푸시 알림 서비스입니다. 구독자는 토픽에 가입하여 ntfy 앱, 웹 또는 호환 클라이언트에서 메시지를 받습니다.',
    'Server URL' => '서버 URL',
    "Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`." => '선택 사항. 해당하는 경우 자체 호스팅 ntfy 인스턴스를 지정하세요. 기본값은 `https://ntfy.sh` 입니다.',
    'Access token' => '액세스 토큰',
    'Optional, required for protected topics or self-hosted instances with auth.' => '선택 사항. 보호된 토픽이나 인증이 있는 자체 호스팅 인스턴스에 필요합니다.',
    'ntfy Topics' => 'ntfy 토픽',
    "Add the ntfy topics you'd like to send messages to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification." => '메시지를 보낼 ntfy 토픽을 추가하세요. 각 토픽은 알림을 구성할 때 **수신자** 탭에서 수신자로 사용할 수 있습니다.',
    'Topics' => '토픽',
    "Click any row's **Test** button to send a quick test message to that topic." => '아무 행의 **테스트** 버튼을 클릭하여 해당 토픽에 빠른 테스트 메시지를 보내세요.',
    'Label' => '레이블',
    'Topic' => '토픽',
    'Add a topic' => '토픽 추가',

    // Settings: Slack
    'Slack Channels' => 'Slack 채널',
    'Create a [Slack app](https://api.slack.com/apps) with the `chat:write`, `chat:write.customize`, and `chat:write.public` scopes, then add a row for each channel you\'d like to post into. Each channel becomes available as a recipient on the **Recipients** tab when configuring a notification. A bot token is a secret, so store it in a `.env` variable and reference that variable (e.g. `$SLACK_BOT_TOKEN`) rather than pasting the token directly.' => '`chat:write`, `chat:write.customize`, `chat:write.public` 스코프가 있는 [Slack 앱](https://api.slack.com/apps)을 만든 다음, 게시하려는 각 채널에 대한 행을 추가하세요. 알림을 구성할 때 각 채널은 **수신자** 탭에서 수신자로 사용할 수 있습니다. 봇 토큰은 비밀이므로, 토큰을 직접 붙여넣지 말고 `.env` 변수에 저장한 다음 해당 변수(예: `$SLACK_BOT_TOKEN`)를 참조하세요.',
    'Channels' => '채널',
    "Click any row's **Test** button to send a quick test message to that channel." => '아무 행의 **테스트** 버튼을 클릭하여 해당 채널에 빠른 테스트 메시지를 보내세요.',
    'Bot Token' => '봇 토큰',
    'Channel ID' => '채널 ID',
    'Add a channel' => '채널 추가',
    'Not a valid Bot Token. Must start with `xoxb-`.' => '유효하지 않은 봇 토큰입니다. `xoxb-`로 시작해야 합니다.',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => '유효하지 않은 채널 ID입니다. `C01234ABCD`와 같은 형식이어야 합니다.',

    // Settings: Bluesky
    "[Bluesky](https://bsky.app) posts publish to the configured account's feed via the ATProto API. App passwords are generated at [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). An app password is a secret, so store it in a `.env` variable and reference that variable (e.g. `\$BLUESKY_APP_PASSWORD`) rather than pasting the password directly." => '[Bluesky](https://bsky.app) 게시물은 ATProto API 를 통해 구성된 계정의 피드에 게시됩니다. 앱 비밀번호는 [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords) 에서 생성됩니다. 앱 비밀번호는 비밀이므로 비밀번호를 직접 붙여넣지 말고 `.env` 변수에 저장한 다음 해당 변수(예: `$BLUESKY_APP_PASSWORD`)를 참조하세요.',
    'PDS URL' => 'PDS URL',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => '기본값은 https://bsky.social 입니다. 설치가 페더레이션된다면 사용자 정의 PDS 를 지정하세요.',
    'Bluesky Accounts' => 'Bluesky 계정',
    "Add the Bluesky accounts you'd like to post from. Each account becomes available as a recipient on the **Recipients** tab when configuring a notification." => '게시할 때 사용할 Bluesky 계정을 추가하세요. 각 계정은 알림을 구성할 때 **수신자** 탭에서 수신자로 사용할 수 있습니다.',
    'Accounts' => '계정',
    "Click any row's **Test** button to confirm the account authenticates." => '아무 행의 **테스트** 버튼을 클릭하여 계정이 인증되는지 확인하세요.',
    'Handle' => '핸들',
    'App password' => '앱 비밀번호',
    'Add an account' => '계정 추가',

    // ============================================================
    // MANUAL SEND & TEST
    // ============================================================

    // Manual send & test
    'Send a test message' => '테스트 메시지 보내기',
    'Send a REAL test notification?\\n\\n⚠️ Uses a random sample of real data.\\n⚠️ Sends a real message via the configured channel.\\n⚠️ Delivers to the real configured recipient(s).' => '정말로 테스트 알림을 보내시겠습니까?\\n\\n⚠️ 실제 데이터의 무작위 샘플을 사용합니다.\\n⚠️ 설정된 채널을 통해 실제 메시지를 전송합니다.\\n⚠️ 실제로 설정된 수신자에게 전달됩니다.',
    'Test' => '테스트',
    'Send system snapshot' => '시스템 스냅샷 보내기',
    'Send data report' => '데이터 보고서 보내기',
    'Are you sure you want to send this notification?' => '이 알림을 보내시겠습니까?',
    'This notification cannot be triggered manually.' => '이 알림은 수동으로 트리거할 수 없습니다.',
    'This notification no longer applies to the selected element.' => '이 알림은 더 이상 선택한 요소에 적용되지 않습니다.',

    // ============================================================
    // RUNTIME OUTPUT
    // ============================================================

    // Runtime: dispatch log feedback
    'Sending {messageType} to {recipient}.' => '{recipient} 에게 {messageType} 을(를) 보내는 중입니다.',
    'Adding message to queue.' => '메시지를 대기열에 추가하는 중입니다.',
    'Sending message immediately (bypassing queue).' => '메시지를 즉시 보냅니다 (대기열 우회).',
    'Unable to parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => '피드를 구문 분석할 수 없습니다. PHP의 `simplexml` 및 `libxml` 확장이 필요합니다.',
    'Unable to parse the feed.' => '피드를 구문 분석할 수 없습니다.',
    'Unable to fetch the feed: {message}' => '피드를 가져올 수 없습니다: {message}',
    'Initial feed scan failed: {message}' => '초기 피드 스캔에 실패했습니다: {message}',

    // Runtime: controller responses
    'Test notification dispatched.' => '테스트 알림이 발송되었습니다.',
    'No messages were dispatched. Check the recipient configuration.' => '전송된 메시지가 없습니다. 수신자 구성을 확인하세요.',
    'Unable to send test: the feed could not be read or has no items.' => '테스트를 전송할 수 없습니다: 피드를 읽을 수 없거나 항목이 없습니다.',
    'Unable to send test: no element matches the configured filters.' => '테스트를 전송할 수 없습니다: 구성된 필터와 일치하는 요소가 없습니다.',
    "Couldn't save settings." => '설정을 저장할 수 없습니다.',
    'Settings saved.' => '설정이 저장되었습니다.',
    'Topic is empty.' => '토픽이 비어 있습니다.',
    'Server URL is not configured.' => '서버 URL 이 구성되지 않았습니다.',
    'Test message from Notifier.' => 'Notifier 의 테스트 메시지입니다.',
    'HTTP {status}' => 'HTTP {status}',
    'Test message sent successfully.' => '테스트 메시지를 성공적으로 보냈습니다.',
    'Handle and app password are required.' => '핸들과 앱 비밀번호가 필요합니다.',
    'Authentication failed.' => '인증에 실패했습니다.',
    'Successfully authenticated. No messages were posted.' => '인증에 성공했습니다. 게시된 메시지가 없습니다.',
    'Log events deleted.' => '로그 이벤트가 삭제되었습니다.',
    'Notification sent.' => '알림을 보냈습니다.',
    'Notification was not sent. Check the Notification Log for details.' => '알림이 전송되지 않았습니다. 자세한 내용은 알림 로그를 확인하세요.',

    // Outbound: per-channel send results
    'Unable to send email, no recipient specified.' => '이메일을 보낼 수 없습니다: 수신자가 지정되지 않았습니다.',
    'Unable to send email, the message body was empty.' => '이메일을 보낼 수 없습니다: 메시지 본문이 비어 있습니다.',
    "Unable to send the email using Craft's native email handling." => 'Craft 의 기본 이메일 처리로 이메일을 보낼 수 없습니다.',
    'Check your general email settings within Craft.' => 'Craft 의 일반 이메일 설정을 확인하세요.',
    'Successfully sent email message!' => '이메일을 성공적으로 보냈습니다!',
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[유효하지 않은 Twilio 자격 증명입니다.]({url}) {missing} 이(가) 없습니다.',
    'Unable to send SMS, no Twilio phone number exists.' => 'SMS 를 보낼 수 없습니다. Twilio 전화번호가 없습니다.',
    'Unable to send SMS, no recipient phone number exists.' => 'SMS 를 보낼 수 없습니다. 수신자 전화번호가 없습니다.',
    'Unable to send SMS, recipient phone number is invalid.' => 'SMS 를 보낼 수 없습니다. 수신자 전화번호가 유효하지 않습니다.',
    'Successfully sent SMS message!' => 'SMS 메시지를 성공적으로 보냈습니다!',
    'Unable to post announcement, no recipient userId specified.' => '공지를 게시할 수 없습니다: 수신자 userId 가 지정되지 않았습니다.',
    'Successfully posted announcement!' => '공지를 성공적으로 게시했습니다!',
    'Unable to send the flash message, invalid flash type.' => '플래시 메시지를 보낼 수 없습니다: 플래시 유형이 유효하지 않습니다.',
    'Successfully sent flash message!' => '플래시 메시지를 성공적으로 보냈습니다!',
    '[Invalid Pushover credentials.]({url}) Missing app token.' => '[유효하지 않은 Pushover 자격 증명입니다.]({url}) 앱 토큰이 없습니다.',
    'Unable to send Pushover message, no user key on recipient.' => 'Pushover 메시지를 보낼 수 없습니다: 수신자에 사용자 키가 없습니다.',
    'Pushover POST failed: {reason}' => 'Pushover POST 실패: {reason}',
    'Successfully sent Pushover message!' => 'Pushover 메시지를 성공적으로 보냈습니다!',
    'Unable to send ntfy message, no topic specified.' => 'ntfy 메시지를 보낼 수 없습니다: 토픽이 지정되지 않았습니다.',
    'ntfy POST failed with HTTP {status}: {reason}' => 'ntfy POST 가 HTTP {status} 로 실패했습니다: {reason}',
    'ntfy POST failed: {reason}' => 'ntfy POST 실패: {reason}',
    'Successfully sent ntfy message to topic "{topic}".' => '토픽 "{topic}" 에 ntfy 메시지를 성공적으로 보냈습니다.',
    'Unable to send Slack message, no bot token.' => 'Slack 메시지를 보낼 수 없습니다: 봇 토큰이 없습니다.',
    'Unable to send Slack message, no channel ID.' => 'Slack 메시지를 보낼 수 없습니다: 채널 ID가 없습니다.',
    'Unable to send Slack message, body is empty.' => 'Slack 메시지를 보낼 수 없습니다: 본문이 비어 있습니다.',
    'Slack rejected the message: {error}' => 'Slack이 메시지를 거부했습니다: {error}',
    'Slack POST failed: {reason}' => 'Slack POST 실패: {reason}',
    'Successfully sent Slack message to "{label}".' => '"{label}" 에 Slack 메시지를 성공적으로 보냈습니다.',
    'Unable to send Bluesky post, recipient is missing credentials.' => 'Bluesky 게시물을 보낼 수 없습니다: 수신자 자격 증명이 없습니다.',
    'Body exceeded {max} characters, truncated.' => '본문이 {max} 자를 초과하여 잘렸습니다.',
    'Successfully posted to Bluesky as "{label}".' => '"{label}" 로 Bluesky 에 성공적으로 게시했습니다.',
    'Bluesky auth failed for {handle}: {reason}' => '{handle} 의 Bluesky 인증 실패: {reason}',
    'Bluesky auth failed: {reason}' => 'Bluesky 인증 실패: {reason}',
    'Bluesky post failed: {reason}' => 'Bluesky 게시 실패: {reason}',
    'Bluesky link preview skipped: {reason}' => 'Bluesky 링크 미리 보기 건너뜀: {reason}',

    // Recipient warnings
    'Recipient "{name}" has no email address.' => '수신자 "{name}" 에 이메일 주소가 없습니다.',
    'Recipient "{name}" has no phone number.' => '수신자 "{name}" 에 전화번호가 없습니다.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => '수신자 "{name}" 에 연결된 사용자가 없어 공지를 보낼 수 없습니다.',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => '수신자 "{name}" 가 컨트롤 패널에 접근할 수 없어 공지를 보낼 수 없습니다.',
    'Pushover user-key field is not configured on this notification.' => '이 알림에 Pushover 사용자 키 필드가 구성되지 않았습니다.',
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => '수신자 "{name}" 에 연결된 사용자가 없어 Pushover 메시지를 보낼 수 없습니다.',
    '[SKIPPED] User "{name}" has no Pushover key.' => '[건너뜀] 사용자 "{name}" 에 Pushover 키가 없습니다.',
    'Recipient "{name}" has no ntfy topic.' => '수신자 "{name}" 에 ntfy 토픽이 없습니다.',
    'Recipient "{name}" has no Bluesky credentials.' => '수신자 "{name}" 에 Bluesky 자격 증명이 없습니다.',
    'Recipient "{name}" has no Slack bot token.' => '수신자 "{name}"에게 Slack 봇 토큰이 없습니다.',
    'Recipient "{name}" has no Slack channel ID.' => '수신자 "{name}"에게 Slack 채널 ID가 없습니다.',

    // Errors & exceptions
    'Invalid element event: {class}' => '유효하지 않은 요소 이벤트: {class}',
    'Invalid notification ID: {id}' => '유효하지 않은 알림 ID: {id}',
    'Invalid email message mode.' => '유효하지 않은 이메일 메시지 모드입니다.',
    'You do not have permission to use the Dynamic Recipients type.' => '동적 수신자 유형을 사용할 권한이 없습니다.',
    'Dynamic recipients snippet did not call setRecipients.' => '동적 수신자 스니펫이 setRecipients 를 호출하지 않았습니다.',
    'setRecipients was called with an empty value.' => 'setRecipients 가 빈 값으로 호출되었습니다.',
    'Unrecognized recipient of type "{type}".' => '유형 "{type}" 의 수신자를 인식할 수 없습니다.',
    'Unrecognized recipient "{value}".' => '수신자 "{value}" 를 인식할 수 없습니다.',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => '구성된 {kind} 가 플러그인 설정에 더 이상 존재하지 않습니다 (uid: {uid}).',
    'Invalid settings section: {section}' => '유효하지 않은 설정 섹션: {section}',
    'User not authorized to save this notification.' => '사용자가 이 알림을 저장할 권한이 없습니다.',
    'User not authorized to view this notification.' => '사용자가 이 알림을 볼 권한이 없습니다.',
    'User not authorized to delete this notification.' => '사용자가 이 알림을 삭제할 권한이 없습니다.',
    'Notification not found' => '알림을 찾을 수 없습니다',
    'Element not found' => '요소를 찾을 수 없습니다',
    'You do not have permission to use the Dynamic Data type.' => '동적 데이터 유형을 사용할 권한이 없습니다.',
    'The Dynamic Data snippet did not call the {tag} tag.' => 'Twig 스니펫이 {tag} 태그를 호출하지 않았습니다.',
    'Invalid Slack body format.' => '잘못된 Slack 본문 형식입니다.',

    // Config-file override note
    'This is being set in the config file. [{file}]' => '이는 구성 파일에서 설정됩니다. [{file}]',

    // ============================================================
    // JAVASCRIPT UI
    // ============================================================

    // JavaScript: log utility & buttons
    'Test notification failed.' => '테스트 알림을 보내지 못했습니다.',
    'Unable to get the notification, something went wrong.' => '알림을 가져오지 못했습니다. 문제가 발생했습니다.',
    'Something went wrong.' => '문제가 발생했습니다.',
    'Invalid notification ID.' => '잘못된 알림 ID입니다.',
    'Unable to delete the log event, something went wrong.' => '로그 이벤트를 삭제하지 못했습니다. 문제가 발생했습니다.',
    'Log event deleted.' => '로그 이벤트가 삭제되었습니다.',
    'Unable to delete log events, something went wrong.' => '로그 이벤트를 삭제하지 못했습니다. 문제가 발생했습니다.',
    'Are you sure you want to delete this log event?' => '이 로그 이벤트를 삭제하시겠습니까?',
    'Are you sure you want to delete all logs from {date}?' => '{date}의 모든 로그를 삭제하시겠습니까?',
];
