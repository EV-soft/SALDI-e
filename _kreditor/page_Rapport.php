<?php      $DocFil= '../_kreditor/page_Rapport.php';    $DocVer='5.0.0';    $DocRev='2018-03-00';     $DocIni='evs';  $ModulNr=0;
// Formål:  Se rapport
//             ___   _   _    ___  _
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___|
//
// 2016.08.00 ev - EV-soft
//

  $pageTitl='Kreditor Rapport';
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
    
### INDLÆS DATA:

### VIS DATA:
    SpalteTop(320);   Rude_KredRapp();
    NextSpalte();     Rude_Rapportliste();  
    SpalteBund();
    
### GEM DATA:
    

  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>  