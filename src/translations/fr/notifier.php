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
    'Notifications'          => 'Notifications',
    'Notification'           => 'Notification',
    'All notifications'      => 'Toutes les notifications',
    'Notification Log'       => 'Journal des notifications',
    'Logs'                   => 'Journaux',
    'View Notifications'     => 'Voir les notifications',
    'Add a New Notification' => 'Ajouter une nouvelle notification',

    // Permissions
    'View notifications'              => 'Voir les notifications',
    'Save notifications'              => 'Enregistrer les notifications',
    'Use the Dynamic Recipients type' => 'Utiliser le type Destinataires dynamiques',
    'Test notifications'              => 'Tester les notifications',
    'Delete notifications'            => 'Supprimer les notifications',
    'View notification log'           => 'Voir le journal des notifications',
    'Delete notification log'         => 'Supprimer le journal des notifications',

    // Notification editor: tabs
    'Meta'       => 'Méta',
    'Event'      => 'Événement',
    'Message'    => 'Message',
    'Recipients' => 'Destinataires',

    // Event tab: type selector
    'Event Type'                                           => "Type d'événement",
    'What type of event will activate the notification?'   => "Quel type d'événement déclenchera la notification ?",
    'Which specific event will activate the notification?' => 'Quel événement précis déclenchera la notification ?',

    // Event tab: event types
    'Assets Event'                   => "Événement d'Asset",
    'Commerce Orders Event'          => 'Événement de commande Commerce',
    'Commerce Products Event'        => 'Événement de produit Commerce',
    'Digital Products Event'         => 'Événement Digital Products',
    'Digital Product Licenses Event' => 'Événement de licence Digital Products',
    'Solspace Calendar Event'        => 'Événement Solspace Calendar',
    'Entries Event'                  => "Événement d'entrées",
    'Users Event'                    => 'Événement utilisateur',
    'Ungrouped Users'                => 'Utilisateurs sans groupe',

    // Feed
    'Feed URL' => 'URL du flux',
    'The URL of the RSS, Atom, or JSON feed to watch.' => "L'URL du flux RSS, Atom ou JSON à surveiller.",
    // Field and element conditions
    'Field Conditions'             => 'Conditions de champ',
    'Send the message only when the saved element matches the following conditions.' => "Envoyer le message uniquement lorsque l'élément enregistré correspond aux conditions suivantes.",
    'has changed'                  => 'a changé',
    '#{elementType} Event Filters' => "Filtres d'événements pour #{elementType}",
    'No filters match this event.' => 'Aucun filtre ne correspond à cet événement.',
    'Determine whether each message should be sent based on specified conditions.' => 'Déterminez selon les conditions spécifiées si chaque message doit être envoyé.',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => "L'élément est enregistré pour la première fois",
    'Must be a new entry'                       => 'Doit être une nouvelle entrée',
    'Must be an existing entry'                 => 'Doit être une entrée existante',
    'Can be existing or new'                    => 'Peut être existant ou nouveau',

    // Filters: new elements
    'Element is new'         => "L'élément est nouveau",
    'New elements only'      => 'Nouveaux éléments uniquement',
    'Existing elements only' => 'Éléments existants uniquement',

    // Filters: enabled state
    'Element is enabled'         => "L'élément est activé",
    'Must be enabled'            => 'Doit être activé',
    'Must be disabled'           => 'Doit être désactivé',
    'Can be enabled or disabled' => 'Peut être activé ou désactivé',

    // Filters: drafts
    'Element is a draft'          => "L'élément est un brouillon",
    'Must be a draft'             => 'Doit être un brouillon',
    'Must not be a draft'         => 'Ne doit pas être un brouillon',
    'Can be a draft or non-draft' => 'Peut être un brouillon ou non',

    // Filters: provisional drafts
    'Element is a provisional draft'                => "L'élément est un brouillon provisoire",
    'Must be a provisional draft'                   => 'Doit être un brouillon provisoire',
    'Must not be a provisional draft'               => 'Ne doit pas être un brouillon provisoire',
    'Can be a provisional draft or non-provisional' => 'Peut être un brouillon provisoire ou non',

    // Filters: revisions
    'Element is a revision'             => "L'élément est une révision",
    'Must be a revision'                => 'Doit être une révision',
    'Must not be a revision'            => 'Ne doit pas être une révision',
    'Can be a revision or non-revision' => 'Peut être une révision ou non',

    // Filters: duplication
    'Element is being duplicated'         => "L'élément est en cours de duplication",
    'Must be duplicating the element'     => "L'élément doit être en cours de duplication",
    'Must not be duplicating the element' => "L'élément ne doit pas être en cours de duplication",

    // Filters: propagation
    'Element is being propagated'     => "L'élément est en cours de propagation",
    'Element must be propagating'     => "L'élément doit être en cours de propagation",
    'Element must not be propagating' => "L'élément ne doit pas être en cours de propagation",

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => "L'élément est en cours de réenregistrement en masse",
    'Must be bulk-resaving the element'     => "L'élément doit être en cours de réenregistrement en masse",
    'Must not be bulk-resaving the element' => "L'élément ne doit pas être en cours de réenregistrement en masse",

    // Filters: common output
    'Unnamed filter'                => 'Filtre sans nom',
    'Must be TRUE to send message'  => 'Doit être TRUE pour envoyer le message',
    'Must be FALSE to send message' => 'Doit être FALSE pour envoyer le message',
    'No effect'                     => 'Aucun effet',

    // Message tab: type selector and queue
    'Message Type'                       => 'Type de message',
    'What type of message will be sent?' => 'Quel type de message sera envoyé ?',
    'Send Message via Queue'             => "Envoyer le message via la file d'attente",
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are also supported.' => '[Templating]({templatingUrl}) et [variables spéciales]({variablesUrl}) sont également pris en charge.',
    'Send immediately' => 'Envoyer immédiatement',
    'Add to queue' => "Ajouter à la file d'attente",

    // Message tab: Email fields
    "User's Email Address Field" => "Champ d'adresse e-mail de l'utilisateur",
    'Email Subject'              => "Objet de l'e-mail",
    'Email Body'                 => "Corps de l'e-mail",

    // Message tab: SMS fields
    "User's Phone Number Field" => "Champ de numéro de téléphone de l'utilisateur",
    'SMS Message Body'          => 'Corps du message SMS',

    // Message tab: Announcement fields
    'Announcement Title'   => "Titre de l'annonce",
    'Announcement Message' => "Message de l'annonce",

    // Message tab: Flash fields
    'Flash Message Type'                         => 'Type de message flash',
    'Flash Message Title'                        => 'Titre du message flash',
    'Flash Message Details'                      => 'Détails du message flash',
    'Which type of flash message should appear?' => 'Quel type de message flash doit apparaître ?',

    // Message tab: Pushover fields
    "Field containing each user's Pushover key" => "Champ de clé Pushover de l'utilisateur",

    // Message tab: ntfy fields
    'Priority'           => 'Priorité',
    'Tags'               => 'Étiquettes',

    // Message tab: Slack fields
    'Slack Message Body' => 'Corps du message Slack',
    'Bot Icon URL' => "URL de l'icône",

    // Message tab: Bluesky fields
    'Post Body' => 'Corps de la publication',
    'Generate Link Preview' => 'Générer un aperçu du lien',
    'No card' => 'Aucune carte',
    'Generate preview card' => "Générer une carte d'aperçu",

    // Message tab: Title / Body / Trix toolbar
    'Rich Text'     => 'Texte enrichi',
    'Bold'          => 'Gras',
    'Italic'        => 'Italique',
    'Underline'     => 'Souligné',
    'Strikethrough' => 'Barré',
    'Bullets'       => 'Puces',
    'Numbers'       => 'Numérotation',
    'Heading'       => 'Titre',
    'Code'          => 'Code',
    'Undo'          => 'Annuler',
    'Redo'          => 'Rétablir',

    // Recipients tab: common
    'Recipients Type'                             => 'Type de destinataires',
    'Who will receive this message?'              => 'Qui recevra ce message ?',
    'Add a message recipient'                     => 'Ajouter un destinataire',
    'Select User(s)'                              => 'Sélectionner un ou plusieurs utilisateurs',
    'Which users will receive the message?'       => 'Quels utilisateurs recevront le message ?',
    'Which user groups will receive the message?' => "Quels groupes d'utilisateurs recevront le message ?",
    'Twig Snippet to Determine Recipients'        => 'Extrait Twig pour déterminer les destinataires',

    // Recipients tab: per-provider pickers
    'Select Slack channel(s)'                           => 'Sélectionner le ou les canaux Slack',
    'Which Slack channels should receive this message?' => 'Quels canaux Slack doivent recevoir ce message ?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Aucun canal Slack configuré. Ajoutez-en un dans [Paramètres → Slack]({url}).',
    'Select ntfy topic(s)'                              => 'Sélectionner le ou les sujets ntfy',
    'Which ntfy topics should receive this message?'    => 'Quels sujets ntfy doivent recevoir ce message ?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'Aucun sujet ntfy configuré. Ajoutez-en un dans [Paramètres → ntfy]({url}).',
    'Select Bluesky account(s)'                         => 'Sélectionner le ou les comptes Bluesky',
    'Which Bluesky accounts should post this message?'  => 'Quels comptes Bluesky doivent publier ce message ?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Aucun compte Bluesky configuré. Ajoutez-en un dans [Paramètres → Bluesky]({url}).',

    // Settings: page chrome
    'Notifier Settings' => 'Paramètres Notifier',
    'General'           => 'Général',
    'Twilio'            => 'Twilio',
    'Pushover'          => 'Pushover',
    'Slack'             => 'Slack',
    'Bluesky'           => 'Bluesky',
    'ntfy'              => 'ntfy',

    // Settings: Logging
    'Logging'                             => 'Journalisation',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => "Notifier tient un journal continu des messages envoyés. Ce n'est généralement pas nécessaire, mais vous pouvez limiter le nombre d'événements de journal enregistrés en base de données.",
    'Enable Logging'                      => 'Activer la journalisation',
    'When disabled, Notifier will not write anything to the notification log.' => "Lorsque désactivé, Notifier n'écrit rien dans le journal des notifications.",
    'Number of days to retain log events' => 'Nombre de jours de conservation des événements de journal',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Conserver les événements de journal au plus ce nombre de jours. Laisser vide pour aucune limite.',
    'Number of log events to retain'      => "Nombre d'événements de journal à conserver",
    'At most, keep this many log events. Leave blank for no limit.' => "Conserver au plus ce nombre d'événements de journal. Laisser vide pour aucune limite.",

    // Settings: Twilio
    'Twilio API Credentials'                       => 'Identifiants API Twilio',
    'If using the Twilio API to send SMS messages, the following credentials are required.' => "Si vous utilisez l'API Twilio pour envoyer des SMS, les identifiants suivants sont requis.",
    'Twilio Account SID'                           => 'Twilio Account SID',
    'Twilio Auth Token'                            => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)' => 'Numéro de téléphone Twilio (envoie chaque SMS)',
    'SMS Testing'                                  => 'Tests SMS',
    'Optional. When set, every SMS dispatched will be sent to this number instead of the resolved recipient.' => "Facultatif. Lorsqu'il est défini, chaque SMS envoyé sera adressé à ce numéro au lieu du destinataire résolu.",
    'Test phone number'                            => 'Numéro de téléphone de test',

    // Settings: Pushover
    "[Pushover](https://pushover.net) sends push notifications to a registered user's devices. Each Craft user needs a custom field on their profile storing their Pushover user key; you select which field on each Notification's Message tab. For full setup instructions, see the [Pushover getting-started docs](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover)." => "[Pushover](https://pushover.net) envoie des notifications push vers les appareils d'un utilisateur enregistré. Chaque utilisateur Craft a besoin d'un champ personnalisé sur son profil pour stocker sa clé Pushover ; vous choisissez le champ dans l'onglet Message de chaque notification. Pour les instructions complètes, consultez la [documentation de prise en main Pushover](https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover).",
    'Application API Token'                                      => "Jeton d'API de l'application",
    'The 30-character app token from your Pushover application.' => "Le jeton d'application à 30 caractères de votre application Pushover.",

    // Settings: ntfy
    'ntfy.sh is a free HTTP-based push notification service. Subscribers receive messages on the ntfy app, web, or any compatible client by joining a topic.' => "ntfy.sh est un service gratuit de notifications push basé sur HTTP. Les abonnés reçoivent les messages dans l'application ntfy, sur le web ou via tout client compatible en rejoignant un sujet.",
    'Server URL'   => 'URL du serveur',
    'Access token' => "Jeton d'accès",
    'ntfy Topics'  => 'Sujets ntfy',
    'Topics'       => 'Sujets',
    'Topic'        => 'Sujet',
    'Add a topic'  => 'Ajouter un sujet',

    // Settings: Slack
    'Slack Channels' => 'Canaux Slack',
    'Create a [Slack app](https://api.slack.com/apps) with the `chat:write`, `chat:write.customize`, and `chat:write.public` scopes, then add a row for each channel you\'d like to post into. Each channel becomes available as a recipient on the **Recipients** tab when configuring a notification. A bot token is a secret, so store it in a `.env` variable and reference that variable (e.g. `$SLACK_BOT_TOKEN`) rather than pasting the token directly.' => 'Créez une [application Slack](https://api.slack.com/apps) avec les scopes `chat:write`, `chat:write.customize` et `chat:write.public`, puis ajoutez une ligne pour chaque canal dans lequel vous souhaitez publier. Chaque canal devient disponible comme destinataire dans l\'onglet **Destinataires** lors de la configuration d\'une notification. Un jeton de bot est un secret, alors stockez-le dans une variable `.env` et faites référence à cette variable (par exemple `$SLACK_BOT_TOKEN`) plutôt que de coller le jeton directement.',
    'Channels'       => 'Canaux',
    'Add a channel'  => 'Ajouter un canal',
    'Bot Token' => 'Jeton du bot',
    'Channel ID' => 'ID du canal',
    'Bot Emoji' => "Emoji de l'icône",
    'Bot Name' => "Nom d'utilisateur",
    'Whether Slack should unfurl link previews for URLs in the message body.' => 'Si Slack doit afficher les aperçus des liens pour les URL dans le corps du message.',
    'Not a valid Bot Token. Must start with `xoxb-`.' => 'Jeton du bot non valide. Doit commencer par `xoxb-`.',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => 'ID de canal non valide. Doit ressembler à `C01234ABCD`.',
    'Unable to send Slack message, no bot token.' => "Impossible d'envoyer le message Slack : pas de jeton de bot.",
    'Unable to send Slack message, no channel ID.' => "Impossible d'envoyer le message Slack : pas d'ID de canal.",
    'Recipient "{name}" has no Slack bot token.' => "Le destinataire \"{name}\" n'a pas de jeton de bot Slack.",
    'Recipient "{name}" has no Slack channel ID.' => "Le destinataire \"{name}\" n'a pas d'ID de canal Slack.",
    'Slack rejected the message: {error}' => 'Slack a rejeté le message : {error}',

    // Settings: Bluesky
    "[Bluesky](https://bsky.app) posts publish to the configured account's feed via the ATProto API. App passwords are generated at [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). An app password is a secret, so store it in a `.env` variable and reference that variable (e.g. `\$BLUESKY_APP_PASSWORD`) rather than pasting the password directly." => "Les publications [Bluesky](https://bsky.app) sont publiées sur le fil du compte configuré via l'API ATProto. Les mots de passe d'application sont générés sur [bsky.app/settings/app-passwords](https://bsky.app/settings/app-passwords). Un mot de passe d'application est un secret ; stockez-le donc dans une variable `.env` et référencez cette variable (par ex. `\$BLUESKY_APP_PASSWORD`) au lieu de coller le mot de passe directement.",
    'PDS URL'          => 'URL du PDS',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'Par défaut https://bsky.social. Pointez vers un PDS personnalisé si votre installation est fédérée.',
    'Bluesky Accounts' => 'Comptes Bluesky',
    'Accounts'         => 'Comptes',
    'Label'            => 'Étiquette',
    'Handle'           => 'Identifiant',
    'App password'     => "Mot de passe d'application",
    'Add an account'   => 'Ajouter un compte',

    // Test notification (UI)
    'Send a test message'           => 'Envoyer un message de test',
    'Are you certain you want to send a test notification?\\n\\nThe configured message will be sent to the configured recipient(s).' => 'Êtes-vous certain de vouloir envoyer une notification de test ?\\n\\nLe message configuré sera envoyé aux destinataires configurés.',
    'Test'                          => 'Tester',
    'Test notification dispatched.' => 'Notification de test envoyée.',
    'No messages were dispatched. Check the recipient configuration.' => "Aucun message n'a été envoyé. Vérifiez la configuration des destinataires.",

    // Settings: save / test action responses
    "Couldn't save settings."                 => "Impossible d'enregistrer les paramètres.",
    'Settings saved.'                         => 'Paramètres enregistrés.',
    'Topic is empty.'                         => 'Le sujet est vide.',
    'Server URL is not configured.'           => "L'URL du serveur n'est pas configurée.",
    'Test message from Notifier.'             => 'Message de test de Notifier.',
    'HTTP {status}'                           => 'HTTP {status}',
    'Test message sent successfully.'         => 'Message de test envoyé avec succès.',
    'Handle and app password are required.'   => "L'identifiant et le mot de passe d'application sont requis.",
    'Authentication failed.'                  => 'Authentification échouée.',
    'Successfully authenticated. No messages were posted.' => 'Authentification réussie. Aucun message n\'a été publié.',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.'          => 'Envoi de {messageType} à {recipient}.',
    'Adding message to queue.'                       => "Ajout du message à la file d'attente.",
    'Unable to parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => "Impossible d'analyser le flux. Les extensions PHP `simplexml` et `libxml` sont requises.",
    'Unable to parse the feed.' => "Impossible d'analyser le flux.",
    'Unable to fetch the feed: {message}' => 'Impossible de récupérer le flux : {message}',
    'Initial feed scan failed: {message}' => "L'analyse initiale du flux a échoué : {message}",
    'Sending message immediately (bypassing queue).' => "Envoi du message immédiatement (la file d'attente est contournée).",
    'Log events deleted.'                            => 'Événements de journal supprimés.',
    'notification'                                   => 'notification',

    // Outbound: Email log messages
    'Unable to send email, no recipient specified.'     => "Impossible d'envoyer l'e-mail : aucun destinataire spécifié.",
    'Unable to send email, the message body was empty.' => "Impossible d'envoyer l'e-mail : le corps du message était vide.",
    "Unable to send the email using Craft's native email handling." => "Impossible d'envoyer l'e-mail via la gestion d'e-mails native de Craft.",
    'Check your general email settings within Craft.'   => "Vérifiez vos paramètres généraux d'e-mail dans Craft.",
    'Successfully sent email message!'                  => 'E-mail envoyé avec succès !',

    // Outbound: SMS log messages
    '[Invalid Twilio credentials.]({url}) Missing {missing}.' => '[Identifiants Twilio invalides.]({url}) Manque {missing}.',
    'Unable to send SMS, no Twilio phone number exists.'      => "Impossible d'envoyer le SMS, aucun numéro de téléphone Twilio.",
    'Unable to send SMS, no recipient phone number exists.'   => "Impossible d'envoyer le SMS, aucun numéro de téléphone du destinataire.",
    'Unable to send SMS, recipient phone number is invalid.'  => "Impossible d'envoyer le SMS, le numéro du destinataire est invalide.",
    'Successfully sent SMS message!'                          => 'SMS envoyé avec succès !',

    // Outbound: Announcement log messages
    'Unable to post announcement, no recipient userId specified.' => "Impossible de publier l'annonce : aucun userId de destinataire spécifié.",
    'Successfully posted announcement!' => 'Annonce publiée avec succès !',

    // Outbound: Flash log messages
    'Unable to send the flash message, invalid flash type.' => "Impossible d'envoyer le message flash : type de flash invalide.",
    'Successfully sent flash message!'                      => 'Message flash envoyé avec succès !',

    // Outbound: Pushover log messages
    '[Invalid Pushover credentials.]({url}) Missing app token.'  => "[Identifiants Pushover invalides.]({url}) Jeton d'application manquant.",
    'Unable to send Pushover message, no user key on recipient.' => "Impossible d'envoyer le message Pushover : aucune clé utilisateur sur le destinataire.",
    'Pushover POST failed: {reason}'                             => 'Échec du POST Pushover : {reason}',
    'Successfully sent Pushover message!'                        => 'Message Pushover envoyé avec succès !',

    // Outbound: ntfy log messages
    'Unable to send ntfy message, no topic specified.'       => "Impossible d'envoyer le message ntfy : aucun sujet spécifié.",
    'ntfy POST failed with HTTP {status}: {reason}'          => 'Échec du POST ntfy avec HTTP {status} : {reason}',
    'ntfy POST failed: {reason}'                             => 'Échec du POST ntfy : {reason}',
    'Successfully sent ntfy message to topic "{topic}".'     => 'Message ntfy envoyé avec succès au sujet « {topic} ».',

    // Outbound: Slack log messages
    'Unable to send Slack message, body is empty.'  => "Impossible d'envoyer le message Slack : le corps est vide.",
    'Slack POST failed: {reason}'                   => 'Échec du POST Slack : {reason}',
    'Successfully sent Slack message to "{label}".' => 'Message Slack envoyé avec succès à « {label} ».',

    // Outbound: Bluesky log messages
    'Unable to send Bluesky post, recipient is missing credentials.' => "Impossible d'envoyer la publication Bluesky : les identifiants du destinataire sont manquants.",
    'Body exceeded {max} characters, truncated.'          => 'Le corps dépasse {max} caractères ; il a été tronqué.',
    'Successfully posted to Bluesky as "{label}".'        => 'Publié avec succès sur Bluesky en tant que « {label} ».',
    'Bluesky auth failed for {handle}: {reason}'          => "Échec de l'authentification Bluesky pour {handle} : {reason}",
    'Bluesky auth failed: {reason}'                       => "Échec de l'authentification Bluesky : {reason}",
    'Bluesky post failed: {reason}'                       => 'Échec de la publication Bluesky : {reason}',
    'Bluesky link preview skipped: {reason}'              => 'Aperçu du lien Bluesky ignoré : {reason}',

    // Recipient-strategy warnings
    'Recipient "{name}" has no email address.'       => "Le destinataire « {name} » n'a pas d'adresse e-mail.",
    'Recipient "{name}" has no phone number.'        => "Le destinataire « {name} » n'a pas de numéro de téléphone.",
    'Recipient "{name}" has no associated User; cannot send announcement.' => "Le destinataire « {name} » n'a pas d'utilisateur associé ; impossible d'envoyer l'annonce.",
    'Recipient "{name}" cannot access the control panel; cannot send announcement.' => "Le destinataire « {name} » ne peut pas accéder au panneau d'administration ; impossible d'envoyer l'annonce.",
    'Pushover user-key field is not configured on this notification.' => "Le champ de clé utilisateur Pushover n'est pas configuré pour cette notification.",
    'Recipient "{name}" has no associated User; cannot send Pushover message.' => "Le destinataire « {name} » n'a pas d'utilisateur associé ; impossible d'envoyer le message Pushover.",
    '[SKIPPED] User "{name}" has no Pushover key.'   => "[IGNORÉ] L'utilisateur « {name} » n'a pas de clé Pushover.",
    'Recipient "{name}" has no ntfy topic.'          => "Le destinataire « {name} » n'a pas de sujet ntfy.",
    'Recipient "{name}" has no Bluesky credentials.' => "Le destinataire « {name} » n'a pas d'identifiants Bluesky.",

    // Errors / exceptions
    'Invalid element event: {class}'                         => "Événement d'élément invalide : {class}",
    'Invalid notification ID: {id}'                          => 'ID de notification invalide : {id}',
    'Invalid email message mode.'                            => 'Mode de message e-mail invalide.',
    'You do not have permission to use the Dynamic Recipients type.' => "Vous n'avez pas l'autorisation d'utiliser le type Destinataires dynamiques.",
    'Dynamic recipients snippet did not call setRecipients.' => "L'extrait Destinataires dynamiques n'a pas appelé setRecipients.",
    'setRecipients was called with an empty value.'          => 'setRecipients a été appelée avec une valeur vide.',
    'Unrecognized recipient of type "{type}".'               => 'Destinataire de type « {type} » non reconnu.',
    'Unrecognized recipient "{value}".'                      => 'Destinataire « {value} » non reconnu.',
    'Configured {kind} no longer exists in plugin settings (uid: {uid}).' => "L'élément {kind} configuré n'existe plus dans les paramètres du plugin (uid : {uid}).",
    'Invalid settings section: {section}'                    => 'Section de paramètres invalide : {section}',
    'User not authorized to save this notification.'         => "L'utilisateur n'est pas autorisé à enregistrer cette notification.",
    'User not authorized to view this notification.'         => "L'utilisateur n'est pas autorisé à consulter cette notification.",
    'User not authorized to delete this notification.'       => "L'utilisateur n'est pas autorisé à supprimer cette notification.",
    'Notification not found'                                 => 'Notification introuvable',

    // Misc config-file note
    'This is being set in the config file. [{file}]' => 'Ceci est défini dans le fichier de configuration. [{file}]',

    // Slack, ntfy, and Bluesky message types
    "Add the Bluesky accounts you'd like to post from. Each account becomes available as a recipient on the **Recipients** tab when configuring a notification." => "Ajoutez les comptes Bluesky depuis lesquels vous souhaitez publier. Chaque compte devient disponible comme destinataire dans l'onglet **Destinataires** lors de la configuration d'une notification.",
    "Click any row's **Test** button to confirm the account authenticates." => "Cliquez sur le bouton **Tester** de n'importe quelle ligne pour confirmer que le compte s'authentifie.",
    "Click any row's **Test** button to send a quick test message to that channel." => "Cliquez sur le bouton **Tester** de n'importe quelle ligne pour envoyer un message de test rapide à ce canal.",
    "Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`." => 'Facultatif, pointez vers une instance ntfy auto-hébergée (le cas échéant). Par défaut `https://ntfy.sh`.',
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Facultatif, requis pour les sujets protégés ou les instances auto-hébergées avec authentification.',
    "Add the ntfy topics you'd like to send messages to. Each topic becomes available as a recipient on the **Recipients** tab when configuring a notification." => "Ajoutez les sujets ntfy auxquels vous souhaitez envoyer des messages. Chaque sujet devient disponible comme destinataire dans l'onglet **Destinataires** lors de la configuration d'une notification.",
    "Click any row's **Test** button to send a quick test message to that topic." => "Cliquez sur le bouton **Tester** de n'importe quelle ligne pour envoyer un message de test rapide à ce sujet.",
    'Enable Markdown' => 'Activer le Markdown',

    // Manual triggers
    'Send Notification'                                            => 'Envoyer la notification',
    'Send manual notifications'                                    => 'Envoyer des notifications manuelles',
    'Are you sure you want to send this notification?'             => 'Êtes-vous sûr de vouloir envoyer cette notification ?',
    'This notification cannot be triggered manually.'              => 'Cette notification ne peut pas être déclenchée manuellement.',
    'This notification no longer applies to the selected element.' => "Cette notification ne s'applique plus à l'élément sélectionné.",
    'Notification was not sent. Check the Notification Log for details.' => 'La notification n\'a pas été envoyée. Consultez le Journal des notifications pour plus de détails.',
    'Notification sent.'                                           => 'Notification envoyée.',
    'Element not found'                                            => 'Élément introuvable',
    'Trigger Label'                                                => 'Libellé du déclencheur',
    'An element action label (helps to differentiate multiple triggers).'        => "Un libellé d'action d'élément (aide à différencier plusieurs déclencheurs).",

    // Event tab: date trigger
    'On'                                                          => 'Le',
    'days before'                                                 => 'jours avant',
    'days after'                                                  => 'jours après',
    'Relevant Date'                                               => 'Date pertinente',
    'Send the notification relative to a chosen date.'            => 'Envoyez la notification par rapport à une date choisie.',

    // Scheduled sending
    'Scheduled Sending' => 'Envoi programmé',
    'Shared secret for authenticating scheduled-run web requests. Required only when the schedule is triggered via the web endpoint.' => "Secret partagé pour authentifier les requêtes web de l'exécution programmée. Requis uniquement si la planification est déclenchée via le point de terminaison web.",
    'Scheduled-Run Token' => "Jeton d'exécution programmée",
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => "Envoyé avec chaque requête sous forme d'en-tête X-Notifier-Token ou de paramètre token dans le corps.",
    'Pushover Title' => 'Titre Pushover',
    'Pushover Body' => 'Corps Pushover',
    'ntfy Title' => 'Titre ntfy',
    'ntfy Body' => 'Corps ntfy',
    'ntfy Link URL' => 'URL du lien ntfy',
    'Render Link Previews' => 'Afficher les aperçus de liens',
    'Don\'t unfurl' => 'Ne pas développer',
    'Expand link previews' => 'Développer les aperçus',
    'Regular text only' => 'Texte normal uniquement',
    'Markdown enabled' => 'Markdown activé',
    'Dynamic Pushover Title' => 'Titre Pushover dynamique',
    'Dynamic Subject Line' => 'Ligne d\'objet dynamique',
    'Dynamic Bot Name' => 'Nom de bot dynamique',
    'Dynamic ntfy Title' => 'Titre ntfy dynamique',
    'Dynamic Announcement Title' => 'Titre d\'annonce dynamique',
    'Dynamic Flash Message Title' => 'Titre de message Flash dynamique',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => 'Texte brut, 300 caractères maximum. Les URL et les mentions `@handle.tld` deviennent automatiquement des liens.',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => 'Générer automatiquement une carte d\'aperçu lorsque le corps du post contient une URL.',
    'Whether the message be sent via the [jobs queue]({queueUrl}).' => 'Si le message doit être envoyé via la [file d\'attente des tâches]({queueUrl}).',
    'Priority level of the ntfy message.' => 'Niveau de priorité du message ntfy.',
    'Optionally include comma-separated [emoji shortcodes](https://docs.ntfy.sh/emojis/).' => 'Inclure éventuellement des [codes d\'emoji](https://docs.ntfy.sh/emojis/) séparés par des virgules.',
    'Body of the ntfy notification.' => 'Corps de la notification ntfy.',
    'Optionally open a URL when the notification is clicked.' => 'Ouvrir éventuellement une URL lorsque la notification est cliquée.',
    'Whether to parse the body as Markdown in supported clients.' => 'Si le corps doit être interprété comme du Markdown dans les clients compatibles.',
    'Heading of the announcement.' => 'Titre de l\'annonce.',
    'Body of the announcement. Supports Markdown.' => 'Corps de l\'annonce. Prend en charge Markdown.',
    'Heading of the flash message.' => 'Titre du message flash.',
    'Optionally include details below the heading. Supports Markdown and HTML.' => 'Inclure éventuellement des détails sous le titre. Prend en charge Markdown et HTML.',
    'Optionally include a heading above the body.' => 'Inclure éventuellement un titre au-dessus du corps.',
    'Body of the SMS (text message). Plain text only.' => 'Corps du SMS (message texte). Texte brut uniquement.',
    'Body of the Pushover notification. Plain text only.' => 'Corps de la notification Pushover. Texte brut uniquement.',
    'Subject line of the email.' => 'Ligne d\'objet de l\'e-mail.',
    'Body of the email. Supports HTML.' => 'Corps de l\'e-mail. Prend en charge HTML.',
    'Optionally override the app\'s display name.' => 'Remplacer éventuellement le nom d\'affichage de l\'application.',
    'Optionally override the app\'s icon with a URL.' => 'Remplacer éventuellement l\'icône de l\'application par une URL.',
    'Optionally override the app\'s icon with an emoji. Used only when Bot Icon URL is empty.' => 'Remplacer éventuellement l\'icône de l\'application par un emoji. Utilisé uniquement lorsque Bot Icon URL est vide.',
    'Invalid Slack body format.' => 'Format de corps Slack non valide.',
    'Supports standard [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) syntax. Optionally supports HTML _(see below)_.' => 'Prend en charge la syntaxe [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting) standard. Prend en charge HTML en option _(voir ci-dessous)_.',
    'Render Message Body as HTML' => 'Rendre le corps du message en HTML',
    'Whether to only parse as [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), or additionally parse it as HTML.' => 'Analyser uniquement comme [Slack mrkdwn](https://docs.slack.dev/messaging/formatting-message-text/#formatting), ou aussi comme HTML.',
    'mrkdwn only' => 'mrkdwn uniquement',
    'mrkdwn + HTML' => 'mrkdwn + HTML',
];
