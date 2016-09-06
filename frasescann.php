<?php			 $DocFil= '../frasescann.php';	 	$DocVer='5.0.0';		 $DocRev='2016-08-00';
//	Find alle sprog-fraser: '@Strenge med prefix: @' i alle php-filer, også i undermapper, og udskriv sorteret liste på skærm.
//						 ___   _   _    ___  _	       
//						/ __| /_\ | |  |   \| |__ ___ 
//						\__ \/ _ \| |__| |) | |__/ -_)
//						|___/_/ \_|____|___/|_|  \___|
//						                               
//
// Filer skal gemmes i UTF-8 format uden BOM!
//	2016.08.00 ev - EV-soft

/* 	Denne fil skal køres fra SALDI-root mappen!  */
	$d = dir(".");	
	$total= 0;		$buff= array();		$fraser= array(); $longest= 0;
	echo '<p style="font-family:courier; font-size:11; ">';
//echo '"!SYSTEM-key :Dansk (Med prefix: @)","da:Dansk (Denmark:Danish da-DK)","en:English (United Kingdom:English en-GB)","de:Deutsch (Germany:German de-DE)","fr:Français (France:French fr-FR)","tr:Türkçe (Turkey:Turkish tr-TR)","es:Español (Spain:Spanish es-ES)"';	#	"Greenland - Greenlandic",    "kl-GL"
	while (false !== ($entry = $d->read())) {
		$dir= $entry.'/';					#'debitor/';
		if (is_dir($entry) ) {
			$files = scandir($dir);
			if ($files)
			foreach ($files as $source) {	$count= 0;	$search= "'@";	$search1= '"@';
				if ( ($source!=='.') and ($source!=='..') and (!strpos($source,'.bak')) and (!strpos($source,'scann.php')) and (!strpos($source,'.csv')) ) {	
					$lines = file($dir.$source); 
					foreach ($lines as $line_num => $line) {
						if (($a=strpos($line,$search)) or ($a=strpos($line,$search1))) {
					#		if (('user_interface.php'== $source) or ('LayoutModuler.php'== $source)) {
							if (strpos($source,'.php')) {
								$fras= $line;
								while (strpos($fras,$search)) {
									$a= strpos($fras,$search);	$fras= substr($fras,$a+1);	$b= strpos($fras,"'");
									$fras= html_entity_decode($fras);
									$fras= strip_tags($fras);
									$longest= max($longest,strlen(utf8_decode(substr($fras,0,$b))));
					//				echo  '<br>"'.substr($fras,0,$b).'"'.
					//					str_repeat("&nbsp;",170-strlen(utf8_decode(substr($fras,0,$b)))).',"","","","","",""';	
									$f= substr($fras,0,$b);
								#	$f= strip_tags($f);
								#	echo '<br>'.strip_tags($f, '<p><small><b><a><u>');
								#	echo '<br>'.htmlspecialchars_decode($f);
									$fraser[] = ['"'.$f.'"'];
								}	
								while (strpos($fras,$search1)) {
									$a= strpos($fras,$search1);	$fras= substr($fras,$a+1);	$b= strpos($fras,'"');
					//				echo '<br><red>"'.substr($fras,0,$b).'"'.'</red>'.
					//					str_repeat("&nbsp;",170-strlen(utf8_decode(substr($fras,0,$b)))).',"","","","","",""';	
									$fraser[] = ['"'.substr($fras,0,$b).'"'];
								}	
							}	$count++;	$total++;
						}	}
					$count= substr('000'.$count,-3);
					if ($count>0) $buff[] = '<br>Ialt: '.$count.' forekomst(er) af: "<font color=red>'.$search.'</font>" i <i>'.$dir.'</i><b>'.$source.'</b>';
			}	}	}
	}
	echo '</p>';
	$d->close();
	foreach ($buff as $buf) {echo $buf;};
	echo '<br>Total: '.$total. ' forekomst(er) af: <i>'.$search.'</i> i de undersøgte filer<br>';
	$fraser= array_unique($fraser, SORT_REGULAR);
	sort($fraser);
#	var_dump($fraser); echo '<br>';
	echo '<br>Sorteret liste uden dubletter:';
	$x= 0;
	echo '<p style="font-family:courier; font-size:11; ">';
	echo '"!SYSTEM-key :Dansk (Med prefix: @)","da:Dansk (Denmark:Danish da-DK)","en:English (United Kingdom:English en-GB)","de:Deutsch (Germany:German de-DE)","fr:Français (France:French fr-FR)","tr:Türkçe (Turkey:Turkish tr-TR)","es:Español (Spain:Spanish es-ES)"';
#	foreach ($fraser as $frase) {if (strlen($frase[0])>3) echo '<br>'./* $x++.'  '. */trim($frase[0],'"');};
	foreach ($fraser as $frase) {if (strlen($frase[0])>3) echo '<br>'.$frase[0].','.
		str_repeat("&nbsp;",$longest+3-strlen(utf8_decode(substr($frase[0],0)))).'"","","","","",""'; };

	echo '<br>';	echo '<br>#################################################################### Her følger Danske fraser uden prefix klar til Google translate:';	
	echo '<br>';	echo '<br>';
	foreach ($fraser as $frase) {if (strlen($frase[0])>3) echo '<br>'.trim(substr($frase[0],2),'"'); };
	echo '</p>';
	echo '<br>Ialt: '.count($fraser).' fraser i den sorterede liste. Længste frase er på '.$longest.' tegn.';
#	var_dump($GLOBALS['system']);
	phpinfo();
// ToDo: Dubletter fjernes, listen sortes og resultatet gemmes i fil.
?>
