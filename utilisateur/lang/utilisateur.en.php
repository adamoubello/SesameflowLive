<?php

/**
 * @version		1.0
 * @package		Utilisateur
 * @subpackage	Utilisateur
 * @copyright (C) 2009 INTERFACE SA. Tous droits réservés
 * @license		INTERFACE SA
 * @author 		patrick mveng<patrick.mveng@interfacesa.local>
 * @desc		Script de traduction des libellés du module Utilisateur en langue anglaise
 * @updates
 */
 
 global $translate;
 
 if (is_null($translate)) $translate = array();

    
	$translate["manager"]	=  htmlspecialchars("chief department ?");
	$translate["donneesuser"]	=  htmlspecialchars("user data");
	$translate["detailsuser"]	=  htmlspecialchars("user detail");
	
	$translate["recepteur"]	=  htmlspecialchars("receiver");
    $translate["validateur"]	=  htmlspecialchars("validator");
	$translate["emetteur"]	=  htmlspecialchars("transmitter");
	$translate["administrateur"]	=  htmlspecialchars("Administrator");
	$translate["chefdep"]	=  htmlspecialchars("chief department ?");

	$translate["info_bulle_gestion_utilisateur"]	=  htmlspecialchars("search or display informations on users");
	$translate["modification_utilisateur"]	=  htmlspecialchars("user modification");
	$translate["utilisateur_update_success"]	= htmlspecialchars( "success update user !");
	$translate["utilisateur_update_failure"]	= htmlspecialchars( "failure update user");
	$translate["utilisateur_create_success"]	=  htmlspecialchars("success creation user !");
	$translate["utilisateur_create_failure"]	=  htmlspecialchars("failure creation user");
	$translate["creation_utilisateur"]	=  htmlspecialchars("user creation");
	
	$translate["recherche_utilisateur"]	=  htmlspecialchars("user search");
	$translate["parnom_utilisateur"]	=  htmlspecialchars("By first name");
	$translate["parprenom_utilisateur"]	=  htmlspecialchars("By second name");
	$translate["parlogin_utilisateur"]	=  htmlspecialchars("By login");
	$translate["partype_utilisateur"]	=  htmlspecialchars("By type");
	$translate["supprimeuser"]	=  htmlspecialchars("deleted?"); 
	$translate["resultat_utilisateur"]	=  htmlspecialchars("user result"); 
	$translate["catuser"]	=  htmlspecialchars("category"); 
		
?>