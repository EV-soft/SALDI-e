<?php      $DocFil= '../_debitor/page_Opretordre.php';   $DocVer='5.0.0';    $DocRev='2018-09-20';   $DocIni='evs';  $ModulNr=5;
/* ## Purpose: 'Registrer en ny debitor ordre.';
 *             ___   _   _    ___  _         
 *            / __| / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            |___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2018 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
   Oprettet: 2016-08-00 evs - EV-soft
  Ændrings-Log:
      
 *
 */

$pageTitl='Opret ny ordre';
$GLOBALS["ØProgModu"]= ['prim']; ## prim eller/og sekd og comm
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
### INDLÆS DATA:

$TablData= array();

### VIS DATA:
  SpalteTop(1100);   
  Wall_Opretordre($TablData);  # Demo! array(['Ordrenr.','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],... []); "ordrenr,ordredate,levdate,kontonr,firmanavn,ref,sum"
  NextSpalte(720);
  //  Panl_YdelserTabl($Ordnr='1025',$TablData,$fakt=false,'Tabel-baseret visning af ordrens omfang.');
  SpalteBund();
  //PanelInitier(3,9);
  
### GEM DATA:

  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>  