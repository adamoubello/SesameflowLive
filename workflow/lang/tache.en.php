<?php

/**
 * @version		1.0
 * @package		Workflow
 * @subpackage	Tache
 * @copyright (C) 2009 INTERFACE SA. Tous droits réservés
 * @license		INTERFACE SA
 * @author 		patrick mveng<patrick.mveng@interfacesa.local>
 * @desc		Script de traduction des libellés du sous-module tache en langue anglaise
 * @updates
 */
 
 global $translate;
 if ( is_null($translate)) $translate = array();

	$translate["creertache"]	=  htmlspecialchars("Create a task");
	$translate["moddonneestache"]	=  htmlspecialchars("Edit a task");
	$translate["donneestache"]	=  htmlspecialchars("données de la tache");
	
	$translate["info_bulle_gestion_tache"]	=  htmlspecialchars("Rechercher ou afficher les informations sur les taches");
	$translate["modification_tache"]	=  htmlspecialchars("Modification d'une tache");
	$translate["tache_update_success"]	=  "Modification effectu&eacute;e avec succ&egrave;s !";
	$translate["tache_update_failure"]	=  "Echec modification";
	$translate["tache_create_success"]	=  "Cr&eacute;ation effectu&eacute;e avec succ&egrave;s !";
	$translate["tache_create_failure"]	=  "Echec cr&eacute;ation";
	$translate["creation_tache"]	=  htmlspecialchars("création d'une tâche");	
	
	$translate["parametre_url"]	=  htmlspecialchars("URL parameters");
	$translate["processus_tache"]	=  htmlspecialchars("processus rattaché");
	$translate["choisir"]	=  htmlspecialchars("choose");
	
	$translate["recherche_tache"]	=  htmlspecialchars("Task search");
	$translate["btn_recherche_tache"]	=  htmlspecialchars("search");
	$translate["resultat_recherche_tache"]	=  htmlspecialchars("No task found");
	$translate["systeme"]	=  htmlspecialchars("system");
?>