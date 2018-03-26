<?php      $DocFil= '../_finans/page_Kontrol.php';    $DocVer='5.0.0';    $DocRev='2018-03-00';     $DocIni='evs';  $ModulNr=0;
/* Formål:  Sporing af beløbs oprindelse
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
 
  $pageTitl= 'Kontrol spor';  # tolk('Rapport');
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
### INDLÆS DATA:
  $Data=  array( ['1',''], );

### VIS DATA:
  # Head_Navigation($pageTitl, $status=tolk('@ '), $goPrev=true, $goHome=true, $goUp=false, $goFind=true, $goNew=true, $goNext=true);  
  # SpalteTop(480);   Rude_RapportFinans();
  # NextSpalte();     Rude_Rapportliste();  
  # SpalteBund();
  # SpalteTop(960);   
  Rude_Kontrolspor($Data);
  # SpalteBund();
  # Rude_FootMenu();
    
### GEM DATA:
    

  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>  