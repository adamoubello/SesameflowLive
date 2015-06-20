<?php
/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Workflow
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou <moustaphbi@yahoo.fr> 
 * @desc			script pour l'affichage de la page web de l'étape 1 pour la création d'un circuit
 * 					le numéro de circuit est affiché uniquement si on vient de l'étape 2 					
 * @creationdate	mardi 25 mai 2010
 * @updates
 */   	
?>

<form action="<?php echo $siteweb->get_url()."/workflow/traitements/partie_centrale.php" ?>" method="post" name="form_create_workflow" id="form_create_workflow" >
	<input type="hidden" id="lang" name="lang" value="<?php echo $lang ?>">
	<input type="hidden" id="login" name="login" value="<?php echo $login ?>">
	<input type="hidden" id="do" name="do" value="workflow_create_valid">
	<input type="hidden" id="numworkflow" name="numworkflow" value="<?php echo $numworkflow ;?>">

	<div>
		<fieldset class="adminform">
		<legend><?php echo ucfirst($translate["creerworkflow"]); ?> </legend>
			<table class="admintable" cellspacing="1">
				<tr>
					<td width="150" class="key">
						<label for="name">
							<?php echo ucfirst($translate["numero"]); ?>						</label>					</td>
				  <td><input type="text" disabled="disabled" name="numworkflow" id="numworkflow" class="inputbox" size="10" value="<?php $_POST["numworkflow"]=$incr_code_workflow;echo $numworkflow; ?>" /></td>
				</tr>
				<tr>
					<td class="key">
						<label for="password2">
							<?php echo ucfirst($translate["datenaissanceuser"]); ?>					</label>
					</td>
					<td>
													<!--<input class="inputbox" type="text" name="datenaiss" id="datenaiss" size="40" value="" />-->
<?php echo $siteweb->date_tag(array("type" => "text" , "name" => "datenaissanceuser" , "id" => "datenaissanceuser" , "class" => "inputbox" , "size" => "11" , "value"=>"" ) ,array("src" => $siteweb->get_url()."/images/cal.gif" , "id" => "img_datenaiss" , "style" => "cursor: pointer; border: none;" , "title" => $translate["date_selector"]  )); ?>

				  </td>
				</tr>					
				<tr>
					<td width="150" class="key">
						<label for="name">
							<?php echo ucfirst($translate["heuredebutwf"]); ?>				</label>					</td>
					<td> <input type="text" name="heuredebutwf" id="heuredebutwf" class="inputbox" size="50" value="" /> 
					<em><font color="Red"><b>*</b></font></em>
					</td>
				</tr>
				<tr>
					<td width="150" class="key">
						<label for="name">
							<?php echo ucfirst($translate["duree"]); ?>				</label>					</td>
					<td>
						<input type="text" name="dureecircuit" id="dureecircuit" class="inputbox" size="10" value="<?php 	echo $dureecircuit; ?>" />&nbsp;(&nbsp;<?php echo str_replace("{unite_duree_circuit}" , $unite_duree_circuit , $translate["en_x_unite"]); ?>&nbsp;)</td>
				</tr>
				<tr>
					<td width="150" class="key">
						<label for="name">	<?php echo ucfirst($translate["circuit"]); ?>	</label>			</td>
					<td>
						<?php echo $select_processus; ?><em><font color="Red"><b>*</b></font></em>
					</td>
				</tr>
				<tr>
					<td width="150" class="key">
						<label for="name">	<?php echo ucfirst($translate["type_doc"]); ?>	</label>					</td>
					<td>
						<?php echo $select_typedoc; ?>
					</td>
				</tr>
				<tr><td colspan="2"><em><font color="Red"><b>*&nbsp;<?php echo ucfirst($translate["champs_obligatoires"]) ?></b></font></em></td></tr>
			</table>
		</fieldset>
	</div>

</form>
