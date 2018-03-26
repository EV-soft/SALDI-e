<?php      $DocFil= '../_debitor/page_Rapport.php';    $DocVer='5.0.0';    $DocRev='2018-03-00';   $DocIni='evs';  $ModulNr=0;
/* Formål:  Se finans rapport
 *             ___   _   _    ___  _         
 *            / __| / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            |___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 * 2016.08.00 evs - EV-soft
 *
 */
 
  $pageTitl='Debitor Rapport';
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
### INDLÆS DATA:

### VIS DATA:
    SpalteTop(320);   Rude_DebRapp();
    NextSpalte(640);  Rude_Rapportliste();  
    SpalteBund();
    
### GEM DATA:
    

  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>  