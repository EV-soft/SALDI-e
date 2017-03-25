<?php      $DocFil= '../_systemdata/page_Regnskabsaar.php';   $DocVer='5.0.0';     $DocRev='2017-01-00';
// Formål:  Kald til ufærdigt link
//             ___   _   _    ___  _
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___|
//
// 2016.08.00 ev - EV-soft
//

  $pageTitl='Regnskabsår';
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
    
    $TablData= array(['1','2015','01','2015','12','2015','Lukket'],['2','2016','01','2016','12','2016','<div style="color:red">Aktivt</div>']);  // Demo
    $DATA= MakeStatusKonti();
            
    SpalteTop(320); Rude_AdminMenu(); 
    NextSpalte();   Rude_Regnskabsaar($TablData);    
                    Rude_Regnskabskort($DATA);
    EndSpalter();  
    
  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  