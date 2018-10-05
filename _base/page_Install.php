<?php      $DocFil= '../_base/page_Install.php';    $DocVer='5.0.0';    $DocRev='2018-09-23';     $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Idriftsaetning af database og system-admin';
 *             ___   _   _    ___  _         
 *            / __| / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            |___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 */

  $noneconfig= (!file_exists("../_config/connect.php")) or (filesize("../_config/connect.php")<10);
  if ($noneconfig) {$pageTitl='Installation af SALDI';}
  else             {$pageTitl='SALDI logind';}
  $GLOBALS["ØProgModu"]= ['comm']; ## prim eller/og sekd og comm
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
  global $Øprogvers, $Øsaldihost;
### INDLÆS DATA:
### VIS DATA:
    SpalteTop(320);  
    if ($noneconfig) {
      Panl_Install($db_type='MySQL',$db_encode,$db_navn='saldi-db',$db_bruger='saldisys',$db_password,$adm_navn='SaldiAdm',$adm_password,$verify_adm_password);   
    NextSpalte(320);     
      Panl_DBsetup($db_type='MySQL',$db_encode,$db_navn='saldi-db',$db_bruger='saldisys',$db_password,$adm_navn='SaldiAdm',$adm_password,$verify_adm_password,$db_host='Danosoft');
    NextSpalte(320); 
    }
      Panl_Login($regnskab='CSS-demo',$brugernavn='admin',$brugerkode,$PrgVers=' '.$progvers,$LnkHelp,$OrgaName=$Øsaldihost,$Logo='SALDIe50x150.png');
      if ($noneconfig) {echo str_nl(1).'&nbsp;'.tolk('Log først ind, når Databasen er driftsklar!'); }
    SpalteBund();
    
### GEM DATA:
    

  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>  