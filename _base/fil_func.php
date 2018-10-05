<?php   $DocFil= '../_base/fil_func.php';   $DocVer='5.0.0';    $DocRev='2018-07-00';     $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Grundbibliotek for fil-operationer ';
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2018 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 */
//
// Rutiner angående import / export af data filer.
//
// Denne fil er redigeret med tabulator sat til 2 tegn, og ses bedst med det.
// Filer skal gemmes i UTF-8 format uden BOM!
/* 
  Oprettet: 2016-10-00 evs - EV-soft
  Ændrings-Log:
      
 */

if (!function_exists('DetectSeparator')) {
function DetectSeparator($filnavn) {  // Test for feltantal og feltadskiller i fil som skal indlæses (import)
  $fp= fopen($filnavn,"r");
  if ($fp) {
    for ($y=1; $y<4; $y++) $linje=fgets($fp); //  Analyser filens første linier:
    $tmp=$linje;  while ($tmp=substr(strstr($tmp,";"),1))    {$semikolon++;}
    $tmp=$linje;  while ($tmp=substr(strstr($tmp,","),1))    {$komma++;}
    $tmp=$linje;  while ($tmp=substr(strstr($tmp,chr(9)),1)) {$tabulator++;}
    $tmp='';
    if     (($komma>$semikolon)&& ($komma>$tabulator))    {$tmp='Komma';     $char= ",";    $feltantal=$komma;}
    elseif (($semikolon>$tabulator)&&($semikolon>$komma)) {$tmp='Semikolon'; $char= ";";    $feltantal=$semikolon;}     
    elseif (($tabulator>$semikolon)&&($tabulator>$komma)) {$tmp='Tabulator'; $char= chr(9); $feltantal=$tabulator;}     
    if (!$Separator) {$Separator=$tmp;}
    fclose($fp);
  }
  return array($Separator,$char,$feltantal+1);
}}


if (!function_exists('numbrCheck')) { //  Bestem notationen for et tals decimaladskiller
function numbrCheck ($numeric){
  $numeric=trim($numeric);  $notation=1;
  for ($x=0; $x<strlen($numeric); $x++) {
    if (!in_array($numeric{$x}, array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", ",", ".", "+", "-"))) $notation=0;
  }
  if ($notation) {
    for ($x=0; $x<strlen($numeric); $x++) {
      if     ($numeric{$x}==',') $komma++;
      elseif ($numeric{$x}=='.') $punktum++;    
    }
    if     ((!$komma)&&(!$punktum))                       $notation='US';
    elseif (($komma==1)&&(substr($numeric,-3,1)==','))    $notation='DK'; //  1 komma: decimaladskiller
    elseif (($punktum==1)&&(substr($numeric,-3,1)=='.'))  $notation='US'; //  1 punktum: decimaladskiller
    elseif (($komma==1)&&(!$punktum))                     $notation='DK'; //  1 komma: decimaladskiller og ingen tusindadskiller
    elseif (($punktum==1)&&(!$komma))                     $notation='US'; //  1 punktum: decimaladskiller og ingen tusindadskiller
  }
  return $notation;
}}
  
  
function ReadKontoPlan ($filnavn, $splitter, $charset='UTF-8') {
  $fp= fopen($filnavn,"r");
  if ($fp) {  $kontonumre=array();  $ix=0;
    while (!feof($fp)) {
      $skriv_linje=0;
      if ($linje=trim(fgets($fp))) {  $ix++;   $skriv_linje=1;   $felt=array();    $kontotyper=array("H","D","S","Z","R");   $momstyper=array("S","K","E","Y");
        if ($charset=='UTF-8') $linje=utf8_encode($linje);
        $felt = explode($splitter, $linje);
        for ($n=0; $n<=$feltantal; $n++) {
          $felt[$n]=trim($felt[$n]);
                  $feltnavn[$n]= strtolower($feltnavn[$n]);
          if ((substr($felt[$n],0,1) == '"')&&(substr($felt[$n],-1) == '"')) $felt[$n]=substr($felt[$n],1,strlen($felt[$n])-2);
          if    (($feltnavn[$n]== 'Kontonr')&&(($felt[$n]!=$felt[$n]*1)||(in_array($felt[$n],$kontonumre)))) {  $skriv_linje=2; } 
          elseif ($feltnavn[$n]== 'Kontonr') $kontonumre[$ix]=$felt[$n];
          if    (($feltnavn[$n]== 'kontonr')&&($felt[$n]!=$felt[$n]*1)) { $skriv_linje=2; }
          if     ($feltnavn[$n]== 'beskrivelse') { $felt[$n]=addslashes($felt[$n]);  }
          if     ($feltnavn[$n]== 'kontotype') { 
            if ((strlen($felt[$n])>1)||(!in_array($felt[$n],$kontotyper))) {  $skriv_linje=2; } 
            else if  ($felt[$n]== 'Z') $sumkonto=1; else $sumkonto=0;
          } 
          if     ($feltnavn[$n]== 'moms') {  $a=substr($felt[$n],0,1); $b=substr($felt[$n],1);
            if  (($felt[$n])&&((!in_array($a,$momstyper))||($b!=$b*1))) {  $skriv_linje=2; }        
          }
          if    (($feltnavn[$n]== 'fra_kto')&&($sumkonto))  { if (!$felt[$n]) $felt[$n]='0';  if ($felt[$n]!=$felt[$n]*1) { $skriv_linje=2; } } 
          elseif ($feltnavn[$n]== 'fra_kto') $felt[$n]='0';
          if     ($feltnavn[$n]== 'primo')  {
            if (!is_numeric($felt[$n])) { $felt[$n]=usdecimal($felt[$n]); }   
            $balance=$balance+$felt[$n];
          }
          //  ? Valuta Genvej
        }
      }   
      if ($skriv_linje==1){ $a='';  $b='';
        for ($y=0; $y<=$feltantal; $y++) {
          if ($y>0 && $feltnavn[$y]) {  if ($a) { $a=$a.",";  $b=$b.",";  } }
          if ($feltnavn[$y]) {  $a=$a.$feltnavn[$y];  $b=$b."'".$felt[$y]."'";  }
        }
        //  db_modify("insert into kontoplan($a, regnskabsaar) values ($b, '$regnskabsaar')",__FILE__ . " linje " . __LINE__);
        
      }
    }
    fclose($fp);
  }
}

// Indlæs data fra fil til array. Separator skifter automatisk fra TAB til "," hvis TAB ikke findes i først indlæste linie.
function ImportTabFile ($fn,$startLin=0,$charset='UTF-8') {
  $fp= fopen($fn,"r");
  if ($fp) {  $felter=array();  $skiller= chr(9);  $Lin=0;
    while (!feof($fp)) {
      if ($txtline= fgets($fp)) { $Lin++;
        if (strpos($txtline,chr(9))==0) $skiller= '","';  //  csv
        if (strpos($txtline,'"'.chr(9).'"')!=0) $textsep='"'; else $textsep=' ';
        if ($charset=='UTF-8') $txtline= addslashes(utf8_encode($txtline)); 
        //  Kommentar-linie overspringes (:-tegnet angiver at efterfølgende er kommentarer, f.eks. felt-navne)
        if ($txtline[0]==':') $startLin= $Lin+0; 
        else 
        { $LinFeltr= explode($skiller, $txtline);   $rawFelt= array();
            //  foreach ($LinFeltr as $felt)  array_push($rawFelt, trim(trim($felt,'"'),"'"));
            foreach ($LinFeltr as $felt)  array_push($rawFelt, trim($felt,$textsep));
            if ($Lin>=$startLin) array_push($felter, $rawFelt);
        }
      }
    } fclose($fp);
  } return $felter;
}

// Udskriv tabel til fil, Separator skal angives: TAB:chr(9) eller "," 
function ExportTabFile ($fn,$skiller='","',$Tabel2D) {// Filnavn angives UDEN filtype, som tilføjes automatisk
  if ($skiller=='","') $fn.= '.csv'; else $fn.= '.tab';
  $fp= fopen($fn,"w");
  if ($fp) {
    foreach ($Tabel2D as $tblrow) {$line= substr($skiller,2,1); 
      foreach ($tblrow as $tblcol) $line.= $tblcol.$skiller;
      $line= rtrim($line,',"'.chr(9));
      if ($skiller=='","') $line.= '"';
      fwrite($fp,$line."\n");
    };  fclose($fp);
  }
}


//  Logning af DB-modifikationer
if (!function_exists('transaktion')) {
	function transaktion($qtext){ global $brugernavn, $db_type, $db;
		$fp=fopen("../_temp/".$db."/.ht_modify.log","a");
		fwrite($fp,"-- ".$brugernavn." ".date("Y-m-d H:i:s").": ".$qtext."\n");
		fwrite($fp,$qtext.";\n");
			if ($db_type=="mysql") 
        mysql_query($qtext);
      else pg_query($qtext);
	}
}


//  Dan filliste recursivt, og gem oplysninger i array
function getFileList($dir, $recurse=false, $depth=false)
{ $return = array();
  if(substr($dir, -1) != "/") $dir .= "/";    // tilføj slash, hvis den mangler
  $dirPtr = @dir($dir) or die('getFileList: Åbning af mappe '.$dir.' for læsning... ');    // opret pointer til mappen og læs fil-listen
  while (false !== ($entry = $dirPtr->read())) {
    if (($entry == ".") or ($entry == "..")) continue;  // overspring system dir
    $de= $dir.$entry;
    //  if ($entry[0] == ".") continue;                 // overspring hidden filer
    //  if ($entry[0] == ".") echo '<br>Hidden: '.$de;
    if (is_dir($de)) {
      $return[] = array( "path" => $dir, "name" => $entry.'/',   "type" => filetype($de),   "size" => 0,    "lastmod" => filemtime($de) );
      $mappe= $de.'/';
      if ($recurse && is_readable($mappe))  {
        if($depth === false) {
          $return = array_merge($return, getFileList($mappe, true));
        } elseif($depth > 0) {
          $return = array_merge($return, getFileList($mappe, true, $depth-1));
        }
      }
    } elseif (is_readable($de)) {
      $return[] = array( "path" => $dir, "name" => $entry, "type" => mime_content_type($de), "size" => filesize($de), "lastmod" => filemtime($de) );
    } else echo '<br>Overspring: '.$de;
  } $dirPtr->close();
  return $return;
}
