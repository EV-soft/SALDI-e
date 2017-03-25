<?php      $DocFil= '../_base/sys_setup.php';    $DocVer='5.0.0';     $DocRev='2017-02-00';
//             ___   _   _    ___  _         
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___|
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
// !!!  Denne fil afløser: ..\index\install.php
// Filer skal gemmes i UTF-8 format uden BOM!
//  2016.08.00 ev - EV-soft 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
  <title>SALDI - det frie danske økonomisystem</title>
  <link rel="stylesheet" href= "../css/out_style.css">
<?php
  if (!file_exists("../includes/connect.php"))  {include("../base/page_LayoutModuler.php"); exit;
  # {echo '<meta http-equiv="refresh" content="0;URL=index.php">';  exit;}   ### SALDI er allerede konfigureret!
  }

include("../_base/dbi_func.php");
include("../includes/settings.php");
include("../_base/version.php");
#+  
require("../includes/pbkdf2.php");

include("base_init.php");
include("../_base/out_base.php");
include("../_base/out_ruder.php");
include("../_base/out_vinduer.php");

#-  unset($_POST['opret']);
if (isset($_POST['opret'])) {
  $felt_mangler=false;  
  $pw_diff=false; 
#+
  $ext_loaded=false;
  $db_encode=$_POST['db_encode'];
  $db_type=strtolower($_POST['db_type']);
  $db_navn=      trim($_POST['db_navn']);     if (strlen($db_navn)==0)      {$felt_mangler=true; $db_navn=  "<i>Feltet er tomt!</i>";}
#+
  if (extension_loaded('mcrypt') && extension_loaded('hash')) { $ext_loaded=true; }
  
  $db_bruger=    trim($_POST['db_bruger']);   if (strlen($db_bruger)==0)    {$felt_mangler=true; $db_bruger="<i>Feltet er tomt!</i>";}
  $db_password=  trim($_POST['db_password']); if (strlen($db_password)==0)  {$felt_mangler=true; $db_pw=    "<i>Feltet er tomt!</i>";} else {$db_pw="-- vises ikke --";}
  $adm_navn=     trim($_POST['adm_navn']);    if (strlen($adm_navn)==0)     {$felt_mangler=true; $adm_navn= "<i>Feltet er tomt!</i>";}
  $adm_password= trim($_POST['adm_password']);  $verify_adm_password=trim($_POST['verify_adm_password']);
  if (strlen($adm_password)==0) {
      $felt_mangler=true; $adm_pw="<i>Feltet er tomt!</i>";
      if (strlen($verify_adm_password)==0) {$verify_adm_pw="<i>Feltet er tomt!</i>";  } 
      else {$verify_adm_pw = "<i>Adgangskoder forskellige! Skal være ens.</i>"; }
    } else {  
    if ($adm_password == $verify_adm_password ) {$adm_pw = "**********";  $verify_adm_pw = "**********";} 
      else {$pw_diff=true; $verify_adm_pw = "<i>Adgangskoder forskellige. Skal være ens.</i>";}
    }

#-  $adm_password= md5(trim($_POST['adm_password']));
#+
  $adm_password = \PBKDF2\create_hash(trim($_POST['adm_password'])); // Genererer ny unik salt og hash

//            function row1($ju,$k1) {return '<tr><td colspan="2" align= "'.$ju.'"><b>'.$k1.'</b></td></tr>'; }
//            function row2($k1,$k2) {return '<tr><td align= "right">'.$k1.' :&nbsp; </td><td><b>'.$k2.'</b></td></tr>'; }
//          # Body-Container:
//            $tmp.='<table width="50%" align="center" border="1" >';
//            $tmp.=row1('center','<big>Oplysninger til SALDI-installation:</big>');
//            $tmp.=row2('Databaseserver',$db_type);
//            $tmp.=row2('Tegnsæt',$db_encode);
//            $tmp.=row2('Databasenavn',$db_encode);
//            $tmp.=row2('Dataadministrator',$db_bruger);
//            $tmp.=row2('Adgangskode for databaseadministrator',$db_pw);
//            $tmp.=row2('SALDI-administratorens brugernavn',$adm_navn);
//            $tmp.=row2('SALDI-administratorens adgangskode',$adm_pw);
//            $tmp.=row2('Verificeret adgangskode',$verify_adm_pw);
//            $tmp.='<hr \>';
//            if ($felt_mangler)  $tmp.=row1('left','<i> Et eller flere felter mangler at blive udfyldt. Se ovenfor.</i>');
//            if ( $pw_diff )     $tmp.=row1('left','<i> Adgangskode og verifikationskoden for SALDI-administrator er forskellig.</i>');
//          #-
//            if ( $felt_mangler || $pw_diff ) {
//          #+  if ( !$ext_loaded ) $tmp.="<tr><td colspan=\"2\"><b><i>PHP extension mcrypt og/eller hash er ikke indlæst. Prøv at installere pakken php5-mcrypt.</i></b></td></tr>\n";
//          #+  if ( $felt_mangler || $pw_diff || !$ext_loaded ) {
//              $tmp.=row1('left','<i> Gå tilbage til forrige side og ret fejlene</i><br /> Brug eventuelt browserens tilbage-knap for at gå tilbage.</p>');
//            # $tmp.='<tr><td colspan="2"><b><i> Gå tilbage til forrige side og ret fejlene</i></b><br /> Brug eventuelt browserens tilbage-knap for at gå tilbage.</p>';
//              $tmp.='</body></html>';
//              
//              
//            # echo $tmp;  $tmp="";
    Rude_Install($db_type, $db_encode, $db_navn, $db_bruger, $db_password, $adm_navn, $adm_password, $verify_adm_password);
    
    //  Kryptering af: $db_password, $adm_password   crypt() or password_hash() http://dk2.php.net/manual/en/faq.passwords.php
    //  $hash= password_hash($password, PASSWORD_BCRYPT);    //  password_verify ($password, $hash);
    //  if (password_verify ($password, $hash)) {echo 'Password is valid!';} else {echo 'Invalid password.';}
    
    exit;  ### SALDI opsætning er mangelfuld!
  }
  $noskriv=NULL;
  if ($fp=fopen("../_config/connect.php","a"))  { fclose($fp);} else $noskriv.="_config ";
  if ($fp=fopen("../_temp/test.txt","w"))       { fclose($fp);} else $noskriv.="_temp ";
  if ($fp=fopen("../_userlib/test.txt","w"))    { fclose($fp);} else $noskriv.="_userlib ";
  
  if ($noskriv) {
    if ($noskriv=="_config ") echo '<p>Der er ikke skriveadgang til katalog(erne) '.$noskriv.', hvor "connect.php" skal oprettes.</p>';
    else                      echo 'Der er ikke skriveadgang til kataloget/erne '.$noskriv;
    echo '<p>Sørg for at der er skriveadgang for den bruger, som den besøgende kører som (webserverbrugeren) ';
    echo 'til katalogerne: "_config", "_temp" og "_userlib".<br>'.
         ' Se hvordan i installeringsvejledningen <a href="../INSTALLATION.txt" target="blank">INSTALLATION.txt</a>.</p>';
    echo '</td></tr></table></body></html>';
    exit;  ### SALDI mangler skriveadgang!
  }   

  $host="localhost";  $tempdb="template1";
  
  if ($db_type=="mysql") 
        {$connection = db_connect ("$host", "$db_bruger", "$db_password");             $db_name= 'MySQL';     }
  else  {$connection = db_connect ("$host", "$db_bruger", "$db_password", "$tempdb");  $db_name= 'PostgreSQL';  }
  if (!$connection) die('Kan ikke oprette forbindelse til '.$db_name);

  if ($db_type=="mysql") {
    db_modify("CREATE DATABASE $db_navn",                                                 __FILE__ . " linje " . __LINE__);
    mysql_select_db("$db_navn");  } 
  else {
    if ($db_encode=="UTF8") db_modify("CREATE DATABASE $db_navn with encoding = 'UTF8'",  __FILE__ . " linje " . __LINE__);
    else db_modify("CREATE DATABASE $db_navn with encoding = 'LATIN9'",                   __FILE__ . " linje " . __LINE__);
    db_close($connection);
    $connection = db_connect ("$host", "$db_bruger", "$db_password", "$db_navn");
  }

  transaktion("begin");
  db_modify("CREATE TABLE brugere   (id serial NOT NULL,  brugernavn text, kode text, status boolean, regnskabsaar integer, rettigheder text, PRIMARY KEY (id))",__FILE__ . " linje " . __LINE__);
  db_modify("INSERT INTO brugere    (brugernavn, kode, rettigheder) values ('$adm_navn' ,'$adm_password', '11111111111111111111')",__FILE__ . " linje " . __LINE__);
  db_modify("CREATE TABLE regnskab  (id serial NOT NULL,  regnskab text, dbhost text, dbuser text, db text, version text, sidst text, brugerantal numeric, posteringer numeric, posteret numeric, lukket text,administrator text,lukkes date, betalt_til date,logintekst text,email text,bilag numeric(1,0), PRIMARY KEY (id))",__FILE__ . " linje " . __LINE__);
  db_modify("INSERT INTO regnskab   (regnskab, dbhost, dbuser, db, version,bilag) values ('$db_navn' ,'$host', '$db_bruger', '$db_navn', '$version','0')",__FILE__ . " linje " . __LINE__);
  db_modify("CREATE TABLE online    (session_id text,     brugernavn text, db text, dbuser text, rettigheder text, regnskabsaar integer, logtime text, revisor boolean)",__FILE__ . " linje " . __LINE__);
  db_modify("CREATE TABLE kundedata (id serial NOT NULL,  firmanavn text, addr1 text, addr2 text, postnr varchar(10), bynavn text, kontakt text, email text, cvrnr text, regnskab text, regnskab_id integer,brugernavn text, kodeord text, kontrol_id text, aktiv int, logtime text,slettet varchar(2),PRIMARY KEY (id))",__FILE__ . " linje " . __LINE__);
  db_modify("CREATE TABLE tekster   (id serial NOT NULL,  sprog_id integer, tekst_id integer, tekst text, PRIMARY KEY (id))",__FILE__ . " linje " . __LINE__);
  db_modify("CREATE TABLE revisor   (id serial NOT NULL,  regnskabsaar integer,bruger_id integer,brugernavn text,db_id integer,PRIMARY KEY (id))",__FILE__ . " linje " . __LINE__);
  transaktion("commit");
  
  if ($fp=fopen("../includes/connect.php","a")) {
      make_connect($fp,$host,$db_bruger,$db_password,$db_navn,$db_encode,$db_type);
      fclose($fp);
      vindue_InstallSucces ($db_navn, $adm_navn); }
  else {
      vindue_InstallFail();
      exit;  ### SALDI mangler skriveadgang. connect.php er ikke dannet!
      }
# else {
      vindue_Install($db_type, $db_encode, $db_navn, $db_bruger, $db_password, $adm_navn, $adm_password, $verify_adm_password); 
#     }

function make_connect($fp,$host,$db_bruger,$db_password,$db_navn,$db_encode,$db_type) {
  $Str = "<?php   $DocFil= '../includes/connect.php';   $DocVer='5.0.0';    $DocRev='2016-10-00';   $modulnr=0;\n";
  $Str.= "//             ___   _   _    ___  _         \n";
  $Str.= "//            / __| /_\ | |  |   \| |   ___  \n";
  $Str.= "//            \__ \/ _ \| |__| |) | |__/ -_) \n";
  $Str.= "//            |___/_/ \_|____|___/|_|  \___| \n";
  $Str.= "//                                           \n";
  $Str.= "// LICENS & Copyright (c) 2004-2016 DANOSOFT ApS *** Se filen: ../LICENS_Copyright.txt\n";
  $Str.= "//\n";
  $Str.= "// Dette program er fri software. Du kan gendistribuere det og / eller\n";
  $Str.= "// modificere det under betingelserne i GNU General Public License (GPL)\n";
  $Str.= "// som er udgivet af The Free Software Foundation; enten i version 2\n";
  $Str.= "// af denne licens eller en senere version efter eget valg\n";
  $Str.= "//\n";
  $Str.= "// Dette program er udgivet med haab om at det vil være til gavn,\n";
  $Str.= "// men UDEN NOGEN FORM FOR REKLAMATIONSRET ELLER GARANTI. Se\n";
  $Str.= "// GNU General Public Licensen for flere detaljer.\n";
  $Str.= "//\n";
  $Str.= "// En dansk oversaettelse af licensen kan laeses her:\n";
  $Str.= "// http://www.fundanemt.com/gpl_da.html\n";
  $Str.= "//\n";
  $Str.= "// Copyright (c) 2003-2016 DANOSOFT ApS\n";
  $Str.= "// ----------------------------------------------------------------------\n";
  $Str.= "\n";
  $Str.= "if ($GLOBALS['debug']) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'');";
  $Str.= "if (!isset(\$bg)) \$bg='';\n";
  $Str.= "if (!isset(\$title)) \$title='';\n";
  $Str.= "\$db_encode = '$db_encode';\n";
  $Str.= "\$db_type = '$db_type';\n";
  $Str.= "\n";
  $Str.= "if (file_exists('../includes/db_func.php')) {\n";
  $Str.= "   include('../includes/db_func.php');\n";
  $Str.= "   include('../includes/version.php');\n";
  $Str.= "   include('../includes/settings.php');\n";
  $Str.= "}\n";
  $Str.= "elseif (file_exists('../../includes/db_func.php')){\n";
  $Str.= "   include('../../includes/db_func.php');\n";
  $Str.= "   include('../../includes/version.php');\n";
  $Str.= "   include('../../includes/settings.php');\n";
  $Str.= "}\n\n";
  $Str.= "\$sqhost = '$host';\n";
  $Str.= "\$squser  = '$db_bruger';\n";
  $Str.= "\$sqpass = '$db_password';\n";
  $Str.= "\$sqdb = '$db_navn';\n\n";
  $Str.= "\$login = 'cookie';\n\n\n";
  $Str.= "\$font = '<font face=\'Arial, Helvetica, sans-serif\'>';\n\n";
  if ($db_type=='mysql') { 
    $Str.= "\$connection = db_connect ('\$sqhost', '\$squser', '\$sqpass');\n";
    } else {
      $Str.= "if (\$sqpass) \$connection = db_connect ('\$sqhost', '\$squser', '\$sqpass', '\$sqdb');\n";
      $Str.= "else \$connection = db_connect ('\$sqhost', '\$squser', '\$sqpass', '\$sqdb');\n";
    }
  $Str.= "if (!isset(\$connection)) die( 'Unable to connect to database');\n";
  if ($db_type=='mysql') {
      $Str.= "elseif (!mysql_select_db('\$sqdb')) die( 'Unable to connect to MySQL');\n";
      $Str.= "else mysql_query('SET storage_engine=INNODB');\n";
    }
  $Str.= "\n?>\n";
  fwrite($fp,$Str);
} # make_connect End

?>
</head>
</body></html>
