<?php
/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Département
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou <moustaphbi@yahoo.fr> 
 * @desc			script pour l'affichage de la page de création d'un département
 * @creationdate	15 Juillet 2009
 */
?>
<form action="<?php echo $siteweb->get_url()."/utilisateur/traitements/partie_centrale.php" ?>" method="post" name="form_create_departement" id="form_create_departement" >
	<input type="hidden" id="lang" name="lang" value="<?php echo $lang ?>">
	<input type="hidden" id="login" name="login" value="<?php echo $login ?>">
	<input type="hidden" id="do" name="do" value="dep_create_valid">
	<input type="hidden" id="codedep" name="codedep" value="<?php echo $codedep ;?>">

	<div>
		<fieldset class="adminform">
		<legend><?php //echo ucfirst($translate["creerdep"]); ?> </legend>
			<table class="admintable" cellspacing="1">
				<tr>
					<td width="150" class="key">
						<label for="name">

							<?php echo ucfirst($translate["code"]); ?>						</label>					</td>
				  <td><input type="text" disabled="disabled" name="codedep" id="codedep" class="inputbox" size="10" value="<?php echo $codedep ;?>" /></td>
				</tr>
				<tr>
					<td width="150" class="key">
						<label for="name">

							<?php echo ucfirst($translate["libelle"]); ?>				</label>					</td>
					<td> <input type="text" name="libdep" id="libdep" class="inputbox" size="50" value="" /> 
					<em><font color="Red"><b>*</b></font></em>
					</td>
				</tr>
				<tr><td colspan="2"><em><font color="Red"><b>*&nbsp;<?php echo ucfirst($translate["champs_obligatoires"]) ?></b></font></em></td></tr>
		</table>
		</fieldset>
	</div>
</form>