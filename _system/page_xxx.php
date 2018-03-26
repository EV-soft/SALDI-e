<?php   $DocFil= '../_system/page_.php';    $DocVer='5.0.0';    $DocRev='2018-03-00';   $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Redigering af xxx';
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

  $pageTitl='xx';
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
  if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
### INDLÆS DATA:

### VIS DATA:
    SpalteTop(240); Rude_DiverseMenu();
    NextSpalte();   Rude_xx(xx);
    SpalteBund();
    
### GEM DATA:
    
  
//  Til sidst indlæses java-scripter:   
  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>