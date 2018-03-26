<?php   $DocFil= '../_base/page_GitterMenu.php';    $DocVer='5.0.0';    $DocRev='2018-03-00';   $DocIni='evs';  $ModulNr=2;
/* ## Purpose:'SALDI's (gamle) hovedmenu';
 * Denne fil er oprettet af EV-soft i 2017.
 *
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * ## LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 */
  $pageTitl='Hovedmenu';
  include("../_base/htm_pagePrepare.php"); ## Sidens indledende html-kode
  if ($GLOBALS['$Ødebug']) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
  include('../_system/page_Licens.php'); exit;
  
  
  
  
### OUTPUT RUTINER: - Kopieret fra out_ruder.php
if (!function_exists('Rude_HovedMenu')) {
# PROGRAM-MODUL; "Navigation"
function Rude_HovedMenu (&$regnskab, &$vis_finans, &$vis_debitor, &$vis_kreditor, &$vis_prodkt, &$vis_lager) {
global $Øcopydate, $Øcopyright, $Øprogvers, $ØprogSprog, $Ødesigner;
//  $ØprogSprog= $_SESSION['ØprogSprog'];
  $goBack= '';  # '?returside=../_base/menu.php';
  echo '<PanlHead>';        
  htm_Rude_Top($name='menuform',$capt='',$parms='',$icon='',$klasse='panelWmax',__FUNCTION__,'','');
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
     /*  Vis altid: */  menuKnap($h='32',$w=$knapW, $label='@Indstillinger',    $link='../_system/page_Syssetup1.php',       $title='@Gå til menuen Indstillinger af: Regnskab og Program');
      htm_nl();   
      if ($vis_finans)  menuKnap($h='32',$w=$knapW, $label='@Rapporter',        $link='../_finans/page_Rapport.php',         $title='@Gå til Finans Rapporter'   );
      if ($vis_debitor) menuKnap($h='32',$w=$knapW, $label='@Rapporter',        $link='../_debitor/page_Rapport.php',        $title='@Gå til Debitor Rapporter'  );
      if ($vis_kreditor)menuKnap($h='32',$w=$knapW, $label='@Rapporter',        $link='../_kreditor/page_Rapport.php',       $title='@Gå til Kreditor Rapporter' );
      if ($vis_prodkt)  menuKnap($h='32',$w=$knapW, $label='',                  $link='../_base/page_Blindgyden.php',        $title='@Gå til ?'                  );
      if ($vis_lager)   menuKnap($h='32',$w=$knapW, $label='@Rapporter',        $link='../_lager/page_Beholdningsliste.php', $title='@Gå til Vare Rapporter'     );
                        menuKnap($h='32',$w=$knapW, $label='@Sikkerheds kopi',  $link='../_system/page_Backup.php',          $title='@Gem/Hent sikkerhedskopi'   );
     echo '</div>';
    htm_FrstFelt('20%',0);
    htm_NextFelt('15%');  htm_CentrOn($more='font-size:10px;');  echo 'SALDI - Version '.$Øprogvers;  htm_CentOff();       
    htm_NextFelt('30%');  htm_CentrOn($more='font-size:10px;');  echo '<i>Copyright '.  $Øcopydate.' '.$Øcopyright.'</i>';  htm_CentOff();
    htm_NextFelt('15%');  htm_CentrOn($more='font-size:10px;');  echo tolk('@Design: ').$Ødesigner;   htm_CentOff();
    
    htm_NextFelt('20%');
    htm_LastFelt();
  echo '</p>';
  htm_RudeBund($pmpt=Tolk('@Gem'),$subm=false);
  Rude_FootMenu($doPrint=false, $doErase=false, $doLookUp=false, $doAccept=false, $doExport=false, $doImport=false, $OpslLabl='');
  echo '</PanlHead>';
}}

if (!function_exists('Rude_FootMenu')){
# PROGRAM-MODUL; "Navigation"
function Rude_FootMenu($doPrint=true, $doErase=true, $doLookUp=true, $doAccept=true, $doExport=true, $doImport=true, $OpslLabl='') {
  echo '<div class="clearWrap"/>';  echo '<PanlFoot>';
    Foot_Links($maxi=true, '<a style="color:#900000" href="'.$link='http://www.ev-soft.dk/saldi-wiki/doku.php?id=saldi:manualen '.'" target="_blank">'.
    '<u title="'.tolk('@Manual, tips og anden hjælp finder du på').' SALDI-DokuWiki">SALDI-DokuWiki</u></a>',
    $doPrint, $doErase, $doLookUp, $doAccept, $doExport, $doImport, $OpslLabl);
  echo '</PanlFoot>';
}}

if (!function_exists('Rude_ProgramStatus')){
function Rude_ProgramStatus() {
  htm_Rude_Top($name='statform',$capt='@Program status',$parms='../_base/page_Gittermenu.php',$icon='fa-info-circle',$klasse='panelW480',__FUNCTION__,'','');
  echo '<div style="text-align:center; color:red; background:white;"><big><i>'.htm_nl().
       tolk('@TEST udgave af').' SALDI:</i></big>'. htm_nl(3);
  echo tolk('@Dette er seneste version i udviklingen.'). htm_nl(2);
  echo tolk('@Der vil derfor forekomme midlertidige fejl'). htm_nl(3);
  echo tolk('@Endvidere vil oversatte fremmed sprog, ikke være ajour'). htm_nl(3);
  echo '</div>';
  htm_RudeBund($pmpt=Tolk('@Gem'),$subm=false);
}}

### INDLÆS DATA:
    $regnskab='CSS-demo'; $vis_finans=true; $vis_debitor=true; $vis_kreditor=true; $vis_prodkt=false; $vis_lager=true;

### VIS DATA:
    SpalteTop(960);   
    Rude_HovedMenu($regnskab, $vis_finans, $vis_debitor, $vis_kreditor, $vis_prodkt, $vis_lager); 
    Rude_ProgramStatus();
    SpalteBund();

//  Til sidst indlæses java-scripter:   
  include("../_base/htm_pageFinalize.php"); ## Sidens afsluttende html-kode
?>