<?php   $DocFil= '../_systemdata/page_Programsprog.php';    $DocVer='5.0.0';    $DocRev='2017-03-00';   $ModulNr=2;
/* Formål: Redigering af Programtekster
 *             ___   _   _    ___  _         
 *            / __| / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            |___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 */

  $pageTitl= 'Indstil mere: Programtekster';
  if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode

### INDLÆS DATA:

### VIS DATA:
    SpalteTop(240); Rude_DiverseMenu();
    NextSpalte();   Rude_LanguageJuster();
    SpalteBund();
### GEM DATA:
  

  
//  Til sidst indlæses java-scripter:   
  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>