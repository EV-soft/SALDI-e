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
#   if (!file_exists("../includes/connect.php")) {
#     echo '<meta http-equiv="refresh" content="0;url=install.php"><br>';   # Omdirigering til DB-opsætning
#     echo '</head><body><br><br>';
#     echo '<p>Installationen er ikke konfigureret.</p><br><br>';
#     echo '<p>Du  bliver videresendt til installeringssiden.</p><br><br>';
#     echo '<p>Skulle dette ikke ske, så <a href="install.php">KLIK HER</a></p><br><br>';
#     echo '</body></html><br>';
#     exit;
#   }

## Indlæsnings rækkefølge/afhængighed for includes:
# ../base/base_init.php                   (1) - Initiering af globale variabler
# include("../includes/out_base.php");    (1) - Output til skærm -  tidligere: base_interface.php
# include("../includes/out_ruder.php");   (1) - Output til skærm
# include("../includes/out_vinduer.php"); (1) - Output til skærm
# include("../includes/std_func.php");    (1) - Diverse standard funktioner
# include("../includes/db_func.php");     (1) - Diverse database funktioner (tidl: db_query.php)
# include("../includes/db_query.php");        - Data overførsel
# include("../includes/settings.php");        - Initiering af ver. 3.x.x's variable
# include("../includes/version.php");         - Versions stamp
# require("../includes/pbkdf2.php");          - Krypterings bibliotek
# (1): indlæses i htm_pageHead.php
  
#if (function_exists('debug_log')) break; # Filen er indlæst tidligere!

#globale variabler:
global $debug;    $debug= true;
$lysBlaa= '#4479ff';    // Benyttes kun i out_base.php sv.t. --blueColor i out_style.css.php
$MissingFrase= array();
$languageTable= array();
$regnskab= '@CSS-demo';
$vis_finans= true;        $vis_debitor= true;       $vis_kreditor= true;        $vis_lager= true;       $produktion= false;
$regnskab=''; $username=''; $userkode=''; 

if (!function_exists('debug_log')) {
function debug_log($arg1='',$arg2='',$arg3='',$arg4='',$arg5='') {  global $db;
  $fp= fopen("../temp/$db/.sys_debug.log","a"); 
    if ($arg4=='../_base/base_init.php')  fwrite($fp,"\n:");  # Start på ny sekvens
    fwrite($fp,"\n-- ".$brugernavn." ".date("Y-m-d H:i:s").' '.$arg1.' '.$arg2.' '.$arg3.' '.$arg4.' '.$arg5);    
  fclose($fp);
}}

if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'');

  
?>