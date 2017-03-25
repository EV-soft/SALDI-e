<?php      $DocFil= '../_lager/page_Varer.php';   $DocVer='5.0.0';     $DocRev='2016-08-00';     $modulnr=0; 
// Formål:  Kald til ufærdigt link
//             ___   _   _    ___  _
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___|
//
// 2016.08.00 ev - EV-soft
//

  $pageTitl='Lager varer';
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
    
    # Head_Navigation(tolk('@ '), $status='', $goPrev=true, $goHome=true, $goUp=false, $goFind=true, $goNew=true, $goNext=true);  
    Rude_Varer();  # Demo!
    Rude_FootMenu();
    skilleLin();
    Rude_Varekort();  # Demo!
    
  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  