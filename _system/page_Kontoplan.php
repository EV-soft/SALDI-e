<?php   $DocFil= '../_system/page_Kontoplan.php';    $DocVer='5.0.0';    $DocRev='2018-09-20';   $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Rediger Kontoplan';
 * Denne fil er oprettet af EV-soft i 2017.
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS      *** Se filen: ../LICENS_Copyright.txt
 *
 */

  global $pageTitl;
  $pageTitl='Kontoplan';
  $GLOBALS["ØProgModu"]= ['prim']; ## prim eller/og sekd og comm
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
  if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
    
### INDLÆS DATA:
  if (false) {  //  Indlæs TAB-fil i database:
    $FileData= ImportTabFile('../_exchange/kontoplan.tab');  // Indlæs kontoplan fra TAB-fil
    //$FileData= ImportTabFile('../_exchange/kontoplan.csv');  // Indlæs kontoplan fra TAB-fil - Nyt format
    //file_put_contents('../_exchange/kontoplan.json',json_encode($FileData));
    //$FileData = json_decode(file_get_contents('../_exchange/kontoplan.json'), true);
    $data= [];
    foreach ($FileData as $filrow) { //  Kompenser for fejl i TAB-fil
      if ($filrow[5]=='100') $filrow[5]= 'DKK';
      $filrow[8]= '1';
      array_push($data, $filrow); 
    }
  /*    DB-erklæring:
           (id serial NOT NULL, ## Ver 3.x: kontoplan ##  $row[ 0]
            kontonr numeric(15,0),                        $row[ 1]
            beskrivelse text,                             $row[ 2]
            kontotype varchar(1),                         $row[ 3]
            moms text,                                    $row[ 4]
            fra_kto numeric(15,0),                        $row[ 5]
            til_kto numeric(15,0),                        $row[ 6]
            lukket varchar(2),                            $row[ 7]
            primo numeric(15,3),                          $row[ 8]
            saldo numeric(15,3),                          $row[ 9]
            regnskabsaar integer,                         $row[10]
            genvej varchar(2),                            $row[11]
            overfor_til numeric(15,0),                    $row[12]
            anvendelse text,                              $row[13]
            modkonto numeric(15,0),                       $row[14]
            valuta varchar(3),                            $row[15]
            valutakurs numeric(15,4),                     $row[16]
            PRIMARY KEY (id))', __FILE__, __LINE__);
  */
    foreach ($FileData as $row) { $id++; //  Indlæs kontoplan i databasen:
    if ($row[4]>0) $row[5]= $row[0];  //  til_kto
    $row[8]= '0'; //  saldo
    $row[9]= '1'; //  regnskabsaar
    $row[14]='DKK';
    sql_write('INSERT INTO tblA_account_plan (id, kontonr, beskrivelse, kontotype, moms, fra_kto, til_kto, lukket, primo, saldo, 
                                              regnskabsaar, genvej, overfor_til, anvendelse, modkonto, valuta, valutakurs)
               VALUES ("'.$id.'","'.$row[0].'","'.$row[1].'","'.$row[2].'","'.$row[3].'","'.$row[4].'","'.$row[5].'","'.$row[6].'","'.$row[7].
               '","'.$row[8].'","'.$row[9].'","'.$row[10].'","'.$row[11].'","'.$row[12].'","'.$row[13].'","'.$row[14].'","'.$row[15].'")
               ON DUPLICATE KEY UPDATE SET kontonr =     "'.$row[0].'",
                                           beskrivelse = "'.$row[1].'",
                                           kontotype =   "'.$row[2].'",
                                           moms =        "'.$row[3].'",
                                           fra_kto =     "'.$row[4].'",
                                           til_kto =     "'.$row[5].'",
                                           lukket =      "'.$row[6].'",
                                           primo =       "'.$row[7].'",
                                           saldo =       "'.$row[8].'",
                                           regnskabsaar= "'.$row[9].'",
                                           genvej =      "'.$row[10].'",
                                           overfor_til = "'.$row[11].'",
                                           anvendelse =  "'.$row[12].'",
                                           modkonto =    "'.$row[13].'",
                                           valuta =      "'.$row[14].'",
                                           valutakurs =  "'.$row[15].'"
            ;');
    }
  } else {  
  if (!$regnaar) {$regnaar=1;} 
	$data= sql_readB($qstr= //  Hent data fra Databasen:
        'SELECT id, kontonr, beskrivelse, kontotype, fra_kto, moms, saldo, valuta, genvej, lukket, regnskabsaar '.
        'FROM tblA_account_plan '.
        'WHERE regnskabsaar='.$regnaar.' '.
        'ORDER BY kontonr',__FILE__, __LINE__);
  }
  
### VIS DATA:
  SpalteTop(960);     
  Panl_Kontoplan($data,$GLOBALS["chg"]=='ok');
  SpalteBund();
  SpalteTop(480);     
  Panl_Kontoplankort($data[3]);
  SpalteBund();
  PanelInitier(2,3);
      
### GEM DATA:

  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>  