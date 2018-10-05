<?php   $DocFil= '../_base/msg_lib.php';   $DocVer='5.0.0';    $DocRev='2018-07-00';   $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Dialog system baseret paa CSS og jquery';
 *             ___   _   _    ___  _         
 *            / __| / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            |___/_/ \_|____|___/|_|  \___)
 *                                           
 *
 * 2016.08.00 ev - EV-soft

 * Popup vindue med en farvekodet baggrund, en Header-titel, en Besked-tekst, og 3 valg-knapper, 
 * som kan skjules efter behov. Vinduet popper op i aktuelt vindue i modal-mode.
 * Der er predefineret disse farve-typer: error, info, warn, tip, success og med tilhørende prefix i headeren.
 * Angives en farvekode i $BgColr-parameteren benyttes denne, og prefix undlades i headeren.
 */

if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'msg_Dialog');

# Test: msg_Dialog('error','Godkend','$(this).dialog("close")','Fortryd','$(this).dialog("close")','','','Funktions problem','Funktionen: dialog("close") virker i test, men når msg_Dialog kaldes inde fra SALDI, sker der intet!');


# TEST: 
//  msg_Dialog ('info', # "error" | "info"  | "warn"  | "tip" | "success"
//           'Godkend','$(this).dialog("close")',
//           'Fortryd',   '$(this).dialog("close")',
//           '3. knap',   '$(this).dialog("close")',
//           'Funktions problem',
//           'Funktionen: dialog("close") virker i test, men når msg_Dialog kaldes inde fra SALDI, sker der intet!'.
//           '<br>Du kan flytte og ændre størrelse på dette besked-vindue. Det tilpasser selv nødvendig højde, og det placeres centralt i vinduet.');

//  msg_Dialog('warn','Fortsæt','$(this).dialog("close")',$Knap2_title='','','','','Saldi Dialog',$messg='');
function msg_Dialog ($BgColr= 'error',  // Problemer med forskellige jquery-versioner, saboterer denne function!!!
  //  msg_Besked() er mere stabil, men vinduet kan ikke flyttes/ændre størrelse.
  
  $Knap1_title= '@Godkend', $Knap1_function='$(this).dialog("close")',
  $Knap2_title= '@Fortryd', $Knap2_function='$(this).dialog("close")',
  $Knap3_title='',          $Knap3_function='$(this).dialog("close")',       
  $title='Saldi Dialog',  $messg='') 
{ //  DOKUMENTATION: http://api.jqueryui.com/dialog/
# Afhængig af indlæsning i HTML Header-section:
# echo '  <link rel="stylesheet" href= "../_assets/js/1.12.0/themes/base/jquery-ui.css" emne="jquery Dialog">';
# echo '    <script src="../_assets/js/1.12.0/external/jquery/jquery.js"></script>  <!--  jquery Dialog -->';   // Nødvendig her, hvis der sker kald, før htm_pageFoot er færdig
# echo '    <script src="../_assets/js/1.12.0/jquery-ui.js"></script>               <!--  jquery Dialog -->';

# INIT: (Change as needed)
  $result= false; # Return værdi kan ændres med programmering.
  if ($messg=='') $messg='<p>Dette er en CSS baseret modal dialog, som kan benyttes til at vise information. '.
      'Vinduet kan flyttes og strækkes, samt lukkes med \'x\' icon. <br>'.
      '<br>Knapperne forneden kan programmeres, med valgfri kode.</p>';
  if (false) $messg.= str_nl(1).'<strong>Jquery er ikke i drift, derfor vises simpel tekst!</strong>';
# CODE: (don't change!)
switch (strtolower($BgColr)) {  # TEMA-farver og Titel-prefix:
    case "error"  : $banncolr= '#FF8888'; $pref= ucfirst(tolk('@Fejl: '));      break;   # color: red
    case "info"   : $banncolr= '#BDE5F8'; $pref= ucfirst(tolk('@Info: '));      break;   # color: blue
    case "warn"   : $banncolr= '#FEEFB3'; $pref= ucfirst(tolk('@Advarsel: '));  break;   # color: orange
    case "tip"    : $banncolr= '#88ff22'; $pref= ucfirst(tolk('@Tip: '));       break;   # color: green
    case "success": $banncolr= '#DFF2BF'; $pref= ucfirst(tolk('@Hurra: '));     break;   # color: light-green
    default:  $banncolr= $BgColr; $pref= ''; 
} 
# Support-filer:
//  echo '  <link rel="stylesheet" href="../_assets/js/1.12.0/themes/base/jquery-ui.css">';
//  echo '  <script src="../_assets/js/1.12.0/external/jquery/jquery.js"></script>';
//  echo '  <script src="../_assets/js/1.12.0/jquery-ui.js"></script>';
# Spec.Style:
  echo '<style type="text/css">';
  echo '  .ui-dialog .ui-dialog-titlebar    { background: '.$banncolr.'}';
  echo '  .ui-dialog .ui-dialog-buttonpane  { background: '.$banncolr.'}';
# Hvis 3 knapper: Forøg bredden fra standard 300px til 360px:
  echo '  .ui-dialog  { width: 320px; margin: auto; position: fixed; top: 20%;  left: 0px; right: 0px; -moz-box-shadow: 0px 0px 8px #000000; -webkit-box-shadow: 0px 0px 8px #000000; box-shadow: 0px 0px 8px #000000;}';
  echo '  ui-button ui-corner-all ui-widget ui-button-icon-only ui-dialog-titlebar-close  {width: 20px; title: "Luk";}';
  echo '  .ui-button  {padding: 2px 8px};}';
/*  
  <div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix">
    <div class="ui-dialog-buttonset">
      <button type="button" class="ui-button ui-corner-all ui-widget">Godkend</button>
      <button type="button" class="ui-button ui-corner-all ui-widget">Fortryd</button>
      <button type="button" class="ui-button ui-corner-all ui-widget">3. knap</button>
  </div></div>
 */ 
  echo '</style>';
# Func-script:
//  echo ' $("#foo").dialog({   width: "'.$WinW.'",    height: "'.$WinH.'",';
//  echo '    buttons: { '.$Knap1_title.': function(){ '.$Knap1_function.'; }, '.$Knap2_title.': function(){ '.$Knap2_function.'; } }';
//  echo '});';

  echo '  <script>';    //   $( function() {  $( "#dialog-message" ).dialog ({ modal: true, buttons: {"OK": function(){ $(this).dialog("close"); } } }); }); 
//  echo '  $( function() {  $( "#dialog-message" ).dialog ({';
    echo '  $( document ).ready( function() {  $( "#dialog-message" ).dialog ({'; //position: "right top",';  // Her er problemer med placering af dialog-vinduet, når Window er meget højt!
    echo '  position: "fixed", top: "320px",';
    echo '  modal: true,';
    echo '  buttons: {';    // Space tillades ikke i titel!
    if ($Knap1_title) echo  '"'.  str_replace(' ','...',tolk($Knap1_title)).'": function(){ '.$Knap1_function.'; }';  # Primær knap!
    if ($Knap2_title) echo ',"'.  str_replace(' ','_',  tolk($Knap2_title)).'": function(){ '.$Knap2_function.'; }';  # Kun som 2. knap
    if ($Knap3_title) echo ',"'.  str_replace(' ','_',  tolk($Knap3_title)).'": function(){ '.$Knap3_function.'; }';  # Kun som 2. ell. 3. knap
    echo '  }';
  echo '      }); });';
# echo '  $( ".selector" ).dialog({  position: { my: "left top", at: "center", of: window }});';
# echo '  $("#dialog-modal").dialog({ height: 330, modal: true, position: {my: "center", at: "center", of: "window"} });';
# echo '  $("#dialog").dialog({position: "top"});';
# echo '  dialog("option","position","center").dialog("widget").css("top","125px"); '; 
  echo '  </script>';
  echo '<div id="dialog-message" title="'.$pref.$title.'"> '.$messg.' </div>';  #  style=" position: fixed; top: 320px; "
  return $result;
}

//  $goon= tolk('$Fortsæt');   $close= tolk('@Luk');
## Almindelige af-arter med kun 1 fortsæt-knap, samt "luk":
function msg_Error($title='Fejl',     $messg='Besked') {
//  msg_Dialog('error',   tolk('@Fortsæt'),'$(this).dialog("close")','','','','',ucfirst(tolk($title)),ucfirst(tolk($messg)));  
  msg_Besked($MsgType= 'error', $title,  $reason='', $messg, $actions=['','goon','close']);
}
function msg_Info($title='Info',      $messg='Besked') {
  msg_Dialog('info',    tolk('@Fortsæt'),'$(this).dialog("close")','','','','',ucfirst(tolk($title)),ucfirst(tolk($messg)));  
}
function msg_Warn($title='Advarsel',  $messg='Besked') {
//  msg_Dialog('warn',    tolk('@Fortsæt'),'$(this).dialog("close")','','','','',ucfirst(tolk($title)),ucfirst(tolk($messg)));  
  $str= '<br>'.  tolk($messg);
  msg_Besked($MsgType= 'warn', $title,  $reason=' ', $messg=$str, $actions=['','goback','close']);
}
function msg_Tip($title='Tip',        $messg='Besked') {
//  msg_Dialog('tip',     tolk('@Fortsæt'),'$(this).dialog("close")','','','','',ucfirst(tolk($title)),ucfirst(tolk($messg)));  
  msg_Besked($MsgType= 'tip', $title,  $reason=$title, $messg, $actions=['','','close']);
}
function msg_Succ($title='Hurra',     $messg='Besked') {
  //  msg_Dialog('success', tolk('@Fortsæt'),'$(this).dialog("close")','','','','',ucfirst(tolk($title)),ucfirst(tolk($messg)));  
  msg_Besked($MsgType= 'success', $title='',  $reason='', $messg, $actions=['','','close']);
}



// Afhængig af: msg_lib.css.php   -   Afløser for msg_Dialog()
function msg_Besked($MsgType= 'error', $title='',  $reason='', $messg='', $actions=['goback','goon','close'], $wdh='600px', $hgt='150px') {
## INIT: (Change as needed)
    $result= false; # Return værdi kan ændres med programmering.
    $title=  ucfirst(tolk($title));
    $reason= ucfirst(tolk($reason));
    $messg=  ucfirst(tolk($messg));
    if ($title=='')   $title= 'SALDI-<small>€</small> - ';
    if ($reason=='')  $reason='<p>Info om systemet.</p>';
    if ($messg=='')   $messg='<p>Dette er en CSS baseret modal dialog uafhængig af jquery, som kan benyttes til at vise information. '.'<br>'.
        'Vinduet kan lukkes med \'x\' icon, eller ved at klikke et vilkårligt sted uden for vinduet. <br>'.
        '<br>Knapperne i footeren kan programmeres, med valgfri kode.</p>';
## CODE: (don't change!)
  switch (strtolower($MsgType)) {  # TEMA-farver og Titel-prefix:
      case "error"  : $banncolr= '#FF8888';    # color: red
                      $pref= ucfirst(tolk('@Fejl: '));     
                      $Capt1= '<div style="font-weight:600;">'.tolk('@Kilde-spor').':</div>';
                      $Capt2= '<div style="font-weight:600;">'.tolk('@Forklaring').':</div>'; 
                      break;
      case "info"   : $banncolr= '#BDE5F8';    # color: blue
                      $pref= ucfirst(tolk('@Info: '));                  
                      break;
      case "warn"   : $banncolr= '#FEEFB3';    # color: orange
                      $pref= ' '.ucfirst(tolk('@Advarsel: '));
                      $Capt1= '<div style="font-weight:600;">'.tolk('@Hov').':</div>'; 
                      break;
      case "tip"    : $banncolr= '#88ff22';    # color: green
                      $pref= ucfirst(tolk('@Tip: '));   
                      $title='';                      
                      break;
      case "success": $banncolr= '#DFF2BF';    # color: light-green
                      $pref= ucfirst(tolk('@Hurra: '));                 
                      break;
      default:  $banncolr= $MsgType; $pref= ''; //  Custom color og uden prefix
  } 
  echo '<label class="button demo-button" for="open-modal"> </label>';  // The way to toggle the modal is to check the hidden checkbox with the ID #open-modal "Open The Modal"
  echo '<div class="modal__container">';
  echo '  <input type="checkbox" id="open-modal" class="modal__toggler" checked />';  //echo '  <!-- Here is the hidden checkbox element which makes toggling the modal work -->
  echo '  <label class="modal__mask" for="open-modal"></label>';               //echo '  <!-- Here is the background mask. When clicked, it closes the modal. Change this to a div to disable that functionality. -->
  echo '  <div class="modal" style="width: '.$wdh.';  ">';  //  height: '.$hgt.';
  echo '    <label class="modal__close" for="open-modal"></label>';
  echo '    <div class="modal__header" style="background-color: '.$banncolr.';">';
  echo '      <h3 style="margin:8px;">'.$title.$pref.'</h3>';
  echo '    </div>';
  echo '    <section class="modlwrap">';
  if ($reason>' ')  echo '<div class="modal__content" style="width:33%; background:lightcyan;  ">'.$Capt1.$reason.'<br><br></div>';
  echo '      <div class="modal__content" style="width:67%; background:lightyellow;">'.$Capt2.$messg.'<br><br></div>';
  echo '    </section> ';
  echo '    <div class="modal__footer" style="background-color: '.$banncolr.';">';
  if (in_array('goback',$actions)) echo '<label class="modlButt" for="open-modal" title="'.tolk('@Luk vinduet og vend tilbage til forrige visning').'">'.tolk('@Fortryd').' </label>';
  if (in_array('goon',  $actions)) echo '<label class="modlButt" for="open-modal" title="'.tolk('@Luk besked-vinduet og fortsæt').'">'.tolk('@Fortsæt').' </label>';
  if (in_array('accept',$actions)) echo '<label class="modlButt" for="open-modal" title="'.tolk('@Bekræft og fortsæt').'">'.tolk('@Godkend').' </label>';
  if (in_array('close', $actions)) echo '<label class="modlButt" for="open-modal" title="'.tolk('@Luk vinduet!').'">'.tolk('@Luk')    .' </label>';
//  echo '      <script> ';
//  echo '        function goBack() { window.history.back() } ';
//  echo '        function winclose() { open(location, "_self").close() } ';
//  echo '      </script>';
//  echo '      <button type="button" style="border-radius: 5px; height:20px;" onclick="goBack()">Fortryd</button> ';
//  echo '      <button type="button" style="border-radius: 5px; height:20px;" disabled> Godkend </button> ';
//  echo '      <button type="button" style="border-radius: 5px; height:20px;" onclick="winclose()"> OK </button> ';
  echo '    </div>';
  echo '  </div>';
  echo '</div>';
  return $result;
}
?>
