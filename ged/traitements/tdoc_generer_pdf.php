<?php
/**
 * @author 		:	patrick mveng<adelrick@gmail.com>
 * @date		:	lundi 14 juillet 2008
 * @copyright 	:	(c) adelrick 2008
 * @version 	:	0.1
 * @desc		:	script de post-traitement pour affichage d'une publication	
 */
	
	
	global $siteweb, $numdoc;
	
	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
		$data[$lkey] = $lvalue;
	}
	
	
	if (! defined("DS")) define("DS" , DIRECTORY_SEPARATOR);
	
	$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
 	$typedoc = (isset($data["typedoc"])) ? (! is_null($data["typedoc"])) ? $data["typedoc"] : null : null;
	$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	$numtache = (isset($data["numtache"])) ? (! is_null($data["numtache"])) ? $data["numtache"] : null : null;
	$numdoc = (isset($data["numdoc"])) ? (! is_null($data["numdoc"])) ? $data["numdoc"] : null : null;
	$nomchamp = (isset($data["nomchamp"])) ? (! is_null($data["nomchamp"])) ? $data["numtache"] : null : null;
	$numtachesuiv = (isset($data["numtachesuiv"])) ? (! is_null($data["numtachesuiv"])) ? $data["numtachesuiv"] : null : null;
	$numworkflow = (isset($data["numworkflow"])) ? (! is_null($data["numworkflow"])) ? $data["numworkflow"] : null : null;
	$liste_elements = (isset($data["liste_elements"])) ? (! is_null($data["liste_elements"])) ? $data["liste_elements"] : "" : "";
	$codedep=$data['txt_loginuser'];
	$document= (isset($data["document"])) ? (! is_null($data["document"])) ? $data["document"] : null : null;
	
	
	require_once($siteweb->get_document_root().DS."includes".DS."fpdf".DS."fpdf.php");
	require_once($siteweb->get_document_root().DS."ged".DS."traitements".DS."tdoc_view.php");   
	
	ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear'); //charger les packages de PEAR::MDB2
	require_once($siteweb->get_document_root().DS."administration".DS."classe".DS."config.class.php");
	//charger le nom du fichier logo
	$lconfig = new Config();
	
	$lconfig->charger();

	class PDF_siteweb extends FPDF
	{
		//En-tête
		function Header()
		{
			global $siteweb;
		    //Logo
		   //++$this->Image($siteweb->get_document_root().DS.'images'.DS.($lconfig->logosite),10,8,33,5,'GIF');
		    //Police Arial gras 15
		    $this->SetFont('Arial','B',8);
		    //Décalage à droite
		    //$this->Cell(80);
		    //$this->Ln();
		    $this->SetX(12);
		    //$this->SetY(30);
		    //$this->Ln();
		   
		}
		
		//Pied de page
		function Footer()
		{
		    //Positionnement à 1,5 cm du bas
		    $this->SetY(-15);
		    //Police Arial italique 8
		    $this->SetFont('Arial','I',8);
		    //Numéro de page
		    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
		}
	}
	
	
	$pdf=new PDF_siteweb();
	$pdf->AddPage();
	$pdf->Ln(15);
	
	
	//Entete
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(190,10,$translate["entete"],0,0,'C');
	$pdf->SetFont('Times','');
	$pdf->Ln(10);
	
	
	//Numero
	$pdf->SetX(5);
	$pdf->SetY(40);
	$pdf->Cell(5);
	$pdf->SetFont('Times','B',8);
	$pdf->Cell(40,10,$translate["numero"].$document->numdoc );
	$pdf->Ln();
	
		
	//Date
	$pdf->SetX(50);
	$pdf->SetY(40);
	$pdf->Cell(160);
	$pdf->SetFont('Times','B',8);
	$pdf->Cell(40,10," Date : ". date("d/m/Y") , 0 , 0 , "R" );
	$pdf->Ln();


	
	//Titre
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(190,10,$translate["titre_dde"], 1 , 0 , "C" );
	$pdf->Ln(40);
	

	//Nom et prénom
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(130,10,$translate["Nom_Prénom"]."................................................................................................................................................................");
	$pdf->SetFont('Times','');
	$pdf->Cell(40,10, $document->nomuser . " " . $document->prenomuser );
	$pdf->Ln();
	
	//Retenue
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(130,10,$translate["retenue"]."..............................................................................................................................................................................................");
	$pdf->SetFont('Times','');
	$pdf->Cell(40,10, $document->retenue );
	$pdf->Ln();
	
	//Montant crédit demandé
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(130,10,$translate["montant"].".......................................................................................................................................................................");
	$pdf->SetFont('Times','');
	$pdf->Cell(40,10, $document->montant );
	$pdf->Ln();

	//Date de demande
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(130,10,$translate["datecreation"].".................................................................................................................................................................................");
	$pdf->SetFont('Times','');
	$pdf->Cell(40,10, $document->datecreation );
	$pdf->Ln();
	

	//Heure de création
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(130,10,$translate["heurecreation"]."...............................................................................................................................................................................");
	$pdf->SetFont('Times','');
	$pdf->Cell(40,10, $document->heurecreation=date("H:i:s") );
	$pdf->Ln();
	
	//Date de début de crédit
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(130,10,$translate["date_credit"]."..............................................................................................................................................................");
	$pdf->SetFont('Times','');
	$pdf->Cell(40,10, $document->date_credit );
	$pdf->Ln();
		
	
	//Retenue par nombre d\'annuités 
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(130,10,$translate["ret_annuite"].".....................................................................................................................................................");
	$pdf->SetFont('Times','');
	$pdf->Cell(40,10, $document->ret_annuite );
	$pdf->Ln();
	
	//Nombre d'annuités 
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(130,10,$translate["nbr_annuite"]."...................................................................................................................................................................");
	$pdf->SetFont('Times','');
	$pdf->Cell(40,10, $document->nbr_annuite );
	$pdf->Ln();
	
	//Annuité
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(130,10,$translate["annuite"]."...........................................................................................................................................................................................");
	$pdf->SetFont('Times','');
	$pdf->Cell(40,10, $document->annuite );
	$pdf->Ln();
		
	
	$file_name = $siteweb->get_document_root().DS.'ged'.DS.'document'.DS.'doc'.$numdoc.'.pdf';
	$url_file_name = $siteweb->get_url().DS.'ged'.DS.'document'.DS.'doc'.$numdoc.'.pdf';
	
	if (file_exists($file_name)) 
		unlink($file_name);
	
	$f= fopen($file_name,'x+');
	if(!$f)
	{
		echo $text_edit['unable_to_write'].$file_name;
		exit;
	}
	fclose($f);
	$pdf->Output($file_name , 'F');
	
?>	
	
	
