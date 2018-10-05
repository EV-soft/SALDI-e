<?php $DocFil= '../_finans/page_Rapport-fin.php'; $DocVer='5.0.0';    $DocRev='2018-09-20';     $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Se finans rapport';
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
 
  $pageTitl= 'Rapport';
  $GLOBALS["ØProgModu"]= ['prim']; ## prim eller/og sekd og comm
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
### INDLÆS DATA:
  $Data=  array( ['1',''], );

### VIS DATA:
  # Head_Navigation($pageTitl, $status=tolk('@ '), $goPrev=true, $goHome=true, $goUp=false, $goFind=true, $goNew=true, $goNext=true);  
  SpalteTop(320);             Panl_RapportFinans();
  NextSpalte(720);
      switch ($Øjob) {  //  Parameter i URL dannes i htm_pagePrepare
      case 'kontokort'      : Panl_RapportKontokort();      break;
      case 'kontokort_moms' : Panl_RapportKontokortMm();    break;
      case 'balance'        : Panl_RapportBalance();        break; //  $regnaar, $afdeling, $rapptype, $ListFra, $ListTil
      case 'resultatb'      : Panl_RapportResultatBudget(); break;
      case 'resultat'       : Panl_RapportResultat();       break;
      case 'budget'         : Panl_RapportBudget();         break;
      case 'momsangivelse'  : Panl_RapportMomsangivelse();  break;
      case 'periodeliste'   : Panl_RapportPeriodeliste();   break;
      default               : Panl_Rapportliste();
    }
  SpalteBund();
  //PanelInitier(2,3);
  
    
### GEM DATA:
    

  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>  