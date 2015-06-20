<?php

/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Groupe
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou <moustaphbi@yahoo.fr>
 * @desc			Script qui affiche le formulaire de création d'un groupe
 * @creationdate	????
 */
 
	$chemin = dirname(__FILE__);
    $chemin = str_replace("\utilisateur\page","",$chemin);
    require_once($chemin.'\classe\application.class.php');	
	$siteweb = new Application();
    global $siteweb;
    require_once($siteweb->get_document_root().'\utilisateur\traitements\tgroupe_create.php');
	
?>

<form action="<?php echo $siteweb->get_url()."/utilisateur/traitements/partie_centrale.php" ?>" method="post" name="form_groupe_create" id="form_groupe_create">
	<input type="hidden" id="lang" name="lang" value="<?php echo $lang ?>">
	<input type="hidden" id="login" name="login" value="<?php echo $login ?>">
	<input type="hidden" id="do" name="do" value="groupe_create_valid">
	<input type="hidden" id="codegroup" name="codegroup" value="<?php echo $lgroupe->get_numero() ;?>">
	<div>
		<fieldset class="adminform">
		<legend> <?php echo ucfirst($translate["creergroupe"]); ?> </legend>
			<table class="admintable" cellspacing="1">
				<tr>
					<td width="150" class="key">
						<label for="name">

							<?php echo ucfirst($translate["code"]); ?>						</label>					</td>
					<td>
						<input type="text" disabled name="txt_codegroup" id="txt_codegroup" class="inputbox" size="10" value="<?php echo $lgroupe->get_numero() ;?>" />	
					</td>
				</tr>
				<tr>
					<td width="150" class="key">
						<label for="name">

							<?php echo ucfirst($translate["libelle"]); ?>						</label>					</td>
					<td>
						<input type="text" name="libgroup" id="libgroup" class="inputbox" size="100" value="" onfocus="if (document.getElementById('system-message')) document.getElementById('system-message').style.display = 'none'; " />					
						<em><font color="Red"><b>*</b></font></em>
					</td>
				</tr>                 			 
				<tr><td colspan="2"><em><font color="Red"><b>*&nbsp;<?php echo ucfirst($translate["champs_obligatoires"]) ?></b></font></em></td></tr>				
	    </table>
		</fieldset>
	</div>
</form>