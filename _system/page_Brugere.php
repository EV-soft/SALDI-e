<?php   $DocFil= '../_system/page_Brugere.php';  $DocVer='5.0.0';  $DocRev='2018-09-20';     $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Administration af Bruger rettigheder';
 * Denne fil er oprettet af EV-soft i 2017.
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS      *** Se filen: ../LICENS_Copyright.txt
 *
 */

 
if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'Brugerdata');

  $pageTitl='Brugerdata';
  $GLOBALS["ØProgModu"]= ['sekd']; ## prim eller/og sekd og comm
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
  DocAlder($DocRev);
    
### INDLÆS DATA:

### VIS DATA:
    SpalteTop(240);   Panl_AdminMenu();
    NextSpalte(720);  Panl_Brugere();
    SpalteBund();
    
### GEM DATA:
    
  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>  