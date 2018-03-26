<?php   $DocFil= '../_system/page_Kontoplan.php';    $DocVer='5.0.0';    $DocRev='2018-03-00';   $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Rediger Kontoplan';
 * Denne fil er oprettet af EV-soft i 2017.
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS      *** Se filen: ../LICENS_Copyright.txt
 *
 */

  global $pageTitl;
  $pageTitl='Kontoplan';
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
    
### INDLÆS DATA:
    $TablData= ImportTabFile('../_exchange/kontoplan.tab');  // Indlæs kontoplan fra TAB-fil
    $kortdata= array(['2001','VAREFORBRUG','D','K1','','DKK',0.00,'G',true]);  // Demo
    

### VIS DATA:
    if ($printLayout) {$ØRollTabl= false;}
    SpalteTop(960);     Rude_Kontoplan($TablData);
    
    if (!$printLayout)
    {NextSpalte(960);   Rude_KontoKort($kortdata);}
    SpalteBund();
    
### GEM DATA:

  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>  