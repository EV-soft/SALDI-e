<?php   $DocFil= '../_system/page_Momssetup.php';    $DocVer='5.0.0';    $DocRev='2018-09-20';   $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Indstilling af MOMS ';
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2016 DANOSOFT ApS *** Se filen: ../LICENS_Copyright.txt
 *
 */
  global $debug;
  $debug= true;
  $pageTitl='Indstil: Moms';
  $GLOBALS["ØProgModu"]= ['sekd']; ## prim eller/og sekd og comm
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$ModulNr,$DocFil,$pageTitl);
### INDLÆS DATA:

### VIS DATA:
    SpalteTop(240); Panl_AdminMenu();
    NextSpalte(720);   Panl_MomsSetup();
    SpalteBund();
### GEM DATA:
 
//  Til sidst indlæses java-scripter:   
  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>