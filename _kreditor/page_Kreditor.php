<?php      $DocFil= '../_kreditor/page_Kreditor.php';   $DocVer='5.0.0';    $DocRev='2018-03-00';     $DocIni='evs';  $ModulNr=5;
// Formål:  Kald til ufærdigt link
//             ___   _   _    ___  _
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___|
//
// LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
//
// 2016.08.00 ev - EV-soft

if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'');

  $pageTitl='Kreditorer ordrer';
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode

  # Head_Navigation(tolk('@Kreditor'), $status=tolk('@ '), $goPrev=true, $goHome=true, $goUp=false, $goFind=true, $goNew=true, $goNext=true);  
  Rude_Kreditorer();  # Demo!
  skilleLin();
  $kontonr= ''; $kategori= ''; $cvrnr= ''; $eannr= ''; $bankreg= ''; $bankkto= ''; $instit= ''; $ansv= ''; $formsprog= ''; $homeweb= '';
  Rude_KreditorKort($kontonr, $kategori, $cvrnr, $eannr, $bankreg, $bankkto, $instit, $ansv, $formsprog, $homeweb);
//  Rude_FootMenu();
  
  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>  