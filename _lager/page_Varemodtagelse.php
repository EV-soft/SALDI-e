<?php   $DocFil= '../_lager/page_Varemodtagelse.php';   $DocVer='5.0.0';    $DocRev='2018-09-20';     $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Vare modtagelse';
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 * 2016.11.00 evs - EV-soft
 *
 */

  $pageTitl='Vare modtagelse';
  $GLOBALS["ØProgModu"]= ['prim']; ## prim eller/og sekd og comm
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
    
### INDLÆS DATA:


### VIS DATA:
    
 #   Head_Navigation(tolk('@ '), $status='', $goPrev=true, $goHome=true, $goUp=false, $goFind=true, $goNew=true, $goNext=true);  
 #   Panl_Varer();  # Demo!
 #   Panl_FootMenu();
 #   Panl_Varekort();  # Demo!
  SpalteTop(960);   
//  Head_Navigation($pageTitl, $status=tolk('@ '), $goPrev=true, $goHome=true, $goUp=false, $goFind=true, $goNew=true, $goNext=true);  
  Panl_Varemodtagelse();
//  Panl_FootMenu();
  SpalteBund();
  PanelInitier(2,3);
### GEM DATA:

   
  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>  