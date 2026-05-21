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
    'Notifications'          => 'Aviseringar',
    'Notification'           => 'Avisering',
    'All notifications'      => 'Alla aviseringar',
    'Notification Log'       => 'Aviseringslogg',
    'Logs'                   => 'Loggar',
    'View Notifications'     => 'Visa aviseringar',
    'Add a New Notification' => 'Lägg till en ny avisering',

    // Permissions
    'View notifications'              => 'Visa aviseringar',
    'Save notifications'              => 'Spara aviseringar',
    'Use the Dynamic Recipients type' => 'Använd typen Dynamiska mottagare',
    'Test notifications'              => 'Testa aviseringar',
    'Delete notifications'            => 'Ta bort aviseringar',
    'View notification log'           => 'Visa aviseringsloggen',
    'Delete notification log'         => 'Ta bort aviseringsloggen',

    // Notification editor: tabs
    'Meta'       => 'Meta',
    'Event'      => 'Händelse',
    'Message'    => 'Meddelande',
    'Recipients' => 'Mottagare',

    // Event tab: type selector
    'Event Type'                                           => 'Händelsetyp',
    'What type of event will activate the notification?'   => 'Vilken typ av händelse ska aktivera aviseringen?',
    'Which specific event will activate the notification?' => 'Vilken specifik händelse ska aktivera aviseringen?',

    // Event tab: event types
    'Assets Event'                   => 'Asset-händelse',
    'Commerce Orders Event'          => 'Commerce-orderhändelse',
    'Commerce Products Event'        => 'Commerce-produkthändelse',
    'Digital Products Event'         => 'Digital Products-händelse',
    'Digital Product Licenses Event' => 'Digital Products-licenshändelse',
    'Solspace Calendar Event'        => 'Solspace Calendar-händelse',
    'Entries Event'                  => 'Inläggshändelse',
    'Users Event'                    => 'Användarhändelse',
    'Ungrouped Users'                => 'Användare utan grupp',

    // Feed
    'Feed Event' => 'Flödeshändelse',
    'Feed URL' => 'Flödes-URL',
    'The URL of the RSS, Atom, or JSON feed to watch.' => 'URL till RSS-, Atom- eller JSON-flödet som ska bevakas.',
    // Field and element conditions
    'Field Conditions'             => 'Fältvillkor',
    'Send the message only when the saved element matches the following conditions.' => 'Skicka meddelandet endast när det sparade elementet uppfyller följande villkor.',
    'has changed'                  => 'har ändrats',
    '#{elementType} Event Filters' => 'Händelsefilter för #{elementType}',
    'No filters match this event.' => 'Inga filter matchar denna händelse.',
    'Determine whether each message should be sent based on specified conditions.' => 'Avgör utifrån angivna villkor om varje meddelande ska skickas.',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => 'Elementet sparas för första gången',
    'Must be a new entry'                       => 'Måste vara ett nytt inlägg',
    'Must be an existing entry'                 => 'Måste vara ett befintligt inlägg',
    'Can be existing or new'                    => 'Kan vara befintlig eller ny',

    // Filters: new elements
    'Element is new'         => 'Elementet är nytt',
    'New elements only'      => 'Endast nya element',
    'Existing elements only' => 'Endast befintliga element',

    // Filters: enabled state
    'Element is enabled'         => 'Elementet är aktiverat',
    'Must be enabled'            => 'Måste vara aktiverat',
    'Must be disabled'           => 'Måste vara inaktiverat',
    'Can be enabled or disabled' => 'Kan vara aktiverat eller inaktiverat',

    // Filters: drafts
    'Element is a draft'          => 'Elementet är ett utkast',
    'Must be a draft'             => 'Måste vara ett utkast',
    'Must not be a draft'         => 'Får inte vara ett utkast',
    'Can be a draft or non-draft' => 'Kan vara ett utkast eller inte',

    // Filters: provisional drafts
    'Element is a provisional draft'                => 'Elementet är ett preliminärt utkast',
    'Must be a provisional draft'                   => 'Måste vara ett preliminärt utkast',
    'Must not be a provisional draft'               => 'Får inte vara ett preliminärt utkast',
    'Can be a provisional draft or non-provisional' => 'Kan vara ett preliminärt utkast eller inte',

    // Filters: revisions
    'Element is a revision'             => 'Elementet är en revision',
    'Must be a revision'                => 'Måste vara en revision',
    'Must not be a revision'            => 'Får inte vara en revision',
    'Can be a revision or non-revision' => 'Kan vara revision eller inte',

    // Filters: duplication
    'Element is being duplicated'         => 'Elementet dupliceras',
    'Must be duplicating the element'     => 'Måste duplicera elementet',
    'Must not be duplicating the element' => 'Får inte duplicera elementet',

    // Filters: propagation
    'Element is being propagated'     => 'Elementet propageras',
    'Element must be propagating'     => 'Elementet måste propageras',
    'Element must not be propagating' => 'Elementet får inte propageras',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => 'Elementet sparas om i bulk',
    'Must be bulk-resaving the element'     => 'Måste spara om elementet i bulk',
    'Must not be bulk-resaving the element' => 'Får inte spara om elementet i bulk',

    // Filters: common output
    'Unnamed filter'                => 'Namnlöst filter',
    'Must be TRUE to send message'  => 'Måste vara TRUE för att skicka meddelandet',
    'Must be FALSE to send message' => 'Måste vara FALSE för att skicka meddelandet',
    'No effect'                     => 'Ingen effekt',

    // Message tab: type selector and queue
    'Message Type'                       => 'Meddelandetyp',
    'What type of message will be sent?' => 'Vilken typ av meddelande ska skickas?',
    'Send Message via Queue'             => 'Skicka meddelandet via kö',
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are also supported.' => '[Templating]({templatingUrl}) och [specialvariabler]({variablesUrl}) stöds också.',
    'Send immediately' => 'Skicka direkt',
    'Add to queue' => 'Lägg till i kö',

    // Message tab: Email fields
    "User's Email Address Field" => 'Användarfält för e-postadress',
    'Email Subject'              => 'E-postämne',
    'Email Body'                 => 'E-postinnehåll',

    // Message tab: SMS fields
    "User's Phone Number Field" => 'Användarfält för telefonnummer',
    'SMS Message Body'          => 'SMS-meddelandetext',

    // Message tab: Announcement fields
    'Announcement Title'   => 'Tillkännagivandets titel',
    'Announcement Message' => 'Tillkännagivandets meddelande',

    // Message tab: Flash fields
    'Flash Message Type'                         => 'Typ av flash-meddelande',
    'Flash Message Title'                        => 'Titel för flash-meddelande',
    'Flash Message Details'                      => 'Detaljer för flash-meddelande',
    'Which type of flash message should appear?' => 'Vilken typ av flash-meddelande ska visas?',

    // Message tab: Pushover fields
    "Field containing each user's Pushover key" => 'Användarens Pushover-nyckelfält',

    // Message tab: ntfy fields
    'Priority'           => 'Prioritet',
    'Tags'               => 'Taggar',
    'Click URL'          => 'Klick-URL',
    'Render as Markdown' => 'Rendera som Markdown',

    // Message tab: Slack fields
    'Slack Message Body' => 'Slack-meddelandetext',
    'Bot Icon URL' => 'Ikon-URL',
    "A URL for the icon to display alongside this message. Leave blank to use the app's default." => 'En URL för ikonen som ska visas bredvid meddelandet. Lämna tomt för att använda kanalens standard.',

    // Message tab: Bluesky fields
    'Post Body' => 'Inläggstext',
    'Generate Link Preview' => 'Generera länkförhandsvisning',
    "When the post body contains a URL, automatically generate a preview card with the linked page's image, title, and description." => 'När inläggstexten innehåller en URL bifogas ett förhandsgranskningskort med den länkade sidans titel, beskrivning och bild.',
    'No card' => 'Inget kort',
    'Generate preview card' => 'Generera förhandsvisningskort',

    // Message tab: Title / Body / Trix toolbar
    'Title'         => 'Titel',
    'Body'          => 'Innehåll',
    'Rich Text'     => 'Rik text',
    'Bold'          => 'Fetstil',
    'Italic'        => 'Kursiv',
    'Underline'     => 'Understruken',
    'Strikethrough' => 'Genomstruken',
    'Bullets'       => 'Punktlista',
    'Numbers'       => 'Numrering',
    'Heading'       => 'Rubrik',
    'Code'          => 'Kod',
    'Undo'          => 'Ångra',
    'Redo'          => 'Gör om',
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => 'Texten i utgående e-post. Du kan använda <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">specialvariabler</a>, eller till och med <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">hoppa över mottagare</a>.',

    // Recipients tab: common
    'Recipients Type'                             => 'Mottagartyp',
    'Who will receive this message?'              => 'Vem ska få det här meddelandet?',
    'Add a message recipient'                     => 'Lägg till en mottagare',
    'Select User(s)'                              => 'Välj användare',
    'Which users will receive the message?'       => 'Vilka användare ska få meddelandet?',
    'Which user groups will receive the message?' => 'Vilka användargrupper ska få meddelandet?',
    'Twig Snippet to Determine Recipients'        => 'Twig-utdrag för att bestämma mottagare',

    // Recipients tab: per-provider pickers
    'Select Slack channel(s)'                           => 'Välj Slack-kanal(er)',
    'Which Slack channels should receive this message?' => 'Vilka Slack-kanaler ska få det här meddelandet?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Inga Slack-kanaler konfigurerade. Lägg till en i [Inställningar → Slack]({url}).',
    'Select ntfy topic(s)'                              => 'Välj ntfy-ämne(n)',
    'Which ntfy topics should receive this message?'    => 'Vilka ntfy-ämnen ska få det här meddelandet?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'Inga ntfy-ämnen konfigurerade. Lägg till ett i [Inställningar → ntfy]({url}).',
    'Select Bluesky account(s)'                         => 'Välj Bluesky-konto(n)',
    'Which Bluesky accounts should post this message?'  => 'Vilka Bluesky-konton ska publicera detta meddelande?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Inga Bluesky-konton konfigurerade. Lägg till ett i [Inställningar → Bluesky]({url}).',

    // Settings: page chrome
    'Notifier Settings' => 'Notifier-inställningar',
    'General'           => 'Allmänt',
    'Twilio'            => 'Twilio',
    'Pushover'          => 'Pushover',
    'Slack'             => 'Slack',
    'Bluesky'           => 'Bluesky',
    'ntfy'              => 'ntfy',

    // Settings: Logging
    'Logging'                             => 'Loggning',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier för en löpande logg över skickade meddelanden. Det är vanligtvis inte nödvändigt, men du kan begränsa antalet logghändelser som registreras i databasen.',
    'Enable Logging'                      => 'Aktivera loggning',
    'When disabled, Notifier will not write anything to the notification log.' => 'När inaktiverat skriver Notifier ingenting till aviseringsloggen.',
    'Number of days to retain log events' => 'Antal dagar att behålla logghändelser',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Behåll logghändelser i högst så här många dagar. Lämna tomt för ingen gräns.',
    'Number of log events to retain'      => 'Antal logghändelser att behålla',
    'At most, keep this many log events. Leave blank for no limit.' => 'Behåll högst så här många logghändelser. Lämna tomt för ingen gräns.',

    // Settings: Twilio
    'Twilio API Credentials'                       => 'Twilio API-uppgifter',
    'If using the Twilio API to send SMS messages, the following credentials are required.' => 'Om du använder Twilio API för att skicka SMS krävs följande uppgifter.',
    'Twilio Account SID'                           => 'Twilio Account SID',
    'Twilio Auth Token'                            => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)' => 'Twilio-telefonnummer (skickar varje SMS-meddelande)',
    'SMS Testing'                                  => 'SMS-testning',
    'Optional. When set, every SMS dispatched will be sent to this number instead of the resolved recipient.' => 'Valfritt. Om angivet skickas varje SMS till detta nummer i stället för den faktiska mottagaren.',
    'Test phone number'                            => 'Testtelefonnummer',

    // Settings: Pushover
    "[Pushover](https://pushover.net) sends push notifications to a registered user's devices. Each Craft user needs a custom field on their profile storing their Pushover user key; you select which field on each Notification's Message tab. For full setup instructions, see the [Pushover getting-started docs](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover)." => '[Pushover](https://pushover.net) skickar push-aviseringar till en registrerad användares enheter. Varje Craft-användare behöver ett anpassat fält i sin profil som lagrar Pushover-nyckeln; du väljer vilket fält på Meddelande-fliken för varje avisering. För fullständiga konfigurationsinstruktioner, se [Pushover-introduktionsdokumentationen](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover).',
    'Application API Token'                                      => 'Programmets API-token',
    'The 30-character app token from your Pushover application.' => 'Det 30-teckens app-token från din Pushover-applikation.',

    // Settings: ntfy
    'ntfy.sh is a free HTTP-based push notification service. Subscribers receive messages on the ntfy app, web, or any compatible client by joining a topic.' => 'ntfy.sh är en gratis HTTP-baserad push-aviseringstjänst. Prenumeranter får meddelanden i ntfy-appen, på webben eller via valfri kompatibel klient genom att ansluta till ett ämne.',
    'Server URL'   => 'Server-URL',
    'Defaults to https://ntfy.sh. Point at a self-hosted ntfy instance if applicable.' => 'Standard https://ntfy.sh. Peka på en självhostad ntfy-instans om det är aktuellt.',
    'Access token' => 'Åtkomsttoken',
    'Optional. Required for protected topics or self-hosted instances with auth.' => 'Valfritt. Krävs för skyddade ämnen eller självhostade instanser med autentisering.',
    'ntfy Topics'  => 'ntfy-ämnen',
    'Named list of ntfy topics. Each topic becomes selectable on the notification edit screen.' => 'Namngiven lista över ntfy-ämnen. Varje ämne blir valbart på aviseringens redigeringsskärm.',
    'Topics'       => 'Ämnen',
    'Add one row per topic name. Use the **Test** button to send a quick test message to the topic.' => 'Lägg till en rad per ämnesnamn. Använd knappen **Test** för att skicka ett snabbt testmeddelande till ämnet.',
    'Topic'        => 'Ämne',
    'Add a topic'  => 'Lägg till ett ämne',
    'Save first to persist a row, then click its **Test** button to fire a sanity check against ntfy.' => 'Spara först för att behålla en rad, och klicka sedan på dess **Test**-knapp för att göra en snabbkoll mot ntfy.',

    // Settings: Slack
    'Slack Channels' => 'Slack-kanaler',
    'Create a [Slack app](https://api.slack.com/apps) with the `chat:write`, `chat:write.customize`, and `chat:write.public` scopes, then add a row for each channel you\'d like to post into. Each channel becomes available as a recipient on the **Recipients** tab when configuring a notification. A bot token is a secret, so store it in a `.env` variable and reference that variable (e.g. `$SLACK_BOT_TOKEN`) rather than pasting the token directly.' => 'Skapa en [Slack-app](https://api.slack.com/apps) med scope-en `chat:write`, `chat:write.customize` och `chat:write.public`, och lägg sedan till en rad för varje kanal du vill posta i. Varje kanal blir tillgänglig som mottagare på fliken **Recipients** när du konfigurerar en notifikation. En bot-token är en hemlighet, så lagra den i en `.env`-variabel och referera till den variabeln (t.ex. `$SLACK_BOT_TOKEN`) istället för att klistra in tokenet direkt.',
    'Channels'       => 'Kanaler',
    'Each Slack channel needs its own Incoming Webhook URL. Use the **Test** button to fire a quick sanity check after saving.' => 'Varje Slack-kanal behöver sin egen Incoming Webhook-URL. Använd knappen **Test** för en snabbkoll efter att du sparat.',
    'Add a channel'  => 'Lägg till en kanal',
    'Bot Token' => 'Bot-token',
    'Channel ID' => 'Kanal-ID',
    'Bot Emoji' => 'Ikon-emoji',
    'Bot Name' => 'Användarnamn',
    'Show link previews' => 'Visa länkförhandsvisningar',
    'An emoji shortcode to display alongside this message, e.g. `:rocket:`. Used only when Bot Icon URL is empty.' => 'En emoji-genväg som visas bredvid det här meddelandet, t.ex. `:rocket:`. Används endast när ikon-URL är tom.',
    "A display name for this message. Leave blank to use the app's default." => 'Ett visningsnamn för det här meddelandet. Lämna tomt för att använda appens standard.',
    'Whether Slack should unfurl link previews for URLs in the message body.' => 'Om Slack ska visa länkförhandsvisningar för URL:er i meddelandetexten.',
    'Not a valid Bot Token. Must start with `xoxb-`.' => 'Ogiltigt bot-token. Måste börja med `xoxb-`.',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => 'Ogiltigt kanal-ID. Måste se ut som `C01234ABCD`.',
    'Unable to send Slack message, no bot token.' => 'Kan inte skicka Slack-meddelande: inget bot-token.',
    'Unable to send Slack message, no channel ID.' => 'Kan inte skicka Slack-meddelande: inget kanal-ID.',
    'Recipient "{name}" has no Slack bot token.' => 'Mottagaren "{name}" har inget Slack-bot-token.',
    'Recipient "{name}" has no Slack channel ID.' => 'Mottagaren "{name}" har inget Slack-kanal-ID.',
    'Slack rejected the message: {error}' => 'Slack avvisade meddelandet: {error}',
    'Save first to persist a row, then click its **Test** button to fire a sanity check against Slack.' => 'Spara först för att behålla en rad, och klicka sedan på dess **Test**-knapp för att göra en snabbkoll mot Slack.',

    // Settings: Bluesky
    "[Bluesky](https://bsky.app) posts publish to the configured account's feed via the ATProto API. App passwords are generated at [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). An app password is a secret, so store it in a `.env` variable and reference that variable (e.g. `\$BLUESKY_APP_PASSWORD`) rather than pasting the password directly." => '[Bluesky](https://bsky.app)-inlägg publiceras till det konfigurerade kontots flöde via ATProto-API. App-lösenord genereras på [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). Ett app-lösenord är en hemlighet, så lagra det i en `.env`-variabel och referera till den variabeln (t.ex. `$BLUESKY_APP_PASSWORD`) i stället för att klistra in lösenordet direkt.',
    'PDS URL'          => 'PDS-URL',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'Standard https://bsky.social. Peka på en anpassad PDS om din installation federerar.',
    'Bluesky Accounts' => 'Bluesky-konton',
    'Named list of Bluesky accounts. Each account becomes selectable on the notification edit screen.' => 'Namngiven lista över Bluesky-konton. Varje konto blir valbart på aviseringens redigeringsskärm.',
    'Accounts'         => 'Konton',
    'Add one row per Bluesky account. Use **Test** to verify the credentials authenticate.' => 'Lägg till en rad per Bluesky-konto. Använd **Test** för att verifiera att uppgifterna autentiseras.',
    'Label'            => 'Etikett',
    'Handle'           => 'Handle',
    'App password'     => 'App-lösenord',
    'Add an account'   => 'Lägg till ett konto',
    'Save first to persist a row, then click its **Test** button to verify the credentials authenticate.' => 'Spara först för att behålla en rad, och klicka sedan på dess **Test**-knapp för att verifiera att uppgifterna autentiseras.',

    // Test notification (UI)
    'Send a test message'           => 'Skicka ett testmeddelande',
    'Are you certain you want to send a test notification?\\n\\nThe configured message will be sent to the configured recipient(s).' => 'Är du säker på att du vill skicka en testavisering?\\n\\nDet konfigurerade meddelandet skickas till de konfigurerade mottagarna.',
    'Test'                          => 'Testa',
    'Test notification dispatched.' => 'Testavisering skickad.',
    'No messages were dispatched. Check the recipient configuration.' => 'Inga meddelanden skickades. Kontrollera mottagarkonfigurationen.',

    // Settings: save / test action responses
    "Couldn't save settings."                 => 'Inställningarna kunde inte sparas.',
    'Settings saved.'                         => 'Inställningar sparade.',
    'Topic is empty.'                         => 'Ämnet är tomt.',
    'Server URL is not configured.'           => 'Server-URL är inte konfigurerad.',
    'Test message from Notifier.'             => 'Testmeddelande från Notifier.',
    'HTTP {status}'                           => 'HTTP {status}',
    'Test message sent successfully.'         => 'Testmeddelande skickat.',
    'HTTP {status}: {body}'                   => 'HTTP {status}: {body}',
    'Handle and app password are required.'   => 'Handle och app-lösenord krävs.',
    'Authentication failed.'                  => 'Autentisering misslyckades.',
    'Successfully authenticated. No messages were posted.' => 'Autentiseringen lyckades. Inga meddelanden publicerades.',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.'          => 'Skickar {messageType} till {recipient}.',
    'Adding message to queue.'                       => 'Lägger till meddelandet i kön.',
    'Unable to parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => 'Kan inte tolka flödet. PHP-tilläggen `simplexml` och `libxml` krävs.',
    'Unable to parse the feed.' => 'Kan inte tolka flödet.',
    'Unable to fetch the feed: {message}' => 'Kan inte hämta flödet: {message}',
    'Initial feed scan failed: {message}' => 'Inledande genomsökning av flödet misslyckades: {message}',
    'Sending message immediately (bypassing queue).' => 'Skickar meddelandet direkt (köen kringgås).',
    'Log events deleted.'                            => 'Logghändelser borttagna.',
    'notification'                                   => 'avisering',

    // Outbound: Email log messages
    'Unable to send email, no recipient specified.'     => 'Det går inte att skicka e-post, ingen mottagare angiven.',
    'Unable to send email, the message body was empty.' => 'Det går inte att skicka e-post, meddelandets innehåll var tomt.',
    "Unable to send the email using Craft's native email handling." => 'Det går inte att skicka e-post med Crafts inbyggda e-posthantering.',
    'Check your general email settings within Craft.'   => 'Kontrollera de allmänna e-postinställningarna i Craft.',
    'Successfully sent email message!'                  => 'E-postmeddelande skickat!',

    // Outbound: SMS log messages
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[Ogiltiga Twilio-uppgifter.]({url}) {missing} saknas.',
    'Unable to send SMS, no Twilio phone number exists.'      => 'Det går inte att skicka SMS, inget Twilio-telefonnummer finns.',
    'Unable to send SMS, no recipient phone number exists.'   => 'Det går inte att skicka SMS, inget mottagartelefonnummer finns.',
    'Unable to send SMS, recipient phone number is invalid.'  => 'Det går inte att skicka SMS, mottagarens telefonnummer är ogiltigt.',
    'Successfully sent SMS message!'                          => 'SMS-meddelande skickat!',

    // Outbound: Announcement log messages
    'Unable to post announcement, no recipient userId specified.' => 'Det går inte att publicera tillkännagivandet: inget userId för mottagaren angivet.',
    'Successfully posted announcement!' => 'Tillkännagivande publicerat!',

    // Outbound: Flash log messages
    'Unable to send the flash message, invalid flash type.' => 'Det går inte att skicka flash-meddelandet, ogiltig flash-typ.',
    'Successfully sent flash message!'                      => 'Flash-meddelande skickat!',

    // Outbound: Pushover log messages
    '[Invalid Pushover credentials.]({url}) Missing app token.'  => '[Ogiltiga Pushover-uppgifter.]({url}) App-token saknas.',
    'Unable to send Pushover message, no user key on recipient.' => 'Det går inte att skicka Pushover-meddelande: ingen användarnyckel hos mottagaren.',
    'Pushover POST failed: {reason}'                             => 'Pushover POST misslyckades: {reason}',
    'Successfully sent Pushover message!'                        => 'Pushover-meddelande skickat!',

    // Outbound: ntfy log messages
    'Unable to send ntfy message, no server URL configured.' => 'Det går inte att skicka ntfy-meddelande: ingen server-URL konfigurerad.',
    'Unable to send ntfy message, no topic specified.'       => 'Det går inte att skicka ntfy-meddelande: inget ämne angivet.',
    'ntfy POST failed with HTTP {status}: {reason}'          => 'ntfy POST misslyckades med HTTP {status}: {reason}',
    'ntfy POST failed: {reason}'                             => 'ntfy POST misslyckades: {reason}',
    'Successfully sent ntfy message to topic "{topic}".'     => 'ntfy-meddelande skickat till ämnet "{topic}".',

    // Outbound: Slack log messages
    'Unable to send Slack message, body is empty.'  => 'Det går inte att skicka Slack-meddelande: innehållet är tomt.',
    'Slack POST failed: {reason}'                   => 'Slack POST misslyckades: {reason}',
    'Successfully sent Slack message to "{label}".' => 'Slack-meddelande skickat till "{label}".',

    // Outbound: Bluesky log messages
    'Unable to send Bluesky post, recipient is missing credentials.' => 'Det går inte att skicka Bluesky-inlägg: mottagaren saknar uppgifter.',
    'Body exceeded {max} characters, truncated.'          => 'Innehållet översteg {max} tecken och trunkerades.',
    'Successfully posted to Bluesky as "{label}".'        => 'Publicerat på Bluesky som "{label}".',
    'Bluesky auth failed for {handle}: {reason}'          => 'Bluesky-autentisering misslyckades för {handle}: {reason}',
    'Bluesky auth failed: {reason}'                       => 'Bluesky-autentisering misslyckades: {reason}',
    'Bluesky post failed: {reason}'                       => 'Bluesky-inlägg misslyckades: {reason}',
    'Bluesky link preview skipped: {reason}'              => 'Bluesky-länkförhandsvisning hoppades över: {reason}',

    // Recipient-strategy warnings
    'Recipient "{name}" has no email address.'       => 'Mottagaren "{name}" har ingen e-postadress.',
    'Recipient "{name}" has no phone number.'        => 'Mottagaren "{name}" har inget telefonnummer.',
    'Recipient "{name}" has no associated User; cannot send announcement.' => 'Mottagaren "{name}" har ingen kopplad användare; tillkännagivandet kan inte skickas.',
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => 'Mottagaren "{name}" har inte åtkomst till kontrollpanelen; tillkännagivandet kan inte skickas.',
    'Pushover user-key field is not configured on this notification.' => 'Pushover-användarnyckelfältet är inte konfigurerat på denna avisering.',
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => 'Mottagaren "{name}" har ingen kopplad användare; Pushover-meddelandet kan inte skickas.',
    '[SKIPPED] User "{name}" has no Pushover key.'   => '[ÖVERHOPPAD] Användaren "{name}" har ingen Pushover-nyckel.',
    'Recipient "{name}" has no ntfy topic.'          => 'Mottagaren "{name}" har inget ntfy-ämne.',
    'Recipient "{name}" has no Bluesky credentials.' => 'Mottagaren "{name}" har inga Bluesky-uppgifter.',

    // Errors / exceptions
    'Invalid element event: {class}'                         => 'Ogiltig elementhändelse: {class}',
    'Invalid notification ID: {id}'                          => 'Ogiltigt aviserings-ID: {id}',
    'Invalid email message mode.'                            => 'Ogiltigt e-postmeddelandeläge.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Du har inte behörighet att använda typen Dynamiska mottagare.',
    'Dynamic recipients snippet did not call setRecipients.' => 'Utdraget för dynamiska mottagare anropade inte setRecipients.',
    'setRecipients was called with an empty value.'          => 'setRecipients anropades med ett tomt värde.',
    'Unrecognized recipient of type "{type}".'               => 'Okänd mottagare av typen "{type}".',
    'Unrecognized recipient "{value}".'                      => 'Okänd mottagare "{value}".',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => 'Konfigurerad {kind} finns inte längre i plug-in-inställningarna (uid: {uid}).',
    'Invalid settings section: {section}'                    => 'Ogiltig inställningssektion: {section}',
    'User not authorized to save this notification.'         => 'Användaren har inte behörighet att spara denna avisering.',
    'User not authorized to view this notification.'         => 'Användaren har inte behörighet att visa denna avisering.',
    'User not authorized to delete this notification.'       => 'Användaren har inte behörighet att ta bort denna avisering.',
    'Notification not found'                                 => 'Avisering hittades inte',

    // Misc config-file note
    'This is being set in the config file. [{file}]' => 'Detta anges i konfigurationsfilen. [{file}]',

    // Slack, ntfy, and Bluesky message types
    "Add the Bluesky accounts you'd like to post from. Each account becomes available as a recipient on the **Recipients** tab when configuring a notification." => 'Lägg till de Bluesky-konton du vill publicera från. Varje konto blir tillgängligt som mottagare på fliken **Mottagare** när du konfigurerar en avisering.',
    "Click any row's **Test** button to confirm the account authenticates." => 'Klicka på **Test**-knappen på valfri rad för att bekräfta att kontot autentiseras.',
    "Click any row's **Test** button to send a quick test message to that channel." => 'Klicka på **Test**-knappen på valfri rad för att skicka ett snabbt testmeddelande till den kanalen.',
    'Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`.' => 'Valfritt, peka på en självhostad ntfy-instans (om aktuellt). Standard `https://ntfy.sh`.',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Valfritt, krävs för skyddade ämnen eller självhostade instanser med autentisering.',
    'Add the ntfy topics you\'d like to send messages to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification.' => 'Lägg till de ntfy-ämnen du vill skicka meddelanden till. Varje ämne blir tillgängligt som mottagare på fliken **Mottagare** när du konfigurerar en avisering.',
    "Click any row's **Test** button to send a quick test message to that topic." => 'Klicka på **Test**-knappen på valfri rad för att skicka ett snabbt testmeddelande till det ämnet.',
    'Enable Markdown' => 'Aktivera Markdown',
    'Link URL' => 'Länk-URL',

    // Manual triggers
    'Send Notification'                                            => 'Skicka avisering',
    'Send manual notifications'                                    => 'Skicka manuella aviseringar',
    'Are you sure you want to send this notification?'             => 'Är du säker på att du vill skicka den här aviseringen?',
    'This notification cannot be triggered manually.'              => 'Den här aviseringen kan inte utlösas manuellt.',
    'This notification no longer applies to the selected element.' => 'Den här aviseringen gäller inte längre det valda elementet.',
    'Notification was not sent. Check the Notification Log for details.' => 'Aviseringen skickades inte. Se Aviseringsloggen för mer information.',
    'Notification sent.'                                           => 'Avisering skickad.',
    'Element not found'                                            => 'Elementet hittades inte',
    'Trigger Label'                                                => 'Etikett för utlösare',
    'An element action label (helps to differentiate multiple triggers).'        => 'En etikett för elementåtgärden (hjälper till att skilja flera utlösare åt).',

    // Event tab: date trigger
    'On'                                                          => 'På',
    'days before'                                                 => 'dagar före',
    'days after'                                                  => 'dagar efter',
    'Relevant Date'                                               => 'Relevant datum',
    'Send the notification relative to a chosen date.'            => 'Skicka aviseringen i förhållande till ett valt datum.',
    "Fires when an entry's Post Date passes and it becomes Live." => 'Utlöses när en posts publiceringsdatum nås och den blir live.',

    // Scheduled sending
    'Scheduled Sending' => 'Schemalagd sändning',
    'Shared secret for authenticating scheduled-run web requests. Required only when the schedule is triggered via the web endpoint.' => 'Delad hemlighet för att autentisera webbförfrågningar för schemalagd körning. Krävs endast när schemat utlöses via webbslutpunkten.',
    'Scheduled-Run Token' => 'Token för schemalagd körning',
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => 'Skickas med varje förfrågan som X-Notifier-Token-rubrik eller token-parameter i kroppen.',
    'Pushover Title' => 'Pushover-titel',
    'Pushover Body' => 'Pushover-innehåll',
    'ntfy Title' => 'ntfy-titel',
    'ntfy Body' => 'ntfy-innehåll',
    'ntfy Link URL' => 'ntfy-länk-URL',
    'Render Link Previews' => 'Visa länkförhandsgranskningar',
    'Don\'t unfurl' => 'Expandera inte',
    'Expand link previews' => 'Expandera länkförhandsgranskningar',
    'Regular text only' => 'Endast vanlig text',
    'Markdown enabled' => 'Markdown aktiverat',
    'Dynamic Pushover Title' => 'Dynamisk Pushover-titel',
    'Dynamic Subject Line' => 'Dynamisk ämnesrad',
    'Dynamic Bot Name' => 'Dynamiskt botnamn',
    'Dynamic ntfy Title' => 'Dynamisk ntfy-titel',
    'Dynamic Announcement Title' => 'Dynamisk meddelandetitel',
    'Dynamic Flash Message Title' => 'Dynamisk Flash-meddelandetitel',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => 'Vanlig text, max 300 tecken. URL:er och `@handle.tld`-omnämnanden länkas automatiskt.',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => 'Generera automatiskt ett förhandsgranskningskort när inläggets text innehåller en URL.',
    'Whether the message be sent via the [jobs queue]({queueUrl}).' => 'Om meddelandet ska skickas via [jobbkön]({queueUrl}).',
    'Priority level of the ntfy message.' => 'Prioritetsnivå för ntfy-meddelandet.',
    'Optionally include comma-separated [emoji shortcodes](https://docs.ntfy.sh/emojis/).' => 'Inkludera eventuellt kommaseparerade [emoji-koder](https://docs.ntfy.sh/emojis/).',
    'Body of the ntfy notification.' => 'Innehåll i ntfy-aviseringen.',
    'Optionally open a URL when the notification is clicked.' => 'Öppna eventuellt en URL när aviseringen klickas.',
    'Whether to parse the body as Markdown in supported clients.' => 'Om innehållet ska tolkas som Markdown i klienter som stöder det.',
    'Heading of the announcement.' => 'Rubrik på meddelandet.',
    'Body of the announcement. Supports Markdown.' => 'Innehåll i meddelandet. Stöder Markdown.',
    'Heading of the flash message.' => 'Rubrik på flash-meddelandet.',
    'Optionally include details below the heading. Supports Markdown and HTML.' => 'Inkludera eventuellt detaljer under rubriken. Stöder Markdown och HTML.',
    'Optionally include a heading above the body.' => 'Inkludera eventuellt en rubrik ovanför innehållet.',
    'Body of the SMS (text message). Plain text only.' => 'Innehåll i SMS:et (textmeddelande). Endast vanlig text.',
    'Body of the Pushover notification. Plain text only.' => 'Innehåll i Pushover-aviseringen. Endast vanlig text.',
    'Subject line of the email.' => 'Ämnesrad för e-postmeddelandet.',
    'Body of the email. Supports HTML.' => 'Innehåll i e-postmeddelandet. Stöder HTML.',
    'Body of the Slack message. Supports [Slack mrkdwn](https://api.slack.com/reference/surfaces/formatting) syntax.' => 'Innehåll i Slack-meddelandet. Stöder [Slack mrkdwn](https://api.slack.com/reference/surfaces/formatting)-syntax.',
    'Optionally override the app\'s display name.' => 'Skriv eventuellt över appens visningsnamn.',
    'Optionally override the app\'s icon with a URL.' => 'Skriv eventuellt över appens ikon med en URL.',
    'Optionally override the app\'s icon with an emoji. Used only when Bot Icon URL is empty.' => 'Skriv eventuellt över appens ikon med en emoji. Används endast när Bot Icon URL är tom.',
];
