<?php   $DocFil= '../_systemdata/page_Kontoindstill.php';    $DocVer='5.0.0';    $DocRev='2017-02-00';   $ModulNr=2;
// Form�l: Redigering af Kontoindstilling                                       
//             ___   _   _    ___  _         
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___)
//                                           
// LICENS & Copyright (c) 2004-2017 DANOSOFT ApS *** Se filen: ../LICENS_Copyright.txt
//

  $pageTitl='Indstil mere: Kontoindstilling';
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
  if ($GLOBALS["�debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
### INDL�S DATA:

### VIS DATA:
    SpalteTop(240); Rude_DiverseMenu();
    NextSpalte();   Rude_Kontoindstilling($regnskabnavn, $servport, $usernavn, $usercode, $protokol);
    SpalteBund();
    
### GEM DATA:
 
  
//  Til sidst indl�ses java-scripter:   
  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>