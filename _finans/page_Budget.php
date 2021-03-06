<?php      $DocFil= '../_finans/page_Budget.php';   $DocVer='5.0.0';    $DocRev='2018-09-20';     $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Rediger/Vis Budget';
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
 
  $pageTitl= 'Budget';  # tolk('@Budget');
  $GLOBALS["ØProgModu"]= ['prim']; ## prim eller/og sekd og comm
  include('../_base/htm_pagePrepare.php'); # Sidens indledende html-kode
  include('../_base/str_func.php');   #-  include("../includes/finansfunk.php");
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
 
//  Head_Navigation($pageTitl, $status=tolk('@ '), $goPrev=false, $goHome=true, $goUp=false, $goFind=true, $goNew=true, $goNext=false);  
  
### INDLÆS DATA:
  $DATA= ImportTabFile('../_exchange/budgetplan.tab',1);
  
### VIS DATA:
  SpalteTop(1200);   
  Panl_Budget($DATA, $regnskabsaar='2018', $maanedantal=12, $startaar= $regnskabsaar, $startmaaned=4);
  SpalteBund();
    
//  Panl_FootMenu();

### GEM DATA:
   
  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>  