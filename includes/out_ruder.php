<?php      $DocFil= '../includes/out_ruder.php';    $DocVer='5.0.0';     $DocRev='2016-10-00';      $modulnr=0;
//             ___   _   _    ___  _         
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___|
//                                           
// LICENS & Copyright (c) 2004-2016 DANOSOFT ApS *** Se filen: ../LICENS_Copyright.txt
//
// Design af panelers layout.
//
// Afhængig af: out_base.php
//  
// Panel-moduler (Ruder) egnet for adaptivt skærm-output.
// Denne fil er redigeret med tabulator sat til 2 tegn, og ses bedst med det.
// Filer skal gemmes i UTF-8 format uden BOM!
// 2016.08.00 ev - EV-soft

if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'');

// ***** Rutiner for MENU og visning/redigering af DB-data: **************************************************
include('../includes/version.php');
if (!function_exists('msg_Dialog')) {include('../includes/msg_lib.php');};

function menuTitl ($label='') {
  echo '<menuBg><img src= "../images/menuShapeTitl.png" alt="" height="32" width="120" /><a href="'.$link.
  '" class="btnTit" notitle= "'.Tolk('@Kolonne Overskrift').'">'.ucfirst(str_replace(' ','&nbsp;',Tolk($label))).'</a></menuBg>'; }
function menuKnap ($h='32',$w='120',$label='',$link='',$title='') { 
  if (strpos($link,'_base/blindgyden.php')) { $flag0= ' style="color:gray" '; $mess= ' (En blindgyde endnu!)';}
#  if (strpos($link,'page_syssetup.php')) $flag1= ' style="color:red" '; else $flag1= ' style="color:#900000" ';
  echo '<menuBg><img src= "../images/menuShapeButt.png" alt="" height="'.$h.'" width="'.$w.'" /><a href="'.$link.
  '" class="btn" tip="'.Tolk($title).$mess.'" '.$flag0.$flag1.'>'.ucfirst(str_replace(' ','&nbsp;',Tolk($label))).'</a></menuBg>'; }
  
# PROGRAM-MODUL;
function Rude_HovedMenu (&$regnskab, &$vis_finans, &$vis_debitor, &$vis_kreditor, &$vis_prodkt, &$vis_lager, &$programSprog) {
global $copydate, $copyright, $progvers;
  $goBack= '?returside=../_base/menu.php';
  echo '<PanlHead>';        
  htm_Rude_Top($name='menuform',$capt='',$parms='',$icon='',$klasse='panelWmax',__FUNCTION__);
  echo '<div style="text-align: center"><img src= "../images/SALDIe50x150.png" alt="Saldi Logo" height="50" width="150" ></div>';
  echo '<div class="panelTitl" max-width:400>'.ucfirst(tolk('@Regnskab: ')).' '.Tolk($regnskab).'</div>';
  $FaLogo= "../images/saldi.png";
# if (file_exists($FaLogo)) echo '<img style="border:0px solid;width:50px;heigth:50px" alt="" src="'.$FaLogo.'">';

  echo '<p align="center">';
  if ($vis_finans)  menuTitl($label='@FINANS');
  if ($vis_debitor) menuTitl($label='@DEBITOR');
  if ($vis_kreditor)menuTitl($label='@KREDITOR');
  if ($vis_prodkt)  menuTitl($label='@PRODUKTION');
  if ($vis_lager)   menuTitl($label='@LAGER');
                    menuTitl($label='@SYSTEM'); 
  echo '<br>';
  if ($vis_finans)  menuKnap($h='32',$w='120' ,$label='@Kasse kladder'    ,$link='../_finans/page_Kladdeliste.php'.$goBack, $title='@Gå til menuen Kassekladder'    );
  if ($vis_debitor) menuKnap($h='32',$w='120' ,$label='@Ordrer'           ,$link='../_debitor/page_Ordreliste.php'.$goBack,      $title='@Gå til menuen Debitor Ordrer'  );
  if ($vis_kreditor)menuKnap($h='32',$w='120' ,$label='@Ordrer'           ,$link='../_kreditor/page_Ordreliste.php'.$goBack,     $title='@Gå til menuen Kreditor Ordrer' );
  if ($vis_prodkt)  menuKnap($h='32',$w='120' ,$label='@Produktion'       ,$link='../_produktion/page_Ordreliste.php'.$goBack,   $title='@Gå til menuen Produktion'      );
  if ($vis_lager)   menuKnap($h='32',$w='120' ,$label='@Varer'            ,$link='../_lager/page_Varer.php'.$goBack,             $title='@Gå til menuen Varer' );
                    menuKnap($h='32',$w='120' ,$label='@Konto plan'       ,$link='../_systemdata/page_Kontoplan.php'.$goBack,    $title='@Gå til menuen Kontoplan' );
  echo '<br>';
  if ($vis_finans)  menuKnap($h='32',$w='120' ,$label='@Regnskab'         ,$link='../_base/blindgyden.php'.$goBack,         $title='@Gå til menuen Regnskab'        );
  if ($vis_debitor) menuKnap($h='32',$w='120' ,$label='@Konti'            ,$link='../_base/blindgyden.php'.$goBack,         $title='@Gå til menuen Debitor Konti'   );
  if ($vis_kreditor)menuKnap($h='32',$w='120' ,$label='@Konti'            ,$link='../_base/blindgyden.php'.$goBack,         $title='@Gå til menuen Kreditor Konti'  );
  if ($vis_prodkt)  menuKnap($h='32',$w='120' ,$label='@Produktion'       ,$link='../_produktion/page_Ordreliste.php'.$goBack,   $title='@Gå til menuen Produktion'      );
  if ($vis_lager)   menuKnap($h='32',$w='120' ,$label='@Vare modtagelse'  ,$link='../_base/blindgyden.php'.$goBack,         $title='@Gå til menuen Varemodtagelse'  );
                    menuKnap($h='32',$w='120' ,$label='@Indstillinger'    ,$link='../_systemdata/page_Syssetup.php'.$goBack,$title='@Gå til menuen Indstillinger'   );
  echo '<br>';
  if ($vis_finans)  menuKnap($h='32',$w='120',$label='@Rapporter'         ,$link='../_base/blindgyden.php'.$goBack,         $title='@Gå til menuen Finans Rapporter'  );
  if ($vis_debitor) menuKnap($h='32',$w='120',$label='@Rapporter'         ,$link='../_base/blindgyden.php'.$goBack,         $title='@Gå til menuen Debitor Rapporter' );
  if ($vis_kreditor)menuKnap($h='32',$w='120',$label='@Rapporter'         ,$link='../_base/blindgyden.php'.$goBack,         $title='@Gå til menuen Kreditor Rapporter');
  if ($vis_prodkt)  menuKnap($h='32',$w='120',$label=''                   ,$link='../_base/blindgyden.php'.$goBack,         $title='@Gå til ?'                        );
  if ($vis_lager)   menuKnap($h='32',$w='120',$label='@Rapporter'         ,$link='../_lager/page_Beholdningsliste.php'.$goBack,  $title='@Gå til menuen Vare Rapporter'    );
  #                 menuKnap($h='32',$w='120',$label='@Sikkerheds kopi'   ,$link='../_base/blindgyden.php'.$goBack,         $title='@Gå til menuen Sikkerhedskopi'    );
                    menuKnap($h='32',$w='120' ,$label='DEMO'              ,$link='../_base/page_LayoutModuler.php'.$goBack,$title='@Demonstration af output-moduler');
  htm_FrstFelt('20%',0);          
  htm_NextFelt('20%');  echo '<small>SALDI - Ver '.$progvers.'</small>';              
  htm_NextFelt('30%');  echo '<small><i>Copyright '.$copydate.' '.$copyright.'</i></small>';  #  "Copyright ©2003-2016 DANOSOFT ApS"
  htm_NextFelt('20%');  echo '<small>'.tolk('@Aktuelt sprog: ').$programSprog.'</small>';
  htm_NextFelt('20%');
  htm_LastFelt();
  echo '</p>';
  htm_RudeBund($pmpt=Tolk('@Gem'),$revi=false,$title='@Gem');
  Rude_FootMenu($doPrint=false, $doErase=false, $doLookUp=false, $doAccept=false, $doExport=false, $doImport=false, $OpslLabl='');
  echo '</PanlHead>';
}

# PROGRAM-MODUL;
function Rude_AdminMenu () {
  htm_Rude_Top($name='adminform',$capt='Indstillinger',$parms='',$icon='fa-bars',$klasse='panelW240',__FUNCTION__);
  $goBack= '?returside=../_base/menu.php';
  echo '<div style="text-align:center;">';
                menuKnap($h='22',$w='180',$label='@Moms',           $link='../_systemdata/page_Syssetup.php'.$goBack,    $title='@Indstillinger angående moms');
  echo '<br>';  menuKnap($h='22',$w='180',$label='@Debitor og Kreditor',$link='../_base/blindgyden.php'.$goBack,$title='@Indstillinger angående grupper');
  echo '<br>';  menuKnap($h='22',$w='180',$label='@Afdelinger',     $link='../_base/blindgyden.php'.$goBack,    $title='@Indstillinger angående Afdelinger');
  echo '<br>';  menuKnap($h='22',$w='180',$label='@Projekter',      $link='../_base/blindgyden.php'.$goBack,    $title='@Indstillinger angående Projekter');
  echo '<br>';  menuKnap($h='22',$w='180',$label='@Lagre',          $link='../_base/blindgyden.php'.$goBack,    $title='@Indstillinger angående Lagre');
  echo '<br>';  menuKnap($h='22',$w='180',$label='@Varegrupper',    $link='../_base/blindgyden.php'.$goBack,    $title='@Indstillinger angående Varegrupper');
  echo '<br>';  menuKnap($h='22',$w='180',$label='@Rabatgrupper',   $link='../_base/blindgyden.php'.$goBack,    $title='@Indstillinger angående Rabatgrupper');
  echo '<br>';  menuKnap($h='22',$w='180',$label='@Valuta',         $link='../_base/blindgyden.php'.$goBack,    $title='@Indstillinger angående valuta');
  echo '<br>';  menuKnap($h='22',$w='180',$label='@Brugere',        $link='../_base/blindgyden.php'.$goBack,    $title='@Indstillinger angående Brugere');
  echo '<br>';  menuKnap($h='22',$w='180',$label='@Regnskabsår',    $link='../_base/blindgyden.php'.$goBack,    $title='@Indstillinger angående Regnskabsår');
  echo '<br>';  menuKnap($h='22',$w='180',$label='@Stamdata',       $link='../_systemdata/page_Stamkort.php'.$goBack,    $title='@Indstillinger angående Stamdata');
  echo '<br>';  menuKnap($h='22',$w='180',$label='@Formularer',     $link='../_systemdata/page_FormText.php'.$goBack,    $title='@Indstillinger angående Formularer');
  echo '<br>';  menuKnap($h='22',$w='180',$label='@Enheder og matr.',$link='../_base/blindgyden.php'.$goBack,   $title='@Indstillinger angående registrede Enheder, beskrivelse og materiale');
  echo '<br>';  menuKnap($h='22',$w='180',$label='@Diverse menu',   $link='../_systemdata/page_Divsetup.php'.$goBack,    $title='@Diverse indstillinger');
  echo '<br>';  
  echo '<br>';  menuKnap($h='22',$w='180',$title='@Retur til hovedmenu',$link='../_base/page_Gittermenu.php'.$goBack,  $title='@Gå til SALDI´s gittermenu');
  echo '<br><br></div>';
  htm_RudeBund($pmpt=Tolk('@Gem'),$revi=false,$title='@Gem');
};

# PROGRAM-MODUL;
function Rude_DiverseMenu () {
  htm_Rude_Top($name='adminform',$capt='Diverse indstillinger',$parms='',$icon='fa-bars',$klasse='panelW240',__FUNCTION__);
  $goBack= '?returside=../_base/menu.php';
  echo '<div style="text-align:center;">';
                menuKnap($h='22',$w='180' ,$label='@Kontoindstillinger',    $link='../_base/blindgyden.php'.$goBack,$title='@Indstillinger angående regnskabsnavn og mailserver for afsendelse af mail');
  echo '<br>';  menuKnap($h='22',$w='180' ,$label='@Provisionsberegning',   $link='../_base/blindgyden.php'.$goBack,$title='@Indstillinger angående Provisionsberegning');
  echo '<br>';  menuKnap($h='22',$w='180' ,$label='@Personlige valg',       $link='../_base/blindgyden.php'.$goBack,$title='@Indstillinger angående Farver og udseende m.v.');
  echo '<br>';  menuKnap($h='22',$w='180' ,$label='@Varerelateret',         $link='../_base/blindgyden.php'.$goBack,$title='@Indstillinger angående Varerelateret f.eks. varianter');
  echo '<br>';  menuKnap($h='22',$w='180' ,$label='@Prislister',            $link='../_base/blindgyden.php'.$goBack,$title='@Indstillinger angående Prislister');
  echo '<br>';  menuKnap($h='22',$w='180' ,$label='@Rykkerrelateret',       $link='../_base/blindgyden.php'.$goBack,$title='@Indstillinger angående Rykkerrelaterede');
  echo '<br>';  menuKnap($h='22',$w='180' ,$label='@Diverse valg',          $link='../_base/blindgyden.php'.$goBack,$title='@Indstillinger angående aktivering af ekstra moduler m.v.');
  echo '<br>';  menuKnap($h='22',$w='180' ,$label='@Tjeklister',            $link='../_base/blindgyden.php'.$goBack,$title='@Indstillinger angående Tjeklister');
  echo '<br>';  menuKnap($h='22',$w='180' ,$label='@Bilagshåndtering',      $link='../_base/blindgyden.php'.$goBack,$title='@Indstillinger angående Bilagshåndtering');
  echo '<br>';  menuKnap($h='22',$w='180' ,$label='@Øredifferencer',        $link='../_base/blindgyden.php'.$goBack,$title='@Indstillinger angående Øredifferencer');
  echo '<br>';  menuKnap($h='22',$w='180' ,$label='@Massefakturering',      $link='../_base/blindgyden.php'.$goBack,$title='@Indstillinger angående Massefakturering');
  echo '<br>';  menuKnap($h='22',$w='180' ,$label='@Formular Sprog',        $link='../_base/blindgyden.php'.$goBack,$title='@Indstillinger angående Sprog på blanketter');
  echo '<br>';  menuKnap($h='22',$w='180' ,$label='@Data import & eksport', $link='../_base/blindgyden.php'.$goBack,$title='@Importér / eksportér: Kontoplan, Formularer, Debitorer, Kreditorer, Varer, og Dataudtræk');
  echo '<br>';  
  echo '<br>';  menuKnap($h='22',$w='180',$label='@Retur til indstillingsmenu',$link='../_systemdata/page_Syssetup.php'.$goBack,$title='@Gå tilbag til indstillingsmenuen');
  echo '<br><br></div>';
  htm_RudeBund($pmpt=Tolk('@Gem'),$revi=false,$title='@Gem');
};

# PROGRAM-MODUL;
function Rude_FootMenu($doPrint=true, $doErase=true, $doLookUp=true, $doAccept=true, $doExport=true, $doImport=true, $OpslLabl='') {
  echo '<div class="clearWrap"/>';  echo '<PanlFoot>';
    Foot_Links($maxi=true, '<a style="color:green" href="'.$link='http://www.ev-soft.dk/saldi-wiki/doku.php?id=start'.'">'.
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
      $titl= '@Hvilket sprog vil du indstille programmet til (Virker ikke endnu)', 
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
function Rude_DBsetup (&$db_type,&$db_encode,&$db_navn,&$db_bruger,&$db_password,&$adm_navn,&$adm_password,&$verify_adm_password) { 
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
  htm_CombFelt($type='text',  $name='adm_navn',     $valu= $adm_navn,     $titl='@Ønsket navn på din SALDI-administratorkonto til dit SALDI-system.  F.eks.: [saldi-admin]',  $labl='@SALDI-administratorens brugernavn', 
               $revi=true, $rows='2',$width='',$step='', $more='required placeholder="'.tolk('@Udfyld...').'"');
  
# echo '<form>';
    htm_CombFelt($type='passwordpower', $name='passwordpwr',  $valu= $adm_password, 
                $titl='@Ønsket adgangskode for SALDI-administratoren af dit SALDI-system',  $labl='@SALDI-administratorens adgangskode',  
                $revi=true, $rows='2',$width='',$step='', $more='required placeholder="'.tolk('@Password...').'"');
    htm_CombFelt($type='password',  $name='confirm_password', $valu= $verify_adm_password,  
                $titl='@Verificering af ovenstående adgangskode',                           $labl='@Gentag SALDI-administratorens adgangskode', 
                $revi=true, $rows='2',$width='',$step='', $more='required placeholder="'.tolk('@Gentag...').'"');
    echo '<div align= "center"><button type="submit" class="pure-button pure-button-primary" title="'.
          tolk('Test om de indtastede password er ens.').'">'.          tolk('@Kontrollèr Administrators Passwords').'</button></div>';
# echo '</form>';
  
  echo '<hr>';
  echo '<div style="text-align:left"><small><b>'.tolk('@Alle').'</b> '.tolk('@felter skal udfyldes og kontrolleres.').' <br>&nbsp;&nbsp;<br>';
  echo '<b>'.tolk('@Tip:').'</b> '.tolk('@Hold musen over blå tekster, for at få hjælpetip.').'</small></div>';
  echo '<br><div style="text-align:left"><small><b>'.tolk('@HUSK:').'</b> '.tolk('@Skrivebeskyt alle mapper på serveren, på nær: ').
       '<br>../temp ../includes ../logolib og undermapper heri.<br>(../temp, ../_config og ../_export-import) </small></div>';
  htm_RudeBund($pmpt=Tolk('@Installér'),$revi=true,$title='@Klik her for at oprette dit SALDI database-system');
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
  echo tolk('@Alle andre mapper skal være skrivebeskyttet!').'<hr><b>PHP </b>'.
       tolk('@skal understøtte modulerne: mcrypt og hash, som benyttes til at håndtere passwords sikkert.').'<br>';
  htm_FrstFelt('50%');  
  htm_CheckFlt($type='checkbox',$name='hash',   $valu= '',  $titl='@Systemet kontrollerer om modulet er tilgængeligt',  $labl='@hash installeret.', $revi=false,$more='checked="'.extension_loaded('hash').'"');
  htm_NextFelt('50%');  
  htm_CheckFlt($type='checkbox',$name='mcrypt', $valu= '',  $titl='@Systemet kontrollerer om modulet er tilgængeligt',  $labl='@mcrypt installeret.', $revi=false,$more='checked="'.extension_loaded('mcrypt').'"');
  htm_LastFelt();
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
  htm_RudeBund($pmpt=Tolk('@Installér'),$revi=false,$title='@Klik her for at oprette dit SALDI database-system');
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
  htm_RudeBund($pmpt= Tolk('@Installér'),$revi=false,$title='@Klik her for at oprette dit SALDI database-system');
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
  htm_RudeBund($pmpt=Tolk('@Fortsæt'),$revi=true,$title='@Fortsæt til logind og oprettelse af 1. regnskab');
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
  htm_RudeBund($pmpt=Tolk('@Log ind'),$revi=true,$title='@Gå videre til SALDI regnskabet');
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
  htm_RudeBund($pmpt='@Gem',$revi=true,$title='@Gem');
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
  htm_RudeBund($pmpt='@Gem',$revi=true,$title='@Gem');
}

# PROGRAM-MODUL;
function Rude_Kontakter () {
  htm_Rude_Top($name='betaform',$capt='   '.tolk('@Kontakt info:'),$parms='',$icon='fa-phone-square',$klasse='panelW320',__FUNCTION__);
  Kontakt($posi=1, $kontakt='Anders', $telf, $mobil, $mail);
  Kontakt($posi=2, $kontakt='Andersine', $telf, $mobil, $mail);
  echo '<hr>';
  echo '<div class="centrer">'; htm_accept('@Opret Ny','@Opret en ny kontakt'); echo '</div>';
  htm_RudeBund($pmpt='@Gem rettelser',$revi=true,$title='@Gem evt. rettelser ovenfor');
}

function Kontakt (&$posi, &$kontakt, &$telf, &$mobil, &$mail) {
  htm_FrstFelt('16%',0);
    htm_CombFelt($type='text',  $name='posi',   $valu= $posi,   $titl='@Angiv position',        $labl='@Pos.',    $revi=true, $rows='',$width='45',$step='0.5');
  htm_NextFelt('34%');  
    htm_CombFelt($type='text',  $name='kontakt',$valu= $kontakt,$titl='@Angiv Kontakt person',  $labl='@Kontakt person',  $revi=true,$rows='',$width='45');
  htm_NextFelt('25%');
    htm_CombFelt($type='text',  $name='telf',   $valu= $telf,   $titl='@Angiv Telefon',         $labl='@Telefon', $revi=true, $rows='',$width='45');
  htm_NextFelt('25%');        
    htm_CombFelt($type='text',  $name='mobil',  $valu= $mobil,  $titl='@Angiv Mobilnr.',        $labl='@Mobil',   $revi=true, $rows='',$width='45');
  htm_LastFelt();       
  htm_CombFelt(  $type='mail',  $name='mail',   $valu= $mail,   $titl='@Angiv E-mail',          $labl='@E-mail',  $revi=true, $rows='');
  echo '<div class="centrer">'; htm_accept('@Slet','@Fjern denne kontakt person'); echo '</div>';
  echo '<hr color="green">';
}

# PROGRAM-MODUL;
function Rude_Fakturering (&$navn, &$addr, &$sted, &$ponr, &$by, &$land, &$noter, &$telf, &$att, &$email, &$usemail, &$faktdato) {
  htm_Rude_Top($name='faktform',$capt='@Kunde - Fakturering:',$parms='',$icon='fa-pencil-square-o','panelWmax',__FUNCTION__);
  htm_CombFelt($type='text',$name='navn', $valu= $navn,   $titl='@Angiv Kunde Navn',            $labl='@Kunde navn',      $revi=true);
  htm_CombFelt($type='text',$name='addr', $valu= $addr,   $titl='@Angiv Faktura Adresse',       $labl='@Faktura adresse', $revi=true);
  htm_FrstFelt('25%');
    htm_CombFelt($type='text',$name='ponr', $valu= $ponr, $titl='@Angiv Faktura Kunde postnr',  $labl='@Postnr',          $revi=true);
  htm_NextFelt('75%');
    htm_CombFelt($type='text',$name='by',   $valu= $by,   $titl='@Angiv Faktura Kunde Bynavn',  $labl='@Faktura By',      $revi=true);
  htm_lastFelt();
# htm_CombFelt($type='text',$name='ponr', $valu= $ponr,   $titl='@Angiv Faktura Kunde postnr',  $labl='@Faktura postnr',  $revi=true);
# htm_CombFelt($type='text',$name='by',   $valu= $by,     $titl='@Angiv Faktura Kunde Bynavn',  $labl='@Faktura By',      $revi=true);
  htm_CombFelt($type='text',$name='sted', $valu= $sted,   $titl='@Angiv Faktura Kunde Sted',    $labl='@Faktura Sted',    $revi=true);
  htm_CombFelt($type='text',$name='land', $valu= $land,   $titl='@Angiv Faktura Kunde Land',    $labl='@Faktura Land',    $revi=true);
  htm_CombFelt($type='area',$name='noter',$valu= $noter,  $titl='@Angiv Bemærkninger',          $labl='@Bemærkninger',    $revi=true, $rows='1');
  htm_CombFelt($type='text',$name='telf', $valu= $telf,   $titl='@Angiv Kunde Telefon',         $labl='@Telefon(er)',     $revi=true);
  htm_CombFelt($type='text',$name='att',  $valu= $att,    $titl='@Angiv Kunde Attention',       $labl='@Attention',       $revi=true);
  htm_CombFelt($type='mail',$name='email',$valu= $email,  $titl='@Angiv Kunde Email adresse',   $labl='@Kundens Email adresse',$revi=true);
  htm_FrstFelt('50%');  
    htm_CheckFlt($type='checkbox',$name='useMail',  $valu= $usemail,  $titl='@Send faktura med mail', $labl='@Benyt mail',$revi=true);
  htm_NextFelt('50%');  
    htm_CombFelt($type='date',    $name='faktdato', $valu= $faktdato, $titl='@Fakturerings dato',     $labl='@Faktura Dato',$revi=true);
  htm_LastFelt();
  htm_RudeBund($pmpt='@Fakturér',$revi=true,$title='@Fakturer og udskriv til den under {Betingelser}, valgte udskriver!');
}

# PROGRAM-MODUL;
function Rude_Ordreinfo (&$valuta, &$vorref, &$afdel, &$ordrdato, &$genfdato, &$godkendt, &$optlist) {
$optlist= array(['','DKK','DKK'],['','AED','AED'],['','EUR','EUR'],['','USD','USD']);
  htm_Rude_Top($name='ordrform',$capt='@Ordreinfo:',$parms='',$icon='fa-eur','panelWmax',__FUNCTION__);
  htm_OptioFlt($type='text',  $name='valuta',   $valu= $valuta,   $titl='@Valuta som ordren skal benytte',  $labl='@Valuta',  $revi=true,
               $optlist= array(['','DKK','DKK'],['','AED','AED'],['','EUR','EUR'],['','USD','USD']),  $action='');
  htm_CombFelt($type='text',  $name='vorref',   $valu= $vorref,   $titl='@Sælgers referance',               $labl='@Vor referance', $revi=true);
  htm_CombFelt($type='text',  $name='afdel',    $valu= $afdel,    $titl='@Sælgers afdeling',                $labl='@Afdeling',      $revi=true);
  htm_FrstFelt('50%');        
    htm_CombFelt($type='date',$name='ordrdato', $valu= $ordrdato, $titl='@Datoen hvor ordren indgik',       $labl='@Ordre Dato',    $revi=true);
  htm_NextFelt('50%');  
    htm_CombFelt($type='date',$name='genfdato', $valu= $genfdato, $titl='@Husk fremtidigt fakturerings tidspunkt',  $labl='@Genfakturerings Dato',$revi=true);
  htm_LastFelt();
  htm_CheckFlt($type='checkbox',$name='godkendt',$valu= $godkendt,$titl='@Ordren er godkendt hvis feltet er afmærket',$labl='@Godkendt',$revi=true);
  htm_RudeBund($pmpt='@Gem',$revi=true,$title='@Gem data i denne rude.');
}

# PROGRAM-MODUL;
function Rude_Levering ($navn, $addr, $sted, $ponr, $by, $land, $telf, $kont, $email, $forsend, $noter, $afsendt, $levdato) {
  htm_Rude_Top($name='leveform',$capt='@Levering:',$parms='',$icon='fa-truck','panelWmax',__FUNCTION__);
  htm_CheckFlt($type='checkbox',$name='somfakt',  $valu= $somfakt,  $titl='@Afmærk her, hvis leverings adresse er den samme som faktura adresse', 
                                                                                                                        $labl='@Levering til faktura-adresse',$revi=true);
  htm_CombFelt($type='text',$name='levnavn',      $valu= $navn,     $titl='@Angiv Modtager Navn',                       $labl='@Modtager navn',               $revi=true);
  htm_CombFelt($type='text',$name='levaddr1',     $valu= $addr,     $titl='@Angiv Leverings Adresse',                   $labl='@Leverings adresse',           $revi=true);
  htm_CombFelt($type='text',$name='sted',         $valu= $sted,     $titl='@Angiv Leverings Sted',                      $labl='@Sted',                        $revi=true);
  htm_FrstFelt('25%');
    htm_CombFelt($type='text',$name='levpostnr',  $valu= $ponr,     $titl='@Angiv Leverings Kunde postnr',              $labl='@Postnr',                      $revi=true);
  htm_NextFelt('75%');
    htm_CombFelt($type='text',$name='levby',      $valu= $by,       $titl='@Angiv Leveringsstedets Bynavn',             $labl='@Leverings by',                $revi=true);
  htm_lastFelt();
# htm_CombFelt($type='text',$name='levpostnr',    $valu= $ponr,     $titl='@Angiv Leverings Kunde postnr',              $labl='@Leverings postnr',            $revi=true);
# htm_CombFelt($type='text',$name='levby',        $valu= $by,       $titl='@Angiv Leveringsstedets Bynavn',             $labl='@Leverings by',                $revi=true);
  htm_CombFelt($type='text',$name='land',         $valu= $land,     $titl='@Angiv Leverings Land',                      $labl='@Leverings Land',              $revi=true);
  htm_CombFelt($type='text',$name='levtelf',      $valu= $telf,     $titl='@Angiv Modtagers Telefon',                   $labl='@Telefon(er)',                 $revi=true);
  htm_CombFelt($type='text',$name='levkont',      $valu= $kont,     $titl='@Angiv Kontaktpersons Navn',                 $labl='@Kontaktperson',               $revi=true);
  htm_CombFelt($type='mail',$name='levemail',     $valu= $email,    $titl='@Angiv Modtagers Email adresse',             $labl='@Modtagerens Email adresse',   $revi=true);
  htm_CombFelt($type='text',$name='forsendelse',  $valu= $forsend,  $titl='@Angiv Forsendelses oplysninger',            $labl='@Fragtmetode)',                $revi=true);
  htm_CombFelt($type='area',$name='levnoter',     $valu= $noter,    $titl='@Angiv Noter til fragtmand',                 $labl='@Noter til fragtmand',         $revi=true, $rows='1');
  htm_FrstFelt('50%');
    htm_CheckFlt($type='checkbox',$name='afsendt',$valu= $afsendt,  $titl='@Afmærk her når varen/ydelsen er afsendt',   $labl='@Afsendt',                     $revi=true);
  htm_NextFelt('50%');  
    htm_CombFelt($type='date',$name='levdato',    $valu= $levdato,  $titl='@evt. forsendelses dato',                    $labl='@Leverings Dato',              $revi=true);
  htm_LastFelt();
  htm_RudeBund($pmpt='@Gem',$revi=true,$title='@Gem data i denne rude.');
}

# PROGRAM-MODUL;
function Rude_Ekstrafelter (&$felt1, &$felt2, &$felt3, &$felt4, &$felt5) {
  htm_Rude_Top($name='feltform',$capt='@Ekstrafelter:',$parms='',$icon='fa-plus','panelWmax',__FUNCTION__);
  htm_CombFelt($type='text',$name='felt1',  $valu= $felt1,  $titl='@Udfyld Felt 1',     $labl='@Ordre Felt 1',    $revi=true);
  htm_CombFelt($type='text',$name='felt2',  $valu= $felt2,  $titl='@Udfyld Felt 2',     $labl='@Ordre Felt 2',    $revi=true);
  htm_CombFelt($type='text',$name='felt3',  $valu= $felt3,  $titl='@Udfyld Felt 3',     $labl='@Ordre Felt 3',    $revi=true);
  htm_CombFelt($type='text',$name='felt4',  $valu= $felt4,  $titl='@Udfyld Felt 4',     $labl='@Ordre Felt 4',    $revi=true);
  htm_CombFelt($type='text',$name='felt5',  $valu= $felt5,  $titl='@Udfyld Felt 5',     $labl='@Ordre Felt 5',    $revi=true);
  htm_RudeBund($pmpt='@Gem',$revi=false,$title='@Gem');
}

# PROGRAM-MODUL;
function Rude_Mailfaktura (&$emne, &$text, &$vedhft) {
  htm_Rude_Top($name='mailform',$capt='@Mail faktura:',$parms='',$icon='fa-envelope-o','panelWmax',__FUNCTION__);
  htm_CombFelt($type='text',$name='emne',   $valu= $emne,   $titl='@Angiv Mail emne',     $labl='@Mail emne',   $revi=true);
  htm_CombFelt($type='area',$name='text',   $valu= $text,   $titl='@Angiv Mail tekst',    $labl='@Mail tekst',  $revi=true, $rows='2');
  htm_CombFelt($type='text',$name='vedhft', $valu= $vedhft, $titl='@Angiv Vedhæftet fil', $labl='@Mail bilag',  $revi=true);
  htm_RudeBund($pmpt='@Gem',$revi=false,$title='@Gem');
}

# PROGRAM-MODUL;
function Rude_Ydelser ($fakt) {
  htm_Rude_Top($name='yderform',$capt='@Ydelser / Produkter: <small>(Smal-format)</small>',$parms='',$icon='fa-shopping-cart','panelWmax',__FUNCTION__);
  Varelinie($posi=1,$varenr="45-876",$antal=1,$enhed="stk",$beskriv="Redekasser",$momssats=25,$pris=235.50,$rabat=20, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);
  Varelinie($posi=2,$varenr="45-876",$antal=2,$enhed="stk",$beskriv="Redekasser",$momssats=25,$pris=235.50,$rabat=20, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);
  Varelinie($posi=3,$varenr="45-877",$antal=3,$enhed="stk",$beskriv="Redekasser",$momssats=25,$pris=245.00,$rabat=20, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);
  Varelinie($posi=4,$varenr="45-876",$antal=3,$enhed="stk",$beskriv="Redekasser",$momssats=25,$pris=235.50,$rabat=20, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);
    htm_CheckFlt($type='checkbox', $name='fakt', $valu= $fakt, $titl='@Når ordren er faktureret, afmærkes feltet automatisk',$labl='@Er Faktureret og låst',$revi=false);
  htm_RudeBund($pmpt='@Gem',$revi=true,$title='@Gem data i denne rude.');
}

# PROGRAM-MODUL;
function Rude_YdelserWide ($fakt) {
  echo '<div class="clearWrap"/>';  echo '<PanlFoot>';  
  htm_Rude_Top($name='linkform',$capt=tolk('@Ydelser / Produkter på salgsordren. <small>(Bredformat)</small>').' ',$parms='',$icon='fa-shopping-cart','panelWmax',__FUNCTION__);
    VarelinieWide($posi=1, $varenr='45-876', $antal=3, $enhed='stk', $beskriv='Redekasser', $momssats=25, $pris=235.50, $rabat=8, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);     
    VarelinieWide($posi=2, $varenr='45-876', $antal=2, $enhed='stk', $beskriv='Redekasser', $momssats=25, $pris=235.50, $rabat=8, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);     
    VarelinieWide($posi=3, $varenr='45-876', $antal=3, $enhed='stk', $beskriv='Redekasser', $momssats=25, $pris=235.50, $rabat=12, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);
    #,"45-876","3","stk","Redekasser","25","235,50","8",(3*235.5)*92/100*125/100
  htm_RudeBund($pmpt='@Gem',$revi=true,$title='@Gem data i denne rude.');
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
  htm_NextFelt('25%');  htm_CombFelt($type='tal2d', $name='rabat',    $valu= $rabat,    $titl='@Angiv rabatbeløb',          $labl='@Rabat%',  $revi=true, $rows='', $width='45');
  htm_NextFelt('30%');  htm_CombFelt($type='tal2d', $name='ialt',     $valu= $ialt,     $titl='@Beregnet felt: ialt',       $labl='@Ialt',    $revi=false,$rows='', $width='45');
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
  htm_Rude_Top($name= 'naviform',$capt= '@DEMO: Tabel med fastlåst kolonne-header og "rulle-vindue"',$parms='',$icon='','panelWmax',__FUNCTION__);
  htm_Tabel($RowLabl='ordre',$ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]  
            ['@Lb.Nr.','4%','','','','',''],['@Ordre dato','7%','','date','left','','åååå-mm-dd'],['@Lev. dato','7%','','date','left','','åååå-mm-dd'],
            ['@Konto nr.','6%','','text','center','',tolk('@Kont...')],['@Firma navn','24%','','','','',tolk('@Firm...')],['@Sælger','8%','','','','',tolk('@Sælg...')],['@Ordre sum','6%','','','','',tolk('@Beløb...')]),
            $TablData= array(
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
            ) , $doFilter=true, $doSort=true);
  htm_RudeBund($pmpt='@Gem',$revi=false,$title='@Gem');
}

# PROGRAM-MODUL;
function Rude_Debitorer() {
  htm_Rude_Top($name= 'naviform',$capt= '@Konti - Debitorer:',$parms='',$icon='','panelWmax',__FUNCTION__);
  htm_Tabel($RowLabl='debitor',$ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
            ['@Kontonr.','5%','','','','',''],['@Firmanavn','10%','','','','','Firm...'],['@Adresse','8%','','','','','Addr...'],
            ['@Sted','8%','','','','','Sted...'],['@Postnr','4%','','','','','Post...'],['@By','8%','','','','','By...'],
            ['@Kontakt','12%','','','','','Kont...'],['@Telefon','12%','','','','','Telf...'],['@Sælger','12%','','','','','Sælg...']),
            $TablData= array(
            ['1025','Firmanavn','Adresse','Sted','Postnr','By','Kontakt','Telefon','Sælger'],
            ['1026','Firmanavn','Adresse','Sted','Postnr','By','Kontakt','Telefon','Sælger'],
            ['1027','Firmanavn','Adresse','Sted','Postnr','By','Kontakt','Telefon','Sælger'],
            ['1028','Firmanavn','Adresse','Sted','Postnr','By','Kontakt','Telefon','Sælger']
            ) );
  htm_RudeBund($pmpt='@Gem',$revi=false,$title='@Gem');
}

# PROGRAM-MODUL;
function Rude_Kreditorer() {
  htm_Rude_Top($name= 'naviform',$capt= '@Konti - Kreditorer:',$parms='',$icon='fa-snapchat-ghost ','panelWmax',__FUNCTION__);
  htm_Tabel($RowLabl='kreditor',$ColStyle= array(   #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
            ['@Kontonr.','4%','','','','',''],['@Leverandør Navn','10%','','','','',tolk('@Navn...')],['@Adresse','8%','','','','',tolk('@Addr...')],['@Sted','8%','','','','',tolk('@Sted...')],
            ['@Post nr','4%','','','','',tolk('@Post...')],['@By','8%','','','','',tolk('@By...')],['@Kontakt person','12%','','','','',tolk('@Kont...')],['@Telefon','12%','','','','',tolk('@Telf...')]),
            $TablData= array(
            ['1025','Navn','Adresse','Sted','Post nr','By','Kontakt person','Telefon'],
            ['1026','Navn','Adresse','Sted','Post nr','By','Kontakt person','Telefon'],
            ['1027','Navn','Adresse','Sted','Post nr','By','Kontakt person','Telefon'],
            ['1028','Navn','Adresse','Sted','Post nr','By','Kontakt person','Telefon']
            ) );
  htm_RudeBund($pmpt='@Gem',$revi=false,$title='@Gem');
}

# PROGRAM-MODUL;
function Rude_KredOrdrer() {
  htm_Rude_Top($name= 'naviform',$capt= '@Ordrer: Kreditorer - `Leverandørordrer`:',$parms='',$icon='','panelWmax',__FUNCTION__);
  htm_Tabel($RowLabl=tolk('@leverandørordre'),$ColStyle= array(#   [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
            ['@Ordre nr.','6%','','','','',''],['@Modt.nr.','5%','','','','','Modt...'],    ['@Fakt.nr.','6%','','','','','Fakt...'],['@Ordre dato','7%','','date','','','åååå-mm-dd'],
            ['@Modt.dato','7%','','date','','','åååå-mm-dd'],['@Konto nr.','8%','','','','','Kont...'],['@Firma navn','30%','','','','','Navn...'],['@Telefon','6%','','','center','','Telf...'],
            ['@Leveres til','6%','','','left','','Lev...'],['@Vor ref.','5%','','','left','','Ref...'],['@Faktura sum','8%','','','right','','Beløb...']),
            $TablData= array(
            ['1025','Modt.nr.','Fakt.nr.','Ordre dato','Modt.dato','Konto nr.','Firma navn','Telefon','Leveres til','Vor ref.','Faktura sum'],
            ['1026','Modt.nr.','Fakt.nr.','Ordre dato','Modt.dato','Konto nr.','Firma navn','Telefon','Leveres til','Vor ref.','Faktura sum'],
            ['1027','Modt.nr.','Fakt.nr.','Ordre dato','Modt.dato','Konto nr.','Firma navn','Telefon','Leveres til','Vor ref.','Faktura sum'],
            ['1028','Modt.nr.','Fakt.nr.','Ordre dato','Modt.dato','Konto nr.','Firma navn','Telefon','Leveres til','Vor ref.','Faktura sum']
            ) );
  htm_RudeBund($pmpt='@Gem',$revi=false,$title='@Gem');
}

# PROGRAM-MODUL;
function Rude_DbOrdrer() {
  htm_Rude_Top($name= 'naviform',$capt= '@Ordrer: Debitorer - `Kundeordrer`:',$parms='',$icon='','panelWmax',__FUNCTION__);
  htm_Tabel($RowLabl=tolk('@kundeordre'),$ColStyle= array(  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
            ['@Ordre nr.','4%','','','','',''],['@Ordre dato','7%','','date','left','','åååå-mm-dd'],['@Lev. dato','7%','','date','left','','åååå-mm-dd'],
            ['@Konto nr.','6%','','text','center','',tolk('@Kont...')],['@Firma navn','24%','','','','',tolk('@Firm...')],['@Sælger','8%','','','','',tolk('@Sælg...')],['@Ordre sum','6%','','','','',tolk('@Beløb...')]),
            $TablData= array(
            ['1025','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1026','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1027','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1028','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum']
            ) );
  htm_RudeBund($pmpt='@Gem',$revi=false,$title='@Gem');
}

# PROGRAM-MODUL;
function Rude_DebRapp() {
  htm_Rude_Top($name= 'naviform',$capt= '@Debitor-rapporter:',$parms='',$icon='','panelWmax',__FUNCTION__);
    htm_FrstFelt('05%',0);  
    htm_NextFelt('35%');  echo '<p align="center">'.tolk('@Angiv kriterier:').'</p> ';
    htm_NextFelt('02%');  
    htm_NextFelt('58%');  htm_CheckFlt($type='checkbox',$name='somfakt',$valu='somfakt',
                          $titl='@Afmærk her, hvis kriterier skal genbruges.',  $labl='@Husk dem',$revi=true);
    htm_LastFelt();
  htm_FrstFelt('05%',0);  
  htm_NextFelt('48%');  htm_CombFelt($type='text',$name='konto',  $valu='', $titl='@Angiv rapporterings Konto', $labl='@Konto', $revi=true);
  htm_NextFelt('47%');  htm_CombFelt($type='date',$name='dato',   $valu='', $titl='@Angiv periode start Dato',  $labl='@Fra Dato',  $revi=true);
  htm_LastFelt();
  echo '<div style="margin-left:1em; display:block; font-weight: normal;" >Vælg: '; 
    htm_accept('@Åbne poster',    '@Rapport for debitor åbne poster');
    htm_accept('@Konto saldo',    '@Rapport for debitor konto saldo');    
    htm_accept('@Konto kort',     '@Rapport for debitor konto kort');
    htm_accept('@Salgs statistik','@Rapport for debitor Salgs statistik');
    htm_accept('@Top 100',        '@Rapport for Top 100');
  echo '</div>';  
    
  htm_RudeBund($pmpt='@Gem',$revi=false,$title='@Gem');
}

# PROGRAM-MODUL;
function Rude_KredRapp() {
  htm_Rude_Top($name= 'naviform',$capt= '@Kreditor-rapporter:',$parms='',$icon='','panelWmax',__FUNCTION__);
    htm_FrstFelt('05%',0);  
    htm_NextFelt('35%');  echo '<p align="center">'.tolk('@Angiv kriterier:').'</p> ';
    htm_NextFelt('02%');  
    htm_NextFelt('58%');  htm_CheckFlt($type='checkbox',$name='somfakt',$valu='somfakt',
                          $titl='@Afmærk her, hvis kriterier skal genbruges.',  $labl='@Husk dem',$revi=true);
    htm_NextFelt('05%');
    htm_LastFelt();
  htm_FrstFelt('0%',0); 
  htm_NextFelt('50%');  htm_CombFelt($type='text',$name='konto',  $valu='', $titl='@Angiv rapporterings Konto', $labl='@Konto', $revi=true);
  htm_NextFelt('50%');  htm_CombFelt($type='date',$name='dato',   $valu='', $titl='@Angiv periode start Dato',  $labl='@Fra Dato',  $revi=true);
  htm_LastFelt();
  echo '<div style="margin-left:1em; display:block; font-weight: normal;" >Vælg: '; 
    htm_accept('@Åbne poster',    '@Rapport for kreditor åbne poster');
    htm_accept('@Konto saldo',    '@Rapport for kreditor konto saldo');
    htm_accept('@Konto kort',     '@Rapport for kreditor konto kort');
    htm_accept('@Købs statistik', '@Rapport for kreditor købs statistik');
  echo '</div>';  
  htm_RudeBund($pmpt='@Gem',$revi=false,$title='@Gem');
}


# PROGRAM-MODUL;
function Rude_KasseRedigering($id='2',$dato='Dato',$ejer='Bogholder',$bemr='Bemærkning 2',$bogf='Bogført',$af='Af') {
  $dktip=   tolk('@D/K/F  feltet benyttes i forbindelse med debitor- og kreditor posteringer. ').
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
  htm_Rude_Top($name= 'kasseform',$capt= '@Kassekladde: '.$id.', <small>'.$ejer.'</small>',$parms='',$icon='','panelWmax',__FUNCTION__);
  htm_TabelInp(   # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
    $HeadLine= array(
      ['@Kladde notat:', '60%','left','text', '@Her kan skrives en bemærkning til kladden',                  '@Angiv din tekst...'], 
      ['@Konto-kontrol:','5em','left','text', '@Angiv kontonummer for den konto, hvis bevægelser skal kontrolleres',  '@Nummer...'], 
    ),
    $RowPref= array(  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
          ['PDF',     '3%','center','text','<a href='.$link.'><img src=../icons/'.$clip.'  alt="Clips" height="20" width="12" border=0 title="'.tolk($title).
              '"></a>',tolk('@I denne kolonne håndterer du PDF-bilag, som er tilknyttet den enkelte postering.'),'placeh']
          ),
    $ColStyle= array( # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      ['@Bilag.',       '5%','left',  'text',tolk('@Bilagsnummer tildeles automatisk og fortsættes fra sidst anvendte bilagsnummer fra samme bruger.').' ','...auto...'],
      ['@Dato',         '9%','center','date',tolk('@Bilagets dato, som automatisk sættes til dags dato, men kan ændres.'),'fakt.dato'],
      ['@Bilags tekst','20%','left',  'text',tolk('@Bilagstekst er frivillig, men det er nyttigt senere at kunne se, hvad de enkelte posteringer drejer sig om.').' ',tolk('@Posterings note...')],
      ['@D/K',        '3.5%','center','text',$dktip,'d/k/f'],
      ['@Debet Kt.',    '8%','center','text',$debkre],
      ['@D/K',        '3.5%','center','text',$dktip,'d/k/f'],
      ['@Kredit Kt.',   '8%','center','text',$debkre],
      ['@Faktura nr.',  '8%','center','text',tolk('@Fakturanr. benyttes i forbindelse med debitor- og kreditorposteringer.')],
      ['@Beløb',        '8%','right','tal2d',tolk('@Beløb indeholder det beløb, der skal bogføres. Hvis man ved simulering eller anden kontrol opdager, ').
                      tolk('@at en linje skal bogføres direkte modsat af, hvad der står i kassekladden, så kan man blot sætte minustegn foran beløbet. ').' '.
                      tolk('@På den måde bytter kontonumrene i felterne debet og kredit plads, og beløbet bliver igen positivt.')],
      ['@Valuta',     '4%','center','text','@Valutakode for den valuta, som er benyttet på bilaget.','DKK'],
      ['@Forfald',    '9%','center','date','@Beløbets forfalds dato','forf.dato'],
      ),
    $RowSuff= array(  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
        ['@Konto saldo','8%','right','text','0.000,00<div type= "text" name="saldo" value="00.000,00" width="8%"/>',
          tolk('@Bevægelser og saldo for den konto, som er angivet ovenfor i Felt: Konto-kontrol.').' <br>'.
          tolk('@Er velegnet til afstemning med bank- og girokonti'),'.?.']),
        $data= array(1,2,3,4,5,6,7,8,9,10)  # Antal rows ved DEMO
      
  );
### PanelFooter:
  NaviTip();
### KnapPanel:
  echo '<div style="text-align:center;">'; 
  echo  textKnap($label='@Gem',             $title='@Klik her for at gemme',$link='../_base/blindgyden.php').
        textKnap($label='@Opslag',          $title='@Opslag - din markørs placering angiver hvilken tabel, opslag foretages i',$link='../_base/blindgyden.php').
        textKnap($label='@Bogfør',          $title='@Bogfør - der foretages først en simulering, som du skal bekræfte',$link='../_base/blindgyden.php').
        textKnap($label='@Simuler',         $title='@Simulering af bogføring viser bevægelser i kontoplanen',$link='../_base/blindgyden.php').
        textKnap($label='@Annuller',        $title='@Annuller simulering',$link='../_base/blindgyden.php').
        textKnap($label='@Kopier',          $title='@Kopier til ny',$link='../_base/blindgyden.php').
        textKnap($label='@Tilbagefør',      $title='@Tilbagefør postering',$link='../_base/blindgyden.php').
        textKnap($label='@Hent ordrer',     $title='@Henter afsluttede ordrer fra ordreliste',$link='../_base/blindgyden.php').
        textKnap($label='@DocuBizz import', $title='@DocuBizz import',$link='../_base/blindgyden.php').
        textKnap($label='@Import',          $title='@Importerer bankposteringer eller andre data fra .csv-fil (kommasepareret fil)',$link='../_base/blindgyden.php').
        textKnap($label='@Udlign',          $title='@Finder åbne poster, som modsvarer beløb og fakturanummer',$link='../_base/blindgyden.php').
  '</div>';
  htm_RudeBund($pmpt='@Gem',$revi=false,$title='@Gem');
}

# PROGRAM-MODUL;
function Rude_OrdrePostering() {
  htm_Rude_Top($name= 'ordreform',$capt= '@Indtastning af salgs ordre poster - `Varelinier`:',$parms='',$icon='','panelWmax',__FUNCTION__);
  htm_TabelInp(
    $HeadLine= array(
      ['@Status:', '60%','left','text', '@Her kan skrives en bemærkning til ordren', '@Ny ordre, endnu uden kundetilknytning!'], 
      ['@Kundetilknytning:','5em','left','text', '@Angiv kontonummer på kunden','@Konto...'], 
    ),
    $RowPref= array(), #  array(['Link'],['Label'],['Tip'],['4%']),
    $ColStyle= array( # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      ['@Pos.',        '5%','left', 'text',tolk('@Position tildeles automatisk.').' ','Pos...'],
      ['@Varenr',     '10%','left', 'text',tolk('@Varenummer hentes fra vareregistret.'),'Vare...'],
      ['@Antal',       '5%','left', 'text',tolk('@Mængden af den aktuelle leverance.').' ','Ant...'],
      ['@Enhed',       '5%','left', 'text',tolk('@Enhedsbeskrivelse af mængden'),'Enh...'],
      ['@Beskrivelse','40%','left', 'text',tolk('@Leverance beskrivlse'),'Beskr...'],
      ['@Pris',       '10%','left', 'tal2d',tolk('@Enhedspris'),'Pris...'],
      ['@Rabat%',      '6%','left', 'tal2d',tolk('@Rabatsats i %.'),'Rabat'],
      ['@Moms%',       '6%','left', 'tal2d',tolk('@Moms %-sats for den posterede leverance'),'Moms...'],
    # ['@Linie ialt', '10%','left', 'tal2d',tolk('@Beregnet beløb.')] tilføjes internt i htm_TabelInp
    ),
//  $RowSuff= array(['<a href='.$link.' onclick=\"return confirm($confm)\"><img src=../icons/clip.png  alt="Clips" height="80%" width="80%" border=0></a>'],  [])
    $RowSuff= array(  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
        ['@um.',        '5%','center','text','<input type= "checkbox" name="udenmoms" value="" >',tolk('@um. (uden moms) kan benyttes til at bogføre beløb uden moms på konti, selvom kontoen har en momssats tilknyttet.'),'.?.'],
        ['@Linie ialt', '8%','center','text','<div type= "text" name="saldo" value="00.000,00" width="8%">',tolk('@Beregnet felt med summen af de samlede beløb'),'.?.']),
    $data= array(1,2,3,4,5,6,7,8,9,10)  # Antal rows ved DEMO
  );
### PanelFooter:
  NaviTip();
### KnapPanel:
  echo '<div style="text-align:center;">';
  echo  textKnap($label='@Gem',             $title='@Klik her for at gemme',$link='../_base/blindgyden.php').
        textKnap($label='@Opslag',          $title='@Opslag - din markørs placering angiver hvilken tabel, opslag foretages i',$link='../_base/blindgyden.php').
        textKnap($label='@Slet alt',        $title='@Klik her for at nulstille alle data i tabellen.',$link='../_base/blindgyden.php').
        '</div>';
 htm_RudeBund($pmpt='@Gem',$revi=false,$title='@Gem');
}

# SubRutine:
#function getComboA(sel) { var value = sel.value; };

# PROGRAM-MODUL;
function Rude_Formularer($formtype,$formart,$formsprog) {
  htm_Rude_Top($name= 'formularform',$capt= '@Formularstyring',$parms='../_systemdata/page_Syssetup.php',$icon='fa-wrench','panelW240',__FUNCTION__);
  htm_OptioFlt($type='text',  $name='formtype',   $valu= $formtype, 
                    $titl='@Vælg en Formular som du vil redigere',  
                    $labl='@Formular',      $revi=true, $optlist= array(
                    ['','1',  '@Tilbud'],
                    ['','9',  '@Plukliste'],
                    ['','2',  '@Ordrebekræftelse'],
                    ['','3',  '@Følgeseddel'],
                    ['','4',  '@Faktura'],
                    ['','5',  '@Kreditnota'],
                    ['','6',  '@Rykker_1'],
                    ['','7',  '@Rykker_2'],
                    ['','8',  '@Rykker_3'],
                    ['','11', '@Kontokort'],
                    ['','12', '@Indkøbsforslag'],
                    ['','13', '@Rekvisition'],
                    ['','14', '@Købsfaktura'],
                  # ['','10', '@Pos'],
                    ),$action='');
  htm_OptioFlt($type='text',  $name='formart',   $valu= $formart, 
                    $titl='@Vælg formularens Art (Objekt type)',  
                    $labl='@Formular Art',      $revi=true, $optlist= array(
                    ['','1:Linjer',       '@Grafik'],
                    ['','2:Tekster',      '@Tekster'],
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
  echo textKnap($label='@Rediger valgt formular', $title='@Rediger det du har valgt ovenfor',$link='../_base/blindgyden.php').'<hr>';
  echo '</div>';
  echo  textKnap($label='@Gem mine formularer',               $title='@Lav backup af det nugældende formularsæt.',$link='../_base/blindgyden.php').'<br><br>';
  echo  textKnap($label='@Genindlæs mine formularer',         $title='@Tag backup i brug, ved at benytte den som nugældende formularsæt.',$link='../_base/blindgyden.php').'<br><br>';
  echo  textKnap($label='@Importer formular(er) fra LO ',     $title='@Indlæs fra .fodg-fil dannet af LibreOffice',$link='../_base/blindgyden.php').'<br><br>';
  echo  textKnap($label='@Overskriv formularer med standard', $title='@Overskriv formulardefination med standard',$link='../_base/blindgyden.php').'<br><br>';
  echo  textKnap($label='@Håndtering af formularsprog',       $title='@Sproghåndtering: Opret, Nedlæg sprog',$link='../_base/blindgyden.php').'<br><br>';
  echo  textKnap($label='@Upload/Download supportfiler',      $title='@Fil upload: Logo, Grafik, Billeder eller fodg-fil fra Libre Office',$link='../_base/blindgyden.php').'<br><br>';
  htm_RudeBund($pmpt='@Gå til indstillinger',$revi=true,$title='@Retur til menuen indstillinger');
}

function SetHead ($x) {
  return  array(
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
      $HeadLine= SetHead('@Tekster'),
      $RowPref= array(),
      $ColStyle= array( # [ColLabl, ColWidth, ColJust, InpType, ColTip, placeholder]
        ['@$Variabel',  '10%','left', 'vlst',tolk('@Her kan du vælge mellem de variabler, som er relevante, for den aktuelle formular.'),''],
        ['@Tekst/$variabel','35%','left', 'text',tolk('@Feltets tekst og/eller $Variabler kombineret'),'...Tekst...'],
        ['@X',          '4%','right', 'text',tolk('@Feltets x-placering målt i mm fra venstre side-kant'),'.x.'],
        ['@Y',          '4%','right', 'text',tolk('@Feltets y-placering målt i mm fra side-bund'),'.y.'],
        ['@Højde',      '4%','right', 'text',tolk('@Felt højde målt i mm'),'.h.'],
        ['@Farve',      '7%','center','text',tolk('@Tekst farve. Se farve skema'),'#Kode.'],
        ['@Just.',      '4%','center','just',tolk('@Justering i feltet: V:venstre, C:centreret, H:højre'),'?'],     //  '<SELECT class="inputbox" NAME=justering[$x]>     <option>$justering</option>     <option>V</option>      <option>C</option>      <option>H</option>      </SELECT>'
        ['@Font',       '8%','center','font',tolk('@Skrift type navn: Helvetica, Times, OCRbb12'),'Font navn...'],  //  '<SELECT class="inputbox" NAME=form_font[$x]> if ($font) <option>$font</option> <option>Helvetica</option>  <option>Times</option>  <option>Ocrbb12</option>  </SELECT>'
        ['@Side',       '4%','center','side',tolk('@Medtages på udskrifts side. A:alle, 1:første, !1:ikke første, S:sidste, !S:ikke sidste')],  //  '<SELECT class="inputbox" NAME=side[$x]>  if ($side) <option>$side</option> <option>A</option>  <option>1</option>  <option>!1</option> <option>S</option>  <option>!S</option> </SELECT>'
        ),
      $RowSuff= array(  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
        ['@Fed',        '4%','center','text','<a hrefxxx='.$link.' ><input type= "checkbox" name="bold" value="" ></a>',tolk('@Bold skrift type, også kaldet fed skrift'),'.?.'],
        ['@Skrå',       '4%','center','text','<a hrefxxx='.$link.' ><input type= "checkbox" name="italic" value="" ></a>',tolk('@Skrå skrift type, også kaldet italic'),'.?.']),
      $data= array(1,2,3,4,5,6,7,8,9,10)  # Antal rows ved DEMO
    );  
    forskydning();
    echo '<hr>';
    htm_FrstFelt('15%');  echo '<div style= "text-align:right">'.tolk('@Mail tekster:').'</div>';
    htm_NextFelt('20%');  htm_CombFelt($type='area',  $name='emne',   $valu= '',  $titl='@Her kan du angive mailens emne-tekst.', $labl='@Emne',  $revi=true,$rows='2',$width='45',$step='',$more='placeholder="Vedrørende..."');
    htm_NextFelt('45%');  htm_CombFelt($type='area',  $name='besked', $valu= '',  $titl='@Besked til modtageren.',  $labl='@Besked',  $revi=true, $rows='', $width='45',$step='',$more='placeholder="Vedhæftet følger..."');
    htm_NextFelt('20%');  htm_CombFelt($type='area',  $name='bilag',  $valu= '',  $titl='@Angiv filnavne, på de filer der skal vedhæftes.', $labl='@Bilag', $revi=true, $rows='', $width='45',$step='',$more='placeholder="PDF-fil..."');
    htm_LastFelt(); 
    htm_RudeBund($pmpt='@Gem',$revi=true,$title='@Gem');
}

# PROGRAM-MODUL;
function Rude_FormRedigerGrafik() {
  htm_Rude_Top($name= 'redigerform',$capt= '@Rediger Formular: Grafik',$parms='',$icon='fa-wrench','panelW960',__FUNCTION__);
  htm_TabelInp(     # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      $HeadLine= SetHead('@Grafik'),
      $RowPref= array(
        ['LOGO: ',    '27%','right','text','  ','Grafik f.eks. jpg-billede. Billedet benyttes uden skalering, så det skal være målfast med 720 pt/in.','.?.'],
      ),
      $ColStyle= array( # [ColLabl, ColWidth, ColJust, InpType, ColTip, placeholder]
        ['@X-venstre', '8%','right',  'text',tolk('@Stregens x-startpunkt målt i mm fra venstre side-kant'),'.x.'],
        ['@Y-bund',    '8%','right',  'text',tolk('@Stregens y-startpunkt målt i mm fra side-bund'),'.y.'],
        ['@Side',      '5%','center','side',tolk('@Medtages på udskrifts side. A:alle, 1:første, !1:ikke første, S:sidste, !S:ikke sidste')],
        ['@Filnavn',  '30%','left','text',tolk('@Filnavn på grafik-fil')],
        ),
      $RowSuff= array(
        ['',        '22%','center','text','','','.?.'],
      ),  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
      $data= array(1,2) # Antal rows ved DEMO
    );
  htm_TabelInp(     # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      $HeadLine= array(),
      $RowPref= array(
        ['STREGER:',        '23%','right','text','  ','Grafiske linier','.?.'],
      ),
      $ColStyle= array( # [ColLabl, ColWidth, ColJust, InpType, ColTip, placeholder]
        ['@X-start',    '6%','right', 'text',tolk('@Stregens x-startpunkt målt i mm fra venstre side-kant'),'.x.'],
        ['@Y-start',    '6%','right', 'text',tolk('@Stregens y-startpunkt målt i mm fra side-bund'),'.y.'],
        ['@X-slut',     '6%','right', 'text',tolk('@Stregens x-slutpunkt målt i mm fra venstre side-kant'),'.x.'],
        ['@Y-slut',     '6%','right', 'text',tolk('@Stregens y-slutpunkt målt i mm fra side-bund'),'.y.'],
        ['@Bredde',     '6%','right', 'text',tolk('@Felt højde målt i mm'),'.h.'],
        ['@Farve',      '8%','left',  'text',tolk('@Tekst farve. Se farve skema'),'#Kode.'],
        ['@Side',       '5%','center','side',tolk('@Medtages på udskrifts side. A:alle, 1:første, !1:ikke første, S:sidste, !S:ikke sidste')],
        ),
      $RowSuff= array(
        ['Evt. Note:',  '20%','center','text','','(Ikke implementeret endnu!)','.?.'],
      ),  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
      $data= array(1,2,3,4,5,6,7,8,9,10)  # Antal rows ved DEMO
    );
    forskydning();
    htm_RudeBund($pmpt='@Gem',$revi=true,$title='@Gem');
}

# PROGRAM-MODUL;
function Rude_FormRedigerOrdrelin() {
  htm_Rude_Top($name= 'redigerform',$capt= '@Rediger Formular: Ordrelinier',$parms='',$icon='fa-wrench','panelW960',__FUNCTION__);
  htm_TabelInp(     # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
     $HeadLine= SetHead('@Ordrelinjer'),
     $RowPref= array(
        ['Generelt: ',    '30%','right','text',' Ordreliniers placering på siden: ','Tip','.?.'],
      ),
      $ColStyle= array( # [ColLabl, ColWidth, ColJust, InpType, ColTip, placeholder]
        ['@Linie antal',  '8%','center',  'text',tolk('@Antal ordrelinier på en side.'),'.n.'],
        ['@Y-Top-linie',  '8%','center',  'text',tolk('@Første ordrelines y-startpunkt målt i mm fra side-bund'),'.y.'],
        ['@Linieafstand', '8%','center',  'text',tolk('@Afstand mellem liniers grundlinie, målt i mm. '),'.Afstand [mm].'],
        ['@Bredde af beskrivelse',  '8%','center',  'text',tolk('@Maksimal linie længde for beskrivelse, inden der brydes til ny linie, målt i mm. '),'.Bredde [mm].'],
        ),
      $RowSuff= array(
        ['',        '30%','center','text','','','.?.'],
      ),  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
      $data= array(1) # Antal rows ved DEMO
    );
  htm_TabelInp(     # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      $HeadLine= array(),
      $RowPref= array(
        ['ORDRELINIER:',  '15%','right','text','  ',tolk('@Tekst linier med ordrepostering.'),'.?.'],
      ),
      $ColStyle= array( # [ColLabl, ColWidth, ColJust, InpType, ColTip, placeholder]
        ['@Feltnavn', '16%','left', 'data',   tolk('@Navnet på variablen'),'@navn...'],
        ['@X-pos',    '6%','right', 'number', tolk('@Tekstens x-startpunkt målt i mm fra venstre side-kant'),'.x.'],
        ['@Højde',    '6%','right', 'number', tolk('@Teksthøjde målt i [px]'),'.h.'],
        ['@Farve',    '6%','left',  'text',   tolk('@Tekst farve. Se farve skema'),'#...'],
        ['@Just.',    '4%','center','just',   tolk('@Justering i feltet: V:venstre, C:centreret, H:højre'),'?'],     //  '<SELECT class="inputbox" NAME=justering[$x]>     <option>$justering</option>     <option>V</option>      <option>C</option>      <option>H</option>      </SELECT>'
        ['@Font',     '8%','center','font',   tolk('@Skrift type navn: Helvetica, Times, OCRbb12'),'Font navn...'],  //  '<SELECT class="inputbox" NAME=form_font[$x]> if ($font) <option>$font</option> <option>Helvetica</option>  <option>Times</option>  <option>Ocrbb12</option>  </SELECT>'
        ),
      $RowSuff= array(  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
        ['@Fed',        '4%','center','text','<a hrefxxx='.$link.' ><input type= "checkbox" name="bold" value="" ></a>',tolk('@Bold skrift type, også kaldet fed skrift'),'.?.'],
        ['@Skrå',       '4%','center','text','<a hrefxxx='.$link.' ><input type= "checkbox" name="italic" value="" ></a>',tolk('@Skrå skrift type, også kaldet italic'),'.?.'],
        ['Evt. Note:',  '20%','center','text','',tolk('@(Ikke implementeret endnu!)'),'.?.']
      ),  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
      $data= array([['@ @posnr'],['X-pos'],['Højde'],['C'],['D']],[['@ @varenr'],['X-pos'],['Højde'],['C'],['D']],[['@ @beskrivelse'],['X-pos'],['Højde'],[''],['D']],[['@ @antal'],['X-pos'],['Højde'],['C'],['D']],[['@ @liniesum'],['X-pos'],['Højde'],['C'],['D']],[['Nyt felt'],['X-pos'],['Højde'],['C'],['D']])  # Antal rows ved DEMO
    );  # [[0:Feltnavn],[1:X-pos],[2:Højde],[3:Farve],[4:Just.],[5:Font],[6:Fed],[7:Skrå],[8:Evt. Note:],[... ]]
    forskydning();
    htm_RudeBund($pmpt='@Gem',$revi=true,$title='@Gem');
}

# PROGRAM-MODUL;
function Rude_MomsSetup() {
  htm_Rude_Top($name= 'moms',$capt= '@Moms indstillinger:',$parms='',$icon='fa-wrench','panelW960',__FUNCTION__);
  htm_TabelInp(     # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      $HeadLine= array( [' ', '8%','left','show', '', '@Indland'] ),
      $RowPref= array(
        ['@Salgsmoms (udgående moms): ',    '24%','right','text','@Salg: ','@Den moms du skal betale til SKAT','.?.'],
      ),
      $ColStyle= array( # [ColLabl, ColWidth, ColJust, InpType, ColTip, placeholder]
        ['@Nr.',          '4%','center', 'data',tolk('@Positions nummer i gruppen'),'.Nr.'],
        ['@Beskrivelse', '20%','left',   'data',tolk('@Kontobeskrivelse. En beskrivende tekst efter eget valg'),'Tekst...'],
        ['@Konto',        '6%','center', 'data',tolk('@Det nummer i kontoplanen, som salgsmomsen skal konteres på.'),'Konto...'],
        ['@%-Sats',       '6%','center', 'data',tolk('@Moms %-sats'),'25%...'],
        ),
      $RowSuff= array(
        ['',        '30%','center','text','','','.?.'],
      ),  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
      $data= array([['1'],['@Salgsmoms'],['66100'],['25,00'],['']], [['2'],[''],[''],[''],[''] ] ) 
     );
  htm_TabelInp(     # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      $HeadLine= array( ),
      $RowPref= array(
        ['@Købsmoms (indgående moms): ',    '24%','right','text','@Køb: ','@Den moms du skal have retur fra SKAT','.?.'],
      ),
      $ColStyle= array( # [ColLabl, ColWidth, ColJust, InpType, ColTip, placeholder]
        ['@Nr.',          '4%','center', 'data',tolk('@Positions nummer i gruppen'),'.Nr.'],
        ['@Beskrivelse', '20%','left',   'data',tolk('@Kontobeskrivelse. En beskrivende tekst efter eget valg'),'Tekst...'],
        ['@Konto',        '6%','center', 'data',tolk('@Det nummer i kontoplanen, som købsmomsen skal konteres på.'),'Konto...'],
        ['@%-Sats',       '6%','center', 'data',tolk('@Moms %-sats'),'25%...'],
        ),
      $RowSuff= array(
        ['',        '30%','center','text','','','.?.'],
      ),  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
      $data= array([['1'],['@Købsmoms'],['66200'],['25,00'],['']], [['2'],[''],[''],[''],[''] ] ) 
     );
   echo '<hr>';

  htm_TabelInp(     # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      $HeadLine= array( [' ', '8%','left','show', '', '@Udland'] ),
      $RowPref= array(
        ['@Moms af ydelseskøb i udlandet: ',    '24%','right','text','@Ydel: ','@Ved ydelseskøb i udlandet, skal der betales dansk moms på vegne af sælgeren.  Samtidig kan købsmomsen trækkes fra så resultatet bliver 0','.?.'],
      ),
      $ColStyle= array( # [ColLabl, ColWidth, ColJust, InpType, ColTip, placeholder]
        ['@Nr.',          '4%','center', 'data',tolk('@Positions nummer i gruppen'),'.Nr.'],
        ['@Beskrivelse', '20%','left',   'data',tolk('@Kontobeskrivelse. En beskrivende tekst efter eget valg'),'Tekst...'],
        ['@Konto',        '6%','center', 'data',tolk('@Konto til postering af salgsmoms for ydelseskøb i udlandet'),'Konto...'],
        ['@%-Sats',       '6%','center', 'data',tolk('@Moms %-sats'),'25%...'],
        ['@Modkonto',     '6%','center', 'data',tolk('@Konto til postering af købsmoms for ydelseskøb i udlandet'),'Konto...'],
        
        ),
      $RowSuff= array(
        ['',        '22%','center','text','','','.?.'],
      ),  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
      $data= array([['1'],['@Moms af ydelseskøb i udlandet'],['66155'],['25,00'],['66200']], [['2'],[''],[''],[''],[''] ] ) 
     );
  htm_TabelInp(     # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      $HeadLine= array( ),
      $RowPref= array(
        ['@Moms af varekøb i udlandet: ',    '24%','right','text','@Vare: ','@Ved varekøb i udlandet, skal der betales dansk moms på vegne af sælgeren.  Samtidig kan købsmomsen trækkes fra så resultatet bliver 0','.?.'],
      ),
      $ColStyle= array( # [ColLabl, ColWidth, ColJust, InpType, ColTip, placeholder]
        ['@Nr.',          '4%','center', 'data',tolk('@Positions nummer i gruppen'),'.Nr.'],
        ['@Beskrivelse', '20%','left',   'data',tolk('@Kontobeskrivelse. En beskrivende tekst efter eget valg'),'Tekst...'],
        ['@Konto',        '6%','center', 'data',tolk('@Konto til postering af salgsmoms for køb i udlandet'),'Konto...'],
        ['@%-Sats',       '6%','center', 'data',tolk('@Moms %-sats'),'25%...'],
        ['@Modkonto',     '6%','center', 'data',tolk('@Konto til postering af købsmoms for køb i udlandet'),'Konto...'],
        
        ),
      $RowSuff= array(
        ['',        '22%','center','text','','','.?.'],
      ),  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
      $data= array([['1'],['@Moms af varekøb m.v. i udlandet'],['66150'],['25,00'],['66200']], [['2'],[''],[''],[''],[''] ] ) 
     );

  htm_TabelInp(     # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      $HeadLine= array( [' ', '8%','left','show', '', '@Rapporter'] ),
      $RowPref= array(
        ['@Momsrapport (konti som skal indgå i momsrapport): ',    '24%','right','text','@Rap: ','@Den moms du skal betale til SKAT','.?.'],
      ),
      $ColStyle= array( # [ColLabl, ColWidth, ColJust, InpType, ColTip, placeholder]
        ['@Nr.',          '4%','center', 'data',tolk('@Positions nummer i gruppen'),'.Nr.'],
        ['@Beskrivelse', '20%','left',   'data',tolk('@Kontobeskrivelse. En beskrivende tekst efter eget valg'),'Tekst...'],
        ['@Fra',          '6%','center', 'data',tolk('@Første kontonummer som skal indgå i rapporten'),'Konto...'],
        ['@Til',          '6%','center', 'data',tolk('@Sidste kontonummer som skal indgå i rapporten'),'25%...'],
        ['@Rubrik A1',    '6%','center', 'data',tolk('@Kontonummer for samlet varekøb i EU'),'Konto...'],
        ['@Rubrik A2',    '6%','center', 'data',tolk('@Kontonummer for samlet ydelseskøb i EU'),'Konto...'],
        ['@Rubrik B1',    '6%','center', 'data',tolk('@Kontonummer for samlet varesalg i EU'),'Konto...'],
        ['@Rubrik B2',    '6%','center', 'data',tolk('@Kontonummer for samlet ydelsessalg i EU'),'Konto...'],
        ['@Rubrik C',     '6%','center', 'data',tolk('@Kontonummer for samlet vare- og ydelsessalg uden for EU'),'Konto...'],
       
        ),
      $RowSuff= array(
        ['',        '1%','center','text','','','.?.'],
      ),  # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
      $data= array([['1'],['@Momsrapport'],['66100'],['66200'],['2800'],['2700'],['1220'],['1200'],['1290'] ] ) 
     );
  htm_RudeBund($pmpt='@Gem',$revi=true,$title='@Gem');
}

# PROGRAM-MODUL;
function Rude_Stamdata () { 
  htm_Rude_Top($name='stamkort',$capt='@Stamdata:',$parms='',$icon='fa-user',$klasse='panelW320',__FUNCTION__);
  htm_CombFelt($type='text',  $name='firmanavn',  $valu= $firmanavn,  $titl='@Navnet på det firma, regnskabet angår',   $labl='@Firmanavn',   $revi=true);
  htm_CombFelt($type='text',  $name='addr1',      $valu= $addr1,      $titl='@Firmaets adresse',                        $labl='@Adresse',     $revi=true);
  htm_CombFelt($type='text',  $name='addr2',      $valu= $addr2,      $titl='@Supplerende stedsangivelse',              $labl='@Sted',        $revi=true);
  htm_FrstFelt('25%');  htm_CombFelt($type='text',  $name='postnr', $valu= $postnr, $titl='@Postnr',                    $labl='@Postnr.',     $revi=true);
  htm_NextFelt('75%');  htm_CombFelt($type='text',  $name='bynavn', $valu= $bynavn, $titl='@Bynavn. firmaets hjemsted', $labl='@Bynavn',      $revi=true);
  htm_LastFelt();
  htm_CombFelt($type='mail',  $name='ny_email',   $valu= $ny_email,   $titl='@Firmaets Mail-adresse',                   $labl='@Mail',        $revi=true);
  htm_CombFelt($type='text',  $name='homepage',   $valu= $homepage,   $titl='@Firmaets hjemmeside-adresse',             $labl='@Hjemmeside',  $revi=true);
  htm_CombFelt($type='text',  $name='bank_navn',  $valu= $bank_navn,  $titl='@Bank forbindelse',                        $labl='@Bank',        $revi=true);
  htm_FrstFelt('25%');  htm_CombFelt($type='text',  $name='bank_reg',   $valu= $bank_reg,   $titl='@Bank reg.',         $labl='@Bank reg.',   $revi=true);
  htm_NextFelt('75%');  htm_CombFelt($type='text',  $name='bank_konto', $valu= $bank_konto, $titl='@Bank konto',        $labl='@Bank konto',  $revi=true);
  htm_LastFelt();
  htm_CombFelt($type='text',  $name='cvrnr',      $valu= $cvrnr,      $titl='@CVR - Virksomheds ID. Tast CVR-nr. omsluttet af *, +, eller / for at importere data fra Erhvervsstyrelsen (Data leveres af CVR API)', $labl='@CVR',       $revi=true);
  htm_CombFelt($type='text',  $name='tlf',        $valu= $tlf,        $titl='@Tlf - Tast telefonnr. omsluttet af *, +, eller / for at importere data fra Erhvervsstyrelsen (Data leveres af CVR API)',              $labl='@Telefon.',  $revi=true);
  htm_CombFelt($type='text',  $name='fax',        $valu= $fax,        $titl='@Firmaets fax',                            $labl='@Fax',         $revi=true);
  if ($pbs_nr) {
    htm_FrstFelt('40%');  htm_CombFelt($type='text',  $name='pbs_nr', $valu= $pbs_nr, $titl='@Firmaets pbsnr',  $labl='@PBS Kreditornr.', $revi=true);
    htm_NextFelt('60%');  if ($pbs=='B')      htm_OptioFlt($type='text',  $name='pbs',    $valu= $pbs,  $titl='@Vælg den aftalte løsning',  $labl='@Aftale',  
                                              $revi=true, $optlist= array( ['','B','@Basis løsning'], ['','', '@Total løsning'], ['','L','@Lev. Service']),$action='');
                          elseif ($pbs=='L')  htm_OptioFlt($type='text',  $name='pbs',    $valu= $pbs,  $titl='@Vælg den aftalte løsning',  $labl='@Aftale',  
                                              $revi=true, $optlist= array( ['','L','@Lev. Service'], ['','B','@Basis løsning'],['','', '@Total løsning'] ),$action='');
                          else                htm_OptioFlt($type='text',  $name='pbs',    $valu= $pbs,  $titl='@Vælg den aftalte løsning', $labl='@Aftale',
                                              $revi=true, $optlist= array( ['','', '@Total løsning'], ['','B','@Basis løsning'], ['','L','@Lev. Service']),$action='');
    htm_LastFelt();
  } else  htm_CombFelt($type='text',  $name='pbs_nr', $valu= $pbs_nr, $titl='@Firmaets pbsnr',  $labl='@PBS Kreditornr.',   $revi=true);
  htm_CombFelt($type='text',  $name='gruppe', $valu= $gruppe, $titl='@Gruppe ',                 $labl='@PBS debitorgruppe', $revi=true);
  htm_CombFelt($type='text',  $name='fi_nr',  $valu= $fi_nr,  $titl='@Bankernes fælles indbetalingskort (FI-kort). Her angiver du dit FI Kreditornr.',    $labl='@FI Kreditornr.',    $revi=true);
  htm_RudeBund($pmpt='@Gem',$revi=true,$title='@Gem');
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
  htm_RudeBund($pmpt='@Gem',$revi=true,$title='@Gem');
}

# DEMO-MODUL;
function Rude_Intro() {global $languageTable;
  htm_Rude_Top($name= 'intro',$capt= '@Introduktion:',$parms='',$icon='fa-info','panelWmax',__FUNCTION__);
  echo '<div style="text-align:center;"><big>Velkommen til en demo af SALDI med nyt moderne <b>CSS</b>-baseret <b>responsive</b> design,<br><br>'.
  ' samt <b>sprogunderstøttelse</b> og forberedt for forøget <b>sikkerhed</b> omkring password.</big><br><br>';
  echo 'Herunder demonstreres output-modulerne {out_*.php} og deres benyttelse.<br><br>';
  echo 'Der mangler stadig funktionalitet, så vil du skifte sprog, skal der tilføjes  parameter i URL:<br>';
  echo '&nbsp;&nbsp;&nbsp;<i>/saldi-e/base/page_LayoutModuler.php?sprog=en</i> - Vælger engelsk sprog';
  echo '<br>I tabel for Sprog oversættelse er aktuelt indlæst '.count($languageTable).' fraser.'; echo '<br>';
  echo 'Er der prefix: @ på en dansk tekst, når du har valgt andet sprog, er det fordi der ikke findes en oversættelse endnu. <br>';
  echo '<br>Benytter du trykfølsom skærm uden mus, skal du benytte Chrome browseren, for at få hjælpetekster:'; echo '<br>';
  echo '"Hvil" fingeren eller musen over den blå tekst med skygge, så popper hjælpetekster op.';  echo '<br>';
  echo 'Der er stadig "skønhedsfejl" i forskellige browseres visning. </div>';
  htm_RudeBund($pmpt='@Gem',$revi=false,$title='@Gem');
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
  echo '<bluelabl>/saldi-e/base/page_LayoutModuler.php?sprog=en</bluelabl> - Vælger engelsk<br>';
  echo '<bluelabl>/saldi-e/base/page_LayoutModuler.php?sprog=de</bluelabl> - Vælger tysk<br>';
  echo '<bluelabl>/saldi-e/base/page_LayoutModuler.php?sprog=fr</bluelabl> - Vælger fransk<br>';
  echo 'Og de andre:&nbsp;<bluelabl>/saldi-e/base/page_LayoutModuler.php?sprog=es =tr =da</bluelabl> - Vælger spansk/tyrkisk/dansk';
  echo '<br><br><b>Afprøv HTML5 og andre forbedringer.</b><br><br>';
  echo 'Inddatering af datoer i chrome, opera, vivaldi (m.fl.?) : Browseren tilbyder date-picker.<br><br>';
  echo 'Validering af data i input-felter : mail-adresse, password, required, m.fl.<br><br>';
  echo 'Prøv at vælge et password for administrator (Database setup), og se password styrke måleren.</div><br>';
  # /da:Sprog/en:Language/de:Sprache/fr:Langue/tr:Dil/es:Lenguaje
htm_RudeBund($pmpt='@Gem',$revi=false,$title='@Gem');
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
  htm_RudeBund($pmpt='@Gem',$revi=false,$title='@Gem');
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
  htm_RudeBund($pmpt='@Gem',$revi=false,$title='@Gem');
}

# SUB-FUNCTION:
function NaviTip () {### NavigationsTip:
  echo '<tc><divline style="margin-left:0.5em"><small><b>'.tolk('@TIP:').'</b> <bluelabl>'.tolk('@Tab-tast').'</bluelabl> '.
    tolk('@springer til næste felt.').' <bluelabl>'.tolk('@SHIFT Tab-tast').'</bluelabl> '.tolk('@springer til forrige felt.').
    '  <bluelabl>'.tolk('@CTRL Pil-taster').'</bluelabl> '.tolk('@virker også. ').'</small></divline></tc><br>';
}

function Rude_Blindgyde() {
  msg_Dialog('tip',tolk('@Retur'),'JavaScript:window.history.back();','','','','',tolk('@Du er havnet i en blindgyde'),
            tolk('@Linket du benyttede er midlertidigt, fordi det rigtige ikke er færdigudviklet.'));
//  htm_Rude_Top($name= 'blind',$capt= '@Blindgyde!',$parms='',$icon='fa-info','panelW320',__FUNCTION__);
//  echo '<div style="text-align:center;"><small><big>Du er havnet i en blindgyde:</big><br><br>';
//  echo 'Linket du benyttede er midlertidigt, <br>';
//  echo 'fordi det rigtige ikke er færdigudviklet.<br>';   //  echo 'Gå tilbage ved at benytte browserens tilbageknap. <br><br>';
//  echo  textKnap($label='@Retur', $title='@Gå tilbage til hvor du kom fra.',$link='JavaScript:window.history.back();');
//  echo '</small></div>';
//  htm_RudeBund($pmpt='@Gem',$revi=false,$title='@Gem');
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
  foreach ($r as $rec) {$result= array_merge($result, array([$rec,$rec,'@'.$rec]));}
  # print_r($result);
  return $result;
}

# SUB-FUNCTION:
function forskydning () {
  htm_FrstFelt('30%');  echo '<div style= "text-align:right">'.tolk('@Forskydning af alle placeringer:').'</div>';
  htm_NextFelt('12%');  htm_CombFelt($type='numberL',  $name='xSkyd',  $valu= 0, $titl='@Vandret forskydning: Angiv positivt tal for at øge, negativt tal for at mindske alle x-placeringer',  $labl='@X-forskydning', $revi=true, $rows='', $width='45');
  htm_NextFelt('12%');  htm_CombFelt($type='numberL',  $name='ySkyd',  $valu= 0, $titl='@Lodret forskydning: Angiv positivt tal for at øge, negativt tal for at mindske alle y-placeringer', $labl='@Y-forskydning', $revi=true, $rows='', $width='45');
  htm_NextFelt('46%');  htm_accept('@Forskyd formular','@Flyt hele formularens indhold med de angivne x/y-værdier.');
  htm_LastFelt(); 
}

?>
