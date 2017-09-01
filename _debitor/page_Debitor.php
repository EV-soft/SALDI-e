<?php $DocFil= '../_debitor/page_Debitor.php';   $DocVer='5.0.0';  $DocRev='2017-04-00'; $modulnr=5;
/* Formål:  Debitorliste og -kort
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
 
  $pageTitl='Salgs ordrer';
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);

### INDLÆS DATA:

### VIS DATA:
  # Head_Navigation(tolk('@Debitorer'), $status=tolk('@ '), $goPrev=true, $goHome=true, $goUp=false, $goFind=true, $goNew=true, $goNext=true);  
  Rude_DebtDebitor();  # Demo!
  
  skilleLin();
  Rude_DebitorKort();

### GEM DATA:
  
  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  