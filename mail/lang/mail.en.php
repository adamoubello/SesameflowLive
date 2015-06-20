<?php

/**
 * @version		1.0
 * @package		Mail
 * @subpackage	I18N
 * @copyright (C) 2009 INTERFACE SA. Tous droits réservés
 * @license		INTERFACE SA
 * @author 		Ngambia Raoul<ngambiaraoul@yahoo.fr>
 * @desc		Script de traduction des libellés du module Mail en langue anglaise
 * @updates
 */
 
 global $translate;
 
 if (is_null($translate)) $translate = array();

	$translate["archives"]	=  htmlspecialchars("archives");   
	$translate["any_mail_found"]	=  htmlspecialchars("There is no mail found for you");
	$translate["any_log_found"]     =  htmlspecialchars(" Historique is empty !");
	$translate["historique"]	=  htmlspecialchars("log");
	
	$translate["body"]	=  htmlspecialchars("body"); 	
	
	$translate["mail"]	=  htmlspecialchars("mail");
	
	$translate["detailmail"]	=  htmlspecialchars("détails de l'utilisateur");
	$translate["destinataire"]	=  htmlspecialchars("receiver");
	
	$translate["envoyer"]	=  htmlspecialchars("send");	
	$translate["envoye"]	=  htmlspecialchars("send");	
	
	$translate['Filtre_Recherche']      =  htmlspecialchars("Search Filter");	
	$translate["format_envoi"]	=  htmlspecialchars("Format");
	$translate["func_mail_php"]	=  htmlspecialchars("PHP mail function");

	$translate["read"]	=  htmlspecialchars("read");
	$translate["recepteur"]	=  htmlspecialchars("récepteur");
    $translate["validateur"]	=  htmlspecialchars("validateur");
	$translate["emetteur"]	=  htmlspecialchars("émetteur");

	$translate["info_bulle_gestion_mail"]	=  htmlspecialchars("Rechercher ou afficher les informations sur les mails");
	$translate["modification_mail"]	=  htmlspecialchars("Modification d'un mail");
	$translate["mail_update_success"]	=  "Modification effectu&eacute;e avec succ&egrave;s !";
	$translate["mail_update_failure"]	=  "Echec modification";
	$translate["mail_create_success"]	=  "Cr&eacute;ation effectu&eacute;e avec succ&egrave;s !";
	$translate["mail_create_failure"]	=  "Echec cr&eacute;ation";
	$translate["mail_log"]	=  htmlspecialchars("Log");
	
	$translate["creation_mail"]	=  htmlspecialchars("création d'un mail");
	$translate["non_envoye"]	=  htmlspecialchars("unsend");
	
	$translate["parnom_utilisateur"]	=  htmlspecialchars("par nom");
	$translate["parprenom_utilisateur"]	=  htmlspecialchars("par prénom");
	$translate["parlogin_utilisateur"]	=  htmlspecialchars("par login");
	
	$translate["send_en_html"]	=  htmlspecialchars("HTML Format"); 
	$translate["sendmail"]	=  htmlspecialchars("sendmail"); 
	$translate["serveur_smtp"]	=  htmlspecialchars("SMTP Server"); 
			
	$translate["serveur_de_mail"]	=  htmlspecialchars("Mail server"); 
	$translate["adresse_expéditeur"]	=  htmlspecialchars("Sender's adress"); 
	$translate["nom_expéditeur"]	=  htmlspecialchars("Sender's Name"); 
	$translate["chemin_accès_sendmail"]	=  htmlspecialchars("Path of sendmail"); 
    $translate["identification_SMTP_requise"]	=   htmlspecialchars("SMTP Identification required"); 
	$translate["utilisateur_SMTP"]	=  htmlspecialchars("SMTP User"); 
	$translate["mot_de_passe_SMTP"]	=  htmlspecialchars("SMTP Password"); 
	$translate["hôte_SMTP"]	=  htmlspecialchars("SMTP Host"); 
		   	
	$translate["sujet"]	=  htmlspecialchars("subject"); 	
	$translate["supprimemail"]	=  htmlspecialchars("supprimé?"); 
	
	$translate["texte"]	=  htmlspecialchars("text"); 	

	$translate["unread"]	=  htmlspecialchars("unread"); 	
	
	$translate["recherche_dest"]	=  htmlspecialchars("Receiver search"); 	
	$translate["resultat_mail"]	=  htmlspecialchars("il n'y a aucun mail !"); 
	$translate["lib_reglages_email"]=  htmlspecialchars("Mail settings");
	$translate["lib_mail_search"] = htmlspecialchars("Mail search");
	
	$translate["par_sujet"] = htmlspecialchars("subject");
 	$translate["par_corps"] = htmlspecialchars("body");
 	$translate["par_date_creation"] = htmlspecialchars("Creation Date");
 	$translate["par_date_modif"] = htmlspecialchars("Modification Date");
 	$translate["par_archive"] = htmlspecialchars("archived");
 	$translate["par_auteur"] = htmlspecialchars("Author");
 	$translate["par_etat"] = htmlspecialchars("Mail status"); 
 	$translate['par_tag'] = htmlspecialchars("Tag");
		
	
		
?>