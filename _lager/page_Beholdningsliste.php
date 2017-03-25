<?php   $DocFil= '../_lager/page_Beholdningsliste.php';   $DocVer='5.0.0';    $DocRev='2017-02-00';
/* ## Formål:  Rapporter Beholdningsliste
 *             ___   _   _    ___  _
 *            / __| /_\ | |  |   \| |   ___ 
 *            \__ \/ _ \| |__| |) | |__/ -_)
 *            |___/_/ \_|____|___/|_|  \___|
 *
 */
  $pageTitl='Beholdning';
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
    
### INDLÆS DATA:


### VIS DATA:
    SpalteTop(320);   Rude_Beholdningsrapp();
    NextSpalte();     Rude_Beholdningsliste();  
    SpalteBund();
    
### GEM DATA:


  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  