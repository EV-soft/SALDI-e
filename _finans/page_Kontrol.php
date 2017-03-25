<?php      $DocFil= '../_finans/page_Kontrol.php';    $DocVer='5.0.0';     $DocRev='2017-03-00';
// Formål:  Se finans rapport
//             ___   _   _    ___  _
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___|
//
// 2016.08.00 ev - EV-soft
//

  $pageTitl= 'Kontrol spor';  # tolk('Rapport');
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
### INDLÆS DATA:
  $Data=  array( ['1',''], );

### VIS DATA:
  # Head_Navigation($pageTitl, $status=tolk('@ '), $goPrev=true, $goHome=true, $goUp=false, $goFind=true, $goNew=true, $goNext=true);  
  # SpalteTop(480);   Rude_RapportFinans();
  # NextSpalte();     Rude_Rapportliste();  
  # SpalteBund();
  # SpalteTop(960);   
  Rude_Kontrolspor($Data);
  # SpalteBund();
  # Rude_FootMenu();
    
### GEM DATA:
    

  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  