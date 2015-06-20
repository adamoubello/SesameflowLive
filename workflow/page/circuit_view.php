<?php
/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Circuit
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			patrick mveng<patrick.mveng@interfacesa.com> 
 * @desc			script pour l'affichage de la page de consultation d'un circuit
 * @creationdate	samedi 26 juin 2009
 */
?>
<form action="<?php echo $siteweb->get_url()."/workflow/traitements/partie_centrale.php"; ?>" method="post" name="form_circuit_view" id="form_circuit_view" >
	<input type="hidden" id="lang" name="lang" value="<?php echo $lang ?>">
	<input type="hidden" id="login" name="login" value="<?php echo $login ?>">
	<input type="hidden" id="do" name="do" value="circuit_update_valid">
	<input type="hidden" id="codecircuit" name="codecircuit" value="<?php echo $lcircuit->codecircuit ;?>">
	<input type="hidden" id="nbr_tache" name="nbr_tache" value="<?php echo count($listetache) ;?>">
	<input type="hidden" id="nbr_tache_initiale" name="nbr_tache_initiale" value="1">	
	<table style="width:100%">
		<tr>
			<td>
			<fieldset class="adminform">
			<legend> <?php echo ucfirst($translate["moddonneescircuit"]); ?> </legend>
				<table class="admintable" cellspacing="1">
					<tr>
						<td width="150" class="key">
							<label for="name">
	
								<?php echo ucfirst($translate["numero"]); ?>						</label>					</td>
						<td>
							<input disabled type="text" name="txt_numcircuit" id="txt_numcircuit" class="inputbox" size="10" value="<?php echo $lcircuit->codecircuit; ?>" />					</td>
					</tr>
					<tr>
						<td width="150" class="key">
							<label for="name">
							
								<?php echo ucfirst($translate["libelle"]); ?>						</label>					</td>
						<td>
							<input type="text" name="libcircuit" id="libcircuit" class="inputbox" size="100" value="<?php echo $lcircuit->libcircuit; ?>" />
							<em><font color="Red"><b>*</b></font></em>
						</td>
					</tr>
					
					<tr>
						<td width="150" class="key">
							<label for="name">
	
								<?php echo ucfirst($translate["duree"]); ?>				</label>					</td>
						<td>
							<input type="text" name="dureecircuit" id="dureecircuit" class="inputbox" size="10" value="<?php echo $lcircuit->dureecircuit; ?>" />					
							&nbsp;<?php echo $unite_duree; ?>
						</td>
					</tr>
					<tr>
						<td width="150" class="key">
							<label for="name">
	
								<?php echo ucfirst($translate["processus"]); ?>					</label>					</td>
						<td>
							<?php echo $select_processus; ?>
							<em><font color="Red"><b>*</b></font></em>
						</td>
					</tr>
					</table>
			</fieldset>
		</td>
		</tr>
		<tr><td colspan="2"><em><font color="Red"><b>*&nbsp;<?php echo ucfirst($translate["champs_obligatoires"]) ?></b></font></em></td></tr>
		<tr>
			<td>
				<script type="text/javascript" src="<?php echo $siteweb->get_url();?>/includes/tabpane/js/tabpane.js"></script>
				<link type="text/css" rel="StyleSheet" href="<?php echo $siteweb->get_url();?>/includes/tabpane/css/luna/tab.css" />
					<div class="tab-pane" id="tabPane1">
					
					<script type="text/javascript">
						tp1 = new WebFXTabPane( document.getElementById( "tabPane1" ) );
					</script>
					
						<div class="tab-page" id="tabPage1">
							<h2 class="tab"><?php echo ucfirst($translate["tache"]); ?></h2>
							<script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage1" ) );</script>
							<?php
								echo $result_recherche_tache;
							?>						
						</div>
					</div>
			</td>	
		</tr>
	</table>		
</form>
<script type="text/javascript">
	//parcourir les lignes et y affecter un id
	// cet id ets nécessaire pour retrouver une ligne à supprimer
	var oTable = document.getElementById('table_taches');
	oTable = eval(oTable);
	
	if (oTable)
	{
		var RowsLength = oTable.rows.length;
		var oRow;
		//var nbreligne;
		
		for (var i=0; i < RowsLength; i++)
		{
		    oRow = oTable.rows.item(i);
		    oRow = eval(oRow);
		    
		    if (oRow)
		    {
		    	//nbreligne = i + 1;
		    	oRow.id = "ligne" + i;
		    }
		    
		}	
	}
	
	
</script>