<?php   $DocFil= '../_base/page_Hovhov.php';    $DocVer='5.0.0';    $DocRev='2018-03-00';   $ModulNr=0;
/* FORMÅL: SALDI's Hov-hov side, angående uautoriseret adgang.                                        
 *             ___   _   _    ___  _         
 *            / __| / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            |___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 */
  $pageTitl='Hovhov hvad gør du her?';
  include("../_base/htm_pagePrepare.php"); ## Sidens indledende html-kode
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
    
    Rude_Hovhov();
    
//  Til sidst indlæses java-scripter:   
  include("../_base/htm_pageFinalize.php"); ## Sidens afsluttende html-kode
?>