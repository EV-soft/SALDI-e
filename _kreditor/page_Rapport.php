<?php      $DocFil= '../_kreditor/page_Rapport.php';    $DocVer='5.0.0';     $DocRev='2016-11-00';
// Formål:  Se rapport
//             ___   _   _    ___  _
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___|
//
// 2016.08.00 ev - EV-soft
//

  $pageTitl='Rapport';
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
    
    SpalteTop(480);   Rude_KredRapp();
#   NextSpalte();     Rude_Kontrolspor();
    EndSpalter();
#   Rude_Kontrolspor();
    

  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  