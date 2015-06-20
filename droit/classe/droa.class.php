<?php
/**
 * @version			1.0
 * @package			Administration
 * @subpackage		Droit d'acc�s
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits r�serv�s
 * @license			INTERFACE SA
 * @author 			Bello
 * @desc			Sp�cification des droits pour l'acc�s au fonctinnalit�s de l'application
 * @creationdate	????
 * @updates
 * 	# samedi 20 juin 2009 (Patrick Mveng)
 * 		- suppression de la fonction init()
 */

 $siteweb = new Application();
 require_once($siteweb->get_document_root().'\classe\table.class.php');
 
  
class droit extends Table
{
	 
 public function rechercher()
 {
  	  $retvalue = array();
	  
	  $req = "Select codedroa,libdroa,niveau_accesdroa from droit ";
	  $lwhere = " where not codedroa is null ";
	  $land = "";
	  
	  //initialisation du tableau de param�tres formels
	  $lparam_type = array();
	  //initialisation du tableau de param�tres effectifs pour la requ�te
	  $lparam_data = array();
	  	  
	  if (trim($this->libdroa) != "")
	  {
	  	switch(intval($this->sel_option_libdroa))
		{
			case 0:	//cas "commencant par "
				  	$land .= " and libdroa like '" . $this->libdroa . "%'";
				break;
			case 1:	//cas "contient "
				  	$land .= " and libdroa like '%" . $this->libdroa . "%'";
				break;				
			case 3:	//cas "finissant par "
			  	$land .= " and libdroa like '%" . $this->libdroa . "'";
				break;
			case 4:	//cas "est �gal �"
				  	$land .= " and libdroa = '" . $this->libdroa . "'";			
				break;
		}

	  }
	  
	  if (trim($this->niveau_accesdroa) != "")
	  {
	  	switch(intval($this->sel_option_niveau_accesdroa))
		{
			
			case 1:	//cas "inf�rieur ou �gal "
				  	$land .= " and niveau_accesdroa <= '" . $this->niveau_accesdroa . "'";
				break;				
			case 2:	//cas "sup�rieur ou �gal "
			  	$land .= " and niveau_accesdroa >= '" . $this->niveau_accesdroa . "'";
				break;
			case 0:	//cas "est �gal �"
				  	$land .= " and niveau_accesdroa = '" . $this->niveau_accesdroa . "'";			
				break;
		}

	  }
	  
	  $req .= $lwhere . $land ;
	
	  $this->connect_db();
	  if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				
				if ($result->valid())  //v�rifie s'il ya au moins une ligne dans le r�sultat
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

  public function insertion()
 {
      $data = ($_POST) ? $_POST : $_GET;
      $bool=false; 
	  
	  //initialisation du tableau de param�tres formels
	  $lparam_type = array();
	  //initialisation du tableau de param�tres effectifs pour la requ�te
	  $lparam_data = array();
	 
if (isset($data['codedroit_create']) && isset($data['libdroit_create']) && isset($data['niveau_accesdroit_create'])) 
{      
       $sql = 'INSERT INTO droit VALUES("'.$data['codedroit_create'].'", "'.$data['libdroit_create'].'", "'.$data['niveau_accesdroit_create'].'")'; 
       
	   $this->connect_db();
	   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				
				if ($result->valid())  //v�rifie s'il ya au moins une ligne dans le r�sultat
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
				    $this->exception = "droa::insertion() - ".$result->getMessage() . ' in ' . $sql;
				    $retvalue = null;
			}
		}
		else 
		{
			$this->exception = "droa::insertion() - ".$lprepare->getMessage() . ' in ' . $sql;
			$retvalue = null;
		}
	   $bool=true;
}    
else 
{ 
       $bool=false; 
}  
       //$this->db->disconnect();
	   return $bool;
}


public function modification()
 {
      $data = ($_POST) ? $_POST : $_GET;
      $bool=false; 
 	  $retvalue = array();
	  
	  //initialisation du tableau de param�tres formels
	  $lparam_type = array();
	  //initialisation du tableau de param�tres effectifs pour la requ�te
	  $lparam_data = array();
	  
if (isset($data['code']) && isset($data['name']) && isset($data['surname']) && isset($data['email']) && isset($data['login']) && isset($data['password'])) 
{ 
 $sql = 'UPDATE droit SET codedroa="'.$data['code'].'",nomdroa="'.$data['name'].'",prenomdroa="'.$data['surname'].'",emaildroa="'.$data['email'].'",logindroa="'.$data['login'].'",passworddroa="'.$data['pasword'].'",numteldroa="'.$data['telpor'].'",numburdroa="'.$data['telbur'].'",numfaxdroa="'.$data['fax'].'",datenaissancedroa="'.$data['datenaiss'].'",typedroa="'.$data['type'].'",categoriedroa="'.$data['categorie'].'",villedroa="'.$data['ville'].'",paysdroa="'.$data['pays'].'",manager="'.$data[block].'"'; 
        
	   $this->connect_db();
	   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				
				if ($result->valid())  //v�rifie s'il ya au moins une ligne dans le r�sultat
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
				    $this->exception = "droa::modification() - ".$result->getMessage() . ' in ' . $sql;
				    $retvalue = null;
			}
		}
		else 
		{
			$this->exception = "droa::modification() - ".$lprepare->getMessage() . ' in ' . $sql;
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
	  
	  //initialisation du tableau de param�tres formels
	  $lparam_type = array();
	  //initialisation du tableau de param�tres effectifs pour la requ�te
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
				$retvalue =  true;	//chargement effectu� avec succ�s
				
				//lib�rer la m�moire
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
	  
		//lib�rer la m�moire
		unset($lparam_data);
		unset($lparam_type);
		unset($req);
		unset($result);
		
		$this->db->disconnect();
		return $retvalue;
				
 }

public function suppression()
 {
      $data = ($_POST) ? $_POST : $_GET;
      $bool=false; 
 	  $retvalue = array();
	  
	   //initialisation du tableau de param�tres formels
	  $lparam_type = array();
	  //initialisation du tableau de param�tres effectifs pour la requ�te
	  $lparam_data = array();

if (isset($data['suppr'])) 
{ 
       $sql = 'DELETE from droit where codedroa='.$codesuppr.''; 
       
	   $this->connect_db();
	   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				
				if ($result->valid())  //v�rifie s'il ya au moins une ligne dans le r�sultat
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
				    $this->exception = "droa::suppression() - ".$result->getMessage() . ' in ' . $sql;
				    $retvalue = null;
			}
		}
		else 
		{
			$this->exception = "droa::suppression() - ".$lprepare->getMessage() . ' in ' . $sql;
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

}

?>