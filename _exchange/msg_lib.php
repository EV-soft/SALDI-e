<?php
#include("../includes/htm_lib.php");		# 2016-02-05 - EV-soft

################################################# Popup Box-system ############################################################
#### Popup vindue med en farvekodet ramme, en Header-titel, en Besked-tekst, og 3 valg-knapper, som kan skjules efter behov ###
#### Alle nødvendige resurser er integreret i funktionen, så den er uafhængig af externe filer - jan2016:EV ###################
//	2015-01-25 EV - Tilføjet prefix på functionsnavn så syntaksvisning simplificeres.

function msg_PopBox ($head,$mess,$type='info',$boxleft='35%',$boxtop='35%') { // Eks: PopBox('Header','Besked','info');
# INIT: (Change as needed)
	$form_bg_color = '#FFF8DC';			$form_ramme_color = '#FF3333';			$frm_pos = 'left: '.$boxleft.';  top: '.$boxtop.';';
	$On = 'visibility: ;';	$Off = 'visibility: hidden;';	# Tilpas knao-synlighed herunder:
	if ($type=='info') {$knapClose = $On;	 $knapCancel = $Off;	$knapAccept = $Off;	$form_ramme_color = '#0000FF';	};	# '#0000FF' Blå 
	if ($type=='erro') {$knapClose = $On;	 $knapCancel = $Off;	$knapAccept = $Off;	$form_ramme_color = '#FF3333';	};	# '#FF3333' Rød
	if ($type=='mess') {$knapClose = $Off; $knapCancel = $Off;	$knapAccept = $On; 	$form_ramme_color = '#F0F0F0';	};	# '#F0F0F0' Grå
	if ($type=='warn') {$knapClose = $Off; $knapCancel = $Off;	$knapAccept = $On; 	$form_ramme_color = '#FF9900';	};	# '#FF9900' Orange / #FFFF00 Gul
	if ($type=='done') {$knapClose = $On;	 $knapCancel = $Off;	$knapAccept = $Off;	$form_ramme_color = '#4C9C5C';	};	# '#4C9C5C' Grøn 
	#$mess= htmlentities($mess,ENT_COMPAT,'UTF-8');
# CSS:	(don't change!)
	$KnapStyle = 'border: 1px #A9A9A9 solid; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; background-color: #F0F0F0; background: -moz-linear-gradient(bottom,#C0C0C0 0%,#F0F0F0 50%,#F0F0F0 50%,#C0C0C0 100%); background: -webkit-linear-gradient(bottom,#C0C0C0 0%,#F0F0F0 50%,#F0F0F0 50%,#C0C0C0 100%); background: -o-linear-gradient(bottom,#C0C0C0 0%,#F0F0F0 50%,#F0F0F0 50%,#C0C0C0 100%); background: -ms-linear-gradient(bottom,#C0C0C0 0%,#F0F0F0 50%,#F0F0F0 50%,#C0C0C0 100%);   background: linear-gradient(bottom,#C0C0C0 0%,#F0F0F0 50%,#F0F0F0 50%,#C0C0C0 100%); color: #000000; font-family: Arial; font-size: 13px;';	
#	ob_implicit_flush(true);
# CODE THAT NEEDS IMMEDIATE FLUSHING
	echo '<style type="text/css">';
	echo '#wb_PopupForm{ background-color: '.$form_bg_color.'; border: 4px '.$form_ramme_color.' solid; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px;	  -moz-box-shadow: 0px 0px 8px #000000; -webkit-box-shadow: 0px 0px 8px #000000; box-shadow: 0px 0px 8px #000000;}';
	echo '#wb_HeaderText { background-color: transparent; border: 0px #000000 solid; padding: 0; text-align: center;}';
	echo '#wb_HeaderText div{ text-align: center;}';
	echo '#Close_knap{'.$KnapStyle.'}';
	echo '#wb_MessageText { background-color: transparent; border: 0px #000000 solid; padding: 0; text-align: center;}';
	echo '#wb_MessageText div{ text-align: center;}';
	echo '#Cancel_knap{'.$KnapStyle.'}';
	echo '#GoOn_knap{'.$KnapStyle.'}';
	echo '#wb_uid1{ color: #000000; font-family: Arial; font-size: 13px;}';
	echo '#wb_MessageText{position: absolute; left: 17px; top: 35px; width: 220px;  height: 16px; text-align: center; z-index: 1;}';
	echo '#Cancel_knap{ position: absolute; left: 19px; top: 97px; width: 60px; height: 25px;  '.$knapCancel.' z-index: 3;}';
	echo '#wb_PopupForm{  position: fixed; '.$frm_pos.'  width: 252px; height: 128px;  z-index: 5;}';
	echo '#wb_HeaderText{ position: absolute; left: 18px; top: 8px; width: 220px; height: 16px; text-align: center; z-index: 0;}';
	echo '#GoOn_knap{ 	position: absolute; left: 175px;  top: 96px; width: 60px; height: 25px;  '.$knapAccept.' z-index: 4;}';
	echo '#Close_knap{  	position: absolute; left: 98px; top: 97px; width: 60px; height: 25px;  '.$knapClose. ' z-index: 2;}';
	echo '#wb_uid0{ color: #000000; font-family: Arial; font-size: 13px;}';
	echo '</style>';
# JAVA:	(don't change!)
	echo '<script type="text/javascript">';
	echo 'function PlaySound(a){a=eval("document."+a);try{a.Play()}catch(b){a.DoPlay()}}function OnGoMenuFormLink(a){var b=a.options[a.selectedIndex].value,c=a.options[a.selectedIndex].className;a.selectedIndex=0;a.blur();b&&(NewWin=window.open(b,c),window.NewWin.focus())}';
	echo 'function popupwnd(a,b,c,d,e,l,g,h,k,f,m){-1==h&&(h=screen.width/2-f/2);-1==k&&(k=screen.height/2-m/2);this.open(a,"","toolbar="+b+",menubar="+c+",location="+d+",scrollbars="+l+",resizable="+e+",status="+g+",left="+h+",top="+k+",width="+f+",height="+m)}function displaylightbox(a,b){b.padding=0;b.autoScale=!0;b.href=a;b.type="iframe";$.fancybox(b)}function ShowObject(a,b){var c=document.getElementById(a);c&&(c.style.visibility=b?"visible":"hidden")}';
	echo 'function MoveObject(a,b,c){if(a=document.getElementById(a))a.style.left=b+"px",a.style.top=c+"px"}function Rotate(a,b){$("#"+a).wwbrotate(b)}function SetImage(a,b){var c=document.getElementById(a);c&&(c.src=b)}function SetStyle(a,b){var c=document.getElementById(a);c&&(c.className=b)}';
	echo 'function Animate(a,b,c,d,e,l,g,h){var k="#"+a,f={};""!=b&&(f.left=b);""!=c&&(f.top=c);""!=d&&(f.width=d);""!=e&&(f.height=e);""!=l&&(f.opacity=l/100);0==a.indexOf("wb_")&&(a="#"+a.substring(3),$(a).stop().animate(f,g));""!=h&&(f.rotate=h);$(k).stop().animate(f,g)}function LoadValue(a,b,c){var d=document.getElementById(a);if(d&&(b=window[b+"Storage"])&&null!=b.getItem(a))switch(c){case 1:d.checked="true"==b.getItem(a);break;case 2:d.selectedIndex=b.getItem(a);break;default:d.value=b.getItem(a)}}';
	echo 'function StoreValue(a,b,c){var d=document.getElementById(a);if(d&&(b=window[b+"Storage"]))switch(c){case 1:b.setItem(a,d.checked);break;case 2:b.setItem(a,d.selectedIndex);break;default:b.setItem(a,d.value)}}function PlayAudio(a){(a=document.getElementById(a))&&a.play()}function PauseAudio(a){(a=document.getElementById(a))&&a.pause()}function StopAudio(a){if(a=document.getElementById(a))a.pause(),a.currentTime=0}';
	echo 'function ToggleHelper(a,b,c,d,e,l){b="#"+b;var g={},h,k="horizontal vertical left right up down".split(" ");for(i=0;6>i;i++)h=d.indexOf(k[i]),-1!=h&&(g={direction:k[i]},d=d.substring(0,h));"hidden"==$(b).css("visibility")&&($(b).css("display","none"),$(b).css("visibility",""));"undefined"!=typeof l&&(g.easing=l);1==a?0==e?$(b).toggle():$(b).toggle(d,g,e):""==d?c?$(b).css("display",""):$(b).css("display","none"):1==c?$(b).show(d,g,e):$(b).hide(d,g,e)}';
	echo 'function ShowObjectWithEffect(a,b,c,d,e){ToggleHelper(0,a,b,c,d,e)}function Toggle(a,b,c,d){ToggleHelper(1,a,1,b,c,d)}function ToggleStyle(a,b,c,d){a="#"+a;0==c?$(a).toggleClass(b):$(a).toggleClass(b,c,d)}function AnimationResume(a){if(a=document.getElementById(a))a.style.animationPlayState="running"}function AnimationPause(a){if(a=document.getElementById(a))a.style.animationPlayState="paused"};';
	echo '</script>';
# HTML:	(don't change!)
	echo '<div id="wb_PopupForm">';
	echo ' <form name="PopupForm" method="post" action="" enctype="text/plain" id="PopupForm">';
	echo '    <div id="wb_HeaderText"> <span id="wb_uid0"><strong>'.$head.'</strong></span></div>';
	echo '    <div id="wb_MessageText">  <span id="wb_uid1">'.				$mess.'</span></div>';
	echo '    <input type="button" id="Close_knap"  onclick="ShowObject(\'wb_PopupForm\', 0);return false;" name="Close_knap" value="Luk">';
	echo '    <input type="button" id="Cancel_knap" onclick="ShowObject(\'wb_PopupForm\', 0);return false;" name="Cancel_knap" value="Fortryd">';
	echo '    <input type="button" id="GoOn_knap" 	onclick="ShowObject(\'wb_PopupForm\', 0);return false;" name="GoOn_knap" value="Fortsæt">';
	echo ' </form>';
	echo '</div>';
#	ob_implicit_flush(false);
}

################################################# Dialog Box-system ###########################################################
#### Et flyt/stræk-bart dialog vindue med en Header-titel, en Besked-tekst, og 2 valg-knapper, som kan skjules efter behov  ###
## For hver knap kan angives en funktion der skal afvikles, ved tryk på knappen (eller funktionen kan returnere et resultat) ##
#### Funtionen er afhængig af externe js/css-filer. samt icon-filer - de er samlet i en fil: css_dialog.zip - feb2016:EV ######
## js og css-filer skal anbringes i: ../javascript og iconfiler i: ../javascript/images							SOURCE: http://jqueryui.com/

function msg_Dialog ($modal='false', $WinW='200', $WinH='200',  $Knap1_title='Godkend', $Knap1_function='$(this).dialog("close")',
	$Knap2_title='Fortryd',$Knap2_function='$(this).dialog("close")',$title='Flytbart Dialog-vindue',$messg='',$bgcolr='#F4FFF4',$titlcolr= '#ffffff') {
 # INIT: (Change as needed)
#	'modal: true|false,';
	$plac = '{ modal: '.$modal.', width: '.$WinW.', height: '.$WinH.', position: { my: \'center top\', at: \'center top+20\', of: window }';
	if ($messg=='') $messg="Dette vindue kan frit flyttes ved at holde i overskriften og trække det til en anden placering.<br>Det kan også frit ændre størrelse, ved at trække i kanterne.<br>Er vinduet for lille til at vise indholdet, vises rulleknapper automatisk.";
#	Knap1 placeret i midten. Den skjules hvis dens title==''
# Knap2 placeret til højre. Den skjules hvis dens title==''
#	$messg = iconv("UTF-8", "Windows-1252//TRANSLIT", $messg);

# CSS:	(don't change!)
	echo '<link href="../javascript/jquery.ui.all.css" rel="stylesheet" type="text/css">';	# Bemærk placering i under-mappe: saldi !
	echo '<style type="text/css">';
	echo '.ui-widget{ font-size: 1em !important;}';
	echo '.ui-dialog{ padding: 2px 4px 2px 4px;}';
	echo '.ui-dialog .ui-dialog-title{ font-family: Arial; font-weight: normal; font-size: 12px; font-style: normal; color: '.$titlcolr.';}';
	echo '.ui-dialog .ui-dialog-titlebar{ padding: 4px 10px 4px 10px;}';
	echo '.ui-dialog .ui-dialog-titlebar-close{ right: 6px;}';
	echo '.ui-dialog .ui-dialog-buttonpane{ padding: 0;  margin: 0;}';
	echo '.ui-dialog .ui-dialog-buttonpane BUTTON{ padding: 4px 8px 4px 8px;}';
	echo '.ui-button-text-only .ui-button-text{ padding: 0; margin: 0; font-family: Arial; font-weight: normal; font-size: 12px; color: #222222;}';
	echo '#dialogTable1{ border: 0px #C0C0C0 solid; background-color: transparent; border-spacing: 0px;}';
	echo '#dialogTable1 td{ padding: 2px 2px 2px 2px;}';
	echo '#dialogTable1 td div{ white-space: nowrap;}';
	echo '#dialogTable1 .cell0{ background-color: '.$bgcolr.'; text-align: left; vertical-align: top; height: 97.8%;}';
	echo '#css_Dialog{ z-index: 88;}';
	echo '#dialogTable1{ position: absolute; left: 2px; top: 2px; width: 99%; height: 99%; z-index: 99;}';
	echo '#wb_uid0{ color: #000000; font-family: Arial; font-size: 13px; line-height: 16px;}';
	echo '</style>';

# JAVA:	(don't change!)
	echo '<script type="text/javascript" src="../javascript/jquery-1.11.1.min.js"></script>';
	foreach (array('core','widget','mouse','button','draggable','position','resizable','dialog') as $felt) 
		{echo '<script type="text/javascript" src="../javascript/jquery.ui.'.$felt.'.min.js"></script>';};
# HUSK: disse scripts er afhængge af tilhørende css- og icon-filer, som skal befinde sig i/under mappen javascript!
	echo '<script type="text/javascript"> $(document).ready(function() { var css_DialogOpts =  ';
#	echo ' { modal: true, width: 200, height: 200, position: { my: \'center top\', at: \'center top+20\', of: window },';
	echo ' '. $plac. ',';	# denne linie erstatter ovenstående originale linie, så placeringer kan justeres !
	echo ' buttons: {"'.$Knap1_title.'": function() {'.$Knap1_function.'; }, "'.$Knap2_title.'": function() {'.$Knap2_function.'; } },';
	echo ' resizable: true,  draggable: true,  closeOnEscape: true, autoOpen: true	';
	echo ' };	';
	echo ' $("#css_Dialog").dialog(css_DialogOpts); });';
	echo '</script>	';

# HTML:	(don't change!)
	echo '<div id="css_Dialog" title="'.$title.'">';
	echo ' <table cellpadding="2" cellspacing="0" id="dialogTable1">';
	echo ' <tr>  <td class="cell0"><span id="wb_uid0">'.$messg.'</span></td> </tr>';
	echo ' </table>';
	echo '</div>  ';
	return $result;
}

################################################# ToolTip-system ############################################################
## En popup besked som fremkommer når musen holdes over en lille cirkulær 'Knap' som anbringes ved siden af et felt/tekst  ##
#### Funtionen er afhængig af externe js/css-filer. samt icon-filer - de er samlet i en fil: css_tooltip.zip - feb2016:EV ###

function msg_ToolTip ($KnapIx='0', $TipTxt='Her er et tip til dig!') { $PosX= 55; $PosY= 145;
	#	Under udvikling! : Styre placering i table?		Vise ToolTip? 	Konflikt med msg_Dialog!
#	if ($KnapIx>99) {$TipTxt= htm_TxtOpslg($KnapIx)};
	echo '<link href="../css/jquery.ui.all.css" rel="stylesheet" type="text/css">';
	echo '<style type="text/css">';
	echo '.ui-tooltip{padding: 4px 4px 4px 4px;}';
	echo '#wb_tipShp'.$KnapIx.' a img{ position: absolute;}';
	echo '#wb_tipShp'.$KnapIx.' span{ position: absolute;}';
	echo '#wb_tipShp'.$KnapIx.' a .hover{ visibility: hidden;}';
	echo '#wb_tipShp'.$KnapIx.' a:hover .hover{ visibility: visible;}';
	echo '#wb_tipShp'.$KnapIx.' a:hover span{ visibility: hidden;}';
	echo '#tooltipShape1{ border-width: 1;}';
	echo '#tooltipShape1{ width: 16px; height: 16px;}';
	echo '#wb_tipShp'.$KnapIx.'{ position: absolute; left: '.$PosX.'px; top: '.$PosY.'px; width: 17px; height: 15px; z-index: 1;';
	echo '}';
	echo '#wb_uid0{ border-width: 0; width: 17px; height: 15px;}';
	echo '</style>';

	echo '<script type="text/javascript" src="../javascript/jquery-1.11.1.min.js"></script>';
	echo '<script type="text/javascript" src="../javascript/jquery.ui.core.min.js"></script>';
	echo '<script type="text/javascript" src="../javascript/jquery.ui.widget.min.js"></script>';
	echo '<script type="text/javascript" src="../javascript/jquery.ui.position.min.js"></script>';
	echo '<script type="text/javascript" src="../javascript/jquery.ui.tooltip.min.js"></script>';
	echo '<script type="text/javascript"> ';
	echo ' $(document).ready(function()';
	echo ' {';
	echo '    var tooltipjQueryToolTip1Opts =';
	echo '    { hide: true, show: true, content: \'<span style="color:#000000;font-family:\'MS Shell Dlg\';font-size:11px;">'.$TipTxt.'</span>\',';
	echo '     items: \'#wb_tipShp'.$KnapIx.'\',  position: { my: "right bottom", at: "left top", collision: "flipfit" }';
	echo '    };';
	echo '    $("#wb_tipShp'.$KnapIx.'").tooltip(tooltipjQueryToolTip1Opts);';
	echo ' });';
	echo '</script>';

	echo ' <div id="wb_tipShp'.$KnapIx.'">';
	echo '  <a href=""><img class="hover" src="../javascript/images/img0003_hover.png" alt="" id="wb_uid0"><span><img src="../javascript/images/img0003.png" id="tooltipShape1" alt=""></span></a>';
	echo ' </div>';
}
?>
