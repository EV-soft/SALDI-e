<?php   $DocFil='../_base/page_Printlayout.php';    $DocVer='5.0.0';    $DocRev='2017-11-00';     $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Preview af udskrifts-formular.';
 * Denne fil er oprettet af EV-soft i 2017.
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 */

  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
  $pageTitl= tolk('@Print-layout');
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$ModulNr,$DocFil,$pageTitl);
  global $Øprogvers, $Øsaldihost;
### INDLÆS DATA:


### VIS DATA:
    SpalteTop(1100);  
    //  Rude_Printlayout();
    Rude_PrintlayoutTXT();
    SpalteBund();
    //  se også: page_Formtext.php
### GEM DATA:
    

  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  