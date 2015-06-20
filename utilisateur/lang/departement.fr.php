<?php

/**
 * @version		1.0
 * @package		Utilisateur
 * @subpackage	D�partement
 * @copyright (C) 2009 INTERFACE SA. Tous droits r�serv�s
 * @license		INTERFACE SA
 * @author 		Bello Adamou <moustaphbi@yahoo.fr>
 * @desc		Script de traduction des libell�s du sous-module d�partement en langue francaise
 * @creation    14 Juillet 2009
 */
 
 global $translate;
 if ( is_null($translate)) $translate = array();

	$translate["creerdep"]	=  htmlspecialchars("cr�er une dep");
	$translate["moddonneesdep"]	=  htmlspecialchars("modifier un service");
	$translate["donneesdep"]	=  htmlspecialchars("donn�es du service");
	
	$translate["info_bulle_gestion_dep"]	=  htmlspecialchars("Rechercher ou afficher les informations sur les services");
	$translate["modification_dep"]	=  htmlspecialchars("Modification d'un service");
	$translate["dep_update_success"]	=  "Modification effectu&eacute;e avec succ&egrave;s !";
	$translate["dep_update_failure"]	=  "Echec modification";
	$translate["dep_create_success"]	=  "Cr&eacute;ation effectu&eacute;e avec succ&egrave;s !";
	$translate["dep_create_failure"]	=  "Echec cr&eacute;ation";
	$translate["creation_dep"]	=  htmlspecialchars("cr�ation d'un service");	
	
	$translate["recherche_dep"]	=  htmlspecialchars("rechercher un service");
	$translate["btn_recherche_dep"]	=  htmlspecialchars("rechercher");
	$translate["resultat_recherche_dep"]	=  htmlspecialchars("il n'y a aucun service");
	
?>