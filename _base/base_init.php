<?php   $DocFil= '../_base/base_init.php';    $DocVer='5.0.0';    $DocRev='2016-10-00';   $modulnr=0;
//             ___   _   _    ___  _         
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___|
//                                           
// LICENS & Copyright (c) 2004-2016 DANOSOFT ApS *** Se filen: ../LICENS_Copyright.txt
//
// Grundlæggende initiering.
//
// 2016.08.00 ev - EV-soft
//

#   Konfigurerering af DB-forbindelse:
   if ((!file_exists("../includes/connect.php")) or (filesize("../includes/connect.php")==0)) {
#     echo '<meta http-equiv="refresh" content="0;url=install.php"><br>';   # Omdirigering til DB-opsætning
#     echo '</head><body><br><br>';
#     echo '<p>Installationen er ikke konfigureret.</p><br><br>';
#     echo '<p>Du  bliver videresendt til installeringssiden.</p><br><br>';
#     echo '<p>Skulle dette ikke ske, så <a href="install.php">KLIK HER</a></p><br><br>';
#     echo '</body></html><br>';
#     exit;
   }

## Indlæsnings rækkefølge/afhængighed for includes:
# ../base/base_init.php                   (1) - Initiering af globale variabler
# include("../includes/out_base.php");    (1) - Output til skærm - Grundlæggende rutiner
# include("../includes/out_ruder.php");   (1) - Output til skærm - Konstruktion af paneler
# include("../includes/out_vinduer.php"); (1) - Output til skærm - Eksempler på benyttelsen af flere paneler
# include("../includes/std_func.php");    (1) - Diverse standard funktioner
# include("../includes/db_func.php");     (1) - Diverse database funktioner (tidl: db_query.php)
# include("../includes/db_query.php");        - Data overførsel
# include("../includes/settings.php");        - Initiering af ver. 3.x.x's variable
# include("../includes/version.php");         - Versions stamp
# require("../includes/pbkdf2.php");          - Krypterings bibliotek
# (1): indlæses i htm_pageHead.php - htm_pageHead.php opbygger et vindue. (SKAL afsluttes med htm_pageFoot.php)

//  if (!function_exists('tolk')) include("../includes/out_base.php");  # Tolk() benyttes i base_init.php!

#if (function_exists('debug_log')) break; # Filen er indlæst tidligere!

#globale variabler:
$Ødebug= false;
$ØButtnBgrd= '#44BB44';   /*   LysGrøn   */
$ØButtnText= '#FFFFFF';   /*   Hvid   */
$ØSaldiblue= '#003366';   /*   Mørkblå   */
$ØblueColor= '#4479ff';    // Benyttes kun i out_base.php sv.t. --blueColor i out_style.css.php
$ØtblRowDrk= '#f0f0f0';   /* Tabellinie med mørk baggrund */
$ØtblRowLgt= '#f8f8f8';   /* Tabellinie med lys baggrund  */
// Sørg for at farver setmmer overens med FARVEPALETTEn i ../css/out_style.css.php

$MissingFrase= array(); // Pt. ubenyttet
$languageTable= array();
$regnskab= '@CSS-demo';
$vis_finans= true;        $vis_debitor= true;       $vis_kreditor= true;        $vis_lager= true;       $produktion= false;
$regnskab=''; $username=''; $userkode=''; 

$kontoTypeListe= array(['H','Overskrift'],['D','Drift'],['S','Status'],['Z','Sum'],['R','Resultat'],['X','Sideskift'],['L','Lukket']);

$momsKodeListe= array(['K','Købsmoms'],['S','Salgsmoms'],['Y','Ydelsesmoms'],['E','EU-varemoms']);

$artsKodeListe= array(['VG','yyy'],['DG','yyy'],['KG','yyy'],['VPG','yyy'],['VTG','yyy'],['VRG','yyy'],['SM','SalgsMomskonto'],['VK','ValutaKoder'],['PRJ','yyy'],
                      ['YM','YdelsesMomskonto-udland'],['EM','VareMomskonto-udland'],['KM','KøbsMomskonto'],['SD','SamlekontoDebitor'],['KD','KreditorSamlekonto'],['RA','yyy'],['PV','yyy'],['LG','LagerGrupper'],['S','yyy'],['xx','yyy'],['xx','yyy']);
                  #     'MR' MomsRapportkonto
# Diverse lister: [Tip Tekst, Value, Label]
function JustListe () {return( [['Venstre justeret','V','V'],['Center justeret','C','C'],['Højre justeret','H','H']] ); }
function SideListe () {return( [['Alle sider','A','A'],['Første side','1','1'],['IKKE første side','!1','!1'],['Sidste side','S','S'],['IKKE Sidste side','!S','!S']] ); }
function FontListe () {return( [['Sans-serif','Helvetica','Helvetica'],['serif','Times','Times'],['Optisk Læsbar','OCRbb12','OCRbb12']] ); }
function KontListe () {return( [['Drifts konto','D','D'],['Status konto','S','S'],['Sum konto','Z','Z'],['Overskrift (system!)','H','H'],['Resultat konto','R','R'],['Sideskift (system!)','X','X'],['Lukket konto','L','L']] ); }
function MomsListe () {return( [['Købs-moms','K1','K1'],['Salgs-moms','S1','S1'],['Ydelses-moms','Y1','Y1'],['E_-moms?','E1','E1']] ); }
function ValuListe () {return( [['Danske kroner','DKK','DKK'],['Euro','EUR','EUR'],['US dollar','$','$'],['Engelsk pund','£','£']] ); }
function Aar_Liste () {return( [['2015','2015','2015'],['2016','2016','2016'],['2017','2017','2017']] ); }

$Ø_ArtList= [['Kontokort med moms','kontokort_moms','Kontokort med moms'],['Balance','balance','Balance'],['Resultat','resultat', 'Resultat'],['Budget','budget','Budget'],['Momsangivelse','momsangivelse','Momsangivelse']];

// Variabler med prefix: $Ø_ benyttes globalt!

function DanListe($listen,$suff='') {
 // $result=[]; $ix=0; foreach ($listen as $elem) array_push($result,[tolk($elem).$suff,$ix++,tolk($elem)]); return($result);  # : [Tip Tekst, Value, Label]
  $result=[]; $ix=0; foreach ($listen as $elem) array_push($result,[$elem.$suff,$ix++,$elem]); return($result);  # : [Tip Tekst, Value, Label]
}
// Følgende variabler med prefix: Ø_ er beregnet til global anvendelse. Husk erklæring: global Ø_varname når de skal kaldes i lokalt scope.
  $mdr= ['@januar','@februar','@marts','@april','@maj','@juni','@juli','@august','@september','@oktober','@november','@december'];
//  $Ø_MdrList= DanListe($mdr, ' '.tolk('@måned'));		#	tolk() erklæres først i out_base!
  $Ø_MdrList= DanListe($mdr, ' '.'@måned');

  $dag= ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'];
// $Ø_DagList= DanListe($dag, '. '.tolk('@dag i måneden'));
  $Ø_DagList= DanListe($dag, '. '.'@dag i måneden');

if (!function_exists('debug_log')) {
function debug_log($arg1='',$arg2='',$arg3='',$arg4='',$arg5='') {  global $db;
  $fp= fopen("../temp/$db/.sys_debug.log","a"); 
    if ($arg4=='../_base/base_init.php')  fwrite($fp,"\n:");  # Start på ny sekvens
    fwrite($fp,"\n-- ".$brugernavn." ".date("Y-m-d H:i:s").' '.$arg1.' '.$arg2.' '.$arg3.' '.$arg4.' '.$arg5);    
  fclose($fp);
}}

if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'');

  
?>