<?php   $DocFil= '../_system/page_Debkredgrup.php';    $DocVer='5.0.0';    $DocRev='2018-09-20';   $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Redigering af Debitor- og Kreditor-grupper';
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

  $pageTitl='Debitor- & Kreditor-grupper';
  $GLOBALS["ØProgModu"]= ['sekd']; ## prim eller/og sekd og comm
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
  DocAlder($DocRev);
  if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'Debkredgrup');
    
### INDLÆS DATA:

### VIS DATA:
    SpalteTop(240);   Panl_AdminMenu();
    NextSpalte(960);  Panl_DefKredGrp();
    SpalteBund();
    
### GEM DATA:
    
  
//  Til sidst indlæses java-scripter:   
  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>