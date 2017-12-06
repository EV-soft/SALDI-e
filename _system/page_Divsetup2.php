<?php   $DocFil= '../_system/page_Divsetup2.php';    $DocVer='5.0.0';    $DocRev='2017-10-00';   $DocIni='evs';  $ModulNr=2;
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
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$ModulNr,$DocFil,$pageTitl);
    
### INDLÆS DATA:
    #Demo:
    if (!$regnskabnavn) {
      $regnskabnavn='CSS-demo';   $servport= '';    $usernavn= '';    $usercode= '********';    $protokol= 'tls';
    }

### VIS DATA:
    SpalteTop(240);    Rude_DiverseMenu();
    NextSpalte();      Rude_Kontoindstilling($regnskabnavn, $servport, $usernavn, $usercode, $protokol);
    SpalteBund();
    
### GEM DATA:

//  Til sidst indlæses java-scripter:   
  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>