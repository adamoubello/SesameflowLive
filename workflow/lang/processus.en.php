<?php

/**
 * @version		1.0
 * @package		Workflow
 * @subpackage	Processus
 * @copyright (C) 2009 INTERFACE SA. Tous droits réservés
 * @license		INTERFACE SA
 * @author 		patrick mveng<patrick.mveng@interfacesa.local>
 * @desc		Script de traduction des libellés du sous-module processus en langue anglaise
 * @updates
 */
 
 global $translate;
 if ( is_null($translate)) $translate = array();

    $translate["creerprocessus"]	=  htmlspecialchars("créer un processus");
	$translate["moddonneesprocessus"]	=  htmlspecialchars("edit a process");
	$translate["donneesprocessus"]	=  htmlspecialchars("données du processus");
	
	$translate["info_bulle_gestion_processus"]	=  htmlspecialchars("rechercher ou afficher les informations sur les processuss");
	$translate["modification_processus"]	=  htmlspecialchars("modification d'une processus");
	$translate["processus_update_success"]	=  "Modification effectu&eacute;e avec succ&egrave;s !";
	$translate["processus_update_failure"]	=  "Echec modification";
	$translate["processus_create_success"]	=  "Cr&eacute;ation effectu&eacute;e avec succ&egrave;s !";
	$translate["processus_create_failure"]	=  "Echec cr&eacute;ation";
	$translate["creation_processus"]	=  htmlspecialchars("process creation");
	
	$translate["rechercher_processus"]	=  htmlspecialchars("search a process");
	$translate["resultat_recherche_processus"]	=  htmlspecialchars("No process exists");
	
	$translate["pleaz_saisir_libprocessus"]	=  htmlspecialchars("Veuillez saisir le libellé du processus");
?>