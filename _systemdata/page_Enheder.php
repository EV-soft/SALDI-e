<?php      $DocFil= '../_systemdata/page_Enheder.php';   $DocVer='5.0.0';     $DocRev='2016-10-00';
// Formål:  Kald til ufærdigt link
//             ___   _   _    ___  _
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___|
//
// 2016.08.00 ev - EV-soft
//

  $pageTitl='Enheder';
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
    
    SpalteTop(240);   Rude_AdminMenu();
    NextSpalte();     Rude_Enheder();
 
  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  