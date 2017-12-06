<?php   $DocFil= '../_finans/page_Regnskab.php';    $DocVer='5.0.0';    $DocRev='2017-11-00';   $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Vis Regnskab';
 * Denne fil er oprettet af EV-soft i 2017.
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 * 2016.08.00 evs - EV-soft
 *
 */
 
  $pageTitl= 'Regnskab';  # tolk('Regnskab');
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
  include("../_base/str_func.php");
	
  $TablData= ImportTabFile('../_exchange/kontoplan-extra.tab');  // Indlæs data fra TAB-fil
  
  if (!$printLayout)
    {}  # Head_Navigation($pageTitl, $status=tolk('@ '), $goPrev=true, $goHome=true, $goUp=false, $goFind=true, $goNew=true, $goNext=true);
  else {$ØRollTabl= false;}
  Rude_Regnskab($regnskab='CSS-demo', $maanedantal=12, $startaar=2017, $startmaaned=1, $periode_dag=1, $periode_laengde="regnskabsmaaned", $regnskabsaar='2017', $TablData);
  if (!$printLayout)
//    Rude_FootMenu();
    
  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  