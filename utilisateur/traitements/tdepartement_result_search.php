<?php
/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Département
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou<moustaphbi@yahoo.fr> 
 * @desc			script pour la fabrication de la grille d'affichage des département
 * @creationdate	mercredi 15 Juillet 2009
 */

		switch(trim($do))
		{
			default:
				$btn_nouveau = "";
				break;	
		}

if(! is_null($listedep))
{
	$nbr_dep = count($listedep);
	if ($nbr_dep > 0)
	{
		$limit = $siteweb->get_record_per_page();
		
		if ($limit > 0)
		{
			if (isset($_GET['orderBy']) && in_array($_GET['orderBy'], array('codedep', 'libdep')))
			{
			$setDefaultSortDeliv = array($_GET['orderBy'] => $_GET['direction']);
			}
			else 
			{
			$setDefaultSortDeliv = array('libdep' => 'ASC');
			}
			
				$ldata_grid_dep =& new Structures_DataGrid($limit);
				$ldata_grid_dep->sortRecordSet($setDefaultSortDeliv);
				
				if ($listedep) 
				{
					$count = count($listedep);
					 
					$ldata_grid_dep->_dataSource =& $ldata_grid_dep->loadDriver(Structures_DataGrid_DataSource_Array);

					$ldata_grid_dep->bind($listedep);
				}//if ($listedep) 
				else $count = 0;
				
				//Fonction qui formatte le contenu de la colonne Code
				function format_codedep ($params)
				{
					global $siteweb , $lang , $login;
					extract($params);
					
					$request['codedep'] = $record['codedep'];
					$request['lang'] = $lang;
					$request['login'] = $login;
					$request['do'] = "dep_view";
					$query = http_build_query($request);
					$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['codedep']."</a>";
	
					return $detail;
				}
				
				//Fonction qui formatte le contenu de la colonne Libellé
				function format_libdep ($params)
				{
					global $siteweb , $lang , $login;
					extract($params);
					
					$request['codedep'] = $record['codedep'];
					$request['lang'] = $lang;
					$request['login'] = $login;
					$request['do'] = "dep_view";
					$query = http_build_query($request);
					$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['libdep']."</a>";
	
					return $detail;
				}
				
				//Fonction qui formatte le contenu de la colonne departement précédente
				function format_libdepprec ($params)
				{
					global $siteweb , $lang , $login , $translate;
					extract($params);

					if (trim($record["codedepprec"]) == "")
						$detail = ucfirst($translate["aucune"]);
					else
					{
						$request['codedepprec'] = $record['codedepprec'];
						$request['lang'] = $lang;
						$request['login'] = $login;
						$request['do'] = "dep_view";
						$query = http_build_query($request);
						$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['libdepprec']."</a>";
					}
	
					return $detail;
				}
				
				//Fonction qui formatte le contenu de la colonne departement suivante
				function format_libdepsuiv ($params)
				{
					global $siteweb , $lang , $login , $translate;
					extract($params);

					if (trim($record["codedepsuiv"]) == "")
					$detail = ucfirst($translate["aucune"]);
					else
					{
						$request['codedepsuiv'] = $record['codedepsuiv'];
						$request['lang'] = $lang;
						$request['login'] = $login;
						$request['do'] = "dep_view";
						$query = http_build_query($request);
						$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['libdepsuiv']."</a>";
					}
	
					return $detail;
				}

				//l'affichage des colonnes de la grille des départements va varier suivant la page web en cours
				switch(trim($do))
				{
					case "circuit_view" :
						$ldata_grid_dep->addColumn(new Structures_DataGrid_Column(ucfirst($translate["dep_precedente"]), 'libdepprec', 'libdepprec' , array("align"=>"center" , "width" => "10%") , null , 'format_libdepprec()'));
						$ldata_grid_dep->addColumn(new Structures_DataGrid_Column(ucfirst($translate["dep"]), 'libdep', 'libdep', null , null , 'format_libdep()'));			
						$ldata_grid_dep->addColumn(new Structures_DataGrid_Column(ucfirst($translate["dep_suivante"]), 'lidepsuiv', 'libdepsuiv' , array("align"=>"center" , "width" => "10%") , null));			
					break;
				
					
					default:
						$ldata_grid_dep->addColumn(new Structures_DataGrid_Column(ucfirst($translate["code"]), 'codedep', 'codedep' , array("align"=>"center" , "width" => "10%") , null , 'format_codedep()'));
						$ldata_grid_dep->addColumn(new Structures_DataGrid_Column(ucfirst($translate["libelle"]), 'libdep', 'libdep', null , null , 'format_libdep()'));				
						break;
				}
				
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
					$rendererOptions = array(
					'sortIconASC' => '&uArr;',
					'sortIconDESC' => '&dArr;',
		           //*'class' => 'listResultsRowHover'
				);	
				
				$table = new HTML_Table($tableAttribs);
				$tableHeader =& $table->getHeader();
				$tableBody =& $table->getBody();	
								
				if ($count > 0){
					$test = $ldata_grid_dep->fill($table, $rendererOptions);
					if (PEAR::isError($test)) {
						$result_recherche_dep = $test->getMessage();
						//echo $test->getMessage();
					}
				}				
						
						// Définition des attributs pour la ligne d'en-tête
						$tableHeader->setRowAttributes(0, $headerAttribs);
						
						// Définition des attributs de lignes alternativement
						$tableBody->altRowAttributes(0, $evenRowAttribs, $oddRowAttribs, true);
						
						// Définition du titre de la page
						$title = $siteweb->set_short_list_title(null, $count, $limit);
						
						// Affichage des liens page par page
						$lpager = $ldata_grid_dep->getOutput(DATAGRID_RENDER_PAGER);
						// Affichage de la table et des liens page par page
						$result_recherche_dep = $btn_nouveau;
						$result_recherche_dep .= "<center>{$title}</center><br/><center>{$lpager}</center>";
						$result_recherche_dep .= $table->toHtml();
											
					
			}//if ($limit > 0)
						
		}//if ($nbr_dep > 0)
		else
		{
			$result_recherche_dep = $btn_nouveau;
			$result_recherche_dep .= ucfirst($translate["any_dep_found"]);
		}
	}
	else
	{
		$result_recherche_dep = $btn_nouveau;
		$result_recherche_dep .= ucfirst($translate["any_dep_found"]);
	}
	
?>