<?php
/**
 * @version			1.0
 * @package			GED
 * @subpackage		Champ
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			William<william.nkingne@laposte.net>
 * @desc			Spécification d'un champ de formulaire
 * @creationdate	lundi 29 juin 2009 
 * 
 */


$chemin = dirname(__FILE__);
$chemin = str_replace("\ged\classe","",$chemin);
require_once($chemin.'\classe\application.class.php');
$siteweb = new Application();


require_once($siteweb->get_document_root().'\classe\table.class.php');
ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2

class champ extends Table {
	public $numchamp;	
	public $nomchamp;	
	public $typechamp;
	public $numdoc;
	public $valeurdonnee;
	
	
	public function champ()
	{
		$this->init();
	}
	
	public function getNumchamp (){
		return $this->numchamp;
	}
	
	public function getTypechamp (){
		return $this->typechamp;
	}
	
	public function getNumdoc (){
		return $this->numdoc;
	}
	
	public function setNumchamp ($valeur){
		$this->numchamp=$valeur;
	}
	
	public function setTypechamp ($valeur){
		$this->typechamp=$valeur;
	}
	
	public function modify(){
		
		$retvalue = false;

		$req = "update champ set valeurdonnee = ? where numchamp= ?";

		$lparam_type=array();
        $lparam_data=array();

		$lparam_type[]="text";		
		$lparam_type[]="integer";


		$this->connect_db();
		if (!$this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type))){
            $lparam_data[]=trim($this->valeurdonnee);
		    $lparam_data[]=trim($this->numchamp);
			if (!$this->db->isError ($result = $lprepare->Execute($lparam_data))){

				$retvalue =  true;
								
			}
			else {
				$this->exception = "champ::modify() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = false;
			}
		}
		else {
			$this->exception = "champ::modify()- ".$lprepare->getMessage() . ' in ' . $req;
			$retvalue = false;
		}
		$this->db->disconnect();
		return $retvalue;
	}
	
	public function create(){
		
		$retvalue = false;

		$req = "insert into champ values( ?, ? , ? , ? , ?)";

		$lparam_type=array();
		$lparam_type[]="integer";
		$lparam_type[]="text";
		$lparam_type[]="text";
		$lparam_type[]="integer";
		$lparam_type[]="text";
		
		$lparam_data=array();
		$lparam_data[]= intval($this->numchamp);
		$lparam_data[]= trim($this->nomchamp);
		$lparam_data[]=trim($this->typechamp);
		$lparam_data[]=trim($this->numdoc);
		$lparam_data[]=trim($this->valeurdonnee);
		
		$this->connect_db();
		//die($this->redraw_sql($req , $lparam_data , $lparam_type));
		if (!$this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type))){
			if (!$this->db->isError ($result = $lprepare->Execute($lparam_data))){

				$retvalue =  true;
				
			}
			else {
				$this->exception = "champ::create() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = false;
			}
		}
		else {
			$this->exception = "champ::create() - ".$lprepare->getMessage() . ' in ' . $req;
			$retvalue = false;
		}
		$this->db->disconnect();
		return $retvalue;
	}
	
	public function generer_numero()
	{
	
		$this->exception = "";
		$retvalue = -1;
		$lparam_type = array();
		$lparam_data = array();
		
		$req = " select max(numchamp) as nbr_max from champ ";		
		
		$this->connect_db();
		if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				
				if ($result->valid())  //vérifie s'il ya au moins une ligne dans le résultat
				{

					$obj2 = $result->FetchRow();
					$retvalue = $obj2["nbr_max"] + 1;
				}
				else 
				{
					$retvalue = -1;
				}
			}
			else 
			{
				$this->exception = "champ::generer_numero() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = -1;
			}
		}
		else 
		{
			$this->exception = "champ::generer_numero() - ".$lprepare->getMessage() . ' in ' . $req;
			$retvalue = -1;
		}
		$this->db->disconnect();
		
		unset($lprepare);
		unset($result);
		unset($lparam_data);
		unset($lparam_type);
		unset($lsql);
		
		return $retvalue;	
		
	}
	
	
 public function rechercher()
 {
      $retvalue = array();
	  
	  $lselect = "select numchamp,nomchamp,typechamp,numdoc,valeurdonnee ";
	  $lfrom = " from champ c ";
	  $lwhere = " where not numchamp is null ";
	  $land = "";
	  
	  $lparam_type = array();
	  $lparam_data = array();
	  
	  if (trim($this->numdoc) != "")
	  {
	  	$land .= " and c.numdoc = ? ";
	  	$lparam_type[] = "integer";
	  	$lparam_data[] = $this->numdoc;
	  }
	  
	  $req = $lselect . $lfrom;
	  $req .= $lwhere . $land ;
	  
	  $this->connect_db();
	  //die($this->redraw_sql($req , $lparam_data , $lparam_type));
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
				$this->exception = "champ::rechercher() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = null;
			}
		}
		else 
		{
			$this->exception = "champ::rechercher() - ".$lprepare->getMessage() . ' in ' . $req;
			$retvalue = null;
		}
		
	    $this->db->disconnect(); 
		return $retvalue;
 }
	
	public function update_valeur(){
		
		$retvalue = false;

		$req = " update champ set valeurdonnee = ? where nomchamp= ? and numdoc = ? ";

		$lparam_type=array();
        $lparam_data=array();

		$lparam_type[]="text";		
		$lparam_type[]="text";		
		$lparam_type[]="integer";


		$this->connect_db();
		
		if (!$this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type))){

			$lparam_data[]=trim($this->valeurdonnee);
		    $lparam_data[]=trim($this->nomchamp);
		    $lparam_data[]=intval($this->numdoc);
			
		    if (!$this->db->isError ($result = $lprepare->Execute($lparam_data))){

				$retvalue =  true;
								
			}
			else {
				$this->exception = "champ::update_valeur() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = false;
			}
		}
		else {
			$this->exception = "champ::update_valeur()- ".$lprepare->getMessage() . ' in ' . $req;
			$retvalue = false;
		}
		$this->db->disconnect();
		return $retvalue;
	}
 
	
}
?>