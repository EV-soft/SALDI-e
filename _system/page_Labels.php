<?php   $DocFil= '../_system/page_Labels.php';    $DocVer='5.0.0';    $DocRev='2017-02-00';   $ModulNr=2;
/* ## Formål:  Opsætning af Labels                                       
 *             ___   _   _    ___  _         
 *            / __| / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            |___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 */

$pageTitl='Indstil: Labels';
include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
### INDLÆS DATA:
$img= '../_assets/images/saldi-e50x170.png';
$demo= '<center>
<table border="0" cellspacing="0" cellpadding="0"><tbody>
<tr><td></td></tr>
<tr><td align="center"><font face="verdana" size="2">$beskrivelse</font></td></tr>
<tr><td align="center"><font face="verdana" size="2">Pris: $pris ($enhedspris/$enhed)</font></td></tr>
<tr><td align="center"><img style="border:0px solid;width:250px;height:60px;overflow:hidden;" alt="Produkt-billede" src="'.$img.'" (=$img)></td></tr>
<tr><td align="center"><font face="verdana" size="2">$stregkode</font></td></tr>
</tbody></table></center>';
$lbltype= 'vare';

### VIS DATA:
    SpalteTop(240); Rude_TilvalgsMenu();
    NextSpalte();   Rude_Labels($lbltype,$demo);
    SpalteBund();
### GEM DATA:
 
  
//  Til sidst indlæses java-scripter:   
  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>