<?php

 $siteweb = new Application();
 require_once($siteweb->get_document_root().'\classe\table.class.php');

class circuit extends Table
{

	/** 
	 * code du circuit
	 * @access 	:	public
	 * @var integer
	 */
	public $codecircuit;
	
	/** 
	 * libellé du circuit
	 * @access 	:	public
	 * @var string
	 */
	public $libcircuit;
	
	/** 
	 * durée du circuit
	 * @access 	:	public
	 * @var integer
	 */
	public $dureecircuit;
	
		/** 
	 * numéro du processus du circuit
	 * @access 	:	public
	 * @var integer
	 */
	public $numprocessus;
	
	public function get_numero_processus(){return $this->numprocessus;}
	
	function __construct()
	{
		parent::init();
	}

/**
  * fonction qui ajoute un circuit dans la BD
  *
  * @return unknown
  */
	 public function ajouter()
 	{
      $bool=false; 
 	  $this->exception = "";
	  
	  //initialisation du tableau de paramètres formels
	  $lparam_type = array();
	  //initialisation du tableau de paramètres effectifs pour la requête
	  $lparam_data = array();

		 $sql = 'insert into circuit values( ? , ?, ? , ? , ? )';
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "text"; 
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "integer"; 
		 
		  //die($this->redraw_sql($sql , $lparam_data , $lparam_type));
		       $this->connect_db();
			   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
				{
					
					$lparam_data[] = intval($this->codecircuit);
					$lparam_data[] = trim($this->libcircuit);
					$lparam_data[] =  (trim($this->dureecircuit) == "") ? "NULL" : $this->dureecircuit;
					$lparam_data[] = (trim($this->numprocessus) == "") ? "NULL" : intval($this->numprocessus);
					$lparam_data[] = 0;
					
			       //die($this->redraw_sql($sql , $lparam_data , $lparam_type));
					
					if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
					{
							$bool = true;
					}
					else 
					{
						    $this->exception = "circuit::ajouter() - ".$result->getMessage() . ' in ' . $sql;
						    $bool=false;
					}
				}
				else 
				{
					$this->exception = "circuit::ajouter() - ".$lprepare->getMessage() . ' in ' . $sql;
					$bool=false;
				}
			   
		
		$this->db->disconnect();
		return $bool;
}
	
/**
  * fonction qui ajoute une tâche à un circuit dans la BD
  *	lorsque qu'une tache précédente ou suivante n'est pas définie, on envoie NULL dans la colonne correspondante
  * @return unknown
  * 
  */
	 public function ajouter_tache()
 	{
      $bool=false; 
 	  $this->exception = "";
 	  global $gtache;
	  
	  //initialisation du tableau de paramètres formels
	  $lparam_type = array();
	  //initialisation du tableau de paramètres effectifs pour la requête
	  $lparam_data = array();

	  if (is_null($gtache->numtacheprec)) $lnumtacheprec = "NULL";
	  else $lnumtacheprec = intval($gtache->numtacheprec);
	  
	  if (is_null($gtache->numtachesuiv)) $lnumtachesuiv = "NULL";
	  else $lnumtachesuiv = intval($gtache->numtachesuiv);
	  
		 $sql = "insert into circuit_tache values( ? , ?, ? , ? , {$lnumtacheprec} , {$lnumtachesuiv} )";
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "integer"; 
		 //$lparam_type[] = "integer"; 
		 //$lparam_type[] = "integer"; 
		  
		       $this->connect_db();
			   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
				{
					
					$lparam_data[] = intval($gtache->numtache);
					$lparam_data[] = intval($gtache->codecircuit);
					$lparam_data[] = (trim($gtache->codeprofil) != "") ? intval($gtache->codeprofil) : -1;
					$lparam_data[] = (trim($gtache->codeuser) != "") ? intval($gtache->codeuser) : -1;
					//$lparam_data[] = (is_null($gtache->numtacheprec)) ?  null :  intval($gtache->numtacheprec);
					//$lparam_data[] = (is_null($gtache->numtachesuiv)) ? "NULL" : intval($gtache->numtachesuiv);
					
			       //die($this->redraw_sql($sql , $lparam_data , $lparam_type));
					
					if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
					{
							$bool = true;
					}
					else 
					{
						    $this->exception = "circuit::ajouter_tache() - ".$result->getMessage() . ' in ' . $sql;
						    $bool=false;
					}
				}
				else 
				{
					$this->exception = "circuit::ajouter_tache() - ".$lprepare->getMessage() . ' in ' . $sql;
					$bool=false;
				}
			   
		
		$this->db->disconnect();
		return $bool;
}



/**
 * fonction d'archivage d'un circuit dans la BD
 * @author 	:	patrick mveng<patrick.mveng@interfacesa.local>
 *
 * @return true si modification ok, false sinon
 */
	 public function archiver()
	 {
	      $bool=false; 
			$this->exception = "";
					  
		  //initialisation du tableau de paramètres formels
		  $lparam_type = array();
		  //initialisation du tableau de paramètres effectifs pour la requête
		  $lparam_data = array();
		  
  	     $lparam_type[] = "integer"; 
  		   
		 $sql = 'update circuit set archivecircuit =  1 
		  where codecircuit = ? ';
		       
			   $this->connect_db();
			   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
				{
					
					$lparam_data[] = intval($this->codecircuit);

					if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
					{
						$bool=true;
					}
					else 
					{
						    $this->exception = "circuit::archiver() - ".$result->getMessage() . ' in ' . $sql;
						    $bool = false;
					}
				}
				else 
				{
					$this->exception = "circuit::archiver() - ".$lprepare->getMessage() . ' in ' . $sql;
					$bool = false;
				}
			   
		$this->db->disconnect();
		return $bool;
	}

	/**
	 * fonction de génération d'un nouveau numéro de circuit
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
		
		$req = " select max(codecircuit) as code_max from circuit ";		
		
		$this->connect_db();
		if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				
				if ($result->valid())  //vérifie s'il ya au moins une ligne dans le résultat
				{

					$obj2 = $result->FetchRow();
					$retvalue = $obj2["code_max"] + 1;
				}
				else 
				{
					$retvalue = -1;
				}
			}
			else 
			{
				$this->exception = "circuit::generer_numero() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = -1;
			}
		}
		else 
		{
			$this->exception = "circuit::generer_numero() - ".$lprepare->getMessage() . ' in ' . $req;
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
 * fonction de modification d'un circuit dans la BD
 * @author 	:	patrick mveng<patrick.mveng@interfacesa.local>
 *
 * @return true si modification ok, false sinon
 */
	 public function modifier()
	 {
	      $bool=false; 
			$this->exception = "";
					  
		  //initialisation du tableau de paramètres formels
		  $lparam_type = array();
		  //initialisation du tableau de paramètres effectifs pour la requête
		  $lparam_data = array();
		  
		 $lparam_type[] = "text"; 
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "integer"; 
  	     $lparam_type[] = "integer"; 
  		   
		 $sql = 'update circuit set libcircuit =  ? , dureecircuit = ? 
		 , numprocessus = ?
		  where codecircuit = ? ';
		       
			   $this->connect_db();
			   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
				{
					
					$lparam_data[] = trim($this->libcircuit);
					$lparam_data[] = ($this->dureecircuit);
					$lparam_data[] = ($this->numprocessus);
					$lparam_data[] = intval($this->codecircuit);

					if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
					{
						$bool=true;
					}
					else 
					{
						    $this->exception = "circuit::modifier() - ".$result->getMessage() . ' in ' . $sql;
						    $bool = false;
					}
				}
				else 
				{
					$this->exception = "circuit::modifier() - ".$lprepare->getMessage() . ' in ' . $sql;
					$bool = false;
				}
			   
		$this->db->disconnect();
		return $bool;
	}
	
	
 public function rechercher()
 {
 	  $retvalue = array();
	 
	  $req = "select c.codecircuit,libcircuit,dureecircuit 
	  , c.numprocessus , p.libprocessus
	  from circuit c
	  inner join processus p on c.numprocessus = p.numprocessus "; 
	  $lwhere= " where not codecircuit is null ";
	  $land = "";
	 
	  //initialisation du tableau de paramètres formels
	  $lparam_type = array();
	  //initialisation du tableau de paramètres effectifs pour la requête
	  $lparam_data = array();
	 //$reqdep = "Select libdep from departement";
	  
	  if (trim($this->libcircuit) != "")
	  {
	  	switch(intval($this->sel_option_libcircuit))
		{   
			case 0:	//cas "commencant par "
				  	$land .= " and libcircuit like '" . $this->libcircuit . "%'";
				break;
			case 1:	//cas "contient "
				  	$land .= " and libcircuit like '%" . $this->libcircuit . "%'";
				break;				
			case 3:	//cas "finissant par "
			  	$land .= " and libcircuit like '%" . $this->libcircuit . "'";
				break;
			case 4:	//cas "est égal à"
				  	$land .= " and libcircuit = '" . $this->libcircuit . "'";			
				break;
		}

	  }
	  
	  if (trim($this->dureecircuit) != "")
	  {
	  	switch(intval($this->sel_option_dureecircuit))
		{
			case 0:	//cas "est égal à"
				  	$land .= " and dureecircuit = '" . $this->dureecircuit . "'";
				break;
			case 1:	//cas "supérieure ou égale à "
				  	$land .= " and dureecircuit <= '" . $this->dureecircuit . "'";
				break;				
			case 2:	//cas "inférieure ou égale à "
			  	$land .= " and dureecircuit >= '" . $this->dureecircuit . "'";
				break;
		}

	  }
	  
	  if (trim($this->numprocessus) != "")
	  {
	  	$land .= " and c.numprocessus = ? ";
	  	$lparam_type[] = "integer";
	  	$lparam_data[] = intval($this->numprocessus);
	  }
	 
	   $req .= $lwhere . $land ;	  
	
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
				$this->exception = "circuit::rechercher() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = null;
			}
		}
		else 
		{
			$this->exception = "circuit::rechercher() - ".$lprepare->getMessage() . ' in ' . $req;
			$retvalue = null;
		}
		$this->db->disconnect();
		return $retvalue;		
 }

 public function insertion()
 {
      $bool=false; 
 	  $retvalue = array();
	  
	  //initialisation du tableau de paramètres formels et effectifs pour la requête
	  $lparam_type = array();
	  $lparam_data = array();
	  
if (($codecircuit) && ($libcircuit) && ($dureecircuit)) 
{ 
 $sql = 'INSERT INTO circuit VALUES("'.$this->$codecircuit.'", "'.$this->$libcircuit.'", "'.$this->$dureecircuit.'")'; 
       
	   $this->connect_db();
	   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
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
			$this->exception = "circuit::insertion() - ".$result->getMessage() . ' in ' . $sql;
			$retvalue = null;
			}
		}
		else 
		{
			$this->exception = "circuit::insertion() - ".$lprepare->getMessage() . ' in ' . $sql;
			$retvalue = null;
		}
	   $bool=true;
}    
else 
{ 
       $bool=false;
}  
       $this->db->disconnect();
       return $bool;
}

  public function charger()
 {
  	  $retvalue = array();
	  
	  $req = "Select codecircuit,libcircuit,dureecircuit , c.numprocessus 
	  from circuit c
	  inner join processus p on c.numprocessus = p.numprocessus ";
	  $lwhere = " where not codecircuit is null ";
	  $land = "";
	  
	  //$land .= " and codecircuit = '" . $this->codecircuit . "'";
	   if (trim($this->codecircuit) != "")
	  {
	  	$land .= " and codecircuit = ? ";
	  	$lparam_type = "integer";
	  	$lparam_data = $this->codecircuit;	
	  }		
	  	 		
	   $req .= $lwhere . $land ;
	  
	   $this->connect_db();
	   if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				$lrow = $result->FetchRow();
				
				//Transformer les noms de colonnes en champ de l'objet utilisateur en cours
				foreach ($lrow as $lchamp => $lvaleur)
				{
					$this->$lchamp = $lvaleur;
				}
				$retvalue =  true;	//chargement effectué avec succès
				
				//libérer la mémoire
				unset($lchamp);
				unset($lvaleur);
			}
			else 
			{
				$this->exception = "circuit::charger() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = false;
			}
		}
		else 
		{
			$this->exception = "circuit::charger() - ".$lprepare->getMessage() . ' in ' . $req; 
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
		global $translate;
		
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

	public function supprimer()
	 {
	      $bool=false; 
			$this->exception = "";
					  
		  //initialisation du tableau de paramètres formels
		  $lparam_type = array();
		  //initialisation du tableau de paramètres effectifs pour la requête
		  $lparam_data = array();
		  
		 $lparam_type[] = "integer"; 
  		   
		 $sql = 'delete from circuit where codecircuit = ? ';
		       
		   $this->connect_db();
		   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
			{
				
				$lparam_data[] = intval($this->codecircuit);

				if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
				{
					$bool=true;
				}
				else 
				{
					    $this->exception = "circuit::supprimer() - ".$result->getMessage() . ' in ' . $sql;
					    $bool = false;
				}
			}
			else 
			{
				$this->exception = "circuit::supprimer() - ".$lprepare->getMessage() . ' in ' . $sql;
				$bool = false;
			}
			   
		$this->db->disconnect();
		return $bool;
	}

	/**
	 * fonction de suppression de toutes les tâches d'un circuit
	 *
	 * @return unknown
	 */
	public function supprimer_tache()
	 {
	      $bool=false; 
			$this->exception = "";
					  
		  //initialisation du tableau de paramètres formels
		  $lparam_type = array();
		  //initialisation du tableau de paramètres effectifs pour la requête
		  $lparam_data = array();
		  
		 $lparam_type[] = "integer"; 
  		   
		 $sql = 'delete from circuit_tache where codecircuit = ? ';
		       
		   $this->connect_db();
		   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
			{
				
				$lparam_data[] = intval($this->codecircuit);

				if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
				{
					$bool=true;
				}
				else 
				{
					    $this->exception = "circuit::supprimer_tache() - ".$result->getMessage() . ' in ' . $sql;
					    $bool = false;
				}
			}
			else 
			{
				$this->exception = "circuit::supprimer_tache() - ".$lprepare->getMessage() . ' in ' . $sql;
				$bool = false;
			}
			   
		$this->db->disconnect();
		return $bool;
	}
	
	
public function rechercher_route()
{   
      $retvalue = array();      
      $this->exception = "";
	  
	  $lselect = " select ct.numtache, ct.codeprofil , ct.codeuser ";
	  $lfrom = " from circuit_tache ct ";
	  $lwhere = " where (not ct.codecircuit is null) ";
	  $land = " and ct.codecircuit = ? and ct.numtacheprec = ? ";
	  
	  //initialisation du tableau de paramètres formels et effectifs pour la requête
	  $lparam_type = array();	  
	  $lparam_data = array();
	  $lparam_type[]="integer";
	  $lparam_type[]="integer";		  
	  $lparam_data[]=intval($this->codecircuit);	    
	  $lparam_data[]=intval($this->numtacheprec);
	  	  
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
				$this->exception = "workflow::rechercher_route() - ".$result->getDebugInfo() . ' in ' . $req;
				$retvalue = null;
			}
		}
		else 
		{
			$this->exception = "workflow::rechercher_route() - ".$lprepare->getDebugInfo() . ' in ' . $req;
			$retvalue = null;
		}
	  	$this->db->disconnect();
		return $retvalue;				
 }	


public function rechercher_tacheinitiale()
{   
      $retvalue = array();      
      $this->exception = "";
	  
	  $lselect = " select ct.numtache, ct.codeprofil , ct.codeuser ";
	  $lfrom = " from circuit_tache ct ";
	  $lwhere = " where (not ct.codecircuit is null) ";
	  $land = " and ct.codecircuit = ? and ct.numtacheprec is null ";
	  
	  //initialisation du tableau de paramètres formels et effectifs pour la requête
	  $lparam_type = array();	  
	  $lparam_data = array();
	  $lparam_type[]="integer";
	  $lparam_type[]="integer";		  
	  $lparam_data[]=intval($this->codecircuit);	    
	  $lparam_data[]=intval($this->numtacheprec);
	  	  
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
				$this->exception = "workflow::rechercher_tacheinitiale() - ".$result->getDebugInfo() . ' in ' . $req;
				$retvalue = null;
			}
		}
		else 
		{
			$this->exception = "workflow::rechercher_tacheinitiale() - ".$lprepare->getDebugInfo() . ' in ' . $req;
			$retvalue = null;
		}
	  	$this->db->disconnect();
		return $retvalue;				
 }	
 
 
}

?>