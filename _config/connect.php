 <?php   $DocFil= '../_config/connect.php';   $DocVer='5.0.0';     $DocRev='2018-08-23';    $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Opkobling til saldi programmets Database';
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2018 Saldi.dk ApS      *** Se filen: ../LICENS_Copyright.txt
 *
 *  
  Oprettet: 2016-08-00 evs - EV-soft
  Ændrings-Log:
      
 *
 * ----------------------------------------------------------------------
 */

 if (!function_exists('msg_Dialog')) {include_once('../../_base/msg_lib.php');};

global $Ødb_Encode, $Ødb_Type, $Øsqdb, $Ødb_Link;

// Global use (dbi_func.php, ):
$Ødb_Encode= 'UTF8'; 
$Ødb_Type= strtolower('MySQL');
$login= 'cookie';

{ //  TEST-server:
  $sqhost= 'localhost';
  $squser= 'SaldiAdm';
  $sqpass= 'SaldiPas';
  $Øsqdb = 'saldi_prog';
}

$MyPrivate= './../---Private/serverFacts.inf';
if (file_exists($MyPrivate))
include($MyPrivate);   //  Aktuelle statiske installations-data, som skal være uberørte af system-opdateringer!
else echo ' Aktuelle tilslutnings-data ikke fundet! Søgt i: '.$MyPrivate;

/* Eksempel på indhold;
<?php
{ //  TEST-server 2:
  $sqhost= 'localhost';
  $squser= 'SaldiAdm';
  $sqpass= 'SaldiPas';
  $Øsqdb = 'saldi_prog';
}

if (phpversion()=='7.0.28')
{ //  TEST-server 3:
  $sqhost= '127.0.0.1:3307';
  $squser= '••••';
  $sqpass= '••••••••';
  $Øsqdb = '••••••••';
}

if (phpversion()=='7.2.1') 
{  //  DEMO-server:
  $sqhost= '•••.unoeuro.com';
  $squser= '••••';
  $sqpass= '••••••••';
  $Øsqdb = '••••••••';
}
?>
*/

$Ødb_Link= dbi_connect($sqhost, $squser, $sqpass, $Øsqdb); // dbi_* funktioner universelle for postgres og mysql . Erstatter mysqli_connect:
if (!$Ødb_Link) {
    $spor.= str_Ihead('Function:').'dbi_connect()'.str_Ihead('File:'). __FILE__ .str_Ihead('Line:'). __LINE__ .str_Ihead('Info:').'[!$Ødb_Link] $Øsqdb:'.$Øsqdb;
    msg_Dialog('error', tolk('@Retur'),'window.history.back();', '', '', '', '', 
            tolk('@Database tilkobling'), tolk('@STOP ! - fordi oprettelse af link til databasen mislykkes!').str_nl(2).str_hr().$spor);
    //  echo '<br>Connect-data: HOST: '.$sqhost, ' USER: '.$squser, ' PASS: '.$sqpass, ' DB: '.$Øsqdb;
    //  Warning: mysqli_connect() [function.mysqli-connect]: (HY000/1044): Access denied for user 'ev_soft_dk'@'%' to database 'saldi_prog' in /var/www/ev-soft.dk/public_html/saldi-e/_base/dbi_func.php on line 306
}
//  else echo ' Tilsluttet databasen! <br>';
    
?>
