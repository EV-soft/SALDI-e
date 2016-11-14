<?php include("../_base/base_init.php");
  $DocFil= '../_base/htm_pageHead.php';   $DocVer='5.0.0';    $DocRev='2016-08-00';   $modulnr=0;
//  Denne fil klargør en side med initiering af php-filer og indledende HTML-kode.
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'');
  include_once("../includes/out_base.php");
  include_once("../includes/out_ruder.php");
  include_once("../includes/out_vinduer.php");
  include_once("../includes/std_func.php");
  include_once("../includes/fil_func.php");
  include_once("../includes/db_func.php");
  include_once("../includes/msg_lib.php");
  global $pageTitl;
  # Side-start:
  echo '<!DOCTYPE html>';
  echo '<html lang="da" dir="ltr">';
  echo '<head>';
  echo '  <meta charset="UTF-8">';
  echo '  <title>'.$pageTitl.'</title>';
  echo '  <link rel="icon" type="image/png" sizes="32x32" href="../favicon-32x32.png">';
  echo '  <link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" emne= "ICON-system">';
  echo '  <link rel="stylesheet" href= "../js/1.12.0/themes/base/jquery-ui.css" emne="jquery Dialog">';
  echo '  <script src="../js/1.12.0/external/jquery/jquery.js"></script>  <!--  jquery Dialog -->';   // Nødvendig her, hvis der sker kald, før htm_pageFoot er færdig
  echo '  <script src="../js/1.12.0/jquery-ui.js"></script>               <!--  jquery Dialog -->';
# echo '  <script src="../js/jquery.ui.position.min.js"></script>';
// Pga. konflikter med andre jQuery-moduler dette: (se her: https://learn.jquery.com/using-jquery-core/avoid-conflicts-other-libraries/)
  echo '  <script> var $jQ112 = jQuery.noConflict();';                      // $jQ112 is now an alias to the jQuery 1.12.0 function; creating the new alias is optional. 
# echo '  $jQ112(document).ready(function() { $jQ112( "div" ).hide();}); '; // The $ variable now has the prototype meaning, which is a shortcut for document.getElementById().
  echo '  $jQ112(window).resize(function(){   $jQ112(".ui-dialog-content").dialog("option","position","center");});';
  echo '  window.onload = function() { var mainDiv = $( "main" );} ';       //  mainDiv is a DOM element, not a jQuery object.
  echo '  </script>';
  echo '  <link rel="stylesheet" href= "../css/meter-style.css"   emne="PassWord-styrke måler">'; 
  echo '  <link rel="stylesheet" href= "../css/out_style.css.php" emne="out-style">';
  include("piwik.php");
 /*  $body = $("body");
  $(document).on({ ajaxStart: function() { $body.addClass("loading"); }, ajaxStop: function() { $body.removeClass("loading"); } });
  */ 
  echo '</head>';
  echo '<body>';
  if ($sprogTabl==null) {
    sprogDB_import();   $str= $_GET['sprog'];   if ($str) $programSprog=$str; /* else $programSprog='da'; /* ?sprog=da /en/de/fr/tr/es */
  }
#  <div class="modal"></div>
#  $(window).load(function() {   // Animate loader off screen
#  $(".modal").fadeOut("slow");; });
/*   echo '<div id="msg" style="font-size:largest;"><!-- you can set whatever style you want on this -->Indlæser data, Hæng på...</div>';
  echo '<div id="body" style="display:none;"><!-- everything else --></div>';
  echo '<script type="text/javascript">$(document).ready(function() {    $('#body').show();    $('#msg').hide();});</script>';
 */
  // Her placeres sidens indhold
  
  // Til slut skal indlæses: include("../_base/htm_pageFoot.php");
?>