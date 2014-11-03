<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| MDC XML
|--------------------------------------------------------------------------
|
| XML config properties
|
*/
$config['xml']['namespaces'] = array(
                    'gmd' => 'http://www.isotc211.org/2005/gmd',
                    'xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
                    'gco' => 'http://www.isotc211.org/2005/gco',
                    'gml' => 'http://www.opengis.net/gml',
                    'xlink' => 'http://www.w3.org/1999/xlink'
                    );

$config['xml']['xpaths'] = array('MD_FileIdentifier' => './/gmd:fileIdentifier/gco:CharacterString/text()',
                'MD_Language' => './/gmd:language/gmd:LanguageCode/@codeListValue',
                'MD_CharacterSet' => './/gmd:characterSet/gmd:MD_CharacterSetCode/@codeListValue',
                'MD_HierarchyLevel' => './/gmd:hierarchyLevel/gmd:MD_ScopeCode/@codeListValue',
                
                // Contacts
                // MD_Contacts
                'MD_Contacts' => './/gmd:contact',
                // Data_Contacts
                'Data_Contacts' => './/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:pointOfContact',
                // Contact info
                'CntName' => './/gmd:CI_ResponsibleParty/gmd:individualName/gco:CharacterString',
                'CntOrganism' => './/gmd:CI_ResponsibleParty/gmd:organisationName/gco:CharacterString',
                'CntFunction' => './/gmd:CI_ResponsibleParty/gmd:positionName/gco:CharacterString',
                'CntTel' => './/gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:phone/gmd:CI_Telephone/gmd:voice/gco:CharacterString',
                'CntAddress' => './/gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:address/gmd:CI_Address/gmd:deliveryPoint/gco:CharacterString',
                'CntLogoText' => './/gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:address/gmd:contactInstructions/gmx:FileName/text()',
                'CntLogoUrl' => './/gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:contactInstructions/gmx:FileName/@src',
                'CntPostalCode' => './/gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:address/gmd:CI_Address/gmd:postalCode/gco:CharacterString',
                'CntCity' => './/gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:address/gmd:CI_Address/gmd:city/gco:CharacterString',
                'CntEmail' => './/gmd:CI_ResponsibleParty/gmd:contactInfo/gmd:CI_Contact/gmd:address/gmd:CI_Address/gmd:electronicMailAddress/gco:CharacterString',
                'CntRole' => './/gmd:CI_ResponsibleParty/gmd:role/gmd:CI_RoleCode/@codeListValue',
                
                
                
                'MD_DateStamp' => '//gmd:dateStamp/gco:Date',
                'MD_StandardName' => '//gmd:metadataStandardName/gco:CharacterString',
                'MD_StandardVersion' => '//gmd:metadataStandardVersion/gco:CharacterString',
                'Data_ReferenceSystem' => '//gmd:referenceSystemInfo',
                'Data_ReferenceSystemCode' => 'gmd:MD_ReferenceSystem/gmd:referenceSystemIdentifier/gmd:RS_Identifier/gmd:code/gco:CharacterString',

                'Data_Title' => '//gmd:identificationInfo/gmd:MD_DataIdentification/gmd:citation/gmd:CI_Citation/gmd:title/gco:CharacterString',
                
                'Data_PresentationForm' => '//gmd:identificationInfo/gmd:MD_DataIdentification/gmd:citation/gmd:CI_Citation/gmd:presentationForm/gmd:CI_PresentationFormCode/@codeListValue',
                
                // Data_Dates
                'Data_Dates' => '//gmd:identificationInfo/gmd:MD_DataIdentification/gmd:citation/gmd:CI_Citation/gmd:date',
                'Date' => 'gmd:CI_Date/gmd:date/gco:Date',
                'DateType' => 'gmd:CI_Date/gmd:dateType/gmd:CI_DateTypeCode/@codeListValue',
                
                // Data_Identifier
                'Data_Identifiers' => './/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:citation/gmd:CI_Citation/gmd:identifier',
                'Data_IdentifierCode' => './gmd:RS_Identifier/gmd:code/gco:CharacterString',
                'Data_IdentifierSpaceName' => './gmd:RS_Identifier/gmd:codeSpace/gco:CharacterString',
                
                'Data_Abstract' => './/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:abstract/gco:CharacterString',
                
                'Data_MaintenanceFrequency' => './/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:resourceMaintenance/gmd:MD_MaintenanceInformation/gmd:maintenanceAndUpdateFrequency/gmd:MD_MaintenanceFrequencyCode/@codeListValue',
                
                'Data_GraphicOverviews' => './/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:graphicOverview',
                'Data_GraphicOverviewName' => './gmd:MD_BrowseGraphic/gmd:fileName/gco:CharacterString',
                'Data_GraphicOverviewDescription' => './gmd:MD_BrowseGraphic/gmd:fileDescription/gco:CharacterString',
                'Data_GraphicOverviewType' => './gmd:MD_BrowseGraphic/gmd:fileType/gco:CharacterString',
                
                'DQ_Level' => './/gmd:dataQualityInfo/gmd:DQ_DataQuality/gmd:scope/gmd:DQ_Scope/gmd:level/gmd:MD_ScopeCode/@codeListValue',
                'LI_Statement' => './/gmd:dataQualityInfo/gmd:DQ_DataQuality/gmd:lineage/gmd:LI_Lineage/gmd:statement/gco:CharacterString',
                'LI_ProcessStep' => './/gmd:dataQualityInfo/gmd:DQ_DataQuality/gmd:lineage/gmd:LI_Lineage/gmd:processStep/gmd:LI_ProcessStep/gmd:description/gco:CharacterString',
                'LI_Source' => './/gmd:dataQualityInfo/gmd:DQ_DataQuality/gmd:lineage/gmd:LI_Lineage/gmd:source/gmd:LI_Source/gmd:description/gco:CharacterString',
                
                'Data_CharacterSet' => './/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:characterSet/gmd:MD_CharacterSetCode/@codeListValue',
                'Data_ScaleDenominator' => './/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:spatialResolution/gmd:MD_Resolution/gmd:equivalentScale/gmd:MD_RepresentativeFraction/gmd:denominator/gco:Integer',
                'Data_ScaleDistance' => './/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:spatialResolution/gmd:MD_Resolution/gmd:distance/gco:Distance',
                'Data_SpatialRepresentationType' => './/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:spatialRepresentationType/gmd:MD_SpatialRepresentationTypeCode/@codeListValue',
                // 'Data_Languages' => './/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:language',
                // 'Data_LanguageCode' => './gmd:LanguageCode/@codeListValue',
                'Data_LanguageCodes' => './/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:language/gmd:LanguageCode/@codeListValue',

                'Data_Linkages' => './/gmd:distributionInfo/gmd:MD_Distribution/gmd:transferOptions/gmd:MD_DigitalTransferOptions/gmd:onLine',
                'Data_LinkageUrl' => './gmd:CI_OnlineResource/gmd:linkage/gmd:URL',
                'Data_LinkageName' => './gmd:CI_OnlineResource/gmd:name/gco:CharacterString',
                'Data_LinkageMimeFileType' => './gmd:CI_OnlineResource/gmd:name/gmx:MimeFileType/@type',
                'Data_LinkageMimeFileTypeValue' => './gmd:CI_OnlineResource/gmd:name/gmx:MimeFileType/text()',
                'Data_LinkageDescription' => './gmd:CI_OnlineResource/gmd:description/gco:CharacterString',
                'Data_LinkageProtocol' => './gmd:CI_OnlineResource/gmd:protocol/gco:CharacterString',

                'DQ_InspireConformities' => './/gmd:dataQualityInfo/gmd:DQ_DataQuality/gmd:report',
                // 'DQ_InspireConformityCode' => './gmd:DQ_DomainConsistency/gmd:measureIdentification/gmd:RS_Identifier/gmd:code/gco:CharacterString',
                // 'DQ_InspireConformityNamespace' => './gmd:DQ_DomainConsistency/gmd:measureIdentification/gmd:RS_Identifier/gmd:codeSpace/gco:CharacterString',
                'DQ_InspireConformityTitle' => './gmd:DQ_DomainConsistency/gmd:result/gmd:DQ_ConformanceResult/gmd:specification/gmd:CI_Citation/gmd:title/gco:CharacterString',
                'DQ_InspireConformityDates' => './gmd:DQ_DomainConsistency/gmd:result/gmd:DQ_ConformanceResult/gmd:specification/gmd:CI_Citation/gmd:date',
                'DQ_InspireConformityDescription' => './gmd:DQ_DomainConsistency/gmd:result/gmd:DQ_ConformanceResult/gmd:explanation/gco:CharacterString',
                'DQ_InspireConformityPass' => './gmd:DQ_DomainConsistency/gmd:result/gmd:DQ_ConformanceResult/gmd:pass',
                
                
                
                'Data_UseLimitations' => '//gmd:identificationInfo/gmd:MD_DataIdentification/gmd:resourceConstraints/gmd:MD_Constraints/gmd:useLimitation/gco:CharacterString',
                // 'Data_UseLimitation' => './gco:CharacterString',
                'Data_AccessConstraints' => './/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:resourceConstraints/gmd:MD_LegalConstraints/gmd:accessConstraints/gmd:MD_RestrictionCode/@codeListValue',
                // 'Data_AccessConstraintCode' => './gmd:MD_RestrictionCode/@codeListValue',
                'Data_UseConstraints' => './/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:resourceConstraints/gmd:MD_LegalConstraints/gmd:useConstraints/gmd:MD_RestrictionCode/@codeListValue',
                // 'Data_UseConstraintCode' => './gmd:MD_RestrictionCode/@codeListValue',
                'Data_OtherConstraints' => './/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:resourceConstraints/gmd:MD_LegalConstraints/gmd:otherConstraints/gco:CharacterString',
                // 'Data_OtherConstraint' => './gco:CharacterString',

                'Data_Classification' => './/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:resourceConstraints/gmd:MD_SecurityConstraints/gmd:classification/gmd:MD_ClassificationCode/@codeListValue',
                
                'Data_TopicCategories' => '//gmd:identificationInfo/gmd:MD_DataIdentification/gmd:topicCategory/gmd:MD_TopicCategoryCode',
                // 'Data_TopicCategory' => 'gmd:MD_TopicCategoryCode',

                'Data_DistFormats' => './/gmd:distributionInfo/gmd:MD_Distribution/gmd:distributionFormat',
                'Data_DistFormatName' => './gmd:MD_Format/gmd:name/gco:CharacterString',
                'Data_DistFormatVersion' => './gmd:MD_Format/gmd:version/gco:CharacterString',
                'Data_DistFormatSpecification' => './gmd:MD_Format/gmd:specification/gco:CharacterString',

                // 'Data_Extents' => './/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:extent',
                
                'Data_GeographicExtents' => './/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:extent/gmd:EX_Extent/gmd:geographicElement',
                'Data_GeographicExtentName' => '../gmd:description/gco:CharacterString',
                'Data_GeographicExtentWest' => './gmd:EX_GeographicBoundingBox/gmd:westBoundLongitude/gco:Decimal',
                'Data_GeographicExtentEast' => './gmd:EX_GeographicBoundingBox/gmd:eastBoundLongitude/gco:Decimal',
                'Data_GeographicExtentSouth' => './gmd:EX_GeographicBoundingBox/gmd:southBoundLatitude/gco:Decimal',
                'Data_GeographicExtentNorth' => './gmd:EX_GeographicBoundingBox/gmd:northBoundLatitude/gco:Decimal',

                'Data_TemporalExtents' => './/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:extent/gmd:EX_Extent/gmd:temporalElement',
                'Data_TemporalExtentBegin' => './gmd:EX_TemporalExtent/gmd:extent/gml:TimePeriod/gml:beginPosition',
                'Data_TemporalExtentEnd' => './gmd:EX_TemporalExtent/gmd:extent/gml:TimePeriod/gml:endPosition',
                'Data_TemporalExtentDescription' => '../gmd:description/gco:CharacterString',
                
                'Data_VerticalExtents' => './/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:extent/gmd:EX_Extent/gmd:verticalElement',
                'Data_VerticalExtentDescription' => '../gmd:description/gco:CharacterString',
                'Data_VerticalExtentMin' => './gmd:EX_VerticalExtent/gmd:minValue/gco:CharacterString',
                'Data_VerticalExtentMax' => './gmd:EX_VerticalExtent/gmd:maxValue/gco:CharacterString',
                'Data_VerticalExtentUom' => './gmd:EX_VerticalExtent/gmd:uom/gco:CharacterString',
                'Data_VerticalExtentDatum' => './gmd:EX_VerticalExtent/gmd:verticalDatum/gco:CharacterString',
                

                'Data_Keywords' => '//gmd:identificationInfo/gmd:MD_DataIdentification/gmd:descriptiveKeywords',
                'Data_Keyword' => 'gmd:MD_Keywords/gmd:keyword/gco:CharacterString',
                'Data_KeywordThesaurus' => 'gmd:MD_Keywords/gmd:thesaurusName/gmd:CI_Citation/gmd:title/gco:CharacterString',
                'Data_KeywordThesaurusDates' => 'gmd:MD_Keywords/gmd:thesaurusName/gmd:CI_Citation/gmd:date',
                'Data_KeywordTypeCode' => 'gmd:MD_Keywords/gmd:type/gmd:MD_KeywordTypeCode/@codeListValue',
                
                 );  

/* End of file mdc_xml.php */
/* Location: ./application/config/mdc_xml.php */
