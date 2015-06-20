<?php
/**
 * @version			1.0
 * @package			Administration
 * @subpackage		Module
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			patrick mveng<patrick.mveng@interfacesa.local>
 * @desc			Script pour l'activation/désactivation d'un module
 * @param 			
 * @creationdate	03 août 2009
 * @updates
 */
	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
		$data[$lkey] = $lvalue;
	}
	
	//partie copiéé dans tgroupe_update_valid.php et modifiée
	
	$ajax = (isset($data["ajax"])) ? (! is_null($data["ajax"])) ? $data["ajax"] : 0 : 0;
	$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
	$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	$etatmod = (isset($data["etatmod"])) ? (! is_null($data["etatmod"])) ? $data["etatmod"] : 0 : 0;
	
	//obtenir le séparateur de dossier pour la OS en cours
	if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
	
	$chemin = dirname(__FILE__);
	$chemin = str_replace(DS."administration".DS."traitements","",$chemin);
	require_once($chemin.DS.'classe'.DS.'application.class.php');
	
	$siteweb = new Application();
	
	//obtenir le séparateur de dossier pour la OS en cours
	if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
	//chargement des spécifications de la classe processus
	require_once($siteweb->get_document_root().DS."administration".DS."classe".DS."config.class.php");
	
	//instancier un objet  config
	$lconfig = new Config();
	
	//créer automatiquement attibuts sur l'objet
	foreach ($data as $lattribut => $lvaleur)
	{
		$lconfig->$lattribut = $lvaleur;
	}
	//chargement de PEAR
	ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear'); //charger les packages de PEAR::MDB2
	require_once($siteweb->get_document_root().DS.'lang'.DS.'application.'.$lang.'.php');
	
	if (! $lconfig->modifier_module($etatmod)) die($lconfig->get_exception());
	else 
	{
		if (intval($etatmod) == 1) $lcode_traduction = "activation_valid_success";
		else $lcode_traduction = "desactivation_valid_success";
		
		$lretval = "
			<dt class=\"message\">Message</dt>

			<dd class=\"message message fade\">
				<ul>
					<li>".$translate[$lcode_traduction]."</li>
				</ul>
			</dd>";
		
		unset($lcode_traduction);

	}
	
	
	if (intval($ajax) == 1)
	{
		die($lretval);
	}

?>