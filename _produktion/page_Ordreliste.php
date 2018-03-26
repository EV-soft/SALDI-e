<?php      $DocFil= '../_produktion/page_Ordreliste.php';   $DocVer='5.0.0';    $DocRev='2018-03-00';     $DocIni='evs';  $ModulNr=0;
/*  Formål:  Se Produktions ordrer
 *             ___   _   _    ___  _         
 *            / __| / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            |___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 */
  $pageTitl='Produktions ordrer';
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
    
### INDLÆS DATA:

### VIS DATA:
    Rude_Blindgyde(); 

### GEM DATA:

  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>  