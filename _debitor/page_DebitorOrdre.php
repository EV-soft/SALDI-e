<?php      $DocFil= '../_debitor/page_DebitorOrdre.php';   $DocVer='5.0.0';     $DocRev='2017-10-00';   $DocIni='evs';  $ModulNr=2;
/* ## Purpose: ' Vis data for en Salgs ordre ';
 * Denne fil er oprettet af EV-soft i 2017.
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 * 2016.08.00 evs - EV-soft
 *
 */
 
  $pageTitl='Salgs ordre';
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode

  $wide=false;  # Bredt panel til vareposter.
  $hide=true; # Skjul sekundære paneler
  
  Head_Navigation(tolk('@Salgs ordre - Status')); 
  if ($wide==true) {      Rude_YdelserWide ($fakt=false); }
  echo '<div id="wrapper">';
    echo '<column id="spalte1">'; 
                          Rude_Kunden($kontonr, $kategori, $cvrnr, $eannr, $bankreg, $bankkto, $instit, $ansv, $formsprog, $homeweb);           
      if ($hide==false) { Rude_Kontakter(); }
                          Rude_Betingelser($debigrup, $betaling, $frist, $print2, $kunderef);     
      if ($hide==false) { Rude_Mailfaktura($emne, $text, $vedhft);  }
    echo '</column>'; 
    echo '<column id="spalte3">'; 
                          Rude_Fakturering ($navn='Anders And', $addr='Andedammen 34', $sted='Ved Lunden', $ponr='1234', $by='Eventyrland', $land='Eventyrland', 
                            $noter='Levering på anden adresse!', $telf='045 12345678', $att='Rap', $email='anders@and.dk', $usemail='', $faktdato);   
                          Rude_Ordreinfo($valuta, $vorref, $afdel, $ordrdato, $genfdato, $godkendt, $optlist);      
    echo '</column>'; 
    echo '<column id="spalte3">'; 
                          Rude_Levering($navn= 'Andersine', $addr= 'Redekasse 12', $sted= 'Ved Lunden', $ponr= '1234', $by= 'Fuglebjerg', $land= 'Eventyrland', 
                            $telf= '045 87654321', $email= 'andersine@and.dk', $forsend= 'Fragt: DSV', $noter= 'Afleveres ved bredden!', $afsendt= '', $levdato);   
    if ($hide==false)   { Rude_Ekstrafelter($felt1, $felt2, $felt3, $felt4, $felt5);  }   echo '</column>'; # spalte3 fordi spalte2 ikke virker perfekt!
    if ($wide==false)   { echo '<column id="spalte3">'; 
                          Rude_Ydelser($fakt=false); 
                          echo '</column>'; }
  echo '</div>';
  
//  if ($wide==true) {    Rude_YdelserWide ($fakt=false); }

                          echo '<div class="clearWrap"/>';
                          Rude_FootMenu();
  
  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>