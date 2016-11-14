<?php   $DocFil= '../includes/out_ruder.php';   $DocVer='5.0.0';    $DocRev='2016-12-00';   $modulnr=0;
//             ___   _   _    ___  _         
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___|
//                                           
// LICENS & Copyright (c) 2004-2016 DANOSOFT ApS *** Se filen: ../LICENS_Copyright.txt
//
// Design af panelers layout.
// Panel-moduler (Ruder) egnet for adaptivt skærm-output.
//
// Afhængig af: out_base.php
//  
// Filer er redigeret med tabulator sat til 2 tegn, og linielængde max. 200 tegn. De ses bedst med det.
// Filer skal gemmes i UTF-8 format uden BOM!
// 2016.08.00 ev - EV-soft

if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'');

// ***** Rutiner for MENU og visning/redigering af DB-data: **************************************************
include('../includes/version.php');
if (!function_exists('msg_Dialog')) {include('../includes/msg_lib.php');};

function menuTitl ($h='32',$w='120',$label='') {
  echo '<menuBg><img src= "../images/menuShapeTitl.png" alt="" height="'.$h.'" width="'.$w.'" /><a href="'.$link.
  '" class="btnTit" notitle= "'.Tolk('@Kolonne Overskrift').'">'.ucfirst(str_replace(' ','&nbsp;',Tolk($label))).'</a></menuBg>'; }
function menuKnap ($h='32',$w='120',$label='',$link='',$title='') { 
  if (strpos($link,'_base/page_Blindgyden.php')) { $flag0= ' style="color:gray" '; $mess= ' &#xa; (En blindgyde endnu!)';}
#  if (strpos($link,'page_syssetup.php')) $flag1= ' style="color:red" '; else $flag1= ' style="color:#900000" ';
  echo '<menuBg><img src= "../images/menuShapeButt.png" alt="" height="'.$h.'" width="'.$w.'" /><a href="'.$link.
  '" class="btn" tip="'.Tolk($title).$mess.'" '.$flag0.$flag1.'>'.ucfirst(str_replace(' ','&nbsp;',Tolk($label))).'</a></menuBg>'; }
  
# PROGRAM-MODUL;
function Rude_HovedMenu (&$regnskab, &$vis_finans, &$vis_debitor, &$vis_kreditor, &$vis_prodkt, &$vis_lager, &$programSprog) {
global $copydate, $copyright, $progvers;
  $goBack= '';  # '?returside=../_base/menu.php';
  echo '<PanlHead>';        
  htm_Rude_Top($name='menuform',$capt='',$parms='',$icon='',$klasse='panelWmax',__FUNCTION__);
  echo '<div style="text-align: center"><img src= "../images/SALDIe50x150.png" alt="Saldi Logo" height="50" width="150" ></div>';
  echo '<div class="panelTitl" max-width:400>'.ucfirst(tolk('@Regnskab: ')).' '.Tolk($regnskab).'</div>';
  $FaLogo= "../images/saldi.png";
# if (file_exists($FaLogo)) echo '<img style="border:0px solid;width:50px;heigth:50px" alt="" src="'.$FaLogo.'">';
  $knapW= '120s';

  echo '<p align="center">';
    echo '<div class="panelW960" style= "box-shadow: 1px 1px 2px 2px #AAAAAA; width:615px; margin-left:auto; margin-right:auto;">';
      if ($vis_finans)  menuTitl($h='32',$w=$knapW, $label='@FINANS');
      if ($vis_debitor) menuTitl($h='32',$w=$knapW, $label='@DEBITOR');
      if ($vis_kreditor)menuTitl($h='32',$w=$knapW, $label='@KREDITOR');
      if ($vis_prodkt)  menuTitl($h='32',$w=$knapW, $label='@PRODUKTION');
      if ($vis_lager)   menuTitl($h='32',$w=$knapW, $label='@LAGER');
                        menuTitl($h='32',$w=$knapW, $label='@SYSTEM'); 
      echo '<br>';
      if ($vis_finans)  menuKnap($h='32',$w=$knapW, $label='@Kasse kladder',     $link='../_finans/page_Kladdeliste.php',     $title='@Gå til Kassekladder'       );  // &#xa; svt. LF
      if ($vis_debitor) menuKnap($h='32',$w=$knapW, $label='@Ordrer',            $link='../_debitor/page_Ordreliste.php',     $title='@Gå til Debitor Ordrer &#xa;(Bestillinger)');
      if ($vis_kreditor)menuKnap($h='32',$w=$knapW, $label='@Ordrer',            $link='../_kreditor/page_Ordreliste.php',    $title='@Gå til Kreditor Ordrer'    );
      if ($vis_prodkt)  menuKnap($h='32',$w=$knapW, $label='@Produktion',        $link='../_produktion/page_Ordreliste.php',  $title='@Gå til Produktion'         );
      if ($vis_lager)   menuKnap($h='32',$w=$knapW, $label='@Varer',             $link='../_lager/page_Varer.php'.$goBack,    $title='@Gå til Varerliste'         );
                        menuKnap($h='32',$w=$knapW, $label='@Konto plan',        $link='../_systemdata/page_Kontoplan.php',   $title='@Gå til Kontoplan'          );
      echo '<br>';
      if ($vis_finans)  menuKnap($h='32',$w=$knapW, $label='@Regnskab',          $link='../_finans/page_Regnskab.php',        $title='@Gå til Regnskab'           );
      if ($vis_debitor) menuKnap($h='32',$w=$knapW, $label='@Konti',             $link='../_debitor/page_Debitor.php',        $title='@Gå til Debitor Konti &#xa;(Kunder)');
      if ($vis_kreditor)menuKnap($h='32',$w=$knapW, $label='@Konti',             $link='../_kreditor/page_Kreditor.php',      $title='@Gå til Kreditor Konti'     );
      if ($vis_prodkt)  menuKnap($h='32',$w=$knapW, $label='@Produktion',        $link='../_produktion/page_Ordreliste.php',  $title='@Gå til Produktion'         );
      if ($vis_lager)   menuKnap($h='32',$w=$knapW, $label='@Vare modtagelse',   $link='../_lager/page_Varemodtagelse.php',   $title='@Gå til Vare modtagelse'    );
                        menuKnap($h='32',$w=$knapW, $label='@Indstillinger',     $link='../_systemdata/page_Syssetup.php',    $title='@Gå til menuen Indstillinger');
      echo '<br>';  
      if ($vis_finans)  menuKnap($h='32',$w=$knapW, $label='@Rapporter',         $link='../_finans/page_Rapport.php',         $title='@Gå til Finans Rapporter'   );
      if ($vis_debitor) menuKnap($h='32',$w=$knapW, $label='@Rapporter',         $link='../_debitor/page_Rapport.php',        $title='@Gå til Debitor Rapporter'  );
      if ($vis_kreditor)menuKnap($h='32',$w=$knapW, $label='@Rapporter',         $link='../_kreditor/page_Rapport.php',       $title='@Gå til Kreditor Rapporter' );
      if ($vis_prodkt)  menuKnap($h='32',$w=$knapW, $label='',                   $link='../_base/page_Blindgyden.php',        $title='@Gå til ?'                  );
      if ($vis_lager)   menuKnap($h='32',$w=$knapW, $label='@Rapporter',         $link='../_lager/page_Beholdningsliste.php', $title='@Gå til Vare Rapporter'     );
      #                 menuKnap($h='32',$w=$knapW, $label='@Sikkerheds kopi',   $link='../_base/page_Blindgyden.php',        $title='@Gå til Gem/Hent sikkerhedskopi');
                        menuKnap($h='32',$w=$knapW, $label='DEMO',               $link='../_base/page_Layoutdemo.php',        $title='@Demonstration af output-moduler');
    echo '</div>';
    htm_FrstFelt('20%',0);
    htm_NextFelt('15%');  echo '<div style="font-size:10px; text-align:center;">'.'SALDI - Version '.$progvers.'</div>';          
    htm_NextFelt('30%');  echo '<div style="font-size:10px; text-align:center;">'.'<i>Copyright '.$copydate.' '.$copyright.'</i>'.'</div>';
    htm_NextFelt('15%');  echo '<div style="font-size:10px; text-align:center;">'.tolk('@Aktuelt sprog: ').$programSprog.'</div>';
    htm_NextFelt('20%');
    htm_LastFelt();
  echo '</p>';
  htm_RudeBund($pmpt=Tolk('@Gem'),$subm=false,$title='@Gem');
  Rude_FootMenu($doPrint=false, $doErase=false, $doLookUp=false, $doAccept=false, $doExport=false, $doImport=false, $OpslLabl='');
  echo '</PanlHead>';
}

# PROGRAM-MODUL;
function Rude_AdminMenu () {
  htm_Rude_Top($name='adminform',$capt='Indstillinger',$parms='../_base/page_Gittermenu.php',$icon='fa-bars',$klasse='panelW240',__FUNCTION__);
  $goBack= '';  # '?returside=../_base/menu.php';
  echo '<div style="text-align:center;">';
                menuKnap($h='22',$w='180',$label='@Moms',                 $link='../_systemdata/page_Syssetup.php',     $title='@Indstillinger angående moms');
  echo '<br>';  menuKnap($h='22',$w='180',$label='@Valuta',               $link='../_systemdata/page_Valuta.php',       $title='@Indstillinger angående valuta');
  echo '<br>';  menuKnap($h='22',$w='180',$label='@Debitor & Kreditor Grp.',$link='../_systemdata/page_Debkredgrup.php', $title='@Indstillinger angående grupper');
  echo '<br>';  menuKnap($h='22',$w='180',$label='@Afdelinger',           $link='../_systemdata/page_Afdelinger.php',   $title='@Indstillinger angående Afdelinger');
  echo '<br>';  menuKnap($h='22',$w='180',$label='@Projekter',            $link='../_systemdata/page_Projekter.php',    $title='@Indstillinger angående Projekter');
  echo '<br><hr>';  menuKnap($h='22',$w='180',$label='@Lagre',            $link='../_systemdata/page_Lagre.php',        $title='@Indstillinger angående Lagre');
  echo '<br>';  menuKnap($h='22',$w='180',$label='@Varegrupper',          $link='../_systemdata/page_Varegrupper.php',  $title='@Indstillinger angående Varegrupper');
  echo '<br>';  menuKnap($h='22',$w='180',$label='@Rabatgrupper',         $link='../_systemdata/page_Rabatgrupper.php', $title='@Indstillinger angående Rabatgrupper');
  echo '<br>';  menuKnap($h='22',$w='180',$label='@Enheder & materialer', $link='../_systemdata/page_Enheder.php',      $title='@Indstillinger angående registrede Enheder, beskrivelse og materiale');
  echo '<br><hr>';  menuKnap($h='22',$w='180',$label='@Stamdata',         $link='../_systemdata/page_Stamkort.php',     $title='@Indstillinger angående Stamdata');
  echo '<br>';  menuKnap($h='22',$w='180',$label='@Brugere',              $link='../_systemdata/page_Brugere.php',      $title='@Indstillinger angående Brugere');
  echo '<br>';  menuKnap($h='22',$w='180',$label='@Regnskabsår',          $link='../_systemdata/page_Regnskabsaar.php', $title='@Indstillinger angående Regnskabsår');
  echo '<br>';  menuKnap($h='22',$w='180',$label='@Formularer',           $link='../_systemdata/page_FormText.php',     $title='@Indstillinger angående Formularer');
  echo '<br>';  
  echo '<br>';  menuKnap($h='22',$w='180',$label='@Flere indstillinger',  $link='../_systemdata/page_Divsetup.php',  $title='@Diverse indstillinger');
  echo '<br></div>';
  htm_RudeBund($pmpt=Tolk('@Retur til hovedmenu'),$subm=true,$title='@Retur til hovedmenu');
};

# PROGRAM-MODUL;
function Rude_DiverseMenu () {
  htm_Rude_Top($name='adminform',$capt='Flere indstillinger',$parms='../_systemdata/page_Syssetup.php',$icon='fa-bars',$klasse='panelW240',__FUNCTION__);
  $goBack= '?returside=../_base/menu.php';
  echo '<div style="text-align:center;">';
                menuKnap($h='22',$w='180' ,$label='@Regnskabs navn m.v.',   $link='../_base/page_Blindgyden.php',  $title='@Indstillinger angående regnskabsnavn og mailserver for afsendelse af mail');
  echo '<br>';  menuKnap($h='22',$w='180' ,$label='@Provisionsberegning',   $link='../_base/page_Blindgyden.php',  $title='@Indstillinger angående Provisionsberegning');
  echo '<br>';  menuKnap($h='22',$w='180' ,$label='@Personlige valg',       $link='../_base/page_Blindgyden.php',  $title='@Indstillinger angående Farver og udseende m.v.');
  echo '<br>';  menuKnap($h='22',$w='180' ,$label='@Varerelateret',         $link='../_base/page_Blindgyden.php',  $title='@Indstillinger angående Varerelateret f.eks. varianter');
  echo '<br>';  menuKnap($h='22',$w='180' ,$label='@Prislister',            $link='../_base/page_Blindgyden.php',  $title='@Indstillinger angående Prislister');
  echo '<br><hr>';  menuKnap($h='22',$w='180' ,$label='@Rykkerrelateret',   $link='../_base/page_Blindgyden.php',  $title='@Indstillinger angående Rykkerrelaterede');
  echo '<br>';  menuKnap($h='22',$w='180' ,$label='@Aktivering af tilvalg', $link='../_base/page_Blindgyden.php',  $title='@Indstillinger angående aktivering af ekstra moduler m.v.');
  echo '<br>';  menuKnap($h='22',$w='180' ,$label='@Tjeklister',            $link='../_base/page_Blindgyden.php',  $title='@Indstillinger angående Tjeklister');
  echo '<br>';  menuKnap($h='22',$w='180' ,$label='@Bilagshåndtering',      $link='../_base/page_Blindgyden.php',  $title='@Indstillinger angående Bilagshåndtering');
  echo '<br>';  menuKnap($h='22',$w='180' ,$label='@Øredifferencer',        $link='../_base/page_Blindgyden.php',  $title='@Indstillinger angående Øredifferencer');
  echo '<br>';  menuKnap($h='22',$w='180' ,$label='@Massefakturering',      $link='../_base/page_Blindgyden.php',  $title='@Indstillinger angående Massefakturering');
  echo '<br><hr>';  menuKnap($h='22',$w='180' ,$label='@Program Sprog',     $link='../_base/page_Blindgyden.php',  $title='@Indstillinger angående programmets Sprog');
  echo '<br>';  menuKnap($h='22',$w='180' ,$label='@Formular Sprog',        $link='../_base/page_Blindgyden.php',  $title='@Indstillinger angående Sprog på blanketter');
  echo '<br>';  menuKnap($h='22',$w='180' ,$label='@Data import & eksport', $link='../_base/page_Blindgyden.php',  $title='@Importér / eksportér: Kontoplan, Formularer, Debitorer, Kreditorer, Varer, og Dataudtræk');
  echo '<br><br></div>';
  htm_RudeBund($pmpt=Tolk('@Retur til indstillinger'),$subm=true,$title='@Retur til indstillingsmenu');
};

# PROGRAM-MODUL;
function Rude_FootMenu($doPrint=true, $doErase=true, $doLookUp=true, $doAccept=true, $doExport=true, $doImport=true, $OpslLabl='') {
  echo '<div class="clearWrap"/>';  echo '<PanlFoot>';
    Foot_Links($maxi=true, '<a style="color:#900000" href="'.$link='http://www.ev-soft.dk/saldi-wiki/doku.php?id=saldi:manualen '.'" target="_blank">'.
    '<u title="'.tolk('@Manual og anden hjælp finder du på SALDI-wiki').'">'. tolk('@SALDI-wiki med manual').'</u></a>',
    $doPrint, $doErase, $doLookUp, $doAccept, $doExport, $doImport, $OpslLabl);
  echo '</PanlFoot>';
}

# PROGRAM-MODUL;
function SprogValg(&$programSprog) {#global $programSprog;
# Disse sprog-tekster skal IKKE oversættes, da de skal forstås af udlændinge.
# echo '<divline><form>';
# echo '<small>'.tolk('@Aktuelt sprog: ').$programSprog.'</small>';
  htm_OptioFlt($type='text', $name='progsprog', $valu="$programSprog", 
      $titl= '@Hvilket sprog vil du indstille programmet til ? <br> (Virker ikke endnu)', 
      $labl= '@Program sprog', $revi=true, $optlist= array( # [0]:Tip [1]:value [2]:Text  [3]:events
      ['Vælg dansk sprog',                'da','Dansk',       ],  #'onclick=\'$programSprog="da"\''],  #    ],  #
      ['Select English language',         'en','English',     ],  #'onclick=\'$programSprog="en"\''],  #    ],  #
      ['Wählen Sie deutsche Sprache',     'de','Deutsch',     ],  #'onclick=\'$programSprog="de"\''],  #    ],  #
      ['Choisissez la langue française',  'fr','Français',    ],  #'onclick=\'$programSprog="fr"\''],  #    ],  #
      ['Türk Dili seçin',                 'tr','Türkçe',      ],  #'onclick=\'$programSprog="tr"\''],  #    ],  #
      ['Elegir el idioma español',        'es','Español',     ])  #'onclick=\'$programSprog="es"\''])  #    ])  #
      ,$action= '$programSprog= $_POST["'.$name.'"];'
#     ,$events='onchange="$programSprog= $_POST["progsprog"];" onBlur="window.location.reload();"');
      ,$events='onchange="this.form.submit();" onBlur="window.location.reload();"');
# return $_POST["progsprog"];
# if (isset($_POST["progsprog"])) $programSprog = $_POST["progsprog"];
# $programSprog= $_POST['progsprog'];
#   htm_accept('@Benyt','@Aktiver sprog',''); # ($labl='',$title='')
# echo '</form></divline>';
}

# PROGRAM-MODUL;
function Rude_DBsetup (&$db_type,&$db_encode,&$db_navn,&$db_bruger,&$db_password,&$adm_navn,&$adm_password,&$verify_adm_password) {global $ØButtnBgrd, $ØButtnText; 
  htm_Rude_Top($name='opret',$capt='SALDI <small> € :</small> '.Tolk('@Database setup'),$parms='db_setup.php',$icon='fa-wrench',$klasse='panelW320',__FUNCTION__);
  htm_OptioFlt($type='text',  $name='db_type',    $valu= $db_type,  
                    $titl='@Vælg den databaseserver type, du ønsker at bruge.', 
                    $labl='@Databaseserver',  $revi=true, $optlist= array(
                    ['','PostgreSQL','PostgreSQL'],
                    ['','MySQL','MySQL']),$action='');
  htm_OptioFlt($type='text',  $name='db_encode',    $valu= $db_encode,  
                    $titl='@Vælg det tegnsæt du ønsker at bruge. Nyere versioner af PostgreSQL fungerer kun med UTF8',  
                    $labl='@Tegnsæt',         $revi=true, $optlist= array(
                    ['','UTF8','UTF8'],
                    ['','LATIN9','LATIN9']),$action='');
  htm_CombFelt($type='text',  $name='db_navn',      $valu= $db_navn,      $titl='@Ønsket navn på din hoveddatabase for SALDI. F.eks.: [saldi-db]',  $labl='@Databasenavn',  
               $revi=true, $rows='2',$width='',$step='', $more='required placeholder="'.tolk('@Udfyld...').'"');
  htm_CombFelt($type='text',  $name='db_bruger',    $valu= $db_bruger,    $titl=tolk('@Navn på en bruger, som i forvejen har tilladelse til at oprette, rette og slette databaser. ').'<br>'.
                              tolk('@Typisk er det for PostgreSQL brugeren [postgres] og for MySQL brugeren [root].'),                              $labl='@Aktiv databaseadministrator', 
               $revi=true, $rows='2',$width='',$step='', $more=' required placeholder="'.tolk('@Udfyld...').'"');
  htm_CombFelt($type='password',  $name='db_password',  $valu= $db_password,  $titl='@Adgangskode for ovenstående bruger',                          $labl='@Adgangskode for databaseadministrator', 
               $revi=true, $rows='2',$width='',$step='', $more='required placeholder="'.tolk('@Password...').'"');
  htm_CombFelt($type='text',  $name='adm_navn',     $valu= $adm_navn,     $titl='@Ønsket navn på din SALDI-administratorkonto til dit SALDI-system. F.eks.: [saldi-admin]',  $labl='@SALDI-administratorens brugernavn', 
               $revi=true, $rows='2',$width='',$step='', $more='required placeholder="'.tolk('@Udfyld...').'"');
  
# echo '<form>';
    htm_CombFelt($type='passwordpower', $name='passwordpwr',  $valu= $adm_password, 
                $titl='@Ønsket adgangskode for SALDI-administratoren af dit SALDI-system',  $labl='@SALDI-administratorens adgangskode',  
                $revi=true, $rows='2',$width='',$step='', $more='required placeholder="'.tolk('@Password...').'"');
    htm_CombFelt($type='password',  $name='confirm_password', $valu= $verify_adm_password,  
                $titl='@Verificering af ovenstående adgangskode',                           $labl='@Gentag SALDI-administratorens adgangskode', 
                $revi=true, $rows='2',$width='',$step='', $more='required placeholder="'.tolk('@Gentag...').'"');
    echo '<div align= "center"><button type="submit" name="submit" class="tooltip" style="margin: 1px 1px; padding: 1px 3px; background:'.$ØButtnBgrd.'; color:'.$ØButtnText.';" ">'.
          tolk('@Kontrollèr Administrators Passwords').'<span class="tooltiptext">'.tolk('Test om de indtastede password er ens.').'</span></button></div>';
# echo '</form>';
  
  echo '<hr>';
  echo '<div style="text-align:left"><small><b>'.tolk('@Alle').'</b> '.tolk('@felter skal udfyldes og kontrolleres.').' <br>&nbsp;&nbsp;<br>';
  echo '<b>'.tolk('@Tip:').'</b> '.tolk('@Hold musen over blå tekster, for at få hjælpetip.').'</small></div>';
  echo '<br><div style="text-align:left"><small><b>'.tolk('@HUSK:').'</b> '.tolk('@Skrivebeskyt alle mapper på serveren, på nær: ').
       '<br>../temp ../includes ../logolib og undermapper heri.<br>(../temp, ../_config og ../_export-import) </small></div>';
  htm_RudeBund($pmpt=Tolk('@Installér'),$subm=true,$title='@Klik her for at oprette dit SALDI database-system');
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
function Rude_install (&$db_type,&$db_encode,&$db_navn,&$db_bruger,&$db_password,&$adm_navn,&$adm_password,&$verify_adm_password) { 
# Test:
  if ($fp=fopen("../includes/connect.php","a")) { fclose($fp); $inc='checked';} else $inc.='';
  if ($fp=fopen("../temp/test.txt","w"))        { fclose($fp); $tmp='checked';} else $tmp.='';
  if ($fp=fopen("../logolib/test.txt","w"))     { fclose($fp); $lgo='checked';} else $lgo.='';
  if (extension_loaded('mysqli'))     {if ($link= mysqli_connect("")) {$mq= 'checked'; mysqli_close($link);} else $mq= '';} else $mq= '';
  if (extension_loaded('PostgreSQL')) {if (pg_connect(""))            {$pg= 'checked'; pg_close();}          else $pg= '';} else $pg= '';
  $sec = isSecure();
  htm_Rude_Top($name='opret',$capt= Tolk('@Før installation'),$parms='db_setup.php',$icon='fa-wrench',$klasse='panelW320',__FUNCTION__);
# echo '<div style="text-align: center"><img src= "../images/SALDIe50x150.png" alt="Saldi Logo" style="width:120px;heigth:80px;"></div><br>';
  echo '<div style="text-align:left"><small>'.'<b>'.
      tolk('@Nødvendig forberedelse:').'</b><br> '.
      tolk('@En Apatche webserver med PHP skal være i drift.').' <br>'.
      tolk('@På serveren skal være installeret en af databaseserverne PostgreSQL eller MySQL/MariaDB.').'<br>';
  htm_FrstFelt('50%');  
  htm_CheckFlt($type='checkbox',$name='pg', $valu= '',  $titl='@Systemet kontrollerer om modulet er tilgængeligt. (skal testes!)',  $labl='@Postgres findes.',  $revi=false, $more=' '.$pg);
  htm_NextFelt('50%');  
  htm_CheckFlt($type='checkbox',$name='mysql',    $valu= '',  $titl='@Systemet kontrollerer om modulet er tilgængeligt. (skal testes!)',  $labl='@MySQL findes.', $revi=false, $more=' '.$mq);
  htm_LastFelt();
  echo '<hr>'.tolk('@Hvis systemet ikke køres på lokalnet, bør det ske via en sikker krypteret forbindelse:');
  htm_CheckFlt($type='checkbox',$name='https',  $valu= isSecure(),  $titl='@Systemet kontrollerer om HTTPS er benyttet. (skal testes!)',  $labl='@HTTPS er aktiv.', $revi=false, $more=' '.$sec);
  echo '</div><hr>'.
      tolk('@Pakken med SALDI-filer, udpakkes i et arbejdskatalog med adgang for webbesøgende.').'<br><br>'.
      tolk('@Der skal være skriveadgang til 3 under-mapper:').'<br>';
  htm_FrstFelt('33%');
    htm_CheckFlt($type='checkbox',$name='incl',   $valu= '',  $titl='@Systemet kontrollerer om mappen er skrivbar', $labl='includes', $revi=false,$more=$inc);
  htm_NextFelt('33%');
    htm_CheckFlt($type='checkbox',$name='temp',   $valu= '',  $titl='@Systemet kontrollerer om mappen er skrivbar', $labl='temp',     $revi=false,$more=$tmp);
  htm_NextFelt('33%');
    htm_CheckFlt($type='checkbox',$name='llib',   $valu= '',  $titl='@Systemet kontrollerer om mappen er skrivbar', $labl='logolib',    $revi=false,$more=$lgo);
  htm_LastFelt();
  echo tolk('@Alle andre mapper skal være skrivebeskyttet!');
//      .'<hr><b>PHP </b>'. tolk('@skal understøtte modulerne: mcrypt og hash, som benyttes til at håndtere passwords sikkert.').'<br>';
//  htm_FrstFelt('50%');  
//  htm_CheckFlt($type='checkbox',$name='hash',   $valu= '',  $titl='@Systemet kontrollerer om modulet er tilgængeligt',  $labl='@hash installeret.', $revi=false,$more='checked="'.extension_loaded('hash').'"');
//  htm_NextFelt('50%');  
//  htm_CheckFlt($type='checkbox',$name='mcrypt', $valu= '',  $titl='@Systemet kontrollerer om modulet er tilgængeligt',  $labl='@mcrypt installeret.', $revi=false,$more='checked="'.extension_loaded('mcrypt').'"');
//  htm_LastFelt();
  echo '<hr>'.
      tolk('@For at udnytte alle udskrivnings faciliteter, skal serveren understøtte ekstra PDF/Grafik-programmer.').' <br>'. '<br><b>Ghostscript & ps2pdf</b> '.
      tolk('@for at kunne udskrive.').'<br><b>ImageMagic</b> '.
      tolk('@er nødvendig for at flette udskrift med Logo.'). '<br><b>PDFtk</b> - '.
      tolk('@The PDF Toolkit: flette pdf-baggrund med side.');
  echo '<hr><div style="text-align:left">'.
      tolk('@Bemærkt også, at').' <b>javascript</b> '.
      tolk('@skal være aktiveret !');
  echo '<hr>'.
      tolk('@Oprettelse af regnskab, sker senere, når du 1. gang logger ind, som SALDI-administrator.').'<br><br>'.
      tolk('@På SALDI-wiki kan du læse opdaterede informationer.');
  echo '</small></div>';
  htm_RudeBund($pmpt=Tolk('@Installér'),$subm=false,$title='@Klik her for at oprette dit SALDI database-system');
}

function Rude_InstallFail($noskriv) {
  htm_Rude_Top($name= 'opret', $capt= Tolk('@Installation fejler!'), $parms='db_setup.php', $icon='fa-wrench', $klasse='panelW320',__FUNCTION__);
    echo '<b>'.tolk('@Problem:').'</b><br>';
    echo tolk('@Der er ikke skriveadgang til kataloget:'),' "'.$noskriv.'"<br>';
    // if (extension_loaded('mcrypt') && extension_loaded('hash')) { $ext_loaded=true;  }
    if ($noskriv=="includes") 
    echo tolk('@hvor "connect.php" skal oprettes.').'<br><br>';
    echo tolk('@Sørg for at der er skriveadgang for Webbrugere, til katalogerne').': "includes", "temp", "logolib" <br><br>';
    echo tolk('@Se hvordan i installeringsvejledningen INSTALLATION.txt.').' <br><br>';
  htm_RudeBund($pmpt= Tolk('@Installér'),$subm=false,$title='@Klik her for at oprette dit SALDI database-system');
}

function Rude_InstallSucces(&$db_navn, &$adm_navn) {
  htm_Rude_Top($name='oprettet',$capt= Tolk('@Databasen er installeret'),$parms='',$icon='fa-wrench',$klasse='panelW320',__FUNCTION__);
    echo '<b>'.tolk('@Bravo:').'</b><br>';
    echo tolk('@Dit SALDI-system er nu oprettet. Det første, du nu skal gøre, er at oprette et regnskab.').'<br><br>';
    echo tolk('@Det gøres ved at loggge ind med: ').'<br>[<b>'.$db_navn.'</b>] '.tolk('@som regnskab,').' <br>[<b>'.$adm_navn.'</b>] ';
    echo tolk('@som brugernavn og med den valgte adgangskode').'<br><br>';
    echo tolk('@Tegn en hotline-aftale, så kan du ringe eller sende en e-mail og få hurtigt svar på spørgsmål om brugen af SALDI.').'<br><br>';
    echo tolk('@Se mere på').' <a href="http://saldi.dk/hotline" target="_blank">http://saldi.dk/hotline</a> <br>';
//    echo '<p>&nbsp;</p><br>';
//    echo '<p><a href="../_base/index.php" title="Til SALDI-administratorsiden hvor regnskaber administreres" <br>';
//    echo ' style="text-decoration:none"><input type="button" value="Fortsæt"></a><br><br>';
  htm_RudeBund($pmpt=Tolk('@Fortsæt'),$subm=true,$title='@Fortsæt til logind og oprettelse af 1. regnskab');
}

# PROGRAM-MODUL;
function Rude_Login (&$regnskab,&$brugernavn,&$brugerkode,&$ProgVers,&$LnkHelp,&$OrgaName,&$Logo) { 
  $FaLogo= '../images/'.$Logo;
  htm_Rude_Top($name='logiform',$capt=Tolk('@Logind til').' <i>'.$regnskab.'</i>',$parms='',$icon='fa-key',$klasse='panelW320',__FUNCTION__); # < ? php echo htmlspecialchars($_SERVER["PHP_SELF"]);? >
  echo '<table width="100%";cellspacing="0"><tr align="center">';
  if (file_exists($FaLogo)) 
    echo '<tr align="center"><td colspan="3"; height="40px"><img style="border:0px solid;width:120px;heigth:80px" alt="LOGO" src="'.$FaLogo.'"></td></tr>';
  echo '<td> <small><small>SALDI'.'</small></small></td>';
  echo '<td align="center">'.ucfirst(tolk('@Vært:')).'&nbsp; <b>'.$OrgaName.'</b></td>';
  echo '<td align="right"><small><small>Vers.'.$ProgVers.'</small></small> </td>';
  echo '<tr align="center"><td colspan="3">'.$LnkHelp.'</td></tr>';
  echo '</tr></table><br>';

  htm_CombFelt($type='text',    $name='regn', $valu= $regnskab,   $titl='@Angiv navnet på det Regnskab, som du har adgang til', $labl='@Regnskab',    $revi=true, $rows='2',$width='',$step='', $more='required="required" placeholder="'.tolk('@Regnskab...').'"');
  htm_CombFelt($type='text',    $name='navn', $valu= $brugernavn, $titl='@Angiv dit SALDI Brugernavn',                          $labl='@Brugernavn',  $revi=true, $rows='2',$width='',$step='', $more='required="required" placeholder="'.tolk('@Bruger...').'"');
  htm_CombFelt($type='password',$name='kode', $valu= $brugerkode, $titl='@Angiv Adgangskoden svarende til Brugernavnet',        $labl='@Adgangskode', $revi=true, $rows='2',$width='',$step='', $more='required="required" placeholder="'.tolk('@Password...').'"');
  echo '<div style="text-align: center"><br><small><small> /da:Sprog/en:Language/de:Sprache/fr:Langue/tr:Dil/es:Lenguaje</small></small></div>';
  SprogValg($programSprog);
  echo '<hr>';
  echo '<p align="center"><a href="'.$link=''.'"><u title="'.tolk('@Få tilsendt mail angående resat password').'">'.  tolk('@Glemt adgangskode?').'</u></a></p>';
  htm_RudeBund($pmpt=Tolk('@Log ind'),$subm=true,$title='@Gå videre til SALDI regnskabet');
}

# PROGRAM-MODUL;
function Rude_Kunden (&$kontonr, &$kategori, &$cvrnr, &$eannr, &$bankreg, &$bankkto, &$instit, &$ansv, &$formsprog, &$homeweb) { 
  htm_Rude_Top($name='kundform',$capt='@Kunden (debitor):',$parms='',$icon='fa-user',$klasse='panelWmax',__FUNCTION__);
  htm_CombFelt($type='text',  $name='DBix',   $valu= $kontonr,  $titl='@Kundenr: Kan ikke rettes. Systemet styrer dette', $labl='@Kundenr.',  $revi=false);
  htm_RadioGrp($type='hori',  $name='Ktyp',                     $titl='@Kunde kategori',          $labl='@Kundetype', 
              $optlist= array(['privat','@Privat','@eller'],['erhverv','@Erhverv','']),$action='');
  $Erhv= 'placeholder="...'.tolk('@kun erhverv').'..."';
  htm_CombFelt($type='text',  $name='CVR',    $valu= $cvrnr,    $titl='@CVR - Virksomheds ID',    $labl='@CVR',             $revi=true,'','','',$Erhv);
  htm_CombFelt($type='text',  $name='EAN',    $valu= $eannr,    $titl='@EAN - E-betalings ID',    $labl='@EAN',             $revi=true,'','','',$Erhv);
  htm_FrstFelt('30%');
    htm_CombFelt($type='text',$name='bankreg',$valu= $bankreg,  $titl='@Bank reg.',               $labl='@Bank reg.',       $revi=true);  
  htm_NextFelt('70%');
    htm_CombFelt($type='text',$name='bankkto',$valu= $bankkto,  $titl='@Bank konto',              $labl='@Bank konto',      $revi=true);  
  htm_lastFelt();
  htm_CombFelt($type='text',  $name='inst',   $valu= $instit,   $titl='@Supplerende oplysning',   $labl='@Institution',     $revi=true,'','','',$Erhv);
  htm_CombFelt($type='text',  $name='ansv',   $valu= $ansv,     $titl='@Kundeansvarlig',          $labl='@Kundeansvarlig',  $revi=true);
  htm_CombFelt($type='text',  $name='sprog',  $valu= $formsprog,$titl='@Sproget som skal benyttes på faktura udskrifter',   $labl='@Faktureringssprog', $revi=true,'','','','placeholder="...'.tolk('@hvis sproget ikke er dansk').'..."');
  htm_CombFelt($type='text',  $name='homeweb',$valu= $homeweb,  $titl='@Kundens hjemmeside',      $labl='@Hjemmeside',      $revi=true,'','','',$Erhv);
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem');
}

# PROGRAM-MODUL;
function Rude_Betingelser (&$debigrup, &$betaling, &$frist, &$print2, &$kunderef    /* ,&$betalingsbet,&$fristdage */ ) { 
  #if ($betalingsbet=='@Kontant'||$betalingsbet=='@Efterkrav'||$betalingsbet=='@Forud'||$betalingsbet=='@Kreditkort') $fristdage='';  else $fristdage=0;
  htm_Rude_Top($name='betaform',$capt=tolk('@Betingelser:'),$parms='',$icon='fa-credit-card',$klasse='panelWmax',__FUNCTION__); # ' <text color: "gray">&#x00A7;</text>  '.
  htm_OptioFlt($type='text',  $name='debigrup',   $valu= $debigrup, 
                    $titl='@Vælg hvilken gruppe kunden tilhører', 
                    $labl='@Debitorgruppe',     $revi=true, $optlist= array(
                    ['','@1. Danske debitorer',     '@1. Danske debitorer'],
                    ['','@2. Europæiske debitorer', '@2. Europæiske debitorer']),$action='');
  htm_OptioFlt($type='text',  $name='betaling',   $valu= $betaling,   
                    $titl='@Hvordan skal der betales',  
                    $labl='@Betalings metode',  $revi=true, $optlist= array(
                    ['','Kontant',    '@Kontant'],
                    ['','Efterkrav',  '@Efterkrav'],
                    ['','Forud',      '@Forud'],
                    ['','Kreditkort', '@Kreditkort'],
                    ['','Konto',      '@Konto']),$action='');
  htm_OptioFlt($type='text',  $name='frist',      $valu= $frist,      
                    $titl='@Hvor lang frist er der til betaling', 
                    $labl='@Betalings frist',   $revi=true, $optlist= array(
                    ['','0','@Straks'],
                    ['','8','@8 dage'],
                    ['','14','@14 dage'],
                    ['','30','@30 dage']),$action='');
  htm_OptioFlt($type='text',  $name='print2',   $valu= $print2,
                    $titl='@Vælg på hvilken måde skal dokumentet udskrives, gemmes eller sendes.',  
                    $labl='@Udskriv til',       $revi=true, $optlist= array(
                    ['@Fil i pdf-format','pdf','@PDF-fil'],
                    ['@Elektronisk forsendelse','email','@email'],
                    ['@Elektronisk fakturering','ioubl','@OIOUBL'],
                    ['@PBS faktura','pbs','@PBS']),$action='');
  htm_CombFelt($type='text',  $name='kunderef',   $valu= $kunderef, $titl='@f.eks. Rekvisitions NR',  $labl='@Kundens referance', $revi=true);
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem');
}

# PROGRAM-MODUL;
function Rude_Kontakter () {
  htm_Rude_Top($name='betaform',$capt='   '.tolk('@Kontakt info:'),$parms='',$icon='fa-phone-square',$klasse='panelW320',__FUNCTION__);
  Kontakt($posi=1, $kontakt='Anders', $telf, $mobil, $mail);
  Kontakt($posi=2, $kontakt='Andersine', $telf, $mobil, $mail);
  echo '<hr>';
  echo '<div class="centrer">'; htm_accept('@Opret Ny','@Opret en ny kontakt'); echo '</div>';
  htm_RudeBund($pmpt='@Gem rettelser',$subm=true,$title='@Gem evt. rettelser ovenfor');
}

function Kontakt (&$posi, &$kontakt, &$telf, &$mobil, &$mail) {
  htm_FrstFelt('14%',0);
    htm_CombFelt($type='text',  $name='posi',   $valu= $posi,   $titl='@Angiv position',        $labl='@Pos.',    $revi=true, $rows='',$width='45',$step='0.5');
  htm_NextFelt('40%');  
    htm_CombFelt($type='text',  $name='kontakt',$valu= $kontakt,$titl='@Angiv Kontakt person',  $labl='@Kontakt person',  $revi=true,$rows='',$width='45');
  htm_NextFelt('23%');
    htm_CombFelt($type='text',  $name='telf',   $valu= $telf,   $titl='@Angiv Telefon',         $labl='@Telefon', $revi=true, $rows='',$width='45');
  htm_NextFelt('23%');        
    htm_CombFelt($type='text',  $name='mobil',  $valu= $mobil,  $titl='@Angiv Mobilnr.',        $labl='@Mobil',   $revi=true, $rows='',$width='45');
  htm_LastFelt();       
  htm_CombFelt(  $type='mail',  $name='mail',   $valu= $mail,   $titl='@Angiv E-mail',          $labl='@E-mail',  $revi=true, $rows='');
  echo '<div class="centrer">'; htm_accept('@Slet','@Fjern denne kontakt person'); echo '</div>';
  echo '<hr color="green">';
}

# PROGRAM-MODUL;
function Rude_Fakturering (&$navn, &$addr, &$sted, &$ponr, &$by, &$land, &$noter, &$telf, &$att, &$email, &$usemail, &$faktdato) {
  htm_Rude_Top($name='faktform',$capt='@Kunde - Fakturering:',$parms='',$icon='fa-pencil-square-o','panelWmax',__FUNCTION__);
  htm_CombFelt($type='text',    $name='navn', $valu= $navn,   $titl='@Angiv Kunde Navn',            $labl='@Kunde navn',      $revi=true);
  htm_CombFelt($type='text',    $name='addr', $valu= $addr,   $titl='@Angiv Faktura Adresse',       $labl='@Faktura adresse', $revi=true);
  htm_FrstFelt('25%');  
    htm_CombFelt($type='text',  $name='ponr', $valu= $ponr, $titl='@Angiv Faktura Kunde postnr',  $labl='@Postnr',          $revi=true);
  htm_NextFelt('75%');  
    htm_CombFelt($type='text',  $name='by',   $valu= $by,   $titl='@Angiv Faktura Kunde Bynavn',  $labl='@Faktura By',      $revi=true);
  htm_lastFelt(); 
  htm_CombFelt($type='text',    $name='sted', $valu= $sted,   $titl='@Angiv Faktura Kunde Sted',    $labl='@Faktura Sted',    $revi=true);
  htm_CombFelt($type='text',    $name='land', $valu= $land,   $titl='@Angiv Faktura Kunde Land',    $labl='@Faktura Land',    $revi=true);
  htm_CombFelt($type='area',    $name='noter',$valu= $noter,  $titl='@Angiv Bemærkninger',          $labl='@Bemærkninger',    $revi=true, $rows='1');
  htm_CombFelt($type='text',    $name='telf', $valu= $telf,   $titl='@Angiv Kunde Telefon',         $labl='@Telefon(er)',     $revi=true);
  htm_CombFelt($type='text',    $name='att',  $valu= $att,    $titl='@Angiv Kunde Attention',       $labl='@Attention',       $revi=true);
  htm_CombFelt($type='mail',    $name='email',$valu= $email,  $titl='@Angiv Kunde Email adresse',   $labl='@Kundens Email adresse',$revi=true);
  htm_FrstFelt('50%');  
    htm_CheckFlt($type='checkbox',$name='useMail', $valu= $usemail,  $titl='@Send faktura med mail', $labl='@Benyt mail',$revi=true);
  htm_NextFelt('50%');  
    htm_CombFelt($type='date',  $name='faktdato',  $valu= $faktdato, $titl='@Fakturerings dato',     $labl='@Faktura Dato',$revi=true);
  htm_LastFelt();
  htm_RudeBund($pmpt='@Fakturér',$subm=true,$title='@Fakturer og udskriv til den under {Betingelser}, valgte udskriver!');
}

# PROGRAM-MODUL;
function Rude_Ordreinfo (&$valuta, &$vorref, &$afdel, &$ordrdato, &$genfdato, &$godkendt, &$optlist) {
$optlist= array(['','DKK','DKK'],['','AED','AED'],['','EUR','EUR'],['','USD','USD']);
  htm_Rude_Top($name='ordrform',$capt='@Ordreinfo:',$parms='',$icon='fa-eur','panelWmax',__FUNCTION__);
  htm_OptioFlt($type='text',    $name='valuta',   $valu= $valuta,   $titl='@Valuta som ordren skal benytte',  $labl='@Valuta',  $revi=true,
               $optlist= array(['','DKK','DKK'],['','AED','AED'],['','EUR','EUR'],['','USD','USD']),  $action='');
  htm_CombFelt($type='text',    $name='vorref',   $valu= $vorref,   $titl='@Sælgers referance',               $labl='@Vor referance', $revi=true);
  htm_CombFelt($type='text',    $name='afdel',    $valu= $afdel,    $titl='@Sælgers afdeling',                $labl='@Afdeling',      $revi=true);
  htm_FrstFelt('50%');        
    htm_CombFelt($type='date',  $name='ordrdato', $valu= $ordrdato, $titl='@Datoen hvor ordren indgik',       $labl='@Ordre Dato',    $revi=true);
  htm_NextFelt('50%');  
    htm_CombFelt($type='date',  $name='genfdato', $valu= $genfdato, $titl='@Husk fremtidigt fakturerings tidspunkt',  $labl='@Genfakturerings Dato',$revi=true);
  htm_LastFelt();
  htm_CheckFlt($type='checkbox',$name='godkendt',$valu= $godkendt,$titl='@Ordren er godkendt hvis feltet er afmærket',$labl='@Godkendt',$revi=true);
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem data i denne rude.');
}

# PROGRAM-MODUL;
function Rude_Levering ($navn, $addr, $sted, $ponr, $by, $land, $telf, $kont, $email, $forsend, $noter, $afsendt, $levdato) {
  htm_Rude_Top($name='leveform',$capt='@Levering:',$parms='',$icon='fa-truck','panelWmax',__FUNCTION__);
  htm_CheckFlt($type='checkbox',$name='somfakt',  $valu= $somfakt,  $titl='@Afmærk her, hvis leverings adresse er den samme som faktura adresse', 
                                                                                                                        $labl='@Levering til faktura-adresse',$revi=true);
  htm_CombFelt($type='text',    $name='levnavn',      $valu= $navn,     $titl='@Angiv Modtager Navn',                   $labl='@Modtager navn',               $revi=true);
  htm_CombFelt($type='text',    $name='levaddr1',     $valu= $addr,     $titl='@Angiv Leverings Adresse',               $labl='@Leverings adresse',           $revi=true);
  htm_CombFelt($type='text',    $name='sted',         $valu= $sted,     $titl='@Angiv Leverings Sted',                  $labl='@Sted',                        $revi=true);
  htm_FrstFelt('25%');                                                                                                  
    htm_CombFelt($type='text',  $name='levpostnr',    $valu= $ponr,     $titl='@Angiv Leverings Kunde postnr',          $labl='@Postnr',                      $revi=true);
  htm_NextFelt('75%');                                                                                                  
    htm_CombFelt($type='text',  $name='levby',        $valu= $by,       $titl='@Angiv Leveringsstedets Bynavn',         $labl='@Leverings by',                $revi=true);
  htm_lastFelt();                                                                                                       
  htm_CombFelt($type='text',    $name='land',         $valu= $land,     $titl='@Angiv Leverings Land',                  $labl='@Leverings Land',              $revi=true);
  htm_CombFelt($type='text',    $name='levtelf',      $valu= $telf,     $titl='@Angiv Modtagers Telefon',               $labl='@Telefon(er)',                 $revi=true);
  htm_CombFelt($type='text',    $name='levkont',      $valu= $kont,     $titl='@Angiv Kontaktpersons Navn',             $labl='@Kontaktperson',               $revi=true);
  htm_CombFelt($type='mail',    $name='levemail',     $valu= $email,    $titl='@Angiv Modtagers Email adresse',         $labl='@Modtagerens Email adresse',   $revi=true);
  htm_CombFelt($type='text',    $name='forsendelse',  $valu= $forsend,  $titl='@Angiv Forsendelses oplysninger',        $labl='@Fragtmetode)',                $revi=true);
  htm_CombFelt($type='area',    $name='levnoter',     $valu= $noter,    $titl='@Angiv Noter til fragtmand',             $labl='@Noter til fragtmand',         $revi=true, $rows='1');
  htm_FrstFelt('50%');
    htm_CheckFlt($type='checkbox',$name='afsendt',$valu= $afsendt,  $titl='@Afmærk her når varen/ydelsen er afsendt',   $labl='@Afsendt',                     $revi=true);
  htm_NextFelt('50%');  
    htm_CombFelt($type='date',$name='levdato',    $valu= $levdato,  $titl='@evt. forsendelses dato',                    $labl='@Leverings Dato',              $revi=true);
  htm_LastFelt();
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem data i denne rude.');
}

# PROGRAM-MODUL;
function Rude_Ekstrafelter (&$felt1, &$felt2, &$felt3, &$felt4, &$felt5) {
  htm_Rude_Top($name='feltform',$capt='@Ekstrafelter:',$parms='',$icon='fa-plus','panelWmax',__FUNCTION__);
  htm_CombFelt($type='text',$name='felt1',  $valu= $felt1,  $titl='@Udfyld Felt 1',       $labl='@Ordre Felt 1',  $revi=true);
  htm_CombFelt($type='text',$name='felt2',  $valu= $felt2,  $titl='@Udfyld Felt 2',       $labl='@Ordre Felt 2',  $revi=true);
  htm_CombFelt($type='text',$name='felt3',  $valu= $felt3,  $titl='@Udfyld Felt 3',       $labl='@Ordre Felt 3',  $revi=true);
  htm_CombFelt($type='text',$name='felt4',  $valu= $felt4,  $titl='@Udfyld Felt 4',       $labl='@Ordre Felt 4',  $revi=true);
  htm_CombFelt($type='text',$name='felt5',  $valu= $felt5,  $titl='@Udfyld Felt 5',       $labl='@Ordre Felt 5',  $revi=true);
  htm_RudeBund($pmpt='@Gem',$subm=false,$title='@Gem');
}

# PROGRAM-MODUL;
function Rude_Mailfaktura (&$emne, &$text, &$vedhft) {
  htm_Rude_Top($name='mailform',$capt='@Mail faktura:',$parms='',$icon='fa-envelope-o','panelWmax',__FUNCTION__);
  htm_CombFelt($type='text',$name='emne',   $valu= $emne,   $titl='@Angiv Mail emne',     $labl='@Mail emne',   $revi=true);
  htm_CombFelt($type='area',$name='text',   $valu= $text,   $titl='@Angiv Mail tekst',    $labl='@Mail tekst',  $revi=true, $rows='2');
  htm_CombFelt($type='text',$name='vedhft', $valu= $vedhft, $titl='@Angiv Vedhæftet fil', $labl='@Mail bilag',  $revi=true);
  htm_RudeBund($pmpt='@Gem',$subm=false,$title='@Gem');
}

# PROGRAM-MODUL;
function Rude_Ydelser ($fakt) {
  htm_Rude_Top($name='yderform',$capt=tolk('@Ydelser / Produkter:').' <small>(Smal-format)</small>',$parms='',$icon='fa-shopping-cart','panelWmax',__FUNCTION__);
  Varelinie($posi=1,$varenr="45-876",$antal=1,$enhed="stk",$beskriv="Redekasser",$momssats=25,$pris=235.50,$rabat=20, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);
  Varelinie($posi=2,$varenr="45-876",$antal=2,$enhed="stk",$beskriv="Redekasser",$momssats=25,$pris=235.50,$rabat=20, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);
  Varelinie($posi=3,$varenr="45-877",$antal=3,$enhed="stk",$beskriv="Redekasser",$momssats=25,$pris=245.00,$rabat=20, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);
  Varelinie($posi=4,$varenr="45-876",$antal=3,$enhed="stk",$beskriv="Redekasser",$momssats=25,$pris=235.50,$rabat=20, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);
    htm_CheckFlt($type='checkbox', $name='fakt', $valu= $fakt, $titl='@Når ordren er faktureret, afmærkes feltet automatisk',$labl='@Er Faktureret og låst',$revi=false);
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem data i denne rude.');
}

# PROGRAM-MODUL;
function Rude_YdelserWide ($fakt) {
  echo '<div class="clearWrap"/>';  echo '<PanlFoot>';  
  htm_Rude_Top($name='linkform',$capt=tolk('@Ydelser / Produkter på salgsordren.').' <small>(Bredformat)</small>'.' ',$parms='',$icon='fa-shopping-cart','panelWmax',__FUNCTION__);
    VarelinieWide($posi=1, $varenr='45-876', $antal=3, $enhed='stk', $beskriv='Redekasser', $momssats=25, $pris=235.50, $rabat=8, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);     
    VarelinieWide($posi=2, $varenr='45-876', $antal=2, $enhed='stk', $beskriv='Redekasser', $momssats=25, $pris=235.50, $rabat=8, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);     
    VarelinieWide($posi=3, $varenr='45-876', $antal=3, $enhed='stk', $beskriv='Redekasser', $momssats=25, $pris=235.50, $rabat=12, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);
    #,"45-876","3","stk","Redekasser","25","235,50","8",(3*235.5)*92/100*125/100
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem data i denne rude.');
  echo '</PanlFoot>'; 
}

# PROGRAM-MODUL;
function Varelinie (&$posi, &$varenr, &$antal, &$enhed, &$beskriv, &$momssats, &$pris, &$rabat, &$ialt) {
  htm_FrstFelt('20%');  htm_CombFelt($type='text',  $name='posi',     $valu= $posi,     $titl='@Position styrer rækkefølgen af posterne', $labl='@Pos.',  $revi=true, $rows='',$width='45');
  htm_NextFelt('30%');  htm_CombFelt($type='text',  $name='varenr',   $valu= $varenr,   $titl='@Angiv varenr',              $labl='@Varenr',  $revi=true, $rows='',$width='45');
  htm_NextFelt('20%');  htm_CombFelt($type='tal1d', $name='antal',    $valu= $antal,    $titl='@Angiv Antal',               $labl='@Antal',   $revi=true, $rows='',$width='45',$step='0.25');
  htm_NextFelt('30%');  htm_CombFelt($type='text',  $name='enhed',    $valu= $enhed,    $titl='@Enhed udfyldes automatisk', $labl='@Enhed',   $revi=false,$rows='',$width='45');
  htm_LastFelt();
                        htm_CombFelt($type='area',  $name='beskriv',  $valu= $beskriv,  $titl='@Angiv beskrivelse af ydelsen',  $labl='@Beskrivelse', $revi=true, $rows='2');
  htm_FrstFelt('20%');  htm_CombFelt($type='tal2d', $name='momssats', $valu= $momssats, $titl='@Momssats for ydelsen',      $labl='@Moms%',   $revi=true, $rows='', $width='45',$step='0.25');
  htm_NextFelt('25%');  htm_CombFelt($type='tal2d', $name='pris',     $valu= $pris,     $titl='@Angiv enhedspris',          $labl='@Pris',    $revi=true, $rows='', $width='45');
  htm_NextFelt('28%');  htm_CombFelt($type='tal2d', $name='rabat',    $valu= $rabat,    $titl='@Angiv rabatbeløb',          $labl='@Rabat%',  $revi=true, $rows='', $width='45');
  htm_NextFelt('22%');  htm_CombFelt($type='tal2d', $name='ialt',     $valu= $ialt,     $titl='@Beregnet felt: ialt',       $labl='@Ialt',    $revi=false,$rows='', $width='45');
  htm_LastFelt();
  echo '<hr color="green">';
}

# PROGRAM-MODUL;
function VarelinieWide ($posi, $varenr, $antal, $enhed, $beskriv, $momssats, $pris, $rabat, $ialt) {
  htm_FrstFelt('05%');  htm_CombFelt($type='text',  $name='posi',     $valu= $posi,     $titl='@Position styrer rækkefølgen af posterne', $labl='@Pos.',  $revi=true, $rows='',$width='45',$step='1');
  htm_NextFelt('08%');  htm_CombFelt($type='text',  $name='varenr',   $valu= $varenr,   $titl='@Angiv varenr',                $labl='@Varenr',      $revi=true, $rows='',$width='45');
  htm_NextFelt('05%');  htm_CombFelt($type='tal1d', $name='antal',    $valu= $antal,    $titl='@Angiv Antal',                 $labl='@Antal',       $revi=true, $rows='',$width='45',$step='0.25');
  htm_NextFelt('08%');  htm_CombFelt($type='text',  $name='enhed',    $valu= $enhed,    $titl='@Enhed udfyldes automatisk',   $labl='@Enhed',       $revi=false,$rows='',$width='45');
  htm_NextFelt('35%');  htm_CombFelt($type='area',  $name='beskriv',  $valu= $beskriv,  $titl='@Angiv beskrivelse af ydelsen',$labl='@Beskrivelse', $revi=true, $rows='2');
  htm_NextFelt('07%');  htm_CombFelt($type='tal2d', $name='momssats', $valu= $momssats, $titl='@Momssats for ydelsen',        $labl='@Moms%',       $revi=true, $rows='', $width='45',$step='0.5');
  htm_NextFelt('08%');  htm_CombFelt($type='tal2d', $name='pris',     $valu= $pris,     $titl='@Angiv enhedspris',            $labl='@Pris',        $revi=true, $rows='', $width='45',$step='0.25');
  htm_NextFelt('05%');  htm_CombFelt($type='tal2d', $name='rabat',    $valu= $rabat,    $titl='@Angiv rabatsats',             $labl='@Rabat%',      $revi=true, $rows='', $width='45',$step='0.25');
  htm_NextFelt('09%');  htm_CombFelt($type='tal2d', $name='ialt',     $valu= $ialt,     $titl='@Beregnet felt: ialt',         $labl='@Linie ialt',  $revi=false,$rows='', $width='45',$step='0.25');
  htm_LastFelt();
}

# PROGRAM-MODUL;
function Rude_Tabel() {
  htm_Rude_Top($name= 'naviform',$capt= '@DEMO: Tabel med fastlåst kolonne-header og "rulle-vindue"',$parms='',$icon='fa-database','panelWmax',__FUNCTION__);
  htm_Tabel($RowLabl='ordre',$ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]  
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
          ) , $doFilter=true, $doSort=true, $CreateRec=true);
  htm_RudeBund($pmpt='@Gem',$subm=false,$title='@Gem');
}

# PROGRAM-MODUL;
function Rude_Debitorer() {
  htm_Rude_Top($name= 'naviform',$capt= '@Konti - Debitorer:',$parms='',$icon='fa-database','panelWmax',__FUNCTION__);
  htm_Tabel($RowLabl='debitor',$ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
            ['@Kontonr.','6%','','','','','..auto..'],['@Kundenavn','10%','','','','','Firm...'],['@Adresse','8%','','','','','Addr...'],
            ['@Sted','8%','','','','','Sted...'],['@Postnr','4%','','','','','Post...'],['@By','8%','','','','','By...'],
            ['@Kontakt','12%','','','','','Kont...'],['@Telefon','12%','','','','','Telf...'],['@Sælger','12%','','','','','Sælg...']),
            $TablData= array( # DemoData:
            ['1025','Firmanavn','Adresse','Sted','Postnr','By','Kontakt','Telefon','Sælger'],
            ['1026','Firmanavn','Adresse','Sted','Postnr','By','Kontakt','Telefon','Sælger'],
            ['1027','Firmanavn','Adresse','Sted','Postnr','By','Kontakt','Telefon','Sælger'],
            ['1028','Firmanavn','Adresse','Sted','Postnr','By','Kontakt','Telefon','Sælger']
            ) );
  htm_RudeBund($pmpt='@Gem',$subm=false,$title='@Gem');
}

# PROGRAM-MODUL;
function Rude_Kreditorer() {
  htm_Rude_Top($name= 'naviform',$capt= '@Konti - Kreditorer:',$parms='../_base/page_Gittermenu.php',$icon='fa-database ','panelWmax',__FUNCTION__);
  htm_Tabel($RowLabl='kreditor',$ColStyle= array(   #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
            ['@Kontonr.','6%','','','','','..auto..'],['@Leverandør Navn','10%','','','','',tolk('@Navn...')],['@Adresse','8%','','','','',tolk('@Addr...')],['@Sted','8%','','','','',tolk('@Sted...')],
            ['@Post','4%','','','','@Post nr',tolk('@Post...')],['@By','8%','','','','',tolk('@By...')],['@Kontakt person','12%','','','','',tolk('@Kont...')],['@Telefon','12%','','','','',tolk('@Telf...')]),
            $TablData= array( # DemoData:
            ['1025','Navn','Adresse','Sted','Post nr','By','Kontakt person','Telefon'],
            ['1026','Navn','Adresse','Sted','Post nr','By','Kontakt person','Telefon'],
            ['1027','Navn','Adresse','Sted','Pnr',    'By','Kontakt person','Telefon'],
            ['1028','Navn','Adresse','Sted','Post nr','By','Kontakt person','Telefon']
            ) );
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Retur til hovedmenu');
}

# PROGRAM-MODUL;
function Rude_KredOrdrer() {
  htm_Rude_Top($name= 'naviform',$capt= '@Ordrer: Kreditorer - `Leverandørordrer`:',$parms='',$icon='fa-database','panelWmax',__FUNCTION__);
  htm_Tabel($RowLabl=tolk('@leverandørordre'),$ColStyle= array(#   [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
            ['@Ordre nr.','6%','','','','','..auto..'],['@Modt.nr.','5%','','','','','Modt...'],    ['@Fakt.nr.','6%','','','','','Fakt...'],['@Ordre dato','7%','','date','','','åååå-mm-dd'],
            ['@Modt.dato','7%','','date','','','åååå-mm-dd'],['@Konto nr.','8%','','','','','Kont...'],['@Firma navn','30%','','','','','Navn...'],['@Telefon','6%','','','center','','Telf...'],
            ['@Leveres til','6%','','','left','','Lev...'],['@Vor ref.','5%','','','left','','Ref...'],['@Faktura sum','8%','','','right','','Beløb...']),
            $TablData= array( # DemoData:
            ['1025','Modt.nr.','Fakt.nr.','Ordre dato','Modt.dato','Konto nr.','Firma navn','Telefon','Leveres til','Vor ref.','Faktura sum'],
            ['1026','Modt.nr.','Fakt.nr.','Ordre dato','Modt.dato','Konto nr.','Firma navn','Telefon','Leveres til','Vor ref.','Faktura sum'],
            ['1027','Modt.nr.','Fakt.nr.','Ordre dato','Modt.dato','Konto nr.','Firma navn','Telefon','Leveres til','Vor ref.','Faktura sum'],
            ['1028','Modt.nr.','Fakt.nr.','Ordre dato','Modt.dato','Konto nr.','Firma navn','Telefon','Leveres til','Vor ref.','Faktura sum']
            ) );
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Gem');
}

# PROGRAM-MODUL;
function Rude_DebtDebitor() {
  htm_Rude_Top($name= 'naviform',$capt= '@Debitorliste',$parms='../_base/page_Gittermenu.php',$icon='fa-database','panelWmax',__FUNCTION__);
#   Luk  Debitorer   Historik Visning Ny
#   Kontonr Firmanavn Adresse Adresse 2 Postnr  By  Kontakt Telefon Sælger    OK
  htm_Tabel($RowLabl='@se debitorkort',$ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
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
            ),    $FilterOn=true,   $SorterOn=true,    $CreateRec=false,   $ViewHeight='200px' );
  echo '<hr><div style="margin-left:1em; display:block; font-weight: normal;" >Vælg: '; 
    textKnap($label='@Opret Ny',  $title='@Opret ny debitor', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Historik',  $title='@Historik for',     $link='../_base/page_Blindgyden.php');    
    textKnap($label='@Visning',   $title='@Bestem hvilke felter der skal vises i listen', $link='../_base/page_Blindgyden.php');
  echo '</div>';  
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Retur til hovedmenu');
}

# PROGRAM-MODUL;
function Rude_DebtOrdrer() {
  htm_Rude_Top($name= 'naviform',$capt= '@Ordrer: Debitorer - `Kundeordrer`:',$parms='../_base/page_Gittermenu.php',$icon='fa-database','panelWmax',__FUNCTION__);
  htm_Tabel($RowLabl='@kundeordre',$ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
            ['@Ordre nr.','6%','','','','','..auto..'],['@Ordre dato','7%','','date','left','','åååå-mm-dd'],['@Lev. dato','7%','','date','left','','åååå-mm-dd'],
            ['@Konto nr.','6%','','text','center','',tolk('@Kont...')],['@Firma navn','24%','','','','',tolk('@Firm...')],['@Sælger','8%','','','','',tolk('@Sælg...')],['@Ordre sum','6%','','','','',tolk('@Beløb...')]),
            $TablData= array( # DemoData:
            ['1025','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1026','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1027','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1028','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum']
            ) );
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Retur til hovedmenu');
}

# PROGRAM-MODUL;
function Rude_DebRapp() {
  htm_Rude_Top($name= 'naviform',$capt= '@Debitor-rapporter:',$parms='../_base/page_Gittermenu.php',$icon='fa-list','panelWmax',__FUNCTION__);
    htm_FrstFelt('04%',0);  
    htm_NextFelt('36%');  echo '<p align="center">'.tolk('@Angiv kriterier:').'</p> ';
    htm_NextFelt('02%');  
    htm_NextFelt('58%');  htm_CheckFlt($type='checkbox',$name='somfakt',$valu='somfakt',
                          $titl='@Afmærk her, hvis kriterier skal genbruges.',  $labl='@Husk dem',$revi=true);
    htm_LastFelt();
  htm_FrstFelt('05%',0);  
  htm_NextFelt('48%');  htm_CombFelt($type='text',$name='konto',  $valu='', $titl='@Angiv rapporterings Konto', $labl='@Konto', $revi=true);
  htm_NextFelt('47%');  htm_CombFelt($type='date',$name='dato',   $valu='', $titl='@Angiv periode start Dato',  $labl='@Fra Dato',  $revi=true);
  htm_LastFelt();
  echo '<hr><div style="margin-left:1em; display:block; font-weight: normal;" >Vælg: '; 
    textKnap($label='@Åbne poster',    $title='@Rapport for debitor åbne poster',     $link='../_base/page_Blindgyden.php');
    textKnap($label='@Konto saldo',    $title='@Rapport for debitor konto saldo',     $link='../_base/page_Blindgyden.php');    
    textKnap($label='@Konto kort',     $title='@Rapport for debitor konto kort',      $link='../_base/page_Blindgyden.php');
    textKnap($label='@Salgs statistik',$title='@Rapport for debitor Salgs statistik', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Top 100',        $title='@Rapport for Top 100',                 $link='../_base/page_Blindgyden.php');
  echo '</div>';  
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Retur til hovedmenu');
}

# PROGRAM-MODUL;
function Rude_KredRapp() {
  htm_Rude_Top($name= 'naviform',$capt= '@Kreditor-rapporter:',$parms='../_base/page_Gittermenu.php',$icon='fa-list','panelWmax',__FUNCTION__);
    htm_FrstFelt('04%',0);  
    htm_NextFelt('36%');  echo '<p align="center">'.tolk('@Angiv kriterier:').'</p> ';
    htm_NextFelt('02%');  
    htm_NextFelt('58%');  htm_CheckFlt($type='checkbox',$name='somfakt',$valu='somfakt',
                          $titl='@Afmærk her, hvis kriterier skal genbruges.',  $labl='@Husk dem',$revi=true);
    htm_NextFelt('05%');
    htm_LastFelt();
  htm_FrstFelt('0%',0); 
  htm_NextFelt('50%');  htm_CombFelt($type='text',$name='konto',  $valu='', $titl='@Angiv rapporterings Konto', $labl='@Konto', $revi=true);
  htm_NextFelt('50%');  htm_CombFelt($type='date',$name='dato',   $valu='', $titl='@Angiv periode start Dato',  $labl='@Fra Dato',  $revi=true);
  htm_LastFelt();
  echo '<hr><div style="margin-left:1em; display:block; font-weight: normal;" >Vælg: '; 
    textKnap($label='@Åbne poster',    $title='@Rapport for kreditor åbne poster',    $link='../_base/page_Blindgyden.php');
    textKnap($label='@Konto saldo',    $title='@Rapport for kreditor konto saldo',    $link='../_base/page_Blindgyden.php');
    textKnap($label='@Konto kort',     $title='@Rapport for kreditor konto kort',     $link='../_base/page_Blindgyden.php');
    textKnap($label='@Købs statistik', $title='@Rapport for kreditor købs statistik', $link='../_base/page_Blindgyden.php');
  echo '</div>';  
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Retur til hovedmenu');
}


# PROGRAM-MODUL;
function Rude_KasseRedigering($id='2',$dato='Dato',$ejer='Bogholder',$bemr='Bemærkning 2',$bogf='Bogført',$af='Af') {
  $dktip=   tolk('@D/K/F feltet benyttes i forbindelse med debitor- og kreditor posteringer.').' '.
            tolk('@Er feltet tomt eller udfyldt med F, betragtes det efterfølgende kontonummer som et Finans konto-nummer.').
            tolk('@Skrives der `d` eller `k`, vil det efterfølgende nummer blive tolket som et Debitor konto-nummer eller et Kreditor konto-nummer.');
  $debkre=  tolk('@Debet Kt. og Kredit Kt.-felterne er til kontonummeret på den konto, posteringen skal ske på.').
            tolk('@Afhængigt af koden i D/K vil der være tale om en debitor-, Kreditor- eller Finanskonto');
//  if ($dokument[$y]) print "<td title="klik her for at åbne bilaget: $dokument[$y]"><a href="../includes/bilag.php?kilde=kassekladde&filnavn=$dokument[$y]&bilag_id=$id[$y]&bilag=$bilag[$y]&kilde_id=$kladde_id&fokus=bila$y"> <img style="border: 0px solid" src="../ikoner/paper.png"> </a></td>";
//  else               print "<td title="klik her for at vedhæfte et bilag">          <a href="../includes/bilag.php?kilde=kassekladde&bilag_id=$id[$y]&bilag=$bilag[$y]&ny=ja&kilde_id=$kladde_id&fokus=bila$y">                 <img style="border: 0px solid" src="../ikoner/clip.png">  </a></td>";
  if ($dokument[$y]) {
          $title="@klik her for at åbne bilaget: $dokument[$y]";
          $link="../includes/bilag.php?kilde=kassekladde&filnavn=$dokument[$y]&bilag_id=$id[$y]&bilag=$bilag[$y]&kilde_id=$kladde_id&fokus=bila$y";   
          $clip= 'paper.png';
   } else {
          $title="@klik her for at vedhæfte et bilag";  
          $link="../includes/bilag.php?kilde=kassekladde&bilag_id=$id[$y]&bilag=$bilag[$y]&ny=ja&kilde_id=$kladde_id&fokus=bila$y"; 
          $clip= 'clip.png'; 
  };
  htm_Rude_Top($name= 'kasseform',$capt= '@Kassekladde: '.$id.', <small>'.$ejer.'</small>',$parms='',$icon='fa-database','panelWmax',__FUNCTION__);
  htm_TabelInp(
    $HeadLine= array(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      ['@Kladde notat:', '60%','left','text', '@Her kan skrives en bemærkning til kladden',                  '@Angiv din tekst...'], 
      ['@Konto-kontrol:','5em','left','text', '@Angiv kontonummer for den konto, hvis bevægelser skal kontrolleres',  '@Nummer...'], 
    ),
    $RowHead= array( #  ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! ']  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
          ['PDF',     '3%','center','text','<a href='.$link.'><img src=../icons/'.$clip.'  alt="Clips" height="20" width="12" border=0 title="'.tolk($title).
              '"></a>',tolk('@I denne kolonne håndterer du PDF-bilag, som er tilknyttet den enkelte postering.'),'placeh']
          ),
    $ColStyle= array( # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],
      ['@Bilag.',       '5%','','text', 'left',  tolk('@Bilagsnummer tildeles automatisk og fortsættes fra sidst anvendte bilagsnummer fra samme bruger.').' ','...auto...'],
      ['@Dato',         '9%','','date', 'center',tolk('@Bilagets dato, som automatisk sættes til dags dato, men kan ændres.'),'fakt.dato'],
      ['@Bilags tekst','20%','','text', 'left',  tolk('@Bilagstekst er frivillig, men det er nyttigt senere at kunne se, hvad de enkelte posteringer drejer sig om.').' ',tolk('@Posterings note...')],
      ['@D/K',        '3.5%','','text', 'center',$dktip,'d/k/f'],
      ['@Debet Kt.',    '8%','','text', 'center',$debkre],
      ['@D/K',        '3.5%','','text', 'center',$dktip,'d/k/f'],
      ['@Kredit Kt.',   '8%','','text', 'center',$debkre],
      ['@Faktura nr.',  '8%','','text', 'center',tolk('@Fakturanr. benyttes i forbindelse med debitor- og kreditorposteringer.')],
      ['@Beløb',        '8%','','tal2d','right' ,tolk('@Beløb indeholder det beløb, der skal bogføres. Hvis man ved simulering eller anden kontrol opdager, ').
                      tolk('@at en linje skal bogføres direkte modsat af, hvad der står i kassekladden, så kan man blot sætte minustegn foran beløbet. ').' '.
                      tolk('@På den måde bytter kontonumrene i felterne debet og kredit plads, og beløbet bliver igen positivt.')],
      ['@Valuta',       '4%','','text','center','@Valutakode for den valuta, som er benyttet på bilaget.','DKK'],
      ['@Forfald',      '9%','','date','center','@Beløbets forfalds dato','forf.dato'],
      ),
    $RowTail= array(  # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:InpType', '4:FeltJust', '5:ColTip', '6:value! ']
        ['@Konto saldo','8%','','text','right', #'0.000,00<div type= "text" name="saldo" value="00.000,00" width="8%"/>',
          tolk('@Bevægelser og saldo for den konto, som er angivet ovenfor i Felt: Konto-kontrol.').' <br>'.
          tolk('@Er velegnet til afstemning med bank- og girokonti'),'.calc...']),
        $data= array(1,2,3,4,5,6,7,8,9,10,11,12,13),  # Antal rows ved DEMO
      '0px'
  );
### PanelFooter:
  NaviTip();
### KnapPanel:
  echo '<div style="text-align:center;">'; 
  echo  textKnap($label='@Gem',             $title='@Klik her for at gemme',$link='../_base/page_Blindgyden.php').
        textKnap($label='@Opslag',          $title='@Opslag - din markørs placering angiver hvilken tabel, opslag foretages i',$link='../_base/page_Blindgyden.php').
        textKnap($label='@Bogfør',          $title='@Bogfør - der foretages først en simulering, som du skal bekræfte',$link='../_base/page_Blindgyden.php').
        textKnap($label='@Simuler',         $title='@Simulering af bogføring viser bevægelser i kontoplanen',$link='../_base/page_Blindgyden.php').
        textKnap($label='@Annuller',        $title='@Annuller simulering',$link='../_base/page_Blindgyden.php').
        textKnap($label='@Kopier',          $title='@Kopier til ny',$link='../_base/page_Blindgyden.php').
        textKnap($label='@Tilbagefør',      $title='@Tilbagefør postering',$link='../_base/page_Blindgyden.php').
        textKnap($label='@Hent ordrer',     $title='@Henter afsluttede ordrer fra ordreliste',$link='../_base/page_Blindgyden.php').
        textKnap($label='@DocuBizz import', $title='@DocuBizz import',$link='../_base/page_Blindgyden.php').
        textKnap($label='@Import',          $title='@Importerer bankposteringer eller andre data fra .csv-fil (kommasepareret fil)',$link='../_base/page_Blindgyden.php').
        textKnap($label='@Udlign',          $title='@Finder åbne poster, som modsvarer beløb og fakturanummer',$link='../_base/page_Blindgyden.php').
  '</div>';
  htm_RudeBund($pmpt='@Gem',$subm=false,$title='@Gem');
}

function Rude_Kladderedigering() {
  Head_Navigation(tolk('@Kassekladde'), $status='', $goPrev=false, $goHome=true, $goUp=true, $goFind=false, $goNew=false, $goNext=false); 
  htm_Rude_Top($name= 'naviform',$capt= '@Kassekladde liste:',$parms='',$icon='fa-list','panelWmax',__FUNCTION__);
  htm_Tabel($RecLabl='kassekladde', $ColStyle= array(  #   [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
            ['@Id','7%','D','','','',''],['@Dato','10%','','date','','','åååå-mm-dd'],['@Ejer','10%','','','','','Ejer...'],['@Bemærkning','48%','','','','','Bem...'],
            ['@Bogført','14%','U','','','','Bogf...'],['@Af','8%','','','','','Af...']),
            $DataArr= array(
            ['1','Dato','Ejer','Bemærkning 1','Bogført','Af'],
            ['2','Dato','Ejer','Bemærkning 2','Bogført','Af'],
            ['3','Dato','Bogholder','Bemærkning 3','Bogført','Af']
            ), $FilterOn=true, $SortOn=true, $CreateRec=false );
  htm_RudeBund($pmpt='@Gem',$subm=false,$title='@Gem');
  Rude_KasseRedigering($DataArr[2][0],$DataArr[2][2]);
  Rude_FootMenu($doPrint=true, $doErase=true, $doLookUp=true, $doAccept=true, $doExport=true, $doImport=true, 
  $OpslLabl='@Opslag: markørens placering bestemmer, hvilken tabel opslag skal foretages i');
}

function Rude_Budget() {
### Gør $ColStyle klar:
  $MdTitles= periodeoverskrifter($maanedantal=12, $startaar=2016, $startmaaned=1, 1, "regnskabsmaaned", $regnskabsaar='2016');  //  periodeoverskrifter benytter: ['@'.$periode_kort, '4.5%','','tal2d', 'right', '@'.$periode_lang,'']
  $ColStyle= array();  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
  array_push($ColStyle, 
              ['@Konto',     '4%','','data',  'right',  '@Kontonummer. Entydig nummerkode, som benyttes til sortering, summering mv.','@Konto...'],
              ['@Kontonavn','22%','','data',  'left',   '@Kontonavn - beskrivende tekst','']
            );
  foreach ($MdTitles as $Md) array_push($ColStyle, $Md);
  array_push($ColStyle, ['@I alt',  '5%','','tal2d', 'right', '@Aktuelle beløb. (Årets ultimo beløb)','']);
  
  htm_Rude_Top($name= 'budgform',$capt= '@Budget '.($regnskabsaar+0).':',$parms= 'Rude_Erdusikker()',$icon='fa-list','panelWmax',__FUNCTION__);
  htm_TabelInp_Budget(
    $HeadLine= array(['@Nyt budget:', '10%','left','show', '@ +/- 0% OK', '@Pct. korrektion']),
    $RowHead= array(),  # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! ']
    $ColStyle,
    $RowTail= array(),  # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:InpType', '4:FeltJust', '5:ColTip', '6:value! ']
    $DATA= ImportTabFile('../_export-import/kontoplan.tab'),  // Indlæs data fra TAB-fil    //  $kontotyper=array("H","D","S","Z","R");   $momstyper=array("S","K","E","Y");    
    $ViewHeight='550px', __FUNCTION__
  );
### PanelFooter:
  NaviTip();
#### KnapPanel:
  echo '<div style="text-align:center;">';
  echo // textKnap($label='@Gem',             $title='@Klik her for at gemme',$link='../_base/page_Blindgyden.php').
        textKnap($label='@Retur til Regnskab',  $title='@Vend tilbage til regnskab',$link='../_finans/page_Regnskab.php').
        textKnap($label='@Retur til Hovedmenu',  $title='@Vend tilbage til programmets hovedmenu',$link='../_base/page_Gittermenu.php').
        '</div>';
   htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem hele budgettet.');
}

# PROGRAM-MODUL;
function Rude_OrdrePostering() {
  htm_Rude_Top($name= 'ordreform',$capt= '@Indtastning af salgs ordre poster - `Varelinier`:',$parms='',$icon='fa-database','panelWmax',__FUNCTION__);
  htm_TabelInp(
    $HeadLine= array(
      ['@Status:', '60%','left','text', '@Her kan skrives en bemærkning til ordren', '@Ny ordre, endnu uden kundetilknytning!'], 
      ['@Kundetilknytning:','5em','left','text', '@Angiv kontonummer på kunden','@Konto...'], 
    ),
    $RowHead= array(),  # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! '] #  array(['Link'],['Label'],['Tip'],['4%']),
    $ColStyle= array( # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],
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
//  $RowTail= array(['<a href='.$link.' onclick=\"return confirm($confm)\"><img src=../icons/clip.png  alt="Clips" height="80%" width="80%" border=0></a>'],  [])
    $RowTail= array(  # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:InpType', '4:FeltJust', '5:ColTip', '6:value! ']
        ['@um.',       '5%','','text','center',tolk('@um. (uden moms) kan benyttes til at bogføre beløb uden moms på konti, selvom kontoen har en momssats tilknyttet.'), '<input type= "checkbox" name="udenmoms" value="" >'],
        ['@Linie ialt','8%','','text','center',tolk('@Beregnet felt med summen af de samlede beløb'), '00.000,00']), #'<div type= "text" name="saldo" value="00.000,00" width="8%">']),
    $data= array(1,2,3,4,5,6,7,8,9,10),  # Antal rows ved DEMO
    $PadTop='0px'
  );
### PanelFooter:
  NaviTip();
### KnapPanel:
  echo '<div style="text-align:center;">';
  echo  textKnap($label='@Gem',             $title='@Klik her for at gemme',$link='../_base/page_Blindgyden.php').
        textKnap($label='@Opslag',          $title='@Opslag - din markørs placering angiver hvilken tabel, opslag foretages i',$link='../_base/page_Blindgyden.php').
        textKnap($label='@Slet alt',        $title='@Klik her for at nulstille alle data i tabellen.',$link='../_base/page_Blindgyden.php').
        '</div>';
 htm_RudeBund($pmpt='@Gem',$subm=false,$title='@Gem');
}

# PROGRAM-MODUL;
function Rude_Kontoplan() {
  htm_Rude_Top($name= 'kontoform',$capt= '@Kontoplan:',$parms='../_base/page_Gittermenu.php',$icon='fa-database','panelW960',__FUNCTION__);
  htm_Tabel($RowLabl='@redigere denne konto',
            $ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
              ['@Kontonr.',       '8%','','text',  'left',   '@Kontonummer. Entydig nummerkode, som benyttes til sortering, summering mv.','@Konto...'],
              ['@Kontonavn',     '45%','','text',  'left',   '@Kontonavn - beskrivende tekst','@Navn...'],
              ['@Type',           '6%','','text',  'left',   '@Kontotype: D=Drift, S=Status, Z=Sum, H=Overskrift, R=Resultat, X=Sideskift, L=Lukket','@Type...'],
              ['@Moms',           '6%','','text',  'center', '@Momskode: K_:Købs... S_:Salgs... Y_:Ydelser, E_:, ','@Moms...'],
              ['@Σ Fra-Til Kt.', '10%','','text',  'center', '@Summér fra_konto. Angiv laveste kontonummer, som skal med i sammentællingen.','@Fra...'],
              ['@Saldo',          '7%','','tal2d', 'right',  '@Konto saldo. Beløbet på kontoen lige nu.','@Saldo...'],
              ['@Valuta',         '6%','','text',  'center', '@Kontoens valuta (DKK= kurs 100)','@Valuta...'],
              ['@Genvej',         '6%','','text',  'center', '@Genvejstast: Bogstav-kode, som kan benyttes som forkortelse af kontonummeret','Genv...']),
            $TablData= ImportTabFile('../_export-import/kontoplan.tab'),  // Indlæs kontoplan fra TAB-fil
            $FilterOn=true, $SorterOn=false, $CreateRec=true, $ViewHeight='300px' );
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Retur til hovedmenu');
}
# PROGRAM-MODUL;
function Rude_KontoKort() {
  # var_dump(htm_SelectStr($valu,MomsListe()));
  htm_Rude_Top($name= 'kontoform',$capt= '@Kontokort:',$parms='../_systemdata/page_Kontoplan.php',$icon='fa-pencil-square-o','panelW640',__FUNCTION__);
  htm_TabelInp(
    $HeadLine= array( ['@Vælg en konto i kontoplanen - ', '18%','left','show', ' ', '@Rediger konto:'] ),
      $RowHead= array(),  # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! '] #  array(['Link'],['Label'],['Tip'],['4%']),
            $ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
              ['@Kontonr.',  '8%','','text', 'left',   '@Kontonummer. Entydig nummerkode, som benyttes til sortering, summering mv.','@Konto...'],
              ['@Kontonavn','50%','','text', 'left',   '@Kontonavn - beskrivende tekst','@Navn...'],
              ['@Type',      '7%','','kont', 'left',   '@Kontotype: D=Drift, S=Status, Z=Sum, H=Overskrift, R=Resultat, X=Sideskift, L=Lukket','@Type...'],
              ['@Moms',      '7%','','moms', 'left',   '@Momskode: K_:Købs... S_:Salgs... Y_:Ydelser, E_:, ','@Moms...'],
              ['@Valuta',    '7%','','valu', 'left',   '@Valuta','@Valu...'],
              ['@Saldo',     '7%','','show', 'center', '@Kontoens saldo','..calc..'],
              ['@Genvej',    '7%','','text', 'left',   '@Genvej','@Genv...'],
              ['@Status',    '7%','','text', 'left',   '@Status: Aktiv eller Lukket','@Stat...']
    ),
    $RowTail= array(), #'<div type= "text" name="saldo" value="00.000,00" width="8%">']),
    $data= array(['2001','VAREFORBRUG','D','K1','DKK',0.00,'G',true]),  // Demo
    $PadTop='0px'
  );
  echo '<div style="text-align:center;">';
  echo  textKnap($label='@<- Forrige konto', $title='@Klik her for at se forrige konto',      $link='').
        textKnap($label='@Gem/opdatér',      $title='@Klik her for at gemme evt. ændringer.', $link='').
        textKnap($label='@Slet',             $title='@Klik her for at slette kontoen. Konti som er taget i brug, kan ikke slettes!',   $link='').
        textKnap($label='@Næste konto ->',   $title='@Klik her for at se næste konto',        $link='').
        '</div>';
  htm_RudeBund($pmpt='@Retur til kontoplan',$subm=true,$title='@Retur til kontoplan');
}

# PROGRAM-MODUL;
function Rude_RapportFinans() {global $Ø_MdrList, $Ø_DagList, $Ø_ArtList; // oprettet i ../_base/base_init.php
  htm_Rude_Top($name= 'rappform',$capt= '@Finansrapport:',$parms='../_base/page_Gittermenu.php',$icon='fa-database','panelW480',__FUNCTION__);
  # htm_SelectStr($valu,Aar_Liste());
  $Aar_Liste= Aar_Liste();
  $Knt_Liste= MakeDriftsKonti();
  htm_FrstFelt('50%',0);  htm_CombList($valu='2016',$titl='Tip',$labl='Regnskabsår',$liste= $Aar_Liste);
  htm_NextFelt('50%');    textKnap($label='@Opdatér',    $title='@Opdater her efter en rettelse af regnskabsår',$link='../_base/page_Blindgyden.php');
  htm_LastFelt();
  htm_FrstFelt('35%',0);  htm_CombList($valu='momsangivelse',$titl='Tip',$labl='Rapporttype',$liste= $Ø_ArtList);
  htm_NextFelt('65%');    htm_CheckFlt($type='checkbox',$name='somfakt',$valu='somfakt', $titl='@Afmærk her, hvis lagerbevægelser skal medtages.',  $labl='@Medtag lagerbevægelser',$revi=true);
  htm_LastFelt();
  
  echo '<hr><colrlabl>';  htm_FrstFelt('50%',0); 
  echo 'Periode fra:';    htm_NextFelt('50%');  
  echo 'Periode til:';    htm_LastFelt(); 
  echo '</colrlabl>';
  
  htm_FrstFelt('10%',0);  htm_CombList($valu='2016',$titl='Tip',$labl='År:',    $liste= $Aar_Liste); 
  htm_NextFelt('15%');    htm_CombList($valu='0',   $titl='Tip',$labl='Måned:', $liste= $Ø_MdrList); 
  htm_NextFelt('25%');    htm_CombList($valu='0',   $titl='Tip',$labl='Dag:',   $liste= $Ø_DagList);
  htm_NextFelt('10%');    htm_CombList($valu='2016',$titl='Tip',$labl='År:',    $liste= $Aar_Liste); 
  htm_NextFelt('15%');    htm_CombList($valu='11',  $titl='Tip',$labl='Måned:', $liste= $Ø_MdrList);
  htm_NextFelt('35%');    htm_CombList($valu='30',  $titl='Tip',$labl='Dag:',   $liste= $Ø_DagList);
  htm_LastFelt();
  
  htm_FrstFelt('50%',0);  htm_CombList($valu='',$titl='Tip', $labl='Fra konto', $liste= $Knt_Liste);
  htm_NextFelt('50%');    htm_CombList($valu='',$titl='Tip', $labl='Til konto', $liste= $Knt_Liste);
  htm_LastFelt();
  echo '<hr><div style="margin-left:1em; display:block; font-weight: normal;" >Vælg: '; 
    textKnap($label='@Kontrolspor',       $title='@Vilkårlig søgning i transaktioner',                $link='../_base/page_Blindgyden.php');    
    textKnap($label='@Provisionsrapport', $title='@Rapport over medarbejdernes provisionsindtjening', $link='../_finans/page_Provisionsrapport.php');
  echo '</div>';  
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Retur til hovedmenu');
}

# PROGRAM-MODUL;
function Rude_Provisionsrapport() {
  htm_Rude_Top($name= 'provform',$capt= '@Provisionsrapport:',$parms='../_base/page_Gittermenu.php',$icon='fa-database','panelWmax',__FUNCTION__);
  
  msg_Dialog('warn',ucfirst(tolk('@Retur')),'JavaScript:window.history.back();','','','','',ucfirst(tolk('@Her mangler der noget')),
            ucfirst(tolk('@Provisionsrapport kan ikke testes, før der er DB-adgang.')));
  
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Retur til hovedmenu');
}

# PROGRAM-MODUL;
function Rude_Regnskab() {
  htm_Rude_Top($name= 'kontoform',$capt= '@Regnskab:',$parms='../_base/page_Gittermenu.php',$icon='fa-database','panelWmax',__FUNCTION__);
  $MdTitles= periodeoverskrifter($maanedantal=12, $startaar=2016, $startmaaned=1, 1, "regnskabsmaaned", $regnskabsaar='2016');
  //  periodeoverskrifter benytter: ['@'.$periode_kort,    '4.5%','','tal2d', 'right', '@'.$periode_lang,'']
  $ColStyle= array();  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
  array_push($ColStyle, 
              ['@Konto',     '4%','','text',  'right',  '@Kontonummer. Entydig nummerkode, som benyttes til sortering, summering mv.','@Konto...'],
              ['@Kontonavn','25%','','text',  'left',   '@Kontonavn - beskrivende tekst',''],
              ['@Type',      '3%','','text',  'left',   '@Kontotype: D=Drift, S=Status, Z=Sum, H=Overskrift, R=Resultat, X=Sideskift, L=Lukket','@Type...'],
              ['@Valuta',    '4%','','text',  'center', '@Valutakode for kontoens beløb',''],
              ['@Primo',     '6%','','tal2d', 'right', '@Året primo beløb, Sidste års ultimo','']);
  foreach ($MdTitles as $Md) array_push($ColStyle, $Md);
  array_push($ColStyle, ['@I alt', '10%','','tal2d', 'right', '@Aktuelle beløb. (Årets ultimo beløb)','.calc.']);
  htm_Tabel($RowLabl='@vælge denne post',
            $ColStyle,
            $TablData= ImportTabFile('../_export-import/kontoplan-extra.tab'),  // Indlæs data fra TAB-fil
            $FilterOn=false, $SorterOn=false, $CreateRec=false, $ViewHeight='500px' );
### PanelFooter:
  NaviTip();
### KnapPanel:
  echo '<div style="text-align:center;">';
  echo  textKnap($label='@Budget',              $title='@Klik her for komme til budgetlægning',   $link='../_finans/page_Budget.php').
        textKnap($label='@Retur til hovedmenu', $title='@Retur til hovedmenu', $link='../_base/page_Gittermenu.php').
        '</div>';
   htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Retur til hovedmenu');
}

function Rude_Regnskabsaar() {
  htm_Rude_Top($name= 'regnform',$capt= '@Regnskabsår:',$parms='../_systemdata/page_Syssetup.php',$icon='fa-database','panelW480',__FUNCTION__); 
  echo '<colrlabl>';      htm_FrstFelt('44%',0);  htm_NextFelt('24%');  
  echo 'Periode start:';  htm_NextFelt('24%');  
  echo 'Periode slut:';   htm_NextFelt('8%');     htm_LastFelt(); echo '</colrlabl>';
  htm_Tabel($RowLabl='@vise regnskabskortet',
            $ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
              ['@ID.',        '14%','','text', 'center', '@Entydigt systemindex, som benyttes af systemet,','@auto...'],
              ['@Beskrivelse','28%','','text', 'left',   '@Beskrivende tekst for perioden','@Besk...'],
              ['@Måned',      '12%','','text', 'center', '@Periodens første måned','@md...'],
              ['@År',         '12%','','text', 'center', '@Perioden starter i år', '@år...'],
              ['@Måned',      '12%','','text', 'center', '@Periodens sidste måned','@md...'],
              ['@År',         '12%','','text', 'center', '@Perioden slutter i år', '@år...'],
              ['@Status',     '10%','','text', 'center', '@Regnskabets status',    '@Stat...'],
              ),
            $TablData= array(['1','2015','01','2015','12','2015','Lukket'],['2','2016','01','2016','12','2016','<div style="color:red">Aktivt</div>']),  // Demo
            $FilterOn=false, $SorterOn=false, $CreateRec=true, $ViewHeight='100px' );
  htm_RudeBund($pmpt=Tolk('@Retur til indstillinger'),$subm=true,$title='@Retur til indstillingsmenu');
}

function Rude_Regnskabskort() {
  htm_Rude_Top($name= 'kortform',$capt= '@Regnskabskort:',$parms='../_systemdata/page_Syssetup.php',$icon='fa-pencil-square-o','panelW480',__FUNCTION__); 
  echo tolk('@Fastlæg 1. regnskabsår: 2016').'<br><br>';
  $besk='2016'; $aar0='2016'; $md0='01'; $aar1='2016'; $md1='12'; $aktiv=true; 
  echo '<colrlabl>';
  htm_FrstFelt('40%',0);  echo 'Regnskabsår:';
  htm_NextFelt('20%');    echo 'Periode start:';
  htm_NextFelt('20%');    echo 'Periode slut:';
  htm_NextFelt('20%');    echo 'Bogføring:';
  htm_LastFelt();    
  echo '</colrlabl>';
  htm_FrstFelt('40%',0);  htm_CombFelt($type='text',  $name='besk', $valu= $besk, $titl='@Angiv Beskrivelse',         $labl='@Beskrivelse.',  $revi=true, $rows='',$width='30',$step='0.5');
  htm_NextFelt('10%');    htm_CombFelt($type='text',  $name='md0',  $valu= $md0,  $titl='@Angiv periode start Måned', $labl='@Måned', $revi=true,$rows='',$width='30');
  htm_NextFelt('10%');    htm_CombFelt($type='text',  $name='aar0', $valu= $aar0, $titl='@Angiv periode start År',    $labl='@År',    $revi=true, $rows='',$width='30');
  htm_NextFelt('10%');    htm_CombFelt($type='text',  $name='md1',  $valu= $md1,  $titl='@Angiv periode slut Måned',  $labl='@Måned', $revi=true,$rows='',$width='30');
  htm_NextFelt('10%');    htm_CombFelt($type='text',  $name='aar1', $valu= $aar1, $titl='@Angiv periode slut År',     $labl='@År',    $revi=true, $rows='',$width='30');
  htm_NextFelt('20%');    htm_CheckFlt($type='checkbox',$name='aktiv', $valu= $aktiv,  $titl='@Angiv om bogføring er tilladt', $labl='@tilladt',$revi=true);
  htm_LastFelt();       
  
  echo '<colrlabl>&nbsp;'.tolk('@Auto nummerering:').'</colrlabl>';
  htm_FrstFelt('50%',0);  htm_CombFelt($type='text', $name='regn', $valu= $fak1Nr,   $titl='@Faktura nummer for periodens første faktura', $labl='@1. faktura nummer',    $revi=true, $rows='2',$width='',$step='', $more='placeholder="'.tolk('@Faktura...').'"');
  htm_NextFelt('50%');    htm_CombFelt($type='text', $name='regn', $valu= $fak1Nr,   $titl='@Modtagelses nummer for periodens første bilag', $labl='@1. modtagelses nummer', $revi=true, $rows='2',$width='',$step='', $more='placeholder="'.tolk('@Modtage...').'"');
  htm_LastFelt();       
  
  echo '<colrlabl>&nbsp;'.tolk('@Bilags nummerering:').'</colrlabl>';
  htm_FrstFelt('30%',0);  htm_CheckFlt($type='checkbox',$name='aktiv', $valu= $aktiv,  $titl='@Undlad nummerering ved faktura', $labl='@Undlad v. faktura',$revi=true);
  htm_NextFelt('30%');    htm_CheckFlt($type='checkbox',$name='aktiv', $valu= $aktiv,  $titl='@Brug fakturas nummerering', $labl='@Brug faktura-nr.',$revi=true);
  htm_NextFelt('30%');    htm_CheckFlt($type='checkbox',$name='aktiv', $valu= $aktiv,  $titl='@Brug modtage nummerering', $labl='@Brug modtage-nr.',$revi=true);
  htm_LastFelt();       
  echo '<div style="text-align:center;">'; 
  echo textKnap($label='@Gem rettelser', $title='@Gem hvad du har rettet ovenfor',$link='../_base/page_Blindgyden.php');
  echo '</div><hr>';
  
#  echo '<hr>'.tolk('@Indtast primotal for 1. regnskabsår:');
    htm_TabelInp(
    $HeadLine= array(['@Her angives primotal for:', '25%','left','show', '', '1. regnskabsår']),
    $RowHead=  array(),  # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! '] # array(['@Konto.','15%','center','','4:','5:Tip'],['@Beskrivelse','62%','left','','4:','5:Tip']),
    $ColStyle= array(  #  ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],
              ['@Konto.',     '12%','','show',  'center', '@Entydig systemindex, som benyttes af systemet,','@auto...'],
              ['@Beskrivelse','60%','','show',  'left',   '@Beskrivende tekst for perioden','@Besk...'],
              ['@Debet',      '14%','','tal2d', 'right',  '@Debet primosaldo','primo...'],
              ['@Kredit',     '14%','','tal2d', 'right',  '@Kredit primosaldo','primo...'],
             ),
    $RowTail= array(),  # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:InpType', '4:FeltJust', '5:ColTip', '6:value! ']
    $DATA= MakeStatusKonti(),
    $PadTop='0px', __FUNCTION__
  );

//  htm_Tabel($RowLabl='@vælge denne post',
//            $ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
//              ['@Konto.',     '15%','','text',  'center', '@Entydig systemindex, som benyttes af systemet,','@auto...'],
//              ['@Beskrivelse','62%','','text',  'left',   '@Beskrivende tekst for perioden','@Besk...'],
//              ['@Debet',  '12%','','text',  'center', '@Periodens første måned','@md...'],
//              ['@Kredit',   '12%','','text',  'center', '@Perioden starter i år', '@år...'],
//             ),
//            $TablData= MakeStatusKonti(),
//            $FilterOn=false, $SorterOn=false,$CreateRec=false, $ViewHeight='250px' );
  echo '<div style="text-align:center;">'; 
  echo textKnap($label='@Gem / opdater', $title='@Gem det du har rettet ovenfor',$link='../_base/page_Blindgyden.php');
  echo '</div>';
  htm_RudeBund($pmpt=Tolk('@Retur til indstillinger'),$subm=true,$title='@Retur til indstillingsmenu');
}

function MakeStatusKonti() {
  $StatusKt= array();
  $filDATA= ImportTabFile('../_export-import/kontoplan.tab');
  foreach ($filDATA as $rec) {if ($rec[2]=='S') array_push($StatusKt, [$rec[0],$rec[1],'0.00','0.00']);}
  # var_dump($StatusKt);
  return $StatusKt;
}
function MakeDriftsKonti() {
  $DriftKt= array();
  $filDATA= ImportTabFile('../_export-import/kontoplan.tab');
  foreach ($filDATA as $rec) {if ($rec[2]=='D') array_push($DriftKt, [$rec[0],$rec[1]]);}
  # var_dump($filDATA);
  # var_dump($DriftKt);
  return $DriftKt;
}

# SubRutine:
#function getComboA(sel) { var value = sel.value; };

# PROGRAM-MODUL;
function Rude_Kontrolspor() {
  htm_Rude_Top($name= 'sporform',$capt= '@Kontrol sporing',$parms='../_finans/page_Rapport.php',$icon='fa-database','panelWmax',__FUNCTION__);
    
  htm_FrstFelt('2%',0);  echo '<colrlabl style="text-align:right">&nbsp;'.tolk('@Vis:').'</colrlabl>';
  htm_NextFelt('5%');    htm_CombFelt($type='number',  $name='linier', $valu= 50,   $titl='@Max. antal linier, som vises pr. side: ', $labl='@Linier',  $revi=true, $rows='',$width='',$step='5' );
  htm_NextFelt('90%');    echo '<colrlabl>&nbsp;'.tolk('@pr. side').'</colrlabl> - '.tolk('@"Kontrolspor" = Find grundlaget for regnskabstallene.');
  htm_LastFelt();       

  htm_Tabel($RecLabl='se ?', 
      $ColStyle= array(  #   [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
        ['@Id',         '4%','','text','center',tolk('@Angiv et id-nummer eller angiv to adskilt af kolon (f.eks 345:350)'),''],
        ['@Dato',       '8%','','date','right', tolk('@Angiv en dato eller angiv to adskilt af kolon (f.eks 010605:300605)'),'...'.tolk('@Tekst').'åååå-mm-dd'],
        ['@Log. dato',  '8%','','date','right', tolk('@Angiv en dato eller angiv to adskilt af kolon (f.eks 010605:300605)'),'åååå-mm-dd'],
        ['@Tidspunkt',  '7%','','text','center',tolk('@Angiv et tidspunkt  (f.eks 17:35)'),'?'],
        ['@Kladde',     '7%','','text','center',tolk('@Angiv et kassekladdenummer eller angiv to adskilt af kolon (f.eks 345:350)'),'?'],
        ['@Bilag',      '7%','','text','center',tolk('@Angiv et bilagsnummer eller angiv to adskilt af kolon (f.eks 345:350)'),'?'],
        ['@Konto.',     '7%','','text','center',tolk('@Angiv et kontonummer eller angiv to adskilt af kolon (f.eks 345:350)'),'?'],
        ['@Fakturanr',  '7%','','text','center',tolk('@Angiv et fakturanummer eller angiv to adskilt af kolon (f.eks 345:350)'),'?'],
        ['@Debet',      '7%','','text','center',tolk('@Angiv et beløb eller angiv to adskilt af kolon (f.eks 10000,00:14999,99)'),'?'],
        ['@Kredit',     '7%','','text','center',tolk('@Angiv et bel&oslash;b eller angiv to adskilt af kolon (f.eks 10000,00:14999,99)'),'?'],
# if($vis_projekt):
        ['@Projekt',    '7%','','text','center',tolk('@Angiv et projektnummer eller angiv to adskilt af kolon (f.eks 5:7)'),'?'],
        ['@Søgetekst', '20%','','text','left',  tolk('@Angiv en søgetekst. Der kan anvendes * før og efter teksten'),'?']),
      $DataArr= array(
            ['1',''],
            ), 
      $FilterOn=true, $SortOn=true, $CreateRec=false );
  echo '<div style="text-align:center;">'; 
  echo textKnap($label='@Start søgning', $title='@Start søgning med de angivne kriterier.',$link='../_base/page_Blindgyden.php');
  echo textKnap($label='@CSV-eksport', $title='@Klik her for at eksportere valgte transaktioner til CSV-fil for import i andet program, f.eks. regneark.',$link='../_base/page_Blindgyden.php');
  echo '</div>';
  htm_RudeBund($pmpt='@Retur til finansrapport',$subm=true,$title='@Gå til vinduet finansrapport');
}


# PROGRAM-MODUL;
function Rude_Formularer($formtype,$formart,$formsprog) {
  htm_Rude_Top($name= 'formularform',$capt= '@Formularstyring',$parms='../_systemdata/page_Syssetup.php',$icon='fa-wrench','panelW240',__FUNCTION__);
  htm_OptioFlt($type='text',  $name='formtype',   $valu= $formtype, 
                    $titl='@Vælg en Formular som du vil redigere',  
                    $labl='@Formular',      $revi=true, $optlist= array(
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
                    $titl='@Vælg formularens Art (Objekt type)',  
                    $labl='@Formular Art',      $revi=true, $optlist= array(
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
                    $titl='@Vælg hvilket Sprog du vil benytte på formularen', 
                    $labl='@Formular Sprog',      $revi=true, $optlist= array(
                    ['','dansk',    '@Dansk'],
                    ['','engelsk',  '@Engelsk'],
                    ),$action='');
  echo  '<br>';
  echo '<div align="right">';
  echo textKnap($label='@Rediger valgt formular', $title='@Rediger det du har valgt ovenfor',$link='../_base/page_Blindgyden.php').'<hr>';
  echo '</div>';
  echo  textKnap($label='@Gem mine formularer',               $title='@Lav backup af det nugældende formularsæt.',    $link='../_base/page_Blindgyden.php').'<br><br>';
  echo  textKnap($label='@Genindlæs mine formularer',         $title='@Tag backup i brug, ved at benytte den som nugældende formularsæt.',$link='../_base/page_Blindgyden.php').'<br><br>';
  echo  textKnap($label='@Importer formular(er) fra LO ',     $title='@Indlæs fra .fodg-fil dannet af formularredigering i LibreOffice',   $link='../_base/page_Blindgyden.php').'<br><br>';
  echo  textKnap($label='@Overskriv formularer med standard', $title='@Overskriv formulardefination med system standard',$link='../_base/page_Blindgyden.php').'<br><br>';
  echo  textKnap($label='@Håndtering af formularsprog',       $title='@Sproghåndtering: Opret, Nedlæg sprog',         $link='../_base/page_Blindgyden.php').'<br><br>';
  echo  textKnap($label='@Upload/Download supportfiler',      $title='@Fil upload: Logo, Grafik, Billeder eller fodg-fil fra Libre Office',$link='../_base/page_Blindgyden.php').'<br><br>';
  htm_RudeBund($pmpt='@Retur til indstillinger',$subm=true,$title='@Gå til menuen indstillinger');
}

function SetHeadArr ($x) {
  return  array(   # $HeadLine= array([0:Labl, 1:Width, 2:Just, 3:InpType, 4:Tip, 5:placeholder])
    ['@Formular:',  '10%','left','show', '', '@Faktura'],
    ['@Art:',       '10%','left','show', '', $x],
    ['@Sprog:',     '10%','left','show', '', '@Dansk'],
  );
}

# PROGRAM-MODUL;
function Rude_FormRedigerText() {
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
      $PadTop= '0px'
    );  
    XY_forskydning();
    echo '<hr>';
    htm_FrstFelt('15%');  echo '<div style= "text-align:right">'.tolk('@Mail tekster:').'</div>';
    htm_NextFelt('20%');  htm_CombFelt($type='area',  $name='emne',   $valu= '',  $titl='@Her kan du angive mailens emne-tekst.', $labl='@Emne',  $revi=true,$rows='2',$width='45',$step='',$more='placeholder=" '.tolk('@Vedrørende...').'"');
    htm_NextFelt('45%');  htm_CombFelt($type='area',  $name='besked', $valu= '',  $titl='@Besked til modtageren.',  $labl='@Besked',  $revi=true, $rows='', $width='45',$step='',$more='placeholder=" '.tolk('@Vedhæftet følger...').'"');
    htm_NextFelt('20%');  htm_CombFelt($type='area',  $name='bilag',  $valu= '',  $titl='@Angiv navne, på de filer der skal vedhæftes.', $labl='@Bilag', $revi=true, $rows='', $width='45',$step='',$more='placeholder=" '.tolk('@PDF-fil...').'"');
    htm_LastFelt(); 
    htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem');
}

# PROGRAM-MODUL;
function Rude_FormRedigerGrafik() {
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
        ['@Filnavn',  '30%','','text','left',  tolk('@Filnavn på grafik-fil'),tolk('@?.jpg')],
        ),
      $RowTail= array(  # ['0:ColLabl', '1:ColWidth', '2:disp!', '3:InpType', '4:FeltJust', '5:ColTip', '6:value!']
        ['@Note',          '22%','','text','center','@(planlagt)','.?.'],
      ),
      $data= array(1,2), # Antal rows ved DEMO
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
      $PadTop= '10px'
    );
    XY_forskydning();
    htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem');
}

# PROGRAM-MODUL;
function Rude_FormRedigerOrdrelin() {
  htm_Rude_Top($name= 'redigerform',$capt= '@Rediger Formular: Ordrelinier',$parms='',$icon='fa-wrench','panelW960',__FUNCTION__);
  htm_TabelInp(     # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
     $HeadLine= SetHeadArr('@Ordrelinjer'),
     $RowHead= array(  # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! ']
        ['Generelt: ',    '30%','right','text',' Ordreliniers placering på siden: ','Tip','.?.'],
      ),
      $ColStyle= array( # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],
        ['@Linie antal',  '8%','','text','center',  tolk('@Antal ordrelinier på en side.'),'.n.'],
        ['@Y-Top-linie',  '8%','','text','center',  tolk('@Første ordrelines y-startpunkt målt i mm fra side-bund'),'.y.'],
        ['@Linieafstand', '8%','','text','center',  tolk('@Afstand mellem liniers grundlinie, målt i mm. '),'.Afstand [mm].'],
        ['@Bredde af beskrivelse', '8%','', 'text', 'center',tolk('@Maksimal linie længde for beskrivelse, inden der brydes til ny linie, målt i mm. '),'.Bredde [mm].'],
        ),
      $RowTail= array(  # ['0:ColLabl', '1:ColWidth', '2:disp!', '3:InpType', '4:FeltJust', '5:ColTip', '6:value!']
        ['@Note',         '30%','','text','center','@(planlagt)','.?.'],
      ),
      $data= array(1), # Antal rows ved DEMO
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
        ['@Note:','20%','','text','center',  tolk('@(Ikke implementeret endnu!)'),'.?.']
      ), 
      $data= array( [['£posnr'],['X-pos'],['Højde'],['Farve'],['Just'],['Font'],['Fed'],['Skrå'],['@Note']],
                    [['£varenr'],['X-pos'],['Højde'],['Farve'],['Just'],['Font'],['Fed'],['Skrå'],['@Note']],
                    [['£beskrivelse'],['X-pos'],['Højde'],['Farve'],['Just'],['Font'],['Fed'],['Skrå'],['@Note']],
                    [['£antal'],['X-pos'],['Højde'],['Farve'],['Just'],['Font'],['Fed'],['Skrå'],['@Note']],
                    [['£liniesum'],['X-pos'],['Højde'],['Farve'],['Just'],['Font'],['Fed'],['Skrå'],['@Note']],
                    [['Nyt felt'],['X-pos'],['Højde'],['Farve'],['Just'],['Font'],['Fed'],['Skrå'],['@Note']] ), 
                    # [[0:Feltnavn],[1:X-pos],[2:Højde],[3:Farve],[4:Just.],[5:Font],[6:Fed],[7:Skrå],[8:Evt. Note:],[... ]]
        $PadTop= '10px'
    );
//    msg_Dialog('warn',ucfirst(tolk('@Retur')),'JavaScript:window.history.back();',ucfirst(tolk('@Fortsæt')), $Knap2_function='$jQ112(this).dialog("close")','','',ucfirst(tolk('@Her er problemer!')), ucfirst(tolk('@Der er ikke styr på ordreliniers data!')));
    XY_forskydning();
    htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem');
}

# PROGRAM-MODUL;
function Rude_MomsSetup() {
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
      $PadTop='2px' 
     );

   echo '<hr>';
  htm_TabelInp(     # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      $HeadLine= array( [' ', '8%','left','show', '', '@Rapporter'] ),
      $RowHead= array(  # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! ']
        ['@Momsrapport (konti som skal indgå i momsrapport): ',    '24%','right','text','@Rap: ','@Den moms du skal betale til SKAT','.?.'],
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
      $PadTop='2px' 
     );
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem');
}

# PROGRAM-MODUL;
function Rude_Stamdata () { 
  htm_Rude_Top($name='stamkort',$capt='@Stamdata:',$parms='',$icon='fa-user',$klasse='panelW320',__FUNCTION__);
  htm_CombFelt($type='text',  $name='firmanavn',  $valu= $firmanavn,  $titl='@Navnet på det firma, regnskabet angår',   $labl='@Firmanavn',   $revi=true);
  htm_FrstFelt('50%');  htm_CombFelt($type='text',  $name='addr1',      $valu= $addr1,      $titl='@Firmaets adresse',                        $labl='@Adresse',     $revi=true);
  htm_NextFelt('50%');  htm_CombFelt($type='text',  $name='addr2',      $valu= $addr2,      $titl='@Supplerende stedsangivelse',              $labl='@Sted',        $revi=true);
  htm_LastFelt();
  htm_FrstFelt('25%');  htm_CombFelt($type='text',  $name='postnr', $valu= $postnr, $titl='@Postnr',                    $labl='@Postnr.',     $revi=true);
  htm_NextFelt('75%');  htm_CombFelt($type='text',  $name='bynavn', $valu= $bynavn, $titl='@Bynavn. firmaets hjemsted', $labl='@Bynavn',      $revi=true);
  htm_LastFelt();
  htm_FrstFelt('50%');  htm_CombFelt($type='mail',  $name='ny_email',   $valu= $ny_email,   $titl='@Firmaets Mail-adresse',                   $labl='@Mail',        $revi=true);
  htm_NextFelt('50%');  htm_CombFelt($type='text',  $name='homepage',   $valu= $homepage,   $titl='@Firmaets hjemmeside-adresse',             $labl='@Hjemmeside',  $revi=true);
  htm_LastFelt();
  htm_CombFelt($type='text',  $name='bank_navn',  $valu= $bank_navn,  $titl='@Bank forbindelse',                        $labl='@Bank',        $revi=true);
  htm_FrstFelt('25%');  htm_CombFelt($type='text',  $name='bank_reg',   $valu= $bank_reg,   $titl='@Bank reg.',         $labl='@Bank reg.',   $revi=true);
  htm_NextFelt('75%');  htm_CombFelt($type='text',  $name='bank_konto', $valu= $bank_konto, $titl='@Bank konto',        $labl='@Bank konto',  $revi=true);
  htm_LastFelt();
  htm_CombFelt($type='text',  $name='cvrnr',      $valu= $cvrnr,      $titl='@CVR - Virksomheds ID. Tast CVR-nr. omsluttet af *, +, eller / for at importere data fra Erhvervsstyrelsen (Data leveres af CVR API)', $labl='@CVR',       $revi=true);
  htm_FrstFelt('50%');  htm_CombFelt($type='text',  $name='tlf',        $valu= $tlf,        $titl='@Tlf - Tast telefonnr. omsluttet af *, +, eller / for at importere data fra Erhvervsstyrelsen (Data leveres af CVR API)',              $labl='@Telefon.',  $revi=true);
  htm_NextFelt('50%');  htm_CombFelt($type='text',  $name='fax',        $valu= $fax,        $titl='@Firmaets fax',                            $labl='@Fax',         $revi=true);
  htm_LastFelt();
  if (!$pbs_nr) {
    htm_FrstFelt('40%');  htm_CombFelt($type='text',  $name='pbs_nr', $valu= $pbs_nr, $titl='@Firmaets pbsnr',  $labl='@PBS Kreditornr.', $revi=true);
    htm_NextFelt('60%');  {if      ($pbs=='B') $listen= array(['','B','@Basis løsning'], ['','', '@Total løsning'], ['','L','@Lev. Service']);
                           elseif  ($pbs=='L') $listen= array(['','L','@Lev. Service'],  ['','B','@Basis løsning'], ['','', '@Total løsning']);
                           else                $listen= array(['','', '@Total løsning'], ['','B','@Basis løsning'], ['','L','@Lev. Service']);
                           htm_OptioFlt($type='text',  $name='pbs',    $valu= $pbs,  $titl='@Vælg den aftalte løsning',  $labl='@Aftale',  $revi=true, $optlist= $listen, $action='');
                          }
    htm_LastFelt();
  } else  htm_CombFelt($type='text',  $name='pbs_nr', $valu= $pbs_nr, $titl='@Firmaets pbsnr',  $labl='@PBS Kreditornr.',   $revi=true);
  htm_CombFelt($type='text',  $name='gruppe', $valu= $gruppe, $titl='@Gruppe ',                 $labl='@PBS debitorgruppe', $revi=true);
  htm_CombFelt($type='text',  $name='fi_nr',  $valu= $fi_nr,  $titl='@Bankernes fælles indbetalingskort (FI-kort). Her angiver du dit FI Kreditornr.',    $labl='@FI Kreditornr.',    $revi=true);
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem');
}

# PROGRAM-MODUL;
function Rude_Ansatte () { 
  htm_Rude_Top($name='stamkort',$capt='@Ansatte:',$parms='',$icon='fa-user',$klasse='panelW320',__FUNCTION__);
  htm_FrstFelt('50%');    htm_CombFelt($type='text',  $name='Medarbejdernr',$valu= $Medarbejdernr,  $titl='@Bank reg.', $labl='@Medarbejdernr', $revi=true);  
  htm_NextFelt('50%');    htm_CombFelt($type='text',  $name='Cpr-nr',       $valu= $bankkto,    $titl='@Cpr-nr',      $labl='@Cpr-nr',    $revi=true);  
  htm_lastFelt(); 
  htm_FrstFelt('75%');    htm_CombFelt($type='text',  $name='Navn',         $valu= $Navn,       $titl='@Navn.',       $labl='@Navn',      $revi=true);  
  htm_NextFelt('25%');    htm_CombFelt($type='text',  $name='Initialer',    $valu= $Initialer,  $titl='@Initialer',   $labl='@Initialer', $revi=true);  
  htm_lastFelt(); 
  htm_FrstFelt('50%');    htm_CombFelt($type='text',  $name='Adresse',      $valu= $Adresse,    $titl='@Adresse.',    $labl='@Adresse.',  $revi=true);  
  htm_NextFelt('50%');    htm_CombFelt($type='text',  $name='Adresse2',     $valu= $Adresse2,   $titl='@Adresse2',    $labl='@Sted',      $revi=true);  
  htm_lastFelt();   
  htm_FrstFelt('25%');    htm_CombFelt($type='text',  $name='Postnr',       $valu= $Postnr,     $titl='@Postnr.',     $labl='@Postnr.',     $revi=true);  
  htm_NextFelt('75%');    htm_CombFelt($type='text',  $name='By',           $valu= $By,         $titl='@By',          $labl='@By',          $revi=true);  
  htm_lastFelt();   
  htm_FrstFelt('50%');    htm_CombFelt($type='mail',  $name='e-mail',       $valu= $Mail,       $titl='@Medarbejderens mail', $labl='@Mail',  $revi=true);  
  htm_NextFelt('50%');    htm_CombFelt($type='text',  $name='Mobil',        $valu= $Mobil,      $titl='@Mobil',       $labl='@Mobil',       $revi=true);  
  htm_lastFelt(); 
  htm_FrstFelt('50%');    htm_CombFelt($type='text',  $name='Lokalnr.',     $valu= $Lokalnr,    $titl='Lokalnr.',     $labl='@Lokalnr.',   $revi=true);
  htm_NextFelt('50%');    htm_CombFelt($type='text',  $name='Lokal fax',    $valu= $Lokalfax,   $titl='@Lokal fax',   $labl='@Lokal fax',  $revi=true);
  htm_lastFelt(); 
  htm_FrstFelt('50%');    htm_CombFelt($type='text',  $name='Privat tlf',   $valu= $Privattlf,  $titl='@Privat tlf',  $labl='@Privat tlf',  $revi=true);
  htm_NextFelt('50%');    htm_CombFelt($type='text',  $name='Bank',         $valu= $Bank,       $titl='@Bank',        $labl='@Bank.',       $revi=true);
  htm_lastFelt(); 
  htm_FrstFelt('50%');    htm_CombFelt($type='text',  $name='Løn',          $valu= $Løn,        $titl='@Løn',         $labl='@Løn',       $revi=true);
  htm_NextFelt('50%');    htm_CombFelt($type='text',  $name='Løntillæg',    $valu= $Løntillæg,  $titl='@Løntillæg',   $labl='@Løntillæg', $revi=true);
  htm_lastFelt();
                          htm_CombFelt($type='area',  $name='Bemærkning',   $valu= $Bemærkning, $titl='@Bemærkning', $labl='@Bemærkning',  $revi=true);
  htm_FrstFelt('50%');    htm_CombFelt($type='date',  $name='Tiltrådt',     $valu= $Tiltrådt,   $titl='@Tiltrådt',    $labl='@Tiltrådt',  $revi=true);
  htm_NextFelt('50%');    htm_CombFelt($type='date',  $name='Fratrådt',     $valu= $Fratrådt,   $titl='@Fratrådt',    $labl='@Fratrådt',  $revi=true);
  htm_lastFelt();
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem');
}


# PROGRAM-MODUL;
function Rude_Brugere () { global $ØtblRowDrk, $ØtblRowLgt;
  function TblRow($span1,$Txt1,$repe,$span2,$Txt2){
    echo '<tr><td colspan= '.$span1.' align=right> '.tolk($Txt1).' &nbsp;</td>'.str_repeat('<td align=center>|</td>',$repe).'<td colspan='.$span2.'> &nbsp;'.tolk($Txt2).'</td></tr>'; }
  function UserRett($ix,$name){
  if (substr($row[rettigheder], $ix,1)==0) {echo '<td><input class=\"inputbox\" type=checkbox name='.$name.' title='.$name.'></td>';}     
  else                                     {echo '<td><input class=\"inputbox\" type=checkbox name='.$name.' title='.$name.' checked></td>';}}
  
  $bgcolor5= $ØtblRowDrk;
  $bgcolor=  $ØtblRowLgt;
  $colbg= $ØtblRowDrk;
  htm_Rude_Top($name='brugkort',$capt='@Bruger rettigheder:',$parms='',$icon='fa-user',$klasse='panelW640',__FUNCTION__);
  echo '<table cellpadding="0" cellspacing="0" border="0" width="70%"><tbody style="font-size: 15px;">';
  echo '<tr><td colspan=2></td>'.str_repeat('<td align=center width=1% style="color: $bgcolor;">_</td>', 25).'</tr>';
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
  TblRow( 2,'',               16, 9,'');
  echo '<tr><td> '.tolk('@Navn').':&nbsp;</td><td> '.tolk('@Brugernavn').':</td></tr>';
  if (true) echo '<tr><td> $r2[initialer]&nbsp;</td><td><axx href=brugere.php?ret_id=$row[id]> $row[brugernavn]</axx></td>';
  else      echo '<td align=center bgcolor="$colbg">*</td>';  
  for ($y=0; $y<=15; $y++) {
    if ($colbg!=$bgcolor) {$colbg=$bgcolor; $color='#000000';}  else {$colbg=$bgcolor5; $color='#000000';}
    if (substr($row[rettigheder],$y,1)==0) 
          echo '<td bgcolor="$colbg"></td>';
    else  echo '<td align=center bgcolor="$colbg">*</td>';
  }
  echo '</tr>';
  
  echo '<tr><td>'.tolk('@Ny bruger').'</td>';
  echo '<input type=hidden name=id value=$row[id]>';
  $tmp="navn".rand(100,999);        #For at undgaa at browseren "husker" et forkert brugernavn.
  echo '<input type=hidden name=random value=$tmp>';
  echo '<td><input class="inputbox" type="text" size=12 name=$tmp value="$row[brugernavn]"></td>';
  UserRett( 0,'kontoplan');       
  UserRett( 1,'indstillinger');   
  UserRett( 2,'kassekladde');     
  UserRett( 3,'regnskab');        
  UserRett( 4,'finansrapport');   
  UserRett( 5,'debitorordre');    
  UserRett( 6,'debitorkonti');    
  UserRett( 7,'kreditorordre');   
  UserRett( 8,'kreditorkonti');   
  UserRett( 9,'varer');           
  UserRett(10,'enheder');         
  UserRett(11,'backup');          
  UserRett(12,'debitorrapport');  
  UserRett(13,'kreditorrapport'); 
  UserRett(14,'produktionsordre');
  UserRett(15,'varerapport');     
  print "</tr>";
  print "<tr><td>Adgangskode</td><td><input class=\"inputbox\" type=password size=12 name=kode value='********************'></td></tr>";
  print "<tr><td>Gentag kode</td><td><input class=\"inputbox\" type=password size=12 name=kode2 value='********************'></td></tr>";
  echo '</tbody></table>';
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem');
}

function Rude_Valuta() {
  htm_Rude_Top($name= 'valuform',$capt= '@Valutaer: ',$parms='',$icon='fa-eur','panelW320',__FUNCTION__);
  echo '<colrlabl>'.tolk('@Oprettede valutaer:').'</colrlabl>';
  htm_Tabel($RowLabl='@ændre valuta',
            $ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
              ['@Valuta.',     '25%','', 'text',  'left',   '@Valuta benævnelse','@Valu...'],
              ['@Beskrivelse', '60%','', 'text',  'left',   '@Valuta beskrivelse','@Besk...'],
              ['@Kurs',        '15%','', 'text',  'center', '@Aktuel kurs...','@Kurs...'],
            ),
            $TablData= [['DKK','Danske kroner','100'],['EUR','Europæiske Euro','100'],['USD','Amerikanske Dollar','100']],  # ImportTabFile('../_export-import/varer.tab'),  // Indlæs data fra TAB-fil
            $FilterOn=false, $SorterOn=false, $CreateRec=true, $ViewHeight='200px' );
  $optlist= [['Danske kroner','DKK','DKK - Danmark'],['Europæisk Euro','EUR','EUR - EU fællesskabet'],
             ['US dollar','USD','USD - Amerikanske dollar'],['Pund Sterling','GBP','GBP - Det Forenede Kongerige']];
  echo '<colrlabl>'.tolk('@Oversigt over populære valutaer:').'</colrlabl>';
  htm_OptioFlt($type='text',  $name='vkode',      $valu= '',      
                    $titl='@Her kan du slå op, og se mulige valuta-koder', 
                    $labl='@Valutaer',   $revi=true, $optlist, $action='');
  $filDATA= ImportTabFile('../_export-import/ISO-valutaer.tab',1,'UTF-x');    $optlist= [];
  foreach ($filDATA as $rec) {array_push($optlist, [ $rec[2].' / '.$rec[3], $rec[0], $rec[0].' : '.$rec[1] ]);}
  echo '<br><colrlabl>'.tolk('@Oversigt over alle valutaer:').'</colrlabl>';
  htm_OptioFlt($type='text',  $name='vkode',      $valu= '',      
                    $titl='@Her kan du slå op, og se mulige valuta-koder', 
                    $labl='@Valutaer',   $revi=true, $optlist, $action='');
#  echo '<div style="text-align:center;">'; 
#  echo  textKnap($label='@Opret ny valuta',  $title='@Klik her for at...',$link='../_base/page_Blindgyden.php').
#        textKnap($label='@Ordrebeholdning', $title='@Opslag - Se oversigt over ordrebeholdning',$link='../_base/page_Blindgyden.php').
#        textKnap($label='@Visning',         $title='@Visning - Vælg hvad der skal vises',$link='../_base/page_Blindgyden.php').
#   '</div>';
  echo '<br>';
  htm_RudeBund($pmpt='@Gem',$subm=false,$title='@Gem');
}

function Rude_Valutakort() {
  htm_Rude_Top($name= 'kortform',$capt= '@Valuta ændringer: ',$parms='',$icon='fa-eur','panelW320',__FUNCTION__);
  $valuta= 'DKK';   $beskriv= 'Danske kroner';
  echo '<colrlabl>'.tolk('@Vedligeholdese af:').'</colrlabl> '.$valuta.' - '.$beskriv;
  htm_Tabel($RowLabl='@se / rette valuta',
            $ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
              ['@Valør dato',     '30%','', 'date',  'center',   '@Den dato kursen er gældende fra','@dato...'],
              ['@Ændrings kurs',  '40%','', 'text',  'center',   '@Værdien i DKK af 100 '.$valuta,'@kurs...'],
              ['@Diff. konto',    '30%','', 'text',  'center', '@Kontonummer fra kontoplanen som skal bruges til valutakursdifferencer og øreafrunding...','@konto...'],
            ),
            $TablData= [['Dato','Kurs','konto'],['Dato','Kurs','konto'],['Dato','Kurs','konto'],['Dato','Kurs','konto'],['Dato','Kurs','konto'],['Dato','Kurs','konto']],  # ImportTabFile('../_export-import/varer.tab'),  // Indlæs data fra TAB-fil
            $FilterOn=false, $SorterOn=false, $CreateRec=true, $ViewHeight='200px' );
#  echo '<div style="text-align:center;">'; 
#  echo  textKnap($label='@Opret ny',  $title='@Klik her for at...',$link='../_base/page_Blindgyden.php').
#        textKnap($label='@Ordrebeholdning', $title='@Opslag - Se oversigt over ordrebeholdning',$link='../_base/page_Blindgyden.php').
#        textKnap($label='@Visning',         $title='@Visning - Vælg hvad der skal vises',$link='../_base/page_Blindgyden.php').
#   '</div>';
  htm_RudeBund($pmpt='@Gem',$subm=false,$title='@Gem');
}

function Rude_Enheder () {
  htm_Rude_Top($name= 'enhedform',$capt= '@Enheder og materialer: ',$parms='',$icon='','panelW320',__FUNCTION__);
  htm_TabelInp(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
    $HeadLine= array( [' ', '50%','left','show', '', '@Enhedsbetegnelser'] ),
    $RowHead= array(),  # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! ']
    $ColStyle= array( # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],
      ['@Enhed.',       '25%','', 'text','left',tolk('@Enhedsbetegnelse').' ','Enh...'],
      ['@Beskrivelse',  '75%','', 'text','left',tolk('@Beskrivelse af enheden'),'Beskr...'],
      ),
    $RowTail= array(),  # ['0:ColLabl', '1:ColWidth', '2:disp! ', '3:InpType', '4:FeltJust', '5:ColTip', '6:value! ']
        $data= array(1,2,3),  # Antal rows ved DEMO
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
        $PadTop='0px'
  );
### PanelFooter:
  NaviTip();
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem');
}

function Rude_Beholdningsliste() {
  htm_Rude_Top($name= 'behlform',$capt= '@Beholdningsliste:',$parms='../_base/page_Gittermenu.php',$icon='fa-database','panelW640',__FUNCTION__);
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem');
}

# PROGRAM-MODUL;
function Rude_Rabatgrupper($vg_antal=4, $vrg_antal=true, $dg_antal=3, $drg_antal=true) {
  htm_Rude_Top($name= 'rabbform',$capt= '@Rabatgrupper:',$parms='../_base/page_Gittermenu.php',$icon='fa-database','panelW640',__FUNCTION__);
  echo '<div style="text-align:center;">'; 
  echo  textKnap($label='@Definer selv debitor-rabatgrupper',  $title='@Klik her for at håndtere dine debitor rabatgrupper',$link='../_base/page_Blindgyden.php').'<hr>';
  echo  textKnap($label='@Definer selv vare-rabatgrupper',     $title='@Klik her for at håndtere dine vare rabatgrupper',$link='../_base/page_Blindgyden.php').'<hr>';
  echo '</div>';
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
    htm_OptioFlt($type='text', $name='enhed0', $valu= $rabatart[$x], $titl='@Vælg den rabat-metode, du ønsker at bruge.',  
                    $labl='', $revi=true, $optlist, $action='');
    for ($y=1;$y<=$vg_antal;$y++) { //  Dette bør ændres så rutinen modtager data i arrays!
      if (!$dg[$x][0]) {
        if ($id[$x][$y]) $rabat[$x][$y]=str_replace(".",",",$rabat[$x][$y]);
        else $rabat[$x][$y]=NULL; 
        htm_NextFelt('12%');  ////  Data:
        htm_HiddVari($name='id['.$x.']',$val=$id[$x][$y]);                # print '<input type="hidden" name="id['.$x.']['.$y.']" value="'.$id[$x][$y].'">';
        htm_HiddVari($name='rabat['.$x.']['.$y.']',$val=$rabat[$x][$y]);  # print '<input type="hidden" name="rabat['.$x.']['.$y.']" value="'.$rabat[$x][$y].'">';
        htm_HiddVari($name='drg_antal',$val=$drg_antal);                  # print '<input type="hidden" name="drg_antal" value="'.$drg_antal.'">';
        htm_CombFelt($type='text',$name='ny_rabat['.$x.']['.$y.']',$valu='',$titl='Feltnavn',$labl='VG'.$y,$revi=true,$rows='2',$width='20px',$step='',$more='');
        # print '<td align="center"><input class="inputbox" type="text" style="text-align:right;width:35px" name="ny_rabat['.$x.']['.$y.']" value="'.$rabat[$x][$y].'"</td>';
      } ;#else print '<td colspan="vg_antal"><br></td>';
    }
#    print '<td>&nbsp;</td></tr>\n';
    htm_LastFelt(); 
  }
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem');
}

function Rude_Varegrupper() {
  htm_Rude_Top($name= 'systform',$capt= '@Varegrupper:',$parms='../_base/page_Gittermenu.php',$icon='fa-database','panelW960',__FUNCTION__);
  echo '<div style="text-align:center"><colrlabl>Varegrupper</colrlabl></div>';
  htm_TabelInp(
    $HeadLine= array(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      ['@----  &nbsp; ', '20%','left','text', '@Varegrupper', '@Varegrupper'], 
//     ['@Konto-kontrol:','5em','left','text', '@Angiv kontonummer for den konto, hvis bevægelser skal kontrolleres',  '@Nummer...'], 
    ),
    $RowHead= array( #  ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! ']  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
       #   ['',     '3%','center','text','D',tolk('@Medlem af debitorgruppe'),'']
          ),
    $ColStyle= array( # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],
      ['@Nr',               '3%','','data', 'center', '@Gruppe nummer'.' ','.?.'],
      ['@Beskrivelse',     '15%','','data', 'left',   '@Beskrivelse af gruppen','@Besk...'],
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
       ['@Opera-tion',       '6%', '','text','center',  '@Operation. Afmærk her, hvis ..','<a hrefxxx='.$link.' ><input type= "checkbox" name="italic" value="" ></a>','.?.'],
      ), 
              $data= array(
              [['1'],['Ydelser'],[''],[''],['2900'],['1000'],[''],['2700'],['1200'],['2720'],['1250']],
              [['2'],['Handelsvarer'],['55100'],['55100'],['2100'],['1100'],['2600'],['2800'],['1220'],['2820'],['1270']],
              [['3'],['Forbrugsvarer'],[''],[''],['2100'],['1100'],[''],['2800'],['1220'],['2820'],['1270']],
              [['4'],['Fragt/porto'],[''],[''],['2300'],['1300'],[''],['2700'],['1200'],['2720'],['1250']],
              [[''],[''],[''],[''],[''],[''],[''],[''],[''],[''],['']],
              ),  #  DEMOdata
      '0px'
  );
  echo '<br>';
  echo '<div style="text-align:center"><colrlabl>Vare-Prisgrupper</colrlabl></div>';
    htm_TabelInp(
    $HeadLine= array(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      ['@----  &nbsp; ', '20%','left','text', '@Prisgrupper', '@Prisgrupper'], 
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
      '0px'
  );
  echo '<br>';
  echo '<div style="text-align:center"><colrlabl>Vare-Tilbudsgrupper</colrlabl></div>';
    htm_TabelInp(
    $HeadLine= array(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      ['@----  &nbsp; ', '20%','left','text', '@Tilbudsgrupper', '@Tilbudsgrupper'], 
    ),
    $RowHead= array( #  ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp! ', '4:disp! ', '5:ColTip', '6:disp! ']  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
          ),
    $ColStyle= array( # ['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],
      ['@Nr',            '3%','','data', 'center', '@Gruppe nummer'.' ','.?.'],
      ['@Beskrivelse',  '15%','','data', 'left',   '@Beskrivelse af gruppen','@Besk...'],
      ['@Kost-pris',     '6%','','data', 'center', '@Konto for...','@Kost...'],
      ['@Salgs-pris',    '6%','','data', 'center', '@Konto for...','@Salgs..'],
      ['@Start-dato',    '6%','','data', 'center', '@Konto for...','@Strt..'],
      ['@Slut-dato',     '6%','','data', 'center', '@Konto for...','@Slut..'],
      ),
$RowTail= array(  # ['0:ColLabl', '1:ColWidth', '2:disp!', '3:InpType', '4:FeltJust', '5:ColTip', '6:value!']
       ['',         '30%', '','text','center',  '','','.?.'],
     ), 
              $data= array(
              [[''],[''],[''],[''],[''],[''],[''],[''],[''],[''],['']],
              ),  #  DEMOdata
      '0px'
  );
  echo '<br>';
  echo '<div style="text-align:center"><colrlabl>Vare-Rabatgrupper</colrlabl></div>';
    htm_TabelInp(
    $HeadLine= array(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      ['@----  &nbsp; ', '20%','left','text', '@Rabatgrupper', '@Rabatgrupper'], 
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
      '0px'
  );
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem, hvis du har ændret noget ovenfor.');
}

function Rude_DefKredGrp() {
  htm_Rude_Top($name= 'grupform',$capt= '@Debitor- & Kreditor-grupper:',$parms='../_base/page_Gittermenu.php',$icon='fa-database','panelW960',__FUNCTION__);
  echo textKnap($label='@INFO', $title='@Her er lidt forklaring omkring brugen af grupper.', $link= '../_base/page_GruppeInfo.php');
  htm_TabelInp(
    $HeadLine= array(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      ['@----  &nbsp; ', '20%','left','text', '@Debitorgrupper', '@Debitorgrupper'], 
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
      '0px'
  );
  echo '<br>';
  htm_TabelInp(
    $HeadLine= array(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      ['@----  &nbsp; ', '20%','left','text', '@Kreditorgrupper', '@Kreditorgrupper'], 
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
    '0px'
  );
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem');
}

  
function Rude_Syssetup() {
  htm_Rude_Top($name= 'systform',$capt= '@Varegrupper:',$parms='../_base/page_Gittermenu.php',$icon='fa-database','panelW960',__FUNCTION__);
  $spantekst1= tolk('@En beskrivende tekst efter eget valg');
	$spantekst2= tolk('@Det nummer i kontoplanen som salgsmomsen skal konteres p&aring;.');
	$spantekst3= tolk('@Moms %.');

  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem');
}

# PROGRAM-MODUL;
function Rude_Varer() {
  htm_Rude_Top($name= 'vareform',$capt= '@Vareliste:',$parms='../_base/page_Gittermenu.php',$icon='fa-database','panelWmax',__FUNCTION__);
  htm_Tabel($RowLabl='@se varekort',
            $ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
              ['@Varenr.',    '7%','', 'text',  'left',   '@Varenummer. Entydig nummerkode, som benyttes til sortering, summering mv.','@Numr...'],
              ['@Enhed',      '5%','', 'text',  'left',   '@Kontonavn - beskrivende tekst','@Enh...'],
              ['@Beskrivelse','33%','','text',  'left',   '@Beskrivende tekst, som benyttes ved ordre/faktura','@Besk...'],
              ['@Kostpris',   '6%','', 'text',  'right',  '@Tilknyttet note','@Kost...'],
              ['@Salgspris',  '6%','', 'text',  'right',  '@Tilknyttet note','@Salgs...'],
              ['@Vejl_pris',  '6%','', 'text',  'right',  '@Tilknyttet note','@Vejl...'],
              ['@Note',      '10%','', 'text',  'center',   '@Tilknyttet note','@Note...'],
              ['@Gruppe',     '5%','', 'text',  'left',   '@Varegruppe','@Grup...'],
              ['@Beholdn.',   '6%','', 'text',  'center', '@Lagerbeholdning','@Beh...'],
              ['@Lokation.',  '6%','', 'text',  'center', 'Hvor varen befinder sig','@Lok...'],
              ),
            $TablData= ImportTabFile('../_export-import/varer.tab'),  // Indlæs data fra TAB-fil
            $FilterOn=true, $SorterOn=false, $CreateRec=true, $ViewHeight='200px' );
  echo '<div style="text-align:center;">'; 
  echo  textKnap($label='@Indkøbsforslag',  $title='@Klik her for at lave et indkøbsforslag',$link='../_base/page_Blindgyden.php').
        textKnap($label='@Ordrebeholdning', $title='@Opslag - Se oversigt over ordrebeholdning',$link='../_base/page_Blindgyden.php').
        textKnap($label='@Visning',         $title='@Visning - Vælg hvad der skal vises',$link='../_base/page_Blindgyden.php').
   '</div>';
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Retur til hovedmenu');
}


# PROGRAM-MODUL;
function Rude_Varekort() {
  htm_Rude_Top($name= 'varekortform',$capt= '@Varekort:',$parms='',$icon='fa-pencil-square-o','panelW960',__FUNCTION__);
    
  SpalteTop(320);
  htm_Rude_Top($name= 'varekortform1',$capt= '@Generelt:',$parms='',$icon='fa-pencil-square-o','panelW320',__FUNCTION__);
  htm_CombFelt($type='text',  $name='regn', $valu= $regnskab,   $titl='@Angiv en tekst der beskriver produktet', $labl='@Beskrivelse',  $revi=true, $rows='2',$width='',$step='', $more='required="required" placeholder="'.tolk('@Beskrivelse...').'"');
  /* htm_CombFelt($type='text',  $name='regn', $valu= $regnskab,   $titl='@Angiv en tekst der beskriver produktet', $labl='@Jysk',  $revi=true, $rows='2',$width='',$step='' ); */
  htm_CombFelt($type='text',  $name='regn', $valu= $regnskab,   $titl='@Angiv en tekst der beskriver ...', $labl='@Varemærke',  $revi=true, $rows='2',$width='',$step='' );
  htm_FrstFelt('50%');    htm_CombFelt($type='text',  $name='regn', $valu= $regnskab,   $titl='@Angiv en tekst som skal benyttes som stregkode', $labl='@Stregkode',  $revi=true, $rows='2',$width='',$step='' );
  htm_NextFelt('50%');    htm_CombFelt($type='text',  $name='regn', $valu= $regnskab,   $titl='@Her vises stregkoden', $labl='',  $revi=true, $rows='2',$width='',$step='' );
  htm_lastFelt(); 
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem');
  NextSpalte(320);
  htm_Rude_Top($name= 'varekortform1',$capt= '@Iøvrigt:',$parms='',$icon='fa-pencil-square-o','panelW320',__FUNCTION__);
  htm_CombFelt($type='area',$name='noter',$valu= $noter,  $titl='@Angiv Bemærkninger',  $labl='@Bemærkning',    $revi=true, $rows='1');
  htm_FrstFelt('30%');    htm_CheckFlt($type='checkbox',$name='ser', $valu= '',  $titl='@Serienr',  $labl='@Serienr',  $revi=false, $more=' '.$pg);
  htm_NextFelt('40%');    htm_CheckFlt($type='checkbox',$name='saml', $valu= '',  $titl='@xxx',  $labl='@Samlevare',  $revi=false, $more=' '.$pg);
  htm_NextFelt('30%');    htm_CheckFlt($type='checkbox',$name='udgaa', $valu= '',  $titl='@xxx',  $labl='@Udgået',  $revi=false, $more=' '.$pg);
  htm_lastFelt(); 
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem');
  EndSpalter();
  
  SpalteTop(240);
  htm_Rude_Top($name= 'varekortform1',$capt= '@Enheds Priser:',$parms='',$icon='fa-pencil-square-o','panelW240',__FUNCTION__);
  /* echo 'Pr. Enhed:'; */
  htm_CombFelt($type='tal2dc',  $name='regn', $valu= $regnskab,   $titl='@Angiv en tekst der beskriver ...', $labl='@Salgspris',  $revi=true, $rows='2',$width='',$step='');
  htm_CombFelt($type='tal2dc',  $name='regn', $valu= $regnskab,   $titl='@Angiv en tekst der beskriver ...', $labl='@B2B salgspris',  $revi=true, $rows='2',$width='',$step='' );
  htm_CombFelt($type='tal2dc',  $name='regn', $valu= $regnskab,   $titl='@Angiv en tekst der beskriver ...', $labl='@Vejledende pris',  $revi=true, $rows='2',$width='',$step='' );
  htm_CombFelt($type='tal2dc',  $name='regn', $valu= $regnskab,   $titl='@Angiv en tekst der beskriver ...', $labl='@Kostpris',  $revi=true, $rows='2',$width='',$step='' );
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem');
  
  htm_Rude_Top($name= 'varekortform1',$capt= '@Tilbud:',$parms='',$icon='fa-pencil-square-o','panelW240',__FUNCTION__);
  htm_CombFelt($type='tal2dc',  $name='regn', $valu= $regnskab,   $titl='@Angiv en tekst der beskriver ...', $labl='@Salgspris',  $revi=true, $rows='2',$width='',$step='');
  htm_CombFelt($type='tal2dc',  $name='regn', $valu= $regnskab,   $titl='@Angiv en tekst der beskriver ...', $labl='@Kostpris',  $revi=true, $rows='2',$width='',$step='' );
  htm_CombFelt($type='date',  $name='regn', $valu= $regnskab,   $titl='@Angiv en tekst der beskriver ...', $labl='@Dato start',  $revi=true, $rows='2',$width='',$step='' );
  htm_CombFelt($type='date',  $name='regn', $valu= $regnskab,   $titl='@Angiv en tekst der beskriver ...', $labl='@Dato slut',  $revi=true, $rows='2',$width='',$step='' );
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem');
    
  htm_Rude_Top($name= 'varekortform1',$capt= '@Mængederabatter:',$parms='',$icon='fa-pencil-square-o','panelW240',__FUNCTION__);
  htm_OptioFlt($type='text',  $name='enhed0',    $valu= $enhed0,  
                    $titl='@Vælg den enhed du ønsker at bruge.',  
                    $labl='@Rabat metode',         $revi=true, $optlist= array(
                    ['','%','%'],
                    ['','Kr.','Kr.']),$action='');
  htm_FrstFelt('50%');    htm_CombFelt($type='text',  $name='regn', $valu= $regnskab,   $titl='@Antal...', $labl='Stk. rabat v. antal',  $revi=true, $rows='2',$width='',$step='', $more='placeholder="'.tolk('@Antal...').'"');
  htm_NextFelt('50%');    htm_CombFelt($type='text',  $name='regn', $valu= $regnskab,   $titl='@Antal...', $labl='%- rabat v. antal',  $revi=true, $rows='2',$width='',$step='', $more='placeholder="'.tolk('@Antal...').'"');
  htm_lastFelt(); 
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem');
  NextSpalte(320);
 
  htm_Rude_Top($name= 'varekortform1',$capt= '@Enheder:',$parms='',$icon='fa-pencil-square-o','panelW240',__FUNCTION__);
  htm_OptioFlt($type='text',  $name='enhed0',    $valu= $enhed0,  
                    $titl='@Vælg den enhed du ønsker at bruge.',  
                    $labl='@Enhed',         $revi=true, $optlist= array(
                    ['','Stk','Stk'],
                    ['','Palle','Palle']),$action='');
  htm_OptioFlt($type='text',  $name='enhed1',    $valu= $enhed1,  
                    $titl='@Vælg den alternative enhed du ønsker at bruge.',  
                    $labl='@Alternativt',         $revi=true, $optlist= array(
                    ['','Stk','Stk'],
                    ['','Palle','Palle']),$action='');
  htm_CombFelt($type='tal2dc',  $name='regn', $valu= $regnskab,   $titl='@Angiv en tekst der beskriver ...', $labl='@Indhold/enhed',  $revi=true, $rows='2',$width='',$step='' );
  htm_CombFelt($type='tal2dc',  $name='regn', $valu= $regnskab,   $titl='@Angiv en tekst der beskriver ...', $labl='@Pris/enhed',  $revi=true, $rows='2',$width='',$step='' );
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem');
 
  htm_Rude_Top($name= 'varekortform1',$capt= '@Beholdning:',$parms='',$icon='fa-pencil-square-o','panelW240',__FUNCTION__);
  htm_CombFelt($type='text',  $name='regn', $valu= $regnskab,   $titl='@Angiv en tekst der beskriver ...', $labl='@Lokation',  $revi=true, $rows='2',$width='',$step='', $more='placeholder="'.tolk('@Lok...').'"');
  htm_CombFelt($type='text',  $name='regn', $valu= $regnskab,   $titl='@Angiv en tekst der beskriver ...', $labl='@Følgevare',  $revi=true, $rows='2',$width='',$step='', $more='placeholder="'.tolk('@Følg...').'"');
  htm_FrstFelt('25%');    echo tolk('@Behold.:');
  htm_NextFelt('25%');    htm_CombFelt($type='tal1d',  $name='regn', $valu= $regnskab,   $titl='@Angiv ', $labl='@Min.',  $revi=true, $rows='2',$width='',$step='' );
  htm_NextFelt('25%');    htm_CombFelt($type='tal1d',  $name='regn', $valu= $regnskab,   $titl='@Angiv ', $labl='@Max.',  $revi=true, $rows='2',$width='',$step='' );
  htm_NextFelt('25%');    htm_CombFelt($type='tal1d',  $name='regn', $valu= $regnskab,   $titl='@Angiv ', $labl='@Aktuel',  $revi=true, $rows='2',$width='',$step='' );
  htm_lastFelt(); 
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem');
  
  htm_Rude_Top($name= 'varekortform1',$capt= '@Grupper:',$parms='',$icon='fa-pencil-square-o','panelW240',__FUNCTION__);
  htm_OptioFlt($type='text',  $name='enhed0',    $valu= $enhed0,  
                    $titl='@Vælg den enhed du ønsker at bruge.',  
                    $labl='@Varegruppe',         $revi=true, $optlist= array(
                    ['','Stk','Stk'],
                    ['','Palle','Palle']),$action='');
  htm_OptioFlt($type='text',  $name='enhed0',    $valu= $enhed0,  
                    $titl='@Vælg den enhed du ønsker at bruge.',  
                    $labl='@Prisgruppe',         $revi=true, $optlist= array(
                    ['','Stk','Stk'],
                    ['','Palle','Palle']),$action='');
  htm_OptioFlt($type='text',  $name='enhed0',    $valu= $enhed0,  
                    $titl='@Vælg den enhed du ønsker at bruge.',  
                    $labl='@Tilbudsgruppe',         $revi=true, $optlist= array(
                    ['','Stk','Stk'],
                    ['','Palle','Palle']),$action='');
  htm_OptioFlt($type='text',  $name='enhed0',    $valu= $enhed0,  
                    $titl='@Vælg den enhed du ønsker at bruge.',  
                    $labl='@Rabatgruppe',         $revi=true, $optlist= array(
                    ['','Stk','Stk'],
                    ['','Palle','Palle']),$action='');
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem');
   NextSpalte(320);
 
  htm_Rude_Top($name= 'varekortform1',$capt= '@Colli:',$parms='',$icon='fa-pencil-square-o','panelW240',__FUNCTION__);
  htm_CombFelt($type='tal2dc',  $name='regn', $valu= $regnskab,   $titl='@Angiv en tekst der beskriver ...', $labl='@Størrelse',  $revi=true, $rows='2',$width='',$step='');
  htm_CombFelt($type='tal2dc',  $name='regn', $valu= $regnskab,   $titl='@Angiv en tekst der beskriver ...', $labl='@Ydre størrelse',  $revi=true, $rows='2',$width='',$step='' );
  htm_CombFelt($type='tal2dc',  $name='regn', $valu= $regnskab,   $titl='@Angiv en tekst der beskriver ...', $labl='@Anbruds kostpris',  $revi=true, $rows='2',$width='',$step='' );
  htm_CombFelt($type='tal2dc',  $name='regn', $valu= $regnskab,   $titl='@Angiv en tekst der beskriver ...', $labl='@Kostpris',  $revi=true, $rows='2',$width='',$step='' );
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem');
  
  htm_Rude_Top($name= 'varekortform1',$capt= '@Kategorier:',$parms='',$icon='fa-pencil-square-o','panelW240',__FUNCTION__);
  htm_CombFelt($type='text',  $name='regn', $valu= $regnskab,   $titl='@Her kan du oprette en ny kategori', $labl='Opret ny',  $revi=true, $rows='2',$width='',$step='', $more='placeholder="'.tolk('@Angiv evt. navn på en ny kategori...').'"');
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem');
 
  htm_Rude_Top($name= 'varekortform1',$capt= '@Varianter:',$parms='',$icon='fa-pencil-square-o','panelW240',__FUNCTION__);
  echo '<br>';
  echo '<br>';
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem'); 
  EndSpalter();
  
  
  echo '<div style="text-align:center;">'; 
  echo  textKnap($label='@Ny Modtageliste',  $title='@Klik her for at oprette en ny modtagelse',$link='../_lager/page_Varemodtagelse.php').
        textKnap($label='@Leverandøropslag', $title='@Opslag - Se ...',$link='../_base/page_Blindgyden.php').
   '</div>';
  htm_RudeBund($pmpt='@Retur til vareliste',$subm=true,$title='@Retur til vareliste');
}

function Rude_Varemodtagelse() {
  htm_Rude_Top($name= 'varemodtform',$capt= '@Vare modtagelse:',$parms='../_base/page_Gittermenu.php',$icon='fa-pencil-square-o','panelW960',__FUNCTION__);
  htm_Tabel($RowLabl='@se listens indhold',
            $ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
              ['@Id.',           '12%','','text',  'left',   '@Entydig nummerkode..','@Id...'],
              ['@Dato',          '12%','','date',  'left',   '@Listens oprettelsesdato','@Dato...'],
              ['@Oprettet af',   '30%','','text',  'left',   '@Initialer for den som har oprettet listen','@Opret...'],
              ['@Bemærkning',    '16%','','text',  'left',   '@Tilknyttet note','@Bem...'],
              ['@Modtaget af',   '16%','','text',  'left',   '@Initialer for den som har modtaget varerne','@Modt...'],
              ['@Modtaget dato', '14%','','date',  'left',   '@Modtagelses datoen','@Dato...'],
              ),
            #$TablData= ImportTabFile('../_export-import/varer.tab'),  // Indlæs data fra TAB-fil
            $TablData= [[1,'Dato','Oprettet','Bemærkning','Modtaget','Modtaget'],[2,'Dato','Oprettet','Bemærkning','Modtaget','Modtaget'],
                        [3,'Dato','Oprettet','Bemærkning','Modtaget','Modtaget']], 
            $FilterOn=true, $SorterOn=true, $CreateRec=true, $ViewHeight='80px' );
            
  echo '<div style="text-align:center;">'; 
  echo  textKnap($label='@Ny modtageliste',  $title='@Klik her for at oprette en vareregistrering',$link='../_base/page_Blindgyden.php').
        textKnap($label='@Vis alle lister', $title='@Klik her for at se alle lister, (Filteret nulstilles)',$link='../_base/page_Blindgyden.php').
   '</div>';

  echo '<hr>';
  #echo '<div style="font-weight:600;"><tc>'.tolk('@Her vises liste Id: 2').'</tc></div>'; 
  echo '<tc><b>'.tolk('@DETALJER: &nbsp;').tolk('@Her vises liste Id: 2').'</b></tc>'; 
  htm_Tabel($RowLabl='@vælge denne post',
            $ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
              ['@Varenr.',       '8%','','text',  'left',   '@Entydigt varenummer','@Vare...'],
              ['@Antal',         '8%','','text',  'left',   '@Vare antallet','@Antal...'],
              ['@Beskrivelse',  '34%','','text',  'left',   '@Vare beskrivelse','@Beskriv...'],
              ['@Leveres',      '25%','','text',  'left',   '@Initial ?? er for den som har modtaget varerne','@Lev...'],
              ['@Lager',        '25%','','text',  'left',   '@Lageret hvor varen indgår','@Lager...'],
              ),
            #$TablData= ImportTabFile('../_export-import/varer.tab'),  // Indlæs data fra TAB-fil
            $TablData= [[1001,'','','',''],[1002,'','','',''],[1003,'','','',''],[1004,'','','','']], 
            $FilterOn=false, $SorterOn=false, $CreateRec=false, $ViewHeight='100' );
  htm_RudeBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Retur til hovedmenu');
}

function Rude_Lagre() {
  htm_Rude_Top($name= 'lagrform',$capt= '@Lagre:',$parms='',$icon='fa-pencil-square-o','panelW320',__FUNCTION__);
  htm_FrstFelt('15%');    htm_CombFelt($type='text',$name='nr',         $valu= $Nr,           $titl='@Nr',          $labl='@Nr.',         $revi=true);  
  htm_NextFelt('65%');    htm_CombFelt($type='text',$name='beskrivelse',$valu= $Beskrivelse,  $titl='@Beskrivelse', $labl='@Beskrivelse', $revi=true);  
  htm_NextFelt('20%');    htm_CombFelt($type='text',$name='afd',        $valu= $Afd,          $titl='@Afd',         $labl='@Afd.',        $revi=true);  
  htm_lastFelt();
  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem');
}

function Rude_Projekter() {
  htm_Rude_Top($name= 'projform',$capt= '@Projekter:',$parms='',$icon='fa-pencil-square-o','panelW320',__FUNCTION__);
  htm_FrstFelt('20%');    htm_CombFelt($type='text',$name='nr',         $valu= $Nr,           $titl='@Nr',          $labl='@Nr.',         $revi=true);  
  htm_NextFelt('80%');    htm_CombFelt($type='text',$name='beskrivelse',$valu= $Beskrivelse,  $titl='@Beskrivelse', $labl='@Beskrivelse', $revi=true);  
  htm_lastFelt();

  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem');
}

function Rude_Afdelinger() {
  htm_Rude_Top($name= 'afdlform',$capt= '@Afdelinger:',$parms='',$icon='fa-pencil-square-o','panelW320',__FUNCTION__);
  htm_FrstFelt('15%');    htm_CombFelt($type='text',$name='nr',         $valu= $Nr,           $titl='@Nr',          $labl='@Nr.',         $revi=true);  
  htm_NextFelt('65%');    htm_CombFelt($type='text',$name='beskrivelse',$valu= $Beskrivelse,  $titl='@Beskrivelse', $labl='@Beskrivelse', $revi=true);  
  htm_NextFelt('20%');    htm_CombFelt($type='text',$name='afdel',      $valu= $Afd,          $titl='@Afdeling',    $labl='@Afdeling.',   $revi=true);  
  htm_lastFelt();

  htm_RudeBund($pmpt='@Gem',$subm=true,$title='@Gem');
}

# DEMO-MODUL;
function Rude_Intro() {global $languageTable;
  htm_Rude_Top($name= 'intro',$capt= '@Introduktion:',$parms='',$icon='fa-info','panelWmax',__FUNCTION__);
  echo '<div style="text-align:center;"><big>Velkommen til en demo af SALDI med nyt moderne <b>CSS</b>-baseret <b>responsive</b> design,<br><br>'.
  ' samt <b>sprogunderstøttelse</b> og forberedt for forøget <b>sikkerhed</b> omkring password.</big><br><br>';
  echo 'Herunder demonstreres output-modulerne {out_*.php} og deres benyttelse.<br><br>';
  echo 'Der mangler stadig funktionalitet, så vil du skifte sprog, skal der tilføjes  parameter i URL:<br>';
  echo '&nbsp;&nbsp;&nbsp;<i>/saldi-e/base/page_Layoutdemo.php?sprog=en</i> - Vælger engelsk sprog';
  echo '<br>I tabel for Sprog oversættelse er aktuelt indlæst '.count($languageTable).' fraser, alle maskinoversat af Google Translate.'; echo '<br>';
  echo 'Er der prefix: @ på en dansk tekst, når du har valgt andet sprog, er det fordi der ikke findes en oversættelse endnu. <br>';
  echo '<br>Benytter du trykfølsom skærm uden mus, skal du benytte Chrome browseren, for at få hjælpetekster:'; echo '<br>';
  echo '"Hvil" fingeren eller musen over den blå tekst med skygge, så popper hjælpetekster op.';  echo '<br>';
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
  htm_Rude_Top($name= 'formaal',$capt= '@Formål:',$parms='',$icon='fa-info','panelW640',__FUNCTION__);
  echo 'Målsætningen med denne kode-udvikling er:<br>';
  echo '<small><pre>';
  echo '  1. Konsistent modul-opbygget Code-design, så vedligeholdelse/udvikling bliver nemmere.<br>';
  echo '  2. Fjernelse af inaktiv kode.<br>';
  echo '  3. Hastigheds forøgelse, med fokus på repeterende rutiner.<br>';
  echo '  4. Indførelse af Responsivt design, med mere moderne/fleksibelt layout.<br>';
  echo '  5. CSS-design, så central ændring af udseende gøres mulig.<br>';
  echo '  6. Udnyttelse af HTML5 forbedringer.<br>';
  echo '  7. Al output til skærm baseres på et nyt bibliotek: out_base.php<br>';
  echo '  8. Sprogvalg for program-fladen, med halv-automatisk vedligeholdelse.<br>';
  echo '  9. Forøge sikkerheden omkring password. Opbevaring og styrkemåler.<br>';
  echo ' 10. Sikre kompatibilitet med PHP7. udgår:{func:Split(), func:ereg_*(), ext:mysql_*}<br>';
  echo '     Mere her: [ https://php.net/manual/en/migration70.php ]<br>';
  echo '     Og her: [ https://www.digitalocean.com/company/blog/getting-ready-for-php-7/ ]<br>';
  echo ' 11. Indførelse af WYSIWYG formular-design.<br>';
  echo ' 12. Layout af source-code forbedres, så strukturen forstås hurtigere, <br>';
  echo '     og sjuskefejl afsløres.<br>';
  echo ' 13. Bedre program-dokumentation ved øget anvendelse af kommentarer.<br>';
  echo ' 14. Anvende prefix på funktionsnavne, så det afspejler kildefilen. (htm_*, out_*,...)<br>';
  echo ' 15. Afskaffe alle:  PRINT "xxx" - Benyt/opret rutiner i out_*.php<br>';
  echo ' 16. Afskaffe Layout-styring med tabeller, som er forældet metode.<br>';
  echo ' 17. Afskaffe afhængighed af: PDFTK som sjældent er installeret.<br>';
  echo ' 18. Ændre: BODY onLoad=javascript:alert() til CSS/jquery: msg_Dialog<br>';
  echo ' <br>';
  echo 'Ad. 1. samt 4.-8. : Sker med de nye biblioteker: out_*.php<br>';
  echo '  <hr>';
  echo 'HUSK: Benyt subRutiner (Block-struktur) i stedet for Copy-Paste! <br>';
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
function NaviTip () {### NavigationsTip:
  echo '<tc><divline style="margin-left:0.5em"><small><b>'.tolk('@TIP:').'</b> <colrlabl>'.tolk('@Tab-tast').'</colrlabl> '.
    tolk('@springer til næste felt.').' <colrlabl>'.tolk('@SHIFT Tab-tast').'</colrlabl> '.tolk('@springer til forrige felt.').
    '  <colrlabl>'.tolk('@CTRL Pil-taster').'</colrlabl> '.tolk('@virker også. ').'</small></divline></tc><br>';
}

function Rude_Blindgyde() {
  msg_Dialog('tip',ucfirst(tolk('@Retur')),'JavaScript:window.history.back();','','','','',ucfirst(tolk('@Du er havnet i en blindgyde')), ucfirst(tolk(
            '@Linket du benyttede er midlertidigt, fordi det rigtige ikke er færdigudviklet.')));
}

function Rude_Erdusikker() {
  msg_Dialog('warn',ucfirst(tolk('@Retur')),'JavaScript:window.history.back();',ucfirst(tolk('@Fortsæt')), $Knap2_function='$jQ112(this).dialog("close")','','',ucfirst(tolk('@Er du helt sikker?')),
            ucfirst(tolk('@OBS! Der er ingen fortryd mulighed, hvis du fortsætter!')));
}

function Rude_GruppeInfo() {
  msg_Dialog('tip',ucfirst(tolk('@Luk')),'JavaScript:window.history.back();','','','','',ucfirst(tolk('@Lidt omtale af grupper.')),ucfirst(tolk(
            '@Indeling i grupper er en praktisk metode, til at begrænse antallet af viste debi-/kreditorer (en slags filter), og til at tildele medlemmer af gruppen, relevante fælles parametre.')));
}


# SUB-FUNCTION:
function FormVars ($form_nr) { # Returner alle de felter, som er relevante for en given formular
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
function OrdrVars ($form_nr) { # Returner alle de felter, som er relevante for en given formular
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


function OmFormularer () {
  echo '<div style="font-size:x-small">';
  echo tolk('@Formularers største format er A4, hvilket vil sige at bredden er max 210 mm og højden max. 297 mm.').' ';
  echo tolk('@Dertil svarer at værdier for X skal ligge i intervallet 1 - 210 mm, og for Y skal ligge i intervallet 1 - 297 mm').'<br>';
  echo tolk('@Bredde-placeringer X måles fra papirets venste kant.').'<br>'.tolk('@Højde-placeringer Y, måles fra papirets bund.');
  echo '</div>';
}

# SUB-FUNCTION:
function XY_forskydning () {
  htm_FrstFelt('25%');  echo '<div style= "text-align:right">'.tolk('@Forskydning af alle placeringer:').'</div>';
  htm_NextFelt('12%');  htm_CombFelt($type='numberL',  $name='xSkyd',  $valu= 0, $titl='@Vandret forskydning: Angiv positivt tal for at øge, negativt tal for at mindske alle x-placeringer',  $labl='@X-forskydning', $revi=true, $rows='', $width='45');
  htm_NextFelt('12%');  htm_CombFelt($type='numberL',  $name='ySkyd',  $valu= 0, $titl='@Lodret forskydning: Angiv positivt tal for at øge, negativt tal for at mindske alle y-placeringer', $labl='@Y-forskydning', $revi=true, $rows='', $width='45');
  htm_NextFelt('16%');  htm_accept('@Forskyd formular','@Flyt hele formularens indhold med de angivne x/y-værdier.');
  htm_NextFelt('35%');  OmFormularer();
  htm_LastFelt(); 
}

?>
