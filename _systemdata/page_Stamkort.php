<?php      $DocFil= '../_systemdata/page_Stamkort.php';    $DocVer='5.0.0';     $DocRev='2016-10-00';
// Formål:  Kald til ufærdigt link
//             ___   _   _    ___  _
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___|
//
// LICENS & Copyright (c) 2004-2016 DANOSOFT ApS *** Se filen: ../LICENS_Copyright.txt
//
// 2016.10.00 ev - EV-soft
//

if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'Hovedmenu');

  $pageTitl='Brugerdata';
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode

  
## Subrutiner:
function Post2Var($nm)      { $v= $nm; global $$v;  $$v= $_POST[$nm]; }                         # $nm:type= string
function PostTrim2Var($nm)  { $v= $nm; global $$v;  $$v= trim($_POST[$nm]); }                   # $nm:type= string
function PostAdd2Var($nm)   { $v= $nm; global $$v;  $$v= addslashes(trim($_POST[$nm])); }       # $nm:type= string
function PostEsc2Var($nm)   { $v= $nm; global $$v;  $$v= db_escape_string(trim($_POST[$nm])); } # $nm:type= string

if ($_POST) { 
  foreach (array('id','ans_id','ans_ant','lukket_ant','posnr')     as $felt) {Post2Var($felt);};
  foreach (array('kontonr','vis_lukket','pbs_nr','pbs','fi_nr')    as $felt) {PostTrim2Var($felt);};
  foreach (array('firmanavn','addr1','addr2','postnr','bynavn','kontakt','tlf','fax','cvrnr','bank_navn','bank_reg','bank_konto','email','ny_email','mailfakt',)
                                                                   as $felt) {PostAdd2Var($felt);};
  $gruppe = if_isset($_POST['gruppe']) *1;

  if ($postnr && !$bynavn) $bynavn= bynavn($postnr);
  if ($id==0) {
    $query = db_modify("insert into adresser (kontonr,firmanavn,addr1,addr2,postnr,bynavn,tlf,fax,cvrnr,art,bank_navn,bank_reg,bank_konto,email,mailfakt,pbs_nr,pbs,bank_fi,gruppe) values ('$kontonr','$firmanavn','$addr1','$addr2','$postnr','$bynavn','$tlf','$fax','$cvrnr','S','$bank_navn','$bank_reg','$bank_konto','$ny_email','$mailfakt','$pbs_nr','$pbs','$fi_nr','$gruppe')",__FILE__ . " linje " . __LINE__);
    $query = db_select("select id from adresser where art = 'S'",__FILE__ . " linje " . __LINE__);
    $row = db_fetch_array($query);
    $id = $row['id'];
  } elseif ($id > 0) {
    $query = db_modify("update adresser set kontonr = '$kontonr', firmanavn = '$firmanavn', addr1 = '$addr1', addr2 = '$addr2', postnr = '$postnr', bynavn = '$bynavn', tlf = '$tlf', fax = '$fax', cvrnr = '$cvrnr', bank_navn='$bank_navn', bank_reg='$bank_reg', bank_konto='$bank_konto',email='$ny_email',mailfakt='$mailfakt', notes = '$notes', pbs_nr='$pbs_nr', pbs='$pbs', bank_fi='$fi_nr',gruppe='$gruppe' where art = 'S'",__FILE__ . " linje " . __LINE__);
    for ($x=1; $x<=$ans_ant; $x++) {
      if (($posnr[$x])&&($posnr[$x]!='-')&&($ans_id[$x])){db_modify("update ansatte set posnr = '$posnr[$x]' where id = '$ans_id[$x]'",__FILE__ . " linje " . __LINE__);}
      elseif($ans_id[$x]){ db_modify("delete from ansatte where id = '$ans_id[$x]'",__FILE__ . " linje " . __LINE__);}
    }
    for ($x=1; $x<=$lukket_ant; $x++) {
      if (($posnr[$x])&&($ans_id[$x])){db_modify("update ansatte set posnr = '$posnr[$x]' where id = '$ans_id[$x]'",__FILE__ . " linje " . __LINE__);}
      elseif($ans_id[$x]){ db_modify("delete from ansatte where id = '$ans_id[$x]'",__FILE__ . " linje " . __LINE__);}
    }
  }
  if ($email != $ny_email) {
    include("../includes/connect.php");
    db_modify("update regnskab set email='$ny_email' where db='$db'",__FILE__ . " linje " . __LINE__); 
    include("../includes/online.php");
  }
}

$query = db_select("select * from adresser where art = 'S'",__FILE__ . " linje " . __LINE__);
$row = db_fetch_array(db_select("select * from adresser where art = 'S'",__FILE__ . " linje " . __LINE__););
//  $id=$row['id']*1;
//  $kontonr=$row['kontonr'];
//  $firmanavn=$row['firmanavn'];
//  $addr1=$row['addr1'];
//  $addr2=$row['addr2'];
//  $postnr=$row['postnr'];
//  $bynavn=$row['bynavn'];
//  #$kontakt=$row['kontakt'];
//  $tlf=$row['tlf'];
//  $fax=$row['fax'];
//  $cvrnr=$row['cvrnr'];
//  $bank_navn=$row['bank_navn'];
//  $bank_reg=$row['bank_reg'];
//  $bank_konto=$row['bank_konto'];
//  $email=$row['email'];
//  ($row['mailfakt'])? $mailfakt='checked':$mailfakt='';
//  $pbs_nr=$row['pbs_nr']; 
//  $pbs=$row['pbs']; 
//  $fi_nr=$row['bank_fi'];
//  $smtp=$row['felt_1']; 
//  $gruppe=$row['gruppe'];
//  if (!$gruppe) $gruppe=1;
//  while(strlen($gruppe)<5) $gruppe='0'.$gruppe; 
//  # $id=0;
    
    SmallSpalte();  Rude_AdminMenu();
    NextSpalte();   Rude_Stamdata();
    NextSpalte();   Rude_Ansatte();
    EndSpalter();
    

  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  