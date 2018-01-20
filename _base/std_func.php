<?php   $DocFil= '../_base/std_func.php';   $DocVer='5.0.0';    $DocRev='2017-10-00';     $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Almene funktioner f.eks. ang. datavisning';
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 *
 * LICENS & Copyright (c) 2004-2016 DANOSOFT ApS *** Se filen: ../LICENS_Copyright.txt
 *
 * 2016.08.00 ev - EV-soft
 */
//  Prefix: Ø på alle functioner, for at tilkendegive, at de er anvendt globalt ?.

if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'StandardRutiner');

if (!function_exists('Ønr_cast')) {
  function Ønr_cast($tekst)
  {
    global $db_type;
      if ($db_type=='mysql') $tmp = "CAST($tekst AS SIGNED)";
      else $tmp = "to_number(text($tekst),text(999999999999))";
    return $tmp;
  }
}
if (!function_exists('Ødkdecimal')) {
  function Ødkdecimal($tal,$decimaler) {
    if (!$decimaler && $decimaler!='0') $decimaler=2;
    if (is_numeric($tal)) { 
      if ($tal) $tal=afrund($tal,$decimaler); #Afrunding tilfoejet 2009.01.26 grundet diff i ordre 98 i saldi_104
      $tal=number_format($tal,$decimaler,",",".");
    }
    return $tal;
  }
}

if (!function_exists('Ødkdato')) {
  function Ødkdato($dato)
  {
    if ($dato) {
      list ($year, $month, $day) = explode('-', $dato);
      $month=$month*1;
      $day=$day*1;
      if ($month<10){$month='0'.$month;}
      if ($day<10){$day='0'.$day;}
      $dato = $day . "-" . $month . "-" . $year;
      return $dato;
    }
  }
}
if (!function_exists('Øif_isset')) {
  function Øif_isset(&$var) { return isset($var)? $var:NULL; }
}

function PostSet($varname, $default) {
  $varname= $_POST["$varname"];
  if (!$varname) $varname= $default;
  return $varname;
}

if (!function_exists('Øusdate')) {
  function Øusdate($date) 
  {
    global $regnaar;
    $day=NULL;$month=NULL;$year=NULL; 
    
    $date=trim($date);
    
    if (!isset($date) || !$date) $date=date("dmY");
    
    $date=str_replace (".","-",$date);
    $date=str_replace (" ","-",$date);
    $date=str_replace ("/","-",$date);
        
    if (strpos($date,"-")) list ($day, $month, $year) = explode('-', $date);
    if ($year) $year=$year*1;
    if ($month) $month=$month*1;
    if ($day) $day=$day*1;
    if ($year && $year<10) $year='0'.$year;
    elseif (!$year) $year="";
    if ($month && $month<10) $month='0'.$month;
    elseif (!$month) $month="";
    if ($day && $day<10) $day='0'.$day; 
    if ($day) $date=$day.$month.$year;

    if (strlen($date) <= 2) {
        $date=$date*1;
      if ($date<10) $date='0'.$date;
      $date=$date.date("m"); 
    } 
    if (strlen($date) <= 4) {
      $g1=substr($date,0,2);
      $g2=substr($date,2,2);
      if ($r = db_fetch_array(db_select("select box1, box2, box3, box4 from grupper where art='RA' and kodenr='$regnaar'",__FILE__ . " linje " . __LINE__))){
        $startmaaned=trim($r['box1']);
        $startaar=trim($r['box2']);
        $slutmaaned=trim($r['box3']);
        $slutaar=trim($r['box4']);
        if ($startaar==$slutaar) $g3=$startaar;
        elseif ($g2>=$startmaaned) $g3=$startaar;
        else $g3=$slutaar;
      } else {
        $alerttekst='Regnskabs&aring;r ikke oprettet!';
        print "<BODY onLoad=\"javascript:alert('$alerttekst')\">";
        exit;
      } 
      $date=$g1."-".$g2."-".$g3;
    } elseif (strlen($date) <= 6) {
      $g1=substr($date,0,2);
      $g2=substr($date,2,2);
      $g3=substr($date,4,2);
      $date=$g1."-".$g2."-".$g3;
    } else {
      $g1=substr($date,0,2);
      $g2=substr($date,2,2);
      $g3=substr($date,4,4);
      $date=$g1."-".$g2."-".$g3;
    } 
    
    
    

    list ($day, $month, $year) = explode('-', $date);

    
    $year=$year*1;
    $month=$month*1;
    $day=$day*1;
    
    if ($year<10){$year='0'.$year;}
    if ($month<10){$month='0'.$month;}
    if ($day<10){$day='0'.$day;}
     
    if ($day>28) {
      while (!checkdate($month,$day,$year)){
        $day=$day-1;
        if ($day<28) break 1;
      }
    }
     
    if ($year < 80) {$year = "20".$year;}
    elseif ($year < 100) {$year = "19".$year;}

    if (checkdate($month, $day, $year)) {$date = $year . "-" . $month . "-" . $day;}
    else {$date=date("Y-m-d");}
    
    return $date;
  }
}
if (!function_exists('Øusdecimal')) {
  function Øusdecimal($tal,$decimaler) {
    if (!$decimaler && $decimaler!='0') $decimaler=2;
    if (!$tal){
      $tal="0";
      if ($decimaler) {
        $tal.=',';
        for ($x=1;$x<=$decimaler;$x++) $tal.='0';
      }
    }
    $tal = str_replace(".","",$tal);
    $tal = str_replace(",",".",$tal);
    $tal=$tal*1;
    $tal=round($tal+0.0001,3);
    if (!$tal){
      $tal="0";
      if ($decimaler) {
        $tal.='.';
        for ($x=1;$x<=$decimaler;$x++) $tal.='0';
      }
    }
    return $tal;
  }
}
if (!function_exists('Øfindtekst')) {
  function Øfindtekst($tekst_id,$sprog_id) {
    global $db_encode;
    global $webservice;
    $ny_tekst=NULL;
    $tekst_id=$tekst_id*1;
    $sprog_id=$sprog_id*1;
    if (!$sprog_id) $sprog_id=1;
    if ($r = db_fetch_array(db_select("select tekst from tekster where tekst_id='$tekst_id' and sprog_id = '$sprog_id' and tekst != '-'",__FILE__ . " linje " . __LINE__))){
      $tekst=$r['tekst'];
    } elseif (file_exists("../importfiler/egnetekster.csv") ) {
      $fp=fopen("../importfiler/egnetekster.csv","r");
      if ($fp) {
        while (!feof($fp)) {
          if ($linje=trim(fgets($fp))) {
            list($tekst_nr,$tmp)=explode(chr(9),$linje);
            if ($tekst_id==$tekst_nr) {
            $ny_tekst=substr(stristr($linje,chr(9)),1);# Linjen efter 1. tab.
              for ($i=1;$i<=$sprog_id;$i++) $linje = substr(stristr($linje,chr(9)),1); # Start paa tekst med aktuel sprog id findes.
              list($ny_tekst,$tmp)=explode(chr(9),$linje); # Tekststrengen isoleres
              $tekst=$ny_tekst;
            }
          }
        }
        fclose($fp);
      }
    }
    if (!$tekst) {
      $fp=fopen("../importfiler/tekster.csv","r");
      if ($fp) {
        while (!feof($fp)) {
          if ($linje=trim(fgets($fp))) {
            list($tekst_nr,$tmp)=explode(chr(9),$linje);
            if ($tekst_id==$tekst_nr) {
            $ny_tekst=substr(stristr($linje,chr(9)),1);# Linjen efter 1. tab. 
              for ($i=1;$i<=$sprog_id;$i++) $linje = substr(stristr($linje,chr(9)),1); # Start paa tekst med aktuel sprog id findes.
              list($ny_tekst,$tmp)=explode(chr(9),$linje); # Tekststrengen isoleres 
            }
          }
        }   
        fclose($fp);
      }
    }
    if ($ny_tekst) {
      if ($db_encode!="UTF8") $ny_tekst=utf8_decode($ny_tekst);
      $tmp=db_escape_string($ny_tekst); #20140505
      db_modify("insert into tekster(sprog_id,tekst_id,tekst) values ('$sprog_id','$tekst_id','$tmp')",__FILE__ . " linje " . __LINE__);
      $tekst=$ny_tekst;
    } 
    if (!$tekst) $tekst="Tekst nr: $tekst_id";
    elseif ($tekst=="-") $tekst='';
    return ($tekst);
  }
}
if (!function_exists('Øjavascript')) {
  function Øjavascript() {
    
  }
} 
if (!function_exists('Øafrund')) {
  function Øafrund($tal,$decimaler)
  {
    # Korrigerer afrundingsfejl i php 
    $decimaler=$decimaler*1;  
    $tmp=0.001;
    for ($x=1;$x<$decimaler ;$x++) {
      $tmp=$tmp/10;
    }
    if ($tal>0) $tal=round($tal+$tmp,$decimaler);
    elseif ($tal<0) $tal=round($tal-$tmp,$decimaler);
    return $tal;
  }
}
if (!function_exists('Øfjern_nul')) {
  function Øfjern_nul($tal)
  {
    #fjerner decimalnuller fra tal 
    if (strpos($tal,",")) {
      list($a,$b)=explode(",",$tal);
      $b=$b*1;
      if ($b) $tal=$a.",".$b;
      else $tal=$a;
    }
    return $tal;
  }
}
if (!function_exists('Øbynavn')) {
  function Øbynavn($postnr) {
    global $db_encode;
  
    $fp=fopen("../importfiler/postnr.csv","r");
    if ($fp) {
      while ($linje=trim(fgets($fp))) {
        if ($db_encode=="UTF8") $linje=utf8_encode($linje);
        list($a,$b)=explode(chr(9),$linje);
          if ($a==$postnr) {
            $bynavn=str_replace('"','',$b);
            break 1;
          }
        }
      }
      fclose($fp);
    return("$bynavn");
  }
}

if (!function_exists('Øfelt_fra_tekst')) {
  function Øfelt_fra_tekst ($feltmatch, $tekstlinjer) {
    $matchende_linjer = preg_grep("/$feltmatch/", $tekstlinjer);
    foreach ($matchende_linjer as $linje) {
      $retur = str_replace($feltmatch, "", $linje);
    }
    return $retur;
  }
}

if (!function_exists('Øsidste_dag_i_maaned')) {
  function Øsidste_dag_i_maaned ($aar, $maaned) {
    $maaned++;
    $retur = date("d", mktime(12, 0, 0, $maaned, 0, $aar));
    return $retur;
  }
}

if (!function_exists('Øfarvenuance')) {
  function Øfarvenuance ($farve, $nuance) { # Notation for nuance: -33+33-33 eller -3+3-3
    global $bgcolor;
    
    if ( $bgcolor=="#" ) $bgcolor="#ffffff"; # 20141010 Hvis ingen bgcolor er angivet, så benyttes hvid som baggrund.
    if ( $farve=="#" ) $farve="#ffffff"; # 20141010 Hvis ingen farve er angivet, så benyttes hvid som baggrund.

    $retur = $bgcolor;

    $farve = preg_replace("/[^0-9A-Fa-f]/", '', $farve);

    if ( strlen($farve) == 3 ) {
      $roed_farve=hexdec(str_repeat(substr($farve, 0, 1), 2));
      $groen_farve=hexdec(str_repeat(substr($farve, 1, 1), 2));
      $blaa_farve=hexdec(str_repeat(substr($farve, 2, 1), 2));
    } else {
      $roed_farve=hexdec(substr($farve, 0, 2));
      $groen_farve=hexdec(substr($farve, 2, 2));
      $blaa_farve=hexdec(substr($farve, 4, 2));
    }

    if ( strlen($nuance) == 6 ) {
      $roed_fortegn=substr($nuance, 0, 1)."1";
      $roed_nuance=$roed_fortegn*hexdec(str_repeat(substr($nuance, 1, 1), 2));
      $groen_fortegn=substr($nuance, 2, 1)."1";
      $groen_nuance=$groen_fortegn*hexdec(str_repeat(substr($nuance, 3, 1), 2));
      $blaa_fortegn=substr($nuance, 4, 1)."1";
      $blaa_nuance=$blaa_fortegn*hexdec(str_repeat(substr($nuance, 5, 1), 2));
    } else {
      $roed_fortegn=substr($nuance, 0, 1)."1";
      $roed_nuance=$roed_fortegn*hexdec(substr($nuance, 1, 2));
      $groen_fortegn=substr($nuance, 3, 1)."1";
      $groen_nuance=$groen_fortegn*hexdec(substr($nuance, 4, 2));
      $blaa_fortegn=substr($nuance, 6, 1)."1";
      $blaa_nuance=$blaa_fortegn*hexdec(substr($nuance, 7, 2));
    }

    $roed_farve=$roed_farve+$roed_nuance;
    if ($roed_farve < 0 ) $roed_farve = 0;
    if ($roed_farve > 255 ) $roed_farve = 255;
    $groen_farve=$groen_farve+$groen_nuance;
    if ($groen_farve < 0 ) $groen_farve = 0;
    if ($groen_farve > 255 ) $groen_farve = 255;
    $blaa_farve=$blaa_farve+$blaa_nuance;
    if ($blaa_farve < 0 ) $blaa_farve = 0;
    if ($blaa_farve > 255 ) $blaa_farve = 255;

    $roed_farve=str_pad(dechex($roed_farve), 2, STR_PAD_LEFT);
    $groen_farve=str_pad(dechex($groen_farve), 2, STR_PAD_LEFT);
    $blaa_farve=str_pad(dechex($blaa_farve), 2, STR_PAD_LEFT);

    $retur = "#".$roed_farve.$groen_farve.$blaa_farve;

    return $retur;
  }
}

if (!function_exists('Ølinjefarve')) {
  #function Ølinjefarve ($linjefarve, $ulige_bg, $lige_bg, $nuance = 0, $stdnuance = 0) {
  function Ølinjefarve ($linjefarve, $ulige_bg, $lige_bg, $stdnuance = 0, $nuance = 0) {

    if ( $linjefarve === $ulige_bg || $linjefarve === farvenuance($ulige_bg, $stdnuance) ) {
      if ( $nuance ) {
        $retur = farvenuance($lige_bg, $nuance);
      } else {
        $retur = $lige_bg;
      }
    } else { 
      if ( $nuance ) {
        $retur = farvenuance($ulige_bg, $nuance);
      } else {
        $retur = $ulige_bg;
      }
    } 
      
    return $retur;
  }
}

if (!function_exists('Øcopy_row')) {
  function Øcopy_row($table,$id) {
    if (!$table || !$id) return('0');
    $r=0;$x=0;
    $fieldstring=NULL;
    $q_string="select * from $table where pris != '0' and m_rabat != '0' and rabat = '0' and id='$id'";
    $q=db_select("$q_string",__FILE__ . " linje " . __LINE__);
    while ($r < db_num_fields($q)) {
      if (db_field_name($q,$r) != 'id') {
        $x++;
        $fieldName[$x] = db_field_name($q,$r); 
        $fieldType[$x] = db_field_type($q,$r);
        ($fieldstring)?$fieldstring.=",".$fieldName[$x]:$fieldstring=$fieldName[$x];
      }
      $r++;
    }
    $feltantal=$x;
    $ordre_id=NULL;$posnr=NULL;
    $x=0;
    $q=db_select("$q_string");
    if ($r = db_fetch_array($q)) {
      $fieldvalues=NULL;
      $selectstring=NULL;
      for ($y=1;$y<=$feltantal;$y++){
        $linjerabat=afrund($r['pris']/$r['m_rabat'],2);
        $feltnavn=$fieldName[$y];
        $felt[$y]=$r[$feltnavn];
        if ($fieldType[$y]=='varchar' || $fieldType[$y]=='text') $felt[$y]=addslashes($felt[$y]);
        if (substr($fieldType[$y],0,3)=='int' || $fieldType[$y]=='numeric') $felt[$y]*=1;
        if ($fieldName[$y]=='posnr') {
          $felt[$y]++;
          $posnr=$felt[$y];
        } 
        if ($fieldName[$y]=='ordre_id') $ordre_id=$felt[$y];
        ($fieldvalues)?$fieldvalues.=",'".$felt[$y]."'":$fieldvalues="'".$felt[$y]."'";
        ($selectstring)?$selectstring.=" and ".$fieldName[$y]."='".$felt[$y]."'":$selectstring=$fieldName[$y]."='".$felt[$y]."'";
      }
    }
    if ($posnr && $ordre_id) db_modify("update $table set posnr=posnr+1 where ordre_id = '$ordre_id' and posnr >= '$posnr'",__FILE__ . " linje " . __LINE__);
    db_modify("insert into ordrelinjer ($fieldstring) values ($fieldvalues)",__FILE__ . " linje " . __LINE__);
    $r=db_fetch_array(db_select("select id from $table where $selectstring",__FILE__ . " linje " . __LINE__));
    $ny_id=$r['id'];
    return($ny_id);
  } # endfunc copy_row
}
if (!function_exists('Øreducer')) {
  function Øreducer($tal){
    while ((strpos($tal,".") || strpos($tal,",")) && ($tal && (substr($tal,-1,1)=='0' or substr($tal,-1,1)==',' or substr($tal,-1,1)=='.'))) {
      $tal=substr($tal,0,strlen($tal)-1);
    }
    return ($tal);
  }
}
if (!function_exists('Øtranstjek')) {
  function Øtranstjek () {
    global $db;
    $r=db_fetch_array(db_select("select sum(debet) as debet,sum(kredit) as kredit from transaktioner",__FILE__ . " linje " . __LINE__));
    $diff=abs(afrund($r['debet']-$r['kredit'],2));
    if ($diff >= 1) { 
      $message=$db." | Ubalance i regnskab: kr: $diff";
      $headers = 'From: fejl@saldi.dk'."\r\n".'Reply-To: fejl@saldi.dk'."\r\n".'X-Mailer: PHP/' . phpversion();
//##  mail('fejl@saldi.dk', 'Ubalance i regnskab:'. $db, $message, $headers);
    }
    return($diff);
  }
}
if (!function_exists('Øcvrnr_omr')) {
  function Øcvrnr_omr($landekode) {
    $retur = "";
    if ( ! $landekode ) { 
      $retur = "";
    } else { 
      switch ( $landekode ) {
        case "dk": $retur = "DK"; break 1;
        case "at": $retur = "EU"; break 1;
        case "be": $retur = "EU"; break 1;
        case "cy": $retur = "EU"; break 1;
        case "cz": $retur = "EU"; break 1;
        case "de": $retur = "EU"; break 1;
        case "ee": $retur = "EU"; break 1;
        case "gr": $retur = "EU"; break 1;
        case "es": $retur = "EU"; break 1;
        case "fi": $retur = "EU"; break 1;
        case "fr": $retur = "EU"; break 1;
        case "gb": $retur = "EU"; break 1;
        case "hu": $retur = "EU"; break 1;
        case "ie": $retur = "EU"; break 1;
        case "it": $retur = "EU"; break 1;
        case "lt": $retur = "EU"; break 1;
        case "lu": $retur = "EU"; break 1;
        case "lv": $retur = "EU"; break 1;
        case "mt": $retur = "EU"; break 1;
        case "nl": $retur = "EU"; break 1;
        case "pl": $retur = "EU"; break 1;
        case "pt": $retur = "EU"; break 1;
        case "ro": $retur = "EU"; break 1;
        case "se": $retur = "EU"; break 1;
        case "si": $retur = "EU"; break 1;
        case "sk": $retur = "EU"; break 1;
        case "gl": $retur = "UD"; break 1;
        default: $retur = "UD"; break 1;
      }
    }
    return $retur;
  }
}
if (!function_exists('Øcvrnr_land')) {
  function Øcvrnr_land($cvrnr, $skat) {
    $retur = "";
  
    $cvrnr = strtoupper($cvrnr);
    
    if ( ! $cvrnr ) {
      $retur = "";
    } elseif ( is_numeric(substr($cvrnr, 0, 1)) ) {
      $retur = "dk"; 
    } else {
      $start_tegn=strtolower(substr($cvrnr, 0, 3));
      switch ( $start_tegn ) {
        case "ger": $start_tegn="gl"; break 1;
        default : break 1;
      }
      $start_tegn=substr($start_tegn, 0, 2);
      switch ( $start_tegn ) {
        case "el": $retur = "gr"; break 1;
        default: $retur = $start_tegn; 
      }
    }
    return $retur;
  }
}
if (!function_exists('Østr2low')) {
  function Østr2low($string) { global $db_encode;
    $string= strtolower($string);
    if ($db_encode=='UTF8') {
      $string= str_replace(chr(195).chr(134),chr(195).chr(166),$string);   # Ã †          Ã ¦
      $string= str_replace(chr(195).chr(152),chr(195).chr(184),$string);   # Ã ˜           Ã ¸
      $string= str_replace(chr(195).chr(133),chr(195).chr(165),$string);   # Ã …          Ã ¥
    } else {   
      $string= str_replace(chr(198),chr(230),$string);   # Æ    æ
      $string= str_replace(chr(216),chr(248),$string);   # Ø    ø
      $string= str_replace(chr(197),chr(229),$string);   # Å    å
    }
    return ("$string");
  }
}

if (!function_exists('Østr2up')) {
  function Østr2up($string) {  global $db_encode;
    $string= strtoupper($string);
    if ($db_encode=='UTF8') {
      $string= str_replace(chr(195).chr(166),chr(195).chr(134),$string);
      $string= str_replace(chr(195).chr(184),chr(195).chr(152),$string);
      $string= str_replace(chr(195).chr(165),chr(195).chr(133),$string);
    } else {   
      $string= str_replace(chr(230),chr(198),$string);
      $string= str_replace(chr(248),chr(216),$string);
      $string= str_replace(chr(229),chr(197),$string);
    }        
    $string= str_replace('æ','Æ',$string);
    $string= str_replace('ø','Ø',$string);
    $string= str_replace('å','Å',$string);
    return ("$string");
  }
}


if (!function_exists('Øfind_varemomssats')) {
  function Øfind_varemomssats($linje_id) {
    global $regnaar;

    $r=db_fetch_array(db_select("select ordre_id,vare_id,momsfri,omvbet from ordrelinjer where id='$linje_id'",__FILE__ . " linje " . __LINE__));
    $ordre_id=$r['ordre_id']*1;
    $vare_id=$r['vare_id']*1;
    $momsfri=$r['momsfri'];
    $omvbet=$r['omvbet'];

    if (!$vare_id) return("0"); 
    
    if ($momsfri) {
      db_modify("update ordrelinjer set momssats='0' where id = '$linje_id'",__FILE__ . " linje " . __LINE__);
      return('0');
      exit;
    }
    $r=db_fetch_array(db_select("select momssats,status from ordrer where id='$ordre_id'",__FILE__ . " linje " . __LINE__));
    $momssats=$r['momssats'];
    $status=$r['status'];

    $r=db_fetch_array(db_select("select gruppe from varer where id = '$vare_id'",__FILE__ . " linje " . __LINE__)); 
    $gruppe=$r['gruppe'];
    $r=db_fetch_array(db_select("select box4,box6,box7,box8 from grupper where art = 'VG' and kodenr = '$gruppe'",__FILE__ . " linje " . __LINE__));
    $bogfkto = $r2['box4'];
    $momsfri = $r2['box7'];
    if ($momsfri) {
      db_modify("update ordrelinjer set momssats='0' where id = '$linje_id'",__FILE__ . " linje " . __LINE__);
      return('0');
      exit;
    }
    if ($bogfkto) {
      $r=db_fetch_array(db_select("select moms from kontoplan where kontonr = '$bogfkto' and regnskabsaar = '$regnaar'",__FILE__ . " linje " . __LINE__));
      if ($tmp=trim($r2['moms'])) { # f.eks S3
        $tmp=substr($tmp,1); #f.eks 3
        $r2 = db_fetch_array(db_select("select box2 from grupper where art = 'SM' and kodenr = '$tmp'",__FILE__ . " linje " . __LINE__));
        if ($r2['box2']) $varemomssats=$r2['box2']*1;
      } else $varemomssats=$momssats;
    } else $varemomssats=$momssats;
    db_modify("update ordrelinjer set momssats='$varemomssats' where id = '$linje_id'",__FILE__ . " linje " . __LINE__);
    return("$varemomssats");  
  }
}


if (!function_exists('Øfind_lagervaerdi')) {
function Øfind_lagervaerdi($kontonr,$slut,$tidspkt) {
  global $regnaar;
  $x=0;
  $lagervaerdi=0;
  $lager=array();
  $gruppe=array();
  $kob=0;
  $salg=0;
  
  if (!$slut) {
    print "<BODY onLoad=\"javascript:alert('737 | $slut | $linje')\">";
    return('stop'); 
  }
  $q=db_select("select kodenr,box1,box2,box3 from grupper where art = 'VG' and box8 = 'on' and (box1 = '$kontonr' or box2 = '$kontonr' or box3 = '$kontonr')",__FILE__ . " linje " . __LINE__);
  while ($r=db_fetch_array($q)) {
    if($r['box1']==$kontonr) $kob=1;
    if($r['box2']==$kontonr) $salg=1;
    if($r['box3']==$kontonr) {
      $salg=1;
      $kob=1;
    }
    $gruppe[$x]=$r['kodenr'];
    $x++;
  }
  $y=0;
  for ($x=0;$x<count($gruppe);$x++) {
    $q=db_select("select id,kostpris from varer where gruppe = '$gruppe[$x]' order by id",__FILE__ . " linje " . __LINE__);
    while ($r=db_fetch_array($q)) {
      $vare_id[$y]=$r['id'];
      $kostpris[$y]=$r['kostpris'];
      $antal[$y]=0;
      $y++;
    }
  }
  for ($x=0;$x<count($vare_id);$x++) {
    if ($kob) {
      if ($tidspkt=='start') $qtxt="select sum(antal) as antal from batch_kob where vare_id = $vare_id[$x] and (fakturadate < '$slut' or kobsdate < '$slut')";
      else $qtxt="select sum(antal) as antal from batch_kob where vare_id = $vare_id[$x] and (fakturadate <= '$slut' or kobsdate <= '$slut')";
      $r=db_fetch_array(db_select($qtxt,__FILE__ . " linje " . __LINE__));
      $antal[$x]+=$r['antal'];
    }
    if ($salg) {
      if ($tidspkt=='start') $qtxt="select sum(antal) as antal from batch_salg where vare_id = $vare_id[$x] and salgsdate < '$slut'";
      else $qtxt="select sum(antal) as antal from batch_salg where vare_id = $vare_id[$x] and salgsdate <= '$slut'";
      $r=db_fetch_array(db_select($qtxt,__FILE__ . " linje " . __LINE__));
      $antal[$x]-=$r['antal'];
    }
    $vaerdi[$x]=$antal[$x]*$kostpris[$x];
    $lagervaerdi+=$vaerdi[$x];
  }
  return($lagervaerdi);
}
}

// Funktion som laver uppercase på første bogstav i streng. Virker som php funktion 'ucfirst', men med æøå
if (!function_exists('Ømb_ucfirst')) {
  function Ømb_ucfirst($str, $encoding='UTF-8') {
    $firstChar = mb_substr($str, 0, 1, $encoding);
    $then = mb_substr($str, 1, mb_strlen($str, $encoding)-1, $encoding);
    return mb_strtoupper($firstChar, $encoding) . $then;
  }
}

// Funktion som laver uppercase på første bogstav i alle ord i strengen. Virker som php funktion 'ucwords', men med æøå
if (!function_exists('Ømb_ucwords')) {
  function Ømb_ucwords($str) {
    return mb_convert_case($str, MB_CASE_TITLE, "UTF-8");
  }
}
if (!function_exists('Øftptest')) {
  function Øftptest($server,$bruger,$kode) {
    global $db;
    global $exec_path;
    $fp=fopen("../_temp/$db/test.txt","w");
    fwrite ($fp,"Hej der\n");
    fclose($fp);
    $fp=fopen("../_temp/$db/ftpscript1","w");
    fwrite ($fp,"set confirm-close no\nput test.txt\nbye\n");
    fclose($fp);
    $kommando="cd ../_temp/$db\n$exec_path/ncftp ftp://".$bruger.":".$kode."@".$server." < ftpscript1 > ftp1.log ";
    system ($kommando);
    unlink ("../_temp/$db/test.txt");
    $fp=fopen("../_temp/$db/ftpscript2","w");
    fwrite ($fp,"set confirm-close no\nget test.txt\nbye\n");
    fclose($fp);
    $kommando="cd ../_temp/$db\n$exec_path/ncftp ftp://".$bruger.":".$kode."@".$server." < ftpscript2 > ftp2.log ";
    system ($kommando);
    (file_exists("../_temp/$db/test.txt"))?$txt="FTP tjek OK":$txt="Fejl i FTP oplysninger";
    print "<BODY onLoad=\"JavaScript:alert('$txt')\">";
    unlink ("../_temp/$db/test.txt");
    unlink ("../_temp/$db/ftpscript1");
    unlink ("../_temp/$db/ftpscript2");
  }
}
if (!function_exists('Øvalutaopslag')) {
function Øvalutaopslag($amount, $valuta, $transdate) {
  global $connection;
  global $fejltext;
  
  $r = db_fetch_array(db_select("select * from valuta where gruppe = '$valuta' and valdate <= '$transdate' order by valdate desc",__FILE__ . " linje " . __LINE__));
  if ($r['kurs']) {
    $kurs= $r['kurs'];
    $amount=afrund($amount*$kurs/100,2); # decimal rettet fra 3 til 2 20090617 grundet fejl i saldi_58_20090617-2224
  } else {
    $r = db_fetch_array(db_select("select box1 from grupper where art = 'VK' and kodenr = '$valuta'",__FILE__ . " linje " . __LINE__));
    $tmp=dkdato($transdate);
    $fejltext="---";
    print "<BODY onLoad=\"javascript:alert('Ups - ingen valutakurs for $r[box1] den $tmp')\">"; 
  }
  $r = db_fetch_array(db_select("select box3 from grupper where art = 'VK' and kodenr = '$valuta'",__FILE__ . " linje " . __LINE__));
  $diffkonto=$r['box3'];
  
  return array($amount,$diffkonto,$kurs); # 3'die parameter tilfojet 2009.02.10
}}

if (!function_exists('Øregnstartslut')) {
function Øregnstartslut($regnaar) {
  $r=db_fetch_array(db_select("select * from grupper where art = 'RA' and kodenr = '$regnaar'",__FILE__ . " linje " . __LINE__));
  $startmd=$r['box1'];
  $startaar=$r['box2'];
  $slutmd=$r['box3'];
  $slutaar=$r['box4'];
  $regnstart=$startaar.'-'.$startmd.'-01';
  $regnslut=$slutaar.'-'.$slutmd.'-31';
echo "$regnstart $regnslut<br>";
  return($regnstart.chr(9).$regnslut);
}}

######################################################################################################################################
if (!function_exists('ØisSecure')) {
function ØisSecure() {
  return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443;
}}

?>
