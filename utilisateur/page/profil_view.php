<?php
/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Profil
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou <moustaphbi@yahoo.fr> 
 * @desc			script pour l'affichage de la page de consultation d'un profil
 * @creationdate	20 Juillet 2009
 */
?>

<table width="100%">
<tr>
	<td>	
			<form action="<?php echo $siteweb->get_url()."/utilisateur/traitements/partie_centrale.php"; ?>" method="post" name="form_profil_view" id="form_profil_view" >
				<input type="hidden" id="lang" name="lang" value="<?php echo $lang ?>">
				<input type="hidden" id="login" name="login" value="<?php echo $login ?>">
				<input type="hidden" id="do" name="do" value="profil_update_valid">
				<input type="hidden" id="codeprofil" name="codeprofil" value="<?php echo $lprofil->codeprofil ;?>">
					<fieldset class="adminform">
					<legend> <?php echo ucfirst($translate["moddonneesprofil"]); ?> </legend>
						<table class="admintable" cellspacing="1">
							
							<tr>
								<td width="150" class="key">
									<label for="name">
			
										<?php echo ucfirst($translate["code"]); ?>						</label>					</td>
								<td>
									<input disabled type="text" name="txt_codeprofil" id="txt_codeprofil" class="inputbox" size="10" value="<?php echo $lprofil->codeprofil; ?>" />	
								</td>
							</tr>
							
							<tr>
								<td width="150" class="key">
									<label for="name">
									
										<?php echo ucfirst($translate["libelle"]); ?>						</label>				</td>
								<td>
									<input type="text" name="libprofil" id="libprofil" class="inputbox" size="50" value="<?php echo $lprofil->libprofil; ?>" />	
									<em><font color="Red"><b>*</b></font></em>
								</td>
							</tr>
							<tr><td colspan="2"><em><font color="Red"><b>*&nbsp;<?php echo ucfirst($translate["champs_obligatoires"]) ?></b></font></em></td></tr>				
							</table>
					</fieldset>
			</form>
		</td>
	</tr>
	<tr>
		<td>
			<script type="text/javascript" src="<?php echo $siteweb->get_url();?>/includes/tabpane/js/tabpane.js"></script>
			<link type="text/css" rel="StyleSheet" href="<?php echo $siteweb->get_url();?>/includes/tabpane/css/luna/tab.css" />
				<div class="tab-pane" id="tabPane1">
				
				<script type="text/javascript">
					tp1 = new WebFXTabPane( document.getElementById( "tabPane1" ) );
				</script>
				
					<div class="tab-page" id="tabPage1">
						<h2 class="tab"><?php echo ucfirst($translate["utilisateur"]); ?></h2>
						<script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage1" ) );</script>
						<?php
							echo $result_recherche_user;
						?>						
					</div>
					
				</div>
		</td>
	</tr>
</table>	
		