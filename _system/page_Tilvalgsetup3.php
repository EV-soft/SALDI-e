<?php   $DocFil= '../_base/page_Tilvalgsetup3.php';    $DocVer='5.0.0';    $DocRev='2017-02-00';   $ModulNr=2;
/* ## Formål:  3. indstillingsmenu: Tilvalg
 *             ___   _   _    ___  _         
 *            / __| /_\ | |  |   \| |   ___ 
 *            \__ \/ _ \| |__| |) | |__/ -_)
 *            |___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 */
#  global $debug;  $debug= true;
  $pageTitl='Diverse tilvalg menu';
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
    
### INDLÆS DATA:
    
    
### VIS DATA:
    SpalteTop(240);    Rude_TilvalgsMenu();
    NextSpalte();      
    SpalteBund();
    
### GEM DATA:

//  Til sidst indlæses java-scripter:   
  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>