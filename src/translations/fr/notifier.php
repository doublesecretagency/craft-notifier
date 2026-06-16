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

    // ========================================================
    // NOTIFICATION EDITOR
    // ========================================================

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
    'Generate report on a recurring schedule' => 'Générer le rapport selon une planification récurrente',
    'Generate report on demand' => 'Générer le rapport à la demande',
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

    // Message tab: type selector
    'Message Type' => 'Type de message',
    'What type of message will be sent?' => 'Quel type de message sera envoyé ?',
    '[Templating]({templatingUrl}) and [special variables]({variablesUrl}) are supported.' => '[Templating]({templatingUrl}) et [variables spéciales]({variablesUrl}) sont pris en charge.',

    // Details sidebar: queue
    'Use Queue' => 'Utiliser la file d\'attente',
    'Immediate' => 'Immédiat',
    'Queue' => 'File d\'attente',
    'jobs queue' => 'file d\'attente des tâches',
    'Whether the message will be sent immediately, or added to the {link}.' => 'Si le message sera envoyé immédiatement ou ajouté à la {link}.',
    'Flash messages never use the queue.' => 'Les messages flash n\'utilisent jamais la file d\'attente.',
    'Announcements always use the queue.' => 'Les annonces utilisent toujours la file d\'attente.',

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

    // Message tab: Discord
    'Discord Message Body' => 'Corps du message Discord',
    'Supports standard Markdown, and optionally HTML _(see below)_. Max 2000 characters.' => 'Prend en charge le Markdown standard et, en option, HTML _(voir ci-dessous)_. Max. 2000 caractères.',
    'Whether to only parse as Markdown, or additionally parse it as HTML.' => 'Analyser uniquement comme Markdown, ou aussi comme HTML.',
    'Markdown only' => 'Markdown uniquement',
    'Markdown + HTML' => 'Markdown + HTML',
    'Whether Discord should unfurl link previews for URLs in the message body.' => 'Si Discord doit afficher les aperçus des liens pour les URL dans le corps du message.',
    'Webhook Username' => "Nom d'utilisateur du webhook",
    'Optionally override the webhook\'s display name.' => "Remplacer éventuellement le nom d'affichage du webhook.",
    'Dynamic Username' => "Nom d'utilisateur dynamique",
    'Webhook Avatar URL' => "URL de l'avatar du webhook",
    'Optionally override the webhook\'s avatar with a URL.' => "Remplacer éventuellement l'avatar du webhook par une URL.",

    // Message tab: Facebook
    'Message Body' => 'Corps du message',
    'The text of your Facebook post.' => 'Le texte de votre publication Facebook.',
    'Preview Card URL' => "URL de la carte d'aperçu",
    'Optionally add a link to generate a preview card.' => "Ajouter éventuellement un lien pour générer une carte d'aperçu.",

    // Message tab: Instagram
    'Caption' => 'Légende',
    'Image Attachment' => 'Pièce jointe image',
    'Optional caption, max 2200 characters.' => 'Légende facultative, 2200 caractères maximum.',

    // Message tab: X (Twitter)
    'Plain text, max 280 characters.' => 'Texte brut, 280 caractères maximum.',

    // Message tab: Media
    'Attach an image by calling `{% setMedia %}` in a [custom Twig snippet]({url}).' => 'Joignez une image en appelant `{% setMedia %}` dans un [extrait Twig personnalisé]({url}).',

    // Message tab: Bluesky
    'Post Body' => 'Corps de la publication',
    'Plain text, max 300 characters. URLs and `@handle.tld` mentions will link automatically.' => 'Texte brut, 300 caractères maximum. Les URL et les mentions `@handle.tld` deviennent automatiquement des liens.',
    'Generate Link Preview' => 'Générer un aperçu du lien',
    'Whether to automatically generate a preview card when a URL is included in the post body.' => 'Générer automatiquement une carte d\'aperçu lorsque le corps du post contient une URL.',
    'No card' => 'Aucune carte',
    'Generate preview card' => "Générer une carte d'aperçu",

    // Message tab: Mastodon
    'Plain text, max 500 characters. URLs will unfurl automatically.' => 'Texte brut, max. 500 caractères. Les URL se déploient automatiquement.',
    'Visibility' => 'Visibilité',
    'Who will be able to see this post?' => 'Qui pourra voir cette publication ?',

    // Message tab: MQTT
    'Payload' => 'Contenu',
    'The JSON or plain text message published to the MQTT topic.' => 'Le message JSON ou en texte brut publié sur le sujet MQTT.',
    'Quality of Service' => 'Qualité de service',
    'Delivery guarantee for this message.' => 'Garantie de livraison pour ce message.',
    'Retain' => 'Conserver',
    'Whether the broker keeps this as the topic\'s last message for future subscribers.' => 'Indique si le broker conserve ce message comme dernier message du sujet et le livre aux futurs abonnés.',
    'Don\'t retain' => 'Ne pas conserver',

    // Recipients tab: type selector & user/group pickers
    'Recipients Type' => 'Type de destinataires',
    'Who will receive this message?' => 'Qui recevra ce message ?',
    'Add a message recipient' => 'Ajouter un destinataire',
    'Select User(s)' => 'Sélectionner un ou plusieurs utilisateurs',
    'Which users will receive the message?' => 'Quels utilisateurs recevront le message ?',
    'Which user groups will receive the message?' => "Quels groupes d'utilisateurs recevront le message ?",

    // Recipients tab: channel pickers (ntfy, Slack, Discord, Bluesky, Mastodon, MQTT)
    'Select ntfy topic(s)' => 'Sélectionner le ou les sujets ntfy',
    'Which topics should receive this message?' => 'Quels sujets doivent recevoir ce message ?',
    'No ntfy topics configured. Add one in [Settings → ntfy]({url}).' => 'Aucun sujet ntfy configuré. Ajoutez-en un dans [Paramètres → ntfy]({url}).',
    'No ntfy topics configured. Topics can only be added in an environment that allows administrative changes.' => 'Aucun sujet ntfy configuré. Les sujets ne peuvent être ajoutés que dans un environnement qui autorise les modifications administratives.',
    'Select Slack channel(s)' => 'Sélectionner le ou les canaux Slack',
    'Which channels should receive this message?' => 'Quels canaux doivent recevoir ce message ?',
    'No Slack channels configured. Add one in [Settings → Slack]({url}).' => 'Aucun canal Slack configuré. Ajoutez-en un dans [Paramètres → Slack]({url}).',
    'No Slack channels configured. Channels can only be added in an environment that allows administrative changes.' => 'Aucun canal Slack configuré. Les canaux ne peuvent être ajoutés que dans un environnement qui autorise les modifications administratives.',
    'Select Discord channel(s)' => 'Sélectionner le ou les canaux Discord',
    'No Discord channels configured. Add one in [Settings → Discord]({url}).' => 'Aucun canal Discord configuré. Ajoutez-en un dans [Paramètres → Discord]({url}).',
    'No Discord channels configured. Channels can only be added in an environment that allows administrative changes.' => 'Aucun canal Discord configuré. Les canaux ne peuvent être ajoutés que dans un environnement qui autorise les modifications administratives.',
    'Select Facebook page(s)' => 'Sélectionner la ou les pages Facebook',
    'Which pages should post this message?' => 'Quelles pages doivent publier ce message ?',
    'No Facebook pages configured. Add one in [Settings → Facebook]({url}).' => 'Aucune page Facebook configurée. Ajoutez-en une dans [Paramètres → Facebook]({url}).',
    'No Facebook pages configured. Pages can only be added in an environment that allows administrative changes.' => 'Aucune page Facebook configurée. Les pages ne peuvent être ajoutées que dans un environnement qui autorise les modifications administratives.',
    'Select Instagram account(s)' => 'Sélectionner le ou les comptes Instagram',
    'No Instagram accounts configured. Add one in [Settings → Instagram]({url}).' => 'Aucun compte Instagram configuré. Ajoutez-en un dans [Paramètres → Instagram]({url}).',
    'No Instagram accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Aucun compte Instagram configuré. Les comptes ne peuvent être ajoutés que dans un environnement qui autorise les modifications administratives.',
    'Select X (Twitter) account(s)' => 'Sélectionner le ou les comptes X (Twitter)',
    'No X (Twitter) accounts configured. Add one in [Settings → X (Twitter)]({url}).' => 'Aucun compte X (Twitter) configuré. Ajoutez-en un dans [Paramètres → X (Twitter)]({url}).',
    'No X (Twitter) accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Aucun compte X (Twitter) configuré. Les comptes ne peuvent être ajoutés que dans un environnement qui autorise les modifications administratives.',
    'Select Bluesky account(s)' => 'Sélectionner le ou les comptes Bluesky',
    'Which accounts should post this message?' => 'Quels comptes doivent publier ce message ?',
    'No Bluesky accounts configured. Add one in [Settings → Bluesky]({url}).' => 'Aucun compte Bluesky configuré. Ajoutez-en un dans [Paramètres → Bluesky]({url}).',
    'No Bluesky accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Aucun compte Bluesky configuré. Les comptes ne peuvent être ajoutés que dans un environnement qui autorise les modifications administratives.',
    'Select Mastodon account(s)' => 'Sélectionner le ou les comptes Mastodon',
    'No Mastodon accounts configured. Add one in [Settings → Mastodon]({url}).' => 'Aucun compte Mastodon configuré. Ajoutez-en un dans [Paramètres → Mastodon]({url}).',
    'No Mastodon accounts configured. Accounts can only be added in an environment that allows administrative changes.' => 'Aucun compte Mastodon configuré. Les comptes ne peuvent être ajoutés que dans un environnement qui autorise les modifications administratives.',
    'Select MQTT topic(s)' => 'Sélectionner le(s) sujet(s) MQTT',
    'No MQTT topics configured. Add one in [Settings → MQTT]({url}).' => 'Aucun sujet MQTT configuré. Ajoutez-en un dans [Réglages → MQTT]({url}).',
    'No MQTT topics configured. Topics can only be added in an environment that allows administrative changes.' => 'Aucun sujet MQTT configuré. Les sujets ne peuvent être ajoutés que dans un environnement qui autorise les modifications administratives.',
    'Not a valid topic. Must not be empty or contain the `+` or `#` wildcards.' => 'Sujet non valide. Il ne doit pas être vide ni contenir les caractères génériques `+` ou `#`.',

    // Recipients tab: dynamic recipients snippet
    'Twig Snippet to Determine Recipients' => 'Extrait Twig pour déterminer les destinataires',
    'Enter a custom Twig snippet to [determine who will receive the message]({url}).' => 'Saisissez un extrait Twig personnalisé pour [déterminer qui recevra le message]({url}).',
    'The snippet **must** include a `{% setRecipients %}` tag.' => 'L\'extrait **doit** inclure une balise `{% setRecipients %}`.',

    // ========================================================
    // SETTINGS
    // ========================================================

    // Settings: nav & page chrome
    'Notifier Settings' => 'Paramètres Notifier',
    'General' => 'Général',
    'Twilio' => 'Twilio',
    'Pushover' => 'Pushover',
    'ntfy' => 'ntfy',
    'Slack' => 'Slack',
    'Discord' => 'Discord',
    'Bluesky' => 'Bluesky',
    'Mastodon' => 'Mastodon',
    'MQTT' => 'MQTT',

    // Settings: shared intro lines
    'Consult the [{name} setup guide]({url}) for complete instructions.' => 'Consultez le [guide de configuration {name}]({url}) pour des instructions complètes.',
    'Sensitive values can be stored in your `.env` file and referenced here.' => 'Les valeurs sensibles peuvent être stockées dans votre fichier `.env` et référencées ici.',

    // Settings: Notification order
    'Notification Order' => 'Ordre des notifications',
    'Notifications can be dragged into any order on the index page. Choose where new notifications land in that order.' => "Les notifications peuvent être glissées pour créer un ordre personnalisé sur la page d'index. Choisissez où les nouvelles notifications sont ajoutées à cet ordre.",
    'Default Placement' => 'Emplacement par défaut',
    'Where new notifications are added to the list.' => 'Où les nouvelles notifications sont ajoutées à la liste.',
    'Before other notifications' => 'Avant les autres notifications',
    'After other notifications' => 'Après les autres notifications',

    // Settings: Logging
    'Logging' => 'Journalisation',
    "Notifier keeps a running log of every message it sends. You usually won't need to change this, but you can limit how many log entries are kept in the database." => "Notifier tient un journal continu des messages envoyés. Ce n'est généralement pas nécessaire, mais vous pouvez limiter le nombre d'événements de journal enregistrés en base de données.",
    'Enable Logging' => 'Activer la journalisation',
    'When disabled, Notifier will not write anything to the notification log.' => "Lorsque désactivé, Notifier n'écrit rien dans le journal des notifications.",
    'Number of days to retain log events' => 'Nombre de jours de conservation des événements de journal',
    'At most, keep log events for this many days. Leave blank for no limit.' => 'Conserver les événements de journal au plus ce nombre de jours. Laisser vide pour aucune limite.',
    'Number of log events to retain' => "Nombre d'événements de journal à conserver",
    'At most, keep this many log events. Leave blank for no limit.' => "Conserver au plus ce nombre d'événements de journal. Laisser vide pour aucune limite.",

    // Settings: Scheduled sending
    'Scheduled Sending' => 'Envoi programmé',
    'A shared secret that authenticates scheduled runs triggered over the web. You only need this if you trigger the schedule from the web endpoint.' => "Secret partagé pour authentifier les requêtes web de l'exécution programmée. Requis uniquement si la planification est déclenchée via le point de terminaison web.",
    'Scheduled-Run Token' => "Jeton d'exécution programmée",
    'Sent with each request as the X-Notifier-Token header or token body parameter.' => "Envoyé avec chaque requête sous forme d'en-tête X-Notifier-Token ou de paramètre token dans le corps.",

    // Settings: Twilio
    'Send SMS text messages through [Twilio](https://www.twilio.com).' => 'Envoyez des SMS via [Twilio](https://www.twilio.com).',
    'Twilio Account SID' => 'Twilio Account SID',
    'Twilio Auth Token' => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)' => 'Numéro de téléphone Twilio (envoie chaque SMS)',
    'SMS Testing' => 'Tests SMS',
    'Optional. When set, every SMS is sent to this number instead of the actual recipient.' => "Facultatif. Lorsqu'il est défini, chaque SMS envoyé sera adressé à ce numéro au lieu du destinataire résolu.",
    'Test phone number' => 'Numéro de téléphone de test',

    // Settings: Pushover
    'Send push notifications through [Pushover](https://pushover.net).' => 'Envoyez des notifications push via [Pushover](https://pushover.net).',
    'Application API Token' => "Jeton d'API de l'application",
    'The 30-character app token from your Pushover application.' => "Le jeton d'application à 30 caractères de votre application Pushover.",

    // Settings: ntfy
    'Send push notifications through [ntfy](https://ntfy.sh).' => 'Envoyez des notifications push via [ntfy](https://ntfy.sh).',
    'Server URL' => 'URL du serveur',
    "Optional, point at a self-hosted ntfy instance (if applicable). Defaults to `https://ntfy.sh`." => 'Facultatif, pointez vers une instance ntfy auto-hébergée (le cas échéant). Par défaut `https://ntfy.sh`.',
    'Access token' => "Jeton d'accès",
    'Optional, required for protected topics or self-hosted instances with auth.' => 'Facultatif, requis pour les sujets protégés ou les instances auto-hébergées avec authentification.',
    'ntfy Topics' => 'Sujets ntfy',
    'Add the ntfy topics you want to send to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => "Ajoutez les sujets ntfy auxquels vous souhaitez envoyer des messages. Chaque sujet devient disponible comme destinataire dans l'onglet **Destinataires** lors de la configuration d'une notification.",
    'Topics' => 'Sujets',
    "Click any row's **Test** button to send a quick test message to that topic." => "Cliquez sur le bouton **Tester** de n'importe quelle ligne pour envoyer un message de test rapide à ce sujet.",
    'Label' => 'Étiquette',
    'Topic' => 'Sujet',
    'Add a topic' => 'Ajouter un sujet',

    // Settings: Slack
    'Post messages to your Slack channels.' => 'Publiez des messages dans vos canaux Slack.',
    'Channels' => 'Canaux',
    "Click any row's **Test** button to send a quick test message to that channel." => "Cliquez sur le bouton **Tester** de n'importe quelle ligne pour envoyer un message de test rapide à ce canal.",
    'Bot Token' => 'Jeton du bot',
    'Channel ID' => 'ID du canal',
    'Add a channel' => 'Ajouter un canal',
    'Not a valid Bot Token. Must start with `xoxb-`.' => 'Jeton du bot non valide. Doit commencer par `xoxb-`.',
    'Not a valid Channel ID. Must look like `C01234ABCD`.' => 'ID de canal non valide. Doit ressembler à `C01234ABCD`.',

    // Settings: Discord
    'Post messages to your Discord channels.' => 'Publiez des messages dans vos canaux Discord.',
    'Webhook URL' => 'Webhook URL',
    'Not a valid Webhook URL. Must start with `https://discord.com/api/webhooks/`.' => 'Webhook URL non valide. Doit commencer par `https://discord.com/api/webhooks/`.',

    // Settings: Facebook
    'Facebook' => 'Facebook',
    'Publish posts to your [Facebook](https://facebook.com) pages.' => 'Publiez des messages sur vos pages [Facebook](https://facebook.com).',
    'Pages' => 'Pages',
    'Page ID' => 'Page ID',
    'Page Access Token' => 'Page Access Token',
    'Add a page' => 'Ajouter une page',
    "Click any row's **Test** button to verify that page's credentials. No posts are made." => "Cliquez sur le bouton **Tester** de n'importe quelle ligne pour vérifier les identifiants de cette page. Aucune publication n'est effectuée.",

    // Settings: Instagram
    'Instagram' => 'Instagram',
    'Publish posts to your [Instagram](https://instagram.com) Business accounts.' => 'Publiez des messages sur vos comptes [Instagram](https://instagram.com) Business.',
    "Click any row's **Test** button to resolve the linked Instagram account. No posts are made." => "Cliquez sur le bouton **Tester** de n'importe quelle ligne pour résoudre le compte Instagram lié. Aucune publication n'est effectuée.",

    // Settings: X (Twitter)
    'X (Twitter)' => 'X (Twitter)',
    'Publish posts to your [X (Twitter)](https://x.com) accounts.' => 'Publiez des messages sur vos comptes [X (Twitter)](https://x.com).',
    'Consumer Key' => 'Consumer Key',
    'Consumer Key Secret' => 'Consumer Key Secret',
    'Access Token Secret' => 'Access Token Secret',

    // Settings: Bluesky
    'Publish posts to your [Bluesky](https://bsky.app) accounts.' => 'Publiez des messages sur vos comptes [Bluesky](https://bsky.app).',
    'PDS URL' => 'URL du PDS',
    'Defaults to https://bsky.social. Point at a custom PDS if your installation federates.' => 'Par défaut https://bsky.social. Pointez vers un PDS personnalisé si votre installation est fédérée.',
    'Bluesky Accounts' => 'Comptes Bluesky',
    'Add the Bluesky accounts you want to post from. Each account becomes available as a recipient on the **Recipients** tab when you set up a notification.' => "Ajoutez les comptes Bluesky depuis lesquels vous souhaitez publier. Chaque compte devient disponible comme destinataire dans l'onglet **Destinataires** lors de la configuration d'une notification.",
    'Accounts' => 'Comptes',
    "Click any row's **Test** button to confirm the account authenticates." => "Cliquez sur le bouton **Tester** de n'importe quelle ligne pour confirmer que le compte s'authentifie.",
    'Handle' => 'Identifiant',
    'App password' => "Mot de passe d'application",
    'Add an account' => 'Ajouter un compte',

    // Settings: Mastodon
    'Publish posts to your [Mastodon](https://joinmastodon.org) accounts.' => 'Publiez des messages sur vos comptes [Mastodon](https://joinmastodon.org).',
    'Click any row\'s **Test** button to verify that account\'s credentials. No posts are made.' => "Cliquez sur le bouton **Tester** de n'importe quelle ligne pour vérifier les identifiants de ce compte. Aucune publication n'est effectuée.",
    'Instance URL' => "URL d'instance",
    'Access Token' => "Jeton d'accès",

    // Settings: MQTT
    'Publish messages to an MQTT broker, handy for IoT and home-automation setups.' => 'Publiez des messages vers un broker MQTT, pratique pour les configurations IoT et domotiques.',
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
    'Optional. Needed for brokers that authenticate clients with certificates, such as AWS IoT Core. Enter the server file paths to your certificate files. You can use a `.env` variable or `@alias` reference.' => 'Facultatif. Requis pour les brokers qui authentifient les clients par certificats, comme AWS IoT Core. Indiquez les chemins de fichiers serveur vers les fichiers de certificat (une variable `.env` ou une référence `@alias` est autorisée).',
    'CA Certificate File' => 'Fichier de certificat CA',
    'Path to the certificate authority (CA) file.' => 'Chemin vers le fichier de l\'autorité de certification (CA).',
    'Client Certificate File' => 'Fichier de certificat client',
    'Path to the client certificate file.' => 'Chemin vers le fichier de certificat client.',
    'Client Key File' => 'Fichier de clé client',
    'Path to the client private key file.' => 'Chemin vers le fichier de clé privée du client.',
    'MQTT Topics' => 'Sujets MQTT',
    'Add the MQTT topics you want to publish to. Each topic becomes available as a recipient on the **Recipients** tab when you set up a notification.' => 'Ajoutez les sujets MQTT sur lesquels vous souhaitez publier. Chaque sujet devient disponible comme destinataire dans l\'onglet **Destinataires** lors de la configuration d\'une notification.',
    'Click any row\'s **Test** button to publish a quick test message to that topic.' => 'Cliquez sur le bouton **Tester** de n\'importe quelle ligne pour publier un message de test rapide sur ce sujet.',

    // ========================================================
    // MANUAL SEND & TEST
    // ========================================================

    // Manual send & test
    'Send a test message' => 'Envoyer un message de test',
    'Send a REAL test notification?\\n\\n⚠️ Uses a random sample of real data.\\n⚠️ Sends a real message via the configured channel.\\n⚠️ Delivers to the real configured recipient(s).' => 'Envoyer une VRAIE notification de test ?\\n\\n⚠️ Utilise un échantillon aléatoire de données réelles.\\n⚠️ Envoie un message réel via le canal configuré.\\n⚠️ Livré aux véritables destinataires configurés.',
    'Test' => 'Tester',
    'Send system snapshot' => 'Envoyer l\'instantané du système',
    'Send data report' => 'Envoyer le rapport de données',
    'Are you sure you want to send this notification?' => 'Êtes-vous sûr de vouloir envoyer cette notification ?',
    'This notification cannot be triggered manually.' => 'Cette notification ne peut pas être déclenchée manuellement.',
    'This notification no longer applies to the selected element.' => "Cette notification ne s'applique plus à l'élément sélectionné.",

    // ========================================================
    // RUNTIME OUTPUT
    // ========================================================

    // Runtime: dispatch log feedback
    'Sending {messageType} to {recipient}.' => 'Envoi de {messageType} à {recipient}.',
    'Adding message to queue.' => "Ajout du message à la file d'attente.",
    'Sending message immediately (bypassing queue).' => "Envoi du message immédiatement (la file d'attente est contournée).",

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
    'Page ID and Page Access Token are required.' => 'Le Page ID et le Page Access Token sont requis.',
    'Facebook rejected the request: {error}' => 'Facebook a rejeté la requête : {error}',
    'Successfully connected to "{name}". No posts were made.' => "Connecté avec succès à « {name} ». Aucune publication n'a été effectuée.",
    'No Instagram Business account is linked to this Page.' => "Aucun compte Instagram Business n'est lié à cette page.",
    'Successfully connected to @{handle}. No posts were made.' => "Connecté avec succès à @{handle}. Aucune publication n'a été effectuée.",
    'All four credentials are required.' => 'Les quatre identifiants sont requis.',
    'X (Twitter) rejected the request: {error}' => 'X (Twitter) a rejeté la requête : {error}',
    'Successfully authenticated as @{username}. No posts were made.' => "Authentifié avec succès en tant que @{username}. Aucune publication n'a été effectuée.",
    'Handle and app password are required.' => "L'identifiant et le mot de passe d'application sont requis.",
    'Authentication failed.' => 'Authentification échouée.',
    'Successfully authenticated. No messages were posted.' => 'Authentification réussie. Aucun message n\'a été publié.',
    'Log events deleted.' => 'Événements de journal supprimés.',
    'Notification sent.' => 'Notification envoyée.',
    'Notification was not sent. Check the Notification Log for details.' => 'La notification n\'a pas été envoyée. Consultez le Journal des notifications pour plus de détails.',
    'Instance URL and access token are required.' => "L'URL d'instance et le jeton d'accès sont requis.",
    'Mastodon rejected the request: {error}' => 'Mastodon a rejeté la requête : {error}',
    'Successfully authenticated as @{handle}. No posts were made.' => "Authentifié avec succès en tant que @{handle}. Aucune publication n'a été effectuée.",
    'Broker host is not configured.' => 'L\'hôte du broker n\'est pas configuré.',

    // Outbound: per-channel send results
    'Successfully sent email message!' => 'E-mail envoyé avec succès !',
    'Successfully sent SMS message!' => 'SMS envoyé avec succès !',
    'Successfully posted announcement!' => 'Annonce publiée avec succès !',
    'Successfully sent flash message!' => 'Message flash envoyé avec succès !',
    'Successfully sent Pushover message!' => 'Message Pushover envoyé avec succès !',
    'Successfully sent ntfy message to topic "{topic}".' => 'Message ntfy envoyé avec succès au sujet « {topic} ».',
    'Slack rejected the message: {error}' => 'Slack a rejeté le message : {error}',
    'Successfully sent Slack message to "{label}".' => 'Message Slack envoyé avec succès à « {label} ».',
    'Discord rejected the message: {error}' => 'Discord a rejeté le message : {error}',
    'Successfully sent Discord message to "{label}".' => 'Message Discord envoyé avec succès à « {label} ».',
    'Successfully sent Facebook post to "{label}".' => 'Publication Facebook envoyée avec succès à « {label} ».',
    'the attached image could not be read' => "l'image jointe n'a pas pu être lue",
    'Successfully sent X (Twitter) post as "{label}".' => 'Publication X (Twitter) envoyée avec succès en tant que « {label} ».',
    'Successfully posted to Bluesky as "{label}".' => 'Publié avec succès sur Bluesky en tant que « {label} ».',
    'Successfully sent Mastodon post to "{label}".' => 'Publication Mastodon envoyée avec succès à « {label} ».',
    'Successfully sent MQTT message to topic "{topic}".' => 'Message MQTT envoyé avec succès au sujet "{topic}".',

    // Media attachments
    'Videos are not yet supported on {channel}.' => 'Les vidéos ne sont pas encore prises en charge sur {channel}.',
    'The image could not be resized to fit.' => "L'image n'a pas pu être redimensionnée pour s'adapter.",
    '[NOT ATTACHED] Unable to attach image. {reason}' => "[NON JOINT] Impossible de joindre l'image. {reason}",

    // Recipient warnings
    '[SKIPPED] User "{name}" has no Pushover key.' => "[IGNORÉ] L'utilisateur « {name} » n'a pas de clé Pushover.",

    // Errors & exceptions
    'Invalid element event: {class}' => "Événement d'élément invalide : {class}",
    'Invalid notification ID: {id}' => 'ID de notification invalide : {id}',
    'Invalid email message mode.' => 'Mode de message e-mail invalide.',
    'You do not have permission to use the Dynamic Recipients type.' => "Vous n'avez pas l'autorisation d'utiliser le type Destinataires dynamiques.",
    'Invalid settings section: {section}' => 'Section de paramètres invalide : {section}',
    'User not authorized to save this notification.' => "L'utilisateur n'est pas autorisé à enregistrer cette notification.",
    'User not authorized to view this notification.' => "L'utilisateur n'est pas autorisé à consulter cette notification.",
    'User not authorized to delete this notification.' => "L'utilisateur n'est pas autorisé à supprimer cette notification.",
    'Notification not found' => 'Notification introuvable',
    'Element not found' => 'Élément introuvable',
    'You do not have permission to use the Dynamic Data type.' => "Vous n'avez pas la permission d'utiliser le type Données dynamiques.",
    '[NO DATA] The Dynamic Data snippet did not call the {tag} tag.' => "[AUCUNE DONNÉE] L'extrait Twig n'a pas appelé la balise {tag}.",

    // Config-file override note
    'This is being set in the config file. [{file}]' => 'Ceci est défini dans le fichier de configuration. [{file}]',

    // ========================================================
    // JAVASCRIPT UI
    // ========================================================

    // JavaScript: log utility & buttons
    'Test notification failed.' => 'Échec de la notification de test.',
    'Unable to get the notification, something went wrong.' => 'Impossible de récupérer la notification, une erreur s\'est produite.',
    'Something went wrong.' => 'Une erreur s\'est produite.',
    'Invalid notification ID.' => 'ID de notification invalide.',
    'Unable to delete the log event, something went wrong.' => 'Impossible de supprimer l\'événement de journal, une erreur s\'est produite.',
    'Log event deleted.' => 'Événement de journal supprimé.',
    'Unable to delete log events, something went wrong.' => 'Impossible de supprimer les événements de journal, une erreur s\'est produite.',
    'Are you sure you want to delete all logs from {date}?' => 'Voulez-vous vraiment supprimer tous les journaux du {date} ?',
    // Reworded outbound + dispatch log messages
    'Successfully posted to "{label}" Instagram account.' => 'Publié sur le compte Instagram « {label} ».',
    '[BAD CREDENTIALS] Missing app token. [Configure Pushover]({url}).' => '[IDENTIFIANTS INVALIDES] Jeton d’application manquant. [Configurer Pushover]({url}).',
    '[BAD CREDENTIALS] Missing {missing}. [Configure Twilio]({url}).' => '[IDENTIFIANTS INVALIDES] {missing} manquant. [Configurer Twilio]({url}).',
    '[BAD CREDENTIALS] No Discord webhook URL is configured.' => '[IDENTIFIANTS INVALIDES] Aucune URL de webhook Discord n’est configurée.',
    '[BAD CREDENTIALS] No MQTT broker host is configured.' => '[IDENTIFIANTS INVALIDES] Aucun hôte de courtier MQTT n’est configuré.',
    '[BAD CREDENTIALS] No Mastodon access token is configured.' => '[IDENTIFIANTS INVALIDES] Aucun jeton d’accès Mastodon n’est configuré.',
    '[BAD CREDENTIALS] No Mastodon instance URL is configured.' => '[IDENTIFIANTS INVALIDES] Aucune URL d’instance Mastodon n’est configurée.',
    '[BAD CREDENTIALS] No Slack bot token is configured.' => '[IDENTIFIANTS INVALIDES] Aucun jeton de bot Slack n’est configuré.',
    '[BAD CREDENTIALS] No Twilio phone number is configured.' => '[IDENTIFIANTS INVALIDES] Aucun numéro de téléphone Twilio n’est configuré.',
    '[BAD CREDENTIALS] The recipient is missing Bluesky credentials.' => '[IDENTIFIANTS INVALIDES] Il manque les identifiants Bluesky au destinataire.',
    '[BAD CREDENTIALS] The recipient is missing Facebook credentials.' => '[IDENTIFIANTS INVALIDES] Il manque les identifiants Facebook au destinataire.',
    '[BAD CREDENTIALS] The recipient is missing X (Twitter) credentials.' => '[IDENTIFIANTS INVALIDES] Il manque les identifiants X (Twitter) au destinataire.',
    '[BAD CREDENTIALS] Unable to post, recipient is missing credentials.' => '[IDENTIFIANTS INVALIDES] Publication impossible ; il manque les identifiants au destinataire.',
    '[EMPTY BODY] The Discord message body is empty.' => '[CORPS VIDE] Le corps du message Discord est vide.',
    '[EMPTY BODY] The Facebook post body is empty.' => '[CORPS VIDE] Le corps de la publication Facebook est vide.',
    '[EMPTY BODY] The MQTT payload is empty.' => '[CORPS VIDE] La charge utile MQTT est vide.',
    '[EMPTY BODY] The Mastodon post body is empty.' => '[CORPS VIDE] Le corps de la publication Mastodon est vide.',
    '[EMPTY BODY] The Slack message body is empty.' => '[CORPS VIDE] Le corps du message Slack est vide.',
    '[EMPTY BODY] The X (Twitter) post body is empty.' => '[CORPS VIDE] Le corps de la publication X (Twitter) est vide.',
    '[EMPTY BODY] The email message body was empty.' => '[CORPS VIDE] Le corps de l’e-mail était vide.',
    '[FEED ERROR] Could not fetch the feed: {message}' => '[ERREUR DE FLUX] Impossible de récupérer le flux : {message}',
    '[FEED ERROR] Could not parse the feed.' => '[ERREUR DE FLUX] Impossible d’analyser le flux.',
    '[FEED ERROR] Could not parse the feed. The PHP `simplexml` and `libxml` extensions are required.' => '[ERREUR DE FLUX] Impossible d’analyser le flux. Les extensions PHP `simplexml` et `libxml` sont requises.',
    '[FEED ERROR] Initial feed scan failed: {message}' => '[ERREUR DE FLUX] L’analyse initiale du flux a échoué : {message}',
    '[INVALID NUMBER] The recipient phone number is invalid.' => '[NUMÉRO INVALIDE] Le numéro de téléphone du destinataire est invalide.',
    '[INVALID TYPE] The flash message type is invalid.' => '[TYPE INVALIDE] Le type de message flash est invalide.',
    '[LINK PREVIEW SKIPPED] {reason}' => '[APERÇU DE LIEN IGNORÉ] {reason}',
    '[MISSING IMAGE] Image Attachment field never called the {tag} tag.' => '[IMAGE MANQUANTE] Le champ Pièce jointe image n’a jamais invoqué la balise {tag}.',
    '[MISSING IMAGE] Image Attachment field was empty.' => '[IMAGE MANQUANTE] Le champ Pièce jointe image était vide.',
    '[MISSING IMAGE] The {tag} tag was called, but returned an invalid image.' => '[IMAGE MANQUANTE] La balise {tag} a été invoquée, mais a renvoyé une image non valide.',
    '[MISSING IMAGE] Unable to send Instagram post, the image needs a public URL.' => '[IMAGE MANQUANTE] Impossible d’envoyer la publication Instagram ; l’image nécessite une URL publique.',
    '[NO MEDIA] No image was attached because the {tag} tag was never invoked in the Image Attachment field.' => '[AUCUN MÉDIA] Aucune image n’a été jointe, car la balise {tag} n’a jamais été invoquée dans le champ Pièce jointe image.',
    '[NO RECIPIENTS] The Dynamic Recipients snippet did not call setRecipients.' => '[AUCUN DESTINATAIRE] L’extrait de destinataires dynamiques n’a pas appelé setRecipients.',
    '[NO RECIPIENTS] setRecipients was called with an empty value.' => '[AUCUN DESTINATAIRE] setRecipients a été appelé avec une valeur vide.',
    '[NO RECIPIENT] No MQTT topic was specified.' => '[AUCUN DESTINATAIRE] Aucun sujet MQTT n’a été spécifié.',
    '[NO RECIPIENT] No Slack channel ID was specified.' => '[AUCUN DESTINATAIRE] Aucun ID de canal Slack n’a été spécifié.',
    '[NO RECIPIENT] No ntfy topic was specified.' => '[AUCUN DESTINATAIRE] Aucun sujet ntfy n’a été spécifié.',
    '[NO RECIPIENT] No recipient user was specified for the announcement.' => '[AUCUN DESTINATAIRE] Aucun utilisateur destinataire n’a été spécifié pour l’annonce.',
    '[NO RECIPIENT] No recipient was specified for the email.' => '[AUCUN DESTINATAIRE] Aucun destinataire n’a été spécifié pour l’e-mail.',
    '[NO RECIPIENT] The recipient has no Pushover user key.' => '[AUCUN DESTINATAIRE] Le destinataire n’a pas de clé utilisateur Pushover.',
    '[NO RECIPIENT] The recipient has no phone number.' => '[AUCUN DESTINATAIRE] Le destinataire n’a pas de numéro de téléphone.',
    '[REJECTED BY DISCORD] {error}' => '[REFUSÉ PAR DISCORD] {error}',
    '[REJECTED BY FACEBOOK] {error}' => '[REFUSÉ PAR FACEBOOK] {error}',
    '[REJECTED BY INSTAGRAM] {error}' => '[REFUSÉ PAR INSTAGRAM] {error}',
    '[REJECTED BY MASTODON] {error}' => '[REFUSÉ PAR MASTODON] {error}',
    '[REJECTED BY SLACK] {error}' => '[REFUSÉ PAR SLACK] {error}',
    '[REJECTED BY X (TWITTER)] {error}' => '[REFUSÉ PAR X (TWITTER)] {error}',
    '[SEND FAILED] Authentication failed for {handle}: {reason}' => '[ÉCHEC DE L’ENVOI] Échec de l’authentification pour {handle} : {reason}',
    '[SEND FAILED] Authentication failed: {reason}' => '[ÉCHEC DE L’ENVOI] Échec de l’authentification : {reason}',
    "[SEND FAILED] Could not send the email using Craft's native handling. Check your general email settings within Craft." => '[ÉCHEC DE L’ENVOI] Impossible d’envoyer l’e-mail via la gestion native de Craft. Vérifiez vos paramètres généraux d’e-mail dans Craft.',
    '[SEND FAILED] HTTP {status}: {reason}' => '[ÉCHEC DE L’ENVOI] HTTP {status}: {reason}',
    '[SEND FAILED] {error}' => '[ÉCHEC DE L’ENVOI] {error}',
    '[SEND FAILED] {reason}' => '[ÉCHEC DE L’ENVOI] {reason}',
    '[SKIPPED] Pushover user-key field is not configured on this notification.' => '[IGNORÉ] Le champ de clé utilisateur Pushover n’est pas configuré pour cette notification.',
    '[SKIPPED] Recipient "{name}" cannot access the control panel.' => '[IGNORÉ] Le destinataire « {name} » ne peut pas accéder au panneau de configuration.',
    '[SKIPPED] Recipient "{name}" has no Bluesky credentials.' => '[IGNORÉ] Le destinataire « {name} » n’a pas d’identifiants Bluesky.',
    '[SKIPPED] Recipient "{name}" has no Craft user account.' => '[IGNORÉ] Le destinataire « {name} » n’a pas de compte utilisateur Craft.',
    '[SKIPPED] Recipient "{name}" has no Discord webhook URL.' => '[IGNORÉ] Le destinataire « {name} » n’a pas d’URL de webhook Discord.',
    '[SKIPPED] Recipient "{name}" has no Facebook credentials.' => '[IGNORÉ] Le destinataire « {name} » n’a pas d’identifiants Facebook.',
    '[SKIPPED] Recipient "{name}" has no Instagram credentials.' => '[IGNORÉ] Le destinataire « {name} » n’a pas d’identifiants Instagram.',
    '[SKIPPED] Recipient "{name}" has no MQTT topic.' => '[IGNORÉ] Le destinataire « {name} » n’a pas de sujet MQTT.',
    '[SKIPPED] Recipient "{name}" has no Mastodon credentials.' => '[IGNORÉ] Le destinataire « {name} » n’a pas d’identifiants Mastodon.',
    '[SKIPPED] Recipient "{name}" has no Slack bot token.' => '[IGNORÉ] Le destinataire « {name} » n’a pas de jeton de bot Slack.',
    '[SKIPPED] Recipient "{name}" has no Slack channel ID.' => '[IGNORÉ] Le destinataire « {name} » n’a pas d’ID de canal Slack.',
    '[SKIPPED] Recipient "{name}" has no X (Twitter) credentials.' => '[IGNORÉ] Le destinataire « {name} » n’a pas d’identifiants X (Twitter).',
    '[SKIPPED] Recipient "{name}" has no email address.' => '[IGNORÉ] Le destinataire « {name} » n’a pas d’adresse e-mail.',
    '[SKIPPED] Recipient "{name}" has no ntfy topic.' => '[IGNORÉ] Le destinataire « {name} » n’a pas de sujet ntfy.',
    '[SKIPPED] Recipient "{name}" has no phone number.' => '[IGNORÉ] Le destinataire « {name} » n’a pas de numéro de téléphone.',
    '[SKIPPED] The configured {kind} no longer exists in the plugin settings (uid: {uid}).' => '[IGNORÉ] Le {kind} configuré n’existe plus dans les réglages du plugin (uid : {uid}).',
    '[SKIPPED] Unrecognized recipient "{value}".' => '[IGNORÉ] Destinataire non reconnu « {value} ».',
    '[SKIPPED] Unrecognized recipient of type "{type}".' => '[IGNORÉ] Destinataire de type non reconnu « {type} ».',
    '[TOO LONG] The Discord message body exceeds the 2000-character limit.' => '[TROP LONG] Le corps du message Discord dépasse la limite de 2000 caractères.',
    '[TRUNCATED] Body exceeded {max} characters.' => '[TRONQUÉ] Le corps a dépassé {max} caractères.',
    '[TRUNCATED] Caption exceeded {max} characters.' => '[TRONQUÉ] La légende a dépassé {max} caractères.',
];
