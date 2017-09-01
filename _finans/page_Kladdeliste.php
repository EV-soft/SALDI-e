<?php   $DocFil= '../_finans/page_Kladdeliste.php';   $DocVer='5.0.0';    $DocRev='2017-08-00';   $modulnr=0;
/* Formål:  Rediger kladder
 * Denne fil er oprettet af EV-soft  i 2017.
 *             ___   _   _    ___  _         
 *            / __| / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            |___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 * 2016.08.00 evs - EV-soft
 *
 */
 
  $pageTitl= 'Kasse kladder';  # tolk('@Kasse kladder');
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
  if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
### INDLÆS DATA:
    
## Forberedelse ikke taget i brug endnu:
  $sort=isset($_GET['sort'])? $_GET['sort']:Null;
  $order=isset($_GET['order'])? $_GET['order']:Null;  # Tidl: $rf
  $user=isset($_GET['user'])? $_GET['user']:Null;     # Tidl: $vis
  $content= '150;URL=page_Kladdeliste.php.php?sort=$sort&order=$order&user=$user';
  
  if (isset($_GET['sort'])) { $cookievalue="$sort;$order;$user";  setcookie("saldi_kladdeliste", $cookievalue, strtotime('+30 days'));  } 
  else list ($sort,$order,$user) = explode(";", $_COOKIE['saldi_kladdeliste']);
  if (!$sort) { $sort = "id";   $order = "desc"; };
  if ($user=='alle') { $param='?sort=$sort&order=$order';}  else {$param='?sort=$sort&order=$order&user=alle';};

  $Tip= 'Klik her for at sortere på ';
  if (!$order) $x='&order=desc&user=$user'; else $x='&user=$user';
  if ($sort== 'id')             {$param='?sort=id'.$x;              $Lbl='@Id';         $Tip.= $Lbl;}
  if ($sort== 'kladdedate')     {$param='?sort=kladdedate'.$x;      $Lbl='@Dato';       $Tip.= $Lbl;}
  if ($sort== 'oprettet_af')    {$param='?sort=oprettet_af'.$x;     $Lbl='@Ejer';       $Tip.= $Lbl.' (den der har oprettet kassekladden)';}
  if ($sort== 'kladdenote')     {$param='?sort=kladdenote'.$x;      $Lbl='@Bemærkning'; $Tip.= $Lbl;}
  if ($sort== 'bogforingsdate') {$param='?sort=bogforingsdate'.$x;  $Lbl='@Bogført';    $Tip = '';}
  if ($sort== 'bogfort_af')     {$param='?sort=bogfort_af'.$x;      $Lbl='@Af';         $Tip.= '"bogført af"';}
  # '<a href=kladdeliste.php'.$param>$Lbl</a>
  $tjek=0;
    
  if ($user == 'alle') $user = ''; else $user="and oprettet_af = '".$brugernavn."'";
  $tidspkt=date("U");
  #$query = db_select("select * from kladdeliste where bogfort = '-' $user order by $sort $rf",__FILE__ . " linje " . __LINE__);

### VIS DATA:
dvl_ekko(' page_Kladdeliste 1 ');
  Rude_Kladderedigering();
### GEM DATA:
  
/* 
Luk     Kladdeliste     Ny
          Vis alle
!Id !Dato !Ejer !Bemærkning !Bogført  af
3 08-09-2016    s-admin Test: Liste 1 -
4 08-09-2016    s-admin Test: Liste 1 -


Luk     Kassekladde 3   Ny
Bemærkning:   Test: Liste 1
!Bilag  !Dato         Bilagstekst D/K   Debet   D/K Kredit  Fakturanr.  !Beløb  Valuta   u/m
3     08-09-2016    Tekst         D   5555    F           543         33      DK

$rf = "desc"/Null;
Gl: &rf-=rækkefølge => Ny: $order

print "<table width=\"100%\" height=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tbody>
    <tr><td height = \"25\" align=\"center\" valign=\"top\">
    <table width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"0\"><tbody>";
print "<td width=\"10%\"  title=\"Klik her for at lukke kladdelisten\" $top_bund><font face=\"Helvetica, Arial, sans-serif\" color=\"#000066\">";

if ($popup) print "<a href=../includes/luk.php accesskey=L>Luk</a></td>";   else print "<a href=../index/menu.php accesskey=L>Luk</a></td>";
print "<td width=\"80%\" $top_bund><font face=\"Helvetica, Arial, sans-serif\" color=\"#000066\">Kladdeliste</td>";
if ($popup) 
print "<td width=\"10%\" title=\"Klik her for at oprette en ny kassekladde\" $top_bund onClick=\"javascript:kladde=window.open('kassekladde.php?returside=kladdeliste.php&tjek=-1','kladde','$jsvars');kladde.focus();\">
    <a href=kladdeliste.php?sort=$sort&rf=$rf&vis=$vis accesskey=N>Ny</a></td>";
else 
print "<td width=\"10%\" title=\"Klik her for at oprette en ny kassekladde\" $top_bund>
    <a href=kassekladde.php?returside=kladdeliste.php&tjek=-1 accesskey=N>Ny</a></td>";   


print "</tbody></table></td></tr>
      <tr><td valign=\"top\"><table cellpadding=\"1\" cellspacing=\"1\" border=\"0\" width=\"100%\" valign = \"top\">";

if ($vis=='alle') {
print "<tr><td colspan=6 align=center>
    <a href=kladdeliste.php?sort=$sort&rf=$rf>vis egne</a></td></tr>";}
else {
print "<tr><td colspan=6 align=center title='Klik her for at se alle kladder'>
    <a href=kladdeliste.php?sort=$sort&rf=$rf&vis=alle>Vis alle</a></td></tr>";}

if ((!isset($linjebg))||($linjebg!=$bgcolor)) {$linjebg=$bgcolor; $color='#000000';}
else {$linjebg=$bgcolor5; $color='#000000';}
print "<tr bgcolor=\"$linjebg\">";

SortHead($sort, $sortKey='id',              $rf, $Vis, $TableList='kladdeliste.php', $head='Id',          $Tip='Klik her for at sortere på ID');
SortHead($sort, $sortKey='kladdedate',      $rf, $Vis, $TableList='kladdeliste.php', $head='Dato',        $Tip='Klik her for at sortere på dato');
SortHead($sort, $sortKey='oprettet_af',     $rf, $Vis, $TableList='kladdeliste.php', $head='Ejer',        $Tip='Klik her for at sortere på ejer (den der har oprettet kassekladden)');
SortHead($sort, $sortKey='kladdenote',      $rf, $Vis, $TableList='kladdeliste.php', $head='Bemærkning',  $Tip='Klik her for at sortere på bemærkning');
SortHead($sort, $sortKey='bogforingsdate',  $rf, $Vis, $TableList='kladdeliste.php', $head='Bogført',     $Tip='');
SortHead($sort, $sortKey='bogfort_af',      $rf, $Vis, $TableList='kladdeliste.php', $head='Af',          $Tip='Klik her for at sortere på "bogført af"');

print "</tr>\n";

function SortHead($sort, $sortKey, $rf, $Vis, $TableList, $head, $Tip) {  
if (($sort == $sortKey)&&(!$rf)) {print "<td>             <b><a href=$TableList?sort=$sortKey&rf=desc&vis=$vis>$head</a></b></td>\n";}    # fa-sort 
else                             {print "<td title=$Tip>  <b><a href=$TableList?sort=$sortKey&vis=$vis        >$head</a></b></td>\n";}
}
*/

  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  