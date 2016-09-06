<?php			 $DocFil= '../_finans/test.php';	 	$DocVer='5.0.0';		 $DocRev='2016-08-00';
// Formål:	Test af side-generering																															# Oplysning om filens hovedformål
//						 ___   _   _    ___  _
//						/ __| /_\ | |  |   \| |   ___ 
//						\__ \/ _ \| |__| |) | |__/ -_)
//						|___/_/ \_|____|___/|_|  \___|
//

	include("../_base/htm_pageHead.php");	# Sidens indledende html-kode

		sprogDB_import();
		$str= $_GET['sprog'];		if ($str) $programSprog=$str; else $programSprog='da';	# ?sprog=da /en/de/fr/tr/es
		Rude_HovedMenu($regnskab='CSS-demo', $vis_finans=true, $vis_debitor=true, $vis_kreditor=true, $vis_prodkt=false, $vis_lager=true, $programSprog);	

	include("../_base/htm_pageFoot.php");	# Sidens afsluttende html-kode

?>