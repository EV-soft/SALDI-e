<?php      $DocFil= '../_systemdata/page_Regnskabsaar.php';   $DocVer='5.0.0';     $DocRev='2017-02-00';
// Formål:  Kald til ufærdigt link
//             ___   _   _    ___  _
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___|
//
// 2016.08.00 ev - EV-soft
//

  $pageTitl='Indstil: Regnskabsår';
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
    
    $TablData= array(['1','2015','01','2015','12','2015','Lukket'],
                     ['2','2016','01','2016','12','2016','Lukket'],
                     ['3','2017','01','2017','12','2017','<div style="color:red">Aktivt</div>'],
                     );  // Demo
    $DATA= MakeStatusKonti();
### INDLÆS DATA:

### VIS DATA:
    SpalteTop(320); Rude_AdminMenu(); 
    NextSpalte();   Rude_Regnskabsaar($TablData);    
                    Rude_Regnskabskort($DATA);
    SpalteBund();  
### GEM DATA:
 
  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  