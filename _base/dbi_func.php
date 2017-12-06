<?php   $DocFil= '../_base/dbi_func.php';    $DocVer='5.0.0';    $DocRev='2017-12-00';   $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Forbedrede DB-funktioner, kompatible med PHP7+';
 * Denne fil er oprettet af EV-soft i 2017.   # afløser tidl: db_query.php
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * ## LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 */


global $Øconnection, $Ødb_Link, $Ødb_Type;

if (!function_exists('msg_Dialog')) {include_once('../../_base/msg_lib.php');};

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

/* 
if (!function_exists('db_connect')) {
  function db_connect($l_host, $l_bruger, $l_password, $l_database='', $l_spor='') 
  { global $Ødb_Type, $Ødb_Encode, $Øconnection;   //  $errTxt="";
    if ($Ødb_Type=='mysql') {
      if (function_exists('mysqli_connect')) {    //  TESTit:   mysql_connect -> mysqli_connect — Alias of mysqli::__construct()    http://php.net/manual/en/mysqli.construct.php
        if  ($l_host && !$l_bruger && !$l_password) 
        list($l_host,    $l_bruger,    $l_password)= explode(",",$l_host);  # explode() Tidl: split();
        
        $Øconnection= mysqli_connect($l_host,$l_bruger,$l_password);       //  mysqli_connect(): (HY000/1045): Access denied for user 'root'@'localhost' (using password: YES) in /volume1/web/saldi-e/_base/db_func.php on line 65 
        if ($Ødb_Encode=='UTF8') mysqli_query($Øconnection,"SET NAMES 'utf8'");   //  mysqli_query() expects parameter 1 to be mysqli, boolean given in /volume1/web/saldi-e/_base/db_func.php on line 66 Unable to connect to MySQL
        else                     mysqli_query($Øconnection,"SET NAMES 'latin9'");
      } 
//-   else { $errTxt="<h1>Fejl: PHP-funktionen <b>mysqli_connect()</b> kunne ikke findes</h1><p>Er både MySql og php-mysqli installeret?</p>";  }
      else { msg_Dialog('error',tolk('@Fortsæt'),'$jQ112(this).dialog("close")','','','','',tolk('@Saldi PHP-Fejl:'),
            tolk('@PHP-funktionen mysqli_connect() kunne ikke findes')."\n".tolk('@Er både MySql og php-mysqli installeret?')); 
            exit; }
    } else {
      if (function_exists('pg_connect')) {
        if ($l_bruger && $l_database) {
          if ($l_password) $Øconnection = pg_connect ("host=$l_host dbname=$l_database user=$l_bruger password=$l_password");
          else $Øconnection = pg_connect ("host=$l_host dbname=$l_database user=$l_bruger");
        } elseif ($l_host) $Øconnection = pg_connect ($l_host); # til systemer installert pre maj 09
//-   } else { $errTxt='<h1>Fejl: PHP-funktionen <b>pg_connect()</b> kunne ikke findes</h1><p>Er både postgres og php-pgsql installeret?</p>'; }
      } else { msg_Dialog('error',tolk('@Fortsæt'),'$jQ112(this).dialog("close")','','','','',tolk('@Saldi PHP-Fejl:'),
            tolk('@PHP-funktionen pg_connect() kunne ikke findes')."\n".tolk('@Er både postgres og php-pgsql installeret?')); 
            exit; }
    }
//-   if ($errTxt>"") { echo $errTxt; die;  } //  FIXit   msg_Dialog('error','@Fortsæt','$jQ112(this).dialog("close")','','','','','Saldi Fejl:',$errTxt);
    return $Øconnection;
  }
}

//+ if (!$Øconnection) { $spor= "\nFil: ". __FILE__ .' Linie: '. __LINE__;
//+   msg_Dialog ('error', tolk('@OK'),'$jQ112(this).dialog("close")', '',  '', '',   '',
//+         tolk('@Database problem'), tolk('@Afbryder! - fordi der ikke er oprettet forbindelse til databasen!'.$spor));
//+         exit; }

if (!function_exists('db_error')) {
  function db_error() { global $Ødb_Type, $Øconnection;
    switch ($Ødb_Type){
      case "postgres":  echo pg_last_error(). "\n"; break 1;
      case "mysql"   :  echo mysqli_error($Øconnection). "\n";   break 1;  //  TESTit:   mysql_error() -> mysqli_error($link...)     http://php.net/manual/en/mysqli.error.php
    }
  }
}


if (!function_exists('db_close')) {
  function db_close($qtext) { global $Ødb_Type;
    if ($Ødb_Type=="mysql") mysqli_close($qtext);    //  TESTit: mysql_close() -> mysqli_close($link...)     http://php.net/manual/en/mysqli.close.php
    else pg_close($qtext);
  }
}


if (!function_exists('db_modify')) {
  function db_modify($qtext, $spor) {global $Ødb_Type, $brugernavn, $db, $Øsqdb, $db_skriv_id, $custom_alerttekst, $Øconnection;
    if ($Ødb_Type=="mysql") 
         $db_query="mysqli_query";    //  FIXit:    mysql_query() -> mysqli_query($link...)     http://php.net/manual/en/mysqli.query.php
    else $db_query="pg_query";
    if (strpos($qtext,';')) { $tjek=1;
      for ($x=0;$x<strlen($qtext);$x++) {
        if ($tjek==1 && substr($qtext,$x,1)=="'" && substr($qtext,$x-1,1)!='\\') $tjek=0;  # "\\" rettet til '\\' pga. syntaksvisning!
        elseif ($tjek==0 && substr($qtext,$x,1)=="'" && substr($qtext,$x-1,1)!='\\') $tjek=1;; # "\\" rettet til '\\' pga. syntaksvisning!
        if ($tjek && substr($qtext,$x,1)==";") {  
          $s_id=session_id();
          $txt="SQL injection registreret!!! - Handling logget & afbrudt.";
          //  FIXit:  msg_Dialog('warn','@Fortsæt','$(this).dialog("close")','','','','','Saldi Dialog',$txt);
          print "<BODY onLoad=\"javascript:alert('$txt')\">";
          $fp=fopen("../_temp/$db/.ht_modify.log","a");  fwrite($fp,"-- ".$brugernavn." ".date("Y-m-d H:i:s")."\n"); 
                                                        fwrite($fp,"-- SQL injection fra ".$_SERVER["REMOTE_ADDR"]." | " .$qtext.";\n");  fclose($fp);
          $s_id=session_id();
          include_once("../_config/connect.php");
          $db_query("delete from online where session_id = '$s_id'");
          print "<meta http-equiv=\"refresh\" content=\"0;URL=../index/index.php\">";
          exit;
        }
      }
    }
    $db=trim($db);
    if ($db_skriv_id>1) {
        $fp=fopen("../_temp/$db/.ht_modify.log","a");  fwrite($fp,"-- ".$brugernavn." ".date("Y-m-d H:i:s").": ".$spor.": ".$db_skriv_id."\n");
                                                      fwrite($fp,$qtext.";\n");                         fclose($fp);
    }
 #   if (!$db_query($qtext)) {  // Parameterfejl!
    if (false) {
      if ($Ødb_Type=="mysql")
           $fejltekst= mysqli_error($Øconnection);   //    TESTit
      else $fejltekst= pg_last_error();
      $fp=fopen("../_temp/$db/.ht_modify.log","a");    fwrite($fp,"-- ".$brugernavn." ".date("Y-m-d H:i:s").": ".$spor."\n");
                                                      fwrite($fp,"-- Fejl!! ".$qtext." | $fejltekst;\n"); fclose($fp);
      $message=$db." | ".$qtext." | ".$spor." | ".$brugernavn." ".date("Y-m-d H:i:s")." | $fejltekst";
      if (strstr($spor,"includes/opdat")) 
            SupportMail('opdater',$message);
      else {SupportMail('modify',$message);
        # $custom_alerttekst saettes i connect.php;
        if ($Ødb_Type=="mysql") {
          mysqli_query($Øconnection,"ROLLBACK");   //    
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

if (!function_exists('SupportMail')) 
{
  function SupportMail($art, $mess) {
    $head = 'From: fejl@saldi.dk'."\r\n".'Reply-To: fejl@saldi.dk'."\r\n".'X-Mailer: PHP/' . phpversion();
    //##  mail(SALDIFEJL, 'SALDI Fejl - '.$art, $mess, $head);
}}

if (!function_exists('db_select')) {
  function db_select($qtext,$spor) { global $Ødb_Type, $brugernavn, $db, $custom_alerttekst, $Øconnection, $Ødebug, $Ødb_Link;
    if (!file_exists("../_temp/$db")) mkdir("../_temp/$db", 0775);
    if ($Ødb_Type=="mysql")   $query="mysqli_query";    else $query="pg_query";
    if (!$Ødb_Link) {
      $spor.= str_nl().str_Ihead('Function:').'db_select()'.str_Ihead('File:'). __FILE__ .str_Ihead('Line:'). __LINE__.str_Ihead('Info:').'[$Ødb_Link==false]';
      msg_Dialog('error', tolk('@Retur'),'window.history.back();', '', '', '', '', 
            tolk('@Database problem'), 
            tolk('@Afbryder! - fordi der ikke er oprettet forbindelse til databasen!').str_nl(2).str_hr().'Pos: '.$spor);
      exit; 
    }
    if ($Ødb_Link!= 'SkjulFejl')
    if (!$query==$query($Ødb_Link,$qtext)) {
      if ($Ødb_Type=="mysql") $fejltekst= mysqli_error($Ødb_Link);   //    TESTit
      else $fejltekst=pg_last_error();
      $db=trim($db);
      $linje="";
      if (file_exists("../_temp/$db/lasterror.txt")) { $fp=fopen("../_temp/$db/lasterror.txt","r"); $linje=trim(fgets($fp));  fclose($fp);  }
      list($tmp,$tmp2)=explode("\n",$fejltekst);
      $tmp.="_".date("h:i");
      if ($linje != $tmp) {
        $fp=fopen("../_temp/$db/lasterror.txt","w"); fwrite($fp,"$tmp");                                       fclose($fp);
        $fp=fopen("../_temp/$db/lasterror.txt","a"); fwrite($fp,"-- ".$brugernavn." ".date("Y-m-d H:i:s").": ".$spor."\n");
                                                    fwrite($fp,"-- Fejl!! ".$qtext." | $fejltekst;\n");       fclose($fp);
          $message=$db." | ".$qtext." | ".$spor." | ".$brugernavn." ".date("Y-m-d H:i:s")." | $fejltekst";
          SupportMail('select',$message);
        # $custom_alerttekst saettes i connect.php;
        (isset($custom_alerttekst))?$alerttekst=$custom_alerttekst:$alerttekst="Uforudset h&aelig;ndelse, kontakt salditeamet på telefon 4690 2208"; 
        //  FIXit:  msg_Dialog('warn','@Fortsæt','$jQ112(this).dialog("close")','','','','','Saldi Dialog',$alerttekst);
##        print "<BODY onLoad=\"javascript:alert('$alerttekst')\">\n";
      } else {        # $custom_alerttekst saettes i connect.php;
        (isset($custom_alerttekst))?$alerttekst=$custom_alerttekst:$alerttekst="Uforudset h&aelig;ndelse, kontakt salditeamet på telefon 4690 2208"; 
        //  FIXit:  msg_Dialog('warn','@Fortsæt','$jQ112(this).dialog("close")','','','','','Saldi Dialog',$alerttekst);
##        print "<BODY onLoad=\"javascript:alert('$alerttekst')\">\n";
        exit;
      }
    } else {
      $fp=fopen("../_temp/$db/.ht_select.log","a");  fwrite($fp,"-- ".$brugernavn." ".date("Y-m-d H:i:s").": ".$spor."\n");  
                                                    fwrite($fp,$qtext.";\n");                             fclose($fp);
    }
    return $query;
  }
}

if (!function_exists('db_catalog_setval')) {
  function db_catalog_setval($seq, $val, $bool) { global $Ødb_Type;
    return pg_catalog.setval($seq, $val, $bool);
  }
}

if (!function_exists('db_fetch_array')) {
  function db_fetch_array($qtext) { global $Ødb_Type, $Øconnection, $Ødb_Link;
    //  var_dump($Øconnection);
    if ($Ødb_Type=="mysql") // TESTit:   return mysql_fetch_array($qtext);       http://php.net/manual/en/mysqli-result.fetch-array.php
         return dbi_assoData(dbi_askData($Ødb_Link,$qtext));  //return mysqli_fetch_array(mysqli_query($Øconnection,$qtext),MYSQLI_ASSOC);
    else return pg_fetch_array($qtext);
  }
}

//  Ny udgave af db_fetch_array(db_select($qtext)):
if (!function_exists('db_Get')) {
  function db_Get($qtxt) 
  {return db_fetch_array(db_select($qtxt));}
}

if (!function_exists('db_lookup')) { // Ubenyttet!
  function db_lookup($what,$tabl,$krit,$fil,$lin) {
    return db_fetch_array(db_select('select '.$what.' from '.$tabl.' where '.$krit.', '.$fil. ' line '. $lin));
  }
}
//  GL: $r= db_fetch_array(db_select("select id from adresser where kontonr='$kontonr' and art = 'D'",__FILE__ . " linje " . __LINE__));
//  NY: $r= db_lookup('id','adresser'," kontonr='$kontonr' and art = 'D'", __FILE__ , __LINE__);

if (!function_exists('db_field_name')) {
  function db_field_name($a,$b) { global $Ødb_Type;
    if ($Ødb_Type=="mysql")  //  return mysql_field_name($a,$b);   //  FIXit:    http://php.net/manual/en/mysqli-result.fetch-field-direct.php
         return mysql_field_name($a,$b);    //    mysqli_fetch_field_direct ( mysqli_result $result , int $fieldnr )
    else return pg_field_name($a,$b);
  }
}

if (!function_exists('db_field_type')) {
  function db_field_type($a,$b) { global $Ødb_Type;
    if ($Ødb_Type=="mysql")  //  FIXit:    return mysql_field_type($a,$b);   //    http://php.net/manual/en/mysqli-result.fetch-field-direct.php
         return mysql_field_type($a,$b);    //    mysqli_fetch_field_direct ( mysqli_result $result , int $fieldnr )
    else return pg_field_type($a,$b);
  }
}

if (!function_exists('db_fetch_row')) {
  function db_fetch_row($qtext) { global $Ødb_Type;
    if ($Ødb_Type=="mysql")  //  TESTit:   return mysql_fetch_row($qtext);   //    http://php.net/manual/en/mysqli-result.fetch-row.php
         return mysqli_fetch_row($qtext);
    else return pg_fetch_row($qtext);
  }
}

if (!function_exists('db_num_rows')) {
  function db_num_rows($qtext){ global $Ødb_Type;
    if ($Ødb_Type=="mysql")  //  TESTit:   return mysql_num_rows($qtext);    //    http://php.net/manual/en/mysqli-result.num-rows.php
         return mysqli_num_rows($qtext);
    else return pg_num_rows($qtext);
  }
}

if (!function_exists('db_num_fields')) 
{
  function db_num_fields($qtext) {  global $Ødb_Type;
    if ($Ødb_Type=="mysql")  //  TESTit:   return mysql_num_fields($qtext);    //    http://php.net/manual/en/mysqli-result.field-count.php
         return mysqli_num_fields($qtext);
    else return pg_num_fields($qtext);
} }

if (!function_exists('transaktion')) 
{
  function transaktion($qtext){ global $brugernavn, $Ødb_Type, $db, $Øconnection;
    $fp=fopen("../_temp/$db/.ht_modify.log","a");  fwrite($fp,"-- ".$brugernavn." ".date("Y-m-d H:i:s").": ".$qtext."\n"); 
                                                  fwrite($fp,$qtext.";\n");       # Mangler her? : fclose($fp); ?
    if ($Ødb_Type=="mysql")    //  FIXit:     mysqli_query($qtext);    //    http://php.net/manual/en/mysqli.query.php
         mysqli_query($Øconnection,$qtext);
    else pg_query($qtext);
} }

if (!function_exists('db_escape_string')) 
{
  function db_escape_string($qtext) { global $Ødb_Type;
    if ($Ødb_Type=="mysql")  //  FIXit:    return mysql_real_escape_string($qtext);    //    http://php.net/manual/en/mysqli.real-escape-string.php
         return mysql_real_escape_string($qtext);
    else return pg_escape_string($qtext);
} }
 */


// Nye dbi_* rutiner for PHP7+ - MYSQLI:

if (!function_exists('dbi_connect')) ##  $onFile og $onLine angår __FILE__ og __LINE__ for sporing af fejlsted
{ { // Erkæring af alle dbi_ funktioner:
  function dbi_connect($sqhost, $squser, $sqpass, $sqdb, $onFile=__FILE__, $onLine=__LINE__) {          /* make connection (Tidl:db_connect)*/
    global $Ødb_Problem, $Ødb_Type;
    if ($Ødb_Type=='mysql') {
      if (function_exists('mysqli_connect')) {
        $dbLink= mysqli_connect($sqhost, $squser, $sqpass, $sqdb); 
        $Ødb_Problem= mysqli_connect_error(); 
#+        if ($Ødb_Encode=='UTF8') $names= 'utf8'; else $names= 'latin9'; mysqli_query($dbLink,'SET NAMES "'.$names.'"');
      } else { msg_Error('@Saldi mysql-Fejl:',tolk('@PHP-funktionen mysqli_connect() kunne ikke findes')."\n".tolk('@Er både DB-MySql og PHP-mysqli installeret?')."<br/>POS: ".$onFile.' :'.$onLine); 
          //   msg_Dialog('error',tolk('@Fortsæt'),'$jQ112(this).dialog("close")','','','','',tolk('@Saldi mysql-Fejl:'),              tolk('@PHP-funktionen mysqli_connect() kunne ikke findes')."\n".tolk('@Er både DB-MySql og PHP-mysqli installeret?')."<br/>POS: ".$onFile.' :'.$onLine); 
              exit; 
      }
    } else {  // 'postgres'
      if (function_exists('pg_connect')) {
          if ($sqpass) $dbLink = pg_connect ('host='.$sqhost.' dbname='.$sqdb.' user='.$squser.' password='.$sqpass);
          else         $dbLink = pg_connect ('host='.$sqhost.' dbname='.$sqdb.' user='.$squser);
      } else { msg_Dialog('error',tolk('@Fortsæt'),'$jQ112(this).dialog("close")','','','','',tolk('@Saldi postgres-Fejl:'),
              tolk('@PHP-funktionen pg_connect() kunne ikke findes')."\n".tolk('@Er både DB-postgres og PHP-pgsql installeret?')."<br/>POS: ".$onFile.' :'.$onLine); 
              exit; 
      }
    }
    return $dbLink;
  }
  
 /* check connection */
 function dbi_succes( $onFile='', $onLine='') {global $Ødb_Type;                         
    if ($Ødb_Type=='mysql') {
      if (mysqli_connect_errno()) {printf("Connect failed: %s\n", mysqli_connect_error()); exit();} 
            return mysqli_connect_errno();
    } else {return pg_last_error;}  /* "postgres" */ 
  }
  
/* get result */
  function dbi_askData($dbLink, $qtxt='', $onFile='', $onLine='', $onFunc='') {global $Ødb_Type;        
#-  if ($dbLink!= 'SkjulFejl')
    if ($dbLink==null) {msg_Dialog('error',tolk('@Fortsæt'),'$jQ112(this).dialog("close")','','','','',tolk('@Saldi DB:'),
            tolk('@Der er ikke forbindelse til DB-serveren!')."<br>".tolk('@Er connect.php oprettet korrekt?').
            '<br><br>Spot - File: '.substr($onFile,strpos($onFile,'saldi')).' - Line: '.$onLine.' - Func: '.$onFunc); 
            exit;} 
    else
    if ($Ødb_Type=='mysql') { //  var_dump(mysqli_query($dbLink, $qtxt));
            return $Qresult= mysqli_query($dbLink, $qtxt);
    } else {return pg_query($qtxt);} /* "postgres" */ 
  }
  
/* associative array */
  function dbi_assoData($Qresult, $mode= MYSQLI_ASSOC, $onFile=__FILE__, $onLine=__LINE__, $onFunc='') { global $Ødb_Problem, $Ødb_Type;    //  db_fetch_array($qtext)
    $result= array();
    if (!$Qresult)  { //echo tolk('@Ingen associative data! ').$Ødb_Problem; 
      msg_Dialog('error',tolk('@Fortsæt'),'$jQ112(this).dialog("close")','','','','',tolk('@Saldi DB:'),
            tolk('@Ingen associative data! ')."<br>".
            '<br><br>Spot - File: '.substr($onFile,strpos($onFile,'saldi')).' - Line: '.$onLine.' - Func: '.$onFunc);
            exit;
    } 
    else if ($Ødb_Type=='mysql') {
      {while ($row= mysqli_fetch_array($Qresult, $mode)) array_push($result,$row);}
                            return $result; }
    else { /* "postgres" */ return pg_fetch_array($Qresult);}; 
  }
  
/* free Qresult set */
  function dbi_freeData($Qresult, $onFile=__FILE__, $onLine=__LINE__) {global $Ødb_Type;                
    if ($Ødb_Type=='mysql') { return mysqli_free_result($Qresult);                                                                
    } else { /* "postgres" */ return pg_free_result($Qresult);  };
  }
  
/* close connection */
  function dbi_DBclose($Ødb_Link, $onFile=__FILE__, $onLine=__LINE__) {global $Ødb_Type;                  
    if ($Ødb_Type=='mysql') { return mysqli_close($Ødb_Link);                                                                       
    } else { /* "postgres" */ return pg_close($Ødb_Link); }; 
  }
  
  // dbi_modify()   mysqli_num_rows()
  
  
### Kombinerede:  Ikke nødvendig, men praktisk opdeling:    CRUD:   Create Read Update Delete

  function sql_creat($qstr, $onFile=__FILE__, $onLine=__LINE__) {global $Ødb_Link, $Ødb_Type;   //  "CREATE", "INSERT", "ADD"    /* db_modify */
    if ($Ødb_Type=='mysql') { return $Qresult= mysqli_query($Ødb_Link, $qstr);
    } else { /* "postgres" */ return $Qresult= pg_query($Ødb_Link,$qstr);}  // 
  }
  
  function sql_readA($qstr, $onFile=__FILE__, $onLine=__LINE__) {global $Ødb_Link, $Ødb_Type;   //  "SELECT" 
    if ($Ødb_Type=='mysql') { return dbi_assoData(dbi_askData($Ødb_Link,$qstr,__FILE__,__LINE__,__FUNCTION__), MYSQLI_ASSOC, $onFile=__FILE__, $onLine=__LINE__);
    } else { /* "postgres" */ return pg_fetch_assoc(pg_query($Ødb_Link,$qstr));
    };  
  }
  
  function sql_readN($qstr, $onFile=__FILE__, $onLine=__LINE__) {global $Ødb_Link, $Ødb_Type;   //  "SELECT" 
    if ($Ødb_Type=='mysql') { return dbi_assoData(dbi_askData($Ødb_Link,$qstr,__FILE__,__LINE__,__FUNCTION__), MYSQLI_NUM, $onFile=__FILE__, $onLine=__LINE__);
    } else { /* "postgres" */ return pg_num_rows($qstr);};  // "postgres"  pg_num_fields($qstr); ?
  }
  
  function sql_readB($qstr, $onFile='', $onLine='') {global $Ødb_Link, $Ødb_Type;   //  "SELECT" 
    if ($Ødb_Type=='mysql') { return dbi_assoData(dbi_askData($Ødb_Link,$qstr,$onFile,$onLine,__FUNCTION__), MYSQLI_BOTH, $onFile, $onLine);
    } else { /* "postgres" */ return 'Ikke færdig'; /* "postgres" ? */     };  
  }
  
  function sql_write() {global $Ødb_Link, $Ødb_Type;                            //  "MODIFY", "UPDATE", "ALTER"  
    if ($Ødb_Type=='mysql') { return 'Ikke færdig'; 
    } else { /* "postgres" */ return 'Ikke færdig'; }; // "postgres" pg_update() / pg_execute() ?
 }
  
  function sql_erase() {global $Ødb_Link, $Ødb_Type;                            //  "DELETE", "DROP"
    if ($Ødb_Type=='mysql') { return 'Ikke færdig'; 
    } else { /* "postgres" */ return 'Ikke færdig'; };  // "postgres" pg_execute() ?
    };  
  }
  
  function Vis_Data($arr) {
    if ($arr) foreach ($arr as $a) {echo "<br>"; for ($i= 0; $i<= count($a); $i++) echo $a[$i].' '; echo "<br>"; } 
  }
}



if (!function_exists('dbi_escape_string')) {
  function dbi_escape_string($txt) {global $Ødb_Type, $Ødb_Link;
    if ($Ødb_Type=="mysql") 
         return mysqli_real_escape_string($Ødb_Link,$txt);
    else return pg_escape_string($txt);
  }
}

if (!function_exists('injecttjek')) {
  function  injecttjek($txt) {
    global $db, $brugernavn;
    if (strpos($txt,';')) { $tjek=1;
      for ($x=0;$x<strlen($txt);$x++) {
        if     ($tjek==1 && substr($txt,$x,1)=="'" && substr($txt,$x-1,1)!=chr(92)) $tjek=0;       //  chr(92)= '\'
        elseif ($tjek==0 && substr($txt,$x,1)=="'" && substr($txt,$x-1,1)!=chr(92)) $tjek=1;
        if ($tjek && substr($txt,$x,1)==";") {  
          $s_id= session_id();
          $txt= tolk('@SQL injection registreret!!! - Handling logget & afbrudt');
          echo '<BODY onLoad="javascript:alert('.$txt.')">';
          $fp= fopen("../_temp/$db/.ht_modify.log","a");
          fwrite($fp,"-- ".$brugernavn." ".date("Y-m-d H:i:s")."\n");
          fwrite($fp,"-- ".tolk('@SQL injection fra ').$_SERVER["REMOTE_ADDR"]." | " .$txt.";\n");  
          fclose($fp);
          $s_id= session_id();
          include("../_config/connect.php");
          sql_erase('DELETE FROM tblP_online WHERE session_id = "'.$s_id.'"', __FILE__, __LINE__);  //  $db_query('DELETE FROM tblP_online WHERE session_id = "'.$s_id.'"');
          echo '<meta http-equiv="refresh" content="0;URL=../index/index.php">';
          exit;
        }
      } 
    } 
    return($txt);
  }
}



/* 
OVERSIGT over omdøbte 
Tabeller - engelsk med prefix: tbl_*
Indekser - prefix: ix_
Tidligere:        Ny:                                       - Kommentar:

Ang.PROGRAM:
brugere           tblP_users                                - Brugere af program-installationen
kundedata         tblP_customers
online            tblP_online
regnskab          tblP_accounts
revisor           tblP_auditor
tekster           tblP_texts

Ang.regnskab (ACCOUNT):               Rettet i ../_base/_admin/ini_CreateDB.php:
adresser          tblA_adress             tbl
ansatmappe        tblA_employ_folder      tbl
ansatmappebilag   tblA_employ_appendix    tbl
ansatte           tblA_employed           tbl
batch_kob         tblA_batch_purchase     tbl    ix
batch_salg        tblA_batch_sale         tbl    ix
betalinger        tblA_payments           tbl
betalingsliste    tblA_payment_list       tbl
bilag             tblA_appendix           tbl
brugere           tblA_users              tbl               - Brugere af regnskabet
budget            tblA_budget             tbl
crm               tblA_crm                tbl
enheder           tblA_units              tbl
formularer        tblA_forms              tbl
grupper           tblA_groups             tbl
historik          tblA_history            tbl
jobkort           tblA_jobcard            tbl
jobkort_felter    tblA_jobcard_felds      tbl
kassekladde       tblA_journal_entry      tbl
kladdeliste       tblA_draft_list         tbl
kontokort         tblA_charge_cards       tbl
kontoplan         tblA_account_plan       tbl
kostpriser        tblA_cost_prices        tbl
lagerstatus       tblA_stock_status       tbl
loen              tblA_salary             tbl
loen_enheder      tblA_salary_units       tbl
mappe             tblA_folder             tbl
mappebilag        tblA_folder_annex       tbl
materialer        tblA_materials          tbl
modtageliste      tblA_receiving_list     tbl
modtagelser       tblA_arrivals           tbl
navigator         tblA_navigator          tbl
noter             tblA_notes              tbl
openpost          tblA_open_post          tbl     ix
opgaver           tblA_tasks              tbl
ordrelinjer       tblA_order_lines        tbl     ix
ordrer            tblA_orders             tbl     ix
ordretekster      tblA_order_texts        tbl
pbs_kunder        tblA_pbs_customers      tbl
pbs_linjer        tblA_pbs_lines          tbl
pbs_liste         tblA_pbs_list           tbl
pbs_ordrer        tblA_pbs_orders         tbl
pos_betalinger    tblA_pos_payments       tbl     ix
pos_buttons       tblA_pos_buttons        tbl
provision         tblA_commission         tbl
rabat             tblA_discount           tbl
regulering        tblA_regulation         tbl
reservation       tblA_booking            tbl
sager             tblA_cases              tbl
sagstekster       tblA_case_texts         tbl
serienr           tblA_Serial             tbl
shop_adresser     tblA_shop_adresses      tbl
shop_ordrer       tblA_shop_orders        tbl
shop_varer        tblA_shop_product       tbl
simulering        tblA_simulation         tbl
styklister        tblA_parts_lists        tbl
tabeller          tblA_tables             tbl
tekster           tblA_texts              tbl
tidsreg           tblA_timesheet          tbl
tjekliste         tblA_check_list         tbl
tjekpunkter       tblA_check_lists        tbl
tjekskema         tblA_check_scheme       tbl
tmpkassekl        tblA_tmp_journal_Entry  tbl
transaktioner     tblA_transactions       tbl     ix
valuta            tblA_currency           tbl
varer             tblA_product            tbl     ix
varetekster       tblA_product_texts      tbl
varetilbud        tblA_product_offer      tbl
vare_lev          tblA_product_deliver    tbl
varianter         tblA_variants           tbl
variant_typer     tblA_variant_typer      tbl
variant_varer     tblA_variant_products   tbl

Ang. feltnavne skal ART gøres entydig, så der skelnes mellem:
art [text]                grp_art                                   - art i tabellen grupper/tblA_groups                DG  DIV DLV DRV EM  KASKL KG  KM  KRV MR  OLV 
art [varchar(2)]          adr_art                                   - art i tabellen adresser/tblA_adress               S   D   K 
art [int(11)]             frm_art                                   - art i tabellen formularer/tblA_forms              1   2   3  4...
art [text]                job_art                                   - art i tabellen jobkort_felter/tblA_jobcard_felds
art [text]                sly_art                                   - art i tabellen loen/tblA_salary
art [varchar(2)]          ord_art                                   - art i tabellen ordrer/tblA_orders                 DO  
debitorart [varchar(2)]   deb_art                                   - art i tabellen rabat/tblA_discount

box*  kan ikke gøres entydige, da de indeholder forskellige data afhængig af art. 

 */
?>
