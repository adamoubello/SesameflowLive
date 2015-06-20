<?php
/**
 * @version		1.0
 * @package		Administration
 * @subpackage	Droit d'acc�s
 * @copyright (C) 2009 INTERFACE SA. Tous droits r�serv�s
 * @license		INTERFACE SA
 * @author 		Bello
 * @desc		Script de traduction des libell�s du sous-module droit d'acc�s en langue francaise
 * @updates
 * 	# samedi 20 juin 2009 (Patrick Mveng)
 * 		- suppression de ! dans l'instruction if (is_null($translate)) $translate = array();
 *   Cette derni�re r�initialisait le tablau et �crasait les libell�s existant en m�moire
 */

global $translate;
 if (is_null($translate)) $translate = array();

    $translate["niveau_droit"]	=  htmlspecialchars("par niveau d'acc�s");
	$translate["donnees_droit"]	=  htmlspecialchars("donn�es du droit d'acc�s");
	 
	$translate["info_bulle_gestion_droit"]	=  htmlspecialchars("Rechercher ou afficher les informations sur les droits d'utilisateurs");
	$translate["modification_droit"]	=  htmlspecialchars("Modification d'un droit");
	$translate["droit_update_success"]	=  "Modification effectu&eacute;e avec succ&egrave;s !";
	$translate["droit_update_failure"]	=  "Echec modification";
	$translate["droit_create_success"]	=  "Cr&eacute;ation effectu&eacute;e avec succ&egrave;s !";
	$translate["droit_create_failure"]	=  "Echec cr&eacute;ation";
	$translate["creation_droit"]	=  htmlspecialchars("cr�ation d'un droit");
	$translate["recherche_droit"]	=  htmlspecialchars("rechercher un droit");
	$translate["niveau_acces_droit"]	=  htmlspecialchars("niveau d'acc�s");
	$translate["resultat_droit"]	=  htmlspecialchars("il n'y a aucun droit !!");

?>