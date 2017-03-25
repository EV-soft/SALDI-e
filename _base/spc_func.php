<?php   $DocFil= '../_base/spc_func.php';   $DocVer='5.0.0';    $DocRev='2017-03-00';   $modulnr=0;
// Formål:  Specielle funktioner
//             ___   _   _    ___  _
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___|
//
// LICENS & Copyright (c) 2004-2016 DANOSOFT ApS *** Se filen: ../LICENS_Copyright.txt
//



function formularimport($filnavn,$formularnr) {
  global $Ødb_Encode;
$fp=fopen($filnavn,"r");
  if ($fp) {
    if ($formularnr) 
         $qtxt="DELETE FROM tblA_forms WHERE formular='$formularnr'";
    else $qtxt="DELETE FROM tblA_forms";
    db_modify("$qtxt",__FILE__ . " linje " . __LINE__); # 20130819
    while (!feof($fp)) { $linje=fgets($fp);
      if ($Ødb_Encode=="UTF8") $linje= utf8_encode(str_replace("\n","",$linje));
      list($formular, $art, $beskrivelse, $justering, $xa, $ya, $xb, $yb, $str, $color, $font, $fed, $kursiv, $side, $sprog) = explode(chr(9),$linje);
      $formular= trim($formular,"'");             $art= trim($art,"'"); 
      $beskrivelse= trim($beskrivelse,"'");       $justering= trim($justering,"'"); 
      $xa= trim($xa,"'");   $ya= trim($ya,"'");   $xb= trim($xb,"'");   $yb= trim($yb,"'");               
      $str= trim($str,"'");                       $color= trim($color,"'");         
      $font= trim($font,"'");                     $fed= trim($fed,"'");             
      $kursiv= trim($kursiv,"'");                 $side= trim($side,"'");           
      $sprog= trim($sprog,"'");                   $beskrivelse= addslashes($beskrivelse);
      if ($xa>0) {
        $justering= trim($justering); $form= trim($font); $fed= trim($fed); $kursiv= trim($kursiv); $side= trim($side); $sprog= trim($sprog);
        $xa= $xa*1; $ya= $ya*1; $xb= $xb*1; $yb=$yb*1; $str=$str*1; $color=$color*1;
        if (($formularnr && $formular==$formularnr) || !$formularnr) {
          sql_creat('INSERT INTO tblA_forms (formular,art,beskrivelse,xa,ya,xb,yb,justering,str,color,font,fed,kursiv,side,sprog)'.
          'VALUES('.$formular.'","'.$art.'","'.$beskrivelse.'","'.$xa.'","'.$ya.'","'.$xb.'","'.$yb.'","'.$justering.'","'.$str.'","'.
          $color.'","'.$font.'","'.$fed.'","'.$kursiv.'","'.$side.'","'.$sprog.'")', __FILE__, __LINE__);
        }
      }
    }
    fclose($fp);
  }
}
?>

