<?php			 $DocFil= '../base/install.php';	 	$DocVer='5.0.0';		 $DocRev='2016-08-00';
//						 ___   _   _    ___  _	       
//						/ __| /_\ | |  |   \| |   ___ 
//						\__ \/ _ \| |__| |) | |__/ -_)
//						|___/_/ \_|____|___/|_|  \___|
//						                               
// LICENS
//
// Dette program er fri software. Du kan gendistribuere det og / eller
// modificere det under betingelserne i GNU General Public License (GPL)
// som er udgivet af The Free Software Foundation; enten i version 2
// af denne licens eller en senere version efter eget valg
// Fra og med version 3.2.2 dog under iagttagelse af følgende:
// 
// Programmet må ikke uden forudgående skriftlig aftale anvendes
// i konkurrence med DANOSOFT ApS eller anden rettighedshaver til programmet.
//
// Dette program er udgivet med haab om at det vil vaere til gavn,
// men UDEN NOGEN FORM FOR REKLAMATIONSRET ELLER GARANTI.
// Se GNU General Public Licensen for flere detaljer.
//
// En dansk oversaettelse af licensen kan laeses her:
// http://www.fundanemt.com/gpl_da.html
//
// Copyright (c) 2004-2016 DANOSOFT ApS
// ----------------------------------------------------------------------
// HUSK: SALDI-Filer skal gemmes i UTF-8 format!
//	2016.08.00 ev - EV-soft
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
	<title>SALDI - det frie danske økonomisystem</title>
<?php

#	if (!file_exists("../includes/connect.php"))
#		{echo '<meta http-equiv="refresh" content="0;URL=index.php">';	exit;}	 ### SALDI er allerede konfigureret!

include("../includes/db_query.php");
include("../includes/settings.php");
include("../includes/version.php");
#+	
require("../includes/pbkdf2.php");

include("../includes/out_ruder.php");

#	Side-Container:
	echo '<table width="100%" height="90%" border="0" cellspacing="0" cellpadding="0"><tbody>';
	echo '<tr><td align="center" valign="top">';
# Header-Row:
	echo '<table width="100%" align="center" border="0" cellspacing="0" cellpadding="0"><tbody>';
	echo '<td width="100%" align = "center" '.$top_bund.'>'.$font.'<a href="http://saldi.dk/dok/komigang.html" target="_blank"><small>Vejledning: Kom i gang</small></a></td>';
	echo '</tbody></table></td></tr><tr><td align="center" valign="center">';

#-	
unset($_POST['opret']);
if (isset($_POST['opret']))
{
	$felt_mangler=false;	
	$pw_diff=false;	
#+	$ext_loaded=false;
	$db_encode=$_POST['db_encode'];
	$db_type=strtolower($_POST['db_type']);
	$db_navn=			 trim($_POST['db_navn']);			if (strlen($db_navn)==0) 			{$felt_mangler=true; $db_navn=  "<i>Feltet er tomt!</i>";}
#+	if (extension_loaded('mcrypt') && extension_loaded('hash')) {
#+		$ext_loaded=true;
#+	}
	$db_bruger=		 trim($_POST['db_bruger']);		if (strlen($db_bruger)==0) 		{$felt_mangler=true; $db_bruger="<i>Feltet er tomt!</i>";}
	$db_password=	 trim($_POST['db_password']);	if (strlen($db_password)==0)	{$felt_mangler=true; $db_pw=    "<i>Feltet er tomt!</i>";} else {$db_pw="-- vises ikke --";}
	$adm_navn=		 trim($_POST['adm_navn']);		if (strlen($adm_navn)==0) 		{$felt_mangler=true; $adm_navn= "<i>Feltet er tomt!</i>";}
	$adm_password= trim($_POST['adm_password']);	$verify_adm_password=trim($_POST['verify_adm_password']);
	if (strlen($adm_password)==0) 
		{$felt_mangler=true;	$adm_pw="<i>Feltet er tomt!</i>";
			if (strlen($verify_adm_password)==0) {$verify_adm_pw="<i>Feltet er tomt!</i>";	} 
			else {$verify_adm_pw = "<i>Adgangskoder forskellige! Skal være ens.</i>";	}
		} else 
		{	if ($adm_password == $verify_adm_password ) {$adm_pw = "**********";	$verify_adm_pw = "**********";} 
			else {$pw_diff=true; $verify_adm_pw = "<i>Adgangskoder forskellige. Skal være ens.</i>";}
		}
	$adm_password= md5(trim($_POST['adm_password']));
#+	$adm_password = \PBKDF2\create_hash(trim($_POST['adm_password'])); // Genererer ny unik salt og hash

	function row1($ju,$k1) {return '<tr><td colspan="2" align= "'.$ju.'"><b>'.$k1.'</b></td></tr>'; }
	function row2($k1,$k2) {return '<tr><td align= "right">'.$k1.' :&nbsp; </td><td><b>'.$k2.'</b></td></tr>'; }
#	Body-Container:
	$tmp.='<table width="50%" align="center" border="1" >';
	$tmp.=row1('center','<big>Oplysninger til SALDI-installation:</big>');
	$tmp.=row2('Databaseserver',$db_type);
	$tmp.=row2('Tegnsæt',$db_encode);
	$tmp.=row2('Databasenavn',$db_encode);
	$tmp.=row2('Dataadministrator',$db_bruger);
	$tmp.=row2('Adgangskode for databaseadministrator',$db_pw);
	$tmp.=row2('SALDI-administratorens brugernavn',$adm_navn);
	$tmp.=row2('SALDI-administratorens adgangskode',$adm_pw);
	$tmp.=row2('Verificeret adgangskode',$verify_adm_pw);
	$tmp.='<hr \>';
	if ($felt_mangler) 	$tmp.=row1('left','<i> Et eller flere felter mangler at blive udfyldt. Se ovenfor.</i>');
	if ( $pw_diff )  		$tmp.=row1('left','<i> Adgangskode og verifikationskoden for SALDI-administrator er forskellig.</i>');
#-
	if ( $felt_mangler || $pw_diff ) {
#+	if ( !$ext_loaded ) $tmp.="<tr><td colspan=\"2\"><b><i>PHP extension mcrypt og/eller hash er ikke indlæst. Prøv at installere pakken php5-mcrypt.</i></b></td></tr>\n";
#+	if ( $felt_mangler || $pw_diff || !$ext_loaded ) {
		$tmp.=row1('left','<i> Gå tilbage til forrige side og ret fejlene</i><br /> Brug eventuelt browserens tilbage-knap for at gå tilbage.</p>');
	# $tmp.='<tr><td colspan="2"><b><i> Gå tilbage til forrige side og ret fejlene</i></b><br /> Brug eventuelt browserens tilbage-knap for at gå tilbage.</p>';
		$tmp.='</body></html>';
		
		Rude_Install 
		(#&$db_type, 
		&$db_encode, 
		&$db_navn, 
		&$db_bruger, 
		&$db_password,
		&$adm_navn, &$adm_password, 
		&$verify_adm_password);
		
		echo $tmp;	$tmp="";
		exit;	 ### SALDI opsætning er mangelfuld!
	}
	$noskriv=NULL;
	if ($fp=fopen("../includes/connect.php","w")) {	fclose($fp);}	else $noskriv="includes";
	if ($fp=fopen("../temp/test.txt","w")) 				{	fclose($fp);}	else $noskriv="temp";
	if ($fp=fopen("../logolib/test.txt","w")) 		{	fclose($fp);}	else $noskriv="logolib";
	
	if ($noskriv) {
		if ($noskriv=="includes") echo '<p>Der er ikke skriveadgang til kataloget '.$noskriv.', hvor "connect.php" skal oprettes.</p>';
		else echo 'Der er ikke skriveadgang til kataloget '.$noskriv;
		
		echo '<p>Sørg for at der er skriveadgang for den bruger, som den besøgende kører som (webserverbrugeren) ';
		echo 'til katalogerne: "includes", "temp" og "logolib".<br>'.
				 ' Se hvordan i installeringsvejledningen <a href="../INSTALLATION.txt" target="blank">INSTALLATION.txt</a>.</p>';
		echo '</td></tr></table></body></html>';
		exit;	 ### SALDI mangler skriveadgang!
	}		

	$host="localhost";	$tempdb="template1";
	
	if ($db_type=="mysql") 
				{$connection = db_connect ("$host", "$db_bruger", "$db_password");             $db_name= 'MySQL';			}
	else 	{$connection = db_connect ("$host", "$db_bruger", "$db_password", "$tempdb");  $db_name= 'PostgreSQL';	}
	if (!$connection)	die('Kan ikke oprette forbindelse til '.$db_name);

	if ($db_type=="mysql") {
		db_modify("CREATE DATABASE $db_navn",																									__FILE__ . " linje " . __LINE__);
		mysql_select_db("$db_navn");	} 
	else {
		if ($db_encode=="UTF8") db_modify("CREATE DATABASE $db_navn with encoding = 'UTF8'",	__FILE__ . " linje " . __LINE__);
		else db_modify("CREATE DATABASE $db_navn with encoding = 'LATIN9'",										__FILE__ . " linje " . __LINE__);
		db_close($connection);
		$connection = db_connect ("$host", "$db_bruger", "$db_password", "$db_navn");
	}

	transaktion("begin");
	db_modify("CREATE TABLE brugere		(id serial NOT NULL, 	brugernavn text, kode text, status boolean, regnskabsaar integer, rettigheder text, PRIMARY KEY (id))",__FILE__ . " linje " . __LINE__);
	db_modify("INSERT INTO brugere 		(brugernavn, kode, rettigheder) values ('$adm_navn' ,'$adm_password', '11111111111111111111')",__FILE__ . " linje " . __LINE__);
	db_modify("CREATE TABLE regnskab 	(id serial NOT NULL,	regnskab text, dbhost text, dbuser text, db text, version text, sidst text, brugerantal numeric, posteringer numeric, posteret numeric, lukket text,administrator text,lukkes date, betalt_til date,logintekst text,email text,bilag numeric(1,0), PRIMARY KEY (id))",__FILE__ . " linje " . __LINE__);
	db_modify("INSERT INTO regnskab 	(regnskab, dbhost, dbuser, db, version,bilag) values ('$db_navn' ,'$host', '$db_bruger', '$db_navn', '$version','0')",__FILE__ . " linje " . __LINE__);
	db_modify("CREATE TABLE online 		(session_id text, 		brugernavn text, db text, dbuser text, rettigheder text, regnskabsaar integer, logtime text, revisor boolean)",__FILE__ . " linje " . __LINE__);
	db_modify("CREATE TABLE kundedata (id serial NOT NULL, 	firmanavn text, addr1 text, addr2 text, postnr varchar(10), bynavn text, kontakt text, email text, cvrnr text, regnskab text, regnskab_id integer,brugernavn text, kodeord text, kontrol_id text, aktiv int, logtime text,slettet varchar(2),PRIMARY KEY (id))",__FILE__ . " linje " . __LINE__);
	db_modify("CREATE TABLE tekster 	(id serial NOT NULL, 	sprog_id integer, tekst_id integer, tekst text, PRIMARY KEY (id))",__FILE__ . " linje " . __LINE__);
	db_modify("CREATE TABLE revisor		(id serial NOT NULL,	regnskabsaar integer,bruger_id integer,brugernavn text,db_id integer,PRIMARY KEY (id))",__FILE__ . " linje " . __LINE__);
	transaktion("commit");
	
	
	if ($fp=fopen("../includes/connect.php","w")) {
			make_connect($fp,$host,$db_bruger,$db_password,$db_navn,$db_encode,$db_type);
		fclose($fp);
		echo '<table width="75%"><tr><td style="text-align:center"><br><br>';
		echo '<br><br><h1>SALDI DB er installeret</h1><br><br>';
		echo '<p>Dit SALDI-system er nu oprettet. Og det første, du skal gøre, er at oprette et regnskab.</p><br><br>';
		echo '<p>Dette gøres ved at loggge ind med <b>'.$db_navn.'</b> som regnskab, <b>'.$adm_navn.'</b> <br>';
		echo 'som brugernavn og den valgte adgangskode</p><br><br>';
		echo '<p>Tegn en hotline-aftale, så kan du ringe eller sende en e-mail <br>';
		echo 'og få hurtigt svar på spørgsmål om brugen af SALDI.</p><br><br>';
		echo '<p>Se mere på <a href="http://saldi.dk/hotline" target="_blank">http://saldi.dk/hotline</a></p><br><br>';
		echo '<p>&nbsp;</p><br><br>';
		echo '<p><a href="../base/index.php" title="Til SALDI-administratorsiden hvor regnskaber administreres" <br>';
		echo ' style="text-decoration:none"><input type="button" value="Fortsæt"></a><br><br>';
		echo '</td></tr></table><br><br>';
	} else {	# Der mangler skriveadgang!
		echo '<p>Webbrugere har ikke skriveadgang til kataloget "includes", hvor "connect.php" skal oprettes.</p><br><br>';
		echo '<p>Sørg for at der er skriveadgang for den bruger, som den besøgende kører som (webserverbrugeren) <br>';
		echo 'til katalogerne <br>';
		echo '"includes", "temp" og "logolib". Se hvordan i installeringsvejledningen INSTALLATION.txt.</p><br><br>';
		echo '</td></tr></table></body></html><br>';
		exit;	 ### SALDI mangler skriveadgang. connect.php er ikke dannet!
	}		
} else {
	$font= '<font face="Helvetica, Arial, sans-serif">';
	$rowStart= '<tr><td align= "right">'.$font;
	$tdNext= ': &nbsp; </td><td title=';
	$rowStop = '<tr><td><br></td></tr>';
	echo '<table width=600px align=center border="0" cellspacing="0" cellpadding="0"><tbody>';
	echo '<tr><th colspan="5" align="center">'.$font.'<b>Velkommen til SALDI-5 konfiguration.</b></th></tr>';
	echo '<tr><td>&nbsp;</td></tr>';
	echo '<tr><td colspan="5"> '.$font.'Hvis du har installeret webserveren Apache med PHP og en af databaseserverne PostgreSQL eller MySQL/MariaDB, kan du nu installere SALDI.</td></tr>';
	echo '<FORM name="opret" METHOD=POST ACTION="install.php"><tr><td colspan=2><br></td></tr>';

	function row3($k1,$k2,$k3) {return '<tr><td align= "right"><font face="Helvetica, Arial, sans-serif">'.$k1.' :&nbsp; </td><td title="'.$k2.'"><b>'.$k3.'</b></td></tr><tr><td><br></td></tr>'; }
	
	echo row3('Databaseserver','Vælg den databaseserver type, du ønsker at bruge.','<SELECT NAME=db_type>		<option>PostgreSQL</option>	<option>MySQL</option></SELECT>');
	echo row3('Tegnsæt',			 'Vælg det tegnsæt du ønsker at bruge. Nyere versioner af PostgreSQL fungerer kun med UTF8','<SELECT NAME=db_encode>	<option>UTF8</option> <option>LATIN9</option></SELECT>');
	echo row3('Databasenavn',	 'Ønsket navn på din hoveddatabase for SALDI',												'<INPUT TYPE=TEXT NAME=db_navn VALUE = "saldi5">');
	echo row3('Aktiv databaseadministrator','Navn på en bruger, som har i forvejen har tilladelse til at oprette, rette og slette databaser. '.
								 'Typisk er det for PostgreSQL brugeren postgres og for MySQL brugeren root.',		'<INPUT TYPE=TEXT NAME=db_bruger VALUE="postgres">');
	echo row3('Adgangskode for databaseadministrator','Adgangskode for ovenstående bruger',					'<INPUT TYPE=password NAME=db_password>');
	echo row3('SALDI-administratorens brugernavn','Ønsket navn på din SALDI-administratorkonto til dit SALDI-system',	'<INPUT TYPE=TEXT NAME=adm_navn VALUE = "admin">');
	echo row3('SALDI-administratorens adgangskode','Ønsket adgangskode for SALDI-administratoren af dit SALDI-system','<INPUT TYPE=password NAME=adm_password>');
	echo row3('Gentag SALDI-administratorens adgangskode','Verificering af ovenstående adgangskode','<INPUT TYPE=password NAME=verify_adm_password>');

	echo '<tr><td colspan=2 align=center title="Klik her for at oprette dit SALDI-system">'.
								'<INPUT TYPE=submit name=opret VALUE=Install&eacute;r></td></tr>';
	echo $rowStop;
	echo '<tr><td colspan="5"> <font face="Helvetica, Arial, sans-serif"> <b>Alle</b> felter skal udfyldes. Hvis du er i tvivl, så udfyld kun de tomme felter.</td></tr>';
	echo '<tr><td colspan="5"> <font face="Helvetica, Arial, sans-serif"> <b>Tip:</b> Hold musen over felter, for at få hjælpetekster.</td></tr>';
	echo '<tr><td><br></td></tr><tr></tr></FORM>';
	echo '</tr>';
	echo '</tbody></table>';
	
	echo '</td></tr>';
	echo '<tr><td align="center" valign="bottom">';
	echo 		'<table width="100%" align="center" border="0" cellspacing="0" cellpadding="0"><tbody>';
	echo 		'<td style="border: 1px solid rgb(180,180,255); padding: 0pt 0pt 1px;" align="left" background="../images/grey1.gif" width="100%" bgcolor="$bgcolor2">'.
					'<font face="Helvetica, Arial, sans-serif" color="#000000"><small><small>&nbsp;Copyright&nbsp;&copy;&nbsp;2003-2016&nbsp;DANOSOFT&nbsp;ApS</small></small></td>';
	echo 		'</tbody></table>';
	echo '</td></tr>';
	echo '</tbody></table>';
}


function make_connect($fp,$host,$db_bruger,$db_password,$db_navn,$db_encode,$db_type) {
	fwrite($fp," \n");
	fwrite($fp,"<?php\n");
	fwrite($fp,"// ----/includes/connect.php--------------- 5.0.0-----2016.07.00-----\n");
	fwrite($fp,"// LICENS\n");
	fwrite($fp,"//\n");
	fwrite($fp,"// Dette program er fri software. Du kan gendistribuere det og / eller\n");
	fwrite($fp,"// modificere det under betingelserne i GNU General Public License (GPL)\n");
	fwrite($fp,"// som er udgivet af The Free Software Foundation; enten i version 2\n");
	fwrite($fp,"// af denne licens eller en senere version efter eget valg\n");
	fwrite($fp,"//\n");
	fwrite($fp,"// Dette program er udgivet med haab om at det vil være til gavn,\n");
	fwrite($fp,"// men UDEN NOGEN FORM FOR REKLAMATIONSRET ELLER GARANTI. Se\n");
	fwrite($fp,"// GNU General Public Licensen for flere detaljer.\n");
	fwrite($fp,"//\n");
	fwrite($fp,"// En dansk oversaettelse af licensen kan laeses her:\n");
	fwrite($fp,"// http://www.fundanemt.com/gpl_da.html\n");
	fwrite($fp,"//\n");
	fwrite($fp,"// Copyright (c) 2003-2016 DANOSOFT ApS\n");
	fwrite($fp,"// ----------------------------------------------------------------------\n");
	fwrite($fp,"\n");
	fwrite($fp,"if (!isset(\$bg)) \$bg='';\n");
	fwrite($fp,"if (!isset(\$title)) \$title='';\n");
	fwrite($fp,"\$db_encode = \"$db_encode\";\n");
	fwrite($fp,"\$db_type = \"$db_type\";\n");
	fwrite($fp,"\n");
	fwrite($fp,"if (file_exists(\"../includes/db_query.php\")) {\n");
	fwrite($fp,"	include(\"../includes/db_query.php\");\n");
	fwrite($fp,"	include(\"../includes/version.php\");\n");
	fwrite($fp,"	include(\"../includes/settings.php\");\n");
	fwrite($fp,"}\n");
	fwrite($fp,"elseif (file_exists(\"../../includes/db_query.php\")){\n");
	fwrite($fp,"	include(\"../../includes/db_query.php\");\n");
	fwrite($fp,"	include(\"../../includes/version.php\");\n");
	fwrite($fp,"	include(\"../../includes/settings.php\");\n");
	fwrite($fp,"}\n");
	fwrite($fp,"\n");
	fwrite($fp,"\$sqhost = \"$host\";\n");
	fwrite($fp,"\$squser	= \"$db_bruger\";\n");
	fwrite($fp,"\$sqpass = \"$db_password\";\n");
	fwrite($fp,"\$sqdb = \"$db_navn\";\n");
	fwrite($fp,"\n");
	fwrite($fp,"#\$login = \"\";\n");
	fwrite($fp,"#\$login = \"dropdown\";\n");
	fwrite($fp,"\$login = \"cookie\";\n");
	fwrite($fp,"\n");
	fwrite($fp,"# \$brug_timestamp=\"y\";\n");
	fwrite($fp,"\n");
	fwrite($fp,"\$font = \"<font face='Arial, Helvetica, sans-serif'>\";\n");
	fwrite($fp,"\n");
	if ($db_type=='mysql') {
		fwrite($fp,"\$connection = db_connect (\"\$sqhost\", \"\$squser\", \"\$sqpass\");\n");
	} else {
		fwrite($fp,"if (\$sqpass) \$connection = db_connect (\"\$sqhost\", \"\$squser\", \"\$sqpass\", \"\$sqdb\");\n");
		fwrite($fp,"else \$connection = db_connect (\"\$sqhost\", \"\$squser\", \"\$sqpass\", \"\$sqdb\");\n");
	}
	fwrite($fp,"if (!isset(\$connection)) die( \"Unable to connect to database\");\n");
	if ($db_type=='mysql') {
		fwrite($fp,"elseif (!mysql_select_db(\"\$sqdb\")) die( \"Unable to connect to MySQL\");\n");
		fwrite($fp,"else mysql_query(\"SET storage_engine=INNODB\");\n");
	}
	fwrite($fp,"\n");
	fwrite($fp,"?".">\n");
}

?>
</head>
</body></html>
