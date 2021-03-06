<?php   $DocFil= '../_base/out_vinduer.php';    $DocVer='5.0.0';    $DocRev='2018-06-00';   $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Demonstrerer benyttelsen af out_-systemet, hvorledes vinduer opbygges af ruder.';
 * Denne fil er oprettet af EV-soft i 2016.
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2018 Saldi.dk ApS      *** Se filen: ../LICENS_Copyright.txt
 *
 * Grundlæggende initiering.
 *
  Oprettet: 2016-08-00 evs - EV-soft
  Ændrings-Log:
      
 *
 * ## Formål:  Design af vinduers layout. Her ser du hvorledes Ruder, sammensættes til Vinduer.
 *          Teknikken benyttes i page_***.php filer, som viser en html side ad gangen.
 *  Det er planen, at alle disse vindue_rutiner, skal flyttes til page_-filer,
 *  så denne php-fil kan udgå!
 *
 * ## Afhængig af: out_ruder.php
 * 
 * ## Styring af layout:
 *    Visning af vinduer bestående af relevante ruder.
 *    Ruder (= Emne-moduler), egnet for adaptive skærm-output.
 * Skærmbredde: >=320px..640px:   Brugbar - "Telefon"
 *                640px..980px:   Velegnet - "Tablet"
 *                980px..1200px:  Udnyttes - "Computer"
 * ## Filer skal gemmes i UTF-8 format uden BOM!
 *
 */
if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'out_-system');
?>


<?php  
include '../_base/version.php';
if (!function_exists('msg_Dialog')) {include '../_base/msg_lib.php';};

// ----------- Funktioner ang. vinduer:

function vindue_Logind(&$regnskab,&$brugernavn,&$brugerkode,&$PrgVers,&$LnkHelp,&$OrgaName,&$Logo) {
  SpalteTop(320); Rude_Login($regnskab,$brugernavn,$brugerkode,$PrgVers,$LnkHelp,$OrgaName,$Logo);    
  skilleLin();          
  SpalteBund();
}

function vindue_Install(&$db_type,&$db_encode,&$db_bruger,&$db_pw,&$adm_navn,&$adm_pw,&$verify_adm_pw) {
  SpalteTop(320); //Rude_Install($db_type,$db_encode,$db_navn,$db_bruger,$db_password,$adm_navn,$adm_password,$verify_adm_password);
  NextSpalte();  // Rude_DBsetup($db_type,$db_encode,$db_navn,$db_bruger,$db_password,$adm_navn,$adm_password,$verify_adm_password);  
  NextSpalte();   Rude_Login($regnskab,$brugernavn,$brugerkode,$PrgVers,$LnkHelp,$OrgaName,$Logo='saldie.png');   
  SpalteBund();   skilleLin();
}

function vindue_InstallResult($db_navn,$adm_navn,$noskriv) {
  SpalteTop(320); Rude_InstallFail($noskriv);
  NextSpalte();   Rude_InstallSucces($db_navn='xxx',$adm_navn='xxx'); 
  SpalteBund();   skilleLin();
}

function vindue_InstallFail($noskriv) {
  SpalteTop(320); Rude_InstallFail($noskriv);
  SpalteBund();   skilleLin();
}

function vindue_InstallSucces($db_navn, $adm_navn) {
  SpalteTop(320); Rude_InstallSucces($db_navn,$adm_navn);
  SpalteBund();   skilleLin();
}

function vindue_Formaal() {
  SpalteTop(320); Rude_Browsr();
  NextSpalte();   Rude_Formaal();
  SpalteBund();   skilleLin();
}

function vindue_Connect() {global $Øprogvers, $Øsaldihost;
  SpalteTop(480);   Rude_Install($db_type='MySQL',$db_encode,$db_navn='saldi-db',$db_bruger='saldisys',$db_password,$adm_navn='SaldiAdm',$adm_password,$verify_adm_password);
  NextSpalte(320);  Rude_DBsetup($db_type='MySQL',$db_encode,$db_navn='saldi-db',$db_bruger='saldisys',$db_password,$adm_navn='SaldiAdm',$adm_password,$verify_adm_password,$db_host='Danosoft');
  NextSpalte(320);  Rude_Login($regnskab='CSS-demo',$brugernavn='admin',$brugerkode,$PrgVers=' '.$progvers,$LnkHelp,$OrgaName=$saldihost,$Logo='SALDIe50x150.png');
  SpalteBund();     skilleLin();
}

function vindue_GitterMenu() {
  Rude_HovedMenu($regnskab='CSS-demo', $vis_finans=true, $vis_debitor=true, $vis_kreditor=true, $vis_prodkt=false, $vis_lager=true); 
  skilleLin();
}

function vindue_setup () {
  SpalteTop(320); Rude_AdminMenu();
  NextSpalte();   Rude_DiverseMenu();
}


function Head_Navigation ($sideObjekt, $status, $goPrev, $goHome=true, $goUp, $goFind, $goNew, $goNext) { # Genvejsknapper på siders top.
  global $ØProgRoot;
  $sideObjekt= tolk($sideObjekt).'. ';
  echo '<data-data-PanlHead>';
  htm_Rude_Top($name='naviform',$capt='',$parms='',$icon='','panelWmax',__FUNCTION__);
  echo '<div style="text-align: center" ><img src= '.$ØProgRoot.'_assets/images/saldi-e50x170.png " alt="Saldi Logo" style="width:170px;height:50px;"></div>';
//  echo '<p align="center"><b>'.tolk('@Navigation:').'<b></p>';
  echo '<p align="center">';  #<ic class="fa '.$icon.'" style="font-size:22px;color:green"></ic>
  if ($goPrev)  iconKnap($faicon='fas fa-caret-square-left',    $title= tolk('@Vis forrige')  .' '.$sideObjekt    ,$link='../_base/page_Blindgyden.php',$akey='f');
  if ($goHome)  iconKnap($faicon='fas fa-home',                 $title= tolk('@Luk vinduet og gå til hoved-menu.'),$link='../_base/page_Hovedmenu.php'.$goBack,$akey='h');
  if ($goUp  )  iconKnap($faicon='fas fa-caret-square-up',      $title= tolk('@Luk vinduet og gå et niveau op.')  ,$link= $goBack,                      $akey='l');
  if ($goFind)  iconKnap($faicon='fas fa-search',               $title= tolk('@Søg en anden') .' '.$sideObjekt    ,$link='../_base/page_Blindgyden.php',$akey='s');
  if ($goNew )  iconKnap($faicon='fas fa-plus-square',          $title= tolk('@Opret ny')     .' '.$sideObjekt    ,$link='../_base/page_Blindgyden.php',$akey='o');
  if ($goNext)  iconKnap($faicon='fas fa-caret-square-right',   $title= tolk('@Vis næste')    .' '.$sideObjekt    ,$link='../_base/page_Blindgyden.php',$akey='v');
  if ($doUndo)  iconKnap($faicon='fas fa-undo',                 $title= tolk('@Fortryd')      .' '.$sideObjekt    ,$link='../_base/page_Blindgyden.php',$akey='u');
  echo '</p>';
//  if ($status) {
//    $status= '<x1 style="font-weight:300; font-size:smaller"> - Status:<data-colrlabl> '.$status.'</data-colrlabl></x1>';
//    echo '<p align="center">'.ucfirst($sideObjekt).$status.'</p> ';
//  }
  htm_RudeBund($pmpt='@Gem',$subm=false,$title='@Gem',$akey='');
  echo '</data-data-PanlHead>';
}

function vindue_Ordreblanket($wide=false) {
  Head_Navigation(tolk('@Kunde ordre'), $status=tolk('@Ikke afsluttet. Kan stadig rettes.'), $goPrev=true, $goHome=true, $goUp=true, $goFind=true, $goNew=true, $goNext=true);  
  if ($wide==true) Rude_YdelserWide($Ordnr='1025',$fakt=false);
  SpalteTop(320);
    Rude_Kunden($kontonr, $kategori, $cvrnr, $eannr, $bankreg, $bankkto, $instit, $ansv, $formsprog, $homeweb);           
    Rude_Betingelser($debigrup, $betaling, $frist, $print2, $kunderef);     
    Rude_Kontakter();   
  NextSpalte();
    Rude_Fakturering ($navn='Anders And', $addr='Andedammen 34', $sted='Ved Lunden', $ponr='1234', $by='Eventyrland', $land='Eventyrland', 
                      $noter='Levering på anden adresse!', $telf='045 12345678', $att='Rap', $email='anders@and.dk', $usemail='', $faktdato);   
    Rude_Ordreinfo($valuta, $vorref, $afdel, $ordrdato, $genfdato, $godkendt, $optlist);      
    Rude_Mailfaktura($emne, $text, $vedhft);    
    Rude_Ekstrafelter($felt1, $felt2, $felt3, $felt4, $felt5);    
    if ($wide==true) NextSpalte();  
    Rude_Levering($somfakt='', $navn= 'Andersine', $addr= 'Redekasse 12', $sted= 'Ved Lunden', $ponr= '1234', $by= 'Fuglebjerg', $land= 'Eventyrland', 
                  $telf= '045 87654321', $kont='Kaptajnen', $email= 'andersine@and.dk', $forsend= 'Fragt: DSV', $noter= 'Afleveres ved bredden!', $afsendt= '', $levdato);    
    Rude_Ydelser($Ordnr='1025',$fakt=false);
    if ($wide==false) { 
      NextSpalte();
      Rude_Ydelser($fakt=false);
    }
  SpalteBund();
}

# PROGRAM-MODUL; "Navigation"
// 2017-03-09 - Er kopieret til page_GitterMenu:
# Kaldes fra:  [_base/page_Gittermenu.php] [_debitor/page_DebitorOrdre.php] [_debitor/page_Opretordre.php] [_debitor/page_Ordreliste.php] [_finans/page_Budget.php] [_finans/page_Kontrol.php] [_finans/page_Provisionsrapport.php] [_finans/page_Rapport-fin.php] [_finans/page_Regnskab.php] [_kreditor/page_Kreditor.php] [_kreditor/page_Ordreliste.php] [_lager/page_Varemodtagelse.php] [_lager/page_Varer.php] 
function Rude_FootMenu($doPrint=true, $doErase=true, $doLookUp=true, $doAccept=true, $doExport=true, $doImport=true, $OpslLabl='') { ## out_ruderSekd.php
  echo '<div class="clearWrap"/>';  echo '<PanlFoot>';
    Foot_Links($maxi=true, '<a style="color:#900000" href="'.$link='http://www.ev-soft.dk/saldi-wiki/doku.php?id=saldi:manualen '.'" target="_blank">'.
    '<u title="'.tolk('@Manual, tips og anden hjælp finder du på').$ØProgTitl.'-DokuWiki">SALDI-DokuWiki</u></a>',
    $doPrint, $doErase, $doLookUp, $doAccept, $doExport, $doImport, $OpslLabl);
  echo '</PanlFoot>';
}

function vindue_DivDemo() {
  $TablData= array( # DemoData:
            ['1025','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1026','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1027','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1028','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum']
            );
  Rude_FootMenu();              skilleLin();
  Rude_Tabel();                 skilleLin();
  Rude_Debitorer($TablData);    skilleLin();
  Rude_Kreditorer();            skilleLin();
  Rude_DebtOrdrer($TablData);   skilleLin();
  Rude_KredOrdrer();            skilleLin();
}

function vindue_RappDemo() {
  SpalteTop(320); Rude_DebRapp();
  NextSpalte();   Rude_KredRapp();
  SpalteBund();   skilleLin();
}

function vindue_KassDemo() {
  panelStart();
    Rude_KasseRedigering();
  panelSlut();
  skilleLin();
}

function vindue_OrdreDemo() {
  panelStart();
    $data= array(1,2,3,4,5,6,7,8,9,10);  # Antal rows ved DEMO
    Rude_OrdrePostering($data);
  panelSlut();
  skilleLin();
}

function vindue_Intro() {
  panelStart();
    Rude_Intro();
  panelSlut();
  skilleLin();
}

function vindue_Test() {
  panelStart();
    Rude_Test();
  panelSlut();
  skilleLin();
}


?>