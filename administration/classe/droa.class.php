<?php
/**
 * @version			1.0
 * @package			Administration
 * @subpackage		Droit d'accès
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello
 * @desc			Spécification des droits pour l'accès au fonctinnalités de l'application
 * @creationdate	????
 * @updates
 * 	# samedi 20 juin 2009 (Patrick Mveng)
 * 		- suppression de la fonction init()
 */

 $siteweb = new Application();
 require_once($siteweb->get_document_root().'\classe\table.class.php');
 
  
class droit extends Table
{
	 
	public $codegroup;
	
	public function droit()
	{
		$this->init();
	}
	
 public function rechercher()
 {
  	  $retvalue = array();
	  
	  $lselect = " select D.codeaction ";
	  $lfrom = " from droit D ";
	  $lwhere = " where ( not codeaction is null ) ";
	  $land = "";
	  
	  //initialisation du tableau de paramètres formels
	  $lparam_type = array();
	  //initialisation du tableau de paramètres effectifs pour la requête
	  $lparam_data = array();
	  	  
	  if (trim($this->codegroup) != "")
	  {
			$land .= " and D.codegroup = ? ";
			$lparam_data[] = $this->codegroup;
			$lparam_type[] = "integer";
	  }
	  
	  if (trim($this->loginuser) != "")
	  {
			$lfrom .= " inner join utilisateur u on D.codegroup = u.codegroup ";	
	  		$land .= " and u.loginuser = ? ";
			$lparam_data[] = $this->loginuser;
			$lparam_type[] = "text";
	  }
	  
	  $req .= $lselect . $lfrom . $lwhere . $land ;
	
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
				$this->exception = "droit::rechercher() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = null;
			}
		}
		else 
		{
			$this->exception = "droit::rechercher() - ".$lprepare->getMessage() . ' in ' . $req;
			$retvalue = null;
		}
		$this->db->disconnect();
		return $retvalue;
				
 }


 public function charger()
 {
 	  $retvalue = array();
	  
	  //initialisation du tableau de paramètres formels
	  $lparam_type = array();
	  //initialisation du tableau de paramètres effectifs pour la requête
	  $lparam_data = array();
	  
	  $req = "Select codedroa,libdroa,niveau_accesdroa from droit ";
	  $lwhere = " where not codedroa is null ";
	  $land = "";
	  
	  //$land .= " and codedroa = '" . $this->codedroa . "'";
	  if (trim($this->codedroa) != "")
	  {
	  	$land .= " and codedroa = ? ";
	  	$lparam_type = "integer";
	  	$lparam_data = $this->codedroa;	
	  }
	 		
	  $req .= $lwhere . $land ;
	  
	  $this->connect_db();
	   if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				$lrow = $result->FetchRow();
				
				//Transformer les noms de colonnes en champ de l'objet Profil en cours
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
				$this->exception = "droa::charger() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = false;
			}
		}
		else 
		{
			$this->exception = "droa::charger() - ".$lprepare->getMessage() . ' in ' . $req; 
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
 
 

public function supprimer()
 {
      $bool=false; 
	  
      $sql = " delete from droit ";
      $lwhere = "";
      
	   //initialisation du tableau de paramètres formels
	  $lparam_type = array();
	  //initialisation du tableau de paramètres effectifs pour la requête
	  $lparam_data = array();
	  
	  if (trim($this->codegroup) != "")
	  {
	  	$lwhere = " where codegroup = ? ";
	  	$lparam_data[] = $this->codegroup;
	  	$lparam_type[] = "integer";
	  	
	  }
	  
	  $sql .= $lwhere;

	  //die($this->redraw_sql($sql , $lparam_data , $lparam_type));
	  
		   $this->connect_db();
		   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
			{
				if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
				{
					$bool = true;				
					}
				else 
				{
					    $this->exception = "droa::supprimer() - ".$result->getMessage() . ' in ' . $sql;
					    $bool = false;
				}
			}
			else 
			{
				$this->exception = "droa::supprimer() - ".$lprepare->getMessage() . ' in ' . $sql;
				 $bool = false;
			}
	  
		$this->db->disconnect();
		return $bool;
 }
 
 /**
  * fonction qui ajoute une permission d'un groupe dans la BD
  * @return true si modification ok, false sinon
  */
 public function ajouter()
 {
		  $bool=false; 
		  $this->exception = "";
		  //initialisation du tableau de paramètres formels et effectifs pour la requête
		  $lparam_type = array();
		  $lparam_data = array();

		  $sql = 'insert into droit values( ? , ? )';
		  
		  $lparam_type[] = "text"; 
		  $lparam_type[] = "integer"; 
		  
		       $this->connect_db();
			   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
				{
					$lparam_data[] = trim($this->codeaction);
					$lparam_data[] = intval($this->codegroup);
					
					if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
					{
							$bool = true;
					}
					else 
					{
						    $this->exception = "droa::ajouter() - ".$result->getMessage() . ' in ' . $sql;
						    $bool=false;
					}
				}
				else 
				{
					$this->exception = "droa::ajouter() - ".$lprepare->getMessage() . ' in ' . $sql;
					$bool=false;
				}
			   	
		$this->db->disconnect();
		return $bool;
}


}

?>