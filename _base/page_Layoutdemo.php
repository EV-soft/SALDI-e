<?php   $DocFil= '../base/page_Layoutdemo.php';    $DocVer='5.0.0';    $DocRev='2016-10-00';   $ModulNr=2;
//  DEMO af ny version af SALDI                                        
//             ___   _   _    ___  _         
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___)
//                                           
// LICENS & Copyright (c) 2004-2016 DANOSOFT ApS *** Se filen: ../LICENS_Copyright.txt
//
//  Denne fil demonstrerer layout af output til skærm.
//  Benyttes også til test og finafpudsning.
//
// Styring af layout:
//    Visning af vinduer bestående af relevante ruder.
//    Ruder (= Emne-moduler), egnet for adaptive skærm-output.
// Skærmbredde: >=320px..640px: Brugbar - "Telefon"
//                640px..980px: Velegnet - "Tablet"
//                980px..1200px: Udnyttes - "Computer"
// HTML5 og CSS er benyttet i stor udstrækning.
// Filer skal gemmes i UTF-8 format uden BOM!
// 2016.08.00 ev - EV-soft


  global $ØPanelBgrd, $Ødebug;
  $laast=NULL;
  $Ødebug= true;
  $pageTitl='DEMO af SALDI-€';
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
  include_once("../_base/out_vinduer.php");  # Sidens indledende html-kode
# echo '<script LANGUAGE="JavaScript"><!--function MasseFakt(tekst){ var agree = confirm(tekst);  if (agree) return true ;  else return false ;} // --></script>';
# if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$DocFil,$ModulNr,'Dette er DEMO-vinduet.');
    
  msg_Dialog('info',
  ucfirst(tolk('@Fortsæt')),'$jQ112(this).dialog("close")','','','','',ucfirst(tolk('@Velkommen til SALDI-DEMO')),
  tolk('@Her kan du se en demonstration af et forslag til en modernisering af SALDI.').'<br><br>'.
  tolk('@Systemet er baseret på CSS, og er med responsive design, som er velegnet til mobile enheder. ').'<br><br>'.
  tolk('@Der er fuld understøttelse til at skifte sprog for program-fladen og i denne demo, kan der skiftes mellem dansk-engelsk-tysk-fransk-spansk-tyrkisk.').'<br><br>'.
  tolk('@Denne dialogbox er universal for: info-error-tip-warn-success beskeder. Du kan flytte den og ændre størrelse ved at trække i kanterne.'));

  vindue_Intro();
  vindue_Connect();
  vindue_InstallResult($db_navn,$adm_navn,$noskriv='includes');
  vindue_Formaal();
  vindue_GitterMenu();
  vindue_Ordreblanket(true);
  vindue_DivDemo();
  vindue_RappDemo();
  vindue_KassDemo();
  vindue_OrdreDemo();
  vindue_Test();
           
  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode og java-scripter
?>