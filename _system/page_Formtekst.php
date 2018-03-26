<?php   $DocFil= '../_system/page_Formtekst.php';    $DocVer='5.0.0';    $DocRev='2018-03-00';   $DocIni='evs';   $ModulNr=0;
/* ## Purpose: 'Haandtering af tekster paa formularer';
 * Denne fil er oprettet af EV-soft i 2017.
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS      *** Se filen: ../LICENS_Copyright.txt
 *
 */

  $pageTitl='Formulartekster';
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
  if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
### INDLÆS DATA:
    $filDATA= ImportTabFile('../_exchange/tekster.tab');
  
### VIS DATA:
    SpalteTop(240);   Rude_DiverseMenu();
    NextSpalte();     Rude_Formtekst($filDATA);
    SpalteBund();
### GEM DATA:
  
//  Til sidst indlæses java-scripter:   
  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>