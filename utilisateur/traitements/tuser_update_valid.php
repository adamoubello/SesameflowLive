<?php
/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		utilisateur
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello <moustaphbi@yahoo.fr>
 * @desc			Script pour la modification d'un utilisateur. Ce script peut être appellé depuis ajax
 * 
 * @creationdate	08 juillet 2009
 * @updates
 * 	# lundi 20 juillet 2009 by patrick mveng<patrick.mveng@interfacesa.local>
 * 		- cryptage du mot de passe avec md5 
 * 		- définition à 35 caractères de la taille du champ passworduser dans la bd, car 
 * le résultat de md5 est de taille 32
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
   
   //obtenir le séparateur de dossier pour la OS en cours
   if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
   //chargement des spécifications de la classe utilisateur
   require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."utilisateur.class.php");
   
   //instancier un objet utilisateur
   $user = new utilisateur();
   //créer automatiquement attibuts sur l'objet
   foreach ($data as $lattribut => $lvaleur) 
   {
   	$user->$lattribut = $lvaleur;	
   }
   
   
   //crypter le mot de passe avant de l'entegistrer dans la base données
   $user->passworduser = md5(trim($user->passworduser));
   
  //chargement de PEAR
  ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	
  require_once($siteweb->get_document_root().DS.'lang'.DS.'application.'.$lang.'.php');	

   //enregistrer l'utilisateur
   if ($user->modifier())
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
					<li>".$user->exception."</li>
				</ul>
			</dd>";
   }
   
   die($lretval);
   
?>
