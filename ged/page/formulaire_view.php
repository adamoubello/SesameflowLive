<?php
/**
 * @version			1.0
 * @package			GED
 * @subpackage		Document
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			William<william.nkingne@laposte.net>
 * @desc			script pour la visualisation des données d'un document formulaire
 * @creationdate	mardi 30 juin 2009
 * @updates 
 */
 ?>
<?php 
   	
	switch (trim(strtolower($typedoc)))
	{   
		case "dde_credit" : 
			require_once($siteweb->get_document_root().DS."ged".DS."page".DS."dde_credit_view.php");			
			break;
		case "dde_conge" :
		    //die("Point de pénalty !!!");
		    require_once($siteweb->get_document_root().DS."ged".DS."page".DS."dde_conge_view.php");
			break;
		case "dde_achat" : 
			require_once($siteweb->get_document_root().DS."ged".DS."page".DS."dde_achat_view.php");		
			break;
		default:
		    //die("kitoko na yo bijou ya tallo !!!");
			break;
	}
		
?>
<script type="text/javascript" src="<?php echo $siteweb->get_url();?>/includes/tabpane/js/tabpane.js"></script>
<!--<link type="text/css" rel="StyleSheet" href="<?php echo $siteweb->get_url();?>/includes/tabpane/css/tab.webfx.css" />-->
<link type="text/css" rel="StyleSheet" href="<?php echo $siteweb->get_url();?>/includes/tabpane/css/luna/tab.css" />
	<div class="tab-pane" id="tabPane1">

	<script type="text/javascript">
		tp1 = new WebFXTabPane( document.getElementById( "tabPane1" ) );
	</script>
		
		<div class="tab-page" id="tabPage2">
			<h2 class="tab"><?php echo ucfirst($translate["pieces_jointes"]); ?></h2>
			<script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage2" ) );</script>
			<?php
				echo $result_recherche_doc;
			?>
		</div>
	
		<!--<div class="tab-page" id="tabPage1">
			<h2 class="tab"><?php echo ucfirst($translate["tags"]); ?></h2>
			<script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage1" ) );</script>
			<?php
				echo $result_recherche_tag;
			?>						
		</div>-->

		
	</div>
