<?php
/**
 * @version			1.0
 * @package			MAIL
 * @subpackage		Mail
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits r�serv�s
 * @license			INTERFACE SA
 * @author 			Rao�l Ngambia<ngambiaraoul@yahoo.fr>
 * @desc			Ce script permet de faire le pr�traitement pour la fabrication de la grille r�sultant d'une recherche de mail
 * 					dans le but d'afficher l'historique de l'envoi des mails
 * 					
 * 
 * @param 			$listemail - tableau de mails issus de la recherche depuis la base de donn�es
 * @param 			$translate - tableau de traductions dans la langue en cours
 * @param 			$do	- code de la page web en cours. Suivant la page web, le nombre de colonnes de la grille varie
 * 
 * @creationdate	Jeudi 13 Ao�t 2009
 * @updates
 */
?>
<?php
    
	global $translate , $listemail;
	
	

	switch(trim($do))
		{   		
			case "mail_view" :
				//$btn_nouveau = "<p align=\"right\"><input type=\"file\" id=\"chemin_acces\" name=\"chemin_acces\" size=\"40\" value=\"\"></p>";
				break;
			default:
				
				break;	
		}
	//print_r($data);
	if(! is_null($listemail))
	{
		$nbr_doc = count($listemail);
		
		if ($nbr_doc > 0) {
			$limit = $siteweb->get_record_per_page();
			
			$_GET["do"] = $do;
			$_GET["login"] = $login;
			$_GET["lang"] = $lang;
						
			if ($limit > 0)	{
				if (isset($_GET['orderBy']) && in_array($_GET['orderBy'], array('code_mail', 'sujet_mail', 'body_mail', 'auteur_mail'))) {
					$setDefaultSortDeliv = array($_GET['orderBy'] => $_GET['direction']);
				}
				else {
					$setDefaultSortDeliv = array('sujet_mail' => 'ASC');
				}
				$ldata_grid_mail =& new Structures_DataGrid($limit);
				$ldata_grid_mail->sortRecordSet($setDefaultSortDeliv);
				
				if ($listemail) {
					$count = count($listemail);
					$NbDelivForSel  = ($limit > $count) ? $count : $limit;
					$ldata_grid_mail->_dataSource =& $ldata_grid_mail->loadDriver(Structures_DataGrid_DataSource_Array);
					$ldata_grid_mail->bind($listemail);
				}
				else {
					$count = 0;
				}
				

					//Fonction qui formatte le contenu de la colonne ayant les cases � cocher
					function format_checkbox ($params)
					{
						global $ginterface;
						extract($params);
						
						return "<input type=\"checkbox\" id=\"cb{$currRow}\" name=\"cid[]\" value=\"".$record["code_mail"]."\" onclick=\"isChecked(this.checked);\" />";
			
					}
					
					function format_format_mail ($params)
					{
						global $translate;
						extract($params);
						
						switch(intval($record["format_mail"]))
						{
							case 1 : $lformat_envoi = "HTML";
								break;
							case 2 : $lformat_envoi = ucfirst($translate["texte"]);
								break;
							default: $lformat_envoi = "HTML";
								break;		
						}
						
					    return htmlspecialchars($lformat_envoi) ;
					}
					
					function format_sujet($params)
					{   
						global $translate , $siteweb , $lang , $do	 , $login;
						extract($params);
						
						$request['code_mail'] = $record['code_mail'];
						$request['lang'] = $lang;
						$request['login'] = $login;
						$request['do'] = "mail_view";

					    $query = http_build_query($request);
					    $detail = "<a title=\"".str_replace('"',"'",html_entity_decode(substr($record["body_mail"], 0 , 30)))."\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['sujet_mail']."</a>";
						
					    return $detail;
					}
									
					//Ajout des colonnes au Datagrid
					$ldata_grid_mail->addColumn(new Structures_DataGrid_Column(ucfirst( $translate["sujet"]), 'sujet_mail', 'sujet_mail' , null , null ,'format_sujet()' ));				
					$ldata_grid_mail->addColumn(new Structures_DataGrid_Column(ucfirst($translate["format_envoi"]),'format_mail', 'format_mail'  , null, null, 'format_format_mail()'));				
					$ldata_grid_mail->addColumn(new Structures_DataGrid_Column(ucfirst($translate["date_creation"]),'date_mail', 'date_mail' ));				

					
					
					// D�finition de l'apparence
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
						$test = $ldata_grid_mail->fill($table, $rendererOptions);
						if (PEAR::isError($test)) {

							$result_recherche_mail = $test->getMessage();
							
						}
					}

					// D�finition des attributs pour la ligne d'en-t�te
					$tableHeader->setRowAttributes(0, $headerAttribs);
	
					// D�finition des attributs de lignes alternativement
					$tableBody->altRowAttributes(0, $evenRowAttribs, $oddRowAttribs, true);
	
					// D�finition du titre de la page
	
					$title = $siteweb->set_short_list_title(null, $count, $limit);
	
					// Affichage des liens page par page
					$lpager = $ldata_grid_mail->getOutput(DATAGRID_RENDER_PAGER);
					$result_recherche_mail = $btn_nouveau;
					// Affichage de la table et des liens page par page
					$result_recherche_mail .= "<center>{$title}</center><br/><center>{$lpager}</center>";
					$result_recherche_mail .= $table->toHtml();

			}       //if ($limit > 0)
		}//if(! is_null($listemail))
		else
		{
			
			$result_recherche_mail .= ucfirst($translate["any_mail_found"]);
		}
	}
	else 
		{
			
			$result_recherche_mail .= ucfirst($translate["any_mail_found"]);
		}
?>