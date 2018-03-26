<?php   $DocFil='../_base/page_Printlayout.php';    $DocVer='5.0.0';    $DocRev='2018-03-00';     $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Preview af udskrifts-formular.';
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2018 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
  Oprettet: 2016-08-00 evs - EV-soft
  Ændrings-Log:
      
 */

  include_once("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
  $pageTitl= tolk('@Print-layout');
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$ModulNr,$DocFil,$pageTitl);
  global $Øprogvers, $Øsaldihost, $ØRudeForm, $blanket;
  
### INDLÆS DATA:
  include_once("../_config/connect.php");   #+  Database tilkobling
  // Opdater:
  if (pushed('btn_printout'))     { /* echo 'Gemmer data...    '; */ include ('../_system/save_Formularer.php'); } // Knap i Rude_PrintDesign/RudeBund/htm_Accept
  if (pushed('btn_editform'))     { /* echo 'Gemmer data...    '; */ include ('../_system/save_Formularer.php'); } // Knap i Rude_PrintEdit/RudeBund/htm_Accept
  if (pushed('btn_new'))          { /* echo 'Opretter data...  '; */ include ('../_system/save_Formularer.php'); } // Knap i Rude_PrintEdit
  if ($_POST['Kol0'])  $dd= count($_POST['Kol0']);
  for ($i=0; $i<=$dd; $i++) { //  echo  ' '.$i.'.';
      if (pushed('btn_del_'.$i))  { /* echo 'Sletter record '.$i.'... '; */ include ('../_system/save_Formularer.php'); }
    }
  $DATA= sql_readB($qstr='SELECT id, form, frm_art, side, besk, just, x0, y0, dx, dy, dim, colr, font, style, imglnk, lngkey, note '.
                         'FROM tblA_forms ',__FILE__, __LINE__);
### VIS DATA:
    SpalteTop(1100);  
      $blanket= 
        Rude_PrintDesign($DATA);  //  Her vælges blanket
    SpalteBund();
    SpalteTop(960);
      $delDATA= []; foreach ($DATA as $rec) {if ($rec[1]==$blanket) array_push($delDATA,$rec); }; // Kun data for den blanket der redigeres
        Rude_PrintEdit($delDATA);   $dd= count($delDATA);
    SpalteBund();

    //  se også: page_Formtext.php
### GEM DATA:
  //  UPDATE sker i '../_system/save_Formularer.php' inden DB-data indlæses, hvis en knap er betjent

  include_once("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>  