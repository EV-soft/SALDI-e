<?php   $DocFil= '../_system/page_Connsetup.php';   $DocVer='5.0.0';   $DocRev='2017-03-00';   $DocIni='evs';  $ModulNr=99;
/* ## Purpose: 'Opsaetning af forbindelse til database.';
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 DANOSOFT ApS *** Se filen: ../LICENS_Copyright.txt
 *
 * 2016.08.00 ev - EV-soft
 *
 */
 
global $Ødb_Link, $Ødb_Type, $Øprogvers, $ØProgRoot;  //  Tildeles værdi i htm_pageHead.php
  $pageTitl='SALDI - det frie danske økonomisystem';
  $_base= '../_base/';
  include($_base."htm_pageHead.php"); # Sidens indledende html-kode   $_SERVER['DOCUMENT_ROOT'].   saldi-e/_base/
  if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$ModulNr,$DocFil,$pageTitl);

### INDLÆS DATA:
  if (file_exists("../_config/connect.php"))  {
  # {echo '<meta http-equiv="refresh" content="0;URL=index.php">';  exit;}   ### SALDI er allerede konfigureret!
  }
#-  unset($_POST['opret']);
if (isset($_POST['opret'])) {
}
  $felt_mangler=false;  
  $pw_diff=false; 
#+
  $ext_loaded=false;
  $db_encode=           $_POST['db_encode'];
  $Ødb_Type= strtolower($_POST['db_type']);
  $db_navn=        trim($_POST['db_navn']);     if (strlen($db_navn)==0)      {$felt_mangler=true; $db_navn=  '';}
#  if (extension_loaded('mcrypt') && extension_loaded('hash')) { $ext_loaded=true; }
  
  $db_bruger=      trim($_POST['db_bruger']);   if (strlen($db_bruger)==0)    {$felt_mangler=true; $db_bruger="";}
  $db_password=    trim($_POST['db_password']); if (strlen($db_password)==0)  {$felt_mangler=true; $db_pw=    "";} else {$db_pw="-- vises ikke --";}
  $adm_navn=       trim($_POST['adm_navn']);    if (strlen($adm_navn)==0)     {$felt_mangler=true; $adm_navn= "";}
  $adm_password=   trim($_POST['adm_password']);  
  $verify_adm_password=trim($_POST['verify_adm_password']);
  if   (strlen($adm_password)==0)        { $felt_mangler=true; $adm_pw='';
    if (strlen($verify_adm_password)==0) {$verify_adm_pw='';  } 
    else {$verify_adm_pw = "<i>Adgangskoder forskellige! Skal være ens.</i>"; }
  } else {  
    if ($adm_password == $verify_adm_password ) 
         {$adm_pw = "**********";  $verify_adm_pw = "**********";} 
    else {$pw_diff=true; $verify_adm_pw = "<i>Adgangskoder forskellige. Skal være ens.</i>";}
  }

$adm_passhash = password_hash($adm_password,PASSWORD_BCRYPT );  //  echo '['.$adm_password.'] '.$adm_passhash;

if ($felt_mangler==false) {// Klar til at tilkoble:
//  echo '*['.$Ødb_Type.']*';
  $host="localhost";  $tempdb="template1"; if ($Ødb_Type<=" ") $Ødb_Type="mysql";   
  if ($Ødb_Type=="mysql") {$Ødb_Link= dbi_connect($host, $db_bruger, $db_password, $Øsqdb, __FILE__, __LINE__);  $db_name= 'MySQL'; }       //{$connection = db_connect ("$host", "$db_bruger", "$db_password");             $db_name= 'MySQL';     }
  else     /* PostgreS */ {$Ødb_Link= dbi_connect($host, $db_bruger, $db_password, $tempdb,__FILE__, __LINE__);  $db_name= 'PostgreSQL';}   //{$connection = db_connect ("$host", "$db_bruger", "$db_password", "$tempdb");  $db_name= 'PostgreSQL';  }
  if (!$Ødb_Link) die('Kan ikke oprette forbindelse til '.$db_name);
  //echo '*['.$Ødb_Link.']*';

  if ($Ødb_Type=="mysql") {
    sql_creat("CREATE DATABASE ".$db_navn, __FILE__ . __LINE__);                                // db_modify("CREATE DATABASE $db_navn", __FILE__ . " linje " . __LINE__);
    $Ødb_Link= dbi_connect($host, $db_bruger, $db_password, $db_navn,__FILE__, __LINE__);       // mysql_select_db("$db_navn");  } 
  } else { /* PostgreS */                                                                       // if ($db_encode=="UTF8") 
    sql_creat("CREATE DATABASE ".$db_navn."WITH encoding = ".$db_encode, __FILE__ . __LINE__);  // db_modify("CREATE DATABASE $db_navn with encoding = 'UTF8'",  __FILE__ . " linje " . __LINE__);
                                                                                                // else db_modify("CREATE DATABASE $db_navn with encoding = 'LATIN9'",                   __FILE__ . " linje " . __LINE__);
    dbi_DBclose($Ødb_Link, __FILE__ . __LINE__);                                                // db_close($connection);
    $Ødb_Link = dbi_connect($host, $db_bruger, $db_password, $Øsqdb,__FILE__, __LINE__);        // db_connect ("$host", "$db_bruger", "$db_password", "$db_navn");
  }
}
  
### VIS DATA:
    
  //Rude_Connsetup(); 
  SpalteTop(480); Rude_Install($db_type='MySQL',$db_encode,$db_navn,$db_bruger,$db_password,$adm_navn,$adm_password,$verify_adm_password);
  NextSpalte();   Rude_DBsetup($db_type='MySQL',$db_encode,$db_navn,$db_bruger,$db_password,$adm_navn,$adm_password,$verify_adm_password,$db_host='MyServer');
  SpalteBund();   
  skilleLin();
  NextSpalte();   Rude_Login($regnskab='CSS-demo',$brugernavn='admin',$brugerkode,$PrgVers=' '.$Øprogvers,$LnkHelp='Dette er en demonstration.',$OrgaName=$saldihost='MyServer',$Logo='SALDIe50x150.png');
  
### GEM DATA:

  include($ØProgRoot.$_base."htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  