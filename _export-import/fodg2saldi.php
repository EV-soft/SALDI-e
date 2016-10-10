<?php
//	fodg2saldi.php - Tolkning af LO:Flat-file, angående udtrækning af data til formulardesign i SALDI. {EV-soft}
//	2015-01-25 EV - Tilføjet prefix på alle functionsnavne så syntaksvisning simplificeres.
//	2015-04-02 EV - Rettet de fleste fejl.
//	2015-04-29 EV - Tilføjet konvertering af binære billed data til jpg/png/gif-filer
//	2015-04-30 EV - Fjernet forældede kommentarer m.v.

include("../includes/msg_lib.php");	#apr2016:EV#

global $doc; $xpath;
$doc = new DOMDocument();
$doc->preserveWhiteSpace = false;	// We don't want to bother with white spaces
$doc->recover = true;
$SourceFile = "Saldi_formularer.fodg";
$ViewBuff= "<br>|";
$DataBuff= "|";
$debug1 = false;	# Vis data under opbygning af tekster
$debug2 = false;	# Vis data under opbygning af linier
$debug3 = false;	# Vis indholdet i DataBuff som benyttes til "Output"
$visTabel= true;	# Vis på skærsm, indholdet svarende til det i eksport-fil
$k=0;

if (file_exists($SourceFile)) {
#	msg_PopBox('OK:','Input-filen: <b>'.$SourceFile.'</b> bearbejdes.','mess');
	$doc->load($SourceFile);	$xpath = new DOMXPath($doc);	imp_ScanXMLfile(); 
	} 
else {
	echo "<b>FEJL: $SourceFile ikke fundet!</b>";
	msg_PopBox('Fil FEJL:','Input-filen: <b>'.$SourceFile.'</b> kan ikke findes/åbnes.','erro');
	}

function imp_ScanXMLfile () { global $doc, $ViewBuff, $DataBuff, $element, $LagPrefix, $debug1, $debug2;
  $FormNumr= 0;
	foreach ($doc->getElementsByTagName('page') as $dokside) { 
		$FaneNavn= $dokside->getAttribute('draw:name'); 
		if ($debug1) echo '<br><font color="brown">'.$FaneNavn.'</font><br>';
		$FormNumr = trim(substr($FaneNavn,0,3),'[]') * 1;
		
		if (($FormNumr>0) and ($FormNumr<=14))	#if (($FaneNavn=='[2] Ordrebekræftelse') or ($FaneNavn='[4] Faktura'))
		foreach (array ('custom-shape','frame'/* ,'line','name','style-name','text-style-name' */) as $TagName)
		foreach ($dokside->getElementsByTagName($TagName) as $element) 
		{
			$LagNavn  = $element->getAttribute('draw:layer');		
			$LagPrefix = substr($LagNavn,0,3);	if ($LagPrefix and ($debug1)) echo '<br><br>'.$k++.' <i>'. $LagPrefix. '</i>';
			$NodePref = $element->prefix;       #	draw:						#					<draw:page draw:name="[2] Ordrebekræftelse" - SideNavn: FormNumr
			$NodeName = $element->localName;		#	page            #	<draw:custom-shape draw:name="MAIL_BESKED" 					- Shapenavn: 
			$NodeValu = $element->nodeValue;
			if (	# FILTER:
				((($LagPrefix == '[A]')	or ($LagPrefix == '[1]')	or ($LagPrefix == '[S]')	or ($LagPrefix == '[!S') or ($LagPrefix == '[M]'))
				and ($NodePref == 'style') 	and ($NodePref == 'form'))
				or (($NodeName == 'custom-shape') OR ($NodeName == 'frame')
				or ($NodeName == 'line') or ($NodeName == 'page') or ($NodeName == 'name'))
				and ($LagNavn != 'layout') and ($LagNavn != 'measurelines') and ($NodeName != 'config-item') and ($NodeName != 'binary-data') 
			)
			{
				if (true)	#	(strlen($NodeValu) <= 299) # Ikke binære data
					{	$DataBuff .= "<br>|";
						imp_Collect('page',trim($FormNumr,'[]'));
						if ($LagPrefix == '[M]') # Mail-tekster
						imp_Collect('_art','5');	else
						imp_Collect('_art','2');	# Default
						imp_Collect('valu',$element->nodeValue);
					}
				if ($debug1)	echo ' Element: <i>', $NodePref, ':',$NodeName,' # ',$FormNumr, '</i><b> ', //'<font color="red">',$LagNavn,'</font> ',
													'[', substr($NodeValu,0,222), "]</b> Attr: "; 
				imp_Getit($element, 'draw:layer');          	//	LagNavn
				imp_Getit($element, 'svg:width');           	//	Feltbredde
				imp_Getit($element, 'svg:height');          	//	Felthøjde
				imp_Getit($element, 'svg:x');               	//	'$xa' - generelt
				imp_Getit($element, 'svg:y');               	//	'$ya' - generelt
				imp_Getit($element, 'svg:x1');              	//	'$xa' - linier
				imp_Getit($element, 'svg:y1');              	//	'$ya' - linier
				imp_Getit($element, 'svg:x2');              	//	'$xb' - linier	(ell. tekstlængde)
				imp_Getit($element, 'svg:y2');              	//	'$yb' - linier	(ell. teksthøjde)
				imp_Getit($element, 'draw:style-name');     	//	For "opslag i style-tabel: gr##"	(grafisk-style)
				imp_Getit($element, 'draw:text-style-name');	//	For "opslag i style-tabel: P##"		(paragraf-style)
				imp_Getit($element, 'text:style-name');     	//	For "opslag i style-tabel: T##"		(textfont-style)	
				imp_Getit($element, 'style:name');          	//	<style:style style:name="gr39" style:family="graphic" style:parent-style-name="standard">
				imp_Getit($element, 'style:style');         	//	
				imp_Getit($element, 'style:font-name');     	//	
				imp_Getit($element, 'fo:font-size');        	//	'$yb' -  teksthøjde
				imp_Getit($element, 'fo:text-align');       	//	?Justering V / C / H	:	start / center / end 
				imp_Getit($element, 'draw:fill-color');     	//	
				imp_Getit($element, 'draw:stroke');         	//	
				imp_Getit($element, 'draw:stroke-dash');    	//	
				imp_Getit($element, 'draw:textarea-horizontal-align');		//	?Justering V / C / H
				imp_Getit($element, 'draw:frame');						// Indeholder tekst-boxe samt diverse andre objekter!
				imp_Getit($element, 'draw:text-box');				
				imp_Getit($element, 'draw:page');							// <draw:page draw:name="[5] Kreditnota" 
				imp_Getit($element, 'draw:name');            	// <draw:frame draw:name="LOGO"
				imp_Getit($element, 'draw:line'); //draw:style-name="gr43" draw:layer="[A] Alle sider" svg:x1="0.413cm" svg:y1="25.535cm" svg:x2="2 0.772cm" svg:y2="25.535cm">
				imp_Getit($element, 'text:p');               
				imp_Getit($element, 'text:span');            	// <text:span text:style-name="T25">$ordre_betalingsbet $ordre_betalingsdage dage</text:span>
		//	'style:family');    'draw:stroke');
		//	'draw:width');						//	svg:stroke-width="0.053cm" 				[linjer: stregtykkelse]
		//	'svg:stroke-color');  		//	svg:stroke-color="#999999" m.mange fl.			[=>Color(integer): Farve]
		//	'draw:fill');				'fo:min-height');
		//	'fo:padding-left');	'fo:padding-right');	'fo:text-indent');	'style:text-autospace');	'fo:font-weight');
			}
  }}
#if ($debug1)	{echo '<br>';  echo $ViewBuff;  echo '<br>';	echo ': : :';}	#if ($debug2)	 {echo '<br>';	echo $DataBuff;  echo '<br>';}
	# LINIER:
	imp_LineLookup('[1] Kun forside');
	imp_LineLookup('[A] Alle sider');
	imp_LineLookup('[!S] Ikke sidste');
	imp_LineLookup('[S] Kun sidste');
#	imp_LineLookup('[M] Mail Tekster');
	imp_MakeTable($DataBuff);
#	imp_Search('draw:page','draw:line',"[A] Alle sider");
#	if ($debug2)	 {echo '<br>';	echo $DataBuff;  echo '<br>';}
}

####### Subrutiner: 
	
function imp_Add2View($ElemNode, $ElemAttr) {global $ViewBuff; 
	$ViewBuff.= '<font color="red">'. '|'. $ElemNode. '|'. $ElemAttr. '</font>';};

function imp_Collect($Iden,$felt) {global $DataBuff; 
	$DataBuff.= $Iden.':'. $felt. '|';};

function imp_Getit ($element, $ElemNode) { global $LagPrefix,$debug1;
	$ElemAttr = $element->getAttribute($ElemNode);	$Ea1 = substr($ElemAttr,0,1);	$Ea2 = substr($ElemAttr,0,2);	$Ea3 = substr($ElemAttr,0,3);
	if ($ElemAttr) {
		if ($debug1)	echo " [", $ElemNode, ": <i><b>", substr($ElemAttr,0,80), "</b></i>]";	// Output til skærm max. 80 tegn
		if (($Ea1 == 'P') or ($Ea1 == 'T') or ($Ea2 == 'gr') ) 	{	imp_StyleLookup($ElemAttr);	}		// style:name=: Pxx, Txx, grxx
		switch ($ElemNode) {
		case 'draw:name'						:	imp_Collect('navn',$ElemAttr);		break;
		case 'draw:layer'						:	imp_Collect('dlay',$ElemAttr);		break;	#	Lag med streger
		case 'draw:style-name'			:	imp_Collect('dsty',$ElemAttr);		break;
		case 'draw:text-style-name'	:	imp_Collect('tsty',$ElemAttr);		break;	// cm
		case 'svg:width'						:	imp_Collect('widt',$ElemAttr);		break;	// cm
		case 'svg:height'						:	imp_Collect('hght',$ElemAttr);		break;	// cm
		case 'svg:x'								:	imp_Collect('xpos',$ElemAttr);		break;	// cm
		case 'svg:y'								:	imp_Collect('ypos',$ElemAttr);		break;	// cm				#	'text:style-name'	<text:span text:style-name
		default											:	imp_Collect('zzzz',$ElemAttr);	
		}
	}	return "";
}

function imp_StyleLookup ($name)	{	global $doc, $xpath, $debug1;	//	echo '<br>~~~~~~~~~~';	echo '<br>';
	$query = '/office:document/office:automatic-styles/style:style[@style:name="'.$name.'"]';	
	$entries = $xpath->query($query);
	foreach ($entries as $entry) {
		if ($debug1)	echo "-> STYLE: ". 
			'Style-Family: <font color="red">'. $entry->getAttribute('style:family'). '</font> '.		
			'Style-Name: <font color="red">'. $entry->getAttribute('style:name'). '</font> ';	
			imp_AddStyle($entry, 'style:font-name');
			imp_AddStyle($entry, 'fo:color');				
			imp_AddStyle($entry, 'fo:text-align');	
			imp_AddStyle($entry, 'fo:font-size');	  
			imp_AddStyle($entry, 'fo:font-style');		//	fo:font-style="italic" fo:font-weight="bold" fo:color="#ff0000"
			imp_AddStyle($entry, 'fo:font-weight'); 
			imp_AddStyle($entry, 'draw:fill');	    
			imp_AddStyle($entry, 'draw:fill-color');
			imp_AddStyle($entry, 'svg:stroke-width'); 
			imp_AddStyle($entry, 'svg:stroke-color');
			imp_AddStyle($entry, 'loext:graphic-properties');	 
			imp_AddStyle($entry, 'style:paragraph-properties');
			imp_AddStyle($entry, 'style:style');	
			imp_AddStyle($entry, 'style:text-properties');
	}
}

function imp_AddStyle ($entry, $flag) { global $debug1;
	if ($debug1)	echo ' ¤: '. $entry->childnode->tagName;
	foreach ($entry->childNodes as $child) { $ChildAttr = $child->getAttribute($flag);
		if ($ChildAttr) {	
			if ($debug1)	echo $flag. '= <font color="red">'. $ChildAttr. '</font>    ';
			if (strlen($ChildAttr)) {						# imp_Add2View('$flag. '~'. $ChildAttr');
				if ($flag=='fo:text-align') {			# fo:text-align~start/center/end	
					if ($ChildAttr == 'start') 			imp_Collect('alig','V');	
					if ($ChildAttr == 'center')			imp_Collect('alig','C');	
					if ($ChildAttr == 'end') 				imp_Collect('alig','H');	}
				if ($flag=='style:font-name') {	# style:font-name~Arial Narrow1		(Helvetica/Times)
					if (strpos($ChildAttr,'Times')) imp_Collect('font','Times');
																	else 		imp_Collect('font','Helvetica');	}	
				if ($flag=='fo:color') 			 			imp_Collect('colo',$ChildAttr);	# fo:color
				if ($flag=='fo:font-size') 	 			imp_Collect('size',$ChildAttr);	# fo:font-size~xxpt
				if ($flag=='fo:font-style')	
					{if ($ChildAttr == 'italic') 		imp_Collect('ital','on');	}# fo:font-style attribute: normal/italic/oblique.
				if ($flag=='fo:font-weight')	
					{if ($ChildAttr == 'bold')  		imp_Collect('weig','on');	}# fo:font-weight~normal/bold/?? 
				if ($flag=='draw:fill-color')	 		imp_Collect('fill',$ChildAttr);	# draw:fill-color #00ff00
				if ($flag=='svg:stroke-color') 		imp_Collect('stro',$ChildAttr);	# linie-color
				if ($flag=='svg:stroke-width') 		imp_Collect('lwdt',$ChildAttr);	# linie-width
}	}	}	}

function imp_MakeTable ($DataBuff) { global $SourceFile, $debug1, $debug3;
	function quote($f) {	return "'".$f."'";};
	
	#$OutFn = "formular.txt";	# Kun ved test! Overskrivning af systemfilen: importfiler/formular.txt
	$OutFn = "formularer.tab";		# før: mar2016:	$OutFn = "../logolib/tabfile.txt";
	echo ' På basis af filen: <b>'.$SourceFile.'</b>, dannes en fil: <b>'.$OutFn.'</b> med formular-data, til import i SALDI.';
	
	$linier = (explode("<br>",$DataBuff));	$i = 0;		$sep = chr(9);	$OutStr = '';	
	echo " <meta charset='UTF-8'> <table width=\"98%\" align=\"center\" height=\"10%\" border=\"1\" cellspacing=\"1\" cellpadding=\"2\"><tbody>";
	echo "<tr><td>Id</td><td>Form</td><td>Art</td><td align=\"center\">Beskrivelse</td><td>Just</td><td>xa</td><td>ya</td> <td>xb</td><td>yb</td><td>Str</td><td>Color</td><td>Font</td><td>Fed</td><td>Kursiv</td><td>Side</td><td>Sprog</td></tr>";
	foreach ($linier as $linie) {	$Gy0= 0;
		if ((strpos($linie,'[1]')) or (strpos($linie,'[A]')) or (strpos($linie,'[S]')) or (strpos($linie,'[!S')) or (strpos($linie,'[M]')) or (strpos($linie,'[B]')))	
			{	$i++; 
			if ($debug3)	echo '<br><font color="blue">'.$linie.'</font>';
			$just='';		$fed='';		$font='';		$color= '';		$ital='';			if ($debug3)	echo '<br> ';
			$xa = '';	$xb = '';	$ya = '';	$yb = '';		$VareTopx= '';	
/* 1	 2	 			3	 		4	 						5	 					6	 		7	 		8	 		9			10			11			12		13			14	  	15		16	 '
	ID	$formular	$art	$beskrivelse $just		$xa   $ya   $xb   $yb   $str   $color  $font  $fed   $kursiv  $side	$sprog				
	'|valu:'		'|widt:'		'|heig:'		'|x:'		'|y:'		'|x1:'		'|y1:'		'|x2:'		'|y2:'		
	'|styl:'		'|font:'		'|colo:'		'|size:'		'|text:'		'|alig:'		 */
			$form	= imp_from($linie, 'page:');
			$beskrivelse = imp_from($linie,'|valu:');	
			$test = $beskrivelse;
			if ($form== '[M] Mail Tekster') $art	= 5;		else $art	= imp_from($linie,'|_art:');
			if ($form== '[B] Billeder') $art	= 6;
			foreach (array	#	ORDRELINIER:
				('@posnr','@varenr','@antal','@enhed','@beskrivelse','@pris','@rabat','@momssats','@linjemoms','@varemomssats','@linjesum','@projekt','@procent',
				'@generelt linie1','@generelt linie2','@generelt linieMax')
			as $felt) if ($felt==$test) {$art= '3'; 	$beskrivelse = ltrim($beskrivelse,'@');};
			
			#	KOORDINATER:			#	LO:	x,y		(line:) x1,y1		x2,y2		SALDI: xa,ya   xb,yb 
			$x0 = imp_from($linie,'|xpos:');	if ($x0!='') {$xa= rtrim($x0,'cm'); if ($art=='3') $generelt_ya= $xa;}
			$x0 = imp_from($linie,'|widt:');	if ($x0!='') {$xb= rtrim($x0,'cm'); }	#	FeltBredde
			# Linier:			
			$x1 = imp_from($linie,'|x1:');		if ($x1!='')  $x1= rtrim($x1,'cm');
			$x2 = imp_from($linie,'|x2:');		if ($x2!='')  $x2= rtrim($x2,'cm');
			
			$y0 = imp_from($linie,'|ypos:');	if ($y0!='')  $ya= rtrim($y0,'cm');
			$y0 = imp_from($linie,'|hght:');	if ($y0!='') {$yb= rtrim($y0,'cm'); $FeltHgt= $yb-0.2;}	#	FeltHøjde
			# Linier:			
			$y1 = imp_from($linie,'|y1:');		if ($y1!='')  $y1= rtrim($y1,'cm');
			$y2 = imp_from($linie,'|y2:');		if ($y2!='')  $y2= rtrim($y2,'cm');
			
			$just= ltrim(imp_from($linie,'|alig:'),'J=');
			if (!$just) $just='V';			#	Uspecficeret justering sættes til Venstre!
			if ($just=='H') {$xa= $xa + $xb;};
			if ($just=='C') {$xa= $xa + $xb/2;};
			
			$str= imp_from($linie,'|size:');	
			if (($str=='') and ($beskrivelse==''))	#	Streger har ikke en 'size', men det kan simple tekster også mangle!
				{	$str	= imp_from($linie,'|lwdt:');	$art= 1; 
					$str	= rtrim($str,' cm'); 
					$str= (imp_KoorConv($str*100,'X')/100).' mm';	#	LinieBredde
				} 
				else	{
					if (!$str) $str= 8;		#	Uspecficeret teksthøjde sættes til 8 pt!
					$str	= rtrim($str,' pt').' pt'; 
				}
			
			$color = imp_from($linie,'|colo:');
			if (!$color and ($art== 1)) {$color = imp_from($linie,'|stro:'); }	 # Linie-farve
			if (!$color) {$color = '0';} else $color= strtoupper($color);			#	Evt. Uspecficeret farve sættes til sort!
			$decColor= colorhex2rgb($color);			# $color.'/D:'.colorhex2rgb($color);
			$font 	= imp_from($linie,'|font:'); #	if ((!$font) and (($art==2) or ($art==3))) $font='Helvetica';	#	Uspecficeret font sættes til helvetica!
			$fed  	= imp_from($linie,'|weig:'); 
			$kursiv = imp_from($linie,'|ital:');
			$side		= imp_from($linie,'|dlay:');		$side	= trim(substr($side,0,4),'dlay:[ ]'); # Side i SALDI er et lag i LO 
			$sprog 	= 'Dansk';
			
			#ORDRELINIER generelt:
			if (($art==3) and (strpos($linie,'generelt'))) {	#	Art:3 "generelt"  Vare-LinieAntal = $generelt_xa	(= 34)		1. varelinie = $generelt_ya (= 185)  	LinAfst. =	$generelt_xb (= 4)
				if (strpos($linie,'linie1'))		$Gy1= $ya;	# Forudsættes bestemt før $Gy0
				if (strpos($linie,'linie2'))		$Gy2= $ya;	# Forudsættes bestemt før $Gy0
				if (strpos($linie,'linieMax'))	$Gy0= $ya;	# Forudsættes bestemt til sidst
				if ($Gy0>0) {	# Bemærk: Vi er her i LO's koordinater med 0 cm i top:
					$linafst=  $Gy2 - $Gy1;									# Standard 4	-	plac. i $xb
					$linjeant= ($Gy0 - $Gy1) / $linafst;		# Standard 34	-	plac. i $xa
					$firstLin= $Gy1;												# Standard 185-	plac. i $ya
					$beskrivelse= 'generelt';
					$just= '';	$str='';	$color= '';	$decColor='';	$side= '';	$font= '';	
				}
			};
			
			# KONVERTERING cm -> mm	& flytte y-0pkt. 
			$ya= $ya+$FeltHgt;		# Højde forskydning
			$xa= imp_KoorConv($xa,'X');			$ya= imp_KoorConv($ya,'Y');
			$xb= imp_KoorConv($xb,'X');			$yb= imp_KoorConv($yb,'X');	# Højder: yb skal ikke flytte nulpunkt! 
			if (($art==3) and (strpos($linie,'generelt')) and ($Gy0>0)) {
					$xa= round($linjeant);
					$ya= imp_KoorConv($firstLin+$FeltHgt,'Y');
					$xb= round($linafst*10);
			};
			
			# ENDEPKT & FELTBREDDE:
			if ($art==1) { #Streger:
				$xa= imp_KoorConv($x1,'X');		$xb= imp_KoorConv($x2,'X');		$ya= imp_KoorConv($y1,'Y');		$yb= imp_KoorConv($y2,'Y');	
			};
			if ($art==2) { #Tekster:
				$xb= round(imp_from($linie,'|widt:')*10);
			};
			if (($art==3) and (strpos($linie,'beskrivelse')) and ($beskrivelse=='beskrivelse')) { #Ordrelinier
				$xb= round(imp_from($linie,'|widt:')*10 / 2);				#	mm/chars	# 100 mm sv.t. 66 tegn 10pt
			};
			if ($art==5) {	#	MAIL:	
				$navn= strtoupper(imp_from($linie,'|navn:'));
				if ($navn=='MAIL_EMNE') 	{$art= 5;	$xa='# 1';	$ya=0;	$xb=0;	$yb=0;	$str='10 pt';}	else
				if ($navn=='MAIL_BESKED') {$art= 5;	$xa='# 2';	$ya=0;	$xb=0;	$yb=0;	$str='10 pt';}	else
				if ($navn=='MAIL_BILAG') 	{$art= 5;	$xa='# 3';	$ya=0;	$xb=0;	$yb=0;	$str='10 pt';}	else
				$art= 0;	# Mail-felt-label skal ikke med.
				}
			#			Kun form: 1..14					Kun art: 1..5			Kun indenfor papirbredden+10+10mm:
			if (($form>0) and ($form<15)	and ($art>0) and ($xa>=-10) and ($xa<=220) ) {
			$orgnavn= imp_from($linie,'|navn:');
			$navn= strtoupper($orgnavn);			if ($navn=='LOGO') { $art	= 1; $just= ''; $color= '';	$decColor='';	$str=''; $beskrivelse= $navn;}
			if	(strlen($beskrivelse)>500) {	#	Store binære billed-data!
				$bindata= $beskrivelse;				
				base64_to_jpegfile( $bindata, $orgnavn);	#	Dan en jpg-fil udfra LO-binære data. Objektnavnet benyttes til filens primærnavn.
				$beskrivelse= 'Billeddata: '. $orgnavn.' ['.substr($beskrivelse,0,50).'...] (Binært! afkortet.) ';
				$art= 6;
			}
			if (($font=='') and (($art==2) or ($art==3))) 
				$font='Helvetica';	#	Uspecficeret font sættes til helvetica!
			
			#	TABEL-linie:
			echo "<tr><td>$i</td><td>$form</td><td>$art</td><td>$beskrivelse</td><td>$just</td><td>". $xa."</td><td>".  $ya."</td><td>". $xb."</td><td>". $yb."</td> <td>$str</td><td><b><font color=$color>#</font></b>".trim($color,'#').'/D:'.$decColor."</td><td>$font</td><td>$fed</td><td>$kursiv</td><td>$side</td><td>$sprog</td></tr>";
			# Indhold i formularer.tab:
			if (($beskrivelse!= 'generelt linie1') and ($beskrivelse!= 'generelt linie2') and ($side!= 'B'))
			$OutStr .= $form.$sep. $art.$sep. quote($beskrivelse).$sep. quote($just).$sep.  trim($xa,'# ').$sep.  $ya.$sep.  $xb.$sep.  $yb.$sep. $str.$sep. trim($decColor,'#').$sep. quote($font).$sep. quote($fed).$sep. quote($kursiv).$sep. quote($side).$sep. quote($sprog).chr(10);
		}}
	}; #Færdig med gennemløb af linier i DataBuff
	echo "</tbody></table>";
	$OutStr = iconv("UTF-8", "Windows-1252//IGNORE", $OutStr);		#mar2016:EV#
	$OutF = fopen($OutFn, 'w') or die("can't open file");
	fwrite($OutF, $OutStr);		fclose($OutF);
	echo '<br>Done!<br>';
	echo msg_Dialog('false',300,200,'OK','$result="OK"; $(this).dialog("close")','Fortryd','$result="FAIL"; $(this).dialog("close")','Melding','På basis af filen: <b>'.$SourceFile.'</b>, er der dannet en fil: <b>'.$OutFn.'</b> med formular-data, klar til import i SALDI.');
	#msg_PopBox('Melding','Paa grundlag af filen: <b>'.$SourceFile.',</b> er der dannet en fil: <b>'.$OutFn.'</b> med formular-data, klar til import i SALDI.','done');
}

function imp_from($linie,$a) {
#	if ($p = strpos($linie,$a)) {$res= trim(stristr(substr($linie,$p+1).'|','|',true),$a);	echo '<'.$a.'='.$res.'>  ';} else $res= '';	#	echo $res;
	if ($p = strpos($linie,$a))	{
		$p = $p + strlen($a);	$res= explode('|',substr($linie,$p+0));	$res=$res[0];	/* echo substr($linie,$p+0).'<'.$res.'>  '; */} 
	else $res= '';		
	return $res;
}

function imp_KoorConv ($LOpos, $xy) {		// Konvertering af koordinater i LibreOffice til SALDI
	$PageH = 297;	
	$LOpos = rtrim($LOpos,'cm') * 10;		// cm til mm
	switch ($xy) {
		case "X" :$res = $LOpos;	break;	# sideforskydning af x sker tidligere i imp_Getit	: korrektion for feltbredde:svg:width når tekst er højrestillet ! (Anker: Venstre!)
		case "Y" :$res = $PageH - $LOpos;	break;	// Forskydning af nulpunkt fra sidetop til sidebund.  Sker i imp_Getit	: korrektion for felthøjde:svg:height ! (Anker: Top/Bund!)
		default:	echo "Fejl i programmet!";
	}
	if (($res==0) or ($res==$PageH)) {$res='';} 
	else $res= round($res);
	return $res;
}	# SALDI range: X:1..214		Y:1..276 ! Ikke som forventet 297. ?

function imp_LineLookup ($LagNavn)	{	global $doc, $xpath, $DataBuff, $debug2, $husk, $fane;	//	echo '<br>';		"[A] Alle sider"
	$blanket= array("[1] Tilbud","[2] Ordrebekræftelse","[3] Følgeseddel","[4] Faktura","[5] Kreditnota","[6] Rykker 1","[7] Rykker 2","[8] Rykker 3","[9] Plukliste","[10] Pos","[11] Kontokort","[12] Indkøbsforslag","[13] Rekvisition","[14] Købsfaktura");
	if ($debug2)	echo '<br>---------------';	
	$just='';		$fed='';		$font='';		$color= '';		$ital=''; $LagIx= trim(substr($LagNavn,0,3),'[]');
	foreach ($blanket as $b) { if ($debug2)	echo '<br>'.$b.'   ';
		$Query = '//draw:page[@draw:name="'.$b.'"]/draw:line[@draw:layer="'.$LagNavn.'"]';	
		$entries = $xpath->query($Query);		if ($debug2)	{echo '<br>Linier i laget: <i>'.$LagNavn.'</i>: ';	}
		foreach ($entries as $entry) {			if ($debug2)	{echo '<br>';		}
			$DataBuff .= "<br>|page:". trim(substr($b,0,3),'[]'). '|'. '_art:1'. '|'. '(Linie)'. '|dlay:'.$LagIx.'|';
			imp_LineShow($entry, 'draw:layer');	        $fane=$husk;                                                      
			imp_LineShow($entry, 'draw:style-name');		$gr= $husk;		                                        
			imp_LineShow($entry, 'draw:text-style-name');	               
			imp_LineShow($entry, 'svg:x1');							imp_LineShow($entry, 'svg:y1');
			imp_LineShow($entry, 'svg:x2');							imp_LineShow($entry, 'svg:y2');
			imp_StyleLookup($gr);
}	}	}

function imp_LineShow ($entry, $flag) {global $husk, $DataBuff;
	if ($debug2)	echo ' -->: '. $entry->childnode->tagName;
	$ChildAttr = $entry->getAttribute($flag);
		if ($ChildAttr) {	$husk= $ChildAttr;
			if ($debug2)	echo $flag. '= <font color="red">'. $ChildAttr. '</font>    ';
			imp_Collect(substr($flag,1+strpos($flag,':'),4),$ChildAttr);
		}	
}

#Farvekode-konvertering:
function colorhex2rgb($source) {
	if((substr($source,0,1)=='#') and (strlen($source)==7)) {
		$rhex=substr($source,1,2);			$ghex=substr($source,3,2);			$bhex=substr($source,5,2);
		return 	str_pad(round(hexdec($rhex)*100/256), 3, "0", STR_PAD_LEFT). 
						str_pad(round(hexdec($ghex)*100/256), 3, "0", STR_PAD_LEFT). 
						str_pad(round(hexdec($bhex)*100/256), 3, "0", STR_PAD_LEFT);	
	} else return 0;
}

#	PHP-funktioner der danner billedfiler:
function base64_to_jpegfile( $Binary_data, $outputfile) {imagejpeg(imagecreatefromstring (base64_decode( $Binary_data ) ),$outputfile.'.jpg'); } 
function base64_to_pngfile( $Binary_data, $outputfile)	{imagepng (imagecreatefromstring (base64_decode( $Binary_data ) ),$outputfile.'.png'); } 
function base64_to_giffile( $Binary_data, $outputfile)	{imagegif (imagecreatefromstring (base64_decode( $Binary_data ) ),$outputfile.'.gif'); } 

######### Eksperimenter: 
/* 
# <?php ob_flush();  flush();	 ob_implicit_flush(true); echo '<script>	document.write ("");	document.close (); </script>';	echo '';	busy(); ob_implicit_flush(false); ? >
function busy () {
	# function ShowObject(a,b){var c=document.getElementById(a);c&&(c.style.visibility=b?"visible":"hidden")};
  ob_flush();    flush();
	echo '<script>	document.write ("");	document.close (); </script>';
	echo '<style type="text/css">';
	echo '#progressImage1 { border: 0px #000000 solid;   left: 0;   top: 0;   width: 100%;   height: 100%; }';
	echo '#wb_progressImage1 { position: absolute;   left: 50%;   top: 250px;   width: 36px;   height: 36px;   z-index: 20; }';
	echo '</style>';
	echo '<div id="wb_progressImage1"> <a href="#" onmouseover="ShowObject("wb_progressImage1", 0);return false;"><img src="hourglass-busy.gif" id="progressImage1" alt="Der tygges drøv!"> </div>';
} */

#	echo colorhex2rgb('#9977AA');

#	$entries = $xpath->query('/office:document/office:automatic-styles/style:style[@style:name="'.$gr.'"]');
#	foreach ($entries as $entry) { var_dump($entry->getAttribute('*'));	}

function imp_Search ($RootNode, $atrr, $val) {global $doc;
	foreach ($doc->getElementsByTagName($RootNode) as $tag) {
	if($tag->getAttribute($atrr)){	// === $val) {
			foreach ($tag->childNodes as $child) { 
				var_dump(get_class($child));
}	}	}	}

 /* ULØST (delvist):
 $ordre_betalingsbet $ordre_betalingsdage dage mangler tekst-farve rød (text-paragraph)
 (æøåÆØÅ): UTF-8 => ANSI		 $csv = iconv("UTF-8", "Windows-1252", $csv); er tilsyneladende ikke nok!
 Med font Helvetica er det OK!	-	Times er ikke testet.
 Mærkelige tegn med uspecificeret font!
  
 Periodisk er ø korrekt ved udskrift! ?
 Periodisk: Udskrift udfylder ikke papirets top ved korrektion med 297 mm, så der ikke er plads til header (A4/LT)?
 Reel sidehøjde er 277 mm. Kan de 20 mm i toppen benyttes med PDF-baggrund?
 Fejlen er rettet! Udkommentering af initieringsstreng i:  includes/formfunk.php
 ORDRELINIER:
	posnr udskrives som 100, 200, 300,.... !?	Det bør fixes til 1, 2, 3... i udskrift!
		I includes/formfunk.php linie: 985 - 	#$posnr[$x]=trim($row['posnr']); rettes til: 	$posnr[$x]=trim($row['posnr']/100); Bivirkninger?
	(varelinie feltnavne udskrives når yb er forskellig fra y2?		Fænomenet formodes at forsvinde, når første ordrelinies y-værdi er bestemt.)
  (Måles tekstlængde i antal tegn eller mm? - Antal tegn, som skal omregnes til mm! (f.eks. 100 mm feltbredde, giver plads til 66 tegn 10pt))
	(Hvad er linieantal?	Det antal ordrelinier der er plads til på en side. Kalkules som: linieMax.y / (linie1.y - linie2.y) )
	(Hvad måles linieafst. i tegn/px/mm ? - Målt til Grundlinie eller blankt imellem)
	Art: Grafik-Linier burde kaldes "Streger" for at undgå forveksling med tekst-linier og grafik-linier
 
 IDE:
 Visning af andre grafiske objekter end linier?
 Det ville være et ekstra plus, hvis LO-grafik, der er gemt som binære data, også kunne vises i SALDI.
 Så kan al grafik-/billedbehandling udføres i LO.
 Kan Barcode extension være gavnlig?

Eksempel på visning af Binary-data:
<!DOCTYPE html>
<html>
 <head>  <title>Display Image</title>   </head>
 <body>
  <img style='display:block; width:6.772cm;height:2.83cm;' id='base64image'  
    src='data:image/jpeg;base64, /9j/4AAQSkZJRgABAQEAYABgAAD/2wBDAAgGBgcGBQgHBwcJCQgKDBQNDAsLDBkSEw8UHRof
Hh0aHBwgJC4nICIsIxwcKDcpLDAxNDQ0Hyc5PTgyPC4zNDL/2wBDAQkJCQwLDBgNDRgyIRwh
			:
			Kun de 2 første og sidste linier vist!
			:
FAwNiAcfWrdFc0qkp/E7nRGEY/CrBRRRUFBRRRQAUUUUAf/Z' />
 </body>
 PHP: string base64_decode ( string $data [, bool $strict = false ] )

 

 STEP by STEP:
	1.	LIBRE-O - Rediger formular(er) (saldi/importfiler/Saldi_formularer.odg)	{Dette kun muligt med Tilknyttet netværksmappe}
	2.	LIBRE-O - Gem en .fodg i saldi/importfiler																{Dette kun muligt med Tilknyttet netværksmappe / Ellers: Upload local-file til importfiler}
	3.	BROWSER - Kør: saldi/importfiler/fodg2saldi.php - Der dannes en tabultorsepareret fil: saldi/importfiler/formularer.tab (overskriver eksisterende!)
	3a.	Ved aftestning overskrives systemfilen formular.txt med formularer.tab
	4.	BROWSER - Kør: saldi/systemdata/formularkort.php?valg=formularer	{Gå ind i MENU: => SYSTEMDATA => Indstillinger => Formularer => Genindlæs standardformularer}
	5.	BROWSER - Vælg: Genindlæs standardformularer	(systemdata/formular_indlaes_std.php formularer.txt)
	6.	BROWSER - Vælg aktuel: "Formular" og Art: Linier(Streger)/Tekster/Ordrelinier
	7.	BROWSER - For hver art: Vælg: Opdater
	8.	Nu er formulardata klar til udskrift.
 Kan 3+4+5+6+7+8 automatiseres til 1 step?	"Aktiver formularer designet i LibreOffice, filen: fodg2saldi.fodg"
 Forslag: Ved siden af "Genindlæs standardformularer" tilføjes nyt link: "Indlæs fra Formulargenerator (LO)"
 Derpå:
	a.	Angiv lokal fodg.fil der skal uploades. (Flueben for: Husk dette valg til næste gang)
	b.	Angiv: "En udvalgt eller Alle" formular(er) som skal hentes.
	c.	Advarsel: Mulig overskrivning uden fortrydmulighed! Klar?
	d1.	fodg-filen uploades til saldi/importfiler/Saldi_formularer.fodg
	d2.	fodg2saldi.php startes og danner saldi/importfiler/formularer.tab, samt evt. billedfiler,
	d3.	enkeltformular eller alle importeres i DB
	e.	Melding: Klar til brug er: formular-navn(e), billed-filer
	f.	Tilbud om import af anden formular, uden at genhente formularer.tab
 ? Backup af formularer.txt før den overskrives, så brugeren kan fortryde, eller vende tilbage til en tidligere version.
 
 */

?>
