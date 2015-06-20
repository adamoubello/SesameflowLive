<?php
/**
 * @version			1.0
 * @package			GED
 * @subpackage		Formulaire
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			William<william.nkingne@laposte.net>
 * @desc			Spécification d'un formulaire dans le système de workflow
 * @creationdate	lundi 15 juin 2009
 * @todo 
 * 	# Définir les méthodes verrouiller, deverrouiller, historique
 */

$chemin = dirname(__FILE__);
$chemin = str_replace("\ged\classe","",$chemin);
require_once($chemin.'\classe\application.class.php');
$siteweb = new Application();


require_once($siteweb->get_document_root().'\ged\classe\document.class.php');
ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2


//Définition de la classe qui gère un document
class Formulaire extends Document  {

	//Accesseurs
	public function getDatecreation (){
		return $this->datecreation;
	}
	
	public function getHeurecreation (){
		return $this->heurecreation;
	}

	//Modificateurs
	public function setDatecreation($valeur=null){
		$this->datecreation=date("d/m/Y");;
	}

	public function setHeurecreation(){
		$this->heurecreation=date("H:i:s");
	}

	//Autres méthodes de la classe
	public function create(){
		
		$retvalue = false;

		$req = "insert into document (numdoc , titredoc , datecreation, heurecreation, codeuser , numtache , archive, typedoc )
		values( ?, ?, ?, ?, ?, ? , ?, ?)";

		$lparam_type=array();
		$lparam_type[]="integer";
		$lparam_type[]="text";
		$lparam_type[]="date";
		$lparam_type[]="text";
		$lparam_type[]="integer";
		$lparam_type[]="integer";
		$lparam_type[]="integer";
		$lparam_type[]="text";

		$lparam_data=array();
		$lparam_data[]=$this->numdoc;
		$lparam_data[]=trim($this->titredoc);
		$lparam_data[]= date("Y-m-d");
		$lparam_data[]= date("H:m:s");
		$lparam_data[]=intval($this->codeuser);
		$lparam_data[]=intval($this->numtache);
		$lparam_data[]=0;
        $lparam_data[]=trim($this->typedoc);


		$this->connect_db();
		if (!$this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type))){
			if (!$this->db->isError ($result = $lprepare->Execute($lparam_data))){

				$retvalue =  true;

			}
			else {
				$this->exception = "formulaire::create() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = false;
			}
		}
		else {
			$this->exception = "formulaire::create() - ".$lprepare->getMessage() . ' in ' . $req;
			$retvalue = false;
		}
		$this->db->disconnect();
		return $retvalue;
	}
	
	public function archiver (){
		$bool=false; 
		$this->exception = "";
					  
		//initialisation du tableau de paramètres formels
		$lparam_type = array();
		//initialisation du tableau de paramètres effectifs pour la requête
		$lparam_data = array();
		  
  	    $lparam_type[] = "integer";

		$sql = 'update document set archive =  1 where numdoc = ? ';
		       
		$this->connect_db();
		if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))	{
			$lparam_data[] = intval($this->numdoc);
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))	{
				$bool=true;
			}
			else {
				$this->exception = "document::archiver() - ".$result->getMessage() . ' in ' . $sql;
				$bool = false;
			}
		}
		else {
			$this->exception = "document::archiver() - ".$lprepare->getMessage() . ' in ' . $sql;
			$bool = false;
		}
		$this->db->disconnect();

		return $bool;
	}
	
	public function verrouiller (){

	}

	public function deverrouiller (){
		
	}
	
	public function historique (){
		
	}
	
	public function delete()
	{
		$retvalue = false;

		$req = "delete from document where numdoc='".$this->numdoc."'";

		$lparam_type=array();
		$lparam_type[]="integer";
		/*$lparam_type[]="text";
		$lparam_type[]="text";
		$lparam_type[]="text";
		$lparam_type[]="text";
		$lparam_type[]="integer";*/

		$lparam_data=array();
		$lparam_data[]=$this->numdoc;
		/*$lparam_data[]=trim($this->titredoc);
		$lparam_data[]=trim($this->tagdoc);
		$lparam_data[]=trim($this->datecreation);
		$lparam_data[]=trim($this->heurecreation);
		$lparam_data[]=($this->numtache);*/


		$this->connect_db();
		if (!$this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type))){
			if (!$this->db->isError ($result = $lprepare->Execute($lparam_data))){


				$retvalue =  true;
				//echo 'Suppression réussie!';


			}
			else {
				$this->exception = "document::delete() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = false;
			}
		}
		else {
			$this->exception = "document::delete() - ".$lprepare->getMessage() . ' in ' . $req;
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
		
		$req = " select max(numdoc) as nbr_max from document ";		
		
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
				$this->exception = "formulaire::generer_numero() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = -1;
			}
		}
		else 
		{
			$this->exception = "formulaire::generer_numero() - ".$lprepare->getMessage() . ' in ' . $req;
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
}
?>