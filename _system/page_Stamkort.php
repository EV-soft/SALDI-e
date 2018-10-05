<?php   $DocFil= '../_system/page_Stamkort.php';    $DocVer='5.0.0';    $DocRev='2018-09-20';   $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Indstillinge af firma-stamdata';
 * Denne fil er oprettet af EV-soft i 2017.
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS      *** Se filen: ../LICENS_Copyright.txt
 *
 *
 *
 */
 
if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'Hovedmenu');
### INDLÆS DATA:

  $pageTitl='Indstil: Firmadata';
  $GLOBALS["ØProgModu"]= ['sekd']; ## prim eller/og sekd og comm
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
  DocAlder($DocRev);
  
  
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
//  Findes i out_base.php:
//  function set_ajour($name)  {if (isset($_POST[$name]))  {$_SESSION[$name]= $$name= htmlspecialchars($_POST[$name]); return $$name; } } //  En variabel med navnet: $name er opdateret, og husket i SESSION
//  function set_FormVars ($names) { foreach ($names as $name) $$name= set_ajour($name); }  //  Ja: $$name er ikke en fejl. Der refereres til værdien af variablen med navnet $name
//  set_FormVars(['id','ans_id','ans_ant','lukket_ant','posnr']);  // Opdater alle variabler på form 'debiform' :

//+  $gruppe = if_isset($_POST['gruppe']) *1;
/*
  if ($postnr && !$bynavn) $bynavn= bynavn($postnr);
  if ($id==0) {
    $query = db_modify("insert into adresser (kontonr,firmanavn,addr1,addr2,postnr,bynavn,tlf,fax,cvrnr,art,bank_navn,bank_reg,bank_konto,email,mailfakt,pbs_nr,pbs,bank_fi,gruppe) values ('$kontonr','$firmanavn','$addr1','$addr2','$postnr','$bynavn','$tlf','$fax','$cvrnr','S','$bank_navn','$bank_reg','$bank_konto','$ny_email','$mailfakt','$pbs_nr','$pbs','$fi_nr','$gruppe')",__FILE__ . " linje " . __LINE__);
//+    $query = db_select("select id from adresser where art = 'S'",__FILE__ . " linje " . __LINE__);
//+    $row = db_fetch_array($query);
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
*/
}

//+ $query = db_select("select * from adresser where art = 'S'",__FILE__ . " linje " . __LINE__);
//+ $row = db_fetch_array(db_select("select * from adresser where art = 'S'",__FILE__ . " linje " . __LINE__););
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

    $firmanavn='DemoFirma'; $pbs='L';  # DEMO
    $Navn='DemoAnsat';
    //  Bemærk at hvis variabler ikke blot skal vises, men skal ændre værdi, skal de erklæres med prefix: & hvilket eksempelvis kan ses i erklæringen af Panl_Stamdata()
    //  Det bevirker at data ikke overføres som værdier, men som en pointer til variablen. Det er samtidigt mindre ram-krævende, og hurtigere!
### VIS DATA:
    SpalteTop(240);   Panl_AdminMenu();
    NextSpalte(320);  Panl_Stamdata($firmanavn, $addr1, $addr2, $postnr, $bynavn, $ny_email, $homepage, $bank_navn, $bank_reg, $bank_konto, $cvrnr, $tlf, $fax, $pbs_nr, $pbs, $gruppe, $fi_nr);
    NextSpalte(320);  Panl_CVRopslag('din virksomhed');
    SpalteBund();
    skilleLin();
    
    SpalteTop(240);  // Panl_AdminMenu();
    NextSpalte(480);  Panl_Medarbejdere();
    SpalteBund();
    if ($_SESSION['cvrSoeg']) 
         PanelInitier(4,17);
    else PanelInitier(3,17);

### GEM DATA:
  


  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>  