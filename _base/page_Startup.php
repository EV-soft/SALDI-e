<?php   $DocFil='../_base/page_Startup.php';    $DocVer='5.0.0';    $DocRev='2018-03-00';     $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Idriftsaetning af database og system-admin, eller blot logind';
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2018 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
  Oprettet: 2016-08-00 evs - EV-soft
  Ændrings-Log:
      
 *
 */

  $noconfig= (!file_exists("../_config/connect.php")) or (filesize("../_config/connect.php")<10);
    if ($noconfig) {$pageTitl= 'Installation af SALDI programmet';}
    else           {$pageTitl= 'Logind til SALDI';}
  
    include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
    if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$ModulNr,$DocFil,$pageTitl);
    global $Øprogvers, $Øsaldihost;
    
### INDLÆS DATA:
    $db_type= strtolower('MySQL');       //$db_encode;
    $db_navn='saldi_prog';
    $db_bruger='DB-admin';  //$db_password;
    $adm_navn='SaldiAdm';
    $db_host='Danosoft';
    $regnskab='Saldi-test';
    $brugernavn='admin';

    if (true) { // TEST:
      //  include('../_base/_admin/ini_CreateDB.php');
      $db_encode= 'UTF8';
      $db_navn='saldi_prog';
      $db_host= 'localhost';
      $db_bruger= 'SaldiAdm';  
      $db_password= 'SaldiPas';
      if (phpversion()=='7.2.1') {
        $db_host= 'mysql46.unoeuro.com';
        $db_bruger= 'ev_soft_dk';
        $db_password= 'M4d73anU8j';
        $db_navn = 'ev_soft_dk_db3';
      }
      //  Rude_Login($regnskab,$db_bruger,$db_password,$PrgVers=' '.$Øprogvers,$LnkHelp='Hukommelses støtte',$OrgaName=$Øsaldihost,$Logo='SALDIe50x150.png');
      $Ødb_Link= dbi_connect($db_host, $db_bruger, $db_password, $db_navn,__FILE__, __LINE__);
      if ($Ødb_Link) echo 'Tilsluttet databasen: '.$db_navn; else echo 'Ingen tilslutning til database!';
      
      SpalteTop(1100);  
      //  Rude_Printlayout();     //  Grafisk baseret
      //  Rude_PrintlayoutTXT();  //  Text baseret. Med export af ver.3.+ til ver.5.0
        Rude_PrintDesign();       //  Ren vers. 5.0
        Rude_FormularTabel();
      SpalteBund();
    }
    else {
### VIS DATA:
      SpalteTop(320);  
      if ($noconfig) {
        NextSpalte(320);     
          Rude_Install($db_type,$db_encode,$db_navn,$db_bruger,$db_password,$adm_navn,$adm_password,$verify_adm_password);   
        NextSpalte(320);     
          Rude_DBsetup($db_type,$db_encode,$db_navn,$db_bruger,$db_password,$adm_navn,$adm_password,$verify_adm_password,$db_host);
        } else {
        NextSpalte(320);
          Rude_Login($regnskab,$brugernavn,$brugerkode,$PrgVers=' '.$Øprogvers,$LnkHelp='Hukommelses støtte',$OrgaName=$Øsaldihost,$Logo='SALDIe50x150.png');
      }
        if ($noconfig) {echo str_nl(1).'&nbsp;&nbsp;'.tolk('@Log først ind, når Databasen er driftsklar!'); }
      SpalteBund();
    }
### GEM DATA:
    
  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>  