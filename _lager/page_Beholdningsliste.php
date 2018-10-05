<?php   $DocFil= '../_lager/page_Beholdningsliste.php';   $DocVer='5.0.0';    $DocRev='2018-09-20';     $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Rapporter Beholdningsliste';
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * ## LICENS & Copyright (c) 2004-2018 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
  Oprettet: 2018-09-09 evs - EV-soft
  Ændrings-Log:
    
 *    
 */
  $pageTitl='Beholdning';
  $GLOBALS["ØProgModu"]= ['prim']; ## prim eller/og sekd og comm
  //var_dump($GLOBALS["ØProgModu"]);
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
    
### INDLÆS DATA:


### VIS DATA:
    SpalteTop(320);   Panl_Beholdningsrapp();
    NextSpalte(640);  Panl_Beholdningsliste();  
    SpalteBund();
    PanelInitier(2,9);
    
### GEM DATA:


  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>  