<?php
/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Circuit
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @licence			INTERFACE SA
 * @author 			Bello Adamou <moustaphbi@yahoo.fr> 
 * @desc			script pour la fabrication de la grille d'accueil des tâches de chaque utilisateur				
 * @creationdate	Jeudi 01 juillet 2010
 */
    //print_r($listemestaches);die("Word completion");
	$btn_nouveau = "";
    if(! is_null($listemestaches))
	{	
	   //charger l'unité de durée des taches
	   //chargement des spécifications de la classe processus
	   require_once($siteweb->get_document_root().DS."administration".DS."classe".DS."config.class.php");
	   //instancier un objet configuration
	   $lconfig2 = new Config();
	   //charger la configuration unite_durée
	   $unite_duree =  $lconfig2->charger();
	   switch (intval($lconfig2->uniteduree_tache))
	   {
	   		case 1 :
	   			$unite_duree_tache = $translate["heure"]."(s)";
	   			break;
	   		case 2 :
	   			$unite_duree_tache = $translate["jour"]."(s)";
	   			break;
	   		case 3 :
	   			$unite_duree_tache = $translate["mois"]."(s)";
	   			break;
			default:
				$unite_duree_tache = $translate["jour"]."(s)";
				break;
	   }
	   
	   unset($lconfig2);
		
	$nbr_workflow = count($listemestaches);
	if ($nbr_workflow > 0)
	{
		$limit = $siteweb->get_record_per_page();
		
		if ($limit > 0)
		{
			if (isset($_GET['orderBy']) && in_array($_GET['orderBy'], array('numtache', 'libtache', 'dureetache')))
			{
				$setDefaultSortDeliv = array($_GET['orderBy'] => $_GET['direction']);
			}
			else 
			{
				$setDefaultSortDeliv = array('libtache' => 'ASC');
			}
				$ldata_grid_workflow =& new Structures_DataGrid($limit);				
				$ldata_grid_workflow->sortRecordSet($setDefaultSortDeliv);
				
				if ($listemestaches) 
				{
					$count = count($listemestaches);					 
					$ldata_grid_workflow->_dataSource =& $ldata_grid_workflow->loadDriver(Structures_DataGrid_DataSource_Array);
					$ldata_grid_workflow->bind($listemestaches);
				}//if ($listemestaches) 
				else $count = 0;
				
				//Fonction qui formatte le contenu de la colonne Numéro
				function format_numtache ($params)
				{
					global $siteweb , $lang , $login;
					extract($params);
					
					$request['numtache'] = $record['numtache'];
					$request['lang'] = $lang;
					$request['login'] = $login;
					$request['do'] = "tache_view";
					$query = http_build_query($request);
					$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['numtache']."</a>";
	
					return $detail;
				}
				
				//Fonction qui formatte le contenu de la colonne Libellé
				function format_libtache ($params)
				{
					global $siteweb , $lang , $login;
					extract($params);
					
					$request['libtache'] = $record['libtache'];
					$request['lang'] = $lang;
					$request['login'] = $login;
					$request['do'] = "tache_view";
					$query = http_build_query($request);
					$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['libtache']."</a>";
	
					return $detail;
				}
				
				//Fonction qui formatte le contenu de la colonne Tache précédente
				function format_libtacheprec ($params)
				{
					global $siteweb , $lang , $login , $translate;
					extract($params);

					if (trim($record["numtacheprec"]) == "")
						$detail = ucfirst($translate["aucune"]);
					else
					{
						$request['numtacheprec'] = $record['numtacheprec'];
						$request['lang'] = $lang;
						$request['login'] = $login;
						$request['do'] = "tache_view";
						$query = http_build_query($request);
						$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['libtacheprec']."</a>";
					}
	
					return $detail;
				}
				
				//Fonction qui formatte le contenu de la colonne Tache suivante
				function format_libtachesuiv ($params)
				{
					global $siteweb , $lang , $login , $translate;
					extract($params);

					if (trim($record["numtachesuiv"]) == "")
						$detail = ucfirst($translate["aucune"]);
					else
					{
						$request['numtachesuiv'] = $record['numtachesuiv'];
						$request['lang'] = $lang;
						$request['login'] = $login;
						$request['do'] = "tache_view";
						$query = http_build_query($request);
						$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['libtachesuiv']."</a>";
					}	
					return $detail;
				}
				
				//Fonction qui formatte le contenu de la colonne Durée
				function format_dureetache ($params)
				{
					global $siteweb , $lang , $login , $translate , $unite_duree_tache;
					extract($params);
					
					$request['dureetache'] = $record['dureetache'];
					$request['sel_option_dureetache'] = 0;	//option est égal à
					$request['lang'] = $lang;
					$request['login'] = $login;
					$request['do'] = "tache_search";
					$query = http_build_query($request);
					
					if ( (trim($record["dureetache"]) == "") || (intval($record["dureetache"]) == 0)) 
					     $detail = ucfirst($translate["aucune"]); 
					else 
					$detail =  "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['dureetache']."</a>"." ".$unite_duree_tache;
					
					return $detail;
				}
				
				//Fonction qui formatte le contenu de la colonne Acteur
				function format_acteur ($params)
				{
					global $siteweb , $lang , $login , $translate;
					extract($params);
					 
					if ( (trim($record["codeuser"]) == "") || (intval($record["codeuser"]) == -1))
						$detail = ucfirst($translate["aucun"]);
					else	
					{
						$request['codeuser'] = $record['codeuser'];
						$request['lang'] = $lang;
						$request['login'] = $login;
						$request['do'] = "user_view";
						$query = http_build_query($request);
						$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['nomuser']." ".$record["prenomuser"]. "</a>";
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
						$request['do'] = "profil_view";
						$query = http_build_query($request);
						$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['codeprofil']."</a>";
					}
					
					return $detail;
					
				}

								
				function printUserSelector2($params)  
				 {  
					 extract($params);
					 if (trim($record["codeuser"]) == "") return $record["nomuser"] . " ". $record["prenomuser"];
					 else return $record["libprofil"];
				 }  
				 
				 function printProfilSelector()  
				 {  
				 	global $select_profil;
				 	return $select_profil;  
				 }  
				 
				 function printTacheSelector($params)  
				 {  
				 	extract($params);

				 	$detail = $record["libtache"];  
				 	$detail .= "<input id=\"sel_tache".($currRow+1)."\" type=\"hidden\" value=\"".trim($record["numtache"])."\" name=\"sel_tache".($currRow+1)."\" />";
				 	return $detail;
				 }
				 
				 function format_tache_prec($params)  
				 {  
				 	global $translate;
				 	
				 	extract($params);
				 	if (trim($record["numtacheprec"]) == "") $detail = ucfirst($translate["aucune"]);
					else 	$detail = $record["libtacheprec"];  
					
					$detail .= "<input id=\"sel_tache_prec".($currRow+1)."\" type=\"hidden\" value=\"".trim($record["numtacheprec"])."\" name=\"sel_tache_prec".($currRow+1)."\" />";
				 	return $detail;
				 }
				 
				 function format_acteur_profil($params)  
				 {  				 	
				 	global $translate;
				 	extract($params);
				 	
				 	if ( (trim($record["codeuser"]) != "") && (intval($record["codeuser"]) != -1) )
				 	{
				 		$lvaleur = "acteur:".$record["codeuser"];
				 		$lcode = ucfirst($translate["utilisateur"])." ".$record["nomuser"]." ".$record["prenomuser"];
				 		//$lcode = ucfirst($listenominitiateur[0][0]["nomuser"]." ".$listenominitiateur[0][0]["prenomuser"]);
				 		
				 	}
				 	else 
				 	{
				 		$lvaleur = "profil:".$record["codeprofil"];	
				 		$lcode = ucfirst($translate["fonction"])." ".$record["libprofil"];
				 	}
				 	$detail = $lcode;
				 	$detail .= "<input id=\"sel_acteur".($currRow+1)."\" type=\"hidden\" value=\"{$lvaleur}\" name=\"sel_acteur".($currRow+1)."\" />";
				 	
				 	return $detail;
				 }  
				 
				//Fonction qui formatte le contenu de la colonne Supprimer
				function format_supprimer ($params)
				{
					global $siteweb , $translate;
					extract($params);
				}
				
				//Fonction qui formatte le contenu de la colonne Circuit
				function format_circuit_workflow ($params)
				{
					global $siteweb , $lang , $login;
					extract($params);
					
					$request['codecircuit'] = $record['codecircuit'];
					$request['lang'] = $lang;
					$request['do'] = "circuit_view";
					$query = http_build_query($request);
					$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['libcircuit']."</a>";

					return $detail;
				}
	
				//Fonction qui formatte le contenu de la colonne Date de début d'un workflow
				function format_date_debut_workflow ($params)
				{
					global $siteweb , $lang , $login;
					extract($params);
					
					$detail = $record["datedebutwf"]." ".$record["heuredebutwf"];

					return $detail;
				}
				
				//Fonction qui formate les liens de la colonne "document" de la grille 
				function format_document($params)
				{
					global $siteweb , $lang;
					extract($params);
					
					$request['do'] = "doc_view";
					$request['lang'] = $lang;
					$request['numworkflow'] = $record['numworkflow'];
					$request['numdoc'] = $record['numdoc']; 
					$request['typedoc'] = $record['typedoc'];
					$request['codecircuit'] = $record['codecircuit'];
					$request['numtache'] = $record['numtache'];

					$query = http_build_query($request);
					$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".ucfirst($record['titredoc'])."</a>";
					return $detail;
				}
				
				//Fonction qui formatte le contenu de la colonne des actions
				function format_option_workflow ($params)
				{
					global $translate , $siteweb;
					extract($params);
					
					$lretval = "
					<a title=\"".ucfirst($translate["supprimer"])."\" onclick=\"javascript:on_workflow_delete();\" href=\"#\"><img src=\"" . $siteweb->get_url(). "/images/edit_remove.gif\"/></a>
					<input id=\"position".($currRow+1)."\" type=\"hidden\" value=\"".($currRow+1)."\" name=\"position".($currRow+1)."\"/>
					";
					//$lretval = "<a href=\"#\" title=\"".ucfirst($translate["supprimer"])."\" onclick=\"javascript:on_circuit_remove_tache('form_circuit_view' , 'table_taches' , 'ligne{$currRow}');\" ><img src=\"".$siteweb->get_url()."/images/edit_remove.gif"."\" /></a>";
					return $lretval;
				}
				
				//Fonction qui formatte le contenu de la colonne durée workflow
				function format_duree_workflow($params)
				{
					global $siteweb , $lang , $unite_duree_tache , $translate;
					extract($params);
					
					if ( (trim($record["dureewf"]) == "") || (intval($record["dureewf"]) == 0)) 
					     $detail = ucfirst($translate["aucune"]);
					else $detail =  $record["dureewf"]." ".$unite_duree_tache;
					
					return $detail;
				}
								
				//Fonction qui formatte le contenu de la colonne Numéro workflow
				function format_numworkflow ($params)
				{
					global $siteweb , $lang , $login;
					extract($params);
					
					$request['numworkflow'] = $record['numworkflow'];
					$request['lang'] = $lang;
					$request['do'] = "workflow_view";
					$query = http_build_query($request);
					$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['numworkflow']."</a>";

					return $detail;
				}  			

				        //l'affichage des colonnes de la grille des tâches va varier suivant la page web en cours
				        $ldata_grid_workflow->addColumn(new Structures_DataGrid_Column(ucfirst($translate["numworkflow"]), 'numworkflow', 'numworkflow' , array("align"=>"center" , "width" => "10%") , null , null));
						$ldata_grid_workflow->addColumn(new Structures_DataGrid_Column(ucfirst($translate["circuit"]), 'libcircuit', 'libcircuit' , array("align"=>"center" , "width" => "10%") , null , null));
						//$ldata_grid_workflow->addColumn(new Structures_DataGrid_Column(ucfirst($translate["acteur"]), null, null , array("align"=>"center" , "width" => "10%") , null , 'format_acteur_profil()'));
						$ldata_grid_workflow->addColumn(new Structures_DataGrid_Column(ucfirst($translate["datedebutworkflow"]), 'datedebutwf', 'datedebutwf' , array("align"=>"center" , "width" => "10%") , null , 'format_date_debut_workflow()'));
						$ldata_grid_workflow->addColumn(new Structures_DataGrid_Column(ucfirst($translate["document"]), 'titredoc', 'titredoc' , array("align"=>"center") , null , 'format_document()' ));
						//$ldata_grid_workflow->addColumn(new Structures_DataGrid_Column(ucfirst($translate["expediteur"]), 'datedebutwf', 'datedebutworkfl' , array("align"=>"center" , "width" => "10%")));
						//$ldata_grid_workflow->addColumn(new Structures_DataGrid_Column(ucfirst($translate["tache_precedente"]), 'libtacheprec', 'libtacheprec' , array("align"=>"center" , "width" => "10%") , null , 'format_libtacheprec()'));
						$ldata_grid_workflow->addColumn(new Structures_DataGrid_Column(ucfirst($translate["tache"]), 'libtache', 'libtache', array("align"=>"center" , "width" => "20%") , null , null));			
						//$ldata_grid_workflow->addColumn(new Structures_DataGrid_Column(ucfirst($translate["tache_suivante"]), 'litachesuiv', 'libtachesuiv' , array("align"=>"center" , "width" => "10%") , null));
						$ldata_grid_workflow->addColumn(new Structures_DataGrid_Column(ucfirst($translate["duree"]), 'dureetache', 'dureetache', array("align"=>"center" , "width" => "10%") , null , 'format_duree_workflow()' ));										
						$ldata_grid_workflow->addColumn(new Structures_DataGrid_Column(ucfirst($translate["options"]), null, null, array("align"=>"center" , "width" => "10%") , null , null ));	
				
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
		//	    'class' => 'listResultsRowHover'
				);	
				
				$table = new HTML_Table($tableAttribs);
				$tableHeader =& $table->getHeader();
				$tableBody =& $table->getBody();	
								
				if ($count > 0){
					$test = $ldata_grid_workflow->fill($table, $rendererOptions);
					if (PEAR::isError($test)) {
	
						$result_recherche_mestaches = $test->getMessage();
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
				$lpager = $ldata_grid_workflow->getOutput(DATAGRID_RENDER_PAGER);
				// Affichage de la table et des liens page par page
				$result_recherche_mestaches = $btn_nouveau;
				 
				$result_recherche_mestaches .= "<center>{$title}</center><br/><center>{$lpager}</center>";
				
				$result_recherche_mestaches .= $table->toHtml();
				
			}//if ($limit > 0)
						
		}//if ($nbr_workflow > 0)
		else
		{
			
			$result_recherche_mestaches .= ucfirst($translate["any_workflow_found"]);
			
		}
	}
	else
	{
		$result_recherche_mestaches .= ucfirst($translate["any_workflow_found"]);
	}
	
?>