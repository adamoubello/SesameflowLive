<?php
/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Groupe
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits r�serv�s
 * @license			INTERFACE SA
 * @author 			Bello 
 * @desc			Script pour la modification d'un nouveau processus. Ce script peut �tre appell� depuis ajax
 * @creationdate	juin 2009
 * @updates
 */
   
	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
	$data[$lkey] = $lvalue;
	}
   
	$ajax = (isset($data["ajax"])) ? (! is_null($data["ajax"])) ? $data["ajax"] : 0 : 1;
	$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
	$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
    $chemin = dirname(__FILE__);
    $chemin = str_replace("\utilisateur\\traitements","",$chemin);
	require_once($chemin.'\classe\application.class.php');	
   $siteweb = new Application();
   
   //obtenir le s�parateur de dossier pour la OS en cours
   if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
   //chargement des sp�cifications de la classe processus
   require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."groupe.class.php");
   
   //instancier un objet groupe
   $lgroupe = new groupe();
   
   //cr�er automatiquement attibuts sur l'objet
   foreach ($data as $lattribut => $lvaleur) 
   {
   	$lgroupe->$lattribut = $lvaleur;	
   }
   
    //chargement de PEAR
  ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	
  require_once($siteweb->get_document_root().DS.'lang'.DS.'application.'.$lang.'.php');	

   //enregistrer le groupe
   if ($lgroupe->modifier())
   {
   		$lretval = "
			<dt class=\"message\">Message</dt>

			<dd class=\"message message fade\">
				<ul>
					<li>".$translate["update_valid_success"]."</li>
				</ul>
			</dd>";
   }
   else
   {
   		$lretval = "
			<dt class=\"message\">Message</dt>

			<dd class=\"message message error\">
				<ul>
					<li>".$lgroupe->exception."</li>
				</ul>
			</dd>";
   }
   
   die($lretval);
   
?>