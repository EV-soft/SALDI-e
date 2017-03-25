<?php
# EV-soft - Danne liste med Saldi-formular-data konverteret til LO-koordinater. april-2016:
include("../includes/msg_lib.php");	#apr2016:EV#
global $lines;
$SourceFile = "formular.org.txt";

if (file_exists($SourceFile)) {$lines  = file($SourceFile);	prosess_file(); } 
else {echo "<b>FEJL: $SourceFile ikke fundet!</b>";
	msg_PopBox('Fil FEJL:','Input-filen: <b>'.$SourceFile.'</b> kan ikke findes/åbnes.','erro');
}

function prosess_file () { global $lines, $htm, $SourceFile;
	$sep = chr(9);	$OutStr = '';	
	#	$linier = explode("<br>",$lines);
	echo 'SALDI-filen: <b>'.$SourceFile.'</b> med formulardata, vises her med koordinater konverteret til LO-koordinater.';
	$htm= "\n<table width='' height='' cellspacing='' border='0' cellpadding='2' valign='top' ><tbody>"; 
	foreach ($lines as $line) {
	$felter = explode($sep,$line);	
	$htm.= "\n<tr>";
/* 
 1	 2	 			3	 		4	 						5	 					6	 		7	 		8	 		9			10			11			12		13			14	  	15		16	 '
 ID	$formular	$art	$beskrivelse $justering		$xa   $ya   $xb   $yb   $str   $color  $font  $fed   $kursiv  $side	$sprog				
								ID:							Form:					X:																	Y:																X2:																	Y2:										Art:	*/
	$OutStr = '<br>F:'.$felter[0].' A:'.$felter[1].' _ X,Y:'.imp_ConvKoor($felter[4],'X').','.imp_ConvKoor($felter[5],'Y').' _ x2,y2:'.imp_ConvKoor($felter[6],'X').','.imp_ConvKoor($felter[7],'Y').' Jus:'.$felter[3].' H:'.$felter[8].' : '.$felter[2].' ';
	$OutStr = iconv("Windows-1252//IGNORE","UTF-8", $OutStr);
	#	$OutStr;
/* 	TDfelt('F:'.$felter[0]);	TDfelt('A:'.$felter[1]);	
	TDfelt('X,Y: '.imp_ConvKoor($felter[4],'X').','.imp_ConvKoor($felter[5],'Y'));	
	TDfelt('x2,y2: '.imp_ConvKoor($felter[6],'X').','.imp_ConvKoor($felter[7],'Y'));	
	TDfelt('Jus:'.trim($felter[3],"'"));	TDfelt('H:'.$felter[8]);	
	TDfelt('C:'.$felter[0]);	TDfelt('F:'.$felter[1]);	TDfelt('z:'.$felter[9]);	TDfelt('f:'.trim($felter[10],"'"));	
	TDfelt('b:'.trim($felter[11],"'"));	TDfelt('i:'.trim($felter[12],"'"));	TDfelt('s:'.trim($felter[13],"'"));	
	TDfelt(trim($felter[2],"'"));
 */	
		TDfelt('F:'.$felter[0].' A:'.$felter[1]);	#	TDfelt('A:'.$felter[1]);	
	TDfelt('X/Y: '.imp_ConvKoor($felter[4],'X').' / '.imp_ConvKoor($felter[5],'Y'));	
	TDfelt('A/B: '.imp_ConvKoor($felter[6],'X').' / '.imp_ConvKoor($felter[7],'Y'));	
	TDfelt('J:'.trim($felter[3],"'").' H:'.$felter[8]);	#	TDfelt('H:'.$felter[8]);	
#	TDfelt('C:'.$felter[0]);	TDfelt('F:'.$felter[1]);	TDfelt('z:'.$felter[9]);	TDfelt('f:'.trim($felter[10],"'"));	
	TDfelt('b:<b>'.trim($felter[11],"'").'</b>');	TDfelt('i:<i>'.trim($felter[12],"'").'</i>');		TDfelt('s:<u>'.trim($felter[13],"'").'</u>');	
	TDfelt(trim($felter[2],"'"));
$htm.= "</tr>";
	}
	$htm.= "</tbody>\n</table>";
	$htm = iconv("Windows-1252//IGNORE","UTF-8", $htm);
	echo $htm;
}
function TDfelt ($val) {global $htm;
	$htm.= '<td>'.$val.'</td>';
}
function imp_ConvKoor ($SALDIpos, $xy) {	global	$FeltHeight, $FeltWidth;	// Konvertering af koordinater i LibreOffice til SALDI
	$PageH = 297;	
	switch ($xy) {
		case "X" :$res = $SALDIpos;	break;
		case "Y" :$res = $PageH - $SALDIpos;	break;
		default:	echo "Fejl i programmet!";
	}
	$res = $res / 10;		// mm til cm
	if (($res==29.7) and ($xy=='Y')) $res= 0;
	return $res;
}	# SALDI range: X:1..214		Y:1..276 ! Ikke som forventet 297.
/* 
SALDI-filen: formular.org.txt med formulardata, vises her med koordinater konverteret til LO-koordinater.
F:1	A:1	X,Y: 15,3.2	x2,y2: 0,0	Jus:	H:0	C:1	F:1	z:0	f:	b:	i:	s:	LOGO
F:1	A:1	X,Y: 16.6,22.8	x2,y2: 18.4,22.8	Jus:	H:1	C:1	F:1	z:0	f:	b:	i:	s:	
F:1	A:1	X,Y: 2.3,10.7	x2,y2: 2.3,22.1	Jus:	H:1	C:1	F:1	z:0	f:	b:	i:	s:	
F:1	A:1	X,Y: 2.3,22.1	x2,y2: 18.4,22.1	Jus:	H:1	C:1	F:1	z:0	f:	b:	i:	s:	
F:1	A:1	X,Y: 2.3,10.7	x2,y2: 18.4,10.7	Jus:	H:1	C:1	F:1	z:0	f:	b:	i:	s:	
F:1	A:1	X,Y: 16.6,24.2	x2,y2: 18.4,24.2	Jus:	H:1	C:1	F:1	z:0	f:	b:	i:	s:	
F:1	A:1	X,Y: 16.6,10.7	x2,y2: 16.6,24.2	Jus:	H:1	C:1	F:1	z:0	f:	b:	i:	s:	
F:1	A:1	X,Y: 16.6,23.5	x2,y2: 18.4,23.5	Jus:	H:1	C:1	F:1	z:0	f:	b:	i:	s:	
F:1	A:1	X,Y: 2.6,4.2	x2,y2: 18.4,4.2	Jus:	H:1	C:1	F:1	z:0	f:	b:	i:	s:	
F:1	A:1	X,Y: 18.4,10.7	x2,y2: 18.4,24.2	Jus:	H:1	C:1	F:1	z:0	f:	b:	i:	s:	
F:1	A:2	X,Y: 2.6,26	x2,y2: 0,0	Jus:V	H:11	C:1	F:2	z:0	f:Helvetica	b:on	i:	s:A	$egen_addr1
F:1	A:2	X,Y: 18.3,27.6	x2,y2: 0,0	Jus:H	H:11	C:1	F:2	z:0	f:Helvetica	b:on	i:	s:A	$egen_bank_navn
F:1	A:2	X,Y: 18.3,28	x2,y2: 0,0	Jus:H	H:11	C:1	F:2	z:0	f:Helvetica	b:on	i:	s:A	$egen_bank_reg $egen_bank_konto
F:1	A:2	X,Y: 2.6,25.6	x2,y2: 0,0	Jus:V	H:11	C:1	F:2	z:0	f:Helvetica	b:on	i:	s:A	$eget_firmanavn
F:1	A:2	X,Y: 2.6,3.9	x2,y2: 0,0	Jus:V	H:12	C:1	F:2	z:0	f:Helvetica	b:on	i:on	s:A	$eget_firmanavn * $egen_addr1 * $eget_postnr $eget_bynavn * Danmark
F:1	A:2	X,Y: 18.3,24.1	x2,y2: 0,0	Jus:H	H:10	C:1	F:2	z:0	f:Helvetica	b:on	i:	s:S	$formular_ialt
F:1	A:2	X,Y: 18.3,23.4	x2,y2: 0,0	Jus:H	H:10	C:1	F:2	z:0	f:Helvetica	b:	i:	s:S	$formular_moms
F:1	A:2	X,Y: 16,6.7	x2,y2: 0,0	Jus:V	H:11	C:1	F:2	z:0	f:Helvetica	b:	i:	s:A	$formular_side
F:1	A:2	X,Y: 18.3,22.7	x2,y2: 0,0	Jus:H	H:10	C:1	F:2	z:0	f:Helvetica	b:	i:	s:S	$formular_sum
F:1	A:2	X,Y: 18.3,22.7	x2,y2: 0,0	Jus:H	H:10	C:1	F:2	z:0	f:Helvetica	b:	i:	s:!S	$formular_transportsum
F:1	A:2	X,Y: 2.6,5.9	x2,y2: 0,0	Jus:V	H:11	C:1	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_addr1
F:1	A:2	X,Y: 2.6,6.3	x2,y2: 0,0	Jus:V	H:11	C:1	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_addr2;
F:1	A:2	X,Y: 16,5.9	x2,y2: 0,0	Jus:V	H:11	C:1	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_fakturanr
F:1	A:2	X,Y: 2.6,5.5	x2,y2: 0,0	Jus:V	H:11	C:1	F:2	z:0	f:Helvetica	b:on	i:	s:A	$ordre_firmanavn
F:1	A:2	X,Y: 13.2,23.4	x2,y2: 0,0	Jus:V	H:10	C:1	F:2	z:0	f:Helvetica	b:	i:	s:S	$ordre_momssats;% moms
F:1	A:2	X,Y: 16,6.3	x2,y2: 0,0	Jus:V	H:11	C:1	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_ordredate;
F:1	A:2	X,Y: 6,8.7	x2,y2: 0,0	Jus:V	H:11	C:1	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_ordrenr
F:1	A:2	X,Y: 2.6,6.7	x2,y2: 0,0	Jus:V	H:11	C:1	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_postnr $ordre_bynavn
F:1	A:2	X,Y: 14.8,10.4	x2,y2: 0,0	Jus:C	H:11	C:1	F:2	z:0	f:Helvetica	b:	i:	s:A	Antal
F:1	A:2	X,Y: 5.5,10.4	x2,y2: 0,0	Jus:V	H:11	C:1	F:2	z:0	f:Helvetica	b:	i:	s:A	Beskrivelse
F:1	A:2	X,Y: 18.3,26.8	x2,y2: 0,0	Jus:H	H:11	C:1	F:2	z:0	f:Helvetica	b:on	i:	s:A	CVR nr: $eget_cvrnr
F:1	A:2	X,Y: 2.6,26.8	x2,y2: 0,0	Jus:V	H:11	C:1	F:2	z:0	f:Helvetica	b:on	i:	s:A	Danmark
F:1	A:2	X,Y: 12,6.3	x2,y2: 0,0	Jus:V	H:11	C:1	F:2	z:0	f:Helvetica	b:on	i:	s:A	Dato
F:1	A:2	X,Y: 2.6,8.7	x2,y2: 0,0	Jus:V	H:11	C:1	F:2	z:0	f:Helvetica	b:on	i:	s:A	Deres ordre nr
F:1	A:2	X,Y: 2.6,8.3	x2,y2: 0,0	Jus:V	H:11	C:1	F:2	z:0	f:Helvetica	b:on	i:	s:A	Deres ref:
F:1	A:2	X,Y: 2.6,26.4	x2,y2: 0,0	Jus:V	H:11	C:1	F:2	z:0	f:Helvetica	b:on	i:	s:A	DK-$eget_postnr $eget_bynavn
F:1	A:2	X,Y: 2.6,28	x2,y2: 0,0	Jus:V	H:11	C:1	F:2	z:0	f:Helvetica	b:on	i:	s:A	Fax: $egen_fax
F:1	A:2	X,Y: 13.2,24.1	x2,y2: 0,0	Jus:V	H:10	C:1	F:2	z:0	f:Helvetica	b:	i:	s:S	I alt
F:1	A:2	X,Y: 13.2,22.7	x2,y2: 0,0	Jus:V	H:10	C:1	F:2	z:0	f:Helvetica	b:	i:	s:S	Nettosum
F:1	A:2	X,Y: 12,5.9	x2,y2: 0,0	Jus:V	H:11	C:1	F:2	z:0	f:Helvetica	b:on	i:	s:A	Nummer
F:1	A:2	X,Y: 15.8,10.4	x2,y2: 0,0	Jus:V	H:11	C:1	F:2	z:0	f:Helvetica	b:	i:	s:A	Pris
F:1	A:2	X,Y: 12,6.7	x2,y2: 0,0	Jus:V	H:11	C:1	F:2	z:0	f:Helvetica	b:on	i:	s:A	Side
F:1	A:2	X,Y: 17.5,10.4	x2,y2: 0,0	Jus:V	H:11	C:1	F:2	z:0	f:Helvetica	b:	i:	s:A	Sum
F:1	A:2	X,Y: 12,5.3	x2,y2: 0,0	Jus:V	H:15	C:1	F:2	z:0	f:Helvetica	b:on	i:	s:A	Tilbud
F:1	A:2	X,Y: 2.6,27.6	x2,y2: 0,0	Jus:V	H:11	C:1	F:2	z:0	f:Helvetica	b:on	i:	s:A	Tlf:. $egen_tlf
F:1	A:2	X,Y: 13.2,22.7	x2,y2: 0,0	Jus:V	H:10	C:1	F:2	z:0	f:Helvetica	b:	i:	s:!S	Transport til side $formular_nextside
F:1	A:2	X,Y: 2.6,10.4	x2,y2: 0,0	Jus:V	H:11	C:1	F:2	z:0	f:Helvetica	b:	i:	s:A	Varenr
F:1	A:3	X,Y: 14.8,0	x2,y2: 0,0	Jus:H	H:10	C:1	F:3	z:0	f:Helvetica	b:	i:	s:	antal
F:1	A:3	X,Y: 5.6,0	x2,y2: 5.2,0	Jus:V	H:10	C:1	F:3	z:0	f:Helvetica	b:	i:	s:	beskrivelse
F:1	A:3	X,Y: 2.8,11.2	x2,y2: 0.4,0	Jus:	H:0	C:1	F:3	z:0	f:	b:	i:	s:	generelt
F:1	A:3	X,Y: 18.3,0	x2,y2: 0,0	Jus:H	H:10	C:1	F:3	z:0	f:Helvetica	b:	i:	s:	linjesum
F:1	A:3	X,Y: 16.5,0	x2,y2: 0,0	Jus:H	H:10	C:1	F:3	z:0	f:Helvetica	b:	i:	s:	pris
F:1	A:3	X,Y: 2.6,0	x2,y2: 0,0	Jus:V	H:10	C:1	F:3	z:0	f:Helvetica	b:	i:	s:	varenr
F:2	A:1	X,Y: 15,3.2	x2,y2: 0,0	Jus:	H:0	C:2	F:1	z:0	f:	b:	i:	s:	LOGO
F:2	A:1	X,Y: 16.6,23.5	x2,y2: 18.4,23.5	Jus:	H:1	C:2	F:1	z:0	f:	b:	i:	s:	
F:2	A:1	X,Y: 16.6,22.8	x2,y2: 18.4,22.8	Jus:	H:1	C:2	F:1	z:0	f:	b:	i:	s:	
F:2	A:1	X,Y: 2.3,10.7	x2,y2: 2.3,22.1	Jus:	H:1	C:2	F:1	z:0	f:	b:	i:	s:	
F:2	A:1	X,Y: 16.6,24.2	x2,y2: 18.4,24.2	Jus:	H:1	C:2	F:1	z:0	f:	b:	i:	s:	
F:2	A:1	X,Y: 18.4,10.7	x2,y2: 18.4,24.2	Jus:	H:1	C:2	F:1	z:0	f:	b:	i:	s:	
F:2	A:1	X,Y: 2.3,22.1	x2,y2: 18.4,22.1	Jus:	H:1	C:2	F:1	z:0	f:	b:	i:	s:	
F:2	A:1	X,Y: 2.6,4.2	x2,y2: 18.4,4.2	Jus:	H:1	C:2	F:1	z:0	f:	b:	i:	s:	
F:2	A:1	X,Y: 2.3,10.7	x2,y2: 18.4,10.7	Jus:	H:1	C:2	F:1	z:0	f:	b:	i:	s:	
F:2	A:1	X,Y: 16.6,10.7	x2,y2: 16.6,24.2	Jus:	H:1	C:2	F:1	z:0	f:	b:	i:	s:	
F:2	A:2	X,Y: 2.6,26	x2,y2: 0,0	Jus:V	H:11	C:2	F:2	z:0	f:Helvetica	b:on	i:	s:A	$egen_addr1
F:2	A:2	X,Y: 18.3,27.6	x2,y2: 0,0	Jus:H	H:11	C:2	F:2	z:0	f:Helvetica	b:on	i:	s:A	$egen_bank_navn
F:2	A:2	X,Y: 18.3,28	x2,y2: 0,0	Jus:H	H:11	C:2	F:2	z:0	f:Helvetica	b:on	i:	s:A	$egen_bank_reg $egen_bank_konto
F:2	A:2	X,Y: 2.6,25.6	x2,y2: 0,0	Jus:V	H:11	C:2	F:2	z:0	f:Helvetica	b:on	i:	s:A	$eget_firmanavn
F:2	A:2	X,Y: 2.6,3.9	x2,y2: 0,0	Jus:V	H:12	C:2	F:2	z:0	f:Helvetica	b:on	i:on	s:A	$eget_firmanavn * $egen_addr1 * $eget_postnr $eget_bynavn * Danmark
F:2	A:2	X,Y: 18.3,24.1	x2,y2: 0,0	Jus:H	H:10	C:2	F:2	z:0	f:Helvetica	b:on	i:	s:S	$formular_ialt
F:2	A:2	X,Y: 18.3,23.4	x2,y2: 0,0	Jus:H	H:10	C:2	F:2	z:0	f:Helvetica	b:	i:	s:S	$formular_moms
F:2	A:2	X,Y: 16,6.7	x2,y2: 0,0	Jus:V	H:11	C:2	F:2	z:0	f:Helvetica	b:	i:	s:A	$formular_side
F:2	A:2	X,Y: 18.3,22.7	x2,y2: 0,0	Jus:H	H:10	C:2	F:2	z:0	f:Helvetica	b:	i:	s:S	$formular_sum
F:2	A:2	X,Y: 18.3,22.7	x2,y2: 0,0	Jus:H	H:10	C:2	F:2	z:0	f:Helvetica	b:	i:	s:!S	$formular_transportsum
F:2	A:2	X,Y: 2.6,5.9	x2,y2: 0,0	Jus:V	H:11	C:2	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_addr1
F:2	A:2	X,Y: 16,8.3	x2,y2: 0,0	Jus:V	H:11	C:2	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_betalingsbet $ordre_betalingsdage dage
F:2	A:2	X,Y: 2.6,6.3	x2,y2: 0,0	Jus:V	H:11	C:2	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_addr2
F:2	A:2	X,Y: 2.6,5.5	x2,y2: 0,0	Jus:V	H:11	C:2	F:2	z:0	f:Helvetica	b:on	i:	s:A	$ordre_firmanavn
F:2	A:2	X,Y: 6,8.3	x2,y2: 0,0	Jus:V	H:11	C:2	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_kontakt;
F:2	A:2	X,Y: 16,8.7	x2,y2: 0,0	Jus:V	H:11	C:2	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_levdate;
F:2	A:2	X,Y: 13.2,23.4	x2,y2: 0,0	Jus:V	H:10	C:2	F:2	z:0	f:Helvetica	b:	i:	s:S	$ordre_momssats;% moms
F:2	A:2	X,Y: 16,6.3	x2,y2: 0,0	Jus:V	H:11	C:2	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_ordredate;
F:2	A:2	X,Y: 6,8.7	x2,y2: 0,0	Jus:V	H:11	C:2	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_ordrenr
F:2	A:2	X,Y: 16,5.9	x2,y2: 0,0	Jus:V	H:11	C:2	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_ordrenr;
F:2	A:2	X,Y: 2.6,6.7	x2,y2: 0,0	Jus:V	H:11	C:2	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_postnr $ordre_bynavn
F:2	A:2	X,Y: 5.5,10.4	x2,y2: 0,0	Jus:V	H:11	C:2	F:2	z:0	f:Helvetica	b:	i:	s:A	Beskrivelse
F:2	A:2	X,Y: 12,8.3	x2,y2: 0,0	Jus:V	H:11	C:2	F:2	z:0	f:Helvetica	b:on	i:	s:A	Betalingsbet
F:2	A:2	X,Y: 18.3,26.8	x2,y2: 0,0	Jus:H	H:11	C:2	F:2	z:0	f:Helvetica	b:on	i:	s:A	CVR nr: $eget_cvrnr
F:2	A:2	X,Y: 2.6,26.8	x2,y2: 0,0	Jus:V	H:11	C:2	F:2	z:0	f:Helvetica	b:on	i:	s:A	Danmark
F:2	A:2	X,Y: 12,6.3	x2,y2: 0,0	Jus:V	H:11	C:2	F:2	z:0	f:Helvetica	b:on	i:	s:A	Dato
F:2	A:2	X,Y: 2.6,8.7	x2,y2: 0,0	Jus:V	H:11	C:2	F:2	z:0	f:Helvetica	b:on	i:	s:A	Deres ordre nr
F:2	A:2	X,Y: 2.6,8.3	x2,y2: 0,0	Jus:V	H:11	C:2	F:2	z:0	f:Helvetica	b:on	i:	s:A	Deres ref
F:2	A:2	X,Y: 2.6,26.4	x2,y2: 0,0	Jus:V	H:11	C:2	F:2	z:0	f:Helvetica	b:on	i:	s:A	DK-$eget_postnr $eget_bynavn
F:2	A:2	X,Y: 2.6,28	x2,y2: 0,0	Jus:V	H:11	C:2	F:2	z:0	f:Helvetica	b:on	i:	s:A	Fax: $egen_fax
F:2	A:2	X,Y: 12,8.7	x2,y2: 0,0	Jus:V	H:11	C:2	F:2	z:0	f:Helvetica	b:on	i:	s:A	Forventet lev.
F:2	A:2	X,Y: 13.2,24.1	x2,y2: 0,0	Jus:V	H:10	C:2	F:2	z:0	f:Helvetica	b:	i:	s:S	I alt
F:2	A:2	X,Y: 13.2,22.7	x2,y2: 0,0	Jus:V	H:10	C:2	F:2	z:0	f:Helvetica	b:	i:	s:S	Nettosum
F:2	A:2	X,Y: 12,5.9	x2,y2: 0,0	Jus:V	H:11	C:2	F:2	z:0	f:Helvetica	b:on	i:	s:A	Nummer
F:2	A:2	X,Y: 12,5.3	x2,y2: 0,0	Jus:V	H:15	C:2	F:2	z:0	f:Helvetica	b:on	i:	s:A	Ordrebekræftelse
F:2	A:2	X,Y: 15.8,10.4	x2,y2: 0,0	Jus:V	H:11	C:2	F:2	z:0	f:Helvetica	b:	i:	s:A	Pris
F:2	A:2	X,Y: 12,6.7	x2,y2: 0,0	Jus:V	H:11	C:2	F:2	z:0	f:Helvetica	b:on	i:	s:A	Side
F:2	A:2	X,Y: 17.5,10.4	x2,y2: 0,0	Jus:V	H:11	C:2	F:2	z:0	f:Helvetica	b:	i:	s:A	Sum
F:2	A:2	X,Y: 2.6,27.6	x2,y2: 0,0	Jus:V	H:11	C:2	F:2	z:0	f:Helvetica	b:on	i:	s:A	Tlf:. $egen_tlf
F:2	A:2	X,Y: 13.2,22.7	x2,y2: 0,0	Jus:V	H:10	C:2	F:2	z:0	f:Helvetica	b:	i:	s:!S	Transport til side $formular_nextside
F:2	A:2	X,Y: 2.6,10.4	x2,y2: 0,0	Jus:V	H:11	C:2	F:2	z:0	f:Helvetica	b:	i:	s:A	Varenr
F:2	A:3	X,Y: 14.6,0	x2,y2: 0,0	Jus:H	H:10	C:2	F:3	z:0	f:Helvetica	b:	i:	s:	antal
F:2	A:3	X,Y: 5.6,0	x2,y2: 5.2,0	Jus:V	H:10	C:2	F:3	z:0	f:Helvetica	b:	i:	s:	beskrivelse
F:2	A:3	X,Y: 2.8,11.2	x2,y2: 0.4,0	Jus:	H:0	C:2	F:3	z:0	f:	b:	i:	s:	generelt
F:2	A:3	X,Y: 18.3,0	x2,y2: 0,0	Jus:H	H:10	C:2	F:3	z:0	f:Helvetica	b:	i:	s:	linjesum
F:2	A:3	X,Y: 16.5,0	x2,y2: 0,0	Jus:H	H:10	C:2	F:3	z:0	f:Helvetica	b:	i:	s:	pris
F:2	A:3	X,Y: 2.6,0	x2,y2: 0,0	Jus:V	H:10	C:2	F:3	z:0	f:Helvetica	b:	i:	s:	varenr
F:3	A:1	X,Y: 15,3.2	x2,y2: 0,0	Jus:	H:0	C:3	F:1	z:0	f:	b:	i:	s:	LOGO
F:3	A:1	X,Y: 2.3,10.7	x2,y2: 2.3,22.1	Jus:	H:1	C:3	F:1	z:0	f:	b:	i:	s:	
F:3	A:1	X,Y: 2.3,22.1	x2,y2: 18.4,22.1	Jus:	H:1	C:3	F:1	z:0	f:	b:	i:	s:	
F:3	A:1	X,Y: 2.3,10.7	x2,y2: 18.4,10.7	Jus:	H:1	C:3	F:1	z:0	f:	b:	i:	s:	
F:3	A:1	X,Y: 16.6,24.2	x2,y2: 18.4,24.2	Jus:	H:1	C:3	F:1	z:0	f:	b:	i:	s:	
F:3	A:1	X,Y: 16.6,10.7	x2,y2: 16.6,24.2	Jus:	H:1	C:3	F:1	z:0	f:	b:	i:	s:	
F:3	A:1	X,Y: 16.6,22.8	x2,y2: 18.4,22.8	Jus:	H:1	C:3	F:1	z:0	f:	b:	i:	s:	
F:3	A:1	X,Y: 16.6,23.5	x2,y2: 18.4,23.5	Jus:	H:1	C:3	F:1	z:0	f:	b:	i:	s:	
F:3	A:1	X,Y: 2.6,4.2	x2,y2: 18.4,4.2	Jus:	H:1	C:3	F:1	z:0	f:	b:	i:	s:	
F:3	A:1	X,Y: 18.4,10.7	x2,y2: 18.4,24.2	Jus:	H:1	C:3	F:1	z:0	f:	b:	i:	s:	
F:3	A:2	X,Y: 2.6,26	x2,y2: 0,0	Jus:V	H:11	C:3	F:2	z:0	f:Helvetica	b:on	i:	s:A	$egen_addr1
F:3	A:2	X,Y: 18.3,27.6	x2,y2: 0,0	Jus:H	H:11	C:3	F:2	z:0	f:Helvetica	b:on	i:	s:A	$egen_bank_navn
F:3	A:2	X,Y: 18.3,28	x2,y2: 0,0	Jus:H	H:11	C:3	F:2	z:0	f:Helvetica	b:on	i:	s:A	$egen_bank_reg $egen_bank_konto
F:3	A:2	X,Y: 2.6,25.6	x2,y2: 0,0	Jus:V	H:11	C:3	F:2	z:0	f:Helvetica	b:on	i:	s:A	$eget_firmanavn
F:3	A:2	X,Y: 2.6,3.9	x2,y2: 0,0	Jus:V	H:12	C:3	F:2	z:0	f:Helvetica	b:on	i:on	s:A	$eget_firmanavn * $egen_addr1 * $eget_postnr $eget_bynavn * Danmark
F:3	A:2	X,Y: 16,6.7	x2,y2: 0,0	Jus:V	H:11	C:3	F:2	z:0	f:Helvetica	b:	i:	s:A	$formular_side
F:3	A:2	X,Y: 16,6.3	x2,y2: 0,0	Jus:V	H:11	C:3	F:2	z:0	f:Helvetica	b:	i:	s:A	$levering_salgsdate;
F:3	A:2	X,Y: 2.6,5.9	x2,y2: 0,0	Jus:V	H:11	C:3	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_lev_addr1;
F:3	A:2	X,Y: 2.6,6.3	x2,y2: 0,0	Jus:V	H:11	C:3	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_lev_addr2;
F:3	A:2	X,Y: 6,8.3	x2,y2: 0,0	Jus:V	H:11	C:3	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_lev_kontakt;
F:3	A:2	X,Y: 2.6,5.5	x2,y2: 0,0	Jus:V	H:11	C:3	F:2	z:0	f:Helvetica	b:on	i:	s:A	$ordre_lev_navn;
F:3	A:2	X,Y: 2.6,6.7	x2,y2: 0,0	Jus:V	H:11	C:3	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_lev_postnr $ordre_lev_bynavn;
F:3	A:2	X,Y: 6,8.7	x2,y2: 0,0	Jus:V	H:11	C:3	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_ordrenr
F:3	A:2	X,Y: 16,5.9	x2,y2: 0,0	Jus:V	H:11	C:3	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_ordrenr;-$formular_lev_nr;
F:3	A:2	X,Y: 15.8,10.4	x2,y2: 0,0	Jus:V	H:11	C:3	F:2	z:0	f:Helvetica	b:	i:	s:A	Antal
F:3	A:2	X,Y: 5.5,10.4	x2,y2: 0,0	Jus:V	H:11	C:3	F:2	z:0	f:Helvetica	b:	i:	s:A	Beskrivelse
F:3	A:2	X,Y: 18.3,26.8	x2,y2: 0,0	Jus:H	H:11	C:3	F:2	z:0	f:Helvetica	b:on	i:	s:A	CVR nr: $eget_cvrnr
F:3	A:2	X,Y: 2.6,26.8	x2,y2: 0,0	Jus:V	H:11	C:3	F:2	z:0	f:Helvetica	b:on	i:	s:A	Danmark
F:3	A:2	X,Y: 12,6.3	x2,y2: 0,0	Jus:V	H:11	C:3	F:2	z:0	f:Helvetica	b:on	i:	s:A	Dato
F:3	A:2	X,Y: 2.6,8.7	x2,y2: 0,0	Jus:V	H:11	C:3	F:2	z:0	f:Helvetica	b:on	i:	s:A	Deres ordre nr
F:3	A:2	X,Y: 2.6,8.3	x2,y2: 0,0	Jus:V	H:11	C:3	F:2	z:0	f:Helvetica	b:on	i:	s:A	Deres ref:
F:3	A:2	X,Y: 2.6,26.4	x2,y2: 0,0	Jus:V	H:11	C:3	F:2	z:0	f:Helvetica	b:on	i:	s:A	DK-$eget_postnr $eget_bynavn
F:3	A:2	X,Y: 2.6,28	x2,y2: 0,0	Jus:V	H:11	C:3	F:2	z:0	f:Helvetica	b:on	i:	s:A	Fax: $egen_fax
F:3	A:2	X,Y: 12,5.3	x2,y2: 0,0	Jus:V	H:15	C:3	F:2	z:0	f:Helvetica	b:on	i:	s:A	Følgeseddel
F:3	A:2	X,Y: 12,5.9	x2,y2: 0,0	Jus:V	H:11	C:3	F:2	z:0	f:Helvetica	b:on	i:	s:A	Nummer
F:3	A:2	X,Y: 17.5,10.4	x2,y2: 0,0	Jus:V	H:11	C:3	F:2	z:0	f:Helvetica	b:	i:	s:A	Rest
F:3	A:2	X,Y: 12,6.7	x2,y2: 0,0	Jus:V	H:11	C:3	F:2	z:0	f:Helvetica	b:on	i:	s:A	Side
F:3	A:2	X,Y: 2.6,27.6	x2,y2: 0,0	Jus:V	H:11	C:3	F:2	z:0	f:Helvetica	b:on	i:	s:A	Tlf:. $egen_tlf
F:3	A:2	X,Y: 2.6,10.4	x2,y2: 0,0	Jus:V	H:11	C:3	F:2	z:0	f:Helvetica	b:	i:	s:A	Varenr
F:3	A:3	X,Y: 5.6,0	x2,y2: 5.2,0	Jus:V	H:10	C:3	F:3	z:0	f:Helvetica	b:	i:	s:	beskrivelse
F:3	A:3	X,Y: 2.8,11.2	x2,y2: 0.4,0	Jus:	H:0	C:3	F:3	z:0	f:	b:	i:	s:	generelt
F:3	A:3	X,Y: 16.5,0	x2,y2: 0,0	Jus:H	H:10	C:3	F:3	z:0	f:Helvetica	b:	i:	s:	lev_antal
F:3	A:3	X,Y: 18.3,0	x2,y2: 0,0	Jus:H	H:10	C:3	F:3	z:0	f:Helvetica	b:	i:	s:	lev_rest
F:3	A:3	X,Y: 2.6,0	x2,y2: 0,0	Jus:V	H:10	C:3	F:3	z:0	f:Helvetica	b:	i:	s:	varenr
F:4	A:1	X,Y: 15,3.2	x2,y2: 0,0	Jus:	H:0	C:4	F:1	z:0	f:	b:	i:	s:	LOGO
F:4	A:1	X,Y: 16.6,23.5	x2,y2: 18.4,23.5	Jus:	H:1	C:4	F:1	z:0	f:	b:	i:	s:	
F:4	A:1	X,Y: 2.6,4.2	x2,y2: 18.4,4.2	Jus:	H:1	C:4	F:1	z:0	f:	b:	i:	s:	
F:4	A:1	X,Y: 16.6,22.8	x2,y2: 18.4,22.8	Jus:	H:1	C:4	F:1	z:0	f:	b:	i:	s:	
F:4	A:1	X,Y: 16.6,24.2	x2,y2: 18.4,24.2	Jus:	H:1	C:4	F:1	z:0	f:	b:	i:	s:	
F:4	A:1	X,Y: 2.3,22.1	x2,y2: 18.4,22.1	Jus:	H:1	C:4	F:1	z:0	f:	b:	i:	s:	
F:4	A:1	X,Y: 2.3,10.7	x2,y2: 18.4,10.7	Jus:	H:1	C:4	F:1	z:0	f:	b:	i:	s:	
F:4	A:1	X,Y: 16.6,10.7	x2,y2: 16.6,24.2	Jus:	H:1	C:4	F:1	z:0	f:	b:	i:	s:	
F:4	A:1	X,Y: 2.3,10.7	x2,y2: 2.3,22.1	Jus:	H:1	C:4	F:1	z:0	f:	b:	i:	s:	
F:4	A:1	X,Y: 18.4,10.7	x2,y2: 18.4,24.2	Jus:	H:1	C:4	F:1	z:0	f:	b:	i:	s:	
F:4	A:2	X,Y: 2.6,26	x2,y2: 0,0	Jus:V	H:11	C:4	F:2	z:0	f:Helvetica	b:on	i:	s:A	$egen_addr1
F:4	A:2	X,Y: 18.3,27.6	x2,y2: 0,0	Jus:H	H:11	C:4	F:2	z:0	f:Helvetica	b:on	i:	s:A	$egen_bank_navn
F:4	A:2	X,Y: 18.3,28	x2,y2: 0,0	Jus:H	H:11	C:4	F:2	z:0	f:Helvetica	b:on	i:	s:A	$egen_bank_reg $egen_bank_konto
F:4	A:2	X,Y: 2.6,25.6	x2,y2: 0,0	Jus:V	H:11	C:4	F:2	z:0	f:Helvetica	b:on	i:	s:A	$eget_firmanavn
F:4	A:2	X,Y: 2.6,3.9	x2,y2: 0,0	Jus:V	H:12	C:4	F:2	z:0	f:Helvetica	b:on	i:on	s:A	$eget_firmanavn * $egen_addr1 * $eget_postnr $eget_bynavn * Danmark
F:4	A:2	X,Y: 16,8.7	x2,y2: 0,0	Jus:V	H:11	C:4	F:2	z:0	f:Helvetica	b:	i:	s:A	$formular_forfaldsdato
F:4	A:2	X,Y: 18.3,24.1	x2,y2: 0,0	Jus:H	H:10	C:4	F:2	z:0	f:Helvetica	b:on	i:	s:S	$formular_ialt
F:4	A:2	X,Y: 18.3,23.4	x2,y2: 0,0	Jus:H	H:10	C:4	F:2	z:0	f:Helvetica	b:	i:	s:S	$formular_moms
F:4	A:2	X,Y: 16,6.7	x2,y2: 0,0	Jus:V	H:11	C:4	F:2	z:0	f:Helvetica	b:	i:	s:A	$formular_side
F:4	A:2	X,Y: 18.3,22.7	x2,y2: 0,0	Jus:H	H:10	C:4	F:2	z:0	f:Helvetica	b:	i:	s:S	$formular_sum
F:4	A:2	X,Y: 18.3,22.7	x2,y2: 0,0	Jus:H	H:10	C:4	F:2	z:0	f:Helvetica	b:	i:	s:!S	$formular_transportsum
F:4	A:2	X,Y: 2.6,5.9	x2,y2: 0,0	Jus:V	H:11	C:4	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_addr1
F:4	A:2	X,Y: 2.6,6.3	x2,y2: 0,0	Jus:V	H:11	C:4	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_addr2;
F:4	A:2	X,Y: 16,8.3	x2,y2: 0,0	Jus:V	H:11	C:4	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_betalingsbet $ordre_betalingsdage dage
F:4	A:2	X,Y: 16,6.3	x2,y2: 0,0	Jus:V	H:11	C:4	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_fakturadate
F:4	A:2	X,Y: 16,5.9	x2,y2: 0,0	Jus:V	H:11	C:4	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_fakturanr
F:4	A:2	X,Y: 2.6,5.5	x2,y2: 0,0	Jus:V	H:11	C:4	F:2	z:0	f:Helvetica	b:on	i:	s:A	$ordre_firmanavn
F:4	A:2	X,Y: 6,8.3	x2,y2: 0,0	Jus:V	H:11	C:4	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_kundeordnr;
F:4	A:2	X,Y: 13.2,23.4	x2,y2: 0,0	Jus:V	H:10	C:4	F:2	z:0	f:Helvetica	b:	i:	s:S	$ordre_momssats;% moms
F:4	A:2	X,Y: 6,8.7	x2,y2: 0,0	Jus:V	H:11	C:4	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_ordrenr
F:4	A:2	X,Y: 2.6,6.7	x2,y2: 0,0	Jus:V	H:11	C:4	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_postnr $ordre_bynavn
F:4	A:2	X,Y: 14.8,10.4	x2,y2: 0,0	Jus:C	H:11	C:4	F:2	z:0	f:Helvetica	b:	i:	s:A	Antal
F:4	A:2	X,Y: 2.6,7.1	x2,y2: 0,0	Jus:V	H:11	C:4	F:2	z:0	f:Helvetica	b:	i:	s:A	Att: $ordre_kontakt;
F:4	A:2	X,Y: 5.5,10.4	x2,y2: 0,0	Jus:V	H:11	C:4	F:2	z:0	f:Helvetica	b:	i:	s:A	Beskrivelse
F:4	A:2	X,Y: 12,8.3	x2,y2: 0,0	Jus:V	H:11	C:4	F:2	z:0	f:Helvetica	b:on	i:	s:A	Betalingsbet
F:4	A:2	X,Y: 18.3,26.8	x2,y2: 0,0	Jus:H	H:11	C:4	F:2	z:0	f:Helvetica	b:on	i:	s:A	CVR nr: $eget_cvrnr
F:4	A:2	X,Y: 2.6,26.8	x2,y2: 0,0	Jus:V	H:11	C:4	F:2	z:0	f:Helvetica	b:on	i:	s:A	Danmark
F:4	A:2	X,Y: 12,6.3	x2,y2: 0,0	Jus:V	H:11	C:4	F:2	z:0	f:Helvetica	b:on	i:	s:A	Dato
F:4	A:2	X,Y: 2.6,8.3	x2,y2: 0,0	Jus:V	H:11	C:4	F:2	z:0	f:Helvetica	b:on	i:	s:A	Deres ref:
F:4	A:2	X,Y: 2.6,26.4	x2,y2: 0,0	Jus:V	H:11	C:4	F:2	z:0	f:Helvetica	b:on	i:	s:A	DK-$eget_postnr $eget_bynavn
F:4	A:2	X,Y: 12,5.3	x2,y2: 0,0	Jus:V	H:15	C:4	F:2	z:0	f:Helvetica	b:on	i:	s:A	Faktura
F:4	A:2	X,Y: 2.6,28	x2,y2: 0,0	Jus:V	H:11	C:4	F:2	z:0	f:Helvetica	b:on	i:	s:A	Fax: $egen_fax
F:4	A:2	X,Y: 12,8.7	x2,y2: 0,0	Jus:V	H:11	C:4	F:2	z:0	f:Helvetica	b:on	i:	s:A	Forfaldsdato
F:4	A:2	X,Y: 13.2,24.1	x2,y2: 0,0	Jus:V	H:10	C:4	F:2	z:0	f:Helvetica	b:	i:	s:S	I alt
F:4	A:2	X,Y: 13.2,22.7	x2,y2: 0,0	Jus:V	H:10	C:4	F:2	z:0	f:Helvetica	b:	i:	s:S	Nettosum
F:4	A:2	X,Y: 12,5.9	x2,y2: 0,0	Jus:V	H:11	C:4	F:2	z:0	f:Helvetica	b:on	i:	s:A	Nummer
F:4	A:2	X,Y: 15.8,10.4	x2,y2: 0,0	Jus:V	H:11	C:4	F:2	z:0	f:Helvetica	b:	i:	s:A	Pris
F:4	A:2	X,Y: 12,6.7	x2,y2: 0,0	Jus:V	H:11	C:4	F:2	z:0	f:Helvetica	b:on	i:	s:A	Side
F:4	A:2	X,Y: 17.5,10.4	x2,y2: 0,0	Jus:V	H:11	C:4	F:2	z:0	f:Helvetica	b:	i:	s:A	Sum
F:4	A:2	X,Y: 2.6,27.6	x2,y2: 0,0	Jus:V	H:11	C:4	F:2	z:0	f:Helvetica	b:on	i:	s:A	Tlf:. $egen_tlf
F:4	A:2	X,Y: 13.2,22.7	x2,y2: 0,0	Jus:V	H:10	C:4	F:2	z:0	f:Helvetica	b:	i:	s:!S	Transport til side $formular_nextside
F:4	A:2	X,Y: 2.6,10.4	x2,y2: 0,0	Jus:V	H:11	C:4	F:2	z:0	f:Helvetica	b:	i:	s:A	Varenr
F:4	A:2	X,Y: 2.6,8.7	x2,y2: 0,0	Jus:V	H:11	C:4	F:2	z:0	f:Helvetica	b:on	i:	s:A	Vores ordre nr
F:4	A:3	X,Y: 14.8,0	x2,y2: 0,0	Jus:H	H:10	C:4	F:3	z:0	f:Helvetica	b:	i:	s:	antal
F:4	A:3	X,Y: 5.6,0	x2,y2: 4.8,0	Jus:V	H:10	C:4	F:3	z:0	f:Helvetica	b:	i:	s:	beskrivelse
F:4	A:3	X,Y: 2.8,11.2	x2,y2: 0.4,0	Jus:	H:0	C:4	F:3	z:0	f:	b:	i:	s:	generelt
F:4	A:3	X,Y: 18.3,0	x2,y2: 0,0	Jus:H	H:10	C:4	F:3	z:0	f:Helvetica	b:	i:	s:	linjesum
F:4	A:3	X,Y: 16.5,0	x2,y2: 0,0	Jus:H	H:10	C:4	F:3	z:0	f:Helvetica	b:	i:	s:	pris
F:4	A:3	X,Y: 2.6,0	x2,y2: 0,0	Jus:V	H:10	C:4	F:3	z:0	f:Helvetica	b:	i:	s:	varenr
F:5	A:1	X,Y: 15,3.2	x2,y2: 0,0	Jus:	H:0	C:5	F:1	z:0	f:	b:	i:	s:	LOGO
F:5	A:1	X,Y: 16.6,24.2	x2,y2: 18.4,24.2	Jus:	H:1	C:5	F:1	z:0	f:	b:	i:	s:	
F:5	A:1	X,Y: 16.6,22.8	x2,y2: 18.4,22.8	Jus:	H:1	C:5	F:1	z:0	f:	b:	i:	s:	
F:5	A:1	X,Y: 16.6,23.5	x2,y2: 18.4,23.5	Jus:	H:1	C:5	F:1	z:0	f:	b:	i:	s:	
F:5	A:1	X,Y: 2.3,10.7	x2,y2: 2.3,22.1	Jus:	H:1	C:5	F:1	z:0	f:	b:	i:	s:	
F:5	A:1	X,Y: 16.6,10.7	x2,y2: 16.6,24.2	Jus:	H:1	C:5	F:1	z:0	f:	b:	i:	s:	
F:5	A:1	X,Y: 2.6,4.2	x2,y2: 18.4,4.2	Jus:	H:1	C:5	F:1	z:0	f:	b:	i:	s:	
F:5	A:1	X,Y: 2.3,22.1	x2,y2: 18.4,22.1	Jus:	H:1	C:5	F:1	z:0	f:	b:	i:	s:	
F:5	A:1	X,Y: 2.3,10.7	x2,y2: 18.4,10.7	Jus:	H:1	C:5	F:1	z:0	f:	b:	i:	s:	
F:5	A:1	X,Y: 18.4,10.7	x2,y2: 18.4,24.2	Jus:	H:1	C:5	F:1	z:0	f:	b:	i:	s:	
F:5	A:2	X,Y: 2.6,26	x2,y2: 0,0	Jus:V	H:11	C:5	F:2	z:0	f:Helvetica	b:on	i:	s:A	$egen_addr1
F:5	A:2	X,Y: 18.3,27.6	x2,y2: 0,0	Jus:H	H:11	C:5	F:2	z:0	f:Helvetica	b:on	i:	s:A	$egen_bank_navn
F:5	A:2	X,Y: 18.3,28	x2,y2: 0,0	Jus:H	H:11	C:5	F:2	z:0	f:Helvetica	b:on	i:	s:A	$egen_bank_reg $egen_bank_konto
F:5	A:2	X,Y: 2.6,25.6	x2,y2: 0,0	Jus:V	H:11	C:5	F:2	z:0	f:Helvetica	b:on	i:	s:A	$eget_firmanavn
F:5	A:2	X,Y: 2.6,3.9	x2,y2: 0,0	Jus:V	H:12	C:5	F:2	z:0	f:Helvetica	b:on	i:on	s:A	$eget_firmanavn * $egen_addr1 * $eget_postnr $eget_bynavn * Danmark
F:5	A:2	X,Y: 16,8.7	x2,y2: 0,0	Jus:V	H:11	C:5	F:2	z:0	f:Helvetica	b:	i:	s:A	$formular_forfaldsdato
F:5	A:2	X,Y: 18.3,24.1	x2,y2: 0,0	Jus:H	H:10	C:5	F:2	z:0	f:Helvetica	b:on	i:	s:S	$formular_ialt
F:5	A:2	X,Y: 18.3,23.4	x2,y2: 0,0	Jus:H	H:10	C:5	F:2	z:0	f:Helvetica	b:	i:	s:S	$formular_moms
F:5	A:2	X,Y: 16,6.7	x2,y2: 0,0	Jus:V	H:11	C:5	F:2	z:0	f:Helvetica	b:	i:	s:A	$formular_side
F:5	A:2	X,Y: 18.3,22.7	x2,y2: 0,0	Jus:H	H:10	C:5	F:2	z:0	f:Helvetica	b:	i:	s:S	$formular_sum
F:5	A:2	X,Y: 18.3,22.7	x2,y2: 0,0	Jus:H	H:10	C:5	F:2	z:0	f:Helvetica	b:	i:	s:!S	$formular_transportsum
F:5	A:2	X,Y: 2.6,5.9	x2,y2: 0,0	Jus:V	H:11	C:5	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_addr1
F:5	A:2	X,Y: 16,8.3	x2,y2: 0,0	Jus:V	H:11	C:5	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_betalingsbet $ordre_betalingsdage dage
F:5	A:2	X,Y: 2.6,6.3	x2,y2: 0,0	Jus:V	H:11	C:5	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_bynavn
F:5	A:2	X,Y: 16,6.3	x2,y2: 0,0	Jus:V	H:11	C:5	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_fakturadate
F:5	A:2	X,Y: 16,5.9	x2,y2: 0,0	Jus:V	H:11	C:5	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_fakturanr
F:5	A:2	X,Y: 2.6,5.5	x2,y2: 0,0	Jus:V	H:11	C:5	F:2	z:0	f:Helvetica	b:on	i:	s:A	$ordre_firmanavn
F:5	A:2	X,Y: 13.2,23.4	x2,y2: 0,0	Jus:V	H:10	C:5	F:2	z:0	f:Helvetica	b:	i:	s:S	$ordre_momssats;% moms
F:5	A:2	X,Y: 6,8.7	x2,y2: 0,0	Jus:V	H:11	C:5	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_ordrenr
F:5	A:2	X,Y: 2.6,6.7	x2,y2: 0,0	Jus:V	H:11	C:5	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_postnr $ordre_bynavn
F:5	A:2	X,Y: 5.5,10.4	x2,y2: 0,0	Jus:V	H:11	C:5	F:2	z:0	f:Helvetica	b:	i:	s:A	Beskrivelse
F:5	A:2	X,Y: 12,8.3	x2,y2: 0,0	Jus:V	H:11	C:5	F:2	z:0	f:Helvetica	b:on	i:	s:A	Betalingsbet
F:5	A:2	X,Y: 18.3,26.8	x2,y2: 0,0	Jus:H	H:11	C:5	F:2	z:0	f:Helvetica	b:on	i:	s:A	CVR nr: $eget_cvrnr
F:5	A:2	X,Y: 2.6,26.8	x2,y2: 0,0	Jus:V	H:11	C:5	F:2	z:0	f:Helvetica	b:on	i:	s:A	Danmark
F:5	A:2	X,Y: 12,6.3	x2,y2: 0,0	Jus:V	H:11	C:5	F:2	z:0	f:Helvetica	b:on	i:	s:A	Dato
F:5	A:2	X,Y: 2.6,8.7	x2,y2: 0,0	Jus:V	H:11	C:5	F:2	z:0	f:Helvetica	b:on	i:	s:A	Deres ordre nr
F:5	A:2	X,Y: 2.6,8.3	x2,y2: 0,0	Jus:V	H:11	C:5	F:2	z:0	f:Helvetica	b:on	i:	s:A	Deres ref:
F:5	A:2	X,Y: 2.6,26.4	x2,y2: 0,0	Jus:V	H:11	C:5	F:2	z:0	f:Helvetica	b:on	i:	s:A	DK-$eget_postnr $eget_bynavn
F:5	A:2	X,Y: 2.6,28	x2,y2: 0,0	Jus:V	H:11	C:5	F:2	z:0	f:Helvetica	b:on	i:	s:A	Fax: $egen_fax
F:5	A:2	X,Y: 12,8.7	x2,y2: 0,0	Jus:V	H:11	C:5	F:2	z:0	f:Helvetica	b:on	i:	s:A	Forfaldsdato
F:5	A:2	X,Y: 13.2,24.1	x2,y2: 0,0	Jus:V	H:10	C:5	F:2	z:0	f:Helvetica	b:	i:	s:S	I alt
F:5	A:2	X,Y: 12,5.3	x2,y2: 0,0	Jus:V	H:15	C:5	F:2	z:0	f:Helvetica	b:on	i:	s:A	Kreditnota
F:5	A:2	X,Y: 13.2,22.7	x2,y2: 0,0	Jus:V	H:10	C:5	F:2	z:0	f:Helvetica	b:	i:	s:S	Nettosum
F:5	A:2	X,Y: 12,5.9	x2,y2: 0,0	Jus:V	H:11	C:5	F:2	z:0	f:Helvetica	b:on	i:	s:A	Nummer
F:5	A:2	X,Y: 15.8,10.4	x2,y2: 0,0	Jus:V	H:11	C:5	F:2	z:0	f:Helvetica	b:	i:	s:A	Pris
F:5	A:2	X,Y: 12,6.7	x2,y2: 0,0	Jus:V	H:11	C:5	F:2	z:0	f:Helvetica	b:on	i:	s:A	Side
F:5	A:2	X,Y: 17.5,10.4	x2,y2: 0,0	Jus:V	H:11	C:5	F:2	z:0	f:Helvetica	b:	i:	s:A	Sum
F:5	A:2	X,Y: 2.6,27.6	x2,y2: 0,0	Jus:V	H:11	C:5	F:2	z:0	f:Helvetica	b:on	i:	s:A	Tlf:. $egen_tlf
F:5	A:2	X,Y: 13.2,22.7	x2,y2: 0,0	Jus:V	H:10	C:5	F:2	z:0	f:Helvetica	b:	i:	s:!S	Transport til side $formular_nextside
F:5	A:2	X,Y: 2.6,10.4	x2,y2: 0,0	Jus:V	H:11	C:5	F:2	z:0	f:Helvetica	b:	i:	s:A	Varenr
F:5	A:3	X,Y: 14.6,0	x2,y2: 0,0	Jus:H	H:10	C:5	F:3	z:0	f:Helvetica	b:	i:	s:	antal
F:5	A:3	X,Y: 5.6,0	x2,y2: 5.2,0	Jus:V	H:10	C:5	F:3	z:0	f:Helvetica	b:	i:	s:	beskrivelse
F:5	A:3	X,Y: 2.8,11.2	x2,y2: 0.4,0	Jus:	H:0	C:5	F:3	z:0	f:	b:	i:	s:	generelt
F:5	A:3	X,Y: 18.3,0	x2,y2: 0,0	Jus:H	H:10	C:5	F:3	z:0	f:Helvetica	b:	i:	s:	linjesum
F:5	A:3	X,Y: 16.5,0	x2,y2: 0,0	Jus:H	H:10	C:5	F:3	z:0	f:Helvetica	b:	i:	s:	pris
F:5	A:3	X,Y: 2.6,0	x2,y2: 0,0	Jus:V	H:10	C:5	F:3	z:0	f:Helvetica	b:	i:	s:	varenr
F:6	A:1	X,Y: 15,3.2	x2,y2: 0,0	Jus:	H:0	C:6	F:1	z:0	f:	b:	i:	s:	LOGO
F:6	A:1	X,Y: 2.6,28.2	x2,y2: 18.4,28.2	Jus:	H:1	C:6	F:1	z:0	f:	b:	i:	s:	
F:6	A:1	X,Y: 2.6,4.2	x2,y2: 18.4,4.2	Jus:	H:1	C:6	F:1	z:0	f:	b:	i:	s:	
F:6	A:2	X,Y: 16,6.3	x2,y2: 0,0	Jus:V	H:11	C:6	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_ordredate;
F:6	A:2	X,Y: 2.6,16.2	x2,y2: 0,0	Jus:V	H:11	C:6	F:2	z:0	f:Helvetica	b:	i:	s:A	$egen_bank_navn;, kontonummer: $egen_bank_reg; $egen_bank_konto;
F:6	A:2	X,Y: 2.6,3.9	x2,y2: 0,0	Jus:V	H:12	C:6	F:2	z:0	f:Helvetica	b:on	i:on	s:A	$eget_firmanavn * $egen_addr1 * $eget_postnr $eget_bynavn * Danmark
F:6	A:2	X,Y: 2.6,19.7	x2,y2: 0,0	Jus:V	H:11	C:6	F:2	z:0	f:Helvetica	b:on	i:	s:A	$eget_firmanavn;
F:6	A:2	X,Y: 10.5,28.8	x2,y2: 0,0	Jus:C	H:8	C:6	F:2	z:0	f:Helvetica	b:	i:	s:A	$eget_firmanavn; * $egen_addr1; * $eget_postnr; * $eget_bynavn;
F:6	A:2	X,Y: 2.6,5.9	x2,y2: 0,0	Jus:V	H:11	C:6	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_addr1
F:6	A:2	X,Y: 2.6,6.3	x2,y2: 0,0	Jus:V	H:11	C:6	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_addr2;
F:6	A:2	X,Y: 2.6,5.5	x2,y2: 0,0	Jus:V	H:11	C:6	F:2	z:0	f:Helvetica	b:on	i:	s:A	$ordre_firmanavn
F:6	A:2	X,Y: 2.6,6.7	x2,y2: 0,0	Jus:V	H:11	C:6	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_postnr $ordre_bynavn
F:6	A:2	X,Y: 10.5,29.2	x2,y2: 0,0	Jus:C	H:8	C:6	F:2	z:0	f:Helvetica	b:	i:	s:A	Cvr.: $eget_cvrnr; * Tlf: $egen_tlf; * Fax: $egen_fax; * $egen_bank_navn; $egen_bank_reg; $egen_bank_konto;
F:6	A:2	X,Y: 15,6.3	x2,y2: 0,0	Jus:V	H:11	C:6	F:2	z:0	f:Helvetica	b:	i:	s:A	Dato
F:6	A:2	X,Y: 0,0	x2,y2: 10,0	Jus:	H:	C:6	F:2	z:	f:	b:	i:	s:	GEBYR
F:6	A:2	X,Y: 2.6,15.2	x2,y2: 0,0	Jus:V	H:11	C:6	F:2	z:0	f:Helvetica	b:	i:	s:A	Gebyr for denne skrivelse udgør kr. $rykker_gebyr;.
F:6	A:2	X,Y: 2.6,14.7	x2,y2: 0,0	Jus:V	H:11	C:6	F:2	z:0	f:Helvetica	b:	i:	s:A	I så fald beder vi Dem se bort fra dette brev.
F:6	A:2	X,Y: 2.6,19.2	x2,y2: 0,0	Jus:V	H:11	C:6	F:2	z:0	f:Helvetica	b:	i:	s:A	Med venlig hilsen
F:6	A:2	X,Y: 2.6,11.7	x2,y2: 0,0	Jus:V	H:15	C:6	F:2	z:0	f:Helvetica	b:on	i:	s:A	Rykkerbrev
F:6	A:2	X,Y: 2.6,14.2	x2,y2: 0,0	Jus:V	H:11	C:6	F:2	z:0	f:Helvetica	b:	i:	s:A	Såfremt beløbet er indbetalt inden for de seneste dage, kan indbetalingen have krydset dette brev.
F:6	A:2	X,Y: 2.6,13.7	x2,y2: 0,0	Jus:V	H:11	C:6	F:2	z:0	f:Helvetica	b:	i:	s:A	Ved gennemgang af vores bogholderi, har vi konstateret et forfaldent tilgodehavende på kr. $forfalden_sum
F:6	A:2	X,Y: 2.6,15.7	x2,y2: 0,0	Jus:V	H:11	C:6	F:2	z:0	f:Helvetica	b:	i:	s:S	Vores samlede tilgodehavende udgør herefter kr. $formular_ialt;, som bedes indbetalt inden 8 dage til
F:6	A:3	X,Y: 3.4,11.2	x2,y2: 0.4,0	Jus:	H:	C:6	F:3	z:	f:	b:	i:	s:	generelt
F:7	A:1	X,Y: 2.6,28.2	x2,y2: 18.4,28.2	Jus:	H:1	C:7	F:1	z:0	f:	b:	i:	s:	
F:7	A:1	X,Y: 2.6,4.2	x2,y2: 18.4,4.2	Jus:	H:1	C:7	F:1	z:0	f:	b:	i:	s:	
F:7	A:2	X,Y: 16,6.3	x2,y2: 0,0	Jus:V	H:11	C:7	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_ordredate;
F:7	A:2	X,Y: 2.6,16.2	x2,y2: 0,0	Jus:V	H:11	C:7	F:2	z:0	f:Helvetica	b:	i:	s:A	$egen_bank_navn;, kontonummer: $egen_bank_reg; $egen_bank_konto;
F:7	A:2	X,Y: 2.6,3.9	x2,y2: 0,0	Jus:V	H:12	C:7	F:2	z:0	f:Helvetica	b:on	i:on	s:A	$eget_firmanavn * $egen_addr1 * $eget_postnr $eget_bynavn * Danmark
F:7	A:2	X,Y: 2.6,19.7	x2,y2: 0,0	Jus:V	H:11	C:7	F:2	z:0	f:Helvetica	b:on	i:	s:A	$eget_firmanavn;
F:7	A:2	X,Y: 10.5,28.8	x2,y2: 0,0	Jus:C	H:8	C:7	F:2	z:0	f:Helvetica	b:	i:	s:A	$eget_firmanavn; * $egen_addr1; * $eget_postnr; * $eget_bynavn;
F:7	A:2	X,Y: 2.6,5.9	x2,y2: 0,0	Jus:V	H:11	C:7	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_addr1
F:7	A:2	X,Y: 2.6,6.3	x2,y2: 0,0	Jus:V	H:11	C:7	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_addr2;
F:7	A:2	X,Y: 2.6,5.5	x2,y2: 0,0	Jus:V	H:11	C:7	F:2	z:0	f:Helvetica	b:on	i:	s:A	$ordre_firmanavn
F:7	A:2	X,Y: 2.6,6.7	x2,y2: 0,0	Jus:V	H:11	C:7	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_postnr $ordre_bynavn
F:7	A:2	X,Y: 10.5,29.2	x2,y2: 0,0	Jus:C	H:8	C:7	F:2	z:0	f:Helvetica	b:	i:	s:A	Cvr.: $eget_cvrnr; * Tlf: $egen_tlf; * Fax: $egen_fax; * $egen_bank_navn; $egen_bank_reg; $egen_bank_konto;
F:7	A:2	X,Y: 15,6.3	x2,y2: 0,0	Jus:V	H:11	C:7	F:2	z:0	f:Helvetica	b:	i:	s:A	Dato
F:7	A:2	X,Y: 0,0	x2,y2: 10,0	Jus:	H:	C:7	F:2	z:	f:	b:	i:	s:	GEBYR
F:7	A:2	X,Y: 2.6,15.2	x2,y2: 0,0	Jus:V	H:11	C:7	F:2	z:0	f:Helvetica	b:	i:	s:A	Gebyr for denne skrivelse udgør kr. $rykker_gebyr;.
F:7	A:2	X,Y: 2.6,14.7	x2,y2: 0,0	Jus:V	H:11	C:7	F:2	z:0	f:Helvetica	b:	i:	s:A	I så fald beder vi Dem se bort fra dette brev.
F:7	A:2	X,Y: 2.6,19.2	x2,y2: 0,0	Jus:V	H:11	C:7	F:2	z:0	f:Helvetica	b:	i:	s:A	Med venlig hilsen
F:7	A:2	X,Y: 2.6,11.7	x2,y2: 0,0	Jus:V	H:15	C:7	F:2	z:0	f:Helvetica	b:on	i:	s:A	2. Rykker
F:7	A:2	X,Y: 2.6,14.2	x2,y2: 0,0	Jus:V	H:11	C:7	F:2	z:0	f:Helvetica	b:	i:	s:A	Såfremt beløbet er indbetalt inden for de seneste dage, kan indbetalingen have krydset dette brev.
F:7	A:2	X,Y: 2.6,13.7	x2,y2: 0,0	Jus:V	H:11	C:7	F:2	z:0	f:Helvetica	b:	i:	s:A	Ved gennemgang af vores bogholderi, har vi konstateret et forfaldent tilgodehavende på kr. $forfalden_sum
F:7	A:2	X,Y: 2.6,15.7	x2,y2: 0,0	Jus:V	H:11	C:7	F:2	z:0	f:Helvetica	b:	i:	s:S	Vores samlede tilgodehavende udgør herefter kr. $formular_ialt;, som bedes indbetalt inden 8 dage til
F:7	A:3	X,Y: 3.4,11.2	x2,y2: 0.4,0	Jus:	H:	C:7	F:3	z:	f:	b:	i:	s:	generelt
F:8	A:1	X,Y: 2.6,28.2	x2,y2: 18.4,28.2	Jus:	H:1	C:8	F:1	z:0	f:	b:	i:	s:	
F:8	A:1	X,Y: 2.6,4.2	x2,y2: 18.4,4.2	Jus:	H:1	C:8	F:1	z:0	f:	b:	i:	s:	
F:8	A:2	X,Y: 16,6.3	x2,y2: 0,0	Jus:V	H:11	C:8	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_ordredate;
F:8	A:2	X,Y: 2.6,16.2	x2,y2: 0,0	Jus:V	H:11	C:8	F:2	z:0	f:Helvetica	b:	i:	s:A	$egen_bank_navn;, kontonummer: $egen_bank_reg; $egen_bank_konto;
F:8	A:2	X,Y: 2.6,3.9	x2,y2: 0,0	Jus:V	H:12	C:8	F:2	z:0	f:Helvetica	b:on	i:on	s:A	$eget_firmanavn * $egen_addr1 * $eget_postnr $eget_bynavn * Danmark
F:8	A:2	X,Y: 2.6,19.7	x2,y2: 0,0	Jus:V	H:11	C:8	F:2	z:0	f:Helvetica	b:on	i:	s:A	$eget_firmanavn;
F:8	A:2	X,Y: 10.5,28.8	x2,y2: 0,0	Jus:C	H:8	C:8	F:2	z:0	f:Helvetica	b:	i:	s:A	$eget_firmanavn; * $egen_addr1; * $eget_postnr; * $eget_bynavn;
F:8	A:2	X,Y: 2.6,5.9	x2,y2: 0,0	Jus:V	H:11	C:8	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_addr1
F:8	A:2	X,Y: 2.6,6.3	x2,y2: 0,0	Jus:V	H:11	C:8	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_addr2;
F:8	A:2	X,Y: 2.6,5.5	x2,y2: 0,0	Jus:V	H:11	C:8	F:2	z:0	f:Helvetica	b:on	i:	s:A	$ordre_firmanavn
F:8	A:2	X,Y: 2.6,6.7	x2,y2: 0,0	Jus:V	H:11	C:8	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_postnr $ordre_bynavn
F:8	A:2	X,Y: 10.5,29.2	x2,y2: 0,0	Jus:C	H:8	C:8	F:2	z:0	f:Helvetica	b:	i:	s:A	Cvr.: $eget_cvrnr; * Tlf: $egen_tlf; * Fax: $egen_fax; * $egen_bank_navn; $egen_bank_reg; $egen_bank_konto;
F:8	A:2	X,Y: 15,6.3	x2,y2: 0,0	Jus:V	H:11	C:8	F:2	z:0	f:Helvetica	b:	i:	s:A	Dato
F:8	A:2	X,Y: 0,0	x2,y2: 10,0	Jus:	H:	C:8	F:2	z:	f:	b:	i:	s:	GEBYR
F:8	A:2	X,Y: 2.6,15.2	x2,y2: 0,0	Jus:V	H:11	C:8	F:2	z:0	f:Helvetica	b:	i:	s:A	Gebyr for denne skrivelse udgør kr. $rykker_gebyr;.
F:8	A:2	X,Y: 2.6,14.7	x2,y2: 0,0	Jus:V	H:11	C:8	F:2	z:0	f:Helvetica	b:	i:	s:A	I så fald beder vi Dem se bort fra dette brev.
F:8	A:2	X,Y: 2.6,19.2	x2,y2: 0,0	Jus:V	H:11	C:8	F:2	z:0	f:Helvetica	b:	i:	s:A	Med venlig hilsen
F:8	A:2	X,Y: 2.6,11.7	x2,y2: 0,0	Jus:V	H:15	C:8	F:2	z:0	f:Helvetica	b:on	i:	s:A	3. Rykker
F:8	A:2	X,Y: 2.6,14.2	x2,y2: 0,0	Jus:V	H:11	C:8	F:2	z:0	f:Helvetica	b:	i:	s:A	Såfremt beløbet er indbetalt inden for de seneste dage, kan indbetalingen have krydset dette brev.
F:8	A:2	X,Y: 2.6,13.7	x2,y2: 0,0	Jus:V	H:11	C:8	F:2	z:0	f:Helvetica	b:	i:	s:A	Ved gennemgang af vores bogholderi, har vi konstateret et forfaldent tilgodehavende på kr. $forfalden_sum
F:8	A:2	X,Y: 2.6,15.7	x2,y2: 0,0	Jus:V	H:11	C:8	F:2	z:0	f:Helvetica	b:	i:	s:S	Vores samlede tilgodehavende udgør herefter kr. $formular_ialt;, som bedes indbetalt inden 8 dage til
F:8	A:3	X,Y: 3.4,11.2	x2,y2: 0.4,0	Jus:	H:	C:8	F:3	z:	f:	b:	i:	s:	generelt
F:1	A:5	X,Y: 0.1,0	x2,y2: 0,0	Jus:	H:10	C:1	F:5	z:0	f:	b:	i:	s:	Tilbud
F:1	A:5	X,Y: 0.2,0	x2,y2: 0,0	Jus:	H:10	C:1	F:5	z:0	f:	b:	i:	s:	Hermed fremsendes tilbud
F:2	A:5	X,Y: 0.1,0	x2,y2: 0,0	Jus:	H:10	C:2	F:5	z:0	f:	b:	i:	s:	Ordrebekræftelse
F:2	A:5	X,Y: 0.2,0	x2,y2: 0,0	Jus:	H:10	C:2	F:5	z:0	f:	b:	i:	s:	Hermed fremsendes ordrebekræftelse
F:4	A:5	X,Y: 0.1,0	x2,y2: 0,0	Jus:	H:10	C:4	F:5	z:0	f:	b:	i:	s:	Faktura
F:4	A:5	X,Y: 0.2,0	x2,y2: 0,0	Jus:	H:10	C:4	F:5	z:0	f:	b:	i:	s:	Hermed fremsendes faktura
F:5	A:5	X,Y: 0.1,0	x2,y2: 0,0	Jus:	H:10	C:5	F:5	z:0	f:	b:	i:	s:	Kreditnota
F:5	A:5	X,Y: 0.2,0	x2,y2: 0,0	Jus:	H:10	C:5	F:5	z:0	f:	b:	i:	s:	Hermed fremsendes kreditnota
F:6	A:5	X,Y: 0.1,0	x2,y2: 0,0	Jus:	H:10	C:6	F:5	z:0	f:	b:	i:	s:	Rykker
F:6	A:5	X,Y: 0.2,0	x2,y2: 0,0	Jus:	H:10	C:6	F:5	z:0	f:	b:	i:	s:	Hermed fremsendes rykker
F:7	A:5	X,Y: 0.1,0	x2,y2: 0,0	Jus:	H:10	C:7	F:5	z:0	f:	b:	i:	s:	Rykker
F:7	A:5	X,Y: 0.2,0	x2,y2: 0,0	Jus:	H:10	C:7	F:5	z:0	f:	b:	i:	s:	Hermed fremsendes rykker
F:8	A:5	X,Y: 0.1,0	x2,y2: 0,0	Jus:	H:10	C:8	F:5	z:0	f:	b:	i:	s:	Rykker
F:8	A:5	X,Y: 0.2,0	x2,y2: 0,0	Jus:	H:10	C:8	F:5	z:0	f:	b:	i:	s:	Hermed fremsendes rykker
F:11	A:2	X,Y: 2.3,7.7	x2,y2: 0,0	Jus:	H:12	C:11	F:2	z:0	f:Helvetica	b:on	i:	s:A	Kontoudtog
F:11	A:2	X,Y: 2.3,6.1	x2,y2: 0,0	Jus:	H:10	C:11	F:2	z:0	f:Helvetica	b:	i:	s:A	$adresser_postnr; $adresser_bynavn
F:11	A:2	X,Y: 14,10.7	x2,y2: 0,0	Jus:H	H:10	C:11	F:2	z:0	f:Helvetica	b:on	i:	s:A	Forfaldsdato
F:11	A:2	X,Y: 7,10.7	x2,y2: 0,0	Jus:	H:10	C:11	F:2	z:0	f:Helvetica	b:on	i:	s:A	Beskrivelse
F:11	A:2	X,Y: 4.5,10.7	x2,y2: 0,0	Jus:	H:10	C:11	F:2	z:0	f:Helvetica	b:on	i:	s:A	Faktura
F:11	A:2	X,Y: 2.3,10.7	x2,y2: 0,0	Jus:	H:10	C:11	F:2	z:0	f:Helvetica	b:on	i:	s:A	Dato
F:11	A:2	X,Y: 16,10.7	x2,y2: 0,0	Jus:H	H:10	C:11	F:2	z:0	f:Helvetica	b:on	i:	s:A	Debet
F:11	A:2	X,Y: 18,10.7	x2,y2: 0,0	Jus:H	H:10	C:11	F:2	z:0	f:Helvetica	b:on	i:	s:A	Kredit
F:11	A:2	X,Y: 2.3,4.9	x2,y2: 0,0	Jus:	H:10	C:11	F:2	z:0	f:Helvetica	b:	i:	s:A	$adresser_firmanavn
F:11	A:2	X,Y: 20,10.7	x2,y2: 0,0	Jus:H	H:10	C:11	F:2	z:0	f:Helvetica	b:on	i:	s:A	Saldo
F:11	A:2	X,Y: 2.3,5.3	x2,y2: 0,0	Jus:	H:10	C:11	F:2	z:0	f:Helvetica	b:	i:	s:A	$adresser_addr1
F:11	A:2	X,Y: 2.3,5.7	x2,y2: 0,0	Jus:	H:10	C:11	F:2	z:0	f:Helvetica	b:	i:	s:A	$adresser_addr2
F:11	A:3	X,Y: 2.2,0	x2,y2: 0,0	Jus:V	H:10	C:11	F:3	z:0	f:Helvetica	b:	i:	s:	dato
F:11	A:3	X,Y: 7,0	x2,y2: 3,0	Jus:V	H:10	C:11	F:3	z:0	f:Helvetica	b:	i:	s:	beskrivelse
F:11	A:3	X,Y: 16,0	x2,y2: 0,0	Jus:H	H:10	C:11	F:3	z:0	f:Helvetica	b:	i:	s:	debet
F:11	A:3	X,Y: 18,0	x2,y2: 0,0	Jus:H	H:10	C:11	F:3	z:0	f:Helvetica	b:	i:	s:	kredit
F:11	A:3	X,Y: 3.4,11.2	x2,y2: 0.4,0	Jus:	H:0	C:11	F:3	z:0	f:	b:	i:	s:	generelt
F:11	A:3	X,Y: 14,0	x2,y2: 0,0	Jus:H	H:10	C:11	F:3	z:0	f:Helvetica	b:	i:	s:	forfaldsdato
F:11	A:3	X,Y: 20,0	x2,y2: 0,0	Jus:H	H:10	C:11	F:3	z:0	f:Helvetica	b:	i:	s:	saldo
F:11	A:3	X,Y: 4.8,0	x2,y2: 0,0	Jus:V	H:10	C:11	F:3	z:0	f:Helvetica	b:	i:	s:	faktnr
F:11	A:2	X,Y: 10.5,28.8	x2,y2: 0,0	Jus:C	H:8	C:11	F:2	z:0	f:Helvetica	b:	i:	s:A	$eget_firmanavn; * $egen_addr1; * $eget_postnr; * $eget_bynavn;
F:11	A:2	X,Y: 10.5,29.1	x2,y2: 0,0	Jus:C	H:8	C:11	F:2	z:0	f:Helvetica	b:	i:	s:A	Tlf: $egen_tlf; * Cvr.nr: $eget_cvrnr * Bank: $egen_bank_navn; * Kontonummer: $egen_bank_reg; $egen_bank_konto;
F:12	A:1	X,Y: 15,3.2	x2,y2: 0,0	Jus:	H:0	C:12	F:1	z:0	f:	b:	i:	s:	LOGO
F:12	A:1	X,Y: 16.6,22.8	x2,y2: 18.4,22.8	Jus:	H:1	C:12	F:1	z:0	f:	b:	i:	s:	
F:12	A:1	X,Y: 2.3,10.7	x2,y2: 2.3,22.1	Jus:	H:1	C:12	F:1	z:0	f:	b:	i:	s:	
F:12	A:1	X,Y: 2.3,22.1	x2,y2: 18.4,22.1	Jus:	H:1	C:12	F:1	z:0	f:	b:	i:	s:	
F:12	A:1	X,Y: 2.3,10.7	x2,y2: 18.4,10.7	Jus:	H:1	C:12	F:1	z:0	f:	b:	i:	s:	
F:12	A:1	X,Y: 16.6,24.2	x2,y2: 18.4,24.2	Jus:	H:1	C:12	F:1	z:0	f:	b:	i:	s:	
F:12	A:1	X,Y: 16.6,10.7	x2,y2: 16.6,24.2	Jus:	H:1	C:12	F:1	z:0	f:	b:	i:	s:	
F:12	A:1	X,Y: 16.6,23.5	x2,y2: 18.4,23.5	Jus:	H:1	C:12	F:1	z:0	f:	b:	i:	s:	
F:12	A:1	X,Y: 2.6,4.2	x2,y2: 18.4,4.2	Jus:	H:1	C:12	F:1	z:0	f:	b:	i:	s:	
F:12	A:1	X,Y: 18.4,10.7	x2,y2: 18.4,24.2	Jus:	H:1	C:12	F:1	z:0	f:	b:	i:	s:	
F:12	A:2	X,Y: 2.6,26	x2,y2: 0,0	Jus:V	H:11	C:12	F:2	z:0	f:Helvetica	b:on	i:	s:A	$egen_addr1
F:12	A:2	X,Y: 18.3,27.6	x2,y2: 0,0	Jus:H	H:11	C:12	F:2	z:0	f:Helvetica	b:on	i:	s:A	$egen_bank_navn
F:12	A:2	X,Y: 18.3,28	x2,y2: 0,0	Jus:H	H:11	C:12	F:2	z:0	f:Helvetica	b:on	i:	s:A	$egen_bank_reg $egen_bank_konto
F:12	A:2	X,Y: 2.6,25.6	x2,y2: 0,0	Jus:V	H:11	C:12	F:2	z:0	f:Helvetica	b:on	i:	s:A	$eget_firmanavn
F:12	A:2	X,Y: 2.6,3.9	x2,y2: 0,0	Jus:V	H:12	C:12	F:2	z:0	f:Helvetica	b:on	i:on	s:A	$eget_firmanavn * $egen_addr1 * $eget_postnr $eget_bynavn * Danmark
F:12	A:2	X,Y: 18.3,24.1	x2,y2: 0,0	Jus:H	H:10	C:12	F:2	z:0	f:Helvetica	b:on	i:	s:S	$formular_ialt
F:12	A:2	X,Y: 18.3,23.4	x2,y2: 0,0	Jus:H	H:10	C:12	F:2	z:0	f:Helvetica	b:	i:	s:S	$formular_moms
F:12	A:2	X,Y: 16,6.7	x2,y2: 0,0	Jus:V	H:11	C:12	F:2	z:0	f:Helvetica	b:	i:	s:A	$formular_side
F:12	A:2	X,Y: 18.3,22.7	x2,y2: 0,0	Jus:H	H:10	C:12	F:2	z:0	f:Helvetica	b:	i:	s:S	$formular_sum
F:12	A:2	X,Y: 18.3,22.7	x2,y2: 0,0	Jus:H	H:10	C:12	F:2	z:0	f:Helvetica	b:	i:	s:!S	$formular_transportsum
F:12	A:2	X,Y: 2.6,5.9	x2,y2: 0,0	Jus:V	H:11	C:12	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_addr1
F:12	A:2	X,Y: 2.6,6.3	x2,y2: 0,0	Jus:V	H:11	C:12	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_addr2;
F:12	A:2	X,Y: 16,5.9	x2,y2: 0,0	Jus:V	H:11	C:12	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_ordrenr
F:12	A:2	X,Y: 2.6,5.5	x2,y2: 0,0	Jus:V	H:11	C:12	F:2	z:0	f:Helvetica	b:on	i:	s:A	$ordre_firmanavn
F:12	A:2	X,Y: 13.2,23.4	x2,y2: 0,0	Jus:V	H:10	C:12	F:2	z:0	f:Helvetica	b:	i:	s:S	$ordre_momssats;% moms
F:12	A:2	X,Y: 16,6.3	x2,y2: 0,0	Jus:V	H:11	C:12	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_ordredate;
F:12	A:2	X,Y: 6,8.7	x2,y2: 0,0	Jus:V	H:11	C:12	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_ordrenr
F:12	A:2	X,Y: 2.6,6.7	x2,y2: 0,0	Jus:V	H:11	C:12	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_postnr $ordre_bynavn
F:12	A:2	X,Y: 14.8,10.4	x2,y2: 0,0	Jus:C	H:11	C:12	F:2	z:0	f:Helvetica	b:	i:	s:A	Antal
F:12	A:2	X,Y: 5.5,10.4	x2,y2: 0,0	Jus:V	H:11	C:12	F:2	z:0	f:Helvetica	b:	i:	s:A	Beskrivelse
F:12	A:2	X,Y: 18.3,26.8	x2,y2: 0,0	Jus:H	H:11	C:12	F:2	z:0	f:Helvetica	b:on	i:	s:A	CVR nr: $eget_cvrnr
F:12	A:2	X,Y: 2.6,26.8	x2,y2: 0,0	Jus:V	H:11	C:12	F:2	z:0	f:Helvetica	b:on	i:	s:A	Danmark
F:12	A:2	X,Y: 12,6.3	x2,y2: 0,0	Jus:V	H:11	C:12	F:2	z:0	f:Helvetica	b:on	i:	s:A	Dato
F:12	A:2	X,Y: 2.6,8.7	x2,y2: 0,0	Jus:V	H:11	C:12	F:2	z:0	f:Helvetica	b:on	i:	s:A	Deres ordre nr
F:12	A:2	X,Y: 2.6,8.3	x2,y2: 0,0	Jus:V	H:11	C:12	F:2	z:0	f:Helvetica	b:on	i:	s:A	Deres ref:
F:12	A:2	X,Y: 2.6,26.4	x2,y2: 0,0	Jus:V	H:11	C:12	F:2	z:0	f:Helvetica	b:on	i:	s:A	DK-$eget_postnr $eget_bynavn
F:12	A:2	X,Y: 2.6,28	x2,y2: 0,0	Jus:V	H:11	C:12	F:2	z:0	f:Helvetica	b:on	i:	s:A	Fax: $egen_fax
F:12	A:2	X,Y: 13.2,24.1	x2,y2: 0,0	Jus:V	H:10	C:12	F:2	z:0	f:Helvetica	b:	i:	s:S	I alt
F:12	A:2	X,Y: 13.2,22.7	x2,y2: 0,0	Jus:V	H:10	C:12	F:2	z:0	f:Helvetica	b:	i:	s:S	Nettosum
F:12	A:2	X,Y: 12,5.9	x2,y2: 0,0	Jus:V	H:11	C:12	F:2	z:0	f:Helvetica	b:on	i:	s:A	Nummer
F:12	A:2	X,Y: 15.8,10.4	x2,y2: 0,0	Jus:V	H:11	C:12	F:2	z:0	f:Helvetica	b:	i:	s:A	Pris
F:12	A:2	X,Y: 12,6.7	x2,y2: 0,0	Jus:V	H:11	C:12	F:2	z:0	f:Helvetica	b:on	i:	s:A	Side
F:12	A:2	X,Y: 17.5,10.4	x2,y2: 0,0	Jus:V	H:11	C:12	F:2	z:0	f:Helvetica	b:	i:	s:A	Sum
F:12	A:2	X,Y: 12,5.3	x2,y2: 0,0	Jus:V	H:15	C:12	F:2	z:0	f:Helvetica	b:on	i:	s:A	Indkøbsforslag
F:12	A:2	X,Y: 2.6,27.6	x2,y2: 0,0	Jus:V	H:11	C:12	F:2	z:0	f:Helvetica	b:on	i:	s:A	Tlf:. $egen_tlf
F:12	A:2	X,Y: 13.2,22.7	x2,y2: 0,0	Jus:V	H:10	C:12	F:2	z:0	f:Helvetica	b:	i:	s:!S	Transport til side $formular_nextside
F:12	A:2	X,Y: 2.6,10.4	x2,y2: 0,0	Jus:V	H:11	C:12	F:2	z:0	f:Helvetica	b:	i:	s:A	Varenr
F:12	A:3	X,Y: 14.8,0	x2,y2: 0,0	Jus:H	H:10	C:12	F:3	z:0	f:Helvetica	b:	i:	s:	antal
F:12	A:3	X,Y: 5.6,0	x2,y2: 5.2,0	Jus:V	H:10	C:12	F:3	z:0	f:Helvetica	b:	i:	s:	beskrivelse
F:12	A:3	X,Y: 2.8,11.2	x2,y2: 0.4,0	Jus:	H:0	C:12	F:3	z:0	f:	b:	i:	s:	generelt
F:12	A:3	X,Y: 18.3,0	x2,y2: 0,0	Jus:H	H:10	C:12	F:3	z:0	f:Helvetica	b:	i:	s:	linjesum
F:12	A:3	X,Y: 16.5,0	x2,y2: 0,0	Jus:H	H:10	C:12	F:3	z:0	f:Helvetica	b:	i:	s:	pris
F:13	A:1	X,Y: 15,3.2	x2,y2: 0,0	Jus:	H:0	C:13	F:1	z:0	f:	b:	i:	s:	LOGO
F:13	A:1	X,Y: 16.6,23.5	x2,y2: 18.4,23.5	Jus:	H:1	C:13	F:1	z:0	f:	b:	i:	s:	
F:13	A:1	X,Y: 2.6,4.2	x2,y2: 18.4,4.2	Jus:	H:1	C:13	F:1	z:0	f:	b:	i:	s:	
F:13	A:1	X,Y: 16.6,22.8	x2,y2: 18.4,22.8	Jus:	H:1	C:13	F:1	z:0	f:	b:	i:	s:	
F:13	A:1	X,Y: 16.6,24.2	x2,y2: 18.4,24.2	Jus:	H:1	C:13	F:1	z:0	f:	b:	i:	s:	
F:13	A:1	X,Y: 2.3,22.1	x2,y2: 18.4,22.1	Jus:	H:1	C:13	F:1	z:0	f:	b:	i:	s:	
F:13	A:1	X,Y: 2.3,10.7	x2,y2: 18.4,10.7	Jus:	H:1	C:13	F:1	z:0	f:	b:	i:	s:	
F:13	A:1	X,Y: 16.6,10.7	x2,y2: 16.6,24.2	Jus:	H:1	C:13	F:1	z:0	f:	b:	i:	s:	
F:13	A:1	X,Y: 2.3,10.7	x2,y2: 2.3,22.1	Jus:	H:1	C:13	F:1	z:0	f:	b:	i:	s:	
F:13	A:1	X,Y: 18.4,10.7	x2,y2: 18.4,24.2	Jus:	H:1	C:13	F:1	z:0	f:	b:	i:	s:	
F:13	A:2	X,Y: 2.6,26	x2,y2: 0,0	Jus:V	H:11	C:13	F:2	z:0	f:Helvetica	b:on	i:	s:A	$egen_addr1
F:13	A:2	X,Y: 18.3,27.6	x2,y2: 0,0	Jus:H	H:11	C:13	F:2	z:0	f:Helvetica	b:on	i:	s:A	$egen_bank_navn
F:13	A:2	X,Y: 18.3,28	x2,y2: 0,0	Jus:H	H:11	C:13	F:2	z:0	f:Helvetica	b:on	i:	s:A	$egen_bank_reg $egen_bank_konto
F:13	A:2	X,Y: 2.6,25.6	x2,y2: 0,0	Jus:V	H:11	C:13	F:2	z:0	f:Helvetica	b:on	i:	s:A	$eget_firmanavn
F:13	A:2	X,Y: 2.6,3.9	x2,y2: 0,0	Jus:V	H:12	C:13	F:2	z:0	f:Helvetica	b:on	i:on	s:A	$eget_firmanavn * $egen_addr1 * $eget_postnr $eget_bynavn * Danmark
F:13	A:2	X,Y: 16,8.7	x2,y2: 0,0	Jus:V	H:11	C:13	F:2	z:0	f:Helvetica	b:	i:	s:A	$formular_forfaldsdato
F:13	A:2	X,Y: 18.3,24.1	x2,y2: 0,0	Jus:H	H:10	C:13	F:2	z:0	f:Helvetica	b:on	i:	s:S	$formular_ialt
F:13	A:2	X,Y: 18.3,23.4	x2,y2: 0,0	Jus:H	H:10	C:13	F:2	z:0	f:Helvetica	b:	i:	s:S	$formular_moms
F:13	A:2	X,Y: 16,6.7	x2,y2: 0,0	Jus:V	H:11	C:13	F:2	z:0	f:Helvetica	b:	i:	s:A	$formular_side
F:13	A:2	X,Y: 18.3,22.7	x2,y2: 0,0	Jus:H	H:10	C:13	F:2	z:0	f:Helvetica	b:	i:	s:S	$formular_sum
F:13	A:2	X,Y: 18.3,22.7	x2,y2: 0,0	Jus:H	H:10	C:13	F:2	z:0	f:Helvetica	b:	i:	s:!S	$formular_transportsum
F:13	A:2	X,Y: 2.6,5.9	x2,y2: 0,0	Jus:V	H:11	C:13	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_addr1
F:13	A:2	X,Y: 2.6,6.3	x2,y2: 0,0	Jus:V	H:11	C:13	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_addr2;
F:13	A:2	X,Y: 16,8.3	x2,y2: 0,0	Jus:V	H:11	C:13	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_betalingsbet $ordre_betalingsdage dage
F:13	A:2	X,Y: 16,6.3	x2,y2: 0,0	Jus:V	H:11	C:13	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_ordredate
F:13	A:2	X,Y: 16,5.9	x2,y2: 0,0	Jus:V	H:11	C:13	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_fakturanr
F:13	A:2	X,Y: 2.6,5.5	x2,y2: 0,0	Jus:V	H:11	C:13	F:2	z:0	f:Helvetica	b:on	i:	s:A	$ordre_firmanavn
F:13	A:2	X,Y: 6,8.3	x2,y2: 0,0	Jus:V	H:11	C:13	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_kundeordnr;
F:13	A:2	X,Y: 13.2,23.4	x2,y2: 0,0	Jus:V	H:10	C:13	F:2	z:0	f:Helvetica	b:	i:	s:S	$ordre_momssats;% moms
F:13	A:2	X,Y: 6,8.7	x2,y2: 0,0	Jus:V	H:11	C:13	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_ordrenr
F:13	A:2	X,Y: 2.6,6.7	x2,y2: 0,0	Jus:V	H:11	C:13	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_postnr $ordre_bynavn
F:13	A:2	X,Y: 14.8,10.4	x2,y2: 0,0	Jus:C	H:11	C:13	F:2	z:0	f:Helvetica	b:	i:	s:A	Antal
F:13	A:2	X,Y: 2.6,7.1	x2,y2: 0,0	Jus:V	H:11	C:13	F:2	z:0	f:Helvetica	b:	i:	s:A	Att: $ordre_kontakt;
F:13	A:2	X,Y: 5.5,10.4	x2,y2: 0,0	Jus:V	H:11	C:13	F:2	z:0	f:Helvetica	b:	i:	s:A	Beskrivelse
F:13	A:2	X,Y: 12,8.3	x2,y2: 0,0	Jus:V	H:11	C:13	F:2	z:0	f:Helvetica	b:on	i:	s:A	Betalingsbet
F:13	A:2	X,Y: 18.3,26.8	x2,y2: 0,0	Jus:H	H:11	C:13	F:2	z:0	f:Helvetica	b:on	i:	s:A	CVR nr: $eget_cvrnr
F:13	A:2	X,Y: 2.6,26.8	x2,y2: 0,0	Jus:V	H:11	C:13	F:2	z:0	f:Helvetica	b:on	i:	s:A	Danmark
F:13	A:2	X,Y: 12,6.3	x2,y2: 0,0	Jus:V	H:11	C:13	F:2	z:0	f:Helvetica	b:on	i:	s:A	Dato
F:13	A:2	X,Y: 2.6,8.3	x2,y2: 0,0	Jus:V	H:11	C:13	F:2	z:0	f:Helvetica	b:on	i:	s:A	Deres ref:
F:13	A:2	X,Y: 2.6,26.4	x2,y2: 0,0	Jus:V	H:11	C:13	F:2	z:0	f:Helvetica	b:on	i:	s:A	DK-$eget_postnr $eget_bynavn
F:13	A:2	X,Y: 12,5.3	x2,y2: 0,0	Jus:V	H:15	C:13	F:2	z:0	f:Helvetica	b:on	i:	s:A	Rekvisition
F:13	A:2	X,Y: 2.6,28	x2,y2: 0,0	Jus:V	H:11	C:13	F:2	z:0	f:Helvetica	b:on	i:	s:A	Fax: $egen_fax
F:13	A:2	X,Y: 13.2,24.1	x2,y2: 0,0	Jus:V	H:10	C:13	F:2	z:0	f:Helvetica	b:	i:	s:S	I alt
F:13	A:2	X,Y: 13.2,22.7	x2,y2: 0,0	Jus:V	H:10	C:13	F:2	z:0	f:Helvetica	b:	i:	s:S	Nettosum
F:13	A:2	X,Y: 12,5.9	x2,y2: 0,0	Jus:V	H:11	C:13	F:2	z:0	f:Helvetica	b:on	i:	s:A	Nummer
F:13	A:2	X,Y: 15.8,10.4	x2,y2: 0,0	Jus:V	H:11	C:13	F:2	z:0	f:Helvetica	b:	i:	s:A	Pris
F:13	A:2	X,Y: 12,6.7	x2,y2: 0,0	Jus:V	H:11	C:13	F:2	z:0	f:Helvetica	b:on	i:	s:A	Side
F:13	A:2	X,Y: 17.5,10.4	x2,y2: 0,0	Jus:V	H:11	C:13	F:2	z:0	f:Helvetica	b:	i:	s:A	Sum
F:13	A:2	X,Y: 2.6,27.6	x2,y2: 0,0	Jus:V	H:11	C:13	F:2	z:0	f:Helvetica	b:on	i:	s:A	Tlf:. $egen_tlf
F:13	A:2	X,Y: 13.2,22.7	x2,y2: 0,0	Jus:V	H:10	C:13	F:2	z:0	f:Helvetica	b:	i:	s:!S	Transport til side $formular_nextside
F:13	A:2	X,Y: 2.6,10.4	x2,y2: 0,0	Jus:V	H:11	C:13	F:2	z:0	f:Helvetica	b:	i:	s:A	Varenr
F:13	A:2	X,Y: 2.6,8.7	x2,y2: 0,0	Jus:V	H:11	C:13	F:2	z:0	f:Helvetica	b:on	i:	s:A	Vores ordre nr
F:13	A:3	X,Y: 14.8,0	x2,y2: 0,0	Jus:H	H:10	C:13	F:3	z:0	f:Helvetica	b:	i:	s:	antal
F:13	A:3	X,Y: 5.6,0	x2,y2: 4.8,0	Jus:V	H:10	C:13	F:3	z:0	f:Helvetica	b:	i:	s:	beskrivelse
F:13	A:3	X,Y: 2.8,11.2	x2,y2: 0.4,0	Jus:	H:0	C:13	F:3	z:0	f:	b:	i:	s:	generelt
F:13	A:3	X,Y: 18.3,0	x2,y2: 0,0	Jus:H	H:10	C:13	F:3	z:0	f:Helvetica	b:	i:	s:	linjesum
F:13	A:3	X,Y: 16.5,0	x2,y2: 0,0	Jus:H	H:10	C:13	F:3	z:0	f:Helvetica	b:	i:	s:	pris
F:13	A:3	X,Y: 2.6,0	x2,y2: 0,0	Jus:V	H:10	C:13	F:3	z:0	f:Helvetica	b:	i:	s:	varenr
F:14	A:1	X,Y: 15,3.2	x2,y2: 0,0	Jus:	H:0	C:14	F:1	z:0	f:	b:	i:	s:	LOGO
F:14	A:1	X,Y: 16.6,23.5	x2,y2: 18.4,23.5	Jus:	H:1	C:14	F:1	z:0	f:	b:	i:	s:	
F:14	A:1	X,Y: 2.6,4.2	x2,y2: 18.4,4.2	Jus:	H:1	C:14	F:1	z:0	f:	b:	i:	s:	
F:14	A:1	X,Y: 16.6,22.8	x2,y2: 18.4,22.8	Jus:	H:1	C:14	F:1	z:0	f:	b:	i:	s:	
F:14	A:1	X,Y: 16.6,24.2	x2,y2: 18.4,24.2	Jus:	H:1	C:14	F:1	z:0	f:	b:	i:	s:	
F:14	A:1	X,Y: 2.3,22.1	x2,y2: 18.4,22.1	Jus:	H:1	C:14	F:1	z:0	f:	b:	i:	s:	
F:14	A:1	X,Y: 2.3,10.7	x2,y2: 18.4,10.7	Jus:	H:1	C:14	F:1	z:0	f:	b:	i:	s:	
F:14	A:1	X,Y: 16.6,10.7	x2,y2: 16.6,24.2	Jus:	H:1	C:14	F:1	z:0	f:	b:	i:	s:	
F:14	A:1	X,Y: 2.3,10.7	x2,y2: 2.3,22.1	Jus:	H:1	C:14	F:1	z:0	f:	b:	i:	s:	
F:14	A:1	X,Y: 18.4,10.7	x2,y2: 18.4,24.2	Jus:	H:1	C:14	F:1	z:0	f:	b:	i:	s:	
F:14	A:2	X,Y: 2.6,26	x2,y2: 0,0	Jus:V	H:11	C:14	F:2	z:0	f:Helvetica	b:on	i:	s:A	$egen_addr1
F:14	A:2	X,Y: 18.3,27.6	x2,y2: 0,0	Jus:H	H:11	C:14	F:2	z:0	f:Helvetica	b:on	i:	s:A	$egen_bank_navn
F:14	A:2	X,Y: 18.3,28	x2,y2: 0,0	Jus:H	H:11	C:14	F:2	z:0	f:Helvetica	b:on	i:	s:A	$egen_bank_reg $egen_bank_konto
F:14	A:2	X,Y: 2.6,25.6	x2,y2: 0,0	Jus:V	H:11	C:14	F:2	z:0	f:Helvetica	b:on	i:	s:A	$eget_firmanavn
F:14	A:2	X,Y: 2.6,3.9	x2,y2: 0,0	Jus:V	H:12	C:14	F:2	z:0	f:Helvetica	b:on	i:on	s:A	$eget_firmanavn * $egen_addr1 * $eget_postnr $eget_bynavn * Danmark
F:14	A:2	X,Y: 18.3,24.1	x2,y2: 0,0	Jus:H	H:10	C:14	F:2	z:0	f:Helvetica	b:on	i:	s:S	$formular_ialt
F:14	A:2	X,Y: 18.3,23.4	x2,y2: 0,0	Jus:H	H:10	C:14	F:2	z:0	f:Helvetica	b:	i:	s:S	$formular_moms
F:14	A:2	X,Y: 16,6.7	x2,y2: 0,0	Jus:V	H:11	C:14	F:2	z:0	f:Helvetica	b:	i:	s:A	$formular_side
F:14	A:2	X,Y: 18.3,22.7	x2,y2: 0,0	Jus:H	H:10	C:14	F:2	z:0	f:Helvetica	b:	i:	s:S	$formular_sum
F:14	A:2	X,Y: 18.3,22.7	x2,y2: 0,0	Jus:H	H:10	C:14	F:2	z:0	f:Helvetica	b:	i:	s:!S	$formular_transportsum
F:14	A:2	X,Y: 2.6,5.9	x2,y2: 0,0	Jus:V	H:11	C:14	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_addr1
F:14	A:2	X,Y: 2.6,6.3	x2,y2: 0,0	Jus:V	H:11	C:14	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_addr2;
F:14	A:2	X,Y: 16,8.3	x2,y2: 0,0	Jus:V	H:11	C:14	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_betalingsbet $ordre_betalingsdage dage
F:14	A:2	X,Y: 16,6.3	x2,y2: 0,0	Jus:V	H:11	C:14	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_fakturadate
F:14	A:2	X,Y: 16,5.9	x2,y2: 0,0	Jus:V	H:11	C:14	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_fakturanr
F:14	A:2	X,Y: 2.6,5.5	x2,y2: 0,0	Jus:V	H:11	C:14	F:2	z:0	f:Helvetica	b:on	i:	s:A	$ordre_firmanavn
F:14	A:2	X,Y: 6,8.3	x2,y2: 0,0	Jus:V	H:11	C:14	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_kundeordnr;
F:14	A:2	X,Y: 13.2,23.4	x2,y2: 0,0	Jus:V	H:10	C:14	F:2	z:0	f:Helvetica	b:	i:	s:S	$ordre_momssats;% moms
F:14	A:2	X,Y: 6,8.7	x2,y2: 0,0	Jus:V	H:11	C:14	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_ordrenr
F:14	A:2	X,Y: 2.6,6.7	x2,y2: 0,0	Jus:V	H:11	C:14	F:2	z:0	f:Helvetica	b:	i:	s:A	$ordre_postnr $ordre_bynavn
F:14	A:2	X,Y: 14.8,10.4	x2,y2: 0,0	Jus:C	H:11	C:14	F:2	z:0	f:Helvetica	b:	i:	s:A	Antal
F:14	A:2	X,Y: 2.6,7.1	x2,y2: 0,0	Jus:V	H:11	C:14	F:2	z:0	f:Helvetica	b:	i:	s:A	Att: $ordre_kontakt;
F:14	A:2	X,Y: 5.5,10.4	x2,y2: 0,0	Jus:V	H:11	C:14	F:2	z:0	f:Helvetica	b:	i:	s:A	Beskrivelse
F:14	A:2	X,Y: 12,8.3	x2,y2: 0,0	Jus:V	H:11	C:14	F:2	z:0	f:Helvetica	b:on	i:	s:A	Betalingsbet
F:14	A:2	X,Y: 18.3,26.8	x2,y2: 0,0	Jus:H	H:11	C:14	F:2	z:0	f:Helvetica	b:on	i:	s:A	CVR nr: $eget_cvrnr
F:14	A:2	X,Y: 2.6,26.8	x2,y2: 0,0	Jus:V	H:11	C:14	F:2	z:0	f:Helvetica	b:on	i:	s:A	Danmark
F:14	A:2	X,Y: 12,6.3	x2,y2: 0,0	Jus:V	H:11	C:14	F:2	z:0	f:Helvetica	b:on	i:	s:A	Dato
F:14	A:2	X,Y: 2.6,8.3	x2,y2: 0,0	Jus:V	H:11	C:14	F:2	z:0	f:Helvetica	b:on	i:	s:A	Deres ref:
F:14	A:2	X,Y: 2.6,26.4	x2,y2: 0,0	Jus:V	H:11	C:14	F:2	z:0	f:Helvetica	b:on	i:	s:A	DK-$eget_postnr $eget_bynavn
F:14	A:2	X,Y: 12,5.3	x2,y2: 0,0	Jus:V	H:15	C:14	F:2	z:0	f:Helvetica	b:on	i:	s:A	Købsfaktura
F:14	A:2	X,Y: 2.6,28	x2,y2: 0,0	Jus:V	H:11	C:14	F:2	z:0	f:Helvetica	b:on	i:	s:A	Fax: $egen_fax
F:14	A:2	X,Y: 12,8.7	x2,y2: 0,0	Jus:V	H:11	C:14	F:2	z:0	f:Helvetica	b:on	i:	s:A	Forfaldsdato
F:14	A:2	X,Y: 13.2,24.1	x2,y2: 0,0	Jus:V	H:10	C:14	F:2	z:0	f:Helvetica	b:	i:	s:S	I alt
F:14	A:2	X,Y: 13.2,22.7	x2,y2: 0,0	Jus:V	H:10	C:14	F:2	z:0	f:Helvetica	b:	i:	s:S	Nettosum
F:14	A:2	X,Y: 12,5.9	x2,y2: 0,0	Jus:V	H:11	C:14	F:2	z:0	f:Helvetica	b:on	i:	s:A	Nummer
F:14	A:2	X,Y: 15.8,10.4	x2,y2: 0,0	Jus:V	H:11	C:14	F:2	z:0	f:Helvetica	b:	i:	s:A	Pris
F:14	A:2	X,Y: 12,6.7	x2,y2: 0,0	Jus:V	H:11	C:14	F:2	z:0	f:Helvetica	b:on	i:	s:A	Side
F:14	A:2	X,Y: 17.5,10.4	x2,y2: 0,0	Jus:V	H:11	C:14	F:2	z:0	f:Helvetica	b:	i:	s:A	Sum
F:14	A:2	X,Y: 2.6,27.6	x2,y2: 0,0	Jus:V	H:11	C:14	F:2	z:0	f:Helvetica	b:on	i:	s:A	Tlf:. $egen_tlf
F:14	A:2	X,Y: 13.2,22.7	x2,y2: 0,0	Jus:V	H:10	C:14	F:2	z:0	f:Helvetica	b:	i:	s:!S	Transport til side $formular_nextside
F:14	A:2	X,Y: 2.6,10.4	x2,y2: 0,0	Jus:V	H:11	C:14	F:2	z:0	f:Helvetica	b:	i:	s:A	Varenr
F:14	A:2	X,Y: 2.6,8.7	x2,y2: 0,0	Jus:V	H:11	C:14	F:2	z:0	f:Helvetica	b:on	i:	s:A	Vores ordre nr
F:14	A:3	X,Y: 14.8,0	x2,y2: 0,0	Jus:H	H:10	C:14	F:3	z:0	f:Helvetica	b:	i:	s:	antal
F:14	A:3	X,Y: 5.6,0	x2,y2: 4.8,0	Jus:V	H:10	C:14	F:3	z:0	f:Helvetica	b:	i:	s:	beskrivelse
F:14	A:3	X,Y: 2.8,11.2	x2,y2: 0.4,0	Jus:	H:0	C:14	F:3	z:0	f:	b:	i:	s:	generelt
F:14	A:3	X,Y: 18.3,0	x2,y2: 0,0	Jus:H	H:10	C:14	F:3	z:0	f:Helvetica	b:	i:	s:	linjesum
F:14	A:3	X,Y: 16.5,0	x2,y2: 0,0	Jus:H	H:10	C:14	F:3	z:0	f:Helvetica	b:	i:	s:	pris
F:14	A:3	X,Y: 2.6,0	x2,y2: 0,0	Jus:V	H:10	C:14	F:3	z:0	f:Helvetica	b:	i:	s:	varenr
 */
?>