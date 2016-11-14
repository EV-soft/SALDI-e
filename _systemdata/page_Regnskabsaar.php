<?php      $DocFil= '../_systemdata/page_Regnskabsaar.php';   $DocVer='5.0.0';     $DocRev='2016-08-00';
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
    
    SpalteTop(320); Rude_AdminMenu(); 
    NextSpalte();   Rude_Regnskabsaar();    Rude_Regnskabskort();
    EndSpalter();  
    
  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  