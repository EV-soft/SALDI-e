<?php      $DocFil= '../_kreditor/page_Kreditor.php';   $DocVer='5.0.0';    $DocRev='2018-09-20';     $DocIni='evs';  $ModulNr=5;
/* ## Purpose: 'Vis Kreditorer og ordrer';
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 * 2016.08.00 evs - EV-soft
 *
 */

if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'');

  $pageTitl='Kreditorer ordrer';
  $GLOBALS["ØProgModu"]= ['prim']; ## prim eller/og sekd og comm
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
  DocAlder($DocRev);
  
  # Head_Navigation(tolk('@Kreditor'), $status=tolk('@ '), $goPrev=true, $goHome=true, $goUp=false, $goFind=true, $goNew=true, $goNext=true);  
  Panl_Kreditorer();  # Demo!
  skilleLin();
  $kontonr= ''; $kategori= ''; $cvrnr= ''; $eannr= ''; $bankreg= ''; $bankkto= ''; $instit= ''; $ansv= ''; $formsprog= ''; $homeweb= '';
  Wall_KreditorKort($kontonr, $kategori, $cvrnr, $eannr, $bankreg, $bankkto, $instit, $ansv, $formsprog, $homeweb);
  PanelInitier(2,9);  PanelMax(2);  PanelMax(4);
  
  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>  