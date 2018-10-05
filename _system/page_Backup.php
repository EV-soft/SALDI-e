<?php   $DocFil= '../_system/page_Backup.php';    $DocVer='5.0.0';    $DocRev='2018-09-20';   $DocIni='evs';   $ModulNr=2;
/* ## Purpose: 'Backup/restore af regnskabsdata';
 * Denne fil er oprettet af EV-soft i 2017.
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS      *** Se filen: ../LICENS_Copyright.txt
 *
 *
 */

  $pageTitl='Udfør Backup/restore';
  $GLOBALS["ØProgModu"]= ['sekd']; ## prim eller/og sekd og comm
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
  if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
### INDLÆS DATA:

### VIS DATA:
    SpalteTop(640);     Panl_Backup();
    NextSpalte(640);    Panl_Zipbackup();
    SpalteBund();
    if (!$GLOBALS["Øjob"]=='zip') PanelInitier(2,3);
### GEM DATA:
  
//  Til sidst indlæses java-scripter:   
  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>