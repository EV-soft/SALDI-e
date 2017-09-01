<?php   $DocFil= '../_base/htm_pageFoot.php';   $DocVer='5.0.0';    $DocRev='2017-03-00';   $modulnr=0;
/* ## Formål: Denne fil færdiggør en side, som er påbegyndt med ../_base/htm_pageHead.php 
 *             ___   _   _    ___  _         
 *            / __| / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            |___/_/ \_|____|___/|_|  \___)
 *                                           
 * ## LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 */
 global $Ødb_Link;
  if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'htm_pageFoot');
  echo '    <script src="../_assets/jquery/2/v214.jquery.min.js"></script><!-- SKAL indlæses før out_javascr.js! -->';
  echo '    <script src="../_assets/js/out_javascr.js"></script>';
  if ($Ødb_Link==false) {
    echo '    <script src="../_assets/js/pw-strength.js"></script>                    <!--  PassWord-styrke måler -->';
    echo '    <script src="../_assets/js/4.3.0.dk.zxcvbn.js"></script>                <!--  PassWord-styrke måler -->';    /*  Belaster indlæsning med 600+ ms */
  };
  echo '    <!-- echo \'<script src="https://s.codepen.io/assets/libs/modernizr.js" type="text/javascript"></script>\'; -->';
  echo '    <script src="../_assets/js/pw-cleartext.js"></script>';
  echo '    <script src="../_assets/js/jquery.formnavigation.js"></script>';
  echo '    <div class="modal"><!-- Place at bottom of page --></div>';
  echo '    <script> $(document).ready(function () { $(".formnavi").formNavigation(); }); </script>';
  echo '    <script type="text/javascript">$("#container").css("opacity", 0); $(window).load(function() {  $("#container").css("opacity", 1);});</script>';
  echo '  </body>';
  echo '</html>';
?>