<?php

/**
 * @version		1.0
 * @package		Utilisateur
 * @subpackage	Profil
 * @copyright (C) 2009 INTERFACE SA. Tous droits réservés
 * @license		INTERFACE SA
 * @author 		Bello Adamou <moustaphbi@yahoo.fr>
 * @desc		Script de traduction des libellés du sous-module profil en langue francaise
 * @creationdate	20 Juillet 2009
 */
 
 global $translate;
 if ( is_null($translate)) $translate = array();

	$translate["creerprofil"]	=  htmlspecialchars("profile creation");
	$translate["moddonneesprofil"]	=  htmlspecialchars("update's profile");
	$translate["donneesprofil"]	=  htmlspecialchars("data of profile");
	
	$translate["info_bulle_gestion_profil"]	=  htmlspecialchars("search or display informations of profiles");
	$translate["modification_profil"]	=  htmlspecialchars("updating profile");
	$translate["profil_update_success"]	=  htmlspecialchars("succeeded updating !");
	$translate["profil_update_failure"]	= htmlspecialchars( "failure's updating");
	$translate["profil_create_success"]	=  htmlspecialchars("creation succeeded!");
	$translate["profil_create_failure"]	= htmlspecialchars( "failure creation");
	$translate["creation_profil"]	=  htmlspecialchars("creation of profile");	
	
	$translate["choisir"]	=  htmlspecialchars("choose");
	
	$translate["recherche_profil"]	=  htmlspecialchars("search a profile");
	$translate["btn_recherche_profil"]	=  htmlspecialchars("search");
	$translate["resultat_recherche_profil"]	=  htmlspecialchars("there is not profile");

?>