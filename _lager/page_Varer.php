<?php   $DocFil= '../_lager/page_Varer.php';    $DocVer='5.0.0';    $DocRev='2018-03-00';     $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Vis varelister og varekort';
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2018 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
  Oprettet: 2016-08-00 evs - EV-soft
  Ændrings-Log:
      
 * 
 */

  $pageTitl='Lager varer';
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
    
  $DATA= sql_readA($qstr='SELECT varenr, enhed, beskrivelse, FORMAT(kostpris,2), FORMAT(salgspris,2), retail_price, notes, gruppe, beholdning, location '.
                                   'FROM tblA_product ',__FILE__, __LINE__);
              # Head_Navigation(tolk('@ '), $status='', $goPrev=true, $goHome=true, $goUp=false, $goFind=true, $goNew=true, $goNext=true);  
    Rude_Varer($DATA);  # Demo!
//    Rude_FootMenu();
    skilleLin();
    Rude_Varekort();  # Demo!
    htm_nl();
    echo '</div></div></div>';  // Problem: ubalance i Rude_Varekort?
    
  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>  