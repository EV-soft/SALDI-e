<?php      $DocFil= '../_debitor/page_Rapport-deb.php';    $DocVer='5.0.0';    $DocRev='2018-09-20';     $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Se debitor rapporter';
 *             ___   _   _    ___  _         
 *            / __| / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            |___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 * 2016.08.00 evs - EV-soft
 *
 */
 
  $pageTitl='Debitor Rapport';
  $GLOBALS["ØProgModu"]= ['prim']; ## prim eller/og sekd og comm
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
### INDLÆS DATA:

### VIS DATA:
    SpalteTop(320);   Panl_DebRapp();
    NextSpalte(640);
    switch ($Øjob) {  //  Parameter i URL dannes i htm_pagePrepare
      case 'openpost' : Panl_DebtOpenPost();    break;
      case 'ktsaldo'  : Panl_DebtKontoliste();  break;
      case 'ktkort'   : Panl_DebtKontoKort();   break;
      case 'slgstat'  : Panl_DebtSalgsstat();   break;
      case 'top100'   : Panl_DebtTop100();      break;
      case 'ksspor'   : Panl_DebtKassespor();   break;
      default         : Panl_Rapportliste();  
    }
    SpalteBund();
    //  PanelInitier(3,4);
    
### GEM DATA:
    

  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>  