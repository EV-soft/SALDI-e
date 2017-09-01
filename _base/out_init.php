<?php   $DocFil= '../_base/out_init.php';    $DocVer='5.0.0';    $DocRev='2017-08-00';   $modulnr=0;
/* ## FORMÅL: Initiering af globalt benyttede konstanter og variabler
 * Denne fil er oprettet af EV-soft  i 2017.
 *             ___   _   _    ___  _         
 *            / __| / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            |___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS      *** Se filen: ../LICENS_Copyright.txt
 *
 * Grundlæggende initiering.
 *
 * 2016.08.00 evs - EV-soft
 *
 */
 
 //set_include_path(get_include_path(). PATH_SEPARATOR. '/saldi-e/_config/'. PATH_SEPARATOR. '/_base'. PATH_SEPARATOR. '/_base/_admin');
 //if ($GLOBALS["Ødebug"]) echo "SøgePath: ".get_include_path()."<br>";
 
#   Konfigurerering af DB-forbindelse:
   if ((!file_exists("../_config/connect.php")) or (filesize("../_config/connect.php")==0)) {
#     echo '<meta http-equiv="refresh" content="0;url=install.php"><br>';   # Omdirigering til DB-opsætning
#     echo '</head><body><br><br>';
     echo '<p>Installationen er ikke konfigureret.</p><br>';
#     echo '<p>Du  bliver videresendt til installeringssiden.</p><br><br>';
#     echo '<p>Skulle dette ikke ske, så <a href="install.php">KLIK HER</a></p><br><br>';
#     echo '</body></html><br>';
#     exit;
   }

/* 
### Om fejlfindings flaget Ødebug=true:
1.  I rude_header's Titel tilføjes navnet på aktuel function
2.  Der sker logning med debug_log() af oplysning om PHP-filer, der indlæses
3.  Ekstra logning i functioner, kan tilføjes med: [if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,__FUNCTION__.':3');]
4.  Der indføjes ekstra <br> [dvl_pretty()] i HTML-kode, så list af siders kildekode, bliver lettere læsbar
5.  Der indføjes kommentarer i HTML-kode, så kildekode, bliver lettere forståelig
6.  Manuelt kan tilføjes specielle hændelser
7.  I TopMenu vises ekstra punkt: TOOLS med nyttige rutiner for programmøren

Flaget sættes:
  Globalt/statisk:  i starten af htm_pageHead.php eller i out_init.php
  Manuelt/dynamisk: i URL tilføjes "?debug=true"
  
 */
 
## Indlæsnings rækkefølge/afhængighed for includes:
# ../_base/out_init.php    (1) - Initiering af globale variabler
# ../_base/out_base.php    (1) - Output til skærm - Grundlæggende rutiner
# ../_base/out_ruder.php   (1) - Output til skærm - Konstruktion af paneler
# ../_base/out_vinduer.php (1) - Output til skærm - Eksempler på benyttelsen af flere paneler
# ../_base/std_func.php    (1) - Diverse standard funktioner
# ../_base/db_func.php     (1) - Diverse database funktioner (tidl: db_query.php)
# ../_base/db_query.php        - Data overførsel
# ../_base/settings.php        - Initiering af ver. 3.x.x's variable
# ../_base/version.php         - Versions stamp
# (1): indlæses i htm_pageHead.php - htm_pageHead.php opbygger et vindue. (SKAL afsluttes med htm_pageFoot.php)
# Se: ../_base/htm_pageHead.php for aktuel indlæsning af de almene rutiner.

//  if (!function_exists('tolk')) include "../_?????/out_base.php";  # Tolk() benyttes i out_init.php!

#if (function_exists('debug_log')) break; # Filen er indlæst tidligere!

//  if (session_status() == PHP_SESSION_NONE) { session_start(); }
//  $_SESSION['sess_id']= session_id();

if  (is_null($_SESSION['ØprogSprog']))  $_SESSION['ØprogSprog']= 'da';

### GLOBALE variabler ang. program-styring:     Bemærk benyttet prefix: $Ø blot for at tilkendegive at variablen benyttes på forskellige HTML-sider.
if (is_null($Ødebug))         $Ødebug= false;       /* $Ødebug kan også tildeles værdi via URL-parameter: ?debug=true  Se: ../_base/htm_pageHead.php */ /* true: Aktivering af fejlfinding: FilLogning [debug_log()], Kilde-HTML med extra linieskift og stikord [dvl_pretty()] */
if (is_null($ØprogSprog))     $ØprogSprog= 'da';    /* $ØprogSprog også tildeles værdi via URL-parameter: ?sprog=xx */      /* Initiering til dansk, hvis udefineret */
if (is_null($Ønovice))        $Ønovice= true;       /* Vis/Skjul hjælpetips mv. */
if (is_null($ØFullFilt))      $ØFullFilt= true;     /* Vis/Skjul fuld filter-funktionalitet mv. */
if (is_null($ØTastkeys))      $ØTastkeys= true;     /* Vis/Skjul tastatur genveje */
if (is_null($ØRollTabl))      $ØRollTabl= true;     /* Benyt tabeller i mindre vindue med scroll */
//if (is_null($ØprintLayout))   $ØprintLayout= false; /* Vis tabeller i fuld højde, så CTRL-P kan bruges */ // Skjul også: Hjælp og knapper ?
if (is_null($ØRudeForm))      $ØRudeForm= true;     /* Opret form & Submit-knap i RudeTop/Bund  */
$_SESSION['ØRollTabl']= true; //  Svarer til $ØprintLayout= false

### GLOBALE konstanter:
$ØProgTitl= ' SALDI';

# Knap-kategorier: Slet:RØD    Gem/Submit:GUL    Naviger:GRØN    OpretNy:BLÅ    Andre:HVID
$ØButtnBgrd= '#44BB44';  /* LysGrøn   */     $ØButtnText= '#FFFFFF';   /* Hvid   */
$ØBtLnkBgrd= 'yellow';   /* '#FCFCCC';  */   $ØBtLnkText= '#000000';
// Knap-farver:
$ØTextLight= 'white';       $ØTextDark= 'black'; 
$ØBtDelBgrd= 'red';         $ØBtDelText= $ØTextLight;  # Slet:RØD
$ØBtSavBgrd= 'yellow';      $ØBtSavText= $ØTextDark;   # Gem/Submit:GUL
$ØBtNavBgrd= 'green';       $ØBtNavText= $ØTextLight;  # Naviger:GRØN
$ØBtNewBgrd= 'blue';        $ØBtNewText= $ØTextLight;  # OpretNy:BLÅ
$Ødimmed=    ' opacity:0.8;';

if (is_null($_SESSION['Øtema']))  {$_SESSION['Øtema']='light'; }  # $Øtema= 'dark';
$Øtema= $_SESSION['Øtema'];


if ($Øtema=='dark') 
  {$ØTitleColr= '#6699CC';   /* Lys-blå   */ 
   $ØPanelBgrd= '#AAAA80';   /*  '#565656';   # Mørkgrå      Tema-dark */
   $ØPageBcgrd= '#112233';   /* Side baggrunds farve (lysblå) F4FFF4  */
   $ØPageImage= '../_assets/images/stjerner.jpg';   // $ØPageImage= '../_assets/images/paper_fibers.png';  /* Side baggrundsbillede  */
  }
else      
  {$ØTitleColr= '#003366';   /* Mørkblå   */ 
   $ØPanelBgrd= '#EFEFEF';   /* '#EFEFEF';   # Brækket Hvid Tema-light /* Lys baggrund for paneler (ruder). aktuel farve sættes i ../_base/out_style.css.php */
   $ØPageBcgrd= '#F4FFF4';   /* Side baggrunds farve (lysblå) F4FFF4  */
   $ØPageImage= '../_assets/images/paper_fibers.png';  /* Side baggrundsbillede  */
}
$ØPageLogo=  '../_assets/images/SALDIe25x75.png';   /* Side baggrundsLOGO  */
$ØblueColor= '#4479ff';   /* Benyttes kun i out_base.php sv.t. --blueColor i out_style.css.php */
$ØtblRowDrk= '#e0e0e0';   /* Tabellinie med mørk baggrund */
$ØtblRowLgt= '#f0f0f0';   /* Tabellinie med lys baggrund  */
$ØLineBrun=  '#550000;';  /* Tabel ydre ramme */
// Sørg for at farver stemmer overens med FARVEPALETTE i ../_base/out_style.css.php
$ØHeaderFont= 'font-size:0.75em;';

if (is_null($ØlanguageTable)) $ØlanguageTable= array(); 
if (is_null($ØsprogCol)) $ØsprogCol=3;  
if (is_null($ØsprogRow)) $ØsprogRow=123;  

/* 
if (!isset($exec_path))  $exec_path="/opt/bin"; # Standard:  $exec_path="/opt/bin";
if (!isset($sprog_id)) $sprog_id="1";
$convert="$exec_path/convert";
$pdf2ps="$exec_path/pdf2ps";
if (!$timezone) $timezone='Europe/Copenhagen';
if (phpversion()>="5") date_default_timezone_set($timezone);

if ($db_encode=="UTF8") $charset="UTF-8";
else $charset="ISO-8859-1";

 */
 
$regnskab= '@CSS-demo';
$vis_finans= true;    $vis_debitor= true;   $vis_kreditor= true;    $vis_lager= false;    $produktion= false;
$regnskab=''; $username=''; $userkode=''; 

$db= '';  $Øbrugernavn= '??';

### LOKALE variablers benyttelse:
//  $DocFil : Filens path & navn
//  $DocVer : Revisions index
//  $DocRev : Seneste Revisions dato
//  $modulnr: Styrer brugeradgang. 0:alle har adgang.
//  $pageTitl : Lokalt for et HTML-vindue (med tilhørende moduler)

// En del rutiner ang. globale lister, findes i out_base.php efter erklæring af tolk(), fordi listerne har behov for oversættelser!
// Søg efter: DanListe()

if (!function_exists('debug_log')) {
function debug_log($arg1='',$arg2='',$arg3='',$arg4='',$arg5='') {  global $db, $Øbrugernavn;
  if (!$db) $logPath= ''; else $logPath= $logPath.'/';
  $fp= fopen('../_temp/'.$logPath.'sys_debug.log','a'); 
  if ($arg4=='../_base/out_init.php')  
    fwrite($fp,"\n:");  # Start på ny sekvens    Standard : $DocVer,  $DocRev,  $modulnr,  $DocFil, : $pageTitl
  fwrite($fp,"\n-- ".$Øbrugernavn." ".date("Y-m-d H:i:s").' '.$arg1.' '.$arg2.' '.$arg3.' '.$arg4.' : '.$arg5);    
  fclose($fp);
}}

//  $pageTitl='Initiering';
##+ if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);

?>