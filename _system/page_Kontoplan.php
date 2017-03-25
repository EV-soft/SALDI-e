<?php      $DocFil= '../_systemdata/page_Kontoplan.php';    $DocVer='5.0.0';     $DocRev='2017-02-00';
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
    
### INDLÆS DATA:
    $TablData= ImportTabFile('../_exchange/kontoplan.tab');  // Indlæs kontoplan fra TAB-fil

### VIS DATA:
    if ($printLayout) {$ØRollTabl= false;}
    SpalteTop(640);   Rude_Kontoplan($TablData);
    
    $data= array(['2001','VAREFORBRUG','D','K1','','DKK',0.00,'G',true]);  // Demo
    if (!$printLayout)
      {NextSpalte();     Rude_KontoKort($data);}
    SpalteBund();
    
### GEM DATA:

  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  