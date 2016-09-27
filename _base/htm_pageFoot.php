<?php		$DocFil= '../_base/htm_pageFoot.php';		$DocVer='5.0.0';		$DocRev='2016-08-00'; 	$modulnr=0;
	if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'');
//	Denne fil færdiggør en side, som er påbegyndt med ../_base/htm_pageHead.php
	echo '		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script><!-- SKAL indlæses før out_javascr.js! -->';
	echo '		<script src="../js/out_javascr.js"></script>';
	echo '		<script src="../js/pw-strength.js"></script>										<!--  PassWord-styrke måler -->';
	echo '		<script src="../js/4.3.0.dk.zxcvbn.js"></script>								<!--  PassWord-styrke måler -->';
	echo '		<!-- 			echo \'<script src="https://s.codepen.io/assets/libs/modernizr.js" type="text/javascript"></script>\'; -->';
	echo '		<script src="../js/pw-cleartext.js"></script>';
	echo '		<script src="../js/jquery.formnavigation.js"></script>';
	echo '		<script> $(document).ready(function () { $(".formnavi").formNavigation(); }); </script>';
	echo '	</body>';
	echo '</html>';
?>