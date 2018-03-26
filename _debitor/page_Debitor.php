<?php $DocFil= '../_debitor/page_Debitor.php';   $DocVer='5.0.0';    $DocRev='2018-03-00';   $DocIni='evs';  $ModulNr=5;
/* Formål:  Debitorliste og -kort
 *             ___   _   _    ___  _         
 *            / __| / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            |___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2018 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 *
  Oprettet: 2016-08-00 evs - EV-soft
  Ændrings-Log:
      
 *
 */
 
  $pageTitl='Salgs ordrer';
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);

### INDLÆS DATA:

### VIS DATA:
  # Head_Navigation(tolk('@Debitorer'), $status=tolk('@ '), $goPrev=true, $goHome=true, $goUp=false, $goFind=true, $goNew=true, $goNext=true);  
  Rude_DebtDebitor();  # Demo!
  
  skilleLin();
  Rude_DebitorKort();

### GEM DATA:
  
  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>  