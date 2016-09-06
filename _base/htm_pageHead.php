<?php		$DocFil= '../_base/htm_pageHead.php';		$DocVer='5.0.0';		$DocRev='2016-08-00'; 	$modulnr=0;
	include_once("../_base/base_init.php");
	include_once("../includes/out_base.php");
	include_once("../includes/out_ruder.php");
	include_once("../includes/out_vinduer.php");
	include_once("../includes/std_func.php");
	include_once("../includes/msg_lib.php");
	global $pageTitl;
	# Side-start:
	echo '<!DOCTYPE html>';
	echo '<html lang="da" dir="ltr">';
	echo '<head>';
	echo '	<meta charset="UTF-8">';
	echo '	<title>'.$pageTitl.'</title>';
	echo '	<link rel="icon" type="image/png" sizes="32x32" href="../favicon-32x32.png">';
	echo '	<link rel="stylesheet" href= "http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" emne= "ICON-system">';
	echo '	<link rel="stylesheet" href= "../js/1.12.0/themes/base/jquery-ui.css" emne="jquery Dialog">';
	echo '	<link rel="stylesheet" href= "../css/meter-style.css" 	emne="PassWord-styrke måler">';	
	echo '	<link rel="stylesheet" href= "../css/out_style.css.php" emne="out-style">';
	echo '</head>';
	echo '<body>';
	if ($sprogTabl==null) {
		sprogDB_import();		$str= $_GET['sprog'];		if ($str) $programSprog=$str; /* else $programSprog='da';	/* ?sprog=da /en/de/fr/tr/es */
	}

	// Her placeres sidens indhold
	
	// Til slut skal indlæses: include("../_base/htm_pageFoot.php");
?>