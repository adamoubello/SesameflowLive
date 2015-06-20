
<?php

/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Département
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou <moustaphbi@yahoo.fr>
 * @desc			Spécification du profil auquel appartient un acteur du système de workflow
 * @creationdate	20 Juillet 2009
 */

 $siteweb = new Application();
 require_once($siteweb->get_document_root().'\classe\table.class.php');
  
class profil extends Table
{

	function __construct()
	{
	parent::init();
	}
	
	/**
	 * fonction de génération d'un nouveau numéro de profil
 	 * @access 		:	public
	 * @author 		:	Bello Adamou <moustaphbi@yahoo.fr>
	 **/
	public function generer_numero($psysteme = false)
	{	
		$this->exception = "";
		$retvalue = -1;
		$lparam_type = array();
		$lparam_data = array();
		
		if ($psysteme == true)  $func = "min";
		else $func = "max";
		$req = " select {$func}(codeprofil) as code_max from profil ";		
		
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
				$this->exception = "profil::generer_numero() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = -1;
			}
		}
		else 
		{
			$this->exception = "profil::generer_numero() - ".$lprepare->getMessage() . ' in ' . $req;
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
  * fonction qui ajoute un profil dans la BD
  * @return true si modification ok, false sinon
  */
 public function ajouter()
 {
		  $bool=false; 
		  $this->exception = "";
		  //initialisation du tableau de paramètres formels et effectifs pour la requête
		  $lparam_type = array();
		  $lparam_data = array();

		  $sql = 'insert into profil values( ? , ? )';
		  
		  $lparam_type[] = "integer"; 
		  $lparam_type[] = "text"; 
		  //$lparam_type[] = "integer"; 
		  
		       $this->connect_db();
			   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
				{
					
					$lparam_data[] = intval($this->codeprofil);
					$lparam_data[] = trim($this->libprofil);
					//$lparam_data[] = trim($this->supprimeprofil);
					
					if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
					{
							$bool = true;
					}
					else 
					{
						    $this->exception = "profil::ajouter() - ".$result->getMessage() . ' in ' . $sql;
						    $bool=false;
					}
				}
				else 
				{
					$this->exception = "profil::ajouter() - ".$lprepare->getMessage() . ' in ' . $sql;
					$bool=false;
				}
			   	
		$this->db->disconnect();
		return $bool;
}
	
	
	/**
	 * fonction qui retourne une liste déroulante de profil
	 * @author 	:	Bello Adamou <moustaphbi@yahoo.fr>
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
		if (! is_null($this->listeprofil))
		{
			foreach($this->listeprofil as $obj)
			{
				if (trim($obj["libprofil"]) != "")
				{
					$list .= "<option value=\"".$obj['codeprofil']."\"";
					if ((trim(strval($pdefault)) == trim(strval($obj['codeprofil'])) ))
					{
						$list .= " selected";
					}
					$list .= ">".$obj["libprofil"]."</option>\n";
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
	  
	  $req = "select codeprofil,libprofil from profil ";
	  $lwhere = " where not codeprofil is null ";
	  $land = "";
	 
	  $lparam_type = array();
	  $lparam_data = array();
	  
	  if (trim($this->libprofil) != "")
	  {
	  	switch(intval($this->sel_option_libprofil))
		{
			case 0:	//cas "commencant par "
				  	$land .= " and libprofil like ? ";
					$lparam_data[] = $this->libprofil . "%";
					$lparam_type[] = "text";
				break;
			case 1:	//cas "contient "
				  	$land .= " and libprofil like ? ";
					$lparam_data[] = "%" . $this->libprofil . "%";
					$lparam_type[] = "text";
				break;				
			case 3:	//cas "finissant par "
			  	    $land .= " and libprofil like ? ";
				    $lparam_data[] = "%" . $this->libprofil;
				    $lparam_type[] = "text";
				break;
			case 4:	//cas "est égal à"
				  	$land .= " and libprofil = ? ";
					$lparam_data[] = $this->libprofil;
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
				$this->exception = "profil::rechercher() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = null;
			}
		}
		else 
		{
			$this->exception = "profil::rechercher() - ".$lprepare->getMessage() . ' in ' . $req;
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
	  
	  $req = "Select codeprofil,libprofil from profil ";
	  $lwhere = " where not codeprofil is null ";
	  $land = "";
	  
	  if (trim($this->codeprofil) != "")
	  {
	  	$land .= " and codeprofil = ? ";
	  	$lparam_type = "integer";
	  	$lparam_data = $this->codeprofil;	
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
				$this->exception = "profil::charger() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = false;
			}
		}
		else 
		{
			$this->exception = "profil::charger() - ".$lprepare->getMessage() . ' in ' . $req; 
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
 * fonction de modification d'un profil dans la BD
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
		    
		  $sql = 'update profil set libprofil =  ? where codeprofil = ? ';
		       
			   $this->connect_db();
			   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
				{
					$lparam_data[] = trim($this->libprofil);
					$lparam_data[] = intval($this->codeprofil);
					
					if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
					{
						$bool=true;
					}
					else 
					{
						    $this->exception = "profil::modifier() - ".$result->getMessage() . ' in ' . $sql;
						    $bool = false;
					}
				}
				else 
				{
					$this->exception = "profil::modifier() - ".$lprepare->getMessage() . ' in ' . $sql;
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
  		  
		  $sql = 'delete from profil where codeprofil = ? ';
		       
		  $this->connect_db();
		  if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
			{
				$lparam_data[] = intval($this->codeprofil);

				if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
				{
					$bool=true;
				}
				else 
				{
					$this->exception = "profil::supprimer() - ".$result->getMessage() . ' in ' . $sql;
					$bool = false;
				}
			}
			else 
			{
				$this->exception = "profil::supprimer() - ".$lprepare->getMessage() . ' in ' . $sql;
				$bool = false;
			}
			   
		$this->db->disconnect();
		return $bool;
	}


function printprofilSelector($attributes)  
 {  
 global $listeprofil;
 $html = $this->select_ouvrante_tag($attributes);  
 
 foreach ($listeprofil as $lvaleur) { 
 $html .= "<option value=". $lvaleur["codeprofil"] ."> ". $lvaleur["libprofil"] ." </option>\n";
 global $lindex;  
 }  
 $html .= '</select>';
 return $html;  
 }  

}

?>