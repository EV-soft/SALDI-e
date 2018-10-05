<?php   $DocFil= '../_system/page_KontoplanPrint.php';    $DocVer='5.0.0';    $DocRev='2018-09-20';   $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Vis/print Kontoplan';
 * Denne fil er oprettet af EV-soft i 2018.
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2018 Saldi.dk ApS      *** Se filen: ../LICENS_Copyright.txt
 *
 */

  global $pageTitl;
  $pageTitl='Udskrift Kontoplan';
  $GLOBALS["ØProgModu"]= ['prim']; ## prim eller/og sekd og comm
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
  if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
    
### INDLÆS DATA:
    //$TablData= ImportTabFile('../_exchange/kontoplan.tab');  // Indlæs kontoplan fra TAB-fil
    /* $TablData= array(
    ['10','RESULTATOPGØRELSE','H','','0','100','0','G ','Aktiv'],
    ['100','OMSÆTNING:','H','','0','100','0',' ','Aktiv'],
    ['1000','Udført arbejde','D','S1','0','100','0','U','Aktiv'],
    ['1100','Varesalg DK','D','S1','0','100','0','S','Aktiv'],
    ['1200','Salg af ydelser indenfor EU','D','','0','100','0','Y','Aktiv'],
    ['1220','Salg af varer indenfor EU','D','','0','100','0','G','Aktiv'],
    ['1250','Salg af ydelser udenfor EU','D','','0','100','0','G','Aktiv'],
    ['1270','Salg af varer udenfor EU','D','','0','100','0','G','Aktiv'],
    ['1290','Salg af varer og ydelser udenfor EU','Z','','1250','100','0','G','Aktiv'],
    ['1300','Fragt ydet','D','S1','0','100','0','F','Aktiv']); */
                     
    //$TablData= ImportTabFile('../_exchange/kontoplan.csv');  // Indlæs kontoplan fra TAB-fil - Nyt format
    //file_put_contents('../_exchange/kontoplan.json',json_encode($TablData));
    $TablData = json_decode(file_get_contents('../_exchange/kontoplan.json'), true);

### VIS DATA:
    Panl_KontoplanPrint($TablData);
    
  
### GEM DATA:

  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>  