<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr-fr" lang="fr-fr" dir="ltr" >
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <meta name="robots" content="index, follow" />
  <meta name="keywords" content="sesame flow,SesameFlow" />
  <meta name="description" content="Sesame Flow! - le moteur de workflow de SESAME" />
  <meta name="generator" content="Sesame Flow! 1 - SESAME workflow engine" />
  <title> SesameFlow - Authentification </title>

<link rel="stylesheet" href="css/system.css" type="text/css" />
<link href="css/login.css" rel="stylesheet" type="text/css" />

<!--[if IE 7]>
<link href="css/ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->

<!--[if lte IE 6]>
<link href="templates/khepri/css/ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->

<link rel="stylesheet" type="text/css" href="css/rounded.css" />
	<script type="text/javascript" src="includes/prototype/prototype.js"></script>
<script language="javascript" type="text/javascript">
	function setFocus() 
	{
		document.login.username.select();
		document.login.username.focus();
	}
</script>

</head>
<body onload="javascript:setFocus()">
	<div id="border-top" class="h_green">
		<div>
			<div> 
				<span class="title">SesameFlow</span>
			</div>
		</div>
	</div>
	<div id="content-box">
		<div class="padding">
			<div id="element-box" class="login">
				<div class="t">
					<div class="t">
						<div class="t"></div>
					</div>
				</div>
				<div class="m">

					<h1>Connexion &agrave;  SesameFlow !</h1>
				<dl id="system-message" style="display:none">
					<dt class="error">Erreur</dt>
					<dd class="error message fade">
						<ul>
							<li></li>
						</ul>
					</dd>
				</dl>
	
							<div id="section-box">
			<div class="t">
				<div class="t">
					<div class="t"></div>
		 		</div>
	 		</div>
			<div class="m"> 
			
			
<script type="text/javascript" language="javascript">
// LTri(string) : Returns a copy of a string without leading spaces.
function ltrim(str)
{
   var whitespace = new String(" \t\n\r");
   var s = new String(str);
   if (whitespace.indexOf(s.charAt(0)) != -1) {
      var j=0, i = s.length;
      while (j < i && whitespace.indexOf(s.charAt(j)) != -1)
         j++;
      s = s.substring(j, i);
   }
   return s;
}

//RTrim(string) : Returns a copy of a string without trailing spaces.
function rtrim(str)
{
   var whitespace = new String(" \t\n\r");
   var s = new String(str);
   if (whitespace.indexOf(s.charAt(s.length-1)) != -1) {
      var i = s.length - 1;       // Get length of string
      while (i >= 0 && whitespace.indexOf(s.charAt(i)) != -1)
         i--;
      s = s.substring(0, i+1);
   }
   return s;
}

// Trim(string) : Returns a copy of a string without leading or trailing spaces
function trim(str) {
   return rtrim(ltrim(str));
}


function verification() 
               {
			  		  
			 	if (document.getElementById('modlgn_username').value == "" )
				{
				  		//alert("Veuillez saisir votre login");
				  		
  						document.getElementById('system-message').style.display = 'block';
						document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + "Veuillez saisir votre login";
						document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				  		document.getElementById('modlgn_username').focus();
				  		return false;
				  	}
				  	else if (document.getElementById('modlgn_passwd').value == "")
				  	{
				  		//alert("Veuillez saisir votre mot de passe");
				  		document.getElementById('system-message').style.display = 'block';
						document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + "Veuillez saisir votre mot de passe";
						document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				  		document.getElementById('modlgn_passwd').focus();
				  		return false;
				  	}
				else  
				{	
					
					//fabriquer les données à poster
					var data = "";
					data = 'username=' + document.getElementById('modlgn_username').value;
					data = data + "&ajax=1";	//notifier que l'appel de pscript vient d'ajax
					data = data + "&passwd=" + document.getElementById('modlgn_passwd').value;
					data = data + "&lang=" + document.getElementById('lang').value;
					
					//document.login.submit();	  	 				
						//exécuter AJAX	
					ldiv = document.getElementById('system-message');
					ldiv = eval(ldiv);
					if (ldiv)
					{
						document.getElementById('system-message').innerHTML = 'Authentification en cours ...';
						ldiv.style.display = 'block';
					}
									
					pscript_php  = "traitements/connexionbd.php";
					new Ajax.Request
					(
						pscript_php,
						{
							onSuccess : function(resp) 
							{
								document.getElementById('system-message').innerHTML = resp.responseText;
								lresult = resp.responseText;
								if (trim(lresult) == '')
								{   
					   				window.location = 'gabarit/page.gabarit.php?login=' + document.getElementById('modlgn_username').value + "&lang=" + document.getElementById('lang').value + "&do=accueil_user";
								}
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

					return true;
				}
				return false;
              }
  
</script>

 	<form action="traitements/connexionbd.php" method="post" name="login" id="form-login" style="clear: both;" onsubmit="return verification();" >
	<p id="form-login-username">
		<label for="modlgn_username"> Identifiant </label>
		<input name="username" id="modlgn_username" type="text" class="inputbox" size="15" />
	</p>

	<p id="form-login-password">
		<label for="modlgn_passwd"> Mot de passe </label>
		<input name="passwd" id="modlgn_passwd" type="password" class="inputbox" size="15" />
	</p>
		<p id="form-login-lang" style="clear: both;">
		<label for="lang"> Langue </label>
		<select name="lang" id="lang"  class="inputbox">
			<option value="en" > English</option>
			<option value="fr"   selected="selected" > Fran&ccedil;ais</option>
		</select>	</p>
	<div class="button_holder">
	<div class="button1">
		<div class="next">
			<a onclick="verification()"> Connexion </a>

		</div>
	</div>
	</div>
	<div class="clr"></div>
	<input type="submit" style="border: 0; padding: 0; margin: 0; width: 0px; height: 0px;"
	 value="connexion" name="btn1" />
	</form>
	
				<div class="clr"></div>
			</div>
			<div class="b">
				<div class="b">
		 			<div class="b"></div>
				</div>
			</div>
		</div>
		
					<p>Veuillez entrer un identifiant et un mot de passe valides pour acc&eacute;der au logiciel.</p>
					<div id="lock"></div>
					<div class="clr"></div>
				</div>
				<div class="b">
					<div class="b">
						<div class="b"></div>
					</div>
				</div>
			</div>
			<noscript>
				Attention! Le support du JavaScript doit &Eacute;atre activ&eacute; dans votre navigateur pour une utilisation optimale de l'Administration de SesameFlow!.			</noscript>
			<div class="clr"></div>
		</div>
	</div>
	<div id="border-bottom"><div><div></div></div>
</div>
<div id="footer">
	<p class="copyright">
		SesameFlow est un logiciel distribu&eacute; par la soci&eacute;t&eacute; <a href="http://www.interfacesa.com">INTERFACE SA</a>.	</p>
</div>

</body>
</html>
