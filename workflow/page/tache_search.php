
<?php
/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Tache
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou <moustaphbi@yahoo.fr>
 * @desc			Script pour la fiche de recherche de tâches
 * @creationdate	???
 * @updates     
 */	
?>

<table>
<td> 
          <?php		  				  
			    $nbr_tache = 0;		  
           ?>        	
	   <div align="center" style="display:block" >
				 <form action="page.gabarit.php?do=tache_search&lang=<?php echo $lang; ?>" method="post" name="form_tache_search">
					<input type="hidden" id="do" name="do" value="tache_search"  />
					<input type="hidden" id="lang" name="lang" value="<?php echo $lang; ?>"  />
					<input type="hidden" id="login" name="login" value="<?php echo $login; ?>"  />
					
		<fieldset class="adminform" >
		<legend><?php echo ucfirst($translate["recherche_tache"]); ?> </legend>
			<div id="div_tache_search">
			<table width="405" cellspacing="1" class="admintable" hspace="123">
				
				<tr>
				  <td class="key"> <label for="name"> <?php echo ucfirst($translate["libelle"]); ?> </label> </td>
					<td ><?php 
						echo $siteweb->sel_option_search(array( "class" => "texte_gris" , "name" => "sel_option_libtache")
							 , $sel_option_libtache , ucfirst($translate["choisissez"])); ?>
					</td>
				  <td>
				  <input name="libtache" type="text" class="inputbox" id="libtache" value="<?php echo $libtache; ?>" size="80" />
				  </td>
				
				</tr>
				<tr>
					<td class="key">
						<label for="login"> <?php echo ucfirst($translate["duree"]); ?> </label>					</td>
					<td><?php 
echo $siteweb->sel_option_search_entier(array( "class" => "texte_gris" , "name" => "sel_option_dureetache")
							 , $sel_option_dureetache , ucfirst($translate["choisissez"])); 
					?></td>
					<td ><input name="dureetache" type="text" class="inputbox" id="dureetache" value="<?php echo $dureetache; ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td class="key">
						<label for="login"> <?php echo ucfirst($translate["processus"]); ?> </label>					</td>
					<td>
					<?php 
						echo $select_processus;
					?>
					</td>
					<td >&nbsp;</td>
				</tr>				
				<tr>
					<td colspan="3" align="center">
						<br/>
						<input type="submit" onclick="javascript:document.form_tache_search.submit();" value="<?php echo ucfirst($translate["rechercher"]); ?>" />
						<input type="button" onclick="javascript:document.form_tache_search.libtache.value = '';document.form_processus_search.dureetache.value = '';" value="<?php echo ucfirst($translate["recommencer"]); ?>"></input>
					</td>
				</tr>
	    </table></div>
		</fieldset>
		</form>
	</div>
	</td>
	</tr>
</table>
<?php
	echo $result_recherche_tache;
?>