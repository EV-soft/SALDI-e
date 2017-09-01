<?php   $DocFil= '../_base/out_ruder.php';   $DocVer='5.0.0';    $DocRev='2017-08-00';   $modulnr=0;
/* ## Formål:  Design af panelers layout.
 * Denne fil er oprettet af EV-soft  i 2017.
 *             ___   _   _    ___  _         
 *            / __| / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            |___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 * Design af panelers layout.
 * Panel-moduler (Ruder) egnet for adaptivt skærm-output.
 *
 * Afhængig af: out_base.php
 * Denne fil bør på sigt opdeles i flere mindre, pga. hastighed!
 * Evt. Opdeling i 2: [1. Regnskabs paneler]  [2. Indstillings paneler]
 * Alternativt flyttes de "langsomme" ud i de page_-filer, som de angår.
 *  
 * Filer er redigeret med tabulator sat til 2 tegn, og linielængde max. 200 tegn. De ses bedst med det.
 * Filer skal gemmes i UTF-8 format uden BOM!
 * 2016.08.00 evs - EV-soft
 */
global $ØProgRoot;

if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'out_ruder');
//echo "\n<!-- $DocVer  $DocRev  $modulnr  $DocFil -->\n";

// ***** Rutiner for MENU og visning/redigering af DB-data: **************************************************
include $ØProgRoot.$_base.'version.php';
if (!function_exists('msg_Dialog')) {include $_base.'msg_lib.php';};
  
# PROGRAM-MODUL; "Navigation"
// 2017-03-09 - Er kopieret til page_GitterMenu:
function Rude_HovedMenu(&$regnskab, &$vis_finans, &$vis_debitor, &$vis_kreditor, &$vis_prodkt, &$vis_lager) {
global $Øcopydate, $Øcopyright, $ØProgTitl, $Øprogvers, $ØprogSprog, $Ødesigner;
//  $ØprogSprog= $_SESSION['ØprogSprog'];
  $goBack= '';  # '?returside=../_base/menu.php';
  echo '<PanlHead>';        
  htm_Rude_Top($name='menuform',$capt='',$parms='',$icon='',$klasse='panelWmax',__FUNCTION__);
  echo '<div style="text-align: center"><img src= "../_assets/images/saldi-e50x170.png" alt="Saldi Logo" height="50" width="170" ></div>';
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
function Rude_ProgramStatus() {global $ØProgTitl;
  htm_Rude_Top($name='statform',$capt='@Program status',$parms='../_base/page_Gittermenu.php',$icon='fa-info-circle',$klasse='panelW480',__FUNCTION__);
  echo '<div style="text-align:center; color:red; background:white;"><big><i>'.str_nl().
       tolk('@TEST udgave af').$ØProgTitl.':</i></big>'. str_nl(3);
  echo tolk('@Dette er seneste version i udviklingen.'). str_nl(2);
  echo tolk('@Der vil derfor forekomme midlertidige fejl.'). str_nl(3);
  echo tolk('@Endvidere vil oversatte fremmed sprog, ikke være helt ajour.'). str_nl(3);
  echo '</div>';
  htm_RudeBund($pmpt=Tolk('@Gem'),$subm=false);
}

# PROGRAM-MODUL; "Navigation"
function Rude_AdminMenu() {global $ØLineBrun;
  htm_Rude_Top($name='adminform',$capt='@Indstillinger 1 - Ofte.',$parms='../_base/page_Gittermenu.php',$icon='fa-bars',$klasse='panelW240',__FUNCTION__);
  $goBack= '';  $knapW= 200;
  htm_CentrOn();
                  menuKnap($h='22',$w=$knapW,$label='@Valuta',                 $link='../_system/page_Valuta.php',       $title='@Indstillinger angående valuta');
  htm_nl();  menuKnap($h='22',$w=$knapW,$label='@Moms',                   $link='../_system/page_Syssetup.php',     $title='@Indstillinger angående moms');
  htm_nl();  menuKnap($h='22',$w=$knapW,$label='@Debitor & Kreditor Grp.',$link='../_system/page_Debkredgrup.php',  $title='@Indstillinger angående grupper');
  htm_nl();  menuKnap($h='22',$w=$knapW,$label='@Afdelinger',             $link='../_system/page_Afdelinger.php',   $title='@Indstillinger angående Afdelinger');
  htm_nl();  menuKnap($h='22',$w=$knapW,$label='@Projekter',              $link='../_system/page_Projekter.php',    $title='@Indstillinger angående Projekter');
  htm_nl();  htm_hr($ØLineBrun);  
             menuKnap($h='22',$w=$knapW,$label='@Lagre',                  $link='../_system/page_Lagre.php',        $title='@Indstillinger angående Lagre');
  htm_nl();  menuKnap($h='22',$w=$knapW,$label='@Varegrupper',            $link='../_system/page_Varegrupper.php',  $title='@Indstillinger angående Varegrupper');
  htm_nl();  menuKnap($h='22',$w=$knapW,$label='@Rabatgrupper',           $link='../_system/page_Rabatgrupper.php', $title='@Indstillinger angående Rabatgrupper');
  htm_nl();  menuKnap($h='22',$w=$knapW,$label='@Enheder & materialer',   $link='../_system/page_Enheder.php',      $title='@Indstillinger angående registrede Enheder, beskrivelse og materiale');
  htm_nl();  htm_hr($ØLineBrun);  
             menuKnap($h='22',$w=$knapW,$label='@Firma stamdata',         $link='../_system/page_Stamkort.php',     $title='@Indstillinger angående Stamdata');
  htm_nl();  menuKnap($h='22',$w=$knapW,$label='@Bruger rettigheder',     $link='../_system/page_Brugere.php',      $title='@Indstillinger angående Brugere');
  htm_nl();  menuKnap($h='22',$w=$knapW,$label='@Regnskabsår',            $link='../_system/page_Regnskabsaar.php', $title='@Indstillinger angående Regnskabsår');
  htm_nl();  menuKnap($h='22',$w=$knapW,$label='@Udskrivnings Formularer',$link='../_system/page_FormText.php',     $title='@Indstillinger angående udskrivnings blanketter / Formularer');
  htm_nl();  menuKnap($h='22',$w=$knapW ,$label='@Administrator menu',    $link='../_base/page_Blindgyden.php',    $title='@Indstillinger angående Regnskaber m.v.');
  htm_nl();  htm_hr($ØLineBrun);  
             menuKnap($h='22',$w=$knapW,$label='@Udvikling: Layouttest',  $link='../_base/page_Layoutdemo.php',     $title='@Visning af eksempler på ruders opbygning.');
  htm_nl();    
  htm_nl();  textKnap($label='@Flere indstillinger 2.',  $title='@Diverse indstillinger', $link='../_system/page_Divsetup2.php',$akey='2');
  htm_nl();
  htm_CentOff();
  htm_RudeBund($pmpt=Tolk('@Retur til hovedmenu'),$subm=true,$title='@Luk og gå retur til hovedmenu');
};

# PROGRAM-MODUL; "Navigation"
function Rude_DiverseMenu() {global $ØLineBrun;
  htm_Rude_Top($name='adminform',$capt='@Indstillinger 2 - Flere.',$parms='../_system/page_Valuta.php',$icon='fa-bars',$klasse='panelW240',__FUNCTION__);
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
  htm_nl(2); textKnap($label='@Tilvalgs indstillinger 3.', $title='@Indstillinger, som angår tilvalgs funktioner', $link='../_system/page_Tilvalgsetup3.php',$akey='3');
  htm_nl();    
  htm_nl(); textKnap($label='@Til Hovedmenu', $title='@Vend tilbage til programmets hovedmenu',$link='../_base/page_Gittermenu.php',$akey='h');
  htm_nl(); htm_CentOff();
  htm_RudeBund($pmpt=Tolk('@Retur til indstillinger 1.'),$subm=true,$title='@Luk og gå retur til indstillingsmenu');
};

# PROGRAM-MODUL; "Navigation"
function Rude_TilvalgsMenu() {global $ØProgTitl, $ØLineBrun;
  htm_Rude_Top($name='tilvform',$capt='@Indstillinger 3 - Tilvalg',$parms='../_system/page_Divsetup2.php',$icon='fa-bars',$klasse='panelW240',__FUNCTION__);
  $goBack= '?returside=../_base/menu.php';
  $knapW= 220;
  htm_CentrOn();
  htm_hr($ØLineBrun);  htm_Caption('@Tillægs funktioner:');
  htm_nl();  menuKnap($h='22',$w=$knapW ,$label='@Aktivering af tilvalg', $link='../_base/page_Blindgyden.php',         $title='@Indstillinger angående aktivering af ekstra moduler m.v.');
  htm_nl();  menuKnap($h='22',$w=$knapW ,$label='@Shop relaterede valg (WEB)',  $link='../_base/page_Blindgyden.php',   $title='@Indstillinger angående WEB-Shop relaterede valg');
  htm_nl();  menuKnap($h='22',$w=$knapW ,$label='@Web API',               $link='../_base/page_Blindgyden.php',         
  $title= tolk('@Indstillinger angående API (Application Programming Interface), en softwaregrænseflade, der tillader').$ØProgTitl.' '.tolk('@at interagere med andet software'));
  htm_nl();  menuKnap($h='22',$w=$knapW ,$label='@PoS-valg (Kasse)',      $link='../_base/page_Blindgyden.php',         $title='@Indstillinger angående PoS-valg (Point-of-Sale), angår kasseapparat løsningen');
  htm_nl();  menuKnap($h='22',$w=$knapW ,$label='@Label print',           $link='../_system/page_Labels.php',       $title='@Indstillinger angående Labels');
  htm_CentOff();
  # $labl='@Integration med DocuBizz',
  htm_CheckFlt($type='checkbox',$name='docubizz', $valu= $docubizz,  $labl='@Integration med DocuBizz', $titl='@Import fra DocuBizz - Det intelligente fakturasystem',  $revi=true, $more=' '.$pg);
  
  # $labl='@Integration med ebConnect',
  htm_CheckFlt($type='checkbox',$name='ebconn', $valu= $ebconn,  $labl='@Integration med ebConnect',    $titl='@Elektronisk fakturering. Send og modtag e-faktura med ebconnect. Send direkte fra økonomisystemet og overfør til kassekladden - klar til bogføring',  $revi=true, $more=' '.$pg);

  htm_CentrOn();
  htm_nl();  textKnap($label='@Til Hovedmenu', $title='@Vend tilbage til programmets hovedmenu',$link='../_base/page_Gittermenu.php',$akey='h');
    htm_nl();  
  htm_CentOff();
  htm_RudeBund($pmpt=Tolk('@Retur til indstillinger 2.'),$subm=true,$title='@Luk og gå retur til indstillingsmenu');
};

# PROGRAM-MODUL; "Navigation"
// 2017-03-09 - Er kopieret til page_GitterMenu:
function Rude_FootMenu($doPrint=true, $doErase=true, $doLookUp=true, $doAccept=true, $doExport=true, $doImport=true, $OpslLabl='') {
  echo '<div class="clearWrap"/>';  echo '<PanlFoot>';
    Foot_Links($maxi=true, '<a style="color:#900000" href="'.$link='http://www.ev-soft.dk/saldi-wiki/doku.php?id=saldi:manualen '.'" target="_blank">'.
    '<u title="'.tolk('@Manual, tips og anden hjælp finder du på').$ØProgTitl.'-DokuWiki">SALDI-DokuWiki</u></a>',
    $doPrint, $doErase, $doLookUp, $doAccept, $doExport, $doImport, $OpslLabl);
  echo '</PanlFoot>';
}


# PROGRAM-MODUL;
function Rude_DBsetup(&$db_type,&$db_encode,&$db_navn,&$db_bruger,&$db_password,&$adm_navn,&$adm_password,&$verify_adm_password,&$db_host) {
  global $ØButtnBgrd, $ØButtnText, $ØProgTitl, $Ønovice; 
  htm_Rude_Top($name='opret',$capt=$ØProgTitl.'-<small> € :</small> '.Tolk('@Database setup'),$parms='../_admin/ini_CreateDB.php.php',$icon='fa-wrench',$klasse='panelW320',__FUNCTION__);
  htm_CombFelt($type='text',  $name='db_host',    $valu= $db_host,    
               $labl='@Server vært', 
               $titl=tolk('@Navn på den leverandør, der står for serverdriften. '),
               $revi=true, $rows='2',$width='',$step='', $more=' ', $plho=tolk('@Angiv HOST-leverandør...'));
  htm_OptioFlt($type='text',  $name='db_type',    $valu= $db_type,  
                    $labl='@Server type',  
                    $titl='@Vælg den databaseserver type, du ønsker at bruge.', 
                    $revi=true, $optlist= array(
                    ['@PostgreSQL','PostgreSQL','@PostgreSQL'],
                    ['@MySQL','MySQL','@MySQL']),$action='');
  htm_OptioFlt($type='text',  $name='db_encode',    $valu= $db_encode,  
                    $labl='@Tegnsæt',         
                    $titl='@Vælg det tegnsæt du ønsker at bruge. Nyere versioner af PostgreSQL fungerer kun med UTF8',  
                    $revi=true, $optlist= array(
                    ['@Vælg UTF8 tegnsæt','UTF8','UTF8'],
                    ['@Vælg LATIN9 tegnsæt','LATIN9','LATIN9']),$action='');
  htm_Caption('@Adgang til database server:');
  htm_CombFelt($type='text',  $name='db_bruger',    $valu= $db_bruger,    
               $labl='@Aktiv databaseadministrator', 
               $titl=tolk('@Navn på en eksisterende bruger, som har tilladelse til at oprette, rette og slette databaser. ').'<br>'.
                              tolk('@Typisk er det for PostgreSQL brugeren [postgres] og for MySQL brugeren [root].'),                          
               $revi=true, $rows='2',$width='',$step='', $more=' required ', $plho=tolk('@Angiv DB-bruger...'));
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
       '<br>../_config ../_exchange ../_temp ../_userlib og undermapper heri.<br>Mappen ../_config indeholder oplysninger om adgang til databasen, men disse beskyttes af en .htaccess fil.</small></div>';
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

# PROGRAM-MODUL;
function Rude_install(&$db_type,&$db_encode,&$db_navn,&$db_bruger,&$db_password,&$adm_navn,&$adm_password,&$verify_adm_password) { global $ØProgTitl; 
# Test:
  if ($fp=fopen("../_config/connect.php","a"))   { fclose($fp); $inc='checked';} else $inc.='';
  if ($fp=fopen("../_temp/test.txt","w"))        { fclose($fp); $tmp='checked';} else $tmp.='';
  if ($fp=fopen("../_exchange/test.txt","w"))    { fclose($fp); $exc='checked';} else $exc.='';
  if ($fp=fopen("../_userlib/test.txt","w"))     { fclose($fp); $lgo='checked';} else $lgo.='';
#+  
  if (extension_loaded('mysqli'))     {if ($link= mysqli_connect("")) {$mq= 'checked'; mysqli_close($link);} else $mq= '';} else $mq= '';
  // Warning: mysqli_connect() [function.mysqli-connect]: (HY000/2002): No such file or directory in /var/www/advokatfirmaet-viuff.dk/saldi-e/_base/out_ruder.php on line 256
  if (extension_loaded('PostgreSQL')) {if (pg_connect(""))            {$pg= 'checked'; pg_close();}          else $pg= '';} else $pg= '';
  $sec = isSecure();
  htm_Rude_Top($name='opret',$capt= '@Installations forberedelse',$parms='../_base/_admin/ini_CreateDB.php',$icon='fa-wrench',$klasse='panelW320',__FUNCTION__);
 echo '<div style="text-align:left"><small>'.'<b>'.
      tolk('@Nødvendig forberedelse:').'</b><br> '.
      tolk('@En Apatche webserver med PHP skal være i drift.').' <br>'.
      tolk('@På serveren skal være installeret en af databaseserverne PostgreSQL eller MySQL/MariaDB.').'<br>';
  htm_FrstFelt('50%');  
  htm_CheckFlt($type='checkbox',$name='pg', $valu= '',  $labl='@Postgres findes.',  $titl='@Systemet kontrollerer om modulet er tilgængeligt. (skal testes!)',  $revi=false, $more=' '.$pg);
  htm_NextFelt('50%');  
  htm_CheckFlt($type='checkbox',$name='mysql',    $valu= '',  $labl='@MySQL findes.', $titl='@Systemet kontrollerer om modulet er tilgængeligt. (skal testes!)',  $revi=false, $more=' '.$mq);
  htm_LastFelt();
  echo '<hr>'.tolk('@Hvis systemet ikke køres på lokalnet, bør det ske via en sikker krypteret forbindelse:').'<br/>';
  htm_CheckFlt($type='checkbox',$name='https',  $valu= isSecure(),  $labl='@HTTPS er aktiv.', $titl='@Systemet kontrollerer om HTTPS er benyttet. (skal testes!)',  $revi=false, $more=' '.$sec);
  echo '</div><hr>'.
      tolk('@Pakken med').$ØProgTitl.'-'.tolk('@filer, udpakkes i en program mappe, med adgang for webbesøgende. Navngiv den: saldi-e').'<br><br>'.
      tolk('@Der skal være skriveadgang til 4 under-mapper:').'<br>';
  htm_FrstFelt('50%');
    htm_CheckFlt($type='checkbox',$name='conf',   $valu= '',  $labl='_config',    $titl='@Systemet kontrollerer om mappen er skrivbar', $revi=false,$more=$inc);
  htm_NextFelt('50%');
    htm_CheckFlt($type='checkbox',$name='exch',   $valu= '',  $labl='_exchange',  $titl='@Systemet kontrollerer om mappen er skrivbar', $revi=false,$more=$exc);
  htm_LastFelt();
  htm_FrstFelt('50%');
    htm_CheckFlt($type='checkbox',$name='temp',   $valu= '',  $labl='_temp',      $titl='@Systemet kontrollerer om mappen er skrivbar', $revi=false,$more=$tmp);
  htm_NextFelt('50%');
    htm_CheckFlt($type='checkbox',$name='llib',   $valu= '',  $labl='_userlib',   $titl='@Systemet kontrollerer om mappen er skrivbar', $revi=false,$more=$lgo);
  htm_LastFelt();
  echo tolk('@Alle andre mapper skal være skrivebeskyttet, når systemets filer er på plads!');
//      .'<hr><b>PHP </b>'. tolk('@skal understøtte modulerne: mcrypt og hash, som benyttes til at håndtere passwords sikkert.').'<br>';
//  htm_FrstFelt('50%');  
//  htm_CheckFlt($type='checkbox',$name='hash',   $valu= '',  $labl='@hash installeret.', $titl='@Systemet kontrollerer om modulet er tilgængeligt',  $revi=false,$more='checked="'.extension_loaded('hash').'"');
//  htm_NextFelt('50%');  
//  htm_CheckFlt($type='checkbox',$name='mcrypt', $valu= '',  $labl='@mcrypt installeret.', $titl='@Systemet kontrollerer om modulet er tilgængeligt',  $revi=false,$more='checked="'.extension_loaded('mcrypt').'"');
//  htm_LastFelt();
  echo '<hr>'.
      tolk('@For at udnytte alle udskrivnings faciliteter, skal webserveren understøtte ekstra PDF/Grafik-programmer.').' <br>'. '<br><b>Ghostscript & ps2pdf</b> '.
      tolk('@for at kunne udskrive formularer.').'<br><b>ImageMagic</b> '.
      tolk('@er nødvendig for at flette udskrift med Logo.'). '<br><b>PDFtk</b> - '.
      tolk('@The PDF Toolkit: flette pdf-baggrund med sideudskrift.');
  echo '<hr><div style="text-align:left">'.
      tolk('@Bemærkt også, at').' <b>javascript</b> '.
      tolk('@skal være aktiveret !');
  echo '<hr>'.
      tolk('@Oprettelse af regnskab, sker senere, når du 1. gang logger ind, som ').$ØProgTitl.'-administrator.'.'<br><br>'.
      tolk('@På').$ØProgTitl.'-wiki '.tolk('@kan du læse supplerende informationer.');
  echo '</small></div>';
  htm_RudeBund($pmpt=Tolk('@Installér'),$subm=false,$title=tolk('@Klik her for at oprette dit').$ØProgTitl.' database-system');
}

function Rude_InstallFail($noskriv) { global $ØProgTitl;
  htm_Rude_Top($name= 'opret', $capt= '@Installation fejler!', $parms='db_setup.php', $icon='fa-wrench', $klasse='panelW320',__FUNCTION__);
    echo '<b>'.tolk('@Problem:').'</b><br>';
    echo tolk('@Der er ikke skriveadgang til kataloget:'),' "'.$noskriv.'"<br>';
    // if (extension_loaded('mcrypt') && extension_loaded('hash')) { $ext_loaded=true;  }
    if ($noskriv=="_config") 
    echo tolk('@hvor filen "connect.php" skal oprettes.').'<br><br>';
    echo tolk('@Sørg for at der er skriveadgang for Webbrugere, til katalogerne').': "_config", "_temp", "_userlib" <br><br>';
    echo tolk('@Se hvordan i installeringsvejledningen INSTALLATION.txt.').' <br><br>';
  htm_RudeBund($pmpt= Tolk('@Installér'),$subm=false,$title=tolk('@Klik her for at oprette dit').$ØProgTitl.' database-system');
}

function Rude_InstallSucces(&$db_navn, &$adm_navn) { global $ØProgTitl;
  htm_Rude_Top($name='oprettet',$capt= '@Databasen er installeret',$parms='',$icon='fa-wrench',$klasse='panelW320',__FUNCTION__);
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

# PROGRAM-MODUL;
function Rude_Login(&$regnskab,&$brugernavn,&$brugerkode,&$ProgVers,&$LnkHelp,&$OrgaName,&$Logo,$VisMax=true) { global $ØProgTitl, $ØprogSprog;
  htm_Rude_Top($name='logiform',$capt=Tolk('@Logind til').' <i>'.$regnskab.'</i>',$parms='',$icon='fa-key',$klasse='panelW320',__FUNCTION__); # < ? php echo htmlspecialchars($_SERVER["PHP_SELF"]);? >
  echo '<table width="100%";cellspacing="0"><tr align="center">';
  $FaLogo= '../_assets/images/'.$Logo;
  if ($VisMax) {
    if (file_exists($FaLogo)) echo '<tr align="center"><td colspan="3"; height="40px"><img style="border:0px solid;width:120px;heigth:80px" alt="LOGO" src="'.$FaLogo.'"></td></tr>';
    echo '<td> <small><small>'.$ØProgTitl.'</small></small></td>';
    echo '<td align="center">'.ucfirst(tolk('@Vært:')).'&nbsp; <b>'.$OrgaName.'</b></td>';
    echo '<td align="right"><small><small>Vers.'.$ProgVers.'</small></small> </td>';
    echo '<tr align="center"><td colspan="3"><br/><small><small>Huske TIP: </small> </small> '.$LnkHelp.'</td></tr>';
    echo '</tr></table><br>';
  }

  htm_CombFelt($type='text',    $name='regn', $valu= $regnskab,   $labl='@Regnskab',    $titl='@Angiv navnet på det Regnskab, som du har adgang til', $revi=true, $rows='2',$width='',$step='', $more='required="required" ', $plho=tolk('@Regnskab...'));
  htm_CombFelt($type='text',    $name='navn', $valu= $brugernavn, $labl='@Brugernavn',  $titl=tolk('@Angiv dit').$ØProgTitl.' '.tolk('@Brugernavn'),  $revi=true, $rows='2',$width='',$step='', $more='required="required" ', $plho=tolk('@Bruger...'));
  htm_CombFelt($type='password',$name='kode', $valu= $brugerkode, $labl='@Gyldig adgangskode', $titl='@Angiv Adgangskoden hørende til Brugernavnet',        $revi=true, $rows='2',$width='',$step='', $more='required="required" pattern="(?=^.{4,10}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-ZÆØÅ])(?=.*[a-zæøå]).*$" title="4..10 tegn accepteres " ', $plho=tolk('@Password...'));    
  //  Password (UpperCase, LowerCase, Number/SpecialChar and min 8 Chars):  (?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$
#  echo '<div style="text-align: center"><br><small><small> /da:Sprog/en:Language/de:Sprache/fr:Langue/tr:Dil/es:Lenguaje</small></small></div>';
  if ($VisMax) SprogValg($ØprogSprog);
  echo '<hr>';
  echo '<p align="center"><a href="'.$link='../_base/page_Blindgyden.php'.'"><u title="'.tolk('@Få tilsendt mail angående resat password').'">'.  tolk('@Glemt adgangskode?').'</u></a></p>';
  htm_RudeBund($pmpt=Tolk('@Log ind'),$subm=true,$title=tolk('@Gå videre til').$ØProgTitl.' '.tolk('@regnskabet'));
}


# PROGRAM-MODUL;
function Rude_Connsetup() { 
  htm_Rude_Top($name='forbind',$capt='@DB forbindelse:',$parms='',$icon='fa-key',$klasse='panelW480',__FUNCTION__);
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
  htm_CombFelt(                      $type='text',  $name='cvrnr',      $valu= $cvrnr,      $labl='@CVR',         $titl='@CVR - Virksomheds ID. Tast CVR-nr. omsluttet af *, +, eller / for at importere data fra Erhvervsstyrelsen (Data leveres af CVR API)', $revi=true);
  htm_FrstFelt('50%');  htm_CombFelt($type='text',  $name='tlf',        $valu= $tlf,        $labl='@Telefon.',    $titl='@Tlf - Tast telefonnr. omsluttet af *, +, eller / for at importere data fra Erhvervsstyrelsen (Data leveres af CVR API)',              $revi=true);
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
  htm_CombFelt(                     $type='text',  $name='fi_nr',  $valu= $fi_nr,  $labl='@FI Kreditornr.',    $titl='@Bankernes fælles indbetalingskort (FI-kort). Her angiver du dit FI Kreditornr.',    $revi=true);
  htm_RudeBund($pmpt='@Gem',$subm=true);
}


# PROGRAM-MODUL;
function Rude_Kunden(&$kontonr, &$kategori, &$cvrnr, &$eannr, &$bankreg, &$bankkto, &$instit, &$ansv, &$formsprog, &$homeweb) { 
  htm_Rude_Top($name='kundform',$capt='@Kunden (debitor):',$parms='',$icon='fa-user',$klasse='panelWmax',__FUNCTION__);
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
  htm_CombFelt($type='text',  $name='sprog',  $valu= $formsprog,$labl='@Faktureringssprog', $titl='@Sproget som skal benyttes på faktura udskrifter',   $revi=true,'','','','placeholder="...'.tolk('@hvis sproget ikke er dansk').'..."');
  htm_CombFelt($type='text',  $name='homeweb',$valu= $homeweb,  $labl='@Hjemmeside',        $titl='@Kundens hjemmeside',      $revi=true,'','','',$Erhv);
  htm_RudeBund($pmpt='@Gem',$subm=true);
}

# PROGRAM-MODUL;
function Rude_Leverandor(&$kontonr, &$kategori, &$cvrnr, &$eannr, &$bankreg, &$bankkto, &$instit, &$ansv, &$formsprog, &$homeweb) { 
  htm_Rude_Top($name='kundform',$capt='@Leverandør - Registre:',$parms='',$icon='fa-user',$klasse='panelWmax',__FUNCTION__);
  htm_CombFelt($type='text',  $name='DBix',   $valu= $kontonr,  $labl='@Leverandørnr.',          $titl='@Leverandørnr: Kan ikke rettes. Systemet styrer dette', $revi=false);
//  htm_RadioGrp($type='hori',  $name='Ktyp',                     $labl='@Leverandørtype',         $titl='@Leverandør kategori',          
//              $optlist= array(['privat','@Privat','@eller'],['erhverv','@Erhverv','']),$action='');
  $Erhv= 'placeholder="...'.tolk('@kun erhverv').'..."';  // Returnering af værdi i &$kategori ?
  htm_CombFelt($type='text',  $name='CVR',    $valu= $cvrnr,    $labl='@CVR-nr',            $titl='@CVR - Virksomheds ID',    $revi=true,'','','',$Erhv);
//  htm_CombFelt($type='text',  $name='EAN',    $valu= $eannr,    $labl='@EAN',               $titl='@EAN - E-betalings ID',    $revi=true,'','','',$Erhv);
  htm_CombFelt($type='text',  $name='bank',   $valu= $bank,     $labl='@Bank',              $titl='@Bank',                    $revi=true);  
  htm_FrstFelt('30%');                                          
    htm_CombFelt($type='text',$name='bankreg',$valu= $bankreg,  $labl='@Bank reg.',         $titl='@Bank reg.',               $revi=true);  
  htm_NextFelt('70%');                                          
    htm_CombFelt($type='text',$name='bankkto',$valu= $bankkto,  $labl='@Bank konto',        $titl='@Bank konto',              $revi=true);  
  htm_lastFelt();                                               
//  htm_CombFelt($type='text',  $name='inst',   $valu= $instit,   $labl='@Institution',       $titl='@Supplerende oplysning',   $revi=true,'','','',$Erhv);
//  htm_CombFelt($type='text',  $name='ansv',   $valu= $ansv,     $labl='@Leverandøransvarlig',    $titl='@Leverandøransvarlig',          $revi=true);
//  htm_CombFelt($type='text',  $name='sprog',  $valu= $formsprog,$labl='@Faktureringssprog', $titl='@Sproget som skal benyttes på faktura udskrifter',   $revi=true,'','','','placeholder="...'.tolk('@hvis sproget ikke er dansk').'..."');
  htm_CombFelt($type='text',  $name='homeweb',$valu= $homeweb,  $labl='@Hjemmeside',        $titl='@Leverandørns hjemmeside',      $revi=true,'','','',$Erhv);
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

# PROGRAM-MODUL;
function Rude_Betingelser(&$debigrup, &$betaling, &$frist, &$print2, &$kunderef    /* ,&$betalingsbet,&$fristdage */ ) { 
  #if ($betalingsbet=='@Kontant'||$betalingsbet=='@Efterkrav'||$betalingsbet=='@Forud'||$betalingsbet=='@Kreditkort') $fristdage='';  else $fristdage=0;
  htm_Rude_Top($name='betaform',$capt= '@Betingelser:',$parms='',$icon='fa-credit-card',$klasse='panelWmax',__FUNCTION__); # ' <text color: "gray">&#x00A7;</text>  '.
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

# PROGRAM-MODUL;
function Rude_Kontakter() {
  htm_Rude_Top($name='betaform',$capt='   '.tolk('@Kontakt info:'),$parms='',$icon='fa-phone-square',$klasse='panelWmax',__FUNCTION__);
  Kontakt($posi=1, $kontakt='Anders', $telf, $mobil, $mail);
  Kontakt($posi=2, $kontakt='Andersine', $telf, $mobil, $mail);
  echo '<hr>';
  echo '<div class="centrer">'; htm_accept('@Opret Ny','@Opret en ny kontakt'); echo '</div>';
  htm_RudeBund($pmpt='@Gem rettelser',$subm=true,$title='@Gem evt. rettelser ovenfor');
}

function Kontakt($posi, $kontakt, $telf, $mobil, $mail) {
  htm_FrstFelt('10%',0);
    htm_CombFelt($type='number',  $name='posi',   $valu= $posi,   $labl='@Pos.',  $titl='@Position styrer rækkefølgen af posterne',        $revi=true, $rows='', $width='45', $step='0.5');
  htm_NextFelt('39%');  
    htm_CombFelt($type='text',  $name='kontakt',$valu= $kontakt,$labl='@Kontakt person',  $titl='@Angiv Kontakt person',  $revi=true, $rows='',$width='45');
  htm_NextFelt('23%');
    htm_CombFelt($type='text',  $name='telf',   $valu= $telf,   $labl='@Telefon',         $titl='@Angiv Telefon',         $revi=true, $rows='',$width='45');
  htm_NextFelt('28%');                                          
    htm_CombFelt($type='text',  $name='mobil',  $valu= $mobil,  $labl='@Mobil',           $titl='@Angiv Mobilnr.',        $revi=true, $rows='',$width='45');
  htm_LastFelt();                                               
  htm_CombFelt(  $type='mail',  $name='mail',   $valu= $mail,   $labl='@E-mail',          $titl='@Angiv E-mail',          $revi=true, $rows='');
  echo '<div class="centrer">'; htm_accept('@Slet','@Fjern denne kontakt person'); echo '</div>';
  echo '<hr color="green">';
}

# PROGRAM-MODUL;
function Rude_Fakturering(&$navn, &$addr, &$sted, &$ponr, &$by, &$land, &$noter, &$telf, &$att, &$email, &$usemail, &$faktdato) {
  htm_Rude_Top($name='faktform',$capt='@Kunde - Fakturering:',$parms='',$icon='fa-pencil-square-o','panelWmax',__FUNCTION__);
  htm_CombFelt($type='text',    $name='navn', $valu= $navn,   $labl='@Kunde navn',            $titl='@Angiv Kunde Navn',            $revi=true);
  htm_CombFelt($type='text',    $name='addr', $valu= $addr,   $labl='@Faktura adresse',       $titl='@Angiv Faktura Adresse',       $revi=true);
  htm_FrstFelt('25%');                                              
    htm_CombFelt($type='text',  $name='ponr', $valu= $ponr,   $labl='@Postnr',                $titl='@Angiv Faktura Kunde postnr',  $revi=true);
  htm_NextFelt('75%');                                              
    htm_CombFelt($type='text',  $name='by',   $valu= $by,     $labl='@Faktura By',            $titl='@Angiv Faktura Kunde Bynavn',  $revi=true);
  htm_lastFelt();                                                   
  htm_CombFelt($type='text',    $name='sted', $valu= $sted,   $labl='@Faktura Sted',          $titl='@Angiv Faktura Kunde Sted',    $revi=true);
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
  htm_RudeBund($pmpt='@Fakturér',$subm=true,$title='@Fakturer og udskriv til den under {Betingelser}, valgte udskriver!');
}

# PROGRAM-MODUL; Sammensatte Ruder! = "Vindue".
function Rude_Opretordre($kundeRec=[],$vareRec=[],$leverRec=[]) {global $ØRudeForm;
  htm_Rude_Top($name='ordrform',$capt='@Opret ordre:',$parms='',$icon='fa-plus','panelW110',__FUNCTION__);
  $ØRudeForm=false;
    Rude_DebitorKort();
  //echo '<br/>';
  SpalteTop(700);
  htm_Caption('@Husk at gemme med den gule knap nederst, når data er tilføjet !');
  htm_Rammestart($Caption='',$bor='0px');
    Rude_YdelserWide($Ordnr=':',$data=array(1,2,3),$fakt=false);
  htm_Rammeslut();
  NextSpalte(240);
    Rude_Levering($somfakt=true, $navn='', $addr='', $sted='', $ponr='', $by='', $land='', $telf='', $kont='', $email='', $forsend='', $noter='', $afsendt='', $levdato='');
  SpalteBund();
  $ØRudeForm=true;
  htm_RudeBund($pmpt='@Opret ordre',$subm=true,$title='@Gem data i denne rude.');
}

# PROGRAM-MODUL;
function Rude_Ordreinfo(&$valuta, &$vorref, &$afdel, &$ordrdato, &$genfdato, &$godkendt, &$optlist) {
$optlist= array(['','DKK','DKK'],['','AED','AED'],['','EUR','EUR'],['','USD','USD']);
  htm_Rude_Top($name='ordrform',$capt='@Ordreinfo:',$parms='',$icon='fa-eur','panelWmax',__FUNCTION__);
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

# PROGRAM-MODUL;
function Rude_Levering( &$somfakt, &$navn, &$addr, &$sted, &$ponr, &$by, &$land, &$telf, &$kont, &$email, &$forsend, &$noter, &$afsendt, &$levdato) {
  //if ($onPanel) 
  htm_Rude_Top($name='leveform',$capt='@Levering:',$parms='',$icon='fa-truck','panelW320',__FUNCTION__);
  htm_CheckFlt($type='checkbox',$name='somfakt',      $valu= $somfakt,  $labl='@Leveres til faktura-adresse', $titl='@Afmærk her, hvis leverings adresse er den samme som faktura adresse',  $revi=true);
  htm_CombFelt($type='text',    $name='levnavn',      $valu= $navn,     $labl='@Modtager navn',               $titl='@Angiv Modtager Navn',                   $revi=true, '','','','',$plho='Navn..');
  htm_CombFelt($type='text',    $name='levaddr1',     $valu= $addr,     $labl='@Leverings adresse',           $titl='@Angiv Leverings Adresse',               $revi=true, '','','','',$plho='Addr..');
  htm_CombFelt($type='text',    $name='sted',         $valu= $sted,     $labl='@Sted',                        $titl='@Angiv Leverings Sted, suplement til adresse', $revi=true);
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

# PROGRAM-MODUL;
function Rude_Ekstrafelter(&$felt1, &$felt2, &$felt3, &$felt4, &$felt5, $prefix='@Ordre Felt') {
  htm_Rude_Top($name='feltform',$capt='@Ekstrafelter:',$parms='',$icon='fa-plus','panelWmax',__FUNCTION__);
  htm_CombFelt($type='text',$name='felt1',  $valu= $felt1,  $labl= $prefix.' 1',  $titl='@Udfyld Felt 1',   $revi=true);
  htm_CombFelt($type='text',$name='felt2',  $valu= $felt2,  $labl= $prefix.' 2',  $titl='@Udfyld Felt 2',   $revi=true);
  htm_CombFelt($type='text',$name='felt3',  $valu= $felt3,  $labl= $prefix.' 3',  $titl='@Udfyld Felt 3',   $revi=true);
  htm_CombFelt($type='text',$name='felt4',  $valu= $felt4,  $labl= $prefix.' 4',  $titl='@Udfyld Felt 4',   $revi=true);
  htm_CombFelt($type='text',$name='felt5',  $valu= $felt5,  $labl= $prefix.' 5',  $titl='@Udfyld Felt 5',   $revi=true);
  htm_RudeBund($pmpt='@Gem',$subm=true);
}

# PROGRAM-MODUL;
function Rude_Mailfaktura(&$emne, &$text, &$vedhft) {
  htm_Rude_Top($name='mailform',$capt='@Mail faktura:',$parms='',$icon='fa-envelope-o','panelWmax',__FUNCTION__);
  htm_CombFelt($type='text',$name='emne',   $valu= $emne,   $labl='@Mail emne',   $titl='@Angiv Mail emne',     $revi=true,'','','','',         $plho='Vedr...');
  htm_CombFelt($type='area',$name='text',   $valu= $text,   $labl='@Mail tekst',  $titl='@Angiv Mail tekst',    $revi=true, $rows='2','','','', $plho='Besked...');
  htm_CombFelt($type='text',$name='vedhft', $valu= $vedhft, $labl='@Mail bilag',  $titl='@Angiv Vedhæftet fil', $revi=true,'','','','',         $plho='Bilag...');
  htm_RudeBund($pmpt='@Gem',$subm=true);
}

# PROGRAM-MODUL;
function Rude_Ydelser($Ordnr='',$fakt) {
  htm_Rude_Top($name='yderform',$capt=tolk('@Leverancer:').' '.$Ordnr.' <small>(Smal-format)</small>',$parms='',$icon='fa-shopping-cart','panelW320',__FUNCTION__);
  Varelinie($posi=1,$varenr="45-876",$antal=1,$enhed="stk",$beskriv="Redekasser",$momssats=25,$pris=235.50,$rabat=20, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);
  Varelinie($posi=2,$varenr="45-876",$antal=2,$enhed="stk",$beskriv="Redekasser",$momssats=25,$pris=235.50,$rabat=20, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);
  Varelinie($posi=3,$varenr="45-877",$antal=3,$enhed="stk",$beskriv="Redekasser",$momssats=25,$pris=245.00,$rabat=20, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);
  Varelinie($posi=4,$varenr="45-876",$antal=3,$enhed="stk",$beskriv="Redekasser",$momssats=25,$pris=235.50,$rabat=20, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);
  htm_Caption('@Status: ');
  htm_CheckFlt($type='checkbox', $name='fakt', $valu= $fakt, $labl='@Er Faktureret og låst',$titl='@Når ordren er faktureret, afmærkes feltet automatisk',$revi=false,$more='',$nl='');
  textKnap($label='@Opret Ny',  $title='@Opret ny varepostering', $link='../_base/page_Blindgyden.php');
  htm_RudeBund($pmpt='@Gem',$subm=true);
}

# PROGRAM-MODUL;
function Rude_YdelserWide($Ordnr='',$fakt) {
  echo '<div class="clearWrap"/>';  echo '<PanlFoot>';
  //if ($onPanel) 
  htm_Rude_Top($name='linkform',$capt=tolk('@Leverancer på salgsordren').' '.$Ordnr.' ',$parms='',$icon='fa-shopping-cart','panelWmax',__FUNCTION__,$more=' style= "height:350px" ');
    VarelinieWide($posi=1, $varenr='45-876', $antal=3, $enhed='stk', $beskriv='Redekasser', $momssats=25, $pris=235.50, $rabat=8, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);     
    VarelinieWide($posi=2, $varenr='45-876', $antal=2, $enhed='stk', $beskriv='Redekasser', $momssats=25, $pris=235.50, $rabat=8, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);     
    VarelinieWide($posi=3, $varenr='45-876', $antal=3, $enhed='stk', $beskriv='Redekasser', $momssats=25, $pris=235.50, $rabat=12, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);
    #,"45-876","3","stk","Redekasser","25","235,50","8",(3*235.5)*92/100*125/100
  htm_Caption('@Status: ');
  htm_CheckFlt($type='checkbox', $name='fakt', $valu= $fakt, $labl='@Er Faktureret og låst',$titl='@Når ordren er faktureret, afmærkes feltet automatisk',$revi=false,$more='',$nl='');
  htm_hr();
  textKnap($label='@Opret Ny',  $title='@Opret ny varepostering', $link='../_base/page_Blindgyden.php');
  //if ($onPanel) 
  htm_RudeBund($pmpt='@Gem',$subm=true);
  echo '</PanlFoot>'; 
}

# PROGRAM-MODUL;
function Rude_YdelserTabl($Ordnr='',$data,$fakt,$TopLine) {
  echo '<div class="clearWrap"/>';  echo '<PanlFoot>';
  htm_Rude_Top($name='linkform',$capt=tolk('@Leverancer på salgsordren').' '.$Ordnr.' ',$parms='',$icon='fa-shopping-cart','panelWmax',__FUNCTION__);
  htm_Caption($TopLine);
  htm_TabelInp(
    $HeadLine= array(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
 //     ['@Kladde notat:', '60%','left','text', '@Her kan skrives en bemærkning til kladden',                  '@Angiv din tekst...'], 
 //     ['@Konto-kontrol:','5em','left','text', '@Angiv kontonummer for den konto, hvis bevægelser skal kontrolleres',  '@Nummer...'], 
    ),
    $RowHead= array( #  ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! ']  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
//          ['PDF',     '3%','center','text','<a href='.$link.'><img src=../_assets/icons/'.$clip.'  alt="Clips" height="20" width="12" border=0 title="'.tolk($title).
//              '"></a>',tolk('@I denne kolonne håndterer du PDF-bilag, som er tilknyttet den enkelte postering.'),'placeh']
          ),
    $ColStyle= array( # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],
      ['@Pos..',         '5%','','text',  'left',  tolk('@Pos. nr tildeles automatisk'),tolk('...pos...')],
      ['@Varenr',        '8%','','text',  'center',tolk('@Varenummer for ydelsen'),tolk('Varenr...')],
      ['@Antal',         '5%','','right', 'right', tolk('@Mængden angivet som antal').' ',tolk('@Antal...')],
      ['@Enhed',         '8%','','text',  'left',  tolk('@Enheds betegnelse').' ',tolk('@Enh...')],
      ['@Beskrivelse',  '45%','','text',  'left',  tolk('@Beskrivelse af varen/ydelsen').' ',tolk('@Besk...')],
      ['@Momssats',      '5%','','text',  'center',tolk('@Moms pct.sats').' ',tolk('@Moms...')],
      ['@À pris',        '8%','','text',  'center',tolk('@Enhedspris').' ',tolk('@Pris...')],
      ['@Rabat',         '8%','','text',  'center',tolk('@Rabat procent'),tolk('@Rabat...')],
//      ['@Ialt',          '8%','','tal2d','right' ,tolk('@Kalkuleret beløb for den aktuelle postering. ')],
//      ['@Valuta',       '4%','','text','center',tolk('@Valutakode for den valuta, som er benyttet på bilaget.'),'DKK'],
//      ['@Forfald',      '9%','','date','center',tolk('@Beløbets forfalds dato').'forf.dato'],
      ),
    $RowTail= array(  # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:InpType', '4:FeltJust', '5:ColTip', '6:value! ']
        ['@Ialt',       '8%','','tal2d','right', #'0.000,00<div type= "text" name="saldo" value="00.000,00" width="8%"/>',
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
  echo '</PanlFoot>'; 
}

# PROGRAM-MODUL;
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
function VarelinieWide( &$posi, &$varenr, &$antal, &$enhed, &$beskriv, &$momssats, &$pris, &$rabat, &$ialt) {
  htm_FrstFelt('05%');  htm_CombFelt($type='text',  $name='posi',     $valu= $posi,     $labl='@Pos.',        $titl='@Position styrer rækkefølgen af posterne', $revi=true, $rows='',$width='45',$step='1');
  htm_NextFelt('08%');  htm_CombFelt($type='text',  $name='varenr',   $valu= $varenr,   $labl='@Varenr',      $titl='@Angiv varenr',                $revi=true, $rows='',$width='45');
  htm_NextFelt('05%');  htm_CombFelt($type='tal1d', $name='antal',    $valu= $antal,    $labl='@Antal',       $titl='@Angiv Antal',                 $revi=true, $rows='',$width='45',$step='0.25');
  htm_NextFelt('08%');  htm_CombFelt($type='text',  $name='enhed',    $valu= $enhed,    $labl='@Enhed',       $titl='@Enhed udfyldes automatisk',   $revi=false,$rows='',$width='45');
  htm_NextFelt('35%');  htm_CombFelt($type='area',  $name='beskriv',  $valu= $beskriv,  $labl='@Beskrivelse', $titl='@Angiv beskrivelse af ydelsen',$revi=true, $rows='2');
  htm_NextFelt('07%');  htm_CombFelt($type='tal2d', $name='momssats', $valu= $momssats, $labl='@Moms%',       $titl='@Momssats for ydelsen',        $revi=true, $rows='', $width='45',$step='0.5');
  htm_NextFelt('08%');  htm_CombFelt($type='tal2d', $name='pris',     $valu= $pris,     $labl='@Pris',        $titl='@Angiv enhedspris',            $revi=true, $rows='', $width='45',$step='0.25');
  htm_NextFelt('05%');  htm_CombFelt($type='tal1d', $name='rabat',    $valu= $rabat,    $labl='@Rabat%',      $titl='@Angiv rabatsats',             $revi=true, $rows='', $width='45',$step='0.25');
  htm_NextFelt('09%');  htm_CombFelt($type='tal2d', $name='ialt',     $valu= $ialt,     $labl='@Linie ialt',  $titl='@Beregnet felt: ialt',         $revi=false,$rows='', $width='45',$step='0.25');
  htm_LastFelt();
}

# PROGRAM-MODUL;
function Rude_Tabel($TablData=array()) {
  htm_Rude_Top($name= 'naviform',$capt= '@DEMO: Tabel med fastlåst kolonne-header og "rulle-vindue"',$parms='',$icon='fa-database','panelWmax',__FUNCTION__);
  htm_Tabel($RowLabl='@Klik på Lb-nummeret for at se ordre',$ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]  
            ['@Lb.Nr.','6%','','','','','..auto..'],['@Ordre dato','7%','','date','left','','åååå-mm-dd'],['@Lev. dato','7%','','date','left','','åååå-mm-dd'],
            ['@Konto nr.','6%','','text','center','',tolk('@Kont...')],['@Firma navn','24%','','','','',tolk('@Firm...')],
            ['@Sælger','8%','','','','',tolk('@Sælg...')],['@Ordre sum','6%','','','','',tolk('@Beløb...')]),
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
function Rude_Debitorer($TablData=array()) {
  htm_Rude_Top($name= 'naviform',$capt= '@Konti - Debitorer:',$parms='',$icon='fa-database','panelWmax',__FUNCTION__);
  htm_Tabel($RowLabl='@Klik på konto-nummeret for at se debitor',$ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
            ['@Kontonr.','6%','','','','','..auto..'],['@Kundenavn','10%','','','','','Firm...'],['@Adresse','8%','','','','','Addr...'],
            ['@Sted','8%','','','','','Sted...'],['@Postnr','4%','','','','','Post...'],['@By','8%','','','','','By...'],
            ['@Kontakt','12%','','','','','Kont...'],['@Telefon','12%','','','','','Telf...'],['@Sælger','12%','','','','','Sælg...']),
            $TablData= array( # DemoData:
            ['1025','Firmanavn','Adresse','Sted','Postnr','By','Kontakt','Telefon','Sælger'],
            ['1026','Firmanavn','Adresse','Sted','Postnr','By','Kontakt','Telefon','Rip'],
            ['1027','Firmanavn','Adresse','Sted','4560','By','Kontakt','Telefon','Rap'],
            ['1028','Firmanavn','Adresse','Sted','Postnr','By','Kontakt','Telefon','Rup']
            ) );
  htm_RudeBund($pmpt='@Gem',$subm=false);
}

function Rude_DebitorKort() { //  Sammensatte Ruder! = "Vindue".
  //if ($onPanel) 
  htm_Tapet_Top($name='menuform' ,$capt='@Debitorkort', $parms='', $icon='fa-database', $klasse='panelWmax',__FUNCTION__);
  SpalteTop(320);
    Rude_Kunden($kontonr, $kategori, $cvrnr, $eannr, $bankreg, $bankkto, $instit, $ansv, $formsprog, $homeweb);           
    Rude_Betingelser($debigrup, $betaling, $frist, $print2, $kunderef);     
  NextSpalte();
    Rude_Kontakter();   
    Rude_Mailfaktura($emne, $text, $vedhft);    
  NextSpalte();
    Rude_Fakturering ($navn='Anders And', $addr='Andedammen 34', $sted='Ved Lunden', $ponr='1234', $by='Eventyrland', $land='Eventyrland', 
                      $noter='Levering på anden adresse!', $telf='045 12345678', $att='Rap', $email='anders@and.dk', $usemail='', $faktdato);   
    Rude_Ekstrafelter($felt1, $felt2, $felt3, $felt4, $felt5);    
//    Rude_Ekstrafelter($felt1, $felt2, $felt3, $felt4, $felt5, $prefix=tolk('@Ordre Felt'));    
  SpalteBund();
  //if ($onPanel) 
  htm_TapetBund();
}

# PROGRAM-MODUL;
function Rude_Kreditorer($TablData=array()) {
  htm_Rude_Top($name= 'naviform',$capt= '@Konti - Kreditorer:',$parms='../_base/page_Gittermenu.php',$icon='fa-database ','panelWmax',__FUNCTION__);
  htm_Tabel($RowLabl='@Klik på konto-nummeret for at se kreditorkort',$ColStyle= array(   #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
            ['@Kontonr.','6%','','','','@Kreditor konto nummer','..auto..'],
            ['@Leverandør Navn','15%','','','','@Adressat navn',tolk('@Navn...')],
            ['@Adresse','12%','','','','@Postadresse',tolk('@Addr...')],
            ['@Sted','12%','','','','@Suplement til adresse',tolk('@Sted...')],
            ['@Post','5%','','','','@Post nr',tolk('@Post...')],
            ['@By','18%','','','','@Bynavn',tolk('@By...')],
            ['@Kontakt person','10%','','','','@Tilknyttet navn',tolk('@Kont...')],
            ['@Telefon','10%','','','','@Kontakt telefon',tolk('@Telf...')]),
            $TablData= array( # DemoData:
            ['1025','Navn','Adresse','Sted','Post nr','By','Kontakt person','Telefon'],
            ['1026','Navn','Adresse','Sted','Post nr','By','Kontakt person','Telefon'],
            ['1027','Navn','Adresse','Sted','Pnr',    'By','Kontakt person','Telefon'],
            ['1028','Navn','Adresse','Sted','Post nr','By','Kontakt person','Telefon']
            ) );
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
}

//   Sammensatte Ruder! = "Vindue".
function Rude_KreditorKort($kontonr, $kategori, $cvrnr, $eannr, $bankreg, $bankkto, $instit, $ansv, $formsprog, $homeweb) {//  Parametre mangler for: Adresse, Kontakter, Ekstrafelter
  htm_Tapet_Top($name='menuform', $capt='@Kreditorkort', $parms='', $icon='fa-database', $klasse='panelWmax',__FUNCTION__);
  SpalteTop(320);
    Rude_Adresse($navn='Anders And', $addr='Andedammen 34', $sted='Ved Lunden', $ponr='1234', $by='Eventyrland', $land='Eventyrland', 
                      $noter='', $telf='045 12345678', $att='Rap', $email='anders@and.dk', $usemail='', $faktdato);   
//    Rude_Betingelser($debigrup, $betaling, $frist, $print2, $kunderef);     
  NextSpalte();
    Rude_Kontakter();   
//    Rude_Mailfaktura($emne, $text, $vedhft);    
  NextSpalte();
    Rude_Leverandor($kontonr, $kategori, $cvrnr, $eannr, $bankreg, $bankkto, $instit, $ansv, $formsprog, $homeweb);           
    Rude_Ekstrafelter($felt1, $felt2, $felt3, $felt4, $felt5, $prefix= tolk('@Extra Felt'));    
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

# PROGRAM-MODUL;
function Rude_Adresse($navn, $addr, $sted, $ponr, $by, $land, $noter, $telf, $att, $email, $usemail, $faktdato) {
  htm_Rude_Top($name='faktform',$capt='@Leverandør - Adresse:',$parms='',$icon='fa-pencil-square-o','panelWmax',__FUNCTION__);
  htm_CombFelt($type='text',    $name='navn', $valu= $navn,   $labl='@Navn',          $titl='@Angiv Kreditor Navn'  );
  htm_CombFelt($type='text',    $name='addr', $valu= $addr,   $labl='@Adresse',       $titl='@Angiv Adresse'        );
  htm_CombFelt($type='text',    $name='sted', $valu= $sted,   $labl='@Sted',          $titl='@Angiv Kreditor Sted, suplement til adresse'  );
  htm_FrstFelt('25%');                                              
    htm_CombFelt($type='text',  $name='ponr', $valu= $ponr,   $labl='@Postnr',        $titl='@Angiv Kreditor postnr');
  htm_NextFelt('75%');                                              
    htm_CombFelt($type='text',  $name='by',   $valu= $by,     $labl='@By',            $titl='@Angiv Kreditor Bynavn');
  htm_lastFelt();                                                   
  htm_CombFelt($type='text',    $name='land', $valu= $land,   $labl='@Land',          $titl='@Angiv Kreditor Land'  );
  htm_CombFelt($type='area',    $name='noter',$valu= $noter,  $labl='@Bemærkninger',  $titl='@Angiv Bemærkninger',    $revi=true, $rows='1');
  htm_CombFelt($type='text',    $name='telf', $valu= $telf,   $labl='@Telefon(er)',   $titl='@Angiv Telefon'      );
  htm_CombFelt($type='text',    $name='att',  $valu= $att,    $labl='@Attention',     $titl='@Angiv Attention'    );
  htm_CombFelt($type='mail',    $name='email',$valu= $email,  $labl='@Email adresse', $titl='@Angiv Email adresse');
  htm_FrstFelt('50%');  
    htm_CheckFlt($type='checkbox',$name='useMail', $valu= $usemail, $labl='@Benyt mail',      $titl='@Send besked med mail', $revi=true);
  htm_NextFelt('50%');  
    htm_CombFelt($type='date',  $name='faktdato',  $valu= $faktdato, $labl='@Adresse Dato',   $titl='@Adresse Dato',     $revi=true);
  htm_LastFelt();
  htm_RudeBund($pmpt='@Fakturér',$subm=true,$title='@Fakturer og udskriv til den under {Betingelser}, valgte udskriver!');
}


# PROGRAM-MODUL;
function Rude_KredOrdrer($TablData=array()) {
  htm_Rude_Top($name= 'naviform',$capt= '@Ordrer: Kreditorer - `Leverandørordrer`:',$parms='',$icon='fa-database','panelWmax',__FUNCTION__);
  htm_Tabel($RowLabl='@Klik på ordre-nummeret for at leverandørordre',$ColStyle= array(#   [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
            ['@Ordre nr.','6%','','','','','..auto..'],['@Modt.nr.','5%','','','','','Modt...'],    ['@Fakt.nr.','6%','','','','','Fakt...'],['@Ordre dato','7%','','date','','','åååå-mm-dd'],
            ['@Modt.dato','7%','','date','','','åååå-mm-dd'],['@Konto nr.','8%','','','','','Kont...'],['@Firma navn','30%','','','','','Navn...'],['@Telefon','6%','','','center','','Telf...'],
            ['@Leveres til','6%','','','left','','Lev...'],['@Vor ref.','5%','','','left','','Ref...'],['@Faktura sum','8%','','','right','','Beløb...']),
            $TablData= array( # DemoData:
            ['1025','Modt.nr.','Fakt.nr.','Ordre dato','Modt.dato','Konto nr.','Firma navn','Telefon','Leveres til','Vor ref.','Faktura sum'],
            ['1026','Modt.nr.','Fakt.nr.','Ordre dato','Modt.dato','Konto nr.','Firma navn','Telefon','Leveres til','Vor ref.','Faktura sum'],
            ['1027','Modt.nr.','Fakt.nr.','Ordre dato','Modt.dato','Konto nr.','Firma navn','Telefon','Leveres til','Vor ref.','Faktura sum'],
            ['1028','Modt.nr.','Fakt.nr.','Ordre dato','Modt.dato','Konto nr.','Firma navn','Telefon','Leveres til','Vor ref.','Faktura sum']
            ) );
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
}

# PROGRAM-MODUL;
function Rude_DebtDebitor($TablData=array()) {
  htm_Rude_Top($name= 'PanelForm',$capt= '@Debitorliste',$parms='../_base/page_Gittermenu.php',$icon='fa-database','panelWmax',__FUNCTION__);
#   Luk  Debitorer   Historik Visning Ny
#   Kontonr Firmanavn Adresse Adresse 2 Postnr  By  Kontakt Telefon Sælger    OK
  htm_Tabel($RowLabl='@Klik på konto-nummeret for at se yderligere data på debitorkort nedenfor',$ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
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
  echo '<hr><div style="margin-left:1em; display:block; font-weight: normal;" >'.tolk('Vælg:').' '; 
    textKnap($label='@Opret Ny',  $title='@Opret ny debitor', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Historik',  $title='@Historik for',     $link='../_base/page_Blindgyden.php');    
    textKnap($label='@Visning',   $title='@Bestem hvilke felter der skal vises i listen', $link='../_base/page_Blindgyden.php');
  echo '</div>';  
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
}

# PROGRAM-MODUL;
function Rude_DebtOrdrer(&$TablData) {
  htm_Rude_Top($name= 'PanelForm',$capt= '@Ordrer: Debitorer - `Salgsordrer`:',$parms= '../_base/page_Gittermenu.php',$icon= 'fa-database','panelWmax',__FUNCTION__);
  htm_Tabel($RowLabl='@Klik på ordre-nummeret for at vise kundeordre',$ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
            ['@Ordre nr.','6%','','','','','..auto..'],
            ['@Ordre dato','7%','','date','left','','åååå-mm-dd'],
            ['@Lev. dato','7%','','date','left','','åååå-mm-dd'],
            ['@Konto nr.','6%','','text','center','',tolk('@Kont...')],
            ['@Firma navn','20%','','','','',tolk('@Firm...')],
            ['@Sælger','8%','','','','',tolk('@Sælg...')],
            ['@Ordre sum','6%','','','','',tolk('@Beløb...')],
            ['@Status','6%','','','','',tolk('@Status...')]
            ),
            $TablData/* = array( # DemoData:
            ['1025','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum','faktureret'],
            ['1026','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum','leveret'],
            ['1027','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum','betalt'],
            ['1028','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum','tilbud']
            ) */
            , $FilterOn=true, $SortOn=true, $CreateRec=true, $ModifyRec=true, $ViewHeight='70px' );
  htm_nl();
  htm_CentrOn(); 
    #echo '<hr><div style="margin-left:1em; display:block; font-weight: normal;" >'.tolk('Vælg:').' '; 
    textKnap($label='@Ny ordre',  $title='@Opret ny ordre', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Tilbud',    $title='@Opret Tilbud',     $link='../_base/page_Blindgyden.php');    
    textKnap($label='@Ordrer',    $title='@Ordrer', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Faktura',    $title='@Faktura', $link='../_base/page_Blindgyden.php');
    textKnap($label='@PBS',    $title='@PBS', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Import PBS',    $title='@Import PBS', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Importer UBL til ordrer',    $title='@Importer UBL til ordrer', $link='../_base/page_Blindgyden.php');
  #echo '</div>';  
  htm_CentOff(); 
    htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
}

# PROGRAM-MODUL;
function Rude_DebRapp(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {
  htm_Rude_Top($name= 'PanelForm',$capt= '@Debitor-rapporter:',$parms= '../_base/page_Gittermenu.php',$icon= 'fa-list','panelW320',__FUNCTION__);
    htm_FrstFelt('04%',0);  
    htm_NextFelt('36%');  echo '<p align="center">'.tolk('@Angiv kriterier:').'</p> ';
    htm_NextFelt('02%');  
    htm_NextFelt('58%');  htm_CheckFlt($type='checkbox',$name='somfakt',$valu='somfakt',
                          $labl='@Husk dem', $titl='@Afmærk her, hvis kriterier skal genbruges.',  $revi=true);
    htm_LastFelt();
  htm_FrstFelt('05%',0);  
  htm_NextFelt('48%');  htm_CombFelt($type='text',$name='konto',  $valu='', $labl='@Konto',     $titl='@Angiv rapporterings Konto', $revi=true);
  htm_NextFelt('47%');  htm_CombFelt($type='date',$name='dato',   $valu='', $labl='@Fra Dato',  $titl='@Angiv periode start Dato',  $revi=true);
  htm_LastFelt();
  echo '<hr><div style="margin-left:1em; display:block; font-weight: normal;" >'.tolk('Vælg:').' '; 
    textKnap($label='@Åbne poster',    $title='@Rapport for debitor åbne poster',     $link='../_base/page_Blindgyden.php',$akey='å');
    textKnap($label='@Konto saldo',    $title='@Rapport for debitor konto saldo',     $link='../_base/page_Blindgyden.php',$akey='s');    
    textKnap($label='@Konto kort',     $title='@Rapport for debitor konto kort',      $link='../_base/page_Blindgyden.php',$akey='k');
    textKnap($label='@Salgs statistik',$title='@Rapport for debitor Salgs statistik', $link='../_base/page_Blindgyden.php',$akey='t');
    textKnap($label='@Top 100',        $title='@Rapport for Top 100',                 $link='../_base/page_Blindgyden.php',$akey='1');
  echo '</div>';  
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
}

function Rude_Rapportliste() {
  htm_Rude_Top($name= 'rappform',$capt= '@Vis rapport:',$parms='../_base/page_Gittermenu.php',$icon='fa-file-text-o','panelW640',__FUNCTION__);
  htm_CentrOn(); 
    echo tolk('@Vælg rapport i vinduet til venstre, og få vist resultatet her.').str_nl(3);
  htm_CentOff();
  htm_RudeBund($pmpt='@Gem',$subm=false);
}

# PROGRAM-MODUL;
function Rude_KredRapp(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {
  htm_Rude_Top($name= 'naviform',$capt= '@Kreditor-rapporter:',$parms='../_base/page_Gittermenu.php',$icon='fa-list','panelW320',__FUNCTION__);
    htm_FrstFelt('04%',0);  
    htm_NextFelt('36%');  echo '<p align="center">'.tolk('@Angiv kriterier:').'</p> ';
    htm_NextFelt('02%');  
    htm_NextFelt('58%');  htm_CheckFlt($type='checkbox',$name='somfakt',$valu='somfakt',
                          $labl='@Husk dem', $titl='@Afmærk her, hvis kriterier skal genbruges.',  $revi=true);
    htm_NextFelt('05%');
    htm_LastFelt();
  htm_FrstFelt('0%',0); 
  htm_NextFelt('50%');  htm_CombFelt($type='text',$name='konto',  $valu='', $labl='@Konto',     $titl='@Angiv rapporterings Konto', $revi=true);
  htm_NextFelt('50%');  htm_CombFelt($type='date',$name='dato',   $valu='', $labl='@Fra Dato',  $titl='@Angiv periode start Dato',  $revi=true);
  htm_LastFelt();
  echo '<hr><div style="margin-left:1em; display:block; font-weight: normal;" >'.tolk('Vælg:').' '; 
    textKnap($label='@Åbne poster',    $title='@Rapport for kreditor åbne poster',    $link='../_base/page_Blindgyden.php',$akey='å');
    textKnap($label='@Konto saldo',    $title='@Rapport for kreditor konto saldo',    $link='../_base/page_Blindgyden.php',$akey='s');
    textKnap($label='@Konto kort',     $title='@Rapport for kreditor konto kort',     $link='../_base/page_Blindgyden.php',$akey='k');
    textKnap($label='@Købs statistik', $title='@Rapport for kreditor købs statistik', $link='../_base/page_Blindgyden.php',$akey='t');
  echo '</div>'; 
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
}


# PROGRAM-MODUL;
function Rude_KasseRedigering($id='2',$dato='Dato',$ejer='Bogholder',$bemr='Bemærkning 2',$bogf='Bogført',$af='Af') /* DEMO  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */
{
  $dktip=   tolk('@D/K/F feltet benyttes i forbindelse med debitor- og kreditor posteringer.').' '.
            tolk('@Er feltet tomt eller udfyldt med F, betragtes det efterfølgende kontonummer som et Finans konto-nummer.').
            tolk('@Skrives der `d` eller `k`, vil det efterfølgende nummer blive tolket som et Debitor konto-nummer eller et Kreditor konto-nummer.');
  $debkre=  tolk('@Debet Kt. og Kredit Kt.-felterne er til kontonummeret på den konto, posteringen skal ske på.').
            tolk('@Afhængigt af koden i D/K vil der være tale om en debitor-, Kreditor- eller Finanskonto');
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
  htm_Rude_Top($name= 'kasseform',$capt= tolk('@Kassekladde:').' '.$id.', <small>'.$ejer.'</small>',$parms='',$icon='fa-database','panelWmax',__FUNCTION__);
  htm_TabelInp(
    $HeadLine= array(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      ['@Kladde notat:', '60%','left','text', '@Her kan skrives en bemærkning til kladden',                  '@Angiv din tekst...'], 
      ['@Konto-kontrol:','5em','left','text', '@Angiv kontonummer for den konto, hvis bevægelser skal kontrolleres',  '@Nummer...'], 
    ),
    $RowHead= array( #  ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! ']  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
          ['PDF',     '3%','center','text','<a href='.$link.'><img src=../_assets/icons/'.$clip.'  alt="Clips" height="20" width="12" border=0 title="'.tolk($title).
              '"></a>',tolk('@I denne kolonne håndterer du PDF-bilag, som er tilknyttet den enkelte postering.'),'placeh']
          ),
    $ColStyle= array( # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],
      ['@Bilag.',       '5%','','text', 'left',  tolk('@Bilagsnummer tildeles automatisk og fortsættes fra sidst anvendte bilagsnummer fra samme bruger.').' ','...auto...'],
      ['@Dato',         '9%','','date', 'center',tolk('@Bilagets dato, som automatisk sættes til dags dato, men kan ændres.'),'fakt.dato'],
      ['@Bilags tekst','17%','','text', 'left',  tolk('@Bilagstekst er frivillig, men det er nyttigt senere at kunne se, hvad de enkelte posteringer drejer sig om.').' ',tolk('@Posterings note...')],
      ['@D/K',        '3.5%','','text', 'center',$dktip,'d/k/f'],
      ['@Debet Kt.',    '8%','','text', 'center',$debkre],
      ['@D/K',        '3.5%','','text', 'center',$dktip,'d/k/f'],
      ['@Kredit Kt.',   '8%','','text', 'center',$debkre],
      ['@Faktura nr.',  '8%','','text', 'center',tolk('@Fakturanr. benyttes i forbindelse med debitor- og kreditorposteringer.')],
      ['@Beløb',        '8%','','tal2d','right' ,tolk('@Beløb indeholder det beløb, der skal bogføres. Hvis man ved simulering eller anden kontrol opdager, ').
                      tolk('@at en linje skal bogføres direkte modsat af, hvad der står i kassekladden, så kan man blot sætte minustegn foran beløbet. ').' '.
                      tolk('@På den måde bytter kontonumrene i felterne debet og kredit plads, og beløbet bliver igen positivt.')],
      ['@Valuta',       '4%','','text','center',tolk('@Valutakode for den valuta, som er benyttet på bilaget.'),'DKK'],
      ['@Forfald',      '9%','','date','center',tolk('@Beløbets forfalds dato.')],
      ['@moms',        '3.5%','','text', 'center',tolk('@Uden moms: Angiv 0, hvis der ikke skal beregnes moms.'),'@u/m'],
      ),
    $RowTail= array(  # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:InpType', '4:FeltJust', '5:ColTip', '6:value! ']
        ['@Konto saldo','8%','','text','right', #'0.000,00<div type= "text" name="saldo" value="00.000,00" width="8%"/>',
          tolk('@Bevægelser og saldo for den konto, som er angivet ovenfor i Felt: Konto-kontrol.').' <br>'.
          tolk('@Er velegnet til afstemning med bank- og girokonti'),'.calc...']),
        $data= array(1,2,3,4,5,6,7,8,9,10,11,12,13),  # Antal rows ved DEMO
      $ViewHeight='',
      $PadTop='0px'
  );
### PanelFooter:
### KnapPanel:
  htm_CentrOn(); 
    textKnap($label='@Gem',             $title='@Klik her for at gemme',$link='../_base/page_Blindgyden.php',$akey='g');
    textKnap($label='@Opslag',          $title='@Opslag - din markørs placering angiver hvilken tabel, opslag foretages i',$link='../_base/page_Blindgyden.php',$akey='o');
    textKnap($label='@Bogfør',          $title='@Bogfør - der foretages først en simulering, som du skal bekræfte',$link='../_base/page_Blindgyden.php',$akey='b');
    textKnap($label='@Simuler',         $title='@Simulering af bogføring viser bevægelser i kontoplanen',$link='../_base/page_Blindgyden.php',$akey='s');
    textKnap($label='@Annuller',        $title='@Annuller simulering',  $link='../_base/page_Blindgyden.php',$akey='a');
    htm_Spacer();
    textKnap($label='@Kopier',          $title='@Kopier til ny',        $link='../_base/page_Blindgyden.php',$akey='k');
    textKnap($label='@Tilbagefør',      $title='@Tilbagefør postering', $link='../_base/page_Blindgyden.php',$akey='t');
    textKnap($label='@Hent ordrer',     $title='@Henter afsluttede ordrer fra ordreliste',$link='../_base/page_Blindgyden.php',$akey='h');
    textKnap($label='@DocuBizz import', $title='@DocuBizz import',      $link='../_base/page_Blindgyden.php',$akey='d');
    textKnap($label='@Import',          $title='@Importerer bankposteringer eller andre data fra .csv-fil (kommasepareret fil)',$link='../_base/page_Blindgyden.php',$akey='i');
    textKnap($label='@Udlign',          $title='@Finder åbne poster, som modsvarer beløb og fakturanummer',$link='../_base/page_Blindgyden.php',$akey='u');
  htm_CentOff();
  TastTip();
  htm_RudeBund($pmpt='@Gem',$subm=true);
}

function Rude_Kladderedigering($DataArr= array()) /*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */
{
dvl_ekko(' Rude_Kladderedigering XX ');
  # Head_Navigation(tolk('@Kassekladde'), $status='', $goPrev=false, $goHome=true, $goUp=true, $goFind=false, $goNew=false, $goNext=false); 
  htm_Rude_Top($name= 'naviform',$capt= '@Kassekladde liste:',$parms='',$icon='fa-list','panelWmax',__FUNCTION__);
dvl_ekko(' Rude_Kladderedigering YY ');
  htm_Tabel($RecLabl='vise denne kassekladde nedenfor', $ColStyle= array(  #   [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
            ['@Id','7%','D','','','',''],['@Dato','10%','','date','','','åååå-mm-dd'],['@Ejer','10%','','','','','Ejer...'],['@Bemærkning','48%','','','','','Bem...'],
            ['@Bogført','14%','U','','','','Bogf...'],['@Af','8%','','','','','Af...']),
            $DataArr= array(
            ['1','Dato','Ejer','Bemærkning 1','Bogført','Af'],
            ['2','Dato','Ejer','Bemærkning 2','Bogført','Af'],
            ['3','Dato','Bogholder','Bemærkning 3','Bogført','Af']
            ), $FilterOn=true, $SortOn=true, $CreateRec=true, $ModifyRec=true, $ViewHeight='200px', $Angaar='Rude_Kladderedigering');
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true);
  Rude_KasseRedigering($DataArr[2][0],$DataArr[2][2]);
//  Rude_FootMenu($doPrint=true, $doErase=true, $doLookUp=true, $doAccept=true, $doExport=true, $doImport=true, 
//    $OpslLabl='@Opslag: markørens placering bestemmer, hvilken tabel opslag skal foretages i');
}

function Rude_Budget( &$DATA, $regnskabsaar='2016', $maanedantal=12, $startaar=2016, $startmaaned=1) 
{
### Gør $ColStyle klar:
  $MdTitles= periodeoverskrifter($maanedantal, $startaar, $startmaaned, 1, "regnskabsmaaned", $regnskabsaar);  //  periodeoverskrifter benytter: ['@'.$periode_kort, '5%','','tal2d', 'right', '@'.$periode_lang,'']
  $ColStyle= array();  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
  array_push($ColStyle, 
              ['@Konto',     '4%','','data',  'center', '@Kontonummer. Entydig nummerkode, som benyttes til sortering, summering mv.','@Konto...'],
              ['@Kontonavn','22%','','data',  'left',   '@Kontonavn - beskrivende tekst','']
            );
  foreach ($MdTitles as $Md) array_push($ColStyle, $Md);
  array_push($ColStyle, ['@I alt',  '5%','','tal2d', 'right', '@Budgetårets aktuelle ultimo beløb.','']);
  # var_dump($ColStyle);
  htm_Rude_Top($name= 'budgform',$capt= tolk('@Budget ').' '.($regnskabsaar+0).':',$parms= 'Rude_Erdusikker()',$icon='fa-list','panelWmax',__FUNCTION__);
  htm_TabelInp_Budget(
    $HeadLine= array(['@Nyt budget:', '10%','left','show', '@ +/- 0% OK', '@Pct. korrektion']),
    $RowHead= array(),  # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! ']
    $ColStyle,
    $RowTail= array(),  # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:InpType', '4:FeltJust', '5:ColTip', '6:value! ']
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
    naviKnap($label='@Retur til Hovedmenu', $title='@Vend tilbage til programmets hovedmenu',$link='../_base/page_Gittermenu.php',$akey='h');
    textKnap($label='@Vis print layout',    $title='@Skjul header og footer, og vis tabel i fuld højde, så du kan udskrive regnskabet med CTRL-P', $link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem hele budgettet.',$akey='g');
}

# PROGRAM-MODUL;
function Rude_OrdrePostering( &$data) {
  htm_Rude_Top($name= 'ordreform',$capt= '@Indtastning af salgs ordre poster - `Varelinier`:',$parms='',$icon='fa-database','panelWmax',__FUNCTION__);
  htm_TabelInp(
    $HeadLine= array(
      ['@Status:', '60%','left','text', '@Her kan skrives en bemærkning til ordren', '@Ny ordre, endnu uden kundetilknytning!'], 
      ['@Kundetilknytning:','5em','left','text', '@Angiv kontonummer på kunden','@Konto...'], 
    ),
    $RowHead= array(), # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! '] #  array(['Link'],['Label'],['Tip'],['4%']),
    $ColStyle= array(  # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],
      ['@Pos.',        '5%','', 'text', 'left',tolk('@Position tildeles automatisk.').' ','Pos...'],
      ['@Varenr',     '10%','', 'text', 'left',tolk('@Varenummer hentes fra vareregistret.'),'Vare...'],
      ['@Antal',       '5%','', 'text', 'left',tolk('@Mængden af den aktuelle leverance.').' ','Ant...'],
      ['@Enhed',       '5%','', 'text', 'left',tolk('@Enhedsbeskrivelse af mængden'),'Enh...'],
      ['@Beskrivelse','40%','', 'text', 'left',tolk('@Leverance beskrivlse'),'Beskr...'],
      ['@Pris',       '10%','', 'tal2d','left',tolk('@Enhedspris'),'Pris...'],
      ['@Rabat%',      '6%','', 'tal2d','left',tolk('@Rabatsats i %.'),'Rabat'],
      ['@Moms%',       '6%','', 'tal2d','left',tolk('@Moms %-sats for den posterede leverance'),'Moms...'],
    # ['@Linie ialt', '10%','', 'tal2d','left',tolk('@Beregnet beløb.')] tilføjes internt i htm_TabelInp
    ),
//  $RowTail= array(['<a href='.$link.' onclick=\"return confirm($confm)\"><img src=../_assets/icons/clip.png  alt="Clips" height="80%" width="80%" border=0></a>'],  [])
    $RowTail= array(  # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:InpType', '4:FeltJust', '5:ColTip', '6:value! ']
        ['@um.',       '5%','','text','center',tolk('@um. (uden moms) kan benyttes til at bogføre beløb uden moms på konti, selvom kontoen har en momssats tilknyttet.'), '<input type= "checkbox" name="udenmoms" value="" >'],
        ['@Linie ialt','8%','','text','center',tolk('@Beregnet felt med summen af de samlede beløb'), '00.000,00']), #'<div type= "text" name="saldo" value="00.000,00" width="8%">']),
    $data,    //  = array(1,2,3,4,5,6,7,8,9,10),  # Antal rows ved DEMO
    $ViewHeight= '500px',
    $PadTop='0px'
  );
### PanelFooter:
#+  NaviTip();
### KnapPanel:
  htm_CentrOn();
    textKnap($label='@Gem',             $title='@Klik her for at gemme',$link='../_base/page_Blindgyden.php');
    textKnap($label='@Opslag',          $title='@Opslag - din markørs placering angiver hvilken tabel, opslag foretages i',$link='../_base/page_Blindgyden.php');
    textKnap($label='@Slet alt',        $title='@Klik her for at nulstille alle data i tabellen.',$link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_RudeBund($pmpt='@Gem',$subm=false);
}

# PROGRAM-MODUL;
function Rude_Kontoplan( &$TablData) {
  htm_Rude_Top($name= 'kontoform',$capt= '@Kontoplan:',$parms='../_base/page_Gittermenu.php',$icon='fa-database','panelW960',__FUNCTION__);
  htm_Tabel($RowLabl='@Klik på konto-nummeret for at redigere denne konto, på kontokortet nedenfor.',
            $ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
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

# PROGRAM-MODUL;
function Rude_KontoKort( &$data) {
  htm_Rude_Top($name= 'kontoform',$capt= '@Kontokort:',$parms='../_system/page_Kontoplan.php',$icon='fa-pencil-square-o','panelW960',__FUNCTION__);
  htm_TabelInp(
    $HeadLine= array( [tolk('@Vælg en konto i kontoplanen').' - ', '18%','left','show', ' ', '@Rediger konto:'] ),
      $RowHead= array(),  # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! '] #  array(['Link'],['Label'],['Tip'],['4%']),
            $ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
              ['@Kontonr.',  '9%','','text', 'left',   '@Kontonummer. Entydig nummerkode, som benyttes til sortering, summering mv. Angiver du et ubenyttet, oprettes en ny konto, ellers kan du rette kontoen.','@Konto...'],
              ['@Kontonavn','50%','','text', 'left',   '@Kontonavn - beskrivende tekst','@Navn...'],
              ['@Type',      '7%','','kont', 'left',   '@Kontotype: D=Drift, S=Status, Z=Sum, H=Overskrift, R=Resultat, X=Sideskift, L=Lukket','@Type...'],
              ['@Moms',      '7%','','moms', 'left',   '@Momskode: K_:Købs... S_:Salgs... Y_:Ydelser, E_:, ','@Moms...'],
              ['@Σ Fra-Kt.', '9%','','text', 'center', '@Summér fra_konto. Angiv laveste kontonummer, som skal med i sammentællingen. Angår kun sum-konti, type Z','@Fra...'],
              ['@Valuta',    '7%','','valu', 'left',   '@Valuta kode','@Valu...'],
              ['@Saldo',     '7%','','show', 'center', '@Kontoens saldo. beregnet beløb','..calc..'],
              ['@Genvej',    '7%','','text', 'left',   '@Genvejs tast, angiv et bogstav','@Genv...'],
              ['@Status',    '7%','','stat', 'left',   '@Status: Aktiv eller Lukket','@Stat...']
    ),
    $RowTail= array(), #'<div type= "text" name="saldo" value="00.000,00" width="8%">']),
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

# PROGRAM-MODUL;
function Rude_RapportFinans($Aar_Liste='', $Art_Liste='', $somfakt='', $Knt_Liste='') 
{global $Ø_MdrList, $Ø_DagList, $Ø_ArtList; // oprettet i ../_base/out_base.php
  htm_Rude_Top($name= 'rappform',$capt= '@Finansrapport:',$parms='../_base/page_Gittermenu.php',$icon='fa-database','panelW480',__FUNCTION__);
  # htm_SelectStr($name,$valu,Aar_Liste());
  $Aar_Liste= Aar_Liste();
  $Knt_Liste= MakeDriftsKonti();
  htm_FrstFelt('50%',0);  htm_CombList($name='ListName',$valu='2016',$labl='@Regnskabsår',$titl='@Der kan kun rapporteres inden for et regnskabsår, hvilket angives her.',$liste= $Aar_Liste);
  htm_NextFelt('50%');    textKnap($label='@Opdatér',    $title='@Opdater her efter en rettelse af regnskabsår',$link='../_base/page_Blindgyden.php');
  htm_LastFelt();
  htm_FrstFelt('35%',0);  htm_CombList($name='ListMoms',$valu='momsangivelse',$labl='@Rapporttype',$titl='@Her vælges blandt de i programmet opsatte rapporttyper', $liste= Art_Liste()); # $Ø_ArtList
  htm_NextFelt('65%');    htm_CheckFlt($type='checkbox',$name='somfakt',$valu='somfakt', $labl='@Medtag lagerbevægelser', $titl='@Afmærk her, hvis lagerbevægelser skal medtages.',  $revi=true);
  htm_LastFelt();
    if ('momsangivelse'=='momsangivelse') msg_Tip($title="@Om momsafregning",  $messg="@Husk at det er en god ide at bogføre med udgangen af MOMS regnskabs perioden, så konto: <br>66100&nbsp;Salgsmoms og 66200&nbsp;Købsmoms <br>er opdateret inden indberetning.");
  // Virker ikke:
  run_Script('if (document.getElementById("ListMoms").value=="momsangivelse") msg_Tip($title="@Om momsafregning",  '.
      '$messg="@Husk at det er en god ide at bogføre med udgangen af MOMS regnskabs perioden, så konto: '.
      '<br>66100&nbsp;Salgsmoms og 66200&nbsp;Købsmoms <br>er opdateret inden indberetning.");');
  
  echo '<hr><colrlabl>';  
		htm_FrstFelt('50%',0);   echo tolk('@Periode fra:');    
		htm_NextFelt('50%');     echo tolk('@Periode til:');    
		htm_LastFelt(); 
  echo '</colrlabl>';
  htm_FrstFelt('10%',0);  htm_CombList($name='ListName',$valu='2016',$labl='@År:',    $titl='@Årstallet for periodens start',$liste= $Aar_Liste); 
  htm_NextFelt('15%');    htm_CombList($name='ListName',$valu='0',   $labl='@Måned:', $titl='@Måneden for periodens start',$liste= $Ø_MdrList); 
  htm_NextFelt('25%');    htm_CombList($name='ListName',$valu='0',   $labl='@Dag:',   $titl='@Dagen for periodens start',$liste= $Ø_DagList);
  htm_NextFelt('10%');    htm_CombList($name='ListName',$valu='2016',$labl='@År:',    $titl='@Årstallet for periodens slut',$liste= $Aar_Liste); 
  htm_NextFelt('15%');    htm_CombList($name='ListName',$valu='11',  $labl='@Måned:', $titl='@Måneden for periodens slut',$liste= $Ø_MdrList);
  htm_NextFelt('35%');    htm_CombList($name='ListName',$valu='30',  $labl='@Dag:',   $titl='@Dagen for periodens slut',$liste= $Ø_DagList);
  htm_LastFelt();
  htm_FrstFelt('50%',0);  htm_CombList($name='ListName',$valu='', $labl='@Fra konto', $titl='@Første konto nummer, som medtages i rapporten',$liste= $Knt_Liste);
  htm_NextFelt('50%');    htm_CombList($name='ListName',$valu='', $labl='@Til konto', $titl='@Sidste konto nummer, som medtages i rapporten',$liste= $Knt_Liste);
  htm_LastFelt();
  echo '<hr><div style="margin-left:1em; display:block; font-weight: normal;" >'.tolk('Vælg:').' '; 
    textKnap($label='@Kontrolspor',       $title='@Vilkårlig søgning i transaktioner',                $link='../_base/page_Blindgyden.php');    
    textKnap($label='@Provisionsrapport', $title='@Rapport over medarbejdernes provisionsindtjening', $link='../_finans/page_Provisionsrapport.php');
  echo '</div>';  
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
}

# PROGRAM-MODUL;
function Rude_Provisionsrapport(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {
  htm_Rude_Top($name= 'provform',$capt= '@Provisionsrapport:',$parms='../_base/page_Gittermenu.php',$icon='fa-database','panelWmax',__FUNCTION__);
  
  msg_Dialog('warn',ucfirst(tolk('@Retur')),'JavaScript:window.history.back();','','','','',ucfirst(tolk('@Her mangler der noget')),
            ucfirst(tolk('@Provisionsrapport kan ikke testes, før der er DB-adgang.')));
  
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
}

# PROGRAM-MODUL;
function Rude_Regnskab($regnskab='', $maanedantal=12, $startaar=2017, $startmaaned=1, $periode_dag=1, $periode_laengde="regnskabsmaaned", $regnskabsaar='2016', &$TablData) 
{
  htm_Rude_Top($name= 'kontoform',$capt= tolk('@Regnskab:').' '.$regnskab, $parms='../_base/page_Gittermenu.php',$icon='fa-database','panelWmax',__FUNCTION__);
  $MdTitles= periodeoverskrifter($maanedantal=12, $startaar=2017, $startmaaned=1, $periode_dag=1, $periode_laengde="regnskabsmaaned", $regnskabsaar='2016');
  //  periodeoverskrifter benytter: ['@'.$periode_kort,    '4.5%','','tal2d', 'right', '@'.$periode_lang,'']
  $ColStyle= array();  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
  array_push($ColStyle, 
              ['@Konto',     '5%','','text',  'center', '@Kontonummer. Entydig nummerkode, som benyttes til sortering, summering mv.','@Konto...'],
              ['@Kontonavn','17%','','text',  'left',   '@Kontonavn - beskrivende tekst',''],
              ['@Type',      '3%','','text',  'left',   '@Kontotype: D=Drift, S=Status, Z=Sum, H=Overskrift, R=Resultat, X=Sideskift, L=Lukket','@Type...'],
              ['@Valuta',    '4%','','text',  'right',  '@Valutakode for kontoens beløb',''],
              ['@Primo:',     '6%','','tal2d', 'right',  '@Året primo beløb, Sidste års ultimo','']);
  foreach ($MdTitles as $Md) array_push($ColStyle, $Md);
  array_push($ColStyle, ['@I alt nu:', '6%','','tal2d', 'right', '@Aktuelle beløb. (Årets ultimo beløb)','.calc.']);
  htm_Tabel($RowLabl='@Klik på konto-nummeret for at vælge denne post',
            $ColStyle,
            $TablData,  // = ImportTabFile('../_exchange/kontoplan-extra.tab'),  // Indlæs data fra TAB-fil
            $FilterOn=false, $SorterOn=true, $CreateRec=false, $ModifyRec=false, $ViewHeight='500px', $Angaar='regnskab' );
### PanelFooter:
  htm_RadioGrp($type='hori',  $name='krvis', $labl='@Beløbsvisning:', $titl='@Vælg visnings nøjagtighed for regnskabs beløb',  
              $optlist= array(['kr2d','@Kroner,ører','@eller',true],['kr','@Hele kroner','@eller'],['tusind','@Kun tusinder','']),$action='');
### KnapPanel:
  htm_CentrOn();
    naviKnap($label='@Til Budget',          $title='@Klik her for komme til budgetlægning',   $link='../_finans/page_Budget.php');
    naviKnap($label='@Retur til hovedmenu', $title='@Luk og gå retur til hovedmenu', $link='../_base/page_Gittermenu.php');
    textKnap($label='@Vis print layout',    $title='@Skjul header og footer, og vis tabel i fuld højde, så du kan udskrive regnskabet med CTRL-P', $link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Luk og gå retur til hovedmenu');
}

function Rude_Regnskabsaar(&$TablData) {
  htm_Rude_Top($name= 'regnform',$capt= '@Regnskabsår:',$parms='../_system/page_Valuta.php',$icon='fa-database','panelW480',__FUNCTION__); 
  echo '<colrlabl>';      
		htm_FrstFelt('44%',0);  
		htm_NextFelt('24%');    echo 'Periode start:';  
		htm_NextFelt('24%');    echo 'Periode slut:';   
		htm_NextFelt('8%');     
		htm_LastFelt(); 
	echo '</colrlabl>';
  htm_Tabel($RowLabl='@Klik på ID-nummeret for at vise regnskabskortet',
            $ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
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
  htm_RudeBund($pmpt=Tolk('@Retur til indstillinger'),$subm=true,$title='@Luk og gå retur til indstillingsmenu');
}

function Rude_Regnskabskort(&$DATA, $besk='2016', $aar0='2016', $md0='01', $aar1='2016', $md1='12', $aktiv=true, $fak1Nr) {
  htm_Rude_Top($name= 'kortform',$capt= '@Regnskabskort:',$parms='../_system/page_Valuta.php',$icon='fa-pencil-square-o','panelW480',__FUNCTION__); 
  echo tolk('@Fastlæg 1. regnskabsår: 2016').'<br><br>';
  echo '<colrlabl>';
  htm_FrstFelt('40%',0);  echo 'Regnskabsår:';
  htm_NextFelt('20%');    echo 'Periode start:';
  htm_NextFelt('20%');    echo 'Periode slut:';
  htm_NextFelt('20%');    echo 'Bogføring:';
  htm_LastFelt();    
  echo '</colrlabl>';
  htm_FrstFelt('40%',0);  htm_CombFelt($type='text',    $name='besk',  $valu= $besk, $labl='@Beskrivelse.',  $titl='@Angiv Beskrivelse',         $revi=true, $rows='',$width='30',$step='0.5');
  htm_NextFelt('10%');    htm_CombFelt($type='text',    $name='md0',   $valu= $md0,  $labl='@Måned',         $titl='@Angiv periode start Måned', $revi=true,$rows='',$width='30');
  htm_NextFelt('10%');    htm_CombFelt($type='text',    $name='aar0',  $valu= $aar0, $labl='@År',            $titl='@Angiv periode start År',    $revi=true, $rows='',$width='30');
  htm_NextFelt('10%');    htm_CombFelt($type='text',    $name='md1',   $valu= $md1,  $labl='@Måned',         $titl='@Angiv periode slut Måned',  $revi=true,$rows='',$width='30');
  htm_NextFelt('10%');    htm_CombFelt($type='text',    $name='aar1',  $valu= $aar1, $labl='@År',            $titl='@Angiv periode slut År',     $revi=true, $rows='',$width='30');
  htm_NextFelt('20%');    htm_CheckFlt($type='checkbox',$name='aktiv', $valu= $aktiv,$labl='@tilladt',  $titl='@Angiv om bogføring er tilladt', $revi=true);
  htm_LastFelt();       
  
  #-  echo '<colrlabl>&nbsp;'.tolk('@Auto nummerering:').'</colrlabl>';
  htm_CentHead('&nbsp;'.tolk('@Auto nummerering:'));
  htm_FrstFelt('50%',0);  htm_CombFelt($type='text',    $name='regn',  $valu= $fak1Nr,   $labl='@1. faktura nummer',     $titl='@Faktura nummer for periodens første faktura',   $revi=true, $rows='2',$width='',$step='', $more='', $plho=tolk('@Faktura...'));
  htm_NextFelt('50%');    htm_CombFelt($type='text',    $name='regn',  $valu= $fak1Nr,   $labl='@1. modtagelses nummer', $titl='@Modtagelses nummer for periodens første bilag', $revi=true, $rows='2',$width='',$step='', $more='', $plho=tolk('@Modtage...'));
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
    $RowHead=  array(),  # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! '] # array(['@Konto.','15%','center','','4:','5:Tip'],['@Beskrivelse','62%','left','','4:','5:Tip']),
    $ColStyle= array(  #  ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],
              ['@Konto.',     '12%','','show',  'center', '@Entydigt konto nummer, fastlagt i kontoplanen.','@auto...'],
              ['@Beskrivelse','60%','','show',  'left',   '@Tekst som beskriver kontoen, fastlagt i kontoplanen.','@Besk...'],
              ['@Debet',      '14%','','tal2d', 'right',  '@Debet primosaldo','primo...','SW'],
              ['@Kredit',     '14%','','tal2d', 'right',  '@Kredit primosaldo','primo...','SW'],
             ),
    $RowTail= array(),  # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:InpType', '4:FeltJust', '5:ColTip', '6:value! ']
    $DATA= MakeStatusKonti(),
    $ViewHeight= '500px',
    $PadTop='0px', __FUNCTION__
  );

//  htm_Tabel($RowLabl='@Klik på konto-nummeret for at vælge denne post',
//            $ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
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

function MakeStatusKonti() {
  $StatusKt= array();
  $filDATA= ImportTabFile('../_exchange/kontoplan.tab');
  foreach ($filDATA as $rec) {if ($rec[2]=='S') array_push($StatusKt, [$rec[0],$rec[1],'0.00','0.00']);}
  # var_dump($StatusKt);
  return $StatusKt;
}
function MakeDriftsKonti() {
  $DriftKt= array();
  $filDATA= ImportTabFile('../_exchange/kontoplan.tab');
  foreach ($filDATA as $rec) {if ($rec[2]=='D') array_push($DriftKt, [$rec[1],$rec[0],$rec[0]]);}
  # var_dump($filDATA);
  # var_dump($DriftKt);
  return $DriftKt;
}

# SubRutine:
#function- getComboA(sel) { var value = sel.value; };

# PROGRAM-MODUL;
function Rude_Kontrolspor(&$Data) {global $Ønovice;
  htm_Rude_Top($name= 'sporform',$capt= '@Kontrol sporing',$parms='../_finans/page_Rapport.php',$icon='fa-database','panelWmax',__FUNCTION__);
    
  htm_FrstFelt('2%',0);  echo '<colrlabl style="text-align:right">&nbsp;'.tolk('@Vis:').'</colrlabl>';
  htm_NextFelt('5%');    htm_CombFelt($type='number',  $name='linier', $valu= 50,   $labl='@Linier',  $titl='@Max. antal linier, som vises pr. side: ', $revi=true, $rows='',$width='',$step='5' );
  htm_NextFelt('90%');   echo '<colrlabl>&nbsp;'.tolk('@pr. side').'</colrlabl>';  if ($Ønovice) echo ' - '.tolk('@´Kontrolspor´ = Find grundlaget for regnskabstallene.');
  htm_LastFelt();       

  htm_Tabel($RecLabl='se ?', 
      $ColStyle= array(  #   [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
        ['@Id',         '4%','','text','center',tolk('@Angiv et id-nummer eller angiv to adskilt af kolon (f.eks 345:350)'),''],
        ['@Dato',       '8%','','date','right', tolk('@Angiv en dato eller angiv to adskilt af kolon (f.eks 010605:300605)'),'...'.tolk('@Tekst').'åååå-mm-dd'],
        ['@Log. dato',  '8%','','date','right', tolk('@Angiv en dato eller angiv to adskilt af kolon (f.eks 010605:300605)'),'åååå-mm-dd'],
        ['@Tidspunkt',  '7%','','text','center',tolk('@Angiv et tidspunkt (f.eks 17:35) '),'?'],
        ['@Kladde',     '7%','','text','center',tolk('@Angiv et kassekladdenummer eller angiv to adskilt af kolon (f.eks 345:350)'),'?'],
        ['@Bilag',      '7%','','text','center',tolk('@Angiv et bilagsnummer eller angiv to adskilt af kolon (f.eks 345:350)'),'?'],
        ['@Konto.',     '7%','','text','center',tolk('@Angiv et kontonummer eller angiv to adskilt af kolon (f.eks 345:350)'),'?'],
        ['@Fakturanr',  '7%','','text','center',tolk('@Angiv et fakturanummer eller angiv to adskilt af kolon (f.eks 345:350)'),'?'],
        ['@Debet',      '7%','','text','center',tolk('@Angiv et beløb eller angiv to adskilt af kolon (f.eks 10000,00:14999,99)'),'?'],
        ['@Kredit',     '7%','','text','center',tolk('@Angiv et bel&oslash;b eller angiv to adskilt af kolon (f.eks 10000,00:14999,99)'),'?'],
# if($vis_projekt):
        ['@Projekt',    '7%','','text','center',tolk('@Angiv et projektnummer eller angiv to adskilt af kolon (f.eks 5:7)'),'?'],
        ['@Søgetekst', '20%','','text','left',  tolk('@Angiv en søgetekst. Der kan anvendes * før og efter teksten'),'?']),
      $Data,  //   array( ['1',''], ), 
      $FilterOn=true, $SortOn=true, $CreateRec=false, $ModifyRec=true);
  htm_CentrOn(); htm_nl();
    textKnap($label='@Start søgning', $title='@Start søgning med de angivne kriterier.',$link='../_base/page_Blindgyden.php');
    textKnap($label='@CSV-eksport', $title='@Klik her for at eksportere valgte transaktioner til CSV-fil for import i andet program, f.eks. regneark.',$link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_RudeBund($pmpt='@Retur til finansrapport',$subm=true,$title='@Gå til vinduet finansrapport');
}


# PROGRAM-MODUL;
function Rude_Formularer( &$formtype, &$formart, &$formsprog) {
  htm_Rude_Top($name= 'formularform',$capt= '@Formularstyring',$parms='../_system/page_Valuta.php',$icon='fa-wrench','panelW240',__FUNCTION__);
  htm_OptioFlt($type='text',  $name='formtype',   $valu= $formtype, 
                    $labl='@Formular',      
                    $titl='@Vælg en Formular som du vil redigere',  
                    $revi=true, $optlist= array(
                    ['@Rediger Tilbuds blanket',              '1', '@Tilbud'],
                    ['@Rediger Plukliste',                    '9', '@Plukliste'],
                    ['@Rediger formular for ordrebekræftelse ','2', '@Ordrebekræftelse'],
                    ['@Rediger følgeseddel blanket',          '3', '@Følgeseddel'],
                    ['@Rediger faktura blanket',              '4', '@Faktura'],
                    ['@Rediger blanket for kreditnota',       '5', '@Kreditnota'],
                    ['@Rediger blanket for 1. rykker',        '6', '@Rykker 1'],
                    ['@Rediger blanket for 2. rykker',        '7', '@Rykker 2'],
                    ['@Rediger blanket for 3. rykker',        '8', '@Rykker 3'],
                    ['@Rediger blanket for kontokort',       '11', '@Kontokort'],
                    ['@Rediger blanket for indkøbsforslag',  '12', '@Indkøbsforslag'],
                    ['@Rediger blanket for rekvisition',     '13', '@Rekvisition'],
                    ['@Rediger blanket for købsfaktura',     '14', '@Købsfaktura'],
                  # ['@Rediger ','10', '@Pos'],
                    ),$action='');
  htm_OptioFlt($type='text',  $name='formart',   $valu= $formart, 
                    $labl='@Formular Art',     
                    $titl='@Vælg formularens Art (Objekt type)',  
                    $revi=true, $optlist= array(
                    ['','1:Tekster',      '@Tekster'],
                    ['','2:Linjer',       '@Grafik'],
                    ['','3:Ordrelinjer',  '@Ordrelinjer'],
              #     ['','4:Flyt center',  '@Flyt center'],
              #     ['','5:Mail tekst',   '@Mail tekst'],
                    ),$action='onchange="getComboA(this)"');
# if (!trim($formularsprog)) $formularsprog="Dansk";  print "<option value=\"".stripslashes($formularsprog)."\">".stripslashes($formularsprog)."</option>\n";
# $q=db_select("select distinct sprog from formularer order by sprog",__FILE__ . " linje " . __LINE__);
# while ($r=db_fetch_array($q)) { if ($formularsprog!=$r['sprog']) print "<option value=\"".stripslashes($r['sprog'])."\">".stripslashes($r['sprog'])."</option>\n";  }

  htm_OptioFlt($type='text',  $name='formsprog',   $valu= $formsprog, 
                    $labl='@Formular Sprog',      
                    $titl='@Vælg hvilket Sprog du vil benytte på formularen', 
                    $revi=true, $optlist= array(
                    ['','dansk',    '@Dansk'],
                    ['','engelsk',  '@Engelsk'],
                    ),$action='');
  echo  '<br>';
  echo '<div align="right">';
  echo textKnap($label='@Rediger valgt formular',             $title='@Rediger det du har valgt ovenfor',$link='../_base/page_Blindgyden.php').'<hr>';
  echo '</div>';
  echo  textKnap($label='@Gem mine formularer',               $title='@Lav backup af det nugældende formularsæt.',    $link='../_base/page_Blindgyden.php').'<br><br>';
  echo  textKnap($label='@Genindlæs mine formularer',         $title='@Tag backup i brug, ved at benytte den som nugældende formularsæt.',$link='../_base/page_Blindgyden.php').'<br><br>';
  echo  textKnap($label='@Importer formular(er) fra LO ',     $title='@Indlæs fra .fodg-fil dannet af formularredigering i LibreOffice',   $link='../_base/page_Blindgyden.php').'<br><br>';
  echo  textKnap($label='@Overskriv formularer med standard', $title='@Overskriv formulardefination med system standard',$link='../_base/page_Blindgyden.php').'<br><br>';
  echo  textKnap($label='@Håndtering af formularsprog',       $title='@Sproghåndtering: Opret, Nedlæg sprog',         $link='../_base/page_Blindgyden.php').'<br><br>';
  echo  textKnap($label='@Upload/Download supportfiler',      $title='@Fil upload: Logo, Grafik, Billeder eller fodg-fil fra Libre Office',$link='../_base/page_Blindgyden.php').'<br><br>';
  htm_RudeBund($pmpt='@Retur til indstillinger',$subm=true,$title='@Gå til menuen indstillinger');
}

function SetHeadArr($x) {
  return  array(   # $HeadLine= array([0:Labl, 1:Width, 2:Just, 3:InpType, 4:Tip, 5:placeholder])
    ['@Formular:',  '10%','left','show', '', '@Faktura'],
    ['@Art:',       '10%','left','show', '', $x],
    ['@Sprog:',     '10%','left','show', '', '@Dansk'],
  );
}

# PROGRAM-MODUL;
function Rude_FormRedigerText(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {
  htm_Rude_Top($name= 'redigerform',$capt= '@Rediger Formular: Tekster',$parms='',$icon='fa-wrench','panelW960',__FUNCTION__);
  $link= '';
  htm_TabelInp(     # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      $HeadLine= SetHeadArr('@Tekster'),
      $RowHead= array(),  # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! ']
      $ColStyle= array( # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],
        ['@$Variabel',  '10%','', 'vlst','left',tolk('@Her kan du vælge mellem de variabler, som er relevante, for den aktuelle formular. Variabler, som kan benyttes, har prefix: $'),''],
        ['@Tekst/$variabel','35%','', 'text','left',tolk('@Feltets tekst og/eller $Variabler kombineret'),'...'.tolk('@Tekst').'...'],
        ['@X',          '4%','','text','right', tolk('@Feltets x-placering målt i mm fra venstre side-kant'),'.x.'],
        ['@Y',          '4%','','text','right', tolk('@Feltets y-placering målt i mm fra side-bund'),'.y.'],
        ['@Højde',      '4%','','text','right', tolk('@Felt højde målt i mm'),'.h.'],
        ['@Farve',      '7%','','text','center',tolk('@Tekst farve. Se farve skema'),'#Kode.'],
        ['@Just.',      '4%','','just','center',tolk('@Justering i feltet: V:'.tolk('@venstre').', C:'.tolk('@centreret').', H:'.tolk('@højre').''),'?'],     //  '<SELECT class="inputbox" NAME=justering[$x]>     <option>$justering</option>     <option>V</option>      <option>C</option>      <option>H</option>      </SELECT>'
        ['@Font',       '8%','','font','center',tolk('@Skrift type navn: Helvetica, Times, OCRbb12').','.tolk('@Font navn').'...'],  //  '<SELECT class="inputbox" NAME=form_font[$x]> if ($font) <option>$font</option> <option>Helvetica</option>  <option>Times</option>  <option>Ocrbb12</option>  </SELECT>'
        ['@Side',       '4%','','side','center',tolk('@Medtages på udskrifts side. A:alle, 1:første, !1:ikke første, S:sidste, !S:ikke sidste')],  //  '<SELECT class="inputbox" NAME=side[$x]>  if ($side) <option>$side</option> <option>A</option>  <option>1</option>  <option>!1</option> <option>S</option>  <option>!S</option> </SELECT>'
        ),
      $RowTail= array(   # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:InpType', '4:FeltJust', '5:ColTip', '6:value! ']
        ['@Fed',        '4%','','text','center',tolk('@Bold skrift type, også kaldet fed skrift'),'<a hrefxxx='.$link.' ><input type= "checkbox" name="bold" value="" ></a>','.?.'],
        ['@Skrå',       '4%','','text','center',tolk('@Skrå skrift type, også kaldet italic'),'<a hrefxxx='.$link.' ><input type= "checkbox" name="italic" value="" ></a>','.?.']),
      $data= array(1,2,3,4,5,6,7,8,9,10),  # Antal rows ved DEMO
      $ViewHeight= '500px',
      $PadTop= '0px'
    );  
    XY_forskydning();
    echo '<hr>';
    htm_FrstFelt('15%');  echo '<div style= "text-align:right">'.tolk('@Mail tekster:').'</div>';
    htm_NextFelt('20%');  htm_CombFelt($type='area',  $name='emne',   $valu= '',  $labl='@Emne',   $titl='@Her kan du angive mailens emne-tekst.',        $revi=true,$rows='2',$width='45',$step='',$more='placeholder=" '.tolk('@Vedrørende...').'"');
    htm_NextFelt('45%');  htm_CombFelt($type='area',  $name='besked', $valu= '',  $labl='@Besked', $titl='@Besked til modtageren.',                       $revi=true, $rows='', $width='45',$step='',$more='placeholder=" '.tolk('@Vedhæftet følger...').'"');
    htm_NextFelt('20%');  htm_CombFelt($type='area',  $name='bilag',  $valu= '',  $labl='@Bilag',  $titl='@Angiv navne, på de filer der skal vedhæftes.', $revi=true, $rows='', $width='45',$step='',$more='placeholder=" '.tolk('@PDF-fil...').'"');
    htm_LastFelt(); 
    htm_RudeBund($pmpt='@Gem',$subm=true);
}

# PROGRAM-MODUL;
function Rude_FormRedigerGrafik(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {
  htm_Rude_Top($name= 'redigerform',$capt= '@Rediger Formular: Grafik',$parms='',$icon='fa-wrench','panelW960',__FUNCTION__);
  htm_TabelInp(     # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      $HeadLine= SetHeadArr('@Grafik'),
      $RowHead= array(  # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! ']
        ['LOGO: ',    '27%','right','text','  ','Grafik f.eks. jpg-billede. Billedet benyttes uden skalering, så det skal være målfast med 720 pt/in.','.?.'],
      ),
      $ColStyle= array( # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],
        ['@X-venstre', '8%','','text','right', tolk('@Stregens x-startpunkt målt i mm fra venstre side-kant'),'.x.'],
        ['@Y-bund',    '8%','','text','right', tolk('@Stregens y-startpunkt målt i mm fra side-bund'),'.y.'],
        ['@Side',      '5%','','side','center',tolk('@Medtages på udskrifts side. A:alle, 1:første, !1:ikke første, S:sidste, !S:ikke sidste')],
        ['@Filnavn',  '30%','','text','left',  tolk('@Filnavn på grafik-fil').' (?.jpg)'],
        ),
      $RowTail= array(  # ['0:ColLabl', '1:ColWidth', '2:disp!', '3:InpType', '4:FeltJust', '5:ColTip', '6:value!']
        ['@Note',          '22%','','text','center','@(planlagt)','.?.'],
      ),
      $data= array(1,2), # Antal rows ved DEMO
      $ViewHeight= '500px',
      $PadTop= '0px'
    );
  htm_TabelInp(     # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      $HeadLine= array(),
      $RowHead= array(  # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! ']
        ['STREGER:',        '23%','right','text','  ','Grafiske linier','.?.'],
      ),
      $ColStyle= array( # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],
        ['@X-start', '6%','','text','right', tolk('@Stregens x-startpunkt målt i mm fra venstre side-kant'),'.x.'],
        ['@Y-start', '6%','','text','right', tolk('@Stregens y-startpunkt målt i mm fra side-bund'),'.y.'],
        ['@X-slut',  '6%','','text','right', tolk('@Stregens x-slutpunkt målt i mm fra venstre side-kant'),'.x.'],
        ['@Y-slut',  '6%','','text','right', tolk('@Stregens y-slutpunkt målt i mm fra side-bund'),'.y.'],
        ['@Bredde',  '6%','','text','right', tolk('@Felt højde målt i mm'),'.h.'],
        ['@Farve',   '8%','','text','left',  tolk('@Tekst farve. Se farve skema'),'#Kode.'],
        ['@Side',    '5%','','side','center',tolk('@Medtages på udskrifts side. A:alle, 1:første, !1:ikke første, S:sidste, !S:ikke sidste')],
        ['@Note',   '20%','','text','center',  tolk('@Huske-tip for denne streg...'),' '.tolk('@Stregen angår...')],
        ),
      $RowTail= array(  # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:InpType', '4:FeltJust', '5:ColTip', '6:value! ']
      //  ['@Note:',  '20%','center','text','','@(planlagt)','.?.'],
      ),
      $data= array(1,2,3,4,5,6,7,8,9,10),  # Antal rows ved DEMO
      $ViewHeight= '500px',
      $PadTop= '10px'
    );
    XY_forskydning();
    htm_RudeBund($pmpt='@Gem',$subm=true);
}

# PROGRAM-MODUL;
function Rude_FormRedigerOrdrelin(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {
  htm_Rude_Top($name= 'redigerform',$capt= '@Rediger Formular: Ordrelinier',$parms='',$icon='fa-wrench','panelW960',__FUNCTION__);
  htm_TabelInp(     # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
     $HeadLine= SetHeadArr('@Ordrelinjer'),
     $RowHead= array(  # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! ']
        ['Generelt: ',    '30%','right','text',' Ordreliniers placering på siden: ','Tip','.?.'],
      ),
      $ColStyle= array( # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],
        ['@Linie antal',  '8%','','text','center',  tolk('@Antal ordrelinier på en side.'),'.n.'],
        ['@Top-linie',    '8%','','text','center',  tolk('@Første ordrelines y-startpunkt målt i mm fra side-bund'),'.y.'],
        ['@Linieafstand', '8%','','text','center',  tolk('@Afstand mellem liniers grundlinie, målt i mm. '),'.Afstand [mm].'],
        ['@Bredde af beskrivelse', '8%','', 'text', 'center',tolk('@Maksimal linie længde for beskrivelse, inden der brydes til ny linie, målt i mm. '),'.Bredde [mm].'],
        ),
      $RowTail= array(  # ['0:ColLabl', '1:ColWidth', '2:disp!', '3:InpType', '4:FeltJust', '5:ColTip', '6:value!']
        ['@Note',         '30%','','text','center','@(planlagt)','.?.'],
      ),
      $data= array(1), # Antal rows ved DEMO
      $ViewHeight= '500px',
      $PadTop= '0px'
    );
  htm_TabelInp(     # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      $HeadLine= array(),
      $RowHead= array(  # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! ']
        ['ORDRELINIER:',  '15%','right','text','  ',tolk('@Tekst linier med ordrepostering.'),'.?.'],
      ),
      $ColStyle= array( # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],
        ['@Feltnavn','16%','','data',   'left',  tolk('@Navnet på variablen. Variabler som benyttes i ordrelinier, her prefix: £'),'@navn...'],
        ['@X-pos',    '6%','','number', 'right', tolk('@Tekstens x-startpunkt målt i mm fra venstre side-kant'),'.x.'],
        ['@Højde',    '6%','','number', 'right', tolk('@Teksthøjde målt i [px]'),'.h.'],
        ['@Farve',    '6%','','text',   'left',  tolk('@Tekst farve. Se farve skema'),'#...'],
        ['@Just.',    '4%','','just',   'center',tolk('@Justering i feltet: V:venstre, C:centreret, H:højre'),'?'],     //  '<SELECT class="inputbox" NAME=justering[$x]>     <option>$justering</option>     <option>V</option>      <option>C</option>      <option>H</option>      </SELECT>'
        ['@Font',     '8%','','font',   'center',tolk('@Skrift type navn: Helvetica, Times, OCRbb12'),'Font navn...'],  //  '<SELECT class="inputbox" NAME=form_font[$x]> if ($font) <option>$font</option> <option>Helvetica</option>  <option>Times</option>  <option>Ocrbb12</option>  </SELECT>'
        ),
      $RowTail= array(  # ['0:ColLabl', '1:ColWidth', '2:disp!', '3:InpType', '4:FeltJust', '5:ColTip', '6:value!']
        ['@Fed',      '4%', '','text','center',tolk('@Bold skrift type, også kaldet fed skrift'),'<a hrefxxx='.$link.' ><input type= "checkbox" name="bold" value="" ></a>','.?.'],
        ['@Skrå',     '4%', '','text','center',tolk('@Skrå skrift type, også kaldet italic'),'<a hrefxxx='.$link.' ><input type= "checkbox" name="italic" value="" ></a>','.?.'],
        ['@Note:','20%','','text','center',    tolk('@(Ikke implementeret endnu!)'),'.?.']
      ), 
      $data= array( [['£posnr'],['X-pos'],['Højde'],['Farve'],['Just'],['Font'],['Fed'],['Skrå'],['@Note']],
                    [['£varenr'],['X-pos'],['Højde'],['Farve'],['Just'],['Font'],['Fed'],['Skrå'],['@Note']],
                    [['£beskrivelse'],['X-pos'],['Højde'],['Farve'],['Just'],['Font'],['Fed'],['Skrå'],['@Note']],
                    [['£antal'],['X-pos'],['Højde'],['Farve'],['Just'],['Font'],['Fed'],['Skrå'],['@Note']],
                    [['£liniesum'],['X-pos'],['Højde'],['Farve'],['Just'],['Font'],['Fed'],['Skrå'],['@Note']],
                    [['Nyt felt'],['X-pos'],['Højde'],['Farve'],['Just'],['Font'],['Fed'],['Skrå'],['@Note']] ), 
                    # [[0:Feltnavn],[1:X-pos],[2:Højde],[3:Farve],[4:Just.],[5:Font],[6:Fed],[7:Skrå],[8:Evt. Note:],[... ]]
        $ViewHeight= '500px',
        $PadTop= '10px'
    );
//    msg_Dialog('warn',ucfirst(tolk('@Retur')),'JavaScript:window.history.back();',ucfirst(tolk('@Fortsæt')), $Knap2_function='$jQ112(this).dialog("close")','','',ucfirst(tolk('@Her er problemer!')), ucfirst(tolk('@Der er ikke styr på ordreliniers data!')));
    XY_forskydning();
    htm_RudeBund($pmpt='@Gem',$subm=true);
}

# PROGRAM-MODUL;
function Rude_MomsSetup(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {
  htm_Rude_Top($name= 'moms',$capt= '@Moms indstillinger:',$parms='',$icon='fa-wrench','panelW960',__FUNCTION__);
if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,__FUNCTION__.':1');
  htm_TabelInp(     # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      $HeadLine= array( [' ', '8%','left','show', '', '@Indland'] ),
      $RowHead= array(  # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! ']
        ['@Salgsmoms (udgående moms): ',    '24%','right','text','@Salg: ','@Den moms du skal betale til SKAT','.?.'],
      ),
      $ColStyle= array( # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],
        ['@Nr.',          '4%','','data','center', tolk('@Positions nummer i gruppen'),'.Nr.'],
        ['@Beskrivelse', '20%','','data','left',   tolk('@Kontobeskrivelse. En beskrivende tekst efter eget valg'),'Tekst... (Opret ny konto)'],
        ['@Konto',        '6%','','data','center', tolk('@Det nummer i kontoplanen, som salgsmomsen skal konteres på.'),'Konto...'],
        ['@%-Sats',       '6%','','data','center', tolk('@Moms %-sats'),'25%...'],
        ),
      $RowTail= array(  # ['0:ColLabl', '1:ColWidth', '2:disp!', '3:InpType', '4:FeltJust', '5:ColTip', '6:value!']
        ['@Note',     '30%','','text','center',  '@(planlagt)','.?.'],
      ),
      $data= array( [['1'],['@Salgsmoms'],['66100'],['25,00'],['']], [['2'],[''],[''],[''],['']] ),
      $ViewHeight= '500px',
      $PadTop='2px' 
     );
if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,__FUNCTION__.':2');
  htm_TabelInp(     # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      $HeadLine= array(['']),
      $RowHead= array(  # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! ']
        ['@Købsmoms (indgående moms): ',    '24%','right','text','@Køb: ','@Den moms du skal have retur fra SKAT','.?.'],
      ),
      $ColStyle= array( # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],
        ['@Nr.',          '4%','','data','center',tolk('@Positions nummer i gruppen'),'.Nr.'],
        ['@Beskrivelse', '20%','','data','left',  tolk('@Kontobeskrivelse. En beskrivende tekst efter eget valg'),'Tekst... (Opret ny konto)'],
        ['@Konto',        '6%','','data','center',tolk('@Det nummer i kontoplanen, som købsmomsen skal konteres på.'),'Konto...'],
        ['@%-Sats',       '6%','','data','center',tolk('@Moms %-sats'),'25%...'],
        ),
      $RowTail= array(  # ['0:ColLabl', '1:ColWidth', '2:disp!', '3:InpType', '4:FeltJust', '5:ColTip', '6:value!']
        ['@Note',     '30%','','text','center',  '@(planlagt)','.?.'],
      ),
      $data= array( [['1'],['@Købsmoms'],['66200'],['25,00'],['']], [['2'],[''],[''],[''],[''] ] ),
      $ViewHeight= '500px',
      $PadTop='2px'
     );
   echo '<hr>';

if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,__FUNCTION__.':3');
  htm_TabelInp(     # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      $HeadLine= array( [' ', '8%','left','show', ' ', '@Udland'] ),
      $RowHead= array(  # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! ']
        ['@Moms af ydelseskøb i udlandet: ',    '24%','right','text','@Ydel: ','@Ved ydelseskøb i udlandet, skal der betales dansk moms på vegne af sælgeren. Samtidig kan købsmomsen trækkes fra så resultatet bliver 0','.?.'],
      ),
      $ColStyle= array( # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],
        ['@Nr.',          '4%','', 'data','center',tolk('@Positions nummer i gruppen'),'.Nr.'],
        ['@Beskrivelse', '20%','', 'data','left',  tolk('@Kontobeskrivelse. En beskrivende tekst efter eget valg'),'Tekst... (Opret ny konto)'],
        ['@Konto',        '6%','', 'data','center',tolk('@Konto til postering af salgsmoms for ydelseskøb i udlandet'),'Konto...'],
        ['@%-Sats',       '6%','', 'data','center',tolk('@Moms %-sats'),'25%...'],
        ['@Modkonto',     '6%','', 'data','center',tolk('@Konto til postering af købsmoms for ydelseskøb i udlandet'),'Konto...'],
        
        ),
      $RowTail= array(  # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:InpType', '4:FeltJust', '5:ColTip', '6:value! ']
        ['@Note',     '22%','','text','center','@(planlagt)','.?.'],
      ),
      $data= array( [['1'],['@Moms af ydelseskøb i udlandet'],['66155'],['25,00'],['66200']], [['2'],[''],[''],[''],[''] ] ),
      $ViewHeight= '500px',
      $PadTop='2px' 
     );

if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,__FUNCTION__.':4');
  htm_TabelInp(     # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      $HeadLine= array( ),
      $RowHead= array(  # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! ']
        ['@Moms af varekøb i udlandet: ',    '24%','right','text','@Vare: ','@Ved varekøb i udlandet, skal der betales dansk moms på vegne af sælgeren. Samtidig kan købsmomsen trækkes fra så resultatet bliver 0','.?.'],
      ),
      $ColStyle= array( # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],
        ['@Nr.',          '4%','','data','center', tolk('@Positions nummer i gruppen'),'.Nr.'],
        ['@Beskrivelse', '20%','','data','left',   tolk('@Kontobeskrivelse. En beskrivende tekst efter eget valg'),'Tekst... (Opret ny konto)'],
        ['@Konto',        '6%','','data','center', tolk('@Konto til postering af salgsmoms for køb i udlandet'),'Konto...'],
        ['@%-Sats',       '6%','','data','center', tolk('@Moms %-sats'),'25%...'],
        ['@Modkonto',     '6%','','data','center', tolk('@Konto til postering af købsmoms for køb i udlandet'),'Konto...'],
        
        ),
      $RowTail= array(  # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:InpType', '4:FeltJust', '5:ColTip', '6:value! ']
        ['@Note',     '22%','','text','center','@(planlagt)','.?.'],
      ),
      $data= array( [['1'],['@Moms af varekøb m.v. i udlandet'],['66150'],['25,00'],['66200']], [['2'],[''],[''],[''],[''] ] ),
      $ViewHeight= '500px',
      $PadTop='2px' 
     );

   echo '<hr>';
  htm_TabelInp(     # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      $HeadLine= array( [' ', '8%','left','show', '', '@Rapporter'] ),
      $RowHead= array(  # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! ']
        ['@Momsrapport (konti som skal indgå i momsrapport): ',    '24%','right','text','@Rap: ','@Her angives intervaller af konti, som skal danne grundlag for momsrapporter.','.?.'],
      ),
      $ColStyle= array( # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],
        ['@Nr.',          '4%','', 'data','center',tolk('@Positions nummer i gruppen'),'.Nr.'],
        ['@Beskrivelse', '20%','', 'data','left',  tolk('@Kontobeskrivelse. En beskrivende tekst efter eget valg'),'Tekst... (Opret ny)'],
        ['@Fra',          '6%','', 'data','center',tolk('@Første kontonummer som skal indgå i rapporten'),'Konto...'],
        ['@Til',          '6%','', 'data','center',tolk('@Sidste kontonummer som skal indgå i rapporten'),'Konto...'],
        ['@Rubrik A1',    '6%','', 'data','center',tolk('@Kontonummer for samlet varekøb i EU'),'Konto...'],
        ['@Rubrik A2',    '6%','', 'data','center',tolk('@Kontonummer for samlet ydelseskøb i EU'),'Konto...'],
        ['@Rubrik B1',    '6%','', 'data','center',tolk('@Kontonummer for samlet varesalg i EU'),'Konto...'],
        ['@Rubrik B2',    '6%','', 'data','center',tolk('@Kontonummer for samlet ydelsessalg i EU'),'Konto...'],
        ['@Rubrik C',     '6%','', 'data','center',tolk('@Kontonummer for samlet vare- og ydelsessalg uden for EU'),'Konto...'],
        ),
      $RowTail= array(  # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:InpType', '4:FeltJust', '5:ColTip', '6:value! ']
        ['',        '1%','center','text','','',''],
      ), 
      $data= array([['1'],['@Momsrapport'],['66100'],['66200'],['2800'],['2700'],['1220'],['1200'],['1290']],
                   [['2'],[''],[''],[''],[''],[''],[''],[''],['']] 
      ),
      $ViewHeight= '500px',
      $PadTop='2px' 
     );
  htm_RudeBund($pmpt='@Gem',$subm=true);
}


# PROGRAM-MODUL;
function Rude_Stamdata(
  &$firmanavn, &$addr1, &$addr2, &$postnr, &$bynavn, &$ny_email, &$homepage, &$bank_navn, &$bank_reg, &$bank_konto, &$cvrnr, &$tlf, &$fax, &$pbs_nr, &$pbs, &$gruppe, &$fi_nr
) { 
  htm_Rude_Top($name='stamkort',$capt='@Stamdata:',$parms='',$icon='fa-user',$klasse='panelW320',__FUNCTION__);
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
  htm_CombFelt(                      $type='text',  $name='cvrnr',      $valu= $cvrnr,      $labl='@CVR',         $titl='@CVR - Virksomheds ID. Tast CVR-nr. omsluttet af *, +, eller / for at importere data fra Erhvervsstyrelsen (Data leveres af CVR API)', $revi=true);
  htm_FrstFelt('50%');  htm_CombFelt($type='text',  $name='tlf',        $valu= $tlf,        $labl='@Telefon.',    $titl='@Tlf - Tast telefonnr. omsluttet af *, +, eller / for at importere data fra Erhvervsstyrelsen (Data leveres af CVR API)',              $revi=true);
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
  htm_CombFelt(                     $type='text',  $name='fi_nr',  $valu= $fi_nr,  $labl='@FI Kreditornr.',    $titl='@Bankernes fælles indbetalingskort (FI-kort). Her angiver du dit FI Kreditornr.',    $revi=true);
  htm_RudeBund($pmpt='@Gem',$subm=true);
}


# PROGRAM-MODUL;
function Rude_Ansat(
&$Medarbejdernr, &$bankkto, &$Navn, &$Initialer, &$Adresse, &$Adresse2, &$Postnr, &$By, &$Mail, &$Mobil, &$Lokalnr, &$Lokalfax, &$Privattlf, &$Bank, &$Løn, &$Løntillæg, &$Bemærkning, &$Tiltrådt, &$Fratrådt
) { 
  htm_Rude_Top($name='stamkort',$capt='@Ansat:',$parms='',$icon='fa-user',$klasse='panelW320',__FUNCTION__);
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
                          htm_CombFelt($type='area',  $name='Bemærkning',   $valu= $Bemærkning, $labl='@Bemærkning',$titl='@Bemærkning',  $revi=true);
  htm_FrstFelt('50%');    htm_CombFelt($type='date',  $name='Tiltrådt',     $valu= $Tiltrådt,   $labl='@Tiltrådt',  $titl='@Tiltrådt',    $revi=true);
  htm_NextFelt('50%');    htm_CombFelt($type='date',  $name='Fratrådt',     $valu= $Fratrådt,   $labl='@Fratrådt',  $titl='@Fratrådt',    $revi=true);
  htm_lastFelt();
  htm_RudeBund($pmpt='@Gem',$subm=true);
}


# PROGRAM-MODUL;
function Rude_Brugere(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) { global $ØtblRowDrk, $ØtblRowLgt;
  function TblRow($span1,$Txt1,$repe,$span2,$Txt2){ global $ØtblRowDrk, $ØtblRowLgt;
    echo '<tr><td colspan= '.$span1.' align=right> <u>'.tolk($Txt1).'</u> &nbsp;</td>';
    Veksle($from=$span1, $to=$repe+$span1-1, $krit='11111111111111111111', $doOdd='', $doEven='">|'); //  echo str_repeat('<td style="text-align:center; background:'.$ØtblRowDrk.';">|</td>',$repe);
    echo '<td colspan='.$span2.'> &nbsp;&nbsp;<u>'. tolk($Txt2).'</u></td></tr>'; 
  }

  function UserRett($ix,$row,$name){
    if (substr($row[rettigheder], $ix,1)==0) {echo '<td><input class="inputbox" type=checkbox name='.$name.' title='.$name.'></td>';}     
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
  htm_Rude_Top($name='brugkort',$capt='@Bruger rettigheder:',$parms='',$icon='fa-user',$klasse='panelW720',__FUNCTION__);
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
    if (true) echo '<tr><td align=center > '.$usr[0].'&nbsp;</td><td><axx href=brugere.php?ret_id='.$row[id].'> '.$usr[1].'</axx></td>';
    else      echo '<td align=center bgcolor="'.$colbg.'">*</td>';  
    Veksle($from=0, $to=15, $krit=$usr[2], $doOdd='', $doEven='color:green; font-weight:900;">√');
    echo '</tr>';
  }
  
  echo '<tr><td style="text-align:right"><colrlabl>'.tolk('@Opret ny bruger').':&nbsp;</colrlabl></td>';
  echo '<input type=hidden name=id value="'.$row[id].'">';
  echo '<input type=hidden name=random value='.'navn'.rand(100,999).'>';   #For at undgaa at browseren "husker" et forkert brugernavn.
  $row[brugernavn]= 'Maria';    
  echo '<td><input class="inputbox" type="text" size=12 name='.$tmp.' value="'.$row[brugernavn].'"></td>';
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

function Rude_Valuta(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {
  htm_Rude_Top($name= 'valuform',$capt= '@Valutaer: ',$parms='',$icon='fa-eur','panelW320',__FUNCTION__);
  htm_Caption('@Oprettede valutaer:');
  htm_Tabel($RowLabl='@Klik på valuta-koden, for at ændre denne valutas kurs',
            $ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
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
#  htm_CentrOn(); 
#    textKnap($label='@Opret ny valuta',  $title='@Klik her for at...',$link='../_base/page_Blindgyden.php');
#    textKnap($label='@Ordrebeholdning', $title='@Opslag - Se oversigt over ordrebeholdning',$link='../_base/page_Blindgyden.php');
#    textKnap($label='@Visning',         $title='@Visning - Vælg hvad der skal vises',$link='../_base/page_Blindgyden.php');
#  htm_CentOff();
  htm_nl();
  htm_RudeBund($pmpt='@Gem',$subm=true);
}

function Rude_Valutakort(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {
  htm_Rude_Top($name= 'kortform',$capt= '@Valuta ændringer: ',$parms='',$icon='fa-eur','panelW320',__FUNCTION__);
  $valuta= 'DKK';   $beskriv= 'Danske kroner';
  htm_Caption('@Vedligeholdese af:');
  echo ' '.$valuta.' - '.$beskriv;
  htm_Tabel($RowLabl='@Klik på valuta-koden for at se / rette valuta',
            $ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
              ['@Valør dato', '40%','', 'date',  'center',   '@Den dato kursen er gældende fra','@dato...'],
              ['@Ny kurs',    '30%','', 'text',  'center',   '@Værdien i DKK af 100 '.$valuta,'@kurs...'],
              ['@Konto',      '30%','', 'text',  'center', '@Kontonummer fra kontoplanen som skal bruges til valutakursdifferencer og øreafrunding...','@konto...'],
            ),
            $TablData= [['Dato','Kurs','konto'],['Dato','Kurs','konto'],['Dato','Kurs','konto'],['Dato','Kurs','konto'],['Dato','Kurs','konto'],['Dato','Kurs','konto'],
            ['Dato','Kurs','konto'],['Dato','Kurs','konto'],['Dato','Kurs','konto'],['Dato','Kurs','konto']],  # ImportTabFile('../_exchange/varer.tab'),  // Indlæs data fra TAB-fil
            $FilterOn=false, $SorterOn=true, $CreateRec=true, $ModifyRec=false, $ViewHeight='300px' );
#  htm_CentrOn(); 
#    textKnap($label='@Opret ny',        $title='@Klik her for at...',$link='../_base/page_Blindgyden.php');
#    textKnap($label='@Ordrebeholdning', $title='@Opslag - Se oversigt over ordrebeholdning',$link='../_base/page_Blindgyden.php');
#    textKnap($label='@Visning',         $title='@Visning - Vælg hvad der skal vises',$link='../_base/page_Blindgyden.php');
#  htm_CentOff(); 
  htm_RudeBund($pmpt='@Gem',$subm=true);
}

function Rude_Enheder(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {
  htm_Rude_Top($name= 'enhedform',$capt= '@Enheder og materialer: ',$parms='',$icon='fa-database','panelW320',__FUNCTION__);
  htm_TabelInp(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
    $HeadLine= array( [' ', '50%','left','show', '', '@Enhedsbetegnelser'] ),
    $RowHead= array(),  # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! ']
    $ColStyle= array( # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],
      ['@Enhed.',       '25%','', 'text','left',tolk('@Enhedsbetegnelse').' ','Enh...'],
      ['@Beskrivelse',  '75%','', 'text','left',tolk('@Beskrivelse af enheden'),'Beskr...'],
      ),
    $RowTail= array(),  # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:InpType', '4:FeltJust', '5:ColTip', '6:value! ']
        $data= array(1,2,3),  # Antal rows ved DEMO
        $ViewHeight= '500px',
        $PadTop='0px'
  );
  htm_TabelInp(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
    $HeadLine= array( [' ', '50%','left','show', '', '@Materiale egenskaber'] ),
    $RowHead= array(),  # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! ']
    $ColStyle= array( # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],
      ['@Materiale.', '75%','', 'text','left',tolk('@Materiale'),'Matr...'],
      ['@Densitet',   '25%','', 'text','left',tolk('@Materialets massefylde'),'Dens...'],
      ),
    $RowTail= array(),  # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:InpType', '4:FeltJust', '5:ColTip', '6:value! ']
        $data= array(1,2,3),  # Antal rows ved DEMO
        $ViewHeight= '500px',
        $PadTop='0px'
  );
### PanelFooter:
#+  NaviTip();
  htm_RudeBund($pmpt='@Gem',$subm=true);
}

function Rude_Beholdningsrapp() {
  htm_Rude_Top($name= 'behlform',$capt= '@Varerapport:',$parms='../_base/page_Gittermenu.php',$icon='fa-database','panelW320',__FUNCTION__);
    htm_FrstFelt('04%',0); 
    htm_NextFelt('36%');  echo '<p align="center">'.tolk('@Angiv kriterier:').'</p> ';
    htm_NextFelt('02%');  
    htm_NextFelt('58%'); # htm_CheckFlt($type='checkbox',$name='somfakt',$valu='somfakt',
                         # $labl='@Husk dem', $titl='@Afmærk her, hvis kriterier skal genbruges.',  $revi=true);
    htm_NextFelt('05%');
    htm_LastFelt();
    htm_OptioFlt($type='text',  $name='varegrp',    $valu= $varegrp,  
                    $labl='@Varegruppe',         
                    $titl='@Vælg den Varegruppe du ønsker at få oplysninger om.',  
                    $revi=true, $optlist= [['@Alle ',         '0','@0. Alle',''],
                                           ['@Ydelser ',      '1','@1. Ydelser',''],
                                           ['@Handelsvarer',  '2','@2. Handelsvarer',''],
                                           ['@Forbrugsvarer', '3','@3. Forbrugsvarer',''],
                                           ['@Fragt/Porto',   '4','@4. Fragt/Porto','']],  //  [0:Tip, 1:value, 2:Label, 3:Action]
                    $action='');
    htm_OptioFlt($type='text',  $name='afdel',    $valu= $afdel,  
                    $labl='@Afdeling',         
                    $titl='@Vælg den Afdeling du ønsker at få oplysninger om.',  
                    $revi=true, $optlist= [['@Alle ',         '0','@0. Forretning',''],
                                           ['@Ydelser ',      '1','@1. Lager 1',''],
                                           ['@Handelsvarer',  '2','@2. Lager 2','']],
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
  htm_CentrOn(); 
    textKnap($label='@Vis det valgte',  $title='@Vis varer, som opfylder de kriterier, du har angivet ovenfor', $link='../_base/page_Blindgyden.php').'<hr>';
  htm_CentOff();
  str_hr();
  htm_CentrOn(); 
    textKnap($label='@Lagerstatus',     $title='@Se lagerstatus på en vilkårlig dato',                $link='../_base/page_Blindgyden.php').'<hr>';
    textKnap($label='@Lageroptælling',  $title='@Funktion til optælling og regulering af varelager',  $link='../_base/page_Blindgyden.php').'<hr>';
  htm_CentOff();
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true);
}

function Rude_Beholdningsliste() {
  htm_Rude_Top($name= 'behlform',$capt= '@Beholdningsliste:',$parms='../_base/page_Gittermenu.php',$icon='fa-database','panelW640',__FUNCTION__);
  htm_CentrOn(); 
    echo tolk('@Vælg kriterier i vinduet til venstre, og få vist resultatet her.'),'<br><br>';
  htm_CentOff();
  htm_RudeBund($pmpt='@Gem',$subm=false);
}

# PROGRAM-MODUL;
function Rude_Rabatgrupper($vg_antal=4, $vrg_antal=true, $dg_antal=3, $drg_antal=true/* DEMO  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {
  htm_Rude_Top($name= 'rabbform',$capt= '@Rabatgrupper:',$parms='../_base/page_Gittermenu.php',$icon='fa-database','panelW640',__FUNCTION__);
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

function Rude_Varegrupper(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {
  htm_Rude_Top($name= 'systform',$capt= '@Varegrupper:',$parms='../_base/page_Gittermenu.php',$icon='fa-database','panelW960',__FUNCTION__);
  #-  echo '<div style="text-align:center"><colrlabl>Varegrupper</colrlabl></div>';
  htm_CentHead('Varegrupper-konti');
  
  htm_TabelInp(
    $HeadLine= array(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      ['@Tabel &nbsp; ', '20%','left','text', '@Varegrupper', '@Varegrupper'], 
//     ['@Konto-kontrol:','5em','left','text', '@Angiv kontonummer for den konto, hvis bevægelser skal kontrolleres',  '@Nummer...'], 
    ),
    $RowHead= array( #  ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! ']  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
       #   ['',     '3%','center','text','D',tolk('@Medlem af debitorgruppe'),'']
          ),
    $ColStyle= array( # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],
      ['@Nr',               '3%','','data', 'center', '@Gruppe nummer'.' ','.?.'],
      ['@Beskrivelse',     '17%','','data', 'left',   '@Beskrivelse af gruppen','@Besk...'],
      ['@Lager-tilgang',    '6%','','data', 'center', '@Konto for...','@Tilg...'],
      ['@Lager-træk',       '6%','','data', 'center', '@Konto for...','@Træk..'],
      ['@Vare-køb',         '6%','','data', 'center', '@Konto for...','@Køb..'],
      ['@Vare-salg',        '6%','','data', 'center', '@Konto for...','@Salg..'],
      ['@Lager-regulering', '6%','','data', 'center', '@Konto for...','@Regu..'],
      ['@Køb i EU',         '6%','','data', 'center', '@Konto for...','@Køb..'],
      ['@Salg til EU',      '6%','','data', 'center', '@Konto for...','@Salg..'],
      ['@Køb uden for EU',  '8%','','data', 'center', '@Konto for...','@Køb..'],
      ['@Salg uden for EU', '8%','','data', 'center', '@Konto for...','@Salg..'],
      ),
$RowTail= array(  # ['0:ColLabl', '1:ColWidth', '2:disp!', '3:InpType', '4:FeltJust', '5:ColTip', '6:value!']
       ['@Omvendt betaling', '6%', '','text','center',  '@Omvendt betaligspligt! Afmærk her, hvis denne kundegruppe er omfattet af omvendt betalingspligt.','<a hrefxxx='.$link.' ><input type= "checkbox" name="bold" value="" ></a>','.?.'],
       ['@Moms fri',         '6%', '','text','center',  '@Moms fri. Afmærk her, hvis ....','<a hrefxxx='.$link.' ><input type= "checkbox" name="bold" value="" ></a>','.?.'],
       ['@Lager ført',       '6%', '','text','center',  '@Lager ført. Afmærk her, hvis ...','<a hrefxxx='.$link.' ><input type= "checkbox" name="bold" value="" ></a>','.?.'],
       ['@Batch kontrol',    '6%', '','text','center',  '@Batch kontrol. Afmærk her, hvis ..','<a hrefxxx='.$link.' ><input type= "checkbox" name="bold" value="" ></a>','.?.'],
       ['@Opera -tion',       '6%', '','text','center',  '@Operation. Afmærk her, hvis ..','<a hrefxxx='.$link.' ><input type= "checkbox" name="italic" value="" ></a>','.?.'],
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
  #-  echo '<div style="text-align:center"><colrlabl>Vare-Prisgrupper</colrlabl></div>';
  htm_CentHead('Vare-Prisgrupper');
    htm_TabelInp(
    $HeadLine= array(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      ['@Tabel  &nbsp; ', '20%','left','text', '@Prisgrupper', '@Prisgrupper'], 
    ),
    $RowHead= array( #  ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! ']  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
          ),
    $ColStyle= array( # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],
      ['@Nr',            '3%','','data', 'center', '@Gruppe nummer'.' ','.?.'],
      ['@Beskrivelse',  '15%','','data', 'left',   '@Beskrivelse af gruppen','@Besk...'],
      ['@Kost-pris',     '6%','','data', 'center', '@Konto for...','@Kost...'],
      ['@Salgs-pris',    '6%','','data', 'center', '@Konto for...','@Salgs..'],
      ['@Vejl.-pris',    '6%','','data', 'center', '@Konto for...','@Vejl..'],
      ['@B2B-pris',      '6%','','data', 'center', '@Konto for...','@B2B..'],
      ),
$RowTail= array(  # ['0:ColLabl', '1:ColWidth', '2:disp!', '3:InpType', '4:FeltJust', '5:ColTip', '6:value!']
       ['',         '30%', '','text','center',  '','','.?.'],
     ), 
              $data= array(
              [[''],[''],[''],[''],[''],[''],[''],[''],[''],[''],['']],
              ),  #  DEMOdata
      $ViewHeight= '',
      $PadTop= '0px'
  );
  str_nl();
  #-  echo '<div style="text-align:center"><colrlabl>Vare-Tilbudsgrupper</colrlabl></div>';
  htm_CentHead('Vare-Tilbudsgrupper');
  
    htm_TabelInp(
    $HeadLine= array(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      ['@Tabel  &nbsp; ', '20%','left','text', '@Tilbudsgrupper', '@Tilbudsgrupper'], 
    ),
    $RowHead= array( #  ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! ']  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
          ),
    $ColStyle= array( # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],
      ['@Nr',            '3%','','data', 'center', '@Gruppe nummer'.' ', '.?.'],
      ['@Beskrivelse',  '15%','','data', 'left',   '@Beskrivelse af gruppen', '@Besk...'],
      ['@Kost-pris',     '6%','','data', 'center', '@Konto for...', '@Kost...'],
      ['@Salgs-pris',    '6%','','data', 'center', '@Konto for...', '@Salgs..'],
      ['@Start-dato',    '6%','','data', 'center', '@Konto for...', '@Strt..'],
      ['@Slut-dato',     '6%','','data', 'center', '@Konto for...', '@Slut..'],
      ),
$RowTail= array(  # ['0:ColLabl', '1:ColWidth', '2:disp!', '3:InpType', '4:FeltJust', '5:ColTip', '6:value!']
       ['',         '30%', '','text','center',  '','','.?.'],
     ), 
              $data= array(
              [[''],[''],[''],[''],[''],[''],[''],[''],[''],[''],['']],
              ),  #  DEMOdata
      $ViewHeight= '',
      $PadTop= '0px'
  );
  str_nl();
  #-  echo '<div style="text-align:center"><colrlabl>Vare-Rabatgrupper</colrlabl></div>';
  htm_CentHead('Vare-Rabatgrupper');
  
    htm_TabelInp(
    $HeadLine= array(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      ['@Tabel  &nbsp; ', '20%','left','text', '@Rabatgrupper', '@Rabatgrupper'], 
    ),
    $RowHead= array( #  ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! ']  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
          ),
    $ColStyle= array( # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],
      ['@Nr',            '3%','','data', 'center', '@Gruppe nummer'.' ','.?.'],
      ['@Beskrivelse',  '15%','','data', 'left',   '@Beskrivelse af gruppen','@Besk...'],
      ['@Type',          '6%','','data', 'center', '@Konto for...','@Typ...'],
      ['@Stk. rabat',    '6%','','data', 'center', '@Konto for...','@Rabt..'],
      ['@ved antal',      '6%','','data', 'center', '@Konto for...','@Antl..'],
       ),
$RowTail= array(  # ['0:ColLabl', '1:ColWidth', '2:disp!', '3:InpType', '4:FeltJust', '5:ColTip', '6:value!']
       ['',         '30%', '','text','center',  '','','.?.'],
     ), 
              $data= array(
              [[''],[''],[''],[''],[''],[''],[''],[''],[''],[''],['']],
              ),  #  DEMOdata
      $ViewHeight= '',
      $PadTop= '0px'
  );
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem, hvis du har ændret noget ovenfor.');
}

function Rude_DefKredGrp(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {
  htm_Rude_Top($name= 'grupform',$capt= '@Debitor- & Kreditor-grupper:',$parms='../_base/page_Gittermenu.php',$icon='fa-database','panelW960',__FUNCTION__,$more=' style= "height:400px" ');
  echo textKnap($label='@INFO', $title='@Her er lidt forklaring omkring brugen af grupper.', $link= '../_base/page_GruppeInfo.php');
  htm_TabelInp(
    $HeadLine= array(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      ['@Tabel  &nbsp; ', '20%','left','text', '@Debitorgrupper', '@Debitorgrupper'], 
//     ['@Konto-kontrol:','5em','left','text', '@Angiv kontonummer for den konto, hvis bevægelser skal kontrolleres',  '@Nummer...'], 
    ),
    $RowHead= array( #  ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! ']  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
          ['',     '3%','center','text','D',tolk('@Medlem af debitorgruppe'),'']
          ),
    $ColStyle= array( # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],
      ['@Nr',          '3%','','data', 'center', '@Gruppe nummer'.' ','...auto...'],
      ['@Beskrivelse','30%','','data', 'left',   '@Beskrivelse af gruppen','Besk...'],
      ['@Momsgrp',     '8%','','data', 'center', '@Momsgruppe som debitorgruppen skal tilknyttes.',tolk('@Momsgr...')],
      ['@Samlekt.',    '8%','','data', 'center', '@Samlekonto for debitorgruppen','S-kt..'],
      ['@Valuta',      '8%','','data', 'center', '@Den valuta som gruppen føres i','Valu..'],
      ['@Sprog',       '8%','','data', 'center', '@Det sprog der skal anvendes ved fakturering','Spr..'],
      ['@Modkonto',    '8%','','data', 'center', '@Modkonto ved udligning af åbne poster','M-kt...'],
      ['@Provision',   '8%','','data', 'right',  '@Provisionsprocent! Her angives hvor stor en procentdel af dækningsbidraget der medgår ved beregning af provision.','Pro...'],
      ),
$RowTail= array(  # ['0:ColLabl', '1:ColWidth', '2:disp!', '3:InpType', '4:FeltJust', '5:ColTip', '6:value!']
        ['@OB',      '5%', '','text','center',  '@Omvendt betaligspligt! Afmærk her, hvis denne kundegruppe er omfattet af omvendt betalingspligt.','<a hrefxxx='.$link.' ><input type= "checkbox" name="bold" value="" ></a>','.?.'],
        ['@B2B',     '5%', '','text','center',  '@Business to business! Afmærk her, hvis der skal anvendes b2b priser ved salg til denne kundegruppe.','<a hrefxxx='.$link.' ><input type= "checkbox" name="italic" value="" ></a>','.?.'],
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
//     ['@Konto-kontrol:','5em','left','text', '@Angiv kontonummer for den konto, hvis bevægelser skal kontrolleres',  '@Nummer...'], 
    ),
    $RowHead= array( #  ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! ']  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
          ['',     '3%','center','text','K',tolk('@Medlem af kreditorgruppe'),'']
          ),
    $ColStyle= array( # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],
      ['@Nr',          '3%','','data', 'center', '@Gruppe nummer'.' ','...auto...'],
      ['@Beskrivelse','30%','','data', 'left',   '@Beskrivelse af gruppen','Besk...'],
      ['@Momsgrp',     '8%','','data', 'center', '@Momsgruppe som kreditorgruppen skal tilknyttes.',tolk('@Momsgr...')],
      ['@Samlekt.',    '8%','','data', 'center', '@Samlekonto for kreditorgruppen','S-kt..'],
      ['@Valuta',      '8%','','data', 'center', '@Den valuta som gruppen føres i','Valu..'],
      ['@Sprog',       '8%','','data', 'center', '@Det sprog der skal anvendes ved kommunikation med kreditoren','Spr..'],
      ['@Modkonto',    '8%','','data', 'center', '@Modkonto ved udligning af åbne poster','M-kt...'],
      ['@S.moms grp',  '8%','','data', 'center', '@Momsgruppe for salgsmoms ved omvendt betalingspligt.','M-grp...'],
      ),
    $RowTail= array(  # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:InpType', '4:FeltJust', '5:ColTip', '6:value! ']
      ['@OB',          '5%','','text',  'center', '@Omvendt betaligspligt! Afmærk her, hvis denne leverandørgruppe er omfattet af omvendt betalingspligt.','<a hrefxxx='.$link.' ><input type= "checkbox" name="bold" value="" ></a>','.?.'],
      ['',             '5%','','tal2d', 'right' , '@Business to business! Afmærk her, hvis der skal anvendes b2b priser ved salg til denne leverandørgruppe.'],
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

  
function Rude_Syssetup() {
  htm_Rude_Top($name= 'systform',$capt= '@Varegrupper:',$parms='../_base/page_Gittermenu.php',$icon='fa-database','panelW960',__FUNCTION__);
  $spantekst1= tolk('@En beskrivende tekst efter eget valg');
	$spantekst2= tolk('@Det nummer i kontoplanen som salgsmomsen skal konteres p&aring;.');
	$spantekst3= tolk('@Moms %.');

  htm_RudeBund($pmpt='@Gem',$subm=true);
}

# PROGRAM-MODUL;
function Rude_Varer(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {
  htm_Rude_Top($name= 'vareform',$capt= '@Vareliste:',$parms='../_base/page_Gittermenu.php',$icon='fa-database','panelWmax',__FUNCTION__);
  htm_Tabel($RowLabl='@Klik på vare-nummeret for at se varekort for dette produkt',
            $ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
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
            $TablData= ImportTabFile('../_exchange/varer.tab',1),  // Indlæs data fra TAB-fil
            $FilterOn=true, $SorterOn=true, $CreateRec=true, $ModifyRec=true, $ViewHeight='200px' );
  htm_CentrOn(); htm_nl();
    textKnap($label='@Ny vare',         $title='@Klik her for at oprette en ny vareregistrering',$link='../_base/page_Blindgyden.php');
    textKnap($label='@Indkøbsforslag',  $title='@Klik her for at lave et indkøbsforslag',$link='../_base/page_Blindgyden.php');
    textKnap($label='@Ordrebeholdning', $title='@Opslag - Se oversigt over ordrebeholdning',$link='../_base/page_Blindgyden.php');
    textKnap($label='@Visning',         $title='@Visning - Vælg hvad der skal vises',$link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
}


# PROGRAM-MODUL;
function Rude_Varekort(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) 
{global $Ønovice;
  htm_Rude_Top($name= 'varekortform',$capt= '@Varekort:',$parms='',$icon='fa-pencil-square-o','panelW960',__FUNCTION__,$more=' style= "height:1300px" ');
  SpalteTop(960); # 0. spalte
  htm_CentrOn(); 
    textKnap($label='@<= Se forrige',   $title='@Klik her vise forrige varenummer',$link='../_base/page_Blindgyden.php');
    textKnap($label='@Se næste =>',     $title='@Klik her vise næste varenummer',$link='../_base/page_Blindgyden.php');
  htm_CentOff();
  SpalteBund(); # 0. spalte
  
  SpalteTop(320); # 1. spalte
  htm_Rude_Top($name= 'varekortform1',$capt= '@Generelt:',$parms='',$icon='fa-pencil-square-o','panelW320',__FUNCTION__);
  htm_CombFelt($type='text',  $name='genlbesk', $valu= $genlbesk,   $labl='@Beskrivelse', $titl='@Angiv en tekst der beskriver produktet',   $revi=true, $rows='2',$width='',$step='', $more='required="required"', $plho=tolk('@Beskrivelse...'));
  htm_CombFelt($type='text',  $name='genlmark', $valu= $genlmark,   $labl='@Varemærke',   $titl='@Angiv en tekst der beskriver varemærket',  $revi=true, $rows='2',$width='',$step='' );
  htm_FrstFelt('50%');    htm_CombFelt($type='text',  $name='genlstrg', $valu= $genlstrg, $labl='@Stregkode', $titl='@Angiv en tekst, som skal benyttes som stregkode', $revi=true, $rows='2',$width='',$step='' );
  htm_NextFelt('50%');    htm_CombFelt($type='text',  $name='genlkode', $valu= $genlkode, $labl='',           $titl='@Her vises stregkoden', $revi=true, $rows='2',$width='',$step='', $more='', $plho='--STREGKODE-- vises her.');
  htm_lastFelt(); 
  htm_RudeBund($pmpt='@Gem',$subm=true);
  NextSpalte(320);
  htm_Rude_Top($name= 'varekortform1',$capt= '@Iøvrigt:',$parms='',$icon='fa-pencil-square-o','panelW320',__FUNCTION__);
  htm_CombFelt($type='area',$name='noter',$valu= $noter,        $labl='@Bemærkning',    $titl='@Angiv Bemærkninger',  $revi=true, $rows='2');
  htm_nl();
  htm_FrstFelt('30%');    htm_CheckFlt($type='checkbox',$name='serinr', $valu= $serinr, $labl='@Serienr',   $titl='@Serienr',  $revi=false, $more=' '.$pg);
  htm_NextFelt('40%');    htm_CheckFlt($type='checkbox',$name='samlev', $valu= $samlev, $labl='@Samlevare', $titl='@Afmærk her hvis varen er en samlevare. Feltet er låst, hvis beholdningen er forskellig fra 0 eller varen indgår i en uafsluttet ordre',       $revi=false, $more=' '.$pg);
  htm_NextFelt('30%');    htm_CheckFlt($type='checkbox',$name='udgaa',  $valu= $udgaa,  $labl='@Udgået',    $titl='@Produktet er udgået, og kan ikke bestilles',      $revi=false, $more=' '.$pg);
  htm_lastFelt(); 
  htm_RudeBund($pmpt='@Gem',$subm=true);
  SpalteBund(); # 1. spalte
  
  SpalteTop(240); # 2. spalte
  htm_Rude_Top($name= 'varekortform1',$capt= '@Enheds Priser:',$parms='',$icon='fa-pencil-square-o','panelW240',__FUNCTION__);
  /* echo 'Pr. Enhed:'; */
  htm_CombFelt($type='tal2dc',  $name='enhdpris', $valu= $enhdpris,   $labl='@Salgspris',        $titl='@Netto almindelig salgspris', $revi=true, $rows='2',$width='',$step='');
  htm_CombFelt($type='tal2dc',  $name='enhdengr', $valu= $enhdengr,   $labl='@B2B salgspris',    $titl='@Engros salgspris', $revi=true, $rows='2',$width='',$step='' );
  htm_CombFelt($type='tal2dc',  $name='enhdlist', $valu= $enhdlist,   $labl='@Vejledende pris',  $titl='@Listepris', $revi=true, $rows='2',$width='',$step='' );
  htm_CombFelt($type='tal2dc',  $name='enhdansk', $valu= $enhdansk,   $labl='@Kostpris',         $titl='@Anskaffelses pris', $revi=true, $rows='2',$width='',$step='' );
  htm_RudeBund($pmpt='@Gem',$subm=true);
  
  htm_Rude_Top($name= 'varekortform1',$capt= '@Tilbud:',$parms='',$icon='fa-pencil-square-o','panelW240',__FUNCTION__);
  htm_CombFelt($type='tal2dc',  $name='tilbpris', $valu= $tilbpris, $labl='@Salgspris',  $titl='@Angiv enheds Salgsprisen',                     $revi=true, $rows='2',$width='',$step='');
  htm_CombFelt($type='tal2dc',  $name='tilbkost', $valu= $tilbkost, $labl='@Kostpris',   $titl='@Angiv enheds Kostprisen',                      $revi=true, $rows='2',$width='',$step='' );
  htm_FrstFelt('50%');    
  htm_CombFelt($type='date',    $name='tilbstrt', $valu= $tilbstrt, $labl='@Dato start', $titl='@Angiv start-dato for tilbudsperioen (incl.)',  $revi=true, $rows='2',$width='',$step='' );
  htm_NextFelt('50%');
  htm_CombFelt($type='date',    $name='tilbslut', $valu= $tilbslut, $labl='@Dato slut',  $titl='@Angiv slut-dato for tilbudsperioen (incl.)',   $revi=true, $rows='2',$width='',$step='' );
  htm_lastFelt(); 
  htm_RudeBund($pmpt='@Gem',$subm=true);
    
  htm_Rude_Top($name= 'varekortform1',$capt= '@Mængederabatter:',$parms='',$icon='fa-pencil-square-o','panelW240',__FUNCTION__);
  htm_OptioFlt($type='text',  $name='enhed0',    $valu= $enhed0,  
                    $labl='@Rabat metode',         
                    $titl='@Vælg den enhed du ønsker at bruge.',  
                    $revi=true, $optlist= array(
                    ['','%','%'],
                    ['','Kr.','Kr.']),$action='');
  htm_FrstFelt('50%');    htm_CombFelt($type='tal2dc',  $name='stkrabat', $valu= $stkrabat,   $labl='@Stk. rabat ved antal',  $titl='@Minimumsmængde for at yde mængderabat', $revi=true, $rows='2',$width='',$step='', $more='', $plho=tolk('@Antal...'));
  htm_NextFelt('50%');    htm_CombFelt($type='tal2dc',  $name='antrabat', $valu= $antrabat,   $labl='@%- rabat ved antal',    $titl='@Minimumsmængde for at yde procent rabat', $revi=true, $rows='2',$width='',$step='', $more='', $plho=tolk('@Antal...'));
  htm_lastFelt(); 
  htm_RudeBund($pmpt='@Gem',$subm=true);
  
  htm_Rude_Top($name= 'varekortform1',$capt= '@Colli:',$parms='',$icon='fa-pencil-square-o','panelW240',__FUNCTION__);
  htm_CombFelt($type='text',    $name='collsize', $valu= $collsize, $labl='@Størrelse',        $titl='@Angiv en tekst der beskriver dimensionerne',       $revi=true, $rows='2',$width='',$step='');
  htm_CombFelt($type='text',    $name='collydre', $valu= $collydre, $labl='@Ydre størrelse',   $titl='@Angiv en tekst der beskriver de ydre dimensioner', $revi=true, $rows='2',$width='',$step='' );
  htm_CombFelt($type='tal2dc',  $name='collanbr', $valu= $collanbr, $labl='@Anbruds kostpris', $titl='@Angiv et beløb der beskriver anbruds kostprisen',  $revi=true, $rows='2',$width='',$step='' );
  htm_CombFelt($type='tal2dc',  $name='collkost', $valu= $collkost, $labl='@Kostpris',         $titl='@Angiv et beløb der beskriver kostprisen',          $revi=true, $rows='2',$width='',$step='' );
  htm_RudeBund($pmpt='@Gem',$subm=true);
  
  NextSpalte(320); # 2. spalte
 
  htm_Rude_Top($name= 'varekortform1',$capt= '@Enheder:',$parms='',$icon='fa-pencil-square-o','panelW240',__FUNCTION__);
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
  htm_CombFelt($type='text',    $name='enhdindh', $valu= $enhdindh,   $labl='@Indhold/enhed',  $titl='@Angiv en tekst der beskriver indholdet pr. enhed', $revi=true, $rows='2',$width='',$step='' );
  htm_CombFelt($type='tal2dc',  $name='enhdpris', $valu= $enhdpris,   $labl='@Pris/enhed',     $titl='@Angiv et beløb der beskriver prisen pr. enhde', $revi=true, $rows='2',$width='',$step='' );
  htm_RudeBund($pmpt='@Gem',$subm=true);
 
  htm_Rude_Top($name= 'varekortform1',$capt= '@Beholdning:',$parms='',$icon='fa-pencil-square-o','panelW240',__FUNCTION__);
  htm_CombFelt($type='text',  $name='behlloka', $valu= $behlloka,   $labl='@Lokation',  $titl='@Angiv en tekst der beskriver lokation for varen', $revi=true, $rows='2',$width='',$step='', $more='', $plho=tolk('@Lok...'));
  htm_CombFelt($type='text',  $name='behlfolg', $valu= $behlfolg,   $labl='@Følgevare', $titl='@Angiv en tekst der beskriver følgevare', $revi=true, $rows='2',$width='',$step='', $more='', $plho=tolk('@Følg...'));
  htm_FrstFelt('25%');    echo tolk('@Behold.:');
  htm_NextFelt('25%');    htm_CombFelt($type='tal1d',  $name='regn', $valu= $regnskab,  $labl='@Min.',   $titl='@Angiv ', $revi=true, $rows='2',$width='',$step='' );
  htm_NextFelt('25%');    htm_CombFelt($type='tal1d',  $name='regn', $valu= $regnskab,  $labl='@Max.',   $titl='@Angiv ', $revi=true, $rows='2',$width='',$step='' );
  htm_NextFelt('25%');    htm_CombFelt($type='tal1d',  $name='regn', $valu= $regnskab,  $labl='@Aktuel', $titl='@Angiv ', $revi=true, $rows='2',$width='',$step='' );
  htm_lastFelt(); 
  htm_RudeBund($pmpt='@Gem',$subm=true);
  
  htm_Rude_Top($name= 'varekortform1',$capt= '@Grupper:',$parms='',$icon='fa-pencil-square-o','panelW240',__FUNCTION__);
  htm_OptioFlt($type='text',  $name='enhed0',    $valu= $enhed0,  
                    $labl='@Varegruppe',         
                    $titl='@Vælg den enhed du ønsker at bruge.',  
                    $revi=true, $optlist= array(
                    ['','Stk','Stk'],
                    ['','Palle','Palle']),$action='');
  htm_OptioFlt($type='text',  $name='enhed0',    $valu= $enhed0,  
                    $labl='@Prisgruppe',         
                    $titl='@Vælg den enhed du ønsker at bruge.',  
                    $revi=true, $optlist= array(
                    ['','Stk','Stk'],
                    ['','Palle','Palle']),$action='');
  htm_OptioFlt($type='text',  $name='enhed0',    $valu= $enhed0,  
                    $labl='@Tilbudsgruppe',         
                    $titl='@Vælg den enhed du ønsker at bruge.',  
                    $revi=true, $optlist= array(
                    ['','Stk','Stk'],
                    ['','Palle','Palle']),$action='');
  htm_OptioFlt($type='text',  $name='enhed0',    $valu= $enhed0,  
                    $labl='@Rabatgruppe',         
                    $titl='@Vælg den enhed du ønsker at bruge.',  
                    $revi=true, $optlist= array(
                    ['','Stk','Stk'],
                    ['','Palle','Palle']),$action='');
  htm_RudeBund($pmpt='@Gem',$subm=true);
  
  NextSpalte(320); # 3. spalte
 
  htm_Rude_Top($name= 'varekortform1',$capt= '@Kategorier:',$parms='',$icon='fa-pencil-square-o','panelW320',__FUNCTION__,$more=' style= "height:280px" ');
  htm_CombFelt($type='text',  $name='regn', $valu= $regnskab,     $labl='@Opret ny',         $titl=tolk('@Opret en ny kategori: Skriv navnet på kategorien her.').'<br>'.
  tolk('@For at oprette en underkategori skrives id på den overstående kategori foran navnet med | som adskillelse, f.eks 31|Herresokker.').'<br>'.
  tolk('@Id findes ved at holde musen over kategoriens navn.'), 
        $revi=true, $rows='2',$width='',$step='', $more='', $plho=tolk('@Angiv evt. navn på en ny vare kategori...'));
  htm_TabelInp(
    $HeadLine= array(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      ['@Tabel  &nbsp; ', '25%','left','text', '@Produkt kategorier', '@Kategori'], 
    ),
    $RowHead= array( #  ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! ']  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
          ),
    $ColStyle= array( # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],
    //  ['@Id',         '6%','','data', 'center', '@Id nummer'.' ','.?.'],
      ['@Beskrivelse',  '70%','','data', 'left',   '@Beskrivelse af kategorien','@Besk...'],
       ),
    $RowTail= array(  # ['0:ColLabl', '1:ColWidth', '2:disp!', '3:InpType', '4:FeltJust', '5:ColTip', '6:value!']
      ['@Tilknyt',      '10%','','data', 'center', '@Sæt flueben her for at knytte $firmanavn til denne kategori','<input type="checkbox" name="kat_valg[$d]" $checked>'],
      ['@Omdøb',        '10%','','data', 'center', '@Klik på grønt kryds for at omdøbe kategorien','<a href="varekort.php?id=$id&rename_category=$kat_id[$d]" onclick="return confirm("Vil du omdøbe denne kategori?")"><img src=../_assets/icons/rename.png border=0></a>'],
      ['@Slet',         '10%','','data', 'center', '@Klik på rødt kryds for at slette kategorien','<a href="varekort.php?id=$id&delete_category=$kat_id[$d]" onclick="return confirm("Vil du slette denne katagori?")"><img src=../_assets/icons/delete.png border=0></a>'],
     ), 
              $data= array(
              [[''],[''],[''],['']],
              [[''],[''],[''],['']],
              [[''],[''],[''],['']],
              ),  #  DEMOdata
      $ViewHeight= '',
      $PadTop= '0px'
  );
  htm_RudeBund($pmpt='@Gem',$subm=true);
 
  htm_Rude_Top($name= 'varekortform1',$capt= '@Varianter:',$parms='',$icon='fa-pencil-square-o','panelW320',__FUNCTION__,$more=' style= "height:250px" ');
//  $temp= $Ønovice;  $Ønovice= false;
  htm_TabelInp(
    $HeadLine= array(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      ['@Tabel  &nbsp; ', '25%','left','text', '@Produkt varianter', '@Varianter'], 
    ),
    $RowHead= array( #  ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! ']  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
          ),
    $ColStyle= array( # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],
    //  ['@Id',         '6%','','data', 'center', '@Id nummer'.' ','.?.'],
      ['@Beskriv.',  '40%','','data', 'left',   '@Beskrivelse af varianten','@Besk...'],
      ['@Stregkd.',  '20%','','data', 'center', '@Variantens stregkode','@Kode...'],
      ['@Beholdning','14%','','data', 'center', '@Lager beholdning af varianten','@Beh..'],
       ),
    $RowTail= array(  # ['0:ColLabl', '1:ColWidth', '2:disp!', '3:InpType', '4:FeltJust', '5:ColTip', '6:value!']
       ['@Slet',       '10%', '','text','center','@Klik på rødt kryds for at slette denne variant fra listen?','<img src=../_assets/icons/delete.png border=0>'],
     ), 
              $data= array(
              [[''],[''],[''],['']],
              [[''],[''],[''],['']],
              [[''],[''],[''],['']],
              ),  #  DEMOdata
      $ViewHeight= '500px',
      $PadTop= '0px'
  );
//  $Ønovice= $temp;
  //htm_nl();
  htm_RudeBund($pmpt='@Gem',$subm=true); 

  SpalteBund(); # 3. spalte
  htm_hr();
  htm_CentrOn();
    textKnap($label='@Ny Modtage liste',  $title='@Klik her for at oprette en ny modtagelse',$link='../_lager/page_Varemodtagelse.php');
    textKnap($label='@Leverandøropslag',  $title='@Opslag - Se ...',$link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_RudeBund($pmpt='@Retur til vareliste',$subm=true,$title='@Retur til vareliste');
}

function Rude_Varemodtagelse(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {
  htm_Rude_Top($name= 'varemodtform',$capt= '@Vare modtagelse:',$parms='../_base/page_Gittermenu.php',$icon='fa-pencil-square-o','panelWmax',__FUNCTION__);
  htm_Tabel($RowLabl='@Klik på vare-nummeret for at se listens indhold',
            $ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
              ['@Id.',            '8%','','text',  'left',   '@Entydig nummerkode..','@Id...'],
              ['@Dato',          '12%','','date',  'left',   '@Listens oprettelsesdato','@Dato...'],
              ['@Oprettet af',   '15%','','text',  'left',   '@Initialer for den som har oprettet listen','@Opret...'],
              ['@Bemærkning',    '30%','','text',  'left',   '@Tilknyttet note','@Bem...'],
              ['@Modtaget af',   '15%','','text',  'left',   '@Initialer for den som har modtaget varerne','@Modt...'],
              ['@Modtaget dato', '10%','','date',  'left',   '@Modtagelses datoen','@Dato...'],
              ),
            #$TablData= ImportTabFile('../_exchange/varer.tab'),  // Indlæs data fra TAB-fil
            $TablData= [[1,'Dato','Oprettet','Bemærkning','Modtaget','Modtaget'],[2,'Dato','Oprettet','Bemærkning','Modtaget','Modtaget'],
                        [3,'Dato','Oprettet','Bemærkning','Modtaget','Modtaget']], 
            $FilterOn=true, $SorterOn=true, $CreateRec=true, $ModifyRec=true, $ViewHeight='80px', $Angaar='Rude_Varemodtagelse');
  htm_CentrOn(); htm_nl();
    textKnap($label='@Ny modtageliste',  $title='@Klik her for at oprette en vareregistrering',$link='../_base/page_Blindgyden.php');
    textKnap($label='@Vis alle lister',  $title='@Klik her for at se alle lister, (Filteret nulstilles)',$link='../_base/page_Blindgyden.php');
  htm_CentOff();

  str_hr();
  #echo '<div style="font-weight:600;"><tc>'.tolk('@Her vises liste Id: 2').'</tc></div>'; 
  echo '<tc><b>'.  tolk('@DETALJER:').' &nbsp;'.tolk('@Her vises liste Id: 2').'</b></tc>'; 
  htm_Tabel($RowLabl='@Klik på vare-nummeret for at vælge denne post',
            $ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
              ['@Varenr.',       '8%','','text',  'center', '@Entydigt varenummer','@Vare...'],
              ['@Antal',         '6%','','text',  'center', '@Vare antallet','@Antal...'],
              ['@Beskrivelse',  '36%','','text',  'left',   '@Vare beskrivelse','@Beskriv...'],
              ['@Leveres',      '25%','','text',  'left',   '@Initial ?? er for den som har modtaget varerne','@Lev...'],
              ['@Lager',        '25%','','text',  'left',   '@Lageret hvor varen indgår','@Lager...'],
              ),
            #$TablData= ImportTabFile('../_exchange/varer.tab'),  // Indlæs data fra TAB-fil
            $TablData= [[1001,'Antal','Beskrivelse','Leveres','Lager'],[1002,'Antal','Beskrivelse','Leveres','Lager'],[1003,'Antal','Beskrivelse','Leveres','Lager'],[1004,'Antal','Beskrivelse','Leveres','Lager']], # 'Varenr.','Antal','Beskrivelse','Leveres','Lager'
            $FilterOn=false, $SorterOn=true, $CreateRec=false, $ModifyRec=true, $ViewHeight='100px', $Angaar='Rude_Varemodtagelse' );
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
}

function Rude_Lagre(&$Nr, &$Beskrivelse, &$Afd) {
  htm_Rude_Top($name= 'lagrform',$capt= '@Lagre:',$parms='',$icon='fa-pencil-square-o','panelW320',__FUNCTION__);
  htm_FrstFelt('15%');    htm_CombFelt($type='text',$name='nr',         $valu= $Nr,           $labl='@Nr.',         $titl='@Nr',          $revi=true);  
  htm_NextFelt('65%');    htm_CombFelt($type='text',$name='beskrivelse',$valu= $Beskrivelse,  $labl='@Beskrivelse', $titl='@Beskrivelse', $revi=true);  
  htm_NextFelt('20%');    htm_CombFelt($type='text',$name='afd',        $valu= $Afd,          $labl='@Afd.',        $titl='@Afd',         $revi=true);  
  htm_lastFelt();
  htm_RudeBund($pmpt='@Gem',$subm=true);
}


function Rude_Projekter(&$Nr, &$Beskrivelse) {
  htm_Rude_Top($name= 'projform',$capt= '@Projekter:',$parms='',$icon='fa-pencil-square-o','panelW320',__FUNCTION__);
  htm_FrstFelt('20%');    htm_CombFelt($type='text',$name='nr',         $valu= $Nr,           $labl='@Nr.',         $titl='@Nr',          $revi=true);  
  htm_NextFelt('80%');    htm_CombFelt($type='text',$name='beskrivelse',$valu= $Beskrivelse,  $labl='@Beskrivelse', $titl='@Beskrivelse', $revi=true);  
  htm_lastFelt();

  htm_RudeBund($pmpt='@Gem',$subm=true);
}

function Rude_Afdelinger(&$Nr, &$Beskrivelse, &$Afd) {
  htm_Rude_Top($name= 'afdlform',$capt= '@Afdelinger:',$parms='',$icon='fa-pencil-square-o','panelW320',__FUNCTION__);
  htm_FrstFelt('15%');    htm_CombFelt($type='text',$name='nr',         $valu= $Nr,           $labl='@Nr.',         $titl='@Nr',          $revi=true);  
  htm_NextFelt('65%');    htm_CombFelt($type='text',$name='beskrivelse',$valu= $Beskrivelse,  $labl='@Beskrivelse', $titl='@Beskrivelse', $revi=true);  
  htm_NextFelt('20%');    htm_CombFelt($type='text',$name='afdel',      $valu= $Afd,          $labl='@Afdeling.',   $titl='@Afdeling',    $revi=true);  
  htm_lastFelt();

  htm_RudeBund($pmpt='@Gem',$subm=true);
}

# PROGRAM-MODUL;
function Rude_LanguageJuster() {
  global $ØsprogTabl, $ØprogSprog, $ØlanguageTable, $ØsprogCol, $ØsprogRow;
  $ØsprogCol= $_SESSION['ØsprogCol'];
  $ØsprogRow= $_SESSION['ØsprogRow'];
  $col= $ØsprogCol;  $row= $ØsprogRow;
  $rowmax= count($ØlanguageTable);
  $col= max($col,1);  $col= min($col,7);  $row= max($row,1);  $row= min($row,$rowmax);
  $optlist= array( # 0:Tip 1:value 2:Text  3:events // Bemærk: Spec.udgave af SprogValg (værdier er tal [1..6], ikke tegn!)
      ['Vælg dansk sprog',                1,'1 Dansk',   ],
      ['Select English language',         2,'2 English', ],
      ['Wählen Sie deutsche Sprache',     3,'3 Deutsch', ],
      ['Choisissez la langue française',  4,'4 Français',],
      ['Türk Dili seçin',                 5,'5 Türkçe',  ],
      ['Wybierz język duński',            6,'6 Polski',  ],
      ['Elegir el idioma español',        7,'7 Español', ],
      ['Selezionare la lingua italiana',  8,'8 Italian', ]);
  htm_Rude_Top($name='', $capt='@Ændring af program tekster:', $parms='', $icon='fa-language', 'panelW640', __FUNCTION__);
  htm_FrstFelt('45%');    
    htm_Formstart($name='sprogform'); ## Rediger: Sproget
      SprogValg($ØprogSprog);
    htm_Formslut();
  htm_NextFelt('55%');    
    echo tolk('@Programmets aktuelt benyttede sprog.');
  htm_LastFelt();    
  $sprogtxt= tolk('@Sprog frase').': '.$optlist[$col-1][2];
  htm_Rammestart($Caption='@Hvilken frase vil du redigere:');
      $TablData= array(); $x= 0;
      foreach ($ØlanguageTable as $rakke) {array_push($TablData, [$x++,$rakke[0],$rakke[$col]]);}
      htm_Caption($labl='@Her ser du frase numrene og en søgbar liste over sprog-fraser:');
      htm_Tabel($RowLabl='@Klik på frase-nummeret for at se ordre',$ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]  
            ['@Nr','6%','','','center','',''],['@SYSTEM key','40%','','text','left','',''],[$sprogtxt,'44%','','text','left','','']),
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
      if(isset($_POST['submit'])) {$result = $_POST[$name];} // Problem: Komponenten retter variablen, men viser den gamle værdi! ?
      if ($result>0) {$col= $result;  $ØsprogCol= $result; $_SESSION['ØsprogCol']= $result;}
    htm_Formslut();
    htm_NextFelt('10%'); 
      htm_Formstart($name='rowform'); ## Rediger: index til sprogrække
        htm_CombFelt($type='number',  $name='rowix', $valu= $row,   $labl='@Frase',  $titl='@Vælg nummer for den frase, som du vil redigere: ', $revi=true, $rows='',
                     $width='20',$step='1',$more=' onblur="submit();"  min="1" max="'.$rowmax.'"' );
        $result= $_POST[$name];  if ($result>0) {$row= $result; $ØsprogRow= $result; $_SESSION['ØsprogRow']= $result;}
      htm_Formslut();
    htm_NextFelt('35%');    
      echo '&nbsp; '.tolk('@af ialt:').($rowmax-1);
    
    htm_NextFelt('20%');    
      echo '&nbsp;&nbsp; (Index:'.$row.':'.$col.')';
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
function GemogBrug() {
  ExportTabFile('../_config/MitSprog_DB', '","', $ØlanguageTable); //  GEM:  
  sprogDB_import($fname='../_config/MitSprog_DB.csv');             //  BENYT:
}

function SprogExport($languageTable) {
 # ExportTabFile('../_exchange/SprogExport', '","', $languageTable);
  msg_Dialog('info',ucfirst(tolk('@Fortsæt')),'$(this).dialog("close")','','','','',ucfirst(tolk('@Udført Export:')), 
                   ucfirst(tolk('@Der er udført en export af sprogtabellen, til filen: ../_exchange/SprogExport.csv')));
}

/* 
<form action="#" method="post"> <select name="Color">
if(isset($_POST['submit'])){$result = $_POST['Color'];

<select class="styled-select" name="progsprog" onchange="this.submit onblur="window.location.reload();" 
oninvalid="this.setCustomValidity('Vælg @Rediger sprog på listen!')">

<select class="styled-select" name="progsprog" onchange="= $_POST["progsprog"];" onblur="window.location.reload();" 
oninvalid="this.setCustomValidity('Vælg @Rediger sprog på listen!')"> 
  <option value="" >Vælg!<option value="1" title="Vælg dansk sprog">Dansk</option> 
  <option value="2" title="Select English language">English</option> 
  <option value="3" title="Wählen Sie deutsche Sprache">Deutsch</option> 
  <option value="4" title="Choisissez la langue française">Français</option> 
  <option value="5" title="Türk Dili seçin">Türkçe</option> 
  <option value="6" title="Elegir el idioma español">Español</option> 
</select>

<select class="styled-select" name="progsprog" onchange="this.submit()" 
oninvalid="this.setCustomValidity('Vælg @Rediger sprog på listen!')"> 
  <option value="" >Vælg!<option value="1" title="Vælg dansk sprog">Dansk</option> 
  <option value="2" title="Select English language">English</option> 
  <option value="3" title="Wählen Sie deutsche Sprache">Deutsch</option> 
  <option value="4" title="Choisissez la langue française">Français</option> 
  <option value="5" title="Türk Dili seçin">Türkçe</option> 
<option value="6" title="Elegir el idioma español">Español</option> 
</select>
 */
 
# PROGRAM-MODUL;
function Rude_Kontoindstilling(&$regnskabnavn='', &$servport='', &$usernavn='', &$usercode='', &$protokol='') 
{
  htm_Rude_Top($name= 'kontoform',$capt= '@Kontoindstilling:',$parms='../_system/page_Kontoindstill.php',$icon='fa-pencil-square-o','panelW320',__FUNCTION__);
  htm_Caption('@Regnskab:');
  htm_CombFelt($type='text',  $name='regnnavn', $valu= $regnskabnavn,   $labl='@Regnskabets navn',  $titl='@Her kan du rette dit regnskabs navn', $revi=true, $rows='2',$width='',$step='');
  str_hr();  
  htm_Caption('@Mail afsendelse:');
  htm_CombFelt($type='text',  $name='servport', $valu= $servport,   
               $labl='@Alternativ SMTP-Server:Port',  
               $titl=tolk('@Her kan angives en alternativ SMTP-server for afsendelse af mail. Serveren skal tillade videresendelse af mails fra ssl.saldi.dk ').
               tolk('@(eller anden server, som').$ØProgTitl.' '.tolk('@kører på). Hvis server porten ikke er 25, skrives port efter SMTP server-navnet adskilt med : F.eks. smtp.gmail.com:465'), 
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
 
  
# PROGRAM-MODUL;
function Rude_Provision() 
{global $Ø_DagList;
  htm_Rude_Top($name= 'provisi',$capt= '@Provision:',$parms='',$icon='fa-pencil-square-o','panelW320',__FUNCTION__);
  htm_Caption('@Provisionsberegning:');
  htm_RadioGrp($type='hori',  $name='provgrlg',   $labl='@Grundlag',  $titl='@Vælg om provison beregnes på fakturerede eller betalte ordrer', 
              $optlist= array(['faktureret','@Faktureret','@eller','@Provision beregnes på fakturerede ordrer'],
                              ['betalt',    '@Betalt',    '',      '@Provision beregnes på betalte ordrer'])
                              ,$action='');
  str_hr();  htm_Caption('@Kilde for personinfo:');
  htm_RadioGrp($type='hori',  $name='provtil',    $labl='@Kilde',     $titl='@Provision tilfalder den, der er angivet som referenceperson på de enkelte ordrer', 
              $optlist= array(['ref',   '@Ref',    '@eller','@Provision beregnes på fakturerede ordrer'],
                              ['kua',   '@Kundens','@eller','@Provision tilfalder den kundeansvarlige'],
                              ['smart', '@Begge',  '',      '@Provision tilfalder den kundeansvarlige såfremt der er tildelt en sådan, ellers til den som er referenceperson på de enkelte ordrer'])
                              ,$action='');
  str_hr();  htm_Caption('@Kilde for kostpris:');
  htm_RadioGrp($type='hori',  $name='provgrund',  $labl='@Grundlag',  $titl='@Vælg om provison beregnes på fakturerede eller betalte ordrer', 
              $optlist= array(['faktureret','@Indkøbspris','@eller','@Anvend varens reelle indkøbspris som kostpris.'],
                              ['betalt',    '@Varekort',    '',     '@Anvend kostpris fra varekort.'])
                              ,$action='');
  str_hr();   htm_Caption('@Skæringsdato for provisionsberegning:');
  htm_OptioFlt($type='text',  $name='brgndato',   $valu= $brgndato, 
                    $labl='@Dato',  
                    $titl='@Dato hvorfra og med (i foregående måned) til (dato i indeværende måned) provisionsberegning foretages',  
                    $revi=true, $optlist= $Ø_DagList,
                    $action='onchange="getComboA(this)"');
  htm_RudeBund($pmpt='@Gem',$subm=true);
}
 
function Rude_Saldisetup() {global $ØProgTitl, $Ønovice, $ØFullFilt, $ØTastkeys;
  htm_Rude_Top($name= 'personl',$capt= tolk('@Hjælp i').$ØProgTitl.':',$parms='',$icon='fa-pencil-square-o','panelW320',__FUNCTION__);
  $Ønovice=   htm_CheckFlt($type='checkbox',$name='novice', $valu= $Ønovice,  
               $labl='@Vis tips for begynder:', $titl=tolk('@Hvis du afmærker dette felt, vil').$ØProgTitl.' '.tolk('@vise nyttige tips for begyndere.'));
  $ØFullFilt= htm_CheckFlt($type='checkbox',$name='fullfilt', $valu= $ØFullFilt,  
               $labl='@Filter hjælp:', $titl=tolk('@Hvis du afmærker dette felt, vil').$ØProgTitl.' '.tolk('@vise hjælpetekster til filter-funktionalitet.'));
  $ØTastkeys= htm_CheckFlt($type='checkbox',$name='tastkeys', $valu= $ØTastkeys,  
               $labl='@Vis tastatur bogstavers genveje:', $titl=tolk('@Hvis du afmærker dette felt, vil').$ØProgTitl.' '.tolk('@vise tastatur bogstavs genveje på knapper.'));
  $ØRollTabl= htm_CheckFlt($type='checkbox',$name='usemaxview', $valu= $ØRollTabl,  
               $labl='@Vis ikke tabeller i vinduer:', $titl=tolk('@Hvis du afmærker dette felt, vil').$ØProgTitl.' '.tolk('@vise tabeller i fuld højde. Nyttigt hvis du udprinter data med browseren.'));
  htm_RudeBund($pmpt='@Gem',$subm=true);
  $_SESSION['Ønovice']=   $Ønovice;  
  $_SESSION['ØFullFilt']= $ØFullFilt; 
  $_SESSION['ØTastkeys']= $ØTastkeys;
  $_SESSION['ØRollTabl']= $ØRollTabl;
}
 
# PROGRAM-MODUL;
function Rude_Personlig() 
{global $ØprogSprog;
  htm_Rude_Top($name= 'personl',$capt= '@Personlige valg:',$parms='', $icon='fa-pencil-square-o','panelW320',__FUNCTION__);
  
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
                                             $titl= tolk('@Denne streng benyttes af systemet (javascript), når der åbnes et nyt vindue. ').str_nl().tolk('@Her kan du indstille, hvordan vinduerne skal vises.'), 
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
                          $titl= '@Her skriver du hex-værdien for den ønskede RGB-baggrunds farve eksempelvis FF9933 for orange. Se flere værdier på www.saldi.dk/dokumentation/farver ', 
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
  
  echo '<p>DatoVælger: <input type="text" id="datepicker" placeholder="DatePicker:Klik i feltet (deaktiv!)"></p>';

//  echo '<script>';
#  echo ' $( "#datepicker" ).datepicker({showWeek: true });';
#  echo ' $( function() {';
//  echo ' $( "#datepicker" ).datepicker();';
//  echo '   $( "#format" ).on( "change", function() {';
//  echo '     $( "#datepicker" ).datepicker( "option", "dateFormat", $( this ).val() );';
//  echo '   });';
#  echo ' } );';
//  echo '</script>';
//  $( ".selector" ).datepicker({  showWeek: true});
# echo '$.datepicker.formatDate( "yy-mm-dd", new Date( 2007, 1 - 1, 26 ) );';
  
#  echo '$.datepicker.formatDate( "DD, MM d, yy", new Date( 2007, 7 - 1, 14 ), {';   cFhJ8P6x6k   cFhJ8P6x6k
#  echo '  dayNamesShort: $.datepicker.regional[ "fr" ].dayNamesShort,';
#  echo '  dayNames: $.datepicker.regional[ "fr" ].dayNames,';
#  echo '  monthNamesShort: $.datepicker.regional[ "fr" ].monthNamesShort,';
#  echo '  monthNames: $.datepicker.regional[ "fr" ].monthNames';
#  echo '});';

  htm_hr();  htm_Caption('@Fremhævning af felter:');
      $bgcolor='#ffffff';
      $nuancefarver= [  //  [0:Tip, 1:value, 2:Label, 3:Action]
      ['Farve 1',  '+00-22-22','@Rød',      'style="background:'.farvenuance($bgcolor, '+00-22-22').'"'],
      ['Farve 2',  '+00+00-33','@Gul',      'style="background:'.farvenuance($bgcolor, '+00+00-33').'"'],
      ['Farve 3',  '-22+00-22','@Grøn',     'style="background:'.farvenuance($bgcolor, '-22+00-22').'"'],
      ['Farve 4',  '-22-22+00','@Blå',      'style="background:'.farvenuance($bgcolor, '-22-22+00').'"'],
      ['Farve 5',  '+00-33+00','@Magenta',  'style="background:'.farvenuance($bgcolor, '+00-33+00').'"'],
      ['Farve 6',  '-33+00+00','@Cyan',     'style="background:'.farvenuance($bgcolor, '-33+00+00').'"'],
      ];
      $antal_nuancer=count($nuancefarver);
  htm_OptioFlt($type='text',  $name='nuance',   $valu= $nuance, 
              $labl='@Farvenuance',  
              $titl='@Fremhæv eksempelvis ordrefelter, hvor der mangler levering eller modtagelse, med den angivne baggrunds-farvenuance.',  
              $revi=true, $optlist= $nuancefarver,
              $action='onchange="getComboA(this)"');
  htm_RudeBund($pmpt='@Gem',$subm=true);
}
 
 
# PROGRAM-MODUL;
function Rude_Ordrerelat() 
{
  htm_Rude_Top($name= 'ordrerelat',$capt= '@Ordre relateret:',$parms='',$icon='fa-pencil-square-o','panelW640',__FUNCTION__);
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
 
# PROGRAM-MODUL;
function Rude_Varerelat() 
{
  htm_Rude_Top($name= 'varerelat',$capt= '@Varerelateret:',$parms='',$icon='fa-pencil-square-o','panelW320',__FUNCTION__);
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
//  Variant	Værdi
//  Ny variant
  htm_RudeBund($pmpt='@Gem',$subm=true);
}
 
 
# PROGRAM-MODUL;
function Rude_Prislister() 
{
  htm_Rude_Top($name= 'prislist',$capt= '@Prislister:',$parms='',$icon='fa-pencil-square-o','panelW960',__FUNCTION__);
  htm_Caption('@Prislister:');
  htm_nl();  echo tolk('@Prislisterne er lister med priser, som hentes fra en extern ressource, eksempelvis en fil på en hjemmeside eller et ftp-sted.').'<br>';
  htm_nl();
  htm_Tabel($RowLabl='@Klik på liste-nummeret for at se prislisten',
            $ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
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
 
 
# PROGRAM-MODUL;
function Rude_Backup() 
{global $Øsaldihost;
  htm_Rude_Top($name= 'backup',$capt= '@Sikkerhedskopiér:',$parms='../_base/page_Gittermenu.php',$icon='fa-floppy-o','panelW640',__FUNCTION__);
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

//  ZipArchive::addGlob - http://dk2.php.net/manual/en/ziparchive.addglob.php

 
# PROGRAM-MODUL;
function Rude_Bilagsinfo($ftpservaddr= 'bilag_999@ssl2.saldi.dk.') 
{
  htm_Rude_Top($name= 'backup',$capt= '@Bilagshåndtering:',$parms='',$icon='fa-floppy-o','panelW640',__FUNCTION__);
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
  htm_CheckFlt($type='checkbox',$name='googdocs', $valu= $googdocs,  $labl='@Benyt Google Docs viewer',  $titl='@Er du bruger af Googles online-systemer... !)',  $revi=true, $more=' '.$pg);
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='');
}
 
 # PROGRAM-MODUL;
function Rude_Diversevalg() 
{
  htm_Rude_Top($name= 'diversevalg',$capt= '@Diverse:',$parms='',$icon='fa-pencil-square-o','panelW480',__FUNCTION__);
  htm_Caption('@Diverse valg:');
  htm_nl();
  htm_CheckFlt($type='checkbox',$name='googdocs', $valu= $googdocs,  $labl='@Tvungen valg af debitorgruppe på debitorkort',   $titl='@Hvis dette felt afmærkes, tvinges brugeren til aktivt at vælge debitorgruppe ved oprettelse af debitorer.',  $revi=true, $more=' '.$pg);
  htm_CheckFlt($type='checkbox',$name='googdocs', $valu= $googdocs,  $labl='@Tvungen valg af kundeansvarlig på debitorkort',  $titl='@Hvis dette felt afmærkes, tvinges brugeren til aktivt at vælge kundeansvarlig ved oprettelse af debitorer',  $revi=true, $more=' '.$pg);
  htm_CheckFlt($type='checkbox',$name='googdocs', $valu= $googdocs,  $labl='@Tilføj ekstra felter på ansatte',                $titl='@Ved at afmærke her får du op til 14 ekstra felter på ansattes stamkort, for egne ansattes',  $revi=true, $more=' '.$pg);
  htm_hr();
  htm_CheckFlt($type='checkbox',$name='googdocs', $valu= $googdocs,  $labl='@Brug betalingslister',                           $titl='@Benyt betalingslister',  $revi=true, $more=' '.$pg);
  htm_CheckFlt($type='checkbox',$name='googdocs', $valu= $googdocs,  $labl='@Integration med DocuBizz',                       $titl='@Benyt import fra DocuBizz - Det intelligente fakturasystem',  $revi=true, $more=' '.$pg);
  htm_CheckFlt($type='checkbox',$name='googdocs', $valu= $googdocs,  $labl='@Brug jobkort',                                   $titl='@Jobkort findes i debitorkonti. Her kan du definere opgavebeskrivelser til medarbejdere osv.',  $revi=true, $more=' '.$pg);
  htm_hr();
  htm_CheckFlt($type='checkbox',$name='googdocs', $valu= $googdocs,  $labl='@Brug HTML/CSS til formulargenerering',           $titl='@Afmærkes feltet anvendes HTML/CSS til formulargenerering',  $revi=true, $more=' '.$pg);
  htm_CheckFlt($type='checkbox',$name='googdocs', $valu= $googdocs,  $labl='@Tillad forskellige datoer på samme bilagsnummer i kassekladde.',  
      $titl=tolk('@Afmærk her for at undtrykke advarsel i kassekladden, hvis der anvendes samme bilagsnummer til flere bilag med forskellige datoer. ').
      tolk('@(F.eks, hvis et kontoudtog fra bank bogføres som ét bilag)'),  $revi=true, $more=' '.$pg);
  htm_CheckFlt($type='checkbox',$name='googdocs', $valu= $googdocs,  $labl='@Integration med ebConnect',                      
      $titl='@Elektronisk fakturering. Send og modtag e-faktura med ebconnect. Send direkte fra økonomisystemet og overfør til kassekladden - klar til bogføring',  $revi=true, $more=' '.$pg);
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='');
}
 
  # PROGRAM-MODUL;
function Rude_Rykkerrel() 
{
  htm_Rude_Top($name= 'diversevalg',$capt= '@Rykkerrelateret:',$parms='',$icon='fa-pencil-square-o','panelW320',__FUNCTION__);
  htm_Caption('@Rykker ansvarlig:');
  htm_nl();
  htm_OptioFlt($type='text', $name='opbevar', $valu= $opbevar, $labl='Brugernavn', $titl='@Brugernavn for "rykkeransvarlig" - Når brugeren logger ind, adviseres denne, hvis der skal rykkes - Hvis navn ikke angives adviseres alle.', $revi=true, $optlist= 
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
 
  # PROGRAM-MODUL;
function Rude_Tjeklister() 
{
  htm_Rude_Top($name= 'tjeklist',$capt= '@Tjeklister:',$parms='',$icon='fa-pencil-square-o','panelW320',__FUNCTION__);
  htm_Caption('@Tjeklister:');
  htm_nl();
  htm_CombFelt($type='text',  $name='nytjek', $valu= $nytjek,   
                          $labl= '@Ny tjekliste',  
                          $titl= '@Navn på ny tjekliste', 
                          $revi=true, $rows='2',$width='30px', $step='', $more='',$plho=tolk('@Liste...'));
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='Gem');
}
 
 
  # PROGRAM-MODUL;
function Rude_Differencer() 
{
  htm_Rude_Top($name= 'tjeklist',$capt= '@Differencer:',$parms='',$icon='fa-pencil-square-o','panelW240',__FUNCTION__);
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
 
  # PROGRAM-MODUL;
function Rude_Massefakt() 
{
  htm_Rude_Top($name= 'diversevalg',$capt= '@Massefakturering:',$parms='',$icon='fa-pencil-square-o','panelW320',__FUNCTION__);
  htm_Caption('@Massefakturering:');
  htm_nl();
  htm_CheckFlt($type='checkbox',$name='aktvmass', $valu= $aktvmass,  $labl='@Aktiver massefakturering', $titl='@Hvis du aktiverer massefakturering, har du mulighed for at fakturere alle godkendte salgsordrer i en arbejdsgang.',  
  $revi=true, $more=' '.$pg);
  htm_CheckFlt($type='checkbox',$name='aktvmass', $valu= $aktvmass,  $labl='@Medtag delleverancer',     $titl='@Hvis du afmærker dette felt, vil ordrer, hvor ikke alt er på lager, blive delleveret/-faktureret.',  
  $revi=true, $more=' '.$pg);
  htm_CombFelt($type='text',  $name='gammel', $valu= $gammel,   
                          $labl= '@Frist for dellevering (dage)',  
                          $titl= '@Her angiver du, hvor mange dage gammel en ordre skal være, før der foretages en dellevering/-fakturering.', 
                          $revi=true, $rows='2',$width='30px', $step='', $more='',$plho=tolk('@Antal dage...') );
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='');
}
 
  # PROGRAM-MODUL;
function Rude_Formtekst($filDATA) 
{
  htm_Rude_Top($name= 'diversevalg',$capt= '@Formular tekster:',$parms='',$icon='fa-pencil-square-o','panelW640',__FUNCTION__,$more=' style= "height:750px" ');
  htm_Caption('@Tekster på formularer:');
  htm_nl();
  htm_Rammestart($Caption='@Om teksterne:');
    echo tolk('@Teksterne benyttes ikke i programfladen, men til udskrivning af blanketter.').'<br>';
    echo tolk('@Du kan formattere teksterne med html-koder').'<br>';
    echo tolk('@Systemet er ikke anvendt endnu, men blot for at demonstre redigering.').'<br>';
  htm_Rammeslut();
  $data= array();  foreach ($filDATA as $rec) array_push($data, [$rec[0],$rec[1],[$rec[1],['x']]]);
  # var_dump($data);
  htm_TabelInp(
    $HeadLine= array( ['@Tabel:', '18%','left','show', ' ', '@Dansk sprog'] ),
      $RowHead= array(),
      $ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
        ['@Id',          '5%','','show', 'center',  '@Tekstens id','@Auto...'],
        ['@Vist tekst', '20%','','show', 'left',    '@Nuværende vist HTML-tekst','@Tekst...'],
        ['@Tekst med format koder',   '75%','','area', 'left',    '@Korrigerbar HTML-tekst','@Tekst...'],
    ),
    $RowTail= array(),
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
 
  # PROGRAM-MODUL;
function Rude_Imogexport() 
{
  htm_Rude_Top($name= 'imexport',$capt= '@Data export/import:',$parms='',$icon='fa-pencil-square-o','panelW480',__FUNCTION__);
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
 
 
# PROGRAM-MODUL;
function Rude_Labels($lbltype,$demo) 
{global $VareVars;
  htm_Rude_Top($name= 'labels',$capt= '@Label print:',$parms='',$icon='fa-pencil-square-o','panelW640',__FUNCTION__,$more=' style= "height:510px" ');
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
               $revi=true, $rows='12', $width='', $step='', $more='',$plho=tolk('@Udfyld med HTML...') );
  echo '<textarea style="height:100px"></textarea>';  //  Dummy for at styre højdeplacering!
  htm_nl(3);  echo tolk('@Sådan ser det ud:');
	htm_nl(1);  echo $demo;
  htm_RudeBund($pmpt='@Gem',$subm=true);
}
 
 
# PROGRAM-MODUL;
function Rude_TipsBrug() 
{
  htm_Rude_Top($name= 'tips',$capt= '@Tips til brugeren:',$parms='',$icon='fa-pencil-square-o','panelW480',__FUNCTION__);
  htm_Caption('@TIPS:');                   htm_nl();
  echo tolk('Hvis du klikker med musens højre-tast på navigations knapper, får du mulighed for at åbne linket i et nyt vindue eller fane, uden at lukke det vindue du er i.').str_nl(2);
  
  htm_Caption('@NAVIGERING i tabeller:');  htm_nl();
  echo ' <colrlabl>'.tolk('@Tab-tast').'</colrlabl> '.
    tolk('@springer til næste felt.').' <colrlabl>'.tolk('@SHIFT Tab-tast').'</colrlabl> '.tolk('@springer til forrige felt.').
    '  <colrlabl>'.tolk('@CTRL Pil-taster').'</colrlabl> '.tolk('@virker også. ').str_nl(2);
  
  htm_Caption('@SORTERING af tabeller:');  htm_nl();
  echo  tolk('@De tabeller som kun viser data, kan du sortere.').str_nl(1);
  echo  tolk('@Du gør det ved at klikke på kolonne overskriften.').str_nl(1);
  echo  tolk('@Det er kun muligt at sortere på en kolonne ad gangen.').str_nl(2);
  
  htm_Caption('@SØGNING i et vindue:');  htm_nl();
  echo  tolk('@Alle browsere har en søgefunktion, som oftes aftiveres med CTRL + F').str_nl(1);
  echo  tolk('@Med denne kan du finde tekster, selv om de ikke er på den synlige del af vinduet.').str_nl(2);
  
  htm_Caption('@VINDUER:');                htm_nl();
  echo  tolk('@I de fleste nyere browsere kan du:').str_nl(1);
  echo  tolk('@Skifte fuldskærms mode: F11, og udnytte hele skærmens størrelse.').str_nl(1);
  echo  tolk('@Zoom ind/ud: CTRL + /CTRL - ').'&nbsp;';
  echo  tolk('@eller med CTRL-musrulleknap').str_nl(1);
  echo  tolk('@CTRL 0 nulstiller zoom til 100%').str_nl(2);
  
  htm_Caption('@Hjælpe tekster:');         htm_nl();
  echo  tolk('@Tekster i felter med skygge (også andre!), indeholder nyttig hjælp.').str_nl(1);
  echo  tolk('@Når du holder musen over disse tekster, vises PopUp med tips.').str_nl(2);
  echo  tolk('@Benytter du trykfølsom skærm uden mus, skal du benytte Chrome browseren, for at få hjælpetekster:'). str_nl();
  echo  tolk('@´Hvil´ fingeren eller musen over teksten med skygge, så popper hjælpetekster op.'). str_nl(2);

  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Retur til hovedmenu');
}
 
# PROGRAM-MODUL;
function Rude_TipsBogh() 
{
  htm_Rude_Top($name= 'tips',$capt= '@Tips til bogholderen:',$parms='',$icon='fa-pencil-square-o','panelW480',__FUNCTION__);
  htm_Caption('@Regnskabs TIPS:');         htm_nl();
  echo  tolk('@Vent med bogføring, hvis du har udskrevet rykkergebyr... ').str_nl(1);
  echo  tolk('@Det gør det nemmere hvis du vil annullere gebyret.').str_nl(2);
  echo  tolk('@Husk bogføring, i forbindelse med momsafregning...').str_nl(1);
  echo  tolk('@Så er du mere sikker på, ikke at lave kludder i momsen.').str_nl(2);
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Retur til hovedmenu');
}
 
 
# DEMO-MODUL;
function Rude_News() {global $ØlanguageTable, $ØProgTitl;
  htm_Rude_Top($name= 'nyheder',$capt= '@Nyheder:',$parms='',$icon='fa-info','panelW640',__FUNCTION__);
  echo '<div style="text-align:center; color:black; background:white;"><big><i>'.str_nl().
       tolk('@Her er nogle af de væsentligste nyheder i denne version af').' SALDI:</i></big>'. str_nl(3);
  echo tolk('@Program-betjening kan nu skifte mellem ialt 8 europæiske sprog.'). str_nl(2);
  echo tolk('@Navnet').$ØProgTitl.'-€ '.tolk('@afspejler, at det er en europæisk flersproglig version.'). str_nl(3);
  echo tolk('@Programmet er blevet CSS-baseret, så design nemt kan forandres.'). str_nl(2);
  echo tolk('@Designet er adaptive, dvs. det tilpasser sig til smallere skærme.'). str_nl(2);
  echo tolk('@Alle sider vises nu med en menu-bjælke i toppen, så navigering er mere fleksibel.'). str_nl(3);
  echo tolk('@Data-visning er grupperet i mindre paneler, som nemt kan kombineres i andre sammenhænge.'). str_nl(3);
  echo tolk('@Benyttes moderne browsere, kan dato-indtastninger, benytte en `date-picker`.'). str_nl(2);
  echo tolk('@Formular-redigering, har fået mulighed for WYSIWYG design i LibreOffice. ¤'). str_nl(3);
  echo tolk('@Du kan nu se, hvilke tekster (Felter med skygge), der har hjælpetekster tilknyttet.'). str_nl(2);
  echo tolk('@Der er benyttet farver, til at skelne mellem forskellige funktioner f.eks. GRØN: Navigation.'). str_nl(2);
  echo tolk('@Alle tabeller har stribet baggrund, som gør det lettere at læse sammenhørende data.'). str_nl(2);
  echo tolk('@Tabeller med mange linier, vises i `rulle-vinduer`, med fastlåste kolonneoverskrifter.'). str_nl(2);
  echo tolk('@Tabeller (uden Input) sorteres lokalt, så server, database og netværk, ikke belastes.'). str_nl(3);
  echo tolk('@Programmet er blevet kompatibelt med PHP 7+, og benytter HTML5 og javascript. ¤'). str_nl(2);
  echo tolk('@Er serveren indstillet til at benytte PHP 7, bliver programmet dobbelt så hurtigt!'). str_nl(2);
  echo tolk('@Sikkerheden omkring passwords (brugere og databaseadgang) er blevet forbedret. ¤'). str_nl(2);
  echo tolk('@Programmes kildekode er blokstrukturet, og blevet omskrevet, så udskrift ').str_nl();
  echo tolk('@og data-dannelse er adskilt, og det er blevet meget nemmere at overskue og forstå. ¤'). str_nl(2);
  echo tolk('@Det er blevet simplere for programmøren at tilpasse, rette og vedligeholde programmet. ¤'). str_nl(3).
            '<i><b>'.tolk('@Andet: ').'</b></i>';
  echo tolk('@Der benyttes Ikoner, Funktioner som ikke er standard samles i: `Tilvalg`,  ¤'). str_nl(2);
  echo tolk('@¤: Målsætning - Der arbejdes stadig på dette.'). str_nl(3).'</div>';
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Retur til hovedmenu');
}
 
# DEMO-MODUL;
function Rude_Intro() {global $ØlanguageTable;
  htm_Rude_Top($name= 'intro',$capt= '@Introduktion:',$parms='',$icon='fa-info','panelWmax',__FUNCTION__);
  echo '<div style="text-align:center;"><big>Velkommen til en demo af SALDI med nyt moderne <b>CSS</b>-baseret <b>responsive</b> design,<br><br>'.
  ' samt <b>sprogunderstøttelse</b> og forberedt for forøget <b>sikkerhed</b> omkring password.</big><br><br>';
  echo 'Herunder demonstreres output-modulerne {out_*.php} og deres benyttelse.<br><br>';
  echo 'Der mangler stadig funktionalitet, så vil du skifte sprog, skal der tilføjes  parameter i URL:<br>';
  echo '&nbsp;&nbsp;&nbsp;<i>/saldi-e/base/page_Layoutdemo.php?sprog=en</i> - Vælger engelsk sprog';
  echo '<br>I tabel for Sprog oversættelse er aktuelt indlæst '.count($ØlanguageTable).' fraser, alle maskinoversat af Google Translate.'; str_nl();
  echo 'Er der prefix: @ på en dansk tekst, når du har valgt andet sprog, er det fordi der ikke findes en oversættelse endnu. <br>';
  echo '<br>Benytter du trykfølsom skærm uden mus, skal du benytte Chrome browseren, for at få hjælpetekster:'; str_nl();
  echo '"Hvil" fingeren eller musen over den blå tekst med skygge, så popper hjælpetekster op.';  str_nl();
  echo 'Der er stadig "skønhedsfejl" i forskellige browseres visning. </div>';
  htm_RudeBund($pmpt='@Gem',$subm=false,$title='@Gem');
}

# DEMO-MODUL;
function Rude_Test()  {
  htm_Rude_Top($name= 'test', $capt= '@Værd at prøve:', $parms='',  $icon='fa-info',  'panelWmax',__FUNCTION__);
  echo '<div style="text-align:center; font-weight:400"><b>Afprøv CSS og responsive design.</b><br><br>';
  echo 'Variér vinduets bredde og se hvordan layoutet tilpasser sig.<br><br>';
  echo 'I Firevox kan du skifte til testvindue for Responsivt-design-vindue med CTRL-Skift-M.<br><br>';
  echo 'Læg mærke til at der er særlige skift ved vinduesbredderne: 320px, 640px, 960px og max 1200px<br><br>';
  echo 'Hvor der findes skjulte hjælpetekster, er synliggjort med blå tekster i skyggerammer. <br><br>';
  echo '<b>Afprøv ændring af programfladens sprog.</b><br><br>';
  echo '<colrlabl>/saldi-e/base/page_Layoutdemo.php?sprog=en</colrlabl> - Vælger engelsk<br>';
  echo '<colrlabl>/saldi-e/base/page_Layoutdemo.php?sprog=de</colrlabl> - Vælger tysk<br>';
  echo '<colrlabl>/saldi-e/base/page_Layoutdemo.php?sprog=fr</colrlabl> - Vælger fransk<br>';
  echo 'Og de andre:&nbsp;<colrlabl>/saldi-e/base/page_Layoutdemo.php?sprog=es =tr =da</colrlabl> - Vælger spansk/tyrkisk/dansk';
  echo '<br><br><b>Afprøv HTML5 og andre forbedringer.</b><br><br>';
  echo 'Inddatering af datoer i chrome, opera, vivaldi (m.fl.?) : Browseren tilbyder date-picker.<br><br>';
  echo 'Validering af data i input-felter : mail-adresse, password, required, m.fl.<br><br>';
  echo 'Prøv at vælge et password for administrator (Database setup), og se password styrke måleren.</div><br>';
  # /da:Sprog/en:Language/de:Sprache/fr:Langue/tr:Dil/es:Lenguaje
htm_RudeBund($pmpt='@Gem',$subm=false,$title='@Gem');
}

# DEMO-MODUL;
function Rude_Formaal() {
  htm_Rude_Top($name= 'formaal',$capt= '@Formål:',$parms='',$icon='fa-info','panelW720',__FUNCTION__);
  echo 'Målsætningen med denne udvikling er:<br>';
  echo '<small><pre>';
  echo '  1. Konsistent modul-opbygget kode, så vedligeholdelse/udvikling bliver nemmere.<br>';
  echo '  2. Fjernelse af inaktiv kode.<br>';
  echo '  3. Hastigheds forøgelse, med fokus på repeterende rutiner.<br>';
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
function Rude_Browsr()  {
  htm_Rude_Top($name= 'intro',$capt= '@Browsere:',$parms='',$icon='fa-info','panelW320',__FUNCTION__);
  echo '<div style="text-align:center;"><big>Kompatibilitet:</big><br>';
  echo '<b>Testet i Windows 10: </b><br>';
  echo 'Firevox - OK <br>';
  echo 'Opera - OK <br>';
  echo 'Vivaldi - OK <br>';
  echo 'Chrome - OK <br>';
  echo 'Edge - håbløs : <br>';
  echo '<small>Baggrunde!, Tiptekster!, KnapForgrund! </small><br>';
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
function NaviTip() {### NavigationsTip:
global $Ønovice;
  userTip();
  if ($Ønovice)
  echo '<tc><divline style="margin-left:0.5em"><b>'.tolk('@noTIP:').'</b> I tabeller: <colrlabl>'.tolk('@Tab-tast').'</colrlabl> '.
    tolk('@springer til næste felt.').' <colrlabl>'.tolk('@SHIFT Tab-tast').'</colrlabl> '.tolk('@springer til forrige felt.').
    '  <colrlabl>'.tolk('@CTRL Pil-taster').'</colrlabl> '.tolk('@virker også. ').'</divline></tc><br>';
}

# SUB-FUNCTION:
function TastTip() {### Tips ang. tastaturgenveje:
global $Ønovice;
#+  userTip();
  if ($Ønovice)
  echo '<tc><divline style="margin-left:0.5em"><b>'.tolk('@noTIP:').'</b> <colrlabl>'.tolk('@Genvejs-taster').'</colrlabl> '.
    tolk('@Når der på nogle knapper, er angivet f.eks. ´x´ betyder det, at der er oprettet en genvejs-tast, som kan benyttes i stedet for at klikke på tasten.').'<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.
    tolk('@Hvordan du benytter genvejen afhænger af den browser, du bruger! Firevox:[Alt] [Shift] + genvejs-tast.  Mange andre:[Alt] + genvejs-tast.').
    '</divline></tc><br>';
}
function Tips(){### Tips ang. browser genveje:
  msg_Dialog('tip',ucfirst(tolk('@Retur')),'JavaScript:window.history.back();','','','','',ucfirst(tolk('@Funktionstaster:')),
      tolk('@I de fleste nyere browsere kan du:').'<br><br>'.
      tolk('@Skifte fuldskærms mode: F11').'<br><br>'.
      tolk('@Zoom ind/ud: CTRL+/CTRL- ').'<br>'.
      tolk('eller CTRL-musrulleknap').'<br><br>'
  );
}
function Rude_Blindgyde() {
  msg_Tip($title='@Du er havnet i en blindgyde',  $messg='@Linket du benyttede er midlertidigt, fordi det rigtige ikke er færdigudviklet.');
}

function Rude_Hovhov() {
   msg_Warn($title='@Hov hov!',                   $messg= '@Uautoriseret adgang! Hvad gør du her?');
}

function Rude_Erdusikker() {
  msg_Dialog('warn',ucfirst(tolk('@Retur')),'JavaScript:window.history.back();',ucfirst(tolk('@Fortsæt')), $Knap2_function='$jQ112(this).dialog("close")','','',
                    ucfirst(tolk('@Er du helt sikker?')), ucfirst(tolk('@OBS! Der er ingen fortryd mulighed, hvis du fortsætter!')));
}

function Rude_GruppeInfo() {
  msg_Dialog('tip',ucfirst(tolk('@Luk')),'JavaScript:window.history.back();','','','','',ucfirst(tolk('@Lidt omtale af grupper.')),ucfirst(
            tolk('@Indeling i grupper er en praktisk metode, til at begrænse antallet af viste debi-/kreditorer (en slags filter), ').
            tolk('@og til at tildele medlemmer af gruppen, relevante fælles parametre.')));
}

### DIVERSE LISTER:

# SUB-FUNCTION:
function FormVars($form_nr) { # Returner alle de felter, som er relevante for en given formular
  $result= [eget_firmanavn, egen_addr1, egen_addr2, eget_postnr, eget_bynavn, eget_land, eget_cvrnr, egen_tlf, egen_fax,  egen_bank_navn, egen_bank_reg, egen_bank_konto, egen_email, egen_web];
  if ($form_nr<6  || $form_nr==10 || $form_nr>=12) { $result= array_merge($result, [ansat_initialer,  ansat_navn,  ansat_addr1,  ansat_addr2,  ansat_postnr,  ansat_by,  ansat_email,  ansat_mobil,  ansat_tlf,  ansat_fax,  ansat_privattlf]);
  } elseif ($form_nr==11) { $result= array_merge($result, [adresser_firmanavn, adresser_addr1, adresser_addr2, adresser_postnr, adresser_bynavn, adresser_land, adresser_kontakt, adresser_cvrnr]); } 
  if ($form_nr!=11) { $result= array_merge($result, [ordre_firmanavn, ordre_addr1, ordre_addr2, ordre_postnr, ordre_bynavn, ordre_land, ordre_kontakt, ordre_cvrnr]); }
  if ($form_nr<6 || $form_nr==10 || $form_nr>=12) {
    $result= array_merge($result, [ordre_ordredate, ordre_levdate, ordre_notes, ordre_ordrenr, ordre_momssats, ordre_kundeordnr, ordre_projekt, ordre_lev_navn, 
                                   ordre_lev_addr1, ordre_lev_addr2, ordre_lev_postnr, ordre_lev_bynavn, ordre_lev_kontakt, ordre_ean, ordre_institution, ordre_lev_kontakt]);
  }
  if ($form_nr==4 || $form_nr==13) { $result= array_merge($result, [ordre_fakturanr, ordre_fakturadate]); };   
  $result= array_merge($result, [formular_side, formular_nextside, formular_preside, formular_transportsum, 'formular_betalingsid(9,5)']);
  if ($form_nr<6 || $form_nr==10 || $form_nr>=12) { $result= array_merge($result, [formular_moms, formular_momsgrundlag]);  } 
  $result= array_merge($result, [formular_ialt]);
  if ($form_nr==3) { $result= array_merge($result, [levering_lev_nr, levering_salgsdate]);  } 
  if ($form_nr>=6) { $result= array_merge($result, [forfalden_sum, rykker_gebyr]);  } 
//  if ($form_nr>1 && $form_nr<6) print "<option value = \"kopier_alt|1\">Kopier alt fra tilbud, 
//  if ($form_nr!=2 && $form_nr<6) print "<option value = \"kopier_alt|2\">Kopier alt fra ordrebrkræftelse, 
//  if ($form_nr!=4 && $form_nr<6) print "<option value = \"kopier_alt|4\">Kopier alt fra faktura, 
//  if ($form_nr<5) print "<option value = \"kopier_alt|5\">Kopier alt fra kreditnota,
  
  $r= $result;  $result= array();
  foreach ($r as $rec) {$result= array_merge($result, array([$rec,$rec,'$'.$rec]));}
  # print_r($result);
  return $result;
}

# SUB-FUNCTION:
function OrdrVars($form_nr) { # Returner alle de felter, som er relevante for en given formular
  $result= [];
    if ($form_nr<6 || $form_nr==9 || ($form_nr>=12 && $form_nr<=14)) 
      $result= array_merge($result, [posnr, varenr, lev_varenr, antal, enhed, beskrivelse, pris, rabat, momssats, procent, linjemoms, varemomssats, linjesum, projekt] );
    if ($form_nr==3) $result= array_merge($result, [ lev_tidl_lev, lev_antal, lev_rest, lokation] );
    if ($form_nr==9) $result= array_merge($result, [ leveres, lokation, 'Fri tekst'] );
//  } elseif ($form_nr==11) {$result= array_merge($result,  [beskrivelse, dato, debet, faktnr, forfaldsdato, kredit, saldo]); }
//  } else {$result= array_merge($result,  [dato, faktnr, beskrivelse, beløb] ) }

  $r= $result;  $result= array();
  foreach ($r as $rec) {$result= array_merge($result, array([$rec,$rec,'£'.$rec]));}
  # print_r($result);
  return $result;
}

$VareVars= [['@Vare beskrivelse','$beskrivelse','$beskrivelse'],['@Varens pris ialt','$pris','$pris'],['@Varens enhedspris','$enhedspris','$enhedspris'],
              ['@Vare enhed','$enhed','$enhed'],['@Varebillede','$img','$img'],['@Stregkode med varenummer','$stregkode','$stregkode'],['@Vare nummer','$varenr','$varenr',]];

              
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
function XY_forskydning() {
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
}

?>
