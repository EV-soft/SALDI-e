<?php      $DocFil= '../_finans/page_Regnskab.php';   $DocVer='5.0.0';     $DocRev='2017-03-00';
// Formål:  
//             ___   _   _    ___  _
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___|
//
// 2016.08.00 ev - EV-soft
//

  $pageTitl= 'Regnskab';  # tolk('Regnskab');
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
  include("../_base/str_func.php");
	
  $TablData= ImportTabFile('../_exchange/kontoplan-extra.tab');  // Indlæs data fra TAB-fil
  
  if (!$printLayout)
    {}  # Head_Navigation($pageTitl, $status=tolk('@ '), $goPrev=true, $goHome=true, $goUp=false, $goFind=true, $goNew=true, $goNext=true);
  else {$ØRollTabl= false;}
  Rude_Regnskab($regnskab='CSS-demo', $maanedantal=12, $startaar=2017, $startmaaned=1, $periode_dag=1, $periode_laengde="regnskabsmaaned", $regnskabsaar='2017', $TablData);
  if (!$printLayout)
    Rude_FootMenu();
    
  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  