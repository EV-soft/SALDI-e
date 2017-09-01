<?php $DocFil= '../_base/htm_pageHead.php';   $DocVer='5.0.0';    $DocRev='2017-08-00';   $modulnr=0;
  $ØProgRoot= $_SERVER['DOCUMENT_ROOT']."/saldi-e/";
  $ØProgRoot= "../";  $_base= '_base/';    $_config= '_config/';    $_assets= '_assets/';   $_system= '_system/';
//  set_include_path(get_include_path().    PATH_SEPARATOR. '/saldi-e'.          PATH_SEPARATOR. '/saldi-e/_config'. 
//  PATH_SEPARATOR. '/saldi-e/_base'.       PATH_SEPARATOR. '/saldi-e/_assets'.  PATH_SEPARATOR. '/saldi-e/_assets/js'.  
//  PATH_SEPARATOR. '/saldi-e/_system'.     PATH_SEPARATOR. '/saldi-e/_assets/font-awesome'.
//  PATH_SEPARATOR. '/saldi-e/_base/_admin');   //  Dette virker ikke altid!
  
//  echo ' DIR: '.__DIR__."<br/>";  echo 'FILE: '.__FILE__."<br/>";  echo 'BASE: '.__BASE__ ."<br/>";  echo 'NAME: '.dirname("saldi-e")."<br/>";  echo "Include_Path: ".get_include_path()."<br>";
  
  session_start();                                    #+  Nødvendig for bevarelse af globale værdier
  include_once $ØProgRoot.$_base."out_init.php";      #+  Nødvendig global initiering
/* ## Formål: Denne fil klargør en side med initiering af php-filer og indledende HTML-kode.
 * Denne fil er oprettet af EV-soft  i 2017.
 *             ___   _   _    ___  _         
 *            / __| / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            |___/_/ \_|____|___/|_|  \___)
 *                                           
 * ## LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 */
  if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'htm_pageHead');
# include_once $ØProgRoot.$_base."out_init.php";      #+  Nødvendig global initiering - indlæses i tidligere linie !
  include_once $ØProgRoot.$_base."out_base.php";      #+  Grundmoduler, nødvendige for rude-systemet!                                                    
  include_once $ØProgRoot.$_base."out_ruder.php";     #0  Konstruktion af samtlige ruder. Kan overspringes, hvis page_* indeholder en kopi af det nødvendige.
#-include_once $ØProgRoot.$_base."out_vinduer.php";   #-  Eksempelsamling: kombination af ruder.                                                       
  include_once $ØProgRoot.$_base."msg_lib.php";       #+  Nødvendigt dialog-system                                                                       
  include_once $ØProgRoot.$_base."std_func.php";      #+  Standard blandede funktioner                                                                            
  include_once $ØProgRoot.$_base."fil_func.php";      #+  Funktioner med filer involveret                                                                
  include_once $ØProgRoot.$_base."dbi_func.php";      #+  Forbedrede DataBase-funktioner, kompatible med PHP7                                            
  include_once $ØProgRoot.$_base."version.php";       #+  Initiering af globale konstanter                                          
 // include_once $ØProgRoot.$_config."connect.php";   #+  Database tilkobling
//  Andre individuelle:                               #?  Indlæses efter behov i aktuel page_*
  
//  global $pageTitl, $ØsprogTabl, $ØprogSprog, $ØPageImage, $ØPageLogo, $Ødebug, $ØRollTabl, $Øtema;
  $ØprogSprog= $_SESSION['ØprogSprog'];# Sprog i programfladen
  $ØsprogCol= $_SESSION['ØsprogCol']; # Benyttes i Rude_LanguageJuster
  $ØsprogRow= $_SESSION['ØsprogRow']; # Benyttes i Rude_LanguageJuster
  $Ønovice  = $_SESSION['Ønovice'  ]; # Udvid visning af brugertip
  $ØFullFilt= $_SESSION['ØFullFilt']; # Vis hjælpetekster til filter-funktionalitet
  $ØTastkeys= $_SESSION['ØTastkeys']; # Vis Tast-genveje på navigationstaster
  $ØRollTabl= $_SESSION['ØRollTabl']; # Sæt $ViewHeight= '99999px medfører "printlayoyt" af tabeller
  $ØRollTabl= true;
  $Øtema    = $_SESSION['Øtema'];
  
// Debug-indstilling:
// $Ødebug= true;   $GLOBALS["Ødebug"]= true;   //  debug kan også aktiveres midlertidigt ved tilføjelse af: ?debug=true i adressefeltet
$Ødebug= false;
# $Ønovice= false;  $_SESSION['Ønovice']= $Ønovice;

// JavaScript benyttes til:
// PopUp-dialog, Tabel-sortering, (Date-picker), PassWord-styrke måler, ToolTip-visning

  ### Side-start:
  echo '<!DOCTYPE html>';
  echo '<html lang="da" dir="ltr">';
  echo "\n<head>";
  echo '  <meta charset="UTF-8">';
  echo '  <title>'.$pageTitl.'</title>';
  echo '  <link rel="icon" type="image/png" sizes="32x32" href="'.$ØProgRoot.$_assets.'images/favicon-32x32.png">';
  echo '  <link rel="stylesheet" href= "'.$ØProgRoot.$_assets.'font-awesome/css/font-awesome.min.css">';    //   emne= "ICON-system"
  echo '  <link rel="stylesheet" href= "'.$ØProgRoot.$_assets.'js/1.12.0/themes/base/jquery-ui.css">';      //   emne="jquery Dialog"
  echo '  <script src= "'.$ØProgRoot.$_assets.'js/sorttable.js"></script>';  //  Sortering af tabeller
  
 if ($JSfails=true) {
  echo '  <script src= "'.$ØProgRoot.$_assets.'js/1.12.0/external/jquery/jquery.js"></script>  <!--  jquery Dialog -->';   // Nødvendig her, hvis der sker kald, før htm_pageFoot er færdig
}
//  else   echo '  <script src= "'.$ØProgRoot.$_assets.'js/1.12.4/jquery-1.12.4.js"></script>  <!--  jquery Dialog -->'; 
dvl_ekko('htm_pageHead  1 ');
  echo '  <script src= "'.$ØProgRoot.$_assets.'js/1.12.0/jquery-ui.js"></script>               <!--  jquery Dialog -->';
  echo '  <script src= "'.$ØProgRoot.$_assets.'js/jquery.ui.position.min.js"></script>';
// Pga. konflikter med andre jQuery-moduler dette: (se her: https://learn.jquery.com/using-jquery-core/avoid-conflicts-other-libraries/)
    echo '  <script> var $jQ112 = jQuery.noConflict();';                      // $jQ112 is now an alias to the jQuery 1.12.0 function; creating the new alias is optional. 
//+? FEJL!   echo '  $jQ112(document).ready(function() { $jQ112( "div" ).hide();}); '; // The $ variable now has the prototype meaning, which is a shortcut for document.getElementById().
    echo '  $jQ112(window).resize(function(){   $jQ112(".ui-dialog-content").dialog("option","position","center");});';
    echo '  window.onload = function() { var mainDiv = $( "main" );} ';       //  mainDiv is a DOM element, not a jQuery object.
    echo '  </script>';
   
  echo '  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">';
  echo '  <link rel="stylesheet" href="//jqueryui.com/jquery-wp-content/themes/jqueryui.com/style.css">';
  echo '  <script src="https://code.jquery.com/jquery-1.12.4.js">           </script>';
  echo '  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js">     </script>';
  echo '  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/i18n/jquery-ui-i18n.min.js"></script>   <!-- Forberedelse for datepicker med regionale tekster -->';
  echo '  <script>  $( function() { $( "#datepicker" ).datepicker({ showWeek: true, firstDay: 1 }); } )';
//  <!-- Vis Uge-nr http://api.jqueryui.com/datepicker/#option-showWeek -->';
  echo '            $.datepicker.setDefaults( $.datepicker.regional[ "da" ] );';   // <!-- Benyt danske tekster -->
  echo '  </script>';
  
dvl_ekko('htm_pageHead  2 ');

//<!-- PowerTip ToolTip: -->
echo '  	<script type="text/javascript" src="'.$ØProgRoot.$_assets.'js/PowerTip/jquery.powertip.js"></script>';
echo '  	<link rel="stylesheet" type="text/css" href="'.$ØProgRoot.$_assets.'js/PowerTip/css/jquery.powertip-white.css" />   ';
//<!-- POWERTIP: -->
echo '<script type="text/javascript">';
echo '	$(function() {';	// placement examples:
echo '		$(".north").powerTip({ placement: "n" });';
echo '		$(".east" ).powerTip({ placement: "e" });';
echo '		$(".south").powerTip({ placement: "s" });';
echo '		$(".west" ).powerTip({ placement: "w" });';
echo '		$(".north-west").powerTip({ placement: "nw" });';
echo '		$(".north-east").powerTip({ placement: "ne" });';
echo '		$(".south-west").powerTip({ placement: "sw" });';
echo '		$(".south-east").powerTip({ placement: "se" });';
echo '		$(".north-west-alt").powerTip({ placement: "nw-alt" });';
echo '		$(".north-east-alt").powerTip({ placement: "ne-alt" });';
echo '		$(".south-west-alt").powerTip({ placement: "sw-alt" });';
echo '		$(".south-east-alt").powerTip({ placement: "se-alt" });';
echo '	});';
echo '</script>';
echo '<style>';
echo '  #powerTip {color:#000; font: 14px/18px Arial, Sans-serif;}';
echo '</style>';
  
//<!-- /POWERTIP -->

dvl_ekko('htm_pageHead  3 ');
  
#  echo '  <link rel="icon" type="image/png" sizes="32x32" href="'.$ØProgRoot.$_assets.'images/favicon-32x32.png">';
#  echo '  <link rel="stylesheet" href= "'.$ØProgRoot.$_assets.'font-awesome/css/font-awesome.min.css" emne= "ICON-system">';
#  echo '  <link rel="stylesheet" href= "'.$ØProgRoot.$_assets.'js/1.12.0/themes/base/jquery-ui.css" emne="jquery Dialog">';
//  echo '  <link rel="stylesheet" href= "'.$ØProgRoot.$_assets.'js/1.12.1/themes/smoothness/jquery-ui.css" emne="jquery Dialog">';
  //echo '  <script src="'.$ØProgRoot.$_assets.'js/1.12.4/jquery-1.12.4.js" emne="jquery DatePicker"></script>';
//  echo '  <script src="'.$ØProgRoot.$_assets.'js/1.12.1/external/jquery/jquery.js" emne="jquery Dialog"></script>';   // Nødvendig her, hvis der sker kald, før htm_pageFoot er færdig
//  echo '  <script src="'.$ØProgRoot.$_assets.'js/1.12.1/jquery-ui.js" emne="jquery Dialog"></script>';
# echo '  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">';
# echo '  <script src="//code.jquery.com/jquery-1.12.4.js"></script>'; 
# echo '  <script src="//code.jquery.com/jquery-1.12.4.js"></script>';
# echo '  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>';
# echo '  <script src="'.$ØProgRoot.$_assets.'js/jquery.ui.position.min.js"></script>';
  
  // Datepicker eksempel:
#  echo '<link   rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">';
## echo '<link   rel="stylesheet" href="/resources/demos/style.css">';
#  echo '<script src="https://code.jquery.com/jquery-1.12.4.js"></script>';
#  echo '<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>';
# echo '<script> $(function() {$("#datepicker").datepicker(); $("#format").on("change", function() {$("#datepicker").datepicker("option", "dateFormat", $(this).val()); }); } );  </script>';
# echo '<script> $(function() {$("#datepicker").datepicker();});</script>';
 
// Pga. konflikter med andre jQuery-moduler dette: (se her: https://learn.jquery.com/using-jquery-core/avoid-conflicts-other-libraries/)
#  echo '  <script> var $jQ112 = jQuery.noConflict();';                      // $jQ112 is now an alias to the jQuery 1.12.0 function; creating the new alias is optional. 
# echo '  $jQ112(document).ready(function() { $jQ112( "div" ).hide();}); '; // The $ variable now has the prototype meaning, which is a shortcut for document.getElementById().
#  echo '  $jQ112(window).resize(function(){   $jQ112(".ui-dialog-content").dialog("option","position","center");});';
#  echo '  window.onload = function() { var mainDiv = $( "main" );} ';       //  mainDiv is a DOM element, not a jQuery object.
#  echo '  </script>';
  echo '  <link rel="stylesheet" href= "'.$ØProgRoot.$_assets.'css/meter-style.css" emne="PassWord-styrke måler">'; 
  echo '  <link rel="stylesheet" href= "'.$ØProgRoot.$_base.'out_style.css.php"     emne="out_modulers style">'; /* _base/ */
  if ($pageTitl!= 'Hovedmenu')  
    { include $ØProgRoot.$_base.'htm_TopMenu-head.css.htm';} # TopMenu-CSS  /* _base/ */
  include 'piwik.php';
 /*  $body = $("body");
  $(document).on({ ajaxStart: function() { $body.addClass("loading"); }, ajaxStop: function() { $body.removeClass("loading"); } });
  */ 
  echo '<style type="text/css">'. ' body { background: url('.$ØPageLogo.') right bottom no-repeat, url('.$ØPageImage.') left top repeat; font-family: sans-serif;}'. '</style>';
  
#  echo '<script>  $( function() { $( "#datepicker" ).datepicker(); } );  </script>';
#  echo '<script>$( "#datepicker" ).datepicker();</script>';
  
  echo "\n</head>";
  echo "\n<body>\n";
  if ($ØsprogTabl==NULL) sprogDB_import();
### Benyt URL-parameter variabler: (ØprogSprog har højere prioritet, end brugervalg!)
  $str= $_GET['sprog'];   if ($str) $ØprogSprog= $str; 
  $str= $_GET['debug'];   if ($str) $Ødebug= $str;

#  <div class="modal"></div>
#  $(window).load(function() {   // Animate loader off screen
#  $(".modal").fadeOut("slow");; });
/*   echo '<div id="msg" style="font-size:largest;"><!-- you can set whatever style you want on this -->Indlæser data, Hæng på...</div>';
  echo '<div id="body" style="display:none;"><!-- everything else --></div>';
  echo '<script type="text/javascript">$(document).ready(function() {    $('#body').show();    $('#msg').hide();});</script>';
 */
  
  if (($pageTitl!= 'Hovedmenu')  and ($loggetind=true))
    {Menu_Topdropdown(); htm_nl(2); }  /* include $ØProgRoot."_base/htm_TopMenu-body.htm"; Erstattet af rutiner i out_base.php*/ 
  // Her placeres sidens indhold
  
  // Til slut skal indlæses: include $ØProgRoot."/* _base/ */htm_pageFoot.php";
?>