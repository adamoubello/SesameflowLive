 			<?php
			/**
			 * @version			1.0
			 * @package			Administrateur
			 * @subpackage		Configuration
			 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
			 * @license			INTERFACE SA
			 * @author 			Xaverie télédzina <onana_carine@yahoo.fr>
			 * @desc			Script pour les modifications des paramètres d'un module
			 * @param 			
			 * @creationdate	03 août 2009
			 * @updates
			 */
			
	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
		$data[$lkey] = $lvalue;
	}
	$numchamp = $data["numchamp"];
	$nomchamp = $data["nomchamp"];
	$typechamp = $data["typechamp"];
	$codemod = $data["codemod"];
	$valeurdonnee = $data["valeurdonnee"];
	
	$ajax = (isset($data["ajax"])) ? (! is_null($data["ajax"])) ? $data["ajax"] : 0 : 1;
	$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
	$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	$codemod = (isset($data["codemod"])) ? (! is_null($data["codemod"])) ? $data["codemod"] : null : null;
	$liste_elements = (isset($data["liste_elements"])) ? (! is_null($data["liste_elements"])) ? $data["liste_elements"] : "" : "";
	
	//obtenir le séparateur de dossier pour la OS en cours
	if (! defined("DS")) 
		define("DS" , DIRECTORY_SEPARATOR);

    $chemin = dirname(__FILE__);
	$chemin = str_replace(DS."administration".DS."traitements","",$chemin);
	require_once($chemin.DS."classe".DS."application.class.php");
	$siteweb = new Application();

   //chargement des spécifications de la classe module
   require_once($siteweb->get_document_root().DS."administration".DS."classe".DS."module.class.php");

   //instancier un objet module
   $lmodule = new Module();
   //Créer automatiquement les attributs sur l'objet
   
   foreach ($data as $lattribut => $lvaleur)
   { 
   		$lmodule->$lattribut = $lvaleur;
   		
   }
   $larr_infos_elements = explode(";" , $liste_elements);

    //chargement de PEAR
  ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS."pear");	//charger les packages de PEAR::MDB2
  
  $lmodule->codemod = $codemod;
  
  switch (trim($codemod))
  {
  	case "paie" : $lmodule->libmod = "SESAME PAIE"; break;
  	case "rh" : $lmodule->libmod = "SESAME RH"; break;
  }

  //interf&rence entre typebd depuis l'interface et typebd de la classe table
  //charger table->typebd...
	$lmodule->init();
  
  if ($lmodule->existe())
	  {
	  	if (! $lmodule->modifier()) die($lmodule->exception());
	  }
	  else 
	  {
	  		if ($lmodule->has_exception()) die($lmodule->get_exception());
		   //enregistrer le module
		   if (! $lmodule->ajouter())
			die($lmodule->get_exception());
	  }
  
   /**
	    * *une page web formulaire contient de nombreux éléments qui ne sont pas des champs d'un formulaire
	    * pour chaque type de document formulaire, on définit la liste des champs valides
	    * Et seuls ces champs seront enregistrées dans la BD
	    */

	   switch(trim($codemod))
	   {
	   		case "rh" :
	   			$larr_champ_valide = array("typebd" , "hotebd", "userbd" , "nombd" , "pwdbd");
	   			break;
	   		case "paie" :
	   			$larr_champ_valide = array("typebd" , "hotebd", "userbd" , "nombd" , "pwdbd");
	   			break;
	   }
	   
	   //supprimer toute la configuration du module en cours
	   $lmodule->codemod = trim($codemod);
	   if (!$lmodule->supprimer_param()) die($lmodule->get_exception());

        //liste des numéro de champ générés
	   $larr_numchamp = array();
	   foreach ($larr_infos_elements as $linfos_element)
	   {
	   		//explode les infos d'un éléments
	   		//format nom/type
	   		$larr_infos = explode("/" , $linfos_element);
	   		if (in_array(strtolower(trim($larr_infos[0])), $larr_champ_valide))
	   		{
		   		//définition de l'objet champ et ajout dans la BD
		   		$lchamp = new Module();
		   		$lchamp->numchamp = $lchamp->generer_numero_param();
		   		$lchamp->nomchamp = $larr_infos[0];
		   		$lchamp->typechamp = $larr_infos[1];
		   		$lchamp->codemod = $lmodule->codemod;
		   		$lchamp->valeurdonnee = trim(strval($data[$larr_infos[0]])); //die($data[$larr_infos[0]]);
		   		
		   		
		   		if ($lchamp->existe_param(trim($larr_infos[0])))
		   		{
		   			//existe_param() retourne le numéro du champ 
		   			if (! $lchamp->modifier_param()) die($lchamp->exception);
		   		}
				else if ($lchamp->has_exception()) die($lchamp->exception);
				else if (! $lchamp->ajouter_param()) die($lchamp->exception);
		   		
		   		//$larr_numchamp[strtolower(trim($larr_infos[0]))] = $lchamp->numchamp;
		   		//libérer la mémoire
		   		unset($lchamp);
	   		}
	   }

	 require_once($siteweb->get_document_root().DS.'lang'.DS.'application.'.$lang.'.php');	

	$state = "insert_valid_success";
	$lretval = "
			<dt class=\"message\">Message</dt>

			<dd class=\"message message fade\">
				<ul>
					<li>".$translate["update_valid_success"]."</li>
				</ul>
			</dd>";

	if (intval($ajax == 1))
	{
		die($lretval);
	}
   
?>