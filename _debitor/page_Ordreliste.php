<?php      $DocFil= '../_debitor/page_Ordreliste.php';   $DocVer='5.0.0';     $DocRev='2017-02-00';      $modulnr=5;
// Formål:  Vis debitor ordrer.
//             ___   _   _    ___  _
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___|
//
// LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
//
// 2016.08.00 ev - EV-soft

$pageTitl='Salgs ordrer';
include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
### INDLÆS DATA:


 
##- #ob_start();
##- @session_start();
##- $s_id=session_id();

##- echo '<script LANGUAGE="JavaScript"><!--function MasseFakt(tekst){ var agree = confirm(tekst);  if (agree) return true ;  else return false ;} // --></script>';
##- $title="Ordreliste - Debitorer";


### INITIER VARIABLE:
//- function htm_NullVariabler($namelist=['']) { foreach ($namelist as $name) {global $$name; $name = NULL; }}

htm_NullVariabler(['check_all','ny_sort','dk_dg','checked','fakturadatoer','fakturanumre','firma','firmanavn','firmanavn_ant',  //  $check_all=NULL; $ny_sort=NULL;
                  'genfakt','genfaktdatoer','hreftext','hurtigfakt','konto_id','kontonumre','lev_datoer','linjebg',             //  $dk_dg=NULL; $checked=NULL;
                  'ordredatoer','ordrenumre','ref','summer','totalkost','tr_title','understreg','vis_projekt','vis_ret_next']); //  $fakturadatoer=NULL;  $fakturanumre=NULL; $firma=NULL;  $firmanavn=NULL;
$find=array();                                                                                                                  //  $firmanavn_ant=NULL;  $genfakt=NULL;  $genfaktdatoer=NULL;
                                                                                                                                //  $hreftext=NULL; $hurtigfakt=NULL; 
                                                                                                                                //  $konto_id=NULL; $kontonumre=NULL; 
                                                                                                                                //  $lev_datoer=NULL; $linjebg=NULL; 
                                                                                                                                //  $ordredatoer=NULL;  $ordrenumre=NULL;
                                                                                                                                //  $ref=NULL;  $summer=NULL;   $totalkost=NULL;  $tr_title=NULL;
                                                                                                                                //  $understreg=NULL;  $vis_projekt=NULL;  $vis_ret_next=NULL;   
                                                                                                                                //  $find=array();
//  include("../_config/connect.php");  Indlæst i htm_pageHead
# include("../includes/online.php");
//  include("../includes/std_func.php");  Indlæst i htm_pageHead
# include("../includes/udvaelg.php");

### OPDATER VARIABLE:
//- function htm_GetVariabler($namelist=['']) { foreach ($namelist as $name) {global $$name; $name = if_isset($_GET[$name]); }}

htm_GetVariabler(['id','konto_id','returside','valg','sort','nysort','kontoid','genberegn','start']);     //  $id = if_isset($_GET['id']);
$valg= strtolower($valg);                                                                                 //  $konto_id = if_isset($_GET['konto_id']);
                                                                                                          //  $returside=if_isset($_GET['returside']);
                                                                                                          //  $valg= strtolower(if_isset($_GET['valg']));
                                                                                                          //  $sort = if_isset($_GET['sort']);
                                                                                                          //  $nysort = if_isset($_GET['nysort']);
                                                                                                          //  $kontoid= if_isset($_GET['kontoid']);
                                                                                                          //  $genberegn = if_isset($_GET['genberegn']);
                                                                                                          //  $start = if_isset($_GET['start']);

if (!$returside && $konto_id && !$popup) $returside="debitorkort.php?id=$konto_id";

// TEST: $r2= sql_readB("select * from tekster where sprog_id = 1", __FILE__, __LINE__);   Vis_Data($r2);

### HENT DB-VÆRDIER:

## hurtigfakt:
if (sql_readB("select id from grupper where art = 'DIV' and kodenr = '3' and box4='on'",__FILE__, __LINE__)) $hurtigfakt='on';  ##? if (db_fetch_array(db_select("select id from grupper where art = 'DIV' and kodenr = '3' and box4='on'",__FILE__ . " linje " . __LINE__))) $hurtigfakt='on';

## valg:
if ($valg=="tilbud" && $hurtigfakt) $valg="ordrer"; 
if (!$valg) $valg="ordrer";
$tjek=array("tilbud","ordrer","faktura","pbs");
if (!in_array($valg,$tjek)) $valg='ordrer';

## Sortering:
$sort=str_replace("ordrer.","",$sort);
if ($sort && $nysort==$sort) $sort=$sort." desc";
elseif ($nysort) $sort=$nysort;

## Sidste row: ?
$r2= sql_readB("select max(id) as id from grupper",__FILE__, __LINE__);  // Vis_Data($r2); ##?  $r2=db_fetch_array(db_select("select max(id) as id from grupper",__FILE__ . " linje " . __LINE__));

## pbs:
if ($r= sql_readB("select id from adresser where art = 'S' and pbs_nr > '0'",__FILE__, __LINE__)) 
  $pbs=1; else $pbs=0;    ##?     if ($r=db_fetch_array(db_select("select id from adresser where art = 'S' and pbs_nr > '0'",__FILE__ . " linje " . __LINE__))) {##?      $pbs=1;##?     } else $pbs=0;

if (!$r= sql_readB("select id from grupper where art = 'OLV' and kode='$valg' and kodenr = '$bruger_id'",__FILE__, __LINE__)) {    ##?     if (!$r=db_fetch_array(db_select("select id from grupper where art = 'OLV' and kode='$valg' and kodenr = '$bruger_id'",__FILE__ . " linje " . __LINE__))) {
##?       if ($valg=="tilbud") {
##?         $box3="ordrenr,ordredate,kontonr,firmanavn,ref,sum";                        //  box3: Tabelkolonner   box2: returside
##?         $box5="right,left,left,left,left,right";                                    //  box5: Feltjustering
##?         $box4="50,100,100,150,100,100";                                             //  box4: Feltbredder
##?         $box6="Tilbudsnr.,Tilbudsdato,Kontonr.,Firmanavn,S&aelig;lger,Tilbudssum";  //  box6: Kolonnetitler   box7: Linjeantal    box8: sort    box9: find
##?       } elseif ($valg=="ordrer") {
##?         $box3="ordrenr,ordredate,levdate,kontonr,firmanavn,ref,sum";                  //  tilbud:   ordrenr,ordredate,                                        kontonr,firmanavn,ref,sum
##?         $box5="right,left,left,left,left,left,right";                                 //  ordrer:   ordrenr,ordredate,levdate,                                kontonr,firmanavn,ref,sum
##?         $box4="50,100,100,100,150,100,100";                                           //  faktura:  ordrenr,ordredate,        fakturanr,fakturadate,nextfakt, kontonr,firmanavn,ref,sum
##?         $box6="Ordrenr.,Ordredato,Levdato,Kontonr.,Firmanavn,S&aelig;lger,Ordresum";
##?       } elseif ($valg=="faktura") {
##?         $box3="ordrenr,ordredate,fakturanr,fakturadate,nextfakt,kontonr,firmanavn,ref,sum";
##?         $box5="right,left,right,left,left,left,left,left,right";
##?         $box4="50,100,100,100,100,150,100,100,100";
##?         $box6="Ordrenr.,Ordredato,Fakt.nr.,Fakt.dato,Genfakt.,Kontonr.,Firmanavn,S&aelig;lger,Fakturasum";
##?       }
##?     $r2=db_fetch_array(db_select("select max(id) as id from grupper",__FILE__ . " linje " . __LINE__));
##?       db_modify("insert into grupper (beskrivelse,kode,kodenr,art,box2,box3,box4,box5,box6,box7) values ('Ordrelistevisning','$valg','$bruger_id','OLV','$returside','$box3','$box4','$box5','$box6','100')",__FILE__ . " linje " . __LINE__);
     } else {
##?       $r=db_fetch_array(db_select("select box2,box7,box8,box9 from grupper where art = 'OLV' and kode='$valg' and kodenr = '$bruger_id'",__FILE__ . " linje " . __LINE__)); 
##?       if (!$returside) {
##?         $returside=$r['box2'];
##?         if (strstr($returside,"debitorkort.php?id=") && !$konto_id) {
##?           list($tmp,$konto_id)=explode("=",$returside);
##?         }
##?       }
##?       $linjeantal=$r['box7'];
##?       if (!$sort) $sort=$r['box8'];
##?       $find=explode("\n",$r['box9']);
     }
if (!$returside) {
  if ($popup) $returside= "../includes/luk.php";
  else $returside= "../index/menu.php";
} elseif (!$popup && $returside=="../includes/luk.php") $returside="../index/menu.php";
##? db_modify("update grupper set box2='$returside',box8='$sort' where art = 'OLV' and kode='$valg' and kodenr = '$bruger_id'",__FILE__ . " linje " . __LINE__);
##? if (!$popup) db_modify("update ordrer set hvem='', tidspkt='' where hvem='$brugernavn' and art like 'D%' and status < '3'",__FILE__ . " linje " . __LINE__); #20150308
    
$tidspkt=date("U");
 
//- function htm_PostVariabler($namelist=['']) { foreach ($namelist as $name) {global $$name; $name = if_isset($_POST[$name]); }}

if ($submit=if_isset($_POST['submit'])) {
  if (strstr($submit, "Genfaktur")) $submit="Genfakturer"; ## Fejl her?
  htm_PostVariabler(['find','valg','sort','nysort','firma','kontoid']);   //  $find=if_isset($_POST['find']);
                                                                          //  $valg=if_isset($_POST['valg']);
                                                                          //  $sort = if_isset($_POST['sort']);
                                                                          //  $nysort = if_isset($_POST['nysort']);
                                                                          //  $firma=if_isset($_POST['firma']);
                                                                          //  $kontoid=if_isset($_POST['kontoid']);
  $firmanavn_ant=if_isset($_POST['firmanavn_antal']); ## Fejl her?
}

if (!$valg) $valg = "ordrer";
if (!$sort) $sort = "firmanavn";
$sort=str_replace("ordrer.","",$sort);
$sortering=$sort;
if ($valg!='faktura') {$genfakturer='';}
if ($valg=="tilbud") {$status="status = 0";}
  elseif ($valg=="faktura") {$status="status >= 3";}
  else   {$status="(status = 1 or status = 2)";}

##?     if (db_fetch_array(db_select("select distinct id from ordrer where projekt > '0' and $status",__FILE__ . " linje " . __LINE__))) $vis_projekt='on';

##- if ($submit=="Udskriv" || $submit=="Send mails"){
##-   htm_PostVariabler(['ordre_antal','ordre_id','checked']);      //  $ordre_antal = if_isset($_POST['ordre_antal']);
##-                                                                 //  $ordre_id = if_isset($_POST['ordre_id']);
##-                                                                 //  $checked = if_isset($_POST['checked']);
##-   for ($x=1; $x<=$ordre_antal; $x++){
##-     if ($checked[$x]=="on") {
##-       $y++;
##-       if (!$udskriv) $udskriv=$ordre_id[$x];
##-       else $udskriv=$udskriv.",".$ordre_id[$x];
##-     }
##-   }
##-   if ($y>0) {
##-     if ($submit=="Udskriv") print "<BODY onLoad=\"JavaScript:window.open('formularprint.php?id=-1&ordre_antal=$y&skriv=$udskriv&formular=4&udskriv_til=PDF' , '' , ',statusbar=no,menubar=no,titlebar=no,toolbar=no,scrollbars=yes, location=1');\">";
##-     elseif ($submit=="Send mails") print "<BODY onLoad=\"JavaScript:window.open('formularprint.php?id=-1&ordre_antal=$y&skriv=$udskriv&formular=4&udskriv_til=email' , '' , ',statusbar=no,menubar=no,titlebar=no,toolbar=no,scrollbars=yes, location=1');\">";
##-   }
##-   else print "<BODY onLoad=\"javascript:alert('Ingen fakturaer er markeret til udskrivning!')\">";
##- }

##- if (isset($_POST['check'])||isset($_POST['uncheck'])) {
##-   htm_PostVariabler(['ordre_antal','ordre_id']);                //  $ordre_antal = if_isset($_POST['ordre_antal']);
##-                                                                 //  $ordre_id = if_isset($_POST['ordre_id']);
##-   if (isset($_POST['check'])) $check_all='on';
##- }

##- if ($submit=="Genfakturer" || $submit=="Ret"){
##-   htm_PostVariabler(['ordre_antal','ordre_id','checked']);      //  $ordre_antal = if_isset($_POST['ordre_antal']);
##-                                                                 //  $ordre_id = if_isset($_POST['ordre_id']);
##-                                                                 //  $checked = if_isset($_POST['checked']);
##-   for ($x=1; $x<=$ordre_antal; $x++){
##-     if ($checked[$x]=="on") {
##-       $y++;
##-       if (!$genfakt) $genfakt=$ordre_id[$x];
##-       else $genfakt=$genfakt.",".$ordre_id[$x];
##-     }
##-   }
##-   if ($y>0) {
##-     if ($popup) { 
##-       if ($submit=="Ret") {
##-         print "<BODY onLoad=\"JavaScript:window.open('ret_genfakt.php?ordreliste=$genfakt' , '' , ',statusbar=no,menubar=no,titlebar=no,toolbar=no,scrollbars=yes, location=1');\">";
##-       } else print "<BODY onLoad=\"JavaScript:window.open('genfakturer.php?id=-1&ordre_antal=$y&genfakt=$genfakt' , '' , ',statusbar=no,menubar=no,titlebar=no,toolbar=no,scrollbars=yes, location=1');\">";
##-     } else {
##-       if ($submit=="Ret") print "<meta http-equiv=\"refresh\" content=\"0;URL=ret_genfakt.php?ordreliste=$genfakt\">";
##-       else print "<meta http-equiv=\"refresh\" content=\"0;URL=genfakturer.php?id=-1&ordre_antal=$y&genfakt=$genfakt\">";
##-     }
##-   }
##-   else print "<BODY onLoad=\"javascript:alert('Ingen fakturaer er markeret til genfakturering!')\">";
##- } 

##- if ($menu=='T') {
##-   include_once '../includes/top_header.php';
##-   include_once '../includes/top_menu.php';
##-   print "<div id=\"header\"> 
##-       <div class=\"headerbtnLft\"></div>
##-       <span class=\"headerTxt\">Debitor - Ordreliste</span>";     
##-   print "<div class=\"headerbtnRght\"><!--<a href=\"index.php?page=debitor/ordre&amp;title=debitor\" class=\"button green small right\">Ny ordre</a>--></div>";       
##-   print "</div><!-- end of header -->
##-   <div class=\"maincontentLargeHolder\">\n";
##-   print  "<table border=\"0\" cellspacing=\"0\" id=\"dataTable\" class=\"dataTable\">";
##-   
##- } elseif ($menu=='S') {
##-   include("../includes/sidemenu.php");
##- } else {
##-   print "<tr><td height = 25 align=center valign=top>";
##-   print "<table width=100% align=center border=0 cellspacing=2 cellpadding=0><tbody><td width=10% $top_bund>"; # Tabel 1.1 ->
##-   print "<a href=$returside accesskey=L>Luk</a></td>";
##-   print "<td width=80% $top_bund align=center><table border=0 cellspacing=2 cellpadding=0><tbody>\n"; # Tabel 1.1.1 ->
##-   if ($valg=='tilbud' && !$hurtigfakt) {print "<td width = 20% align=center $knap_ind>&nbsp;Tilbud&nbsp;</td>";}
##-   elseif (!$hurtigfakt) {print "<td width = 20% align=center><a href='ordreliste.php?valg=tilbud&konto_id=$konto_id&returside=$returside'>&nbsp;Tilbud&nbsp;</a></td>";}
##-   if ($valg=='ordrer') {print "<td width = 20% align=center $knap_ind>&nbsp;Ordrer&nbsp;</td>";}
##-   else {print "<td width = 20% align=center><a href='ordreliste.php?valg=ordrer&konto_id=$konto_id&returside=$returside'>&nbsp;Ordrer&nbsp;</a></td>";}
##-   if ($valg=='faktura') print "<td width = 20% align=center $knap_ind>&nbsp;Faktura&nbsp;</td>";
##-   else print "<td width = 20% align=center><a href='ordreliste.php?valg=faktura&konto_id=$konto_id&returside=$returside'>&nbsp;Faktura&nbsp;</a></td>";
##-   if ($valg=='pbs') print "<td width = 20% align=center $knap_ind>&nbsp;PBS&nbsp;</td>";
##-   elseif ($pbs) print "<td width = 20% align=center><a href='ordreliste.php?valg=pbs&konto_id=$konto_id&returside=$returside'>&nbsp;PBS&nbsp;</a></td>";
##-   print "</tbody></table></td>\n"; # <- Tabel 1.1.1
##-   if ($valg=='pbs') {
##-     if ($popup) print "<td width=10% $top_bund onClick=\"javascript:ordre=window.open('pbs_import.php?returside=ordreliste.php','ordre','scrollbars=1,resizable=1');ordre.focus();\"><a accesskey=N href=ordreliste.php?sort=$sort>Import PBS</a></td>\n";
##-     else  print "<td width=10% $top_bund><a href=pbs_import.php?returside=ordreliste.php>Import PBS</a></td>\n";
##-     include("pbsliste.php");
##-     exit;
##-   }
##-   if ($valg=='pbs') {
##-   } else {
##-     print "<td width=5% $top_bund><a accesskey=V href=ordrevisning.php?valg=$valg>Visning</a></td>\n";
##-     if ($popup) {
##-       print "<td width=5% $top_bund onClick=\"javascript:ordre=window.open('ordre.php?returside=ordreliste.php&konto_id=$konto_id','ordre','scrollbars=1,resizable=1');ordre.focus();\"><a accesskey=N href='".$_SERVER['PHP_SELF']."'>Ny</a></td>\n";
##-     } else {
##-       print "<td width=5%  $top_bund><a href=ordre.php?returside=ordreliste.php?konto_id=$konto_id>Ny</a></td>\n";
##-     }
##-     print "</tbody></table></td></tr>\n"; # <- Tabel 1.1.1
##-   }
##-   if ($valg=='ordrer') { #20121017
##-     $dir = '../ublfiler/ind/';
##-     if (file_exists("$dir")) {
##-       $vis_xml=0;
##-       $filer = scandir($dir);
##-       for ($x=0;$x<count($filer);$x++) {
##-         if (substr($filer[$x],-3)=='xml') $vis_xml=1; 
##-       }
##-       if ($vis_xml) print "<tr><td align=\"center\"><a href=\"ubl2ordre.php\" target=\"blank\">Importer UBL til ordrer</a></td></tr>";
##-     }
##-   }
##-   print "<center>"; #20141107
##- }

$r= sql_readB("select box3,box4,box5, box6 from grupper where art = 'OLV' and kodenr = '$bruger_id' and kode='$valg'", __FILE__, __LINE__);   Vis_Data($r);
##? $r = db_fetch_array(db_select("select box3,box4,box5, box6 from grupper where art = 'OLV' and kodenr = '$bruger_id' and kode='$valg'",__FILE__ . " linje " . __LINE__));
$vis_felt=explode(",",$r['box3']);
$feltbredde=explode(",",$r['box4']);
$justering=explode(",",$r['box5']);
$feltnavn=explode(",",$r['box6']);
$vis_feltantal=count($vis_felt);
$selectfelter=array("konto_id","firmanavn","addr1","addr2","bynavn","land","kontakt","lev_navn","lev_addr1","lev_addr2","lev_postnr","lev_bynavn","lev_kontakt","ean","institution","betalingsbet","betalingsdage","cvrnr","art","momssats","ref","betalt","valuta","sprog","mail_fakt","pbs","mail","mail_cc","mail_bcc","mail_subj","mail_text","udskriv_til");

####################################################################################
$udvaelg=NULL;
$tmp=trim($find[0]);
for ($x=1;$x<$vis_feltantal;$x++) $tmp=$tmp."\n".trim($find[$x]);
$tmp=addslashes($tmp);
##? db_modify("update grupper set box9='$tmp' where art = 'OLV' and kode='$valg' and kodenr = '$bruger_id'",__FILE__ . " linje " . __LINE__);

for ($x=0;$x<$vis_feltantal;$x++) {
  if ($feltbredde[$x]<=10) $feltbredde[$x]*=10;
  if (!$feltbredde[$x]) $feltbredde[$x]=100;
  $find[$x]=addslashes(trim($find[$x]));
  if ($find[$x]=="-") $find[$x]=NULL; 
    $tmp=$vis_felt[$x];
    if ($tmp=='ordrenr' && $find[$x]) {
      if (strlen($find[$x])>=11) $find[$x]=substr($find[$x],0,10);
      $find[$x]*=1;
    }
    if ($tmp=='kontonr' && $find[$x]) {
      $find[$x]*=1;
    }
    if (in_array($vis_felt[$x],$selectfelter) && ($find[$x]||$find[$x]=="0")) {
      $udvaelg=$udvaelg." and ordrer.$tmp='$find[$x]'";
    } elseif ((strpos($vis_felt[$x],"date") || $vis_felt[$x]=="nextfakt") && ($find[$x]||$find[$x]=="0")) {
      if ($vis_felt[$x]=="nextfakt") $genfakturer="1";
      $tmp2="ordrer.".$tmp."";
      $udvaelg=$udvaelg.udvaelg($find[$x],$tmp2, 'DATO');
    } elseif ($vis_felt[$x]=="sum" && ($find[$x]||$find[$x]=="0")) {
      $tmp2="ordrer.".$tmp."";
      $udvaelg=$udvaelg.udvaelg($find[$x],$tmp2, 'BELOB');
    } elseif ($vis_felt[$x]=="email" && $find[$x]) { #20121004
      $tmp2="ordrer.".$tmp."";
      $udvaelg=$udvaelg.udvaelg($find[$x],$tmp2,'');
    } elseif ($find[$x]||$find[$x]=="0") {
      $tmp2="ordrer.".$tmp."";
      $udvaelg=$udvaelg.udvaelg($find[$x],$tmp2, 'NR');
    }
}

if (strstr($sortering,'fakturanr')) {
  if ($db_type=='mysql') $sortering=str_replace("fakturanr","CAST(ordrer.fakturanr AS SIGNED)",$sortering); 
  else $sortering=str_replace("fakturanr","to_number(textcat('0',ordrer.fakturanr),text(99999999))",$sortering);
} else $sortering="ordrer.".$sortering;
$ordreliste="";

if ($valg=="tilbud") $status="status < 1";
elseif ($valg=="ordrer" && $hurtigfakt) $status="status < 3"; 
elseif ($valg=="ordrer") $status="(status = 1 or status = 2)"; 
else $status="status >= 3";

$ialt=0;
$lnr=0;
if (!$linjeantal) $linjeantal=100;
#$start=0;
$slut=$start+$linjeantal;
$ordreantal=0;

if ($konto_id) $udvaelg=$udvaelg."and konto_id=$konto_id";
$r= sql_readB("select count(id) as antal from ordrer where (art = 'DO' or art = 'DK' or (art = 'PO' and konto_id > '0')) and $status $udvaelg",__FILE__, __LINE__);  //   Vis_Data($r);
      ##? $r=db_fetch_array(db_select("select count(id) as antal from ordrer where (art = 'DO' or art = 'DK' or (art = 'PO' and konto_id > '0')) and $status $udvaelg",__FILE__ . " linje " . __LINE__));
$TablData= $r;
//  var_dump($r);
$antal=$r['antal'];

##- print " </td></tr>\n<tr><td align=center valign=top>";
##- print "<table cellpadding=1 cellspacing=1 border=0 valign=top<tbody>\n<tr>";
##- if ($start>0) {
##-   $tmp=$start-$linjeantal;
##-   if ($tmp<0) $tmp=0;
##-   print "<td><a href=ordreliste.php?start=$tmp&valg=$valg&konto_id=$konto_id><img src=../ikoner/left.png style=\"border: 0px solid; width: 15px; height: 15px;\"></a></td>";
##- } else print "<td></td>";
##- for ($x=0;$x<$vis_feltantal;$x++) {
##-     if (!$feltbredde[$x]) $feltbredde[$x]*="100";
##-     elseif ($feltbredde[$x]<15) $feltbredde[$x]*="10";
##-   if ($feltbredde[$x]) {
##-     $width="width=\"$feltbredde[$x]px\"";
##-   } else $width="";
##-   print "<td align=$justering[$x] $width><b><a href='ordreliste.php?nysort=$vis_felt[$x]&sort=$sort&valg=$valg'>$feltnavn[$x]</b></td>\n";
##- }
##- $tmp=$start+$linjeantal;
##- if ($antal>$slut) print "<td align=right><a href=ordreliste.php?start=$tmp&valg=$valg&konto_id=$konto_id><img src=../ikoner/right.png style=\"border: 0px solid; width: 15px; height: 15px;\"></a></td>";
##- print "</tr>\n";

//  STADE   - FELTER:
//  tilbud:                                     ordrenr, ordredate,          kontonr, firmanavn, ref, sum, stade
//  ordrer:                                     ordrenr, ordredate, levdate, kontonr, firmanavn, ref, sum, stade
//  ORDRDATA:                                   ordrenr, ordredate, levdate, kontonr, firmanavn, ref, sum, stade
//  faktura:  fakturanr, fakturadate, nextfakt, ordrenr, ordredate, levdate, kontonr, firmanavn, ref, sum, stade

#################################### OUTPUT ##########################################
function bold($dat,$head='',$tail='&nbsp;&nbsp;') {return $head.'<b>'.$dat.'</b>'.$tail;}

### VIS DATA:

  SpalteTop(960);   
  Rude_DebtOrdrer($TablData);  # Demo! array(['Ordrenr.','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],... []); "ordrenr,ordredate,levdate,kontonr,firmanavn,ref,sum"
  Rude_YdelserTabl($Ordnr='',$data,$fakt=false,'&nbsp;'.tolk('@Ordre nr:').bold('1250').'Ordre dato:'.bold('2017-03-16').
    'Lev. dato:'.bold('2017-03-22').' - Konto nr:'.bold('201703').'Firma navn:'.bold('Danosoft').'Sælger:'.bold('Rup') );
  Rude_FootMenu();
  SpalteBund();
  
### GEM DATA:

  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  