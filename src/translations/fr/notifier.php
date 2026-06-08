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
    'Notifications' => 'Notifications',
    'Notification' => 'Notification',
    'All notifications' => 'Toutes les notifications',
    'Notification Log' => 'Journal des notifications',
    'Logs' => 'Journaux',
    'View Notifications' => 'Voir les notifications',
    'Add a New Notification' => 'Ajouter une nouvelle notification',
    'notification' => 'notification',

    // Permissions
    'View notifications' => 'Voir les notifications',
    'Save notifications' => 'Enregistrer les notifications',
    'Use the Dynamic Recipients type' => 'Utiliser le type Destinataires dynamiques',
    'Use the Dynamic Data type' => 'Utiliser le type Données dynamiques',
    'Test notifications' => 'Tester les notifications',
    'Send manual notifications' => 'Envoyer des notifications manuelles',
    'Delete notifications' => 'Supprimer les notifications',
    'View notification log' => 'Voir le journal des notifications',
    'Delete notification log' => 'Supprimer le journal des notifications',

    // ============================================================
    // NOTIFICATION EDITOR
    // ============================================================

    // Editor: tabs
    'Meta' => 'Méta',
    'Event' => 'Événement',
    'Message' => 'Message',
    'Recipients' => 'Destinataires',

    // Event tab: type selector
    'Event Type' => "Type d'événement",
    'What type of event will activate the notification?' => "Quel type d'événement déclenchera la notification ?",
    'Which specific event will activate the notification?' => 'Quel événement précis déclenchera la notification ?',

    // Event tab: event types
    'Assets Event' => "Événement d'Asset",
    'Commerce Orders Event' => 'Événement de commande Commerce',
    'Commerce Products Event' => 'Événement de produit Commerce',
    'Digital Products Event' => 'Événement Digital Products',
    'Digital Product Licenses Event' => 'Événement de licence Digital Products',
    'Solspace Calendar Event' => 'Événement Solspace Calendar',
    'Entries Event' => "Événement d'entrées",
    'Users Event' => 'Événement utilisateur',
    'Ungrouped Users' => 'Utilisateurs sans groupe',

    // Event tab: Feed
    'Feed URL' => 'URL du flux',
    'The URL of the RSS, Atom, or JSON feed to watch.' => "L'URL du flux RSS, Atom ou JSON à surveiller.",

    // Event tab: field conditions
    'Field Conditions' => 'Conditions de champ',
    'Send the message only when the saved element matches the following conditions.' => "Envoyer le message uniquement lorsque l'élément enregistré correspond aux conditions suivantes.",
    'has changed' => 'a changé',

    // Event tab: element filters (panel chrome + common output)
    '#{elementType} Event Filters' => "Filtres d'événements pour #{elementType}",
    'No filters match this event.' => 'Aucun filtre ne correspond à cet événement.',
    'Determine whether each message should be sent based on specified conditions.' => 'Déterminez selon les conditions spécifiées si chaque message doit être envoyé.',
    'Unnamed filter' => 'Filtre sans nom',
    'Must be TRUE to send message' => 'Doit être TRUE pour envoyer le message',
    'Must be FALSE to send message' => 'Doit être FALSE pour envoyer le message',
    'No effect' => 'Aucun effet',

    // Event tab: element filter rules
    'Element is being saved for the first time' => "L'élément est enregistré pour la première fois",
    'Must be a new entry' => 'Doit être une nouvelle entrée',
    'Must be an existing entry' => 'Doit être une entrée existante',
    'Can be existing or new' => 'Peut être existant ou nouveau',
    'Element is new' => "L'élément est nouveau",
    'New elements only' => 'Nouveaux éléments uniquement',
    'Existing elements only' => 'Éléments existants uniquement',
    'Element is enabled' => "L'élément est activé",
    'Must be enabled' => 'Doit être activé',
    'Must be disabled' => 'Doit être désactivé',
    'Can be enabled or disabled' => 'Peut être activé ou désactivé',
    'Element is a draft' => "L'élément est un brouillon",
    'Must be a draft' => 'Doit être un brouillon',
    'Must not be a draft' => 'Ne doit pas être un brouillon',
    'Can be a draft or non-draft' => 'Peut être un brouillon ou non',
    'Element is a provisional draft' => "L'élément est un brouillon provisoire",
    'Must be a provisional draft' => 'Doit être un brouillon provisoire',
    'Must not be a provisional draft' => 'Ne doit pas être un brouillon provisoire',
    'Can be a provisional draft or non-provisional' => 'Peut être un brouillon provisoire ou non',
    'Element is a revision' => "L'élément est une révision",
    'Must be a revision' => 'Doit être une révision',
    'Must not be a revision' => 'Ne doit pas être une révision',
    'Can be a revision or non-revision' => 'Peut être une révision ou non',
    'Element is being duplicated' => "L'élément est en cours de duplication",
    'Must be duplicating the element' => "L'élément doit être en cours de duplication",
    'Must not be duplicating the element' => "L'élément ne doit pas être en cours de duplication",
    'Element is being propagated' => "L'élément est en cours de propagation",
    'Element must be propagating' => "L'élément doit être en cours de propagation",
    'Element must not be propagating' => "L'élément ne doit pas être en cours de propagation",
    'Element is being bulk-resaved' => "L'élément est en cours de réenregistrement en masse",
    'Must be bulk-resaving the element' => "L'élément doit être en cours de réenregistrement en masse",
    'Must not be bulk-resaving the element' => "L'élément ne doit pas être en cours de réenregistrement en masse",

    // Event tab: date trigger
    'On' => 'Le',
    'days before' => 'jours avant',
    'days after' => 'jours après',
    'Relevant Date' => 'Date pertinente',
    'Send the notification relative to a chosen date.' => 'Envoyez la notification par rapport à une date choisie.',

    // Event tab: recurring schedule
    'Every' => 'Tous les',
    'on' => 'le',
    'on day' => 'le jour',
    'at' => 'à',
    'Starting on' => 'À partir du',
    'Day' => 'Jour',
    'Date' => 'Date',
    'Time' => 'Heure',
    'day(s)' => 'jour(s)',
    'week(s)' => 'semaine(s)',
    'month(s)' => 'mois',
    'year(s)' => 'an(s)',
    'day' => 'jour',
    'days' => 'jours',
    'week' => 'semaine',
    'weeks' => 'semaines',
    'month' => 'mois',
    'months' => 'mois',
    'year' => 'an',
    'years' => 'ans',
    'Manual only' => 'Manuel uniquement',
    'Scheduled sending' => 'Envoi planifié',
    'On a recurring schedule' => 'Selon une planification récurrente',
    'On demand' => 'À la demande',
    'Send on a Recurring Schedule' => 'Envoyer selon une planification récurrente',
    'Configure Recurring Schedule' => 'Configurer la planification récurrente',
    'System timezone set to {timezone}' => 'Fuseau horaire du système défini sur {timezone}',
    'Notifications will be sent on the following schedule...' => 'Les notifications seront envoyées selon la planification suivante...',
    '... and every {cadence} after that.' => '... puis tous les {cadence} ensuite.',
    'On what recurring schedule should the notification be sent?' => 'Selon quelle planification récurrente la notification doit-elle être envoyée ?',
    'Whether the message should be sent on a schedule, or only triggered manually.' => 'Si le message doit être envoyé selon une planification ou uniquement déclenché manuellement.',
    'The message can always be sent using the "Send system snapshot" button above.' => 'Le message peut toujours être envoyé via le bouton « Envoyer l\'instantané du système » ci-dessus.',
    'The message can always be sent using the "Send data report" button above.' => 'Le message peut toujours être envoyé via le bouton « Envoyer le rapport de données » ci-dessus.',

    // Event tab: Dynamic Data snippet field
    'Twig Snippet to Determine Data' => 'Extrait Twig pour déterminer les données',
    'Enter a custom Twig snippet to [determine which data will be included]({url}).' => 'Saisissez un extrait Twig personnalisé pour [déterminer quelles données seront incluses]({url}).',
    'The snippet **must** include a `{% setData %}` tag.' => 'L\'extrait **doit** inclure une balise `{% setData %}`.',
    'You do not have permission to edit dynamic data.' => 'Vous n\'avez pas la permission de modifier les données dynamiques.',

    // Event tab: manual trigger
    'Trigger Label' => 'Libellé du déclencheur',
    'An element action label (helps to differentiate multiple triggers).' => "Un libellé d'action d'élément (aide à différencier plusieurs déclencheurs).",
    'Send Notification' => 'Envoyer la notification',

    // Message tab: type selector & queue
    'Message Type' => 'Type de message',
    'What type of message will be sent?' => 'Quel type de message sera envoyé ?',
    'Send Message via Queue' => "Envoyer le message via la file d'attente",
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are also supported.' => '[Templating]({templatingUrl}) et [variables spéciales]({variablesUrl}) sont également pris en charge.',
    'Send immediately' => 'Envoyer immédiatement',
    'Add to queue' => "Ajouter à la file d'attente",
    'Whether the message should be sent via the [jobs queue]({queueUrl}).' => 'Si le message doit être envoyé via la [file d\'attente des tâches]({queueUrl}).',

    // Message tab: Email
    "User's Email Address Field" => "Champ d'adresse e-mail de l'utilisateur",
    'Select which User field contains the recipient\'s email address.' => 'Sélectionnez le champ utilisateur qui contient l\'adresse e-mail du destinataire.',
    'Email Subject' => "Objet de l'e-mail",
    'Subject line of the email.' => 'Ligne d\'objet de l\'e-mail.',
    'Dynamic Subject Line' => 'Ligne d\'objet dynamique',
    'Email Body' => "Corps de l'e-mail",
    'Body of the email. Supports HTML.' => 'Corps de l\'e-mail. Prend en charge HTML.',

    // Message tab: rich-text (Trix) toolbar
    'Rich Text' => 'Texte enrichi',
    'Bold' => 'Gras',
    'Italic' => 'Italique',
    'Underline' => 'Souligné',
    'Strikethrough' => 'Barré',
    'Bullets' => 'Puces',
    'Numbers' => 'Numérotation',
    'Heading' => 'Titre',
    'Code' => 'Code',
    'Undo' => 'Annuler',
    'Redo' => 'Rétablir',

    // Message tab: SMS
    "User's Phone Number Field" => "Champ de numéro de téléphone de l'utilisateur",
    'Select which User field contains the recipient\'s phone number.' => 'Sélectionnez le champ utilisateur qui contient le numéro de téléphone du destinataire.',
    'SMS Message Body' => 'Corps du message SMS',
    'Body of the SMS (text message). Plain text only.' => 'Corps du SMS (message texte). Texte brut uniquement.',

    // Message tab: Announcement
    'Announcement Title' => "Titre de l'annonce",
    'Heading of the announcement.' => 'Titre de l\'annonce.',
    'Dynamic Announcement Title' => 'Titre d\'annonce dynamique',
    'Announcement Message' => "Message de l'annonce",
    'Body of the announcement. Supports Markdown.' => 'Corps de l\'annonce. Prend en charge Markdown.',

    // Message tab: Flash
    'Flash Message Type' => 'Type de message flash',
    'Which type of flash message should appear?' => 'Quel type de message flash doit apparaître ?',
    'Flash Message Title' => 'Titre du message flash',
    'Heading of the flash message.' => 'Titre du message flash.',
    'Dynamic Flash Message Title' => 'Titre de message Flash dynamique',
    'Flash Message Details' => 'Détails du message flash',
    'Optionally include details below the heading. Supports Markdown and HTML.' => 'Inclure éventuellement des détails sous le titre. Prend en charge Markdown et HTML.',

    // Message tab: Pushover
    "Field containing each user's Pushover key" => "Champ de clé Pushover de l'utilisateur",
    'Select which User field contains the recipient\'s Pushover user key.' => 'Sélectionnez le champ utilisateur qui contient la clé Pushover du destinataire.',
    'Pushover Title' => 'Titre Pushover',
    'Optionally include a heading above the body.' => 'Inclure éventuellement un titre au-dessus du corps.',
    'Dynamic Pushover Title' => 'Titre Pushover dynamique',
    'Pushover Body' => 'Corps Pushover',
    'Body of the Pushover notification. Plain text only.' => 'Corps de la notification Pushover. Texte brut uniquement.',

    // Message tab: ntfy
    'Priority' => 'Priorité',
    'Priority level of the ntfy message.' => 'Niveau de priorité du message ntfy.',
    'Tags' => 'Étiquettes',
    'Optionally include comma-separated [emoji shortcodes](https://docs.ntfy.sh/emojis/).' => 'Inclure éventuellement des [codes d\'emoji](https://docs.ntfy.sh/emojis/) séparés par des virgules.',
    'ntfy Title' => 'Titre ntfy',
    'Dynamic ntfy Title' => 'Titre ntfy dynamique',
    'ntfy Body' => 'Corps ntfy',
    'Body of the ntfy notification.' => 'Corps de la notification ntfy.',
    'ntfy Link URL' => 'URL du lien ntfy',
    'Optionally open a URL when the notification is clicked.' => 'Ouvrir éventuellement une URL lorsque la notification est cliquée.',
    'Enable Markdown' => 'Activer le Markdown',
    'Whether to parse the body as Markdown in supported clients.' => 'Si le corps doit être interprété comme du Markdown dans les clients compatibles.',
    'Regular text only' => 'Texte normal uniquement',
    'Markdown enabled' => 'Markdown activé',

    // Message tab: Slack
    'Slack Message Body' => 'Corps du message Slack',
    'Supports standard [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) syntax. Optionally supports HTML _(see below)_.' => 'Prend en charge la syntaxe [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) standard. Prend en charge HTML en option _(voir ci-dessous)_.',
    'Render Message Body as HTML' => 'Rendre le corps du message en HTML',
    'Whether to only parse as [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), or additionally parse it as HTML.' => 'Analyser uniquement comme [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), ou aussi comme HTML.',
    'mrkdwn only' => 'mrkdwn uniquement',
    'mrkdwn + HTML' => 'mrkdwn + HTML',
    'Render Link Previews' => 'Afficher les aperçus de liens',
    'Whether Slack should unfurl link previews for URLs in the message body.' => 'Si Slack doit afficher les aperçus des liens pour les URL dans le corps du message.',
    'Don\'t unfurl' => 'Ne pas développer',
    'Expand link previews' => 'Développer les aperçus',
    'Bot Name' => "Nom d'utilisateur",
    'Optionally override the app\'s display name.' => 'Remplacer éventuellement le nom d\'affichage de l\'application.',
    'Dynamic Bot Name' => 'Nom de bot dynamique',
    'Bot Icon URL' => "URL de l'icône",
    'Optionally override the app\'s icon with a URL.' => 'Remplacer éventuellement l\'icône de l\'application par une URL.',
    'Bot Emoji' => "Emoji de l'icône",
    'Optionally override the app\'s icon with an emoji. Used only when Bot Icon URL is empty.' => 'Remplacer éventuellement l\'icône de l\'application par un emoji. Utilisé uniquement lorsque Bot Icon URL est vide.',

    // Message tab: Bluesky
    'Post Body' => 'Corps de la publication',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => 'Texte brut, 300 caractères maximum. Les URL et les mentions `@handle.tld` deviennent automatiquement des liens.',
    'Generate Link Preview' => 'Générer un aperçu du lien',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => 'Générer automatiquement une carte d\'aperçu lorsque le corps du post contient une URL.',
    'No card' => 'Aucune carte',
    'Generate preview card' => "Générer une carte d'aperçu",

    // Recipients tab: type selector & user/group pickers
    'Recipients Type' => 'Type de destinataires',
    'Who will receive this message?' => 'Qui recevra ce message ?',
    'Add a message recipient' => 'Ajouter un destinataire',
    'Select User(s)' => 'Sélectionner un ou plusieurs utilisateurs',
    'Which users will receive the message?' => 'Quels utilisateurs recevront le message ?',
    'Which user groups will receive the message?' => "Quels groupes d'utilisateurs recevront le message ?",

    // Recipients tab: channel pickers (Slack / ntfy / Bluesky)
    'Select Slack channel(s)' => 'Sélectionner le ou les canaux Slack',
    'Which Slack channels should receive this message?' => 'Quels canaux Slack doivent recevoir ce message ?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Aucun canal Slack configuré. Ajoutez-en un dans [Paramètres → Slack]({url}).',
    'Select ntfy topic(s)' => 'Sélectionner le ou les sujets ntfy',
    'Which ntfy topics should receive this message?' => 'Quels sujets ntfy doivent recevoir ce message ?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'Aucun sujet ntfy configuré. Ajoutez-en un dans [Paramètres → ntfy]({url}).',
    'Select Bluesky account(s)' => 'Sélectionner le ou les comptes Bluesky',
    'Which Bluesky accounts should post this message?' => 'Quels comptes Bluesky doivent publier ce message ?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Aucun compte Bluesky configuré. Ajoutez-en un dans [Paramètres → Bluesky]({url}).',

    // Recipients tab: dynamic recipients snippet
    'Twig Snippet to Determine Recipients' => 'Extrait Twig pour déterminer les destinataires',
    'Enter a custom Twig snippet to [determine who will receive the message]({url}).' => 'Saisissez un extrait Twig personnalisé pour [déterminer qui recevra le message]({url}).',
    'The snippet **must** include a `{% setRecipients %}` tag.' => 'L\'extrait **doit** inclure une balise `{% setRecipients %}`.',

    // ============================================================
    // SETTINGS
    // ============================================================

    // Settings: nav & page chrome
    'Notifier Settings' => 'Paramètres Notifier',
    'General' => 'Général',
    'Twilio' => 'Twilio',
    'Pushover' => 'Pushover',
    'Slack' => 'Slack',
    'Bluesky' => 'Bluesky',
    'ntfy' => 'ntfy',

    // Settings: Logging
    'Logging' => 'Journalisation',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => "Notifier tient un journal continu des messages envoyés. Ce n'est généralement pas nécessaire, mais vous pouvez limiter le nombre d'événements de journal enregistrés en base de données.",
    'Enable Logging' => 'Activer la journalisation',
    'When disabled, Notifier will not write anything to the notification log.' => "Lorsque désactivé, Notifier n'écrit rien dans le journal des notifications.",
    'Number of days to retain log events' => 'Nombre de jours de conservation des événements de journal',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Conserver les événements de journal au plus ce nombre de jours. Laisser vide pour aucune limite.',
    'Number of log events to retain' => "Nombre d'événements de journal à conserver",
    'At most, keep this many log events. Leave blank for no limit.' => "Conserver au plus ce nombre d'événements de journal. Laisser vide pour aucune limite.",

    // Settings: Scheduled sending
    'Scheduled Sending' => 'Envoi programmé',
    'Shared secret for authenticating scheduled-run web requests. Required only when the schedule is triggered via the web endpoint.' => "Secret partagé pour authentifier les requêtes web de l'exécution programmée. Requis uniquement si la planification est déclenchée via le point de terminaison web.",
    'Scheduled-Run Token' => "Jeton d'exécution programmée",
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => "Envoyé avec chaque requête sous forme d'en-tête X-Notifier-Token ou de paramètre token dans le corps.",

    // Settings: Twilio
    'Twilio API Credentials' => 'Identifiants API Twilio',
    'If using the Twilio API to send SMS messages, the following credentials are required.' => "Si vous utilisez l'API Twilio pour envoyer des SMS, les identifiants suivants sont requis.",
    'Twilio Account SID' => 'Twilio Account SID',
    'Twilio Auth Token' => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)' => 'Numéro de téléphone Twilio (envoie chaque SMS)',
    'SMS Testing' => 'Tests SMS',
    'Optional. When set, every SMS dispatched will be sent to this number instead of the resolved recipient.' => "Facultatif. Lorsqu'il est défini, chaque SMS envoyé sera adressé à ce numéro au lieu du destinataire résolu.",
    'Test phone number' => 'Numéro de téléphone de test',

    // Settings: Pushover
    "[Pushover](https://pushover.net) sends push notifications to a registered user's devices. Each Craft user needs a custom field on their profile storing their Pushover user key; you select which field on each Notification's Message tab. For full setup instructions, see the [Pushover getting-started docs](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover)." => "[Pushover](https://pushover.net) envoie des notifications push vers les appareils d'un utilisateur enregistré. Chaque utilisateur Craft a besoin d'un champ personnalisé sur son profil pour stocker sa clé Pushover ; vous choisissez le champ dans l'onglet Message de chaque notification. Pour les instructions complètes, consultez la [documentation de prise en main Pushover](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover).",
    'Application API Token' => "Jeton d'API de l'application",
    'The 30-character app token from your Pushover application.' => "Le jeton d'application à 30 caractères de votre application Pushover.",

    // Settings: ntfy
    'ntfy.sh is a free HTTP-based push notification service. Subscribers receive messages on the ntfy app, web, or any compatible client by joining a topic.' => "ntfy.sh est un service gratuit de notifications push basé sur HTTP. Les abonnés reçoivent les messages dans l'application ntfy, sur le web ou via tout client compatible en rejoignant un sujet.",
    'Server URL' => 'URL du serveur',
    "Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`." => 'Facultatif, pointez vers une instance ntfy auto-hébergée (le cas échéant). Par défaut `https://ntfy.sh`.',
    'Access token' => "Jeton d'accès",
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Facultatif, requis pour les sujets protégés ou les instances auto-hébergées avec authentification.',
    'ntfy Topics' => 'Sujets ntfy',
    "Add the ntfy topics you'd like to send messages to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification." => "Ajoutez les sujets ntfy auxquels vous souhaitez envoyer des messages. Chaque sujet devient disponible comme destinataire dans l'onglet **Destinataires** lors de la configuration d'une notification.",
    'Topics' => 'Sujets',
    "Click any row's **Test** button to send a quick test message to that topic." => "Cliquez sur le bouton **Tester** de n'importe quelle ligne pour envoyer un message de test rapide à ce sujet.",
    'Label' => 'Étiquette',
    'Topic' => 'Sujet',
    'Add a topic' => 'Ajouter un sujet',

    // Settings: Slack
    'Slack Channels' => 'Canaux Slack',
    'Create a [Slack app](https://api.slack.com/apps) with the `chat:write`, `chat:write.customize`, and `chat:write.public` scopes, then add a row for each channel you\'d like to post into. Each channel becomes available as a recipient on the **Recipients** tab when configuring a notification. A bot token is a secret, so store it in a `.env` variable and reference that variable (e.g. `$SLACK_BOT_TOKEN`) rather than pasting the token directly.' => 'Créez une [application Slack](https://api.slack.com/apps) avec les scopes `chat:write`, `chat:write.customize` et `chat:write.public`, puis ajoutez une ligne pour chaque canal dans lequel vous souhaitez publier. Chaque canal devient disponible comme destinataire dans l\'onglet **Destinataires** lors de la configuration d\'une notification. Un jeton de bot est un secret, alors stockez-le dans une variable `.env` et faites référence à cette variable (par exemple `$SLACK_BOT_TOKEN`) plutôt que de coller le jeton directement.',
    'Channels' => 'Canaux',
    "Click any row's **Test** button to send a quick test message to that channel." => "Cliquez sur le bouton **Tester** de n'importe quelle ligne pour envoyer un message de test rapide à ce canal.",
    'Bot Token' => 'Jeton du bot',
    'Channel ID' => 'ID du canal',
    'Add a channel' => 'Ajouter un canal',
    'Not a valid Bot Token. Must start with `xoxb-`.' => 'Jeton du bot non valide. Doit commencer par `xoxb-`.',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => 'ID de canal non valide. Doit ressembler à `C01234ABCD`.',

    // Settings: Bluesky
    "[Bluesky](https://bsky.app) posts publish to the configured account's feed via the ATProto API. App passwords are generated at [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). An app password is a secret, so store it in a `.env` variable and reference that variable (e.g. `\$BLUESKY_APP_PASSWORD`) rather than pasting the password directly." => "Les publications [Bluesky](https://bsky.app) sont publiées sur le fil du compte configuré via l'API ATProto. Les mots de passe d'application sont générés sur [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). Un mot de passe d'application est un secret ; stockez-le donc dans une variable `.env` et référencez cette variable (par ex. `\$BLUESKY_APP_PASSWORD`) au lieu de coller le mot de passe directement.",
    'PDS URL' => 'URL du PDS',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'Par défaut https://bsky.social. Pointez vers un PDS personnalisé si votre installation est fédérée.',
    'Bluesky Accounts' => 'Comptes Bluesky',
    "Add the Bluesky accounts you'd like to post from. Each account becomes available as a recipient on the **Recipients** tab when configuring a notification." => "Ajoutez les comptes Bluesky depuis lesquels vous souhaitez publier. Chaque compte devient disponible comme destinataire dans l'onglet **Destinataires** lors de la configuration d'une notification.",
    'Accounts' => 'Comptes',
    "Click any row's **Test** button to confirm the account authenticates." => "Cliquez sur le bouton **Tester** de n'importe quelle ligne pour confirmer que le compte s'authentifie.",
    'Handle' => 'Identifiant',
    'App password' => "Mot de passe d'application",
    'Add an account' => 'Ajouter un compte',

    // ============================================================
    // MANUAL SEND & TEST
    // ============================================================

    // Manual send & test
    'Send a test message' => 'Envoyer un message de test',
    'Send a REAL test notification?\\n\\n⚠️ Uses a random sample of real data.\\n⚠️ Sends a real message via the configured channel.\\n⚠️ Delivers to the real configured recipient(s).' => 'Envoyer une VRAIE notification de test ?\\n\\n⚠️ Utilise un échantillon aléatoire de données réelles.\\n⚠️ Envoie un message réel via le canal configuré.\\n⚠️ Livré aux véritables destinataires configurés.',
    'Test' => 'Tester',
    'Send system snapshot' => 'Envoyer l\'instantané du système',
    'Send data report' => 'Envoyer le rapport de données',
    'Are you sure you want to send this notification?' => 'Êtes-vous sûr de vouloir envoyer cette notification ?',
    'This notification cannot be triggered manually.' => 'Cette notification ne peut pas être déclenchée manuellement.',
    'This notification no longer applies to the selected element.' => "Cette notification ne s'applique plus à l'élément sélectionné.",

    // ============================================================
    // RUNTIME OUTPUT
    // ============================================================

    // Runtime: dispatch log feedback
    'Sending {messageType} to {recipient}.' => 'Envoi de {messageType} à {recipient}.',
    'Adding message to queue.' => "Ajout du message à la file d'attente.",
    'Sending message immediately (bypassing queue).' => "Envoi du message immédiatement (la file d'attente est contournée).",
    'Unable to parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => "Impossible d'analyser le flux. Les extensions PHP `simplexml` et `libxml` sont requises.",
    'Unable to parse the feed.' => "Impossible d'analyser le flux.",
    'Unable to fetch the feed: {message}' => 'Impossible de récupérer le flux : {message}',
    'Initial feed scan failed: {message}' => "L'analyse initiale du flux a échoué : {message}",

    // Runtime: controller responses
    'Test notification dispatched.' => 'Notification de test envoyée.',
    'No messages were dispatched. Check the recipient configuration.' => "Aucun message n'a été envoyé. Vérifiez la configuration des destinataires.",
    'Unable to send test: the feed could not be read or has no items.' => "Impossible d'envoyer le test : le flux n'a pas pu être lu ou ne contient aucun élément.",
    'Unable to send test: no element matches the configured filters.' => "Impossible d'envoyer le test : aucun élément ne correspond aux filtres configurés.",
    "Couldn't save settings." => "Impossible d'enregistrer les paramètres.",
    'Settings saved.' => 'Paramètres enregistrés.',
    'Topic is empty.' => 'Le sujet est vide.',
    'Server URL is not configured.' => "L'URL du serveur n'est pas configurée.",
    'Test message from Notifier.' => 'Message de test de Notifier.',
    'HTTP {status}' => 'HTTP {status}',
    'Test message sent successfully.' => 'Message de test envoyé avec succès.',
    'Handle and app password are required.' => "L'identifiant et le mot de passe d'application sont requis.",
    'Authentication failed.' => 'Authentification échouée.',
    'Successfully authenticated. No messages were posted.' => 'Authentification réussie. Aucun message n\'a été publié.',
    'Log events deleted.' => 'Événements de journal supprimés.',
    'Notification sent.' => 'Notification envoyée.',
    'Notification was not sent. Check the Notification Log for details.' => 'La notification n\'a pas été envoyée. Consultez le Journal des notifications pour plus de détails.',

    // Outbound: per-channel send results
    'Unable to send email, no recipient specified.' => "Impossible d'envoyer l'e-mail : aucun destinataire spécifié.",
    'Unable to send email, the message body was empty.' => "Impossible d'envoyer l'e-mail : le corps du message était vide.",
    "Unable to send the email using Craft's native email handling." => "Impossible d'envoyer l'e-mail via la gestion d'e-mails native de Craft.",
    'Check your general email settings within Craft.' => "Vérifiez vos paramètres généraux d'e-mail dans Craft.",
    'Successfully sent email message!' => 'E-mail envoyé avec succès !',
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[Identifiants Twilio invalides.]({url}) Manque {missing}.',
    'Unable to send SMS, no Twilio phone number exists.' => "Impossible d'envoyer le SMS, aucun numéro de téléphone Twilio.",
    'Unable to send SMS, no recipient phone number exists.' => "Impossible d'envoyer le SMS, aucun numéro de téléphone du destinataire.",
    'Unable to send SMS, recipient phone number is invalid.' => "Impossible d'envoyer le SMS, le numéro du destinataire est invalide.",
    'Successfully sent SMS message!' => 'SMS envoyé avec succès !',
    'Unable to post announcement, no recipient userId specified.' => "Impossible de publier l'annonce : aucun userId de destinataire spécifié.",
    'Successfully posted announcement!' => 'Annonce publiée avec succès !',
    'Unable to send the flash message, invalid flash type.' => "Impossible d'envoyer le message flash : type de flash invalide.",
    'Successfully sent flash message!' => 'Message flash envoyé avec succès !',
    '[Invalid Pushover credentials.]({url}) Missing app token.' => "[Identifiants Pushover invalides.]({url}) Jeton d'application manquant.",
    'Unable to send Pushover message, no user key on recipient.' => "Impossible d'envoyer le message Pushover : aucune clé utilisateur sur le destinataire.",
    'Pushover POST failed: {reason}' => 'Échec du POST Pushover : {reason}',
    'Successfully sent Pushover message!' => 'Message Pushover envoyé avec succès !',
    'Unable to send ntfy message, no topic specified.' => "Impossible d'envoyer le message ntfy : aucun sujet spécifié.",
    'ntfy POST failed with HTTP {status}: {reason}' => 'Échec du POST ntfy avec HTTP {status} : {reason}',
    'ntfy POST failed: {reason}' => 'Échec du POST ntfy : {reason}',
    'Successfully sent ntfy message to topic "{topic}".' => 'Message ntfy envoyé avec succès au sujet « {topic} ».',
    'Unable to send Slack message, no bot token.' => "Impossible d'envoyer le message Slack : pas de jeton de bot.",
    'Unable to send Slack message, no channel ID.' => "Impossible d'envoyer le message Slack : pas d'ID de canal.",
    'Unable to send Slack message, body is empty.' => "Impossible d'envoyer le message Slack : le corps est vide.",
    'Slack rejected the message: {error}' => 'Slack a rejeté le message : {error}',
    'Slack POST failed: {reason}' => 'Échec du POST Slack : {reason}',
    'Successfully sent Slack message to "{label}".' => 'Message Slack envoyé avec succès à « {label} ».',
    'Unable to send Bluesky post, recipient is missing credentials.' => "Impossible d'envoyer la publication Bluesky : les identifiants du destinataire sont manquants.",
    'Body exceeded {max} characters, truncated.' => 'Le corps dépasse {max} caractères ; il a été tronqué.',
    'Successfully posted to Bluesky as "{label}".' => 'Publié avec succès sur Bluesky en tant que « {label} ».',
    'Bluesky auth failed for {handle}: {reason}' => "Échec de l'authentification Bluesky pour {handle} : {reason}",
    'Bluesky auth failed: {reason}' => "Échec de l'authentification Bluesky : {reason}",
    'Bluesky post failed: {reason}' => 'Échec de la publication Bluesky : {reason}',
    'Bluesky link preview skipped: {reason}' => 'Aperçu du lien Bluesky ignoré : {reason}',

    // Recipient warnings
    'Recipient "{name}" has no email address.' => "Le destinataire « {name} » n'a pas d'adresse e-mail.",
    'Recipient "{name}" has no phone number.' => "Le destinataire « {name} » n'a pas de numéro de téléphone.",
    'Recipient "{name}" has no associated User; cannot send announcement.' => "Le destinataire « {name} » n'a pas d'utilisateur associé ; impossible d'envoyer l'annonce.",
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => "Le destinataire « {name} » ne peut pas accéder au panneau d'administration ; impossible d'envoyer l'annonce.",
    'Pushover user-key field is not configured on this notification.' => "Le champ de clé utilisateur Pushover n'est pas configuré pour cette notification.",
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => "Le destinataire « {name} » n'a pas d'utilisateur associé ; impossible d'envoyer le message Pushover.",
    '[SKIPPED] User "{name}" has no Pushover key.' => "[IGNORÉ] L'utilisateur « {name} » n'a pas de clé Pushover.",
    'Recipient "{name}" has no ntfy topic.' => "Le destinataire « {name} » n'a pas de sujet ntfy.",
    'Recipient "{name}" has no Bluesky credentials.' => "Le destinataire « {name} » n'a pas d'identifiants Bluesky.",
    'Recipient "{name}" has no Slack bot token.' => "Le destinataire \"{name}\" n'a pas de jeton de bot Slack.",
    'Recipient "{name}" has no Slack channel ID.' => "Le destinataire \"{name}\" n'a pas d'ID de canal Slack.",

    // Errors & exceptions
    'Invalid element event: {class}' => "Événement d'élément invalide : {class}",
    'Invalid notification ID: {id}' => 'ID de notification invalide : {id}',
    'Invalid email message mode.' => 'Mode de message e-mail invalide.',
    'You do not have permission to use the Dynamic Recipients type.' => "Vous n'avez pas l'autorisation d'utiliser le type Destinataires dynamiques.",
    'Dynamic recipients snippet did not call setRecipients.' => "L'extrait Destinataires dynamiques n'a pas appelé setRecipients.",
    'setRecipients was called with an empty value.' => 'setRecipients a été appelée avec une valeur vide.',
    'Unrecognized recipient of type "{type}".' => 'Destinataire de type « {type} » non reconnu.',
    'Unrecognized recipient "{value}".' => 'Destinataire « {value} » non reconnu.',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => "L'élément {kind} configuré n'existe plus dans les paramètres du plugin (uid : {uid}).",
    'Invalid settings section: {section}' => 'Section de paramètres invalide : {section}',
    'User not authorized to save this notification.' => "L'utilisateur n'est pas autorisé à enregistrer cette notification.",
    'User not authorized to view this notification.' => "L'utilisateur n'est pas autorisé à consulter cette notification.",
    'User not authorized to delete this notification.' => "L'utilisateur n'est pas autorisé à supprimer cette notification.",
    'Notification not found' => 'Notification introuvable',
    'Element not found' => 'Élément introuvable',
    'You do not have permission to use the Dynamic Data type.' => "Vous n'avez pas la permission d'utiliser le type Données dynamiques.",
    'The Dynamic Data snippet did not call the {tag} tag.' => "L'extrait Twig n'a pas appelé la balise {tag}.",
    'Invalid Slack body format.' => 'Format de corps Slack non valide.',

    // Config-file override note
    'This is being set in the config file. [{file}]' => 'Ceci est défini dans le fichier de configuration. [{file}]',

    // ============================================================
    // JAVASCRIPT UI
    // ============================================================

    // JavaScript: log utility & buttons
    'Test notification failed.' => 'Échec de la notification de test.',
    'Unable to get the notification, something went wrong.' => 'Impossible de récupérer la notification, une erreur s\'est produite.',
    'Something went wrong.' => 'Une erreur s\'est produite.',
    'Invalid notification ID.' => 'ID de notification invalide.',
    'Unable to delete the log event, something went wrong.' => 'Impossible de supprimer l\'événement de journal, une erreur s\'est produite.',
    'Log event deleted.' => 'Événement de journal supprimé.',
    'Unable to delete log events, something went wrong.' => 'Impossible de supprimer les événements de journal, une erreur s\'est produite.',
    'Are you sure you want to delete this log event?' => 'Voulez-vous vraiment supprimer cet événement de journal ?',
    'Are you sure you want to delete all logs from {date}?' => 'Voulez-vous vraiment supprimer tous les journaux du {date} ?',

    // ============================================================
    // MQTT
    // ============================================================

    'Recipient "{name}" has no MQTT topic.' => 'Le destinataire "{name}" n\'a aucun sujet MQTT.',
    'Unable to send MQTT message, no broker host configured.' => 'Impossible d\'envoyer le message MQTT, aucun hôte de broker n\'est configuré.',
    'Unable to send MQTT message, no topic specified.' => 'Impossible d\'envoyer le message MQTT, aucun sujet spécifié.',
    'Unable to send MQTT message, the payload is empty.' => 'Impossible d\'envoyer le message MQTT, le contenu est vide.',
    'MQTT publish failed: {reason}' => 'Échec de la publication MQTT : {reason}',
    'Successfully sent MQTT message to topic "{topic}".' => 'Message MQTT envoyé avec succès au sujet "{topic}".',
    'MQTT Broker' => 'Broker MQTT',
    'Notifier publishes to an MQTT broker (such as Mosquitto, EMQX, HiveMQ, or AWS IoT Core). Enter the broker connection details below. Sensitive values can be stored in a `.env` variable and referenced here (e.g. `$MQTT_PASSWORD`).' => 'Notifier publie sur un broker MQTT (tel que Mosquitto, EMQX, HiveMQ ou AWS IoT Core). Saisissez les informations de connexion du broker ci-dessous. Les valeurs sensibles peuvent être stockées dans une variable `.env` et référencées ici (par exemple `$MQTT_PASSWORD`).',
    'Host' => 'Hôte',
    'Broker hostname, without a protocol or port.' => 'Nom d\'hôte du broker, sans protocole ni port.',
    'Port' => 'Port',
    'Optional. Defaults to 8883 when TLS is enabled, otherwise 1883.' => 'Facultatif. Par défaut 8883 lorsque TLS est activé, sinon 1883.',
    'Use TLS' => 'Utiliser TLS',
    'Whether to connect to the broker over a secure TLS socket.' => 'Indique s\'il faut se connecter au broker via un socket TLS sécurisé.',
    'Username' => 'Nom d\'utilisateur',
    'Optional, for brokers that require username/password authentication.' => 'Facultatif, pour les brokers qui nécessitent une authentification par nom d\'utilisateur/mot de passe.',
    'Password' => 'Mot de passe',
    'MQTT Version' => 'Version MQTT',
    'Protocol version sent to the broker.' => 'Version du protocole envoyée au broker.',
    'Client ID' => 'ID client',
    'Optional. A unique client ID is generated automatically when left blank.' => 'Facultatif. Un ID client unique est généré automatiquement lorsque le champ est laissé vide.',
    'Mutual TLS' => 'TLS mutuel',
    'Optional. Required for brokers that authenticate clients with certificates, such as AWS IoT Core. Provide server file paths to the certificate files (a `.env` variable or `@alias` reference is allowed).' => 'Facultatif. Requis pour les brokers qui authentifient les clients par certificats, comme AWS IoT Core. Indiquez les chemins de fichiers serveur vers les fichiers de certificat (une variable `.env` ou une référence `@alias` est autorisée).',
    'CA Certificate File' => 'Fichier de certificat CA',
    'Path to the certificate authority (CA) file.' => 'Chemin vers le fichier de l\'autorité de certification (CA).',
    'Client Certificate File' => 'Fichier de certificat client',
    'Path to the client certificate file.' => 'Chemin vers le fichier de certificat client.',
    'Client Key File' => 'Fichier de clé client',
    'Path to the client private key file.' => 'Chemin vers le fichier de clé privée du client.',
    'MQTT Topics' => 'Sujets MQTT',
    'Add the MQTT topics you\'d like to publish to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification.' => 'Ajoutez les sujets MQTT sur lesquels vous souhaitez publier. Chaque sujet devient disponible comme destinataire dans l\'onglet **Destinataires** lors de la configuration d\'une notification.',
    'Click any row\'s **Test** button to publish a quick test message to that topic.' => 'Cliquez sur le bouton **Tester** de n\'importe quelle ligne pour publier un message de test rapide sur ce sujet.',
    'MQTT' => 'MQTT',
    'Payload' => 'Contenu',
    'The message published to the topic. Can be plain text or a Twig-rendered JSON object.' => 'Le message publié sur le sujet. Peut être du texte brut ou un objet JSON rendu via Twig.',
    'Quality of Service' => 'Qualité de service',
    'Delivery guarantee for this message.' => 'Garantie de livraison pour ce message.',
    'Retain' => 'Conserver',
    'Whether the broker keeps this as the topic\'s last message for future subscribers.' => 'Indique si le broker conserve ce message comme dernier message du sujet et le livre aux futurs abonnés.',
    'Don\'t retain' => 'Ne pas conserver',
    'Select MQTT topic(s)' => 'Sélectionner le(s) sujet(s) MQTT',
    'Which topics should receive this message?' => 'Quels sujets doivent recevoir ce message ?',
    'No MQTT topics configured. Add one in [Settings → MQTT]({url}).' => 'Aucun sujet MQTT configuré. Ajoutez-en un dans [Réglages → MQTT]({url}).',
    'Not a valid topic. Must not be empty or contain the `+` or `#` wildcards.' => 'Sujet non valide. Il ne doit pas être vide ni contenir les caractères génériques `+` ou `#`.',
    'Broker host is not configured.' => 'L\'hôte du broker n\'est pas configuré.',

    // ============================================================
    // Recipient empty-state (administrative changes disabled)
    // ============================================================

    'No ntfy topics configured. Topics can only be added in an environment that allows administrative changes.' => 'Aucun sujet ntfy configuré. Les sujets ne peuvent être ajoutés que dans un environnement qui autorise les modifications administratives.',
    'No Slack channels configured. Channels can only be added in an environment that allows administrative changes.' => 'Aucun canal Slack configuré. Les canaux ne peuvent être ajoutés que dans un environnement qui autorise les modifications administratives.',
    'No Bluesky accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Aucun compte Bluesky configuré. Les comptes ne peuvent être ajoutés que dans un environnement qui autorise les modifications administratives.',
    'No MQTT topics configured. Topics can only be added in an environment that allows administrative changes.' => 'Aucun sujet MQTT configuré. Les sujets ne peuvent être ajoutés que dans un environnement qui autorise les modifications administratives.',
];
