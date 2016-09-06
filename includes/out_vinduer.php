<?php			 $DocFil= '../includes/out_vinduer.php';	 	$DocVer='5.0.0';		 $DocRev='2016-08-00';		 	$modulnr=0;
//						 ___   _   _    ___  _	       
//						/ __| /_\ | |  |   \| |   ___ 
//						\__ \/ _ \| |__| |) | |__/ -_)
//						|___/_/ \_|____|___/|_|  \___|
//						                               
// Design af vinduers layout. 
//
// Afhængig af: out_ruder.php
// 
// Styring af layout:
// 		Visning af vinduer bestående af relevante ruder.
// 		Ruder (= Emne-moduler), egnet for adaptive skærm-output.
// Skærmbredde: >=320px..640px: Brugbar - "Telefon"
//								640px..980px: Velegnet - "Tablet"
//								980px..1200px: Udnyttes - "Computer"
// HTML5 er benyttet i stor udstrækning.
// Filer skal gemmes i UTF-8 format uden BOM!
// 2016.08.00 ev - EV-soft

?>


<?php	 
include('../includes/version.php');
if (!function_exists('msg_Dialog')) {include('../includes/msg_lib.php');};

// ----------- Funktioner ang. vinduer:

function vindue_Logind(&$regnskab,&$brugernavn,&$brugerkode,&$PrgVers,&$LnkHelp,&$OrgaName,&$Logo) {
	FirstSpalte();
		Rude_Login($regnskab,$brugernavn,$brugerkode,$PrgVers,$LnkHelp,$OrgaName,$Logo);		
		greenLine();					
	EndSpalter();
}

function vindue_Install(&$db_type,&$db_encode,&$db_encode,&$db_bruger,&$db_pw,&$adm_navn,&$adm_pw,&$verify_adm_pw) {
	FirstSpalte();
		Rude_Install($db_type,$db_encode,$db_navn,$db_bruger,$db_password,$adm_navn,$adm_password,$verify_adm_password);
	NextSpalte();			
		Rude_DBsetup($db_type,$db_encode,$db_navn,$db_bruger,$db_password,$adm_navn,$adm_password,$verify_adm_password);	
	NextSpalte();
		Rude_Login($regnskab,$brugernavn,$brugerkode,$PrgVers,$LnkHelp,$OrgaName,$Logo='saldie.png');		
	EndSpalter();
	greenLine();
}

function vindue_InstallResult($db_navn,$adm_navn,$noskriv) {
	FirstSpalte();
		Rude_InstallFail($noskriv);
	NextSpalte();
		Rude_InstallSucces($db_navn='xxx',$adm_navn='xxx');	
	EndSpalter();
	greenLine();
}

function vindue_InstallFail($noskriv) {
	FirstSpalte();
		Rude_InstallFail($noskriv);
	EndSpalter();
	greenLine();
}

function vindue_InstallSucces($db_navn, $adm_navn) {
	FirstSpalte();
		Rude_InstallSucces($db_navn,$adm_navn);
	EndSpalter();
	greenLine();
}

function vindue_Formaal() {
	FirstSpalte();
		Rude_Browsr();
	NextSpalte();
		Rude_Formaal();
	EndSpalter();
	greenLine();
}

function vindue_Connect() {global $progvers, $saldihost;
	FirstSpalte();
		Rude_Install($db_type='MySQL',$db_encode,$db_navn='saldi-db',$db_bruger='root',$db_password,$adm_navn='SaldiAdm',$adm_password,$verify_adm_password);
	NextSpalte();
		Rude_DBsetup($db_type='MySQL',$db_encode,$db_navn='saldi-db',$db_bruger='root',$db_password,$adm_navn='SaldiAdm',$adm_password,$verify_adm_password);
	NextSpalte();
		Rude_Login($regnskab='CSS-demo',$brugernavn='admin',$brugerkode,$PrgVers=' '.$progvers,$LnkHelp,$OrgaName=$saldihost,$Logo='SALDIe50x150.png');
	EndSpalter();
	greenLine();
}


function vindue_GitterMenu() { global $programSprog;
	Rude_HovedMenu($regnskab='CSS-demo', $vis_finans=true, $vis_debitor=true, $vis_kreditor=true, $vis_prodkt=false, $vis_lager=true, $programSprog);	
	greenLine();
}

function vindue_Ordreblanket($wide=false) {
	Head_Navigation(tolk('@Kunde ordre'), $status=tolk('@Ikke afsluttet. Kan stadig rettes.'), $goPrev=true, $goHome=true, $goUp=true, $goFind=true, $goNew=true, $goNext=true);	
	if ($wide==true) Rude_YdelserWide($fakt=false);
	FirstSpalte();
		Rude_Kunden($kontonr, $kategori, $cvrnr, $eannr, $bankreg, $bankkto, $instit, $ansv, $formsprog, $homeweb);						
		Rude_Betingelser($debigrup, $betaling, $frist, $print2, $kunderef);			
		Rude_Kontakter();		
	NextSpalte();
		Rude_Fakturering ($navn='Anders And', $addr='Andedammen 34', $sted='Ved Lunden', $ponr='1234', $by='Eventyrland', $land='Eventyrland', 
											$noter='Levering på anden adresse!', $telf='045 12345678', $att='Rap', $email='anders@and.dk', $usemail='', $faktdato);		
		Rude_Ordreinfo($valuta, $vorref, $afdel, $ordrdato, $genfdato, $godkendt, $optlist);			
		Rude_Mailfaktura($emne, $text, $vedhft);		
		if ($wide==true) NextSpalte();	
		Rude_Levering($navn= 'Andersine', $addr= 'Redekasse 12', $sted= 'Ved Lunden', $ponr= '1234', $by= 'Fuglebjerg', $land= 'Eventyrland', 
									$telf= '045 87654321', $kont='Kaptajnen', $email= 'andersine@and.dk', $forsend= 'Fragt: DSV', $noter= 'Afleveres ved bredden!', $afsendt= '', $levdato);		
		Rude_Ekstrafelter($felt1, $felt2, $felt3, $felt4, $felt5);		
		if ($wide==false) {	
			NextSpalte();
			Rude_Ydelser($fakt=false);
		}
	EndSpalter();
}

function vindue_DivDemo() {
	Rude_FootMenu();		greenLine();
	Rude_Tabel();				greenLine();
	Rude_Debitorer();		greenLine();
	Rude_Kreditorer();	greenLine();
	Rude_DbOrdrer();		greenLine();
	Rude_KredOrdrer();	greenLine();
}

function vindue_RappDemo() {
	FirstSpalte();
		Rude_DebRapp();
	NextSpalte();
		Rude_KredRapp();
	EndSpalter();
	greenLine();
}

function vindue_KassDemo() {
	panelStart();
		Rude_TabelInp();
	greenLine();
	panelSlut();
}

function vindue_OrdreDemo() {
	panelStart();
		Rude_OrdrePostering();
	panelSlut();
	greenLine();
}

function vindue_Intro() {
	panelStart();
		Rude_Intro();
	panelSlut();
	greenLine();
}

function vindue_Test() {
	panelStart();
		Rude_Test();
	panelSlut();
	greenLine();
}


?>
