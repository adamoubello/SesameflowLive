
<table width="100%">
<tr>
	<td>	
		<form action="<?php echo $siteweb->get_url()."/utilisateur/traitements/partie_centrale.php"; ?>" method="post" name="form_groupe_view" id="form_groupe_view" >
			<input type="hidden" id="lang" name="lang" value="<?php echo $lang ?>">
			<input type="hidden" id="login" name="login" value="<?php echo $login ?>">
			<input type="hidden" id="do" name="do" value="groupe_update_valid">
			<input type="hidden" id="codegroup" name="codegroup" value="<?php echo $lgroupe->get_numero() ;?>">
			<div class="col width-45">
				<fieldset class="adminform">
				<legend><?php echo ucfirst($translate["groupe"]); ?></legend>
					<table class="admintable" cellspacing="1">
						<tr>
							<td width="150" class="key">
								<label for="name">
		
									<?php echo ucfirst($translate["code"]); ?>	</label>					</td>
							<td>
								<input disabled type="text" name="txt_codegroup" id="txt_codegroup" class="inputbox" size="10" value="<?php echo $lgroupe->codegroup; ?>" />					</td>
						</tr>
						<tr>
							<td width="150" class="key">
								<label for="name">
								
									<?php echo ucfirst($translate["libelle"]); ?>						</label>					</td>
							<td>
								<input type="text" name="libgroup" id="libgroup" class="inputbox" size="70" value="<?php echo $lgroupe->libgroup; ?>" />					
								<em><font color="Red"><b>*</b></font></em>
							</td>
						</tr>
			    </table>
				</fieldset>
			</div>
		</form>
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
						<h2 class="tab"><?php echo ucfirst($translate["utilisateur"]); ?></h2>
						<script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage1" ) );</script>
						<?php
							echo $result_recherche_user;
						?>						
					</div>
					
					<div class="tab-page" id="tabPage2">
						<h2 class="tab"><?php echo ucfirst($translate["permission"]); ?></h2>
						<script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage2" ) );</script>
						<form action="<?php echo $siteweb->get_url()."/administration/traitements/partie_centrale.php"; ?>" method="post" name="frm_droit" id="frm_droit" >
							<input type="hidden" id="lang" name="lang" value="<?php echo $lang ?>">
							<input type="hidden" id="login" name="login" value="<?php echo $login ?>">
							<input type="hidden" id="do" name="do" value="droit_update_valid">
							<input type="hidden" id="codegroup" name="codegroup" value="<?php echo $lgroupe->get_numero() ;?>">
							<?php
								echo $result_recherche_droit;
							?>
						</form>
					</div>
					
				</div>
		</td>
	</tr>
</table>	
		