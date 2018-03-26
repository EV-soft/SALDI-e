<?php      $DocFil= '../_system/page_FormOrdrelin.php';    $DocVer='5.0.0';    $DocRev='2018-03-00';   $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Rediger formularer-ordrelinier';
 * Denne fil er oprettet af EV-soft i 2017.
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS      *** Se filen: ../LICENS_Copyright.txt
 *
 */

if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'Hovedmenu');

  $pageTitl='Brugerdata';
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
### INDLÆS DATA:

### VIS DATA:
    SpalteTop(240); Rude_Formularer();
    NextSpalte();   Rude_FormRedigerOrdrelin();
    SpalteBund();

### GEM DATA:

  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>  