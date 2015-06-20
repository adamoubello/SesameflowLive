<?php
/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Workflow
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou <moustaphbi@yahoo.fr>
 * @desc			Spécification d'un workflow dans le système de workflow
 * @creationdate	????
 * @updates
 * 	# samedi 20 juin 2009 (Patrick Mveng)
 * 		- suppression de la fonction init()
 * 	# mardi 18 mai 2010 (BELLO Adamou)
 * 		- modification de la fonction rechercher()
 * 	# jeudi 20 mai 2010 (BELLO Adamou)
 * 		- enrichissement de la requête générale dans la fonction rechercher()
 */

 global $siteweb;
 require_once($siteweb->get_document_root().'\classe\table.class.php');

 class Workflow extends Table
{
	public $numtache;
	public $numworkflow;
	public $datedebutwf;
	public $heuredebutwf;
	public $dureewf;
	public $avancementwf;
	public $codecircuit;
	public $dureetache;
	public $typedoc;
	public $codeuser;	
	public $login;
	public $numdoc;
	public $archivewf;
	public $codeusercours;
		
	function __construct()
	{
	 parent::init();
	}
	
 /**
  * fonction qui ajoute un workflow dans la BD
  *
  * @return unknown
  */
 public function ajouter()
 {
      $bool=false; 
 	  $this->exception = "";
	  
	  //initialisation du tableau de paramètres formels et effectifs pour la requête
	  $lparam_type = array();
	  $lparam_data = array();

		 $sql = 'insert into workflow (numworkflow , datedebutwf , heuredebutwf , dureewf , avancementwf , codecircuit , numtache , numdoc )
		  values( ? , ?, ? , ? , ? , ? , ? , ?)';
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "date"; 
		 $lparam_type[] = "text"; 
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "float"; 
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "integer"; 
		 
		       $this->connect_db();
			   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
				{
					$lparam_data[] = intval($this->numworkflow);
					$lparam_data[] = $this->format_date2database(trim($this->datedebutwf));
					$lparam_data[] = trim($this->heuredebutwf);
					$lparam_data[] = intval($this->dureewf);
					$lparam_data[] = floatval($this->avancementwf);
					$lparam_data[] = intval($this->codecircuit);
					$lparam_data[] = intval($this->numtache);
					$lparam_data[] = intval($this->numdoc);
					
			        //die($this->redraw_sql($sql , $lparam_data , $lparam_type));
					
					if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
					{
							$bool = true;
					}
					else 
					{
						    $this->exception = "workflow::ajouter() - ".$result->getDebugInfo() . ' in ' . $sql;
						    $bool=false;
					}
				}
				else 
				{
					$this->exception = "workflow::ajouter() - ".$lprepare->getDebugInfo() . ' in ' . $sql;
					$bool=false;
				}
			   	
		$this->db->disconnect();
		return $bool;
}


/**
 * fonction d'archiv d'age une tâche dans un workflow
 * @author 	:	patrick mveng<patrick.mveng@interfacesa.local>
 * @return true si archivage ok, false sinon
 */
	 public function archiver()
	 {
	      $bool=false; 
		  $this->exception = "";
					  
		  //initialisation du tableau de paramètres formels et effectifs pour la requête
		  $lparam_type = array();
		  $lparam_data = array();
		 	  
		 $sql = 'update workflow set archivewf =  1 where numworkflow = ? ';
		 
		 $lparam_type[] = "integer"; 
  	     $lparam_data[] = intval($this->numworkflow);
					
		 //die($this->redraw_sql($sql , $lparam_data, $lparam_type));
					
			   $this->connect_db();
			   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
				{
				if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
					{
						$bool=true;
					}
					else 
					{
						    $this->exception = "workflow::archiver() - ".$result->getDebugInfo() . ' in ' . $sql;
						    $bool = false;
					}
				}
				else 
				{
					$this->exception = "workflow::archiver() - ".$lprepare->getDebugInfo() . ' in ' . $sql;
					$bool = false;
				}
			   
		$this->db->disconnect();
		return $bool;
	}


public function charger()
 {
 	  $retvalue = array();
 	  $lparam_data = array();
 	  $lparam_type = array();
	  
	  $req = "select w.numtache,w.avancementwf,w.datedebutwf,w.heuredebutwf , w.codecircuit
	  , w.numdoc , w.archivewf , w.dureewf
	  from workflow w
	   ";
	  $lwhere = " where (not w.numworkflow is null ) ";
	  $land = "";
	  
	  //$land .= " and numtache = '" . $this->numtache . "'";
	  $land .= " and numworkflow = ? ";
	  $lparam_type[] = "integer";
	  $lparam_data[] = $this->numworkflow;	
	  	 		
	  $req .= $lwhere . $land ;

	   //die($this->redraw_sql($req , $lparam_data , $lparam_type ));
	   $this->connect_db();
	   if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				$lrow = $result->FetchRow();
				
				//Transformer les noms de colonnes en champ de l'objet workflow en cours
				foreach ($lrow as $lchamp => $lvaleur)
				{
				$this->$lchamp = $lvaleur;
				}
				/*$this->libtache = html_entity_decode($this->libtache);
				die($this->libtache);*/
				$retvalue =  true;	//chargement effectué avec succès
				
				//libérer la mémoire
				unset($lchamp);
				unset($lvaleur);
			}
			else 
			{
				$this->exception = "tache::charger() - ".$result->getDebugInfo() . ' in ' . $req;
				$retvalue = false;
			}
		}
		else 
		{
			$this->exception = "tache::charger() - ".$lprepare->getDebugInfo() . ' in ' . $req; 
			$retvalue = false;
		}
	  
		//libérer la mémoire
		unset($lparam_data);
		unset($lparam_type);
		unset($req);
		unset($result);
		
		$this->db->disconnect();
		return $retvalue;
				
 }



	/**
	 * fonction qui vérifie si un utilisateur  le droit d'exécuter une tache
	 *
	 * @param int  - $pnumtache code de la tache sollicitée
	 * @param string -  $plogin - login de l'utilisateur qui sollicite la tache
	 */
	public function control_permission($pnumtache , $plogin)
	{
		$lretval = true;
		
		//obtenir le profil de l'utilisateur
		$luser = new Utilisateur();
		$luser->loginuser = trim($plogin);
		$luser->rechercher();
		
		$lfrom = " from circuit_tache ";
		$lwhere = " where circ.numtache = ?  ";
		$land = " and ( (circ.codeprofil = ?) or (circ.codeuser = ?) )";
		$sql = $lselect . $lfrom . $lwhere. $land;
		
		return $lretval;
	}
	
	
	/**
	 * fonction de génération d'un nouveau numéro de workflow
 	 * @access 		:	public
	 * @author 		:	patrick mveng<patrick.mveng@interfacesa.local>
	 * @return -1 si erreur, sinon un nouveau numéro entier
	 */
	public function generer_numero()
	{	
		$this->exception = "";
		$retvalue = -1;
		$lparam_type = array();
		$lparam_data = array();
		
		$req = " select max(numworkflow) as code_max from workflow ";		
		
		$this->connect_db();
		if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{			
				if ($result->valid())  //vérifie s'il ya au moins une ligne dans le résultat
				{
					$obj2 = $result->FetchRow();
					if ($psysteme == true)  $retvalue = $obj2["code_max"] - 1;
					else $retvalue = $obj2["code_max"] + 1;	
				}
				else 
				{
					$retvalue = -1;
				}
			}
			else 
			{
				$this->exception = "workflow::generer_numero() - ".$result->getDebugInfo() . ' in ' . $req;
				$retvalue = -1;
			}
		}
		else 
		{
			$this->exception = "workflow::generer_numero() - ".$lprepare->getDebugInfo() . ' in ' . $req;
			$retvalue = -1;
		}
		$this->db->disconnect();
		
		unset($lprepare);
		unset($result);
		unset($lparam_data);
		unset($lparam_type);
		unset($lsql);
		unset($Found);
		unset($lCode);
		unset($i);
		unset($max);
		
		return $retvalue;	
		
	}

	
/**
 * fonction de modification d'une tâche dans un workflow
 * @author 	:	patrick mveng<patrick.mveng@interfacesa.local>
 * @return true si modification ok, false sinon
 */
 public function modifier_tache()
 {
	     $bool=false; 
		 $this->exception = "";
					  
		 //initialisation du tableau de paramètres formels et effectifs pour la requête
		 $lparam_type = array();
		 $lparam_data = array();
		  
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "integer"; 
  	        
		 $sql = 'update workflow set numtache =  ? , numdoc = ? where numworkflow = ? ';
		 
			   $this->connect_db();
			   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
				{					
					$lparam_data[] = intval($this->numtache);
					$lparam_data[] = intval($this->numdoc);
					$lparam_data[] = intval($this->numworkflow);
					//die($this->redraw_sql($sql , $lparam_data, $lparam_type));
					
					if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
					{
						$bool=true;
					}
					else 
					{
						    $this->exception = "workflow::modifier_tache() - ".$result->getDebugInfo() . ' in ' . $sql;
						    $bool = false;
					}
				}
				else 
				{
					$this->exception = "workflow::modifier_tache() - ".$lprepare->getDebugInfo() . ' in ' . $sql;
					$bool = false;
				}
			   
		$this->db->disconnect();
		return $bool;
 }
	
	
 public function rechercher()
 {   
      $retvalue = array();
      
      $this->exception = "";
	  
	  $lselect = " select w.numworkflow,w.datedebutwf,w.heuredebutwf,w.dureewf,w.avancementwf,w.codecircuit , w.numtache 
	  , w.numdoc , w.archivewf , c.libcircuit , doc.titredoc , t.libtache , doc.typedoc , t.dureetache , ct.codeuser ";
	  $lfrom = " from workflow w
	  inner join circuit_tache ct on w.codecircuit = ct.codecircuit and w.numtache = ct.numtache 
	  inner join circuit c on w.codecircuit = c.codecircuit 
	  inner join document doc on w.numdoc = doc.numdoc
	  inner join tache t on w.numtache = t.numtache
		";
	  $lwhere = " where (not w.numworkflow is null) ";
	  $land = "";
	  
	  //initialisation du tableau de paramètres formels
	  $lparam_type = array();
	  //initialisation du tableau de paramètres effectifs pour la requête
	  $lparam_data = array();
	  	  
	  if (trim($this->libworkflow) != "")
	  {
	  	switch(intval($this->sel_option_libworkflow))
		{   
			case 0:	//cas "commencant par"
				$land .= " and c.libcircuit like '" . $this->libworkflow . "%'";
				break;
			case 1:	//cas "contient"
				$land .= " and c.libcircuit like '%" . $this->libworkflow . "%'";
				break;				
			case 3:	//cas "finissant par"
			  	$land .= " and c.libcircuit like '%" . $this->libworkflow . "'";
				break;
			case 4:	//cas "est égal à"
				$land .= " and c.libcircuit = '" . $this->libworkflow . "'";
				break;	
		}
	  }
	  
	    //Rechercher un workflow par la date
		//if ((trim($this->sel_option_datedebutworkflow ) != "") && (trim($this->sel_option_datedebutworkflow ) != ""))
//		{
//			$land .= " and datedebutwf between ?  and  ? ";
//			$lparam_type[] = "date";
//			$lparam_type[] = "date";
//			$lparam_data[] = $this->sel_option_datedebutworkflow;
//			$lparam_data[] = $this->sel_option_datedebutworkflow;
//		}
//		else if ((trim($this->sel_option_datedebutworkflow ) != ""))
//		{
//			$land .= " and datedebutwf >= ? ";
//			$lparam_type[] = "date";
//			$lparam_data[] = $this->sel_option_datedebutworkflow;
//        }
//		else if((trim($this->sel_option_datedebutworkflow ) != ""))
//		{
//			$land .= " and datedebutwf <= ? ";
//			$lparam_type[] = "date";
//			$lparam_data[] = $this->sel_option_datedebutworkflow;
//		}

      //Rechercher un workflow par la date
	  if ( (trim($this->dat_deb_creation) != "") && (trim($this->dat_fin_creation) != "") )
	  	{
	  		$land .= " and w.datedebutwf between '".$this->format_date2database(trim($this->dat_deb_creation))."' and '".$this->format_date2database(trim($this->dat_fin_creation))."' ";
	  	}
	  	elseif (trim($this->dat_deb_creation) != "")
	  	{
	  		$land .= " and w.datedebutwf >= '".$this->format_date2database(trim($this->dat_deb_creation))."' ";
	  	}
	  	elseif (trim($this->dat_fin_creation) != "")
	  	{
	  		$land .= " and w.datedebutwf <= '".$this->format_date2database(trim($this->dat_fin_creation))."' ";
	  	}
		
		
	  if (trim($this->dureeworkflow) != "")
	  {
	  	switch(intval($this->sel_option_dureeworkflow))
		{
			case 0:	//cas "est égal à"
				$land .= " and dureewf = '" . $this->dureeworkflow . "'";
				break;
			case 1:	//cas "inférieure ou égale à"
			  	$land .= " and dureewf <= '" . $this->dureeworkflow . "'";
				break;				
			case 2:	//cas "supérieure ou égale à"
				$land .= " and dureewf >= '" . $this->dureeworkflow . "'";
				break;
		}
	  }
	  
//    if (trim($this->archivewf) != "")
//	  {
//	  	$land .= " and archivewf = ? ";
//	  	$lparam_data[] = intval($this->archivewf);
//	  	$lparam_type[] = "integer";
//	  }

	 //Filtre des workflow suivant leur état
	 if (!empty($this->sel_option_etat)) {
            if ($this->sel_option_etat[0] == 0){
			  //On affiche les workflow archivés uniquement
              $land .= " and w.archivewf = 1 ";
              $req = $lselect . $lfrom ;
	  	      $req .= $lwhere . $land ;
             }
			
		    //On affiche tous les workflow 
		    if ($this->sel_option_etat[0] == 1){}
	  }
      else {     
            //On affiche les workflow en cours uniquement
            $land .= " and w.archivewf = 0 ";
            $req = $lselect . $lfrom ;
	  	    $req .= $lwhere . $land ;
        }
	 
	  $req = $lselect . $lfrom . $lwhere . $land ;
	  
	  //die($this->redraw_sql($req , $lparam_data , $lparam_type));
	  
	  $this->connect_db();
	   if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				if ($result->valid())  //vérifie s'il ya au moins une ligne dans le résultat
				{
					$retvalue =  $result->FetchAll();	
				}
				else 
				{
					$retvalue = null;
				}
			}
			else 
			{
				$this->exception = "workflow::rechercher() - ".$result->getDebugInfo() . ' in ' . $req;
				$retvalue = null;
			}
		}
		else 
		{
			$this->exception = "workflow::rechercher() - ".$lprepare->getDebugInfo() . ' in ' . $req;
			$retvalue = null;
		}
	  	$this->db->disconnect();
		return $retvalue;
				
 }


 	/**
	 * function qui fabrique la liste déroulante des types de fichier à exporter
	 *
	 * @param unknown_type $pattributes
	 * @param unknown_type $pdefault
	 * @param unknown_type $pchoisissez
	 * @return unknown
	 */
 	 function sel_option_etat_workflow($pattributes , $pdefault = null , $pchoisissez = null)
	{
		global $translate;
		$this->exception = "";
		
		$larr_option_search = array();
		$larr_option_search[] = array("code" => 0 , "value" => ucfirst($translate['archive']));
		$larr_option_search[] = array("code" => 1 , "value" => ucfirst($translate['en_cours']));
        
		$list = $this->select_multiple_tag($pattributes);
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
 * modification de tous les champs de la table workflow
 *
 * @return unknown
 */
public function modifier()
 {  
      $bool=false; 
 	  $retvalue = array();
	 
	  //initialisation du tableau de paramètres formels et effectifs pour la requête
	  $lparam_type = array();
	  $lparam_data = array();
	     		
	  $sql = " update workflow set  heuredebutwf = ?	, dureewf = ?	, archivewf = ?
	 	       where numworkflow = ? ";

	     $lparam_type[] = "text"; 
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "integer"; 
		 
		//$lparam_data[] = $this->format_date2database(trim($this->datedebutwf));
		$lparam_data[] = trim($this->heuredebutwf);
		$lparam_data[] = intval($this->dureewf);
		$lparam_data[] = intval($this->archivewf);
		//$lparam_data[] = intval($this->avancementwf);
		$lparam_data[] = intval($this->numworkflow);
		//print_r($lparam_data);
			
	   $this->connect_db();
	   //die($this->redraw_sql($sql , $lparam_data , $lparam_type));
	   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{   
				$bool = true;
			}
			else 
			{
				$this->exception = "workflow::modifier() - " .$result->getDebugInfo() . ' in ' . $sql;
				$retvalue = null;
			}
		}
		else 
		{
			$this->exception = "workflow::modifier() - " .$lprepare->getDebugInfo() . ' in ' . $sql;
			$retvalue = null;
		}

		$bool=true;
 		$this->db->disconnect(); 
		return $bool;
 } 	
	
 /**
  * fonction qui modifie uniquement l'état d'un workflow 
  *les deux états possibles sont : activé | désactivé
  * la valeur de l'état est passé dans lattribut $this->archivewf
  * @return unknown
  */
public function modifier_etat()
 {
      $bool=false; 
 	  $retvalue = array();
	 
	  //initialisation du tableau de paramètres formels et effectifs pour la requête
	  $lparam_type = array();
	  $lparam_data = array();
	  
   		
	  $sql = " update workflow set archivewf = ? where numworkflow = ? ";
	 
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "integer"; 
		 
		$lparam_data[] = intval($this->archivewf);
		$lparam_data[] = intval($this->numworkflow);
			
	   $this->connect_db();
	   //die($this->redraw_sql($sql , $lparam_data , $lparam_type));
	   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				$bool = true;
			}
			else 
			{
				$this->exception = "workflow::modifier_etat() - " .$result->getDebugInfo() . ' in ' . $sql;
				$retvalue = null;
			}
		}
		else 
		{
			$this->exception = "workflow::modifier_etat() - " .$lprepare->getDebugInfo() . ' in ' . $sql;
			$retvalue = null;
		}

		$bool=true;
 		$this->db->disconnect(); 
		return $bool;
 } 

 
 
 public function supprimer()
	 {
	      $bool=false; 
		  $this->exception = "";
					  
		  //initialisation du tableau de paramètres formels et effectifs pour la requête
		  $lparam_type = array();
		  $lparam_data = array();
		  
		  $lparam_type[] = "integer"; 
  		  
		  $sql = 'delete from workflow where numworkflow = ? ';
		   //   die($this->redraw_sql($sql,$lparam_data,$lparam_type); 
		   $this->connect_db();
		   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
			{
				$lparam_data[] = intval($this->numworkflow);

				if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
				{
					$bool=true;
				}
				else 
				{
					$this->exception = "workflow::supprimer() - ".$result->getDebugInfo() . ' in ' . $sql;
					$bool = false;
				}
			}
			else 
			{
				$this->exception = "workflow::supprimer() - ".$lprepare->getDebugInfo() . ' in ' . $sql;
				$bool = false;
			}
			   
		$this->db->disconnect();
		return $bool;
	}

	
/**
 * fonction de modification de la tâche courante dans un workflow
 * @author 	:	Bello Adamou<moustaphbi@yahoo.fr>
 * @return true si modification ok, false sinon
 */
 public function modifier_tachecourante()
 {
	     $bool=false; 
		 $this->exception = "";
					  
		 //initialisation du tableau de paramètres formels et effectifs pour la requête
		 $lparam_type = array();
		 $lparam_data = array();		  
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "integer"; 
		   	        
		 $sql = 'update workflow set numtache =  ?  where numworkflow = ? ';
		 
		 $lparam_data[] = intval($this->numtache);
		 $lparam_data[] = intval($this->numworkflow);
		 
		 //die($this->redraw_sql($sql , $lparam_data, $lparam_type));
					
			   $this->connect_db();
			   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
				{					
					
					if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
					{
						$bool=true;
					}
					else 
					{
						    $this->exception = "workflow::modifier_tachecourante() - ".$result->getDebugInfo() . ' in ' . $sql;
						    $bool = false;
					}
				}
				else 
				{
					$this->exception = "workflow::modifier_tachecourante() - ".$lprepare->getDebugInfo() . ' in ' . $sql;
					$bool = false;
				}
			   
		$this->db->disconnect();
		return $bool;
 }

 
 public function rechercher_circuit_tache()
 {   
      $retvalue = array();
      
      $this->exception = "";
	  
	  $lselect = " select codecircuit , numtache ";
	  $lfrom = " from workflow ";
	  $lwhere = " where (not numworkflow is null) ";
	  $land = " and numdoc = ? ";
	  
	  //initialisation du tableau de paramètres formels et effectifs pour la requête
	  $lparam_type = array();
	  $lparam_data = array();	  
	  $lparam_type[]="integer";	  
	  $lparam_data[]=intval($this->numdoc);
	  	  
	  $req = $lselect . $lfrom . $lwhere . $land ;
	  //die($this->redraw_sql($req , $lparam_data , $lparam_type));
	  
	  $this->connect_db();
	   if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				if ($result->valid())  //vérifie s'il ya au moins une ligne dans le résultat
				{
					$retvalue =  $result->FetchAll();	
				}
				else 
				{
					$retvalue = null;
				}
			}
			else 
			{
				$this->exception = "workflow::rechercher_circuit() - ".$result->getDebugInfo() . ' in ' . $req;
				$retvalue = null;
			}
		}
		else 
		{
			$this->exception = "workflow::rechercher_circuit() - ".$lprepare->getDebugInfo() . ' in ' . $req;
			$retvalue = null;
		}
	  	$this->db->disconnect();
		return $retvalue;
				
 }
 

 public function rechercher_mestaches()
 {   
      $retvalue = array();
      $this->exception = "";
	  
	  $lselect = " select w.numworkflow,w.datedebutwf,w.heuredebutwf,w.dureewf,w.avancementwf,w.codecircuit
	  , w.numtache , w.numdoc , w.archivewf , c.libcircuit , doc.titredoc , t.libtache , doc.typedoc
	  , t.dureetache , doc.codeuser , doc.codeusercours ";
	  $lfrom = " from workflow w
	  inner join circuit c on w.codecircuit = c.codecircuit 
	  inner join document doc on w.numdoc = doc.numdoc
	  inner join tache t on w.numtache = t.numtache	";
	  $lwhere = " where (not w.numworkflow is null) ";
	  $land = "and w.numdoc = ? ";
	  
	  //initialisation du tableau de paramètres formels et effectifs pour la requête
	  $lparam_type = array(); 
	  $lparam_data = array();
	  $lparam_type[]="integer";	  
	  $lparam_data[]=intval($this->numdoc);
	  	  
	  $req = $lselect . $lfrom . $lwhere . $land ;
	  
	  //die($this->redraw_sql($req , $lparam_data , $lparam_type));
	  $this->connect_db();
	   if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				if ($result->valid())  //vérifie s'il ya au moins une ligne dans le résultat
				{
					$retvalue =  $result->FetchAll();	
				}
				else 
				{
					$retvalue = null;
				}
			}
			else 
			{
				$this->exception = "workflow::rechercher_mestaches() - ".$result->getDebugInfo() . ' in ' . $req;
				$retvalue = null;
			}
		}
		else 
		{
			$this->exception = "workflow::rechercher_mestaches() - ".$lprepare->getDebugInfo() . ' in ' . $req;
			$retvalue = null;
		}
	  	$this->db->disconnect();//print_r($retvalue);
		return $retvalue;				
 }
 
 public function rechercher_workflowcourant()
 {   
      $retvalue = array();      
      $this->exception = "";
	  
	  $lselect = " select numworkflow ";
	  $lfrom = " from workflow ";
	  $lwhere = " where (not numworkflow is null) ";
	  $land = " and numdoc = ? and archivewf != 1 ";
	  
	  //initialisation du tableau de paramètres formels et effectifs pour la requête
	  $lparam_type = array();
	  $lparam_data = array();	  
	  $lparam_type[]="integer";	  
	  $lparam_data[]=intval($this->numdoc);
	  	  
	  $req = $lselect . $lfrom . $lwhere . $land ;
	  //die($this->redraw_sql($req , $lparam_data , $lparam_type));
	  
	  $this->connect_db();
	   if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				if ($result->valid())  //vérifie s'il ya au moins une ligne dans le résultat
				{
					$retvalue =  $result->FetchAll();	
				}
				else 
				{
					$retvalue = null;
				}
			}
			else 
			{
				$this->exception = "workflow::rechercher_workflowcourant() - ".$result->getDebugInfo() . ' in ' . $req;
				$retvalue = null;
			}
		}
		else 
		{
			$this->exception = "workflow::rechercher_workflowcourant() - ".$lprepare->getDebugInfo() . ' in ' . $req;
			$retvalue = null;
		}
	  	$this->db->disconnect();
		return $retvalue;
				
 }

	
}


?>