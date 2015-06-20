<?php 
/** * @version			1.0 * @package			Mail * @subpackage		Mail * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés * @license			INTERFACE SA * @created		:	29 mars 2009 by patrick mveng * @author 			Patrick Mveng * @desc		:	script pour la fiche de consultation de l'historique d'envoi de mail * 					 * @creationdate	 * @updates */global $ginterface;

?>
  	<form action="<?php echo $siteweb->get_url()."/lot1/BO/fiche/abonne/abonne_search.php"; ?>" method="post" name="frm_send">
		<?php
			echo $result_recherche_log;
		?>
	</form>
