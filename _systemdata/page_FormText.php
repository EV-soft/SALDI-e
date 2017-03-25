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
    $demo1= '4'; $demo2= '1:Tekster'; $demo3= 'dansk'; $demo4= '2:Linjer'; $demo5= '3:Ordrelinjer'; 
    SpalteTop(240); Rude_Formularer($demo1,$demo2,$demo3);
    NextSpalte();   Rude_FormRedigerText();
    EndSpalter();
    skilleLin();
    
    SpalteTop(240); Rude_Formularer($demo1,$demo4,$demo3);
    NextSpalte();   Rude_FormRedigerGrafik();
    EndSpalter();
    skilleLin();
    
    SpalteTop(240); Rude_Formularer($demo1,$demo5,$demo3);
    NextSpalte();   Rude_FormRedigerOrdrelin();
    EndSpalter();

  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  