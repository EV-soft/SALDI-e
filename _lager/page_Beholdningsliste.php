<?php			 $DocFil= '../_lager/page_Beholdningsliste.php';	 	$DocVer='5.0.0';		 $DocRev='2016-08-00';
// Form�l:	Kald til Beholdningsliste
//						 ___   _   _    ___  _
//						/ __| /_\ | |  |   \| |   ___ 
//						\__ \/ _ \| |__| |) | |__/ -_)
//						|___/_/ \_|____|___/|_|  \___|
//

	$pageTitl='Beholdning';
	include("../_base/htm_pageHead.php");	# Sidens indledende html-kode
		
	Rude_Beholdningsliste();	

	include("../_base/htm_pageFoot.php");	# Sidens afsluttende html-kode
?>  