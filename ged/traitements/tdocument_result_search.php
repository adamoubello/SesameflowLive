<?php
/**
 * @version			1.0
 * @package			GED
 * @subpackage		Document
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Patrick Mveng<patrick.mveng@interfacesa.local>
 * @desc			script de prétraitement pour la fabrication de la grille résultat d'une recherche des documents
 * 					Ce script est une boite noire réutilisable pour affiche une grille de documents
 * 
 * @param 			$listedoc - tableau de documents issus de la recherche depuis la base de données
 * @param 			$translate - tableau de traductions dans la langue en cours
 * @param 			$do	- code de la page web en cours. Suivant la page web, le nombre de colonnes de la grille varie
 * @param 			$typedoc -  type du document pièce jointe : dde_credit , dde_conge, dde_achat, etc.
 * 
 * @link 			Liste des documents associés à un document formulaire
 * 					Liste des documents crées par un utilisateur.
 * @creationdate	samedi 20 juin 2009
 * @updates
 * 	# 22 juillet 2009 by patrick mveng
 * 		- si on est sur la fiche de consultation d'un formulaire ajouter un bouton supprimer sur chaque ligne de pièce jointe
						pour permettre le détachement d'une pièce jointe 
 */
?>
<?php
	ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2
	global $translate , $listedoc;

	switch(trim($do))
		{
			case "doc_view" :
			case "workflow_update" :
				
				//obtenir juste les paramètres	do=user_search&login=admin&lang=en
				$lparam_url = $_SERVER["QUERY_STRING"];
				
				$btn_nouveau = "<p align=\"right\"><input type=\"file\" id=\"chemin_acces\" name=\"chemin_acces\" size=\"40\" value=\"\"></p>";
				switch(trim(strtolower($typedoc)))
				{
					case "dde_credit" :
					case "dde_conge" :
						$btn_nouveau = "<p align=\"right\"><input type=\"file\" id=\"chemin_acces\" name=\"chemin_acces\" size=\"40\" value=\"\"> <input type=\"button\" onclick=\"javascript:on_add_doc_valid('{$lparam_url}');\"size=\"40\" value=\"".ucfirst($translate['ajout_doc'])."\"></p>";
						$btn_nouveau = "<form id=\"form_upload_doc\" method=\"POST\" name=\"form_upload_doc\" enctype=\"multipart/form-data\" accept-charset=\"utf-8\" action=\"".$siteweb->get_url()."/ged/traitements/partie_centrale.php"."\">
							<input type=\"hidden\" id=\"do\" name=\"do\" value=\"doc_add_file_valid\" />
							<input type=\"hidden\" id=\"login\" name=\"login\" value=\"{$login}\" />
							<input type=\"hidden\" id=\"lang\" name=\"lang\" value=\"{$lang}\" />
							<input type=\"hidden\" id=\"numdoc\" name=\"numdoc\" value=\"{$numdoc}\" />
							<input type=\"hidden\" id=\"typedoc\" name=\"typedoc\" value=\"{$typedoc}\" />
							<p align=\"right\">
							<input type=\"file\" id=\"chemin_acces\" name=\"chemin_acces\" size=\"40\" value=\"\" /> <input type=\"button\" onclick=\"javascript:document.getElementById('form_upload_doc').submit();\" size=\"40\" value=\"".ucfirst($translate['ajout_doc'])."\" />
							</p>
						</form>";
						//$btn_nouveau = "<p align=\"right\"><input type=\"file\" id=\"chemin_acces\" name=\"chemin_acces\" size=\"40\" value=\"\"><input type=\"button\" value=\"".ucfirst($translate["ajout_fichier"])."\"  onclick=\"window.location = '" . $siteweb->get_url()."/gabarit/page.gabarit.php?lang={$lang}&login={$login}&do=tache_create&numprocessus=".$numprocessus."';\" /></p>";
						break;
				}
				break;
			default:
				$btn_nouveau = "";
				break;	
		}

	if(! is_null($listedoc))
	{
		$nbr_doc = count($listedoc);
		
		
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
				$ldata_grid_doc =& new Structures_DataGrid($limit);
				$ldata_grid_doc->sortRecordSet($setDefaultSortDeliv);
				
				if ($listedoc) {
					$count = count($listedoc);
					$NbDelivForSel  = ($limit > $count) ? $count : $limit;
					$ldata_grid_doc->_dataSource =& $ldata_grid_doc->loadDriver(Structures_DataGrid_DataSource_Array);
					$ldata_grid_doc->bind($listedoc);
				}
				else {
					$count = 0;
				}
				
					//Fonction qui formatte le contenu de la colonne Code
					function format_numdoc ($params) {
						global $siteweb , $lang , $login;
						extract($params);
						
						$request['numdoc'] = $record['numdoc'];
						$request['typedoc'] = $record['typedoc'];
						$request['lang'] = $lang;
						$request['do'] = "doc_view";
						$request['login'] = $login;
						$query = http_build_query($request);
						$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['numdoc']."</a>";
						
						return $detail;
					}
					
					//Fonction qui formatte le contenu de la colonne Titre
					function format_titredoc ($params) {
						global $siteweb , $lang , $login;
						extract($params);
						
						switch (trim(strtolower($record["typedoc"])))
						{
							case "numeric" : $detail = $record['titredoc']; break;
							default: 
						
								$request['numdoc'] = $record['numdoc'];
								$request['typedoc'] = $record['typedoc'];
								$request['lang'] = $lang;
								$request['login'] = $login;
								$request['do'] = "doc_view";
								$query = http_build_query($request);
								$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['titredoc']."</a>";
							
							break;
							
						}
						
						return $detail;
					}
					
					//Fonction qui formatte le contenu de la colonne Auteur
					function format_auteurdoc ($params) {
						global $siteweb , $lang , $login;
						extract($params);
						$request['codeuser'] =$record['codeuser'];									
						$request['lang'] = $lang;					
						$request['login'] = $login;					
						$request['numdoc'] = $record['numdoc'];				
						$request['do'] = "user_view";
						$query = http_build_query($request);
						$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['nomuser']." ".$record['prenomuser']."</a>";
						
						return $detail;
					}
					
					//Fonction qui formatte le contenu de la colonne download
					function format_downloaddoc ($params) {
						global $siteweb , $lang , $login , $translate;
						extract($params);
						$request['lang'] = $lang;					
						$request['login'] = $login;					
						$request['numdoc'] = $record['numdoc'];				
						$request['typedoc'] = $record['typedoc'];
						$request['do'] = "doc_download_valid";
						$query = http_build_query($request);
						$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/ged/traitements/partie_centrale.php?$query\">".ucfirst($translate['telecharger'])."</a>";
						
						return $detail;
					}
					
					//Fonction qui formatte le contenu de la colonne Supprimer
					function format_deletedoc ($params) {
						global $siteweb , $lang , $login , $translate;
						extract($params);
						$request['lang'] = $lang;					
						$request['login'] = $login;					
						$request['numdoc'] = $record['numdoc'];				
						$request['typedoc'] = $record['typedoc'];				
						$request['do'] = "doc_delete_valid";
						$query = http_build_query($request);
						
						$detail = "<a href=\"".$siteweb->get_url()."/ged/traitements/partie_centrale.php?$query\">".ucfirst($translate['supprimer'])."</a>";
						
						return $detail;
					}
					
					//Fonction qui formatte le contenu de la colonne Date Création
					function format_datecreation ($params) {
						global $siteweb , $lang , $login , $doc;
						extract($params);
						$request = array();
						
						$record["datecreation"] = $doc->format_database2date($record['datecreation']);
						
						$ljour = substr(trim($record["datecreation"]), 0 , 2);
						$lmois = substr(trim($record["datecreation"]), 3 , 2);
						$lan = substr(trim($record["datecreation"]), 6 , 4);
						
						//fabriquer l'url pour redirection vers la recherche des documents créés le même mois
						$request['lang'] = $lang;					
						$request['login'] = $login;					
						$request['do'] = "doc_search";
						$request['dat_deb_creation'] = "01/".$lmois."/".$lan;
						
						//obtenir dynamiquement le dernier jour du mois en cours
						$lnbre_jr_dans_mois = date("t" , mktime(0,0,0,$lmois , $ljour , $lan));
						$request['dat_fin_creation'] = $lnbre_jr_dans_mois."/".$lmois."/".$lan;
						$query = http_build_query($request);
						$lurl_mois = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$lmois."</a>";
						
						
						//fabriquer l'url pour redirection vers la recherche des documents créés la même année
						$request = array();
						$request['lang'] = $lang;					
						$request['login'] = $login;					
						$request['do'] = "doc_search";
						$request['dat_deb_creation'] = "01/01/".$lan;
						$request['dat_fin_creation'] = "31/12/".$lan;
						$query = http_build_query($request);
						$lurl_an = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$lan."</a>";
						
						$detail = $ljour."/".$lurl_mois."/".$lurl_an;
						
						return $detail;
					}
										
					//Ajout des colonnes au Datagrid
//					$ldata_grid_doc->addColumn(new Structures_DataGrid_Column(ucfirst($translate["coe"]) , 'numdoc', 'numdoc' , null , null , 'format_numdoc()'));
					$ldata_grid_doc->addColumn(new Structures_DataGrid_Column(ucfirst($translate["titre"]), 'titredoc', 'titredoc', null , null , 'format_titredoc()'));
					$ldata_grid_doc->addColumn(new Structures_DataGrid_Column(ucfirst($translate["date_creation"]), 'datecreation', 'datecreation', null , null , 'format_datecreation()'));
					$ldata_grid_doc->addColumn(new Structures_DataGrid_Column(ucfirst($translate["heure_creation"]), 'heurecreation', 'heurecreation'));
					$ldata_grid_doc->addColumn(new Structures_DataGrid_Column(ucfirst($translate["auteur"]), 'codeuser', 'codeuser', null , null , 'format_auteurdoc()'));
					$ldata_grid_doc->addColumn(new Structures_DataGrid_Column(ucfirst($translate["telechargement"]), null, null, array("align"=>"center", "width" => "10%") , null , 'format_downloaddoc()'));
					/*
						si on est sur la fiche de consultation d'un formulaire ajouter un bouton supprimer sur chaque ligne de pièce jointe
						pour permettre le détachement d'une pièce jointe
					*/
					
					switch (trim(strtolower($do)))
					{
						case "doc_view" :
							$ldata_grid_doc->addColumn(new Structures_DataGrid_Column(ucfirst($translate["supprimer"]), null, null, array("align"=>"center", "width" => "10%") , null , 'format_deletedoc()'));
							break;
						default:
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
					$rendererOptions = array('sortIconASC' => '&uArr;','sortIconDESC' => '&dArr;');
					
					
									
					$table = new HTML_Table($tableAttribs);
					$tableHeader =& $table->getHeader();
					$tableBody =& $table->getBody();

					if ($count > 0){
						$test = $ldata_grid_doc->fill($table, $rendererOptions);
						if (PEAR::isError($test)) {
                            
							$result_recherche_doc = $test->getMessage();
							
						}
					}

					// Définition des attributs pour la ligne d'en-tête
					$tableHeader->setRowAttributes(0, $headerAttribs);
	
					// Définition des attributs de lignes alternativement
					$tableBody->altRowAttributes(0, $evenRowAttribs, $oddRowAttribs, true);
	
					// Définition du titre de la page	
					$title = $siteweb->set_short_list_title(null, $count, $limit);
	
					// Affichage des liens page par page
					$lpager = $ldata_grid_doc->getOutput(DATAGRID_RENDER_PAGER);
					$result_recherche_doc = $btn_nouveau;
					// Affichage de la table et des liens page par page
					$result_recherche_doc .= "<center>{$title}</center><br/><center>{$lpager}</center>";
					$result_recherche_doc .= $table->toHtml();
                    
			}       //if ($limit > 0)
		}//if(! is_null($listedoc))
		else
		{
			$result_recherche_doc = $btn_nouveau;
			$result_recherche_doc .= ucfirst($translate["any_doc_found"]);
		}
	}
	else 
		{
			$result_recherche_doc = $btn_nouveau;
			$result_recherche_doc .= ucfirst($translate["any_doc_found"]);
		}
?>