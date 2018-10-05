<?php   $DocFil= '../_system/page_FormText.php';    $DocVer='5.0.0';    $DocRev='2018-09-20';   $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Redigering af udskrivnings formularer';
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2018 Saldi.dk ApS      *** Se filen: ../LICENS_Copyright.txt
 *
  Oprettet: 2016-08-00 evs - EV-soft
  Ændrings-Log:
      
* 
 */
  $pageTitl='Formularredigering';
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);

  $GLOBALS["ØProgModu"]= ['sekd']; ## prim eller/og sekd og comm
  include_once("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
### INDLÆS DATA:
    include_once("../_config/connect.php");   #+  Database tilkobling
    // Data indlæses i Panl_xx, da der kun skal benyttes deldata (filter: WHERE).
    if (pushed('btn_edit'))   { echo 'Gemmer data...  '; include ('../_system/save_Formularer.php'); }  //  function pushed($name) { return (isset($_POST[$name])); }
    if (pushed('btn_new'))    { echo 'Opretter data...'; include ('../_system/save_Formularer.php'); }
    if (pushed('blanket'))    { echo 'Skifter blanket.'; include ('../_system/save_Formularer.php'); }
    
### VIS DATA:
    SpalteTop(240); // BrugerMenu:
global $Øart;
    if ($art) echo 'Art:'.$art.'|',$Øart.'|'.$GLOBALS["Øart"];
    $selected= Panl_Formularer($frm,$art,$lang,$papr);  //  Her vælger brugeren, hvad der skal redigeres.
    $frm=  $selected[0];
    $art=  $selected[1];    $Øart= $art;    $GLOBALS["Øart"]= $art; //  Virker ikke ! ? Efter Gem er den glemt !
    $lang= $selected[2];
    $papr= $selected[3];
    NextSpalte(640);   // Hent fra DB og rediger:
    switch ($art) {         
      case '5:Mail tekst'; 
      case '0:Layout'      : Panl_FormRedigerLayout($frm,$art,$lang,$papr); break;       
      case '1:Tekster'     : Panl_FormRedigerText($frm,$art,$lang,$papr);   break;       
      case '2:Linjer'      : Panl_FormRedigerGrafik($frm,$art,$lang,$papr); break;     
      case '3:Ordrelinjer' : Panl_FormRedigerOrdrelin($frm,$art,$lang,$papr); break;   
    default : Panl_FormRedigerText($frm,$art,$lang,$papr);                           
    }
    SpalteBund();

  include_once("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>  