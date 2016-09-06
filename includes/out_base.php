																																																									<?php	# Struktur for SALDI-e kildefilers indledning: ?>
<?php			 $DocFil= '../includes/out_base.php';	 	$DocVer='5.0.0';		 $DocRev='2016-08-00';		 	$modulnr=0;						# Informationer om aktuelt php-dokument
// Kontruktion af grundmoduler.                                                                                         # Oplysning om filens hovedformål
//						 ___   _   _    ___  _	                                                                                  #
//						/ __| /_\ | |  |   \| |   ___                                                                             # Text2ASCII Art - "LOGO"
//						\__ \/ _ \| |__| |) | |__/ -_)                                                                            #
//						|___/_/ \_|____|___/|_|  \___|                                                                            #
//                                                                                                                      #
// LICENS:                                                                                                              # Licens note:       
// Dette program er fri software. Du kan gendistribuere det og / eller modificere det under                             # (indføjes først når filen er "færdig" og anvendelig i SALDI-systemet.)
// betingelserne i GNU General Public License (GPL), som er udgivet af The Free Software Foundation;                    #
// enten i version 2 af denne licens eller en senere version efter eget valg.                                           #
// Fra og med version 3.2.2 dog under iagttagelse af følgende:                                                          #
// Programmet må ikke uden forudgående skriftlig aftale anvendes i konkurrence med                                      #
// DANOSOFT ApS eller anden rettighedshaver til programmet.                                                             #
// Programmet er udgivet med håb om at det vil være til gavn, men UDEN NOGEN FORM FOR                                   #
// REKLAMATIONSRET ELLER GARANTI. Se GNU General Public Licensen for flere detaljer.                                    #
// En dansk oversaettelse af licensen kan læses her:  http://www.saldi.dk/dok/GNU_GPL_v2.html                           #
//                                                                                                                      #
// Copyright (c) 2004-2016 DANOSOFT ApS                                                                                 #
// ----------------------------------------------------------------------                                               #
                                                                                                                        #
// Afhængig af: base_init.php og out_style.css.php                                                                          # Afhængigheds-noter:
//                                                                                                                      #
// htm_*.php  - Grundmoduler (htm_*) egnet for adaptive skærm-output.                                                   #
// out_*.php  - Modulerne benyttes KUN i out_ruder.php, hvor system-paneler (ruder) opbygges.                           #
// out_*.php  - Ruder spalte-opsættes efterfølgende i out_vinduer.php, som er de vinduer brugeren oplever.              #
// page_*.php - Sider bestående af mange vinduer gemmes i filer med prefix: page_*.php f.eks.: page_LayoutModuler.php   #
//                                                                                                                      #
// Disse filer er redigeret med tabulator sat til 2 tegn, og ses bedst med det.                                         # Praktiske noter:
// VIGTIGT: Kilde-filer skal gemmes i UTF-8 format uden BOM!  (for ikke konstant at konververe fra ANSI til UTF-8)      #
//                                                                                                                      #
// 2016.08.00 ev - EV-soft : 1. udgave af filen                                                                         # Revisions-"Stamp" : med rev-note
                                                                                                                        #
// ***** Grundlæggende Rutiner for layout og visning af data ***************************************                    # Header-beskrivelse
                                                                                                                        #
include_once("base_init.php");	// Skal kaldes forinden.                                                                # Includes
if (!function_exists('msg_Dialog')) {
	include('../includes/msg_lib.php');};                                              #
                                                                                                                        # Filens kildetekster:
if ($programSprog== NULL) {$programSprog= 'da';}
#	$programSprog= 'en';	#	da:Dansk	en:English 	de:Deutsch 	fr:Français 	tr:Türkçe 	es:Español

# BASISMODUL for data-visning, label, titelTip og input:
function htm_CombFelt($type='',$name='',$valu='',$titl='',$labl='',$revi=true,$rows='2',$width='',$step='',$supp='') {global $lysBlaa;	# Inputfelt kombineret med label
	$labl= Tolk($labl);		$titl= Tolk($titl);		$LablTip= '<div class="tooltip">'.$labl.'<span class="tooltiptext">'.$titl.'</span></div>';	#	$LablTip= '<div class="tooltip">'.$labl.'<span class="tooltiptext">'.$titl.'</span></div>';
	$eventInvalid= 'oninvalid="this.setCustomValidity(\''.tolk('@Angiv ').$labl.'! '.'\')"';
	if (gettype($valu)== 'Float') $type= 'number' ;	
	if ($revi==true) $aktiv= ''; else $aktiv='disabled';
	if ($type== 'date')	
		echo '<div class="lablInput">	<input type= "date" '.$supp.' id="'.$name.'" name="'.$name.'" style="line-height: 100%" value="'.$valu.'"	 '.$aktiv.' />	<label for="'.$name.'">'.$LablTip.'</label>	</div>';
	if (($name=='posi') or ($name=='antal')) {$align= 'style="text-align:center";';} else $align= '';

	if ($type== 'text')	
		echo '<div class="lablInput">	<input type= "text" '.$supp.' width="'.$width.'" id="'.$name.'" name="'.$name.'" '.$align.' style="line-height:100%" value="'.$valu.'"	'.$eventInvalid.' '.$aktiv.' />	<label for="'.$name.'">'.$LablTip.'</label>	</div>';
//	echo '<div class="lablInput">	<input type= "text" width="'.$width.'" id="'.$name.'" name="'.$name.'" '.$align.' style="line-height:100%" value="'.$valu.'"	 '.$aktiv.' />	<label for="'.$name.'">'.$LablTip.'</label>	</div> <script> $(this).addClass("filled"); </script>';
			
	if ($type== 'tal1d')	#	Antal
		echo '<div class="lablInput">	<input type= "text" '.$supp.' style="text-align:right; line-height:100%;" width="'.$width.'" id="'.$name.'" name="'.$name.'" value="'.number_format($valu,1,',','.').'";	'.$eventInvalid.' '.$aktiv.'  pattern="^\d*(\.|\,\d{2}$)?" />	<label for="'.$name.'">'.$LablTip.'</label>	</div>';
	
	if ($type== 'tal2d')	# Beløb og %
		echo '<div class="lablInput">	<input type= "text" '.$supp.' style="text-align:right; line-height:100%;" width="'.$width.'" id="'.$name.'" name="'.$name.'" value="'.number_format($valu,2,',','.').'";	'.$eventInvalid.' '.$aktiv.'  pattern="^\d*(\.|\,\d{2}$)?" />	<label for="'.$name.'">'.$LablTip.'</label>	</div>';
	
	if ($type== 'number')		/* lang="en" for at tillade "."-tegn som decimal adskiller, foruden dansk ,-tegn */
		echo '<div class="lablInput">	<input type= "number" '.$supp.' lang="en" style="text-align: right; line-height:100%;" width="'.$width.'" step="'.$step.'" id="'.$name.'" name="'.$name.'" value:'.$valu.';"	'.$eventInvalid.' '.$aktiv.' pattern="(\d{3})([\.])(\d{2})" />	<label for="'.$name.'">'.$LablTip.'</label>	</div>';
		
	if ($type== 'radio')	// Skræddersyet !
		echo '<form action=""><div>&nbsp; <small>'.
		'<bluelabl>'.$LablTip.':</bluelabl >	'.
		'<input type= "radio" name="'.$name.'" value="privat"> '.		tolk('@Privat').
		' &nbsp; <font style="color:'.$lysBlaa.'">'.								tolk('@eller').':</font>'.
		'<input type= "radio" name="'.$name.'" value="erhverv"> '.	tolk('@Erhverv').
		'</small></div> </form>';

	if ($type== 'password')	
		echo '<div class="lablInput">	<input type= "password" '.$supp.' width="'.$width.'" id="'.$name.'" name="'.$name.'" style="line-height:100%" value="'.$valu.'"	'.$eventInvalid.' '.$aktiv.' />	<label for="'.$name.'">'.$LablTip.'</label>	</div>';
	
	if ($type== 'passwordpower')	{		# PW med styrke måling:
		echo '<section><div class="lablInput">	'.
//		'<fieldset class="js-password-fieldset">'.
			'<input type= "password" '.$supp.' width="'.$width.'" id= "password-strength-code" name="'.$name.'" style="line-height:100%" value="'.$valu.'"	'.$eventInvalid.' '.$aktiv.' />'.
//			'</fieldset>'.
			'	<label for="'.$name.'">'.$LablTip.'</label>	</div>';
		echo '<meter max="4" id="password-strength-meter" title="Password Styrke måler: 5 niveauer"></meter>'.
				 '<feedback id="password-strength-text" title="Feedback til det angivne password"></feedback></section>';
		}
		
	if ($type== 'mail')	
		echo '<div class="lablInput">	<input type= "email" '.$supp.' id="'.$name.'" name="'.$name.'" value="'.$valu.'"	'.$eventInvalid.' '.$aktiv.' />	<label for="'.$name.'">'.$LablTip.'</label>	</div>';
	
	if ($type== 'hidden')	
		echo '<input type= "hidden" id="'.$name.'" name="'.$name.'" value="'.$valu.'" />';
	
	if ($type== 'area')	
		echo '<div class="lablInput">	<textarea rows="'.$rows.'" id="'.$name.'" style="line-height:100%" '.$eventInvalid.' '.$aktiv.' >'.$valu.'</textarea>		<label for="'.$name.'">'.$LablTip.'</label>	</div>	<br/>';
}

# BASISMODUL for checkbox:
function htm_CheckFlt($type='NotUsed',$name='',$valu='',$titl='',$labl='',$revi=true,$supp='') {
	$labl= Tolk($labl);		$titl= Tolk($titl);	$LablTip= '<div class="tooltip">'.$labl.'<span class="tooltiptext">'.$titl.'</span></div>';
	if ($revi==true) {$aktiv= ''; $colr='';} else {$aktiv='disabled'; $colr='#_$888888';};
	echo '&nbsp;<input type= "checkbox" name="'.$name.'" value="'.$valu.'"  '.$aktiv.' '.$supp.'> 	<label for="'.$name.'" style="color:'.$colr.';"  ><bluelabl>'.$LablTip.'</bluelabl> </label>	<br/>';
}

# BASISMODUL for option:
function htm_OptioFlt($type='NotUsed',$name='',$valu='',$titl='',$labl='',$revi=true,$optlist=array(),$action='',$events='') {global $lysBlaa;
	$labl= Tolk($labl);		$titl= Tolk($titl);	$LablTip= '<div class="tooltip">'.$labl.':<span class="tooltiptext">'.$titl.'</span></div>';
	$eventInvalid= 'oninvalid="this.setCustomValidity(\''.tolk('@Vælg '.$labl.' på listen!').'\')"';
	if ($revi==true) {$aktiv= ''; $colr='';} else {$aktiv='disabled'; $colr='#_$888888';};
	#$array= array(['Fil i pdf-format','pdf','PDF-fil'],['Elektronisk forsendelse','email','email'],['Elektronisk fakturering','ioubl','OIOUBL'],['PBS faktura','pbs','PBS']);
	echo '<div class="lablInput">';
/*		echo ' <form action="'.$action.'">'; /* */		# required
		echo '<label style="color:'.$lysBlaa.'; font-weight:400; font-size:smaller"><bluelabl>'.$LablTip.'</bluelabl>'.
		' <select class="styled-select" name='.$name.'  '.$events.' '.$eventInvalid.'> <option value="'.$valu.'" >'.Tolk('@Vælg !');	# title="'.$titl.'" 		selected="'.$valu.'"
			foreach ($optlist as $rec) {
				echo '<option value="'.$rec[1].'" '.$rec[3];
				if ($rec[1]==$valu) echo ' selected';
				echo '>'.$lbl=Tolk($rec[2]).'</option> ';	#	"'.$tip=$rec[0].'"
				}
		echo '</select>&nbsp;&nbsp;&nbsp;</label>';
		//	$rec[3] kan indeholde hændelse
	#	$LablTip= '<div class="tooltip">'.tolk('@Benyt').'<span class="tooltiptext">"@Aktiver valget"</span></div>';
//		if ($action)
//		echo '<input type= "submit" id="Button1" name="submit" value="'.tolk('@Benyt').'"  title= "@Aktiver valget" style="position:absolute;left:70%;top:5px;width:50px;height:22px;z-index:6;">';
/*		echo '</form>'; /* */
	echo '</div>';
}
/* 
<SELECT onChange="myFunction(this.options[this.selectedIndex].value)">
  <OPTION value="1">Text 1</OPTION>
  <OPTION value="2">Text 2</OPTION>
</SELECT>

JS: 
function update(obj){ alert(obj.options[obj.selectedIndex].value);}
HTML:
<select name="sprog" onChange="update(this)">
  <option value="da" selected="selected">Dansk	</option>
  <option value="en"                    >Engelsk</option>
  <option value="de"                    >Tysk		</option>
</select>
*/

# BASISMODUL for radio-group:
function htm_RadioGrp($type='vert',$name='',$titl='',$labl='',$optlist=array(),$action='') {global $lysBlaa;
	$LablTip= '<div class="tooltip">'.Tolk($labl).':<span class="tooltiptext">'.$titl.'</span></div>';
	echo '<form action=""><div style="font-weight:400"><label style="color:'.$lysBlaa.'; font-size:small">'.$LablTip.'	</label>';
		foreach ($optlist as $rec) {if ($type=='vert') echo '<br>';	
			echo '<input type= "radio" name="'.$name.'" value="'.$valu=$rec[0].'">'.
						$lbl= Tolk($rec[1]).' &nbsp; <font style="color:'.$lysBlaa.'">'.
						$suff=Tolk($rec[2]).'</font>&nbsp;';				#	"	title="'.$tip=$rec[3].'"
	}	
	echo '</small></div> </form>';
}

/* 
<div id="wb_logoForm1" style="position:absolute;width:145px;height:93px;">
<form name="logoForm1" method="post" action="mailto:yourname@yourdomain.com" enctype="text/plain" id="logoForm1">
<select name="logoCombobox1" size="1" id="logoCombobox1" style="position:absolute;left:20px;top:17px;width:113px;height:23px;z-index:5;">
<option value="dsfv">fdsd</option>
<option value="wrtr">rtewtw</option>
</select>
<input type="submit" id="logoButton1" name="" value="Submit" style="position:absolute;left:38px;top:53px;width:66px;height:25px;z-index:6;">
</form>
</div>
 */
 
 
# BASISMODUL for tabel:
function htm_Tabel ($Titles=array(['@Kol0','7%'],['@Kol1','10%'],['@Kol2','30%']), $DataArr=array() ) {
	$Capt1= '<b>'.tolk('@FILTER').'</b>: '.tolk('@Begræns visning i tabellen nedenfor, ved at angive søge-/visnings-kriterier i disse felter:');
	$Capt2= '<b><u>'.tolk('@SLET').':</u></b> '.tolk('@Slet indhold i alle filter-felter');
	# Tabel med Filter-input:
	echo '<div class="fixed-table-container">  <div class="header-background"> </div>';
	echo '<table cellspacing="0"><tc>&nbsp;&nbsp;&nbsp;'.$Capt1.'&nbsp;&nbsp;&nbsp;'.$Capt2.'</tc>';
	echo '<thead> <tr>';
	foreach ($Titles as $Titel) {
		echo '<th style="width:'.$Titel[1].'"> <div class="extra-wrap"><div class="th-inner">'.tolk($Titel[0]).'</div></div> </th>';
	}
	echo '</thead> </tr> <thead> <tbody> <tr class="row"> ';
	for ($x= 0; $x < count($Titles); $x++) {echo '<td><input type= "text" name="Kol'.$x.'" title="'.tolk('@Søg efter...').'" placeholder="...'.tolk('@Søg').'..." size="7" /></td> ';}
	echo '</tr></tbody></thead> </table> </div>';
	# Tabel med data:
	echo '<div class="fixed-table-container"> <div class="header-background"> </div>';
	echo '<div class="fixed-table-container-inner extrawrap">';
	echo '<table cellspacing="0"> <thead> <tr>';
	foreach ($Titles as $Titel) {
		echo '<th style="width:'.$Titel[1].'"> <div class="extra-wrap"><div class="th-inner">'.tolk($Titel[0]).'</div></div> </th>';
	}
	echo '</tr> </thead>  <tbody>';
	foreach ($DataArr as $Row) {echo '<tr class="row">';
			foreach ($Row as $Col) {echo '<td>'.$Col.'</td>';}
		echo '</tr>';	}
	echo '</tbody>  </table> </div> </div>';
}

# BASISMODUL for tabelInput (kassekladde):
function htm_TabelInp ($Capt1='Kladde notat:', $Capt2='', $Titles=array(['@Kol0','7%','Tip'],['@Kol1','10%','Tip'],['@Kol2','30%','Tip']), 
												$RowPref=array(['Capt'],['Label'],['Tip'],['width']), $RowSuff=array(array(['tdContent'],['Value']))) {
global $lysBlaa;
	echo '<div class="fixed-table-container">  <div class="header-background" style="color:'.$lysBlaa.';"> &nbsp;'.tolk($Capt1).' <input type= "text" name="note" title="" placeholder="'.tolk('@Angiv din tekst...').'" style="width:60%" />&nbsp;&nbsp;'.tolk($Capt2).' <input type= "text" name="note" title="" placeholder="'.tolk('@Afstem').'..." style="width:5em" /></div>';
	echo '<table class="formnavi" cellspacing="0">';
#	Kolonne-LABELS:		Title	Label	Tip
	echo '<thead><tr> ';	
	if ($RowPref) echo '<th style="width:'.$RowPref[0][3].'">'.$RowPref[0][0].'</th>';
	foreach ($Titles as $Titel) {
		$LablTip= '<div class="tooltip">'.tolk($Titel[0]).'<span class="tooltiptext">'.tolk($Titel[2]).'</span></div>';
		echo '<th style="width:'.$Titel[1].'"> <div class="extra-wrap"><div class="th-inner-center" align="center">'.$LablTip.'</div></div> </th>';
	} 
	if ($RowSuff) {
		$LablTip= '<div class="tooltip">'.tolk('@um.').'<span class="tooltiptext">'.tolk('@um. (uden moms) kan benyttes til at bogføre beløb uden moms på konti, selvom kontoen har en momssats tilknyttet.').'</span></div>';
		echo '<th>'.$LablTip.'</th>';
		if ($Capt1!= '@Nota:') $LablTip= '<div class="tooltip">'.tolk('@Konto-saldo').'<span class="tooltiptext">'.
							tolk('@Bevægelser og saldo for den konto, som er angivet ovenfor i Felt: Konto-kontrol. Er velegnet til afstemning med bank- og girokonti. ').'</span></div>';
		else 		$LablTip= '<div class="tooltip">'.tolk('@Linie ialt').'<span class="tooltiptext">'.
							tolk('@Beregnet felt med summen af de samlede beløb').'</span></div>';
		echo '<th>'.$LablTip.'</th>';
		}
	echo '</thead> </tr> ';
#	Kolonne-DATA-INPUT:		Content	
	echo'<thead> <tbody>  ';
	for ($y= 0; $y < 10; $y++) { $x=0;	echo '<tr class="row">';
		if ($RowPref) echo '<td>'.$RowPref[0][0]. '</td>';
		foreach ($Titles as $Titel) { if ($Titel[0]=='@Bilagstekst') {$algn='left';} else if (($Titel[0]=='@D/K') or ($Titel[0]=='@Dato')) {$algn='center';} else $algn='right'; 
			echo '<td style="padding:0px;"> <div style="margin-right: 6px;"> <input type= "text" name="Kol'.$x++.'" placeholder="" style="text-align:'.$algn.'; width:100%" /></div></td> ';
		}
		#RowSuff:
		echo '<td><input type= "checkbox" name="udenmoms" value="" ></td>';
		echo '<td><div type= "text" name="saldo" value="" width="5%"></td>';
		echo '</tr>';
	}
	echo '</tbody></thead> </table> </div>';
}


#	$labl ændres til:	$LablTip= '<div class="tooltip">'.$labl.'<span class="tooltiptext">'.$titl.'</span></div>';

# LAYOUT moduler:
function htm_Rude_Top($name='',$capt='',$parms='',$icon='',$klasse='panelWmax',$func='Udefineret') {	# SKAL efterfølges af htm_RudeBund !
	global $debug;
#	if ($klasse=='panelWmax') {echo '<div class="clearWrap"/>';};
	echo '<form name="'.$name.'" id="'.$name.'" action="'.$parms.'" method="post">';
	if ($debug) {$fn= '&nbsp; <small><small><small>f:'.$func.'()</small></small></small>';} else $fn='';
	echo '<div class="'.$klasse.'"> <div class="panelTitl" max-width:400>'.
		'<ic class="fa '.$icon.'" style="font-size:22px;color:green"></ic> &nbsp;'.ucfirst(Tolk($capt)).$fn.'</div>';
	if ($capt) echo '<hr class="style13"/>';
}	# Boxens </div> og </form> er placeret i htm_RudeBund som skal kaldes til slut!

function htm_RudeBund($pmpt='',$revi=false,$title='') {	# SKAL følge efter htm_Rude_Top !
	if ($revi==true) {	echo '<hr><div class="centrer">';		htm_accept($pmpt,$title); echo '</div>';	}
	echo '</div></form>';
}

function htm_accept($labl='',$title='',$width='') {
	#	$LablTip= '<div0 class="tooltip"><span0 class="tooltiptext">'.tolk($title).'</span0></div0>';
	if ($width) $width= ' width: '.$width.';';
#	echo '<input type= "submit" class="mytip" titletip="'.tolk($title).'" name="submit" value="'.ucfirst(tolk($labl)).
	echo '<input type= "submit" class="mytipx" title="'.tolk($title).'" name="submit" value="'.ucfirst(tolk($labl)).
	'" style="margin: 2px 2px; padding: 4px 8px;'.$width.'" />';	# '.$LablTip.'
}

# Felter i en horisontal række:
function htm_FrstFelt($wth,$bord=0) {echo '<TABLE BORDER="'.$bord.'" 	border-collapse: collapse; padding: 0px; width="100%"><TR><TD width="'.$wth.'"> ';}
function htm_NextFelt($wth) {echo '</TD>	<TD style="width:'.$wth.';"> ';}
function htm_LastFelt() 		{echo '</TD>	</TR>	</TABLE>';}

function knap ($faicon='',$title='',$link='') {
		$LablTip= '<div0 class="tooltip"><span class="tooltiptext">'.$title.'</span></div0>';
		echo '<span>&nbsp;&nbsp;&nbsp;';
		echo '<a href="'.$link.'" '.$LablTip.' ';
		echo '	<ic class="fa '.$faicon.'" style="font-size:32px; color:'.$color='#003366'.';"></ic>';
		echo '</a></span>';	}
		
function Head_Navigation ($sideObjekt, $status, $goPrev, $goHome=true, $goUp, $goFind, $goNew, $goNext) { # Genvejsknapper på siders top.
	$sideObjekt= tolk($sideObjekt);
	echo '<PanlHead>';
	htm_Rude_Top($name='naviform',$capt='',$parms='',$icon='','panelWmax',__FUNCTION__);
	echo '<div style="text-align: center"><img src= "../images/SALDIe50x150.png" alt="Saldi Logo" style="width:150px;height:50px;"></div>';
	echo '<p align="center"><b>'.tolk('@Navigation:').'<b></p>';
	echo '<p align="center">';	#<ic class="fa '.$icon.'" style="font-size:22px;color:green"></ic>
	if ($goPrev)	knap($faicon='fa-caret-square-o-left',	$title= tolk('@Vis forrige') 	.' '.$sideObjekt	,$link='x');
	if ($goHome)	knap($faicon='fa-home',									$title= tolk('@Luk og gå til hoved-menu')				,$link='../test/page_LayoutModuler.php'.$goBack);
	if ($goUp	 )	knap($faicon='fa-caret-square-o-up',		$title= tolk('@Luk og gå et niveau op')					,$link='x');
	if ($goFind)	knap($faicon='fa-search',								$title= tolk('@Søg en anden')	.' '.$sideObjekt	,$link='x');
	if ($goNew )	knap($faicon='fa-plus-square-o',				$title= tolk('@Opret ny')			.' '.$sideObjekt	,$link='x');
	if ($goNext)	knap($faicon='fa-caret-square-o-right',	$title= tolk('@Vis næste')		.' '.$sideObjekt	,$link='x');
	echo '</p>';
	if ($status) $status= '<x1 style="font-weight:300; font-size:smaller"> - Status:<bluelabl> '.$status.'</bluelabl></x1>';
	echo '<p align="center">'.ucfirst($sideObjekt).$status.'</p> ';
	htm_RudeBund($pmpt='@Gem',$revi=false,$title='@Gem');
	echo '</PanlHead>';
}

function Foot_Links ($arg='', $doPrint, $doErase=true, $doLookUp, $doAccept, $doExport, $doImport) { global $programSprog;
	htm_Rude_Top($name='linkform',$capt=''.' ',$parms='',$icon='','panelWmax',__FUNCTION__);
		echo '<p align="center"><b>'.tolk('@Handling:').'<b></p>';
		echo '<p align="center">';	#<ic class="fa '.$icon.'" style="font-size:22px;color:green"></ic>
		if ($doPrint)		knap($faicon='fa-print',								$title= tolk('@Udskriv') 	.' '.$sideObjekt	,$link='x');
		if ($doErase)		knap($faicon='fa-minus-square-o',				$title= tolk('@Slet posten')										,$link='x'.$goBack);
		if ($doLookUp)	knap($faicon='fa-search-plus',					$title= tolk('@Vareopslag')					,$link='x');
		if ($doAccept)	knap($faicon='fa-check-square-o',				$title= tolk('@Godkend alt')	.' '.$sideObjekt	,$link='x');
		if ($doExport)	knap($faicon='fa-upload',								$title= tolk('@CSV-Export')			.' '.$sideObjekt	,$link='x');
		if ($doImport)	knap($faicon='fa-download',							$title= tolk('@Fil import')		.' '.$sideObjekt	,$link='x');
		echo '</p>';			
		htm_FrstFelt('10%',0);	
		htm_NextFelt('30%');		echo '<div style="display:inline-block; margin-left:1em; align:center">'.SprogValg($programSprog).'</div> ';
		htm_NextFelt('25%');		echo '<div style="display:inline-block; margin-left:1em; align:center">'.$arg.'</div> ';
		htm_NextFelt('30%');		echo '<div style="display:inline-block; margin-left:1em>'.htm_accept('@Log ud','@Forlad SALDI').'</div> ';
		htm_NextFelt('05%');		# Vare-opslag, Udskriv, Fakturer, Slet vist post, 
		htm_LastFelt();
		echo '<tc><divline style="margin-left:0.5em"><small><b>'.tolk('@TIP:').'</b> '.tolk('@Hold musen over').' <bluelabl>'.tolk('@Blå tekster med skyggeramme, ').'</bluelabl>'.tolk('@så får du hjælpetekster og tips.').'</small></divline></tc>';
	htm_RudeBund($pmpt='@Gem',$revi=false,$title='@Gem');
}

function FirstSpalte() {echo '<PanlHead> <div id="wrapper"> <column id="spalte1">';	}
function NextSpalte()  {echo '</column> <column id="spaltex">'; }
function EndSpalter()  {echo '</column> </div> </PanlHead><div class="clearWrap">' ; }
function panelStart () {echo '<PanlFoot>';}
function panelSlut () {echo '</PanlFoot>';}
function greenLine () { echo '<hr size="10" color="green">';}

function Win_Head ($title='') {		#	Ubenyttet! erstattet af ../_base/htm_pageHead.php
	echo	'<!DOCTYPE html>';
	echo	'<html lang="da" dir="ltr">';
	echo	'		<head>';
	echo	'			<meta charset="UTF-8">';
	echo	'			<font face="Helvetica, Arial, sans-serif">';
	echo	'			<title>'.$title.'</title>';
	echo	'			<link rel="stylesheet" href= "../css/out_style.php">';
	echo	'			<link rel="stylesheet" href= "http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" emne="ICON-system">';
	echo	'			<link rel="stylesheet" href= "../js/1.12.0/themes/base/jquery-ui.css" emne="jquery Dialog">';
	echo	'			<link rel="stylesheet" href= "../css/meter-style.css">';						// PassWord-styrke måler
	echo	'			<link rel="stylesheet" href= "../css/out_style.css" emne="out-style">';
	echo	'		</head>';
	echo	'	<body>';
}

function Win_Foot ($title='') {		#	Ubenyttet!
	echo	'	</body></html>';
}

# SUPPLERENDE moduler:

function 	HentData($dat1,$dat2,$dat3,$dat4,$dat5,$dat6) {		#	Ubenyttet!
	/* STRATEGI:
	SALDI's variable erklæres som globale.
	De overføres til lokale variable, som kan sammenlignes med de globale,
	så brugerændringer kan signaleres ved at GEM-knap skifter farve fra grøn til gul.
	 */
	# Det forudsættes at systemets variabler er opdateret inden benyttelse.
	
	# global $art, $brugsamletpris, $genfakt, $fokus, $hurtigfakt, $id, $incl_moms, $momssats, $valuta, $valutakurs, $vis_projekt, $status, $ny_pos, $procentfakt, $omkunde, $difkto, $rvnr, $vis_saet, $her;
	# ordrelinjer($x, $sum, $dbsum, $blandet_moms, $moms, $antal_ialt, $leveres_ialt, $tidl_lev_ialt, $levdiff, $masterprojekt, $linje_id, $kred_linje_id, $posnr, $varenr, $beskrivelse, $enhed, $pris, $rabat, $rabatart, $procent, $antal, $leveres, $vare_id, $momsfri, $rabatgruppe, $m_rabat, $varemomssats, $serienr, $samlevare, $folgevare, $projekt, $kdo, $kobs_ordre_pris, $ko_ant, $kostpris, $db, $dg, $dk_db, $dk_dg, $readonly, $omvbet, $saet, $saetnr);
	
	# $dkantal=0;$tidl_lev=0;
	# $kontonr, $ordrenr, $email, $lev_navn, $lev_postnr, $lev_bynavn, $lev_addr1, $lev_addr2, $lev_kontakt, $firmanavn, $postnr, $bynavn, $addr1, $addr2, $kontakt, $cvrnr, $landekode, $land, $tlf, $fakturanr, $sum, 
	# Dummy
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
# SPROG system:

function sprogDB_import($fname='../_config/Sprog_DB.csv') {	#	Filen skal være gemt i UTF-8 format!
	global $sprogTabl, $languageTable;
	$fp=fopen($fname,"r");
	if ($fp) {	$languageTable= [];
		while (($line = fgets($fp, 4096)) !== false) { array_push($languageTable, explode( '","',trim(trim($line),'"'))); }
  }	fclose($fp);	
#	sort($languageTable);
	$x= count($languageTable);	
	for ($x = 0; $x <= count($languageTable); $x++) { 
		$str .= trim($languageTable[$x][0]).'='.$languageTable[$x][1].'&';
	} $str= trim($str,'&'); 						# Fjern det sidste &-tegn
	$str = ''.trim(trim($str,','),'"');	# Fjern andre uønskede tegn
	parse_str($str, $sprogTabl);				# Dan $sprog-tabel med key og et sprog
}	

function found_index($sprogDB, $field, $value) {
  foreach($sprogDB as $key => $row) {
     if ($row[$field] === $value)  
		{return $key;	break;}
  }  return false;	#	'TranslateError';
}

function Tolk($FraseKey) {															# Tolk() benyttes til sprogoversættelse af alle hard-codede program-tekster.
	global $sprogTabl, $programSprog, $languageTable;			# Fraser med @-prefix er system-tekster, der kan omsættes til andet sprog.
	#	$programSprog='de';																	#	Vær opmærksom på at samme frase, ikke kaldes flere gange f.eks. i rutiner i underniveauer.
 if (substr($FraseKey,0,1)!='@') {return($FraseKey); break;}	# Kan være tolket tidligere!
 if (($programSprog) and ($languageTable))		
	switch ($programSprog=strtolower($programSprog)) {  	# 0 Key             
		case "da" :$result= trim($FraseKey,'@');	break;	  # 1	Dansk	         da: Vis frasen uden prefix
		case "en" :$ix= 2;	break;                          # 2	Engelsk	       sæt index for opslag
		case "de" :$ix= 3;	break;                          # 3	Deutsch	       sæt index for opslag
		case "fr" :$ix= 4;	break;                          # 4	Français	     sæt index for opslag
		case "tr" :$ix= 5;	break;                          # 5	Türkçe	       sæt index for opslag
		case "es" :$ix= 6;	break;                          # 6	Español	       sæt index for opslag
																												#	7 Grønlandsk			 
		default	 	:	{$ix= 1; echo "<bluelabl>Sprog?:".$programSprog." </bluelabl>";	break;}
	}
	$TblRow= found_index($languageTable, 0, $FraseKey);
	if (substr($FraseKey,0,1)=='@') 																				# Er frasen med @-prefix:
			 {if ($programSprog=='da')	{$result= trim($FraseKey,'@');} 				# 	Er sproget dansk fjernes @-prefix blot i resultatet
				else if ($TblRow>0) {$result= $languageTable[$TblRow][$ix];}			#		ellers slås op i sprogtabellen
				else {$result= ''.$FraseKey.' <small><small>(Danish!)</small></small>';	$MissingFrase.='<br>'.$FraseKey;}	# Oversættelse mangler: Vis $FraseKey  med @-prefix
			 }	
	else {$result= $FraseKey;} 																							#	Fraser uden @-prefix returneres uændret.
	return($result);
}	
#	OBS!	Benyt konsekvent prefix: '@ ikke: "@ så alle fraser kan udtrækkes automatisk!
#	Oversættelsen sker automatisk i BASISMODULER med tolk(), når parametre behandles.
# I sjældne tilfælde (sammensatte tekster), er det nødvendigt at benytte tolk() lokalt.
#	Undgå forkortelser og sammensatte ord, som kan forringe oversættelse og liniewrap.
#	Undgå indledende og afsluttende SPACE, og <HTML> koder i fraser. Benyt @@ hvis en frase skal starte med @
# Tegnet: " må ikke forekomme i fraser, det korrumperer csv-formatet. Benyt f.eks. ' i stedet.
//////////////////////////////////////////////////////////////////////////////////////////////////////////


/*  

FORDELE ved systemet:

 Adaptive layout ved Skærmbredde[px]:
 < 320		:	1 spalte med fast bredde. 5-kolonnet Gittermenu ombrydes.
 320.. 640:	1 spalte med varierende bredde. 5-kolonnet Gittermenu ombrydes.
 640..1000: 1 spalte med varierende bredde. Gittermenu i fuld bredde.
 > 1000		: 3-spaltet layout. Fast spalte-bredde: 320px. Gittermenu i fuld bredde.
 
 (En vertikal menu kan reducere bredden til 4 elementer! : 415px)
 
 Tip vises ved mus over tydeligt markeret label, som deler plads med input-felt.
 
 Alle labels og tip kan oversættes til et andet program-sprog, 
 med nem opdatering af alle forekommende fraser, når prefix: @ er benyttet.
 Fraselængden for dansk er pt. begrænset til max. 170 tegn. (i frasescann.php)
 Er der længere fraser skal de opdeles i flere, ved at indskyde >'.'@< i frasen,
 på et hensigsmæssig sted (ny sætning) for ikke at sabotere sprogoversættelse.
 Tegn der ikke må benyttes: < > " @ (udover prefixet)' fordi de mistolkes!
 Tags som: </small> fjernes. De skal i stedet indeholdes i strenge omkring fraser.
 Slut ikke en frase med SPACE, da den kan blive fjernet, og key passer da ikke!
 Brugeren kan selv korrigere sprog-tekster i regneark. (Forudsat Up-/Down-load er mulig)
 
 Sprogtekster kan vedligeholdes i LO-regneark:
 Importer fra:	{Sprog_DB.csv} 		
								FilType: {Tekst .csv}	
								Tegnsæt {UTF-8}	 
								Sprog: {Dansk} 
								Fra række: {1}	
								Adskilt af: {komma} 
								Tekstskilletegn: {"}
 eller Indlæs:	{Sprog_DB.ods}
								Benyt copy/paste fra Google translate (en hel sprogkolonne ad gangen)
 Gem en kopi :	Filnavn	{Sprog_DB}	(Benyttet af systemet: Sprog_DB.csv)
								FilType: {.csv} 
								Tegnsæt: {UTF-8} 
								Felt-Afgrænser:	{,}	
								Tekst-Afgrænser: {"}	
								Flueben: {Gem cellens indhold som vist}		
								Flueben: {Sæt citationstegn i alle tekstceller}
 
 Farver, placeringer og tekststørrelser kan justeres centralt i CSS-fil.
 
 Systemet omfatter pt. følgende filer:
 page_LayoutModuler.php 	- Demo af systemet
 out_javascr.js						- Systemets javascript
 out_style.php (.css) 		- Systemets CSS
 out_base.php 						- Systemets Modulære Grundsystem
 out_ruder.php 						- Systemets Paneler med PROGRAM-moduler
 out_vinduer.php 					- Systemets vinduer opbygget af flere Paneler
 user_interface.php 			- Modulært Grundsystem
 frasescann.php 					- Skanner efter fraser i alle projektfiler, men gemmer pt. kun dem i: user_interface.php og page_LayoutModuler.php
 Sprog_DB.csv							-	Importfil, hvor alle sprogvarianter samles manuelt (copy/paste), med hjælp af Google-translate.
 
  */
	
	/*
HTML:
	<form class="pure-form">
    <fieldset>
        <legend>Confirm password with HTML5</legend>
        <input type="password" placeholder="Password" id="password" required>
        <input type="password" placeholder="Confirm Password" id="confirm_password" required>
        <button type="submit" class="pure-button pure-button-primary">Confirm</button>
    </fieldset>
	</form>

JS:
<script>
	var password = document.getElementById("password"), 
		confirm_password = document.getElementById("confirm_password");
	function validatePassword(){
		if(password.value != confirm_password.value) 
			{confirm_password.setCustomValidity("Passwords Don't Match");	} 
		else {confirm_password.setCustomValidity('');		}
	}
	password.onchange = validatePassword;
	confirm_password.onkeyup = validatePassword;
</script>
 */
?>
