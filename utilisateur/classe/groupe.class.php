<?php

/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Groupe
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou <moustaphbi@yahoo.fr>
 * @desc			Spécification du module de gestion du groupe d'utilisateur
 * @creationdate	????
 */

 $siteweb = new Application();
 require_once($siteweb->get_document_root().'\classe\table.class.php');

class groupe extends Table
{	
	public $codegroup;	//code du groupe
	public $libgroup;	//libellé du groupe
	
	public function __construct()
	{
		$this->init();
	}
	
	/**
	 * accesseurs
	 */
	
	public function get_numero(){return $this->codegroup;}
	public function get_libelle(){return $this->libgroup;}
		
	/**
	 * fonction qui vérifie l'existence d'un groupe dans la base de données
	 * @access 		:	public
	 * @author 		:	patrick mveng<patrick.mveng@interfacesa.local>
	 * @param Entier - $pcode - le code du groupe
	 * @return true si existe, sinon faux
	 */
	 
	public function existe($pcode = null)
	{
		$lcode = (is_null($pcode)) ? $this->numprocessus : $pcode;
			
		$this->exception = "";
		$retvalue = false;
		
		$req = " select codegroup from groupe where codegroup = ? ";
		$lparam_type = array("integer");
		$lparam_data = array($this->codegroup);
		
		$this->connect_db();
		if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				if ($result->valid())  //vérifie s'il ya au moins une ligne dans le résultat
				{
				    if ($obj = $result->FetchRow()) $retvalue = true;
				}
				else 
				{
					$retvalue = false;
				}
			}
			else 
			{
				$this->exception = "groupe::existe() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = false;
			}
		}
		else 
		{
			$this->exception = "groupe::existe() - ".$lprepare->getMessage() . ' in ' . $req;
			$retvalue = false;
		}
		$this->db->disconnect();
		
		unset($lprepare);
		unset($result);
		unset($lparam_data);
		unset($lparam_type);
		unset($req);
		unset($lcode);
		
		return $retvalue;			
	}
	
	/**
	 * fonction de génération d'un nouveau code de groupe
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
		
		$req = " select max(codegroup) as code_max from groupe ";		
		
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
				$this->exception = "groupe::generer_numero() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = -1;
			}
		}
		else 
		{
			$this->exception = "groupe::generer_numero() - ".$lprepare->getMessage() . ' in ' . $req;
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
		
	 public function modifier()
	 {
	      $bool=false; 
		  $this->exception = "";
					  
		  //initialisation du tableau de paramètres formels et effectifs pour la requête
		  $lparam_type = array();
		  $lparam_data = array();
		  
		 $lparam_type[] = "text"; 
		 $lparam_type[] = "integer"; 
		   		   
		 $sql = 'update groupe set libgroup =  ? 
		 where codegroup = ? ';
		       
			   $this->connect_db();
			   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
				{
					$lparam_data[] = trim($this->libgroup);
					$lparam_data[] = intval($this->codegroup);


					if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
					{
						$bool=true;
					}
					else 
					{
						$this->exception = "groupe::modifier() - ".$result->getMessage() . ' in ' . $sql;
						$bool = false;
					}
				}
				else 
				{
					$this->exception = "groupe::modifier() - ".$lprepare->getMessage() . ' in ' . $sql;
					$bool = false;
				}
			   
		$this->db->disconnect();
		return $bool;
	}

	/**
	 * fonction qui sélectionne les groupes correspondants à des critères.
	 * @desc	:	:les attributs de la classe font office de critères de recherche
	 * @access 		:	public
	 * @param 	- définir les attributs libprocessus et sel_option_libprocessus pour rechercher les processus ayant un certain libellé
	 * @author 		:	Bello Adamou <moustaphbi@yahoo.fr>
	 * @return 		:	un tableau de tableaux de groupe, si OK, NULL sinon
	 */
	 
 public function rechercher()
 {
  	  $retvalue = array();
	  $req = "select codegroup,libgroup from groupe ";
	  $lwhere = " where not codegroup is null ";
	  $land = " and supprimgroup = 0 ";
	  
	  //initialisation du tableau de paramètres formels et effectifs pour la requête
	  $lparam_type = array();
	  $lparam_data = array();
	  
	  if (trim($this->libgroup) != "")
	  {
	  	switch(intval($this->sel_option_libgroup))
		{   
			case 0:	//cas "commencant par "
				  	$land .= " and libgroup like '" . $this->libgroup . "%'";
				break;
			case 1:	//cas "contient "
				  	$land .= " and libgroup like '%" . $this->libgroup . "%'";
				break;				
			case 3:	//cas "finissant par "
			  	$land .= " and libgroup like '%" . $this->libgroup . "'";
				break;
			case 4:	//cas "est égal à"
				  	$land .= " and libgroup = '" . $this->libgroup . "'";			
				break;
		}

	  }
	  
	  //critère sur l'état de suprresion logique
	  /*if (trim($this->supprimprocessus) != "")
	  {
		 	$land .= " and supprimprocessus = ? ";
		 	$lparam_data[] = intval($this->supprimprocessus);
		 	$lparam_type[] = "integer";
	  }*/
	 
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
				$this->exception = "groupe::rechercher() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = null;
			}
		}
		else 
		{
			$this->exception = "groupe::rechercher() - ".$lprepare->getMessage() . ' in ' . $req;
			$retvalue = null;
		}
		$this->db->disconnect();
		return $retvalue;			
 }


 /**
  * fonction qui insère un groupe dans la bd
  * @access 		:	public
  * @return unknown
  */
 public function insertion()
 {
      $bool=false; 
 	  $this->exception = "";
	  
	  //initialisation du tableau de paramètres formels et effectifs pour la requête
	  $lparam_type = array();
	  $lparam_data = array();

		 $sql = 'insert into groupe values( ? , ?, ? )';
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "text"; 
		 //$lparam_type[] = "integer"; 
		 
		  
		       $this->connect_db();
			   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
				{
					$lparam_data[] = intval($this->codegroup);
					$lparam_data[] = trim($this->libgroup);
					$lparam_data[] = (trim($this->supprimgroup) == "") ? 0 : intval($this->supprimgroup);
					
					if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
					{
							$bool = true;
					}
					else 
					{
						    $this->exception = "groupe::insertion() - ".$result->getMessage() . ' in ' . $sql;
						    $bool=false;
					}
				}
				else 
				{
					$this->exception = "groupe::insertion() - ".$lprepare->getMessage() . ' in ' . $sql;
					$bool=false;
				}
			   
		$this->db->disconnect();
		return $bool;
}

	/**
	 * fonction qui retourne une liste déroulante de groupe
	 * @author 	:	patrick mveng<patrick.mveng@interfacesa.local>
	 * @param array $pattributes	- attributs de la balise select
	 * @param string $pdefault - valeur de l'option à afficher par défaut
	 * @param string -  $pchoisissez - message
	 * @return string - code HTML de la liste déroulante
	 */
	function liste_deroulante($pattributes , $pdefault = null , $pchoisissez = null)
	{
		global $translate;
		$this->exception = "";
		$list = $this->select_ouvrante_tag($pattributes);
		$list .= "<option value=\"\">$pchoisissez</option>\n";
		if (! is_null($this->listegroupe))
		{
			foreach($this->listegroupe as $obj)
			{
				if (trim($obj["libgroup"]) != "")
				{
					$list .= "<option value=\"".$obj['codegroup']."\"";
					if ((trim(strval($pdefault)) == trim(strval($obj['codegroup'])) ))
					{
						$list .= " selected";
					}
					$llibgroup = str_replace('\\' , "" , $obj["libgroup"] );
					$list .= ">".$llibgroup."</option>\n";
				}
			}
		}
		$list .= "</select>\n";
		
		//libérer la mémoire
		unset($larr_option_groupe);
		unset($obj);
		
		return $list;
	}
	
	function sel_option_search_etat($pattributes , $pdefault = null , $pchoisissez = null)
	{
		global $translate;
		$this->exception = "";
		
		$larr_option_search = array();
		$larr_option_search[] = array("code" => 1 , "value" => ucfirst($translate["active"]));
		$larr_option_search[] = array("code" => 0 , "value" => ucfirst($translate["desactive"]));
 		
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
		 $lparam_type[] = "integer"; 
  		   
		 $sql = 'update groupe set supprimgroup =  ? where codegroup = ? ';
		       
		   $this->connect_db();
		   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
			{
				$lparam_data[] = 1;
				$lparam_data[] = intval($this->codegroup);

				if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
				{
					$bool=true;
				}
				else 
				{
					    $this->exception = "groupe::supprimer() - ".$result->getMessage() . ' in ' . $sql;
					    $bool = false;
				}
			}
			else 
			{
				$this->exception = "groupe::supprimer() - ".$lprepare->getMessage() . ' in ' . $sql;
				$bool = false;
			}
			   
		$this->db->disconnect();
		return $bool;
	}


 public function charger()
 {
 	  $retvalue = array();
	  
	  $req = "Select codegroup,libgroup from groupe ";
	  $lwhere = " where not codegroup is null ";
	  $land = "";
	  
	  if (trim($this->codegroup) != "")
	  {
	  	$land .= " and codegroup = ? ";
	  	$lparam_type = "integer";
	  	$lparam_data = $this->codegroup;	
	  }		
	  		
	   $req .= $lwhere . $land ;
	  
	   $this->connect_db();
	   if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				$lrow = $result->FetchRow();
				
				//Transformer les noms de colonnes en champ de l'objet groupe en cours
				foreach ($lrow as $lchamp => $lvaleur)
				{
				$this->$lchamp = $lvaleur;
				}
				$this->libgroup = str_replace('\\' , "" , $this->libgroup);
				$retvalue =  true;	//chargement effectué avec succès
				
				//libérer la mémoire
				unset($lchamp);
				unset($lvaleur);
			}
			else 
			{
				$this->exception = "groupe::charger() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = false;
			}
		}
		else 
		{
			$this->exception = "groupe::charger() - ".$lprepare->getMessage() . ' in ' . $req; 
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
 
}

?>