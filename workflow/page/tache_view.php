<?php
/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Tache
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou <moustaphbi@yahoo.fr> 
 * @desc			script pour l'affichage de la page de consultation d'une tâche
 * @creationdate	????
 */
?>
<form action="<?php echo $siteweb->get_url()."/workflow/traitements/partie_centrale.php"; ?>" method="post" name="form_tache_view" id="form_tache_view" >
	<input type="hidden" id="lang" name="lang" value="<?php echo $lang ?>">
	<input type="hidden" id="login" name="login" value="<?php echo $login ?>">
	<input type="hidden" id="do" name="do" value="tache_update_valid">
	<input type="hidden" id="numtache" name="numtache" value="<?php echo $tac->numtache ;?>">
	<div>
		<fieldset class="adminform">
		<legend> <?php echo ucfirst($translate["moddonneestache"]); ?> </legend>
			<table class="admintable" cellspacing="1">
				<tr>
					<td width="150" class="key">
						<label for="name">

							<?php echo ucfirst($translate["numero"]); ?>						</label>					</td>
					<td>
						<input disabled type="text" name="txt_numtache" id="txt_numtache" class="inputbox" size="10" value="<?php echo $tac->numtache; ?>" />					</td>
				</tr>
				<tr>
					<td width="150" class="key">
						<label for="name">
						
							<?php echo ucfirst($translate["libelle"]); ?>						</label>					</td>
					<td>
						<input type="text" name="libtache" id="libtache" class="inputbox" size="50" value="<?php echo $tac->libtache; ?>" />
						<em><font color="Red"><b>*</b></font></em>
					</td>
				</tr>
				
				<tr>
					<td width="150" class="key">
						<label for="name">

							<?php echo ucfirst($translate["duree"]); ?>				</label>					</td>
					<td>
						<input type="text" name="dureetache" id="dureetache" class="inputbox" size="10" value="<?php echo $tac->dureetache; ?>" />					
						&nbsp;<?php echo $unite_duree; ?>
					</td>
				</tr>
				<tr>
					<td width="150" class="key">
						<label for="name">

							<?php echo ucfirst($translate["processus"]); ?>					</label>					</td>
					<td>
						<?php echo $select_processus; ?><em><font color="Red"><b>*</b></font></em>
					</td>
				</tr>
				<tr>
					<td width="150" class="key">
						<label for="name">

							<?php echo ucfirst($translate["type_doc"]); ?>					</label>					</td>
					<td>
						<?php echo $select_typedoc; ?>
					</td>
				</tr>
				<tr><td colspan="2"><em><font color="Red"><b>*&nbsp;<?php echo ucfirst($translate["champs_obligatoires"]) ?></b></font></em></td></tr>				
			</table>
		</fieldset>
	</div>

</form>