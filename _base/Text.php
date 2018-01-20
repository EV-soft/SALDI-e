<?php   $DocFil= '../_systemdata/page_Formtext.php';    $DocVer='5.0.0';    $DocRev='2017-09-00';
/* ## FORMÅL: Redigering af udskrivnings formularer
 * Denne fil er oprettet af EV-soft  i 2017.
 *             ___   _   _    ___  _         
 *            / __| / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            |___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS      *** Se filen: ../LICENS_Copyright.txt
 *
 * 
 *
 * 2016.08.00 evs - EV-soft
 *
 */

if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,'Hovedmenu');

  $pageTitl='Formularredigering';
  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
### INDLÆS DATA:
    $demo1= '4'; $demo2= '1:Tekster'; $demo3= 'dansk'; $demo4= '2:Linjer'; $demo5= '3:Ordrelinjer';  $demo6= 'A4p'; 

### VIS DATA:
    SpalteTop(240); Rude_Formularer($demo1,$demo2,$demo3,$demo6);
    NextSpalte();   Rude_FormRedigerText();
    SpalteBund();
    skilleLin();
    
    SpalteTop(240); Rude_Formularer($demo1,$demo4,$demo3,$demo6);
    NextSpalte();   Rude_FormRedigerGrafik();
    SpalteBund();
    skilleLin();
    
    SpalteTop(240); Rude_Formularer($demo1,$demo5,$demo3,$demo6);
    NextSpalte();   Rude_FormRedigerOrdrelin();
    SpalteBund();
    skilleLin();
   //  $filDATA= ImportTabFile(realpath($_SERVER["DOCUMENT_ROOT"]). '/saldi-e/_exchange/_standard/formular-utf8.tab');
    Rude_Printlayout($filDATA);
    

  include("../_base/htm_pageFoot.php"); # Sidens afsluttende html-kode
?>  