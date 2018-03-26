<?php   $DocFil= '../_base/out_ruder.php';   $DocVer='5.0.0';    $DocRev='2018-03-00';   $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Design af panelers layout.';
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2018 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 * Design af panelers layout.
 * Panel-moduler (Ruder) egnet for adaptivt skærm-output.
 *
 * Afhængig af: out_base.php
 * Denne fil bør på sigt opdeles i flere mindre, pga. indlæsnings hastighed!
 * Evt. Opdeling i 2: [1. Regnskabs paneler]  [2. Indstillings paneler]
 * Alternativt flyttes de "langsomme" ud i de page_-filer, som de angår.
 *  
 * Filer er redigeret med tabulator sat til 2 tegn, og linielængde max. 200 tegn. De ses bedst med det.
 * Filer skal gemmes i UTF-8 format uden BOM!
 *
  Oprettet: 2016-08-00 evs - EV-soft    #: Dette bibliotek er udviklet 2016-1018 af EV-soft.
  Ændrings-Log:
      
 * 
 */
global $ØProgRoot;

if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'out_ruder');
//echo "\n<!-- $DocVer  $DocRev  $modulnr  $DocFil -->\n";

// ***** Rutiner for MENU og visning/redigering af DB-data: **************************************************
include $ØProgRoot.$_base.'version.php';
if (!function_exists('msg_Dialog')) {include $_base.'msg_lib.php';};
  
# PROGRAM-MODUL; "Navigation" (udgået Gittermenu!)
// 2017-03-09 - Er kopieret til page_GitterMenu:
# Kaldes fra:  [_base/page_Gittermenu.php] 
function Rude_HovedMenu(&$regnskab, &$vis_finans, &$vis_debitor, &$vis_kreditor, &$vis_prodkt, &$vis_lager) {
global $ØProgRoot, $Øcopydate, $Øcopyright, $ØProgTitl, $Øprogvers, $ØprogSprog, $Ødesigner;
//  $ØprogSprog= $_SESSION['ØprogSprog'];
  $goBack= '';  # '?returside=../_base/menu.php';
  echo '<PanlHead>';        
  htm_Rude_Top($name='menuform',$capt='',$parms='page_Blindgyden.php',$icon='',$klasse='panelWmax',__FUNCTION__,'','');
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
      if ($vis_finans)  menuKnap($h='32',$w=$knapW, $label='@Rapporter',        $link='../_finans/page_Rapport.php',         $title='@Gå til Finans Rapporter'   );
      if ($vis_debitor) menuKnap($h='32',$w=$knapW, $label='@Rapporter',        $link='../_debitor/page_Rapport.php',        $title='@Gå til Debitor Rapporter'  );
      if ($vis_kreditor)menuKnap($h='32',$w=$knapW, $label='@Rapporter',        $link='../_kreditor/page_Rapport.php',       $title='@Gå til Kreditor Rapporter' );
      if ($vis_prodkt)  menuKnap($h='32',$w=$knapW, $label='',                  $link='../_base/page_Blindgyden.php',        $title='@Gå til ?'                  );
      if ($vis_lager)   menuKnap($h='32',$w=$knapW, $label='@Rapporter',        $link='../_lager/page_Beholdningsliste.php', $title='@Gå til Vare Rapporter'     );
                        menuKnap($h='32',$w=$knapW, $label='@Sikkerheds kopi',  $link='../_system/page_Backup.php',          $title='@Gem/Hent sikkerhedskopi'   );
     echo '</div>';
    htm_FrstFelt('20%',0);
    htm_NextFelt('15%');  htm_CentrOn($more='font-size:10px;');  echo $ØProgTitl.' - Version '.$Øprogvers;  htm_CentOff();       
    htm_NextFelt('30%');  htm_CentrOn($more='font-size:10px;');  echo '<i>Copyright '.  $Øcopydate.' '.$Øcopyright.'</i>';  htm_CentOff();
    htm_NextFelt('15%');  htm_CentrOn($more='font-size:10px;');  echo tolk('@Design: ').$Ødesigner;   htm_CentOff();
    
    htm_NextFelt('20%');
    htm_LastFelt();
  echo '</p>';
  htm_RudeBund($pmpt=Tolk('@Gem'),$subm=false);
  Rude_FootMenu($doPrint=false, $doErase=false, $doLookUp=false, $doAccept=false, $doExport=false, $doImport=false, $OpslLabl='');
  echo '</PanlHead>';
}

// 2017-03-09 - Er kopieret til page_GitterMenu:
# Kaldes fra:  [_base/page_Gittermenu.php] 
function Rude_ProgramStatus() {global $ØProgTitl;
  htm_Rude_Top($name='statform',$capt='@Program status',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-info-circle',$klasse='panelW480',__FUNCTION__,'','');
  echo '<div style="text-align:center; color:red; background:white;"><big><i>'.str_nl().
       tolk('@TEST udgave af').$ØProgTitl.':</i></big>'. str_nl(3);
  echo tolk('@Dette er seneste version i udviklingen.'). str_nl(2);
  echo tolk('@Der vil derfor forekomme midlertidige fejl.'). str_nl(3);
  echo tolk('@Endvidere vil oversatte fremmed sprog, ikke være helt ajour.'). str_nl(3);
  echo '</div>';
  htm_RudeBund($pmpt=Tolk('@Gem'),$subm=false);
}

# PROGRAM-MODUL; "Navigation"
# Kaldes fra: 
function Rude_AdminMenu() {global $ØProgRoot, $ØLineBrun;
  htm_Rude_Top($name='adminform',$capt='@Indstillinger 1 - Ofte.',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-bars',$klasse='panelW240',__FUNCTION__);
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
             menuKnap($h='22',$w=$knapW,$label='@Udvikling: Layouttest',  $link=$ØProgRoot.'_base/page_Layoutdemo.php',     $title='@Visning af eksempler på ruders opbygning.');
  htm_nl();    
  htm_nl();  naviKnap($label='@Hovedmenu', $title='@Vend tilbage til programmets hovedmenu',$link='../_base/page_Hovedmenu.php',$akey='h');
  // htm_nl();  naviKnap($label='@Indstillinger 1', $title='@Gå til en anden indstillings menu',$link='../_system/page_Valuta.php',$akey='1');
  htm_nl();  naviKnap($label='@Indstillinger 2', $title='@Gå til en anden indstillings menu',$link='../_system/page_Divsetup2.php',$akey='2');
  htm_nl();  naviKnap($label='@Indstillinger 3', $title='@Gå til en anden indstillings menu',$link='../_system/page_Tilvalgsetup3.php',$akey='3');
  //  htm_nl();  textKnap($label='@Flere indstillinger 2.',  $title='@Diverse indstillinger', $link=$ØProgRoot.'_system/page_Divsetup2.php',$akey='2');
  htm_nl();
  htm_CentOff();
  htm_RudeBund($pmpt=Tolk('@Retur til hovedmenu'),$subm=false,$title='@Luk og gå retur til hovedmenu');
};

# PROGRAM-MODUL; "Navigation"
# Kaldes fra:  [_system/page_Bilagsinfo.php] [_system/page_Differencer.php] [_system/page_Diversevalg.php] [_system/page_Divsetup2.php] [_system/page_Formtekst.php] [_system/page_Imogexport.php] [_system/page_Kontoindstill.php] [_system/page_Massefakt.php] [_system/page_Ordrerelat.php] [_system/page_Personlig.php] [_system/page_Prislister.php] [_system/page_Programsprog.php] [_system/page_Provision.php] [_system/page_Rykkerrel.php] [_system/page_Tjeklister.php] [_system/page_Varerelat.php] [_system/page_xxx.php] 
function Rude_DiverseMenu() {global $ØLineBrun;
  htm_Rude_Top($name='adminform',$capt='@Indstillinger 2 - Flere.',$parms='../_system/page_Valuta.php',$icon='fas fa-bars',$klasse='panelW240',__FUNCTION__);
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
  htm_nl(); naviKnap($label='@Hovedmenu', $title='@Vend tilbage til programmets hovedmenu',$link='../_base/page_Hovedmenu.php',$akey='h');
  htm_nl(); naviKnap($label='@Indstillinger 1', $title='@Gå til en anden indstillings menu',$link='../_system/page_Valuta.php',$akey='1');
  //  htm_nl();  textKnap($label='@Indstillinger 2', $title='@Gå til en anden indstillings menu',$link='../_system/page_Divsetup2.php',$akey='2');
  htm_nl(); naviKnap($label='@Indstillinger 3', $title='@Gå til en anden indstillings menu',$link='../_system/page_Tilvalgsetup3.php',$akey='3');
  htm_nl(); htm_CentOff();
  htm_RudeBund($pmpt=Tolk('@Retur til indstillinger 1.'),$subm=false,$title='@Luk og gå retur til indstillingsmenu');
};

# PROGRAM-MODUL; "Navigation"
# Kaldes fra:  [_system/page_Labels.php] [_system/page_Tilvalgsetup3.php] 
function Rude_TilvalgsMenu() {global $ØProgTitl, $ØLineBrun;
  htm_Rude_Top($name='tilvform',$capt='@Indstillinger 3 - Tilvalg',$parms='../_system/page_Divsetup2.php',$icon='fas fa-bars',$klasse='panelW240',__FUNCTION__);
  $goBack= '?returside=../_base/menu.php';
  $knapW= 220;
  htm_CentrOn();
  htm_hr($ØLineBrun);  htm_Caption('@Tillægs funktioner:');
  htm_nl();  menuKnap($h='22',$w=$knapW ,$label='@Aktivering af tilvalg', $link='../_base/page_Blindgyden.php',         
          $title='@Indstillinger angående aktivering af ekstra moduler m.v.');
  htm_nl();  menuKnap($h='22',$w=$knapW ,$label='@Shop relaterede valg (WEB)',  $link='../_base/page_Blindgyden.php',   
          $title='@Indstillinger angående WEB-Shop relaterede valg');
  htm_nl();  menuKnap($h='22',$w=$knapW ,$label='@Web API',               $link='../_base/page_Blindgyden.php',         
          $title= tolk('@Indstillinger angående API (Application Programming Interface), en softwaregrænseflade, der tillader').
          $ØProgTitl.' '.tolk('@at interagere med andet software'));
  htm_nl();  menuKnap($h='22',$w=$knapW ,$label='@PoS-valg (Kasse)',      $link='../_base/page_Blindgyden.php',         
          $title='@Indstillinger angående PoS-valg (Point-of-Sale), angår kasseapparat løsningen');
  htm_nl();  menuKnap($h='22',$w=$knapW ,$label='@Label print',           $link='../_system/page_Labels.php',       
          $title='@Indstillinger angående Labels');
  htm_CentOff();
  htm_CheckFlt($type='checkbox',$name='docubizz', $valu= $docubizz,  $labl='@Integration med DocuBizz', 
          $titl='@Import fra DocuBizz - Det intelligente fakturasystem',  $revi=true, $more=' '.$pg);
  
  htm_CheckFlt($type='checkbox',$name='ebconn', $valu= $ebconn,  $labl='@Integration med ebConnect',    
          $titl='@Elektronisk fakturering. Send og modtag e-faktura med ebconnect. Send direkte fra økonomisystemet og overfør til kassekladden - klar til bogføring',  $revi=true, $more=' '.$pg);

  htm_CentrOn();
  htm_nl();  naviKnap($label='@Hovedmenu', $title='@Vend tilbage til programmets hovedmenu',$link='../_base/page_Hovedmenu.php',$akey='h');
  htm_nl();  naviKnap($label='@Indstillinger 1', $title='@Gå til en anden indstillings menu',$link='../_system/page_Valuta.php',$akey='1');
  htm_nl();  naviKnap($label='@Indstillinger 2', $title='@@Gå til en anden indstillings menu',$link='../_system/page_Divsetup2.php',$akey='2');
  //  htm_nl();  naviKnap($label='@Indstillinger 3', $title='@Gå til en anden indstillings menu',$link='../_system/page_Tilvalgsetup3.php',$akey='3');
    htm_nl();  
  htm_CentOff();
  htm_RudeBund($pmpt=Tolk('@Retur til indstillinger 2.'), $subm=false, $title='@Luk og gå retur til indstillingsmenu');
};

# PROGRAM-MODUL; "Navigation"
// 2017-03-09 - Er kopieret til page_GitterMenu:
# Kaldes fra:  [_base/page_Gittermenu.php] [_debitor/page_DebitorOrdre.php] [_debitor/page_Opretordre.php] [_debitor/page_Ordreliste.php] [_finans/page_Budget.php] [_finans/page_Kontrol.php] [_finans/page_Provisionsrapport.php] [_finans/page_Rapport.php] [_finans/page_Regnskab.php] [_kreditor/page_Kreditor.php] [_kreditor/page_Ordreliste.php] [_lager/page_Varemodtagelse.php] [_lager/page_Varer.php] 
function Rude_FootMenu($doPrint=true, $doErase=true, $doLookUp=true, $doAccept=true, $doExport=true, $doImport=true, $OpslLabl='') {
  echo '<div class="clearWrap"/>';  echo '<PanlFoot>';
    Foot_Links($maxi=true, '<a style="color:#900000" href="'.$link='http://www.ev-soft.dk/saldi-wiki/doku.php?id=saldi:manualen '.'" target="_blank">'.
    '<u title="'.tolk('@Manual, tips og anden hjælp finder du på').$ØProgTitl.'-DokuWiki">SALDI-DokuWiki</u></a>',
    $doPrint, $doErase, $doLookUp, $doAccept, $doExport, $doImport, $OpslLabl);
  echo '</PanlFoot>';
}


# Kaldes fra: [_base/page_Install.php] [_base/page_Startup.php] [_system/page_Connsetup.php] 
function Rude_DBsetup(&$db_type,&$db_encode,&$db_navn,&$db_bruger,&$db_password,&$adm_navn,&$adm_password,&$verify_adm_password,&$db_host) {
  global $ØButtnBgrd, $ØButtnText, $ØProgTitl, $Ønovice; 
  htm_Rude_Top($name='opret',$capt=$ØProgTitl.'-<small> € :</small> '.Tolk('@Database setup'),$parms='../_admin/ini_CreateDB.php.php',$icon='fas fa-wrench',$klasse='panelW320',__FUNCTION__);
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
  
  echo '<hr>';
//  userTip(); $Ønovice
  if (true) {
    echo '<div style="text-align:left"><small><b>'.tolk('@Alle').'</b> '.tolk('@felter skal udfyldes og kontrolleres.').' <br>&nbsp;&nbsp;<br>';
    echo '<b>'.tolk('@TIP:').'</b> '.tolk('@Hold musen over blå tekster, for at få hjælpetip.').'</small></div>';
  }
  echo '<br><div style="text-align:left"><small><b>'.tolk('@HUSK:').'</b> '.tolk('@Skrivebeskyt alle programmets mapper på serveren, på nær: ').
       '<br>../_config ../_exchange ../_temp ../_userlib '.
       tolk('@og undermapper heri.<br>Mappen ../_config indeholder oplysninger om adgang til databasen, men disse beskyttes af en .htaccess fil.').'</small></div>';
  htm_RudeBund($pmpt=Tolk('@Opret DB'),$subm=true,$title=tolk('@Klik her for at oprette dit').$ØProgTitl.' database-system');
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

# Kaldes fra:  [_base/page_Install.php] [_base/page_Startup.php] [_system/page_Connsetup.php] 
function Rude_Install(&$db_type,&$db_encode,&$db_navn,&$db_bruger,&$db_password,&$adm_navn,&$adm_password,&$verify_adm_password) { global $ØProgTitl; 
# Test for skrivbarhed:
  if ($fp=fopen("../_config/connect.php","a"))   { fclose($fp); $inc='checked';} else $inc.='';
  if ($fp=fopen("../_temp/test.txt","w"))        { fclose($fp); $tmp='checked';} else $tmp.='';
  if ($fp=fopen("../_exchange/test.txt","w"))    { fclose($fp); $exc='checked';} else $exc.='';
  if ($fp=fopen("../_userlib/test.txt","w"))     { fclose($fp); $lgo='checked';} else $lgo.='';
#+  
  if (extension_loaded('mysqli')) {if ($link= mysqli_connect("")) {$mq= 'checked'; mysqli_close($link);}  else $mq= '';}  else $mq= '';
  if (extension_loaded('pgsql'))  {if (pg_connect(""))            {$pg= 'checked'; pg_close();}           else $pg= '';}  else $pg= '';
  if ($mq) $mqtx= tolk('@findes'); else $mqtx= tolk('@mangler');
  if ($pg) $pgtx= tolk('@findes'); else $pgtx= tolk('@mangler');
  if (ØisSecure()) $sec = 'checked'; else $sec = '';
  htm_Rude_Top($name='opret',$capt= '@Installations forberedelse',$parms='../_base/_admin/ini_CreateDB.php',$icon='fas fa-wrench',$klasse='panelW320',__FUNCTION__);
 echo '<div style="text-align:left"><small>'.'<b>'.
      tolk('@Nødvendig forberedelse:').'</b><br> '.
      tolk('@En webserver med PHP skal være i drift, med DB-extension pqsql eller mysqli aktiveret.').' <br>'.
      tolk('@På serveren skal være installeret en af database serverne PostgreSQL eller MySQL-kompatibel.').'<br>';
  
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
  htm_RudeBund($pmpt=Tolk('@Installér'),$subm=false,$title=tolk('@Klik her for at oprette dit').$ØProgTitl.' database-system');
}

# Kaldes fra: 
function Rude_InstallFail($noskriv) { global $ØProgTitl;
  htm_Rude_Top($name= 'opret', $capt= '@Installation fejler!', $parms='db_setup.php', $icon='fas fa-wrench', $klasse='panelW320',__FUNCTION__);
    echo '<b>'.tolk('@Problem:').'</b><br>';
    echo tolk('@Der er ikke skriveadgang til kataloget:'),' "'.$noskriv.'"<br>';
    // if (extension_loaded('mcrypt') && extension_loaded('hash')) { $ext_loaded=true;  }
    if ($noskriv=="_config") 
    echo tolk('@hvor filen "connect.php" skal oprettes.').'<br><br>';
    echo tolk('@Sørg for at der er skriveadgang for Webbrugere, til katalogerne').': "_config", "_temp", "_userlib" <br><br>';
    echo tolk('@Se hvordan i installeringsvejledningen INSTALLATION.txt.').' <br><br>';
  htm_RudeBund($pmpt= Tolk('@Installér'),$subm=false,$title=tolk('@Klik her for at oprette dit').$ØProgTitl.' database-system');
}

# Kaldes fra: 
function Rude_InstallSucces(&$db_navn, &$adm_navn) { global $ØProgTitl;
  htm_Rude_Top($name='oprettet',$capt= '@Databasen er installeret',$parms='page_Blindgyden.php',$icon='fas fa-wrench',$klasse='panelW320',__FUNCTION__);
    echo '<b>'.tolk('@Bravo:').'</b><br>';
    echo tolk('@Dit'.$ØProgTitl.'-system er nu oprettet. Det første, du nu skal gøre, er at oprette et regnskab.').'<br><br>';
    echo tolk('@Det gøres ved at logge ind med: ').'<br>[<b>'.$db_navn.'</b>] '.tolk('@som regnskab').', <br>[<b>'.$adm_navn.'</b>] ';
    echo tolk('@som brugernavn og med den valgte adgangskode').'<br><br>';
    echo tolk('@Tegn en hotline-aftale, så kan du ringe eller sende en e-mail og få hurtigt svar på spørgsmål om brugen af'.$ØProgTitl.'.').'<br><br>';
    echo tolk('@Se mere på').' <a href="http://saldi.dk/hotline" target="_blank">http://saldi.dk/hotline</a> <br>';
//    echo '<p>&nbsp;</p><br>';
//    echo '<p><a href="../_base/index.php" title="Til SALDI-administratorsiden hvor regnskaber administreres" <br>';
//    echo ' style="text-decoration:none"><input type="button" value="Fortsæt"></a><br><br>';
  htm_RudeBund($pmpt=Tolk('@Fortsæt'),$subm=true,$title='@Fortsæt til logind og oprettelse af 1. regnskab');
}

# Kaldes fra:  [_base/page_Install.php] [_base/page_Startup.php] [_system/page_Connsetup.php] 
function Rude_Login(&$regnskab,&$brugernavn,&$brugerkode,&$ProgVers,&$LnkHelp,&$OrgaName,&$Logo,$VisMax=true) { global $ØProgTitl, $ØprogSprog;
  htm_Rude_Top($name='logiform',$capt=Tolk('@Logind til').' <i>'.$regnskab.'</i>',$parms='#',$icon='fas fa-key',$klasse='panelW320',__FUNCTION__); # < ? php echo htmlspecialchars($_SERVER["PHP_SELF"]);? >
  echo '<table width="100%";cellspacing="0"><tr align="center">';
  $FaLogo= '../_assets/images/'.$Logo;
  if ($VisMax) {
    if (file_exists($FaLogo)) echo '<tr align="center" title="SALDI-euro - '.tolk('@Det frie danske økonomisystem').'" style="cursor: help;"><td colspan="3"; height="40px">'.
                                   '<img style="border:0px solid;width:120px;heigth:80px" alt="LOGO" src="'.$FaLogo.'"></td></tr>';
    echo '<td> <small><small>'.$ØProgTitl.'</small></small></td>';
    echo '<td align="center">'.ucfirst(tolk('@Vært:')).'&nbsp; <b>'.$OrgaName.'</b></td>';
    echo '<td align="right"><small><small>Vers.'.$ProgVers.'</small></small> </td>';
    if ($LnkHelp) echo '<tr align="center"><td colspan="3"><br/><small><small>Huske TIP: </small> '.$LnkHelp.' </small></td></tr>';
    echo '</tr></table><br>';
  }

  htm_CombFelt($type='text',    $name='regn', $valu= $regnskab,   $labl='@Regnskab',    $titl='@Angiv navnet på det Regnskab, som du har adgang til',
          $revi=true, $rows='2',$width='',$step='', $more='required="required" ', $plho=tolk('@Regnskab...'));
  htm_CombFelt($type='text',    $name='navn', $valu= $brugernavn, $labl='@Brugernavn',  $titl=tolk('@Angiv dit').$ØProgTitl.' '.tolk('@Brugernavn'),
          $revi=true, $rows='2',$width='',$step='', $more='required="required" ', $plho=tolk('@Bruger...'));
  htm_CombFelt($type='password',$name='kode', $valu= $brugerkode, $labl='@Adgangskode', 
          $titl='@Angiv den gyldige adgangskode hørende til Brugernavnet. 4-20 tegn - STORE/små bogstaver, cifre, samt spec.tegn - SKAL benyttes',  
          $revi=true, $rows='2',$width='',$step='', 
          $more=''.//required="required" pattern="((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&_æøåÆØÅ]).{4,20})" '.
                'title="4..20 tegn accepteres, STORE/små bogstaver, cifre, samt spec.tegn - SKAL benyttes!" ', $plho=tolk('@Password...'));    
  //  Password (UpperCase, LowerCase, Number/SpecialChar and min 8 Chars):  (?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$
#  echo '<div style="text-align: center"><br><small><small> /da:Sprog/en:Language/de:Sprache/fr:Langue/tr:Dil/es:Lenguaje</small></small></div>';
  if ($VisMax) SprogValg($ØprogSprog);
  htm_nl();
  htm_Caption('(Virker ikke her!)');
  htm_hr();
  echo '<p align="center"><a href="'.$link='../_base/page_Blindgyden.php'.'"><u title="'.tolk('@Få tilsendt mail, angående resat password').'">'.tolk('@Glemt adgangskode?').'</u></a></p>';
  htm_RudeBund($pmpt=Tolk('@Log ind'),$subm=true,$title=tolk('@Gå videre til').$ØProgTitl.' '.tolk('@regnskabet'));
}


# Kaldes fra:  [_system/page_Connsetup.php] 
function Rude_Connsetup() { 
  htm_Rude_Top($name='forbind',$capt='@DB forbindelse:',$parms='page_Blindgyden.php',$icon='fas fa-key',$klasse='panelW480',__FUNCTION__);
  htm_CombFelt(                      $type='text',  $name='firmanavn',  $valu= $firmanavn,  $labl='@Firmanavn',   $titl='@Navnet på det firma, regnskabet angår',   $revi=true);
  htm_FrstFelt('50%');  htm_CombFelt($type='text',  $name='addr1',      $valu= $addr1,      $labl='@Adresse',     $titl='@Firmaets adresse',                        $revi=true);
  htm_NextFelt('50%');  htm_CombFelt($type='text',  $name='addr2',      $valu= $addr2,      $labl='@Sted',        $titl='@Supplerende stedsangivelse',              $revi=true);
  htm_LastFelt();                                                                           
  htm_FrstFelt('25%');  htm_CombFelt($type='text',  $name='postnr',     $valu= $postnr,     $labl='@Postnr.',     $titl='@Postnr',                                  $revi=true);
  htm_NextFelt('75%');  htm_CombFelt($type='text',  $name='bynavn',     $valu= $bynavn,     $labl='@Bynavn',      $titl='@Bynavn. firmaets hjemsted',               $revi=true);
  htm_LastFelt();                                                                           
  htm_FrstFelt('50%');  htm_CombFelt($type='mail',  $name='ny_email',   $valu= $ny_email,   $labl='@Mail',        $titl='@Firmaets Mail-adresse',                   $revi=true);
  htm_NextFelt('50%');  htm_CombFelt($type='text',  $name='homepage',   $valu= $homepage,   $labl='@Hjemmeside',  $titl='@Firmaets hjemmeside-adresse',             $revi=true);
  htm_LastFelt();                                                                           
  htm_CombFelt(                      $type='text',  $name='bank_navn',  $valu= $bank_navn,  $labl='@Bank',        $titl='@Bank forbindelse',                        $revi=true);
  htm_FrstFelt('25%');  htm_CombFelt($type='text',  $name='bank_reg',   $valu= $bank_reg,   $labl='@Bank reg.',   $titl='@Bank reg.',                               $revi=true);
  htm_NextFelt('75%');  htm_CombFelt($type='text',  $name='bank_konto', $valu= $bank_konto, $labl='@Bank konto',  $titl='@Bank konto',                              $revi=true);
  htm_LastFelt();
  htm_CombFelt(                      $type='text',  $name='cvrnr',      $valu= $cvrnr,      $labl='@CVR',         
                      $titl='@CVR - Virksomheds ID. Tast CVR-nr. omsluttet af *, +, eller / for at importere data fra Erhvervsstyrelsen (Data leveres af CVR API)', $revi=true);
  htm_FrstFelt('50%');  htm_CombFelt($type='text',  $name='tlf',        $valu= $tlf,        $labl='@Telefon.',    
                      $titl='@Tlf - Tast telefonnr. omsluttet af *, +, eller / for at importere data fra Erhvervsstyrelsen (Data leveres af CVR API)',              $revi=true);
  htm_NextFelt('50%');  htm_CombFelt($type='text',  $name='fax',        $valu= $fax,        $labl='@Fax',         $titl='@Firmaets fax',                            $revi=true);
  htm_LastFelt();
  if (!$pbs_nr) {
    htm_FrstFelt('40%');  htm_CombFelt($type='text',$name='pbs_nr',     $valu= $pbs_nr,     $labl='@PBS Kreditornr.', $titl='@Firmaets pbsnr',  $revi=true);
    htm_NextFelt('60%');  {if      ($pbs=='B') $listen= array(['','B','@Basis løsning'], ['','', '@Total løsning'], ['','L','@Lev. Service']);
                           elseif  ($pbs=='L') $listen= array(['','L','@Lev. Service'],  ['','B','@Basis løsning'], ['','', '@Total løsning']);
                           else                $listen= array(['','', '@Total løsning'], ['','B','@Basis løsning'], ['','L','@Lev. Service']);
                           htm_OptioFlt($type='text',$name='pbs',       $valu= $pbs,        $labl='@Aftale',      $titl='@Vælg den aftalte løsning',  $revi=true, $optlist= $listen, $action='');
                          }
    htm_LastFelt();
  } else  htm_CombFelt(             $type='text',  $name='pbs_nr', $valu= $pbs_nr, $labl='@PBS Kreditornr.',   $titl='@Firmaets pbsnr',  $revi=true);
  htm_CombFelt(                     $type='text',  $name='gruppe', $valu= $gruppe, $labl='@PBS debitorgruppe', $titl='@Gruppe ',         $revi=true);
  htm_CombFelt(                     $type='text',  $name='fi_nr',  $valu= $fi_nr,  $labl='@FI Kreditornr.',    
                      $titl='@Bankernes fælles indbetalingskort (FI-kort). Her angiver du dit FI Kreditornr.',    $revi=true);
  htm_RudeBund($pmpt='@Gem',$subm=true);
}


# Kaldes fra:  [_debitor/page_DebitorOrdre.php] 
function Rude_Kunden(&$kontonr, &$kategori, &$cvrnr, &$eannr, &$bankreg, &$bankkto, &$instit, &$ansv, &$formsprog, &$homeweb) { 
  htm_Rude_Top($name='kundform',$capt='@Kunden (debitor):',$parms='page_Blindgyden.php',$icon='fas fa-user',$klasse='panelWmax',__FUNCTION__,'','legeplads:lege-side#kunden');
  htm_CombFelt($type='text',  $name='DBix',   $valu= $kontonr,  $labl='@Kundenr.',          $titl='@Kundenr: Kan ikke rettes. Systemet styrer dette', $revi=false);
  htm_RadioGrp($type='hori',  $name='Ktyp',                     $labl='@Kundetype',         $titl='@Kunde kategori',          
              $optlist= array(['privat','@Privat','@eller'],['erhverv','@Erhverv','']),$action='');
  $Erhv= 'placeholder="...'.tolk('@kun erhverv').'..."';  // Rerurnering af værdi i &$kategori ?
  htm_CombFelt($type='text',  $name='CVR',    $valu= $cvrnr,    $labl='@CVR',               $titl='@CVR - Virksomheds ID',    $revi=true,'','','',$Erhv);
  htm_CombFelt($type='text',  $name='EAN',    $valu= $eannr,    $labl='@EAN',               $titl='@EAN - E-betalings ID',    $revi=true,'','','',$Erhv);
  htm_FrstFelt('30%');                                          
    htm_CombFelt($type='text',$name='bankreg',$valu= $bankreg,  $labl='@Bank reg.',         $titl='@Bank reg.',               $revi=true);  
  htm_NextFelt('70%');                                          
    htm_CombFelt($type='text',$name='bankkto',$valu= $bankkto,  $labl='@Bank konto',        $titl='@Bank konto',              $revi=true);  
  htm_lastFelt();                                               
  htm_CombFelt($type='text',  $name='inst',   $valu= $instit,   $labl='@Institution',       $titl='@Supplerende oplysning',   $revi=true,'','','',$Erhv);
  htm_CombFelt($type='text',  $name='ansv',   $valu= $ansv,     $labl='@Kundeansvarlig',    $titl='@Kundeansvarlig',          $revi=true);
  htm_CombFelt($type='text',  $name='sprog',  $valu= $formsprog,$labl='@Faktureringssprog', $titl='@Sproget som skal benyttes på faktura udskrifter',   
          $revi=true,'','','','placeholder="...'.tolk('@hvis sproget ikke er dansk').'..."');
  htm_CombFelt($type='text',  $name='homeweb',$valu= $homeweb,  $labl='@Hjemmeside',        $titl='@Kundens hjemmeside',      $revi=true,'','','',$Erhv);
  htm_RudeBund($pmpt='@Gem',$subm=true);
}

# PROGRAM-MODUL;
# Kaldes fra: 
function Rude_Leverandor(&$kontonr, &$kategori, &$cvrnr, &$eannr, &$bankreg, &$bankkto, &$instit, &$ansv, &$formsprog, &$homeweb) { 
  htm_Rude_Top($name='kundform',$capt='@Leverandør - Oplysninger:',$parms='page_Blindgyden.php',$icon='fas fa-user',$klasse='panelWmax',__FUNCTION__);
  htm_CombFelt($type='text',  $name='DBix',   $valu= $kontonr,  $labl='@Leverandørnr.',          $titl='@Leverandørnr: Kan ikke rettes. Systemet styrer dette', $revi=false,'','','','','..auto..');  
//  htm_RadioGrp($type='hori',  $name='Ktyp',                     $labl='@Leverandørtype',         $titl='@Leverandør kategori',          
//              $optlist= array(['privat','@Privat','@eller'],['erhverv','@Erhverv','']),$action='');
  $Erhv= 'placeholder="...'.tolk('@kun erhverv').'..."';  // Returnering af værdi i &$kategori ?
  htm_CombFelt($type='text',  $name='CVR',    $valu= $cvrnr,    $labl='@CVR-nr',            $titl='@CVR - Virksomheds ID',    $revi=true,'','','',$Erhv,'CVR...');
//  htm_CombFelt($type='text',$name='EAN',    $valu= $eannr,    $labl='@EAN',               $titl='@EAN - E-betalings ID',    $revi=true,'','','',$Erhv);
  htm_CombFelt($type='text',  $name='bank',   $valu= $bank,     $labl='@Bank',              $titl='@Bank',                    $revi=true,'','','','','Bank...');  
  htm_FrstFelt('30%');                                          
    htm_CombFelt($type='text',$name='bankreg',$valu= $bankreg,  $labl='@Bank reg.',         $titl='@Bank reg.',               $revi=true,'','','','','Reg...');  
  htm_NextFelt('70%');                                          
    htm_CombFelt($type='text',$name='bankkto',$valu= $bankkto,  $labl='@Bank konto',        $titl='@Bank konto',              $revi=true,'','','','','Konto...');  
  htm_lastFelt();                                               
  // SWIFT nr.  FI kreditoer nr.  Kredit max. ERH kode    Lukket
  htm_FrstFelt('33%'); 
  htm_CombFelt($type='text',$name='swift',    $valu= $swift,    $labl='@SWIFT nr.',       $titl='@SWIFT nummer',              $revi=true,'','','','','SWIFT...');  
  htm_NextFelt('33%');
  htm_CombFelt($type='text',$name='kredkto',  $valu= $kredkto,  $labl='@FI kreditor nr.', $titl='@FI kreditor nr.',           $revi=true,'','','','','FI...');  
  htm_NextFelt('33%');
  htm_CombFelt($type='text',$name='kredmax',  $valu= $kredmax,  $labl='@Kredit max.',     $titl='@Maximal kredit',            $revi=true,'','','','','Max...');  
  htm_lastFelt();                                               
  htm_OptioFlt($type='text',  $name='erhkode',  $valu= $erhkode,   
                    $labl='@ERH kode',  
                    $titl='@ERH kode',  
                    $revi=true, $optlist= ERH_Liste(),$action='');
  htm_nl();
  htm_FrstFelt('50%'); 
  htm_CheckFlt($type='checkbox',$name='lukket', $valu= $lukket, $labl='@Lukket',          $titl='@Kontoen er lukket',         $revi=true);
//  htm_CombFelt($type='text',  $name='inst',   $valu= $instit,   $labl='@Institution',       $titl='@Supplerende oplysning',   $revi=true,'','','',$Erhv);
  htm_NextFelt('50%');
  htm_CombFelt($type='text',  $name='ansv',   $valu= $ansv,     $labl='@Leverandøransvarlig',    $titl='@Leverandøransvarlig',          $revi=true,'','','','','Ansv...');
  htm_lastFelt();                                               
  htm_CombFelt($type='text',  $name='sprog',  $valu= $formsprog,$labl='@Kommunikationssprog', $titl='@Sproget som skal benyttes til kommunikation',   $revi=true,'','','','placeholder="...'.tolk('@hvis sproget ikke er dansk').'..."');
  htm_CombFelt($type='text',  $name='homeweb',$valu= $homeweb,  $labl='@Hjemmeside',        $titl='@Link til leverandørns hjemmeside',      $revi=true,'','','',$Erhv);
  htm_RudeBund($pmpt='@Gem',$subm=true);
/* 
    Leverandørnr	
Navn	
Adresse	
Adresse2	
Postnr/By	
Land	
e-mail	
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

ERH kode
 */  
  
}

# Kaldes fra:  [_debitor/page_DebitorOrdre.php] 
function Rude_Betingelser(&$debigrup, &$betaling, &$frist, &$print2, &$kunderef    /* ,&$betalingsbet,&$fristdage */ ) { 
  #if ($betalingsbet=='@Kontant'||$betalingsbet=='@Efterkrav'||$betalingsbet=='@Forud'||$betalingsbet=='@Kreditkort') $fristdage='';  else $fristdage=0;
  htm_Rude_Top($name='betaform',$capt= '@Betingelser:',$parms='page_Blindgyden.php',$icon='far fa-credit-card',$klasse='panelWmax',__FUNCTION__,'','legeplads:lege-side#handelsbetingelser'); # ' <text color: "gray">&#x00A7;</text>  '.
  htm_OptioFlt($type='text',  $name='debigrup',   $valu= $debigrup, 
                    $labl='@Debitorgruppe',     
                    $titl='@Vælg hvilken gruppe kunden tilhører', 
                    $revi=true, $optlist= array(
                    ['','@1. Danske debitorer',     '@1. Danske debitorer'],
                    ['','@2. Europæiske debitorer', '@2. Europæiske debitorer']),$action='');
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
                    ['','0','@Straks'],
                    ['','8','@8 dage'],
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
  htm_RudeBund($pmpt='@Gem',$subm=true);
}

# Kaldes fra: [_debitor/page_DebitorOrdre.php] 
function Rude_Kontakter() {
  htm_Rude_Top($name='betaform',$capt='   '.tolk('@Kontakt info:'),$parms='page_Blindgyden.php',$icon='fas fa-phone-square',$klasse='panelWmax',__FUNCTION__,'','legeplads:lege-side#kontakt');
  Kontakt($posi=1, $kontakt='Anders', $titel, $telf, $mobil, $mail);
  Kontakt($posi=2, $kontakt='Andersine', $titel, $telf, $mobil, $mail);
  echo '<hr>';
  echo '<div class="centrer">'; htm_accept('@Opret Ny','@Opret en ny kontakt'); echo '</div>';
  htm_RudeBund($pmpt='@Gem rettelser',$subm=true,$title='@Gem evt. rettelser ovenfor');
}

# Kaldes fra: 
function Kontakt($posi, $kontakt, $titel, $telf, $mobil, $mail, $bemr='') {
  htm_FrstFelt('10%',0);
    htm_CombFelt($type='number', $name='posi',   $valu= $posi,   $labl='@Pos.',  $titl='@Position styrer rækkefølgen af posterne', $revi=true, $rows='', $width='45', $step='0.5');
  htm_NextFelt('40%');  
    htm_CombFelt($type='text',  $name='kontakt',$valu= $kontakt,$labl='@Kontakt person',  $titl='@Angiv Kontakt person',   $revi=true, $rows='',$width='45','','','Kont...');
  htm_NextFelt('40%');  
    htm_CombFelt($type='text',  $name='titel',  $valu= $titel,  $labl='@Titel',       $titl='@Angiv personens titel',   $revi=true, $rows='',$width='45','','','Titl...');
  htm_LastFelt('40%');
  htm_FrstFelt('50%',0);
    htm_CombFelt($type='text',  $name='telf',   $valu= $telf,   $labl='@Telefon',     $titl='@Angiv Telefon',             $revi=true, $rows='',$width='45','','','Tlf...');
  htm_NextFelt('50%');                                          
    htm_CombFelt($type='text',  $name='mobil',  $valu= $mobil,  $labl='@Mobil',       $titl='@Angiv Mobilnr. eller lokalnr', $revi=true, $rows='',$width='45','','','Mobil/lok...');  
  htm_LastFelt('10%');                                          
  htm_CombFelt(  $type='mail',  $name='mail',   $valu= $mail,   $labl='@E-mail',      $titl='@Angiv E-mail',          $revi=true, $rows='','','','','Mail...');
  htm_CombFelt(  $type='area',  $name='bemr',   $valu= $bemr,   $labl='@Bemærkning',  $titl='@Angiv bemærkning til kontakten',  $revi=true, $rows='','','','','Note...');
  htm_nl();
  echo '<div class="centrer">'; htm_accept('@Slet','@Fjern denne kontakt person'); echo '</div>';
  echo '<hr color="green">';
}

# Kaldes fra:  [_debitor/page_DebitorOrdre.php] 
function Rude_Fakturering(&$navn, &$addr, &$sted, &$ponr, &$by, &$land, &$noter, &$telf, &$att, &$email, &$usemail, &$faktdato) {global $ØRudeForm;
  htm_Rude_Top($name='faktform',$capt='@Kunde - Fakturering:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelWmax',__FUNCTION__,'','legeplads:lege-side#fakturerings_oplysninger');
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
  // $ØRudeForm=true;
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='');
}

# PROGRAM-MODUL; Sammensatte Ruder! = "Vindue".
# Kaldes fra:  [_debitor/page_Opretordre.php] 
function Rude_Opretordre($kundeRec=[],$vareRec=[],$leverRec=[]) {global $ØRudeForm;
  htm_Rude_Top($name='ordrform',$capt='@Opret ordre:',$parms='page_Blindgyden.php',$icon='fas fa-plus','panelW110',__FUNCTION__,'','legeplads:lege-side#find_din_kunde_i_debitorlisten');
  $ØRudeForm=false;   // Undlad form i ruder herefter:
    Rude_DebitorKort();
  //echo '<br/>';
  SpalteTop(700);
  htm_Caption('@Husk at gemme med den gule knap nederst, når data er tilføjet/ændret !');
  htm_Rammestart($Caption='',$bor='0px');
    Rude_YdelserWide($Ordnr=':',$data=array(1,2,3),$fakt=false);
  htm_Rammeslut();
  NextSpalte(240);
    Rude_Levering($somfakt=true, $navn='', $addr='', $sted='', $ponr='', $by='', $land='', $telf='', $kont='', $email='', $forsend='', $noter='', $afsendt='', $levdato='');
  SpalteBund();
  $ØRudeForm=true;  //  Herefter submit af fælles form
  htm_RudeBund($pmpt='@Opret ordre',$subm=true,$title='@Gem data i denne rude.');
  
  PanelMin(3);    //  Betingelser
  PanelMin(4);    //  Kontakt info
  PanelMin(5);    //  Mail-faktura
  PanelMin(7);    //  Extrafelter
  //PanelMin(9);    //  Levering
  // PanelBetjening();
}

# Kaldes fra:  [_debitor/page_DebitorOrdre.php] 
function Rude_Ordreinfo(&$valuta, &$vorref, &$afdel, &$ordrdato, &$genfdato, &$godkendt, &$optlist) {
$optlist= array(['','DKK','DKK'],['','AED','AED'],['','EUR','EUR'],['','USD','USD']);
  htm_Rude_Top($name='ordrform',$capt='@Ordreinfo:',$parms='page_Blindgyden.php',$icon='fas fa-euro-sign','panelWmax',__FUNCTION__);
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
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem data i denne rude.');
}

# Kaldes fra:  [_debitor/page_DebitorOrdre.php] 
function Rude_Levering( &$somfakt, &$navn, &$addr, &$sted, &$ponr, &$by, &$land, &$telf, &$kont, &$email, &$forsend, &$noter, &$afsendt, &$levdato) {
  //if ($onPanel) 
  htm_Rude_Top($name='leveform',$capt='@Levering:',$parms='page_Blindgyden.php',$icon='fas fa-truck','panelW320',__FUNCTION__,'','legeplads:lege-side#leverings_oplysninger');
  htm_CheckFlt($type='checkbox',$name='somfakt',      $valu= $somfakt,  $labl='@Leveres til faktura-adresse', $titl='@Afmærk her, hvis leverings adresse er den samme som faktura adresse',  $revi=true);
  htm_CombFelt($type='text',    $name='levnavn',      $valu= $navn,     $labl='@Modtager navn',               $titl='@Angiv Modtager Navn',                   $revi=true, '','','','',$plho='Navn..');
  htm_CombFelt($type='text',    $name='levaddr1',     $valu= $addr,     $labl='@Leverings adresse',           $titl='@Angiv Leverings Adresse',               $revi=true, '','','','',$plho='Addr..');
  htm_CombFelt($type='text',    $name='sted',         $valu= $sted,     $labl='@Leverings Sted',              $titl='@Angiv Leverings Sted, suplement til adresse', $revi=true);
  htm_FrstFelt('25%');                                                                                                  
    htm_CombFelt($type='text',  $name='levpostnr',    $valu= $ponr,     $labl='@Postnr',                      $titl='@Angiv Leverings Kunde postnr',          $revi=true, '','','','',$plho='Pnr..');
  htm_NextFelt('75%');                                                                                                  
    htm_CombFelt($type='text',  $name='levby',        $valu= $by,       $labl='@Leverings by',                $titl='@Angiv Leveringsstedets Bynavn',         $revi=true, '','','','',$plho='By..');
  htm_lastFelt();                                                                                                       
  htm_CombFelt($type='text',    $name='land',         $valu= $land,     $labl='@Leverings Land',              $titl='@Angiv Leverings Land',                  $revi=true);
  htm_CombFelt($type='text',    $name='levtelf',      $valu= $telf,     $labl='@Telefon(er)',                 $titl='@Angiv Modtagers Telefon',               $revi=true, '','','','',$plho='Telf..');
  htm_CombFelt($type='text',    $name='levkont',      $valu= $kont,     $labl='@Kontaktperson',               $titl='@Angiv Kontaktpersons Navn',             $revi=true);
  htm_CombFelt($type='mail',    $name='levemail',     $valu= $email,    $labl='@Modtagerens Email adresse',   $titl='@Angiv Modtagers Email adresse',         $revi=true);
  htm_CombFelt($type='text',    $name='forsendelse',  $valu= $forsend,  $labl='@Fragtmetode)',                $titl='@Angiv Forsendelses oplysninger',        $revi=true);
  htm_CombFelt($type='area',    $name='levnoter',     $valu= $noter,    $labl='@Noter til fragtmand',         $titl='@Angiv Noter til fragtmand',             $revi=true, $rows='1','','','',$plho='Noter..');
  htm_FrstFelt('50%');
    htm_CheckFlt($type='checkbox',$name='afsendt',    $valu= $afsendt,  $labl='@Afsendt',                     $titl='@Afmærk her når varen/ydelsen er afsendt', $revi=true);
  htm_NextFelt('50%');  
    htm_CombFelt($type='date',$name='levdato',        $valu= $levdato,  $labl='@Leverings Dato',              $titl='@evt. forsendelses dato',                $revi=true);
  htm_LastFelt();
  //if ($onPanel) 
  htm_RudeBund($pmpt='@Gem',$subm=true);
}

# Kaldes fra:  [_debitor/page_DebitorOrdre.php] 
function Rude_Ekstrafelter(&$felt1, &$felt2, &$felt3, &$felt4, &$felt5, $custFelt= array(
// [Label,          Hint,                  Placeholder  ]
  ['@Ordre Felt 1','@Udfyld Ordre Felt 1','@Felt 1...'],
  ['@Ordre Felt 2','@Udfyld Ordre Felt 2','@Felt 2...'],
  ['@Ordre Felt 3','@Udfyld Ordre Felt 3','@Felt 3...'],
  ['@Ordre Felt 4','@Udfyld Ordre Felt 4','@Felt 4...'],
  ['@Ordre Felt 5','@Udfyld Ordre Felt 5','@Felt 5...'])
) {
  htm_Rude_Top($name='feltform',$capt='@Ekstrafelter:',$parms='page_Blindgyden.php',$icon='fas fa-plus','panelWmax',__FUNCTION__,'','legeplads:lege-side#ekstrafelter');
  htm_CombFelt($type='text',$name='felt1',  $valu= $felt1,  $labl= tolk($custFelt[0][0]),  $titl= tolk($custFelt[0][1]), $revi=true,'','','','',  $plho= tolk($custFelt[0][2]));
  htm_CombFelt($type='text',$name='felt2',  $valu= $felt2,  $labl= tolk($custFelt[1][0]),  $titl= tolk($custFelt[1][1]), $revi=true,'','','','',  $plho= tolk($custFelt[1][2]));
  htm_CombFelt($type='text',$name='felt3',  $valu= $felt3,  $labl= tolk($custFelt[2][0]),  $titl= tolk($custFelt[2][1]), $revi=true,'','','','',  $plho= tolk($custFelt[2][2]));
  htm_CombFelt($type='text',$name='felt4',  $valu= $felt4,  $labl= tolk($custFelt[3][0]),  $titl= tolk($custFelt[3][1]), $revi=true,'','','','',  $plho= tolk($custFelt[3][2]));
  htm_CombFelt($type='text',$name='felt5',  $valu= $felt5,  $labl= tolk($custFelt[4][0]),  $titl= tolk($custFelt[4][1]), $revi=true,'','','','',  $plho= tolk($custFelt[4][2]));
  htm_RudeBund($pmpt='@Gem',$subm=true);
}

# Kaldes fra:  [_debitor/page_DebitorOrdre.php] 
function Rude_Mailfaktura(&$emne, &$text, &$vedhft) {
  htm_Rude_Top($name='mailform',$capt='@Mail faktura:',$parms='page_Blindgyden.php',$icon='fas fa-envelope','panelWmax',__FUNCTION__,'','legeplads:lege-side#yderligere_oplysninger');
  htm_CombFelt($type='text',$name='emne',   $valu= $emne,   $labl='@Mail emne',   $titl='@Angiv Mail emne',     $revi=true,'','','','',         $plho='Vedr...');
  htm_CombFelt($type='area',$name='text',   $valu= $text,   $labl='@Mail tekst',  $titl='@Angiv Mail tekst',    $revi=true, $rows='2','','','', $plho='Besked...');
  htm_CombFelt($type='text',$name='vedhft', $valu= $vedhft, $labl='@Mail bilag',  $titl='@Angiv Vedhæftet fil', $revi=true,'','','','',         $plho='Bilag...');
  htm_RudeBund($pmpt='@Gem',$subm=true);
}

# Kaldes fra:  [_debitor/page_DebitorOrdre.php] [_debitor/page_Opretordre.php] [_debitor/page_Ordreliste.php] 
function Rude_Ydelser($Ordnr='',$fakt) {
  htm_Rude_Top($name='yderform',$capt=tolk('@Leverancer:').' '.$Ordnr.' <small>(Smal-format)</small>',$parms='page_Blindgyden.php',$icon='fas fa-shopping-cart','panelW320',__FUNCTION__);
  Varelinie($posi=1,$varenr="45-876",$antal=1,$enhed="stk",$beskriv="Redekasser",$momssats=25,$pris=235.50,$rabat=20, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);
  Varelinie($posi=2,$varenr="45-876",$antal=2,$enhed="stk",$beskriv="Redekasser",$momssats=25,$pris=235.50,$rabat=20, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);
  Varelinie($posi=3,$varenr="45-877",$antal=3,$enhed="stk",$beskriv="Redekasser",$momssats=25,$pris=245.00,$rabat=20, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);
  Varelinie($posi=4,$varenr="45-876",$antal=3,$enhed="stk",$beskriv="Redekasser",$momssats=25,$pris=235.50,$rabat=20, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);
  htm_Caption('@Status: ');
  htm_CheckFlt($type='checkbox', $name='fakt', $valu= $fakt, $labl='@Er Faktureret og låst',$titl='@Når ordren er faktureret, afmærkes feltet automatisk',$revi=false,$more='',$nl='');
  textKnap($label='@Opret Ny',  $title='@Opret ny varepostering', $link='../_base/page_Blindgyden.php');
  htm_RudeBund($pmpt='@Gem',$subm=true);
}

# Kaldes fra:  [_debitor/page_DebitorOrdre.php] 
function Rude_YdelserWide($Ordnr='',$fakt) {
  echo '<div class="clearWrap"/>';  echo '<PanlFoot>';
  //if ($onPanel) 
  htm_Rude_Top($name='linkform',$capt=tolk('@Leverancer på ordren').' '.$Ordnr.' ',$parms='page_Blindgyden.php',$icon='fas fa-shopping-cart','panelWmax',__FUNCTION__,'',  $more='','legeplads:lege-side#leverancer_pa_ordren'); //[ style= "height:350px" ]
    VarelinieWide($posi=1, $varenr='45-876', $antal=3, $enhed='stk', $beskriv='Redekasser', $momssats=25, $pris=235.50, $rabat=8, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);     
    VarelinieWide($posi=2, $varenr='45-876', $antal=2, $enhed='stk', $beskriv='Redekasser', $momssats=25, $pris=235.50, $rabat=8, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);     
    VarelinieWide($posi=3, $varenr='45-876', $antal=3, $enhed='stk', $beskriv='Redekasser', $momssats=25, $pris=235.50, $rabat=12, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);
    #,"45-876","3","stk","Redekasser","25","235,50","8",(3*235.5)*92/100*125/100
  htm_Caption('@Status: ');
  htm_CheckFlt($type='checkbox', $name='fakt', $valu= $fakt, $labl='@Er Faktureret og låst',$titl='@Når ordren er faktureret, afmærkes feltet automatisk',$revi=false,$more='',$nl='');
  htm_nl();
  htm_Plaintxt('@TIP angående Beløbsrabat:');  htm_Plaintxt('@Angiv en mindre enhedspris, og 0% rabat, så beregnes en %-rabat svarende til pris-rabatten.');
  htm_hr();
  textKnap($label='@Tilføj Ny varepost',  $title='@Opret ny varepostering', $link='../_base/page_Blindgyden.php');
  //if ($onPanel) 
  htm_RudeBund($pmpt='@Gem',$subm=true);
  echo '</PanlFoot>'; 
}

# Kaldes fra:  [_debitor/page_Opretordre.php] [_debitor/page_Ordreliste.php] 
function Rude_YdelserTabl($Ordnr='',$data,$fakt,$TopLine) {
#+  echo '<div class="clearWrap"/>';  echo '<PanlFoot>';
  htm_Rude_Top($name='linkform',$capt=tolk('@Leverancer på salgsordren').' '.$Ordnr.' ',$parms='page_Blindgyden.php',$icon='fas fa-shopping-cart','panelWmax',__FUNCTION__);
  htm_Caption($TopLine);
  htm_TabelInp(
    $HeadLine= array(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
 //     ['@Kladde notat:', '60%','left','text', '@Her kan skrives en bemærkning til kladden',                  '@Angiv din tekst...'], 
 //     ['@Konto-kontrol:','5em','left','text', '@Angiv kontonummer for den konto, hvis bevægelser skal kontrolleres',  '@Nummer...'], 
    ),
    $RowPref= array( #  ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:disp! ', '4:ColTip', '5:disp! ']  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
//          ['PDF',     '3%','center','text','<a href='.$link.'><img src=../_assets/icons/'.$clip.'  alt="Clips" height="20" width="12" border=0 title="'.tolk($title).
//              '"></a>',tolk('@I denne kolonne håndterer du PDF-bilag, som er tilknyttet den enkelte postering.'),'placeh']
          ),
    $RowBody= array( # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:placeholder'],
      ['@Pos..',         '5%','text',  'left',  tolk('@Pos. nr tildeles automatisk'),tolk('...pos...')],
      ['@Varenr',        '8%','text',  'center',tolk('@Varenummer for ydelsen'),tolk('Varenr...')],
      ['@Antal',         '5%','right', 'right', tolk('@Mængden angivet som antal').' ',tolk('@Antal...')],
      ['@Enhed',         '8%','text',  'left',  tolk('@Enheds betegnelse').' ',tolk('@Enh...')],
      ['@Beskrivelse',  '45%','text',  'left',  tolk('@Beskrivelse af varen/ydelsen').' ',tolk('@Besk...')],
      ['@Momssats',      '5%','text',  'center',tolk('@Moms pct.sats').' ',tolk('@Moms...')],
      ['@À pris',        '8%','text',  'center',tolk('@Enhedspris').' ',tolk('@Pris...')],
      ['@Rabat',         '8%','text',  'center',tolk('@Rabat procent'),tolk('@Rabat...')],
//      ['@Ialt',         '8%','tal2d','right' ,tolk('@Kalkuleret beløb for den aktuelle postering. ')],
//      ['@Valuta',       '4%','text','center',tolk('@Valutakode for den valuta, som er benyttet på bilaget.'),'DKK'],
//      ['@Forfald',      '9%','date','center',tolk('@Beløbets forfalds dato').'forf.dato'],
      ),
    $RowSuff= array(  # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:value!     ']
        ['@Ialt',       '8%','tal2d','right', #'0.000,00<div type= "text" name="saldo" value="00.000,00" width="8%"/>',
          tolk('@Bevægelser og saldo for den konto, som er angivet ovenfor i Felt: Konto-kontrol.').' <br>'.
          tolk('@Er velegnet til afstemning med bank- og girokonti'),'.calc...']
        ),
        $data= array(1,2,3,4,5,6),  # Antal rows ved DEMO
    $ViewHeight='',
    $PadTop='0px'
  );
  htm_Caption('@Status: ');
  htm_CheckFlt($type='checkbox', $name='fakt', $valu= $fakt, $labl='@Er Faktureret og låst', $titl='@Når ordren er faktureret, afmærkes feltet automatisk',$revi=false);
  htm_hr();
  htm_CentrOn();
  textKnap($label='<= '.tolk('@Vis forrige ordre nr.'),  $title='@Se forrige ordre', $link='../_base/page_Blindgyden.php');
  textKnap($label=tolk('@Vis næste ordre nr.').' =>',   $title='@Se næste ordre', $link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_RudeBund($pmpt='@Gem',$subm=true);
#+  echo '</PanlFoot>'; 
}

# PROGRAM-MODUL;
# Kaldes fra: 
function Varelinie(&$posi, &$varenr, &$antal, &$enhed, &$beskriv, &$momssats, &$pris, &$rabat, &$ialt) {
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

# PROGRAM-MODUL;
# Kaldes fra: 
function VarelinieWide( &$posi, &$varenr, &$antal, &$enhed, &$beskriv, &$momssats, &$pris, &$rabat, &$ialt) {
  htm_FrstFelt('05%');  htm_CombFelt($type='text',  $name='posi',     $valu= $posi,     $labl='@Pos.',        $titl='@Position styrer rækkefølgen af posterne', $revi=true, $rows='',$width='45',$step='1');
  htm_NextFelt('08%');  htm_CombFelt($type='text',  $name='varenr',   $valu= $varenr,   $labl='@Varenr',      $titl='@Angiv varenr',                $revi=true, $rows='',$width='45');
  htm_NextFelt('05%');  htm_CombFelt($type='tal1d', $name='antal',    $valu= $antal,    $labl='@Antal',       $titl='@Angiv Antal',                 $revi=true, $rows='',$width='45',$step='0.25');
  htm_NextFelt('08%');  htm_CombFelt($type='text',  $name='enhed',    $valu= $enhed,    $labl='@Enhed',       $titl='@Enhed udfyldes automatisk',   $revi=false,$rows='',$width='45');
  htm_NextFelt('35%');  htm_CombFelt($type='area',  $name='beskriv',  $valu= $beskriv,  $labl='@Beskrivelse', $titl='@Angiv beskrivelse af ydelsen',$revi=true, $rows='2');
  htm_NextFelt('07%');  htm_CombFelt($type='tal2d', $name='momssats', $valu= $momssats, $labl='@Moms%',       $titl='@Momssats for ydelsen',        $revi=true, $rows='', $width='45',$step='0.5');
  htm_NextFelt('08%');  htm_CombFelt($type='tal2d', $name='pris',     $valu= $pris,     $labl='@Pris',        $titl='@Angiv enhedspris',            $revi=true, $rows='', $width='45',$step='0.25');
  htm_NextFelt('05%');  htm_CombFelt($type='tal1d', $name='rabat',    $valu= $rabat,    $labl='@Rabat%',      
          $titl='@Angiv rabatsats i %, eller angiv 0% og en reduceret enhedspris, hvis der skal ydes en beløbs rabat',    $revi=true, $rows='', $width='45',$step='0.25');
  htm_NextFelt('09%');  htm_CombFelt($type='tal2d', $name='ialt',     $valu= $ialt,     $labl='@Linie ialt',  $titl='@Beregnet felt: ialt',         $revi=false,$rows='', $width='45',$step='0.25');
  htm_LastFelt();
}

# PROGRAM-MODUL;
# Kaldes fra: 
function Rude_Tabel($TablData=array()) {
  htm_Rude_Top($name= 'naviform',$capt= '@DEMO: Tabel med fastlåst kolonne-header og "rulle-vindue"',$parms='page_Blindgyden.php',$icon='fas fa-database','panelWmax',__FUNCTION__);
  htm_TabelOut($RowLabl='@se ordre',$RowBody= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]  
            ['@Lb.Nr.',     '6%','','','','','..auto..'],
            ['@Ordre dato', '7%','','date', 'left',   '', 'åååå-mm-dd'],
            ['@Lev. dato',  '7%','','date', 'left',   '', 'åååå-mm-dd'],
            ['@Konto nr.',  '6%','','text', 'center', '', tolk('@Kont...')],
            ['@Firma navn','24%','','',     '',       '', tolk('@Firm...')],
            ['@Sælger',     '8%','','',     '',       '', tolk('@Sælg...')],
            ['@Ordre sum',  '6%','','',     '',       '', tolk('@Beløb...')]),
          $TablData= array( # DemoData:
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
          ) , $doFilter=true, $doSort=true, $CreateRec=true, $ModifyRec=true);
  htm_RudeBund($pmpt='@Gem',$subm=false);
}

# PROGRAM-MODUL;
# Kaldes fra: 
function Rude_Debitorer($TablData=array()) {
  htm_Rude_Top($name= 'naviform',$capt= '@Konti - Debitorer:',$parms='page_Blindgyden.php',$icon='fas fa-database','panelWmax',__FUNCTION__,'','legeplads:lege-side#kunden');
  htm_TabelOut($RowLabl='@se debitor',$RowBody= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
            ['@Kontonr.',   '6%','','','','','..auto..'],
            ['@Kundenavn', '10%','','','','','Firm...'],
            ['@Adresse',    '8%','','','','','Addr...'],
            ['@Sted',       '8%','','','','','Sted...'],
            ['@Postnr',     '4%','','','','','Post...'],
            ['@By',         '8%','','','','','By...'],
            ['@Kontakt',   '12%','','','','','Kont...'],
            ['@Telefon',   '12%','','','','','Telf...'],
            ['@Sælger',    '12%','','','','','Sælg...']),
            $TablData= array( # DemoData:
            ['1025','Firmanavn','Adresse','Sted','Postnr','By','Kontakt','Telefon','Sælger'],
            ['1026','Firmanavn','Adresse','Sted','Postnr','By','Kontakt','Telefon','Rip'],
            ['1027','Firmanavn','Adresse','Sted','4560','By','Kontakt','Telefon','Rap'],
            ['1028','Firmanavn','Adresse','Sted','Postnr','By','Kontakt','Telefon','Rup']
            ) );
  htm_RudeBund($pmpt='@Gem',$subm=false);
}

# Kaldes fra:  [_debitor/page_Debitor.php] 
function Rude_DebitorKort() { //  Sammensatte Ruder! = "Vindue".
  htm_Tapet_Top($name='menuform' ,$capt='@Debitorkort', $parms='page_Blindgyden.php', $icon='fa-database', $klasse='panelWmax',__FUNCTION__,'','konti1');
  SpalteTop(320);
    Rude_Kunden($kontonr, $kategori, $cvrnr, $eannr, $bankreg, $bankkto, $instit, $ansv, $formsprog, $homeweb);           
    Rude_Betingelser($debigrup, $betaling, $frist, $print2, $kunderef);     
  NextSpalte();
    Rude_Kontakter();   
    Rude_Mailfaktura($emne, $text, $vedhft);    
  NextSpalte();
    Rude_Fakturering ($navn='Anders And', $addr='Andedammen 34', $sted='Ved Lunden', $ponr='1234', $by='Eventyrland', $land='Eventyrland', 
                      $noter='Levering på anden adresse!', $telf='045 12345678', $att='Rap', $email='anders@and.dk', $usemail='', $faktdato);   
    Rude_Ekstrafelter($felt1, $felt2, $felt3, $felt4, $felt5, $custFelt= array(
// [Label,          Hint,                    Placeholder  ]
  ['@Ordre Felt 1','@Ordre - Udfyld Felt 1','@Ord. Felt 1...'],
  ['@Ordre Felt 2','@Ordre - Udfyld Felt 2','@Ord. Felt 2...'],
  ['@Ordre Felt 3','@Ordre - Udfyld Felt 3','@Ord. Felt 3...'],
  ['@Ordre Felt 4','@Ordre - Udfyld Felt 4','@Ord. Felt 4...'],
  ['@Ordre Felt 5','@Ordre - Udfyld Felt 5','@Ord. Felt 5...'])
);    

  SpalteBund();
  htm_KnapGrup('@Ekstra:',true,false);
  textKnap($label='@Opret ny erhvervskunde',  $title='@Opret ny erhvervs debitor, ved at hente oplysninger i CVR-registret', $link='../_base/page_Blindgyden.php');
  htm_KnapGrup('@Ekstra:',false);
  htm_nl();
  
  PanelMin(3);    //  Betingelser
  PanelMin(4);    //  Kontakt info
  PanelMin(5);    //  Mail faktura
  PanelMin(7);    //  Extra felter
  // PanelBetjening();
  htm_TapetBund();
}

# Kaldes fra:  [_kreditor/page_Kreditor.php] [_kreditor/page_Ordreliste.php] 
function Rude_Kreditorer($TablData=array()) {
  htm_Rude_Top($name= 'naviform',$capt= '@Konti - Kreditorer:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-database ','panelWmax',__FUNCTION__,'','konti1');
  htm_TabelOut($RowLabl='@se kreditorkort',$RowBody= array(   #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
            ['@Kontonr.',         '6%','','','','@Kreditor konto nummer', '..auto..'],
            ['@Leverandør Navn', '15%','','','','@Adressat navn',         tolk('@Navn...')],
            ['@Adresse',         '12%','','','','@Postadresse',           tolk('@Addr...')],
            ['@Sted',            '12%','','','','@Suplement til adresse', tolk('@Sted...')],
            ['@Post',             '5%','','','','@Post nr',               tolk('@Post...')],
            ['@By',              '18%','','','','@Bynavn',                tolk('@By...')],
            ['@Kontakt person',  '10%','','','','@Tilknyttet navn',       tolk('@Kont...')],
            ['@Telefon',         '10%','','','','@Kontakt telefon',       tolk('@Telf...')]),
            $TablData= array( # DemoData:
            ['1025','Navn','Adresse','Sted','Post nr','By','Kontakt person','Telefon'],
            ['1026','Navn','Adresse','Sted','Post nr','By','Kontakt person','Telefon'],
            ['1027','Navn','Adresse','Sted','Pnr',    'By','Kontakt person','Telefon'],
            ['1028','Navn','Adresse','Sted','Post nr','By','Kontakt person','Telefon']
            ) );
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
}

//   Sammensatte Ruder! = "Væg med tapet".
# Kaldes fra:  [_kreditor/page_Kreditor.php] 
function Rude_KreditorKort($kontonr, $kategori, $cvrnr, $eannr, $bankreg, $bankkto, $instit, $ansv, $formsprog, $homeweb,
    $navn='', $addr='', $sted='', $ponr='', $by='', $land='', $noter='', $telf='', $att='', $email='', $usemail='', $faktdato='',  //  Adresse
       //  Kontakter
    $felt1='', $felt2='', $felt3='', $felt4='', $felt5=''   //  Ekstrafelter
) {//  Parametre mangler for: Kontakter, Ekstrafelter
  htm_Tapet_Top($name='menuform', $capt='@Kreditorkort', $parms='page_Blindgyden.php', $icon='fa-database', $klasse='panelWmax',__FUNCTION__);
  SpalteTop(320);
    Rude_Leverandor($kontonr, $kategori, $cvrnr, $eannr, $bankreg, $bankkto, $instit, $ansv, $formsprog, $homeweb);           
    Rude_Ekstrafelter($felt1, $felt2, $felt3, $felt4, $felt5, $custFelt= array(  #+ LeverandørNr. Hjemmeside  Betalingsbetingelser  Kreditorgruppe
// [Label,             Hint,                       Placeholder  ]
  ['@Levering Felt 1','@Levering - Udfyld Felt 1','@Lev. Felt 1...'],
  ['@Levering Felt 2','@Levering - Udfyld Felt 2','@Lev. Felt 2...'],
  ['@Levering Felt 3','@Levering - Udfyld Felt 3','@Lev. Felt 3...'],
  ['@Levering Felt 4','@Levering - Udfyld Felt 4','@Lev. Felt 4...'],
  ['@Levering Felt 5','@Levering - Udfyld Felt 5','@Lev. Felt 5...'])
);    
  NextSpalte();
  Rude_Adresse($navn='Anders And', $addr='Andedammen 34', $sted='Ved Lunden', $ponr='1234', $by='Eventyrland', $land='Eventyrland', 
                      $noter='', $telf='045 12345678', $att='Rap', $email='anders@and.dk', $usemail='', $faktdato);   
  NextSpalte();
    //  Rude_Betingelser($debigrup, $betaling, $frist, $print2, $kunderef);     
    Rude_Kontakter();  #+ Bemærkning 
    //  Rude_Mailfaktura($emne, $text, $vedhft);    
  
  SpalteBund();
  PanelMin(3);    //  Ekstra felter
  // PanelBetjening();
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

# PROGRAM-MODUL;
# Kaldes fra: 
function Rude_Adresse($navn, $addr, $sted, $ponr, $by, $land, $noter, $telf, $att, $email, $usemail, $addrdato, $erhv=true) {
  htm_Rude_Top($name='faktform',$capt='@Leverandør - Adresse:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelWmax',__FUNCTION__,'','');
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
    htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem data overnfor, såfremt de er redigeret');
    else htm_RudeBund($pmpt='@Fakturér',$subm=true,$title='@Fakturer og udskriv til den under {Betingelser}, valgte udskriver!');
}


# Kaldes fra:  [_kreditor/page_Ordreliste.php] 
function Rude_KredOrdrer($TablData=array()) {
  htm_Rude_Top($name= 'naviform',$capt= '@Ordrer: Kreditorer - `Leverandørordrer`:',$parms='page_Blindgyden.php',$icon='fas fa-database','panelWmax',__FUNCTION__);
  htm_TabelOut($RowLabl='@se leverandørordre',$RowBody= array(#   [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
            ['@Ordre nr.',  '6%','','',     '',       '@Ordre nummer','..auto..'],
            ['@Modt.nr.',   '5%','','',     '',       '@Modtager nummer','Modt...'],    
            ['@Fakt.nr.',   '6%','','',     '',       '@Faktura nummer','Fakt...'],
            ['@Ordre dato', '7%','','date', '',       '@Datoen for ordrens registrering','åååå-mm-dd'],
            ['@Modt.dato',  '7%','','date', '',       '@Datoen for ordrens modtagelse','åååå-mm-dd'],
            ['@Konto nr.',  '8%','','',     '',       '@Konto nummer','Kont...'],
            ['@Firma navn','30%','','',     '',       '@Firmaets navn','Navn...'],
            ['@Telefon',    '6%','','',     'center', '@Firmaets telefon nummer','Telf...'],
            ['@Leveres til','6%','','',     'left',   '@Leveres til','Lev...'],
            ['@Vor ref.',   '5%','','',     'left',   '@Vores referance','Ref...'],
            ['@Projekt',    '5%','','',     'left',   '@Angiv evt. projekt nummer','Proj...'],
            ['@Faktura sum','8%','','',     'right',  '@Netto sum på fakturaen. Moms tillægges først, når der faktureres.','Beløb...']),
            $TablData= array( # DemoData:
            ['1025','Modt.nr.','Fakt.nr.','Ordre dato','Modt.dato','Konto nr.','Firma navn','Telefon','Leveres til','Vor ref.','Projekt','Faktura sum'],
            ['1026','Modt.nr.','Fakt.nr.','Ordre dato','Modt.dato','Konto nr.','Firma navn','Telefon','Leveres til','Vor ref.','Projekt','Faktura sum'],
            ['1027','Modt.nr.','Fakt.nr.','Ordre dato','Modt.dato','Konto nr.','Firma navn','Telefon','Leveres til','Vor ref.','Projekt','Faktura sum'],
            ['1028','Modt.nr.','Fakt.nr.','Ordre dato','Modt.dato','Konto nr.','Firma navn','Telefon','Leveres til','Vor ref.','Projekt','Faktura sum']
            ) );
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
}

# Kaldes fra:  [_kreditor/page_Ordreliste.php] 
function Rude_LevBestilling() {
  htm_Tapet_Top($name= 'naviform',$capt= '@Bestilling - `Leverandørordre`:',$parms='page_Blindgyden.php',$icon='fas fa-list','panelW110',__FUNCTION__);
  
  SpalteTop(240);
  htm_Rude_Top($name= '',$capt= '@Kreditor:',$parms='',$icon='fas fa-pen-square','panelW240',__FUNCTION__);
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
  htm_RudeBund($pmpt='@Gem',$subm=false,$title='');
  
  NextSpalte(320);
  htm_Rude_Top($name= '',$capt= '@Detaljer:',$parms='',$icon='fas fa-pen-square','panelW320',__FUNCTION__,'');
  htm_KnapGrup('',true,false);
    textKnap($label='@Importer OIOUBL faktura',    $title='@Klik her for at importere en elektronisk faktura af typen oioubl', $link='../_base/page_Blindgyden.php');    
  htm_KnapGrup('',false);
  
  htm_hr();
  htm_FrstFelt('50%');  htm_CombFelt(                      $type='text',  $name='cvrnr',      $valu= $cvrnr,      $labl='@CVR',         
          $titl='@CVR - Virksomheds ID. Tast CVR-nr. omsluttet af *, +, eller / for at importere data fra Erhvervsstyrelsen (Data leveres af CVR API)', $revi=true);
  htm_NextFelt('50%');  htm_CombFelt($type='tal2d', $name='momssats', $valu= $momssats, $labl='@Moms %-sats',     $titl='@Momssats for ydelsen',    $revi=true, $rows='', $width='45',$step='0.25');
  htm_LastFelt();
  htm_FrstFelt('50%');  htm_CombFelt($type='date', $name='ordrdate', $valu= $ordrdate,    $labl='@Ordre dato',        $titl='@Angiv dato',          $revi=true, $rows='', $width='',$step='');
  htm_NextFelt('50%');  htm_CombFelt($type='date', $name='levrdate', $levrdate= $pris,    $labl='@Leverings dato',    $titl='@Angiv dato',          $revi=true, $rows='', $width='');
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
  htm_nl();
  htm_CheckFlt($type='checkbox',$name='godk',$valu='godk',  $labl='@Godkend', $titl='@Afmærk her, når bestillingen kan godkendes.',  $revi=true);
  htm_RudeBund($pmpt='@Gem',$subm=false,$title='');
  
  NextSpalte(240);
  htm_Rude_Top($name= '',$capt= '@Levering:',$parms='',$icon='fas fa-truck','panelW240',__FUNCTION__,'');
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
  htm_RudeBund($pmpt='@Gem',$subm=false,$title='','',$simu=true);
  
  SpalteBund(); 
  
  SpalteTop(960);
  htm_Rude_Top($name= '',$capt= '@Bestillings-poster:',$parms='page_Blindgyden.php',$icon='fas fa-list','panelW950',__FUNCTION__,'');
  htm_TabelInp(
    $HeadLine= array(
      ['@Status:', '60%','left','text', '@Her kan skrives en bemærkning til bestillingen', '@Ny bestilling, endnu ikke godkendt'], 
     // ['@Kundetilknytning:','5em','left','text', '@Angiv kontonummer på kunden','@Konto...'], 
    ),
    $RowPref= array(), # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:disp! ', '4:ColTip', '5:disp! '] #  array(['Link'],['Label'],['Tip'],['4%']),
    $RowBody= array(  # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:placeholder'],
      ['@Pos.',        '5%', 'text', 'left',tolk('@Position tildeles automatisk.').' ','Pos...'],
      ['@Varenr',      '7%', 'text', 'left',tolk('@Varenummer hentes fra vareregistret.'),'Vare...'],
      ['@Lev.varenr',  '7%', 'text', 'left',tolk('@Leverandørens varenummer.'),'Leve...'],
      ['@Antal',       '5%', 'text', 'left',tolk('@Mængden af den aktuelle leverance.').' ','Ant...'],
      ['@Enhed',       '5%', 'text', 'left',tolk('@Enhedsbeskrivelse af mængden'),'Enh...'],
      ['@Beskrivelse','45%', 'text', 'left',tolk('@Leverance beskrivlse'),'Beskr...'],
      ['@Pris',       '10%', 'tal2d','left',tolk('@Enhedspris'),'Pris...'],
      ['@Rabat%',      '6%', 'tal2d','left',tolk('@Rabatsats i %. Angiv 0% og en reduceret enhedspris, hvis der skal ydes en beløbs rabat'),'Rabat'],
      //['@Moms%',       '6%', 'tal2d','left',tolk('@Moms %-sats for den posterede leverance'),'Moms...'],
    # ['@Linie ialt', '10%', 'tal2d','left',tolk('@Beregnet beløb.')] tilføjes internt i htm_TabelInp
    ),
//  $RowSuff= array(['<a href='.$link.' onclick=\"return confirm($confm)\"><img src=../_assets/icons/clip.png  alt="Clips" height="80%" width="80%" border=0></a>'],  [])
    $RowSuff= array(  # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:value!     ']
       // ['@um.',       '5%','text','center',tolk('@um. (uden moms) kan benyttes til at bogføre beløb uden moms på konti, selvom kontoen har en momssats tilknyttet.'), 
       //                               '<input type= "checkbox" name="udenmoms" value="" >'],
        ['@Linie ialt','10%','text','center',tolk('@Beregnet felt med prisen af den aktuelle mængde.'), '00.000,00'],
        ['@Slet', '8%', 'text','center','@Klik på rødt kryds for at slette denne post','<ic class="far fa-times-circle" style="color:red; font-size:13px; "></ic>'],
        ), #'<div type= "text" name="saldo" value="00.000,00" width="8%">']),
    $data= array(1,2,3,4),  # Antal rows ved DEMO
    $ViewHeight= '500px',
    $PadTop='0px',
    $rowadd='@Opret ny post'
  );
 // Ordresum	0,00	Moms	0,00	I alt	0,00
  htm_FrstFelt('30%');
  htm_NextFelt('10%');  htm_CombFelt($type='text',  $name='osum', $valu= $osum,  $labl='@Ordresum', $titl='@Beregnet sum af linie-beløb', $revi=false, '','','','',$plho='0,00');
  htm_NextFelt('10%');  htm_CombFelt($type='text',  $name='moms', $valu= $moms,  $labl='@Moms',     $titl='@Beregnet moms',               $revi=false, '','','','',$plho='25%');
  htm_NextFelt('10%');  htm_CombFelt($type='text',  $name='ialt', $valu= $ialt,  $labl='@I alt',    $titl='@Brutto pris inclusive moms',  $revi=false, '','','','',$plho='0.000,00..');
  htm_NextFelt('30%');
  htm_LastFelt();
  htm_RudeBund($pmpt='@Gem',$subm=false,$title='','',$simu=true);
  
  SpalteBund(); 
  
  echo '<hr><div class="centrer" style="height:25px">';   htm_Accept($pmpt,$title,$width='',$akey); echo '</div>';
  //echo '</form>';
  htm_nl();
  htm_KnapGrup('@Her kan du:',true,false);
    textKnap($label='@Oprette Ny',  $title='@Opret ny bestilling',    $link='../_base/page_Blindgyden.php');
    textKnap($label='@Opslag',    $title='@Opslag af leverandører', $link='../_base/page_Blindgyden.php');    
    textKnap($label='@CSV-eksport',       $title='@CSV - Eksporter til kommasepareret fil, som kan indlæses i regneark.', $link='../_base/page_Blindgyden.php');
  htm_KnapGrup('',false);
  htm_TapetBund($formslut=true);
  htm_nl();
  PanelMin(4);    //  Detaljer
  // PanelBetjening();
}

# Kaldes fra: [_debitor/page_Debitor.php] 
function Rude_DebtDebitor($TablData=array()) {
  htm_Rude_Top($name= 'PanelForm',$capt= '@Debitorliste',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-database','panelWmax',__FUNCTION__,'','legeplads:lege-side#find_din_kunde_i_debitorlisten');
#   Luk  Debitorer   Historik Visning Ny
#   Kontonr Firmanavn Adresse Adresse 2 Postnr  By  Kontakt Telefon Sælger    OK
  htm_TabelOut($RowLabl='@se yderligere data på debitorkort nedenfor',$RowBody= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
            ['@Kontonr',   '7%','','','','','..auto..'],
            ['@Firmanavn','28%','','','','',tolk('@Navn...')],
            ['@Sted',     '20%','','','','',tolk('@Sted...')],
            ['@Postnr',    '6%','','','','',tolk('@Postnr...')],
            ['@By',       '15%','','','','',tolk('@By...')],
            ['@Kontakt',  '10%','','','','',tolk('@Kont...')],
            ['@Telefon',   '8%','','','','',tolk('@Telf...')],
            ['@Sælger',   '10%','','','','',tolk('@Sælg...')]),
            $TablData= array( # DemoData:
            ['1025','Firmanavn','Sted','Postnr','By','Kontakt','Telefon','Sælger'],
            ['1026','Firmanavn','Sted','Postnr','By','Kontakt','Telefon','Sælger'],
            ['1027','Firmanavn','Sted','Postnr','By','Kontakt','Telefon','Sælger'],
            ['1028','Firmanavn','Sted','Postnr','By','Kontakt','Telefon','Sælger']
            ),    $FilterOn=true,   $SorterOn=true,    $CreateRec=false,   $ModifyRec=true, $ViewHeight='200px' );
  htm_KnapGrup('@Her kan du:',true,false);
    textKnap($label='@Oprette Ny',    $title='@Opret ny debitor', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Se Historik', $title='@Historik for',     $link='../_base/page_Blindgyden.php');    
    textKnap($label='@Visning',     $title='@Bestem hvilke felter der skal vises i listen', $link='../_base/page_Blindgyden.php');
  htm_KnapGrup('',false);
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
}

# Kaldes fra:  [_debitor/page_Ordreliste.php] 
function Rude_DebtOrdrer(&$TablData) {
  htm_Rude_Top($name= 'PanelForm',$capt= '@Ordrer: Debitorer - `Salgsordrer`:',$parms= '../_base/page_Hovedmenu.php',$icon= 'fas fa-database','panelWmax',__FUNCTION__);
  htm_TabelOut($RowLabl='@vise kundeordre',$RowBody= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
            ['@Ordre nr.',  '6%','','',     '',       '','..auto..'],
            ['@Ordre dato', '7%','','date', 'left',   '','åååå-mm-dd'],
            ['@Lev. dato',  '7%','','date', 'left',   '','åååå-mm-dd'],
            ['@Konto nr.',  '6%','','text', 'center', '',tolk('@Kont...')],
            ['@Firma navn','20%','','',     '',       '',tolk('@Firm...')],
            ['@Sælger',     '8%','','',     '',       '',tolk('@Sælg...')],
            ['@Ordre sum',  '6%','','',     '',       '',tolk('@Beløb...')],
            ['@Status',     '6%','','',     '',       '',tolk('@Status...')]
            ),
            $TablData, 
            $FilterOn=true, $SortOn=true, $CreateRec=true, $ModifyRec=true, $ViewHeight='70px' );
  htm_nl();
  htm_KnapGrup('Handling:',true,false);
    textKnap($label='@Ny ordre',  $title='@Opret ny ordre', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Tilbud',    $title='@Opret Tilbud',     $link='../_base/page_Blindgyden.php');    
    textKnap($label='@Ordrer',    $title='@Ordrer', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Faktura',   $title='@Faktura', $link='../_base/page_Blindgyden.php');
    textKnap($label='@PBS',       $title='@PBS', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Import PBS',$title='@Import PBS', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Importer UBL til ordrer',    $title='@Importer UBL til ordrer', $link='../_base/page_Blindgyden.php');
  htm_KnapGrup('Handling:',false);
    htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
}

# Kaldes fra:  [_debitor/page_Rapport.php] 
function Rude_DebRapp(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {
  htm_Rude_Top($name= 'PanelForm',$capt= '@Debitor-rapporter:',$parms= '../_base/page_Hovedmenu.php',$icon= 'fas fa-chart-line','panelW320',__FUNCTION__);
    htm_FrstFelt('04%',0);  
    htm_NextFelt('36%');  htm_Prompt('@Vælg kriterier:','right');  //echo '<p align="center";>'.tolk('@Angiv kriterier:').'</p> ';
    htm_NextFelt('02%');  
    htm_NextFelt('58%');  htm_CheckFlt($type='checkbox',$name='somfakt',$valu='somfakt',
                          $labl='@Husk dem', $titl='@Afmærk her, hvis kriterier skal genbruges.',  $revi=true);
    htm_LastFelt();
  htm_FrstFelt('05%',0);  
  htm_NextFelt('48%');  htm_CombFelt($type='text',$name='konto',  $valu='', $labl='@Konto',     $titl='@Angiv rapporterings Konto', $revi=true);
  htm_NextFelt('47%');  htm_CombFelt($type='date',$name='dato',   $valu='', $labl='@Fra Dato',  $titl='@Angiv periode start Dato',  $revi=true);
  htm_LastFelt();
  htm_KnapGrup('@Vis:',true);
    textKnap($label='@Åbne poster',    $title='@Rapport for debitor åbne poster',     $link='../_base/page_Blindgyden.php',$akey='å');
    textKnap($label='@Konto saldo',    $title='@Rapport for debitor konto saldo',     $link='../_base/page_Blindgyden.php',$akey='s');    
    textKnap($label='@Konto kort',     $title='@Rapport for debitor konto kort',      $link='../_base/page_Blindgyden.php',$akey='k');
    textKnap($label='@Salgs statistik',$title='@Rapport for debitor Salgs statistik', $link='../_base/page_Blindgyden.php',$akey='t');
    textKnap($label='@Top 100',        $title='@Rapport for Top 100',                 $link='../_base/page_Blindgyden.php',$akey='1');
  htm_KnapGrup('@Vis:',false);
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
}

# Kaldes fra:  [_debitor/page_Rapport.php] [_finans/page_Kontrol.php] [_finans/page_Rapport.php] [_kreditor/page_Rapport.php] 
function Rude_Rapportliste() {
  htm_Rude_Top($name= 'rappform',$capt= '@Vis rapport:',$parms='../_base/page_Hovedmenu.php',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  htm_CentrOn(); 
    echo tolk('@Vælg rapport i det andet panel, og få vist resultatet her.').str_nl(3);
  htm_CentOff();
  htm_RudeBund($pmpt='@Gem',$subm=false);
}

# Kaldes fra:  [_kreditor/page_Rapport.php] 
function Rude_KredRapp(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {
  htm_Rude_Top($name= 'naviform',$capt= '@Kreditor-rapporter:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-chart-line','panelW320',__FUNCTION__);
    htm_FrstFelt('04%',0);  
    htm_NextFelt('36%');  htm_Prompt('@Vælg kriterier:','right');  //echo '<p align="center">'.tolk('@Angiv kriterier:').'</p> ';
    htm_NextFelt('02%');  
    htm_NextFelt('58%');  htm_CheckFlt($type='checkbox',$name='somfakt',$valu='somfakt',
                          $labl='@Husk dem', $titl='@Afmærk her, hvis kriterier skal genbruges.',  $revi=true);
    htm_NextFelt('05%');
    htm_LastFelt();
  htm_FrstFelt('0%',0); 
  htm_NextFelt('50%');  htm_CombFelt($type='text',$name='konto',  $valu='', $labl='@Konto',     $titl='@Angiv rapporterings Konto', $revi=true);
  htm_NextFelt('50%');  htm_CombFelt($type='date',$name='dato',   $valu='', $labl='@Fra Dato',  $titl='@Angiv periode start Dato',  $revi=true);
  htm_LastFelt();
  htm_KnapGrup('@Vis:',true);
    textKnap($label='@Åbne poster',    $title='@Rapport for kreditor åbne poster',    $link='../_base/page_Blindgyden.php',$akey='å');
    textKnap($label='@Konto saldo',    $title='@Rapport for kreditor konto saldo',    $link='../_base/page_Blindgyden.php',$akey='s');
    textKnap($label='@Konto kort',     $title='@Rapport for kreditor konto kort',     $link='../_base/page_Blindgyden.php',$akey='k');
    textKnap($label='@Købs statistik', $title='@Rapport for kreditor købs statistik', $link='../_base/page_Blindgyden.php',$akey='t');
  htm_KnapGrup('@Vis:',false);
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
}


# PROGRAM-MODUL;
# Kaldes fra: 
function Rude_KasseRedigering($id='2',$dato='Dato',$ejer='Bogholder',$bemr='Bemærkning 2',$bogf='Bogført',$af='Af') /* DEMO  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */
{global $ØbrwnColor,$ØBtNavBgrd, $ØIconStyle;
  $dkftip=  tolk('@D/K/F feltet benyttes i forbindelse med debitor- og kreditor posteringer.').' '.
            tolk('@Er feltet tomt eller udfyldt med F, betragtes det efterfølgende kontonummer som et Finans konto-nummer.').
            tolk('@Skrives der `d` eller `k`, vil det efterfølgende nummer blive tolket som et Debitor konto-nummer eller et Kreditor konto-nummer.');
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
  htm_Rude_Top($name= 'kasseform',$capt= tolk('@Kassekladde:').' '.$id.', <small>'.$ejer.'</small>',$parms='page_Blindgyden.php',$icon='fas fa-database','panelWmax',__FUNCTION__);
  htm_TabelInp(
    $HeadLine= array(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      ['@Kladde notat:', '60%','text','left', '@Her kan skrives en bemærkning til kladden',                  '@Angiv din bemærkning...'], 
      ['@Konto-kontrol:','5em','text','left', '@Angiv kontonummer for den konto, hvis bevægelser skal kontrolleres',  '@Nummer...'], 
    ),
    $RowPref= array( #  ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:disp! ', '4:ColTip', '5:disp! ']  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
//    ['PDF',     '3%','text','center','<a href='.$link.'><img src=../_assets/icons/'.$clip.'  alt="Clips" height="20" width="12" border=0 title="'.tolk($title).
      ['PDF',     '2%','text','center','<a href='.$link.'><ic class="fas fa-paperclip"; style="font-size:14px; color:'.$ØBtNavBgrd.';" title="'.tolk('@Tilføj eller fjern PDF-bilag til denne post.').'";></ic></a>',tolk('@I denne kolonne håndterer du PDF-bilag, som er tilknyttet den enkelte postering.'),'placeh']
      ),
    $RowBody= array( # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:placeholder'],
      ['@Bilag.',       '5%','text', 'left',  tolk('@Bilagsnummer tildeles automatisk og fortsættes fra sidst anvendte bilagsnummer fra samme bruger.').' ','...auto...'],
      ['@Dato',         '9%','date', 'center',tolk('@Bilagets dato, som automatisk sættes til dags dato, men kan ændres.'),'fakt.dato'],
      ['@Bilags tekst','17%','text', 'left',  tolk('@Bilagstekst er frivillig, men det er nyttigt senere at kunne se, hvad de enkelte posteringer drejer sig om.').' ',tolk('@Posterings note...')],
      ['@D/K',        '3.5%','text', 'center',$dkftip,'d/k/f'],
      ['@Debet Kt.',    '8%','text', 'center',tolk('@Debet Kt. er til kontonummeret på den konto, posteringen skal ske på. Afhængigt af koden i D/K-kolonnen foran feltet, vil der være tale om en Debitor-, Kreditor- eller Finanskonto'),'D-kt'],
      ['@D/K',        '3.5%','text', 'center',$dkftip,'d/k/f'],
      ['@Kredit Kt.',   '8%','text', 'center',tolk('@Kredit Kt. er til kontonummeret på den konto, posteringen skal ske på. Afhængigt af koden i D/K-kolonnen foran feltet, vil der være tale om en Debitor-, Kreditor- eller Finanskonto'),'K-kt'],
      ['@Faktura nr.',  '8%','text', 'center',tolk('@Fakturanr. benyttes i forbindelse med debitor- og kreditorposteringer.'),'Fak...'],
      ['@Beløb',        '8%','tal2d','right' ,tolk('@Beløb indeholder det beløb, der skal bogføres. Hvis man ved simulering eller anden kontrol opdager, ').
                      tolk('@at en linje skal bogføres direkte modsat af, hvad der står i kassekladden, så kan man blot sætte minustegn foran beløbet. ').' '.
                      tolk('@På den måde bytter kontonumrene i felterne debet og kredit plads, og beløbet bliver igen positivt.'),'...Kr.'],
      ['@Valuta',       '4%','text','center',tolk('@Valutakode for den valuta, som er benyttet på bilaget.'),'DKK'],
      ['@Forfald',      '9%','date','center',tolk('@Beløbets forfalds dato.')],
      ['@moms',       '3.5%','text', 'center',tolk('@Uden moms: Angiv 0, hvis der ikke skal beregnes moms.'),'@u/m'],
      ),
    $RowSuff= array(  # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:value!     ']
          ['@Fortryd',  '3%','text','center',tolk('@Fortryd postering! Tilbagefør beløbet ved at klikke på ikonen'),
            '<a href='.$link.'><ic class="fas fa-undo" style="font-size:14px; color:red;" title="'.tolk('@Tilbagefør denne postering').'"></ic></a>'],
          ['@Konto saldo','5%','text','right', #'0.000,00<div type= "text" name="saldo" value="00.000,00" width="8%"/>',
            tolk('@Bevægelser og saldo for den konto, som er angivet ovenfor i Felt: Konto-kontrol.').' <br>'.
            tolk('@Er velegnet til afstemning med bank- og girokonti'),'..auto.. &nbsp;']
        ),
        $data= array(1,2,3,4,5,6,7,8,9,10,11,12,13),  # Antal rows ved DEMO
      $ViewHeight='',
      $PadTop='0px'
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
    textKnap($label='@Vis print layout',$title='@Skjul header og footer, og vis tabel i fuld højde, så du kan udskrive regnskabet med CTRL-P', $link='../_base/page_Blindgyden.php');
  htm_KnapGrup('@Her kan du:',false);
  TastTip();
  htm_RudeBund($pmpt='@Gem',$subm=true);
}

# Kaldes fra:  [_finans/page_Kladdeliste.php] 
function Rude_Kladderedigering($DataArr= array()) /*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */
{
dvl_ekko(' Rude_Kladderedigering XX ');
  # Head_Navigation(tolk('@Kassekladde'), $status='', $goPrev=false, $goHome=true, $goUp=true, $goFind=false, $goNew=false, $goNext=false); 
  htm_Rude_Top($name= 'naviform',$capt= '@Liste - Oversigt over kassekladder:',$parms='page_Blindgyden.php',$icon='fas fa-list','panelWmax',__FUNCTION__);
dvl_ekko(' Rude_Kladderedigering YY ');
  htm_TabelOut($RecLabl='@Vis denne kassekladde nedenfor', $RowBody= array(  #   [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
            ['@Id',          '7%','D',  '',     '',       '@Systemoprettet løbenummer','..auto..'],
            ['@Dato',       '10%','',   'date', 'center', '@Dato for kladdens oprettelse','åååå-mm-dd'],
            ['@Ejer',       '10%','',   '',     '',       '@Den der har oprettet kladden','Ejer...'],
            ['@Bemærkning', '53%','',   '',     '',       '@Tekst der beskriver kladden','Bem...'],
            ['@Bogført',    '10%','U' , 'date', 'center', '@Bogført dato','åååå-mm-dd'],
            ['@Af',          '5%','',   '',     'center', '@Bruger der har bogført','Af...'],
            ['@Status',      '5%','',   '',     'center', '@B:Bogført/S:Simuleret','..auto..']),
            $DataArr= array(
            ['1','Dato','Ejer','Bemærkning 1','Bogført-dato','Af','B'],
            ['2','Dato','Ejer','Bemærkning 2','Bogført-dato','Af','B'],
            ['3','Dato','Bogholder','Bemærkning 3','-','Af','S']
            ), $FilterOn=true, $SortOn=true, $CreateRec=true, $ModifyRec=true, $ViewHeight='200px', $Angaar='Rude_Kladderedigering');
  htm_Plaintxt('Klik på knappen foran Id-nummeret, for at se den kladde du vil redigere...');
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true);
  Rude_KasseRedigering($DataArr[2][0],$DataArr[2][2]);
//  Rude_FootMenu($doPrint=true, $doErase=true, $doLookUp=true, $doAccept=true, $doExport=true, $doImport=true, 
//    $OpslLabl='@Opslag: markørens placering bestemmer, hvilken tabel opslag skal foretages i');
}

# Kaldes fra:  [_finans/page_Budget.php] 
function Rude_Budget( &$DATA, $regnskabsaar='2016', $maanedantal=12, $startaar=2016, $startmaaned=1) 
{
### Gør $RowBody klar:
  $MdTitles= periodeoverskrifter($maanedantal, $startaar, $startmaaned, 1, "regnskabsmaaned", $regnskabsaar);  //  periodeoverskrifter benytter: ['@'.$periode_kort, '5%','','tal2d', 'right', '@'.$periode_lang,'']
  $RowBody= array();  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
  array_push($RowBody, 
              ['@Konto',     '4%','','data',  'center', '@Kontonummer. Entydig nummerkode, som benyttes til sortering, summering mv.','@Konto...'],
              ['@Kontonavn','22%','','data',  'left',   '@Kontonavn - beskrivende tekst','']
            );
  foreach ($MdTitles as $Md) array_push($RowBody, $Md);
  array_push($RowBody, ['@I alt',  '5%','','tal2d', 'right', '@Budgetårets aktuelle ultimo beløb.','']);
  # var_dump($RowBody);
  htm_Rude_Top($name= 'budgform',$capt= tolk('@Budget ').' '.($regnskabsaar+0).':',$parms= 'Rude_Erdusikker()',$icon='fas fa-list','panelWmax',__FUNCTION__);
  htm_TabelInp_Budget(
    $HeadLine= array(['@Nyt budget:', '10%','left','show', '@ +/- 0% OK', '@Pct. korrektion']),
    $RowPref= array(),  # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:disp! ', '4:ColTip', '5:disp! ']
    $RowBody,
    $RowSuff= array(),  # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:value!     ']
    $DATA,    //  = ImportTabFile('../_exchange/kontoplan.tab'),  // Indlæs data fra TAB-fil    //  $kontotyper=array("H","D","S","Z","R");   $momstyper=array("S","K","E","Y");    
    $ViewHeight='550px', __FUNCTION__
  );
### PanelFooter:
#+  NaviTip();
#### KnapPanel:
  htm_hr();
  htm_CentrOn();
    textKnap($label='@Vide mere?',  $title='@Her kan du tilpasse forventede månedlige beløb. Hvis du vil ændre konti, gør du det her: Menu\SYSTEM\Kontoplan.',$link='',$akey='v');
    naviKnap($label='@Retur til Regnskab',  $title='@Vend tilbage til regnskab',$link='../_finans/page_Regnskab.php',$akey='r');
    naviKnap($label='@Retur til Hovedmenu', $title='@Vend tilbage til programmets hovedmenu',$link='../_base/page_Hovedmenu.php',$akey='h');
    textKnap($label='@Vis print layout',    $title='@Skjul header og footer, og vis tabel i fuld højde, så du kan udskrive regnskabet med CTRL-P', $link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem hele budgettet.',$akey='g');
}


# PROGRAM-MODUL;
# Kaldes fra: 
function Rude_OrdrePostering( &$data) {
  htm_Rude_Top($name= 'ordreform',$capt= '@Indtastning af salgs ordre poster - `Ordrelinier`:',$parms='page_Blindgyden.php',$icon='fas fa-database','panelWmax',__FUNCTION__);
  htm_TabelInp(
    $HeadLine= array(
      ['@Status:',          '60%','text','left', '@Her kan skrives en bemærkning til ordren', '@Ny ordre, endnu uden kundetilknytning!'], 
      ['@Kundetilknytning:','5em','text','left', '@Angiv kontonummer på kunden','@Konto...'], 
    ),
    $RowPref= array(), # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:disp! ', '4:ColTip', '5:disp! '] #  array(['Link'],['Label'],['Tip'],['4%']),
    $RowBody= array(  # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:placeholder'],
      ['@Pos.',        '5%', 'text', 'left',tolk('@Position tildeles automatisk.').' ','Pos...'],
      ['@Varenr',     '10%', 'text', 'left',tolk('@Varenummer hentes fra vareregistret.'),'Vare...'],
      ['@Antal',       '5%', 'text', 'left',tolk('@Mængden af den aktuelle leverance.').' ','Ant...'],
      ['@Enhed',       '5%', 'text', 'left',tolk('@Enhedsbeskrivelse af mængden'),'Enh...'],
      ['@Beskrivelse','40%', 'text', 'left',tolk('@Leverance beskrivelse'),'Beskr...'],
      ['@Pris',       '10%', 'tal2d','left',tolk('@Enhedspris'),'Pris...'],
      ['@Rabat%',      '6%', 'tal2d','left',tolk('@Rabatsats i %. Angiv 0% og en reduceret enhedspris, hvis der skal ydes en beløbs rabat'),'Rabat'],
      ['@Moms%',       '6%', 'tal2d','left',tolk('@Moms %-sats for den posterede leverance'),'Moms...'],
    # ['@Linie ialt', '10%', 'tal2d','left',tolk('@Beregnet beløb.')] tilføjes internt i htm_TabelInp
    ),
//  $RowSuff= array(['<a href='.$link.' onclick=\"return confirm($confm)\"><img src=../_assets/icons/clip.png  alt="Clips" height="80%" width="80%" border=0></a>'],  [])
    $RowSuff= array(  # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:value!     ']
        ['@um.',       '5%','text','center',tolk('@um. (uden moms) kan benyttes til at bogføre beløb uden moms på konti, selvom kontoen har en momssats tilknyttet.'), 
                                      '<input type= "checkbox" name="udenmoms" value="" >'],
        ['@Linie ialt','8%','text','center',tolk('@Beregnet felt med summen af de samlede beløb'), '00.000,00']), #'<div type= "text" name="saldo" value="00.000,00" width="8%">']),
    $data,    //  = array(1,2,3,4,5,6,7,8,9,10),  # Antal rows ved DEMO
    $ViewHeight= '500px',
    $PadTop='0px',
    $rowadd='@Opret'
  );
### PanelFooter:
#+  NaviTip();
### KnapPanel:
  htm_CentrOn();
    //textKnap($label='@Gem',             $title='@Klik her for at gemme',$link='../_base/page_Blindgyden.php');
    textKnap($label='@Opslag',          $title='@Opslag - din markørs placering angiver hvilken tabel, opslag foretages i',$link='../_base/page_Blindgyden.php');
    textKnap($label='@Slet alt',        $title='@Klik her for at nulstille alle data i tabellen.',$link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_RudeBund($pmpt='@Gem',$subm=true);
}

# Kaldes fra:  [_system/page_Kontoplan.php] 
function Rude_Kontoplan( &$TablData) {
  htm_Rude_Top($name= 'kontoform',$capt= '@Kontoplan:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-database','panelW960',__FUNCTION__);
  htm_TabelOut($RowLabl='@redigere denne konto, på kontokortet nedenfor.',
               $RowBody= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
              ['@Kontonr.',    '8%','','text',  'left',   '@Kontonummer. Entydig nummerkode, som benyttes til sortering, summering mv.','@Konto...'],
              ['@Kontonavn',  '50%','','text',  'left',   '@Kontonavn - beskrivende tekst','@Navn...'],
              ['@Type',        '6%','','text',  'center', '@Kontotype: D=Drift, S=Status, Z=Sum, H=Overskrift, R=Resultat, X=Sideskift, L=Lukket','@Type...'],
              ['@Moms',        '6%','','text',  'center', '@Momskode: K_:Købs... S_:Salgs... Y_:Ydelser, E_:, ','@Moms...'],
              ['@Σ Fra-Kt.',   '7%','','text',  'center', '@Summér fra_konto. Angiv laveste kontonummer, som skal med i sammentællingen.','@Fra...'],
              ['@Saldo',       '9%','','tal2d', 'right',  '@Konto saldo. Beløbet på kontoen lige nu.','@Saldo...'],
              ['@Valuta',      '6%','','text',  'center', '@Kontoens valuta (DKK= kurs 100)','@Valuta...'],
              ['@Genvej',      '6%','','text',  'center', '@Genvejstast: Bogstav-kode, som kan benyttes som forkortelse af kontonummeret','Genv...']),
            $TablData,   // $TablData= ImportTabFile('../_exchange/kontoplan.tab'),  // Indlæs kontoplan fra TAB-fil
            $FilterOn=true, $SorterOn=true, $CreateRec=true, $ModifyRec=true, $ViewHeight='300px', $Angaar='kontoplan');
  htm_CentrOn();  htm_nl();
    textKnap($label='@Vis print layout', $title='@Skjul header og footer, og vis tabel i fuld højde, så du kan udskrive regnskabet med CTRL-P', $link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
}

# Kaldes fra:  [_system/page_Kontoplan.php] 
function Rude_KontoKort( &$data) {
  htm_Rude_Top($name= 'kontoform',$capt= '@Kontokort:',$parms='../_system/page_Kontoplan.php',$icon='fas fa-pen-square','panelW960',__FUNCTION__);
  htm_TabelInp(
    $HeadLine= array( [tolk('@Vælg en konto i kontoplanen').' - ', '18%','left','show', ' ', '@Rediger konto:'] ),
      $RowPref= array(),  # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:disp! ', '4:ColTip', '5:disp! '] #  array(['Link'],['Label'],['Tip'],['4%']),
            $RowBody= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
              ['@Kontonr.',  '9%','text', 'left',   '@Kontonummer. Entydig nummerkode, som benyttes til sortering, summering mv. Angiver du et ubenyttet, oprettes en ny konto, ellers kan du rette kontoen.','@Konto...'],
              ['@Kontonavn','50%','text', 'left',   '@Kontonavn - beskrivende tekst','@Navn...'],
              ['@Type',      '7%','kont', 'left',   '@Kontotype: D=Drift, S=Status, Z=Sum, H=Overskrift, R=Resultat, X=Sideskift, L=Lukket','@Type...'],
              ['@Moms',      '7%','moms', 'left',   '@Momskode: K_:Købs... S_:Salgs... Y_:Ydelser, E_:, ','@Moms...'],
              ['@Σ Fra-Kt.', '9%','text', 'center', '@Summér fra_konto. Angiv laveste kontonummer, som skal med i sammentællingen. Angår kun sum-konti, type Z','@Fra...'],
              ['@Valuta',    '7%','valu', 'left',   '@Valuta kode','@Valu...'],
              ['@Saldo',     '7%','show', 'center', '@Kontoens saldo. beregnet beløb','..calc..'],
              ['@Genvej',    '7%','text', 'left',   '@Genvejs tast, angiv et bogstav','@Genv...'],
              ['@Status',    '7%','stat', 'left',   '@Status: Aktiv eller Lukket','@Stat...']
    ),
    $RowSuff= array(), #'<div type= "text" name="saldo" value="00.000,00" width="8%">']),
    $data,    //  $data= array(['2001','VAREFORBRUG','D','K1','','DKK',0.00,'G',true]),  // Demo
    $ViewHeight= '500px',
    $PadTop='0px'
  );
  htm_CentrOn();
    textKnap($label='@<- Forrige konto', $title='@Klik her for at se forrige konto',      $link='');
    textKnap($label='@Gem/opdatér',      $title='@Klik her for at gemme evt. ændringer.', $link='');
    textKnap($label='@Gem som ny',       $title='@Klik her for at gemme evt. ændringer.', $link='');
    textKnap($label='@Slet',             $title='@Klik her for at slette kontoen. Konti som er taget i brug, kan ikke slettes!',   $link='');
    textKnap($label='@Næste konto ->',   $title='@Klik her for at se næste konto',        $link='');
  htm_CentOff();
  htm_RudeBund($pmpt='@Retur til kontoplan',$subm=true,$title='@Retur til kontoplan');
}

# Kaldes fra:  [_finans/page_Kontrol.php] [_finans/page_Rapport.php] 
function Rude_RapportFinans($Aar_Liste='', $Art_Liste='', $somfakt='', $Knt_Liste='') 
{global $Ø_MdrList, $Ø_DagList, $Ø_ArtList; // oprettet i ../_base/out_base.php
  htm_Rude_Top($name= 'rappform',$capt= '@Finansrapport:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-chart-line','panelW320',__FUNCTION__);
  # htm_SelectStr($name,$valu,Aar_Liste());
  $Aar_Liste= Aar_Liste();
  $Knt_Liste= MakeDriftsKonti();
  htm_FrstFelt('50%',0);  htm_CombList($name='ListName',$valu='2016',$labl='@Regnskabsår',$titl='@Der kan kun rapporteres inden for et regnskabsår, hvilket angives her.',$liste= $Aar_Liste);
  htm_NextFelt('50%');    textKnap($label='@Opdatér',    $title='@Opdater her efter en rettelse af regnskabsår',$link='../_base/page_Blindgyden.php');
  htm_LastFelt();
#  htm_FrstFelt('30%',0);  
  htm_CombList($name='ListMoms',$valu='momsangivelse',$labl='@Rapporttype',$titl='@Her vælges blandt de i programmet opsatte rapporttyper', $liste= Art_Liste()); # $Ø_ArtList
#  htm_NextFelt('70%');    
  htm_CheckFlt($type='checkbox',$name='somfakt',$valu='somfakt', $labl='@Medtag lagerbevægelser', $titl='@Afmærk her, hvis lagerbevægelser skal medtages.',  $revi=true);
#  htm_LastFelt();
  if ('momsangivelse'=='momsangivelse') msg_Tip($title="@Om momsafregning",  
      $messg="@Husk at det er en god ide at bogføre med udgangen af MOMS regnskabs perioden, så konto: <br>66100&nbsp;Salgsmoms og 66200&nbsp;Købsmoms <br>er opdateret inden indberetning.");
  // Virker ikke:
  run_Script('if (document.getElementById("ListMoms").value=="Momsangivelse") msg_Tip($title="@Om momsafregning",  '.
      '$messg="@Husk at det er en god ide at bogføre med udgangen af MOMS regnskabs perioden, så konto: '.
      '<br>66100&nbsp;Salgsmoms og 66200&nbsp;Købsmoms <br>er opdateret inden indberetning.");');
  
  echo '<hr>';  
  echo '<captlabl>';  
		htm_FrstFelt('50%',0);   echo tolk('@Periode fra:');    
		htm_NextFelt('50%');     echo tolk('@Periode til:');    
		htm_LastFelt(); 
  echo '</captlabl>';
//  htm_FrstFelt('10%',0);  htm_CombList($name='ListName',$valu='2016',$labl='@År:',    $titl='@Årstallet for periodens start',$liste= $Aar_Liste); 
//  htm_NextFelt('15%');    htm_CombList($name='ListName',$valu='0',   $labl='@Måned:', $titl='@Måneden for periodens start',$liste= $Ø_MdrList); 
//  htm_NextFelt('25%');    htm_CombList($name='ListName',$valu='0',   $labl='@Dag:',   $titl='@Dagen for periodens start',$liste= $Ø_DagList);
//  htm_NextFelt('10%');    htm_CombList($name='ListName',$valu='2016',$labl='@År:',    $titl='@Årstallet for periodens slut',$liste= $Aar_Liste); 
//  htm_NextFelt('15%');    htm_CombList($name='ListName',$valu='11',  $labl='@Måned:', $titl='@Måneden for periodens slut',$liste= $Ø_MdrList);
//  htm_NextFelt('35%');    htm_CombList($name='ListName',$valu='30',  $labl='@Dag:',   $titl='@Dagen for periodens slut',$liste= $Ø_DagList);
//  htm_LastFelt();
  htm_FrstFelt('50%',0);  htm_CombFelt($type='date',  $name='fra',     $valu= $RappFra,   $labl='@Periode start',  $titl='@Dato for rapportens påbegyndelse', $revi=true);
  htm_NextFelt('50%');    htm_CombFelt($type='date',  $name='til',     $valu= $RappTil,   $labl='@Periode slut',  $titl='@Dato for rapportens afslutning', $revi=true);
  htm_LastFelt();
  htm_FrstFelt('50%',0);  htm_CombList($name='ListName',$valu='', $labl='@Fra konto', 
      $titl='@Første konto nummer, som medtages i rapporten',$liste= $Knt_Liste,$more='style="max-width:150px;" dual');
  htm_NextFelt('50%');    htm_CombList($name='ListName',$valu='', $labl='@Til konto', 
      $titl='@Sidste konto nummer, som medtages i rapporten',$liste= $Knt_Liste,$more='style="max-width:150px;" dual');
  htm_LastFelt();
  //  echo '<hr><div style="margin-left:1em; display:block; font-weight: normal;" >'.tolk('@Vis:').' '; 
  htm_KnapGrup('@Vis:',true);
    textKnap($label='@Det valgte',  $title='@Søgning med de valgte kriterier ovenfor',          $link='../_base/page_Blindgyden.php');    
    textKnap($label='@Kontrolspor', $title='@Vilkårlig søgning i transaktioner',                $link='../_finans/page_Kontrol.php');    
    textKnap($label='@Provision',   $title='@Rapport over medarbejdernes provisionsindtjening', $link='../_finans/page_Provisionsrapport.php');
  //  echo '</div>';  
  //  htm_KnapGrup('@Vis:',false);
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
}

# Kaldes fra:  [_finans/page_Provisionsrapport.php] 
function Rude_Provisionsrapport(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {
  htm_Rude_Top($name= 'provform',$capt= '@Provisionsrapport:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-database','panelWmax',__FUNCTION__);
  
  msg_Dialog('warn',ucfirst(tolk('@Retur')),'JavaScript:window.history.back();','','','','',ucfirst(tolk('@Her mangler der noget')),
            ucfirst(tolk('@Provisionsrapport kan ikke testes, før der er DB-adgang.')));
  
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
}

# Kaldes fra:  [_finans/page_Regnskab.php] [_system/page_Regnskabsaar.php] [_system/page_Regnskabskort.php] 
function Rude_Regnskab($regnskab='', $maanedantal=12, $startaar=2017, $startmaaned=1, $periode_dag=1, $periode_laengde="regnskabsmaaned", $regnskabsaar='2016', &$TablData) 
{
  htm_Rude_Top($name= 'kontoform',$capt= tolk('@Regnskab:').' '.$regnskab, $parms='../_base/page_Hovedmenu.php',$icon='fas fa-database','panelWmax',__FUNCTION__);
  $MdTitles= periodeoverskrifter($maanedantal=12, $startaar=2017, $startmaaned=1, $periode_dag=1, $periode_laengde="regnskabsmaaned", $regnskabsaar='2016');
  //  periodeoverskrifter benytter: ['@'.$periode_kort,    '4.5%','','tal2d', 'right', '@'.$periode_lang,'']
  $RowBody= array();  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
  array_push($RowBody, 
              ['@Konto',     '5%','','text',  'center', '@Kontonummer. Entydig nummerkode, som benyttes til sortering, summering mv.','@Konto...'],
              ['@Kontonavn','17%','','text',  'left',   '@Kontonavn - beskrivende tekst',''],
              ['@Type',      '3%','','text',  'center', '@Kontotype: D=Drift, S=Status, Z=Sum, H=Overskrift, R=Resultat, X=Sideskift, L=Lukket','@Type...','hide'],
              ['@Valuta',    '4%','','text',  'center', '@Valutakode for kontoens beløb','hide'],
              ['@Σ-fra:',    '6%','','tal0d', 'center', '@Summation fra konto til denne','hide'],
              ['@Primo:',    '6%','','tal2d', 'right',  '@Året primo beløb, Sidste års ultimo','']
              );
  foreach ($MdTitles as $Md) array_push($RowBody, $Md);
  array_push($RowBody, 
              ['@I alt nu:', '6%','','tal2d', 'right', '@Aktuelle beløb. (Årets ultimo beløb)','.calc.']);
  htm_TabelOut(
        $RowLabl='@vælge denne post',
        $RowBody,
        $TablData,  // = ImportTabFile('../_exchange/kontoplan-extra.tab'),  // Indlæs data fra TAB-fil
        $FilterOn=false, $SorterOn=true, $CreateRec=false, $ModifyRec=false, $ViewHeight='500px', $Angaar='regnskab' );
### PanelFooter:
  htm_RadioGrp($type='hori',  $name='krvis', $labl='@Beløbsvisning:', $titl='@Vælg visnings nøjagtighed for regnskabs beløb',  
              $optlist= array(['kr2d','@Kroner,ører','@eller',true],['kr','@Hele kroner','@eller'],['tusind','@Kun tusinder','']),$action='');
### KnapPanel:
  htm_CentrOn();
    naviKnap($label='@Til Budget',          $title='@Klik her for komme til budgetlægning',   $link='../_finans/page_Budget.php');
    naviKnap($label='@Retur til hovedmenu', $title='@Luk og gå retur til hovedmenu', $link='../_base/page_Hovedmenu.php');
    textKnap($label='@Vis print layout',    $title='@Skjul header og footer, og vis tabel i fuld højde, så du kan udskrive regnskabet med CTRL-P', $link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Luk og gå retur til hovedmenu');
}

# Kaldes fra:  [_system/page_Regnskabsaar.php] 
function Rude_Regnskabsaar(&$TablData) {
  htm_Rude_Top($name= 'regnform',$capt= '@Regnskabsår:',$parms='../_system/page_Valuta.php',$icon='fas fa-database','panelW480',__FUNCTION__); 
  echo '<captlabl>';      
		htm_FrstFelt('44%',0);  
		htm_NextFelt('24%');    echo tolk('@Periode start:');  
		htm_NextFelt('24%');    echo tolk('@Periode slut:');   
		htm_NextFelt('8%');     
		htm_LastFelt(); 
	echo '</captlabl>';
  htm_TabelOut($RowLabl='@vise regnskabskortet',
            $RowBody= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
              ['@ID.',        '14%','','text', 'center', '@Entydigt systemindex, som benyttes af systemet,','@auto...'],
              ['@Beskrivelse','28%','','text', 'left',   '@Beskrivende tekst for perioden','@Besk...'],
              ['@Måned',      '12%','','text', 'center', '@Periodens første måned','@md...'],
              ['@År',         '12%','','text', 'left', 	 '@Perioden starter i år', '@år...'],
              ['@Måned',      '12%','','text', 'center', '@Periodens sidste måned','@md...'],
              ['@År',         '12%','','text', 'left',   '@Perioden slutter i år', '@år...'],
              ['@Status',     '10%','','text', 'center', '@Regnskabets status',    '@Stat...'],
              ),
            $TablData,  //  = array(['1','2015','01','2015','12','2015','Lukket'],['2','2016','01','2016','12','2016','<div style="color:red">Aktivt</div>']),  // Demo
            $FilterOn=false, $SorterOn=true, $CreateRec=true, $ModifyRec=true, $ViewHeight='100px' );
  echo tolk('@Når du opretter et nyt regnskabsår, skal du huske at gøre det aktivt, ved at sætte flueben i "Bogføring tilladt", på regnskabskortet.');
  htm_RudeBund($pmpt=Tolk('@Retur til indstillinger'),$subm=true,$title='@Luk og gå retur til indstillingsmenu');
}

# Kaldes fra:  [_system/page_Regnskabsaar.php] [_system/page_Regnskabskort.php] 
function Rude_Regnskabskort(&$DATA, $besk='2016', $aar0='2016', $md0='01', $aar1='2016', $md1='12', $aktiv=true, $fak1Nr) {
  htm_Rude_Top($name= 'kortform',$capt= '@Regnskabskort:',$parms='../_system/page_Valuta.php',$icon='fas fa-pen-square','panelW480',__FUNCTION__); 
  echo tolk('@Fastlæg 1. regnskabsår: 2016').'<br><br>';
  echo '<captlabl>';
  htm_FrstFelt('40%',0);  echo tolk('@Regnskabsår:');
  htm_NextFelt('20%');    echo tolk('@Periode start:');
  htm_NextFelt('20%');    echo tolk('@Periode slut:');
  htm_NextFelt('20%');    echo tolk('@Bogføring:');
  htm_LastFelt();    
  echo '</captlabl>';
  htm_FrstFelt('40%',0);  htm_CombFelt($type='text',    $name='besk',  $valu= $besk, $labl='@Beskrivelse.',  $titl='@Angiv Beskrivelse',         $revi=true, $rows='',$width='30',$step='0.5');
  htm_NextFelt('10%');    htm_CombFelt($type='text',    $name='md0',   $valu= $md0,  $labl='@Måned',         $titl='@Angiv periode start Måned', $revi=true,$rows='',$width='30');
  htm_NextFelt('10%');    htm_CombFelt($type='text',    $name='aar0',  $valu= $aar0, $labl='@År',            $titl='@Angiv periode start År',    $revi=true, $rows='',$width='30');
  htm_NextFelt('10%');    htm_CombFelt($type='text',    $name='md1',   $valu= $md1,  $labl='@Måned',         $titl='@Angiv periode slut Måned',  $revi=true,$rows='',$width='30');
  htm_NextFelt('10%');    htm_CombFelt($type='text',    $name='aar1',  $valu= $aar1, $labl='@År',            $titl='@Angiv periode slut År',     $revi=true, $rows='',$width='30');
  htm_NextFelt('20%');    htm_CheckFlt($type='checkbox',$name='aktiv', $valu= $aktiv,$labl='@tilladt',  $titl='@Angiv om bogføring er tilladt', $revi=true);
  htm_LastFelt();       
  
  htm_CentHead('&nbsp;'.tolk('@Auto nummerering:'));
  htm_FrstFelt('50%',0);  htm_CombFelt($type='text',    $name='regn',  $valu= $fak1Nr,   $labl='@1. faktura nummer',     
          $titl='@Faktura nummer for periodens første faktura',   $revi=true, $rows='2',$width='',$step='', $more='', $plho=tolk('@Faktura...'));
  htm_NextFelt('50%');    htm_CombFelt($type='text',    $name='regn',  $valu= $fak1Nr,   $labl='@1. modtagelses nummer', 
          $titl='@Modtagelses nummer for periodens første bilag', $revi=true, $rows='2',$width='',$step='', $more='', $plho=tolk('@Modtage...'));
  htm_LastFelt();       
  
  htm_Caption('@Bilags nummerering:');
  htm_FrstFelt('30%',0);  htm_CheckFlt($type='checkbox',$name='aktiv', $valu= $aktiv,  $labl='@Undlad v. faktura',$titl='@Undlad nummerering ved faktura', $revi=true);
  htm_NextFelt('30%');    htm_CheckFlt($type='checkbox',$name='aktiv', $valu= $aktiv,  $labl='@Brug faktura-nr.', $titl='@Brug fakturas nummerering',      $revi=true);
  htm_NextFelt('30%');    htm_CheckFlt($type='checkbox',$name='aktiv', $valu= $aktiv,  $labl='@Brug modtage-nr.', $titl='@Brug modtage nummerering',       $revi=true);
  htm_LastFelt();       
  htm_CentrOn(); 
    textKnap($label='@Gem rettelser', $title='@Gem hvad du har rettet ovenfor',$link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_hr();
  
#  echo '<hr>'.tolk('@Indtast primotal for 1. regnskabsår:');
    htm_Caption('@Åbningsbeløb for konti:','font-weight:900;');
    htm_TabelInp(
    $HeadLine= array(['@Her angives primotal for:', '25%','left','show', '', '1. regnskabsår']),
    $RowPref=  array(),  # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:disp! ', '4:ColTip', '5:disp! '] # array(['@Konto.','15%','center','','4:','5:Tip'],['@Beskrivelse','62%','left','','4:','5:Tip']),
    $RowBody= array(  #  ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:placeholder'],
              ['@Konto.',     '12%','show',  'center', '@Entydigt konto nummer, fastlagt i kontoplanen.','@auto...'],
              ['@Beskrivelse','60%','show',  'left',   '@Tekst som beskriver kontoen, fastlagt i kontoplanen.','@Besk...'],
              ['@Debet',      '14%','tal2d', 'right',  '@Debet primosaldo','primo...','SW'],
              ['@Kredit',     '14%','tal2d', 'right',  '@Kredit primosaldo','primo...','SW'],
             ),
    $RowSuff= array(),  # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:value!     ']
    $DATA= MakeStatusKonti(),
    $ViewHeight= '500px',
    $PadTop='0px', __FUNCTION__
  );

//  htm_TabelOut($RowLabl='@Klik på konto-nummeret for at vælge denne post',
//            $RowBody= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
//              ['@Konto.',     '15%','','text',  'center', '@Entydig systemindex, som benyttes af systemet,','@auto...'],
//              ['@Beskrivelse','62%','','text',  'left',   '@Beskrivende tekst for perioden','@Besk...'],
//              ['@Debet',  '12%','','text',  'center', '@Periodens første måned','@md...'],
//              ['@Kredit',   '12%','','text',  'center', '@Perioden starter i år', '@år...'],
//             ),
//            $TablData= MakeStatusKonti(),
//            $FilterOn=false, $SorterOn=false,$CreateRec=false, $ModifyRec=true, $ViewHeight='250px' );
  htm_CentrOn(); 
    textKnap($label='@Gem / opdater', $title='@Gem det du har rettet ovenfor',$link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_RudeBund($pmpt=Tolk('@Retur til indstillinger'),$subm=true,$title='@Luk og gå retur til indstillingsmenu');
}

# Kaldes fra: 
function MakeStatusKonti() {
  $StatusKt= array();
  $filDATA= ImportTabFile('../_exchange/kontoplan.tab');
  foreach ($filDATA as $rec) {if ($rec[2]=='S') array_push($StatusKt, [$rec[0],utf8_decode($rec[1]),'0.00','0.00']);}
  # var_dump($StatusKt);
  return $StatusKt;
}
# Kaldes fra: 
function MakeDriftsKonti() {
  $DriftKt= array();
  $filDATA= ImportTabFile('../_exchange/kontoplan.tab');
  foreach ($filDATA as $rec) {if ($rec[2]=='D') array_push($DriftKt, [$rec[1],$rec[0],$rec[0].':'.$rec[1]]);}
  # var_dump($filDATA);
  # var_dump($DriftKt);
  return $DriftKt;
}

# SubRutine:
#function- getComboA(sel) { var value = sel.value; };

# Kaldes fra:  [_finans/page_Kontrol.php] [_finans/page_Rapport.php] 
function Rude_Kontrolspor(&$Data) {global $Ønovice;
  htm_Rude_Top($name= 'sporform',$capt= '@Kontrol sporing',$parms='../_finans/page_Rapport.php',$icon='fas fa-database','panelWmax',__FUNCTION__);
    
  htm_FrstFelt('2%',0);  echo '<captlabl style="text-align:right">&nbsp;'.tolk('@Vis:').'</captlabl>';
  htm_NextFelt('5%');    htm_CombFelt($type='number',  $name='linier', $valu= 50,   $labl='@Linier',  $titl='@Max. antal linier, som vises pr. side: ', $revi=true, $rows='',$width='',$step='5' );
  htm_NextFelt('90%');   echo '<captlabl>&nbsp;'.tolk('@pr. side').'</captlabl>';  if ($Ønovice) echo ' - '.tolk('@´Kontrolspor´ = Find grundlaget for regnskabstallene.');
  htm_LastFelt();       

  htm_TabelOut($RecLabl='se ?', 
      $RowBody= array(  #   [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
        ['@Id',          '4%','','text','center',tolk('@Angiv et id-nummer eller angiv to adskilt af kolon (f.eks 345:350)'),''],
        ['@Periode',     '9%','','date','right', tolk('@Angiv en dato eller angiv to adskilt af kolon (f.eks 010605:300605)'),'...'.tolk('@Tekst').'åååå-mm-dd'],
        ['@Log. Periode','9%','','date','right', tolk('@Angiv en dato eller angiv to adskilt af kolon (f.eks 010605:300605)'),'åååå-mm-dd'],
        ['@Tidspunkt',   '7%','','text','center',tolk('@Angiv et tidspunkt (f.eks 17:35) '),'?'],
        ['@Kladde',      '7%','','text','center',tolk('@Angiv et kassekladdenummer eller angiv to adskilt af kolon (f.eks 345:350)'),'?'],
        ['@Bilag',       '7%','','text','center',tolk('@Angiv et bilagsnummer eller angiv to adskilt af kolon (f.eks 345:350)'),'?'],
        ['@Konto.',      '7%','','text','center',tolk('@Angiv et kontonummer eller angiv to adskilt af kolon (f.eks 345:350)'),'?'],
        ['@Fakturanr',   '7%','','text','center',tolk('@Angiv et fakturanummer eller angiv to adskilt af kolon (f.eks 345:350)'),'?'],
        ['@Debet',       '7%','','text','center',tolk('@Angiv et beløb eller angiv to adskilt af kolon (f.eks 10000,00:14999,99)'),'?'],
        ['@Kredit',      '7%','','text','center',tolk('@Angiv et beløb eller angiv to adskilt af kolon (f.eks 10000,00:14999,99)'),'?'],
# if($vis_projekt):      
        ['@Projekt',     '7%','','text','center',tolk('@Angiv et projektnummer eller angiv to adskilt af kolon (f.eks 5:7)'),'?'],
        ['@Søgetekst',  '18%','','text','left',  tolk('@Angiv en søgetekst. Der kan anvendes * før og efter teksten'),'?']),
      $Data= array(['1','','','','','','','','','','',''],['2','','','','','','','','','','',''],['3','','','','','','','','','','','']), 
      $FilterOn=true, $SortOn=true, $CreateRec=false, $ModifyRec=true);
  htm_CentrOn(); htm_nl();
    //  textKnap($label='@Start søgning', $title='@Start søgning med de angivne kriterier.',$link='../_base/page_Blindgyden.php');
    textKnap($label='@CSV-eksport', $title='@Klik her for at eksportere valgte transaktioner til CSV-fil for import i andet program, f.eks. regneark.',$link='../_base/page_Blindgyden.php');
    textKnap($label='@Print layout', $title='@Klik her for at vise data, så de kan udskrives med CTRL-P',$link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_RudeBund($pmpt='@Retur til finansrapport',$subm=true,$title='@Gå til vinduet finansrapport');
}


# Kaldes fra:  [_system/page_FormGrafik.php] [_system/page_FormOrdrelin.php] [_system/page_FormText.php] 
function Rude_Formularer( &$formtype, &$formart, &$formsprog, &$formformat) { // Kaldes fra: ../_system/page_Formtext.php
global $Øart;
  htm_Rude_Top($name= '',$capt= '@Formular redigering',$parms='../_system/page_Valuta.php',$icon='fas fa-wrench','panelW240',__FUNCTION__);
  htm_Tapet_Top($name= 'tapetform',$capt= '',$parms='#',$icon='','panelWaut',__FUNCTION__);
  $formtype=    $_POST['formtype'];   if (!$formtype) $formtype= '4';
  //  $formart=     $_POST['formart'];    if (!$formart) $formart= $Øart; //  '1:Tekster'; 
  if (isset($_POST['formart'])) $formart= $_POST['formart'];
  $formsprog=   $_POST['formsprog'];  if (!$formsprog)  $formsprog=  'dansk';
  $formformat=  $_POST['formformat']; if (!$formformat) $formformat= 'A4p';
  
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
  echo '<div class="centrer">'; htm_accept('@Rediger det valgte','@Rediger det du har valgt ovenfor', $width='', $akey='', $form='tapetform'); echo '</div>';
  htm_nl();
  htm_TapetBund($formslut=true);
  htm_nl();
  echo '<div align="center">';
  echo  textKnap($label='@Forhåndsvisning',                   $title='@Vis layout for en vilkårlig formular',$link='../_base/page_Printlayout.php').'<br><br>';
  echo  textKnap($label='@Opret clon af en formular',         $title='@Opret en ny formular, som en kopi af en eksisterende formular.',    $link='../_base/page_Blindgyden.php').'<br><br><hr>';
  htm_Caption('Formular adminstration:');
  echo  textKnap($label='@Gem mine formularer',               $title='@Lav backup til fil, af det nugældende formularsæt.',    $link='../_base/page_Blindgyden.php').'<br><br>';
  echo  textKnap($label='@Genindlæs mine formularer',         $title='@Tag backup fra fil i brug, ved at benytte den som gældende formularsæt. (Overskriver!)',$link='../_base/page_Blindgyden.php').'<br><br>';
  echo  textKnap($label='@Importer formular(er) fra LO ',     $title='@Indlæs fra .fodg-fil dannet af formularredigering i LibreOffice',   $link='../_base/page_Blindgyden.php').'<br><br>';
  echo  textKnap($label='@Overskriv formularer med standard', $title='@Overskriv de aktive formular-definitioner med system standard',$link='../_base/page_Blindgyden.php').'<br><br>';
  echo  textKnap($label='@Håndtering af formularsprog',       $title='@Sproghåndtering: Opret, Nedlæg sprog',         $link='../_base/page_Blindgyden.php').'<br><br>';
  echo  textKnap($label='@Upload/Download supportfiler',      $title='@Fil upload: Logo, Grafik, Billeder eller fodg-fil fra Libre Office',$link='../_base/page_Blindgyden.php').'<br><br>';
  echo '</div>';
  htm_RudeBund($pmpt='@Retur til indstillinger',$subm=true,$title='@Gå til menuen indstillinger');
  return [$formtype,$formart,$formsprog,$formformat];
}



# Kaldes fra: 
function SetHeadArr($frmNr='4',$x1='',$x2='@Dansk',$x3='@A4 portrait') { global $ØBtNewBgrd;
  $copyknap= '<button type="button" id="btnCopy" onclick="varcopy()" style="background-color:'.$ØBtNewBgrd.'" title="'.    //  varcopy() erklæres i htm_pagePrepare.php
    tolk('@Klik her, for at kopiere det valgte variabelnavn til kopieringsbuffer, så du kan indsætte det i et beskrivelses felt').
    '">&nbsp;<ic class="fas fa-copy" style="font-size:15px;"> </ic> Copy </button>';
  if ($x1=='@Ordrelinjer') {$extra= [str_sp(6). tolk('@Variabler:'), '18%','left','html', '', 
    htm_SelectStr($name='copytxt',$valu='VALU',OrdrVars($frmNr),'max-width:200px; background-color:white;" title="'.
      tolk('@Her kan du vælge blandt de brugbare variabelnavne angående ordrelinier'),true).$copyknap];} 
  else
  if ($x1=='@Tekster') {$extra= [str_sp(6). tolk('@Variabler:'), '18%','left','html', '', 
    htm_SelectStr($name='copytxt',$valu='VALU',FormVars($frmNr),'max-width:200px; background-color:white;" title="'.
      tolk('@Her kan du vælge blandt de brugbare variabelnavne angående tekster'),true).$copyknap];} 
    else $extra= ['','0%','','html','',''];
  return  array(   # $HeadLine= array([0:Labl, 1:Width, 2:Just, 3:InpType, 4:Tip, 5:placeholder])
    ['@Formular:',  '10%','left','show', '@Du redigerer denne formular', ListLookup($liste=FRM_Liste(),$search= $x0,$colsearch=1,$colresult=2)],
    ['@Art:',       '10%','left','show', '@Du redigerer denne art', $x1],
    ['@Sprog:',     '10%','left','show', '@Du redigerer formular med dette sprog', ListLookup($liste=SPR_Liste(),$search= $x2,$colsearch=1,$colresult=2)],
    ['@Format:',    '10%','left','show', '@Du redigerer formular med denne sidestørrelse', ListLookup($liste=PaprListe(),$search= $x3,$colsearch=1,$colresult=2)],
    $extra
  );
}
  
//  Tilpas feltrækkefølge for de forskellige arter:
# Kaldes fra: 
function GetFormdata($frm,$art,&$layout,&$stempel,&$grafik,&$images,&$tekster,&$ordrlin) { // Functionen er udgået... #../_system/save_Formularer.php erstatter
  $tekster= []; $grafik= []; $images= []; $ordrlin= []; $stempel= []; $layout= [];
//  $DATA= sql_readB($qstr='SELECT form, frm_art, side, besk, just, FORMAT(x0,0), FORMAT(y0,0), FORMAT(dx,0), FORMAT(dy,0), FORMAT(dim,0), colr, font, style, imglnk, lngkey, note FROM tblA_forms ',__FILE__, __LINE__);
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


# Kaldes fra: [_system/page_FormText.php] 
function Rude_FormRedigerLayout($frm,$art,$lang,$papr) { // Kaldes fra: ../_system/page_Formtext.php
  htm_Rude_Top($name= 'edit',$capt= '@Rediger Formular: Layout og mail-tekster',$parms='#',$icon='fas fa-wrench','panelW960',__FUNCTION__);
  $link= '';
    htm_Caption('@Formular størrelse:');
    htm_OptioFlt($type='text',  $name='papir',      $valu= $papr,      
                 $labl='@Format',   
                 $titl='@Her kan du slå op, og vælge blandt standard papir-formater', 
                 $revi=true, $optlist=PaprListe(), $action='');
    htm_nl();    htm_hr('Red; size:4;');
    htm_Caption('@Stempler/Vandmærker:');
    htm_TabelInp(
      $HeadLine= SetHeadArr($frm,'@Stempler',$lang,$papr),
      $RowPref= array(['@Ix',  '4%','data','center','@Index','pos...']), 
      $RowBody= array( # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:placeholder', '6:default'],
            ['@Id.',           '0%','hidd','center','@Index','serial...'],
            ['@Nr.',           '0%','hidd','center','@Formular nr','kode...'],
            ['@Art',           '0%','hidd','center','@Koden for feltes art','art...'],
            ['@Side',          '4%','side','center','@Udskrift på side kode: A !1 1 S !S','side...','1'],
            ['@Beskrivelse',  '20%','data','left',  '@Feltets tekstindhold samt $variabler','?'],
            ['@Just',          '4%','just','center','@Justering af teksten:'. ShowCol($liste=JustListe(),$col= 0,$sep='<br>'),'-','V'],
            ['@X0',            '4%','data','right', '@Indsætnings X-koordinat (mm fra formularens venstre kant)','X0...',''],
            ['@Y0',            '4%','data','right', '@Indsætnings Y-koordinat (mm fra formularens top kant)','Y0...'],
            ['@Brd.',          '4%','data','right', '@Felt bredde (mm)','F-b...'],
            ['@Høj.',          '4%','data','right', '@Felt højde (mm)'.'<br>'.tolk('@Angiv 0 for at autotilpasse'),'F-h...'],
            ['@Dim.',          '4%','data','right', '@Objektets dimension: Streg-bredde, Tegn-højde, målt i px (pixel)','Obj-D...'],
            ['@Farve',         '6%','data','center','@Objektets farve, angives som HTML5 tillader. (red, #FF44DD, rgb)','farve...','red'],
            ['@Txt-font',     '10%','font','left',  '@Objektets font'.str_nl().tolk('(gyldigt argument til: font-family):'). ShowCol($liste=FontListe(),$col= 2,$sep=str_nl()),'-','Times'],
            ['@Txt-style',    '15%','data','left',  '@Objektets style'.'<br>'.tolk('(gyldigt argument til: font-weight, font-style). Husk afsluttende semikolon!'),'-','bold; transform: rotate(-35deg); '],
            ['@Grafik',        '0%','hidd','left',  '@Link til grafikfil','graf...'],
            ['@Fremmedsprog',  '0%','hidd','left',  '@Alternativ beskrivelse, f.eks. på engelsk','alt...'],
            ['@Note',         '15%','data','left',  '@Note til objektet','note...']
        ),
      $RowSuff= array(['@Slet','4%','text','center','@Klik på rødt kryds for at slette dette stempel', '<ic class="far fa-times-circle" style="color:red; font-size:13px;"></ic>'],
        ),
      $stempel= sql_readB($qstr=
        'SELECT id, form, frm_art, side, besk, just, FORMAT(x0,0), FORMAT(y0,0), FORMAT(dx,0), FORMAT(dy,0), FORMAT(dim,0), colr, font, style, imglnk, lngkey, note '.
        'FROM tblA_forms WHERE form= "'.$frm.'" AND frm_art= "0" AND side!= "G"',__FILE__, __LINE__) , 
      $ViewHeight= '500px',
      $PadTop= '0px',
      $rowadd='@Tilføj nyt stempel'
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
    htm_RudeBund($pmpt='@Gem',$subm=true);
} //  Rude_FormRedigerLayout


# Kaldes fra: [_system/page_FormText.php] 
function Rude_FormRedigerText($frm,$art,$lang,$papr) { // Kaldes fra: ../_system/page_Formtext.php
  htm_Rude_Top($name= 'edit',$capt= tolk('@Rediger Formular:').' '.substr(ListLookup($liste=FRM_Liste(), $search= $frm,
      $colsearch=1,$colresult=2),3).' - '.tolk('@Tekster'),$parms='#',$icon='fas fa-wrench','panelW960',__FUNCTION__);
  htm_TabelInp(
      $HeadLine= SetHeadArr($frm,'@Tekster',$lang,$papr),
      $RowPref= array(), 
      $RowBody= array( # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:placeholder', '6:default'],
            ['@Id.',           '0%','hidd','center','@Index','serial...'],
            ['@Nr.',           '0%','hidd','center','@Formular nr','kode...'],
            ['@Art',           '0%','hidd','center','@Koden for feltes art','art...'],
            ['@Side',          '4%','side','center','@Udskrift på side kode: A !1 1 S !S','side...','A'],
            ['@Beskrivelse',  '32%','data','left',  '@Feltets tekstindhold samt $variabler','tekst...'],
            ['@Just',          '3%','just','center','@Justering af teksten:'. ShowCol($liste=JustListe(),$col= 0,$sep='<br>'),'-','V'],
            ['@X0',            '4%','data','right', '@Indsætnings X-koordinat (mm fra formularens venstre kant)','X0...',''],
            ['@Y0',            '4%','data','right', '@Indsætnings Y-koordinat (mm fra formularens top kant)','Y0...'],
            ['@Brd.',          '4%','data','right', '@Felt bredde (mm)','F-b...'],
            ['@Høj.',          '4%','data','right', '@Felt højde (mm)'.'<br>'.tolk('@Angiv 0 for at autotilpasse'),'F-h...'],
            ['@Dim.',          '4%','data','right', '@Objektets dimension: Streg-bredde, Tegn-højde, målt i px (pixel)','Obj-D...'],
            ['@Farve',         '6%','data','center','@Objektets farve, angives som HTML5 tillader. (red, #FF44DD, rgb)','farve...'],
            ['@Txt-font',     '10%','font','left',  '@Objektets font'.str_nl().tolk('(gyldigt argument til: font-family):'). ShowCol($liste=FontListe(),$col= 2,$sep=str_nl()),'font...','Helvetica'],
            ['@Txt-style',    '15%','data','left',  '@Objektets style'.'<br>'.tolk('(gyldigt argument til: font-weight, font-style). Husk afsluttende semikolon!'),'style...'],
            ['@Grafik',        '0%','hidd','left',  '@Link til grafikfil','graf...'],
            ['@Fremmedsprog',  '0%','hidd','left',  '@Alternativ beskrivelse, f.eks. på engelsk','alt...'],
            ['@Note',         '15%','data','left',  '@Note til objektet','note...']
        ),
      $RowSuff= array(['@Slet', '8%', 'text','center','@Klik på rødt kryds for at slette dette tekstfelt','<ic class="far fa-times-circle" style="color:red; font-size:13px; "></ic>'],
        ),
      $tekster= sql_readB($qstr=
        'SELECT id, form, frm_art, side, besk, just, FORMAT(x0,0), FORMAT(y0,0), FORMAT(dx,0), FORMAT(dy,0), FORMAT(dim,0), colr, font, style, imglnk, lngkey, note '.
        'FROM tblA_forms WHERE form= "'.$frm.'" AND frm_art= "2"',__FILE__, __LINE__) , 
      $ViewHeight= '500px',
      $PadTop= '0px',
      $rowadd='@Tilføj nyt tekst-felt'
    );  
    
    htm_Caption('@Tip:'); htm_nl();
    htm_Plaintxt(
      tolk('@Når du indsætter et variabelnavn, kommer der ved udskrift automatisk et mellemrum mellem variablens indhold og den efterfølgende tekst.').str_nl().
      tolk('@Ønsker du ikke dette mellemrum, kan du afslutte variabelnavnet med et semikolon.').str_nl().
      tolk('@Det er fx. relevant, hvis du vil indsætte teksten Momssats 25% på en faktura.').str_nl().
      tolk('@Her vil kodningen skulle være Momssats $ordre_momssats;% '));
    //  XY_forskydning();
    htm_RudeBund($pmpt='@Gem',$subm=true,'','','','edit');
}

# Kaldes fra: [_system/page_FormGrafik.php] [_system/page_FormText.php] 
function Rude_FormRedigerGrafik($frm,$art,$lang,$papr) { // Kaldes fra: ../_system/page_Formtext.php
  htm_Rude_Top($name= 'edit',$capt= '@Rediger Formular: Grafik',$parms='#',$icon='fas fa-wrench','panelW960',__FUNCTION__);
  htm_TabelInp(
      $HeadLine= SetHeadArr($frm,'@Grafik',$lang,$papr),
      $RowPref= array(  # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:disp! ', '4:ColTip', '5:disp! ']
        ['@BILLEDER:','15%','right','text','  ','$Grafik f.eks. jpg-billeder. Billeder skaleres til den angivne højde/bredde. Det er en fordel, hvis billede er målfast med 720 pt/in.','.?.'],
      ),
      $RowBody= array( # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:placeholder', '6:default'],
            ['@Id.',           '0%','hidd','center','@Index','serial...'],
            ['@Nr.',           '0%','hidd','center','@Formular nr','kode...'],
            ['@Art',           '0%','hidd','center','@Koden for feltes art','art...'],
            ['@Side',          '5%','side','center','@Medtages på udskrifts side. A:alle, 1:første, !1:ikke første, S:sidste, !S:ikke sidste','side...','1'],
            ['@Beskrivelse',   '0%','hidd','left',  '@Feltets tekstindhold samt $variabler',  '-'],
            ['@Just',          '0%','hidd','center','@Justering af teksten:'. ShowCol($liste=JustListe(),$col= 0,$sep='<br>'),'-','V'],
            ['@X-venstre',     '6%','data','right', tolk('@Billedets x-indsætningspunkt målt i mm fra venstre side-kant'),'.x.'],
            ['@Y-bund',        '6%','data','right', tolk('@Billedets y-indsætningspunkt målt i mm fra side-top'),'.y.'],
            ['@Bredde',        '4%','data','right', tolk('@Billedets bredde målt i mm. Der skaleres til den angivne bredde'),'.b.'],
            ['@Højde',         '4%','data','right', tolk('@Billedets højde målt i mm. Hvis originalens H/B-forhold ikke er som angivet her, forvrænges grafikken'),'.h.'],
            ['@Dim.',          '0%','hidd','right', '@Objektets dimension: Streg-bredde, Tegn-højde, målt i px (pixel)','Obj-D...'],
            ['@Farve',         '0%','hidd','center','@Objektets farve, angives som HTML5 tillader. (red, #FF44DD, rgb)','farve...'],
            ['@Txt-font',      '0%','hidd','left',  '@Objektets font'.str_nl().tolk('(gyldigt argument til: font-family):'). ShowCol($liste=FontListe(),$col= 2,$sep=str_nl()),'-'],
            ['@Txt-style',     '0%','hidd','left',  '@Objektets style'.'<br>'.tolk('(gyldigt argument til: font-weight, font-style). Husk afsluttende semikolon!'),'-'],
            ['@Filnavn',      '45%','data','left',  tolk('@Referance til billed-filen (src="Path/Name.typ" alt="Billedtekst")').' (?.jpg)'],
            ['@Fremmedsprog',  '0%','hidd','left',  '@Alternativ beskrivelse, f.eks. på engelsk','alt...'],
            ['@Note',         '25%','data','left',  tolk('@Note til objektet.')],
        ),
      $RowSuff= array(['@Slet', '8%', 'text','center','@Klik på rødt kryds for at slette dette billede','<ic class="far fa-times-circle" style="color:red; font-size:13px; "></ic>'],
        ),
      $images= sql_readB($qstr=
        'SELECT id, form, frm_art, side, besk, just, FORMAT(x0,0), FORMAT(y0,0), FORMAT(dx,0), FORMAT(dy,0), FORMAT(dim,0), colr, font, style, imglnk, lngkey, note '.
        'FROM tblA_forms WHERE form= "'.$frm.'" AND frm_art= "1" AND besk > ""',__FILE__, __LINE__) ,
      $ViewHeight= '300px',
      $PadTop= '0px',
      $rowadd='@Tilføj nyt billede'
    );
    
  htm_TabelInp(
      $HeadLine= array(),
      $RowPref= array(  # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:disp! ', '4:ColTip', '5:disp! ']
            ['STREGER:',      '13%','right','text','','Grafiske linier','.?.'],
        ),
      $RowBody= array( # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:placeholder', '6:default'],
            ['@Id.',           '0%','hidd','center','@Index','serial...'],
            ['@Nr.',           '0%','hidd','center','@Formular nr','kode...'],
            ['@Art',           '0%','hidd','center','@Koden for feltes art','art...'],
            ['@Side',          '5%','side','center','@Medtages på udskrifts side. A:alle, 1:første, !1:ikke første, S:sidste, !S:ikke sidste','','A'],
            ['@Beskrivelse',   '0%','hidd','left',  '@Feltets tekstindhold samt $variabler',  '-'],
            ['@Just',          '0%','hidd','center','@Justering af teksten:'. ShowCol($liste=JustListe(),$col= 0,$sep='<br>'),'-'],
            ['@X-start',       '6%','data','right', tolk('@Stregens x-startpunkt målt i mm fra venstre side-kant'),'.x.'],
            ['@Y-start',       '6%','data','right', tolk('@Stregens y-startpunkt målt i mm fra side-top'),'.y.'],
            ['@delta-X',       '6%','data','right', tolk('@Stregens udstrækning i x-retning målt i mm'),'.dx.'],
            ['@delta-Y',       '6%','data','right', tolk('@Stregens udstrækning i y-retning målt i mm'),'.dy.'],
            ['@Bredde',        '6%','data','right', tolk('@Stregens bredde målt i px'),'.b.'],
            ['@Farve',         '6%','data','center',tolk('@Tekst farve. Se farve skema'),'#Kode.'],
            ['@Txt-font',      '0%','hidd','left',  '@Objektets font'.str_nl().tolk('(gyldigt argument til: font-family):'). ShowCol($liste=FontListe(),$col= 2,$sep=str_nl()),'-'],
            ['@Txt-style',     '0%','hidd','left',  '@Objektets style'.'<br>'.tolk('(gyldigt argument til: font-weight, font-style). Husk afsluttende semikolon!'),'-'],
            ['@Grafik',        '0%','hidd','left',  '@Link til grafikfil','graf...'],
            ['@Fremmedsprog',  '0%','hidd','left',  '@Alternativ beskrivelse, f.eks. på engelsk','alt...'],
            ['@Note',         '45%','data','left',  tolk('@Huske-tip for denne streg...'),' '.tolk('@Stregen angår...')],
        ),
      $RowSuff= array(['@Slet', '8%', 'text','center','@Klik på rødt kryds for at slette denne streg','<ic class="far fa-times-circle" style="color:red; font-size:13px; "></ic>'],
        ),
      $grafik= sql_readB($qstr=
        'SELECT id, form, frm_art, side, besk, just, FORMAT(x0,0), FORMAT(y0,0), FORMAT(dx,0), FORMAT(dy,0), FORMAT(dim,0), colr, font, style, imglnk, lngkey, note '.
        'FROM tblA_forms WHERE form= "'.$frm.'" AND frm_art= "1" AND besk = ""',__FILE__, __LINE__) ,
      $ViewHeight= '500px',
      $PadTop= '10px',
      $rowadd='@Tilføj ny streg'
    );
    //  XY_forskydning();
    htm_RudeBund($pmpt='@Gem',$subm=true,'','','','edit');
} //  Rude_FormRedigerGrafik

# Kaldes fra:  [_system/page_FormOrdrelin.php] [_system/page_FormText.php] 
function Rude_FormRedigerOrdrelin($frm,$art,$lang,$papr) { // Kaldes fra: ../_system/page_Formtext.php
  htm_Rude_Top($name= 'edit',$capt= '@Rediger Formular: Ordrelinier',$parms='#',$icon='fas fa-wrench','panelW960',__FUNCTION__);
  htm_TabelInp(
      $HeadLine= SetHeadArr($frm,'@Ordrelinjer',$lang,$papr),
      $RowPref= array(
            ['@Generelt: ',   '30%','text','right','@Ordreliniers placering på siden: ','Tip','.?.'],
        ),
      $RowBody= array( # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:placeholder', '6:default'],
            ['@Id.',           '0%','hidd','center',  '@Index','serial...'],
            ['@Nr.',           '0%','hidd','center',  '@Formular nr','kode...'],
            ['@Art',           '0%','hidd','center',  '@Koden for feltes art','art...'],
            ['@Side',          '0%','side','center',  '@Udskrift på side kode: A !1 1 S !S','side...','A'],
            ['@Beskrivelse',   '0%','hidd','left',    '@Feltets tekstindhold samt $variabler',  '-'],
            ['@Just',          '0%','hidd','center',  '@Justering af teksten:'. ShowCol($liste=JustListe(),$col= 0,$sep='<br>'),'-'],
            ['@Antal linier',  '8%','data','center',  tolk('@Antal ordrelinier pr. side.'),'.n.'],
            ['@Top-linie',     '8%','data','center',  tolk('@Første ordrelines y-startpunkt (grundlinie) målt i mm fra side-top'),'.y.'],
            ['@Tekst Bredde',  '8%','data','center',  tolk('@Maksimal linie længde for beskrivelse, inden der brydes til ny linie, målt i mm. '),'.Bredde [mm].'],
            ['@Linieafstand',  '8%','data','center',  tolk('@Afstand mellem liniers grundlinie, målt i mm. '),'.Afstand [mm].'],
            ['@Dim.',          '0%','hidd','right',   '@Objektets dimension: Streg-bredde, Tegn-højde, målt i px (pixel)','Obj-D...'],
            ['@Farve',         '0%','hidd','center',  '@Objektets farve, angives som HTML5 tillader. (red, #FF44DD, rgb)','farve...'],
            ['@Txt-font',      '0%','hidd','left',    '@Objektets font'.str_nl().tolk('(gyldigt argument til: font-family):'). ShowCol($liste=FontListe(),$col= 2,$sep=str_nl()),'-'],
            ['@Txt-style',     '0%','hidd','left',    '@Objektets style'.'<br>'.tolk('(gyldigt argument til: font-weight, font-style). Husk afsluttende semikolon!'),'-'],
            ['@Grafik',        '0%','hidd','left',    '@Link til grafikfil','graf...'],
            ['@Fremmedsprog',  '0%','hidd','left',    '@Alternativ beskrivelse, f.eks. på engelsk','alt...'],
            ['@Note',         '30%','data','left',    tolk('@Huske-tip for disse generelle data.'),'.?.'],
        ),
      $RowSuff= array(),
      $ordrlin= sql_readB($qstr=
        'SELECT id, form, frm_art, side, besk, just, FORMAT(x0,0), FORMAT(y0,0), FORMAT(dx,0), FORMAT(dy,0), FORMAT(dim,0), colr, font, style, imglnk, lngkey, note '.
        'FROM tblA_forms WHERE form= "'.$frm.'" AND frm_art= "0" AND side= "G"',__FILE__, __LINE__) ,
      $ViewHeight= '250px',
      $PadTop= '0px'
    );

    htm_TabelInp(
      $HeadLine= array(),
      $RowPref= array(  # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:disp! ', '4:ColTip', '5:disp! ']
          ['ORDRELINIER:',  '15%','text', 'right','  ',tolk('@Tekst linier med ordrepostering.'),'.?.'],
      ),
      $RowBody= array( # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:placeholder', '6:default'],
          ['@Id.',           '0%','hidd', 'center', '@Index','serial...'],
          ['@Nr.',           '0%','hidd', 'center', '@Formular nr','kode...'],
          ['@Art',           '0%','hidd', 'center', '@Koden for feltes art','art...'],
          ['@Side',          '4%','side', 'center', '@Udskrift på side kode: A !1 1 S !S','side...','A'],
          ['@Beskrivelse',  '16%','data', 'left',   tolk('@Navnet på variablen, samt statisk tekst. Variabler som benyttes i ordrelinier, her prefix: £'),'@navn...'],
          ['@Just.',         '4%','just', 'center', tolk('@Justering i feltet: V:venstre, C:centreret, H:højre'),'?','V'],
          ['@X-pos',         '6%','data', 'right',  tolk('@Tekstens x-startpunkt målt i mm fra formularens venstre side-kant'),'.x.'],
          ['@Y0',            '0%','hidd', 'right',  '@Indsætnings Y-koordinat (mm fra formularens top kant)','Y0...'],
          ['@Bredde',        '6%','data', 'right',  tolk('@Reserveret felt bredde målt i [mm]. Længere tekster ombrydes i flere linier'),'.b.'], // Kun væsentlig for Beskrivelse
          ['@Højde',         '6%','data', 'right',  tolk('@Teksthøjde målt i [px]'),'.h.'],
          ['@Dim.',          '0%','hidd', 'right',  '@Objektets dimension: Streg-bredde, Tegn-højde, målt i px (pixel)','Obj-D...'],
          ['@Farve',         '6%','data', 'center', tolk('@Tekst farve. Se farve skema'),'#...'],
          ['@Font',          '8%','font', 'center', tolk('@Skrift type navn: Helvetica, Times, OCRbb12'),'Font navn...','Helvetica'],
          ['@Fed',           '4%','bold', 'center', tolk('@Bold skrift type, også kaldet fed skrift'),'<input type= "checkbox" name="bold" value="" >','.?.'],
          ['@Skrå',          '4%','ital', 'center', tolk('@Skrå skrift type, også kaldet italic'),'<input type= "checkbox" name="italic" value="" >','.?.'],
          ['@Grafik',        '0%','hidd', 'left',  '@Link til grafikfil','graf...'],
          ['@Fremmedsprog',  '0%','hidd', 'left',  '@Alternativ beskrivelse, f.eks. på engelsk','alt...'],
          ['@Note:',        '20%','data', 'left',  tolk('@Huske-tip for denne ordrelinie.'),'.?.']
      ),
      $RowSuff= array(['@Slet', '8%', 'text','center','@Klik på rødt kryds for at slette denne kolonne','<ic class="far fa-times-circle" style="color:red; font-size:13px; "></ic>'],
        ), 
          $ordrlin= sql_readB($qstr=
            'SELECT id, form, frm_art, side, besk, just, FORMAT(x0,0), FORMAT(y0,0), FORMAT(dy,0), FORMAT(dx,0), FORMAT(dim,0), colr, font, style, style, imglnk, lngkey, note '.
            'FROM tblA_forms WHERE form= "'.$frm.'" AND frm_art= "3" ',__FILE__, __LINE__) ,
          $ViewHeight= '500px',
          $PadTop= '10px',
          $rowadd='@Tilføj ny kolonne'
    );
    //  XY_forskydning();
    htm_RudeBund($pmpt='@Gem',$subm=true);
} //  Rude_FormRedigerOrdrelin


# Kaldes fra:  [_system/page_Momssetup.php] [_system/page_Syssetup-udgaar.php] 
function Rude_MomsSetup(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {
  htm_Rude_Top($name= 'moms',$capt= '@Moms indstillinger:',$parms='page_Blindgyden.php',$icon='fas fa-wrench','panelW960',__FUNCTION__);
if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,__FUNCTION__.':1');
  htm_TabelInp(     # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      $HeadLine= array( [' ', '8%','left','show', '', '@Indland'] ),
      $RowPref= array(  # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:disp! ', '4:ColTip', '5:disp! ']
        ['@Salgsmoms (udgående moms): ',    '24%','text','right','@Salg: ','@Den moms du skal betale til SKAT','.?.'],
      ),
      $RowBody= array( # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:placeholder'],
        ['@Nr.',          '4%','data','center', tolk('@Positions nummer i gruppen'),'.Nr.'],
        ['@Beskrivelse', '20%','data','left',   tolk('@Kontobeskrivelse. En beskrivende tekst efter eget valg'),'Tekst... (Opret ny konto)'],
        ['@Konto',        '6%','data','center', tolk('@Det nummer i kontoplanen, som salgsmomsen skal konteres på.'),'Konto...'],
        ['@%-Sats',       '6%','data','center', tolk('@Moms %-sats'),'25%...'],
        ),
      $RowSuff= array(  # ['0:ColLabl', '1:ColWidth', '2:disp!', '3:InpType', '4:FeltJust', '5:ColTip', '6:value!']
        ['@Note',     '30%','text','center',  '@(planlagt)','.?.'],
      ),
      $data= array( [['1'],['@Salgsmoms'],['66100'],['25,00'],['']], [['2'],[''],[''],[''],['']] ),
      $ViewHeight= '500px',
      $PadTop='2px' 
     );
if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,__FUNCTION__.':2');
  htm_TabelInp(     # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      $HeadLine= array(['']),
      $RowPref= array(  # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:disp! ', '4:ColTip', '5:disp! ']
        ['@Købsmoms (indgående moms): ',    '24%','text','right','@Køb: ','@Den moms du skal have retur fra SKAT','.?.'],
      ),
      $RowBody= array( # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:placeholder'],
        ['@Nr.',          '4%','data','center',tolk('@Positions nummer i gruppen'),'.Nr.'],
        ['@Beskrivelse', '20%','data','left',  tolk('@Kontobeskrivelse. En beskrivende tekst efter eget valg'),'Tekst... (Opret ny konto)'],
        ['@Konto',        '6%','data','center',tolk('@Det nummer i kontoplanen, som købsmomsen skal konteres på.'),'Konto...'],
        ['@%-Sats',       '6%','data','center',tolk('@Moms %-sats'),'25%...'],
        ),
      $RowSuff= array(  # ['0:ColLabl', '1:ColWidth', '2:disp!', '3:InpType', '4:FeltJust', '5:ColTip', '6:value!']
        ['@Note',     '30%','text','center',  '@(planlagt)','.?.'],
      ),
      $data= array( [['1'],['@Købsmoms'],['66200'],['25,00'],['']], [['2'],[''],[''],[''],[''] ] ),
      $ViewHeight= '500px',
      $PadTop='2px'
     );
   echo '<hr>';

if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,__FUNCTION__.':3');
  htm_TabelInp(     # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      $HeadLine= array( [' ', '8%','left','show', ' ', '@Udland'] ),
      $RowPref= array(  # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:disp! ', '4:ColTip', '5:disp! ']
        ['@Moms af ydelseskøb i udlandet: ',    '24%','text','right','@Ydel: ',
              '@Ved ydelseskøb i udlandet, skal der betales dansk moms på vegne af sælgeren. Samtidig kan købsmomsen trækkes fra så resultatet bliver 0','.?.'],
      ),
      $RowBody= array( # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:placeholder'],
        ['@Nr.',          '4%', 'data','center',tolk('@Positions nummer i gruppen'),'.Nr.'],
        ['@Beskrivelse', '20%', 'data','left',  tolk('@Kontobeskrivelse. En beskrivende tekst efter eget valg'),'Tekst... (Opret ny konto)'],
        ['@Konto',        '6%', 'data','center',tolk('@Konto til postering af salgsmoms for ydelseskøb i udlandet'),'Konto...'],
        ['@%-Sats',       '6%', 'data','center',tolk('@Moms %-sats'),'25%...'],
        ['@Modkonto',     '6%', 'data','center',tolk('@Konto til postering af købsmoms for ydelseskøb i udlandet'),'Konto...'],
        ),
      $RowSuff= array(  # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:value!     ']
        ['@Note',     '22%','text','center','@(planlagt)','.?.'],
      ),
      $data= array( [['1'],['@Moms af ydelseskøb i udlandet'],['66155'],['25,00'],['66200']], [['2'],[''],[''],[''],[''] ] ),
      $ViewHeight= '500px',
      $PadTop='2px' 
     );

if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,__FUNCTION__.':4');
  htm_TabelInp(     # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      $HeadLine= array( ),
      $RowPref= array(  # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:disp! ', '4:ColTip', '5:disp! ']
        ['@Moms af varekøb i udlandet: ',    '24%','text','right','@Vare: ',
            '@Ved varekøb i udlandet, skal der betales dansk moms på vegne af sælgeren. Samtidig kan købsmomsen trækkes fra så resultatet bliver 0','.?.'],
      ),
      $RowBody= array( # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:placeholder'],
        ['@Nr.',          '4%','data','center', tolk('@Positions nummer i gruppen'),'.Nr.'],
        ['@Beskrivelse', '20%','data','left',   tolk('@Kontobeskrivelse. En beskrivende tekst efter eget valg'),'Tekst... (Opret ny konto)'],
        ['@Konto',        '6%','data','center', tolk('@Konto til postering af salgsmoms for køb i udlandet'),'Konto...'],
        ['@%-Sats',       '6%','data','center', tolk('@Moms %-sats'),'25%...'],
        ['@Modkonto',     '6%','data','center', tolk('@Konto til postering af købsmoms for køb i udlandet'),'Konto...'],
        
        ),
      $RowSuff= array(  # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:value!     ']
        ['@Note',     '22%','text','center','@(planlagt)','.?.'],
      ),
      $data= array( [['1'],['@Moms af varekøb m.v. i udlandet'],['66150'],['25,00'],['66200']], [['2'],[''],[''],[''],[''] ] ),
      $ViewHeight= '500px',
      $PadTop='2px' 
     );

   echo '<hr>';
  htm_TabelInp(     # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      $HeadLine= array( [' ', '8%','left','show', '', '@Rapporter'] ),
      $RowPref= array(  # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:disp! ', '4:ColTip', '5:disp! ']
        ['@Momsrapport (konti som skal indgå i momsrapport): ',    '24%','text','right','@Rap: ','@Her angives intervaller af konti, som skal danne grundlag for momsrapporter.','.?.'],
      ),
      $RowBody= array( # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:placeholder'],
        ['@Nr.',          '4%', 'data','center',tolk('@Positions nummer i gruppen'),'.Nr.'],
        ['@Beskrivelse', '20%', 'data','left',  tolk('@Kontobeskrivelse. En beskrivende tekst efter eget valg'),'Tekst... (Opret ny)'],
        ['@Fra',          '6%', 'data','center',tolk('@Første kontonummer som skal indgå i rapporten'),'Konto...'],
        ['@Til',          '6%', 'data','center',tolk('@Sidste kontonummer som skal indgå i rapporten'),'Konto...'],
        ['@Rubrik A1',    '6%', 'data','center',tolk('@Kontonummer for samlet varekøb i EU'),'Konto...'],
        ['@Rubrik A2',    '6%', 'data','center',tolk('@Kontonummer for samlet ydelseskøb i EU'),'Konto...'],
        ['@Rubrik B1',    '6%', 'data','center',tolk('@Kontonummer for samlet varesalg i EU'),'Konto...'],
        ['@Rubrik B2',    '6%', 'data','center',tolk('@Kontonummer for samlet ydelsessalg i EU'),'Konto...'],
        ['@Rubrik C',     '6%', 'data','center',tolk('@Kontonummer for samlet vare- og ydelsessalg uden for EU'),'Konto...'],
        ),
      $RowSuff= array(  # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:value!     ']
        ['',        '1%','text','center','','',''],
      ), 
      $data= array([['1'],['@Momsrapport'],['66100'],['66200'],['2800'],['2700'],['1220'],['1200'],['1290']],
                   [['2'],[''],[''],[''],[''],[''],[''],[''],['']] 
      ),
      $ViewHeight= '500px',
      $PadTop='2px' 
     );
  htm_RudeBund($pmpt='@Gem',$subm=true);
}


# Kaldes fra:  [_system/page_Stamkort.php] 
function Rude_Stamdata(
  &$firmanavn, &$addr1, &$addr2, &$postnr, &$bynavn, &$ny_email, &$homepage, &$bank_navn, &$bank_reg, &$bank_konto, &$cvrnr, &$tlf, &$fax, &$pbs_nr, &$pbs, &$gruppe, &$fi_nr
) { 
  htm_Rude_Top($name='stamkort',$capt='@Stamdata:',$parms='page_Blindgyden.php',$icon='fas fa-user',$klasse='panelW320',__FUNCTION__);
  htm_CombFelt(                      $type='text',  $name='firmanavn',  $valu= $firmanavn,  $labl='@Firmanavn',   $titl='@Navnet på det firma, regnskabet angår',   $revi=true);
  htm_FrstFelt('50%');  htm_CombFelt($type='text',  $name='addr1',      $valu= $addr1,      $labl='@Adresse',     $titl='@Firmaets adresse',                        $revi=true);
  htm_NextFelt('50%');  htm_CombFelt($type='text',  $name='addr2',      $valu= $addr2,      $labl='@Sted',        $titl='@Supplerende stedsangivelse',              $revi=true);
  htm_LastFelt();                                                                           
  htm_FrstFelt('25%');  htm_CombFelt($type='text',  $name='postnr',     $valu= $postnr,     $labl='@Postnr.',     $titl='@Postnr',                                  $revi=true);
  htm_NextFelt('75%');  htm_CombFelt($type='text',  $name='bynavn',     $valu= $bynavn,     $labl='@Bynavn',      $titl='@Bynavn. firmaets hjemsted',               $revi=true);
  htm_LastFelt();                                                                           
  htm_FrstFelt('50%');  htm_CombFelt($type='mail',  $name='ny_email',   $valu= $ny_email,   $labl='@Mail',        $titl='@Firmaets Mail-adresse',                   $revi=true);
  htm_NextFelt('50%');  htm_CombFelt($type='text',  $name='homepage',   $valu= $homepage,   $labl='@Hjemmeside',  $titl='@Firmaets hjemmeside-adresse',             $revi=true);
  htm_LastFelt();                                                                           
  htm_CombFelt(                      $type='text',  $name='bank_navn',  $valu= $bank_navn,  $labl='@Bank',        $titl='@Bank forbindelse',                        $revi=true);
  htm_FrstFelt('25%');  htm_CombFelt($type='text',  $name='bank_reg',   $valu= $bank_reg,   $labl='@Bank reg.',   $titl='@Bank reg.',                               $revi=true);
  htm_NextFelt('75%');  htm_CombFelt($type='text',  $name='bank_konto', $valu= $bank_konto, $labl='@Bank konto',  $titl='@Bank konto',                              $revi=true);
  htm_LastFelt();
  htm_CombFelt(                      $type='text',  $name='cvrnr',      $valu= $cvrnr,      $labl='@CVR',         
          $titl='@CVR - Virksomheds ID. Tast CVR-nr. omsluttet af *, +, eller / for at importere data fra Erhvervsstyrelsen (Data leveres af CVR API)', $revi=true);
  htm_FrstFelt('50%');  htm_CombFelt($type='text',  $name='tlf',        $valu= $tlf,        $labl='@Telefon.',    
          $titl='@Tlf - Tast telefonnr. omsluttet af *, +, eller / for at importere data fra Erhvervsstyrelsen (Data leveres af CVR API)',              $revi=true);
  htm_NextFelt('50%');  htm_CombFelt($type='text',  $name='fax',        $valu= $fax,        $labl='@Fax',         $titl='@Firmaets fax',                            $revi=true);
  htm_LastFelt();
  if (!$pbs_nr) {
    htm_FrstFelt('40%');  htm_CombFelt($type='text',$name='pbs_nr',     $valu= $pbs_nr,     $labl='@PBS Kreditornr.', $titl='@Firmaets pbsnr',  $revi=true);
    htm_NextFelt('60%');  {if      ($pbs=='B') $listen= array(['','B','@Basis løsning'], ['','', '@Total løsning'], ['','L','@Lev. Service']);
                           elseif  ($pbs=='L') $listen= array(['','L','@Lev. Service'],  ['','B','@Basis løsning'], ['','', '@Total løsning']);
                           else                $listen= array(['','', '@Total løsning'], ['','B','@Basis løsning'], ['','L','@Lev. Service']);
                           htm_OptioFlt($type='text',$name='pbs',       $valu= $pbs,        $labl='@Aftale',      $titl='@Vælg den aftalte løsning',  $revi=true, $optlist= $listen, $action='');
                          }
    htm_LastFelt();
  } else  htm_CombFelt(             $type='text',  $name='pbs_nr', $valu= $pbs_nr, $labl='@PBS Kreditornr.',   $titl='@Firmaets pbsnr',  $revi=true);
  htm_CombFelt(                     $type='text',  $name='gruppe', $valu= $gruppe, $labl='@PBS debitorgruppe', $titl='@Gruppe ',         $revi=true);
  htm_CombFelt(                     $type='text',  $name='fi_nr',  $valu= $fi_nr,  $labl='@FI Kreditornr.',    
          $titl='@Bankernes fælles indbetalingskort (FI-kort). Her angiver du dit FI Kreditornr.',    $revi=true);
  htm_RudeBund($pmpt='@Gem',$subm=true);
}

# Kaldes fra:  [_system/page_Stamkort.php] 
function Rude_Medarbejdere() {
  htm_Tapet_Top($name= 'varekortform',$capt= '@Medarbejdere: ',$parms='#',$icon='fas fa-pen-square','panelW480',__FUNCTION__);
  htm_nl();
  Rude_Ansat($Medarbejdernr, $bankkto, $Navn='Anders',    $Initialer, $Adresse, $Adresse2, $Postnr, $By, $Mail, $Mobil, $Lokalnr, $Lokalfax, $Privattlf, $Bank, $Løn, $Løntillæg, $Bemærkning, $Tiltrådt, $Fratrådt);
  Rude_Ansat($Medarbejdernr, $bankkto, $Navn='Rip',       $Initialer, $Adresse, $Adresse2, $Postnr, $By, $Mail, $Mobil, $Lokalnr, $Lokalfax, $Privattlf, $Bank, $Løn, $Løntillæg, $Bemærkning, $Tiltrådt, $Fratrådt);
  Rude_Ansat($Medarbejdernr, $bankkto, $Navn='Rap',       $Initialer, $Adresse, $Adresse2, $Postnr, $By, $Mail, $Mobil, $Lokalnr, $Lokalfax, $Privattlf, $Bank, $Løn, $Løntillæg, $Bemærkning, $Tiltrådt, $Fratrådt);
  Rude_Ansat($Medarbejdernr, $bankkto, $Navn='Rup',       $Initialer, $Adresse, $Adresse2, $Postnr, $By, $Mail, $Mobil, $Lokalnr, $Lokalfax, $Privattlf, $Bank, $Løn, $Løntillæg, $Bemærkning, $Tiltrådt, $Fratrådt);
  Rude_Ansat($Medarbejdernr, $bankkto, $Navn='Andersine', $Initialer, $Adresse, $Adresse2, $Postnr, $By, $Mail, $Mobil, $Lokalnr, $Lokalfax, $Privattlf, $Bank, $Løn, $Løntillæg, $Bemærkning, $Tiltrådt, $Fratrådt);
  htm_TapetBund($pmpt='@Retur til ?',$subm=false,$title='@Retur til ?');
  for ($x = 5; $x <= 15; $x++) PanelMin($x);  //  Minimer 3. til 15. panel, så kun 1. og 2. panel er maksimeret
}

# Kaldes fra: [_system/page_Stamkort.php]
function Rude_Ansat(&$Medarbejdernr, &$bankkto, &$Navn, &$Initialer, &$Adresse, &$Adresse2, &$Postnr, &$By, &$Mail, 
                    &$Mobil, &$Lokalnr, &$Lokalfax, &$Privattlf, &$Bank, &$Løn, &$Løntillæg, &$Bemærkning, &$Tiltrådt, &$Fratrådt
) { 
  htm_Rude_Top($name='stamkort',$capt='@Ansat:'.' '.$Navn,$parms='page_Blindgyden.php',$icon='fas fa-user',$klasse='panelW320',__FUNCTION__);
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
  htm_RudeBund($pmpt='@Gem',$subm=true);
}


# Kaldes fra:  [_system/page_Brugere.php] 
function Rude_Brugere(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) { global $ØtblRowDrk, $ØtblRowLgt;
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
  htm_Rude_Top($name='brugkort',$capt='@Bruger rettigheder:',$parms='page_Blindgyden.php',$icon='fas fa-user',$klasse='panelW720',__FUNCTION__);
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
  
  echo '<tr><td style="width:15%"><colrlabl> '.
      tolk('@Navn / init.').':&nbsp;</colrlabl></td><td style="width:15%"><colrlabl> '.
      tolk('@Bruger').':</colrlabl></td>';
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
  
  echo '<tr><td style="text-align:right"><colrlabl>'.tolk('@Opret ny bruger').':&nbsp;</colrlabl></td>';
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
  echo '<tr><td style="text-align:right"><colrlabl>'.tolk('@Adgangskode').':&nbsp;</colrlabl></td><td><input class="inputbox" type=password size=12 name=kode value="********************"></td></tr>';
  echo '<tr><td style="text-align:right"><colrlabl>'.tolk('@Gentag kode').':&nbsp;</colrlabl></td><td><input class="inputbox" type=password size=12 name=kode2 value="********************"></td></tr>';
  echo '</tbody></table>';
  htm_RudeBund($pmpt='@Gem',$subm=true);
}

# Kaldes fra:  [_system/page_Valuta.php] 
function Rude_Valuta(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {
  htm_Rude_Top($name= 'valuform',$capt= '@Valutaer: ',$parms='page_Blindgyden.php',$icon='fas fa-euro-sign','panelW320',__FUNCTION__);
  htm_Caption('@Oprettede valutaer:');
  htm_TabelOut($RowLabl='@ændre denne valutas kurs',
            $RowBody= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
              ['@Valuta.',     '25%','', 'text',  'left',   '@Valuta benævnelse','@Valu...'],
              ['@Beskrivelse', '60%','', 'text',  'left',   '@Valuta beskrivelse','@Besk...'],
              ['@Kurs',        '15%','', 'text',  'center', '@Aktuel kurs...','@Kurs...'],
            ),
            $TablData= [['DKK','Danske kroner','100'],['EUR','Europæiske Euro','100'],['USD','Amerikanske Dollar','100']],  # ImportTabFile('../_exchange/varer.tab'),  // Indlæs data fra TAB-fil
            $FilterOn=false, $SorterOn=true, $CreateRec=true, $ModifyRec=true, $ViewHeight='200px' );
            
  $optlist= [['Danske kroner','DKK','DKK - Danmark - Kroner'],['Europæisk Euro','EUR','EUR - EU fællesskabet - Euro'],
             ['US dollar','USD','USD - Amerikansk - Dollar'],['Pund Sterling','GBP','GBP - Det Forenede Kongerige - Pund']];
  htm_nl();
  htm_Caption('@Oversigt over populære valutaer:');
  htm_OptioFlt($type='text',  $name='vkode',      $valu= '',      
                    $labl='@Valutaer',   
                    $titl='@Her kan du slå op, og se aktuelle valuta-koder', 
                    $revi=true, $optlist, $action='');
  $filDATA= ImportTabFile('../_exchange/ISO-valutaer.tab',1,'UTF-x');    $optlist= [];
  foreach ($filDATA as $rec) {array_push($optlist, [ $rec[2].' / '.$rec[3], $rec[0], $rec[0].' : '.$rec[1] ]);}
  htm_nl();
  htm_Caption('@Oversigt over alle valutaer:');
  htm_OptioFlt($type='text',  $name='vkode',      $valu= '',      
                    $labl='@Valutaer',   
                    $titl='@Her kan du slå op, og se mulige valuta-koder', 
                    $revi=true, $optlist, $action='');
  htm_nl();
  htm_RudeBund($pmpt='@Gem',$subm=true);
}

# Kaldes fra:  [_system/page_Valuta.php] 
function Rude_Valutakort(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {
  htm_Rude_Top($name= 'kortform',$capt= '@Valuta ændringer: ',$parms='page_Blindgyden.php',$icon='fas fa-euro-sign','panelW320',__FUNCTION__);
  $valuta= 'DKK';   $beskriv= 'Danske kroner';
  htm_Caption('@Vedligeholdese af:');  echo ' '.$valuta.' - '.$beskriv;
  htm_nl(2);
  htm_Plaintxt('@Der er ikke automatisk vedligeholdelse af kurser i SALDI. Du skal tilpasse dags-kursen manuelt efter behov. F.eks. inden du fakturerer eller bogfører.');
  htm_TabelOut($RowLabl='@se / rette valuta',
            $RowBody= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
              ['@Valør dato', '40%','', 'date',  'center',   '@Den dato kursen er gældende fra','@dato [YYYY-MM-DD]'],
              ['@Ny kurs',    '30%','', 'text',  'center',   '@Angives i %. dvs. værdien i DKK af 100 '.$valuta,'@kurs...'],
              ['@Konto',      '30%','', 'text',  'center', '@Kontonummer fra kontoplanen som skal bruges til valutakursdifferencer og øreafrunding...','@konto...'],
            ),
            $TablData= [['Dato','Kurs','konto'],['Dato','Kurs','konto'],['Dato','Kurs','konto'],['Dato','Kurs','konto'],['Dato','Kurs','konto'],['Dato','Kurs','konto'],
            ['Dato','Kurs','konto'],['Dato','Kurs','konto'],['Dato','Kurs','konto'],['Dato','Kurs','konto']],  # ImportTabFile('../_exchange/varer.tab'),  // Indlæs data fra TAB-fil
            $FilterOn=false, $SorterOn=true, $CreateRec=true, $ModifyRec=false, $ViewHeight='300px' );
  htm_RudeBund($pmpt='@Gem',$subm=true);
}

# Kaldes fra:  [_system/page_Enheder.php] 
function Rude_Enheder(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {
  htm_Rude_Top($name= 'enhedform',$capt= '@Enheder og materialer: ',$parms='page_Blindgyden.php',$icon='fas fa-database','panelW320',__FUNCTION__);
  htm_TabelInp(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
    $HeadLine= array( [' ', '50%','left','show', '', '@Enhedsbetegnelser'] ),
    $RowPref= array(),  # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:disp! ', '4:ColTip', '5:disp! ']
    $RowBody= array( # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:placeholder'],
      ['@Enhed.',       '25%',  'text','left',tolk('@Enhedsbetegnelse').' ','Enh...'],
      ['@Beskrivelse',  '75%',  'text','left',tolk('@Beskrivelse af enheden'),'Beskr...'],
      ),
    $RowSuff= array(),  # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:value!     ']
        $data= array(1,2,3),  # Antal rows ved DEMO
        $ViewHeight= '500px',
        $PadTop='0px'
  );
  htm_TabelInp(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
    $HeadLine= array( [' ', '50%','left','show', '', '@Materiale egenskaber'] ),
    $RowPref= array(),  # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:disp! ', '4:ColTip', '5:disp! ']
    $RowBody= array( # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:placeholder'],
      ['@Materiale.', '75%', 'text','left',tolk('@Materiale'),'Matr...'],
      ['@Densitet',   '25%', 'text','left',tolk('@Materialets massefylde'),'Dens...'],
      ),
    $RowSuff= array(),  # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:value!     ']
        $data= array(1,2,3),  # Antal rows ved DEMO
        $ViewHeight= '500px',
        $PadTop='0px'
  );
### PanelFooter:
#+  NaviTip();
  htm_RudeBund($pmpt='@Gem',$subm=true);
}

# Kaldes fra: 
function Rude_Beholdningsrapp() {
  htm_Rude_Top($name= 'behlform',$capt= '@Varerapport:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-chart-line','panelW320',__FUNCTION__);
    htm_FrstFelt('04%',0); 
    htm_NextFelt('36%');  htm_Prompt('@Vælg kriterier:','right');  //echo '<p align="center">'.tolk('@Angiv kriterier:').'</p> ';
    htm_NextFelt('02%');  
    htm_NextFelt('58%'); # htm_CheckFlt($type='checkbox',$name='somfakt',$valu='somfakt',
                         # $labl='@Husk dem', $titl='@Afmærk her, hvis kriterier skal genbruges.',  $revi=true);
    htm_NextFelt('05%');
    htm_LastFelt();
    htm_OptioFlt($type='text',  $name='varegrp',    $valu= $varegrp,  
                    $labl='@Varegruppe',         
                    $titl='@Vælg den Varegruppe du ønsker at få oplysninger om.',  
                    $revi=true, $optlist= Grp_Liste(),
                    //  [0:Tip, 1:value, 2:Label, 3:Action]
                    $action='');
    htm_OptioFlt($type='text',  $name='afdel',    $valu= $afdel,  
                    $labl='@Afdeling',         
                    $titl='@Vælg den Afdeling du ønsker at få oplysninger om.',  
                    $revi=true, $optlist= [['@Alle ',         '0','@0. Forretning',''],
                                           ['@Ydelser ',      '1','@1. Lager 1',''],
                                           ['@Handelsvarer',  '2','@2. Lager 2','']],
                    $action='');
    htm_OptioFlt($type='text',  $name='saelg',    $valu= $saelg,  
                    $labl='@Sælger',         
                    $titl='@Vælg den Sælger du ønsker at få oplysninger om.',  
                    $revi=true, $optlist= [['@Admin ',    '0','@0. Admin',''],
                                           ['@Revisor ',  '1','@1. Revisor',''],
                                           ['@Bogholder ','2','@2. Revisor',''],
                                           ['@Alle',      '3','@3. Alle','']],
                    $action='');
    htm_FrstFelt('50%',0);  # 
      htm_CombFelt($type='date',$name='firsdato',$valu=$firsdato,$labl='@Periode fra', $titl='@Periode fra dato',$revi=true,$rows='2',$width='20px',$step='',$more='',$plho='');
    htm_NextFelt('50%');  
      htm_CombFelt($type='date',$name='lastdato',$valu=$lastdato,$labl='@Periode til', $titl='@Periode til dato',$revi=true,$rows='2',$width='20px',$step='',$more='');
    htm_LastFelt();
    htm_FrstFelt('20%',0);  
      htm_CombFelt($type='text',$name='varenumr',$valu=$varenumr,$labl='@Varenr',   $titl='@Varenr',$revi=true,$rows='2',$width='20px',$step='',$more='',$plho=' *');
    htm_NextFelt('80%');  
      htm_CombFelt($type='text',$name='varenavn',$valu=$varenavn,$labl='@Varenavn', $titl='@Varenavn',$revi=true,$rows='2',$width='20px',$step='',$more='',$plho=' *');
    htm_LastFelt();
    
    htm_FrstFelt('50%',0);  # 
      htm_CheckFlt($type='checkbox',$name='detalj', $valu= $detalj, $labl='@Detaljeret',  $titl='@Detaljeret',  $revi=true, $more=' '.$pg);
    htm_NextFelt('50%');  
      htm_CheckFlt($type='checkbox',$name='kunslg', $valu= $kunslg, $labl='@Kun salg / DB',  $titl='@Kun salg / DB',  $revi=true, $more=' '.$pg);
    htm_LastFelt();
  
    htm_KnapGrup('@Vis:',true);
      textKnap($label='@Det valgte',  $title='@Vis varer, som opfylder de kriterier, du har angivet ovenfor', $link='../_base/page_Blindgyden.php').'<hr>';
      textKnap($label='@Lagerstatus',     $title='@Se lagerstatus på en vilkårlig dato',                $link='../_base/page_Blindgyden.php').'<hr>';
      textKnap($label='@Lageroptælling',  $title='@Funktion til optælling og regulering af varelager',  $link='../_base/page_Blindgyden.php').'<hr>';
    htm_KnapGrup('@Vis:',false);
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true);
}

# Kaldes fra:  [_lager/page_Beholdningsliste.php] 
function Rude_Beholdningsliste() {
  htm_Rude_Top($name= 'behlform',$capt= '@Beholdningsliste:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-database','panelW640',__FUNCTION__);
  htm_CentrOn(); 
    echo tolk('@Vælg kriterier i panelet til venstre, og få vist resultatet her.'),'<br><br>';
  htm_CentOff();
  htm_RudeBund($pmpt='@Gem',$subm=false);
}

# Kaldes fra:  [_system/page_Rabatgrupper.php] 
function Rude_Rabatgrupper($vg_antal=4, $vrg_antal=true, $dg_antal=3, $drg_antal=true/* DEMO  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {
  htm_Rude_Top($name= 'rabbform',$capt= '@Rabatgrupper:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-database','panelW640',__FUNCTION__);
  htm_CentrOn(); 
    textKnap($label='@Definer selv debitor-rabatgrupper',  $title='@Klik her for at håndtere dine debitor rabatgrupper',$link='../_base/page_Blindgyden.php').'<hr>';
    textKnap($label='@Definer selv vare-rabatgrupper',     $title='@Klik her for at håndtere dine vare rabatgrupper',$link='../_base/page_Blindgyden.php').'<hr>';
  htm_CentOff();
### OVERSKRIFTER:
  echo '<colrlabl>'; 
  htm_FrstFelt('40%',0);  echo 'Debitorgrp \ Varegrp';
  htm_NextFelt('20%');    echo 'Type';
  for ($y=1; $y<=$vg_antal; $y++) { //  Dette bør ændres så rutinen modtager data i arrays!
    if ($vrg_antal) { htm_NextFelt('12%');  echo '<a   title="'.$vgnavn[0][$y].'Klik for at rette navn" href="../_base/page_Blindgyden.php">VG'.$y.'</a>';}  # print "<td title=\"".$vgnavn[0][$y]." | Klik for at rette navn\"><a href=\"rabatgrupper.php?ret_vrgnavn=$y\">&nbsp;VG$y</a></td>";
    else            { htm_NextFelt('12%');  echo '<div title="'.$vgnavn[0][$y].'">VG'.$y.'</div>';}                           # print "<td title=\"".$vgnavn[0][$y]."\">&nbsp;VG$y</td>";
  }
 if ($vrg_antal) {htm_NextFelt('2%');  textKnap($label='@Ny',  $title='@Klik her for at oprette ny vare-rabatgruppe',$link='../_base/page_Blindgyden.php');} # print "<td title=\"Opret ny vare-rabatgruppe\"><a href=\"rabatgrupper.php?vgselfdef=$y\">Ny</a></td>";

  htm_LastFelt();    
  echo '</colrlabl>';
### DATA: //  Dette bør ændres så rutinen modtager data i arrays!
  for ($x=1;$x<=$dg_antal;$x++){   # ($linjebg!=$bgcolor5)?$linjebg=$bgcolor5:$linjebg=$bgcolor; #   print '<tr bgcolor="$linjebg">';
  htm_FrstFelt('25%',0);  ////  Navn:
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
  htm_RudeBund($pmpt='@Gem',$subm=true);
}

# Kaldes fra:  [_system/page_Varegrupper.php] 
function Rude_Varegrupper(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {
  htm_Rude_Top($name= 'systform',$capt= '@Varegrupper:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-database','panelW960',__FUNCTION__);
  htm_CentHead('Varegrupper-konti');
  
  htm_TabelInp(
    $HeadLine= array(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      ['@Tabel &nbsp; ', '20%','left','text', '@Varegrupper', '@Varegrupper'], 
//     ['@Konto-kontrol:','5em','left','text', '@Angiv kontonummer for den konto, hvis bevægelser skal kontrolleres',  '@Nummer...'], 
    ),
    $RowPref= array( #  ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:disp! ', '4:ColTip', '5:disp! ']  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
       #   ['',     '3%','center','text','D',tolk('@Medlem af debitorgruppe'),'']
          ),
    $RowBody= array( # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:placeholder'],
      ['@Nr',               '3%','data', 'center', '@Gruppe nummer'.' ','.?.'],
      ['@Beskrivelse',     '17%','data', 'left',   '@Beskrivelse af gruppen','@Besk...'],
      ['@Lager-tilgang',    '6%','data', 'center', '@Konto for...','@Tilg...'],
      ['@Lager-træk',       '6%','data', 'center', '@Konto for...','@Træk..'],
      ['@Vare-køb',         '6%','data', 'center', '@Konto for...','@Køb..'],
      ['@Vare-salg',        '6%','data', 'center', '@Konto for...','@Salg..'],
      ['@Lager-regulering', '6%','data', 'center', '@Konto for...','@Regu..'],
      ['@Køb i EU',         '6%','data', 'center', '@Konto for...','@Køb..'],
      ['@Salg til EU',      '6%','data', 'center', '@Konto for...','@Salg..'],
      ['@Køb uden for EU',  '8%','data', 'center', '@Konto for...','@Køb..'],
      ['@Salg uden for EU', '8%','data', 'center', '@Konto for...','@Salg..'],
      ),
$RowSuff= array(  # ['0:ColLabl', '1:ColWidth', '2:disp!', '3:InpType', '4:FeltJust', '5:ColTip', '6:value!']
       ['@Omvendt betaling', '6%', 'text','center',  '@Omvendt betaligspligt! Afmærk her, hvis denne kundegruppe er omfattet af omvendt betalingspligt.',
              '<a hrefxxx='.$link.' ><input type= "checkbox" name="bold" value="" ></a>','.?.'],
       ['@Moms fri',         '6%', 'text','center',  '@Moms fri. Afmærk her, hvis ....','<a hrefxxx="'.$link.'" ><input type= "checkbox" name="bold" value="" ></a>','.?.'],
       ['@Lager ført',       '6%', 'text','center',  '@Lager ført. Afmærk her, hvis ...','<a hrefxxx="'.$link.'" ><input type= "checkbox" name="bold" value="" ></a>','.?.'],
       ['@Batch kontrol',    '6%', 'text','center',  '@Batch kontrol. Afmærk her, hvis ..','<a hrefxxx="'.$link.'" ><input type= "checkbox" name="bold" value="" ></a>','.?.'],
       ['@Opera -tion',      '6%', 'text','center',  '@Operation. Afmærk her, hvis ..','<a hrefxxx="'.$link.'" ><input type= "checkbox" name="italic" value="" ></a>','.?.'],
      ), 
              $data= array(
              [['1'],['Ydelser'],[''],[''],['2900'],['1000'],[''],['2700'],['1200'],['2720'],['1250']],
              [['2'],['Handelsvarer'],['55100'],['55100'],['2100'],['1100'],['2600'],['2800'],['1220'],['2820'],['1270']],
              [['3'],['Forbrugsvarer'],[''],[''],['2100'],['1100'],[''],['2800'],['1220'],['2820'],['1270']],
              [['4'],['Fragt/porto'],[''],[''],['2300'],['1300'],[''],['2700'],['1200'],['2720'],['1250']],
              [[''],[''],[''],[''],[''],[''],[''],[''],[''],[''],['']],
              ),  #  DEMOdata
      $ViewHeight= '',
      $PadTop= '0px'
  );
  str_nl();
  htm_CentHead('Vare-Prisgrupper');
    htm_TabelInp(
    $HeadLine= array(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      ['@Tabel  &nbsp; ', '20%','left','text', '@Prisgrupper', '@Prisgrupper'], 
    ),
    $RowPref= array( #  ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:disp! ', '4:ColTip', '5:disp! ']  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
          ),
    $RowBody= array( # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:placeholder'],
      ['@Nr',            '3%','data', 'center', '@Gruppe nummer'.' ','.?.'],
      ['@Beskrivelse',  '15%','data', 'left',   '@Beskrivelse af gruppen','@Besk...'],
      ['@Kost-pris',     '6%','data', 'center', '@Konto for...','@Kost...'],
      ['@Salgs-pris',    '6%','data', 'center', '@Konto for...','@Salgs..'],
      ['@Vejl.-pris',    '6%','data', 'center', '@Konto for...','@Vejl..'],
      ['@B2B-pris',      '6%','data', 'center', '@Konto for...','@B2B..'],
      ),
$RowSuff= array(  # ['0:ColLabl', '1:ColWidth', '2:disp!', '3:InpType', '4:FeltJust', '5:ColTip', '6:value!']
       ['',         '30%', 'text','center',  '','','.?.'],
     ), 
              $data= array(
              [[''],[''],[''],[''],[''],[''],[''],[''],[''],[''],['']],
              ),  #  DEMOdata
      $ViewHeight= '200px',
      $PadTop= '0px'
  );
  str_nl();
  htm_CentHead('Vare-Tilbudsgrupper');
  htm_TabelInp(
    $HeadLine= array(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      ['@Tabel  &nbsp; ', '20%','left','text', '@Tilbudsgrupper', '@Tilbudsgrupper'], 
    ),
    $RowPref= array( #  ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:disp! ', '4:ColTip', '5:disp! ']  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
          ),
    $RowBody= array( # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:placeholder'],
      ['@Nr',            '3%','data', 'center', '@Gruppe nummer'.' ', '.?.'],
      ['@Beskrivelse',  '15%','data', 'left',   '@Beskrivelse af gruppen', '@Besk...'],
      ['@Kost-pris',     '6%','data', 'center', '@Konto for...', '@Kost...'],
      ['@Salgs-pris',    '6%','data', 'center', '@Konto for...', '@Salgs..'],
      ['@Start-dato',    '6%','data', 'center', '@Konto for...', '@Strt..'],
      ['@Slut-dato',     '6%','data', 'center', '@Konto for...', '@Slut..'],
      ),
    $RowSuff= array(  # ['0:ColLabl', '1:ColWidth', '2:disp!', '3:InpType', '4:FeltJust', '5:ColTip', '6:value!']
       ['',         '30%', 'text','center',  '','','.?.'],
     ), 
              $data= array(
              [[''],[''],[''],[''],[''],[''],[''],[''],[''],[''],['']],
              ),  #  DEMOdata
      $ViewHeight= '200px',
      $PadTop= '0px'
  );
  str_nl();
  htm_CentHead('Vare-Rabatgrupper');
  
    htm_TabelInp(
    $HeadLine= array(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      ['@Tabel  &nbsp; ', '20%','left','text', '@Rabatgrupper', '@Rabatgrupper'], 
    ),
    $RowPref= array( #  ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:disp! ', '4:ColTip', '5:disp! ']  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
          ),
    $RowBody= array( # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:placeholder'],
      ['@Nr',            '3%','data', 'center', '@Gruppe nummer'.' ','.?.'],
      ['@Beskrivelse',  '15%','data', 'left',   '@Beskrivelse af gruppen','@Besk...'],
      ['@Type',          '6%','data', 'center', '@Konto for...','@Typ...'],
      ['@Stk. rabat',    '6%','data', 'center', '@Konto for...','@Rabt..'],
      ['@ved antal',     '6%','data', 'center', '@Konto for...','@Antl..'],
       ),
$RowSuff= array(  # ['0:ColLabl', '1:ColWidth', '2:disp!', '3:InpType', '4:FeltJust', '5:ColTip', '6:value!']
       ['',         '30%', 'text','center',  '','','.?.'],
     ), 
              $data= array(
              [[''],[''],[''],[''],[''],[''],[''],[''],[''],[''],['']],
              ),  #  DEMOdata
      $ViewHeight= '200px',
      $PadTop= '0px'
  );
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem, hvis du har ændret noget ovenfor.');
}

# Kaldes fra:  [_system/page_Debkredgrup.php] 
function Rude_DefKredGrp(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {
  htm_Rude_Top($name= 'grupform',$capt= '@Debitor- & Kreditor-grupper:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-database','panelW960',__FUNCTION__,$more=' style= "height:400px" ');
  echo textKnap($label='@INFO', $title='@Her er lidt forklaring omkring brugen af grupper.', $link= '../_base/page_GruppeInfo.php');
  htm_TabelInp(
    $HeadLine= array(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      ['@Tabel  &nbsp; ', '20%','left','text', '@Debitorgrupper', '@Debitorgrupper'], 
    ),
    $RowPref= array( #  ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:disp! ', '4:ColTip', '5:disp! ']  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
          ['',     '3%','text','center','D',tolk('@Medlem af debitorgruppe'),'']
          ),
    $RowBody= array( # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:placeholder'],
      ['@Nr',          '3%','data', 'center', '@Gruppe nummer'.' ','...auto...'],
      ['@Beskrivelse','30%','data', 'left',   '@Beskrivelse af gruppen','Besk...'],
      ['@Momsgrp',     '8%','data', 'center', '@Momsgruppe som debitorgruppen skal tilknyttes.',tolk('@Momsgr...')],
      ['@Samlekt.',    '8%','data', 'center', '@Samlekonto for debitorgruppen','S-kt..'],
      ['@Valuta',      '8%','data', 'center', '@Den valuta som gruppen føres i','Valu..'],
      ['@Sprog',       '8%','data', 'center', '@Det sprog der skal anvendes ved fakturering','Spr..'],
      ['@Modkonto',    '8%','data', 'center', '@Modkonto ved udligning af åbne poster','M-kt...'],
      ['@Provision',   '8%','data', 'right',  '@Provisionsprocent! Her angives hvor stor en procentdel af dækningsbidraget der medgår ved beregning af provision.','Pro...'],
      ),
$RowSuff= array(  # ['0:ColLabl', '1:ColWidth', '2:disp!', '3:InpType', '4:FeltJust', '5:ColTip', '6:value!']
        ['@OB',      '5%', 'text','center',  '@Omvendt betaligspligt! Afmærk her, hvis denne kundegruppe er omfattet af omvendt betalingspligt.','<a hrefxxx="'. 
              $link.'" ><input type= "checkbox" name="bold" value="" ></a>','.?.'],
        ['@B2B',     '5%', 'text','center',  '@Business to business! Afmærk her, hvis der skal anvendes b2b priser ved salg til denne kundegruppe.','<a hrefxxx="'.
              $link.'" ><input type= "checkbox" name="italic" value="" ></a>','.?.'],
      ), 
              $data= array(
              [['1'],['Danske Debitorer'],['S1'],['56100'],['DKK'],['Dansk'],['58000'],['11.2 %']],
              [['2'],['Europæiske Debitorer'],['E1'],[''],['EUR'],['Engelsk'],[''],['']],
              [['3'],[''],[''],[''],[''],[''],[''],['']],
              ),  #  DEMOdata
      $ViewHeight= '',
      $PadTop= '0px'
  );
  htm_nl();
  htm_TabelInp(
    $HeadLine= array(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      ['@Tabel  &nbsp; ', '20%','left','text', '@Kreditorgrupper', '@Kreditorgrupper'], 
    ),
    $RowPref= array( #  ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:disp! ', '4:ColTip', '5:disp! ']  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
          ['',     '3%','text','center','K',tolk('@Medlem af kreditorgruppe'),'']
          ),
    $RowBody= array( # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:placeholder'],
      ['@Nr',          '3%','data', 'center', '@Gruppe nummer'.' ','...auto...'],
      ['@Beskrivelse','30%','data', 'left',   '@Beskrivelse af gruppen','Besk...'],
      ['@Momsgrp',     '8%','data', 'center', '@Momsgruppe som kreditorgruppen skal tilknyttes.',tolk('@Momsgr...')],
      ['@Samlekt.',    '8%','data', 'center', '@Samlekonto for kreditorgruppen','S-kt..'],
      ['@Valuta',      '8%','data', 'center', '@Den valuta som gruppen føres i','Valu..'],
      ['@Sprog',       '8%','data', 'center', '@Det sprog der skal anvendes ved kommunikation med kreditoren','Spr..'],
      ['@Modkonto',    '8%','data', 'center', '@Modkonto ved udligning af åbne poster','M-kt...'],
      ['@S.moms grp',  '8%','data', 'center', '@Momsgruppe for salgsmoms ved omvendt betalingspligt.','M-grp...'],
      ),
    $RowSuff= array(  # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:value!     ']
      ['@OB',          '5%','text',  'center', '@Omvendt betaligspligt! Afmærk her, hvis denne leverandørgruppe er omfattet af omvendt betalingspligt.','<a hrefxxx="'.
            $link.'" ><input type= "checkbox" name="bold" value="" ></a>','.?.'],
      ['',             '5%','tal2d', 'right' , '@Business to business! Afmærk her, hvis der skal anvendes b2b priser ved salg til denne leverandørgruppe.'],
        ),
              $data= array(
              [['1'],['Danske Kreditorer'],['K1'],['65100'],['DKK'],['Dansk'],['58000'],['']],
              [['2'],[''],[''],[''],[''],[''],[''],['']],
              ),  #  DEMOdata
      $ViewHeight= '',
      $PadTop= '0px'
  );
  htm_RudeBund($pmpt='@Gem',$subm=true);
}

  
# Kaldes fra: 
function Rude_Syssetup() {
  htm_Rude_Top($name= 'systform',$capt= '@Varegrupper:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-database','panelW960',__FUNCTION__);
  $spantekst1= tolk('@En beskrivende tekst efter eget valg');
	$spantekst2= tolk('@Det nummer i kontoplanen som salgsmomsen skal konteres p&aring;.');
	$spantekst3= tolk('@Moms %.');

  htm_RudeBund($pmpt='@Gem',$subm=true);
}


# Kaldes fra:  [_lager/page_Varemodtagelse.php] [_lager/page_Varer.php] [_system/page_Varerelat.php] 
function Rude_Varer(&$DATA/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {
  include_once "../_config/connect.php";   #+  Database tilkobling
  htm_Rude_Top($name= 'vareform',$capt= '@Vareliste:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-database','panelWmax',__FUNCTION__);
  htm_TabelOut($RowLabl='@se varekort for dette produkt',
            $RowBody= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
              ['@Varenr.',    '7%','', 'text',  'left',   '@Varenummer. Entydig nummerkode, som benyttes til sortering, summering mv.','@Numr...'],
              ['@Enhed',      '5%','', 'text',  'left',   '@Paknings enhed','@Enh...'],
              ['@Beskrivelse','33%','','text',  'left',   '@Beskrivende tekst, som benyttes ved ordre/faktura','@Besk...'],
              ['@Kostpris',   '6%','', 'text',  'right',  '@Produktets kostpris','@Kost...'],
              ['@Salgspris',  '6%','', 'text',  'right',  '@Produktets normale salgspris','@Salgs...'],
              ['@Vejl_pris',  '6%','', 'text',  'right',  '@Produktets vejledende pris','@Vejl...'],
              ['@Note',      '10%','', 'text',  'center', '@Produkt note','@Note...'],
              ['@Gruppe',     '5%','', 'text',  'center', '@Varegruppe','@Grup...'],
              ['@Beholdn.',   '6%','', 'text',  'center', '@Lagerbeholdning','@Beh...'],
              ['@Lokation.',  '6%','', 'text',  'center', 'Hvor varen befinder sig','@Lok...'],
              ),
            $DATA,  // $TablData= ImportTabFile('../_exchange/varer.tab',1),  // Indlæs data fra TAB-fil
            $FilterOn=true, $SorterOn=true, $CreateRec=true, $ModifyRec=true, $ViewHeight='200px' );
  htm_nl();
  htm_KnapGrup('@Her kan du:',true,false);
    textKnap($label='@Ny vare',         $title='@Klik her for at oprette en ny vareregistrering',$link='../_base/page_Blindgyden.php');
    textKnap($label='@Indkøbsforslag',  $title='@Klik her for at lave et indkøbsforslag',$link='../_base/page_Blindgyden.php');
    textKnap($label='@Se ordrebeholdning', $title='@Opslag - Se oversigt over ordrebeholdning',$link='../_base/page_Blindgyden.php');
    textKnap($label='@Visning',         $title='@Visning - Vælg hvad der skal vises',$link='../_base/page_Blindgyden.php');
  htm_KnapGrup('@Her kan du:',false,false);
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
//  var_dump($DATA);
//  Vis_Data($DATA);
}



# Kaldes fra:  [_lager/page_Varemodtagelse.php] [_lager/page_Varer.php] 
function Rude_Varekort(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) 
{global $Ønovice;
  $varenr= '80110';
  $enhdpris= '1596.00';
  $enhdlist= '1800';
  $enhdansk= '1500';
  
  htm_Tapet_Top($name= 'varekortform',$capt= '@Varekort: ',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW110',__FUNCTION__);
  htm_nl();
  SpalteTop(960); # 0. spalte
  htm_CentrOn(); 
    textKnap($label='@<= Se forrige',   $title='@Klik her vise forrige varenummer',$link='../_base/page_Blindgyden.php');
    htm_Caption('@Varenummer: '.$varenr);
    textKnap($label='@Se næste =>',     $title='@Klik her vise næste varenummer',$link='../_base/page_Blindgyden.php');
  htm_CentOff();
  SpalteBund(); # 0. spalte
  
  
  SpalteTop(320); # 1. spalte
  htm_Rude_Top($name= 'varekortform1',$capt= '@Generelt:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
  htm_CombFelt($type='text',  $name='varenumr', $valu= $varenumr=$varenr,   $labl='@Varenummer', 
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
  htm_RudeBund($pmpt='@Gem',$subm=true);
  
  
  NextSpalte(320);
  htm_Rude_Top($name= 'varekortform2',$capt= '@Iøvrigt:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
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
  htm_RudeBund($pmpt='@Gem',$subm=true);
  SpalteBund(); # 1. spalte
  
  
  SpalteTop(240); # 2. spalte
  htm_Rude_Top($name= 'varekortform3',$capt= '@Enheds Priser:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW240',__FUNCTION__);
  /* echo 'Pr. Enhed:'; */
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
  
  htm_RudeBund($pmpt='@Gem',$subm=true);
  
  
  htm_Rude_Top($name= 'varekortform4',$capt= '@Periode-Tilbud:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW240',__FUNCTION__);
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
  htm_RudeBund($pmpt='@Gem',$subm=true);
    
    
  htm_Rude_Top($name= 'varekortform5',$capt= '@Mængde-rabatter:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW240',__FUNCTION__);
  htm_OptioFlt($type='text',  $name='enhed0',    $valu= $enhed0,  
                    $labl='@Rabat metode',         
                    $titl='@Vælg den enhed du ønsker at bruge.',  
                    $revi=true, $optlist= array(
                    ['','%','%'],
                    ['','Kr.','Kr.']),$action='');
  htm_FrstFelt('50%');    htm_CombFelt($type='tal2dc',  $name='stkrabat', $valu= $stkrabat,   $labl='@Stk. rabat ved antal',  
      $titl='@Minimumsmængde for at yde mængderabat', $revi=true, $rows='2',$width='',$step='', $more='', $plho=tolk('@Antal...'));
  htm_NextFelt('50%');    htm_CombFelt($type='tal2dc',  $name='antrabat', $valu= $antrabat,   $labl='@%- rabat ved antal',    
      $titl='@Minimumsmængde for at yde procent rabat', $revi=true, $rows='2',$width='',$step='', $more='', $plho=tolk('@Antal...'));
  htm_lastFelt(); 
  htm_RudeBund($pmpt='@Gem',$subm=true);
  
  
  htm_Rude_Top($name= 'varekortform6',$capt= '@Colli:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW240',__FUNCTION__);
  htm_CombFelt($type='text',    $name='collsize', $valu= $collsize, $labl='@Størrelse',        
      $titl='@Angiv en tekst der beskriver dimensionerne',       $revi=true, $rows='2',$width='',$step='');
  htm_CombFelt($type='text',    $name='collydre', $valu= $collydre, $labl='@Ydre størrelse',   
      $titl='@Angiv en tekst der beskriver de ydre dimensioner', $revi=true, $rows='2',$width='',$step='' );
  htm_CombFelt($type='tal2dc',  $name='collanbr', $valu= $collanbr, $labl='@Anbruds kostpris', 
      $titl='@Angiv et beløb der beskriver anbruds kostprisen',  $revi=true, $rows='2',$width='',$step='' );
  htm_CombFelt($type='tal2dc',  $name='collkost', $valu= $collkost, $labl='@Kostpris',         
      $titl='@Angiv et beløb der beskriver kostprisen',          $revi=true, $rows='2',$width='',$step='' );
  htm_RudeBund($pmpt='@Gem',$subm=true);
  
  NextSpalte(320); # 2. spalte
 
 
  htm_Rude_Top($name= 'varekortform7',$capt= '@Enheder:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW240',__FUNCTION__);
  htm_OptioFlt($type='text',  $name='enhed0',    $valu= $enhed0,  
                    $labl='@Enhed',         
                    $titl='@Vælg den enhed du ønsker at bruge.',  
                    $revi=true, $optlist= array(
                    ['','Stk','Stk'],
                    ['','Palle','Palle']),$action='');
  htm_OptioFlt($type='text',  $name='enhed1',    $valu= $enhed1,  
                    $labl='@Alternativt',         
                    $titl='@Vælg den alternative enhed du ønsker at bruge.',  
                    $revi=true, $optlist= array(
                    ['','Stk','Stk'],
                    ['','Palle','Palle']),$action='');
  htm_CombFelt($type='text',    $name='enhdindh', $valu= $enhdindh,   $labl='@Indhold/enhed',  
      $titl='@Angiv en tekst der beskriver indholdet pr. enhed', $revi=true, $rows='2',$width='',$step='' );
  htm_CombFelt($type='tal2dc',  $name='enhdpris', $valu= $enhdpris,   $labl='@Pris/enhed',     
      $titl='@Angiv et beløb der beskriver prisen pr. enhde', $revi=true, $rows='2',$width='',$step='' );
  htm_RudeBund($pmpt='@Gem',$subm=true);
 
 
  htm_Rude_Top($name= 'varekortform8',$capt= '@Beholdning:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW240',__FUNCTION__);
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
  htm_RudeBund($pmpt='@Gem',$subm=true);
  
  
  htm_Rude_Top($name= 'varekortform9',$capt= '@Grupper:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW240',__FUNCTION__);
  htm_OptioFlt($type='text',  $name='enhed0',     $valu= $enhed0,  
                    $labl='@Varegruppe',          $titl='@Vælg den Varegruppe varen skal være tilknyttet',  
                    $revi=true, $optlist= Grp1Liste(),$action='');
  htm_OptioFlt($type='text',  $name='enhed0',     $valu= $enhed0,  
                    $labl='@Prisgruppe',          $titl='@Vælg den Prisgruppe varen skal være tilknyttet.',  
                    $revi=true, $optlist= PrisListe(),$action='');
  htm_OptioFlt($type='text',  $name='enhed0',     $valu= $enhed0,  
                    $labl='@Tilbudsgruppe',       $titl='@Vælg den Tilbudsgruppe varen skal være tilknyttet',  
                    $revi=true, $optlist= TilbListe(),$action='');
  htm_OptioFlt($type='text',  $name='enhed0',     $valu= $enhed0,  
                    $labl='@Rabatgruppe',         $titl='@Vælg den Rabatgruppe varen skal være tilknyttet',  
                    $revi=true, $optlist= rabtListe(),$action='');
  htm_RudeBund($pmpt='@Gem',$subm=true);
  
  NextSpalte(320); # 3. spalte
 
 
  htm_Rude_Top($name= 'varekortform10',$capt= '@Kategorier:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW400',__FUNCTION__);
  htm_CombFelt($type='text',  $name='regn', $valu= $regnskab,     $labl='@Opret ny',         
      $titl=tolk('@Opret en ny kategori: Skriv navnet på kategorien her.').'<br>'.
      tolk('@For at oprette en underkategori skrives id på den overstående kategori foran navnet med | som adskillelse, f.eks 31|Herresokker.').'<br>'.
      tolk('@Id findes ved at holde musen over kategoriens navn.'), 
        $revi=true, $rows='2',$width='',$step='', $more='', $plho=tolk('@Angiv evt. navn på en ny vare kategori...'));
  
  htm_TabelInp(
    $HeadLine= array(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      ['@Tabel  &nbsp; ', '25%','left','text', '@Produkt kategorier', '@Kategori'], 
    ),
    $RowPref= array( #  ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:disp! ', '4:ColTip', '5:disp! ']  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
          ),
    $RowBody= array( # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:placeholder'],
    //  ['@Id',         '6%','data', 'center', '@Id nummer'.' ','.?.'],
      ['@Id',            '8%','data', 'left',   '@Kategoriens index','@id...'],
      ['@Beskrivelse',  '62%','data', 'left',   '@Beskrivelse af kategorien','@Besk...'],
       ),
    $RowSuff= array(  # ['0:ColLabl', '1:ColWidth', '2:disp!', '3:InpType', '4:FeltJust', '5:ColTip', '6:value!']
      ['@Tilknyt',      '10%','data', 'center', '@Sæt flueben her for at knytte $firmanavn til denne kategori','<input type="checkbox" name="kat_valg[$d]" $checked>'],
      ['@Omdøb',        '10%','data', 'center', '@Klik på grønt kryds for at omdøbe kategorien',
          '<a href="varekort.php?id=$id&rename_category=$kat_id[$d]" onclick="return confirm("Vil du omdøbe denne kategori?")"><ic class="far fa-times-circle" style="color:green; font-size:13px;"></ic></a>'], // <img src=../_assets/icons/rename.png border=0>
      ['@Slet',         '10%','data', 'center', '@Klik på rødt kryds for at slette kategorien',
          '<a href="varekort.php?id=$id&delete_category=$kat_id[$d]" onclick="return confirm("Vil du slette denne katagori?")"><ic class="far fa-times-circle" style="color:red; font-size:13px;"></ic></a>'], //  <img src=../_assets/icons/delete.png border=0>
     ), 
              $data= array(
              [[''],[''],[''],['']],
              [[''],[''],[''],['']],
              [[''],[''],[''],['']],
              ),  #  DEMOdata
      $ViewHeight= '',
      $PadTop= '0px',
      $rowadd='@Opret ny kategori'
  );
  
  htm_Plaintxt('Opret underkategori ved at angive hovedkategori-Id foran underkategori-navn, adskilt med tegnet: | ');  
  htm_RudeBund($pmpt='@Gem',$subm=true);
  
 
  htm_Rude_Top($name= 'varekortform11',$capt= '@Varianter:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW400',__FUNCTION__);
//  $temp= $Ønovice;  $Ønovice= false;
  htm_TabelInp(
    $HeadLine= array(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      ['@Tabel  &nbsp; ', '25%','left','text', '@Produkt varianter', '@Varianter'], 
    ),
    $RowPref= array( #  ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:disp! ', '4:ColTip', '5:disp! ']  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
          ),
    $RowBody= array( # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:placeholder'],
    //  ['@Id',         '6%','','data', 'center', '@Id nummer'.' ','.?.'],
      ['@Beskriv.',  '40%','data', 'left',   '@Beskrivelse af varianten','@Besk...'],
      ['@Stregkd.',  '20%','data', 'center', '@Variantens stregkode','@Kode...'],
      ['@Beholdning','14%','data', 'center', '@Lager beholdning af varianten','@Beh..'],
       ),
    $RowSuff= array(  # ['0:ColLabl', '1:ColWidth', '2:disp!', '3:InpType', '4:FeltJust', '5:ColTip', '6:value!']
       ['@Slet',      '8%', 'text','center','@Klik på rødt kryds for at slette denne variant fra listen?','<ic class="far fa-times-circle" style="color:red; font-size:13px;"></ic>'],  //  <img src=../_assets/icons/delete.png border=0>
       ['@Skjul',     '8%', 'text','center','@Klik på blåt kryds for at skjule denne variant i listen?','<ic class="far fa-times-circle" style="color:blue; font-size:13px;"></ic>'],
     ), 
              $data= array(
              [[''],[''],[''],['']],
              [[''],[''],[''],['']],
              [[''],[''],[''],['']],
              ),  #  DEMOdata
      $ViewHeight= '500px',
      $PadTop= '0px',
      $rowadd='@Opret ny variant'
  );
//  $Ønovice= $temp;
  //htm_nl();
  htm_RudeBund($pmpt='@Gem',$subm=true); 
  
  
  htm_Rude_Top($name='menuform' ,$capt='@Samlevare -dele', $parms='page_Blindgyden.php', $icon='fas fa-plus', $klasse='panelW400',__FUNCTION__);
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
    htm_TabelInp( 
      $HeadLine= array(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
        ['@Tabel  &nbsp; ', '35%','left','text', '@Produkt dele', '@Vare delposter'], 
      ),
      $RowPref= array( ),#  ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:disp! ', '4:ColTip', '5:disp! ']  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
            
      $RowBody= array( # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:placeholder'],
        ['@Pos.',         '10%','data', 'left',   '@Positions nr af del-vare','@pos...'],
        ['@Leverandør.',  '44%','data', 'left',   '@Leverandør nummer & navn','@Lev...'],
        ['@Varenr.',      '18%','data', 'center', '@Leverandørens varenummer','@Vare..'],
        ['@Kostpris',     '18%','data', 'right', '@Delpostens kostpris','@Kost..'],
         ),
      $RowSuff= array(  # ['0:ColLabl', '1:ColWidth', '2:disp!', '3:InpType', '4:FeltJust', '5:ColTip', '6:value!']
         ['@Slet',        '10%', 'text','center','@Klik på rødt kryds for at slette denne post fra listen?','<ic class="far fa-times-circle" style="color:red; font-size:13px;"></ic>'],  //  <img src=../_assets/icons/delete.png border=0>
       ), 
                $data= array(
                [[''],[''],[''],['']],
                [[''],[''],[''],['']],
                [[''],[''],[''],['']],
                [[''],[''],[''],['']],
                [[''],[''],[''],['']],
                ),  #  DEMOdata
        $ViewHeight= '500px',
        $PadTop= '0px',
        $rowadd='@Opret ny delvare'
    );
  htm_RudeBund($pmpt='@Gem',$subm=true); 
  
  
  SpalteBund(); # 3. spalte
  
  htm_hr();
  htm_CentrOn();
    textKnap($label='@Ny Modtage liste',  $title='@Klik her for at oprette en ny modtagelse',$link='../_lager/page_Varemodtagelse.php');
    textKnap($label='@Leverandøropslag',  $title='@Opslag - Se ...',$link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_TapetBund($pmpt='@Retur til vareliste',$subm=true,$title='@Retur til vareliste');
  htm_hr();
  Rude_Leverandorer();
  htm_hr();
  Rude_Varemodtagelse();
  
  for ($x = 3; $x <= 15; $x++) PanelMin($x);  //  Minimer 3. til 15. panel, så kun 1. og 2. panel er maksimeret
  PanelMax(4);    //  Enhedspriser
  PanelMax(9);    //  Beholdning
  PanelMax(12);   //  Varianter
  // PanelBetjening();
}   //  Rude_Varekort

# Kaldes fra: 
function Rude_Leverandorer() {
  htm_Rude_Top($name= 'leveform',$capt= '@Leverandøropslag:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-pen-square','panelWmax',__FUNCTION__);
  htm_TabelOut($RowLabl='@se listens indhold',
            $RowBody= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
              ['@Kontonr.',  '85','','text',  'left',   '@Entydig nummerkode..','@Kont...'],
              ['@Navn',     '20%','','date',  'left',   '@Leverandørens navn','@DNavn...'],
              ['@Adresse',  '15%','','text',  'left',   '@Leverandørens adresse: Gade & husnr','@Addr...'],
              ['@Sted',     '15%','','text',  'left',   '@Supplerende adresse','@Sted...'],
              ['@Postnr',   '10%','','text',  'left',   '@Postnummer','@Post...'],
              ['@Bynavn',   '15%','','text',  'left',   '@Bynavn','@By...'],
              ['@Land',     '10%','','text',  'left',   '@Land','@Land...'],
              ['@Telefon',  '10%','','text',  'left',   '@Telefon','Telf...'],
              ),
            #$TablData= ImportTabFile('../_exchange/varer.tab'),  // Indlæs data fra TAB-fil
            $TablData= [['1003','3.dk','Scandiagade 8	','','2450','København SV','DK Danmark',''],['1002','OK Benzin','Åhaven 11','','8260','Viby J','DK Danmark',''],
                        ['1001','Malergrossisten','Industrivej 12','','8600','Århus C','DK Danmark','']], 
            $FilterOn=true, $SorterOn=true, $CreateRec=true, $ModifyRec=true, $ViewHeight='80px', $Angaar='Rude_Leverandorer');

  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
}



# Kaldes fra:  [_lager/page_Varemodtagelse.php] 
function Rude_Varemodtagelse(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {
  htm_Rude_Top($name= 'varemodtform',$capt= '@Vare modtagelse:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-pen-square','panelWmax',__FUNCTION__);
  htm_TabelOut($RowLabl='@se listens indhold',
            $RowBody= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
              ['@Id.',            '8%','','text',  'left',   '@Entydig nummerkode..','@Id...'],
              ['@Dato',          '12%','','date',  'left',   '@Listens oprettelsesdato','@Dato [YYYY-MM-DD]'],
              ['@Oprettet af',   '15%','','text',  'left',   '@Initialer for den som har oprettet listen','@Opret...'],
              ['@Bemærkning',    '30%','','text',  'left',   '@Tilknyttet note','@Bem...'],
              ['@Modtaget af',   '15%','','text',  'left',   '@Initialer for den som har modtaget varerne','@Modt...'],
              ['@Modtaget dato', '10%','','date',  'left',   '@Modtagelses datoen','@Dato [YYYY-MM-DD]'],
              ),
            #$TablData= ImportTabFile('../_exchange/varer.tab'),  // Indlæs data fra TAB-fil
            $TablData= [[1,'Dato','Oprettet','Bemærkning','Modtaget','Modtaget'],
                        [2,'Dato','Oprettet','Bemærkning','Modtaget','Modtaget'],
                        [3,'Dato','Oprettet','Bemærkning','Modtaget','Modtaget']], 
            $FilterOn=true, $SorterOn=true, $CreateRec=true, $ModifyRec=true, $ViewHeight='80px', $Angaar='Rude_Varemodtagelse');
  htm_CentrOn(); htm_nl();
    textKnap($label='@Ny modtageliste',  $title='@Klik her for at oprette en vareregistrering',$link='../_base/page_Blindgyden.php');
    textKnap($label='@Vis alle lister',  $title='@Klik her for at se alle lister, (Filteret nulstilles)',$link='../_base/page_Blindgyden.php');
  htm_CentOff();

  str_hr();
  echo '<tc><b>'.  tolk('@DETALJER:').' &nbsp;'.tolk('@Her vises liste Id: 2').'</b></tc>'; 
  htm_TabelInp(
        $HeadLine= array( ['@Angår:', '18%','left','show', ' ', '@Modtage registrering'] ),
        $RowPref= array( ),#  ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:disp! ', '4:ColTip', '5:disp! ']  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
            $RowBody= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
              ['@Varenr.',       '8%','text',  'left',   '@Entydigt varenummer','@Vare...'],
              ['@Antal',         '6%','text',  'right',  '@Vare antallet','@Antal...'],
              ['@Beskrivelse',  '36%','show',  'left',   '@Vare beskrivelse, svarende til det angivne varenr.','@auto...'],
              ['@Leveret',      '25%','show',  'left',   '@Dato for levering, udfyldes automatisk med dags dato','@auto...'],
              ['@Lager',        '25%','show',  'left',   '@Lageret hvor varen er tilknyttet, ved varens oprettelse','@auto...'],
              ),
            $RowSuff= array(  # ['0:ColLabl', '1:ColWidth', '2:disp!', '3:InpType', '4:FeltJust', '5:ColTip', '6:value!']
#         ['@Slet',        '10%', '','text','center','@Klik på rødt kryds for at slette denne post fra listen','<i class="fa fa-times fa-lg" style="color:red; "></i>'],  //  <img src=../_assets/icons/delete.png border=0>
#         ['@Skjul',       '10%', '','text','center','@Klik på blåt kryds for at skjule denne post i listen','<i class="fa fa-times fa-lg" style="color:blue; "></i>'],
       ), 
#       #$TablData= ImportTabFile('../_exchange/varer.tab'),  // Indlæs data fra TAB-fil
            $TablData= [[1001,'Antal','Beskrivelse','Leveret','Lager'],[1002,'Antal','Beskrivelse','Leveret','Lager'],
                        [1003,'Antal','Beskrivelse','Leveret','Lager'],[1004,'Antal','Beskrivelse','Leveret','Lager']], # 'Varenr.','Antal','Beskrivelse','Leveret','Lager'
        $ViewHeight= '500px',
        $PadTop= '0px',
        $rowadd='@Tilføj ny postering'
        );
        
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
}

# Kaldes fra:  [_system/page_Lagre.php] [_system/page_Licens.php] 
function Rude_Lagre(&$Nr, &$Beskrivelse, &$Afd) {
  htm_Rude_Top($name= 'lagrform',$capt= '@Lagre:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
  htm_TabelInp(
        $HeadLine= array( ['@Angår:', '45%','left','show', 'Kode: LG', '@Lager registrering'] ),
        $RowPref= array(),
        $RowBody= array( #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
          ['@Nr.',          '22%','text',  'left',  '@Entydigt Lager nummer','@Nr...'],
          ['@Beskrivelse',  '60%','show',  'left',  '@Lager beskrivelse.','@besk...'],
          ['@Afd.',         '28%','show',  'left',  '@Lageret hvor varen er tilknyttet, ved varens oprettelse','@afd...'],
        ),
        $RowSuff= array(), 
        $TablData= [],
        $ViewHeight= '500px', $PadTop= '0px', $rowadd='@Tilføj ny postering'
        );
  htm_RudeBund($pmpt='@Gem',$subm=true);
}


# Kaldes fra:  [_system/page_Projekter.php] 
function Rude_Projekter(&$Nr, &$Beskrivelse) {
  htm_Rude_Top($name= 'projform',$capt= '@Projekter:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
  htm_TabelInp(
        $HeadLine= array( ['@Angår:', '45%','left','show', 'Kode: PRJ', '@Projekt registrering'] ),
        $RowPref= array(),
        $RowBody= array( #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
          ['@Nr.',          '30%','text',  'left',  '@Entydigt Projekt nummer','@Nr...'],
          ['@Beskrivelse',  '70%','show',  'left',  '@Projekt beskrivelse.','@besk...'],
        ),
        $RowSuff= array(), 
        $TablData= [],
        $ViewHeight= '500px', $PadTop= '0px', $rowadd='@Tilføj ny postering'
        );
  htm_RudeBund($pmpt='@Gem',$subm=true);
}

# Kaldes fra:  [_system/page_Afdelinger.php] 
function Rude_Afdelinger(&$Nr, &$Beskrivelse, &$Afd) {
  htm_Rude_Top($name= 'afdlform',$capt= '@Afdelinger:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
  htm_TabelInp(
        $HeadLine= array( ['@Angår:', '45%','left','show', 'Kode: AFD', '@Afdelings registrering'] ),
        $RowPref= array(),
        $RowBody= array( #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
          ['@Nr.',          '22%','text',  'left',  '@Entydigt Afdeling nummer','@Nr...'],
          ['@Beskrivelse',  '60%','show',  'left',  '@Navnet på Afdelingen.','@besk...'],
          ['@Afd.',         '28%','show',  'left',  '@Lager tilknyttet Afdelingen','@afd...'],
        ),
        $RowSuff= array(), 
        $TablData= [],
        $ViewHeight= '500px', $PadTop= '0px', $rowadd='@Tilføj ny postering'
        );
  htm_RudeBund($pmpt='@Gem',$subm=true);
}

# Kaldes fra:  [_system/page_Programsprog.php] 
function Rude_LanguageJuster() {
  global $ØsprogTabl, $ØprogSprog, $ØlanguageTable, $ØsprogCol, $ØsprogRow;
  $ØsprogCol= $_SESSION['ØsprogCol'];
  $ØsprogRow= $_SESSION['ØsprogRow'];
  $col= $ØsprogCol;  $row= $ØsprogRow;
  $rowmax= count($ØlanguageTable);
  $col= max($col,1);  $col= min($col,7);  $row= max($row,1);  $row= min($row,$rowmax);
  $optlist= SPR_Liste();

  htm_Rude_Top($name='', $capt='@Ændring af program tekster:', $parms='', $icon='fa-language', 'panelW640', __FUNCTION__);
  htm_FrstFelt('45%');    
    htm_Formstart($name='sprogform'); ## Rediger: Sproget
      SprogValg($ØprogSprog);
    htm_Formslut();
  htm_NextFelt('55%');    
    htm_Plaintxt($labl='@Programmets aktuelt benyttede sprog.'); //    echo tolk('@Programmets aktuelt benyttede sprog.');
  htm_LastFelt();    
  $sprogtxt= tolk('@Sprog frase').': '.$optlist[$col-1][2];
  htm_Rammestart($Caption='@Hvilken frase vil du redigere:');
      $TablData= array(); $x= 0;
      foreach ($ØlanguageTable as $rakke) {array_push($TablData, [$x++,$rakke[0],$rakke[$col]]);}
      htm_Caption($labl='@Her ser du frase numrene og en søgbar liste over sprog-fraser:');
      htm_TabelOut($RowLabl='@se ordre',$RowBody= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]  
            ['@Nr',         '6%','','',     'center', '@Index/løbenummer','@Index...'],
            ['@SYSTEM key','40%','','text', 'left',   '@Tekst-frasens nøgle','@Nøgle...'],
            [$sprogtxt,    '44%','','text', 'left',   '@Tekst som benyttes og kan tilpasses','@Tekst...']),
          $TablData, $doFilter=false, $doSort=true, $CreateRec=false, $ModifyRec=false,
              $ViewHeight='300px',$Angaar='Rude_LanguageJuster');
    htm_Caption($labl='@Her vælger du frasen, som du vil redigere:');
    htm_FrstFelt('35%');    
    htm_Formstart($name='sprogix'); ## Rediger: index til sprogkolonne
      htm_OptioFlt($type='text', $name='colix', $valu=$col,
          $labl= '@Rediger sprog', 
          $titl= tolk('@Hvilket sprog vil du redigere ? <br>') ,
          $revi=true, 
          $optlist,
          $action= $result= $_POST[$name],
          $events= 'onchange="this.form.submit();" ');
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
  str_nl();  htm_Caption($labl='@Original:');
  str_nl();  htm_Caption($labl=trim($ØlanguageTable[$row][0],'@'),$style='color:#900000;');
  htm_Formstart($name='reviform'); ## Rediger: Sprog frasen
  str_nl();  htm_Caption($labl='@Rediger her:');
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
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Luk og gå retur til hovedmenu');
  // ExportTabFile('../_exchange/SprogExport', chr(9), $ØlanguageTable);
  // ExportTabFile('../_exchange/SprogExport', '","', $ØlanguageTable);
}

# Kaldes fra: 
function GemogBrug() {
  ExportTabFile('../_config/MitSprog_DB', '","', $ØlanguageTable); //  GEM:  
  sprogDB_import($fname='../_config/MitSprog_DB.csv');             //  BENYT:
}

# Kaldes fra: 
function SprogExport($languageTable) {
 # ExportTabFile('../_exchange/SprogExport', '","', $languageTable);
  msg_Dialog('info',ucfirst(tolk('@Fortsæt')),'$(this).dialog("close")','','','','',ucfirst(tolk('@Udført Export:')), 
                   ucfirst(tolk('@Der er udført en export af sprogtabellen, til filen: ../_exchange/SprogExport.csv')));
}

# Kaldes fra:  [_system/page_Divsetup2.php] [_system/page_Kontoindstill.php] 
function Rude_Kontoindstilling(&$regnskabnavn='', &$servport='', &$usernavn='', &$usercode='', &$protokol='') 
{
  htm_Rude_Top($name= 'kontoform',$capt= '@Kontoindstilling:',$parms='../_system/page_Kontoindstill.php',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
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
                    ),$action='onchange="getComboA(this)"');
  htm_RudeBund($pmpt='@Gem',$subm=true);
}
 
  
# Kaldes fra:  [_finans/page_Provisionsrapport.php] [_system/page_Provision.php] 
function Rude_Provision() 
{global $Ø_DagList;
  htm_Rude_Top($name= 'provisi',$capt= '@Provision:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
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
                    $action='onchange="getComboA(this)"');
  htm_RudeBund($pmpt='@Gem',$subm=true);
}
 
# Kaldes fra:  [_system/page_Personlig.php] 
function Rude_Saldisetup() {global $ØProgTitl, $Ønovice, $ØFullFilt, $ØTastkeys;
  htm_Rude_Top($name= 'personl',$capt= tolk('@Hjælp i').$ØProgTitl.':',$parms='',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
  $Ønovice=   htm_CheckFlt($type='checkbox',$name='novice', $valu= $Ønovice,  
               $labl='@Vis tips for begynder:', $titl=tolk('@Hvis du afmærker dette felt, vil').
               $ØProgTitl.' '.tolk('@vise nyttige tips for begyndere.'));
  $ØFullFilt= htm_CheckFlt($type='checkbox',$name='fullfilt', $valu= $ØFullFilt,  
               $labl='@Filter hjælp:', $titl=tolk('@Hvis du afmærker dette felt, vil').
               $ØProgTitl.' '.tolk('@vise hjælpetekster til filter-funktionalitet.'));
  $ØTastkeys= htm_CheckFlt($type='checkbox',$name='tastkeys', $valu= $ØTastkeys,  
               $labl='@Vis tastatur bogstavers genveje:', $titl=tolk('@Hvis du afmærker dette felt, vil').$ØProgTitl.
               ' '.tolk('@vise tastatur bogstavs genveje på knapper.'));
  $ØRollTabl= htm_CheckFlt($type='checkbox',$name='usemaxview', $valu= $ØRollTabl,  
               $labl='@Vis ikke tabeller i vinduer:', $titl=tolk('@Hvis du afmærker dette felt, vil').$ØProgTitl.' '.
               tolk('@vise tabeller i fuld højde. Nyttigt hvis du udprinter data med browseren.'));
  htm_RudeBund($pmpt='@Gem',$subm=true);
  $_SESSION['Ønovice']=   $Ønovice;  
  $_SESSION['ØFullFilt']= $ØFullFilt; 
  $_SESSION['ØTastkeys']= $ØTastkeys;
  $_SESSION['ØRollTabl']= $ØRollTabl;
}
 
# Kaldes fra:  [_system/page_Personlig.php] 
function Rude_Personlig() 
{global $ØprogSprog;
  htm_Rude_Top($name= 'personl',$capt= '@Personlige valg:',$parms='#', $icon='fa-pen-square','panelW320',__FUNCTION__);
  
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
  setvKnap ($label='@Skift Tema (Klik 2x)',$title='@Ændring af Øtema', $source, $result, $akey='');
#  htm_nl();  echo 'NY værdi: '.$result;
  $_SESSION["Øtema"]= $result;
  
  SprogValg($ØprogSprog);
  
  echo '<p>DatoVælger: <input type="date" id="datepicker" placeholder="DatePicker:Klik i feltet"></p>';

  htm_hr();  htm_Caption('@Fremhævning af felter:');
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
              $action='onchange="getComboA(this)"');
  htm_RudeBund($pmpt='@Gem',$subm=true);
}
 
 
# Kaldes fra:  [_system/page_Ordrerelat.php] 
function Rude_Ordrerelat() 
{
  htm_Rude_Top($name= 'ordrerelat',$capt= '@Ordre relateret:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW640',__FUNCTION__);
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
   htm_CheckFlt($type='checkbox',$name='procenttillag', $valu= 'procenttillag',      //  findtekst(683/684
               $labl='@Procenttillæg',  
               $titl= tolk('@Skrives en værdi her, vil der fremkomme et redigerbart felt på ordresiden med den angivne værdi. ').
                      tolk('@Procenttillægget er et tillæg til den samlede fakturasum før momsberegning. '),  
               $revi=true, $more='');
  htm_FrstFelt('50%');   
  htm_CombFelt($type='text',  $name='procentvare', $valu= $procentvare,       //  findtekst(685/686
                          $labl= '@Procenttillæg',  
                          $titl= '@Angiv her hvilken konto i kontoplanen procenttillægget skal konteres på.', 
                          $revi=true, $rows='2',$width='30px');
  htm_NextFelt('50%');    echo '%';
  htm_LastFelt();   
  htm_FrstFelt('50%');   
  htm_CombFelt($type='text',  $name='pctvare', $valu= $pctvare,       //  findtekst(288/287 Varenr. for rabat / For at kunne give rabat på kontantsalg, skal dette felt udfyldes med varenummeret for den vare som bruges til formålet.
                          $labl= '@Varenr. for procenttillæg',  
                          $titl= '@For at kunne give rabat på kontantsalg, skal dette felt udfyldes med varenummeret for den vare som bruges til formålet.', 
                          $revi=true, $rows='2',$width='30px');
  htm_NextFelt('50%');   
  htm_CombFelt($type='text',  $name='varerabat', $valu= $varerabat,     //  findtekst(744/745: Varenr. for sæt / Sættes der et varenummer her bliver det muligt at samle en gruppe varer i en salgsordre som et sæt og give en samlet pris for denne gruppe.
                          $labl= '@Varenr. for rabat',  
                          $titl= '@Sættes der et varenummer her, bliver det muligt at samle en gruppe varer i en salgsordre, som et sæt og give en samlet pris for denne gruppe.', 
                          $revi=true, $rows='2',$width='30px'); //  Kun redigerbar hvis:  $samlet_pris=true
  htm_LastFelt();   
  htm_FrstFelt('50%');   
  htm_CombFelt($type='text',  $name='box7', $valu= $kontantkonto,    //  findtekst(687/688
                          $labl= '@Kontonummer for kontantsalg.',  
                          $titl= '@Angiv hvilken konto betalingen skal konteres på ved kontantsalg. Hvis feltet er tomt oprettes en åben post på beløbet på kundens konto.', 
                          $revi=true, $rows='2',$width='30px'); 
  htm_NextFelt('50%');   
  htm_CombFelt($type='text',  $name='box10', $valu= $kortkonto,   //  findtekst(690/689
                          $labl= '@Kontonummer for salg på kreditkort.',  
                          $titl= '@Angiv hvilken konto betalingen skal konteres på ved salg på kreditkort. Hvis feltet er tomt oprettes en åben post på beløbet på kundens konto.', 
                          $revi=true, $rows='2',$width='30px');
  htm_LastFelt();   

  htm_RudeBund($pmpt='@Gem',$subm=true);
}
 
# Kaldes fra:  [_system/page_Varerelat.php] 
function Rude_Varerelat() 
{
  htm_Rude_Top($name= 'varerelat',$capt= '@Varerelateret:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
  htm_Caption('@Varerelateret:');
  htm_OptioFlt($type='text',  $name='Momskode',   $valu= $Momskode, 
              $labl='@Momskode',  
              $titl='@Momskode for salgspriser på varekort',  
              $revi=true, $optlist= [['','S1','S1:Salgsmoms 25%','','valgt'],[]],  //  [0:Tip, 1:value, 2:Label, 3:Action]
              $action='onchange="getComboA(this)"');
  
  htm_hr();  htm_Caption('@Varianter:');
  htm_CombFelt($type='text',  $name='variant', $valu= $Variant,   
                          $labl= '@Ny variant',  
                          $titl= '@', 
                          $revi=true, $rows='2',$width='30px');
  htm_RudeBund($pmpt='@Gem',$subm=true);
}
 
 
# Kaldes fra:  [_system/page_Prislister.php] 
function Rude_Prislister() 
{
  htm_Rude_Top($name= 'prislist',$capt= '@Prislister:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW960',__FUNCTION__);
  htm_Caption('@Prislister:');
  htm_nl();  echo tolk('@Prislisterne er lister med priser, som hentes fra en extern ressource, eksempelvis en fil på en hjemmeside eller et ftp-sted.').'<br>';
  htm_nl();
  htm_TabelOut($RowLabl='@se prislisten',
            $RowBody= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
              ['@Prisliste.',         '6%','','text',  'left',  '@Prisliste','@Prisliste...'],
              ['@Leverandør',         '8%','','text',  'left',  '@Leverandør','@Leverandør...'],
              ['@URL til prislisten','22%','','text',  'left',  '@URL','@url...'],
              ['@Filtype',            '6%','','text',  'left',  '@Filtype','@Filtype...'],
              ['@Rabat',              '8%','','text',  'left',  '@Rabat','@Rabat...'],
              ['@Varegruppe',        '18%','','text',  'left',  '@Varegruppe','@Varegruppe...'],
              ['@Lev.rabat',          '8%','','text',  'left',  '@Lev.rabat','@Lev.rabat...'],
              ['@Aktiv',              '4%','','text',  'left',  '@Aktiv','@Aktiv...'],
              ['@Slet',               '4%','','text',  'left',  '@Slet','@Slet...'],
              ),
            #$TablData= ImportTabFile('../_exchange/varer.tab'),  // Indlæs data fra TAB-fil
            $TablData= [[1001,'Leverandør','URL','Filtype','Rabat','Varegruppe','Lev.rabat','Aktiv','Slet'],[1002,'Leverandør','URL','Filtype','Rabat','Varegruppe','Lev.rabat','Aktiv','Slet'],
                        [1003,'Leverandør','URL','Filtype','Rabat','Varegruppe','Lev.rabat','Aktiv','Slet'],[1004,'Leverandør','URL','Filtype','Rabat','Varegruppe','Lev.rabat','Aktiv','Slet']], 
            $FilterOn=true, $SorterOn=true, $CreateRec=true, $ModifyRec=true, $ViewHeight='100px',$Angaar='Prislister');
  
  htm_Rammestart($Caption='@OPSLAG - alternativ til filter:');
  htm_FrstFelt('10%');  
  htm_NextFelt('25%');    htm_OptioFlt($type='text',  $name='name',   $valu= 'Leverandør', 
                    $labl='@Leverandør',  
                    $titl='@Leverandør',  
                    $revi=true, $optlist=[],
                    $action='onchange="getComboA(this)"');
  htm_NextFelt('25%');    htm_OptioFlt($type='text',  $name='name',   $valu= 'Filtype', 
                    $labl='@Filtype',  
                    $titl='@Filtype',  
                    $revi=true, $optlist= [['Tabulator separeret','tab','TAB',''],
                                           ['Sql format','sql','SQL',''],
                                           ['Hypertekst','htm','HTML','']],  //  [0:Tip, 1:value, 2:Label, 3:Action]
                    $action='onchange="getComboA(this)"');  
  htm_NextFelt('30%');    htm_OptioFlt($type='text',  $name='name',   $valu= 'Varegruppe', 
                    $labl='@Varegruppe',  
                    $titl='@Varegruppe',  
                    $revi=true, $optlist= [['Tabulator ','1','1. Ydelser',''],
                                           ['Sql format','2','2. Handelsvarer',''],
                                           ['Sql format','3','3. Forbrugsvarer',''],
                                           ['Hypertekst','4','4. Fragt/Porto','']],  //  [0:Tip, 1:value, 2:Label, 3:Action]
                    $action='onchange="getComboA(this)"');  
  htm_NextFelt('10%');  
  htm_LastFelt();  
  htm_Rammeslut();

  htm_RudeBund($pmpt='@Gem',$subm=true);
}
 
 
# Kaldes fra: [_system/page_Backup.php] 
function Rude_Backup() {global $Øsaldihost;
  htm_Rude_Top($name= 'backup',$capt= '@Sikkerhedskopiér:',$parms='../_base/page_Hovedmenu.php',$icon='far fa-save','panelW640',__FUNCTION__);
  htm_Caption('@Backup / Restore af dit regnskab:');
  htm_CentrOn(); 
    textKnap($label='@Gem sikkerhedskopi',    $title='@Klik her for at gemme dit regnskab et sikkert sted.',    $link='../_base/page_Blindgyden.php');
    textKnap($label='@Indlæs sikkerhedskopi', $title='@Klik her for indlæse en tidligere gemt sikkerhedskopi',  $link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_Rammestart($Caption='@Om backup:');
  echo tolk('@Her kan du tage backup af det aktuelle regnskab. Har du flere regnskaber, skal der tages backup af hvert enkelt. (Kræver selvstændigt login.)').'<br>';
  echo tolk('@Backuppen omfatter kun indholdet i database-tabeller med regnskabsindhold.').' ';
  echo tolk('@Backup af filer (billeder, bilag, formularer, ændrede supportfiler, ...), skal udføres med et fil kopierings program,').' ';
  echo tolk('@f.eks. via en FTP-forbindelse. Nogle af filerne, kan du dog selv hente, ved at benytte export-mulighederne i programmet.').'<br>';
  echo tolk('@En komplet backup, skal omfatte den totale database, og samtlige filer i systemets mapper.').' ';
  echo tolk('@Det kan kun udføres af en system administrator, hos hosting leverandøren.').'<br>';
  echo tolk('@Benytter du').' '.'<colrlabl>'.$Øsaldihost.'</colrlabl>, '.tolk('@er det med i den service, du betaler for.');
  htm_Rammeslut();
  htm_Caption('@Backup af supportfiler:');
  htm_CentrOn(); 
    textKnap($label='@Gem datafiler (billeder)',      $title='@Planlagt mulighed, for at gemme filer med brugerdata.',  $link='../_base/page_Blindgyden.php');
    textKnap($label='@Gem regnskabsbilag (pdf)',      $title='@Planlagt mulighed, for at gemme filer med brugerdata.',  $link='../_base/page_Blindgyden.php');
    textKnap($label='@Gem designfiler (formularer)',  $title='@Planlagt mulighed, for at gemme filer med brugerdata.',  $link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk vinduet og gå retur til hovedmenu');
}


 
# Kaldes fra:  [_system/page_Bilagsinfo.php] 
function Rude_Bilagsinfo($ftpservaddr= 'bilag_999@ssl2.saldi.dk.') {
  htm_Rude_Top($name= 'backup',$capt= '@Bilagshåndtering:',$parms='page_Blindgyden.php',$icon='far fa-save','panelW640',__FUNCTION__);
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
      ], $action='');
  htm_CheckFlt($type='checkbox',$name='googdocs', $valu= $googdocs,  $labl='@Benyt Google Docs on-line',  $titl='@Er du bruger af Googles online-systemer... !)',  $revi=true, $more=' '.$pg);
  
  htm_hr();
  htm_RadioGrp($type='vert',  $name='bevar',  $labl='@Opbevaring af bilag:', $titl='@Her kan du vælge mellem opbevarinsmulighederne', 
               $optlist= array(['extern','@FTP på egen server','@eller',true],['intern','@FTP intern (mod betaling)','']),$action='');
  htm_Caption('Udfyldes ved egen FTP-server:');
  htm_FrstFelt('40%');  htm_CombFelt($type='text',  $name='ftpsted', $valu= $ftpsted, $labl= '@FTP-URL',      $titl= '@Navn eller IP-nummer på ftp-server', $revi=true, $rows='1',$width='130px');
  htm_NextFelt('30%');  htm_CombFelt($type='text',  $name='ftpuser', $valu= $ftpuser, $labl= '@FTP-bruger',   $titl= '@Brugernavn på ftpserver',            $revi=true, $rows='1',$width='130px');
  htm_NextFelt('30%');  htm_CombFelt($type='text',  $name='ftpkode', $valu= $ftpkode, $labl= '@FTP-password', $titl= '@Adgangskode til ftpserver',          $revi=true, $rows='1',$width='130px');  
  htm_LastFelt(); 
  htm_FrstFelt('50%');  htm_CombFelt($type='text',  $name='ftp_bilag_mappe',    $valu= $ftp_bilag_mappe,    $labl= '@Bilag-Mappe',    $titl= '@Mappe til bilag på ftpserver',      $revi=true, $rows='1',$width='230px');  
  htm_NextFelt('50%');  htm_CombFelt($type='text',  $name='ftp_dokument_mappe', $valu= $ftp_dokument_mappe, $labl= '@Dokument-Mappe', $titl= '@Mappe til dokumenter på ftpserver', $revi=true, $rows='1',$width='230px');
  htm_LastFelt();  
  
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='');
}
 
# Kaldes fra:  [_system/page_Diversevalg.php] 
function Rude_Diversevalg() {
  htm_Rude_Top($name= 'diversevalg',$capt= '@Diverse:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW480',__FUNCTION__);
  htm_Caption('@Diverse valg:');
  htm_nl();
  htm_CheckFlt($type='checkbox',$name='googdocs', $valu= $googdocs,  $labl='@Tvungen valg af debitorgruppe på debitorkort',   
          $titl='@Hvis dette felt afmærkes, tvinges brugeren til aktivt at vælge debitorgruppe ved oprettelse af debitorer.',  $revi=true, $more=' '.$pg);
  htm_CheckFlt($type='checkbox',$name='googdocs', $valu= $googdocs,  $labl='@Tvungen valg af kundeansvarlig på debitorkort',  
          $titl='@Hvis dette felt afmærkes, tvinges brugeren til aktivt at vælge kundeansvarlig ved oprettelse af debitorer',  $revi=true, $more=' '.$pg);
  htm_CheckFlt($type='checkbox',$name='googdocs', $valu= $googdocs,  $labl='@Tilføj ekstra felter på ansatte',                
          $titl='@Ved at afmærke her får du op til 14 ekstra felter på ansattes stamkort, for egne ansattes',  $revi=true, $more=' '.$pg);
  htm_hr();
  htm_CheckFlt($type='checkbox',$name='googdocs', $valu= $googdocs,  $labl='@Brug betalingslister',                           
          $titl='@Benyt betalingslister',  $revi=true, $more=' '.$pg);
  // htm_CheckFlt($type='checkbox',$name='googdocs', $valu= $googdocs,  $labl='@Integration med DocuBizz',                       
          // $titl='@Benyt import fra DocuBizz - Det intelligente fakturasystem',  $revi=true, $more=' '.$pg);
  htm_CheckFlt($type='checkbox',$name='googdocs', $valu= $googdocs,  $labl='@Brug jobkort',                                   
          $titl='@Jobkort findes i debitorkonti. Her kan du definere opgavebeskrivelser til medarbejdere osv.',  $revi=true, $more=' '.$pg);
  //  htm_hr();
  htm_CheckFlt($type='checkbox',$name='googdocs', $valu= $googdocs,  $labl='@Brug HTML/CSS til formulargenerering',           
          $titl='@Afmærkes feltet anvendes HTML/CSS til formulargenerering',  $revi=true, $more=' '.$pg);
  htm_CheckFlt($type='checkbox',$name='googdocs', $valu= $googdocs,  $labl='@Tillad forskellige datoer på samme bilagsnummer i kassekladde.',  
          $titl=tolk('@Afmærk her for at undtrykke advarsel i kassekladden, hvis der anvendes samme bilagsnummer til flere bilag med forskellige datoer. ').
      tolk('@(F.eks, hvis et kontoudtog fra bank bogføres som ét bilag)'),  $revi=true, $more=' '.$pg);
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='');
}
 
# Kaldes fra:  [_system/page_Rykkerrel.php] 
function Rude_Rykkerrel() {
  htm_Rude_Top($name= 'diversevalg',$capt= '@Rykkerrelateret:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
  htm_Caption('@Rykker ansvarlig:');
  htm_nl();
  htm_OptioFlt($type='text', $name='opbevar', $valu= $opbevar, $labl='Brugernavn', 
          $titl='@Brugernavn for "rykkeransvarlig" - Når brugeren logger ind, adviseres denne, hvis der skal rykkes - Hvis navn ikke angives adviseres alle.', $revi=true, $optlist= 
          [['@Alle','alle','@--Alle--'], 
           ['@Admin','admin','@Admin']
          ], $action='');
  htm_CombFelt($type='text',  $name='ansvmail', $valu= $ansvmail,   
                          $labl= '@Mailadresse',  
                          $titl= '@Mailadresse for "rykkeransvarlig". Hvis angivet sendes email fra denne adresse, når der skal rykkes. (Når nogen logger ind - uanset hvem)', 
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
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='');
}
 
# Kaldes fra:  [_system/page_Tjeklister.php] 
function Rude_Tjeklister() {
  htm_Rude_Top($name= 'tjeklist',$capt= '@Tjeklister:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
  htm_Caption('@Tjeklister:');
  htm_nl();
  htm_CombFelt($type='text',  $name='nytjek', $valu= $nytjek,   
                          $labl= '@Ny tjekliste',  
                          $titl= '@Navn på ny tjekliste', 
                          $revi=true, $rows='2',$width='30px', $step='', $more='',$plho=tolk('@Liste...'));
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='Gem');
}
 
 
# Kaldes fra:  [_system/page_Differencer.php] 
function Rude_Differencer() {
  htm_Rude_Top($name= 'tjeklist',$capt= '@Differencer:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW240',__FUNCTION__);
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
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='');
}
 
# Kaldes fra:  [_system/page_Massefakt.php] 
function Rude_Massefakt() {
  htm_Rude_Top($name= 'diversevalg',$capt= '@Massefakturering:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
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
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='');
}
 
# Kaldes fra:  [_system/page_Formtekst.php] 
function Rude_Formtekst($filDATA) {
  htm_Rude_Top($name= 'diversevalg',$capt= '@Formular tekster:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW640',__FUNCTION__,$more=' style= "height:750px" ');
  htm_Caption('@Tekster på formularer:');
  htm_nl();
  htm_Rammestart($Caption='@Om teksterne:');
    htm_Plaintxt('@Teksterne benyttes ikke i programfladen, men til udskrivning af blanketter.').'<br>';
    htm_Plaintxt('@Du kan formattere teksterne med html-koder').'<br>';
    htm_Plaintxt('@Systemet er ikke anvendt endnu, men blot for at demonstre redigering.').'<br>';
  htm_Rammeslut();
  $data= array();  foreach ($filDATA as $rec) array_push($data, [$rec[0],$rec[1],[$rec[1],['x']]]);
  # var_dump($data);
  htm_TabelInp(
    $HeadLine= array( ['@Tabel:', '18%','left','show', ' ', '@Dansk sprog'] ),
      $RowPref= array(),
      $RowBody= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
        ['@Id',          '5%','show', 'center',  '@Tekstens id','@Auto...'],
        ['@Vist tekst', '20%','show', 'left',    '@Nuværende vist HTML-tekst','@Tekst...'],
        ['@Tekst med format koder',   '75%','area', 'left',    '@Korrigerbar HTML-tekst','@Tekst...'],
    ),
    $RowSuff= array(),
    $data,
    $ViewHeight= '500px',
    $PadTop='0px' # max-height: 300px;
  );
  htm_CentrOn(); 
  htm_nl();
    textKnap($label= '@Exporter til csv-fil',    $title= '@Klik her for gemme alle tekster i en fil, som kan indlæses i regneark',  $link= '../_base/page_Blindgyden.php'); // SprogExport($ØlanguageTable)
    textKnap($label= '@Importer fra csv-fil',    $title= '@Klik her for indlæse alle tekster fra en fil som du udpeger',            $link= '../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='');
}
 
# Kaldes fra:  [_system/page_Imogexport.php] 
function Rude_Imogexport() {
  htm_Rude_Top($name= 'imexport',$capt= '@Data export/import:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW480',__FUNCTION__);
  htm_Caption('@Overførsel af data til/fra filer:');
  htm_Rammestart($Caption='@Export - Import:');
    htm_FrstFelt('40%',0);    htm_Caption('@Kontoplan:');
    htm_NextFelt('60%');
      textKnap($label='@Eksportér', $title='@Eksportér kontoplan',  $link='../_base/page_Blindgyden.php');
      textKnap($label='@Importér',  $title='@Importér kontoplan',   $link='../_base/page_Blindgyden.php');
      textKnap($label='@NOTE!',     $title=tolk('@Eksportér: Den aktive kontoplan!').'<br>'.
                tolk('Importér kontoplan - erstatter kontoplanen for nyeste regnskabsår! (det aktive overskrives)'),  $link='');
    htm_LastFelt();
    htm_FrstFelt('40%',0);    htm_Caption('@Formularer:');
    htm_NextFelt('60%');
      textKnap($label='@Eksportér', $title='@Eksportér Formularer',  $link='../_base/page_Blindgyden.php');
      textKnap($label='@Importér',  $title='@Importér Formularer',   $link='../_base/page_Blindgyden.php');
    htm_LastFelt();
    htm_FrstFelt('40%',0);    htm_Caption('@Debitorer/Kreditorer:');
    htm_NextFelt('60%');
      textKnap($label='@Eksportér', $title='@Eksportér Debitorer/Kreditorer',  $link='../_base/page_Blindgyden.php');
      textKnap($label='@Importér',  $title='@Importér Debitorer/Kreditorer',   $link='../_base/page_Blindgyden.php');
    htm_LastFelt();
    htm_FrstFelt('40%',0);    htm_Caption('@Varer:');
    htm_NextFelt('60%');
      textKnap($label='@Eksportér', $title='@Eksportér Varer',  $link='../_base/page_Blindgyden.php');
      textKnap($label='@Importér',  $title='@Importér Varer',   $link='../_base/page_Blindgyden.php');
    htm_LastFelt();
    htm_FrstFelt('40%',0);
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
  htm_RudeBund($pmpt='@Send',$subm=true,$title='Send SQL-forespørgslen til serveren, og modtag data, som du kan gemme.');
}
 
 
# Kaldes fra:  [_system/page_Labels.php] 
function Rude_Labels($lbltype,$demo) {global $VareVars;
  htm_Rude_Top($name= 'labels',$capt= '@Label print:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW640',__FUNCTION__,$more=' style= "height:590px" ');
  htm_Rammestart($Caption='@Beskrivelse af systemet:');
    echo tolk('@Her redigerer du en HTML-tekst, som definerer, hvorledes labels udskrives.').' '.str_nl().
         tolk('@Teksten kan indeholde variabel-navne, som udskiftes med aktuelle værdier, når der printes').str_nl().
         tolk('@Hvilke variabler du kan benytte, kan du slå op herunder.');
    echo tolk(' ');
  htm_Rammeslut();
  htm_FrstFelt('22%'); {
    htm_Caption('@Vælg labeltype:');
    htm_OptioFlt($type='text', $name='lbltype', $valu= $lbltype, $labl='Type', $titl='@Vælg den label-type, du vil redigere.',  
                      $revi=true, $optlist=[['@Vare label','vare','@Vare'], ['@Adresse label','addr','@Adresse']], $action='');
    };
  htm_NextFelt('28%'); {
  htm_Caption('@Brugbare variabler:');
    htm_OptioFlt($type='text', $name='variabel', $valu= $lbltype, $labl='Varer', $titl='@Her kan du se de variabler du kan vælge imellem.',  
                      $revi=true, $optlist= $VareVars, $action='');
    };
  htm_NextFelt('50%'); {
  htm_Caption('.');
    htm_OptioFlt($type='text', $name='variabel', $valu= $lbltype, $labl='Adresser', $titl='@Her kan du se de variabler du kan vælge imellem.',  
                      $revi=true, $optlist= FormVars(4), $action='');
    };
  htm_LastFelt(); 
  htm_nl(1);
  htm_CombFelt($type='area',   $name='labl', $valu= $demo,  
               $labl='@Label HTML-kode',  
               $titl=tolk('@Her indsættes html kode til formatering af labelprint i varekort. Du kan finde eksempler på ').
                     'Saldi forum: href=http://forum.saldi.dk/viewtopic.php?f=17&t=1159  '.tolk('@under tips og tricks. ').
                     tolk('@Hvis der benyttes API til webshop skrives URL til shoppens funktionsmappe her.'), 
               $revi=true, $rows='10', $width='', $step='', $more='height:200px;',$plho=tolk('@Udfyld med HTML...') );
  echo '<div style="height:50px"></div>';  //  Dummy for at styre højdeplacering!
  htm_nl(3);  echo tolk('@Sådan ser det ud:');
	htm_nl(1);  echo '<div>'.$demo.'</div>';
  htm_RudeBund($pmpt='@Gem',$subm=true);
}
 
# Kaldes fra:  [_base/page_Startup.php] 
function Rude_FormularTabel(&$DATA) {
  htm_Rude_Top($name= 'forms',$capt= '@Tabel med samtlige formularers indstillinger:',$parms='#',$icon='fas fa-pen-square','panelW120',__FUNCTION__,$more='');
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
  htm_TabelInp(
    $HeadLine= array(),   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
    $RowPref= array(), #  ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:disp! ', '4:ColTip', '5:disp! ']  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
    $RowBody= array( # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:placeholder'],
            ['@Nr.',           '3%','show','center','@Formular nr','kode...'],
            ['@Art',           '3%','show','center','@Koden for feltes art','art...'],
            ['@Side',          '3%','show','center','@Udskrift på side kode: A !1 1 S !S','side...'],
            ['@Beskrivelse',  '10%','show','left',  '@Feltets tekstindhold samt $variabler',  'besk...'],
            ['@Just',          '3%','show','center','@Justering af teksten (L/V, C, R/H)','just...'],
            ['@X0',            '4%','show','right', '@Indsætnings X-koordinat (mm fra formularens venstre kant)','X0...',''],
            ['@Y0',            '4%','show','right', '@Indsætnings Y-koordinat (mm fra formularens top kant)','Y0...'],
            ['@Brd.',          '4%','show','right', '@Felt bredde (mm)','F-b...'],
            ['@Høj.',          '4%','show','right', '@Felt højde (mm)','F-h...'],
            ['@Dim.',          '4%','show','right', '@Objektets dimension: Streg-bredde, Tegn-højde, målt i px','Obj-D...'],
            ['@Farve',         '7%','show','center','@Objektets farve, angives som HTML5 tillader. (red, #FF44DD, rgb)','farve...'],
            ['@Txt-font',      '7%','show','left',  '@Objektets font (argument til: font-family)','font...'],
            ['@Txt-style',     '9%','show','left',  '@Objektets style  (argument til: font-weight, font-style)','style...'],
            ['@Grafik',        '8%','show','left',  '@Link til grafikfil','graf...'],
            ['@Fremmedsprog', '10%','show','left',  '@Alternativ beskrivelse, f.eks. på engelsk','alt...'],
            ['@Note',         '10%','show','left',  '@Note til objektet','not...']),
    $RowSuff= array(),  # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:value!     ']
    //$filDATA= ImportTabFile(realpath($_SERVER["DOCUMENT_ROOT"]). '/saldi-e/_exchange/_standard/formularer.v50.tab'),
    $DATA,
//    $DATA= sql_readB($qstr='SELECT form, frm_art, side, besk, just, FORMAT(x0,0), FORMAT(y0,0), FORMAT(dx,0), FORMAT(dy,0), FORMAT(dim,0), colr, font, style, imglnk, lngkey, note FROM tblA_forms ',__FILE__, __LINE__),
    $ViewHeight='500px',
    $PadTop='4px'
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
  htm_RudeBund($pmpt='@Gem',$subm=false);
}

# Kaldes fra:  [_base/page_Printlayout.php] 
function Rude_PrintEdit(&$DATA) {  global $blanket;
  htm_Rude_Top($name= 'editform',$capt= '@Formularens elementer:',$parms='#',$icon='fas fa-pen-square','panelW960',__FUNCTION__,$more='');
  htm_Caption('@Her kan du vælge variabler - ');
  $copyknap= '<button type="button" id="btnCopy" onclick="varcopy()" style="background-color:'.$ØBtNewBgrd.'" title="'.    //  varcopy() erklæres i htm_pagePrepare.php
    tolk('@Klik her, for at kopiere det valgte variabelnavn til kopieringsbuffer, så du kan indsætte det i et beskrivelses felt'). 
         '">&nbsp;<ic class="fas fa-copy" style="font-size:15px;"> </ic> Copy </button>';
  echo ' Art=2: Tekster: '. htm_SelectStr($name='copytxt',$valu='VALU',FormVars($frmNr),'max-width:200px; background-color:white;" title="'.  
       tolk('@Her kan du vælge blandt de brugbare variabelnavne angående tekster'),true).$copyknap;
  echo ' Art=3: Ordrelinjer: '. htm_SelectStr($name='copytxt',$valu='VALU',OrdrVars($frmNr),'max-width:200px; background-color:white;" title="'.  
       tolk('@Her kan du vælge blandt de brugbare variabelnavne angående ordrelinier'),true).$copyknap;
  if (($blanket==6) or ($blanket==7) or ($blanket==8))
  {
    htm_FrstFelt('15%');  htm_Caption('@Gebyrberegning: ');
    htm_NextFelt('18%');  htm_CombFelt($type='numberL',  $name='gebyr', $valu= '0', $labl='@Varenummer - rykker gebyr',   $titl='@Varenummer som indeholder sats for rykkergebyr',  $revi=false, $rows='', $width='160px');
    htm_NextFelt('18%');  htm_CombFelt($type='numberL',  $name='sats',  $valu= '0', $labl='@Varenummer - rentesats',  $titl='@Varenummer som angiver sats for rente af for sen betaling',  $revi=false, $rows='', $width='160px');
    htm_NextFelt('25%');  htm_Plaintxt('@Aktiver gebyrberegning, ved at oprette et tekst felt med ordet >GEBYR<');
    htm_NextFelt('18%');  htm_CombFelt($type='numberL',  $name='inka',  $valu= '0', $labl='@Inkasso - gebyr',  $titl='@Størrelsen af inkassogebyr',  $revi=false, $rows='', $width='140px');
    htm_LastFelt('');  
  };
  htm_TabelInp(
    $HeadLine= array(),   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
    $RowPref= array(), #  ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:disp! ', '4:ColTip', '5:disp! ']  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
    $RowBody= array( # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:placeholder'],
            ['@Id',            '3%','hidd','center','@DB index, vedligeholdes af systemet!','auto...'],
            ['@Nr.',           '2%','show','center','@Formular nr:'. ShowCol($liste=FRM_Liste(),$col= 0,$sep='<br>').' KAN IKKE RETTES HER!','kode...'],
            ['@Art',           '3%','data','center','@Koden for feltes art:'. ShowCol($liste=FartListe(),$col= 0,$sep='<br>'),'art...'],
            ['@Side',          '3%','data','center','@Udskrift på side kode:'. ShowCol($liste=SideListe(),$col= 2,$sep='<br>'),'side...'],
            ['@Felt-indhold', '24%','data','left',  '@Feltets tekstindhold samt $variabler',  '-'],
            ['@Just',          '3%','data','center','@Justering af teksten:'. ShowCol($liste=JustListe(),$col= 0,$sep='<br>').'(Samt kode for papirformat)','-'],
            ['@X0',            '4%','helt','right', '@Indsætnings X-koordinat (mm fra formularens venstre kant)','X0...',''],
            ['@Y0',            '4%','helt','right', '@Indsætnings Y-koordinat (mm fra formularens top kant)','Y0...'],
            ['@Brd.',          '4%','helt','right', '@Felt bredde (mm)','F-b...'],
            ['@Høj.',          '4%','helt','right', '@Felt højde (mm)'.'<br>'.tolk('@Angiv 0 for at autotilpasse'),'F-h...'],
            ['@Dim.',          '4%','helt','right', '@Objektets dimension: Streg-bredde, Tegn-højde, målt i px (pixel)','Obj-D...'],
            ['@Farve',         '7%','data','center','@Objektets farve, angives som HTML5 tillader. (red, #FF44DD, rgb)','farve...'],
            ['@Txt-font',     '10%','data','left',  '@Objektets font'.str_nl().tolk('(gyldigt argument til: font-family):'). ShowCol($liste=FontListe(),$col= 2,$sep=str_nl()),'-'],
            ['@Txt-style',    '13%','data','left',  '@Objektets style'.'<br>'.tolk('(gyldigt argument til: font-weight, font-style). Husk afsluttende semikolon!'),'-'],
            ['@Grafik',        '2%','data','left',  '@Link til grafikfil','graf...'],
            ['@Fremmedsprog',  '0%','hidd','left',  '@Alternativ beskrivelse, f.eks. på engelsk','alt...'],
            ['@Note',         '10%','data','left',  '@Note til objektet','not...']
            ),
    $RowSuff= array(['@Slet', '8%', 'text','center','@Klik på rødt kryds for at slette denne post','<ic class="far fa-times-circle" style="color:red; font-size:13px; "></ic>'],
            ),  # ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:value!     ']
    $DATA,    $ViewHeight='500px',    $PadTop='4px',    $rowadd='@Tilføj ny kolonne'
    );
  XY_forskydning();
  htm_Caption('@Her er der ingen kontrol af indtastede data, så det er dit ansvar, at de er gyldige!');
  htm_Plaintxt('@Når du redigerer, kan det være en fordel, at se disse paneler (Layout & Tabel) i 2 browser-vinduer, ved siden af hinanden.');
  htm_RudeBund($pmpt='@Gem',$subm=true,'@Husk at gemme her, hvis du har rettet noget ovenfor, inden du forlader vinduet.','','','editform');
  //  var_dump($_POST);
  //  Vis_Data($_POST);
  //  if (isset($_POST['btn_editform']))
  //  if (is_array($_POST['editform'])) { foreach($_POST['editform'] as $inputName => $inputValue)    { echo '<br> Name:'.$inputName; echo ' Valu:'.$inputValue; } }
} //  Rude_PrintEdit
 
# Kaldes fra:  [_base/page_Printlayout.php] [_base/page_Startup.php] 
function Rude_PrintDesign(&$DATA=[])  {  //  Afløser for Rude_PrintlayoutTXT
  global $html_buff, $x0, $blanket; 
  function textfelt($x='', $y='', $h='', $b='', $txt='', $style='',$clean=false,$vistools='',$doprn=true, $pageheight=297) { global $html_buff;
  //  Angives $h til værdien 0, bliver ramme-højden automatisk tilpasset indholdet.
    dvl_pretty('textfelt');
    $bordpx='1';
    if ($h!=0) $ramme_h= 'height: '.$h.'mm; '; else $ramme_h= '';  //  Udelades height => "h=fit"
    if (($vistools==true) and (!$doprn)) $bordpx='2';
    $bdr= ' border: '.$bordpx.'px solid #efefef;';    //  Felt-ramme
    $out_str1= '<div id="datafelt"  style="position: absolute;  bottom:'.($pageheight-$y).'mm; left: '.$x.'mm; width: '.$b.'mm; '.$ramme_h;  //  bottom for at justere efter tekst base-linie
    $out_str2= 'font-family: Helvetica, Arial, Times, sans-serif; white-space:pre; '.$style.'">';
    //  Onmouseover: Vis div.x,y og rectangel som flytter med musen, så man kan klikke et flytTilPunkt
    if ($clean) $out_str2.= '<div style="position:relative; left:0; bottom:0;">'.$txt.'</div>';  //  Tekst i rammen     border:1px dotted green;
    else        $out_str2.= 'Pos: '.$x.'mm:'.$y.'mm - '.$txt.' - Dim: '.$b.'x'.$h.' mm  : '.$style;
    $out_str2.= '</div>';
    echo $out_str1.$bdr.$out_str2;   if ($doprn) $html_buff.= $out_str1.$out_str2;
    return $out_str1.$out_str2;
  };
  function setstyle($b, $wh, $ffam, $just, $colr, $fsty) { global $x0;
        $feltw= $b;   //  $feltw= +1.4*strlen($beskriv)+0.8*$wh; 
        $style= '';    $font= '';  $px= $wh;
        if ($ffam  =='Helvetica')  {$font.= 'Helvetica; ';}  else {$font.= 'Times; ';}
        if ($wh >0)       {$style.= 'font:'.$px.'px '.$font;}
        if (($just =='V') or ($just =='L'))
                          {$style.= 'text-align:left; ';   $dx= 0;          $x0= $x0-$dx; }
        if  ($just =='C') {$style.= 'text-align:center; '; $dx= $feltw/2;   $x0= $x0-$dx; }
        if (($just =='H') or ($just =='R'))
                          {$style.= 'text-align:right; ';  $dx= $feltw;     $x0= $x0-$dx; }
        if ($colr>'')     {$style.= 'color:'.$colr.'; ';}   // Color! <font color="red">  <font color="color_name|hex_number|rgb(_number)">
        if ($fsty)        {$style.= 'font-style:'.$fsty.'; ';} else {$style.= 'font-style:normal; ';}
        return $style;
  } 
  function linefelt($x='', $y='', $h='', $b='', $colr='', $pageheight=297) { global $html_buff; //  Linier, som rectangler med lav højde
    if ($y-$h<0) {$y=$y+$h;}
    $out_str= '<div style="position:absolute; bottom:'.($pageheight-$y).'mm; left:'.$x.'mm; width:'.$b.'mm; height:'.($h).'mm; border:0.5px solid '.$colr.'; font:1px;"></div>';
    echo $out_str;    $html_buff.= $out_str;
   } 
  function graffelt( $x='', $y='', $h,/* px */ $b,/* px */  $img= 'src="../_assets/images/saldi-e50x170.png" alt="The logoimg" ', $pageheight=297) { 
    global $html_buff;
    $field ='border:1px dotted gray; font:1px; color:red; ">_';
    if (true) $field='border:0px dotted gray; font:1px; color:red; ">';
    $out_str.=  '<div style="position:absolute; bottom:'.($pageheight-$y).'mm; left:'.$x.'mm; '.$field.'<img '.$img.' height="'.$h.'" width="'.$b.'" ></div>';
    echo $out_str;    $html_buff.= $out_str;
  }
  
  // Rude_PrintDesign start:
  //  Initiering:
  if (!$blanket)    $blanket= 4; 
  if (!$sidetype)   $sidetype= 'A'; 
  if (!$fremmedsp)  $fremmedsp= false;
  //  Opdatering:
  if (isset($_POST['btn_printout'])) {
   //  $blanket=  $_POST['blanket']; 
     $sidetype= $_POST['sidetype'];
     $fremmedsp= $_POST['fremmedsp']; 
    }
  if (isset($_POST['blanket'])) $blanket=  $_POST['blanket']; 
  ## Varelinie-data:
  $varedat= sql_readB($qstr='SELECT id, form, frm_art, side, besk, just, x0, y0, dx, dy, dim, colr, font, style, imglnk, lngkey, note '.
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
  if ($pagewidth<=220) $panel= 'panelW960'; else $panel= 'panelW120';
  
  htm_Rude_Top($name= 'printout',$capt= '@Udskrivnings-Layout',$parms='#',$icon='fas fa-print',$panel,__FUNCTION__);
  htm_FrstFelt('25%');
    htm_OptioFlt($type='text',  $name='blanket',   $valu= $blanket, 
                    $labl='@Formular',      $titl='@Vælg en Formular som du vil vise/redigere',  
                    $revi=true, $optlist= FRM_Liste(),    $action='', $events='');  //  onchange="window.location.reload();"
  htm_NextFelt('35%');
    htm_OptioFlt($type='text',  $name='sidetype',   $valu= $sidetype,
                    $labl='@Udskrifts Side (& Sidste!)',   $titl='@Her vælger du visning af udskrifts-side.',  
                    $revi=true, $optlist= SideListe(), 
                    $action='');
  htm_NextFelt('20%');  
    htm_CheckFlt($type='checkbox',$name='fremmedsp', $valu= $fremmedsp,  $labl='@Benyt fremmesprog', 
          $titl='@Anvend alternativ beskrivelse fra formularens data. Endnu ikke brugbart',  $revi=false, $more=' ');
     $vistools= true;
      //$vistools= 
      // htm_CheckFlt($type='checkbox',$name='vistools', $valu= $vistools,  $labl='@Vis redskaber.', 
          // $titl='@Vis akse-skalaer og mouse-position',  $revi=true, $more=' '); //  Virker ikke! FIXIT
  htm_NextFelt('20%'); 
    htm_Plaintxt('@Opdater med genvejstast: g'); #+ textKnap($label='@Vis/opdater',  $title='@Opdater her hvis du har ændret formular eller side.', $link='#','o');    //  page_Printlayout.php
  htm_LastFelt('');  
  htm_FrstFelt('25%');  htm_OptioFlt($type='text',     $name='papir',  $valu= $varedat[0]['just'], $labl='@Papir-format',  $titl='@Papirstørrelse og retning', $revi=false, $optlist= PaprListe(),  $action='');
  htm_NextFelt('10%');  htm_Caption('@Ordrelinier:');
  htm_NextFelt('10%');  htm_CombFelt($type='numberL',  $name='linier', $valu= $varedat[0]['x0'], $labl='@Antal',   $titl='@Antal ordrelinier pr. side',  $revi=false, $rows='', $width='80px');
  htm_NextFelt('10%');  htm_CombFelt($type='numberL',  $name='first',  $valu= $varedat[0]['y0'], $labl='@Første',  $titl='@Første ordrelines y-startpunkt (grundlinie) målt i mm fra side-top',  $revi=false, $rows='', $width='80px');
  htm_NextFelt('10%');  htm_CombFelt($type='numberL',  $name='afstand',$valu= $varedat[0]['dy'], $labl='@Afstand', $titl='@Afstand mellem ordre-liniers grundlinie, målt i mm',  $revi=false, $rows='', $width='80px');
  htm_NextFelt('35%');  htm_CombFelt($type='numberL',  $name='bredde', $valu= $varedat[0]['dx'], $labl='@Bredde',  $titl='@Maksimal linie længde for beskrivelse, inden der brydes til ny linie, målt i mm',  $revi=false, $rows='', $width='80px');
  htm_Plaintxt(' &nbsp; Kan pt. ikke rettes her');
  htm_LastFelt('');  
    htm_nl();
// INITIERING:
//  $filDATA= ImportTabFile(realpath($_SERVER["DOCUMENT_ROOT"]). '/saldi-e/_exchange/_standard/formularer.v50.tab');  //  Ny version
//  $filDATA= ImportTabFile(realpath($_SERVER["DOCUMENT_ROOT"]). '/saldi-e/_exchange/_standard/formular-utf8.tab');   //  Gl version
  //$DATA= sql_readB($qstr='SELECT form, frm_art, side, besk, just, FORMAT(x0,0), FORMAT(y0,0), FORMAT(dx,0), FORMAT(dy,0), FORMAT(dim,0), colr, font, style, imglnk, lngkey, note FROM tblA_forms ',__FILE__, __LINE__);
  $pform= tolk(ListLookup($liste=PaprListe(),$search= $papirformat,$colsearch=1,$colresult=2));
  
  $html_buff= '<!DOCTYPE html><html lang="da" dir="ltr"> <head>  <meta charset="UTF-8">  <title>'.tolk('@Udskrifts-side').'</title>'.
              '<style type="text/css"> @page { size:'.$pagewidth.'mm '.$pageheight.'mm; margin:0mm 0mm 0mm 0mm; } </style> </head><body>';
  $kopibuff= '';
  echo '<fieldset id="printpage" style="border: 1px solid #8c8b8b; padding:2px; width:'.$pagewidth.'mm; height:'.$pageheight.'mm; margin: auto; margin-bottom:20px;'.
   ' position:relative; background:white;  cursor:crosshair;"> <legend><tc><b>'.tolk('@Papir:'.$pform).'</b></tc></legend>';
  if ($vistools==true) {
    //  akser($pagewidth, $pageheight);   Forkert ved forskellige papirformater - FIXit
    echo '<div id="showinfo" style="position: relative; top:'.($pageheight/2).    'mm; left:-40mm;" >Pos. X,Y:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;?,?&nbsp;mm; </div>'; //  X:Y-pos:  &nbsp;  ?:?
    echo '<div id="showkoor" style="position: relative; top:'.($pageheight/2-8.5).'mm; left:-31mm;" >Klik-Pos. X,Y:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;?,?&nbsp;mm </div>'; //  X,Y-pos:  &nbsp;  ?,?
  }
  $calib= 3.8;
  echo '<script>';     //  https://stackoverflow.com/questions/7790725/javascript-track-mouse-position
  echo 'var offset = $("#printpage").offset();';
// Vis XY-position:
  echo "var showinfo = document.getElementById('showinfo');";  //  Knyt til objektet showinfo
  echo "function tellPos(p){ showinfo.innerHTML = 'Pos. X: ' + Math.round((p.pageX  - offset.left)/".$calib." ) + ' , Y:' + Math.round((p.pageY - offset.top)/".$calib.") + ' mm ';}";
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
side varchar(2),      | $rec[2]; - Side-kode: A !A S !S [:string]
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

  foreach ($DATA as $rec) //  - udtegn data   ## utf8_decode $beskriv og $tolket hvis der indlæses fra fil!
    { //  $qstr='SELECT id, form, frm_art, side, besk, just, x0, y0, dx, dy, dim, colr, font, style, imglnk, lngkey, note '.
      $x0= $rec['x0']; $y0= $rec['y0']; $b= ($rec['dx']); $h= ($rec['dy']); $wh=$rec['dim']; 
      $tolket= tolk($rec['lngkey']);      $just= strtoupper($rec['just']);  
      if ($fremmedsp)       $rec['besk']= $tolket;
      if ($rec['side']=='') $rec['side']= 'A';
// Generelt:
    if ($rec['form']==$blanket)  {
      if (($rec['frm_art']==$layout) and ($rec['side']=='G')) {$antal= $rec['x0']; $toplin= $rec['y0']; $bred= $rec['dx'];  $afst= $rec['dy'];  $pfrm= $rec['just'];} //  Papirformat og Ordrelinier-placering
      if (($rec['frm_art']==$layout) and (strlen($just)==1)) {$style= setstyle($b, $wh, $rec['font'], $just, $rec['colr'], $rec['style']); 
                                                        $kopibuff.= textfelt($x0,$y0, $wh/3.0, $b, $rec['besk'], $style,true,$vistools,false);}   //  Stempel-tekst
      if  ($rec['frm_art']==$maildata) {if ($x0=='1')  {$mailemne= $rec['besk'];}; if ($x0=='2') $mailbesk= $rec['besk'];}                        //  Mail-tekster
      } //  Det skal sikres at $rec['frm_art']==0 kommer før ordrelinier i filen !
// Grafik:
    if (($rec['form']==$blanket) and (($rec['side']==$sidetype) 
     or ($rec['side']=='A'))     and ($rec['frm_art']==$grafik)) {  //  'side']=='A' ?
        if ($wh>0) linefelt($x0, $y0, $h, $b, $colr='gray'); // Linier (=rektangler med ramme)
        if ($wh<1) graffelt($x0, $y0, $h, $b, $img= /* 'src="'. */$rec['imglnk'].' '); // Grafik
      }
// Tekster:
    if (($rec['form']==$blanket) and (($rec['side']==$sidetype) 
     or ($rec['side']=='S'))     and (($rec['frm_art']==$tekster) 
     or ($rec['frm_art']==$ordrelin))) {
        $style= setstyle($b, $wh, $rec['font'], $just, $rec['colr'], $rec['style']);
        if ($rec['besk']=='GEBYR') {}     // udskrives ikke. Flag ang. gebyrberegning
        else 
        if ($rec['frm_art']==$ordrelin)   // Ordrelinier
          for ($i= 0; $i < $antal; $i++) 
            { textfelt($x0,$toplin+$i*$afst, $wh/3.5, $b, $rec['besk'], $style,true,$i==0,true);                       //  1. Ordrelinie
              if ($i==0) textfelt($x0,$toplin+$i*$afst, $wh/3.5, $b, '_', $style.' color:red;',true,$vistools,false);  //  Vis indsætningspunkt i 1. linie
            } //  Alle andre tekster:
        else {textfelt($x0,$y0, $wh/3.0, $b, $rec['besk'], $style,true,$vistools);
              textfelt($x0,$y0, $wh/3.0, $b, '_', $style.' color:red;',true,$vistools,false);  //  Vis indsætningspunkt
        }
      }
    }
    $html_orig= $html_buff;
// Demo-TEKSTER:
  textfelt( 80, 160,  0, 40,'<u>FeltA</u> x:80, y:160', 'font-weight:bold; color:Tomato; font:8px times; ',true,'',false);
  textfelt(100, 160,  0, 40,'<u>FeltB</u> x:100, y:160','font-weight:bold; color:blue;   font:16px times;',true,'',false);
  textfelt( 75, 170,  3, 60,'Tekst-Data felters indsætningspunkt vises med rødt <red style="color:red;">_</red> <br>Y-værdier måles fra dokument-top til teksters grundlinie, så ændring af skrift-højde, '.
                            'ikke får tekster til at "hoppe"<br>Tillades fler-linier med style="white-space:pre-wrap;", skal man være klar over at feltet vokser opad hvis $h=0, så det er sidste linie, '.
                            'der er placeret på Y-værdien! Angives derimod $h=3 (linie-højde) fortsætter teksten derimod nedad, til højere Y-værdier.','font:10px times; white-space:pre-wrap; ',true,'',false);
  $html_kopi= $html_buff.$kopibuff;
  echo '</fieldset>';
  htm_lf();
  //$html_buff.= '</body> </html>';
  $fp= fopen("../_temp/printside.htm","w");   if ($fp) { fwrite($fp,$html_orig."</body> </html>\n"); fclose($fp); };  
  $fp= fopen("../_temp/kopiside.htm","w");    if ($fp) { fwrite($fp,$html_kopi."</body> </html>\n"); fclose($fp); };  
  textKnap($label='@Se udskrift', $title='@Se hvad der kan udskrives med CTRL-p (uden stempel: KOPI)', $link='../_temp/printside.htm',$akey='p" target="_blank');
  textKnap($label='@Se kopi',     $title='@Se hvad der kan udskrives med CTRL-p (med stempel: KOPI)', $link='../_temp/kopiside.htm',$akey='k" target="_blank');
  htm_Caption('@Mail-tekster - ');
  htm_Caption('@Emne: ');   htm_sp(2); htm_Plaintxt($mailemne); htm_sp(4); 
  htm_Caption('@Besked: '); htm_sp(2); htm_Plaintxt($mailbesk);
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem eller opdater',$akey='g','','printout');
  //  var_dump($_POST);
  //  if(isset($_POST['Submit'])) {var_dump($_POST['printout']); foreach($_POST['printout'] as $inputName => $inputValue)    { echo '<br> Name:'.$inputName; echo ' Valu:'.$inputValue; }  }
  return $blanket;
} //  Rude_PrintDesign

# Kaldes fra:  [_base/page_Startup.php] 
function Rude_PrintlayoutTXT($filDATA=[], $pagewidth=210, $pageheight=297) { global $html_buff; //  "Grafik", baseret på absolute placering.   //  Rude_PrintDesign erstatter!
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
  
  htm_Rude_Top($name= 'printout',$capt= '@Udskrivnings-Layout',$parms='../_base/page_Printlayout.php',$icon='fas fa-print',$panel,__FUNCTION__);
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
        if (($beskriv=='generelt') or ($beskriv=='GEBYR')) {} // udskrives ikke. Flag ang. gebyrberegning.
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
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem eller opdater',$akey='g');
  //  Ved udskrivning skjules body-elementer omkring A4-papir. Se mere i out_style.css.php stikord: @media print (er ikke testet!)
}
 
// Denne funktion benyttes ikke!  Rude_PrintlayoutTXT er bedre kvalitet.
# Kaldes fra:  [_base/page_Startup.php] 
function Rude_Printlayout($filDATA=[],$width=210, $height=297) {  //  Grafisk-baseret, virker meget uldent i kanterne!
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
  htm_Rude_Top($name= 'print',$capt= '@Udskrivnings-Layout: DEMO',$parms='#',$icon='fas fa-print',$panel,__FUNCTION__);
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
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem eller opdater',$akey='g');
  //  Ved udskrivning skjules body-elementer omkring A4-papir. Se mere i out_style.css.php stikord: @media print (er ikke testet!)
}
 
 
# Kaldes fra:  [_system/page_Licens.php] 
function Rude_Omprogram() 
{ global $ØProgTitl, $Øprogvers, $Øcopydate, $Øcopyright, $Ødesigner;
  htm_Rude_Top($name= 'omprog',$capt= '@Om SALDI-<small>€</small>:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW480',__FUNCTION__);
  htm_Caption('@Status:');                   htm_nl();
  echo tolk('@Programmet er en videreudvikling af SALDI - det frie, danske økonomisystem, fra Danosoft.').str_nl(2);
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
  echo tolk('@Endvidere vil oversatte fremmed sprog, ikke være helt ajour.').str_nl(2);

  htm_hr();
  echo $ØProgTitl.' - Version '.$Øprogvers.' './* .' - Copyright '.  $Øcopydate.' '.$Øcopyright.' - ' */ tolk('@Design: ').$Ødesigner.'<br>';
  echo 'PHP-version: '.phpversion();                    htm_nl();

//$Ødb_Link= dbi_connect('localhost','SaldiAdm','SaldiPas','saldi_prog');
  if (phpversion()!='7.2.1')
    echo 'Database-version: '.mysqli_get_server_info(dbi_connect('localhost','SaldiAdm','SaldiPas','saldi_prog'));   
    echo 'Database-version: '.mysqli_get_server_info(dbi_connect('mysql46.unoeuro.com','ev_soft_dk','M4d73anU8j','ev_soft_dk_db3'));   
  htm_nl();
  echo "Zend engine version: " . zend_version();        htm_nl();
  echo 'Apache-version: '.$_SERVER['SERVER_SOFTWARE'];  htm_nl();  //  apache_get_version()
  htm_RudeBund($pmpt='@Gem',$subm=false,$title='@Gem eller opdater',$akey='g');
  //  Ved udskrivning skjules body-elementer omkring A4-papir. Se mere i out_style.css.php stikord: @media print (er ikke testet!)
}
 
  
 
# Kaldes fra:  [_base/page_Tips.php] 
function Rude_TipsBrug() 
{
  htm_Rude_Top($name= 'tips',$capt= '@Tips til brugeren:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW480',__FUNCTION__);
  htm_Caption('@TIPS:');                   htm_nl();
  echo tolk('Hvis du klikker med musens højre-tast på navigations knapper eller links-tekster, får du mulighed for at åbne linket i et nyt vindue eller fane, uden at lukke det vindue du er i.').str_nl(2);
  
  htm_Caption('@NAVIGERING i tabeller:');  htm_nl();
  echo ' <colrlabl>'.tolk('@Tab-tast').'</colrlabl> '.
    tolk('@springer til næste felt.').' <colrlabl>'.tolk('@SHIFT Tab-tast').'</colrlabl> '.tolk('@springer til forrige felt.').
    '  <colrlabl>'.tolk('@CTRL Pil-taster').'</colrlabl> '.tolk('@virker også. ').str_nl(2);
  
  htm_Caption('@SORTERING af tabeller:'); htm_nl();
  echo  tolk('@De tabeller som kun viser data, (ingen redigering) kan du sortere.').str_nl(1);
  echo  tolk('@Du gør det ved at klikke på kolonne overskriften.').str_nl(1);
  echo  tolk('@Det er kun muligt at sortere på en kolonne ad gangen.').str_nl(2);
  
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
  echo  tolk('@Klikkes på disse, kan du minimere/maksimere visning af indhold af alle andre paneler end det aktuelle.').'&nbsp;';
  echo  tolk('@Klikker du på panel-toppens venstre halvdel, kan du minimere/maksimere visning af indhold af det aktuelle panel.').str_nl(2);
  
  htm_Caption('@Hjælpe tekster:');        htm_nl();
  echo  tolk('@Tekster i felter med skygge (også andre!), indeholder nyttig hjælp.').str_nl(1);
  echo  tolk('@Når du holder musen over disse tekster, vises PopUp med tips.').str_nl(2);
  echo  tolk('@Benytter du trykfølsom skærm uden mus, skal du benytte Chrome browseren, for at få hjælpetekster:'). str_nl();
  echo  tolk('@´Hvil´ fingeren eller musen over teksten med skygge, så popper hjælpetekster op.'). str_nl(2);

  htm_Caption('@Dato-format:');           htm_nl();
  echo  tolk('@Benytter du en browser, der understøtter date-picker, benyttes et dato-format,').' ';
  echo  tolk('@som er bestemt af operativsystemet (Windows).').str_nl(1);
  echo  tolk('@Hvis du vil ændre dette, skal du derfor indstille det i "Windows-Kontrolpanel-Formater-Dato" '). str_nl(2);
  
  htm_Caption('@Tast-genveje:');          htm_nl();
  echo  tolk('@Er der en brugbar genvejstast for en knap, er den angivet efter knap-teksten med skråskrift.').' ';
  echo  tolk('@Du benytter den ved at taste [Alt]+tast eller [Alt]+[Shift]+tast i de fleste browsere (Kan være deaktiveret!)'). str_nl(2);
/*   Internet Explorer	[Alt] + accesskey	N/A	
Chrome	[Alt] + accesskey	[Alt] + accesskey	[Control] [Alt] + accesskey
Firefox	[Alt] [Shift] + accesskey	[Alt] [Shift] + accesskey	[Control] [Alt] + accesskey
Safari	[Alt] + accesskey
 */
  
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Retur til hovedmenu');
}
 
 
# Kaldes fra:  [_base/page_GruppeInfo.php] 
function Rude_GruppeBrug() {
  htm_Rude_Top($name= 'tips',$capt= '@Tips til bogholderen:',$parms='#',$icon='fas fa-pen-square','panelW480',__FUNCTION__);
  htm_Caption('@Info om grupper:');         htm_nl();
  echo  tolk('@En gruppe er nogle poster, som har nogle fælles data.').str_nl(2);
  echo  tolk('@Der kan f.eks. være tale om rabatter, varer, debitorer, kreditorer...').str_nl(1);
  echo  tolk('@Inden for hver hoved-gruppe, kan der oprettes undergrupper.').str_nl(1);
  echo  tolk('@Er der oprettet grupper, simplificeres tilknytning af alle de ensartede data').str_nl(2);
  echo  tolk('@Her kommer yderligere forklaring... ').str_nl(1);
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Retur til hovedmenu');
}
 
  
# Kaldes fra:  [_base/page_GruppeInfo.php] [_base/page_Tips.php] 
function Rude_TipsBogh() 
{
  htm_Rude_Top($name= 'tips',$capt= '@Tips til bogholderen:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW480',__FUNCTION__);
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
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Retur til hovedmenu');
}
 
 
# DEMO-MODUL;
# Kaldes fra:  [_base/page_News.php] 
function Rude_News() {global $ØlanguageTable, $ØProgTitl;
  htm_Rude_Top($name= 'nyheder',$capt= '@Nyheder:',$parms='page_Blindgyden.php',$icon='fas fa-info','panelW960',__FUNCTION__,'','');
  echo '<div style="text-align:center; color:black; "><big><i>'.str_nl().
       tolk('@Her er nogle af de væsentligste nyheder i denne version af').' SALDI:</i></big>'. str_nl(3);
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
  echo tolk('@Cursoren skifter udseende, alt efter hvilket musen holdes over, så man kan se, når der er en klik-funktion.'). str_nl(2);
  echo tolk('@Benyttes moderne browsere, benyttes en `date-picker` til dato-indtastninger, og der advares, når passwords indtastes på en usikker forbindelse.'). str_nl(1);
  echo tolk('@Date-picker er ikke tilgængelig i Internet Explorer, Safari og Opera Mini (Ultimo 2017).'). str_nl(2);
  echo tolk('@Formular-redigering, har fået mulighed for WYSIWYG design i LibreOffice, og der er tilføjet nye redskaber, til at vedligeholde layout. ¹'). str_nl(1);
  echo tolk('@Formular-redigering har fået mulighed for at supplere med et "stempel", f.eks: KOPI, som kan udskrives på en selvstændig udskrift. '). str_nl(2);
  echo tolk('@I formular-redigering, kan du nu vælge mellem forskellig papirformater. '). str_nl(1);
  echo tolk('@Du kan nu se, hvilke tekster (Felter med skygge), der har hjælpetekster tilknyttet.'). str_nl(2);
  echo tolk('@Der er benyttet farver, til at skelne mellem knappers forskellige funktioner f.eks. GRØN: Navigation.'). str_nl(2);
  echo tolk('@Alle tabeller har stribet baggrund, som gør det lettere at læse sammenhørende data.'). str_nl(2);
  echo tolk('@Tabeller med mange linier, vises i `rulle-vinduer`, med fastlåste kolonneoverskrifter.'). str_nl(2);
  echo '<div style="text-align:center; color:red; ">'.tolk('@TEKNIK:').'</div>'. str_nl(0);
  echo tolk('@Tabeller (uden Input) sorteres lokalt, så server, database og netværk, ikke belastes.'). str_nl(2);
  echo tolk('@Der er moduler til farvekodet modal-besked (fejl/info/advarsel/tip/succes) til brugeren.'). str_nl(2);
  echo tolk('@Programmet er blevet CSS-baseret, så design nemt kan forandres.'). str_nl(2);
  echo tolk('@Programmet er blevet kompatibelt med PHP 7+, og benytter HTML5 og javascript. ¹'). str_nl(2);
  echo tolk('@Er serveren indstillet til at benytte PHP 7, bliver programmet dobbelt så hurtigt!'). str_nl(2);
  echo tolk('@Sikkerheden omkring passwords (brugere og databaseadgang) er blevet forbedret. ¹'). str_nl(2);
  echo tolk('@Programmes kildekode er blokstrukturet, og er blevet omskrevet, så skærmvisning ').str_nl();
  echo tolk('@og data-behandling er adskilt, og det er blevet meget nemmere at overskue og forstå. ¹'). str_nl(2);
  echo tolk('@En god "bivirkning" af omskrivningen, er at omfanget af ubenyttet kode er blevet minimeret. ¹'). str_nl(2);
  echo tolk('@Det er blevet simplere for programmøren at tilpasse, rette og vedligeholde programmet. ¹'). str_nl(2);
  echo tolk('@Der er adskillige redskaber til programmøren: Debug-tilstand (fejlfinding), Skanning af fraser - som skal oversættes til andre sprog, ').
       tolk('@Modulskanning - viser php-filers status, Funktionsskanning - viser hvor funktioner er erklæret.'). str_nl(3).
            '<i><b>'.tolk('@Andet: ').'</b></i>';
  echo tolk('@Der benyttes Ikoner, Funktioner som ikke er standard samles i: `Tilvalg`,  ¹'). str_nl(2);
  echo '<i>'.tolk('@¹: Målsætning - Der arbejdes stadig på dette.').'</i>'. str_nl(3).'</div>';
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Retur til hovedmenu');
}
 
# DEMO-MODUL;
# Kaldes fra: 
function Rude_Intro() {global $ØlanguageTable;
  htm_Rude_Top($name= 'intro',$capt= '@Introduktion:',$parms='page_Blindgyden.php',$icon='fas fa-info','panelWmax',__FUNCTION__);
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
  htm_RudeBund($pmpt='@Gem',$subm=false,$title='@Gem');
}

# DEMO-MODUL;
# Kaldes fra: 
function Rude_Test()  {
  htm_Rude_Top($name= 'test', $capt= '@Værd at prøve:', $parms='page_Blindgyden.php',  $icon='fas fa-info',  'panelWmax',__FUNCTION__);
  echo '<div style="text-align:center; font-weight:400"><b>Afprøv CSS og responsive design.</b><br><br>';
  echo 'Variér vinduets bredde og se hvordan layoutet tilpasser sig.<br><br>';
  echo 'I Firevox kan du skifte til testvindue for Responsivt-design-vindue med CTRL-Skift-M.<br><br>';
  echo 'Læg mærke til at der er særlige skift ved vinduesbredderne: 320px, 640px, 960px og max 1200px<br><br>';
  echo 'Hvor der findes skjulte hjælpetekster, er synliggjort med blå tekster i skyggerammer. <br><br>';
  echo '<b>Afprøv ændring af programfladens sprog.</b><br><br>';
  echo '<colrlabl>/saldi-e/base/page_Layoutdemo.php?sprog=en</colrlabl> - Vælger engelsk<br>';
  echo '<colrlabl>/saldi-e/base/page_Layoutdemo.php?sprog=de</colrlabl> - Vælger tysk<br>';
  echo '<colrlabl>/saldi-e/base/page_Layoutdemo.php?sprog=fr</colrlabl> - Vælger fransk<br>';
  echo 'Og de andre:&nbsp;<colrlabl>/saldi-e/base/page_Layoutdemo.php?sprog=pl =it =es =tr =da</colrlabl> - Vælger polsk/italiensk/spansk/tyrkisk/dansk';
  echo '<br><br><b>Afprøv HTML5 og andre forbedringer.</b><br><br>';
  echo 'Inddatering af datoer i chrome, opera, vivaldi (m.fl.?) : Browseren tilbyder date-picker.<br><br>';
  echo 'Validering af data i input-felter : mail-adresse, password, required, m.fl.<br><br>';
  echo 'Prøv at vælge et password for administrator (Database setup), og se password styrke måleren.</div><br>';
  # /da:Sprog/en:Language/de:Sprache/fr:Langue/tr:Dil/es:Lenguaje
htm_RudeBund($pmpt='@Gem',$subm=false,$title='@Gem');
}

# DEMO-MODUL;
# Kaldes fra: 
function Rude_Formaal() {
  htm_Rude_Top($name= 'formaal',$capt= '@Formål:',$parms='page_Blindgyden.php',$icon='fas fa-info','panelW720',__FUNCTION__);
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
  htm_RudeBund($pmpt='@Gem',$subm=false,$title='@Gem');
}

# DEMO-MODUL;
# Kaldes fra: 
function Rude_Browsr()  {
  htm_Rude_Top($name= 'intro',$capt= '@Browsere:',$parms='page_Blindgyden.php',$icon='fas fa-info','panelW320',__FUNCTION__);
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
  htm_RudeBund($pmpt='@Gem',$subm=false,$title='@Gem');
}

# SUB-FUNCTION:
# Kaldes fra: 
function NaviTip() {### NavigationsTip:
global $Ønovice;
  userTip();
  if ($Ønovice)
  echo '<tc><divline style="margin-left:0.5em"><b>'.tolk('@noTIP:').'</b> I tabeller: <colrlabl>'.tolk('@Tab-tast').'</colrlabl> '.
    tolk('@springer til næste felt.').' <colrlabl>'.tolk('@SHIFT Tab-tast').'</colrlabl> '.tolk('@springer til forrige felt.').
    '  <colrlabl>'.tolk('@CTRL Pil-taster').'</colrlabl> '.tolk('@virker også. ').'</divline></tc><br>';
}

# SUB-FUNCTION:
# Kaldes fra: 
function TastTip() {### Tips ang. tastaturgenveje:
global $Ønovice;
#+  userTip();
  if ($Ønovice)
  echo '<tc><divline style="margin-left:0.5em"><b>'.tolk('@noTIP:').'</b> <colrlabl>'.tolk('@Genvejs-taster').'</colrlabl> '.
    tolk('@Når der på nogle knapper, er angivet f.eks. ´x´ betyder det, at der er oprettet en genvejs-tast, som kan benyttes i stedet for at klikke på tasten.').
          '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.
    tolk('@Hvordan du benytter genvejen afhænger af den browser, du bruger! Firevox:[Alt] [Shift] + genvejs-tast.  Mange andre:[Alt] + genvejs-tast.').
    '</divline></tc><br>';
}
# Kaldes fra: 
function Tips(){### Tips ang. browser genveje:
  msg_Dialog('tip',ucfirst(tolk('@Retur')),'JavaScript:window.history.back();','','','','',ucfirst(tolk('@Funktionstaster:')),
      tolk('@I de fleste nyere browsere kan du:').'<br><br>'.
      tolk('@Skifte fuldskærms mode: F11').'<br><br>'.
      tolk('@Zoom ind/ud: CTRL+/CTRL- ').'<br>'.
      tolk('eller CTRL-musrulleknap').'<br><br>'
  );
}

# Kaldes fra:  [_base/page_Blindgyden.php] [_kreditor/page_Ordreliste.php] [_produktion/page_Ordreliste.php] [_system/page_Brugerdata.php] 
function Rude_Blindgyde() {
  msg_Tip($title='@Du er havnet i en blindgyde',  $messg='@Linket du benyttede er midlertidigt, fordi det rigtige ikke er færdigudviklet.');
}

# Kaldes fra:  [_base/page_Hovhov.php] 
function Rude_Hovhov() {
   msg_Warn($title='@Hov hov!',                   $messg= '@Uautoriseret adgang! Hvad gør du her?');
}

# Kaldes fra: 
function Rude_Erdusikker() {
  msg_Dialog('warn',ucfirst(tolk('@Retur')),'JavaScript:window.history.back();',ucfirst(tolk('@Fortsæt')), $Knap2_function='$jQ112(this).dialog("close")','','',
                    ucfirst(tolk('@Er du helt sikker?')), ucfirst(tolk('@OBS! Der er ingen fortryd mulighed, hvis du fortsætter!')));
}

# Kaldes fra:  [_debitor/page_GruppeInfo.php] 
function Rude_GruppeInfo() {
  msg_Dialog('tip',ucfirst(tolk('@Luk')),'JavaScript:window.history.back();','','','','',ucfirst(tolk('@Lidt omtale af grupper.')),ucfirst(
            tolk('@Indeling i grupper er en praktisk metode, til at begrænse antallet af viste debi-/kreditorer (en slags filter), ').
            tolk('@og til at tildele medlemmer af gruppen, relevante fælles parametre.')));
}

# Kaldes fra: 
function OmFormularer() {global $Ønovice;
  if ($Ønovice) {
    echo '<div style="font-size:x-small">';
    echo tolk('@Formularers største papir format er A4, hvilket vil sige at bredden er max 210 mm og højden max. 297 mm.').' ';
    echo tolk('@Dertil svarer at værdier for X skal ligge i intervallet 1 - 210 mm, og Y skal ligge i intervallet 1 - 297 mm').'<br>';
    echo tolk('@Bredde-placeringer X måles fra papirets venste kant.').'<br>'.tolk('@Højde-placeringer Y, måles fra papirets bund.');
    echo '</div>';
  }
}

# SUB-FUNCTION:
# Kaldes fra: 
function XY_forskydning() {
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
/*   
  htm_FrstFelt('25%');  echo '<div style= "text-align:right">'.tolk('@Forskydning af alle placeringer:').'</div>';
  htm_NextFelt('12%');  htm_CombFelt($type='numberL',  $name='xSkyd',  $valu= 0, 
  $labl='@X-forskydning', 
  $titl='@Vandret forskydning: Angiv positivt tal for at øge, negativt tal for at mindske alle x-placeringer',  
  $revi=true, $rows='', $width='45');
  htm_NextFelt('12%');  htm_CombFelt($type='numberL',  $name='ySkyd',  $valu= 0, 
  $labl='@Y-forskydning', 
  $titl='@Lodret forskydning: Angiv positivt tal for at øge, negativt tal for at mindske alle y-placeringer', 
  $revi=true, $rows='', $width='45');
  htm_NextFelt('16%');  textKnap($label='@Forskyd formular',  $title='@Flyt hele formularens indhold med de angivne x/y-værdier.', $link='../_base/page_Blindgyden.php');
  # htm_accept('@Forskyd formular','@Flyt hele formularens indhold med de angivne x/y-værdier.');
  htm_NextFelt('35%');  OmFormularer();
  htm_LastFelt(); 
 */  
}

?>

