<?php   $DocFil= '../_base/page_Hovhov.php';    $DocVer='5.0.0';    $DocRev='2018-06-00';    $DocRev='2018-09-23';     $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'SALDI's Hov-hov side, angaaende uautoriseret adgang.';
 *             ___   _   _    ___  _         
 *            / __| / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            |___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 */
  $pageTitl='Hovhov hvad gør du her?';
  $GLOBALS["ØProgModu"]= ['comm']; ## prim eller/og sekd og comm
  include("../_base/htm_pagePrepare.php"); ## Sidens indledende html-kode
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
    
    Panl_Hovhov();
    
//  Til sidst indlæses java-scripter:   
  include("../_base/htm_pageFinalize.php"); ## Sidens afsluttende html-kode
?>