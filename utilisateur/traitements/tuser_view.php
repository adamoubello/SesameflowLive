<?php
/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Utilisateur
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou<moustaphbi@yahoo.fr> 
 * @desc			script pour l'affichage de la page de consultation d'une tâche
 * @creationdate	????
 */
	
	        $data = $_POST;
			foreach ($_GET as $lkey => $lvalue)
			{
			$data[$lkey] = $lvalue;
			}
				
		  //Chargements	
		  require_once($siteweb->get_document_root()."\classe\application.class.php");
		  require_once($siteweb->get_document_root()."\utilisateur\classe\utilisateur.class.php");
		  require_once($siteweb->get_document_root()."/includes/pear/Structures/DataGrid/Renderer/HTMLTable.php");   
		  require_once ($siteweb->get_document_root()."/includes/pear/Structures/DataGrid.php");
		  //require_once ("HTML/Table.php");
		  
		  ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	
		  
		  $user = new utilisateur ();
		  
			foreach ($data as $lindex => $lvaleur )
			{
				$user->$lindex = $lvaleur;
			}
			 
		  if (! $user->charger()) die($user->exception);	
			  
		//avoir la liste des profil du système
		require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."profi.class.php");
	    $lprofil= new profil ();
	   	$lprofil->listeprofil = $lprofil->rechercher();
		$select_profil = $lprofil->liste_deroulante(array("id" => "codeprofil" , "name" => "codeprofil") , $user->codeprofil , ucfirst($translate["choisissez"]));	   	
   	
	    //avoir la liste des groupes du système
		require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."groupe.class.php");
	    $lgroupe= new groupe ();
	    $lgroupe->listegroupe = $lgroupe->rechercher();
	    if ($lgroupe->has_exception())
	    die($lgroupe->exception);
		$select_groupe = $lgroupe->liste_deroulante(array("id" => "codegroup" , "name" => "codegroup") , $user->codegroup , ucfirst($translate["choisissez"]));

		//seul un compte super administrateur peut changer le group d'un utilisateur.
		//sinon, il y aura un défaut de sécurité dans l'application 
		if (intval($_SESSION["is_superadmin"]) != 1)
		{
			//rechercher le libellé du code groupe en cours
			foreach($lgroupe->listegroupe as $obj)
			{
				if (trim($obj["libgroup"]) != "")
				{
					if ((trim(strval($user->codegroup)) == trim(strval($obj['codegroup'])) ))
					{
						$llibgroup = str_replace('\\' , "" , $obj["libgroup"] );
					}
				}
			}
			$select_groupe = ucfirst($llibgroup)."<input type=\"hidden\" name=\"codegroup\" id=\"codegroup\" value=\"".$user->codegroup."\"  />";
		}
   	
		//avoir la liste des départements du système 
		require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."departement.class.php"); 
	    $ldep = new departement(); 
	   	$ldep->listedep = $ldep->rechercher();
	   	if ($ldep->has_exception()) die($ldep->exception);
		$select_departement = $ldep->liste_deroulante(array("id" => "codedep" , "name" => "codedep") , $user->codedep , ucfirst($translate["choisissez"]));	   	
   	
		global $siteweb , $user;
   		   
   		   //libérer la mémoire
   		   unset($lprofil);
   		   unset($lgroupe);
   		   unset($ldep);
				  	  
     ?> 