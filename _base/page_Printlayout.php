<?php   $DocFil='../_base/page_Printlayout.php';    $DocVer='5.0.0';    $DocRev='2018-09-29';     $DocIni='evs';  $ModulNr=0;
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

  $pageTitl= 'Print-layout';
  $GLOBALS["ØProgModu"]= ['sekd']; ## prim eller/og sekd og comm
  include_once("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$ModulNr,$DocFil,$pageTitl);
  global $Øprogvers, $Øsaldihost, $ØRudeForm, $blanket, $ØprogSprog;
  
### INDLÆS DATA:
  include_once("../_config/connect.php");   #+  Database tilkobling
  // Opdater:
  if (pushed('btn_printout'))     { /* echo 'Gemmer data...    '; */ include ('../_system/save_Formularer.php'); } // Knap i Panl_PrintDesign/RudeBund/htm_Accept
  if (pushed('btn_editform'))     { /* echo 'Gemmer data...    '; */ include ('../_system/save_Formularer.php'); } // Knap i Panl_PrintEdit/RudeBund/htm_Accept
  if (pushed('btn_new'))          { /* echo 'Opretter data...  '; */ include ('../_system/save_Formularer.php'); } // Knap i Panl_PrintEdit
  if ($_POST['Kol0'])  $dd= count($_POST['Kol0']);
  for ($i=0; $i<=$dd; $i++) { //  echo  ' '.$i.'.';
      if (pushed('btn_del_'.$i))  { /* echo 'Sletter record '.$i.'... '; */ include ('../_system/save_Formularer.php'); }
    }
  $DATA= sql_readB('SELECT id, form, frm_art, side, besk, just, x0, y0, dx, dy, dim, colr, font, style, imglnk, lngkey, note '.
                   'FROM tblA_forms ' //'WHERE form = "'.$blanket.'"'   //  Blanket ukendt her
                   ,__FILE__, __LINE__);
  
  $sp= $ØprogSprog; $ØprogSprog='en';
  $tmpData= []; foreach ($DATA as $rec) 
            { $rec['15']= tolk('@'.$rec['15']); //  Oversæt alternativt sprog til engelsk
              array_push($tmpData,$rec);
            };
  $ØprogSprog= $sp;
  $DATA= $tmpData;
  
### VIS DATA:
    SpalteTop(1100);  
      $blanket= 
        Panl_PrintDesign($DATA);  //  Her vælges blanket
    SpalteBund();
    SpalteTop(960);
        $delDATA= []; foreach ($DATA as $rec) 
            {if ($rec[1]==$blanket) array_push($delDATA,$rec); };   // Kun data for den blanket der redigeres
        Panl_PrintEdit($delDATA);   $dd= count($delDATA);
    SpalteBund();
    PanelInitier(2,5);

    //  se også: page_Formtext.php
### GEM DATA:
  //  UPDATE sker i '../_system/save_Formularer.php' inden DB-data indlæses, hvis en knap er betjent

  include_once("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>  