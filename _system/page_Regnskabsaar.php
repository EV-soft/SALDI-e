<?php      $DocFil= '../_system/page_Regnskabsaar.php';   $DocVer='5.0.0';    $DocRev='2018-09-20';   $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Redigering af Regnskabsaar';
 * Denne fil er oprettet af EV-soft i 2017.
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 */

  $pageTitl='Indstil: Regnskabsår';
  $GLOBALS["ØProgModu"]= ['sekd']; ## prim eller/og sekd og comm
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
  DocAlder($DocRev);
    
    $TablData= array(['1','2015','01','2015','12','2015','Lukket'],
                     ['2','2016','01','2016','12','2016','Lukket'],
                     ['3','2017','01','2017','12','2017','<div style="color:red">Aktivt</div>'],
                     ['4','2018','01','2018','12','2018',''],
                     );  // Demo
    $DATA= MakeStatusKonti();
### INDLÆS DATA:

### VIS DATA:
    SpalteTop(320);   Panl_AdminMenu(); 
    NextSpalte(720);  Panl_Regnskabsaar($TablData);    
                      Panl_Regnskabskort($DATA, $besk='2016', $aar0='2016', $md0='01', $aar1='2016', $md1='12', $aktiv=true, $fak1Nr);
    SpalteBund();  
    PanelInitier(3,7);
### GEM DATA:
 
  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>  