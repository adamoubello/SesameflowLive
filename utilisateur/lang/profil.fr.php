<?php

/**
 * @version		1.0
 * @package		Utilisateur
 * @subpackage	Profil
 * @copyright (C) 2009 INTERFACE SA. Tous droits r�serv�s
 * @license		INTERFACE SA
 * @author 		Bello Adamou <moustaphbi@yahoo.fr>
 * @desc		Script de traduction des libell�s du sous-module profil en langue francaise
 * @creationdate	20 Juillet 2009
 */
 
 global $translate;
 if ( is_null($translate)) $translate = array();

	$translate["creerprofil"]	=  htmlspecialchars("cr�er une fonction");
	$translate["moddonneesprofil"]	=  htmlspecialchars("modifier une fonction");
	$translate["donneesprofil"]	=  htmlspecialchars("donn�es d'une fonction");
	
	$translate["info_bulle_gestion_profil"]	=  htmlspecialchars("Rechercher ou afficher les informations sur les fonctions");
	$translate["modification_profil"]	=  htmlspecialchars("Modification d'une fonction");
	$translate["profil_update_success"]	=  "Modification effectu&eacute;e avec succ&egrave;s !";
	$translate["profil_update_failure"]	=  "Echec modification";
	$translate["profil_create_success"]	=  "Cr&eacute;ation effectu&eacute;e avec succ&egrave;s !";
	$translate["profil_create_failure"]	=  "Echec cr&eacute;ation";
	$translate["creation_profil"]	=  htmlspecialchars("cr�ation d'une fonction");	
	
	$translate["choisir"]	=  htmlspecialchars("choisir");
	
	$translate["recherche_profil"]	=  htmlspecialchars("rechercher une fonction");
	$translate["btn_recherche_profil"]	=  htmlspecialchars("rechercher");
	$translate["resultat_recherche_profil"]	=  htmlspecialchars("il n'y a aucune fonction");

?>