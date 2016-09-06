<?php		$DocFil= '../base/base_init.php';	 	$DocVer='5.0.0';		$DocRev='2016-08-00';		$modulnr=0;
//						 ___   _   _    ___  _	       
//						/ __| /_\ | |  |   \| |   ___ 
//						\__ \/ _ \| |__| |) | |__/ -_)
//						|___/_/ \_|____|___/|_|  \___|
//						                               
// Grundlæggende initiering.
//
// 2016.08.00 ev - EV-soft
//

#		Konfigurerering af DB-forbindelse:
#		if (!file_exists("../includes/connect.php")) {
#			echo '<meta http-equiv="refresh" content="0;url=install.php"><br>';		# Omdirigering til DB-opsætning
#			echo '</head><body><br><br>';
#			echo '<p>Installationen er ikke konfigureret.</p><br><br>';
#			echo '<p>Du  bliver videresendt til installeringssiden.</p><br><br>';
#			echo '<p>Skulle dette ikke ske, så <a href="install.php">KLIK HER</a></p><br><br>';
#			echo '</body></html><br>';
#			exit;
#		}

## Indlæsnings rækkefølge/afhængighed for includes:
# ../base/base_init.php										(1)	-	Initiering af globale variabler
#	include("../includes/out_base.php");		(1)	-	Output til skærm -	tidligere: base_interface.php
#	include("../includes/out_ruder.php");		(1)	-	Output til skærm
#	include("../includes/out_vinduer.php");	(1)	-	Output til skærm
#	include("../includes/std_func.php");		(1)	-	Diverse standard funktioner
#	include("../includes/db_query.php");				-	Data overførsel
#	include("../includes/settings.php");				-	Initiering af ver. 3.x.x's variable
#	include("../includes/version.php");					-	Versions stamp
#	require("../includes/pbkdf2.php");					- Krypterings bibliotek
# (1): indlæses i htm_pageHead.php
	
#globale variabler:
$debug= false;
$lysBlaa= '#4479ff';		// Benyttes kun i out_base.php sv.t. --blueColor i out_style.css.php
$MissingFrase= array();
$languageTable= array();
$regnskab= '@CSS-demo';
$vis_finans= true;				$vis_debitor= true;				$vis_kreditor= true;				$vis_lager= true;				$produktion= false;
$regnskab=''; $username=''; $userkode=''; 


	
?>