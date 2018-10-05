<?php   $DocFil= '../_base/htm_pageFinalize.php';   $DocVer='5.0.0';    $DocRev='2018-09-20';   $DocIni='evs';  $ModulNr=0; //  Gl. navn: htm_pageFoot.php ?
/* ## Purpose: 'Denne fil faerdiggoer en side, som er paabegyndt med ../_base/htm_pagePrepare.php';
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * ## LICENS & Copyright (c) 2004-2018 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
  Oprettet: 2016-08-00 evs - EV-soft
  Ændrings-Log:
    
 *    
 */
global $Ødb_Link, $Øprogvers, $DocRev;
  if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'htm_pageFinalize');
  DocAlder($DocRev);
  
  if ((strpos($Øprogvers,'α')>0) and (!in_array($Caller,['Blindgyde','Hovedmenu']))) {
    $url= $_SERVER['REQUEST_URI'];
    $php= substr($url,strpos($url,'page_'));
    $txt= str_replace('php','txt',substr($php,0,strpos($php.'?','?')));
    htm_nl(2);
    Panl_PageComments(' Side-titel: '.$Caller.' - URL: '.$url.' Vers: '.$Øprogvers.' - Fil: '.$txt);
  }
#+
  include 'matomo.php';

  if ($Ødb_Link==false) {
    echo '    <script src="../_assets/js/pw-strength.js"></script>    ';        // emne= PassWord-styrke måler 
    echo '    <script src="../_assets/js/4.3.0.dk.zxcvbn.js"></script>';        // emne= PassWord-styrke måler  /*  Belaster indlæsning med 600+ ms */
  };
#?  echo '    <!-- echo \'<script src="https://s.codepen.io/assets/libs/modernizr.js" type="text/javascript"></script>\'; -->';
#?  echo '    <script src="../_assets/js/pw-cleartext.js"></script>';           // emne= class="js-password-hide-show"
  htm_nl(3);
  
####################### BODY-slut ##### HTML-slut ############################################

  echo '  </body>'; // Startet i ../_base/htm_pagePrepare.php
  echo '</html>';
?>