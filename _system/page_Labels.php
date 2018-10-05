<?php   $DocFil= '../_system/page_Labels.php';    $DocVer='5.0.0';    $DocRev='2018-09-20';   $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Opsaetning af Labels';
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

$pageTitl='Indstil: Labels';
$GLOBALS["ØProgModu"]= ['sekd']; ## prim eller/og sekd og comm
include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
### INDLÆS DATA:
$img= '../_assets/images/saldi-e50x170.png';
$demo= '<center>
<table border="0" cellspacing="0" cellpadding="0"><tbody>
<tr><td></td></tr>
<tr><td align="center"><font style="font-family:verdana; font-size:14px;" >$beskrivelse</font></td></tr>
<tr><td align="center"><font style="font-family:verdana; font-size:14px;" >Pris: $pris ($enhedspris/$enhed)</font></td></tr>
<tr><td align="center"><img  style="border:0px solid;width:250px;height:60px;overflow:hidden;" alt="Produkt-billede" src="'.$img.'" (=$img)></td></tr>
<tr><td align="center"><font style="font-family:barcode; font-size:32px;">*$stregkode*</font></td></tr>
</tbody></table></center>';
$lbltype= 'vare';

### VIS DATA:
    SpalteTop(240);   Panl_TilvalgsMenu();
    NextSpalte(640);  Panl_Labels($lbltype,$demo);
    SpalteBund();
### GEM DATA:
 
  
//  Til sidst indlæses java-scripter:   
  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>