<?php      $DocFil= '../_debitor/DebtOpretRykker.php';   $DocVer='5.0.0';    $DocRev='2018-09-27';   $DocIni='evs';  $ModulNr=2;
/* ## Purpose: 'Vis en rykker til debitor';
 * Denne fil er oprettet af EV-soft i 2017.
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 * 2016.08.00 evs - EV-soft
 *
 */
 
  $pageTitl='Debitor rykker';
  $GLOBALS["ØProgModu"]= ['comm']; ## prim eller/og sekd og comm
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
  DocAlder($DocRev);

  Panl_DebtOpretRykker();
  PanelInitier(2,5);
 
  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>