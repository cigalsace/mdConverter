<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdconverter extends CI_Controller {

    function __construct() {
		parent::__construct();
        // Load helpers, librairies and config files
		$this->load->helper(array('form', 'url', 'my_xml2xls', 'my_xls2xml'));
        $this->load->library('PHPExcel_1.8.0/Classes/PHPExcel');
        $this->mdc_config = array_merge($this->config->item('config'), $this->config->item('xml'), $this->config->item('codelist'), $this->config->item('errorMessages'));
        $this->mdc_template = $this->mdc_config['template_file'];
        // $this->output->enable_profiler(TRUE);
	}

	public function index()	{
		$config['upload_path'] = './uploads/';
        // TODO: Ligne suivante ne fonctionne pas?
		// $config['allowed_types'] = 'xml|zip|xls|xlsx|XML|XLS|XSLX|ZIP';
		$config['allowed_types'] = '*';
		$config['max_size']	= '20000';

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('file')) {
			$data['error'] = $this->upload->display_errors();
			$this->load->view('index', $data);
		} else {
			$data['error'] = '';
            
            $file = $this->upload->data();
            
            // créer les dossiers UUID/in et UUID/out
            $uniqid = uniqid();
            $path_in = 'uploads/'.$uniqid.'/in/';
            $path_out = 'uploads/'.$uniqid.'/out/';
            $path_template = 'uploads/'.$uniqid.'/template/';
            if (!is_dir($path_in)) {
                if (!mkdir($path_in, 0777, true)) { $data['message'][] = "Impossible de créer le répertoire in."; }
            }
            if (!is_dir($path_out)) {
                if (!mkdir($path_out, 0777, true)) { $data['message'][] = "Impossible de créer le répertoire out."; }
            }
            if (!is_dir($path_template)) {
                if (!mkdir($path_template, 0777, true)) { $data['message'][] = "Impossible de créer le répertoire template."; }
            }
                        
            // selon l'extension: si zip, dézipper dans UUID/in
            if (strtolower($file['file_ext']) == '.zip') {
                $data['message'][] = "fichier zip";
                $zip = new ZipArchive;
                $res = $zip->open($file['full_path']);
                if ($res === TRUE) {
                    $zip->extractTo($path_in);
                    $zip->close();
                    unlink($file['full_path']);
                    $data['message'][] = 'Fichier dézipé et supprimé.';
                } else {
                    $data['message'][] = 'Erreur de dézipage...';
                }
            // sinon copier fichier UUID/in
            } elseif (in_array(strtolower($file['file_ext']), array('.xml', '.xlsx', '.xls'))) {
                $data['message'][] = "fichier XML ou XLS/XLSX";
                copy($file['full_path'], $path_in.$file['file_name']);
                unlink($file['full_path']);
            } else {
                $data['message'][] = "Bad file: ext error!";
            }
            
            // Traitement:
                // pour chaque fichier de UUID/in:
                    // si file = XML : générer xls dans UUID/out.
                    // si file = XLS : générer xml dans UUID/out.
            $dir = opendir($path_in);
            $count = 0;
            while($f_in = readdir($dir)) {
                if($f_in != '.' && $f_in != '..' && !is_dir($path_in.$f_in)) {
                    $path_info = pathinfo($path_in.$f_in);
                    if (in_array(strtolower($path_info['extension']), array('xml', 'xlsx', 'xls'))) {
                        $count += 1;
                        if (strtolower($path_info['extension']) == "xml") {
                            $config['upload_path'] = './'.$path_template;
                            $config['allowed_types'] = '*';
                            $config['max_size']	= '20000';
                            $this->upload->initialize($config);
                            if ($this->upload->do_upload('template')) {
                                $temp_file = $this->upload->data();
                                if (strtolower($temp_file['file_ext'] == '.xlsx')) {
                                    $this->mdc_template = $this->upload->data();
                                } else {
                                    $data['message'][] = "Pas de fichier chargé ou fichier non valide.";
                                    $data['message'][] = "Utilisation du fichier template par défaut.";
                                }
                            }
                            $data['files'][$count]['message'] = "XML - Traiement de : ".$f_in;
                            $f_out = $path_info['filename'].strtolower($this->mdc_template['file_ext']);
                            $log = xml2xls($path_in, $f_in, $path_out, $f_out, $this->mdc_config, $this->mdc_template);
                        
                        } elseif (in_array(strtolower($path_info['extension']), array('xlsx', 'xls'))) {
                            $f_out = $path_info['filename'].'.xml';
                            $data['files'][$count]['message'] = "XLS/XLSX - Traiement de : ".$f_in;
                            $log = xls2xml($path_in, $f_in, $path_out, $f_out, $this->mdc_config);
                        }
                        $data['files'][$count]['log'] = $log[0];
                        $data['files'][$count]['xml_error'] = $log[1];
                        $data['files'][$count]['url_in'] = base_url($path_in.$f_in);
                        $data['files'][$count]['url_out'] = base_url($path_out.$f_out);
                        $data['files'][$count]['info_in'] = $path_info;
                        $data['files'][$count]['info_out'] = pathinfo($path_out.$f_out);
                    } else {
                        // Fichier non traité
                        $data['files_error'][] = $path_info;
                    }
                }
            }
            closedir($dir);
            
            if ($count > 1 && is_dir($path_out)) {
                $data['message'][] = "Nécessité de zipper le dossier résultant (".$count." fichiers).";
                $zip_file = 'out.zip';
                $zip = new ZipArchive();
                if($zip->open($path_out.$zip_file, ZipArchive::CREATE) == TRUE) {
                    // Ouverture de l’archive réussie.
                    // Récupération des fichiers.
                    $files = scandir($path_out);
                    // On enlève . et .. qui représentent le dossier courant et le dossier parent.                 
                    foreach($files as $f) {
                        if($f_in != '.' && $f_in != '..' && !is_dir($path_out.$f)) {
                            // On ajoute chaque fichier à l’archive en spécifiant l’argument optionnel.
                            // Pour ne pas créer de dossier dans l’archive.
                            if(!$zip->addFile($path_out.$f, $f)) {
                                $data['message'][] = 'Impossible d\'ajouter "'.$f.'".<br />';
                            }
                        }
                    }
                    // On ferme l’archive.
                    $zip->close();
                    $data['zip_file']['name'] = $zip_file;
                    $data['zip_file']['path'] = $path_out;
                }
            }
            // Proposer liste des fichiers in et out.
			$data['upload_file'] = $file;
			$this->load->view('index', $data);
		}
	}
}

/* End of file mdconverter.php */
/* Location: ./application/controllers/mdconverter.php */
