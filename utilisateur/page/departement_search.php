
<?php
/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Département
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou <moustaphbi@yahoo.fr>
 * @desc			Script pour la fiche de recherche de département
 * @creationdate	15 Juillet 2009
 */	
?>

<table>
<td> 
	   <div align="center" style="display:block" >
				 <form action="page.gabarit.php?do=dep_search&lang=<?php echo $lang; ?>" method="post" name="form_departement_search">
					<input type="hidden" id="do" name="do" value="dep_search"  />
					<input type="hidden" id="lang" name="lang" value="<?php echo $lang; ?>"  />
					<input type="hidden" id="login" name="login" value="<?php echo $login; ?>"  />
					
		<fieldset class="adminform" >
		<legend><?php echo ucfirst($translate["recherche_dep"]); ?> </legend>
			<div id="div_dep_search">
			<table width="405" cellspacing="1" class="admintable" hspace="123">
				
				<tr>
				  <td class="key"> <label for="name"> <?php echo ucfirst($translate["libelle"]); ?> </label> </td>
					<td ><?php 
						echo $siteweb->sel_option_search(array( "class" => "texte_gris" , "name" => "sel_option_libdep")
							 , $sel_option_libdep , ucfirst($translate["choisissez"])); ?>
					</td>
				  <td>
				  <input name="libdep" type="text" class="inputbox" id="libdep" value="<?php echo $libdep; ?>" size="80" />
				  </td>
				
				</tr>
				<tr>
					<td colspan="3" align="center">
						<br/>
						<input type="submit" onclick="javascript:document.form_departement_search.submit();" value="<?php echo ucfirst($translate["rechercher"]); ?>" />
						<input type="button" onclick="javascript:document.form_departement_search.libdep.value = '';" value="<?php echo ucfirst($translate["recommencer"]); ?>"></input>
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
	echo $result_recherche_dep;
?>