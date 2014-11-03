<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ------------------------------------------------------------------------

/**
 * MdConverter xml2xls Helpers
 *
 * @package		MdConverter - xml2xls
 * @subpackage	Helpers
 * @category	Helpers
 * @author		G. Ryckelynck - Region Alsace/CIGAL
 * @link		
 */

// ------------------------------------------------------------------------

// Fonction "_var_dump()"
if (!function_exists('_var_dump')) {    
    function _var_dump($var) {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    }
}

// Fonction "_print_r()"
if (!function_exists('_print_r')) {    
    function _print_r($var) {
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }
}

// Fonction _getCellValue()
// Permet de réccupérer la valeur d'une cellule ou vide si cellule n'existe pas
/*
if (!function_exists('_getCellValue')) {
    function _getCellValue($sheet, $namedRangesList, $cellName, $cellValue, $listCodes = false) {
        // Pass
    }
}
*/

// Fonction "_setCellValue()"
// Permet de traiter les valeur issues du xpath et de les intégrer dans le fichier Excel en gérant les erreurs
if (!function_exists('_setCellValue')) {
    function _setCellValue($sheet, $namedRangesList, $cellName, $cellValue, $listCodes = false) {
        $response['value'] = '';
        $response['error'] = 'notValid';
        if (isset($cellValue[0]) and array_key_exists($cellName, $namedRangesList)) {
            if (!is_array($cellValue[0])) {
                $cellValue = strval($cellValue[0]);
                if ($listCodes) {
                    if (array_key_exists($cellValue, $listCodes)) {
                        $sheet->setCellValue($namedRangesList[$cellName], $listCodes[$cellValue]);
                        $response['error'] = false;
                    } else {
                        $sheet->setCellValue($namedRangesList[$cellName], $cellValue);
                        $response['error'] = 'notInListCodes';
                    }
                } else {
                    $sheet->setCellValue($namedRangesList[$cellName], $cellValue);
                    $response['error'] = false;
                }
                $response['value'] = $cellValue;
            }
        }
        return $response;
    }
}

// Function "contacts()"
// Permet d'extraire la liste des contacts d'un fichier XML et retourne un tableau des contacts
if (!function_exists('contacts')) {
    function contacts($contact_type = None, $xml_content, $xpaths) {
        // MD_Contacts
        if ($contact_type == 'MD_Contacts') { $xpath_contacts = $xpaths['MD_Contacts']; }
        elseif ($contact_type == 'Data_Contacts') { $xpath_contacts = $xpaths['Data_Contacts']; }
        else { return false; }
        
        $xml_contacts = $xml_content->xpath($xpath_contacts);
        
        $i = 0;
        $CntList = array();
        foreach ($xml_contacts as $xml_contact) {
            $CntList[$i]['name'] = $xml_contact->xpath($xpaths['CntName']);
            if (!isset($CntList[$i]['name'][0])) { $CntList[$i]['name'][0] = ''; }
            $CntList[$i]['organism'] = $xml_contact->xpath($xpaths['CntOrganism']);
            if (!isset($CntList[$i]['organism'][0])) { $CntList[$i]['organism'][0] = ''; }
            $CntList[$i]['function'] = $xml_contact->xpath($xpaths['CntFunction']);
            if (!isset($CntList[$i]['function'][0])) { $CntList[$i]['function'][0] = ''; }
            $CntList[$i]['tel'] = $xml_contact->xpath($xpaths['CntTel']);
            if (!isset($CntList[$i]['tel'][0])) { $CntList[$i]['tel'][0] = ''; }
            $CntList[$i]['address'] = $xml_contact->xpath($xpaths['CntAddress']);
            if (!isset($CntList[$i]['address'][0])) { $CntList[$i]['address'][0] = ''; }
            $CntList[$i]['logoUrl'] = $xml_contact->xpath($xpaths['CntLogoUrl']);
            if (!isset($CntList[$i]['logoUrl'][0])) { $CntList[$i]['logoUrl'][0] = ''; }
            $CntList[$i]['postalCode'] = $xml_contact->xpath($xpaths['CntPostalCode']);
            if (!isset($CntList[$i]['postalCode'][0])) { $CntList[$i]['postalCode'][0] = ''; }
            $CntList[$i]['city'] = $xml_contact->xpath($xpaths['CntCity']);
            if (!isset($CntList[$i]['city'][0])) { $CntList[$i]['city'][0] = ''; }
            $CntList[$i]['email'] = $xml_contact->xpath($xpaths['CntEmail']);
            if (!isset($CntList[$i]['email'][0])) { $CntList[$i]['email'][0] = ''; }
            $CntList[$i]['role'] = $xml_contact->xpath($xpaths['CntRole']);
            if (!isset($CntList[$i]['role'][0])) { $CntList[$i]['role'][0] = ''; }
            $i++;
        }
        return $CntList;
    }
}
    // Function "data_dates"
if (!function_exists('dates')) {    
    function dates($date_type = None, $xml_content, $xpaths) {        
        $Data_Dates = array('creation' => '', 'publication' => '', 'revision' => '');
        if ($date_type == 'Data') {
            $xpath_dates = $xpaths['Data_Dates'];
        } elseif ($date_type == 'Conformity') {
            $xpath_dates = $xpaths['DQ_InspireConformityDates'];
        } elseif ($date_type == 'Thesaurus') {
            $xpath_dates = $xpaths['Data_KeywordThesaurusDates'];
        } else { return false; }
        
        $xml_dates = $xml_content->xpath($xpath_dates);
        foreach ($xml_dates as $xml_date) {
            $date = $xml_date->xpath($xpaths['Date']);
            $datetype = $xml_date->xpath($xpaths['DateType']);
            if ($datetype[0] == 'creation') {
                $Data_Dates['creation'][0] = strval($date[0]);
            } elseif ($datetype[0] == 'publication') {
                $Data_Dates['publication'][0] = strval($date[0]);
            } elseif ($datetype[0] == 'revision') {
                $Data_Dates['revision'][0] = strval($date[0]);
            }
        }
        return $Data_Dates;
    }
}
    // Function "data_reference_system"
if (!function_exists('reference_systems')) {    
    function reference_systems($xml_content, $xpaths) {
        $RefSystemList = array();
        $xml_referencesystem = $xml_content->xpath($xpaths['Data_ReferenceSystem']);
        foreach ($xml_referencesystem as $xml_rs) {
            $RefSystemList[] = $xml_rs->xpath($xpaths['Data_ReferenceSystemCode']);
        }
        return $RefSystemList;
    }
}
    // Funtion "data_identifier"
if (!function_exists('identifiers')) {    
    function identifiers($xml_content, $xpaths) {
        $IdentifierList = array();
        $xml_dataidentifiers = $xml_content->xpath($xpaths['Data_Identifiers']);
        $i = 1;
        foreach ($xml_dataidentifiers as $xml_dataidentifier) {
            $IdentifierList[$i]['code'] = $xml_dataidentifier->xpath($xpaths['Data_IdentifierCode']);
            $IdentifierList[$i]['namespace'] = $xml_dataidentifier->xpath($xpaths['Data_IdentifierSpaceName']);
            $i++;
        }
        return $IdentifierList;
    }
}

// Function "linkages"
if (!function_exists('linkages')) {    
    function linkages($xml_content, $xpaths) {
        $LinkagesList = array();
        $xml_datalinkages = $xml_content->xpath($xpaths['Data_Linkages']);
        $i = 1;
        foreach ($xml_datalinkages as $xml_datalinkage) {
            $LinkagesList[$i]['url'] = $xml_datalinkage->xpath($xpaths['Data_LinkageUrl']);
            $LinkagesList[$i]['name'] = $xml_datalinkage->xpath($xpaths['Data_LinkageName']);
            $LinkagesList[$i]['mimeFileType'] = $xml_datalinkage->xpath($xpaths['Data_LinkageMimeFileType']);
            $LinkagesList[$i]['mimeFileTypeValue'] = $xml_datalinkage->xpath($xpaths['Data_LinkageMimeFileTypeValue']);
            $LinkagesList[$i]['description'] = $xml_datalinkage->xpath($xpaths['Data_LinkageDescription']);
            $LinkagesList[$i]['protocol'] = $xml_datalinkage->xpath($xpaths['Data_LinkageProtocol']);
            $i++;
        }
        return $LinkagesList;
    }
}

// Function "graphicoverviews"
if (!function_exists('graphicoverviews')) {    
    function graphicoverviews($xml_content, $xpaths) {
        $GraphicOverviewsList = array();
        $xml_datagraphicoverviews = $xml_content->xpath($xpaths['Data_GraphicOverviews']);
        $i = 1;
        foreach ($xml_datagraphicoverviews as $xml_datagraphicoverview) {
            $GraphicOverviewsList[$i]['filename'] = $xml_datagraphicoverview->xpath($xpaths['Data_GraphicOverviewName']);
            $GraphicOverviewsList[$i]['description'] = $xml_datagraphicoverview->xpath($xpaths['Data_GraphicOverviewDescription']);
            $GraphicOverviewsList[$i]['type'] = $xml_datagraphicoverview->xpath($xpaths['Data_GraphicOverviewType']);
            $i++;
        }
        return $GraphicOverviewsList;
    }
}

// Function "conformities"
if (!function_exists('conformities')) {    
    function conformities($xml_content, $xpaths) {
        $ConformityList = array();
        $xml_dqconformities = $xml_content->xpath($xpaths['DQ_InspireConformities']);
        $i = 1;
        foreach ($xml_dqconformities as $xml_conformity) {
            $title = $xml_conformity->xpath($xpaths['DQ_InspireConformityTitle']);
            if ($title) { $Conformity['title'][0] = strval($title[0]); }
            else { $Conformity['title'][0] = ''; }
            
            $description = $xml_conformity->xpath($xpaths['DQ_InspireConformityDescription']);
            if ($description) { $Conformity['description'][0] = strval($description[0]); }
            else { $Conformity['description'][0] = ''; }
            
            $result = $xml_conformity->xpath($xpaths['DQ_InspireConformityPass']);
            if ($result) { 
                if (array_key_exists(strval($result[0]), $PassCode)) {
                    $Conformity['result'][0] = $PassCode[strval($result[0])];
                } else {
                    $Conformity['result'][0] = $PassCode[strval($result[0])];
                    $Error[] = 'Key '.strval($result[0]).' doesn\'t exist in PassCode array.';
                }
            } else { $Conformity['result'][0] = ''; }     

            $Data_ConformityDates = dates('Conformity', $xml_conformity, $xpaths);
            $Conformity['creation'][0] = $Data_ConformityDates['creation'];
            $Conformity['publication'][0] = $Data_ConformityDates['publication'];
            $Conformity['revision'][0] = $Data_ConformityDates['revision'];

            $ConformityList[$i] = $Conformity;
            $i++;
        }
        return $ConformityList;
    }
}

// Function "dist_formats"
if (!function_exists('dist_formats')) {    
    function dist_formats($xml_content, $xpaths) {
        $DistributionFormatsList = array();
        $xml_datadistformats = $xml_content->xpath($xpaths['Data_DistFormats']);
        $i = 1;
        foreach ($xml_datadistformats as $xml_datadistformat) {
            $DistributionFormatsList[$i]['name'] = $xml_datadistformat->xpath($xpaths['Data_DistFormatName']);
            $DistributionFormatsList[$i]['version'] = $xml_datadistformat->xpath($xpaths['Data_DistFormatVersion']);
            $DistributionFormatsList[$i]['specification'] = $xml_datadistformat->xpath($xpaths['Data_DistFormatSpecification']);
            $i++;
        }
        return $DistributionFormatsList;
    }
}

// Function "geographic_extents"
if (!function_exists('geographic_extents')) {    
    function geographic_extents($xml_content, $xpaths) {
        $GeographicExtentsList = array();
        $xml_datageographicextents = $xml_content->xpath($xpaths['Data_GeographicExtents']);
        $i = 1;
        foreach ($xml_datageographicextents as $xml_datageographicextent) {
            $GeographicExtentsList[$i]['name'] = $xml_datageographicextent->xpath($xpaths['Data_GeographicExtentName']);
            $GeographicExtentsList[$i]['east'] = $xml_datageographicextent->xpath($xpaths['Data_GeographicExtentEast']);
            $GeographicExtentsList[$i]['west'] = $xml_datageographicextent->xpath($xpaths['Data_GeographicExtentWest']);
            $GeographicExtentsList[$i]['north'] = $xml_datageographicextent->xpath($xpaths['Data_GeographicExtentNorth']);
            $GeographicExtentsList[$i]['south'] = $xml_datageographicextent->xpath($xpaths['Data_GeographicExtentSouth']);
            $i++;
        }
        return $GeographicExtentsList;
    }
}

// Function "temporal_extents"
if (!function_exists('temporal_extents')) {    
    function temporal_extents($xml_content, $xpaths) {
        $TemporalExtentsList = array();
        $xml_datatemporalextents = $xml_content->xpath($xpaths['Data_TemporalExtents']);
        $i = 1;
        foreach ($xml_datatemporalextents as $xml_datatemporalextent) {
            $TemporalExtentsList[$i]['description'] = $xml_datatemporalextent->xpath($xpaths['Data_TemporalExtentDescription']);
            $TemporalExtentsList[$i]['end'] = $xml_datatemporalextent->xpath($xpaths['Data_TemporalExtentEnd']);
            $TemporalExtentsList[$i]['begin'] = $xml_datatemporalextent->xpath($xpaths['Data_TemporalExtentBegin']);
            $i++;
        }
        return $TemporalExtentsList;
    }
}

// Function "vertical_extents"
if (!function_exists('vertical_extents')) {    
    function vertical_extents($xml_content, $xpaths) {
        $VerticalExtentsList = array();
        $xml_dataverticalextents = $xml_content->xpath($xpaths['Data_VerticalExtents']);
        $i = 1;
        foreach ($xml_dataverticalextents as $xml_dataverticalextents) {
            $VerticalExtentsList[$i]['description'] = $xml_dataverticalextents->xpath($xpaths['Data_VerticalExtentDescription']);
            $VerticalExtentsList[$i]['min'] = $xml_dataverticalextents->xpath($xpaths['Data_VerticalExtentMin']);
            $VerticalExtentsList[$i]['max'] = $xml_dataverticalextents->xpath($xpaths['Data_VerticalExtentMax']);
            $VerticalExtentsList[$i]['Uom'] = $xml_dataverticalextents->xpath($xpaths['Data_VerticalExtentUom']);
            $VerticalExtentsList[$i]['Datum'] = $xml_dataverticalextents->xpath($xpaths['Data_VerticalExtentDatum']);
            $i++;
        }
        return $VerticalExtentsList;
    }
}

// Function "keywords"
if (!function_exists('keywords')) {    
    function keywords($type = '', $xml_content, $xpaths, $KeywordTypeCode) {
        $KeywordsList = array();
        $InspireKeywordsList = array();
        $xml_datakeywords = $xml_content->xpath($xpaths['Data_Keywords']);
        $i = 1;
        foreach ($xml_datakeywords as $xml_k) {
            $thesaurus = $xml_k->xpath($xpaths['Data_KeywordThesaurus']);
            if ($thesaurus) { $Keyword['thesaurus'][0] = strval($thesaurus[0]); }
            else { $Keyword['thesaurus'][0] = ''; }

            $keywordtype = $xml_k->xpath($xpaths['Data_KeywordTypeCode']);
            if ($keywordtype) { 
                if (array_key_exists(strval($keywordtype[0]), $KeywordTypeCode)) {
                    $Keyword['type'][0] = $KeywordTypeCode[strval($keywordtype[0])];
                } else {
                    $Keyword['type'][0] = strval($keywordtype[0]);
                    $Error[] = 'Key '.strval($keywordtype[0]).' doesn\'t exist in KeywordTypeCode array.';
                }
            } else { $Keyword['type'][0] = ''; }  
            
            $keywordname = $xml_k->xpath($xpaths['Data_Keyword']);
            if ($keywordname) { $Keyword['keyword'][0] = strval($keywordname[0]); }
            else { $Keyword['keyword'][0] = ''; }
            
            $Data_ThesaurusDates = dates('Thesaurus', $xml_k, $xpaths);
            $Keyword['creation'] = $Data_ThesaurusDates['creation'];
            $Keyword['publication'] = $Data_ThesaurusDates['publication'];
            $Keyword['revision'] = $Data_ThesaurusDates['revision'];
            
            $inspire = stripos(strval($Keyword['thesaurus'][0]), 'INSPIRE');
            if ($inspire) { $InspireKeywordsList[$i] = $Keyword; }
            else { $KeywordsList[$i] = $Keyword; }
            
            $i++;
        }
        if ($type == 'inspire') { return $InspireKeywordsList; }
        else { return $KeywordsList; }
    }
}

////////////////////////
// FONCTION PRINCIPALE
////////////////////////
if (!function_exists('xml2xls')) {
	function xml2xls($path_in, $f_in, $path_out, $f_out, $config, $template) {

        // Gestion des erreurs
        $Error = array();
        
        if (file_exists($path_in.$f_in)) {
            $xml_content = simplexml_load_file($path_in.$f_in);
        } else {
            $Error[] = $path_in.$f_in." doesn't exist";
        }

        // Charger les namespace du fichier XML (format ISO 19139)
        foreach ($config['namespaces'] as $key => $value) {
            $xml_content->registerXPathNamespace($key, $value);
        }
        
        // Récupérer les éléments "simple et uniques" et générer les variables correspondantes  
        foreach ($config['xpaths'] as $key => $value) {
            $$key = $xml_content->xpath($value);
        }
        
        // Ouvrir le fichier Excel
        if (!file_exists($template['full_path'])) {
            $Error[] = $template['full_path']." doesn't exist";
            exit("Excel file '".$template['full_path']."' doesn't exist.\n");
        }

        $Log[] = date('H:i:s')." Load workbook from Excel file";
        $objPHPExcel = PHPExcel_IOFactory::load($template['full_path']);

        $sheet = $objPHPExcel->getSheetByName($config['sheetname']);
        
        // liste des cellules nommées
        $namedRanges = $objPHPExcel->getNamedRanges();
        // Récupération des coordonnées de chaque cellule pour s'affranchir de la casse du nom
        foreach ($namedRanges as $namedRange) {
            $cellName = strtolower($namedRange->getName());
            $namedRangesList[$cellName] = $namedRange->getRange();
        }
        
        
        /**
         * Ecriture du fichier Excel 
         **/
        
        // METADATA INFORMATION
        // MD_FileIdentifier
        $cellName = "md_fileidentifier";
        $MD_FileIdentifier  = _setCellValue($sheet, $namedRangesList, $cellName, $MD_FileIdentifier);
        if ($MD_FileIdentifier['error']) {
            $Error[] = "MD_FileIdentifier non renseigné ou non valide.";
        }
        
        // MD_Language
        $cellName = "md_language";
        $MD_Language = _setCellValue($sheet, $namedRangesList, $cellName, $MD_Language, $config['LanguageCode']);
        if ($MD_Language['error']) {
            if ($MD_Language['error'] == 'notInListCodes') {
                $Error[] = 'Key '.$MD_Language['value'].' doesn\'t exist in LanguageCode array.';
            } else {
                $Error[] = "MD_Language non renseigné ou non valide.";
            }
        }
        
        // MD_CharacterSet
        $cellName = "md_characterset";
        $MD_CharacterSet = _setCellValue($sheet, $namedRangesList, $cellName, $MD_CharacterSet, $config['CharacterSetCode']);
        if ($MD_CharacterSet['error']) {
            if ($MD_CharacterSet['error'] == 'notInListCodes') {
                $Error[] = 'Key '.$MD_CharacterSet['value'].' doesn\'t exist in CharacterSetCode array.';
            } else {
                $Error[] = "MD_CharacterSet non renseigné ou non valide.";
            }
        }
        
        // MD_HierarchyLevel
        $cellName = "md_hierarchylevel";
        $MD_HierarchyLevel = _setCellValue($sheet, $namedRangesList, $cellName, $MD_HierarchyLevel, $config['ScopeCode']);
        if ($MD_HierarchyLevel['error']) {
            if ($MD_HierarchyLevel['error'] == 'notInListCodes') {
                $Error[] = 'Key '.$MD_HierarchyLevel['value'].' doesn\'t exist in ScopeCode array.';
            } else {
                $Error[] = "MD_HierarchyLevel non renseigné ou non valide.";
            }
        }
        
        // MD_Contacts
        $MD_CntList = contacts('MD_Contacts', $xml_content, $config['xpaths']);
        $i = 1;
        foreach ($MD_CntList as $MD_Cnt) {
            $MD_CntName = _setCellValue($sheet, $namedRangesList, 'md_cnt'.$i.'_name', $MD_Cnt['name']);
            $MD_CntFunction = _setCellValue($sheet, $namedRangesList, 'md_cnt'.$i.'_fct', $MD_Cnt['function']);
            $MD_CntOrganism = _setCellValue($sheet, $namedRangesList, 'md_cnt'.$i.'_org', $MD_Cnt['organism']);
            $MD_CntAddress = _setCellValue($sheet, $namedRangesList, 'md_cnt'.$i.'_address', $MD_Cnt['address']);
            $MD_CntLogoUrl = _setCellValue($sheet, $namedRangesList, 'md_cnt'.$i.'_logo', $MD_Cnt['logoUrl']);
            $MD_CntPostalCode = _setCellValue($sheet, $namedRangesList, 'md_cnt'.$i.'_cp', $MD_Cnt['postalCode']);
            $MD_CntCity = _setCellValue($sheet, $namedRangesList, 'md_cnt'.$i.'_city', $MD_Cnt['city']);
            $MD_CntTel = _setCellValue($sheet, $namedRangesList, 'md_cnt'.$i.'_tel', $MD_Cnt['tel']);
            $MD_CntEmail = _setCellValue($sheet, $namedRangesList, 'md_cnt'.$i.'_email', $MD_Cnt['email']);
            $MD_CntRole = _setCellValue($sheet, $namedRangesList, 'md_cnt'.$i.'_role', $MD_Cnt['role'], $config['RoleCode']);
            if ($MD_CntRole['error']) {
                if ($MD_CntRole['error'] == 'notInListCodes') {
                    $Error[] = 'Key '.$MD_CntRole['value'].' doesn\'t exist in RoleCode array.';
                } else {
                    $Error[] = "MD_CntRole non renseigné ou non valide.";
                }
            }
            $i++;
        }

        // MD_DateStamp
        $cellName = "md_datestamp";
        $MD_DateStamp = _setCellValue($sheet, $namedRangesList, $cellName, $MD_DateStamp);
        if ($MD_DateStamp['error']) {
            $Error[] = "MD_DateStamp non renseigné.";
        }
        
        // MD_StandardName
        $cellName = "md_standardname";
        $MD_StandardName = _setCellValue($sheet, $namedRangesList, $cellName, $MD_StandardName);
        if ($MD_StandardName['error']) {
            $Error[] = "MD_StandardName non renseigné.";
        }
        
        // MD_StandardVersion
        $cellName = "md_standardversion";
        $MD_StandardVersion = _setCellValue($sheet, $namedRangesList, $cellName, $MD_StandardVersion);
        if ($MD_StandardVersion['error']) {
            $Error[] = "MD_StandardVersion non renseigné.";
        }
        
        // DATA INFORMATION
        // Data_ReferenceSystem
        $Data_ReferenceSystemList = reference_systems($xml_content, $config['xpaths']);
        $i = 1;
        foreach ($Data_ReferenceSystemList as $Data_ReferenceSystem) {
            $Data_ReferenceSystem = _setCellValue($sheet, $namedRangesList, 'data_referencesystem'.$i, $Data_ReferenceSystem);
            $i++;
        }
        
        // Data_Title
        $cellName = "data_title";
        $Data_Title = _setCellValue($sheet, $namedRangesList, $cellName, $Data_Title);
        if ($Data_Title['error']) {
            $Error[] = "Data_Title non renseigné.";
        }
        
        // Data_PresentationForm
        $cellName = "data_presentationform";
        $Data_PresentationForm = _setCellValue($sheet, $namedRangesList, $cellName, $Data_PresentationForm);
        if ($Data_PresentationForm['error']) {
            // $Error[] = "Data_PresentationForm non renseigné.";
        }
        
        // Data_Dates
        $Data_Dates = dates('Data', $xml_content, $config['xpaths']);
        $Data_DateCreation = _setCellValue($sheet, $namedRangesList, 'data_datecreation', $Data_Dates['creation']);
        $Data_DateRevision = _setCellValue($sheet, $namedRangesList, 'data_daterevision', $Data_Dates['revision']);
        $Data_DatePublication = _setCellValue($sheet, $namedRangesList, 'data_datepublication', $Data_Dates['publication']);
        if ($Data_DateCreation['error'] and $Data_DateRevision['error'] and $Data_DatePublication['error']) {
            $Error[] = "Data_Date non renseigné ou invalide.";
        }
            
        // Data_Identifier
        $Data_IdentifierList = identifiers($xml_content, $config['xpaths']);
        $i = 1;
        foreach ($Data_IdentifierList as $Data_Identifier) {
            if ($Data_Identifier['namespace'][0] != 'MD_URI') {
                $Data_IdentifierCode = _setCellValue($sheet, $namedRangesList, 'data_code'.$i, $Data_Identifier['code']);
                $Data_IdentifierCodeSpace = _setCellValue($sheet, $namedRangesList, 'data_codespace'.$i, $Data_Identifier['namespace']);
                $i++;
            }
        }

        // Data_Abstract
        $cellName = "data_abstract";
        $Data_Abstract = _setCellValue($sheet, $namedRangesList, $cellName, $Data_Abstract);
        if ($Data_Abstract['error']) {
            $Error[] = "Data_Abstract non renseigné.";
        }
        
        // Data_PointOfContact
        $Data_CntList = contacts('Data_Contacts', $xml_content, $config['xpaths']);
        $i = 1;
        foreach ($Data_CntList as $Data_Cnt) {
            $Data_CntName = _setCellValue($sheet, $namedRangesList, 'data_cnt'.$i.'_name', $Data_Cnt['name']);
            $Data_CntFunction = _setCellValue($sheet, $namedRangesList, 'data_cnt'.$i.'_fct', $Data_Cnt['function']);
            $Data_CntOrganism = _setCellValue($sheet, $namedRangesList, 'data_cnt'.$i.'_org', $Data_Cnt['organism']);
            $Data_CntAddress = _setCellValue($sheet, $namedRangesList, 'data_cnt'.$i.'_address', $Data_Cnt['address']);
            $Data_CntLogoUrl = _setCellValue($sheet, $namedRangesList, 'data_cnt'.$i.'_logo', $Data_Cnt['logoUrl']);
            $Data_CntPostalCode = _setCellValue($sheet, $namedRangesList, 'data_cnt'.$i.'_cp', $Data_Cnt['postalCode']);
            $Data_CntCity = _setCellValue($sheet, $namedRangesList, 'data_cnt'.$i.'_city', $Data_Cnt['city']);
            $Data_CntTel = _setCellValue($sheet, $namedRangesList, 'data_cnt'.$i.'_tel', $Data_Cnt['tel']);
            $Data_CntEmail = _setCellValue($sheet, $namedRangesList, 'data_cnt'.$i.'_email', $Data_Cnt['email']);
            $Data_CntRole = _setCellValue($sheet, $namedRangesList, 'data_cnt'.$i.'_role', $Data_Cnt['role'], $config['RoleCode']);
            if ($Data_CntRole['error']) {
                if ($Data_CntRole['error'] == 'notInListCodes') {
                    $Error[] = 'Key '.$Data_CntRole['value'].' doesn\'t exist in RoleCode array.';
                } else {
                    $Error[] = "Data_CntRole non renseigné ou non valide.";
                }
            }
            $i++;
        }
        
        // Data_TopicCategory
        $i = 1;
        foreach ($Data_TopicCategories as $Data_TopicCategory) {
            $Data_TopicCategory = _setCellValue($sheet, $namedRangesList, 'data_topiccategory'.$i, $Data_TopicCategory, $config['TopicCategoryCode']);
            if ($Data_TopicCategory['error']) {
                if ($Data_TopicCategory['error'] == 'notInListCodes') {
                    $Error[] = 'Key '.$Data_TopicCategory['value'].' doesn\'t exist in TopicCategoryCode array.';
                } else {
                    $Error[] = "Data_TopicCategory non renseigné ou non valide.";
                }
            }
            $i++;
        }
        
        // Data_Keywords
        $Data_Keywords = keywords('', $xml_content, $config['xpaths'], $config['KeywordTypeCode']);
        $i = 1;
        foreach ($Data_Keywords as $Data_Keyword) {
            $Data_KeywordValue = _setCellValue($sheet, $namedRangesList, 'data_keyword'.$i, $Data_Keyword['keyword']);
            $Data_KeywordThesaurus = _setCellValue($sheet, $namedRangesList, 'data_keyword'.$i.'_thesaurusname', $Data_Keyword['thesaurus']);
            $Data_KeywordThesaurus = _setCellValue($sheet, $namedRangesList, 'data_keyword'.$i.'_thesaurusdatecreation', $Data_Keyword['creation']);
            $Data_KeywordThesaurus = _setCellValue($sheet, $namedRangesList, 'data_keyword'.$i.'_thesaurusdaterevision', $Data_Keyword['revision']);
            $Data_KeywordThesaurus = _setCellValue($sheet, $namedRangesList, 'data_keyword'.$i.'_thesaurusdatepublication', $Data_Keyword['publication']);
            $Data_KeywordThesaurus = _setCellValue($sheet, $namedRangesList, 'data_keyword'.$i.'_type', $Data_Keyword['type'], $config['KeywordTypeCode']);
            $i++;
        }

        // INSPIRE Keywords
        $Data_InspireKeywords = keywords('inspire', $xml_content, $config['xpaths'], $config['KeywordTypeCode']);
        $i = 1;
        foreach ($Data_InspireKeywords as $Data_InspireKeyword) {
            $Data_InspireKeyword = _setCellValue($sheet, $namedRangesList, 'data_inspirekeyword'.$i, $Data_InspireKeyword['keyword'], $config['InspireThemeCode']);
            if ($Data_InspireKeyword['error']) {
                if ($Data_InspireKeyword['error'] == 'notInListCodes') {
                    $Error[] = 'Key '.$Data_InspireKeyword['value'].' doesn\'t exist in InspireThemeCode array.';
                } else {
                    $Error[] = "Data_InspireKeyword non renseigné ou non valide.";
                }
            }
            $i++;
        }
        
        // CONSTRAINT INFORMATION
        // Data_UseLimitation
        $i = 1;
        foreach ($Data_UseLimitations as $Data_UseLimitation) {
            $Data_UseLimitation = _setCellValue($sheet, $namedRangesList, 'data_uselimitation'.$i, $Data_UseLimitation);
            $i++;
        }

        // Data_AccessConstraints
        $i = 1;
        foreach ($Data_AccessConstraints as $Data_AccessConstraint) {
            if (strval($Data_AccessConstraint[0]) != 'otherRestrictions') {
                $Data_AccessConstraint = _setCellValue($sheet, $namedRangesList, 'data_accessconstraints'.$i, $Data_AccessConstraint, $config['RestrictionCode']);
                if ($Data_AccessConstraint['error']) {
                    if ($Data_AccessConstraint['error'] == 'notInListCodes') {
                        $Error[] = 'Key '.$Data_AccessConstraint['value'].' doesn\'t exist in RestrictionCode array.';
                    } else {
                        $Error[] = "Data_AccessConstraint non renseigné ou non valide.";
                    }
                }
                $i++;
            }
        }
        
        // Data_UseConstraints
        $i = 1;
        foreach ($Data_UseConstraints as $Data_UseConstraint) {
            if (strval($Data_UseConstraint[0]) != 'otherRestrictions') {
                $Data_UseConstraint = _setCellValue($sheet, $namedRangesList, 'data_useconstraints'.$i, $Data_UseConstraint, $config['RestrictionCode']);
                if ($Data_UseConstraint['error']) {
                    if ($Data_UseConstraint['error'] == 'notInListCodes') {
                        $Error[] = 'Key '.$Data_UseConstraint['value'].' doesn\'t exist in RestrictionCode array.';
                    } else {
                        $Error[] = "Data_UseConstraint non renseigné ou non valide.";
                    }
                }
                $i++;
            }
        }

        // Data_OtherConstraints
        // Use for Inspire constraints
        $i = 1;
        foreach ($Data_OtherConstraints as $Data_OtherConstraint) {
            // if ($Data_OtherConstraint[0] != 'otherRestrictions') {
                $Data_OtherConstraint = _setCellValue($sheet, $namedRangesList, 'data_otherconstraints'.$i, $Data_OtherConstraint, $config['InspireRestrictionCode']);
                if ($Data_OtherConstraint['error']) {
                    if ($Data_OtherConstraint['error'] == 'notInListCodes') {
                        $Error[] = 'Key '.$Data_OtherConstraint['value'].' doesn\'t exist in InspireRestrictionCode array.';
                    } else {
                        $Error[] = "Data_OtherConstraint non renseigné ou non valide.";
                    }
                }
                $i++;
            // }
        }
        
        // Data_Classification
        $cellName = "data_classification";
        $Data_Classification = _setCellValue($sheet, $namedRangesList, $cellName, $Data_Classification, $config['ClassificationCode']);
        if ($Data_Classification['error']) {
            if ($Data_Classification['error'] == 'notInListCodes') {
                $Error[] = 'Key '.$Data_Classification['value'].' doesn\'t exist in ClassificationCode array.';
            } else {
                $Error[] = "Data_Classification non renseigné ou non valide.";
            }
        }

        // DATA SPATIAL REPRESENTATION
        // Data_SpatialRepresentationType
        $cellName = "data_spatialrepresentationtype";
        $Data_SpatialRepresentationType = _setCellValue($sheet, $namedRangesList, $cellName, $Data_SpatialRepresentationType, $config['SpatialRepresentationTypeCode']);
        if ($Data_SpatialRepresentationType['error']) {
            if ($Data_SpatialRepresentationType['error'] == 'notInListCodes') {
                $Error[] = 'Key '.$Data_SpatialRepresentationType.' doesn\'t exist in SpatialRepresentationTypeCode array.';
            } else {
                $Error[] = "Data_SpatialRepresentationType non renseigné ou non valide.";
            }
        }
        
        // Data_ScaleDenominator
        $cellName = "data_scaledenominator";
        $Data_ScaleDenominator = _setCellValue($sheet, $namedRangesList, $cellName, $Data_ScaleDenominator);
        // Data_ScaleDistance
        $cellName = "data_scaledistance";
        $Data_ScaleDistance = _setCellValue($sheet, $namedRangesList, $cellName, $Data_ScaleDistance);
        if ($Data_SpatialRepresentationType['error'] and $Data_ScaleDistance['error']) {
            $Error[] = "Data_ScaleDenominator et Data_ScaleDistance non renseignés ou non valides.";
        }
        
        // Data_Language
        $i = 1;
        foreach ($Data_LanguageCodes as $Data_LanguageCode) {
            $Data_LanguageCode = _setCellValue($sheet, $namedRangesList, 'data_language'.$i, $Data_LanguageCode, $config['LanguageCode']);
            if ($Data_LanguageCode['error']) {
                if ($Data_LanguageCode['error'] == 'notInListCodes') {
                    $Error[] = 'Key '.$Data_LanguageCode['value'].' doesn\'t exist in LanguageCode array.';
                } else {
                    $Error[] = "Data_LanguageCode non renseigné ou non valide.";
                }
            }
            $i++;
        }
        
        // Data_CharacterSet
        $cellName = "data_characterset";
        $Data_CharacterSet = _setCellValue($sheet, $namedRangesList, $cellName, $Data_CharacterSet, $config['CharacterSetCode']);
        if ($Data_CharacterSet['error']) {
            if ($Data_CharacterSet['error'] == 'notInListCodes') {
                $Error[] = 'Key '.$Data_CharacterSet['value'].' doesn\'t exist in CharacterSetCode array.';
            } else {
                $Error[] = "Data_CharacterSet non renseigné ou non valide.";
            }
        }
        
        // EXTENT
        // Data_GeographicExtent
        $Data_GeographicExtents = geographic_extents($xml_content, $config['xpaths']);
        $i = 1;
        foreach ($Data_GeographicExtents as $Data_GeographicExtent) {
            $Data_GeographicExtentName = _setCellValue($sheet, $namedRangesList, 'data_ext'.$i.'_name', $Data_GeographicExtent['name']);
            $Data_GeographicExtentNorth = _setCellValue($sheet, $namedRangesList, 'data_ext'.$i.'_n', $Data_GeographicExtent['north']);
            $Data_GeographicExtentSouth = _setCellValue($sheet, $namedRangesList, 'data_ext'.$i.'_s', $Data_GeographicExtent['south']);
            $Data_GeographicExtentEast = _setCellValue($sheet, $namedRangesList, 'data_ext'.$i.'_e', $Data_GeographicExtent['east']);
            $Data_GeographicExtentWest = _setCellValue($sheet, $namedRangesList, 'data_ext'.$i.'_w', $Data_GeographicExtent['west']);
            $i++;
        }
        
        // Data_TemporalExtent
        $Data_TemporalExtents = temporal_extents($xml_content, $config['xpaths']);
        $i = 1;
        foreach ($Data_TemporalExtents as $Data_TemporalExtent) {
            $Data_TemporalExtentDescription = _setCellValue($sheet, $namedRangesList, 'data_temporalextent'.$i.'_description', $Data_TemporalExtent['description']);
            $Data_TemporalExtentBegin = _setCellValue($sheet, $namedRangesList, 'data_temporalextent'.$i.'_start', $Data_TemporalExtent['begin']);
            $Data_TemporalExtentEnd = _setCellValue($sheet, $namedRangesList, 'data_temporalextent'.$i.'_end', $Data_TemporalExtent['end']);
            $i++;
        }

        // DISTRIBUTION INFO
        // Data_DistFormat
        $Data_DistFormats = dist_formats($xml_content, $config['xpaths']);
        $i = 1;
        foreach ($Data_DistFormats as $Data_DistFormat) {
            $Data_DistFormatName = _setCellValue($sheet, $namedRangesList, 'data_distformat'.$i.'_name', $Data_DistFormat['name']);
            $Data_DistFormatVersion = _setCellValue($sheet, $namedRangesList, 'data_distformat'.$i.'_version', $Data_DistFormat['version']);
            $Data_DistFormatSpecification = _setCellValue($sheet, $namedRangesList, 'data_distformat'.$i.'_specification', $Data_DistFormat['specification']);
            $i++;
        }

        // Data_Linkage (url)
        $Data_Linkages = linkages($xml_content, $config['xpaths']);
        $i = 1;
        foreach ($Data_Linkages as $Data_Linkage) {
            $Data_LinkageUrl = _setCellValue($sheet, $namedRangesList, 'data_linkage'.$i.'_url', $Data_Linkage['url']);
            $Data_LinkageDescription = _setCellValue($sheet, $namedRangesList, 'data_linkage'.$i.'_description', $Data_Linkage['description']);
            $linkageName = $Data_Linkage['name'];
            if (is_array($Data_Linkage['mimeFileTypeValue'])) {
                if (!$Data_Linkage['name']) {
                    $linkageName = $Data_Linkage['mimeFileTypeValue'][0];
                }
            }
            // $Log[] = $Data_Linkage['mimeFileType'];
            $linkageProtocol[0] = $Data_Linkage['protocol'];
            if (isset($Data_Linkage['mimeFileType'][0])) {
                if ($Data_Linkage['mimeFileType'][0] == "application/pdf") {
                    $linkageProtocol[0] = "MAP:PDF";
                } elseif ($Data_Linkage['mimeFileType'][0] == "image/jpeg" or $Data_Linkage['mimeFileType'][0] == "image/jpg") {
                    $linkageProtocol[0] = "MAP:JPG";
                } elseif ($Data_Linkage['mimeFileType'][0] == "image/png") {
                    $linkageProtocol[0] = "MAP:PNG";
                } elseif ($Data_Linkage['mimeFileType'][0] == "application/zip") {
                    $linkageProtocol[0] = "DATA:ZIP";
                }
            }
            $Data_LinkageName = _setCellValue($sheet, $namedRangesList, 'data_linkage'.$i.'_name', $linkageName);
            $Data_LinkageProtocol = _setCellValue($sheet, $namedRangesList, 'data_linkage'.$i.'_protocol', $linkageProtocol);
            $i++;            
        }

        // DATA MAINTENANCE INFORMATION
        // Data_MaintenanceFrequency
        $cellName = "data_maintenancefrequency";
        $Data_MaintenanceFrequency = _setCellValue($sheet, $namedRangesList, $cellName, $Data_MaintenanceFrequency, $config['MaintenanceFrequencyCode']);
        if ($Data_MaintenanceFrequency['error']) {
            if ($Data_MaintenanceFrequency['error'] == 'notInListCodes') {
                $Error[] = 'Key '.$Data_MaintenanceFrequency['value'].' doesn\'t exist in MaintenanceFrequencyCode array.';
            } else {
                $Error[] = "Data_MaintenanceFrequency non renseigné ou non valide.";
            }
        }
        
        // Data_GraphicOverview
        $Data_GraphicOverviews = graphicoverviews($xml_content, $config['xpaths']);
        $i = 1;
        foreach ($Data_GraphicOverviews as $Data_GraphicOverview) {
            $Data_GraphicOverviewFilename = _setCellValue($sheet, $namedRangesList, 'data_browsegraphic'.$i.'_filename', $Data_GraphicOverview['filename']);
            $Data_GraphicOverviewDescription = _setCellValue($sheet, $namedRangesList, 'data_browsegraphic'.$i.'_description', $Data_GraphicOverview['description']);
            $i++;
        }
        
        // DATA QUALITY INFO
        // DQ_Level
        $cellName = "data_dq_level";
        $DQ_Level = _setCellValue($sheet, $namedRangesList, $cellName, $DQ_Level, $config['ScopeCode']);
        if ($DQ_Level['error']) {
            if ($DQ_Level['error'] == 'notInListCodes') {
                $Error[] = 'Key '.$DQ_Level['value'].' doesn\'t exist in ScopeCode array.';
            } else {
                $Error[] = "DQ_Level non renseigné ou non valide.";
            }
        }
        
        // LI_Statement
        $cellName = "li_statement";
        $LI_Statement = _setCellValue($sheet, $namedRangesList, $cellName, $LI_Statement);
        if ($LI_Statement['error']) {
            $Error[] = "LI_Statement non renseigné ou non valide.";
        }
        
        // LI_ProcessStep
        $cellName = "li_processstep";
        $LI_ProcessStep = _setCellValue($sheet, $namedRangesList, $cellName, $LI_ProcessStep);

        // LI_Source
        $cellName = "li_source";
        $LI_Source = _setCellValue($sheet, $namedRangesList, $cellName, $LI_Source);
        
        // DQ_InspireConformity
        /*
        $DQ_InspireConformities = conformities($xml_content, $config['xpaths'], $config['PassCode']);
        $i = 1;
        foreach ($DQ_InspireConformities as $DQ_InspireConformity) {
            $sheet->setCellValue($namedRangesList['data_dq_inspireconformity'.$i.'_specification'], $DQ_InspireConformity['title']);
            $sheet->setCellValue($namedRangesList['data_dq_inspireconformity'.$i.'_explain'], $DQ_InspireConformity['description']);
            $sheet->setCellValue($namedRangesList['data_dq_inspireconformity'.$i.'_thesaurusdatecreation'], $DQ_InspireConformity['creation']);
            $sheet->setCellValue($namedRangesList['data_dq_inspireconformity'.$i.'_thesaurusdaterevision'], $DQ_InspireConformity['revision']);
            $sheet->setCellValue($namedRangesList['data_dq_inspireconformity'.$i.'_thesaurusdatepublication'], $DQ_InspireConformity['publication']);
            $sheet->setCellValue($namedRangesList['data_dq_inspireconformity'.$i.'_pass'], $DQ_InspireConformity['pass']);
            // _var_dump($dq_inspireconformity);
            $i++;
        }
        */
        // Fin de l'écriture dans le fichier Excel ###
        
        // Sauvegarde du fichier
        
        if (strtolower($template['file_ext']) == ".xlsx") {
            $Log[] =  date('H:i:s')." Write to Excel2007 format";
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->setOffice2003Compatibility(true);
        } else {
            $Log[] =  date('H:i:s')." Write to Excel5 format";
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        }
        // $Log[] = strtolower($template['file_ext']);
        
        $objWriter->save($path_out.$f_out);
        
        $Log[] =  date('H:i:s').' File written to '.$path_out.$f_out;

        // Geston des messages
        $Message[0] = $Log;
        $Message[1] = $Error;
        return $Message;
	}
}

/* End of file MY_xml2xls.php */
/* Location: ./application/helpers/MY_xml2xls.php */