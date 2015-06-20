<?php
/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Profil
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits r�serv�s
 * @license			INTERFACE SA
 * @author 			Bello Adamou <moustaphbi@yahoo.fr>
 * @desc			Script pour la fiche de cr�ation de profil
 * @creationdate	20 Juillet 2009
 */	
?>

<form action="<?php echo $siteweb->get_url()."/utilisateur/traitements/partie_centrale.php" ?>" method="post" name="form_create_profil" id="form_create_profil" >
	<input type="hidden" id="lang" name="lang" value="<?php echo $lang ?>">
	<input type="hidden" id="login" name="login" value="<?php echo $login ?>">
	<input type="hidden" id="do" name="do" value="profil_create_valid">
	<input type="hidden" id="codeprofil" name="codeprofil" value="<?php echo $codeprofil ;?>">

	<div>
		<fieldset class="adminform">
		<legend><?php echo ucfirst($translate["creerprofil"]); ?> </legend>
			<table class="admintable" cellspacing="1">
				<tr>
					<td width="150" class="key">
						<label for="name">

							<?php echo ucfirst($translate["code"]); ?>						</label>					</td>
				  <td><input type="text" disabled="disabled" name="codeprofil" id="codeprofil" class="inputbox" size="10" value="<?php $_POST["codeprofil"]=$incr_code_profil;echo $codeprofil; ?>" /></td>
				</tr>
				<tr>
					<td width="150" class="key">
						<label for="name">

							<?php echo ucfirst($translate["libelle"]); ?>				</label>					</td>
					<td> <input type="text" name="libprofil" id="libprofil" class="inputbox" size="50" value="" />
					<em><font color="Red"><b>*</b></font></em>
					 </td>
				</tr>
				<tr><td colspan="2"><em><font color="Red"><b>*&nbsp;<?php echo ucfirst($translate["champs_obligatoires"]) ?></b></font></em></td></tr>												
		</table>
		</fieldset>
	</div>

</form>