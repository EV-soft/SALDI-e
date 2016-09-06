<?php			 $DocFil= '../_base/MainMenu.php';	 	$DocVer='5.0.0';		 $DocRev='2016-08-00';
// Formål:	Saldi's hovedmenu
//						 ___   _   _    ___  _
//						/ __| /_\ | |  |   \| |   ___ 
//						\__ \/ _ \| |__| |) | |__/ -_)
//						|___/_/ \_|____|___/|_|  \___|
//
// 2016.08.00 ev - EV-soft
//

	$pageTitl='Gitter-menu';
	include("../_base/htm_pageHead.php");	# Sidens indledende html-kode

		Rude_HovedMenu($regnskab='CSS-demo', $vis_finans=true, $vis_debitor=true, $vis_kreditor=true, $vis_prodkt=false, $vis_lager=true, $programSprog);	

	include("../_base/htm_pageFoot.php");	# Sidens afsluttende html-kode
?>