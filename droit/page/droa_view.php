
<?php
   
    $chemin = dirname(__FILE__);
    $chemin = str_replace("\droit\page","",$chemin);
    require_once($chemin.'\classe\application.class.php');	
	$siteweb = new Application();
    global $siteweb;
	
  ?>

<form action="" method="post" name="adminForm" autocomplete="off" onsubmit="soumet ()" id="form-login">

	<div class="col width-45">
		<fieldset class="adminform">
		<legend><?php echo ucfirst($translate["donnees_droit"]); ?></legend>
			<table class="admintable" cellspacing="1">
				<tr>
					<td width="150" class="key"> <label for="name"> <?php echo ucfirst($translate["code"]); ?> </label>	</td>
					<td><input type="text" name="codedroa" id="codedroa" class="inputbox" size="40" value="<?php echo $droa->codedroa; ?>" /></td>
				</tr>
				<tr>
					<td width="150" class="key">
						<label for="name">
						
							<?php echo ucfirst($translate["libelle"]); ?>						</label>					</td>
					<td>
						<input type="text" name="libdroa" id="libdroa" class="inputbox" size="40" value="<?php echo $droa->libdroa; ?>" />					</td>
				</tr>
				
				<tr>
					<td width="150" class="key">
						<label for="name">

							<?php echo ucfirst($translate["niveau_acces_droit"]); ?>				</label>					</td>
					<td>
						<input type="text" name="niveau_accesdroa" id="niveau_accesdroa" class="inputbox" size="40" value="<?php echo $droa->niveau_accesdroa; ?>" />					</td>
				</tr>
				
		</table>
		</fieldset>
		
	</div>
	<div class="clr"></div>
</form>
