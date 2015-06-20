<?php
/**
 * @version			1.0
 * @package			Administration
 * @subpackage		configuration
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Xaverie Télédzina <onana_carine@yahoo.fr>
 * @desc			Spécification d'un module de l'application
 * @creationdate	18 août 2009
 * @updates

 */


$siteweb = new Application();
require_once($siteweb->get_document_root().'\classe\table.class.php');


class Module extends Table
{
	public $typebdrh;
	public $hotebdrh;
	public $userbdrh;
	public $pwdbdrh;
	public $nombdrh;
	public $typebdpaie;
	public $hotebdpaie;
	public $userbdpaie;
	public $pwdbdpaie;
	public $nombdpaie;
	public $numchamp;
	public $nomchamp;
	public $typechamp;
	public $codemod;
	public $valeurdonnee;
	
	public $libmod;
	
	public function Module()
	{
		$this->init();
	}
	

	//Accesseurs
	public function getnumchamp(){
		return $this->numchamp;
	}

	public function getnomchamp($valeur=null){
		if (is_null($valeur)){
			return $this->nomchamp;
		}
		else {

		}
	}
	
	public function gettypechamp ($valeur){
		if (is_null($valeur)){
			return $this->typechamp;
		}
		else {

		}
	}
	
	public function getcodemod($valeur){
		return $this->codemod ;
	}
	
	public function getvaleurdonnee ($valeur){
		return $this->valeurdonnee ;
	}
	public function est_archive () {
		if ($this->archive=1){
			return 1;
		}
		else {
			return 0;
		}
	}
	
	public function getTagdoc (){
		return $this->tag;
	}
	
	public function get_chemin_acces() {
	   return $this->chemin_acces;
    }
	
	//Modificateurs
	public function setnumchamp($valeur=null){
		$this->numchamp=$valeur;
	}

    public function setnomchamp($valeur=null){
		$this->nomchamp=$valeur;
	}

	public function settypechamp($valeur=null){
		$this->typechamp=$valeur;
	}

	public function setcodemod ($valeur=null){
		$this->codemod=$valeur;
	}
	
	public function setTagdoc($valeur){
		$this->tag=$valeur;
	}
	
	public function setvaleurdonnee ($valeur){
		$this->valeurdonnee=$valeur;
	}

	/**
 * fonction qui vérifie l'existence d'un module
 * @author 	:	xaverie onana
 * @return true si existence ok, false sinon
 * 
 * */
	
	public function existe()
	{
		$lcodemod = (is_null($pcodemod)) ? $this->codemod: $pcodemod;

		$this->exception = "";
		$retvalue = false;

		$lselect = " select codemod, etatmod, libmod from module ";
		$lwhere = " where codemod = ? ";
		
		$req = $lselect . $lwhere;
		
		$lparam_type = array();
		$lparam_data = array();
		
		$lparam_type[] = "text";
		$lparam_data[] = trim($this->codemod);
		

		$this->connect_db();
		
		if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			
			//die($this->redraw_sql($req , $lparam_data , $lparam_type));
			
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
				$this->exception = "Module::existe() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = false;
			}
		}
		else
		{
			$this->exception = "Module::existe() - ".$lprepare->getMessage() . ' in ' . $req;
			$retvalue = false;
		}
		$this->db->disconnect();

		unset($lprepare);
		unset($result);
		unset($lparam_data);
		unset($lparam_type);
		unset($req);
		unset($lcodemod);

		return $retvalue;
	}
	
	public function ajouter()
	{
		$bool=false;
		$this->exception = "";
		//initialisation du tableau de paramètres formels et effectifs pour la requête
		$lparam_type = array();
		$lparam_data = array();

		$sql = 'insert into module ( codemod , etatmod , libmod )  values( ? , ? , ? )';

		$lparam_type[] = "text";
		$lparam_type[] = "integer";
		$lparam_type[] = "text";
		
		$this->connect_db();

		if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
		{

			$lparam_data[] = trim($this->codemod);
			$lparam_data[] = intval($this->etatmod);
			$lparam_data[] = trim($this->libmod);
			
			//die($this->redraw_sql($sql , $lparam_data , $lparam_type));

			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				$bool = true;
			}
			else
			{
				$this->exception = "Module::ajouter() - ".$result->getMessage() . ' in ' . $sql;
				$bool=false;
			}
		}
		else
		{
			$this->exception = "Module::ajouter() - ".$lprepare->getMessage() . ' in ' . $sql;
			$bool=false;
		}

		$this->db->disconnect();
		return $bool;
	}
	
	
	/**
 * fonction qui charge la configuration depuis la base de données
 *
 * @return true si chargement avec succès, false sinon
 */
	public function charger()
	{
		$retvalue = array();
		$lparam_data = array();
		$lparam_type = array();

		$req = "select codemod , libmod , etatmod
	  from module  ";
		$lwhere = " where codemod = ?";
		$land = "";

		$lparam_data[] = $this->codemod;
		$lparam_type[] = "text";

		$req .= $lwhere . $land ;
		//die($this->redraw_sql($req , $lparam_data , $lparam_type ));
		$this->connect_db();
		if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				$lrow = $result->FetchRow();

				//Transformer les noms de colonnes en champ de l'objet config en cours
				if (is_array($lrow))
				{
					foreach ($lrow as $lchamp => $lvaleur)
					{
						$this->$lchamp = $lvaleur;
					}
				}
				$retvalue =  true;	//chargement effectué avec succès

				//libérer la mémoire
				unset($lchamp);
				unset($lvaleur);
			}
			else
			{
				$this->exception = "Module::charger() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = false;
			}
		}
		else
		{
			$this->exception = "Module::charger() - ".$lprepare->getMessage() . ' in ' . $req;
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
 * fonction qui modifie un module
 * @return true si modification ok, false sinon
 */
	public  function modifier()
	{
		$bool=false;
		$this->exception = "";

		//initialisation du tableau de paramètres formels et effectifs pour la requête
		$lparam_type = array();
		$lparam_data = array();

		$sql = ' update module set etatmod = ? , libmod = ? where codemod = ? ';
		$lparam_type[] = "integer";
		$lparam_type[] = "text";
		$lparam_type[] = "text";

		$this->connect_db();
		if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
		{

			$lparam_data[] = intval($this->etatmod);
			$lparam_data[] = trim($this->libmod);
			$lparam_data[] = trim($this->codemod);


			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				$bool=true;
			}
			else
			{
				$this->exception = "Module::modifier() - ".$result->getMessage() . ' in ' . $sql;
				$bool = false;
			}
		}
		else
		{
			$this->exception = "Module::modifier() - ".$lprepare->getMessage() . ' in ' . $sql;
			$bool = false;
		}

		$this->db->disconnect();
		return $bool;
	}
	
	public function rechercher()
	{
		$retvalue = array();

		//initialisation du tableau de paramètres formels
		$lparam_type = array();
		//initialisation du tableau de paramètres effectifs pour la requête
		$lparam_data = array();

		$lwhere = " where ( not m.codemod is null ) " ;
		$land = "";

		
		$lselect = " select m.codemod, m.libmod, m.etatmod ";
		$lfrom = " from module m ";
		
		if (! is_null($this->list_codemod))
		{
			if (is_array($this->list_codemod))
			{
				$lcond = "";
				foreach ($this->list_codemod as $lcodemod)
				{
					if (trim($lcond) == "")
						$lcond = "'{$lcodemod}'";
					else $lcond .= " , '{$lcodemod}' ";	
				}
				
				unset($lcodemod);
				
				if (trim($lcond) != "")	
					$land .= " and  m.codemod in ({$lcond}) ";
			}
		}
		
		if ( (trim($this->parametre) != "") && ($this->parametre == true))
		{
			$lselect .= " , p.numchamp , p.nomchamp , p.typechamp , p.valeurdonnee ";
			$lfrom  .= " inner join module_config p on m.codemod = p.codemod ";
		}
		
		if (trim($this->codemod) != "")
		{
			$lwhere = " where p.codemod = ? " ;
			$lparam_type[] = "text";
			$lparam_data[] = $this->codemod;
			
		}
		

		$req = $lselect. $lfrom . $lwhere . $land ;
		
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
			}
			else
			{
				$this->exception = "Module::rechercher() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = null;
			}
		}
		else
		{
			$this->exception = "Module::rechercher() - ".$lprepare->getMessage() . ' in ' . $req;
			$retvalue = null;
		}



		//libérer la mémoire
		unset($lparam_data);
		unset($lparam_type);
		unset($req);
		unset($result);

		$this->db->disconnect();
		return $retvalue;

	}
	
		public function ajouter_param()
	{
		$bool=false;
		$this->exception = "";
		//initialisation du tableau de paramètres formels et effectifs pour la requête
		$lparam_type = array();
		$lparam_data = array();

		$sql = 'insert into module_config (numchamp , nomchamp , typechamp , codemod, valeurdonnee)  values( ? , ? , ?, ?, ?)';

		$lparam_type[] = "integer";
		$lparam_type[] = "text";
		$lparam_type[] = "text";
		$lparam_type[] = "text";
		$lparam_type[] = "text";
				
		$this->connect_db();

		if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
		{
			$lparam_data[] = intval($this->numchamp);
			$lparam_data[] = trim($this->nomchamp);
			$lparam_data[] = trim($this->typechamp);
			$lparam_data[] = trim($this->codemod);			
			$lparam_data[] = trim($this->valeurdonnee);
			
			//die($this->redraw_sql($sql , $lparam_data , $lparam_type));

			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				$bool = true;
			}
			else
			{
				$this->exception = "Module::ajouter_param() - ".$result->getMessage() . ' in ' . $sql;
				$bool=false;
			}
		}
		else
		{
			$this->exception = "Module::ajouter_param() - ".$lprepare->getMessage() . ' in ' . $sql;
			$bool=false;
		}

		$this->db->disconnect();
		return $bool;
	}
	
	/**
	 * fonction qui vérifie si un paramètre existe déjà dans un module
	 *
	 * @return unknown
	 */
	public function existe_param($pnomchamp = null)
	{
		$lnomchamp = (is_null($pnomchamp)) ? $this->nomchamp: $pnomchamp;

		$this->exception = "";
		$retvalue = false;

		$lselect = " select numchamp, nomchamp, typechamp, codemod, valeurdonnee from module_config ";
		$lwhere = " where nomchamp = ? ";
		
		$req = $lselect . $lwhere;
		
		$lparam_type = array();
		$lparam_data = array();
		
		$lparam_type[] = "text";

		$this->connect_db();
		
		if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			$lparam_data[] = trim($lnomchamp);
			
			//die($this->redraw_sql($req , $lparam_data , $lparam_type));
			
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				if ($result->valid())  //vérifie s'il ya au moins une ligne dans le résultat
				{
					if ($lrow = $result->FetchRow()) $retvalue = true;
					if (is_array($lrow))
					{
						$this->numchamp = intval($lrow["numchamp"]);
					}
				}
				else
				{
					$retvalue = false;
				}
			}
			else
			{
				$this->exception = "Module::existe_param() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = false;
			}
		}
		else
		{
			$this->exception = "Module::existe_param() - ".$lprepare->getMessage() . ' in ' . $req;
			$retvalue = false;
		}
		$this->db->disconnect();

		unset($lprepare);
		unset($result);
		unset($lparam_data);
		unset($lparam_type);
		unset($req);
		unset($lcodemod);
		unset($lrow);

		return $retvalue;
	}
	
	
	public  function modifier_param()
	{
		$bool=false;
		$this->exception = "";

		//initialisation du tableau de paramètres formels et effectifs pour la requête
		$lparam_type = array();
		$lparam_data = array();

		$sql = ' update module_config set nomchamp = ? , typechamp = ? , codemod = ? , valeurdonnee = ?  where numchamp = ? ';
		
		
		$lparam_type[] = "text";
		$lparam_type[] = "text";
		$lparam_type[] = "text";
		$lparam_type[] = "text";
		$lparam_type[] = "integer";
		
		$this->connect_db();
		if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
		{
			
			$lparam_data[] = trim($this->nomchamp);
			$lparam_data[] = trim($this->typechamp);
			$lparam_data[] = trim($this->codemod);
			$lparam_data[] = trim($this->valeurdonnee);
			$lparam_data[] = intval($this->numchamp);
			
			//die($this->redraw_sql($sql , $lparam_data , $lparam_type));
			
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				$bool=true;
			}
			else
			{
				$this->exception = "Module::modifier_param() - ".$result->getMessage() . ' in ' . $sql;
				$bool = false;
			}
		}
		else
		{
			$this->exception = "Module::modifier_param() - ".$lprepare->getMessage() . ' in ' . $sql;
			$bool = false;
		}

		$this->db->disconnect();
		return $bool;
	}


	public function generer_numero_param()
	{
	
		$this->exception = "";
		$retvalue = -1;
		$lparam_type = array();
		$lparam_data = array();
		
		$req = " select max(numchamp) as nbr_max from module_config ";		
		
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
				$this->exception = "Module::generer_numero() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = -1;
			}
		}
		else 
		{
			$this->exception = "Module::generer_numero() - ".$lprepare->getMessage() . ' in ' . $req;
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
	
	/**
	 * supprimer les paramètres d'un module
	 *@param 	string - codemod	- code du module contenant les paramètres à supprimer
	 * @return unknown
	 */
	public  function supprimer_param()
	{
		$bool=false;
		$this->exception = "";

		//initialisation du tableau de paramètres formels et effectifs pour la requête
		$lparam_type = array();
		$lparam_data = array();

		$sql = ' delete from module_config where codemod = ? ';
		
		
		$lparam_type[] = "text";
		
		$this->connect_db();
		if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
		{
			
			$lparam_data[] = trim($this->codemod);
			
			//die($this->redraw_sql($sql , $lparam_data , $lparam_type));
			
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				$bool=true;
			}
			else
			{
				$this->exception = "Module::supprimer_param() - ".$result->getMessage() . ' in ' . $sql;
				$bool = false;
			}
		}
		else
		{
			$this->exception = "Module::supprimer_param() - ".$lprepare->getMessage() . ' in ' . $sql;
			$bool = false;
		}

		$this->db->disconnect();
		return $bool;
	}
	
}
?>