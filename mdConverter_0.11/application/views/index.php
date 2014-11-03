<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<!-- Encodage du site -->
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        
        <!-- Titre du site -->
		<title><?php echo $this->config->item('app_title'); ?></title>
		
        <!-- Meta-tags du site -->
		<meta name="keywords" content="<?php echo $this->config->item('app_keywords'); ?>" />
		<meta name="description" content="<?php echo $this->config->item('app_description'); ?>" />
		<meta name="author" content="Guillaume Ryckelynck" />
		
        <!-- Icones du site -->
		<link rel="shortcut icon" href="<?php //echo $icon; ?>" />
		<link rel="icon" href="<?php //echo $icon; ?>" type="image/x-icon" />
    
		<!-- CSS du site -->
        <?php $css_name = $this->config->item('template'); // theme par default défini dans le fichier de config ?>
		<!-- css de jquery-ui -->
		<link type="text/css" href="<?php echo base_url(); ?>css/<?php echo $css_name; ?>/jquery-ui-1.10.3.custom.min.css" rel="Stylesheet" />
        <link type="text/css" href="<?php echo base_url(); ?>css/index.css" rel="Stylesheet" />
        
		<!-- Chargement des fichiers css spécifiques envoyés par le controller -->
		<?php if (isset($css)) : ?>
			<?php foreach ($css as $css_file) : ?>
				<link type="text/css" href="<?php echo base_url(); ?>css/<?php echo $css_file?>.css" rel="Stylesheet" />
			<?php endforeach; ?>
		<?php endif; ?>

        <!-- Javascript -->
		<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-2.0.3.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-2.0.3.min.map"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-1.10.3.custom.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/index.js"></script>
        
        <!-- Chargement des fichiers js spécifiques envoyés par le controller -->
        <?php if (isset($js)) : ?>
            <?php foreach ($js as $js_file) : ?>
                <script type="text/javascript" src="<?php echo base_url(); ?>js/<?php echo $js_file?>.js"></script>
            <?php endforeach; ?>
        <?php endif; ?>
        
	</head>
    <body>

        <div id="container">
            <div id="header" class="ui-widget-header ui-corner-all">
                <h1>mdConverter</h1>
            </div>
            <div id="wrap">
                <div id="body">
                    <p>Envoyer un fichier à convertir via le formulaire ci-dessous.</p>
                    
                    <?php echo $error; ?>
                    <form method="POST" action="<?php echo site_url("mdconverter/index/"); ?>" enctype="multipart/form-data">
                        <p><span class="label">Fichier :</span><input type="file" name="file"></p>
                        <p><span class="label">Modèle :</span><input type="file" name="template"></p>
                        <p><input type="submit" name="sendfile" value="Envoyer le fichier"></p>
                    </form>
                
                    <div id="messages" class="ui-corner-all">                        
                        <hr />
                        <?php if (isset($upload_file)) : ?>
                            <h2>Fichier source:</h2>
                                <table  class="ui-corner-all">
                                    <tr>
                                        <th clas="ui-state-default">Nom</th>
                                        <th clas="ui-state-default">Ext.</th>
                                        <th clas="ui-state-default">Taille</th>
                                    </tr>
                                    <tr>
                                        <td><?php echo $upload_file['orig_name']; ?></td>
                                        <td><?php echo $upload_file['file_ext']; ?></td>
                                        <td><?php echo $upload_file['file_size']; ?> ko</td>
                                    </tr>
                                </table>
                        <?php endif; ?>

                        <?php $i = 0; ?>
                        <?php if (isset($files)) : ?>
                            <h2>Résultat:</h2>
                            <table class="ui-corner-all">
                                <tr>
                                    <th clas="ui-state-default">Fichier source</th>
                                    <th clas="ui-state-default">Ext.</th>
                                    <th clas="ui-state-default">Fichier destination</th>
                                    <th clas="ui-state-default">Ext.</th>
                                </tr>
                                <?php foreach ($files as $f) : ?>
                                    <tr>
                                        <td>
                                            <?php if (fopen($f['url_in'], 'r')): ?>
                                                <a href="<?php echo $f['url_in']; ?>"><?php echo $f['info_in']['basename']; ?></a>
                                            <?php else: ?>
                                                Le fichier "<?php echo $f['info_in']['basename']; ?>" n'existe pas.
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $f['info_in']['extension']; ?></td>
                                        <td>
                                            <?php if (fopen($f['url_out'], 'r')): ?>
                                                <a href="<?php echo $f['url_out']; ?>"><?php echo $f['info_out']['basename']; ?></a></td>
                                            <?php else: ?>
                                                Le fichier "<?php echo $f['info_out']['basename']; ?>" n'existe pas.
                                            <?php endif; ?>
                                        <td><?php echo $f['info_out']['extension']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                            <?php if (isset($zip_file)) : ?>
                                <p>Télécharger l'ensemble des fichiers: <a href="<?php echo base_url($zip_file['path'].$zip_file['name']); ?>"><?php echo $zip_file['name']; ?></a></p>
                            <?php endif; ?>
                        <?php endif; ?>
                        
                        <?php if (isset($files_error)) : ?>
                            <h2>Fichiers non traités:</h2>
                            <table class="ui-corner-all">
                                <tr>
                                    <th clas="ui-state-default">Nom</th>
                                    <th clas="ui-state-default">Ext.</th>
                                </tr>
                                <?php foreach ($files_error as $f_error) : ?>
                                    <tr>
                                        <td><?php echo $f_error['basename']; ?></td>
                                        <td><?php echo $f_error['extension']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>
                    
                <div id="help" class="ui-widget ui-corner-all">
                    <h2>Aide:</h2>
                    <p>MD Converter est une application web (PHP) qui permet:</p>
                    <ul>
                        <li>De convertir des fichiers de métadonnées géographioques XML (norme 19139 / Inspire) en fichiers MS Excel XLSX selon une mise en forme établie dans le cadre du partenariat CIGAL (www.cigalsace.org).</li>
                        <li>De convertir des fichiers MS Excel (XLS et XLSX) respectant la mise en forme établie dans le cadre du partenariat CIGAL (<a href="http://www.cigalsace.org">www.cigalsace.org</a>) en fichiers de métadonnées géographiques XML (norme 19139 / Inspire).</li>
                    </ul>
                    <p>Pour ce faire, charger un fichier et laissez tourner... </p>
                    <p><strong>Les formats supportés sont:</strong></p>
                    <ul>
                        <li>XML: fichier de métadonnées respectant la norme ISO 19139 / Inspire</li>
                        <li>XLS: fichier MS Excel mis en forme selon le profil CIGAL</li>
                        <li>XLSX: fichier MS Excel mis en forme selon le profil CIGAL</li>
                        <li>ZIP: ensemble de fichier XML et/ou XLS</li>
                    </ul>
                    <p><strong>Lors de la conversion:</strong></p>
                    <ul>
                        <li>Les fichiers XML sont convertis en XLSX.</li>
                        <li>Les fichiers XLS et XLSX sont convertis en XML.</li>
                        <li>Les autres fichiers sont ignorés.</li>
                    </ul>
                    <p><em>NB: lors de la conversion d'un fichier XML en XLSX, les éléments relatifs aux spécifications INSPIRE sont ignorés.</em></p>
                </div>
            </div>
            
             <div id="footer">
                <!-- Ceci est mon pied de page -->
                <p class="stats">Page générée en <strong>{elapsed_time}</strong> secondes - <a href="#" class="bt_logs" title="Logs">[logs]</a></p>
                <p class="credits"><?php echo $this->config->item('app_credits').' - '.$this->config->item('app_name').' '.$this->config->item('app_version'); ?></p>
            </div>
        </div>

        <div id="logs" class="ui-widget ui-corner-all hidden" title="Logs">
            <?php if (isset($files)) : ?>
            Files:
<pre>
<?php print_r($files); ?>
</pre>
            <?php endif; ?>
            <?php if (isset($message)) : ?>
            Messages:
<pre>
<?php print_r($message); ?>
</pre>
            <?php endif; ?>
            <?php if (isset($files_error)) : ?>
            Files error:
<pre>
<?php print_r($files_error); ?>
</pre>
            <?php endif; ?>
        </div>

    </body>
</html>
