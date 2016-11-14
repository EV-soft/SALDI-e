<?php   $DocFil= '../_systemdata/page_Formtext.php';    $DocVer='5.0.0';    $DocRev='2016-10-00';
// Formål:  Kald til ufærdigt link
//             ___   _   _    ___  _
//            / __| /_\ | |  |   \| |   ___ 
//            \__ \/ _ \| |__| |) | |__/ -_)
//            |___/_/ \_|____|___/|_|  \___|
//
// LICENS & Copyright (c) 2004-2016 DANOSOFT ApS *** Se filen: ../LICENS_Copyright.txt
//
// 2016.08.00 ev - EV-soft
//

if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'Hovedmenu');

  $pageTitl='Formularredigering';
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
    
    SpalteTop(240); Rude_Formularer('4','1:Tekster','dansk');
    NextSpalte();   Rude_FormRedigerText();
    EndSpalter();
    skilleLin();
    
    SpalteTop(240); Rude_Formularer('4','2:Linjer','dansk');
    NextSpalte();   Rude_FormRedigerGrafik();
    EndSpalter();
    skilleLin();
    
    SpalteTop(240); Rude_Formularer('4','3:Ordrelinjer','dansk');
    NextSpalte();   Rude_FormRedigerOrdrelin();
    EndSpalter();

  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  