<?php 
/**
 * @version			1.0
 * @package			GED
 * @subpackage		Etiquette
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Patrick Mveng<patrick.mveng@interfacesa.local>
 * @desc			script de prétraitement pour la fabrication du nuage d'étiquette d'un document
 * 					Ce script est une boite noire réutilisable pour affiche une grille de documents
 * 
 * @param 			$listetag - tableau de documents issus de la recherche depuis la base de données
 * @param 			$translate - tableau de traductions dans la langue en cours
 * @param 			$do	- code de la page web en cours. Suivant la page web, le nombre de colonnes de la grille varie
 * 
 * @link 			Liste des documents associés à un document formulaire
 * 					Liste des documents crées par un utilisateur.
 * @creationdate	jeudi 17 juillet 2009
 * @updates
 */
?>
<?php
	ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	
	global $translate , $listetag;

	if(! is_null($listetag))
	{
		$nbr_tag = count($listetag);
	}
	else 
		{
			$result_recherche_tag = "<center>".ucfirst($translate["any_tag_found"])."</center>";
		}
?>