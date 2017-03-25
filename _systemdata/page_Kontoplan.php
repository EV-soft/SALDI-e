<?php      $DocFil= '../_systemdata/page_Kontoplan.php';    $DocVer='5.0.0';     $DocRev='2016-08-00';
// Formål:  Rediger Kontoplan
//             ___   _   _    ___  _
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___|
//
// 2016.08.00 ev - EV-soft
//

  $pageTitl='Kontoplan';
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
    
    $TablData= ImportTabFile('../_export-import/kontoplan.tab');  // Indlæs kontoplan fra TAB-fil
    SpalteTop(640);   Rude_Kontoplan($TablData);
    
    $data= array(['2001','VAREFORBRUG','D','K1','DKK',0.00,'G',true]);  // Demo
    NextSpalte();     Rude_KontoKort($data);
    EndSpalter();
    

  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  