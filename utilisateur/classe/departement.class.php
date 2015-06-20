
<?php

/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Département
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou <moustaphbi@yahoo.fr>
 * @desc			Spécification d'un département auquel appartient un acteur du système de workflow
 * @creationdate	????
 * @updates
 * 	# samedi 20 juin 2009 (Patrick Mveng)
 * 		- suppression de la fonction init()
 */

 $siteweb = new Application();
 require_once($siteweb->get_document_root().'\classe\table.class.php');
  
class departement extends Table
{

	function __construct()
	{
		parent::init();
	}
	
	/**
	 * fonction de génération d'un nouveau numéro de département
 	 * @access 		:	public
	 * @author 		:	Bello Adamou <moustaphbi@yahoo.fr>
	 * 	 */
	public function generer_numero($psysteme = false)
	{	
		$this->exception = "";
		$retvalue = -1;
		$lparam_type = array();
		$lparam_data = array();
		
		if ($psysteme == true)  $func = "min";
		else $func = "max";
		$req = " select {$func}(codedep) as code_max from departement ";		
		
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
				$this->exception = "departement::generer_numero() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = -1;
			}
		}
		else 
		{
			$this->exception = "departement::generer_numero() - ".$lprepare->getMessage() . ' in ' . $req;
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
  * fonction qui ajoute un département dans la BD
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

		  $sql = 'insert into departement values( ? , ? )';
		  
		  $lparam_type[] = "integer"; 
		  $lparam_type[] = "text"; 
		  
		       $this->connect_db();
			   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
				{
					
					$lparam_data[] = intval($this->codedep);
					$lparam_data[] = trim($this->libdep);
					
					if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
					{
							$bool = true;
					}
					else 
					{
						    $this->exception = "departement::ajouter() - ".$result->getMessage() . ' in ' . $sql;
						    $bool=false;
					}
				}
				else 
				{
					$this->exception = "departement::ajouter() - ".$lprepare->getMessage() . ' in ' . $sql;
					$bool=false;
				}
			   	
		$this->db->disconnect();
		return $bool;
}
	
	
	/**
	 * fonction qui retourne une liste déroulante de département
	 *	@author 	:	patrick mveng<patrick.mveng@interfacesa.local>
	 * @param array $pattributes	- attributs de la balise select
	 * @param string $pdefault - valeur de l'option à afficher par défaut
	 * @param string -  $pchoisissez - message
	 * @return string - code HTML de la liste déroulante
	 */
	function liste_deroulante($pattributes , $pdefault = null , $pchoisissez = null)
	{
		$this->exception = "";
		
		$list = $this->select_ouvrante_tag($pattributes);
		$list .= "<option value=\"\">$pchoisissez</option>\n";
		if (! is_null($this->listedep))
		{
			foreach($this->listedep as $obj)
			{
				if (trim($obj["libdep"]) != "")
				{
					$list .= "<option value=\"".$obj['codedep']."\"";
					if ((trim(strval($pdefault)) == trim(strval($obj['codedep'])) ))
					{
						$list .= " selected";
					}
					$list .= ">".$obj["libdep"]."</option>\n";
				}
			}
		}
		$list .= "</select>\n";
		
		//libérer la mémoire
		unset($obj);
		
		return $list;
	}
	
 public function rechercher()
 {
      $retvalue = array();
	  
	  $req = "select codedep,libdep from departement ";
	  $lwhere = " where not codedep is null ";
	  $land = "";
	  
	  //text,integer,float,date
	  $lparam_type = array();
	  $lparam_data = array();
	  
	  if (trim($this->libdep) != "")
	  {
	  	switch(intval($this->sel_option_libdep))
		{
			case 0:	//cas "commencant par "
				  	$land .= " and libdep like ? ";
					$lparam_data[] = $this->libdep . "%";
					$lparam_type[] = "text";
				break;
			case 1:	//cas "contient "
				  	$land .= " and libdep like ? ";
					$lparam_data[] = "%" . $this->libdep . "%";
					$lparam_type[] = "text";
				break;				
			case 3:	//cas "finissant par "
			  	    $land .= " and libdep like ? ";
				    $lparam_data[] = "%" . $this->libdep;
				    $lparam_type[] = "text";
				break;
			case 4:	//cas "est égal à"
				  	$land .= " and libdep = ? ";
					$lparam_data[] = $this->libdep;
					$lparam_type[] = "text";				
				break;
		}
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
				$this->exception = "departement::rechercher() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = null;
			}
		}
		else 
		{
			$this->exception = "departement::rechercher() - ".$lprepare->getMessage() . ' in ' . $req;
			$retvalue = null;
		}
		
	    $this->db->disconnect(); 
		return $retvalue;
 }

 
 public function charger()
 {
  	  $retvalue = false;
	  
	  //initialisation du tableau de paramètres formels et effectifs pour la requête
	  $lparam_type = array();
	  $lparam_data = array();
	  
	  $req = "Select codedep,libdep from departement ";
	  $lwhere = " where not codedep is null ";
	  $land = "";
	  
	  if (trim($this->codedep) != "")
	  {
	  	$land .= " and codedep = ? ";
	  	$lparam_type = "integer";
	  	$lparam_data = $this->codedep;	
	  }
	 		
	  $req .= $lwhere . $land ;
	  
	  $this->connect_db();
	   if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				$lrow = $result->FetchRow();
				
				//Transformer les noms de colonnes en champ de l'objet Département en cours
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
				$this->exception = "departement::charger() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = false;
			}
		}
		else 
		{
			$this->exception = "departement::charger() - ".$lprepare->getMessage() . ' in ' . $req; 
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
 * fonction de modification d'un département dans la BD
 * @author 	:	Bello Adamou <moustaphbi@yahoo.fr>
 * @return true si modification ok, false sinon
 */
	 public function modifier()
	 {
	      $bool=false; 
		  $this->exception = "";
					  
		  //initialisation du tableau de paramètres formels et effectifs pour la requête
		  $lparam_type = array();
		  $lparam_data = array();
		  
		 $lparam_type[] = "text"; 
		 $lparam_type[] = "integer"; 
		    
		 $sql = 'update departement set libdep =  ? where codedep = ? ';
		       
			   $this->connect_db();
			   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
				{
					
					$lparam_data[] = trim($this->libdep);
					$lparam_data[] = intval($this->codedep);
					
					if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
					{
						$bool=true;
					}
					else 
					{
						    $this->exception = "departement::modifier() - ".$result->getMessage() . ' in ' . $sql;
						    $bool = false;
					}
				}
				else 
				{
					$this->exception = "departement::modifier() - ".$lprepare->getMessage() . ' in ' . $sql;
					$bool = false;
				}
			   
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
  		 $sql = 'delete from departement where codedep = ? ';
		       
		   $this->connect_db();
		   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
			{
				$lparam_data[] = intval($this->codedep);

				if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
				{
					$bool=true;
				}
				else 
				{
					$this->exception = "departement::supprimer() - ".$result->getMessage() . ' in ' . $sql;
					$bool = false;
				}
			}
			else 
			{
				$this->exception = "departement::supprimer() - ".$lprepare->getMessage() . ' in ' . $sql;
				$bool = false;
			}
			   
		$this->db->disconnect();
		return $bool;
	}

//public function suppression()
// {
//      $data = ($_POST) ? $_POST : $_GET;
//      $bool=false; 
// 	  $retvalue = array();
//	  
//	  //initialisation du tableau de paramètres formels
//	  $lparam_type = array();
//	  //initialisation du tableau de paramètres effectifs pour la requête
//	  $lparam_data = array();
//	  
//if (isset($data['suppr'])) 
//{ 
//       $sql = 'DELETE from utilisateur where codedep='.$codesuppr.''; 
//       
//	   $this->connect_db();
//	   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
//		{
//			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
//			{
//				
//				if ($result->valid())  //vérifie s'il ya au moins une ligne dans le résultat
//				{
//					$retvalue =  $result->FetchAll();	
//				}
//				else 
//				{
//					$retvalue = null;
//				}
//			}
//			else 
//			{
//				    $this->exception = "departement::suppression() - ".$result->getMessage() . ' in ' . $sql;
//				    $retvalue = null;
//			}
//		}
//		else 
//		{
//			$this->exception = "departement::suppression() - ".$lprepare->getMessage() . ' in ' . $sql;
//			$retvalue = null;
//		}
//	        $bool=true;
//}    
//else 
//{ 
//            $bool=false;
//	    
//}  
//            $this->db->disconnect();
//	        return $bool;
//}


function printDepSelector($attributes)  
 {  
 global $listedep;
 
 //if (!is_array($tableaudep))   echo " \$tableaudep n'est pas un tableau <br> \n";  
 $html = $this->select_ouvrante_tag($attributes);  
 
 foreach ($listedep as $lvaleur) { 
 $html .= "<option value=". $lvaleur["codedep"] ."> ". $lvaleur["libdep"] ." </option>\n";
 global $lindex;  
 }  
 $html .= '</select>';
 return $html;  
 }  

}

?>