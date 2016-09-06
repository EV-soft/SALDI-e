<?php			 $DocFil= '../includes/msg_lib.php';	 	$DocVer='5.0.0';		 $DocRev='2016-08-00';
//	Dialog system baseret på CSS og jquery
//						 ___   _   _    ___  _	       
//						/ __| /_\ | |  |   \| |   ___ 
//						\__ \/ _ \| |__| |) | |__/ -_)
//						|___/_/ \_|____|___/|_|  \___|
//						                               
//
// 2016.08.00 ev - EV-soft

// Popup vindue med en farvekodet baggrund, en Header-titel, en Besked-tekst, og 3 valg-knapper, 
// som kan skjules efter behov. Vinduet popper op i aktuelt vindue i modal-mode.
// Der er predefineret disse farve-typer: error, info, warn, tip, success og med tilhørende prefix i headeren.
// Angives en farvekode i $BgColr-parameteren benyttes denne, og prefix undlades i headeren.

# Test:	msg_Dialog('error','Godkend','$(this).dialog("close")','Fortryd','$(this).dialog("close")','','','Funktions problem','Funktionen: dialog("close") virker i test, men når msg_Dialog kaldes inde fra SALDI, sker der intet!');


#	TEST:	
//	msg_Dialog ('info',
//					 'Godkend','$(this).dialog("close")',
//					 'Fortryd', 	'$(this).dialog("close")',
//					 '3. knap', 	'$(this).dialog("close")',
//					 'Funktions problem',
//					 'Funktionen: dialog("close") virker i test, men når msg_Dialog kaldes inde fra SALDI, sker der intet!'.
//					 '<br>Du kan flytte og ændre størrelse på dette besked-vindue. Det tilpasser selv nødvendig størrelse, og det placeres centralt i vinduet.');

//	msg_Dialog('warn','Fortsæt','$(this).dialog("close")',$Knap2_title='','','','','Saldi Dialog',$messg='');
function msg_Dialog ($BgColr= 'error',	
	$Knap1_title='Godkend',	$Knap1_function='$(this).dialog("close")',	/* Uløste Problemer: */
	$Knap2_title='Fortryd',	$Knap2_function='$(this).dialog("close")',	/* Funktion virker ikke ved kald fra SALDI-vinduer */
	$Knap3_title='',				$Knap3_function='$(this).dialog("close")',      	
	$title='Saldi Dialog',	$messg='') 
{

//	DOKUMENTATION: http://api.jqueryui.com/dialog/
# INIT: (Change as needed)
	$result= false;	# Return værdi kan ændres med programmering.
	$width= '';	#'360px';
	if ($messg=='') $messg='<p>Dette er en CSS baseret modal dialog, som kan benyttes til at vise information. '.
			'Vinduet kan flyttes og strækkes, samt lukkes med \'x\' icon. <br>'.
			'<br>Knapperne forneden kan programmeres, med valgfri kode.</p>';
# CODE:	(don't change!)
switch (strtolower($BgColr)) {	# TEMA-farver og Titel-prefix:
    case "error"	:	$headcolr= '#FF8888';	$pref= 'Fejl: '; 			break;
    case "info"		:	$headcolr= '#BDE5F8';	$pref= 'Info: '; 			break;
    case "warn"		:	$headcolr= '#FEEFB3';	$pref= 'Advarsel: '; 	break;
    case "tip"		:	$headcolr= '#88ff22';	$pref= 'Tip: ';				break;
    case "success":	$headcolr= '#DFF2BF';	$pref= 'Hurra: '; 		break;
		default:  $headcolr= $BgColr; $pref= ''; 
}	
# Support-filer:
//	echo '  <link rel="stylesheet" href="../js/1.12.0/themes/base/jquery-ui.css">';
//	echo '  <script src="../js/1.12.0/external/jquery/jquery.js"></script>';
//	echo '  <script src="../js/1.12.0/jquery-ui.js"></script>';
# Spec.Style:
	echo '<style type="text/css">';
	echo '	.ui-dialog .ui-dialog-titlebar 		{ background: '.$headcolr.'; width: '.$width.';}';
	echo '	.ui-dialog .ui-dialog-buttonpane 	{ background: '.$headcolr.'; width: '.$width.';}';
	# Hvis 3 knapper: Forøg bredden fra standard 300px til 360px:
	echo '	ui-dialog .dialog-content	 .ui-widget-content	  	{ width: '.$width.';}';
	echo '	ui-button ui-corner-all ui-widget ui-button-icon-only ui-dialog-titlebar-close	{ title: "Luk";}';
/* 	
	<div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix">
		<div class="ui-dialog-buttonset">
			<button type="button" class="ui-button ui-corner-all ui-widget">Godkend</button>
			<button type="button" class="ui-button ui-corner-all ui-widget">Fortryd</button>
			<button type="button" class="ui-button ui-corner-all ui-widget">3. knap</button>
	</div></div>
 */	
	echo '</style>';
# Func-script:
	echo '  <script>';
	echo '  $( function() {  $( "#dialog-message" ).dialog({';
	echo '      modal: true,';
	echo '      buttons: {';
	if ($Knap1_title) echo 	'"'.	$Knap1_title.'": function(){ '.$Knap1_function.'; }';	# Primær knap!
	if ($Knap2_title) echo ',"'.	$Knap2_title.'": function(){ '.$Knap2_function.'; }';	# Kun som 2. knap
	if ($Knap3_title) echo ',"'.	$Knap3_title.'": function(){ '.$Knap3_function.'; }';	# Kun som 2. ell. 3. knap
	echo '      }';
	echo '    }); } );';
	echo '  </script>';
	echo '<div id="dialog-message" title="'.$pref.$title.'"> '.$messg.' </div>';
	return $result;
}
?>
