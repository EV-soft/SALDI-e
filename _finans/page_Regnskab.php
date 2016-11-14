<?php      $DocFil= '../_finans/page_Regnskab.php';   $DocVer='5.0.0';     $DocRev='2016-10-00';
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
  include("../includes/finansfunk.php");
	
  Head_Navigation($pageTitl, $status=tolk('@ '), $goPrev=true, $goHome=true, $goUp=false, $goFind=true, $goNew=true, $goNext=true);  
  Rude_Regnskab();
  Rude_FootMenu();
    
  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  