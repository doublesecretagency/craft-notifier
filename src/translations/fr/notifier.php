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

    // Event tab
    'Event Type'                                           => 'Type d’événement',
    'What type of event will activate the notification?'   => 'Quel type d’événement activera la notification ?',
    'Which specific event will activate the notification?' => 'Quel événement spécifique activera la notification ?',
    'Assets Event'                                         => 'Événement de média',
    'Commerce Orders Event'                                => 'Événement de commande Commerce',
    'Entries Event'                                        => 'Événement d’entrée',
    'Users Event'                                          => 'Événement d’utilisateur',

    // Field and element conditions
    'Field Conditions'                                                               => 'Conditions de champ',
    'Send the message only when the saved element matches the following conditions.' => 'Envoyer le message uniquement lorsque l’élément enregistré remplit les conditions suivantes.',
    'has changed'                                                                    => 'a changé',
    '#{elementType} Event Filters'                                                   => 'Filtres d’événement #{elementType}',
    'No filters match this event.'                                                   => 'Aucun filtre ne correspond à cet événement.',
    'Determine whether each message should be sent based on specified conditions.'   => 'Déterminez si chaque message doit être envoyé en fonction des conditions spécifiées.',

    // Filters: entry lifecycle (new vs existing)
    'Element is being saved for the first time' => 'L’élément est enregistré pour la première fois',
    'Must be a new entry'                       => 'Doit être une nouvelle entrée',
    'Must be an existing entry'                 => 'Doit être une entrée existante',
    'Can be existing or new'                    => 'Peut être existante ou nouvelle',

    // Filters: new elements
    'Element is new'         => 'L’élément est nouveau',
    'New elements only'      => 'Nouveaux éléments uniquement',
    'Existing elements only' => 'Éléments existants uniquement',

    // Filters: enabled state
    'Element is enabled'         => 'L’élément est activé',
    'Must be enabled'            => 'Doit être activé',
    'Must be disabled'           => 'Doit être désactivé',
    'Can be enabled or disabled' => 'Peut être activé ou désactivé',

    // Filters: drafts
    'Element is a draft'          => 'L’élément est un brouillon',
    'Must be a draft'             => 'Doit être un brouillon',
    'Must not be a draft'         => 'Ne doit pas être un brouillon',
    'Can be a draft or non-draft' => 'Peut être un brouillon ou non',

    // Filters: provisional drafts
    'Element is a provisional draft'                => 'L’élément est un brouillon provisoire',
    'Must be a provisional draft'                   => 'Doit être un brouillon provisoire',
    'Must not be a provisional draft'               => 'Ne doit pas être un brouillon provisoire',
    'Can be a provisional draft or non-provisional' => 'Peut être provisoire ou non provisoire',

    // Filters: revisions
    'Element is a revision'             => 'L’élément est une révision',
    'Must be a revision'                => 'Doit être une révision',
    'Must not be a revision'            => 'Ne doit pas être une révision',
    'Can be a revision or non-revision' => 'Peut être une révision ou non',

    // Filters: duplication
    'Element is being duplicated'         => 'L’élément est en cours de duplication',
    'Must be duplicating the element'     => 'Doit dupliquer l’élément',
    'Must not be duplicating the element' => 'Ne doit pas dupliquer l’élément',

    // Filters: propagation
    'Element is being propagated'     => 'L’élément est en cours de propagation',
    'Element must be propagating'     => 'L’élément doit être en cours de propagation',
    'Element must not be propagating' => 'L’élément ne doit pas être en cours de propagation',

    // Filters: bulk-resave
    'Element is being bulk-resaved'         => 'L’élément est en cours de réenregistrement en lot',
    'Must be bulk-resaving the element'     => 'Doit réenregistrer l’élément en lot',
    'Must not be bulk-resaving the element' => 'Ne doit pas réenregistrer l’élément en lot',

    // Filters: common output
    'Unnamed filter'                => 'Filtre sans nom',
    'Must be TRUE to send message'  => 'Doit valoir TRUE pour envoyer le message',
    'Must be FALSE to send message' => 'Doit valoir FALSE pour envoyer le message',
    'No effect'                     => 'Aucun effet',

    // Message tab: type selector and queue
    'Message Type'                                                 => 'Type de message',
    'What type of message will be sent?'                           => 'Quel type de message sera envoyé ?',
    'Send Message via Queue'                                       => 'Envoyer le message via la file d’attente',
    'Should the message be sent via the [jobs queue]({queueUrl})?' => 'Le message doit-il être envoyé via la [file d’attente des tâches]({queueUrl}) ?',

    // Email message
    'Email Subject'              => 'Objet de l’e-mail',
    'Email Body'                 => 'Corps de l’e-mail',
    "User's Email Address Field" => 'Champ adresse e-mail de l’utilisateur',

    // SMS message
    'SMS Message Body'          => 'Corps du message SMS',
    "User's Phone Number Field" => 'Champ numéro de téléphone de l’utilisateur',

    // Announcement message
    'Announcement Title'   => 'Titre de l’annonce',
    'Announcement Message' => 'Message de l’annonce',

    // Flash message
    'Flash Message Type'                         => 'Type de message flash',
    'Flash Message Title'                        => 'Titre du message flash',
    'Flash Message Details'                      => 'Détails du message flash',
    'Which type of flash message should appear?' => 'Quel type de message flash doit apparaître ?',

    // Trix toolbar (rich-text editing)
    'Rich Text'     => 'Texte enrichi',
    'Bold'          => 'Gras',
    'Italic'        => 'Italique',
    'Underline'     => 'Souligné',
    'Strikethrough' => 'Barré',
    'Bullets'       => 'Puces',
    'Numbers'       => 'Numéros',
    'Heading'       => 'Titre',
    'Code'          => 'Code',
    'Undo'          => 'Annuler',
    'Redo'          => 'Rétablir',

    // Email body instructions (HTML)
    'Body of outgoing email. You can use <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">special variables</a>, or even <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">skip recipients</a>.' => 'Corps de l’e-mail sortant. Vous pouvez utiliser des <a href="https://plugins.doublesecretagency.com/notifier/messages/variables" target="_blank">variables spéciales</a>, voire <a href="https://plugins.doublesecretagency.com/notifier/messages/skip" target="_blank">ignorer les destinataires</a>.',

    // Recipients tab
    'Recipients Type'                             => 'Type de destinataires',
    'Who will receive this message?'              => 'Qui recevra ce message ?',
    'Add a message recipient'                     => 'Ajouter un destinataire',
    'Select User(s)'                              => 'Sélectionner un ou plusieurs utilisateurs',
    'Which users will receive the message?'       => 'Quels utilisateurs recevront le message ?',
    'Which user groups will receive the message?' => 'Quels groupes d’utilisateurs recevront le message ?',
    'Restricted to Admins Only?'                  => 'Réservé aux administrateurs ?',
    'Ungrouped Users'                             => 'Utilisateurs sans groupe',
    'Twig Snippet to Determine Recipients'        => 'Extrait Twig pour déterminer les destinataires',

    // Settings: Twilio
    'Twilio Account SID'                             => 'Twilio Account SID',
    'Twilio Auth Token'                              => 'Twilio Auth Token',
    'Twilio phone number (sends each SMS message)'   => 'Numéro de téléphone Twilio (envoie chaque message SMS)',
    'This is being set in the config file. [{file}]' => 'Défini dans le fichier de configuration. [{file}]',

    // Settings: Logging
    'Logging'                                                                                                                                         => 'Journalisation',
    'Enable Logging'                                                                                                                                  => 'Activer la journalisation',
    'When disabled, Notifier will not write anything to the notification log.'                                                                        => 'Lorsque désactivée, Notifier n’écrit rien dans le journal des notifications.',
    'Notifier keeps an ongoing log of sent messages. While not typically necessary, you can limit the amount of log events recorded in the database.' => 'Notifier conserve un journal continu des messages envoyés. Bien que cela ne soit généralement pas nécessaire, vous pouvez limiter le nombre d’événements enregistrés dans la base de données.',
    'Number of log events to retain'                                                                                                                  => 'Nombre d’événements de journal à conserver',
    'At most, keep this many log events. Leave blank for no limit.'                                                                                   => 'Conserver au maximum ce nombre d’événements de journal. Laisser vide pour aucune limite.',
    'Number of days to retain log events'                                                                                                             => 'Nombre de jours de conservation des événements de journal',
    'At most, keep log events for this many days. Leave blank for no limit.'                                                                          => 'Conserver les événements de journal pendant ce nombre de jours au maximum. Laisser vide pour aucune limite.',

    // Test notification
    'Send a test message'                                                                                                          => 'Envoyer un message de test',
    'Are you certain you want to send a test notification?\n\nThe configured message will be sent to the configured recipient(s).' => 'Voulez-vous vraiment envoyer une notification de test ?\n\nLe message configuré sera envoyé aux destinataires configurés.',
    'Test'                                                                                                                         => 'Test',
    'Test notification dispatched.'                                                                                                => 'Notification de test envoyée.',
    'No messages were dispatched. Check the recipient configuration.'                                                              => 'Aucun message n’a été envoyé. Vérifiez la configuration des destinataires.',

    // Runtime / log feedback
    'Sending {messageType} to {recipient}.' => 'Envoi de {messageType} à {recipient}.',
    'Log events deleted.'                   => 'Événements de journal supprimés.',
    'notification'                          => 'notification',

    // Errors
    'Invalid email message mode.'                                    => 'Mode de message e-mail non valide.',
    'Dynamic recipients snippet did not call setRecipients.'         => 'L’extrait des destinataires dynamiques n’a pas appelé setRecipients.',
    'setRecipients was called with an empty value.'                  => 'setRecipients a été appelé avec une valeur vide.',
    'Unrecognized recipient "{value}".'                              => 'Destinataire non reconnu "{value}".',
    'Unrecognized recipient of type "{type}".'                       => 'Destinataire de type "{type}" non reconnu.',
    'Recipient "{name}" has no email address.'                       => 'Le destinataire "{name}" n’a pas d’adresse e-mail.',
    'Recipient "{name}" has no phone number.'                        => 'Le destinataire "{name}" n’a pas de numéro de téléphone.',
    'You do not have permission to use the Dynamic Recipients type.' => 'Vous n’avez pas la permission d’utiliser le type Destinataires dynamiques.',

];
