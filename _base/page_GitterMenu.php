<?php   $DocFil= '../_base/page_GitterMenu.php';    $DocVer='5.0.0';    $DocRev='2016-10-00';   $ModulNr=2;
//  SALDI's hovedmenu                                        
//             ___   _   _    ___  _         
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___)
//                                           
// LICENS & Copyright (c) 2004-2016 DANOSOFT ApS *** Se filen: ../LICENS_Copyright.txt
//

  global $debug;
  $debug= true;
  $pageTitl='Hovedmenu';
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'Hovedmenu');
    
    vindue_GitterMenu();
    
//  Til sidst indlæses java-scripter:   
  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>