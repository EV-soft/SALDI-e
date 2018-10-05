<?php   $DocFil= '../_base/out_PanlsComm.php';   $DocVer='5.0.0';    $DocRev='2018-09-30';   $DocIni='evs';  $ModulNr=0;
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
  htm_Panl_Top($fmname='commform',$capt= tolk('@Feed back:'),$parms= '#',
        $icon='far fa-comments',$klasse='panelW640',__FUNCTION__, $more=' style= "background-color:WhiteSmoke;" ');
  $mess= set_ajour('feedback');
  if ($mess) 
    { $p= strpos($kilde,' - Fil: ');
      if ($p>0) $fnam= trim(substr($kilde, $p+8)); else $fnam='comments.txt';
      $fp= fopen('../_temp/FeedBack/'.$fnam,"a");
        if ($fp) { fwrite($fp,"\n".date("Ymd-Hi").' '.$mess."\n"); fclose($fp); }
        else echo ' Fil-skrivefejl! '.$fnam.' ';
    }
  htm_Caption('Har du kommentarer angående denne side, så tilføj dem her, sammen med Panel-overskriften');
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

#+  
?>