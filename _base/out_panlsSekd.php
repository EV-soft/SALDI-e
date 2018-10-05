<?php   $DocFil= '../_base/out_PanlsSekd.php';   $DocVer='5.0.0';    $DocRev='2018-09-30';   $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Design af panelers layout. Del-3';
 * Del-3 af redigeringsfilen: '../_base/out_Panls.php'
   HUSK AT DENNE FIL SKAL OPDATERES, PÅ GRUNDLAG AF DEN FÆLLES REDIGERINGSFILS (out_Panls.php) INDHOLD !!!
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2018 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 * Design af panelers layout.
 * Panel-moduler egnet for adaptivt skærm-output.
 *
 * Afhængig af: out_base.php
 *  
 * Filer er redigeret med tabulator sat til 2 tegn, og linielængde max. 200 tegn. De ses bedst med det.
 * Filer skal gemmes i UTF-8 format uden BOM!
 *
  Oprettet: 2018-08-00 evs - EV-soft    #: Dette bibliotek er udviklet 2016-1018 af EV-soft.
  Ændrings-Log:

  
 * 
 */
DocAlder($DocRev);



######### :SYSTEM: ######### Start funktioner angående visninger i menu-gruppen SYSTEM

######### :SYSTEM:
# Kaldes fra:  [_base/page_Install.php] [_base/page_Startup.php] [_system/page_Connsetup.php] 
function Panl_Login(&$regnskab,&$brugernavn,&$brugerkode,&$ProgVers,&$LnkHelp,&$OrgaName,&$Logo,$VisMax=true) { ## out_PanlsPrim.php
  global $ØProgTitl, $ØprogSprog;
  htm_FormLocal($name='sprogform'); //  Angår: Select SprogValg                           ../_base/page_Hovedmenu.php
  htm_Panl_Top($name='logiform',$capt=Tolk('@Logind til').' <i>'.$regnskab.'</i>',$parms='#',
        $icon='fas fa-key',$klasse='panelW320',__FUNCTION__); # < ? php echo htmlspecialchars($_SERVER["PHP_SELF"]);? >
  echo '<table width="100%" cellspacing="0"><tr align="center">';
  $FaLogo= '../_assets/images/'.$Logo;
  if ($VisMax) {
    if (file_exists($FaLogo)) 
      echo '<tr align="center" title="SALDI-euro - '.tolk('@Det frie danske økonomisystem').
            '" style="cursor: help;"><td colspan="3" height="40px">'.
            '<img style="border:0px solid;width:120px;heigth:80px" alt="LOGO" src="'.$FaLogo.'"></td></tr>';
    echo '<td> <small><small>'.$ØProgTitl.'</small></small></td>';
    echo '<td align="center">'.ucfirst(tolk('@Vært:')).'&nbsp; <b>'.$OrgaName.'</b></td>';
    echo '<td align="right"><small><small>Vers.'.$ProgVers.'</small></small> </td>';
    if ($LnkHelp) echo '<tr align="center"><td colspan="3"><br/><small><small>'.tolk('@Huske TIP:').' </small> '.$LnkHelp.' </small></td></tr>';
    echo '</tr></table><br>';
  }

  htm_CombFelt($type='text',    $name='regn', $valu= $regnskab,   $labl='@Regnskab',    
          $titl='@Angiv navnet på det Regnskab, som du har adgang til',
          $revi=true, $rows='2',$width='',$step='', $more='required="required" ', $plho=tolk('@Regnskab...'));
  htm_CombFelt($type='text',    $name='navn', $valu= $brugernavn, $labl='@Brugernavn',  
          $titl=tolk('@Angiv dit').$ØProgTitl.' '.tolk('@Brugernavn'),
          $revi=true, $rows='2',$width='',$step='', $more='required="required" ', $plho=tolk('@Bruger...'));
  htm_CombFelt($type='password',$name='kode', $valu= $brugerkode, $labl='@Adgangskode', 
          $titl='@Angiv den gyldige adgangskode hørende til Brugernavnet. 4-20 tegn - STORE/små bogstaver, cifre, samt spec.tegn - SKAL benyttes',  
          $revi=true, $rows='2',$width='',$step='', 
          $more=''.//required="required" pattern="((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&_æøåÆØÅ]).{4,20})" '.
                'title="4..20 tegn accepteres, STORE/små bogstaver, cifre 0-9, samt spec.tegn %&¤#! - SKAL benyttes!" ', $plho=tolk('@Password...'));    
  //  Password (UpperCase, LowerCase, Number/SpecialChar and min 8 Chars):  (?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$
#  echo '<div style="text-align: center"><br><small><small> /da:Sprog/en:Language/de:Sprache/fr:Langue/tr:Dil/es:Lenguaje</small></small></div>';
  htm_CentrOn();
    textKnap($label='@Log ind',  $title=tolk('@Gå videre til').$ØProgTitl.' '.tolk('@regnskabet'), $link='#');
  htm_CentOff();
  htm_nl();  htm_hr();
  if ($VisMax) { 
    htm_Caption('@Andre muligheder:'); SprogValg($ØprogSprog,$formName='sprogform'); }
  htm_nl();
  //htm_Caption('(Virker ikke her!)');
  echo '<p align="center"><a href="'.$link='../_base/page_Blindgyden.php'.'"><u title="'.
      tolk('@Få tilsendt mail, angående nulstilling af password').'">'.
      tolk('@Glemt adgangskode?').'</u></a></p>';
  echo '<p align="center"><a href="'.$link='../_base/page_Blindgyden.php'.'"><u title="'.
      tolk('@Registrer dig som ny bruger').'">'.
      tolk('@Opret ny bruger?').'</u></a></p>';
  htm_PanlBund($pmpt=Tolk('@Log ind'),$subm=false,$title=tolk('@Gå videre til').$ØProgTitl.' '.tolk('@regnskabet'));
}


######### :SYSTEM:
# Kaldes fra:  [_system/page_Connsetup.php] 
function Panl_Connsetup() {  ## out_PanlsPrim.php
  htm_Panl_Top($name='forbind',$capt='@DB forbindelse:',$parms='page_Blindgyden.php',$icon='fas fa-key',$klasse='panelW480',__FUNCTION__);
                        htm_CombFelt($type='text',  $name='firmanavn',  $valu= $firmanavn,  $labl='@Firmanavn',   
               $titl='@Navnet på det firma, regnskabet angår. Kan benyttes i CVR-opslag, til at importere Erhvervsstyrelsens offentlige data');
  htm_FrstFelt('50%');  htm_CombFelt($type='text',  $name='addr1',      $valu= $addr1,      $labl='@Adresse',     $titl='@Firmaets adresse');
  htm_NextFelt('50%');  htm_CombFelt($type='text',  $name='addr2',      $valu= $addr2,      $labl='@Sted',        $titl='@Supplerende stedsangivelse');
  htm_LastFelt();                                                                           
  htm_FrstFelt('25%');  htm_CombFelt($type='text',  $name='postnr',     $valu= $postnr,     $labl='@Postnr.',     $titl='@Postnr');
  htm_NextFelt('75%');  htm_CombFelt($type='text',  $name='bynavn',     $valu= $bynavn,     $labl='@Bynavn',      $titl='@Bynavn. firmaets hjemsted');
  htm_LastFelt();                                                                           
  htm_FrstFelt('50%');  htm_CombFelt($type='mail',  $name='ny_email',   $valu= $ny_email,   $labl='@Mail',        $titl='@Firmaets Mail-adresse');
  htm_NextFelt('50%');  htm_CombFelt($type='text',  $name='homepage',   $valu= $homepage,   $labl='@Hjemmeside',  $titl='@Firmaets hjemmeside-adresse');
  htm_LastFelt();                                                                           
                        htm_CombFelt($type='text',  $name='bank_navn',  $valu= $bank_navn,  $labl='@Bank',        $titl='@Bank forbindelse');
  htm_FrstFelt('25%');  htm_CombFelt($type='text',  $name='bank_reg',   $valu= $bank_reg,   $labl='@Bank reg.',   $titl='@Bank reg.');
  htm_NextFelt('75%');  htm_CombFelt($type='text',  $name='bank_konto', $valu= $bank_konto, $labl='@Bank konto',  $titl='@Bank konto');
  htm_LastFelt();
                        htm_CombFelt($type='text',  $name='cvrnr',      $valu= $cvrnr,      $labl='@CVR',         
                      $titl='@CVR - Virksomheds ID. Kan benyttes i CVR-opslag, til at importere Erhvervsstyrelsens offentlige data');
  htm_FrstFelt('50%');  htm_CombFelt($type='text',  $name='tlf',        $valu= $tlf,        $labl='@Telefon.',    
                      $titl='@Telefonnr. - Kan benyttes i CVR-opslag, til at importere Erhvervsstyrelsens offentlige data');
  htm_NextFelt('50%');  htm_CombFelt($type='text',  $name='fax',        $valu= $fax,        $labl='@Fax',         $titl='@Firmaets fax');
  htm_LastFelt();
  if (!$pbs_nr) {
    htm_FrstFelt('40%');  htm_CombFelt($type='text',$name='pbs_nr',     $valu= $pbs_nr,     $labl='@PBS Kreditornr.', $titl='@Firmaets pbsnr');
    htm_NextFelt('60%');  {if      ($pbs=='B') $listen= array(['','B','@Basis løsning'], ['','', '@Total løsning'], ['','L','@Lev. Service']);
                           elseif  ($pbs=='L') $listen= array(['','L','@Lev. Service'],  ['','B','@Basis løsning'], ['','', '@Total løsning']);
                           else                $listen= array(['','', '@Total løsning'], ['','B','@Basis løsning'], ['','L','@Lev. Service']);
                           htm_OptioFlt($type='text',$name='pbs',       $valu= $pbs,        $labl='@Aftale',      $titl='@Vælg den aftalte løsning',  $revi=true, $optlist= $listen, $action='');
                          }
    htm_LastFelt();
  } else  htm_CombFelt(             $type='text',  $name='pbs_nr', $valu= $pbs_nr, $labl='@PBS Kreditornr.',   $titl='@Firmaets pbsnr');
  htm_CombFelt(                     $type='text',  $name='gruppe', $valu= $gruppe, $labl='@PBS debitorgruppe', $titl='@Gruppe ');
  htm_CombFelt(                     $type='text',  $name='fi_nr',  $valu= $fi_nr,  $labl='@FI Kreditornr.',    
                      $titl='@Bankernes fælles indbetalingskort (FI-kort). Her angiver du dit FI Kreditornr.');
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :SYSTEM:
# Kaldes fra: 
function SetHeadArr($frmNr='4',$x1='',$x2='@Dansk',$x3='@A4 portrait') { global $ØBtNewBgrd;  ## outxx.php
  $copyknap= '<button type="button" id="btnCopy" onclick="varcopy()" style="background-color:'.$ØBtNewBgrd.'" title="'.    //  varcopy() erklæres i htm_pagePrepare.php
    tolk('@Klik her, for at kopiere det valgte variabelnavn til kopieringsbuffer, så du kan indsætte det i et beskrivelses felt').
    '">&nbsp;<ic class="fas fa-copy" style="font-size:15px;"> </ic> Copy </button>';
  if ($x1=='@Ordrelinjer') {$extra= [str_sp(4). tolk('@Variabler:'), '18%','html','','left', '', 
    htm_SelectStr($name='copytxt',$valu='VALU',OrdrVars($frmNr),'max-width:200px; background-color:white;" title="'.
      tolk('@Her kan du vælge blandt de brugbare variabelnavne angående ordrelinier'),false).$copyknap];} 
  else
  if ($x1=='@Tekster') {$extra= [str_sp(4). tolk('@Variabler:'), '16%','left','html', '', 
    htm_SelectStr($name='copytxt',$valu='VALU',FormVars($frmNr),'max-width:200px; background-color:white;" title="'.
      tolk('@Her kan du vælge blandt de brugbare variabelnavne angående tekster'),false).$copyknap];} 
    else $extra= ['','0%','','html','',''];
  return  array(   # $HeadLine= array([0:Labl, 1:Width, 2:Just, 3:InpType, 4:Tip, 5:placeholder])
  // #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder'
    ['@Formular:',  '7%','show','','left', '@Du redigerer denne formular', ListLookup($liste=FRM_Liste(),$search= $x0,$colsearch=1,$colresult=2)],
    ['@Art:',       '7%','show','','left', '@Du redigerer denne art', $x1],
    ['@Sprog:',     '4%','show','','left', '@Du redigerer formular med dette sprog', ListLookup($liste=SPR_Liste(),$search= $x2,$colsearch=1,$colresult=2)],
    ['@Format:',    '6%','show','','left', '@Du redigerer formular med denne sidestørrelse', ListLookup($liste=PaprListe(),$search= $x3,$colsearch=1,$colresult=2)],
    $extra
  );
}
  
######### :SYSTEM:
//  Tilpas feltrækkefølge for de forskellige arter:
# Kaldes fra: 
function GetFormdata($frm,$art,&$layout,&$stempel,&$grafik,&$images,&$tekster,&$ordrlin) {   ## outxx.php
// Functionen er udgået... #../_system/save_Formularer.php erstatter
  $tekster= []; $grafik= []; $images= []; $ordrlin= []; $stempel= []; $layout= [];
//  $DATA= sql_readB('SELECT form, frm_art, side, besk, just, FORMAT(x0,0), FORMAT(y0,0), FORMAT(dx,0), FORMAT(dy,0), FORMAT(dim,0), colr, font, style, imglnk, lngkey, note FROM tblA_forms ',__FILE__, __LINE__);
    $filDATA= ImportTabFile(realpath($_SERVER["DOCUMENT_ROOT"]). '/saldi-e/_exchange/_standard/formularer.v50.tab');  //  Ny version 5.0
  //  0:Form	1:Art	2:Side	3:Beskr	4:Just	5:X0	6:Y0	7:dx	8:dy	9:Hgt	10:Wdt	11:Colr	12:Font	13:Style	14:Src	15:LngKey	16:Note
  foreach ($filDATA as $rec)  //  Konvertering fra -- fil-format: 0:Form	1:Art	2:Side	3:Beskr	4:Just	5:X0	6:Y0	7:dx	8:dy	9:Hgt	10:Wdt	11:Colr	12:Font	13:Style	14:Src	15:Key	16:Note -- til tabel-format:
  { //    0       1       2       3       4     5     6     7     8     9     10      11      12      13      14      15      16
    list($_form, $_art, $_side, $_besk, $_just, $_x0, $_y0, $_dx, $_dy, $_hgt, $_hgt, $_wdt, $_colr, $_font, $_style, $_link, $_key, $_note) = $rec;
    if ($frm==$_form) {  //  Analyser kun en formular:
      $bemr= [utf8_decode($_besk)];
      //  $_hgt= 10;
      $note= [stripslashes(utf8_decode($_note))];
      if ($_art==0) {  ##  Specielle:
          if ($_side=='G')  ## Layout: 3:Papir   5:AntalLinier   6:LinieLængde   8:LinieAfstand   // @Linie antal'    @Top-linie    @Linieafstand   @Tekst Bredde    15:@Note   ?Korrekt?
           { $layout= [ [$_x0],[$_y0],[$_dy],[$_hgt],$note ]; }
        else ## Vandmærke/Stempel: 3:@Tekst/$variabel  5:@X    6:@Y   7:@Højde   8:@Bredde   10:@Farve  4:@Just.  11:@Font  2:@Side   15:@Note  13:Style(bold)  13:Style(italic)   ?Korrekt?
        { $dat= [$bemr,[$_x0],[$_y0],[$_dy],[$_dx],[$_hgt],[$_wdt],[strtoupper($_just)],[$_colr],[$_side],[isbold($_font)],[isital($_font)],$note,[$_font],[$_colr]]; array_push($stempel, $dat); }
      }
      if ($_art==1) { ## Grafik: 5:@X-venstre  6:@Y-bund   7:@Højde    8:@Bredde   9:px-bredde  2:@Side   10:@Farve  13:@Filnavn   15:@Note   ?Korrekt?
         if ($_besk=='') { $dat= [[$_x0],[$_y0],[$_dx],[$_dy],[$_hgt], [$_wdt], [$_side],$note]; array_push($grafik, $dat); }  //  Lines (Uden beskrivelse)
         if ($_besk!='') { $dat= [[$_x0],[$_y0],[$_dx],[$_dy],[$_side],[$_style],$note]; array_push($images, $dat); }          //  Image (Med beskrivelse f.eks. LOGO)
      }
      if ($_art==2)   ## Tekster: 3:@Tekst/$variabel  5:@X    6:@Y   7:@Højde   8:@Bredde  9:Hgt 10:@Farve  4:@Just.  11:@Font  2:@Side   15:@Note  13:Style(bold)  13:Style(italic)   ?Korrekt?
         { $dat= [$bemr,[$_x0],[$_y0],[$_dy],[$_dx],[$_hgt],[$_wdt],[strtoupper($_just)],[$_colr],[$_side],[isbold($_font)],[isital($_font)],$note]; array_push($tekster, $dat); }
      if ($_art==3)   ## Ordrelinier: 3:@Feltnavn  5:@X-pos   7:@Højde   8:@Bredde   10:@Farve   4:@Just.   11:Font    Fed  Skrå  15:@Note:   ?Korrekt?
         { $dat= [$bemr,[$_x0],[$_dx],[$_dy],[$_wdt],[$_just],[$_colr],[isbold($_font)],[isital($_font)],$note]; array_push($ordrlin, $dat); }
    }
  }
  return $tekster;  // var_dump($tekster);
}


######### :SYSTEM:
# Kaldes fra: [_base\out_vinduer.php]
function Panl_OrdrePostering( &$data) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'ordreform',$capt= '@Indtastning af salgs ordre poster - `Ordrelinier`:',$parms='page_Blindgyden.php',$icon='fas fa-database','panelWmax',__FUNCTION__);
  htm_Table(
   $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        ['@Status:',          '60%','', 'text','left', '@Her kan skrives en bemærkning til ordren', '@Ny ordre, endnu uden kundetilknytning!'], 
        ['@Kundetilknytning:','5em','', 'text','left', '@Angiv kontonummer på kunden','@Konto...'], 
      ),
   $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      ),
   $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Pos.',        '5%', '', 'text', ['left'], tolk('@Position tildeles automatisk.').' ','Pos...'],
        ['@Varenr',     '10%', '', 'text', ['left'], '@Varenummer hentes fra vareregistret.','Vare...'],
        ['@Antal',       '5%', '', 'text', ['left'], tolk('@Mængden af den aktuelle leverance.').' ','Ant...'],
        ['@Enhed',       '5%', '', 'text', ['left'], '@Enhedsbeskrivelse af mængden','Enh...'],
        ['@Beskrivelse','40%', '', 'text', ['left'], '@Leverance beskrivelse','Beskr...'],
        ['@Pris',       '10%', '', 'tal2d',['left'], '@Enhedspris','Pris...'],
        ['@Rabat%',      '6%', '', 'tal2d',['left'], '@Rabatsats i %. Angiv 0% og en reduceret enhedspris, hvis der skal ydes en beløbs rabat','Rabat'],
        ['@Moms%',       '6%', '', 'tal2d',['left'], '@Moms %-sats for den posterede leverance','Moms...'],
      # ['@Linie ialt', '10%', '', 'tal2d',['left'],tolk('@Beregnet beløb.')] tilføjes internt i htm_TabelInp
      ),
   $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ['@um.',        '5%', '', 'text',['center'],'@um. (uden moms) kan benyttes til at bogføre beløb uden moms på konti, selvom kontoen har en momssats tilknyttet.', 
                                      '<input type= "checkbox" name="udenmoms" value="" >'],
        ['@Linie ialt', '8%', '', 'text',['center'],'@Beregnet felt med summen af de samlede beløb', '00.000,00'] #'<div type= "text" name="saldo" value="00.000,00" width="8%">']
      ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON]
   $DATA, /* =   array(      ), */
   $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
   $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
   $CreateRec=true,       # Mulighed for at oprette en record
   $ModifyRec=true,       # Mulighed for at ændre data i en row
   $ViewHeight= '500px',  # Højden af den synlige del af tabellens data
    __FUNCTION__
  );
 
### PanelFooter:
#+  NaviTip();
### KnapPanel:
  htm_CentrOn();
    //textKnap($label='@Gem',             $title='@Klik her for at gemme',$link='../_base/page_Blindgyden.php');
    textKnap($label='@Opslag',          $title='@Opslag - din markørs placering angiver hvilken tabel, opslag foretages i',$link='../_base/page_Blindgyden.php');
    textKnap($label='@Slet alt',        $title='@Klik her for at nulstille alle data i tabellen.',$link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :SYSTEM:
# Kaldes fra:  [_system/page_Regnskabsaar.php] 
function Panl_Regnskabsaar(&$TablData) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'regnform',$capt= '@Regnskabsår:',$parms='../_system/page_Valuta.php',$icon='fas fa-database','panelW480',__FUNCTION__); 
  echo '<captlabl>';      
		htm_FrstFelt('30%');  
		htm_NextFelt('22%');    echo tolk('@Periode start:');  
		htm_NextFelt('22%');    echo tolk('@Periode slut:');   
		htm_NextFelt('8%');     
		htm_LastFelt(); 
	echo '</captlabl>';
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        []
      ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
              ['@ID.',        '10%','indx','',['center'], '@Entydigt systemindex, som benyttes af systemet,','@auto...'],
              ['@Beskrivelse','20%','text','',['left'  ], '@Beskrivende tekst for perioden','@Besk...'],
              ['@Måned',      '15%','text','',['center'], '@Periodens første måned','@md...'],
              ['@År',         '10%','text','',['left'  ], '@Perioden starter i år', '@år...'],
              ['@Måned',      '15%','text','',['center'], '@Periodens sidste måned','@md...'],
              ['@År',         '10%','text','',['left'  ], '@Perioden slutter i år', '@år...'],
              ['@Status',     '10%','html','',['center'], '@Regnskabets status',    '@Stat...'],
      ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        []
      ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $TablData/* =   array(
      ) */,
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '200px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_Caption('@Værd at vide:');
  htm_Plaintxt('@Når du opretter et nyt regnskabsår, skal du huske at gøre det aktivt, ved at sætte flueben i "Bogføring tilladt", på regnskabskortet.');
  htm_AcceptKnap($labl='Gem', $title='@Gem/opdater, hvad du har rettet ovenfor', $type='save', $form='regnform', $width='', $akey='');
  htm_PanlBund($pmpt=Tolk('@Gem'),$subm=false,$title='@Gem/opdater, hvad du har rettet ovenfor');
}

######### :SYSTEM:
# Kaldes fra:  [_system/page_Regnskabsaar.php] [_system/page_Regnskabskort.php] 
function Panl_Regnskabskort(&$DATA, $besk='2016', $aar0='2016', $md0='01', $aar1='2016', $md1='12', $aktiv=true, $fak1Nr) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'kortform',$capt= '@Regnskabskort:',$parms='../_system/page_Valuta.php',$icon='fas fa-pen-square','panelW480',__FUNCTION__); 
  echo tolk('@Fastlæg 1. regnskabsår: 2016').'<br><br>';
  echo '<captlabl>';
  htm_FrstFelt('40%');    echo tolk('@Regnskabsår:');
  htm_NextFelt('20%');    echo tolk('@Periode start:');
  htm_NextFelt('20%');    echo tolk('@Periode slut:');
  htm_NextFelt('20%');    echo tolk('@Bogføring:');
  htm_LastFelt();    
  echo '</captlabl>';
  htm_FrstFelt('40%');    htm_CombFelt($type='text',    $name='besk',  $valu= $besk, $labl='@Beskrivelse.',  $titl='@Angiv Beskrivelse',         $revi=true, $rows='',$width='30',$step='0.5');
  htm_NextFelt('10%');    htm_CombFelt($type='text',    $name='md0',   $valu= $md0,  $labl='@Måned',         $titl='@Angiv periode start Måned', $revi=true, $rows='',$width='30');
  htm_NextFelt('10%');    htm_CombFelt($type='text',    $name='aar0',  $valu= $aar0, $labl='@År',            $titl='@Angiv periode start År',    $revi=true, $rows='',$width='30');
  htm_NextFelt('10%');    htm_CombFelt($type='text',    $name='md1',   $valu= $md1,  $labl='@Måned',         $titl='@Angiv periode slut Måned',  $revi=true, $rows='',$width='30');
  htm_NextFelt('10%');    htm_CombFelt($type='text',    $name='aar1',  $valu= $aar1, $labl='@År',            $titl='@Angiv periode slut År',     $revi=true, $rows='',$width='30');
  htm_NextFelt('20%');    htm_CheckFlt($type='checkbox',$name='aktiv', $valu= $aktiv,$labl='@tilladt',   $titl='@Angiv om bogføring er tilladt', $revi=true);
  htm_LastFelt();       
  
  htm_Caption('&nbsp;'.tolk('@Auto nummerering:'));
  htm_FrstFelt('33%');    htm_CombFelt($type='text',    $name='regn',  $valu= $fak1Nr,   $labl='@1. faktura nummer',     
          $titl='@Faktura nummer for periodens første faktura',   $revi=true, $rows='2',$width='',$step='', $more='', $plho=tolk('@Faktura...'));
  htm_NextFelt('33%');    htm_CombFelt($type='text',    $name='regn',  $valu= $fak1Nr,   $labl='@1. modtagelses nummer', 
          $titl='@Modtagelses nummer for periodens første bilag', $revi=true, $rows='2',$width='',$step='', $more='', $plho=tolk('@Modtage...'));
  htm_NextFelt('33%');
  htm_LastFelt();       
  
  htm_Caption('@Bilags nummerering:');
  htm_FrstFelt('30%');    htm_CheckFlt($type='checkbox',$name='aktiv', $valu= $aktiv,  $labl='@Undlad v. faktura',$titl='@Undlad nummerering ved faktura', $revi=true);
  htm_NextFelt('30%');    htm_CheckFlt($type='checkbox',$name='aktiv', $valu= $aktiv,  $labl='@Brug faktura-nr.', $titl='@Brug fakturas nummerering',      $revi=true);
  htm_NextFelt('30%');    htm_CheckFlt($type='checkbox',$name='aktiv', $valu= $aktiv,  $labl='@Brug modtage-nr.', $titl='@Brug modtage nummerering',       $revi=true);
  htm_LastFelt();       
  htm_CentrOn(); 
    textKnap($label='@Gem rettelser', $title='@Gem hvad du har rettet ovenfor',$link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_hr();
  
#  echo '<hr>'.tolk('@Indtast primotal for 1. regnskabsår:');
    htm_Caption('@Åbningsbeløb for konti:','font-weight:800;');
    htm_Table(
      $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Her angives primotal for:', '13%','show','left', '', '', '@Regnskabsåret'],
        ),
      $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
      $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Konto.',     '12%','show',  '',['center'], '@Entydigt konto nummer, fastlagt i kontoplanen.','@auto...'],
          ['@Beskrivelse','60%','show',  '',['left'  ],   '@Tekst som beskriver kontoen, fastlagt i kontoplanen.','@Besk...'],
          ['@Debet',      '14%','tal2d', '',['right' ],  '@Debet primosaldo','primo...','SW'],
          ['@Kredit',     '14%','tal2d', '',['right' ],  '@Kredit primosaldo','primo...','SW'],
        ),
      $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON]
      $DATA= MakeStatusKonti(),
      /* $DATA=   array(
        ), */
      $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
      $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
      $CreateRec=true,       # Mulighed for at oprette en record
      $ModifyRec=true,       # Mulighed for at ændre data i en row
      $ViewHeight= '500px',  # Højden af den synlige del af tabellens data
      $CalledFrom= __FUNCTION__
  );
  htm_Caption('@Værd at vide:');
  htm_Plaintxt('@En typisk årsag til at åbningsbalancen ikke stemmer, er at sidste års resultat, ikke er indregnet i egenkapitalen primo.');
  //  htm_CentrOn();     textKnap($label='@Gem', $title='@Gem det du har rettet ovenfor',$link='../_base/page_Blindgyden.php');  htm_CentOff();
  htm_AcceptKnap($labl='Gem', $title='@Gem/opdater, hvad du har rettet ovenfor', $type='save', $form='kortform', $width='', $akey='');
  htm_PanlBund($pmpt=Tolk('@Retur til indstillinger'),$subm=false,$title='@Luk og gå retur til indstillingsmenu');
}

######### :SYSTEM:
# Kaldes fra: 
function MakeStatusKonti() {  ## out_PanlsSekd.php
  $StatusKt= array();
  $filDATA= ImportTabFile('../_exchange/kontoplan.tab');
  foreach ($filDATA as $rec) {if ($rec[2]=='S') array_push($StatusKt, [$rec[0],utf8_decode($rec[1]),'0.00','0.00']);}
  return $StatusKt;
}
######### :SYSTEM:
# Kaldes fra:  [_system/page_FormGrafik.php] [_system/page_FormOrdrelin.php] [_system/page_FormText.php] 
function Panl_Formularer( &$formtype, &$formart, &$formsprog, &$formformat) {  ## out_PanlsSekd.php
global $Øart;
  htm_Panl_Top($name= '',$capt= '@Formular redigering',$parms='../_system/page_Valuta.php',$icon='fas fa-wrench','panelW240',__FUNCTION__);
  htm_Tapet_Top($name='tapetform',$capt= '',$parms='#',$icon='','panelWaut',__FUNCTION__);
  $formtype=   $_POST['formtype'];   if (!$formtype) $formtype= '4';
  if    (isset($_POST['formart'])) $formart= $_POST['formart'];
  $formsprog=  $_POST['formsprog'];  if (!$formsprog)  $formsprog=  'dansk';
  $formformat= $_POST['formformat']; if (!$formformat) $formformat= 'A4p';
  
  htm_OptioFlt($type='text',  $name='formtype',   $valu= $formtype,   $labl='@Formular',      
                    $titl='@Vælg en Formular, som du vil redigere',             $revi=true,   $optlist= FRM_Liste(),  $action='', $events='', $maxwd='140px');
  htm_OptioFlt($type='text',  $name='formart',    $valu= $formart,    $labl='@Formular Art',     
                    $titl='@Vælg formularens Art (Objekt type)',                $revi=true,   $optlist= FormObjkt(),  $action='onchange="getComboA(this)"');
  htm_OptioFlt($type='text',  $name='formsprog',  $valu= $formsprog,  $labl='@Formular Sprog',      
                    $titl='@Vælg hvilket Sprog, du vil benytte på formularen',  $revi=false,  $optlist= SPR_Liste(),  $action='');
/*   htm_OptioFlt($type='text',  $name='formformat',   $valu= $formformat,  $labl='@Formular format',      
                    $titl='@Vælg hvilken papirstørrelse, du vil benytte for formularen',  $revi=false, $optlist= PaprListe(), $action='');
 */  
  htm_nl();
  htm_accept('@Rediger det valgte','@Rediger det du har valgt ovenfor', $width='', $akey='', $form='tapetform');
  //  htm_AcceptKnap('@Rediger det valgte','@Rediger det du har valgt ovenfor', $type='save', $form='tapetform', $width='', $akey='');
  htm_nl();
  htm_TapetBund($formslut=true);
  htm_nl();
  echo '<div align="center">';
  textKnap($label='@Forhåndsvisning',                   $title='@Vis layout for en vilkårlig formular',$link='../_base/page_Printlayout.php').'<br><br>';
  textKnap($label='@Opret clon af en formular',         $title='@Opret en ny formular, som en kopi af en eksisterende formular.',    $link='../_base/page_Blindgyden.php').'<br><br><hr>';
  htm_nl();
  htm_Caption('Formular adminstration:');
  textKnap($label='@Gem mine formularer',               $title='@Lav backup til fil, af det nugældende formularsæt.',    $link='../_base/page_Blindgyden.php').'<br><br>';
  textKnap($label='@Genindlæs mine formularer',         $title='@Tag backup fra fil i brug, ved at benytte den som gældende formularsæt. (Overskriver!)',$link='../_base/page_Blindgyden.php').'<br><br>';
  textKnap($label='@Importer formular(er) fra LO ',     $title='@Indlæs fra .fodg-fil dannet af formularredigering i LibreOffice',   $link='../_base/page_Blindgyden.php').'<br><br>';
  textKnap($label='@Overskriv formularer med standard', $title='@Overskriv de aktive formular-definitioner med system standard',$link='../_base/page_Blindgyden.php').'<br><br>';
  textKnap($label='@Håndtering af formularsprog',       $title='@Sproghåndtering: Opret, Nedlæg sprog',         $link='../_base/page_Blindgyden.php').'<br><br>';
  textKnap($label='@Upload/Download supportfiler',      $title='@Fil upload: Logo, Grafik, Billeder eller fodg-fil fra Libre Office',$link='../_base/page_Blindgyden.php').'<br><br>';
  echo '</div>';
  htm_nl();
  htm_hr();
  htm_CentrOn();
    naviKnap($label='@Indstillinger 1', $title='@Gå til indstillings menuen',$link='../_system/page_Valuta.php',$akey='1');
  htm_CentOff();
  htm_PanlBund($pmpt='@Retur til indstillinger',$subm=true,$title='@Gå til menuen indstillinger');
  return [$formtype,$formart,$formsprog,$formformat];
}


######### :SYSTEM:
# Kaldes fra: [_system/page_FormText.php] 
function Panl_FormRedigerLayout($frm,$art,$lang,$papr) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'edit',$capt= '@Rediger Formular: Layout og mail-tekster',$parms='#',$icon='fas fa-wrench','panelW960',__FUNCTION__);
  $link= '';
  htm_Caption('@Formular størrelse:');
  htm_OptioFlt($type='text',  $name='papir',      $valu= $papr,      
               $labl='@Format',   
               $titl='@Her kan du slå op, og vælge blandt standard papir-formater', 
               $revi=true, $optlist=PaprListe(), $action='');
  htm_nl();    htm_hr('Red; size:4;');
  htm_Caption('@Stempler/Vandmærker:');
  htm_Table(
    $TblCapt= //array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        SetHeadArr($frm,'@Stempler',$lang,$papr),
      //),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    //    ['@Ix',            '4%','data','',['center'],'@Index','pos...']
      ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Id.',           '0%','hidd','',['center'],'@Index','serial...'],
        ['@Nr.',           '0%','hidd','',['center'],'@Formular nr','kode...'],
        ['@Art',           '0%','hidd','',['center'],'@Koden for feltes art','art...'],
        ['@Side',          '4%','side','',['center'],'@Udskrift på side kode: A !1 1 S !S','side...','1'],
        ['@Beskrivelse',  '20%','data','',['left'  ],'@Feltets tekstindhold samt $variabler','?'],
        ['@Just',          '4%','just','',['center'],'@Justering af teksten:'. ShowCol($liste=JustListe(),$col= 0,$sep='<br>'),'-','V'],
        ['@X0',            '4%','data','',['right' ],'@Indsætnings X-koordinat (mm fra formularens venstre kant)','X0...',''],
        ['@Y0',            '4%','data','',['right' ],'@Indsætnings Y-koordinat (mm fra formularens top kant)','Y0...'],
        ['@Brd.',          '4%','data','',['right' ],'@Felt bredde (mm)','F-b...'],
        ['@Høj.',          '4%','data','',['right' ],'@Felt højde (mm)'.'<br>'.tolk('@Angiv 0 for at autotilpasse'),'F-h...'],
        ['@Dim.',          '4%','data','',['right' ],'@Objektets dimension: Streg-bredde, Tegn-højde, målt i px (pixel)','Obj-D...'],
        ['@Farve',         '6%','data','',['center'],'@Objektets farve, angives som HTML5 tillader. (red, #FF44DD, rgb)','farve...','red'],
        ['@Txt-font',     '10%','font','',['left'  ],'@Objektets font'.str_nl().tolk('(gyldigt argument til: font-family):'). ShowCol($liste=FontListe(),$col= 2,$sep=str_nl()),'-','Times'],
        ['@Txt-style',    '15%','data','',['left'  ],'@Objektets style'.'<br>'.tolk('(gyldigt argument til: font-weight, font-style). Husk afsluttende semikolon!'),'-','bold; transform: rotate(-35deg); '],
        ['@Grafik',        '0%','hidd','',['left'  ],'@Link til grafikfil','graf...'],
        ['@Fremmedsprog',  '0%','hidd','',['left'  ],'@Alternativ beskrivelse, f.eks. på engelsk','alt...'],
        ['@Note',         '15%','data','',['left'  ],'@Note til objektet','note...']
      ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ['@Slet',          '4%','text','',['center'],'@Klik på rødt kryds for at slette dette stempel', '<ic class="far fa-times-circle" style="color:red; font-size:13px;"></ic>']
      ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON]
    //DATA=   array(),
     $stempel= sql_readB('SELECT id, form, frm_art, side, besk, just, FORMAT(x0,0), FORMAT(y0,0), FORMAT(dx,0), FORMAT(dy,0), FORMAT(dim,0), colr, font, style, imglnk, lngkey, note '.
                         'FROM tblA_forms '.
                         'WHERE form= "'.$frm.'" AND frm_art= "0" AND side!= "G"',__FILE__, __LINE__) , 
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '200px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_Caption('@Special style:');
  htm_FrstFelt('05%');  htm_CombFelt($type='number', $name='ix', $valu= 0, $labl='@Index', $titl='@Her kan du vælge hvilken tekst du vil tilpasse', 
          $revi=true, $rows='', $width='5',$step=1,$more='min="0" max="'.(sizeof($stempel)-1).'"');
  htm_NextFelt('30%');  htm_CombFelt($type='text',  $name='style',  $valu= $stempel[0][12],  $labl='@Txt-font',  
          $titl='@Her kan du tilpasse font-family, som skal være i samme format, som benyttes i HTML-5.<br>f.eks: font-family: "Times New Roman", Georgia, Serif; <br>(udelad font-family:)', $revi=false, $rows='', $width='',$step='',$more='placeholder=" '.tolk('@Font...').'"');
  htm_NextFelt('40%');  htm_CombFelt($type='text',  $name='style',  $valu= $stempel[0][13],  $labl='@Txt-style',  
          $titl='@Her kan du tilpasse supplerende special font style, som skal være i samme format, som benyttes i HTML-5. <br>f.eks: font: italic bold 12px/30px Georgia, serif; <br>(udelad font:)', $revi=false, $rows='', $width='',$step='',$more='placeholder=" '.tolk('@Style...').'"');
  htm_NextFelt('20%');  htm_Plaintxt('Virker ikke endnu.');
  htm_LastFelt(); 
  htm_nl();    htm_hr('Red; size:4;');
  htm_Caption('@Mail tekster:');
  htm_FrstFelt(' 5%');  echo '<div style= "text-align:right"></div>';
  htm_NextFelt('30%');  htm_CombFelt($type='area',  $name='emne',   $valu= '',  $labl='@Emne',   
          $titl='@Her kan du angive mailens emne-tekst.',        $revi=true,$rows='2',$width='45',$step='',$more='placeholder=" '.tolk('@Vedrørende...').'"');
  htm_NextFelt('45%');  htm_CombFelt($type='area',  $name='besked', $valu= '',  $labl='@Besked', 
          $titl='@Besked til modtageren.',                       $revi=true, $rows='', $width='45',$step='',$more='placeholder=" '.tolk('@Vedhæftet følger...').'"');
  htm_NextFelt('20%');  htm_CombFelt($type='area',  $name='bilag',  $valu= '',  $labl='@Bilag',  
          $titl='@Angiv navne, på de filer der skal vedhæftes.', $revi=true, $rows='', $width='45',$step='',$more='placeholder=" '.tolk('@PDF-fil...').'"');
  htm_LastFelt(); 
  htm_PanlBund($pmpt='@Gem',$subm=true);
} //  Panl_FormRedigerLayout


######### :SYSTEM:
# Kaldes fra: [_system/page_FormText.php] 
function Panl_FormRedigerText($frm,$art,$lang,$papr) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'edit',$capt= tolk('@Rediger Formular:').' '.substr(ListLookup($liste=FRM_Liste(), $search= $frm,
      $colsearch=1,$colresult=2),3).' - '.tolk('@Tekster'),$parms='#',$icon='fas fa-wrench','panelW960',__FUNCTION__);
  htm_Table(
   $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
      ),
   $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      ),
   $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Id.',           '0%','hidd','',['center'], '@Index','serial...'],
        ['@Nr.',           '0%','hidd','',['center'], '@Formular nr','kode...'],
        ['@Art',           '0%','hidd','',['center'], '@Koden for feltes art','art...'],
        ['@Side',          '2%','side','',['center'], '@Udskrift på side kode: A !1 1 S !S','side...','A'],
        ['@Beskrivelse',  '32%','data','',['left'  ], '@Feltets tekstindhold samt $variabler','tekst...'],
        ['@Just',          '3%','just','',['center'], '@Justering af teksten:'. ShowCol($liste=JustListe(),$col= 0,$sep='<br>'),'-','V'],
        ['@X0',            '2%','data','',['right' ], '@Indsætnings X-koordinat (mm fra formularens venstre kant)','X0...',''],
        ['@Y0',            '2%','data','',['right' ], '@Indsætnings Y-koordinat (mm fra formularens top kant)','Y0...'],
        ['@Brd.',          '2%','data','',['right' ], '@Felt bredde (mm)','F-b...'],
        ['@Høj.',          '2%','data','',['right' ], '@Felt højde (mm)'.'<br>'.tolk('@Angiv 0 for at autotilpasse'),'F-h...'],
        ['@Dim.',          '2%','data','',['right' ], '@Objektets dimension: Streg-bredde, Tegn-højde, målt i px (pixel)','Obj-D...'],
        ['@Farve',         '6%','data','',['center'], '@Objektets farve, angives som HTML5 tillader. (red, #FF44DD, rgb)','farve...'],
        ['@Txt-font',     '10%','font','',['left'  ], '@Objektets font'.str_nl().tolk('(gyldigt argument til: font-family):'). ShowCol($liste=FontListe(),$col= 2,$sep=str_nl()),'font...','Helvetica'],
        ['@Txt-style',    '12%','data','',['left'  ], '@Objektets style'.'<br>'.tolk('(gyldigt argument til: font-weight, font-style). Husk afsluttende semikolon!'),'style...'],
        ['@Grafik',        '0%','hidd','',['left'  ], '@Link til grafikfil','graf...'],
        ['@Fremmedsprog',  '0%','hidd','',['left'  ], '@Alternativ beskrivelse, f.eks. på engelsk','alt...'],
        ['@Note',         '15%','data','',['left'  ], '@Note til objektet','note...']
      ),
   $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ['@Slet',          '4%','text','',['center'],'@Klik på rødt kryds for at slette dette tekstfelt','<ic class="far fa-times-circle" style="color:red; font-size:13px; "></ic>']
      ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON]
   $tekster= sql_readB('SELECT id, form, frm_art, side, besk, just, FORMAT(x0,0), FORMAT(y0,0), FORMAT(dx,0), FORMAT(dy,0), FORMAT(dim,0), colr, font, style, imglnk, lngkey, note '.
                       'FROM tblA_forms '.
                       'WHERE form= "'.$frm.'" AND frm_art= "2"',__FILE__, __LINE__) , 
      /* $DATA=   array(
      ), */
   $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
   $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
   $CreateRec=true,       # Mulighed for at oprette en record
   $ModifyRec=true,       # Mulighed for at ændre data i en row
   $ViewHeight= '500px',  # Højden af den synlige del af tabellens data
   $CalledFrom= __FUNCTION__
  );
  htm_Caption('@Tip:'); htm_nl();
  htm_Plaintxt(
    tolk('@Når du indsætter et variabelnavn, kommer der ved udskrift automatisk et mellemrum mellem variablens indhold og den efterfølgende tekst.').str_nl().
    tolk('@Ønsker du ikke dette mellemrum, kan du afslutte variabelnavnet med et semikolon.').str_nl().
    tolk('@Det er fx. relevant, hvis du vil indsætte teksten Momssats 25% på en faktura.').str_nl().
    tolk('@Her vil kodningen skulle være Momssats $ordre_momssats;% '));
  htm_PanlBund($pmpt='@Gem',$subm=true,'','','','edit');
}

######### :SYSTEM:
# Kaldes fra: [_system/page_FormGrafik.php] [_system/page_FormText.php] 
function Panl_FormRedigerGrafik($frm,$art,$lang,$papr) {   ## out_PanlsSekd.php
  htm_Panl_Top($name= 'edit',$capt= '@Rediger Formular: Grafik',$parms='#',$icon='fas fa-wrench','panelW960',__FUNCTION__);
  htm_Table(
    $TblCapt= //array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          SetHeadArr($frm,'@Grafik',$lang,$papr),
        //),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ['@BILLEDER:',    '15%','text','',['right'],'$Grafik f.eks. jpg-billeder. Billeder skaleres til den angivne højde/bredde. Det er en fordel, hvis billede er målfast med 720 pt/in.']
      ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Id.',           '0%','hidd','',['center'],'@Index','serial...'],
        ['@Nr.',           '0%','hidd','',['center'],'@Formular nr','kode...'],
        ['@Art',           '0%','hidd','',['center'],'@Koden for feltes art','art...'],
        ['@Side',          '5%','side','',['center'],'@Medtages på udskrifts side. A:alle, 1:første, !1:ikke første, S:sidste, !S:ikke sidste','side...','1'],
        ['@Beskrivelse',   '0%','hidd','',['left'  ],'@Feltets tekstindhold samt $variabler',  '-'],
        ['@Just',          '0%','hidd','',['center'],'@Justering af teksten:'. ShowCol($liste=JustListe(),$col= 0,$sep='<br>'),'-','V'],
        ['@X-venstre',     '6%','data','',['right' ],'@Billedets x-indsætningspunkt målt i mm fra venstre side-kant','.x.'],
        ['@Y-bund',        '6%','data','',['right' ],'@Billedets y-indsætningspunkt målt i mm fra side-top','.y.'],
        ['@Bredde',        '4%','data','',['right' ],'@Billedets bredde målt i mm. Der skaleres til den angivne bredde','.b.'],
        ['@Højde',         '4%','data','',['right' ],'@Billedets højde målt i mm. Hvis originalens H/B-forhold ikke er som angivet her, forvrænges grafikken','.h.'],
        ['@Dim.',          '0%','hidd','',['right' ],'@Objektets dimension: Streg-bredde, Tegn-højde, målt i px (pixel)','Obj-D...'],
        ['@Farve',         '0%','hidd','',['center'],'@Objektets farve, angives som HTML5 tillader. (red, #FF44DD, rgb)','farve...'],
        ['@Txt-font',      '0%','hidd','',['left'  ],'@Objektets font'.str_nl().tolk('(gyldigt argument til: font-family):'). ShowCol($liste=FontListe(),$col= 2,$sep=str_nl()),'-'],
        ['@Txt-style',     '0%','hidd','',['left'  ],'@Objektets style'.'<br>'.tolk('(gyldigt argument til: font-weight, font-style). Husk afsluttende semikolon!'),'-'],
        ['@Filnavn',      '45%','data','',['left'  ],'@Referance til billed-filen (src="Path/Name.typ" alt="Billedtekst")'.' (?.jpg)'],
        ['@Fremmedsprog',  '0%','hidd','',['left'  ],'@Alternativ beskrivelse, f.eks. på engelsk','alt...'],
        ['@Note',         '25%','data','',['left'  ],'@Note til objektet.'],
      ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ['@Slet',          '8%','text','',['center'],'@Klik på rødt kryds for at slette dette billede','<ic class="far fa-times-circle" style="color:red; font-size:13px; "></ic>']
      ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON, ]
    //$DATA,#=   array(),
    $images= sql_readB('SELECT id, form, frm_art, side, besk, just, FORMAT(x0,0), FORMAT(y0,0), FORMAT(dx,0), FORMAT(dy,0), FORMAT(dim,0), colr, font, style, imglnk, lngkey, note '.
                       'FROM tblA_forms '.
                       'WHERE form= "'.$frm.'" AND frm_art= "1" AND besk > ""',__FILE__, __LINE__) ,
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '200px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
    
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
          ['STREGER:',      '13%','text','',['right' ],'@Grafiske linier']
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Id.',           '0%','hidd','',['center'],'@Index','serial...'],
          ['@Nr.',           '0%','hidd','',['center'],'@Formular nr','kode...'],
          ['@Art',           '0%','hidd','',['center'],'@Koden for feltes art','art...'],
          ['@Side',          '5%','side','',['center'],'@Medtages på udskrifts side. A:alle, 1:første, !1:ikke første, S:sidste, !S:ikke sidste','','A'],
          ['@Beskrivelse',   '0%','hidd','',['left'  ],'@Feltets tekstindhold samt $variabler',  '-'],
          ['@Just',          '0%','hidd','',['center'],'@Justering af teksten:'. ShowCol($liste=JustListe(),$col= 0,$sep='<br>'),'-'],
          ['@X-start',       '6%','data','',['right' ],'@Stregens x-startpunkt målt i mm fra venstre side-kant','.x.'],
          ['@Y-start',       '6%','data','',['right' ],'@Stregens y-startpunkt målt i mm fra side-top','.y.'],
          ['@delta-X',       '6%','data','',['right' ],'@Stregens udstrækning i x-retning målt i mm','.dx.'],
          ['@delta-Y',       '6%','data','',['right' ],'@Stregens udstrækning i y-retning målt i mm','.dy.'],
          ['@Bredde',        '6%','data','',['right' ],'@Stregens bredde målt i px','.b.'],
          ['@Farve',         '6%','data','',['center'],'@Objektets farve, angives som HTML5 tillader. (red, #FF44DD, rgb)','farve...'],
          ['@Txt-font',      '0%','hidd','',['left'  ],'@Objektets font'.str_nl().tolk('(gyldigt argument til: font-family):'). ShowCol($liste=FontListe(),$col= 2,$sep=str_nl()),'-'],
          ['@Txt-style',     '0%','hidd','',['left'  ],'@Objektets style'.'<br>'.tolk('(gyldigt argument til: font-weight, font-style). Husk afsluttende semikolon!'),'-'],
          ['@Grafik',        '0%','hidd','',['left'  ],'@Link til grafikfil','graf...'],
          ['@Fremmedsprog',  '0%','hidd','',['left'  ],'@Alternativ beskrivelse, f.eks. på engelsk','alt...'],
          ['@Note',         '45%','data','',['left'  ],'@Huske-tip for denne streg...',' '.tolk('@Stregen angår...')],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
          ['@Slet',          '8%','text','',['center'],'@Klik på rødt kryds for at slette denne streg','<ic class="far fa-times-circle" style="color:red; font-size:13px; "></ic>']
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON, ]
    //$DATA,#=   array(),
    $grafik= sql_readB('SELECT id, form, frm_art, side, besk, just, FORMAT(x0,0), FORMAT(y0,0), FORMAT(dx,0), FORMAT(dy,0), FORMAT(dim,0), colr, font, style, imglnk, lngkey, note '.
                       'FROM tblA_forms '.
                       'WHERE form= "'.$frm.'" AND frm_art= "1" AND besk = ""',__FILE__, __LINE__) ,
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter   //  Virker ikke med hidd-felter!
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '400px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
    //  XY_forskydning();
  htm_PanlBund($pmpt='@Gem',$subm=true,'','','','edit');
} //  Panl_FormRedigerGrafik

######### :SYSTEM:
# Kaldes fra:  [_system/page_FormOrdrelin.php] [_system/page_FormText.php] 
function Panl_FormRedigerOrdrelin($frm,$art,$lang,$papr) {   ## out_PanlsSekd.php
  htm_Panl_Top($name= 'edit',$capt= '@Rediger Formular: Ordrelinier',$parms='#',$icon='fas fa-wrench','panelW960',__FUNCTION__);
  htm_Table(
    $TblCapt= //array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        SetHeadArr($frm,'@Ordrelinjer',$lang,$papr),
        //),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
          ['@Generelt: ',   '15%','text','',['right' ],'@Ordreliniers placering på siden: ']
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Id.',           '0%','hidd','',['center'],'@Index','serial...'],
          ['@Nr.',           '0%','hidd','',['center'],'@Formular nr','kode...'],
          ['@Art',           '0%','hidd','',['center'],'@Koden for feltes art','art...'],
          ['@Side',          '4%','hidd','',['center'],'@Udskrift på side kode: A !1 1 S !S','side...','A'],
          ['@Beskrivelse',   '0%','hidd','',['left'  ],'@Feltets tekstindhold samt $variabler',  '-'],
          ['@Just',          '0%','hidd','',['center'],'@Justering af teksten:'. ShowCol($liste=JustListe(),$col= 0,$sep='<br>'),'-'],
          ['@Antal linier',  '8%','data','',['center'],'@Antal ordrelinier pr. side.','.n.'],
          ['@Top-linie',     '8%','data','',['center'],'@Første ordrelines y-startpunkt (grundlinie) målt i mm fra side-top','.y.'],
          ['@Tekst Bredde',  '8%','data','',['center'],'@Maksimal linie længde for beskrivelse, inden der brydes til ny linie, målt i mm. ','.Bredde [mm].'],
          ['@Linieafstand',  '8%','data','',['center'],'@Afstand mellem liniers grundlinie, målt i mm. ','.Afstand [mm].'],
          ['@Dim.',          '0%','hidd','',['right' ],'@Objektets dimension: Streg-bredde, Tegn-højde, målt i px (pixel)','Obj-D...'],
          ['@Farve',         '0%','hidd','',['center'],'@Objektets farve, angives som HTML5 tillader. (red, #FF44DD, rgb)','farve...'],
          ['@Txt-font',      '0%','hidd','',['left'  ],'@Objektets font'.str_nl().tolk('(gyldigt argument til: font-family):'). ShowCol($liste=FontListe(),$col= 2,$sep=str_nl()),'-'],
          ['@Txt-style',     '0%','hidd','',['left'  ],tolk('@Objektets style').'<br>'.tolk('(gyldigt argument til: font-weight, font-style). Husk afsluttende semikolon!'),'-'],
          ['@Grafik',        '0%','hidd','',['left'  ],'@Link til grafikfil','graf...'],
          ['@Fremmedsprog',  '0%','hidd','',['left'  ],'@Alternativ beskrivelse, f.eks. på engelsk','alt...'],
          ['@Note',         '30%','data','',['left'  ],'@Huske-tip for disse generelle data.','.?.'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON, ]
    //$DATA,#=   array(),
    $ordrlin= sql_readB('SELECT id, form, frm_art, side, besk, just, FORMAT(x0,0), FORMAT(y0,0), FORMAT(dx,0), FORMAT(dy,0), FORMAT(dim,0), colr, font, style, imglnk, lngkey, note '.
                        'FROM tblA_forms '.
                        'WHERE form= "'.$frm.'" AND frm_art= "0" AND side= "G"',__FILE__, __LINE__) ,
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter   //  Virker ikke med hidd-felter!
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '90px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
          ['ORDRELINIER:',  '15%','text','',['right' ],'@Tekst linier med ordrepostering.','Kolonne:']
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Id.',           '0%','hidd','',['center'],'@Index','serial...'],
          ['@Nr.',           '0%','hidd','',['center'],'@Formular nr','kode...'],
          ['@Art',           '0%','hidd','',['center'],'@Koden for feltes art','art...'],
          ['@Side',          '4%','side','',['center'],'@Udskrift på side kode: A !1 1 S !S','side...','A'],
          ['@Beskrivelse',  '16%','data','',['left'  ],'@Navnet på variablen, samt statisk tekst. Variabler som benyttes i ordrelinier, her prefix: £','@navn...'],
          ['@Just.',         '4%','just','',['center'],'@Justering i feltet: V:venstre, C:centreret, H:højre','?','V'],
          ['@X-pos',         '6%','data','',['right' ],'@Tekstens x-startpunkt målt i mm fra formularens venstre side-kant','.x.'],
          ['@Y0',            '0%','hidd','',['right' ],'@Indsætnings Y-koordinat (mm fra formularens top kant)','Y0...'],
          ['@Bredde',        '6%','data','',['right' ],'@Reserveret felt bredde målt i [mm]. Længere tekster ombrydes i flere linier','.b.'], // Kun væsentlig for Beskrivelse
          ['@Højde',         '6%','data','',['right' ],'@Teksthøjde målt i [px]','.h.'],
          ['@Dim.',          '0%','hidd','',['right' ],'@Objektets dimension: Streg-bredde, Tegn-højde, målt i px (pixel)','Obj-D...'],
          ['@Farve',         '6%','data','',['center'],'@Objektets farve, angives som HTML5 tillader. (red, #FF44DD, rgb)','farve...'],
          ['@Font',          '8%','font','',['center'],'@Skrift type navn: Helvetica, Times, OCRbb12','Font navn...','Helvetica'],
          ['@Fed',           '4%','bold','',['center'],'@Bold skrift type, også kaldet fed skrift','<input type= "checkbox" name="bold" value="" >','.?.'],
          ['@Skrå',          '4%','ital','',['center'],'@Skrå skrift type, også kaldet italic','<input type= "checkbox" name="italic" value="" >','.?.'],
          ['@Grafik',        '0%','hidd','',['left'  ],'@Link til grafikfil','graf...'],
          ['@Fremmedsprog',  '0%','hidd','',['left'  ],'@Alternativ beskrivelse, f.eks. på engelsk','alt...'],
          ['@Note:',        '20%','data','',['left'  ],'@Huske-tip for denne ordrelinie.','.?.']
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
          ['@Slet',          '8%','text','',['center'],'@Klik på rødt kryds for at slette denne kolonne','<ic class="far fa-times-circle" style="color:red; font-size:13px; "></ic>']
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON, ]
    //$DATA,#=   array(),
    $ordrlin= sql_readB('SELECT id, form, frm_art, side, besk, just, FORMAT(x0,0), FORMAT(y0,0), FORMAT(dy,0), FORMAT(dx,0), FORMAT(dim,0), colr, font, style, style, imglnk, lngkey, note '.
                        'FROM tblA_forms '.
                        'WHERE form= "'.$frm.'" AND frm_art= "3" ',__FILE__, __LINE__) ,
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter   //  Virker ikke med hidd-felter!
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '300px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_PanlBund($pmpt='@Gem',$subm=true);
} //  Panl_FormRedigerOrdrelin


######### :SYSTEM:
# Kaldes fra:  [_system/page_Momssetup.php] [_system/page_Syssetup-udgaar.php] 
function Panl_MomsSetup(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'moms',$capt= '@Moms indstillinger:',$parms='page_Blindgyden.php',$icon='fas fa-wrench','panelW720',__FUNCTION__);
if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,__FUNCTION__ .':1');
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['<b>'.tolk('@Indland').'</b>', '8%','show','left', '', '@moms angående Indland','SALG'],['@Salgsmoms (udgående): ', '32%','show','left', '', '','@Den moms du skal betale til SKAT']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
//         ['@Salgsmoms (udgående moms): ',    '24%','text','',['right'],'@Salg: ','@Den moms du skal betale til SKAT','.?.'],
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Nr.',          '4%','data','',['center'], '@Positions nummer i gruppen','.Nr.'],
          ['@Beskrivelse', '20%','data','',['left'  ], '@Kontobeskrivelse. En beskrivende tekst efter eget valg','Tekst... (Opret ny konto)'],
          ['@Konto',        '6%','data','',['center'], '@Det nummer i kontoplanen, som salgsmomsen skal konteres på.','Konto...'],
          ['@%-Sats',       '6%','data','',['center'], '@Moms %-sats','25%...'],
          ['@Note',        '30%','text','',['center'], '@(planlagt)','.?.'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
//    &$DATA=   array(
//       ),
    $data= array( [['1'],['@Salgsmoms'],['66100'],['25,00'],['']], [['2'],[''],[''],[''],['']] ),
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '130px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );

  if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,__FUNCTION__ .':2');
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['<b>'.tolk('@Indland').'</b>', '8%','show','left', '', '@moms angående Indland','@KØB'],
          ['@Købsmoms (indgående): ', '34%','show','left', '', '','@Den moms du skal have retur fra SKAT']
      ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
//         ['@Købsmoms (indgående moms): ',    '24%','text','',['right'],'@Køb: ','@Den moms du skal have retur fra SKAT','.?.'],
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Nr.',          '4%','text','',['center'],'@Positions nummer i gruppen','.Nr.'],
          ['@Beskrivelse', '20%','data','',['left'  ],'@Kontobeskrivelse. En beskrivende tekst efter eget valg','Tekst... (Opret ny konto)'],
          ['@Konto',        '6%','data','',['center'],'@Det nummer i kontoplanen, som købsmomsen skal konteres på.','Konto...'],
          ['@%-Sats',       '6%','data','',['center'],'@Moms %-sats','25%...'],
          ['@Note',        '30%','text','',['center'],'@(Planlagt)','.?.'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
//    $DATA=   array(
//       ),
    $data= array( [['1'],['@Købsmoms'],['66200'],['25,00'],['']], [['2'],[''],[''],[''],[''] ] ),
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '130px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
   htm_hr();

if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,__FUNCTION__ .':3');
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['<b>'.tolk('@Udland').'</b>', '12%','show','left', '', '@moms angående udland','@KØB-ydelser'],['@Moms af ydelseskøb i udlandet: ', '24%','show','left', '', 
            '@Ved ydelseskøb i udlandet, skal der betales dansk moms på vegne af sælgeren. Samtidig kan købsmomsen trækkes fra så resultatet bliver 0','@Moms på vegne af sælgen.']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Nr.',          '4%', 'data','',['center'],'@Positions nummer i gruppen','.Nr.'],
          ['@Beskrivelse', '20%', 'data','',['left'  ],'@Kontobeskrivelse. En beskrivende tekst efter eget valg','Tekst... (Opret ny konto)'],
          ['@Konto',        '6%', 'data','',['center'],'@Konto til postering af salgsmoms for ydelseskøb i udlandet','Konto...'],
          ['@%-Sats',       '6%', 'data','',['center'],'@Moms %-sats','25%...'],
          ['@Modkonto',     '6%', 'data','',['center'],'@Konto til postering af købsmoms for ydelseskøb i udlandet','Konto...'],
          ['@Note',        '22%', 'text','',['center'],'@(planlagt)','.?.'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
//    $DATA=   array(
//       ),
    $data= array( [['1'],['@Moms af ydelseskøb i udlandet'],['66155'],['25,00'],['66200']], [['2'],[''],[''],[''],[''] ] ),
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '130px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );

  if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,__FUNCTION__.':4');
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['<b>'.tolk('@Udland').'</b>', '12%','show','left', '', '@moms angående udland','@KØB-varer']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
//         ['@Moms af varekøb i udlandet: ',    '24%','text','',['right'],'@Vare: ',
//             '@Ved varekøb i udlandet, skal der betales dansk moms på vegne af sælgeren. Samtidig kan købsmomsen trækkes fra så resultatet bliver 0','.?.'],
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Nr.',          '4%','data','',['center'], '@Positions nummer i gruppen','.Nr.'],
          ['@Beskrivelse', '20%','data','',['left'  ], '@Kontobeskrivelse. En beskrivende tekst efter eget valg','Tekst... (Opret ny konto)'],
          ['@Konto',        '6%','data','',['center'], '@Konto til postering af salgsmoms for køb i udlandet','Konto...'],
          ['@%-Sats',       '6%','data','',['center'], '@Moms %-sats','25%...'],
          ['@Modkonto',     '6%','data','',['center'], '@Konto til postering af købsmoms for køb i udlandet','Konto...'],
          ['@Note',        '22%','text','',['center'], '@(planlagt)','.?.'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $data= array( [['1'],['@Moms af varekøb m.v. i udlandet'],['66150'],['25,00'],['66200']], [['2'],[''],[''],[''],[''] ] ),
//    $DATA=   array(
//       ),
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '130px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_hr();
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Rapporter', '8%','show','left', '', '@konti som skal indgå i momsrapport','@KONTI']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
//         ['@Momsrapport (konti som skal indgå i momsrapport): ',    '26%','text','',['right'],'@Rap: ','@Her angives intervaller af konti, som skal danne grundlag for momsrapporter.','.?.'],
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Nr.',          '4%', 'data','',['center'], '@Positions nummer i gruppen','.Nr.'],
          ['@Beskrivelse', '20%', 'data','',['left'  ], '@Kontobeskrivelse. En beskrivende tekst efter eget valg','Tekst... (Opret ny)'],
          ['@Fra',          '6%', 'data','',['center'], '@Første kontonummer som skal indgå i rapporten','Konto...'],
          ['@Til',          '6%', 'data','',['center'], '@Sidste kontonummer som skal indgå i rapporten','Konto...'],
          ['@Rubrik A1',    '6%', 'data','',['center'], '@Kontonummer for samlet varekøb i EU','Konto...'],
          ['@Rubrik A2',    '6%', 'data','',['center'], '@Kontonummer for samlet ydelseskøb i EU','Konto...'],
          ['@Rubrik B1',    '6%', 'data','',['center'], '@Kontonummer for samlet varesalg i EU','Konto...'],
          ['@Rubrik B2',    '6%', 'data','',['center'], '@Kontonummer for samlet ydelsessalg i EU','Konto...'],
          ['@Rubrik C',     '6%', 'data','',['center'], '@Kontonummer for samlet vare- og ydelsessalg uden for EU','Konto...'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        // ['',        '1%','text','',['center'],'','',''],
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
//    $DATA=   array(
//       ),
    $data= array([['1'],['@Momsrapport'],['66100'],['66200'],['2800'],['2700'],['1220'],['1200'],['1290']],
                    [['2'],[''],[''],[''],[''],[''],[''],[''],['']]
          ), 
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '150px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_PanlBund($pmpt='@Gem',$subm=true);
}


######### :SYSTEM:
# Kaldes fra:  [_system/page_Stamkort.php] 
function Panl_Stamdata(  ## out_PanlsSekd.php
  &$firmanavn, &$addr1, &$addr2, &$postnr, &$bynavn, &$ny_email, &$homepage, &$bank_navn, &$bank_reg, &$bank_konto, &$cvrnr, &$tlf, &$fax, &$pbs_nr, &$pbs, &$gruppe, &$fi_nr
) { 
  htm_Panl_Top($name='stamkort',$capt='@Stamdata:',$parms='page_Blindgyden.php',$icon='fas fa-user',$klasse='panelW320',__FUNCTION__);
                        htm_CombFelt($type='text',  $name='firmanavn',  $valu= $firmanavn,  $labl='@Firmanavn',   $titl='@Navnet på det firma, regnskabet angår');
  htm_FrstFelt('50%');  htm_CombFelt($type='text',  $name='addr1',      $valu= $addr1,      $labl='@Adresse',     $titl='@Firmaets adresse');
  htm_NextFelt('50%');  htm_CombFelt($type='text',  $name='addr2',      $valu= $addr2,      $labl='@Sted',        $titl='@Supplerende stedsangivelse');
  htm_LastFelt();                                                                           
  htm_FrstFelt('25%');  htm_CombFelt($type='text',  $name='postnr',     $valu= $postnr,     $labl='@Postnr.',     $titl='@Postnr');
  htm_NextFelt('75%');  htm_CombFelt($type='text',  $name='bynavn',     $valu= $bynavn,     $labl='@Bynavn',      $titl='@Bynavn. firmaets hjemsted');
  htm_LastFelt();                                                                           
  htm_FrstFelt('50%');  htm_CombFelt($type='mail',  $name='ny_email',   $valu= $ny_email,   $labl='@Mail',        $titl='@Firmaets Mail-adresse');
  htm_NextFelt('50%');  htm_CombFelt($type='text',  $name='homepage',   $valu= $homepage,   $labl='@Hjemmeside',  $titl='@Firmaets hjemmeside-adresse');
  htm_LastFelt();                                                                           
                        htm_CombFelt($type='text',  $name='bank_navn',  $valu= $bank_navn,  $labl='@Bank',        $titl='@Bank forbindelse');
  htm_FrstFelt('25%');  htm_CombFelt($type='text',  $name='bank_reg',   $valu= $bank_reg,   $labl='@Bank reg.',   $titl='@Bank reg.');
  htm_NextFelt('75%');  htm_CombFelt($type='text',  $name='bank_konto', $valu= $bank_konto, $labl='@Bank konto',  $titl='@Bank konto');
  htm_LastFelt();
                        htm_CombFelt($type='text',  $name='cvrnr',      $valu= $cvrnr,      $labl='@CVR',         $titl=tolk('@CVR - Virksomheds ID.').'<br>'.
                        tolk('@Kan benyttes i CVR-opslag, til at importere Erhvervsstyrelsens offentlige data'), $revi=true);
  htm_FrstFelt('50%');  htm_CombFelt($type='text',  $name='tlf',        $valu= $tlf,        $labl='@Telefon.',    
                          $titl='@Telefonnr - Kan benyttes i CVR-opslag, til at importere Erhvervsstyrelsens offentlige data');
  htm_NextFelt('50%');  htm_CombFelt($type='text',  $name='fax',        $valu= $fax,        $labl='@Fax',         $titl='@Firmaets fax');
  htm_LastFelt(); 
  if (!$pbs_nr) {
    htm_FrstFelt('40%');  htm_CombFelt($type='text',$name='pbs_nr',     $valu= $pbs_nr,     $labl='@PBS Kreditornr.', $titl='@Firmaets pbsnr');
    htm_NextFelt('40%');  {if      ($pbs=='B') $listen= array(['','B','@Basis løsning'], ['','', '@Total løsning'], ['','L','@Lev. Service']);
                           elseif  ($pbs=='L') $listen= array(['','L','@Lev. Service'],  ['','B','@Basis løsning'], ['','', '@Total løsning']);
                           else                $listen= array(['','', '@Total løsning'], ['','B','@Basis løsning'], ['','L','@Lev. Service']);
                           htm_OptioFlt($type='text',$name='pbs',       $valu= $pbs,        $labl='@Aftale',
                                        $titl='@Vælg den aftalte løsning',  $revi=true, $optlist= $listen, $action='',$events='',$maxwd='300px',$onForm='stamkort');
                          }
    htm_LastFelt();
  } else                htm_CombFelt($type='text',  $name='pbs_nr', $valu= $pbs_nr, $labl='@PBS Kreditornr.',   $titl='@Firmaets pbsnr');
                        htm_CombFelt($type='text',  $name='gruppe', $valu= $gruppe, $labl='@PBS debitorgruppe', $titl='@Gruppe ');
                        htm_CombFelt($type='text',  $name='fi_nr',  $valu= $fi_nr,  $labl='@FI Kreditornr.',    
                          $titl='@Bankernes fælles indbetalingskort (FI-kort). Her angiver du dit FI Kreditornr.',    $revi=true);
  htm_FrstFelt('60%');  htm_CombFelt( $type='text',  $name='datansv', $valu= $gruppe, $labl='@Dataansvarlig - email', $titl='@Den dataansvarliges email');
  htm_NextFelt('40%');  echo textKnap($label='@Databehandler aftale', $title= tolk('@Se kontrakt med databehandler.'), $link='','','','tooltipNW');
  htm_LastFelt();
  htm_PanlBund($pmpt='@Gem',$subm=true);  
}

######### :SYSTEM:
# Kaldes fra:  [_system/page_Stamkort.php] 
function Panl_Medarbejdere() {  ## out_PanlsSekd.php
  htm_Tapet_Top($name= 'persform',$capt= '@Medarbejdere: ',$parms='#',$icon='far fa-file-alt','panelW480',__FUNCTION__);
  htm_nl();
  Panl_Ansat($Medarbejdernr, $bankkto, $Navn='Anders',    $Initialer, $Adresse, $Adresse2, $Postnr, $By, $Mail, $Mobil, $Lokalnr, $Lokalfax, $Privattlf, $Bank, $Løn, $Løntillæg, $Bemærkning, $Tiltrådt, $Fratrådt);
  Panl_Ansat($Medarbejdernr, $bankkto, $Navn='Rip',       $Initialer, $Adresse, $Adresse2, $Postnr, $By, $Mail, $Mobil, $Lokalnr, $Lokalfax, $Privattlf, $Bank, $Løn, $Løntillæg, $Bemærkning, $Tiltrådt, $Fratrådt);
  Panl_Ansat($Medarbejdernr, $bankkto, $Navn='Rap',       $Initialer, $Adresse, $Adresse2, $Postnr, $By, $Mail, $Mobil, $Lokalnr, $Lokalfax, $Privattlf, $Bank, $Løn, $Løntillæg, $Bemærkning, $Tiltrådt, $Fratrådt);
  Panl_Ansat($Medarbejdernr, $bankkto, $Navn='Rup',       $Initialer, $Adresse, $Adresse2, $Postnr, $By, $Mail, $Mobil, $Lokalnr, $Lokalfax, $Privattlf, $Bank, $Løn, $Løntillæg, $Bemærkning, $Tiltrådt, $Fratrådt);
  Panl_Ansat($Medarbejdernr, $bankkto, $Navn='Andersine', $Initialer, $Adresse, $Adresse2, $Postnr, $By, $Mail, $Mobil, $Lokalnr, $Lokalfax, $Privattlf, $Bank, $Løn, $Løntillæg, $Bemærkning, $Tiltrådt, $Fratrådt);
  htm_CentrOn();
  echo textKnap($label='@Vis Fratrådte medarbejdere', $title= tolk('@Se tidligere ansatte medarbejdere.'), $link='','','','tooltipNW');
  htm_CentOff();
  htm_TapetBund($pmpt='@Retur til ?',$subm=false,$title='@Retur til ?');
} 

######### :SYSTEM:
# Kaldes fra: [_system/page_Stamkort.php]
function Panl_Ansat(&$Medarbejdernr, &$bankkto, &$Navn, &$Initialer, &$Adresse, &$Adresse2,   ## out_PanlsSekd.php
                    &$Postnr, &$By, &$Mail, &$Mobil, &$Lokalnr, &$Lokalfax, &$Privattlf, &$Bank, 
                    &$Løn, &$Løntillæg, &$Bemærkning, &$Tiltrådt, &$Fratrådt
) { 
  htm_Panl_Top($name='stamkort',$capt='@Ansat:'.' '.$Navn,$parms='page_Blindgyden.php',$icon='fas fa-user',$klasse='panelW320',__FUNCTION__);
  htm_FrstFelt('50%');    htm_CombFelt($type='text',  $name='Medarbejdernr',$valu= $Medarbejdernr,  $labl='@Medarbejdernr', $titl='@Medarbejder nummer', $revi=true);  
  htm_NextFelt('50%');    htm_CombFelt($type='text',  $name='Cpr-nr',       $valu= $bankkto,    $labl='@Cpr-nr',    $titl='@Cpr-nr',      $revi=true);  
  htm_lastFelt();                                                                               
  htm_FrstFelt('75%');    htm_CombFelt($type='text',  $name='Navn',         $valu= $Navn,       $labl='@Navn',      $titl='@Medarbejderens fulde navn.',       $revi=true);  
  htm_NextFelt('25%');    htm_CombFelt($type='text',  $name='Initialer',    $valu= $Initialer,  $labl='@Initialer', $titl='@Initialer',   $revi=true);  
  htm_lastFelt();                                                                               
  htm_FrstFelt('50%');    htm_CombFelt($type='text',  $name='Adresse',      $valu= $Adresse,    $labl='@Adresse.',  $titl='@Gade/vej og husnummer',    $revi=true);  
  htm_NextFelt('50%');    htm_CombFelt($type='text',  $name='Adresse2',     $valu= $Adresse2,   $labl='@Sted',      $titl='@Supplerende steds angivelse',    $revi=true);  
  htm_lastFelt();                                                                               
  htm_FrstFelt('25%');    htm_CombFelt($type='text',  $name='Postnr',       $valu= $Postnr,     $labl='@Postnr.',   $titl='@Postnr.',     $revi=true);  
  htm_NextFelt('75%');    htm_CombFelt($type='text',  $name='By',           $valu= $By,         $labl='@By',        $titl='@By',          $revi=true);  
  htm_lastFelt();   
  htm_FrstFelt('50%');    htm_CombFelt($type='mail',  $name='e-mail',       $valu= $Mail,       $labl='@Mail',      $titl='@Medarbejderens mail', $revi=true);  
  htm_NextFelt('50%');    htm_CombFelt($type='text',  $name='Mobil',        $valu= $Mobil,      $labl='@Mobil',     $titl='@Mobil',       $revi=true);  
  htm_lastFelt();                                                                                
  htm_FrstFelt('50%');    htm_CombFelt($type='text',  $name='Lokalnr.',     $valu= $Lokalnr,    $labl='@Lokalnr.',  $titl='Lokal telefon nr.',     $revi=true);
  htm_NextFelt('50%');    htm_CombFelt($type='text',  $name='Lokal fax',    $valu= $Lokalfax,   $labl='@Lokal fax', $titl='@Lokal fax',   $revi=true);
  htm_lastFelt();                                                                                
  htm_FrstFelt('50%');    htm_CombFelt($type='text',  $name='Privat tlf',   $valu= $Privattlf,  $labl='@Privat tlf',$titl='@Privat tlf',  $revi=true);
  htm_NextFelt('50%');    htm_CombFelt($type='text',  $name='Bank',         $valu= $Bank,       $labl='@Bank.',     $titl='@Bank',        $revi=true);
  htm_lastFelt();                                                                                
  htm_FrstFelt('50%');    htm_CombFelt($type='text',  $name='Løn',          $valu= $Løn,        $labl='@Løn',       $titl='@Løn',         $revi=true);
  htm_NextFelt('50%');    htm_CombFelt($type='text',  $name='Løntillæg',    $valu= $Løntillæg,  $labl='@Løntillæg', $titl='@Løntillæg',   $revi=true);
  htm_lastFelt();                                                                                
                          htm_CombFelt($type='area',  $name='Bemærkning',   $valu= $Bemærkning, $labl='@Bemærkning',$titl='@Bemærkning',    $revi=true);
  htm_FrstFelt('50%');    htm_CombFelt($type='date',  $name='Tiltrådt',     $valu= $Tiltrådt,   $labl='@Tiltrådt',  $titl='@Tiltrædelses dato', $revi=true);
  htm_NextFelt('50%');    htm_CombFelt($type='date',  $name='Fratrådt',     $valu= $Fratrådt,   $labl='@Fratrådt',  $titl='@Fratrædelses dato', $revi=true);
  htm_lastFelt();
  htm_PanlBund($pmpt='@Gem',$subm=true);
}


######### :SYSTEM:
# Kaldes fra:  [_system/page_Brugere.php] 
function Panl_Brugere(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) { global $ØtblRowDrk, $ØtblRowLgt;  ## out_PanlsSekd.php
  function TblRow($span1,$Txt1,$repe,$span2,$Txt2){ global $ØtblRowDrk, $ØtblRowLgt;
    echo '<tr><td colspan= '.$span1.' align=right> <u>'.tolk($Txt1).'</u> &nbsp;</td>';
    Veksle($from=$span1, $to=$repe+$span1-1, $krit='11111111111111111111', $doOdd='', $doEven='">|'); //  echo str_repeat('<td style="text-align:center; background:'.$ØtblRowDrk.';">|</td>',$repe);
    echo '<td colspan='.$span2.'> &nbsp;&nbsp;<u>'. tolk($Txt2).'</u></td></tr>'; 
  }

  function UserRett($ix,$row,$name){
    if (substr($row['rettigheder'], $ix,1)==0) {echo '<td><input class="inputbox" type=checkbox name='.$name.' title='.$name.'></td>';}     
    else                                     {echo '<td><input class="inputbox" type=checkbox name='.$name.' title='.$name.' checked></td>';}
  }
  function Veksle($from, $to, $krit, $doOdd, $doEven) { global $ØtblRowDrk, $ØtblRowLgt;
    for ($y=$from; $y<=$to; $y++) {
      if ($y % 2 == 0) $colbg= $ØtblRowDrk; else $colbg= $ØtblRowLgt;
      if (substr($krit,$y,1)==0)  echo '<td style="background:'.$colbg.'"></td>';
      else                        echo '<td style="background:'.$colbg.'; text-align:center; '.$doEven.'</td>';
  } }
  $bgcolor5= $ØtblRowDrk;
  $bgcolor=  $ØtblRowLgt;
  $colbg= $ØtblRowDrk;
  htm_Panl_Top($name='brugkort',$capt='@Bruger rettigheder:',$parms='page_Blindgyden.php',$icon='fas fa-user',$klasse='panelW720',__FUNCTION__);
  echo '<br><table cellpadding="0" cellspacing="0" border="0" width="70%"><tbody style="font-size: 15px;">';
  echo '<tr><td colspan="2"></td>'.
    str_repeat('<td style="text-align:center; width:1%; color:'.$bgcolor.';"> </td>', 25).
    '</tr>';
    
  TblRow(14,'@Sikkerhedskopi',  0,13,'@Debitorrapport');
  TblRow(13,'@Varemodtagelse',  2,12,'@Kreditorrapport');
  TblRow(12,'@Varelager',       4,11,'@Produktionsordrer');
  TblRow(11,'@Kreditorkonti',   6,10,'@Varerapport');
  TblRow(10,'@Kreditorordrer',  8, 9,'');
  TblRow( 9,'@Debitorkonti',    9, 9,'');
  TblRow( 8,'@Debitorordrer',  10, 9,'');
  TblRow( 7,'@Finansrapport',  11, 9,'');
  TblRow( 6,'@Regnskab',       12, 9,'');
  TblRow( 5,'@Kassekladde',    13, 9,'');
  TblRow( 4,'@Indstillinger',  14, 9,'');
  TblRow( 3,'@Kontoplan',      15, 9,'');
  TblRow( 2,'',                16, 9,'');
  
  echo '<tr><td style="width:15%"><data-colrlabl> '.
      tolk('@Navn / init.').':&nbsp;</data-colrlabl></td><td style="width:15%"><data-colrlabl> '.
      tolk('@Bruger').':</data-colrlabl></td>';
      veksle($from=0, $to=15, $krit='1111111111111111111', $doOdd='', $doEven=' color:gray; width:2%;">▼');
  echo '<td style="width:15%"> </td></tr>';
  
  $users=[['adm','Administrator','1234567891123456'],['bog','Bogholder','1234567890023456'],['rev','Revisor','1234567891123456']];
  foreach ($users as $usr) {
#  for ($user=0; $user<=2; $user++) {  $r2[initialer]= 'adm';    $row[brugernavn]= 'administrator';    $row[rettigheder]= '1234567890023456';    $colbg= '#d0d0d0';
#   if (true) echo '<tr><td> '.$r2[initialer].'&nbsp;</td><td><axx href=brugere.php?ret_id='.$row[id].'> '.$row[brugernavn].'</axx></td>';
    if (true) echo '<tr><td align=center > '.$usr[0].'&nbsp;</td><td><axx href=brugere.php?ret_id='.$row['id'].'> '.$usr[1].'</axx></td>';
    else      echo '<td align=center bgcolor="'.$colbg.'">*</td>';  
    Veksle($from=0, $to=15, $krit=$usr[2], $doOdd='', $doEven='color:green; font-weight:900;">√');
    echo '</tr>';
  }
  
  echo '<tr><td style="text-align:right"><data-colrlabl>'.tolk('@Opret ny bruger').':&nbsp;</data-colrlabl></td>';
  echo '<input type=hidden name=id value="'.$row['id'].'">';
  echo '<input type=hidden name=random value='.'navn'.rand(100,999).'>';   #For at undgaa at browseren "husker" et forkert brugernavn.
  $row['brugernavn']= 'Maria';    
  echo '<td><input class="inputbox" type="text" size=12 name='.$tmp.' value="'.$row['brugernavn'].'"></td>';
  UserRett( 0,$row,'kontoplan');       
  UserRett( 1,$row,'indstillinger');   
  UserRett( 2,$row,'kassekladde');     
  UserRett( 3,$row,'regnskab');        
  UserRett( 4,$row,'finansrapport');   
  UserRett( 5,$row,'debitorordre');    
  UserRett( 6,$row,'debitorkonti');    
  UserRett( 7,$row,'kreditorordre');   
  UserRett( 8,$row,'kreditorkonti');   
  UserRett( 9,$row,'varer');           
  UserRett(10,$row,'enheder');         
  UserRett(11,$row,'backup');          
  UserRett(12,$row,'debitorrapport');  
  UserRett(13,$row,'kreditorrapport'); 
  UserRett(14,$row,'produktionsordre');
  UserRett(15,$row,'varerapport');     
  echo '</tr>';
  echo '<tr><td style="text-align:right"><data-colrlabl>'.tolk('@Adgangskode').':&nbsp;</data-colrlabl></td><td><input class="inputbox" type=password size=12 name=kode value="********************"></td></tr>';
  echo '<tr><td style="text-align:right"><data-colrlabl>'.tolk('@Gentag kode').':&nbsp;</data-colrlabl></td><td><input class="inputbox" type=password size=12 name=kode2 value="********************"></td></tr>';
  echo '</tbody></table>';
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :SYSTEM:
# Kaldes fra:  [_system/page_Valuta.php] 
function Panl_Valuta(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'valuform',$capt= '@Valutaer: ',$parms='page_Blindgyden.php',$icon='fas fa-euro-sign','panelW320',__FUNCTION__);
  htm_Caption('@Oprettede valutaer:');
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Valuta.',    '15%', 'indx','',['left'],   '@Valuta benævnelse','@Valu...'],
          ['@Beskrivelse','58%', 'text','',['left'],   '@Valuta beskrivelse','@Besk...'],
          ['@Kurs',       '15%', 'text','',['center'], '@Aktuel kurs...','@Kurs...']
        ),  //  Problem: Tabellens width er større end forventet!
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
//    $DATA=   array(
//       ),
    $TablData= [['DKK','Danske kroner','100'],['EUR','Europæiske Euro','100'],['USD','Amerikanske Dollar','100']],  # ImportTabFile('../_exchange/varer.tab'),  // Indlæs data fra TAB-fil
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '200px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  $optlist= ValutaArr(); //[['Danske kroner','DKK','DKK - Danmark - Kroner'],['Europæisk Euro','EUR','EUR - EU fællesskabet - Euro'], ['US dollar','USD','USD - Amerikansk - Dollar'],['Pund Sterling','GBP','GBP - Det Forenede Kongerige - Pund']];
  htm_nl();
  htm_Caption('@Oversigt over populære valutaer:');
  htm_nl(2);
  htm_OptioFlt($type='text',  $name='vkode',      $valu= '',      
                    $labl='@Valutaer',   
                    $titl='@Her kan du slå op, og se aktuelle valuta-koder', 
                    $revi=true, $optlist, $action='',$events='',$maxwd='150px');
  $filDATA= ImportTabFile('../_exchange/ISO-valutaer.tab',1,'UTF-x');    $optlist= [];  //  Vises kun på dansk!
  foreach ($filDATA as $rec) {array_push($optlist, [ $rec[2].' / '.$rec[3], $rec[0], $rec[0].' : '.$rec[1] ]);}
  htm_Caption('@Oversigt over alle valutaer:');
  htm_nl(2);
  htm_OptioFlt($type='text',  $name='vkode',      $valu= '',      
                    $labl='@Valutaer',   
                    $titl='@Her kan du slå op, og se mulige valuta-koder', 
                    $revi=true, $optlist, $action='',$events='',$maxwd='150px');
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :SYSTEM:
# Kaldes fra:  [_system/page_Valuta.php] 
function Panl_Valutakort(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'kortform',$capt= '@Valuta ændringer: ',$parms='page_Blindgyden.php',$icon='fas fa-euro-sign','panelW320',__FUNCTION__);
  $valuta= 'DKK';   $beskriv= 'Danske kroner';
  htm_Caption('@Vedligeholdese af:');  echo ' '.$valuta.' - '.$beskriv;
  htm_nl(2);
  htm_Plaintxt('@Der er ikke automatisk vedligeholdelse af kurser i SALDI. Du skal tilpasse dags-kursen manuelt efter behov. F.eks. inden du fakturerer eller bogfører.');
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
                ['@Valør dato', '8%', 'date','',  ['center'], '@Den dato kursen er gældende fra','@dato [YYYY-MM-DD]'],
                ['@Ny kurs',    '8%', 'text','',  ['center'], '@Angives i %. dvs. værdien i DKK af 100 '.$valuta,'@kurs...'],
                ['@Konto',      '8%', 'text','',  ['center'], '@Kontonummer fra kontoplanen som skal bruges til valutakursdifferencer og øreafrunding...','@konto...'],
        ),  //  Problem: Tabellens width er større end forventet!
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
//    $DATA=   array(
//       ),
    $TablData= [['Dato','Kurs','konto'],['Dato','Kurs','konto'],['Dato','Kurs','konto'],['Dato','Kurs','konto'],['Dato','Kurs','konto'],['Dato','Kurs','konto'],
              ['Dato','Kurs','konto'],['Dato','Kurs','konto'],['Dato','Kurs','konto'],['Dato','Kurs','konto']],  # ImportTabFile('../_exchange/varer.tab'),  // Indlæs data fra TAB-fil
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=false,       # Mulighed for at ændre data i en row
    $ViewHeight= '400px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :SYSTEM:
# Kaldes fra:  [_system/page_Enheder.php] 
function Panl_Enheder(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'enhedform',$capt= '@Enheder og materialer: ',$parms='page_Blindgyden.php',$icon='fas fa-database','panelW320',__FUNCTION__);
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          [' ', '42%','show','','left', '', '@Enhedsbetegnelser']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Enhed',      '20%', 'text','',['left'], tolk('@Enhedsbetegnelse').' ','Enh...'],
          ['@Beskrivelse','80%', 'text','',['left'], '@Beskrivelse af enheden','Beskr...'],
        ),  //  Problem: Tabellens width er større end forventet!
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
//    $DATA=   array(
//       ),
    $data= array(['',''],['',''],['',''],['',''],),  # Antal rows ved DEMO
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '120px',   # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );

  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          [' ', '42%','show','','left', '', '@Materiale egenskaber']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Materiale.', '70%', 'text','',['left'], '@Materiale','Matr...'],
          ['@Densitet',   '30%', 'text','',['left'], '@Materialets massefylde','Dens...'],
        ),  //  Problem: Tabellens width er større end forventet!
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        []
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
//    $DATA=   array(
//       ),
    $data= array(['',''],['',''],['',''],['',''],),  # Antal rows ved DEMO
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '120px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
### PanelFooter:
#+  NaviTip();
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :SYSTEM:
# Kaldes fra:  [_system/page_Rabatgrupper.php] 
function Panl_Rabatgrupper($vg_antal=4, $vrg_antal=true, $dg_antal=3, $drg_antal=true  ## out_PanlsSekd.php
  /* DEMO  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {
  htm_Panl_Top($name= 'rabbform',$capt= '@Rabatgrupper:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-database','panelW640',__FUNCTION__);
  htm_CentrOn(); 
    textKnap($label='@Definer selv debitor-rabatgrupper',  $title='@Klik her for at håndtere dine debitor rabatgrupper',$link='../_base/page_Blindgyden.php').'<hr>';
    textKnap($label='@Definer selv vare-rabatgrupper',     $title='@Klik her for at håndtere dine vare rabatgrupper',$link='../_base/page_Blindgyden.php').'<hr>';
  htm_CentOff();
### OVERSKRIFTER:
  echo '<data-colrlabl>'; 
  htm_FrstFelt('40%');    echo 'Debitorgrp \ Varegrp';
  htm_NextFelt('20%');    echo 'Type';
  for ($y=1; $y<=$vg_antal; $y++) { //  Dette bør ændres så rutinen modtager data i arrays!
    if ($vrg_antal) { htm_NextFelt('12%');  echo '<a   title="'.$vgnavn[0][$y].'Klik for at rette navn" href="../_base/page_Blindgyden.php">VG'.$y.'</a>';}  # print "<td title=\"".$vgnavn[0][$y]." | Klik for at rette navn\"><a href=\"rabatgrupper.php?ret_vrgnavn=$y\">&nbsp;VG$y</a></td>";
    else            { htm_NextFelt('12%');  echo '<div title="'.$vgnavn[0][$y].'">VG'.$y.'</div>';}                           # print "<td title=\"".$vgnavn[0][$y]."\">&nbsp;VG$y</td>";
  }
 if ($vrg_antal) {htm_NextFelt('2%');  textKnap($label='@Ny',  $title='@Klik her for at oprette ny vare-rabatgruppe',$link='../_base/page_Blindgyden.php');} # print "<td title=\"Opret ny vare-rabatgruppe\"><a href=\"rabatgrupper.php?vgselfdef=$y\">Ny</a></td>";

  htm_LastFelt();    
  echo '</data-colrlabl>';
### DATA: //  Dette bør ændres så rutinen modtager data i arrays!
  for ($x=1;$x<=$dg_antal;$x++){   # ($linjebg!=$bgcolor5)?$linjebg=$bgcolor5:$linjebg=$bgcolor; #   print '<tr bgcolor="$linjebg">';
  htm_FrstFelt('25%');    ////  Navn:
    if ($drg_antal) {
        htm_HiddVari($name='drg_nr['.$x.']',$val=$dg[$x][0]);     # print '<input type="hidden" name="drg_nr['.$x.']" value = "'.$dg[$x][0].'">';
        print '<input class="inputbox" type="text" name="drgnavn['.$x.']" style="width:180px" value = "'.$dgnavn[$x][0].'">';    #    print '<td colspan="2"><input class="inputbox" type="text" name="drgnavn['.$x.']" value = "'.$dgnavn[$x][0].'"></td>';
      } 
    else { print '<td align="right">'.$dg[$x][0].'</td>'; print '<td>&nbsp;'.$dgnavn[$x][0].'</td>'; }
    htm_HiddVari($name='rabatart['.$x.']',$val=$rabatart[$x]);     #print '<input type="hidden" name="rabatart['.$x.']" value="'.$rabatart[$x].'">';

    htm_NextFelt('15%');  ////  Type:
    if ($rabatart[$x]=="amount") $optlist= [['Mængde relateret rabat','amount','@kr/stk'],['Pris relateret rabat','pct','%']];
    else                         $optlist= [['Pris relateret rabat','pct','%'], ['Mængde relateret rabat','amount','@kr/stk']];
    htm_OptioFlt($type='text', $name='enhed0', $valu= $rabatart[$x], $labl='', $titl='@Vælg den rabat-metode, du ønsker at bruge.',  
                    $revi=true, $optlist, $action='');
    for ($y=1;$y<=$vg_antal;$y++) { //  Dette bør ændres så rutinen modtager data i arrays!
      if (!$dg[$x][0]) {
        if ($id[$x][$y]) $rabat[$x][$y]=str_replace(".",",",$rabat[$x][$y]);
        else $rabat[$x][$y]=NULL; 
        htm_NextFelt('12%');  ////  Data:
        htm_HiddVari($name='id['.$x.']',$val=$id[$x][$y]);                # print '<input type="hidden" name="id['.$x.']['.$y.']" value="'.$id[$x][$y].'">';
        htm_HiddVari($name='rabat['.$x.']['.$y.']',$val=$rabat[$x][$y]);  # print '<input type="hidden" name="rabat['.$x.']['.$y.']" value="'.$rabat[$x][$y].'">';
        htm_HiddVari($name='drg_antal',$val=$drg_antal);                  # print '<input type="hidden" name="drg_antal" value="'.$drg_antal.'">';
        htm_CombFelt($type='text',$name='ny_rabat['.$x.']['.$y.']',$valu='',$labl='@VG'.$y, $titl='@Feltnavn',$revi=true,$rows='2',$width='20px',$step='',$more='');
        # print '<td align="center"><input class="inputbox" type="text" style="text-align:right;width:35px" name="ny_rabat['.$x.']['.$y.']" value="'.$rabat[$x][$y].'"</td>';
      } ;#else print '<td colspan="vg_antal"><br></td>';
    }
#    print '<td>&nbsp;</td></tr>\n';
    htm_LastFelt(); 
  }
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :SYSTEM:
# Kaldes fra:  [_system/page_Varegrupper.php] 
function Panl_Varegrupper(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) { ## out_PanlsSekd.php
  htm_Panl_Top($name= 'systform',$capt= '@Gruppering af varer:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-database','panelW960',__FUNCTION__);
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Varegrupper-konti', '0%','text','','left', ':', ''],
          ['@Tabel &nbsp; ', '20%','text','','left', '@Varegrupper', '@Varegrupper']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Nr',                '3%','data','',['center'], '@Gruppe nummer'.' ','.?.'],
        ['@Beskrivelse',      '17%','data','',['left'  ], '@Beskrivelse af gruppen','@Besk...'],
        ['@Lager-tilgang',     '5%','data','',['center'], '@Konto for...','@Tilg...'],
        ['@Lager-træk',        '5%','data','',['center'], '@Konto for...','@Træk..'],
        ['@Vare-køb',          '5%','data','',['center'], '@Konto for...','@Køb..'],
        ['@Vare-salg',         '5%','data','',['center'], '@Konto for...','@Salg..'],
        ['@Lager-regulering',  '5%','data','',['center'], '@Konto for...','@Regu..'],
        ['@Køb fra EU',        '5%','data','',['center','rgba( 252, 252, 252, .4 )'], '@Konto for...','@Køb..'],
        ['@Salg til EU',       '5%','data','',['center','rgba( 252, 252, 252, .4 )'], '@Konto for...','@Salg..'],
        ['@Køb uden for EU',   '6%','data','',['center','rgba( 252, 252, 252, .4 )'], '@Konto for...','@Køb..'],
        ['@Salg uden for EU',  '6%','data','',['center','rgba( 252, 252, 252, .4 )'], '@Konto for...','@Salg..'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ['@Omvendt betaling', '5%', 'text','',['center'],  '@Omvendt betaligspligt! Afmærk her, hvis denne kundegruppe er omfattet af omvendt betalingspligt.',
                '<a hrefxxx='.$link.' ><input type= "checkbox" name="bold" value="" ></a>','.?.'],
        ['@Moms fri',         '5%', 'text','',['center'],  '@Moms fri. Afmærk her, hvis ....','<a hrefxxx="'.$link.'" ><input type= "checkbox" name="bold" value="" ></a>','.?.'],
        ['@Lager ført',       '5%', 'text','',['center'],  '@Lager ført. Afmærk her, hvis ...','<a hrefxxx="'.$link.'" ><input type= "checkbox" name="bold" value="" ></a>','.?.'],
        ['@Batch kontrol',    '5%', 'text','',['center'],  '@Batch kontrol. Afmærk her, hvis ..','<a hrefxxx="'.$link.'" ><input type= "checkbox" name="bold" value="" ></a>','.?.'],
        ['@Opera -tion',      '5%', 'text','',['center'],  '@Operation. Afmærk her, hvis ..','<a hrefxxx="'.$link.'" ><input type= "checkbox" name="italic" value="" ></a>','.?.'],
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
//    $DATA=   array(
//       ),
    $data= array(
        [['1'],['Ydelser'],[''],[''],['2900'],['1000'],[''],['2700'],['1200'],['2720'],['1250']],
        [['2'],['Handelsvarer'],['55100'],['55100'],['2100'],['1100'],['2600'],['2800'],['1220'],['2820'],['1270']],
        [['3'],['Forbrugsvarer'],[''],[''],['2100'],['1100'],[''],['2800'],['1220'],['2820'],['1270']],
        [['4'],['Fragt/porto'],[''],[''],['2300'],['1300'],[''],['2700'],['1200'],['2720'],['1250']],
      ),  #  DEMOdata
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '160px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );

  str_nl();
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Vare-Prisgrupper', '0%','text','','left', ':', ''],
          ['@Tabel &nbsp;', '20%','text','','left', '@Prisgrupper', '@Prisgrupper'],
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Nr',            '3%','data','',['center'], '@Gruppe nummer'.' ','.?.'],
        ['@Beskrivelse',  '15%','data','',['left'  ], '@Beskrivelse af gruppen','@Besk...'],
        ['@Kost-pris',     '6%','data','',['center'], '@Konto for...','@Kost...'],
        ['@Salgs-pris',    '6%','data','',['center'], '@Konto for...','@Salgs..'],
        ['@Vejl.-pris',    '6%','data','',['center'], '@Konto for...','@Vejl..'],
        ['@B2B-pris',      '6%','data','',['center'], '@Konto for...','@B2B..'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
          ['',         '30%', 'text','',['center'],  '','','.?.']
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
//    $DATA=   array(
//       ),
    $data= array(
                [[''],[''],[''],[''],[''],[''],[''],[''],[''],[''],['']],[[''],[''],[''],[''],[''],[''],[''],[''],[''],[''],['']]
        ),  #  DEMOdata
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '100px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );

  str_nl();
  
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Vare-Tilbudsgrupper', '0%','text','','left', ':', ''],
          ['@Tabel  &nbsp; ', '20%','text','','left', '@Tilbudsgrupper', '@Tilbudsgrupper']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Nr',            '3%','data','',['center'], '@Gruppe nummer'.' ', '.?.'],
          ['@Beskrivelse',  '15%','data','',['left'  ], '@Beskrivelse af gruppen', '@Besk...'],
          ['@Kost-pris',     '6%','data','',['center'], '@Konto for...', '@Kost...'],
          ['@Salgs-pris',    '6%','data','',['center'], '@Konto for...', '@Salgs..'],
          ['@Start-dato',    '6%','data','',['center'], '@Konto for...', '@Strt..'],
          ['@Slut-dato',     '6%','data','',['center'], '@Konto for...', '@Slut..'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
          ['',              '30%', 'text','',['center'],  '','','.?.']
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
//    $DATA=   array(
//       ),
     $data= array(
        [[''],[''],[''],[''],[''],[''],[''],[''],[''],[''],['']],[[''],[''],[''],[''],[''],[''],[''],[''],[''],[''],['']]
      ),  #  DEMOdata
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '100px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );

  str_nl();
  
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Vare-Rabatgrupper', '0%','text','','left', ':', ''],
          ['@Tabel  &nbsp; ', '20%','text','','left', '@Rabatgrupper', '@Rabatgrupper']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Nr',            '3%','data','',['center'], '@Gruppe nummer'.' ',     '.?.'],
          ['@Beskrivelse',  '15%','data','',['left'  ], '@Beskrivelse af gruppen','@Besk...'],
          ['@Type',          '6%','data','',['center'], '@Konto for...',          '@Typ...'],
          ['@Stk. rabat',    '6%','data','',['center'], '@Konto for...',          '@Rabt..'],
          ['@ved antal',     '6%','data','',['center'], '@Konto for...',          '@Antl..'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
          ['',             '30%', 'text','',['center'],  '','','.?.']
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
//    $DATA=   array(
//        ),
    $data= array(
      [[''],[''],[''],[''],[''],[''],[''],[''],[''],[''],['']],[[''],[''],[''],[''],[''],[''],[''],[''],[''],[''],['']]
    ),  #  DEMOdata
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '100px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='@Gem, hvis du har ændret noget ovenfor.');
}


######### :SYSTEM:
# Kaldes fra:  [_system/page_Debkredgrup.php] 
function Panl_DefKredGrp(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) { ## out_PanlsSekd.php
  htm_Panl_Top($name= 'grupform',$capt= '@Debitor- & Kreditor-grupper:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-database','panelW960',__FUNCTION__,$more='');
  textKnap($label='@INFO om grupper', $title='@Her er lidt forklaring omkring brugen af grupper.', $link= '../_base/page_GruppeInfo.php');
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Tabel &nbsp;','20%','text','','left', '@Debitorgrupper', '@Debitorgrupper']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!                             ], ['Næste record'],... # Generel struktur!
          ['D',            '3%','text', '',['center'], '@Medlem af debitorgruppe','D']
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Nr',          '3%','data', '',['center'], '@Gruppe nummer'.' ','...auto...'],
          ['@Beskrivelse','30%','data', '',['left'  ], '@Beskrivelse af gruppen','Besk...'],
          ['@Momsgrp',     '8%','data', '',['center'], '@Momsgruppe som debitorgruppen skal tilknyttes.','@Momsgr...'],
          ['@Samlekt.',    '8%','data', '',['center'], '@Samlekonto for debitorgruppen','S-kt..'],
          ['@Valuta',      '8%','data', '',['center'], '@Den valuta som gruppen føres i','Valu..'],
          ['@Sprog',       '8%','data', '',['center'], '@Det sprog der skal anvendes ved fakturering','Spr..'],
          ['@Modkonto',    '8%','data', '',['center'], '@Modkonto ved udligning af åbne poster','M-kt...'],
          ['@Provision',   '8%','data', '',['right' ], '@Provisionsprocent! Her angives hvor stor en procentdel af dækningsbidraget der medgår ved beregning af provision.','Pro...'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
          ['@OB',      '5%', 'text','',['center'], '@Omvendt betaligspligt! Afmærk her, hvis denne kundegruppe er omfattet af omvendt betalingspligt.','<a hrefxxx="'. 
                $link.'" ><input type= "checkbox" name="bold" value="" ></a>','.?.'],
          ['@B2B',     '5%', 'text','',['center'], '@Business to business! Afmærk her, hvis der skal anvendes b2b priser ved salg til denne kundegruppe.','<a hrefxxx="'.
                $link.'" ><input type= "checkbox" name="italic" value="" ></a>','.?.'],
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
//    $DATA=   array(
//       ),
     $data= array(
        [['1'],['Danske Debitorer'],['S1'],['56100'],['DKK'],['Dansk'],['58000'],['11.2 %']],
        [['2'],['Europæiske Debitorer'],['E1'],[''],['EUR'],['Engelsk'],[''],['']],
        [['3'],[''],[''],[''],[''],[''],[''],['']],
        ),  #  DEMOdata
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '160px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_nl();
  
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Tabel  &nbsp; ', '20%','text','','left', '@Kreditorgrupper', '@Kreditorgrupper']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
          ['K',            '3%','text','',['center'],'@Medlem af kreditorgruppe','K']
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Nr',          '3%','data','',['center'], '@Gruppe nummer'.' ','...auto...'],
          ['@Beskrivelse','30%','data','',['left'  ], '@Beskrivelse af gruppen','Besk...'],
          ['@Momsgrp',     '8%','data','',['center'], '@Momsgruppe som kreditorgruppen skal tilknyttes.','@Momsgr...'],
          ['@Samlekt.',    '8%','data','',['center'], '@Samlekonto for kreditorgruppen','S-kt..'],
          ['@Valuta',      '8%','data','',['center'], '@Den valuta som gruppen føres i','Valu..'],
          ['@Sprog',       '8%','data','',['center'], '@Det sprog der skal anvendes ved kommunikation med kreditoren','Spr..'],
          ['@Modkonto',    '8%','data','',['center'], '@Modkonto ved udligning af åbne poster','M-kt...'],
          ['@S.moms grp',  '8%','data','',['center'], '@Momsgruppe for salgsmoms ved omvendt betalingspligt.','M-grp...'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
          ['@OB',          '5%','text','',['center'], '@Omvendt betaligspligt! Afmærk her, hvis denne leverandørgruppe er omfattet af omvendt betalingspligt.','<a hrefxxx="'.
                $link.'" ><input type= "checkbox" name="bold" value="" ></a>','.?.'],
          ['',             '5%','text','2d',['right'], '@Business to business! Afmærk her, hvis der skal anvendes b2b priser ved salg til denne leverandørgruppe.'],
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
//    $DATA=   array(
//       ),
    $data= array(
          [['1'],['Danske Kreditorer'],['K1'],['65100'],['DKK'],['Dansk'],['58000'],['']],
          [['2'],[''],[''],[''],[''],[''],[''],['']],
        ),  #  DEMOdata
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '160px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_nl(1);
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

  
######### :SYSTEM:
# Kaldes fra: 
function Panl_Syssetup() { ## out_PanlsSekd.php
  htm_Panl_Top($name= 'systform',$capt= '@Varegrupper:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-database','panelW960',__FUNCTION__);
  $spantekst1= tolk('@En beskrivende tekst efter eget valg');
	$spantekst2= tolk('@Det nummer i kontoplanen som salgsmomsen skal konteres p&aring;.');
	$spantekst3= tolk('@Moms %.');
  htm_PanlBund($pmpt='@Gem',$subm=true);
}



######### :SYSTEM:
# Kaldes fra: 
function Panl_AdminMenu() {global $ØProgRoot, $ØLineBrun; ## out_PanlsSekd.php
//  Ny opdeling: Regnskabs-indstillinger og Program-indstillinger ?
  htm_Panl_Top($name='adminform',$capt='@Indstillinger 1, Ofte.',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-bars',$klasse='panelW240',__FUNCTION__);
  $goBack= '';  $knapW= 200;
  htm_CentrOn();
             menuKnap($h='22',$w=$knapW,$label='@Valuta',                 $link=$ØProgRoot.'_system/page_Valuta.php',       $title='@Indstillinger angående valuta');
  htm_nl();  menuKnap($h='22',$w=$knapW,$label='@Moms',                   $link=$ØProgRoot.'_system/page_Momssetup.php',    $title='@Indstillinger angående moms');
  htm_nl();  menuKnap($h='22',$w=$knapW,$label='@Debitor & Kreditor Grp.',$link=$ØProgRoot.'_system/page_Debkredgrup.php',  $title='@Indstillinger angående grupper');
  htm_nl();  menuKnap($h='22',$w=$knapW,$label='@Afdelinger',             $link=$ØProgRoot.'_system/page_Afdelinger.php',   $title='@Indstillinger angående Afdelinger');
  htm_nl();  menuKnap($h='22',$w=$knapW,$label='@Projekter',              $link=$ØProgRoot.'_system/page_Projekter.php',    $title='@Indstillinger angående Projekter');
  htm_nl();  htm_hr($ØLineBrun);  
             menuKnap($h='22',$w=$knapW,$label='@Lagre',                  $link=$ØProgRoot.'_system/page_Lagre.php',        $title='@Indstillinger angående Lagre');
  htm_nl();  menuKnap($h='22',$w=$knapW,$label='@Varegrupper',            $link=$ØProgRoot.'_system/page_Varegrupper.php',  $title='@Indstillinger angående Varegrupper');
  htm_nl();  menuKnap($h='22',$w=$knapW,$label='@Rabatgrupper',           $link=$ØProgRoot.'_system/page_Rabatgrupper.php', $title='@Indstillinger angående Rabatgrupper');
  htm_nl();  menuKnap($h='22',$w=$knapW,$label='@Enheder & materialer',   $link=$ØProgRoot.'_system/page_Enheder.php',      $title='@Indstillinger angående registrede Enheder, beskrivelse og materiale');
  htm_nl();  htm_hr($ØLineBrun);  
             menuKnap($h='22',$w=$knapW,$label='@Firma stamdata',         $link=$ØProgRoot.'_system/page_Stamkort.php',     $title='@Indstillinger angående Stamdata');
  htm_nl();  menuKnap($h='22',$w=$knapW,$label='@Bruger rettigheder',     $link=$ØProgRoot.'_system/page_Brugere.php',      $title='@Indstillinger angående Brugere');
  htm_nl();  menuKnap($h='22',$w=$knapW,$label='@Regnskabsår',            $link=$ØProgRoot.'_system/page_Regnskabsaar.php', $title='@Indstillinger angående Regnskabsår');
  htm_nl();  menuKnap($h='22',$w=$knapW,$label='@Udskrivnings Formularer',$link=$ØProgRoot.'_system/page_FormText.php',     $title='@Indstillinger angående udskrivnings blanketter / Formularer');
  htm_nl();  menuKnap($h='22',$w=$knapW ,$label='@Administrator menu',    $link=$ØProgRoot.'_base/page_Blindgyden.php',     $title='@Indstillinger angående oprettelse/nedlægning/omdøbning af Regnskaber m.v.');
  htm_nl();  htm_hr($ØLineBrun);  
            // menuKnap($h='22',$w=$knapW,$label='@Udvikling: Layouttest',  $link=$ØProgRoot.'_base/page_Layoutdemo.php',     $title='@Visning af eksempler på panelers opbygning.');
  htm_nl();    
  // htm_nl();  naviKnap($label='@Hovedmenu', $title='@Vend tilbage til programmets hovedmenu',$link='../_base/page_Hovedmenu.php',$akey='h');
  // htm_nl();  naviKnap($label='@Indstillinger 1', $title='@Gå til en anden indstillings menu',$link='../_system/page_Valuta.php',$akey='1');
  htm_nl();  naviKnap($label='@Indstillinger 2', $title='@Gå til en anden indstillings menu',$link='../_system/page_Divsetup2.php',$akey='2');
  htm_nl();  naviKnap($label='@Indstillinger 3', $title='@Gå til en anden indstillings menu',$link='../_system/page_Tilvalgsetup3.php',$akey='3');
  //  htm_nl();  textKnap($label='@Flere indstillinger 2.',  $title='@Diverse indstillinger', $link=$ØProgRoot.'_system/page_Divsetup2.php',$akey='2');
  htm_nl();
  htm_CentOff();
  htm_PanlBund($pmpt=Tolk('@Retur til hovedmenu'),$subm=false,$title='@Luk og gå retur til hovedmenu');
};

######### :SYSTEM:
# Kaldes fra:  [_system/page_Bilagsinfo.php] [_system/page_Differencer.php] [_system/page_Diversevalg.php] [_system/page_Divsetup2.php] [_system/page_Formtekst.php] [_system/page_Imogexport.php] [_system/page_Kontoindstill.php] [_system/page_Massefakt.php] [_system/page_Ordrerelat.php] [_system/page_Personlig.php] [_system/page_Prislister.php] [_system/page_Programsprog.php] [_system/page_Provision.php] [_system/page_Rykkerrel.php] [_system/page_Tjeklister.php] [_system/page_Varerelat.php] [_system/page_xxx.php] 
function Panl_DiverseMenu() {global $ØLineBrun; ## out_PanlsSekd.php
//  Ny opdeling: Regnskabs-indstillinger og Program-indstillinger ?
  htm_Panl_Top($name='adminform',$capt='@Indstillinger 2, Flere.',$parms='../_system/page_Valuta.php',$icon='fas fa-bars',$klasse='panelW240',__FUNCTION__);
  $goBack= '?returside=../_base/menu.php';
  $knapW= 220;
  htm_CentrOn();
            menuKnap($h='22',$w=$knapW ,$label='@Kontoindstilling',      $link='../_system/page_Kontoindstill.php',  $title='@Indstillinger angående regnskabsnavn og mailserver for afsendelse af mail');
  htm_nl(); menuKnap($h='22',$w=$knapW ,$label='@Provisionsberegning',   $link='../_system/page_Provision.php',    $title='@Indstillinger angående Provisionsberegning');
# htm_nl();  menuKnap($h='22',$w=$knapW ,$label='@Varerelateret',         $link='../_system/page_Varerelat.php',  $title='@Indstillinger angående Varerelateret f.eks. varianter');
  htm_nl(); menuKnap($h='22',$w=$knapW ,$label='@Ordrerelaterede valg',  $link='../_system/page_Ordrerelat.php',   $title='@Indstillinger angående Ordrerelaterede valg');
  htm_nl(); menuKnap($h='22',$w=$knapW ,$label='@Varerelaterede valg',   $link='../_system/page_Varerelat.php',    $title='@Indstillinger angående Varerelateret f.eks. varianter');
  htm_hr($ØLineBrun); 
            menuKnap($h='22',$w=$knapW ,$label='@Prislister',            $link='../_system/page_Prislister.php',   $title='@Indstillinger angående Prislister');
  htm_nl(); menuKnap($h='22',$w=$knapW ,$label='@Bilagshåndtering',      $link='../_system/page_Bilagsinfo.php',   $title='@Indstillinger angående Bilagshåndtering');
  htm_nl(); menuKnap($h='22',$w=$knapW ,$label='@Diverse valg',          $link='../_system/page_Diversevalg.php',  $title='@Indstillinger angående Diverse valg');
  htm_nl(); htm_hr($ØLineBrun); 
            menuKnap($h='22',$w=$knapW ,$label='@Rykkerrelateret',       $link='../_system/page_Rykkerrel.php',    $title='@Indstillinger angående Rykkerrelaterede');
  htm_nl(); menuKnap($h='22',$w=$knapW ,$label='@Tjeklister',            $link='../_system/page_Tjeklister.php',   $title='@Indstillinger angående Tjeklister');
  htm_nl(); menuKnap($h='22',$w=$knapW ,$label='@Øredifferencer',        $link='../_system/page_Differencer.php',  $title='@Indstillinger angående Øredifferencer');
  htm_nl(); menuKnap($h='22',$w=$knapW ,$label='@Massefakturering',      $link='../_system/page_Massefakt.php',    $title='@Indstillinger angående Massefakturering');
  htm_nl(); htm_hr($ØLineBrun); 
            menuKnap($h='22',$w=$knapW ,$label='@Personlige valg',       $link='../_system/page_Personlig.php',    $title='@Indstillinger angående Farver og udseende m.v.');
  htm_nl(); menuKnap($h='22',$w=$knapW ,$label='@Program Sprog',         $link='../_system/page_Programsprog.php', $title='@Indstillinger angående programmets Sprog');
  htm_nl(); menuKnap($h='22',$w=$knapW ,$label='@Formular Sprog',        $link='../_system/page_Formtekst.php',    $title='@Indstillinger angående Sprog på blanketter');
  htm_nl(); menuKnap($h='22',$w=$knapW ,$label='@Data import & eksport', $link='../_system/page_Imogexport.php',   $title='@Importér / eksportér: Kontoplan, Formularer, Debitorer, Kreditorer, Varer, og Dataudtræk');
  //htm_nl(2); naviKnap($label='@Tilvalgs indstillinger 3.', $title='@Indstillinger, som angår tilvalgs funktioner', $link='../_system/page_Tilvalgsetup3.php',$akey='3');
  htm_nl();    
  //  htm_nl(); naviKnap($label='@Hovedmenu', $title='@Vend tilbage til programmets hovedmenu',$link='../_base/page_Hovedmenu.php',$akey='h');
  htm_nl(); naviKnap($label='@Indstillinger 1', $title='@Gå til en anden indstillings menu',$link='../_system/page_Valuta.php',$akey='1');
  //  htm_nl();  textKnap($label='@Indstillinger 2', $title='@Gå til en anden indstillings menu',$link='../_system/page_Divsetup2.php',$akey='2');
  htm_nl(); naviKnap($label='@Indstillinger 3', $title='@Gå til en anden indstillings menu',$link='../_system/page_Tilvalgsetup3.php',$akey='3');
  htm_nl(); htm_CentOff();
  htm_PanlBund($pmpt=Tolk('@Retur til indstillinger 1.'),$subm=false,$title='@Luk og gå retur til indstillingsmenu');
};

######### :SYSTEM:
# Kaldes fra:  [_system/page_Labels.php] [_system/page_Tilvalgsetup3.php] 
function Panl_TilvalgsMenu() {global $ØProgTitl, $ØLineBrun; ## out_PanlsSekd.php
  htm_Panl_Top($name='tilvform',$capt='@Indstillinger 3, Tilvalg',$parms='../_system/page_Divsetup2.php',$icon='fas fa-bars',$klasse='panelW240',__FUNCTION__);
  $goBack= '?returside=../_base/menu.php';
  $knapW= 220;
  htm_CentrOn();
  htm_hr($ØLineBrun);  htm_Caption('@Tillægs funktioner:');
  htm_nl();  menuKnap($h='22',$w=$knapW ,$label='@Aktivering af moduler',       $link='../_system/page_Tilvalg.php',         
          $title='@Indstillinger angående aktivering af ekstra moduler m.v.');
  htm_nl();  menuKnap($h='22',$w=$knapW ,$label='@Shop relaterede valg (WEB)',  $link='../_base/page_Blindgyden.php',   
          $title='@Indstillinger angående WEB-Shop relaterede valg');
  htm_nl();  menuKnap($h='22',$w=$knapW ,$label='@Web API',                     $link='../_base/page_Blindgyden.php',         
          $title= tolk('@Indstillinger angående API (Application Programming Interface), en softwaregrænseflade, der tillader').
          $ØProgTitl.' '.tolk('@at interagere med andet software'));
  htm_nl();  menuKnap($h='22',$w=$knapW ,$label='@PoS-valg (Kasse/kontantsalg)',$link='../_base/page_Blindgyden.php',         
          $title='@Indstillinger angående PoS-valg (Point-of-Sale), angår kasseapparat løsningen');
  htm_nl();  menuKnap($h='22',$w=$knapW ,$label='@Label print',                 $link='../_system/page_Labels.php',       
          $title='@Indstillinger angående Labels');
  htm_CentOff();
  htm_nl();
  htm_CheckFlt($type='checkbox',$name='docubizz', $valu= $docubizz,  $labl='@Integration med DocuBizz', 
          $titl='@Import fra DocuBizz - Det intelligente fakturasystem',  $revi=true, $more=' '.$pg);
  
  htm_CheckFlt($type='checkbox',$name='ebconn', $valu= $ebconn,  $labl='@Integration med ebConnect',    
          $titl='@Elektronisk fakturering. Send og modtag e-faktura med ebconnect. Send direkte fra økonomisystemet og overfør til kassekladden - klar til bogføring');

  htm_CentrOn();
  //  htm_nl();  naviKnap($label='@Hovedmenu', $title='@Vend tilbage til programmets hovedmenu', $link='../_base/page_Hovedmenu.php',$akey='h');
  htm_nl();  naviKnap($label='@Indstillinger 1', $title='@Gå til en anden indstillings menu',$link='../_system/page_Valuta.php',$akey='1');
  htm_nl();  naviKnap($label='@Indstillinger 2', $title='@Gå til en anden indstillings menu',$link='../_system/page_Divsetup2.php',$akey='2');
  //  htm_nl();  naviKnap($label='@Indstillinger 3', $title='@Gå til en anden indstillings menu',$link='../_system/page_Tilvalgsetup3.php',$akey='3');
  htm_nl();  
  htm_CentOff();
  htm_PanlBund($pmpt=Tolk('@Retur til indstillinger 2.'), $subm=false, $title='@Luk og gå retur til indstillingsmenu');
};


######### :SYSTEM:
# Kaldes fra: [_system/page_Tilvalg.php]  [_system/page_Tilvalgsetup3.php]
function Panl_Tilvalg() 
{global $ØProgTitl, $ØLineBrun; ## out_PanlsSekd.php
  global $Øvis_finans, $Øvis_debitor, $Øvis_kreditor, $Øvis_prodkt, $Øvis_lager;
  htm_Panl_Top($name='tilvform',$capt='@Aktivering af moduler',$parms='#',$icon='fas fa-bars',$klasse='panelW320',__FUNCTION__);
  $goBack= '?returside=../_base/menu.php';
  $knapW= 220;
  htm_CentrOn();
  htm_Caption('@SALDI´s program moduler:');
  htm_CentOff();
  $Øvis_finans=   htm_CheckFlt($type='checkbox',$name='fin', $valu= $Øvis_finans,   $labl='@FINANS',      $titl='@Regnskabsføring i finans-modulet');
  $Øvis_debitor=  htm_CheckFlt($type='checkbox',$name='deb', $valu= $Øvis_debitor,  $labl='@DEBITOR',     $titl='@Salg til kunder i debitor-modulet');
  $Øvis_kreditor= htm_CheckFlt($type='checkbox',$name='kre', $valu= $Øvis_kreditor, $labl='@KREDITOR',    $titl='@Indkøb fra leverandører i kreditor-modulet');
  $Øvis_lager=    htm_CheckFlt($type='checkbox',$name='lag', $valu= $Øvis_lager,    $labl='@LAGER',       $titl='@Produkter til salg i lager-modulet');
  $Øvis_prodkt=   htm_CheckFlt($type='checkbox',$name='pro', $valu= $Øvis_prodkt,   $labl='@PRODUKTION',  $titl='@Administration i produktions-modulet');
  htm_Plaintxt('Disse moduler er altid aktive, men de kan "slukkes" i menu-systemet.');
// $Øvis_finans=    $_POST['fin'];
// $Øvis_debitor=   $_POST['deb'];
// $Øvis_kreditor=  $_POST['kre'];
// $Øvis_lager=     $_POST['lag'];
// $Øvis_prodkt=    $_POST['pro'];
  htm_hr($ØLineBrun); 
  htm_nl();
  htm_CentrOn();
  htm_Caption('@SALDI´s tillægs moduler:');
  htm_CentOff();
  htm_CheckFlt($type='checkbox',$name='pos', $valu= $pro, $labl='@KASSE',       $titl='@Kontantsalg. Benyt POS-modul (Point Of Sale)',  $revi=false);
  htm_CheckFlt($type='checkbox',$name='web', $valu= $pro, $labl='@WEB-shop',    $titl='@Integration med net-butik',  $revi=false);
  htm_Plaintxt('Disse moduler kræver supplerende installation, før de kan benyttes.');
  htm_PanlBund($pmpt=('@Gem'), $subm=true, $title='');
};


######### :SYSTEM:
# Kaldes fra: [_base/page_Install.php] [_base/page_Startup.php] [_system/page_Connsetup.php] 
function Panl_DBsetup(&$db_type,&$db_encode,&$db_navn,&$db_bruger,&$db_password,&$adm_navn,&$adm_password,&$verify_adm_password,&$db_host) { ## out_PanlsSekd.php
  global $ØButtnBgrd, $ØButtnText, $ØProgTitl, $Ønovice; 
  htm_Panl_Top($name='opret',$capt=$ØProgTitl.'-<small> € :</small> '.Tolk('@Database setup'),$parms='../_admin/ini_CreateDB.php.php',$icon='fas fa-wrench',$klasse='panelW320',__FUNCTION__);
  htm_CombFelt($type='text',  $name='db_host',    $valu= $db_host,    
               $labl='@Server vært', 
               $titl='@Navn på den leverandør, der står for serverdriften. ',
               $revi=true, $rows='2',$width='',$step='', $more=' ', $plho=tolk('@Angiv HOST-leverandør...'));
  htm_OptioFlt($type='text',  $name='db_type',    $valu= $db_type,  
                    $labl='@Server type',  
                    $titl='@Vælg den databaseserver type, du ønsker at bruge.', 
                    $revi=true, $optlist= array(
                    ['@PostgreSQL','PostgreSQL','@PostgreSQL'],
                    ['@MySQL','MySQL','@MySQL']),$action='');
  htm_OptioFlt($type='text',  $name='db_encode',    $valu= $db_encode,  
                    $labl='@Tegnsæt',         
                    $titl='@Vælg det tegnsæt du ønsker at bruge. Nyere versioner af PostgreSQL fungerer kun med UTF8, som anbefales generelt',  
                    $revi=true, $optlist= array(
                    ['@Vælg UTF8 tegnsæt','UTF8','UTF8'],
                    ['@Vælg LATIN9 tegnsæt','LATIN9','LATIN9']),$action='');
  htm_Caption('@Adgang til database server:');
  htm_CombFelt($type='text',  $name='db_bruger',    $valu= $db_bruger,    
               $labl='@Aktiv databaseadministrator', 
               $titl=tolk('@Navn på en eksisterende bruger, som har tilladelse til at oprette, rette og slette databaser. ').'<br>'.
                     tolk('@Typisk er det for PostgreSQL brugeren [postgres] og for MySQL brugeren [root].'),                          
               $revi=true, $rows='2',$width='',$step='', $more=' required ', $plho=tolk('@Angiv DB-admin...'));
  htm_CombFelt($type='password',  $name='db_password',  $valu= $db_password, 
               $labl='@Adgangskode for databaseadministrator',  
               $titl='@Adgangskode for ovenstående bruger',                          
               $revi=true, $rows='2',$width='',$step='', $more='required ', $plho=tolk('@Password...'));
  htm_Caption('@Opret'.$ØProgTitl.' database:');
  htm_CombFelt($type='text',  $name='db_navn',      $valu= $db_navn,      
               $labl='@Databasenavn',                
               $titl=tolk('@Ønsket navn på din hoveddatabase for').$ØProgTitl.tolk('@ F.eks.').': [saldi-db]',  
               $revi=true, $rows='2',$width='',$step='', $more='required ', $plho=tolk('@Angiv et navn til databasen...'));
  htm_CombFelt($type='text',  $name='adm_navn',     $valu= $adm_navn,     
               $labl=$ØProgTitl.'-'.tolk('@administratorens brugernavn'), 
               $titl=tolk('@Ønsket navn på din').$ØProgTitl.'-'.tolk('@administratorkonto til dit').$ØProgTitl.'-system. F.eks.: [saldi-admin]',  
               $revi=true, $rows='2',$width='',$step='', $more='required ', $plho=tolk('@Angiv admin...'));
# echo '<form>';
  htm_CombFelt($type='passwordpower', $name='passwordpwr',  $valu= $adm_password,   
                $labl=$ØProgTitl.'-'.tolk('@administratorens adgangskode'),  
                $titl=tolk('@Ønsket adgangskode for').$ØProgTitl.'-'.tolk('@administratoren af dit').$ØProgTitl.'-system',
                $revi=true, $rows='2',$width='',$step='', $more='required ', $plho=tolk('@Password...'));
  htm_CombFelt($type='password',  $name='confirm_password', $valu= $verify_adm_password,    
                $labl=tolk('@Gentag').$ØProgTitl.'-'.tolk('@administratorens adgangskode'), 
                $titl='@Verificering af ovenstående adgangskode',                         
                $revi=true, $rows='2',$width='',$step='', $more='required ', $plho=tolk('@Gentag password...'));
//  echo '<div align= "center"><button type="submit" name="submit" class="tooltip" style="margin: 1px 1px; padding: 1px 3px; background:'.$ØButtnBgrd.'; color:'.$ØButtnText.';" ">'.
//          tolk('@Kontrollèr Administrators Passwords').'<span class="tooltiptext">'.tolk('@Test om de indtastede password er ens.').'</span></button></div>';
# echo '</form>';
  
  htm_hr();
//  userTip(); $Ønovice
  if (true) {
    echo '<div style="text-align:left"><small><b>'.tolk('@Alle').'</b> '.tolk('@felter skal udfyldes og kontrolleres.').' <br>&nbsp;&nbsp;<br>';
    echo '<b>'.tolk('@TIP:').'</b> '.tolk('@Hold musen over blå tekster, for at få hjælpetip.').'</small></div>';
  }
  echo '<br><div style="text-align:left"><small><b>'.tolk('@HUSK:').'</b> '.tolk('@Skrivebeskyt alle programmets mapper på serveren, på nær: ').
       '<br>../_config ../_exchange ../_temp ../_userlib '.
       tolk('@og undermapper heri.<br>Mappen ../_config indeholder oplysninger om adgang til databasen, men disse beskyttes af en .htaccess fil.').'</small></div>';
  htm_PanlBund($pmpt=Tolk('@Opret DB'),$subm=true,$title=tolk('@Klik her for at oprette dit').$ØProgTitl.' database-system');

  /*  Vis password som tekst:
  run_Script('$(".toggle-password").click(function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") 
           { input.attr("type", "text"); } 
      else { input.attr("type", "password"); }
    });
  ');
  /*
    .field-icon {
      float: right;
      margin-left: -25px;
      margin-top: -25px;
      position: relative;
      z-index: 2;
    }
*/
  
/*  Password-felt med øje:
  echo ' <div>
            <input id="password-field" type="password" class="form-control" name="password" value="secret">
            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
        </div>
  ';
*/
  echo '<script>';
  echo 'var password = document.getElementById("passwordpwr"), ';
  echo '  confirm_password = document.getElementById("confirm_password");';
  echo 'function validatePassword(){';
  echo '  if(password.value != confirm_password.value) ';
  echo '    {confirm_password.setCustomValidity("'.tolk('@Passwords er forskellige').'"); } ';
  echo '  else {confirm_password.setCustomValidity("");   }';
  echo '}';
  echo 'if (password) password.onchange = validatePassword;';
  echo 'confirm_password.onkeyup = validatePassword;';
  echo '</script>';
}

######### :SYSTEM:
# Kaldes fra:  [_base/page_Install.php] [_base/page_Startup.php] [_system/page_Connsetup.php] 
function Panl_Install(&$db_type,&$db_encode,&$db_navn,&$db_bruger,&$db_password,&$adm_navn,&$adm_password,&$verify_adm_password) { global $ØProgTitl;  ## out_PanlsSekd.php
# Test for skrivbarhed:
  if ($fp=fopen("../_config/connect.php","a"))   { fclose($fp); $inc='checked';} else $inc.='';
  if ($fp=fopen("../_temp/test.txt","w"))        { fclose($fp); $tmp='checked';} else $tmp.='';
  if ($fp=fopen("../_exchange/test.txt","w"))    { fclose($fp); $exc='checked';} else $exc.='';
  if ($fp=fopen("../_userlib/test.txt","w"))     { fclose($fp); $lgo='checked';} else $lgo.='';
#+  
  if (extension_loaded('mysqli')) {if ($link= mysqli_connect("")) {$mq= 'checked'; mysqli_close($link);}  else $mq= '';}  else $mq= '';
  if (extension_loaded('pgsql'))  {if (pg_connect(""))            {$pg= 'checked'; pg_close();}           else $pg= '';}  else $pg= '';
  if ($mq) $mqtx= tolk('@findes');   else $mqtx= tolk('@mangler');
  if ($pg) $pgtx= tolk('@findes');   else $pgtx= tolk('@mangler');
  if (ØisSecure()) $sec = 'checked'; else $sec = '';
  htm_Panl_Top($name='opret',$capt= '@Installations forberedelse',$parms='../_base/_admin/ini_CreateDB.php',$icon='fas fa-wrench',$klasse='panelW320',__FUNCTION__);
 echo '<div style="text-align:left"><small>'.'<b>'.
      tolk('@Nødvendig forberedelse:').'</b><br> '.
      tolk('@En webserver med PHP skal være i drift, med DB-extension pqsql eller mysqli aktiveret.').' <br>'.
      tolk('@På serveren skal være installeret en af database serverne PostgreSQL eller MySQL-kompatibel.').'<br>';
      tolk('@I PHP skal ZIP-extension være aktiv, for at kunne udføre program-backup.').'<br>';
      //  MySQL:mysqldump eller Postgre:export, for at kunne udføre DB-backup.
      //  system: mv tar gzip, for kunne udføre operationer på filer.
  
  htm_FrstFelt('50%');  
  htm_StatsFlt($type='status',$name='pg',     $valu= ($pg== 'checked'), $labl='@Postgres '.$pgtx,  $titl='@Systemet kontrollerer om modulet er tilgængeligt. ');
  htm_NextFelt('50%');  
  htm_StatsFlt($type='status',$name='mysql',  $valu= ($mq== 'checked'), $labl='@MySQL '.$mqtx,     $titl='@Systemet kontrollerer om modulet er tilgængeligt. ');
  htm_LastFelt();
  echo '<hr>'.tolk('@Hvis systemet ikke køres på lokalnet, bør det ske via en sikker krypteret forbindelse:').'<br/>';
  htm_StatsFlt($type='status',$name='https',  $valu= ØisSecure() ,      $labl='@HTTPS er aktiv.',   $titl='@Systemet kontrollerer om HTTPS er benyttet.');
  echo '</div><hr>'.
      tolk('@Pakken med').$ØProgTitl.'-'.tolk('@filer, udpakkes i en program mappe, med adgang for webbesøgende. Navngiv den f.eks.: saldi-e').'<br><br>'.
      tolk('@Der skal være skriveadgang til 4 under-mapper:').'<br>';
  htm_FrstFelt('50%');
  htm_StatsFlt($type='status',$name='conf', $valu= ($inc== 'checked'),  $labl='_config',    $titl='@Systemet kontrollerer om mappen, angående systemets konfiguration, er skrivbar');
  htm_NextFelt('50%');
  htm_StatsFlt($type='status',$name='exch', $valu= ($exc== 'checked'),  $labl='_exchange',  $titl='@Systemet kontrollerer om mappen, som benyttes til import/eksport, er skrivbar');
  htm_LastFelt();
  htm_FrstFelt('50%');
  htm_StatsFlt($type='status',$name='temp', $valu= ($tmp== 'checked'),  $labl='_temp',      $titl='@Systemet kontrollerer om mappen, som benyttes til midlertidige filer, er skrivbar');
  htm_NextFelt('50%');
  htm_StatsFlt($type='status',$name='llib', $valu= ($lgo== 'checked'),  $labl='_userlib',   $titl='@Systemet kontrollerer om mappen, som benyttes til bruger-filer, er skrivbar');
  htm_LastFelt();
  echo tolk('@Alle andre mapper skal være skrivebeskyttet, når systemets filer er på plads!');
//      .'<hr><b>PHP </b>'. tolk('@skal understøtte modulerne: mcrypt og hash, som benyttes til at håndtere passwords sikkert.').'<br>';
//  htm_FrstFelt('50%');  
//  htm_CheckFlt($type='checkbox',$name='hash',   $valu= '',  $labl='@hash installeret.', $titl='@Systemet kontrollerer om modulet er tilgængeligt',  $revi=false,$more='checked="'.extension_loaded('hash').'"');
//  htm_NextFelt('50%');  
//  htm_CheckFlt($type='checkbox',$name='mcrypt', $valu= '',  $labl='@mcrypt installeret.', $titl='@Systemet kontrollerer om modulet er tilgængeligt',  $revi=false,$more='checked="'.extension_loaded('mcrypt').'"');
//  htm_LastFelt();
  $txt1 = '<small> ('.tolk('@Gælder kun SALDI ver.3.x').')</small>';
  echo '<hr>'.
      tolk('@For at udnytte alle udskrivnings faciliteter, skal webserveren understøtte ekstra PDF/Grafik-programmer.').' <br>'. '<br><b>Ghostscript & ps2pdf</b> '.
      tolk('@for at kunne udskrive formularer.').$txt1.'<br><b>ImageMagic</b> '.
      tolk('@er nødvendig for at flette udskrift med Logo.').$txt1. '<br><b>PDFtk</b> - '.
      tolk('@The PDF Toolkit: flette pdf-baggrund med sideudskrift.').$txt1;
  echo '<hr><div style="text-align:left">'.
      tolk('@Bemærkt også, at').' <b>javascript</b> '.
      tolk('@skal være aktiveret !');
  echo '<hr>'.
      tolk('@Oprettelse af regnskab, sker senere, når du 1. gang logger ind, som ').$ØProgTitl.'-administrator.'.'<br><br>'.
      tolk('@På').$ØProgTitl.'-wiki '.tolk('@kan du læse supplerende informationer.');
  echo '</small></div>';
  htm_PanlBund($pmpt=Tolk('@Installér'),$subm=false,$title=tolk('@Klik her for at oprette dit').$ØProgTitl.' database-system');
}

######### :SYSTEM:
# Kaldes fra: 
function Panl_InstallFail($noskriv) { global $ØProgTitl; ## out_PanlsSekd.php
  htm_Panl_Top($name= 'opret', $capt= '@Installation fejler!', $parms='db_setup.php', $icon='fas fa-wrench', $klasse='panelW320',__FUNCTION__);
    echo '<b>'.tolk('@Problem:').'</b><br>';
    echo tolk('@Der er ikke skriveadgang til kataloget:'),' "'.$noskriv.'"<br>';
    // if (extension_loaded('mcrypt') && extension_loaded('hash')) { $ext_loaded=true;  }
    if ($noskriv=="_config") 
    echo tolk('@hvor filen "connect.php" skal oprettes.').'<br><br>';
    echo tolk('@Sørg for at der er skriveadgang for Webbrugere, til katalogerne').': "_config", "_temp", "_userlib" <br><br>';
    echo tolk('@Se hvordan i installeringsvejledningen INSTALLATION.txt.').' <br><br>';
  htm_PanlBund($pmpt= Tolk('@Installér'),$subm=false,$title=tolk('@Klik her for at oprette dit').$ØProgTitl.' database-system');
}

######### :SYSTEM:
# Kaldes fra: 
function Panl_InstallSucces(&$db_navn, &$adm_navn) { global $ØProgTitl; ## out_PanlsSekd.php
  htm_Panl_Top($name='oprettet',$capt= '@Databasen er installeret',$parms='page_Blindgyden.php',$icon='fas fa-wrench',$klasse='panelW320',__FUNCTION__);
    echo '<b>'.tolk('@Bravo:').'</b><br>';
    echo tolk('@Dit'.$ØProgTitl.'-system er nu oprettet. Det første, du nu skal gøre, er at oprette et regnskab.').'<br><br>';
    echo tolk('@Det gøres ved at logge ind med: ').'<br>[<b>'.$db_navn.'</b>] '.tolk('@som regnskab').', <br>[<b>'.$adm_navn.'</b>] ';
    echo tolk('@som brugernavn og med den valgte adgangskode').'<br><br>';
    echo tolk('@Tegn en hotline-aftale, så kan du ringe eller sende en e-mail og få hurtigt svar på spørgsmål om brugen af'.$ØProgTitl.'.').'<br><br>';
    echo tolk('@Se mere på').' <a href="http://saldi.dk/hotline" target="_blank">http://saldi.dk/hotline</a> <br>';
//    echo '<p>&nbsp;</p><br>';
//    echo '<p><a href="../_base/index.php" title="Til SALDI-administratorsiden hvor regnskaber administreres" <br>';
//    echo ' style="text-decoration:none"><input type="button" value="Fortsæt"></a><br><br>';
  htm_PanlBund($pmpt=Tolk('@Fortsæt'),$subm=true,$title='@Fortsæt til logind og oprettelse af 1. regnskab');
}


######### :SYSTEM:
# Kaldes fra: [_base\out_vinduer.php]
function Panl_Tabel($TablData=array()) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'naviform',$capt= '@DEMO: Tabel med fastlåst kolonne-header og "rulle-vindue"',$parms='page_Blindgyden.php',$icon='fas fa-database','panelWmax',__FUNCTION__);
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),  // if (($ModifyRec) or ($RowBody[0][2]!='indx')) er 2% benyttet til => knap
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Lb.Nr.',     '6%', '',''    , ['center'], '','..auto..'],
          ['@Ordre dato', '8%', '','date', ['left'  ], '', 'YYYY-MM-DD'],
          ['@Lev. dato',  '8%', '','date', ['left'  ], '', 'YYYY-MM-DD'],
          ['@Konto nr.',  '7%', '','text', ['center'], '', tolk('@Kont...')],
          ['@Firma navn','24%', '',''    , ['left'  ], '', tolk('@Firm...')],
          ['@Sælger',     '8%', '',''    , ['left'  ], '', tolk('@Sælg...')],
          ['@Ordre sum',  '7%', '',''    , ['right' ], '', tolk('@Beløb...')]
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON, ]
    $DATA= array( # DemoData:
            ['1025','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1026','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1027','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1025','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1026','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1027','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1025','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1026','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1027','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1025','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1026','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1027','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1025','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1026','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1027','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum'],
            ['1028','Ordredato','Levdato','Kontonr.','Firmanavn','Sælger','Ordresum']
          ),#=   array(),
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter   //  Virker ikke med hidd-felter!
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at vælge og ændre data i en row
    $ViewHeight= '400px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__,
    $Kriterie= ['','']    # Test [DataKolonneNr, > grænseværdi] Undlad spec. feltColor
  );
  htm_PanlBund($pmpt='@Gem',$subm=false);
}

######### :SYSTEM:
# Kaldes fra: [_base\out_vinduer.php]
function Panl_Debitorer($TablData=array()) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'naviform',$capt= '@Konti - Debitorer:',$parms='page_Blindgyden.php',$icon='fas fa-database','panelWmax',__FUNCTION__,'','legeplads:lege-side#kunden');
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),  // if (($ModifyRec) or ($RowBody[0][2]!='indx')) er 2% benyttet til => knap
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Kontonr.',   '6%','','',[''],'','..auto..'],
          ['@Kundenavn', '10%','','',[''],'','Firm...'],
          ['@Adresse',    '8%','','',[''],'','Addr...'],
          ['@Sted',       '8%','','',[''],'','Sted...'],
          ['@Postnr',     '4%','','',[''],'','Post...'],
          ['@By',         '8%','','',[''],'','By...'],
          ['@Kontakt',   '12%','','',[''],'','Kont...'],
          ['@Telefon',   '12%','','',[''],'','Telf...'],
          ['@Sælger',    '12%','','',[''],'','Sælg...']
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON, ]
    $DATA= array( # DemoData:
          ['1025','Firmanavn','Adresse','Sted','Postnr','By','Kontakt','Telefon','Sælger'],
          ['1026','Firmanavn','Adresse','Sted','Postnr','By','Kontakt','Telefon','Rip'],
          ['1027','Firmanavn','Adresse','Sted','4560','By','Kontakt','Telefon','Rap'],
          ['1028','Firmanavn','Adresse','Sted','Postnr','By','Kontakt','Telefon','Rup']
        ),
            #=   array(),
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter   //  Virker ikke med hidd-felter!
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at vælge og ændre data i en row
    $ViewHeight= '400px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__,
    $Kriterie= ['','']    # Test [DataKolonneNr, > grænseværdi] Undlad spec. feltColor
  );

  htm_PanlBund($pmpt='@Gem',$subm=false);
}

######### :SYSTEM:
# Kaldes fra:  [_system/page_Lagre.php] [_system/page_Licens.php] 
function Panl_Lagre(&$Nr, &$Beskrivelse, &$Afd) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'lagrform',$capt= '@Lagre:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Angår:',       '45%','show','','left', 'Kode: LG', '@Lager registrering']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Nr.',          '20%','text','',['left'],  '@Entydigt Lager nummer','@Nr...'],
          ['@Beskrivelse',  '50%','text','',['left'],  '@Lager beskrivelse.','@besk...'],
          ['@Afd.',         '30%','text','',['left'],  '@Lageret hvor varen er tilknyttet, ved varens oprettelse','@afd...'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        []
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $DATA=   array(
          ['','',''],
          ['','',''],
          ['','','']
        ),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '200px',   # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );

  htm_Caption('@Regler for Lagre:');
  htm_Plaintxt('@Der kan oprettes et ubegrænset antal lagre. Der kan være ingen, et eller flere lagre pr afdeling. Dog skal der minimum være ét lager tilknyttet én afdeling.');
  htm_Plaintxt('@Ved varekøb/salg vælges det lager som hører til den afdeling, hvor den person som foretager indkøbet et tilknyttet.');
  htm_Plaintxt('@Hvis der ikke er et knyttet et lager til afdelingen og der ér mere end et lager, skal lager vælges.');
  htm_PanlBund($pmpt='@Gem',$subm=true);
}


######### :SYSTEM:
# Kaldes fra:  [_system/page_Projekter.php] 
function Panl_Projekter(&$Nr, &$Beskrivelse) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'projform',$capt= '@Projekter:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Angår:',       '45%','show','','left', 'Kode: PRJ', '@Projekt registrering']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Nr.',          '15%','text','',['left'],  '@Entydigt Projekt nummer','@Nr...'],
          ['@Beskrivelse',  '85%','text','',['left'],  '@Projekt beskrivelse.','@besk...'],
      ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
          []
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $DATA=   array(
          ['',''],
          ['',''],
          ['',''],
          ['',''],
          ['',''],
        ),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '200px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :SYSTEM:
# Kaldes fra:  [_system/page_Afdelinger.php] 
function Panl_Afdelinger(&$Nr, &$Beskrivelse, &$Afd) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'afdlform',$capt= '@Afdelinger:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Angår:',       '45%','show','','left', 'Kode: AFD', '@Afdelings registrering']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Nr.',         '15%','text','',['left'],  '@Entydigt Afdeling nummer',    '@Nr...'],
          ['@Beskrivelse', '65%','text','',['left'],  '@Navnet på Afdelingen.',       '@besk...'],
          ['@Afd.',        '20%','text','',['left'],  '@Lager tilknyttet Afdelingen', '@afd...'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
          []
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $DATA=   array(
          ['','',''],
          ['','',''],
          ['','',''],
          ['','',''],
        ),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '200px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );

  htm_Caption('@Regler for Afdelinger:');
  htm_Plaintxt('@Der kan oprettes et ubegrænset antal afdelinger.');
  htm_Plaintxt('@Der kan være ingen, et eller flere lagre pr afdeling. Dog skal der minimum være ét lager tilknyttet én afdeling.');
  htm_Plaintxt('@Alle ansatte skal være tilknyttet en afdeling. ');
  htm_Plaintxt('@I kassekladden kan der, for hvert bilagsnummer, hvis der er mere end en afdelign, vælges hvilken afdeling posteringen vedrører.');
  htm_Plaintxt('@Ved varekøb/salg vælges det lager som hører til den afdeling, hvor den person som foretager indkøbet et tilknyttet.');
  htm_Plaintxt('@Hvis der ikke er et knyttet et lager til afdelingen og der ér mere end et lager, skal lager vælges.');

  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :SYSTEM:
# Kaldes fra:  [_system/page_Programsprog.php] 
function Panl_LanguageJuster() {  ## out_PanlsSekd.php
  global $ØsprogTabl, $ØprogSprog, $ØlanguageTable, $ØsprogCol, $ØsprogRow;
  $ØsprogCol= $_SESSION['ØsprogCol'];
  $ØsprogRow= $_SESSION['ØsprogRow'];
  $col= $ØsprogCol;  $row= $ØsprogRow;
  $rowmax= count($ØlanguageTable);
  $col= max($col,1);  $col= min($col,7);  $row= max($row,1);  $row= min($row,$rowmax);
  $optlist= SPR_Liste();

  htm_FormLocal($name='sprogform');
  htm_Panl_Top($name='', $capt='@Program sprog - tilpasning:', $parms='', $icon='fa-language', 'panelW640', __FUNCTION__);
  htm_FrstFelt('45%');  
    //  htm_Formstart($name='sprogform'); ## Rediger: Sproget
    SprogValg($ØprogSprog,$formName='sprogform');
    //  htm_Formslut();
  htm_NextFelt('55%');    
    htm_Plaintxt($labl='@Programmets aktuelt benyttede sprog.');
  htm_LastFelt();    
  $sprogtxt= tolk('@Sprog frase').': '.$optlist[$col-1][2];
  
  htm_Rammestart($Caption='@Systemets sprog-fraser:');
  $TablData= array(); $x= 0;
  foreach ($ØlanguageTable as $rakke) {
    array_push($TablData, [$x++,$rakke[0],$rakke[$col]]);
  }
  htm_Caption($labl='@Her ser du frase numrene og en søgbar liste over sprog-fraser:');
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
      ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
            ['@Nr',         '6%','indx', '',['center','','','','',false], '@Index/løbenummer','@Index...'],
            ['@SYSTEM key','40%','text', '',['left'  ], '@Tekst-frasens nøgle','@Nøgle...'],
            [$sprogtxt,    '54%','text', '',['left'  ], '@Tekst som vises og kan tilpasses','@Tekst...']
      ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
      ),             # Felt 4: ($fieldModes), er sammensat af: [0:horJust, 1:FeltBgColor, 2:FeltStyle, 3:SorterON, 4:FilterON, 5:SelectON, ]
    $TablData,#=   array(),
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,       # Mulighed for at oprette en record
    $ModifyRec=false,       # Mulighed for at ændre data i en row
    $ViewHeight= '300px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_Caption($labl='@Her vælger du frasen, som du vil redigere:');
  htm_FrstFelt('35%');    
    htm_Formstart($name='sprogix'); ## Rediger: index til sprogkolonne
      htm_OptioFlt($type='text', $name='colix', $valu=$col,
          $labl= '@Rediger sprog', 
          $titl= tolk('@Hvilket sprog vil du redigere ? <br>') ,
          $revi=true, 
          $optlist,
          $action= $result= $_POST[$name],
          // Selvsving?   $events= 'onchange="this.form.submit();" '
          '','','',$nl=2);
      // Selvsving?   
      if (isset($_POST['submit'])) {$result = $_POST[$name];} // Problem: Komponenten retter variablen, men viser den gamle værdi! ?
      if ($result>0) {$col= $result;  $ØsprogCol= $result; $_SESSION['ØsprogCol']= $result;}
    htm_Formslut();
  htm_NextFelt('10%'); 
    htm_Formstart($name='rowform'); ## Rediger: index til sprogrække
      htm_CombFelt($type='number',  $name='rowix', $valu= $row,   $labl='@Frase',  
                  $titl='@Vælg nummer for den frase, som du vil redigere: ', $revi=true, $rows='',
                  $width='20',$step='1',$more=' onblur="submit();"  min="1" max="'.$rowmax.'"' );
      $result= $_POST[$name];  if ($result>0) {$row= $result; $ØsprogRow= $result; $_SESSION['ØsprogRow']= $result;}
    htm_Formslut();
  htm_NextFelt('35%');    
    htm_Plaintxt('&nbsp; '.tolk('@af ialt:').($rowmax-1)); //  echo '&nbsp; '.tolk('@af ialt:').($rowmax-1);
  
  htm_NextFelt('20%');    
    htm_Plaintxt('&nbsp;&nbsp; (Index:'.$row.':'.$col.')'); //  echo '&nbsp;&nbsp; (Index:'.$row.':'.$col.')';
  htm_lastFelt();
  htm_Rammeslut();
  htm_nl();  htm_Caption($labl='@Original:');
  htm_nl();  htm_Caption($labl=trim($ØlanguageTable[$row][0],'@'),$style='color:#900000;');
  htm_Formstart($name='reviform'); ## Rediger: Sprog frasen
    htm_nl();  htm_Caption($labl='@Rediger her:');
    htm_CombFelt($type='text',  $name='frase', $valu= $ØlanguageTable[$row][$col],   
                                               $labl= '@Du redigerer nu: '.' '.$optlist[$col-1][2],  
                                               $titl= 'Key:<br>'.$ØlanguageTable[$row][0], 
                                               $revi=true, $rows='2',$width='244px');
    $result= $_POST[$name];  if ($result>'') {$ØlanguageTable[$row][$col]= $result;}
  htm_Formslut();
  htm_CentrOn(); 
    textKnap($label= '@Gem og benyt rettelser',  $title= '@Klik her for at gemme dine korrektioner, og tage dem i brug',              $link= '../_base/page_Blindgyden.php');
    textKnap($label= '@Exporter til csv-fil',    $title= '@Klik her for gemme alle sprogdata i en fil, som kan indlæses i regneark',  $link= '../_base/page_Blindgyden.php'); // SprogExport($ØlanguageTable)
    textKnap($label= '@Importer fra csv-fil',    $title= '@Klik her for indlæse alle sprogdata fra en fil som du udpeger',            $link= '../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Luk og gå retur til hovedmenu');
  // ExportTabFile('../_exchange/SprogExport', chr(9), $ØlanguageTable);
  // ExportTabFile('../_exchange/SprogExport', '","', $ØlanguageTable);
#+  SprogUpdate();  //  Analyse-rutine
}

######### :SYSTEM:
# Kaldes fra: 
function GemogBrug() {  ## out_PanlsSekd.php
  ExportTabFile('../_config/MitSprog_DB', '","', $ØlanguageTable); //  GEM:  
  sprogDB_import($fname='../_config/MitSprog_DB.csv');             //  BENYT:
}

######### :SYSTEM:
# Kaldes fra: 
function SprogExport($languageTable) {  ## out_PanlsSekd.php
 # ExportTabFile('../_exchange/SprogExport', '","', $languageTable);
  msg_Dialog('info',ucfirst(tolk('@Fortsæt')),'$(this).dialog("close")','','','','',ucfirst(tolk('@Udført Export:')), 
                   ucfirst(tolk('@Der er udført en export af sprogtabellen, til filen: ../_exchange/SprogExport.csv')));
}

######### :SYSTEM:
function SprogUpdate() { //  Sammenlign aktiv tabel med friskdannet fraseliste:
  global $ØlanguageTable;
  echo '<br>Analyse af nydannet frase-liste, i forhold til gældende sprog-tabel.';
  $friskFraseFil= '../_exchange/fraseliste-jul18-dk.txt';
  $fp= fopen($friskFraseFil,"r"); // or exit("Kan ikke åbne filen ($friskFraseFil)");
  if ($fp) { $nyeKeys= array();  $Lin=0;
    while (!feof($fp)) {
      if ($txtline= fgets($fp)) { $Lin++; array_push($nyeKeys, trim('@'.$txtline)); }
    } fclose($fp);
  } 
  
  $fraseKeys= array();
  foreach ($ØlanguageTable as $oldFrase)  {array_push($fraseKeys, trim($oldFrase[0])); } //  Key-kolonnen
  
  $combiFraser= array();
  foreach ($nyeKeys as $newFrase) {   // Gennemløb af nyeste frase-tabel:
    if (in_array($newFrase,$fraseKeys)) {array_push($combiFraser,'Bevar: '.$newFrase);  echo '<br>'.'Bevar: '.$newFrase; $Bevar++; }  //  Ingen ændring
    else                                {array_push($combiFraser,'Opret: '.$newFrase);  echo '<br>'.'Opret: '.$newFrase; $Opret++; }  //  Tilføj en ny
  }
  foreach ($fraseKeys as $oldFrase) { // Gennemløb af gældende frase-tabel:
    if (!in_array(trim($oldFrase),$nyeKeys))  {array_push($combiFraser,'Fjern: '.$oldFrase);  echo '<br>'.'Fjern: '.$oldFrase; $Fjern++; }  //  Fjern forældet: unset()
  }
  //  foreach($combiFraser as $frase) echo '<br>'.$frase;
  echo "<br>Antal frasehandlinger (Bevar:$Bevar /Opret:$Opret /Fjern;$Fjern) i resultatet ialt: ".count($combiFraser);
}


######### :SYSTEM:
# Kaldes fra:  [_system/page_Divsetup2.php] [_system/page_Kontoindstill.php] 
function Panl_Kontoindstilling(&$regnskabnavn='', &$servport='', &$usernavn='', &$usercode='', &$protokol='')   ## out_PanlsSekd.php
{ global $ØProgTitl;
  htm_Panl_Top($name= 'kontoform',$capt= '@Kontoindstilling:',$parms='../_system/page_Kontoindstill.php',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
  htm_Caption('@Regnskab:');
  htm_CombFelt($type='text',  $name='regnnavn', $valu= $regnskabnavn,   $labl='@Regnskabets navn',  $titl='@Her kan du rette dit regnskabs navn', $revi=true, $rows='2',$width='',$step='');
  str_hr();  
  htm_Caption('@Mail afsendelse:');
  htm_CombFelt($type='text',  $name='servport', $valu= $servport,   
               $labl='@Alternativ SMTP-Server:Port',  
               $titl=tolk('@Her kan angives en alternativ SMTP-server for afsendelse af mail. ').
                     tolk('@Serveren skal tillade videresendelse af mails fra ssl.saldi.dk ').
                     tolk('@(eller anden server, som').$ØProgTitl.' '.tolk('@kører på). ').
                     tolk('@Hvis server porten ikke er 25, skrives port efter SMTP server-navnet adskilt med : F.eks. smtp.gmail.com:465'), 
               $revi=true, $rows='2',$width='',$step='', $more= ' placeholder="SMTP-server:25"');
  htm_CombFelt($type='text',  $name='usernavn', $valu= $usernavn,   
               $labl='@Brugernavn',  
               $titl='@Brugernavn til SMTP serveren, hvis dette kræves.', 
               $revi=true, $rows='2',$width='',$step='', $more= 'placeholder="MailUser"');
  htm_CombFelt($type='password',  $name='usercode', $valu= $usercode,   
               $labl='@Gyldig adgangskode',  
               $titl='@Adgangskode til SMTP serveren, hvis dette kræves.', 
               $revi=true, $rows='2',$width='',$step='');
  htm_OptioFlt($type='text',  $name='smtpcrypt',   $valu= $protokol, 
                    $labl='@Protokol',      
                    $titl='@Krypteringsmetode for forbindelse til SMTP serveren, hvis dette kræves.',  
                    $revi=true, $optlist= array(
                    ['Secure Sockets Layer (SSL)','ssl',  '@SSL'],
                    ['Transport Layer Security (TLS)','tls',  '@TLS'],
                    ),$action='onchange="getComboA(this)"',
                    '','','',$nl=1);
  htm_Caption('@Mail modtagelse:');
  htm_CombFelt($type='mail',  $name='bccopy', $valu= $bccopy,   
               $labl='@BC-modtager',  
               $titl='@Standard mail-adresse, som skal modtage kopi (Blind Copy) af afsendte mails', 
               $revi=true, $rows='2',$width='',$step='');
  htm_CheckFlt($type='checkbox',$name='useBC', $valu= $useBC,  
               $labl='@Send automatisk',  
               $titl='@Afsend automatisk en BC-mail, til ovennævnte mailkonto, af samtlige udgående mails',  
               $revi=true, $more='');
  //  htm_nl();
  htm_PanlBund($pmpt='@Gem',$subm=true);
}
 

######### :SYSTEM:
# Kaldes fra:  [_system/page_Personlig.php] 
function Panl_Saldisetup() {global $ØProgTitl, $Ønovice, $ØFullFilt, $ØTastkeys;  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'personl',$capt= tolk('@Hjælp i').$ØProgTitl.':',$parms='',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
  $Ønovice=   htm_CheckFlt($type='checkbox',$name='novice', $valu= $Ønovice,  
               $labl='@Vis tips for begynder:', $titl=tolk('@Hvis du afmærker dette felt, vil').
               $ØProgTitl.' '.tolk('@vise nyttige tips for begyndere.'));
  $ØFullFilt= htm_CheckFlt($type='checkbox',$name='fullfilt', $valu= $ØFullFilt,  
               $labl='@Filter hjælp:', $titl=tolk('@Hvis du afmærker dette felt, vil').
               $ØProgTitl.' '.tolk('@vise hjælpetekster til filter-funktionalitet.'));
  $ØTastkeys= htm_CheckFlt($type='checkbox',$name='tastkeys', $valu= $ØTastkeys,  
               $labl='@Vis tastatur genvejs bogstaver:', $titl=tolk('@Hvis du afmærker dette felt, vil').$ØProgTitl.
               ' '.tolk('@vise tastatur genvejs bogstaver på knapper.'));
  $ØRollTabl= htm_CheckFlt($type='checkbox',$name='usemaxview', $valu= $ØRollTabl,  
               $labl='@Vis ikke tabeller i vinduer:', $titl=tolk('@Hvis du afmærker dette felt, vil').$ØProgTitl.' '.
               tolk('@vise tabeller i fuld højde. Nyttigt hvis du udprinter data med browseren.'));
  htm_PanlBund($pmpt='@Gem',$subm=true);
  $_SESSION['Ønovice']=   $Ønovice;  
  $_SESSION['ØFullFilt']= $ØFullFilt; 
  $_SESSION['ØTastkeys']= $ØTastkeys;
  $_SESSION['ØRollTabl']= $ØRollTabl;
}
 
######### :SYSTEM:
# Kaldes fra:  [_system/page_Personlig.php] 
function Panl_Personlig()   ## out_PanlsSekd.php
{global $ØprogSprog;
  htm_FormLocal($name='sprogform');
  htm_Panl_Top($name= 'personl',$capt= '@Personlige valg:',$parms='#', $icon='fa-pen-square','panelW320',__FUNCTION__);
  
  htm_Caption('@Klassisk udseende:');
  htm_RadioGrp($type='hori',  $name='menu', 
              $labl='@Browser Menu', 
              $titl=tolk('@Hvis dette felt afmærkes vil browser-menuer skjules, og hele vinduet kan anvendes som arbejdsområde.').str_nl().
                    tolk('@Mange browsere skifter dette med F11-funktionstast.'), 
              $optlist= array(['menu','@Vis','','@Skjul']),
              $action='');
  htm_hr();  
  htm_Caption('@Anvend popup-vinduer:');  str_nl();  
  htm_CheckFlt($type='checkbox',$name='popup', $valu= 'popup',  
               $labl='@Benyt flere vinduer',  
               $titl='@Hvis du afmærker dette felt, vil SALDI arbejde i popup-vinduer, hvilket gør at man kan have flere vinduer åbne samtidig.',  
               $revi=true, $more='');
  
  htm_hr();  
  htm_Caption('@Popup-indstillinger:');
  htm_CombFelt($type='area', $name='inistr', $valu= 'statusbar=0, menubar=0, titlebar=0, toolbar=0, scrollbars=1, resizable=1, dependent=1',   
               $labl= '@Initieringsstreng', 
               $titl= tolk('@Denne streng benyttes af systemet (javascript), når der åbnes et nyt vindue. ').
               str_nl().tolk('@Her kan du indstille, hvordan vinduerne skal vises.'), 
               $revi=true, $rows='2',$width='244px');
  htm_nl();  htm_hr();  
  htm_Caption('@Udseende:');
  htm_RadioGrp($type='hori',  $name='bgtema', $labl='@Tema', $titl='@Du kan kun benytte en af mulighederne ad gangen.', 
      $optlist= array(['light', '@Lys','@eller','@Anvend lyse farver som baggrundsfarve.', $_SESSION["Øtema"]!='dark'],
                      ['dark',  '@Mørk',    '', '@Anvend mørke farver som baggrundsfarve.',$_SESSION["Øtema"]=='dark'])
              ,$action='');
  htm_Caption('@Baggrund i vinduer:');
  htm_RadioGrp($type='hori',  $name='bgtype', $labl='@Type', $titl='@Du kan kun benytte en af mulighederne ad gangen.', 
      $optlist= array(['farve',   '@Farve','@eller','@Anvend en ensartet kulør som baggrundsfarve i vinduer.'],
                      ['grafik',  '@Grafik',    '', '@Anvend grafik som baggrund i vinduer.','valgt'])
              ,$action='');
  htm_FrstFelt('35%');  htm_CombFelt($type='text', $name='farvekode', $valu= $farvekode='FF3311',   
                          $labl= '@Farvekode',  
                          $titl= '@Her skriver du hex-værdien for den ønskede RGB-baggrunds farve, eksempelvis FF9933 for orange. Se flere værdier på www.saldi.dk/dokumentation/farver ', 
                          $revi=true, $rows='2',$width='30px');
  htm_NextFelt('65%');  htm_CombFelt($type='text',  $name='bgimage', $valu= $bgimage='paper_fibers.png',   
                          $labl= '@Baggrundsbillede',  
                          $titl= '@Her skriver du filnavnet for det ønskede baggrunds billede. Filen SKAL være placeret i mappen: ..\\_assets\images\\', 
                          $revi=true, $rows='2',$width='30px');
  htm_LastFelt();
  echo 'Demo: ';
  $source= $_SESSION["Øtema"];   
#  echo 'GL værdi: '.$source; htm_nl();
  if ($source=='dark') {$source='light';} else {$source='dark';};
  setvKnap ($label='@Skift Tema (Klik 2x)',$title='@Ændring af tema for udseende', $source, $result, $akey='');
#  htm_nl();  echo 'NY værdi: '.$result;
  $_SESSION["Øtema"]= $result;
  
  SprogValg($ØprogSprog,$formName='sprogform');
  
  htm_Caption('Således viser din aktuelle browser sin datepicker:');
  echo '<p>DatoVælger: <input type="date" id="datepicker" placeholder="DatePicker:Klik i feltet"></p>';

  htm_hr();  
  htm_Caption('@Fremhævning af felter:');
  $bgcolor='#ffffff';
  $nuancefarver= [  //  [0:Tip, 1:value, 2:Label, 3:Action]
    ['Farve 1',  '+00-22-22','@Rød',      'style="background:'.Øfarvenuance($bgcolor, '+00-22-22').'"'],
    ['Farve 2',  '+00+00-33','@Gul',      'style="background:'.Øfarvenuance($bgcolor, '+00+00-33').'"'],
    ['Farve 3',  '-22+00-22','@Grøn',     'style="background:'.Øfarvenuance($bgcolor, '-22+00-22').'"'],
    ['Farve 4',  '-22-22+00','@Blå',      'style="background:'.Øfarvenuance($bgcolor, '-22-22+00').'"'],
    ['Farve 5',  '+00-33+00','@Magenta',  'style="background:'.Øfarvenuance($bgcolor, '+00-33+00').'"'],
    ['Farve 6',  '-33+00+00','@Cyan',     'style="background:'.Øfarvenuance($bgcolor, '-33+00+00').'"'],
  ];
  $antal_nuancer=count($nuancefarver);
  
  htm_OptioFlt($type='text',  $name='nuance',   $valu= $nuance, 
              $labl='@Farvenuance',  
              $titl='@Fremhæv eksempelvis ordrefelter, hvor der mangler levering eller modtagelse, med den angivne baggrunds-farvenuance.',  
              $revi=true, $optlist= $nuancefarver,
              $action='onchange="getComboA(this)"',
              $maxwd='',
              $onForm='',
              '','','',$nl=2);
  htm_PanlBund($pmpt='@Gem',$subm=true);
}
 
 
######### :SYSTEM:
# Kaldes fra:  [_system/page_Ordrerelat.php] 
function Panl_Ordrerelat()   ## out_PanlsSekd.php
{
  htm_Panl_Top($name= 'ordrerelat',$capt= '@Ordre relateret:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW640',__FUNCTION__);
  htm_Caption('@Ordre relaterede valg:'); htm_nl();  
  htm_CheckFlt($type='checkbox',$name='prismedm', $valu= $prismedm,  
               $labl='@Vis priser inkl. moms på salgsordrer',  
               $titl='@Når dette felt er afmærket, vises priser på salgsordrer, fakturaudskrifter osv. inkl. moms.',  
               $revi=true, $more='');
   htm_CheckFlt($type='checkbox',$name='medkomm', $valu= $medkomm,  
               $labl='@Medtag kommentarer på følgesedler',  
               $titl='@Hvis dette felt afmærkes, medtages kommentarlinjer fra tilbud/ordrer på følgesedler.',  
               $revi=true, $more='');
   htm_CheckFlt($type='checkbox',$name='kunmed', $valu= $kunmed,  
               $labl='@Medtag kun linjer med angivet antal på følgeseddel',  
               $titl='@Hvis dette felt afmærkes, medtages kun de varer, som er med i den pågældende leverering på følgesedlen.',  
               $revi=true, $more='');
   htm_CheckFlt($type='checkbox',$name='hurtfakt', $valu= $hurtfakt,  
               $labl='@Anvend hurtigfakturering (ingen tilbud & automatisk levering ved fakturering)',  
               $titl='@Hurtigfakturering anvendes, hvis man ikke har behov for at skrive tilbud/følgesedler, og hvor lagerttræk skal ske ved fakturering',  
               $revi=true, $more='');
   htm_CheckFlt($type='checkbox',$name='straksbogf', $valu= $straksbogf,  
               $labl='@Omgående bogføring af købs- og salgsordrer',  
               $titl='@Hvis dette felt ikke er afmærket, skal købs- og salgsfakturaer bogføres gennem kassekladden med [Hent ordrer]-funktionen.',  
               $revi=true, $more='');
   htm_CheckFlt($type='checkbox',$name='usefifo', $valu= $usefifo,  
               $labl='@Anvend FIFO på lagervarer', 
               $titl='@Hvis dette felt er afmærket styres lager efter FIFO (first in first out) princippet og kostprisen reguleres automatisk efter sidste varekøb.',  
               $revi=true, $more='');
  htm_OptioFlt($type='text',  $name='smtpcrypt',   $valu= $protokol, 
                    $labl='@Automatisk regulering af kostpriser',      
                    $titl='@Vælg om kostpriser skal reguleres til gennemsnitspris, genanskaffelsespris eller ikke skal reguleres, ved varekøb',  
                    $revi=true, $optlist= array(
                    ['','0',  '@Opdater ikke kostpris','valgt'],
                    ['','1',  '@Gennemsnitspris'],
                    ['','2',  '@Genanskaffelsespris'],
                    ),$action='onchange="getComboA(this)"');
   htm_CheckFlt($type='checkbox',$name='negativOK', $valu= $negativOK,  
               $labl='@Tillad negativ lagerbeholdning',  
               $titl='@Afmærk dette felt for at tillade negativ lagerbeholdning.',  
               $revi=true, $more='');
   htm_CheckFlt($type='checkbox',$name='samlrabat', $valu= $samlrabat,  
               $labl='@Anvend rabat på samlet pris',  
               $titl=tolk('@Afmærkes dette felt bliver det muligt at ændre prisen på bundlinjen i en salgsordre ').
                     tolk('@og der bliver givet en samlet rabat, som ved bogføring fordeles på de enkelte varer.'),  
               $revi=true, $more='');
   htm_CheckFlt($type='checkbox',$name='warnlow', $valu= $warnlow,  
               $labl='@Advar ved for lav lagerbeholdning',  
               $titl='@Afmærkes dette felt vil der komme en advarsel, hvis der indsættes varer, som ikke kan leveres, på en kundeordre.',  
               $revi=true, $more='');
   htm_CheckFlt($type='checkbox',$name='usepctfakt', $valu= $usepctfakt,      //  findtekst(681/682
               $labl='@Anvend procentfakturering',  
               $titl='@Afmærkes her, kommer et ekstra felt på salgsordrer til procentfakturering af vareværdien. Bruges f.eks ved udlejning af materiel.',  
               $revi=true, $more='');
   htm_CheckFlt($type='checkbox',$name='procenttillag', $valu= 'procenttillag',
               $labl='@Procenttillæg',  
               $titl= tolk('@Skrives en værdi her, vil der fremkomme et redigerbart felt på ordresiden med den angivne værdi. ').
                      tolk('@Procenttillægget er et tillæg til den samlede fakturasum før momsberegning. '),  
               $revi=true, $more='');
  htm_FrstFelt('50%');   
  htm_CombFelt($type='text',  $name='procentvare', $valu= $procentvare,
                          $labl= '@Procenttillæg',  
                          $titl= '@Angiv her hvilken konto i kontoplanen procenttillægget skal konteres på.', 
                          $revi=true, $rows='2',$width='30px');
  htm_NextFelt('50%');    echo '%';
  htm_LastFelt();   
  htm_FrstFelt('50%');   
  htm_CombFelt($type='text',  $name='pctvare', $valu= $pctvare,
                          $labl= '@Varenr. for procenttillæg',  
                          $titl= '@For at kunne give rabat på kontantsalg, skal dette felt udfyldes med varenummeret for den vare som bruges til formålet.', 
                          $revi=true, $rows='2',$width='30px');
  htm_NextFelt('50%');   
  htm_CombFelt($type='text',  $name='varerabat', $valu= $varerabat,
                          $labl= '@Varenr. for rabat',  
                          $titl= '@Sættes der et varenummer her, bliver det muligt at samle en gruppe varer i en salgsordre, som et sæt og give en samlet pris for denne gruppe.', 
                          $revi=true, $rows='2',$width='30px'); //  Kun redigerbar hvis:  $samlet_pris=true
  htm_LastFelt();   
  htm_FrstFelt('50%');   
  htm_CombFelt($type='text',  $name='box7', $valu= $kontantkonto,
                          $labl= '@Kontonummer for kontantsalg.',  
                          $titl= '@Angiv hvilken konto betalingen skal konteres på ved kontantsalg. Hvis feltet er tomt oprettes en åben post på beløbet på kundens konto.', 
                          $revi=true, $rows='2',$width='30px'); 
  htm_NextFelt('50%');   
  htm_CombFelt($type='text',  $name='box10', $valu= $kortkonto,
                          $labl= '@Kontonummer for salg på kreditkort.',  
                          $titl= '@Angiv hvilken konto betalingen skal konteres på ved salg på kreditkort. Hvis feltet er tomt oprettes en åben post på beløbet på kundens konto.', 
                          $revi=true, $rows='2',$width='30px');
  htm_LastFelt();   

  htm_PanlBund($pmpt='@Gem',$subm=true);
}
 
######### :SYSTEM:
# Kaldes fra:  [_system/page_Varerelat.php] 
function Panl_Varerelat()   ## out_PanlsSekd.php
{
  htm_Panl_Top($name= 'varerelat',$capt= '@Varerelateret:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
  htm_Caption('@Varerelateret:');
  htm_OptioFlt($type='text',  $name='Momskode',   $valu= $Momskode, 
              $labl='@Momskode',  
              $titl='@Momskode for salgspriser på varekort',  
              $revi=true, $optlist= [['','S1','S1:Salgsmoms 25%','','valgt'],[]],  //  [0:Tip, 1:value, 2:Label, 3:Action]
              $action='onchange="getComboA(this)"',
              '','','',$nl=2);
  
  htm_hr();  htm_Caption('@Varianter:');
  htm_CombFelt($type='text',  $name='variant', $valu= $Variant,   
                          $labl= '@Ny variant',  
                          $titl= '@', 
                          $revi=true, $rows='2',$width='30px');
  htm_PanlBund($pmpt='@Gem',$subm=true);
}
 
 
######### :SYSTEM:
# Kaldes fra:  [_system/page_Prislister.php] 
function Panl_Prislister()   ## out_PanlsSekd.php
{
  htm_Panl_Top($name= 'prislist',$capt= '@Prislister:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW960',__FUNCTION__);
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
      ['@Prislister: ','8%','text','','left','','','Externe']
      ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Prisliste.',         '6%','indx','', ['left'  ],  '@Prisliste','@Prisliste...'],
        ['@Leverandør',         '8%','text','', ['left'  ],  '@Leverandør','@Leverandør...'],
        ['@URL til prislisten','32%','text','', ['left'  ],  '@URL','@url...'],
        ['@Filtype',            '6%','text','', ['left'  ],  '@Filtype','@Filtype...'],
        ['@Rabat',              '8%','text','', ['left'  ],  '@Rabat','@Rabat...'],
        ['@Varegruppe',        '18%','text','', ['left'  ],  '@Varegruppe','@Varegruppe...'],
        ['@Lev.rabat',          '8%','text','', ['left'  ],  '@Lev.rabat','@Lev.rabat...'],
        ['@Aktiv',              '4%','text','', ['left'  ],  '@Aktiv','@Aktiv...'],
      ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ['@Slet',               '4%','knap','', ['center'],  '@Klik på rødt kryds for at slette denne post', '<ic class="far fa-times-circle" style="color:red; font-size:13px; "></ic>'],
      ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON, ]
    //$DATA,#=   array(),
    $TablData= [[1001,'Leverandør','URL','Filtype','Rabat','Varegruppe','Lev.rabat','Aktiv','Slet'],[1002,'Leverandør','URL','Filtype','Rabat','Varegruppe','Lev.rabat','Aktiv','Slet'],
                [1003,'Leverandør','URL','Filtype','Rabat','Varegruppe','Lev.rabat','Aktiv','Slet'],[1004,'Leverandør','URL','Filtype','Rabat','Varegruppe','Lev.rabat','Aktiv','Slet']], 
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '150px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_nl();  htm_Plaintxt('@Prislisterne er lister med priser, som hentes fra en extern ressource, eksempelvis en fil på en hjemmeside eller et ftp-sted.');
  htm_nl(2);
  htm_PanlBund($pmpt='@Gem',$subm=true);
}
 
######### :SYSTEM:
function Panl_Prislisten($xx) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'priser',$capt= '@Viser prisliste:',$parms='page_Blindgyden.php',$icon='far fa-save','panelW960',__FUNCTION__);
  htm_nl(6);
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Luk vinduet og gå retur til hovedmenu');
}
 
######### :SYSTEM:
# Kaldes fra: [_system/page_Backup.php] 
function Panl_Backup() {global $Øsaldihost;  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'backup',$capt= '@Sikkerhedskopiér regnskab:',$parms='../_base/page_Hovedmenu.php',$icon='far fa-save','panelW640',__FUNCTION__);
  htm_Caption('@Backup / Restore af dit regnskab:');
  htm_CentrOn(); 
    textKnap($label='@Gem SQL sikkerhedskopi',    $title='@Klik her for at gemme dit regnskab et sikkert sted.',    $link='../_base/page_Blindgyden.php');  //  DB_backup();
    textKnap($label='@Indlæs SQL sikkerhedskopi', $title='@Klik her for indlæse en tidligere gemt sikkerhedskopi',  $link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_Rammestart($Caption='@Om data backup:');
  echo tolk('@Her kan du tage backup af det aktuelle regnskab. Har du flere regnskaber, skal der tages backup af hvert enkelt, hvilket kræver selvstændigt login.'); htm_nl(2);
  echo tolk('@Backuppen omfatter indholdet i database-tabeller med regnskabsindhold.'); htm_nl();
  echo tolk('@Backup af filer (billeder, bilag, formularer, ændrede supportfiler, ...), kan udføres med et fil kopierings program,');
  echo tolk('@f.eks. via en FTP-forbindelse. Nogle af filerne, kan du dog selv hente, ved at benytte export-mulighederne i programmet.');   htm_nl(2);
  echo tolk('@En komplet backup, skal omfatte den totale database, og samtlige filer i systemets mapper.').' ';
  echo tolk('@Fil-backup kan du udføre med funktionen ´Installations backup´ i panelet nedenfor.');  htm_nl(2);
  echo tolk('@Benytter du').' '.'<data-colrlabl>'.$Øsaldihost.'</data-colrlabl>, '.tolk('@er det med i den service, du betaler for.');  htm_nl(2);
  htm_Rammeslut();
  htm_Caption('@Backup af supportfiler:');
  htm_CentrOn(); 
    textKnap($label='@Gem datafiler (billeder)',      $title='@Planlagt mulighed, for at gemme filer med brugerdata.',  $link='../_base/page_Blindgyden.php');
    textKnap($label='@Gem regnskabsbilag (pdf)',      $title='@Planlagt mulighed, for at gemme filer med brugerdata.',  $link='../_base/page_Blindgyden.php');
    textKnap($label='@Gem designfiler (formularer)',  $title='@Planlagt mulighed, for at gemme filer med brugerdata.',  $link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Luk vinduet og gå retur til hovedmenu');
}

######### :SYSTEM:
function DB_backup() {
global $sqhost, $squser, $sqpass, $Øsqdb;

  $db= 'DB-navn';  $dbver= 'DB-version';  $regnskab= 'Regnskab';  $db_encode= 'db-Encode';  $db_type= 'mysql';    //  Dummy-data
  
  $wrkPath=   '../_exchange/tmp/';
  $timestamp= date("Ymd-Hi");
  $fnam= trim($Øsqdb."_".$timestamp);
  $dump_filnavn=$wrkPath.trim($Øsqdb.".sql");
  $info_filnavn=$wrkPath."DB-backup.info";
  $tar_filnavn= $wrkPath.$fnam.".tar";
  $gz_filnavn=  $wrkPath.$fnam.".tar.gz";
  $dat_filnavn= $wrkPath.$fnam.".sdat";

  //  $r=db_fetch_array(db_select("select box1 from grupper where art = 'VE'",__FILE__ . " linje " . __LINE__));
  //  $dbver=$r['box1'];
  $fp=fopen($info_filnavn,"w");
    if ($fp) {
      fwrite($fp,$timestamp.chr(9).$Øsqdb.chr(9).$dbver.chr(9).$regnskab.chr(9).$db_encode.chr(9).$db_type);
    } 
  fclose($fp);
  
  //  $Øexec_path="/usr/bin/";
  if ($db_type=='mysql') $dumpcmd= $Øexec_path.'mysqldump -h '.$sqhost.' -u '.$squser.' --password='.$sqpass.' -n '.$Øsqdb.' --result-file='.$dump_filnavn;
  else                   $dumpcmd= 'export PGPASSWORD='.$sqpass.'\n'.$Øexec_path.'pg_dump -h '.$sqhost.' -U '.$squser.' -f '.$dump_filnavn.' '.$Øsqdb;

  echo "<!-- Saldi-kommentar for at skjule uddata fra pg_dump til siden \n"; # Kommentar start
  system($dumpcmd);
  system("tar -cf $tar_filnavn $dump_filnavn $info_filnavn");
  system("gzip $tar_filnavn");
  system("mv $gz_filnavn $dat_filnavn");
  echo "--> \n"; # Kommentar slut
}

######### :SYSTEM:
# Kaldes fra: [_system/page_Backup.php??] 
function Panl_Zipbackup() {global $Øsaldihost;  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'zip',$capt= '@Installations backup:',$parms='#',$icon='far fa-save','panelW640',__FUNCTION__);
  $subdirs= 8;
  htm_nl();
  htm_Rammestart($Caption='@Om program backup:');
  echo tolk('@Her kan du tage backup af det installerede program, og de aktuelle support-filer.');   htm_nl(2);
  echo tolk('@Backuppen omfatter filer, som befinder sig i programmets system-mapper på web-serveren, og i indtil').' '.$subdirs.' '.
       tolk('@mappe-niveauer under program-mappen.');   htm_nl();
  echo tolk('@Bemærk: Der tages ikke backup, af connect-data til databasen,').'<br>';
  echo tolk('@hvis de er placeret i mappen ---Private !');   htm_nl(2);
  echo tolk('@Filer gemmes komprimeret i en ZIP-fil, som ikke umiddelbart kan benyttes til gendannelse.').' ';
  echo tolk('@Når zip-filen er dannet, kan du downloade den, og gemme den lokalt, sammen med dine data-base (SQL) backupper.');   htm_nl(2);
  echo tolk('@Skal filerne benyttes, kræver det p.t. manuel gendannelse.');   htm_nl(2);
  echo tolk('@Har du flere regnskaber, er det tilstrækkeligt med en fælles installations backup.');   htm_nl(2);
  echo tolk('@Indholdet i databasen (regnskabs-data) er ikke med i denne backup.').' ';
  echo tolk('@Det kan du selv udføre med funktionen i panelet ovenfor.');   htm_nl(2);
  echo tolk('@Benytter du').' '.'<data-colrlabl>'.$Øsaldihost.'</data-colrlabl>, '.tolk('@er det med i den service, du betaler for.');  htm_nl(2);
  htm_Rammeslut();
  
  run_Script('function showWait() {document.getElementById("waitinfo").style.display = "block";}');
  echo '<div id="waitinfo" style="display:none;">'.str_nl().tolk('@ZIP-backup starter. Vent...');
  echo '<div class="loader" id="wait" ></div>';
  echo '<br>'.tolk('@Backup af system-mapper og undermapper i').' '.$subdirs.' '.tolk('@niveauer. Det tager tid...').'<br>';
  echo '</div>';
   if ($GLOBALS["Øjob"]=='zip') 
  { program_backup($subdirs);
  } else {
    htm_Caption('@Backup af programmet:');
    htm_CentrOn(); 
      textKnap($label='@ZIP fil-arkivering',  
        $title='@Her gemmer du programmet, og dine supplerende filer.<br>Bemærk! det tager lidt tid...',  $link='?job=zip',$akey='',$more='" onclick="showWait()" ');
      htm_Caption(' Hav tålmodighed...');
    htm_CentOff();
  }
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Luk vinduet og gå retur til hovedmenu');
}

######### :SYSTEM:
function program_backup($subdirs= 3) {
  $zip = new ZipArchive();  //  ZIP skal være aktiveret i PHP-installationen!
  $filename = './../_exchange/tmp/program_backup.zip';
  if (file_exists($filename)) {unlink($filename);}  //  Slettes så evt. gammel version ikke medtages i zip
  if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) { exit(tolk('@Kan ikke oprette <'.$filename.'>')); }
  
## Info-fil;
  $zip->addFromString('readme.txt', 
    tolk('@Denne ZIP-fil indeholder de fleste filer fra SALDI-e installationen.').chr(10).chr(13).
    tolk('@Den indeholder ikke tilkoblings-data til databasen, hvis disse befinder sig i filen: \\saldi-e\---Private\serverFacts.inf').chr(10).chr(13).
    tolk('@Kun systemmapper med prefix: _ tages i betragtning, f.eks. \_system\*  - Mappe-dybden er begrænset til:').' '.$subdirs.chr(10).chr(13).
    tolk('@Glemmer du at downloade zip-filen, kan du altid finde den seneste udgave her: \\saldi-e\_exchange\tmp\program_backup.zip').chr(10).chr(13)
    );
  
## Data-filer:
  $ix= '00';  $thisdir= './../';
  //  ob_implicit_flush(1);
  //  ob_start();
  //  for ($i= 0; $i < 1024*64; $i++) echo ' ';
  //  ob_end_clean();
  //  echo '<br>'.tolk('@ZIP-backup starter. Vent...').'<br>';
  //  echo '<div class="loader" id="wait"></div>';
  //for ($i= 0; $i < 8; $i++) {flush();  ob_flush();} ob_end_flush();   //  Virker tilsyneladende ikke
  $files= getFileList('./../', true, $subdirs);   //  var_dump($files);
   foreach ($files as $fil) {
    $filref= $fil['path'].$fil['name'];    //  echo '<br>'.$filref;
    if (substr($fil['path'],strlen($thisdir),1)=='_')   //  Kun system-mapper
      if (!is_dir( $filref ))
        if ($zip->addFile($filref,$filref.'__bak#'.$ix))  {   }   //  echo ' .'; 
        else {echo '<br>'.tolk('@MISLYKKET: ').$filref;}
  } echo '<br>';
  
## Resultat:
  $GLOBALS["Øjob"]= 'done';
  //echo '<br>Færdig. Dette skulle vises, inden der gås igang med zipning!';
  echo '<br>'.tolk('@Færdig. Antal filer: '). $zip->numFiles. ' i zip-filen.<br>'; // echo tolk('@Status: '). $zip->status. '<br>';
  $zip->close();
  htm_CentrOn(); 
    textKnap($label='@Download ZIP fil',$title='@Her henter du den nydannede ZIP-backup',  $link='http://1331.dscloud.me/saldi-e/_exchange/tmp/program_backup.zip');
  htm_CentOff();
}

 
######### :SYSTEM:
# Kaldes fra:  [_system/page_Bilagsinfo.php] 
function Panl_Bilagsinfo($ftpservaddr= 'bilag_999@ssl2.saldi.dk.') {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'backup',$capt= '@Bilagshåndtering:',$parms='page_Blindgyden.php',$icon='far fa-save','panelW640',__FUNCTION__);
  htm_Caption('@Regnskabs bilag:');
  htm_Rammestart($Caption='@Om Bilagshåndtering:');
    echo tolk('@Her er de informationer, som er nødvendige for at kunne håndtere scannede bilag.').'<br>';
    echo tolk('@Du kan vælge at lade SALDI.dk opbevare dine scannede bilag for kr. 30,- pr. måned pr. GB. Enhedsprisen følger dags-prisen for 1 ekstra bruger.').'<br>';
    echo tolk('@Denne løsning giver mulighed for at sende indscannede bilag pr. e-mail til serveren, og efterfølgende importere dem i kassekladden.').'<br>';
    echo tolk('@Bilag sendes til:').' '.$ftpservaddr.'<br>'.'<br>';
    echo tolk('@Du kan også vælge selv at sætte en ftp-server op til formålet eller benytte en eksisterende. Det koster ikke noget, når du gør det selv.').'<br>';
  htm_Rammeslut();
  htm_nl();
  htm_Caption('@Vælg her:');
  htm_OptioFlt($type='text', $name='opbevar', $valu= $opbevar, $labl='@Opbevaring af bilag', $titl='@Her kan du vælge mellem opbevarinsmulighederne.', $revi=true, $optlist= 
      [['@Hvis du vil anvende bilagsscanning og ikke selv vil etablere server til bilagsopbevaring. Samme omkostning som en ekstra bruger pr. GB.','intern','@Intern bilagsopbevaring (mod betaling).'], 
       ['@Hvis du vil benytte FTP-server, som du selv sætter op','egenserv','@Egen FTP-server']
      ], $action='',
      '','','',$nl=2);
  htm_CheckFlt($type='checkbox',$name='googdocs', $valu= $googdocs,  $labl='@Benyt Google Docs on-line',  $titl='@Er du bruger af Googles online-systemer... !)',  $revi=true, $more=' '.$pg);
  
  htm_hr();
  htm_RadioGrp($type='vert',  $name='bevar',  $labl='@Ved FTP-opbevaring:', $titl='@Her kan du angive de nødvendige indstillinger', 
               $optlist= array(['extern','@FTP på egen server','@eller',true],['intern','@FTP intern (mod betaling)','']),$action='');
  htm_Caption('Udfyldes ved egen FTP-server:');
  htm_FrstFelt('40%');  htm_CombFelt($type='text',  $name='ftpsted', $valu= $ftpsted, $labl= '@FTP-URL',      $titl= '@Navn eller IP-nummer på ftp-server', $revi=true, $rows='1',$width='130px');
  htm_NextFelt('30%');  htm_CombFelt($type='text',  $name='ftpuser', $valu= $ftpuser, $labl= '@FTP-bruger',   $titl= '@Brugernavn på ftpserver',            $revi=true, $rows='1',$width='130px');
  htm_NextFelt('30%');  htm_CombFelt($type='text',  $name='ftpkode', $valu= $ftpkode, $labl= '@FTP-password', $titl= '@Adgangskode til ftpserver',          $revi=true, $rows='1',$width='130px');  
  htm_LastFelt(); 
  htm_FrstFelt('50%');  htm_CombFelt($type='text',  $name='ftp_bilag_mappe',    $valu= $ftp_bilag_mappe,    $labl= '@Bilags-Mappe',   $titl= '@Mappe til bilag på ftpserver',      $revi=true, $rows='1',$width='230px');  
  htm_NextFelt('50%');  htm_CombFelt($type='text',  $name='ftp_dokument_mappe', $valu= $ftp_dokument_mappe, $labl= '@Dokument-Mappe', $titl= '@Mappe til dokumenter på ftpserver', $revi=true, $rows='1',$width='230px');
  htm_LastFelt();  
  
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='');
}
 
######### :SYSTEM:
# Kaldes fra:  [_system/page_Diversevalg.php] 
function Panl_Diversevalg() {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'diversevalg',$capt= '@Diverse:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW480',__FUNCTION__);
  htm_Caption('@Diverse valg:');
  htm_nl();
  htm_CheckFlt($type='checkbox',$name='tvangsdeb', $valu= $tvangsdeb,  $labl='@Tvungen valg af debitorgruppe på debitorkort',   
          $titl='@Hvis dette felt afmærkes, tvinges brugeren til aktivt at vælge debitorgruppe ved oprettelse af debitorer.',  $revi=true, $more=' '.$pg);
  htm_CheckFlt($type='checkbox',$name='tvangsansv', $valu= $tvangsansv,  $labl='@Tvungen valg af kundeansvarlig på debitorkort',  
          $titl='@Hvis dette felt afmærkes, tvinges brugeren til aktivt at vælge kundeansvarlig ved oprettelse af debitorer',  $revi=true, $more=' '.$pg);
  htm_CheckFlt($type='checkbox',$name='ekstraans', $valu= $ekstraans,  $labl='@Tilføj ekstra felter på ansatte',                
          $titl='@Ved at afmærke her får du op til 14 ekstra felter på ansattes stamkort, for egne ansatte',  $revi=true, $more=' '.$pg);
  htm_hr();
  htm_CheckFlt($type='checkbox',$name='betllist', $valu= $betllist,  $labl='@Brug betalingslister',                           
          $titl='@Benyt betalingslister',  $revi=true, $more=' '.$pg);
  // htm_CheckFlt($type='checkbox',$name='intgbizz', $valu= $intgbizz,  $labl='@Integration med DocuBizz',                       
          // $titl='@Benyt import fra DocuBizz - Det intelligente fakturasystem',  $revi=true, $more=' '.$pg);
  htm_CheckFlt($type='checkbox',$name='brugjobk', $valu= $brugjobk,  $labl='@Brug jobkort',                                   
          $titl='@Jobkort findes i debitorkonti. Her kan du definere opgavebeskrivelser til medarbejdere osv.',  $revi=true, $more=' '.$pg);
  //  htm_hr();
  htm_CheckFlt($type='checkbox',$name='brughtml', $valu= $brughtml,  $labl='@Brug HTML/CSS til formulargenerering',           
          $titl='@Afmærkes feltet anvendes HTML/CSS til formulargenerering',  $revi=true, $more=' '.$pg);
  htm_CheckFlt($type='checkbox',$name='tilldato', $valu= $tilldato,  $labl='@Tillad forskellige datoer på samme bilagsnummer i kassekladde.',  
          $titl=tolk('@Afmærk her for at undtrykke advarsel i kassekladden, hvis der anvendes samme bilagsnummer til flere bilag med forskellige datoer.').
      tolk('@(F.eks, hvis et kontoudtog fra bank bogføres som ét bilag).'),  $revi=true, $more=' '.$pg);
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='');
}
 
######### :SYSTEM:
# Kaldes fra:  [_system/page_Rykkerrel.php] 
function Panl_Rykkerrel() {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'diversevalg',$capt= '@Rykkerrelateret:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
  htm_Caption('@Rykker ansvarlig:');
  htm_nl();
  htm_OptioFlt($type='text', $name='opbevar', $valu= $opbevar, $labl='Brugernavn', 
          $titl='@Brugernavn for ´rykkeransvarlig´ - Når brugeren logger ind, adviseres denne, hvis der skal rykkes - Hvis navn ikke angives adviseres alle.', $revi=true, $optlist= 
          [['@Alle','alle','@--Alle--'], 
           ['@Admin','admin','@Admin']
          ], $action='',
          '','','',$nl=1);
  htm_CombFelt($type='text',  $name='ansvmail', $valu= $ansvmail,   
                          $labl= '@Mailadresse',  
                          $titl= '@Mailadresse for ´rykkeransvarlig´. Hvis angivet sendes email fra denne adresse, når der skal rykkes. (Når nogen logger ind - uanset hvem)', 
                          $revi=true, $rows='2',$width='30px', $step='', $more='',$plho=tolk('@Mail addr...') );
  htm_CombFelt($type='text',  $name='rykk1', $valu= $rykk1,   
                          $labl= '@Frist for rykker 1.',  
                          $titl= '@Antal dage fra forfald til 1. rykker', 
                          $revi=true, $rows='2',$width='30px', $step='', $more='',$plho=tolk('@Antal dage...') );
  htm_CombFelt($type='text',  $name='rykk2', $valu= $rykk2,   
                          $labl= '@Frist for rykker 2.',  
                          $titl= '@Antal dage fra forfald til 2. rykker', 
                          $revi=true, $rows='2',$width='30px', $step='', $more='',$plho=tolk('@Antal dage...') );
  htm_CombFelt($type='text',  $name='rykk3', $valu= $rykk3,   
                          $labl= '@Frist for rykker 3.',  
                          $titl= '@Antal dage fra forfald til 3. rykker', 
                          $revi=true, $rows='2',$width='30px', $step='', $more='',$plho=tolk('@Antal dage...') );
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='');
}
 
######### :SYSTEM:
# Kaldes fra:  [_system/page_Tjeklister.php] 
function Panl_Tjeklister() {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'tjeklist',$capt= '@Tjeklister:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
  htm_Caption('@Tjeklister:');
  htm_nl();
  htm_CombFelt($type='text',  $name='nytjek', $valu= $nytjek,   
                          $labl= '@Ny tjekliste',  
                          $titl= '@Navn på ny tjekliste', 
                          $revi=true, $rows='2',$width='30px', $step='', $more='',$plho=tolk('@Liste...'));
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='Gem');
}
 
 
######### :SYSTEM:
# Kaldes fra:  [_system/page_Differencer.php] 
function Panl_Differencer() {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'tjeklist',$capt= '@Differencer:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
  htm_Caption('@Tolerance for øre-afrunding:');
  htm_nl();
  htm_CombFelt($type='tal2d',  $name='orediff', $valu= $orediff,   
                          $labl= '@Maksimalt beløb for øredifferencer (i kroner)',  
                          $titl= '@Skriv det maksimale beløb for øredifferencer angivet i kroner, som må udlignes i åbne poster', 
                          $revi=true, $rows='2',$width='30px', $step='', $more='',$plho=tolk('@Kr...') );
  htm_CombFelt($type='text',  $name='orediff', $valu= $orediff,   
                          $labl= '@Kontonummer for øredifferencer',  
                          $titl= '@Skriv det kontonummer i kontoplanen som skal bruges til øredifferencer', 
                          $revi=true, $rows='2',$width='30px', $step='', $more='',$plho=tolk('@Konto...') );
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='');
}
 
######### :SYSTEM:
# Kaldes fra:  [_system/page_Massefakt.php] 
function Panl_Massefakt() {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'diversevalg',$capt= '@Massefakturering:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
  htm_Caption('@Massefakturering:');
  htm_nl();
  htm_CheckFlt($type='checkbox',$name='aktvmass', $valu= $aktvmass,  $labl='@Aktiver massefakturering', 
          $titl='@Hvis du aktiverer massefakturering, har du mulighed for at fakturere alle godkendte salgsordrer i en arbejdsgang.',  
  $revi=true, $more=' '.$pg);
  htm_CheckFlt($type='checkbox',$name='aktvmass', $valu= $aktvmass,  $labl='@Medtag delleverancer',     
          $titl='@Hvis du afmærker dette felt, vil ordrer, hvor ikke alt er på lager, blive delleveret/-faktureret.',  
  $revi=true, $more=' '.$pg);
  htm_CombFelt($type='text',  $name='gammel', $valu= $gammel,   
                          $labl= '@Frist for dellevering (dage)',  
                          $titl= '@Her angiver du, hvor mange dage gammel en ordre skal være, før der foretages en dellevering/-fakturering.', 
                          $revi=true, $rows='2',$width='30px', $step='', $more='',$plho=tolk('@Antal dage...') );
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='');
}
 
######### :SYSTEM:
# Kaldes fra:  [_system/page_Formtekst.php] 
function Panl_Formtekst($filDATA) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'diversevalg',$capt= '@Formular tekster:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW640',__FUNCTION__,$more=' style= "height:750px" ');
  htm_Caption('@Tekster på formularer:');
  htm_nl();
  htm_Rammestart($Caption='@Om teksterne:');
    htm_Plaintxt('@Teksterne benyttes ikke i programfladen, men til udskrivning af blanketter.').'<br>';
    htm_Plaintxt('@Du kan formattere teksterne med html-koder').'<br>';
    htm_Plaintxt('@Systemet er ikke anvendt endnu, men blot for at demonstre redigering.').'<br>';
  htm_Rammeslut();
  $DATA= array();  foreach ($filDATA as $rec) array_push($DATA, [$rec[0],$rec[1],[$rec[1],['x']]]);
  # var_dump($data);
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Tabel:',                 '18%','show','','left', ' ', '@Dansk sprog']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Id',                      '5%','show','',['center'],'@Tekstens id','@Auto...'],
          ['@Vist tekst',             '20%','show','',['left'  ],'@Nuværende vist HTML-tekst','@Tekst...'],
          ['@Tekst med format koder', '75%','area','',['left'  ],'@Korrigerbar HTML-tekst','@Tekst...'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON, ]
    $DATA,#=   array(),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter   //  Virker ikke med hidd-felter!
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '400px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_CentrOn(); 
  htm_nl();
    textKnap($label= '@Exporter til csv-fil',    $title= '@Klik her for gemme alle tekster i en fil, som kan indlæses i regneark',  $link= '../_base/page_Blindgyden.php'); // SprogExport($ØlanguageTable)
    textKnap($label= '@Importer fra csv-fil',    $title= '@Klik her for indlæse alle tekster fra en fil som du udpeger',            $link= '../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='');
}
 
######### :SYSTEM:
# Kaldes fra:  [_system/page_Imogexport.php] 
function Panl_Imogexport() {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'imexport',$capt= '@Data export/import:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW480',__FUNCTION__);
  htm_Caption('@Overførsel af data til/fra filer:');
  htm_Rammestart($Caption='@Export - Import:');
    htm_FrstFelt('40%');      htm_Caption('@Kontoplan:');
    htm_NextFelt('60%');
      textKnap($label='@Eksportér', $title='@Eksportér kontoplan',  $link='../_base/page_Blindgyden.php');
      textKnap($label='@Importér',  $title='@Importér kontoplan',   $link='../_base/page_Blindgyden.php');
      textKnap($label='@NOTE!',     $title=tolk('@Eksportér: Den aktive kontoplan!').'<br>'.
                tolk('Importér kontoplan - erstatter kontoplanen for nyeste regnskabsår! (det aktive overskrives)'),  $link='');
    htm_LastFelt();
    htm_FrstFelt('40%');      htm_Caption('@Formularer:');
    htm_NextFelt('60%');
      textKnap($label='@Eksportér', $title='@Eksportér Formularer',  $link='../_base/page_Blindgyden.php');
      textKnap($label='@Importér',  $title='@Importér Formularer',   $link='../_base/page_Blindgyden.php');
    htm_LastFelt();
    htm_FrstFelt('40%');      htm_Caption('@Debitorer/Kreditorer:');
    htm_NextFelt('60%');
      textKnap($label='@Eksportér', $title='@Eksportér Debitorer/Kreditorer',  $link='../_base/page_Blindgyden.php');
      textKnap($label='@Importér',  $title='@Importér Debitorer/Kreditorer',   $link='../_base/page_Blindgyden.php');
    htm_LastFelt();
    htm_FrstFelt('40%');      htm_Caption('@Varer:');
    htm_NextFelt('60%');
      textKnap($label='@Eksportér', $title='@Eksportér Varer',  $link='../_base/page_Blindgyden.php');
      textKnap($label='@Importér',  $title='@Importér Varer',   $link='../_base/page_Blindgyden.php');
    htm_LastFelt();
    htm_FrstFelt('40%');  
    htm_Caption('@Variantvarer:');
    htm_NextFelt('60%');
      textKnap($label='@Eksportér', $title='@Eksportér Variantvarer',  $link='../_base/page_Blindgyden.php');
      textKnap($label='@Importér',  $title='@Importér Variantvarer',   $link='../_base/page_Blindgyden.php');
    htm_LastFelt();
  htm_Rammeslut();
  htm_hr();
  htm_Rammestart($Caption='@Tilpasset dataudtræk:');
    echo tolk('@Du kan se eksempler på: ').' <a href="http://www.ev-soft.dk/saldi-wiki/doku.php?id=saldi:tips-tricks" target="_blank"  title="'.tolk('@Vis i nyt vindue').'">SALDI-DokuWiki</a>';
    htm_CombFelt($type='area',  $name='sql', $valu= $sql,   
                          $labl= '@SQL Dataudtræk:',  
                          $titl= '@Her angiver du, en SQL-forespørgsel, der SELECT-er dataudtræk.', 
                          $revi=true, $rows='2',$width='30px', $step='', $more='',$plho=tolk('@SELECT SQL...') );
  htm_Rammeslut();
  htm_PanlBund($pmpt='@Send',$subm=true,$title='Send SQL-forespørgslen til serveren, og modtag data, som du kan gemme.');
}
 
 
######### :SYSTEM:
# Kaldes fra:  [_system/page_Labels.php] 
function Panl_Labels($lbltype,$demo) {global $VareVars;  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'labels',$capt= '@Label print:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW640',__FUNCTION__,$more=' style= "height:590px" ');
  htm_Rammestart($Caption='@Beskrivelse af systemet:');
    echo tolk('@Her redigerer du en HTML-tekst, som definerer, hvorledes labels udskrives.').' '.str_nl().
         tolk('@Teksten kan indeholde variabel-navne, som udskiftes med aktuelle værdier, når der printes').str_nl().
         tolk('@Hvilke variabler du kan benytte, kan du slå op herunder.');
    echo tolk(' ');
  htm_Rammeslut();
  htm_FrstFelt('22%'); {
    htm_Caption('@Vælg labeltype:');
    htm_OptioFlt($type='text', $name='lbltype', $valu= $lbltype, $labl='Type', $titl='@Vælg den label-type, du vil redigere.',  
                      $revi=true, $optlist=[['@Vare label','vare','@Vare'], ['@Adresse label','addr','@Adresse']], $action='','','','',$nl=2);
    };
  htm_NextFelt('28%'); {
  htm_Caption('@Brugbare variabler:');
    htm_OptioFlt($type='text', $name='variabel', $valu= $lbltype, $labl='Varer', $titl='@Her kan du se de variabler du kan vælge imellem.',  
                      $revi=true, $optlist= $VareVars, $action='','','','',$nl=2);
    };
  htm_NextFelt('50%'); {
  htm_Caption('.');
    htm_OptioFlt($type='text', $name='variabel', $valu= $lbltype, $labl='Adresser', $titl='@Her kan du se de variabler du kan vælge imellem.',  
                      $revi=true, $optlist= FormVars(4), $action='','','','',$nl=2);
    };
  htm_LastFelt(); 
  //  htm_nl(1);
  htm_CombFelt($type='area',   $name='labl', $valu= $demo,  
               $labl='@Label HTML-kode',  
               $titl=tolk('@Her indsættes html kode til formatering af labelprint i varekort. Du kan finde eksempler på ').
                     'Saldi forum: href=http://forum.saldi.dk/viewtopic.php?f=17&t=1159  '.tolk('@under tips og tricks. ').
                     tolk('@Hvis der benyttes API til webshop skrives URL til shoppens funktionsmappe her.'), 
               $revi=true, $rows='10', $width='', $step='', $more='height:200px;',$plho=tolk('@Udfyld med HTML...') );
  echo '<div style="height:50px"></div>';  //  Dummy for at styre højdeplacering!
  htm_nl(4);  echo tolk('@Sådan ser det ud:');
	htm_nl(1);  echo '<div>'.$demo.'</div>';
  htm_PanlBund($pmpt='@Gem',$subm=true);
}
 
######### :SYSTEM:
# Kaldes fra:  [_base/page_Startup.php] 
function Panl_FormularTabel(&$DATA) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'forms',$capt= '@Tabel med samtlige formularers indstillinger:',$parms='#',$icon='fas fa-pen-square','panelW120',__FUNCTION__,$more='');
  htm_FrstFelt('16%');
    htm_Caption('Her ser du kodeforklaringer:');
  htm_NextFelt('23%'); 
    htm_OptioFlt($type='text',  $name='formnr',    $valu= '4', 
                    $labl='@Formular Nr.',      $titl='@Se hvæilke numre, som er tilknyttet formularer',  
                    $revi=true, $optlist= FRM_Liste(),    $action='');
  htm_NextFelt('18%'); 
    htm_OptioFlt($type='text',  $name='blanket',   $valu= '2', 
                    $labl='@Objekt Art',        $titl='@Arten af objekter på formular',  
                    $revi=true, $optlist= FartListe(),    $action='');
  htm_NextFelt('24%');
    htm_OptioFlt($type='text',  $name='sidetype',   $valu= 'A',
                    $labl='@Udskrifts Side',    $titl='@Se koder for udskrifts-side.',  
                    $revi=true, $optlist= SideListe(),             //  $optlist= [['Første sides layout','F','Første'],['Alle sider','A','Alle'],['Sidste sides layout','S','Sidste']],   
                    $action='');
  htm_NextFelt('18%'); 
    htm_OptioFlt($type='text',  $name='formformat',   $valu= 'A4p', 
                    $labl='@Papir format',      $titl='@Se tilgænige papirstørrelser', 
                    $revi=true, $optlist= PaprListe(),  $action='');
  htm_LastFelt('');  
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),  // if (($ModifyRec) or ($RowBody[0][2]!='indx')) er 2% benyttet til => knap
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Nr.',           '3%','', 'show',['center'], '@Formular nr','kode...'],
          ['@Art',           '3%','', 'show',['center'], '@Koden for feltes art','art...'],
          ['@Side',          '3%','', 'show',['center'], '@Udskrift på side kode: A !1 1 S !S','side...'],
          ['@Beskrivelse',  '10%','', 'show',['left'  ], '@Feltets tekstindhold samt $variabler',  'besk...'],
          ['@Just',          '3%','', 'show',['center'], '@Justering af teksten (L/V, C, R/H)','just...'],
          ['@X0',            '4%','', 'show',['right' ], '@Indsætnings X-koordinat (mm fra formularens venstre kant)','X0...',''],
          ['@Y0',            '4%','', 'show',['right' ], '@Indsætnings Y-koordinat (mm fra formularens top kant)','Y0...'],
          ['@Brd.',          '4%','', 'show',['right' ], '@Felt bredde (mm)','F-b...'],
          ['@Høj.',          '4%','', 'show',['right' ], '@Felt højde (mm)','F-h...'],
          ['@Dim.',          '4%','', 'show',['right' ], '@Objektets dimension: Streg-bredde, Tegn-højde, målt i px','Obj-D...'],
          ['@Farve',         '7%','', 'show',['center'], '@Objektets farve, angives som HTML5 tillader. (red, #FF44DD, rgb)','farve...'],
          ['@Txt-font',      '7%','', 'show',['left'  ], '@Objektets font (argument til: font-family)','font...'],
          ['@Txt-style',     '9%','', 'show',['left'  ], '@Objektets style  (argument til: font-weight, font-style)','style...'],
          ['@Grafik',        '8%','', 'show',['left'  ], '@Link til grafikfil','graf...'],
          ['@Fremmedsprog', '10%','', 'show',['left'  ], '@Alternativ beskrivelse, f.eks. på engelsk','alt...'],
          ['@Note',         '10%','', 'show',['left'  ], '@Note til objektet','not...']
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON, ]
    $DATA,#=   array(),
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter   //  Virker ikke med hidd-felter!
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at vælge og ændre data i en row
    $ViewHeight= '500px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__,
    $Kriterie= ['','']    # Test [DataKolonneNr, > grænseværdi] Undlad spec. feltColor
  );
 
/* 
Fremtidig Filstruktur:  
version 3.x               version 5.+
$rec[0]; '$formular'    | $rec[0]; - Formular kode [0..13..]
$rec[1]; '$art'         | $rec[1]; - Formular art kode[0..3]: 0= Layout   1= Grafik     2= Blanket-tekster    3=  Tekster - Ordrelinier
              $rec[13]  | $rec[2]; - Side-kode: A !A S !S G [:string] (G:generelt)
$rec[2]; '$beskrivelse' | $rec[3]; - "Beskrivelse" - Tekstindhold i feltet  [:string]
$rec[3]; '$just'        | $rec[4]; - Justering af/i feltet: V=venste, C=centreret, H=højre [:string]
$rec[4]; '$xa'   (abs)  | $rec[5]; - X0= Feltets indsætningskoordinat   (abs)  [:mm] målt fra venstre side-kant
$rec[5]; '$ya'   (abs)  | $rec[6]; - Y0= Feltets indsætningskoordinat   (abs)  [:mm] målt fra side-top
$rec[6]; '$xb'   (abs)  | $rec[7]; - Feltets bredde (linie længde)      (rel)  [:mm] 
$rec[7]; '$yb'   (abs)  | $rec[8]; - Feltets højde  (linie højde)       (rel)  [:mm] 
$rec[8]; '$wh'          | $rec[9]; - Objektets dimension (streg-bredde, font-højde) [:px]
$rec[9]; '$colr'        | $rec[10];- Objektets farve kode [:string]   {color="color_name|hex_number|rgb(_number)"}
$rec[10];'$font'        | $rec[11];- Objektes font-family [:string]   {default= Helvetica, Arial, Times, sans-serif;}
$rec[11];'$fed'         | $rec[12];- Objektes øvrig font-style i css-format (bold/italic/small/big) [:string]
$rec[12];'$kurs'        | $rec[13];- Grafik-link [:string] i css-format f.eks: "../_assets/images/saldi-e50x170.png" alt="The logoimg"
$rec[13];'$side'        | $rec[14];- Sekunder "Beskrivelse" (på fremmedsprog) [:string] (default: @+Beskrivelse, som kan anvendes som sprog-key)
$rec[14];'$sprog'       | $rec[15];- Note til objektet
 */
  htm_PanlBund($pmpt='@Gem',$subm=false);
}

######### :SYSTEM:
# Kaldes fra:  [_base/page_Printlayout.php] 
function Panl_PrintEdit(&$DATA) {  global $blanket;  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'editform',$capt= '@Formularens elementer:',$parms='#',$icon='fas fa-pen-square','panelW960',__FUNCTION__,$more='');
  htm_Caption('@Her kan du vælge variabler - ');
  $copyknap= '<button type="button" id="btnCopy" onclick="varcopy()" style="background-color:'.$ØBtNewBgrd.'" title="'.    //  varcopy() erklæres i htm_pagePrepare.php
    tolk('@Klik her, for at kopiere det valgte variabelnavn til kopieringsbuffer, så du kan indsætte det i tekst-feltet ´Felt-indhold´'). 
         '">&nbsp;<ic class="fas fa-copy" style="font-size:15px;"> </ic> Copy </button>';
  echo ' Art=2: Tekster: '. htm_SelectStr($name='copytxt',$valu='VALU',FormVars($frmNr),'max-width:200px; background-color:white;" title="'.  
       tolk('@Her kan du vælge blandt de brugbare variabelnavne angående tekster'),false).$copyknap;
  echo ' Art=3: Ordrelinjer: '. htm_SelectStr($name='copytxt',$valu='VALU',OrdrVars($frmNr),'max-width:200px; background-color:white;" title="'.  
       tolk('@Her kan du vælge blandt de brugbare variabelnavne angående ordrelinier'),false).$copyknap;
  if (($blanket==6) or ($blanket==7) or ($blanket==8))
  {
    htm_FrstFelt('15%');  htm_Caption('@Gebyrberegning: ');
    htm_NextFelt('18%');  htm_CombFelt($type='numberL',  $name='gebyr', $valu= '0', $labl='@Varenummer - rykker gebyr',   $titl='@Varenummer som indeholder sats for rykkergebyr',  $revi=false, $rows='', $width='160px');
    htm_NextFelt('18%');  htm_CombFelt($type='numberL',  $name='sats',  $valu= '0', $labl='@Varenummer - rentesats',  $titl='@Varenummer som angiver sats for rente af for sen betaling',  $revi=false, $rows='', $width='160px');
    htm_NextFelt('25%');  htm_Plaintxt('@Aktiver gebyrberegning, ved at oprette et tekst felt med ordet >GEBYR<');
    htm_NextFelt('18%');  htm_CombFelt($type='numberL',  $name='inka',  $valu= '0', $labl='@Inkasso - gebyr',  $titl='@Størrelsen af inkassogebyr',  $revi=false, $rows='', $width='140px');
    htm_LastFelt('');  
  };
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
       ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
       ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
         ['@Id',            '0%','text','',   ['center'], '@DB index, vedligeholdes af systemet!', 'auto...'],
         ['@Nr.',           '2%','text','',   ['center'], tolk('@Formular nr:'). ShowCol($liste=FRM_Liste(),$col= 0,$sep='<br>').' KAN IKKE RETTES HER!', 'kode...'],
         ['@Art',           '3%','data','',   ['center'], tolk('@Koden for feltes art:').  ShowCol($liste=FartListe(),$col= 0,$sep='<br>'), 'art...'],
         ['@Side',          '3%','data','',   ['center'], tolk('@Udskrift på side kode:'). ShowCol($liste=SideListe(),$col= 2,$sep='<br>'), 'side...'],
         ['@Felt-indhold', '24%','data','',   ['left'  ], '@Feltets tekstindhold samt $variabler',  '-'],
         ['@Just',          '3%','data','',   ['center'], tolk('@Justering af teksten:').  ShowCol($liste=JustListe(),$col= 0,$sep='<br>').'(Samt kode for papirformat)', '-'],
         ['@X0',            '4%','helt','0d', ['right' ], '@Indsætnings X-koordinat (mm fra formularens venstre kant)', 'X0...'],
         ['@Y0',            '4%','helt','0d', ['right' ], '@Indsætnings Y-koordinat (mm fra formularens top kant)', 'Y0...'],
         ['@Brd.',          '4%','helt','0d', ['right' ], '@Felt bredde (mm)', 'F-b...'],
         ['@Høj.',          '4%','helt','0d', ['right' ], tolk('@Felt højde (mm)').'<br>'.tolk('@Angiv 0 for at autotilpasse'), 'F-h...'],
         ['@Dim.',          '4%','helt','0d', ['right' ], '@Objektets dimension: Streg-bredde, Tegn-højde, målt i px (pixel)', 'Obj-D...'],
         ['@Farve',         '7%','data','',   ['center'], '@Objektets farve, angives som HTML5 tillader. (red, #FF44DD, rgb)', 'farve...'],
         ['@Txt-font',     '10%','data','',   ['left'  ], tolk('@Objektets font').str_nl().tolk('(gyldigt argument til: font-family):'). ShowCol($liste=FontListe(),$col= 2,$sep=str_nl()), '-'],
         ['@Txt-style',    '13%','data','',   ['left'  ], tolk('@Objektets style').'<br>'.tolk('(gyldigt argument til: font-weight, font-style). Husk afsluttende semikolon!'), '-'],
         ['@Grafik',        '2%','data','',   ['left'  ], '@Link til grafikfil', 'graf...'],
         ['@Fremmedsprog',  '0%','text','',   ['left'  ], '@Alternativ beskrivelse, f.eks. på engelsk', 'alt...'],
         ['@Note',         '10%','data','',   ['left'  ], '@Note til objektet', 'note..']
       ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
         ['@Slet',          '8%','text','',   ['center'], '@Klik på rødt kryds for at slette denne post', '<ic class="far fa-times-circle" style="color:red; font-size:13px; "></ic>']
       ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON]
    $DATA /* =   array(
       ) */ ,
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '500px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_nl();
  XY_forskydning();
  htm_Caption('@Her er der ingen kontrol af indtastede data, så det er dit ansvar, at de er gyldige!');
  htm_Plaintxt('@Når du redigerer, kan det være en fordel, at se disse paneler (Layout & Tabel) i 2 browser-vinduer, ved siden af hinanden.');
  htm_PanlBund($pmpt='@Gem',$subm=true,'@Husk at gemme her, hvis du har rettet noget ovenfor, inden du forlader vinduet.','','','editform');
  //  var_dump($_POST);
  //  Vis_Data($_POST);
  //  if (isset($_POST['btn_editform']))
  //  if (is_array($_POST['editform'])) { foreach($_POST['editform'] as $inputName => $inputValue)    { echo '<br> Name:'.$inputName; echo ' Valu:'.$inputValue; } }
} //  Panl_PrintEdit
 
 
######### :SYSTEM:
# Kaldes fra:  [_base/page_Printlayout.php] [_base/page_Startup.php] 
function Panl_PrintDesign(&$DATA=[])  {    ## out_PanlsSekd.php
//  Afløser for Panl_PrintlayoutTXT
  global $html_buff, $x0, $blanket; 
    
  // Panl_PrintDesign start:
  //  Initiering:
  if (!$blanket)    $blanket= 4; 
  if (!$sidetype)   $sidetype= 'A'; 
  if (!$fremmedsp)  $fremmedsp= true;       
  //  Opdatering:
  if (isset($_POST['btn_printout'])) {  //  Accept-knap i paneltes footer
   //  $blanket=  $_POST['blanket']; 
     $sidetype= $_POST['sidetype'];
     $fremmedsp= $_POST['fremmedsp']; 
    }
  if (isset($_POST['blanket']))   $blanket=    $_POST['blanket']; 
  if (isset($_POST['fremmedsp'])) $fremmedsp=  $_POST['fremmedsp']; 
  $fremmedsp= true;
  
  ## Varelinie-data:
  $varedat= sql_readB('SELECT id, form, frm_art, side, besk, just, x0, y0, dx, dy, dim, colr, font, style, imglnk, lngkey, note '.
                      'FROM  tblA_forms '.
                      'WHERE form="'.$blanket.'" AND frm_art="0" AND side="G"',__FILE__, __LINE__);
  $papirformat= $varedat['just'];
  switch ($papirformat) {         
    case 'A5p': $pagewidth= 149; $pageheight= 210; break; 
    case 'A5l': $pagewidth= 210; $pageheight= 149; break; 
    case 'A4p': $pagewidth= 210; $pageheight= 297; break; 
    case 'A4l': $pagewidth= 297; $pageheight= 210; break; 
    case 'A3p': $pagewidth= 297; $pageheight= 420; break; 
    case 'A3l': $pagewidth= 420; $pageheight= 297; break; 
    default   : $pagewidth= 210; $pageheight= 297; $papirformat='A4p';
  }
  if ($pagewidth<=220) $panel= 'panelW960'; else $panel= 'panelW120';
  
  htm_Panl_Top($name= 'printout',$capt= '@Udskrivnings-Layout',$parms='#',$icon='fas fa-print',$panel,__FUNCTION__);
  htm_FrstFelt('27%');
    htm_OptioFlt($type='text',  $name='blanket',   $valu= $blanket, 
                    $labl='@Formular',      $titl='@Vælg en Formular som du vil vise/redigere',  
                    $revi=true, $optlist= FRM_Liste(),    $action='', $events='','','',1);  //  onchange="window.location.reload();"
  htm_NextFelt('35%');
    htm_OptioFlt($type='text',  $name='sidetype',   $valu= $sidetype,
                    $labl='@Udskrifts Side (& Sidste!)',   $titl='@Her vælger du visning af udskrifts-side.',  
                    $revi=true, $optlist= SideListe(), 
                    $action='','','','',1);
  htm_NextFelt('15%');  
    htm_CheckFlt($type='checkbox',$name='fremmedsp', $valu= $fremmedsp,  $labl='@Benyt fremmesprog', 
          $titl='@Anvend alternativ beskrivelse fra formularens data. Endnu ikke brugbart',  $revi=true, $more=' ');
     $vistools= true;
      //$vistools= 
      // htm_CheckFlt($type='checkbox',$name='vistools', $valu= $vistools,  $labl='@Vis redskaber.', 
          // $titl='@Vis akse-skalaer og mouse-position',  $revi=true, $more=' '); //  Virker ikke! FIXIT
  htm_NextFelt('20%'); 
    htm_Plaintxt('@Opdater med genvejstast: g'); #+ textKnap($label='@Vis/opdater',  $title='@Opdater her hvis du har ændret formular eller side.', $link='#','o');    //  page_Printlayout.php
  htm_LastFelt('');  
  htm_FrstFelt('25%');  htm_OptioFlt($type='text',     $name='papir',  $valu= $varedat[0]['just'], $labl='@Papir-format',  
                  $titl='@Papirstørrelse og retning',  $revi=false, $optlist= PaprListe(),  $action='','','','',1);
  htm_NextFelt('10%');  htm_Caption('@Ordrelinier:');
  htm_NextFelt('10%');  htm_CombFelt($type='numberL',  $name='linier', $valu= $varedat[0]['x0'], $labl='@Antal',   
                  $titl='@Antal ordrelinier pr. side', $revi=false, $rows='', $width='80px');
  htm_NextFelt('10%');  htm_CombFelt($type='numberL',  $name='first',  $valu= $varedat[0]['y0'], $labl='@Første',  
                  $titl='@Første ordrelines y-startpunkt (grundlinie) målt i mm fra side-top',  $revi=false, $rows='', $width='80px');
  htm_NextFelt('10%');  htm_CombFelt($type='numberL',  $name='afstand',$valu= $varedat[0]['dy'], $labl='@Afstand', 
                  $titl='@Afstand mellem ordre-liniers grundlinie, målt i mm',  $revi=false, $rows='', $width='80px');
  htm_NextFelt('35%');  htm_CombFelt($type='numberL',  $name='bredde', $valu= $varedat[0]['dx'], $labl='@Bredde',  
                  $titl='@Maksimal linie længde for beskrivelse, inden der brydes til ny linie, målt i mm',  $revi=false, $rows='', $width='80px');
  htm_Plaintxt(' &nbsp; Kan pt. ikke rettes her');
  htm_LastFelt('');  
    htm_nl();
// INITIERING:
//  $filDATA= ImportTabFile(realpath($_SERVER["DOCUMENT_ROOT"]). '/saldi-e/_exchange/_standard/formularer.v50.tab');  //  Ny version
//  $filDATA= ImportTabFile(realpath($_SERVER["DOCUMENT_ROOT"]). '/saldi-e/_exchange/_standard/formular-utf8.tab');   //  Gl version
  #- $DATA= sql_readB('SELECT id, form, frm_art, side, besk, just, x0, y0, dx, dy, dim, colr, font, style, imglnk, lngkey, note '.
  #-                  'FROM tblA_forms ',__FILE__, __LINE__);
  $pform= tolk(ListLookup($liste=PaprListe(),$search= $papirformat,$colsearch=1,$colresult=2));
  //$blanket='6';
  printForm($DATA, $blanket, $pform, $pagewidth, $pageheight, $vistools);
  textKnap($label='@Se udskrift', $title='@Se hvad der kan udskrives med CTRL-p (uden stempel: KOPI)', $link='../_temp/printside.htm',$akey='p" target="_blank');
  textKnap($label='@Se kopi',     $title='@Se hvad der kan udskrives med CTRL-p (med stempel: KOPI)',  $link='../_temp/kopiside.htm',$akey='k" target="_blank');
  htm_Caption('@Mail-tekster - ');
  htm_Caption('@Emne: ');   htm_sp(2); htm_Plaintxt($mailemne.': '.'$ordre_fakturanr'); htm_sp(4); 
  htm_Caption('@Besked: '); htm_sp(2); htm_Plaintxt($mailbesk);
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='@Gem eller opdater',$akey='g','','printout');
  //  var_dump($_POST);
  //  if(isset($_POST['Submit'])) {var_dump($_POST['printout']); foreach($_POST['printout'] as $inputName => $inputValue)    { echo '<br> Name:'.$inputName; echo ' Valu:'.$inputValue; }  }
  return $blanket;
} //  Panl_PrintDesign


function printForm($DATA, $blanket, $pform, $pagewidth, $pagehght, $vistools) { 
global $html_buff, $x0, $pageheight, $sidetype;
$pageheight= $pagehght;
  function textfelt($ix, $x='', $y='', $h='', $b='', $txt='', $style='',$clean=false,$vistools=false,$doprn=true) { 
  global $pageheight, $html_buff;
  //  Angives $h til værdien 0, bliver ramme-højden automatisk tilpasset indholdet.
    dvl_pretty('textfelt');
    $bordpx='1';
    if ($h!=0) $ramme_h= 'height: '.$h.'mm; '; else $ramme_h= '';  //  Udelades height => "h=fit"
    if (($vistools==true) and (!$doprn)) $bordpx='2';
    $bdr= ' border: '.$bordpx.'px solid #efefef;';    //  Felt-ramme
    $out_str1= '<span id="df_'.$ix.'"  style="position: absolute;  bottom:'.($pageheight-$y).'mm; left: '.$x.'mm; width: '.$b.'mm; '.$ramme_h;  //  bottom for at justere efter tekst base-linie
    $out_str2= 'font-family: Helvetica, Arial, Times, sans-serif; white-space:pre; '.$style.'">';
    //  Onmouseover: Vis div.x,y og rectangel som flytter med musen, så man kan klikke et flytTilPunkt
    if ($clean) $out_str2.= '<span style="position:relative; left:0; bottom:0;">'.$txt.'</span>';  //  Tekst i rammen     border:1px dotted green;
    else        $out_str2.= 'Pos: '.$x.'mm:'.$y.'mm - '.$txt.' - Dim: '.$b.'x'.$h.' mm  : '.$style;
    $out_str2.= '</span>';
    echo $out_str1.$bdr.$out_str2;   if ($doprn) $html_buff.= $out_str1.$out_str2;
    return $out_str1.$out_str2;
  };
  function setstyle($b, $wh, $ffam, $just, $colr, $fsty) { global $x0;
        $feltw= $b;   //  $feltw= +1.4*strlen($beskriv)+0.8*$wh; 
        $style= '';    $font= '';  $px= $wh;  $fsty= ' '.strtolower($fsty);
        if ($colr=='0') $colr= '#000';
        if (strpos($fsty,'bold;'))    {$fsty= str_replace('bold;',   '',$fsty).' font-weight:bold; '; } 
        if (strpos($fsty,'italic;'))  {$fsty= str_replace('italic;', '',$fsty).' font-style:italic; '; }
        if (strpos($fsty,'oblique;')) {$fsty= str_replace('oblique;','',$fsty).' font-style:oblique; '; }
        if (strpos($fsty,'normal;'))  {$fsty= str_replace('normal;', '',$fsty).' font-style:normal; '; }
        if ($ffam  =='Helvetica')  {$font.= 'Helvetica; ';}  else {$font.= 'Times; ';}
        if ($wh >0)       {$style.= 'font:'.$px.'px '.$font;}
        if (($just =='V') or ($just =='L'))
                          {$style.= 'text-align:left; ';   $dx= 0;          $x0= $x0-$dx; }
        if  ($just =='C') {$style.= 'text-align:center; '; $dx= $feltw/2;   $x0= $x0-$dx; }
        if (($just =='H') or ($just =='R'))
                          {$style.= 'text-align:right; ';  $dx= $feltw;     $x0= $x0-$dx; }
        if ($colr>'')     {$style.= 'color:'.$colr.'; ';}   // Color! <font color="red">  <font color="color_name|hex_number|rgb(_number)">   style="font-family:Courier; color:Blue; font-size: 20px;"
        if ($fsty)        {$style.= $fsty;}; // else {$style.= 'font-style:normal; ';} //  font-style: normal|italic|oblique|initial|inherit;    font-weight: bold;
        return $style;
  } 
  function linefelt($x='', $y='', $h='', $b='', $colr='') {  //  Linier, som rectangler med lav højde
    global $pageheight, $html_buff;
    if ($y-$h<0) {$y=$y+$h;}
    $out_str= '<span style="position:absolute; bottom:'.($pageheight-$y).'mm; left:'.$x.'mm; width:'.$b.'mm; height:'.($h).'mm; border:0.5px solid '.$colr.'; font:1px;"></span>';
    echo $out_str;    $html_buff.= $out_str;
   } 
  function graffelt( $x='', $y='', $h,/* px */ $b,/* px */  $img= 'src="../_assets/images/saldi-e50x170.png" alt="The logoimg" ') { 
    global $pageheight, $html_buff;
    $field ='border:1px dotted gray; font:1px; color:red; ">_';
    if (true) $field='border:0px dotted gray; font:1px; color:red; ">';
    $out_str.=  '<span style="position:absolute; bottom:'.($pageheight-$y).'mm; left:'.$x.'mm; '.$field.'<img '.$img.' height="'.$h.'" width="'.$b.'" ></span>';
    echo $out_str;    $html_buff.= $out_str;
  }
  
## Initier udskrivnings-buffere:
  $html_buff= '<!DOCTYPE html><html lang="da" dir="ltr"> <head>  <meta charset="UTF-8">  <title>'.tolk('@Udskrifts-side').'</title>'.
              '<style type="text/css"> @page { size:'.$pagewidth.'mm '.$pageheight.'mm; margin:0mm 0mm 0mm 0mm; } </style> </head><body>';
  $kopibuff= '';
  echo '<fieldset id="printpage" style="border: 1px solid #8c8b8b; padding:2px; width:'.$pagewidth.'mm; height:'.$pageheight.'mm; margin: auto; margin-bottom:20px;'.
   ' position:relative; background:white;  cursor:crosshair;"> <legend><tc><b>'.tolk('@Papir:'.$pform).'</b></tc></legend>';
  if ($vistools==true) {
    //  akser($pagewidth, $pageheight);   Forkert ved forskellige papirformater - FIXit eller undvær
    echo '<span id="showinfo" style="position: relative; top:'.($pageheight/2).    'mm; left:-45mm; width:200px;" >Pos. X,Y:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;?,?&nbsp;mm; </span>'; //  X:Y-pos:  &nbsp;  ?:?
    echo '<span id="showkoor" style="position: relative; top:'.($pageheight/2-8.5).'mm; left:-36mm; width:200px;" >Klik-Pos. X,Y:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;?,?&nbsp;mm </span>'; //  X,Y-pos:  &nbsp;  ?,?
  }
  $calib= 3.8;
  echo '<script>';     //  https://stackoverflow.com/questions/7790725/javascript-track-mouse-position
  echo 'var offset = $("#printpage").offset();';
// Vis XY-position:
  echo "var showinfo = document.getElementById('showinfo');";  //  Knyt til objektet showinfo
  echo "function tellPos(p){ showinfo.innerHTML = 'Pos. X: ' + Math.round((p.pageX  - offset.left)/".$calib." ) + ' , Y:' + Math.round((p.pageY - offset.top)/".$calib.") + ' mm';}";
  echo "addEventListener('mousemove', tellPos, false); ";   //  Rapporter mouse-pos til function tellPos
// Gem klik-position:
  echo "var showkoor = document.getElementById('showkoor');";  //  Knyt til objektet showkoor
  echo "function savePos(p){ showkoor.innerHTML = 'Klik X,Y: ' + Math.round((p.pageX  - offset.left)/".$calib." ) + ',' + Math.round((p.pageY - offset.top)/".$calib.") + ' mm';}";
  echo "addEventListener('click', savePos, false); ";   //  Rapporter mouse-pos til function savePos
  echo '</script>';
/* 
Data-struktur version 5.+
id serial,            | $rec[-1] - DB-id
form integer,         | $rec[0]; - Formular kode [0..13..]
frm_art integer,      | $rec[1]; - Formular art kode[0..3]: 0= Layout   1= Grafik     2= Blanket-tekster    3=  Tekster - Ordrelinier    5= Mail-tekster
side varchar(2),      | $rec[2]; - Side-kode: A !A S !S G [:string] (G:generelt/Layout)
besk VARCHAR(300),    | $rec[3]; - "Beskrivelse" - Tekstindhold i feltet  [:string]
just VARCHAR(30),     | $rec[4]; - Justering i feltet: L/V=venste, C=centreret, R/H=højre [:string]           {Layout: kode for papirformat }
x0 numeric(15,3),     | $rec[5]; - X0= Feltets indsætningskoordinat   (abs)  [:mm] målt fra venstre side-kant {Layout: Ordrelinie antal }                 {Mail: felt-nr: 1= "Emne" 2= "Besked" 3= "Vedhæftet"}
y0 numeric(15,3),     | $rec[6]; - Y0= Feltets indsætningskoordinat   (abs)  [:mm] målt fra side-top          {Layout: Ordrelinie placering af 1. linie }
dx numeric(15,3),     | $rec[7]; - Feltets bredde (linie længde)      (rel)  [:mm]                            {Layout: Bredde af Ordrelinie beskrivelse } 
dy numeric(15,3),     | $rec[8]; - Feltets højde  (linie højde)       (rel)  [:mm]                            {Layout: Ordrelinie afstand } 
dim numeric(15,3),    | $rec[9]; - Objektets dimension (streg-bredde, font-højde) [:px]
colr VARCHAR(30),     | $rec[10];- Objektets farve kode [:string]  {color="color_name|hex_number|rgb(_number)"}
font VARCHAR(99),     | $rec[11];- Objektes font-family [:string]  {default= Helvetica, Arial, Times, sans-serif;}
style VARCHAR(99),    | $rec[12];- Objektes øvrig font-style i css-format (bold/italic/small/big) [:string]
imglnk VARCHAR(99),   | $rec[13];- Grafik-link [:string] i css-format f.eks: src="../_assets/images/saldi-e50x170.png" alt="The logoimg"
lngkey VARCHAR(300),  | $rec[14];- Sekunder "Beskrivelse" (på fremmedsprog) [:string] (default: @+Beskrivelse, som kan anvendes som sprog-key)
note VARCHAR(99),     | $rec[15];- Note til feltet
*/

  $layout= 0;   $grafik= 1;   $tekster= 2;    $ordrelin= 3;   $maildata= 5;   //  Konstanter
  $dx= 0;   $mailemne= '';  $mailbesk= '';  $afst=2;  $antal=5; $toplin= 140; //  Initiering
  $ix= 0;  // Felter: 'SELECT id, form, frm_art, side, besk, just, x0, y0, dx, dy, dim, colr, font, style, imglnk, lngkey, note '
  foreach ($DATA as $rec) //  - udtegn data   ## utf8_decode $beskriv og $tolket hvis der indlæses fra fil!
    { //  $qstr='SELECT id, form, frm_art, side, besk, just, x0, y0, dx, dy, dim, colr, font, style, imglnk, lngkey, note '.
      $x0= $rec['x0']; $y0= $rec['y0']; $b= ($rec['dx']); $h= ($rec['dy']); $wh=$rec['dim']; 
      $just= strtoupper($rec['just']);  
    //+  $tolket= tolk($rec['lngkey']);  
    //+  if ($fremmedsp==true) $rec['besk']= $tolket;
      $rec['besk']= tolk($rec['lngkey']);
      if ($rec['side']=='') $rec['side']= 'A';
// Generelt:
    if ($rec['form']==$blanket)  {
      if (($rec['frm_art']==$layout) and ($rec['side']=='G'))  //  Papirformat og Ordrelinier-placering
        { $antal= $rec['x0']; $toplin= $rec['y0']; 
          $bred= $rec['dx'];  $afst= $rec['dy'];  
          $pfrm= $rec['just'];
        }
      if (($rec['frm_art']==$layout) and (strlen($just)==1))  //  Stempel-tekst
        { $style= setstyle($b, $wh, $rec['font'], $just, $rec['colr'], $rec['style']); 
          $kopibuff.= textfelt($ix++,$x0,$y0, $wh/3.0, $b, $rec['besk'], $style,true,$vistools,false);
        }
      if  ($rec['frm_art']==$maildata)  //  Mail-tekster
        { if ($x0=='1') $mailemne= $rec['besk'];
          if ($x0=='2') $mailbesk= $rec['besk'];
        }
      } //  Det skal sikres at $rec['frm_art']==0 kommer før ordrelinier i filen !
// Grafik:
    if (($rec['form']==$blanket) and (($rec['side']==$sidetype) 
     or ($rec['side']=='A'))     and ($rec['frm_art']==$grafik)) {  //  'side']=='A' ?
        if ($wh>0) linefelt($x0, $y0, $h, $b, $colr='gray');        // Linier (=rektangler med ramme)
        if ($wh<1) graffelt($x0, $y0, $h, $b, $img= /* 'src="'. */$rec['imglnk'].' '); // Grafik
      }
// Tekster:
    if (($rec['form']==$blanket) 
        //  and (($rec['side']==$sidetype)   or ($rec['side']=='S'))
        and (($rec['frm_art']==$tekster) or ($rec['frm_art']==$ordrelin)) )
      { $style= setstyle($b, $wh, $rec['font'], $just, $rec['colr'], $rec['style']);
        if ($rec['besk']==':GEBYR') {/* udskrives ikke.  */}     // Flag ang. gebyrberegning
        else 
        if ($rec['frm_art']==$ordrelin)   // Ordrelinier
          for ($i= 0; $i < $antal; $i++) 
            { textfelt($ix++,$x0,$toplin+$i*$afst, $wh/3.5, $b, $rec['besk'], $style,true,$i==0,true);                       //  1. Ordrelinie
              if ($i==0) textfelt($ix++,$x0,$toplin+$i*$afst, $wh/3.5, $b, '_', $style.' color:red;',true,$vistools,false);  //  Vis indsætningspunkt i 1. linie
            } //  Alle andre tekster:
        else {textfelt($ix++,$x0,$y0, $wh/3.0, $b, $rec['besk'], $style,true,$vistools);
              textfelt($ix++,$x0,$y0, $wh/3.0, $b, '_', $style.' color:red;',true,$vistools,false);  //  Vis indsætningspunkt
        }
      }
    }
  $html_orig= $html_buff;
  $html_kopi= $html_buff.$kopibuff;
  if ($vistools) {
    // Demo-TEKSTER:
    textfelt($ix++,  0,   0,  0,  0,'BASE x:0, y:0', 'font-weight:bold; color:brown; transform:rotate(-10deg); font:12px times; ',true,'',false);
    textfelt($ix++, 80, 160,  0, 40,'<u>FeltA</u> x:80, y:160', 'font-weight:bold; color:Tomato; font:8px times; ',true,'',false);
    textfelt($ix++,100, 160,  0, 40,'<u>FeltB</u> x:100, y:160','font-weight:bold; color:blue;   font:16px times;',true,'',false);
    textfelt($ix++, 75, 170,  3, 60,'Tekst-Data felters indsætningspunkt vises med rødt <red style="color:red;">_</red> <br>Y-værdier måles fra dokument-top til teksters grundlinie, så ændring af skrift-højde, '.
                              'ikke får tekster til at "hoppe"<br>Tillades fler-linier med style="white-space:pre-wrap;", skal man være klar over at feltet vokser opad hvis $h=0, så det er sidste linie, '.
                              'der er placeret på Y-værdien! Angives derimod $h=3 (linie-højde) fortsætter teksten derimod nedad, til højere Y-værdier.','font:10px times; white-space:pre-wrap; ',true,'',false);
  }
  echo '</fieldset>';
  htm_lf();
  //$html_buff.= '</body> </html>';
  $fp= fopen("../_temp/printside.htm","w");   if ($fp) { fwrite($fp,$html_orig."</body> </html>\n"); fclose($fp); };  
  $fp= fopen("../_temp/kopiside.htm","w");    if ($fp) { fwrite($fp,$html_kopi."</body> </html>\n"); fclose($fp); };  
}

######### :SYSTEM:
# Kaldes fra:  [_base/page_Startup.php] 
function Panl_PrintlayoutTXT($filDATA=[], $pagewidth=210, $pageheight=297) { global $html_buff;   ## out_PanlsSekd.php
//  "Grafik", baseret på absolute placering.   //  Panl_PrintDesign erstatter!
  // Tekster ikke som grafik, betyder bedre opløsning!
  //  Denne funktion læser gammelt format og kan eksporteret til nyt filformat.
  function textfelt($x='', $y='', $h='', $b='', $txt='', $style='',$clean=false,$vistools='',$doprn=true) { global $html_buff;
  //  Angives $h til værdien 0, bliver ramme-højden automatisk tilpasset indholdet.
    dvl_pretty('textfelt');
    $bordpx='1';
    if ($h!=0) $ramme_h= 'height: '.$h.'mm; '; else $ramme_h= '';  //  Udelades height => "h=fit"
    if (($vistools==true) and (!$doprn)) $bordpx='2';
    $bdr= ' border: '.$bordpx.'px solid #efefef;';    //  Felt-ramme
    $out_str1= '<div style="position: absolute;  bottom:'.(297-$y).'mm; left: '.$x.'mm; width: '.$b.'mm; '.$ramme_h; # .$bdr //  bottom for at justere efter tekst base-linie
    $out_str2= 'font-family: Helvetica, Arial, Times, sans-serif; white-space:pre; '.$style.'">';
    if ($clean) $out_str2.= '<div style="position:relative; left:0; bottom:0;">'.$txt.'</div>';  //  Tekst i rammen     border:1px dotted green;
    else        $out_str2.= 'Pos: '.$x.'mm:'.$y.'mm - '.$txt.' - Dim: '.$b.'x'.$h.' mm  : '.$style;
    $out_str2.= '</div>';
    echo $out_str1.$bdr.$out_str2;   if ($doprn) $html_buff.= $out_str1.$out_str2;
  };
  function linefelt($x='', $y='', $h='', $b='', $colr='') { global $html_buff; //  Linier, som rectangler med lav højde
    $out_str= '<div style="position:absolute; bottom:'.(297-$y).'mm; left:'.$x.'mm; width:'.$b.'mm; height:'.($h).'mm; border:0.5px solid '.$colr.'; font:1px;"></div>';
    echo $out_str;    $html_buff.= $out_str;
   } 
  function graffelt( $x='', $y='', $h=50,/* px */ $b=170,/* px */  $img= 'src="../_assets/images/saldi-e50x170.png" alt="The logoimg" ') { global $html_buff;
    $field ='border:1px dotted gray; font:1px; color:red; ">_';
    if (true) $field='border:0px dotted gray; font:1px; color:red; ">';
    $out_str.=  '<div style="position:absolute; bottom:'.(297-$y).'mm; left:'.$x.'mm; '.$field.'<img '.$img.' height="'.$h.'" width="'.$b.'" ></div>';
    echo $out_str;    $html_buff.= $out_str;
  }       //      ($y-$h/12).
  function akser($b=210,$h=297) {  $y0= -2.5;  //  Firefox -5      Chrome 0
    function get_browser_name($user_agent)
    { //  echo 'Browser: '.$user_agent;
    if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
        elseif (strpos($user_agent, 'Edge')) return 'Edge';
        elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
        elseif (strpos($user_agent, 'Safari')) return 'Safari';
        elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
        elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';
        return 'Other';
    }
    $brws= get_browser_name($_SERVER['HTTP_USER_AGENT']);
    if ($brws=='Firefox') {$x0= -0; $y0= 0;} 
    if ($brws=='Chrome')  {$x0= -0; $y0= 0;} 
    for ($i= 0; $i<= $h;  $i++)   { textfelt($x0       -2, $y0+$i    +2,  0,-1, '&nbsp;-', 'font:12px times; text-align:right; color:gray;',true,'',false); }         //  Venstre Y-akse (y0 i toppen) mm
    for ($i= 0; $i<= 29;  $i++)   { textfelt($x0       -7, $y0+$i*10 +2,  0,-1, ($i*10).'&nbsp;&nbsp;-', 'font:12px times; text-align:right;',true,'',false); }       //  Venstre Y-akse (y0 i toppen) cm
    for ($i= 0; $i<= 29;  $i++)   { textfelt($x0      -17, $y0+$i*10 +2,  0,-1, ''.($h-($i*10)), 'font:12px times; text-align:right; font-style:italic;',true,'',false); } //  Venstre Y-akse (y0 i bunden)
    for ($i= 0; $i<= $h;  $i++)   { textfelt($x0+$b   +1,  $y0+$i    +2,  0,-1, '-', 'font:12px times; text-align:left; color:gray; ',true,'',false); }              //  Højre Y-akse mm
    for ($i= 0; $i<= 29;  $i++)   { textfelt($x0+$b   +0,  $y0+$i*10 +2,  0,-1, '-&nbsp;&nbsp;'.($i*10), 'font:12px times; text-align:left;',true,'',false); }        //  Højre Y-akse cm
    for ($i= 0; $i<= $b;  $i++)   { textfelt($x0+$i    -1, $y0       +2,  0,-1, '-&nbsp;', 'font:12px times; text-align:left; transform: rotate(270deg); color:gray;',true,'',false); }          //  Top- X-akse mm
    for ($i= 0; $i<= 21;  $i++)   { textfelt($x0+$i*10 -1, $y0       -0,  0,-1, '-&nbsp;&nbsp;&nbsp;'.($i*10), 'font:12px times; text-align:left; transform: rotate(270deg); ',true,'',false); } //  Top- X-akse cm
    for ($i= 0; $i<= $b;  $i++)   { textfelt($x0+$i    -0, $y0+$h   +3,  0,-1, ' -', 'font:12px times; text-align:right; transform: rotate(270deg); color:gray;',true,'',false); }           //  Bund- X-akse mm
    for ($i= 0; $i<= 21;  $i++)   { textfelt($x0+$i*10 -3, $y0+$h   +5,  0,-1, ($i*10).'&nbsp;&nbsp;-', 'font:12px times; text-align:right; transform: rotate(270deg); ',true,'',false); }   //  Bund- X-akse cm
  }
  
#+   if (isset($_POST['submit']) && $_POST['submit']) {
     $blanket=  $_POST['blanket'];    if (!$blanket) $blanket= '3';
     $sidetype= $_POST['sidetype'];   if (!$sidetype) $sidetype= 'A';
     // $vistools= $_POST['vistools'];
     // htm_PostVariabler($namelist=['blanket','sidetype','vistools']);
#+   } else $blanket= 3;
   if ($width<=220) $panel= 'panelW960'; else $panel= 'panelW120';
  
  htm_Panl_Top($name= 'printout',$capt= '@Udskrivnings-Layout',$parms='../_base/page_Printlayout.php',$icon='fas fa-print',$panel,__FUNCTION__);
  htm_FrstFelt('25%');
    htm_OptioFlt($type='text',  $name='blanket',   $valu= $blanket, 
                    $labl='@Formular',      $titl='@Vælg en Formular som du vil vise',  
                    $revi=true, $optlist= FRM_Liste(),    $action='');
  htm_NextFelt('35%');
    htm_OptioFlt($type='text',  $name='sidetype',   $valu= $sidetype,
                    $labl='@Udskrifts Side (& Sidste!)',   $titl='@Her vælger du visning af udskrifts-side.',  
                    $revi=true, $optlist= SideListe(),             //  $optlist= [['Første sides layout','F','Første'],['Alle sider','A','Alle'],['Sidste sides layout','S','Sidste']],   
                    $action='');
  htm_NextFelt('10%');   $vistools= true;
      //$vistools= 
      // htm_CheckFlt($type='checkbox',$name='vistools', $valu= $vistools,  $labl='@Vis redskaber.', 
          // $titl='@Vis akse-skalaer og mouse-position',  $revi=true, $more=' '); //  Virker ikke! FIXIT
  htm_NextFelt('30%'); 
    htm_Plaintxt('@Opdater med genvejstast: g'); #+ textKnap($label='@Vis/opdater',  $title='@Opdater her hvis du har ændret formular eller side.', $link='#','o');    //  page_Printlayout.php
  htm_LastFelt('');  
    htm_nl();
// INITIERING:
  //$fp= null; //fopen(realpath($_SERVER["DOCUMENT_ROOT"]).'/saldi-e/_exchange/_standard/formularer.v50.tab',"w"); //  /saldi-e/_exchange/_standard/formular-utf8.tab

//  $filDATA= ImportTabFile(realpath($_SERVER["DOCUMENT_ROOT"]). '/saldi-e/_exchange/_standard/formularer.v50.tab');  //  Ny version
  $filDATA= ImportTabFile(realpath($_SERVER["DOCUMENT_ROOT"]). '/saldi-e/_exchange/_standard/formular-utf8.tab');   //  Gl version
  $dx= 0;   $graftype= 1;   $txttype= 2;    $varetype= 3;   
  $html_buff= '<!DOCTYPE html><html lang="da" dir="ltr"> <head>  <meta charset="UTF-8">  <title>'.tolk('@Udskrifts-side').'</title>'.
              '<style type="text/css"> @page { size:'.$pagewidth.'mm '.$pageheight.'mm; margin:0mm 0mm 0mm 0mm; } </style> </head><body>';
  #maindivname{position:relative;}
  
  echo '<fieldset id="printpage" style="border: 1px solid #8c8b8b; padding:2px; width:'.$pagewidth.'mm; height:'.$pageheight.'mm; margin: auto; margin-bottom:20px;'.
   ' position:relative; background:white;  cursor:crosshair;"> <legend><tc><b>'.tolk('@Papir: A4-Portrait').'</b></tc></legend>';
  if ($vistools==true) {
    akser($pagewidth, $pageheight);
    echo '<div id="showinfo" style="position: relative;" >Pos. X,Y:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;?,?&nbsp;mm; </div>'; //  X:Y-pos:  &nbsp;  ?:?
    echo '<div id="showkoor" style="position: relative;" >Klik-Pos. X,Y:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;?,?&nbsp;mm </div>'; //  X,Y-pos:  &nbsp;  ?,?
  }
  echo '<script>';     //  https://stackoverflow.com/questions/7790725/javascript-track-mouse-position
  echo 'var offset = $("#printpage").offset();';
// Vis XY-position:
  echo "var showinfo = document.getElementById('showinfo');";  //  Knyt til objektet showinfo
  echo "function tellPos(p){ showinfo.innerHTML = 'Pos. X: ' + Math.round((p.pageX  - offset.left)/3.8 ) + ' , Y:' + Math.round((p.pageY - offset.top)/3.8) + ' mm ';}";
  echo "addEventListener('mousemove', tellPos, false); ";   //  Rapporter mouse-pos til function tellPos
// Gem klik-position:
  echo "var showkoor = document.getElementById('showkoor');";  //  Knyt til objektet showkoor
  echo "function savePos(p){ showkoor.innerHTML = 'Klik X,Y: ' + Math.round((p.pageX  - offset.left)/3.8 ) + ',' + Math.round((p.pageY - offset.top)/3.8) + ' mm';}";
  echo "addEventListener('click', savePos, false); ";   //  Rapporter mouse-pos til function tellPos
  echo '</script>';
 // element.attachEvent('onclick', function() { /* do stuff here*/ });
 
  foreach ($filDATA as $rec) // 1. gennemløb - find data for Ordrelinier
    {if ($rec[2]=='generelt') {$antal= $rec[4];   $toplin=297-$rec[5];  $afst= $rec[6];} }
/* 
Fremtidig Filstruktur:  
version 3.x               version 5.+
$rec[0]; '$formular'    | $rec[0]; - Formular kode [0..13..]
$rec[1]; '$art'         | $rec[1]; - Formular art kode[0..3]: 0= Layout   1= Grafik     2= Blanket-tekster    3=  Tekster - Ordrelinier
              $rec[13]  | $rec[2]; - Side-kode: A !A S !S [:string]
$rec[2]; '$beskrivelse' | $rec[3]; - "Beskrivelse" - Tekstindhold i feltet  [:string]
$rec[3]; '$just'        | $rec[4]; - Justering af/i feltet: V=venste, C=centreret, H=højre [:string]
$rec[4]; '$xa'   (abs)  | $rec[5]; - X0= Feltets indsætningskoordinat   (abs)  [:mm] målt fra venstre side-kant {3.x: Ordrelinie antal}
$rec[5]; '$ya'   (abs)  | $rec[6]; - Y0= Feltets indsætningskoordinat   (abs)  [:mm] målt fra side-top          {3.x: Ordrelinie placering af 1. linie}
$rec[6]; '$xb'   (abs)  | $rec[7]; - Feltets bredde (linie længde)      (rel)  [:mm]                            {3.x: Ordrelinie afstand}
$rec[7]; '$yb'   (abs)  | $rec[8]; - Feltets højde  (linie højde)       (rel)  [:mm] 
$rec[8]; '$wh'          | $rec[9]; - Objektets dimension (streg-bredde, font-højde) [:px]
$rec[9]; '$colr'        | $rec[10];- Objektets farve kode [:string]
$rec[10];'$font'        | $rec[11];- Objektes font-family [:string] 
$rec[11];'$fed'         | $rec[12];- Objektes øvrig font-style i css-format (bold/italic/small/big) [:string]
$rec[12];'$kurs'	      | $rec[13];- Grafik-link [:string] i css-format f.eks: "../_assets/images/saldi-e50x170.png" alt="The logoimg"
$rec[13];'$side'        | $rec[14];- Sekunder "Beskrivelse" (på fremmedsprog) [:string] (default: @+Beskrivelse, som kan anvendes som sprog-key)
$rec[14];'$sprog'       | $rec[15];- Note til objektet
 */
  function StrFelt ($str) { return "'".$str."'".chr(9);}
  function DatFelt ($dat) { return $dat.chr(9);}
#Eksporter til nyt ver 5.0 fil-format:
  $fp= null;  //  fopen(realpath($_SERVER["DOCUMENT_ROOT"]).'/saldi-e/_exchange/_standard/formularer.v50.tab',"w"); //  /saldi-e/_exchange/_standard/formular-utf8.tab
  if ($fp) {  //  exporter gl.format til ver5.0 format
    fwrite($fp,':Form'.chr(9).'Art'.chr(9).'Side'.chr(9).'Beskr'.chr(9).'Just'.chr(9).'X0'.chr(9).'Y0'.chr(9).'dx'.chr(9).'dy'.chr(9).
                'Hgt'.chr(9).'Wdt'.chr(9).'Colr'.chr(9).'Font'.chr(9).'Style'.chr(9).'Src'.chr(9).'Key'.chr(9).'Note'."\n");
    foreach ($filDATA as $rec) {
      if ($rec[13]=='') $rec[13]= 'A';
      if ($rec[2]=='LOGO') $src= 'src="../_assets/images/saldi-e50x170.png" alt="The logoimg" '; else $src= '';
      $style = '';  //  'font-weight:normal; ';
      $beskriv= utf8_decode ($rec[2]);
      $dx= abs($rec[4]-$rec[6]);
      $dy= abs($rec[5]-$rec[7]);
      if ($rec[10]=='Helvetica') $font= 'font-family: Helvetica ';
      if ($rec[10]=='Times') $font= 'font-family: Times ';
      if ($rec[11]=='on') $style.= 'font-weight:bold; ';
      if ($rec[12]=='on') $style.= 'font-style:italic; ';
      if ($rec[1]=='1') { $font= ''; $style = ''; }
      if ($rec[1]!='2') $note= 'Note:'; else $note= '';
      if (($rec[1]=='3') and ($rec[2]=='generelt')) {$beskriv='A4-portrait'; $rec[1]= '0'; $note= tolk('@Note: Side-layout, samt fælles-data for ordrelinier'); $rec[2]= 'A4-portrait'; $font= ''; $style = '';
                                                      $rec[6]= $rec[6]+$rec[4];  $rec[7]= $rec[7]+$rec[5]; // Skal ikke gøres relative!
                                                     // $antallin= 'Antal Ordrelinier: '.$rec[4]; 
                                                     // $firstline= 'Y-Placering af første Ordrelinie: '.$rec[5];
                                                     // $lineheight= 'Ordrelinie afstand: '.$rec[6];
                                                    }
      if (($rec[1]=='3') and ($rec[2]!='generelt')) $beskriv= '£'.$beskriv;
      $line=  StrFelt($rec[0]).       # $rec[0]; - Formular kode [0..13..]
              StrFelt($rec[1]).       # $rec[1]; - Formular art kode[0..3]: 0= Layout   1= Grafik   2= Blanket-tekster    3=  Tekster - Ordrelinier
              StrFelt($rec[13]).      # $rec[2]; - Side-kode: A !A S !S [:string]
              StrFelt($beskriv).      # $rec[3]; - "Beskrivelse" - Tekstindhold i feltet  [:string]
              StrFelt($rec[3]).       # $rec[4]; - Justering af/i feltet: V=venste, C=centreret, H=højre [:string]
              DatFelt($rec[4]).       # $rec[5]; - X0= Feltets indsætningskoordinat   (abs)  [:mm] målt fra venstre side-kant
              DatFelt(297-$rec[5]).   # $rec[6]; - Y0= Feltets indsætningskoordinat   (abs)  [:mm] målt fra side-top
              DatFelt($dx).           # $rec[7]; - Feltets bredde (linie længde)      (rel)  [:mm] (dx)
              DatFelt($dy).           # $rec[8]; - Feltets højde  (linie højde)       (rel)  [:mm] (dy)
              DatFelt($rec[8]).       # $rec[9]; - Objektets dimension (streg-bredde, font-højde) [:px]
              StrFelt($rec[9]).       # $rec[10];- Objektets farve kode [:string]
              StrFelt(trim(substr($font,13))).  # $rec[11];- Objektes font [:string]   'font-family: Helvetica, Arial, Times, sans-serif; uden prefix: font-family:'
              StrFelt(trim(substr($style,12))). # $rec[12];- Objektes øvrig style i css-format (bold/italic/small/big) [:string]          uden prefix: font-weight:'
              StrFelt($src).          # $rec[13];- Grafik-link [:string] i css-format f.eks: "../_assets/images/saldi-e50x170.png" alt="The logoimg"
              StrFelt('@'.$beskriv).  # $rec[14];- Sekunder "Beskrivelse" (på fremmedsprog) [:string] (default: @+Beskrivelse, som kan anvendes som sprog-key)
              StrFelt($note).         # $rec[15];- Note til objektet
                            "\n";
      fwrite($fp,$line);
    } fclose($fp);  }
  
  foreach ($filDATA as $rec) // 2. gennemløb - udtegn data
    { $frm= $rec[0];  $art= $rec[1];  $beskriv= $rec[2];  $just= $rec[3]; $xa= $rec[4]; $ya= 297-$rec[5]; $xb= $rec[6]; $yb= 297-$rec[7]; 
        $wh=$rec[8];  $colr= $rec[9];  $fnt=$rec[10];  $fed=$rec[11];  $kurs=$rec[12];  $side= $rec[13];
      if ($side=='') $side= 'A';
      if ($colr==0) $colr= 'black';
// Grafik:
    if (($frm==$blanket) and (($side==$sidetype) or ($side=='S')) and ($art==$graftype)) {
      // { if ($yb>$ya) $h=$yb-$ya; else $h=$ya-$yb;
        // if ($xb>$xa) $b=$xb-$xa; else $b=$xa-$xb;
//  Omberegn absolutte til relative koordinater:
        if ($xb>$xa) $b=$xb-$xa; else $b=$xa-$xb;
        $grafy= $ya;
        if ($yb>$ya) {$tmp=$ya; $ya=$yb; $yb=$tmp;}
        if ($yb>$ya) $h=$yb-$ya; else $h=$ya-$yb;
        if ($wh>0) linefelt($x=$xa, $y=$ya,    $h,    $b, $colr='gray'); // Linier (=rektangler med ramme)
        if ($wh<1) graffelt($x=$xa, $y=$grafy, $h=50, $b=170,$img= 'src="../_assets/images/saldi-e50x170.png" alt="The logoimg" '); // Grafik
      }
// Tekster:
    if (($frm==$blanket) and (($side==$sidetype) or ($side=='S')) and (($art==$txttype) or ($art==$varetype))) {
        $feltw= +1.4*strlen($beskriv)+0.8*$wh; 
        $style= '';    $font= '';  $px= $wh;
        if ($fnt  =='Helvetica')  {$font.= 'Helvetica; ';}  else {$font.= 'Times; ';}
        if ($wh >0)       {$style.= 'font:'.$px.'px '.$font;}
        if ($just =='V')  {$style.= 'text-align:left; ';   $dx= 0;}
        if ($just =='C')  {$style.= 'text-align:center; '; $dx= $feltw/2;}
        if ($just =='H')  {$style.= 'text-align:right; ';  $dx= $feltw;}
        if ($colr>'')     {$style.= 'color:'.$colr.'; ';}   // Color! <font color="red">  <font color="color_name|hex_number|rgb(_number)">
        if ($fed =='on')  {$style.= 'font-weight:bold; ';}  else {$style.= 'font-weight:normal; ';}
        if ($kurs=='on')  {$style.= 'font-style:italic; ';} else {$style.= 'font-style:normal; ';}
        $beskriv= utf8_decode($beskriv);
        if (($beskriv=='generelt') or ($beskriv=='GEBYR') or ($beskriv==':GEBYR')) {} // udskrives ikke. Flag ang. gebyrberegning.
        else if ($art==$varetype)  //  Ordrelinier
          for ($i = 0; $i < $antal; $i++) 
            { textfelt($xa-$dx,$toplin+$i*$afst, $wh/3.5,$feltw, '£'.$beskriv, $style,true,$i==0,true);                       //  1. Ordrelinie
              if ($i==0) textfelt($xa-$dx,$toplin+$i*$afst, $wh/3.5,$feltw, '_', $style.' color:red;',true,$vistools,false);  //  Vis indsætningspunkt
            }
        else {textfelt($xa-$dx,$ya, $wh/3.0,$feltw, $beskriv, $style,true,$vistools);
              textfelt($xa-$dx,$ya, $wh/3.0,$feltw, '_',      $style.' color:red;',true,$vistools,false);  //  Vis indsætningspunkt
        }
    }}  //        x             y                     h         b           Tekst               style
// Demo-TEKSTER:
  // textfelt( 10, 10,  8,190,tolk('@Her demonstreres nogle muligheder, der er til rådighed.'),'text-align:center; font-weight:bold; font:25px times;',true);
  // textfelt( 28, 80,  3,160,'Felt2','font:10px times;');
  textfelt( 80, 160,  0, 40,'<u>FeltA</u> x:80, y:160', 'font-weight:bold; color:Tomato; font:8px times; ',true,'',false);
  textfelt(100, 160,  0, 40,'<u>FeltB</u> x:100, y:160','font-weight:bold; color:blue;   font:16px times;',true,'',false);
  textfelt( 75, 170,  3, 60,'Tekst-Data felters indsætningspunkt vises med rødt <red style="color:red;">_</red> <br>Y-værdier måles fra dokument-top til teksters grundlinie, så ændring af skrift-højde, '.
                            'ikke får tekster til at "hoppe"<br>Tillades fler-linier med style="white-space:pre-wrap;", skal man være klar over at feltet vokser opad hvis $h=0, så det er sidste linie, '.
                            'der er placeret på Y-værdien! Angives derimod $h=3 (linie-højde) fortsætter teksten derimod nedad, til højere Y-værdier.','font:10px times; white-space:pre-wrap; ',true,'',false);
  textfelt( 70, 100,  0, 60,tolk('@KOPI'),'text-align:center; font-weight:bold; color:red; font:60px times; transform: rotate(-35deg);',true,'',true); //   
  // textfelt( 11,120,  4,150,'Felt3','font-style:italic;');
  // textfelt(  5,160,  4,200,'Felt4','text-align:right; transform: rotate(20deg);');
  //  textfelt(-55,180, 10,120,tolk('@Lodret tekst. Rotations-centrum er på objektets center, hvilket betyder at indsætningspunktet skal korrigeres!'),'transform: rotate(-90deg);',true,'',false);
  // textfelt(  0, 40, 40,210+1,'HEADER-område:','font:12px times; border: 0.9px solid #00efef; ',false,'',false);
  // textfelt(  1, 42,205,210,'BODY-område:','font:12px times;');
  // textfelt(  0,297, 50,210+1,'FOOTER-område:','font:12px times; border: 0.9px solid #00efef; ',false,'',false);
  echo '</fieldset>';
  htm_lf();
  $html_buff.= '</body> </html>';
  $fp= fopen("../_temp/printside.htm","w");    if ($fp) { fwrite($fp,$html_buff."\n"); fclose($fp); };  
  textKnap($label='@Se udskrift',  $title='@Se hvad der kan udskrives med CTRL-p', $link='../_temp/printside.htm');
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='@Gem eller opdater',$akey='g');
  //  Ved udskrivning skjules body-elementer omkring A4-papir. Se mere i out_style.css.php stikord: @media print (er ikke testet!)
}
 
######### :SYSTEM:
// Denne funktion benyttes ikke!  Panl_PrintlayoutTXT er bedre kvalitet.
# Kaldes fra:  [_base/page_Startup.php] 
function Panl_Printlayout($filDATA=[],$width=210, $height=297) {    ## out_PanlsSekd.php
//  Grafisk-baseret, virker meget uldent i kanterne!
  function felt($x='', $y='', $h='', $b='', $txt='', $style='',$clean=false,$px='') {  $scale= 1100/297;
    if ($clean) {$bordpx='1';} else {$bordpx='1';}
    $x= $x*$scale;    $y= $y*$scale;    $h= -$h*$scale;    $b= $b*$scale;
    $sty= 'ctx.textAlign="left";';   $fac='';
    dvl_pretty('felt');
    if (strpos($style,'left')>0)    {$sty.= 'ctx.textAlign="left"; ';}
    if (strpos($style,'center')>0)  {$sty.= 'ctx.textAlign="center";';}
    if (strpos($style,'right')>0)   {$sty.= 'ctx.textAlign="right"; ';}
    //  ctx.font = "Bold Italic " + myText.fontSize + "px Arial " + myText["font-family"];
    if (strpos($style,'bold')>0)    {$fac.= 'bold ';}
    if (strpos($style,'italic')>0)  {$fac.= 'italic ';}
    if (!$clean) 
      echo 'ctx.strokeStyle = "#eeeeee"; ctx.strokeRect('.$x.', '.$y.', '.$b.', '.$h.');';
    echo 'ctx.font = "'.$fac.' '.$px.'px sans-serif";  '.$sty.'   ctx.fillText("'.$txt.'", '.$x.', '.$y.'); ';
    //  ctx.textAlign="start";    ctx.fillText("textAlign=start",150,60);   ctx.textAlign="end";

  };
  function grafik_start($width=800, $height=1100) { 
    /* https://www.w3schools.com/tags/ref_canvas.asp */
    echo '<img id="logoimg" style="width:0; height:0; visibility:hidden" src="../_assets/images/saldi-e50x170.png" alt="The logoimg">'; // Udtegnes i canvas!
    echo '<canvas id="myCanvas" width="'.$width.'px" height="'.$height.'px" style="border:1px solid #d3d3d3; background:white; margin-left: 60px; margin-bottom:20px;">';
    echo '<script>';
    echo 'var c = document.getElementById("myCanvas");';
    echo 'var ctx = c.getContext("2d");';
  }
  function grafik_slut() {
    //  echo 'ctx.stroke();';
    echo '</script>';
  }
#+   if (isset($_POST['submit']) && $_POST['submit']) {
     $blanket=  $_POST['blanket'];
     $sidetype= $_POST['sidetype'];
#+   } else $blanket= 3;
   if ($width<=220) $panel= 'panelW960'; else $panel= 'panelW120';
  htm_Panl_Top($name= 'print',$capt= '@Udskrivnings-Layout: DEMO',$parms='#',$icon='fas fa-print',$panel,__FUNCTION__);
  htm_FrstFelt('25%');
    htm_OptioFlt($type='text',  $name='blanket',   $valu= $blanket, 
                    $labl='@Formular',    $titl='@Vælg en Formular som du vil vise',  
                    $revi=true, $optlist= FRM_Liste(),    $action='');
  htm_NextFelt('25%');
    htm_OptioFlt($type='text',  $name='sidetype',   $valu= $sidetype, //='A', 
                    $labl='@Side-layout',    $titl='@Her vælger du visning af udskrifts-side.',  
                    $revi=true, $optlist= [['Første sides layout','F','Første'],['Alle sider','A','Alle'],['Sidste sides layout','S','Sidste']],    $action='');
  htm_NextFelt('50%'); 
    htm_Plaintxt('Opdater med genvejstast: g');
#+    textKnap($label='@Vis/opdater',  $title='@Opdater her hvis du har ændret formular eller side.', $link='#','o');    //  page_Printlayout.php
  htm_LastFelt('');    

  $filDATA= ImportTabFile(realpath($_SERVER["DOCUMENT_ROOT"]). '/saldi-e/_exchange/_standard/formular-utf8.tab');
  $dx= 0;   $graftype= 1;   $txttype= 2;    $varetype= 3;   $x0= 8;   $y0= 6; 
  
  grafik_start($width=800, $height=1100);
  foreach ($filDATA as $rec)  // 3. gennemløb kan måske kombineres med 1.
  { $frm= $rec[0];  $art= $rec[1];  $beskriv= $rec[2];
    if ($beskriv=='generelt') {$toplin=$rec[5]; $antal= $rec[4]; $afst= $rec[6];}  //  Skal benyttes ved Ordrelinier
    if (($frm==$blanket) and ($art==$graftype) and ($rec[12]=$sidetype))
    { $scale= 1100/297; $ybase= 297*$scale;   $wdt=-1;
      $xa= $x0+$rec[4]*$scale;  $ya= $y0+$ybase-$rec[5]*$scale;  $xb= $x0+$rec[6]*$scale;  $yb= $y0+$ybase-$rec[7]*$scale;  $wdt= $rec[8]*$scale/2; $colr= $rec[9];
      if (($wdt==0) and ($rec[2]=='LOGO'))
        echo 'var img=document.getElementById("logoimg");   ctx.drawImage(img,'.$xa.','.$ya.');'; 
      else  
        if ($wdt=1) echo 'ctx.beginPath(); ctx.moveTo('.$xa.','.$ya.'); ctx.lineTo('.$xb.','.$yb.'); ctx.stroke();';
   }}
   
  foreach ($filDATA as $rec)  // 2. gennemløb
  { $frm= $rec[0];  $art= $rec[1];  $beskriv= $rec[2];
    if (($frm==$blanket) and (($art==$txt) or ($art==$varetype)) and ($rec[12]=$sidetype))
    { $feltw= 1.7*strlen($beskriv)+2*$rec[ 8]; 
      $style= '';      $px= $rec[8];
      if ($rec[10]=='Helvetica')  {$font.= 'Helvetica; ';}  else {$font.= 'Times; ';}
      if ($rec[ 8]>0)       {$style.= 'font:'.$px.'px '.$font;}
      if ($rec[ 3]=='H')    {$style.= 'text-align:right; ';  $dx= $feltw;}
      if ($rec[ 3]=='C')    {$style.= 'text-align:center; '; $dx= $feltw/2;}
      if ($rec[ 3]=='V')    {$style.= 'text-align:left; ';   $dx= 0;}
      // Color!
      $colr= $rec[9];
      if ($rec[11]=='on')  {$style.= 'font-weight:bold; ';}  else {$style.= 'font-weight:normal; ';}
      if ($rec[12]=='on')  {$style.= 'font-style:italic; ';} else {$style.= 'font-style:normal; ';}
      $beskriv= utf8_decode($rec[ 2]);
      $dx= 0;
      if (($beskriv=='generelt') or ($beskriv=='GEBYR')) {} // udskrives ikke. Flag ang. gebyrberegning.
      else if ($art==$varetype)  //  Ordrelinier
        for ($x = 0; $x < $antal; $x++) 
           felt($rec[4]-$dx,297-$toplin+$x*$afst, $rec[8]/3.5,$rec[7]+$feltw, '£'.$beskriv, $style,true,$px);
      else felt($rec[4]-$dx,297-$rec[5],          $rec[8]/3.0,$rec[7]+$feltw,     $beskriv, $style,true,$px);
    }}  //        x             y                     h         b           Tekst               style
    
  grafik_slut();

  // echo '<fieldset id="printpage" style="border: 1px solid #8c8b8b; padding:2px; width:'.$width.'mm; height:'.$height.'mm; margin: auto; margin-bottom:20px;'.
  // ' position:relative; background:white;"> <legend><tc><b>'.tolk('@Papir: A4-Portrait').'</b></tc></legend>';

/*   foreach ($filDATA as $rec) // 1. gennemløb - find Ordrelinier
    {if ($beskriv=='generelt') {$toplin=$rec[5]; $antal= $rec[4]; $afst= $rec[6];} }
 */  
/* foreach ($filDATA as $rec)  // 2. gennemløb
  { $frm= $rec[0];  $art= $rec[1];  $beskriv= $rec[2];
    if (($frm==$blanket) and (($art==$txttype) or ($art==$varetype)) and ($rec[12]=$sidetype))
    { $feltw= 1.7*strlen($beskriv)+2*$rec[ 8]; 
      $style= '';
      $px= $rec[8];
      if ($rec[10]=='Helvetica')  {$font.= 'Helvetica; ';}  else {$font.= 'Times; ';}
      if ($rec[ 8]>0)       {$style.= 'font:'.$px.'px '.$font;}
      if ($rec[ 3]=='H')    {$style.= 'text-align:right; ';  $dx= $feltw;}
      if ($rec[ 3]=='C')    {$style.= 'text-align:center; '; $dx= $feltw/2;}
      if ($rec[ 3]=='V')    {$style.= 'text-align:left; ';   $dx= 0;}
      // Color!
      $colr= $rec[9];
      if ($rec[11]=='on')  {$style.= 'font-weight:bold; ';}  else {$style.= 'font-weight:normal; ';}
      if ($rec[12]=='on')  {$style.= 'font-style:italic; ';} else {$style.= 'font-style:normal; ';}
      $rec[ 2]= utf8_decode($rec[ 2]);
      if (($rec[ 2]=='generelt') or ($rec[ 2]=='GEBYR')) {} // udskrives ikke. Flag ang. gebyrberegning.
      else if ($art==$varetype)  //  Ordrelinier
        for ($x = 0; $x < $antal; $x++) 
           felt($rec[4]-$dx,297-$toplin+$x*$afst, $rec[8]/3.5,$rec[7]+$feltw, '£'.trim($beskriv,"'"),$style,true);
      else felt($rec[4]-$dx,297-$rec[5],          $rec[8]/3.0,$rec[7]+$feltw,     trim($beskriv,"'"),$style,true);
    }}  //        x             y                     h         b           Tekst               style
//TEKSTER:
/*   felt( 10, 10,  8,190,tolk('@Her demonstreres nogle muligheder, der er til rådighed.'),'text-align:center; font-weight:bold; font:25px times;',true);
  felt( 28, 80,  3,160,'Felt2','font:10px times;');
  felt( 20, 30,  5,175,'Felt1','font-weight:bold; color:Tomato;');
  felt( 11,120,  4,150,'Felt3','font-style:italic;');
  felt(  5,160,  4,200,'Felt4','text-align:right; transform: rotate(20deg);');
  felt(-55,180, 10,120,tolk('@Lodret tekst. Rotations-centrum er på objektets center, hvilket betyder at indsætningspunktet skal korrigeres!'),'transform: rotate(-90deg);',true);
  felt(  1,  0, 40,210,'HEADER-område:','font:12px times;');
  felt(  1, 42,205,210,'BODY-område:','font:12px times;');
  felt(  1,250, 40,210,'FOOTER-område:','font:12px times;');
 */  
//GRAFIK:
  /* https://www.w3schools.com/tags/ref_canvas.asp */
/* 
  echo '<img id="logoimg" style="width:0; height:0; visibility:hidden" src="../_assets/images/saldi-e50x170.png" alt="The logoimg">'; // Udtegnes i canvas!
  echo '<canvas id="myCanvas" width="800px" height="1100px" style="border:1px solid #d3d3d3;">';
  echo '<script>';
  echo 'var c = document.getElementById("myCanvas");';
  echo 'var ctx = c.getContext("2d");';
  echo 'ctx.beginPath();';
  echo 'ctx.moveTo(20, 20);';
  echo 'ctx.lineTo(20, 100);';
//  echo 'ctx.arcTo(150,20,150,70,50)';   //  Tangerende Bue - saboterer udtegning!
  echo 'ctx.lineTo(200, 220);';
  echo 'ctx.stroke();';
  echo 'ctx.beginPath();  ctx.arc(300,375,50,0,2*Math.PI); ctx.stroke();';            //  Circle
  echo 'var img=document.getElementById("logoimg");    ctx.drawImage(img,200,200);';  //  Billede: Skjult indlæsning af logoimg ovenfor i <img erklæring
  echo '</script>';
 */
//  echo '</fieldset>';
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='@Gem eller opdater',$akey='g');
  //  Ved udskrivning skjules body-elementer omkring A4-papir. Se mere i out_style.css.php stikord: @media print (er ikke testet!)
}
 
 
######### :SYSTEM:
# Kaldes fra:  [_system/page_Licens.php] 
function Panl_Omprogram()   ## out_PanlsSekd.php
{ global $ØProgTitl, $Øprogvers, $DocRev, $Øcopydate, $Øcopyright, $Ødesigner;
  htm_Panl_Top($name= 'omprog',$capt= '@Om SALDI-<small>€</small>:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW480',__FUNCTION__);
  htm_Caption('@Status:');                   htm_nl();
  echo tolk('@Programmet er en videreudvikling af SALDI - det frie, danske økonomisystem, fra Danosoft / saldi.dk.').str_nl(2);
  echo '<i>';
  echo tolk('@Dette program er fri software, som du kan videredistribuere').str_nl(1);
  echo tolk('@og/eller ændre under vilkårene i GNU General Public License,').str_nl(1);
  echo tolk('@som de er offentliggjort af Free Software Foundation;').str_nl(1);
  echo tolk('@enten i licensens version 2 eller enhver senere version.').str_nl(2);
  echo '</i>';
  echo tolk('@Programmet er stadig i udviklings fase....').str_nl(2);
  
  htm_Caption('@TEST udgave af SALDI-€:');  htm_nl();
  echo tolk('@Dette er seneste udviklingsversion.').str_nl(1);
  echo tolk('@Der vil derfor forekomme midlertidige fejl.').str_nl(1);
  echo tolk('@Endvidere vil oversættelsen af fremmed sprog, ikke være ajour.').str_nl(2);
  echo tolk('@Databasen er kun delvist i drift, hvorfor nogle data importeres fra tekstfiler.').' ';
  echo tolk('@Tekst import tager tid, inden data kan vises...'). str_nl(2);
  //  htm_Caption('@Kendte problemer:');  htm_nl();
  //  echo tolk('@Når der er flere tabeller på en side, er der uløste problemer på dem efter den første.'). str_nl(3);

  htm_hr();
  htm_Caption('@Teknik:');  htm_nl();
  echo $ØProgTitl.' - Version '.$Øprogvers.' Dato: '.$GLOBALS['DocNew'].' './* .' - Copyright '.  $Øcopydate.' '.$Øcopyright.' - ' */ tolk('@Design: ').$Ødesigner.'<br>';
  //$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER['HTTP_HOST']";  //  $_SERVER[REQUEST_URI]
  $actual_link = $_SERVER['REQUEST_URI'];
  echo tolk('@Server URL: ').$actual_link;    htm_nl();
  //  Dato/$DocNew fra nyest indlæste include som kalder DocAlder() i out_init.php
  echo tolk('@PHP-version: ').phpversion().' ';                htm_nl();

//$Ødb_Link= dbi_connect('localhost','SaldiAdm','SaldiPas','saldi_prog');
  if (phpversion()!='7.2.8')
    echo tolk('@Database-version: ').mysqli_get_server_info(dbi_connect('localhost','SaldiAdm','SaldiPas','saldi_prog'));   
    echo tolk('@Database-version: ').mysqli_get_server_info(dbi_connect('mysql46.unoeuro.com','ev_soft_dk','M4d73anU8j','ev_soft_dk_db3'));   
  htm_nl();
  echo tolk('@Zend engine version: ') . zend_version();        htm_nl();
  echo tolk('@Apache-version: ').$_SERVER['SERVER_SOFTWARE'];  htm_nl();  //  apache_get_version()
  htm_PanlBund($pmpt='@Gem',$subm=false,$title='@Gem eller opdater',$akey='g');
  //  Ved udskrivning skjules body-elementer omkring A4-papir. Se mere i out_style.css.php stikord: @media print (er ikke testet!)
  
  // var_dump(stream_get_wrappers());
  // phpinfo();  #! Benyttes KUN til fejlfinding! 
  // PHP extension=php_openssl.dll er nødvendig for CVR-opslag
}
 
function Panl_Omregnskab() {global $Øbrugernavn, $regnskab, $regnaar, $db_navn;
  htm_Panl_Top($name= 'omregn',$capt= '@Om regnskabet:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW480',__FUNCTION__);
  htm_Caption('@Aktuelle oplysninger:');                            htm_nl();
  echo tolk('@Du er logget på som bruger:').' '.$Øbrugernavn;       htm_nl(2);
  echo tolk('@Du arbejder på regnskabet:').' '.$regnskab;           htm_nl();
  echo tolk('@og data angår regnskabsåret:').' '.$regnaar;          htm_nl(2);
  echo tolk('@Regnskabet befinder sig i databasen:').' '.$db_navn;  htm_nl(2);
  htm_PanlBund($pmpt='@Gem',$subm=false,$title='@Gem eller opdater',$akey='g');
}
 
######### :SYSTEM:
# Kaldes fra:  [_base/page_Tips.php] 
function Panl_TipsBrug()   ## out_PanlsSekd.php
{
  htm_Panl_Top($name= 'tips',$capt= '@Tips til brugeren:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW480',__FUNCTION__);
  htm_Caption('@TIPS:');                   htm_nl();
  echo tolk('Hvis du klikker med musens højre-tast på navigations knapper eller links-tekster, får du mulighed for at åbne linket i et nyt vindue eller fane, uden at lukke det vindue du er i.').str_nl(2);
  
  htm_Caption('@NAVIGERING i tabeller:');  htm_nl();
  echo ' <data-colrlabl>'.tolk('@Tab-tast').'</data-colrlabl> '.
    tolk('@springer til næste felt.').' <data-colrlabl>'.tolk('@SHIFT Tab-tast').'</data-colrlabl> '.tolk('@springer til forrige felt.').
    '  <data-colrlabl>'.tolk('@CTRL Pil-taster').'</data-colrlabl> '.tolk('@virker måske. ').str_nl(2);
  
  htm_Caption('@SORTERING af tabeller:'); htm_nl();
  echo  tolk('@De tabeller som kun viser data, (ingen redigering) kan du sortere.').str_nl(1);
  echo  tolk('@Du gør det ved at klikke på kolonne overskriften.').str_nl(1);
  //echo  tolk('@Det er kun muligt at sortere på en kolonne ad gangen.').str_nl(2);
  
  htm_Caption('@SØGNING i et vindue:');   htm_nl();
  echo  tolk('@Alle browsere har en søgefunktion, som ofte aktiveres med CTRL&nbsp;+&nbsp;F').str_nl(1);
  echo  tolk('@Med denne kan du finde tekster, selv om de ikke er på den synlige del af vinduet.').str_nl(2);
  
  htm_Caption('@VINDUER:');               htm_nl();
  echo  tolk('@I de fleste nyere browsere kan du:').str_nl(1);
  echo  tolk('@Skifte fuldskærms mode: F11, og udnytte hele skærmens størrelse.').str_nl(1);
  echo  tolk('@Har du svært ved at læse på skærmen, kan du benytte Zoom:').str_nl(1);
  echo  tolk('@Zoom ind/ud: CTRL&nbsp;+&nbsp;/CTRL&nbsp;-&nbsp;').'&nbsp;';
  echo  tolk('@eller med CTRL-musrulleknap').str_nl(1);
  echo  tolk('@CTRL&nbsp;0 nulstiller zoom til 100%').str_nl(2);
  
  htm_Caption('@PANELER:');               htm_nl();
  echo  tolk('@I vinduer, vises data grupperet i paneler:').str_nl(1);
  echo  tolk('@I toppen af panelerne vises 2 symboler yderst til højre.').str_nl(1);
  echo  tolk('@Klikkes på disse, kan du minimere/maksimere visning af indhold af alle paneler.').'&nbsp;';
  echo  tolk('@Klikker du på panel-toppens venstre halvdel, kan du minimere/maksimere visning af indhold af det aktuelle panel.').str_nl(2);
  
  htm_Caption('@Hjælpe tekster:');        htm_nl();
  echo  tolk('@Tekster i felter med skygge (også andre!), indeholder nyttig hjælp.').str_nl(1);
  echo  tolk('@Når du holder musen over disse tekster, vises PopUp med tips.').str_nl(2);
  echo  tolk('@Benytter du trykfølsom skærm uden mus, skal du benytte Chrome browseren, for at få hjælpetekster:'). str_nl();
  echo  tolk('@´Hvil´ fingeren eller musen over teksten med skygge, så popper hjælpetekster op.'). str_nl(2);

  htm_Caption('@Dato-format:');           htm_nl();
  echo  tolk('@Benytter du en browser, der understøtter date-picker, benyttes et dato-format,').' ';
  echo  tolk('@som er bestemt af operativsystemet (Windows/Linux).').str_nl(1);
  echo  tolk('@Hvis du vil ændre dette, skal du derfor indstille det i "Windows-Kontrolpanel-Formater-Dato" '). str_nl(2);
  
  htm_Caption('@Tast-genveje:');          htm_nl();
  echo  tolk('@Er der en brugbar genvejstast for en knap, er den angivet efter knap-teksten med skråskrift.').' ';
  echo  tolk('@Du benytter den ved at taste [Alt]+tast eller [Alt]+[Shift]+tast i de fleste browsere (Kan være deaktiveret!)'). str_nl(2);
/*   Internet Explorer	[Alt] + accesskey	N/A	
Chrome	[Alt] + accesskey	[Alt] + accesskey	[Control] [Alt] + accesskey
Firefox	[Alt] [Shift] + accesskey	[Alt] [Shift] + accesskey	[Control] [Alt] + accesskey
Safari	[Alt] + accesskey
 */
  
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Retur til hovedmenu');
}
 
 
######### :SYSTEM:
# Kaldes fra:  [_base/page_GruppeInfo.php] 
function Panl_GruppeBrug() {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'tips',$capt= '@Tips til bogholderen:',$parms='#',$icon='fas fa-pen-square','panelW480',__FUNCTION__);
  htm_Caption('@Info om grupper:');         htm_nl();
  echo  tolk('@En gruppe er nogle poster, som har nogle fælles data.').str_nl(2);
  echo  tolk('@Der kan f.eks. være tale om rabatter, varer, debitorer, kreditorer...').str_nl(1);
  echo  tolk('@Inden for hver hoved-gruppe, kan der oprettes undergrupper.').str_nl(1);
  echo  tolk('@Er der oprettet grupper, simplificeres tilknytning af alle de ensartede data').str_nl(2);
  echo  tolk('@Her kommer yderligere forklaring... ').str_nl(1);
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Retur til hovedmenu');
}
 
  
######### :SYSTEM:
# Kaldes fra:  [_base/page_GruppeInfo.php] [_base/page_Tips.php] 
function Panl_TipsBogh()   ## out_PanlsSekd.php
{
  htm_Panl_Top($name= 'tips',$capt= '@Tips til bogholderen:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW480',__FUNCTION__);
  htm_Caption('@Regnskabs TIPS:');         htm_nl();
  echo  tolk('@Vent med bogføring, hvis du har udskrevet rykkergebyr... ').str_nl(1);
  echo  tolk('@Det gør det nemmere hvis du vil annullere gebyret.').str_nl(2);
  echo  tolk('@Husk bogføring, i forbindelse med momsafregning...').str_nl(1);
  echo  tolk('@Så er du mere sikker på, ikke at lave kludder i momsen.').str_nl(2);

  htm_Caption('@Sikring af data:');         htm_nl();
  echo  tolk('@Har du lige lavet mange tilføjelser/ændringer i regnskabet,').str_nl(1);
  echo  tolk('@så er det en god ide, at sikre dig dine data lokalt.').str_nl(1);
  echo  tolk('@Gå ind i menuen: System / Sikkerhedskopiering...').str_nl(2);
  //htm_Plaintxt('@TIP angående Beløbsrabat:');  htm_Plaintxt('@Angiv en mindre enhedspris, og 0% rabat, så beregnes en %-rabat svarende til pris-rabatten.');
  htm_Caption('@Rabatgivning:');         htm_nl();
  echo  tolk('@Vil du give beløbsrabat i stedet for %-rabat, så angiv en mindre enhedspris, og 0% rabat, ').str_nl(1);
  echo  tolk('@så beregnes en %-rabat svarende til beløbs-rabatten.').str_nl(2);
  htm_Caption('@Regnskabsår:');         htm_nl();
  echo  tolk('@Husk at der kan kun arbejdes i et regnskabsår ad gangen.').str_nl(1);
  echo  tolk('@Det aktive regnskabsår, indstiller du i:').str_nl(1);
  echo  tolk('@System / Indstillinger 1. / Regnskabsår / Regnskabskort,').str_nl(1);
  echo  tolk('@ved at sætte flueben i Bogføring tilladt.').str_nl(2);
  // https://da.wikipedia.org/wiki/Debet_og_kredit
  htm_Caption('@Begreber:');         htm_nl();
  echo  tolk('@Er du ikke dus med begreberne Debet og Kredit, ').str_nl(1);
  echo  tolk('@så finder du forklaring her: ').str_nl(1);
  echo  ('https://da.wikipedia.org/wiki/Debet_og_kredit').str_nl(2);
  htm_Caption('@Formater:');         htm_nl();
  echo  tolk('@Grundlæggende benytter programmet indstillingerne for data').str_nl(1);
  echo  tolk('@ og tal, de indstillinger, som er valgt i operativsystemet (og evt. browseren).').str_nl(1);
  echo  tolk('@Internt i programmet, gælder for tal: 123.456,78 (internationalt) og for dato: 2018-10-20 (ISO 8601)').str_nl(2);
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Retur til hovedmenu');
}
 
 
######### :SYSTEM:
# DEMO-MODUL;
# Kaldes fra:  [_base/page_News.php] 
function Panl_News() {global $ØlanguageTable, $ØProgTitl;  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'nyheder',$capt= '@Nyheder:',$parms='page_Blindgyden.php',$icon='fas fa-info','panelW960',__FUNCTION__,'','');
  echo '<div style="text-align:center; color:black; "><big><i>'.str_nl().
       tolk('@Her er nogle af de væsentligste nyheder i').' '.$ØProgTitl.'</i></big>'. str_nl(3);

  echo '<div style="text-align:center; color:red; ">'.tolk('@For BRUGEREN:').'</div>'. str_nl(1);
  echo tolk('@Program-betjening kan nu skifte mellem ialt 8 europæiske sprog.'). str_nl(1);
  echo tolk('@Navnet').$ØProgTitl.' '.tolk('@antyder, at det er en europæisk flersproglig version.'). str_nl(2);
  echo tolk('@Brugerfladen er blevet fuldstændigt redesignet.'). str_nl(2);
  echo tolk('@Designet er adaptivt, dvs. det tilpasser sig til smallere skærme.'). str_nl(1);
  echo tolk('@Da tabeller med mange kolonner, kræver en vis bredde, anbefales dog brug af bredere skærme omkring 1100 pixel brede.'). str_nl(2);
  echo tolk('@Alle sider vises nu med en menu-bjælke i toppen, så navigering er mere fleksibel.'). str_nl(2);
  echo tolk('@Data-visning er grupperet i mindre paneler, som nemt kan kombineres i andre sammenhænge.'). str_nl(1);
  echo tolk('@I toppen af hvert panel, findes et hjælpelink, som fører til udvidet hjælp i SALDI-DokuWiki, angående netop dette panels indhold.'). str_nl(1);
  echo tolk('@Paneler kan minimeres/maksimeres, ved at klikke på overskriften. Det kan øge overblikket, ved at skjule uaktuelle data.'). str_nl(2);
  echo tolk('@Cursoren skifter udseende, alt efter hvad musen holdes over, så man kan se, når der er en klik-funktion.'). str_nl(2);
  echo tolk('@Benyttes moderne browsere, benyttes en `date-picker` til dato-indtastninger, og der advares, når passwords indtastes på en usikker forbindelse.'). str_nl(1);
  echo tolk('@Date-picker er ikke tilgængelig i Internet Explorer, Safari og Opera Mini (Ultimo 2017).'). str_nl(2);
  echo tolk('@Formular-redigering, har fået mulighed for WYSIWYG design i LibreOffice, og der er tilføjet nye redskaber, til at vedligeholde layout.'). str_nl(1);
  echo tolk('@Formular-redigering har fået mulighed for at supplere med et "stempel", f.eks: KOPI, som kan udskrives på en selvstændig udskrift. '). str_nl(2);
  echo tolk('@I formular-redigering, kan du nu vælge mellem forskellig papirformater: A3, A4, A5 - høj-/bred-format. '). str_nl(2);
  echo tolk('@Der er tilføjet en integreret funktion for "faktura-service", som kan benyttes til inddatering af leverandør fakturaer.'). str_nl(2);
  echo tolk('@Du kan nu se, hvilke tekster (Felter med skygge), der har hjælpetekster tilknyttet.'). str_nl(2);
  echo tolk('@Der er benyttet farver, til at skelne mellem knappers forskellige funktioner f.eks. GRØN: Navigation.'). str_nl(2);
  echo tolk('@Alle tabeller har stribet baggrund, som gør det lettere at læse sammenhørende data.'). str_nl(2);
  echo tolk('@Tabeller med mange linier, vises i `rulle-vinduer`, med fastlåste kolonneoverskrifter.'). str_nl(2);
  echo tolk('@Benyttelse af ikoner og farver, forbedrer brugerens situations fornemmelse.'). str_nl(2);
  echo tolk('@Brugeren kan nu lave zip-backup af alle programmets system-mapper og undermapper i flere niveauer.'). str_nl(2);

  echo '<div style="text-align:center; color:red; ">'.tolk('@TEKNIK:').'</div>'. str_nl(0);
  echo tolk('@Tabeller sorteres / filtreres lokalt i browseren, så server, database og netværk, ikke belastes.'). str_nl(2);
  echo tolk('@Der er moduler til farvekodet modal-besked (fejl / info / advarsel / tip / succes) til brugeren.'). str_nl(2);
  echo tolk('@Programmet er CSS-baseret, så design nemt kan forandres.'). str_nl(2);
  echo tolk('@Programmet er kompatibelt med PHP 7+, og benytter HTML5 og javascript.'). str_nl(2);
  echo tolk('@Er serveren indstillet til at benytte PHP 7, bliver programmet dobbelt så hurtigt!'). str_nl(2);
  echo tolk('@Sikkerheden omkring passwords (brugere og databaseadgang) er blevet forbedret.'). str_nl(2);
  echo tolk('@Databasen er tilpasset engelsk, tvetydige feltnavne er omdøbt og en udrensning af ubenyttede felter er forberedt.').str_nl(2);
  echo tolk('@Programmes kildekode er blokstrukturet, og er blevet omskrevet, så skærmvisning ').str_nl();
  echo tolk('@og data-behandling er adskilt, og det er blevet meget nemmere at overskue og forstå.'). str_nl(2);
  echo tolk('@En god "bivirkning" af omskrivningen, er at omfanget af ubenyttet kode er blevet minimeret.'). str_nl(2);
  echo tolk('@Det er blevet simplere for programmøren at tilpasse, rette og vedligeholde programmet.'). str_nl(2);
  echo tolk('@Der er adskillige redskaber til programmøren: Debug-tilstand (fejlfinding), Skanning af fraser - som skal oversættes til andre sprog, ').str_nl().
       tolk('@Modulskanning - viser php-filers status, Funktionsskanning - viser hvor funktioner er erklæret.'). str_nl(3).'</div>';
//            '<i><b>'.tolk('@Andet: ').'</b></i>';
  //echo tolk('@Der benyttes Ikoner, Funktioner som ikke er standard samles i: `Tilvalg`, '). str_nl(2);
  //echo '<i>'.tolk(' @¹: Målsætning - Der arbejdes stadig på dette.').'</i>'. str_nl(3).'</div>';
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Retur til hovedmenu');
}
 
######### :SYSTEM:
# DEMO-MODUL;
# Kaldes fra: 
function Panl_Intro() {global $ØlanguageTable;  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'intro',$capt= '@Introduktion:',$parms='page_Blindgyden.php',$icon='fas fa-info','panelWmax',__FUNCTION__);
  echo '<div style="text-align:center;"><big>Velkommen til en demo af SALDI med nyt moderne <b>CSS</b>-baseret <b>responsive</b> design,<br><br>'.
  ' samt <b>sprogunderstøttelse</b> og forberedt for forøget <b>sikkerhed</b> omkring password.</big><br><br>';
  echo 'Herunder demonstreres output-modulerne {out_*.php} og deres benyttelse.<br><br>';
  echo 'Der mangler stadig funktionalitet. Vil du skifte sprog, skal der tilføjes  parameter i URL:<br>';
  echo '&nbsp;&nbsp;&nbsp;<i>/saldi-e/base/page_Layoutdemo.php?sprog=en</i> - Vælger engelsk sprog';
  echo '<br>I tabel for Sprog oversættelse er aktuelt indlæst '.count($ØlanguageTable).' fraser, alle maskinoversat af Google Translate.'; str_nl();
  echo 'Vises en dansk tekst, når du har valgt andet sprog, er det fordi der ikke findes en oversættelse endnu. <br>';
  echo '<br>Benytter du trykfølsom skærm uden mus, skal du benytte Chrome browseren, for at få hjælpetekster:'; str_nl();
  echo '"Hvil" fingeren eller musen over den blå tekst med skygge, så popper hjælpetekster op.';  str_nl();
  echo 'Der er stadig "skønhedsfejl" i forskellige browseres visning. </div>';
  htm_PanlBund($pmpt='@Gem',$subm=false,$title='@Gem');
}

######### :SYSTEM:
# DEMO-MODUL;
# Kaldes fra: 
function Panl_Test()  {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'test', $capt= '@Værd at prøve:', $parms='page_Blindgyden.php',  $icon='fas fa-info',  'panelWmax',__FUNCTION__);
  echo '<div style="text-align:center; font-weight:400"><b>Afprøv CSS og responsive design.</b><br><br>';
  echo 'Variér vinduets bredde og se hvordan layoutet tilpasser sig.<br><br>';
  echo 'I Firevox kan du skifte til testvindue for Responsivt-design-vindue med CTRL-Skift-M.<br><br>';
  echo 'Læg mærke til at der er særlige skift ved vinduesbredderne: 320px, 640px, 960px og max 1200px<br><br>';
  echo 'Hvor der findes skjulte hjælpetekster, er synliggjort med blå tekster i skyggerammer. <br><br>';
  echo '<b>Afprøv ændring af programfladens sprog.</b><br><br>';
  echo '<data-colrlabl>/saldi-e/base/page_Layoutdemo.php?sprog=en</data-colrlabl> - Vælger engelsk<br>';
  echo '<data-colrlabl>/saldi-e/base/page_Layoutdemo.php?sprog=de</data-colrlabl> - Vælger tysk<br>';
  echo '<data-colrlabl>/saldi-e/base/page_Layoutdemo.php?sprog=fr</data-colrlabl> - Vælger fransk<br>';
  echo 'Og de andre:&nbsp;<data-colrlabl>/saldi-e/base/page_Layoutdemo.php?sprog=pl =it =es =tr =da</data-colrlabl> - Vælger polsk/italiensk/spansk/tyrkisk/dansk';
  echo '<br><br><b>Afprøv HTML5 og andre forbedringer.</b><br><br>';
  echo 'Inddatering af datoer i chrome, opera, vivaldi (m.fl.?) : Browseren tilbyder date-picker.<br><br>';
  echo 'Validering af data i input-felter : mail-adresse, password, required, m.fl.<br><br>';
  echo 'Prøv at vælge et password for administrator (Database setup), og se password styrke måleren.</div><br>';
  # /da:Sprog/en:Language/de:Sprache/fr:Langue/tr:Dil/es:Lenguaje
htm_PanlBund($pmpt='@Gem',$subm=false,$title='@Gem');
}

######### :SYSTEM:
# DEMO-MODUL;
# Kaldes fra: 
function Panl_Formaal() {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'formaal',$capt= '@Formål:',$parms='page_Blindgyden.php',$icon='fas fa-info','panelW720',__FUNCTION__);
  echo 'Målsætningen med denne udvikling er:<br>';
  echo '<small><pre>';
  echo '  1. Konsistent modul-opbygget kode, så vedligeholdelse/udvikling bliver nemmere.<br>';
  echo '  2. Fjernelse af inaktiv kode.<br>';
  echo '  3. Hastigheds forøgelse, med fokus på repeterende rutiner. PHP7+ øger med faktor 2!<br>';
  echo '  4. Indførelse af Responsivt design, med moderne/fleksibelt layout.<br>';
  echo '  5. CSS-design, så central ændring af udseende gøres mulig.<br>';
  echo '  6. Udnyttelse af HTML5 forbedringer.<br>';
  echo '  7. Al output til skærm baseres på et nyt bibliotek: out_base.php<br>';
  echo '  8. Sprogvalg for program-fladen, med halv-automatisk vedligeholdelse.<br>';
  echo '  9. Forøge sikkerheden omkring password. Opbevaring og styrkemåler.<br>';
  echo ' 10. Sikre kompatibilitet med PHP7. udgår:{func:Split(), func:ereg_*(), ext:mysql_*}<br>';
  echo '     Mere her: [ https://php.net/manual/en/migration70.php ]<br>';
  echo '     Og her: [ https://www.digitalocean.com/company/blog/getting-ready-for-php-7/ ]<br>';
  echo ' 11. Indførelse af WYSIWYG formular-design.<br>';
  echo ' 12. Layout af source-kode forbedres, så strukturen forstås hurtigere, <br>';
  echo '     og sjuskefejl afsløres.<br>';
  echo ' 13. Bedre program-dokumentation ved øget anvendelse af kommentarer i kildetekster.<br>';
  echo ' 14. Anvende prefix på funktionsnavne, så det afspejler kildefilen. (htm_*, out_*,...)<br>';
  echo ' 15. Afskaffe alle:  PRINT "xxx" - Benyt/opret rutiner i out_*.php<br>';
  echo ' 16. Afskaffe Layout-styring med tabeller, som er forældet metode.<br>';
  echo ' 17. Afskaffe afhængighed af: PDFTK som sjældent er installeret.<br>';
  echo ' 18. Basere formularprint på det aktive open-source projekt TCPDF,<br>     som omdanner HTML til PDF, og som understøtter UTF-8 Unicode.  <br>';
  echo ' 19. Basere tabelhåndtering på det aktive projekt https://github.com/Mottie/tablesorter, <br>     som er jQuery baseret.  <br>';
  echo ' 20. Ændre beskedsystem: fra BODY onLoad=javascript:alert() til CSS/jquery: msg_Dialog <br>';
  echo ' <br>';
  echo 'Ad. 1. samt 4.-8. : Sker med de nye biblioteker: out_*.php<br>';
  echo '  <hr>';
  echo 'HUSK: Benyt subRutiner (Blok-struktur) i stedet for Copy-Paste! <br>';
  echo '      Det øger forståelsen og reducerer begrebsforvirring, <br>';
  echo '      med velvalgte navne og det letter vedligeholdelsen!<br></pre></small>';
  htm_PanlBund($pmpt='@Gem',$subm=false,$title='@Gem');
}

######### :SYSTEM:
# DEMO-MODUL;
# Kaldes fra: 
function Panl_Browsr()  {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'intro',$capt= '@Browsere:',$parms='page_Blindgyden.php',$icon='fas fa-info','panelW320',__FUNCTION__);
  echo '<div style="text-align:center;"><big>Kompatibilitet:</big><br>';
  echo '<b>Testet i Windows 10: </b><br>';
  echo 'Firevox - OK <br>';
  echo 'Opera - OK <br>';
  echo 'Vivaldi - OK <br>';
  echo 'Chrome - OK <br>';
  echo 'Edge - begrænset : <br>';
  echo '<small>Baggrunde!, Tiptekster bag naboobjekter!, KnapForgrund! </small><br>';
  echo '  <hr>';
  echo 'LINUX - ? <br>';
  echo 'Konqueror - ? <br>';
  echo 'Firevox - ? <br>';
  echo 'Opera - ? <br>';
  echo 'Vivaldi - ? <br>';
  echo 'Chrome - ? <br>';
echo '  <hr>';
  echo 'Mac OS:<br>';
  echo 'Safari - ? <br>';
  echo '  <hr>';
  echo 'Explorer 11 - ? <br>';
  echo 'Explorer 10 - ? <br>';
  echo 'Explorer  9 - ? <br>';
  echo '</div>';
  htm_PanlBund($pmpt='@Gem',$subm=false,$title='@Gem');
}

######### :SYSTEM:
# SUB-FUNCTION:
# Kaldes fra: 
function NaviTip() {  ## out_PanlsSekd.php
### NavigationsTip:
global $Ønovice;
  userTip();
  if ($Ønovice)
  echo '<tc><divline style="margin-left:0.5em"><b>'.tolk('@noTIP:').'</b> I tabeller: <data-colrlabl>'.tolk('@Tab-tast').'</data-colrlabl> '.
    tolk('@springer til næste felt.').' <data-colrlabl>'.tolk('@SHIFT Tab-tast').'</data-colrlabl> '.tolk('@springer til forrige felt.').
    '  <data-colrlabl>'.tolk('@CTRL Pil-taster').'</data-colrlabl> '.tolk('@virker også. ').'</divline></tc><br>';
}

######### :SYSTEM:
# SUB-FUNCTION:
# Kaldes fra: 
function TastTip() {  ## out_PanlsSekd.php
### Tips ang. tastaturgenveje:
global $Ønovice;
#+  userTip();
  if ($Ønovice)
  echo '<tc><divline style="margin-left:0.5em"><b>'.tolk('@noTIP:').'</b> <data-colrlabl>'.tolk('@Genvejs-taster').'</data-colrlabl> '.
    tolk('@Når der på nogle knapper, er angivet f.eks. ´x´ betyder det, at der er oprettet en genvejs-tast, som kan benyttes i stedet for at klikke på tasten.').
          '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.
    tolk('@Hvordan du benytter genvejen afhænger af den browser, du bruger! Firevox:[Alt] [Shift] + genvejs-tast.  Mange andre:[Alt] + genvejs-tast.').
    '</divline></tc><br>';
}
######### :SYSTEM:
# Kaldes fra: 
function Tips(){  ## out_PanlsSekd.php
### Tips ang. browser genveje:
  msg_Dialog('tip',ucfirst(tolk('@Retur')),'JavaScript:window.history.back();','','','','',ucfirst(tolk('@Funktionstaster:')),
      tolk('@I de fleste nyere browsere kan du:').'<br><br>'.
      tolk('@Skifte fuldskærms mode: F11').'<br><br>'.
      tolk('@Zoom ind/ud: CTRL+/CTRL- ').'<br>'.
      tolk('eller CTRL-musrulleknap').'<br><br>'
  );
}

######### :SYSTEM:
# Kaldes fra: 
function OmFormularer() {global $Ønovice;  ## out_PanlsSekd.php
  if ($Ønovice) {
    echo '<div style="font-size:x-small">';
    echo tolk('@Formularers største papir format er A4, hvilket vil sige at bredden er max 210 mm og højden max. 297 mm.').' ';
    echo tolk('@Dertil svarer at værdier for X skal ligge i intervallet 1 - 210 mm, og Y skal ligge i intervallet 1 - 297 mm').'<br>';
    echo tolk('@Bredde-placeringer X måles fra papirets venste kant.').'<br>'.tolk('@Højde-placeringer Y, måles fra papirets bund.');
    echo '</div>';
  }
}

######### :SYSTEM:
# SUB-FUNCTION:
# Kaldes fra: 
function XY_forskydning() {  ## out_PanlsSekd.php
  htm_KnapGrup('@Forskydning af alle placeringer:',true,false);
    htm_CombFelt($type='numberL',  $name='xSkyd',  $valu= 0,  $labl='@X-forskydning', // min="0" max="100" step="5"
      $titl='@Vandret forskydning: Angiv positivt tal for at øge, negativt tal for at mindske alle x-placeringer (min=-100 max=100',  
      $revi=true, $rows='', $width='100px',$step='1',$more='min="-100" max="100"');
    htm_Spacer('5');
    htm_CombFelt($type='numberL',  $name='ySkyd',  $valu= 0,  $labl='@Y-forskydning', 
      $titl='@Lodret forskydning: Angiv positivt tal for at øge, negativt tal for at mindske alle y-placeringer (min=-100 max=100', 
      $revi=true, $rows='', $width='100px',$step='1',$more='min="-100" max="100"');
    htm_Spacer('200px ');
    textKnap($label='@Forskyd formular',  $title='@Flyt hele formularens indhold med de angivne x/y-værdier.', $link='../_base/page_Blindgyden.php','','margin-left: 60px;');
    OmFormularer();
  htm_KnapGrup('@Forskydning af alle placeringer:',false);
}

######### :SYSTEM: ######### Slut funktioner angående visninger i menu-gruppen SYSTEM

?>