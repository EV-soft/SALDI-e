<?php		$DocFil= '../base/page_LayoutModuler.php';		$DocVer='5.0.0';		$DocRev='2016-08-00'; 	$modulnr=2;
//	DEMO af ny version af SALDI					                               
//						 ___   _   _    ___  _	       
//						/ __| /_\ | |  |   \| |   ___ 
//						\__ \/ _ \| |__| |) | |__/ -_)
//						|___/_/ \_|____|___/|_|  \___)
//						                               
//	Denne fil demonstrerer layout af output til skærm.
//	Benyttes også til test og finafpudsning.
//
// Styring af layout:
// 		Visning af vinduer bestående af relevante ruder.
// 		Ruder (= Emne-moduler), egnet for adaptive skærm-output.
// Skærmbredde: >=320px..640px: Brugbar - "Telefon"
//								640px..980px: Velegnet - "Tablet"
//								980px..1200px: Udnyttes - "Computer"
// HTML5 og CSS er benyttet i stor udstrækning.
// Filer skal gemmes i UTF-8 format uden BOM!
// 2016.08.00 ev - EV-soft

//		msg_Dialog('info',
//		'Luk_for_at_fortsætte','$(this).dialog("close")','','','','','Velkommen til SALDI-DEMO',
//		'Her kan du se en demonstration af et forslag til en modernisering af SALDI.<br><br>Systemet er baseret på CSS, og er med responsive design, som er velegnet til mobile enheder. '.
//		'<br><br>Der er fuld understøttelse til at skifte sprog for program-fladen og i denne demo, kan der skiftes mellem dansk-engelsk-tysk-fransk-spansk-tyrkisk.'.
//		'<br><br>Denne dialogbox er universal for: info-error-tip-warn-success beskeder. Du kan flytte den og ændre størrelse ved at trække i kanterne.');

	@session_start();	$s_id=session_id();

	$laast=NULL;
	global $PanelBgrd;
	$pageTitl='DEMO af SALDI-e';
	include("../_base/htm_pageHead.php");	# Sidens indledende html-kode
		
		vindue_Intro();
	#	vindue_Logind($regnskab='CSS-demo',$brugernavn='admin',$brugerkode,$PrgVers=' 5.0.0α',$LnkHelp,$OrgaName='Danosoft ApS',$Logo='saldie.png');
	#	vindue_Install($db_type,$db_encode,$db_encode,$db_bruger,$db_pw,$adm_navn,$adm_pw,$verify_adm_pw);
		vindue_Connect();
		vindue_InstallResult($db_navn,$adm_navn,$noskriv='includes');
		vindue_Formaal();
		vindue_GitterMenu();
		vindue_Ordreblanket(true);
		vindue_DivDemo();
		vindue_RappDemo();
		vindue_KassDemo();
		vindue_OrdreDemo();
		vindue_Test();
		
//	Til sidst indlæses java-scripter:		
	include("../_base/htm_pageFoot.php");	# Sidens afsluttende html-kode
?>