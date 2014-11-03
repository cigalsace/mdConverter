<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0"
    xmlns:gmd='http://www.isotc211.org/2005/gmd'
	xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'
	xmlns:fra='http://www.cnig.gouv.fr/2005/fra'
	xmlns:gco='http://www.isotc211.org/2005/gco'
	xmlns:gts='http://www.isotc211.org/2005/gts'
	xmlns:gml='http://www.opengis.net/gml'
	xmlns:gfc='http://www.isotc211.org/2005/gfc'
	xmlns:gmx='http://www.isotc211.org/2005/gmx'
	xmlns:xlink='http://www.w3.org/1999/xlink'
	xmlns:gmi='http://www.isotc211.org/2005/gmi'
    
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:root='http://cigal.geotask.ch/root'
	xmlns:smXML='http://cigal.geotask.ch/smXML' 
	xmlns:scXML='http://cigal.geotask.ch/scXML' 
	xmlns:iso19110='http://cigal.geotask.ch/iso19110'
    
    xmlns:dc='http://purl.org/dc/elements/1.1/'
    xmlns:ns15='http://www.w3.org/2001/SMIL20/Language'
    xmlns:srv='http://www.isotc211.org/2005/srv'
    xmlns:ns13="http://www.opengis.net/gml/3.2"
    xmlns:ogc="http://www.opengis.net/ogc"
    xmlns:dct="http://purl.org/dc/terms/"
    xmlns:ows="http://www.opengis.net/ows"
    xmlns:csw="http://www.opengis.net/cat/csw/2.0.2"
    
    xmlns:gr="urn:cigal:gr"
    
    xmlns:map="urn:cigal:mapping">
    
    <xsl:output method="html" encoding='utf-8' indent='yes'/>

    <xsl:variable name="fileMapping" select="document('./CIGAL-CUS_2011_onglets.xsl')"/>
    <!--<xsl:variable name="basepath" select="'../xsl/CIGAL-CUS_2011_onglets'"/>-->
    <xsl:variable name="basepath" select="'../../../../../xsl/CIGAL-CUS_2011_onglets'"/>
    
    <gr:version>0.6</gr:version>
   
    <map:Mapping xmlns:map="urn:cigal:mapping">
        <map:characterSetCode>
            <map:code iso="utf8" code="utf8" />
            <map:code iso="ucs2" code="ucs2" />
            <map:code iso="ucs4" code="ucs4" />
            <map:code iso="utf7" code="utf7" />
            <map:code iso="utf16" code="utf16" />
            <map:code iso="8859part1" code="8859part1" />
            <map:code iso="8859part2" code="8859part2" />
            <map:code iso="8859part3" code="8859part3" />
            <map:code iso="8859part4" code="8859part4" />
            <map:code iso="8859part5" code="8859part5" />
            <map:code iso="8859part6" code="8859part6" />
            <map:code iso="8859part7" code="8859part7" />
            <map:code iso="8859part8" code="8859part8" />
            <map:code iso="8859part9" code="8859part9" />
            <map:code iso="8859part10" code="8859part10" />
            <map:code iso="8859part11" code="8859part11" />
            <map:code iso="8859part13" code="8859part13" />
            <map:code iso="8859part14" code="8859part14" />
            <map:code iso="8859part15" code="8859part15" />
            <map:code iso="8859part16" code="8859part16" />
            <map:code iso="jis" code="jis" />
            <map:code iso="shiftJIS" code="shiftJIS" />
            <map:code iso="eucJP" code="eucJP" />
            <map:code iso="usAscii" code="usAscii" />
            <map:code iso="ebcdic" code="ebcdic" />
            <map:code iso="eucKR" code="eucKR" />
            <map:code iso="big5" code="big5" />
            <map:code iso="GB2312" code="GB2312" />
        </map:characterSetCode>
        <map:dateTypeCode>
            <map:code iso="creation" code="création" />
            <map:code iso="publication" code="publication" />
            <map:code iso="revision" code="révision" />
        </map:dateTypeCode>
        <map:scopeCode>
            <map:code iso="attribute" code="Attribut" />
            <map:code iso="attributeType" code="Type d’attribut" />
            <map:code iso="collectionHardware" code="Collection matérielle" />
            <map:code iso="collectionSession" code="Collection de session" />
            <map:code iso="dataset" code="Jeu de données" />
            <map:code iso="series" code="Collection de données" />
            <map:code iso="nonGeographicDataset" code="Jeu de données non géographique" />
            <map:code iso="dimensionGroup" code="Dimension d’un groupe" />
            <map:code iso="feature" code="Entité" />
            <map:code iso="featureType" code="Type d’entité" />
            <map:code iso="propertyType" code="Type de propriété" />
            <map:code iso="software" code="Logiciel" />
            <map:code iso="fieldSession" code="Champ de Session" />
            <map:code iso="service" code="Service" />
            <map:code iso="model" code="Modèle" />
            <map:code iso="tile" code="Sous-ensemble de données" />
            <map:code iso="fieldCampaign" code="Campagne de mesures" />
        </map:scopeCode>
        <map:languageCode>
            <map:code iso="fre" code="Français" />
            <map:code iso="fr" code="Français" />
            <map:code iso="fra" code="Français" />
            <map:code iso="en" code="Anglais" />
            <map:code iso="eng" code="Anglais" />
            <map:code iso="deu" code="Allemand" />
            <map:code iso="de" code="Allemand" />
            <map:code iso="ita" code="Italien" />
            <map:code iso="it" code="Italien" />
            <map:code iso="esp" code="Espagnole" />
            <map:code iso="es" code="Espagnole" />
        </map:languageCode>
        <map:topicCategoryCode>
            <map:code iso="biota" code="Biologie" />
            <map:code iso="boundaries" code="Frontières et limites" />
            <map:code iso="climatologyMeteorologyAtmosphere" code="Climatologie et météorologie" />
            <map:code iso="economy" code="Economie" />
            <map:code iso="elevation" code="Elevation et altimetrie" />
            <map:code iso="environment" code="Environnement" />
            <map:code iso="farming" code="Agriculture" />
            <map:code iso="geoscientificInformation" code="Science de la terre" />
            <map:code iso="health" code="Santé" />
            <map:code iso="imageryBaseMapsEarthCover" code="Cartes et données de référence" />
            <map:code iso="inlandWaters" code="Hydrologie" />
            <map:code iso="intelligenceMilitary" code="Activites militaires" />
            <map:code iso="location" code="Localisants" />
            <map:code iso="oceans" code="Oceanologie et oceanographie" />
            <map:code iso="planningCadastre" code="Cadastre, pannification et amenagement" />
            <map:code iso="society" code="Societé" />
            <map:code iso="structure" code="Contructions et équipements" />
            <map:code iso="transportation" code="Infrastructure de transport" />
            <map:code iso="utilitiesCommunication" code="Réseaux (eau, energie, etc.)" />
        </map:topicCategoryCode>
        <map:inspireThemeCode>
            <map:code iso="Coordinate reference systems" code="Référentiels de coordonnées" />
            <map:code iso="Geographical grid systems" code="Systèmes de maillage géographique" />
            <map:code iso="Geographical names" code="Dénominations géographiques" />
            <map:code iso="Administrative units" code="Unités administratives" />
            <map:code iso="Addresses" code="Adresses" />
            <map:code iso="Cadastral parcels" code="Parcelles cadastrales" />
            <map:code iso="Transport networks" code="Réseaux de transport" />
            <map:code iso="Hydrography" code="Hydrographie" />
            <map:code iso="Protected sites" code="Sites protégés" />
            <map:code iso="Elevation" code="Altitude" />
            <map:code iso="Land cover" code="Occupation des terres" />
            <map:code iso="Orthoimagery" code="Ortho-imagerie" />
            <map:code iso="Geology" code="Géologie" />
            <map:code iso="Statistical units" code="Unités statistiques" />
            <map:code iso="Buildings" code="Bâtiments" />
            <map:code iso="Soil" code="Sols" />
            <map:code iso="Land use" code="Usage des sols" />
            <map:code iso="Human health and safety" code="Santé et sécurité des personnes" />
            <map:code iso="Utility and governmental services" code="Services d'utilité publique et services publics" />
            <map:code iso="Environmental monitoring facilities" code="Installations de suivi environnemental" />
            <map:code iso="Production and industrial facilities" code="Lieux de production et sites industriels" />
            <map:code iso="Agricultural and aquaculture facilities" code="Installations agricoles et aquacoles" />
            <map:code iso="Population distribution — demography" code="Répartition de la population – démographie" />
            <map:code iso="Area management/restriction/regulation zones and reporting units" code="Zones de gestion, de restriction ou de réglementation et unités de déclaration" />
            <map:code iso="Natural risk zones" code="Zones à risque naturel" />
            <map:code iso="Atmospheric conditions" code="Conditions atmosphériques" />
            <map:code iso="Meteorological geographical features" code="Caractéristiques géographiques météorologiques" />
            <map:code iso="Oceanographic geographical features" code="Caractéristiques géographiques océanographiques" />
            <map:code iso="Sea regions" code="Régions maritimes" />
            <map:code iso="Bio-geographical regions" code="Régions biogéographiques" />
            <map:code iso="Habitats and biotopes" code="Habitats et biotopes" />
            <map:code iso="Species distribution" code="Répartition des espèces" />
            <map:code iso="Energy resources" code="Sources d'énergie" />
            <map:code iso="Mineral resources" code="Ressources minérales" />
        </map:inspireThemeCode>
        <map:restrictionCode>
            <map:code iso="copyright" code="Droit d’auteur / Droit moral (copyright)" />
            <map:code iso="patent" code="Brevet" />
            <map:code iso="patentPending" code="Brevet en instance" />
            <map:code iso="trademark" code="Marque déposée" />
            <map:code iso="license" code="Licence" />
            <map:code iso="intellectualPropertyRights" code="Droit de propriété intellectuelle / Droit patrimonial" />
            <map:code iso="restricted" code="Restreint" />
            <!--<map:code iso="otherRestrictions" code="Autres restrictions" />-->
        </map:restrictionCode>
        <map:classificationCode>
            <map:code iso="unclassified" code="Non classifié" />
            <map:code iso="restricted" code="Restreint" />
            <map:code iso="confidential" code="Confidentiel" />
            <map:code iso="secret" code="Secret" />
            <map:code iso="topSecret" code="Top secret" />
        </map:classificationCode>
        <map:spatialRepresentationTypeCode>
            <map:code iso="vector" code="Vecteur" />
            <map:code iso="grid" code="Raster" />
            <map:code iso="textTable" code="Table texte" />
            <map:code iso="tin" code="Tin" />
            <map:code iso="stereoModel" code="Vue 3D" />
            <map:code iso="video" code="Vidéo" />
        </map:spatialRepresentationTypeCode>
        <map:roleCode>
            <map:code iso="resourceProvider" code="Fournisseur" />
            <map:code iso="custodian" code="Gestionnaire" />
            <map:code iso="owner" code="Propriétaire" />
            <map:code iso="user" code="Utilisateur" />
            <map:code iso="distributor" code="Distributeur" />
            <map:code iso="originator" code="Commanditaire" />
            <map:code iso="pointOfContact" code="Point de contact" />
            <map:code iso="principalInvestigator" code="Producteur / Maître d’œuvre principal ou d'ensemble" />
            <map:code iso="processor" code="Intégrateur / Exécutant secondaire" />
            <map:code iso="publisher" code="Editeur" />
            <map:code iso="author" code="Auteur" />
        </map:roleCode>
        <map:maintenanceFrequencyCode>
            <map:code iso="continual" code="En continu" />
            <map:code iso="daily" code="Quotidien" />
            <map:code iso="weekly" code="Hebdomadaire" />
            <map:code iso="fortnightly" code="Tous les 15 jours" />
            <map:code iso="monthly" code="Mensuel" />
            <map:code iso="quaterly" code="Trimestriel" />
            <map:code iso="biannualy" code="Semestriel" />
            <map:code iso="annualy" code="Annuel" />
            <map:code iso="adNeeded" code="Quand nécessaire" />
            <map:code iso="irregular" code="Irrégulier" />
            <map:code iso="notPlanned" code="Non plannifié" />
            <map:code iso="unknown" code="Inconnu" />
        </map:maintenanceFrequencyCode>
    </map:Mapping>
   
   
    <xsl:template match='gmd:MD_Metadata'>
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <!-- Encodage du site -->
                <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
                <!-- Titre du site -->
                <title>
                    <xsl:value-of select="./gmd:identificationInfo/gmd:MD_DataIdentification/gmd:citation/gmd:CI_Citation/gmd:title/gco:CharacterString"/>
                </title>
                <!-- Meta-tags du site -->
                <meta name="keywords">
                    <xsl:attribute name="content">
                        <xsl:for-each select="./gmd:identificationInfo/gmd:MD_DataIdentification/gmd:topicCategory">
                            <!--<xsl:value-of select="gmd:MD_TopicCategoryCode/." />-->
                            <xsl:call-template name="topicCategoryCode">
                                <xsl:with-param name="val" select="gmd:MD_TopicCategoryCode/."/>
                            </xsl:call-template>,
                        </xsl:for-each>
                    </xsl:attribute>
                </meta>
                <meta name="description" content="{./gmd:identificationInfo/gmd:MD_DataIdentification/gmd:abstract/gco:CharacterString}" />
                <meta name="author" content="" />
                <!-- Icones du site -->
                <link rel="shortcut icon" href="" />
                <link rel="icon" href="" type="image/x-icon" />
            
                <!-- CSS du site -->
                <!-- css de jquery-ui -->
                <link type="text/css" href="{$basepath}/css/cigal_light/jquery-ui-1.10.3.custom.min.css" rel="Stylesheet" />
                <!--<link type="text/css" href="{$basepath}/css/cigal_light/jquery-datatable.css" rel="Stylesheet" />-->
                <link type="text/css" href="{$basepath}/css/index.css" rel="Stylesheet" media="all" />
                <link type="text/css" href="{$basepath}/css/print.css" rel="Stylesheet" media="print" />

                <!-- Javascript -->
                <script type="text/javascript" src="{$basepath}/js/jquery-2.0.3.min.js"></script>
                <!--<script type="text/javascript" src="{$basepath}/js/jquery-2.0.3.min.map"></script>-->
                <script type="text/javascript" src="{$basepath}/js/jquery-ui-1.10.3.custom.js"></script>
                <script type="text/javascript" src="{$basepath}/js/i18n/jquery.ui.datepicker-fr.min.js"></script>
                <script type="text/javascript" src="{$basepath}/js/jquery.form.js"></script>
                <script type="text/javascript" src="{$basepath}/js/jquery.dataTables.min.js"></script>
                <script type="text/javascript" src="{$basepath}/js/jquery.dataTables.plugin.js"></script>
                <script type="text/javascript" src="{$basepath}/js/index.js"></script>
            </head>
            <body>
                <div id="page">
                    <div id="printable">Version imprimable</div>
                    <div id="unprintable">Version onglets</div>
                
                    <h1 class="ui-widget-header ui-corner-all"><xsl:value-of select="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:citation/gmd:CI_Citation/gmd:title/gco:CharacterString"/></h1>
                    <xsl:choose>
                        <xsl:when test="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:descriptiveKeywords/gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'CARTE'">
                            <div class="type ui-state-default ui-corner-all"> - CARTE - </div>
                        </xsl:when>
                        <xsl:otherwise>
                            <div class="type ui-state-default ui-corner-all"> - DONNEES - </div> 
                        </xsl:otherwise>
                    </xsl:choose>

                    <div id="header">
                        <xsl:choose>
                            <xsl:when test="(gmd:identificationInfo/gmd:MD_DataIdentification/gmd:pointOfContact/gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:contactInstructions/gmx:FileName) and (gmd:identificationInfo/gmd:MD_DataIdentification/gmd:pointOfContact/gmd:CI_ResponsibleParty/gmd:role/gmd:CI_RoleCode/@codeListValue='owner')">
                                <img id="logo" src="{gmd:identificationInfo/gmd:MD_DataIdentification/gmd:pointOfContact/gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:contactInstructions/gmx:FileName/@src}" alt="{gmd:identificationInfo/gmd:MD_DataIdentification/gmd:pointOfContact/gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:contactInstructions/gmx:FileName/.}" title="logo de la structure/service" class="ui-widget-header ui-corner-all"/>
                            </xsl:when>
                            <xsl:otherwise>
                                <!-- affichage du logo par defaut: cf. css/logo.png -->
                                <img src="{$basepath}/css/logo.png" id="logo" alt="logo" title="logo de la structure/service" class="ui-widget-header ui-corner-all"/>
                            </xsl:otherwise>
                        </xsl:choose>
                            
                        <div id="data_abstract">
                            <pre>
                                <!--<xsl:value-of select="substring(gmd:identificationInfo/gmd:MD_DataIdentification/gmd:abstract/gco:CharacterString, 1, 400)" />...-->
                                <xsl:value-of select="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:abstract/gco:CharacterString" />
                            </pre>
                        </div>
                    </div>
                    
                    <div id="tabs">
                        <ul id="tabs-list">
                            <li><a href="#tabs-1">Découvrir la donnée</a></li>
                            <li><a href="#tabs-2">Analyser la donnée</a></li>
                            <li><a href="#tabs-3">Accéder à la donnée</a></li>
                            <li><a href="#tabs-4">Informations sur la fiche</a></li>
                            <li><a href="#tabs-5">Contacts</a></li>
                        </ul>
                        
                        <!-- TABS-1 -->
                        
                        <div id="tabs-1">
                        
                            <h2 class="ui-state-default ui-corner-all">
                                1 - Découvrir la donnée
                            </h2>
                        
                            <div class="line">
                                <!--<div class="key">Illustration:</div>-->
                                <h4>Illustration(s):</h4>
                                <div id="browsegraphic" class="value">
                                    <xsl:choose>
                                        <xsl:when test="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:graphicOverview">
                                            <xsl:for-each select="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:graphicOverview">
                                                <img class="ui-state-active ui-corner-all" src="{gmd:MD_BrowseGraphic/gmd:fileName/gco:CharacterString/.}" alt="{gmd:MD_BrowseGraphic/gmd:fileName/gco:CharacterString/.} - {gmd:MD_BrowseGraphic/gmd:fileDescription/gco:CharacterString/.}" title="{gmd:MD_BrowseGraphic/gmd:fileDescription/gco:CharacterString/.}"></img>
                                                <div>
                                                    <span class="label">Nom du fichier: </span><xsl:value-of select="gmd:MD_BrowseGraphic/gmd:fileName/gco:CharacterString/." /><br /><br />
                                                    <span class="label">Description: </span><xsl:value-of select="gmd:MD_BrowseGraphic/gmd:fileDescription/gco:CharacterString/." />
                                                </div>
                                            </xsl:for-each>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            Aucune illustration disponible.
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </div>
                            </div>
                            
                            <div class="line">
                                <!--<div class="key">Catégorie(s):</div>-->
                                <h4 class="key-line">Catégorie(s):</h4>
                                <div class="value-line">
                                    <xsl:choose>
                                        <xsl:when test="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:topicCategory">
                                            <xsl:for-each select="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:topicCategory">
                                                <!--<xsl:value-of select="gmd:MD_TopicCategoryCode/." />-->
                                                <xsl:call-template name="topicCategoryCode">
                                                    <xsl:with-param name="val" select="gmd:MD_TopicCategoryCode/."/>
                                                </xsl:call-template>
                                                <br />
                                            </xsl:for-each>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            Non renseigné
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </div>
                            </div>

                            <div class="line">
                                <h4>Thème INSPIRE:</h4>
                                <table class="ui-widget-content ui-corner-all">
                                    <tr class="ui-state-default ui-corner-all">
                                        <th> Thème </th>
                                        <th> Thésaurus </th>
                                    </tr>
                                    <xsl:choose>
                                        <xsl:when test="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:descriptiveKeywords/gmd:MD_Keywords[contains(gmd:thesaurusName/gmd:CI_Citation/gmd:title/gco:CharacterString, 'INSPIRE')]">
                                            <xsl:for-each select="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:descriptiveKeywords/gmd:MD_Keywords">
                                                <xsl:if test="contains(gmd:thesaurusName/gmd:CI_Citation/gmd:title/gco:CharacterString, 'INSPIRE')">
                                                    <tr>
                                                        <!--<td><xsl:value-of select="gmd:keyword/gco:CharacterString"/></td>-->
                                                        <td class="ui-widget-content">
                                                            <xsl:call-template name="inspireThemeCode">
                                                                <xsl:with-param name="val" select="gmd:keyword/gco:CharacterString"/>
                                                            </xsl:call-template>
                                                        </td>
                                                        <td class="ui-widget-content">
                                                            <xsl:if test="gmd:thesaurusName/gmd:CI_Citation/gmd:title/gco:CharacterString">
                                                                <xsl:value-of select="gmd:thesaurusName/gmd:CI_Citation/gmd:title/gco:CharacterString"/>
                                                                (
                                                                <xsl:if test="gmd:thesaurusName/gmd:CI_Citation/gmd:date/gmd:CI_Date/gmd:dateType/gmd:CI_DateTypeCode/@codeListValue = 'creation'">
                                                                    création: <xsl:value-of select="gmd:thesaurusName/gmd:CI_Citation/gmd:date/gmd:CI_Date/gmd:date/gco:Date"/>
                                                                </xsl:if>
                                                                <xsl:if test="gmd:thesaurusName/gmd:CI_Citation/gmd:date/gmd:CI_Date/gmd:dateType/gmd:CI_DateTypeCode/@codeListValue = 'publication'">
                                                                   publication: <xsl:value-of select="gmd:thesaurusName/gmd:CI_Citation/gmd:date/gmd:CI_Date/gmd:date/gco:Date"/>
                                                                </xsl:if>
                                                                <xsl:if test="gmd:thesaurusName/gmd:CI_Citation/gmd:date/gmd:CI_Date/gmd:dateType/gmd:CI_DateTypeCode/@codeListValue = 'revision'">
                                                                    mise à jour: <xsl:value-of select="gmd:thesaurusName/gmd:CI_Citation/gmd:date/gmd:CI_Date/gmd:date/gco:Date"/>
                                                                </xsl:if>
                                                                )
                                                            </xsl:if>
                                                        </td>
                                                    </tr>
                                                </xsl:if>  
                                            </xsl:for-each>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            <tr>
                                                <td class="ui-widget-content">Non renseigné</td>
                                                <td class="ui-widget-content">Non renseigné</td>
                                            </tr>
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </table>
                            </div>
                                    
                            <div class="line">
                                <h4>Mots-clés:</h4>
                                <table class="ui-widget-content ui-corner-all">
                                    <tr class="ui-state-default ui-corner-all">
                                        <th> Mot-clé </th>
                                        <th> Type </th>
                                        <th> Thésaurus </th>
                                    </tr>
                                    <xsl:choose>
                                        <xsl:when test="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:descriptiveKeywords/gmd:MD_Keywords[not(contains(gmd:thesaurusName/gmd:CI_Citation/gmd:title/gco:CharacterString, 'INSPIRE'))]">
                                            <xsl:for-each select='gmd:identificationInfo/gmd:MD_DataIdentification/gmd:descriptiveKeywords/gmd:MD_Keywords'>
                                                <xsl:if test="not(contains(gmd:thesaurusName/gmd:CI_Citation/gmd:title/gco:CharacterString, 'INSPIRE'))">
                                                    <tr>
                                                        <td class="ui-widget-content"><xsl:value-of select="gmd:keyword/gco:CharacterString"/></td>
                                                        <td class="ui-widget-content"><xsl:value-of select="gmd:type/gmd:MD_KeywordTypeCode/@codeListValue"/></td>
                                                        <td class="ui-widget-content">
                                                            <xsl:if test="gmd:thesaurusName/gmd:CI_Citation/gmd:title/gco:CharacterString">
                                                                <xsl:value-of select="gmd:thesaurusName/gmd:CI_Citation/gmd:title/gco:CharacterString"/>
                                                                (
                                                                <xsl:if test="gmd:thesaurusName/gmd:CI_Citation/gmd:date/gmd:CI_Date/gmd:dateType/gmd:CI_DateTypeCode/@codeListValue = 'creation'">
                                                                    <xsl:value-of select="gmd:thesaurusName/gmd:CI_Citation/gmd:date/gmd:CI_Date/gmd:date/gco:Date"/>
                                                                </xsl:if>
                                                                <xsl:if test="gmd:thesaurusName/gmd:CI_Citation/gmd:date/gmd:CI_Date/gmd:dateType/gmd:CI_DateTypeCode/@codeListValue = 'publication'">
                                                                    <xsl:value-of select="gmd:thesaurusName/gmd:CI_Citation/gmd:date/gmd:CI_Date/gmd:date/gco:Date"/>
                                                                </xsl:if>
                                                                <xsl:if test="gmd:thesaurusName/gmd:CI_Citation/gmd:date/gmd:CI_Date/gmd:dateType/gmd:CI_DateTypeCode/@codeListValue = 'revision'">
                                                                    <xsl:value-of select="gmd:thesaurusName/gmd:CI_Citation/gmd:date/gmd:CI_Date/gmd:date/gco:Date"/>
                                                                </xsl:if>
                                                                )
                                                            </xsl:if>
                                                        </td>
                                                    </tr>
                                                </xsl:if>  
                                            </xsl:for-each>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            <tr>
                                                <td class="ui-widget-content">Non renseigné</td>
                                                <td class="ui-widget-content">Non renseigné</td>
                                                <td class="ui-widget-content">Non renseigné</td>
                                            </tr>
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </table>  
                            </div>

                            <div class="line">
                                <h4>Emprise(s):</h4>
                                <table class="ui-widget-content ui-corner-all">
                                    <tr class="ui-state-default ui-corner-all">
                                        <th>Nom</th>
                                        <th>Longitude ouest</th>
                                        <th>Latitude sud</th>
                                        <th>Longitude est</th>
                                        <th>Latitude nord</th>
                                    </tr>
                                    <xsl:choose>
                                        <xsl:when test="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:extent/gmd:EX_Extent/gmd:geographicElement">
                                            <xsl:for-each select='gmd:identificationInfo/gmd:MD_DataIdentification/gmd:extent'>
                                                <xsl:if test="gmd:EX_Extent/gmd:geographicElement">
                                                    <tr>
                                                        <td class="ui-widget-content"><xsl:value-of select="gmd:EX_Extent/gmd:description/gco:CharacterString"/></td>
                                                        <td class="ui-widget-content"><xsl:value-of select="substring(gmd:EX_Extent/gmd:geographicElement/gmd:EX_GeographicBoundingBox/gmd:westBoundLongitude/gco:Decimal, 1, 6)" /></td>
                                                        <td class="ui-widget-content"><xsl:value-of select="substring(gmd:EX_Extent/gmd:geographicElement/gmd:EX_GeographicBoundingBox/gmd:southBoundLatitude/gco:Decimal, 1, 7)" /></td>
                                                        <td class="ui-widget-content"><xsl:value-of select="substring(gmd:EX_Extent/gmd:geographicElement/gmd:EX_GeographicBoundingBox/gmd:eastBoundLongitude/gco:Decimal, 1, 6)" /></td>
                                                        <td class="ui-widget-content"><xsl:value-of select="substring(gmd:EX_Extent/gmd:geographicElement/gmd:EX_GeographicBoundingBox/gmd:northBoundLatitude/gco:Decimal, 1, 7)" /></td>
                                                    </tr>
                                                </xsl:if>
                                            </xsl:for-each>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            <tr>
                                                <td class="ui-widget-content">Non renseigné</td>
                                                <td class="ui-widget-content">Non renseigné</td>
                                                <td class="ui-widget-content">Non renseigné</td>
                                                <td class="ui-widget-content">Non renseigné</td>
                                                <td class="ui-widget-content">Non renseigné</td>
                                            </tr>
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </table>
                            </div>
               
                        </div>
                        
                        
                        <div id="tabs-2">
                            <h2 class="ui-state-default ui-corner-all">
                                2 - Analyser la donnée
                            </h2>
                            
                            <h3 class="ui-state-active ui-corner-all">
                                <span class="ui-corner-all ui-icon ui-icon-triangle-1-e"></span>
                                Informations spatiales
                            </h3>
                            <div class="line">
                                <h4 class="key-line">Type de représentation:</h4>
                                <div class="value-line">
                                    <xsl:choose>
                                        <xsl:when test="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:spatialRepresentationType/gmd:MD_SpatialRepresentationTypeCode/@codeListValue">
                                            <xsl:call-template name="spatialRepresentationTypeCode">
                                                <xsl:with-param name="val" select="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:spatialRepresentationType/gmd:MD_SpatialRepresentationTypeCode/@codeListValue"/>
                                            </xsl:call-template>
                                        </xsl:when>
                                        <xsl:otherwise>Non renseigné</xsl:otherwise>
                                    </xsl:choose>
                                </div>
                            </div>
                            <xsl:if test="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:spatialResolution/gmd:MD_Resolution/gmd:equivalentScale/gmd:MD_RepresentativeFraction/gmd:denominator/gco:Integer">
                                <div class="line">
                                    <h4 class="key-line">Echelle:</h4>
                                    <div class="value-line">
                                        <xsl:value-of select="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:spatialResolution/gmd:MD_Resolution/gmd:equivalentScale/gmd:MD_RepresentativeFraction/gmd:denominator/gco:Integer"/>
                                    </div>
                                </div>
                            </xsl:if>
                            <xsl:if test="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:spatialResolution/gmd:MD_Resolution/distance/gco:Integer">
                                <div class="line">
                                    <h4 class="key-line">Résolution spatiale:</h4>
                                    <div class="value-line">
                                        <xsl:value-of select="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:spatialResolution/gmd:MD_Resolution/distance/gco:Integer"/>
                                    </div>
                                </div>
                            </xsl:if>
                            <div class="line">
                                <h4 class="key-line">Système(s) de projection:</h4>
                                <div class="value-line">
                                    <xsl:choose>
                                        <xsl:when test="gmd:referenceSystemInfo/gmd:MD_ReferenceSystem/gmd:referenceSystemIdentifier/gmd:RS_Identifier/gmd:code/gco:CharacterString">
                                            <xsl:for-each select="gmd:referenceSystemInfo">
                                                <xsl:if test="gmd:MD_ReferenceSystem/gmd:referenceSystemIdentifier/gmd:RS_Identifier/gmd:code/gco:CharacterString">
                                                    <xsl:value-of select="gmd:MD_ReferenceSystem/gmd:referenceSystemIdentifier/gmd:RS_Identifier/gmd:code/gco:CharacterString"/><br />
                                                </xsl:if>
                                            </xsl:for-each>
                                        </xsl:when>
                                        <xsl:otherwise><li>Non renseigné</li></xsl:otherwise>
                                    </xsl:choose>
                                </div>
                            </div>
                            
                            <h3 class="ui-state-active ui-corner-all">
                                <span class="ui-corner-all ui-icon ui-icon-triangle-1-e"></span>
                                Actualité de la donnée
                            </h3>
                            
                            <xsl:choose>
                                <xsl:when test="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:citation/gmd:CI_Citation/gmd:date">
                                    <xsl:for-each select='gmd:identificationInfo/gmd:MD_DataIdentification/gmd:citation/gmd:CI_Citation/gmd:date'>
                                        <div class="line">
                                            <h4 class="key-line">Dates de
                                                    <xsl:call-template name="dateTypeCode">
                                                        <xsl:with-param name="val" select="gmd:CI_Date/gmd:dateType/gmd:CI_DateTypeCode/@codeListValue"/>
                                                    </xsl:call-template>: 
                                            </h4>
                                            <div class="value-line">
                                                    <xsl:call-template name="date">
                                                        <xsl:with-param name="ladate" select="gmd:CI_Date/gmd:date/gco:Date"/>
                                                    </xsl:call-template>
                                                <!--<td class="td2"><xsl:value-of select="gmd:CI_Date/date/gco:Date"/></td>-->
                                            </div> 
                                        </div>    
                                    </xsl:for-each>
                                </xsl:when>
                                <xsl:otherwise>
                                    <div class="line">
                                        <h4 class="key-line">Dates:</h4>
                                        <div class="value-line">Non renseignées</div>
                                    </div>
                                </xsl:otherwise>
                            </xsl:choose>
                            
                            <div class="line">
                                <h4 class="key-line">Fréquence de mise à jour:</h4>
                                <div class="value-line">
                                    <xsl:choose>
                                        <xsl:when test="gmd:resourceMaintenance/gmd:MD_MaintenanceInformation/gmd:maintenanceAndUpdateFrequency/MD_MaintenanceFrequencyCode">
                                            <xsl:call-template name="maintenanceFrequencyCode">
                                                <xsl:with-param name="val" select="gmd:resourceMaintenance/gmd:MD_MaintenanceInformation/gmd:maintenanceAndUpdateFrequency/MD_MaintenanceFrequencyCode/@codeListValue"/>
                                            </xsl:call-template>
                                            <!--<xsl:value-of select="gmd:resourceMaintenance/gmd:MD_MaintenanceInformation/gmd:maintenanceAndUpdateFrequency/MD_MaintenanceFrequencyCode/@codeListValue"/>-->
                                        </xsl:when>
                                        <xsl:otherwise>Non renseignée</xsl:otherwise>
                                    </xsl:choose>
                                </div>
                            </div>

                            <h3 class="ui-state-active ui-corner-all">
                                <span class="ui-corner-all ui-icon ui-icon-triangle-1-e"></span>
                                Qualité de la donnée
                            </h3>
                            <div class="line">
                                <h4 class="key-line">Texte sur la qualité:</h4>
                                <div id="data_dq_text" class="value-line">
                                    <xsl:choose>
                                        <xsl:when test="gmd:dataQualityInfo/gmd:DQ_DataQuality/gmd:lineage/gmd:LI_Lineage/gmd:statement">
                                            <pre><xsl:value-of select="gmd:dataQualityInfo/gmd:DQ_DataQuality/gmd:lineage/gmd:LI_Lineage/gmd:statement/gco:CharacterString"/></pre>
                                        </xsl:when>
                                        <xsl:otherwise>Texte sur la qualité non renseigné</xsl:otherwise>
                                    </xsl:choose>
                                    <xsl:choose>
                                        <xsl:when test="gmd:dataQualityInfo/gmd:DQ_DataQuality/gmd:lineage/gmd:LI_Lineage/gmd:processStep/gmd:LI_ProcessStep/gmd:description">
                                            <pre>
                                            Méthodologie:
                                            <xsl:value-of select="gmd:dataQualityInfo/gmd:DQ_DataQuality/gmd:lineage/gmd:LI_Lineage/gmd:processStep/gmd:LI_ProcessStep/gmd:description/gco:CharacterString"/></pre>
                                        </xsl:when>
                                        <xsl:otherwise>non renseigné</xsl:otherwise>
                                    </xsl:choose>
                                    <xsl:choose>
                                        <xsl:when test="gmd:dataQualityInfo/gmd:DQ_DataQuality/gmd:lineage/gmd:LI_Lineage/gmd:source/gmd:LI_Source/gmd:description">
                                            <pre>
                                            Données sources:
                                            <xsl:value-of select="gmd:dataQualityInfo/gmd:DQ_DataQuality/gmd:lineage/gmd:LI_Lineage/gmd:source/gmd:LI_Source/gmd:description/gco:CharacterString"/></pre>
                                        </xsl:when>
                                        <xsl:otherwise>non renseigné</xsl:otherwise>
                                    </xsl:choose>
                                </div>
                            </div>               
                            
                            <div class="line">
                                <h4>Conformité:</h4>
                                <table class="ui-widget-content ui-corner-all">
                                    <tr class="ui-state-default ui-corner-all">
                                        <th>Titre de la spécification</th>
                                        <th>Date création</th>
                                        <th>Date révision</th>
                                        <th>Date publication</th>
                                        <th>Résultat</th>
                                        <th>Degré</th>
                                    </tr>
                                    <xsl:choose>
                                        <xsl:when test="gmd:dataQualityInfo/gmd:DQ_DataQuality/gmd:report">
                                            <xsl:for-each select='gmd:dataQualityInfo/gmd:DQ_DataQuality/gmd:report'>
                                                <tr>
                                                    <td class="ui-widget-content"><xsl:value-of select="gmd:DQ_DomainConsistency/gmd:result/gmd:DQ_ConformanceResult/gmd:specification/gmd:CI_Citation/gmd:title/gco:CharacterString/."/></td>
                                                    <xsl:choose>
                                                        <xsl:when test="gmd:DQ_DomainConsistency/gmd:result/gmd:DQ_ConformanceResult/gmd:specification/gmd:CI_Citation/gmd:date/gmd:CI_Date/gmd:dateType/gmd:CI_DateTypeCode/@codeListValue = 'creation'">
                                                            <td class="ui-widget-content"><xsl:value-of select="gmd:DQ_DomainConsistency/gmd:result/gmd:DQ_ConformanceResult/gmd:specification/gmd:CI_Citation/gmd:date/gmd:CI_Date/gmd:date/gco:Date"/></td>
                                                        </xsl:when>
                                                        <xsl:otherwise>
                                                            <td class="ui-widget-content">Non renseigné</td>
                                                        </xsl:otherwise>
                                                    </xsl:choose>
                                                    <xsl:choose>
                                                        <xsl:when test="gmd:DQ_DomainConsistency/gmd:result/gmd:DQ_ConformanceResult/gmd:specification/gmd:CI_Citation/gmd:date/gmd:CI_Date/gmd:dateType/gmd:CI_DateTypeCode/@codeListValue = 'publication'">
                                                            <td class="ui-widget-content"><xsl:value-of select="gmd:DQ_DomainConsistency/gmd:result/gmd:DQ_ConformanceResult/gmd:specification/gmd:CI_Citation/gmd:date/gmd:CI_Date/gmd:date/gco:Date"/></td>
                                                        </xsl:when>
                                                        <xsl:otherwise>
                                                            <td class="ui-widget-content">Non renseigné</td>
                                                        </xsl:otherwise>
                                                    </xsl:choose>
                                                    <xsl:choose>
                                                        <xsl:when test="gmd:DQ_DomainConsistency/gmd:result/gmd:DQ_ConformanceResult/gmd:specification/gmd:CI_Citation/gmd:date/gmd:CI_Date/gmd:dateType/gmd:CI_DateTypeCode/@codeListValue = 'revision'">
                                                            <td class="ui-widget-content"><xsl:value-of select="gmd:DQ_DomainConsistency/gmd:result/gmd:DQ_ConformanceResult/gmd:specification/gmd:CI_Citation/gmd:date/gmd:CI_Date/gmd:date/gco:Date"/></td>
                                                        </xsl:when>
                                                        <xsl:otherwise>
                                                            <td class="ui-widget-content">Non renseigné</td>
                                                        </xsl:otherwise>
                                                    </xsl:choose>
                                                    <td class="ui-widget-content"><xsl:value-of select="gmd:DQ_DomainConsistency/gmd:result/gmd:DQ_ConformanceResult/gmd:explanation/gco:CharacterString/."/></td>
                                                    <xsl:choose>
                                                        <xsl:when test="gmd:DQ_DomainConsistency/gmd:result/gmd:DQ_ConformanceResult/gmd:pass/gco:Boolean = 'true'">
                                                            <td class="ui-widget-content">Conforme</td>
                                                        </xsl:when>
                                                        <xsl:when test="gmd:DQ_DomainConsistency/gmd:result/gmd:DQ_ConformanceResult/gmd:pass/gco:Boolean = 'false'">
                                                            <td class="ui-widget-content">Non conforme</td>
                                                        </xsl:when>
                                                        <xsl:otherwise>
                                                            <td class="ui-widget-content">Non évalué</td>
                                                        </xsl:otherwise>
                                                    </xsl:choose>
                                                </tr>
                                            </xsl:for-each>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            <tr>
                                                <td class="ui-widget-content">Non renseigné</td>
                                                <td class="ui-widget-content">Non renseigné</td>
                                                <td class="ui-widget-content">Non renseigné</td>
                                                <td class="ui-widget-content">Non renseigné</td>
                                                <td class="ui-widget-content">Non renseigné</td>
                                                <td class="ui-widget-content">Non renseigné</td>
                                            </tr>
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </table> 
                            </div>
                            
                            
                            <h3 class="ui-state-active ui-corner-all">
                                <span class="ui-corner-all ui-icon ui-icon-triangle-1-e"></span>
                                Informations complémentaires
                            </h3>                
                            <div class="line">
                                <h4 class="key-line">Identifiants de la donnée:</h4>
                                <div class="value-line">
                                    <xsl:choose>
                                        <xsl:when test="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:citation/gmd:CI_Citation/gmd:identifier/gmd:RS_Identifier/gmd:code/gco:CharacterString">
                                            <xsl:for-each select="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:citation/gmd:CI_Citation/gmd:identifier/gmd:RS_Identifier">
                                                <xsl:value-of select="gmd:code/gco:CharacterString"/> (domaine: <xsl:value-of select="gmd:codeSpace/gco:CharacterString"/>)<br />
                                            </xsl:for-each>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            Non renseigné
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </div>
                            </div>
                            <div class="line">
                                <h4 class="key-line">Langue:</h4>
                                <div class="value-line">
                                    <xsl:choose>
                                        <xsl:when test="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:language/gmd:LanguageCode">
                                            <xsl:for-each select='gmd:identificationInfo/gmd:MD_DataIdentification/gmd:language'>
                                                <xsl:call-template name="languageCode">
                                                    <xsl:with-param name="val" select="gmd:LanguageCode/@codeListValue"/>
                                                </xsl:call-template>
                                                <br />
                                            </xsl:for-each>
                                        </xsl:when>
                                        <xsl:otherwise>Non renseigné</xsl:otherwise>
                                    </xsl:choose>
                                </div>
                            </div>
                            <div class="line">
                                <h4 class="key-line">Jeu de charactères:</h4>
                                <div class="value-line">                
                                    <xsl:choose>
                                        <xsl:when test="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:characterSet/gmd:MD_CharacterSetCode/@codeListValue">
                                            <xsl:value-of select="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:characterSet/gmd:MD_CharacterSetCode/@codeListValue"/>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            Non renseigné
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </div>
                            </div>
                            <div class="line">
                                <h4>Point de contact:</h4>
                                <table class="ui-widget-content ui-corner-all">
                                    <tr class="ui-state-default ui-corner-all">
                                        <th>Contact</th>
                                        <th>Rôle</th>
                                    </tr>
                                    <xsl:choose>
                                        <!--<xsl:when test="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:pointOfContact/gmd:CI_ResponsibleParty/gmd:role/gmd:CI_RoleCode/@codeListValue='pointOfContact'">-->
                                        <xsl:when test="(gmd:identificationInfo/gmd:MD_DataIdentification/gmd:pointOfContact/gmd:CI_ResponsibleParty/gmd:role/gmd:CI_RoleCode/@codeListValue='pointOfContact') 
                                        or (gmd:identificationInfo/gmd:MD_DataIdentification/gmd:pointOfContact/gmd:CI_ResponsibleParty/gmd:role/gmd:CI_RoleCode/@codeListValue='author') 
                                        or (gmd:identificationInfo/gmd:MD_DataIdentification/gmd:pointOfContact/gmd:CI_ResponsibleParty/gmd:role/gmd:CI_RoleCode/@codeListValue='custodian') 
                                        or (gmd:identificationInfo/gmd:MD_DataIdentification/gmd:pointOfContact/gmd:CI_ResponsibleParty/gmd:role/gmd:CI_RoleCode/@codeListValue='owner')">
                                            <xsl:for-each select="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:pointOfContact">
                                                <xsl:if test="gmd:CI_ResponsibleParty/gmd:role/gmd:CI_RoleCode/@codeListValue='pointOfContact' 
                                                or gmd:CI_ResponsibleParty/gmd:role/gmd:CI_RoleCode/@codeListValue='custodian'
                                                or gmd:CI_ResponsibleParty/gmd:role/gmd:CI_RoleCode/@codeListValue='author'
                                                or gmd:CI_ResponsibleParty/gmd:role/gmd:CI_RoleCode/@codeListValue='owner'">
                                                    <xsl:call-template name="responsibleParty">
                                                        <xsl:with-param name="val" select="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:pointOfContact"/>
                                                    </xsl:call-template>
                                                </xsl:if>
                                            </xsl:for-each>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            <tr>
                                                <td class="ui-widget-content">Non renseigné</td>
                                                <td class="ui-widget-content">Non renseigné</td>
                                            </tr>
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </table>   
                            </div>
                            
                        </div>
                        
                        <div id="tabs-3">
                            <h2 class="ui-state-default ui-corner-all">
                                3 - Accéder à la donnée
                            </h2>
                            
                            <h3 class="ui-state-active ui-corner-all">
                                <span class="ui-corner-all ui-icon ui-icon-triangle-1-e"></span>
                                Contraintes et limites légales d'accès
                            </h3>
                            <div class="line">
                                <h4 class="key-line">Mentions légales d'utilisation:</h4>
                                <div id="data_uselimitation" class="value-line">
                                    <xsl:choose>
                                        <xsl:when test="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:resourceConstraints/gmd:MD_Constraints/gmd:useLimitation">
                                            <xsl:for-each select="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:resourceConstraints/gmd:MD_Constraints/gmd:useLimitation">
                                                <pre><xsl:value-of select="gco:CharacterString/."/></pre>
                                            </xsl:for-each>
                                        </xsl:when>
                                        <xsl:otherwise>Non renseigné</xsl:otherwise>
                                    </xsl:choose>
                                </div>
                            </div>
                            <div class="line">
                                <h4 class="key-line">Contraintes légales d'accès<br />public:</h4>
                                <div class="value-line">
                                    <xsl:if test="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:resourceConstraints/gmd:MD_LegalConstraints/gmd:otherConstraints">
                                        <xsl:for-each select='gmd:identificationInfo/gmd:MD_DataIdentification/gmd:resourceConstraints/gmd:MD_LegalConstraints/gmd:otherConstraints'>
                                            <xsl:value-of select="gco:CharacterString/."/><br />
                                        </xsl:for-each>
                                    </xsl:if>
                                    <xsl:if test="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:resourceConstraints/gmd:MD_LegalConstraints/gmd:accessConstraints">
                                        <xsl:for-each select='gmd:identificationInfo/gmd:MD_DataIdentification/gmd:resourceConstraints/gmd:MD_LegalConstraints/gmd:accessConstraints'>
                                            <xsl:call-template name="restrictionCode">
                                                <xsl:with-param name="val" select="gmd:MD_RestrictionCode/@codeListValue"/> 
                                            </xsl:call-template>
                                            <br />
                                            <!--<xsl:value-of select="gmd:MD_RestrictionCode/."/><br />-->
                                        </xsl:for-each>
                                    </xsl:if>
                                </div>
                            </div>
                            <!--
                            <div class="line">
                                <h4 class="key-line">Contraintes d'utilisation:</h4>
                                <div class="value-line">
                                    <xsl:choose>
                                        <xsl:when test="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:resourceConstraints/gmd:MD_LegalConstraints/gmd:useConstraints">
                                            <xsl:for-each select='gmd:identificationInfo/gmd:MD_DataIdentification/gmd:resourceConstraints/gmd:MD_LegalConstraints/gmd:useConstraints'>
                                                <xsl:call-template name="restrictionCode">
                                                    <xsl:with-param name="val" select="gmd:MD_RestrictionCode/@codeListValue"/>
                                                </xsl:call-template>
                                                <br />
                                            </xsl:for-each>
                                        </xsl:when>
                                        <xsl:otherwise>Non renseigné</xsl:otherwise>
                                    </xsl:choose>
                                </div>
                            </div>
                            -->
                            <!--
                            <div class="line">
                                <h4 class="key-line">Autres contraintes:</h4>
                                <div id="data_otherconstraints" class="value-line">
                                    <xsl:choose>
                                        <xsl:when test="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:resourceConstraints/gmd:MD_LegalConstraints/gmd:otherConstraints">
                                            <xsl:for-each select='gmd:identificationInfo/gmd:MD_DataIdentification/gmd:resourceConstraints/gmd:MD_LegalConstraints/gmd:otherConstraints'>
                                                <pre><xsl:value-of select="gco:CharacterString/."/></pre><br />
                                            </xsl:for-each>
                                        </xsl:when>
                                        <xsl:otherwise>Non renseigné</xsl:otherwise>
                                    </xsl:choose>
                                </div>
                            </div>
                            -->
                            <div class="line">
                                <h4 class="key-line">Restrictions d'utilisation:</h4>
                                <div class="value-line">
                                    <xsl:choose>
                                        <xsl:when test="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:resourceConstraints/gmd:MD_SecurityConstraints/gmd:classification/gmd:MD_ClassificationCode">
                                            <xsl:call-template name="classificationCode">
                                                <xsl:with-param name="val" select="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:resourceConstraints/gmd:MD_SecurityConstraints/gmd:classification/gmd:MD_ClassificationCode/@codeListValue"/>
                                            </xsl:call-template>
                                        </xsl:when>
                                        <xsl:otherwise>Non renseigné</xsl:otherwise>
                                    </xsl:choose>
                                </div>
                            </div>
                  
                            <h3 class="ui-state-active ui-corner-all">
                                <span class="ui-corner-all ui-icon ui-icon-triangle-1-e"></span>
                                Diffusion de la donnée
                            </h3>
                            <div class="line">
                                <h4>Format de diffusion:</h4>
                                <table class="ui-widget-content ui-corner-all">
                                    <tr class="ui-state-default ui-corner-all">
                                        <th>Nom</th>
                                        <th>Version</th>
                                        <th>Description</th>
                                    </tr>
                                    <xsl:choose>
                                        <xsl:when test="gmd:distributionInfo/gmd:MD_Distribution/gmd:distributionFormat">
                                            <xsl:for-each select="gmd:distributionInfo/gmd:MD_Distribution/gmd:distributionFormat">
                                                <tr>
                                                    <td class="ui-widget-content"><xsl:value-of select="gmd:MD_Format/gmd:name/gco:CharacterString"/></td>
                                                    <td class="ui-widget-content"><xsl:value-of select="gmd:MD_Format/gmd:version/gco:CharacterString"/></td>
                                                    <td class="ui-widget-content"><xsl:value-of select="gmd:MD_Format/gmd:specification/gco:CharacterString"/></td>
                                                </tr>
                                            </xsl:for-each>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            <tr>
                                                <td class="ui-widget-content">Non renseigné</td>
                                                <td class="ui-widget-content">Non renseigné</td>
                                                <td class="ui-widget-content">Non renseigné</td>
                                            </tr>
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </table>
                            </div>
                            <div class="line">
                                <h4>Accès à la donnée et aux documments associés:</h4>
                                <table class="ui-widget-content ui-corner-all">
                                    <tr class="ui-state-default ui-corner-all">
                                        <th>Nom</th>
                                        <th>Description</th>
                                        <th>Lien / URL</th>
                                    </tr>
                                    <xsl:choose>
                                        <xsl:when test="gmd:distributionInfo/gmd:MD_Distribution/gmd:transferOptions/gmd:MD_DigitalTransferOptions/gmd:onLine">
                                            <xsl:for-each select="gmd:distributionInfo/gmd:MD_Distribution/gmd:transferOptions/gmd:MD_DigitalTransferOptions/gmd:onLine">
                                                <tr>
                                                    <td class="ui-widget-content"><xsl:value-of select="gmd:CI_OnlineResource/gmd:name/gco:CharacterString/."/></td>
                                                    <td class="ui-widget-content"><xsl:value-of select="gmd:CI_OnlineResource/gmd:description/gco:CharacterString/."/></td>
                                                    <td class="ui-widget-content"><a href="{gmd:CI_OnlineResource/gmd:linkage/gmd:URL/.}" target="_blank"><xsl:value-of select="gmd:CI_OnlineResource/gmd:linkage/gmd:URL/."/></a></td>
                                                </tr>
                                            </xsl:for-each>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            <tr>
                                                <td class="ui-widget-content">Non renseigné</td>
                                                <td class="ui-widget-content">Non renseigné</td>
                                                <td class="ui-widget-content">Non renseigné</td>
                                            </tr>
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </table> 
                            </div>
                            <div class="line">
                                <h4>Diffuseur / distributeur:</h4>
                                <table class="ui-widget-content ui-corner-all">
                                    <tr class="ui-state-default ui-corner-all">
                                        <th>Contact</th>
                                        <th>Rôle</th>
                                    </tr>
                                    <xsl:choose>
                                        <xsl:when test="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:pointOfContact/gmd:CI_ResponsibleParty/gmd:role/gmd:CI_RoleCode/@codeListValue='resourceProvider'
                                        or gmd:identificationInfo/gmd:MD_DataIdentification/gmd:pointOfContact/gmd:CI_ResponsibleParty/gmd:role/gmd:CI_RoleCode/@codeListValue='distributor'">
                                            <xsl:for-each select="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:pointOfContact">
                                                <xsl:if test="gmd:CI_ResponsibleParty/gmd:role/gmd:CI_RoleCode/@codeListValue='resourceProvider'
                                                or gmd:CI_ResponsibleParty/gmd:role/gmd:CI_RoleCode/@codeListValue='distributor'">
                                                    <xsl:call-template name="responsibleParty">
                                                        <xsl:with-param name="val" select="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:pointOfContact"/>
                                                    </xsl:call-template>
                                                </xsl:if>
                                            </xsl:for-each>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            <tr>
                                                <td class="ui-widget-content">Non renseigné</td>
                                                <td class="ui-widget-content">Non renseigné</td>
                                            </tr>
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </table> 
                            </div>
                            
                        </div>
               
                        <div id="tabs-4">
                            
                            <h2 class="ui-state-default ui-corner-all">
                                4 - Infos sur la fiche
                            </h2>
                            
                            <div class="line">
                                <h4>URL de la fiche:</h4>
                                <div class="value">
                                    <span id="md_file_url"></span>
                                </div>
                            </div>
                            
                            <div class="line">
                                <h4 class="key-line">Identifiant de la fiche:</h4>
                                <div class="value-line">
                                    <xsl:choose>
                                        <xsl:when test="gmd:fileIdentifier/gco:CharacterString">
                                            <xsl:value-of select="gmd:fileIdentifier/gco:CharacterString"/>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            Non renseigné
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </div>
                            </div>

                            <div class="line">
                                <h4 class="key-line">Langue de la fiche:</h4>
                                <div class="value-line">
                                    <xsl:choose>
                                        <xsl:when test="gmd:language/gmd:LanguageCode">
                                            <xsl:call-template name="languageCode">
                                                <xsl:with-param name="val" select="gmd:language/gmd:LanguageCode/@codeListValue"/>
                                            </xsl:call-template>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            Non renseigné
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </div>
                            </div>

                            <div class="line">
                                <h4 class="key-line">Date d'édition de la fiche:</h4>
                                <div class="value-line">
                                    <xsl:choose>
                                        <xsl:when test="gmd:dateStamp/gco:Date">
                                            <xsl:value-of select="gmd:dateStamp/gco:Date"/>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            Non renseigné
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </div>
                            </div>
                            
                            <div class="line">
                                <h4 class="key-line">Jeu de charactères:</h4>
                                <div class="value-line">
                                    <xsl:choose>
                                        <xsl:when test="gmd:characterSet/gmd:MD_CharacterSetCode/@codeListValue">
                                            <xsl:value-of select="gmd:characterSet/gmd:MD_CharacterSetCode/@codeListValue"/>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            Non renseigné
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </div>
                            </div>
                            
                            <div class="line">
                                <h4 class="key-line">Type de ressource décrite:</h4>
                                <div class="value-line">
                                    <xsl:choose>
                                        <xsl:when test="gmd:hierarchyLevel/gmd:MD_ScopeCode">
                                            <xsl:call-template name="scopeCode">
                                                <xsl:with-param name="val" select="gmd:hierarchyLevel/gmd:MD_ScopeCode/@codeListValue"/>
                                            </xsl:call-template>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            Non renseigné
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </div>
                            </div>
                            
                            <div class="line">
                                <h4 class="key-line">Standard/version des métadonnées:</h4>
                                <div class="value-line">
                                    <xsl:choose>
                                        <xsl:when test="gmd:metadataStandardName/gco:CharacterString">
                                            <xsl:value-of select="gmd:metadataStandardName/gco:CharacterString"/> - 
                                            <xsl:value-of select="gmd:metadataStandardVersion/gco:CharacterString"/>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            Non renseigné
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </div>
                            </div>
                            
                            <div class="line">
                                <h4>Contact pour la fiche:</h4>
                                <table class="ui-widget-content ui-corner-all">
                                    <tr class="ui-state-default ui-corner-all">
                                        <th>Contact</th>
                                        <th>Rôle</th>
                                    </tr>
                                    <xsl:choose>
                                        <xsl:when test="gmd:contact">
                                            <xsl:for-each select="gmd:contact">
                                                <xsl:call-template name="responsibleParty">
                                                    <xsl:with-param name="val" select="gmd:contact"/>
                                                </xsl:call-template>
                                            </xsl:for-each>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            <tr>
                                                <td class="ui-widget-content">Non renseigné</td>
                                                <td class="ui-widget-content">Non renseigné</td>
                                            </tr>
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </table>   
                            </div>
                        
                        </div>
               
                        <div id="tabs-5">
                        
                            <h2 class="ui-state-default ui-corner-all">
                                5 - Contacts
                            </h2>
                            
                            <div class="line">
                                <h4>Contacts pour la donnée:</h4>
                                <table class="ui-widget-content ui-corner-all">
                                    <tr class="ui-state-default ui-corner-all">
                                        <th>Contact</th>
                                        <th>Rôle</th>
                                    </tr>
                                    <xsl:choose>
                                        <xsl:when test="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:pointOfContact">
                                            <xsl:for-each select="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:pointOfContact">
                                                <xsl:call-template name="responsibleParty">
                                                    <xsl:with-param name="val" select="gmd:identificationInfo/gmd:MD_DataIdentification/gmd:pointOfContact"/>
                                                </xsl:call-template>
                                            </xsl:for-each>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            <tr>
                                                <td class="ui-widget-content">Non renseigné</td>
                                                <td class="ui-widget-content">Non renseigné</td>
                                            </tr>
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </table> 
                            </div>
                            <div class="line">
                                <h4>Contacts pour la fiche de description de la donnée:</h4>
                                <table class="ui-widget-content ui-corner-all">
                                    <tr class="ui-state-default ui-corner-all">
                                        <th>Contact</th>
                                        <th>Rôle</th>
                                    </tr>
                                    <xsl:choose>
                                        <xsl:when test="gmd:contact">
                                            <xsl:for-each select="gmd:contact">
                                                <xsl:call-template name="responsibleParty">
                                                    <xsl:with-param name="val" select="gmd:contact"/>
                                                </xsl:call-template>
                                            </xsl:for-each>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            <tr>
                                                <td class="ui-widget-content">Non renseigné</td>
                                                <td class="ui-widget-content">Non renseigné</td>
                                            </tr>
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </table> 
                            </div>
                            
                        </div>
                        
                    </div>
                    
                    <div id="footer" class="ui-widget-header ui-corner-all">CIGAL 2012 - <a href="http://www.cigalsace.org">www.cigalsace.org</a></div>
                    
                </div>
            </body>
        </html>
    </xsl:template >
    
    <!-- Template pour la création d'un responsible Party -->
    <xsl:template name="responsibleParty">
        <xsl:param name="val"/>
        <tr>
            <td class="ui-widget-content">
                <strong>
                    <!-- individualName -->
                    <xsl:if test="gmd:CI_ResponsibleParty/gmd:individualName/gco:CharacterString != ''">
                        <xsl:value-of select="gmd:CI_ResponsibleParty/gmd:individualName/gco:CharacterString"/> <br />
                    </xsl:if>
                    <!-- positionName -->
                    <xsl:if test="gmd:CI_ResponsibleParty/gmd:positionName/gco:CharacterString != ''">
                        <xsl:value-of select="gmd:CI_ResponsibleParty/gmd:positionName/gco:CharacterString"/> <br />
                    </xsl:if>
                    <!-- organisationName -->
                    <xsl:if test="gmd:CI_ResponsibleParty/gmd:organisationName/gco:CharacterString != ''">
                        <xsl:value-of select="gmd:CI_ResponsibleParty/gmd:organisationName/gco:CharacterString"/> <br />
                    </xsl:if>
                </strong>
                <!-- deliveryPoint -->
                <xsl:if test="gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:address/gmd:CI_Address/gmd:deliveryPoint/gco:CharacterString != ''">
                    <xsl:for-each select='gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:address/gmd:CI_Address/gmd:deliveryPoint'>
                        <xsl:value-of select="gco:CharacterString"/> <br />
                    </xsl:for-each>
                </xsl:if>
                <!-- city / postalCode / country -->
                <xsl:if test="gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:address/gmd:CI_Address/gmd:city/gco:CharacterString != ''">
                    <xsl:value-of select="gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:address/gmd:CI_Address/gmd:postalCode/gco:CharacterString"/>
                    <xsl:value-of select="gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:address/gmd:CI_Address/gmd:city/gco:CharacterString"/>
                    <xsl:value-of select="gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:address/gmd:CI_Address/gmd:country/gco:CharacterString"/>
                    <br />
                </xsl:if>
                <!-- phone -->
                <xsl:if test="gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:phone/gmd:CI_Telephone/gmd:voice != ''">
                    Tél: 
                    <xsl:for-each select="gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:phone/gmd:CI_Telephone/gmd:voice">
                        <xsl:value-of select="gco:CharacterString"/> -
                    </xsl:for-each> <br />
                </xsl:if>
                <!-- facsimile -->
                <xsl:if test="gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:phone/gmd:CI_Telephone/gmd:facsimile != ''">
                    Fax:
                    <xsl:for-each select="gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:phone/gmd:CI_Telephone/gmd:facsimile">
                        <xsl:value-of select="gco:CharacterString"/> -
                    </xsl:for-each> <br />
                </xsl:if>
                <!-- electronicMailAddress -->
                <xsl:if test="gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:address/gmd:CI_Address/gmd:electronicMailAddress != ''">
                    E-mail: 
                    <xsl:for-each select="gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:address/gmd:CI_Address/gmd:electronicMailAddress">
                        <xsl:value-of select="gco:CharacterString"/> -
                    </xsl:for-each> <br />
                </xsl:if>
                <!-- internet -->
                <xsl:if test="gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:onlineResource/gmd:CI_OnlineResource/gmd:linkage != ''">
                    Site Internet: 
                    <xsl:for-each select="gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:onlineResource/gmd:CI_OnlineResource/gmd:linkage">
                        <xsl:value-of select="gmd:URL"/> -
                    </xsl:for-each> <br />
                </xsl:if>
            </td>
            <!-- role -->
            <td class="ui-widget-content">
                <xsl:for-each select="gmd:CI_ResponsibleParty/gmd:role">
                    <xsl:call-template name="roleCode">
                        <xsl:with-param name="val" select="gmd:CI_RoleCode/@codeListValue"/>
                    </xsl:call-template>                       
                </xsl:for-each> 
            </td>
        </tr>
    </xsl:template>

    <!-- Template de formatage de la date -->
    <xsl:template name="date">
        <xsl:param name="ladate"/>
        <xsl:value-of select="substring($ladate,9,2)"/>/<xsl:value-of select="substring($ladate,6,2)"/>/<xsl:value-of select="substring($ladate,1,4)"/>
    </xsl:template>
    
    <!-- Template de traduction des topicCategory -->
    <xsl:template name="topicCategoryCode">
        <xsl:param name="val"/>
        <xsl:value-of select="$fileMapping/xsl:stylesheet/map:Mapping/map:topicCategoryCode/map:code[@iso=$val]/@code"/>
    </xsl:template>
    
    <!-- Template de traduction des restrictionCode -->
    <xsl:template name="restrictionCode">
        <xsl:param name="val"/>
        <xsl:value-of select="$fileMapping/xsl:stylesheet/map:Mapping/map:restrictionCode/map:code[@iso=$val]/@code"/> 
    </xsl:template>
    
    <!-- Template de traduction des classificationCode -->
    <xsl:template name="classificationCode">
        <xsl:param name="val"/>
        <xsl:value-of select="$fileMapping/xsl:stylesheet/map:Mapping/map:classificationCode/map:code[@iso=$val]/@code"/> 
    </xsl:template>
    
    <!-- Template de traduction des spatialRepresentationTypeCode -->
    <xsl:template name="spatialRepresentationTypeCode">
        <xsl:param name="val"/>
        <xsl:value-of select="$fileMapping/xsl:stylesheet/map:Mapping/map:spatialRepresentationTypeCode/map:code[@iso=$val]/@code"/><br /> 
    </xsl:template>
    
    <!-- Template de traduction des roleCode -->
    <xsl:template name="roleCode">
        <xsl:param name="val"/>
        <xsl:value-of select="$fileMapping/xsl:stylesheet/map:Mapping/map:roleCode/map:code[@iso=$val]/@code"/><br /> 
    </xsl:template>
    
    <!-- Template de traduction des scopeCode -->
    <xsl:template name="scopeCode">
        <xsl:param name="val"/>
        <xsl:value-of select="$fileMapping/xsl:stylesheet/map:Mapping/map:scopeCode/map:code[@iso=$val]/@code"/><br /> 
    </xsl:template>
    
    <!-- Template de traduction des languageCode -->
    <xsl:template name="languageCode">
        <xsl:param name="val"/>
        <xsl:value-of select="$fileMapping/xsl:stylesheet/map:Mapping/map:languageCode/map:code[@iso=$val]/@code"/><br /> 
    </xsl:template>
    
    <!-- Template de traduction des dateTypeCode -->
    <xsl:template name="dateTypeCode">
        <xsl:param name="val"/>
        <xsl:value-of select="$fileMapping/xsl:stylesheet/map:Mapping/map:dateTypeCode/map:code[@iso=$val]/@code"/>
    </xsl:template>
    
    <!-- Template de traduction des maintenanceFrequencyCode -->
    <xsl:template name="maintenanceFrequencyCode">
        <xsl:param name="val"/>
        <xsl:value-of select="$fileMapping/xsl:stylesheet/map:Mapping/map:maintenanceFrequencyCode/map:code[@iso=$val]/@code"/>
    </xsl:template>
    
    <!-- Template de traduction des inspireThemeCode -->
    <xsl:template name="inspireThemeCode">
        <xsl:param name="val"/>
        <xsl:value-of select="$fileMapping/xsl:stylesheet/map:Mapping/map:inspireThemeCode/map:code[@iso=$val]/@code"/>
    </xsl:template>

</xsl:stylesheet>