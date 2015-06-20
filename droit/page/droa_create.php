
<?php
 
    $chemin = dirname(__FILE__);
    $chemin = str_replace("\droit\page","",$chemin);
   	require_once($chemin.'\classe\application.class.php');	
	$siteweb = new Application();
    global $siteweb;
    require_once($siteweb->get_document_root()."\droit\classe\droa.class.php");
    $ldroit = new droit ();
    $affiche_droit = $ldroit->rechercher();
    $incr_code_droit=count($affiche_droit);
    $incr_code_droit++;
 
?>

<form action="" method="post" name="form_create_droit" id="form_create_droit" >
  
<div class="col width-45">
		<fieldset class="adminform">
		<legend><?php echo ucfirst($translate["donnees_droit"]); ?></legend>
			<table class="admintable" cellspacing="1">
				<tr>
					<td width="150" class="key">
						<label for="name">

							<?php echo ucfirst($translate["code"]); ?>						</label>					</td>
					<td>
						<input type="text" disabled="disabled" name="codedroit_create" id="codedroit_create" class="inputbox" size="40" value="<?php 
						$_POST["codedroit_create"]=$incr_code_droit;echo $incr_code_droit; ?>" />					</td>
				</tr>
				<tr>
					<td width="150" class="key">
						<label for="name">

							<?php echo ucfirst($translate["libelle"]); ?>						</label>					</td>
					<td>
						<input type="text" name="libdroit_create" id="libdroit_create" class="inputbox" size="40" value="" />					</td>
				</tr>
				<tr>
				<tr>
					<td width="150" class="key">
						<label for="name">

							<?php echo ucfirst($translate["niveau_acces_droit"]); ?>					</label>					</td>
					<td>
						<input type="text" name="niveau_accesdroit_create" id="niveau_accesdroit_create" class="inputbox" size="40" value="" />				
					</td>
				</tr>
				
			</table>
		</fieldset>
		
</div>
	
</form>