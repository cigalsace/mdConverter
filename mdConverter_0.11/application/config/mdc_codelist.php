<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| MDC Codelist
|--------------------------------------------------------------------------
|
| List of codes for metadata files
|
*/

// LanguageCode: liste des langues
$config['codelist']['LanguageCode'] = array(
				'fra' => '1 - Français',
                'fre' => '1 - Français', // Prioritaire sur "fra"
                'eng' => '2 - Anglais',
                'ger' => '3 - Allemand',
                );
$config['codelist']['LanguageCode2'] = array_flip($config['codelist']['LanguageCode']);

// B5.10	CharacterSetCode
$config['codelist']['CharacterSetCode'] = array(
				'ucs2' => '1 - ucs2',
                'ucs4' => '2 - ucs4',
                'utf7' => '3 - utf7',
                'utf8' => '4 - utf8',
                'utf16' => '5 - utf16',
                '8859part1' => '6 - 8859part1',
                '8859part15' => '20 - 8859part15',
                '8859part16' => '21 - 8859part16',
                '8859part2' => '7 - 8859part2',
                '8859part3' => '8 - 8859part3',
                '8859part4' => '9 - 8859part4',
                '8859part5' => '10 - 8859part5',
                '8859part6' => '11 - 8859part6',
                '8859part7' => '12 - 8859part7',
                '8859part8' => '13 - 8859part8',
                '8859part9' => '14 - 8859part9',
                '8859part10' => '15 - 8859part10',
                '8859part11' => '16 - 8859part11',
                'reserved' => '17 - reserved',
                '8859part13' => '18 - 8859part13',
                '8859part14' => '19 - 8859part14',
                'jis' => '22 - jis',
                'shiftJIS' => '23 - shiftJIS',
                'eucJP' => '24 - eucJP',
                'usAscii' => '25 - usAscii',
                'ebcdic' => '26 - ebcdic',
                'eucKR' => '27 - eucKR',
                'big5' => '28 - big5',
                'GB2312' => '29 - GB2312'
                );
$config['codelist']['CharacterSetCode2'] = array_flip($config['codelist']['CharacterSetCode']);                

// ScopeCode: liste des type de données décrites
// B5.25
$config['codelist']['ScopeCode'] = array(
				'attribute' => '1 - Attribut',
                'attributeType' => '2 - Type d’attribut',
                'collectionHardware' => '3 - Collection matérielle',
                'collectionSession' => '4 - Collection de session',
                'dataset' => '5 - Jeu de données',
                'series' => '6 - Collection de données',
                'nonGeographicDataset' => '7 - Jeu de données non géographique',
                'dimensionGroup' => '8 - Dimension d’un groupe',
                'feature' => '9 - Entité',
                'featureType' => '10 - Type d’entité',
                'propertyType' => '11 - Type de propriété',
                'software' => '12 - Logiciel',
                'fieldSession' => '13 - Champ de Session',
                'service' => '14 - Service',
                'model' => '15 - Modèle',
                'tile' => '16 - Sous-ensemble de données',
                'fieldCampaign' => '17 - Campagne de mesures',
                );
$config['codelist']['ScopeCode2'] = array_flip($config['codelist']['ScopeCode']);

// RoleCode: liste des rôles
// B5.5
$config['codelist']['RoleCode'] = array(
			'resourceProvider' => '1 - Fournisseur',
            'custodian' => '2 - Gestionnaire',
            'owner' => '3 - Propriétaire',
            'pointOfContact' => '7 - Point de contact',
            'author' => '11 - Auteur',
            'user' => '4 - Utilisateur',
            'distributor' => '5 - Distributeur',
            'originator' => '6 - Commanditaire',
            'principalInvestigator' => "8 - Producteur / Maître d’œuvre principal ou d'ensemble",
            'processor' => '9 - Intégrateur / Exécutant secondaire',
            'publisher' => '10 - Editeur'
);
$config['codelist']['RoleCode2'] = array_flip($config['codelist']['RoleCode']);

// ClassificationCode: liste des type de mots-clés
// B5.11
$config['codelist']['ClassificationCode'] = array(
						'unclassified' => '1 - Non classifié',
						'restricted' => '2 - Restreint',
						'confidential' => '3 - Confidentiel',
						'secret' => '4 - Secret',
						'topSecret' => '5 - Top secret'
                     );
$config['codelist']['ClassificationCode2'] = array_flip($config['codelist']['ClassificationCode']);

// KeywordTypeCode: liste des type de mots-clés
// B5.17
$config['codelist']['KeywordTypeCode'] = array(
					'discipline' => '1 - Discipline',
                    'place' => '2 - Localisation',
                    'stratum' => '3 - Strate',
                    'temporal' => '4 - Temps',
                    'theme' => '5 - Thème'
                    );
$config['codelist']['KeywordTypeCode2'] = array_flip($config['codelist']['KeywordTypeCode']);

// MaintenanceFrequencyCode
// B.5.18
$config['codelist']['MaintenanceFrequencyCode'] = array(
					'continual' => '1 - en continu',
                    'daily' => '2 - quotidien',
                    'weekly' => '3 - hebdomadaire',
                    'fortnightly' => '4 - tous les 15 jours',
                    'monthly' => '5 - mensuel',
                    'quaterly' => '6 - trimestriel',
                    'biannually' => '7 - semestriel',
                    'annually' => '8 - annuel',
                    'asNeeded' => '9 - quand nécessaire',
                    'irregular' => '10 - irrégulier',
                    'notPlanned' => '11 - non plannifié',
                    'unknown' => '12 - inconnu'
                    );
$config['codelist']['MaintenanceFrequencyCode2'] = array_flip($config['codelist']['MaintenanceFrequencyCode']);

// DateTypeCode
// B.5.2
$config['codelist']['DateTypeCode'] = array(
					'creation' => '1 - Création',
                    'publication' => '2 - Publication',
                    'revision' => '3 - Révision'
                    );
$config['codelist']['DateTypeCode2'] = array_flip($config['codelist']['DateTypeCode']);
  
// RestrictionCode: liste des contraintes d'accès
// B5.24
$config['codelist']['RestrictionCode'] = array(
					'none' => '0 - Aucune',
                    'copyright' => '1 - Droit d’auteur / Droit moral (copyright)',
                    'patent' => '2 - Brevet',
                    'patentPending' => '3 - Brevet en instance',
                    'trademark' => '4 - Marque de commerce',
                    'license' => '5 - Licence',
                    'intellectualPropertyRights' => '6 - Droit de propriété intellectuelle / Droit patrimonial',
                    'restricted' => '7 - Restreint',
                    'otherRestrictions' => '8 - Autres restrictions'
                    );
$config['codelist']['RestrictionCode2'] = array_flip($config['codelist']['RestrictionCode']);

// SpatialRepresentationTypeCode: liste des type de représentation
// B5.26
$config['codelist']['SpatialRepresentationTypeCode'] = array(
					'vector' => '1 - Vecteur',
                    'grid' => '2 - Raster',
                    'textTable' => '3 - Table texte',
                    'tin' => '4 - Tin',
                    'stereoModel' => '5 - Vue 3D',
                    'video' => '6 - Vidéo'
                    );
$config['codelist']['SpatialRepresentationTypeCode2'] = array_flip($config['codelist']['SpatialRepresentationTypeCode']);

// TopicCategoryCode: liste des thèmes ISO
// B5.27
$config['codelist']['TopicCategoryCode'] = array(
					'farming' => '1 - Agriculture',
                    'biota' => '2 - Flore et faune',
                    'boundaries' => '3 - Limites politiques et administratives',
                    'climatologyMeteorologyAtmosphere' => '4 - Climatologie, météorologie',
                    'economy' => '5 - Economie',
                    'elevation' => '6 - Topographie',
                    'environment' => '7 - Ressources et gestion de l’environnement',
                    'geoscientificInformation' => '8 - Géosciences',
                    'health' => '9 - Santé',
                    'imageryBaseMapsEarthCover' => '10 - Carte de référence de la couverture terrestre',
                    'intelligenceMilitary' => '11 - Infrastructures militaires',
                    'inlandWaters' => '12 - Hydrographie',
                    'location' => '13 - Localisant',
                    'oceans' => '14 - Océans',
                    'planningCadastre' => '15 - Planification et aménagement du territoire',
                    'society' => '16 - Société',
                    'structure' => '17 - Aménagements urbains',
                    'transportation' => '18 - Infrastructures de transport',
                    'utilitiesCommunication' => '19 - Réseaux de télécommunication, d’énergie'
                    );
$config['codelist']['TopicCategoryCode2'] = array_flip($config['codelist']['TopicCategoryCode']);


// InspireThemeCode: liste des thèmes inspire
//
$config['codelist']['InspireThemeCode_en'] = array(
                    'Coordinate reference systems' => '1 - Référentiels de coordonnées',
                    'Geographical grid systems' => '2 - Systèmes de maillage géographique',
                    'Geographical names' => '3 - Dénominations géographiques',
                    'Administrative units' => '4 - Unités administratives',
                    'Addresses' => '5 - Adresses',
                    'Cadastral parcels' => '6 - Parcelles cadastrales',
                    'Transport networks' => '7 - Réseaux de transport',
                    'Hydrography' => '8 - Hydrographie',
                    'Protected sites' => '9 - Sites protégés',
                    'Elevation' => '10 - Altitude',
                    'Land cover' => '11 - Occupation des terres',
                    'Orthoimagery' => '12 - Ortho-imagerie',
                    'Geology' => '13 - Géologie',
                    'Statistical units' => '14 - Unités statistiques',
                    'Buildings' => '15 - Bâtiments',
                    'Soil' => '16 - Sols',
                    'Land use' => '17 - Usage des sols',
                    'Human health and safety' => '18 - Santé et sécurité des personnes',
                    'Utility and governmental services' => '19 - Services d\'utilité publique et services publics',
                    'Environmental monitoring facilities' => '20 - Installations de suivi environnemental',
                    'Production and industrial facilities' => '21 - Lieux de production et sites industriels',
                    'Agricultural and aquaculture facilities' => '22 - Installations agricoles et aquacoles',
                    'Population distribution - demography' => '23 - Répartition de la population – démographie',
                    'Area management/restriction/regulation zones and reporting units' => '24 - Zones de gestion, de restriction ou de réglementation et unités de déclaration',
                    'Natural risk zones' => '25 - Zones à risque naturel',
                    'Atmospheric conditions' => '26 - Conditions atmosphériques',
                    'Meteorological geographical features' => '27 - Caractéristiques géographiques météorologiques',
                    'Oceanographic geographical features' => '28 - Caractéristiques géographiques océanographiques',
                    'Sea regions' => '29 - Régions maritimes',
                    'Bio-geographical regions' => '30 - Régions biogéographiques',
                    'Habitats and biotopes' => '31 - Habitats et biotopes',
                    'Species distribution' => '32 - Répartition des espèces',
                    'Energy resources' => '33 - Sources d\'énergie',
                    'Mineral resources' => '34 - Ressources minérales'
                    );
$config['codelist']['InspireThemeCode_fr'] = array(
                    'Référentiels de coordonnées' => '1 - Référentiels de coordonnées', // 'Coordinate reference systems'
                    'Systèmes de maillage géographique' => '2 - Systèmes de maillage géographique', // 'Geographical grid systems'
                    'Dénominations géographiques' => '3 - Dénominations géographiques', //'Geographical names'
                    'Unités administratives' => '4 - Unités administratives', // 'Administrative units'
                    'Adresses' => '5 - Adresses', // 'Addresses'
                    'Parcelles cadastrales' => '6 - Parcelles cadastrales', // 'Cadastral parcels'
                    'Réseaux de transport' => '7 - Réseaux de transport', // 'Transport networks'
                    'Hydrographie' => '8 - Hydrographie', // 'Hydrography'
                    'Sites protégés' => '9 - Sites protégés', // 'Protected sites'
                    'Altitude' => '10 - Altitude', // 'Elevation'
                    'Occupation des terres' => '11 - Occupation des terres', // 'Land cover'
                    'Ortho-imagerie' => '12 - Ortho-imagerie', // 'Orthoimagery'
                    'Géologie' => '13 - Géologie', // 'Geology'
                    'Unités statistiques' => '14 - Unités statistiques', // 'Statistical units'
                    'Bâtiments' => '15 - Bâtiments', // 'Buildings'
                    'Sols' => '16 - Sols', // 'Soil'
                    'Usage des sols' => '17 - Usage des sols', // 'Land use'
                    'Santé et sécurité des personnes' => '18 - Santé et sécurité des personnes', // 'Human health and safety'
                    'Services d\'utilité publique et services publics' => '19 - Services d\'utilité publique et services publics', // 'Utility and governmental services'
                    'Installations de suivi environnemental' => '20 - Installations de suivi environnemental', // 'Environmental monitoring facilities'
                    'Lieux de production et sites industriels' => '21 - Lieux de production et sites industriels', // 'Production and industrial facilities'
                    'Installations agricoles et aquacoles' => '22 - Installations agricoles et aquacoles', // 'Agricultural and aquaculture facilities'
                    'Répartition de la population – démographie' => '23 - Répartition de la population – démographie', // 'Population distribution - demography'
                    'Zones de gestion, de restriction ou de réglementation et unités de déclaration' => '24 - Zones de gestion, de restriction ou de réglementation et unités de déclaration', // 'Area management/restriction/regulation zones and reporting units'
                    'Zones à risque naturel' => '25 - Zones à risque naturel', // 'Natural risk zones' 
                    'Conditions atmosphériques' => '26 - Conditions atmosphériques', // 'Atmospheric conditions'
                    'Caractéristiques géographiques météorologiques' => '27 - Caractéristiques géographiques météorologiques', // 'Meteorological geographical features'
                    'Caractéristiques géographiques océanographiques' => '28 - Caractéristiques géographiques océanographiques', // 'Oceanographic geographical features'
                    'Régions maritimes' => '29 - Régions maritimes', // 'Sea regions'
                    'Régions biogéographiques' => '30 - Régions biogéographiques', // 'Bio-geographical regions'
                    'Habitats et biotopes' => '31 - Habitats et biotopes', // 'Habitats and biotopes'
                    'Répartition des espèces' => '32 - Répartition des espèces', // 'Species distribution'
                    'Sources d\'énergie' => '33 - Sources d\'énergie', // 'Energy resources'
                    'Ressources minérales' => '34 - Ressources minérales' // 'Mineral resources'
                    );
$config['codelist']['InspireThemeCode'] = array_merge($config['codelist']['InspireThemeCode_en'], $config['codelist']['InspireThemeCode_fr']);
$config['codelist']['InspireThemeCode2'] = array_flip($config['codelist']['InspireThemeCode_fr']);

// PassCode
//
$config['codelist']['PassCode'] = array(
							'true' => '1 - Conforme',
                            'false' => '2 - Non conforme',
                            0 => '3 - Non évalué'
                            );
$config['codelist']['PassCode2'] = array_flip($config['codelist']['PassCode']);

// X0.0	InspireSpecificationCode
//
$config['codelist']['InspireSpecificationCode'] = array( 
                            'COMMISSION REGULATION (EC) No 1205/2008 of 3 December 2008 implementing Directive 2007/2/EC of the European Parliament and of the Council as regards metadata' => '1 - COMMISSION REGULATION (EC) No 1205/2008 of 3 December 2008 implementing Directive 2007/2/EC of the European Parliament and of the Council as regards metadata (publication:2008-12-04)',
                            'Corrigendum to INSPIRE Metadata Regulation published in the Official Journal of the European Union, L 328, page 83' => '2 - Corrigendum to INSPIRE Metadata Regulation published in the Official Journal of the European Union, L 328, page 83 (publication:2009-12-15)',
                            'COMMISSION REGULATION (EU) No 1089/2010 of 23 November 2010 implementing Directive 2007/2/EC of the European Parliament and of the Council as regards interoperability of spatial data sets and services' => '3 - COMMISSION REGULATION (EU) No 1089/2010 of 23 November 2010 implementing Directive 2007/2/EC of the European Parliament and of the Council as regards interoperability of spatial data sets and services (publication:2010-12-08)',
                            'COMMISSION REGULATION (EU) No 1088/2010 of 23 November 2010 amending Regulation (EC) No 976/2009 as regards download services and transformation services' => '4 - COMMISSION REGULATION (EU) No 1088/2010 of 23 November 2010 amending Regulation (EC) No 976/2009 as regards download services and transformation services (publication:2010-12-08)',
                            'COMMISSION REGULATION (EC) No 976/2009 of 19 October 2009 implementing Directive 2007/2/EC of the European Parliament and of the Council as regards the Network Services' => '5 - COMMISSION REGULATION (EC) No 976/2009 of 19 October 2009 implementing Directive 2007/2/EC of the European Parliament and of the Council as regards the Network Services (publication:2009-10-20)',
                            'COMMISSION REGULATION (EU) No 268/2010 of 29 March 2010 implementing Directive 2007/2/EC of the European Parliament and of the Council as regards the access to spatial data sets and services of the Member States by Community institutions and bodies under harmonised conditions' => '6 - COMMISSION REGULATION (EU) No 268/2010 of 29 March 2010 implementing Directive 2007/2/EC of the European Parliament and of the Council as regards the access to spatial data sets and services of the Member States by Community institutions and bodies under harmonised conditions (publication:2010-03-30)',
                            'Commission Decision of 5 June 2009 implementing Directive 2007/2/EC of the European Parliament and of the Council as regards monitoring and reporting (notified under document number C(2009) 4199) (2009/442/EC)' => '7 - Commission Decision of 5 June 2009 implementing Directive 2007/2/EC of the European Parliament and of the Council as regards monitoring and reporting (notified under document number C(2009) 4199) (2009/442/EC) (publication:2009-06-11)'
                            );
$config['codelist']['InspireSpecificationCode2'] = array_flip($config['codelist']['InspireSpecificationCode']);

// X0.0	InspireRestrictionCode
//
$config['codelist']['InspireRestrictionCode'] = array(
                            'Pas de restriction d’accès public selon INSPIRE' => '0 - Aucun des articles de la loi ne peut être invoqué pour justifier d’une restriction d’accès public.',
                            'L124-4-I-1 du code de l\'environnement (Directive 2007/2/CE (INSPIRE), Article 13.1.a)' => '1 - La confidentialité des travaux des autorités publiques, lorsque cette confidentialité est prévue par la loi.',
                            'L124-5-II-1 du code de l\'environnement (Directive 2007/2/CE (INSPIRE), Article 13.1.b)' => '2 - Les relations internationales, la sécurité publique ou la défense nationale.',
                            'L124-5-II-2 du code de l\'environnement (Directive 2007/2/CE (INSPIRE), Article 13.1.c)' => '3 - La bonne marche de la justice, la possibilité pour toute personne d’être jugée équitablement ou la capacité d’une autorité publique d’effectuer une enquête d’ordre pénal ou disciplinaire.',
                            'L124-4-I-1 du code de l\'environnement (Directive 2007/2/CE (INSPIRE), Article 13.1.d)' => '4 - La confidentialité des informations commerciales ou industrielles, lorsque cette confidentialité est prévue par la législation nationale ou communautaire afin de protéger un intérêt économique légitime, notamment l’intérêt public lié à la préservation de la confidentialité des statistiques et du secret fiscal.',
                            'L124-5-II-3 du code de l\'environnement (Directive 2007/2/CE (INSPIRE), Article 13.1.e)' => '5 - Les droits de propriété intellectuelle.',
                            'L124-4-I-1 du code de l\'environnement (Directive 2007/2/CE (INSPIRE), Article 13.1.f)' => '6 - La confidentialité des données à caractère personnel et/ou des fichiers concernant une personne physique lorsque cette personne n’a pas consenti à la divulgation de ces informations au public, lorsque la confidentialité de ce type d’information est prévue par la législation nationale ou communautaire.',
                            'L124-4-I-3 du code de l\'environnement (Directive 2007/2/CE (INSPIRE), Article 13.1.g)' => '7 - Les intérêts ou la protection de toute personne qui a fourni les informations demandées sur une base volontaire sans y être contrainte par la loi ou sans que la loi puisse l’y contraindre, à moins que cette personne n’ait consenti à la divulgation de ces données.',
                            'L124-4-I-2 du code de l\'environnement (Directive 2007/2/CE (INSPIRE), Article 13.1.h)' => '8 - La protection de l’environnement auquel ces informations ont trait, comme par exemple la localisation d’espèces rares.'
                            );
$config['codelist']['InspireRestrictionCode2'] = array_flip($config['codelist']['InspireRestrictionCode']);

/* End of file mdc_codelist.php */
/* Location: ./application/config/mdc_codelist.php */
