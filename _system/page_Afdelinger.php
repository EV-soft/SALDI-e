<?php   $DocFil= '../_systemdata/page_Afdelinger.php';    $DocVer='5.0.0';    $DocRev='2017-02-00';   $ModulNr=2;
// Form�l: Redigering af Afdelinger                                       
//             ___   _   _    ___  _         
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___)
//                                           
// LICENS & Copyright (c) 2004-2016 DANOSOFT ApS *** Se filen: ../LICENS_Copyright.txt
//

  $pageTitl='Indstil: Afdelinger';
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
  if ($GLOBALS["�debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'Afdelinger');
### INDL�S DATA:

### VIS DATA:
    SpalteTop(240); Rude_AdminMenu();
    NextSpalte();   Rude_Afdelinger($Nr, $Beskrivelse, $Afd);
    SpalteBund();
### GEM DATA:
 
  
//  Til sidst indl�ses java-scripter:   
  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>