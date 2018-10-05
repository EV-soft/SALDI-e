<?php   $DocFil= '../_base/page_Hovedmenu.php';    $DocVer='5.0.0';    $DocRev='2018-07-00';   $DocIni='evs';  $ModulNr=2;
/* ## Purpose:'SALDI's hovedmenu med forklaringer';
 *
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * ## LICENS & Copyright (c) 2004-2018 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
  Oprettet: 2017-08-00 evs - EV-soft
  Ændrings-Log:
      
 *
 */
  $pageTitl='Hovedmenu';
  $GLOBALS["ØProgModu"]= ['prim']; ## prim eller/og sekd og comm
  include("../_base/htm_pagePrepare.php"); ## Sidens indledende html-kode
  if ($GLOBALS['$Ødebug']) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);

### INDLÆS DATA:
  if ($vis_prodkt) $tblwd='918px'; else $tblwd='790px';
### VIS DATA:
  echo '<table style="width:'.$tblwd.'; margin-left:10px; ">';
  echo '<tr style="text-align:center; height:70px;">';
  if ($Øvis_finans)  echo '<td style="width:128px; font-size:14px;">'.tolk('@I finans fører du dagligt Regnskab').'</td>';
  if ($Øvis_debitor) echo '<td style="width:128px; font-size:14px;">'.tolk('@Administration af Salg til kunder').'</td>';
  if ($Øvis_kreditor)echo '<td style="width:128px; font-size:14px;">'.tolk('@Administration af Køb fra leverandører').'</td>';
  if ($Øvis_prodkt)  echo '<td style="width:128px; font-size:14px;">'.tolk('@Produktion af Produkter').'</td>';
  if ($Øvis_lager)   echo '<td style="width:128px; font-size:14px;">'.tolk('@Administration af Produkter til salg').'</td>';
  echo '<td style="width:128px; font-size:14px;">'.tolk('@Program vedligeholdelse og indstillinger').'</td>';
  echo '<td style="width:128px; font-size:14px;">'.tolk('@Bonus-ting').',<br>'.tolk('@info og hjælp').'</td>';
  echo '</tr>';
  echo '<tr style="text-align:center; height:40px;">';
  echo '<td colspan="9"; style="width:128px; font-size:14px;">'.tolk('@Hold musen over menu-teksterne øverst, for at se undermenuer og hjælpetekster').'</td>';
  echo '</tr>';
  echo '</table>';
  
//  Til sidst indlæses java-scripter:   
  include("../_base/htm_pageFinalize.php"); ## Sidens afsluttende html-kode
?>