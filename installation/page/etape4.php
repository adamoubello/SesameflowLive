<?php

	//récupérer les infos de l'étape 3 à poster dans l'étape 5
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
		
?>
			<form name="form_instal4"  method="POST" id = "form_instal4" action='<?php echo $siteweb->get_url()."/installation/index.php?lang={$lang}&etape=5";?>'  >
			<input type="hidden" id="lang" name="lang" value="<?php echo $lang ?>">
			<input type="hidden" name="etape" id="etape" value="5" />
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
								<?php echo ucfirst($translate["Etape4_installation_Sesameflow-Fichiers_configuration "]);?>
								</legend>
								<table >
									<tbody>
										<tr  >
											<td  >
											   <?php echo ucfirst($translate["CreationFichierConfiguration"])." : {$lretval}  ";?>   
											</td>
										</tr>
										<tr>
											<td>
												   <?php echo ucfirst($translate["connexionserveur"])." : {$lretval_connect_server}" ; ?>    
											</td>
										</tr>
										<tr>
											<td>
												   <?php echo ucfirst($translate["Connexionbase"])." : {$lretval_connection_database} " ;?>    
											</td>
										</tr>						
										<tr >
											<td >
												<input class="spip_bouton" type="button" value="<?php echo ucfirst($translate['Etape_precedente']);?>" onclick="javascript:window.history.back();" name ="state2">
											</td>
											<td >
												<input class="spip_bouton" /*die($getape_suivante); if ($getape_suivante == false)*/ type="button" value="<?php echo ucfirst($translate['Etape_suivante']);?>" onclick="javascript:document.getElementById('form_instal4').submit();" name ="state1">
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