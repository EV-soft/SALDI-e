<?php   $DocFil= '../_systemdata/page_Rabatgrupper.php';    $DocVer='5.0.0';    $DocRev='2016-12-00';   $ModulNr=2;
// Formål: Redigering af Rabatgrupper                                       
//             ___   _   _    ___  _         
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___)
//                                           
// LICENS & Copyright (c) 2004-2016 DANOSOFT ApS *** Se filen: ../LICENS_Copyright.txt
//

  global $Ødebug;
  $Ødebug= true;
  $pageTitl='Rabatgrupper';
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
  if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'Rabatgrupper');
    
    SpalteTop(240); Rude_AdminMenu();
    NextSpalte();   Rude_Rabatgrupper();
    EndSpalter();
  
//  Til sidst indlæses java-scripter:   
  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>