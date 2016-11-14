<?php      $DocFil= '../_kreditor/page_Ordreliste.php';   $DocVer='5.0.0';     $DocRev='2016-08-00';
// Formål:  Kald til ufærdigt link
//             ___   _   _    ___  _
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___|
//
// LICENS & Copyright (c) 2004-2016 DANOSOFT ApS *** Se filen: ../LICENS_Copyright.txt
//
// 2016.08.00 ev - EV-soft
//

  $pageTitl='Købs ordrer';
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
    
    #Rude_Blindgyde(); 
    Head_Navigation(tolk('@Leverandører'), $status=tolk('@ '), $goPrev=true, $goHome=true, $goUp=false, $goFind=true, $goNew=true, $goNext=true);  
    Rude_Kreditorer();  # Demo!
    Rude_FootMenu();

  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?> 