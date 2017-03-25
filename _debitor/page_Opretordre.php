<?php      $DocFil= '../_debitor/page_Opretordre.php';   $DocVer='5.0.0';     $DocRev='2017-03-00';      $modulnr=5;
// Formål:  Registrer en ny debitor ordre.
//             ___   _   _    ___  _
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___|
//
// LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
//
// 2016.08.00 ev - EV-soft

$pageTitl='Opret ny ordre';
include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
### INDLÆS DATA:

$TablData= array();

### VIS DATA:

  SpalteTop(960);   
  # Head_Navigation(tolk('@Kunder'), $status=tolk('@ '), $goPrev=true, $goHome=true, $goUp=false, $goFind=true, $goNew=true, $goNext=true);  
  Rude_Opretordre($TablData);  # Demo! array(['Ordrenr.','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],... []); "ordrenr,ordredate,levdate,kontonr,firmanavn,ref,sum"
//  Rude_YdelserTabl($Ordnr='1025',$data,$fakt=false);
//  Rude_FootMenu();
  SpalteBund();
  
### GEM DATA:

  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  