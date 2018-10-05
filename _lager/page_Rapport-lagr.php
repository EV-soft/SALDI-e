<?php      $DocFil= '../_lager/page_Rapport-lagr.php';    $DocVer='5.0.0';    $DocRev='2018-09-20';     $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Se lager rapporter';
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
 
  $pageTitl='Lager Rapport';
  $GLOBALS["ØProgModu"]= ['prim']; ## prim eller/og sekd og comm
  include("../_base/htm_pagePrepare.php"); # Sidens indledende html-kode
  if ($GLOBALS["debug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,$pageTitl);
### INDLÆS DATA:
    $DATA= [
      ['Varenr','Enhed','Beskrivelse','Købt','Solgt','Antal','Købspris','Kostpris','Salgspris'],
      ['Varenr','Enhed','Beskrivelse','Købt','Solgt','Antal','Købspris','Kostpris','Salgspris'],
      ['Varenr','Enhed','Beskrivelse','Købt','Solgt','Antal','Købspris','Kostpris','Salgspris'],
      ['Varenr','Enhed','Beskrivelse','Købt','Solgt','Antal','Købspris','Kostpris','Salgspris'],
      ['Varenr','Enhed','Beskrivelse','Købt','Solgt','Antal','Købspris','Kostpris','Salgspris'],
      ['Varenr','Enhed','Beskrivelse','Købt','Solgt','Antal','Købspris','Kostpris','Salgspris']
    ];
    $DATA1= [
      ['Varenr','Beskrivelse','Beholdning','Kostpris','Lagerværdi',''],
      ['Varenr','Beskrivelse','Beholdning','Kostpris','Lagerværdi',''],
      ['Varenr','Beskrivelse','Beholdning','Kostpris','Lagerværdi',''],
      ['Varenr','Beskrivelse','Beholdning','Kostpris','Lagerværdi',''],
      ['Varenr','Beskrivelse','Beholdning','Kostpris','Lagerværdi',''],
      ['Varenr','Beskrivelse','Beholdning','Kostpris','Lagerværdi','']
    ];
### VIS DATA:
    SpalteTop(320);   Panl_Beholdningsrapp();
    NextSpalte(640);
    switch ($Øjob) {  //  Parameter i URL dannes i htm_pagePrepare
      case 'lgrvalg'  : Panl_LagerVarer($DATA);  break;    //  Det valgte
      case 'lgrstat'  : Panl_LagerStat($DATA);   break;    //  Lagerstatus
      case 'lgrcount' : Panl_LagerTal($DATA1);   break;    //  Lageroptælling
      default         : Panl_Beholdningsliste();  
    }
    SpalteBund();
    //PanelInitier(2,2);
    
### GEM DATA:
    

  include("../_base/htm_pageFinalize.php"); # Sidens afsluttende html-kode
?>  
