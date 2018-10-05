<?php   $DocFil= '../_kreditor/page_Ordreliste.php';    $DocVer='5.0.0';    $DocRev='2018-09-20';     $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Kreditorer og kreditor ordrer';
 * Denne fil er oprettet af EV-soft i 2017.
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2018 Saldi.dk ApS      *** Se filen: ../LICENS_Copyright.txt
 *
 *
 * 
  Oprettet: 2016-08-00 evs - EV-soft
  Ændrings-Log:
      
 *
 */
 
  $pageTitl='Købs ordrer';
  $GLOBALS["ØProgModu"]= ['prim']; ## prim eller/og sekd og comm
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
  DocAlder($DocRev);
    
    #Panl_Blindgyde(); 
    # Head_Navigation(tolk('@Leverandører'), $status=tolk('@ '), $goPrev=true, $goHome=true, $goUp=false, $goFind=true, $goNew=true, $goNext=true);  
    Panl_Kreditorer();  # Demo!
    Panl_KredOrdrer();
    Wall_LevBestilling();
    PanelInitier(2,9);
//    Panl_FootMenu();


  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?> 