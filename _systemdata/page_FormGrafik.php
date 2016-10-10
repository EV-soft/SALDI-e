<?php      $DocFil= '../_systemdata/page_Formgrafik.php';    $DocVer='5.0.0';     $DocRev='2016-10-00';
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

if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'Hovedmenu');

  $pageTitl='Brugerdata';
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
    
    SmallSpalte();  Rude_Formularer();
    NextSpalte();   Rude_FormRedigerGrafik();

  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  