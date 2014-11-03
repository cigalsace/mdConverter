<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ------------------------------------------------------------------------
/**
 * MdConverter xls2xml Helpers
 *
 * @package     MdConverter - xls2xml
 * @subpackage  Helpers
 * @category    Helpers
 * @author      G. Ryckelynck - Region Alsace/CIGAL
 * @link
 */
// ------------------------------------------------------------------------

error_reporting(E_ALL);

if (!function_exists('_getCellValue')) {
    function _getCellValue($cellName, $sheetData, $type='string') {
        $result['value'] = '';
        $result['error'] = true;
        $result['errorType'] = 'cellNoExists';
                
        $cellNames = array($cellName, strtolower($cellName), strtoupper($cellName));
        $cellExists = false;
        
        foreach ($cellNames as $cell) {
            foreach ($sheetData as $sheet) {
                if ($sheet->cellExists($cell)) {
                    $cellName = $cell;
                    $cellExists = true;
                    $sheetName = $sheet;
                }            
            }
		}

        if ($cellExists) {
            $cellValue = $sheetName->getCell($cellName)->getCalculatedValue();
            if ($cellValue) {
                $result['error'] = false;
                $result['errorType'] = '';
                if ($type == 'date') {
                    $result['value'] = PHPExcel_Style_NumberFormat::toFormattedString($cellValue, "YYYY-MM-DD");
                } elseif ($type == 'code') {
                    // pas de différence pour le moment
                    $result['value'] = $cellValue;
                } else {
                    $result['value'] = $cellValue;
                }
            } else {
                $result['errorType'] = 'cellEmpty';
            }
        }
        return $result;
    }
}

if (!function_exists('_errorMessages')) {
    function _errorMessages($errorMessage, $errorType = 'cellEmpty') {
        if ($errorType == 'cellNoExists') {
            $result[] = $errorMessage['cellName']." (".$errorMessage['description'].") ".$errorMessage['errorType'];
            $result[] = "La cellule n'est pas définie";
            $result[] = "";
        } else {
            $result[] = $errorMessage['cellName']." (".$errorMessage['description'].") ".$errorMessage['errorType'];
            $result[] = $errorMessage['message'];
            $result[] = "";
        }
        return implode("\n", $result);
    }
}

if (!function_exists('xls2xml')) {
    function xls2xml($path_in, $f_in, $path_out, $f_out, $config) {
        
        // Ouvrir le fichier Excel
        if (!file_exists($path_in.$f_in)) {
            exit("Excel file doesn't exist.\n");
        }

        $pathinfo = pathinfo($path_in.$f_in);
        if (strtolower($pathinfo['extension']) == "xlsx") {
            $Log[] = date('H:i:s')." Load workbook from Excel2007 file";
            $objReader = new PHPExcel_Reader_Excel2007();
        } elseif (strtolower($pathinfo['extension']) == "xls") {
            $Log[] = date('H:i:s')." Load workbook from Excel5 file";
            $objReader = new PHPExcel_Reader_Excel5();
        }
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($path_in.$f_in);

        foreach ($objPHPExcel->getSheetNames() as $sheet) {
            $sheetData[] = $objPHPExcel->getSheetByName($sheet);
        }
        
        $xml = array();
        $errors = array();

        $xml[] = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml[] = '<gmd:MD_Metadata xsi:schemaLocation="http://www.isotc211.org/2005/gmd http://schemas.opengis.net/iso/19139/20060504/gmd/gmd.xsd" xmlns:gmx="http://www.isotc211.org/2005/gmx" xmlns:gmd="http://www.isotc211.org/2005/gmd" xmlns:gco="http://www.isotc211.org/2005/gco" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:gml="http://www.opengis.net/gml" xmlns:xlink="http://www.w3.org/1999/xlink">';

        /* METADATA */
        // MD_FileIdentifier
        $MD_FileIdentifier = _getCellValue('MD_FileIdentifier', $sheetData, 'string', '');
        if ($MD_FileIdentifier['error']) {
            $errors[] = _errorMessages($config['MD_FileIdentifier']);
            $MD_FileIdentifier['value'] = uniqid();
        }
        $xml[] = '<gmd:fileIdentifier><gco:CharacterString>' . $MD_FileIdentifier['value'] . '</gco:CharacterString></gmd:fileIdentifier>';

        // MD_Language
        $MD_Language = _getCellValue('MD_Language', $sheetData, 'code');
        if ($MD_Language['error'] or !array_key_exists($MD_Language['value'], $config['LanguageCode2'])) {
            $errors[] = _errorMessages($config['MD_Language']);
            $MD_Language['value'] = $config['MD_Language']['defaultValue'];
        }
        $xml[] = '<gmd:language><gmd:LanguageCode codeList="http://www.loc.gov/standards/iso639-2/" codeListValue="' . $config['LanguageCode2'][$MD_Language['value']] . '">' . $config['LanguageCode2'][$MD_Language['value']] . '</gmd:LanguageCode></gmd:language>';

        // MD_CharacterSet
        $MD_CharacterSet = _getCellValue('MD_CharacterSet', $sheetData, 'code');
        if ($MD_CharacterSet['error'] or !array_key_exists($MD_CharacterSet['value'], $config['CharacterSetCode2'])) {
            $errors[] = _errorMessages($config['MD_CharacterSet']);
            $MD_CharacterSet['value'] = $config['MD_CharacterSet']['defaultValue'];
        }
        $xml[] = '<gmd:characterSet><gmd:MD_CharacterSetCode codeList="http://www.isotc211.org/2005/resources/codeList.xml#MD_CharacterSetCode" codeListValue="' . $config['CharacterSetCode2'][$MD_CharacterSet['value']] . '">' . $config['CharacterSetCode2'][$MD_CharacterSet['value']] . '</gmd:MD_CharacterSetCode></gmd:characterSet>';

        // MD_HierarchyLevel
        $MD_HierarchyLevel = _getCellValue('MD_HierarchyLevel', $sheetData, 'code');
        if ($MD_HierarchyLevel['error'] or !array_key_exists($MD_HierarchyLevel['value'], $config['ScopeCode2'])) {
            $errors[] = _errorMessages($config['MD_HierarchyLevel']);
            $MD_CharacterSet['value'] = $config['MD_HierarchyLevel']['defaultValue'];
        }
        $xml[] = '<gmd:hierarchyLevel><gmd:MD_ScopeCode codeList="http://standards.iso.org/ittf/PubliclyAvailableStandards/ISO_19139_Schemas/resources/Codelist/ML_gmxCodelists.xml#MD_ScopeCode" codeListValue="' . $config['ScopeCode2'][$MD_HierarchyLevel['value']] . '">' . $config['ScopeCode2'][$MD_HierarchyLevel['value']] . '</gmd:MD_ScopeCode></gmd:hierarchyLevel>';

        // MD_Contacts
        $Error_MdContacts = true;
        // MD_CntRole = '11' // Valeur par defaut: "pointofContact"
        for ($i = 1; $i < 21; $i++) {
            $MD_CntName = _getCellValue('MD_Cnt' . $i . '_Name', $sheetData, 'string');
            $MD_CntFunction = _getCellValue('MD_Cnt' . $i . '_Fct', $sheetData, 'string');
            $MD_CntOrganism = _getCellValue('MD_Cnt' . $i . '_Org', $sheetData, 'string');
            $MD_CntLogo = _getCellValue('MD_Cnt' . $i . '_Logo', $sheetData, 'string');
            $MD_CntAddress = _getCellValue('MD_Cnt' . $i . '_Address', $sheetData, 'string');
            $MD_CntPostalCode = _getCellValue('MD_Cnt' . $i . '_CP', $sheetData, 'string');
            $MD_CntCity = _getCellValue('MD_Cnt' . $i . '_City', $sheetData, 'string');
            $MD_CntPhone = _getCellValue('MD_Cnt' . $i . '_Tel', $sheetData, 'string');
            $MD_CntEmail = _getCellValue('MD_Cnt' . $i . '_Email', $sheetData, 'string');
            $MD_CntRole = _getCellValue('MD_Cnt' . $i . '_Role', $sheetData, 'code');

            if (!$MD_CntOrganism['error'] and !$MD_CntEmail['error']) {
                $Error_MdContacts = false;
            }
            if (!$MD_CntOrganism['error'] or !$MD_CntName['error'] or !$MD_CntFunction['error'] or !$MD_CntEmail['error']) {
                $xml[] = '<gmd:contact>';
                $xml[] = '<gmd:CI_ResponsibleParty>';
                if (!$MD_CntName['error']) {
                    $xml[] = '<gmd:individualName><gco:CharacterString>' . $MD_CntName['value'] . '</gco:CharacterString></gmd:individualName>';
                }
                if (!$MD_CntOrganism['error']) {
                    $xml[] = '<gmd:organisationName><gco:CharacterString>' . $MD_CntOrganism['value'] . '</gco:CharacterString></gmd:organisationName>';
                }
                if (!$MD_CntFunction['error']) {
                    $xml[] = '<gmd:positionName><gco:CharacterString>' . $MD_CntFunction['value'] . '</gco:CharacterString></gmd:positionName>';
                }
                $xml[] = '<gmd:contactInfo><gmd:CI_Contact>';
                if (!$MD_CntPhone['error']) {
                    $xml[] = '<gmd:phone><gmd:CI_Telephone><gmd:voice><gco:CharacterString>' . $MD_CntPhone['value'] . '</gco:CharacterString></gmd:voice></gmd:CI_Telephone></gmd:phone>';
                }
                $xml[] = '<gmd:address><gmd:CI_Address>';
                if (!$MD_CntAddress['error']) {
                    $xml[] = '<gmd:deliveryPoint><gco:CharacterString>' . $MD_CntAddress['value'] . '</gco:CharacterString></gmd:deliveryPoint>';
                }
                if (!$MD_CntCity['error']) {
                    $xml[] = '<gmd:city><gco:CharacterString>' . $MD_CntCity['value'] . '</gco:CharacterString></gmd:city>';
                }
                if (!$MD_CntPostalCode['error']) {
                    $xml[] = '<gmd:postalCode><gco:CharacterString>' . $MD_CntPostalCode['value'] . '</gco:CharacterString></gmd:postalCode>';
                }
                if (!$MD_CntEmail['error']) {
                    $xml[] = '<gmd:electronicMailAddress><gco:CharacterString>' . $MD_CntEmail['value'] . '</gco:CharacterString></gmd:electronicMailAddress>';
                }
                $xml[] = '</gmd:CI_Address></gmd:address>';
                if (!$MD_CntLogo['error']) {
                    $xml[] = '<gmd:contactInstructions><gmx:FileName src="' . $MD_CntLogo['value'] . '">Logo</gmx:FileName></gmd:contactInstructions>';
                }
                $xml[] = '</gmd:CI_Contact></gmd:contactInfo>';

                if ($MD_CntRole['error'] or !array_key_exists($MD_CntRole['value'], $config['RoleCode2'])) {
                    $errors[] = _errorMessages($config['MD_CntRole']);
                    $MD_CntRole['value'] = $config['MD_CntRole']['defaultValue'];
                }
                $xml[] = '<gmd:role><gmd:CI_RoleCode codeList="http://standards.iso.org/ittf/PubliclyAvailableStandards/ISO_19139_Schemas/resources/Codelist/ML_gmxCodelists.xml#CI_RoleCode" codeListValue="' . $config['RoleCode2'][$MD_CntRole['value']] . '">' . $config['RoleCode2'][$MD_CntRole['value']] . '</gmd:CI_RoleCode></gmd:role>';
                $xml[] = '</gmd:CI_ResponsibleParty>';
                $xml[] = '</gmd:contact>';
            }
        }
        if ($Error_MdContacts) {
            $errors[] = _errorMessages($config['MD_Contacts']);
            // $errors[] = $ErrorMessages['MD_Contacts'];
        }

        // MD_DateStamp
        $MD_DateStamp = _getCellValue('MD_DateStamp', $sheetData, 'date');
        if ($MD_DateStamp['error']) {
            $errors[] = _errorMessages($config['MD_DateStamp']);
            $MD_DateStamp['value'] = $config['MD_DateStamp']['defaultValue'];
        }
        $xml[] = '<gmd:dateStamp><gco:Date>' . $MD_DateStamp['value'] . '</gco:Date></gmd:dateStamp>';

        // MD_StandardName
        $MD_StandardName = _getCellValue('MD_StandardName', $sheetData, 'string');
        if ($MD_StandardName['error']) {
            //$errors[] = _errorMessages($config['MD_StandardName']);
        } else {
            $xml[] = '<gmd:metadataStandardName><gco:CharacterString>' . $MD_StandardName['value'] . '</gco:CharacterString></gmd:metadataStandardName>';
        }

        // MD_StandardVersion
        $MD_StandardVersion = _getCellValue('MD_StandardVersion', $sheetData, 'string');
        if ($MD_StandardVersion['error']) {
            //$errors[] = _errorMessages($config['MD_StandardVersion']);
        } else {
            $xml[] = '<gmd:metadataStandardVersion><gco:CharacterString>' . $MD_StandardVersion['value'] . '</gco:CharacterString></gmd:metadataStandardVersion>';
        }

        /* DATA */
        // Data_ReferenceSystem
        $Error_ReferenceSystem = true;
        for ($i = 1; $i < 21; $i++) {
            $Data_ReferenceSystem = _getCellValue('Data_ReferenceSystem'.$i, $sheetData, 'string');
            if (!$Data_ReferenceSystem['error']) {
                $Error_ReferenceSystems = false;
                $xml[] = '<gmd:referenceSystemInfo><gmd:MD_ReferenceSystem>';
                $xml[] = '<gmd:referenceSystemIdentifier><gmd:RS_Identifier>';
                $xml[] = '<gmd:code><gco:CharacterString>' . $Data_ReferenceSystem['value'] . '</gco:CharacterString></gmd:code>';
                $xml[] = '</gmd:RS_Identifier></gmd:referenceSystemIdentifier>';
                $xml[] = '</gmd:MD_ReferenceSystem></gmd:referenceSystemInfo>';
            }
        }
        if ($Error_ReferenceSystem) {
            $errors[] = _errorMessages($config['Data_ReferenceSystem']);
        }

        // IDENTIFICATION INFO
        $xml[] = '<gmd:identificationInfo><gmd:MD_DataIdentification>';
        $xml[] = '<gmd:citation><gmd:CI_Citation>';

        // Data_Title
        $Data_Title = _getCellValue('Data_Title', $sheetData, 'string');
        if ($Data_Title['error']) {
            $errors[] = _errorMessages($config['Data_Title']);
        } else {
            $xml[] = '<gmd:title><gco:CharacterString>' . $Data_Title['value'] . '</gco:CharacterString></gmd:title>';
        }

        // Data_DateCreation / Data_DateRevision / Data_DatePublication
        $DateType = array('Creation', 'Revision', 'Publication');
        $Error_Date = true;
        foreach ($DateType as $Data_DateType) {
            $Data_Date = _getCellValue('Data_Date'.$Data_DateType, $sheetData, 'date');
            //$Data_Date['value'] = PHPExcel_Style_NumberFormat::toFormattedString($Data_Date['value'], "YYYY-MM-DD");
            if (!$Data_Date['error']) {
                $Error_Date = false;
                $xml[] = '<gmd:date><gmd:CI_Date>';
                $xml[] = '<gmd:date><gco:Date>' . $Data_Date['value'] . '</gco:Date></gmd:date>';
                $xml[] = '<gmd:dateType><gmd:CI_DateTypeCode codeList="http://standards.iso.org/ittf/PubliclyAvailableStandards/ISO_19139_Schemas/resources/Codelist/ML_gmxCodelists.xml#CI_DateTypeCode" codeListValue="' . strtolower($Data_DateType) . '">' . strtolower($Data_DateType) . '</gmd:CI_DateTypeCode></gmd:dateType>';
                $xml[] = '</gmd:CI_Date></gmd:date>';
            }
        }
        if ($Error_Date) {
            $errors[] = _errorMessages($config['Data_Date']);
        }
        
        // Data_presentationForm
        // Utilisé pour les cartes (valeur = mapDigital)
        $Data_PresentationForm = _getCellValue('data_presentationform', $sheetData, 'string');
        if ($Data_PresentationForm['error']) {
            // $errors[] = _errorMessages($config['Data_PresentationForm']);
        } else {
            $xml[] = '<gmd:presentationForm>';
            $xml[] = '<gmd:CI_PresentationFormCode codeListValue="'.$Data_PresentationForm['value'].'"
              codeList="http://standards.iso.org/ittf/PubliclyAvailableStandards/ISO_19139_Schemas/resources/Codelist/ML_gmxCodelists.xml#CI_PresentationFormCode" />';
            $xml[] = '</gmd:presentationForm>';
        }

        // Data_Identifier
        // Renseigner MD_FileIdentifier comme Data_Identifier si aucun DataCode renseigné.
        $Error_DataIdentifier = true;
        for ($i = 1; $i < 21; $i++) {
            $Data_Code = _getCellValue('Data_Code'.$i, $sheetData, 'string');
            $Data_CodeSpace = _getCellValue('Data_CodeSpace'.$i, $sheetData, 'string');
            if (!$Data_Code['error']) {
                $Error_DataIdentifier = false;
                $xml[] = '<gmd:identifier><gmd:RS_Identifier>';
                $xml[] = '<gmd:code><gco:CharacterString>' . $Data_Code['value'] . '</gco:CharacterString></gmd:code>';
                if ($Data_CodeSpace['error']) {
                    $xml[] = '<gmd:codeSpace><gco:CharacterString>' . $Data_CodeSpace['value'] . '</gco:CharacterString></gmd:codeSpace>';
                }
                $xml[] = '</gmd:RS_Identifier></gmd:identifier>';
            }
        }
        if ($Error_DataIdentifier) {
            $errors[] = _errorMessages($config['Data_Identifier']);
            $Data_Code['value'] = $MD_FileIdentifier['value'];
            $Data_CodeSpace0 = 'MD_FileIdentifier';
            $xml[] = '<gmd:identifier><gmd:RS_Identifier>';
            $xml[] = '<gmd:code><gco:CharacterString>' . $Data_Code['value'] . '</gco:CharacterString></gmd:code>';
            $xml[] = '<gmd:codeSpace><gco:CharacterString>' . $Data_CodeSpace['value'] . '</gco:CharacterString></gmd:codeSpace>';
            $xml[] = '</gmd:RS_Identifier></gmd:identifier>';
        }

        $xml[] = '</gmd:CI_Citation></gmd:citation>';

        // Data_Abstract
        $Data_Abstract = _getCellValue('Data_Abstract', $sheetData, 'string');
        if ($Data_Abstract['error']) {
            $errors[] = _errorMessages($config['Data_Abstract']);
        } else {
            $xml[] = '<gmd:abstract><gco:CharacterString>' . $Data_Abstract['value'] . '</gco:CharacterString></gmd:abstract>';
        }

        // Data_PointOfContact
        $Error_DataContacts = true;
        // Data_CntRole = '11' // Valeur par defaut: "pointofContact"
        for ($i = 1; $i < 21; $i++) {
            $Data_CntName = _getCellValue('Data_Cnt' . $i . '_Name', $sheetData, 'string');
            $Data_CntFunction = _getCellValue('Data_Cnt' . $i . '_Fct', $sheetData, 'string');
            $Data_CntOrganism = _getCellValue('Data_Cnt' . $i . '_Org', $sheetData, 'string');
            $Data_CntLogo = _getCellValue('Data_Cnt' . $i . '_Logo', $sheetData, 'string');
            $Data_CntAddress = _getCellValue('Data_Cnt' . $i . '_Address', $sheetData, 'string');
            $Data_CntPostalCode = _getCellValue('Data_Cnt' . $i . '_CP', $sheetData, 'string');
            $Data_CntCity = _getCellValue('Data_Cnt' . $i . '_City', $sheetData, 'string');
            $Data_CntPhone = _getCellValue('Data_Cnt' . $i . '_Tel', $sheetData, 'string');
            $Data_CntEmail = _getCellValue('Data_Cnt' . $i . '_Email', $sheetData, 'string');
            $Data_CntRole = _getCellValue('Data_Cnt' . $i . '_Role', $sheetData, 'code');
            if (!$Data_CntOrganism['error'] and !$Data_CntEmail['error']) {
                $Error_DataContacts = false;
            }
            if (!$Data_CntOrganism['error'] or !$Data_CntName['error'] or !$Data_CntFunction['error'] or !$Data_CntEmail['error']) {
                $xml[] = '<gmd:pointOfContact>';
                $xml[] = '<gmd:CI_ResponsibleParty>';
                if (!$Data_CntName['error']) {
                    $xml[] = '<gmd:individualName><gco:CharacterString>' . $Data_CntName['value'] . '</gco:CharacterString></gmd:individualName>';
                }
                if (!$Data_CntOrganism['error']) {
                    $xml[] = '<gmd:organisationName><gco:CharacterString>' . $Data_CntOrganism['value'] . '</gco:CharacterString></gmd:organisationName>';
                }
                if (!$Data_CntFunction['error']) {
                    $xml[] = '<gmd:positionName><gco:CharacterString>' . $Data_CntFunction['value'] . '</gco:CharacterString></gmd:positionName>';
                }
                $xml[] = '<gmd:contactInfo><gmd:CI_Contact>';
                if (!$Data_CntPhone['error']) {
                    $xml[] = '<gmd:phone><gmd:CI_Telephone><gmd:voice><gco:CharacterString>' . $Data_CntPhone['value'] . '</gco:CharacterString></gmd:voice></gmd:CI_Telephone></gmd:phone>';
                }
                $xml[] = '<gmd:address><gmd:CI_Address>';
                if (!$Data_CntAddress['error']) {
                    $xml[] = '<gmd:deliveryPoint><gco:CharacterString>' . $Data_CntAddress['value'] . '</gco:CharacterString></gmd:deliveryPoint>';
                }
                if (!$Data_CntCity['error']) {
                    $xml[] = '<gmd:city><gco:CharacterString>' . $Data_CntCity['value'] . '</gco:CharacterString></gmd:city>';
                }
                if (!$Data_CntPostalCode['error']) {
                    $xml[] = '<gmd:postalCode><gco:CharacterString>' . $Data_CntPostalCode['value'] . '</gco:CharacterString></gmd:postalCode>';
                }
                if (!$Data_CntEmail['error']) {
                    $xml[] = '<gmd:electronicMailAddress><gco:CharacterString>' . $Data_CntEmail['value'] . '</gco:CharacterString></gmd:electronicMailAddress>';
                }
                $xml[] = '</gmd:CI_Address></gmd:address>';
                if (!$Data_CntLogo['error']) {
                    $xml[] = '<gmd:contactInstructions><gmx:FileName src="' . $Data_CntLogo['value'] . '">Logo</gmx:FileName></gmd:contactInstructions>';
                }
                $xml[] = '</gmd:CI_Contact></gmd:contactInfo>';

                if ($Data_CntRole['error'] or !array_key_exists($Data_CntRole['value'], $config['RoleCode2'])) {
                    $errors[] = _errorMessages($config['Data_CntRole']);
                    $Data_CntRole['value'] = $config['Data_CntRole']['defaultValue'];
                } else {
                    $xml[] = '<gmd:role><gmd:CI_RoleCode codeList="http://standards.iso.org/ittf/PubliclyAvailableStandards/ISO_19139_Schemas/resources/Codelist/ML_gmxCodelists.xml#CI_RoleCode" codeListValue="' . $config['RoleCode2'][$Data_CntRole['value']] . '">' . $config['RoleCode2'][$Data_CntRole['value']] . '</gmd:CI_RoleCode></gmd:role>';
                }
                $xml[] = '</gmd:CI_ResponsibleParty>';
                $xml[] = '</gmd:pointOfContact>';
            }
        }
        if ($Error_DataContacts) {
            $errors[] = _errorMessages($config['Data_Contacts']);
        }

        // Data_MaintenanceFrequency
        $Data_MaintenanceFrequency = _getCellValue('Data_MaintenanceFrequency', $sheetData, 'code');
        if ($Data_MaintenanceFrequency['error'] or !array_key_exists($Data_MaintenanceFrequency['value'], $config['MaintenanceFrequencyCode2'])) {
            //$errors[] = _errorMessages($config['MD_HierarchyLevel']);
            $Data_MaintenanceFrequency['value'] = $config['Data_MaintenanceFrequency']['defaultValue'];
        }
        $xml[] = '<gmd:resourceMaintenance>';
        $xml[] = '<gmd:MD_MaintenanceInformation>';
        $xml[] = '<gmd:maintenanceAndUpdateFrequency>';
        $xml[] = '<gmd:MD_MaintenanceFrequencyCode codeList="http://standards.iso.org/ittf/PubliclyAvailableStandards/ISO_19139_Schemas/resources/Codelist/ML_gmxCodelists.xml#MD_MaintenanceFrequencyCode" codeListValue="' . $config['MaintenanceFrequencyCode2'][$Data_MaintenanceFrequency['value']] . '">' . $config['MaintenanceFrequencyCode2'][$Data_MaintenanceFrequency['value']] . '</gmd:MD_MaintenanceFrequencyCode>';
        $xml[] = '</gmd:maintenanceAndUpdateFrequency>';
        $xml[] = '</gmd:MD_MaintenanceInformation>';
        $xml[] = '</gmd:resourceMaintenance>';

        // Data_BrowseGraphic
        for ($i = 1; $i < 21; $i++) {
            $Data_BrowseGraphic_FileName = _getCellValue('Data_BrowseGraphic'.$i.'_Filename', $sheetData, 'string');
            $Data_BrowseGraphic_Description = _getCellValue('Data_BrowseGraphic'.$i.'_Description', $sheetData, 'string');
            if (!$Data_BrowseGraphic_FileName['error']) {
                $Data_BrowseGraphic_Type['value'] = pathinfo($Data_BrowseGraphic_FileName['value'], PATHINFO_EXTENSION);
                $xml[] = '<gmd:graphicOverview>';
                $xml[] = '<gmd:MD_BrowseGraphic>';
                $xml[] = '<gmd:fileName>';
                $xml[] = '<gco:CharacterString>' . $Data_BrowseGraphic_FileName['value'] . '</gco:CharacterString>';
                $xml[] = '</gmd:fileName>';
                if (!$Data_BrowseGraphic_Description['error']) {
                    $xml[] = '<gmd:fileDescription>';
                    $xml[] = '<gco:CharacterString>' . $Data_BrowseGraphic_Description['value'] . '</gco:CharacterString>';
                    $xml[] = '</gmd:fileDescription>';
                }
                $xml[] = '<gmd:fileType>';
                $xml[] = '<gco:CharacterString>'. $Data_BrowseGraphic_Type['value'] .'</gco:CharacterString>';
                $xml[] = '</gmd:fileType>';
                $xml[] = '</gmd:MD_BrowseGraphic>';
                $xml[] = '</gmd:graphicOverview>';
            }
        }

        // Data_Keywords
        $Error_DataKeywords = true;
        for ($i = 1; $i < 21; $i++) {
            $Data_Keyword = _getCellValue('Data_Keyword'.$i, $sheetData, 'string');
            $Data_KeywordType = _getCellValue('Data_Keyword'.$i.'_Type', $sheetData, 'code');
            $Data_ThesaurusName = _getCellValue('Data_Keyword'.$i.'_Thesaurusname', $sheetData, 'string');
            $Data_ThesaurusDateCreation = _getCellValue('Data_Keyword'.$i.'_ThesaurusDateCreation', $sheetData, 'date');
            $Data_ThesaurusDatePublication = _getCellValue('Data_Keyword'.$i.'_ThesaurusDatePublication', $sheetData, 'date');
            $Data_ThesaurusDateRevision = _getCellValue('Data_Keyword'.$i.'_ThesaurusDateRevision', $sheetData, 'date');
            if (!$Data_Keyword['error']) {
                $Error_DataKeywords = false;
                $xml[] = '<gmd:descriptiveKeywords><gmd:MD_Keywords>';
                $xml[] = '<gmd:keyword><gco:CharacterString>' . $Data_Keyword['value'] . '</gco:CharacterString></gmd:keyword>';
                if (!$Data_KeywordType['error'] and array_key_exists($Data_KeywordType['value'], $config['KeywordTypeCode2'])) {
                    $xml[] = '<gmd:type><gmd:MD_KeywordTypeCode codeListValue="' . $config['KeywordTypeCode2'][$Data_KeywordType['value']] . '" codeList="http://www.isotc211.org/2005/resources/codeList.xml#MD_KeywordTypeCode" /></gmd:type>';
                }
                if (!$Data_ThesaurusName['error']) {
                    $xml[] = '<gmd:thesaurusName><gmd:CI_Citation>';
                    $xml[] = '<gmd:title><gco:CharacterString>' . $Data_ThesaurusName['value'] . '</gco:CharacterString></gmd:title>';
                    if (!$Data_ThesaurusDateCreation['error']) {
                        $xml[] = '<gmd:date><gmd:CI_Date>';
                        $xml[] = '<gmd:date><gco:Date>' . $Data_ThesaurusDateCreation['value'] . '</gco:Date></gmd:date>';
                        $xml[] = '<gmd:dateType><gmd:CI_DateTypeCode codeList="http://standards.iso.org/ittf/PubliclyAvailableStandards/ISO_19139_Schemas/resources/Codelist/ML_gmxCodelists.xml#CI_DateTypeCode" codeListValue="creation">creation</gmd:CI_DateTypeCode></gmd:dateType>';
                        $xml[] = '</gmd:CI_Date></gmd:date>';
                    }
                    if (!$Data_ThesaurusDateRevision['error']) {
                        $xml[] = '<gmd:date><gmd:CI_Date>';
                        $xml[] = '<gmd:date><gco:Date>' . $Data_ThesaurusDateRevision['value'] . '</gco:Date></gmd:date>';
                        $xml[] = '<gmd:dateType><gmd:CI_DateTypeCode codeList="http://standards.iso.org/ittf/PubliclyAvailableStandards/ISO_19139_Schemas/resources/Codelist/ML_gmxCodelists.xml#CI_DateTypeCode" codeListValue="revision">revision</gmd:CI_DateTypeCode></gmd:dateType>';
                        $xml[] = '</gmd:CI_Date></gmd:date>';
                    }
                    if (!$Data_ThesaurusDatePublication['error']) {
                        $xml[] = '<gmd:date><gmd:CI_Date>';
                        $xml[] = '<gmd:date><gco:Date>' . $Data_ThesaurusDatePublication['value'] . '</gco:Date></gmd:date>';
                        $xml[] = '<gmd:dateType><gmd:CI_DateTypeCode codeList="http://standards.iso.org/ittf/PubliclyAvailableStandards/ISO_19139_Schemas/resources/Codelist/ML_gmxCodelists.xml#CI_DateTypeCode>" codeListValue="publication">publication</gmd:CI_DateTypeCode></gmd:dateType>';
                        $xml[] = '</gmd:CI_Date></gmd:date>';
                    }
                    $xml[] = '</gmd:CI_Citation></gmd:thesaurusName>';
                }
                $xml[] = '</gmd:MD_Keywords></gmd:descriptiveKeywords>';
            }
        }

        // INSPIRE Keywords
        $Error_DataKeyword = true;
        $Data_InspireThesaurusName = "GEMET - INSPIRE themes, version 1.0";
        $Data_InspireThesaurusDatePublication = "2008-06-01";
        for ($i = 1; $i < 21; $i++) {
            $Data_InspireKeyword = _getCellValue('Data_InspireKeyword'.$i, $sheetData, 'code');
            //if ($Data_InspireKeyword) { Data_InspireKeyword = Data_InspireKeyword.split()[0] }
            if (!$Data_InspireKeyword['error'] and array_key_exists($Data_InspireKeyword['value'], $config['InspireThemeCode2'])) {
                $Error_DataKeyword = false;
                $xml[] = '<gmd:descriptiveKeywords><gmd:MD_Keywords>';
                $xml[] = '<gmd:keyword><gco:CharacterString>' . $config['InspireThemeCode2'][$Data_InspireKeyword['value']] . '</gco:CharacterString></gmd:keyword>';
                $xml[] = '<gmd:thesaurusName><gmd:CI_Citation>';
                $xml[] = '<gmd:title><gco:CharacterString>' . $Data_InspireThesaurusName . '</gco:CharacterString></gmd:title>';
                $xml[] = '<gmd:date><gmd:CI_Date>';
                $xml[] = '<gmd:date><gco:Date>' . $Data_InspireThesaurusDatePublication . '</gco:Date></gmd:date>';
                $xml[] = '<gmd:dateType><gmd:CI_DateTypeCode codeList="http://standards.iso.org/ittf/PubliclyAvailableStandards/ISO_19139_Schemas/resources/Codelist/ML_gmxCodelists.xml#CI_DateTypeCode" codeListValue="publication">publication</gmd:CI_DateTypeCode></gmd:dateType>';
                $xml[] = '</gmd:CI_Date></gmd:date>';
                $xml[] = '</gmd:CI_Citation></gmd:thesaurusName>';
                $xml[] = '</gmd:MD_Keywords></gmd:descriptiveKeywords>';
            }
        }
        if ($Error_DataKeyword) {
            $errors[] = _errorMessages($config['Data_InspireKeyword']);
        }


        // Data_ResourceConstraints
        // Data_UseLimitation
        $Error_DataUseLimitation = true;
        for ($i = 1; $i < 21; $i++) {
            $Data_UseLimitation = _getCellValue('Data_UseLimitation'.$i, $sheetData, 'string');
            if (!$Data_UseLimitation['error']) {
                $Error_DataUseLimitation = false;
                $xml[] = '<gmd:resourceConstraints><gmd:MD_Constraints>';
                $xml[] = '<gmd:useLimitation><gco:CharacterString>' . $Data_UseLimitation['value'] . '</gco:CharacterString></gmd:useLimitation>';
                $xml[] = '</gmd:MD_Constraints></gmd:resourceConstraints>';
            }
        }
        if ($Error_DataUseLimitation) {
            $errors[] = _errorMessages($config['Data_UseLimitation']);
        }

        $xml[] = '<gmd:resourceConstraints><gmd:MD_LegalConstraints>';

        // Data_AccessConstraints
        // Principe d'implémentation retenu: n'est pas obligatoire car par défaut la valeur Data_AccessConstraints = "otherRestrictions" est ajouté et le champ Data_OtherConstraints est lui considéré comme obligatoire
        // Error_DataAccessConstraints = 1
        for ($i = 1; $i < 21; $i++) {
            $Data_AccessConstraints = _getCellValue('Data_AccessConstraints'.$i, $sheetData, 'code');
            if (!$Data_AccessConstraints['error'] and array_key_exists($Data_AccessConstraints['value'], $config['RestrictionCode2'])) {
                $xml[] = '<gmd:accessConstraints>';
                $xml[] = '<gmd:MD_RestrictionCode codeList="http://standards.iso.org/ittf/PubliclyAvailableStandards/ISO_19139_Schemas/resources/Codelist/ML_gmxCodelists.xml#MD_RestrictionCode" codeListValue="' . $config['RestrictionCode2'][$Data_AccessConstraints['value']] . '">' . $config['RestrictionCode2'][$Data_AccessConstraints['value']] . '</gmd:MD_RestrictionCode>';
                $xml[] = '</gmd:accessConstraints>';
            }
        }
        // if Error_DataAccessConstraints: Error += u'Data_AccessConstraints: une contrainte d\'accès doit être précisée pour les données.';

        // Ajout de Data_AccessConstraints = "otherRestrictions" par défaut
        $xml[] = '<gmd:accessConstraints>';
        $xml[] = '<gmd:MD_RestrictionCode codeList="http://standards.iso.org/ittf/PubliclyAvailableStandards/ISO_19139_Schemas/resources/Codelist/ML_gmxCodelists.xml#MD_RestrictionCode" codeListValue="otherRestrictions">otherRestrictions</gmd:MD_RestrictionCode>';
        $xml[] = '</gmd:accessConstraints>';
        
        # Data_UseConstraints
        # Error_DataUseConstraints = 1
        for ($i = 1; $i < 21; $i++) {
            $Data_UseConstraints = _getCellValue('data_useconstraints'.$i, $sheetData, 'code');
            if (!$Data_UseConstraints['error'] and array_key_exists($Data_UseConstraints['value'], $config['RestrictionCode2'])) {
                $xml[] = '<gmd:useConstraints>';
                $xml[] = '<gmd:MD_RestrictionCode codeList="http://standards.iso.org/ittf/PubliclyAvailableStandards/ISO_19139_Schemas/resources/Codelist/ML_gmxCodelists.xml#MD_RestrictionCode" codeListValue="' . $config['RestrictionCode2'][$Data_UseConstraints['value']] . '">' . $config['RestrictionCode2'][$Data_UseConstraints['value']] . '</gmd:MD_RestrictionCode>';
                $xml[] = '</gmd:useConstraints>';
            }
        }
        # if Error_DataUseConstraints: Error += u'Data_UseConstraints: une contrainte d\'utilisation doit être précisée pour les données.\n'

        // Data_OtherConstraints
        $Error_DataOtherConstraints = true;
        for ($i = 1; $i < 21; $i++) {
            $Data_OtherConstraints = _getCellValue('Data_OtherConstraints'.$i, $sheetData, 'code');
            if (!$Data_OtherConstraints['error'] and array_key_exists($Data_OtherConstraints['value'], $config['InspireRestrictionCode2'])) {
                $Error_DataOtherConstraints = false;
                $xml[] = '<gmd:otherConstraints><gco:CharacterString>' . $config['InspireRestrictionCode2'][$Data_OtherConstraints['value']] . '</gco:CharacterString></gmd:otherConstraints>';
            }
        }
        /* Erreur non gérée
        if ($Error_DataOtherConstraints) {
            $errors[] = _errorMessages($config['Data_OtherConstraints']);
        }
        */

        $xml[] = '</gmd:MD_LegalConstraints></gmd:resourceConstraints>';

        // Data_Classification
        //Data_Classification = u'1' // Valeur par défaut = "Non classifié (unclassified)"
        $Data_Classification = _getCellValue('Data_Classification', $sheetData, 'code');
        if ($Data_Classification['error'] or !array_key_exists($Data_Classification['value'], $config['ClassificationCode2'])) {
            $errors[] = _errorMessages($config['Data_Classification']);
            $Data_Classification['value'] = '1 - Non classifié';
        }
        $xml[] = '<gmd:resourceConstraints><gmd:MD_SecurityConstraints><gmd:classification>';
        $xml[] = '<gmd:MD_ClassificationCode codeList="http://standards.iso.org/ittf/PubliclyAvailableStandards/ISO_19139_Schemas/resources/Codelist/ML_gmxCodelists.xml#MD_ClassificationCode" codeListValue="' . $config['ClassificationCode2'][$Data_Classification['value']] . '">' . $config['ClassificationCode2'][$Data_Classification['value']] . '</gmd:MD_ClassificationCode>';
        $xml[] = '</gmd:classification></gmd:MD_SecurityConstraints></gmd:resourceConstraints>';

        // Fin de Data_ResourceConstraints

        // Data_SpatialRepresentationType
        //Data_SpatialRepresentationType = u'1' // Valeur par defaut: "vector"
        $Data_SpatialRepresentationType = _getCellValue('Data_SpatialRepresentationType', $sheetData, 'code');
        if ($Data_SpatialRepresentationType['error'] or !array_key_exists($Data_SpatialRepresentationType['value'], $config['SpatialRepresentationTypeCode2'])) {
            $errors[] = _errorMessages($config['Data_SpatialRepresentationType']);
        } else {
			$xml[] = '<gmd:spatialRepresentationType>';
			$xml[] = '<gmd:MD_SpatialRepresentationTypeCode codeList="http://www.isotc211.org/2005/resources/codeList.xml#MD_SpatialRepresentationTypeCode" codeListValue="' . $config['SpatialRepresentationTypeCode2'][$Data_SpatialRepresentationType['value']] . '">' . $config['SpatialRepresentationTypeCode2'][$Data_SpatialRepresentationType['value']] . '</gmd:MD_SpatialRepresentationTypeCode>';
			$xml[] = '</gmd:spatialRepresentationType>';
		}

        // Data_ScaleDenominator / Data_ScaleDistance
        $Data_ScaleDenominator = _getCellValue('Data_ScaleDenominator', $sheetData, 'string');
        $Data_ScaleDistance = _getCellValue('Data_ScaleDistance', $sheetData, 'string');
        if ($Data_ScaleDenominator['error'] and $Data_ScaleDistance['error']) {
            $errors[] = _errorMessages($config['Data_Scale']);
        } else {
            $xml[] = '<gmd:spatialResolution><gmd:MD_Resolution>';
            if (!$Data_ScaleDenominator['error']) {
                $xml[] = '<gmd:equivalentScale><gmd:MD_RepresentativeFraction>';
                $xml[] = '<gmd:denominator><gco:Integer>' . $Data_ScaleDenominator['value'] . '</gco:Integer></gmd:denominator>';
                $xml[] = '</gmd:MD_RepresentativeFraction></gmd:equivalentScale>';
            }
            if (!$Data_ScaleDistance['error']) {
                $xml[] = '<gmd:distance><gco:Distance uom="http://standards.iso.org/ittf/PublicityAvailableStandards/ISO_19139_Schemas/resources.uom/ML_gmxUom.xml#m">' .$Data_ScaleDistance['value'] . '</gco:Distance></gmd:distance>';
            }
            $xml[] = '</gmd:MD_Resolution></gmd:spatialResolution>';
        }

        // Data_Language
        $Error_DataLanguage = true;
        #Data_Language = u'1' // Valeur par defaut: "français"
        for ($i = 1; $i < 21; $i++) {
            $Data_Language = _getCellValue('Data_Language'.$i, $sheetData, 'code');
            if (!$Data_Language['error'] and array_key_exists($Data_Language['value'], $config['LanguageCode2'])) {
                $Error_DataLanguage = false;
                $xml[] = '<gmd:language>';
                $xml[] = '<gmd:LanguageCode codeList="http://www.loc.gov/standards/iso639-2/" codeListValue="' . $config['LanguageCode2'][$Data_Language['value']] . '">' . $config['LanguageCode2'][$Data_Language['value']] . '</gmd:LanguageCode>';
                $xml[] = '</gmd:language>';
            }
        }
        if ($Error_DataLanguage) {
            $errors[] = _errorMessages($config['Data_Language']);
        }

        // Data_CharacterSet
        // MD_CharacterSet
        $Data_CharacterSet = _getCellValue('Data_CharacterSet', $sheetData, 'code');
        if ($Data_CharacterSet['error'] or !array_key_exists($Data_CharacterSet['value'], $config['CharacterSetCode2'])) {
            $errors[] = _errorMessages($config['Data_CharacterSet']);
            $Data_CharacterSet['value'] = $config['Data_CharacterSet']['defaultValue'];
        }
        $xml[] = '<gmd:characterSet><gmd:MD_CharacterSetCode codeList="http://www.isotc211.org/2005/resources/codeList.xml#MD_CharacterSetCode" codeListValue="' . $config['CharacterSetCode2'][$Data_CharacterSet['value']] . '">' . $config['CharacterSetCode2'][$Data_CharacterSet['value']] . '</gmd:MD_CharacterSetCode></gmd:characterSet>';

        // Data_TopicCategory
        $Error_TopicCategory = true;
        for ($i = 1; $i < 21; $i++) {
            $Data_TopicCategory = _getCellValue('Data_TopicCategory'.$i, $sheetData, 'code');
            if (!$Data_TopicCategory['error'] and array_key_exists($Data_TopicCategory['value'], $config['TopicCategoryCode2'])) {
                $Error_TopicCategory = false;
                $xml[] = '<gmd:topicCategory><gmd:MD_TopicCategoryCode>' . $config['TopicCategoryCode2'][$Data_TopicCategory['value']] . '</gmd:MD_TopicCategoryCode></gmd:topicCategory>';
            }
        }
        if ($Error_TopicCategory) {
            $errors[] = _errorMessages($config['Data_TopicCategory']);
        }

        /* Data_Extent */
        // Data_GeographicExtent
        $Error_DataGeographicExtent = true;
        for ($i = 1; $i < 21; $i++) {
            $Data_ExtentName = _getCellValue('Data_Ext'.$i, $sheetData, 'string');
            $Data_ExtentNorthbound = _getCellValue('Data_Ext'.$i.'_N', $sheetData, 'string');
            $Data_ExtentSouthbound = _getCellValue('Data_Ext'.$i.'_S', $sheetData, 'string');
            $Data_ExtentEastbound = _getCellValue('Data_Ext'.$i.'_E', $sheetData, 'string');
            $Data_ExtentWestbound = _getCellValue('Data_Ext'.$i.'_W', $sheetData, 'string');
            if (!$Data_ExtentNorthbound['error'] and !$Data_ExtentSouthbound['error'] and !$Data_ExtentEastbound['error'] and !$Data_ExtentWestbound['error']) {
                $Error_DataGeographicExtent = false;
                $xml[] = '<gmd:extent><gmd:EX_Extent>';
                $xml[] = '<gmd:description><gco:CharacterString>' . $Data_ExtentName['value'] . '</gco:CharacterString></gmd:description>';
                $xml[] = '<gmd:geographicElement><gmd:EX_GeographicBoundingBox>';
                $xml[] = '<gmd:westBoundLongitude><gco:Decimal>' . $Data_ExtentWestbound['value'] . '</gco:Decimal></gmd:westBoundLongitude>';
                $xml[] = '<gmd:eastBoundLongitude><gco:Decimal>' . $Data_ExtentEastbound['value'] . '</gco:Decimal></gmd:eastBoundLongitude>';
                $xml[] = '<gmd:southBoundLatitude><gco:Decimal>' . $Data_ExtentSouthbound['value'] . '</gco:Decimal></gmd:southBoundLatitude>';
                $xml[] = '<gmd:northBoundLatitude><gco:Decimal>' . $Data_ExtentNorthbound['value'] . '</gco:Decimal></gmd:northBoundLatitude>';
                $xml[] = '</gmd:EX_GeographicBoundingBox></gmd:geographicElement>';
                // $xml[] = '<gmd:geographicElement><gmd:EX_GeographicDescription>';
                // $xml[] = '<extentTypeCode><gmd:Boolean>1</gmd:Boolean></extentTypeCode>';
                // $xml[] = '<geographicIdentifier><gmd:MD_Identifier>';
                // $xml[] = '<code><gco:CharacterString>' . Data_ExtentName . '</gco:CharacterString></code>';
                // $xml[] = '</gmd:MD_Identifier></geographicIdentifier>';
                // $xml[] = '</gmd:EX_GeographicDescription></gmd:geographicElement>';
                $xml[] = '</gmd:EX_Extent></gmd:extent>';
            }
        }
        if ($Error_DataGeographicExtent) {
            $errors[] = _errorMessages($config['Data_GeographicExtent']);
        }

        // Data_TemporalExtent
        for ($i = 1; $i < 21; $i++) {
            $Data_TemporalExtent_Start = _getCellValue('Data_TemporalExtent'.$i.'_Start', $sheetData, 'string');
            $Data_TemporalExtent_End = _getCellValue('Data_TemporalExtent'.$i.'_End', $sheetData, 'string');
            $Data_ExtentName = _getCellValue('Data_TemporalExtent'.$i.'_Description', $sheetData, 'string');
            if (!$Data_TemporalExtent_Start['error'] and !$Data_TemporalExtent_End['error']) {
                $xml[] = '<gmd:extent><gmd:EX_Extent>';
                $xml[] = '<gmd:description><gco:CharacterString>' . $Data_ExtentName['value'] . '</gco:CharacterString></gmd:description>';
                $xml[] = '<gmd:temporalElement><gmd:EX_TemporalExtent>';
                $xml[] = '<gmd:extent><gml:TimePeriod xsi:type="gml:TimePeriodType" gml:id="TemporalId_' . $i . '">';
                $xml[] = '<gml:beginPosition>' . $Data_TemporalExtent_Start['value'] . '</gml:beginPosition>';
                $xml[] = '<gml:endPosition>' . $Data_TemporalExtent_End['value'] . '</gml:endPosition>';
                $xml[] = '</gml:TimePeriod></gmd:extent>';
                $xml[] = '</gmd:EX_TemporalExtent></gmd:temporalElement>';
                $xml[] = '</gmd:EX_Extent></gmd:extent>';
            }
        }

        /*
        // Data_VerticalExtent
        for i in range(1, 20):
            $Data_VerticalExtent_Min = _get_xls_value('data_verticalextent'+str(i)+'_min', lst_name, sh, 'string')
            $Data_VerticalExtent_Max = _get_xls_value('data_verticalextent'+str(i)+'_max', lst_name, sh, 'string')
            $Data_VerticalExtent_Unit = _get_xls_value('data_verticalextent'+str(i)+'_unit', lst_name, sh, 'string')
            $Data_VerticalExtent_Ref = _get_xls_value('data_verticalextent'+str(i)+'_ref', lst_name, sh, 'string')

            if Data_VerticalExtent_Min and Data_VerticalExtent_Max and Data_VerticalExtent_Unit and Data_VerticalExtent_Ref:
                $xml[] = '<gmd:extent><gmd:EX_Extent>';
                $xml[] = '<gmd:verticalElement><gmd:EX_VerticalExtent>';
                $xml[] = '<gmd:minValue><gco:CharacterString>' . Data_VerticalExtent_Min . '</gco:CharacterString></gmd:minValue>';
                $xml[] = '<gmd:maxValue><gco:CharacterString>' . Data_VerticalExtent_Max . '</gco:CharacterString></gmd:maxValue>';
                $xml[] = '<gmd:uom><gco:CharacterString>' . Data_VerticalExtent_Unit . '</gco:CharacterString></gmd:uom>';
                $xml[] = '<gmd:verticalDatum><gco:CharacterString>' . Data_VerticalExtent_Ref . '</gco:CharacterString></gmd:verticalDatum>';
                $xml[] = '</gmd:EX_VerticalExtent></gmd:verticalElement>';
                $xml[] = '</gmd:EX_Extent></gmd:extent>';
        */

        $xml[] = '</gmd:MD_DataIdentification></gmd:identificationInfo>';

        ##// DISTRIBUTION INFO
        $xml[] = '<gmd:distributionInfo><gmd:MD_Distribution>';

        // Data_DistFormat
        for ($i = 1; $i < 21; $i++) {
            $Data_DistFormatName = _getCellValue('Data_DistFormat'.$i.'_Name', $sheetData, 'string');
            $Data_DistFormatVersion = _getCellValue('Data_DistFormat'.$i.'_Version', $sheetData, 'string');
            $Data_DistFormatSpecification = _getCellValue('Data_DistFormat'.$i.'_Specification', $sheetData, 'string');
            if (!$Data_DistFormatName['error']) {
                $xml[] = '<gmd:distributionFormat><gmd:MD_Format>';
                $xml[] = '<gmd:name><gco:CharacterString>' . $Data_DistFormatName['value'] . '</gco:CharacterString></gmd:name>';
                $xml[] = '<gmd:version><gco:CharacterString>' . $Data_DistFormatVersion['value'] . '</gco:CharacterString></gmd:version>';
                $xml[] = '<gmd:specification><gco:CharacterString>' . $Data_DistFormatSpecification['value'] . '</gco:CharacterString></gmd:specification>';
                $xml[] = '</gmd:MD_Format></gmd:distributionFormat>';
            }
        }

        $xml[] = '<gmd:transferOptions><gmd:MD_DigitalTransferOptions>';

        // Data_Linkage (url)
        for ($i = 1; $i < 21; $i++) {
            $Data_LinkageName = _getCellValue('Data_Linkage'.$i.'_Name', $sheetData, 'string');
            $Data_LinkageDescription = _getCellValue('Data_Linkage'.$i.'_Description', $sheetData, 'string');
            $Data_LinkageURL = _getCellValue('Data_Linkage'.$i.'_url', $sheetData, 'string');
            $Data_LinkageProtocol = _getCellValue('Data_Linkage'.$i.'_protocol', $sheetData, 'string');
            
            $linkageName = '<gco:CharacterString>' .$Data_LinkageName['value']. '</gco:CharacterString>';
            
            if (in_array($Data_LinkageProtocol['value'], array("MAP:PDF", "MAP:JPEG", "MAP:JPG", "MAP:PNG", "DATA:ZIP"))) {
                if ($Data_LinkageProtocol['value'] == "MAP:PDF") { 
                    $linkageName = '<gmx:MimeFileType xmlns:gmx="http://www.isotc211.org/2005/gmx" type="application/pdf">'.$Data_LinkageName['value'].'</gmx:MimeFileType>';
                }
                if ($Data_LinkageProtocol['value'] == "MAP:JPEG") { $linkageName = '<gmx:MimeFileType xmlns:gmx="http://www.isotc211.org/2005/gmx" type="image/jpeg">'.$Data_LinkageName['value'].'</gmx:MimeFileType>'; }
                if ($Data_LinkageProtocol['value'] == "MAP:JPG") { $linkageName = '<gmx:MimeFileType xmlns:gmx="http://www.isotc211.org/2005/gmx" type="image/jpg">'.$Data_LinkageName['value'].'</gmx:MimeFileType>'; }
                if ($Data_LinkageProtocol['value'] == "MAP:PNG") { $linkageName = '<gmx:MimeFileType xmlns:gmx="http://www.isotc211.org/2005/gmx" type="image/png">'.$Data_LinkageName['value'].'</gmx:MimeFileType>'; }
                if ($Data_LinkageProtocol['value'] == "DATA:ZIP") { $linkageName = '<gmx:MimeFileType xmlns:gmx="http://www.isotc211.org/2005/gmx" type="application/zip">'.$Data_LinkageName['value'].'</gmx:MimeFileType>'; }
                $Data_LinkageProtocol['value'] = "WWW:DOWNLOAD-1.0-http--download";
            }
            if (!$Data_LinkageURL['error']) {
                $xml[] = '<gmd:onLine><gmd:CI_OnlineResource>';
                $xml[] = '<gmd:linkage><gmd:URL>' . $Data_LinkageURL['value'] . '</gmd:URL></gmd:linkage>';
                if (!$Data_LinkageProtocol['error']) {
                    $xml[] = '<gmd:protocol><gco:CharacterString>' . $Data_LinkageProtocol['value'] . '</gco:CharacterString></gmd:protocol>';
                }
                $xml[] = '<gmd:name>' . $linkageName . '</gmd:name>';
                $xml[] = '<gmd:description><gco:CharacterString>' . $Data_LinkageDescription['value'] . '</gco:CharacterString></gmd:description>';
                $xml[] = '</gmd:CI_OnlineResource></gmd:onLine>';
            }
            $errors[] = $Data_LinkageProtocol['value'];
        }
        
        $xml[] = '</gmd:MD_DigitalTransferOptions></gmd:transferOptions>';
        $xml[] = '</gmd:MD_Distribution></gmd:distributionInfo>';

        ##// DATA QUALITY INFO
        $xml[] = '<gmd:dataQualityInfo><gmd:DQ_DataQuality>';

        // DQ_Level
        $Data_DQ_Level = _getCellValue('Data_DQ_Level', $sheetData, 'code');
        if ($Data_DQ_Level['error']) {
            $Data_DQ_Level['value'] = $MD_HierarchyLevel['value'];
        }
        if (!$Data_DQ_Level['error'] and array_key_exists($Data_DQ_Level['value'], $config['ScopeCode2'])) {
             $xml[] = '<gmd:scope><gmd:DQ_Scope>';
             $xml[] = '<gmd:level><gmd:MD_ScopeCode codeListValue="' . $config['ScopeCode2'][$Data_DQ_Level['value']] . '" codeList="http://standards.iso.org/ittf/PubliclyAvailableStandards/ISO_19139_Schemas/resources/Codelist/ML_gmxCodelists.xml#MD_ScopeCode">' . $config['ScopeCode2'][$Data_DQ_Level['value']] . '</gmd:MD_ScopeCode></gmd:level>';
             $xml[] = '</gmd:DQ_Scope></gmd:scope>';
        }

        // DQ_InspireConformity
        $Error_DQInspireConformity = true;
        for ($i = 1; $i < 21; $i++) {
            $Data_DQ_InspireConformityId = _getCellValue('Data_DQ_InspireConformity'.$i.'_Id', $sheetData, 'string');
            $Data_DQ_InspireConformityTest = _getCellValue('Data_DQ_InspireConformity'.$i.'_Specification', $sheetData, 'code');
            $Data_DQ_InspireConformityDateCreation = _getCellValue('Data_DQ_InspireConformity'.$i.'_DateCreation', $sheetData, 'date');
            $Data_DQ_InspireConformityDatePublication = _getCellValue('Data_DQ_InspireConformity'.$i.'_DatePublication', $sheetData, 'date');
            $Data_DQ_InspireConformityDateRevision = _getCellValue('Data_DQ_InspireConformity'.$i.'_DateRevision', $sheetData, 'date');
            $Data_DQ_InspireConformityResult = _getCellValue('Data_DQ_InspireConformity'.$i.'_Explain', $sheetData, 'string');
            $Data_DQ_InspireConformityPass = _getCellValue('Data_DQ_InspireConformity'.$i.'_Pass', $sheetData, 'string');
            if (!$Data_DQ_InspireConformityTest['error'] and array_key_exists($Data_DQ_InspireConformityTest['value'], $config['InspireSpecificationCode2']) and in_array($Data_DQ_InspireConformityPass, array(1, 2))) {
                $Error_DQInspireConformity = false;
                $xml[] = '<gmd:report><gmd:DQ_DomainConsistency xsi:type="gmd:DQ_DomainConsistency_Type">';
                $xml[] = '<gmd:measureIdentification>';
                $xml[] = '<gmd:RS_Identifier>';
                $xml[] = '<gmd:code>';
                $xml[] = '<gco:CharacterString>InspireConformity_' . $i . '</gco:CharacterString>';
                $xml[] = '</gmd:code>';
                $xml[] = '<gmd:codeSpace>';
                $xml[] = '<gco:CharacterString>INSPIRE Conformity</gco:CharacterString>';
                $xml[] = '</gmd:codeSpace>';
                $xml[] = '</gmd:RS_Identifier>';
                $xml[] = '</gmd:measureIdentification>';
                $xml[] = '<gmd:result><gmd:DQ_ConformanceResult>';
                $xml[] = '<gmd:specification><gmd:CI_Citation>';
                $xml[] = '<gmd:title><gco:CharacterString>' . $config['InspireSpecificationCode2'][$Data_DQ_InspireConformityTest['value']] . '</gco:CharacterString></gmd:title>';
                if (!$Data_DQ_InspireConformityDateCreation['error'] or !$Data_DQ_InspireConformityDatePublication['error'] or !$Data_DQ_InspireConformityDateRevision['error']) {
                    if (!$Data_DQ_InspireConformityDateCreation['error']) {
                        $xml[] = '<gmd:date><gmd:CI_Date>';
                        $xml[] = '<gmd:date><gco:Date>' . $Data_DQ_InspireConformityDateCreation['value'] . '</gco:Date></gmd:date>';
                        $xml[] = '<gmd:dateType><gmd:CI_DateTypeCode codeList="http://standards.iso.org/ittf/PubliclyAvailableStandards/ISO_19139_Schemas/resources/Codelist/ML_gmxCodelists.xml#CI_DateTypeCode" codeListValue="creation">creation</gmd:CI_DateTypeCode></gmd:dateType>';
                        $xml[] = '</gmd:CI_Date></gmd:date>';
                    }
                    if (!$Data_DQ_InspireConformityDatePublication['error']) {
                        $xml[] = '<gmd:date><gmd:CI_Date>';
                        $xml[] = '<gmd:date><gco:Date>' . $Data_DQ_InspireConformityDatePublication['value'] . '</gco:Date></gmd:date>';
                        $xml[] = '<gmd:dateType><gmd:CI_DateTypeCode codeList="http://standards.iso.org/ittf/PubliclyAvailableStandards/ISO_19139_Schemas/resources/Codelist/ML_gmxCodelists.xml#CI_DateTypeCode" codeListValue="publication">publication</gmd:CI_DateTypeCode></gmd:dateType>';
                        $xml[] = '</gmd:CI_Date></gmd:date>';
                    }
                    if (!$Data_DQ_InspireConformityDateRevision['error']) {
                        $xml[] = '<gmd:date><gmd:CI_Date>';
                        $xml[] = '<gmd:date><gco:Date>' . $Data_DQ_InspireConformityDateRevision['value'] . '</gco:Date></gmd:date>';
                        $xml[] = '<gmd:dateType><gmd:CI_DateTypeCode codeList="http://standards.iso.org/ittf/PubliclyAvailableStandards/ISO_19139_Schemas/resources/Codelist/ML_gmxCodelists.xml#CI_DateTypeCode" codeListValue="revision">revision</gmd:CI_DateTypeCode></gmd:dateType>';
                        $xml[] = '</gmd:CI_Date></gmd:date>';
                    }
                } else {
                    $errors[] = _errorMessages($config['DQ_InspireConformityDate']);
                }

                $xml[] = '</gmd:CI_Citation></gmd:specification>';

                if (!$Data_DQ_InspireConformityResult['error']) {
                    $xml[] = '<gmd:explanation><gco:CharacterString>' . $Data_DQ_InspireConformityResult['value'] . '</gco:CharacterString></gmd:explanation>';
                }
                if ($Data_DQ_InspireConformityPass['value'] == "1") {
                    $xml[] = '<gmd:pass><gco:Boolean>true</gco:Boolean></gmd:pass>';
                } elseif ($Data_DQ_InspireConformityPass['value'] == "2") {
                    $xml[] = '<gmd:pass><gco:Boolean>false</gco:Boolean></gmd:pass>';
                }
                $xml[] = '</gmd:DQ_ConformanceResult></gmd:result>';
                $xml[] = '</gmd:DQ_DomainConsistency></gmd:report>';
            }
        }

        // DQ_Conformity
        $Error_DQConformity = true;
        for ($i = 1; $i < 21; $i++) {
            $Data_DQ_ConformityTest = _getCellValue('Data_DQ_Conformity'.$i.'_Specification', $sheetData, 'string');
            $Data_DQ_ConformityDateCreation = _getCellValue('Data_DQ_Conformity'.$i.'_DateCreation', $sheetData, 'date');
            $Data_DQ_ConformityDatePublication = _getCellValue('Data_DQ_Conformity'.$i.'_DatePublication', $sheetData, 'date');
            $Data_DQ_ConformityDateRevision = _getCellValue('Data_DQ_Conformity'.$i.'_DateRevision', $sheetData, 'date');
            $Data_DQ_ConformityResult = _getCellValue('Data_DQ_Conformity'.$i.'_Explain', $sheetData, 'string');
            $Data_DQ_ConformityPass = _getCellValue('Data_DQ_Conformity'.$i.'_Pass', $sheetData, 'string');
            if (!$Data_DQ_ConformityTest['error']) {
                $Error_DQInspireConformity = false;
                $xml[] = '<gmd:report><gmd:DQ_DomainConsistency xsi:type="gmd:DQ_DomainConsistency_Type">';
                $xml[] = '<gmd:measureIdentification>';
                $xml[] = '<gmd:RS_Identifier>';
                $xml[] = '<gmd:code>';
                $xml[] = '<gco:CharacterString>Conformity_' . $i . '</gco:CharacterString>';
                $xml[] = '</gmd:code>';
                $xml[] = '<gmd:codeSpace>';
                $xml[] = '<gco:CharacterString>Other conformity</gco:CharacterString>';
                $xml[] = '</gmd:codeSpace>';
                $xml[] = '</gmd:RS_Identifier>';
                $xml[] = '</gmd:measureIdentification>';
                $xml[] = '<gmd:result><gmd:DQ_ConformanceResult>';
                $xml[] = '<gmd:specification><gmd:CI_Citation>';
                $xml[] = '<gmd:title><gco:CharacterString>' . $Data_DQ_ConformityTest['value'] . '</gco:CharacterString></gmd:title>';
                if (!$Data_DQ_ConformityDateCreation['error'] or !$Data_DQ_ConformityDatePublication['error'] or !$Data_DQ_ConformityDateRevision['error']) {
                    if (!$Data_DQ_ConformityDateCreation['error']) {
                        $xml[] = '<gmd:date><gmd:CI_Date>';
                        $xml[] = '<gmd:date><gco:Date>' . $Data_DQ_ConformityDateCreation['value'] . '</gco:Date></gmd:date>';
                        $xml[] = '<gmd:dateType><gmd:CI_DateTypeCode codeList="http://standards.iso.org/ittf/PubliclyAvailableStandards/ISO_19139_Schemas/resources/Codelist/ML_gmxCodelists.xml#CI_DateTypeCode" codeListValue="creation">creation</gmd:CI_DateTypeCode></gmd:dateType>';
                        $xml[] = '</gmd:CI_Date></gmd:date>';
                    }
                    if (!$Data_DQ_ConformityDatePublication['error']) {
                        $xml[] = '<gmd:date><gmd:CI_Date>';
                        $xml[] = '<gmd:date><gco:Date>' . $Data_DQ_ConformityDatePublication['value'] . '</gco:Date></gmd:date>';
                        $xml[] = '<gmd:dateType><gmd:CI_DateTypeCode codeList="http://standards.iso.org/ittf/PubliclyAvailableStandards/ISO_19139_Schemas/resources/Codelist/ML_gmxCodelists.xml#CI_DateTypeCode" codeListValue="publication">publication</gmd:CI_DateTypeCode></gmd:dateType>';
                        $xml[] = '</gmd:CI_Date></gmd:date>';
                    }
                    if (!$Data_DQ_ConformityDateRevision['error']) {
                        $xml[] = '<gmd:date><gmd:CI_Date>';
                        $xml[] = '<gmd:date><gco:Date>' . $Data_DQ_ConformityDateRevision['value'] . '</gco:Date></gmd:date>';
                        $xml[] = '<gmd:dateType><gmd:CI_DateTypeCode codeList="http://standards.iso.org/ittf/PubliclyAvailableStandards/ISO_19139_Schemas/resources/Codelist/ML_gmxCodelists.xml#CI_DateTypeCode" codeListValue="revision">revision</gmd:CI_DateTypeCode></gmd:dateType>';
                        $xml[] = '</gmd:CI_Date></gmd:date>';
                    }
                } else {
                    $errors[] = _errorMessages($config['DQ_SpecificationDate']);
                }
                
                $xml[] = '</gmd:CI_Citation></gmd:specification>';

                if (!$Data_DQ_ConformityResult['error']) {
                    $xml[] = '<gmd:explanation><gco:CharacterString>' . $Data_DQ_ConformityResult['value'] . '</gco:CharacterString></gmd:explanation>';
                }
                if (!$Data_DQ_ConformityPass == "1") {
                    $xml[] = '<gmd:pass><gco:Boolean>true</gco:Boolean></gmd:pass>';
                } elseif (!$Data_DQ_ConformityPass == "2") {
                    $xml[] = '<gmd:pass><gco:Boolean>false</gco:Boolean></gmd:pass>';
                }

                $xml[] = '</gmd:DQ_ConformanceResult></gmd:result>';
                $xml[] = '</gmd:DQ_DomainConsistency></gmd:report>';
            }
        }

        // DQ_Lineage
        $xml[] = '<gmd:lineage><gmd:LI_Lineage>';

        // LI_Statement
        $LI_Statement = _getCellValue('LI_Statement', $sheetData, 'string');
        if (!$LI_Statement['error']) {
            $xml[] = '<gmd:statement><gco:CharacterString>' . $LI_Statement['value'] . '</gco:CharacterString></gmd:statement>';
        } else {
            $errors[] = _errorMessages($config['LI_Statement']);
        }

        // LI_ProcessStep
        $LI_ProcessStep = _getCellValue('LI_ProcessStep', $sheetData, 'string');
        if (!$LI_ProcessStep['error']) {
            $xml[] = '<gmd:processStep><gmd:LI_ProcessStep>';
            $xml[] = '<gmd:description><gco:CharacterString>' . $LI_ProcessStep['value'] . '</gco:CharacterString></gmd:description>';
            $xml[] = '</gmd:LI_ProcessStep></gmd:processStep>';
        }
        
        // LI_Source
        $LI_Source = _getCellValue('LI_Source', $sheetData, 'string');
        if (!$LI_Source['error']) {
            $xml[] = '<gmd:source><gmd:LI_Source>';
            $xml[] = '<gmd:description><gco:CharacterString>' . $LI_Source['value'] . '</gco:CharacterString></gmd:description>';
            $xml[] = '</gmd:LI_Source></gmd:source>';
        }
        $xml[] = '</gmd:LI_Lineage></gmd:lineage>';
        $xml[] = '</gmd:DQ_DataQuality></gmd:dataQualityInfo>';

        // Fin du fichier
        $xml[] = '</gmd:MD_Metadata>';

        // Ecriture depuis début du fichier
        // Ecriture depuis début du fichier
        if (!$fp = fopen($path_out.$f_out,"w")) {
            $errors[] = "Echec de l'ouverture du fichier.";
            exit;
        } else {
            $xml = implode("\n", $xml);
            fputs($fp, $xml);
            fclose($fp);
            $Log[] = "Fichier XML enregistré.";
        }

        $Message[0] = $Log;
        $Message[1] = $errors;
        return $Message;
    }
}

/* End of file MY_xml2xls.php */
/* Location: ./application/helpers/MY_xml2xls.php */
