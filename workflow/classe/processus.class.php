<?php

/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Processus
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello
 * @desc			Spécification d'un processus du système de workflow
 * @creationdate	????
 * @updates
 * 	# samedi 20 juin 2009 (Patrick Mveng)
 * 		- suppression de la fonction init()
 * 
 * 	# vendredi 26 juin 2009 by patrick mveng<patrick.mveng@interfacesa.local>
 * 		- ajout des attributs $numprocessus , $libprocessus , $dureeprocessus , $etatprocessus  
 * 		- ajout de la fonction generer_numero qui génère automatiquement un nouveau numéro de processus
 * 		- ajout de quelques accesseurs
 * 		- ajout de la fonction existe qui vérifie l'existence d'un processus dans la base de données
 * 		- ajout de la fonction sel_option_search_etat()
 */

 $siteweb = new Application();
 require_once($siteweb->get_document_root().'\classe\table.class.php');

class processus extends Table
{	
  
	public $numprocessus;	//numéro du processus
	public $libprocessus;	//libellé du processus
	public $dureeprocessus;	//durée du processus
	public $etatprocessus;	//état du processus
	public $supprimprocessus;	//état de suppression logique
	
	function __construct()
	{
		parent::init();
	}
	
	/**
	 * accesseurs
	 */
	public function get_numero(){return $this->numprocessus;}
	public function get_libelle(){return $this->libprocessus;}
	public function get_duree(){return $this->dureeprocessus;}
	
	
	/**
	 * fonction qui vérifie l'existence d'un processus dans la base de données
	 * @access 		:	public
	 * @author 		:	patrick mveng<patrick.mveng@interfacesa.local>
	 * @param Entier - $pcode - le numéro du processus
	 * @return true si existe, sinon faux
	 */
	public function existe($pcode = null)
	{
	
		$lcode = (is_null($pcode)) ? $this->numprocessus : $pcode;
			
		$this->exception = "";
		$retvalue = false;
		
		$req = " select numprocessus from processus where numprocessus = ? ";
		$lparam_type = array("integer");
		$lparam_data = array($this->numprocessus);
		
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
				$this->exception = "processus::existe() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = false;
			}
		}
		else 
		{
			$this->exception = "processus::existe() - ".$lprepare->getMessage() . ' in ' . $req;
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
	 * fonction de génération d'un nouveau numéro de processus
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
		
		$req = " select max(numprocessus) as code_max from processus ";		
		
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
				$this->exception = "processus::generer_numero() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = -1;
			}
		}
		else 
		{
			$this->exception = "processus::generer_numero() - ".$lprepare->getMessage() . ' in ' . $req;
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
					  
		  //initialisation du tableau de paramètres formels
		  $lparam_type = array();
		  //initialisation du tableau de paramètres effectifs pour la requête
		  $lparam_data = array();
		  
		 $lparam_type[] = "text"; 
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "integer"; 
  		 $lparam_type[] = "integer"; 
  		   
		 $sql = 'update processus set libprocessus =  ? , dureeprocessus = ? , etatprocessus = ?
		  where numprocessus = ? ';
		       
			   $this->connect_db();
			   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
				{
					
					$lparam_data[] = trim($this->libprocessus);
					$lparam_data[] = ($this->dureeprocessus);
					$lparam_data[] = (trim($this->etatprocessus) == "") ? 0 : intval($this->etatprocessus);
					$lparam_data[] = intval($this->numprocessus);

					if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
					{
						$bool=true;
					}
					else 
					{
						    $this->exception = "processus::modifier() - ".$result->getMessage() . ' in ' . $sql;
						    $bool = false;
					}
				}
				else 
				{
					$this->exception = "processus::modifier() - ".$lprepare->getMessage() . ' in ' . $sql;
					$bool = false;
				}
			   
		$this->db->disconnect();
		return $bool;
	}


	/**
	 * fonction qui sélectionne des processus correspondants à des critères.
	 * @desc	:	:les attributs de la classe font office de critères de recherche
	 * @access 		:	public
	 * @param 	- définir l'attribut etatprocessus pour rechercher les processus activés ou non
	 * @param 	- définir les attributs dureeprocessus sel_option_dureeprocessus pour rechercher les processus ayant une certaine durée
	 * @param 	- définir les attributs libprocessus et sel_option_libprocessus pour rechercher les processus ayant un certain libellé
	 *@author 		:	bello
	 * @return 		:	un tableau de tableaux de processus, si OK, NULL sinon
	 */
 public function rechercher()
 {
  	  $retvalue = array();
  	  //initialisation du tableau de paramètres formels
	  $lparam_type = array();
	  //initialisation du tableau de paramètres effectifs pour la requête
	  $lparam_data = array();
	  
	  $req = "select numprocessus,libprocessus, dureeprocessus ,etatprocessus,supprimeprocessus from processus ";
	  $lwhere = " where not numprocessus is null ";
	  $land = " and supprimeprocessus = 0 ";
	  

	  $lparam_data4sum = array();
	  $lparam_type4sum = array();
	  
	  if (trim($this->libprocessus) != "")
	  {
	  	switch(intval($this->sel_option_libprocessus))
		{   
			case 0:	//cas "commencant par "
				  	$land .= " and libprocessus like ? ";
				  	$lparam_data[] = trim($this->libprocessus)."%";
				  	$lparam_data4sum[] = trim($this->libprocessus)."%";
				  	$lparam_type[] = "text";
				  	$lparam_type4sum[] = "text";
				break;
			case 1:	//cas "contient "
				  	$land .= " and libprocessus like ? ";
				  	$lparam_data[] = "%".trim($this->libprocessus)."%";
				  	$lparam_data4sum[] = "%".trim($this->libprocessus)."%";
				  	$lparam_type[] = "text";
				  	$lparam_type4sum[] = "text";
				break;				
			case 3:	//cas "finissant par "
			  	$land .= " and libprocessus like ? ";
			  	$lparam_data[] = "%".trim($this->libprocessus);
			  	$lparam_data4sum[] = "%".trim($this->libprocessus);
				 $lparam_type[] = "text";
				 $lparam_type4sum[] = "text";
				break;
			case 4:	//cas "est égal à"
				  	$land .= " and libprocessus = ? ";			
				  	$lparam_data[] = trim($this->libprocessus);
				  	$lparam_data4sum[] = trim($this->libprocessus);
				  	$lparam_type[] = "text";
				  	$lparam_type4sum[] = "text";
				break;
		}

	  }
	  
	  if (trim($this->dureeprocessus) != "")
	  {
	  	switch(intval($this->sel_option_dureeprocessus))
		{
			case 0:	//cas "est égal à"
				  	$land .= " and dureeprocessus = ? ";
				  	$lparam_data[] = intval($this->dureeprocessus);
				  	$lparam_data4sum[] = intval($this->dureeprocessus);
				  	$lparam_type[] = "integer";
				  	$lparam_type4sum[] = "integer";
				break;
			case 2:	//cas "supérieure ou égale à "
				  	$land .= " and dureeprocessus >= ? " ;
				  	$lparam_data[] = intval($this->dureeprocessus);
				  	$lparam_data4sum[] = intval($this->dureeprocessus);
				  	$lparam_type[] = "integer";
				  	$lparam_type4sum[] = "integer";
				break;				
			case 1:	//cas "inférieure ou égale à "
			  	$land .= " and dureeprocessus <= ? " ;
			  	$lparam_data[] = intval($this->dureeprocessus);
			  	$lparam_data4sum[] = intval($this->dureeprocessus);
				 $lparam_type[] = "integer";
				 $lparam_type4sum[] = "integer";
				break;
			
		}

	  }
	  
	  //critère sur l'état d'activation
	  if (trim($this->etatprocessus) != "")
	  {
		 	$land .= " and etatprocessus = ? ";
		 	$lparam_data[] = intval($this->etatprocessus);
		 	$lparam_data4sum[] = intval($this->etatprocessus);
		 	$lparam_type[] = "integer";
		 	$lparam_type4sum[] = "integer";
	  }
	  
	  //$req = "select numprocessus,libprocessus, (select sum(dureetache) from tache where (not numprocessus is null) {$land} ) as  dureeprocessus ,etatprocessus,supprimeprocessus from processus ";
	  $req .= $lwhere . $land ;
	  
	  //$lparam_data = array_merge($lparam_data , $lparam_data4sum);
	  //$lparam_type = array_merge($lparam_type , $lparam_type4sum);
	  
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
				$this->exception = "processus::rechercher() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = null;
			}
		}
		else 
		{
			$this->exception = "processus::rechercher() - ".$lprepare->getMessage() . ' in ' . $req;
			$retvalue = null;
		}
		$this->db->disconnect();
		return $retvalue;
				
 }

 /**
  * fonction qui insère une ligne processus dans la bd
  * @access 		:	public
  *
  * @return unknown
  */
 public function insertion()
 {
      $bool=false; 
 	  $this->exception = "";
	  
	  //initialisation du tableau de paramètres formels
	  $lparam_type = array();
	  //initialisation du tableau de paramètres effectifs pour la requête
	  $lparam_data = array();

		 $sql = 'insert into processus values( ? , ?, ? , ? , ? )';
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "text"; 
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "integer"; 
		  
		       $this->connect_db();
			   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
				{
					
					$lparam_data[] = intval($this->numprocessus);
					$lparam_data[] = trim($this->libprocessus);
					$lparam_data[] = ($this->dureeprocessus);
					$lparam_data[] = (trim($this->etatprocessus) == "") ? 0 : intval($this->etatprocessus);
					$lparam_data[] = (trim($this->supprimprocessus) == "") ? 0 : intval($this->supprimprocessus);
					
			       //die($this->redraw_sql($sql , $lparam_data , $lparam_type));
					
					if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
					{
							$bool = true;
					}
					else 
					{
						    $this->exception = "processus::insertion() - ".$result->getMessage() . ' in ' . $sql;
						    $bool=false;
					}
				}
				else 
				{
					$this->exception = "processus::insertion() - ".$lprepare->getMessage() . ' in ' . $sql;
					$bool=false;
				}
			   
		
		$this->db->disconnect();
		return $bool;
}

	/**
	 * fonction qui retourne une liste déroulante de processus
	 *	@author 	:	patrick mveng<patrick.mveng@interfacesa.local>
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
		if (! is_null($this->listeprocessus))
		{
			foreach($this->listeprocessus as $obj)
			{
				if (trim($obj["libprocessus"]) != "")
				{
					$list .= "<option value=\"".$obj['numprocessus']."\"";
					if ((trim(strval($pdefault)) == trim(strval($obj['numprocessus'])) ))
					{
						$list .= " selected";
					}
					$list .= ">".$obj["libprocessus"]."</option>\n";
				}
			}
		}
		$list .= "</select>\n";
		
		//libérer la mémoire
		unset($larr_option_processus);
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
  		   
		 $sql = 'update processus set supprimeprocessus =  ? where numprocessus = ? ';
		       
		   $this->connect_db();
		   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
			{
				
				$lparam_data[] = 1;
				$lparam_data[] = intval($this->numprocessus);

				if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
				{
					$bool=true;
				}
				else 
				{
					    $this->exception = "processus::supprimer() - ".$result->getMessage() . ' in ' . $sql;
					    $bool = false;
				}
			}
			else 
			{
				$this->exception = "processus::supprimer() - ".$lprepare->getMessage() . ' in ' . $sql;
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
 	  
 	  $lparam_type[] = "integer";
	  $lparam_data[] = $this->numprocessus;	
	  
	  $req = "Select numprocessus,libprocessus, (select sum(dureetache) from tache where numprocessus = ? ) as  dureeprocessus,etatprocessus,supprimeprocessus from processus ";
	  $lwhere = " where not numprocessus is null ";
	  $land = "";
	  
	  //$land .= " and numprocessus = '" . $this->numprocessus . "'";
	  if (trim($this->numprocessus) != "")
	  {
	  	$land .= " and numprocessus = ? ";
	  	$lparam_type[] = "integer";
	  	$lparam_data[] = $this->numprocessus;	
	  }		
	  		
	   $req .= $lwhere . $land ;
	  
	   $this->connect_db();
	   if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				$lrow = $result->FetchRow();
				
				//Transformer les noms de colonnes en champ de l'objet processus en cours
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
				$this->exception = "processus::charger() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = false;
			}
		}
		else 
		{
			$this->exception = "processus::charger() - ".$lprepare->getMessage() . ' in ' . $req; 
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