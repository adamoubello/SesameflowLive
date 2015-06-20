
<?php
   

	//obtenir le séparateur de dossier pour le OS en cours
    if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
    
    $chemin = dirname(__FILE__);
    $chemin = str_replace(DS."workflow".DS."page","",$chemin);
    require_once($chemin.DS.'classe'.DS."application.class.php");	
	$siteweb = new Application();
    global $siteweb;
 
  ?>
<table width="100%">
<tr>
	<td width="100%">
		<form action="<?php echo $siteweb->get_url()."/workflow/traitements/partie_centrale.php"; ?>" method="post" name="form_processus_view" id="form_processus_view" >
			<input type="hidden" id="lang" name="lang" value="<?php echo $lang ?>">
			<input type="hidden" id="login" name="login" value="<?php echo $login ?>">
			<input type="hidden" id="do" name="do" value="processus_update_valid">
			<input type="hidden" id="numprocessus" name="numprocessus" value="<?php echo $process->get_numero() ;?>">
			<div class="col width-45">
				<fieldset class="adminform">
				<legend><?php echo ucfirst($translate["processus"]); ?></legend>
					<table class="admintable" cellspacing="1" width="100%">
						<tr>
							<td width="150" class="key">
								<label for="name">
		
									<?php echo ucfirst($translate["numero"]); ?>	</label>					</td>
							<td>
								<input disabled type="text" name="txt_numprocessus" id="txt_numprocessus" class="inputbox" size="10" value="<?php echo $process->numprocessus; ?>" />					</td>
						</tr>
						<tr>
							<td width="150" class="key">
								<label for="name">
								
									<?php echo ucfirst($translate["libelle"]); ?>						</label>					</td>
							<td>
								<input type="text" name="libprocessus" id="libprocessus" class="inputbox" size="100" value="<?php echo str_replace("\'","'",$process->libprocessus) ; ?>" />					
								<em><font color="Red"><b>*</b></font></em>
							</td>
						</tr>
						
						<tr>
							<td width="150" class="key">
								<label for="name">
									<?php echo ucfirst($translate["duree"]); ?>				
								</label>
							</td>
							<td>
								<?php echo intval($process->dureeprocessus); ?>&nbsp;<?php echo $unite_duree; ?>
								<!--<input type="text" name="dureeprocessus" id="dureeprocessus" class="inputbox" size="10" value="<?php echo $process->dureeprocessus; ?>" />-->
							</td>
						</tr>
						<tr>
							<td class="key"><label for="etatprocessus"><?php echo ucfirst($translate["etat"]); ?></label>
							</td>
							<td>
							  <input type="radio" name="etatprocessus" id="block1" value="1" class="inputbox" size="1" <?php if (intval($process->etatprocessus) == 1) echo "checked"; ?>/>
							 <label for="block0" ><?php echo ucfirst($translate["active"]); ?> </label>
			                  <input name="etatprocessus" type="radio" class="inputbox" id="block0" value="0" size="1" <?php if (intval($process->etatprocessus) == 0) echo "checked"; ?> />
		                     <label for="block0" ><?php echo ucfirst($translate["desactive"]); ?> </label>
							</td>
						</tr>
			    </table>
				</fieldset>
			</div>
		</form>
	</td>
	</tr>
	<tr>
		<td>
			<script type="text/javascript" src="<?php echo $siteweb->get_url();?>/includes/tabpane/js/tabpane.js"></script>
			<!--<link type="text/css" rel="StyleSheet" href="<?php echo $siteweb->get_url();?>/includes/tabpane/css/tab.webfx.css" />-->
			<link type="text/css" rel="StyleSheet" href="<?php echo $siteweb->get_url();?>/includes/tabpane/css/luna/tab.css" />
				<div class="tab-pane" id="tabPane1">
				
				<script type="text/javascript">
					tp1 = new WebFXTabPane( document.getElementById( "tabPane1" ) );
				</script>
				
					<div class="tab-page" id="tabPage1">
						<h2 class="tab"><?php echo ucfirst($translate["circuit"]); ?></h2>
						<script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage1" ) );</script>
						<?php
							echo $result_recherche_circuit;
						?>						
					</div>
				
					<div class="tab-page" id="tabPage2">
						<h2 class="tab"><?php echo ucfirst($translate["tache"]); ?></h2>
						<script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage2" ) );</script>
						<?php
							echo $result_recherche_tache;
						?>
					</div>
				</div>
		</td>
	</tr>
</table>	
