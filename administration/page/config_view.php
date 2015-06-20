<?php
/**
 * @version		1.0
 * @package		administrateur
 * @subpackage	vision de la configuration générale
 * @copyright 	(c) 2009 INTERFACE SA. Tous droits reservés
 * @license		INTERFACE SA
 * @author 		
 * @desc		script pour l'affichage de la configuration générale
 * @param 		
 * 
 * @creationdate	 
*/
?>

<form enctype="multipart/form-data" action="<?php echo $siteweb->get_url."/administration/traitements/partie_centrale.php"; ?>" method="post" name="form_config_view" id="form_config_view" >
	<input type="hidden" id="lang" name="lang" value="<?php echo $lang ?>">
	<input type="hidden" id="login" name="login" value="<?php echo $login ?>">
	<input type="hidden" id="do" name="do" value="config_update_valid">
	
	<table width="100%">
		<tr>
			<td width="50%" valign="top">
				<fieldset class="adminform">
					<legend><?php echo ucfirst($translate["param_base_donnee"]); ?></legend>
					<table class="admintable" cellspacing="1">
						<tbody>
						<tr>
							<td  class="key">
								<span class="editlinktip hasTip">
								<?php echo ucfirst($translate["type_base_donnee"]); ?>
								</span>
							</td>
							<td> 
								<?php
								echo $siteweb->sel_option_typebd(array("class"=>"text_area" , "name"=>"typebd" , "id"=>"typebd" ) , $lconfig->typebd );
								?>
							</td>
						</tr>
						<tr>
							<td class="key">
								<span class="editlinktip hasTip" title="Nom du serveur::Nom d'hôte de votre base de données saisit lors de l'installation. Ne modifiez pas ce champ sauf absolue nécessité, comme par exemple lors d'un transfert vers un nouvel hôte.">
								<?php echo ucfirst($translate["nom_serveur"]); ?></span>
							</td>
							<td>
								<input class="text_area" type="text" name="hotebd" id="hotebd"  size="60" value="<?php echo $lconfig->hotebd; ?>" />
								<em><font color="Red"><b>*</b></font></em>
							</td>
						</tr>
						<tr>
				
							<td class="key">
								<span class="editlinktip hasTip" title="Identifiant::Identifiant pour l'accès à la base de données saisit lors de l'installation.  Ne modifiez pas ce champ sauf absolue nécessité, comme par exemple lors d'un transfert vers un nouvel hôte.">
										<?php echo ucfirst($translate["identifiant"]); ?></span>
							</td>
							<td>
								<input class="text_area" type="text" name="userbd" id="userbd" size="30" value="<?php echo $lconfig->userbd; ?>" />
								<em><font color="Red"><b>*</b></font></em>
							</td>
						</tr>
						<tr>
				
							<td class="key">
								<span class="editlinktip hasTip" title="Identifiant::Identifiant pour l'accès à la base de données saisit lors de l'installation.  Ne modifiez pas ce champ sauf absolue nécessité, comme par exemple lors d'un transfert vers un nouvel hôte.">
										<?php echo ucfirst($translate["password"]); ?></span>
							</td>
							<td>
								<input class="text_area" type="text" name="pwdbd" id="pwdbd" size="30" value="<?php echo $lconfig->pwdbd; ?>" />
								</td>
						</tr>
						<tr>
							<td class="key">
								<span class="editlinktip hasTip" title="Base de données::Nom de votre base de données saisit lors de l'installation. Ne modifiez pas ce champ sauf absolue nécessité, comme par exemple lors d'un transfert vers un nouvel hôte.">
								<?php echo ucfirst($translate["database"]); ?></span>
							</td>
							<td>
								<input class="text_area" type="text" name="nombd" id="nombd" size="30" value="<?php echo $lconfig->nombd; ?>" />
								<em><font color="Red"><b>*</b></font></em>
							</td>
						</tr>
						</tbody>
					</table>
				</fieldset>
				&nbsp;&nbsp;<input type="button" value="<?php echo $translate["tester_connexion"]; ?>" onclick="javascript:on_test_connexion_database('<?php echo $siteweb->get_url()."/administration/traitements/ttest_connexion.php"  ; ?>' , '<?php echo $siteweb->get_url()  ; ?>');" />
			</td>
			<td width="50%" valign="top">
				<fieldset class="adminform">
					<legend><?php echo ucfirst($translate["param_du_workflow"]); ?></legend>
					<table class="admintable" cellspacing="1">
					<tbody>
						<tr>
							<td width="185" class="key">
								<span class="editlinktip hasTip" title="Nom du serveur::Nom d'hôte de votre application web. Ne modifiez pas ce champ sauf absolue nécessité, comme par exemple lors d'un transfert vers un nouvel hôte.">
								<?php echo ucfirst($translate["nom_serveur_site"]); ?></span>
							</td>
							<td>
								<input class="text_area" type="text" name="hotesite" id="hotesite"  size="60" value="<?php echo $lconfig->hotesite; ?>" />
								<em><font color="Red"><b>*</b></font></em>
							</td>
						</tr>					
						<tr>
							<td width="185" class="key">
								<span class="editlinktip hasTip" >
								<?php echo ucfirst($translate["port"]); ?></span>
							</td>
							<td>
								<input class="text_area" type="text" name="portsite" id="portsite"  size="10" value="<?php echo $lconfig->portsite; ?>" />
								<em><font color="Red"><b>*</b></font></em>
							</td>
						</tr>					
						<tr>
							<td class="key">
								<span class="editlinktip hasTip" >
									<?php echo ucfirst($translate["unite_duree_process"]); ?>
								</span>
							</td>
							<td>
								<?php echo $select_unite_process; ?>			
							</td>
						</tr>
						<tr>
							<td class="key">
								<span class="editlinktip hasTip" >
									<?php echo ucfirst($translate["unite_duree_circuit"]); ?>
								</span>
							</td>
							<td>
								<?php echo $select_unite_circuit; ?>			
							</td>
						</tr>
						<tr>
							<td class="key">
								<span class="editlinktip hasTip" >
									<?php echo ucfirst($translate["unite_duree_tache"]); ?>
								</span>
							</td>
							<td>
								<?php echo $select_unite_tache; ?>			
							</td>
						</tr>						
						<tr>
							<td class="key">
								<span class="editlinktip hasTip" >
								<?php echo ucfirst($translate["longueur_liste"]); ?></span>
							</td>
							<td>
								<?php echo $select_longueur_grille; ?>			
							</td>
						</tr>					
						<tr>
							<td class="key">
								<span class="editlinktip hasTip" title="Base de données::Nom de votre base de données saisit lors de l'installation. Ne modifiez pas ce champ sauf absolue nécessité, comme par exemple lors d'un transfert vers un nouvel hôte.">
								<?php echo ucfirst($translate["notifier_email_receiver"]); ?></span>
							</td>
							<td>							
								<input type="checkbox" onclick="if (this.checked) this.value=1; else this.value=0;" <?php if (intval($lconfig->notifmail) ==1 ) echo "checked" ; ?> name="notifmail"  id="notifmail" value="<?php echo intval($lconfig->notifmail); ?>" />
							</td>
						</tr>				
						<tr>
							<td class="key">Logo&nbsp;</td>
							<td>
								<input type="file" id="logosite" name="logosite" />
							</td>
						</tr>		
					</tbody>
					</table>
				</fieldset>
			</td>
		</tr>
		<tr><td colspan="2"><em><font color="Red"><b>*&nbsp;<?php echo ucfirst($translate["champs_obligatoires"]) ?></b></font></em></td></tr>
	</table>
</form>	
<script type="text/javascript">
on_interfacage_paie();
</script>
<table width="100%">
	<tr>
		<td>
			<script type="text/javascript" src="<?php echo $siteweb->get_url();?>/includes/tabpane/js/tabpane.js"></script>
			<link type="text/css" rel="StyleSheet" href="<?php echo $siteweb->get_url();?>/includes/tabpane/css/luna/tab.css" />
				<div class="tab-pane" id="tabPane1">
				
				<script type="text/javascript">
				tp1 = new WebFXTabPane( document.getElementById( "tabPane1" ) );
				</script>
				
					<div class="tab-page" id="tabPage1">
						<h2 class="tab"><?php echo ucfirst($translate["module"]); ?></h2>
						<script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage1" ) );</script>
						<?php
						echo $result_recherche_module;
						?>						
					</div>
					
					<div class="tab-page" id="tabPage2">
						<h2 class="tab"><?php echo ucfirst($translate["interfacage"]); ?></h2>
						<script type="text/javascript">tp2.addTabPage( document.getElementById( "tabPage2" ) );</script>
						<?php
						echo $result_recherche_interface;
						?>						
					</div>					
				</div>				
		</td>
	</tr>
</table>