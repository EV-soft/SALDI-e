<?php   $DocFil= '../_system/page_Divsetup2.php';    $DocVer='5.0.0';    $DocRev='2018-09-20';   $DocIni='evs';  $ModulNr=0;
/* ## Purpose: '2. Indstilling af regnskabskonto';
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 */
#  global $debug;  $debug= true;
  $pageTitl='Diverse indstillings menu';
  $GLOBALS["ØProgModu"]= ['sekd']; ## prim eller/og sekd og comm
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$ModulNr,$DocFil,$pageTitl);
    
### INDLÆS DATA:
    #Demo:
    if (!$regnskabnavn) {
      $regnskabnavn='CSS-demo';   $servport= '';    $usernavn= '';    $usercode= '********';    $protokol= 'tls';
    }

### VIS DATA:
    SpalteTop(240);    Panl_DiverseMenu();
    NextSpalte();      Panl_Kontoindstilling($regnskabnavn, $servport, $usernavn, $usercode, $protokol);
    SpalteBund();
    
### GEM DATA:

//  Til sidst indlæses java-scripter:   
  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>