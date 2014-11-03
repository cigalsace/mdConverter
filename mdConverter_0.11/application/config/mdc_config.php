<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| MDC Config
|--------------------------------------------------------------------------
|
| Liste des variables de configuratoon générales pour mdc
|
*/

date_default_timezone_set('Europe/Paris');

$config['app_title'] = "mdConverter";
$config['app_description'] = "mdConverter: application PHP de conversion de fichier de métadonnées (XML <=> XLS(X)))";
$config['app_keywords'] = "mdConverter, convertir, métadonnées, metadata, XML, IDO, Inspire, directive";
$config['app_name'] = "mdConverter";
$config['app_version'] = "0.11 - 141009";
$config['app_credits'] = "(c) G. Ryckelynck / CIGAL 2014";

$config['template'] = "cigal_light";

$config['config']['xml_dir'] = '';
$config['config']['xls_dir'] = '';
// $config['config']['xml_file'] = 'IDFiche_01234567899.xml';
// $config['config']['xls_file'] = 'Formulaire_SaisieMD_CIGAL_1.xls';
$config['config']['sheetname'] = 'Formulaire';

// $config['config']['xlsx_file'] = './xml2xls/Formulaire_SaisieMD_CIGAL_1.22_1308161.xlsx';
$config['config']['template_file'] = Array(
    'file_name'    => "Formulaire_SaisieMD_CIGAL_1.22_1308161.xlsx",
    'file_type'    => "file/xls",
    'file_path'    => realpath("./uploads/templates"),
    'full_path'    => realpath("./uploads/templates/Formulaire_SaisieMD_CIGAL_1.22_1308161.xlsx"),
    'raw_name'     => "Formulaire_SaisieMD_CIGAL_1.22_1308161",
    'orig_name'    => "Formulaire_SaisieMD_CIGAL_1.22_1308161.xlsx",
    'file_ext'     => ".xlsx",
    'file_size'    => 0,
    'is_image'     => 0,
    'image_width'  => 0,
    'image_height' => 0,
    'image_type'   => 0,
    'image_size_str' => 0
);

/* End of file mdc_config.php */
/* Location: ./application/config/mdc_config.php */
