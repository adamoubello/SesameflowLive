<?php
/**
 * @version			1.0
 * @package			MAIL
 * @subpackage		MAIL
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits r�serv�s
 * @license			INTERFACE SA
 * @author 			Raoul<ngambiaraoul@yahoo.fr>
 * @desc			Controlleur du module MAIL. Suivant la valeur du param�tre do, ce contr�lleur part
 * 					aiguiller le syst�me vers la page web ou le traitement sp�cifique
 * @creationdate	jeudi 23 juillet 2009
 * @updates
 * * 	# vendredi 24 juillet 2009 (Raoul Ngambia)
 * 		- cr�qtion  des fichiers de traitements tmail_search.php et tmail_result_search.php dans le case "mail_search"
 *   l'abscence de ce dernier emp�chait l'ex�cution du codes en question jusqu'au bout
 * 	# samedi 25 juillet 2009 by patrick mveng<patrick.mveng@interfacesa.local>
 * 		- int�gration du controle d'acc�s � une fonctionnalit�
 * 
 */

	session_start();
	$login = $_SESSION["login"];
	$_GET["login"] = $login;
    $_GET["rejeter"] = $rejeter;
    	
	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
	$data[$lkey] = $lvalue;
	}

	$do    = $data["do"];
	$lang  = $data["lang"];
	$login = $data["login"];
	$ajax  = (isset($data["ajax"])) ? (! is_null($data["ajax"])) ? $data["ajax"] : 0 : 0;	
	$code_mail = (isset($data["code_mail"])) ? (! is_null($data["code_mail"])) ? $data["code_mail"] : null : null;	
	$from  = $data["id"] ;	
	$rejeter = $data["rejeter"];
	
    //obtenir le s�parateur de dossier pour la OS en cours
    if (! defined("DS")) define( "DS", DIRECTORY_SEPARATOR );
    $chemin = dirname(__FILE__);
	$chemin = str_replace(DS."mail".DS."traitements","",$chemin);
	require_once($chemin.DS.'classe'.DS.'application.class.php');	
    $siteweb = new Application();

    //controle des permissions de l'utilisateur en cours
	//si pas de controle, il y aura redirection vers la page pr�c�dente.
	$siteweb->control_permission($login , $lang , $do , $ajax , $state);
     

switch (trim($do))
{   		
	case "mail_search":
		require_once($siteweb->get_document_root().DS."mail".DS."traitements".DS."tmail_search.php");
		require_once($siteweb->get_document_root().DS."mail".DS."traitements".DS."tmail_result_search.php");
		require_once($siteweb->get_document_root().DS."mail".DS."page".DS."mail_search.php");	
		break;	
		
	case "mail_select_dest":		
		if (trim($from) == "mail_view")
		{
		require_once($siteweb->get_document_root().DS."mail".DS."traitements".DS."tmail_create_valid.php");
		}		
		require_once($siteweb->get_document_root().DS."mail".DS."traitements".DS."tmail_select_dest.php");
		require_once($siteweb->get_document_root().DS."mail".DS."page".DS."mail_select_dest.php");	
		break;	
	
	case "mail_view":
		require_once($siteweb->get_document_root().DS."mail".DS."traitements".DS."tmail_view.php")		;
		require_once($siteweb->get_document_root().DS."mail".DS."page".DS."mail_view.php"); 
		break;		
			
	case "mail_send_valid" :
		require_once($siteweb->get_document_root().DS."mail".DS."traitements".DS."tmail_send_valid.php");
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "mail_select_dest" , "login" => $login) , true);
		break;
				
	case "mail_update_valid" :
		require_once($siteweb->get_document_root().DS."mail".DS."traitements".DS."tmail_update_valid.php");
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "mail_search" , "login" => $login , "state" => $state) , true);//mail_search A
		die();
		break;	
	
	case "mail_delete_valid" :
		require_once($siteweb->get_document_root().DS."mail".DS."traitements".DS."tmail_delete_valid.php");
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "mail_search" , "login" => $login , "state" => $state) , true);	
		break;
		
	case "mail_create" :
		require_once($siteweb->get_document_root().DS."mail".DS."traitements".DS."tmail_create.php");
		require_once($siteweb->get_document_root().DS."mail".DS."page".DS."mail_create.php");		
		break;
		
	case "mail_create_valid" :
		require_once($siteweb->get_document_root().DS."mail".DS."traitements".DS."tmail_create_valid.php");
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "mail_search" , "login" => $login , "state" => $state) , true);		
		break;
		
	case "mail_archive_valid":
		require_once($siteweb->get_document_root().DS."mail".DS."traitements".DS."tmail_archive_valid.php");
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "mail_search" , "login" => $login) , true);	
		break;
		
	case "mail_param" :
		require_once($siteweb->get_document_root().DS."mail".DS."traitements".DS."tmail_param.php");
		require_once($siteweb->get_document_root().DS."mail".DS."page".DS."mail_param.php");
		break;	
	
	case "mail_log":		
		require_once($siteweb->get_document_root().DS."mail".DS."traitements".DS."tmail_log.php");
		require_once($siteweb->get_document_root().DS."mail".DS."page".DS."mail_log.php");	
	    break;	
	
	case "mail_param_valid" :
		require_once($siteweb->get_document_root().DS."mail".DS."traitements".DS."tmail_param_update_valid.php");
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "mail_param" , "login" => $login) , true);
		break;
				
	case "doc_update_reject" :
    	//On oblige le user � entrer un motif de rejet,il cr�e donc un mail		
        require_once($siteweb->get_document_root().DS."mail".DS."traitements".DS."tmail_create.php");
		require_once($siteweb->get_document_root().DS."mail".DS."page".DS."mail_create.php");
		break;
		
	case "doc_update_reject_valid" :
		//on enregistre le mail automatiquement
		//require_once($siteweb->get_document_root().DS."mail".DS."traitements".DS."tmail_create_valid.php");			
		//On envoie le mail aux destinataires
		//require_once($siteweb->get_document_root().DS."mail".DS."traitements".DS."tmail_select_dest.php");
		//require_once($siteweb->get_document_root().DS."mail".DS."page".DS."mail_select_dest.php");	
		//On effectue le rejet proprement dit du document
		require_once($siteweb->get_document_root().DS."ged".DS."traitements".DS."tdoc_reject.php");
		if (intval($ajax) == 1) { die($lretval); }
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "accueil_user" , "login" => $login) , true);
		die();
		break;
			
	}
?>