<?php      $DocFil= '../_base/page_News.php';    $DocVer='5.0.0';     $DocRev='2017-02-00';
// Formål:  Omtale af program nyheder
//             ___   _   _    ___  _
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___|
//
// 2016-08-00 ev - EV-soft
//

  $pageTitl='Nyheder';
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
### INDLÆS DATA:

### VIS DATA:
    SpalteTop(640);   Rude_News();
    SpalteBund();
    
### GEM DATA:
    

  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  