<?php

/**
 * @version			1.0
 * @package			Administration
 * @subpackage		Template
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou <moustaphbi@yahoo.fr>  
 * @desc			Controlleur général de l'application. Suivant la valeur du paramètre page, ce contrôlleur va aiguiller
 * 					vers le contrôlleur du module sollicité la page web ou le traitement spécifique
 * @creationdate	????
 * @updates
 * 	# samedi 20 juin 2009 (Patrick Mveng<patrick.mveng@interfacesa.local>)
 * 		- Substitution de formulaire_search par doc_search dans le page gabarit. Voici les codes de pages  dans le module GED 
			a.	doc_search
			b.	doc_view
			c.	doc_delete
			d.	doc_create
			e.	doc_update
			Chacun de ces codes de page sera accompagné du paramètre typedoc qui définit le type de document associé à doc_view,
			doc_delete, doc_create, doc_update.
 * @updates
 * 	# vendredi 24 juillet 2009 (Raoul Ngambia)
 * 		- ajout du block de "case" permettant de selectionner l'acces au mail dans le menu_droite du module MAIL
 *   l'abscence de ce dernier empéchait l'affichage du lien "mail" dans la partie principale
 * 
 *  #jeudi 30 juillet 2009 by patrick mveng<patrick.mveng@interfacesa.local>
 * 		en cas de doc_create, appel du controleur du module workflow au lieu de celui du module GED
 */

   	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
	$data[$lkey] = $lvalue;
	}
  
  $do = $data["do"];

  switch (trim($do))
  {
    case "user_search":
	case "user_create" :
	case "search_user" :
	case "user_view":
	case "user_update":
	case "user_delete":
	case "groupe_search":
	case "groupe_create" :
	case "groupe_view":
	case "groupe_update_valid":
	case "groupe_delete_valid":		
	case "dep_search":
	case "dep_create" :
	case "dep_view":
	case "profi_search":
	case "profi_create" :
	case "profi_view":
	case "profi_update":
	case "profi_delete":
	require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."partie_centrale.php");	
	  break;
    
	case "tache_search":
	case "tache_create" :
	case "tache_admin_view" :
	case "tache_view_user" :
	case "tache_view":
	case "tache_update":
	case "processus_search":
	case "processus_create" :
	case "processus_admin_view" :
	case "processus_view_user" :
	case "search_processus" :
	case "processus_view":
	case "processus_update":
	case "workflow_search":
	case "workflow_create" :
	case "workflow_admin_view" :
	case "workflow_view_user" :
	case "workflow_view":
	case "workflow_update":
    case "circuit_search":		
	case "cir_create1" :
	case "cir_create2" :
	case "circuit_view":		
	case "doc_create":
	case "doc_create_valid":		
	case "accueil_user":
	require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."partie_centrale.php");
	   break;	
	  
	case "droa_search":
	case "droa_create" :
	case "droa_view":
	case "config_view":
	case "paie_param":
	case "rh_param":
	require_once($siteweb->get_document_root().DS."administration".DS."traitements".DS."partie_centrale.php");	
	  break;
	  
	case "doc_search":
	case "doc_view":
	require_once($siteweb->get_document_root().DS."ged".DS."traitements".DS."partie_centrale.php");
	  break;
	  
	case "mail_search":
	case "mail_view":
	case "mail_create":
	case "mail_select_dest":
	case "mail_param" :
	case "mail_log" :
	case "doc_update_reject":
	case "doc_update_reject_valid":		
	require_once($siteweb->get_document_root().DS."mail".DS."traitements".DS."controleur.php");
	  break;
	  
	case "accueil" :
		break;  
	  
	default :
	?>	 
	<h2>Error</h2>
    <br>
   
    You requested a page that does not exists.

    <br>
    You come from <?php echo $_SERVER["HTTP_REFERER"]; ?>

    <hr>
	<?php	
		break;
	  
  }

?>