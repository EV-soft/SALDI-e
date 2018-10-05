<?php   $DocFil= '../_system/page_Valuta.php';    $DocVer='5.0.0';     $DocRev='2018-09-20';   $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Valuta vedligeholdelse';
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 */

  global $Ødebug;
  $Ødebug= true;
  $pageTitl='Indstil Valuta';
  $GLOBALS["ØProgModu"]= ['sekd']; ## prim eller/og sekd og comm
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
  if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$ModulNr,$DocFil,'Hovedmenu');
### INDLÆS DATA:

### VIS DATA:
    SpalteTop(240);   Panl_AdminMenu();
    NextSpalte(320);  Panl_Valuta();
    NextSpalte(320);  Panl_Valutakort();
    SpalteBund();
    PanelInitier(3,7);
### GEM DATA:
  

//  Til sidst indlæses java-scripter:   
  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>