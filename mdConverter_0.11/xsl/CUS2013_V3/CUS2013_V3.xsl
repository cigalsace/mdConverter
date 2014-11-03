<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="2.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                                                                                xmlns:gml="http://www.opengis.net/gml"
                                                                                xmlns:csw="http://www.opengis.net/cat/csw/2.0.2"
                                                                                xmlns:dc ="http://purl.org/dc/elements/1.1/"
                                                                                xmlns:dct="http://purl.org/dc/terms/"
                                                                                xmlns:gmd="http://www.isotc211.org/2005/gmd"
                                                                                xmlns:gco="http://www.isotc211.org/2005/gco"
                                                                                xmlns:ows="http://www.opengis.net/ows"
                                                                                xmlns:geonet="http://www.fao.org/geonetwork">
<xsl:output method="html" encoding="UTF-8" doctype-public="-//W3C//DTD HTML 4.01//EN" doctype-system="http://www.w3.org/TR/html4/strict.dtd" indent="yes" />

<xsl:variable name="basepath" select="'xsl/CUS2013_V3'"/>


<!-- Fonction affichant les informations génériques d'un contact -->
<xsl:template name="AfficheContactGenerique">
  <td width="80%">
		<xsl:if test="gmd:CI_ResponsibleParty/gmd:individualName/gco:CharacterString != ''">
			<b><i><xsl:value-of select="gmd:CI_ResponsibleParty/gmd:individualName/gco:CharacterString"/></i></b><br/>
		</xsl:if>
		<xsl:if test="gmd:CI_ResponsibleParty/gmd:positionName/gco:CharacterString != ''">
			<xsl:value-of select="gmd:CI_ResponsibleParty/gmd:positionName/gco:CharacterString"/><br/>
		</xsl:if>
		<xsl:if test="gmd:CI_ResponsibleParty/gmd:organisationName/gco:CharacterString != ''">
			<xsl:choose>
			<xsl:when  test="gmd:CI_ResponsibleParty/gmd:individualName/gco:CharacterString != ''">
				<xsl:value-of select="gmd:CI_ResponsibleParty/gmd:organisationName/gco:CharacterString"/><br/>
			</xsl:when>
			<xsl:otherwise>
				<b><i><xsl:value-of select="gmd:CI_ResponsibleParty/gmd:organisationName/gco:CharacterString"/></i></b><br/>
			</xsl:otherwise>
			</xsl:choose>
		</xsl:if>
		<xsl:if test="gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:address/gmd:CI_Address/gmd:deliveryPoint/gco:CharacterString != ''">			
			<xsl:value-of select="gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:address/gmd:CI_Address/gmd:deliveryPoint/gco:CharacterString"/><br/>
		</xsl:if>
		<xsl:if test="gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:address/gmd:CI_Address/gmd:postalCode/gco:CharacterString != ''">			
			<xsl:value-of select="gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:address/gmd:CI_Address/gmd:postalCode/gco:CharacterString"/>&#160;<xsl:value-of select="gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:address/gmd:CI_Address/gmd:city/gco:CharacterString"/><br/>
 		</xsl:if>
		<xsl:if test="gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:phone/gmd:CI_Telephone/gmd:voice/gco:CharacterString != ''">		
			T&#233;l : <xsl:value-of select="gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:phone/gmd:CI_Telephone/gmd:voice/gco:CharacterString"/><br/>
 		</xsl:if>
		<xsl:if test="gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:address/gmd:CI_Address/gmd:electronicMailAddress != ''">			
			E-mail : <xsl:value-of select="gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:address/gmd:CI_Address/gmd:electronicMailAddress"/><br/>
		</xsl:if>
 	</td>
</xsl:template>

<!-- Fonction affichant un type de contact -->
<xsl:template name="AfficheContact">
    <xsl:param name="typeContact" select="'default'" />
    <xsl:choose>
        <xsl:when test="$typeContact='pointdecontact'">
           <xsl:if test="gmd:CI_ResponsibleParty/gmd:role/gmd:CI_RoleCode = 'pointOfContact'">
            <xsl:call-template name="AfficheContactGenerique" />
           	<td>
           	   <xsl:text>Point de contact</xsl:text>
           	</td>
          </xsl:if>	
        </xsl:when>
        <xsl:when test="$typeContact='fournisseur'">
          <xsl:if test="gmd:CI_ResponsibleParty/gmd:role/gmd:CI_RoleCode = 'resourceProvider'">
            <xsl:call-template name="AfficheContactGenerique" />
           	<td>
           	   <xsl:text>Fournisseur</xsl:text>
           	</td>
          </xsl:if>	
        </xsl:when>
        <xsl:otherwise>
            <xsl:call-template name="AfficheContactGenerique" />
            <td>
            		<xsl:choose>
                  <xsl:when test="gmd:CI_ResponsibleParty/gmd:role/gmd:CI_RoleCode = 'resourceProvider'">
                    <xsl:text>Fournisseur</xsl:text>
                  </xsl:when>
                  <xsl:when test="gmd:CI_ResponsibleParty/gmd:role/gmd:CI_RoleCode = 'custodian'">
                    <xsl:text>Gestionnaire</xsl:text>
                  </xsl:when>
                  <xsl:when test="gmd:CI_ResponsibleParty/gmd:role/gmd:CI_RoleCode = 'owner'">
                    <xsl:text>Propriétaire</xsl:text>
                  </xsl:when>
                  <xsl:when test="gmd:CI_ResponsibleParty/gmd:role/gmd:CI_RoleCode = 'user'">
                    <xsl:text>Utilisateur</xsl:text>
                  </xsl:when>
                  <xsl:when test="gmd:CI_ResponsibleParty/gmd:role/gmd:CI_RoleCode = 'distributor'">
                    <xsl:text>Distributeur</xsl:text>
                  </xsl:when>
                  <xsl:when test="gmd:CI_ResponsibleParty/gmd:role/gmd:CI_RoleCode = 'originator'">
                    <xsl:text>Commanditaire</xsl:text>
                  </xsl:when>
                  <xsl:when test="gmd:CI_ResponsibleParty/gmd:role/gmd:CI_RoleCode = 'pointOfContact'">
                    <xsl:text>Point de contact</xsl:text>
                  </xsl:when>
                  <xsl:when test="gmd:CI_ResponsibleParty/gmd:role/gmd:CI_RoleCode = 'principalInvestigator'">
                    <xsl:text>Producteur / Maître d’œuvre principal ou d'ensemble</xsl:text>
                  </xsl:when>
                  <xsl:when test="gmd:CI_ResponsibleParty/gmd:role/gmd:CI_RoleCode = 'processor'">
                    <xsl:text>Intégrateur / Exécutant secondaire</xsl:text>
                  </xsl:when>
                  <xsl:when test="gmd:CI_ResponsibleParty/gmd:role/gmd:CI_RoleCode = 'publisher'">
                    <xsl:text>Editeur</xsl:text>
                  </xsl:when>
                  <xsl:when test="gmd:CI_ResponsibleParty/gmd:role/gmd:CI_RoleCode = 'author'">
                    <xsl:text>Auteur</xsl:text>
                  </xsl:when>
                </xsl:choose>						  
              </td>
        </xsl:otherwise>
    </xsl:choose>
</xsl:template>

<!-- Fonction affichant les restrictions -->
<xsl:template name="AfficheRestrictions">
  <xsl:choose>
      <xsl:when test="gmd:MD_RestrictionCode/@codeListValue = 'copyright'">
        <xsl:text>Droit d’auteur / Droit moral (copyright)</xsl:text><xsl:if test="not(position() = last())"> </xsl:if>
      </xsl:when>
      <xsl:when test="gmd:MD_RestrictionCode/@codeListValue = 'patent'">
        <xsl:text>Brevet</xsl:text><xsl:if test="not(position() = last())"></xsl:if>
      </xsl:when>
      <xsl:when test="gmd:MD_RestrictionCode/@codeListValue = 'patentPending'">
        <xsl:text>Brevet en instance</xsl:text><xsl:if test="not(position() = last())"></xsl:if>
      </xsl:when>
      <xsl:when test="gmd:MD_RestrictionCode/@codeListValue = 'trademark'">
        <xsl:text>Marque de commerce</xsl:text><xsl:if test="not(position() = last())"></xsl:if>
      </xsl:when>
      <xsl:when test="gmd:MD_RestrictionCode/@codeListValue = 'license'">
        <xsl:text>Licence</xsl:text><xsl:if test="not(position() = last())"> </xsl:if>
      </xsl:when>
      <xsl:when test="gmd:MD_RestrictionCode/@codeListValue = 'intellectualPropertyRights'">
        <xsl:text>Droit de propriété intellectuelle / Droit patrimonial</xsl:text><xsl:if test="not(position() = last())"></xsl:if>
      </xsl:when>
      <xsl:when test="gmd:MD_RestrictionCode/@codeListValue = 'restricted'">
        <xsl:text>Restreint</xsl:text><xsl:if test="not(position() = last())"></xsl:if>
      </xsl:when>
      <xsl:when test="gmd:MD_RestrictionCode/@codeListValue = 'otherRestrictions'">
        <xsl:text>Autres restrictions</xsl:text><xsl:if test="not(position() = last())"></xsl:if>
      </xsl:when>
	 </xsl:choose>
</xsl:template>

<!-- Compte les mots clés classés par thématiques -->
<xsl:template name="CompteItem">
  <xsl:param name="critRech" select="0" />
  <ul>
  <xsl:if test="count(gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:descriptiveKeywords/gmd:MD_Keywords/gmd:thesaurusName/gmd:CI_Citation/gmd:title[normalize-space(gco:CharacterString)=$critRech]) &gt; 0">
  <li>
     <xsl:value-of select="$critRech"/> : 
      <xsl:for-each select="gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:descriptiveKeywords">
        <xsl:if test="gmd:MD_Keywords/gmd:thesaurusName/gmd:CI_Citation/gmd:title/gco:CharacterString = $critRech">
    			<ul><li><xsl:value-of select="gmd:MD_Keywords/gmd:keyword/gco:CharacterString"/></li></ul>
	      </xsl:if>
	    </xsl:for-each>
	</li>
	 </xsl:if>
	 </ul>
</xsl:template>

<!-- Génère les catégories INSPIRE -->
<xsl:template name="GenereInspire">
   <ul>
  <xsl:for-each select="gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:descriptiveKeywords">
	    <xsl:if test="contains(gmd:MD_Keywords/gmd:thesaurusName/gmd:CI_Citation/gmd:title/gco:CharacterString,'GEMET - INSPIRE')">
	    <li>
				<xsl:choose>
								<xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Coordinate reference systems'">
				  <xsl:text>Référentiels de coordonnées</xsl:text>
				    </xsl:when>
								<xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Geographical grid systems'">
				      <xsl:text>Systèmes de maillage géographique</xsl:text>
				    </xsl:when>
							    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Geographical names'">
				      <xsl:text>Dénominations géographiques</xsl:text>
				    </xsl:when>
				    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Administrative units'">
				      <xsl:text>Unités administratives </xsl:text>
				    </xsl:when>
				    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Addresses'">
				      <xsl:text>Adresses</xsl:text>
				    </xsl:when>
							    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Cadastral parcels'">
				      <xsl:text>Parcelles cadastrales </xsl:text>
				    </xsl:when>
				    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Transport networks'">
				      <xsl:text>Réseaux de transport</xsl:text>
				    </xsl:when>
				    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Hydrography'">
				      <xsl:text>Hydrographie</xsl:text>
				    </xsl:when>
				    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Protected sites'">
				      <xsl:text>Sites protégés</xsl:text>
				    </xsl:when>
				    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Elevation'">
				      <xsl:text>Altitude</xsl:text>
				    </xsl:when>
				    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Land cover'">
				      <xsl:text>Occupation des terres</xsl:text>
				    </xsl:when>
							    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Orthoimagery'">
				      <xsl:text>Ortho-imagerie</xsl:text>
				    </xsl:when>
				    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Geology'">
				      <xsl:text>Géologie</xsl:text>
				    </xsl:when>
				    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Statistical units'">
				      <xsl:text>Unités statistiques</xsl:text>
				    </xsl:when>
				    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Buildings'">
				      <xsl:text>Bâtiments</xsl:text>
				    </xsl:when>
							    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Soil'">
				      <xsl:text>Sols</xsl:text>
				    </xsl:when>
				    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Land use'">
				      <xsl:text>Usage des sols</xsl:text>
				    </xsl:when>
				    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Human health and safety'">
				      <xsl:text>Santé et sécurité des personnes</xsl:text>
				    </xsl:when>
				    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Utility and governmental services'">
				      <xsl:text>Services d'utilité publique et services publics</xsl:text>
				    </xsl:when>
				    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Environmental monitoring facilities'">
				      <xsl:text>Installations de suivi environnemental</xsl:text>
				    </xsl:when>
				    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Production and industrial facilities'">
				      <xsl:text>Lieux de production et sites industriels</xsl:text>
				    </xsl:when>
				    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Agricultural and aquaculture facilities'">
				      <xsl:text>Installations agricoles et aquacoles</xsl:text>
				    </xsl:when>
				    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Population distribution — demography'">
				      <xsl:text>Répartition de la population – démographie</xsl:text>
				    </xsl:when>
				    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Area management/restriction/regulation zones and reporting units'">
				      <xsl:text>Zones de gestion, de restriction ou de réglementation et unités de déclaration</xsl:text>
				    </xsl:when>
				    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Natural risk zones'">
				      <xsl:text>Zones à risque naturel</xsl:text>
				    </xsl:when>
				    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Atmospheric conditions'">
				      <xsl:text>Conditions atmosphériques</xsl:text>
				    </xsl:when>
				    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Meteorological geographical features'">
				      <xsl:text>Caractéristiques géographiques météorologiques</xsl:text>
				    </xsl:when>
				    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Oceanographic geographical features'">
				      <xsl:text>Caractéristiques géographiques océanographiques</xsl:text>
				    </xsl:when>
				    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Sea regions'">
				      <xsl:text>Régions maritimes</xsl:text>
				    </xsl:when>
				    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Bio-geographical regions'">
				      <xsl:text>Régions biogéographiques</xsl:text>
				    </xsl:when>
				    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Habitats and biotopes'">
				      <xsl:text>Habitats et biotopes</xsl:text>
				    </xsl:when>
				    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Species distribution'">
				      <xsl:text>Répartition des espèces</xsl:text>
				    </xsl:when>
				    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Energy resources'">
				      <xsl:text>Sources d'énergie</xsl:text>
				    </xsl:when>
				    <xsl:when test="gmd:MD_Keywords/gmd:keyword/gco:CharacterString = 'Mineral resources'">
				      <xsl:text>Ressources minérales</xsl:text>
				    </xsl:when>
				  </xsl:choose>
		</li>
		</xsl:if>
	</xsl:for-each>
	</ul>
</xsl:template>

<xsl:template match = "/" > 
	<html>
		<head>
			<meta http-equiv="X-UA-Compatible" content="IE=8"/>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<link rel="stylesheet" href="xsl/CUS2013_V3/css/CUS-ElyxWEB.css" type="text/css"/>
<!-- DEBUT Ajout JCG -->
			<link rel="stylesheet" href="xsl/CUS2013_V3/css/jquery-ui-1.9.0.custom.min.css" type="text/css"/>
<!-- FIN Ajout JCG -->
			<title><xsl:value-of select="/gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:citation/gmd:CI_Citation/gmd:title/gco:CharacterString"/></title>
            
            <script type="text/javascript" src="{$basepath}/js/jquery-1.10.2.min.js"></script>
            <script type="text/javascript" src="{$basepath}/js/index.js"></script>
			<script type="text/javascript">
				function change_onglet(name)
				{
					document.getElementById('onglet_'+anc_onglet).className = 'onglet_0 onglet';
					document.getElementById('onglet_'+name).className = 'onglet_1 onglet';
					document.getElementById('contenu_onglet_'+anc_onglet).style.display = 'none';
					document.getElementById('contenu_onglet_'+name).style.display = 'block';
					anc_onglet = name;
				}
			</script>
<!-- Ajout JCG -->
			<script type="text/javascript">
				function imprimer()
				{
					document.getElementById('contenu_onglet_decouvrir').style.display = 'block';
					document.getElementById('contenu_onglet_analyser').style.display = 'block';
					document.getElementById('contenu_onglet_acceder').style.display = 'block';
					document.getElementById('contenu_onglet_contact').style.display = 'block';
					print();
				}
			</script>
<!-- Fin ajout JCG -->
		</head>
		
		<body class="general">
			<div id="conteneur">
			<div id="panneau">
				<span class="bandeau_milieu">
					<div class="titreappli">Fiche descriptive d'un lot de données géographiques</div>
				</span>
				<span id="header"></span>           
			</div>
			<div id="contenu">
<!-- Ajout JCG -->
<table class="titre"><tr><td class="titre">
<!-- Fin ajout JCG -->
				<h1><xsl:value-of select="gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:citation/gmd:CI_Citation/gmd:title/gco:CharacterString"/></h1>
<!-- Ajout JCG -->
</td><td class="titre">
 <span class="ui-state-default ui-corner-all ui-icon ui-icon-print" style="float: left; margin: 0 5px 0 0;" onclick="javascript:imprimer();"></span>
</td>
</tr></table>
<!-- Fin ajout JCG -->
				<div class="paragraphe">

<!-- Modif JCG -->
					<xsl:for-each select="gmd:MD_Metadata/gmd:distributionInfo/gmd:MD_Distribution/gmd:transferOptions/gmd:MD_DigitalTransferOptions/gmd:onLine/gmd:CI_OnlineResource">
						<xsl:choose>
						    <xsl:when test="gmd:name/gco:CharacterString = 'Logo'">
						      <img class="imageLogo" src="{gmd:linkage/gmd:URL/.}" alt="{gmd:description/gco:CharacterString/.}"></img>
						    </xsl:when>
						</xsl:choose>

					</xsl:for-each>
<!--- Modif JCG -->
	  <xsl:value-of select="substring(gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:abstract/gco:CharacterString,0,700)" />...
				</div>
				<div class="onglets">
					<span class="onglet_0 onglet" id="onglet_decouvrir" onclick="javascript:change_onglet('decouvrir');">D&#233;couvrir la donn&#233;e</span>
					<span class="onglet_0 onglet" id="onglet_analyser" onclick="javascript:change_onglet('analyser');">Analyser la donn&#233;e</span>
					<span class="onglet_0 onglet" id="onglet_acceder" onclick="javascript:change_onglet('acceder');">Acc&#233;der &#224; la donn&#233;e</span>
					<span class="onglet_0 onglet" id="onglet_contact" onclick="javascript:change_onglet('contact');">Contacts</span>
				</div>
				<div class="contenu_onglets">
					<div class="contenu_onglet" id="contenu_onglet_decouvrir">
						<h2>Aperçu</h2>
						<div class="paragraphe">
							<span class="pavegauche"><pre>Illustration :</pre></span>
							<span class="pavedroit">
								<div id="browsegraphic">
									<xsl:choose>
									    <xsl:when test="gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:graphicOverview">
										<xsl:for-each select="gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:graphicOverview">
										    <img class="ui-corner-all" src="{gmd:MD_BrowseGraphic/gmd:fileName/gco:CharacterString/.}"></img>
										  <!--  <div><xsl:value-of select="gmd:MD_BrowseGraphic/gmd:fileName/gco:CharacterString/." /> <br /> <xsl:value-of select="gmd:MD_BrowseGraphic/gmd:fileDescription/gco:CharacterString/." /></div> -->
										</xsl:for-each>
									    </xsl:when>
									    <xsl:otherwise>
										Non renseigné
									    </xsl:otherwise>
									</xsl:choose>
								</div>
							</span>
						</div>
						<div class="paragraphe">
							<span class="pavegauche"><pre>Résumé :</pre></span>
							<span class="pavedroit">
								<pre><xsl:value-of select="gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:abstract/gco:CharacterString"/></pre>
							</span>
						</div>
						<h2>Thématiques</h2>
						<div class="paragraphe">
							<span  class="pavegauche"><pre>Cat&#233;gorie internationale :</pre></span>
							<span class="pavedroit">
								<ul>
								<xsl:for-each select="gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:topicCategory">
								  <li>
								  <xsl:choose>
								    <xsl:when test="gmd:MD_TopicCategoryCode = 'farming'">
								      <xsl:text>Agriculture</xsl:text>
								    </xsl:when>
								    <xsl:when test="gmd:MD_TopicCategoryCode = 'biota'">
								      <xsl:text>Flore et faune</xsl:text>
								    </xsl:when>
								    <xsl:when test="gmd:MD_TopicCategoryCode = 'boundaries'">
								      <xsl:text>Limites politiques et administratives</xsl:text>
								    </xsl:when>
								    <xsl:when test="gmd:MD_TopicCategoryCode = 'climatologyMeteorologyAtmosphere'">
								      <xsl:text>Climatologie, météorologie</xsl:text>
								    </xsl:when>
								    <xsl:when test="gmd:MD_TopicCategoryCode = 'economy'">
								      <xsl:text>Economie</xsl:text>
								    </xsl:when>
								    <xsl:when test="gmd:MD_TopicCategoryCode = 'elevation'">
								      <xsl:text>Topographie</xsl:text>
								    </xsl:when>
								    <xsl:when test="gmd:MD_TopicCategoryCode = 'environnement'">
								      <xsl:text>Ressources et gestion de l’environnement</xsl:text>
								    </xsl:when>
								    <xsl:when test="gmd:MD_TopicCategoryCode = 'geoscientificInformation'">
								      <xsl:text>Géosciences</xsl:text>
								    </xsl:when>
								    <xsl:when test="gmd:MD_TopicCategoryCode = 'health'">
								      <xsl:text>Santé</xsl:text>
								    </xsl:when>
								    <xsl:when test="gmd:MD_TopicCategoryCode = 'imageryBaseMapsEarthCover'">
								      <xsl:text>Carte de référence de la couverture terrestre</xsl:text>
								    </xsl:when>
								    <xsl:when test="gmd:MD_TopicCategoryCode = 'intelligenceMilitary'">
								      <xsl:text>Infrastructures militaires</xsl:text>
								    </xsl:when>
								    <xsl:when test="gmd:MD_TopicCategoryCode = 'inlandWaters'">
								      <xsl:text>Hydrographie </xsl:text>
								    </xsl:when>
								    <xsl:when test="gmd:MD_TopicCategoryCode = 'location'">
								      <xsl:text>Localisant</xsl:text>
								    </xsl:when>
								    <xsl:when test="gmd:MD_TopicCategoryCode = 'oceans'">
								      <xsl:text>Océans</xsl:text>
								    </xsl:when>
								    <xsl:when test="gmd:MD_TopicCategoryCode = 'planningCadastre'">
								      <xsl:text>Planification et aménagement du territoire</xsl:text>
								    </xsl:when>
								    <xsl:when test="gmd:MD_TopicCategoryCode = 'society'">
								      <xsl:text>Société</xsl:text>
								    </xsl:when>
								    <xsl:when test="gmd:MD_TopicCategoryCode = 'structure'">
								      <xsl:text>Aménagements urbains </xsl:text>
								    </xsl:when>
								    <xsl:when test="gmd:MD_TopicCategoryCode = 'transportation'">
								      <xsl:text>Infrastructures de transport </xsl:text>
								    </xsl:when>
								    <xsl:when test="gmd:MD_TopicCategoryCode = 'utilitiesCommunication'">
								      <xsl:text>Réseaux de télécommunication, d’énergie </xsl:text>
								    </xsl:when>
								  </xsl:choose>
								  </li>
								  </xsl:for-each>
								  </ul>
							</span>
						</div>
						<div class="paragraphe">
							<span  class="pavegauche"><pre>Classification europ&#232;enne : </pre></span>
							<span class="pavedroit"><xsl:call-template name="GenereInspire" /></span>
						</div>
						<div class="paragraphe">
							<span  class="pavegauche"><pre>Mots cl&#232;s :</pre></span>
							<span class="pavedroit">
    				    <xsl:call-template name="CompteItem">
    				      <xsl:with-param name="critRech" select="'GEMET'" />
    				    </xsl:call-template>
    					  <xsl:call-template name="CompteItem">
    				      <xsl:with-param name="critRech" select="'Localisation'" />
    				    </xsl:call-template>
    				    <xsl:call-template name="CompteItem">
    				      <xsl:with-param name="critRech" select="'CARTE'" />
    				    </xsl:call-template>
    				    <xsl:call-template name="CompteItem">
    				      <xsl:with-param name="critRech" select="'CTNET'" />
    				    </xsl:call-template>
    				    <xsl:call-template name="CompteItem">
    				      <xsl:with-param name="critRech" select="'Autre'" />
    				    </xsl:call-template>
    				  </span>
    				</div>
					<h2>Emprise</h2>
						<div class="paragraphe">
							<table>
								<tr><th>Nom</th><th>W</th><th>E</th><th>S</th><th>N</th></tr>
								<tr>
									<td><xsl:value-of select="gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:extent/gmd:EX_Extent/gmd:description/gco:CharacterString"/></td>
									<td><xsl:value-of select="format-number(gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:extent/gmd:EX_Extent/gmd:geographicElement/gmd:EX_GeographicBoundingBox/gmd:westBoundLongitude/gco:Decimal,'.0000')"/></td>
									<td><xsl:value-of select="format-number(gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:extent/gmd:EX_Extent/gmd:geographicElement/gmd:EX_GeographicBoundingBox/gmd:eastBoundLongitude/gco:Decimal,'.0000')"/></td>
									<td><xsl:value-of select="format-number(gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:extent/gmd:EX_Extent/gmd:geographicElement/gmd:EX_GeographicBoundingBox/gmd:southBoundLatitude/gco:Decimal,'.0000')"/></td>
									<td><xsl:value-of select="format-number(gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:extent/gmd:EX_Extent/gmd:geographicElement/gmd:EX_GeographicBoundingBox/gmd:northBoundLatitude/gco:Decimal,'.0000')"/></td>
								</tr>
							
							</table>
						</div>
					</div>
					
					<div class="contenu_onglet" id="contenu_onglet_analyser">
						<h2>Informations g&#233;n&#233;rales</h2>
						<div class="paragraphe">
							<span  class="pavegauche">Type de repr&#233;sentation :</span><span class="pavedroit">
                <xsl:choose>
								  <xsl:when test="gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:spatialRepresentationType/gmd:MD_SpatialRepresentationTypeCode/@codeListValue = 'vector'">
                    <xsl:text>Vecteur</xsl:text>
                  </xsl:when>
                  <xsl:when test="gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:spatialRepresentationType/gmd:MD_SpatialRepresentationTypeCode/@codeListValue = 'grid'">
                    <xsl:text>Raster</xsl:text>
                  </xsl:when>
                  <xsl:when test="gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:spatialRepresentationType/gmd:MD_SpatialRepresentationTypeCode/@codeListValue = 'textTable'">
                    <xsl:text>Table texte</xsl:text>
                  </xsl:when>
                  <xsl:when test="gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:spatialRepresentationType/gmd:MD_SpatialRepresentationTypeCode/@codeListValue = 'tin'">
                    <xsl:text>Tin</xsl:text>
                  </xsl:when>
                  <xsl:when test="gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:spatialRepresentationType/gmd:MD_SpatialRepresentationTypeCode/@codeListValue = 'stereoModel'">
                    <xsl:text>Vue 3D</xsl:text>
                  </xsl:when>
                  <xsl:when test="gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:spatialRepresentationType/gmd:MD_SpatialRepresentationTypeCode/@codeListValue = 'video'">
                    <xsl:text>Vidéo</xsl:text>
                  </xsl:when>
                </xsl:choose>
              </span>
						</div>
						<div class="paragraphe">
							<span  class="pavegauche">Syst&#232;me de projection :</span><span class="pavedroit"><xsl:value-of select="gmd:MD_Metadata/gmd:referenceSystemInfo/gmd:MD_ReferenceSystem/gmd:referenceSystemIdentifier/gmd:RS_Identifier/gmd:code/gco:CharacterString"/></span>
						</div>
						<div class="paragraphe">
							<span  class="pavegauche">Echelle ou Taille pixel (m) :</span><span class="pavedroit"><xsl:value-of select="gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:spatialResolution/gmd:MD_Resolution/gmd:equivalentScale/gmd:MD_RepresentativeFraction/gmd:denominator/gco:Integer"/></span>
						</div>
						<div class="paragraphe">
						  <span  class="pavegauche">Langue des donn&#233;es :</span><span class="pavedroit">
  						  <xsl:choose>
                    <xsl:when test="gmd:MD_Metadata/gmd:language/gmd:LanguageCode = 'fre'">
                      <xsl:text>Français</xsl:text>
                    </xsl:when>
                    <xsl:when test="gmd:MD_Metadata/gmd:language/gmd:LanguageCode = 'eng'">
                      <xsl:text>Anglais</xsl:text>
                    </xsl:when>
                    <xsl:when test="gmd:MD_Metadata/gmd:language/gmd:LanguageCode = 'ger'">
                      <xsl:text>Allemand</xsl:text>
                    </xsl:when>
                </xsl:choose>
						  </span>
            </div>
						
						<h2>Qualit&#233; de la donn&#233;e</h2>
						<xsl:for-each select="gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:citation/gmd:CI_Citation/gmd:date/gmd:CI_Date[gmd:dateType/gmd:CI_DateTypeCode/@codeListValue='creation']">
						  <div class="paragraphe">
            		<xsl:variable name="date" select="gmd:date/gco:Date"/>
								<span  class="pavegauche">Date de cr&#233;ation :</span><span class="pavedroit"><xsl:value-of select="concat(substring($date,9,2),'/',substring($date,6,2),'/',substring($date,1,4))"/></span>	
						  </div>
						</xsl:for-each>
						<xsl:for-each select="gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:citation/gmd:CI_Citation/gmd:date/gmd:CI_Date[gmd:dateType/gmd:CI_DateTypeCode/@codeListValue='publication']">
						  <div class="paragraphe">
            		<xsl:variable name="date" select="gmd:date/gco:Date"/>
                <span  class="pavegauche">Date de publication :</span><span class="pavedroit"><xsl:value-of select="concat(substring($date,9,2),'/',substring($date,6,2),'/',substring($date,1,4))"/></span>
              </div>
						</xsl:for-each>
            <xsl:for-each select="gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:citation/gmd:CI_Citation/gmd:date/gmd:CI_Date[gmd:dateType/gmd:CI_DateTypeCode/@codeListValue='revision']">
						  <div class="paragraphe">
            		<xsl:variable name="date" select="gmd:date/gco:Date"/>
                <span  class="pavegauche">Date de r&#233;vision :</span><span class="pavedroit"><xsl:value-of select="concat(substring($date,9,2),'/',substring($date,6,2),'/',substring($date,1,4))"/></span>
						  </div>
            </xsl:for-each>
						<div class="paragraphe">
							<span  class="pavegauche">Fr&#233;quence de mise &#224; jour :</span>
							
							<span class="pavedroit">
								<xsl:choose>
								  <xsl:when test="gmd:MD_Metadata/gmd:resourceMaintenance/gmd:MD_MaintenanceInformation/gmd:maintenanceAndUpdateFrequency/gmd:MD_MaintenanceFrequencyCode/@codeListValue = 'continual'">
								    <xsl:text>en continu</xsl:text>
								  </xsl:when>
								  <xsl:when test="gmd:MD_Metadata/gmd:resourceMaintenance/gmd:MD_MaintenanceInformation/gmd:maintenanceAndUpdateFrequency/gmd:MD_MaintenanceFrequencyCode/@codeListValue = 'daily'">
								    <xsl:text>quotidien</xsl:text>
								  </xsl:when>
								  <xsl:when test="gmd:MD_Metadata/gmd:resourceMaintenance/gmd:MD_MaintenanceInformation/gmd:maintenanceAndUpdateFrequency/gmd:MD_MaintenanceFrequencyCode/@codeListValue = 'weekly'">
								    <xsl:text>hebdomadaire</xsl:text>
								  </xsl:when>
								  <xsl:when test="gmd:MD_Metadata/gmd:resourceMaintenance/gmd:MD_MaintenanceInformation/gmd:maintenanceAndUpdateFrequency/gmd:MD_MaintenanceFrequencyCode/@codeListValue = 'fortnightly'">
								    <xsl:text>tous les 15 jours</xsl:text>
								  </xsl:when>
								  <xsl:when test="gmd:MD_Metadata/gmd:resourceMaintenance/gmd:MD_MaintenanceInformation/gmd:maintenanceAndUpdateFrequency/gmd:MD_MaintenanceFrequencyCode/@codeListValue = 'monthly'">
								    <xsl:text>mensuel</xsl:text>
								  </xsl:when>
								  <xsl:when test="gmd:MD_Metadata/gmd:resourceMaintenance/gmd:MD_MaintenanceInformation/gmd:maintenanceAndUpdateFrequency/gmd:MD_MaintenanceFrequencyCode/@codeListValue = 'quaterly'">
								    <xsl:text>trimestriel</xsl:text>
								  </xsl:when>
								  <xsl:when test="gmd:MD_Metadata/gmd:resourceMaintenance/gmd:MD_MaintenanceInformation/gmd:maintenanceAndUpdateFrequency/gmd:MD_MaintenanceFrequencyCode/@codeListValue = 'biannualy'">
								    <xsl:text>semestriel</xsl:text>
								  </xsl:when>
								  <xsl:when test="gmd:MD_Metadata/gmd:resourceMaintenance/gmd:MD_MaintenanceInformation/gmd:maintenanceAndUpdateFrequency/gmd:MD_MaintenanceFrequencyCode/@codeListValue = 'annualy'">
								    <xsl:text>annuel</xsl:text>
								  </xsl:when>
								  <xsl:when test="gmd:MD_Metadata/gmd:resourceMaintenance/gmd:MD_MaintenanceInformation/gmd:maintenanceAndUpdateFrequency/gmd:MD_MaintenanceFrequencyCode/@codeListValue = 'adNeeded'">
								    <xsl:text>quand nécessaire</xsl:text>
								  </xsl:when>
								  <xsl:when test="gmd:MD_Metadata/gmd:resourceMaintenance/gmd:MD_MaintenanceInformation/gmd:maintenanceAndUpdateFrequency/gmd:MD_MaintenanceFrequencyCode/@codeListValue = 'irregular'">
								    <xsl:text>irrégulier</xsl:text>
								  </xsl:when>
								  <xsl:when test="gmd:MD_Metadata/gmd:resourceMaintenance/gmd:MD_MaintenanceInformation/gmd:maintenanceAndUpdateFrequency/gmd:MD_MaintenanceFrequencyCode/@codeListValue = 'notPlanned'">
								    <xsl:text>non planifié</xsl:text>
								  </xsl:when>
								  <xsl:when test="gmd:MD_Metadata/gmd:resourceMaintenance/gmd:MD_MaintenanceInformation/gmd:maintenanceAndUpdateFrequency/gmd:MD_MaintenanceFrequencyCode/@codeListValue = 'unknow'">
								    <xsl:text>inconnu</xsl:text>
								  </xsl:when>
								  <xsl:otherwise>Non renseignée</xsl:otherwise>
								</xsl:choose>
							</span>
						</div>
						
						<div class="paragraphe">
							<span  class="pavegauche"><pre>G&#233;n&#233;alogie et qualit&#233; :</pre></span><span class="pavedroit"><pre><xsl:value-of select="gmd:MD_Metadata/gmd:dataQualityInfo/gmd:DQ_DataQuality/gmd:lineage/gmd:LI_Lineage/gmd:statement/gco:CharacterString"/></pre></span>
						</div>
						
						<h2>Point de contact</h2>
						<div class="paragraphe">
							<table>
								<tr><th>Contact</th><th>R&#244;le</th></tr>
								<xsl:for-each select="gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:pointOfContact">
									<tr>
									  <xsl:call-template name="AfficheContact">
									     <xsl:with-param name="typeContact" select="'pointdecontact'" />
									  </xsl:call-template>
									</tr>
								</xsl:for-each>
							</table>
						</div>
			
						<h2>Conformit&#233;</h2>
						<div class="paragraphe">
							<table>
								<tr><th>Titre du test</th><th>Date cr&#233;ation</th><th>Date r&#233;vision</th><th>Date publication</th><th>R&#233;sultat</th><th>Conformit&#233;</th></tr>
									
								<xsl:for-each select="gmd:MD_Metadata/gmd:dataQualityInfo/gmd:DQ_DataQuality/gmd:report/gmd:DQ_DomainConsistency/gmd:result/gmd:DQ_ConformanceResult">
									<tr>
										<td><xsl:value-of select="gmd:specification/gmd:CI_Citation/gmd:title/gco:CharacterString"/></td>
										<td>
											<xsl:for-each select="gmd:specification/gmd:CI_Citation/gmd:date/gmd:CI_Date[gmd:dateType/gmd:CI_DateTypeCode/@codeListValue='creation']">
												<xsl:variable name="date" select="gmd:date/gco:Date"/>
												<xsl:value-of select="concat(substring($date,9,2),'/',substring($date,6,2),'/',substring($date,1,4))"/>
											</xsl:for-each>
										</td>
										<td>
											<xsl:for-each select="gmd:specification/gmd:CI_Citation/gmd:date/gmd:CI_Date[gmd:dateType/gmd:CI_DateTypeCode/@codeListValue='revision']">
												<xsl:variable name="date" select="gmd:date/gco:Date"/>
                        <xsl:value-of select="concat(substring($date,9,2),'/',substring($date,6,2),'/',substring($date,1,4))"/>
											</xsl:for-each>
										</td>
										<td>
											<xsl:for-each select="gmd:specification/gmd:CI_Citation/gmd:date/gmd:CI_Date[gmd:dateType/gmd:CI_DateTypeCode/@codeListValue='publication']">
												<xsl:variable name="date" select="gmd:date/gco:Date"/>
                        <xsl:value-of select="concat(substring($date,9,2),'/',substring($date,6,2),'/',substring($date,1,4))"/>
											</xsl:for-each>
										</td>
										<td><xsl:value-of select="gmd:explanation/gco:CharacterString"/></td>
										<td>
										  <xsl:choose>
                        <xsl:when test="not(gmd:pass/gco:Boolean)">
                            non évalué
                        </xsl:when>
                        <xsl:otherwise>
                          <xsl:if test="gmd:pass/gco:Boolean = 'true'">conforme</xsl:if>
                          <xsl:if test="gmd:pass/gco:Boolean = 'false'">non conforme</xsl:if>
                        </xsl:otherwise>
                      </xsl:choose>
                    </td>
									</tr>
								</xsl:for-each>
							</table>
						</div>
					</div>
					
					<div class="contenu_onglet" id="contenu_onglet_acceder">					
						<h2>Contraintes et limites légales d'accès</h2>
						
						<div class="paragraphe">
							<span  class="pavegauche"><pre>Mentions légales :</pre></span>
							<span  class="pavedroit">
								<ul>
								<xsl:choose>
								    <xsl:when test="gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:resourceConstraints/gmd:MD_Constraints/gmd:useLimitation">
									<xsl:for-each select="gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:resourceConstraints/gmd:MD_Constraints/gmd:useLimitation">
									    <li><pre><xsl:value-of select="gco:CharacterString/."/></pre></li>
									</xsl:for-each>
								    </xsl:when>
								    <xsl:otherwise><li>Non renseigné</li></xsl:otherwise>
								</xsl:choose>
								</ul>
							</span>
						</div>
						<div class="paragraphe">
							<span  class="pavegauche"><pre>Contraintes légales <br />d'accès public :</pre></span>
							<span  class="pavedroit">
								<ul>
								<xsl:if test="gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:resourceConstraints/gmd:MD_LegalConstraints/gmd:otherConstraints">
								    <xsl:for-each select='gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:resourceConstraints/gmd:MD_LegalConstraints/gmd:otherConstraints'>
									<li><xsl:value-of select="gco:CharacterString/."/></li>
								    </xsl:for-each>
								</xsl:if>
								<xsl:if test="gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:resourceConstraints/gmd:MD_LegalConstraints/gmd:accessConstraints">
								    <xsl:for-each select="gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:resourceConstraints/gmd:MD_LegalConstraints/gmd:accessConstraints">
									<li><xsl:call-template name="AfficheRestrictions" /></li>
								    </xsl:for-each>
								</xsl:if>
								</ul>
							</span>
						</div>
						<div class="paragraphe">
							<span  class="pavegauche"><pre>Restrictions d'utilisation :</pre></span>
							<span  class="pavedroit">
							<ul><li>
							<xsl:choose>
							    <xsl:when test="gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:resourceConstraints/gmd:MD_SecurityConstraints/gmd:classification/gmd:MD_ClassificationCode">
								<xsl:for-each select="gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:resourceConstraints/gmd:MD_SecurityConstraints/gmd:classification">
								  <xsl:choose>
								    <xsl:when test="gmd:MD_ClassificationCode/@codeListValue = 'unclassified'">
								      <xsl:text>Non classifié</xsl:text><br/>
								    </xsl:when>
								    <xsl:when test="gmd:MD_ClassificationCode/@codeListValue = 'restricted'">
								      <xsl:text>Restreint</xsl:text><br/>
								    </xsl:when>
								    <xsl:when test="gmd:MD_ClassificationCode/@codeListValue = 'confidential'">
								      <xsl:text>Confidentiel</xsl:text><br/>
								    </xsl:when>
								    <xsl:when test="gmd:MD_ClassificationCode/@codeListValue = 'secret'">
								      <xsl:text>Secret</xsl:text><br/>
								    </xsl:when>
								    <xsl:when test="gmd:MD_ClassificationCode/@codeListValue = 'topSecret'">
								      <xsl:text>Top secret</xsl:text><br/>
								    </xsl:when>
								  </xsl:choose>               
								</xsl:for-each>
							    </xsl:when>
							    <xsl:otherwise>Non renseigné</xsl:otherwise>
							</xsl:choose>
							</li></ul>
							</span>
							
						</div>

						<h2>Format de diffusion</h2>
						<div class="paragraphe">
							<table>
								<tr><th>Nom</th><th>Version</th><th>Description</th></tr>
								<xsl:for-each select="gmd:MD_Metadata/gmd:distributionInfo/gmd:MD_Distribution/gmd:distributionFormat/gmd:MD_Format">
									<tr>
										<td><xsl:value-of select="gmd:name/gco:CharacterString"/></td>
										<td><xsl:value-of select="gmd:version/gco:CharacterString"/></td>
										<td><xsl:value-of select="gmd:specification/gco:CharacterString"/></td>
									</tr>
								</xsl:for-each>
							</table>
						</div>
						
						<h2>Acc&#232;s aux donn&#233;es et documents associ&#233;s</h2>
						<div class="paragraphe">
							<table>
								<tr><th>Nom</th><th>Description</th><th>Lien / URL</th></tr>
								<xsl:for-each select="gmd:MD_Metadata/gmd:distributionInfo/gmd:MD_Distribution/gmd:transferOptions/gmd:MD_DigitalTransferOptions/gmd:onLine/gmd:CI_OnlineResource">
									<xsl:choose>
										<xsl:when test="gmd:name/gco:CharacterString != 'Logo'">							
												<tr>
													<td><xsl:value-of select="gmd:name/gco:CharacterString"/></td>
													<td><xsl:value-of select="gmd:description/gco:CharacterString"/></td>
													<td><xsl:value-of select="gmd:linkage/gmd:URL"/></td>
												</tr>
										</xsl:when>
									</xsl:choose>
								</xsl:for-each>
							</table>
						</div>
						
						<h2>Fournisseur(s)</h2>
						<div class="paragraphe">
							<table>
								<tr><th>Contact</th><th>R&#244;le</th></tr>
								<xsl:for-each select="gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:pointOfContact">
									<tr>
										<xsl:call-template name="AfficheContact">
									     <xsl:with-param name="typeContact" select="'fournisseur'" />
									  </xsl:call-template>
									</tr>
								</xsl:for-each>
							</table>
						</div>
					</div>
					
					<div class="contenu_onglet" id="contenu_onglet_contact">
						<h2>Contacts pour les donn&#233;es</h2>
						<div class="paragraphe">
							<table>
								<tr><th>Contact</th><th>R&#244;le</th></tr>
								<xsl:for-each select="gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:pointOfContact">
									<tr>
									  <xsl:call-template name="AfficheContact" />
									</tr>
								</xsl:for-each>
							</table>
						</div>
						<h2>Contacts pour les m&#233;tadonn&#233;es</h2>
						<div class="paragraphe">
							<table>
								<tr><th>Contact</th><th>R&#244;le</th></tr>
								<xsl:for-each select="gmd:MD_Metadata/gmd:contact">
									<tr>
										<xsl:call-template name="AfficheContact" />
									</tr>
								</xsl:for-each>
							</table>
						</div>
					</div>
				</div>
			</div>

			<div id="basdepage">Derniere mise a jour 2011</div>
			</div>
			 <script type="text/javascript">
				var anc_onglet = 'decouvrir';
				change_onglet(anc_onglet);
			</script>
		</body>
	</html>
</xsl:template>
</xsl:stylesheet>
