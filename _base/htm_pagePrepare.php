<?php $DocFil= '../_base/htm_pagePrepare.php';   $DocVer='5.0.0';    $DocRev='2018-10-07';   $DocIni='evs';  $ModulNr=0; //  Gl. navn: htm_pageHead.php ?
// ## Purpose: 'Denne fil klargoer en side med initiering af php-filer og indledende HTML-kode.';
  date_default_timezone_set('Europe/Copenhagen');
  session_start();                  #+  Nødvendig for bevarelse af overordnede værdier, på tværs af html-sider
  $Caller= $GLOBALS['pageTitl'];
  $ØProgRoot= "./../";  // "../";        //  Relativ i 1. subniveau    #-$ØProgRoot= "./../../";   //  Relativ i 2. subniveau
  $_base= '_base/';    $_config= '_config/';    $_assets= '_assets/';   $_system= '_system/';
  
/* 
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *
 * ## LICENS & Copyright (c) 2004-2018 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
  Oprettet: 2017-08-00 evs - EV-soft
  Ændrings-Log:
  2018-00-00 - evs  Når filer er "frigivet", påbegyndes log-notater!
  
 */
  echo '<!DOCTYPE html>';             //  HTML starter her, fordi der kan forekomme echo i includes!
  echo '<html lang="da" dir="ltr">';
  echo "\n<head>";
  
  if (false) {  //   mail er ikke taget i brug
#! Aktivere PHP namespace og moduler :
  //  use PHPMailer\PHPMailer\PHPMailer; 
  //  use PHPMailer\PHPMailer\Exception;
  require  $ØProgRoot.$_assets.'PHPMailer-master/src/Exception.php';
  require  $ØProgRoot.$_assets.'PHPMailer-master/src/PHPMailer.php';
  require  $ØProgRoot.$_assets.'PHPMailer-master/src/SMTP.php';
  }

#! out_-moduler: Blok-struktureret System, som danner css-baseret, adaptive HTML-kode
  include_once "out_init.php";      #+  Nødvendig tidlig global initiering
  DocAlder($DocRev,$DocFil);                //  find nyeste include-fil, blandt de aktuelle includes
  Stamp($Caller);                   //  logføring i sys_access.log

  if ($GLOBALS['Ødebug']) debug_log($DocVer,$DocRev,$ModulNr,$DocFil,'htm_pagePrepare');  //  udvidet logføring, når debug-flag er sat
  include_once 'out_base.php';      #+  Grundmoduler, nødvendige for panel-systemet! 
  //echo '<br>'.$ØProgRoot.$_base.'out_panlsPrim.php';

#! opbygning af paneler  :
  if (false) { // false: udviklingstilstand  (Opsplitningsfiler benyttes ikke!)
  include_once $ØProgRoot.$_base.'out_panlsComm.php';                           #0  Paneler ang. Forskellig moduler (både prim & sekd) - COMMON
  switch ($GLOBALS["ØProgModu"]) {  // Sættes i Page_*.php
    case ['prim']: include_once $ØProgRoot.$_base.'out_panlsPrim.php'; break;   #0  Paneler ang. FINANS, DEBITOR, KREDITOR, LAGER, PRODUKTION
    case ['sekd']: include_once $ØProgRoot.$_base.'out_panlsSekd.php'; break;   #0  Paneler ang. SYSTEM og alle andre
    case ['none']: break;   #Ingen udlæsning. De nødvendige Paneler skal være erklæret lokalt i page_filen.
  }} // Denne opdeling ovenfor, for at reducere indlæsnings forsinkelse.
  else include_once "out_panls.php";  //  Heri redigeres. Derefter opdateres ..comm ..prim og ..sekd
  #: Konstruktion af samtlige Paneler. Kan overspringes, hvis page_* indeholder en kopi af det nødvendige.
  // Opsplitning i: COMMON, FINANS, DEBITOR, KREDITOR, LAGER, PRODUKTION, SYSTEM er forberedt i out_panls.php
  //  vis_data($GLOBALS["ØProgModu"]);
  //  var_dump($GLOBALS["ØProgModu"]);  //  NULL
//  if ($GLOBALS["ØProgModu"]=['prim'])
//    include_once "./../_base/out_panlsPrim.php";  // Fordi indlæsning svigter ovenfor FIXIT


  include_once "msg_lib.php";       #+  Nødvendigt dialog-system 
  include_once "std_func.php";      #+  Standard blandede funktioner 
  include_once "fil_func.php";      #+  Funktioner med filer involveret 
  include_once "dbi_func.php";      #+  Forbedrede DataBase-funktioner, kompatible med PHP7
  include_once "version.php";       #+  Initiering af globale konstanter 

#+
  include_once $ØProgRoot.$_config."connect.php";   #+  Database tilkobling
//  Andre individuelle:                             #?  Indlæses efter behov i aktuel page_*
  
  global $ØprogSprog, $tblix; //  global $pageTitl, $ØsprogTabl, $ØprogSprog, $ØPageImage, $ØPageLogo, $Ødebug, $ØRollTabl, $Øtema;
  if ($_SESSION['ØprogSprog'])
    $ØprogSprog= $_SESSION['ØprogSprog']; # Sprog i programfladen
  $ØsprogCol = $_SESSION['ØsprogCol']; # Benyttes i Panl_LanguageJuster
  $ØsprogRow = $_SESSION['ØsprogRow']; # Benyttes i Panl_LanguageJuster
  $Ønovice   = $_SESSION['Ønovice'  ]; # Udvid visning af brugertip (skjul det avancerede)
  $ØFullFilt = $_SESSION['ØFullFilt']; # Vis hjælpetekster til filter-funktionalitet - overflødigt!
  $ØTastkeys = $_SESSION['ØTastkeys']; # Vis Tast-genveje på navigationstaster
  $ØRollTabl = $_SESSION['ØRollTabl']; # Sæt $ViewHeight= '99999px medfører "printlayoyt" af tabeller
  $ØRollTabl = true;
  $Øtema     = $_SESSION['Øtema'];
  $tblix= -1;
  
  
// Debug-indstilling:
// $Ødebug= true;   $GLOBALS["Ødebug"]= true;   //  debug kan også aktiveres midlertidigt, pr.side ved tilføjelse af: ?debug=true i browserens adressefelt
$Ødebug= false;

  global $pageTitl; //  Tildeles værdi i aktuel page_-fil som kalder htm_pagePrepare.php

####################### HTML-start ##### HEAD-start ############################################
  
### Side-start:
  //  header('Content-type: text/html; charset=utf-8');
//  echo '<!DOCTYPE html>'; 
//  echo '<html lang="da" dir="ltr">';                                                dvl_ekko('htm_pagePrepare  3 ');
//  echo "\n<head>";
  echo '  <meta charset="UTF-8">';
  echo '  <meta name="viewport" content="width=device-width, initial-scale=1">';    dvl_ekko('htm_pagePrepare  3 ');
  echo '  <meta name="robots" content="Noindex, Nofollow">';                        //  Afvisning af robot-skanning
  echo '  <title>'.$pageTitl.'</title>';                                            dvl_pretty('htm_pagePrepare');
  echo '  <link rel="stylesheet" type="text/css" href= "'.$ØProgRoot.$_base.'out_style.css.php" />';         //  emne="out_modulers style" /* _base/ */
  echo '  <link rel="stylesheet" type="text/css" href= "'.$ØProgRoot.$_base.'msg_lib.css.php" />';

### jQuery-latest:
  echo '	<script src="./../_assets/jquery/3/jquery-3.3.1.js"></script>'; // latest //  emne="Tablesorter-system" og Topmenu-system
// JavaScript benyttes også til:
// PopUp-dialog, PassWord-styrke måler.

 
  $path= './../_assets/tablesorter/';
// Tablesorter script: required 
  echo '	<script src="'.$path.'js/jquery.tablesorter.js"></script>';               //  emne="Tablesorter-system"
  echo '	<script src="'.$path.'js/widgets/widget-filter.js"></script>';            //  emne="Tablesorter-system"
  echo '	<script src="'.$path.'js/widgets/widget-stickyHeaders.js"></script>';     //  emne="Tablesorter-system"
  echo '	<script src="'.$path.'js/parsers/parser-input-select.js"></script>';      //  emne="Tablesorter-extra"
  echo '  <link rel="stylesheet" href="'.$path.'css/theme.blue.css"/>';             //  emne="Tablesorter-system" (choose a theme file)

  echo '<link rel="icon" type="image/png" sizes="32x32" href="'.$ØProgRoot.$_assets.'images/favicon-32x32.png"/>';
  echo '<script defer src="'.$ØProgRoot.$_assets.'font-awesome5/fontawesome-free-5.0.2/svg-with-js/js/fontawesome-all.js"></script>';   //   emne= "ICON-system" version 5
  
  echo '<script>';
  echo 'function varcopy() {';
  echo '  var input = document.createElement("input");';
  echo '  var copytext = document.getElementById("copytxt");';
  echo '  input.setAttribute("value", copytext.value); document.body.appendChild(input); input.select();';
  echo '  document.execCommand("copy");  console.log(copytext.value);';
  echo '  document.body.removeChild(input);}';
  echo '</script>';  


### Initiering:
  include_once 'htm_Tableinit.php';                                                 //  emne="Tablesorter-system"
  PanelInit();
  $vismenu= (/* ($pageTitl!= 'Hovedmenu') and */ 
    ($pageTitl!= 'Logind til SALDI') and 
    ($pageTitl!= 'Udskrift Kontoplan') );
  //  $vismenu= false;
  if ($vismenu)
    { include $ØProgRoot.$_base.'htm_TopMenu-head.css.htm';} # TopMenu-CSS  /* _base/ */
  echo '<style type="text/css"> <!--  @font-face { font-family: barcode; src: url('.$ØProgRoot.$_assets.'fonts/barcode.ttf); } --> </style>';
  echo '<style type="text/css"> body { background: url('.$ØPageLogo.') right bottom no-repeat, url('.$ØPageImage.') left top repeat; font-family: sans-serif;} </style>';
  //echo "\n</head>";
  
####################### HEAD-slut ##### BODY-start ############################################
  
  echo "\n<body style='max-width:1200px; margin:auto;'>\n"; //  Centrér indhold på skærmen

  if ($ØsprogTabl==NULL) sprogDB_import();
  
### Benyt URL-parameter variabler: (ØprogSprog har højere prioritet, end brugervalg!)
  #+    
  $str= $_GET['debug'];   if ($str) $Ødebug= $str;
  $str= $_GET['sprog'];   if ($str) $ØprogSprog= $str; 
  $str= $_GET['lng'];     if ($str) $ØprogSprog= $str; 
  $str= $_GET['job'];     if ($str) $Øjob= $str;
  $str= $_GET['chg'];     if ($str) $chg= $str;

  
global $Øvis_finans, $Øvis_debitor, $Øvis_kreditor, $Øvis_prodkt, $Øvis_lager;
  if ($vismenu and ($loggetind=true))
    {Menu_Topdropdown($Øvis_finans, $Øvis_debitor, $Øvis_kreditor, $Øvis_prodkt, $Øvis_lager); htm_nl(3); }  /* include $ØProgRoot."_base/htm_TopMenu-body.htm"; Erstattet af rutiner i out_base.php*/ 
    
  // Her placeres sidens indhold
  
  // Til slut skal indlæses: include $ØProgRoot."/* _base/ */htm_pageFinalize.php";
?>