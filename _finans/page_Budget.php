<?php      $DocFil= '../_finans/page_Budget.php';   $DocVer='5.0.0';     $DocRev='2017-02-00';
// Formål:  
//             ___   _   _    ___  _
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___|
//
// 2016.08.00 ev - EV-soft
//

  $pageTitl= 'Budget';  # tolk('@Budget');
  include('../_base/htm_pageHead.php'); # Sidens indledende html-kode
  include('../_base/str_func.php');   #-  include("../includes/finansfunk.php");
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
 
//  Head_Navigation($pageTitl, $status=tolk('@ '), $goPrev=false, $goHome=true, $goUp=false, $goFind=true, $goNew=true, $goNext=false);  
  
### INDLÆS DATA:
  $DATA= ImportTabFile('../_exchange/budgetplan.tab',1);  // Indlæs data fra TAB-fil    //  $kontotyper=array("H","D","S","Z","R");   $momstyper=array("S","K","E","Y");    

### VIS DATA:
  Rude_Budget($DATA, $regnskabsaar='2017', $maanedantal=12, $startaar= $regnskabsaar, $startmaaned=4);
  Rude_FootMenu();

### GEM DATA:
   
  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  