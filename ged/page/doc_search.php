 <?php
/**
 * @version			1.0
 * @package			GED
 * @subpackage		Document
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			William<william.nkingne@laposte.net>
 * @desc			script pour l'affichage de la page de recherche des documents
 * @creationdate	lundi 15 juin 2009
 * @updates
 * 	# samedi 20 juin 2009 (Patrick Mveng<patrick.mveng@interfacesa.local>)
 * 		- Intégration du paramètre login dans les fonctions de formatage du Datagrid
 * 		- Affichage du nom & prénom de l'auteur d'un document au lieu de son code utilisateur
 */

 $nbr_doc = 0;
 
 $chemin = dirname(__FILE__);
 $chemin = str_replace("\page","",$chemin);
 //require_once($chemin.'\lang\ged.'.$lang.'.php');
 
 ?>
 
<table width="100%">
	<tr>
		<td>		   
				<form action="page.gabarit.php?login=<?php echo $login ?>&lang=<?php echo $lang; ?>&do=doc_search" method="post" name="form_document_search">
					<input type="hidden" id="do" name="do" value="doc_search"  />
					<input type="hidden" id="lang" name="lang" value="<?php echo $lang; ?>"  />
					<input type="hidden" id="login" name="login" value="<?php echo $login; ?>"  />
						<fieldset class="adminform" >
							<legend><?php echo $translate['lib_doc_search'] ?></legend>
							<div id="div_doc_search">
								<table width="100%" cellspacing="1" class="admintable" hspace="123">
									<tr>
										<td class="key" width="30%">
											<label for="name"><?php echo $translate['par_titre'] ?></label>
										</td>
										<td width="60%" >&nbsp;&nbsp;
											<?php
											echo $siteweb->sel_option_search(array( "class" => "texte_gris" , "name" => "sel_option_titredoc")
											, $sel_option_titredoc , ucfirst($translate["choisissez"]));
											?>
											<input name="titredoc" type="text" class="inputbox" id="titredoc" value="<?php echo $titredoc; ?>" size="50" />
										</td>
									</tr>
									<!--<tr>
										<td class="key">
											<label for="name"><?php echo $translate['par_tag'] ?></label>
										</td>
										<td>
											<input name="tagdoc" type="text" class="inputbox" id="tagdoc" value="<?php echo $tagdoc; ?>" size="50" />
										</td>
									</tr>-->
									<tr>
										<td class="key">
											<label for="name"><?php echo $translate['par_date_creation'] ?></label>
										</td>
										<td><?php echo $translate['entre']; ?>&nbsp;&nbsp;<?php echo $siteweb->date_tag(array("type" => "text" , "name" => "dat_deb_creation" , "id" => "dat_deb_creation" , "class" => "inputbox" , "size" => "11" , "value"=>"{$dat_deb_creation}" ) ,array("src" => $siteweb->get_url()."/images/cal.gif" , "id" => "img_dat_deb_creation" , "style" => "cursor: pointer; border: none;" , "title" => $translate["date_selector"]));
											?>
											&nbsp;<?php echo $translate['et'];?>&nbsp;&nbsp;<?php echo $siteweb->date_tag(array("type" => "text" , "name" => "dat_fin_creation" , "id" => "dat_fin_creation" , "class" => "inputbox" , "size" => "11" , "value"=>"{$dat_fin_creation}" ) ,array("src" => $siteweb->get_url()."/images/cal.gif" , "id" => "img_dat_fin_creation" , "style" => "cursor: pointer; border: none;" , "title" => $translate["date_selector"]));
											?>
										</td>
									</tr>
									<tr>
										<td class="key">
											<label for="name"><?php echo $translate['par_date_modif'] ?></label>
										</td>
										<td><?php echo $translate['entre'];?>&nbsp;&nbsp;<?php echo $siteweb->date_tag(array("type" => "text" , "name" => "dat_deb_modif" , "id" => "dat_deb_modif" , "class" => "inputbox" , "size" => "11" , "value"=>"{$dat_deb_modif}" ) ,array("src" => $siteweb->get_url()."/images/cal.gif" , "id" => "img_dat_deb_modif" , "style" => "cursor: pointer; border: none;" , "title" => $translate["date_selector"]));
											?>
											&nbsp;<?php echo $translate['et'];?>&nbsp;&nbsp;<?php echo $siteweb->date_tag(array("type" => "text" , "name" => "dat_fin_modif" , "id" => "dat_fin_modif" , "class" => "inputbox" , "size" => "11" , "value"=>"{$dat_fin_modif}" ) ,array("src" => $siteweb->get_url()."/images/cal.gif" , "id" => "img_dat_fin_modif" , "style" => "cursor: pointer; border: none;" , "title" => $translate["date_selector"]));
											?>
										</td>
									</tr>
									<tr>
										<td class="key">
											<label for="name"><?php echo $translate['par_auteur'] ?></label>
										</td>
										<td >&nbsp;&nbsp;
											<?php
											echo $siteweb->sel_option_search(array( "class" => "texte_gris" , "name" => "sel_option_auteurdoc")
											, $sel_option_auteurdoc , ucfirst($translate["choisissez"]));
											?>
											<input name="auteurdoc" type="text" class="inputbox" id="auteurdoc" value="<?php echo $auteurdoc; ?>" size="50" />
										</td>
									</tr>
									<tr>
										<td class="key">
											<label for="name"><?php echo $translate['par_etat'] ?></label>
										</td>
										<td>&nbsp;&nbsp;
											<?php
											echo $siteweb->sel_doc_search(array( "class" => "texte_gris" , "name" => "sel_option_etat[]")
											, $sel_option_etat , ucfirst($translate["choisissez"]));
											?>
										</td>
									</tr>								
									<tr>
										<td colspan="2" align="center">
											<input type="button" onclick="javascript:document.form_document_search.submit();" value="<?php echo ucfirst($translate['rechercher']); ?>"/>
											<input type="button" onclick="javascript:document.form_document_search.reset();" value="<?php echo ucfirst($translate['recommencer']); ?>"/>
										</td>
									</tr>
								</table>
							</div>
						</fieldset>
				</form>
		</td>
	</tr>
</table>
<?php echo($result_recherche_doc);?>