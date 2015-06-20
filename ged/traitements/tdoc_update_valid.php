<?php
/**
 * @version			1.0
 * @package			GED
 * @subpackage		traitements
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			William Nkingné <william.nkingne@laposte.net>
 * @desc			Script de traitement de la mise à jour d'un document.
 * @creationdate	mercredi 30 juin 2009
 * @updates
 */	
	global $siteweb, $numdoc;
	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
	$data[$lkey] = $lvalue;
	}
	
	$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
	$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	$numtache = (isset($data["numtache"])) ? (! is_null($data["numtache"])) ? $data["numtache"] : null : null;
	$liste_elements = (isset($data["liste_elements"])) ? (! is_null($data["liste_elements"])) ? $data["liste_elements"] : "" : "";
	$typedoc = (isset($data["typedoc"])) ? (! is_null($data["typedoc"])) ? $data["typedoc"] : "" : "";
	$numdoc = $data["numdoc"];
	$document= (isset($data["document"])) ? (! is_null($data["document"])) ? $data["document"] : null : null;
   	$ajax = (isset($data["ajax"])) ? (! is_null($data["ajax"])) ? $data["ajax"] : 0 : 0;

   	$chemin = dirname(__FILE__);    
	$chemin = str_replace("\ged\\traitements","",$chemin);
	require_once($chemin.'\classe\application.class.php');	
   	$siteweb = new Application();
   	require_once($siteweb->get_document_root().DS."ged".DS."lang".DS."ged.{$lang}.php");
   
    //obtenir le séparateur de dossier pour la OS en cours
    if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
   
    //chargement des spécifications de la classe formulaire
    require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."formulaire.class.php");
    require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."champ.class.php");
    require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."donnee.class.php");
   
    //instancier un objet formulaire
    $lform = new Formulaire();
   
    //créer automatiquement attributs sur l'objet     
    $lform->setNumdoc($numdoc);
    $lform->setTitredoc($titredoc);
    $lform->setDatecreation($datecreation);
    $lform->setCodeuser($codeuser);
   
    //chargement de PEAR
    ini_set('include_path', $siteweb->get_document_root().'\includes\pear');		
    require_once($siteweb->get_document_root().DS.'lang'.DS.'application.'.$lang.'.php');
   
    switch(trim($typedoc)) {
	   		case "dde_credit" :
	   			$larr_champ_valide = array("retenue" , "montant", "date_credit" , "ret_annuite" , "nbr_annuite" , "annuite");
	   			break;
	   		case "dde_conge" :
	   			$larr_champ_valide = array("motif" , "precision" , "dat_deb_conge" , "dat_fin_conge");
	   			break;
	   		case "dde_achat" :
				$larr_champ_valide = array("departement" , "designation", "objet" , "date_deb" , "date_fin" , "observation");
	   			break;
    }

    //if ($lform->modify()) { $larr_infos_elements = explode(";" , $liste_elements);
    if (1 == 1) { $larr_infos_elements = explode(";" , $liste_elements);
 
    $larr_infos_elements = explode(";" , $liste_elements);
     
    foreach ($larr_infos_elements as $linfos_element)
	  {
	   		//explode les infos d'un éléments
	   		//format nom/type
	   		$larr_infos = explode("/" , $linfos_element);
	   		if (in_array(strtolower(trim($larr_infos[0])), $larr_champ_valide))
	   		{
		   		//définition de l'objet champ et ajout dans la BD
		   		$lchamp = new champ();
		   		$lchamp->nomchamp = $larr_infos[0];
		   		$lchamp->numdoc = $lform->numdoc;
		   		
		   		$lchamp->rechercher();
		   		
		   		$lchamp->valeurdonnee = trim(strval($data[$larr_infos[0]])); //die($data[$larr_infos[0]]);
		   		if (! $lchamp->update_valeur()) die($lchamp->exception);

		   		$larr_numchamp[strtolower(trim($larr_infos[0]))] = $lchamp->numchamp;
		   		//libérer la mémoire
		   		unset($lchamp);
	   		}
	   }

     
	   //ajouter les données des champs
	   foreach ($larr_champ_valide as $lnom_champ)
	   {
		   $ldonnee = new Donnee();
		   $ldonnee->numchamp = $larr_numchamp[strtolower(trim($lnom_champ))];
		   $ldonnee->datemodif = date("d/m/Y");
		   $ldonnee->heuremodif = date("H:m:s");
		   $ldonnee->valeurdonnee = trim(strval($data[$lnom_champ]));
		   if ( ! $ldonnee->create()) die($ldonnee->exception);

		   unset($ldonnee);
	   }
	   
	   
   		$lretval = "
			<dt class=\"message\">Message</dt>

			<dd class=\"message message fade\">
				<ul>
					<li>".$translate["update_valid_success"]."</li>
				</ul>
			</dd>";
		
   		$state = "update_valid_success";

   }
   else
   {
   		$lretval = "
			<dt class=\"message\">Message</dt>

			<dd class=\"message message error\">
				<ul>
					<li>".$lcircuit->exception."</li>
				</ul>
			</dd>";
   		
   		$state = $lform->get_exception();
   		
   }
  
   
   
?>