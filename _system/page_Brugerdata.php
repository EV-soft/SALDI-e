<?php      $DocFil= '../_systemdata/page_Brugerdata.php';    $DocVer='5.0.0';     $DocRev='2016-10-00';
/* Formål: Redigering af Brugerdata
 *             ___   _   _    ___  _         
 *            / __| / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            |___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 */

  $pageTitl='Brugerdata';
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);

  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
    
    Rude_Blindgyde(); 

  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  