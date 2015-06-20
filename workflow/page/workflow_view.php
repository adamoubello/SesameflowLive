
<?php
    
    $chemin = dirname(__FILE__);
  	$chemin = str_replace("\workflow\page","",$chemin);
    require_once($chemin.'\classe\application.class.php');	
	$siteweb = new Application();
    global $siteweb;
     
?>

<table width="100%">
<tr>
	<td width="100%">
<form action="<?php echo $siteweb->get_url()."/workflow/traitements/partie_centrale.php" ?>" method="post" name="form_workflow_view" id="form_workflow_view" >
	<input type="hidden" id="numworkflow" name="numworkflow" value="<?php echo $workfl->numworkflow ;?>">
	<input type="hidden" id="numtache" name="numtache" value="<?php echo $workfl->numtache ; ?>">
	<input type="hidden" id="numdoc" name="numdoc" value="<?php echo $workfl->numdoc ; ?>">
	<input type="hidden" id="lang" name="lang" value="<?php echo $lang ?>">
	<input type="hidden" id="login" name="login" value="<?php echo $login ?>">
	<input type="hidden" id="do" name="do" value="workflow_update_valid">
	<div class="col width-45">
		<fieldset class="adminform">
		<legend><?php echo ucfirst($translate["moddonneesworkflow"]); ?></legend>
			<table class="admintable" cellspacing="1">
				<tr>
					<td width="150" class="key">
						<label for="name">

							<?php echo ucfirst($translate["numero"]); ?>						</label>					</td>
					<td>
						<input type="text" disabled="disabled" name="numworkflow" id="numworkflow" class="inputbox" size="12" value="<?php echo $workfl->numworkflow; ?>" />					</td>
				</tr>
				
				<!--<tr>
					<td width="150" class="key">
						<label for="name">
						
							<?php echo ucfirst($translate["libelle"]); ?>						</label>					</td>
					<td>
						<input type="text" name="libworkflow" id="libworkflow" class="inputbox" size="40" value="<?php echo $workfl->libworkflow; ?>" />					</td>
				</tr>-->
				
				<tr>
					<td class="key">
						<label for="password2">
							<?php echo ucfirst($translate["datedebutwf"]); ?>		
						</label>
				    </td>
					<td>
 					    <input type="text" name="datedebutwf" id="datedebutwf" class="inputbox" size="12" value="<?php echo $workfl->datedebutwf; ?>" disabled/>						
					</td>

				</tr>	
				<tr>
					<td width="150" class="key">	
					   <label for="name">
						<?php echo ucfirst($translate["heuredebutwf"]); ?>			
					   </label>					
				    </td>
					<td>
						<input type="text" disabled="disabled" name="heuredebutwf" id="heuredebutwf" class="inputbox" size="12" value="<?php echo $workfl->heuredebutwf; ?>" />					
					</td>
				</tr>
				
				<tr>
					<td width="150" class="key">
						<label for="name">

							<?php echo ucfirst($translate["duree"]); ?>				</label>					</td>
					<td>
						<input type="text" disabled="disabled" name="dureewf" id="dureewf" class="inputbox" size="12" value="<?php echo $workfl->dureewf; ?>" />					</td>
				</tr>
				
				<tr>
					<td class="key"><label for="name"><?php echo ucfirst($translate["etat"]); ?></label></td>
					<td>
					   <input type="radio" name="archivewf" id="block1" value="0" class="inputbox" size="1" <?php if (intval($workfl->archivewf) == 0) echo "checked";//print_r($workfl->archivewf);die(""); ?>/>
					   <label for="block0" ><?php echo ucfirst($translate["active"]); ?> </label>
			           <input name="archivewf" type="radio" class="inputbox" id="block0" value="1" size="1" <?php if (intval($workfl->archivewf) == 1) echo "checked";//print_r($workfl->archivewf);die(""); ?> />
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
			
			<link type="text/css" rel="StyleSheet" href="<?php echo $siteweb->get_url();?>/includes/tabpane/css/luna/tab.css" />
				<div class="tab-pane" id="tabPane1">
				
				<script type="text/javascript">
					tp1 = new WebFXTabPane( document.getElementById( "tabPane1" ) );
				</script>
				
					<div class="tab-page" id="tabPage1">
						<h2 class="tab"><?php echo ucfirst($translate["document"]); ?></h2>
						<script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage1" ) );</script>
						<?php
							echo $result_recherche_doc;
						?>						
					</div>
				
				    <div class="tab-page" id="tabPage2">
						<h2 class="tab"><?php echo ucfirst($translate["acteur"]); ?></h2>
						<script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage2" ) );</script>
						<?php
							echo $result_recherche_user;
						?>						
					</div>
				
					<div class="tab-page" id="tabPage3">
						<h2 class="tab"><?php echo ucfirst($translate["tache"]); ?></h2>
						<script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage3" ) );</script>
						<?php
							echo $result_recherche_tache;
						?>
					</div>
					
				</div>
		</td>
	</tr>
</table>	
