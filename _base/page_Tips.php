<?php      $DocFil= '../_base/page_tips.php';    $DocVer='5.0.0';     $DocRev='2017-06-00';
/* FORMÅL:  Omtale af program nyheder
 *             ___   _   _    ___  _         
 *            / __| / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            |___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 */

  $pageTitl='Bruger tips';
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
### INDLÆS DATA:

### VIS DATA:
    SpalteTop(480);   Rude_TipsBrug();   
    NextSpalte();     Rude_TipsBogh();
    SpalteBund();
    
### GEM DATA:
    

  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  