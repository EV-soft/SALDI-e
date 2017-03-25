<?php   $DocFil= '../_systemdata/page_Ordrerelat.php';    $DocVer='5.0.0';    $DocRev='2017-01-00';   $ModulNr=2;
// Formål: Redigering af Ordrerelat                                       
//             ___   _   _    ___  _         
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___)
//                                           
// LICENS & Copyright (c) 2004-2017 DANOSOFT ApS *** Se filen: ../LICENS_Copyright.txt
//

  $pageTitl='Ordrerelat';
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
  if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
    SpalteTop(240); Rude_DiverseMenu();
    NextSpalte();   Rude_Ordrerelat(xx);
    EndSpalter();
    
  
//  Til sidst indlæses java-scripter:   
  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>