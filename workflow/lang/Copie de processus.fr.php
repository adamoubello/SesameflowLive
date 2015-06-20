<?php

/**
 * @version		1.0
 * @package		Workflow
 * @subpackage	Processus
 * @copyright (C) 2009 INTERFACE SA. Tous droits r�serv�s
 * @license		INTERFACE SA
 * @author 		Bello
 * @desc		Script de traduction des libell�s du sous-module processus en langue francaise
 * @updates
 * 	# samedi 20 juin 2009 (Patrick Mveng)
 * 		- suppression de ! dans l'instruction if (is_null($translate)) $translate = array();
 *   Cette derni�re r�initialisait le tablau et �crasait les libell�s existant en m�moire
 */
 
 global $translate;
 if ( is_null($translate)) $translate = array();

    $translate["creerprocessus"]	=  htmlspecialchars("cr�er un processus");
	$translate["moddonneesprocessus"]	=  htmlspecialchars("modifier un processus");
	$translate["donneesprocessus"]	=  htmlspecialchars("donn�es du processus");
	
	$translate["info_bulle_gestion_processus"]	=  htmlspecialchars("rechercher ou afficher les informations sur les processuss");
	$translate["modification_processus"]	=  htmlspecialchars("modification d'une processus");
	$translate["processus_update_success"]	=  "Modification effectu&eacute;e avec succ&egrave;s !";
	$translate["processus_update_failure"]	=  "Echec modification";
	$translate["processus_create_success"]	=  "Cr&eacute;ation effectu&eacute;e avec succ&egrave;s !";
	$translate["processus_create_failure"]	=  "Echec cr&eacute;ation";
	$translate["creation_processus"]	=  htmlspecialchars("cr�ation d'une processus");
	
	$translate["rechercher_processus"]	=  htmlspecialchars("rechercher un processus");
	$translate["resultat_recherche_processus"]	=  htmlspecialchars("il n'y a aucun processus");
	
	$translate["pleaz_saisir_libprocessus"]	=  htmlspecialchars("Veuillez saisir le libell� du processus");
?>