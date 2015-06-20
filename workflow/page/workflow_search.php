<table width="100%">
	<tr>
		<td>
          <?php		 				  
		  $nbr_workflow = 0;		  
          ?>        	
		 <form action="<?php echo $siteweb->get_url(); ?>/gabarit/page.gabarit.php?do=workflow_search&lang=<?php echo $lang; ?>" method="post" name="form_workflow_search">
			<input type="hidden" id="do" name="do" value="workflow_search"  />
			<input type="hidden" id="lang" name="lang" value="<?php echo $lang; ?>"  />
			<input type="hidden" id="login" name="login" value="<?php echo $login; ?>"  />
			<fieldset class="adminform" >
		<legend> <?php echo ucfirst($translate["rechercher_workflow"]); ?> </legend>
			<table cellspacing="1" class="admintable" hspace="123">
				<tr>
				  <td class="key">
				  <label for="name"> <?php echo ucfirst($translate["libelle"]); ?> </label></td>
					<td ><?php 
							echo $siteweb->sel_option_search(array( "class" => "texte_gris" , "name" => "sel_option_libworkflow")
							 , $sel_option_libworkflow , ucfirst($translate["choisissez"])); 
					?>
					<input name="libworkflow" type="text" class="inputbox" id="libworkflow" value="<?php echo $libworkflow; ?>" size="50" />
					</td>
				</tr>
				
				<tr>
				  <td class="key">
				  <label for="name"> <?php echo ucfirst($translate["datedebutworkflow"]); ?> </label></td>
					<td><?php echo $translate['entre']; ?>&nbsp;&nbsp;<?php echo $siteweb->date_tag(array("type" => "text" , "name" => "dat_deb_creation" , "id" => "dat_deb_creation" , "class" => "inputbox" , "size" => "11" , "value"=>"{$dat_deb_creation}" ) ,array("src" => $siteweb->get_url()."/images/cal.gif" , "id" => "img_dat_deb_creation" , "style" => "cursor: pointer; border: none;" , "title" => $translate["date_selector"]));
						?>
						&nbsp;<?php echo $translate['et'];?>&nbsp;&nbsp;<?php echo $siteweb->date_tag(array("type" => "text" , "name" => "dat_fin_creation" , "id" => "dat_fin_creation" , "class" => "inputbox" , "size" => "11" , "value"=>"{$dat_fin_creation}" ) ,array("src" => $siteweb->get_url()."/images/cal.gif" , "id" => "img_dat_fin_creation" , "style" => "cursor: pointer; border: none;" , "title" => $translate["date_selector"]));
						?>
					</td>
				</tr>
				
				<tr>
					<td class="key">
						<label for="login"> <?php echo ucfirst($translate["duree"]); ?> </label>					</td>
					<td>
						<?php 
							echo $siteweb->sel_option_search_entier(array( "class" => "texte_gris" , "name" => "sel_option_dureeworkflow")
							 , $sel_option_dureeworkflow , ucfirst($translate["choisissez"])); 
						?>
					<input name="dureeworkflow" type="text" class="inputbox" id="dureeworkflow" value="<?php echo $dureeworkflow; ?>" size="50" />
					</td>
				</tr>
				<tr>
					<td class="key">
						<label for="name"><?php echo ucfirst($translate['etat']); ?></label>
					</td>
					<td>&nbsp;&nbsp;
						<?php
						echo $lworkflow->sel_option_etat_workflow(array( "class" => "texte_gris" , "name" => "sel_option_etat[]" , "value"=>"{$sel_option_etat}" , "id" => "sel_option_etat[]" ) , $sel_option_etat , ucfirst($translate["choisissez"]));
						?>
					</td>
				</tr>								
				<tr>
					<td colspan="3" align="center">
						<br/>
						<input type="submit" onclick="javascript:document.form_workflow_search.submit();" value="<?php echo ucfirst($translate["rechercher"]); ?>" />
						<input type="submit" onclick="javascript:document.form_workflow_search.libworkflow.value = '';document.form_workflow_search.dureeworkflow.value = '';document.form_workflow_search.dat_deb_creation.value = '';document.form_workflow_search.dat_fin_creation.value = '';" value="<?php echo ucfirst($translate["recommencer"]); ?>"></input>
					
					</td>
				</tr>				
	    </table>
		</fieldset>
		</form>
		</td>
	</tr>	
	<tr>
		<td>
			<?php
				echo $result_recherche_workflow;
			?>
		</td>
	</tr>
</table>