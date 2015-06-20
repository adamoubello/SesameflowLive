<?php 
/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Circuit
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Patrick Mveng<patrick.mveng@interfacesa.local>
 * @desc			script de prétraitement pour la fabrication de la grille résultat d'une recherche des circuits
 * 					Ce script est une boite noire réutilisable pour affiche une grille de circuits
 * 
 * @param 			$listecircuit - tableau de circuits issus de la recherche depuis la base de données
 * @param 			$translate - tableau de traductions dans la langue en cours
 * @param 			$do	- code de la page web en cours. Suivant la page web, le nombre de colonnes de la grille varie
 * 
 * @link 			Liste des circuits associés à un document formulaire
 * 					Liste des circuits achevés
 * @creationdate	samedi 27 juin 2009
 * @updates
 */
?>
<?php
	ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	
	global $translate , $listecircuit;
	
		switch(trim($do))
		{
			case "processus_view" :
				$btn_nouveau = "<p align=\"right\"><input type=\"button\" value=\"".ucfirst($translate["nouveau"])."\"  onclick=\"window.location = '" . $siteweb->get_url()."/gabarit/page.gabarit.php?lang={$lang}&login={$login}&do=cir_create1&numprocessus=".$numprocessus."';\" /></p>";				
				break;
			default:
				$btn_nouveau = "";
				break;	
		}
	
	
	if(! is_null($listecircuit))
	{
		$nbr_doc = count($listecircuit);
		
		if ($nbr_doc > 0) {
			$limit = $siteweb->get_record_per_page();
			
			$_GET["do"] = $do;
			$_GET["login"] = $login;
			$_GET["lang"] = $lang;
			if (isset($typedoc)) $_GET["typedoc"] = $typedoc;
			
			if ($limit > 0)	{
				if (isset($_GET['orderBy']) && in_array($_GET['orderBy'], array('numdoc', 'titredoc', 'datecreation', 'codeuser'))) {
					$setDefaultSortDeliv = array($_GET['orderBy'] => $_GET['direction']);
				}
				else {
					$setDefaultSortDeliv = array('titredoc' => 'ASC');
				}
				$ldata_grid_circuit =& new Structures_DataGrid($limit);
				$ldata_grid_circuit->sortRecordSet($setDefaultSortDeliv);
				
				if ($listecircuit) {
					$count = count($listecircuit);
					$NbDelivForSel  = ($limit > $count) ? $count : $limit;
					$ldata_grid_circuit->_dataSource =& $ldata_grid_circuit->loadDriver(Structures_DataGrid_DataSource_Array);
					$ldata_grid_circuit->bind($listecircuit);
				}
				else {
					$count = 0;
				}
				
				//Fonction qui formatte le contenu de la colonne Numéro
				function format_numcircuit ($params)
				{
					global $siteweb , $lang , $login;
					extract($params);
					
					$request['codecircuit'] = $record['codecircuit'];
					$request['lang'] = $lang;
					$request['login'] = $login;
					$request['do'] = "circuit_view";
					$query = http_build_query($request);
					$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['codecircuit']."</a>";

					return $detail;
				}
				
				//Fonction qui formatte le contenu de la colonne Libellé
				function format_libcircuit ($params)
				{
					global $siteweb , $lang , $login;
					extract($params);
					
					$request['codecircuit'] = $record['codecircuit'];
					$request['lang'] = $lang;
					$request['login'] = $login;
					$request['do'] = "circuit_view";
					$query = http_build_query($request);
					$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['libcircuit']."</a>";

					return $detail;
				}
				
				//Fonction qui formatte le contenu de la colonne Durée
				function format_dureecircuit ($params)
				{
					global $siteweb , $lang , $unite_duree_circuit , $translate;
					extract($params);
					
					$request['dureecircuit'] = $record['dureecircuit'];
					$request['sel_option_dureecircuit'] = 0;	//option est égal à
					$request['lang'] = $lang;
					$request['login'] = $login;
					$request['do'] = "circuit_search";
					$query = http_build_query($request);
					
					if ( (trim($record["dureecircuit"]) == "") || (intval($record["dureecircuit"]) == 0)) $detail = ucfirst($translate["aucune"]);
					else $detail =  "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['dureecircuit']."</a>"." ".$unite_duree_circuit;

					return $detail;
				}
				
				//Fonction qui formatte le contenu de la colonne Processus
				function format_processus_circuit ($params)
				{
					global $siteweb , $lang , $login;
					extract($params);
					
					$request['numprocessus'] = $record['numprocessus'];
					$request['lang'] = $lang;
					$request['login'] = $login;
					$request['do'] = "processus_view";
					$query = http_build_query($request);
					$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['libprocessus']."</a>";

					return $detail;
				}				
										
					//Ajout des colonnes au Datagrid
					$ldata_grid_circuit->addColumn(new Structures_DataGrid_Column(ucfirst($translate["numero"]), 'codecircuit', 'codecircuit' , array("align"=>"center" , "width" => "10%") , null , 'format_numcircuit()'));
					$ldata_grid_circuit->addColumn(new Structures_DataGrid_Column(ucfirst($translate["libelle"]), 'libcircuit', 'libcircuit', null , null , 'format_libcircuit()'));				
					$ldata_grid_circuit->addColumn(new Structures_DataGrid_Column(ucfirst($translate["duree"]), 'dureecircuit', 'dureecircuit', array("align"=>"center" , "width" => "10%") , null , 'format_dureecircuit()'));				
					$ldata_grid_circuit->addColumn(new Structures_DataGrid_Column(ucfirst($translate["processus"]), 'libprocessus', 'libprocessus', array("align"=>"center" , "width" => "20%") , null , 'format_processus_circuit()'));				
										
					
					// Définition de l'apparence
					$tableAttribs = array(
						'cellspacing' => '1',
						'cellpadding' => '4',
						'border' => '0',
						'width' => '100%',
						'class' => 'adminlist'
					);
					$headerAttribs = array(
						'bgcolor' => '#CCCCCC',
						'class' => 'listResultsHeading'
					);
					$evenRowAttribs = array(
						'bgcolor' => '#FFFFF0',
						/*'class' => 'texte_noir2'*/
						'class' => 'row0'
					);
					$oddRowAttribs = array(
						'bgcolor' => '#EEEEEE',
						/*'class' => 'listResultsRowOdd'*/
						'class' => 'row1'
					);
					$rendererOptions = array('sortIconASC' => '&uArr;','sortIconDESC' => '&dArr;');
					
									
					$table = new HTML_Table($tableAttribs);
					$tableHeader =& $table->getHeader();
					$tableBody =& $table->getBody();

					if ($count > 0){
						$test = $ldata_grid_circuit->fill($table, $rendererOptions);
						if (PEAR::isError($test)) {

							$result_recherche_circuit = $test->getMessage();
							
						}
					}

					// Définition des attributs pour la ligne d'en-tête
					$tableHeader->setRowAttributes(0, $headerAttribs);
	
					// Définition des attributs de lignes alternativement
					$tableBody->altRowAttributes(0, $evenRowAttribs, $oddRowAttribs, true);
	
					// Définition du titre de la page
	
					$title = $siteweb->set_short_list_title(null, $count, $limit);
					
					// Affichage des liens page par page
					$lpager = $ldata_grid_circuit->getOutput(DATAGRID_RENDER_PAGER);
					$result_recherche_circuit = $btn_nouveau;
					// Affichage de la table et des liens page par page
					$result_recherche_circuit .= "<center>{$title}</center><br/><center>{$lpager}</center>";
					$result_recherche_circuit .= $table->toHtml();
	

			}		//if ($limit > 0)
		}//if(! is_null($listecircuit))
		else 
		{
			$result_recherche_circuit = $btn_nouveau;
			$result_recherche_circuit .= ucfirst($translate["any_circuit_found"]);
		}
	}
	else 
	{
		$result_recherche_circuit = $btn_nouveau;
		$result_recherche_circuit .= ucfirst($translate["any_circuit_found"]);
	}	
?>