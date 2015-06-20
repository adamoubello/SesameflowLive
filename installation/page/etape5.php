<?php
	//récupérer les infos de l'étape 5 à poster dans l'étape 6
	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
		$data[$lkey] = $lvalue;
	}
	
	$hotebd = (isset($data["hotebd"])) ? (! is_null($data["hotebd"])) ? $data["hotebd"] : "localhost" : "localhost";
	$hotesite = (isset($data["hotesite"])) ? (! is_null($data["hotesite"])) ? $data["hotesite"] : "localhost" : "localhost";
	$portsite = (isset($data["portsite"])) ? (! is_null($data["portsite"])) ? $data["portsite"] : 80 : 80;
	$typebd = (isset($data["typebd"])) ? (! is_null($data["typebd"])) ? $data["typebd"] : "mysql" : "mysql";
	$nombd = (isset($data["nombd"])) ? (! is_null($data["nombd"])) ? $data["nombd"] : "" : "";
	$userbd = (isset($data["userbd"])) ? (! is_null($data["userbd"])) ? $data["userbd"] : "root" : "root";
	$pwdbd = (isset($data["pwdbd"])) ? (! is_null($data["pwdbd"])) ? $data["pwdbd"] : "" : "";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR ); $chemin = dirname(__FILE__); $chemin = str_replace(DS."installation".DS."page","",$chemin); require_once($chemin.DS.'classe'.DS.'application.class.php'); $siteweb = new Application(); 	
?>
	 		<form name="form_instal5" method="POST" id = "form_instal5" action='<?php echo $siteweb->get_url()."/installation/index.php?lang={$lang}&etape=6";?>' >
				<input type="hidden" name="etape" id="etape" value="5" />
				<input type="hidden" name="lang" id="lang" value="<?php echo $lang ?>" />
				<input type="hidden" name="hotebd" id="hotebd" value="<?php echo $hotebd ?>" />
				<input type="hidden" name="typebd" id="typebd" value="<?php echo $typebd ?>" />
				<input type="hidden" name="nombd" id="nombd" value="<?php echo $nombd ?>" />
				<input type="hidden" name="userbd" id="userbd" value="<?php echo $userbd ?>" />
				<input type="hidden" name="pwdbd" id="pwdbd" value="<?php echo $pwdbd ?>" />
				<input type="hidden" name="hotesite" id="hotesite" value="<?php echo $hotesite ?>" />
				<input type="hidden" name="portsite" id="portsite" value="<?php echo $portsite ?>" />
		 		
				<table width = "100%">
					<tr>
						<td valign="middle" bgcolor="">
							<fieldset class="adminform" >
								<legend>
								<?php echo ucfirst($translate["Etape5installationSesameflow-Création_objets_base"]);?>
								</legend>
								<table >
									<tbody>
										<tr>
											<td>
												<?php echo ucfirst($translate["creationbase"])." : {$lretval_creation_database}";?>
											</td>
										</tr>
										<tr>
											<td>
												<?php echo ucfirst($translate["Versionbase "])." : "."<font style=\"color:green\"><b>".$siteweb->get_numero_version()."</b> </font>";?> 
											</td>
										</tr>
										<tr>
											<td >
												<input class="spip_bouton" type="button" value="<?php echo ucfirst($translate['Etape_precedente']);?>" onclick="javascript:window.history.back();" name ="state2">
											</td>
											<td >
												<input class="spip_bouton" type="button" value="<?php echo ucfirst($translate['Etape_suivante']);?>" onclick="javascript:document.getElementById('form_instal5').submit();" name ="state1">
											</td>
											<td >
												<input class="spip_bouton" type="button" value="<?php echo ucfirst($translate['quitter']);?>" onclick="javascript:Confirm_Ok_Cancel();" name ="state1">
											</td>
										</tr>
									</tbody>
								</table>
							</fieldset>
						</td>
					</tr>
					
				</table>
			</form>