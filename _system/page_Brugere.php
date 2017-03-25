<?php      $DocFil= '../_systemdata/page_Brugerdata.php';    $DocVer='5.0.0';     $DocRev='2016-12-00';
// Formål:  Administration af Bruger rettigheder
//             ___   _   _    ___  _
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___|
//
// LICENS & Copyright (c) 2004-2016 DANOSOFT ApS *** Se filen: ../LICENS_Copyright.txt
//
// 2016.12.00 ev - EV-soft
//

if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'Brugerdata');

  $pageTitl='Brugerdata';
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
    
### INDLÆS DATA:

### VIS DATA:
    SpalteTop(240);   Rude_AdminMenu();
    NextSpalte();     Rude_Brugere();
    SpalteBund();
    
### GEM DATA:
    
  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  