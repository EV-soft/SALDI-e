<?php      $DocFil= '../_kreditor/page_Rapport-kred.php';    $DocVer='5.0.0';    $DocRev='2018-09-20';     $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Se rapport';
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

  $pageTitl='Kreditor Rapport';
  $GLOBALS["ØProgModu"]= ['prim']; ## prim eller/og sekd og comm
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
    
### INDLÆS DATA:

### VIS DATA:
    SpalteTop(320);   Panl_KredRapp();
    NextSpalte();
    switch ($Øjob) {  //  Parameter i URL dannes i htm_pagePrepare
      case 'openpost' : Panl_KredOpenPost();    break;
      case 'ktsaldo'  : Panl_KredKontoListe();  break;
      case 'ktkort'   : Panl_KredKontoKort();   break;
      case 'kobstat'  : Panl_KredKoebsStat();   break;
      default         : Panl_Rapportliste();  
    }
    SpalteBund();
    //  PanelInitier(3,4);
    
### GEM DATA:
    

  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>  