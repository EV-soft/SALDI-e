<?php   $DocFil= '../_lager/page_Varer.php';    $DocVer='5.0.0';    $DocRev='2018-09-20';     $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Vis varelister og varekort';
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2018 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
  Oprettet: 2016-08-00 evs - EV-soft
  Ændrings-Log:
      
 * 
 */

  $pageTitl='Lager varer';
  $GLOBALS["ØProgModu"]= ['prim']; ## prim eller/og sekd og comm
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
  DocAlder($DocRev);
    
  $DATA= sql_readB($qstr='SELECT varenr, enhed, beskrivelse, FORMAT(kostpris,2), FORMAT(salgspris,2), retail_price, notes, gruppe, beholdning, location '.
                         'FROM tblA_product ',__FILE__, __LINE__);
#-    $DATX=[]; //  Hvis databasen indeholder forkert tegnkodning:
#-    foreach ($DATA as $dat) {
#-//      $dat['beskrivelse']= utf8_decode($dat['beskrivelse']); array_push($DATX,$dat); 
#-      $dat['beskrivelse']= str_replace(array("Ã¦","Ã¸","Ã¥","Ã†","Ã˜","Ã…"),array("æ","ø","å","Æ","Ø","Å"),$dat['beskrivelse']); array_push($DATX,$dat); 
#-    }
    Panl_Varer($DATA);  # Demo!
    skilleLin();
    Wall_Varekort();  # Demo!
    htm_nl();
    echo '</div></div></div>';  // Problem: ubalance i Wall_Varekort?
    
  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode

/*
Korriger i DB:
update `tblA_product` set beskrivelse = replace(beskrivelse, "Ã¦", "æ")
update `tblA_product` set beskrivelse = replace(beskrivelse, "Ã¸", "ø")
update `tblA_product` set beskrivelse = replace(beskrivelse, "Ã¥", "å")
update `tblA_product` set beskrivelse = replace(beskrivelse, "Ã¦", "æ")

     $streng = str_replace(array("Ã¦","Ã¸","Ã¥","Ã†","Ã˜","Ã…"),array("æ","ø","å","Æ","Ø","Å"),$streng);

echo $first_name; // print áááááábéééééébšššš
$trans = array("á" => "a", "é" => "e", "š" => "s");
echo strtr("áááááábéééééébšššš", $trans); // print aaaaaabeeeeeebssss
echo strtr($first_name,$trans);  // print áááááábéééééébšššš

    $pattern = array("'é'", "'è'", "'ë'", "'ê'", "'É'", "'È'", "'Ë'", "'Ê'", "'á'", "'à'", "'ä'", "'â'", "'å'", "'Á'", "'À'", "'Ä'", "'Â'", "'Å'", "'ó'", "'ò'", "'ö'", "'ô'", "'Ó'", "'Ò'", "'Ö'", "'Ô'", "'í'", "'ì'", "'ï'", "'î'", "'Í'", "'Ì'", "'Ï'", "'Î'", "'ú'", "'ù'", "'ü'", "'û'", "'Ú'", "'Ù'", "'Ü'", "'Û'", "'ý'", "'ÿ'", "'Ý'", "'ø'", "'Ø'", "'œ'", "'Œ'", "'Æ'", "'ç'", "'Ç'");
    $replace = array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E', 'a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A', 'A', 'o', 'o', 'o', 'o', 'O', 'O', 'O', 'O', 'i', 'i', 'i', 'I', 'I', 'I', 'I', 'I', 'u', 'u', 'u', 'u', 'U', 'U', 'U', 'U', 'y', 'y', 'Y', 'o', 'O', 'a', 'A', 'A', 'c', 'C'); 
    $chain = preg_replace($pattern, $replace, $chain);


 Repair utf-8 strings that contain iso-8599 encoded utf-8 characters
encoding_repairer.rb
class EncodingRepairer

  REPLACEMENTS = {
    "â‚¬" => "€", "â€š" => "‚", "â€ž" => "„", "â€¦" => "…", "Ë†"  => "ˆ",
    "â€¹" => "‹", "â€˜" => "‘", "â€™" => "’", "â€œ" => "“", "â€"  => "”",
    "â€¢" => "•", "â€“" => "–", "â€”" => "—", "Ëœ"  => "˜", "â„¢" => "™",
    "â€º" => "›", "Å“"  => "œ", "Å’"  => "Œ", "Å¾"  => "ž", "Å¸"  => "Ÿ",
    "Å¡"  => "š", "Å½"  => "Ž", "Â¡"  => "¡", "Â¢"  => "¢", "Â£"  => "£",
    "Â¤"  => "¤", "Â¥"  => "¥", "Â¦"  => "¦", "Â§"  => "§", "Â¨"  => "¨",
    "Â©"  => "©", "Âª"  => "ª", "Â«"  => "«", "Â¬"  => "¬", "Â®"  => "®",
    "Â¯"  => "¯", "Â°"  => "°", "Â±"  => "±", "Â²"  => "²", "Â³"  => "³",
    "Â´"  => "´", "Âµ"  => "µ", "Â¶"  => "¶", "Â·"  => "·", "Â¸"  => "¸",
    "Â¹"  => "¹", "Âº"  => "º", "Â»"  => "»", "Â¼"  => "¼", "Â½"  => "½",
    "Â¾"  => "¾", "Â¿"  => "¿", "Ã€"  => "À", "Ã‚"  => "Â", "Ãƒ"  => "Ã",
    "Ã„"  => "Ä", "Ã…"  => "Å", "Ã†"  => "Æ", "Ã‡"  => "Ç", "Ãˆ"  => "È",
    "Ã‰"  => "É", "ÃŠ"  => "Ê", "Ã‹"  => "Ë", "ÃŒ"  => "Ì", "ÃŽ"  => "Î",
    "Ã‘"  => "Ñ", "Ã’"  => "Ò", "Ã“"  => "Ó", "Ã”"  => "Ô", "Ã•"  => "Õ",
    "Ã–"  => "Ö", "Ã—"  => "×", "Ã˜"  => "Ø", "Ã™"  => "Ù", "Ãš"  => "Ú",
    "Ã›"  => "Û", "Ãœ"  => "Ü", "Ãž"  => "Þ", "ÃŸ"  => "ß", "Ã¡"  => "á",
    "Ã¢"  => "â", "Ã£"  => "ã", "Ã¤"  => "ä", "Ã¥"  => "å", "Ã¦"  => "æ",
    "Ã§"  => "ç", "Ã¨"  => "è", "Ã©"  => "é", "Ãª"  => "ê", "Ã«"  => "ë",
    "Ã¬"  => "ì", "Ã­"   => "í", "Ã®"  => "î", "Ã¯"  => "ï", "Ã°"  => "ð",
    "Ã±"  => "ñ", "Ã²"  => "ò", "Ã³"  => "ó", "Ã´"  => "ô", "Ãµ"  => "õ",
    "Ã¶"  => "ö", "Ã·"  => "÷", "Ã¸"  => "ø", "Ã¹"  => "ù", "Ãº"  => "ú",
    "Ã»"  => "û", "Ã¼"  => "ü", "Ã½"  => "ý", "Ã¾"  => "þ", "Ã¿"  => "ÿ"
  }

  def repair(value)
    value or return
    value.gsub!(Regexp.new(REPLACEMENTS.keys * ?|), REPLACEMENTS)
  end
end
*/

?>  
