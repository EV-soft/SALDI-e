<?php $DocFil= '../_base/htm_pageHead.php';   $DocVer='5.0.0';    $DocRev='2017-03-00';   $modulnr=0;
  $ØProgRoot= $_SERVER['DOCUMENT_ROOT']."/saldi-e/";
  $ØProgRoot= "../";
  $_base= '_base/';    $_config= '_config/';    $_assets= '_assets/';   $_system= '_system/';
//  set_include_path(get_include_path().    PATH_SEPARATOR. '/saldi-e'.          PATH_SEPARATOR. '/saldi-e/_config'. 
//  PATH_SEPARATOR. '/saldi-e/_base'.       PATH_SEPARATOR. '/saldi-e/_assets'.  PATH_SEPARATOR. '/saldi-e/_assets/js'.  
//  PATH_SEPARATOR. '/saldi-e/_system'.     PATH_SEPARATOR. '/saldi-e/_assets/font-awesome'.
//  PATH_SEPARATOR. '/saldi-e/_base/_admin');
  
//  echo ' DIR: '.__DIR__."<br/>";  echo 'FILE: '.__FILE__."<br/>";  echo 'BASE: '.__BASE__ ."<br/>";  echo 'NAME: '.dirname("saldi-e")."<br/>";  echo "Include_Path: ".get_include_path()."<br>";
  
  include_once($ØProgRoot.$_base."out_init.php");      #+  Nødvendig global initiering
/* ## Formål: Denne fil klargør en side med initiering af php-filer og indledende HTML-kode.
 *             ___   _   _    ___  _         
 *            / __| / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            |___/_/ \_|____|___/|_|  \___)
 *                                           
 * ## LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 */
  if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'htm_pageHead');
  session_start();                                     #+  Nødvendig for bevarelse af globale værdier
# include_once($ØProgRoot.$_base."out_init.php");      #+  Nødvendig global initiering - indlæses i linie 15 !
  include_once($ØProgRoot.$_base."out_base.php");      #+  Grundmoduler, nødvendige for rude-systemet!                                                    
  include_once($ØProgRoot.$_base."out_ruder.php");     #0  Konstruktion af samtlige ruder. Kan undlades, hvis page_* indeholder en kopi af det nødvendige.
#-include_once($ØProgRoot.$_base."out_vinduer.php");   #-  Eksempelsamling på kombination af ruder.                                                       
  include_once($ØProgRoot.$_base."msg_lib.php");       #+  Nødvendigt dialog-system                                                                       
  include_once($ØProgRoot.$_base."std_func.php");      #+  Standard funktioner                                                                            
  include_once($ØProgRoot.$_base."fil_func.php");      #+  Funktioner med filer involveret                                                                
  include_once($ØProgRoot.$_base."dbi_func.php");      #+  Forbedrede DataBase-funktioner, kompatible med PHP7                                            
  include_once($ØProgRoot.$_base."version.php");       #+  Initiering af globale konstanter                                          
 // include_once($ØProgRoot.$_config."connect.php");   #+  Database tilkobling
//  Andre    F.eks:                                    #?  Indlæses efter behov i aktuel page_*
  
//  global $pageTitl, $ØsprogTabl, $ØprogramSprog, $ØPageImage, $ØPageLogo, $Ødebug, $ØRollTabl;
  $ØprogramSprog= $_SESSION['ØprogramSprog'];
  $ØsprogCol= $_SESSION['ØsprogCol'];
  $ØsprogRow= $_SESSION['ØsprogRow'];
  $Ønovice=   $_SESSION['Ønovice'];
  $ØFullFilt= $_SESSION['ØFullFilt'];
  $ØTastkeys= $_SESSION['ØTastkeys'];
// Debug-indstilling:
// $Ødebug= true;   $GLOBALS["Ødebug"]= true;
# $Ønovice= false;  $_SESSION['Ønovice']= $Ønovice;

  ### Side-start:
  echo '<!DOCTYPE html>';
  echo '<html lang="da" dir="ltr">';
  echo "\n<head>";
  echo '  <meta charset="UTF-8">';
  echo '  <title>'.$pageTitl.'</title>';
  echo '  <link rel="icon" type="image/png" sizes="32x32" href="'.$ØProgRoot.$_assets.'images/favicon-32x32.png">';
# echo '  <link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" emne= "ICON-system">';
  echo '  <link rel="stylesheet" href= "'.$ØProgRoot.$_assets.'font-awesome/css/font-awesome.min.css" emne= "ICON-system">';
  echo '  <link rel="stylesheet" href= "'.$ØProgRoot.$_assets.'js/1.12.0/themes/base/jquery-ui.css" emne="jquery Dialog">';
  echo '  <script src="'.$ØProgRoot.$_assets.'js/1.12.0/external/jquery/jquery.js"></script>  <!--  jquery Dialog -->';   // Nødvendig her, hvis der sker kald, før htm_pageFoot er færdig
  echo '  <script src="'.$ØProgRoot.$_assets.'js/1.12.0/jquery-ui.js"></script>               <!--  jquery Dialog -->';
# echo '  <script src="'.$ØProgRoot.$_assets.'js/jquery.ui.position.min.js"></script>';
// Pga. konflikter med andre jQuery-moduler dette: (se her: https://learn.jquery.com/using-jquery-core/avoid-conflicts-other-libraries/)
  echo '  <script> var $jQ112 = jQuery.noConflict();';                      // $jQ112 is now an alias to the jQuery 1.12.0 function; creating the new alias is optional. 
# echo '  $jQ112(document).ready(function() { $jQ112( "div" ).hide();}); '; // The $ variable now has the prototype meaning, which is a shortcut for document.getElementById().
  echo '  $jQ112(window).resize(function(){   $jQ112(".ui-dialog-content").dialog("option","position","center");});';
  echo '  window.onload = function() { var mainDiv = $( "main" );} ';       //  mainDiv is a DOM element, not a jQuery object.
  echo '  </script>';
  echo '  <link rel="stylesheet" href= "'.$ØProgRoot.$_assets.'css/meter-style.css" emne="PassWord-styrke måler">'; 
  echo '  <link rel="stylesheet" href= "'.$ØProgRoot.$_base.'out_style.css.php"     emne="out_modulers style">'; /* _base/ */
  if ($pageTitl!= 'Hovedmenu')  { include($ØProgRoot.$_base.'htm_TopMenu-head.htm');} # TopMenu-CSS  /* _base/ */
  include("piwik.php");
 /*  $body = $("body");
  $(document).on({ ajaxStart: function() { $body.addClass("loading"); }, ajaxStop: function() { $body.removeClass("loading"); } });
  */ 
  echo '<style type="text/css">'. ' body { background: url('.$ØPageLogo.') right bottom no-repeat, url('.$ØPageImage.') left top repeat;}'. '</style>';
  echo "\n</head>";
  echo "\n<body>\n";
  if ($ØsprogTabl==NULL) sprogDB_import();
### Benyt URL-parameter variabler: (ØprogramSprog har højere prioritet, en brugervalg!)
  $str= $_GET['sprog'];   if ($str) $ØprogramSprog= $str;
  $str= $_GET['debug'];   if ($str) $Ødebug= $str;

#  <div class="modal"></div>
#  $(window).load(function() {   // Animate loader off screen
#  $(".modal").fadeOut("slow");; });
/*   echo '<div id="msg" style="font-size:largest;"><!-- you can set whatever style you want on this -->Indlæser data, Hæng på...</div>';
  echo '<div id="body" style="display:none;"><!-- everything else --></div>';
  echo '<script type="text/javascript">$(document).ready(function() {    $('#body').show();    $('#msg').hide();});</script>';
 */
  if ($pageTitl!='Hovedmenu') {Menu_Topdropdown(); echo htm_nl(2); }  /* include($ØProgRoot."_base/htm_TopMenu-body.htm"); Erstattet af rutiner i out_base.php*/ 
  // Her placeres sidens indhold
  
  // Til slut skal indlæses: include($ØProgRoot."/* _base/ */htm_pageFoot.php");
?>