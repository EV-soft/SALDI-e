<?php      $DocFil= '../includes/db_func.php';    $DocVer='5.0.0';     $DocRev='2016-10-00';  # tidl: db_query.php
#   Redigeres stadig! : mysql_ -> mysqli_,    javascript:alert -> msg_Dialog('warn'
//             ___   _   _    ___  _         
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___|
//                                           
// LICENS
//
// Dette program er fri software. Du kan gendistribuere det og / eller
// modificere det under betingelserne i GNU General Public License (GPL)
// som er udgivet af The Free Software Foundation; enten i version 2
// af denne licens eller en senere version efter eget valg.
// Fra og med version 3.2.2 dog under iagttagelse af følgende:
// 
// Programmet må ikke uden forudgående skriftlig aftale anvendes
// i konkurrence med DANOSOFT ApS eller anden rettighedshaver til programmet.
// 
// Programmet er udgivet med haab om at det vil vaere til gavn,
// men UDEN NOGEN FORM FOR REKLAMATIONSRET ELLER GARANTI. Se
// GNU General Public Licensen for flere detaljer.
// 
// En dansk oversaettelse af licensen kan laeses her:
// http://www.saldi.dk/dok/GNU_GPL_v2.html
//
// Copyright (c) 2004-2016 DANOSOFT ApS
// ----------------------------------------------------------------------
//  2016.08.00 ev - EV-soft


/* 
Procedural Style:
The mysqli api provides dual interface. It supports the procedural and object-oriented interface. 
Users may prefer the procedural interface as migrating from old mysql api. 
The procedural interface is similar to that of the old mysql extension. 
The function names differ only by prefix. Some mysqli functions take a connection handle as their first argument, 
whereas matching functions in the old mysql interface take it as an optional last argument.

in mysql:
1 $mysql = mysql_connect('localhost', 'user', 'pass');
2 mysql_select_db("data");
3 $res = mysql_query("SELECT * FROM `users` WHERE `verified` = 1", $mysql);
4 $row = mysql_fetch_assoc($res);
5 echo $row['username'];

In mysqli:
1 $mysqli = mysqli_connect('localhost', 'user', 'pass', 'data');
2 $res = mysqli_query($mysqli, "SELECT * FROM `users` WHERE `verified` = 1 ");
3 $row = mysqli_fetch_assoc($res);
4 echo $row['username'];

*/

global $connection;

if (!function_exists('msg_Dialog')) {include('../includes/msg_lib.php');};

if (!function_exists('db_connect')) {
  function db_connect($l_host, $l_bruger, $l_password, $l_database="", $l_spor="") 
  { global $db_type, $db_encode, $connection;   //  $errTxt="";
    if ($db_type=='mysql') {
      if (function_exists('mysqli_connect')) {    //  TESTit:   mysql_connect -> mysqli_connect — Alias of mysqli::__construct()    http://php.net/manual/en/mysqli.construct.php
        if  ($l_host && !$l_bruger && !$l_password) 
        list($l_host,    $l_bruger,    $l_password)= explode(",",$l_host);  # explode() Tidl: split();
        $connection= mysqli_connect("$l_host","$l_bruger","$l_password");
        if ($db_encode=='UTF8') mysqli_query($connection,"SET NAMES 'utf8'"); 
        else                    mysqli_query($connection,"SET NAMES 'latin9'");
      } 
//-   else { $errTxt="<h1>Fejl: PHP-funktionen <b>mysqli_connect()</b> kunne ikke findes</h1><p>Er både MySql og php-mysqli installeret?</p>";  }
      else { msg_Dialog('error',tolk('@Fortsæt'),'$jQ112(this).dialog("close")','','','','',tolk('@Saldi PHP-Fejl:'),
            tolk('@PHP-funktionen mysqli_connect() kunne ikke findes')."\n".tolk('@Er både MySql og php-mysqli installeret?')); 
            exit; }
    } else {
      if (function_exists('pg_connect')) {
        if ($l_bruger && $l_database) {
          if ($l_password) $connection = pg_connect ("host=$l_host dbname=$l_database user=$l_bruger password=$l_password");
          else $connection = pg_connect ("host=$l_host dbname=$l_database user=$l_bruger");
        } elseif ($l_host) $connection = pg_connect ($l_host); # til systemer installert pre maj 09
//-   } else { $errTxt='<h1>Fejl: PHP-funktionen <b>pg_connect()</b> kunne ikke findes</h1><p>Er både postgres og php-pgsql installeret?</p>'; }
      } else { msg_Dialog('error',tolk('@Fortsæt'),'$jQ112(this).dialog("close")','','','','',tolk('@Saldi PHP-Fejl:'),
            tolk('@PHP-funktionen pg_connect() kunne ikke findes')."\n".tolk('@Er både postgres og php-pgsql installeret?')); 
            exit; }
    }
//-   if ($errTxt>"") { echo $errTxt; die;  } //  FIXit   msg_Dialog('error','@Fortsæt','$jQ112(this).dialog("close")','','','','','Saldi Fejl:',$errTxt);
    return $connection;
  }
}

//+ if (!$connection) { $spor= "\nFil: ". __FILE__ .' Linie: '. __LINE__;
//+   msg_Dialog ('error', tolk('@OK'),'$jQ112(this).dialog("close")', '',  '', '',   '',
//+         tolk('@Database problem'), tolk('@Afbryder! - fordi der ikke er oprettet forbindelse til databasen!'.$spor));
//+         exit; }

if (!function_exists('db_error')) {
  function db_error() { global $db_type, $connection;
    switch ($db_type){
      case "postgres":  echo pg_last_error(). "\n"; break 1;
      case "mysql"   :  echo mysqli_error($connection). "\n";   break 1;  //  TESTit:   mysql_error() -> mysqli_error($link...)     http://php.net/manual/en/mysqli.error.php
    }
  }
}


if (!function_exists('db_close')) {
  function db_close($qtext) { global $db_type;
    if ($db_type=="mysql") mysqli_close($qtext);    //  TESTit: mysql_close() -> mysqli_close($link...)     http://php.net/manual/en/mysqli.close.php
    else pg_close($qtext);
  }
}

if (!function_exists('db_modify')) {
  function db_modify($qtext, $spor) { global $db_type, $brugernavn, $db, $sqdb, $db_skriv_id, $custom_alerttekst, $connection;
    if ($db_type=="mysql") $db_query="mysqli_query";    //  FIXit:    mysql_query() -> mysqli_query($link...)     http://php.net/manual/en/mysqli.query.php
    else $db_query="pg_query";
    if (strpos($qtext,';')) { $tjek=1;
      for ($x=0;$x<strlen($qtext);$x++) {
        if ($tjek==1 && substr($qtext,$x,1)=="'" && substr($qtext,$x-1,1)!="\\") $tjek=0;  # "\\" rettet til "\\ " pga. syntaksvisning!
        elseif ($tjek==0 && substr($qtext,$x,1)=="'" && substr($qtext,$x-1,1)!="\\") $tjek=1;; # "\\" rettet til "\\ " pga. syntaksvisning!
        if ($tjek && substr($qtext,$x,1)==";") {  
          $s_id=session_id();
          $txt="SQL injection registreret!!! - Handling logget & afbrudt.";
          //  FIXit:  msg_Dialog('warn','@Fortsæt','$(this).dialog("close")','','','','','Saldi Dialog',$txt);
          print "<BODY onLoad=\"javascript:alert('$txt')\">";
          $fp=fopen("../temp/$db/.ht_modify.log","a");  fwrite($fp,"-- ".$brugernavn." ".date("Y-m-d H:i:s")."\n"); 
                                                        fwrite($fp,"-- SQL injection fra ".$_SERVER["REMOTE_ADDR"]." | " .$qtext.";\n");  fclose($fp);
          $s_id=session_id();
          include("../includes/connect.php");
          $db_query("delete from online where session_id = '$s_id'");
          print "<meta http-equiv=\"refresh\" content=\"0;URL=../index/index.php\">";
          exit;
        }
      }
    }
    $db=trim($db);
    if ($db_skriv_id>1) {
        $fp=fopen("../temp/$db/.ht_modify.log","a");  fwrite($fp,"-- ".$brugernavn." ".date("Y-m-d H:i:s").": ".$spor.": ".$db_skriv_id."\n");
                                                      fwrite($fp,$qtext.";\n");                         fclose($fp);
    }
    if (!$db_query($qtext)) {
      if ($db_type=="mysql") $fejltekst= mysqli_error($connection);   //    TESTit
      else $fejltekst= pg_last_error();
      $fp=fopen("../temp/$db/.ht_modify.log","a");    fwrite($fp,"-- ".$brugernavn." ".date("Y-m-d H:i:s").": ".$spor."\n");
                                                      fwrite($fp,"-- Fejl!! ".$qtext." | $fejltekst;\n"); fclose($fp);
      $message=$db." | ".$qtext." | ".$spor." | ".$brugernavn." ".date("Y-m-d H:i:s")." | $fejltekst";
      if (strstr($spor,"includes/opdat")) {
        $headers = 'From: fejl@saldi.dk'."\r\n".'Reply-To: fejl@saldi.dk'."\r\n".'X-Mailer: PHP/' . phpversion();
  //##  mail(SALDIFEJL, 'SALDI Opdat fejl', $message, $headers);
      } else {
        $headers = 'From: fejl@saldi.dk'."\r\n".'Reply-To: fejl@saldi.dk'."\r\n".'X-Mailer: PHP/' . phpversion();
  //##  mail(SALDIFEJL, 'SALDI Fejl - modify', $message, $headers);
        # $custom_alerttekst saettes i connect.php;
        if ($db_type=="mysql") {
          mysqli_query($connection,"ROLLBACK");   //    
        }
        (isset($custom_alerttekst))?$alerttekst=$custom_alerttekst:$alerttekst="Uforudset hændelse, kontakt salditeamet på telefon 4690 2208"; 
        if ($webservice) return ('1'.chr(9).'$alerttekst');
        //  FIXit:  msg_Dialog('warn','@Fortsæt','$(this).dialog("close")','','','','','Saldi Dialog',$alerttekst);
        print "<BODY onLoad=\"javascript:alert('$alerttekst')\">\n";
        exit;
      }
    }
    return ('0'.chr(9).'query accepted');
  }
}

if (!function_exists('db_select')) {
  function db_select($qtext,$spor) {  global $db_type, $brugernavn, $db, $custom_alerttekst, $connection; $Ødebug;
    if (!file_exists("../temp/$db")) mkdir("../temp/$db", 0775);
    if ($db_type=="mysql") $query="mysqli_query";   //    
    else $query="pg_query";

    if (!$connection) { //  if ($Ødebug) $spor= '<br><br>File: '. __FILE__ .'<br>Line: '. __LINE__;
      msg_Dialog ('error', tolk('@Retur'),'window.history.back();', '',   '', '',   '',
           tolk('@Database problem'), tolk('@Afbryder! - fordi der ikke er oprettet forbindelse til databasen!').'<br><br>Pos: '.$spor);
      exit; }
    
    if (!$query==$query($qtext)) {
      if ($db_type=="mysql") $fejltekst= mysqli_error($connection);   //    TESTit
      else $fejltekst=pg_last_error();
      $db=trim($db);
      $linje="";
      if (file_exists("../temp/$db/lasterror.txt")) { $fp=fopen("../temp/$db/lasterror.txt","r"); $linje=trim(fgets($fp));  fclose($fp);  }
      list($tmp,$tmp2)=explode("\n",$fejltekst);
      $tmp.="_".date("h:i");
      if ($linje != $tmp) {
        $fp=fopen("../temp/$db/lasterror.txt","w"); fwrite($fp,"$tmp");                                       fclose($fp);
        $fp=fopen("../temp/$db/lasterror.txt","a"); fwrite($fp,"-- ".$brugernavn." ".date("Y-m-d H:i:s").": ".$spor."\n");
                                                    fwrite($fp,"-- Fejl!! ".$qtext." | $fejltekst;\n");       fclose($fp);
          $message=$db." | ".$qtext." | ".$spor." | ".$brugernavn." ".date("Y-m-d H:i:s")." | $fejltekst";
          $headers = 'From: fejl@saldi.dk'."\r\n".'Reply-To: fejl@saldi.dk'."\r\n".'X-Mailer: PHP/' . phpversion();
  //##    mail(SALDIFEJL, 'SALDI Fejl - select', $message, $headers);
        # $custom_alerttekst saettes i connect.php;
        (isset($custom_alerttekst))?$alerttekst=$custom_alerttekst:$alerttekst="Uforudset h&aelig;ndelse, kontakt salditeamet på telefon 4690 2208"; 
        //  FIXit:  msg_Dialog('warn','@Fortsæt','$jQ112(this).dialog("close")','','','','','Saldi Dialog',$alerttekst);
        print "<BODY onLoad=\"javascript:alert('$alerttekst')\">\n";
      } else {
        # $custom_alerttekst saettes i connect.php;
        (isset($custom_alerttekst))?$alerttekst=$custom_alerttekst:$alerttekst="Uforudset h&aelig;ndelse, kontakt salditeamet på telefon 4690 2208"; 
        //  FIXit:  msg_Dialog('warn','@Fortsæt','$jQ112(this).dialog("close")','','','','','Saldi Dialog',$alerttekst);
        print "<BODY onLoad=\"javascript:alert('$alerttekst')\">\n";
        exit;
      }
    } else {
      $fp=fopen("../temp/$db/.ht_select.log","a");  fwrite($fp,"-- ".$brugernavn." ".date("Y-m-d H:i:s").": ".$spor."\n");  
                                                    fwrite($fp,$qtext.";\n");                             fclose($fp);
    }
    return $query;
  }
}
/*  
Warning: pg_query(): No PostgreSQL link opened yet in /volume1/web/saldi-e/includes/db_func.php on line 158 
Warning: pg_last_error(): No PostgreSQL link opened yet in /volume1/web/saldi-e/includes/db_func.php on line 160 
Warning: pg_fetch_array() expects parameter 1 to be resource, boolean given in /volume1/web/saldi-e/includes/db_func.php on line 206
*/
if (!function_exists('db_catalog_setval')) {
  function db_catalog_setval($seq, $val, $bool) { global $db_type;
    return pg_catalog.setval($seq, $val, $bool);
  }
}

if (!function_exists('db_fetch_array')) {
  function db_fetch_array($qtext) { global $db_type;
    if ($db_type=="mysql") // TESTit:   return mysql_fetch_array($qtext);       http://php.net/manual/en/mysqli-result.fetch-array.php
         return mysqli_fetch_array($qtext);
    else return pg_fetch_array($qtext);
  }
}

if (!function_exists('db_lookup')) { 
  function db_lookup($what,$tabl,$krit,$fil,$lin) {
    return db_fetch_array(db_select('select '.$what.' from '.$tabl.' where '.$krit.', '.$fil. ' linje '. $lin));
  }
}
//  GL: $r= db_fetch_array(db_select("select id from adresser where kontonr='$kontonr' and art = 'D'",__FILE__ . " linje " . __LINE__));
//  NY: $r= db_lookup('id','adresser'," kontonr='$kontonr' and art = 'D'", __FILE__ , __LINE__);

if (!function_exists('db_field_name')) {
  function db_field_name($a,$b) { global $db_type;
    if ($db_type=="mysql")  //  return mysql_field_name($a,$b);   //  FIXit:    http://php.net/manual/en/mysqli-result.fetch-field-direct.php
         return mysql_field_name($a,$b);    //    mysqli_fetch_field_direct ( mysqli_result $result , int $fieldnr )
    else return pg_field_name($a,$b);
  }
}

if (!function_exists('db_field_type')) {
  function db_field_type($a,$b) { global $db_type;
    if ($db_type=="mysql")  //  FIXit:    return mysql_field_type($a,$b);   //    http://php.net/manual/en/mysqli-result.fetch-field-direct.php
         return mysql_field_type($a,$b);    //    mysqli_fetch_field_direct ( mysqli_result $result , int $fieldnr )
    else return pg_field_type($a,$b);
  }
}

if (!function_exists('db_fetch_row')) {
  function db_fetch_row($qtext) { global $db_type;
    if ($db_type=="mysql")  //  TESTit:   return mysql_fetch_row($qtext);   //    http://php.net/manual/en/mysqli-result.fetch-row.php
         return mysqli_fetch_row($qtext);
    else return pg_fetch_row($qtext);
  }
}

if (!function_exists('db_num_rows')) {
  function db_num_rows($qtext){ global $db_type;
    if ($db_type=="mysql")  //  TESTit:   return mysql_num_rows($qtext);    //    http://php.net/manual/en/mysqli-result.num-rows.php
         return mysqli_num_rows($qtext);
    else return pg_num_rows($qtext);
  }
}

if (!function_exists('db_num_fields')) {
  function db_num_fields($qtext) {  global $db_type;
    if ($db_type=="mysql")  //  TESTit:   return mysql_num_fields($qtext);    //    http://php.net/manual/en/mysqli-result.field-count.php
         return mysqli_num_fields($qtext);
    else return pg_num_fields($qtext);
  }
}

if (!function_exists('transaktion')) {
  function transaktion($qtext){ global $brugernavn, $db_type, $db, $connection;
    $fp=fopen("../temp/$db/.ht_modify.log","a");  fwrite($fp,"-- ".$brugernavn." ".date("Y-m-d H:i:s").": ".$qtext."\n"); 
                                                  fwrite($fp,$qtext.";\n");       # Mangler her? : fclose($fp); ?
    if ($db_type=="mysql")    //  FIXit:     mysqli_query($qtext);    //    http://php.net/manual/en/mysqli.query.php
         mysqli_query($connection,$qtext);
    else pg_query($qtext);
  }
}

if (!function_exists('db_escape_string')) {
  function db_escape_string($qtext) { global $db_type;
    if ($db_type=="mysql")  //  FIXit:    return mysql_real_escape_string($qtext);    //    http://php.net/manual/en/mysqli.real-escape-string.php
         return mysql_real_escape_string($qtext);
    else return pg_escape_string($qtext);
  }
}
?>
