<?php      $DocFil= '../_base/page_Gruppeinfo.php';    $DocVer='5.0.0';    $DocRev='2018-09-23';     $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Omtale af program nyheder';
 *             ___   _   _    ___  _         
 *            / __| / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            |___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 */

  $pageTitl='Info om grupper';
  $GLOBALS["ØProgModu"]= ['comm']; ## prim eller/og sekd og comm
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
### INDLÆS DATA:

### VIS DATA:
    SpalteTop(480);   Panl_GruppeBrug();   
    NextSpalte(480);  // Panl_TipsBogh();
    SpalteBund();
    
### GEM DATA:
    

  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>  