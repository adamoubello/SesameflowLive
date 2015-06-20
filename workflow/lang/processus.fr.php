<?php

/**
 * @version		1.0
 * @package		Workflow
 * @subpackage	Processus
 * @copyright (C) 2009 INTERFACE SA. Tous droits réservés
 * @license		INTERFACE SA
 * @author 		Bello
 * @desc		Script de traduction des libellés du sous-module processus en langue francaise
 * @updates
 * 	# samedi 20 juin 2009 (Patrick Mveng)
 * 		- suppression de ! dans l'instruction if (is_null($translate)) $translate = array();
 *   Cette dernière réinitialisait le tablau et écrasait les libellés existant en mémoire
 */
 
 global $translate;
 if ( is_null($translate)) $translate = array();

    $translate["creerprocessus"]	=  htmlspecialchars("créer une procédure d'entreprise");
	$translate["moddonneesprocessus"]	=  htmlspecialchars("modifier une procédure d'entreprise");
	$translate["donneesprocessus"]	=  htmlspecialchars("données du processus");
	
	$translate["info_bulle_gestion_processus"]	=  htmlspecialchars("rechercher ou afficher les informations sur les procédures d'entreprise");
	$translate["modification_processus"]	=  htmlspecialchars("modification d'une procédure d'entreprise");
	$translate["processus_update_success"]	=  "Modification effectu&eacute;e avec succ&egrave;s !";
	$translate["processus_update_failure"]	=  "Echec modification";
	$translate["processus_create_success"]	=  "Cr&eacute;ation effectu&eacute;e avec succ&egrave;s !";
	$translate["processus_create_failure"]	=  "Echec cr&eacute;ation";
	$translate["creation_processus"]	=  htmlspecialchars("création d'une procédure d'entreprise");
	
	$translate["rechercher_processus"]	=  htmlspecialchars("rechercher une procédure d'entreprise");
	$translate["resultat_recherche_processus"]	=  htmlspecialchars("il n'y a aucune procédure d'entreprise");
	
	$translate["pleaz_saisir_libprocessus"]	=  htmlspecialchars("Veuillez saisir le libellé de la procédure d'entreprise");
?>