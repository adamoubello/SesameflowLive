<?php
 
 $siteweb = new Application();
 	
 require_once($siteweb->get_document_root().'\classe\table.class.php');
 require_once($siteweb->get_document_root().'\authentification.html');
 session_start ();              
 $_SESSION['username'] = $_POST['username'];
 $_SESSION['pwd'] = $_POST['pwd'];

class workflow_user extends Table
{


 public function rechercher_workflow_user()
 {
      
	   if (isset($_SESSION['username'])) 
	   { 	
	   $login1=$_SESSION['username'];
       $requete="Select codeuser from utilisateur where loginuser ='".$login1."'" ;
       }
	   else  
	   {
	   echo'Les variables ne sont pas déclarées';
	   }
	   
 	   $retvalue = array();
	   //initialisation du tableau de paramètres formels
	   $lparam_type = array();
	   //initialisation du tableau de paramètres effectifs pour la requête
	   $lparam_data = array();
	  
	   $req = "Select U.codeuser,U.nomuser,U.loginuser,W.numworkflow,W.libworkflow,W.datedebut,W.duree,P.tempsmis,P.datecour,P.utilisateurcourant from workflow as W,utilisateur as U,participe as P Where P.numworkflow=W.numworkflow and P.codeuser='".$requete."'";
	    
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
				    $this->exception = "profi::suppression() - ".$result->getMessage() . ' in ' . $sql;
				    $retvalue = null;
			}
		}
		else 
		{
			$this->exception = "profi::suppression() - ".$lprepare->getMessage() . ' in ' . $sql;
			$retvalue = null;
		}
		
	    $this->db->disconnect();
		return $retvalue;				
 }
 
 
 public function rechercher_workflow()
 {
      $retvalue = array();
	  //initialisation du tableau de paramètres formels
	  $lparam_type = array();
	  //initialisation du tableau de paramètres effectifs pour la requête
	  $lparam_data = array();
	  
	  $req = "Select U.codeuser,U.nomuser,W.numworkflow,W.libworkflow,W.datedebut,W.duree,P.tempsmis,P.datecour,P.utilisateurcourant from workflow as W,utilisateur as U,participe as P Where P.codeuser=U.codeuser and P.numworkflow=W.numworkflow ";
	   
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
				    $this->exception = "profi::suppression() - ".$result->getMessage() . ' in ' . $sql;
				    $retvalue = null;
			}
		}
		else 
		{
			$this->exception = "profi::suppression() - ".$lprepare->getMessage() . ' in ' . $sql;
			$retvalue = null;
		}
		$this->db->disconnect();
		return $retvalue;
				
 }

}
?>