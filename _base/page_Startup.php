<?php   $DocFil='../_base/page_Startup.php';    $DocVer='5.0.0';    $DocRev='2017-10-00';     $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Idriftsaetning af database og system-admin, eller blot logind';
 * Denne fil er oprettet af EV-soft i 2017.
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 */

  $noneconfig= (!file_exists("../_config/connect.php")) or (filesize("../_config/connect.php")<10);
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
  if ($noneconfig) {$pageTitl= tolk('@Installation af SALDI programmet');}
  else             {$pageTitl= tolk('@Logind til SALDI');}
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$ModulNr,$DocFil,$pageTitl);
  global $Øprogvers, $Øsaldihost;
### INDLÆS DATA:


### VIS DATA:
    SpalteTop(320);  
    if ($noneconfig) {
      NextSpalte(320);     
      Rude_Install($db_type='MySQL',$db_encode,$db_navn='saldi_prog',$db_bruger='DB-admin',$db_password,$adm_navn='SaldiAdm',$adm_password,$verify_adm_password);   
      NextSpalte(320);     
      Rude_DBsetup($db_type='MySQL',$db_encode,$db_navn='saldi_prog',$db_bruger='DB-admin',$db_password,$adm_navn='SaldiAdm',$adm_password,$verify_adm_password,$db_host='Danosoft');
      } else {
      NextSpalte(320);
      Rude_Login($regnskab='CSS-demo',$brugernavn='admin',$brugerkode,$PrgVers=' '.$Øprogvers,$LnkHelp='Hukommelses støtte',$OrgaName=$Øsaldihost,$Logo='SALDIe50x150.png');
    }
      if ($noneconfig) {echo str_nl(1).'&nbsp;&nbsp;'.tolk('@Log først ind, når Databasen er driftsklar!'); }
    SpalteBund();
    
### GEM DATA:
    

  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  