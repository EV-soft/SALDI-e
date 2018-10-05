<?php   $DocFil= '../_system/page_Tilvalgsetup3.php';    $DocVer='5.0.0';    $DocRev='2018-09-20';   $DocIni='evs';  $ModulNr=0;
/* ## Purpose: ' 3. indstillingsmenu: Tilvalg';
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
* LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 */
#  global $debug;  $debug= true;
  $pageTitl='Diverse tilvalg menu';
  $GLOBALS["ØProgModu"]= ['sekd']; ## prim eller/og sekd og comm
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
    
### INDLÆS DATA:
    
    
### VIS DATA:
    SpalteTop(240);    Panl_TilvalgsMenu();
    NextSpalte(320);   Panl_Tilvalg();
    SpalteBund();
    //PanelInitier(3,7);
### GEM DATA:

//  Til sidst indlæses java-scripter:   
  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>