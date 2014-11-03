<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| MDC Errors
|--------------------------------------------------------------------------
|
| List of error messages
|
*/

$today = date('Y-m-d');

// LanguageCode: liste des langues
$config['errorMessages'] = array(
    'MD_FileIdentifier' => array(
        'errorType'     => 'empty',
        'cellName'      => 'MD_FileIdentifier',
        'description'   => 'identifiant unique',
        'message'       => 'Un identifiant unique doit être renseigné. Un identifiant unique est généré automatiquement.',
        'defaultValue'  => ''
    ),
    'MD_Language' => array(
        'errorType'     => 'empty',
        'cellName'      => 'MD_Language',
        'description'   => 'langue de la fiche de métadonnées',
        'message'       => 'Une langue pour la fiche de métadonnées doit être renseignée. La valeur par défaut est le français (fre).',
        'defaultValue'  => '1 - Français'
    ),
    'MD_CharacterSet' => array(
        'errorType'     => 'empty',
        'cellName'      => 'MD_CharacterSet',
        'description'   => 'encodage de la fiche de métadonnées',
        'message'       => 'Un encodage pour la fiche de métadonnées doit être renseigné. La valeur par défaut est utf8.',
        'defaultValue'  => '4 - utf8'
    ),
    'MD_HierarchyLevel' => array(
        'errorType'     => 'empty',
        'cellName'      => 'MD_HierarchyLevel',
        'description'   => 'type de ressource décrite',
        'message'       => 'Un type de ressource décrite doit être renseigné. La valeur par défaut est "Jeu de données" (dataset).',
        'defaultValue'  => '5 - Jeu de données'
    ),
    'MD_Contacts' => array(
        'errorType'     => 'empty',
        'cellName'      => 'MD_Contacts',
        'description'   => 'contact pour la fiche de métadonnées',
        'message'       => 'Au moins un contact pour la fiche de métadonnées doit être renseigné (nom de l\'organisme et un email).',
        'defaultValue'  => ''
    ),
    'MD_CntRole' => array(
        'errorType'     => 'empty',
        'cellName'      => 'MD_CntRole',
        'description'   => 'rôle du contact',
        'message'       => 'Un rôle pour chaque contact doit être renseigné. La valeur par défaut est "point de contact" (pointOfContact).',
        'defaultValue'  => '7 - Point de contact'
    ),
    'MD_DateStamp' => array(
        'errorType'     => 'empty',
        'cellName'      => 'MD_DateStamp',
        'description'   => 'date de création/édition de la fiche de métadonnées',
        'message'       => 'Une date de création/édition de la fiche de métadonnées doit être renseignée. La valeur par défaut est la date de génération du fichier XML.',
        'defaultValue'  => $today
    ),
    'Data_Title' => array(
        'errorType'     => 'empty',
        'cellName'      => 'Data_Title',
        'description'   => 'titre de la donnée',
        'message'       => 'Le titre de la donnée doit être renseigné.',
        'defaultValue'  => ''
    ),
    'Data_Abstract' => array(
        'errorType'     => 'empty',
        'cellName'      => 'Data_Abstract',
        'description'   => 'résumé décrivant la donnée',
        'message'       => 'Un résumé décrivant la donnée doit être renseigné.',
        'defaultValue'  => ''
    ),
    'Data_Date' => array(
        'errorType'     => 'empty',
        'cellName'      => 'Data_Date',
        'description'   => 'date de création, édition ou publication de la donnée',
        'message'       => 'Une date de création, d\'édition ou de publication des données doit être renseignée.',
        'defaultValue'  => ''
    ),
    'Data_Language' => array(
        'errorType'     => 'empty',
        'cellName'      => 'Data_Language',
        'description'   => 'langue des données',
        'message'       => 'Une langue doit être renseignée pour les données.',
        'defaultValue'  => ''
    ),
    'Data_Identifier' => array(
        'errorType'     => 'empty',
        'cellName'      => 'Data_Identifier',
        'description'   => 'identifiant de la donnée',
        'message'       => 'Un identifiant de la donnée doit être renseigné. Par défaut, la valeur utilisée est celle de l\'identifiant unique de la fiche de métadonnées (MD_FileIdentifier).',
        'defaultValue'  => ''
    ),
    'Data_TopicCategory' => array(
        'errorType'     => 'empty',
        'cellName'      => 'Data_TopicCategory',
        'description'   => 'catégorie internationale',
        'message'       => 'Une catégorie internationale doit être renseignée.',
        'defaultValue'  => ''
    ),
    'Data_InspireKeyword' => array(
        'errorType'     => 'empty',
        'cellName'      => 'Data_InspireKeyword',
        'description'   => 'thème INSPIRE',
        'message'       => 'Un thème de la classification européenne INSPIRE doit être renseigné.',
        'defaultValue'  => ''
    ),
    /*
    'Data_CntOrganism' => array(
        'errorType'     => 'empty',
        'cellName'      => 'Data_CntOrganism',
        'description'   => 'organisme du contact',
        'message'       => 'Un organisme doit être renseigné pour chaque contact de la donnée.',
        'defaultValue'  => ''
    ),
    'Data_CntEmail' => array(
        'errorType'     => 'empty',
        'cellName'      => 'Data_CntEmail',
        'description'   => 'adresse email du contact',
        'message'       => 'Une adresse email doit être renseignée pour chaque contact de la donnée.',
        'defaultValue'  => ''
    ),
    */
    'Data_CntRole' => array(
        'errorType'     => 'empty',
        'cellName'      => 'Data_CntRole',
        'description'   => 'rôle du contact',
        'message'       => 'Un rôle doit être renseigné pour chaque contact de la donnée.',
        'defaultValue'  => ''
    ),
    'Data_GeographicExtent' => array(
        'errorType'     => 'empty',
        'cellName'      => 'Data_GeographicExtent',
        'description'   => 'emprise des données',
        'message'       => 'Une emprise de la donnée doit être renseignée.',
        'defaultValue'  => ''
    ),
    'Data_ReferenceSystem' => array(
        'errorType'     => 'empty',
        'cellName'      => 'Data_ReferenceSystem',
        'description'   => 'système de projection des données',
        'message'       => 'Un système de projection doit être renseigné.',
        'defaultValue'  => ''
    ),
    'LI_Statement' => array(
        'errorType'     => 'empty',
        'cellName'      => 'LI_Statement',
        'description'   => 'texte sur la qualité des données',
        'message'       => 'Un texte sur la qualité doit être renseigné.',
        'defaultValue'  => ''
    ),
    'Data_Scale' => array(
        'errorType'     => 'empty',
        'cellName'      => 'Data_Scale',
        'description'   => 'échelle ou résolution des données',
        'message'       => 'Une échelle ou une résolution doit être renseignée.',
        'defaultValue'  => ''
    ),
    /*
    'DQ_InspireConformity' => array(
        'errorType'     => 'empty',
        'cellName'      => 'DQ_InspireConformity',
        'description'   => 'conformité des données aux spécifications INSPIRE',
        'message'       => 'Une conformité aux règles d\'implémentation INSPIRE doit être renseignée.',
        'defaultValue'  => ''
    ),
    */
    'DQ_InspireConformityDate' => array(
        'errorType'     => 'empty',
        'cellName'      => 'DQ_InspireConformityDate',
        'description'   => 'date de publication des spécifications INSPIRE',
        'message'       => 'Une date doit être renseignée pour les spécifications INSPIRE.',
        'defaultValue'  => ''
    ),
    'DQ_SpecificationDate' => array(
        'errorType'     => 'empty',
        'cellName'      => 'DQ_SpecificationDate',
        'description'   => 'date de publication des spécifications',
        'message'       => 'Une date doit être renseignée pour les spécifications.',
        'defaultValue'  => ''
    ),
    'Data_CharacterSet' => array(
        'errorType'     => 'empty',
        'cellName'      => 'Data_CharacterSet',
        'description'   => 'encodage des données',
        'message'       => 'Un encodage pour pour les données doit être renseigné. La valeur par défaut est utf8.',
        'defaultValue'  => '4 - utf8'
    ),
    'Data_DistFormat' => array(
        'errorType'     => 'empty',
        'cellName'      => 'Data_DistFormat',
        'description'   => 'format de diffusion des données',
        'message'       => 'Un format de diffusion de la donnée doit être renseigné.',
        'defaultValue'  => ''
    ),
    'Data_Classification' => array(
        'errorType'     => 'empty',
        'cellName'      => 'Data_Classification',
        'description'   => 'niveau de confidentialité des données',
        'message'       => 'Un niveau de confidentialité de la donnée doit être renseigné.',
        'defaultValue'  => '1 - Non classifié'
    ),
    'Data_AccessConstraint' => array(
        'errorType'     => 'empty',
        'cellName'      => 'Data_AccessConstraint',
        'description'   => 'contraintes d\'accès aux données',
        'message'       => 'Une contrainte d\'accès aux donées doit être renseigné.',
        'defaultValue'  => ''
    ),
    'Data_UseLimitation' => array(
        'errorType'     => 'empty',
        'cellName'      => 'Data_UseLimitation',
        'description'   => 'conditions d\'utilisation des données',
        'message'       => 'Une condition d\'utilisation des données doit être renseignée.',
        'defaultValue'  => ''
    ),
    'Data_SpatialRepresentationType' => array(
        'errorType'     => 'empty',
        'cellName'      => 'Data_SpatialRepresentationType',
        'description'   => 'type de représentation spatiale des données (raster/vecteur))',
        'message'       => 'Un type de représentation spatiale (raster ou vecteur) doit être renseigné.',
        'defaultValue'  => ''
    ),
    'Data_Contacts' => array(
        'errorType'     => 'empty',
        'cellName'      => 'Data_Contacts',
        'description'   => 'contact pour les données',
        'message'       => 'Un contact pour les données doit être renseigné.',
        'defaultValue'  => ''
    ),
    'Data_MaintenanceFrequency' => array(
        'errorType'     => 'empty',
        'cellName'      => 'Data_MaintenanceFrequency',
        'description'   => 'fréquence de mise  à jour des données',
        'message'       => 'Une fréquence de mise à jour des données doit être renseignée. La valeur par défaut est inconnu (unknown).',
        'defaultValue'  => '12 - inconnu'
    ),
);
