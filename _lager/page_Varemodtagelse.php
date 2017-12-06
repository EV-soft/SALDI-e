<?php   $DocFil= '../_lager/page_Varemodtagelse.php';   $DocVer='5.0.0';    $DocRev='2016-11-00';   $modulnr=0; 
/* ## Formål: Vare modtagelse
 *             ___   _   _    ___  _
 *            / __| /_\ | |  |   \| |   ___ 
 *            \__ \/ _ \| |__| |) | |__/ -_)
 *            |___/_/ \_|____|___/|_|  \___|
 *
 * 2016.11.00 ev - EV-soft
 *
 */
  $pageTitl='Vare modtagelse';
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
    
### INDLÆS DATA:


### VIS DATA:
    
 #   Head_Navigation(tolk('@ '), $status='', $goPrev=true, $goHome=true, $goUp=false, $goFind=true, $goNew=true, $goNext=true);  
 #   Rude_Varer();  # Demo!
 #   Rude_FootMenu();
 #   Rude_Varekort();  # Demo!
  SpalteTop(960);   
//  Head_Navigation($pageTitl, $status=tolk('@ '), $goPrev=true, $goHome=true, $goUp=false, $goFind=true, $goNew=true, $goNext=true);  
  Rude_Varemodtagelse();
//  Rude_FootMenu();
  SpalteBund();
### GEM DATA:

   
  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  