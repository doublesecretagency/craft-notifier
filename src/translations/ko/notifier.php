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

    // ========================================================
    // NOTIFICATION EDITOR
    // ========================================================

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
    'Generate report on a recurring schedule' => '반복 일정에 따라 보고서 생성',
    'Generate report on demand' => '필요 시 보고서 생성',
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

    // Message tab: type selector
    'Message Type' => '메시지 유형',
    'What type of message will be sent?' => '어떤 유형의 메시지가 전송됩니까?',
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are supported.' => '[템플릿]({templatingUrl})과 [특수 변수]({variablesUrl})가 지원됩니다.',

    // Details sidebar: queue
    'Use Queue' => '대기열 사용',
    'Immediate' => '즉시',
    'Queue' => '대기열',
    'jobs queue' => '작업 대기열',
    'Whether the message will be sent immediately, or added to the {link}.' => '메시지를 즉시 보낼지 또는 {link}에 추가할지 여부.',
    'Flash messages never use the queue.' => 'Flash 메시지는 대기열을 사용하지 않습니다.',
    'Announcements always use the queue.' => '공지는 항상 대기열을 사용합니다.',

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

    // Message tab: Discord
    'Discord Message Body' => 'Discord 메시지 본문',
    'Supports standard Markdown, and optionally HTML _(see below)_. Max 2000 characters.' => '표준 Markdown과 선택적으로 HTML을 지원합니다 _(아래 참조)_. 최대 2000자.',
    'Whether to only parse as Markdown, or additionally parse it as HTML.' => 'Markdown으로만 파싱할지, HTML도 추가로 파싱할지 여부.',
    'Markdown only' => 'Markdown만',
    'Markdown + HTML' => 'Markdown + HTML',
    'Whether Discord should unfurl link previews for URLs in the message body.' => 'Discord가 메시지 본문의 URL에 대해 링크 미리보기를 표시할지 여부입니다.',
    'Webhook Username' => 'Webhook 사용자 이름',
    'Optionally override the webhook\'s display name.' => '선택적으로 Webhook의 표시 이름을 재정의합니다.',
    'Dynamic Username' => '동적 사용자 이름',
    'Webhook Avatar URL' => 'Webhook 아바타 URL',
    'Optionally override the webhook\'s avatar with a URL.' => '선택적으로 Webhook의 아바타를 URL로 재정의합니다.',

    // Message tab: Facebook
    'Message Body' => '메시지 본문',
    'The text of your Facebook post.' => 'Facebook 게시물의 텍스트.',
    'Preview Card URL' => '미리보기 카드 URL',
    'Optionally add a link to generate a preview card.' => '선택적으로 링크를 추가하여 미리보기 카드를 생성합니다.',

    // Message tab: Instagram
    'Caption' => '캡션',
    'Image Attachment' => '이미지 첨부',
    'Optional caption, max 2200 characters.' => '선택적 캡션, 최대 2200자.',

    // Message tab: X (Twitter)
    'Plain text, max 280 characters.' => '일반 텍스트, 최대 280자.',

    // Message tab: Media
    'Attach an image by calling `{% setMedia %}` in a [custom Twig snippet]({url}).' => '[사용자 지정 Twig 스니펫]({url})에서 `{% setMedia %}`을(를) 호출하여 이미지를 첨부하세요.',

    // Message tab: Bluesky
    'Post Body' => '게시물 본문',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => '일반 텍스트, 최대 300자. URL과 `@handle.tld` 멘션은 자동으로 링크됩니다.',
    'Generate Link Preview' => '링크 미리보기 생성',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => '게시물 본문에 URL이 포함되어 있을 때 미리보기 카드를 자동으로 생성합니다.',
    'No card' => '카드 없음',
    'Generate preview card' => '미리보기 카드 생성',

    // Message tab: Mastodon
    'Plain text, max 500 characters. URLs will unfurl automatically.' => '일반 텍스트, 최대 500자. URL은 자동으로 펼쳐집니다.',
    'Visibility' => '공개 범위',
    'Who will be able to see this post?' => '누가 이 게시물을 볼 수 있나요?',

    // Message tab: LinkedIn
    'LinkedIn' => 'LinkedIn',
    'The text of your LinkedIn post.' => 'LinkedIn 게시물의 텍스트입니다.',

    // Message tab: MQTT
    'Payload' => '페이로드',
    'The JSON or plain text message published to the MQTT topic.' => 'MQTT 토픽에 게시되는 JSON 또는 일반 텍스트 메시지.',
    'Quality of Service' => '서비스 품질',
    'Delivery guarantee for this message.' => '이 메시지의 전달 보장 수준.',
    'Retain' => '보존',
    'Whether the broker keeps this as the topic\'s last message for future subscribers.' => '브로커가 이 메시지를 토픽의 마지막 메시지로 보존하여 이후 구독자에게 전달할지 여부.',
    'Don\'t retain' => '보존 안 함',

    // Recipients tab: type selector & user/group pickers
    'Recipients Type' => '수신자 유형',
    'Who will receive this message?' => '누가 이 메시지를 받습니까?',
    'Add a message recipient' => '수신자 추가',
    'Select User(s)' => '사용자 선택',
    'Which users will receive the message?' => '어떤 사용자가 메시지를 받습니까?',
    'Which user groups will receive the message?' => '어떤 사용자 그룹이 메시지를 받습니까?',

    // Recipients tab: channel pickers (ntfy, Slack, Discord, Bluesky, Mastodon, MQTT)
    'Select ntfy topic(s)' => 'ntfy 토픽 선택',
    'Which topics should receive this message?' => '어떤 토픽이 이 메시지를 받아야 합니까?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => '구성된 ntfy 토픽이 없습니다. [설정 → ntfy]({url})에서 추가하세요.',
    'No ntfy topics configured. Topics can only be added in an environment that allows administrative changes.' => '구성된 ntfy 토픽이 없습니다. 토픽은 관리 변경이 허용된 환경에서만 추가할 수 있습니다.',
    'Select Slack channel(s)' => 'Slack 채널 선택',
    'Which channels should receive this message?' => '어떤 채널이 이 메시지를 받아야 합니까?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => '구성된 Slack 채널이 없습니다. [설정 → Slack]({url})에서 추가하세요.',
    'No Slack channels configured. Channels can only be added in an environment that allows administrative changes.' => '구성된 Slack 채널이 없습니다. 채널은 관리 변경이 허용된 환경에서만 추가할 수 있습니다.',
    'Select Discord channel(s)' => 'Discord 채널 선택',
    'No Discord channels configured. Add one in [Settings → Discord]({url}).' => '구성된 Discord 채널이 없습니다. [설정 → Discord]({url})에서 추가하세요.',
    'No Discord channels configured. Channels can only be added in an environment that allows administrative changes.' => '구성된 Discord 채널이 없습니다. 채널은 관리 변경이 허용된 환경에서만 추가할 수 있습니다.',
    'Select Facebook page(s)' => 'Facebook 페이지 선택',
    'Which pages should post this message?' => '어떤 페이지가 이 메시지를 게시합니까?',
    'No Facebook pages configured. Add one in [Settings → Facebook]({url}).' => '구성된 Facebook 페이지가 없습니다. [설정 → Facebook]({url})에서 추가하세요.',
    'No Facebook pages configured. Pages can only be added in an environment that allows administrative changes.' => '구성된 Facebook 페이지가 없습니다. 페이지는 관리 변경이 허용된 환경에서만 추가할 수 있습니다.',
    'Select Instagram account(s)' => 'Instagram 계정 선택',
    'No Instagram accounts configured. Add one in [Settings → Instagram]({url}).' => '구성된 Instagram 계정이 없습니다. [설정 → Instagram]({url})에서 추가하세요.',
    'No Instagram accounts configured. Accounts can only be added in an environment that allows administrative changes.' => '구성된 Instagram 계정이 없습니다. 계정은 관리 변경이 허용된 환경에서만 추가할 수 있습니다.',
    'Select X (Twitter) account(s)' => 'X (Twitter) 계정 선택',
    'No X (Twitter) accounts configured. Add one in [Settings → X (Twitter)]({url}).' => '구성된 X (Twitter) 계정이 없습니다. [설정 → X (Twitter)]({url})에서 추가하세요.',
    'No X (Twitter) accounts configured. Accounts can only be added in an environment that allows administrative changes.' => '구성된 X (Twitter) 계정이 없습니다. 계정은 관리 변경이 허용된 환경에서만 추가할 수 있습니다.',
    'Select Bluesky account(s)' => 'Bluesky 계정 선택',
    'Which accounts should post this message?' => '어떤 계정이 이 메시지를 게시합니까?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => '구성된 Bluesky 계정이 없습니다. [설정 → Bluesky]({url})에서 추가하세요.',
    'No Bluesky accounts configured. Accounts can only be added in an environment that allows administrative changes.' => '구성된 Bluesky 계정이 없습니다. 계정은 관리 변경이 허용된 환경에서만 추가할 수 있습니다.',
    'Select Mastodon account(s)' => 'Mastodon 계정 선택',
    'No Mastodon accounts configured. Add one in [Settings → Mastodon]({url}).' => '구성된 Mastodon 계정이 없습니다. [설정 → Mastodon]({url})에서 추가하세요.',
    'No Mastodon accounts configured. Accounts can only be added in an environment that allows administrative changes.' => '구성된 Mastodon 계정이 없습니다. 계정은 관리 변경이 허용된 환경에서만 추가할 수 있습니다.',
    'Select MQTT topic(s)' => 'MQTT 토픽 선택',
    'No MQTT topics configured. Add one in [Settings → MQTT]({url}).' => '구성된 MQTT 토픽이 없습니다. [설정 → MQTT]({url})에서 추가하세요.',
    'No MQTT topics configured. Topics can only be added in an environment that allows administrative changes.' => '구성된 MQTT 토픽이 없습니다. 토픽은 관리 변경이 허용된 환경에서만 추가할 수 있습니다.',
    'Not a valid topic. Must not be empty or contain the `+` or `#` wildcards.' => '유효한 토픽이 아닙니다. 비어 있거나 와일드카드 `+` 또는 `#`를 포함할 수 없습니다.',

    // Recipients tab: LinkedIn picker
    'Select LinkedIn account(s)' => 'LinkedIn 계정 선택',
    'Which page or member should post this message?' => '어떤 페이지 또는 회원이 이 메시지를 게시해야 합니까?',
    'No LinkedIn accounts connected. Connect one in [Settings → LinkedIn]({url}).' => '연결된 LinkedIn 계정이 없습니다. [설정 → LinkedIn]({url})에서 연결하세요.',
    'No LinkedIn accounts connected. Accounts can only be connected in an environment that allows administrative changes.' => '연결된 LinkedIn 계정이 없습니다. 계정은 관리 변경이 허용된 환경에서만 연결할 수 있습니다.',

    // Recipients tab: dynamic recipients snippet
    'Twig Snippet to Determine Recipients' => '수신자를 결정하는 Twig 스니펫',
    'Enter a custom Twig snippet to [determine who will receive the message]({url}).' => '[메시지를 받을 대상을 결정할]({url}) 사용자 지정 Twig 스니펫을 입력하세요.',
    'The snippet **must** include a `{% setRecipients %}` tag.' => '스니펫에는 `{% setRecipients %}` 태그가 **반드시** 포함되어야 합니다.',

    // ========================================================
    // SETTINGS
    // ========================================================

    // Settings: nav & page chrome
    'Notifier Settings' => 'Notifier 설정',
    'General' => '일반',
    'Twilio' => 'Twilio',
    'Pushover' => 'Pushover',
    'ntfy' => 'ntfy',
    'Slack' => 'Slack',
    'Discord' => 'Discord',
    'Bluesky' => 'Bluesky',
    'Mastodon' => 'Mastodon',
    'MQTT' => 'MQTT',

    // Settings: nav group headings
    'Push Notifications' => '푸시 알림',
    'Chat Platforms' => '채팅 플랫폼',
    'Social Media' => '소셜 미디어',
    'Internet of Things' => '사물 인터넷',
    'Expand {heading}' => '{heading} 펼치기',

    // Settings: shared intro lines
    'Consult the [{name} setup guide]({url}) for complete instructions.' => '전체 지침은 [{name} 설정 가이드]({url})를 참조하십시오.',
    'Sensitive values can be stored in your `.env` file and referenced here.' => '민감한 값은 `.env` 파일에 저장하고 여기에서 참조할 수 있습니다.',

    // Settings: Notification order
    'Notification Order' => '알림 순서',
    'Notifications can be dragged into any order on the index page. Choose where new notifications land in that order.' => '알림은 목록 페이지에서 드래그하여 원하는 순서로 정렬할 수 있습니다. 새 알림을 이 순서에서 어디에 추가할지 선택하세요.',
    'Default Placement' => '기본 위치',
    'Where new notifications are added to the list.' => '새 알림이 목록에 추가되는 위치입니다.',
    'Before other notifications' => '다른 알림 앞',
    'After other notifications' => '다른 알림 뒤',

    // Settings: Logging
    'Logging' => '로깅',
    "Notifier keeps a running log of every message it sends. You usually won't need to change this, but you can limit how many log entries are kept in the database." => 'Notifier 는 보낸 메시지를 지속적으로 기록합니다. 일반적으로 필요하지 않지만 데이터베이스에 기록되는 로그 이벤트 수를 제한할 수 있습니다.',
    'Enable Logging' => '로깅 활성화',
    'When disabled, Notifier will not write anything to the notification log.' => '비활성화 시 Notifier 는 알림 로그에 아무것도 기록하지 않습니다.',
    'Number of days to retain log events' => '로그 이벤트를 보관할 일수',
    'At most, keep log events for this many days. Leave blank for no limit.' => '로그 이벤트를 최대 이 일수만큼만 보관합니다. 제한 없음으로 두려면 비워두세요.',
    'Number of log events to retain' => '보관할 로그 이벤트 수',
    'At most, keep this many log events. Leave blank for no limit.' => '최대 이만큼의 로그 이벤트를 보관합니다. 제한 없음으로 두려면 비워두세요.',

    // Settings: Scheduled sending
    'Scheduled Sending' => '예약 발송',
    'A shared secret that authenticates scheduled runs triggered over the web. You only need this if you trigger the schedule from the web endpoint.' => '예약 실행 웹 요청을 인증하기 위한 공유 비밀입니다. 일정이 웹 엔드포인트를 통해 트리거되는 경우에만 필요합니다.',
    'Scheduled-Run Token' => '예약 실행 토큰',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => '각 요청과 함께 X-Notifier-Token 헤더 또는 token 본문 매개변수로 전송됩니다.',

    // Settings: Twilio
    'Send SMS text messages through [Twilio](https://www.twilio.com).' => '[Twilio](https://www.twilio.com)를 통해 SMS 문자 메시지를 보냅니다.',
    'Twilio Account SID' => 'Twilio 계정 SID',
    'Twilio Auth Token' => 'Twilio 인증 토큰',
    'Twilio phone number (sends each SMS message)' => 'Twilio 전화번호 (각 SMS 메시지 발신)',
    'SMS Testing' => 'SMS 테스트',
    'Optional. When set, every SMS is sent to this number instead of the actual recipient.' => '선택 사항. 설정하면 발송되는 모든 SMS 가 실제 수신자 대신 이 번호로 전송됩니다.',
    'Test phone number' => '테스트 전화번호',

    // Settings: Pushover
    'Send push notifications through [Pushover](https://pushover.net).' => '[Pushover](https://pushover.net)를 통해 푸시 알림을 보냅니다.',
    'Application API Token' => '애플리케이션 API 토큰',
    'The 30-character app token from your Pushover application.' => 'Pushover 애플리케이션의 30자 앱 토큰입니다.',

    // Settings: ntfy
    'Send push notifications through [ntfy](https://ntfy.sh).' => '[ntfy](https://ntfy.sh)를 통해 푸시 알림을 보냅니다.',
    'Server URL' => '서버 URL',
    "Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`." => '선택 사항. 해당하는 경우 자체 호스팅 ntfy 인스턴스를 지정하세요. 기본값은 `https://ntfy.sh` 입니다.',
    'Access token' => '액세스 토큰',
    'Optional, required for protected topics or self-hosted instances with auth.' => '선택 사항. 보호된 토픽이나 인증이 있는 자체 호스팅 인스턴스에 필요합니다.',
    'ntfy Topics' => 'ntfy 토픽',
    'Add the ntfy topics you want to send to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => '메시지를 보낼 ntfy 토픽을 추가하세요. 각 토픽은 알림을 구성할 때 **수신자** 탭에서 수신자로 사용할 수 있습니다.',
    'Topics' => '토픽',
    "Click any row's **Test** button to send a quick test message to that topic." => '아무 행의 **테스트** 버튼을 클릭하여 해당 토픽에 빠른 테스트 메시지를 보내세요.',
    'Label' => '레이블',
    'Topic' => '토픽',
    'Add a topic' => '토픽 추가',

    // Settings: Slack
    'Post messages to your Slack channels.' => 'Slack 채널에 메시지를 게시합니다.',
    'Channels' => '채널',
    "Click any row's **Test** button to send a quick test message to that channel." => '아무 행의 **테스트** 버튼을 클릭하여 해당 채널에 빠른 테스트 메시지를 보내세요.',
    'Bot Token' => '봇 토큰',
    'Channel ID' => '채널 ID',
    'Add a channel' => '채널 추가',
    'Not a valid Bot Token. Must start with `xoxb-`.' => '유효하지 않은 봇 토큰입니다. `xoxb-`로 시작해야 합니다.',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => '유효하지 않은 채널 ID입니다. `C01234ABCD`와 같은 형식이어야 합니다.',

    // Settings: Discord
    'Post messages to your Discord channels.' => 'Discord 채널에 메시지를 게시합니다.',
    'Webhook URL' => 'Webhook URL',
    'Not a valid Webhook URL. Must start with `https://discord.com/api/webhooks/`.' => '유효하지 않은 Webhook URL입니다. `https://discord.com/api/webhooks/`로 시작해야 합니다.',

    // Settings: Facebook
    'Facebook' => 'Facebook',
    'Publish posts to your [Facebook](https://facebook.com) pages.' => '[Facebook](https://facebook.com) 페이지에 게시물을 게시합니다.',
    'Pages' => '페이지',
    'Page ID' => 'Page ID',
    'Page Access Token' => 'Page Access Token',
    'Add a page' => '페이지 추가',
    "Click any row's **Test** button to verify that page's credentials. No posts are made." => '아무 행의 **테스트** 버튼을 클릭하여 해당 페이지의 자격 증명을 확인하세요. 게시물은 작성되지 않습니다.',

    // Settings: Instagram
    'Instagram' => 'Instagram',
    'Publish posts to your [Instagram](https://instagram.com) Business accounts.' => '[Instagram](https://instagram.com) Business 계정에 게시물을 게시합니다.',
    "Click any row's **Test** button to resolve the linked Instagram account. No posts are made." => '아무 행의 **테스트** 버튼을 클릭하여 연결된 Instagram 계정을 확인하세요. 게시물은 작성되지 않습니다.',

    // Settings: X (Twitter)
    'X (Twitter)' => 'X (Twitter)',
    'Publish posts to your [X (Twitter)](https://x.com) accounts.' => '[X (Twitter)](https://x.com) 계정에 게시물을 게시합니다.',
    'Consumer Key' => 'Consumer Key',
    'Consumer Key Secret' => 'Consumer Key Secret',
    'Access Token Secret' => 'Access Token Secret',

    // Settings: Bluesky
    'Publish posts to your [Bluesky](https://bsky.app) accounts.' => '[Bluesky](https://bsky.app) 계정에 게시물을 게시합니다.',
    'PDS URL' => 'PDS URL',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => '기본값은 https://bsky.social 입니다. 설치가 페더레이션된다면 사용자 정의 PDS 를 지정하세요.',
    'Bluesky Accounts' => 'Bluesky 계정',
    'Add the Bluesky accounts you want to post from. Each account becomes available as a recipient on the **Recipients** tab when you set up a notification.' => '게시할 때 사용할 Bluesky 계정을 추가하세요. 각 계정은 알림을 구성할 때 **수신자** 탭에서 수신자로 사용할 수 있습니다.',
    'Accounts' => '계정',
    "Click any row's **Test** button to confirm the account authenticates." => '아무 행의 **테스트** 버튼을 클릭하여 계정이 인증되는지 확인하세요.',
    'Handle' => '핸들',
    'App password' => '앱 비밀번호',
    'Add an account' => '계정 추가',

    // Settings: Mastodon
    'Publish posts to your [Mastodon](https://joinmastodon.org) accounts.' => '[Mastodon](https://joinmastodon.org) 계정에 게시물을 게시합니다.',
    'Click any row\'s **Test** button to verify that account\'s credentials. No posts are made.' => '아무 행의 **테스트** 버튼을 클릭하여 해당 계정의 자격 증명을 확인하세요. 게시물은 작성되지 않습니다.',
    'Instance URL' => '인스턴스 URL',
    'Access Token' => '액세스 토큰',

    // Settings: LinkedIn
    'Publish posts to your [LinkedIn](https://linkedin.com) profile.' => '[LinkedIn](https://linkedin.com) 프로필에 게시물을 게시합니다.',
    'The Client ID of your LinkedIn app.' => 'LinkedIn 앱의 클라이언트 ID입니다.',
    'Client Secret' => '클라이언트 시크릿',
    'The Primary Client Secret of your LinkedIn app.' => 'LinkedIn 앱의 기본 클라이언트 시크릿입니다.',
    'Enable organization posting' => '조직 게시 사용',
    'Copy this redirect URL' => '이 리디렉션 URL 복사',
    'When configuring the LinkedIn app, <strong>copy this URL</strong> to use as an "Authorized redirect URL".' => 'LinkedIn 앱을 구성할 때 <strong>이 URL을 복사</strong>하여 "Authorized redirect URL"로 사용하세요.',
    'Also request access to post as organization pages you administer. Requires Community Management API approval from LinkedIn.' => '관리하는 조직 페이지로 게시할 수 있는 접근 권한도 요청합니다. LinkedIn의 Community Management API 승인이 필요합니다.',
    'Connections' => '연결',
    'Each connection becomes available as a recipient on the **Recipients** tab when you set up a notification.' => '알림을 설정하면 각 연결이 **수신자** 탭에서 수신자로 사용할 수 있게 됩니다.',
    'Account' => '계정',
    'Type' => '유형',
    'Status' => '상태',
    'Organization' => '조직',
    'Member' => '회원',
    'Reconnect needed' => '재연결 필요',
    'Expires' => '만료',
    'Connected' => '연결됨',
    'Disconnect' => '연결 해제',
    'No LinkedIn accounts are connected yet.' => '아직 연결된 LinkedIn 계정이 없습니다.',
    'Connect to LinkedIn' => 'LinkedIn에 연결',
    'Provide valid credentials to connect with LinkedIn.' => 'LinkedIn에 연결하려면 유효한 자격 증명을 입력하세요.',
    'Disconnect this LinkedIn account?' => '이 LinkedIn 계정의 연결을 해제하시겠습니까?',

    // Settings: MQTT
    'Publish messages to an MQTT broker, handy for IoT and home-automation setups.' => 'MQTT 브로커에 메시지를 게시합니다. IoT 및 홈 오토메이션 구성에 유용합니다.',
    'Host' => '호스트',
    'Broker hostname, without a protocol or port.' => '프로토콜이나 포트를 제외한 브로커 호스트 이름.',
    'Port' => '포트',
    'Optional. Defaults to 8883 when TLS is enabled, otherwise 1883.' => '선택 사항. TLS가 활성화된 경우 기본값은 8883이고, 그렇지 않으면 1883입니다.',
    'Use TLS' => 'TLS 사용',
    'Whether to connect to the broker over a secure TLS socket.' => '보안 TLS 소켓을 통해 브로커에 연결할지 여부.',
    'Username' => '사용자 이름',
    'Optional, for brokers that require username/password authentication.' => '선택 사항. 사용자 이름/비밀번호 인증이 필요한 브로커에 사용합니다.',
    'Password' => '비밀번호',
    'MQTT Version' => 'MQTT 버전',
    'Protocol version sent to the broker.' => '브로커에 전송되는 프로토콜 버전.',
    'Client ID' => '클라이언트 ID',
    'Optional. A unique client ID is generated automatically when left blank.' => '선택 사항. 비워 두면 고유한 클라이언트 ID가 자동으로 생성됩니다.',
    'Mutual TLS' => '상호 TLS',
    'Optional. Needed for brokers that authenticate clients with certificates, such as AWS IoT Core. Enter the server file paths to your certificate files. You can use a `.env` variable or `@alias` reference.' => '선택 사항. AWS IoT Core처럼 인증서로 클라이언트를 인증하는 브로커에 필요합니다. 인증서 파일에 대한 서버 파일 경로를 입력하세요(`.env` 변수 또는 `@alias` 참조가 허용됩니다).',
    'CA Certificate File' => 'CA 인증서 파일',
    'Path to the certificate authority (CA) file.' => '인증 기관(CA) 파일 경로.',
    'Client Certificate File' => '클라이언트 인증서 파일',
    'Path to the client certificate file.' => '클라이언트 인증서 파일 경로.',
    'Client Key File' => '클라이언트 키 파일',
    'Path to the client private key file.' => '클라이언트 개인 키 파일 경로.',
    'MQTT Topics' => 'MQTT 토픽',
    'Add the MQTT topics you want to publish to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => '게시할 MQTT 토픽을 추가하세요. 각 토픽은 알림을 구성할 때 **수신자** 탭에서 수신자로 사용할 수 있습니다.',
    'Click any row\'s **Test** button to publish a quick test message to that topic.' => '아무 행의 **테스트** 버튼을 클릭하여 해당 토픽에 빠른 테스트 메시지를 게시하세요.',

    // ========================================================
    // MANUAL SEND & TEST
    // ========================================================

    // Manual send & test
    'Send a test message' => '테스트 메시지 보내기',
    'Send a REAL test notification?\\n\\n⚠️ Uses a random sample of real data.\\n⚠️ Sends a real message via the configured channel.\\n⚠️ Delivers to the real configured recipient(s).' => '정말로 테스트 알림을 보내시겠습니까?\\n\\n⚠️ 실제 데이터의 무작위 샘플을 사용합니다.\\n⚠️ 설정된 채널을 통해 실제 메시지를 전송합니다.\\n⚠️ 실제로 설정된 수신자에게 전달됩니다.',
    'Test' => '테스트',
    'Send system snapshot' => '시스템 스냅샷 보내기',
    'Send data report' => '데이터 보고서 보내기',
    'Are you sure you want to send this notification?' => '이 알림을 보내시겠습니까?',
    'This notification cannot be triggered manually.' => '이 알림은 수동으로 트리거할 수 없습니다.',
    'This notification no longer applies to the selected element.' => '이 알림은 더 이상 선택한 요소에 적용되지 않습니다.',

    // ========================================================
    // RUNTIME OUTPUT
    // ========================================================

    // Runtime: dispatch log feedback
    'Sending {messageType} to {recipient}.' => '{recipient} 에게 {messageType} 을(를) 보내는 중입니다.',
    'Adding message to queue.' => '메시지를 대기열에 추가하는 중입니다.',
    'Sending message immediately (bypassing queue).' => '메시지를 즉시 보냅니다 (대기열 우회).',

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
    'Page ID and Page Access Token are required.' => 'Page ID 와 Page Access Token 이 필요합니다.',
    'Facebook rejected the request: {error}' => 'Facebook이 요청을 거부했습니다: {error}',
    'Successfully connected to "{name}". No posts were made.' => '"{name}"에 성공적으로 연결했습니다. 게시물은 작성되지 않았습니다.',
    'No Instagram Business account is linked to this Page.' => '이 페이지에 연결된 Instagram Business 계정이 없습니다.',
    'Successfully connected to @{handle}. No posts were made.' => '@{handle}(으)로 성공적으로 연결했습니다. 게시물은 작성되지 않았습니다.',
    'All four credentials are required.' => '네 가지 자격 증명이 모두 필요합니다.',
    'X (Twitter) rejected the request: {error}' => 'X (Twitter)가 요청을 거부했습니다: {error}',
    'Successfully authenticated as @{username}. No posts were made.' => '@{username}(으)로 인증에 성공했습니다. 게시물은 작성되지 않았습니다.',
    'Handle and app password are required.' => '핸들과 앱 비밀번호가 필요합니다.',
    'Authentication failed.' => '인증에 실패했습니다.',
    'Successfully authenticated. No messages were posted.' => '인증에 성공했습니다. 게시된 메시지가 없습니다.',
    'Log events deleted.' => '로그 이벤트가 삭제되었습니다.',
    'Notification sent.' => '알림을 보냈습니다.',
    'Notification was not sent. Check the Notification Log for details.' => '알림이 전송되지 않았습니다. 자세한 내용은 알림 로그를 확인하세요.',
    'Instance URL and access token are required.' => '인스턴스 URL과 액세스 토큰이 필요합니다.',
    'Mastodon rejected the request: {error}' => 'Mastodon이 요청을 거부했습니다: {error}',
    'Successfully authenticated as @{handle}. No posts were made.' => '@{handle}(으)로 인증에 성공했습니다. 게시물은 작성되지 않았습니다.',
    'Broker host is not configured.' => '브로커 호스트가 구성되지 않았습니다.',

    // Runtime: LinkedIn connect flow
    'Add your LinkedIn app credentials before connecting.' => '연결하기 전에 LinkedIn 앱 자격 증명을 추가하세요.',
    'LinkedIn authorization failed: {error}' => 'LinkedIn 인증 실패: {error}',
    'LinkedIn authorization failed: invalid state.' => 'LinkedIn 인증 실패: 잘못된 상태입니다.',
    'LinkedIn authorization failed: no code returned.' => 'LinkedIn 인증 실패: 코드가 반환되지 않았습니다.',
    'Connected to LinkedIn.' => 'LinkedIn에 연결되었습니다.',
    'Disconnected from LinkedIn.' => 'LinkedIn 연결이 해제되었습니다.',

    // Outbound: per-channel send results
    'Successfully sent email message!' => '이메일을 성공적으로 보냈습니다!',
    'Successfully sent SMS message!' => 'SMS 메시지를 성공적으로 보냈습니다!',
    'Successfully posted announcement!' => '공지를 성공적으로 게시했습니다!',
    'Successfully sent flash message!' => '플래시 메시지를 성공적으로 보냈습니다!',
    'Successfully sent Pushover message!' => 'Pushover 메시지를 성공적으로 보냈습니다!',
    'Successfully sent ntfy message to topic "{topic}".' => '토픽 "{topic}" 에 ntfy 메시지를 성공적으로 보냈습니다.',
    'Slack rejected the message: {error}' => 'Slack이 메시지를 거부했습니다: {error}',
    'Successfully sent Slack message to "{label}".' => '"{label}" 에 Slack 메시지를 성공적으로 보냈습니다.',
    'Discord rejected the message: {error}' => 'Discord가 메시지를 거부했습니다: {error}',
    'Successfully sent Discord message to "{label}".' => '"{label}"에 Discord 메시지를 성공적으로 보냈습니다.',
    'Successfully sent Facebook post to "{label}".' => '"{label}"에 Facebook 게시물을 성공적으로 보냈습니다.',
    'the attached image could not be read' => '첨부된 이미지를 읽을 수 없습니다',
    'Successfully sent X (Twitter) post as "{label}".' => '"{label}"(으)로 X (Twitter) 게시물을 성공적으로 보냈습니다.',
    'Successfully posted to Bluesky as "{label}".' => '"{label}" 로 Bluesky 에 성공적으로 게시했습니다.',
    'Successfully sent Mastodon post to "{label}".' => '"{label}"에 Mastodon 게시물을 성공적으로 보냈습니다.',
    'Successfully sent MQTT message to topic "{topic}".' => '토픽 "{topic}"에 MQTT 메시지를 보냈습니다.',

    // Outbound: LinkedIn send results & skips
    'Successfully sent LinkedIn post to "{label}".' => '"{label}"에 LinkedIn 게시물을 성공적으로 보냈습니다.',
    '[EMPTY BODY] The LinkedIn post body is empty.' => '[EMPTY BODY] LinkedIn 게시물 본문이 비어 있습니다.',
    '[NO RECIPIENT] No LinkedIn connection was specified.' => '[NO RECIPIENT] LinkedIn 연결이 지정되지 않았습니다.',
    '[RECONNECT REQUIRED] {reason}' => '[RECONNECT REQUIRED] {reason}',
    '[REJECTED BY LINKEDIN] {error}' => '[REJECTED BY LINKEDIN] {error}',
    'LinkedIn app credentials are not configured.' => 'LinkedIn 앱 자격 증명이 구성되지 않았습니다.',
    'The LinkedIn access token has expired. Please reconnect.' => 'LinkedIn 액세스 토큰이 만료되었습니다. 다시 연결하세요.',
    'The LinkedIn connection no longer exists.' => '해당 LinkedIn 연결이 더 이상 존재하지 않습니다.',
    'My LinkedIn Profile' => '내 LinkedIn 프로필',
    '[SKIPPED] Recipient "{name}" has no LinkedIn connection.' => '[SKIPPED] 수신자 "{name}"에게 LinkedIn 연결이 없습니다.',
    '[SKIPPED] The configured LinkedIn connection no longer exists (uid: {uid}).' => '[SKIPPED] 구성된 LinkedIn 연결이 더 이상 존재하지 않습니다 (uid: {uid}).',

    // Media attachments
    'Videos are not yet supported on {channel}.' => '{channel}에서는 동영상이 아직 지원되지 않습니다.',
    'The image could not be resized to fit.' => '이미지 크기를 맞게 조정할 수 없습니다.',
    'The image could not be read.' => '이미지를 읽을 수 없습니다.',
    'The image failed to upload.' => '이미지 업로드에 실패했습니다.',
    'The upload response had no media ID.' => '업로드 응답에 미디어 ID가 없습니다.',
    'The upload response had no blob.' => '업로드 응답에 blob이 없습니다.',
    '[NOT ATTACHED] Unable to attach image. {reason}' => '[첨부되지 않음] 이미지를 첨부할 수 없습니다. {reason}',

    // Recipient warnings
    '[SKIPPED] User "{name}" has no Pushover key.' => '[건너뜀] 사용자 "{name}" 에 Pushover 키가 없습니다.',

    // Errors & exceptions
    'Invalid element event: {class}' => '유효하지 않은 요소 이벤트: {class}',
    'Invalid notification ID: {id}' => '유효하지 않은 알림 ID: {id}',
    'Invalid email message mode.' => '유효하지 않은 이메일 메시지 모드입니다.',
    'You do not have permission to use the Dynamic Recipients type.' => '동적 수신자 유형을 사용할 권한이 없습니다.',
    'Invalid settings section: {section}' => '유효하지 않은 설정 섹션: {section}',
    'User not authorized to save this notification.' => '사용자가 이 알림을 저장할 권한이 없습니다.',
    'User not authorized to view this notification.' => '사용자가 이 알림을 볼 권한이 없습니다.',
    'User not authorized to delete this notification.' => '사용자가 이 알림을 삭제할 권한이 없습니다.',
    'Notification not found' => '알림을 찾을 수 없습니다',
    'Element not found' => '요소를 찾을 수 없습니다',
    'You do not have permission to use the Dynamic Data type.' => '동적 데이터 유형을 사용할 권한이 없습니다.',
    '[NO DATA] The Dynamic Data snippet did not call the {tag} tag.' => '[데이터 없음] Twig 스니펫이 {tag} 태그를 호출하지 않았습니다.',

    // Config-file override note
    'This is being set in the config file. [{file}]' => '이는 구성 파일에서 설정됩니다. [{file}]',

    // ========================================================
    // JAVASCRIPT UI
    // ========================================================

    // JavaScript: log utility & buttons
    'Test notification failed.' => '테스트 알림을 보내지 못했습니다.',
    'Unable to get the notification, something went wrong.' => '알림을 가져오지 못했습니다. 문제가 발생했습니다.',
    'Something went wrong.' => '문제가 발생했습니다.',
    'Invalid notification ID.' => '잘못된 알림 ID입니다.',
    'Unable to delete the log event, something went wrong.' => '로그 이벤트를 삭제하지 못했습니다. 문제가 발생했습니다.',
    'Log event deleted.' => '로그 이벤트가 삭제되었습니다.',
    'Unable to delete log events, something went wrong.' => '로그 이벤트를 삭제하지 못했습니다. 문제가 발생했습니다.',
    'Are you sure you want to delete all logs from {date}?' => '{date}의 모든 로그를 삭제하시겠습니까?',
    // Reworded outbound + dispatch log messages
    'Successfully posted to "{label}" Instagram account.' => 'Instagram 계정 "{label}"에 게시했습니다.',
    '[BAD CREDENTIALS] Missing app token. [Configure Pushover]({url}).' => '[잘못된 자격 증명] 앱 토큰이 없습니다. [Pushover 구성]({url}).',
    '[BAD CREDENTIALS] Missing {missing}. [Configure Twilio]({url}).' => '[잘못된 자격 증명] {missing}이(가) 없습니다. [Twilio 구성]({url}).',
    '[BAD CREDENTIALS] No Discord webhook URL is configured.' => '[잘못된 자격 증명] Discord 웹훅 URL이 구성되어 있지 않습니다.',
    '[BAD CREDENTIALS] No MQTT broker host is configured.' => '[잘못된 자격 증명] MQTT 브로커 호스트가 구성되어 있지 않습니다.',
    '[BAD CREDENTIALS] No Mastodon access token is configured.' => '[잘못된 자격 증명] Mastodon 액세스 토큰이 구성되어 있지 않습니다.',
    '[BAD CREDENTIALS] No Mastodon instance URL is configured.' => '[잘못된 자격 증명] Mastodon 인스턴스 URL이 구성되어 있지 않습니다.',
    '[BAD CREDENTIALS] No Slack bot token is configured.' => '[잘못된 자격 증명] Slack 봇 토큰이 구성되어 있지 않습니다.',
    '[BAD CREDENTIALS] No Twilio phone number is configured.' => '[잘못된 자격 증명] Twilio 전화번호가 구성되어 있지 않습니다.',
    '[BAD CREDENTIALS] The recipient is missing Bluesky credentials.' => '[잘못된 자격 증명] 수신자에게 Bluesky 자격 증명이 없습니다.',
    '[BAD CREDENTIALS] The recipient is missing Facebook credentials.' => '[잘못된 자격 증명] 수신자에게 Facebook 자격 증명이 없습니다.',
    '[BAD CREDENTIALS] The recipient is missing X (Twitter) credentials.' => '[잘못된 자격 증명] 수신자에게 X (Twitter) 자격 증명이 없습니다.',
    '[BAD CREDENTIALS] Unable to post, recipient is missing credentials.' => '[잘못된 자격 증명] 게시할 수 없습니다. 수신자에게 자격 증명이 없습니다.',
    '[EMPTY BODY] The Discord message body is empty.' => '[본문 없음] Discord 메시지 본문이(가) 비어 있습니다.',
    '[EMPTY BODY] The Facebook post body is empty.' => '[본문 없음] Facebook 게시물 본문이(가) 비어 있습니다.',
    '[EMPTY BODY] The MQTT payload is empty.' => '[본문 없음] MQTT 페이로드이(가) 비어 있습니다.',
    '[EMPTY BODY] The Mastodon post body is empty.' => '[본문 없음] Mastodon 게시물 본문이(가) 비어 있습니다.',
    '[EMPTY BODY] The Slack message body is empty.' => '[본문 없음] Slack 메시지 본문이(가) 비어 있습니다.',
    '[EMPTY BODY] The X (Twitter) post body is empty.' => '[본문 없음] X (Twitter) 게시물 본문이(가) 비어 있습니다.',
    '[EMPTY BODY] The email message body was empty.' => '[본문 없음] 이메일 본문이 비어 있습니다.',
    '[FEED ERROR] Could not fetch the feed: {message}' => '[피드 오류] 피드를 가져올 수 없습니다: {message}',
    '[FEED ERROR] Could not parse the feed.' => '[피드 오류] 피드를 구문 분석할 수 없습니다.',
    '[FEED ERROR] Could not parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => '[피드 오류] 피드를 구문 분석할 수 없습니다. PHP `simplexml` 및 `libxml` 확장이 필요합니다.',
    '[FEED ERROR] Initial feed scan failed: {message}' => '[피드 오류] 초기 피드 스캔에 실패했습니다: {message}',
    '[INVALID NUMBER] The recipient phone number is invalid.' => '[잘못된 번호] 수신자의 전화번호가 잘못되었습니다.',
    '[INVALID TYPE] The flash message type is invalid.' => '[잘못된 유형] 플래시 메시지 유형이 잘못되었습니다.',
    '[LINK PREVIEW SKIPPED] {reason}' => '[링크 미리보기 건너뜀] {reason}',
    '[MISSING IMAGE] Image Attachment field never called the {tag} tag.' => '[이미지 없음] 이미지 첨부 필드에서 {tag} 태그를 호출하지 않았습니다.',
    '[MISSING IMAGE] Image Attachment field was empty.' => '[이미지 없음] 이미지 첨부 필드가 비어 있습니다.',
    '[MISSING IMAGE] The {tag} tag was called, but returned an invalid image.' => '[이미지 없음] {tag} 태그가 호출되었지만 잘못된 이미지를 반환했습니다.',
    '[MISSING IMAGE] Unable to send Instagram post, the image needs a public URL.' => '[이미지 없음] Instagram 게시물을 보낼 수 없습니다. 이미지에 공개 URL이 필요합니다.',
    '[NO MEDIA] No image was attached because the {tag} tag was never invoked in the Image Attachment field.' => '[미디어 없음] 이미지 첨부 필드에서 {tag} 태그가 호출되지 않아 이미지가 첨부되지 않았습니다.',
    '[NO RECIPIENTS] The Dynamic Recipients snippet did not call setRecipients.' => '[수신자 없음] 동적 수신자 스니펫이 setRecipients를 호출하지 않았습니다.',
    '[NO RECIPIENTS] setRecipients was called with an empty value.' => '[수신자 없음] setRecipients가 빈 값으로 호출되었습니다.',
    '[NO RECIPIENT] No MQTT topic was specified.' => '[수신자 없음] MQTT 주제가 지정되지 않았습니다.',
    '[NO RECIPIENT] No Slack channel ID was specified.' => '[수신자 없음] Slack 채널 ID가 지정되지 않았습니다.',
    '[NO RECIPIENT] No ntfy topic was specified.' => '[수신자 없음] ntfy 주제가 지정되지 않았습니다.',
    '[NO RECIPIENT] No recipient user was specified for the announcement.' => '[수신자 없음] 공지의 수신자 사용자가 지정되지 않았습니다.',
    '[NO RECIPIENT] No recipient was specified for the email.' => '[수신자 없음] 이메일의 수신자가 지정되지 않았습니다.',
    '[NO RECIPIENT] The recipient has no Pushover user key.' => '[수신자 없음] 수신자에게 Pushover 사용자 키가 없습니다.',
    '[NO RECIPIENT] The recipient has no phone number.' => '[수신자 없음] 수신자에게 전화번호가 없습니다.',
    '[REJECTED BY DISCORD] {error}' => '[거부됨: DISCORD] {error}',
    '[REJECTED BY FACEBOOK] {error}' => '[거부됨: FACEBOOK] {error}',
    '[REJECTED BY INSTAGRAM] {error}' => '[거부됨: INSTAGRAM] {error}',
    '[REJECTED BY MASTODON] {error}' => '[거부됨: MASTODON] {error}',
    '[REJECTED BY SLACK] {error}' => '[거부됨: SLACK] {error}',
    '[REJECTED BY X (TWITTER)] {error}' => '[거부됨: X (TWITTER)] {error}',
    '[SEND FAILED] Authentication failed for {handle}: {reason}' => '[전송 실패] {handle} 인증에 실패했습니다: {reason}',
    '[SEND FAILED] Authentication failed: {reason}' => '[전송 실패] 인증에 실패했습니다: {reason}',
    "[SEND FAILED] Could not send the email using Craft's native handling. Check your general email settings within Craft." => '[전송 실패] Craft의 기본 처리로 이메일을 보낼 수 없습니다. Craft의 일반 이메일 설정을 확인하세요.',
    '[SEND FAILED] HTTP {status}: {reason}' => '[전송 실패] HTTP {status}: {reason}',
    '[SEND FAILED] {error}' => '[전송 실패] {error}',
    '[SEND FAILED] {reason}' => '[전송 실패] {reason}',
    '[SKIPPED] Pushover user-key field is not configured on this notification.' => '[건너뜀] 이 알림에 Pushover 사용자 키 필드가 구성되어 있지 않습니다.',
    '[SKIPPED] Recipient "{name}" cannot access the control panel.' => '[건너뜀] 수신자 "{name}"은(는) 제어판에 접근할 수 없습니다.',
    '[SKIPPED] Recipient "{name}" has no Bluesky credentials.' => '[건너뜀] 수신자 "{name}"에게 Bluesky 자격 증명이(가) 없습니다.',
    '[SKIPPED] Recipient "{name}" has no Craft user account.' => '[건너뜀] 수신자 "{name}"에게 Craft 사용자 계정이 없습니다.',
    '[SKIPPED] Recipient "{name}" has no Discord webhook URL.' => '[건너뜀] 수신자 "{name}"에게 Discord 웹훅 URL이(가) 없습니다.',
    '[SKIPPED] Recipient "{name}" has no Facebook credentials.' => '[건너뜀] 수신자 "{name}"에게 Facebook 자격 증명이(가) 없습니다.',
    '[SKIPPED] Recipient "{name}" has no Instagram credentials.' => '[건너뜀] 수신자 "{name}"에게 Instagram 자격 증명이(가) 없습니다.',
    '[SKIPPED] Recipient "{name}" has no MQTT topic.' => '[건너뜀] 수신자 "{name}"에게 MQTT 주제이(가) 없습니다.',
    '[SKIPPED] Recipient "{name}" has no Mastodon credentials.' => '[건너뜀] 수신자 "{name}"에게 Mastodon 자격 증명이(가) 없습니다.',
    '[SKIPPED] Recipient "{name}" has no Slack bot token.' => '[건너뜀] 수신자 "{name}"에게 Slack 봇 토큰이(가) 없습니다.',
    '[SKIPPED] Recipient "{name}" has no Slack channel ID.' => '[건너뜀] 수신자 "{name}"에게 Slack 채널 ID이(가) 없습니다.',
    '[SKIPPED] Recipient "{name}" has no X (Twitter) credentials.' => '[건너뜀] 수신자 "{name}"에게 X (Twitter) 자격 증명이(가) 없습니다.',
    '[SKIPPED] Recipient "{name}" has no email address.' => '[건너뜀] 수신자 "{name}"에게 이메일 주소이(가) 없습니다.',
    '[SKIPPED] Recipient "{name}" has no ntfy topic.' => '[건너뜀] 수신자 "{name}"에게 ntfy 주제이(가) 없습니다.',
    '[SKIPPED] Recipient "{name}" has no phone number.' => '[건너뜀] 수신자 "{name}"에게 전화번호이(가) 없습니다.',
    '[SKIPPED] The configured {kind} no longer exists in the plugin settings (uid: {uid}).' => '[건너뜀] 구성된 {kind}이(가) 플러그인 설정에 더 이상 없습니다 (uid: {uid}).',
    '[SKIPPED] Unrecognized recipient "{value}".' => '[건너뜀] 인식할 수 없는 수신자 "{value}".',
    '[SKIPPED] Unrecognized recipient of type "{type}".' => '[건너뜀] 인식할 수 없는 수신자 유형 "{type}".',
    '[TOO LONG] The Discord message body exceeds the 2000-character limit.' => '[너무 김] Discord 메시지 본문이 2000자 제한을 초과합니다.',
    '[TRUNCATED] Body exceeded {max} characters.' => '[잘림] 본문이 {max}자를 초과했습니다.',
    '[TRUNCATED] Caption exceeded {max} characters.' => '[잘림] 캡션이 {max}자를 초과했습니다.',
];
