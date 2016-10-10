<?php      $DocFil= '../_systemdata/page_Regnskabskort.php';    $DocVer='5.0.0';     $DocRev='2016-08-00';
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

if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'');

  @session_start(); $s_id=session_id();

  $laast=NULL;
  $modulnr=2;
  $pageTitl='Regnskabskort';
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
    
    Rude_Blindgyde(); 

  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  