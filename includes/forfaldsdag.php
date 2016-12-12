<?php      $DocFil= '../includes/forfaldsdag.php';   $DocVer='5.0.0';     $DocRev='2016-12-00';
// Formål:  Kalkulere forfaldsdato.
//             ___   _   _    ___  _
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___|
//
// 2016.12.00 ev - EV-soft
//

if (!function_exists('dkdato')) include("../includes/std_func.php");
	
if (!function_exists('forfaldsdag')) { 
	function forfaldsdag($fakturadate, $betalingsbet, $betalingsdage) {
		$betalingsbet=strtolower($betalingsbet);
		
		list($faktaar, $faktmd, $faktdag) = explode("-", $fakturadate);
		$forfaldsaar= $faktaar; 
		$forfaldsmd= $faktmd;
		$forfaldsdag= $faktdag;
		$slutdag= 31;

		if ($fakturadate && $betalingsbet!="efterkrav"  && $betalingsbet!="kontant") {
			while (!checkdate($forfaldsmd, $slutdag, $forfaldsaar)) {
				$slutdag--;
				if ($slutdag<27) break 1;
			}
			if ($betalingsbet!="netto") $forfaldsdag=$slutdag; # Saa maa det være lb. md
			$forfaldsdag= $forfaldsdag+$betalingsdage;
			while ($forfaldsdag>$slutdag) {
				$forfaldsmd++;
				if ($forfaldsmd>12) { $forfaldsaar++;   $forfaldsmd=1;  }
				$forfaldsdag= $forfaldsdag-$slutdag;
				$slutdag= 31;
				while (!checkdate($forfaldsmd, $slutdag, $forfaldsaar)) {
					$slutdag--;
					if ($slutdag<27) break 1;
				}
			}		 
		}
		return(dkdato($forfaldsaar."-".$forfaldsmd."-".$forfaldsdag));
	}
}
?>
