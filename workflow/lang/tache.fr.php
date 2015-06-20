<?php

/**
 * @version		1.0
 * @package		Workflow
 * @subpackage	Tache
 * @copyright (C) 2009 INTERFACE SA. Tous droits réservés
 * @license		INTERFACE SA
 * @author 		Bello
 * @desc		Script de traduction des libellés du sous-module tache en langue francaise
 * @updates
 * 	# samedi 20 juin 2009 (Patrick Mveng)
 * 		- suppression de ! dans l'instruction if (is_null($translate)) $translate = array();
 *   Cette dernière réinitialisait le tablau et écrasait les libellés existant en mémoire
 */
 
 global $translate;
 if ( is_null($translate)) $translate = array();

	$translate["creertache"]	=  htmlspecialchars("créer une tache");
	$translate["moddonneestache"]	=  htmlspecialchars("modifier une tache");
	$translate["donneestache"]	=  htmlspecialchars("données de la tache");
	
	$translate["info_bulle_gestion_tache"]	=  htmlspecialchars("Rechercher ou afficher les informations sur les taches");
	$translate["modification_tache"]	=  htmlspecialchars("Modification d'une tache");
	$translate["tache_update_success"]	=  "Modification effectu&eacute;e avec succ&egrave;s !";
	$translate["tache_update_failure"]	=  "Echec modification";
	$translate["tache_create_success"]	=  "Cr&eacute;ation effectu&eacute;e avec succ&egrave;s !";
	$translate["tache_create_failure"]	=  "Echec cr&eacute;ation";
	$translate["creation_tache"]	=  htmlspecialchars("création d'une tâche");	
	
	$translate["parametre_url"]	=  htmlspecialchars("Paramètres URL");
	$translate["processus_tache"]	=  htmlspecialchars("processus rattaché");
	$translate["choisir"]	=  htmlspecialchars("choisir");
	
	$translate["recherche_tache"]	=  htmlspecialchars("rechercher une tache");
	$translate["btn_recherche_tache"]	=  htmlspecialchars("rechercher");
	$translate["resultat_recherche_tache"]	=  htmlspecialchars("il n'y a aucune tâche");
	$translate["systeme"]	=  htmlspecialchars("système");
?>