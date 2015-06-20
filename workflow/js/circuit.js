// JavaScript Document
function findRow (objTable, nPosition)
		{
			for (x = 0; x < objTable.childNodes.length; x++)
			{
				if (objTable.childNodes[x].nodeName == "TR")
				{
					nPos = getPosOfType(objTable.childNodes[x].childNodes, "TD", 1);
					objTd = objTable.childNodes[x].childNodes[nPos];
					
					nCurPosition = Math.abs(objTd.innerHTML);
					
					if (nCurPosition == nPosition)
					{
						return objTable.childNodes[x];
					}
				}
			}
		}
		
		function getPosOfType(objCollection, strTag, Pos)
		{
			nTempPos = 0;
			for (iPos = 0; iPos < objCollection.length; iPos++)
			{
				if (objCollection[iPos].nodeName == strTag)
				{
					nTempPos++;
					
					if (nTempPos == Pos)
					{		
						return iPos;
					}
				}		
			}
			
			return -1;
		}
		
		function getLastOfType(objCollection, strTag)
		{
			for (ilPos = objCollection.length-1; ilPos >= 0; ilPos--)
			{
				if (objCollection[ilPos].nodeName == strTag)
				{
					return ilPos;
				}
			}
			
			return -1;
		}
		
		//--- javascript for step 2 (the mailinglist) 
		function up2(SlotId, nPosition)
		{
			if (nPosition > 1)
			{
				swapPosition (SlotId, nPosition, nPosition-1);
			}
		}
		
		function up(pidligne)
		{
				//chercher la ligne ayant cette position
				var i = 0;
				var lfound = false;
				var ltable = document.getElementById('table_taches');
				var nbreligne = document.getElementById('table_taches').rows.length;
				
				lligne = eval( document.getElementById(pidligne));
				
				if (lligne)
				{
					
					j = eval(lligne.rowIndex);
					
	    			//var newRow = document.getElementById('table_taches').insertRow(j);
	    			AddRow(j , 'http://localhost');
	    			return true;
	    			lligne = eval( document.getElementById(pidligne));
	    			j = eval(lligne.rowIndex);
					if (j)
					{
						ltable.deleteRow(j);
						
					}
				}
				
				/*while ( (! lfound) && ( i < nbreligne) )
				{
					lrow = document.getElementById('ligne' + i);
					lrow = eval(lrow);
					if (lrow)
					{
						if ()
					}
				}*/
		}
		
		function down(SlotId, nPosition)
		{
			strDestinationId = "ligne"+SlotId;
			objDestinationTable = document.getElementById(strDestinationId);		
			nLastPos = getLastPosition(objDestinationTable);
			
			if (nPosition < nLastPos)
			{
				swapPosition (SlotId, nPosition+1, nPosition);
			}
		}
		
		//--- swapping nPos2 in front of nPos1
		function swapPosition (SlotId, nPos1, nPos2)
		{
			strDestinationId = "ligne"+SlotId;
			//objTable = document.getElementById(strDestinationId);
			objTable = document.getElementById("table_taches");
			
			//--- copy the pos2 in front of pos1
			objRow1 = findRow(objTable, nPos1);
			objRow2 = findRow(objTable, nPos2);
			
			if (objRow1)
			{
				objRow1.swapNode(objRow2);
			
				changePosition(objRow1, nPos2, SlotId);
				changePosition(objRow2, nPos1, SlotId);
			}
		}
		
		function changePosition(objRow, nPosNumber, SlotId)
		{
			nPosTd = getPosOfType(objRow.childNodes, "TD", 1);
			nHrefTd = getPosOfType(objRow.childNodes, "TD", 4);
			
			objRow.childNodes[nPosTd].innerHTML = nPosNumber;

			//--- change "up"-href
			nHref1Pos = getPosOfType(objRow.childNodes[nHrefTd].childNodes, "A", 1);
			objHref1 = objRow.childNodes[nHrefTd].childNodes[nHref1Pos];
			strUrl = "javascript:up("+SlotId+","+nPosNumber+")";
			objHref1.setAttribute("href", strUrl);
			
			//--- change "down"-href
			nHref2Pos = getPosOfType(objRow.childNodes[nHrefTd].childNodes, "A", 2);
			objHref2 = objRow.childNodes[nHrefTd].childNodes[nHref2Pos];
			strUrl = "javascript:down("+SlotId+","+nPosNumber+")";
			objHref2.setAttribute("href", strUrl);
			
			//--- change "remove"-href
			nHref3Pos = getPosOfType(objRow.childNodes[nHrefTd].childNodes, "A", 3);
			objHref3 = objRow.childNodes[nHrefTd].childNodes[nHref3Pos];
			strUrl = "javascript:remove("+SlotId+","+nPosNumber+")";
			objHref3.setAttribute("href", strUrl);
			
			//--- change the hidden input field
			nInputPos = getPosOfType(objRow.childNodes[nHrefTd].childNodes, "INPUT", 1);
			objInput = objRow.childNodes[nHrefTd].childNodes[nInputPos];
			
			strCurValue = objInput.getAttribute("value");
			
			Ids = strCurValue.split("_");
			strNewId = SlotId+"_"+Ids[1]+"_"+nPosNumber;
			objInput.setAttribute("id", strNewId+"_MAILLIST");
			objInput.setAttribute("name", strNewId+"_MAILLIST");
			objInput.setAttribute("value", strNewId);					
		}


function afficher_div_circuit_search() 
 {
	 
 var ldiv = document.getElementById("div_circuit_search");
 var lchkbox = document.getElementById("checkbox_circuit_search");
 
 ldiv = eval(ldiv);
 
 if (ldiv)
 {
	lchkbox= eval(lchkbox); 
    if (lchkbox)
	{
	if (lchkbox.checked == true)
	{ 
	ldiv.style.display="block";
	}
	else {  ldiv.style.display="none"  ;
	}
	}
  }
	  
  }

function ajouter_ligne_datagrid()
{
  //document.getElementById('tabletaches').insertRow(0);
//unset($table);
var tableligne = document.getElementById('table_taches');
 
AddRow(-1);
}

/*function DeleteRow(pindex)
	{ 
	var tabletaches = document.getElementById('table_taches');
	
	tabletaches.deleteRow(pindex);
	}
*/

function AddRow(pindex , pdoc_url , pidform)
	{
	    var newRow = document.getElementById('table_taches').insertRow(pindex);
		var nbreligne = document.getElementById('table_taches').rows.length;
		
		var oTable = document.getElementById('table_taches');
		oTable = eval(oTable);
		
		var ligne_id = "'ligne" + nbreligne + "'";
		var index_id = parseInt(nbreligne) - 1;	//la ligne tbody est compté dans length
		index_id   = "'" + index_id + "'";
		
		newRow.id = "ligne" + nbreligne;
		var remove_id = "'remove" + nbreligne + "'";
		
		if (oTable)
		{
			var RowsLength = oTable.rows.length;
			var oRow;
			var lcontinue = true;
			
			i= 1;
			while ((i <= RowsLength) && (lcontinue))
			{
			    oRow = document.getElementById("ligne" + i);
			    oRow = eval(oRow);
			    if (oRow)
			    //la ligne existe
			    	lcontinue = true;
				else lcontinue = false;

				if (lcontinue) i = i + 1;   
			}
			
			ligne_id = "'ligne" + i + "'";	
			newRow.id = "ligne" + i;
			remove_id = "'remove" + i + "'";
		}
		
		i = 0;
		nbreligne = nbreligne - 1;	//ne pas compter la ligne THEAD
		
		
		var form = document.getElementById(pidform);
		form = eval(form);
		var form_id = "'" + pidform + "'";
		var table_id = "'table_taches'";

	    var newCell = newRow.insertCell(0);
	    newCell.innerHTML = '';
	    newCell0 = newRow.insertCell(0);
		newCell1 = newRow.insertCell(1);
		newCell2 = newRow.insertCell(2);
		newCell3 = newRow.insertCell(3);
		
		//si la tache précédente est vide, on incrémente le compteur de tâche initiale
		// ! ! !  on doit veiller à ce que une tâche n'ait pas plus d'une tâche initiale
		if (document.getElementById('sel_tache_prec').value == "")
		{
			document.getElementById('nbr_tache_initiale').value = parseInt(document.getElementById('nbr_tache_initiale').value) + 1;
		}
		newCell0.innerHTML = '<input type="text" disabled size="40" value="' + document.getElementById('sel_tache_prec').options[document.getElementById('sel_tache_prec').options.selectedIndex].text + '" /><input id="sel_tache_prec' + nbreligne + '" name="sel_tache_prec' + nbreligne + '" type="hidden" value="' + document.getElementById('sel_tache_prec').value + '" />';
		lacteur = "";
		lvaleur = "";
		if (document.getElementById('sel_acteur').value != "")
		{
			lacteur = document.getElementById('sel_acteur').options[document.getElementById('sel_acteur').options.selectedIndex].text;
			lvaleur = "acteur:" + document.getElementById('sel_acteur').value; //type_acteur:valeur
		}
		else
		{
			lacteur = "[ " + document.getElementById('sel_profil').options[document.getElementById('sel_profil').options.selectedIndex].text + " ]";
			lvaleur = "profil:" + document.getElementById('sel_profil').value; //type_acteur:valeur
		}
		
		newCell1.innerHTML = '<input type="text" disabled size="40" value="' + lacteur + '" /><input id="sel_acteur' + nbreligne + '" name="sel_acteur' + nbreligne + '" type="hidden" value="' + lvaleur + '" />';
		newCell2.innerHTML = '<input type="text" disabled size="40" value="' + document.getElementById('sel_tache').options[document.getElementById('sel_tache').options.selectedIndex].text + '" /><input id="sel_tache' + nbreligne + '" name="sel_tache' + nbreligne + '" type="hidden" value="' + document.getElementById('sel_tache').value + '" />';
		newCell3.innerHTML = '<a href="#" onclick="javascript:on_circuit_remove_tache(' + form_id + ' , ' + table_id + ' , ' +  index_id + ');" title="' + Translate["supprimer"] +  '" ><img src="' + pdoc_url + '/images/edit_remove.gif" /></a><input type="hidden"  id="position' + nbreligne + '"  name="position' + nbreligne + '"   value="' + nbreligne + '"   />';
		// + '&nbsp;<a href="#" onclick="javascript:down(' + nbreligne + ' , ' + ( nbreligne + 1) + ');" title="' + Translate["descendre"] +  '" ><img src="' + pdoc_url + '/images/down.gif" /></a>'
		//+ '&nbsp;<a href="#" onclick="javascript:up(' + ligne_id + ');" ><img src="' + pdoc_url + '/images/up.gif" /></a>';
	}


function on_valid_creer_circuit1(pscript_php)
{ 
	var form = document.form_create_circuit1;
	form = eval(form);
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'exécution du script
		
		//fabriquer les données à poster
		var data = "";
		data = 'codecircuit=' + document.getElementById('codecircuit').value;
		data = data + "&ajax=1";	//notifier que l'appel de pscript vient d'ajax
		data = data + "&libcircuit=" + document.getElementById('libcircuit').value;
		data = data + "&dureecircuit=" + document.getElementById('dureecircuit').value;
				
		//exécuter AJAX	
		sendData('div_status', data , pscript_php , 'POST');
	}
}

function on_valid_creer_circuit2(pscript_php)
{   
	var form = document.form_create_circuit2;
	form = eval(form);
	//ce formulaire existe-t-il ?
	if (form)
	{//oui on peut poursuivre l'exécution du script
		
	//ici,on veut récupérer les index des valeurs sélectionnées sur chaque liste déroulante
	//déclaration des variables
	var datagrid = document.getElementById('table_taches');
	var tache = document.getElementById('tache_id');
	var profil = document.getElementById('profil_id');
	var user = document.getElementById('user_id');
	var Tab = new Array();
    var maxi = document.getElementById('table_taches').rows.length-1;
	var j,i;
	var data = "";			
	
	var oTable = document.getElementById('oTable');
	var RowsLength = oTable.rows.length;
	for (var i=0; i < RowsLength; i++)
	{
	    var oCells = oTable.rows.item(i).cells;
	    var CellsLength = oCells.length;
	    for (var j=0; j < CellsLength; j++) 
	    {
		    oCells.item(j).innerHTML = count++;
	    }
	}

        
		//exécuter AJAX	
	sendData('div_status', data , pscript_php , 'POST');
		
	}
}


/*
script de validation modification circuit
*/
function on_circuit_update_valid(pscript_php)
{
	var form = document.getElementById('form_circuit_view');
	form = eval(form);
	
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'exécution du script
	
		if (document.getElementById('libcircuit').value == "")
		{
			document.getElementById('system-message').style.display = 'block';

			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_libcircuit"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			document.getElementById('libcircuit').focus();
			return false;
		}
		else if (document.getElementById('dureecircuit').value != "")
		{
			if (! isFinite(document.getElementById('dureecircuit').value))
			{
				document.getElementById('system-message').style.display = 'block';
	
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["duree_must_be_integer"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				
				return false;
			}
			else if (parseInt(document.getElementById('dureecircuit').value) < 0)
			{
				document.getElementById('system-message').style.display = 'block';
	
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["duree_must_be_positive"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				
				document.getElementById('dureecircuit').focus();
				return false;
			}
		}
		else if (document.getElementById('numprocessus').value == "")
		{
			document.getElementById('system-message').style.display = 'block';

			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_select_processus"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			document.getElementById('numprocessus').focus();
			return false;
		}
		else if (parseInt(document.getElementById('nbr_tache').value) == 0)
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["at_least_one_task_required"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			return false;
		}
		else if (parseInt(document.getElementById('nbr_tache_initiale').value) < 1)
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["initial_task_required"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			return false;
		}
		else if (parseInt(document.getElementById('nbr_tache_initiale').value) > 1)
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["only_one_initial_task_required"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			return false;
		}
		
		//alert(document.getElementById('nbr_tache_initiale').value);
		form.submit();
		return true;

		//fabriquer les données à poster
		var data = "";
		data = 'codecircuit=' + document.getElementById('codecircuit').value;
		data = data + "&ajax=1";	//notifier que l'appel de pscript vient d'ajax
		data = data + "&libcircuit=" + document.getElementById('libcircuit').value;
		data = data + "&dureecircuit=" + document.getElementById('dureecircuit').value;
		data = data + "&numprocessus=" + document.getElementById('numprocessus').value;
		data = data + "&login=" + document.getElementById('login').value;
		data = data + "&lang=" + document.getElementById('lang').value;
		data = data + "&do=circuit_update_valid";

		//exécuter AJAX	
		ldiv = document.getElementById('system-message');
		ldiv = eval(ldiv);
		if (ldiv)
		{
			document.getElementById('system-message').innerHTML = Translate["modif_en_cours"];
			ldiv.style.display = 'block';
		}
						
		new Ajax.Request
		(
			pscript_php,
			{
				onSuccess : function(resp) 
				{
					document.getElementById('system-message').innerHTML = resp.responseText;
					//ldiv.style.display = 'none';
				},
		 		onFailure : function(resp) 
		 		{
		 			
		   			alert("Oops, there's been an error with Ajax.");
		   			ldiv.style.display = 'none';
		 		},
		 		parameters : data
			}
		);

	}
}


/*
script de validation suppression d'un circuit
*/
function on_circuit_delete_valid()
{
	var form = document.getElementById('form_circuit_view');
	form = eval(form);
	
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'exécution du script
	
		if (confirm(Translate["confirm_delete_circuit"]))
		{
			form.elements["do"].value = "circuit_delete_valid"; 
			form.submit();
			return true;

		}
		
		return false;
	}
}


/*
script de validation de l'archivage d'un circuit
*/
function on_circuit_archiver_valid()
{
	var form = document.getElementById('form_circuit_view');
	form = eval(form);
	
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'exécution du script
	
		if (confirm(Translate["confirm_archive_circuit"]))
		{
			form.elements["do"].value = "circuit_archive_valid"; 
			form.submit();
			return true;

		}
		
		return false;
	}
}


/**
  @desc 	:	script exécuté lorsque le user valide l'étape 1 de la creation d'un circuit
*/
function on_circuit_create1_valid()
{
	var form = document.getElementById('form_create_circuit');
	form = eval(form);
	
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'exécution du script
	
		if (document.getElementById('libcircuit').value == "")
		{
			document.getElementById('system-message').style.display = 'block';

			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_libcircuit"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			document.getElementById('libcircuit').focus();
			return false;
		}
		else if (document.getElementById('dureecircuit').value != "")
		{
			if (! isFinite(document.getElementById('dureecircuit').value))
			{
				document.getElementById('system-message').style.display = 'block';
	
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["duree_must_be_integer"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				document.getElementById('dureecircuit').focus();
				return false;
			}
			else if (parseInt(document.getElementById('dureecircuit').value) < 0)
			{
				document.getElementById('system-message').style.display = 'block';
	
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["duree_must_be_positive"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				document.getElementById('dureecircuit').focus();
				return false;
			}
		}
		else if (document.getElementById('numprocessus').value == "")
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_select_processus"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			document.getElementById('numprocessus').focus();
			return false;
		}
		else if (parseInt(document.getElementById('nbr_tache').value) <= 0)
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["at_least_one_task_required"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			return false;
		}
		else if (parseInt(document.getElementById('nbr_tache_initiale').value) < 1)
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["initial_task_required"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			return false;
		}
		else if (parseInt(document.getElementById('nbr_tache_initiale').value) > 1)
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["only_one_initial_task_required"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			return false;
		}

		
		form.submit();
		return true;
	}
	return false;
}


/**
 script qui permet d'ajouter une nouvelle tache dans le circuit
*/
function on_circuit_add_tache(pdoc_url, pidform)
{
	var form = document.getElementById(pidform);
	form = eval(form);
	
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'exécution du script
		//la sélection d'un profil ou d'un acteur est obligatoire
		if ( (document.getElementById('sel_acteur').value == "") & ( document.getElementById('sel_profil').value == ""))
		{
			document.getElementById('system-message').style.display = 'block';

			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_select_acteur_or_profil"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			document.getElementById('sel_tache').focus();
			return false;
		}
		else if ( (document.getElementById('sel_tache').value == ""))
		{
			document.getElementById('system-message').style.display = 'block';

			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_select_tache"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			document.getElementById('sel_tache').focus();
			return false;
		}
		else
		{
			document.getElementById('system-message').style.display = 'none';
			var tableligne = document.getElementById('table_taches');
			AddRow(-1 , pdoc_url , pidform);			
			document.getElementById('nbr_tache').value = parseInt(document.getElementById('nbr_tache').value) + 1;
		}
	}
}


/*
script de chargement de la liste des utilisateurs d'un département
*/
function on_circuit_change_dep(pscript_php , pidform , pfrom)
{
	var form = document.getElementById(pidform);
	form = eval(form);
	
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'exécution du script
	
		if (document.getElementById('sel_dep').value != "")
		{
			//fabriquer les données à poster
			var data = "";
			data = 'codedep=' + document.getElementById('sel_dep').value;
			data = data + "&ajax=1";	//notifier que l'appel de pscript vient d'ajax
			data = data + "&login=" + document.getElementById('login').value;
			data = data + "&lang=" + document.getElementById('lang').value;
			data = data + "&dofrom=" + pfrom;
	
			//exécuter AJAX	
			ldiv = document.getElementById('system-message');
			ldiv = eval(ldiv);
			if (ldiv)
			{
				pdoc_url = '';
				document.getElementById('system-message').innerHTML = '<img src="' + pdoc_url + '/images/loading_moz.gif" />&nbsp;&nbsp;' + Translate["chargement_en_cours"];
				ldiv.style.display = 'block';
			}
							
			new Ajax.Request
			(
				pscript_php,
				{
					onSuccess : function(resp) 
					{
						document.getElementById('div_acteur').innerHTML = resp.responseText;
						ldiv.style.display = 'none';
					},
			 		onFailure : function(resp) 
			 		{
			 			
			   			alert("Oops, there's been an error with Ajax.");
			   			ldiv.style.display = 'none';
			 		},
			 		parameters : data
				}
			);

		}
		
		return false;

	}
}

 
/**
 @name	:	on_circuit_remove_tache
 @param	:	string - pindex - index de la ligne sélectionné pour suppression
 @desc	:	fonction qui supprime une tache du circuit
 @author	:	Patrick Mveng
 @date		:	02 juillet 2009
 @link		:	circuit_create1.php
**/
function on_circuit_remove_tache(pform, ptable_id , pindex)
{
	if (parseInt(document.getElementById('nbr_tache').value) <= 1)
	{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["at_least_one_task_required"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			return false;

		return false;
	}
	
	var form = eval(document.getElementById(pform));
		var form_name = form.name;
		var lines_count = 0;
		var ltable = document.getElementById(ptable_id);
		ltable = eval(ltable);
		var pidligne = "ligne" + pindex;
		var psel_tache_prec = "sel_tache_prec" + pindex;

		if(ltable)
		{
			//obtenir le nombre de lignes du tableau
			lines_count = ltable.rows.length ; 
		}
		var i = 0;
		var lref_fourn;
		var j = -1;
		var k = -1;
		var check;
		var larr_row = new Array();
		
		// Fin vérification "lignes sélectionnés" 
				lligne = eval( document.getElementById(pidligne));
				if (lligne)
				{
					
					j = eval(lligne.rowIndex);
					if (j)
					{// = check.parentNode.parentNode.rowIndex;
						//si la tache précédente est vide, on décrémente le compteur de tâche initiale
						// ! ! !  on doit veiller à ce que une tâche n'ait pas plus d'une tâche initiale
						if (document.getElementById(psel_tache_prec).value == "")
						{
							document.getElementById('nbr_tache_initiale').value = parseInt(document.getElementById('nbr_tache_initiale').value) - 1;
						}
						document.getElementById('nbr_tache').value = parseInt(document.getElementById('nbr_tache').value) - 1;
						ltable.deleteRow(j);
					}
				}
}



