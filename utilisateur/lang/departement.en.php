<?php

/**
 * @version		1.0
 * @package		Utilisateur
 * @subpackage	Département
 * @copyright (C) 2009 INTERFACE SA. Tous droits réservés
 * @license		INTERFACE SA
 * @author 		Bello Adamou <moustaphbi@yahoo.fr>
 * @desc		Script de traduction des libellés du sous-module département en langue francaise
 * @creation    14 Juillet 2009
 */
 
 global $translate;
 if ( is_null($translate)) $translate = array();

	$translate["creerdep"]	=  htmlspecialchars("create a department");
	$translate["moddonneesdep"]	=  htmlspecialchars("update a department");
	$translate["donneesdep"]	=  htmlspecialchars("data of department");
	
	$translate["info_bulle_gestion_dep"]	=  htmlspecialchars("search or display informations of department");
	$translate["modification_dep"]	=  htmlspecialchars("updating department");
	$translate["dep_update_success"]	=  htmlspecialchars("succeeded updating!");
	$translate["dep_update_failure"]	=  htmlspecialchars( "failure's update");
	$translate["dep_create_success"]	=   htmlspecialchars("creation succeeded !");
	$translate["dep_create_failure"]	=  htmlspecialchars( "failure's creation");
	$translate["creation_dep"]	=  htmlspecialchars("creation of department");	
	
	$translate["recherche_dep"]	=  htmlspecialchars("search department");
	$translate["btn_recherche_dep"]	=  htmlspecialchars("search");
	$translate["resultat_recherche_dep"]	=  htmlspecialchars("there is not department");
	
?>