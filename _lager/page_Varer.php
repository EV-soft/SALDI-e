<?php   $DocFil= '../_lager/page_Varer.php';    $DocVer='5.0.0';    $DocRev='2017-11-00';   $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Vis varelister og varekort';
 * Denne fil er oprettet af EV-soft i 2017.
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
<?php      $DocFil= '../_lager/page_Varer.php';   $DocVer='5.0.0';     $DocRev='2016-08-00';     $modulnr=0; 
 * 2016.08.00 ev - EV-soft
 */

  $pageTitl='Lager varer';
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
    
    # Head_Navigation(tolk('@ '), $status='', $goPrev=true, $goHome=true, $goUp=false, $goFind=true, $goNew=true, $goNext=true);  
    Rude_Varer();  # Demo!
//    Rude_FootMenu();
    skilleLin();
    Rude_Varekort();  # Demo!
    htm_nl();
    echo '</div></div></div>';  // Problem: ubalance i Rude_Varekort?
    
  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  