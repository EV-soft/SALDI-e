<?php      $DocFil= '../_debitor/page_Rapport.php';    $DocVer='5.0.0';     $DocRev='2016-11-00';
// Formål:  Se finans rapport
//             ___   _   _    ___  _
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___|
//
// 2016.08.00 ev - EV-soft
//

  $pageTitl='Rapport';
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
    
    SpalteTop(480);   Rude_DebRapp();
    EndSpalter();
    

  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  