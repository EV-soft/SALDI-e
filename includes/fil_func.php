<?php   $DocFil= '../includes/fil_func.php';   $DocVer='5.0.0';    $DocRev='2016-10-00';   $modulnr=0;
//             ___   _   _    ___  _         
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___|
//                                           
// LICENS & Copyright (c) 2004-2016 DANOSOFT ApS *** Se filen: ../LICENS_Copyright.txt
//
// Rutiner angående import / export af data filer.
//
// Afhængig af: 
//  
// Denne fil er redigeret med tabulator sat til 2 tegn, og ses bedst med det.
// Filer skal gemmes i UTF-8 format uden BOM!
// 2016.10.00 ev - EV-soft

//  include("../includes/std_func.php"); # Sidens indledende html-kode


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

// Indlæs data fra fil, Separator skifter automatisk fra TAB til "," hvis TAB ikke findes i første indlæste linie.
function ImportTabFile ($fn,$startLin=0,$charset='UTF-8') {
  $fp= fopen($fn,"r");
  if ($fp) {  $felter=array();  $skiller= chr(9);  $Lin=0;
    while (!feof($fp)) {
      if ($linje= fgets($fp)) { $Lin++;
        if (strpos($linje,chr(9))==0) $skiller= '","';
        if ($charset=='UTF-8') $linje= utf8_encode($linje);
        $LinFeltr= explode($skiller, $linje);   $rawFelt= array();
        foreach ($LinFeltr as $felt) array_push($rawFelt, trim($felt,'"'));
        if ($Lin>$startLin) array_push($felter, $rawFelt);
      }
    }
    fclose($fp);
  }
  return $felter;
}

