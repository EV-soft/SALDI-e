<?php      $DocFil= '../_system/page_Enheder.php';   $DocVer='5.0.0';     $DocIni='evs';  $DocRev='2018-09-20';   $ModulNr=0;
/* ## Purpose: 'Rediger Enheder';
 * Denne fil er oprettet af EV-soft i 2017.
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS      *** Se filen: ../LICENS_Copyright.txt
 *
 */

 $_base= '../_base/';
  $pageTitl='Indstil: Enheder';
  $GLOBALS["ØProgModu"]= ['sekd']; ## prim eller/og sekd og comm
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
### INDLÆS DATA:

### VIS DATA:
    SpalteTop(240);   Panl_AdminMenu();
    NextSpalte();     Panl_Enheder();
    SpalteBund();
    
### GEM DATA:
 
  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
//  include($_base."htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>  