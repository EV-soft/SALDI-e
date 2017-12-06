<?php   $DocFil= '../_kreditor/page_Ordreliste.php';    $DocVer='5.0.0';    $DocRev='2017-11-00';   $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Kreditorer og kreditor ordrer';
 * Denne fil er oprettet af EV-soft i 2017.
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS      *** Se filen: ../LICENS_Copyright.txt
 *
 * Grundlæggende initiering.
 *
 * 2016.08.00 evs - EV-soft
 *
 */
 
  $pageTitl='Købs ordrer';
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
    
    #Rude_Blindgyde(); 
    # Head_Navigation(tolk('@Leverandører'), $status=tolk('@ '), $goPrev=true, $goHome=true, $goUp=false, $goFind=true, $goNew=true, $goNext=true);  
    Rude_Kreditorer();  # Demo!
    Rude_KredOrdrer();
    Rude_LevBestilling();
//    Rude_FootMenu();

  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?> 