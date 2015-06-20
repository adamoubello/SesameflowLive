<?php

/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Processus
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			bello <mouttaphbi@yahoo.fr>
 * @desc			Script qui affiche le formulaire de création d'un processus
 * 
 * @creationdate	????
 * @updates
 * 	# vendredi 26 juin 2009 by patrick mveng<patrick.mveng@interfacesa.com>
 * 		- suppression de la classa clo sur le div
 * 		- désactivation du champ de saisie du numéro de processus et affichage d'un numéro par défaut
 * 		- postage de langue et du login
 */
 
	$chemin = dirname(__FILE__);
    $chemin = str_replace("\workflow\page","",$chemin);
    require_once($chemin.'\classe\application.class.php');	
	$siteweb = new Application();
    global $siteweb;
    require_once($siteweb->get_document_root().'\workflow\traitements\tprocessus_create.php');
	
?>

<form action="<?php echo $siteweb->get_url()."/workflow/traitements/partie_centrale.php" ?>" method="post" name="form_processus_create" id="form_processus_create">
	<input type="hidden" id="lang" name="lang" value="<?php echo $lang ?>">
	<input type="hidden" id="login" name="login" value="<?php echo $login ?>">
	<input type="hidden" id="do" name="do" value="processus_create_valid">
	<input type="hidden" id="numprocessus" name="numprocessus" value="<?php echo $lprocessus->get_numero() ;?>">
	<div>
		<fieldset class="adminform">
		<legend> <?php echo ucfirst($translate["creerprocessus"]); ?> </legend>
			<table class="admintable" cellspacing="1">
				<tr>
					<td width="150" class="key">
						<label for="name">

							<?php echo ucfirst($translate["numero"]); ?>						</label>					</td>
					<td>
						<input disabled type="text" name="txt_numprocessus" id="txt_numprocessus" class="inputbox" size="10" value="<?php echo $lprocessus->get_numero() ;?>" />					</td>
				</tr>
				<tr>
					<td width="150" class="key">
						<label for="name">

							<?php echo ucfirst($translate["libelle"]); ?>						</label>					</td>
					<td>
						<input type="text" name="libprocessus" id="libprocessus" class="inputbox" size="100" value="" onfocus="if (document.getElementById('system-message')) document.getElementById('system-message').style.display = 'none'; " />					
						<em><font color="Red"><b>*</b></font></em>
					</td>
				</tr>
				<!--<tr>
					<td width="150" class="key">
						<label for="name"><?php echo ucfirst($translate["duree"]); ?></label>
					</td>
					<td>
						<input type="text" name="dureeprocessus" id="dureeprocessus" class="inputbox" size="10" value="" />
						&nbsp;<?php echo $unite_duree; ?>
					</td>
				</tr>
				-->
				<tr>
					<td class="key">
						<label for="email">
							<?php echo ucfirst($translate["etat"]); ?>						</label>
					</td>
					<td>
					  <input type="radio" name="etatprocessus" id="block" value="1" class="inputbox" size="1" checked="checked" />
					  <label for="block0"><?php echo ucfirst($translate["active"]); ?>	</label>
					  <input name="etatprocessus" type="radio" class="inputbox" id="block" value="0" size="1"  />
                      <label for="block1"><?php echo ucfirst($translate["desactive"]); ?>	</label>	
					 </td>
				</tr>
                <tr><td colspan="2"><em><font color="Red"><b>*&nbsp;<?php echo ucfirst($translate["champs_obligatoires"]) ?></b></font></em></td></tr>			 
	    </table>
		</fieldset>
	</div>
</form>