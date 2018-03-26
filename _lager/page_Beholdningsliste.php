<?php   $DocFil= '../_lager/page_Beholdningsliste.php';   $DocVer='5.0.0';    $DocRev='2018-03-00';     $DocIni='evs';  $ModulNr=0;
/* ## Formål:  Rapporter Beholdningsliste
 *             ___   _   _    ___  _
 *            / __| /_\ | |  |   \| |   ___ 
 *            \__ \/ _ \| |__| |) | |__/ -_)
 *            |___/_/ \_|____|___/|_|  \___|
 *
 */
  $pageTitl='Beholdning';
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
    
### INDLÆS DATA:


### VIS DATA:
    SpalteTop(320);   Rude_Beholdningsrapp();
    NextSpalte(640);  Rude_Beholdningsliste();  
    SpalteBund();
    
### GEM DATA:


  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>  