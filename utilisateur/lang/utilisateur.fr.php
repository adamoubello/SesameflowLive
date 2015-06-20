<?php

/**
 * @version		1.0
 * @package		Utilisateur
 * @subpackage	Utilisateur
 * @copyright (C) 2009 INTERFACE SA. Tous droits réservés
 * @license		INTERFACE SA
 * @author 		Bello
 * @desc		Script de traduction des libellés du module Utilisateur en langue francaise
 * @updates
 * 	# samedi 20 juin 2009 (Patrick Mveng)
 * 		- suppression de ! dans l'instruction if (is_null($translate)) $translate = array();
 *   Cette dernière réinitialisait le tablau et écrasait les libellés existant en mémoire
 */
 
 global $translate;
 
 if (is_null($translate)) $translate = array();

    
	$translate["manager"]	=  htmlspecialchars("Chef de service?");
	$translate["donneesuser"]	=  htmlspecialchars("données de l'utilisateur");
	$translate["detailsuser"]	=  htmlspecialchars("détails de l'utilisateur");
	
	$translate["recepteur"]	=  htmlspecialchars("récepteur");
    $translate["validateur"]	=  htmlspecialchars("validateur");
	$translate["emetteur"]	=  htmlspecialchars("émetteur");
	$translate["administrateur"]	=  htmlspecialchars("Administrateur");
	$translate["chefdep"]	=  htmlspecialchars("chef de service ?");

	$translate["info_bulle_gestion_utilisateur"]	=  htmlspecialchars("Rechercher ou afficher les informations sur les utilisateurs");
	$translate["modification_utilisateur"]	=  htmlspecialchars("Modification d'un utilisateur");
	$translate["utilisateur_update_success"]	=  "Modification effectu&eacute;e avec succ&egrave;s !";
	$translate["utilisateur_update_failure"]	=  "Echec modification";
	$translate["utilisateur_create_success"]	=  "Cr&eacute;ation effectu&eacute;e avec succ&egrave;s !";
	$translate["utilisateur_create_failure"]	=  "Echec cr&eacute;ation";
	$translate["creation_utilisateur"]	=  htmlspecialchars("création d'un utilisateur");
	
	$translate["recherche_utilisateur"]	=  htmlspecialchars("rechercher un utilisateur");
	$translate["parnom_utilisateur"]	=  htmlspecialchars("par nom");
	$translate["parprenom_utilisateur"]	=  htmlspecialchars("par prénom");
	$translate["parlogin_utilisateur"]	=  htmlspecialchars("par login");
	$translate["partype_utilisateur"]	=  htmlspecialchars("par type");
	$translate["supprimeuser"]	=  htmlspecialchars("supprimé?"); 
	$translate["resultat_utilisateur"]	=  htmlspecialchars("il n'y a aucun utilisateur !"); 
	$translate["catuser"]	=  htmlspecialchars("catégorie"); 
	$translate["accueil_user"]	=  htmlspecialchars("Accueil Utilisateur"); 
	$translate["any_accueil_user_found"]	=  htmlspecialchars("Aucune tâche assignée à cet utilisateur");
		
?>