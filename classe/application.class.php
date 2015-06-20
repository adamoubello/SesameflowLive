<?php

/**
 * @version		1.0
 * @package		Administration
 * @subpackage	Application
 * @copyright (C) 2009 INTERFACE SA. Tous droits réservés
 * @license		INTERFACE SA
 * @author 		Bello Adamou <moustaphbi@yahoo.fr>
 * @updates
 * 	#c samedi 20 juin 2009
 * 		- suppression de la fonction init()
 * 		- substitution de la fonction Table par le constructeur
 * 	# samedi 27 juin 2009
 * 		- ajout de la fonction redirection qui permet les redirection vers une autre page
 */

class Application
{
   public  $doc_root;
   public  $url;
   
   public  $typebd;
   public  $pwdbd;
   public  $hotebd;
   public  $hotesite;
   public  $portsite;
   public  $userbd;
   public  $nombd;
   public  $uniteduree;
   public  $listlimit;
   public  $notifmail;
   
   private $nbreligneparpage;
   private $dossier_plugin;	//Chemin d'accès au dossier des pluggins
   private $state;	//etat de l'application
   private $titre;	//titre à afficher dans la barre de titre du navigateur web
   public $version;	// version en cours de l'application
   private $maxfilesize;
   
   function __construct()
   {
      	 
      	      if (! defined("DS")) define("DS" , DIRECTORY_SEPARATOR);
      	     //$baseDir2 = str_replace('\\','/',dirname(__FILE__));	
      	     $baseDir2 = dirname(__FILE__);	
      	     //supprimer le dossier classe, afin d'obtenir la racine du répertoire virtuel en cours
      	     $baseDir2 = str_replace(DS."classe","",$baseDir2);
      	     $this->doc_root = $baseDir2;	
      	     unset($baseDir2);
      	     
      	     $this->url = "http://localhost/sesameflow";
      	    
			if ( $this->get_configuration($this->doc_root.DS."administration".DS."config.txt"));
			else 
			{
	      	      $this->dossier_plugin="/includes";
	      	     $this->nbreligneparpage=10 	;
		         $this->version = "1.0";
		         $this->maxfilesize= "1024*1024*1024";
		         $this->portsite = 80;
		         $this->hotesite = "localhost";
		         $this->uniteduree_process=1;	//en heure
				$this->uniteduree_circuit=1;	//en heure
				$this->uniteduree_tache=1;		//en heure
				$this->notifmail=0;	//NON
			}
   }

   public function get_document_root() {
   	return $this->doc_root;
   }
   
   public function get_max_filesize() {
   	return $this->maxfilesize;
   }


public function get_record_per_page()
{
return $this->nbreligneparpage;
}

public function get_state(){return trim($this->state);}
public function get_titre(){return $this->titre;}
public function get_numero_version(){return $this->version;}

//modificateurs
public function set_state($pstate){$this->state = trim($pstate);}

	function get_configuration($pfilename)
	{
		$lretval = false;
		
		if (file_exists($pfilename))
		{
			$larr_section = parse_ini_file($pfilename, true);
			
			foreach ($larr_section as $lsection => $larr_paire)
			{
				if (trim($lsection) != "")
				{
					foreach ($larr_paire as $lattribut => $lvaleur) {
						if (trim($lattribut) != "")
							$this->$lattribut = $lvaleur;
					}
				}
					
			}
			$this->nbreligneparpage = $this->listlimit;
			$this->version = "1.0";
			$lretval = true;
			
			//print_r($this);
		}
		
		return $lretval;
	}

function set_short_list_title($text, $count, $limit)
	{
		global $translate;

		/**
		 * Construction de la pagination
		 */
		 
		$count = $count > 0 ? $count : 0;
		$count_per_page = ($limit > $count) ? $count : $limit;
		$page = $_GET['page'] > 0 ? $_GET['page'] : 1;
		
		$start = $count_per_page * ($page - 1) + 1;
		$start = ($start > 0) ? $start : 0;
		$start = ($page == 1) ? 1 : $start;
		$start = ($count > 0) ? $start : 0;
		$end = $start + $count_per_page - 1;
		$end = ($end > 0) ? $end : 0;
		$end = ($end > $count) ? $count : $end;
		$end = ($count > 0) ? $end : 0;

		/**
		 * Construction du titre
		 */
		 
		$title = $text.'<br />'; 
		$title .= str_replace(array('{%start%}', '{%end%}', '{%total%}'), array($start, $end, $count), $translate['paging_abtract']);

		return $title;
	}
 
 
	 function get_url ()
	 {
	 return $this->url;
	 }	
	
	
	function get_dossier_plugin ()
	 {
	 return $this->dossier_plugin;
	 }	
 
 
 	function alert($pstate , $pmessage_class , $pmessage_status , $plang = "fr" , $pdo = "" , $pfrom = "")
	{
		global $translate,$do;
		
		$lretval = "";
		
		$this->set_state($pstate);
		
		if (trim($this->get_state()) != "")
		{
			$pmessage_status = $translate[$pstate];
			$pmessage_status = str_replace( '{%do%}' , "(".$translate[$pfrom].")" , $pmessage_status);
			
			switch(trim(strtolower($this->state)))
			{
				case "insert_valid_error" :
				case "file_wasnt_uploaded" :
				case "nofileexists" :
					$pmessage_class = "error";
					break;
			}
			
		}
		
			$ldisplay = (trim($pstate) == "") ? "none" : "block";
			$lretval = "
			<dl id=\"system-message\" style=\"display:{$ldisplay}\" >
				<dt class=\"message\">Message</dt>
				<dd class=\"message message {$pmessage_class}\" >
					<ul>
						<li>{$pmessage_status}</li>
					</ul>
				</dd>
			</dl>
			";
		
			return $lretval;
	}
	
 
 	 function a_tag($link , $phref , $a_attributes = array() , $param_hidden = array(),$title=null)
	{
		$lretval =  "<a";
		
		if (is_array($a_attributes))
		{
			foreach ($a_attributes as $attr_id =>  $value)
			{
				$lretval .= " ".$attr_id." = \"{$value}\"";
			}
		}
		
		$lretval .= " href = \"{$phref}";
		$lparam = "";
		
		if (is_array($param_hidden))
		{
			foreach ($param_hidden as $param_id =>  $value)
			{
				$lparam .= ( trim($lparam) == "") ? "?".$param_id."={$value}" : "&{$param_id}={$value}";
			}
		}
		$lretval .=  "{$lparam}\" title=\"{$title}\" >{$link}</a>\n";

		unset($param_id);
		unset($value);
			
		return $lretval;
	}


 /**
  * fonction qui vérifie les droits d'accès à une fonctionnalité
  * 	@param 	string - plogin	- login en cours
  * 	@param 	string - plang	- langue en cours. Utilse pour la langue de la page suivante en cas de redirection. egale fr par déafut
  * 	@param 	string - pdo	- code de l'action sollicité
  * 	@param 	integer - pajax	- précise si l'action a été solllicté depuis ajax ou pas. Egale 1 si depuis ajax, = 0 sinon
  * 	@param 	string - pstate	- etat de l'application
  * 	@param 	integer - pnumtache	- numéro de la tâche en cours. paramètre à utiliser uniquement si ( in_array(trim(strtolower($pdo)) , array("workflow_update","workflow_create")))
  * 	@param 	integer - pcodecircuit	- numéro du circuit en cours. paramètre à utiliser uniquement si ( in_array(trim(strtolower($pdo)) , array("workflow_update","workflow_create")))
  * 	
  *
  */
 function control_permission($plogin , $plang = "fr" , $pdo = "" , $pajax = 0 , $pstate = null , $pnumtache = null , $pcodecircuit = null )
 {
		
 	global $translate;
 	
	 	if ( in_array(trim(strtolower($pdo)) , array("accueil_user")) || (trim(strtolower($plogin)) == "admin"))
		{//on a toujours le droit d'accéder à la page d'accueil.
			//le super administrateur admin a toujours le droit d'accéder à une fonctionnalité
			$lhas_right = true;
		}
 		else if (in_array(trim(strtolower($pdo)) , array("user_view" , "user_update_valid")))
		{//tout utilisateur peut consulter son propre profil et le modifier
			$lhas_right = true;
		}
		else 
		{
	 		
			ini_set('include_path', $this->get_document_root().'\includes\pear');			
			
			//si on est dans un workflow, gestion des permission suivant la définition du circuit
			if ( in_array(trim(strtolower($pdo)) , array("workflow_update","workflow_create")))
			{
				//les taches autorisés par le login en cours
				require_once($this->get_document_root().DS.'workflow'.DS.'classe'.DS.'tache.class.php');
				$ltache = new tache();
				
				$ltache->loginuser = trim($plogin);
				$ltache->codecircuit = intval($pcodecircuit);
				
				$listetache = $ltache->rechercher();
				if ($ltache->has_exception()) die($ltache->get_exception());
				
				//recherche $pnumtache dans la liste des tâches
				$lfound = false;
				$i = 0;
				//while ( (! $lfound) && ($i < count($listetache)) )
				
				//$lhas_right = $lfound;
				$lhas_right = true;
				
				unset($ltache);
				unset($listetache);
				
			}
			else 
			{
			
				require_once($this->get_document_root().DS.'administration'.DS.'classe'.DS.'droa.class.php');
				$lpermission = new droit();
				$lpermission->loginuser = $plogin;
				$listedroit = $lpermission->rechercher();
			
				//chargement des traductions
			    require_once($this->get_document_root().DS.'lang'.DS.'application.'.$plang.'.php');
		
				$lhas_right = false;
				$lmessage_class = "fade";
				$lmessage_status =  ucfirst($translate["no_rigth_for_this_functionnality"]);
				if (is_array($listedroit))
				{
					foreach($listedroit as $larr_permission)
					{
						$lcodeaction = $larr_permission["codeaction"];
						if (trim(strtolower($lcodeaction)) == trim(strtolower($pdo)))
						{
							$lhas_right = true;
							break;
						}
					}
				}
			}
		
			if (! $lhas_right)
			{
				$state = "no_rigth_for_this_functionnality";
				$pstate = "no_rigth_for_this_functionnality";
				$lmessage_class = "error";
				
				if (intval($pajax) == 1)
				{
					$lretval = "
					<dt class=\"message\">Message</dt>
		
					<dd class=\"message message error\">
						<ul>
							<li>".$translate["no_rigth_for_this_functionnality_ajax"]."</li>
						</ul>
					</dd>";
					die($lretval);
				}
				else 
				{
					
					$lmessage_status =  ucfirst($translate["no_rigth_for_this_functionnality"]);
					$lmessage_status = str_replace( '{%do%}' , $pdo , $lmessage_status);
					
				    //obtenir l'url précédente
					$lprev_url = $_SERVER["HTTP_REFERER"];
					//séparer l'URI des paramètres
					$larr_infos_url = explode("?" , $lprev_url);
					//obtenir juste les paramètres	do=user_search&login=admin&lang=en
					$lparam_url = $larr_infos_url[1];
					//extraire les paires de paramètres
					$larr_param = explode("&",trim($lparam_url));
	
					//fabriquer un tableau associatif
					$larr_param2 = array();
					foreach ($larr_param as $lpaire) 
					{
							$larr_element = explode("=" , $lpaire);
							$larr_param2[$larr_element[0]] = trim($larr_element[1]);
					}
					
					//ajouter le paramètre state
					$larr_param2["state"] = $pstate;
					$larr_param2["from"] = $pdo;
					
					echo $this->redirection($this->get_url()."/gabarit/page.gabarit.php",
					$larr_param2,
					true);
					die();
	
				}
			}
		}
		
	//libérer la mémoire
	unset($lpermission);
	unset($listedroit);
	unset($lcodeaction);
 	
 }

function date_tag($pinput_attributes = array() , $pimg_attributes = array())
	{
		$lretval = $this->input_tag($pinput_attributes);
		$lretval .= $this->img_tag($pimg_attributes);
		$lretval .= "<script type=\"text/javascript\">
					    Calendar.setup({
					        inputField     :    \"".$pinput_attributes["id"]."\",     
					        ifFormat       :    \"%d/%m/%Y\",     
					        button         :    \"".$pimg_attributes["id"]."\",  
					        singleClick    :    true
					    });
					    Calendar.setup({
					        inputField     :    \"".$pinput_attributes["id"]."\",     
					        ifFormat       :    \"%d/%m/%Y\",      
					        button         :    \"".$pinput_attributes["id"]."\",  
					        singleClick    :    true
					    });
			</script>";
	
		return $lretval;
	}
	

	function img_tag($attributes = array())
	{
		$lretval =  "<img";
		
		foreach ($attributes as $attr_id =>  $value)
		{
			$lretval .= " ".$attr_id." = \"{$value}\"";
		}
		
		$lretval .= "/>\n";
		
		return $lretval;
	}

	
	function input_tag($attributes = array())
	{   
	
		$lretval =  "<input";
		
		foreach ($attributes as $attr_id =>  $value)
		{
			$lretval .= " ".$attr_id." = \"{$value}\"";
		}
		
		$lretval .= "/>\n";
		
		return $lretval;
	}
	
	
	/**
	 * redirection vers une autre page
	 * @author 	:	Patrick Mveng <patrick.mveng@interfacesa.local>
	 * @param string - $purl - url de la page web
	 * @param array - $param_hidden - liste des paramètres cachées à poster
	 * @param boolean - $phtml_tag - spécifie si le script doit être dans une balise html
	 * faux par défaut
	 */
	 function redirection ($purl,$param_hidden=array(),$phtml_tag=false)
	{
		$lparam_url = "";
		
		foreach ($param_hidden as $param_id =>  $value)
		{
			if (trim($lparam_url) == "") $lparam_url = "{$param_id}={$value}";
			else $lparam_url .= "&{$param_id}={$value}";
		}
		
		if (trim($lparam_url) == "") $lparam_url = "?".$lparam_url;
		
		$lretval .=   "<script type=\"text/javascript\">\n
			window.location = '{$purl}?{$lparam_url}';
		</script>\n";
		
		
		if ($phtml_tag)
		{
			$lretval = "
			<html>\n
				<head>".$this->titre."</head>\n
				<body>\n" . $lretval . "</body>\n
			</html>";
		}
		//print_r($param_hidden);
		//die();
		return $lretval;
	}

	function renderExportSelection($RenderObject, $RenderType = 'XLS', $Name = 'spreadsheet')
	{
		global $gdoc;
		
		switch (strtoupper($RenderType))
		{
			case strtoupper('XLS'):
				
				$Ecols = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','X','Y','Z',
								'AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AX','AY','AZ',
								'BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BX','BY','BZ',
								'CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CX','CY','CZ',
								'DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DX','DY','DZ',
								'EA','EB','EC','ED','EE','EF','EG','EH','EI','EJ','EK','EL','EM','EN','EO','EP','EQ','ER','ES','ET','EU','EV','EX','EY','EZ',
								'FA','FB','FC','FD','FE','FF','FG','FH','FI','FJ','FK','FL','FM','FN','FO','FP','FQ','FR','FS','FT','FU','FV','FX','FY','FZ',
								'GA','GB','GC','GD','GE','GF','GG','GH','GI','GJ','GK','GL','GM','GN','GO','GP','GQ','GR','GS','GT','GU','GV','GX','GY','GZ',
								'HA','HB','HC','HD','HE','HF','HG','HH','HI','HJ','HK','HL','HM','HN','HO','HP','HQ','HR','HS','HT','HU','HV','HX','HY','HZ');
				$EcolsA = count($Ecols);

				/** PHPExcel */
				require_once 'PHPExcel.php';

				/** PHPExcel_RichText */
				require_once 'PHPExcel/RichText.php';
				$objPHPExcel = new PHPExcel();
				// Set properties
				
				$objPHPExcel->getProperties()->setCreator("INTERFACE SA");
				$objPHPExcel->getProperties()->setLastModifiedBy("INTERFACE SA");
				$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX INTERFACE SA Document");
				$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX INTERFACE SA Document");
				$objPHPExcel->getProperties()->setDescription("INTERFACE SA document for Office 2007 XLSX, generated using PHP classes.");
				$objPHPExcel->getProperties()->setKeywords("INTERFACE SA");
				$objPHPExcel->getProperties()->setCategory("INTERFACE SA");

				// Create a first sheet
				$objPHPExcel->setActiveSheetIndex(0);
				$longueur=count($RenderObject->_dataSource->_options[fields]);
				for ($i = 0; $i < $longueur; $i++) {
					$objPHPExcel->getActiveSheet()->setCellValue($Ecols[$i]."1", $RenderObject->_dataSource->_options[fields][$i]);					
				}

				$longueur2=count($RenderObject->recordSet);

				for ($j = 0; $j < $longueur2; $j++) {
					for ($i = 0; $i < $longueur; $i++) {
						$objPHPExcel->getActiveSheet()->setCellValue($Ecols[$i].($j+2), $RenderObject->recordSet[$j][$RenderObject->_dataSource->_options[fields][$i]]);
					}
				}
               
				include_once 'PHPExcel/Writer/Excel5.php';
				 
				$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
				$filename = $Name . '.xls';
				//$objWriter->save("php://output");
				//exit;
				
				$objWriter->save($this->doc_root.DS.'ged'.DS."document".DS.$filename);
				$contentFile = file_get_contents($this->doc_root.DS.'ged'.DS."document".DS.$filename);
                
				/*
				Patrick Mveng, le 30 novembre 2007
				supprimer physiquement le fichier
				*/
				unlink($this->doc_root.DS.'ged'.DS."document".DS.$filename);				
				
				$gdoc->telechargerFichier($contentFile , $this->doc_root.DS.'ged'.DS."document".DS.$filename);

				break;

			case 'CSV'://Patrick Mveng, le 03 décembre 2007
					//$test = $RenderObject->render(DATAGRID_RENDER_CSV);
					
					$Ecols = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','X','Y','Z',
									'AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AX','AY','AZ',
									'BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BX','BY','BZ',
									'CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CX','CY','CZ',
									'DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DX','DY','DZ',
									'EA','EB','EC','ED','EE','EF','EG','EH','EI','EJ','EK','EL','EM','EN','EO','EP','EQ','ER','ES','ET','EU','EV','EX','EY','EZ',
									'FA','FB','FC','FD','FE','FF','FG','FH','FI','FJ','FK','FL','FM','FN','FO','FP','FQ','FR','FS','FT','FU','FV','FX','FY','FZ',
									'GA','GB','GC','GD','GE','GF','GG','GH','GI','GJ','GK','GL','GM','GN','GO','GP','GQ','GR','GS','GT','GU','GV','GX','GY','GZ',
									'HA','HB','HC','HD','HE','HF','HG','HH','HI','HJ','HK','HL','HM','HN','HO','HP','HQ','HR','HS','HT','HU','HV','HX','HY','HZ');
					$EcolsA = count($Ecols);
		
					/** PHPExcel */
					require_once 'PHPExcel.php';
	
					/** PHPExcel_RichText */
					require_once 'PHPExcel/RichText.php';
					$objPHPExcel = new PHPExcel();
					// Set properties
	
					$objPHPExcel->getProperties()->setCreator("INTERFACE SA");
					$objPHPExcel->getProperties()->setLastModifiedBy("INTERFACE SA");
					$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
					$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
					$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");
					$objPHPExcel->getProperties()->setKeywords("office 2007 openxml php");
					$objPHPExcel->getProperties()->setCategory("Test result file");
	
					// Create a first sheet
					$objPHPExcel->setActiveSheetIndex(0);
					$longueur=count($RenderObject->_dataSource->_options[fields]);
					for ($i = 0; $i < $longueur; $i++) {
						$objPHPExcel->getActiveSheet()->setCellValue($Ecols[$i]."1", $RenderObject->_dataSource->_options[fields][$i]);
					}
	
					$longueur2=count($RenderObject->recordSet);
	
					for ($j = 0; $j < $longueur2; $j++) {
						for ($i = 0; $i < $longueur; $i++) {
							$objPHPExcel->getActiveSheet()->setCellValue($Ecols[$i].($j+2), $RenderObject->recordSet[$j][$RenderObject->_dataSource->_options[fields][$i]]);
						}
					}
	
					include_once "PHPExcel/Writer/CSV.php";
	
					$objWriter = new PHPExcel_Writer_CSV($objPHPExcel);
					
					//Jules , le 12 décembre 2007
					$objWriter->setDelimiter(';');
     				$objWriter->setEnclosure('');
     				$objWriter->setLineEnding("\r\n");
     				$objWriter->setSheetIndex(0);
     				
					$filename = $Name . '.csv';
	
					$objWriter->save($this->doc_root.DS.'ged'.DS."document".DS.$filename);
					$contentFile = file_get_contents($this->doc_root.DS.'ged'.DS."document".DS.$filename);
	
					unlink($this->doc_root.DS.'ged'.DS."document".DS.$filename);
	
					$gdoc->telechargerFichier($contentFile , $this->doc_root.DS.'ged'.DS."document".DS.$filename);
					
				break;

			case 'XML':
					//$test = $RenderObject->render(DATAGRID_RENDER_XML);
					
					//Patrick Mveng, le 08 décembre 2007
					$filename = $Name . '.xml';
					$test = $RenderObject->render(DATAGRID_RENDER_XML,
					array("filename"=>$this->doc_root.DS.'ged'.DS."document".DS.$filename,
					"saveToFile"=>true));
					
					$contentFile = file_get_contents($this->doc_root.DS.'ged'.DS."document".DS.$filename);
	
					unlink($this->doc_root.DS.'ged'.DS."document".DS.$filename);
	
					$gdoc->telechargerFichier($contentFile , $this->doc_root.DS.'ged'.DS."document".DS.$filename);
					
				break;
			case 'XLS2007':	//Patrick Mveng, le 03 décembre 2007
			/*
			PHP complains about ZipArchive not being found
			Make sure you meet all Requirements, especially php_zip extension should be enabled.
			
			Activer l'extension zip.iso dans php.ini

			*/
				$Ecols = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','X','Y','Z',
								'AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AX','AY','AZ',
								'BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BX','BY','BZ',
								'CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CX','CY','CZ',
								'DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DX','DY','DZ',
								'EA','EB','EC','ED','EE','EF','EG','EH','EI','EJ','EK','EL','EM','EN','EO','EP','EQ','ER','ES','ET','EU','EV','EX','EY','EZ',
								'FA','FB','FC','FD','FE','FF','FG','FH','FI','FJ','FK','FL','FM','FN','FO','FP','FQ','FR','FS','FT','FU','FV','FX','FY','FZ',
								'GA','GB','GC','GD','GE','GF','GG','GH','GI','GJ','GK','GL','GM','GN','GO','GP','GQ','GR','GS','GT','GU','GV','GX','GY','GZ',
								'HA','HB','HC','HD','HE','HF','HG','HH','HI','HJ','HK','HL','HM','HN','HO','HP','HQ','HR','HS','HT','HU','HV','HX','HY','HZ');
				$EcolsA = count($Ecols);

				/** PHPExcel */
				require_once 'PHPExcel.php';

				/** PHPExcel_RichText */
				require_once 'PHPExcel/RichText.php';
				$objPHPExcel = new PHPExcel();
				// Set properties

				$objPHPExcel->getProperties()->setCreator("INTERFACE SA");
				$objPHPExcel->getProperties()->setLastModifiedBy("INTERFACE SA");
				$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX INTERFACE SA Document");
				$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX INTERFACE SA Document");
				$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");
				$objPHPExcel->getProperties()->setKeywords("office 2007 openxml php");
				$objPHPExcel->getProperties()->setCategory("Test result file");

				// Create a first sheet
				$objPHPExcel->setActiveSheetIndex(0);
				$longueur=count($RenderObject->_dataSource->_options[fields]);
				for ($i = 0; $i < $longueur; $i++) {
					$objPHPExcel->getActiveSheet()->setCellValue($Ecols[$i]."1", $RenderObject->_dataSource->_options[fields][$i]);
				}

				$longueur2=count($RenderObject->recordSet);

				for ($j = 0; $j < $longueur2; $j++) {
					for ($i = 0; $i < $longueur; $i++) {
						$objPHPExcel->getActiveSheet()->setCellValue($Ecols[$i].($j+2), $RenderObject->recordSet[$j][$RenderObject->_dataSource->_options[fields][$i]]);
					}
				}

				include_once "PHPExcel/Writer/Excel2007.php";

				$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
				$filename = $Name . '.xlsx';

				$objWriter->save($this->doc_root.DS.'ged'.DS."document".DS.$filename);
				$contentFile = file_get_contents($this->doc_root.DS.'ged'.DS."document".DS.$filename);
die($contentFile);
				unlink($this->doc_root.DS.'ged'.DS."document".DS.$filename);
				
				$gdoc->telechargerFichier($contentFile , $this->doc_root.DS.'ged'.DS."document".DS.$filename);
				
				break;				
		}
		//Print_r($option); die();
		//$RenderObject->fill();
		return;
	}
			
	function select_ouvrante_tag($attributes)
	{
		$lretval =  "<select";
		
		foreach ($attributes as $attr_id =>  $value)
		{
		$lretval .= " ".$attr_id." = \"{$value}\"";
		}
		
		$lretval .= ">\n";
		return $lretval;
	}	
	
	/**
	 * function qui fabrique la liste déroulante des types de fichier à exporter
	 *
	 * @param unknown_type $pattributes
	 * @param unknown_type $pdefault
	 * @param unknown_type $pchoisissez
	 * @return unknown
	 */
 	 function sel_option_export($pattributes , $pdefault = null , $pchoisissez = null)
	{
		global $translate;
		$this->exception = "";
		
		$larr_option_search = array();
		$larr_option_search[] = array("code" => "xls2007" , "value" => ($translate['excel_file']));
		$larr_option_search[] = array("code" => "csv" , "value" => ($translate['csv_file']));
		$larr_option_search[] = array("code" => "xml" , "value" => strtoupper($translate['xml_file']));
        
		$list = $this->select_ouvrante_tag($pattributes);
		$list .= "<option value=\"\">$pchoisissez</option>\n";
		foreach($larr_option_search as $obj)
		{
			$list .= "<option value=\"".$obj['code']."\"";
			if ((trim(strval($pdefault)) == trim(strval($obj['code'])) ))
			{
				$list .= " selected";
			}
			$list .= ">".$obj[value]."</option>\n";
		}
		$list .= "</select>\n";
		
		//libérer la mémoire
		unset($larr_option_search);
		unset($obj);
		
		return $list;
	}	

	
    /**
 	 * fabriquer une liste déroulante des options de recherche de texte
 	 * @param unknown_type $pattributes
 	 * @param entier -  $pdefault - code de l'option a afficher par défaut
 	 * @param string - $pchoisissez - message choisissez à afficher
 	 * @return unknown
 	 */
 	 function sel_option_search($pattributes , $pdefault = null , $pchoisissez = null)
	{
		global $translate;
		$this->exception = "";
		
		$larr_option_search = array();
		$larr_option_search[] = array("code" => 0 , "value" => $translate['prefixed_by']);
		$larr_option_search[] = array("code" => 1 , "value" => $translate['contient']);
		$larr_option_search[] = array("code" => 3 , "value" => $translate['postfixed_by']);
		$larr_option_search[] = array("code" => 4 , "value" => $translate['equals_to']);
				
		$list = $this->select_ouvrante_tag($pattributes);
		$list .= "<option value=\"\">$pchoisissez</option>\n";
		
		foreach($larr_option_search as $obj)
		{
			$list .= "<option value=\"".$obj['code']."\"";
			if ((trim(strval($pdefault)) == trim(strval($obj['code'])) ))
			{
				$list .= " selected";
			}
			$list .= ">".$obj[value]."</option>\n";
		}
		$list .= "</select>\n";
		
		//libérer la mémoire
		unset($larr_option_search);
		unset($obj);
		return $list;
	}	
	
	
	function sel_option_search_entier($pattributes , $pdefault = null , $pchoisissez = null)
	{
		global $translate ;
		$this->exception = "";
		
		$larr_option_search = array();
		$larr_option_search[] = array("code" => 0 , "value" => "=");
		$larr_option_search[] = array("code" => 1 , "value" => "<=");
		$larr_option_search[] = array("code" => 2 , "value" => ">=");
 		
		
		$list = $this->select_ouvrante_tag($pattributes);
		$list .= "<option value=\"\">$pchoisissez</option>\n";
		foreach($larr_option_search as $obj)
		{
			$list .= "<option value=\"".$obj['code']."\"";
			if ((trim(strval($pdefault)) == trim(strval($obj['code'])) ))
			{
				$list .= " selected";
			}
			$list .= ">".$obj[value]."</option>\n";
		}
		$list .= "</select>\n";
		
		//libérer la mémoire
		unset($larr_option_search);
		unset($obj);
		
		return $list;
	}	
	
	
 	 function sel_option_search_type($pattributes , $pdefault = null , $pchoisissez = null)
	{
		global $translate;
		$this->exception = "";
		
		$larr_option_search = array();
		$larr_option_search[] = array("code" => 0 , "value" => $translate['recepteur']);
		$larr_option_search[] = array("code" => 1 , "value" => $translate['validateur']);
		$larr_option_search[] = array("code" => 2 , "value" => $translate['emetteur']);
        
		$list = $this->select_ouvrante_tag($pattributes);
		$list .= "<option value=\"\">$pchoisissez</option>\n";
		foreach($larr_option_search as $obj)
		{
			$list .= "<option value=\"".$obj['code']."\"";
			if ((trim(strval($pdefault)) == trim(strval($obj['code'])) ))
			{
				$list .= " selected";
			}
			$list .= ">".$obj[value]."</option>\n";
		}
		$list .= "</select>\n";
		
		//libérer la mémoire
		unset($larr_option_search);
		unset($obj);
		
		return $list;
	}

	/**
	 * function qui fabrique la liste déroulante des types de base de données
	 *
	 * @param unknown_type $pattributes
	 * @param unknown_type $pdefault
	 * @param unknown_type $pchoisissez
	 * @return unknown
	 */
 	 function sel_option_typebd($pattributes , $pdefault = null , $pchoisissez = null)
	{
		global $translate;
		$this->exception = "";
		
		$larr_option_search = array();
		$larr_option_search[] = array("code" => "mysql" , "value" => $translate['mysql']);
		$larr_option_search[] = array("code" => "mssql" , "value" => $translate['mssql']);
		$larr_option_search[] = array("code" => "oci8" , "value" => $translate['oci8']);
        
		$list = $this->select_ouvrante_tag($pattributes);
		//$list .= "<option value=\"\">$pchoisissez</option>\n";
		foreach($larr_option_search as $obj)
		{
			$list .= "<option value=\"".$obj['code']."\"";
			if ((trim(strval($pdefault)) == trim(strval($obj['code'])) ))
			{
				$list .= " selected";
			}
			$list .= ">".$obj[value]."</option>\n";
		}
		$list .= "</select>\n";
		
		//libérer la mémoire
		unset($larr_option_search);
		unset($obj);
		
		return $list;
	}	
	

	
	
	function split_words($string) 
 	 {  
 	   $retour = array();  
 	   $larr_separateur = array(" ",";",",",".","-","!","?",":","(",")","{","}","[","]","%"); 
 	   $delimiteurs = implode("",$larr_separateur);	  
 	   $tok = strtok($string, " ");  
 	   while (strlen(join(" ", $retour)) != strlen($string)) 
 	     {  
 	      array_push($retour, $tok);  
 	      $tok = strtok ($delimiteurs);  
 	     };  
 	  
 	   return ($retour);  
 	 } 
 	 
	/**
	 * @name : Fonction qui retourne le titre d'une page web, qui sera affiché dans le navigateur web
	 * @param unknown_type $code_page
	 * @return unknown
	 */
	function title_tag($code_page)
	{
		global  $translate;
		switch (strtolower(trim($code_page)))
		{
			case "profi_view":
				$this->titre = $translate["modification_profil"];
				break;
			case "config_view":
				$this->titre = $translate["config_general"];
				break;				
			default:
		   		$this->titre = "";	  	
				break;
		}
		$lretval =	'<title>'."Sesame Flow - ".$this->get_titre().'</title>';
		return $lretval;
	}
	
	
	function sel_doc_search($pattributes , $pdefault = null)
	{
		global $translate;
		$this->exception = "";
		
		$larr_option_search = array();
		$larr_option_search[] = array("code" => 0 , "value" => ucfirst($translate['Archive']));
		$larr_option_search[] = array("code" => 1 , "value" => ucfirst($translate['Joined']));
						
		$list = $this->select_multiple_tag($pattributes);
		
		foreach($larr_option_search as $obj)
		{
			$list .= "<option value=\"".$obj['code']."\"";
			if ((trim(strval($pdefault)) == trim(strval($obj['code'])) ))
			{
				$list .= " selected";
			}
			@$list .= ">".$obj[value]."</option>\n";
		}
		$list .= "</select>\n";
		
		//libérer la mémoire
		unset($larr_option_search);
		unset($obj);
		return $list;
	}
	
	
	function select_unite_duree($pattributes , $pdefault = null)
	{
		global $translate;
		$this->exception = "";
		
		$larr_option_search = array();
		
		$larr_option_search[] = array("code" => 1 , "value" => $translate['heure']);
		$larr_option_search[] = array("code" => 2 , "value" => $translate['jour']);
		$larr_option_search[] = array("code" => 3 , "value" => $translate['mois']);
						
		$list = $this->select_ouvrante_tag($pattributes);
		
		foreach($larr_option_search as $obj)
		{
			$list .= "<option value=\"".$obj['code']."\"";
			if ((trim(strval($pdefault)) == trim(strval($obj['code'])) ))
			{
			$list .= " selected";
			}
			@$list .= ">".$obj[value]."</option>\n";
		}
		$list .= "</select>\n";
		
		//libérer la mémoire
		unset($larr_option_search);
		unset($obj);
		return $list;
	}


	function select_longueur_grille($pattributes , $pdefault = null)
	{
		global $translate;
		$this->exception = "";
		
		$larr_option_search = array();
		$larr_option_search[] = array("code" => 5 , "value" => 5);
		$larr_option_search[] = array("code" => 10 , "value" => 10);
		$larr_option_search[] = array("code" => 20 , "value" => 20);
		$larr_option_search[] = array("code" => 50 , "value" => 50);
		$larr_option_search[] = array("code" => 100 , "value" => 100);
						
		$list = $this->select_ouvrante_tag($pattributes);
		
		foreach($larr_option_search as $obj)
		{
			$list .= "<option value=\"".$obj['code']."\"";
			if ((trim(strval($pdefault)) == trim(strval($obj['code'])) ))
			{
			$list .= " selected";
			}
			@$list .= ">".$obj[value]."</option>\n";
		}
		$list .= "</select>\n";
		
		//libérer la mémoire
		unset($larr_option_search);
		unset($obj);
		return $list;
	}	
	

	function select_multiple_tag($attributes)
	{
		$lretval =  "<select multiple";
		
		foreach ($attributes as $attr_id =>  $value)
		{
		$lretval .= " ".$attr_id." = \"{$value}\"";
		}
		
		$lretval .= ">\n";	
		return $lretval;
	}
	
	
}

?>