<?php   $DocFil= '../_base/out_panls.php';   $DocVer='5.0.0';    $DocRev='2018-09-30';   $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Design af panelers layout. Redigerings-fil';
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2018 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 * Design af panelers layout.
 * Panel-moduler egnet for adaptivt skærm-output.
 *
 * Afhængig af: out_base.php
 * Denne fil opdeles i flere mindre, pga. indlæsnings hastighed!
 * Opdeling i 2: [1. Regnskabs paneler]  [2. Indstillings paneler]
 * out_PanlsPrim.php [FINANS & KREDITOR & DEBITOR & LAGER & PRODUKTION] 
 * out_PanlsSekd.php [SYSTEM & Alle andre]
 * Alternativt flyttes de "langsomme" ud i de page_-filer, som de angår.
 *  
 * Filer er redigeret med tabulator sat til 2 tegn, og linielængde max. 200 tegn. De ses bedst med det.
 * Filer skal gemmes i UTF-8 format uden BOM!
 *
  Oprettet: 2016-08-00 evs - EV-soft    #: Dette bibliotek er udviklet 2016-1018 af EV-soft.
  Ændrings-Log:
  2018-05-12 EVS - Mange <div> ændret til <span> og CSS: span { display: block; } - pga. browser skjuler "automatisk" med display:none på div af ukendt årsag! 
  2018-09-21 EVS - *Ruder* omdøbt til *Panls*, og out_ruder.php erstattet af out_Panls.php
      
 * 
 */
 
/* 
  Denne "redigerings-fil" opsplittes i 3 del-filer:
  
  "out_PanlsComm.php"; break;   #0  Paneler ang. Forskellige moduler, som ikke entydigt kan knyttes til de efterfølgende:
        Den inkluderes altid.
  
  "out_PanlsPrim.php"; break;   #0  Paneler ang. FINANS, DEBITOR, KREDITOR, LAGER, PRODUKTION
        Den inkluderes kun når den er nødvendig i de nævnte moduler

  "out_PanlsSekd.php"; break;   #0  Paneler ang. SYSTEM og alle andre
        Den inkluderes kun når den er nødvendig i de nævnte moduler
  
  Derudover kan hastigheds-kritiske rutiner, flyttes fra out_Panls.. erklæringer, til page_...
  og undlade indlæsning af de store out_Panls...filer ved at angive ["ØProgModu"]= ['none']; i page_...
  
  HUSK AT DISSE FILER SKAL OPDATERES, PÅ GRUNDLAG AF DENNE REDIGERINGSFILS INDHOLD !!!
  
  Redigeringsfilen kan testes ved indstilling i htm_pagePrepare:
    if (false) // false: udviklingstilstand (Opsplitningsfiler benyttes ikke!)
      switch ($GLOBALS["ØProgModu"]) { ....
  
 */ 
 

################################################
################################################
################################################
################################################


#+  ? >SPLITSTART:<?php   $DocFil= '../_base/out_PanlsComm.php';   $DocVer='5.0.0';    $DocRev='2018-09-30';   $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Design af panelers layout. Del-1';
 * Del-1 af redigeringsfilen: '../_base/out_Panls.php'
   HUSK AT DENNE FIL SKAL OPDATERES, PÅ GRUNDLAG AF DEN FÆLLES REDIGERINGSFILS (out_Panls.php) INDHOLD !!!
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2018 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 * Design af panelers layout.
 * Panel-moduler egnet for adaptivt skærm-output.
 *
 * Afhængig af: out_base.php
 *  
 * Filer er redigeret med tabulator sat til 2 tegn, og linielængde max. 200 tegn. De ses bedst med det.
 * Filer skal gemmes i UTF-8 format uden BOM!
 *
  Oprettet: 2018-06-00 evs - EV-soft    #: Dette bibliotek er udviklet 2016-1018 af EV-soft.
  Ændrings-Log:

  
 * 
 */
 
global $ØProgRoot;
//if ($GLOBALS['Ødebug']) echo ' out_Panls ';
DocAlder($DocRev,$DocFil);

if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'out_Panls');
//echo "\n<!-- $DocVer  $DocRev  $modulnr  $DocFil -->\n";

// ***** Rutiner for MENU og visning/redigering af DB-data: **************************************************
include $ØProgRoot.$_base.'version.php';
if (!function_exists('msg_Dialog')) {include $_base.'msg_lib.php';};
  
######### :COMMON: ######### Start funktioner angående visninger i flere menu-grupper

######### :COMMON: 
# PROGRAM-MODUL; "Navigation" (udgået Gittermenu!)
// 2017-03-09 - Er kopieret til page_GitterMenu:
// Menu_Topdropdown benyttes i stedet i fremtiden!
# Kaldes fra:  [_base/page_Gittermenu.php] 
function Panl_HovedMenu(&$regnskab, &$vis_finans, &$vis_debitor, &$vis_kreditor, &$vis_prodkt, &$vis_lager) { ## out_PanlsComm.php
global $ØProgRoot, $Øcopydate, $Øcopyright, $ØProgTitl, $Øprogvers, $ØprogSprog, $Ødesigner;
//  $ØprogSprog= $_SESSION['ØprogSprog'];
  $goBack= '';  # '?returside=../_base/menu.php';
  //echo '<data-PanlHead>';        
  htm_Panl_Top($name='menuform',$capt='',$parms='page_Blindgyden.php',$icon='',$klasse='panelWmax',__FUNCTION__,'','');
  echo '<div style="text-align: center"><img src= "'.$ØProgRoot.'_assets/images/saldi-e50x170.png" alt="Saldi Logo" height="50" width="170" ></div>';
  echo '<div class="panelTitl" max-width:400>'.ucfirst(tolk('@Regnskab:')).' '.Tolk($regnskab).'</div>';
  $FaLogo= "../_assets/images/saldi.png";
# if (file_exists($FaLogo)) echo '<img style="border:0px solid;width:50px;heigth:50px" alt="" src="'.$FaLogo.'">';
  
  switch ($ØprogSprog) {         
    case 'da' : $knapW= 120; break; 
    case 'en' : $knapW= 140; break; 
    case 'tr' : $knapW= 160; break; 
    case 'de' : $knapW= 165; break; 
    default   : $knapW= 180;
  }
  if ($debug==true) $ekstrW=100; else $ekstrW=12;
  $kolonner= $vis_finans+$vis_debitor+$vis_kreditor+$vis_prodkt+$vis_lager+1;  $panelW= ($kolonner*($knapW+1))+$ekstrW;
  echo '<p align="center">';
    echo '<div class="panelW960" style= "box-shadow: 1px 1px 2px 2px #AAAAAA; width:'.$panelW.'px; margin-left:auto; margin-right:auto;">';
      if ($vis_finans)  menuTitl($h='32',$w=$knapW, $label='@FINANS');
      if ($vis_debitor) menuTitl($h='32',$w=$knapW, $label='@DEBITOR');
      if ($vis_kreditor)menuTitl($h='32',$w=$knapW, $label='@KREDITOR');
      if ($vis_prodkt)  menuTitl($h='32',$w=$knapW, $label='@PRODUKTION');
      if ($vis_lager)   menuTitl($h='32',$w=$knapW, $label='@LAGER');
     /*  Vis altid: */  menuTitl($h='32',$w=$knapW, $label='@SYSTEM'); 
      htm_nl();
      if ($vis_finans)  menuKnap($h='32',$w=$knapW, $label='@Kasse kladder',    $link='../_finans/page_Kladdeliste.php',     $title='@Gå til Kassekladder'       );  // &#xa; svt. LF
      if ($vis_debitor) menuKnap($h='32',$w=$knapW, $label='@Salgs Ordrer',     $link='../_debitor/page_Ordreliste.php',     $title='@Gå til Debitor Ordrer &#xa;(Salgs-bestillinger)');
      if ($vis_kreditor)menuKnap($h='32',$w=$knapW, $label='@Købs Ordrer',      $link='../_kreditor/page_Ordreliste.php',    $title='@Gå til Kreditor Ordrer &#xa;(Købs-bestillinger)');
      if ($vis_prodkt)  menuKnap($h='32',$w=$knapW, $label='@Produktion',       $link='../_produktion/page_Ordreliste.php',  $title='@Gå til Produktion'         );
      if ($vis_lager)   menuKnap($h='32',$w=$knapW, $label='@Vare lister',      $link='../_lager/page_Varer.php',            $title='@Gå til Vareliste'          );
     /*  Vis altid: */  menuKnap($h='32',$w=$knapW, $label='@Konto plan',       $link='../_system/page_Kontoplan.php',       $title='@Gå til Kontoplan'          );
      htm_nl(); 
      if ($vis_finans)  menuKnap($h='32',$w=$knapW, $label='@Regnskab',         $link='../_finans/page_Regnskab.php',        $title='@Gå til Regnskab og budget' );
      if ($vis_debitor) menuKnap($h='32',$w=$knapW, $label='@Konti',            $link='../_debitor/page_Debitor.php',        $title='@Gå til Debitor Konti &#xa;(Kunder)');
      if ($vis_kreditor)menuKnap($h='32',$w=$knapW, $label='@Konti',            $link='../_kreditor/page_Kreditor.php',      $title='@Gå til Kreditor Konti &#xa;(Leverandører)');
      if ($vis_prodkt)  menuKnap($h='32',$w=$knapW, $label='@Produktion',       $link='../_produktion/page_Ordreliste.php',  $title='@Gå til Produktion'         );
      if ($vis_lager)   menuKnap($h='32',$w=$knapW, $label='@Vare modtagelse',  $link='../_lager/page_Varemodtagelse.php',   $title='@Gå til Vare modtagelse'    );
     /*  Vis altid: */  menuKnap($h='32',$w=$knapW, $label='@Indstillinger',    $link='../_system/page_Valuta.php',          $title='@Gå til menuen Indstillinger af: Regnskab og Program');
      htm_nl();   
      if ($vis_finans)  menuKnap($h='32',$w=$knapW, $label='@Rapporter',        $link='../_finans/page_Rapport-fin.php',     $title='@Gå til Finans Rapporter'   );
      if ($vis_debitor) menuKnap($h='32',$w=$knapW, $label='@Rapporter',        $link='../_debitor/page_Rapport-deb.php',    $title='@Gå til Debitor Rapporter'  );
      if ($vis_kreditor)menuKnap($h='32',$w=$knapW, $label='@Rapporter',        $link='../_kreditor/page_Rapport-kre.php',  $title='@Gå til Kreditor Rapporter' );
      if ($vis_prodkt)  menuKnap($h='32',$w=$knapW, $label='',                  $link='../_base/page_Blindgyden.php',        $title='@Gå til ?'                  );
      if ($vis_lager)   menuKnap($h='32',$w=$knapW, $label='@Rapporter',        $link='../_lager/page_Beholdningsliste.php', $title='@Gå til Vare Rapporter'     );
                        menuKnap($h='32',$w=$knapW, $label='@Sikkerheds kopi',  $link='../_system/page_Backup.php',          $title='@Gem/Hent sikkerhedskopi'   );
     echo '</div>';
    htm_FrstFelt('20%');  
    htm_NextFelt('15%');  htm_CentrOn($more='font-size:10px;');  echo $ØProgTitl.' - Version '.$Øprogvers;  htm_CentOff();       
    htm_NextFelt('30%');  htm_CentrOn($more='font-size:10px;');  echo '<i>Copyright '.  $Øcopydate.' '.$Øcopyright.'</i>';  htm_CentOff();
    htm_NextFelt('15%');  htm_CentrOn($more='font-size:10px;');  echo tolk('@Design: ').$Ødesigner;   htm_CentOff();
    
    htm_NextFelt('20%');
    htm_LastFelt();
  echo '</p>';
  htm_PanlBund($pmpt=Tolk('@Gem'),$subm=false);
//  Panl_FootMenu($doPrint=false, $doErase=false, $doLookUp=false, $doAccept=false, $doExport=false, $doImport=false, $OpslLabl='');
  //echo '</data-PanlHead>';
}
  
######### :COMMON: 
# Kaldes fra:  [_base/page_Blindgyden.php] [_kreditor/page_Ordreliste.php] [_produktion/page_Ordreliste.php] [_system/page_Brugerdata.php] 
function Panl_Blindgyde() {  ## out_PanlsComm.php
  msg_Tip($title='@Du er havnet i en blindgyde',  $messg='@Linket du benyttede er midlertidigt, fordi det rigtige ikke er færdigudviklet.');
}

######### :COMMON: 
# Kaldes fra:  [_base/page_Hovhov.php] 
function Panl_Hovhov() {  ## out_PanlsComm.php
   msg_Warn($title='@Hov hov!',                   $messg= '@Uautoriseret adgang! Hvad gør du her?');
}

######### :COMMON: 
# Kaldes fra: 
function Panl_Erdusikker() {  ## out_PanlsComm.php
  msg_Dialog('warn',ucfirst(tolk('@Retur')),'JavaScript:window.history.back();',ucfirst(tolk('@Fortsæt')), $Knap2_function='$jQ112(this).dialog("close")','','',
                    ucfirst(tolk('@Er du helt sikker?')), ucfirst(tolk('@OBS! Der er ingen fortryd mulighed, hvis du fortsætter!')));
}

######### :COMMON: 
# Kaldes fra:  [_base/htm_pageFinalize.php]
function Panl_PageComments($kilde) {  ## out_PanlsComm.php
global $ØPanelIx;
  $kilde= $kilde.chr(10).chr(13);
  htm_Panl_Top($fmname='commform',$capt= tolk('@Feed back:'),$parms= '#',
        $icon='far fa-comments',$klasse='panelW640',__FUNCTION__, $more=' style= "background-color:WhiteSmoke;" ');
  $mess= set_ajour('feedback');
  if ($mess) 
    { $p= strpos($kilde,' - Fil: ');
      if ($p>0) $fnam= trim(substr($kilde, $p+8)); else $fnam='comments.txt';
      $fp= fopen('../_temp/FeedBack/'.$fnam,"a");
        if ($fp) { fwrite($fp,"\n".date("Ymd-Hi").' '.$mess."\n"); fclose($fp); } else echo ' Fil-skrivefejl! '.$fnam.' ';
    }
  if (file_exists('../_temp/FeedBack/'.$fnam))
      $link= ' <a href="../_temp/FeedBack/'.$fnam.'">Se hidtidige kommentarer</a>';  else $link= '';
  htm_Caption('Har du kommentarer angående denne side, så tilføj dem her, sammen med Panel-overskriften');
  //       <div 
  //        contenteditable="true" name="indexTextArea2" id="strimmel" style="position:absolute;left:209px;top:73px;width:222px;height:232px;z-index:73;" rows="11" cols="26" spellcheck="false" 
  //        title="Du kan redigere og tilføje noter efter tallene, når du er færdig med regnestykket">Log strimmel: &#xa;
  //    </div>
  //htm_CombFelt($type='html', $name='feedback', $valu= $kilde.$link.chr(10).chr(13), $labl='@Fejlmelding, kritik & forslag',  
  htm_CombFelt($type='area', $name='feedback', $valu= $kilde, $labl='@Fejlmelding, kritik & forslag',  
        $titl='@Angiv bemærkninger til programmøren. <br>Husk at anføre Panel-overskriften, hvis kommentaren angår et ud af flere paneler på siden!', $revi=true, $rows= 4);
  htm_nl(2);
  htm_PanlBund($pmpt='@Gem kommentarer', $subm=true, $title='@Gem dine tilføjelser', $akey='g', $simu=false, $frmName=$fmname);
  PanelMin($ØPanelIx);
}

######### :COMMON: ######### :FINANS / DEBITOR / KREDITOR:
# Kaldes fra:  [_debitor/page_Rapport-deb.php] [_finans/page_Kontrol.php] [_finans/page_Rapport-fin.php] [_kreditor/page_Rapport-kre.php] 
function Panl_Rapportliste() {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'rappformlist',$capt= '@Vis rapport:',$parms='../_base/page_Hovedmenu.php',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  htm_CentrOn(); 
    echo tolk('@Vælg rapport i det andet panel, så vises resultatet her.').str_nl(3);
  htm_CentOff();
  htm_PanlBund($pmpt='@Gem',$subm=false);
}


######### :COMMON: ######### :FINANS / SYSTEM:
# Kaldes fra:  [_system/page_Kontoplan.php] 
function Panl_Kontoplan(&$data,$ReadOnly=false) {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'kontoplan',$capt= '@Kontoplan:',$parms='../_system/page_Kontoplan.php',$icon='fas fa-pen-square','panelW960',__FUNCTION__);
  if ($ReadOnly==false) $status= '@Se og Rediger...'; else $status= '@Kun se, ingen Redigering!';
  htm_Table(            #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:Just',          '5:Tip',    '6:Content'],...
    $TblCapt= array( [tolk('@Kontoplanens konti').' - ', '18%','show','','left', ' ', $status] ),
    $RowPref= array(),  #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[]FeltJust_mm', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody= array(    #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[]FeltJust_mm', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
              ['@Id.',       '0%','hidd','',   ['center'], '@Index vedligeholdt af systemet','serial...'],
              ['@Kontonr.',  '7%','indx','',   ['center'], '@Kontonummer. Entydig nummerkode, som benyttes til sortering, summering mv. Angiver du et ubenyttet, oprettes en ny konto, ellers kan du rette kontoen.','@Konto...'],
              ['@Kontonavn','45%','text','',   ['left'  ], '@Kontonavn - beskrivende tekst','@Navn...'],
              ['@Type',      '8%','text','',   ['center'], '@Kontotype: D=Drift, S=Status, Z=Sum, H=Overskrift, R=Resultat, X=Sideskift, L=Lukket'],  //  Angår styring af layout i tabelvisning
              ['@Σ FraKto',  '9%','text','>0', ['center','','font-style:italic; '], '@Summér fra_konto. Angiv laveste kontonummer, som skal med i sammentællingen. Angår kun sum-konti, type Z','@Fra...'],
              ['@Moms',      '7%','text','',   ['center'], '@Momskode: K_:Købs... S_:Salgs... Y_:Ydelser, E_:, '],
              ['@Saldo',     '7%','show','2d', ['center'], '@Kontoens saldo. beregnet beløb','..calc..'],
              ['@Valuta',    '7%','text','',   ['center'], '@Valuta kode','','',true],
              ['@Genvej',    '3%','text','',   ['center','Azure'], '@Genvejs tast, angiv et bogstav','@Ingen'],
              ['@Status',    '7%','sttu','',   ['center','Azure'], '@Status: Aktiv eller Lukket','@Stat...']  //  DB-Felt "lukket" værdi: "on"
    ),
    $RowSuff= array(
//              ['@Slet','3%','text','',  ['center'],'@Klik på rødt kryds for at slette denne konto, forudsat den er ubenyttet!', '<ic class="far fa-times-circle" style="color:red; font-size:13px;"></ic>']
    ),
    $data,
    $FilterOn= true,  # Default! Mulighed for at skjule records med filter.
    $SorterOn= true,  # Default! Mulighed for at sortere records efter kolonne indhold
    $CreateRec=!$ReadOnly,  # Default! Mulighed for at oprette en record
    $ModifyRec=!$ReadOnly,  # Default! Mulighed for at vælge og ændre data i en row
    $ViewHeight= '500px',
    $CalledFrom= __FUNCTION__,
    $Kriterie= ['KONTOPLAN']
  );
  if ($ReadOnly!=false) 
    htm_PlainTxt('@Redigering er kun mulig, ved adgang via SYSTEM');
  htm_CentrOn();  htm_nl();
    textKnap($label='@Import fra fil',   $title='@ fil', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Export til fil',   $title='@ fil', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Vis print layout', $title='@Vis tabel i fuld højde og uden kolonne Genvej, så du kan udskrive kontoplanen med CTRL-P', $link='../_system/page_KontoplanPrint.php');
  htm_CentOff();
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='');
} //  Panl_Kontoplan

######### :COMMON: ######### :FINANS / SYSTEM:
function Panl_Kontoplankort($data) {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'kontokort',$capt= '@Kontonummer-Kort:',$parms='../_system/page_Kontoplan.php',
               $icon='fas fa-pen-square','panelW480',__FUNCTION__);
  htm_FrstFelt('0%');   htm_NextFelt('10%');
  htm_NextFelt('15%');  htm_CombFelt($type='text',$name='konto',  $valu=$data[1], $labl='@Kontonr',    $titl='@Angiv kontoens nummer', $revi=true);
  htm_NextFelt('02%');
  htm_NextFelt('65%');  htm_CombFelt($type='text',$name='navn',   $valu=$data[2], $labl='@Kontonavn',  $titl='@Angiv kontoens navn/beskrivelse',  $revi=true);
  htm_NextFelt('10%');
  htm_LastFelt();
  htm_FrstFelt('0%');   htm_NextFelt('10%');
  htm_NextFelt('15%');  htm_CombList(             $name='type',   $valu=$data[3], $labl='@Type',    $titl='@Kontotype: D=Drift, S=Status, Z=Sum, H=Overskrift, R=Resultat, X=Sideskift, L=Lukket',$liste= KontListe());
  htm_NextFelt('20%');  htm_CombFelt($type='text',$name='frkt',   $valu=$data[4], $labl='@Σ FraKto', $titl='@Summér fra_konto. Angiv laveste kontonummer, som skal med i sammentællingen. Angår kun sum-konti, type Z',  $revi=true);
  htm_NextFelt('05%');
  htm_NextFelt('20%');  htm_CombList(             $name='moms',   $valu=$data[5], $labl='@Moms',    $titl='@Momskode: K_:Købs... S_:Salgs... Y_:Ydelser, E_:, ',$liste= MomsListe());
  htm_NextFelt('30%');  htm_LastFelt();
  htm_nl();
  htm_FrstFelt('0%');   htm_NextFelt('10%');
  htm_NextFelt('20%');  htm_CombList(             $name='valu',  $valu=$data[6],  $labl='@Valuta',  $titl='@@Valuta kode',$liste= ValuListe());
  htm_NextFelt('20%');  htm_CombFelt($type='tal2d',$name='sald', $valu='..calc..', $labl='@Saldo',  $titl='@Kontoens saldo. beregnet beløb', $revi=false);
  htm_NextFelt('05%');
  htm_NextFelt('10%');  htm_CombFelt($type='text',$name='genv',  $valu=$data[8],  $labl='@Genvej',  $titl='@Genvejs tast, angiv et bogstav',  $revi=true);
  htm_NextFelt('05%');
  htm_NextFelt('20%');  htm_CombList(             $name='stat',  $valu=$data[9],  $labl='@Status',  $titl='@Status: Aktiv eller Lukket',$liste= StatListe());
  htm_NextFelt('10%');  htm_LastFelt();
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='');
} //  Panl_Kontoplankort

######### :COMMON: ######### :FINANS / SYSTEM:
function Panl_KontoplanPrint(&$data) {  ## out_PanlsPrim.php
  function str_Blank($tal='',$limit='',$krit=true) {
    if (($tal>$limit) and ($krit==false)) return $tal; else return ' ';
  }  
  $Labels= ['@Kontonr.','@Kontonavn','@Konto Type','@Moms art','@Σ Fra Konto','@Valuta','@Saldo','@Genvej','@Status'  ];
  htm_Caption('KONTOPLAN:');
  echo '  <table class= "" style="width: 1100px; ">';
  echo '    <thead><tr>';
    foreach ($Labels as $Labl) {if ($Labl!= '@Genvej') echo '<td class="filter-false sorter-false">'.tolk($Labl).'</td>';}
  echo '    </tr></thead>';
  echo '    <tfoot><tr>';
    foreach ($Labels as $Labl) {if ($Labl!= '@Genvej') echo '<td>'.tolk($Labl).'</td>';}
  echo '    </tr></tfoot>';
  echo '     <tbody>';
  foreach ($data as $row) {
    $head= $row[2];
    echo '<tr>';  $ix= -1;
      foreach ($row as $col) { $ix++;
      switch ($ix) {
        case 0 : echo '<td style="text-align:center">'.$col.'</td>'; break; 
        case 2 : echo '<td>'.tolk(ListLookup(KontListe(),$search= $col,$colsearch=1,$colresult=3)).'</td>'; break; 
        case 3 : echo '<td style="text-align:center">'.tolk(ListLookup(MomsListe(),$search= $col,$colsearch=1,$colresult=3)).'</td>'; break; 
        case 4 : echo '<td>'.str_Blank($col,0,($head=='H')).'</td>'; break; 
        case 5 : if ($head=='H') echo '<td></td>'; else echo '<td>'.tolk(ListLookup(ValuListe(),$search= $col,$colsearch=1,$colresult=1)).'</td>'; break; 
      //case 5 : if ($head=='H') echo '<td></td>'; else echo '<td>'.tolk(ListLookup(ValuListe(),$search= 'DKK',$colsearch=1,$colresult=1)).'</td>'; break; 
        case 6 : if ($head=='H') echo '<td></td>'; else echo '<td style="text-align:right">'.number_format($col*1,2,',','.').'</td>'; break; 
        case 7 : break; 
        case 8 : if ($head=='H') echo '<td></td>'; else echo '<td>'.$col.'</td>'; break; 
        default: echo '<td>'.$col.'</td>';
      }
  } echo '</tr>'; }
  echo '    </tbody>';
  echo '  </table>';
} //  Panl_KontoplanPrint


######### :COMMON: ######### :XXXXXX:
// 2017-03-09 - Er kopieret til page_GitterMenu:
# Kaldes fra:  [_base/page_Gittermenu.php] 
function Panl_ProgramStatus() {global $ØProgTitl; ## out_PanlsSekd.php
  htm_Panl_Top($name='statform',$capt='@Program status',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-info-circle',$klasse='panelW480',__FUNCTION__,'','');
  echo '<div style="text-align:center; color:red; background:white;"><big><i>'.str_nl().
       tolk('@TEST udgave af').$ØProgTitl.':</i></big>'. str_nl(3);
  echo tolk('@Dette er seneste version i udviklingen.'). str_nl(2);
  echo tolk('@Der vil derfor forekomme midlertidige fejl.'). str_nl(3);
  echo tolk('@Endvidere vil oversættelsen af fremmed sprog, ikke være helt ajour.'). str_nl(3);
  echo tolk('@Databasen er kun delvist i drift, hvorfor nogle data importeres fra tekstfiler.'). str_nl();
  echo tolk('@Tekst import tager tid inden de kan vises...'). str_nl(2);
  //echo tolk('@Kendte problemer: Når der er flere tabeller på en side, er der uløste problemer på dem efter den første.'). str_nl(3);
  echo '</div>';
  htm_PanlBund($pmpt=Tolk('@Gem'),$subm=false);
}


######### :COMMON: ######### Slut funktioner angående visninger i flere menu-grupper




################################################
################################################
################################################
################################################

#+  ? >:SPLITSLUT SPLITSTART:<?php   $DocFil= '../_base/out_PanlsPrim.php';   $DocVer='5.0.0';    $DocRev='2018-09-30';   $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Design af panelers layout. Del-2';
 * Del-2 af redigeringsfilen: '../_base/out_Panls.php'
   HUSK AT DENNE FIL SKAL OPDATERES, PÅ GRUNDLAG AF DEN FÆLLES REDIGERINGSFILS (out_Panls.php) INDHOLD !!!
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2018 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 * Design af panelers layout.
 * Panel-moduler egnet for adaptivt skærm-output.
 *
 * Afhængig af: out_base.php
 *  
 * Filer er redigeret med tabulator sat til 2 tegn, og linielængde max. 200 tegn. De ses bedst med det.
 * Filer skal gemmes i UTF-8 format uden BOM!
 *
  Oprettet: 2018-06-00 evs - EV-soft    #: Dette bibliotek er udviklet 2016-1018 af EV-soft.
  Ændrings-Log:

  
 * 
 */
DocAlder($DocRev);


######### :FINANS: ######### Start funktioner angående visninger i menu-gruppen FINANS
######### :FINANS:
# Kaldes fra: Panl_Kassekladder
function Panl_KasseRedigering($id='2',$dato='Dato',$ejer='Bogholder',$bemr='Bemærkning 2',$bogf='Bogført',$af='Af')   ## out_PanlsPrim.php
/* DEMO  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */
{global $ØbrwnColor,$ØBtNavBgrd, $ØIconStyle;
  $dkftip=  tolk('@D/K/F feltet benyttes i forbindelse med debitor- og kreditor posteringer.').' '.
            tolk('@Er feltet tomt eller udfyldt med F, betragtes det efterfølgende kontonummer som et Finans konto-nummer.').
            tolk('@Skrives der `d` eller `k`, vil det efterfølgende nummer blive tolket som et Debitor konto-nummer eller et Kreditor konto-nummer.');
  $DKforkl= tolk('@Afhængigt af koden i D/K-kolonnen foran feltet, vil der være tale om en Debitor-, Kreditor- eller Finanskonto');
//  if ($dokument[$y]) print "<td title="klik her for at åbne bilaget: $dokument[$y]"><a href="../includes/bilag.php?kilde=kassekladde&filnavn=$dokument[$y]&bilag_id=$id[$y]&bilag=$bilag[$y]&kilde_id=$kladde_id&fokus=bila$y"> <img style="border: 0px solid" src="../ikoner/paper.png"> </a></td>";
//  else               print "<td title="klik her for at vedhæfte et bilag">          <a href="../includes/bilag.php?kilde=kassekladde&bilag_id=$id[$y]&bilag=$bilag[$y]&ny=ja&kilde_id=$kladde_id&fokus=bila$y">                 <img style="border: 0px solid" src="../ikoner/clip.png">  </a></td>";
  if ($dokument[$y]) {
          $title='@klik her for at åbne bilaget: $dokument[$y]';
          $link='../_base/page_Blindgyden.php'; /* "../includes/bilag.php?kilde=kassekladde&filnavn=$dokument[$y]&bilag_id=$id[$y]&bilag=$bilag[$y]&kilde_id=$kladde_id&fokus=bila$y";    */
          $clip= 'paper.png';
   } else {
          $title='@klik her for at vedhæfte et bilag';  
          $link='../_base/page_Blindgyden.php'; /* "../includes/bilag.php?kilde=kassekladde&bilag_id=$id[$y]&bilag=$bilag[$y]&ny=ja&kilde_id=$kladde_id&fokus=bila$y";  */
          $clip= 'clip.png'; 
  };
  htm_Panl_Top($name= 'kasseform',$capt= tolk('@Kassekladde:').' '.$id.', <small>'.$ejer.'</small>',$parms='page_Blindgyden.php',$icon='fas fa-database','panelWmax',__FUNCTION__);
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content']
      ['@Kladde:',       '40%','text','','left', '@Her er den tekst du angav i kladdens bemærkning-felt',  '@Angiv din bemærkning...', 'Bemærkning 3'], 
      ['@Konto-kontrol:','5em','text','','left', '@Angiv kontonummer for den konto, hvis bevægelser skal kontrolleres',  '@Nummer...'], 
    ),
    $RowPref= array(  #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip' 
      ['PDF',           '2%','text', '' ,['center'],'@I denne kolonne håndterer du PDF-bilag, som er tilknyttet den enkelte postering.',
          '<a href='.$link.'><ic class="fas fa-paperclip"; style="font-size:14px; color:'.$ØBtNavBgrd.';" title="'.
          tolk('@Tilføj eller fjern PDF-bilag til denne post.').'";></ic></a>','placeh']
      ),
    $RowBody= array(
      ['@Bilag.',       '4%','show', '' ,['center'],'@Bilagsnummer tildeles automatisk og fortsættes fra sidst anvendte bilagsnummer fra samme bruger.'.' ','...auto...'],
      ['@Dato',         '8%','date', '' ,['center'],'@Bilagets dato, som automatisk sættes til dags dato, men kan ændres.','fakt.dato'],
      ['@Bilags tekst','27%','text', '' ,['left'],  tolk('@Bilagstekst er frivillig, men det er nyttigt senere at kunne se, hvad de enkelte posteringer drejer sig om.').' ',tolk('@Posterings note...')],
      ['@D/K',          '3%','text', '' ,['center'],$dkftip,'d/k/f'],
      ['@Debet Kt.',    '6%','text', '' ,['center'],tolk('@Debet Kt. er til kontonummeret på den konto, posteringen skal ske på.').' '.$DKforkl,'D-kt'],
      ['@D/K',          '3%','text', '' ,['center'],$dkftip,'d/k/f'],
      ['@Kredit Kt.',   '6%','text', '' ,['center'],tolk('@Kredit Kt. er til kontonummeret på den konto, posteringen skal ske på.').' '.$DKforkl,'K-kt'],
      ['@Faktura nr.',  '7%','text', '' ,['center'],'@Fakturanr. benyttes i forbindelse med debitor- og kreditorposteringer.','Fak...'],
      ['@Beløb',        '7%','text','2d',['right'] ,tolk('@Beløb indeholder det beløb, der skal bogføres. ').'<br>'.
                                                    tolk('Hvis man ved simulering eller anden kontrol opdager, at en linje skal bogføres direkte modsat af, ').
                                                    tolk('@hvad der står i kassekladden, så kan man blot sætte minustegn foran beløbet.').' '.
                                                    tolk('@På den måde bytter kontonumrene i felterne debet og kredit plads, og beløbet bliver igen positivt.'),'...Kr.'],
      ['@Valuta',       '4%','text', '',['center'],'@Valutakode for den valuta, som er benyttet på bilaget.','DKK'],
      ['@Forfald',      '8%','date', '',['center'],'@Beløbets forfalds dato.','YYYY-MM-DD'],
      ['@moms',         '4%','text', '',['center'],'@Uden moms: Angiv 0, hvis der ikke skal beregnes moms. Uden angivelse, benyttes standard moms-sats.','@25%.'],
      ),
    $RowSuff= array(
      ['@Konto saldo',  '5%','text', '',['right'], #'0.000,00<div type= "text" name="saldo" value="00.000,00" width="8%"/>',
            tolk('@Bevægelser og saldo for den konto, som angives ovenfor i Felt: Konto-kontrol.').' <br>'.
            tolk('@Er velegnet til afstemning med bank- og girokonti'),'..auto..'],
      ['@Fortryd',      '3%','text', '',['center'],'@Fortryd postering! Tilbagefør beløbet ved at klikke på ikonen',
            '<a href='.$link.'><ic class="fas fa-undo" style="font-size:14px; color:red;" title="'.tolk('@Tilbagefør denne postering').'"></ic></a>']
      ),
    $data= array(['Bilag','Dato','Tekst','D/K','Debet','D/K','Kredit','FaktNr','Beløb','Valuta','Forfald','Moms'],
      ['Bilag','Dato',    'Tekst',                  'D/K','Debet','D/K','Kredit','FaktNr',  'Beløb',  'Valuta','Forfald','Moms'],
      ['7', '05-02-2012','Indbetaling, Faktura 100',  'F','58000','D','1000',     '100',    '7500.00',  'DKK',''  ,''],
      ['8', '09-02-2012','Indbetaling, Fakt. 101',    'F','58000','D','78960208', '101',    '5250.00',  'DKK',''  ,''],
      ['9', '12-02-2012','Udbetaling',                'F','62100','F','58000',    '',       '12000.00', 'DKK',''  ,''],
      ['10','13-02-2012','Dankort, Malergrosisten',   'K','1001', 'F','58000',    '090043', '950.00',   'DKK',''  ,''],
      ['11','13-02-2012','Overtræksgebyr',            'F','7900', 'F','58000',    '',       '75.00',    'DKK',''  ,''],
      ['12','19-02-2012','Dankort OK Benzin',         'K','1002', 'F','58000',    '87673',  '586.23',   'DKK',''  ,''],
      ['13','21-02-2012','Indbetaling, T Petersen',   'F','58000','D','1000',     '102',    '4250.00',  'DKK',''  ,''],


      ),
    $FilterOn= false,       #  Mulighed for at skjule records med filter.
    $SorterOn= false,       #  Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       #  Mulighed for at oprette en record
    $ModifyRec=true,       #  Mulighed for at ændre data i en row
    $ViewHeight= '350px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
### PanelFooter:
### KnapPanel:
  htm_KnapGrup('@Her kan du:',true,false);
    textKnap($label='@Gem',             $title='@Klik her for at gemme',$link='../_base/page_Blindgyden.php',$akey='g');
    textKnap($label='@Opslag',          $title='@Opslag - din markørs placering angiver hvilken tabel, opslag foretages i',$link='../_base/page_Blindgyden.php',$akey='o');
    textKnap($label='@Bogfør',          $title='@Bogfør - der foretages først en simulering, som du skal bekræfte',$link='../_base/page_Blindgyden.php',$akey='b');
    textKnap($label='@Simuler',         $title='@Simulering af bogføring viser bevægelser i kontoplanen',$link='../_base/page_Blindgyden.php',$akey='s');
    textKnap($label='@Annuller',        $title='@Annuller simulering',  $link='../_base/page_Blindgyden.php',$akey='a');
    textKnap($label='@Kopier',          $title='@Kopier til ny',        $link='../_base/page_Blindgyden.php',$akey='k');
    textKnap($label='@Tilbagefør',      $title='@Tilbagefør postering', $link='../_base/page_Blindgyden.php',$akey='t');
    textKnap($label='@Hent ordrer',     $title='@Henter afsluttede ordrer fra ordreliste',$link='../_base/page_Blindgyden.php',$akey='h');
    textKnap($label='@DocuBizz import', $title='@DocuBizz import',      $link='../_base/page_Blindgyden.php',$akey='d');
    textKnap($label='@Bankimport',      $title='@Importerer bankposteringer eller andre data fra .csv-fil (kommasepareret fil)',$link='../_base/page_Blindgyden.php',$akey='i');
    textKnap($label='@Import',          $title='@Importerer hele kassekladden fra .csv-fil (kommasepareret fil)',$link='../_base/page_Blindgyden.php',$akey='i');
    textKnap($label='@Eksport',         $title='@Eksporter hele kassekladden til .csv-fil (kommasepareret fil)',$link='../_base/page_Blindgyden.php',$akey='i');
    textKnap($label='@Udlign',          $title='@Finder åbne poster, som modsvarer beløb og fakturanummer',$link='../_base/page_Blindgyden.php',$akey='u');
    textKnap($label='@Vis print layout',$title='@Skjul header og footer, og vis tabel i fuld højde, så du kan udskrive kassekladden med CTRL-P', $link='../_base/page_Blindgyden.php');
  htm_KnapGrup('@Her kan du:',false);
  //TastTip();
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :FINANS:
# Kaldes fra:  [_finans/page_Kladdeliste.php] 
function Panl_Kassekladder($DATA= array())  ## out_PanlsPrim.php
{ dvl_ekko(' Panl_Kassekladder ');
  htm_Panl_Top($name= 'naviform',$capt= '@Oversigt over kassekladder:',$parms='page_Blindgyden.php',$icon='fas fa-list','panelW720',__FUNCTION__);
  htm_Table($TblCapt= array(['@Her kan du vælge blandt', '15%', 'html', '', 'left','@Vælg en kladde, og se den i panelet nedenfor.', '@oprettede kladder']), #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:Just',          '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
    $RowPref= array(),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[FeltJust_mm]', '5:ColTip', '6:placeholder','7:default','8:select'],
         ['@Id',          '5%', 'indx', '',   ['center'], '@Systemoprettet løbenummer','..auto..'],
         ['@Oprettet',   '08%', 'date', '',   ['center'], '@Dato for kladdens oprettelse','YYYY-MM-DD'],
         ['@Ejer',       '10%', 'text', '',   ['left'  ], '@Den der har oprettet kladden','Ejer...'],
         ['@Bemærkning', '50%', 'text', '',   ['left'  ], '@Tekst der beskriver kladden','Bem...'],
         ['@Bogført',    '08%', 'date', '' ,  ['center'], '@Bogført dato','YYYY-MM-DD'],
         ['@Af',          '5%', 'text', '',   ['center'], '@Bruger der har bogført','Af...'],
         ['@Status',      '5%', 'text', '',   ['center'], '@B:Bogført / S:Simuleret','..auto..']
    ),
    $RowSuff= array(),
    $DATA=    array(
         ['1','Dato','Ejer','Bemærkning 1','Bogført-dato','ej','B'],
         ['2','Dato','Ejer','Bemærkning 2','Bogført-dato','ej','B'],
         ['3','Dato','Bogholder','Bemærkning 3','-','bh','S']
    ),
    $FilterOn= true,       #  Mulighed for at skjule records med filter.
    $SorterOn= true,       #  Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       #  Mulighed for at oprette en record
    $ModifyRec=true,       #  Mulighed for at ændre data i en row
    $ViewHeight= '160px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );                                      

  htm_Plaintxt('Klik på Id-nummeret, for at vise den kladde, du vil redigere...');
  htm_PanlBund($pmpt='@Gem',$subm=true);
  htm_nl();
  
  Panl_KasseRedigering($DATA[2][0],$DATA[2][2]);
//  Panl_FootMenu($doPrint=true, $doErase=true, $doLookUp=true, $doAccept=true, $doExport=true, $doImport=true, 
//    $OpslLabl='@Opslag: markørens placering bestemmer, hvilken tabel opslag skal foretages i');
}

######### :FINANS:
# Kaldes fra:  [_finans/page_Budget.php] 
function Panl_Budget( &$DATA, $regnskabsaar='2018', $maanedantal=12, $startaar=2018, $startmaaned=1)   ## out_PanlsPrim.php
{ global $ØtblRowLgt;
  htm_Panl_Top($name= 'budgform',$capt= tolk('@Budget ').' '.($regnskabsaar+0).':',$parms= 'Panl_Erdusikker()',$icon='fas fa-list','panelWmax',__FUNCTION__);
### "InfoFelter" over kolonne-labels:
      htm_FrstFelt( '5%'); 
      #htm_NextFelt('10%');  echo tolk('@Nyt budget:');  //  '@ +/- 0% OK', '@Pct. korrektion'
      htm_NextFelt('10%');  htm_CentHead(tolk('@Opret automatisk budget:')); //echo tolk('@Nyt budget:');  //  '@ +/- 0% OK', '@Pct. korrektion'
      htm_NextFelt('8%');   htm_CombFelt($type='number',  $name='pct', $valu= 0,   
                                         $labl='@% Korrektion',  
                                         $titl='@Angiv en +/- pct-sats, som der skal justeres op/ned med', 
                                         $revi=true, $rows='2',$width='44px',$step='1');
      htm_NextFelt('30%');  textKnap($label='@Udfyld beløbstal, på grundlag af sidste års budget-tal',  
                                          $title=tolk('@Automatisk budgetlægning på grundlag af sidste års regnskab, korrigeret med den angivne pct. sats!').'<br>'.
                                          tolk('@ADVARSEL: Alle nuværende beløb overskrives! Gem ikke, hvis det er en fejl.'),$link='../_base/page_Blindgyden.php','','','tooltipB');
      htm_NextFelt('35%');  htm_RadioGrp($type='hori',  $name='krvis',  $labl='@Beløbsvisning:', $titl='@Vælg visnings nøjagtighed for budget beløb', 
                            $optlist= array(['kr','@Hele kroner','@eller',true],['tusind','@Kun tusinder','']),$action='');
      htm_LastFelt();    
### Gør $RowBody klar:
  //  periodeoverskrifter benytter: ['@'.$periode_kort, '4%','text',$outFormat, ['right','','font-style:italic; '], '@'.$periode_lang,'']
  $MdTitles= periodeoverskrifter($maanedantal, $startaar, $startmaaned, 1, "regnskabsmaaned", $regnskabsaar);  
  $RowBody= array();  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
  array_push($RowBody, 
      ['@Konto',     '4%','','data',  'center', '@Kontonummer. Entydig nummerkode, som benyttes til sortering, summering mv.','@Konto...'],
      ['@Kontonavn','22%','','data',  'left',   '@Kontonavn - beskrivende tekst','']
    );
  foreach ($MdTitles as $Md) array_push($RowBody, $Md); // FIXIT: beløbene kan ikke redigeres! ?
  array_push($RowBody, ['@I alt',  '5%','text','2d', ['right'], '@Budgetårets aktuelle ultimo beløb.','']);
  $RowBody= array();  #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
  array_push($RowBody, 
      // ['@Id.',           '0%','hidd','',['center'],'@Index','serial...'],
      ['@Konto',     '4%','data','', ['center',$ØtblRowLgt,'',''], '@Kontonummer. Entydig nummerkode, som benyttes til sortering, summering mv.','@Konto...'],
      ['@Kontonavn','22%','html','', ['left'  ], '@Kontonavn - beskrivende tekst','@Navn...'],
      ['@Type',      '0%','hidd','', ['center'], '@Kontotype: D=Drift, S=Status, Z=Sum, H=Overskrift, R=Resultat, X=Sideskift, L=Lukket'],  //  Angår styring af layout i tabelvisning
      ['@Moms',      '0%','hidd','', ['left'  ], '@Momskode: K_:Købs... S_:Salgs... Y_:Ydelses..., E_:Europæisk..., ','@Moms...'],
      ['@Σ FraKto',  '0%','hidd','', ['center'], '@Summér fra_konto. Angiv laveste kontonummer, som skal med i sammentællingen. Angår kun sum-konti, type Z','@Fra...'],
      ['@Valuta',    '0%','hidd','', ['left'  ], '@Valuta kode','@Valu...','',true],
      ['@Saldo',     '0%','hidd','', ['center'], '@Kontoens saldo. beregnet beløb','..calc..'],
      ['@Genvej',    '0%','hidd','', ['center'], '@Genvejs tast, angiv et bogstav','@Genv...']
    );
  //  periodeoverskrifter benytter: ['@'.$periode_kort, '4%','text',$outFormat, ['right','','font-style:italic; '], '@'.$periode_lang,'']
  $MdTitles= periodeoverskrifter($maanedantal, $startaar, $startmaaned, 1, "regnskabsmaaned", $regnskabsaar,$outFormat='0d');  
  foreach ($MdTitles as $Md) array_push($RowBody, $Md);
  array_push($RowBody, ['@I alt',  '5%','text','0d', ['right'], '@Budgetårets aktuelle ultimo beløb.','']);
  htm_Table(
   $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        // ['@Udfyld med sidste års tal, korrigeret med:', '10%','show','','left', '@ +/- 0% OK', '@Pct. korrektion']
        [' ','5%','text','show','right','','','Info:']
      ),
   $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      ),
   $RowBody,//= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
   //   ),
   $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
      ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON]
   $DATA, //=   array(
      //  ),
   $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
   $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
   $CreateRec=false,       # Mulighed for at oprette en record
   $ModifyRec=true,       # Mulighed for at ændre data i en row
   $ViewHeight= '700px',  # Højden af den synlige del af tabellens data
    __FUNCTION__,
    $Kriterie= ['BUDGET']
  );
#### KnapPanel:
  htm_hr();
  htm_CentrOn();
    textKnap($label='@Vide mere?',  $title='@Her kan du tilpasse forventede månedlige beløb. Hvis du vil ændre konti, gør du det her: Menu\SYSTEM\Kontoplan.',$link='',$akey='v');
    naviKnap($label='@Retur til Regnskab',  $title='@Vend tilbage til regnskab',$link='../_finans/page_Regnskab.php',$akey='r');
    //  naviKnap($label='@Retur til Hovedmenu', $title='@Vend tilbage til programmets hovedmenu',$link='../_base/page_Hovedmenu.php',$akey='h');
    textKnap($label='@Vis print layout',    $title='@Skjul header og footer, og vis tabel i fuld højde, så du kan udskrive budgettet med CTRL-P', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Exporter til fil',    $title='@Dan en cvs-fil, som du kan downloade og gemme lokalt', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Importer fra fil',    $title='@Overskriv nuværende budget, med et som tidligere er blevet exporteret og gemt lokalt', $link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='@Gem hele budgettet.',$akey='g');
}
######### :FINANS:
# Kaldes fra:  [_finans/page_Kontrol.php] [_finans/page_Rapport-fin.php] 
function Panl_RapportFinans($Aar_Liste='', $Art_Liste='', $somfakt='', $Knt_Liste='')   ## out_PanlsPrim.php
{global $Ø_MdrList, $Ø_DagList, $Ø_ArtList; // oprettet i ../_base/out_base.php
  set_FormVars(['regnaar','afdeling','rapptype','findatefra','findatetil','ListFra','ListTil','medlagr','RappFra','RappTil']);  // Opdater alle variabler på form 'rappform' :
  
  $Aar_Liste= Aar_Liste();
  $Knt_Liste= MakeDriftsKonti();
  if (isset($_POST['rapptype'])) $rapptype= $_POST['rapptype'];
  
  htm_Panl_Top($name= 'rappform',$capt= '@Finansrapport:',$parms='../_finans/page_Rapport-fin.php?job='.$rapptype, $icon='fas fa-chart-line','panelW320',__FUNCTION__); //  ../_base/page_Hovedmenu.php
  htm_FrstFelt('25%');    htm_CombList($name='regnaar',  $valu= $_SESSION['regnaar'], $labl='@Regnskabsår',
                                       $titl='@Der kan kun rapporteres inden for et regnskabsår, hvilket angives her.', $liste= $Aar_Liste);
  htm_NextFelt('25%');    textKnap(    $label='@Opdatér',    
                                       $title='@Opdater her efter en rettelse af regnskabsår',$link='../_base/page_Blindgyden.php');
  htm_NextFelt('50%');    htm_CombList($name='afdeling', $valu= $_SESSION['afdeling'], $labl='@Afdeling',
                                       $titl='@Her vælges hvilken afdeling rapporten skal omfatte', $liste= Afd_Liste()); # $Ø_ArtList
  htm_LastFelt();
  htm_FrstFelt('20%');   
  htm_NextFelt('80%');    htm_CheckFlt($type='checkbox', $name='medlagr',        $valu= $_SESSION['medlagr'], $labl='@Medtag lagerbevægelser',  
                                      $titl='@Afmærk her, hvis lagerbevægelser skal medtages.',  $revi=true);
  htm_LastFelt();
  if ($rapptype=='momsangivelse') msg_Tip($title="@Om momsafregning", $messg=
              tolk('@Husk at det er en god ide at bogføre med udgangen af MOMS regnskabs perioden, så konto:').' <br>'.
              tolk('@66100&nbsp;Salgsmoms og 6600&nbsp;Købsmoms er opdateret inden indberetning.'));
  htm_hr();
  echo '<captlabl>';  
		htm_FrstFelt('50%');  echo tolk('@Periode fra:');
		htm_NextFelt('50%');  echo tolk('@Periode til:');
		htm_LastFelt(); 
  echo '</captlabl>';
  htm_FrstFelt('50%');    htm_CombFelt($type='date',  $name='findatefra',  $valu= $_SESSION['findatefra'],  $labl='@Periode start', 
                                       $titl='@Dato for rapportens påbegyndelse', $revi=true);
  htm_NextFelt('50%');    htm_CombFelt($type='date',  $name='findatetil',  $valu= $_SESSION['findatetil'],  $labl='@Periode slut',  
                                       $titl='@Dato for rapportens afslutning',   $revi=true);
  htm_LastFelt();
  htm_FrstFelt('50%');    htm_CombList($name='ListFra', $valu= $_SESSION['ListFra'], $labl='@Fra konto', 
      $titl='@Første konto nummer, som medtages i rapporten',$liste= $Knt_Liste, $more=' max-width:150px; KtInterval');
  htm_NextFelt('50%');    htm_CombList($name='ListTil', $valu= $_SESSION['ListTil'], $labl='@Til konto', 
      $titl='@Sidste konto nummer, som medtages i rapporten',$liste= $Knt_Liste, $more=' max-width:150px; KtInterval');
  htm_LastFelt();
  htm_Accept($labl='@Benyt det', $title='@Godkend dine valg, så de benyttes ved rapportdannelse', $width='',$akey='b',$form='rappform');
  //  htm_hr();
  //  htm_CombList($name='rapptype', $valu= $_SESSION['rapptype'], $labl='@Rapporttype',
  //                                       $titl='@Her vælges blandt de i programmet opsatte rapporttyper', $liste= Art_Liste(),' max-width:150px; '); # $Ø_ArtList
  //  htm_Accept($labl='@Vis rapport', $title='@Dan rapport med de ovenfor valgte kriterier<br>Virker først efter 2 klik, når rapportype er ændret !', $width='',$akey='v',$form='rappform');
    htm_KnapGrup('@Vis:',true);
    textKnap($label='@Kontokort med moms', $title= '@Kontospecifikation fra valgte momsbelagte konti i valgt periode. Viser moms for posteringer hvor momsen er trukket automatisk.',     
                                          $link=  '../_finans/page_Rapport-fin.php?job=kontokort_moms', $akey='K');
    textKnap($label='@Kontokort',         $title= '@Kontospecifikation alle valgte konti i valgt periode.',     
                                          $link=  '../_finans/page_Rapport-fin.php?job=kontokort',      $akey='k');    
    textKnap($label='@Balance',           $title= 'Saldo for statuskonti og summering af disse for valgte konti i valgt periode.',      
                                          $link=  '../_finans/page_Rapport-fin.php?job=balance',        $akey='B');
    textKnap($label='@Resultat/Budget',   $title= '@Saldo for driftkonti + budgettal og summering af disse for valgte konti i valgt periode og sat i relation til budgettal.', 
                                          $link=  '../_finans/page_Rapport-fin.php?job=resultatb',      $akey='s');
    textKnap($label='@Resultat',          $title= '@Saldo for driftkonti og summering af disse for valgte konti i valgt periode.',                 
                                          $link=  '../_finans/page_Rapport-fin.php?job=resultat',       $akey='r');
    textKnap($label='@Budget',            $title= '@Saldo for driftkonti + budgettal og summering af disse for valgte konti i valgt periode.', 
                                          $link=  '../_finans/page_Rapport-fin.php?job=budget',         $akey='b');
    textKnap($label='@Momsangivelse',     $title= '@Saldo for momskonti og summering i valgt periode.',                 
                                          $link=  '../_finans/page_Rapport-fin.php?job=momsangivelse',  $akey='M');
    textKnap($label='@Periodeangivelser', $title= '@MOMS Listeangivelsesfil, som kan lægges op via SKATs hjemmeside', 
                                          $link=  '../_finans/page_Rapport-fin.php?job=periodeliste',   $akey='P');
  htm_KnapGrup('@Vis:',false);
htm_KnapGrup('@Andre:',true);
    textKnap($label='@Kontrolspor',  $title='@Vilkårlig søgning i transaktioner. Her kan du spore datas oprindelse',  $link='../_finans/page_Kontrol.php');    
    textKnap($label='@Provision',    $title='@Rapport over medarbejdernes provisionsindtjening', $link='../_finans/page_Provisionsrapport.php');
  htm_KnapGrup('@Vis:',false);
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Luk og gå retur til hovedmenu');
  dev_show();
}

######### :FINANS:
function FinaRappTop($rapp='') {
  htm_FrstFelt('40%');  htm_DataFelt('@Rapport:',$rapp);
  htm_NextFelt('30%');  htm_DataFelt('@Afdeling:',tolk(ListLookup(Afd_Liste(),$search= $_SESSION['afdeling'],$colsearch=1,$colresult=0)));
  htm_NextFelt('30%');  htm_DataFelt('@Lagerbevægelser:',$_SESSION['medlagr']);
  htm_LastFelt();
  htm_FrstFelt('30%');  htm_DataFelt('@Regnskab:',$regnskab='DEMO',''); 
  htm_NextFelt('10%');  htm_DataFelt('@Periode:','','right'); 
  htm_NextFelt('20%');  htm_DataFelt('@Fra:',$_SESSION['findatefra']);
  htm_NextFelt('40%');  htm_DataFelt('@Til:',$_SESSION['findatetil']);
  htm_LastFelt();
  htm_FrstFelt('30%');  htm_DataFelt('@Regnskabsår:',$_SESSION['regnaar']);
  htm_NextFelt('10%');  htm_DataFelt('@Konti:','','right'); 
  htm_NextFelt('20%');  htm_DataFelt('@Fra:',$_SESSION['ListFra']);
  htm_NextFelt('40%');  htm_DataFelt('@Til:',$_SESSION['ListTil']);
  htm_LastFelt();
}

######### :FINANS:
function Panl_RapportKontokort() {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'rappformkort',$capt= '@Rapport - kontokort:',$parms='../_base/page_Blindgyden.php',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  FinaRappTop('KONTOKORT');
#  htm_FrstFelt('30%');  htm_DataFelt('@Rapport:','KONTOKORT');
#  htm_NextFelt('30%');  htm_DataFelt('@Navn:','Bogfør');
#  htm_NextFelt('40%');  htm_DataFelt('@Afdeling:','Test');
#  htm_LastFelt();
  htm_hr();
  htm_Table(
    $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
      ),
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Dato',   '11%','date','',  ['center'],'@Posteringens dato',''],
        ['@Bilag',   '4%','show','',  ['center'],'@Bilags nummer','@nr...'],
        ['@Tekst',  '38%','show','',  ['left'  ],'@Tekst','@txt...'],
        ['@Debet',  '11%','show','2d',['right' ],'@Debet','0.00'],
        ['@Kredit', '11%','show','2d',['right' ],'@Kredit','0.00'],
        ['@Saldo',  '12%','show','2d',['right' ],'@Saldo','0.00'],
      ),
    $RowSuff= array(
      ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
    //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $TablData= array( # DemoData:
        ['::',' ','1000 : Udført arbejde : S1',' ',' ',' '],
        [':.',' ','Primosaldo',' ',' ','0'],
        ['Dato','1','Tekst','','',''],
        ['Dato','2','Tekst','','',''],
        ['::',' ','1100 : Varesalg DK : S1',' ',' ',' '],
        [':.',' ','Primosaldo',' ',' ','0'],
        ['Dato','1','Tekst','','',''],
        ['Dato','5','Tekst','','',''],
        ['Dato','6','Tekst','','',''],
        ['::',' ','2100 : Varekøb i DK : K1',' ',' ',' '],
        [':.',' ','Primosaldo',' ',' ','0'],
        ['Dato','7','Tekst','','',''],
        ['Dato','8','Tekst','','','']
      ),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,       # Mulighed for at oprette en record
    $ModifyRec=false,       # Mulighed for at ændre data i en row
    $ViewHeight= '400px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__,
    $Kriterie= ['RAPPORT']
  );
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}

######### :FINANS:
function Panl_RapportKontokortMm() {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'rappformMm',$capt= '@Rapport - kontokort med moms:',$parms='../_base/page_Blindgyden.php',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  FinaRappTop('KONTOKORT med moms');
  htm_hr();
  htm_Table(
    $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
      ),
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Dato',   '11%','date','',  ['center'],'@Posteringens dato',''],
        ['@Bilag',   '4%','show','',  ['center'],'@Bilags nummer','@nr...'],
        ['@Tekst',  '38%','show','',  ['left'  ],'@Tekst','@txt...'],
        ['@Beløb',  '11%','show','2d',['right' ],'@Debet','0.00'],
        ['@Moms', '11%','show','2d',['right' ],'@Kredit','0.00'],
        ['@Incl. moms',  '12%','show','2d',['right' ],'@Saldo','0.00'],
      ),
    $RowSuff= array(
      ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
    //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $TablData= array( # DemoData:
        ['::',' ','1000 : Udført arbejde : S1',' ',' ',' '],
        [':.',' ','Primosaldo',' ',' ','0'],
        ['Dato','1','Tekst','','',''],
        ['Dato','2','Tekst','','',''],
        ['::',' ','1100 : Varesalg DK : S1',' ',' ',' '],
        [':.',' ','Primosaldo',' ',' ','0'],
        ['Dato','1','Tekst','','',''],
        ['Dato','5','Tekst','','',''],
        ['Dato','6','Tekst','','',''],
        ['::',' ','2100 : Varekøb i DK : K1',' ',' ',' '],
        [':.',' ','Primosaldo',' ',' ','0'],
        ['Dato','7','Tekst','','',''],
        ['Dato','8','Tekst','','','']
      ),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,       # Mulighed for at oprette en record
    $ModifyRec=false,       # Mulighed for at ændre data i en row
    $ViewHeight= '400px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__,
    $Kriterie= ['RAPPORT']
  );
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}

######### :FINANS:
function Panl_RapportBalance() {  ## out_PanlsPrim.php   $regnaar, $afdeling, $rapptype, $ListFra, $ListTil
  htm_Panl_Top($name= 'rappformbal',$capt= '@Rapport - Balance:',$parms='../_base/page_Blindgyden.php',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  FinaRappTop('BALANCE');
  htm_hr();
  htm_Table(
    $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
      ),
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Konto',      '08%','show','col2',['center'],'@Konto nummer i kontoplanen',''],
        ['@Tekst',      '54%','show','',    ['left'  ],'@Tekst','@txt...'],
        ['@I perioden', '14%','show','2d',  ['right' ],'@Opgjort for perioden','0.00'],
        ['@År til dato','14%','show','2d',  ['right' ],'@Opgjort fra årets begyndelse til dags dato','0.00'],
      ),
    $RowSuff= array(
      ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
    //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $TablData= array( # DemoData:   $feltFlags betydning: '::' 1.HeadLine   ':.' Efterflg. HeadLine   ':=' SumLinie
        ['::STATUS',' ',' ',' '],
        ['::AKTIVER:',' ',' ',' '],
        ['::IMMATERIELLE ANLÆGSAKTIVER',' ',' ',' '],
        [':.(Patenter, rettigheder, goodwill, udviklingsprojekter under udførelse mv.)',' ',' ',' '],
        ['::MATERIELLE ANLÆGSAKTIVER',' ',' ',' '],
        [':.(Inventar, bygninger, maskiner mv.)',' ',' ',' '],
        ['50910','Tilgang i året drift/inventar','16000.00','16000.00'],
        [' ','Anlægsaktiver','16000.00','16000.00'],
        ['::LIKVIDE BEHOLDNINGER',' ',' ',' '],
        ['58000','Bank','3388.77','3388.77'],
        [':=Likvide beholdninger i alt ','','3388.77','3388.77'],
        [':=OMSÆTNINGSAKTIVER I ALT','','3388.77','3388.77'],
        [':=AKTIVER I ALT','','19388.77','19388.77'],
        ['::PASSIVER',' ',' ',' '],
        ['::EGENKAPITAL',' ',' ',' '],
        ['62100','Hævet kontant i virksomheden','12000.00','12000.00'],
        [':=Egenkapital','','12000.00','12000.00'],
        ['::LANGFRISTET GÆLD (over 1 år)',' ',' ',' '],
        ['::KORTFRISTET GÆLD (under 1 år)',' ',' ',' '],
        ['::SKYLDIGE OMKOSTNINGER',' ',' ',' '],
        ['::Løn',' ',' ',' '],
        ['::Forudbetalinger',' ',' ',' '],
        ['65100','Kreditorer, ubetalte regninger','-20752.77','-20752.77'],
        [':=Kreditorer','','-20752.77','-20752.77'],
        [':=SKYLDIGE OMKOSTNINGER I ALT','','-20752.77','-20752.77'],
        ['::SKYLDIG MOMS',' ',' ',' '],
        ['66100','Salgsmoms','-3400.00','-3400.00'],
        ['66200','Købsmoms','4340.55','4340.55'],
        [':=Skyldig moms i alt','','940.55','940.55'],
        [':=KORTFRISTET GÆLD I ALT','','-19812.22','-19812.22'],
        [':=PASSIVER I ALT','','-7812.22','-7812.22'],
        [':=Balancekontrol','','11576.55','11576.55'],
       ),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,       # Mulighed for at oprette en record
    $ModifyRec=false,       # Mulighed for at ændre data i en row
    $ViewHeight= '400px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__,
    $Kriterie= ['RAPPORT']
  );
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}

######### :FINANS:
function Panl_RapportMomsangivelse() {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'rappformang',$capt= '@Rapport - Momsangivelse:',$parms='../_base/page_Blindgyden.php',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  FinaRappTop('MOMSANGIVELSE');
#  htm_FrstFelt('50%');  htm_DataFelt('@Rapport:','MOMSANGIVELSE');
#  htm_NextFelt('30%');  htm_DataFelt('@Regnskab:',$regnskab='DEMO',''); 
#  htm_NextFelt('20%');  htm_DataFelt('@CVR:','########',''); 
#  htm_LastFelt();
#  htm_FrstFelt('30%');  htm_DataFelt('@Regnskabsår:','1. 2017'); 
#  htm_NextFelt('10%');  htm_DataFelt('@Periode:','',''); 
#  htm_NextFelt('30%');  htm_DataFelt('@Fra:','1. januar',''); 
#  htm_NextFelt('30%');  htm_DataFelt('@Til:','31. december',''); 
#  htm_LastFelt();
  htm_hr();
  htm_Table(
    $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
      ),
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Konto',              '11%','show','',  ['center'],'@Konto nummer i kontoplanen',''],
        ['@Angår',              '61%','show','',  ['left'  ],'@Kontoens benævnelse',''],
        ['@Indgående afgifter', '14%','show','2d',['right' ],'@Moms, skat og afgifter på virksomhedens indkøb','0.00'],
        ['@Udgående afgifter',  '14%','show','2d',['right' ],'@Moms, skat og afgifter på virksomhedens salg','0.00'],
      ),
    $RowSuff= array(
      ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
    //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $TablData= array( # DemoData:
        ['66100','Salgsmoms',' ','3400.00'],
        ['66150','Moms af varekøb i udlandet',' ','0.00'],
        ['66155','Moms af ydelseskøb i udlandet med omvendt betalingspligt',' ','0.00'],
        ['66160','Olieafgift','0.00',' '],
        ['66170','Elafgift','0.00',' '],
        ['66180','Vandafgift','0.00',' '],
        ['66200','Købsmoms','4341.00',' '],
        [':=','Afgiftsbeløb i alt',' ','-941.00']
      ),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,       # Mulighed for at oprette en record
    $ModifyRec=false,       # Mulighed for at ændre data i en row
    $ViewHeight= '400px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__,
    $Kriterie= ['RAPPORT']
  );
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}


######### :FINANS:
function Panl_RapportPeriodeliste() { global $Ø_MdrList, $Ø_KvtList;
  htm_Panl_Top($name= 'rappformper',$capt= '@Rapport - Moms Periodelister:',$parms='../_base/page_Blindgyden.php',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  FinaRappTop('Indberetning til SKAT');
  htm_FrstFelt('40%');  htm_DataFelt('@CVR:','########',''); 
  htm_NextFelt('30%');  htm_Caption('@Liste valg:'); 
  htm_NextFelt('30%');  htm_CombList($name='perio',$valu='perio',$labl='@Periode',
                                     $titl='@Her vælges hvilken periode, rapporten skal omfatte', $liste= array_merge($Ø_KvtList,$Ø_MdrList));
  htm_LastFelt();
  htm_hr();
  htm_Caption('Her arbejdes...');
  htm_nl(3);
  
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}
######### :FINANS:
function Panl_RapportBudget() {
  htm_Panl_Top($name= 'rappformbud',$capt= '@Rapport - Budget:',$parms='../_base/page_Blindgyden.php',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  FinaRappTop('BUDGET');
  htm_hr();
  htm_Caption('Her arbejdes...');
  htm_nl(3);
  
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}

######### :FINANS:
function Panl_RapportResultatBudget() {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'rappformres',$capt= '@Rapport - Resultat/budget:',$parms='../_base/page_Blindgyden.php',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  FinaRappTop('RESULTAT/BUDGET');
  htm_hr();
  htm_Table(
    $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
      ),
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Konto',    '10%','show','col2', ['center'],'@Konto nummer i kontoplanen',''],
        ['@Angår',    '48%','show','',     ['left'  ],'@Konto benævnelse',''],
        ['@Perioden', '15%','show','2d',   ['right' ],'@Bogførte beløb i perioden','0.00'],
        ['@Budget',   '15%','show','2d',   ['right' ],'@Beløb fra budget','0.00'],
        ['@Afvigelse','12%','show','2%',   ['right' ],'@Afvigelse fra budget beløb','%'],
      ),
    $RowSuff= array(
      ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
    //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $TablData= array( # DemoData:
        ['::RESULTATOPGØRELSE',' ',' ',' ',' '],
        ['::OMSÆTNING:',' ',' ',' ',' '],
        ['1000','Udført arbejde','-12350','0','-'],
        ['1100','Varesalg DK','-1250','0','-'],
        ['1200','Salg af ydelser indenfor EU','0','666','-100'],
        ['1220','Salg af varer indenfor EU','0','66','-100'],
        ['1250','Salg af ydelser udenfor EU','0','55','-100'],
        [':=Salg af varer og ydelser udenfor EU',' ','0','55','-100'],
        [':=OMSÆTNING I ALT',' ',' ',' ',' '],
        ['::VARIABLE OMKOSTNINGER:',' ',' ',' ',' '],
        ['::VAREFORBRUG:',' ',' ',' ',' '],
        ['2100','Varekøb i DK','1.107,02','0.00',''],
        [':=VAREFORBRUG I ALT','1.107,02','0.00','',''],
        ['::FREMMED ARBEJDE',' ',' ',' ',' '],
        ['::VAREFORBRUG OG FREMMEDE ARBEJDE','1.107,02','0.00','--%',''],
        [':=DÆKNINGSBIDRAG I','-12.492,98','787.00','-1.687,42%',''],
        ['::LØNNINGER:',' ',' ',' ',' '],
        [':=DÆKNINGSBIDRAG II','-12.492,98','787.00','-1.687,42%',''],
        ['::Øvrige omkostninger:',' ',' ',' ',' '],
        ['::Øvrige personaleomkostninger:',' ',' ',' ',' '],
        ['::LOKALEOMKOSTNINGER:',' ',' ',' ',' '],
        ['::SALGSOMKOSTNINGER:',' ',' ',' ',' '],
        ['::REPRÆSENTATION:',' ',' ',' ',' '],
        ['::ADMINISTRATION:',' ',' ',' ',' '],
        ['7600','Telefoni','255.2','0',' '],
        ['7900','Diverse ekskl. moms','75','0',' '],
        [':=ADMINISTRATION I ALT','330.2','0',' ',' '],
        ['::KØRSEL:','','','',' '],
        ['8400','Brændstof','586.23','0',' '],
        [':=KØRSEL I ALT','586.23','0',' ',' '],
        [':=Øvrige omkosninger i alt:','916.43','0',' ',' '],
        [':=RESULTAT FØR AFSKRIVNINGER','','-11576.55','787','-1570.97'],
        ['::AFSKRIVNINGER:',' ',' ',' ',' '],
        [':=RESULTAT FØR FINANSIERING','','-11576.55','787','-1570.97'],
        ['::RENTEINDTÆGTER M.V.:',' ',' ',' ',' '],
        ['::RENTEUDGIFTER M.V.:',' ',' ',' ',' '],
        [':=RESULTAT I ALT','','-11576.55','787','-1570.97'],
     ),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,       # Mulighed for at oprette en record
    $ModifyRec=false,       # Mulighed for at ændre data i en row
    $ViewHeight= '400px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__,
    $Kriterie= ['RAPPORT']
  );
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}

######### :FINANS:
function Panl_RapportResultat() {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'rappformxxx',$capt= '@Rapport - Resultat:',$parms='../_base/page_Blindgyden.php',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  FinaRappTop('RESULTAT');
  htm_hr();
  htm_Table(
    $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
      ),
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Konto',      '10%','show','col2', ['center'],'@Konto nummer i kontoplanen',''],
        ['@Angår',      '48%','show','',     ['left'  ],'@Konto benævnelse',''],
        ['@I perioden', '15%','show','2d',   ['right' ],'@Bogførte beløb i perioden','0.00'],
        ['@År til dato','15%','show','2d',   ['right' ],'@Beløb bogført siden regnskabsårets start','0.00'],
      ),
    $RowSuff= array(
      ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
    //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $TablData= array( # DemoData:
        ['::RESULTATOPGØRELSE',' ',' ',' '],
        ['::OMSÆTNING:',' ',' ',' '],
        ['1000','Udført arbejde','-12350','-12350'],
        ['1100','Varesalg DK','-1250','-1250'],
        [':=OMSÆTNING I ALT',' ','-13600','-13600'],
        ['::VARIABLE OMKOSTNINGER:',' ',' ',' '],
        ['::VAREFORBRUG:',' ',' ',' '],
        ['2100','Varekøb i DK','1107.02','1107.02'],
        [':=VAREFORBRUG I ALT','','1107.02','1107.02'],
        ['::FREMMED ARBEJDE',' ',' ',' '],
        ['::VAREFORBRUG OG FREMMEDE ARBEJDE','','1107.02','1107.02'],
        [':=DÆKNINGSBIDRAG I','','-12492.98','-12492.98'],
        ['::LØNNINGER:',' ',' ',' '],
        [':=DÆKNINGSBIDRAG II','','-12492.98','-12492.98'],
        ['::Øvrige omkostninger:',' ',' ',' '],
        ['::Øvrige personaleomkostninger:',' ',' ',' '],
        ['::LOKALEOMKOSTNINGER:',' ',' ',' '],
        ['::SALGSOMKOSTNINGER:',' ',' ',' '],
        ['::REPRÆSENTATION:',' ',' ',' '],
        ['::ADMINISTRATION:',' ',' ',' '],
        ['7600','Telefoni','','255.2','255.2'],
        ['7900','Diverse ekskl. moms','75','75'],
        [':=ADMINISTRATION I ALT','330.2','0',' ',' '],
        ['::KØRSEL:','','','',' '],
        ['8400','Brændstof','586.23','586.23'],
        [':=KØRSEL I ALT','','586.23','586.23'],
        [':=Øvrige omkosninger i alt:','','916.43','916.43'],
        [':=RESULTAT FØR AFSKRIVNINGER','','-11576.55','-11576.55'],
        ['::AFSKRIVNINGER:',' ',' ',' '],
        [':=RESULTAT FØR FINANSIERING','','-11576.55','-11576.55'],
        ['::RENTEINDTÆGTER M.V.:',' ',' ',' '],
        ['::RENTEUDGIFTER M.V.:',' ',' ',' '],
        [':=RESULTAT I ALT','','-11576.55','-11576.55'],
     ),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,       # Mulighed for at oprette en record
    $ModifyRec=false,       # Mulighed for at ændre data i en row
    $ViewHeight= '400px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__,
    $Kriterie= ['RAPPORT']
  );
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}


######### :FINANS:
# Kaldes fra:  [_finans/page_Regnskab.php] [_system/page_Regnskabsaar.php] [_system/page_Regnskabskort.php] 
function Panl_Regnskab($regnskab='', $maanedantal=12, $startaar=2018, $startmaaned=1, $periode_dag=1,   ## out_PanlsPrim.php
                       $periode_laengde="regnskabsmaaned", $regnskabsaar='2018', &$TablData) {
  htm_Panl_Top($name= 'kontoform',$capt= tolk('@Regnskab:').' '.$regnskab, $parms='../_base/page_Hovedmenu.php',$icon='fas fa-database','panelW120',__FUNCTION__);
  $MdTitles= periodeoverskrifter($maanedantal=12, $startaar=2018, $startmaaned=1, $periode_dag=1, $periode_laengde="regnskabsmaaned", $regnskabsaar='2018','2d','5%');
  //function periodeoverskrifter($periodeantal, $periode_aar, $periode_md, $periode_dag=1, $periode_laengde="regnskabsmaaned", $regnskabsaar="",$outFormat='2d',$colw='4%') {

  $RowBody= array();  #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'],
  array_push($RowBody, 
        //['@Id.',           '0%','hidd','',['center'],'@Index','serial...'],
        ['@Konto',     '5%','text', ''  ,['center','white','','lightcyan'], '@Kontonummer. Entydig nummerkode, som benyttes til sortering, summering mv.','@Konto...'],
        ['@Kontonavn','24%','text', ''  ,['left',  '',     '','lightcyan'], '@Kontonavn - beskrivende tekst',''],
        ['@Type',      '0%','hidd', ''  ,['center','',     '','lightcyan'], '@Kontotype: D=Drift, S=Status, Z=Sum, H=Overskrift, R=Resultat, X=Sideskift, L=Lukket','@Type...','hide'],  //  Angår styring af layout i tabelvisning
        ['@Valuta',    '1%','show', ''  ,['center','',     '','lightcyan'], '@Valutakode for kontoens beløb',''],
        ['@Σ-fra:',    '0%','hidd', ''  ,['center','',     '','lightcyan'], '@Summation fra konto til denne',''],
        ['@Primo:',    '5%','text', '0d',['right','#EEEEEE; opacity:0.50','','' ], '@Året primo beløb, Sidste års ultimo','']
        );
  foreach ($MdTitles as $Md) array_push($RowBody, $Md); //  periodeoverskrifter benytter: ['@'.$periode_kort, '4%','text','2d', ['right','','font-style:italic; '], '@'.$periode_lang,'']
  array_push($RowBody, 
        ['@I-alt:',    '5%','text', '0d',['right','#EEEEEE; opacity:0.50','','lightcyan'], '@Aktuelle beløb. (Årets ultimo beløb)','.calc.']);
  htm_Table(
    $TblCapt= array(), #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:Just',          '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[FeltJust_mm]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody,          #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]',  '5:ColTip', '6:placeholder','7:default','8:select'],
    $RowSuff= array(),
    $TablData,
    $FilterOn= false,   #  Mulighed for at skjule records som ikke matcher filter.
    $SorterOn= false,  #  Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,  #  Mulighed for at oprette en record
    $ModifyRec=false,  #  Mulighed for at ændre data i en row
    $ViewHeight= '700px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__,
    $Kriterie=['REGNSKAB','0'] 
  );

### PanelFooter:
  htm_RadioGrp($type='hori',  $name='krvis', $labl='@Beløbsvisning:', $titl='@Vælg visnings nøjagtighed for regnskabs beløb',  
              $optlist= array(['kr2d','@Kroner,ører','@eller',true],['kr','@Hele kroner','@eller'],['tusind','@Kun tusinder','']),$action='');
### KnapPanel:
  htm_CentrOn();
    naviKnap($label='@Til Budget',          $title='@Klik her for komme til budgetlægning',   $link='../_finans/page_Budget.php');
    naviKnap($label='@Retur til hovedmenu', $title='@Luk og gå retur til hovedmenu', $link='../_base/page_Hovedmenu.php');
    textKnap($label='@Vis print layout',    $title='@Skjul header og footer, og vis tabel i fuld højde, så du kan udskrive regnskabet med CTRL-P', $link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Luk og gå retur til hovedmenu');
}

# SubRutine:
#function- getComboA(sel) { var value = sel.value; };

######### :FINANS:
# Kaldes fra:  [_finans/page_Kontrol.php] [_finans/page_Rapport-fin.php] 
function Panl_Kontrolspor(&$Data) {global $Ønovice;  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'sporform',$capt= '@Kontrol sporing',$parms='../_finans/page_Rapport-fin.php',$icon='fas fa-database','panelWmax',__FUNCTION__);
  htm_Table(
    $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Søg og vis:', '20%', 'text', '', 'left', '@Her kan du søge og filtrere bland alt, hvad der er bogført.', '@Blandt alle transaktioner...']
    ),
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Id',          '4%','indx','',['center'],'@Angiv et id-nummer eller angiv to adskilt af kolon (f.eks 345:350)',''],
          ['@Periode',     '9%','show','',['right' ],'@Angiv en dato eller angiv to adskilt af kolon (f.eks 010605:300605)','...'.'åååå-mm-dd:åååå-mm-dd'],
          ['@Log. Periode','9%','show','',['right' ],'@Angiv en dato eller angiv to adskilt af kolon (f.eks 010605:300605)','åååå-mm-dd:åååå-mm-dd'],
          ['@Tidspunkt',   '7%','show','',['center'],'@Angiv et tidspunkt (f.eks 17:35) ','?'],
          ['@Kladde',      '7%','show','',['center'],'@Angiv et kassekladdenummer eller angiv to adskilt af kolon (f.eks 345:350)','?'],
          ['@Bilag',       '7%','show','',['center'],'@Angiv et bilagsnummer eller angiv to adskilt af kolon (f.eks 345:350)','?'],
          ['@Konto.',      '7%','show','',['center'],'@Angiv et kontonummer eller angiv to adskilt af kolon (f.eks 345:350)','?'],
          ['@Fakturanr',   '7%','show','',['center'],'@Angiv et fakturanummer eller angiv to adskilt af kolon (f.eks 345:350)','?'],
          ['@Debet',       '7%','show','',['center'],'@Angiv et beløb eller angiv to adskilt af kolon (f.eks 10000,00:14999,99)','?'],
          ['@Kredit',      '7%','show','',['center'],'@Angiv et beløb eller angiv to adskilt af kolon (f.eks 10000,00:14999,99)','?'],
#   if ($Øvis_projekt): 
          ['@Projekt',     '7%','show','',['center'],'@Angiv et projektnummer eller angiv to adskilt af kolon (f.eks 5:7)','?'],
          ['@Søgetekst',  '18%','show','',['left'  ],'@Angiv en søgetekst. Der kan anvendes * før og efter teksten','?']
    ),
    $RowSuff= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
    //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $Data= array(['1','Per...','Log...','Tid...','Kla...','Bilag','Kon..','Fakt...','Debet','Kredit','Proj','Tekst'],
                 ['2','','','','','','','','','','',''], ['3','','','','','','','','','','','']), 
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,      # Mulighed for at oprette en record
    $ModifyRec=true,      # Mulighed for at ændre data i en row
    $ViewHeight= '400px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_CentrOn(); htm_nl();
    textKnap($label='@CSV-eksport', $title='@Klik her for at eksportere valgte transaktioner til CSV-fil for import i andet program, f.eks. regneark.',$link='../_base/page_Blindgyden.php');
    textKnap($label='@Print layout', $title='@Klik her for at vise data, så de kan udskrives med CTRL-P',$link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_PanlBund($pmpt='@Retur til finansrapport',$subm=true,$title='@Gå til vinduet finansrapport');
}

######### :FINANS:
# Kaldes fra: Panl_RapportFinans
function MakeDriftsKonti() {global $Ødb_Link;  ## out_PanlsPrim.php
  $DriftKt= array();
  if ($Ødb_Link) {
       $konti= sql_readB('SELECT kontonr,beskrivelse '.
                         'FROM  tblA_account_plan '.
                         'WHERE kontotype= "D" ',__FILE__, __LINE__);
       foreach ($konti as $rec) { array_push($DriftKt, [$rec[1],$rec[0],$rec[0].':'.$rec[1]]);}
    }
  else { $filDATA= ImportTabFile('../_exchange/kontoplan.tab');
         foreach ($filDATA as $rec) {if ($rec[2]=='D') array_push($DriftKt, [$rec[1],$rec[0],$rec[0].':'.$rec[1]]);}
       }
  return $DriftKt;
}

######### :FINANS:
# Kaldes fra:  [_finans/page_Provisionsrapport.php] [_system/page_Provision.php] 
function Panl_Provision()   ## out_PanlsSekd.php
{global $Ø_DagList;
  htm_Panl_Top($name= 'provisi',$capt= '@Provision:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
  htm_Caption('@Provisionsberegning:');
  htm_RadioGrp($type='hori',  $name='provgrlg',   $labl='@Grundlag',  
              $titl='@Vælg om provison beregnes på fakturerede eller betalte ordrer', 
              $optlist= array(['faktureret','@Faktureret','@eller','@Provision beregnes på fakturerede ordrer'],
                              ['betalt',    '@Betalt',    '',      '@Provision beregnes på betalte ordrer'])
                              ,$action='');
  str_hr();  htm_Caption('@Kilde for personinfo:');
  htm_RadioGrp($type='hori',  $name='provtil',    $labl='@Kilde',     
              $titl='@Provision tilfalder den, der er angivet som referenceperson på de enkelte ordrer', 
              $optlist= array(['ref',   '@Ref',    '@eller','@Provision beregnes på fakturerede ordrer'],
                              ['kua',   '@Kundens','@eller','@Provision tilfalder den kundeansvarlige'],
                              ['smart', '@Begge',  '',      '@Provision tilfalder den kundeansvarlige såfremt der er tildelt en sådan, ellers til den som er referenceperson på de enkelte ordrer'])
                              ,$action='');
  str_hr();  htm_Caption('@Kilde for kostpris:');
  htm_RadioGrp($type='hori',  $name='provgrund',  $labl='@Grundlag',  
              $titl='@Vælg om provison beregnes på fakturerede eller betalte ordrer', 
              $optlist= array(['faktureret','@Indkøbspris','@eller','@Anvend varens reelle indkøbspris som kostpris.'],
                              ['betalt',    '@Varekort',    '',     '@Anvend kostpris fra varekort.'])
                              ,$action='');
  str_hr();   htm_Caption('@Skæringsdato for provisionsberegning:');
  htm_OptioFlt($type='text',  $name='brgndato',   $valu= $brgndato,   $labl='@Dato',  
                    $titl='@Dato hvorfra og med (i foregående måned) til (dato i indeværende måned) provisionsberegning foretages',  
                    $revi=true, $optlist= $Ø_DagList,
                    $action='onchange="getComboA(this)"',
                    '','','',$nl=2);
  htm_PanlBund($pmpt='@Gem',$subm=true);
}
 

######### :FINANS:
# Kaldes fra:  [_finans/page_Provisionsrapport.php] 
function Panl_Provisionsrapport(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'provform',$capt= '@Provisionsrapport:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-database','panelWmax',__FUNCTION__);
  
  msg_Dialog('warn',ucfirst(tolk('@Retur')),'JavaScript:window.history.back();','','','','',ucfirst(tolk('@Her mangler der noget')),
            ucfirst(tolk('@Provisionsrapport kan ikke testes, før der er DB-adgang.')));
  
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Luk og gå retur til hovedmenu');
}

######### :FINANS: ######### Slut funktioner angående visninger i menu-gruppen FINANS


######### :DEBITOR: ######### Start funktioner angående visninger i menu-gruppen DEBITOR

######### :DEBITOR:
# Kaldes fra:  [_debitor/page_DebitorOrdre.php] 
function Panl_Kunden(&$kontonr, &$kategori, &$cvrnr, &$eannr, &$bankreg, &$bankkto, &$instit, &$ansv, &$formsprog, &$homeweb) {  ## out_PanlsPrim.php
  htm_Panl_Top($name='kundform',$capt='@Kunden (debitor):',$parms='page_Blindgyden.php',$icon='fas fa-user',$klasse='panelWmax',__FUNCTION__,'','legeplads:lege-side#kunden');
  htm_CombFelt($type='text',  $name='DBix',   $valu= $kontonr,  $labl='@Kundenr.',          
                          $titl='@Kundenr: Kan ikke rettes. Systemet styrer dette', $revi=false);
  htm_RadioGrp($type='hori',  $name='Ktyp',                     $labl='@Kundetype',         
              $titl='@Kunde kategori',          
              $optlist= array(['privat','@Privat','@eller'],['erhverv','@Erhverv','']),$action='');
  $Erhv= 'placeholder="...'.tolk('@kun erhverv').'..."';  // Rerurnering af værdi i &$kategori ?
  htm_CombFelt($type='text',  $name='cvrnr',  $valu= $cvrnr,    $labl='@CVR',               
              $titl=tolk('@CVR - Virksomheds ID.').'<br>'.
              tolk('@Kan benyttes i CVR-opslag, til at importere Erhvervsstyrelsens offentlige data'), $revi=true);
  htm_CombFelt($type='text',  $name='EAN',    $valu= $eannr,    $labl='@EAN',               
              $titl='@EAN - Elektronisk-betalings ID',  $revi=true,'','','',$Erhv);
  htm_FrstFelt('30%');                                          
    htm_CombFelt($type='text',$name='bankreg',$valu= $bankreg,  $labl='@Bank reg.',         
              $titl='@Bank reg.',             $revi=true);  
  htm_NextFelt('70%');                                          
    htm_CombFelt($type='text',$name='bankkto',$valu= $bankkto,  $labl='@Bank konto',        
              $titl='@Bank konto',            $revi=true);  
  htm_lastFelt();                                               
  htm_CombFelt($type='text',  $name='inst',   $valu= $instit,   $labl='@Institution',       
              $titl='@Supplerende oplysning', $revi=true,'','','',$Erhv);
  htm_CombFelt($type='text',  $name='ansv',   $valu= $ansv,     $labl='@Kundeansvarlig',    
              $titl='@Kundeansvarlig',        $revi=true);
  htm_CombFelt($type='text',  $name='sprog',  $valu= $formsprog,$labl='@Faktureringssprog', 
              $titl='@Sproget som skal benyttes på faktura udskrifter',   
          $revi=true,'','','','placeholder="...'.tolk('@hvis sproget ikke er dansk').'..."');
  htm_CombFelt($type='text',  $name='homeweb',$valu= $homeweb,  $labl='@Hjemmeside',        
              $titl='@Kundens hjemmeside',      $revi=true,'','','',$Erhv);
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

function Panl_CVRopslag($hvem='')  {
  $Erhv= 'placeholder="...'.tolk('@kun erhverv').'..."';
  htm_Panl_Top($name='cvrform',$capt='@CVR opslag:',$parms='#',$icon='fas fa-search',$klasse='panelWmax',__FUNCTION__,'');
  htm_Caption('@Opslag i CVR-registret (kun erhverv)');
  htm_Plaintxt('@Hent eller kontroller med data i det offentlige virksomhedsregister');
  htm_Plaintxt('@Data leveres af CVR API');
  htm_nl(2);
  set_FormVars(['cvrLand','cvrKode','cvrSoeg'/* ,'cvrNumm','cvrNavn','cvrTelf','cvrAddr','cvrPost','cvrBy','cvrDiv' */]);  // Opdater alle variabler på form 'cvrform' :
  //  get_FormVars(['cvrLand','cvrKode','cvrSoeg']);
  dev_show(); //  echo 'SESSIONS variablers indhold: ';  vis_data($_SESSION);
  $cvrLand= $_SESSION['cvrLand'];   if (!$cvrLand) $cvrLand= 'dk';
  $cvrKode= $_SESSION['cvrKode'];   if (!$cvrKode) $cvrKode= 'search';
  $cvrSoeg= $_SESSION['cvrSoeg'];
  if (($cvrLand) and ($cvrKode) and ($cvrSoeg)) //  Klar til søgning
    { $url= 'https://cvrapi.dk/api?'.$cvrKode.'='.$cvrSoeg.'&country='.$cvrLand;   //  https://cvrapi.dk/api?search=$cvrSoeg&country=dk  Generel søgning    //  https://cvrapi.dk/api?phone=$cvrSoeg&country=dk   specifikt telefonnr
      $content = file_get_contents($url, false, stream_context_create(['http' => ['user_agent' => 'any']]));
      // FIXIT: Forebyg: "Failed to open streem" ved:  "404 Not Found"
      $svar= json_decode($content, true);       //  $svar= json_decode('{"vat":20756438,"name":"Saldi.dk ApS","address":"Gefionsvej 13, 1","zipcode":"3400","city":"Hiller\u00f8d","cityname":null,"protected":false,"phone":"46902208","email":"phr@danosoft.dk","fax":null,"startdate":"29\/12 - 1997","enddate":null,"employees":"2-4","addressco":null,"industrycode":620100,"industrydesc":"Computerprogrammering","companycode":80,"companydesc":"Anpartsselskab","creditstartdate":null,"creditbankrupt":false,"creditstatus":null,"owners":[{"name":"Peter Holten Rude"}],"productionunits":[{"pno":1018843737,"main":false,"name":"saldi.dk ApS","address":"Kirseb\u00e6rg\u00e5rden 2-4, 1. V.","zipcode":"3450","city":"Aller\u00f8d","cityname":null,"protected":false,"phone":"46902208","email":"phr@saldi.dk","fax":null,"startdate":"23\/10 - 2013","enddate":"23\/02 - 2016","employees":null,"addressco":null,"industrycode":620100,"industrydesc":"Computerprogrammering"},{"pno":1008561504,"main":true,"name":"Saldi.dk ApS","address":"Gefionsvej 13, 1","zipcode":"3400","city":"Hiller\u00f8d","cityname":null,"protected":false,"phone":"46902208","email":"phr@danosoft.dk","fax":null,"startdate":"06\/07 - 2001","enddate":null,"employees":null,"addressco":null,"industrycode":620100,"industrydesc":"Computerprogrammering"}],"t":100,"version":6}', true);
                                                //  var_dump($svar);
      if ($svar['vat']) { $cvrDiv= '';
        $cvrNumm= $svar['vat'];    
        $cvrNavn= $svar['name'];   
        $cvrAddr= $svar['address'];
        $cvrPost= $svar['zipcode'];
        $cvrBy  = $svar['city'];   
        $cvrTelf= $svar['phone'];  
        if ($svar['email'])                                   {$cvrDiv.= tolk('@Mail').': '. $svar['email'].'&#xa;';}
        if ($svar['fax'])                                     {$cvrDiv.= tolk('@Fax ').': '. $svar['fax'].'&#xa;';}
        if ($svar['cityname'])                                {$cvrDiv.= tolk('@Sted').': '. $svar['cityname'].'&#xa;';}
        if ($svar['companydesc'])                             {$cvrDiv.= tolk('@Type').': '. $svar['companydesc'].'&#xa;';}
        $ix= 0; while ($svar['owners'][$ix]['name'])          {$cvrDiv.= tolk('@Ejer').': '. $svar['owners'][$ix]['name'].'&#xa;'; $ix++;}
        $ix= 0; while ($svar['productionunits'][$ix]['pno'])  {$cvrDiv.= tolk('@P-nr').': '. $svar['productionunits'][$ix]['pno'].'&#xa;'; $ix++;}
      } 
    }
  htm_FrstFelt('22%');  htm_OptioFlt($type='text',  $name='cvrLand',  $valu= $cvrLand,  $labl='@Land',   
                        $titl='@I hvilket land vil du søge?', $revi=true, $optlist= CVR_Land(),    $action='',
                        $events='', $maxwd='100px', $onForm='cvrform');
  htm_NextFelt('22%');  htm_OptioFlt($type='text',  $name='cvrKode',  $valu= $cvrKode,  $labl='@Søg efter',   
                        $titl='@Hvad kender du?',   $revi=true, $optlist= CVR_Liste(),    $action='', //  Søgekoder: vat, name, produ, phone, search (generelt: vat/name/produ)
                        $events='', $maxwd='100px', $onForm='cvrform');
  htm_NextFelt('56%');  htm_CombFelt($type='text',  $name='cvrSoeg',  $valu= $cvrSoeg,  $labl='@CVR / P-enh. / Telf / Navn', 
                        $titl='@Indtast her, data eller firma navn, som du vil søge efter',  $revi=true,'','','',$Erhv);
  htm_LastFelt();
  htm_AcceptKnap('@Søg','@Start søgning  i CVR-registret', $type='save', $form='cvrform', $width='', $akey='');
    
  htm_hr();
  htm_FrstFelt('30%');  htm_CombFelt($type='text',  $name='cvrNumm',  $valu= $cvrNumm,  $labl='@CVR-nummer',  
                        $titl='@Hentet i CVR-registret',  $revi=true, $rows='',$width='45','','','CVR...');
  htm_NextFelt('70%');  htm_CombFelt($type='text',  $name='cvrNavn',  $valu= $cvrNavn,  $labl='@Firmanavn',  
                        $titl='@Hentet i CVR-registret',  $revi=true, $rows='',$width='45','','','Navn...');
  htm_LastFelt();
  htm_FrstFelt('30%');  htm_CombFelt($type='text',  $name='cvrTelf',  $valu= $cvrTelf,  $labl='@Telefon',     
                        $titl='@Hentet i CVR-registret',  $revi=true, $rows='',$width='45','','','Telf...');
  htm_NextFelt('70%');  htm_CombFelt($type='text',  $name='cvrAddr',  $valu= $cvrAddr,  $labl='@Adresse',     
                        $titl='@Hentet i CVR-registret',  $revi=true, $rows='',$width='45','','','Addr...');
  htm_LastFelt();
  htm_FrstFelt('30%');  htm_CombFelt($type='text',  $name='cvrPost',  $valu= $cvrPost,  $labl='@Postnr.',     
                        $titl='@Hentet i CVR-registret',  $revi=true, $rows='',$width='45','','','Post...');
  htm_NextFelt('70%');  htm_CombFelt($type='text',  $name='cvrBy',    $valu= $cvrBy,    $labl='@Bynavn',          
                        $titl='@Hentet i CVR-registret',  $revi=true, $rows='',$width='45','','','By...');
  htm_LastFelt();
  htm_AcceptKnap('@Benyt',tolk('@Benyt de viste data i din registrering af ').$hvem.'. <br>'.
            tolk('@Advarsel: Evt. tidligere data overskrives! (Felter uden indhold, påvirker ikke ekst. data)'.'<br>Virker ikke endnu'), 
                  $type='create', $form='cvrform', $width='', $akey='');
  htm_CombFelt($type='area',  $name='cvrDiv',   $valu= $cvrDiv,   $labl='@Andet',       
                        $titl='@Hentet i CVR-registret, diverse supplerende data',  $revi=true, $rows='5',$width='45','','','Diverse...');
                        //  Andre felter med data, angivet med label, f.eks. "Sted: Ved kæret, Ejer: Anders Hansen"
  htm_nl(3);
  //  GET / POST: http://cvrapi.dk/api
  //  Source: https://github.com/KristianI/cvrapi
  //  'vat' 'name'  'produ'  'phone'
/*
$ wget https://cvrapi.dk/api?search=saldi.dk&country=dk
{
    "vat": 20756438,                           :  $cvrNumm
    "name": "Saldi.dk ApS",                    :  $cvrNavn
    "address": "Gefionsvej 13, 1",             :  $cvrAddr
    "zipcode": 3400,                           :  $cvrPost
    "city": "Hillerød",                        :  $cvrBy
    "cityname": null,                          :  Sted: $cvrDiv
    "protected": false,                        :  
    "phone": 46902208,                         :  $cvrTelf
    "email": "phr@danosoft.dk",                :  Mail: $cvrDiv
    "fax": null,                               :  Fax: $cvrDiv
    "startdate": "29/12 - 1997",               :  
    "enddate": null,                           :  
    "employees": "2-4",                        :  
    "addressco": null,                         :  
    "industrycode": 620100,                    :  
    "industrydesc": "Computerprogrammering",   :    
    "companycode": 80,                         :  
    "companydesc": "Anpartsselskab",           :  Type: $cvrDiv
    "creditstartdate": null,                   :  
    "creditbankrupt": false,                   :  
    "creditstatus": null,                      :  
    "owners": [                                :  
        {                                      :  
            "name": "Peter Holten Rude"        :  Ejer: $cvrDiv
        }
    ],
    "productionunits": [
        {
            "pno": 1018843737,                        : P-nr: $cvrDiv
            "main": false,                            : 
            "name": "saldi.dk ApS",                   : 
            "address": "Kirsebærgården 2-4, 1. V.",   : 
            "zipcode": 3450,                          : 
            "city": "Allerød",                        : 
            "cityname": null,                         : 
            "protected": false,                       : 
            "phone": 46902208,                        : 
            "email": "phr@saldi.dk",                  : 
            "fax": null,                              : 
            "startdate": "23/10 - 2013",              : 
            "enddate": "23/02 - 2016",                : 
            "employees": null,                        : 
            "addressco": null,                        : 
            "industrycode": 620100,                   : 
            "industrydesc": "Computerprogrammering"   : 
        },                                            : 
        {                                             : 
            "pno": 1008561504,                        : P-nr: $cvrDiv
            "main": true,                             : 
            "name": "Saldi.dk ApS",                   : 
            "address": "Gefionsvej 13, 1",            : 
            "zipcode": 3400,                          : 
            "city": "Hillerød",                       : 
            "cityname": null,                         : 
            "protected": false,                       : 
            "phone": 46902208,                        : 
            "email": "phr@danosoft.dk",               : 
            "fax": null,                              : 
            "startdate": "06/07 - 2001",              : 
            "enddate": null,                          : 
            "employees": null,                        : 
            "addressco": null,                        : 
            "industrycode": 620100,                   : 
            "industrydesc": "Computerprogrammering"   : 
        }
    ],
    "t": 100,
    "version": 6
}
*/
  
    htm_PanlBund($pmpt='',$subm=false,$title='');
}

######### :DEBITOR:
# Kaldes fra:  [_debitor/page_DebitorOrdre.php] 
function Panl_Betingelser(&$debigrup, &$betaling, &$frist, &$print2, &$kunderef    /* ,&$betalingsbet,&$fristdage */ ) {  ## out_PanlsPrim.php
  #if ($betalingsbet=='@Kontant'||$betalingsbet=='@Efterkrav'||$betalingsbet=='@Forud'||$betalingsbet=='@Kreditkort') $fristdage='';  else $fristdage=0;
  htm_Panl_Top($name='betaform',$capt= '@Betingelser:',$parms='page_Blindgyden.php',$icon='far fa-credit-card',$klasse='panelWmax',__FUNCTION__,'','legeplads:lege-side#handelsbetingelser'); # ' <text color: "gray">&#x00A7;</text>  '.
  htm_OptioFlt($type='text',  $name='debigrup',   $valu= $debigrup, 
                    $labl='@Debitorgruppe',     
                    $titl='@Vælg hvilken gruppe kunden tilhører', 
                    $revi=true, $optlist= array(
                    ['','@1. Danske debitorer',     '@1. Danske debitorer'],
                    ['','@2. Europæiske debitorer', '@2. Europæiske debitorer']),$action='','','150px','',$nl=1);
  htm_OptioFlt($type='text',  $name='betaling',   $valu= $betaling,   
                    $labl='@Betalings metode',  
                    $titl='@Hvordan skal der betales',  
                    $revi=true, $optlist= array(
                    ['@Kontant',    'Kontant',    '@Kontant'],
                    ['@Efterkrav',  'Efterkrav',  '@Efterkrav'],
                    ['@Forud',      'Forud',      '@Forud'],
                    ['@Kreditkort', 'Kreditkort', '@Kreditkort'],
                    ['@Konto',      'Konto',      '@Konto']),$action='');
  htm_OptioFlt($type='text',  $name='frist',      $valu= $frist,      
                    $labl='@Betalings frist',   
                    $titl='@Hvor lang frist er der til betaling', 
                    $revi=true, $optlist= array(
                    ['','0' ,'@Straks'],
                    ['','8' ,'@8 dage'],
                    ['','14','@14 dage'],
                    ['','30','@30 dage']),$action='');
  htm_OptioFlt($type='text',  $name='print2',   $valu= $print2,
                    $labl='@Udskriv til',       
                    $titl='@Vælg på hvilken måde skal dokumentet udskrives, gemmes eller sendes.',  
                    $revi=true, $optlist= array(
                    ['@Fil i pdf-format','pdf','@PDF-fil'],
                    ['@Elektronisk forsendelse','email','@email'],
                    ['@Elektronisk fakturering','ioubl','@OIOUBL'],
                    ['@PBS faktura','pbs','@PBS']),$action='');
  htm_CombFelt($type='text',  $name='kunderef',   $valu= $kunderef, $labl='@Kundens referance', $titl='@f.eks. Rekvisitions NR',  $revi=true);
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :DEBITOR:
# Kaldes fra: [_debitor/page_DebitorOrdre.php] 
function Panl_Kontakter() {  ## out_PanlsPrim.php
  htm_Panl_Top($name='betaform',$capt='   '.tolk('@Person kontakt:'),$parms='page_Blindgyden.php',$icon='fas fa-phone-square',$klasse='panelWmax',__FUNCTION__,'','legeplads:lege-side#kontakt');
  Kontakt($posi=1, $kontakt='Anders', $titel, $telf, $mobil, $mail);
  Kontakt($posi=2, $kontakt='Andersine', $titel, $telf, $mobil, $mail);
  htm_accept('@Opret Ny','@Opret en ny kontakt');
  htm_PanlBund($pmpt='@Gem rettelser',$subm=true,$title='@Gem evt. rettelser ovenfor');
} //  Panl_Betingelser

######### :DEBITOR:
# Kaldes fra: Panl_Kontakter
function Kontakt($posi, $kontakt, $titel, $telf, $mobil, $mail, $bemr='') {  ## out_PanlsPrim.php
  htm_FrstFelt('10%');  
    htm_CombFelt($type='number', $name='posi',  $valu= $posi,   $labl='@Pos.',  $titl='@Position styrer rækkefølgen af posterne', $revi=true, $rows='', $width='45', $step='0.5');
  htm_NextFelt('40%');  
    htm_CombFelt($type='text',  $name='kontakt',$valu= $kontakt,$labl='@Kontakt person',  $titl='@Angiv Kontakt person',      $revi=true, $rows='',$width='45','','','Kont...');
  htm_NextFelt('40%');  
    htm_CombFelt($type='text',  $name='titel',  $valu= $titel,  $labl='@Titel',       $titl='@Angiv personens titel',         $revi=true, $rows='',$width='45','','','Titl...');
  htm_LastFelt('40%');
  htm_FrstFelt('50%');  
    htm_CombFelt($type='text',  $name='telf',   $valu= $telf,   $labl='@Telefon',     $titl='@Angiv Telefon',                 $revi=true, $rows='',$width='45','','','Tlf...');
  htm_NextFelt('50%');                                          
    htm_CombFelt($type='text',  $name='mobil',  $valu= $mobil,  $labl='@Mobil',       $titl='@Angiv Mobilnr. eller lokalnr',  $revi=true, $rows='',$width='45','','','Mobil/lok...');  
  htm_LastFelt('10%');                                          
  htm_CombFelt(  $type='mail',  $name='mail',   $valu= $mail,   $labl='@E-mail',      $titl='@Angiv E-mail',                  $revi=true, $rows='','','','','Mail...');
  htm_CombFelt(  $type='area',  $name='bemr',   $valu= $bemr,   $labl='@Bemærkning',  $titl='@Angiv bemærkning til kontakten, f.eks. rolle',  $revi=true, $rows='','','','','Note...');
  htm_nl();
  htm_accept('@Slet','@Fjern denne kontakt person');
  echo '<hr color="green">';
}

######### :DEBITOR:
# Kaldes fra:  [_debitor/page_DebitorOrdre.php] 
function Panl_Fakturering(&$navn, &$addr, &$sted, &$ponr, &$by, &$land, &$noter, &$telf, &$att, &$email, &$usemail, &$faktdato) {  ## out_PanlsPrim.php
  global $ØPanlForm;
  htm_Panl_Top($name='faktform',$capt='@Kunde - Fakturering:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelWmax',__FUNCTION__,'','legeplads:lege-side#fakturerings_oplysninger');
  htm_CombFelt($type='text',    $name='navn', $valu= $navn,   $labl='@Kunde navn',            $titl='@Angiv Kunde Navn',            $revi=true);
  htm_CombFelt($type='text',    $name='addr', $valu= $addr,   $labl='@Faktura adresse',       $titl='@Angiv Faktura Adresse',       $revi=true);
  htm_CombFelt($type='text',    $name='sted', $valu= $sted,   $labl='@Faktura Sted',          $titl='@Angiv Faktura Kunde Sted',    $revi=true);
  htm_FrstFelt('25%');                                              
    htm_CombFelt($type='text',  $name='ponr', $valu= $ponr,   $labl='@Postnr',                $titl='@Angiv Faktura Kunde postnr',  $revi=true);
  htm_NextFelt('75%');                                              
    htm_CombFelt($type='text',  $name='by',   $valu= $by,     $labl='@Faktura By',            $titl='@Angiv Faktura Kunde Bynavn',  $revi=true);
  htm_lastFelt();                                                   
  htm_CombFelt($type='text',    $name='land', $valu= $land,   $labl='@Faktura Land',          $titl='@Angiv Faktura Kunde Land',    $revi=true);
  htm_CombFelt($type='area',    $name='noter',$valu= $noter,  $labl='@Bemærkninger',          $titl='@Angiv Bemærkninger',          $revi=true, $rows='1');
  htm_CombFelt($type='text',    $name='telf', $valu= $telf,   $labl='@Telefon(er)',           $titl='@Angiv Kunde Telefon',         $revi=true);
  htm_CombFelt($type='text',    $name='att',  $valu= $att,    $labl='@Attention',             $titl='@Angiv Kunde Attention',       $revi=true);
  htm_CombFelt($type='mail',    $name='email',$valu= $email,  $labl='@Kundens Email adresse', $titl='@Angiv Kunde Email adresse',   $revi=true);
  htm_FrstFelt('50%');  
    htm_CheckFlt($type='checkbox',$name='useMail', $valu= $usemail, $labl='@Benyt mail',      $titl='@Send faktura med mail', $revi=true);
  htm_NextFelt('50%');  
    htm_CombFelt($type='date',  $name='faktdato',  $valu= $faktdato, $labl='@Faktura Dato',   $titl='@Fakturerings dato',     $revi=true);
  htm_LastFelt();
  //htm_hr();
  htm_Caption('Udskrivning kan først ske, når ordren er oprettet!');
  //htm_CentrOn();
  //textKnap($label='@Gem og udskriv faktura', $title='@Gem, bogfør og udskriv faktura til den under {Betingelser}, valgte udskriver!',$link='page_Blindgyden.php',$akey='p');
  //htm_CentOff();
  // $ØPanlForm=true;
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='');
}

######### :DEBITOR:
# PROGRAM-MODUL; Sammensatte Paneler! = "Vindue". Skal ændre til page_... eller wall_...
# Kaldes fra:  [_debitor/page_Opretordre.php] 
function wall_Opretordre($kundeRec=[],$vareRec=[],$leverRec=[]) {  ## out_PanlsPrim.php
  global $ØPanlForm;
  htm_Panl_Top($name='ordrform',$capt='@Opret ordre:',$parms='page_Blindgyden.php',
               $icon='fas fa-plus','panelW110',__FUNCTION__,'','legeplads:lege-side#find_din_kunde_i_debitorlisten');
  $ØPanlForm=false;   // Undlad form i paneler herefter:
  wall_DebitorKort(true);
  htm_nl();
  htm_Caption('@Husk at oprette ordre, med den gule knap nederst, når data er tilføjet/ændret !');
  htm_nl(2);
#?  htm_Rammestart($Caption='',$bor='0px');
#?    Panl_YdelserWide($Ordnr=':',$data=array(1,2,3),$fakt=false);
#?  htm_Rammeslut();
  htm_nl();
  Panl_YdelserTabl($Ordrnr='1025',$TablData,$fakt=false,'@Stadig redigerbar');
  $ØPanlForm=true;  //  Herefter submit af fælles form
  htm_PanlBund($pmpt='@Opret ordre',$subm=true,$title='@Gem ordren, med de ovenfor angivne data.');
}

######### :DEBITOR:
# Kaldes fra:  [_debitor/page_DebitorOrdre.php] 
function Panl_Ordreinfo(&$valuta, &$vorref, &$afdel, &$ordrdato, &$genfdato, &$godkendt, &$optlist) {  ## out_PanlsPrim.php
  htm_Panl_Top($name='ordrform',$capt='@Ordreinfo:',$parms='page_Blindgyden.php',$icon='fas fa-euro-sign','panelWmax',__FUNCTION__);
  htm_OptioFlt($type='text',    $name='valuta',   $valu= $valuta,   $labl='@Valuta',        $titl='@Valuta som ordren skal benytte',  $revi=true,
               $optlist= array(['','DKK','DKK'],['','AED','AED'],['','EUR','EUR'],['','USD','USD']),  $action='');
  htm_CombFelt($type='text',    $name='vorref',   $valu= $vorref,   $labl='@Vor referance', $titl='@Sælgers referance',               $revi=true);
  htm_CombFelt($type='text',    $name='afdel',    $valu= $afdel,    $labl='@Afdeling',      $titl='@Sælgers afdeling',                $revi=true);
  htm_FrstFelt('50%');                                              
    htm_CombFelt($type='date',  $name='ordrdato', $valu= $ordrdato, $labl='@Ordre Dato',    $titl='@Datoen hvor ordren indgik',       $revi=true);
  htm_NextFelt('50%');  
    htm_CombFelt($type='date',  $name='genfdato', $valu= $genfdato, $labl='@Genfakturerings Dato',$titl='@Husk fremtidigt fakturerings tidspunkt',  $revi=true);
  htm_LastFelt();
  htm_CheckFlt($type='checkbox',$name='godkendt',$valu= $godkendt,  $labl='@Godkendt',      $titl='@Ordren er godkendt hvis feltet er afmærket',$revi=true);
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='@Gem data i dette panel.');
}

######### :DEBITOR:
# Kaldes fra:  [_debitor/page_DebitorOrdre.php] 
function Panl_Levering( &$somfakt, &$navn, &$addr, &$sted, &$ponr, &$by, &$land, &$telf, &$kont, &$email, &$forsend, &$noter, &$afsendt, &$levdato) {  ## out_PanlsPrim.php
  //if ($onPanel) 
  htm_Panl_Top($name='leveform',$capt='@Levering:',$parms='page_Blindgyden.php',
        $icon='fas fa-truck','panelW320',__FUNCTION__,'','legeplads:lege-side#leverings_oplysninger');
  htm_CheckFlt($type='checkbox',$name='somfakt',    $valu= $somfakt,  $labl='@Leveres til faktura-adresse', 
        $titl='@Afmærk her, hvis leverings adresse er den samme som faktura adresse',  $revi=true);
  htm_CombFelt($type='text',    $name='levnavn',    $valu= $navn,     $labl='@Modtager navn',               
        $titl='@Angiv Modtager Navn',               $revi=true, '','','','',$plho='Navn..');
  htm_CombFelt($type='text',    $name='levaddr1',   $valu= $addr,     $labl='@Leverings adresse',           
        $titl='@Angiv Leverings Adresse',           $revi=true, '','','','',$plho='Addr..');
  htm_CombFelt($type='text',    $name='sted',       $valu= $sted,     $labl='@Leverings Sted',              
        $titl='@Angiv Leverings Sted, suplement til adresse', $revi=true);
  htm_FrstFelt('25%');                                                                                                  
    htm_CombFelt($type='text',  $name='levpostnr',  $valu= $ponr,     $labl='@Postnr',                      
        $titl='@Angiv Leverings Kunde postnr',      $revi=true, '','','','',$plho='Pnr..');
  htm_NextFelt('75%');                                                                                              
    htm_CombFelt($type='text',  $name='levby',      $valu= $by,       $labl='@Leverings by',                
        $titl='@Angiv Leveringsstedets Bynavn',     $revi=true, '','','','',$plho='By..');
  htm_lastFelt();                                                                                                   
  htm_CombFelt($type='text',    $name='land',       $valu= $land,     $labl='@Leverings Land',              
        $titl='@Angiv Leverings Land',              $revi=true);
  htm_CombFelt($type='text',    $name='levtelf',    $valu= $telf,     $labl='@Telefon(er)',                 
        $titl='@Angiv Modtagers Telefon',           $revi=true, '','','','',$plho='Telf..');
  htm_CombFelt($type='text',    $name='levkont',    $valu= $kont,     $labl='@Kontaktperson',               
        $titl='@Angiv Kontaktpersons Navn',         $revi=true);
  htm_CombFelt($type='mail',    $name='levemail',   $valu= $email,    $labl='@Modtagerens Email adresse',   
        $titl='@Angiv Modtagers Email adresse',     $revi=true);
  htm_CombFelt($type='text',    $name='forsendelse',$valu= $forsend,  $labl='@Fragtmetode)',                
        $titl='@Angiv Forsendelses oplysninger',    $revi=true);
  htm_CombFelt($type='area',    $name='levnoter',   $valu= $noter,    $labl='@Noter til fragtmand',         
        $titl='@Angiv Noter til fragtmand',         $revi=true, $rows='1','','','',$plho='Noter..');
  htm_FrstFelt('50%');
    htm_CheckFlt($type='checkbox',$name='afsendt',  $valu= $afsendt,  $labl='@Afsendt',                     
        $titl='@Afmærk her når varen/ydelsen er afsendt', $revi=true);
  htm_NextFelt('50%');  
    htm_CombFelt($type='date',$name='levdato',      $valu= $levdato,  $labl='@Leverings Dato',              
        $titl='@evt. forsendelses dato',            $revi=true);
  htm_LastFelt();
  //if ($onPanel) 
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :DEBITOR:
# Kaldes fra:  [_debitor/page_DebitorOrdre.php] 
function Panl_Ekstrafelter(&$felt1, &$felt2, &$felt3, &$felt4, &$felt5, $custFelt= array(  ## out_PanlsPrim.php
// [Label,          Hint,                  Placeholder  ]
  ['@Ordre Felt 1','@Udfyld Ordre Felt 1','@Felt 1...'],
  ['@Ordre Felt 2','@Udfyld Ordre Felt 2','@Felt 2...'],
  ['@Ordre Felt 3','@Udfyld Ordre Felt 3','@Felt 3...'],
  ['@Ordre Felt 4','@Udfyld Ordre Felt 4','@Felt 4...'],
  ['@Ordre Felt 5','@Udfyld Ordre Felt 5','@Felt 5...'])
) {
  htm_Panl_Top($name='feltform',$capt='@Ekstrafelter:',$parms='page_Blindgyden.php',
        $icon='fas fa-plus','panelWmax',__FUNCTION__,'','legeplads:lege-side#ekstrafelter');
  htm_CombFelt($type='text',$name='felt1',  $valu= $felt1,  $labl= tolk($custFelt[0][0]),  
        $titl= tolk($custFelt[0][1]), $revi=true,'','','','',  $plho= tolk($custFelt[0][2]));
  htm_CombFelt($type='text',$name='felt2',  $valu= $felt2,  $labl= tolk($custFelt[1][0]),  
        $titl= tolk($custFelt[1][1]), $revi=true,'','','','',  $plho= tolk($custFelt[1][2]));
  htm_CombFelt($type='text',$name='felt3',  $valu= $felt3,  $labl= tolk($custFelt[2][0]),  
        $titl= tolk($custFelt[2][1]), $revi=true,'','','','',  $plho= tolk($custFelt[2][2]));
  htm_CombFelt($type='text',$name='felt4',  $valu= $felt4,  $labl= tolk($custFelt[3][0]),  
        $titl= tolk($custFelt[3][1]), $revi=true,'','','','',  $plho= tolk($custFelt[3][2]));
  htm_CombFelt($type='text',$name='felt5',  $valu= $felt5,  $labl= tolk($custFelt[4][0]),  
        $titl= tolk($custFelt[4][1]), $revi=true,'','','','',  $plho= tolk($custFelt[4][2]));
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :DEBITOR:
# Kaldes fra:  [_debitor/page_DebitorOrdre.php] & wall_DebitorKort & Panl_DebtOpretRykker 
function Panl_Mailfaktura(&$emne, &$text, &$vedhft, &$copyto, &$bccopy) {  ## out_PanlsPrim.php
  htm_Panl_Top($name='mailform',$capt='@Mail faktura:',$parms='page_Blindgyden.php',
        $icon='fas fa-envelope','panelWmax',__FUNCTION__,'','legeplads:lege-side#yderligere_oplysninger');
  htm_CombFelt($type='text',$name='emne',   $valu= $emne,   $labl='@Mail emne',   
        $titl='@Angiv Mail emne',     $revi=true,'','','','',         $plho='Vedr...');
  htm_CombFelt($type='area',$name='text',   $valu= $text,   $labl='@Mail tekst',  
        $titl='@Angiv Mail tekst',    $revi=true, $rows='2','','','', $plho='Besked...');
  htm_nl();
  htm_CombFelt($type='text',$name='vedhft', $valu= $vedhft, $labl='@Mail bilag',  
        $titl='@Angiv Vedhæftet fil', $revi=true,'','','','',         $plho='Bilag...');
  htm_CombFelt($type='text',$name='copyto', $valu= $copyto, $labl='@Kopi til',    
        $titl='@Angiv mail-adresse, som skal modtage en kopi af afsendt mail',  $revi=true,'','','','', $plho='Copy...');
  htm_CombFelt($type='text',$name='bccopy', $valu= $bccopy, $labl='@Blind-kopi til',    
        $titl='@Angiv mail-adresse, som skal modtage en BC-kopi (skjult) af afsendt mail',  $revi=true,'','','','', $plho='BCopy...');
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :DEBITOR:
# Kaldes fra:  [_debitor/page_DebitorOrdre.php] [_debitor/page_Opretordre.php] [_debitor/page_Ordreliste.php] 
function Panl_Ydelser($Ordnr='1250',$fakt) {  ## out_PanlsPrim.php
  htm_Panl_Top($name='yderform',$capt=tolk('@Leverancer:').' '.$Ordnr.' <small>(Smal-format)</small>',
        $parms='page_Blindgyden.php',$icon='fas fa-shopping-cart','panelW320',__FUNCTION__);
  Varelinie($posi=1,$varenr="45-876",$antal=1,$enhed="stk",$beskriv="Redekasser",
        $momssats=25,$pris=235.50,$rabat=20, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);
  Varelinie($posi=2,$varenr="45-876",$antal=2,$enhed="stk",$beskriv="Redekasser",
        $momssats=25,$pris=235.50,$rabat=20, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);
  Varelinie($posi=3,$varenr="45-877",$antal=3,$enhed="stk",$beskriv="Redekasser",
        $momssats=25,$pris=245.00,$rabat=20, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);
  Varelinie($posi=4,$varenr="45-876",$antal=3,$enhed="stk",$beskriv="Redekasser",
        $momssats=25,$pris=235.50,$rabat=20, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);
  htm_Caption('@Status: ');
  htm_CheckFlt($type='checkbox', $name='fakt', $valu= $fakt, $labl='@Er Faktureret og låst',
               $titl='@Når ordren er faktureret, afmærkes feltet automatisk',$revi=false,$more='',$nl='');
  textKnap($label='@Opret Ny',  $title='@Opret ny varepostering', $link='../_base/page_Blindgyden.php');
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :DEBITOR:
# Kaldes fra:  [_debitor/page_DebitorOrdre.php] 
function Panl_YdelserWide($Ordnr='',$fakt) {  ## out_PanlsPrim.php
  SpalteBund();
  NextSpalte(640);
  htm_Panl_Top($name='linkform',$capt=tolk('@Ordrens omfang').' '.$Ordnr.' ',$parms='page_Blindgyden.php',
               $icon='fas fa-shopping-cart','panelW640',__FUNCTION__,'',  
               $more='','legeplads:lege-side#leverancer_pa_ordren'); //[ style= "height:350px" ]
    VarelinieWide($posi=1, $varenr='45-876', $antal=3, $enhed='stk', $beskriv='Redekasser', $momssats=25, 
        $pris=235.50, $rabat=8, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);     
    VarelinieWide($posi=2, $varenr='45-876', $antal=2, $enhed='stk', $beskriv='Redekasser', $momssats=25, 
        $pris=235.50, $rabat=8, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);     
    VarelinieWide($posi=3, $varenr='45-876', $antal=3, $enhed='stk', $beskriv='Redekasser', $momssats=25, 
        $pris=235.50, $rabat=12, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);
    #,"45-876","3","stk","Redekasser","25","235,50","8",(3*235.5)*92/100*125/100
  htm_Caption('@Status: ');
  htm_CheckFlt($type='checkbox', $name='fakt', $valu= $fakt, $labl='@Er Faktureret og låst',$titl='@Når ordren er faktureret, afmærkes feltet automatisk',$revi=false,$more='',$nl='');
  htm_nl();
  htm_Plaintxt(tolk('@TIP angående Beløbsrabat:').'&nbsp;');  
  htm_Plaintxt('@Angiv en mindre enhedspris, og 0% rabat, så beregnes en %-rabat svarende til pris-rabatten.');
  htm_hr();
  textKnap($label='@Tilføj Ny varepost',  $title='@Opret ny varepostering', $link='../_base/page_Blindgyden.php');
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :DEBITOR:
# Kaldes fra:  [_debitor/page_Opretordre.php] [_debitor/page_Ordreliste.php] 
function Panl_YdelserTabl($Ordrnr,$data,$fakt,$TopLine) {  ## out_PanlsPrim.php
  htm_Panl_Top($name='linkform',$capt=tolk('@Ordren').' '.$Ordrnr.' '.tolk('@angår:'),$parms='page_Blindgyden.php',
               $icon='fas fa-shopping-cart','panelW100',__FUNCTION__);
  SpalteTop(320); 
  Panl_Betingelser($debigrup, $betaling, $frist, $print2, $kunderef); 
  NextSpalte(320); 
  Panl_Fakturering ($navn='Anders And', $addr='Andedammen 34', $sted='Ved Lunden', $ponr='1234', $by='Eventyrland', $land='Eventyrland', 
                      $noter='Levering på anden adresse!', $telf='045 12345678', $att='Rap', $email='anders@and.dk', $usemail='', $faktdato);
  NextSpalte(320); 
  Panl_Levering($navn= 'Andersine', $addr= 'Redekasse 12', $sted= 'Ved Lunden', $ponr= '1234', $by= 'Fuglebjerg', $land= 'Eventyrland', 
                            $telf= '045 87654321', $email= 'andersine@and.dk', $forsend= 'Fragt: DSV', $noter= 'Afleveres ved bredden!', $afsendt= '', $levdato='',$xx='',$xx='');
  SpalteBund();
  htm_Caption($TopLine);
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
      ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Pos.',         '5%','indx', '',  ['center'],'@Pos. nr tildeles automatisk','...pos...'],
        ['@Varenr',       '8%','text', '',  ['center'],'@Varenummer for ydelsen','Varenr...'],
        ['@Antal',        '3%','text', '',  ['center'],'@Mængden angivet som antal ','@Antal...'],
        ['@Enhed',        '6%','text', '',  ['left'  ],'@Enheds betegnelse ','@Enh...'],
        ['@Beskrivelse', '30%','text', '',  ['left'  ],'@Beskrivelse af varen/ydelsen ','@Besk...'],
        ['@Moms%',        '5%','text', '',  ['center'],'@Moms pct.sats ','@Moms...'],
        ['@À pris',       '8%','text', '2d',['center'],'@Enhedspris ','@Pris...'],
        ['@Rabat%',       '8%','text', '1d',['right' ],'@Rabat procent','@Rabat...'],
        ['@Ialt',         '8%','text', '2d',['right' ],'@Kalkuleret beløb for den aktuelle postering. ',''],
        ['@Valuta',       '4%','text', '',  ['center'],'@Valutakode for den valuta, som er benyttet på specifikationen.','DKK'],
//      ['@Forfald',      '9%','hidd', '',  ['center'],'@Beløbets forfalds dato','forf.dato'],
      ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ['@Fortryd',      '3%','text', '',  ['center'],
                      tolk('@Fortryd postering! Tilbagefør beløbet ved at klikke på ikonen.').' '.
                      tolk('@Er ordren faktureret, kan posten tilbageføres, indtil ordren er bogført. Derefter skal det ske ved at kreditere kunden!'),
                      '<a href='.$link.'><ic class="fas fa-undo" style="font-size:14px; color:red;" title="'.
                      tolk('@Tilbagefør denne postering, f.eks. fortryd rykkergebyr').'"></ic></a>'],
        ['@Flyt',         '2%','text', '',  ['center'], '@Flyt denne post op eller ned.',
                      '<a href='.$link.'><ic class="fas fa-arrows-alt-v" style="font-size:14px; color:green;" title="'.
                      tolk('@Virker ikke endnu').'"></ic></a>']
            ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON, ]
    // $DATA,#=   array(),
    $data= array( //  DEMO:
      [1, '45-876', $antal=3, 'stk', 'Redekasser', $momssats=25, $pris=235.50, $rabat=8,  $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100, 'DKK'],
      [2, '45-876', $antal=2, 'stk', 'Redekasser', $momssats=25, $pris=235.50, $rabat=8,  $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100, 'DKK'],
      [3, '45-876', $antal=3, 'stk', 'Redekasser', $momssats=25, $pris=235.50, $rabat=12, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100, 'DKK'],
      [4, '45-876', $antal=3, 'stk', 'Redekasser', $momssats=25, $pris=235.50, $rabat=8,  $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100, 'DKK']
    ),
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '250px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  foreach ($data as $dat) $total= $total+$dat[8];   $moms= $total/100*25;   $netto= number_format((float)($total-$moms),2,',','.'); 
  htm_FrstFelt('00%');  
  htm_NextFelt('02%; text-align:right ');  htm_Caption('@Status: ');
  htm_NextFelt('15%');  htm_nl(); htm_CheckFlt($type='checkbox', $name='fakt', $valu= $fakt, $labl='@Er Faktureret og låst', $titl='@Når ordren er faktureret, afmærkes feltet automatisk',$revi=false);
  htm_NextFelt('05%');  //  Dækningsbidrag: 3.400,00 	Dækningsgrad: 100,00 htm_DataFelt($label,$data,$algn='left')
  htm_NextFelt('35%');  htm_DataFelt('@Dækningsbidrag: ',$netto); htm_sp(2); htm_DataFelt('@Dækningsgrad: ','100%');
  htm_NextFelt('08%; text-align:right ');  htm_Caption('@Aktuel total: ');
  htm_NextFelt('08%');  htm_CombFelt($type='tal2dc', $name='total', $valu= $total, $labl='@Total',   $titl='@Beregnet sum af alle posteringers ialt beløb', $revi=false);
  htm_NextFelt('05%');
  htm_NextFelt('07%; text-align:right ');  htm_Caption('@Deri moms: ');
  htm_NextFelt('10%');  htm_CombFelt($type='tal2dc', $name='moms', $valu= $moms, $labl='@Moms',   $titl='@Beregnet sum af alle posteringers moms beløb', $revi=false);
  htm_NextFelt('02%');
  htm_LastFelt();
  htm_Plaintxt(tolk('@TIP angående Beløbsrabat:').'&nbsp;');  
  htm_Plaintxt('@Angiv en mindre enhedspris, og 0% rabat, så beregnes en %-rabat svarende til pris-rabatten.');
  htm_KnapGrup('@Dine muligheder:',true,true);
    textKnap($label='@Kopier',  $title='@Kopiér til ny ordre-forslag, med samme indhold.', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Udskriv', $title='@Åbn et PDF-dokument med faktura, som kan gemmes eller viderebehandles på anden vis.', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Følgeseddel', $title='@Åbn et PDF-dokument med følgeseddel, som kan gemmes eller viderebehandles på anden vis.', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Kreditér',  
              $title= tolk('@Klik her for at oprette en kreditnota, som helt eller delvist krediterer denne faktura.').'<br>'.
                      tolk('@Kreditnotaen oprettes som en kreditnotaordre, som kan redigeres inden bogføring.').'<br>'.
                      tolk('@Eksempelvis hvis kun en enkelt faktureret vare skal krediteres.'), $link='../_base/page_Blindgyden.php');
  htm_KnapGrup('@Dine muligheder:',false);
  
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :DEBITOR:
# Kaldes fra: Panl_Ydelser
function Varelinie(&$posi, &$varenr, &$antal, &$enhed, &$beskriv, &$momssats, &$pris, &$rabat, &$ialt) {  ## out_PanlsPrim.php
  htm_FrstFelt('20%');  htm_CombFelt($type='text',  $name='posi',     $valu= $posi,     $labl='@Pos.',    $titl='@Position styrer rækkefølgen af posterne', $revi=true, $rows='',$width='45');
  htm_NextFelt('30%');  htm_CombFelt($type='text',  $name='varenr',   $valu= $varenr,   $labl='@Varenr',  $titl='@Angiv varenr',              $revi=true, $rows='',$width='45');
  htm_NextFelt('20%');  htm_CombFelt($type='tal1d', $name='antal',    $valu= $antal,    $labl='@Antal',   $titl='@Angiv Antal',               $revi=true, $rows='',$width='45',$step='0.25');
  htm_NextFelt('30%');  htm_CombFelt($type='text',  $name='enhed',    $valu= $enhed,    $labl='@Enhed',   $titl='@Enhed udfyldes automatisk', $revi=false,$rows='',$width='45');
  htm_LastFelt();
                        htm_CombFelt($type='area',  $name='beskriv',  $valu= $beskriv,  $labl='@Beskrivelse', $titl='@Angiv beskrivelse af ydelsen',  $revi=true, $rows='2');
  htm_FrstFelt('20%');  htm_CombFelt($type='tal2d', $name='momssats', $valu= $momssats, $labl='@Moms%',   $titl='@Momssats for ydelsen',      $revi=true, $rows='', $width='45',$step='0.25');
  htm_NextFelt('25%');  htm_CombFelt($type='tal2d', $name='pris',     $valu= $pris,     $labl='@Pris',    $titl='@Angiv enhedspris',          $revi=true, $rows='', $width='45');
  htm_NextFelt('28%');  htm_CombFelt($type='tal1d', $name='rabat',    $valu= $rabat,    $labl='@Rabat%',  $titl='@Angiv rabatbeløb',          $revi=true, $rows='', $width='45');
  htm_NextFelt('22%');  htm_CombFelt($type='tal2d', $name='ialt',     $valu= $ialt,     $labl='@Ialt',    $titl='@Beregnet felt: ialt',       $revi=false,$rows='', $width='45');
  htm_LastFelt();
  echo '<hr color="green">';
}

######### :DEBITOR:
# Kaldes fra: Panl_YdelserWide
function VarelinieWide( &$posi, &$varenr, &$antal, &$enhed, &$beskriv, &$momssats, &$pris, &$rabat, &$ialt) {  ## out_PanlsPrim.php
  htm_FrstFelt('05%');  htm_CombFelt($type='text',  $name='posi',     $valu= $posi,     $labl='@Pos.',        $titl='@Position styrer rækkefølgen af posterne', $revi=true, $rows='',$width='45',$step='1');
  htm_NextFelt('08%');  htm_CombFelt($type='text',  $name='varenr',   $valu= $varenr,   $labl='@Varenr',      $titl='@Angiv varenr',                $revi=true, $rows='',$width='45');
  htm_NextFelt('05%');  htm_CombFelt($type='tal1d', $name='antal',    $valu= $antal,    $labl='@Antal',       $titl='@Angiv Antal',                 $revi=true, $rows='',$width='45',$step='0.25');
  htm_NextFelt('08%');  htm_CombFelt($type='text',  $name='enhed',    $valu= $enhed,    $labl='@Enhed',       $titl='@Enhed udfyldes automatisk',   $revi=false,$rows='',$width='45');
  htm_NextFelt('35%');  htm_CombFelt($type='area',  $name='beskriv',  $valu= $beskriv,  $labl='@Beskrivelse', $titl='@Angiv beskrivelse af ydelsen',$revi=true, $rows='1');
  htm_NextFelt('07%');  htm_CombFelt($type='tal2d', $name='momssats', $valu= $momssats, $labl='@Moms%',       $titl='@Momssats for ydelsen',        $revi=true, $rows='', $width='45',$step='0.5');
  htm_NextFelt('08%');  htm_CombFelt($type='tal2d', $name='pris',     $valu= $pris,     $labl='@Pris',        $titl='@Angiv enhedspris',            $revi=true, $rows='', $width='45',$step='0.25');
  htm_NextFelt('06%');  htm_CombFelt($type='tal1d', $name='rabat',    $valu= $rabat,    $labl='@Rabat%',      
                                     $titl='@Angiv rabatsats i %, eller angiv 0% og en reduceret enhedspris, hvis der skal ydes en beløbs rabat',   $revi=true, $rows='', $width='45',$step='0.25');
  htm_NextFelt('09%');  htm_CombFelt($type='tal2d', $name='ialt',     $valu= $ialt,     $labl='@Linie ialt',  $titl='@Beregnet felt: ialt',         $revi=false,$rows='', $width='45',$step='0.25');
  htm_LastFelt();
}

######### :DEBITOR:
# Kaldes fra:  [_debitor/page_Debitor.php] 
function wall_DebitorKort($center=false) {   ## out_PanlsPrim.php
//  Sammensatte Paneler! = "Vindue". Skal ændre til page_... ell. wall_...
  if ($center) echo '<span style="width:1000px; margin:auto">';
  htm_Tapet_Top($name='debikort' ,$capt='@Debitorkort', $parms='page_Blindgyden.php', $icon='far fa-file-alt', $klasse='panelW100',__FUNCTION__,'','konti1');
  SpalteTop(320);
    Panl_Kunden($kontonr, $kategori, $cvrnr, $eannr, $bankreg, $bankkto, $instit, $ansv, $formsprog, $homeweb);       
    Panl_CVRopslag('debitor');
    Panl_Betingelser($debigrup, $betaling, $frist, $print2, $kunderef);     
  NextSpalte();
    Panl_Fakturering ($navn='Anders And', $addr='Andedammen 34', $sted='Ved Lunden', $ponr='1234', $by='Eventyrland', $land='Eventyrland', 
                      $noter='Levering på anden adresse!', $telf='045 12345678', $att='Rap', $email='anders@and.dk', $usemail='', $faktdato);   
    Panl_Ekstrafelter($felt1, $felt2, $felt3, $felt4, $felt5, $custFelt= array(
    // [Label,          Hint,                    Placeholder  ]
      ['@Ordre Felt 1','@Ordre - Udfyld Felt 1','@Ord. Felt 1...'],
      ['@Ordre Felt 2','@Ordre - Udfyld Felt 2','@Ord. Felt 2...'],
      ['@Ordre Felt 3','@Ordre - Udfyld Felt 3','@Ord. Felt 3...'],
      ['@Ordre Felt 4','@Ordre - Udfyld Felt 4','@Ord. Felt 4...'],
      ['@Ordre Felt 5','@Ordre - Udfyld Felt 5','@Ord. Felt 5...'])
    );    
  NextSpalte();
    Panl_Kontakter();   
    Panl_Mailfaktura($emne, $text, $vedhft, $copyto, $bccopy);    
  SpalteBund();
  
  echo '<span style= "border: 1px solid gray;">';
  htm_KnapGrup('@Er kunden ikke registreret:',true,false);
    textKnap($label='@Opret ny kunde',  $title='@Opret ny debitor, ved at indtaset oplysninger', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Opret ny erhvervskunde',  $title='@Opret ny erhvervs debitor, med mulighed for at hente oplysninger i CVR-registret', $link='../_base/page_Blindgyden.php');
  htm_KnapGrup('@Er kunden ikke registreret:',false);
  //htm_nl();
  htm_KnapGrup('@Iøvrigt:',true,false);
    textKnap($label='@Historik',      $title='@Se ...', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Kontokort',     $title='@Se ...', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Fakturaliste',  $title='@Se ...', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Jobliste',      $title='@Se ...', $link='../_base/page_Blindgyden.php');
  htm_KnapGrup('@Iøvrigt:',false);
  echo '</span>';
  
  // Historik Kontokort Fakturaliste  Jobliste
  htm_TapetBund();
  if ($center) echo '</span>';
  PanelInitier(2,8);  PanelMax(2);  PanelMax(5);
}
######### :DEBITOR:
# Kaldes fra: [_debitor/page_Debitor.php] 
function Panl_DebtDebitor($TablData=array()) {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'PanelForm',$capt= '@Debitorliste',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-database',
               'panelW110',__FUNCTION__,'','legeplads:lege-side#find_din_kunde_i_debitorlisten');
  htm_Table(
    $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
        ['@Her har du ','15%', 'html', '', 'left', '', '@alle registrerede kunder'],
      ),
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Kontonr',    '6%','indx','',['center'],'@Debitor konto nummer','..auto..'],
        ['@Kunde navn','20%','text','',['left'  ],'@Kunde-/Firma-navn','@Navn...'],
        ['@Adresse',   '14%','text','',['left'  ],'@Postadresse','@Addr...'],
        ['@Sted',      '14%','text','',['left'  ],'@Sted','@Sted...'],
        ['@Postnr',     '6%','text','',['left'  ],'@Postnummer','@Post...'],
        ['@By',        '15%','text','',['left'  ],'@By','@By...'],
        ['@Kontakt',   '10%','text','',['left'  ],'@Kontakt navn','@Kont...'],
     //  '@titel' / rolle   '@Kontakt personens titel eller rolle','@Titl...'
        ['@Telefon',    '8%','text','',['left'  ],'@Telefon nummer','@Telf...'],
        ['@Sælger',     '6%','text','',['left'  ],'@Sælger','@Sælg...']
      ),
    $RowSuff= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
    //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $TablData= array( # DemoData:
        ['1025','Firmanavn','Adresse','Sted','Postnr','By','Kontakt','Telefon','Sælger'],
        ['1026','Firmanavn','Adresse','Sted','Postnr','By','Kontakt','Telefon','Sælger'],
        ['1027','Firmanavn','Adresse','Sted','Postnr','By','Kontakt','Telefon','Sælger'],
        ['1028','Firmanavn','Adresse','Sted','Postnr','By','Kontakt','Telefon','Sælger']
      ),
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '200px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
//  htm_KnapGrup('@Her kan du:',true,false);
//    textKnap($label='@Oprette Ny',    $title='@Opret ny debitor', $link='../_base/page_Blindgyden.php');
//    textKnap($label='@Se Historik', $title='@Historik for',     $link='../_base/page_Blindgyden.php');    
//    textKnap($label='@Visning',     $title='@Bestem hvilke felter der skal vises i listen', $link='../_base/page_Blindgyden.php');
//  htm_KnapGrup('',false);
//  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='');
}

######### :DEBITOR:
# Kaldes fra:  [_debitor/page_Ordreliste.php] [_base\out_vinduer.php]
function Panl_DebtOrdrer(&$TablData) {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'PanelForm',$capt= '@Ordrer: Debitorer - `Salgsordrer`:',$parms= '../_base/page_Hovedmenu.php',$icon= 'fas fa-database','panelWmax',__FUNCTION__);

  htm_Table(
   $TblCapt= array( 
          ['@Viser:',   'Width',    'Type',    'OutFormat', 'horJust',      'Tip',    'placeholder', '@Kundeordrer'] 
      ),
   $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      ),
   $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Ordre nr.',  '6%','indx', '',   ['center'],  '@Ordre nummer','..auto..'],
          ['@Ordre dato', '6%','date', '',   ['left'  ],  '@Ordre dato','YYYY-MM-DD'],
          ['@Lev. dato',  '6%','date', '',   ['left'  ],  '@Leverings dato','YYYY-MM-DD'],
          ['@Konto nr.',  '7%','text', '',   ['center'],  '@Debitor konto nummer','@Kont...'],
          ['@Firma navn','20%','text', '',   ['left'  ],  '@Firma navn','@Firm...'],
          ['@Sælger',     '8%','text', '',   ['left'  ],  '@Sælger','@Sælg...'],
          ['@Ordre sum',  '7%','text', '2d', ['right' ],  '@Ordre sum','@Beløb...'],
          ['@Status',     '6%','osta', '',   ['left'  ],  '@Status','@Status...'] //  ORD_Status()
      ),
   $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
      ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON]
   $TablData, #=   array(      ),
   $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
   $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
   $CreateRec=true,       # Mulighed for at oprette en record
   $ModifyRec=true,       # Mulighed for at ændre data i en row
   $ViewHeight= '150px',  # Højden af den synlige del af tabellens data
     __FUNCTION__
  );


  htm_nl();
  htm_KnapGrup('Handling:',true,false);
    textKnap($label='@Ny ordre',      $title='@Opret ny ordre', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Tilbud',        $title='@Opret Tilbud',   $link='../_base/page_Blindgyden.php');    
    textKnap($label='@Ordrer',        $title='@Ordrer',         $link='../_base/page_Blindgyden.php');
    textKnap($label='@Faktura',       $title='@Faktura',        $link='../_base/page_Blindgyden.php');
    textKnap($label='@Faktura KOPI',  $title='@Udskriv kopi af Faktura',  $link='../_base/page_Blindgyden.php');
    textKnap($label='@PBS',           $title='@PBS',            $link='../_base/page_Blindgyden.php');
    textKnap($label='@Import PBS',    $title='@Import PBS',     $link='../_base/page_Blindgyden.php');
    textKnap($label='@Importer UBL til ordrer', $title='@Importer UBL til ordrer', $link='../_base/page_Blindgyden.php');
  htm_KnapGrup('Handling:',false);
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
}

######### :DEBITOR:
# Kaldes fra:  [_debitor/page_Rapport-deb.php] 
function Panl_DebRapp() {  ## out_PanlsPrim.php
  set_FormVars(['debkonti','debdatefra','debdatetil']);  // Opdater alle variabler på form 'debiform' :
  
  htm_Panl_Top($name= 'debiform',$capt= '@Debitor-rapporter:',$parms= '#',$icon= 'fas fa-chart-line','panelW320',__FUNCTION__);
    htm_FrstFelt('04%');  
    htm_NextFelt('36%');  htm_Prompt('@Vælg kriterier:','right');  //echo '<p align="center";>'.tolk('@Angiv kriterier:').'</p> ';
    htm_NextFelt('02%');  
    htm_NextFelt('58%'); 
    htm_LastFelt();
    htm_FrstFelt('36%');  htm_CombFelt($type='text', $name= 'debkonti', $valu= $_SESSION['debkonti'], $labl= '@Kunde(r)',     
      $titl=tolk('@Angiv et kundenummer eller et interval adskilt af kolon.').'<br>'. //   Listen vil blive sorteret efter kundenummer
            tolk('@Der kan også skrives et kontonavn, f.eks:').'<br>'.
            tolk('@Skrives DANOSOFT aps vises kun bevægelser for DANOSOFT aps').'<br>'.
            tolk('@DANO* vil vise bevægelser for alle kunder, hvor navnet starter med DANO').'<br>'.
            tolk('@*aps vil vise alle, hvor navnet slutter på aps').'<br>'.
            tolk('@*SOFT* viser alle, hvor soft er en del af navnet'), 
      $revi=true);
  htm_NextFelt('32%');    htm_CombFelt($type='date',  $name='debdatefra',  $valu= $_SESSION['debdatefra'],   $labl='@Periode start',  
        $titl='@Dato for rapportens påbegyndelse. (Kontosaldi anvender kun slutdatoen, som pr. dato)', $revi=true);
  htm_NextFelt('32%');    htm_CombFelt($type='date',  $name='debdatetil',  $valu= $_SESSION['debdatetil'],   $labl='@Periode slut',   
        $titl=tolk('@Angiv periode slut Dato, for at se bevægelser indtil danne dato,').'<br>'.
              tolk('@(Kontosaldi: opgjort pr. denne dato)'), $revi=true);
  htm_LastFelt();
  htm_Accept($labl='@Benyt det', $title='@Godkend dine valg, så de benyttes ved rapportdannelse', $width='',$akey='b',$form='debiform');
  htm_KnapGrup('@Vis:',true);
    textKnap($label='@Åbne poster',     $title= '@Rapport for debitor åbne poster (kunders ubetalte fakturaer)',     
                                        $link=  '../_debitor/page_Rapport-deb.php?job=openpost',   $akey='å');
    textKnap($label='@Konto saldo',     $title= '@Viser en liste over saldi på valgt(e) konti pr. den angivne dato',     
                                        $link=  '../_debitor/page_Rapport-deb.php?job=ktsaldo',     $akey='s');    
    textKnap($label='@Konto kort',      $title= '@Rapport for debitor konto kort',      
                                        $link=  '../_debitor/page_Rapport-deb.php?job=ktkort',     $akey='k');
    textKnap($label='@Salgs statistik', $title= '@Rapport for debitor Salgs statistik', 
                                        $link=  '../_debitor/page_Rapport-deb.php?job=slgstat', $akey='s');
    textKnap($label='@Top 100',         $title= '@Rapport for Top 100',                 
                                        $link=  '../_debitor/page_Rapport-deb.php?job=top100',       $akey='1');
    textKnap($label='@Kasse spor',      $title= '@Oversigt over POS transaktioner (kontantsalgs posteringer)', 
                                        $link=  '../_debitor/page_Rapport-deb.php?job=ksspor',       $akey='1');
  htm_KnapGrup('@Vis:',false);
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Luk og gå retur til hovedmenu');
  dev_show();
}
######### :DEBITOR:
function DebiRappTop($rapp='') { //  Data dannes i: Panl_DebRapp
  htm_FrstFelt('40%');  htm_DataFelt('@KRITERIER for rapporten:','');
  htm_NextFelt('40%');  
  htm_NextFelt('20%');  
  htm_LastFelt();
  htm_FrstFelt('40%');  htm_DataFelt('@Kunde(r):',$_SESSION['debkonti']);
  htm_NextFelt('10%');  htm_DataFelt('@Periode:','','right'); 
  htm_NextFelt('25%');  htm_DataFelt('@Fra:',$_SESSION['debdatefra']);
  htm_NextFelt('25%');  htm_DataFelt('@Til:',$_SESSION['debdatetil']);
  htm_LastFelt();
  htm_LastFelt();
  htm_hr();
}

######### :DEBITOR:
function Panl_DebtOpenPost() {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'rappformopen',$capt= '@Åbne poster (ubetalte):',$parms='../_base/page_Blindgyden.php',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  DebiRappTop();
  htm_Table(
    $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
        ['@Her ser du ','15%', 'html', '', 'left', '', '@ubetalte fakturaer'],
      ),
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Løbenr.',    '6%','show','',['center'],'@Løbe nummer','..auto..'],
        ['@PBS',        '8%','show','',['left'  ],'@Reference til PBS','@pbs...'],
        ['@Firmanavn', '28%','show','',['left'  ],'@Firma navn','@Navn...'],
        ['@0-7',        '9%','show','',['right' ],'@Faktura alder 0-7 dage','@0.00'],
        ['@8-29',       '9%','show','',['right' ],'@Faktura alder 8-29 dage','@0.00'],
        ['@30-59',      '9%','show','',['right' ],'@Faktura alder 30-59 dage','@0.00'],
        ['@60-89',      '9%','show','',['right' ],'@Faktura alder 60-89 dage','@0.00'],
        ['@>=90',       '9%','show','',['right' ],'@Faktura alder >=90 dage','@0.00'],
        ['@I alt',     '10%','show','',['right' ],'@Sum','@0.00...']
      ),
    $RowSuff= array(
        ['@Vælg',       '6%','knap','',['center'],'@Marker de poster, som der skal ske handling på',''],
        
      ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
    //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $TablData= array( # DemoData:
        ['1','','Firmanavn','','','','','',''],
        ['2','','Firmanavn','','','','','',''],
        ['3','','Firmanavn','','','','','',''],
        ['4','','Firmanavn','','','','','','']
      ),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '200px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_KnapGrup('@Med de valgte:',true);
    textKnap($label='@Mail kontoudtog', $title='@Klik her for at maile kontoudtog til de modtagere som er afmærket ovenfor',  $link='../_base/page_Blindgyden.php',$akey='m');
    textKnap($label='@Opret rykker',    $title='@Klik her for at oprette rykker til dem, som er afmærket ovenfor',            $link='../_debitor/DebtOpretRykker.php',$akey='o');    
    textKnap($label='@Ryk alle',        $title=tolk('@Denne funktion gør følgende:').'<ul><li>'.
                                               tolk('@udligner alle konti, hvor saldo er 0.').'</li><li>'.
                                               tolk('@opretter rykkere, hvor betalingsfrist er overskredet med det antal dage, som er valgt under indstillinger -> rykkervalg,').'</li><li>'.
                                               tolk('@bogfører åbne rykkere, hvor betalingsfrist er overskredet, og opretter rykkere på næste niveau for disse').'</li><li>'.
                                               tolk('@Sletter åbne rykkere, som er blevet betalt.').'</li></ul>',      $link='../_base/page_Blindgyden.php',$akey='a');
  htm_KnapGrup('@Med de markerede:',false);
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}

######### :DEBITOR:
function Panl_DebtOpretRykker() {  ## out_PanlsPrim.php
  global $blanket;
  htm_Panl_Top($name= 'oprtrykk',$capt= '@Opret rykker:',$parms='../_base/page_Blindgyden.php',$icon='far fa-file-alt','panelW100',__FUNCTION__);
  SpalteTop(320); 
  Panl_Kunden($kontonr, $kategori, $cvrnr, $eannr, $bankreg, $bankkto, $instit, $ansv, $formsprog, $homeweb);       
  NextSpalte(320); 
  Panl_Fakturering($navn='Anders And', $addr='Andedammen 34', $sted='Ved Lunden', $ponr='1234', $by='Eventyrland', $land='Eventyrland', 
                   $noter='Levering på anden adresse!', $telf='045 12345678', $att='Rap', $email='anders@and.dk', $usemail='', $faktdato);
  NextSpalte(320); 
  Panl_Betingelser($debigrup, $betaling, $frist, $print2, $kunderef); 
  Panl_Mailfaktura($emne, $text, $vedhft, $copyto, $bccopy);
  SpalteBund();
  $liste= [ //  Subset: FRM_Liste()
            ['@6: blanket for 1. rykker', '6', '@6: Rykker 1',''],
            ['@7: blanket for 2. rykker', '7', '@7: Rykker 2',''],
            ['@8: blanket for 3. rykker', '8', '@8: Rykker 3',''],
          ];
  if (isset($_POST['blanketkode'])) $blanket= $_POST['blanketkode'];
  if (!$blanket) $blanket= '6';  //  1. rykker
  htm_OptioFlt($type='text',  $name='blanketkode',  $valu= $blanket,   
                    $labl='@Vælg blanket',  
                    $titl='@Her vælger du udskriftsformularen du vil anvende',  
                    $revi=true, $optlist= $liste, $action='#', $events= 'onchange="this.form.submit();" ', $maxwd='150px');
  htm_nl(2);
  $DATA= sql_readB('SELECT id, form, frm_art, side, besk, just, x0, y0, dx, dy, dim, colr, font, style, imglnk, lngkey, note '.
                   'FROM tblA_forms '.
                   'WHERE form= '.$blanket,__FILE__, __LINE__);  // echo var_dump_arr($DATA);
  $capt= tolk('@Forhåndsvisning af blanket').' '.tolk(ListLookup(FRM_Liste(),$search=$blanket ,$colsearch=1,$colresult=2));
  panl_PrintForm($DATA, $blanket, $pform='A4', $pagewidth=210, $pageheight=297, $vistools=false, $capt);  // DATA: frm_art:"0" side:"G" -> besk:"A4-portrait" -> $pform='A4', $pagewidth=210, $pageheight=297, (PageListe(), PaprListe())
  htm_KnapGrup('@Hvad nu?:',true);
    textKnap($label='@Udskriv',   $title='@Vis rykkeren på en udskriftsvenlig side',  $link='../_base/page_Blindgyden.php',$akey='u');
    textKnap($label='@Send mail', $title='@Klik her for at sende rykkeren som mail, forudsat de nødvendige indstillinger er sat, for den aktuelle kunde',  
             $link='../_base/page_Blindgyden.php',$akey='s');    
  htm_KnapGrup('@Hvad nu?:',false);
  htm_PanlBund($pmpt='@Vis udskrift',$subm=false,'@Vis rykkeren på en udskriftsvenlig side');
}

######### :DEBITOR:
function Panl_DebtKontoliste() {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'rappformklist',$capt= '@Saldo liste:',$parms='../_base/page_Blindgyden.php',$icon='far fa-file-alt','panelW480',__FUNCTION__);
  DebiRappTop();
  htm_Table(
    $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
        ['@Her ser du ','25%', 'html', '', 'left', '', '@tilgodehavender'],
      ),
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@kontonr.',   '5%','show','',['center'],'@Løbe nummer','..auto..'],
        ['@Firmanavn', '80%','show','',['left'  ],'@Firma navn','@Navn...'],
        ['@kontosum',  '10%','show','',['right' ],'@Faktura alder 0-7 dage','@0.00'],
      ),
    $RowSuff= array(
      ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
    //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $TablData= array( # DemoData:
        ['1011','Firmanavn',''],
        ['1012','Firmanavn',''],
        ['1013','Firmanavn',''],
        ['1014','Firmanavn','']
      ),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '130px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_FrstFelt('49%');  
  htm_NextFelt('30%');  htm_Prompt('@Udestående i alt:','right'); 
  htm_NextFelt('20%');  htm_CombFelt($type='tal2d',  $name='ialt',  $valu= $ialt=0,   $labl='',$titl='@Summen af de listede beløb.', $revi=false);
  htm_NextFelt('01%');  
  htm_LastFelt();
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}

######### :DEBITOR:
function Panl_DebtKontoKort() {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'rappformkk',$capt= '@Konto kort:',$parms='../_base/page_Blindgyden.php',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  DebiRappTop();
  $kunde= ['','',''];
  foreach ($kunde as $kun) {
    echo '<span style="background:lightyellow;">';
    $navn= 'T. Petersen';   $konto= '1000';   $gade= 'Hovedgaden 27, 3tv';   $dato= '27-06-2018';   $postnr= '8600';   $by= 'Århus N';   $valuta= 'DKK';   
    htm_FrstFelt('04%');  
    htm_NextFelt('60%');  htm_DataFelt('',$navn); 
    htm_NextFelt('05%');  
    htm_NextFelt('25%');  htm_DataFelt('@Kontonr:',$konto,''); 
    htm_NextFelt('05%');  
    htm_LastFelt();
    htm_FrstFelt('04%');  
    htm_NextFelt('60%');  htm_DataFelt('',$gade); 
    htm_NextFelt('05%');  
    htm_NextFelt('25%');  htm_DataFelt('@Dato:',$dato,''); 
    htm_NextFelt('05%');  
    htm_LastFelt();
    htm_FrstFelt('04%');  
    htm_NextFelt('60%');  htm_DataFelt('',$postnr); htm_DataFelt('&nbsp;&nbsp;',$by); 
    htm_NextFelt('05%');  
    htm_NextFelt('25%');  htm_DataFelt('@Valuta:',$valuta,''); 
    htm_NextFelt('05%');  
    htm_LastFelt();
    echo '</span>';
    htm_Table(
      $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
          //['@Her ser du ','15%', 'html', '', 'left', '', '@ubetalte fakturaer'],
        ),
      $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Dato' ,   '12%','date','',['center'],'@Faktura dato','@dato..'],
          ['@Bilag',    '8%','show','',['center'],'@Bilag nummer','@nr...'],
          ['@Fakt.',    '8%','show','',['center'],'@Faktura nummer','@nr'],
          ['@Tekst',   '25%','show','',['left'  ],'@Tekst','@txt...'],
          ['@Forfald', '12%','date','',['left'  ],'@Forfald','@dato..'],
          ['@Debet',    '9%','show','',['right' ],'@Debet','@0.00'],
          ['@Kredit',   '9%','show','',['right' ],'@Kredit','@0.00'],
          ['@Saldo',   '12%','show','',['right' ],'@Saldo','@0.00'],
          //  
        ),
      $RowSuff= array(
        ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
      //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
      $TablData= array( # DemoData:
          [' ',' ',' ','Primosaldo',' ',' ',' ',''],
          ['2017-06-01','bilag','fakt','','','','',''],
          ['','bilag','fakt','','','','',''],
          ['','bilag','fakt','','','','','']
        ),
      $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
      $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
      $CreateRec=false,       # Mulighed for at oprette en record
      $ModifyRec=false,       # Mulighed for at ændre data i en row
      $ViewHeight= '130px',  # Højden af den synlige del af tabellens data
      $CalledFrom= __FUNCTION__
    );
  htm_hr();
  }
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}

######### :DEBITOR:
function Panl_DebtSalgsstat() {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'rappformsalg',$capt= '@Salgs statistik:',$parms='../_base/page_Blindgyden.php',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  DebiRappTop();
  $kunde= ['',''];
  foreach ($kunde as $kun) {
    htm_FrstFelt('04%');    htm_NextFelt('60%');  htm_DataFelt('@Firmanavn:','T. Petersen'); 
    htm_NextFelt('05%');    htm_NextFelt('25%');  htm_DataFelt('@Kontonr:','1000',''); 
    htm_NextFelt('05%');    htm_LastFelt();
    htm_Table(
      $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
        ),
      $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Varenr.' ,    '10%','show','',  ['center'],'@Varenr.','@nr..'],
          ['@Beskrivelse', '55%','show','',  ['left'  ],'@Beskrivelse','@txt...'],
          ['@Antal.',       '4%','show','0d',['center'],'@Antal','@tal...'],
          ['@Pris',        '12%','show','2d',['right' ],'@Pris','@pris...'],
          ['@Sum',         '16%','show','2d',['right' ],'@Sum','@0.00'],
        ),
      $RowSuff= array(
        ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
      //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
      $TablData= array( # DemoData:
          ['100','Udført arbejde','8','375','3000'],
          ['Matr.','Diverse materialer og afdækning','1','400','400'],
        ),
      $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
      $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
      $CreateRec=false,       # Mulighed for at oprette en record
      $ModifyRec=false,       # Mulighed for at ændre data i en row
      $ViewHeight= '130px',  # Højden af den synlige del af tabellens data
      $CalledFrom= __FUNCTION__
    );
  htm_hr();
  }
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}

######### :DEBITOR:
function Panl_DebtTop100() {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'rappformt100',$capt= '@Top 100:',$parms='../_base/page_Blindgyden.php',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  DebiRappTop();
  htm_Table(
      $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
        ),
      $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Nr.' ,       '10%','show','',  ['center'],'@Placering','@nr..'],
          ['@Kontonr.',   '10%','show','',  ['center'],'@Kontonr','@nr...'],
          ['@Firmanavn',  '60%','show','',  ['left'  ],'@Firmanavn','@navn...'],
          ['@Omsætning',  '16%','show','2d',['right' ],'@Sum','@0.00'],
        ),
      $RowSuff= array(
        ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
      //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
      $TablData= array( # DemoData:
          ['1','4567','dgdgdf','345243'],
          ['2','2667','sajdlk ','325003'],
        ),
      $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
      $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
      $CreateRec=false,       # Mulighed for at oprette en record
      $ModifyRec=false,       # Mulighed for at ændre data i en row
      $ViewHeight= '130px',  # Højden af den synlige del af tabellens data
      $CalledFrom= __FUNCTION__
    );
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}

######### :DEBITOR:
function Panl_DebtKassespor() {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'rappformkssp',$capt= '@Kasse spor:',$parms='../_base/page_Blindgyden.php',$icon='far fa-file-alt','panelW960',__FUNCTION__);
  DebiRappTop();
  htm_Table(
      $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
        ),
      $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Status',   '5%','show','',  ['center'],'@Status','@Ukendt!'],
          ['@Id.',      '4%','show','',  ['center'],'@Identifikations nummer','@nr...'],
          ['@Bon dato', '7%','date','',  ['center'],'@Kasse bons datering','@dato...'],
          ['@Klokken',  '7%','show','',  ['center'],'@Kasse Bon tidspunkt','@00:00:00'],
          ['@Bon nr.',  '7%','show','',  ['center'],'@Kasse Bon nummer','@nr...'],
          ['@Kasse',    '4%','show','',  ['left'  ],'@Kasse nummer','@kasse...'],
          ['@Bord.',    '4%','show','',  ['center'],'@Kunde Bord nummer','@bord...'],
          ['@Ref.',    '10%','show','',  ['left'  ],'@Referance','@ref...'],
          ['@Beløb',    '6%','show','2d',['right' ],'@Opgjort Beløb','@0.00'],
          ['@Betaling', '6%','show','2d',['right' ],'@Betalings middel','@0.00'],
          ['@Modtaget', '6%','show','2d',['right' ],'@Modtaget beløb','@0.00'],
          ['@Retur',    '6%','show','2d',['right' ],'@Byttepenge','@0.00'],
        ),
      $RowSuff= array(
        ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
      //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
      $TablData= array( # DemoData:
          ['','1','','','','','','','','','',''],
          ['','2','','','','','','','','','',''],
          ['','3','','','','','','','','','',''],
        ),
      $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
      $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
      $CreateRec=false,       # Mulighed for at oprette en record
      $ModifyRec=false,       # Mulighed for at ændre data i en row
      $ViewHeight= '130px',  # Højden af den synlige del af tabellens data
      $CalledFrom= __FUNCTION__
    );
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}

######### :DEBITOR:
# Kaldes fra:  [_debitor/page_GruppeInfo.php] 
function Panl_GruppeInfo() {  ## out_PanlsPrim.php
  msg_Dialog('tip',ucfirst(tolk('@Luk')),'JavaScript:window.history.back();','','','','',ucfirst(tolk('@Lidt omtale af grupper.')),ucfirst(
            tolk('@Indeling i grupper er en praktisk metode, til at begrænse antallet af viste debi-/kreditorer (en slags filter), ').
            tolk('@og til at tildele medlemmer af gruppen, relevante fælles parametre.')));
}



######### :DEBITOR: ######### Slut funktioner angående visninger i menu-gruppen DEBITOR


######### :KREDITOR: ######### Start funktioner angående visninger i menu-gruppen KREDITOR

######### :KREDITOR:
# Kaldes fra: Panl_KreditorKort
function Panl_Leverandor(&$kontonr, &$kategori, &$cvrnr, &$eannr, &$bankreg, &$bankkto, &$instit, &$ansv, &$formsprog, &$homeweb) {  ## out_PanlsPrim.php
  htm_Panl_Top($name='kundform',$capt='@Leverandør - Oplysninger:',$parms='page_Blindgyden.php',$icon='fas fa-user',$klasse='panelWmax',__FUNCTION__);
  htm_CombFelt($type='text',  $name='DBix',   $valu= $kontonr,  $labl='@Leverandørnr.',          $titl='@Leverandørnr: Kan ikke rettes. Systemet styrer dette', $revi=false,'','','','','..auto..');  
//  htm_RadioGrp($type='hori',  $name='Ktyp',                     $labl='@Leverandørtype',         $titl='@Leverandør kategori',          
//              $optlist= array(['privat','@Privat','@eller'],['erhverv','@Erhverv','']),$action='');
  $Erhv= 'placeholder="...'.tolk('@kun erhverv').'..."';  // Returnering af værdi i &$kategori ?
  htm_CombFelt($type='text',  $name='CVR',    $valu= $cvrnr,    $labl='@CVR-nr',            
    $titl='@CVR - Virksomheds ID. Kan benyttes i CVR-opslag, til at importere Erhvervsstyrelsens offentlige data',    $revi=true,'','','',$Erhv,'CVR...');
//  htm_CombFelt($type='text',$name='EAN',    $valu= $eannr,    $labl='@EAN',             $titl='@EAN - Elektronisk-betalings ID',    $revi=true,'','','',$Erhv);
  htm_CombFelt($type='text',  $name='bank',   $valu= $bank,     $labl='@Bank',            $titl='@Bank',                    $revi=true,'','','','','Bank...');  
  htm_FrstFelt('30%');                                          
    htm_CombFelt($type='text',$name='bankreg',$valu= $bankreg,  $labl='@Bank reg.',       $titl='@Bank reg.',               $revi=true,'','','','','Reg...');  
  htm_NextFelt('70%');                                          
    htm_CombFelt($type='text',$name='bankkto',$valu= $bankkto,  $labl='@Bank konto',      $titl='@Bank konto',              $revi=true,'','','','','Konto...');  
  htm_lastFelt();                                               
  htm_FrstFelt('33%'); 
  htm_CombFelt($type='text',$name='swift',    $valu= $swift,    $labl='@SWIFT nr.',       $titl='@SWIFT nummer',            $revi=true,'','','','','SWIFT...');  
  htm_NextFelt('33%');
  htm_CombFelt($type='text',$name='kredkto',  $valu= $kredkto,  $labl='@FI kreditor nr.', $titl='@FI kreditor nr.',         $revi=true,'','','','','FI...');  
  htm_NextFelt('33%');
  htm_CombFelt($type='text',$name='kredmax',  $valu= $kredmax,  $labl='@Kredit max.',     $titl='@Maximal kredit',          $revi=true,'','','','','Max...');  
  htm_lastFelt();                                               
  htm_OptioFlt($type='text',  $name='erhkode',  $valu= $erhkode,   
                    $labl='@ERH kode',  
                    $titl='@ERH kode',  
                    $revi=true, $optlist= ERH_Liste(),$action='');
  htm_nl();
  htm_FrstFelt('50%'); 
  htm_CheckFlt($type='checkbox',$name='lukket', $valu= $lukket, $labl='@Lukket',          $titl='@Kontoen er lukket',       $revi=true);
//  htm_CombFelt($type='text',  $name='inst',   $valu= $instit,   $labl='@Institution',       $titl='@Supplerende oplysning',   $revi=true,'','','',$Erhv);
  htm_NextFelt('50%');
  htm_CombFelt($type='text',  $name='ansv',   $valu= $ansv,     $labl='@Leverandøransvarlig', $titl='@Leverandøransvarlig', $revi=true,'','','','','Ansv...');
  htm_lastFelt();                                               
  htm_CombFelt($type='text',  $name='sprog',  $valu= $formsprog,$labl='@Kommunikationssprog', $titl='@Sproget som skal benyttes til kommunikation',   $revi=true,'','','','placeholder="...'.tolk('@hvis sproget ikke er dansk').'..."');
  htm_CombFelt($type='text',  $name='homeweb',$valu= $homeweb,  $labl='@Hjemmeside',        $titl='@Link til leverandørns hjemmeside',      $revi=true,'','','',$Erhv);
  htm_PanlBund($pmpt='@Gem',$subm=true);
}
######### :KREDITOR:
# Kaldes fra:  [_kreditor/page_Kreditor.php] [_kreditor/page_Ordreliste.php] 
function Panl_Kreditorer($TablData=array()) {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'naviform',$capt= '@Konti - Kreditorer:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-database ','panelW110',__FUNCTION__,'','konti1');
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        ['@Kreditorer: ',   '',    'html',    '', '',      '',    '@alle registrerede']
    ),
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Kontonr.',    '6%','indx','',['center'],'@Kreditor konto nummer', '..auto..'],
        ['@Leverandør', '20%','text','',['left'  ],'@Adressat navn',         '@Navn...'],
        ['@Adresse',    '14%','text','',['left'  ],'@Postadresse',           '@Addr...'],
        ['@Sted',       '12%','text','',['left'  ],'@Suplement til adresse', '@Sted...'],
        ['@Post',        '5%','text','',['left'  ],'@Post nr',               '@Post...'],
        ['@By',         '18%','text','',['left'  ],'@Bynavn',                '@By...'],
        ['@Kontakt',    '10%','text','',['left'  ],'@Navn på tilknyttet kontakt person', '@Kont...'],
        ['@Telefon',    '10%','text','',['left'  ],'@Kontakt telefon',       '@Telf...']
    ),
    $RowSuff= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
    //$DATA=    array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $TablData= array( # DemoData:
        ['1025','Navn','Adresse','Sted','Post nr','By','Kontakt person','Telefon'],
        ['1026','Navn','Adresse','Sted','Post nr','By','Kontakt person','Telefon'],
        ['1027','Navn','Adresse','Sted','Pnr',    'By','Kontakt person','Telefon'],
        ['1028','Navn','Adresse','Sted','Post nr','By','Kontakt person','Telefon']
        ),   
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '200px',   # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );

  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Luk og gå retur til hovedmenu');
}

######### :KREDITOR:
//   Sammensatte Paneler! = "Væg med tapet". Skal ændre til page_...
# Kaldes fra:  [_kreditor/page_Kreditor.php] 
function wall_KreditorKort($kontonr, $kategori, $cvrnr, $eannr, $bankreg, $bankkto, $instit, $ansv, $formsprog, $homeweb,  ## out_PanlsPrim.php
    $navn='', $addr='', $sted='', $ponr='', $by='', $land='', $noter='', $telf='', $att='', $email='', $usemail='', $faktdato='',  //  Adresse
       //  Kontakter
    $felt1='', $felt2='', $felt3='', $felt4='', $felt5=''   //  Ekstrafelter
) {//  Parametre mangler for: Kontakter, Ekstrafelter
  htm_Tapet_Top($name='kredform', $capt='@Kreditorkort', $parms='page_Blindgyden.php', $icon='far fa-file-alt', $klasse='panelWmax',__FUNCTION__);
  SpalteTop(320);
    Panl_Leverandor($kontonr, $kategori, $cvrnr, $eannr, $bankreg, $bankkto, $instit, $ansv, $formsprog, $homeweb);           
    Panl_CVRopslag('kreditor');
  NextSpalte();
  Panl_Adresse($navn='Anders And', $addr='Andedammen 34', $sted='Ved Lunden', $ponr='1234', $by='Eventyrland', $land='Eventyrland', 
                      $noter='', $telf='045 12345678', $att='Rap', $email='anders@and.dk', $usemail='', $faktdato);   
  NextSpalte();
    //  Panl_Betingelser($debigrup, $betaling, $frist, $print2, $kunderef);     
    Panl_Kontakter();  #+ Bemærkning 
    //  Panl_Mailfaktura($emne, $text, $vedhft, $copyto, $bccopy);    
    Panl_Ekstrafelter($felt1, $felt2, $felt3, $felt4, $felt5, $custFelt= array(  #+ LeverandørNr. Hjemmeside  Betalingsbetingelser  Kreditorgruppe
// [Label,             Hint,                       Placeholder  ]
  ['@Levering Felt 1','@Levering - Udfyld Felt 1','@Lev. Felt 1...'],
  ['@Levering Felt 2','@Levering - Udfyld Felt 2','@Lev. Felt 2...'],
  ['@Levering Felt 3','@Levering - Udfyld Felt 3','@Lev. Felt 3...'],
  ['@Levering Felt 4','@Levering - Udfyld Felt 4','@Lev. Felt 4...'],
  ['@Levering Felt 5','@Levering - Udfyld Felt 5','@Lev. Felt 5...'])
);    
  
  SpalteBund();
  htm_TapetBund();
  
/*   
Hjemmeside	
Betalingsbetingelse	 +
Kreditorgruppe	
CVR-nr.	
Telefon	
Telefax	
Bank	
Reg.nr	
Konto	
SWIFT nr	
FI kreditor nr.	
Kreditmax	
Lukket
 */
}

######### :KREDITOR:
# Kaldes fra: Panl_KreditorKort
function Panl_Adresse($navn, $addr, $sted, $ponr, $by, $land, $noter, $telf, $att, $email, $usemail, $addrdato, $erhv=true) {  ## out_PanlsPrim.php
  htm_Panl_Top($name='faktform',$capt='@Leverandør - Adresse:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelWmax',__FUNCTION__,'','');
  htm_CombFelt($type='text',    $name='navn', $valu= $navn,   $labl='@Navn',          $titl='@Angiv Kreditor Navn' ,   $revi=true, '', '','','','Navn...');
  htm_CombFelt($type='text',    $name='addr', $valu= $addr,   $labl='@Adresse',       $titl='@Angiv Adresse'       ,   $revi=true, '', '','','','Addr...');
  htm_CombFelt($type='text',    $name='sted', $valu= $sted,   $labl='@Sted',          $titl='@Angiv Kreditor Sted, suplement til adresse',   $revi=true, '', '','','','Sted...');
  htm_FrstFelt('25%');                                              
    htm_CombFelt($type='text',  $name='ponr', $valu= $ponr,   $labl='@Postnr',        $titl='@Angiv Kreditor postnr',   $revi=true, '', '','','','Post...');
  htm_NextFelt('75%');                                              
    htm_CombFelt($type='text',  $name='by',   $valu= $by,     $labl='@By',            $titl='@Angiv Kreditor Bynavn',   $revi=true, '', '','','','By...');
  htm_lastFelt();                                                   
  htm_CombFelt($type='text',    $name='land', $valu= $land,   $labl='@Land',          $titl='@Angiv Kreditor Land',   $revi=true, '', '','','','Land...');
  htm_CombFelt($type='area',    $name='noter',$valu= $noter,  $labl='@Bemærkninger',  $titl='@Angiv Bemærkninger',    $revi=true, $rows='1', '','','','Note...');
  htm_CombFelt($type='text',    $name='telf', $valu= $telf,   $labl='@Telefon(er)',   $titl='@Angiv Telefon'     ,    $revi=true, '', '','','','Telf...');
  htm_CombFelt($type='text',    $name='att',  $valu= $att,    $labl='@Attention',     $titl='@Angiv Attention'    ,   $revi=true, '', '','','','Att...');
  htm_CombFelt($type='mail',    $name='email',$valu= $email,  $labl='@Email adresse', $titl='@Angiv Email adresse',   $revi=true, '', '','','','email...');
  htm_FrstFelt('50%');  
    htm_CheckFlt($type='checkbox',$name='useMail', $valu= $usemail, $labl='@Benyt mail',      $titl='@Send besked med mail', $revi=true);
  htm_NextFelt('50%');  
    htm_CombFelt($type='date',  $name='addrdato',  $valu= $addrdato, $labl='@Adresse Dato',   $titl='@Adresse Dato',     $revi=true);
  htm_LastFelt();
  if ($erhv==true)
       htm_PanlBund($pmpt='@Gem',$subm=true,$title='@Gem data overnfor, såfremt de er redigeret');
  else htm_PanlBund($pmpt='@Fakturér',$subm=true,$title='@Fakturer og udskriv til den under {Betingelser}, valgte udskriver!');
}


######### :KREDITOR:
# Kaldes fra:  [_kreditor/page_Ordreliste.php] 
function Panl_KredOrdrer($TablData=array()) {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'naviform',$capt= '@Ordrer: Kreditorer - `Leverandørordrer`:',$parms='page_Blindgyden.php',$icon='fas fa-database','panelW110',__FUNCTION__);
  htm_Table(
    $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        ['@Registrerede ordrer',   '80px',    'text',    '', 'left',      '@Vælg blandt ordrer, hvilken du vil inspicere/rette',    '@Vælg...']
    ),
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Ordre nr.',  '7%','indx','', ['left'  ], '@Ordre nummer','..auto..'],
        ['@Modt.nr.',   '7%','text','', ['left'  ], '@Modtager nummer','Modt...'],    
        ['@Fakt.nr.',   '7%','text','', ['left'  ], '@Faktura nummer','Fakt...'],
        ['@Ordre dato', '5%','date','', ['left'  ], '@Datoen for ordrens registrering','YYYY-MM-DD'],
        ['@Modt.dato',  '5%','date','', ['left'  ], '@Datoen for ordrens modtagelse','YYYY-MM-DD'],
        ['@Konto nr.',  '7%','text','', ['left'  ], '@Kreditor konto nummer', 'Kont...'],
        ['@Firma navn','27%','text','', ['left'  ], '@Firmaets navn','Navn...'],
        ['@Telefon',    '7%','text','', ['center'], '@Firmaets telefon nummer','Telf...'],
        ['@Leveres til','7%','text','', ['left'  ], '@Leveres til','Lev...'],
        ['@Vor ref.',   '7%','text','', ['left'  ], '@Vores referance','Ref...'],
        ['@Projekt',    '7%','text','', ['left'  ], '@Angiv evt. projekt nummer','Proj...'],
        ['@Faktura sum','7%','text','', ['right' ], '@Netto sum på fakturaen. Moms tillægges først, når der faktureres.','Beløb...']
    ),
    $RowSuff= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
    //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $TablData= array( # DemoData:
        ['1025','Modt.nr.','Fakt.nr.','Ordre dato','Modt.dato','Konto nr.','Firma navn','Telefon','Leveres til','Vor ref.','Projekt','Faktura sum'],
        ['1026','Modt.nr.','Fakt.nr.','Ordre dato','Modt.dato','Konto nr.','Firma navn','Telefon','Leveres til','Vor ref.','Projekt','Faktura sum'],
        ['1027','Modt.nr.','Fakt.nr.','Ordre dato','Modt.dato','Konto nr.','Firma navn','Telefon','Leveres til','Vor ref.','Projekt','Faktura sum'],
        ['1028','Modt.nr.','Fakt.nr.','Ordre dato','Modt.dato','Konto nr.','Firma navn','Telefon','Leveres til','Vor ref.','Projekt','Faktura sum']
        ),
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '150px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_nl();
  Panl_CopyBoard();
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Luk og gå retur til hovedmenu');
}

######### :KREDITOR:
function Panl_CopyBoard() {  ## out_PanlsPrim.php
  //$ocr= "Felter som kan udpeges: \nOrdrenr. 	Modt.nr. 	Fakt.nr.  Ordredato	  Modt.dato	  Fakt.dato	Kontonr.	Firmanavn	  LeveresTil	Vor.ref.	Fakturasum    Projekt";
  htm_Panl_Top($name= '',$capt= '@Faktura-service:',$parms='',$icon='fas fa-pen-square','panelW110',__FUNCTION__);
  
  function td_knap($ix,$labl,$titl) { $str1= tolk('@Her overfører du ').'<br>'.tolk($titl);
    echo '<td>'.'<button type="button" class="tooltip" id="copyBlock['.$ix.']" onClick="copyText()"'.
         'style="padding:1px 5px; width:80px; box-shadow:none; border: none; background-color:transparent;">'.
          Lbl_Tip($labl,$str1).'</button> <span id="copyAnswer"></span>'.'</td>';
  }
  echo '<table style="width:700px; margin:auto;"><tr>';
  echo '<td colspan="12">'.tolk('@Marker en tekst nedenfor, kopier den med CTRL-c. Indsæt kopien i det tilsvarende felt herunder med CTRL-v:').'</td>';
  echo '</tr><tr>';
  td_knap('0', '@Ordrenr.',    '@Ordrenummer.');          
  td_knap('1', '@Modt.nr.',    '@Modtager nummer.');      
  td_knap('2', '@Fakt.nr.',    '@Faktura nummer.');      
  td_knap('3', '@Ordredato',   '@Ordre dato.');          
  td_knap('4', '@Modt.dato',   '@Modtaget dato.');       
  td_knap('5', '@Fakt.dato',   '@Faktura dato.');        
  td_knap('6', '@Kontonr.',    '@Kreditor konto nummer.');         
  td_knap('7', '@Firmanavn',   '@Firma navn.');          
  td_knap('8', '@Leveres til', '@Modtage destination');
  td_knap('9', '@Vores ref.',  '@Vores reference.');      
  td_knap('10','@Fakturasum',  '@Fakturaens total');     
  td_knap('11','@Projekt',     '@Projekt referance');      
  echo '</tr><tr>';   
  $str1=' style="border: 1px solid #8c8b8b; padding:2px;">'.'<input type= "text" name="Felt[]" ';
  $str2='" style="width:75px;" />'.'</td>';
  echo '<td'.$str1.'value="'.htmlentities(stripslashes('')).'" placeholder="'.tolk('@- ? -').$str2;
  echo '<td'.$str1.'value="'.htmlentities(stripslashes('')).'" placeholder="'.tolk('@- ? -').$str2;
  echo '<td'.$str1.'value="'.htmlentities(stripslashes('')).'" placeholder="'.tolk('@- ? -').$str2;
  echo '<td'.$str1.'value="'.htmlentities(stripslashes('')).'" placeholder="'.tolk('@- ? -').$str2;
  echo '<td'.$str1.'value="'.htmlentities(stripslashes('')).'" placeholder="'.tolk('@- ? -').$str2;
  echo '<td'.$str1.'value="'.htmlentities(stripslashes('')).'" placeholder="'.tolk('@- ? -').$str2;
  echo '<td'.$str1.'value="'.htmlentities(stripslashes('')).'" placeholder="'.tolk('@- ? -').$str2;
  echo '<td'.$str1.'value="'.htmlentities(stripslashes('')).'" placeholder="'.tolk('@- ? -').$str2;
  echo '<td'.$str1.'value="'.htmlentities(stripslashes('')).'" placeholder="'.tolk('@- ? -').$str2;
  echo '<td'.$str1.'value="'.htmlentities(stripslashes('')).'" placeholder="'.tolk('@- ? -').$str2;
  echo '<td'.$str1.'value="'.htmlentities(stripslashes('')).'" placeholder="'.tolk('@- ? -').$str2;
  echo '<td'.$str1.'value="'.htmlentities(stripslashes('')).'" placeholder="'.tolk('@- ? -').$str2;
  echo '</tr></table>';
  htm_hr();   
  htm_Accept('@Gem','@Overfør data fra felterne, til tabellen med leverandørordrer',$width='',$akey);
  
  htm_Rammestart($Caption='@Mellemlager for copy/paste.');
  htm_CombFelt($type='area',  $name='ocr', $valu= $ocr,   
               $labl= '@Kopi af fakturaen:',  
               $titl= tolk('@Her paster du en skannet og OCR-behandlet faktura, som er tekst-baseret, hvorpå du copy/paster de enkelte felter over i programmets data-felter. ').
                      tolk('@Det virker ikke med skanning til bitmap-format!'), 
               $revi=true, $rows='18',$width='300px', $step='', $more='',
               $plho=tolk('@@Her paster du en tekst-baseret faktura, hvorpå du copy/paster de enkelte felter over i programmets data-felter.').str_lf(2).
                     tolk('Du kan også kopiere fra et andet vindue, hvor fakturaen vises. f.eks. Adobe PDF-viser eller et browservindue.')               
              );
  htm_nl(12);
  run_Script('function copyText(){ '.
    'var textarea= document.getElementById("ocr");  '.
    'var answer= document.getElementById("copyAnswer");  '.
    'var copy= document.getElementById("copyBlock");'.
    'copy.addEventListener("click", function(e) {'.
    '   textarea.select();'.    // Select some text (you could also create a range)
    '   try { '.                // Use try & catch for unsupported browser
    '       var ok = document.execCommand("copy");'. // The important part (copy selected text)
    '       if (ok)     answer.innerHTML = "'.tolk('@Kopieret.').'!";'.
    '       else        answer.innerHTML = "'.tolk('@kunne ikke kopiere!').'";'.
    '   } catch (err) { answer.innerHTML = "'.tolk('@Browseren understøtter ikke funktionen!').'"; }'.
  '}) };'
  );
  //  document.execCommand('copy')
  // Setup the variables

  htm_nl();
  htm_CentrOn();
  htm_Plaintxt('@Har du en leverandør-faktura, som du skal have inddateret, kan dette virke, som en integreret faktura-service.');  htm_nl();
  htm_Plaintxt('@Det er en forudsætning at fakturaen foreligger i en tekst-baseret form, f.eks. PDF, email, OCR-skannet.');  htm_nl();
  htm_Plaintxt('@Er det en bitmap/billed-fil, kan du konvertere den mange steder på internettet. Søg efter OCR service.');  htm_nl();
  htm_Plaintxt('@Et par eksempeler: https://www.free-ocr.com/ og http://www.i2ocr.com/free-online-danish-ocr.');  htm_nl();
  htm_Plaintxt('@Nyttige tast-genveje: CTRL-a :Marker alt, CTRL-c :Kopier det markerede, CTRL-v :Indsæt det kopierede.');  htm_nl();
  htm_Plaintxt('@Benytter du knapperne, overtager de arbejdet med kopier og indsæt. (Virker ikke endnu!)');
  htm_CentOff();
  htm_nl(2);
  htm_Rammeslut();
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='');
}

######### :KREDITOR:
# Kaldes fra:  [_kreditor/page_Ordreliste.php] 
function wall_LevBestilling() {   ## out_PanlsPrim.php
//  Skal ændre til page_...
  htm_Tapet_Top($name= 'naviform',$capt= '@Bestilling - `Leverandørordre`:',$parms='page_Blindgyden.php',$icon='far fa-file-alt','panelW110',__FUNCTION__);
  
  SpalteTop(240);
  htm_Panl_Top($name= '',$capt= '@Kreditor:',$parms='',$icon='fas fa-pen-square','panelW240',__FUNCTION__);
  htm_CombFelt($type='text',    $name='levnavn',      $valu= $navn,     $labl='@Konto nr.',         $titl='@Angiv kreditors Kontonr.',                $revi=true, '','','','',$plho='Kont..');
  htm_CombFelt($type='text',    $name='levnavn',      $valu= $navn,     $labl='@Firma navn',        $titl='@Angiv Firma Navn',                        $revi=true, '','','','',$plho='Navn..');
  htm_CombFelt($type='text',    $name='levaddr1',     $valu= $addr,     $labl='@Firma adresse',     $titl='@Angiv Firmaets Adresse',                  $revi=true, '','','','',$plho='Addr..');
  htm_CombFelt($type='text',    $name='sted',         $valu= $sted,     $labl='@Sted',              $titl='@Angiv Firma Sted, suplement til adresse', $revi=true, '','','','',$plho='Sted..');
  htm_FrstFelt('25%');                                                                                                  
    htm_CombFelt($type='text',  $name='levpostnr',    $valu= $ponr,     $labl='@Postnr',            $titl='@Angiv Firma Kunde postnr',                $revi=true, '','','','',$plho='Pnr..');
  htm_NextFelt('75%');                                                                                                  
    htm_CombFelt($type='text',  $name='levby',        $valu= $by,       $labl='@By',                $titl='@Angiv Leveringsstedets Bynavn',           $revi=true, '','','','',$plho='By..');
  htm_lastFelt();                                                                                                       
  htm_CombFelt($type='text',    $name='land',         $valu= $land,     $labl='@Firma Land',        $titl='@Angiv Leverandør Land',                   $revi=true, '','','','',$plho='Land..');
  htm_CombFelt($type='text',    $name='levkont',      $valu= $kont,     $labl='@Att.',              $titl='@Angiv Kontaktpersons Navn',               $revi=true, '','','','',$plho='Navn..');
  //htm_CombFelt($type='area',    $name='levnoter',     $valu= $noter,    $labl='@Noter til bestillingen',         $titl='@Angiv Noter',             $revi=true, $rows='1','','','',$plho='Noter..');
  htm_PanlBund($pmpt='@Gem',$subm=false,$title='');
  
  NextSpalte(320);
  htm_Panl_Top($name= '',$capt= '@Detaljer:',$parms='',$icon='fas fa-pen-square','panelW320',__FUNCTION__,'');
  htm_FrstFelt('50%');  htm_CombFelt(                      $type='text',  $name='cvrnr',      $valu= $cvrnr,      $labl='@CVR',         
          $titl='@CVR - Virksomheds ID. Kan benyttes i CVR-opslag, til at importere Erhvervsstyrelsens offentlige data', $revi=true);
  htm_NextFelt('50%');  htm_CombFelt($type='tal2d', $name='momssats', $valu= $momssats, $labl='@Moms %-sats',     $titl='@Momssats for ydelsen',    $revi=true, $rows='', $width='45',$step='0.25');
  htm_LastFelt();
  htm_FrstFelt('50%');  htm_CombFelt($type='date', $name='ordrdate', $valu= $ordrdate,  $labl='@Ordre dato',      $titl='@Angiv dato',          $revi=true, $rows='', $width='',$step='');
  htm_NextFelt('50%');  htm_CombFelt($type='date', $name='levrdate', $levrdate= $pris,  $labl='@Leverings dato',  $titl='@Angiv dato',          $revi=true, $rows='', $width='');
  htm_LastFelt();
  htm_FrstFelt('80%');  htm_OptioFlt($type='text', $name='betaling',  $valu= $betaling,   
                    $labl='@Betalings metode',    $titl='@Hvordan skal der betales',    $revi=true, $optlist= array(
                    ['@Kontant',    'Kontant',    '@Kontant'],
                    ['@Efterkrav',  'Efterkrav',  '@Efterkrav'],
                    ['@Forud',      'Forud',      '@Forud'],
                    ['@Lb. Md.',    'lobmaaned',  '@Lb. Md.'],
                    ['@Konto',      'Konto',      '@Konto'] ),$action=''); 
  
  htm_NextFelt('20%');  htm_CombFelt($type='text',    $name='dage', $valu= $dage, $labl='Frist',   $titl='@Betalings betingelser',      $revi=true, $rows='', $width='',$step='1');
  htm_LastFelt();
  htm_hr();
  htm_KnapGrup('',true,false);
    textKnap($label='@Importer OIOUBL faktura',    $title='@Klik her for at importere en elektronisk faktura af typen oioubl', $link='../_base/page_Blindgyden.php');    
  htm_KnapGrup('',false);
  
  htm_nl();
  htm_CheckFlt($type='checkbox',$name='godk',$valu='godk',  $labl='@Godkend', $titl='@Afmærk her, når bestillingen kan godkendes.',  $revi=true);
  htm_PanlBund($pmpt='@Gem',$subm=false,$title='');
  
  NextSpalte(240);
  htm_Panl_Top($name= '',$capt= '@Levering:',$parms='',$icon='fas fa-truck','panelW240',__FUNCTION__,'');
  htm_CombFelt($type='text',    $name='levnavn',      $valu= $navn,     $labl='@Firma navn',                  $titl='@Angiv Firma Navn',                            $revi=true, '','','','',$plho='Navn..');
  htm_CombFelt($type='text',    $name='levaddr1',     $valu= $addr,     $labl='@Leverings adresse',           $titl='@Angiv Leverings Adresse',                     $revi=true, '','','','',$plho='Addr..');
  htm_CombFelt($type='text',    $name='sted',         $valu= $sted,     $labl='@Sted',                        $titl='@Angiv Leverings Sted, suplement til adresse', $revi=true, '','','','',$plho='Sted..');
  htm_FrstFelt('25%');                                                                                                  
    htm_CombFelt($type='text',  $name='levpostnr',    $valu= $ponr,     $labl='@Postnr',                      $titl='@Angiv Leverings Kunde postnr',                $revi=true, '','','','',$plho='Pnr..');
  htm_NextFelt('75%');                                                                                                  
    htm_CombFelt($type='text',  $name='levby',        $valu= $by,       $labl='@By',                          $titl='@Angiv Leveringsstedets Bynavn',         $revi=true, '','','','',$plho='By..');
  htm_lastFelt();                                                                                                       
  //htm_CombFelt($type='text',    $name='land',         $valu= $land,     $labl='@Leverings Land',              $titl='@Angiv Leverings Land',                  $revi=true);
  //htm_CombFelt($type='text',    $name='levtelf',      $valu= $telf,     $labl='@Telefon(er)',                 $titl='@Angiv Modtagers Telefon',               $revi=true, '','','','',$plho='Telf..');
  htm_CombFelt($type='text',    $name='levkont',      $valu= $kont,     $labl='@Att.',                        $titl='@Angiv Kontaktpersons Navn',             $revi=true, '','','','',$plho='Att..');
  //htm_CombFelt($type='mail',    $name='levemail',     $valu= $email,    $labl='@Modtagerens Email adresse',   $titl='@Angiv Modtagers Email adresse',         $revi=true);
  //htm_CombFelt($type='text',    $name='forsendelse',  $valu= $forsend,  $labl='@Fragtmetode)',                $titl='@Angiv Forsendelses oplysninger',        $revi=true);
  htm_CombFelt($type='area',    $name='levnoter',     $valu= $noter,    $labl='@Noter til bestillingen',      $titl='@Angiv Noter',             $revi=true, $rows='1','','','',$plho='Noter..');
  // htm_FrstFelt('50%');
  //   htm_CheckFlt($type='checkbox',$name='afsendt',    $valu= $afsendt,  $labl='@Afsendt',                     $titl='@Afmærk her når varen/ydelsen er afsendt', $revi=true);
  // htm_NextFelt('50%');  
  //   htm_CombFelt($type='date',$name='modtdato',        $valu= $levdato,  $labl='@Modtage Dato',              $titl='@evt. forsendelses dato',                $revi=true);
  // htm_LastFelt();
  htm_PanlBund($pmpt='@Gem',$subm=false,$title='','',$simu=true);
  
  SpalteBund(); 
  
  //  SpalteTop(960);
  //  Panl_CopyBoard();
  htm_nl();
  htm_Panl_Top($name= '',$capt= '@Bestillings-poster:',$parms='page_Blindgyden.php',$icon='fas fa-list','panelW960',__FUNCTION__,'');
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
      ['@Status:', '25%','text','','left', '@Her kan skrives en bemærkning til bestillingen', '@Ny bestilling, endnu ikke godkendt'],
    ),
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
      ['@Pos.',        '5%', 'text', '',['left'],'@Position tildeles automatisk.'.' ','Pos...'],
      ['@Varenr',      '7%', 'text', '',['left'],'@Varenummer hentes fra vareregistret.','Vare...'],
      ['@Lev.varenr',  '7%', 'text', '',['left'],'@Leverandørens varenummer.','Leve...'],
      ['@Antal',       '5%', 'text', '',['left'],'@Mængden af den aktuelle leverance.'.' ','Ant...'],
      ['@Enhed',       '5%', 'text', '',['left'],'@Enhedsbeskrivelse af mængden','Enh...'],
      ['@Beskrivelse','45%', 'text', '',['left'],'@Leverance beskrivlse','Beskr...'],
      ['@Pris',       '10%', 'tal2d','',['left'],'@Enhedspris','Pris...'],
      ['@Rabat%',      '6%', 'tal2d','',['left'],'@Rabatsats i %. Angiv 0% og en reduceret enhedspris, hvis der skal ydes en beløbs rabat','Rabat'],
      ['@Moms%',       '6%', 'tal2d','',['left'],'@Moms %-sats for den posterede leverance','Moms...'],
      ['@Linie ialt', '10%', 'tal2d','',['left'],'@Beregnet beløb.'] 
    ),
    $RowSuff= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
    //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $data= array(
      [1,2,3,4,5,6,7,8,9,10],
      [1,2,3,4,5,6,7,8,9,10],
      [1,2,3,4,5,6,7,8,9,10],
      [1,2,3,4,5,6,7,8,9,10],
    ),  # Antal rows ved DEMO
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '200px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
 // Ordresum	0,00	Moms	0,00	I alt	0,00
  htm_FrstFelt('30%');
  htm_NextFelt('10%');  htm_CombFelt($type='tal2d',  $name='osum', $valu= $osum,  $labl='@Ordresum', $titl='@Beregnet sum af linie-beløb', $revi=false, '','','','',$plho='0,00');
  htm_NextFelt('10%');  htm_CombFelt($type='tal2dc',  $name='moms', $valu= $moms,  $labl='@Moms',     $titl='@Beregnet moms',               $revi=false, '','','','',$plho='25%');
  htm_NextFelt('10%');  htm_CombFelt($type='tal2d',  $name='ialt', $valu= $ialt,  $labl='@I alt',    $titl='@Brutto pris inclusive moms',  $revi=false, '','','','',$plho='0.000,00..');
  htm_NextFelt('30%');
  htm_LastFelt();
  htm_PanlBund($pmpt='@Gem',$subm=false,$title='','',$simu=true);
  
  SpalteBund(); 
  
  htm_Accept($pmpt='@Gem',$title='@Opret bestilling, når du er færdig med inddatering',$width='',$akey);
  htm_nl();
  htm_KnapGrup('@Her kan du:',true,false);
    textKnap($label='@Oprette Ny',  $title='@Opret ny bestilling',    $link='../_base/page_Blindgyden.php');
    textKnap($label='@Opslag',    $title='@Opslag af leverandører', $link='../_base/page_Blindgyden.php');    
    textKnap($label='@CSV-eksport',       $title='@CSV - Eksporter til kommasepareret fil, som kan indlæses i regneark.', $link='../_base/page_Blindgyden.php');
  htm_KnapGrup('',false);
  htm_TapetBund($formslut=true);
  PanelMin(4);    //  Detaljer
}


######### :KREDITOR:
# Kaldes fra:  [_kreditor/page_Rapport-kre.php] 
function Panl_KredRapp(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {  ## out_PanlsPrim.php
  set_FormVars(['krkonto','krdatefra']);  // Opdater alle variabler på form 'kredform' :
  
  htm_Panl_Top($name= 'kredform',$capt= '@Kreditor-rapporter:',$parms='#',$icon='fas fa-chart-line','panelW320',__FUNCTION__);
    htm_FrstFelt('04%');  
    htm_NextFelt('36%');  htm_Prompt('@Vælg kriterier:','right');  //echo '<p align="center">'.tolk('@Angiv kriterier:').'</p> ';
    htm_NextFelt('02%');  
    htm_NextFelt('58%');  
    htm_NextFelt('05%');
    htm_LastFelt();
  htm_FrstFelt('0%'); 
  htm_NextFelt('50%');  htm_CombFelt($type='text',$name='krkonto',    $valu= $_SESSION['krkonto'],    $labl='@Konto',     $titl='@Angiv kreditor Konto, som skal rapporteres',  $revi=true);
  htm_NextFelt('50%');  htm_CombFelt($type='date',$name='krdatefra',  $valu= $_SESSION['krdatefra'],  $labl='@Fra Dato',  $titl='@Fra hvilken dato, skal perioden starte med',  $revi=true);
  htm_LastFelt();
  htm_Accept($labl='@Benyt det', $title='@Godkend dine valg, så de benyttes ved rapportdannelse', $width='',$akey='b',$form='kredform');
  htm_KnapGrup('@Vis:',true);
    textKnap($label='@Åbne poster',    $title='@Rapport for kreditor åbne poster',    
                                       $link=  '../_kreditor/page_Rapport-kre.php?job=openpost',   $akey='å');
    textKnap($label='@Konto saldo',    $title='@Viser en liste over saldi på valgt(e) konti pr. den angivne dato',    
                                       $link=  '../_kreditor/page_Rapport-kre.php?job=ktsaldo',    $akey='s');
    textKnap($label='@Konto kort',     $title='@Rapport for kreditor konto kort',     
                                       $link=  '../_kreditor/page_Rapport-kre.php?job=ktkort',     $akey='k');  //  Panl_KredKontoKort
    textKnap($label='@Købs statistik', $title='@Rapport for kreditor købs statistik', 
                                       $link=  '../_kreditor/page_Rapport-kre.php?job=kobstat',    $akey='t');
  htm_KnapGrup('@Vis:',false);
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Luk og gå retur til hovedmenu');
  dev_show();
}

######### :KREDITOR:
function KredRappTop($rapp='') { //  Data dannes i: Panl_DebRapp
  htm_FrstFelt('40%');  htm_DataFelt('@KRITERIER for rapporten:','');
  htm_NextFelt('40%');  
  htm_NextFelt('20%');  
  htm_LastFelt();
  htm_FrstFelt('40%');  htm_DataFelt('@Kunde(r):',$_SESSION['krkonto']);
  htm_NextFelt('10%');  htm_DataFelt('@Periode:','','right'); 
  htm_NextFelt('25%');  htm_DataFelt('@Fra:',$_SESSION['krdatefra']);
  htm_NextFelt('25%');  htm_DataFelt('@Til:',''.date('Y-m-d'));//htm_DataFelt('@Til:',$_SESSION['datetil']);
  htm_LastFelt();
  htm_LastFelt();
  htm_hr();
}


######### :KREDITOR:
function Panl_KredOpenPost() {
  //Panl_Rapportliste();
  htm_Panl_Top($name= 'rappformopp',$capt= '@Åbne poster (ubetalte):',$parms='../_base/page_Hovedmenu.php',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  //Kriterier('@Leverandør(er):');
  KredRappTop('xxx');
  htm_Table(
    $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
        ['@Her ser du ','15%', 'html', '', 'left', '', '@ubetalte fakturaer'],
      ),
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Løbenr.',    '6%','show','',['center'],'@Løbe nummer','..auto..'],
        ['@PBS',        '8%','show','',['left'  ],'@Reference til PBS','@pbs...'],
        ['@Firmanavn', '28%','show','',['left'  ],'@Firma navn','@Navn...'],
#-       ['@0-7',        '9%','show','',['right' ],'@Faktura alder 0-7 dage','@0.00'],
#-       ['@8-29',       '9%','show','',['right' ],'@Faktura alder 8-29 dage','@0.00'],
#-       ['@30-59',      '9%','show','',['right' ],'@Faktura alder 30-59 dage','@0.00'],
#-       ['@60-89',      '9%','show','',['right' ],'@Faktura alder 60-89 dage','@0.00'],
#-       ['@>=90',       '9%','show','',['right' ],'@Faktura alder >=90 dage','@0.00'],
        ['@I alt',     '10%','show','',['right' ],'@Sum','@0.00...']
      ),
    $RowSuff= array(
        ['@Vælg',       '6%','knap','',['center'],'@Marker de poster, som der skal ske handling på',''],
        
      ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
    //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $TablData= array( # DemoData:
        ['1','','Firmanavn','','','','','',''],
        ['2','','Firmanavn','','','','','',''],
        ['3','','Firmanavn','','','','','',''],
        ['4','','Firmanavn','','','','','','']
      ),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '200px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_KnapGrup('@Med de valgte:',true);
    textKnap($label='@Mail kontoudtog', $title='@Klik her for at maile kontoudtog til de modtagere som er afmærket ovenfor',     $link='../_base/page_Blindgyden.php',$akey='m');
    textKnap($label='@Opret rykker',    $title='@Klik her for at oprette rykker til dem, som er afmærket ovenfor',     $link='../_base/page_Blindgyden.php',$akey='o');    
    textKnap($label='@Ryk alle',        $title=tolk('@Denne funktion gør følgende:').'<ul><li>'.
                                               tolk('@udligner alle konti, hvor saldo er 0.').'</li><li>'.
                                               tolk('@opretter rykkere, hvor betalingsfrist er overskredet med det antal dage, som er valgt under indstillinger -> rykkervalg,').'</li><li>'.
                                               tolk('@bogfører åbne rykkere, hvor betalingsfrist er overskredet, og opretter rykkere på næste niveau for disse').'</li><li>'.
                                               tolk('@Sletter åbne rykkere, som er blevet betalt.').'</li></ul>',      $link='../_base/page_Blindgyden.php',$akey='a');
  htm_KnapGrup('@Med de markerede:',false);
  htm_PanlBund($pmpt='@Gem',$subm=false);
}

######### :KREDITOR:
function Panl_KredKontoListe() {
  //Panl_Rapportliste();
  htm_Panl_Top($name= 'rappformkrkt',$capt= '@Saldo liste:',$parms='#',$icon='far fa-file-alt','panelW480',__FUNCTION__);
  //Kriterier('@Leverandør(er):');
  KredRappTop('xxx');
  htm_Table(
    $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
        ['@Her ser du ','25%', 'html', '', 'left', '', '@ubetalte fakturaer'],
      ),
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@kontonr.',   '5%','show','',['center'],'@Løbe nummer','..auto..'],
        ['@Firmanavn', '80%','show','',['left'  ],'@Firma navn','@Navn...'],
        ['@kontosum',  '10%','show','',['right' ],'@Faktura alder 0-7 dage','@0.00'],
      ),
    $RowSuff= array(
      ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
    //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $TablData= array( # DemoData:
        ['1011','Firmanavn',''],
        ['1012','Firmanavn',''],
        ['1013','Firmanavn',''],
        ['1014','Firmanavn','']
      ),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '130px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_FrstFelt('49%');  
  htm_NextFelt('30%');  htm_Prompt('@Skyldig i alt:','right'); 
  htm_NextFelt('20%');  htm_CombFelt($type='tal2d',  $name='ialt',  $valu= $ialt=0,   $labl='',$titl='@Summen af de listede beløb.', $revi=false);
  htm_NextFelt('01%');  
  htm_LastFelt();
  htm_PanlBund($pmpt='@Gem',$subm=false);
}

######### :KREDITOR:
function Panl_KredKoebsStat() {
  //  Panl_Rapportliste();
  htm_Panl_Top($name= 'rappformkrkob',$capt= '@Købs statistik:',$parms='#',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  //Kriterier('@Leverandør(er):');
  KredRappTop('xxx');
  $leverad= ['',''];
  foreach ($leverad as $lev) {
    htm_FrstFelt('04%');  htm_NextFelt('60%');  htm_DataFelt('@Firmanavn:','T. Petersen'); 
    htm_NextFelt('05%');    htm_NextFelt('25%');  htm_DataFelt('@Kontonr:','1000',''); 
    htm_NextFelt('05%');    htm_LastFelt();
    htm_Table(
      $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
        ),
      $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Varenr.' ,    '10%','show','',  ['center'],'@Varenr.','@nr..'],
          ['@Beskrivelse', '55%','show','',  ['left'  ],'@Beskrivelse','@txt...'],
          ['@Antal.',       '4%','show','0d',['center'],'@Antal','@tal...'],
          ['@Pris',        '12%','show','2d',['right' ],'@Pris','@pris...'],
          ['@Sum',         '16%','show','2d',['right' ],'@Sum','@0.00'],
        ),
      $RowSuff= array(
        ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
      //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
      $TablData= array( # DemoData:
          ['100','Udført arbejde','8','375','3000'],
          ['Matr.','Diverse materialer og afdækning','1','400','400'],
          ['Afgift.','Andre afgifter end moms','1','120','120'],
        ),
      $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
      $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
      $CreateRec=false,       # Mulighed for at oprette en record
      $ModifyRec=false,       # Mulighed for at ændre data i en row
      $ViewHeight= '130px',  # Højden af den synlige del af tabellens data
      $CalledFrom= __FUNCTION__
    );
  htm_hr();
  }
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}


######### :KREDITOR:
function Panl_KredKontoKort() {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'rappformkrkk',$capt= '@Konto kort:',$parms='#',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  //Kriterier('@Leverandør(er):');
  KredRappTop('xxx');
  $leverad= ['',''];
  foreach ($leverad as $lev) {
    htm_FrstFelt('04%');  
    htm_NextFelt('60%');  htm_DataFelt('','3.dk'); 

    htm_NextFelt('05%');  
    htm_NextFelt('25%');  htm_DataFelt('@Kontonr:','1003',''); 
    htm_NextFelt('05%');  
    htm_LastFelt();
    htm_FrstFelt('04%');  
    htm_NextFelt('60%');  htm_DataFelt('','Scandiagade 8'); 
    htm_NextFelt('05%');  
    htm_NextFelt('25%');  htm_DataFelt('@Dato:','18-07-2018',''); 
    htm_NextFelt('05%');  
    htm_LastFelt();
    htm_FrstFelt('04%');  
    htm_NextFelt('60%');  htm_DataFelt('','2450'); htm_DataFelt('&nbsp;&nbsp;','København SV'); 
    htm_NextFelt('05%');  
    htm_NextFelt('25%');  htm_DataFelt('@Valuta:','DKK',''); 
    htm_NextFelt('05%');  
    htm_LastFelt();
    htm_Table(
      $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
          //['@Her ser du ','15%', 'text', '', 'left', '', '@ubetalte fakturaer'],
        ),
      $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Dato' ,   '12%','date','',['center'],'@Faktura dato','@dato..'],
          ['@Bilag',    '8%','show','',['center'],'@Bilag nummer','@nr...'],
          ['@Faktura',  '8%','show','',['center'],'@Faktura nummer','@nr'],
          ['@Tekst',   '25%','show','',['left'  ],'@Tekst','@txt...'],
          ['@Forfald', '12%','date','',['left'  ],'@Forfald','@dato..'],
          ['@Debet',    '9%','show','',['right' ],'@Debet','@0.00'],
          ['@Kredit',   '9%','show','',['right' ],'@Kredit','@0.00'],
          ['@Saldo',   '12%','show','',['right' ],'@Saldo','@0.00'],
          //  
        ),
      $RowSuff= array(
        ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
      //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
      $TablData= array( # DemoData:
          [' ',' ',' ','Primosaldo',' ',' ',' ',''],
          ['2017-06-01','bilag','fakt','','','','',''],
          ['','bilag','fakt','','','','',''],
          ['','bilag','fakt','','','','','']
        ),
      $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
      $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
      $CreateRec=false,       # Mulighed for at oprette en record
      $ModifyRec=false,       # Mulighed for at ændre data i en row
      $ViewHeight= '130px',  # Højden af den synlige del af tabellens data
      $CalledFrom= __FUNCTION__
    );
  htm_hr();
  }
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}

######### :KREDITOR:
# Kaldes fra: 
function Panl_Leverandorer() {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'leveform',$capt= '@Leverandøropslag:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-database','panelWmax',__FUNCTION__);
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        ['@Find leverandør ',   '',    'html',    '', '',      '',    '@i databasen']
      ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Kontonr.', '10%','text','',  ['left'],   '@Entydig nummerkode..','@Kont...'],
        ['@Navn',     '20%','text','',  ['left'],   '@Leverandørens navn','@DNavn...'],
        ['@Adresse',  '15%','text','',  ['left'],   '@Leverandørens adresse: Gade & husnr','@Addr...'],
        ['@Sted',     '15%','text','',  ['left'],   '@Supplerende adresse','@Sted...'],
        ['@Postnr',    '5%','text','',  ['left'],   '@Postnummer','@Post...'],
        ['@Bynavn',   '15%','text','',  ['left'],   '@Bynavn','@By...'],
        ['@Land',     '10%','text','',  ['left'],   '@Land','@Land...'],
        ['@Telefon',  '10%','text','',  ['left'],   '@Telefon','Telf...'],
      ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        []
      ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    /* $DATA=   array(
      ), */
    $TablData= [['1003','3.dk','Scandiagade 8	','','2450','København SV','DK Danmark',''],['1002','OK Benzin','Åhaven 11','','8260','Viby J','DK Danmark',''],
                        ['1001','Malergrossisten','Industrivej 12','','8600','Århus C','DK Danmark','']], 
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '120px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
}



######### :KREDITOR: ######### Slut funktioner angående visninger i menu-gruppen KREDITOR



########## :LAGER: ######### Start funktioner angående visninger i menu-gruppen LAGER


######### :LAGER:
function Panl_Vare_Beholdning() { ## out_PanlsSekd.php
  htm_Panl_Top($name= 'varekortform8',$capt= '@Beholdning:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW240',__FUNCTION__);
  htm_CombFelt($type='text',  $name='behlloka', $valu= $behlloka,   $labl='@Lokation',  
          $titl='@Angiv en tekst der beskriver lokation for varen', $revi=true, $rows='2',$width='',$step='', $more='', $plho=tolk('@Lok...'));
  htm_CombFelt($type='text',  $name='behlfolg', $valu= $behlfolg,   $labl='@Følgevare', 
          $titl='@Angiv en tekst der beskriver følgevare', $revi=true, $rows='2',$width='',$step='', $more='', $plho=tolk('@Følg...'));
  htm_FrstFelt('25%');    htm_Caption('@Behold.:'); 
  htm_NextFelt('25%');    htm_CombFelt($type='tal1d',  $name='regn', $valu= $regnskab,  $labl='@Min.',   
      $titl='@Angiv ', $revi=true, $rows='2',$width='',$step='' );
  htm_NextFelt('25%');    htm_CombFelt($type='tal1d',  $name='regn', $valu= $regnskab,  $labl='@Max.',   
      $titl='@Angiv ', $revi=true, $rows='2',$width='',$step='' );
  htm_NextFelt('25%');    htm_CombFelt($type='tal1d',  $name='regn', $valu= $regnskab,  $labl='@Aktuel', 
      $titl='@Angiv ', $revi=true, $rows='2',$width='',$step='' );
  htm_lastFelt(); 
  htm_PanlBund($pmpt='@Gem',$subm=true);
}
######### :LAGER:
function Panl_Vare_Grupper() { ## out_PanlsSekd.php
  htm_Panl_Top($name= 'varekortform9',$capt= '@Grupper:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW240',__FUNCTION__);
  htm_OptioFlt($type='text',  $name='enhed0',     $valu= $enhed0,  
                    $labl='@Varegruppe',          $titl='@Vælg den Varegruppe varen skal være tilknyttet',  
                    $revi=true, $optlist= Grp1Liste(),$action='','','','',$nl=1);
  htm_OptioFlt($type='text',  $name='enhed0',     $valu= $enhed0,  
                    $labl='@Prisgruppe',          $titl='@Vælg den Prisgruppe varen skal være tilknyttet.',  
                    $revi=true, $optlist= PrisListe(),$action='');
  htm_OptioFlt($type='text',  $name='enhed0',     $valu= $enhed0,  
                    $labl='@Tilbudsgruppe',       $titl='@Vælg den Tilbudsgruppe varen skal være tilknyttet',  
                    $revi=true, $optlist= TilbListe(),$action='');
  htm_OptioFlt($type='text',  $name='enhed0',     $valu= $enhed0,  
                    $labl='@Rabatgruppe',         $titl='@Vælg den Rabatgruppe varen skal være tilknyttet',  
                    $revi=true, $optlist= rabtListe(),$action='');
  htm_PanlBund($pmpt='@Gem',$subm=true);
}
######### :LAGER:
function Panl_Vare_Kategorier() { ## out_PanlsSekd.php
  htm_Panl_Top($name= 'varekortform10',$capt= '@Kategorier:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW480',__FUNCTION__);
  htm_CombFelt($type='text',  $name='regn', $valu= $regnskab,     $labl='@Opret ny',         
      $titl=tolk('@Opret en ny kategori: Skriv navnet på kategorien her.').'<br>'.
      tolk('@For at oprette en underkategori skrives id på den overstående kategori foran navnet med | som adskillelse, f.eks 31|Herresokker.').'<br>'.
      tolk('@Id findes ved at holde musen over kategoriens navn.'), 
        $revi=true, $rows='2',$width='',$step='', $more='', $plho=tolk('@Angiv evt. navn på en ny vare kategori...'));
  
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
      ['@Tabel  &nbsp;', '20%','text','' ,'left', '@Produkt kategorier', '@Kategori']
    ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
      ['@Id',            '8%','data', '',['left'  ], '@Kategoriens index','@id...'],
      ['@Beskrivelse',  '60%','data', '',['left'  ], '@Beskrivelse af kategorien','@Besk...'],
    ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
      ['@Tilknyt',      '10%','knap', '',['center'], '@Sæt flueben her for at knytte $firmanavn til denne kategori','<input type="checkbox" name="kat_valg[$d]" $checked>'],
      ['@Omdøb',        '10%','knap', '',['center'], '@Klik på grønt kryds for at omdøbe kategorien', '<a href="varekort.php?id=$id&rename_category=$kat_id[$d]" onclick="return confirm("Vil du omdøbe denne kategori?")"><ic class="far fa-times-circle" style="color:green; font-size:13px;"></ic></a>'], // <img src=../_assets/icons/rename.png border=0>
      ['@Slet',         '10%','knap', '',['center'], '@Klik på rødt kryds for at slette kategorien', '<a href="varekort.php?id=$id&delete_category=$kat_id[$d]" onclick="return confirm("Vil du slette denne katagori?")"><ic class="far fa-times-circle" style="color:red; font-size:13px;"></ic></a>'], //  <img src=../_assets/icons/delete.png border=0>
    ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON, ]
    //$DATA,#=   array(),
    $data= array(
            [[''],[''],[''],['']],
            [[''],[''],[''],['']],
            [[''],[''],[''],['']],
            ),  #  DEMOdata
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '150px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__ 
  );  
  htm_Plaintxt('Opret underkategori ved at angive hovedkategori-Id foran underkategori-navn, adskilt med tegnet: | ');  
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :LAGER:
function Panl_Vare_Varianter() { ## out_PanlsSekd.php
  htm_Panl_Top($name= 'varekortform11',$capt= '@Varianter:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW480',__FUNCTION__);
//  $temp= $Ønovice;  $Ønovice= false;
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        ['@Tabel  &nbsp; ', '20%','text','','left', '@Produkt varianter', '@Varianter']
      ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Beskriv.',  '40%','data', '',['left'  ], '@Beskrivelse af varianten','@Besk...'],
        ['@Stregkd.',  '20%','data', '',['center'], '@Variantens stregkode','@Kode...'],
        ['@Beholdning','14%','data', '',['center'], '@Lager beholdning af varianten','@Beh..'],
      ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ['@Slet',      '8%', 'knap', '',['center'],'@Klik på rødt kryds for at slette denne variant fra listen','<ic class="far fa-times-circle" style="color:red; font-size:13px;"></ic>'],  //  <img src=../_assets/icons/delete.png border=0>
        ['@Skjul',     '8%', 'knap', '',['center'],'@Klik på blåt kryds for at skjule denne variant i listen',  '<ic class="far fa-times-circle" style="color:blue; font-size:13px;"></ic>'],
      ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON, ]
    //$DATA,#=   array(),
    $data= array(
        [[''],[''],[''],['']],
        [[''],[''],[''],['']],
        [[''],[''],[''],['']],
        ),  #  DEMOdata
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '150px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_PanlBund($pmpt='@Gem',$subm=true); 
}
######### :LAGER:
function Panl_Vare_Dele() { ## out_PanlsSekd.php
  htm_Panl_Top($name='menuform' ,$capt='@Samlevare -dele', $parms='page_Blindgyden.php', $icon='fas fa-plus', $klasse='panelW400',__FUNCTION__);
    //htm_nl();
 //   htm_FrstFelt('25%');    htm_Caption('@Om varen:'); 
 //   htm_NextFelt('35%');    htm_CheckFlt($type='checkbox',$name='vareudgaa', $valu= $vareudgaa,  
 //                $labl='@Udgået)',  
 //                $titl='@Varen er udgået af sortimentet.',  
 //                $revi=true, $more='');
 //   htm_NextFelt('40%');    htm_CheckFlt($type='checkbox',$name='samlevare', $valu= $samlevare,  
 //                $labl='@Samlevare)',  
 //                $titl='@Varen består af yderligere varedele.',  
 //                $revi=true, $more='');
 //   
 //   htm_lastFelt(); 
    htm_Caption($labl='@Samlevare bestående af:');
    htm_Table(
      $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        ['@Tabel  &nbsp; ', '20%','text','', 'left', '@Produkt dele', '@Vare delposter']
        ),
      $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
      $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Pos.',         '10%','data', '',['left'  ], '@Positions nr af del-vare','@pos...'],
          ['@Leverandør.',  '44%','data', '',['left'  ], '@Leverandør nummer & navn','@Lev...'],
          ['@Varenr.',      '18%','data', '',['center'], '@Leverandørens varenummer','@Vare..'],
          ['@Kostpris',     '18%','data', '',['right' ], '@Delpostens kostpris','@Kost..'],
        ),
      $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
           ['@Slet',        '10%','knap','',['center'],'@Klik på rødt kryds for at slette denne post fra listen?','<ic class="far fa-times-circle" style="color:red; font-size:13px;"></ic>'],  //  <img src=../_assets/icons/delete.png border=0>
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON, ]
      //$DATA,#=   array(),
      $data= array(
        [[''],[''],[''],['']],
        [[''],[''],[''],['']],
        [[''],[''],[''],['']],
        [[''],[''],[''],['']],
        [[''],[''],[''],['']],
        ),  #  DEMOdata

      $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
      $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
      $CreateRec=true,       # Mulighed for at oprette en record
      $ModifyRec=true,       # Mulighed for at ændre data i en row
      $ViewHeight= '200px',  # Højden af den synlige del af tabellens data
      $CalledFrom= __FUNCTION__
    );
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :LAGER:
function Panl_Vare_Enheder() { ## out_PanlsSekd.php
  htm_Panl_Top($name= 'varekortform7',$capt= '@Enheder:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW240',__FUNCTION__);
  htm_OptioFlt($type='text',  $name='enhed0',    $valu= $enhed0,  
                    $labl='@Enhed',         
                    $titl='@Vælg den enhed du ønsker at bruge.',  
                    $revi=true, $optlist= array(
                    ['','Stk','Stk'],
                    ['','Palle','Palle']),$action='','','','',$nl=1);
  htm_OptioFlt($type='text',  $name='enhed1',    $valu= $enhed1,  
                    $labl='@Alternativt',         
                    $titl='@Vælg den alternative enhed du ønsker at bruge.',  
                    $revi=true, $optlist= array(
                    ['','Stk','Stk'],
                    ['','Palle','Palle']),$action='');
  htm_CombFelt($type='text',    $name='enhdindh', $valu= $enhdindh,   $labl='@Indhold/enhed',  
      $titl='@Angiv en tekst der beskriver indholdet pr. enhed', $revi=true, $rows='2',$width='',$step='' );
  htm_CombFelt($type='tal2dc',  $name='enhdpris', $valu= $enhdpris,   $labl='@Pris/enhed',     
      $titl='@Angiv et beløb der beskriver prisen pr. enhed', $revi=true, $rows='2',$width='',$step='' );
  htm_PanlBund($pmpt='@Gem',$subm=true);
}


######### :LAGER:
function Panl_Vare_Rabatter() { ## out_PanlsSekd.php
  htm_Panl_Top($name= 'varekortform5',$capt= '@Mængde-rabatter:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW240',__FUNCTION__);
  htm_OptioFlt($type='text',  $name='enhed0',    $valu= $enhed0,  
                    $labl='@Rabat metode',         
                    $titl='@Vælg den enhed du ønsker at bruge.',  
                    $revi=true, $optlist= array(
                    ['','%','%'],
                    ['','Kr.','Kr.']),$action='','','','',$nl=1);
  htm_FrstFelt('50%');    htm_CombFelt($type='tal2dc',  $name='stkrabat', $valu= $stkrabat,   $labl='@Stk. rabat ved antal',  
      $titl='@Minimumsmængde for at yde mængderabat', $revi=true, $rows='2',$width='',$step='', $more='', $plho=tolk('@Antal...'));
  htm_NextFelt('50%');    htm_CombFelt($type='tal2dc',  $name='antrabat', $valu= $antrabat,   $labl='@%- rabat ved antal',    
      $titl='@Minimumsmængde for at yde procent rabat', $revi=true, $rows='2',$width='',$step='', $more='', $plho=tolk('@Antal...'));
  htm_lastFelt(); 
  htm_PanlBund($pmpt='@Gem',$subm=true);
  
  
  htm_Panl_Top($name= 'varekortform6',$capt= '@Colli:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW240',__FUNCTION__);
  htm_CombFelt($type='text',    $name='collsize', $valu= $collsize, $labl='@Størrelse',        
      $titl='@Angiv en tekst der beskriver dimensionerne',       $revi=true, $rows='2',$width='',$step='');
  htm_CombFelt($type='text',    $name='collydre', $valu= $collydre, $labl='@Ydre størrelse',   
      $titl='@Angiv en tekst der beskriver de ydre dimensioner', $revi=true, $rows='2',$width='',$step='' );
  htm_CombFelt($type='tal2dc',  $name='collanbr', $valu= $collanbr, $labl='@Anbruds kostpris', 
      $titl='@Angiv et beløb der beskriver anbruds kostprisen',  $revi=true, $rows='2',$width='',$step='' );
  htm_CombFelt($type='tal2dc',  $name='collkost', $valu= $collkost, $labl='@Kostpris',         
      $titl='@Angiv et beløb der beskriver kostprisen',          $revi=true, $rows='2',$width='',$step='' );
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :LAGER:
function Panl_Vare_Tilbud() { ## out_PanlsSekd.php
  htm_Panl_Top($name= 'varekortform4',$capt= '@Periode-Tilbud:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW240',__FUNCTION__);
  htm_CombFelt($type='tal2dc',  $name='tilbpris', $valu= $tilbpris, $labl='@Salgspris',  
      $titl='@Angiv enheds Salgsprisen',                     $revi=true, $rows='2',$width='',$step='');
  htm_CombFelt($type='tal2dc',  $name='tilbkost', $valu= $tilbkost, $labl='@Kostpris',   
      $titl='@Angiv enheds Kostprisen',                      $revi=true, $rows='2',$width='',$step='' );
  htm_FrstFelt('50%');    
  htm_CombFelt($type='date',    $name='tilbstrt', $valu= $tilbstrt, $labl='@Dato start', 
      $titl='@Angiv start-dato for tilbudsperioen (incl.)',  $revi=true, $rows='2',$width='',$step='' );
  htm_NextFelt('50%');
  htm_CombFelt($type='date',    $name='tilbslut', $valu= $tilbslut, $labl='@Dato slut',  
      $titl='@Angiv slut-dato for tilbudsperioen (incl.)',   $revi=true, $rows='2',$width='',$step='' );
  htm_lastFelt(); 
  htm_FrstFelt('50%');    
  htm_CombFelt($type='time',    $name='timestrt', $valu= $timestrt=12, $labl='@Tid start', 
      $titl='@Angiv klokkeslet for tilbudsperiodens start-tidspunkt.',  $revi=true, $rows='2',$width='',$step='0.25 ',$more='max=24 min=0 ');
  htm_NextFelt('50%');
  htm_CombFelt($type='time',    $name='timeslut', $valu= $timeslut=12, $labl='@Tid slut',  
      $titl='@Angiv klokkeslet for tilbudsperiodens slut-tidspunkt.',   $revi=true, $rows='2',$width='',$step='0.25 ',$more='max=24 min=0 ');
  htm_lastFelt(); 
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :LAGER:
# Kaldes fra: page_Beholdningsliste.php
function Panl_Beholdningsrapp() { ## out_PanlsPrim.php
  set_FormVars(['varegrp','lgafdel','saelger','frstdato','lastdato','varenumr','varenavn','detaljer','kunsalg']);  // Opdater alle variabler på form 'lagrform' :
  
  htm_Panl_Top($name= 'lagrform',$capt= '@Varerapporter:',$parms='#',$icon='fas fa-chart-line','panelW320',__FUNCTION__);
    htm_FrstFelt('04%'); 
    htm_NextFelt('36%');  htm_Prompt('@Vælg kriterier:','right');  //echo '<p align="center">'.tolk('@Angiv kriterier:').'</p> ';
    htm_NextFelt('02%');  
    htm_NextFelt('58%'); # htm_CheckFlt($type='checkbox',$name='somfakt',$valu='somfakt',
                         # $labl='@Husk dem', $titl='@Afmærk her, hvis kriterier skal genbruges.',  $revi=true);
    htm_NextFelt('05%');
    htm_LastFelt();
    htm_OptioFlt($type='text',  $name='varegrp',  $valu= $_SESSION['varegrp'],
                    $labl='@Varegruppe',         
                    $titl='@Vælg den Varegruppe du ønsker at få oplysninger om.',  
                    $revi=true, $optlist= Grp_Liste(),  $action='', $events='',$maxwd='300px',$onForm='lagrform');
    htm_OptioFlt($type='text',  $name='lgafdel',  $valu= $_SESSION['lgafdel'], 
                    $labl='@Afdeling',         
                    $titl='@Vælg den Afdeling du ønsker at få oplysninger om.',  
                    $revi=true, $optlist= Afd_Liste(),  $action='', $events='',$maxwd='300px',$onForm='lagrform');
    htm_OptioFlt($type='text',  $name='saelger',  $valu= $_SESSION['saelger'], 
                    $labl='@Sælger',         
                    $titl='@Vælg den Sælger du ønsker at få oplysninger om.',  
                    $revi=true, $optlist= Slg_Liste(),  $action='', $events='',$maxwd='300px',$onForm='lagrform');
    htm_FrstFelt('50%');
      htm_CombFelt($type='date',$name='frstdato', $valu= $_SESSION['frstdato'], $labl='@Periode fra', 
          $titl='@Periode fra dato',  $revi=true, $rows='2', $width='20px', $step='',$more='',$plho='@dato [YYYY-MM-DD]');
    htm_NextFelt('50%');  
      htm_CombFelt($type='date',$name='lastdato', $valu= $_SESSION['lastdato'], $labl='@Periode til', 
          $titl='@Periode til dato',  $revi=true, $rows='2', $width='20px', $step='',$more='',$plho='@dato [YYYY-MM-DD]');
    htm_LastFelt();
    htm_FrstFelt('20%');  
      htm_CombFelt($type='text',$name='varenumr', $valu= $_SESSION['varenumr'], $labl='@Varenr',   
          $titl='@Varenr',            $revi=true, $rows='2', $width='20px', $step='',$more='',$plho=' *');
    htm_NextFelt('80%');  
      htm_CombFelt($type='text',$name='varenavn', $valu= $_SESSION['varenavn'], $labl='@Varenavn', 
          $titl='@Varenavn',          $revi=true, $rows='2', $width='20px', $step='',$more='',$plho=' *');
    htm_LastFelt();
    
    htm_FrstFelt('50%');
      htm_CheckFlt($type='checkbox',$name='detaljer', $valu= $_SESSION['detaljer'], $labl='@Detaljeret',  
          $titl='@Detaljeret',        $revi=true, $more=' '.$pg);
    htm_NextFelt('50%');  
      htm_CheckFlt($type='checkbox',$name='kunsalg', $valu= $_SESSION['kunsalg'], $labl='@Kun salg / DB',  
          $titl='@Kun salg / DB',     $revi=true, $more=' '.$pg);
    htm_LastFelt();
    htm_Accept($labl='@Benyt det', $title='@Godkend dine valg, så de benyttes ved rapportdannelse', $width='',$akey='b',$form='lagrform');
  
    htm_KnapGrup('@Vis:',true);
      textKnap($label='@Vare rapport',    $title='@Vis varer, som opfylder de kriterier, du har angivet ovenfor', 
                                          $link=  '../_lager/page_Rapport-lagr.php?job=lgrvalg',   $akey='v');
      textKnap($label='@Lagerstatus',     $title='@Se lagerstatus på en vilkårlig dato',                
                                          $link=  '../_lager/page_Rapport-lagr.php?job=lgrstat',   $akey='s');
      textKnap($label='@Lageroptælling',  $title='@Funktion til optælling og regulering af varelager',  
                                          $link=  '../_lager/page_Rapport-lagr.php?job=lgrcount',   $akey='t');
    htm_KnapGrup('@Vis:',false);
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=false);
  dev_show();
}

######### :LAGER:
# Kaldes fra:  [_lager/page_Beholdningsliste.php] 
function Panl_Beholdningsliste() { ## out_PanlsPrim.php
  htm_Panl_Top($name= 'behlform',$capt= '@Beholdningsliste:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-database','panelW640',__FUNCTION__);
  htm_CentrOn(); 
    echo tolk('@Vælg kriterier i panelet til venstre, så vises resultatet her.'),'<br><br>';
  htm_CentOff();
  htm_PanlBund($pmpt='@Gem',$subm=false);
}

######### :LAGER:
function LagrRappTop($rapp='') { //  Data dannes i: Panl_Beholdningsrapp
  htm_FrstFelt('04%');  htm_NextFelt('15%');  htm_DataFelt('@KRITERIER =>',''); 
  htm_NextFelt('25%');    htm_DataFelt('@Varegruppe:',tolk(ListLookup(Grp_Liste(),$search= $_SESSION['varegrp'],$colsearch=1,$colresult=0)),''); 
  htm_NextFelt('25%');    htm_DataFelt('@Afdeling:',  tolk(ListLookup(Afd_Liste(),$search= $_SESSION['lgafdel'],$colsearch=1,$colresult=0)),''); 
  htm_NextFelt('25%');    htm_DataFelt('@Sælger:',    tolk(ListLookup(Slg_Liste(),$search= $_SESSION['saelger'],$colsearch=1,$colresult=0)),''); 
  htm_NextFelt('05%');    htm_LastFelt();
  
  htm_FrstFelt('04%');  
  htm_NextFelt('22%');    htm_DataFelt('@Fra Dato:',  $_SESSION['frstdato'],''); 
  htm_NextFelt('22%');    htm_DataFelt('@Til Dato:',  $_SESSION['lastdato'],''); 
  htm_NextFelt('20%');    htm_DataFelt('@Varenr.:',   $_SESSION['varenumr'],''); 
  htm_NextFelt('30%');    htm_DataFelt('@Varenavn:',  $_SESSION['varenavn'],''); 
  htm_NextFelt('01%');    htm_LastFelt(); //  $_SESSION['detaljer'] $_SESSION['kunsalg']
  htm_hr();
}

######### :LAGER:
function Panl_LagerVarer($DATA) {
  htm_Panl_Top($name= 'lagrform',$capt= '@Vare rapport:',$parms='#',$icon='fas fa-chart-line','panelW720',__FUNCTION__);
  LagrRappTop();
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Vare ',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '@status']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Varenr.',    '7%', 'keyn','',  ['left']  , '@Varenummer. Entydig nummerkode, som benyttes til sortering, summering mv.','@Numr...'],
          ['@Enhed',      '5%', 'text','',  ['left']  , '@Paknings enhed','@Enh...'],
          ['@Beskrivelse','30%','data','',  ['left']  , '@Beskrivende tekst, som benyttes ved ordre/faktura','@Besk...'],
          ['@Købt',       '6%', 'text','',  ['right'] , '@Produktets xxx','@Købt...'],
          ['@Solgt',      '9%', 'text','',  ['right'] , '@Produktets xxx ','@Solgt...'],
          ['@Antal',      '6%', 'text','',  ['right'] , '@Produktets xxx ','@Antal...'],
          ['@Købspris',   '8%', 'text','',  ['center'], '@Produkt xxx','@Købs...'],
          ['@Kostpris',   '8%', 'text','',  ['center'], '@xxx','@Kost...'],
          ['@Salgspris.', '8%', 'text','',  ['center'], '@xxx','@salg...']
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),
    $DATA, #=    array(     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
          // $TablData= ImportTabFile('../_exchange/varer.tab',1),  // Indlæs data fra TAB-fil
        #),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,       # Mulighed for at oprette en record
    $ModifyRec=false,       # Mulighed for at ændre data i en row
    $ViewHeight= '150px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_KnapGrup('@Her kan du:',true,true);
    textKnap($label='@Eksporter til CSV',         $title='@Klik her for at eksportere til en CSV-fil',$link='../_base/page_Blindgyden.php');
  htm_KnapGrup('@Her kan du:',false,false);
  htm_PanlBund($pmpt='@Gem',$subm=false);
}

######### :LAGER:
function Panl_LagerStat($DATA) {
  htm_Panl_Top($name= 'lagrform',$capt= '@Lagerstatus:',$parms='#',$icon='fas fa-chart-line','panelW720',__FUNCTION__);
  LagrRappTop();
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Produkt ',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '@statistik']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Varenr.',    '7%', 'keyn','',  ['left']  , '@Varenummer. Entydig nummerkode, som benyttes til sortering, summering mv.','@Numr...'],
          ['@Enhed',      '5%', 'text','',  ['left']  , '@Paknings enhed','@Enh...'],
          ['@Beskrivelse','30%','data','',  ['left']  , '@Beskrivende tekst, som benyttes ved ordre/faktura','@Besk...'],
          ['@Købt',       '6%', 'text','',  ['right'] , '@Produktets xxx','@Købt...'],
          ['@Solgt',      '9%', 'text','',  ['right'] , '@Produktets xxx ','@Solgt...'],
          ['@Antal',      '6%', 'text','',  ['right'] , '@Produktets xxx ','@Antal...'],
          ['@Købspris',   '8%', 'text','',  ['center'], '@Produkt xxx','@Købs...'],
          ['@Kostpris',   '8%', 'text','',  ['center'], '@xxx','@Kost...'],
          ['@Salgspris.', '8%', 'text','',  ['center'], '@xxx','@salg...']
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),
    $DATA, #=    array(     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
          // $TablData= ImportTabFile('../_exchange/varer.tab',1),  // Indlæs data fra TAB-fil
        #),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,       # Mulighed for at oprette en record
    $ModifyRec=false,       # Mulighed for at ændre data i en row
    $ViewHeight= '150px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_FrstFelt('40%');    htm_DataFelt('@Samlet lagerværdi pr.','?'); 
  htm_NextFelt('20%');    htm_DataFelt('@Købspris:','0,00',''); 
  htm_NextFelt('20%');    htm_DataFelt('@Kostpris','0,00',''); 
  htm_NextFelt('20%');    htm_DataFelt('@Salgspris','0,00',''); 
  htm_LastFelt();
  htm_KnapGrup('@Her kan du:',true,false);
    textKnap($label='@Eksporter til CSV',         $title='@Klik her for at eksportere til en CSV-fil',$link='../_base/page_Blindgyden.php');
  htm_KnapGrup('@Her kan du:',false,false);
  htm_PanlBund($pmpt='@Vis udskrift (blindgyde)',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}

######### :LAGER:
function Panl_LagerTal($DATA,$optalte=false)  {
  htm_Panl_Top($name= 'lagrform',$capt= '@Lager-optælling:',$parms='#',$icon='fas fa-chart-line','panelW720',__FUNCTION__);
  LagrRappTop();
  if ($optalte) $what= '@uoptalte varer'; else $what= '@optalte varer'; ;
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Liste over ',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    $what]
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Varenr.',         '7%', 'keyn','',  ['center'], '@Varenummer. Entydig nummerkode, som benyttes til sortering, summering mv.','@Numr...'],
          ['@Beskrivelse',    '40%', 'data','',  ['left']  , '@Beskrivende tekst, som benyttes ved ordre/faktura','@Besk...'],
          ['@Beholdning',     '10%', 'text','',  ['right'] , '@Beholdning xxx','@Beh...'],
          ['@Kostpris',       '10%', 'text','',  ['right'] , '@Kostpris','@Kost...'],
          ['@Lagerværdi',     '10%', 'text','',  ['right'] , '@Produktets Lagerværdi ','@Værd...'],
          ['@Σ Lagerværdi', '20%', 'text','',  ['right'] , '@Sum af produktets Lagerværdi ','@Sum...'],
       ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),
    $DATA, #=    array(     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
          // $TablData= ImportTabFile('../_exchange/varer.tab',1),  // Indlæs data fra TAB-fil
        #),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,       # Mulighed for at oprette en record
    $ModifyRec=false,       # Mulighed for at ændre data i en row
    $ViewHeight= '150px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  //echo 'Dato		Varenummer / Stregkode  Klik her for liste over ikke optalte varer';
  //echo 'Importer';
  //echo 'Dato		Varenummer / Stregkode	----- Ikke optalte varer pr 31-12-2012 -----Varenr	Beskrivelse	Beholdning	Kostpris	Lagerværdi	Lagerværdi sum';
  htm_KnapGrup('@Du kan:',true);  
      if ($optalte)
           textKnap($label='@Se optalte',     $title='@Klik her for liste over optalte varer',                
                                              $link=  '../_base/page_Blindgyden.php',   $akey='i');
      else textKnap($label='@Se ikke optalte', $title='@Klik her for liste over ikke optalte varer',                
                                              $link=  '../_base/page_Blindgyden.php',   $akey='i');
      textKnap($label='@Importere',           $title='@Importer på en vilkårlig dato',                
                                              $link=  '../_base/page_Blindgyden.php',   $akey='i');
      textKnap($label='@Eksportere',           $title='@Eksportere på en vilkårlig dato',                
                                              $link=  '../_base/page_Blindgyden.php',   $akey='i');
  htm_KnapGrup('@Vis:',false);
  htm_PanlBund($pmpt='@Vis udskrift (blindgyde)',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}


######### :LAGER:
# Kaldes fra:  [_lager/page_Varemodtagelse.php] [_lager/page_Varer.php] [_system/page_Varerelat.php] 
function Panl_Varer(&$DATA/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) { ## out_PanlsPrim.php
  include_once "../_config/connect.php";   #+  Database tilkobling
  htm_Panl_Top($name= 'vareform',$capt= '@Vareliste:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-database','panelWmax',__FUNCTION__);
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Produkter ',   '',    'html',    '', '',      '',    '@i databasen']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Varenr.',    '7%', 'keyn','',  ['left']  , '@Varenummer. Entydig nummerkode, som benyttes til sortering, summering mv.','@Numr...'],
          ['@Enhed',      '5%', 'show','',  ['left']  , '@Paknings enhed','@Enh...'],
          ['@Beskrivelse','33%','data','',  ['left']  , '@Beskrivende tekst, som benyttes ved ordre/faktura','@Besk...'],
          ['@Kostpris',   '6%', 'text','',  ['right'] , '@Produktets kostpris','@Kost...'],
          ['@Salgspris',  '6%', 'text','',  ['right'] , '@Produktets normale salgspris','@Salgs...'],
          ['@Vejl_pris',  '6%', 'text','',  ['right'] , '@Produktets vejledende pris','@Vejl...'],
          ['@Note',      '18%', 'text','',  ['center'], '@Produkt note','@Note...'],
          ['@Gruppe',     '5%', 'text','',  ['center'], '@Varegruppe','@Grup...'],
          ['@Beholdn.',   '6%', 'text','',  ['center'], '@Lagerbeholdning','@Beh...'],
          ['@Lokation.',  '6%', 'text','',  ['center'], '@Hvor varen befinder sig','@Lok...'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),
    $DATA, #=    array(     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
          // $TablData= ImportTabFile('../_exchange/varer.tab',1),  // Indlæs data fra TAB-fil
        #),
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '200px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );

  htm_nl();
  htm_KnapGrup('@Her kan du:',true,false);
    textKnap($label='@Ny vare',         $title='@Klik her for at oprette en ny vareregistrering',$link='../_base/page_Blindgyden.php');
    textKnap($label='@Indkøbsforslag',  $title='@Klik her for at lave et indkøbsforslag',$link='../_base/page_Blindgyden.php');
    textKnap($label='@Se ordrebeholdning', $title='@Opslag - Se oversigt over ordrebeholdning',$link='../_base/page_Blindgyden.php');
    textKnap($label='@Visning',         $title='@Visning - Vælg hvad der skal vises',$link='../_base/page_Blindgyden.php');
  htm_KnapGrup('@Her kan du:',false,false);
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
}

######### :LAGER:
function Panl_Vare_Specielt() { ## out_PanlsPrim.php
  htm_Panl_Top($name= 'varekortform2',$capt= '@Specielt:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW400',__FUNCTION__);
  htm_CombFelt($type='area',$name='noter',$valu= $noter,        $labl='@Bemærkning',    $titl='@Angiv Bemærkninger',  $revi=true, $rows='2');
  htm_nl();
  htm_FrstFelt('30%');    htm_CheckFlt($type='checkbox',$name='serinr', $valu= $serinr, $labl='@Serienr',   
      $titl='@Serienr',  $revi=false, $more=' '.$pg);
  htm_NextFelt('40%');    htm_CheckFlt($type='checkbox',$name='samlev', $valu= $samlev, $labl='@Samlevare', 
      $titl='@Varen består af flere delvarer. Afmærk her hvis varen er en samlevare. Feltet er låst, hvis beholdningen er forskellig fra 0 eller varen indgår i en uafsluttet ordre',       $revi=false, $more=' '.$pg);
  htm_NextFelt('30%');    htm_CheckFlt($type='checkbox',$name='udgaa',  $valu= $udgaa,  $labl='@Udgået',    
      $titl='@Produktet er udgået, og kan ikke bestilles',      $revi=false, $more=' '.$pg);
  htm_lastFelt(); 
  //  Følgevare	  Provisionsfri
  htm_FrstFelt('60%');    htm_CombFelt($type='text',    $name='flgevare', $valu= $flgevare, $labl='@Følgevare',     
      $titl='@Følgevare',     $revi=true, $more=' '.$pg);
  htm_NextFelt('40%');    htm_CheckFlt($type='checkbox',$name='provfri',  $valu= $provfri,  $labl='@Provisionsfri', 
      $titl='@Provisionsfri', $revi=true, $more=' '.$pg);
  htm_lastFelt(); 
  htm_PanlBund($pmpt='@Gem',$subm=true);
  SpalteBund(); # 1. spalte
}

######### :LAGER:
function Panl_Vare_Priser() { ## out_PanlsPrim.php
  htm_Panl_Top($name= 'varekortform3',$capt= '@Enheds Priser:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW240',__FUNCTION__);
  htm_FrstFelt('70%');
  htm_CombFelt($type='tal2dc',  $name='enhdpris', $valu= $enhdpris,   $labl='@Salgspris',              $titl='@Netto almindelig salgspris', $revi=true, $rows='2',$width='',$step='');
  htm_NextFelt('30%');
  htm_CombFelt($type='tal2dc',  $name='avanc1',   $valu= $avanc1,     $labl='@Avance',                 $titl='@Kalkuleret avance i forhold til kostpris', $revi=false, $rows='2',$width='',$step='');
  htm_lastFelt(); 
  
  htm_FrstFelt('70%');
  htm_CombFelt($type='tal2dc',  $name='enhdengr', $valu= $enhdengr,   $labl='@B2B salgspris',          $titl='@Engros salgspris', $revi=true, $rows='2',$width='',$step='' );
  htm_NextFelt('30%');
  htm_CombFelt($type='tal2dc',  $name='avanc1',   $valu= $avanc1,     $labl='@Avance',                 $titl='@Kalkuleret avance i forhold til kostpris', $revi=false, $rows='2',$width='',$step='');
  htm_lastFelt(); 
  
  htm_FrstFelt('70%');
  htm_CombFelt($type='tal2dc',  $name='enhdlist', $valu= $enhdlist,   $labl='@Vejledende pris',        $titl='@Listepris', $revi=true, $rows='2',$width='',$step='' );
  htm_NextFelt('30%');
  htm_CombFelt($type='tal2dc',  $name='avanc1',   $valu= $avanc1,     $labl='@Avance',                 $titl='@Kalkuleret avance i forhold til kostpris', $revi=false, $rows='2',$width='',$step='');
  htm_lastFelt(); 
  
  htm_FrstFelt('70%');
    htm_CombFelt($type='tal2dc',$name='enhdansk', $valu= $enhdansk,   $labl='@Kostpris',               $titl='@Anskaffelses pris', $revi=true, $rows='2',$width='',$step='' );
  htm_NextFelt('30%');
  htm_lastFelt(); 
  htm_PanlBund($pmpt='@Gem',$subm=true);
}


######### :LAGER:
# Kaldes fra:  [_lager/page_Varemodtagelse.php] 
function Panl_Varemodtagelse(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'varemodtform',$capt= '@Vare modtagelse:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-pen-square','panelWmax',__FUNCTION__);
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Her kan du vælge',   '200px',    'html',    '', '',      '',    '@blandt tidligere varemodtagelser'],
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Nr.',            '5%','indx','',  ['left'],  '@Entydig nummerkode..','@Id...'],
          ['@Dato',          '12%','date','',  ['left'],  '@Listens oprettelsesdato','@Dato [YYYY-MM-DD]'],
          ['@Oprettet af',   '15%','text','',  ['left'],  '@Initialer for den som har oprettet listen','@Opret...'],
          ['@Bemærkning',    '35%','text','',  ['left'],  '@Tilknyttet note','@Bem...'],
          ['@Modtaget af',   '15%','text','',  ['left'],  '@Initialer for den som har modtaget varerne','@Modt...'],
          ['@Modtaget dato', '14%','date','',  ['left'],  '@Modtagelses datoen','@Dato [YYYY-MM-DD]'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
//    &$DATA=   array(
//       ),
    $TablData= [[1,'Dato','Oprettet','Bemærkning','Modtaget','Modtaget'],
                  [2,'Dato','Oprettet','Bemærkning','Modtaget','Modtaget'],
                  [3,'Dato','Oprettet','Bemærkning','Modtaget','Modtaget']], 
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,      # Mulighed for at oprette en record
    $ModifyRec=true,      # Mulighed for at ændre data i en row
    $ViewHeight= '150px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
//  htm_CentrOn(); htm_nl();
//    textKnap($label='@Ny modtageliste',  $title='@Klik her for at oprette en vareregistrering',$link='../_base/page_Blindgyden.php');
//    textKnap($label='@Vis alle lister',  $title='@Klik her for at se alle lister, (Filteret nulstilles)',$link='../_base/page_Blindgyden.php');
//  htm_CentOff();

  htm_nl();
//  htm_hr();
  Panl_Vareliste();
  VareRegler();
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
}

######### :LAGER:
function VareRegler() {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'lagrform',$capt= '@Gammel forklaring:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW480',__FUNCTION__);
  echo tolk('@Gammel ikke opdateret forklaring om lagerstyring:'); htm_nl();
//  *********************************** Når en vare leveres og faktureres inden varemodtagelse ******************************************
htm_Caption('@Når en vare leveres og faktureres inden varemodtagelse.');
htm_Plaintxt('@Når en indkøbsordre godkendes skrives der for hver varelinje, en tilsvarende linje (A) i tabellen RESERVATION.');
htm_Plaintxt('@Varelinjens ID angives i [linje_id], varens ID i [vare_id], 0 i [batch_salg_id] og vareantal i [antal]');

htm_Plaintxt('@Når en vare reserveres i en salgsordre, oprettes ligeledes en linje (B) i RESERVATION.');
htm_Plaintxt('@[linje_id] og [vare_id] kopieres fra linjen fra indkøbsordren, varelinjens id angives med negativt fortegn i [batch_salg_id] og reserveret antal angives i [antal]');

htm_Plaintxt('@Når varen leveres oprettes en linje (C) i BATCH_SALG');
htm_Plaintxt('@Her angives salgs ordre ID i [ordre_id], vare_id i [vare_id], ordrelinje ID i [linje_id], leveringsdato i [salgsdate] og leverance nummer i [lev_nr] ');
htm_Plaintxt('@i linje A ændres [batch_salg_id] til linje ID fra C.');

htm_Plaintxt('@Når salgsordren faktureres oprettes en linje (D) i BATCH_KOB. (hvis [batch_kob] i A er tom)');
htm_Plaintxt('@Her angives købs ordre ID i [ordre_id], vare_id i [vare_id] og salgspris i [pris]. Linje ID aflæses. (hvis [batch_kob] i A er tom)');
htm_Plaintxt('@I linje A og alle øvrige linjer med samme værdi i [linje_id] angives linje ID fra D i [batch_kob]. (hvis [batch_kob] i A er tom)');
htm_Plaintxt('@I linje C angives linje ID fra D i [batch_kob], salgspris i [pris], og fakturadato i [fakturadate] ');
htm_Plaintxt('@I tabellen ordrelinjer tilføjes 2 linjer. Her angives ');
htm_Plaintxt('@1. værdien -1 i [posnr], værdien fra [pris] i D i [pris], ordre-id i [ordre_id], "lager afgang" i [bogf_konto] og antal i [antal]');
htm_Plaintxt('@2. værdien -1 i [posnr], værdien fra [pris] i D med negativt fortegn i [pris], ordre-id i [ordre_id], "varekøb" i [bogf_konto] og antal i [antal]');

htm_Plaintxt('@Ved bogføring af salgsordre krediteres værdien fra [pris] i D på "lager afgang" og debiteres på "varekøb". Salgssummen krediteres på varesalg og debiteres på Kunden.');

htm_Plaintxt('@Når varen modtages:');
htm_Plaintxt('@I linje D angives antal i [antal] Reserveret antal fra linjer med samme værdi som A i [linje_id] og [batch_køb]').' ';
htm_Plaintxt('@hvor [batch_salg] er positiv trækkes fra og restantal angives i [rest]. Leveringsdato angives i [salgsdate].');
htm_Plaintxt('@Linje A og alle linjer med samme værdi i [linje_id] og [batch_køb] hvor [batch_salg] er positiv slettes.');
htm_Plaintxt('@I alle linjer med samme værdi i [linje_id] og [batch_køb] hvor [batch_salg] er negativ anføres værdien fra [batch_salg] i linje_id og [batch_salg] rettes til 0.');

htm_Plaintxt('@Når indkøbsordren afsluttes til bogføring:');
htm_Plaintxt('@I linje C beregnes differensen mellem indkøbsprisen og prisen angivet i [pris]. [pris] rettes til indkøbsprisen. Fakturadato angives i [Fakturadate]');
htm_Plaintxt('@I tabellen ordrelinjer tilføjes 2 linjer. Her angives');

htm_Plaintxt('@1. værdien -1 i [posnr], differencen fra [pris] i C med negativt fortegn i [pris], ordre-id i [ordre_id], "varekøb" i [bogf_konto] og antal-rest i [antal]');
htm_Plaintxt('@2. værdien -1 i [posnr], differencen fra [pris] i C i [pris], ordre-id i [ordre_id], "lager afgang" i [bogf_konto] og antal-rest i [antal]');

htm_Plaintxt('@Ved bogføring af salgsordre krediteres differencen på "varekøb" og debiteres på "lager afgang". Købssummen krediteres på kunden og debiteres på "Lager tilgang".');

//  *************************** Når en vare leveres og faktureres efter varemodtagelse og før indkøbsordre bogføres ******************************
htm_Caption('@Når en vare leveres og faktureres efter varemodtagelse og før indkøbsordre bogføres');
htm_Plaintxt('@Når en indkøbsordre godkendes skrives der for hver varelinje, en tilsvarende linje (A) i tabellen RESERVATION.');
htm_Plaintxt('@Varelinjens ID angives i [linje_id], varens ID i [vare_id], 0 i [batch_salg_id] og vareantal i [antal]');

htm_Plaintxt('@Når varen modtages:');
htm_Plaintxt('@Der oprettes en linje (B) i BATCH_KOB.');
htm_Plaintxt('@Her angives købs ordre ID i [ordre_id], vare_id i [vare_id], antal i [antal], antal i [rest], leveringsdato i [salgsdate].');

htm_Plaintxt('@Når en vare reserveres i en salgsordre, oprettes en linje (C) i RESERVATION.');
htm_Plaintxt('@I C angives varelinjens ID i [linje_id], vare ID  i [vare_id], antal i [antal] og ID fra B i [batch_salg_id].');

htm_Plaintxt('@Når varen leveres oprettes en linje (D) i BATCH_SALG');
htm_Plaintxt('@Her angives salgs ordre ID i [ordre_id], vare_id i [vare_id], ordrelinje ID i [linje_id], ID fra B i [batch_kob_id], leveringsdato i [salgsdate] og leverance nummer i [lev_nr] ');

htm_Plaintxt('@Når salgsordren faktureres ');
htm_Plaintxt('@I linje D angives salgspris i [pris], og fakturadato i [fakturadate]');
htm_Plaintxt('@I linje B angives salgspris i [pris] men KUN hvis dette felt er tomt.');
htm_Plaintxt('@I tabellen ordrelinjer tilføjes 2 linjer. Her angives');
htm_Plaintxt('@1. værdien -1 i [posnr], værdien fra [pris] i D i [pris], ordre-id i [ordre_id], "lager afgang" i [bogf_konto] og antal i [antal]');
htm_Plaintxt('@2. værdien -1 i [posnr], værdien fra [pris] i D med negativt fortegn i [pris], ordre-id i [ordre_id], "lager afgang" i [bogf_konto] og antal i [antal]');
 
htm_Plaintxt('@Ved bogføring af salgsordre krediteres værdien fra [pris] i D på "lager afgang" og debiteres på "varekøb". Salgssummen krediteres på varesalg og debiteres på Kunden.');


htm_Plaintxt('@Når indkøbsordren afsluttes til bogføring:');
htm_Plaintxt('@I linje B beregnes differensen mellem indkøbsprisen og prisen angivet i [pris]. [pris] rettes til indkøbsprisen. Fakturadato angives i [Fakturadate]');

htm_Plaintxt('@Ved bogføring af salgsordre krediteres differencen på "varekøb" og debiteres på "lager afgang". Købssummen krediteres på kunden og debiteres på "Lager tilgang".');

//  *************************** Når en vare leveres og faktureres efter varemodtagelse og bogføring af indkøbsordre ******************************
htm_Caption('@Når en vare leveres og faktureres efter varemodtagelse og bogføring af indkøbsordre');
htm_Plaintxt('@Når en indkøbsordre godkendes skrives der for hver varelinje, en tilsvarende linje (A) i tabellen RESERVATION.');
htm_Plaintxt('@Varelinjens ID angives i [linje_id], varens ID i [vare_id], 0 i [batch_salg_id] og vareantal i [antal]');

htm_Plaintxt('@Når varen modtages:');
htm_Plaintxt('@Der oprettes en linje (B) i BATCH_KOB.');
htm_Plaintxt('@Her angives købs ordre ID i [ordre_id], vare_id i [vare_id], antal i [antal], antal i [rest], leveringsdato i [salgsdate].');

htm_Plaintxt('@Når indkøbsordren afsluttes til bogføring:');
htm_Plaintxt('@I linje B angives indkøbsprisen i [pris]. Fakturadato angives i [Fakturadate]');

htm_Plaintxt('@Ved bogføring af salgsordre krediteres købssummen på Leverandøren og debiteres på "Lager tilgang".');

htm_Plaintxt('@Når en vare reserveres i en salgsordre, oprettes en linje (C) i RESERVATION.');
htm_Plaintxt('@I C angives varelinjens ID i [linje_id], vare ID  i [vare_id], antal i [antal] og ID fra B i [batch_salg_id].');

htm_Plaintxt('@Når varen leveres oprettes en linje (D) i BATCH_SALG');
htm_Plaintxt('@Her angives salgs ordre ID i [ordre_id], vare_id i [vare_id], ordrelinje ID i [linje_id], ID fra B i [batch_kob_id], leveringsdato i [salgsdate] og leverance nummer i [lev_nr]');

htm_Plaintxt('@Når salgsordren faktureres ');
htm_Plaintxt('@I linje D angives salgspris i [pris], og fakturadato i [fakturadate]');

htm_Plaintxt('@Ved bogføring af salgsordre krediteres værdien fra [pris] i B på "lager afgang" og debiteres på "varekøb". Salgssummen krediteres på varesalg og debiteres på Kunden.');

//  *************************** Når en vare leveres før varemodtagelse og faktureres før bogføring af indkøbsordre ******************************
htm_Caption('@Når en vare leveres før varemodtagelse og faktureres før bogføring af indkøbsordre');
htm_Plaintxt('@Når en indkøbsordre godkendes skrives der for hver varelinje, en tilsvarende linje (A) i tabellen RESERVATION.');
htm_Plaintxt('@Varelinjens ID angives i [linje_id], varens ID i [vare_id] og vareantal i [antal]');

htm_Plaintxt('@Når en vare reserveres i en salgsordre, oprettes ligeledes en linje (B) i RESERVATION.');
htm_Plaintxt('@[linje_id] og [vare_id] kopieres fra linjen fra indkøbsordren, varelinjens id angives med negativt fortegn i [batch_salg_id] og reserveret antal angives i [antal]');

htm_Plaintxt('@Når varen leveres oprettes en linje (C) i BATCH_SALG');
htm_Plaintxt('@Her angives salgs ordre ID i [ordre_id], vare_id i [vare_id], ordrelinje ID i [linje_id], 0 i [batch_kob_id], leveringsdato i [salgsdate] og leverance nummer i [lev_nr]');
htm_Plaintxt('@i linje B ændres [batch_salg_id] til linje ID fra C.');

htm_Plaintxt('@Når varen modtages oprettes en linje (D) i BATCH_KOB.');
htm_Plaintxt('@Her angives købs ordre ID i [ordre_id], vare_id i [vare_id] og ordrelinje ID i [linje_id]. Linje ID aflæses. (hvis [batch_kob] i A er tom)');
htm_Plaintxt('@Reserveret antal fra linjer med samme værdi som A i [linje_id] og [batch_køb]').' ';
htm_Plaintxt('@hvor [batch_salg] er positiv trækkes fra og restantal angives i [rest]. Leveringsdato angives i [salgsdate].');
htm_Plaintxt('@Linje A og alle linjer med samme værdi i [linje_id] og [batch_køb] hvor [batch_salg] er positiv slettes.');
htm_Plaintxt('@I alle linjer med samme værdi i [linje_id] og [batch_køb] hvor [batch_salg] er negativ ').' ';
htm_Plaintxt('@anføres værdien fra [batch_salg] i linje_id, [batch_kob] rettes til ID fra D og [batch_salg] rettes til 0.');

htm_Plaintxt('@Når salgsordren faktureres: ');
htm_Plaintxt('@I linje C angives linje ID fra D i [batch_kob], salgspris i [pris], og fakturadato i [fakturadate].');
htm_Plaintxt('@I linje D angives salgspris i [pris] (KUN hvis [pris] er tom)');
htm_Plaintxt('@Ved bogføring af salgsordre krediteres værdien fra [pris] i D på "lager afgang" og debiteres på "varekøb". Salgssummen krediteres på varesalg og debiteres på Kunden.');

htm_Plaintxt('@Når indkøbsordren afsluttes til bogføring:');
htm_Plaintxt('@I linje D beregnes differensen mellem indkøbsprisen og prisen angivet i [pris]. [pris] rettes til indkøbsprisen. Fakturadato angives i [Fakturadate]');
htm_Plaintxt('@Ved bogføring af salgsordre krediteres differencen på "varekøb" og debiteres på "lager afgang". Købssummen krediteres på kunden og debiteres på "Lager tilgang".');

htm_PanlBund($pmpt='@Gem',$subm=false);
}

######### :LAGER:
function Panl_Vareliste() {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'varelistform',$capt= '@Modtage liste:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-pen-square','panelW480',__FUNCTION__);
  //echo '<tc><b>'.  tolk('@Posteringer:').' &nbsp;'.tolk('@i liste Id: 2').'</b></tc><br>'; 
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Viser modtage-liste:', '15%', 'show', '', 'left', '@Her inddaterer du de enkelte varelinier', '@Nr: 2 ']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Varenr.',       '8%','indx','', ['left'  ], '@Entydigt varenummer','@Vare...'],
          ['@Antal',         '6%','text','', ['center'], '@Vare antallet','@Antal...'],
          ['@Beskrivelse',  '36%','text','', ['left'  ], '@Vare beskrivelse, svarende til det angivne varenr.','@auto...'],
          ['@Leveret',      '25%','text','', ['left'  ], '@Dato for levering, udfyldes automatisk med dags dato, men du kan korrigere den.','@auto...'],
          ['@Lager',        '25%','text','', ['left'  ], '@Lageret hvor varen er tilknyttet, ved varens oprettelse','@auto...'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
          []
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $TablData= [[1001,'Antal','Beskrivelse','Leveret','Lager'],[1002,'Antal','Beskrivelse','Leveret','Lager'],
                [1003,'Antal','Beskrivelse','Leveret','Lager'],[1004,'Antal','Beskrivelse','Leveret','Lager']], # 'Varenr.','Antal','Beskrivelse','Leveret','Lager'
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '200px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_CentrOn();
    textKnap($label='@Gem modtageliste',  $title='@Klik her for at gemme vareregistreringen',$link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
}


######### :LAGER:
# Kaldes fra:  [_lager/page_Varemodtagelse.php] [_lager/page_Varer.php] 
function wall_Varekort(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */)  ## out_PanlsSekd.php
{global $Ønovice;   //  Skal ændre til page_...
  $varenr= '80110';
  $enhdpris= '1596.00';
  $enhdlist= '1800';
  $enhdansk= '1500';
  
  htm_Tapet_Top($name= 'varekortform',$capt= '@Varekort: ',$parms='page_Blindgyden.php',$icon='far fa-file-alt','panelW120',__FUNCTION__);
  htm_nl();
  htm_CentrOn(); 
//    textKnap($label='@<= Se forrige',   $title='@Klik her for at vise forrige varenummer',$link='../_base/page_Blindgyden.php');
    htm_Caption('@Varenummer: '.$varenr);
//    textKnap($label='@Se næste =>',     $title='@Klik her for at vise næste varenummer',$link='../_base/page_Blindgyden.php');
  htm_CentOff();
  
  SpalteTop(400); # 1. spalte
  Panl_Vare_Generelt();
  
  NextSpalte(400);
  Panl_Vare_Specielt();
  
  SpalteTop(240); # 2. spalte
  Panl_Vare_Priser();
  Panl_Vare_Tilbud();
  Panl_Vare_Rabatter();  
  NextSpalte(320); # 2. spalte
  Panl_Vare_Enheder();
  Panl_Vare_Beholdning();
  Panl_Vare_Grupper();
  NextSpalte(400); # 3. spalte
  Panl_Vare_Kategorier();
  Panl_Vare_Varianter();
  Panl_Vare_Dele();
  SpalteBund(); # 3. spalte
  
  htm_hr();
  htm_CentrOn();
    textKnap($label='@Ny Modtage liste',  $title='@Klik her for at oprette en ny modtagelse',$link='../_lager/page_Varemodtagelse.php');
    textKnap($label='@Leverandøropslag',  $title='@Opslag - Se ...',$link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_TapetBund($pmpt='@Retur til vareliste',$subm=true,$title='@Retur til vareliste');
  htm_hr();
  Panl_Leverandorer();
  htm_hr();
  Panl_Varemodtagelse();
  PanelInitier(2,15);
  //for ($x = 2; $x <= 15; $x++) PanelMin($x);  //  Minimer 3. til 15. panel, så kun 1. og 2. panel er maksimeret
}   //  wall_Varekort

######### :LAGER:
function Panl_Vare_Generelt() { ## out_PanlsSekd.php
  htm_Panl_Top($name= 'varekortform1',$capt= '@Generelt:',$parms='page_Blindgyden.php',$icon='far fa-file-alt','panelW400',__FUNCTION__);
  htm_CombFelt($type='text',  $name='varenumr', $valu= $varenumr=$varenr='80100',   $labl='@Varenummer', 
      $titl='@Ved oprettelse at en ny vare, skal først angives et varenummer. Det frarådes at ændre varenumre, når de er taget i brug.'.'<br>'. 
      tolk('@Hvis varenummer rettes, ændres det i alle uafsluttede ordrer, tilbud, indkøbsforslag og indkøbsordrer.').'<br>'. 
      tolk('@Bemærk at hvis der er brugere, som er ved at redigere en ordre, kan dette bevirke at varenummeret ikke ændres i den pågældende ordre.').'<br>'. 
      tolk('@Det anbefales derfor at tilse at øvrige brugere lukker alle ordrevinduer.').'<br>'. 
      tolk('@Ændring af varenummer har ingen indflydelse på varestatistik eller andet, bortset fra at varen vil figurere med det gamle varenummer i ordrer som er afsluttet før ændringsdatoen.').'<br>'. 
      tolk('@Det er også muligt at sammenlægge 2 varenumre til 1. Her skal du skrive det varenummer, som du vil lægge denne ind i og sætter et lighedstegn foran, f.eks.: "=100", ').'<br>'. 
      tolk('@Så vil al historik mm, varebeholdning og evt.leverandør og shop bindinger blive lagt sammen til 1 vare, og varenr vil blive slettet.'),
      $revi=true, $rows='2',$width='',$step='', $more='required="required"', $plho=tolk('@V.nr......'));
  htm_CombFelt($type='text',  $name='varebesk', $valu= $varebesk='Træbriketter - 96 pk. a 10 kg. = 960 kg ',   $labl='@Beskrivelse', 
      $titl='@Angiv en tekst der beskriver produktet. Det er den tekst, som foreslås på ordrelinjerne i købs- og salgsordrer.',   
      $revi=true, $rows='2',$width='',$step='', $more='required="required"', $plho=tolk('@Beskrivelse...'));
  htm_CombFelt($type='text',  $name='varemrk', $valu= $varemrk,   $labl='@Varemærke',   
      $titl='@Angiv en tekst der beskriver varemærket',  
      $revi=true, $rows='2',$width='',$step='' );
  $genlstrg= 'STREGKODE';
  htm_FrstFelt('50%');    htm_CombFelt($type='text',  $name='genlstrg', $valu= $genlstrg, $labl='@Stregkode', 
      $titl='@Angiv en tekst, som skal benyttes som stregkode, Den vises i feltet til højre herfor.', 
      $revi=true, $rows='2',$width='',$step='' );
  $genlkode= '*'.$genlstrg.'*';
  htm_NextFelt('50%');    htm_CombFelt($type='barc',  $name='genlkode', $valu= $genlkode, $labl='',           
      $titl='@Her vises stregkoden', 
      $revi=true, $rows='2',$width='',$step='', $more='', $plho='--STREGKODE-- vises her.');
  htm_lastFelt(); 
  htm_PanlBund($pmpt='@Gem',$subm=true);
}
  

######### :LAGER: ######### Slut funktioner angående visninger i menu-gruppen LAGER


######### :PRODUKTION: ######### Start funktioner angående visninger i menu-gruppen PRODUKTION
  //  Ingen endnu - Reserveret 
######### :PRODUKTION: ######### Slut funktioner angående visninger i menu-gruppen PRODUKTION









################################################
################################################
################################################
################################################

#+  ? >:SPLITSLUT SPLITSTART:<?php   $DocFil= '../_base/out_PanlsSekd.php';   $DocVer='5.0.0';    $DocRev='2018-09-30';   $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Design af panelers layout. Del-3';
 * Del-3 af redigeringsfilen: '../_base/out_Panls.php'
   HUSK AT DENNE FIL SKAL OPDATERES, PÅ GRUNDLAG AF DEN FÆLLES REDIGERINGSFILS (out_Panls.php) INDHOLD !!!
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2018 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 * Design af panelers layout.
 * Panel-moduler egnet for adaptivt skærm-output.
 *
 * Afhængig af: out_base.php
 *  
 * Filer er redigeret med tabulator sat til 2 tegn, og linielængde max. 200 tegn. De ses bedst med det.
 * Filer skal gemmes i UTF-8 format uden BOM!
 *
  Oprettet: 2018-08-00 evs - EV-soft    #: Dette bibliotek er udviklet 2016-1018 af EV-soft.
  Ændrings-Log:

  
 * 
 */
DocAlder($DocRev);



######### :SYSTEM: ######### Start funktioner angående visninger i menu-gruppen SYSTEM

######### :SYSTEM:
# Kaldes fra:  [_base/page_Install.php] [_base/page_Startup.php] [_system/page_Connsetup.php] 
function Panl_Login(&$regnskab,&$brugernavn,&$brugerkode,&$ProgVers,&$LnkHelp,&$OrgaName,&$Logo,$VisMax=true) { ## out_PanlsPrim.php
  global $ØProgTitl, $ØprogSprog;
  htm_FormLocal($name='sprogform'); //  Angår: Select SprogValg                           ../_base/page_Hovedmenu.php
  htm_Panl_Top($name='logiform',$capt=Tolk('@Logind til').' <i>'.$regnskab.'</i>',$parms='#',
        $icon='fas fa-key',$klasse='panelW320',__FUNCTION__); # < ? php echo htmlspecialchars($_SERVER["PHP_SELF"]);? >
  echo '<table width="100%" cellspacing="0"><tr align="center">';
  $FaLogo= '../_assets/images/'.$Logo;
  if ($VisMax) {
    if (file_exists($FaLogo)) 
      echo '<tr align="center" title="SALDI-euro - '.tolk('@Det frie danske økonomisystem').
            '" style="cursor: help;"><td colspan="3" height="40px">'.
            '<img style="border:0px solid;width:120px;heigth:80px" alt="LOGO" src="'.$FaLogo.'"></td></tr>';
    echo '<td> <small><small>'.$ØProgTitl.'</small></small></td>';
    echo '<td align="center">'.ucfirst(tolk('@Vært:')).'&nbsp; <b>'.$OrgaName.'</b></td>';
    echo '<td align="right"><small><small>Vers.'.$ProgVers.'</small></small> </td>';
    if (($LnkHelp) and ($brugernavn))
      echo '<tr align="center"><td colspan="3"><br/><small><small>'.tolk('@Huske TIP:').' </small> '.$LnkHelp.' </small></td></tr>';
    echo '</tr></table><br>';
  }

  htm_CombFelt($type='text',    $name='regn', $valu= $regnskab,   $labl='@Regnskab',    
          $titl='@Angiv navnet på det Regnskab, som du har adgang til',
          $revi=true, $rows='2',$width='',$step='', $more='required="required" ', $plho=tolk('@Regnskab...'));
  htm_CombFelt($type='text',    $name='navn', $valu= $brugernavn, $labl='@Brugernavn',  
          $titl=tolk('@Angiv dit').$ØProgTitl.' '.tolk('@Brugernavn'),
          $revi=true, $rows='2',$width='',$step='', $more='required="required" ', $plho=tolk('@Bruger...'));
  htm_CombFelt($type='password',$name='kode', $valu= $brugerkode, $labl='@Adgangskode', 
          $titl='@Angiv den gyldige adgangskode hørende til Brugernavnet. 4-20 tegn - STORE/små bogstaver, cifre, samt spec.tegn - SKAL benyttes',  
          $revi=true, $rows='2',$width='',$step='', 
          $more=''.//required="required" pattern="((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&_æøåÆØÅ]).{4,20})" '.
                'title="4..20 tegn accepteres, STORE/små bogstaver, cifre 0-9, samt spec.tegn %&¤#! - SKAL benyttes!" ', $plho=tolk('@Password...'));    
  //  Password (UpperCase, LowerCase, Number/SpecialChar and min 8 Chars):  (?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$
#  echo '<div style="text-align: center"><br><small><small> /da:Sprog/en:Language/de:Sprache/fr:Langue/tr:Dil/es:Lenguaje</small></small></div>';
  htm_CentrOn();
    textKnap($label='@Log ind',  $title=tolk('@Gå videre til').$ØProgTitl.' '.tolk('@regnskabet'), $link='../_base/page_Hovedmenu.php');
  htm_CentOff();
  htm_nl();  htm_hr();
  if ($VisMax) { 
    htm_Caption('@Eller vælg:'); 
    SprogValg($ØprogSprog,$formName='sprogform'); 
  }
  htm_CentrOn();
  textKnap($label='@Glemt adgangskode?',  $title='@Få tilsendt mail, angående nulstilling af password', $link='../_base/page_Blindgyden.php');
  textKnap($label='@Opret ny bruger?',    $title='@Registrer dig som ny bruger',                        $link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_nl();  
  htm_PanlBund($pmpt=Tolk('@Log ind'),$subm=false,$title=tolk('@Gå videre til').$ØProgTitl.' '.tolk('@regnskabet'));
}


######### :SYSTEM:
# Kaldes fra:  [_system/page_Connsetup.php] 
function Panl_Connsetup() {  ## out_PanlsPrim.php
  htm_Panl_Top($name='forbind',$capt='@DB forbindelse:',$parms='page_Blindgyden.php',$icon='fas fa-key',$klasse='panelW480',__FUNCTION__);
                        htm_CombFelt($type='text',  $name='firmanavn',  $valu= $firmanavn,  $labl='@Firmanavn',   
               $titl='@Navnet på det firma, regnskabet angår. Kan benyttes i CVR-opslag, til at importere Erhvervsstyrelsens offentlige data');
  htm_FrstFelt('50%');  htm_CombFelt($type='text',  $name='addr1',      $valu= $addr1,      $labl='@Adresse',     $titl='@Firmaets adresse');
  htm_NextFelt('50%');  htm_CombFelt($type='text',  $name='addr2',      $valu= $addr2,      $labl='@Sted',        $titl='@Supplerende stedsangivelse');
  htm_LastFelt();                                                                           
  htm_FrstFelt('25%');  htm_CombFelt($type='text',  $name='postnr',     $valu= $postnr,     $labl='@Postnr.',     $titl='@Postnr');
  htm_NextFelt('75%');  htm_CombFelt($type='text',  $name='bynavn',     $valu= $bynavn,     $labl='@Bynavn',      $titl='@Bynavn. firmaets hjemsted');
  htm_LastFelt();                                                                           
  htm_FrstFelt('50%');  htm_CombFelt($type='mail',  $name='ny_email',   $valu= $ny_email,   $labl='@Mail',        $titl='@Firmaets Mail-adresse');
  htm_NextFelt('50%');  htm_CombFelt($type='text',  $name='homepage',   $valu= $homepage,   $labl='@Hjemmeside',  $titl='@Firmaets hjemmeside-adresse');
  htm_LastFelt();                                                                           
                        htm_CombFelt($type='text',  $name='bank_navn',  $valu= $bank_navn,  $labl='@Bank',        $titl='@Bank forbindelse');
  htm_FrstFelt('25%');  htm_CombFelt($type='text',  $name='bank_reg',   $valu= $bank_reg,   $labl='@Bank reg.',   $titl='@Bank reg.');
  htm_NextFelt('75%');  htm_CombFelt($type='text',  $name='bank_konto', $valu= $bank_konto, $labl='@Bank konto',  $titl='@Bank konto');
  htm_LastFelt();
                        htm_CombFelt($type='text',  $name='cvrnr',      $valu= $cvrnr,      $labl='@CVR',         
                      $titl='@CVR - Virksomheds ID. Kan benyttes i CVR-opslag, til at importere Erhvervsstyrelsens offentlige data');
  htm_FrstFelt('50%');  htm_CombFelt($type='text',  $name='tlf',        $valu= $tlf,        $labl='@Telefon.',    
                      $titl='@Telefonnr. - Kan benyttes i CVR-opslag, til at importere Erhvervsstyrelsens offentlige data');
  htm_NextFelt('50%');  htm_CombFelt($type='text',  $name='fax',        $valu= $fax,        $labl='@Fax',         $titl='@Firmaets fax');
  htm_LastFelt();
  if (!$pbs_nr) {
    htm_FrstFelt('40%');  htm_CombFelt($type='text',$name='pbs_nr',     $valu= $pbs_nr,     $labl='@PBS Kreditornr.', $titl='@Firmaets pbsnr');
    htm_NextFelt('60%');  {if      ($pbs=='B') $listen= array(['','B','@Basis løsning'], ['','', '@Total løsning'], ['','L','@Lev. Service']);
                           elseif  ($pbs=='L') $listen= array(['','L','@Lev. Service'],  ['','B','@Basis løsning'], ['','', '@Total løsning']);
                           else                $listen= array(['','', '@Total løsning'], ['','B','@Basis løsning'], ['','L','@Lev. Service']);
                           htm_OptioFlt($type='text',$name='pbs',       $valu= $pbs,        $labl='@Aftale',      $titl='@Vælg den aftalte løsning',  $revi=true, $optlist= $listen, $action='');
                          }
    htm_LastFelt();
  } else  htm_CombFelt(             $type='text',  $name='pbs_nr', $valu= $pbs_nr, $labl='@PBS Kreditornr.',   $titl='@Firmaets pbsnr');
  htm_CombFelt(                     $type='text',  $name='gruppe', $valu= $gruppe, $labl='@PBS debitorgruppe', $titl='@Gruppe ');
  htm_CombFelt(                     $type='text',  $name='fi_nr',  $valu= $fi_nr,  $labl='@FI Kreditornr.',    
                      $titl='@Bankernes fælles indbetalingskort (FI-kort). Her angiver du dit FI Kreditornr.');
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :SYSTEM:
# Kaldes fra: 
function SetHeadArr($frmNr='4',$x1='',$x2='@Dansk',$x3='@A4 portrait') { global $ØBtNewBgrd;  ## outxx.php
  $copyknap= '<button type="button" id="btnCopy" onclick="varcopy()" style="background-color:'.$ØBtNewBgrd.'" title="'.    //  varcopy() erklæres i htm_pagePrepare.php
    tolk('@Klik her, for at kopiere det valgte variabelnavn til kopieringsbuffer, så du kan indsætte det i et beskrivelses felt').
    '">&nbsp;<ic class="fas fa-copy" style="font-size:15px;"> </ic> Copy </button>';
  if ($x1=='@Ordrelinjer') {$extra= [str_sp(4). tolk('@Variabler:'), '18%','html','','left', '', 
    htm_SelectStr($name='copytxt',$valu='VALU',OrdrVars($frmNr),'max-width:200px; background-color:white;" title="'.
      tolk('@Her kan du vælge blandt de brugbare variabelnavne angående ordrelinier'),false).$copyknap];} 
  else
  if ($x1=='@Tekster') {$extra= [str_sp(4). tolk('@Variabler:'), '16%','left','html', '', 
    htm_SelectStr($name='copytxt',$valu='VALU',FormVars($frmNr),'max-width:200px; background-color:white;" title="'.
      tolk('@Her kan du vælge blandt de brugbare variabelnavne angående tekster'),false).$copyknap];} 
    else $extra= ['','0%','','html','',''];
  return  array(   # $HeadLine= array([0:Labl, 1:Width, 2:Just, 3:InpType, 4:Tip, 5:placeholder])
  // #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder'
    ['@Formular:',  '7%','show','','left', '@Du redigerer denne formular', ListLookup($liste=FRM_Liste(),$search= $x0,$colsearch=1,$colresult=2)],
    ['@Art:',       '7%','show','','left', '@Du redigerer denne art', $x1],
    ['@Sprog:',     '4%','show','','left', '@Du redigerer formular med dette sprog', ListLookup($liste=SPR_Liste(),$search= $x2,$colsearch=1,$colresult=2)],
    ['@Format:',    '6%','show','','left', '@Du redigerer formular med denne sidestørrelse', ListLookup($liste=PaprListe(),$search= $x3,$colsearch=1,$colresult=2)],
    $extra
  );
}
  
######### :SYSTEM:
//  Tilpas feltrækkefølge for de forskellige arter:
# Kaldes fra: 
function GetFormdata($frm,$art,&$layout,&$stempel,&$grafik,&$images,&$tekster,&$ordrlin) {   ## outxx.php
// Functionen er udgået... #../_system/save_Formularer.php erstatter
  $tekster= []; $grafik= []; $images= []; $ordrlin= []; $stempel= []; $layout= [];
//  $DATA= sql_readB('SELECT form, frm_art, side, besk, just, FORMAT(x0,0), FORMAT(y0,0), FORMAT(dx,0), FORMAT(dy,0), FORMAT(dim,0), colr, font, style, imglnk, lngkey, note FROM tblA_forms ',__FILE__, __LINE__);
    $filDATA= ImportTabFile(realpath($_SERVER["DOCUMENT_ROOT"]). '/saldi-e/_exchange/_standard/formularer.v50.tab');  //  Ny version 5.0
  //  0:Form	1:Art	2:Side	3:Beskr	4:Just	5:X0	6:Y0	7:dx	8:dy	9:Hgt	10:Wdt	11:Colr	12:Font	13:Style	14:Src	15:LngKey	16:Note
  foreach ($filDATA as $rec)  //  Konvertering fra -- fil-format: 0:Form	1:Art	2:Side	3:Beskr	4:Just	5:X0	6:Y0	7:dx	8:dy	9:Hgt	10:Wdt	11:Colr	12:Font	13:Style	14:Src	15:Key	16:Note -- til tabel-format:
  { //    0       1       2       3       4     5     6     7     8     9     10      11      12      13      14      15      16
    list($_form, $_art, $_side, $_besk, $_just, $_x0, $_y0, $_dx, $_dy, $_hgt, $_hgt, $_wdt, $_colr, $_font, $_style, $_link, $_key, $_note) = $rec;
    if ($frm==$_form) {  //  Analyser kun en formular:
      $bemr= [utf8_decode($_besk)];
      //  $_hgt= 10;
      $note= [stripslashes(utf8_decode($_note))];
      if ($_art==0) {  ##  Specielle:
          if ($_side=='G')  ## Layout: 3:Papir   5:AntalLinier   6:LinieLængde   8:LinieAfstand   // @Linie antal'    @Top-linie    @Linieafstand   @Tekst Bredde    15:@Note   ?Korrekt?
           { $layout= [ [$_x0],[$_y0],[$_dy],[$_hgt],$note ]; }
        else ## Vandmærke/Stempel: 3:@Tekst/$variabel  5:@X    6:@Y   7:@Højde   8:@Bredde   10:@Farve  4:@Just.  11:@Font  2:@Side   15:@Note  13:Style(bold)  13:Style(italic)   ?Korrekt?
        { $dat= [$bemr,[$_x0],[$_y0],[$_dy],[$_dx],[$_hgt],[$_wdt],[strtoupper($_just)],[$_colr],[$_side],[isbold($_font)],[isital($_font)],$note,[$_font],[$_colr]]; array_push($stempel, $dat); }
      }
      if ($_art==1) { ## Grafik: 5:@X-venstre  6:@Y-bund   7:@Højde    8:@Bredde   9:px-bredde  2:@Side   10:@Farve  13:@Filnavn   15:@Note   ?Korrekt?
         if ($_besk=='') { $dat= [[$_x0],[$_y0],[$_dx],[$_dy],[$_hgt], [$_wdt], [$_side],$note]; array_push($grafik, $dat); }  //  Lines (Uden beskrivelse)
         if ($_besk!='') { $dat= [[$_x0],[$_y0],[$_dx],[$_dy],[$_side],[$_style],$note]; array_push($images, $dat); }          //  Image (Med beskrivelse f.eks. LOGO)
      }
      if ($_art==2)   ## Tekster: 3:@Tekst/$variabel  5:@X    6:@Y   7:@Højde   8:@Bredde  9:Hgt 10:@Farve  4:@Just.  11:@Font  2:@Side   15:@Note  13:Style(bold)  13:Style(italic)   ?Korrekt?
         { $dat= [$bemr,[$_x0],[$_y0],[$_dy],[$_dx],[$_hgt],[$_wdt],[strtoupper($_just)],[$_colr],[$_side],[isbold($_font)],[isital($_font)],$note]; array_push($tekster, $dat); }
      if ($_art==3)   ## Ordrelinier: 3:@Feltnavn  5:@X-pos   7:@Højde   8:@Bredde   10:@Farve   4:@Just.   11:Font    Fed  Skrå  15:@Note:   ?Korrekt?
         { $dat= [$bemr,[$_x0],[$_dx],[$_dy],[$_wdt],[$_just],[$_colr],[isbold($_font)],[isital($_font)],$note]; array_push($ordrlin, $dat); }
    }
  }
  return $tekster;  // var_dump($tekster);
}


######### :SYSTEM:
# Kaldes fra: [_base\out_vinduer.php]
function Panl_OrdrePostering( &$data) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'ordreform',$capt= '@Indtastning af salgs ordre poster - `Ordrelinier`:',$parms='page_Blindgyden.php',$icon='fas fa-database','panelWmax',__FUNCTION__);
  htm_Table(
   $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        ['@Status:',          '60%','', 'text','left', '@Her kan skrives en bemærkning til ordren', '@Ny ordre, endnu uden kundetilknytning!'], 
        ['@Kundetilknytning:','5em','', 'text','left', '@Angiv kontonummer på kunden','@Konto...'], 
      ),
   $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      ),
   $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Pos.',        '5%', '', 'text', ['left'], tolk('@Position tildeles automatisk.').' ','Pos...'],
        ['@Varenr',     '10%', '', 'text', ['left'], '@Varenummer hentes fra vareregistret.','Vare...'],
        ['@Antal',       '5%', '', 'text', ['left'], tolk('@Mængden af den aktuelle leverance.').' ','Ant...'],
        ['@Enhed',       '5%', '', 'text', ['left'], '@Enhedsbeskrivelse af mængden','Enh...'],
        ['@Beskrivelse','40%', '', 'text', ['left'], '@Leverance beskrivelse','Beskr...'],
        ['@Pris',       '10%', '', 'tal2d',['left'], '@Enhedspris','Pris...'],
        ['@Rabat%',      '6%', '', 'tal2d',['left'], '@Rabatsats i %. Angiv 0% og en reduceret enhedspris, hvis der skal ydes en beløbs rabat','Rabat'],
        ['@Moms%',       '6%', '', 'tal2d',['left'], '@Moms %-sats for den posterede leverance','Moms...'],
      # ['@Linie ialt', '10%', '', 'tal2d',['left'],tolk('@Beregnet beløb.')] tilføjes internt i htm_TabelInp
      ),
   $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ['@um.',        '5%', '', 'text',['center'],'@um. (uden moms) kan benyttes til at bogføre beløb uden moms på konti, selvom kontoen har en momssats tilknyttet.', 
                                      '<input type= "checkbox" name="udenmoms" value="" >'],
        ['@Linie ialt', '8%', '', 'text',['center'],'@Beregnet felt med summen af de samlede beløb', '00.000,00'] #'<div type= "text" name="saldo" value="00.000,00" width="8%">']
      ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON]
   $DATA, /* =   array(      ), */
   $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
   $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
   $CreateRec=true,       # Mulighed for at oprette en record
   $ModifyRec=true,       # Mulighed for at ændre data i en row
   $ViewHeight= '500px',  # Højden af den synlige del af tabellens data
    __FUNCTION__
  );
 
### PanelFooter:
#+  NaviTip();
### KnapPanel:
  htm_CentrOn();
    //textKnap($label='@Gem',             $title='@Klik her for at gemme',$link='../_base/page_Blindgyden.php');
    textKnap($label='@Opslag',          $title='@Opslag - din markørs placering angiver hvilken tabel, opslag foretages i',$link='../_base/page_Blindgyden.php');
    textKnap($label='@Slet alt',        $title='@Klik her for at nulstille alle data i tabellen.',$link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :SYSTEM:
# Kaldes fra:  [_system/page_Regnskabsaar.php] 
function Panl_Regnskabsaar(&$TablData) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'regnform',$capt= '@Regnskabsår:',$parms='../_system/page_Valuta.php',$icon='fas fa-database','panelW480',__FUNCTION__); 
  echo '<captlabl>';      
		htm_FrstFelt('30%');  
		htm_NextFelt('22%');    echo tolk('@Periode start:');  
		htm_NextFelt('22%');    echo tolk('@Periode slut:');   
		htm_NextFelt('8%');     
		htm_LastFelt(); 
	echo '</captlabl>';
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        []
      ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
              ['@ID.',        '10%','indx','',['center'], '@Entydigt systemindex, som benyttes af systemet,','@auto...'],
              ['@Beskrivelse','20%','text','',['left'  ], '@Beskrivende tekst for perioden','@Besk...'],
              ['@Måned',      '15%','text','',['center'], '@Periodens første måned','@md...'],
              ['@År',         '10%','text','',['left'  ], '@Perioden starter i år', '@år...'],
              ['@Måned',      '15%','text','',['center'], '@Periodens sidste måned','@md...'],
              ['@År',         '10%','text','',['left'  ], '@Perioden slutter i år', '@år...'],
              ['@Status',     '10%','html','',['center'], '@Regnskabets status',    '@Stat...'],
      ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        []
      ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $TablData/* =   array(
      ) */,
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '200px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_Caption('@Værd at vide:');
  htm_Plaintxt('@Når du opretter et nyt regnskabsår, skal du huske at gøre det aktivt, ved at sætte flueben i "Bogføring tilladt", på regnskabskortet.');
  htm_AcceptKnap($labl='Gem', $title='@Gem/opdater, hvad du har rettet ovenfor', $type='save', $form='regnform', $width='', $akey='');
  htm_PanlBund($pmpt=Tolk('@Gem'),$subm=false,$title='@Gem/opdater, hvad du har rettet ovenfor');
}

######### :SYSTEM:
# Kaldes fra:  [_system/page_Regnskabsaar.php] [_system/page_Regnskabskort.php] 
function Panl_Regnskabskort(&$DATA, $besk='2016', $aar0='2016', $md0='01', $aar1='2016', $md1='12', $aktiv=true, $fak1Nr) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'kortform',$capt= '@Regnskabskort:',$parms='../_system/page_Valuta.php',$icon='fas fa-pen-square','panelW480',__FUNCTION__); 
  echo tolk('@Fastlæg 1. regnskabsår: 2016').'<br><br>';
  echo '<captlabl>';
  htm_FrstFelt('40%');    echo tolk('@Regnskabsår:');
  htm_NextFelt('20%');    echo tolk('@Periode start:');
  htm_NextFelt('20%');    echo tolk('@Periode slut:');
  htm_NextFelt('20%');    echo tolk('@Bogføring:');
  htm_LastFelt();    
  echo '</captlabl>';
  htm_FrstFelt('40%');    htm_CombFelt($type='text',    $name='besk',  $valu= $besk, $labl='@Beskrivelse.',  $titl='@Angiv Beskrivelse',         $revi=true, $rows='',$width='30',$step='0.5');
  htm_NextFelt('10%');    htm_CombFelt($type='text',    $name='md0',   $valu= $md0,  $labl='@Måned',         $titl='@Angiv periode start Måned', $revi=true, $rows='',$width='30');
  htm_NextFelt('10%');    htm_CombFelt($type='text',    $name='aar0',  $valu= $aar0, $labl='@År',            $titl='@Angiv periode start År',    $revi=true, $rows='',$width='30');
  htm_NextFelt('10%');    htm_CombFelt($type='text',    $name='md1',   $valu= $md1,  $labl='@Måned',         $titl='@Angiv periode slut Måned',  $revi=true, $rows='',$width='30');
  htm_NextFelt('10%');    htm_CombFelt($type='text',    $name='aar1',  $valu= $aar1, $labl='@År',            $titl='@Angiv periode slut År',     $revi=true, $rows='',$width='30');
  htm_NextFelt('20%');    htm_CheckFlt($type='checkbox',$name='aktiv', $valu= $aktiv,$labl='@tilladt',   $titl='@Angiv om bogføring er tilladt', $revi=true);
  htm_LastFelt();       
  
  htm_Caption('&nbsp;'.tolk('@Auto nummerering:'));
  htm_FrstFelt('33%');    htm_CombFelt($type='text',    $name='regn',  $valu= $fak1Nr,   $labl='@1. faktura nummer',     
          $titl='@Faktura nummer for periodens første faktura',   $revi=true, $rows='2',$width='',$step='', $more='', $plho=tolk('@Faktura...'));
  htm_NextFelt('33%');    htm_CombFelt($type='text',    $name='regn',  $valu= $fak1Nr,   $labl='@1. modtagelses nummer', 
          $titl='@Modtagelses nummer for periodens første bilag', $revi=true, $rows='2',$width='',$step='', $more='', $plho=tolk('@Modtage...'));
  htm_NextFelt('33%');
  htm_LastFelt();       
  
  htm_Caption('@Bilags nummerering:');
  htm_FrstFelt('30%');    htm_CheckFlt($type='checkbox',$name='aktiv', $valu= $aktiv,  $labl='@Undlad v. faktura',$titl='@Undlad nummerering ved faktura', $revi=true);
  htm_NextFelt('30%');    htm_CheckFlt($type='checkbox',$name='aktiv', $valu= $aktiv,  $labl='@Brug faktura-nr.', $titl='@Brug fakturas nummerering',      $revi=true);
  htm_NextFelt('30%');    htm_CheckFlt($type='checkbox',$name='aktiv', $valu= $aktiv,  $labl='@Brug modtage-nr.', $titl='@Brug modtage nummerering',       $revi=true);
  htm_LastFelt();       
  htm_CentrOn(); 
    textKnap($label='@Gem rettelser', $title='@Gem hvad du har rettet ovenfor',$link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_hr();
  
#  echo '<hr>'.tolk('@Indtast primotal for 1. regnskabsår:');
    htm_Caption('@Åbningsbeløb for konti:','font-weight:800;');
    htm_Table(
      $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Her angives primotal for:', '13%','show','left', '', '', '@Regnskabsåret'],
        ),
      $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
      $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Konto.',     '12%','show',  '',['center'], '@Entydigt konto nummer, fastlagt i kontoplanen.','@auto...'],
          ['@Beskrivelse','60%','show',  '',['left'  ],   '@Tekst som beskriver kontoen, fastlagt i kontoplanen.','@Besk...'],
          ['@Debet',      '14%','tal2d', '',['right' ],  '@Debet primosaldo','primo...','SW'],
          ['@Kredit',     '14%','tal2d', '',['right' ],  '@Kredit primosaldo','primo...','SW'],
        ),
      $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON]
      $DATA= MakeStatusKonti(),
      /* $DATA=   array(
        ), */
      $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
      $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
      $CreateRec=true,       # Mulighed for at oprette en record
      $ModifyRec=true,       # Mulighed for at ændre data i en row
      $ViewHeight= '500px',  # Højden af den synlige del af tabellens data
      $CalledFrom= __FUNCTION__
  );
  htm_Caption('@Værd at vide:');
  htm_Plaintxt('@En typisk årsag til at åbningsbalancen ikke stemmer, er at sidste års resultat, ikke er indregnet i egenkapitalen primo.');
  //  htm_CentrOn();     textKnap($label='@Gem', $title='@Gem det du har rettet ovenfor',$link='../_base/page_Blindgyden.php');  htm_CentOff();
  htm_AcceptKnap($labl='Gem', $title='@Gem/opdater, hvad du har rettet ovenfor', $type='save', $form='kortform', $width='', $akey='');
  htm_PanlBund($pmpt=Tolk('@Retur til indstillinger'),$subm=false,$title='@Luk og gå retur til indstillingsmenu');
}

######### :SYSTEM:
# Kaldes fra: 
function MakeStatusKonti() {  ## out_PanlsSekd.php
  $StatusKt= array();
  $filDATA= ImportTabFile('../_exchange/kontoplan.tab');
  foreach ($filDATA as $rec) {if ($rec[2]=='S') array_push($StatusKt, [$rec[0],utf8_decode($rec[1]),'0.00','0.00']);}
  return $StatusKt;
}
######### :SYSTEM:
# Kaldes fra:  [_system/page_FormGrafik.php] [_system/page_FormOrdrelin.php] [_system/page_FormText.php] 
function Panl_Formularer( &$formtype, &$formart, &$formsprog, &$formformat) {  ## out_PanlsSekd.php
global $Øart;
  htm_Panl_Top($name= '',$capt= '@Formular redigering',$parms='../_system/page_Valuta.php',$icon='fas fa-wrench','panelW240',__FUNCTION__);
  htm_Tapet_Top($name='tapetform',$capt= '',$parms='#',$icon='','panelWaut',__FUNCTION__);
  $formtype=   $_POST['formtype'];   if (!$formtype) $formtype= '4';
  if    (isset($_POST['formart'])) $formart= $_POST['formart'];
  $formsprog=  $_POST['formsprog'];  if (!$formsprog)  $formsprog=  'dansk';
  $formformat= $_POST['formformat']; if (!$formformat) $formformat= 'A4p';
  
  htm_OptioFlt($type='text',  $name='formtype',   $valu= $formtype,   $labl='@Formular',      
                    $titl='@Vælg en Formular, som du vil redigere',             $revi=true,   $optlist= FRM_Liste(),  $action='', $events='', $maxwd='140px');
  htm_OptioFlt($type='text',  $name='formart',    $valu= $formart,    $labl='@Formular Art',     
                    $titl='@Vælg formularens Art (Objekt type)',                $revi=true,   $optlist= FormObjkt(),  $action='onchange="getComboA(this)"');
  htm_OptioFlt($type='text',  $name='formsprog',  $valu= $formsprog,  $labl='@Formular Sprog',      
                    $titl='@Vælg hvilket Sprog, du vil benytte på formularen',  $revi=false,  $optlist= SPR_Liste(),  $action='');
/*   htm_OptioFlt($type='text',  $name='formformat',   $valu= $formformat,  $labl='@Formular format',      
                    $titl='@Vælg hvilken papirstørrelse, du vil benytte for formularen',  $revi=false, $optlist= PaprListe(), $action='');
 */  
  htm_nl();
  htm_accept('@Rediger det valgte','@Rediger det du har valgt ovenfor', $width='', $akey='', $form='tapetform');
  //  htm_AcceptKnap('@Rediger det valgte','@Rediger det du har valgt ovenfor', $type='save', $form='tapetform', $width='', $akey='');
  htm_nl();
  htm_TapetBund($formslut=true);
  htm_nl();
  echo '<div align="center">';
  textKnap($label='@Forhåndsvisning',                   $title='@Vis layout for en vilkårlig formular',$link='../_base/page_Printlayout.php').'<br><br>';
  textKnap($label='@Opret clon af en formular',         $title='@Opret en ny formular, som en kopi af en eksisterende formular.',    $link='../_base/page_Blindgyden.php').'<br><br><hr>';
  htm_nl();
  htm_Caption('Formular adminstration:');
  textKnap($label='@Gem mine formularer',               $title='@Lav backup til fil, af det nugældende formularsæt.',    $link='../_base/page_Blindgyden.php').'<br><br>';
  textKnap($label='@Genindlæs mine formularer',         $title='@Tag backup fra fil i brug, ved at benytte den som gældende formularsæt. (Overskriver!)',$link='../_base/page_Blindgyden.php').'<br><br>';
  textKnap($label='@Importer formular(er) fra LO ',     $title='@Indlæs fra .fodg-fil dannet af formularredigering i LibreOffice',   $link='../_base/page_Blindgyden.php').'<br><br>';
  textKnap($label='@Overskriv formularer med standard', $title='@Overskriv de aktive formular-definitioner med system standard',$link='../_base/page_Blindgyden.php').'<br><br>';
  textKnap($label='@Håndtering af formularsprog',       $title='@Sproghåndtering: Opret, Nedlæg sprog',         $link='../_base/page_Blindgyden.php').'<br><br>';
  textKnap($label='@Upload/Download supportfiler',      $title='@Fil upload: Logo, Grafik, Billeder eller fodg-fil fra Libre Office',$link='../_base/page_Blindgyden.php').'<br><br>';
  echo '</div>';
  htm_nl();
  htm_hr();
  htm_CentrOn();
    naviKnap($label='@Indstillinger 1', $title='@Gå til indstillings menuen',$link='../_system/page_Valuta.php',$akey='1');
  htm_CentOff();
  htm_PanlBund($pmpt='@Retur til indstillinger',$subm=true,$title='@Gå til menuen indstillinger');
  return [$formtype,$formart,$formsprog,$formformat];
}


######### :SYSTEM:
# Kaldes fra: [_system/page_FormText.php] 
function Panl_FormRedigerLayout($frm,$art,$lang,$papr) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'edit',$capt= '@Rediger Formular: Layout og mail-tekster',$parms='#',$icon='fas fa-wrench','panelW960',__FUNCTION__);
  $link= '';
  htm_Caption('@Formular størrelse:');
  htm_OptioFlt($type='text',  $name='papir',      $valu= $papr,      
               $labl='@Format',   
               $titl='@Her kan du slå op, og vælge blandt standard papir-formater', 
               $revi=true, $optlist=PaprListe(), $action='');
  htm_nl();    htm_hr('Red; size:4;');
  htm_Caption('@Stempler/Vandmærker:');
  htm_Table(
    $TblCapt= //array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        SetHeadArr($frm,'@Stempler',$lang,$papr),
      //),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    //    ['@Ix',            '4%','data','',['center'],'@Index','pos...']
      ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Id.',           '0%','hidd','',['center'],'@Index','serial...'],
        ['@Nr.',           '0%','hidd','',['center'],'@Formular nr','kode...'],
        ['@Art',           '0%','hidd','',['center'],'@Koden for feltes art','art...'],
        ['@Side',          '4%','side','',['center'],'@Udskrift på side kode: A !1 1 S !S','side...','1'],
        ['@Beskrivelse',  '20%','data','',['left'  ],'@Feltets tekstindhold samt $variabler','?'],
        ['@Just',          '4%','just','',['center'],'@Justering af teksten:'. ShowCol($liste=JustListe(),$col= 0,$sep='<br>'),'-','V'],
        ['@X0',            '4%','data','',['right' ],'@Indsætnings X-koordinat (mm fra formularens venstre kant)','X0...',''],
        ['@Y0',            '4%','data','',['right' ],'@Indsætnings Y-koordinat (mm fra formularens top kant)','Y0...'],
        ['@Brd.',          '4%','data','',['right' ],'@Felt bredde (mm)','F-b...'],
        ['@Høj.',          '4%','data','',['right' ],'@Felt højde (mm)'.'<br>'.tolk('@Angiv 0 for at autotilpasse'),'F-h...'],
        ['@Dim.',          '4%','data','',['right' ],'@Objektets dimension: Streg-bredde, Tegn-højde, målt i px (pixel)','Obj-D...'],
        ['@Farve',         '6%','data','',['center'],'@Objektets farve, angives som HTML5 tillader. (red, #FF44DD, rgb)','farve...','red'],
        ['@Txt-font',     '10%','font','',['left'  ],'@Objektets font'.str_nl().tolk('(gyldigt argument til: font-family):'). ShowCol($liste=FontListe(),$col= 2,$sep=str_nl()),'-','Times'],
        ['@Txt-style',    '15%','data','',['left'  ],'@Objektets style'.'<br>'.tolk('(gyldigt argument til: font-weight, font-style). Husk afsluttende semikolon!'),'-','bold; transform: rotate(-35deg); '],
        ['@Grafik',        '0%','hidd','',['left'  ],'@Link til grafikfil','graf...'],
        ['@Fremmedsprog',  '0%','hidd','',['left'  ],'@Alternativ beskrivelse, f.eks. på engelsk','alt...'],
        ['@Note',         '15%','data','',['left'  ],'@Note til objektet','note...']
      ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ['@Slet',          '4%','text','',['center'],'@Klik på rødt kryds for at slette dette stempel', '<ic class="far fa-times-circle" style="color:red; font-size:13px;"></ic>']
      ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON]
    //DATA=   array(),
     $stempel= sql_readB('SELECT id, form, frm_art, side, besk, just, FORMAT(x0,0), FORMAT(y0,0), FORMAT(dx,0), FORMAT(dy,0), FORMAT(dim,0), colr, font, style, imglnk, lngkey, note '.
                         'FROM tblA_forms '.
                         'WHERE form= "'.$frm.'" AND frm_art= "0" AND side!= "G"',__FILE__, __LINE__) , 
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '200px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_Caption('@Special style:');
  htm_FrstFelt('05%');  htm_CombFelt($type='number', $name='ix', $valu= 0, $labl='@Index', $titl='@Her kan du vælge hvilken tekst du vil tilpasse', 
          $revi=true, $rows='', $width='5',$step=1,$more='min="0" max="'.(sizeof($stempel)-1).'"');
  htm_NextFelt('30%');  htm_CombFelt($type='text',  $name='style',  $valu= $stempel[0][12],  $labl='@Txt-font',  
          $titl='@Her kan du tilpasse font-family, som skal være i samme format, som benyttes i HTML-5.<br>f.eks: font-family: "Times New Roman", Georgia, Serif; <br>(udelad font-family:)', $revi=false, $rows='', $width='',$step='',$more='placeholder=" '.tolk('@Font...').'"');
  htm_NextFelt('40%');  htm_CombFelt($type='text',  $name='style',  $valu= $stempel[0][13],  $labl='@Txt-style',  
          $titl='@Her kan du tilpasse supplerende special font style, som skal være i samme format, som benyttes i HTML-5. <br>f.eks: font: italic bold 12px/30px Georgia, serif; <br>(udelad font:)', $revi=false, $rows='', $width='',$step='',$more='placeholder=" '.tolk('@Style...').'"');
  htm_NextFelt('20%');  htm_Plaintxt('Virker ikke endnu.');
  htm_LastFelt(); 
  htm_nl();    htm_hr('Red; size:4;');
  htm_Caption('@Mail tekster:');
  htm_FrstFelt(' 5%');  echo '<div style= "text-align:right"></div>';
  htm_NextFelt('30%');  htm_CombFelt($type='area',  $name='emne',   $valu= '',  $labl='@Emne',   
          $titl='@Her kan du angive mailens emne-tekst.',        $revi=true,$rows='2',$width='45',$step='',$more='placeholder=" '.tolk('@Vedrørende...').'"');
  htm_NextFelt('45%');  htm_CombFelt($type='area',  $name='besked', $valu= '',  $labl='@Besked', 
          $titl='@Besked til modtageren.',                       $revi=true, $rows='', $width='45',$step='',$more='placeholder=" '.tolk('@Vedhæftet følger...').'"');
  htm_NextFelt('20%');  htm_CombFelt($type='area',  $name='bilag',  $valu= '',  $labl='@Bilag',  
          $titl='@Angiv navne, på de filer der skal vedhæftes.', $revi=true, $rows='', $width='45',$step='',$more='placeholder=" '.tolk('@PDF-fil...').'"');
  htm_LastFelt(); 
  htm_PanlBund($pmpt='@Gem',$subm=true);
} //  Panl_FormRedigerLayout


######### :SYSTEM:
# Kaldes fra: [_system/page_FormText.php] 
function Panl_FormRedigerText($frm,$art,$lang,$papr) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'edit',$capt= tolk('@Rediger Formular:').' '.substr(ListLookup($liste=FRM_Liste(), $search= $frm,
      $colsearch=1,$colresult=2),3).' - '.tolk('@Tekster'),$parms='#',$icon='fas fa-wrench','panelW960',__FUNCTION__);
  htm_Table(
   $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
      ),
   $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      ),
   $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Id.',           '0%','hidd','',['center'], '@Index','serial...'],
        ['@Nr.',           '0%','hidd','',['center'], '@Formular nr','kode...'],
        ['@Art',           '0%','hidd','',['center'], '@Koden for feltes art','art...'],
        ['@Side',          '2%','side','',['center'], '@Udskrift på side kode: A !1 1 S !S','side...','A'],
        ['@Beskrivelse',  '32%','data','',['left'  ], '@Feltets tekstindhold samt $variabler','tekst...'],
        ['@Just',          '3%','just','',['center'], '@Justering af teksten:'. ShowCol($liste=JustListe(),$col= 0,$sep='<br>'),'-','V'],
        ['@X0',            '2%','data','',['right' ], '@Indsætnings X-koordinat (mm fra formularens venstre kant)','X0...',''],
        ['@Y0',            '2%','data','',['right' ], '@Indsætnings Y-koordinat (mm fra formularens top kant)','Y0...'],
        ['@Brd.',          '2%','data','',['right' ], '@Felt bredde (mm)','F-b...'],
        ['@Høj.',          '2%','data','',['right' ], '@Felt højde (mm)'.'<br>'.tolk('@Angiv 0 for at autotilpasse'),'F-h...'],
        ['@Dim.',          '2%','data','',['right' ], '@Objektets dimension: Streg-bredde, Tegn-højde, målt i px (pixel)','Obj-D...'],
        ['@Farve',         '6%','data','',['center'], '@Objektets farve, angives som HTML5 tillader. (red, #FF44DD, rgb)','farve...'],
        ['@Txt-font',     '10%','font','',['left'  ], '@Objektets font'.str_nl().tolk('(gyldigt argument til: font-family):'). ShowCol($liste=FontListe(),$col= 2,$sep=str_nl()),'font...','Helvetica'],
        ['@Txt-style',    '12%','data','',['left'  ], '@Objektets style'.'<br>'.tolk('(gyldigt argument til: font-weight, font-style). Husk afsluttende semikolon!'),'style...'],
        ['@Grafik',        '0%','hidd','',['left'  ], '@Link til grafikfil','graf...'],
        ['@Fremmedsprog',  '0%','hidd','',['left'  ], '@Alternativ beskrivelse, f.eks. på engelsk','alt...'],
        ['@Note',         '15%','data','',['left'  ], '@Note til objektet','note...']
      ),
   $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ['@Slet',          '4%','text','',['center'],'@Klik på rødt kryds for at slette dette tekstfelt','<ic class="far fa-times-circle" style="color:red; font-size:13px; "></ic>']
      ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON]
   $tekster= sql_readB('SELECT id, form, frm_art, side, besk, just, FORMAT(x0,0), FORMAT(y0,0), FORMAT(dx,0), FORMAT(dy,0), FORMAT(dim,0), colr, font, style, imglnk, lngkey, note '.
                       'FROM tblA_forms '.
                       'WHERE form= "'.$frm.'" AND frm_art= "2"',__FILE__, __LINE__) , 
      /* $DATA=   array(
      ), */
   $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
   $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
   $CreateRec=true,       # Mulighed for at oprette en record
   $ModifyRec=true,       # Mulighed for at ændre data i en row
   $ViewHeight= '500px',  # Højden af den synlige del af tabellens data
   $CalledFrom= __FUNCTION__
  );
  htm_Caption('@Tip:'); htm_nl();
  htm_Plaintxt(
    tolk('@Når du indsætter et variabelnavn, kommer der ved udskrift automatisk et mellemrum mellem variablens indhold og den efterfølgende tekst.').str_nl().
    tolk('@Ønsker du ikke dette mellemrum, kan du afslutte variabelnavnet med et semikolon.').str_nl().
    tolk('@Det er fx. relevant, hvis du vil indsætte teksten Momssats 25% på en faktura.').str_nl().
    tolk('@Her vil kodningen skulle være Momssats $ordre_momssats;% '));
  htm_PanlBund($pmpt='@Gem',$subm=true,'','','','edit');
}

######### :SYSTEM:
# Kaldes fra: [_system/page_FormGrafik.php] [_system/page_FormText.php] 
function Panl_FormRedigerGrafik($frm,$art,$lang,$papr) {   ## out_PanlsSekd.php
  htm_Panl_Top($name= 'edit',$capt= '@Rediger Formular: Grafik',$parms='#',$icon='fas fa-wrench','panelW960',__FUNCTION__);
  htm_Table(
    $TblCapt= //array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          SetHeadArr($frm,'@Grafik',$lang,$papr),
        //),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ['@BILLEDER:',    '15%','text','',['right'],'$Grafik f.eks. jpg-billeder. Billeder skaleres til den angivne højde/bredde. Det er en fordel, hvis billede er målfast med 720 pt/in.']
      ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Id.',           '0%','hidd','',['center'],'@Index','serial...'],
        ['@Nr.',           '0%','hidd','',['center'],'@Formular nr','kode...'],
        ['@Art',           '0%','hidd','',['center'],'@Koden for feltes art','art...'],
        ['@Side',          '5%','side','',['center'],'@Medtages på udskrifts side. A:alle, 1:første, !1:ikke første, S:sidste, !S:ikke sidste','side...','1'],
        ['@Beskrivelse',   '0%','hidd','',['left'  ],'@Feltets tekstindhold samt $variabler',  '-'],
        ['@Just',          '0%','hidd','',['center'],'@Justering af teksten:'. ShowCol($liste=JustListe(),$col= 0,$sep='<br>'),'-','V'],
        ['@X-venstre',     '6%','data','',['right' ],'@Billedets x-indsætningspunkt målt i mm fra venstre side-kant','.x.'],
        ['@Y-bund',        '6%','data','',['right' ],'@Billedets y-indsætningspunkt målt i mm fra side-top','.y.'],
        ['@Bredde',        '4%','data','',['right' ],'@Billedets bredde målt i mm. Der skaleres til den angivne bredde','.b.'],
        ['@Højde',         '4%','data','',['right' ],'@Billedets højde målt i mm. Hvis originalens H/B-forhold ikke er som angivet her, forvrænges grafikken','.h.'],
        ['@Dim.',          '0%','hidd','',['right' ],'@Objektets dimension: Streg-bredde, Tegn-højde, målt i px (pixel)','Obj-D...'],
        ['@Farve',         '0%','hidd','',['center'],'@Objektets farve, angives som HTML5 tillader. (red, #FF44DD, rgb)','farve...'],
        ['@Txt-font',      '0%','hidd','',['left'  ],'@Objektets font'.str_nl().tolk('(gyldigt argument til: font-family):'). ShowCol($liste=FontListe(),$col= 2,$sep=str_nl()),'-'],
        ['@Txt-style',     '0%','hidd','',['left'  ],'@Objektets style'.'<br>'.tolk('(gyldigt argument til: font-weight, font-style). Husk afsluttende semikolon!'),'-'],
        ['@Filnavn',      '45%','data','',['left'  ],'@Referance til billed-filen (src="Path/Name.typ" alt="Billedtekst")'.' (?.jpg)'],
        ['@Fremmedsprog',  '0%','hidd','',['left'  ],'@Alternativ beskrivelse, f.eks. på engelsk','alt...'],
        ['@Note',         '25%','data','',['left'  ],'@Note til objektet.'],
      ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ['@Slet',          '8%','text','',['center'],'@Klik på rødt kryds for at slette dette billede','<ic class="far fa-times-circle" style="color:red; font-size:13px; "></ic>']
      ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON, ]
    //$DATA,#=   array(),
    $images= sql_readB('SELECT id, form, frm_art, side, besk, just, FORMAT(x0,0), FORMAT(y0,0), FORMAT(dx,0), FORMAT(dy,0), FORMAT(dim,0), colr, font, style, imglnk, lngkey, note '.
                       'FROM tblA_forms '.
                       'WHERE form= "'.$frm.'" AND frm_art= "1" AND besk > ""',__FILE__, __LINE__) ,
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '200px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
    
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
          ['STREGER:',      '13%','text','',['right' ],'@Grafiske linier']
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Id.',           '0%','hidd','',['center'],'@Index','serial...'],
          ['@Nr.',           '0%','hidd','',['center'],'@Formular nr','kode...'],
          ['@Art',           '0%','hidd','',['center'],'@Koden for feltes art','art...'],
          ['@Side',          '5%','side','',['center'],'@Medtages på udskrifts side. A:alle, 1:første, !1:ikke første, S:sidste, !S:ikke sidste','','A'],
          ['@Beskrivelse',   '0%','hidd','',['left'  ],'@Feltets tekstindhold samt $variabler',  '-'],
          ['@Just',          '0%','hidd','',['center'],'@Justering af teksten:'. ShowCol($liste=JustListe(),$col= 0,$sep='<br>'),'-'],
          ['@X-start',       '6%','data','',['right' ],'@Stregens x-startpunkt målt i mm fra venstre side-kant','.x.'],
          ['@Y-start',       '6%','data','',['right' ],'@Stregens y-startpunkt målt i mm fra side-top','.y.'],
          ['@delta-X',       '6%','data','',['right' ],'@Stregens udstrækning i x-retning målt i mm','.dx.'],
          ['@delta-Y',       '6%','data','',['right' ],'@Stregens udstrækning i y-retning målt i mm','.dy.'],
          ['@Bredde',        '6%','data','',['right' ],'@Stregens bredde målt i px','.b.'],
          ['@Farve',         '6%','data','',['center'],'@Objektets farve, angives som HTML5 tillader. (red, #FF44DD, rgb)','farve...'],
          ['@Txt-font',      '0%','hidd','',['left'  ],'@Objektets font'.str_nl().tolk('(gyldigt argument til: font-family):'). ShowCol($liste=FontListe(),$col= 2,$sep=str_nl()),'-'],
          ['@Txt-style',     '0%','hidd','',['left'  ],'@Objektets style'.'<br>'.tolk('(gyldigt argument til: font-weight, font-style). Husk afsluttende semikolon!'),'-'],
          ['@Grafik',        '0%','hidd','',['left'  ],'@Link til grafikfil','graf...'],
          ['@Fremmedsprog',  '0%','hidd','',['left'  ],'@Alternativ beskrivelse, f.eks. på engelsk','alt...'],
          ['@Note',         '45%','data','',['left'  ],'@Huske-tip for denne streg...',' '.tolk('@Stregen angår...')],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
          ['@Slet',          '8%','text','',['center'],'@Klik på rødt kryds for at slette denne streg','<ic class="far fa-times-circle" style="color:red; font-size:13px; "></ic>']
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON, ]
    //$DATA,#=   array(),
    $grafik= sql_readB('SELECT id, form, frm_art, side, besk, just, FORMAT(x0,0), FORMAT(y0,0), FORMAT(dx,0), FORMAT(dy,0), FORMAT(dim,0), colr, font, style, imglnk, lngkey, note '.
                       'FROM tblA_forms '.
                       'WHERE form= "'.$frm.'" AND frm_art= "1" AND besk = ""',__FILE__, __LINE__) ,
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter   //  Virker ikke med hidd-felter!
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '400px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
    //  XY_forskydning();
  htm_PanlBund($pmpt='@Gem',$subm=true,'','','','edit');
} //  Panl_FormRedigerGrafik

######### :SYSTEM:
# Kaldes fra:  [_system/page_FormOrdrelin.php] [_system/page_FormText.php] 
function Panl_FormRedigerOrdrelin($frm,$art,$lang,$papr) {   ## out_PanlsSekd.php
  htm_Panl_Top($name= 'edit',$capt= '@Rediger Formular: Ordrelinier',$parms='#',$icon='fas fa-wrench','panelW960',__FUNCTION__);
  htm_Table(
    $TblCapt= //array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        SetHeadArr($frm,'@Ordrelinjer',$lang,$papr),
        //),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
          ['@Generelt: ',   '15%','text','',['right' ],'@Ordreliniers placering på siden: ']
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Id.',           '0%','hidd','',['center'],'@Index','serial...'],
          ['@Nr.',           '0%','hidd','',['center'],'@Formular nr','kode...'],
          ['@Art',           '0%','hidd','',['center'],'@Koden for feltes art','art...'],
          ['@Side',          '4%','hidd','',['center'],'@Udskrift på side kode: A !1 1 S !S','side...','A'],
          ['@Beskrivelse',   '0%','hidd','',['left'  ],'@Feltets tekstindhold samt $variabler',  '-'],
          ['@Just',          '0%','hidd','',['center'],'@Justering af teksten:'. ShowCol($liste=JustListe(),$col= 0,$sep='<br>'),'-'],
          ['@Antal linier',  '8%','data','',['center'],'@Antal ordrelinier pr. side.','.n.'],
          ['@Top-linie',     '8%','data','',['center'],'@Første ordrelines y-startpunkt (grundlinie) målt i mm fra side-top','.y.'],
          ['@Tekst Bredde',  '8%','data','',['center'],'@Maksimal linie længde for beskrivelse, inden der brydes til ny linie, målt i mm. ','.Bredde [mm].'],
          ['@Linieafstand',  '8%','data','',['center'],'@Afstand mellem liniers grundlinie, målt i mm. ','.Afstand [mm].'],
          ['@Dim.',          '0%','hidd','',['right' ],'@Objektets dimension: Streg-bredde, Tegn-højde, målt i px (pixel)','Obj-D...'],
          ['@Farve',         '0%','hidd','',['center'],'@Objektets farve, angives som HTML5 tillader. (red, #FF44DD, rgb)','farve...'],
          ['@Txt-font',      '0%','hidd','',['left'  ],'@Objektets font'.str_nl().tolk('(gyldigt argument til: font-family):'). ShowCol($liste=FontListe(),$col= 2,$sep=str_nl()),'-'],
          ['@Txt-style',     '0%','hidd','',['left'  ],tolk('@Objektets style').'<br>'.tolk('(gyldigt argument til: font-weight, font-style). Husk afsluttende semikolon!'),'-'],
          ['@Grafik',        '0%','hidd','',['left'  ],'@Link til grafikfil','graf...'],
          ['@Fremmedsprog',  '0%','hidd','',['left'  ],'@Alternativ beskrivelse, f.eks. på engelsk','alt...'],
          ['@Note',         '30%','data','',['left'  ],'@Huske-tip for disse generelle data.','.?.'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON, ]
    //$DATA,#=   array(),
    $ordrlin= sql_readB('SELECT id, form, frm_art, side, besk, just, FORMAT(x0,0), FORMAT(y0,0), FORMAT(dx,0), FORMAT(dy,0), FORMAT(dim,0), colr, font, style, imglnk, lngkey, note '.
                        'FROM tblA_forms '.
                        'WHERE form= "'.$frm.'" AND frm_art= "0" AND side= "G"',__FILE__, __LINE__) ,
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter   //  Virker ikke med hidd-felter!
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '90px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
          ['ORDRELINIER:',  '15%','text','',['right' ],'@Tekst linier med ordrepostering.','Kolonne:']
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Id.',           '0%','hidd','',['center'],'@Index','serial...'],
          ['@Nr.',           '0%','hidd','',['center'],'@Formular nr','kode...'],
          ['@Art',           '0%','hidd','',['center'],'@Koden for feltes art','art...'],
          ['@Side',          '4%','side','',['center'],'@Udskrift på side kode: A !1 1 S !S','side...','A'],
          ['@Beskrivelse',  '16%','data','',['left'  ],'@Navnet på variablen, samt statisk tekst. Variabler som benyttes i ordrelinier, her prefix: £','@navn...'],
          ['@Just.',         '4%','just','',['center'],'@Justering i feltet: V:venstre, C:centreret, H:højre','?','V'],
          ['@X-pos',         '6%','data','',['right' ],'@Tekstens x-startpunkt målt i mm fra formularens venstre side-kant','.x.'],
          ['@Y0',            '0%','hidd','',['right' ],'@Indsætnings Y-koordinat (mm fra formularens top kant)','Y0...'],
          ['@Bredde',        '6%','data','',['right' ],'@Reserveret felt bredde målt i [mm]. Længere tekster ombrydes i flere linier','.b.'], // Kun væsentlig for Beskrivelse
          ['@Højde',         '6%','data','',['right' ],'@Teksthøjde målt i [px]','.h.'],
          ['@Dim.',          '0%','hidd','',['right' ],'@Objektets dimension: Streg-bredde, Tegn-højde, målt i px (pixel)','Obj-D...'],
          ['@Farve',         '6%','data','',['center'],'@Objektets farve, angives som HTML5 tillader. (red, #FF44DD, rgb)','farve...'],
          ['@Font',          '8%','font','',['center'],'@Skrift type navn: Helvetica, Times, OCRbb12','Font navn...','Helvetica'],
          ['@Fed',           '4%','bold','',['center'],'@Bold skrift type, også kaldet fed skrift','<input type= "checkbox" name="bold" value="" >','.?.'],
          ['@Skrå',          '4%','ital','',['center'],'@Skrå skrift type, også kaldet italic','<input type= "checkbox" name="italic" value="" >','.?.'],
          ['@Grafik',        '0%','hidd','',['left'  ],'@Link til grafikfil','graf...'],
          ['@Fremmedsprog',  '0%','hidd','',['left'  ],'@Alternativ beskrivelse, f.eks. på engelsk','alt...'],
          ['@Note:',        '20%','data','',['left'  ],'@Huske-tip for denne ordrelinie.','.?.']
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
          ['@Slet',          '8%','text','',['center'],'@Klik på rødt kryds for at slette denne kolonne','<ic class="far fa-times-circle" style="color:red; font-size:13px; "></ic>']
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON, ]
    //$DATA,#=   array(),
    $ordrlin= sql_readB('SELECT id, form, frm_art, side, besk, just, FORMAT(x0,0), FORMAT(y0,0), FORMAT(dy,0), FORMAT(dx,0), FORMAT(dim,0), colr, font, style, style, imglnk, lngkey, note '.
                        'FROM tblA_forms '.
                        'WHERE form= "'.$frm.'" AND frm_art= "3" ',__FILE__, __LINE__) ,
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter   //  Virker ikke med hidd-felter!
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '300px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_PanlBund($pmpt='@Gem',$subm=true);
} //  Panl_FormRedigerOrdrelin


######### :SYSTEM:
# Kaldes fra:  [_system/page_Momssetup.php] [_system/page_Syssetup-udgaar.php] 
function Panl_MomsSetup(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'moms',$capt= '@Moms indstillinger:',$parms='page_Blindgyden.php',$icon='fas fa-wrench','panelW720',__FUNCTION__);
if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,__FUNCTION__ .':1');
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['<b>'.tolk('@Indland').'</b>', '8%','show','left', '', '@moms angående Indland','SALG'],['@Salgsmoms (udgående): ', '32%','show','left', '', '','@Den moms du skal betale til SKAT']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
//         ['@Salgsmoms (udgående moms): ',    '24%','text','',['right'],'@Salg: ','@Den moms du skal betale til SKAT','.?.'],
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Nr.',          '4%','data','',['center'], '@Positions nummer i gruppen','.Nr.'],
          ['@Beskrivelse', '20%','data','',['left'  ], '@Kontobeskrivelse. En beskrivende tekst efter eget valg','Tekst... (Opret ny konto)'],
          ['@Konto',        '6%','data','',['center'], '@Det nummer i kontoplanen, som salgsmomsen skal konteres på.','Konto...'],
          ['@%-Sats',       '6%','data','',['center'], '@Moms %-sats','25%...'],
          ['@Note',        '30%','text','',['center'], '@(planlagt)','.?.'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
//    &$DATA=   array(
//       ),
    $data= array( [['1'],['@Salgsmoms'],['66100'],['25,00'],['']], [['2'],[''],[''],[''],['']] ),
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '130px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );

  if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,__FUNCTION__ .':2');
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['<b>'.tolk('@Indland').'</b>', '8%','show','left', '', '@moms angående Indland','@KØB'],
          ['@Købsmoms (indgående): ', '34%','show','left', '', '','@Den moms du skal have retur fra SKAT']
      ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
//         ['@Købsmoms (indgående moms): ',    '24%','text','',['right'],'@Køb: ','@Den moms du skal have retur fra SKAT','.?.'],
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Nr.',          '4%','text','',['center'],'@Positions nummer i gruppen','.Nr.'],
          ['@Beskrivelse', '20%','data','',['left'  ],'@Kontobeskrivelse. En beskrivende tekst efter eget valg','Tekst... (Opret ny konto)'],
          ['@Konto',        '6%','data','',['center'],'@Det nummer i kontoplanen, som købsmomsen skal konteres på.','Konto...'],
          ['@%-Sats',       '6%','data','',['center'],'@Moms %-sats','25%...'],
          ['@Note',        '30%','text','',['center'],'@(Planlagt)','.?.'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
//    $DATA=   array(
//       ),
    $data= array( [['1'],['@Købsmoms'],['66200'],['25,00'],['']], [['2'],[''],[''],[''],[''] ] ),
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '130px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
   htm_hr();

if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,__FUNCTION__ .':3');
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['<b>'.tolk('@Udland').'</b>', '12%','show','left', '', '@moms angående udland','@KØB-ydelser'],['@Moms af ydelseskøb i udlandet: ', '24%','show','left', '', 
            '@Ved ydelseskøb i udlandet, skal der betales dansk moms på vegne af sælgeren. Samtidig kan købsmomsen trækkes fra så resultatet bliver 0','@Moms på vegne af sælgen.']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Nr.',          '4%', 'data','',['center'],'@Positions nummer i gruppen','.Nr.'],
          ['@Beskrivelse', '20%', 'data','',['left'  ],'@Kontobeskrivelse. En beskrivende tekst efter eget valg','Tekst... (Opret ny konto)'],
          ['@Konto',        '6%', 'data','',['center'],'@Konto til postering af salgsmoms for ydelseskøb i udlandet','Konto...'],
          ['@%-Sats',       '6%', 'data','',['center'],'@Moms %-sats','25%...'],
          ['@Modkonto',     '6%', 'data','',['center'],'@Konto til postering af købsmoms for ydelseskøb i udlandet','Konto...'],
          ['@Note',        '22%', 'text','',['center'],'@(planlagt)','.?.'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
//    $DATA=   array(
//       ),
    $data= array( [['1'],['@Moms af ydelseskøb i udlandet'],['66155'],['25,00'],['66200']], [['2'],[''],[''],[''],[''] ] ),
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '130px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );

  if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,__FUNCTION__.':4');
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['<b>'.tolk('@Udland').'</b>', '12%','show','left', '', '@moms angående udland','@KØB-varer']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
//         ['@Moms af varekøb i udlandet: ',    '24%','text','',['right'],'@Vare: ',
//             '@Ved varekøb i udlandet, skal der betales dansk moms på vegne af sælgeren. Samtidig kan købsmomsen trækkes fra så resultatet bliver 0','.?.'],
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Nr.',          '4%','data','',['center'], '@Positions nummer i gruppen','.Nr.'],
          ['@Beskrivelse', '20%','data','',['left'  ], '@Kontobeskrivelse. En beskrivende tekst efter eget valg','Tekst... (Opret ny konto)'],
          ['@Konto',        '6%','data','',['center'], '@Konto til postering af salgsmoms for køb i udlandet','Konto...'],
          ['@%-Sats',       '6%','data','',['center'], '@Moms %-sats','25%...'],
          ['@Modkonto',     '6%','data','',['center'], '@Konto til postering af købsmoms for køb i udlandet','Konto...'],
          ['@Note',        '22%','text','',['center'], '@(planlagt)','.?.'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $data= array( [['1'],['@Moms af varekøb m.v. i udlandet'],['66150'],['25,00'],['66200']], [['2'],[''],[''],[''],[''] ] ),
//    $DATA=   array(
//       ),
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '130px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_hr();
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Rapporter', '8%','show','left', '', '@konti som skal indgå i momsrapport','@KONTI']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
//         ['@Momsrapport (konti som skal indgå i momsrapport): ',    '26%','text','',['right'],'@Rap: ','@Her angives intervaller af konti, som skal danne grundlag for momsrapporter.','.?.'],
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Nr.',          '4%', 'data','',['center'], '@Positions nummer i gruppen','.Nr.'],
          ['@Beskrivelse', '20%', 'data','',['left'  ], '@Kontobeskrivelse. En beskrivende tekst efter eget valg','Tekst... (Opret ny)'],
          ['@Fra',          '6%', 'data','',['center'], '@Første kontonummer som skal indgå i rapporten','Konto...'],
          ['@Til',          '6%', 'data','',['center'], '@Sidste kontonummer som skal indgå i rapporten','Konto...'],
          ['@Rubrik A1',    '6%', 'data','',['center'], '@Kontonummer for samlet varekøb i EU','Konto...'],
          ['@Rubrik A2',    '6%', 'data','',['center'], '@Kontonummer for samlet ydelseskøb i EU','Konto...'],
          ['@Rubrik B1',    '6%', 'data','',['center'], '@Kontonummer for samlet varesalg i EU','Konto...'],
          ['@Rubrik B2',    '6%', 'data','',['center'], '@Kontonummer for samlet ydelsessalg i EU','Konto...'],
          ['@Rubrik C',     '6%', 'data','',['center'], '@Kontonummer for samlet vare- og ydelsessalg uden for EU','Konto...'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        // ['',        '1%','text','',['center'],'','',''],
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
//    $DATA=   array(
//       ),
    $data= array([['1'],['@Momsrapport'],['66100'],['66200'],['2800'],['2700'],['1220'],['1200'],['1290']],
                    [['2'],[''],[''],[''],[''],[''],[''],[''],['']]
          ), 
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '150px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_PanlBund($pmpt='@Gem',$subm=true);
}


######### :SYSTEM:
# Kaldes fra:  [_system/page_Stamkort.php] 
function Panl_Stamdata(  ## out_PanlsSekd.php
  &$firmanavn, &$addr1, &$addr2, &$postnr, &$bynavn, &$ny_email, &$homepage, &$bank_navn, &$bank_reg, &$bank_konto, &$cvrnr, &$tlf, &$fax, &$pbs_nr, &$pbs, &$gruppe, &$fi_nr
) { 
  htm_Panl_Top($name='stamkort',$capt='@Stamdata:',$parms='page_Blindgyden.php',$icon='fas fa-user',$klasse='panelW320',__FUNCTION__);
                        htm_CombFelt($type='text',  $name='firmanavn',  $valu= $firmanavn,  $labl='@Firmanavn',   $titl='@Navnet på det firma, regnskabet angår');
  htm_FrstFelt('50%');  htm_CombFelt($type='text',  $name='addr1',      $valu= $addr1,      $labl='@Adresse',     $titl='@Firmaets adresse');
  htm_NextFelt('50%');  htm_CombFelt($type='text',  $name='addr2',      $valu= $addr2,      $labl='@Sted',        $titl='@Supplerende stedsangivelse');
  htm_LastFelt();                                                                           
  htm_FrstFelt('25%');  htm_CombFelt($type='text',  $name='postnr',     $valu= $postnr,     $labl='@Postnr.',     $titl='@Postnr');
  htm_NextFelt('75%');  htm_CombFelt($type='text',  $name='bynavn',     $valu= $bynavn,     $labl='@Bynavn',      $titl='@Bynavn. firmaets hjemsted');
  htm_LastFelt();                                                                           
  htm_FrstFelt('50%');  htm_CombFelt($type='mail',  $name='ny_email',   $valu= $ny_email,   $labl='@Mail',        $titl='@Firmaets Mail-adresse');
  htm_NextFelt('50%');  htm_CombFelt($type='text',  $name='homepage',   $valu= $homepage,   $labl='@Hjemmeside',  $titl='@Firmaets hjemmeside-adresse');
  htm_LastFelt();                                                                           
                        htm_CombFelt($type='text',  $name='bank_navn',  $valu= $bank_navn,  $labl='@Bank',        $titl='@Bank forbindelse');
  htm_FrstFelt('25%');  htm_CombFelt($type='text',  $name='bank_reg',   $valu= $bank_reg,   $labl='@Bank reg.',   $titl='@Bank reg.');
  htm_NextFelt('75%');  htm_CombFelt($type='text',  $name='bank_konto', $valu= $bank_konto, $labl='@Bank konto',  $titl='@Bank konto');
  htm_LastFelt();
                        htm_CombFelt($type='text',  $name='cvrnr',      $valu= $cvrnr,      $labl='@CVR',         $titl=tolk('@CVR - Virksomheds ID.').'<br>'.
                        tolk('@Kan benyttes i CVR-opslag, til at importere Erhvervsstyrelsens offentlige data'), $revi=true);
  htm_FrstFelt('50%');  htm_CombFelt($type='text',  $name='tlf',        $valu= $tlf,        $labl='@Telefon.',    
                          $titl='@Telefonnr - Kan benyttes i CVR-opslag, til at importere Erhvervsstyrelsens offentlige data');
  htm_NextFelt('50%');  htm_CombFelt($type='text',  $name='fax',        $valu= $fax,        $labl='@Fax',         $titl='@Firmaets fax');
  htm_LastFelt(); 
  if (!$pbs_nr) {
    htm_FrstFelt('40%');  htm_CombFelt($type='text',$name='pbs_nr',     $valu= $pbs_nr,     $labl='@PBS Kreditornr.', $titl='@Firmaets pbsnr');
    htm_NextFelt('40%');  {if      ($pbs=='B') $listen= array(['','B','@Basis løsning'], ['','', '@Total løsning'], ['','L','@Lev. Service']);
                           elseif  ($pbs=='L') $listen= array(['','L','@Lev. Service'],  ['','B','@Basis løsning'], ['','', '@Total løsning']);
                           else                $listen= array(['','', '@Total løsning'], ['','B','@Basis løsning'], ['','L','@Lev. Service']);
                           htm_OptioFlt($type='text',$name='pbs',       $valu= $pbs,        $labl='@Aftale',
                                        $titl='@Vælg den aftalte løsning',  $revi=true, $optlist= $listen, $action='',$events='',$maxwd='300px',$onForm='stamkort');
                          }
    htm_LastFelt();
  } else                htm_CombFelt($type='text',  $name='pbs_nr', $valu= $pbs_nr, $labl='@PBS Kreditornr.',   $titl='@Firmaets pbsnr');
                        htm_CombFelt($type='text',  $name='gruppe', $valu= $gruppe, $labl='@PBS debitorgruppe', $titl='@Gruppe ');
                        htm_CombFelt($type='text',  $name='fi_nr',  $valu= $fi_nr,  $labl='@FI Kreditornr.',    
                          $titl='@Bankernes fælles indbetalingskort (FI-kort). Her angiver du dit FI Kreditornr.',    $revi=true);
  htm_FrstFelt('60%');  htm_CombFelt( $type='text',  $name='datansv', $valu= $gruppe, $labl='@Dataansvarlig - email', $titl='@Den dataansvarliges email');
  htm_NextFelt('40%');  echo textKnap($label='@Databehandler aftale', $title= tolk('@Se kontrakt med databehandler.'), $link='','','','tooltipNW');
  htm_LastFelt();
  htm_PanlBund($pmpt='@Gem',$subm=true);  
}

######### :SYSTEM:
# Kaldes fra:  [_system/page_Stamkort.php] 
function Panl_Medarbejdere() {  ## out_PanlsSekd.php
  htm_Tapet_Top($name= 'persform',$capt= '@Medarbejdere: ',$parms='#',$icon='far fa-file-alt','panelW480',__FUNCTION__);
  htm_nl();
  Panl_Ansat($Medarbejdernr, $bankkto, $Navn='Anders',    $Initialer, $Adresse, $Adresse2, $Postnr, $By, $Mail, $Mobil, $Lokalnr, $Lokalfax, $Privattlf, $Bank, $Løn, $Løntillæg, $Bemærkning, $Tiltrådt, $Fratrådt);
  Panl_Ansat($Medarbejdernr, $bankkto, $Navn='Rip',       $Initialer, $Adresse, $Adresse2, $Postnr, $By, $Mail, $Mobil, $Lokalnr, $Lokalfax, $Privattlf, $Bank, $Løn, $Løntillæg, $Bemærkning, $Tiltrådt, $Fratrådt);
  Panl_Ansat($Medarbejdernr, $bankkto, $Navn='Rap',       $Initialer, $Adresse, $Adresse2, $Postnr, $By, $Mail, $Mobil, $Lokalnr, $Lokalfax, $Privattlf, $Bank, $Løn, $Løntillæg, $Bemærkning, $Tiltrådt, $Fratrådt);
  Panl_Ansat($Medarbejdernr, $bankkto, $Navn='Rup',       $Initialer, $Adresse, $Adresse2, $Postnr, $By, $Mail, $Mobil, $Lokalnr, $Lokalfax, $Privattlf, $Bank, $Løn, $Løntillæg, $Bemærkning, $Tiltrådt, $Fratrådt);
  Panl_Ansat($Medarbejdernr, $bankkto, $Navn='Andersine', $Initialer, $Adresse, $Adresse2, $Postnr, $By, $Mail, $Mobil, $Lokalnr, $Lokalfax, $Privattlf, $Bank, $Løn, $Løntillæg, $Bemærkning, $Tiltrådt, $Fratrådt);
  htm_CentrOn();
  echo textKnap($label='@Vis Fratrådte medarbejdere', $title= tolk('@Se tidligere ansatte medarbejdere.'), $link='','','','tooltipNW');
  htm_CentOff();
  htm_TapetBund($pmpt='@Retur til ?',$subm=false,$title='@Retur til ?');
} 

######### :SYSTEM:
# Kaldes fra: [_system/page_Stamkort.php]
function Panl_Ansat(&$Medarbejdernr, &$bankkto, &$Navn, &$Initialer, &$Adresse, &$Adresse2,   ## out_PanlsSekd.php
                    &$Postnr, &$By, &$Mail, &$Mobil, &$Lokalnr, &$Lokalfax, &$Privattlf, &$Bank, 
                    &$Løn, &$Løntillæg, &$Bemærkning, &$Tiltrådt, &$Fratrådt
) { 
  htm_Panl_Top($name='stamkort',$capt='@Ansat:'.' '.$Navn,$parms='page_Blindgyden.php',$icon='fas fa-user',$klasse='panelW320',__FUNCTION__);
  htm_FrstFelt('50%');    htm_CombFelt($type='text',  $name='Medarbejdernr',$valu= $Medarbejdernr,  $labl='@Medarbejdernr', $titl='@Medarbejder nummer', $revi=true);  
  htm_NextFelt('50%');    htm_CombFelt($type='text',  $name='Cpr-nr',       $valu= $bankkto,    $labl='@Cpr-nr',    $titl='@Cpr-nr',      $revi=true);  
  htm_lastFelt();                                                                               
  htm_FrstFelt('75%');    htm_CombFelt($type='text',  $name='Navn',         $valu= $Navn,       $labl='@Navn',      $titl='@Medarbejderens fulde navn.',       $revi=true);  
  htm_NextFelt('25%');    htm_CombFelt($type='text',  $name='Initialer',    $valu= $Initialer,  $labl='@Initialer', $titl='@Initialer',   $revi=true);  
  htm_lastFelt();                                                                               
  htm_FrstFelt('50%');    htm_CombFelt($type='text',  $name='Adresse',      $valu= $Adresse,    $labl='@Adresse.',  $titl='@Gade/vej og husnummer',    $revi=true);  
  htm_NextFelt('50%');    htm_CombFelt($type='text',  $name='Adresse2',     $valu= $Adresse2,   $labl='@Sted',      $titl='@Supplerende steds angivelse',    $revi=true);  
  htm_lastFelt();                                                                               
  htm_FrstFelt('25%');    htm_CombFelt($type='text',  $name='Postnr',       $valu= $Postnr,     $labl='@Postnr.',   $titl='@Postnr.',     $revi=true);  
  htm_NextFelt('75%');    htm_CombFelt($type='text',  $name='By',           $valu= $By,         $labl='@By',        $titl='@By',          $revi=true);  
  htm_lastFelt();   
  htm_FrstFelt('50%');    htm_CombFelt($type='mail',  $name='e-mail',       $valu= $Mail,       $labl='@Mail',      $titl='@Medarbejderens mail', $revi=true);  
  htm_NextFelt('50%');    htm_CombFelt($type='text',  $name='Mobil',        $valu= $Mobil,      $labl='@Mobil',     $titl='@Mobil',       $revi=true);  
  htm_lastFelt();                                                                                
  htm_FrstFelt('50%');    htm_CombFelt($type='text',  $name='Lokalnr.',     $valu= $Lokalnr,    $labl='@Lokalnr.',  $titl='Lokal telefon nr.',     $revi=true);
  htm_NextFelt('50%');    htm_CombFelt($type='text',  $name='Lokal fax',    $valu= $Lokalfax,   $labl='@Lokal fax', $titl='@Lokal fax',   $revi=true);
  htm_lastFelt();                                                                                
  htm_FrstFelt('50%');    htm_CombFelt($type='text',  $name='Privat tlf',   $valu= $Privattlf,  $labl='@Privat tlf',$titl='@Privat tlf',  $revi=true);
  htm_NextFelt('50%');    htm_CombFelt($type='text',  $name='Bank',         $valu= $Bank,       $labl='@Bank.',     $titl='@Bank',        $revi=true);
  htm_lastFelt();                                                                                
  htm_FrstFelt('50%');    htm_CombFelt($type='text',  $name='Løn',          $valu= $Løn,        $labl='@Løn',       $titl='@Løn',         $revi=true);
  htm_NextFelt('50%');    htm_CombFelt($type='text',  $name='Løntillæg',    $valu= $Løntillæg,  $labl='@Løntillæg', $titl='@Løntillæg',   $revi=true);
  htm_lastFelt();                                                                                
                          htm_CombFelt($type='area',  $name='Bemærkning',   $valu= $Bemærkning, $labl='@Bemærkning',$titl='@Bemærkning',    $revi=true);
  htm_FrstFelt('50%');    htm_CombFelt($type='date',  $name='Tiltrådt',     $valu= $Tiltrådt,   $labl='@Tiltrådt',  $titl='@Tiltrædelses dato', $revi=true);
  htm_NextFelt('50%');    htm_CombFelt($type='date',  $name='Fratrådt',     $valu= $Fratrådt,   $labl='@Fratrådt',  $titl='@Fratrædelses dato', $revi=true);
  htm_lastFelt();
  htm_PanlBund($pmpt='@Gem',$subm=true);
}


######### :SYSTEM:
# Kaldes fra:  [_system/page_Brugere.php] 
function Panl_Brugere(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) { global $ØtblRowDrk, $ØtblRowLgt;  ## out_PanlsSekd.php
  function TblRow($span1,$Txt1,$repe,$span2,$Txt2){ global $ØtblRowDrk, $ØtblRowLgt;
    echo '<tr><td colspan= '.$span1.' align=right> <u>'.tolk($Txt1).'</u> &nbsp;</td>';
    Veksle($from=$span1, $to=$repe+$span1-1, $krit='11111111111111111111', $doOdd='', $doEven='">|'); //  echo str_repeat('<td style="text-align:center; background:'.$ØtblRowDrk.';">|</td>',$repe);
    echo '<td colspan='.$span2.'> &nbsp;&nbsp;<u>'. tolk($Txt2).'</u></td></tr>'; 
  }

  function UserRett($ix,$row,$name){
    if (substr($row['rettigheder'], $ix,1)==0) {echo '<td><input class="inputbox" type=checkbox name='.$name.' title='.$name.'></td>';}     
    else                                     {echo '<td><input class="inputbox" type=checkbox name='.$name.' title='.$name.' checked></td>';}
  }
  function Veksle($from, $to, $krit, $doOdd, $doEven) { global $ØtblRowDrk, $ØtblRowLgt;
    for ($y=$from; $y<=$to; $y++) {
      if ($y % 2 == 0) $colbg= $ØtblRowDrk; else $colbg= $ØtblRowLgt;
      if (substr($krit,$y,1)==0)  echo '<td style="background:'.$colbg.'"></td>';
      else                        echo '<td style="background:'.$colbg.'; text-align:center; '.$doEven.'</td>';
  } }
  $bgcolor5= $ØtblRowDrk;
  $bgcolor=  $ØtblRowLgt;
  $colbg= $ØtblRowDrk;
  htm_Panl_Top($name='brugkort',$capt='@Bruger rettigheder:',$parms='page_Blindgyden.php',$icon='fas fa-user',$klasse='panelW720',__FUNCTION__);
  echo '<br><table cellpadding="0" cellspacing="0" border="0" width="70%"><tbody style="font-size: 15px;">';
  echo '<tr><td colspan="2"></td>'.
    str_repeat('<td style="text-align:center; width:1%; color:'.$bgcolor.';"> </td>', 25).
    '</tr>';
    
  TblRow(14,'@Sikkerhedskopi',  0,13,'@Debitorrapport');
  TblRow(13,'@Varemodtagelse',  2,12,'@Kreditorrapport');
  TblRow(12,'@Varelager',       4,11,'@Produktionsordrer');
  TblRow(11,'@Kreditorkonti',   6,10,'@Varerapport');
  TblRow(10,'@Kreditorordrer',  8, 9,'');
  TblRow( 9,'@Debitorkonti',    9, 9,'');
  TblRow( 8,'@Debitorordrer',  10, 9,'');
  TblRow( 7,'@Finansrapport',  11, 9,'');
  TblRow( 6,'@Regnskab',       12, 9,'');
  TblRow( 5,'@Kassekladde',    13, 9,'');
  TblRow( 4,'@Indstillinger',  14, 9,'');
  TblRow( 3,'@Kontoplan',      15, 9,'');
  TblRow( 2,'',                16, 9,'');
  
  echo '<tr><td style="width:15%"><data-colrlabl> '.
      tolk('@Navn / init.').':&nbsp;</data-colrlabl></td><td style="width:15%"><data-colrlabl> '.
      tolk('@Bruger').':</data-colrlabl></td>';
      veksle($from=0, $to=15, $krit='1111111111111111111', $doOdd='', $doEven=' color:gray; width:2%;">▼');
  echo '<td style="width:15%"> </td></tr>';
  
  $users=[['adm','Administrator','1234567891123456'],['bog','Bogholder','1234567890023456'],['rev','Revisor','1234567891123456']];
  foreach ($users as $usr) {
#  for ($user=0; $user<=2; $user++) {  $r2[initialer]= 'adm';    $row[brugernavn]= 'administrator';    $row[rettigheder]= '1234567890023456';    $colbg= '#d0d0d0';
#   if (true) echo '<tr><td> '.$r2[initialer].'&nbsp;</td><td><axx href=brugere.php?ret_id='.$row[id].'> '.$row[brugernavn].'</axx></td>';
    if (true) echo '<tr><td align=center > '.$usr[0].'&nbsp;</td><td><axx href=brugere.php?ret_id='.$row['id'].'> '.$usr[1].'</axx></td>';
    else      echo '<td align=center bgcolor="'.$colbg.'">*</td>';  
    Veksle($from=0, $to=15, $krit=$usr[2], $doOdd='', $doEven='color:green; font-weight:900;">√');
    echo '</tr>';
  }
  
  echo '<tr><td style="text-align:right"><data-colrlabl>'.tolk('@Opret ny bruger').':&nbsp;</data-colrlabl></td>';
  echo '<input type=hidden name=id value="'.$row['id'].'">';
  echo '<input type=hidden name=random value='.'navn'.rand(100,999).'>';   #For at undgaa at browseren "husker" et forkert brugernavn.
  $row['brugernavn']= 'Maria';    
  echo '<td><input class="inputbox" type="text" size=12 name='.$tmp.' value="'.$row['brugernavn'].'"></td>';
  UserRett( 0,$row,'kontoplan');       
  UserRett( 1,$row,'indstillinger');   
  UserRett( 2,$row,'kassekladde');     
  UserRett( 3,$row,'regnskab');        
  UserRett( 4,$row,'finansrapport');   
  UserRett( 5,$row,'debitorordre');    
  UserRett( 6,$row,'debitorkonti');    
  UserRett( 7,$row,'kreditorordre');   
  UserRett( 8,$row,'kreditorkonti');   
  UserRett( 9,$row,'varer');           
  UserRett(10,$row,'enheder');         
  UserRett(11,$row,'backup');          
  UserRett(12,$row,'debitorrapport');  
  UserRett(13,$row,'kreditorrapport'); 
  UserRett(14,$row,'produktionsordre');
  UserRett(15,$row,'varerapport');     
  echo '</tr>';
  echo '<tr><td style="text-align:right"><data-colrlabl>'.tolk('@Adgangskode').':&nbsp;</data-colrlabl></td><td><input class="inputbox" type=password size=12 name=kode value="********************"></td></tr>';
  echo '<tr><td style="text-align:right"><data-colrlabl>'.tolk('@Gentag kode').':&nbsp;</data-colrlabl></td><td><input class="inputbox" type=password size=12 name=kode2 value="********************"></td></tr>';
  echo '</tbody></table>';
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :SYSTEM:
# Kaldes fra:  [_system/page_Valuta.php] 
function Panl_Valuta(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'valuform',$capt= '@Valutaer: ',$parms='page_Blindgyden.php',$icon='fas fa-euro-sign','panelW320',__FUNCTION__);
  htm_Caption('@Oprettede valutaer:');
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Valuta.',    '15%', 'indx','',['left'],   '@Valuta benævnelse','@Valu...'],
          ['@Beskrivelse','58%', 'text','',['left'],   '@Valuta beskrivelse','@Besk...'],
          ['@Kurs',       '15%', 'text','',['center'], '@Aktuel kurs...','@Kurs...']
        ),  //  Problem: Tabellens width er større end forventet!
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
//    $DATA=   array(
//       ),
    $TablData= [['DKK','Danske kroner','100'],['EUR','Europæiske Euro','100'],['USD','Amerikanske Dollar','100']],  # ImportTabFile('../_exchange/varer.tab'),  // Indlæs data fra TAB-fil
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '200px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  $optlist= ValutaArr(); //[['Danske kroner','DKK','DKK - Danmark - Kroner'],['Europæisk Euro','EUR','EUR - EU fællesskabet - Euro'], ['US dollar','USD','USD - Amerikansk - Dollar'],['Pund Sterling','GBP','GBP - Det Forenede Kongerige - Pund']];
  htm_nl();
  htm_Caption('@Oversigt over populære valutaer:');
  htm_nl(2);
  htm_OptioFlt($type='text',  $name='vkode',      $valu= '',      
                    $labl='@Valutaer',   
                    $titl='@Her kan du slå op, og se aktuelle valuta-koder', 
                    $revi=true, $optlist, $action='',$events='',$maxwd='150px');
  $filDATA= ImportTabFile('../_exchange/ISO-valutaer.tab',1,'UTF-x');    $optlist= [];  //  Vises kun på dansk!
  foreach ($filDATA as $rec) {array_push($optlist, [ $rec[2].' / '.$rec[3], $rec[0], $rec[0].' : '.$rec[1] ]);}
  htm_Caption('@Oversigt over alle valutaer:');
  htm_nl(2);
  htm_OptioFlt($type='text',  $name='vkode',      $valu= '',      
                    $labl='@Valutaer',   
                    $titl='@Her kan du slå op, og se mulige valuta-koder', 
                    $revi=true, $optlist, $action='',$events='',$maxwd='150px');
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :SYSTEM:
# Kaldes fra:  [_system/page_Valuta.php] 
function Panl_Valutakort(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'kortform',$capt= '@Valuta ændringer: ',$parms='page_Blindgyden.php',$icon='fas fa-euro-sign','panelW320',__FUNCTION__);
  $valuta= 'DKK';   $beskriv= 'Danske kroner';
  htm_Caption('@Vedligeholdese af:');  echo ' '.$valuta.' - '.$beskriv;
  htm_nl(2);
  htm_Plaintxt('@Der er ikke automatisk vedligeholdelse af kurser i SALDI. Du skal tilpasse dags-kursen manuelt efter behov. F.eks. inden du fakturerer eller bogfører.');
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
                ['@Valør dato', '8%', 'date','',  ['center'], '@Den dato kursen er gældende fra','@dato [YYYY-MM-DD]'],
                ['@Ny kurs',    '8%', 'text','',  ['center'], '@Angives i %. dvs. værdien i DKK af 100 '.$valuta,'@kurs...'],
                ['@Konto',      '8%', 'text','',  ['center'], '@Kontonummer fra kontoplanen som skal bruges til valutakursdifferencer og øreafrunding...','@konto...'],
        ),  //  Problem: Tabellens width er større end forventet!
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
//    $DATA=   array(
//       ),
    $TablData= [['Dato','Kurs','konto'],['Dato','Kurs','konto'],['Dato','Kurs','konto'],['Dato','Kurs','konto'],['Dato','Kurs','konto'],['Dato','Kurs','konto'],
              ['Dato','Kurs','konto'],['Dato','Kurs','konto'],['Dato','Kurs','konto'],['Dato','Kurs','konto']],  # ImportTabFile('../_exchange/varer.tab'),  // Indlæs data fra TAB-fil
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=false,       # Mulighed for at ændre data i en row
    $ViewHeight= '400px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :SYSTEM:
# Kaldes fra:  [_system/page_Enheder.php] 
function Panl_Enheder(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'enhedform',$capt= '@Enheder og materialer: ',$parms='page_Blindgyden.php',$icon='fas fa-database','panelW320',__FUNCTION__);
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          [' ', '42%','show','','left', '', '@Enhedsbetegnelser']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Enhed',      '20%', 'text','',['left'], tolk('@Enhedsbetegnelse').' ','Enh...'],
          ['@Beskrivelse','80%', 'text','',['left'], '@Beskrivelse af enheden','Beskr...'],
        ),  //  Problem: Tabellens width er større end forventet!
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
//    $DATA=   array(
//       ),
    $data= array(['',''],['',''],['',''],['',''],),  # Antal rows ved DEMO
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '120px',   # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );

  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          [' ', '42%','show','','left', '', '@Materiale egenskaber']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Materiale.', '70%', 'text','',['left'], '@Materiale','Matr...'],
          ['@Densitet',   '30%', 'text','',['left'], '@Materialets massefylde','Dens...'],
        ),  //  Problem: Tabellens width er større end forventet!
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        []
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
//    $DATA=   array(
//       ),
    $data= array(['',''],['',''],['',''],['',''],),  # Antal rows ved DEMO
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '120px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
### PanelFooter:
#+  NaviTip();
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :SYSTEM:
# Kaldes fra:  [_system/page_Rabatgrupper.php] 
function Panl_Rabatgrupper($vg_antal=4, $vrg_antal=true, $dg_antal=3, $drg_antal=true  ## out_PanlsSekd.php
  /* DEMO  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {
  htm_Panl_Top($name= 'rabbform',$capt= '@Rabatgrupper:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-database','panelW640',__FUNCTION__);
  htm_CentrOn(); 
    textKnap($label='@Definer selv debitor-rabatgrupper',  $title='@Klik her for at håndtere dine debitor rabatgrupper',$link='../_base/page_Blindgyden.php').'<hr>';
    textKnap($label='@Definer selv vare-rabatgrupper',     $title='@Klik her for at håndtere dine vare rabatgrupper',$link='../_base/page_Blindgyden.php').'<hr>';
  htm_CentOff();
### OVERSKRIFTER:
  echo '<data-colrlabl>'; 
  htm_FrstFelt('40%');    echo 'Debitorgrp \ Varegrp';
  htm_NextFelt('20%');    echo 'Type';
  for ($y=1; $y<=$vg_antal; $y++) { //  Dette bør ændres så rutinen modtager data i arrays!
    if ($vrg_antal) { htm_NextFelt('12%');  echo '<a   title="'.$vgnavn[0][$y].'Klik for at rette navn" href="../_base/page_Blindgyden.php">VG'.$y.'</a>';}  # print "<td title=\"".$vgnavn[0][$y]." | Klik for at rette navn\"><a href=\"rabatgrupper.php?ret_vrgnavn=$y\">&nbsp;VG$y</a></td>";
    else            { htm_NextFelt('12%');  echo '<div title="'.$vgnavn[0][$y].'">VG'.$y.'</div>';}                           # print "<td title=\"".$vgnavn[0][$y]."\">&nbsp;VG$y</td>";
  }
 if ($vrg_antal) {htm_NextFelt('2%');  textKnap($label='@Ny',  $title='@Klik her for at oprette ny vare-rabatgruppe',$link='../_base/page_Blindgyden.php');} # print "<td title=\"Opret ny vare-rabatgruppe\"><a href=\"rabatgrupper.php?vgselfdef=$y\">Ny</a></td>";

  htm_LastFelt();    
  echo '</data-colrlabl>';
### DATA: //  Dette bør ændres så rutinen modtager data i arrays!
  for ($x=1;$x<=$dg_antal;$x++){   # ($linjebg!=$bgcolor5)?$linjebg=$bgcolor5:$linjebg=$bgcolor; #   print '<tr bgcolor="$linjebg">';
  htm_FrstFelt('25%');    ////  Navn:
    if ($drg_antal) {
        htm_HiddVari($name='drg_nr['.$x.']',$val=$dg[$x][0]);     # print '<input type="hidden" name="drg_nr['.$x.']" value = "'.$dg[$x][0].'">';
        print '<input class="inputbox" type="text" name="drgnavn['.$x.']" style="width:180px" value = "'.$dgnavn[$x][0].'">';    #    print '<td colspan="2"><input class="inputbox" type="text" name="drgnavn['.$x.']" value = "'.$dgnavn[$x][0].'"></td>';
      } 
    else { print '<td align="right">'.$dg[$x][0].'</td>'; print '<td>&nbsp;'.$dgnavn[$x][0].'</td>'; }
    htm_HiddVari($name='rabatart['.$x.']',$val=$rabatart[$x]);     #print '<input type="hidden" name="rabatart['.$x.']" value="'.$rabatart[$x].'">';

    htm_NextFelt('15%');  ////  Type:
    if ($rabatart[$x]=="amount") $optlist= [['Mængde relateret rabat','amount','@kr/stk'],['Pris relateret rabat','pct','%']];
    else                         $optlist= [['Pris relateret rabat','pct','%'], ['Mængde relateret rabat','amount','@kr/stk']];
    htm_OptioFlt($type='text', $name='enhed0', $valu= $rabatart[$x], $labl='', $titl='@Vælg den rabat-metode, du ønsker at bruge.',  
                    $revi=true, $optlist, $action='');
    for ($y=1;$y<=$vg_antal;$y++) { //  Dette bør ændres så rutinen modtager data i arrays!
      if (!$dg[$x][0]) {
        if ($id[$x][$y]) $rabat[$x][$y]=str_replace(".",",",$rabat[$x][$y]);
        else $rabat[$x][$y]=NULL; 
        htm_NextFelt('12%');  ////  Data:
        htm_HiddVari($name='id['.$x.']',$val=$id[$x][$y]);                # print '<input type="hidden" name="id['.$x.']['.$y.']" value="'.$id[$x][$y].'">';
        htm_HiddVari($name='rabat['.$x.']['.$y.']',$val=$rabat[$x][$y]);  # print '<input type="hidden" name="rabat['.$x.']['.$y.']" value="'.$rabat[$x][$y].'">';
        htm_HiddVari($name='drg_antal',$val=$drg_antal);                  # print '<input type="hidden" name="drg_antal" value="'.$drg_antal.'">';
        htm_CombFelt($type='text',$name='ny_rabat['.$x.']['.$y.']',$valu='',$labl='@VG'.$y, $titl='@Feltnavn',$revi=true,$rows='2',$width='20px',$step='',$more='');
        # print '<td align="center"><input class="inputbox" type="text" style="text-align:right;width:35px" name="ny_rabat['.$x.']['.$y.']" value="'.$rabat[$x][$y].'"</td>';
      } ;#else print '<td colspan="vg_antal"><br></td>';
    }
#    print '<td>&nbsp;</td></tr>\n';
    htm_LastFelt(); 
  }
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :SYSTEM:
# Kaldes fra:  [_system/page_Varegrupper.php] 
function Panl_Varegrupper(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) { ## out_PanlsSekd.php
  htm_Panl_Top($name= 'systform',$capt= '@Gruppering af varer:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-database','panelW960',__FUNCTION__);
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Varegrupper-konti', '0%','text','','left', ':', ''],
          ['@Tabel &nbsp; ', '20%','text','','left', '@Varegrupper', '@Varegrupper']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Nr',                '3%','data','',['center'], '@Gruppe nummer'.' ','.?.'],
        ['@Beskrivelse',      '17%','data','',['left'  ], '@Beskrivelse af gruppen','@Besk...'],
        ['@Lager-tilgang',     '5%','data','',['center'], '@Konto for...','@Tilg...'],
        ['@Lager-træk',        '5%','data','',['center'], '@Konto for...','@Træk..'],
        ['@Vare-køb',          '5%','data','',['center'], '@Konto for...','@Køb..'],
        ['@Vare-salg',         '5%','data','',['center'], '@Konto for...','@Salg..'],
        ['@Lager-regulering',  '5%','data','',['center'], '@Konto for...','@Regu..'],
        ['@Køb fra EU',        '5%','data','',['center','rgba( 252, 252, 252, .4 )'], '@Konto for...','@Køb..'],
        ['@Salg til EU',       '5%','data','',['center','rgba( 252, 252, 252, .4 )'], '@Konto for...','@Salg..'],
        ['@Køb uden for EU',   '6%','data','',['center','rgba( 252, 252, 252, .4 )'], '@Konto for...','@Køb..'],
        ['@Salg uden for EU',  '6%','data','',['center','rgba( 252, 252, 252, .4 )'], '@Konto for...','@Salg..'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ['@Omvendt betaling', '5%', 'text','',['center'],  '@Omvendt betaligspligt! Afmærk her, hvis denne kundegruppe er omfattet af omvendt betalingspligt.',
                '<a hrefxxx='.$link.' ><input type= "checkbox" name="bold" value="" ></a>','.?.'],
        ['@Moms fri',         '5%', 'text','',['center'],  '@Moms fri. Afmærk her, hvis ....','<a hrefxxx="'.$link.'" ><input type= "checkbox" name="bold" value="" ></a>','.?.'],
        ['@Lager ført',       '5%', 'text','',['center'],  '@Lager ført. Afmærk her, hvis ...','<a hrefxxx="'.$link.'" ><input type= "checkbox" name="bold" value="" ></a>','.?.'],
        ['@Batch kontrol',    '5%', 'text','',['center'],  '@Batch kontrol. Afmærk her, hvis ..','<a hrefxxx="'.$link.'" ><input type= "checkbox" name="bold" value="" ></a>','.?.'],
        ['@Opera -tion',      '5%', 'text','',['center'],  '@Operation. Afmærk her, hvis ..','<a hrefxxx="'.$link.'" ><input type= "checkbox" name="italic" value="" ></a>','.?.'],
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
//    $DATA=   array(
//       ),
    $data= array(
        [['1'],['Ydelser'],[''],[''],['2900'],['1000'],[''],['2700'],['1200'],['2720'],['1250']],
        [['2'],['Handelsvarer'],['55100'],['55100'],['2100'],['1100'],['2600'],['2800'],['1220'],['2820'],['1270']],
        [['3'],['Forbrugsvarer'],[''],[''],['2100'],['1100'],[''],['2800'],['1220'],['2820'],['1270']],
        [['4'],['Fragt/porto'],[''],[''],['2300'],['1300'],[''],['2700'],['1200'],['2720'],['1250']],
      ),  #  DEMOdata
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '160px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );

  str_nl();
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Vare-Prisgrupper', '0%','text','','left', ':', ''],
          ['@Tabel &nbsp;', '20%','text','','left', '@Prisgrupper', '@Prisgrupper'],
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Nr',            '3%','data','',['center'], '@Gruppe nummer'.' ','.?.'],
        ['@Beskrivelse',  '15%','data','',['left'  ], '@Beskrivelse af gruppen','@Besk...'],
        ['@Kost-pris',     '6%','data','',['center'], '@Konto for...','@Kost...'],
        ['@Salgs-pris',    '6%','data','',['center'], '@Konto for...','@Salgs..'],
        ['@Vejl.-pris',    '6%','data','',['center'], '@Konto for...','@Vejl..'],
        ['@B2B-pris',      '6%','data','',['center'], '@Konto for...','@B2B..'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
          ['',         '30%', 'text','',['center'],  '','','.?.']
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
//    $DATA=   array(
//       ),
    $data= array(
                [[''],[''],[''],[''],[''],[''],[''],[''],[''],[''],['']],[[''],[''],[''],[''],[''],[''],[''],[''],[''],[''],['']]
        ),  #  DEMOdata
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '100px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );

  str_nl();
  
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Vare-Tilbudsgrupper', '0%','text','','left', ':', ''],
          ['@Tabel  &nbsp; ', '20%','text','','left', '@Tilbudsgrupper', '@Tilbudsgrupper']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Nr',            '3%','data','',['center'], '@Gruppe nummer'.' ', '.?.'],
          ['@Beskrivelse',  '15%','data','',['left'  ], '@Beskrivelse af gruppen', '@Besk...'],
          ['@Kost-pris',     '6%','data','',['center'], '@Konto for...', '@Kost...'],
          ['@Salgs-pris',    '6%','data','',['center'], '@Konto for...', '@Salgs..'],
          ['@Start-dato',    '6%','data','',['center'], '@Konto for...', '@Strt..'],
          ['@Slut-dato',     '6%','data','',['center'], '@Konto for...', '@Slut..'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
          ['',              '30%', 'text','',['center'],  '','','.?.']
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
//    $DATA=   array(
//       ),
     $data= array(
        [[''],[''],[''],[''],[''],[''],[''],[''],[''],[''],['']],[[''],[''],[''],[''],[''],[''],[''],[''],[''],[''],['']]
      ),  #  DEMOdata
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '100px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );

  str_nl();
  
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Vare-Rabatgrupper', '0%','text','','left', ':', ''],
          ['@Tabel  &nbsp; ', '20%','text','','left', '@Rabatgrupper', '@Rabatgrupper']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Nr',            '3%','data','',['center'], '@Gruppe nummer'.' ',     '.?.'],
          ['@Beskrivelse',  '15%','data','',['left'  ], '@Beskrivelse af gruppen','@Besk...'],
          ['@Type',          '6%','data','',['center'], '@Konto for...',          '@Typ...'],
          ['@Stk. rabat',    '6%','data','',['center'], '@Konto for...',          '@Rabt..'],
          ['@ved antal',     '6%','data','',['center'], '@Konto for...',          '@Antl..'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
          ['',             '30%', 'text','',['center'],  '','','.?.']
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
//    $DATA=   array(
//        ),
    $data= array(
      [[''],[''],[''],[''],[''],[''],[''],[''],[''],[''],['']],[[''],[''],[''],[''],[''],[''],[''],[''],[''],[''],['']]
    ),  #  DEMOdata
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '100px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='@Gem, hvis du har ændret noget ovenfor.');
}


######### :SYSTEM:
# Kaldes fra:  [_system/page_Debkredgrup.php] 
function Panl_DefKredGrp(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) { ## out_PanlsSekd.php
  htm_Panl_Top($name= 'grupform',$capt= '@Debitor- & Kreditor-grupper:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-database','panelW960',__FUNCTION__,$more='');
  textKnap($label='@INFO om grupper', $title='@Her er lidt forklaring omkring brugen af grupper.', $link= '../_base/page_GruppeInfo.php');
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Tabel &nbsp;','20%','text','','left', '@Debitorgrupper', '@Debitorgrupper']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!                             ], ['Næste record'],... # Generel struktur!
          ['D',            '3%','text', '',['center'], '@Medlem af debitorgruppe','D']
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Nr',          '3%','data', '',['center'], '@Gruppe nummer'.' ','...auto...'],
          ['@Beskrivelse','30%','data', '',['left'  ], '@Beskrivelse af gruppen','Besk...'],
          ['@Momsgrp',     '8%','data', '',['center'], '@Momsgruppe som debitorgruppen skal tilknyttes.','@Momsgr...'],
          ['@Samlekt.',    '8%','data', '',['center'], '@Samlekonto for debitorgruppen','S-kt..'],
          ['@Valuta',      '8%','data', '',['center'], '@Den valuta som gruppen føres i','Valu..'],
          ['@Sprog',       '8%','data', '',['center'], '@Det sprog der skal anvendes ved fakturering','Spr..'],
          ['@Modkonto',    '8%','data', '',['center'], '@Modkonto ved udligning af åbne poster','M-kt...'],
          ['@Provision',   '8%','data', '',['right' ], '@Provisionsprocent! Her angives hvor stor en procentdel af dækningsbidraget der medgår ved beregning af provision.','Pro...'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
          ['@OB',      '5%', 'text','',['center'], '@Omvendt betaligspligt! Afmærk her, hvis denne kundegruppe er omfattet af omvendt betalingspligt.','<a hrefxxx="'. 
                $link.'" ><input type= "checkbox" name="bold" value="" ></a>','.?.'],
          ['@B2B',     '5%', 'text','',['center'], '@Business to business! Afmærk her, hvis der skal anvendes b2b priser ved salg til denne kundegruppe.','<a hrefxxx="'.
                $link.'" ><input type= "checkbox" name="italic" value="" ></a>','.?.'],
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
//    $DATA=   array(
//       ),
     $data= array(
        [['1'],['Danske Debitorer'],['S1'],['56100'],['DKK'],['Dansk'],['58000'],['11.2 %']],
        [['2'],['Europæiske Debitorer'],['E1'],[''],['EUR'],['Engelsk'],[''],['']],
        [['3'],[''],[''],[''],[''],[''],[''],['']],
        ),  #  DEMOdata
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '160px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_nl();
  
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Tabel  &nbsp; ', '20%','text','','left', '@Kreditorgrupper', '@Kreditorgrupper']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
          ['K',            '3%','text','',['center'],'@Medlem af kreditorgruppe','K']
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Nr',          '3%','data','',['center'], '@Gruppe nummer'.' ','...auto...'],
          ['@Beskrivelse','30%','data','',['left'  ], '@Beskrivelse af gruppen','Besk...'],
          ['@Momsgrp',     '8%','data','',['center'], '@Momsgruppe som kreditorgruppen skal tilknyttes.','@Momsgr...'],
          ['@Samlekt.',    '8%','data','',['center'], '@Samlekonto for kreditorgruppen','S-kt..'],
          ['@Valuta',      '8%','data','',['center'], '@Den valuta som gruppen føres i','Valu..'],
          ['@Sprog',       '8%','data','',['center'], '@Det sprog der skal anvendes ved kommunikation med kreditoren','Spr..'],
          ['@Modkonto',    '8%','data','',['center'], '@Modkonto ved udligning af åbne poster','M-kt...'],
          ['@S.moms grp',  '8%','data','',['center'], '@Momsgruppe for salgsmoms ved omvendt betalingspligt.','M-grp...'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
          ['@OB',          '5%','text','',['center'], '@Omvendt betaligspligt! Afmærk her, hvis denne leverandørgruppe er omfattet af omvendt betalingspligt.','<a hrefxxx="'.
                $link.'" ><input type= "checkbox" name="bold" value="" ></a>','.?.'],
          ['',             '5%','text','2d',['right'], '@Business to business! Afmærk her, hvis der skal anvendes b2b priser ved salg til denne leverandørgruppe.'],
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
//    $DATA=   array(
//       ),
    $data= array(
          [['1'],['Danske Kreditorer'],['K1'],['65100'],['DKK'],['Dansk'],['58000'],['']],
          [['2'],[''],[''],[''],[''],[''],[''],['']],
        ),  #  DEMOdata
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '160px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_nl(1);
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

  
######### :SYSTEM:
# Kaldes fra: 
function Panl_Syssetup() { ## out_PanlsSekd.php
  htm_Panl_Top($name= 'systform',$capt= '@Varegrupper:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-database','panelW960',__FUNCTION__);
  $spantekst1= tolk('@En beskrivende tekst efter eget valg');
	$spantekst2= tolk('@Det nummer i kontoplanen som salgsmomsen skal konteres p&aring;.');
	$spantekst3= tolk('@Moms %.');
  htm_PanlBund($pmpt='@Gem',$subm=true);
}



######### :SYSTEM:
# Kaldes fra: 
function Panl_AdminMenu() {global $ØProgRoot, $ØLineBrun; ## out_PanlsSekd.php
//  Ny opdeling: Regnskabs-indstillinger og Program-indstillinger ?
  htm_Panl_Top($name='adminform',$capt='@Indstillinger 1, Ofte.',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-bars',$klasse='panelW240',__FUNCTION__);
  $goBack= '';  $knapW= 200;
  htm_CentrOn();
             menuKnap($h='22',$w=$knapW,$label='@Valuta',                 $link=$ØProgRoot.'_system/page_Valuta.php',       $title='@Indstillinger angående valuta');
  htm_nl();  menuKnap($h='22',$w=$knapW,$label='@Moms',                   $link=$ØProgRoot.'_system/page_Momssetup.php',    $title='@Indstillinger angående moms');
  htm_nl();  menuKnap($h='22',$w=$knapW,$label='@Debitor & Kreditor Grp.',$link=$ØProgRoot.'_system/page_Debkredgrup.php',  $title='@Indstillinger angående grupper');
  htm_nl();  menuKnap($h='22',$w=$knapW,$label='@Afdelinger',             $link=$ØProgRoot.'_system/page_Afdelinger.php',   $title='@Indstillinger angående Afdelinger');
  htm_nl();  menuKnap($h='22',$w=$knapW,$label='@Projekter',              $link=$ØProgRoot.'_system/page_Projekter.php',    $title='@Indstillinger angående Projekter');
  htm_nl();  htm_hr($ØLineBrun);  
             menuKnap($h='22',$w=$knapW,$label='@Lagre',                  $link=$ØProgRoot.'_system/page_Lagre.php',        $title='@Indstillinger angående Lagre');
  htm_nl();  menuKnap($h='22',$w=$knapW,$label='@Varegrupper',            $link=$ØProgRoot.'_system/page_Varegrupper.php',  $title='@Indstillinger angående Varegrupper');
  htm_nl();  menuKnap($h='22',$w=$knapW,$label='@Rabatgrupper',           $link=$ØProgRoot.'_system/page_Rabatgrupper.php', $title='@Indstillinger angående Rabatgrupper');
  htm_nl();  menuKnap($h='22',$w=$knapW,$label='@Enheder & materialer',   $link=$ØProgRoot.'_system/page_Enheder.php',      $title='@Indstillinger angående registrede Enheder, beskrivelse og materiale');
  htm_nl();  htm_hr($ØLineBrun);  
             menuKnap($h='22',$w=$knapW,$label='@Firma stamdata',         $link=$ØProgRoot.'_system/page_Stamkort.php',     $title='@Indstillinger angående Stamdata');
  htm_nl();  menuKnap($h='22',$w=$knapW,$label='@Bruger rettigheder',     $link=$ØProgRoot.'_system/page_Brugere.php',      $title='@Indstillinger angående Brugere');
  htm_nl();  menuKnap($h='22',$w=$knapW,$label='@Regnskabsår',            $link=$ØProgRoot.'_system/page_Regnskabsaar.php', $title='@Indstillinger angående Regnskabsår');
  htm_nl();  menuKnap($h='22',$w=$knapW,$label='@Udskrivnings Formularer',$link=$ØProgRoot.'_system/page_FormText.php',     $title='@Indstillinger angående udskrivnings blanketter / Formularer');
  htm_nl();  menuKnap($h='22',$w=$knapW ,$label='@Administrator menu',    $link=$ØProgRoot.'_base/page_Blindgyden.php',     $title='@Indstillinger angående oprettelse/nedlægning/omdøbning af Regnskaber m.v.');
  htm_nl();  htm_hr($ØLineBrun);  
            // menuKnap($h='22',$w=$knapW,$label='@Udvikling: Layouttest',  $link=$ØProgRoot.'_base/page_Layoutdemo.php',     $title='@Visning af eksempler på panelers opbygning.');
  htm_nl();    
  // htm_nl();  naviKnap($label='@Hovedmenu', $title='@Vend tilbage til programmets hovedmenu',$link='../_base/page_Hovedmenu.php',$akey='h');
  // htm_nl();  naviKnap($label='@Indstillinger 1', $title='@Gå til en anden indstillings menu',$link='../_system/page_Valuta.php',$akey='1');
  htm_nl();  naviKnap($label='@Indstillinger 2', $title='@Gå til en anden indstillings menu',$link='../_system/page_Divsetup2.php',$akey='2');
  htm_nl();  naviKnap($label='@Indstillinger 3', $title='@Gå til en anden indstillings menu',$link='../_system/page_Tilvalgsetup3.php',$akey='3');
  //  htm_nl();  textKnap($label='@Flere indstillinger 2.',  $title='@Diverse indstillinger', $link=$ØProgRoot.'_system/page_Divsetup2.php',$akey='2');
  htm_nl();
  htm_CentOff();
  htm_PanlBund($pmpt=Tolk('@Retur til hovedmenu'),$subm=false,$title='@Luk og gå retur til hovedmenu');
};

######### :SYSTEM:
# Kaldes fra:  [_system/page_Bilagsinfo.php] [_system/page_Differencer.php] [_system/page_Diversevalg.php] [_system/page_Divsetup2.php] [_system/page_Formtekst.php] [_system/page_Imogexport.php] [_system/page_Kontoindstill.php] [_system/page_Massefakt.php] [_system/page_Ordrerelat.php] [_system/page_Personlig.php] [_system/page_Prislister.php] [_system/page_Programsprog.php] [_system/page_Provision.php] [_system/page_Rykkerrel.php] [_system/page_Tjeklister.php] [_system/page_Varerelat.php] [_system/page_xxx.php] 
function Panl_DiverseMenu() {global $ØLineBrun; ## out_PanlsSekd.php
//  Ny opdeling: Regnskabs-indstillinger og Program-indstillinger ?
  htm_Panl_Top($name='adminform',$capt='@Indstillinger 2, Flere.',$parms='../_system/page_Valuta.php',$icon='fas fa-bars',$klasse='panelW240',__FUNCTION__);
  $goBack= '?returside=../_base/menu.php';
  $knapW= 220;
  htm_CentrOn();
            menuKnap($h='22',$w=$knapW ,$label='@Kontoindstilling',      $link='../_system/page_Kontoindstill.php',  $title='@Indstillinger angående regnskabsnavn og mailserver for afsendelse af mail');
  htm_nl(); menuKnap($h='22',$w=$knapW ,$label='@Provisionsberegning',   $link='../_system/page_Provision.php',    $title='@Indstillinger angående Provisionsberegning');
# htm_nl();  menuKnap($h='22',$w=$knapW ,$label='@Varerelateret',         $link='../_system/page_Varerelat.php',  $title='@Indstillinger angående Varerelateret f.eks. varianter');
  htm_nl(); menuKnap($h='22',$w=$knapW ,$label='@Ordrerelaterede valg',  $link='../_system/page_Ordrerelat.php',   $title='@Indstillinger angående Ordrerelaterede valg');
  htm_nl(); menuKnap($h='22',$w=$knapW ,$label='@Varerelaterede valg',   $link='../_system/page_Varerelat.php',    $title='@Indstillinger angående Varerelateret f.eks. varianter');
  htm_hr($ØLineBrun); 
            menuKnap($h='22',$w=$knapW ,$label='@Prislister',            $link='../_system/page_Prislister.php',   $title='@Indstillinger angående Prislister');
  htm_nl(); menuKnap($h='22',$w=$knapW ,$label='@Bilagshåndtering',      $link='../_system/page_Bilagsinfo.php',   $title='@Indstillinger angående Bilagshåndtering');
  htm_nl(); menuKnap($h='22',$w=$knapW ,$label='@Diverse valg',          $link='../_system/page_Diversevalg.php',  $title='@Indstillinger angående Diverse valg');
  htm_nl(); htm_hr($ØLineBrun); 
            menuKnap($h='22',$w=$knapW ,$label='@Rykkerrelateret',       $link='../_system/page_Rykkerrel.php',    $title='@Indstillinger angående Rykkerrelaterede');
  htm_nl(); menuKnap($h='22',$w=$knapW ,$label='@Tjeklister',            $link='../_system/page_Tjeklister.php',   $title='@Indstillinger angående Tjeklister');
  htm_nl(); menuKnap($h='22',$w=$knapW ,$label='@Øredifferencer',        $link='../_system/page_Differencer.php',  $title='@Indstillinger angående Øredifferencer');
  htm_nl(); menuKnap($h='22',$w=$knapW ,$label='@Massefakturering',      $link='../_system/page_Massefakt.php',    $title='@Indstillinger angående Massefakturering');
  htm_nl(); htm_hr($ØLineBrun); 
            menuKnap($h='22',$w=$knapW ,$label='@Personlige valg',       $link='../_system/page_Personlig.php',    $title='@Indstillinger angående Farver og udseende m.v.');
  htm_nl(); menuKnap($h='22',$w=$knapW ,$label='@Program Sprog',         $link='../_system/page_Programsprog.php', $title='@Indstillinger angående programmets Sprog');
  htm_nl(); menuKnap($h='22',$w=$knapW ,$label='@Formular Sprog',        $link='../_system/page_Formtekst.php',    $title='@Indstillinger angående Sprog på blanketter');
  htm_nl(); menuKnap($h='22',$w=$knapW ,$label='@Data import & eksport', $link='../_system/page_Imogexport.php',   $title='@Importér / eksportér: Kontoplan, Formularer, Debitorer, Kreditorer, Varer, og Dataudtræk');
  //htm_nl(2); naviKnap($label='@Tilvalgs indstillinger 3.', $title='@Indstillinger, som angår tilvalgs funktioner', $link='../_system/page_Tilvalgsetup3.php',$akey='3');
  htm_nl();    
  //  htm_nl(); naviKnap($label='@Hovedmenu', $title='@Vend tilbage til programmets hovedmenu',$link='../_base/page_Hovedmenu.php',$akey='h');
  htm_nl(); naviKnap($label='@Indstillinger 1', $title='@Gå til en anden indstillings menu',$link='../_system/page_Valuta.php',$akey='1');
  //  htm_nl();  textKnap($label='@Indstillinger 2', $title='@Gå til en anden indstillings menu',$link='../_system/page_Divsetup2.php',$akey='2');
  htm_nl(); naviKnap($label='@Indstillinger 3', $title='@Gå til en anden indstillings menu',$link='../_system/page_Tilvalgsetup3.php',$akey='3');
  htm_nl(); htm_CentOff();
  htm_PanlBund($pmpt=Tolk('@Retur til indstillinger 1.'),$subm=false,$title='@Luk og gå retur til indstillingsmenu');
};

######### :SYSTEM:
# Kaldes fra:  [_system/page_Labels.php] [_system/page_Tilvalgsetup3.php] 
function Panl_TilvalgsMenu() {global $ØProgTitl, $ØLineBrun; ## out_PanlsSekd.php
  htm_Panl_Top($name='tilvform',$capt='@Indstillinger 3, Tilvalg',$parms='../_system/page_Divsetup2.php',$icon='fas fa-bars',$klasse='panelW240',__FUNCTION__);
  $goBack= '?returside=../_base/menu.php';
  $knapW= 220;
  htm_CentrOn();
  htm_hr($ØLineBrun);  htm_Caption('@Tillægs funktioner:');
  htm_nl();  menuKnap($h='22',$w=$knapW ,$label='@Aktivering af moduler',       $link='../_system/page_Tilvalg.php',         
          $title='@Indstillinger angående aktivering af ekstra moduler m.v.');
  htm_nl();  menuKnap($h='22',$w=$knapW ,$label='@Shop relaterede valg (WEB)',  $link='../_base/page_Blindgyden.php',   
          $title='@Indstillinger angående WEB-Shop relaterede valg');
  htm_nl();  menuKnap($h='22',$w=$knapW ,$label='@Web API',                     $link='../_base/page_Blindgyden.php',         
          $title= tolk('@Indstillinger angående API (Application Programming Interface), en softwaregrænseflade, der tillader').
          $ØProgTitl.' '.tolk('@at interagere med andet software'));
  htm_nl();  menuKnap($h='22',$w=$knapW ,$label='@PoS-valg (Kasse/kontantsalg)',$link='../_base/page_Blindgyden.php',         
          $title='@Indstillinger angående PoS-valg (Point-of-Sale), angår kasseapparat løsningen');
  htm_nl();  menuKnap($h='22',$w=$knapW ,$label='@Label print',                 $link='../_system/page_Labels.php',       
          $title='@Indstillinger angående Labels');
  htm_CentOff();
  htm_nl();
  htm_CheckFlt($type='checkbox',$name='docubizz', $valu= $docubizz,  $labl='@Integration med DocuBizz', 
          $titl='@Import fra DocuBizz - Det intelligente fakturasystem',  $revi=true, $more=' '.$pg);
  
  htm_CheckFlt($type='checkbox',$name='ebconn', $valu= $ebconn,  $labl='@Integration med ebConnect',    
          $titl='@Elektronisk fakturering. Send og modtag e-faktura med ebconnect. Send direkte fra økonomisystemet og overfør til kassekladden - klar til bogføring');

  htm_CentrOn();
  //  htm_nl();  naviKnap($label='@Hovedmenu', $title='@Vend tilbage til programmets hovedmenu', $link='../_base/page_Hovedmenu.php',$akey='h');
  htm_nl();  naviKnap($label='@Indstillinger 1', $title='@Gå til en anden indstillings menu',$link='../_system/page_Valuta.php',$akey='1');
  htm_nl();  naviKnap($label='@Indstillinger 2', $title='@Gå til en anden indstillings menu',$link='../_system/page_Divsetup2.php',$akey='2');
  //  htm_nl();  naviKnap($label='@Indstillinger 3', $title='@Gå til en anden indstillings menu',$link='../_system/page_Tilvalgsetup3.php',$akey='3');
  htm_nl();  
  htm_CentOff();
  htm_PanlBund($pmpt=Tolk('@Retur til indstillinger 2.'), $subm=false, $title='@Luk og gå retur til indstillingsmenu');
};


######### :SYSTEM:
# Kaldes fra: [_system/page_Tilvalg.php]  [_system/page_Tilvalgsetup3.php]
function Panl_Tilvalg() 
{global $ØProgTitl, $ØLineBrun; ## out_PanlsSekd.php
  global $Øvis_finans, $Øvis_debitor, $Øvis_kreditor, $Øvis_prodkt, $Øvis_lager;
  htm_Panl_Top($name='tilvform',$capt='@Aktivering af moduler',$parms='#',$icon='fas fa-bars',$klasse='panelW320',__FUNCTION__);
  $goBack= '?returside=../_base/menu.php';
  $knapW= 220;
  htm_CentrOn();
  htm_Caption('@SALDI´s program moduler:');
  htm_CentOff();
  $Øvis_finans=   htm_CheckFlt($type='checkbox',$name='fin', $valu= $Øvis_finans,   $labl='@FINANS',      $titl='@Regnskabsføring i finans-modulet');
  $Øvis_debitor=  htm_CheckFlt($type='checkbox',$name='deb', $valu= $Øvis_debitor,  $labl='@DEBITOR',     $titl='@Salg til kunder i debitor-modulet');
  $Øvis_kreditor= htm_CheckFlt($type='checkbox',$name='kre', $valu= $Øvis_kreditor, $labl='@KREDITOR',    $titl='@Indkøb fra leverandører i kreditor-modulet');
  $Øvis_lager=    htm_CheckFlt($type='checkbox',$name='lag', $valu= $Øvis_lager,    $labl='@LAGER',       $titl='@Produkter til salg i lager-modulet');
  $Øvis_prodkt=   htm_CheckFlt($type='checkbox',$name='pro', $valu= $Øvis_prodkt,   $labl='@PRODUKTION',  $titl='@Administration i produktions-modulet');
  htm_Plaintxt('Disse moduler er altid aktive, men de kan "slukkes" i menu-systemet.');
// $Øvis_finans=    $_POST['fin'];
// $Øvis_debitor=   $_POST['deb'];
// $Øvis_kreditor=  $_POST['kre'];
// $Øvis_lager=     $_POST['lag'];
// $Øvis_prodkt=    $_POST['pro'];
  htm_hr($ØLineBrun); 
  htm_nl();
  htm_CentrOn();
  htm_Caption('@SALDI´s tillægs moduler:');
  htm_CentOff();
  htm_CheckFlt($type='checkbox',$name='pos', $valu= $pro, $labl='@KASSE',       $titl='@Kontantsalg. Benyt POS-modul (Point Of Sale)',  $revi=false);
  htm_CheckFlt($type='checkbox',$name='web', $valu= $pro, $labl='@WEB-shop',    $titl='@Integration med net-butik',  $revi=false);
  htm_Plaintxt('Disse moduler kræver supplerende installation, før de kan benyttes.');
  htm_PanlBund($pmpt=('@Gem'), $subm=true, $title='');
};


######### :SYSTEM:
# Kaldes fra: [_base/page_Install.php] [_base/page_Startup.php] [_system/page_Connsetup.php] 
function Panl_DBsetup(&$db_type,&$db_encode,&$db_navn,&$db_bruger,&$db_password,&$adm_navn,&$adm_password,&$verify_adm_password,&$db_host) { ## out_PanlsSekd.php
  global $ØButtnBgrd, $ØButtnText, $ØProgTitl, $Ønovice; 
  htm_Panl_Top($name='opret',$capt=$ØProgTitl.'-<small> € :</small> '.Tolk('@Database setup'),$parms='../_admin/ini_CreateDB.php.php',$icon='fas fa-wrench',$klasse='panelW320',__FUNCTION__);
  htm_CombFelt($type='text',  $name='db_host',    $valu= $db_host,    
               $labl='@Server vært', 
               $titl='@Navn på den leverandør, der står for serverdriften. ',
               $revi=true, $rows='2',$width='',$step='', $more=' ', $plho=tolk('@Angiv HOST-leverandør...'));
  htm_OptioFlt($type='text',  $name='db_type',    $valu= $db_type,  
                    $labl='@Server type',  
                    $titl='@Vælg den databaseserver type, du ønsker at bruge.', 
                    $revi=true, $optlist= array(
                    ['@PostgreSQL','PostgreSQL','@PostgreSQL'],
                    ['@MySQL','MySQL','@MySQL']),$action='');
  htm_OptioFlt($type='text',  $name='db_encode',    $valu= $db_encode,  
                    $labl='@Tegnsæt',         
                    $titl='@Vælg det tegnsæt du ønsker at bruge. Nyere versioner af PostgreSQL fungerer kun med UTF8, som anbefales generelt',  
                    $revi=true, $optlist= array(
                    ['@Vælg UTF8 tegnsæt','UTF8','UTF8'],
                    ['@Vælg LATIN9 tegnsæt','LATIN9','LATIN9']),$action='');
  htm_Caption('@Adgang til database server:');
  htm_CombFelt($type='text',  $name='db_bruger',    $valu= $db_bruger,    
               $labl='@Aktiv databaseadministrator', 
               $titl=tolk('@Navn på en eksisterende bruger, som har tilladelse til at oprette, rette og slette databaser. ').'<br>'.
                     tolk('@Typisk er det for PostgreSQL brugeren [postgres] og for MySQL brugeren [root].'),                          
               $revi=true, $rows='2',$width='',$step='', $more=' required ', $plho=tolk('@Angiv DB-admin...'));
  htm_CombFelt($type='password',  $name='db_password',  $valu= $db_password, 
               $labl='@Adgangskode for databaseadministrator',  
               $titl='@Adgangskode for ovenstående bruger',                          
               $revi=true, $rows='2',$width='',$step='', $more='required ', $plho=tolk('@Password...'));
  htm_Caption('@Opret'.$ØProgTitl.' database:');
  htm_CombFelt($type='text',  $name='db_navn',      $valu= $db_navn,      
               $labl='@Databasenavn',                
               $titl=tolk('@Ønsket navn på din hoveddatabase for').$ØProgTitl.tolk('@ F.eks.').': [saldi-db]',  
               $revi=true, $rows='2',$width='',$step='', $more='required ', $plho=tolk('@Angiv et navn til databasen...'));
  htm_CombFelt($type='text',  $name='adm_navn',     $valu= $adm_navn,     
               $labl=$ØProgTitl.'-'.tolk('@administratorens brugernavn'), 
               $titl=tolk('@Ønsket navn på din').$ØProgTitl.'-'.tolk('@administratorkonto til dit').$ØProgTitl.'-system. F.eks.: [saldi-admin]',  
               $revi=true, $rows='2',$width='',$step='', $more='required ', $plho=tolk('@Angiv admin...'));
# echo '<form>';
  htm_CombFelt($type='passwordpower', $name='passwordpwr',  $valu= $adm_password,   
                $labl=$ØProgTitl.'-'.tolk('@administratorens adgangskode'),  
                $titl=tolk('@Ønsket adgangskode for').$ØProgTitl.'-'.tolk('@administratoren af dit').$ØProgTitl.'-system',
                $revi=true, $rows='2',$width='',$step='', $more='required ', $plho=tolk('@Password...'));
  htm_CombFelt($type='password',  $name='confirm_password', $valu= $verify_adm_password,    
                $labl=tolk('@Gentag').$ØProgTitl.'-'.tolk('@administratorens adgangskode'), 
                $titl='@Verificering af ovenstående adgangskode',                         
                $revi=true, $rows='2',$width='',$step='', $more='required ', $plho=tolk('@Gentag password...'));
//  echo '<div align= "center"><button type="submit" name="submit" class="tooltip" style="margin: 1px 1px; padding: 1px 3px; background:'.$ØButtnBgrd.'; color:'.$ØButtnText.';" ">'.
//          tolk('@Kontrollèr Administrators Passwords').'<span class="tooltiptext">'.tolk('@Test om de indtastede password er ens.').'</span></button></div>';
# echo '</form>';
  
  htm_hr();
//  userTip(); $Ønovice
  if (true) {
    echo '<div style="text-align:left"><small><b>'.tolk('@Alle').'</b> '.tolk('@felter skal udfyldes og kontrolleres.').' <br>&nbsp;&nbsp;<br>';
    echo '<b>'.tolk('@TIP:').'</b> '.tolk('@Hold musen over blå tekster, for at få hjælpetip.').'</small></div>';
  }
  echo '<br><div style="text-align:left"><small><b>'.tolk('@HUSK:').'</b> '.tolk('@Skrivebeskyt alle programmets mapper på serveren, på nær: ').
       '<br>../_config ../_exchange ../_temp ../_userlib '.
       tolk('@og undermapper heri.<br>Mappen ../_config indeholder oplysninger om adgang til databasen, men disse beskyttes af en .htaccess fil.').'</small></div>';
  htm_PanlBund($pmpt=Tolk('@Opret DB'),$subm=true,$title=tolk('@Klik her for at oprette dit').$ØProgTitl.' database-system');

  /*  Vis password som tekst:
  run_Script('$(".toggle-password").click(function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") 
           { input.attr("type", "text"); } 
      else { input.attr("type", "password"); }
    });
  ');
  /*
    .field-icon {
      float: right;
      margin-left: -25px;
      margin-top: -25px;
      position: relative;
      z-index: 2;
    }
*/
  
/*  Password-felt med øje:
  echo ' <div>
            <input id="password-field" type="password" class="form-control" name="password" value="secret">
            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
        </div>
  ';
*/
  echo '<script>';
  echo 'var password = document.getElementById("passwordpwr"), ';
  echo '  confirm_password = document.getElementById("confirm_password");';
  echo 'function validatePassword(){';
  echo '  if(password.value != confirm_password.value) ';
  echo '    {confirm_password.setCustomValidity("'.tolk('@Passwords er forskellige').'"); } ';
  echo '  else {confirm_password.setCustomValidity("");   }';
  echo '}';
  echo 'if (password) password.onchange = validatePassword;';
  echo 'confirm_password.onkeyup = validatePassword;';
  echo '</script>';
}

######### :SYSTEM:
# Kaldes fra:  [_base/page_Install.php] [_base/page_Startup.php] [_system/page_Connsetup.php] 
function Panl_Install(&$db_type,&$db_encode,&$db_navn,&$db_bruger,&$db_password,&$adm_navn,&$adm_password,&$verify_adm_password) { global $ØProgTitl;  ## out_PanlsSekd.php
# Test for skrivbarhed:
  if ($fp=fopen("../_config/connect.php","a"))   { fclose($fp); $inc='checked';} else $inc.='';
  if ($fp=fopen("../_temp/test.txt","w"))        { fclose($fp); $tmp='checked';} else $tmp.='';
  if ($fp=fopen("../_exchange/test.txt","w"))    { fclose($fp); $exc='checked';} else $exc.='';
  if ($fp=fopen("../_userlib/test.txt","w"))     { fclose($fp); $lgo='checked';} else $lgo.='';
#+  
  if (extension_loaded('mysqli')) {if ($link= mysqli_connect("")) {$mq= 'checked'; mysqli_close($link);}  else $mq= '';}  else $mq= '';
  if (extension_loaded('pgsql'))  {if (pg_connect(""))            {$pg= 'checked'; pg_close();}           else $pg= '';}  else $pg= '';
  if ($mq) $mqtx= tolk('@findes');   else $mqtx= tolk('@mangler');
  if ($pg) $pgtx= tolk('@findes');   else $pgtx= tolk('@mangler');
  if (ØisSecure()) $sec = 'checked'; else $sec = '';
  htm_Panl_Top($name='opret',$capt= '@Installations forberedelse',$parms='../_base/_admin/ini_CreateDB.php',$icon='fas fa-wrench',$klasse='panelW320',__FUNCTION__);
 echo '<div style="text-align:left"><small>'.'<b>'.
      tolk('@Nødvendig forberedelse:').'</b><br> '.
      tolk('@En webserver med PHP skal være i drift, med DB-extension pqsql eller mysqli aktiveret.').' <br>'.
      tolk('@På serveren skal være installeret en af database serverne PostgreSQL eller MySQL-kompatibel.').'<br>';
      tolk('@I PHP skal ZIP-extension være aktiv, for at kunne udføre program-backup.').'<br>';
      //  MySQL:mysqldump eller Postgre:export, for at kunne udføre DB-backup.
      //  system: mv tar gzip, for kunne udføre operationer på filer.
  
  htm_FrstFelt('50%');  
  htm_StatsFlt($type='status',$name='pg',     $valu= ($pg== 'checked'), $labl='@Postgres '.$pgtx,  $titl='@Systemet kontrollerer om modulet er tilgængeligt. ');
  htm_NextFelt('50%');  
  htm_StatsFlt($type='status',$name='mysql',  $valu= ($mq== 'checked'), $labl='@MySQL '.$mqtx,     $titl='@Systemet kontrollerer om modulet er tilgængeligt. ');
  htm_LastFelt();
  echo '<hr>'.tolk('@Hvis systemet ikke køres på lokalnet, bør det ske via en sikker krypteret forbindelse:').'<br/>';
  htm_StatsFlt($type='status',$name='https',  $valu= ØisSecure() ,      $labl='@HTTPS er aktiv.',   $titl='@Systemet kontrollerer om HTTPS er benyttet.');
  echo '</div><hr>'.
      tolk('@Pakken med').$ØProgTitl.'-'.tolk('@filer, udpakkes i en program mappe, med adgang for webbesøgende. Navngiv den f.eks.: saldi-e').'<br><br>'.
      tolk('@Der skal være skriveadgang til 4 under-mapper:').'<br>';
  htm_FrstFelt('50%');
  htm_StatsFlt($type='status',$name='conf', $valu= ($inc== 'checked'),  $labl='_config',    $titl='@Systemet kontrollerer om mappen, angående systemets konfiguration, er skrivbar');
  htm_NextFelt('50%');
  htm_StatsFlt($type='status',$name='exch', $valu= ($exc== 'checked'),  $labl='_exchange',  $titl='@Systemet kontrollerer om mappen, som benyttes til import/eksport, er skrivbar');
  htm_LastFelt();
  htm_FrstFelt('50%');
  htm_StatsFlt($type='status',$name='temp', $valu= ($tmp== 'checked'),  $labl='_temp',      $titl='@Systemet kontrollerer om mappen, som benyttes til midlertidige filer, er skrivbar');
  htm_NextFelt('50%');
  htm_StatsFlt($type='status',$name='llib', $valu= ($lgo== 'checked'),  $labl='_userlib',   $titl='@Systemet kontrollerer om mappen, som benyttes til bruger-filer, er skrivbar');
  htm_LastFelt();
  echo tolk('@Alle andre mapper skal være skrivebeskyttet, når systemets filer er på plads!');
//      .'<hr><b>PHP </b>'. tolk('@skal understøtte modulerne: mcrypt og hash, som benyttes til at håndtere passwords sikkert.').'<br>';
//  htm_FrstFelt('50%');  
//  htm_CheckFlt($type='checkbox',$name='hash',   $valu= '',  $labl='@hash installeret.', $titl='@Systemet kontrollerer om modulet er tilgængeligt',  $revi=false,$more='checked="'.extension_loaded('hash').'"');
//  htm_NextFelt('50%');  
//  htm_CheckFlt($type='checkbox',$name='mcrypt', $valu= '',  $labl='@mcrypt installeret.', $titl='@Systemet kontrollerer om modulet er tilgængeligt',  $revi=false,$more='checked="'.extension_loaded('mcrypt').'"');
//  htm_LastFelt();
  $txt1 = '<small> ('.tolk('@Gælder kun SALDI ver.3.x').')</small>';
  echo '<hr>'.
      tolk('@For at udnytte alle udskrivnings faciliteter, skal webserveren understøtte ekstra PDF/Grafik-programmer.').' <br>'. '<br><b>Ghostscript & ps2pdf</b> '.
      tolk('@for at kunne udskrive formularer.').$txt1.'<br><b>ImageMagic</b> '.
      tolk('@er nødvendig for at flette udskrift med Logo.').$txt1. '<br><b>PDFtk</b> - '.
      tolk('@The PDF Toolkit: flette pdf-baggrund med sideudskrift.').$txt1;
  echo '<hr><div style="text-align:left">'.
      tolk('@Bemærkt også, at').' <b>javascript</b> '.
      tolk('@skal være aktiveret !');
  echo '<hr>'.
      tolk('@Oprettelse af regnskab, sker senere, når du 1. gang logger ind, som ').$ØProgTitl.'-administrator.'.'<br><br>'.
      tolk('@På').$ØProgTitl.'-wiki '.tolk('@kan du læse supplerende informationer.');
  echo '</small></div>';
  htm_PanlBund($pmpt=Tolk('@Installér'),$subm=false,$title=tolk('@Klik her for at oprette dit').$ØProgTitl.' database-system');
}

######### :SYSTEM:
# Kaldes fra: 
function Panl_InstallFail($noskriv) { global $ØProgTitl; ## out_PanlsSekd.php
  htm_Panl_Top($name= 'opret', $capt= '@Installation fejler!', $parms='db_setup.php', $icon='fas fa-wrench', $klasse='panelW320',__FUNCTION__);
    echo '<b>'.tolk('@Problem:').'</b><br>';
    echo tolk('@Der er ikke skriveadgang til kataloget:'),' "'.$noskriv.'"<br>';
    // if (extension_loaded('mcrypt') && extension_loaded('hash')) { $ext_loaded=true;  }
    if ($noskriv=="_config") 
    echo tolk('@hvor filen "connect.php" skal oprettes.').'<br><br>';
    echo tolk('@Sørg for at der er skriveadgang for Webbrugere, til katalogerne').': "_config", "_temp", "_userlib" <br><br>';
    echo tolk('@Se hvordan i installeringsvejledningen INSTALLATION.txt.').' <br><br>';
  htm_PanlBund($pmpt= Tolk('@Installér'),$subm=false,$title=tolk('@Klik her for at oprette dit').$ØProgTitl.' database-system');
}

######### :SYSTEM:
# Kaldes fra: 
function Panl_InstallSucces(&$db_navn, &$adm_navn) { global $ØProgTitl; ## out_PanlsSekd.php
  htm_Panl_Top($name='oprettet',$capt= '@Databasen er installeret',$parms='page_Blindgyden.php',$icon='fas fa-wrench',$klasse='panelW320',__FUNCTION__);
    echo '<b>'.tolk('@Bravo:').'</b><br>';
    echo tolk('@Dit'.$ØProgTitl.'-system er nu oprettet. Det første, du nu skal gøre, er at oprette et regnskab.').'<br><br>';
    echo tolk('@Det gøres ved at logge ind med: ').'<br>[<b>'.$db_navn.'</b>] '.tolk('@som regnskab').', <br>[<b>'.$adm_navn.'</b>] ';
    echo tolk('@som brugernavn og med den valgte adgangskode').'<br><br>';
    echo tolk('@Tegn en hotline-aftale, så kan du ringe eller sende en e-mail og få hurtigt svar på spørgsmål om brugen af'.$ØProgTitl.'.').'<br><br>';
    echo tolk('@Se mere på').' <a href="http://saldi.dk/hotline" target="_blank">http://saldi.dk/hotline</a> <br>';
//    echo '<p>&nbsp;</p><br>';
//    echo '<p><a href="../_base/index.php" title="Til SALDI-administratorsiden hvor regnskaber administreres" <br>';
//    echo ' style="text-decoration:none"><input type="button" value="Fortsæt"></a><br><br>';
  htm_PanlBund($pmpt=Tolk('@Fortsæt'),$subm=true,$title='@Fortsæt til logind og oprettelse af 1. regnskab');
}


######### :SYSTEM:
# Kaldes fra: [_base\out_vinduer.php]
function Panl_Tabel($TablData=array()) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'naviform',$capt= '@DEMO: Tabel med fastlåst kolonne-header og "rulle-vindue"',$parms='page_Blindgyden.php',$icon='fas fa-database','panelWmax',__FUNCTION__);
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),  // if (($ModifyRec) or ($RowBody[0][2]!='indx')) er 2% benyttet til => knap
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Lb.Nr.',     '6%', '',''    , ['center'], '','..auto..'],
          ['@Ordre dato', '8%', '','date', ['left'  ], '', 'YYYY-MM-DD'],
          ['@Lev. dato',  '8%', '','date', ['left'  ], '', 'YYYY-MM-DD'],
          ['@Konto nr.',  '7%', '','text', ['center'], '', tolk('@Kont...')],
          ['@Firma navn','24%', '',''    , ['left'  ], '', tolk('@Firm...')],
          ['@Sælger',     '8%', '',''    , ['left'  ], '', tolk('@Sælg...')],
          ['@Ordre sum',  '7%', '',''    , ['right' ], '', tolk('@Beløb...')]
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON, ]
    $DATA= array( # DemoData:
            ['1025','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1026','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1027','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1025','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1026','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1027','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1025','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1026','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1027','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1025','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1026','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1027','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1025','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1026','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1027','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1028','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum']
          ),#=   array(),
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter   //  Virker ikke med hidd-felter!
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at vælge og ændre data i en row
    $ViewHeight= '400px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__,
    $Kriterie= ['','']    # Test [DataKolonneNr, > grænseværdi] Undlad spec. feltColor
  );
  htm_PanlBund($pmpt='@Gem',$subm=false);
}

######### :SYSTEM:
# Kaldes fra: [_base\out_vinduer.php]
function Panl_Debitorer($TablData=array()) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'naviform',$capt= '@Konti - Debitorer:',$parms='page_Blindgyden.php',$icon='fas fa-database','panelWmax',__FUNCTION__,'','legeplads:lege-side#kunden');
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),  // if (($ModifyRec) or ($RowBody[0][2]!='indx')) er 2% benyttet til => knap
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Kontonr.',   '6%','','',[''],'','..auto..'],
          ['@Kundenavn', '10%','','',[''],'','Firm...'],
          ['@Adresse',    '8%','','',[''],'','Addr...'],
          ['@Sted',       '8%','','',[''],'','Sted...'],
          ['@Postnr',     '4%','','',[''],'','Post...'],
          ['@By',         '8%','','',[''],'','By...'],
          ['@Kontakt',   '12%','','',[''],'','Kont...'],
          ['@Telefon',   '12%','','',[''],'','Telf...'],
          ['@Sælger',    '12%','','',[''],'','Sælg...']
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON, ]
    $DATA= array( # DemoData:
          ['1025','Firmanavn','Adresse','Sted','Postnr','By','Kontakt','Telefon','Sælger'],
          ['1026','Firmanavn','Adresse','Sted','Postnr','By','Kontakt','Telefon','Rip'],
          ['1027','Firmanavn','Adresse','Sted','4560','By','Kontakt','Telefon','Rap'],
          ['1028','Firmanavn','Adresse','Sted','Postnr','By','Kontakt','Telefon','Rup']
        ),
            #=   array(),
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter   //  Virker ikke med hidd-felter!
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at vælge og ændre data i en row
    $ViewHeight= '400px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__,
    $Kriterie= ['','']    # Test [DataKolonneNr, > grænseværdi] Undlad spec. feltColor
  );

  htm_PanlBund($pmpt='@Gem',$subm=false);
}

######### :SYSTEM:
# Kaldes fra:  [_system/page_Lagre.php] [_system/page_Licens.php] 
function Panl_Lagre(&$Nr, &$Beskrivelse, &$Afd) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'lagrform',$capt= '@Lagre:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Angår:',       '45%','show','','left', 'Kode: LG', '@Lager registrering']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Nr.',          '20%','text','',['left'],  '@Entydigt Lager nummer','@Nr...'],
          ['@Beskrivelse',  '50%','text','',['left'],  '@Lager beskrivelse.','@besk...'],
          ['@Afd.',         '30%','text','',['left'],  '@Lageret hvor varen er tilknyttet, ved varens oprettelse','@afd...'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        []
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $DATA=   array(
          ['','',''],
          ['','',''],
          ['','','']
        ),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '200px',   # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );

  htm_Caption('@Regler for Lagre:');
  htm_Plaintxt('@Der kan oprettes et ubegrænset antal lagre. Der kan være ingen, et eller flere lagre pr afdeling. Dog skal der minimum være ét lager tilknyttet én afdeling.');
  htm_Plaintxt('@Ved varekøb/salg vælges det lager som hører til den afdeling, hvor den person som foretager indkøbet et tilknyttet.');
  htm_Plaintxt('@Hvis der ikke er et knyttet et lager til afdelingen og der ér mere end et lager, skal lager vælges.');
  htm_PanlBund($pmpt='@Gem',$subm=true);
}


######### :SYSTEM:
# Kaldes fra:  [_system/page_Projekter.php] 
function Panl_Projekter(&$Nr, &$Beskrivelse) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'projform',$capt= '@Projekter:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Angår:',       '45%','show','','left', 'Kode: PRJ', '@Projekt registrering']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Nr.',          '15%','text','',['left'],  '@Entydigt Projekt nummer','@Nr...'],
          ['@Beskrivelse',  '85%','text','',['left'],  '@Projekt beskrivelse.','@besk...'],
      ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
          []
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $DATA=   array(
          ['',''],
          ['',''],
          ['',''],
          ['',''],
          ['',''],
        ),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '200px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :SYSTEM:
# Kaldes fra:  [_system/page_Afdelinger.php] 
function Panl_Afdelinger(&$Nr, &$Beskrivelse, &$Afd) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'afdlform',$capt= '@Afdelinger:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Angår:',       '45%','show','','left', 'Kode: AFD', '@Afdelings registrering']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Nr.',         '15%','text','',['left'],  '@Entydigt Afdeling nummer',    '@Nr...'],
          ['@Beskrivelse', '65%','text','',['left'],  '@Navnet på Afdelingen.',       '@besk...'],
          ['@Afd.',        '20%','text','',['left'],  '@Lager tilknyttet Afdelingen', '@afd...'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
          []
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $DATA=   array(
          ['','',''],
          ['','',''],
          ['','',''],
          ['','',''],
        ),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '200px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );

  htm_Caption('@Regler for Afdelinger:');
  htm_Plaintxt('@Der kan oprettes et ubegrænset antal afdelinger.');
  htm_Plaintxt('@Der kan være ingen, et eller flere lagre pr afdeling. Dog skal der minimum være ét lager tilknyttet én afdeling.');
  htm_Plaintxt('@Alle ansatte skal være tilknyttet en afdeling. ');
  htm_Plaintxt('@I kassekladden kan der, for hvert bilagsnummer, hvis der er mere end en afdelign, vælges hvilken afdeling posteringen vedrører.');
  htm_Plaintxt('@Ved varekøb/salg vælges det lager som hører til den afdeling, hvor den person som foretager indkøbet et tilknyttet.');
  htm_Plaintxt('@Hvis der ikke er et knyttet et lager til afdelingen og der ér mere end et lager, skal lager vælges.');

  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :SYSTEM:
# Kaldes fra:  [_system/page_Programsprog.php] 
function Panl_LanguageJuster() {  ## out_PanlsSekd.php
  global $ØsprogTabl, $ØprogSprog, $ØlanguageTable, $ØsprogCol, $ØsprogRow;
  $ØsprogCol= $_SESSION['ØsprogCol'];
  $ØsprogRow= $_SESSION['ØsprogRow'];
  $col= $ØsprogCol;  $row= $ØsprogRow;
  $rowmax= count($ØlanguageTable);
  $col= max($col,1);  $col= min($col,7);  $row= max($row,1);  $row= min($row,$rowmax);
  $optlist= SPR_Liste();

  htm_FormLocal($name='sprogform');
  htm_Panl_Top($name='', $capt='@Program sprog - tilpasning:', $parms='', $icon='fa-language', 'panelW640', __FUNCTION__);
  htm_FrstFelt('45%');  
    //  htm_Formstart($name='sprogform'); ## Rediger: Sproget
    SprogValg($ØprogSprog,$formName='sprogform');
    //  htm_Formslut();
  htm_NextFelt('55%');    
    htm_Plaintxt($labl='@Programmets aktuelt benyttede sprog.');
  htm_LastFelt();    
  $sprogtxt= tolk('@Sprog frase').': '.$optlist[$col-1][2];
  
  htm_Rammestart($Caption='@Systemets sprog-fraser:');
  $TablData= array(); $x= 0;
  foreach ($ØlanguageTable as $rakke) {
    array_push($TablData, [$x++,$rakke[0],$rakke[$col]]);
  }
  htm_Caption($labl='@Her ser du frase numrene og en søgbar liste over sprog-fraser:');
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
      ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
            ['@Nr',         '6%','indx', '',['center','','','','',false], '@Index/løbenummer','@Index...'],
            ['@SYSTEM key','40%','text', '',['left'  ], '@Tekst-frasens nøgle','@Nøgle...'],
            [$sprogtxt,    '54%','text', '',['left'  ], '@Tekst som vises og kan tilpasses','@Tekst...']
      ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
      ),             # Felt 4: ($fieldModes), er sammensat af: [0:horJust, 1:FeltBgColor, 2:FeltStyle, 3:SorterON, 4:FilterON, 5:SelectON, ]
    $TablData,#=   array(),
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,       # Mulighed for at oprette en record
    $ModifyRec=false,       # Mulighed for at ændre data i en row
    $ViewHeight= '300px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_Caption($labl='@Her vælger du frasen, som du vil redigere:');
  htm_FrstFelt('35%');    
    htm_Formstart($name='sprogix'); ## Rediger: index til sprogkolonne
      htm_OptioFlt($type='text', $name='colix', $valu=$col,
          $labl= '@Rediger sprog', 
          $titl= tolk('@Hvilket sprog vil du redigere ? <br>') ,
          $revi=true, 
          $optlist,
          $action= $result= $_POST[$name],
          // Selvsving?   $events= 'onchange="this.form.submit();" '
          '','','',$nl=2);
      // Selvsving?   
      if (isset($_POST['submit'])) {$result = $_POST[$name];} // Problem: Komponenten retter variablen, men viser den gamle værdi! ?
      if ($result>0) {$col= $result;  $ØsprogCol= $result; $_SESSION['ØsprogCol']= $result;}
    htm_Formslut();
  htm_NextFelt('10%'); 
    htm_Formstart($name='rowform'); ## Rediger: index til sprogrække
      htm_CombFelt($type='number',  $name='rowix', $valu= $row,   $labl='@Frase',  
                  $titl='@Vælg nummer for den frase, som du vil redigere: ', $revi=true, $rows='',
                  $width='20',$step='1',$more=' onblur="submit();"  min="1" max="'.$rowmax.'"' );
      $result= $_POST[$name];  if ($result>0) {$row= $result; $ØsprogRow= $result; $_SESSION['ØsprogRow']= $result;}
    htm_Formslut();
  htm_NextFelt('35%');    
    htm_Plaintxt('&nbsp; '.tolk('@af ialt:').($rowmax-1)); //  echo '&nbsp; '.tolk('@af ialt:').($rowmax-1);
  
  htm_NextFelt('20%');    
    htm_Plaintxt('&nbsp;&nbsp; (Index:'.$row.':'.$col.')'); //  echo '&nbsp;&nbsp; (Index:'.$row.':'.$col.')';
  htm_lastFelt();
  htm_Rammeslut();
  htm_nl();  htm_Caption($labl='@Original:');
  htm_nl();  htm_Caption($labl=trim($ØlanguageTable[$row][0],'@'),$style='color:#900000;');
  htm_Formstart($name='reviform'); ## Rediger: Sprog frasen
    htm_nl();  htm_Caption($labl='@Rediger her:');
    htm_CombFelt($type='text',  $name='frase', $valu= $ØlanguageTable[$row][$col],   
                                               $labl= '@Du redigerer nu: '.' '.$optlist[$col-1][2],  
                                               $titl= 'Key:<br>'.$ØlanguageTable[$row][0], 
                                               $revi=true, $rows='2',$width='244px');
    $result= $_POST[$name];  if ($result>'') {$ØlanguageTable[$row][$col]= $result;}
  htm_Formslut();
  htm_CentrOn(); 
    textKnap($label= '@Gem og benyt rettelser',  $title= '@Klik her for at gemme dine korrektioner, og tage dem i brug',              $link= '../_base/page_Blindgyden.php');
    textKnap($label= '@Exporter til csv-fil',    $title= '@Klik her for gemme alle sprogdata i en fil, som kan indlæses i regneark',  $link= '../_base/page_Blindgyden.php'); // SprogExport($ØlanguageTable)
    textKnap($label= '@Importer fra csv-fil',    $title= '@Klik her for indlæse alle sprogdata fra en fil som du udpeger',            $link= '../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Luk og gå retur til hovedmenu');
  // ExportTabFile('../_exchange/SprogExport', chr(9), $ØlanguageTable);
  // ExportTabFile('../_exchange/SprogExport', '","', $ØlanguageTable);
#+  SprogUpdate();  //  Analyse-rutine
}

######### :SYSTEM:
# Kaldes fra: 
function GemogBrug() {  ## out_PanlsSekd.php
  ExportTabFile('../_config/MitSprog_DB', '","', $ØlanguageTable); //  GEM:  
  sprogDB_import($fname='../_config/MitSprog_DB.csv');             //  BENYT:
}

######### :SYSTEM:
# Kaldes fra: 
function SprogExport($languageTable) {  ## out_PanlsSekd.php
 # ExportTabFile('../_exchange/SprogExport', '","', $languageTable);
  msg_Dialog('info',ucfirst(tolk('@Fortsæt')),'$(this).dialog("close")','','','','',ucfirst(tolk('@Udført Export:')), 
                   ucfirst(tolk('@Der er udført en export af sprogtabellen, til filen: ../_exchange/SprogExport.csv')));
}

######### :SYSTEM:
function SprogUpdate() { //  Sammenlign aktiv tabel med friskdannet fraseliste:
  global $ØlanguageTable;
  echo '<br>Analyse af nydannet frase-liste, i forhold til gældende sprog-tabel.';
  $friskFraseFil= '../_exchange/fraseliste-jul18-dk.txt';
  $fp= fopen($friskFraseFil,"r"); // or exit("Kan ikke åbne filen ($friskFraseFil)");
  if ($fp) { $nyeKeys= array();  $Lin=0;
    while (!feof($fp)) {
      if ($txtline= fgets($fp)) { $Lin++; array_push($nyeKeys, trim('@'.$txtline)); }
    } fclose($fp);
  } 
  
  $fraseKeys= array();
  foreach ($ØlanguageTable as $oldFrase)  {array_push($fraseKeys, trim($oldFrase[0])); } //  Key-kolonnen
  
  $combiFraser= array();
  foreach ($nyeKeys as $newFrase) {   // Gennemløb af nyeste frase-tabel:
    if (in_array($newFrase,$fraseKeys)) {array_push($combiFraser,'Bevar: '.$newFrase);  echo '<br>'.'Bevar: '.$newFrase; $Bevar++; }  //  Ingen ændring
    else                                {array_push($combiFraser,'Opret: '.$newFrase);  echo '<br>'.'Opret: '.$newFrase; $Opret++; }  //  Tilføj en ny
  }
  foreach ($fraseKeys as $oldFrase) { // Gennemløb af gældende frase-tabel:
    if (!in_array(trim($oldFrase),$nyeKeys))  {array_push($combiFraser,'Fjern: '.$oldFrase);  echo '<br>'.'Fjern: '.$oldFrase; $Fjern++; }  //  Fjern forældet: unset()
  }
  //  foreach($combiFraser as $frase) echo '<br>'.$frase;
  echo "<br>Antal frasehandlinger (Bevar:$Bevar /Opret:$Opret /Fjern;$Fjern) i resultatet ialt: ".count($combiFraser);
}


######### :SYSTEM:
# Kaldes fra:  [_system/page_Divsetup2.php] [_system/page_Kontoindstill.php] 
function Panl_Kontoindstilling(&$regnskabnavn='', &$servport='', &$usernavn='', &$usercode='', &$protokol='')   ## out_PanlsSekd.php
{ global $ØProgTitl;
  htm_Panl_Top($name= 'kontoform',$capt= '@Kontoindstilling:',$parms='../_system/page_Kontoindstill.php',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
  htm_Caption('@Regnskab:');
  htm_CombFelt($type='text',  $name='regnnavn', $valu= $regnskabnavn,   $labl='@Regnskabets navn',  $titl='@Her kan du rette dit regnskabs navn', $revi=true, $rows='2',$width='',$step='');
  str_hr();  
  htm_Caption('@Mail afsendelse:');
  htm_CombFelt($type='text',  $name='servport', $valu= $servport,   
               $labl='@Alternativ SMTP-Server:Port',  
               $titl=tolk('@Her kan angives en alternativ SMTP-server for afsendelse af mail. ').
                     tolk('@Serveren skal tillade videresendelse af mails fra ssl.saldi.dk ').
                     tolk('@(eller anden server, som').$ØProgTitl.' '.tolk('@kører på). ').
                     tolk('@Hvis server porten ikke er 25, skrives port efter SMTP server-navnet adskilt med : F.eks. smtp.gmail.com:465'), 
               $revi=true, $rows='2',$width='',$step='', $more= ' placeholder="SMTP-server:25"');
  htm_CombFelt($type='text',  $name='usernavn', $valu= $usernavn,   
               $labl='@Brugernavn',  
               $titl='@Brugernavn til SMTP serveren, hvis dette kræves.', 
               $revi=true, $rows='2',$width='',$step='', $more= 'placeholder="MailUser"');
  htm_CombFelt($type='password',  $name='usercode', $valu= $usercode,   
               $labl='@Gyldig adgangskode',  
               $titl='@Adgangskode til SMTP serveren, hvis dette kræves.', 
               $revi=true, $rows='2',$width='',$step='');
  htm_OptioFlt($type='text',  $name='smtpcrypt',   $valu= $protokol, 
                    $labl='@Protokol',      
                    $titl='@Krypteringsmetode for forbindelse til SMTP serveren, hvis dette kræves.',  
                    $revi=true, $optlist= array(
                    ['Secure Sockets Layer (SSL)','ssl',  '@SSL'],
                    ['Transport Layer Security (TLS)','tls',  '@TLS'],
                    ),$action='onchange="getComboA(this)"',
                    '','','',$nl=1);
  htm_Caption('@Mail modtagelse:');
  htm_CombFelt($type='mail',  $name='bccopy', $valu= $bccopy,   
               $labl='@BC-modtager',  
               $titl='@Standard mail-adresse, som skal modtage kopi (Blind Copy) af afsendte mails', 
               $revi=true, $rows='2',$width='',$step='');
  htm_CheckFlt($type='checkbox',$name='useBC', $valu= $useBC,  
               $labl='@Send automatisk',  
               $titl='@Afsend automatisk en BC-mail, til ovennævnte mailkonto, af samtlige udgående mails',  
               $revi=true, $more='');
  //  htm_nl();
  htm_PanlBund($pmpt='@Gem',$subm=true);
}
 

######### :SYSTEM:
# Kaldes fra:  [_system/page_Personlig.php] 
function Panl_Saldisetup() {global $ØProgTitl, $Ønovice, $ØFullFilt, $ØTastkeys;  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'personl',$capt= tolk('@Hjælp i').$ØProgTitl.':',$parms='',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
  $Ønovice=   htm_CheckFlt($type='checkbox',$name='novice', $valu= $Ønovice,  
               $labl='@Vis tips for begynder:', $titl=tolk('@Hvis du afmærker dette felt, vil').
               $ØProgTitl.' '.tolk('@vise nyttige tips for begyndere.'));
  $ØFullFilt= htm_CheckFlt($type='checkbox',$name='fullfilt', $valu= $ØFullFilt,  
               $labl='@Filter hjælp:', $titl=tolk('@Hvis du afmærker dette felt, vil').
               $ØProgTitl.' '.tolk('@vise hjælpetekster til filter-funktionalitet.'));
  $ØTastkeys= htm_CheckFlt($type='checkbox',$name='tastkeys', $valu= $ØTastkeys,  
               $labl='@Vis tastatur genvejs bogstaver:', $titl=tolk('@Hvis du afmærker dette felt, vil').$ØProgTitl.
               ' '.tolk('@vise tastatur genvejs bogstaver på knapper.'));
  $ØRollTabl= htm_CheckFlt($type='checkbox',$name='usemaxview', $valu= $ØRollTabl,  
               $labl='@Vis ikke tabeller i vinduer:', $titl=tolk('@Hvis du afmærker dette felt, vil').$ØProgTitl.' '.
               tolk('@vise tabeller i fuld højde. Nyttigt hvis du udprinter data med browseren.'));
  htm_PanlBund($pmpt='@Gem',$subm=true);
  $_SESSION['Ønovice']=   $Ønovice;  
  $_SESSION['ØFullFilt']= $ØFullFilt; 
  $_SESSION['ØTastkeys']= $ØTastkeys;
  $_SESSION['ØRollTabl']= $ØRollTabl;
}
 
######### :SYSTEM:
# Kaldes fra:  [_system/page_Personlig.php] 
function Panl_Personlig()   ## out_PanlsSekd.php
{global $ØprogSprog;
  htm_FormLocal($name='sprogform');
  htm_Panl_Top($name= 'personl',$capt= '@Personlige valg:',$parms='#', $icon='fa-pen-square','panelW320',__FUNCTION__);
  
  htm_Caption('@Klassisk udseende:');
  htm_RadioGrp($type='hori',  $name='menu', 
              $labl='@Browser Menu', 
              $titl=tolk('@Hvis dette felt afmærkes vil browser-menuer skjules, og hele vinduet kan anvendes som arbejdsområde.').str_nl().
                    tolk('@Mange browsere skifter dette med F11-funktionstast.'), 
              $optlist= array(['menu','@Vis','','@Skjul']),
              $action='');
  htm_hr();  
  htm_Caption('@Anvend popup-vinduer:');  str_nl();  
  htm_CheckFlt($type='checkbox',$name='popup', $valu= 'popup',  
               $labl='@Benyt flere vinduer',  
               $titl='@Hvis du afmærker dette felt, vil SALDI arbejde i popup-vinduer, hvilket gør at man kan have flere vinduer åbne samtidig.',  
               $revi=true, $more='');
  
  htm_hr();  
  htm_Caption('@Popup-indstillinger:');
  htm_CombFelt($type='area', $name='inistr', $valu= 'statusbar=0, menubar=0, titlebar=0, toolbar=0, scrollbars=1, resizable=1, dependent=1',   
               $labl= '@Initieringsstreng', 
               $titl= tolk('@Denne streng benyttes af systemet (javascript), når der åbnes et nyt vindue. ').
               str_nl().tolk('@Her kan du indstille, hvordan vinduerne skal vises.'), 
               $revi=true, $rows='2',$width='244px');
  htm_nl();  htm_hr();  
  htm_Caption('@Udseende:');
  htm_RadioGrp($type='hori',  $name='bgtema', $labl='@Tema', $titl='@Du kan kun benytte en af mulighederne ad gangen.', 
      $optlist= array(['light', '@Lys','@eller','@Anvend lyse farver som baggrundsfarve.', $_SESSION["Øtema"]!='dark'],
                      ['dark',  '@Mørk',    '', '@Anvend mørke farver som baggrundsfarve.',$_SESSION["Øtema"]=='dark'])
              ,$action='');
  htm_Caption('@Baggrund i vinduer:');
  htm_RadioGrp($type='hori',  $name='bgtype', $labl='@Type', $titl='@Du kan kun benytte en af mulighederne ad gangen.', 
      $optlist= array(['farve',   '@Farve','@eller','@Anvend en ensartet kulør som baggrundsfarve i vinduer.'],
                      ['grafik',  '@Grafik',    '', '@Anvend grafik som baggrund i vinduer.','valgt'])
              ,$action='');
  htm_FrstFelt('35%');  htm_CombFelt($type='text', $name='farvekode', $valu= $farvekode='FF3311',   
                          $labl= '@Farvekode',  
                          $titl= '@Her skriver du hex-værdien for den ønskede RGB-baggrunds farve, eksempelvis FF9933 for orange. Se flere værdier på www.saldi.dk/dokumentation/farver ', 
                          $revi=true, $rows='2',$width='30px');
  htm_NextFelt('65%');  htm_CombFelt($type='text',  $name='bgimage', $valu= $bgimage='paper_fibers.png',   
                          $labl= '@Baggrundsbillede',  
                          $titl= '@Her skriver du filnavnet for det ønskede baggrunds billede. Filen SKAL være placeret i mappen: ..\\_assets\images\\', 
                          $revi=true, $rows='2',$width='30px');
  htm_LastFelt();
  echo 'Demo: ';
  $source= $_SESSION["Øtema"];   
#  echo 'GL værdi: '.$source; htm_nl();
  if ($source=='dark') {$source='light';} else {$source='dark';};
  setvKnap ($label='@Skift Tema (Klik 2x)',$title='@Ændring af tema for udseende', $source, $result, $akey='');
#  htm_nl();  echo 'NY værdi: '.$result;
  $_SESSION["Øtema"]= $result;
  
  SprogValg($ØprogSprog,$formName='sprogform');
  
  htm_Caption('Således viser din aktuelle browser sin datepicker:');
  echo '<p>DatoVælger: <input type="date" id="datepicker" placeholder="DatePicker:Klik i feltet"></p>';

  htm_hr();  
  htm_Caption('@Fremhævning af felter:');
  $bgcolor='#ffffff';
  $nuancefarver= [  //  [0:Tip, 1:value, 2:Label, 3:Action]
    ['Farve 1',  '+00-22-22','@Rød',      'style="background:'.Øfarvenuance($bgcolor, '+00-22-22').'"'],
    ['Farve 2',  '+00+00-33','@Gul',      'style="background:'.Øfarvenuance($bgcolor, '+00+00-33').'"'],
    ['Farve 3',  '-22+00-22','@Grøn',     'style="background:'.Øfarvenuance($bgcolor, '-22+00-22').'"'],
    ['Farve 4',  '-22-22+00','@Blå',      'style="background:'.Øfarvenuance($bgcolor, '-22-22+00').'"'],
    ['Farve 5',  '+00-33+00','@Magenta',  'style="background:'.Øfarvenuance($bgcolor, '+00-33+00').'"'],
    ['Farve 6',  '-33+00+00','@Cyan',     'style="background:'.Øfarvenuance($bgcolor, '-33+00+00').'"'],
  ];
  $antal_nuancer=count($nuancefarver);
  
  htm_OptioFlt($type='text',  $name='nuance',   $valu= $nuance, 
              $labl='@Farvenuance',  
              $titl='@Fremhæv eksempelvis ordrefelter, hvor der mangler levering eller modtagelse, med den angivne baggrunds-farvenuance.',  
              $revi=true, $optlist= $nuancefarver,
              $action='onchange="getComboA(this)"',
              $maxwd='',
              $onForm='',
              '','','',$nl=2);
  htm_PanlBund($pmpt='@Gem',$subm=true);
}
 
 
######### :SYSTEM:
# Kaldes fra:  [_system/page_Ordrerelat.php] 
function Panl_Ordrerelat()   ## out_PanlsSekd.php
{
  htm_Panl_Top($name= 'ordrerelat',$capt= '@Ordre relateret:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW640',__FUNCTION__);
  htm_Caption('@Ordre relaterede valg:'); htm_nl();  
  htm_CheckFlt($type='checkbox',$name='prismedm', $valu= $prismedm,  
               $labl='@Vis priser inkl. moms på salgsordrer',  
               $titl='@Når dette felt er afmærket, vises priser på salgsordrer, fakturaudskrifter osv. inkl. moms.',  
               $revi=true, $more='');
   htm_CheckFlt($type='checkbox',$name='medkomm', $valu= $medkomm,  
               $labl='@Medtag kommentarer på følgesedler',  
               $titl='@Hvis dette felt afmærkes, medtages kommentarlinjer fra tilbud/ordrer på følgesedler.',  
               $revi=true, $more='');
   htm_CheckFlt($type='checkbox',$name='kunmed', $valu= $kunmed,  
               $labl='@Medtag kun linjer med angivet antal på følgeseddel',  
               $titl='@Hvis dette felt afmærkes, medtages kun de varer, som er med i den pågældende leverering på følgesedlen.',  
               $revi=true, $more='');
   htm_CheckFlt($type='checkbox',$name='hurtfakt', $valu= $hurtfakt,  
               $labl='@Anvend hurtigfakturering (ingen tilbud & automatisk levering ved fakturering)',  
               $titl='@Hurtigfakturering anvendes, hvis man ikke har behov for at skrive tilbud/følgesedler, og hvor lagerttræk skal ske ved fakturering',  
               $revi=true, $more='');
   htm_CheckFlt($type='checkbox',$name='straksbogf', $valu= $straksbogf,  
               $labl='@Omgående bogføring af købs- og salgsordrer',  
               $titl='@Hvis dette felt ikke er afmærket, skal købs- og salgsfakturaer bogføres gennem kassekladden med [Hent ordrer]-funktionen.',  
               $revi=true, $more='');
   htm_CheckFlt($type='checkbox',$name='usefifo', $valu= $usefifo,  
               $labl='@Anvend FIFO på lagervarer', 
               $titl='@Hvis dette felt er afmærket styres lager efter FIFO (first in first out) princippet og kostprisen reguleres automatisk efter sidste varekøb.',  
               $revi=true, $more='');
  htm_OptioFlt($type='text',  $name='smtpcrypt',   $valu= $protokol, 
                    $labl='@Automatisk regulering af kostpriser',      
                    $titl='@Vælg om kostpriser skal reguleres til gennemsnitspris, genanskaffelsespris eller ikke skal reguleres, ved varekøb',  
                    $revi=true, $optlist= array(
                    ['','0',  '@Opdater ikke kostpris','valgt'],
                    ['','1',  '@Gennemsnitspris'],
                    ['','2',  '@Genanskaffelsespris'],
                    ),$action='onchange="getComboA(this)"');
   htm_CheckFlt($type='checkbox',$name='negativOK', $valu= $negativOK,  
               $labl='@Tillad negativ lagerbeholdning',  
               $titl='@Afmærk dette felt for at tillade negativ lagerbeholdning.',  
               $revi=true, $more='');
   htm_CheckFlt($type='checkbox',$name='samlrabat', $valu= $samlrabat,  
               $labl='@Anvend rabat på samlet pris',  
               $titl=tolk('@Afmærkes dette felt bliver det muligt at ændre prisen på bundlinjen i en salgsordre ').
                     tolk('@og der bliver givet en samlet rabat, som ved bogføring fordeles på de enkelte varer.'),  
               $revi=true, $more='');
   htm_CheckFlt($type='checkbox',$name='warnlow', $valu= $warnlow,  
               $labl='@Advar ved for lav lagerbeholdning',  
               $titl='@Afmærkes dette felt vil der komme en advarsel, hvis der indsættes varer, som ikke kan leveres, på en kundeordre.',  
               $revi=true, $more='');
   htm_CheckFlt($type='checkbox',$name='usepctfakt', $valu= $usepctfakt,      //  findtekst(681/682
               $labl='@Anvend procentfakturering',  
               $titl='@Afmærkes her, kommer et ekstra felt på salgsordrer til procentfakturering af vareværdien. Bruges f.eks ved udlejning af materiel.',  
               $revi=true, $more='');
   htm_CheckFlt($type='checkbox',$name='procenttillag', $valu= 'procenttillag',
               $labl='@Procenttillæg',  
               $titl= tolk('@Skrives en værdi her, vil der fremkomme et redigerbart felt på ordresiden med den angivne værdi. ').
                      tolk('@Procenttillægget er et tillæg til den samlede fakturasum før momsberegning. '),  
               $revi=true, $more='');
  htm_FrstFelt('50%');   
  htm_CombFelt($type='text',  $name='procentvare', $valu= $procentvare,
                          $labl= '@Procenttillæg',  
                          $titl= '@Angiv her hvilken konto i kontoplanen procenttillægget skal konteres på.', 
                          $revi=true, $rows='2',$width='30px');
  htm_NextFelt('50%');    echo '%';
  htm_LastFelt();   
  htm_FrstFelt('50%');   
  htm_CombFelt($type='text',  $name='pctvare', $valu= $pctvare,
                          $labl= '@Varenr. for procenttillæg',  
                          $titl= '@For at kunne give rabat på kontantsalg, skal dette felt udfyldes med varenummeret for den vare som bruges til formålet.', 
                          $revi=true, $rows='2',$width='30px');
  htm_NextFelt('50%');   
  htm_CombFelt($type='text',  $name='varerabat', $valu= $varerabat,
                          $labl= '@Varenr. for rabat',  
                          $titl= '@Sættes der et varenummer her, bliver det muligt at samle en gruppe varer i en salgsordre, som et sæt og give en samlet pris for denne gruppe.', 
                          $revi=true, $rows='2',$width='30px'); //  Kun redigerbar hvis:  $samlet_pris=true
  htm_LastFelt();   
  htm_FrstFelt('50%');   
  htm_CombFelt($type='text',  $name='box7', $valu= $kontantkonto,
                          $labl= '@Kontonummer for kontantsalg.',  
                          $titl= '@Angiv hvilken konto betalingen skal konteres på ved kontantsalg. Hvis feltet er tomt oprettes en åben post på beløbet på kundens konto.', 
                          $revi=true, $rows='2',$width='30px'); 
  htm_NextFelt('50%');   
  htm_CombFelt($type='text',  $name='box10', $valu= $kortkonto,
                          $labl= '@Kontonummer for salg på kreditkort.',  
                          $titl= '@Angiv hvilken konto betalingen skal konteres på ved salg på kreditkort. Hvis feltet er tomt oprettes en åben post på beløbet på kundens konto.', 
                          $revi=true, $rows='2',$width='30px');
  htm_LastFelt();   

  htm_PanlBund($pmpt='@Gem',$subm=true);
}
 
######### :SYSTEM:
# Kaldes fra:  [_system/page_Varerelat.php] 
function Panl_Varerelat()   ## out_PanlsSekd.php
{
  htm_Panl_Top($name= 'varerelat',$capt= '@Varerelateret:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
  htm_Caption('@Varerelateret:');
  htm_OptioFlt($type='text',  $name='Momskode',   $valu= $Momskode, 
              $labl='@Momskode',  
              $titl='@Momskode for salgspriser på varekort',  
              $revi=true, $optlist= [['','S1','S1:Salgsmoms 25%','','valgt'],[]],  //  [0:Tip, 1:value, 2:Label, 3:Action]
              $action='onchange="getComboA(this)"',
              '','','',$nl=2);
  
  htm_hr();  htm_Caption('@Varianter:');
  htm_CombFelt($type='text',  $name='variant', $valu= $Variant,   
                          $labl= '@Ny variant',  
                          $titl= '@', 
                          $revi=true, $rows='2',$width='30px');
  htm_PanlBund($pmpt='@Gem',$subm=true);
}
 
 
######### :SYSTEM:
# Kaldes fra:  [_system/page_Prislister.php] 
function Panl_Prislister()   ## out_PanlsSekd.php
{
  htm_Panl_Top($name= 'prislist',$capt= '@Prislister:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW960',__FUNCTION__);
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
      ['@Prislister: ','8%','text','','left','','','Externe']
      ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Prisliste.',         '6%','indx','', ['left'  ],  '@Prisliste','@Prisliste...'],
        ['@Leverandør',         '8%','text','', ['left'  ],  '@Leverandør','@Leverandør...'],
        ['@URL til prislisten','32%','text','', ['left'  ],  '@URL','@url...'],
        ['@Filtype',            '6%','text','', ['left'  ],  '@Filtype','@Filtype...'],
        ['@Rabat',              '8%','text','', ['left'  ],  '@Rabat','@Rabat...'],
        ['@Varegruppe',        '18%','text','', ['left'  ],  '@Varegruppe','@Varegruppe...'],
        ['@Lev.rabat',          '8%','text','', ['left'  ],  '@Lev.rabat','@Lev.rabat...'],
        ['@Aktiv',              '4%','text','', ['left'  ],  '@Aktiv','@Aktiv...'],
      ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ['@Slet',               '4%','knap','', ['center'],  '@Klik på rødt kryds for at slette denne post', '<ic class="far fa-times-circle" style="color:red; font-size:13px; "></ic>'],
      ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON, ]
    //$DATA,#=   array(),
    $TablData= [[1001,'Leverandør','URL','Filtype','Rabat','Varegruppe','Lev.rabat','Aktiv','Slet'],[1002,'Leverandør','URL','Filtype','Rabat','Varegruppe','Lev.rabat','Aktiv','Slet'],
                [1003,'Leverandør','URL','Filtype','Rabat','Varegruppe','Lev.rabat','Aktiv','Slet'],[1004,'Leverandør','URL','Filtype','Rabat','Varegruppe','Lev.rabat','Aktiv','Slet']], 
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '150px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_nl();  htm_Plaintxt('@Prislisterne er lister med priser, som hentes fra en extern ressource, eksempelvis en fil på en hjemmeside eller et ftp-sted.');
  htm_nl(2);
  htm_PanlBund($pmpt='@Gem',$subm=true);
}
 
######### :SYSTEM:
function Panl_Prislisten($xx) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'priser',$capt= '@Viser prisliste:',$parms='page_Blindgyden.php',$icon='far fa-save','panelW960',__FUNCTION__);
  htm_nl(6);
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Luk vinduet og gå retur til hovedmenu');
}
 
######### :SYSTEM:
# Kaldes fra: [_system/page_Backup.php] 
function Panl_Backup() {global $Øsaldihost;  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'backup',$capt= '@Sikkerhedskopiér regnskab:',$parms='../_base/page_Hovedmenu.php',$icon='far fa-save','panelW640',__FUNCTION__);
  htm_Caption('@Backup / Restore af dit regnskab:');
  htm_CentrOn(); 
    textKnap($label='@Gem SQL sikkerhedskopi',    $title='@Klik her for at gemme dit regnskab et sikkert sted.',    $link='../_base/page_Blindgyden.php');  //  DB_backup();
    textKnap($label='@Indlæs SQL sikkerhedskopi', $title='@Klik her for indlæse en tidligere gemt sikkerhedskopi',  $link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_Rammestart($Caption='@Om data backup:');
  echo tolk('@Her kan du tage backup af det aktuelle regnskab. Har du flere regnskaber, skal der tages backup af hvert enkelt, hvilket kræver selvstændigt login.'); htm_nl(2);
  echo tolk('@Backuppen omfatter indholdet i database-tabeller med regnskabsindhold.'); htm_nl();
  echo tolk('@Backup af filer (billeder, bilag, formularer, ændrede supportfiler, ...), kan udføres med et fil kopierings program,');
  echo tolk('@f.eks. via en FTP-forbindelse. Nogle af filerne, kan du dog selv hente, ved at benytte export-mulighederne i programmet.');   htm_nl(2);
  echo tolk('@En komplet backup, skal omfatte den totale database, og samtlige filer i systemets mapper.').' ';
  echo tolk('@Fil-backup kan du udføre med funktionen ´Installations backup´ i panelet nedenfor.');  htm_nl(2);
  echo tolk('@Benytter du').' '.'<data-colrlabl>'.$Øsaldihost.'</data-colrlabl>, '.tolk('@er det med i den service, du betaler for.');  htm_nl(2);
  htm_Rammeslut();
  htm_Caption('@Backup af supportfiler:');
  htm_CentrOn(); 
    textKnap($label='@Gem datafiler (billeder)',      $title='@Planlagt mulighed, for at gemme filer med brugerdata.',  $link='../_base/page_Blindgyden.php');
    textKnap($label='@Gem regnskabsbilag (pdf)',      $title='@Planlagt mulighed, for at gemme filer med brugerdata.',  $link='../_base/page_Blindgyden.php');
    textKnap($label='@Gem designfiler (formularer)',  $title='@Planlagt mulighed, for at gemme filer med brugerdata.',  $link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Luk vinduet og gå retur til hovedmenu');
}

######### :SYSTEM:
function DB_backup() {
global $sqhost, $squser, $sqpass, $Øsqdb;

  $db= 'DB-navn';  $dbver= 'DB-version';  $regnskab= 'Regnskab';  $db_encode= 'db-Encode';  $db_type= 'mysql';    //  Dummy-data
  
  $wrkPath=   '../_exchange/tmp/';
  $timestamp= date("Ymd-Hi");
  $fnam= trim($Øsqdb."_".$timestamp);
  $dump_filnavn=$wrkPath.trim($Øsqdb.".sql");
  $info_filnavn=$wrkPath."DB-backup.info";
  $tar_filnavn= $wrkPath.$fnam.".tar";
  $gz_filnavn=  $wrkPath.$fnam.".tar.gz";
  $dat_filnavn= $wrkPath.$fnam.".sdat";

  //  $r=db_fetch_array(db_select("select box1 from grupper where art = 'VE'",__FILE__ . " linje " . __LINE__));
  //  $dbver=$r['box1'];
  $fp=fopen($info_filnavn,"w");
    if ($fp) {
      fwrite($fp,$timestamp.chr(9).$Øsqdb.chr(9).$dbver.chr(9).$regnskab.chr(9).$db_encode.chr(9).$db_type);
    } 
  fclose($fp);
  
  //  $Øexec_path="/usr/bin/";
  if ($db_type=='mysql') $dumpcmd= $Øexec_path.'mysqldump -h '.$sqhost.' -u '.$squser.' --password='.$sqpass.' -n '.$Øsqdb.' --result-file='.$dump_filnavn;
  else                   $dumpcmd= 'export PGPASSWORD='.$sqpass.'\n'.$Øexec_path.'pg_dump -h '.$sqhost.' -U '.$squser.' -f '.$dump_filnavn.' '.$Øsqdb;

  echo "<!-- Saldi-kommentar for at skjule uddata fra pg_dump til siden \n"; # Kommentar start
  system($dumpcmd);
  system("tar -cf $tar_filnavn $dump_filnavn $info_filnavn");
  system("gzip $tar_filnavn");
  system("mv $gz_filnavn $dat_filnavn");
  echo "--> \n"; # Kommentar slut
}

######### :SYSTEM:
# Kaldes fra: [_system/page_Backup.php??] 
function Panl_Zipbackup() {global $Øsaldihost;  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'zip',$capt= '@Installations backup:',$parms='#',$icon='far fa-save','panelW640',__FUNCTION__);
  $subdirs= 8;
  htm_nl();
  htm_Rammestart($Caption='@Om program backup:');
  echo tolk('@Her kan du tage backup af det installerede program, og de aktuelle support-filer.');   htm_nl(2);
  echo tolk('@Backuppen omfatter filer, som befinder sig i programmets system-mapper på web-serveren, og i indtil').' '.$subdirs.' '.
       tolk('@mappe-niveauer under program-mappen.');   htm_nl();
  echo tolk('@Bemærk: Der tages ikke backup, af connect-data til databasen,').'<br>';
  echo tolk('@hvis de er placeret i mappen ---Private !');   htm_nl(2);
  echo tolk('@Filer gemmes komprimeret i en ZIP-fil, som ikke umiddelbart kan benyttes til gendannelse.').' ';
  echo tolk('@Når zip-filen er dannet, kan du downloade den, og gemme den lokalt, sammen med dine data-base (SQL) backupper.');   htm_nl(2);
  echo tolk('@Skal filerne benyttes, kræver det p.t. manuel gendannelse.');   htm_nl(2);
  echo tolk('@Har du flere regnskaber, er det tilstrækkeligt med en fælles installations backup.');   htm_nl(2);
  echo tolk('@Indholdet i databasen (regnskabs-data) er ikke med i denne backup.').' ';
  echo tolk('@Det kan du selv udføre med funktionen i panelet ovenfor.');   htm_nl(2);
  echo tolk('@Benytter du').' '.'<data-colrlabl>'.$Øsaldihost.'</data-colrlabl>, '.tolk('@er det med i den service, du betaler for.');  htm_nl(2);
  htm_Rammeslut();
  
  run_Script('function showWait() {document.getElementById("waitinfo").style.display = "block";}');
  echo '<div id="waitinfo" style="display:none;">'.str_nl().tolk('@ZIP-backup starter. Vent...');
  echo '<div class="loader" id="wait" ></div>';
  echo '<br>'.tolk('@Backup af system-mapper og undermapper i').' '.$subdirs.' '.tolk('@niveauer. Det tager tid...').'<br>';
  echo '</div>';
   if ($GLOBALS["Øjob"]=='zip') 
  { program_backup($subdirs);
  } else {
    htm_Caption('@Backup af programmet:');
    htm_CentrOn(); 
      textKnap($label='@ZIP fil-arkivering',  
        $title='@Her gemmer du programmet, og dine supplerende filer.<br>Bemærk! det tager lidt tid...',  $link='?job=zip',$akey='',$more='" onclick="showWait()" ');
      htm_Caption(' Hav tålmodighed...');
    htm_CentOff();
  }
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Luk vinduet og gå retur til hovedmenu');
}

######### :SYSTEM:
function program_backup($subdirs= 3) {
  $zip = new ZipArchive();  //  ZIP skal være aktiveret i PHP-installationen!
  $filename = './../_exchange/tmp/program_backup.zip';
  if (file_exists($filename)) {unlink($filename);}  //  Slettes så evt. gammel version ikke medtages i zip
  if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) { exit(tolk('@Kan ikke oprette <'.$filename.'>')); }
  
## Info-fil;
  $zip->addFromString('readme.txt', 
    tolk('@Denne ZIP-fil indeholder de fleste filer fra SALDI-e installationen.').chr(10).chr(13).
    tolk('@Den indeholder ikke tilkoblings-data til databasen, hvis disse befinder sig i filen: \\saldi-e\---Private\serverFacts.inf').chr(10).chr(13).
    tolk('@Kun systemmapper med prefix: _ tages i betragtning, f.eks. \_system\*  - Mappe-dybden er begrænset til:').' '.$subdirs.chr(10).chr(13).
    tolk('@Glemmer du at downloade zip-filen, kan du altid finde den seneste udgave her: \\saldi-e\_exchange\tmp\program_backup.zip').chr(10).chr(13)
    );
  
## Data-filer:
  $ix= '00';  $thisdir= './../';
  //  ob_implicit_flush(1);
  //  ob_start();
  //  for ($i= 0; $i < 1024*64; $i++) echo ' ';
  //  ob_end_clean();
  //  echo '<br>'.tolk('@ZIP-backup starter. Vent...').'<br>';
  //  echo '<div class="loader" id="wait"></div>';
  //for ($i= 0; $i < 8; $i++) {flush();  ob_flush();} ob_end_flush();   //  Virker tilsyneladende ikke
  $files= getFileList('./../', true, $subdirs);   //  var_dump($files);
   foreach ($files as $fil) {
    $filref= $fil['path'].$fil['name'];    //  echo '<br>'.$filref;
    if (substr($fil['path'],strlen($thisdir),1)=='_')   //  Kun system-mapper
      if (!is_dir( $filref ))
        if ($zip->addFile($filref,$filref.'__bak#'.$ix))  {   }   //  echo ' .'; 
        else {echo '<br>'.tolk('@MISLYKKET: ').$filref;}
  } echo '<br>';
  
## Resultat:
  $GLOBALS["Øjob"]= 'done';
  //echo '<br>Færdig. Dette skulle vises, inden der gås igang med zipning!';
  echo '<br>'.tolk('@Færdig. Antal filer: '). $zip->numFiles. ' i zip-filen.<br>'; // echo tolk('@Status: '). $zip->status. '<br>';
  $zip->close();
  htm_CentrOn(); 
    textKnap($label='@Download ZIP fil',$title='@Her henter du den nydannede ZIP-backup',  $link='http://1331.dscloud.me/saldi-e/_exchange/tmp/program_backup.zip');
  htm_CentOff();
}

 
######### :SYSTEM:
# Kaldes fra:  [_system/page_Bilagsinfo.php] 
function Panl_Bilagsinfo($ftpservaddr= 'bilag_999@ssl2.saldi.dk.') {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'backup',$capt= '@Bilagshåndtering:',$parms='page_Blindgyden.php',$icon='far fa-save','panelW640',__FUNCTION__);
  htm_Caption('@Regnskabs bilag:');
  htm_Rammestart($Caption='@Om Bilagshåndtering:');
    echo tolk('@Her er de informationer, som er nødvendige for at kunne håndtere scannede bilag.').'<br>';
    echo tolk('@Du kan vælge at lade SALDI.dk opbevare dine scannede bilag for kr. 30,- pr. måned pr. GB. Enhedsprisen følger dags-prisen for 1 ekstra bruger.').'<br>';
    echo tolk('@Denne løsning giver mulighed for at sende indscannede bilag pr. e-mail til serveren, og efterfølgende importere dem i kassekladden.').'<br>';
    echo tolk('@Bilag sendes til:').' '.$ftpservaddr.'<br>'.'<br>';
    echo tolk('@Du kan også vælge selv at sætte en ftp-server op til formålet eller benytte en eksisterende. Det koster ikke noget, når du gør det selv.').'<br>';
  htm_Rammeslut();
  htm_nl();
  htm_Caption('@Vælg her:');
  htm_OptioFlt($type='text', $name='opbevar', $valu= $opbevar, $labl='@Opbevaring af bilag', $titl='@Her kan du vælge mellem opbevarinsmulighederne.', $revi=true, $optlist= 
      [['@Hvis du vil anvende bilagsscanning og ikke selv vil etablere server til bilagsopbevaring. Samme omkostning som en ekstra bruger pr. GB.','intern','@Intern bilagsopbevaring (mod betaling).'], 
       ['@Hvis du vil benytte FTP-server, som du selv sætter op','egenserv','@Egen FTP-server']
      ], $action='',
      '','','',$nl=2);
  htm_CheckFlt($type='checkbox',$name='googdocs', $valu= $googdocs,  $labl='@Benyt Google Docs on-line',  $titl='@Er du bruger af Googles online-systemer... !)',  $revi=true, $more=' '.$pg);
  
  htm_hr();
  htm_RadioGrp($type='vert',  $name='bevar',  $labl='@Ved FTP-opbevaring:', $titl='@Her kan du angive de nødvendige indstillinger', 
               $optlist= array(['extern','@FTP på egen server','@eller',true],['intern','@FTP intern (mod betaling)','']),$action='');
  htm_Caption('Udfyldes ved egen FTP-server:');
  htm_FrstFelt('40%');  htm_CombFelt($type='text',  $name='ftpsted', $valu= $ftpsted, $labl= '@FTP-URL',      $titl= '@Navn eller IP-nummer på ftp-server', $revi=true, $rows='1',$width='130px');
  htm_NextFelt('30%');  htm_CombFelt($type='text',  $name='ftpuser', $valu= $ftpuser, $labl= '@FTP-bruger',   $titl= '@Brugernavn på ftpserver',            $revi=true, $rows='1',$width='130px');
  htm_NextFelt('30%');  htm_CombFelt($type='text',  $name='ftpkode', $valu= $ftpkode, $labl= '@FTP-password', $titl= '@Adgangskode til ftpserver',          $revi=true, $rows='1',$width='130px');  
  htm_LastFelt(); 
  htm_FrstFelt('50%');  htm_CombFelt($type='text',  $name='ftp_bilag_mappe',    $valu= $ftp_bilag_mappe,    $labl= '@Bilags-Mappe',   $titl= '@Mappe til bilag på ftpserver',      $revi=true, $rows='1',$width='230px');  
  htm_NextFelt('50%');  htm_CombFelt($type='text',  $name='ftp_dokument_mappe', $valu= $ftp_dokument_mappe, $labl= '@Dokument-Mappe', $titl= '@Mappe til dokumenter på ftpserver', $revi=true, $rows='1',$width='230px');
  htm_LastFelt();  
  
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='');
}
 
######### :SYSTEM:
# Kaldes fra:  [_system/page_Diversevalg.php] 
function Panl_Diversevalg() {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'diversevalg',$capt= '@Diverse:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW480',__FUNCTION__);
  htm_Caption('@Diverse valg:');
  htm_nl();
  htm_CheckFlt($type='checkbox',$name='tvangsdeb', $valu= $tvangsdeb,  $labl='@Tvungen valg af debitorgruppe på debitorkort',   
          $titl='@Hvis dette felt afmærkes, tvinges brugeren til aktivt at vælge debitorgruppe ved oprettelse af debitorer.',  $revi=true, $more=' '.$pg);
  htm_CheckFlt($type='checkbox',$name='tvangsansv', $valu= $tvangsansv,  $labl='@Tvungen valg af kundeansvarlig på debitorkort',  
          $titl='@Hvis dette felt afmærkes, tvinges brugeren til aktivt at vælge kundeansvarlig ved oprettelse af debitorer',  $revi=true, $more=' '.$pg);
  htm_CheckFlt($type='checkbox',$name='ekstraans', $valu= $ekstraans,  $labl='@Tilføj ekstra felter på ansatte',                
          $titl='@Ved at afmærke her får du op til 14 ekstra felter på ansattes stamkort, for egne ansatte',  $revi=true, $more=' '.$pg);
  htm_hr();
  htm_CheckFlt($type='checkbox',$name='betllist', $valu= $betllist,  $labl='@Brug betalingslister',                           
          $titl='@Benyt betalingslister',  $revi=true, $more=' '.$pg);
  // htm_CheckFlt($type='checkbox',$name='intgbizz', $valu= $intgbizz,  $labl='@Integration med DocuBizz',                       
          // $titl='@Benyt import fra DocuBizz - Det intelligente fakturasystem',  $revi=true, $more=' '.$pg);
  htm_CheckFlt($type='checkbox',$name='brugjobk', $valu= $brugjobk,  $labl='@Brug jobkort',                                   
          $titl='@Jobkort findes i debitorkonti. Her kan du definere opgavebeskrivelser til medarbejdere osv.',  $revi=true, $more=' '.$pg);
  //  htm_hr();
  htm_CheckFlt($type='checkbox',$name='brughtml', $valu= $brughtml,  $labl='@Brug HTML/CSS til formulargenerering',           
          $titl='@Afmærkes feltet anvendes HTML/CSS til formulargenerering',  $revi=true, $more=' '.$pg);
  htm_CheckFlt($type='checkbox',$name='tilldato', $valu= $tilldato,  $labl='@Tillad forskellige datoer på samme bilagsnummer i kassekladde.',  
          $titl=tolk('@Afmærk her for at undtrykke advarsel i kassekladden, hvis der anvendes samme bilagsnummer til flere bilag med forskellige datoer.').
      tolk('@(F.eks, hvis et kontoudtog fra bank bogføres som ét bilag).'),  $revi=true, $more=' '.$pg);
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='');
}
 
######### :SYSTEM:
# Kaldes fra:  [_system/page_Rykkerrel.php] 
function Panl_Rykkerrel() {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'diversevalg',$capt= '@Rykkerrelateret:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
  htm_Caption('@Rykker ansvarlig:');
  htm_nl();
  htm_OptioFlt($type='text', $name='opbevar', $valu= $opbevar, $labl='Brugernavn', 
          $titl='@Brugernavn for ´rykkeransvarlig´ - Når brugeren logger ind, adviseres denne, hvis der skal rykkes - Hvis navn ikke angives adviseres alle.', $revi=true, $optlist= 
          [['@Alle','alle','@--Alle--'], 
           ['@Admin','admin','@Admin']
          ], $action='',
          '','','',$nl=1);
  htm_CombFelt($type='text',  $name='ansvmail', $valu= $ansvmail,   
                          $labl= '@Mailadresse',  
                          $titl= '@Mailadresse for ´rykkeransvarlig´. Hvis angivet sendes email fra denne adresse, når der skal rykkes. (Når nogen logger ind - uanset hvem)', 
                          $revi=true, $rows='2',$width='30px', $step='', $more='',$plho=tolk('@Mail addr...') );
  htm_CombFelt($type='text',  $name='rykk1', $valu= $rykk1,   
                          $labl= '@Frist for rykker 1.',  
                          $titl= '@Antal dage fra forfald til 1. rykker', 
                          $revi=true, $rows='2',$width='30px', $step='', $more='',$plho=tolk('@Antal dage...') );
  htm_CombFelt($type='text',  $name='rykk2', $valu= $rykk2,   
                          $labl= '@Frist for rykker 2.',  
                          $titl= '@Antal dage fra forfald til 2. rykker', 
                          $revi=true, $rows='2',$width='30px', $step='', $more='',$plho=tolk('@Antal dage...') );
  htm_CombFelt($type='text',  $name='rykk3', $valu= $rykk3,   
                          $labl= '@Frist for rykker 3.',  
                          $titl= '@Antal dage fra forfald til 3. rykker', 
                          $revi=true, $rows='2',$width='30px', $step='', $more='',$plho=tolk('@Antal dage...') );
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='');
}
 
######### :SYSTEM:
# Kaldes fra:  [_system/page_Tjeklister.php] 
function Panl_Tjeklister() {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'tjeklist',$capt= '@Tjeklister:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
  htm_Caption('@Tjeklister:');
  htm_nl();
  htm_CombFelt($type='text',  $name='nytjek', $valu= $nytjek,   
                          $labl= '@Ny tjekliste',  
                          $titl= '@Navn på ny tjekliste', 
                          $revi=true, $rows='2',$width='30px', $step='', $more='',$plho=tolk('@Liste...'));
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='Gem');
}
 
 
######### :SYSTEM:
# Kaldes fra:  [_system/page_Differencer.php] 
function Panl_Differencer() {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'tjeklist',$capt= '@Differencer:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
  htm_Caption('@Tolerance for øre-afrunding:');
  htm_nl();
  htm_CombFelt($type='tal2d',  $name='orediff', $valu= $orediff,   
                          $labl= '@Maksimalt beløb for øredifferencer (i kroner)',  
                          $titl= '@Skriv det maksimale beløb for øredifferencer angivet i kroner, som må udlignes i åbne poster', 
                          $revi=true, $rows='2',$width='30px', $step='', $more='',$plho=tolk('@Kr...') );
  htm_CombFelt($type='text',  $name='orediff', $valu= $orediff,   
                          $labl= '@Kontonummer for øredifferencer',  
                          $titl= '@Skriv det kontonummer i kontoplanen som skal bruges til øredifferencer', 
                          $revi=true, $rows='2',$width='30px', $step='', $more='',$plho=tolk('@Konto...') );
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='');
}
 
######### :SYSTEM:
# Kaldes fra:  [_system/page_Massefakt.php] 
function Panl_Massefakt() {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'diversevalg',$capt= '@Massefakturering:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
  htm_Caption('@Massefakturering:');
  htm_nl();
  htm_CheckFlt($type='checkbox',$name='aktvmass', $valu= $aktvmass,  $labl='@Aktiver massefakturering', 
          $titl='@Hvis du aktiverer massefakturering, har du mulighed for at fakturere alle godkendte salgsordrer i en arbejdsgang.',  
  $revi=true, $more=' '.$pg);
  htm_CheckFlt($type='checkbox',$name='aktvmass', $valu= $aktvmass,  $labl='@Medtag delleverancer',     
          $titl='@Hvis du afmærker dette felt, vil ordrer, hvor ikke alt er på lager, blive delleveret/-faktureret.',  
  $revi=true, $more=' '.$pg);
  htm_CombFelt($type='text',  $name='gammel', $valu= $gammel,   
                          $labl= '@Frist for dellevering (dage)',  
                          $titl= '@Her angiver du, hvor mange dage gammel en ordre skal være, før der foretages en dellevering/-fakturering.', 
                          $revi=true, $rows='2',$width='30px', $step='', $more='',$plho=tolk('@Antal dage...') );
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='');
}
 
######### :SYSTEM:
# Kaldes fra:  [_system/page_Formtekst.php] 
function Panl_Formtekst($filDATA) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'diversevalg',$capt= '@Formular tekster:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW640',__FUNCTION__,$more=' style= "height:750px" ');
  htm_Caption('@Tekster på formularer:');
  htm_nl();
  htm_Rammestart($Caption='@Om teksterne:');
    htm_Plaintxt('@Teksterne benyttes ikke i programfladen, men til udskrivning af blanketter.').'<br>';
    htm_Plaintxt('@Du kan formattere teksterne med html-koder').'<br>';
    htm_Plaintxt('@Systemet er ikke anvendt endnu, men blot for at demonstre redigering.').'<br>';
  htm_Rammeslut();
  $DATA= array();  foreach ($filDATA as $rec) array_push($DATA, [$rec[0],$rec[1],[$rec[1],['x']]]);
  # var_dump($data);
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Tabel:',                 '18%','show','','left', ' ', '@Dansk sprog']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Id',                      '5%','show','',['center'],'@Tekstens id','@Auto...'],
          ['@Vist tekst',             '20%','show','',['left'  ],'@Nuværende vist HTML-tekst','@Tekst...'],
          ['@Tekst med format koder', '75%','area','',['left'  ],'@Korrigerbar HTML-tekst','@Tekst...'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON, ]
    $DATA,#=   array(),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter   //  Virker ikke med hidd-felter!
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '400px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_CentrOn(); 
  htm_nl();
    textKnap($label= '@Exporter til csv-fil',    $title= '@Klik her for gemme alle tekster i en fil, som kan indlæses i regneark',  $link= '../_base/page_Blindgyden.php'); // SprogExport($ØlanguageTable)
    textKnap($label= '@Importer fra csv-fil',    $title= '@Klik her for indlæse alle tekster fra en fil som du udpeger',            $link= '../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='');
}
 
######### :SYSTEM:
# Kaldes fra:  [_system/page_Imogexport.php] 
function Panl_Imogexport() {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'imexport',$capt= '@Data export/import:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW480',__FUNCTION__);
  htm_Caption('@Overførsel af data til/fra filer:');
  htm_Rammestart($Caption='@Export - Import:');
    htm_FrstFelt('40%');      htm_Caption('@Kontoplan:');
    htm_NextFelt('60%');
      textKnap($label='@Eksportér', $title='@Eksportér kontoplan',  $link='../_base/page_Blindgyden.php');
      textKnap($label='@Importér',  $title='@Importér kontoplan',   $link='../_base/page_Blindgyden.php');
      textKnap($label='@NOTE!',     $title=tolk('@Eksportér: Den aktive kontoplan!').'<br>'.
                tolk('Importér kontoplan - erstatter kontoplanen for nyeste regnskabsår! (det aktive overskrives)'),  $link='');
    htm_LastFelt();
    htm_FrstFelt('40%');      htm_Caption('@Formularer:');
    htm_NextFelt('60%');
      textKnap($label='@Eksportér', $title='@Eksportér Formularer',  $link='../_base/page_Blindgyden.php');
      textKnap($label='@Importér',  $title='@Importér Formularer',   $link='../_base/page_Blindgyden.php');
    htm_LastFelt();
    htm_FrstFelt('40%');      htm_Caption('@Debitorer/Kreditorer:');
    htm_NextFelt('60%');
      textKnap($label='@Eksportér', $title='@Eksportér Debitorer/Kreditorer',  $link='../_base/page_Blindgyden.php');
      textKnap($label='@Importér',  $title='@Importér Debitorer/Kreditorer',   $link='../_base/page_Blindgyden.php');
    htm_LastFelt();
    htm_FrstFelt('40%');      htm_Caption('@Varer:');
    htm_NextFelt('60%');
      textKnap($label='@Eksportér', $title='@Eksportér Varer',  $link='../_base/page_Blindgyden.php');
      textKnap($label='@Importér',  $title='@Importér Varer',   $link='../_base/page_Blindgyden.php');
    htm_LastFelt();
    htm_FrstFelt('40%');  
    htm_Caption('@Variantvarer:');
    htm_NextFelt('60%');
      textKnap($label='@Eksportér', $title='@Eksportér Variantvarer',  $link='../_base/page_Blindgyden.php');
      textKnap($label='@Importér',  $title='@Importér Variantvarer',   $link='../_base/page_Blindgyden.php');
    htm_LastFelt();
  htm_Rammeslut();
  htm_hr();
  htm_Rammestart($Caption='@Tilpasset dataudtræk:');
    echo tolk('@Du kan se eksempler på: ').' <a href="http://www.ev-soft.dk/saldi-wiki/doku.php?id=saldi:tips-tricks" target="_blank"  title="'.tolk('@Vis i nyt vindue').'">SALDI-DokuWiki</a>';
    htm_CombFelt($type='area',  $name='sql', $valu= $sql,   
                          $labl= '@SQL Dataudtræk:',  
                          $titl= '@Her angiver du, en SQL-forespørgsel, der SELECT-er dataudtræk.', 
                          $revi=true, $rows='2',$width='30px', $step='', $more='',$plho=tolk('@SELECT SQL...') );
  htm_Rammeslut();
  htm_PanlBund($pmpt='@Send',$subm=true,$title='Send SQL-forespørgslen til serveren, og modtag data, som du kan gemme.');
}
 
 
######### :SYSTEM:
# Kaldes fra:  [_system/page_Labels.php] 
function Panl_Labels($lbltype,$demo) {global $VareVars;  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'labels',$capt= '@Label print:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW640',__FUNCTION__,$more=' style= "height:590px" ');
  htm_Rammestart($Caption='@Beskrivelse af systemet:');
    echo tolk('@Her redigerer du en HTML-tekst, som definerer, hvorledes labels udskrives.').' '.str_nl().
         tolk('@Teksten kan indeholde variabel-navne, som udskiftes med aktuelle værdier, når der printes').str_nl().
         tolk('@Hvilke variabler du kan benytte, kan du slå op herunder.');
    echo tolk(' ');
  htm_Rammeslut();
  htm_FrstFelt('22%'); {
    htm_Caption('@Vælg labeltype:');
    htm_OptioFlt($type='text', $name='lbltype', $valu= $lbltype, $labl='Type', $titl='@Vælg den label-type, du vil redigere.',  
                      $revi=true, $optlist=[['@Vare label','vare','@Vare'], ['@Adresse label','addr','@Adresse']], $action='','','','',$nl=2);
    };
  htm_NextFelt('28%'); {
  htm_Caption('@Brugbare variabler:');
    htm_OptioFlt($type='text', $name='variabel', $valu= $lbltype, $labl='Varer', $titl='@Her kan du se de variabler du kan vælge imellem.',  
                      $revi=true, $optlist= $VareVars, $action='','','','',$nl=2);
    };
  htm_NextFelt('50%'); {
  htm_Caption('.');
    htm_OptioFlt($type='text', $name='variabel', $valu= $lbltype, $labl='Adresser', $titl='@Her kan du se de variabler du kan vælge imellem.',  
                      $revi=true, $optlist= FormVars(4), $action='','','','',$nl=2);
    };
  htm_LastFelt(); 
  //  htm_nl(1);
  htm_CombFelt($type='area',   $name='labl', $valu= $demo,  
               $labl='@Label HTML-kode',  
               $titl=tolk('@Her indsættes html kode til formatering af labelprint i varekort. Du kan finde eksempler på ').
                     'Saldi forum: href=http://forum.saldi.dk/viewtopic.php?f=17&t=1159  '.tolk('@under tips og tricks. ').
                     tolk('@Hvis der benyttes API til webshop skrives URL til shoppens funktionsmappe her.'), 
               $revi=true, $rows='10', $width='', $step='', $more='height:200px;',$plho=tolk('@Udfyld med HTML...') );
  echo '<div style="height:50px"></div>';  //  Dummy for at styre højdeplacering!
  htm_nl(4);  echo tolk('@Sådan ser det ud:');
	htm_nl(1);  echo '<div>'.$demo.'</div>';
  htm_PanlBund($pmpt='@Gem',$subm=true);
}
 
######### :SYSTEM:
# Kaldes fra:  [_base/page_Startup.php] 
function Panl_FormularTabel(&$DATA) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'forms',$capt= '@Tabel med samtlige formularers indstillinger:',$parms='#',$icon='fas fa-pen-square','panelW120',__FUNCTION__,$more='');
  htm_FrstFelt('16%');
    htm_Caption('Her ser du kodeforklaringer:');
  htm_NextFelt('23%'); 
    htm_OptioFlt($type='text',  $name='formnr',    $valu= '4', 
                    $labl='@Formular Nr.',      $titl='@Se hvæilke numre, som er tilknyttet formularer',  
                    $revi=true, $optlist= FRM_Liste(),    $action='');
  htm_NextFelt('18%'); 
    htm_OptioFlt($type='text',  $name='blanket',   $valu= '2', 
                    $labl='@Objekt Art',        $titl='@Arten af objekter på formular',  
                    $revi=true, $optlist= FartListe(),    $action='');
  htm_NextFelt('24%');
    htm_OptioFlt($type='text',  $name='sidetype',   $valu= 'A',
                    $labl='@Udskrifts Side',    $titl='@Se koder for udskrifts-side.',  
                    $revi=true, $optlist= SideListe(),             //  $optlist= [['Første sides layout','F','Første'],['Alle sider','A','Alle'],['Sidste sides layout','S','Sidste']],   
                    $action='');
  htm_NextFelt('18%'); 
    htm_OptioFlt($type='text',  $name='formformat',   $valu= 'A4p', 
                    $labl='@Papir format',      $titl='@Se tilgænige papirstørrelser', 
                    $revi=true, $optlist= PaprListe(),  $action='');
  htm_LastFelt('');  
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),  // if (($ModifyRec) or ($RowBody[0][2]!='indx')) er 2% benyttet til => knap
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Nr.',           '3%','', 'show',['center'], '@Formular nr','kode...'],
          ['@Art',           '3%','', 'show',['center'], '@Koden for feltes art','art...'],
          ['@Side',          '3%','', 'show',['center'], '@Udskrift på side kode: A !1 1 S !S','side...'],
          ['@Beskrivelse',  '10%','', 'show',['left'  ], '@Feltets tekstindhold samt $variabler',  'besk...'],
          ['@Just',          '3%','', 'show',['center'], '@Justering af teksten (L/V, C, R/H)','just...'],
          ['@X0',            '4%','', 'show',['right' ], '@Indsætnings X-koordinat (mm fra formularens venstre kant)','X0...',''],
          ['@Y0',            '4%','', 'show',['right' ], '@Indsætnings Y-koordinat (mm fra formularens top kant)','Y0...'],
          ['@Brd.',          '4%','', 'show',['right' ], '@Felt bredde (mm)','F-b...'],
          ['@Høj.',          '4%','', 'show',['right' ], '@Felt højde (mm)','F-h...'],
          ['@Dim.',          '4%','', 'show',['right' ], '@Objektets dimension: Streg-bredde, Tegn-højde, målt i px','Obj-D...'],
          ['@Farve',         '7%','', 'show',['center'], '@Objektets farve, angives som HTML5 tillader. (red, #FF44DD, rgb)','farve...'],
          ['@Txt-font',      '7%','', 'show',['left'  ], '@Objektets font (argument til: font-family)','font...'],
          ['@Txt-style',     '9%','', 'show',['left'  ], '@Objektets style  (argument til: font-weight, font-style)','style...'],
          ['@Grafik',        '8%','', 'show',['left'  ], '@Link til grafikfil','graf...'],
          ['@Fremmedsprog', '10%','', 'show',['left'  ], '@Alternativ beskrivelse, f.eks. på engelsk','alt...'],
          ['@Note',         '10%','', 'show',['left'  ], '@Note til objektet','not...']
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON, ]
    $DATA,#=   array(),
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter   //  Virker ikke med hidd-felter!
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at vælge og ændre data i en row
    $ViewHeight= '500px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__,
    $Kriterie= ['','']    # Test [DataKolonneNr, > grænseværdi] Undlad spec. feltColor
  );
 
/* 
Fremtidig Filstruktur:  
version 3.x               version 5.+
$rec[0]; '$formular'    | $rec[0]; - Formular kode [0..13..]
$rec[1]; '$art'         | $rec[1]; - Formular art kode[0..3]: 0= Layout   1= Grafik     2= Blanket-tekster    3=  Tekster - Ordrelinier
              $rec[13]  | $rec[2]; - Side-kode: A !A S !S G [:string] (G:generelt)
$rec[2]; '$beskrivelse' | $rec[3]; - "Beskrivelse" - Tekstindhold i feltet  [:string]
$rec[3]; '$just'        | $rec[4]; - Justering af/i feltet: V=venste, C=centreret, H=højre [:string]
$rec[4]; '$xa'   (abs)  | $rec[5]; - X0= Feltets indsætningskoordinat   (abs)  [:mm] målt fra venstre side-kant
$rec[5]; '$ya'   (abs)  | $rec[6]; - Y0= Feltets indsætningskoordinat   (abs)  [:mm] målt fra side-top
$rec[6]; '$xb'   (abs)  | $rec[7]; - Feltets bredde (linie længde)      (rel)  [:mm] 
$rec[7]; '$yb'   (abs)  | $rec[8]; - Feltets højde  (linie højde)       (rel)  [:mm] 
$rec[8]; '$wh'          | $rec[9]; - Objektets dimension (streg-bredde, font-højde) [:px]
$rec[9]; '$colr'        | $rec[10];- Objektets farve kode [:string]   {color="color_name|hex_number|rgb(_number)"}
$rec[10];'$font'        | $rec[11];- Objektes font-family [:string]   {default= Helvetica, Arial, Times, sans-serif;}
$rec[11];'$fed'         | $rec[12];- Objektes øvrig font-style i css-format (bold/italic/small/big) [:string]
$rec[12];'$kurs'        | $rec[13];- Grafik-link [:string] i css-format f.eks: "../_assets/images/saldi-e50x170.png" alt="The logoimg"
$rec[13];'$side'        | $rec[14];- Sekunder "Beskrivelse" (på fremmedsprog) [:string] (default: @+Beskrivelse, som kan anvendes som sprog-key)
$rec[14];'$sprog'       | $rec[15];- Note til objektet
 */
  htm_PanlBund($pmpt='@Gem',$subm=false);
}

######### :SYSTEM:
# Kaldes fra:  [_base/page_Printlayout.php] 
function Panl_PrintEdit(&$DATA) {  global $blanket;  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'editform',$capt= '@Formularens felter:',$parms='#',$icon='fas fa-pen-square','panelW100',__FUNCTION__,$more='');
  htm_Caption('@Her kan du vælge variabler - ');
  $copyknap= '<button type="button" id="btnCopy" onclick="varcopy()" style="background-color:'.$ØBtNewBgrd.'" title="'.    //  varcopy() erklæres i htm_pagePrepare.php
    tolk('@Klik her, for at kopiere det valgte variabelnavn til kopieringsbuffer, så du kan indsætte det i tekst-feltet ´Feltindhold´'). 
         '">&nbsp;<ic class="fas fa-copy" style="font-size:15px;"> </ic> Copy </button>';
  echo ' Art=2: Tekster: '. htm_SelectStr($name='copytxt',$valu='VALU',FormVars($frmNr),'max-width:200px; background-color:white;" title="'.  
       tolk('@Her kan du vælge blandt de brugbare variabelnavne angående tekster'),false).$copyknap;
  echo ' Art=3: Ordrelinjer: '. htm_SelectStr($name='copytxt',$valu='VALU',OrdrVars($frmNr),'max-width:200px; background-color:white;" title="'.  
       tolk('@Her kan du vælge blandt de brugbare variabelnavne angående ordrelinier'),false).$copyknap;
  if (($blanket==6) or ($blanket==7) or ($blanket==8))
  {
    htm_FrstFelt('15%');  htm_Caption('@Gebyrberegning: ');
    htm_NextFelt('18%');  htm_CombFelt($type='numberL',  $name='gebyr', $valu= '0', $labl='@Varenummer - rykker gebyr',   $titl='@Varenummer som indeholder sats for rykkergebyr',  $revi=false, $rows='', $width='160px');
    htm_NextFelt('18%');  htm_CombFelt($type='numberL',  $name='sats',  $valu= '0', $labl='@Varenummer - rentesats',  $titl='@Varenummer som angiver sats for rente af for sen betaling',  $revi=false, $rows='', $width='160px');
    htm_NextFelt('25%');  htm_Plaintxt('@Aktiver gebyrberegning, ved at oprette et tekst felt med ordet >GEBYR<');
    htm_NextFelt('18%');  htm_CombFelt($type='numberL',  $name='inka',  $valu= '0', $labl='@Inkasso - gebyr',  $titl='@Størrelsen af inkassogebyr',  $revi=false, $rows='', $width='140px');
    htm_LastFelt('');  
  };
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
       ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
       ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
         ['@Id',            '0%','show','',   ['center'], '@DB index, vedligeholdes af systemet!', 'auto...'],
         ['@Nr.',           '2%','text','',   ['center'], tolk('@Formular nr:'). ShowCol($liste=FRM_Liste(),$col= 0,$sep='<br>').' KAN IKKE RETTES HER!', 'kode...'],
         ['@Art',           '3%','data','',   ['center'], tolk('@Koden for feltes art:').  ShowCol($liste=FartListe(),$col= 0,$sep='<br>'), 'art...'],
         ['@Side',          '3%','data','',   ['center'], tolk('@Udskrift på side kode:'). ShowCol($liste=SideListe(),$col= 2,$sep='<br>'), 'side...'],
         ['@Feltindhold',  '24%','data','',   ['left'  ], '@Feltets tekstindhold samt $variabler',  '-'],
         ['@Just',          '3%','data','',   ['center'], tolk('@Justering af teksten:').  ShowCol($liste=JustListe(),$col= 0,$sep='<br>').'(Samt kode for papirformat)', '-'],
         ['@X0',            '4%','helt','0d', ['right' ], '@Indsætnings X-koordinat (mm fra formularens venstre kant)', 'X0...'],
         ['@Y0',            '4%','helt','0d', ['right' ], '@Indsætnings Y-koordinat (mm fra formularens top kant)', 'Y0...'],
         ['@Brd.',          '4%','helt','0d', ['right' ], '@Felt bredde (mm)', 'F-b...'],
         ['@Høj.',          '4%','helt','0d', ['right' ], tolk('@Felt højde (mm)').'<br>'.tolk('@Angiv 0 for at autotilpasse'), 'F-h...'],
         ['@Dim.',          '4%','helt','0d', ['right' ], '@Objektets dimension: Streg-bredde, Tegn-højde, målt i px (pixel)', 'Obj-D...'],
         ['@Farve',         '7%','data','',   ['center'], '@Objektets farve, angives som HTML5 tillader. (red, #FF44DD, rgb)', 'farve...'],
         ['@Txt-font',     '10%','data','',   ['left'  ], tolk('@Objektets font').str_nl().tolk('(gyldigt argument til: font-family):'). ShowCol($liste=FontListe(),$col= 2,$sep=str_nl()), '-'],
         ['@Txt-style',    '13%','data','',   ['left'  ], tolk('@Objektets style').'<br>'.tolk('(gyldigt argument til: font-weight, font-style). Husk afsluttende semikolon!'), '-'],
         ['@Grafik',        '2%','data','',   ['left'  ], '@Link til grafikfil', 'graf...'],
         ['@Fremmed-sprog', '0%','text','',   ['left'  ], '@Alternativ beskrivelse, f.eks. på engelsk', 'alt...'],
         ['@Note',         '10%','data','',   ['left'  ], '@Note til objektet', 'note..']
       ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
         ['@Slet',          '8%','text','',   ['center'], '@Klik på rødt kryds for at slette denne post', '<ic class="far fa-times-circle" style="color:red; font-size:13px; "></ic>']
       ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON]
    $DATA /* =   array(
       ) */ ,
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '500px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_nl();
  XY_forskydning();
  htm_Caption('@Her er der ingen kontrol af indtastede data, så det er dit ansvar, at de er gyldige!');
  htm_Plaintxt('@Når du redigerer, kan det være en fordel, at se disse paneler (Layout & Tabel) i 2 browser-vinduer, ved siden af hinanden.');
  htm_PanlBund($pmpt='@Gem',$subm=true,'@Husk at gemme her, hvis du har rettet noget ovenfor, inden du forlader vinduet.','','','editform');
  //  var_dump($_POST);
  //  Vis_Data($_POST);
  //  if (isset($_POST['btn_editform']))
  //  if (is_array($_POST['editform'])) { foreach($_POST['editform'] as $inputName => $inputValue)    { echo '<br> Name:'.$inputName; echo ' Valu:'.$inputValue; } }
} //  Panl_PrintEdit
 
 
######### :SYSTEM:
# Kaldes fra:  [_base/page_Printlayout.php] [_base/page_Startup.php] 
function Panl_PrintDesign(&$DATA=[])  {    ## out_PanlsSekd.php
//  Afløser for Panl_PrintlayoutTXT
  global $html_buff, $x0, $blanket; 
    
  // Panl_PrintDesign start:
  //  Initiering:
  if (!$blanket)    $blanket= 4; 
  if (!$sidetype)   $sidetype= 'A'; 
  if (!$fremmedsp)  $fremmedsp= false;       
  //  Opdatering:
  if (isset($_POST['btn_printout'])) {  //  Accept-knap i paneltes footer
   //  $blanket=  $_POST['blanket']; 
     $sidetype= $_POST['sidetype'];
     $fremmedsp= $_POST['fremmedsp']; 
    }
  if (isset($_POST['blanket']))   $blanket=    $_POST['blanket']; 
  if (isset($_POST['fremmedsp'])) $fremmedsp=  $_POST['fremmedsp']; 
  $fremmedsp= false;
  
  ## Varelinie-data:
  $varedat= sql_readB('SELECT id, form, frm_art, side, besk, just, x0, y0, dx, dy, dim, colr, font, style, imglnk, lngkey, note '.
                      'FROM  tblA_forms '.
                      'WHERE form="'.$blanket.'" AND frm_art="0" AND side="G"',__FILE__, __LINE__);
  $papirformat= $varedat['just'];
  switch ($papirformat) {         
    case 'A5p': $pagewidth= 149; $pageheight= 210; break; 
    case 'A5l': $pagewidth= 210; $pageheight= 149; break; 
    case 'A4p': $pagewidth= 210; $pageheight= 297; break; 
    case 'A4l': $pagewidth= 297; $pageheight= 210; break; 
    case 'A3p': $pagewidth= 297; $pageheight= 420; break; 
    case 'A3l': $pagewidth= 420; $pageheight= 297; break; 
    default   : $pagewidth= 210; $pageheight= 297; $papirformat='A4p';
  }
  if ($pagewidth<=220) $panel= 'panelW100'; else $panel= 'panelW120';
  
  htm_Panl_Top($name= 'printout',$capt= '@Udskrivnings-Layout',$parms='#',$icon='fas fa-print',$panel,__FUNCTION__);
  htm_FrstFelt('27%');
    htm_OptioFlt($type='text',  $name='blanket',   $valu= $blanket, 
                    $labl='@Formular',      $titl='@Vælg en Formular som du vil vise/redigere',  
                    $revi=true, $optlist= FRM_Liste(),    $action='', $events='','','',1);  //  onchange="window.location.reload();"
  htm_NextFelt('35%');
    htm_OptioFlt($type='text',  $name='sidetype',   $valu= $sidetype,
                    $labl='@Udskrifts Side (& Sidste!)',   $titl='@Her vælger du visning af udskrifts-side.',  
                    $revi=true, $optlist= SideListe(), 
                    $action='','','','',1);
  htm_NextFelt('15%');  
    htm_CheckFlt($type='checkbox',$name='fremmedsp', $valu= $fremmedsp,  $labl='@Benyt fremmesprog', 
          $titl='@Anvend alternativ beskrivelse fra formularens data. Endnu ikke brugbart',  $revi=true, $more=' ');
     $vistools= true;
      //$vistools= 
      // htm_CheckFlt($type='checkbox',$name='vistools', $valu= $vistools,  $labl='@Vis redskaber.', 
          // $titl='@Vis akse-skalaer og mouse-position',  $revi=true, $more=' '); //  Virker ikke! FIXIT
  htm_NextFelt('20%'); 
    htm_Plaintxt('@Opdater med genvejstast: g'); #+ textKnap($label='@Vis/opdater',  $title='@Opdater her hvis du har ændret formular eller side.', $link='#','o');    //  page_Printlayout.php
  htm_LastFelt('');  
  htm_FrstFelt('25%');  htm_OptioFlt($type='text',     $name='papir',  $valu= $varedat[0]['just'], $labl='@Papir-format',  
                  $titl='@Papirstørrelse og retning',  $revi=false, $optlist= PaprListe(),  $action='','','','',1);
  htm_NextFelt('10%');  htm_Caption('@Ordrelinier:');
  htm_NextFelt('10%');  htm_CombFelt($type='numberL',  $name='linier', $valu= $varedat[0]['x0'], $labl='@Antal',   
                  $titl='@Antal ordrelinier pr. side', $revi=false, $rows='', $width='80px');
  htm_NextFelt('10%');  htm_CombFelt($type='numberL',  $name='first',  $valu= $varedat[0]['y0'], $labl='@Første',  
                  $titl='@Første ordrelines y-startpunkt (grundlinie) målt i mm fra side-top',  $revi=false, $rows='', $width='80px');
  htm_NextFelt('10%');  htm_CombFelt($type='numberL',  $name='afstand',$valu= $varedat[0]['dy'], $labl='@Afstand', 
                  $titl='@Afstand mellem ordre-liniers grundlinie, målt i mm',  $revi=false, $rows='', $width='80px');
  htm_NextFelt('35%');  htm_CombFelt($type='numberL',  $name='bredde', $valu= $varedat[0]['dx'], $labl='@Bredde',  
                  $titl='@Maksimal linie længde for beskrivelse, inden der brydes til ny linie, målt i mm',  $revi=false, $rows='', $width='80px');
  htm_Plaintxt(' &nbsp; Kan pt. ikke rettes her');
  htm_LastFelt('');  
    htm_nl();
// INITIERING:
//  $filDATA= ImportTabFile(realpath($_SERVER["DOCUMENT_ROOT"]). '/saldi-e/_exchange/_standard/formularer.v50.tab');  //  Ny version
//  $filDATA= ImportTabFile(realpath($_SERVER["DOCUMENT_ROOT"]). '/saldi-e/_exchange/_standard/formular-utf8.tab');   //  Gl version
  #- $DATA= sql_readB('SELECT id, form, frm_art, side, besk, just, x0, y0, dx, dy, dim, colr, font, style, imglnk, lngkey, note '.
  #-                  'FROM tblA_forms ',__FILE__, __LINE__);
  $pform= tolk(ListLookup($liste=PaprListe(),$search= $papirformat,$colsearch=1,$colresult=2));
  //$blanket='6';
  panl_PrintForm($DATA, $blanket, $pform, $pagewidth, $pageheight, $vistools);
  htm_nl();
  textKnap($label='@Se udskrift', $title='@Se hvad der kan udskrives med CTRL-p (uden stempel: KOPI)', $link='../_temp/printside.htm',$akey='p" target="_blank');
  textKnap($label='@Se kopi',     $title='@Se hvad der kan udskrives med CTRL-p (med stempel: KOPI)',  $link='../_temp/kopiside.htm',$akey='k" target="_blank');
  htm_nl(2);
  htm_Caption('@Mail-tekster - ');
  htm_Caption('@Emne: ');   htm_sp(2); htm_Plaintxt($mailemne.': '.'$ordre_fakturanr'); htm_sp(4); 
  htm_Caption('@Besked: '); htm_sp(2); htm_Plaintxt($mailbesk);
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='@Gem eller opdater',$akey='g','','printout');
  //  var_dump($_POST);
  //  if(isset($_POST['Submit'])) {var_dump($_POST['printout']); foreach($_POST['printout'] as $inputName => $inputValue)    { echo '<br> Name:'.$inputName; echo ' Valu:'.$inputValue; }  }
  return $blanket;
} //  Panl_PrintDesign


function panl_PrintForm($DATA, $blanket, $pform, $pagewidth, $pagehght, $vistools, $caption='@Forhåndsvisning:') { 
global $html_buff, $x0, $pageheight, $sidetype;
$pageheight= $pagehght;
  htm_Panl_Top($name= 'preview', $caption, $parms='../_base/page_Blindgyden.php',$icon='fas fa-print','panelW100',__FUNCTION__);
  function textfelt($ix, $x='', $y='', $h='', $b='', $txt='', $style='',$clean=false,$vistools=false,$doprn=true) { 
  global $pageheight, $html_buff;
  //  Angives $h til værdien 0, bliver ramme-højden automatisk tilpasset indholdet.
    dvl_pretty('textfelt');
    $bordpx='1';
    if ($h!=0) $ramme_h= 'height: '.$h.'mm; '; else $ramme_h= '';  //  Udelades height => "h=fit"
    if (($vistools==true) and (!$doprn)) $bordpx='2';
    $bdr= ' border: '.$bordpx.'px solid #efefef;';    //  Felt-ramme
    $out_str1= '<span id="df_'.$ix.'"  style="position: absolute;  bottom:'.($pageheight-$y).'mm; left: '.$x.'mm; width: '.$b.'mm; '.$ramme_h;  //  bottom for at justere efter tekst base-linie
    $out_str2= 'font-family: Helvetica, Arial, Times, sans-serif; white-space:pre; '.$style.'">';
    //  Onmouseover: Vis div.x,y og rectangel som flytter med musen, så man kan klikke et flytTilPunkt
    if ($clean) $out_str2.= '<span style="position:relative; left:0; bottom:0;">'.$txt.'</span>';  //  Tekst i rammen     border:1px dotted green;
    else        $out_str2.= 'Pos: '.$x.'mm:'.$y.'mm - '.$txt.' - Dim: '.$b.'x'.$h.' mm  : '.$style;
    $out_str2.= '</span>';
    echo $out_str1.$bdr.$out_str2;   if ($doprn) $html_buff.= $out_str1.$out_str2;
    return $out_str1.$out_str2;
  };
  function setstyle($b, $wh, $ffam, $just, $colr, $fsty) { global $x0;
        $feltw= $b;   //  $feltw= +1.4*strlen($beskriv)+0.8*$wh; 
        $style= '';    $font= '';  $px= $wh;  $fsty= ' '.strtolower($fsty);
        if ($colr=='0') $colr= '#000';
        if (strpos($fsty,'bold;'))    {$fsty= str_replace('bold;',   '',$fsty).' font-weight:bold; '; } 
        if (strpos($fsty,'italic;'))  {$fsty= str_replace('italic;', '',$fsty).' font-style:italic; '; }
        if (strpos($fsty,'oblique;')) {$fsty= str_replace('oblique;','',$fsty).' font-style:oblique; '; }
        if (strpos($fsty,'normal;'))  {$fsty= str_replace('normal;', '',$fsty).' font-style:normal; '; }
        if ($ffam  =='Helvetica')  {$font.= 'Helvetica; ';}  else {$font.= 'Times; ';}
        if ($wh >0)       {$style.= 'font:'.$px.'px '.$font;}
        if (($just =='V') or ($just =='L'))
                          {$style.= 'text-align:left; ';   $dx= 0;          $x0= $x0-$dx; }
        if  ($just =='C') {$style.= 'text-align:center; '; $dx= $feltw/2;   $x0= $x0-$dx; }
        if (($just =='H') or ($just =='R'))
                          {$style.= 'text-align:right; ';  $dx= $feltw;     $x0= $x0-$dx; }
        if ($colr>'')     {$style.= 'color:'.$colr.'; ';}   // Color! <font color="red">  <font color="color_name|hex_number|rgb(_number)">   style="font-family:Courier; color:Blue; font-size: 20px;"
        if ($fsty)        {$style.= $fsty;}; // else {$style.= 'font-style:normal; ';} //  font-style: normal|italic|oblique|initial|inherit;    font-weight: bold;
        return $style;
  } 
  function linefelt($x='', $y='', $h='', $b='', $colr='') {  //  Linier, som rectangler med lav højde
    global $pageheight, $html_buff;
    if ($y-$h<0) {$y=$y+$h;}
    $out_str= '<span style="position:absolute; bottom:'.($pageheight-$y).'mm; left:'.$x.'mm; width:'.$b.'mm; height:'.($h).'mm; border:0.5px solid '.$colr.'; font:1px;"></span>';
    echo $out_str;    $html_buff.= $out_str;
   } 
  function graffelt( $x='', $y='', $h,/* px */ $b,/* px */  $img= 'src="../_assets/images/saldi-e50x170.png" alt="The logoimg" ') { 
    global $pageheight, $html_buff;
    $field ='border:1px dotted gray; font:1px; color:red; ">_';
    if (true) $field='border:0px dotted gray; font:1px; color:red; ">';
    $out_str.=  '<span style="position:absolute; bottom:'.($pageheight-$y).'mm; left:'.$x.'mm; '.$field.'<img '.$img.' height="'.$h.'" width="'.$b.'" ></span>';
    echo $out_str;    $html_buff.= $out_str;
  }
  
## Initier udskrivnings-buffere:
  $html_buff= '<!DOCTYPE html><html lang="da" dir="ltr"> <head>  <meta charset="UTF-8">  <title>'.tolk('@Udskrifts-side').'</title>'.
              '<style type="text/css"> @page { size:'.$pagewidth.'mm '.$pageheight.'mm; margin:0mm 0mm 0mm 0mm; } </style> </head><body>';
  $kopibuff= '';
  htm_nl();
  echo '<fieldset id="printpage" style="border: 1px solid #8c8b8b; padding:2px; width:'.$pagewidth.'mm; height:'.$pageheight.'mm; margin: auto; margin-bottom:20px;'.
   ' position:relative; background:white;  cursor:crosshair;"> <legend><tc><b>'.tolk('@Papir:'.$pform).'</b></tc></legend>';
  if ($vistools==true) {
    //  akser($pagewidth, $pageheight);   Forkert ved forskellige papirformater - FIXit eller undvær
    echo '<span id="showinfo" style="position: relative; top:'.($pageheight/2).    'mm; left:-45mm; width:200px;" >Pos. X,Y:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;?,?&nbsp;mm; </span>'; //  X:Y-pos:  &nbsp;  ?:?
    echo '<span id="showkoor" style="position: relative; top:'.($pageheight/2-8.5).'mm; left:-36mm; width:200px;" >Klik-Pos. X,Y:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;?,?&nbsp;mm </span>'; //  X,Y-pos:  &nbsp;  ?,?
  }
  $calib= 3.8;
  echo '<script>';     //  https://stackoverflow.com/questions/7790725/javascript-track-mouse-position
  echo 'var offset = $("#printpage").offset();';
// Vis XY-position:
  echo "var showinfo = document.getElementById('showinfo');";  //  Knyt til objektet showinfo
  echo "function tellPos(p){ showinfo.innerHTML = 'Pos. X: ' + Math.round((p.pageX  - offset.left)/".$calib." ) + ' , Y:' + Math.round((p.pageY - offset.top)/".$calib.") + ' mm';}";
  echo "addEventListener('mousemove', tellPos, false); ";   //  Rapporter mouse-pos til function tellPos
// Gem klik-position:
  echo "var showkoor = document.getElementById('showkoor');";  //  Knyt til objektet showkoor
  echo "function savePos(p){ showkoor.innerHTML = 'Klik X,Y: ' + Math.round((p.pageX  - offset.left)/".$calib." ) + ',' + Math.round((p.pageY - offset.top)/".$calib.") + ' mm';}";
  echo "addEventListener('click', savePos, false); ";   //  Rapporter mouse-pos til function savePos
  echo '</script>';
/* 
Data-struktur version 5.+
id serial,            | $rec[-1] - DB-id
form integer,         | $rec[0]; - Formular kode [0..13..]
frm_art integer,      | $rec[1]; - Formular art kode[0..3]: 0= Layout   1= Grafik     2= Blanket-tekster    3=  Tekster - Ordrelinier    5= Mail-tekster
side varchar(2),      | $rec[2]; - Side-kode: A !A S !S G [:string] (G:generelt/Layout)
besk VARCHAR(300),    | $rec[3]; - "Beskrivelse" - Tekstindhold i feltet  [:string]
just VARCHAR(30),     | $rec[4]; - Justering i feltet: L/V=venste, C=centreret, R/H=højre [:string]           {Layout: kode for papirformat }
x0 numeric(15,3),     | $rec[5]; - X0= Feltets indsætningskoordinat   (abs)  [:mm] målt fra venstre side-kant {Layout: Ordrelinie antal }                 {Mail: felt-nr: 1= "Emne" 2= "Besked" 3= "Vedhæftet"}
y0 numeric(15,3),     | $rec[6]; - Y0= Feltets indsætningskoordinat   (abs)  [:mm] målt fra side-top          {Layout: Ordrelinie placering af 1. linie }
dx numeric(15,3),     | $rec[7]; - Feltets bredde (linie længde)      (rel)  [:mm]                            {Layout: Bredde af Ordrelinie beskrivelse } 
dy numeric(15,3),     | $rec[8]; - Feltets højde  (linie højde)       (rel)  [:mm]                            {Layout: Ordrelinie afstand } 
dim numeric(15,3),    | $rec[9]; - Objektets dimension (streg-bredde, font-højde) [:px]
colr VARCHAR(30),     | $rec[10];- Objektets farve kode [:string]  {color="color_name|hex_number|rgb(_number)"}
font VARCHAR(99),     | $rec[11];- Objektes font-family [:string]  {default= Helvetica, Arial, Times, sans-serif;}
style VARCHAR(99),    | $rec[12];- Objektes øvrig font-style i css-format (bold/italic/small/big) [:string]
imglnk VARCHAR(99),   | $rec[13];- Grafik-link [:string] i css-format f.eks: src="../_assets/images/saldi-e50x170.png" alt="The logoimg"
lngkey VARCHAR(300),  | $rec[14];- Sekunder "Beskrivelse" (på fremmedsprog) [:string] (default: @+Beskrivelse, som kan anvendes som sprog-key)
note VARCHAR(99),     | $rec[15];- Note til feltet
*/

  $layout= 0;   $grafik= 1;   $tekster= 2;    $ordrelin= 3;   $maildata= 5;   //  Konstanter
  $dx= 0;   $mailemne= '';  $mailbesk= '';  $afst=2;  $antal=5; $toplin= 140; //  Initiering
  $ix= 0;  // Felter: 'SELECT id, form, frm_art, side, besk, just, x0, y0, dx, dy, dim, colr, font, style, imglnk, lngkey, note '
  foreach ($DATA as $rec) //  - udtegn data   ## utf8_decode $beskriv og $tolket hvis der indlæses fra fil!
    { //  $qstr='SELECT id, form, frm_art, side, besk, just, x0, y0, dx, dy, dim, colr, font, style, imglnk, lngkey, note '.
      $x0= $rec['x0']; $y0= $rec['y0']; $b= ($rec['dx']); $h= ($rec['dy']); $wh=$rec['dim']; 
      $just= strtoupper($rec['just']);  
    //+  $tolket= tolk($rec['lngkey']);  
    //+  if ($fremmedsp==true) $rec['besk']= $tolket;
      $rec['besk']= tolk($rec['lngkey']);
      if ($rec['side']=='') $rec['side']= 'A';
// Generelt:
    if ($rec['form']==$blanket)  {
      if (($rec['frm_art']==$layout) and ($rec['side']=='G'))  //  Papirformat og Ordrelinier-placering
        { $antal= $rec['x0']; $toplin= $rec['y0']; 
          $bred= $rec['dx'];  $afst= $rec['dy'];  
          $pfrm= $rec['just'];
        }
      if (($rec['frm_art']==$layout) and (strlen($just)==1))  //  Stempel-tekst
        { $style= setstyle($b, $wh, $rec['font'], $just, $rec['colr'], $rec['style']); 
          $kopibuff.= textfelt($ix++,$x0,$y0, $wh/3.0, $b, $rec['besk'], $style,true,$vistools,false);
        }
      if  ($rec['frm_art']==$maildata)  //  Mail-tekster
        { if ($x0=='1') $mailemne= $rec['besk'];
          if ($x0=='2') $mailbesk= $rec['besk'];
        }
      } //  Det skal sikres at $rec['frm_art']==0 kommer før ordrelinier i filen !
// Grafik:
    if (($rec['form']==$blanket) and (($rec['side']==$sidetype) 
     or ($rec['side']=='A'))     and ($rec['frm_art']==$grafik)) {  //  'side']=='A' ?
        if ($wh>0) linefelt($x0, $y0, $h, $b, $colr='gray');        // Linier (=rektangler med ramme)
        if ($wh<1) graffelt($x0, $y0, $h, $b, $img= /* 'src="'. */$rec['imglnk'].' '); // Grafik
      }
// Tekster:
    if (($rec['form']==$blanket) 
        //  and (($rec['side']==$sidetype)   or ($rec['side']=='S'))
        and (($rec['frm_art']==$tekster) or ($rec['frm_art']==$ordrelin)) )
      { $style= setstyle($b, $wh, $rec['font'], $just, $rec['colr'], $rec['style']);
        if ($rec['besk']==':GEBYR') {/* udskrives ikke.  */}     // Flag ang. gebyrberegning
        else 
        if ($rec['frm_art']==$ordrelin)   // Ordrelinier
          for ($i= 0; $i < $antal; $i++) 
            { textfelt($ix++,$x0,$toplin+$i*$afst, $wh/3.5, $b, $rec['besk'], $style,true,$i==0,true);                       //  1. Ordrelinie
              if ($i==0) textfelt($ix++,$x0,$toplin+$i*$afst, $wh/3.5, $b, '_', $style.' color:red;',true,$vistools,false);  //  Vis indsætningspunkt i 1. linie
            } //  Alle andre tekster:
        else {textfelt($ix++,$x0,$y0, $wh/3.0, $b, $rec['besk'], $style,true,$vistools);
              textfelt($ix++,$x0,$y0, $wh/3.0, $b, '_', $style.' color:red;',true,$vistools,false);  //  Vis indsætningspunkt
        }
      }
    }
  $html_orig= $html_buff;
  $html_kopi= $html_buff.$kopibuff;
  if ($vistools) {
    // Demo-TEKSTER:
    textfelt($ix++,  0,   0,  0,  0,'BASE x:0, y:0', 'font-weight:bold; color:brown; transform:rotate(-10deg); font:12px times; ',true,'',false);
    textfelt($ix++, 80, 160,  0, 40,'<u>FeltA</u> x:80, y:160', 'font-weight:bold; color:Tomato; font:8px times; ',true,'',false);
    textfelt($ix++,100, 160,  0, 40,'<u>FeltB</u> x:100, y:160','font-weight:bold; color:blue;   font:16px times;',true,'',false);
    textfelt($ix++, 75, 170,  3, 60,'Tekst-Data felters indsætningspunkt vises med rødt <red style="color:red;">_</red> <br>Y-værdier måles fra dokument-top til teksters grundlinie, så ændring af skrift-højde, '.
                              'ikke får tekster til at "hoppe"<br>Tillades fler-linier med style="white-space:pre-wrap;", skal man være klar over at feltet vokser opad hvis $h=0, så det er sidste linie, '.
                              'der er placeret på Y-værdien! Angives derimod $h=3 (linie-højde) fortsætter teksten derimod nedad, til højere Y-værdier.','font:10px times; white-space:pre-wrap; ',true,'',false);
  }
  echo '</fieldset>';
  htm_lf();
  //$html_buff.= '</body> </html>';
  $fp= fopen("../_temp/printside.htm","w");   if ($fp) { fwrite($fp,$html_orig."</body> </html>\n"); fclose($fp); };  
  $fp= fopen("../_temp/kopiside.htm","w");    if ($fp) { fwrite($fp,$html_kopi."</body> </html>\n"); fclose($fp); };     
  htm_PanlBund($pmpt='@Forhåndsvisning',$subm=false);
}

######### :SYSTEM:
# Kaldes fra:  [_base/page_Startup.php] 
function Panl_PrintlayoutTXT($filDATA=[], $pagewidth=210, $pageheight=297) { global $html_buff;   ## out_PanlsSekd.php
//  "Grafik", baseret på absolute placering.   //  Panl_PrintDesign erstatter!
  // Tekster ikke som grafik, betyder bedre opløsning!
  //  Denne funktion læser gammelt format og kan eksporteret til nyt filformat.
  function textfelt($x='', $y='', $h='', $b='', $txt='', $style='',$clean=false,$vistools='',$doprn=true) { global $html_buff;
  //  Angives $h til værdien 0, bliver ramme-højden automatisk tilpasset indholdet.
    dvl_pretty('textfelt');
    $bordpx='1';
    if ($h!=0) $ramme_h= 'height: '.$h.'mm; '; else $ramme_h= '';  //  Udelades height => "h=fit"
    if (($vistools==true) and (!$doprn)) $bordpx='2';
    $bdr= ' border: '.$bordpx.'px solid #efefef;';    //  Felt-ramme
    $out_str1= '<div style="position: absolute;  bottom:'.(297-$y).'mm; left: '.$x.'mm; width: '.$b.'mm; '.$ramme_h; # .$bdr //  bottom for at justere efter tekst base-linie
    $out_str2= 'font-family: Helvetica, Arial, Times, sans-serif; white-space:pre; '.$style.'">';
    if ($clean) $out_str2.= '<div style="position:relative; left:0; bottom:0;">'.$txt.'</div>';  //  Tekst i rammen     border:1px dotted green;
    else        $out_str2.= 'Pos: '.$x.'mm:'.$y.'mm - '.$txt.' - Dim: '.$b.'x'.$h.' mm  : '.$style;
    $out_str2.= '</div>';
    echo $out_str1.$bdr.$out_str2;   if ($doprn) $html_buff.= $out_str1.$out_str2;
  };
  function linefelt($x='', $y='', $h='', $b='', $colr='') { global $html_buff; //  Linier, som rectangler med lav højde
    $out_str= '<div style="position:absolute; bottom:'.(297-$y).'mm; left:'.$x.'mm; width:'.$b.'mm; height:'.($h).'mm; border:0.5px solid '.$colr.'; font:1px;"></div>';
    echo $out_str;    $html_buff.= $out_str;
   } 
  function graffelt( $x='', $y='', $h=50,/* px */ $b=170,/* px */  $img= 'src="../_assets/images/saldi-e50x170.png" alt="The logoimg" ') { global $html_buff;
    $field ='border:1px dotted gray; font:1px; color:red; ">_';
    if (true) $field='border:0px dotted gray; font:1px; color:red; ">';
    $out_str.=  '<div style="position:absolute; bottom:'.(297-$y).'mm; left:'.$x.'mm; '.$field.'<img '.$img.' height="'.$h.'" width="'.$b.'" ></div>';
    echo $out_str;    $html_buff.= $out_str;
  }       //      ($y-$h/12).
  function akser($b=210,$h=297) {  $y0= -2.5;  //  Firefox -5      Chrome 0
    function get_browser_name($user_agent)
    { //  echo 'Browser: '.$user_agent;
    if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
        elseif (strpos($user_agent, 'Edge')) return 'Edge';
        elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
        elseif (strpos($user_agent, 'Safari')) return 'Safari';
        elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
        elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';
        return 'Other';
    }
    $brws= get_browser_name($_SERVER['HTTP_USER_AGENT']);
    if ($brws=='Firefox') {$x0= -0; $y0= 0;} 
    if ($brws=='Chrome')  {$x0= -0; $y0= 0;} 
    for ($i= 0; $i<= $h;  $i++)   { textfelt($x0       -2, $y0+$i    +2,  0,-1, '&nbsp;-', 'font:12px times; text-align:right; color:gray;',true,'',false); }         //  Venstre Y-akse (y0 i toppen) mm
    for ($i= 0; $i<= 29;  $i++)   { textfelt($x0       -7, $y0+$i*10 +2,  0,-1, ($i*10).'&nbsp;&nbsp;-', 'font:12px times; text-align:right;',true,'',false); }       //  Venstre Y-akse (y0 i toppen) cm
    for ($i= 0; $i<= 29;  $i++)   { textfelt($x0      -17, $y0+$i*10 +2,  0,-1, ''.($h-($i*10)), 'font:12px times; text-align:right; font-style:italic;',true,'',false); } //  Venstre Y-akse (y0 i bunden)
    for ($i= 0; $i<= $h;  $i++)   { textfelt($x0+$b   +1,  $y0+$i    +2,  0,-1, '-', 'font:12px times; text-align:left; color:gray; ',true,'',false); }              //  Højre Y-akse mm
    for ($i= 0; $i<= 29;  $i++)   { textfelt($x0+$b   +0,  $y0+$i*10 +2,  0,-1, '-&nbsp;&nbsp;'.($i*10), 'font:12px times; text-align:left;',true,'',false); }        //  Højre Y-akse cm
    for ($i= 0; $i<= $b;  $i++)   { textfelt($x0+$i    -1, $y0       +2,  0,-1, '-&nbsp;', 'font:12px times; text-align:left; transform: rotate(270deg); color:gray;',true,'',false); }          //  Top- X-akse mm
    for ($i= 0; $i<= 21;  $i++)   { textfelt($x0+$i*10 -1, $y0       -0,  0,-1, '-&nbsp;&nbsp;&nbsp;'.($i*10), 'font:12px times; text-align:left; transform: rotate(270deg); ',true,'',false); } //  Top- X-akse cm
    for ($i= 0; $i<= $b;  $i++)   { textfelt($x0+$i    -0, $y0+$h   +3,  0,-1, ' -', 'font:12px times; text-align:right; transform: rotate(270deg); color:gray;',true,'',false); }           //  Bund- X-akse mm
    for ($i= 0; $i<= 21;  $i++)   { textfelt($x0+$i*10 -3, $y0+$h   +5,  0,-1, ($i*10).'&nbsp;&nbsp;-', 'font:12px times; text-align:right; transform: rotate(270deg); ',true,'',false); }   //  Bund- X-akse cm
  }
  
#+   if (isset($_POST['submit']) && $_POST['submit']) {
     $blanket=  $_POST['blanket'];    if (!$blanket) $blanket= '3';
     $sidetype= $_POST['sidetype'];   if (!$sidetype) $sidetype= 'A';
     // $vistools= $_POST['vistools'];
     // htm_PostVariabler($namelist=['blanket','sidetype','vistools']);
#+   } else $blanket= 3;
   if ($width<=220) $panel= 'panelW960'; else $panel= 'panelW120';
  
  htm_Panl_Top($name= 'printout',$capt= '@Udskrivnings-Layout',$parms='../_base/page_Printlayout.php',$icon='fas fa-print',$panel,__FUNCTION__);
  htm_FrstFelt('25%');
    htm_OptioFlt($type='text',  $name='blanket',   $valu= $blanket, 
                    $labl='@Formular',      $titl='@Vælg en Formular som du vil vise',  
                    $revi=true, $optlist= FRM_Liste(),    $action='');
  htm_NextFelt('35%');
    htm_OptioFlt($type='text',  $name='sidetype',   $valu= $sidetype,
                    $labl='@Udskrifts Side (& Sidste!)',   $titl='@Her vælger du visning af udskrifts-side.',  
                    $revi=true, $optlist= SideListe(),             //  $optlist= [['Første sides layout','F','Første'],['Alle sider','A','Alle'],['Sidste sides layout','S','Sidste']],   
                    $action='');
  htm_NextFelt('10%');   $vistools= true;
      //$vistools= 
      // htm_CheckFlt($type='checkbox',$name='vistools', $valu= $vistools,  $labl='@Vis redskaber.', 
          // $titl='@Vis akse-skalaer og mouse-position',  $revi=true, $more=' '); //  Virker ikke! FIXIT
  htm_NextFelt('30%'); 
    htm_Plaintxt('@Opdater med genvejstast: g'); #+ textKnap($label='@Vis/opdater',  $title='@Opdater her hvis du har ændret formular eller side.', $link='#','o');    //  page_Printlayout.php
  htm_LastFelt('');  
    htm_nl();
// INITIERING:
  //$fp= null; //fopen(realpath($_SERVER["DOCUMENT_ROOT"]).'/saldi-e/_exchange/_standard/formularer.v50.tab',"w"); //  /saldi-e/_exchange/_standard/formular-utf8.tab

//  $filDATA= ImportTabFile(realpath($_SERVER["DOCUMENT_ROOT"]). '/saldi-e/_exchange/_standard/formularer.v50.tab');  //  Ny version
  $filDATA= ImportTabFile(realpath($_SERVER["DOCUMENT_ROOT"]). '/saldi-e/_exchange/_standard/formular-utf8.tab');   //  Gl version
  $dx= 0;   $graftype= 1;   $txttype= 2;    $varetype= 3;   
  $html_buff= '<!DOCTYPE html><html lang="da" dir="ltr"> <head>  <meta charset="UTF-8">  <title>'.tolk('@Udskrifts-side').'</title>'.
              '<style type="text/css"> @page { size:'.$pagewidth.'mm '.$pageheight.'mm; margin:0mm 0mm 0mm 0mm; } </style> </head><body>';
  #maindivname{position:relative;}
  
  echo '<fieldset id="printpage" style="border: 1px solid #8c8b8b; padding:2px; width:'.$pagewidth.'mm; height:'.$pageheight.'mm; margin: auto; margin-bottom:20px;'.
   ' position:relative; background:white;  cursor:crosshair;"> <legend><tc><b>'.tolk('@Papir: A4-Portrait').'</b></tc></legend>';
  if ($vistools==true) {
    akser($pagewidth, $pageheight);
    echo '<div id="showinfo" style="position: relative;" >Pos. X,Y:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;?,?&nbsp;mm; </div>'; //  X:Y-pos:  &nbsp;  ?:?
    echo '<div id="showkoor" style="position: relative;" >Klik-Pos. X,Y:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;?,?&nbsp;mm </div>'; //  X,Y-pos:  &nbsp;  ?,?
  }
  echo '<script>';     //  https://stackoverflow.com/questions/7790725/javascript-track-mouse-position
  echo 'var offset = $("#printpage").offset();';
// Vis XY-position:
  echo "var showinfo = document.getElementById('showinfo');";  //  Knyt til objektet showinfo
  echo "function tellPos(p){ showinfo.innerHTML = 'Pos. X: ' + Math.round((p.pageX  - offset.left)/3.8 ) + ' , Y:' + Math.round((p.pageY - offset.top)/3.8) + ' mm ';}";
  echo "addEventListener('mousemove', tellPos, false); ";   //  Rapporter mouse-pos til function tellPos
// Gem klik-position:
  echo "var showkoor = document.getElementById('showkoor');";  //  Knyt til objektet showkoor
  echo "function savePos(p){ showkoor.innerHTML = 'Klik X,Y: ' + Math.round((p.pageX  - offset.left)/3.8 ) + ',' + Math.round((p.pageY - offset.top)/3.8) + ' mm';}";
  echo "addEventListener('click', savePos, false); ";   //  Rapporter mouse-pos til function tellPos
  echo '</script>';
 // element.attachEvent('onclick', function() { /* do stuff here*/ });
 
  foreach ($filDATA as $rec) // 1. gennemløb - find data for Ordrelinier
    {if ($rec[2]=='generelt') {$antal= $rec[4];   $toplin=297-$rec[5];  $afst= $rec[6];} }
/* 
Fremtidig Filstruktur:  
version 3.x               version 5.+
$rec[0]; '$formular'    | $rec[0]; - Formular kode [0..13..]
$rec[1]; '$art'         | $rec[1]; - Formular art kode[0..3]: 0= Layout   1= Grafik     2= Blanket-tekster    3=  Tekster - Ordrelinier
              $rec[13]  | $rec[2]; - Side-kode: A !A S !S [:string]
$rec[2]; '$beskrivelse' | $rec[3]; - "Beskrivelse" - Tekstindhold i feltet  [:string]
$rec[3]; '$just'        | $rec[4]; - Justering af/i feltet: V=venste, C=centreret, H=højre [:string]
$rec[4]; '$xa'   (abs)  | $rec[5]; - X0= Feltets indsætningskoordinat   (abs)  [:mm] målt fra venstre side-kant {3.x: Ordrelinie antal}
$rec[5]; '$ya'   (abs)  | $rec[6]; - Y0= Feltets indsætningskoordinat   (abs)  [:mm] målt fra side-top          {3.x: Ordrelinie placering af 1. linie}
$rec[6]; '$xb'   (abs)  | $rec[7]; - Feltets bredde (linie længde)      (rel)  [:mm]                            {3.x: Ordrelinie afstand}
$rec[7]; '$yb'   (abs)  | $rec[8]; - Feltets højde  (linie højde)       (rel)  [:mm] 
$rec[8]; '$wh'          | $rec[9]; - Objektets dimension (streg-bredde, font-højde) [:px]
$rec[9]; '$colr'        | $rec[10];- Objektets farve kode [:string]
$rec[10];'$font'        | $rec[11];- Objektes font-family [:string] 
$rec[11];'$fed'         | $rec[12];- Objektes øvrig font-style i css-format (bold/italic/small/big) [:string]
$rec[12];'$kurs'	      | $rec[13];- Grafik-link [:string] i css-format f.eks: "../_assets/images/saldi-e50x170.png" alt="The logoimg"
$rec[13];'$side'        | $rec[14];- Sekunder "Beskrivelse" (på fremmedsprog) [:string] (default: @+Beskrivelse, som kan anvendes som sprog-key)
$rec[14];'$sprog'       | $rec[15];- Note til objektet
 */
  function StrFelt ($str) { return "'".$str."'".chr(9);}
  function DatFelt ($dat) { return $dat.chr(9);}
#Eksporter til nyt ver 5.0 fil-format:
  $fp= null;  //  fopen(realpath($_SERVER["DOCUMENT_ROOT"]).'/saldi-e/_exchange/_standard/formularer.v50.tab',"w"); //  /saldi-e/_exchange/_standard/formular-utf8.tab
  if ($fp) {  //  exporter gl.format til ver5.0 format
    fwrite($fp,':Form'.chr(9).'Art'.chr(9).'Side'.chr(9).'Beskr'.chr(9).'Just'.chr(9).'X0'.chr(9).'Y0'.chr(9).'dx'.chr(9).'dy'.chr(9).
                'Hgt'.chr(9).'Wdt'.chr(9).'Colr'.chr(9).'Font'.chr(9).'Style'.chr(9).'Src'.chr(9).'Key'.chr(9).'Note'."\n");
    foreach ($filDATA as $rec) {
      if ($rec[13]=='') $rec[13]= 'A';
      if ($rec[2]=='LOGO') $src= 'src="../_assets/images/saldi-e50x170.png" alt="The logoimg" '; else $src= '';
      $style = '';  //  'font-weight:normal; ';
      $beskriv= utf8_decode ($rec[2]);
      $dx= abs($rec[4]-$rec[6]);
      $dy= abs($rec[5]-$rec[7]);
      if ($rec[10]=='Helvetica') $font= 'font-family: Helvetica ';
      if ($rec[10]=='Times') $font= 'font-family: Times ';
      if ($rec[11]=='on') $style.= 'font-weight:bold; ';
      if ($rec[12]=='on') $style.= 'font-style:italic; ';
      if ($rec[1]=='1') { $font= ''; $style = ''; }
      if ($rec[1]!='2') $note= 'Note:'; else $note= '';
      if (($rec[1]=='3') and ($rec[2]=='generelt')) {$beskriv='A4-portrait'; $rec[1]= '0'; $note= tolk('@Note: Side-layout, samt fælles-data for ordrelinier'); $rec[2]= 'A4-portrait'; $font= ''; $style = '';
                                                      $rec[6]= $rec[6]+$rec[4];  $rec[7]= $rec[7]+$rec[5]; // Skal ikke gøres relative!
                                                     // $antallin= 'Antal Ordrelinier: '.$rec[4]; 
                                                     // $firstline= 'Y-Placering af første Ordrelinie: '.$rec[5];
                                                     // $lineheight= 'Ordrelinie afstand: '.$rec[6];
                                                    }
      if (($rec[1]=='3') and ($rec[2]!='generelt')) $beskriv= '£'.$beskriv;
      $line=  StrFelt($rec[0]).       # $rec[0]; - Formular kode [0..13..]
              StrFelt($rec[1]).       # $rec[1]; - Formular art kode[0..3]: 0= Layout   1= Grafik   2= Blanket-tekster    3=  Tekster - Ordrelinier
              StrFelt($rec[13]).      # $rec[2]; - Side-kode: A !A S !S [:string]
              StrFelt($beskriv).      # $rec[3]; - "Beskrivelse" - Tekstindhold i feltet  [:string]
              StrFelt($rec[3]).       # $rec[4]; - Justering af/i feltet: V=venste, C=centreret, H=højre [:string]
              DatFelt($rec[4]).       # $rec[5]; - X0= Feltets indsætningskoordinat   (abs)  [:mm] målt fra venstre side-kant
              DatFelt(297-$rec[5]).   # $rec[6]; - Y0= Feltets indsætningskoordinat   (abs)  [:mm] målt fra side-top
              DatFelt($dx).           # $rec[7]; - Feltets bredde (linie længde)      (rel)  [:mm] (dx)
              DatFelt($dy).           # $rec[8]; - Feltets højde  (linie højde)       (rel)  [:mm] (dy)
              DatFelt($rec[8]).       # $rec[9]; - Objektets dimension (streg-bredde, font-højde) [:px]
              StrFelt($rec[9]).       # $rec[10];- Objektets farve kode [:string]
              StrFelt(trim(substr($font,13))).  # $rec[11];- Objektes font [:string]   'font-family: Helvetica, Arial, Times, sans-serif; uden prefix: font-family:'
              StrFelt(trim(substr($style,12))). # $rec[12];- Objektes øvrig style i css-format (bold/italic/small/big) [:string]          uden prefix: font-weight:'
              StrFelt($src).          # $rec[13];- Grafik-link [:string] i css-format f.eks: "../_assets/images/saldi-e50x170.png" alt="The logoimg"
              StrFelt('@'.$beskriv).  # $rec[14];- Sekunder "Beskrivelse" (på fremmedsprog) [:string] (default: @+Beskrivelse, som kan anvendes som sprog-key)
              StrFelt($note).         # $rec[15];- Note til objektet
                            "\n";
      fwrite($fp,$line);
    } fclose($fp);  }
  
  foreach ($filDATA as $rec) // 2. gennemløb - udtegn data
    { $frm= $rec[0];  $art= $rec[1];  $beskriv= $rec[2];  $just= $rec[3]; $xa= $rec[4]; $ya= 297-$rec[5]; $xb= $rec[6]; $yb= 297-$rec[7]; 
        $wh=$rec[8];  $colr= $rec[9];  $fnt=$rec[10];  $fed=$rec[11];  $kurs=$rec[12];  $side= $rec[13];
      if ($side=='') $side= 'A';
      if ($colr==0) $colr= 'black';
// Grafik:
    if (($frm==$blanket) and (($side==$sidetype) or ($side=='S')) and ($art==$graftype)) {
      // { if ($yb>$ya) $h=$yb-$ya; else $h=$ya-$yb;
        // if ($xb>$xa) $b=$xb-$xa; else $b=$xa-$xb;
//  Omberegn absolutte til relative koordinater:
        if ($xb>$xa) $b=$xb-$xa; else $b=$xa-$xb;
        $grafy= $ya;
        if ($yb>$ya) {$tmp=$ya; $ya=$yb; $yb=$tmp;}
        if ($yb>$ya) $h=$yb-$ya; else $h=$ya-$yb;
        if ($wh>0) linefelt($x=$xa, $y=$ya,    $h,    $b, $colr='gray'); // Linier (=rektangler med ramme)
        if ($wh<1) graffelt($x=$xa, $y=$grafy, $h=50, $b=170,$img= 'src="../_assets/images/saldi-e50x170.png" alt="The logoimg" '); // Grafik
      }
// Tekster:
    if (($frm==$blanket) and (($side==$sidetype) or ($side=='S')) and (($art==$txttype) or ($art==$varetype))) {
        $feltw= +1.4*strlen($beskriv)+0.8*$wh; 
        $style= '';    $font= '';  $px= $wh;
        if ($fnt  =='Helvetica')  {$font.= 'Helvetica; ';}  else {$font.= 'Times; ';}
        if ($wh >0)       {$style.= 'font:'.$px.'px '.$font;}
        if ($just =='V')  {$style.= 'text-align:left; ';   $dx= 0;}
        if ($just =='C')  {$style.= 'text-align:center; '; $dx= $feltw/2;}
        if ($just =='H')  {$style.= 'text-align:right; ';  $dx= $feltw;}
        if ($colr>'')     {$style.= 'color:'.$colr.'; ';}   // Color! <font color="red">  <font color="color_name|hex_number|rgb(_number)">
        if ($fed =='on')  {$style.= 'font-weight:bold; ';}  else {$style.= 'font-weight:normal; ';}
        if ($kurs=='on')  {$style.= 'font-style:italic; ';} else {$style.= 'font-style:normal; ';}
        $beskriv= utf8_decode($beskriv);
        if (($beskriv=='generelt') or ($beskriv=='GEBYR') or ($beskriv==':GEBYR')) {} // udskrives ikke. Flag ang. gebyrberegning.
        else if ($art==$varetype)  //  Ordrelinier
          for ($i = 0; $i < $antal; $i++) 
            { textfelt($xa-$dx,$toplin+$i*$afst, $wh/3.5,$feltw, '£'.$beskriv, $style,true,$i==0,true);                       //  1. Ordrelinie
              if ($i==0) textfelt($xa-$dx,$toplin+$i*$afst, $wh/3.5,$feltw, '_', $style.' color:red;',true,$vistools,false);  //  Vis indsætningspunkt
            }
        else {textfelt($xa-$dx,$ya, $wh/3.0,$feltw, $beskriv, $style,true,$vistools);
              textfelt($xa-$dx,$ya, $wh/3.0,$feltw, '_',      $style.' color:red;',true,$vistools,false);  //  Vis indsætningspunkt
        }
    }}  //        x             y                     h         b           Tekst               style
// Demo-TEKSTER:
  // textfelt( 10, 10,  8,190,tolk('@Her demonstreres nogle muligheder, der er til rådighed.'),'text-align:center; font-weight:bold; font:25px times;',true);
  // textfelt( 28, 80,  3,160,'Felt2','font:10px times;');
  textfelt( 80, 160,  0, 40,'<u>FeltA</u> x:80, y:160', 'font-weight:bold; color:Tomato; font:8px times; ',true,'',false);
  textfelt(100, 160,  0, 40,'<u>FeltB</u> x:100, y:160','font-weight:bold; color:blue;   font:16px times;',true,'',false);
  textfelt( 75, 170,  3, 60,'Tekst-Data felters indsætningspunkt vises med rødt <red style="color:red;">_</red> <br>Y-værdier måles fra dokument-top til teksters grundlinie, så ændring af skrift-højde, '.
                            'ikke får tekster til at "hoppe"<br>Tillades fler-linier med style="white-space:pre-wrap;", skal man være klar over at feltet vokser opad hvis $h=0, så det er sidste linie, '.
                            'der er placeret på Y-værdien! Angives derimod $h=3 (linie-højde) fortsætter teksten derimod nedad, til højere Y-værdier.','font:10px times; white-space:pre-wrap; ',true,'',false);
  textfelt( 70, 100,  0, 60,tolk('@KOPI'),'text-align:center; font-weight:bold; color:red; font:60px times; transform: rotate(-35deg);',true,'',true); //   
  // textfelt( 11,120,  4,150,'Felt3','font-style:italic;');
  // textfelt(  5,160,  4,200,'Felt4','text-align:right; transform: rotate(20deg);');
  //  textfelt(-55,180, 10,120,tolk('@Lodret tekst. Rotations-centrum er på objektets center, hvilket betyder at indsætningspunktet skal korrigeres!'),'transform: rotate(-90deg);',true,'',false);
  // textfelt(  0, 40, 40,210+1,'HEADER-område:','font:12px times; border: 0.9px solid #00efef; ',false,'',false);
  // textfelt(  1, 42,205,210,'BODY-område:','font:12px times;');
  // textfelt(  0,297, 50,210+1,'FOOTER-område:','font:12px times; border: 0.9px solid #00efef; ',false,'',false);
  echo '</fieldset>';
  htm_lf();
  $html_buff.= '</body> </html>';
  $fp= fopen("../_temp/printside.htm","w");    if ($fp) { fwrite($fp,$html_buff."\n"); fclose($fp); };  
  textKnap($label='@Se udskrift',  $title='@Se hvad der kan udskrives med CTRL-p', $link='../_temp/printside.htm');
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='@Gem eller opdater',$akey='g');
  //  Ved udskrivning skjules body-elementer omkring A4-papir. Se mere i out_style.css.php stikord: @media print (er ikke testet!)
}
 
######### :SYSTEM:
// Denne funktion benyttes ikke!  Panl_PrintlayoutTXT er bedre kvalitet.
# Kaldes fra:  [_base/page_Startup.php] 
function Panl_Printlayout($filDATA=[],$width=210, $height=297) {    ## out_PanlsSekd.php
//  Grafisk-baseret, virker meget uldent i kanterne!
  function felt($x='', $y='', $h='', $b='', $txt='', $style='',$clean=false,$px='') {  $scale= 1100/297;
    if ($clean) {$bordpx='1';} else {$bordpx='1';}
    $x= $x*$scale;    $y= $y*$scale;    $h= -$h*$scale;    $b= $b*$scale;
    $sty= 'ctx.textAlign="left";';   $fac='';
    dvl_pretty('felt');
    if (strpos($style,'left')>0)    {$sty.= 'ctx.textAlign="left"; ';}
    if (strpos($style,'center')>0)  {$sty.= 'ctx.textAlign="center";';}
    if (strpos($style,'right')>0)   {$sty.= 'ctx.textAlign="right"; ';}
    //  ctx.font = "Bold Italic " + myText.fontSize + "px Arial " + myText["font-family"];
    if (strpos($style,'bold')>0)    {$fac.= 'bold ';}
    if (strpos($style,'italic')>0)  {$fac.= 'italic ';}
    if (!$clean) 
      echo 'ctx.strokeStyle = "#eeeeee"; ctx.strokeRect('.$x.', '.$y.', '.$b.', '.$h.');';
    echo 'ctx.font = "'.$fac.' '.$px.'px sans-serif";  '.$sty.'   ctx.fillText("'.$txt.'", '.$x.', '.$y.'); ';
    //  ctx.textAlign="start";    ctx.fillText("textAlign=start",150,60);   ctx.textAlign="end";

  };
  function grafik_start($width=800, $height=1100) { 
    /* https://www.w3schools.com/tags/ref_canvas.asp */
    echo '<img id="logoimg" style="width:0; height:0; visibility:hidden" src="../_assets/images/saldi-e50x170.png" alt="The logoimg">'; // Udtegnes i canvas!
    echo '<canvas id="myCanvas" width="'.$width.'px" height="'.$height.'px" style="border:1px solid #d3d3d3; background:white; margin-left: 60px; margin-bottom:20px;">';
    echo '<script>';
    echo 'var c = document.getElementById("myCanvas");';
    echo 'var ctx = c.getContext("2d");';
  }
  function grafik_slut() {
    //  echo 'ctx.stroke();';
    echo '</script>';
  }
#+   if (isset($_POST['submit']) && $_POST['submit']) {
     $blanket=  $_POST['blanket'];
     $sidetype= $_POST['sidetype'];
#+   } else $blanket= 3;
   if ($width<=220) $panel= 'panelW960'; else $panel= 'panelW120';
  htm_Panl_Top($name= 'print',$capt= '@Udskrivnings-Layout: DEMO',$parms='#',$icon='fas fa-print',$panel,__FUNCTION__);
  htm_FrstFelt('25%');
    htm_OptioFlt($type='text',  $name='blanket',   $valu= $blanket, 
                    $labl='@Formular',    $titl='@Vælg en Formular som du vil vise',  
                    $revi=true, $optlist= FRM_Liste(),    $action='');
  htm_NextFelt('25%');
    htm_OptioFlt($type='text',  $name='sidetype',   $valu= $sidetype, //='A', 
                    $labl='@Side-layout',    $titl='@Her vælger du visning af udskrifts-side.',  
                    $revi=true, $optlist= [['Første sides layout','F','Første'],['Alle sider','A','Alle'],['Sidste sides layout','S','Sidste']],    $action='');
  htm_NextFelt('50%'); 
    htm_Plaintxt('Opdater med genvejstast: g');
#+    textKnap($label='@Vis/opdater',  $title='@Opdater her hvis du har ændret formular eller side.', $link='#','o');    //  page_Printlayout.php
  htm_LastFelt('');    

  $filDATA= ImportTabFile(realpath($_SERVER["DOCUMENT_ROOT"]). '/saldi-e/_exchange/_standard/formular-utf8.tab');
  $dx= 0;   $graftype= 1;   $txttype= 2;    $varetype= 3;   $x0= 8;   $y0= 6; 
  
  grafik_start($width=800, $height=1100);
  foreach ($filDATA as $rec)  // 3. gennemløb kan måske kombineres med 1.
  { $frm= $rec[0];  $art= $rec[1];  $beskriv= $rec[2];
    if ($beskriv=='generelt') {$toplin=$rec[5]; $antal= $rec[4]; $afst= $rec[6];}  //  Skal benyttes ved Ordrelinier
    if (($frm==$blanket) and ($art==$graftype) and ($rec[12]=$sidetype))
    { $scale= 1100/297; $ybase= 297*$scale;   $wdt=-1;
      $xa= $x0+$rec[4]*$scale;  $ya= $y0+$ybase-$rec[5]*$scale;  $xb= $x0+$rec[6]*$scale;  $yb= $y0+$ybase-$rec[7]*$scale;  $wdt= $rec[8]*$scale/2; $colr= $rec[9];
      if (($wdt==0) and ($rec[2]=='LOGO'))
        echo 'var img=document.getElementById("logoimg");   ctx.drawImage(img,'.$xa.','.$ya.');'; 
      else  
        if ($wdt=1) echo 'ctx.beginPath(); ctx.moveTo('.$xa.','.$ya.'); ctx.lineTo('.$xb.','.$yb.'); ctx.stroke();';
   }}
   
  foreach ($filDATA as $rec)  // 2. gennemløb
  { $frm= $rec[0];  $art= $rec[1];  $beskriv= $rec[2];
    if (($frm==$blanket) and (($art==$txt) or ($art==$varetype)) and ($rec[12]=$sidetype))
    { $feltw= 1.7*strlen($beskriv)+2*$rec[ 8]; 
      $style= '';      $px= $rec[8];
      if ($rec[10]=='Helvetica')  {$font.= 'Helvetica; ';}  else {$font.= 'Times; ';}
      if ($rec[ 8]>0)       {$style.= 'font:'.$px.'px '.$font;}
      if ($rec[ 3]=='H')    {$style.= 'text-align:right; ';  $dx= $feltw;}
      if ($rec[ 3]=='C')    {$style.= 'text-align:center; '; $dx= $feltw/2;}
      if ($rec[ 3]=='V')    {$style.= 'text-align:left; ';   $dx= 0;}
      // Color!
      $colr= $rec[9];
      if ($rec[11]=='on')  {$style.= 'font-weight:bold; ';}  else {$style.= 'font-weight:normal; ';}
      if ($rec[12]=='on')  {$style.= 'font-style:italic; ';} else {$style.= 'font-style:normal; ';}
      $beskriv= utf8_decode($rec[ 2]);
      $dx= 0;
      if (($beskriv=='generelt') or ($beskriv=='GEBYR')) {} // udskrives ikke. Flag ang. gebyrberegning.
      else if ($art==$varetype)  //  Ordrelinier
        for ($x = 0; $x < $antal; $x++) 
           felt($rec[4]-$dx,297-$toplin+$x*$afst, $rec[8]/3.5,$rec[7]+$feltw, '£'.$beskriv, $style,true,$px);
      else felt($rec[4]-$dx,297-$rec[5],          $rec[8]/3.0,$rec[7]+$feltw,     $beskriv, $style,true,$px);
    }}  //        x             y                     h         b           Tekst               style
    
  grafik_slut();

  // echo '<fieldset id="printpage" style="border: 1px solid #8c8b8b; padding:2px; width:'.$width.'mm; height:'.$height.'mm; margin: auto; margin-bottom:20px;'.
  // ' position:relative; background:white;"> <legend><tc><b>'.tolk('@Papir: A4-Portrait').'</b></tc></legend>';

/*   foreach ($filDATA as $rec) // 1. gennemløb - find Ordrelinier
    {if ($beskriv=='generelt') {$toplin=$rec[5]; $antal= $rec[4]; $afst= $rec[6];} }
 */  
/* foreach ($filDATA as $rec)  // 2. gennemløb
  { $frm= $rec[0];  $art= $rec[1];  $beskriv= $rec[2];
    if (($frm==$blanket) and (($art==$txttype) or ($art==$varetype)) and ($rec[12]=$sidetype))
    { $feltw= 1.7*strlen($beskriv)+2*$rec[ 8]; 
      $style= '';
      $px= $rec[8];
      if ($rec[10]=='Helvetica')  {$font.= 'Helvetica; ';}  else {$font.= 'Times; ';}
      if ($rec[ 8]>0)       {$style.= 'font:'.$px.'px '.$font;}
      if ($rec[ 3]=='H')    {$style.= 'text-align:right; ';  $dx= $feltw;}
      if ($rec[ 3]=='C')    {$style.= 'text-align:center; '; $dx= $feltw/2;}
      if ($rec[ 3]=='V')    {$style.= 'text-align:left; ';   $dx= 0;}
      // Color!
      $colr= $rec[9];
      if ($rec[11]=='on')  {$style.= 'font-weight:bold; ';}  else {$style.= 'font-weight:normal; ';}
      if ($rec[12]=='on')  {$style.= 'font-style:italic; ';} else {$style.= 'font-style:normal; ';}
      $rec[ 2]= utf8_decode($rec[ 2]);
      if (($rec[ 2]=='generelt') or ($rec[ 2]=='GEBYR')) {} // udskrives ikke. Flag ang. gebyrberegning.
      else if ($art==$varetype)  //  Ordrelinier
        for ($x = 0; $x < $antal; $x++) 
           felt($rec[4]-$dx,297-$toplin+$x*$afst, $rec[8]/3.5,$rec[7]+$feltw, '£'.trim($beskriv,"'"),$style,true);
      else felt($rec[4]-$dx,297-$rec[5],          $rec[8]/3.0,$rec[7]+$feltw,     trim($beskriv,"'"),$style,true);
    }}  //        x             y                     h         b           Tekst               style
//TEKSTER:
/*   felt( 10, 10,  8,190,tolk('@Her demonstreres nogle muligheder, der er til rådighed.'),'text-align:center; font-weight:bold; font:25px times;',true);
  felt( 28, 80,  3,160,'Felt2','font:10px times;');
  felt( 20, 30,  5,175,'Felt1','font-weight:bold; color:Tomato;');
  felt( 11,120,  4,150,'Felt3','font-style:italic;');
  felt(  5,160,  4,200,'Felt4','text-align:right; transform: rotate(20deg);');
  felt(-55,180, 10,120,tolk('@Lodret tekst. Rotations-centrum er på objektets center, hvilket betyder at indsætningspunktet skal korrigeres!'),'transform: rotate(-90deg);',true);
  felt(  1,  0, 40,210,'HEADER-område:','font:12px times;');
  felt(  1, 42,205,210,'BODY-område:','font:12px times;');
  felt(  1,250, 40,210,'FOOTER-område:','font:12px times;');
 */  
//GRAFIK:
  /* https://www.w3schools.com/tags/ref_canvas.asp */
/* 
  echo '<img id="logoimg" style="width:0; height:0; visibility:hidden" src="../_assets/images/saldi-e50x170.png" alt="The logoimg">'; // Udtegnes i canvas!
  echo '<canvas id="myCanvas" width="800px" height="1100px" style="border:1px solid #d3d3d3;">';
  echo '<script>';
  echo 'var c = document.getElementById("myCanvas");';
  echo 'var ctx = c.getContext("2d");';
  echo 'ctx.beginPath();';
  echo 'ctx.moveTo(20, 20);';
  echo 'ctx.lineTo(20, 100);';
//  echo 'ctx.arcTo(150,20,150,70,50)';   //  Tangerende Bue - saboterer udtegning!
  echo 'ctx.lineTo(200, 220);';
  echo 'ctx.stroke();';
  echo 'ctx.beginPath();  ctx.arc(300,375,50,0,2*Math.PI); ctx.stroke();';            //  Circle
  echo 'var img=document.getElementById("logoimg");    ctx.drawImage(img,200,200);';  //  Billede: Skjult indlæsning af logoimg ovenfor i <img erklæring
  echo '</script>';
 */
//  echo '</fieldset>';
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='@Gem eller opdater',$akey='g');
  //  Ved udskrivning skjules body-elementer omkring A4-papir. Se mere i out_style.css.php stikord: @media print (er ikke testet!)
}
 
 
######### :SYSTEM:
# Kaldes fra:  [_system/page_Licens.php] 
function Panl_Omprogram()   ## out_PanlsSekd.php
{ global $ØProgTitl, $Øprogvers, $DocRev, $Øcopydate, $Øcopyright, $Ødesigner;
  htm_Panl_Top($name= 'omprog',$capt= '@Om SALDI-<small>€</small>:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW480',__FUNCTION__);
  htm_Caption('@Status:');                   htm_nl();
  echo tolk('@Programmet er en videreudvikling af SALDI - det frie, danske økonomisystem, fra Danosoft / saldi.dk.').str_nl(2);
  echo '<i>';
  echo tolk('@Dette program er fri software, som du kan videredistribuere').str_nl(1);
  echo tolk('@og/eller ændre under vilkårene i GNU General Public License,').str_nl(1);
  echo tolk('@som de er offentliggjort af Free Software Foundation;').str_nl(1);
  echo tolk('@enten i licensens version 2 eller enhver senere version.').str_nl(2);
  echo '</i>';
  echo tolk('@Programmet er stadig i udviklings fase....').str_nl(2);
  
  htm_Caption('@TEST udgave af SALDI-€:');  htm_nl();
  echo tolk('@Dette er seneste udviklingsversion.').str_nl(1);
  echo tolk('@Der vil derfor forekomme midlertidige fejl.').str_nl(1);
  echo tolk('@Endvidere vil oversættelsen af fremmed sprog, ikke være ajour.').str_nl(2);
  echo tolk('@Databasen er kun delvist i drift, hvorfor nogle data importeres fra tekstfiler.').' ';
  echo tolk('@Tekst import tager tid, inden data kan vises...'). str_nl(2);
  //  htm_Caption('@Kendte problemer:');  htm_nl();
  //  echo tolk('@Når der er flere tabeller på en side, er der uløste problemer på dem efter den første.'). str_nl(3);

  htm_hr();
  htm_Caption('@Teknik:');  htm_nl();
  echo $ØProgTitl.' - Version '.$Øprogvers.' Dato: '.$GLOBALS['DocNew'].' './* .' - Copyright '.  $Øcopydate.' '.$Øcopyright.' - ' */ tolk('@Design: ').$Ødesigner.'<br>';
  //$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER['HTTP_HOST']";  //  $_SERVER[REQUEST_URI]
  $actual_link = $_SERVER['REQUEST_URI'];
  echo tolk('@Server URL: ').$actual_link;    htm_nl();
  //  Dato/$DocNew fra nyest indlæste include som kalder DocAlder() i out_init.php
  echo tolk('@PHP-version: ').phpversion().' ';                htm_nl();

//$Ødb_Link= dbi_connect('localhost','SaldiAdm','SaldiPas','saldi_prog');
  if (phpversion()!='7.2.8')
    echo tolk('@Database-version: ').mysqli_get_server_info(dbi_connect('localhost','SaldiAdm','SaldiPas','saldi_prog'));   
    echo tolk('@Database-version: ').mysqli_get_server_info(dbi_connect('mysql46.unoeuro.com','ev_soft_dk','M4d73anU8j','ev_soft_dk_db3'));   
  htm_nl();
  echo tolk('@Zend engine version: ') . zend_version();        htm_nl();
  echo tolk('@Apache-version: ').$_SERVER['SERVER_SOFTWARE'];  htm_nl();  //  apache_get_version()
  htm_PanlBund($pmpt='@Gem',$subm=false,$title='@Gem eller opdater',$akey='g');
  //  Ved udskrivning skjules body-elementer omkring A4-papir. Se mere i out_style.css.php stikord: @media print (er ikke testet!)
  
  // var_dump(stream_get_wrappers());
  // phpinfo();  #! Benyttes KUN til fejlfinding! 
  // PHP extension=php_openssl.dll er nødvendig for CVR-opslag
}
 
function Panl_Omregnskab() {global $Øbrugernavn, $regnskab, $regnaar, $db_navn;
  htm_Panl_Top($name= 'omregn',$capt= '@Om regnskabet:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW480',__FUNCTION__);
  htm_Caption('@Aktuelle oplysninger:');                            htm_nl();
  echo tolk('@Du er logget på som bruger:').' '.$Øbrugernavn;       htm_nl(2);
  echo tolk('@Du arbejder på regnskabet:').' '.$regnskab;           htm_nl();
  echo tolk('@og data angår regnskabsåret:').' '.$regnaar;          htm_nl(2);
  echo tolk('@Regnskabet befinder sig i databasen:').' '.$db_navn;  htm_nl(2);
  htm_PanlBund($pmpt='@Gem',$subm=false,$title='@Gem eller opdater',$akey='g');
}
 
######### :SYSTEM:
# Kaldes fra:  [_base/page_Tips.php] 
function Panl_TipsBrug()   ## out_PanlsSekd.php
{
  htm_Panl_Top($name= 'tips',$capt= '@Tips til brugeren:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW480',__FUNCTION__);
  htm_Caption('@TIPS:');                   htm_nl();
  echo tolk('Hvis du klikker med musens højre-tast på navigations knapper eller links-tekster, får du mulighed for at åbne linket i et nyt vindue eller fane, uden at lukke det vindue du er i.').str_nl(2);
  
  htm_Caption('@NAVIGERING i tabeller:');  htm_nl();
  echo ' <data-colrlabl>'.tolk('@Tab-tast').'</data-colrlabl> '.
    tolk('@springer til næste felt.').' <data-colrlabl>'.tolk('@SHIFT Tab-tast').'</data-colrlabl> '.tolk('@springer til forrige felt.').
    '  <data-colrlabl>'.tolk('@CTRL Pil-taster').'</data-colrlabl> '.tolk('@virker måske. ').str_nl(2);
  
  htm_Caption('@SORTERING af tabeller:'); htm_nl();
  echo  tolk('@De tabeller som kun viser data, (ingen redigering) kan du sortere.').str_nl(1);
  echo  tolk('@Du gør det ved at klikke på kolonne overskriften.').str_nl(1);
  //echo  tolk('@Det er kun muligt at sortere på en kolonne ad gangen.').str_nl(2);
  
  htm_Caption('@SØGNING i et vindue:');   htm_nl();
  echo  tolk('@Alle browsere har en søgefunktion, som ofte aktiveres med CTRL&nbsp;+&nbsp;F').str_nl(1);
  echo  tolk('@Med denne kan du finde tekster, selv om de ikke er på den synlige del af vinduet.').str_nl(2);
  
  htm_Caption('@VINDUER:');               htm_nl();
  echo  tolk('@I de fleste nyere browsere kan du:').str_nl(1);
  echo  tolk('@Skifte fuldskærms mode: F11, og udnytte hele skærmens størrelse.').str_nl(1);
  echo  tolk('@Har du svært ved at læse på skærmen, kan du benytte Zoom:').str_nl(1);
  echo  tolk('@Zoom ind/ud: CTRL&nbsp;+&nbsp;/CTRL&nbsp;-&nbsp;').'&nbsp;';
  echo  tolk('@eller med CTRL-musrulleknap').str_nl(1);
  echo  tolk('@CTRL&nbsp;0 nulstiller zoom til 100%').str_nl(2);
  
  htm_Caption('@PANELER:');               htm_nl();
  echo  tolk('@I vinduer, vises data grupperet i paneler:').str_nl(1);
  echo  tolk('@I toppen af panelerne vises 2 symboler yderst til højre.').str_nl(1);
  echo  tolk('@Klikkes på disse, kan du minimere/maksimere visning af indhold af alle paneler.').'&nbsp;';
  echo  tolk('@Klikker du på panel-toppens venstre halvdel, kan du minimere/maksimere visning af indhold af det aktuelle panel.').str_nl(2);
  
  htm_Caption('@Hjælpe tekster:');        htm_nl();
  echo  tolk('@Tekster i felter med skygge (også andre!), indeholder nyttig hjælp.').str_nl(1);
  echo  tolk('@Når du holder musen over disse tekster, vises PopUp med tips.').str_nl(2);
  echo  tolk('@Benytter du trykfølsom skærm uden mus, skal du benytte Chrome browseren, for at få hjælpetekster:'). str_nl();
  echo  tolk('@´Hvil´ fingeren eller musen over teksten med skygge, så popper hjælpetekster op.'). str_nl(2);

  htm_Caption('@Dato-format:');           htm_nl();
  echo  tolk('@Benytter du en browser, der understøtter date-picker, benyttes et dato-format,').' ';
  echo  tolk('@som er bestemt af operativsystemet (Windows/Linux).').str_nl(1);
  echo  tolk('@Hvis du vil ændre dette, skal du derfor indstille det i "Windows-Kontrolpanel-Formater-Dato" '). str_nl(2);
  
  htm_Caption('@Tast-genveje:');          htm_nl();
  echo  tolk('@Er der en brugbar genvejstast for en knap, er den angivet efter knap-teksten med skråskrift.').' ';
  echo  tolk('@Du benytter den ved at taste [Alt]+tast eller [Alt]+[Shift]+tast i de fleste browsere (Kan være deaktiveret!)'). str_nl(2);
/*   Internet Explorer	[Alt] + accesskey	N/A	
Chrome	[Alt] + accesskey	[Alt] + accesskey	[Control] [Alt] + accesskey
Firefox	[Alt] [Shift] + accesskey	[Alt] [Shift] + accesskey	[Control] [Alt] + accesskey
Safari	[Alt] + accesskey
 */
  
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Retur til hovedmenu');
}
 
 
######### :SYSTEM:
# Kaldes fra:  [_base/page_GruppeInfo.php] 
function Panl_GruppeBrug() {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'tips',$capt= '@Tips til bogholderen:',$parms='#',$icon='fas fa-pen-square','panelW480',__FUNCTION__);
  htm_Caption('@Info om grupper:');         htm_nl();
  echo  tolk('@En gruppe er nogle poster, som har nogle fælles data.').str_nl(2);
  echo  tolk('@Der kan f.eks. være tale om rabatter, varer, debitorer, kreditorer...').str_nl(1);
  echo  tolk('@Inden for hver hoved-gruppe, kan der oprettes undergrupper.').str_nl(1);
  echo  tolk('@Er der oprettet grupper, simplificeres tilknytning af alle de ensartede data').str_nl(2);
  echo  tolk('@Her kommer yderligere forklaring... ').str_nl(1);
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Retur til hovedmenu');
}
 
  
######### :SYSTEM:
# Kaldes fra:  [_base/page_GruppeInfo.php] [_base/page_Tips.php] 
function Panl_TipsBogh()   ## out_PanlsSekd.php
{
  htm_Panl_Top($name= 'tips',$capt= '@Tips til bogholderen:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW480',__FUNCTION__);
  htm_Caption('@Regnskabs TIPS:');         htm_nl();
  echo  tolk('@Vent med bogføring, hvis du har udskrevet rykkergebyr... ').str_nl(1);
  echo  tolk('@Det gør det nemmere hvis du vil annullere gebyret.').str_nl(2);
  echo  tolk('@Husk bogføring, i forbindelse med momsafregning...').str_nl(1);
  echo  tolk('@Så er du mere sikker på, ikke at lave kludder i momsen.').str_nl(2);

  htm_Caption('@Sikring af data:');         htm_nl();
  echo  tolk('@Har du lige lavet mange tilføjelser/ændringer i regnskabet,').str_nl(1);
  echo  tolk('@så er det en god ide, at sikre dig dine data lokalt.').str_nl(1);
  echo  tolk('@Gå ind i menuen: System / Sikkerhedskopiering...').str_nl(2);
  //htm_Plaintxt('@TIP angående Beløbsrabat:');  htm_Plaintxt('@Angiv en mindre enhedspris, og 0% rabat, så beregnes en %-rabat svarende til pris-rabatten.');
  htm_Caption('@Rabatgivning:');         htm_nl();
  echo  tolk('@Vil du give beløbsrabat i stedet for %-rabat, så angiv en mindre enhedspris, og 0% rabat, ').str_nl(1);
  echo  tolk('@så beregnes en %-rabat svarende til beløbs-rabatten.').str_nl(2);
  htm_Caption('@Regnskabsår:');         htm_nl();
  echo  tolk('@Husk at der kan kun arbejdes i et regnskabsår ad gangen.').str_nl(1);
  echo  tolk('@Det aktive regnskabsår, indstiller du i:').str_nl(1);
  echo  tolk('@System / Indstillinger 1. / Regnskabsår / Regnskabskort,').str_nl(1);
  echo  tolk('@ved at sætte flueben i Bogføring tilladt.').str_nl(2);
  // https://da.wikipedia.org/wiki/Debet_og_kredit
  htm_Caption('@Begreber:');         htm_nl();
  echo  tolk('@Er du ikke dus med begreberne Debet og Kredit, ').str_nl(1);
  echo  tolk('@så finder du forklaring her: ').str_nl(1);
  echo  ('https://da.wikipedia.org/wiki/Debet_og_kredit').str_nl(2);
  htm_Caption('@Formater:');         htm_nl();
  echo  tolk('@Grundlæggende benytter programmet indstillingerne for data').str_nl(1);
  echo  tolk('@ og tal, de indstillinger, som er valgt i operativsystemet (og evt. browseren).').str_nl(1);
  echo  tolk('@Internt i programmet, gælder for tal: 123.456,78 (internationalt) og for dato: 2018-10-20 (ISO 8601)').str_nl(2);
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Retur til hovedmenu');
}
 
 
######### :SYSTEM:
# DEMO-MODUL;
# Kaldes fra:  [_base/page_News.php] 
function Panl_News() {global $ØlanguageTable, $ØProgTitl;  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'nyheder',$capt= '@Nyheder:',$parms='page_Blindgyden.php',$icon='fas fa-info','panelW960',__FUNCTION__,'','');
  echo '<div style="text-align:center; color:black; "><big><i>'.str_nl().
       tolk('@Her er nogle af de væsentligste nyheder i').' '.$ØProgTitl.'</i></big>'. str_nl(3);

  echo '<div style="text-align:center; color:red; ">'.tolk('@For BRUGEREN:').'</div>'. str_nl(1);
  echo tolk('@Program-betjening kan nu skifte mellem ialt 8 europæiske sprog.'). str_nl(1);
  echo tolk('@Navnet').$ØProgTitl.' '.tolk('@antyder, at det er en europæisk flersproglig version.'). str_nl(2);
  echo tolk('@Brugerfladen er blevet fuldstændigt redesignet.'). str_nl(2);
  echo tolk('@Designet er adaptivt, dvs. det tilpasser sig til smallere skærme.'). str_nl(1);
  echo tolk('@Da tabeller med mange kolonner, kræver en vis bredde, anbefales dog brug af bredere skærme omkring 1100 pixel brede.'). str_nl(2);
  echo tolk('@Alle sider vises nu med en menu-bjælke i toppen, så navigering er mere fleksibel.'). str_nl(2);
  echo tolk('@Data-visning er grupperet i mindre paneler, som nemt kan kombineres i andre sammenhænge.'). str_nl(1);
  echo tolk('@I toppen af hvert panel, findes et hjælpelink, som fører til udvidet hjælp i SALDI-DokuWiki, angående netop dette panels indhold.'). str_nl(1);
  echo tolk('@Paneler kan minimeres/maksimeres, ved at klikke på overskriften. Det kan øge overblikket, ved at skjule uaktuelle data.'). str_nl(2);
  echo tolk('@Cursoren skifter udseende, alt efter hvad musen holdes over, så man kan se, når der er en klik-funktion.'). str_nl(2);
  echo tolk('@Benyttes moderne browsere, benyttes en `date-picker` til dato-indtastninger, og der advares, når passwords indtastes på en usikker forbindelse.'). str_nl(1);
  echo tolk('@Date-picker er ikke tilgængelig i Internet Explorer, Safari og Opera Mini (Ultimo 2017).'). str_nl(2);
  echo tolk('@Formular-redigering, har fået mulighed for WYSIWYG design i LibreOffice, og der er tilføjet nye redskaber, til at vedligeholde layout.'). str_nl(1);
  echo tolk('@Formular-redigering har fået mulighed for at supplere med et "stempel", f.eks: KOPI, som kan udskrives på en selvstændig udskrift. '). str_nl(2);
  echo tolk('@I formular-redigering, kan du nu vælge mellem forskellig papirformater: A3, A4, A5 - høj-/bred-format. '). str_nl(2);
  echo tolk('@Der er tilføjet en integreret funktion for "faktura-service", som kan benyttes til inddatering af leverandør fakturaer.'). str_nl(2);
  echo tolk('@Du kan nu se, hvilke tekster (Felter med skygge), der har hjælpetekster tilknyttet.'). str_nl(2);
  echo tolk('@Der er benyttet farver, til at skelne mellem knappers forskellige funktioner f.eks. GRØN: Navigation.'). str_nl(2);
  echo tolk('@Alle tabeller har stribet baggrund, som gør det lettere at læse sammenhørende data.'). str_nl(2);
  echo tolk('@Tabeller med mange linier, vises i `rulle-vinduer`, med fastlåste kolonneoverskrifter.'). str_nl(2);
  echo tolk('@Benyttelse af ikoner og farver, forbedrer brugerens situations fornemmelse.'). str_nl(2);
  echo tolk('@Brugeren kan nu lave zip-backup af alle programmets system-mapper og undermapper i flere niveauer.'). str_nl(2);

  echo '<div style="text-align:center; color:red; ">'.tolk('@TEKNIK:').'</div>'. str_nl(0);
  echo tolk('@Tabeller sorteres / filtreres lokalt i browseren, så server, database og netværk, ikke belastes.'). str_nl(2);
  echo tolk('@Der er moduler til farvekodet modal-besked (fejl / info / advarsel / tip / succes) til brugeren.'). str_nl(2);
  echo tolk('@Programmet er CSS-baseret, så design nemt kan forandres.'). str_nl(2);
  echo tolk('@Programmet er kompatibelt med PHP 7+, og benytter HTML5 og javascript.'). str_nl(2);
  echo tolk('@Er serveren indstillet til at benytte PHP 7, bliver programmet dobbelt så hurtigt!'). str_nl(2);
  echo tolk('@Sikkerheden omkring passwords (brugere og databaseadgang) er blevet forbedret.'). str_nl(2);
  echo tolk('@Databasen er tilpasset engelsk, tvetydige feltnavne er omdøbt og en udrensning af ubenyttede felter er forberedt.').str_nl(2);
  echo tolk('@Programmes kildekode er blokstrukturet, og er blevet omskrevet, så skærmvisning ').str_nl();
  echo tolk('@og data-behandling er adskilt, og det er blevet meget nemmere at overskue og forstå.'). str_nl(2);
  echo tolk('@En god "bivirkning" af omskrivningen, er at omfanget af ubenyttet kode er blevet minimeret.'). str_nl(2);
  echo tolk('@Det er blevet simplere for programmøren at tilpasse, rette og vedligeholde programmet.'). str_nl(2);
  echo tolk('@Der er adskillige redskaber til programmøren: Debug-tilstand (fejlfinding), Skanning af fraser - som skal oversættes til andre sprog, ').str_nl().
       tolk('@Modulskanning - viser php-filers status, Funktionsskanning - viser hvor funktioner er erklæret.'). str_nl(3).'</div>';
//            '<i><b>'.tolk('@Andet: ').'</b></i>';
  //echo tolk('@Der benyttes Ikoner, Funktioner som ikke er standard samles i: `Tilvalg`, '). str_nl(2);
  //echo '<i>'.tolk(' @¹: Målsætning - Der arbejdes stadig på dette.').'</i>'. str_nl(3).'</div>';
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Retur til hovedmenu');
}
 
######### :SYSTEM:
# DEMO-MODUL;
# Kaldes fra: 
function Panl_Intro() {global $ØlanguageTable;  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'intro',$capt= '@Introduktion:',$parms='page_Blindgyden.php',$icon='fas fa-info','panelWmax',__FUNCTION__);
  echo '<div style="text-align:center;"><big>Velkommen til en demo af SALDI med nyt moderne <b>CSS</b>-baseret <b>responsive</b> design,<br><br>'.
  ' samt <b>sprogunderstøttelse</b> og forberedt for forøget <b>sikkerhed</b> omkring password.</big><br><br>';
  echo 'Herunder demonstreres output-modulerne {out_*.php} og deres benyttelse.<br><br>';
  echo 'Der mangler stadig funktionalitet. Vil du skifte sprog, skal der tilføjes  parameter i URL:<br>';
  echo '&nbsp;&nbsp;&nbsp;<i>/saldi-e/base/page_Layoutdemo.php?sprog=en</i> - Vælger engelsk sprog';
  echo '<br>I tabel for Sprog oversættelse er aktuelt indlæst '.count($ØlanguageTable).' fraser, alle maskinoversat af Google Translate.'; str_nl();
  echo 'Vises en dansk tekst, når du har valgt andet sprog, er det fordi der ikke findes en oversættelse endnu. <br>';
  echo '<br>Benytter du trykfølsom skærm uden mus, skal du benytte Chrome browseren, for at få hjælpetekster:'; str_nl();
  echo '"Hvil" fingeren eller musen over den blå tekst med skygge, så popper hjælpetekster op.';  str_nl();
  echo 'Der er stadig "skønhedsfejl" i forskellige browseres visning. </div>';
  htm_PanlBund($pmpt='@Gem',$subm=false,$title='@Gem');
}

######### :SYSTEM:
# DEMO-MODUL;
# Kaldes fra: 
function Panl_Test()  {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'test', $capt= '@Værd at prøve:', $parms='page_Blindgyden.php',  $icon='fas fa-info',  'panelWmax',__FUNCTION__);
  echo '<div style="text-align:center; font-weight:400"><b>Afprøv CSS og responsive design.</b><br><br>';
  echo 'Variér vinduets bredde og se hvordan layoutet tilpasser sig.<br><br>';
  echo 'I Firevox kan du skifte til testvindue for Responsivt-design-vindue med CTRL-Skift-M.<br><br>';
  echo 'Læg mærke til at der er særlige skift ved vinduesbredderne: 320px, 640px, 960px og max 1200px<br><br>';
  echo 'Hvor der findes skjulte hjælpetekster, er synliggjort med blå tekster i skyggerammer. <br><br>';
  echo '<b>Afprøv ændring af programfladens sprog.</b><br><br>';
  echo '<data-colrlabl>/saldi-e/base/page_Layoutdemo.php?sprog=en</data-colrlabl> - Vælger engelsk<br>';
  echo '<data-colrlabl>/saldi-e/base/page_Layoutdemo.php?sprog=de</data-colrlabl> - Vælger tysk<br>';
  echo '<data-colrlabl>/saldi-e/base/page_Layoutdemo.php?sprog=fr</data-colrlabl> - Vælger fransk<br>';
  echo 'Og de andre:&nbsp;<data-colrlabl>/saldi-e/base/page_Layoutdemo.php?sprog=pl =it =es =tr =da</data-colrlabl> - Vælger polsk/italiensk/spansk/tyrkisk/dansk';
  echo '<br><br><b>Afprøv HTML5 og andre forbedringer.</b><br><br>';
  echo 'Inddatering af datoer i chrome, opera, vivaldi (m.fl.?) : Browseren tilbyder date-picker.<br><br>';
  echo 'Validering af data i input-felter : mail-adresse, password, required, m.fl.<br><br>';
  echo 'Prøv at vælge et password for administrator (Database setup), og se password styrke måleren.</div><br>';
  # /da:Sprog/en:Language/de:Sprache/fr:Langue/tr:Dil/es:Lenguaje
htm_PanlBund($pmpt='@Gem',$subm=false,$title='@Gem');
}

######### :SYSTEM:
# DEMO-MODUL;
# Kaldes fra: 
function Panl_Formaal() {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'formaal',$capt= '@Formål:',$parms='page_Blindgyden.php',$icon='fas fa-info','panelW720',__FUNCTION__);
  echo 'Målsætningen med denne udvikling er:<br>';
  echo '<small><pre>';
  echo '  1. Konsistent modul-opbygget kode, så vedligeholdelse/udvikling bliver nemmere.<br>';
  echo '  2. Fjernelse af inaktiv kode.<br>';
  echo '  3. Hastigheds forøgelse, med fokus på repeterende rutiner. PHP7+ øger med faktor 2!<br>';
  echo '  4. Indførelse af Responsivt design, med moderne/fleksibelt layout.<br>';
  echo '  5. CSS-design, så central ændring af udseende gøres mulig.<br>';
  echo '  6. Udnyttelse af HTML5 forbedringer.<br>';
  echo '  7. Al output til skærm baseres på et nyt bibliotek: out_base.php<br>';
  echo '  8. Sprogvalg for program-fladen, med halv-automatisk vedligeholdelse.<br>';
  echo '  9. Forøge sikkerheden omkring password. Opbevaring og styrkemåler.<br>';
  echo ' 10. Sikre kompatibilitet med PHP7. udgår:{func:Split(), func:ereg_*(), ext:mysql_*}<br>';
  echo '     Mere her: [ https://php.net/manual/en/migration70.php ]<br>';
  echo '     Og her: [ https://www.digitalocean.com/company/blog/getting-ready-for-php-7/ ]<br>';
  echo ' 11. Indførelse af WYSIWYG formular-design.<br>';
  echo ' 12. Layout af source-kode forbedres, så strukturen forstås hurtigere, <br>';
  echo '     og sjuskefejl afsløres.<br>';
  echo ' 13. Bedre program-dokumentation ved øget anvendelse af kommentarer i kildetekster.<br>';
  echo ' 14. Anvende prefix på funktionsnavne, så det afspejler kildefilen. (htm_*, out_*,...)<br>';
  echo ' 15. Afskaffe alle:  PRINT "xxx" - Benyt/opret rutiner i out_*.php<br>';
  echo ' 16. Afskaffe Layout-styring med tabeller, som er forældet metode.<br>';
  echo ' 17. Afskaffe afhængighed af: PDFTK som sjældent er installeret.<br>';
  echo ' 18. Basere formularprint på det aktive open-source projekt TCPDF,<br>     som omdanner HTML til PDF, og som understøtter UTF-8 Unicode.  <br>';
  echo ' 19. Basere tabelhåndtering på det aktive projekt https://github.com/Mottie/tablesorter, <br>     som er jQuery baseret.  <br>';
  echo ' 20. Ændre beskedsystem: fra BODY onLoad=javascript:alert() til CSS/jquery: msg_Dialog <br>';
  echo ' <br>';
  echo 'Ad. 1. samt 4.-8. : Sker med de nye biblioteker: out_*.php<br>';
  echo '  <hr>';
  echo 'HUSK: Benyt subRutiner (Blok-struktur) i stedet for Copy-Paste! <br>';
  echo '      Det øger forståelsen og reducerer begrebsforvirring, <br>';
  echo '      med velvalgte navne og det letter vedligeholdelsen!<br></pre></small>';
  htm_PanlBund($pmpt='@Gem',$subm=false,$title='@Gem');
}

######### :SYSTEM:
# DEMO-MODUL;
# Kaldes fra: 
function Panl_Browsr()  {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'intro',$capt= '@Browsere:',$parms='page_Blindgyden.php',$icon='fas fa-info','panelW320',__FUNCTION__);
  echo '<div style="text-align:center;"><big>Kompatibilitet:</big><br>';
  echo '<b>Testet i Windows 10: </b><br>';
  echo 'Firevox - OK <br>';
  echo 'Opera - OK <br>';
  echo 'Vivaldi - OK <br>';
  echo 'Chrome - OK <br>';
  echo 'Edge - begrænset : <br>';
  echo '<small>Baggrunde!, Tiptekster bag naboobjekter!, KnapForgrund! </small><br>';
  echo '  <hr>';
  echo 'LINUX - ? <br>';
  echo 'Konqueror - ? <br>';
  echo 'Firevox - ? <br>';
  echo 'Opera - ? <br>';
  echo 'Vivaldi - ? <br>';
  echo 'Chrome - ? <br>';
echo '  <hr>';
  echo 'Mac OS:<br>';
  echo 'Safari - ? <br>';
  echo '  <hr>';
  echo 'Explorer 11 - ? <br>';
  echo 'Explorer 10 - ? <br>';
  echo 'Explorer  9 - ? <br>';
  echo '</div>';
  htm_PanlBund($pmpt='@Gem',$subm=false,$title='@Gem');
}

######### :SYSTEM:
# SUB-FUNCTION:
# Kaldes fra: 
function NaviTip() {  ## out_PanlsSekd.php
### NavigationsTip:
global $Ønovice;
  userTip();
  if ($Ønovice)
  echo '<tc><divline style="margin-left:0.5em"><b>'.tolk('@noTIP:').'</b> I tabeller: <data-colrlabl>'.tolk('@Tab-tast').'</data-colrlabl> '.
    tolk('@springer til næste felt.').' <data-colrlabl>'.tolk('@SHIFT Tab-tast').'</data-colrlabl> '.tolk('@springer til forrige felt.').
    '  <data-colrlabl>'.tolk('@CTRL Pil-taster').'</data-colrlabl> '.tolk('@virker også. ').'</divline></tc><br>';
}

######### :SYSTEM:
# SUB-FUNCTION:
# Kaldes fra: 
function TastTip() {  ## out_PanlsSekd.php
### Tips ang. tastaturgenveje:
global $Ønovice;
#+  userTip();
  if ($Ønovice)
  echo '<tc><divline style="margin-left:0.5em"><b>'.tolk('@noTIP:').'</b> <data-colrlabl>'.tolk('@Genvejs-taster').'</data-colrlabl> '.
    tolk('@Når der på nogle knapper, er angivet f.eks. ´x´ betyder det, at der er oprettet en genvejs-tast, som kan benyttes i stedet for at klikke på tasten.').
          '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.
    tolk('@Hvordan du benytter genvejen afhænger af den browser, du bruger! Firevox:[Alt] [Shift] + genvejs-tast.  Mange andre:[Alt] + genvejs-tast.').
    '</divline></tc><br>';
}
######### :SYSTEM:
# Kaldes fra: 
function Tips(){  ## out_PanlsSekd.php
### Tips ang. browser genveje:
  msg_Dialog('tip',ucfirst(tolk('@Retur')),'JavaScript:window.history.back();','','','','',ucfirst(tolk('@Funktionstaster:')),
      tolk('@I de fleste nyere browsere kan du:').'<br><br>'.
      tolk('@Skifte fuldskærms mode: F11').'<br><br>'.
      tolk('@Zoom ind/ud: CTRL+/CTRL- ').'<br>'.
      tolk('eller CTRL-musrulleknap').'<br><br>'
  );
}

######### :SYSTEM:
# Kaldes fra: 
function OmFormularer() {global $Ønovice;  ## out_PanlsSekd.php
  if ($Ønovice) {
    echo '<div style="font-size:x-small">';
    echo tolk('@Formularers største papir format er A4, hvilket vil sige at bredden er max 210 mm og højden max. 297 mm.').' ';
    echo tolk('@Dertil svarer at værdier for X skal ligge i intervallet 1 - 210 mm, og Y skal ligge i intervallet 1 - 297 mm').'<br>';
    echo tolk('@Bredde-placeringer X måles fra papirets venste kant.').'<br>'.tolk('@Højde-placeringer Y, måles fra papirets bund.');
    echo '</div>';
  }
}

######### :SYSTEM:
# SUB-FUNCTION:
# Kaldes fra: 
function XY_forskydning() {  ## out_PanlsSekd.php
  htm_KnapGrup('@Forskydning af alle placeringer:',true,false);
    htm_CombFelt($type='numberL',  $name='xSkyd',  $valu= 0,  $labl='@X-forskydning', // min="0" max="100" step="5"
      $titl='@Vandret forskydning: Angiv positivt tal for at øge, negativt tal for at mindske alle x-placeringer (min=-100 max=100',  
      $revi=true, $rows='', $width='100px',$step='1',$more='min="-100" max="100"');
    htm_Spacer('5');
    htm_CombFelt($type='numberL',  $name='ySkyd',  $valu= 0,  $labl='@Y-forskydning', 
      $titl='@Lodret forskydning: Angiv positivt tal for at øge, negativt tal for at mindske alle y-placeringer (min=-100 max=100', 
      $revi=true, $rows='', $width='100px',$step='1',$more='min="-100" max="100"');
    htm_Spacer('200px ');
    textKnap($label='@Forskyd formular',  $title='@Flyt hele formularens indhold med de angivne x/y-værdier.', $link='../_base/page_Blindgyden.php','','margin-left: 60px;');
    OmFormularer();
  htm_KnapGrup('@Forskydning af alle placeringer:',false);
}

######### :SYSTEM: ######### Slut funktioner angående visninger i menu-gruppen SYSTEM

?><!--:SPLITSLUT -->

