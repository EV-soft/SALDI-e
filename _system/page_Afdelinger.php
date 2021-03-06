<?php   $DocFil= '../_system/page_Afdelinger.php';    $DocVer='5.0.0';    $DocRev='2018-09-20';   $DocIni='evs';   $ModulNr=2;
/* ## Purpose: 'Redigering af Afdelinger';
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

  $pageTitl='Indstil: Afdelinger';
  $GLOBALS["ØProgModu"]= ['sekd']; ## prim eller/og sekd og comm
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
  DocAlder($DocRev);
  if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'Afdelinger');
### INDLÆS DATA:

### VIS DATA:
    SpalteTop(240); Panl_AdminMenu();
    NextSpalte();   Panl_Afdelinger($Nr, $Beskrivelse, $Afd);
    SpalteBund();
### GEM DATA:
 
  
//  Til sidst indlæses java-scripter:   
  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>