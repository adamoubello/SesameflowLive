<?php

/**
 * @version		1.0
 * @package		Utilisateur
 * @subpackage	Utilisateur
 * @copyright (C) 2009 INTERFACE SA. Tous droits r�serv�s
 * @license		INTERFACE SA
 * @author 		Bello
 * @desc		Script de traduction des libell�s du module Utilisateur en langue francaise
 * @updates
 * 	# samedi 20 juin 2009 (Patrick Mveng)
 * 		- suppression de ! dans l'instruction if (is_null($translate)) $translate = array();
 *   Cette derni�re r�initialisait le tablau et �crasait les libell�s existant en m�moire
 */
 
 global $translate;
 
 if (is_null($translate)) $translate = array();

    
	$translate["manager"]	=  htmlspecialchars("Chef de service?");
	$translate["donneesuser"]	=  htmlspecialchars("donn�es de l'utilisateur");
	$translate["detailsuser"]	=  htmlspecialchars("d�tails de l'utilisateur");
	
	$translate["recepteur"]	=  htmlspecialchars("r�cepteur");
    $translate["validateur"]	=  htmlspecialchars("validateur");
	$translate["emetteur"]	=  htmlspecialchars("�metteur");
	$translate["administrateur"]	=  htmlspecialchars("Administrateur");
	$translate["chefdep"]	=  htmlspecialchars("chef de service ?");

	$translate["info_bulle_gestion_utilisateur"]	=  htmlspecialchars("Rechercher ou afficher les informations sur les utilisateurs");
	$translate["modification_utilisateur"]	=  htmlspecialchars("Modification d'un utilisateur");
	$translate["utilisateur_update_success"]	=  "Modification effectu&eacute;e avec succ&egrave;s !";
	$translate["utilisateur_update_failure"]	=  "Echec modification";
	$translate["utilisateur_create_success"]	=  "Cr&eacute;ation effectu&eacute;e avec succ&egrave;s !";
	$translate["utilisateur_create_failure"]	=  "Echec cr&eacute;ation";
	$translate["creation_utilisateur"]	=  htmlspecialchars("cr�ation d'un utilisateur");
	
	$translate["recherche_utilisateur"]	=  htmlspecialchars("rechercher un utilisateur");
	$translate["parnom_utilisateur"]	=  htmlspecialchars("par nom");
	$translate["parprenom_utilisateur"]	=  htmlspecialchars("par pr�nom");
	$translate["parlogin_utilisateur"]	=  htmlspecialchars("par login");
	$translate["partype_utilisateur"]	=  htmlspecialchars("par type");
	$translate["supprimeuser"]	=  htmlspecialchars("supprim�?"); 
	$translate["resultat_utilisateur"]	=  htmlspecialchars("il n'y a aucun utilisateur !"); 
	$translate["catuser"]	=  htmlspecialchars("cat�gorie"); 
	$translate["accueil_user"]	=  htmlspecialchars("Accueil Utilisateur"); 
	$translate["any_accueil_user_found"]	=  htmlspecialchars("Aucune t�che assign�e � cet utilisateur");
		
?>