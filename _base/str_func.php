<?php   $DocFil= '../_base/str_func.php';   $DocVer='5.0.0';    $DocRev='2017-12-00';     $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Specielle string-funktioner';
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

if (!function_exists('periodeoverskrifter')) {
  function periodeoverskrifter ($periodeantal, $periode_aar, $periode_md, $periode_dag=1, $periode_laengde="regnskabsmaaned", $regnskabsaar="") {
## Periodelængder kan være dag, uge, maaned, regnskabsmaaned eller kvartal (eller blot det foerste bogstav)
    setlocale(LC_TIME, "da_DK","da","da_DK.utf8");
    $retur=array();
    $trin = 1;
    $periode_laengde = strtolower(substr($periode_laengde, 0, 1));
    if ( $periode_laengde == substr("uge", 0, 1) ) {
      $trin = 7;
      $periodeantal = $trin * $periodeantal;
    }
    if ( $periode_laengde == substr("kvartal", 0, 1) ) {
      $trin = 3;
      $periodeantal = $trin * $periodeantal;
    }
    for ($z=0; $z<$periodeantal; $z=$z+$trin) {
      if ( $periode_laengde == substr("dag", 0, 1) ) {
        $periode_tidsstempel = mktime(12, 0, 0, $periode_md, $periode_dag+$z, $periode_aar);
        if ( strftime("%u", $periode_tidsstempel) > 5 ) { # Loerdag eller soendag med det danske oe i navnet
          # $periode_kort = ucfirst(substr(strftime("%a", $periode_tidsstempel),0,3))."&nbsp;".date("j/n",$periode_tidsstempel);
          $periode_kort = ucfirst(substr(strftime("%a", $periode_tidsstempel),0,1))."ø&nbsp;".date("j/n",$periode_tidsstempel);
        } else {
          $periode_kort = ucfirst(substr(strftime("%a", $periode_tidsstempel),0,2))."&nbsp;".date("j/n",$periode_tidsstempel);
        }
        $periode_lang = ucfirst(strftime("%A %e. %B %Y",$periode_tidsstempel));
      } elseif ( $periode_laengde == substr("uge", 0, 1) ) {
        $periode_tidsstempel = mktime(12, 0, 0, $periode_md, $periode_dag+$z, $periode_aar);
        $periode_ugedag = strftime("%u", $periode_tidsstempel);
        $periode_start = mktime(12, 0, 0, $periode_md, $periode_dag+$z+1-$periode_ugedag, $periode_aar);
        $periode_slut = mktime(12, 0, 0, $periode_md, $periode_dag+$z+7-$periode_ugedag, $periode_aar);
        $periode_kort = strftime("u%V'%g",$periode_tidsstempel);
        $periode_lang = strftime("Uge %V i år %G",$periode_tidsstempel);
        $periode_lang .= " (".date("d/m",$periode_start)." - ".date("d/m",$periode_slut).")";
      } else {
        $periode_tidsstempel= mktime(12, 0, 0, $periode_md+$z, $periode_dag, $periode_aar);
        if ( $periode_laengde == substr("kvartal", 0, 1) ) {
          $periode_slut = mktime(12, 0, 0, $periode_md+$z+3, 0, $periode_aar);
          $periode_kvartal = floor((date("m",$periode_tidsstempel)-1)/3)+1;
          $periode_kort = $periode_kvartal.". kv'". strftime("%y",$periode_tidsstempel);
          $periode_lang = $periode_kvartal.". kvartal ". strftime("%Y",$periode_tidsstempel);
          $periode_lang .= " (".date("d/m",$periode_tidsstempel)." - ".date("d/m",$periode_slut).")";
        } elseif ( $periode_laengde == substr("maaned", 0, 1) ) {
          $periode_kort = ucfirst(strftime("%b'%y",$periode_tidsstempel));
          $periode_lang = ucfirst(strftime("%B %Y",$periode_tidsstempel));
        } elseif ( $periode_laengde == substr("regnskabsmaaned", 0, 1) ) {
          $periode_kort = ucfirst(strftime("%b'%y",$periode_tidsstempel));
          $periode_lang = ucfirst(strftime("%B %Y",$periode_tidsstempel));
          $periode_lang .= " (".($z+1).". regnskabsmåned i regnskabsåret";
          if ( $regnskabsaar ) $periode_lang .= " ".$regnskabsaar;
          $periode_lang .= ")";
          
        } else {
          $periode_kort = ($z+1).".";
          $periode_lang = ($z+1).". periode";
        }
      }
      array_push($retur, ['@'.$periode_kort, '5%','','tal2d', 'right', '@'.$periode_lang,'']);
    }
    return $retur; # array
  }
}
?>

