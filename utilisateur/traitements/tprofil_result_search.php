<?php
/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Profil
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou <moustaphbi@yahoo.fr> 
 * @desc			script de traitements pour le résultat d'une recherche de profil  					
 * @creationdate	20 Juillet 2009
 */

		switch(trim($do))
		{
			default:
				$btn_nouveau = "";
				break;	
		}

if(! is_null($listeprofil))
{
	$nbr_profil = count($listeprofil);
	if ($nbr_profil > 0)
	{
		$limit = $siteweb->get_record_per_page();
		
		if ($limit > 0)
		{
			if (isset($_GET['orderBy']) && in_array($_GET['orderBy'], array('codeprofil', 'libprofil')))
			{
				$setDefaultSortDeliv = array($_GET['orderBy'] => $_GET['direction']);
			}
			else 
			{
				$setDefaultSortDeliv = array('libprofil' => 'ASC');
			}
			
				$ldata_grid_profil =& new Structures_DataGrid($limit);
				
				$ldata_grid_profil->sortRecordSet($setDefaultSortDeliv);
				
				if ($listeprofil) 
				{
					$count = count($listeprofil);
					 
					$ldata_grid_profil->_dataSource =& $ldata_grid_profil->loadDriver(Structures_DataGrid_DataSource_Array);

					$ldata_grid_profil->bind($listeprofil);
				}//if ($listeprofil) 
				else $count = 0;
				
				//Fonction qui formatte le contenu de la colonne Code
				function format_codeprofil ($params)
				{
					global $siteweb , $lang , $login;
					extract($params);
					
					$request['codeprofil'] = $record['codeprofil'];
					$request['lang'] = $lang;
					$request['login'] = $login;
					$request['do'] = "profi_view";
					$query = http_build_query($request);
					$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['codeprofil']."</a>";
	
					return $detail;
				}
				
				//Fonction qui formatte le contenu de la colonne Libellé
				function format_libprofil ($params)
				{
					global $siteweb , $lang , $login;
					extract($params);
					
					$request['codeprofil'] = $record['codeprofil'];
					$request['lang'] = $lang;
					$request['login'] = $login;
					$request['do'] = "profi_view";
					$query = http_build_query($request);
					$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['libprofil']."</a>";
	
					return $detail;
				}
				
				//Fonction qui formatte le contenu de la colonne profil précédente
				function format_libprofilprec ($params)
				{
					global $siteweb , $lang , $login , $translate;
					extract($params);

					if (trim($record["codeprofilprec"]) == "")
						$detail = ucfirst($translate["aucune"]);
					else
					{
						$request['codeprofilprec'] = $record['codeprofilprec'];
						$request['lang'] = $lang;
						$request['login'] = $login;
						$request['do'] = "profi_view";
						$query = http_build_query($request);
						$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['libprofilprec']."</a>";
					}
	
					return $detail;
				}
				
				//Fonction qui formatte le contenu de la colonne profil suivante
				function format_libprofilsuiv ($params)
				{
					global $siteweb , $lang , $login , $translate;
					extract($params);

					if (trim($record["codeprofilsuiv"]) == "")
						$detail = ucfirst($translate["aucune"]);
					else
					{
						$request['codeprofilsuiv'] = $record['codeprofilsuiv'];
						$request['lang'] = $lang;
						$request['login'] = $login;
						$request['do'] = "profi_view";
						$query = http_build_query($request);
						$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['libprofilsuiv']."</a>";
					}
	
					return $detail;
				}

				//Fonction qui formatte le contenu de la colonne Profil
				function format_profil ($params)
				{
					global $siteweb , $lang , $login , $translate;
					extract($params);
					
					if ( (trim($record["codeprofil"]) == "") || (intval($record["codeprofil"]) == -1))
						$detail = ucfirst($translate["aucun"]);
					else
					{
						$request['codeprofil'] = $record['codeprofil'];
						$request['lang'] = $lang;
						$request['login'] = $login;
						$request['do'] = "profi_view";
						$query = http_build_query($request);
						$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['codeprofil']."</a>";
					}
					
					return $detail;
					
				}				

				//l'affichage des colonnes de la grille des profils va varier suivant la page web en cours
				switch(trim($do))
				{
					
					default:
				
						$ldata_grid_profil->addColumn(new Structures_DataGrid_Column(ucfirst($translate["code"]), 'codeprofil', 'codeprofil' , array("align"=>"center" , "width" => "10%") , null , 'format_codeprofil()'));
						$ldata_grid_profil->addColumn(new Structures_DataGrid_Column(ucfirst($translate["libelle"]), 'libprofil', 'libprofil', null , null , 'format_libprofil()'));				
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
		         //	'class' => 'listResultsRowHover'
				);	
				
				$table = new HTML_Table($tableAttribs);
				$tableHeader =& $table->getHeader();
				$tableBody =& $table->getBody();	
								
				if ($count > 0){
					$test = $ldata_grid_profil->fill($table, $rendererOptions);
					if (PEAR::isError($test)) {
	
						$result_recherche_profil = $test->getMessage();
						
					}
				}				
						
						// Définition des attributs pour la ligne d'en-tête
						$tableHeader->setRowAttributes(0, $headerAttribs);
						
						// Définition des attributs de lignes alternativement
						$tableBody->altRowAttributes(0, $evenRowAttribs, $oddRowAttribs, true);
						
						// Définition du titre de la page
						$title = $siteweb->set_short_list_title(null, $count, $limit);
						
						// Affichage des liens page par page
						$lpager = $ldata_grid_profil->getOutput(DATAGRID_RENDER_PAGER);
						// Affichage de la table et des liens page par page
						$result_recherche_profil = $btn_nouveau;
						$result_recherche_profil .= "<center>{$title}</center><br/><center>{$lpager}</center>";
						$result_recherche_profil .= $table->toHtml();
											
					
			}//if ($limit > 0)
						
		}//if ($nbr_profil > 0)
		else
		{
			$result_recherche_profil = $btn_nouveau;
			$result_recherche_profil .= ucfirst($translate["any_profil_found"]);
		}
	}
	else
	{
		$result_recherche_profil = $btn_nouveau;
		$result_recherche_profil .= ucfirst($translate["any_profil_found"]);
	}
	
?>