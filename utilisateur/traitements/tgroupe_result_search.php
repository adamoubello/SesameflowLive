<?php
/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Groupe
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			patrick mveng<patrick.mveng@interfacesa.local> 
 * @desc			script pour la fabrication de la grille ayant les groupes d'utilisateurs
 * 					
 * @creationdate	mardi 07 juillet 2009
 * @updates
 */
  if(! is_null($listegroupe))
	{   
		$nbr_groupe = count($listegroupe);
		if ($nbr_groupe > 0)
		{
			$limit = $siteweb->get_record_per_page();
			
			if ($limit > 0)
			{
				if (isset($_GET['orderBy']) && in_array($_GET['orderBy'], array('codegroup', 'libgroup')))
				{
					$setDefaultSortDeliv = array($_GET['orderBy'] => $_GET['direction']);
				}
				else 
				{
					$setDefaultSortDeliv = array('libgroup' => 'ASC');
				}
				
					$ldata_grid_groupe =& new Structures_DataGrid($limit);
					$ldata_grid_groupe->sortRecordSet($setDefaultSortDeliv);
					
					if ($listegroupe) 
					{
					$count = count($listegroupe);
					$NbDelivForSel  = ($limit > $count) ? $count : $limit;
					$ldata_grid_groupe->_dataSource =& $ldata_grid_groupe->loadDriver(Structures_DataGrid_DataSource_Array);
					$ldata_grid_groupe->bind($listegroupe);
					} 
					else $count = 0;
					
					//Fonction qui formatte le contenu de la colonne Code
					function format_codegroupe ($params)
					{
						global $siteweb , $lang , $login;
						extract($params);
						
						$request['codegroup'] = $record['codegroup'];
						$request['lang'] = $lang;
						$request['login'] = $login;
						$request['do'] = "groupe_view";
						$query = http_build_query($request);
						$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['codegroup']."</a>";

						return $detail;
					}
					
					//Fonction qui formatte le contenu de la colonne Libellé
					function format_libgroupe ($params)
					{
						global $siteweb , $lang , $login;
						extract($params);
						
						$request['codegroup'] = $record['codegroup'];
						$request['lang'] = $lang;
						$request['login'] = $login;
						$request['do'] = "groupe_view";
						$query = http_build_query($request);
						$llibgroupe = str_replace('\\', "" , $record['libgroup']);
						$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$llibgroupe."</a>";

						return $detail;
					}
					
					$ldata_grid_groupe->addColumn(new Structures_DataGrid_Column(ucfirst($translate["code"]), 'codegroup', 'codegroup' , array("align"=>"center" , "width" => "10%") , null , 'format_codegroupe()'));
					$ldata_grid_groupe->addColumn(new Structures_DataGrid_Column(ucfirst($translate["libelle"]), 'libgroup', 'libgroup', null , null , 'format_libgroupe()'));				
					
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
		        //'class' => 'listResultsRowHover'
				);	
				
				$table = new HTML_Table($tableAttribs);
				$tableHeader =& $table->getHeader();
				$tableBody =& $table->getBody();	
								
				if ($count > 0)
				{
					$test = $ldata_grid_groupe->fill($table, $rendererOptions);
					if (PEAR::isError($test)) 
					{
						$result_recherche_groupe = $test->getMessage();	
					}
				}				
				
				// Définition des attributs pour la ligne d'en-tête
				$tableHeader->setRowAttributes(0, $headerAttribs);
				
				// Définition des attributs de lignes alternativement
				$tableBody->altRowAttributes(0, $evenRowAttribs, $oddRowAttribs, true);
				
				// Définition du titre de la page
				$title = $siteweb->set_short_list_title(null, $count, $limit);
				
				// Affichage des liens page par page
				$lpager = $ldata_grid_groupe->getOutput(DATAGRID_RENDER_PAGER);
				// Affichage de la table et des liens page par page
				$result_recherche_groupe = "<center>{$title}</center><br/><center>{$lpager}</center>";
				$result_recherche_groupe .= $table->toHtml();
									
			}//if ($limit > 0)
									
		}//if(! is_null($listegroupe))
	
	else
{
	$result_recherche_groupe = ucfirst($translate["any_groupe_found"]);  
}
}
else 
{
	$result_recherche_groupe = "<center>".ucfirst($translate["any_groupe_found"])."</center>";  
}


?>