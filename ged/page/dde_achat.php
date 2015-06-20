<?php
/**
 * @version			1.0
 * @package			GED
 * @subpackage		Document
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			William<william.nkingne@laposte.net>
 * @desc			Script pour l'affichage du formulaire de demande de crédit
 * @creationdate	samedi 27 juin 2009
 * @updates
 * @todo
 */
 
     $chemin = dirname(__FILE__);  
	$chemin = str_replace("\ged\page","",$chemin);
    
	require_once($chemin.'\classe\application.class.php');	
	require_once($chemin.'\ged\lang\ged.'.$lang.'.php');	
	$siteweb = new Application();
	global $siteweb;
    require_once($siteweb->get_document_root().'\ged\\traitements\\tformulaire_create.php');
	
?>

	<script type="text/javascript" src="<?php $siteweb->get_url()."/ged/js/ged.js"?>"></script>
	
<?php
  
//Fonctions utilisées dans le datagrid
function printCheckbox($params)
{
extract($params);
return '<input type="checkbox" name="idList[]" value="' . $record['nomuser'] . '">';
}

function printFullName($params)
{
extract($params);
return $record['nomuser'];
}

function printListeDeroulante()
{
echo('<select name="table">');
while ($tableaudep) 
{
echo('<option>'.$tableaudep->libdep.'</option>'); 
} 
echo('</select>'); 
}

function printUserSelector2()  
 {  
	global $select_user;
	$select_user_i = str_replace("sel_acteur" , "sel_acteur".$currRow , $select_user);
	return $select_user_i;  
 }  
 
 function printProfilSelector()  
 {  
 	global $select_profil;
 	return $select_profil;  
 }  
 
 function printTacheSelector()  
 {  
    global $select_tache;
    return $select_tache;  
 }
 
?>

<form action="<?php echo $siteweb->get_url()."/ged/traitements/partie_centrale.php" ?>" method="post" name="form_doc_view" id="form_doc_view"   >
	<input type="hidden" id="typedoc" name="typedoc" value="dde_achat"  />
	<input type="hidden" id="lang" name="lang" value="<?php echo $lang; ?>"  />
	<input type="hidden" id="login" name="login" value="<?php echo $login; ?>"  />
	<input type="hidden" id="do" name="do" value="doc_create_valid"  />
	<input type="hidden" id="liste_elements" name="liste_elements" value=""  />
	<input type="hidden" id="titredoc" name="titredoc" value="demande de crédit"  />
	<input type="hidden" id="codeuser" name="codeuser" value="<?php echo $luser->codeuser; ?>"  />
	<input type="hidden" id="numtache" name="numtache" value="<?php echo $numtache; ?>"  />
	<input type="hidden" id="numtachesuiv" name="numtachesuiv" value="<?php echo $numtachesuiv; ?>"  />	
	<input type="hidden" id="numworkflow" name="numworkflow" value="<?php echo $numworkflow; ?>"  />	
	<input type="hidden" id="numdoc" name="numdoc" value="<?php echo $numdoc; ?>"  />
	<input type="hidden" id="codecircuit" name="codecircuit" value="<?php echo $codecircuit; ?>"  />
	<input type="hidden" id="nbr_achat" name="nbr_achat" value="0">
	<div>
	<fieldset class="adminform">
			<legend> <?php echo ucfirst($translate["infos"]); ?> </legend>
				<table class="admintable" cellspacing="1">
					<tr>
						<td width="150" class="key">
							<label for="name">
								<?php echo ucfirst($translate["auteur_dde"]); ?>
							</label>
						</td>
					  	<td>
							<?php echo $link_auteur  ; ?>
						</td>
					</tr>
					<tr>
						<td width="150" class="key">
							<label for="name">
								<?php echo ucfirst($translate["date_dde"]); ?>
							</label>
						</td>
					  	<td>
							<input disabled type="text" name="date_dde" id="date_dde" class="inputbox" size="40" value="<?php echo date("d/m/Y") ?>"/>
						</td>
					</tr>				
					<tr>
						<td width="150" class="key">
							<label for="name">
								<?php echo ucfirst($translate["heure_dde"]); ?>
							</label>
						</td>
						<td>
							<input disabled type="text" name="heure_dde" id="heure_dde" class="inputbox" size="40" value="<?php echo date("H:m:s") ?>" />							
						</td>
					</tr>				
			</table>
		</fieldset>
	</div>
	<div>
	  	<table>
			<tr>
				<td>
					<div>					
						<fieldset>
                            <legend><?php echo ucfirst($translate["detail_dde"]); ?> </legend>
                            <?php echo "<center>".ucfirst($translate["departement"])." : {$select_departement}</center><br/>";?>
                            <?php
							$listetache = array();

							// Création de la grille de données
							$datagrid =& new Structures_DataGrid($nbre); // Display 20 records per page

							// Spécifie comment la grille de données doit être triée par défaut
							$datagrid->setDefaultSort(array('nomuser' => 'ASC'));

							//On lie le conteneur DataSource : $listetesteur à la grille
							$test = $datagrid->bind($listetache);

                            if (PEAR::isError($test)){
								echo $test->getMessage();
							}

                            //Fonction qui formatte le contenu de la colonne Selection
							function format_selection ($params) {
								extract($params);
								return '<input type="radio" id="rdio_'.$currRow.'  name="rdio_"'.$currRow.'" title"'.ucfirst($translate["selection"]).'" />';
							}

                            //Fonction qui formatte le contenu de la colonne Supprimer
							function format_supprimer ($params)	{
								global $siteweb , $translate;
								extract($params);
							}

                            // Définition des colonnes
							$datagrid->addColumn(new Structures_DataGrid_Column(ucfirst($translate["designation"]).'<br><textarea name="designation" id="designation" cols="20" value=""/></textarea>', null, null, array('width' => '25%'), null, 'printUserSelector2()'));
						    $datagrid->addColumn(new Structures_DataGrid_Column(ucfirst($translate["objet"]).'<br><textarea  name="objet" id="objet" cols="20" value=""></textarea>', null, null, array('width' => '20%'), null, 'printTacheSelector()'));
							$datagrid->addColumn(new Structures_DataGrid_Column(ucfirst($translate["entre"])."<br><br>".$siteweb->date_tag(array("type" => "text" , "name" => "date_deb" , "id" => "date_deb" , "class" => "inputbox" , "size" => "11" , "value"=>"{$date_deb}" ) ,array("src" => $siteweb->get_url()."/images/cal.gif" , "id" => "img_dat_deb_achat" , "style" => "cursor: pointer; border: none;" , "title" => $translate["date_selector"]))));
							$datagrid->addColumn(new Structures_DataGrid_Column(ucfirst($translate["et"])."<br><br>".$siteweb->date_tag(array("type" => "text" , "name" => "date_fin" , "id" => "date_fin" , "class" => "inputbox" , "size" => "11" , "value"=>"{$date_fin}" ) ,array("src" => $siteweb->get_url()."/images/cal.gif" , "id" => "img_dat_fin_achat" , "style" => "cursor: pointer; border: none;" , "title" => $translate["date_selector"]))));
							$datagrid->addColumn(new Structures_DataGrid_Column(ucfirst($translate["observation"]).'<br><textarea  name="observation" id="observation" cols="20" value=""></textarea>', null, null, array('width' => '25%'), null, 'printTacheSelector()'));
							$datagrid->addColumn(new Structures_DataGrid_Column('<input  type="button" name="btn_ajout" id="btn_ajout" value="'.ucfirst($translate["ajouter"]).'" onclick="javascript:ajout_ligne(\''.$siteweb->get_url().'\');" />', null, null, array('width' => '1%'), null, 'format_selection()'));

                            // Définition de l'apparence
							$tableAttribs = array(
								'id' => 'table_achat',
								'name' => 'table_achat',
								'width' => '100%',
								'cellspacing' => '0',
								'cellpadding' => '4',
								'class' => 'adminList'
							);
							$headerAttribs = array(
								'bgcolor' => 'white'
							);
							$evenRowAttribs = array(
								'bgcolor' => '#FFFFFF'
							);
							$oddRowAttribs = array(
								'bgcolor' => '#EEEEEE'
							);
                            $rendererOptions = array(
								'sortIconASC' => '?',
								'sortIconDESC' => '?'
							);

                            // Création du tableau HTML
							$table = new HTML_Table($tableAttribs);
							$tableHeader =& $table->getHeader();
							$tableBody =& $table->getBody();

                            // Demande à la grille de données de remplir le tableau HTML avec les données, en utilisant les options d'affichage définies
							$test = $datagrid->fill($table, $rendererOptions);

                            if (PEAR::isError($test)) {
								echo $test->getMessage();
							}

                            // Définition des attributs pour la ligne d'en-tête
							$tableHeader->setRowAttributes(0, $headerAttribs);

							// Définition des attributs de lignes alternativement
							$tableBody->altRowAttributes(0, $evenRowAttribs, $oddRowAttribs, true);

							// Affichage de la table et des liens page par page
							echo $table->toHtml();

                            // Affichage des liens page par page
							if (PEAR::isError($test)) {
								echo $test->getMessage();
							}
                            ?>
						</fieldset>
					</div>
				</td>
			</tr>
		</table>
	</div>
</form>