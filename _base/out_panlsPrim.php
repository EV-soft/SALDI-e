<?php   $DocFil= '../_base/out_PanlsPrim.php';   $DocVer='5.0.0';    $DocRev='2018-09-30';   $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Design af panelers layout. Del-2';
 * Del-2 af redigeringsfilen: '../_base/out_Panls.php'
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
  Oprettet: 2018-06-00 evs - EV-soft    #: Dette bibliotek er udviklet 2016-1018 af EV-soft.
  Ændrings-Log:

  
 * 
 */
DocAlder($DocRev);


######### :FINANS: ######### Start funktioner angående visninger i menu-gruppen FINANS
######### :FINANS:
# Kaldes fra: Panl_Kassekladder
function Panl_KasseRedigering($id='2',$dato='Dato',$ejer='Bogholder',$bemr='Bemærkning 2',$bogf='Bogført',$af='Af')   ## out_PanlsPrim.php
/* DEMO  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */
{global $ØbrwnColor,$ØBtNavBgrd, $ØIconStyle;
  $dkftip=  tolk('@D/K/F feltet benyttes i forbindelse med debitor- og kreditor posteringer.').' '.
            tolk('@Er feltet tomt eller udfyldt med F, betragtes det efterfølgende kontonummer som et Finans konto-nummer.').
            tolk('@Skrives der `d` eller `k`, vil det efterfølgende nummer blive tolket som et Debitor konto-nummer eller et Kreditor konto-nummer.');
  $DKforkl= tolk('@Afhængigt af koden i D/K-kolonnen foran feltet, vil der være tale om en Debitor-, Kreditor- eller Finanskonto');
//  if ($dokument[$y]) print "<td title="klik her for at åbne bilaget: $dokument[$y]"><a href="../includes/bilag.php?kilde=kassekladde&filnavn=$dokument[$y]&bilag_id=$id[$y]&bilag=$bilag[$y]&kilde_id=$kladde_id&fokus=bila$y"> <img style="border: 0px solid" src="../ikoner/paper.png"> </a></td>";
//  else               print "<td title="klik her for at vedhæfte et bilag">          <a href="../includes/bilag.php?kilde=kassekladde&bilag_id=$id[$y]&bilag=$bilag[$y]&ny=ja&kilde_id=$kladde_id&fokus=bila$y">                 <img style="border: 0px solid" src="../ikoner/clip.png">  </a></td>";
  if ($dokument[$y]) {
          $title='@klik her for at åbne bilaget: $dokument[$y]';
          $link='../_base/page_Blindgyden.php'; /* "../includes/bilag.php?kilde=kassekladde&filnavn=$dokument[$y]&bilag_id=$id[$y]&bilag=$bilag[$y]&kilde_id=$kladde_id&fokus=bila$y";    */
          $clip= 'paper.png';
   } else {
          $title='@klik her for at vedhæfte et bilag';  
          $link='../_base/page_Blindgyden.php'; /* "../includes/bilag.php?kilde=kassekladde&bilag_id=$id[$y]&bilag=$bilag[$y]&ny=ja&kilde_id=$kladde_id&fokus=bila$y";  */
          $clip= 'clip.png'; 
  };
  htm_Panl_Top($name= 'kasseform',$capt= tolk('@Kassekladde:').' '.$id.', <small>'.$ejer.'</small>',$parms='page_Blindgyden.php',$icon='fas fa-database','panelWmax',__FUNCTION__);
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content']
      ['@Kladde:',       '40%','text','','left', '@Her er den tekst du angav i kladdens bemærkning-felt',  '@Angiv din bemærkning...', 'Bemærkning 3'], 
      ['@Konto-kontrol:','5em','text','','left', '@Angiv kontonummer for den konto, hvis bevægelser skal kontrolleres',  '@Nummer...'], 
    ),
    $RowPref= array(  #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip' 
      ['PDF',           '2%','text', '' ,['center'],'@I denne kolonne håndterer du PDF-bilag, som er tilknyttet den enkelte postering.',
          '<a href='.$link.'><ic class="fas fa-paperclip"; style="font-size:14px; color:'.$ØBtNavBgrd.';" title="'.
          tolk('@Tilføj eller fjern PDF-bilag til denne post.').'";></ic></a>','placeh']
      ),
    $RowBody= array(
      ['@Bilag.',       '4%','show', '' ,['center'],'@Bilagsnummer tildeles automatisk og fortsættes fra sidst anvendte bilagsnummer fra samme bruger.'.' ','...auto...'],
      ['@Dato',         '8%','date', '' ,['center'],'@Bilagets dato, som automatisk sættes til dags dato, men kan ændres.','fakt.dato'],
      ['@Bilags tekst','27%','text', '' ,['left'],  tolk('@Bilagstekst er frivillig, men det er nyttigt senere at kunne se, hvad de enkelte posteringer drejer sig om.').' ',tolk('@Posterings note...')],
      ['@D/K',          '3%','text', '' ,['center'],$dkftip,'d/k/f'],
      ['@Debet Kt.',    '6%','text', '' ,['center'],tolk('@Debet Kt. er til kontonummeret på den konto, posteringen skal ske på.').' '.$DKforkl,'D-kt'],
      ['@D/K',          '3%','text', '' ,['center'],$dkftip,'d/k/f'],
      ['@Kredit Kt.',   '6%','text', '' ,['center'],tolk('@Kredit Kt. er til kontonummeret på den konto, posteringen skal ske på.').' '.$DKforkl,'K-kt'],
      ['@Faktura nr.',  '7%','text', '' ,['center'],'@Fakturanr. benyttes i forbindelse med debitor- og kreditorposteringer.','Fak...'],
      ['@Beløb',        '7%','text','2d',['right'] ,tolk('@Beløb indeholder det beløb, der skal bogføres. ').'<br>'.
                                                    tolk('Hvis man ved simulering eller anden kontrol opdager, at en linje skal bogføres direkte modsat af, ').
                                                    tolk('@hvad der står i kassekladden, så kan man blot sætte minustegn foran beløbet.').' '.
                                                    tolk('@På den måde bytter kontonumrene i felterne debet og kredit plads, og beløbet bliver igen positivt.'),'...Kr.'],
      ['@Valuta',       '4%','text', '',['center'],'@Valutakode for den valuta, som er benyttet på bilaget.','DKK'],
      ['@Forfald',      '8%','date', '',['center'],'@Beløbets forfalds dato.','YYYY-MM-DD'],
      ['@moms',         '4%','text', '',['center'],'@Uden moms: Angiv 0, hvis der ikke skal beregnes moms. Uden angivelse, benyttes standard moms-sats.','@25%.'],
      ),
    $RowSuff= array(
      ['@Konto saldo',  '5%','text', '',['right'], #'0.000,00<div type= "text" name="saldo" value="00.000,00" width="8%"/>',
            tolk('@Bevægelser og saldo for den konto, som angives ovenfor i Felt: Konto-kontrol.').' <br>'.
            tolk('@Er velegnet til afstemning med bank- og girokonti'),'..auto..'],
      ['@Fortryd',      '3%','text', '',['center'],'@Fortryd postering! Tilbagefør beløbet ved at klikke på ikonen',
            '<a href='.$link.'><ic class="fas fa-undo" style="font-size:14px; color:red;" title="'.tolk('@Tilbagefør denne postering').'"></ic></a>']
      ),
    $data= array(['Bilag','Dato','Tekst','D/K','Debet','D/K','Kredit','FaktNr','Beløb','Valuta','Forfald','Moms'],
      ['Bilag','Dato',    'Tekst',                  'D/K','Debet','D/K','Kredit','FaktNr',  'Beløb',  'Valuta','Forfald','Moms'],
      ['7', '05-02-2012','Indbetaling, Faktura 100',  'F','58000','D','1000',     '100',    '7500.00',  'DKK',''  ,''],
      ['8', '09-02-2012','Indbetaling, Fakt. 101',    'F','58000','D','78960208', '101',    '5250.00',  'DKK',''  ,''],
      ['9', '12-02-2012','Udbetaling',                'F','62100','F','58000',    '',       '12000.00', 'DKK',''  ,''],
      ['10','13-02-2012','Dankort, Malergrosisten',   'K','1001', 'F','58000',    '090043', '950.00',   'DKK',''  ,''],
      ['11','13-02-2012','Overtræksgebyr',            'F','7900', 'F','58000',    '',       '75.00',    'DKK',''  ,''],
      ['12','19-02-2012','Dankort OK Benzin',         'K','1002', 'F','58000',    '87673',  '586.23',   'DKK',''  ,''],
      ['13','21-02-2012','Indbetaling, T Petersen',   'F','58000','D','1000',     '102',    '4250.00',  'DKK',''  ,''],


      ),
    $FilterOn= false,       #  Mulighed for at skjule records med filter.
    $SorterOn= false,       #  Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       #  Mulighed for at oprette en record
    $ModifyRec=true,       #  Mulighed for at ændre data i en row
    $ViewHeight= '350px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
### PanelFooter:
### KnapPanel:
  htm_KnapGrup('@Her kan du:',true,false);
    textKnap($label='@Gem',             $title='@Klik her for at gemme',$link='../_base/page_Blindgyden.php',$akey='g');
    textKnap($label='@Opslag',          $title='@Opslag - din markørs placering angiver hvilken tabel, opslag foretages i',$link='../_base/page_Blindgyden.php',$akey='o');
    textKnap($label='@Bogfør',          $title='@Bogfør - der foretages først en simulering, som du skal bekræfte',$link='../_base/page_Blindgyden.php',$akey='b');
    textKnap($label='@Simuler',         $title='@Simulering af bogføring viser bevægelser i kontoplanen',$link='../_base/page_Blindgyden.php',$akey='s');
    textKnap($label='@Annuller',        $title='@Annuller simulering',  $link='../_base/page_Blindgyden.php',$akey='a');
    textKnap($label='@Kopier',          $title='@Kopier til ny',        $link='../_base/page_Blindgyden.php',$akey='k');
    textKnap($label='@Tilbagefør',      $title='@Tilbagefør postering', $link='../_base/page_Blindgyden.php',$akey='t');
    textKnap($label='@Hent ordrer',     $title='@Henter afsluttede ordrer fra ordreliste',$link='../_base/page_Blindgyden.php',$akey='h');
    textKnap($label='@DocuBizz import', $title='@DocuBizz import',      $link='../_base/page_Blindgyden.php',$akey='d');
    textKnap($label='@Bankimport',      $title='@Importerer bankposteringer eller andre data fra .csv-fil (kommasepareret fil)',$link='../_base/page_Blindgyden.php',$akey='i');
    textKnap($label='@Import',          $title='@Importerer hele kassekladden fra .csv-fil (kommasepareret fil)',$link='../_base/page_Blindgyden.php',$akey='i');
    textKnap($label='@Eksport',         $title='@Eksporter hele kassekladden til .csv-fil (kommasepareret fil)',$link='../_base/page_Blindgyden.php',$akey='i');
    textKnap($label='@Udlign',          $title='@Finder åbne poster, som modsvarer beløb og fakturanummer',$link='../_base/page_Blindgyden.php',$akey='u');
    textKnap($label='@Vis print layout',$title='@Skjul header og footer, og vis tabel i fuld højde, så du kan udskrive kassekladden med CTRL-P', $link='../_base/page_Blindgyden.php');
  htm_KnapGrup('@Her kan du:',false);
  //TastTip();
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :FINANS:
# Kaldes fra:  [_finans/page_Kladdeliste.php] 
function Panl_Kassekladder($DATA= array())  ## out_PanlsPrim.php
{ dvl_ekko(' Panl_Kassekladder ');
  htm_Panl_Top($name= 'naviform',$capt= '@Oversigt over kassekladder:',$parms='page_Blindgyden.php',$icon='fas fa-list','panelW720',__FUNCTION__);
  htm_Table($TblCapt= array(['@Her kan du vælge blandt', '15%', 'html', '', 'left','@Vælg en kladde, og se den i panelet nedenfor.', '@oprettede kladder']), #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:Just',          '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
    $RowPref= array(),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[FeltJust_mm]', '5:ColTip', '6:placeholder','7:default','8:select'],
         ['@Id',          '5%', 'indx', '',   ['center'], '@Systemoprettet løbenummer','..auto..'],
         ['@Oprettet',   '08%', 'date', '',   ['center'], '@Dato for kladdens oprettelse','YYYY-MM-DD'],
         ['@Ejer',       '10%', 'text', '',   ['left'  ], '@Den der har oprettet kladden','Ejer...'],
         ['@Bemærkning', '50%', 'text', '',   ['left'  ], '@Tekst der beskriver kladden','Bem...'],
         ['@Bogført',    '08%', 'date', '' ,  ['center'], '@Bogført dato','YYYY-MM-DD'],
         ['@Af',          '5%', 'text', '',   ['center'], '@Bruger der har bogført','Af...'],
         ['@Status',      '5%', 'text', '',   ['center'], '@B:Bogført / S:Simuleret','..auto..']
    ),
    $RowSuff= array(),
    $DATA=    array(
         ['1','Dato','Ejer','Bemærkning 1','Bogført-dato','ej','B'],
         ['2','Dato','Ejer','Bemærkning 2','Bogført-dato','ej','B'],
         ['3','Dato','Bogholder','Bemærkning 3','-','bh','S']
    ),
    $FilterOn= true,       #  Mulighed for at skjule records med filter.
    $SorterOn= true,       #  Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       #  Mulighed for at oprette en record
    $ModifyRec=true,       #  Mulighed for at ændre data i en row
    $ViewHeight= '160px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );                                      

  htm_Plaintxt('Klik på Id-nummeret, for at vise den kladde, du vil redigere...');
  htm_PanlBund($pmpt='@Gem',$subm=true);
  htm_nl();
  
  Panl_KasseRedigering($DATA[2][0],$DATA[2][2]);
//  Panl_FootMenu($doPrint=true, $doErase=true, $doLookUp=true, $doAccept=true, $doExport=true, $doImport=true, 
//    $OpslLabl='@Opslag: markørens placering bestemmer, hvilken tabel opslag skal foretages i');
}

######### :FINANS:
# Kaldes fra:  [_finans/page_Budget.php] 
function Panl_Budget( &$DATA, $regnskabsaar='2018', $maanedantal=12, $startaar=2018, $startmaaned=1)   ## out_PanlsPrim.php
{ global $ØtblRowLgt;
  htm_Panl_Top($name= 'budgform',$capt= tolk('@Budget ').' '.($regnskabsaar+0).':',$parms= 'Panl_Erdusikker()',$icon='fas fa-list','panelWmax',__FUNCTION__);
### "InfoFelter" over kolonne-labels:
      htm_FrstFelt( '5%'); 
      #htm_NextFelt('10%');  echo tolk('@Nyt budget:');  //  '@ +/- 0% OK', '@Pct. korrektion'
      htm_NextFelt('10%');  htm_CentHead(tolk('@Opret automatisk budget:')); //echo tolk('@Nyt budget:');  //  '@ +/- 0% OK', '@Pct. korrektion'
      htm_NextFelt('8%');   htm_CombFelt($type='number',  $name='pct', $valu= 0,   
                                         $labl='@% Korrektion',  
                                         $titl='@Angiv en +/- pct-sats, som der skal justeres op/ned med', 
                                         $revi=true, $rows='2',$width='44px',$step='1');
      htm_NextFelt('30%');  textKnap($label='@Udfyld beløbstal, på grundlag af sidste års budget-tal',  
                                          $title=tolk('@Automatisk budgetlægning på grundlag af sidste års regnskab, korrigeret med den angivne pct. sats!').'<br>'.
                                          tolk('@ADVARSEL: Alle nuværende beløb overskrives! Gem ikke, hvis det er en fejl.'),$link='../_base/page_Blindgyden.php','','','tooltipB');
      htm_NextFelt('35%');  htm_RadioGrp($type='hori',  $name='krvis',  $labl='@Beløbsvisning:', $titl='@Vælg visnings nøjagtighed for budget beløb', 
                            $optlist= array(['kr','@Hele kroner','@eller',true],['tusind','@Kun tusinder','']),$action='');
      htm_LastFelt();    
### Gør $RowBody klar:
  //  periodeoverskrifter benytter: ['@'.$periode_kort, '4%','text',$outFormat, ['right','','font-style:italic; '], '@'.$periode_lang,'']
  $MdTitles= periodeoverskrifter($maanedantal, $startaar, $startmaaned, 1, "regnskabsmaaned", $regnskabsaar);  
  $RowBody= array();  #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
  array_push($RowBody, 
      ['@Konto',     '4%','','data',  'center', '@Kontonummer. Entydig nummerkode, som benyttes til sortering, summering mv.','@Konto...'],
      ['@Kontonavn','22%','','data',  'left',   '@Kontonavn - beskrivende tekst','']
    );
  foreach ($MdTitles as $Md) array_push($RowBody, $Md); // FIXIT: beløbene kan ikke redigeres! ?
  array_push($RowBody, ['@I alt',  '5%','text','2d', ['right'], '@Budgetårets aktuelle ultimo beløb.','']);
  $RowBody= array();  #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
  array_push($RowBody, 
      // ['@Id.',           '0%','hidd','',['center'],'@Index','serial...'],
      ['@Konto',     '4%','data','', ['center',$ØtblRowLgt,'',''], '@Kontonummer. Entydig nummerkode, som benyttes til sortering, summering mv.','@Konto...'],
      ['@Kontonavn','22%','html','', ['left'  ], '@Kontonavn - beskrivende tekst','@Navn...'],
      ['@Type',      '0%','hidd','', ['center'], '@Kontotype: D=Drift, S=Status, Z=Sum, H=Overskrift, R=Resultat, X=Sideskift, L=Lukket'],  //  Angår styring af layout i tabelvisning
      ['@Moms',      '0%','hidd','', ['left'  ], '@Momskode: K_:Købs... S_:Salgs... Y_:Ydelses..., E_:Europæisk..., ','@Moms...'],
      ['@Σ FraKto',  '0%','hidd','', ['center'], '@Summér fra_konto. Angiv laveste kontonummer, som skal med i sammentællingen. Angår kun sum-konti, type Z','@Fra...'],
      ['@Valuta',    '0%','hidd','', ['left'  ], '@Valuta kode','@Valu...','',true],
      ['@Saldo',     '0%','hidd','', ['center'], '@Kontoens saldo. beregnet beløb','..calc..'],
      ['@Genvej',    '0%','hidd','', ['center'], '@Genvejs tast, angiv et bogstav','@Genv...']
    );
  //  periodeoverskrifter benytter: ['@'.$periode_kort, '4%','text',$outFormat, ['right','','font-style:italic; '], '@'.$periode_lang,'']
  $MdTitles= periodeoverskrifter($maanedantal, $startaar, $startmaaned, 1, "regnskabsmaaned", $regnskabsaar,$outFormat='0d');  
  foreach ($MdTitles as $Md) array_push($RowBody, $Md);
  array_push($RowBody, ['@I alt',  '5%','text','0d', ['right'], '@Budgetårets aktuelle ultimo beløb.','']);
  htm_Table(
   $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        // ['@Udfyld med sidste års tal, korrigeret med:', '10%','show','','left', '@ +/- 0% OK', '@Pct. korrektion']
        [' ','5%','text','show','right','','','Info:']
      ),
   $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      ),
   $RowBody,//= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
   //   ),
   $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
      ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON]
   $DATA, //=   array(
      //  ),
   $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
   $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
   $CreateRec=false,       # Mulighed for at oprette en record
   $ModifyRec=true,       # Mulighed for at ændre data i en row
   $ViewHeight= '700px',  # Højden af den synlige del af tabellens data
    __FUNCTION__,
    $Kriterie= ['BUDGET']
  );
#### KnapPanel:
  htm_hr();
  htm_CentrOn();
    textKnap($label='@Vide mere?',  $title='@Her kan du tilpasse forventede månedlige beløb. Hvis du vil ændre konti, gør du det her: Menu\SYSTEM\Kontoplan.',$link='',$akey='v');
    naviKnap($label='@Retur til Regnskab',  $title='@Vend tilbage til regnskab',$link='../_finans/page_Regnskab.php',$akey='r');
    //  naviKnap($label='@Retur til Hovedmenu', $title='@Vend tilbage til programmets hovedmenu',$link='../_base/page_Hovedmenu.php',$akey='h');
    textKnap($label='@Vis print layout',    $title='@Skjul header og footer, og vis tabel i fuld højde, så du kan udskrive budgettet med CTRL-P', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Exporter til fil',    $title='@Dan en cvs-fil, som du kan downloade og gemme lokalt', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Importer fra fil',    $title='@Overskriv nuværende budget, med et som tidligere er blevet exporteret og gemt lokalt', $link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='@Gem hele budgettet.',$akey='g');
}
######### :FINANS:
# Kaldes fra:  [_finans/page_Kontrol.php] [_finans/page_Rapport-fin.php] 
function Panl_RapportFinans($Aar_Liste='', $Art_Liste='', $somfakt='', $Knt_Liste='')   ## out_PanlsPrim.php
{global $Ø_MdrList, $Ø_DagList, $Ø_ArtList; // oprettet i ../_base/out_base.php
  set_FormVars(['regnaar','afdeling','rapptype','findatefra','findatetil','ListFra','ListTil','medlagr','RappFra','RappTil']);  // Opdater alle variabler på form 'rappform' :
  
  $Aar_Liste= Aar_Liste();
  $Knt_Liste= MakeDriftsKonti();
  if (isset($_POST['rapptype'])) $rapptype= $_POST['rapptype'];
  
  htm_Panl_Top($name= 'rappform',$capt= '@Finansrapport:',$parms='../_finans/page_Rapport-fin.php?job='.$rapptype, $icon='fas fa-chart-line','panelW320',__FUNCTION__); //  ../_base/page_Hovedmenu.php
  htm_FrstFelt('25%');    htm_CombList($name='regnaar',  $valu= $_SESSION['regnaar'], $labl='@Regnskabsår',
                                       $titl='@Der kan kun rapporteres inden for et regnskabsår, hvilket angives her.', $liste= $Aar_Liste);
  htm_NextFelt('25%');    textKnap(    $label='@Opdatér',    
                                       $title='@Opdater her efter en rettelse af regnskabsår',$link='../_base/page_Blindgyden.php');
  htm_NextFelt('50%');    htm_CombList($name='afdeling', $valu= $_SESSION['afdeling'], $labl='@Afdeling',
                                       $titl='@Her vælges hvilken afdeling rapporten skal omfatte', $liste= Afd_Liste()); # $Ø_ArtList
  htm_LastFelt();
  htm_FrstFelt('20%');   
  htm_NextFelt('80%');    htm_CheckFlt($type='checkbox', $name='medlagr',        $valu= $_SESSION['medlagr'], $labl='@Medtag lagerbevægelser',  
                                      $titl='@Afmærk her, hvis lagerbevægelser skal medtages.',  $revi=true);
  htm_LastFelt();
  if ($rapptype=='momsangivelse') msg_Tip($title="@Om momsafregning", $messg=
              tolk('@Husk at det er en god ide at bogføre med udgangen af MOMS regnskabs perioden, så konto:').' <br>'.
              tolk('@66100&nbsp;Salgsmoms og 6600&nbsp;Købsmoms er opdateret inden indberetning.'));
  htm_hr();
  echo '<captlabl>';  
		htm_FrstFelt('50%');  echo tolk('@Periode fra:');
		htm_NextFelt('50%');  echo tolk('@Periode til:');
		htm_LastFelt(); 
  echo '</captlabl>';
  htm_FrstFelt('50%');    htm_CombFelt($type='date',  $name='findatefra',  $valu= $_SESSION['findatefra'],  $labl='@Periode start', 
                                       $titl='@Dato for rapportens påbegyndelse', $revi=true);
  htm_NextFelt('50%');    htm_CombFelt($type='date',  $name='findatetil',  $valu= $_SESSION['findatetil'],  $labl='@Periode slut',  
                                       $titl='@Dato for rapportens afslutning',   $revi=true);
  htm_LastFelt();
  htm_FrstFelt('50%');    htm_CombList($name='ListFra', $valu= $_SESSION['ListFra'], $labl='@Fra konto', 
      $titl='@Første konto nummer, som medtages i rapporten',$liste= $Knt_Liste, $more=' max-width:150px; KtInterval');
  htm_NextFelt('50%');    htm_CombList($name='ListTil', $valu= $_SESSION['ListTil'], $labl='@Til konto', 
      $titl='@Sidste konto nummer, som medtages i rapporten',$liste= $Knt_Liste, $more=' max-width:150px; KtInterval');
  htm_LastFelt();
  htm_Accept($labl='@Benyt det', $title='@Godkend dine valg, så de benyttes ved rapportdannelse', $width='',$akey='b',$form='rappform');
  //  htm_hr();
  //  htm_CombList($name='rapptype', $valu= $_SESSION['rapptype'], $labl='@Rapporttype',
  //                                       $titl='@Her vælges blandt de i programmet opsatte rapporttyper', $liste= Art_Liste(),' max-width:150px; '); # $Ø_ArtList
  //  htm_Accept($labl='@Vis rapport', $title='@Dan rapport med de ovenfor valgte kriterier<br>Virker først efter 2 klik, når rapportype er ændret !', $width='',$akey='v',$form='rappform');
    htm_KnapGrup('@Vis:',true);
    textKnap($label='@Kontokort med moms', $title= '@Kontospecifikation fra valgte momsbelagte konti i valgt periode. Viser moms for posteringer hvor momsen er trukket automatisk.',     
                                          $link=  '../_finans/page_Rapport-fin.php?job=kontokort_moms', $akey='K');
    textKnap($label='@Kontokort',         $title= '@Kontospecifikation alle valgte konti i valgt periode.',     
                                          $link=  '../_finans/page_Rapport-fin.php?job=kontokort',      $akey='k');    
    textKnap($label='@Balance',           $title= 'Saldo for statuskonti og summering af disse for valgte konti i valgt periode.',      
                                          $link=  '../_finans/page_Rapport-fin.php?job=balance',        $akey='B');
    textKnap($label='@Resultat/Budget',   $title= '@Saldo for driftkonti + budgettal og summering af disse for valgte konti i valgt periode og sat i relation til budgettal.', 
                                          $link=  '../_finans/page_Rapport-fin.php?job=resultatb',      $akey='s');
    textKnap($label='@Resultat',          $title= '@Saldo for driftkonti og summering af disse for valgte konti i valgt periode.',                 
                                          $link=  '../_finans/page_Rapport-fin.php?job=resultat',       $akey='r');
    textKnap($label='@Budget',            $title= '@Saldo for driftkonti + budgettal og summering af disse for valgte konti i valgt periode.', 
                                          $link=  '../_finans/page_Rapport-fin.php?job=budget',         $akey='b');
    textKnap($label='@Momsangivelse',     $title= '@Saldo for momskonti og summering i valgt periode.',                 
                                          $link=  '../_finans/page_Rapport-fin.php?job=momsangivelse',  $akey='M');
    textKnap($label='@Periodeangivelser', $title= '@MOMS Listeangivelsesfil, som kan lægges op via SKATs hjemmeside', 
                                          $link=  '../_finans/page_Rapport-fin.php?job=periodeliste',   $akey='P');
  htm_KnapGrup('@Vis:',false);
htm_KnapGrup('@Andre:',true);
    textKnap($label='@Kontrolspor',  $title='@Vilkårlig søgning i transaktioner. Her kan du spore datas oprindelse',  $link='../_finans/page_Kontrol.php');    
    textKnap($label='@Provision',    $title='@Rapport over medarbejdernes provisionsindtjening', $link='../_finans/page_Provisionsrapport.php');
  htm_KnapGrup('@Vis:',false);
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Luk og gå retur til hovedmenu');
  dev_show();
}

######### :FINANS:
function FinaRappTop($rapp='') {
  htm_FrstFelt('40%');  htm_DataFelt('@Rapport:',$rapp);
  htm_NextFelt('30%');  htm_DataFelt('@Afdeling:',tolk(ListLookup(Afd_Liste(),$search= $_SESSION['afdeling'],$colsearch=1,$colresult=0)));
  htm_NextFelt('30%');  htm_DataFelt('@Lagerbevægelser:',$_SESSION['medlagr']);
  htm_LastFelt();
  htm_FrstFelt('30%');  htm_DataFelt('@Regnskab:',$regnskab='DEMO',''); 
  htm_NextFelt('10%');  htm_DataFelt('@Periode:','','right'); 
  htm_NextFelt('20%');  htm_DataFelt('@Fra:',$_SESSION['findatefra']);
  htm_NextFelt('40%');  htm_DataFelt('@Til:',$_SESSION['findatetil']);
  htm_LastFelt();
  htm_FrstFelt('30%');  htm_DataFelt('@Regnskabsår:',$_SESSION['regnaar']);
  htm_NextFelt('10%');  htm_DataFelt('@Konti:','','right'); 
  htm_NextFelt('20%');  htm_DataFelt('@Fra:',$_SESSION['ListFra']);
  htm_NextFelt('40%');  htm_DataFelt('@Til:',$_SESSION['ListTil']);
  htm_LastFelt();
}

######### :FINANS:
function Panl_RapportKontokort() {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'rappformkort',$capt= '@Rapport - kontokort:',$parms='../_base/page_Blindgyden.php',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  FinaRappTop('KONTOKORT');
#  htm_FrstFelt('30%');  htm_DataFelt('@Rapport:','KONTOKORT');
#  htm_NextFelt('30%');  htm_DataFelt('@Navn:','Bogfør');
#  htm_NextFelt('40%');  htm_DataFelt('@Afdeling:','Test');
#  htm_LastFelt();
  htm_hr();
  htm_Table(
    $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
      ),
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Dato',   '11%','date','',  ['center'],'@Posteringens dato',''],
        ['@Bilag',   '4%','show','',  ['center'],'@Bilags nummer','@nr...'],
        ['@Tekst',  '38%','show','',  ['left'  ],'@Tekst','@txt...'],
        ['@Debet',  '11%','show','2d',['right' ],'@Debet','0.00'],
        ['@Kredit', '11%','show','2d',['right' ],'@Kredit','0.00'],
        ['@Saldo',  '12%','show','2d',['right' ],'@Saldo','0.00'],
      ),
    $RowSuff= array(
      ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
    //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $TablData= array( # DemoData:
        ['::',' ','1000 : Udført arbejde : S1',' ',' ',' '],
        [':.',' ','Primosaldo',' ',' ','0'],
        ['Dato','1','Tekst','','',''],
        ['Dato','2','Tekst','','',''],
        ['::',' ','1100 : Varesalg DK : S1',' ',' ',' '],
        [':.',' ','Primosaldo',' ',' ','0'],
        ['Dato','1','Tekst','','',''],
        ['Dato','5','Tekst','','',''],
        ['Dato','6','Tekst','','',''],
        ['::',' ','2100 : Varekøb i DK : K1',' ',' ',' '],
        [':.',' ','Primosaldo',' ',' ','0'],
        ['Dato','7','Tekst','','',''],
        ['Dato','8','Tekst','','','']
      ),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,       # Mulighed for at oprette en record
    $ModifyRec=false,       # Mulighed for at ændre data i en row
    $ViewHeight= '400px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__,
    $Kriterie= ['RAPPORT']
  );
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}

######### :FINANS:
function Panl_RapportKontokortMm() {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'rappformMm',$capt= '@Rapport - kontokort med moms:',$parms='../_base/page_Blindgyden.php',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  FinaRappTop('KONTOKORT med moms');
  htm_hr();
  htm_Table(
    $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
      ),
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Dato',   '11%','date','',  ['center'],'@Posteringens dato',''],
        ['@Bilag',   '4%','show','',  ['center'],'@Bilags nummer','@nr...'],
        ['@Tekst',  '38%','show','',  ['left'  ],'@Tekst','@txt...'],
        ['@Beløb',  '11%','show','2d',['right' ],'@Debet','0.00'],
        ['@Moms', '11%','show','2d',['right' ],'@Kredit','0.00'],
        ['@Incl. moms',  '12%','show','2d',['right' ],'@Saldo','0.00'],
      ),
    $RowSuff= array(
      ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
    //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $TablData= array( # DemoData:
        ['::',' ','1000 : Udført arbejde : S1',' ',' ',' '],
        [':.',' ','Primosaldo',' ',' ','0'],
        ['Dato','1','Tekst','','',''],
        ['Dato','2','Tekst','','',''],
        ['::',' ','1100 : Varesalg DK : S1',' ',' ',' '],
        [':.',' ','Primosaldo',' ',' ','0'],
        ['Dato','1','Tekst','','',''],
        ['Dato','5','Tekst','','',''],
        ['Dato','6','Tekst','','',''],
        ['::',' ','2100 : Varekøb i DK : K1',' ',' ',' '],
        [':.',' ','Primosaldo',' ',' ','0'],
        ['Dato','7','Tekst','','',''],
        ['Dato','8','Tekst','','','']
      ),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,       # Mulighed for at oprette en record
    $ModifyRec=false,       # Mulighed for at ændre data i en row
    $ViewHeight= '400px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__,
    $Kriterie= ['RAPPORT']
  );
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}

######### :FINANS:
function Panl_RapportBalance() {  ## out_PanlsPrim.php   $regnaar, $afdeling, $rapptype, $ListFra, $ListTil
  htm_Panl_Top($name= 'rappformbal',$capt= '@Rapport - Balance:',$parms='../_base/page_Blindgyden.php',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  FinaRappTop('BALANCE');
  htm_hr();
  htm_Table(
    $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
      ),
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Konto',      '08%','show','col2',['center'],'@Konto nummer i kontoplanen',''],
        ['@Tekst',      '54%','show','',    ['left'  ],'@Tekst','@txt...'],
        ['@I perioden', '14%','show','2d',  ['right' ],'@Opgjort for perioden','0.00'],
        ['@År til dato','14%','show','2d',  ['right' ],'@Opgjort fra årets begyndelse til dags dato','0.00'],
      ),
    $RowSuff= array(
      ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
    //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $TablData= array( # DemoData:   $feltFlags betydning: '::' 1.HeadLine   ':.' Efterflg. HeadLine   ':=' SumLinie
        ['::STATUS',' ',' ',' '],
        ['::AKTIVER:',' ',' ',' '],
        ['::IMMATERIELLE ANLÆGSAKTIVER',' ',' ',' '],
        [':.(Patenter, rettigheder, goodwill, udviklingsprojekter under udførelse mv.)',' ',' ',' '],
        ['::MATERIELLE ANLÆGSAKTIVER',' ',' ',' '],
        [':.(Inventar, bygninger, maskiner mv.)',' ',' ',' '],
        ['50910','Tilgang i året drift/inventar','16000.00','16000.00'],
        [' ','Anlægsaktiver','16000.00','16000.00'],
        ['::LIKVIDE BEHOLDNINGER',' ',' ',' '],
        ['58000','Bank','3388.77','3388.77'],
        [':=Likvide beholdninger i alt ','','3388.77','3388.77'],
        [':=OMSÆTNINGSAKTIVER I ALT','','3388.77','3388.77'],
        [':=AKTIVER I ALT','','19388.77','19388.77'],
        ['::PASSIVER',' ',' ',' '],
        ['::EGENKAPITAL',' ',' ',' '],
        ['62100','Hævet kontant i virksomheden','12000.00','12000.00'],
        [':=Egenkapital','','12000.00','12000.00'],
        ['::LANGFRISTET GÆLD (over 1 år)',' ',' ',' '],
        ['::KORTFRISTET GÆLD (under 1 år)',' ',' ',' '],
        ['::SKYLDIGE OMKOSTNINGER',' ',' ',' '],
        ['::Løn',' ',' ',' '],
        ['::Forudbetalinger',' ',' ',' '],
        ['65100','Kreditorer, ubetalte regninger','-20752.77','-20752.77'],
        [':=Kreditorer','','-20752.77','-20752.77'],
        [':=SKYLDIGE OMKOSTNINGER I ALT','','-20752.77','-20752.77'],
        ['::SKYLDIG MOMS',' ',' ',' '],
        ['66100','Salgsmoms','-3400.00','-3400.00'],
        ['66200','Købsmoms','4340.55','4340.55'],
        [':=Skyldig moms i alt','','940.55','940.55'],
        [':=KORTFRISTET GÆLD I ALT','','-19812.22','-19812.22'],
        [':=PASSIVER I ALT','','-7812.22','-7812.22'],
        [':=Balancekontrol','','11576.55','11576.55'],
       ),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,       # Mulighed for at oprette en record
    $ModifyRec=false,       # Mulighed for at ændre data i en row
    $ViewHeight= '400px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__,
    $Kriterie= ['RAPPORT']
  );
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}

######### :FINANS:
function Panl_RapportMomsangivelse() {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'rappformang',$capt= '@Rapport - Momsangivelse:',$parms='../_base/page_Blindgyden.php',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  FinaRappTop('MOMSANGIVELSE');
#  htm_FrstFelt('50%');  htm_DataFelt('@Rapport:','MOMSANGIVELSE');
#  htm_NextFelt('30%');  htm_DataFelt('@Regnskab:',$regnskab='DEMO',''); 
#  htm_NextFelt('20%');  htm_DataFelt('@CVR:','########',''); 
#  htm_LastFelt();
#  htm_FrstFelt('30%');  htm_DataFelt('@Regnskabsår:','1. 2017'); 
#  htm_NextFelt('10%');  htm_DataFelt('@Periode:','',''); 
#  htm_NextFelt('30%');  htm_DataFelt('@Fra:','1. januar',''); 
#  htm_NextFelt('30%');  htm_DataFelt('@Til:','31. december',''); 
#  htm_LastFelt();
  htm_hr();
  htm_Table(
    $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
      ),
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Konto',              '11%','show','',  ['center'],'@Konto nummer i kontoplanen',''],
        ['@Angår',              '61%','show','',  ['left'  ],'@Kontoens benævnelse',''],
        ['@Indgående afgifter', '14%','show','2d',['right' ],'@Moms, skat og afgifter på virksomhedens indkøb','0.00'],
        ['@Udgående afgifter',  '14%','show','2d',['right' ],'@Moms, skat og afgifter på virksomhedens salg','0.00'],
      ),
    $RowSuff= array(
      ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
    //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $TablData= array( # DemoData:
        ['66100','Salgsmoms',' ','3400.00'],
        ['66150','Moms af varekøb i udlandet',' ','0.00'],
        ['66155','Moms af ydelseskøb i udlandet med omvendt betalingspligt',' ','0.00'],
        ['66160','Olieafgift','0.00',' '],
        ['66170','Elafgift','0.00',' '],
        ['66180','Vandafgift','0.00',' '],
        ['66200','Købsmoms','4341.00',' '],
        [':=','Afgiftsbeløb i alt',' ','-941.00']
      ),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,       # Mulighed for at oprette en record
    $ModifyRec=false,       # Mulighed for at ændre data i en row
    $ViewHeight= '400px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__,
    $Kriterie= ['RAPPORT']
  );
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}


######### :FINANS:
function Panl_RapportPeriodeliste() { global $Ø_MdrList, $Ø_KvtList;
  htm_Panl_Top($name= 'rappformper',$capt= '@Rapport - Moms Periodelister:',$parms='../_base/page_Blindgyden.php',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  FinaRappTop('Indberetning til SKAT');
  htm_FrstFelt('40%');  htm_DataFelt('@CVR:','########',''); 
  htm_NextFelt('30%');  htm_Caption('@Liste valg:'); 
  htm_NextFelt('30%');  htm_CombList($name='perio',$valu='perio',$labl='@Periode',
                                     $titl='@Her vælges hvilken periode, rapporten skal omfatte', $liste= array_merge($Ø_KvtList,$Ø_MdrList));
  htm_LastFelt();
  htm_hr();
  htm_Caption('Her arbejdes...');
  htm_nl(3);
  
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}
######### :FINANS:
function Panl_RapportBudget() {
  htm_Panl_Top($name= 'rappformbud',$capt= '@Rapport - Budget:',$parms='../_base/page_Blindgyden.php',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  FinaRappTop('BUDGET');
  htm_hr();
  htm_Caption('Her arbejdes...');
  htm_nl(3);
  
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}

######### :FINANS:
function Panl_RapportResultatBudget() {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'rappformres',$capt= '@Rapport - Resultat/budget:',$parms='../_base/page_Blindgyden.php',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  FinaRappTop('RESULTAT/BUDGET');
  htm_hr();
  htm_Table(
    $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
      ),
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Konto',    '10%','show','col2', ['center'],'@Konto nummer i kontoplanen',''],
        ['@Angår',    '48%','show','',     ['left'  ],'@Konto benævnelse',''],
        ['@Perioden', '15%','show','2d',   ['right' ],'@Bogførte beløb i perioden','0.00'],
        ['@Budget',   '15%','show','2d',   ['right' ],'@Beløb fra budget','0.00'],
        ['@Afvigelse','12%','show','2%',   ['right' ],'@Afvigelse fra budget beløb','%'],
      ),
    $RowSuff= array(
      ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
    //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $TablData= array( # DemoData:
        ['::RESULTATOPGØRELSE',' ',' ',' ',' '],
        ['::OMSÆTNING:',' ',' ',' ',' '],
        ['1000','Udført arbejde','-12350','0','-'],
        ['1100','Varesalg DK','-1250','0','-'],
        ['1200','Salg af ydelser indenfor EU','0','666','-100'],
        ['1220','Salg af varer indenfor EU','0','66','-100'],
        ['1250','Salg af ydelser udenfor EU','0','55','-100'],
        [':=Salg af varer og ydelser udenfor EU',' ','0','55','-100'],
        [':=OMSÆTNING I ALT',' ',' ',' ',' '],
        ['::VARIABLE OMKOSTNINGER:',' ',' ',' ',' '],
        ['::VAREFORBRUG:',' ',' ',' ',' '],
        ['2100','Varekøb i DK','1.107,02','0.00',''],
        [':=VAREFORBRUG I ALT','1.107,02','0.00','',''],
        ['::FREMMED ARBEJDE',' ',' ',' ',' '],
        ['::VAREFORBRUG OG FREMMEDE ARBEJDE','1.107,02','0.00','--%',''],
        [':=DÆKNINGSBIDRAG I','-12.492,98','787.00','-1.687,42%',''],
        ['::LØNNINGER:',' ',' ',' ',' '],
        [':=DÆKNINGSBIDRAG II','-12.492,98','787.00','-1.687,42%',''],
        ['::Øvrige omkostninger:',' ',' ',' ',' '],
        ['::Øvrige personaleomkostninger:',' ',' ',' ',' '],
        ['::LOKALEOMKOSTNINGER:',' ',' ',' ',' '],
        ['::SALGSOMKOSTNINGER:',' ',' ',' ',' '],
        ['::REPRÆSENTATION:',' ',' ',' ',' '],
        ['::ADMINISTRATION:',' ',' ',' ',' '],
        ['7600','Telefoni','255.2','0',' '],
        ['7900','Diverse ekskl. moms','75','0',' '],
        [':=ADMINISTRATION I ALT','330.2','0',' ',' '],
        ['::KØRSEL:','','','',' '],
        ['8400','Brændstof','586.23','0',' '],
        [':=KØRSEL I ALT','586.23','0',' ',' '],
        [':=Øvrige omkosninger i alt:','916.43','0',' ',' '],
        [':=RESULTAT FØR AFSKRIVNINGER','','-11576.55','787','-1570.97'],
        ['::AFSKRIVNINGER:',' ',' ',' ',' '],
        [':=RESULTAT FØR FINANSIERING','','-11576.55','787','-1570.97'],
        ['::RENTEINDTÆGTER M.V.:',' ',' ',' ',' '],
        ['::RENTEUDGIFTER M.V.:',' ',' ',' ',' '],
        [':=RESULTAT I ALT','','-11576.55','787','-1570.97'],
     ),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,       # Mulighed for at oprette en record
    $ModifyRec=false,       # Mulighed for at ændre data i en row
    $ViewHeight= '400px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__,
    $Kriterie= ['RAPPORT']
  );
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}

######### :FINANS:
function Panl_RapportResultat() {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'rappformxxx',$capt= '@Rapport - Resultat:',$parms='../_base/page_Blindgyden.php',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  FinaRappTop('RESULTAT');
  htm_hr();
  htm_Table(
    $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
      ),
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Konto',      '10%','show','col2', ['center'],'@Konto nummer i kontoplanen',''],
        ['@Angår',      '48%','show','',     ['left'  ],'@Konto benævnelse',''],
        ['@I perioden', '15%','show','2d',   ['right' ],'@Bogførte beløb i perioden','0.00'],
        ['@År til dato','15%','show','2d',   ['right' ],'@Beløb bogført siden regnskabsårets start','0.00'],
      ),
    $RowSuff= array(
      ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
    //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $TablData= array( # DemoData:
        ['::RESULTATOPGØRELSE',' ',' ',' '],
        ['::OMSÆTNING:',' ',' ',' '],
        ['1000','Udført arbejde','-12350','-12350'],
        ['1100','Varesalg DK','-1250','-1250'],
        [':=OMSÆTNING I ALT',' ','-13600','-13600'],
        ['::VARIABLE OMKOSTNINGER:',' ',' ',' '],
        ['::VAREFORBRUG:',' ',' ',' '],
        ['2100','Varekøb i DK','1107.02','1107.02'],
        [':=VAREFORBRUG I ALT','','1107.02','1107.02'],
        ['::FREMMED ARBEJDE',' ',' ',' '],
        ['::VAREFORBRUG OG FREMMEDE ARBEJDE','','1107.02','1107.02'],
        [':=DÆKNINGSBIDRAG I','','-12492.98','-12492.98'],
        ['::LØNNINGER:',' ',' ',' '],
        [':=DÆKNINGSBIDRAG II','','-12492.98','-12492.98'],
        ['::Øvrige omkostninger:',' ',' ',' '],
        ['::Øvrige personaleomkostninger:',' ',' ',' '],
        ['::LOKALEOMKOSTNINGER:',' ',' ',' '],
        ['::SALGSOMKOSTNINGER:',' ',' ',' '],
        ['::REPRÆSENTATION:',' ',' ',' '],
        ['::ADMINISTRATION:',' ',' ',' '],
        ['7600','Telefoni','','255.2','255.2'],
        ['7900','Diverse ekskl. moms','75','75'],
        [':=ADMINISTRATION I ALT','330.2','0',' ',' '],
        ['::KØRSEL:','','','',' '],
        ['8400','Brændstof','586.23','586.23'],
        [':=KØRSEL I ALT','','586.23','586.23'],
        [':=Øvrige omkosninger i alt:','','916.43','916.43'],
        [':=RESULTAT FØR AFSKRIVNINGER','','-11576.55','-11576.55'],
        ['::AFSKRIVNINGER:',' ',' ',' '],
        [':=RESULTAT FØR FINANSIERING','','-11576.55','-11576.55'],
        ['::RENTEINDTÆGTER M.V.:',' ',' ',' '],
        ['::RENTEUDGIFTER M.V.:',' ',' ',' '],
        [':=RESULTAT I ALT','','-11576.55','-11576.55'],
     ),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,       # Mulighed for at oprette en record
    $ModifyRec=false,       # Mulighed for at ændre data i en row
    $ViewHeight= '400px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__,
    $Kriterie= ['RAPPORT']
  );
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}


######### :FINANS:
# Kaldes fra:  [_finans/page_Regnskab.php] [_system/page_Regnskabsaar.php] [_system/page_Regnskabskort.php] 
function Panl_Regnskab($regnskab='', $maanedantal=12, $startaar=2018, $startmaaned=1, $periode_dag=1,   ## out_PanlsPrim.php
                       $periode_laengde="regnskabsmaaned", $regnskabsaar='2018', &$TablData) {
  htm_Panl_Top($name= 'kontoform',$capt= tolk('@Regnskab:').' '.$regnskab, $parms='../_base/page_Hovedmenu.php',$icon='fas fa-database','panelW120',__FUNCTION__);
  $MdTitles= periodeoverskrifter($maanedantal=12, $startaar=2018, $startmaaned=1, $periode_dag=1, $periode_laengde="regnskabsmaaned", $regnskabsaar='2018','2d','5%');
  //function periodeoverskrifter($periodeantal, $periode_aar, $periode_md, $periode_dag=1, $periode_laengde="regnskabsmaaned", $regnskabsaar="",$outFormat='2d',$colw='4%') {

  $RowBody= array();  #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'],
  array_push($RowBody, 
        //['@Id.',           '0%','hidd','',['center'],'@Index','serial...'],
        ['@Konto',     '5%','text', ''  ,['center','white','','lightcyan'], '@Kontonummer. Entydig nummerkode, som benyttes til sortering, summering mv.','@Konto...'],
        ['@Kontonavn','24%','text', ''  ,['left',  '',     '','lightcyan'], '@Kontonavn - beskrivende tekst',''],
        ['@Type',      '0%','hidd', ''  ,['center','',     '','lightcyan'], '@Kontotype: D=Drift, S=Status, Z=Sum, H=Overskrift, R=Resultat, X=Sideskift, L=Lukket','@Type...','hide'],  //  Angår styring af layout i tabelvisning
        ['@Valuta',    '1%','show', ''  ,['center','',     '','lightcyan'], '@Valutakode for kontoens beløb',''],
        ['@Σ-fra:',    '0%','hidd', ''  ,['center','',     '','lightcyan'], '@Summation fra konto til denne',''],
        ['@Primo:',    '5%','text', '0d',['right','#EEEEEE; opacity:0.50','','' ], '@Året primo beløb, Sidste års ultimo','']
        );
  foreach ($MdTitles as $Md) array_push($RowBody, $Md); //  periodeoverskrifter benytter: ['@'.$periode_kort, '4%','text','2d', ['right','','font-style:italic; '], '@'.$periode_lang,'']
  array_push($RowBody, 
        ['@I-alt:',    '5%','text', '0d',['right','#EEEEEE; opacity:0.50','','lightcyan'], '@Aktuelle beløb. (Årets ultimo beløb)','.calc.']);
  htm_Table(
    $TblCapt= array(), #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:Just',          '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[FeltJust_mm]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody,          #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]',  '5:ColTip', '6:placeholder','7:default','8:select'],
    $RowSuff= array(),
    $TablData,
    $FilterOn= false,   #  Mulighed for at skjule records som ikke matcher filter.
    $SorterOn= false,  #  Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,  #  Mulighed for at oprette en record
    $ModifyRec=false,  #  Mulighed for at ændre data i en row
    $ViewHeight= '700px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__,
    $Kriterie=['REGNSKAB','0'] 
  );

### PanelFooter:
  htm_RadioGrp($type='hori',  $name='krvis', $labl='@Beløbsvisning:', $titl='@Vælg visnings nøjagtighed for regnskabs beløb',  
              $optlist= array(['kr2d','@Kroner,ører','@eller',true],['kr','@Hele kroner','@eller'],['tusind','@Kun tusinder','']),$action='');
### KnapPanel:
  htm_CentrOn();
    naviKnap($label='@Til Budget',          $title='@Klik her for komme til budgetlægning',   $link='../_finans/page_Budget.php');
    naviKnap($label='@Retur til hovedmenu', $title='@Luk og gå retur til hovedmenu', $link='../_base/page_Hovedmenu.php');
    textKnap($label='@Vis print layout',    $title='@Skjul header og footer, og vis tabel i fuld højde, så du kan udskrive regnskabet med CTRL-P', $link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Luk og gå retur til hovedmenu');
}

# SubRutine:
#function- getComboA(sel) { var value = sel.value; };

######### :FINANS:
# Kaldes fra:  [_finans/page_Kontrol.php] [_finans/page_Rapport-fin.php] 
function Panl_Kontrolspor(&$Data) {global $Ønovice;  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'sporform',$capt= '@Kontrol sporing',$parms='../_finans/page_Rapport-fin.php',$icon='fas fa-database','panelWmax',__FUNCTION__);
  htm_Table(
    $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Søg og vis:', '20%', 'text', '', 'left', '@Her kan du søge og filtrere bland alt, hvad der er bogført.', '@Blandt alle transaktioner...']
    ),
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Id',          '4%','indx','',['center'],'@Angiv et id-nummer eller angiv to adskilt af kolon (f.eks 345:350)',''],
          ['@Periode',     '9%','show','',['right' ],'@Angiv en dato eller angiv to adskilt af kolon (f.eks 010605:300605)','...'.'åååå-mm-dd:åååå-mm-dd'],
          ['@Log. Periode','9%','show','',['right' ],'@Angiv en dato eller angiv to adskilt af kolon (f.eks 010605:300605)','åååå-mm-dd:åååå-mm-dd'],
          ['@Tidspunkt',   '7%','show','',['center'],'@Angiv et tidspunkt (f.eks 17:35) ','?'],
          ['@Kladde',      '7%','show','',['center'],'@Angiv et kassekladdenummer eller angiv to adskilt af kolon (f.eks 345:350)','?'],
          ['@Bilag',       '7%','show','',['center'],'@Angiv et bilagsnummer eller angiv to adskilt af kolon (f.eks 345:350)','?'],
          ['@Konto.',      '7%','show','',['center'],'@Angiv et kontonummer eller angiv to adskilt af kolon (f.eks 345:350)','?'],
          ['@Fakturanr',   '7%','show','',['center'],'@Angiv et fakturanummer eller angiv to adskilt af kolon (f.eks 345:350)','?'],
          ['@Debet',       '7%','show','',['center'],'@Angiv et beløb eller angiv to adskilt af kolon (f.eks 10000,00:14999,99)','?'],
          ['@Kredit',      '7%','show','',['center'],'@Angiv et beløb eller angiv to adskilt af kolon (f.eks 10000,00:14999,99)','?'],
#   if ($Øvis_projekt): 
          ['@Projekt',     '7%','show','',['center'],'@Angiv et projektnummer eller angiv to adskilt af kolon (f.eks 5:7)','?'],
          ['@Søgetekst',  '18%','show','',['left'  ],'@Angiv en søgetekst. Der kan anvendes * før og efter teksten','?']
    ),
    $RowSuff= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
    //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $Data= array(['1','Per...','Log...','Tid...','Kla...','Bilag','Kon..','Fakt...','Debet','Kredit','Proj','Tekst'],
                 ['2','','','','','','','','','','',''], ['3','','','','','','','','','','','']), 
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,      # Mulighed for at oprette en record
    $ModifyRec=true,      # Mulighed for at ændre data i en row
    $ViewHeight= '400px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_CentrOn(); htm_nl();
    textKnap($label='@CSV-eksport', $title='@Klik her for at eksportere valgte transaktioner til CSV-fil for import i andet program, f.eks. regneark.',$link='../_base/page_Blindgyden.php');
    textKnap($label='@Print layout', $title='@Klik her for at vise data, så de kan udskrives med CTRL-P',$link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_PanlBund($pmpt='@Retur til finansrapport',$subm=true,$title='@Gå til vinduet finansrapport');
}

######### :FINANS:
# Kaldes fra: Panl_RapportFinans
function MakeDriftsKonti() {global $Ødb_Link;  ## out_PanlsPrim.php
  $DriftKt= array();
  if ($Ødb_Link) {
       $konti= sql_readB('SELECT kontonr,beskrivelse '.
                         'FROM  tblA_account_plan '.
                         'WHERE kontotype= "D" ',__FILE__, __LINE__);
       foreach ($konti as $rec) { array_push($DriftKt, [$rec[1],$rec[0],$rec[0].':'.$rec[1]]);}
    }
  else { $filDATA= ImportTabFile('../_exchange/kontoplan.tab');
         foreach ($filDATA as $rec) {if ($rec[2]=='D') array_push($DriftKt, [$rec[1],$rec[0],$rec[0].':'.$rec[1]]);}
       }
  return $DriftKt;
}

######### :FINANS:
# Kaldes fra:  [_finans/page_Provisionsrapport.php] [_system/page_Provision.php] 
function Panl_Provision()   ## out_PanlsSekd.php
{global $Ø_DagList;
  htm_Panl_Top($name= 'provisi',$capt= '@Provision:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW320',__FUNCTION__);
  htm_Caption('@Provisionsberegning:');
  htm_RadioGrp($type='hori',  $name='provgrlg',   $labl='@Grundlag',  
              $titl='@Vælg om provison beregnes på fakturerede eller betalte ordrer', 
              $optlist= array(['faktureret','@Faktureret','@eller','@Provision beregnes på fakturerede ordrer'],
                              ['betalt',    '@Betalt',    '',      '@Provision beregnes på betalte ordrer'])
                              ,$action='');
  str_hr();  htm_Caption('@Kilde for personinfo:');
  htm_RadioGrp($type='hori',  $name='provtil',    $labl='@Kilde',     
              $titl='@Provision tilfalder den, der er angivet som referenceperson på de enkelte ordrer', 
              $optlist= array(['ref',   '@Ref',    '@eller','@Provision beregnes på fakturerede ordrer'],
                              ['kua',   '@Kundens','@eller','@Provision tilfalder den kundeansvarlige'],
                              ['smart', '@Begge',  '',      '@Provision tilfalder den kundeansvarlige såfremt der er tildelt en sådan, ellers til den som er referenceperson på de enkelte ordrer'])
                              ,$action='');
  str_hr();  htm_Caption('@Kilde for kostpris:');
  htm_RadioGrp($type='hori',  $name='provgrund',  $labl='@Grundlag',  
              $titl='@Vælg om provison beregnes på fakturerede eller betalte ordrer', 
              $optlist= array(['faktureret','@Indkøbspris','@eller','@Anvend varens reelle indkøbspris som kostpris.'],
                              ['betalt',    '@Varekort',    '',     '@Anvend kostpris fra varekort.'])
                              ,$action='');
  str_hr();   htm_Caption('@Skæringsdato for provisionsberegning:');
  htm_OptioFlt($type='text',  $name='brgndato',   $valu= $brgndato,   $labl='@Dato',  
                    $titl='@Dato hvorfra og med (i foregående måned) til (dato i indeværende måned) provisionsberegning foretages',  
                    $revi=true, $optlist= $Ø_DagList,
                    $action='onchange="getComboA(this)"',
                    '','','',$nl=2);
  htm_PanlBund($pmpt='@Gem',$subm=true);
}
 

######### :FINANS:
# Kaldes fra:  [_finans/page_Provisionsrapport.php] 
function Panl_Provisionsrapport(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {  ## out_PanlsSekd.php
  htm_Panl_Top($name= 'provform',$capt= '@Provisionsrapport:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-database','panelWmax',__FUNCTION__);
  
  msg_Dialog('warn',ucfirst(tolk('@Retur')),'JavaScript:window.history.back();','','','','',ucfirst(tolk('@Her mangler der noget')),
            ucfirst(tolk('@Provisionsrapport kan ikke testes, før der er DB-adgang.')));
  
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Luk og gå retur til hovedmenu');
}

######### :FINANS: ######### Slut funktioner angående visninger i menu-gruppen FINANS


######### :DEBITOR: ######### Start funktioner angående visninger i menu-gruppen DEBITOR

######### :DEBITOR:
# Kaldes fra:  [_debitor/page_DebitorOrdre.php] 
function Panl_Kunden(&$kontonr, &$kategori, &$cvrnr, &$eannr, &$bankreg, &$bankkto, &$instit, &$ansv, &$formsprog, &$homeweb) {  ## out_PanlsPrim.php
  htm_Panl_Top($name='kundform',$capt='@Kunden (debitor):',$parms='page_Blindgyden.php',$icon='fas fa-user',$klasse='panelWmax',__FUNCTION__,'','legeplads:lege-side#kunden');
  htm_CombFelt($type='text',  $name='DBix',   $valu= $kontonr,  $labl='@Kundenr.',          
                          $titl='@Kundenr: Kan ikke rettes. Systemet styrer dette', $revi=false);
  htm_RadioGrp($type='hori',  $name='Ktyp',                     $labl='@Kundetype',         
              $titl='@Kunde kategori',          
              $optlist= array(['privat','@Privat','@eller'],['erhverv','@Erhverv','']),$action='');
  $Erhv= 'placeholder="...'.tolk('@kun erhverv').'..."';  // Rerurnering af værdi i &$kategori ?
  htm_CombFelt($type='text',  $name='cvrnr',  $valu= $cvrnr,    $labl='@CVR',               
              $titl=tolk('@CVR - Virksomheds ID.').'<br>'.
              tolk('@Kan benyttes i CVR-opslag, til at importere Erhvervsstyrelsens offentlige data'), $revi=true);
  htm_CombFelt($type='text',  $name='EAN',    $valu= $eannr,    $labl='@EAN',               
              $titl='@EAN - Elektronisk-betalings ID',  $revi=true,'','','',$Erhv);
  htm_FrstFelt('30%');                                          
    htm_CombFelt($type='text',$name='bankreg',$valu= $bankreg,  $labl='@Bank reg.',         
              $titl='@Bank reg.',             $revi=true);  
  htm_NextFelt('70%');                                          
    htm_CombFelt($type='text',$name='bankkto',$valu= $bankkto,  $labl='@Bank konto',        
              $titl='@Bank konto',            $revi=true);  
  htm_lastFelt();                                               
  htm_CombFelt($type='text',  $name='inst',   $valu= $instit,   $labl='@Institution',       
              $titl='@Supplerende oplysning', $revi=true,'','','',$Erhv);
  htm_CombFelt($type='text',  $name='ansv',   $valu= $ansv,     $labl='@Kundeansvarlig',    
              $titl='@Kundeansvarlig',        $revi=true);
  htm_CombFelt($type='text',  $name='sprog',  $valu= $formsprog,$labl='@Faktureringssprog', 
              $titl='@Sproget som skal benyttes på faktura udskrifter',   
          $revi=true,'','','','placeholder="...'.tolk('@hvis sproget ikke er dansk').'..."');
  htm_CombFelt($type='text',  $name='homeweb',$valu= $homeweb,  $labl='@Hjemmeside',        
              $titl='@Kundens hjemmeside',      $revi=true,'','','',$Erhv);
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

function Panl_CVRopslag($hvem='')  {
  $Erhv= 'placeholder="...'.tolk('@kun erhverv').'..."';
  htm_Panl_Top($name='cvrform',$capt='@CVR opslag:',$parms='#',$icon='fas fa-search',$klasse='panelWmax',__FUNCTION__,'');
  htm_Caption('@Opslag i CVR-registret (kun erhverv)');
  htm_Plaintxt('@Hent eller kontroller med data i det offentlige virksomhedsregister');
  htm_Plaintxt('@Data leveres af CVR API');
  htm_nl(2);
  set_FormVars(['cvrLand','cvrKode','cvrSoeg'/* ,'cvrNumm','cvrNavn','cvrTelf','cvrAddr','cvrPost','cvrBy','cvrDiv' */]);  // Opdater alle variabler på form 'cvrform' :
  //  get_FormVars(['cvrLand','cvrKode','cvrSoeg']);
  dev_show(); //  echo 'SESSIONS variablers indhold: ';  vis_data($_SESSION);
  $cvrLand= $_SESSION['cvrLand'];   if (!$cvrLand) $cvrLand= 'dk';
  $cvrKode= $_SESSION['cvrKode'];   if (!$cvrKode) $cvrKode= 'search';
  $cvrSoeg= $_SESSION['cvrSoeg'];
  if (($cvrLand) and ($cvrKode) and ($cvrSoeg)) //  Klar til søgning
    { $url= 'https://cvrapi.dk/api?'.$cvrKode.'='.$cvrSoeg.'&country='.$cvrLand;   //  https://cvrapi.dk/api?search=$cvrSoeg&country=dk  Generel søgning    //  https://cvrapi.dk/api?phone=$cvrSoeg&country=dk   specifikt telefonnr
      $content = file_get_contents($url, false, stream_context_create(['http' => ['user_agent' => 'any']]));
      // FIXIT: Forebyg: "Failed to open streem" ved:  "404 Not Found"
      $svar= json_decode($content, true);       //  $svar= json_decode('{"vat":20756438,"name":"Saldi.dk ApS","address":"Gefionsvej 13, 1","zipcode":"3400","city":"Hiller\u00f8d","cityname":null,"protected":false,"phone":"46902208","email":"phr@danosoft.dk","fax":null,"startdate":"29\/12 - 1997","enddate":null,"employees":"2-4","addressco":null,"industrycode":620100,"industrydesc":"Computerprogrammering","companycode":80,"companydesc":"Anpartsselskab","creditstartdate":null,"creditbankrupt":false,"creditstatus":null,"owners":[{"name":"Peter Holten Rude"}],"productionunits":[{"pno":1018843737,"main":false,"name":"saldi.dk ApS","address":"Kirseb\u00e6rg\u00e5rden 2-4, 1. V.","zipcode":"3450","city":"Aller\u00f8d","cityname":null,"protected":false,"phone":"46902208","email":"phr@saldi.dk","fax":null,"startdate":"23\/10 - 2013","enddate":"23\/02 - 2016","employees":null,"addressco":null,"industrycode":620100,"industrydesc":"Computerprogrammering"},{"pno":1008561504,"main":true,"name":"Saldi.dk ApS","address":"Gefionsvej 13, 1","zipcode":"3400","city":"Hiller\u00f8d","cityname":null,"protected":false,"phone":"46902208","email":"phr@danosoft.dk","fax":null,"startdate":"06\/07 - 2001","enddate":null,"employees":null,"addressco":null,"industrycode":620100,"industrydesc":"Computerprogrammering"}],"t":100,"version":6}', true);
                                                //  var_dump($svar);
      if ($svar['vat']) { $cvrDiv= '';
        $cvrNumm= $svar['vat'];    
        $cvrNavn= $svar['name'];   
        $cvrAddr= $svar['address'];
        $cvrPost= $svar['zipcode'];
        $cvrBy  = $svar['city'];   
        $cvrTelf= $svar['phone'];  
        if ($svar['email'])                                   {$cvrDiv.= tolk('@Mail').': '. $svar['email'].'&#xa;';}
        if ($svar['fax'])                                     {$cvrDiv.= tolk('@Fax ').': '. $svar['fax'].'&#xa;';}
        if ($svar['cityname'])                                {$cvrDiv.= tolk('@Sted').': '. $svar['cityname'].'&#xa;';}
        if ($svar['companydesc'])                             {$cvrDiv.= tolk('@Type').': '. $svar['companydesc'].'&#xa;';}
        $ix= 0; while ($svar['owners'][$ix]['name'])          {$cvrDiv.= tolk('@Ejer').': '. $svar['owners'][$ix]['name'].'&#xa;'; $ix++;}
        $ix= 0; while ($svar['productionunits'][$ix]['pno'])  {$cvrDiv.= tolk('@P-nr').': '. $svar['productionunits'][$ix]['pno'].'&#xa;'; $ix++;}
      } 
    }
  htm_FrstFelt('22%');  htm_OptioFlt($type='text',  $name='cvrLand',  $valu= $cvrLand,  $labl='@Land',   
                        $titl='@I hvilket land vil du søge?', $revi=true, $optlist= CVR_Land(),    $action='',
                        $events='', $maxwd='100px', $onForm='cvrform');
  htm_NextFelt('22%');  htm_OptioFlt($type='text',  $name='cvrKode',  $valu= $cvrKode,  $labl='@Søg efter',   
                        $titl='@Hvad kender du?',   $revi=true, $optlist= CVR_Liste(),    $action='', //  Søgekoder: vat, name, produ, phone, search (generelt: vat/name/produ)
                        $events='', $maxwd='100px', $onForm='cvrform');
  htm_NextFelt('56%');  htm_CombFelt($type='text',  $name='cvrSoeg',  $valu= $cvrSoeg,  $labl='@CVR / P-enh. / Telf / Navn', 
                        $titl='@Indtast her, data eller firma navn, som du vil søge efter',  $revi=true,'','','',$Erhv);
  htm_LastFelt();
  htm_AcceptKnap('@Søg','@Start søgning  i CVR-registret', $type='save', $form='cvrform', $width='', $akey='');
    
  htm_hr();
  htm_FrstFelt('30%');  htm_CombFelt($type='text',  $name='cvrNumm',  $valu= $cvrNumm,  $labl='@CVR-nummer',  
                        $titl='@Hentet i CVR-registret',  $revi=true, $rows='',$width='45','','','CVR...');
  htm_NextFelt('70%');  htm_CombFelt($type='text',  $name='cvrNavn',  $valu= $cvrNavn,  $labl='@Firmanavn',  
                        $titl='@Hentet i CVR-registret',  $revi=true, $rows='',$width='45','','','Navn...');
  htm_LastFelt();
  htm_FrstFelt('30%');  htm_CombFelt($type='text',  $name='cvrTelf',  $valu= $cvrTelf,  $labl='@Telefon',     
                        $titl='@Hentet i CVR-registret',  $revi=true, $rows='',$width='45','','','Telf...');
  htm_NextFelt('70%');  htm_CombFelt($type='text',  $name='cvrAddr',  $valu= $cvrAddr,  $labl='@Adresse',     
                        $titl='@Hentet i CVR-registret',  $revi=true, $rows='',$width='45','','','Addr...');
  htm_LastFelt();
  htm_FrstFelt('30%');  htm_CombFelt($type='text',  $name='cvrPost',  $valu= $cvrPost,  $labl='@Postnr.',     
                        $titl='@Hentet i CVR-registret',  $revi=true, $rows='',$width='45','','','Post...');
  htm_NextFelt('70%');  htm_CombFelt($type='text',  $name='cvrBy',    $valu= $cvrBy,    $labl='@Bynavn',          
                        $titl='@Hentet i CVR-registret',  $revi=true, $rows='',$width='45','','','By...');
  htm_LastFelt();
  htm_AcceptKnap('@Benyt',tolk('@Benyt de viste data i din registrering af ').$hvem.'. <br>'.
            tolk('@Advarsel: Evt. tidligere data overskrives! (Felter uden indhold, påvirker ikke ekst. data)'.'<br>Virker ikke endnu'), 
                  $type='create', $form='cvrform', $width='', $akey='');
  htm_CombFelt($type='area',  $name='cvrDiv',   $valu= $cvrDiv,   $labl='@Andet',       
                        $titl='@Hentet i CVR-registret, diverse supplerende data',  $revi=true, $rows='5',$width='45','','','Diverse...');
                        //  Andre felter med data, angivet med label, f.eks. "Sted: Ved kæret, Ejer: Anders Hansen"
  htm_nl(3);
  //  GET / POST: http://cvrapi.dk/api
  //  Source: https://github.com/KristianI/cvrapi
  //  'vat' 'name'  'produ'  'phone'
/*
$ wget https://cvrapi.dk/api?search=saldi.dk&country=dk
{
    "vat": 20756438,                           :  $cvrNumm
    "name": "Saldi.dk ApS",                    :  $cvrNavn
    "address": "Gefionsvej 13, 1",             :  $cvrAddr
    "zipcode": 3400,                           :  $cvrPost
    "city": "Hillerød",                        :  $cvrBy
    "cityname": null,                          :  Sted: $cvrDiv
    "protected": false,                        :  
    "phone": 46902208,                         :  $cvrTelf
    "email": "phr@danosoft.dk",                :  Mail: $cvrDiv
    "fax": null,                               :  Fax: $cvrDiv
    "startdate": "29/12 - 1997",               :  
    "enddate": null,                           :  
    "employees": "2-4",                        :  
    "addressco": null,                         :  
    "industrycode": 620100,                    :  
    "industrydesc": "Computerprogrammering",   :    
    "companycode": 80,                         :  
    "companydesc": "Anpartsselskab",           :  Type: $cvrDiv
    "creditstartdate": null,                   :  
    "creditbankrupt": false,                   :  
    "creditstatus": null,                      :  
    "owners": [                                :  
        {                                      :  
            "name": "Peter Holten Rude"        :  Ejer: $cvrDiv
        }
    ],
    "productionunits": [
        {
            "pno": 1018843737,                        : P-nr: $cvrDiv
            "main": false,                            : 
            "name": "saldi.dk ApS",                   : 
            "address": "Kirsebærgården 2-4, 1. V.",   : 
            "zipcode": 3450,                          : 
            "city": "Allerød",                        : 
            "cityname": null,                         : 
            "protected": false,                       : 
            "phone": 46902208,                        : 
            "email": "phr@saldi.dk",                  : 
            "fax": null,                              : 
            "startdate": "23/10 - 2013",              : 
            "enddate": "23/02 - 2016",                : 
            "employees": null,                        : 
            "addressco": null,                        : 
            "industrycode": 620100,                   : 
            "industrydesc": "Computerprogrammering"   : 
        },                                            : 
        {                                             : 
            "pno": 1008561504,                        : P-nr: $cvrDiv
            "main": true,                             : 
            "name": "Saldi.dk ApS",                   : 
            "address": "Gefionsvej 13, 1",            : 
            "zipcode": 3400,                          : 
            "city": "Hillerød",                       : 
            "cityname": null,                         : 
            "protected": false,                       : 
            "phone": 46902208,                        : 
            "email": "phr@danosoft.dk",               : 
            "fax": null,                              : 
            "startdate": "06/07 - 2001",              : 
            "enddate": null,                          : 
            "employees": null,                        : 
            "addressco": null,                        : 
            "industrycode": 620100,                   : 
            "industrydesc": "Computerprogrammering"   : 
        }
    ],
    "t": 100,
    "version": 6
}
*/
  
    htm_PanlBund($pmpt='',$subm=false,$title='');
}

######### :DEBITOR:
# Kaldes fra:  [_debitor/page_DebitorOrdre.php] 
function Panl_Betingelser(&$debigrup, &$betaling, &$frist, &$print2, &$kunderef    /* ,&$betalingsbet,&$fristdage */ ) {  ## out_PanlsPrim.php
  #if ($betalingsbet=='@Kontant'||$betalingsbet=='@Efterkrav'||$betalingsbet=='@Forud'||$betalingsbet=='@Kreditkort') $fristdage='';  else $fristdage=0;
  htm_Panl_Top($name='betaform',$capt= '@Betingelser:',$parms='page_Blindgyden.php',$icon='far fa-credit-card',$klasse='panelWmax',__FUNCTION__,'','legeplads:lege-side#handelsbetingelser'); # ' <text color: "gray">&#x00A7;</text>  '.
  htm_OptioFlt($type='text',  $name='debigrup',   $valu= $debigrup, 
                    $labl='@Debitorgruppe',     
                    $titl='@Vælg hvilken gruppe kunden tilhører', 
                    $revi=true, $optlist= array(
                    ['','@1. Danske debitorer',     '@1. Danske debitorer'],
                    ['','@2. Europæiske debitorer', '@2. Europæiske debitorer']),$action='','','150px','',$nl=1);
  htm_OptioFlt($type='text',  $name='betaling',   $valu= $betaling,   
                    $labl='@Betalings metode',  
                    $titl='@Hvordan skal der betales',  
                    $revi=true, $optlist= array(
                    ['@Kontant',    'Kontant',    '@Kontant'],
                    ['@Efterkrav',  'Efterkrav',  '@Efterkrav'],
                    ['@Forud',      'Forud',      '@Forud'],
                    ['@Kreditkort', 'Kreditkort', '@Kreditkort'],
                    ['@Konto',      'Konto',      '@Konto']),$action='');
  htm_OptioFlt($type='text',  $name='frist',      $valu= $frist,      
                    $labl='@Betalings frist',   
                    $titl='@Hvor lang frist er der til betaling', 
                    $revi=true, $optlist= array(
                    ['','0' ,'@Straks'],
                    ['','8' ,'@8 dage'],
                    ['','14','@14 dage'],
                    ['','30','@30 dage']),$action='');
  htm_OptioFlt($type='text',  $name='print2',   $valu= $print2,
                    $labl='@Udskriv til',       
                    $titl='@Vælg på hvilken måde skal dokumentet udskrives, gemmes eller sendes.',  
                    $revi=true, $optlist= array(
                    ['@Fil i pdf-format','pdf','@PDF-fil'],
                    ['@Elektronisk forsendelse','email','@email'],
                    ['@Elektronisk fakturering','ioubl','@OIOUBL'],
                    ['@PBS faktura','pbs','@PBS']),$action='');
  htm_CombFelt($type='text',  $name='kunderef',   $valu= $kunderef, $labl='@Kundens referance', $titl='@f.eks. Rekvisitions NR',  $revi=true);
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :DEBITOR:
# Kaldes fra: [_debitor/page_DebitorOrdre.php] 
function Panl_Kontakter() {  ## out_PanlsPrim.php
  htm_Panl_Top($name='betaform',$capt='   '.tolk('@Person kontakt:'),$parms='page_Blindgyden.php',$icon='fas fa-phone-square',$klasse='panelWmax',__FUNCTION__,'','legeplads:lege-side#kontakt');
  Kontakt($posi=1, $kontakt='Anders', $titel, $telf, $mobil, $mail);
  Kontakt($posi=2, $kontakt='Andersine', $titel, $telf, $mobil, $mail);
  htm_accept('@Opret Ny','@Opret en ny kontakt');
  htm_PanlBund($pmpt='@Gem rettelser',$subm=true,$title='@Gem evt. rettelser ovenfor');
} //  Panl_Betingelser

######### :DEBITOR:
# Kaldes fra: Panl_Kontakter
function Kontakt($posi, $kontakt, $titel, $telf, $mobil, $mail, $bemr='') {  ## out_PanlsPrim.php
  htm_FrstFelt('10%');  
    htm_CombFelt($type='number', $name='posi',  $valu= $posi,   $labl='@Pos.',  $titl='@Position styrer rækkefølgen af posterne', $revi=true, $rows='', $width='45', $step='0.5');
  htm_NextFelt('40%');  
    htm_CombFelt($type='text',  $name='kontakt',$valu= $kontakt,$labl='@Kontakt person',  $titl='@Angiv Kontakt person',      $revi=true, $rows='',$width='45','','','Kont...');
  htm_NextFelt('40%');  
    htm_CombFelt($type='text',  $name='titel',  $valu= $titel,  $labl='@Titel',       $titl='@Angiv personens titel',         $revi=true, $rows='',$width='45','','','Titl...');
  htm_LastFelt('40%');
  htm_FrstFelt('50%');  
    htm_CombFelt($type='text',  $name='telf',   $valu= $telf,   $labl='@Telefon',     $titl='@Angiv Telefon',                 $revi=true, $rows='',$width='45','','','Tlf...');
  htm_NextFelt('50%');                                          
    htm_CombFelt($type='text',  $name='mobil',  $valu= $mobil,  $labl='@Mobil',       $titl='@Angiv Mobilnr. eller lokalnr',  $revi=true, $rows='',$width='45','','','Mobil/lok...');  
  htm_LastFelt('10%');                                          
  htm_CombFelt(  $type='mail',  $name='mail',   $valu= $mail,   $labl='@E-mail',      $titl='@Angiv E-mail',                  $revi=true, $rows='','','','','Mail...');
  htm_CombFelt(  $type='area',  $name='bemr',   $valu= $bemr,   $labl='@Bemærkning',  $titl='@Angiv bemærkning til kontakten, f.eks. rolle',  $revi=true, $rows='','','','','Note...');
  htm_nl();
  htm_accept('@Slet','@Fjern denne kontakt person');
  echo '<hr color="green">';
}

######### :DEBITOR:
# Kaldes fra:  [_debitor/page_DebitorOrdre.php] 
function Panl_Fakturering(&$navn, &$addr, &$sted, &$ponr, &$by, &$land, &$noter, &$telf, &$att, &$email, &$usemail, &$faktdato) {  ## out_PanlsPrim.php
  global $ØPanlForm;
  htm_Panl_Top($name='faktform',$capt='@Kunde - Fakturering:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelWmax',__FUNCTION__,'','legeplads:lege-side#fakturerings_oplysninger');
  htm_CombFelt($type='text',    $name='navn', $valu= $navn,   $labl='@Kunde navn',            $titl='@Angiv Kunde Navn',            $revi=true);
  htm_CombFelt($type='text',    $name='addr', $valu= $addr,   $labl='@Faktura adresse',       $titl='@Angiv Faktura Adresse',       $revi=true);
  htm_CombFelt($type='text',    $name='sted', $valu= $sted,   $labl='@Faktura Sted',          $titl='@Angiv Faktura Kunde Sted',    $revi=true);
  htm_FrstFelt('25%');                                              
    htm_CombFelt($type='text',  $name='ponr', $valu= $ponr,   $labl='@Postnr',                $titl='@Angiv Faktura Kunde postnr',  $revi=true);
  htm_NextFelt('75%');                                              
    htm_CombFelt($type='text',  $name='by',   $valu= $by,     $labl='@Faktura By',            $titl='@Angiv Faktura Kunde Bynavn',  $revi=true);
  htm_lastFelt();                                                   
  htm_CombFelt($type='text',    $name='land', $valu= $land,   $labl='@Faktura Land',          $titl='@Angiv Faktura Kunde Land',    $revi=true);
  htm_CombFelt($type='area',    $name='noter',$valu= $noter,  $labl='@Bemærkninger',          $titl='@Angiv Bemærkninger',          $revi=true, $rows='1');
  htm_CombFelt($type='text',    $name='telf', $valu= $telf,   $labl='@Telefon(er)',           $titl='@Angiv Kunde Telefon',         $revi=true);
  htm_CombFelt($type='text',    $name='att',  $valu= $att,    $labl='@Attention',             $titl='@Angiv Kunde Attention',       $revi=true);
  htm_CombFelt($type='mail',    $name='email',$valu= $email,  $labl='@Kundens Email adresse', $titl='@Angiv Kunde Email adresse',   $revi=true);
  htm_FrstFelt('50%');  
    htm_CheckFlt($type='checkbox',$name='useMail', $valu= $usemail, $labl='@Benyt mail',      $titl='@Send faktura med mail', $revi=true);
  htm_NextFelt('50%');  
    htm_CombFelt($type='date',  $name='faktdato',  $valu= $faktdato, $labl='@Faktura Dato',   $titl='@Fakturerings dato',     $revi=true);
  htm_LastFelt();
  //htm_hr();
  htm_Caption('Udskrivning kan først ske, når ordren er oprettet!');
  //htm_CentrOn();
  //textKnap($label='@Gem og udskriv faktura', $title='@Gem, bogfør og udskriv faktura til den under {Betingelser}, valgte udskriver!',$link='page_Blindgyden.php',$akey='p');
  //htm_CentOff();
  // $ØPanlForm=true;
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='');
}

######### :DEBITOR:
# PROGRAM-MODUL; Sammensatte Paneler! = "Vindue". Skal ændre til page_... eller wall_...
# Kaldes fra:  [_debitor/page_Opretordre.php] 
function wall_Opretordre($kundeRec=[],$vareRec=[],$leverRec=[]) {  ## out_PanlsPrim.php
  global $ØPanlForm;
  htm_Panl_Top($name='ordrform',$capt='@Opret ordre:',$parms='page_Blindgyden.php',
               $icon='fas fa-plus','panelW110',__FUNCTION__,'','legeplads:lege-side#find_din_kunde_i_debitorlisten');
  $ØPanlForm=false;   // Undlad form i paneler herefter:
  wall_DebitorKort(true);
  htm_nl();
  htm_Caption('@Husk at oprette ordre, med den gule knap nederst, når data er tilføjet/ændret !');
  htm_nl(2);
#?  htm_Rammestart($Caption='',$bor='0px');
#?    Panl_YdelserWide($Ordnr=':',$data=array(1,2,3),$fakt=false);
#?  htm_Rammeslut();
  htm_nl();
  Panl_YdelserTabl($Ordrnr='1025',$TablData,$fakt=false,'@Stadig redigerbar');
  $ØPanlForm=true;  //  Herefter submit af fælles form
  htm_PanlBund($pmpt='@Opret ordre',$subm=true,$title='@Gem ordren, med de ovenfor angivne data.');
}

######### :DEBITOR:
# Kaldes fra:  [_debitor/page_DebitorOrdre.php] 
function Panl_Ordreinfo(&$valuta, &$vorref, &$afdel, &$ordrdato, &$genfdato, &$godkendt, &$optlist) {  ## out_PanlsPrim.php
  htm_Panl_Top($name='ordrform',$capt='@Ordreinfo:',$parms='page_Blindgyden.php',$icon='fas fa-euro-sign','panelWmax',__FUNCTION__);
  htm_OptioFlt($type='text',    $name='valuta',   $valu= $valuta,   $labl='@Valuta',        $titl='@Valuta som ordren skal benytte',  $revi=true,
               $optlist= array(['','DKK','DKK'],['','AED','AED'],['','EUR','EUR'],['','USD','USD']),  $action='');
  htm_CombFelt($type='text',    $name='vorref',   $valu= $vorref,   $labl='@Vor referance', $titl='@Sælgers referance',               $revi=true);
  htm_CombFelt($type='text',    $name='afdel',    $valu= $afdel,    $labl='@Afdeling',      $titl='@Sælgers afdeling',                $revi=true);
  htm_FrstFelt('50%');                                              
    htm_CombFelt($type='date',  $name='ordrdato', $valu= $ordrdato, $labl='@Ordre Dato',    $titl='@Datoen hvor ordren indgik',       $revi=true);
  htm_NextFelt('50%');  
    htm_CombFelt($type='date',  $name='genfdato', $valu= $genfdato, $labl='@Genfakturerings Dato',$titl='@Husk fremtidigt fakturerings tidspunkt',  $revi=true);
  htm_LastFelt();
  htm_CheckFlt($type='checkbox',$name='godkendt',$valu= $godkendt,  $labl='@Godkendt',      $titl='@Ordren er godkendt hvis feltet er afmærket',$revi=true);
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='@Gem data i dette panel.');
}

######### :DEBITOR:
# Kaldes fra:  [_debitor/page_DebitorOrdre.php] 
function Panl_Levering( &$somfakt, &$navn, &$addr, &$sted, &$ponr, &$by, &$land, &$telf, &$kont, &$email, &$forsend, &$noter, &$afsendt, &$levdato) {  ## out_PanlsPrim.php
  //if ($onPanel) 
  htm_Panl_Top($name='leveform',$capt='@Levering:',$parms='page_Blindgyden.php',
        $icon='fas fa-truck','panelW320',__FUNCTION__,'','legeplads:lege-side#leverings_oplysninger');
  htm_CheckFlt($type='checkbox',$name='somfakt',    $valu= $somfakt,  $labl='@Leveres til faktura-adresse', 
        $titl='@Afmærk her, hvis leverings adresse er den samme som faktura adresse',  $revi=true);
  htm_CombFelt($type='text',    $name='levnavn',    $valu= $navn,     $labl='@Modtager navn',               
        $titl='@Angiv Modtager Navn',               $revi=true, '','','','',$plho='Navn..');
  htm_CombFelt($type='text',    $name='levaddr1',   $valu= $addr,     $labl='@Leverings adresse',           
        $titl='@Angiv Leverings Adresse',           $revi=true, '','','','',$plho='Addr..');
  htm_CombFelt($type='text',    $name='sted',       $valu= $sted,     $labl='@Leverings Sted',              
        $titl='@Angiv Leverings Sted, suplement til adresse', $revi=true);
  htm_FrstFelt('25%');                                                                                                  
    htm_CombFelt($type='text',  $name='levpostnr',  $valu= $ponr,     $labl='@Postnr',                      
        $titl='@Angiv Leverings Kunde postnr',      $revi=true, '','','','',$plho='Pnr..');
  htm_NextFelt('75%');                                                                                              
    htm_CombFelt($type='text',  $name='levby',      $valu= $by,       $labl='@Leverings by',                
        $titl='@Angiv Leveringsstedets Bynavn',     $revi=true, '','','','',$plho='By..');
  htm_lastFelt();                                                                                                   
  htm_CombFelt($type='text',    $name='land',       $valu= $land,     $labl='@Leverings Land',              
        $titl='@Angiv Leverings Land',              $revi=true);
  htm_CombFelt($type='text',    $name='levtelf',    $valu= $telf,     $labl='@Telefon(er)',                 
        $titl='@Angiv Modtagers Telefon',           $revi=true, '','','','',$plho='Telf..');
  htm_CombFelt($type='text',    $name='levkont',    $valu= $kont,     $labl='@Kontaktperson',               
        $titl='@Angiv Kontaktpersons Navn',         $revi=true);
  htm_CombFelt($type='mail',    $name='levemail',   $valu= $email,    $labl='@Modtagerens Email adresse',   
        $titl='@Angiv Modtagers Email adresse',     $revi=true);
  htm_CombFelt($type='text',    $name='forsendelse',$valu= $forsend,  $labl='@Fragtmetode)',                
        $titl='@Angiv Forsendelses oplysninger',    $revi=true);
  htm_CombFelt($type='area',    $name='levnoter',   $valu= $noter,    $labl='@Noter til fragtmand',         
        $titl='@Angiv Noter til fragtmand',         $revi=true, $rows='1','','','',$plho='Noter..');
  htm_FrstFelt('50%');
    htm_CheckFlt($type='checkbox',$name='afsendt',  $valu= $afsendt,  $labl='@Afsendt',                     
        $titl='@Afmærk her når varen/ydelsen er afsendt', $revi=true);
  htm_NextFelt('50%');  
    htm_CombFelt($type='date',$name='levdato',      $valu= $levdato,  $labl='@Leverings Dato',              
        $titl='@evt. forsendelses dato',            $revi=true);
  htm_LastFelt();
  //if ($onPanel) 
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :DEBITOR:
# Kaldes fra:  [_debitor/page_DebitorOrdre.php] 
function Panl_Ekstrafelter(&$felt1, &$felt2, &$felt3, &$felt4, &$felt5, $custFelt= array(  ## out_PanlsPrim.php
// [Label,          Hint,                  Placeholder  ]
  ['@Ordre Felt 1','@Udfyld Ordre Felt 1','@Felt 1...'],
  ['@Ordre Felt 2','@Udfyld Ordre Felt 2','@Felt 2...'],
  ['@Ordre Felt 3','@Udfyld Ordre Felt 3','@Felt 3...'],
  ['@Ordre Felt 4','@Udfyld Ordre Felt 4','@Felt 4...'],
  ['@Ordre Felt 5','@Udfyld Ordre Felt 5','@Felt 5...'])
) {
  htm_Panl_Top($name='feltform',$capt='@Ekstrafelter:',$parms='page_Blindgyden.php',
        $icon='fas fa-plus','panelWmax',__FUNCTION__,'','legeplads:lege-side#ekstrafelter');
  htm_CombFelt($type='text',$name='felt1',  $valu= $felt1,  $labl= tolk($custFelt[0][0]),  
        $titl= tolk($custFelt[0][1]), $revi=true,'','','','',  $plho= tolk($custFelt[0][2]));
  htm_CombFelt($type='text',$name='felt2',  $valu= $felt2,  $labl= tolk($custFelt[1][0]),  
        $titl= tolk($custFelt[1][1]), $revi=true,'','','','',  $plho= tolk($custFelt[1][2]));
  htm_CombFelt($type='text',$name='felt3',  $valu= $felt3,  $labl= tolk($custFelt[2][0]),  
        $titl= tolk($custFelt[2][1]), $revi=true,'','','','',  $plho= tolk($custFelt[2][2]));
  htm_CombFelt($type='text',$name='felt4',  $valu= $felt4,  $labl= tolk($custFelt[3][0]),  
        $titl= tolk($custFelt[3][1]), $revi=true,'','','','',  $plho= tolk($custFelt[3][2]));
  htm_CombFelt($type='text',$name='felt5',  $valu= $felt5,  $labl= tolk($custFelt[4][0]),  
        $titl= tolk($custFelt[4][1]), $revi=true,'','','','',  $plho= tolk($custFelt[4][2]));
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :DEBITOR:
# Kaldes fra:  [_debitor/page_DebitorOrdre.php] & wall_DebitorKort & Panl_DebtOpretRykker 
function Panl_Mailfaktura(&$emne, &$text, &$vedhft, &$copyto, &$bccopy) {  ## out_PanlsPrim.php
  htm_Panl_Top($name='mailform',$capt='@Mail faktura:',$parms='page_Blindgyden.php',
        $icon='fas fa-envelope','panelWmax',__FUNCTION__,'','legeplads:lege-side#yderligere_oplysninger');
  htm_CombFelt($type='text',$name='emne',   $valu= $emne,   $labl='@Mail emne',   
        $titl='@Angiv Mail emne',     $revi=true,'','','','',         $plho='Vedr...');
  htm_CombFelt($type='area',$name='text',   $valu= $text,   $labl='@Mail tekst',  
        $titl='@Angiv Mail tekst',    $revi=true, $rows='2','','','', $plho='Besked...');
  htm_nl();
  htm_CombFelt($type='text',$name='vedhft', $valu= $vedhft, $labl='@Mail bilag',  
        $titl='@Angiv Vedhæftet fil', $revi=true,'','','','',         $plho='Bilag...');
  htm_CombFelt($type='text',$name='copyto', $valu= $copyto, $labl='@Kopi til',    
        $titl='@Angiv mail-adresse, som skal modtage en kopi af afsendt mail',  $revi=true,'','','','', $plho='Copy...');
  htm_CombFelt($type='text',$name='bccopy', $valu= $bccopy, $labl='@Blind-kopi til',    
        $titl='@Angiv mail-adresse, som skal modtage en BC-kopi (skjult) af afsendt mail',  $revi=true,'','','','', $plho='BCopy...');
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :DEBITOR:
# Kaldes fra:  [_debitor/page_DebitorOrdre.php] [_debitor/page_Opretordre.php] [_debitor/page_Ordreliste.php] 
function Panl_Ydelser($Ordnr='1250',$fakt) {  ## out_PanlsPrim.php
  htm_Panl_Top($name='yderform',$capt=tolk('@Leverancer:').' '.$Ordnr.' <small>(Smal-format)</small>',
        $parms='page_Blindgyden.php',$icon='fas fa-shopping-cart','panelW320',__FUNCTION__);
  Varelinie($posi=1,$varenr="45-876",$antal=1,$enhed="stk",$beskriv="Redekasser",
        $momssats=25,$pris=235.50,$rabat=20, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);
  Varelinie($posi=2,$varenr="45-876",$antal=2,$enhed="stk",$beskriv="Redekasser",
        $momssats=25,$pris=235.50,$rabat=20, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);
  Varelinie($posi=3,$varenr="45-877",$antal=3,$enhed="stk",$beskriv="Redekasser",
        $momssats=25,$pris=245.00,$rabat=20, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);
  Varelinie($posi=4,$varenr="45-876",$antal=3,$enhed="stk",$beskriv="Redekasser",
        $momssats=25,$pris=235.50,$rabat=20, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);
  htm_Caption('@Status: ');
  htm_CheckFlt($type='checkbox', $name='fakt', $valu= $fakt, $labl='@Er Faktureret og låst',
               $titl='@Når ordren er faktureret, afmærkes feltet automatisk',$revi=false,$more='',$nl='');
  textKnap($label='@Opret Ny',  $title='@Opret ny varepostering', $link='../_base/page_Blindgyden.php');
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :DEBITOR:
# Kaldes fra:  [_debitor/page_DebitorOrdre.php] 
function Panl_YdelserWide($Ordnr='',$fakt) {  ## out_PanlsPrim.php
  SpalteBund();
  NextSpalte(640);
  htm_Panl_Top($name='linkform',$capt=tolk('@Ordrens omfang').' '.$Ordnr.' ',$parms='page_Blindgyden.php',
               $icon='fas fa-shopping-cart','panelW640',__FUNCTION__,'',  
               $more='','legeplads:lege-side#leverancer_pa_ordren'); //[ style= "height:350px" ]
    VarelinieWide($posi=1, $varenr='45-876', $antal=3, $enhed='stk', $beskriv='Redekasser', $momssats=25, 
        $pris=235.50, $rabat=8, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);     
    VarelinieWide($posi=2, $varenr='45-876', $antal=2, $enhed='stk', $beskriv='Redekasser', $momssats=25, 
        $pris=235.50, $rabat=8, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);     
    VarelinieWide($posi=3, $varenr='45-876', $antal=3, $enhed='stk', $beskriv='Redekasser', $momssats=25, 
        $pris=235.50, $rabat=12, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100);
    #,"45-876","3","stk","Redekasser","25","235,50","8",(3*235.5)*92/100*125/100
  htm_Caption('@Status: ');
  htm_CheckFlt($type='checkbox', $name='fakt', $valu= $fakt, $labl='@Er Faktureret og låst',$titl='@Når ordren er faktureret, afmærkes feltet automatisk',$revi=false,$more='',$nl='');
  htm_nl();
  htm_Plaintxt(tolk('@TIP angående Beløbsrabat:').'&nbsp;');  
  htm_Plaintxt('@Angiv en mindre enhedspris, og 0% rabat, så beregnes en %-rabat svarende til pris-rabatten.');
  htm_hr();
  textKnap($label='@Tilføj Ny varepost',  $title='@Opret ny varepostering', $link='../_base/page_Blindgyden.php');
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :DEBITOR:
# Kaldes fra:  [_debitor/page_Opretordre.php] [_debitor/page_Ordreliste.php] 
function Panl_YdelserTabl($Ordrnr,$data,$fakt,$TopLine) {  ## out_PanlsPrim.php
  htm_Panl_Top($name='linkform',$capt=tolk('@Ordren').' '.$Ordrnr.' '.tolk('@angår:'),$parms='page_Blindgyden.php',
               $icon='fas fa-shopping-cart','panelW100',__FUNCTION__);
  SpalteTop(320); 
  Panl_Betingelser($debigrup, $betaling, $frist, $print2, $kunderef); 
  NextSpalte(320); 
  Panl_Fakturering ($navn='Anders And', $addr='Andedammen 34', $sted='Ved Lunden', $ponr='1234', $by='Eventyrland', $land='Eventyrland', 
                      $noter='Levering på anden adresse!', $telf='045 12345678', $att='Rap', $email='anders@and.dk', $usemail='', $faktdato);
  NextSpalte(320); 
  Panl_Levering($navn= 'Andersine', $addr= 'Redekasse 12', $sted= 'Ved Lunden', $ponr= '1234', $by= 'Fuglebjerg', $land= 'Eventyrland', 
                            $telf= '045 87654321', $email= 'andersine@and.dk', $forsend= 'Fragt: DSV', $noter= 'Afleveres ved bredden!', $afsendt= '', $levdato='',$xx='',$xx='');
  SpalteBund();
  htm_Caption($TopLine);
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
      ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Pos.',         '5%','indx', '',  ['center'],'@Pos. nr tildeles automatisk','...pos...'],
        ['@Varenr',       '8%','text', '',  ['center'],'@Varenummer for ydelsen','Varenr...'],
        ['@Antal',        '3%','text', '',  ['center'],'@Mængden angivet som antal ','@Antal...'],
        ['@Enhed',        '6%','text', '',  ['left'  ],'@Enheds betegnelse ','@Enh...'],
        ['@Beskrivelse', '30%','text', '',  ['left'  ],'@Beskrivelse af varen/ydelsen ','@Besk...'],
        ['@Moms%',        '5%','text', '',  ['center'],'@Moms pct.sats ','@Moms...'],
        ['@À pris',       '8%','text', '2d',['center'],'@Enhedspris ','@Pris...'],
        ['@Rabat%',       '8%','text', '1d',['right' ],'@Rabat procent','@Rabat...'],
        ['@Ialt',         '8%','text', '2d',['right' ],'@Kalkuleret beløb for den aktuelle postering. ',''],
        ['@Valuta',       '4%','text', '',  ['center'],'@Valutakode for den valuta, som er benyttet på specifikationen.','DKK'],
//      ['@Forfald',      '9%','hidd', '',  ['center'],'@Beløbets forfalds dato','forf.dato'],
      ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ['@Fortryd',      '3%','text', '',  ['center'],
                      tolk('@Fortryd postering! Tilbagefør beløbet ved at klikke på ikonen.').' '.
                      tolk('@Er ordren faktureret, kan posten tilbageføres, indtil ordren er bogført. Derefter skal det ske ved at kreditere kunden!'),
                      '<a href='.$link.'><ic class="fas fa-undo" style="font-size:14px; color:red;" title="'.
                      tolk('@Tilbagefør denne postering, f.eks. fortryd rykkergebyr').'"></ic></a>'],
        ['@Flyt',         '2%','text', '',  ['center'], '@Flyt denne post op eller ned.',
                      '<a href='.$link.'><ic class="fas fa-arrows-alt-v" style="font-size:14px; color:green;" title="'.
                      tolk('@Virker ikke endnu').'"></ic></a>']
            ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON, ]
    // $DATA,#=   array(),
    $data= array( //  DEMO:
      [1, '45-876', $antal=3, 'stk', 'Redekasser', $momssats=25, $pris=235.50, $rabat=8,  $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100, 'DKK'],
      [2, '45-876', $antal=2, 'stk', 'Redekasser', $momssats=25, $pris=235.50, $rabat=8,  $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100, 'DKK'],
      [3, '45-876', $antal=3, 'stk', 'Redekasser', $momssats=25, $pris=235.50, $rabat=12, $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100, 'DKK'],
      [4, '45-876', $antal=3, 'stk', 'Redekasser', $momssats=25, $pris=235.50, $rabat=8,  $ialt=($antal*$pris)*(100-$rabat)/100*(100+$momssats)/100, 'DKK']
    ),
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '250px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  foreach ($data as $dat) $total= $total+$dat[8];   $moms= $total/100*25;   $netto= number_format((float)($total-$moms),2,',','.'); 
  htm_FrstFelt('00%');  
  htm_NextFelt('02%; text-align:right ');  htm_Caption('@Status: ');
  htm_NextFelt('15%');  htm_nl(); htm_CheckFlt($type='checkbox', $name='fakt', $valu= $fakt, $labl='@Er Faktureret og låst', $titl='@Når ordren er faktureret, afmærkes feltet automatisk',$revi=false);
  htm_NextFelt('05%');  //  Dækningsbidrag: 3.400,00 	Dækningsgrad: 100,00 htm_DataFelt($label,$data,$algn='left')
  htm_NextFelt('35%');  htm_DataFelt('@Dækningsbidrag: ',$netto); htm_sp(2); htm_DataFelt('@Dækningsgrad: ','100%');
  htm_NextFelt('08%; text-align:right ');  htm_Caption('@Aktuel total: ');
  htm_NextFelt('08%');  htm_CombFelt($type='tal2dc', $name='total', $valu= $total, $labl='@Total',   $titl='@Beregnet sum af alle posteringers ialt beløb', $revi=false);
  htm_NextFelt('05%');
  htm_NextFelt('07%; text-align:right ');  htm_Caption('@Deri moms: ');
  htm_NextFelt('10%');  htm_CombFelt($type='tal2dc', $name='moms', $valu= $moms, $labl='@Moms',   $titl='@Beregnet sum af alle posteringers moms beløb', $revi=false);
  htm_NextFelt('02%');
  htm_LastFelt();
  htm_Plaintxt(tolk('@TIP angående Beløbsrabat:').'&nbsp;');  
  htm_Plaintxt('@Angiv en mindre enhedspris, og 0% rabat, så beregnes en %-rabat svarende til pris-rabatten.');
  htm_KnapGrup('@Dine muligheder:',true,true);
    textKnap($label='@Kopier',  $title='@Kopiér til ny ordre-forslag, med samme indhold.', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Udskriv', $title='@Åbn et PDF-dokument med faktura, som kan gemmes eller viderebehandles på anden vis.', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Følgeseddel', $title='@Åbn et PDF-dokument med følgeseddel, som kan gemmes eller viderebehandles på anden vis.', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Kreditér',  
              $title= tolk('@Klik her for at oprette en kreditnota, som helt eller delvist krediterer denne faktura.').'<br>'.
                      tolk('@Kreditnotaen oprettes som en kreditnotaordre, som kan redigeres inden bogføring.').'<br>'.
                      tolk('@Eksempelvis hvis kun en enkelt faktureret vare skal krediteres.'), $link='../_base/page_Blindgyden.php');
  htm_KnapGrup('@Dine muligheder:',false);
  
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :DEBITOR:
# Kaldes fra: Panl_Ydelser
function Varelinie(&$posi, &$varenr, &$antal, &$enhed, &$beskriv, &$momssats, &$pris, &$rabat, &$ialt) {  ## out_PanlsPrim.php
  htm_FrstFelt('20%');  htm_CombFelt($type='text',  $name='posi',     $valu= $posi,     $labl='@Pos.',    $titl='@Position styrer rækkefølgen af posterne', $revi=true, $rows='',$width='45');
  htm_NextFelt('30%');  htm_CombFelt($type='text',  $name='varenr',   $valu= $varenr,   $labl='@Varenr',  $titl='@Angiv varenr',              $revi=true, $rows='',$width='45');
  htm_NextFelt('20%');  htm_CombFelt($type='tal1d', $name='antal',    $valu= $antal,    $labl='@Antal',   $titl='@Angiv Antal',               $revi=true, $rows='',$width='45',$step='0.25');
  htm_NextFelt('30%');  htm_CombFelt($type='text',  $name='enhed',    $valu= $enhed,    $labl='@Enhed',   $titl='@Enhed udfyldes automatisk', $revi=false,$rows='',$width='45');
  htm_LastFelt();
                        htm_CombFelt($type='area',  $name='beskriv',  $valu= $beskriv,  $labl='@Beskrivelse', $titl='@Angiv beskrivelse af ydelsen',  $revi=true, $rows='2');
  htm_FrstFelt('20%');  htm_CombFelt($type='tal2d', $name='momssats', $valu= $momssats, $labl='@Moms%',   $titl='@Momssats for ydelsen',      $revi=true, $rows='', $width='45',$step='0.25');
  htm_NextFelt('25%');  htm_CombFelt($type='tal2d', $name='pris',     $valu= $pris,     $labl='@Pris',    $titl='@Angiv enhedspris',          $revi=true, $rows='', $width='45');
  htm_NextFelt('28%');  htm_CombFelt($type='tal1d', $name='rabat',    $valu= $rabat,    $labl='@Rabat%',  $titl='@Angiv rabatbeløb',          $revi=true, $rows='', $width='45');
  htm_NextFelt('22%');  htm_CombFelt($type='tal2d', $name='ialt',     $valu= $ialt,     $labl='@Ialt',    $titl='@Beregnet felt: ialt',       $revi=false,$rows='', $width='45');
  htm_LastFelt();
  echo '<hr color="green">';
}

######### :DEBITOR:
# Kaldes fra: Panl_YdelserWide
function VarelinieWide( &$posi, &$varenr, &$antal, &$enhed, &$beskriv, &$momssats, &$pris, &$rabat, &$ialt) {  ## out_PanlsPrim.php
  htm_FrstFelt('05%');  htm_CombFelt($type='text',  $name='posi',     $valu= $posi,     $labl='@Pos.',        $titl='@Position styrer rækkefølgen af posterne', $revi=true, $rows='',$width='45',$step='1');
  htm_NextFelt('08%');  htm_CombFelt($type='text',  $name='varenr',   $valu= $varenr,   $labl='@Varenr',      $titl='@Angiv varenr',                $revi=true, $rows='',$width='45');
  htm_NextFelt('05%');  htm_CombFelt($type='tal1d', $name='antal',    $valu= $antal,    $labl='@Antal',       $titl='@Angiv Antal',                 $revi=true, $rows='',$width='45',$step='0.25');
  htm_NextFelt('08%');  htm_CombFelt($type='text',  $name='enhed',    $valu= $enhed,    $labl='@Enhed',       $titl='@Enhed udfyldes automatisk',   $revi=false,$rows='',$width='45');
  htm_NextFelt('35%');  htm_CombFelt($type='area',  $name='beskriv',  $valu= $beskriv,  $labl='@Beskrivelse', $titl='@Angiv beskrivelse af ydelsen',$revi=true, $rows='1');
  htm_NextFelt('07%');  htm_CombFelt($type='tal2d', $name='momssats', $valu= $momssats, $labl='@Moms%',       $titl='@Momssats for ydelsen',        $revi=true, $rows='', $width='45',$step='0.5');
  htm_NextFelt('08%');  htm_CombFelt($type='tal2d', $name='pris',     $valu= $pris,     $labl='@Pris',        $titl='@Angiv enhedspris',            $revi=true, $rows='', $width='45',$step='0.25');
  htm_NextFelt('06%');  htm_CombFelt($type='tal1d', $name='rabat',    $valu= $rabat,    $labl='@Rabat%',      
                                     $titl='@Angiv rabatsats i %, eller angiv 0% og en reduceret enhedspris, hvis der skal ydes en beløbs rabat',   $revi=true, $rows='', $width='45',$step='0.25');
  htm_NextFelt('09%');  htm_CombFelt($type='tal2d', $name='ialt',     $valu= $ialt,     $labl='@Linie ialt',  $titl='@Beregnet felt: ialt',         $revi=false,$rows='', $width='45',$step='0.25');
  htm_LastFelt();
}

######### :DEBITOR:
# Kaldes fra:  [_debitor/page_Debitor.php] 
function wall_DebitorKort($center=false) {   ## out_PanlsPrim.php
//  Sammensatte Paneler! = "Vindue". Skal ændre til page_... ell. wall_...
  if ($center) echo '<span style="width:1000px; margin:auto">';
  htm_Tapet_Top($name='debikort' ,$capt='@Debitorkort', $parms='page_Blindgyden.php', $icon='far fa-file-alt', $klasse='panelW100',__FUNCTION__,'','konti1');
  SpalteTop(320);
    Panl_Kunden($kontonr, $kategori, $cvrnr, $eannr, $bankreg, $bankkto, $instit, $ansv, $formsprog, $homeweb);       
    Panl_CVRopslag('debitor');
    Panl_Betingelser($debigrup, $betaling, $frist, $print2, $kunderef);     
  NextSpalte();
    Panl_Fakturering ($navn='Anders And', $addr='Andedammen 34', $sted='Ved Lunden', $ponr='1234', $by='Eventyrland', $land='Eventyrland', 
                      $noter='Levering på anden adresse!', $telf='045 12345678', $att='Rap', $email='anders@and.dk', $usemail='', $faktdato);   
    Panl_Ekstrafelter($felt1, $felt2, $felt3, $felt4, $felt5, $custFelt= array(
    // [Label,          Hint,                    Placeholder  ]
      ['@Ordre Felt 1','@Ordre - Udfyld Felt 1','@Ord. Felt 1...'],
      ['@Ordre Felt 2','@Ordre - Udfyld Felt 2','@Ord. Felt 2...'],
      ['@Ordre Felt 3','@Ordre - Udfyld Felt 3','@Ord. Felt 3...'],
      ['@Ordre Felt 4','@Ordre - Udfyld Felt 4','@Ord. Felt 4...'],
      ['@Ordre Felt 5','@Ordre - Udfyld Felt 5','@Ord. Felt 5...'])
    );    
  NextSpalte();
    Panl_Kontakter();   
    Panl_Mailfaktura($emne, $text, $vedhft, $copyto, $bccopy);    
  SpalteBund();
  
  echo '<span style= "border: 1px solid gray;">';
  htm_KnapGrup('@Er kunden ikke registreret:',true,false);
    textKnap($label='@Opret ny kunde',  $title='@Opret ny debitor, ved at indtaset oplysninger', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Opret ny erhvervskunde',  $title='@Opret ny erhvervs debitor, med mulighed for at hente oplysninger i CVR-registret', $link='../_base/page_Blindgyden.php');
  htm_KnapGrup('@Er kunden ikke registreret:',false);
  //htm_nl();
  htm_KnapGrup('@Iøvrigt:',true,false);
    textKnap($label='@Historik',      $title='@Se ...', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Kontokort',     $title='@Se ...', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Fakturaliste',  $title='@Se ...', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Jobliste',      $title='@Se ...', $link='../_base/page_Blindgyden.php');
  htm_KnapGrup('@Iøvrigt:',false);
  echo '</span>';
  
  // Historik Kontokort Fakturaliste  Jobliste
  htm_TapetBund();
  if ($center) echo '</span>';
  PanelInitier(2,8);  PanelMax(2);  PanelMax(5);
}
######### :DEBITOR:
# Kaldes fra: [_debitor/page_Debitor.php] 
function Panl_DebtDebitor($TablData=array()) {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'PanelForm',$capt= '@Debitorliste',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-database',
               'panelW110',__FUNCTION__,'','legeplads:lege-side#find_din_kunde_i_debitorlisten');
  htm_Table(
    $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
        ['@Her har du ','15%', 'html', '', 'left', '', '@alle registrerede kunder'],
      ),
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Kontonr',    '6%','indx','',['center'],'@Debitor konto nummer','..auto..'],
        ['@Kunde navn','20%','text','',['left'  ],'@Kunde-/Firma-navn','@Navn...'],
        ['@Adresse',   '14%','text','',['left'  ],'@Postadresse','@Addr...'],
        ['@Sted',      '14%','text','',['left'  ],'@Sted','@Sted...'],
        ['@Postnr',     '6%','text','',['left'  ],'@Postnummer','@Post...'],
        ['@By',        '15%','text','',['left'  ],'@By','@By...'],
        ['@Kontakt',   '10%','text','',['left'  ],'@Kontakt navn','@Kont...'],
     //  '@titel' / rolle   '@Kontakt personens titel eller rolle','@Titl...'
        ['@Telefon',    '8%','text','',['left'  ],'@Telefon nummer','@Telf...'],
        ['@Sælger',     '6%','text','',['left'  ],'@Sælger','@Sælg...']
      ),
    $RowSuff= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
    //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $TablData= array( # DemoData:
        ['1025','Firmanavn','Adresse','Sted','Postnr','By','Kontakt','Telefon','Sælger'],
        ['1026','Firmanavn','Adresse','Sted','Postnr','By','Kontakt','Telefon','Sælger'],
        ['1027','Firmanavn','Adresse','Sted','Postnr','By','Kontakt','Telefon','Sælger'],
        ['1028','Firmanavn','Adresse','Sted','Postnr','By','Kontakt','Telefon','Sælger']
      ),
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '200px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
//  htm_KnapGrup('@Her kan du:',true,false);
//    textKnap($label='@Oprette Ny',    $title='@Opret ny debitor', $link='../_base/page_Blindgyden.php');
//    textKnap($label='@Se Historik', $title='@Historik for',     $link='../_base/page_Blindgyden.php');    
//    textKnap($label='@Visning',     $title='@Bestem hvilke felter der skal vises i listen', $link='../_base/page_Blindgyden.php');
//  htm_KnapGrup('',false);
//  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='');
}

######### :DEBITOR:
# Kaldes fra:  [_debitor/page_Ordreliste.php] [_base\out_vinduer.php]
function Panl_DebtOrdrer(&$TablData) {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'PanelForm',$capt= '@Ordrer: Debitorer - `Salgsordrer`:',$parms= '../_base/page_Hovedmenu.php',$icon= 'fas fa-database','panelWmax',__FUNCTION__);

  htm_Table(
   $TblCapt= array( 
          ['@Viser:',   'Width',    'Type',    'OutFormat', 'horJust',      'Tip',    'placeholder', '@Kundeordrer'] 
      ),
   $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      ),
   $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Ordre nr.',  '6%','indx', '',   ['center'],  '@Ordre nummer','..auto..'],
          ['@Ordre dato', '6%','date', '',   ['left'  ],  '@Ordre dato','YYYY-MM-DD'],
          ['@Lev. dato',  '6%','date', '',   ['left'  ],  '@Leverings dato','YYYY-MM-DD'],
          ['@Konto nr.',  '7%','text', '',   ['center'],  '@Debitor konto nummer','@Kont...'],
          ['@Firma navn','20%','text', '',   ['left'  ],  '@Firma navn','@Firm...'],
          ['@Sælger',     '8%','text', '',   ['left'  ],  '@Sælger','@Sælg...'],
          ['@Ordre sum',  '7%','text', '2d', ['right' ],  '@Ordre sum','@Beløb...'],
          ['@Status',     '6%','osta', '',   ['left'  ],  '@Status','@Status...'] //  ORD_Status()
      ),
   $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
      ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON]
   $TablData, #=   array(      ),
   $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
   $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
   $CreateRec=true,       # Mulighed for at oprette en record
   $ModifyRec=true,       # Mulighed for at ændre data i en row
   $ViewHeight= '150px',  # Højden af den synlige del af tabellens data
     __FUNCTION__
  );


  htm_nl();
  htm_KnapGrup('Handling:',true,false);
    textKnap($label='@Ny ordre',      $title='@Opret ny ordre', $link='../_base/page_Blindgyden.php');
    textKnap($label='@Tilbud',        $title='@Opret Tilbud',   $link='../_base/page_Blindgyden.php');    
    textKnap($label='@Ordrer',        $title='@Ordrer',         $link='../_base/page_Blindgyden.php');
    textKnap($label='@Faktura',       $title='@Faktura',        $link='../_base/page_Blindgyden.php');
    textKnap($label='@Faktura KOPI',  $title='@Udskriv kopi af Faktura',  $link='../_base/page_Blindgyden.php');
    textKnap($label='@PBS',           $title='@PBS',            $link='../_base/page_Blindgyden.php');
    textKnap($label='@Import PBS',    $title='@Import PBS',     $link='../_base/page_Blindgyden.php');
    textKnap($label='@Importer UBL til ordrer', $title='@Importer UBL til ordrer', $link='../_base/page_Blindgyden.php');
  htm_KnapGrup('Handling:',false);
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
}

######### :DEBITOR:
# Kaldes fra:  [_debitor/page_Rapport-deb.php] 
function Panl_DebRapp() {  ## out_PanlsPrim.php
  set_FormVars(['debkonti','debdatefra','debdatetil']);  // Opdater alle variabler på form 'debiform' :
  
  htm_Panl_Top($name= 'debiform',$capt= '@Debitor-rapporter:',$parms= '#',$icon= 'fas fa-chart-line','panelW320',__FUNCTION__);
    htm_FrstFelt('04%');  
    htm_NextFelt('36%');  htm_Prompt('@Vælg kriterier:','right');  //echo '<p align="center";>'.tolk('@Angiv kriterier:').'</p> ';
    htm_NextFelt('02%');  
    htm_NextFelt('58%'); 
    htm_LastFelt();
    htm_FrstFelt('36%');  htm_CombFelt($type='text', $name= 'debkonti', $valu= $_SESSION['debkonti'], $labl= '@Kunde(r)',     
      $titl=tolk('@Angiv et kundenummer eller et interval adskilt af kolon.').'<br>'. //   Listen vil blive sorteret efter kundenummer
            tolk('@Der kan også skrives et kontonavn, f.eks:').'<br>'.
            tolk('@Skrives DANOSOFT aps vises kun bevægelser for DANOSOFT aps').'<br>'.
            tolk('@DANO* vil vise bevægelser for alle kunder, hvor navnet starter med DANO').'<br>'.
            tolk('@*aps vil vise alle, hvor navnet slutter på aps').'<br>'.
            tolk('@*SOFT* viser alle, hvor soft er en del af navnet'), 
      $revi=true);
  htm_NextFelt('32%');    htm_CombFelt($type='date',  $name='debdatefra',  $valu= $_SESSION['debdatefra'],   $labl='@Periode start',  
        $titl='@Dato for rapportens påbegyndelse. (Kontosaldi anvender kun slutdatoen, som pr. dato)', $revi=true);
  htm_NextFelt('32%');    htm_CombFelt($type='date',  $name='debdatetil',  $valu= $_SESSION['debdatetil'],   $labl='@Periode slut',   
        $titl=tolk('@Angiv periode slut Dato, for at se bevægelser indtil danne dato,').'<br>'.
              tolk('@(Kontosaldi: opgjort pr. denne dato)'), $revi=true);
  htm_LastFelt();
  htm_Accept($labl='@Benyt det', $title='@Godkend dine valg, så de benyttes ved rapportdannelse', $width='',$akey='b',$form='debiform');
  htm_KnapGrup('@Vis:',true);
    textKnap($label='@Åbne poster',     $title= '@Rapport for debitor åbne poster (kunders ubetalte fakturaer)',     
                                        $link=  '../_debitor/page_Rapport-deb.php?job=openpost',   $akey='å');
    textKnap($label='@Konto saldo',     $title= '@Viser en liste over saldi på valgt(e) konti pr. den angivne dato',     
                                        $link=  '../_debitor/page_Rapport-deb.php?job=ktsaldo',     $akey='s');    
    textKnap($label='@Konto kort',      $title= '@Rapport for debitor konto kort',      
                                        $link=  '../_debitor/page_Rapport-deb.php?job=ktkort',     $akey='k');
    textKnap($label='@Salgs statistik', $title= '@Rapport for debitor Salgs statistik', 
                                        $link=  '../_debitor/page_Rapport-deb.php?job=slgstat', $akey='s');
    textKnap($label='@Top 100',         $title= '@Rapport for Top 100',                 
                                        $link=  '../_debitor/page_Rapport-deb.php?job=top100',       $akey='1');
    textKnap($label='@Kasse spor',      $title= '@Oversigt over POS transaktioner (kontantsalgs posteringer)', 
                                        $link=  '../_debitor/page_Rapport-deb.php?job=ksspor',       $akey='1');
  htm_KnapGrup('@Vis:',false);
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Luk og gå retur til hovedmenu');
  dev_show();
}
######### :DEBITOR:
function DebiRappTop($rapp='') { //  Data dannes i: Panl_DebRapp
  htm_FrstFelt('40%');  htm_DataFelt('@KRITERIER for rapporten:','');
  htm_NextFelt('40%');  
  htm_NextFelt('20%');  
  htm_LastFelt();
  htm_FrstFelt('40%');  htm_DataFelt('@Kunde(r):',$_SESSION['debkonti']);
  htm_NextFelt('10%');  htm_DataFelt('@Periode:','','right'); 
  htm_NextFelt('25%');  htm_DataFelt('@Fra:',$_SESSION['debdatefra']);
  htm_NextFelt('25%');  htm_DataFelt('@Til:',$_SESSION['debdatetil']);
  htm_LastFelt();
  htm_LastFelt();
  htm_hr();
}

######### :DEBITOR:
function Panl_DebtOpenPost() {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'rappformopen',$capt= '@Åbne poster (ubetalte):',$parms='../_base/page_Blindgyden.php',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  DebiRappTop();
  htm_Table(
    $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
        ['@Her ser du ','15%', 'html', '', 'left', '', '@ubetalte fakturaer'],
      ),
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Løbenr.',    '6%','show','',['center'],'@Løbe nummer','..auto..'],
        ['@PBS',        '8%','show','',['left'  ],'@Reference til PBS','@pbs...'],
        ['@Firmanavn', '28%','show','',['left'  ],'@Firma navn','@Navn...'],
        ['@0-7',        '9%','show','',['right' ],'@Faktura alder 0-7 dage','@0.00'],
        ['@8-29',       '9%','show','',['right' ],'@Faktura alder 8-29 dage','@0.00'],
        ['@30-59',      '9%','show','',['right' ],'@Faktura alder 30-59 dage','@0.00'],
        ['@60-89',      '9%','show','',['right' ],'@Faktura alder 60-89 dage','@0.00'],
        ['@>=90',       '9%','show','',['right' ],'@Faktura alder >=90 dage','@0.00'],
        ['@I alt',     '10%','show','',['right' ],'@Sum','@0.00...']
      ),
    $RowSuff= array(
        ['@Vælg',       '6%','knap','',['center'],'@Marker de poster, som der skal ske handling på',''],
        
      ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
    //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $TablData= array( # DemoData:
        ['1','','Firmanavn','','','','','',''],
        ['2','','Firmanavn','','','','','',''],
        ['3','','Firmanavn','','','','','',''],
        ['4','','Firmanavn','','','','','','']
      ),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '200px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_KnapGrup('@Med de valgte:',true);
    textKnap($label='@Mail kontoudtog', $title='@Klik her for at maile kontoudtog til de modtagere som er afmærket ovenfor',  $link='../_base/page_Blindgyden.php',$akey='m');
    textKnap($label='@Opret rykker',    $title='@Klik her for at oprette rykker til dem, som er afmærket ovenfor',            $link='../_debitor/DebtOpretRykker.php',$akey='o');    
    textKnap($label='@Ryk alle',        $title=tolk('@Denne funktion gør følgende:').'<ul><li>'.
                                               tolk('@udligner alle konti, hvor saldo er 0.').'</li><li>'.
                                               tolk('@opretter rykkere, hvor betalingsfrist er overskredet med det antal dage, som er valgt under indstillinger -> rykkervalg,').'</li><li>'.
                                               tolk('@bogfører åbne rykkere, hvor betalingsfrist er overskredet, og opretter rykkere på næste niveau for disse').'</li><li>'.
                                               tolk('@Sletter åbne rykkere, som er blevet betalt.').'</li></ul>',      $link='../_base/page_Blindgyden.php',$akey='a');
  htm_KnapGrup('@Med de markerede:',false);
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}

######### :DEBITOR:
function Panl_DebtOpretRykker() {  ## out_PanlsPrim.php
  global $blanket;
  htm_Panl_Top($name= 'oprtrykk',$capt= '@Opret rykker:',$parms='../_base/page_Blindgyden.php',$icon='far fa-file-alt','panelW100',__FUNCTION__);
  SpalteTop(320); 
  Panl_Kunden($kontonr, $kategori, $cvrnr, $eannr, $bankreg, $bankkto, $instit, $ansv, $formsprog, $homeweb);       
  NextSpalte(320); 
  Panl_Fakturering($navn='Anders And', $addr='Andedammen 34', $sted='Ved Lunden', $ponr='1234', $by='Eventyrland', $land='Eventyrland', 
                   $noter='Levering på anden adresse!', $telf='045 12345678', $att='Rap', $email='anders@and.dk', $usemail='', $faktdato);
  NextSpalte(320); 
  Panl_Betingelser($debigrup, $betaling, $frist, $print2, $kunderef); 
  Panl_Mailfaktura($emne, $text, $vedhft, $copyto, $bccopy);
  SpalteBund();
  $liste= [ //  Subset: FRM_Liste()
            ['@6: blanket for 1. rykker', '6', '@6: Rykker 1',''],
            ['@7: blanket for 2. rykker', '7', '@7: Rykker 2',''],
            ['@8: blanket for 3. rykker', '8', '@8: Rykker 3',''],
          ];
  if (!$blanket) $blanket= '6';  //  1. rykker
  htm_OptioFlt($type='text',  $name='blanketkode',  $valu= $blanket,   
                    $labl='@Vælg blanket',  
                    $titl='@Her vælger du udskriftsformularen du vil anvende',  
                    $revi=true, $optlist= $liste,$action='#',$events='',$maxwd='150px'); //  ['6','7','8']
  if (isset($_POST['blanketkode'])) $blanket= $_POST['blanketkode'];
  htm_Caption(tolk('@Forhåndsvisning af blanket').' '.tolk(ListLookup(FRM_Liste(),$search=$blanket ,$colsearch=1,$colresult=2)));
  htm_nl(1);
  $DATA= sql_readB('SELECT id, form, frm_art, side, besk, just, x0, y0, dx, dy, dim, colr, font, style, imglnk, lngkey, note '.
                   'FROM tblA_forms '.  //  6:Rykker1, 0:Layout, G:generelt
                   'WHERE form= '.$blanket,__FILE__, __LINE__);  // echo var_dump_arr($DATA);
  // DATA: frm_art:"0" side:"G" -> besk:"A4-portrait" -> $pform='A4', $pagewidth=210, $pageheight=297, (PageListe(), PaprListe())
  printForm($DATA, $blanket, $pform='A4', $pagewidth=210, $pageheight=297, $vistools=false);
  htm_KnapGrup('@Hvad nu?:',true);
    textKnap($label='@Udskriv',   $title='@Vis rykkeren på en udskriftsvenlig side',  $link='../_base/page_Blindgyden.php',$akey='u');
    textKnap($label='@Send mail', $title='@Klik her for at sende rykkeren som mail, forudsat de nødvendige indstillinger er sat, for den aktuelle kunde',  
             $link='../_base/page_Blindgyden.php',$akey='s');    
  htm_KnapGrup('@Hvad nu?:',false);
  htm_PanlBund($pmpt='@Vis udskrift',$subm=false,'@Vis rykkeren på en udskriftsvenlig side');
}

######### :DEBITOR:
function Panl_DebtKontoliste() {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'rappformklist',$capt= '@Saldo liste:',$parms='../_base/page_Blindgyden.php',$icon='far fa-file-alt','panelW480',__FUNCTION__);
  DebiRappTop();
  htm_Table(
    $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
        ['@Her ser du ','25%', 'html', '', 'left', '', '@tilgodehavender'],
      ),
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@kontonr.',   '5%','show','',['center'],'@Løbe nummer','..auto..'],
        ['@Firmanavn', '80%','show','',['left'  ],'@Firma navn','@Navn...'],
        ['@kontosum',  '10%','show','',['right' ],'@Faktura alder 0-7 dage','@0.00'],
      ),
    $RowSuff= array(
      ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
    //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $TablData= array( # DemoData:
        ['1011','Firmanavn',''],
        ['1012','Firmanavn',''],
        ['1013','Firmanavn',''],
        ['1014','Firmanavn','']
      ),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '130px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_FrstFelt('49%');  
  htm_NextFelt('30%');  htm_Prompt('@Udestående i alt:','right'); 
  htm_NextFelt('20%');  htm_CombFelt($type='tal2d',  $name='ialt',  $valu= $ialt=0,   $labl='',$titl='@Summen af de listede beløb.', $revi=false);
  htm_NextFelt('01%');  
  htm_LastFelt();
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}

######### :DEBITOR:
function Panl_DebtKontoKort() {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'rappformkk',$capt= '@Konto kort:',$parms='../_base/page_Blindgyden.php',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  DebiRappTop();
  $kunde= ['','',''];
  foreach ($kunde as $kun) {
    echo '<span style="background:lightyellow;">';
    $navn= 'T. Petersen';   $konto= '1000';   $gade= 'Hovedgaden 27, 3tv';   $dato= '27-06-2018';   $postnr= '8600';   $by= 'Århus N';   $valuta= 'DKK';   
    htm_FrstFelt('04%');  
    htm_NextFelt('60%');  htm_DataFelt('',$navn); 
    htm_NextFelt('05%');  
    htm_NextFelt('25%');  htm_DataFelt('@Kontonr:',$konto,''); 
    htm_NextFelt('05%');  
    htm_LastFelt();
    htm_FrstFelt('04%');  
    htm_NextFelt('60%');  htm_DataFelt('',$gade); 
    htm_NextFelt('05%');  
    htm_NextFelt('25%');  htm_DataFelt('@Dato:',$dato,''); 
    htm_NextFelt('05%');  
    htm_LastFelt();
    htm_FrstFelt('04%');  
    htm_NextFelt('60%');  htm_DataFelt('',$postnr); htm_DataFelt('&nbsp;&nbsp;',$by); 
    htm_NextFelt('05%');  
    htm_NextFelt('25%');  htm_DataFelt('@Valuta:',$valuta,''); 
    htm_NextFelt('05%');  
    htm_LastFelt();
    echo '</span>';
    htm_Table(
      $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
          //['@Her ser du ','15%', 'html', '', 'left', '', '@ubetalte fakturaer'],
        ),
      $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Dato' ,   '12%','date','',['center'],'@Faktura dato','@dato..'],
          ['@Bilag',    '8%','show','',['center'],'@Bilag nummer','@nr...'],
          ['@Fakt.',    '8%','show','',['center'],'@Faktura nummer','@nr'],
          ['@Tekst',   '25%','show','',['left'  ],'@Tekst','@txt...'],
          ['@Forfald', '12%','date','',['left'  ],'@Forfald','@dato..'],
          ['@Debet',    '9%','show','',['right' ],'@Debet','@0.00'],
          ['@Kredit',   '9%','show','',['right' ],'@Kredit','@0.00'],
          ['@Saldo',   '12%','show','',['right' ],'@Saldo','@0.00'],
          //  
        ),
      $RowSuff= array(
        ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
      //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
      $TablData= array( # DemoData:
          [' ',' ',' ','Primosaldo',' ',' ',' ',''],
          ['2017-06-01','bilag','fakt','','','','',''],
          ['','bilag','fakt','','','','',''],
          ['','bilag','fakt','','','','','']
        ),
      $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
      $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
      $CreateRec=false,       # Mulighed for at oprette en record
      $ModifyRec=false,       # Mulighed for at ændre data i en row
      $ViewHeight= '130px',  # Højden af den synlige del af tabellens data
      $CalledFrom= __FUNCTION__
    );
  htm_hr();
  }
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}

######### :DEBITOR:
function Panl_DebtSalgsstat() {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'rappformsalg',$capt= '@Salgs statistik:',$parms='../_base/page_Blindgyden.php',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  DebiRappTop();
  $kunde= ['',''];
  foreach ($kunde as $kun) {
    htm_FrstFelt('04%');    htm_NextFelt('60%');  htm_DataFelt('@Firmanavn:','T. Petersen'); 
    htm_NextFelt('05%');    htm_NextFelt('25%');  htm_DataFelt('@Kontonr:','1000',''); 
    htm_NextFelt('05%');    htm_LastFelt();
    htm_Table(
      $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
        ),
      $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Varenr.' ,    '10%','show','',  ['center'],'@Varenr.','@nr..'],
          ['@Beskrivelse', '55%','show','',  ['left'  ],'@Beskrivelse','@txt...'],
          ['@Antal.',       '4%','show','0d',['center'],'@Antal','@tal...'],
          ['@Pris',        '12%','show','2d',['right' ],'@Pris','@pris...'],
          ['@Sum',         '16%','show','2d',['right' ],'@Sum','@0.00'],
        ),
      $RowSuff= array(
        ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
      //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
      $TablData= array( # DemoData:
          ['100','Udført arbejde','8','375','3000'],
          ['Matr.','Diverse materialer og afdækning','1','400','400'],
        ),
      $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
      $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
      $CreateRec=false,       # Mulighed for at oprette en record
      $ModifyRec=false,       # Mulighed for at ændre data i en row
      $ViewHeight= '130px',  # Højden af den synlige del af tabellens data
      $CalledFrom= __FUNCTION__
    );
  htm_hr();
  }
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}

######### :DEBITOR:
function Panl_DebtTop100() {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'rappformt100',$capt= '@Top 100:',$parms='../_base/page_Blindgyden.php',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  DebiRappTop();
  htm_Table(
      $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
        ),
      $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Nr.' ,       '10%','show','',  ['center'],'@Placering','@nr..'],
          ['@Kontonr.',   '10%','show','',  ['center'],'@Kontonr','@nr...'],
          ['@Firmanavn',  '60%','show','',  ['left'  ],'@Firmanavn','@navn...'],
          ['@Omsætning',  '16%','show','2d',['right' ],'@Sum','@0.00'],
        ),
      $RowSuff= array(
        ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
      //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
      $TablData= array( # DemoData:
          ['1','4567','dgdgdf','345243'],
          ['2','2667','sajdlk ','325003'],
        ),
      $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
      $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
      $CreateRec=false,       # Mulighed for at oprette en record
      $ModifyRec=false,       # Mulighed for at ændre data i en row
      $ViewHeight= '130px',  # Højden af den synlige del af tabellens data
      $CalledFrom= __FUNCTION__
    );
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}

######### :DEBITOR:
function Panl_DebtKassespor() {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'rappformkssp',$capt= '@Kasse spor:',$parms='../_base/page_Blindgyden.php',$icon='far fa-file-alt','panelW960',__FUNCTION__);
  DebiRappTop();
  htm_Table(
      $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
        ),
      $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Status',   '5%','show','',  ['center'],'@Status','@Ukendt!'],
          ['@Id.',      '4%','show','',  ['center'],'@Identifikations nummer','@nr...'],
          ['@Bon dato', '7%','date','',  ['center'],'@Kasse bons datering','@dato...'],
          ['@Klokken',  '7%','show','',  ['center'],'@Kasse Bon tidspunkt','@00:00:00'],
          ['@Bon nr.',  '7%','show','',  ['center'],'@Kasse Bon nummer','@nr...'],
          ['@Kasse',    '4%','show','',  ['left'  ],'@Kasse nummer','@kasse...'],
          ['@Bord.',    '4%','show','',  ['center'],'@Kunde Bord nummer','@bord...'],
          ['@Ref.',    '10%','show','',  ['left'  ],'@Referance','@ref...'],
          ['@Beløb',    '6%','show','2d',['right' ],'@Opgjort Beløb','@0.00'],
          ['@Betaling', '6%','show','2d',['right' ],'@Betalings middel','@0.00'],
          ['@Modtaget', '6%','show','2d',['right' ],'@Modtaget beløb','@0.00'],
          ['@Retur',    '6%','show','2d',['right' ],'@Byttepenge','@0.00'],
        ),
      $RowSuff= array(
        ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
      //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
      $TablData= array( # DemoData:
          ['','1','','','','','','','','','',''],
          ['','2','','','','','','','','','',''],
          ['','3','','','','','','','','','',''],
        ),
      $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
      $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
      $CreateRec=false,       # Mulighed for at oprette en record
      $ModifyRec=false,       # Mulighed for at ændre data i en row
      $ViewHeight= '130px',  # Højden af den synlige del af tabellens data
      $CalledFrom= __FUNCTION__
    );
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}

######### :DEBITOR:
# Kaldes fra:  [_debitor/page_GruppeInfo.php] 
function Panl_GruppeInfo() {  ## out_PanlsPrim.php
  msg_Dialog('tip',ucfirst(tolk('@Luk')),'JavaScript:window.history.back();','','','','',ucfirst(tolk('@Lidt omtale af grupper.')),ucfirst(
            tolk('@Indeling i grupper er en praktisk metode, til at begrænse antallet af viste debi-/kreditorer (en slags filter), ').
            tolk('@og til at tildele medlemmer af gruppen, relevante fælles parametre.')));
}



######### :DEBITOR: ######### Slut funktioner angående visninger i menu-gruppen DEBITOR


######### :KREDITOR: ######### Start funktioner angående visninger i menu-gruppen KREDITOR

######### :KREDITOR:
# Kaldes fra: Panl_KreditorKort
function Panl_Leverandor(&$kontonr, &$kategori, &$cvrnr, &$eannr, &$bankreg, &$bankkto, &$instit, &$ansv, &$formsprog, &$homeweb) {  ## out_PanlsPrim.php
  htm_Panl_Top($name='kundform',$capt='@Leverandør - Oplysninger:',$parms='page_Blindgyden.php',$icon='fas fa-user',$klasse='panelWmax',__FUNCTION__);
  htm_CombFelt($type='text',  $name='DBix',   $valu= $kontonr,  $labl='@Leverandørnr.',          $titl='@Leverandørnr: Kan ikke rettes. Systemet styrer dette', $revi=false,'','','','','..auto..');  
//  htm_RadioGrp($type='hori',  $name='Ktyp',                     $labl='@Leverandørtype',         $titl='@Leverandør kategori',          
//              $optlist= array(['privat','@Privat','@eller'],['erhverv','@Erhverv','']),$action='');
  $Erhv= 'placeholder="...'.tolk('@kun erhverv').'..."';  // Returnering af værdi i &$kategori ?
  htm_CombFelt($type='text',  $name='CVR',    $valu= $cvrnr,    $labl='@CVR-nr',            
    $titl='@CVR - Virksomheds ID. Kan benyttes i CVR-opslag, til at importere Erhvervsstyrelsens offentlige data',    $revi=true,'','','',$Erhv,'CVR...');
//  htm_CombFelt($type='text',$name='EAN',    $valu= $eannr,    $labl='@EAN',             $titl='@EAN - Elektronisk-betalings ID',    $revi=true,'','','',$Erhv);
  htm_CombFelt($type='text',  $name='bank',   $valu= $bank,     $labl='@Bank',            $titl='@Bank',                    $revi=true,'','','','','Bank...');  
  htm_FrstFelt('30%');                                          
    htm_CombFelt($type='text',$name='bankreg',$valu= $bankreg,  $labl='@Bank reg.',       $titl='@Bank reg.',               $revi=true,'','','','','Reg...');  
  htm_NextFelt('70%');                                          
    htm_CombFelt($type='text',$name='bankkto',$valu= $bankkto,  $labl='@Bank konto',      $titl='@Bank konto',              $revi=true,'','','','','Konto...');  
  htm_lastFelt();                                               
  htm_FrstFelt('33%'); 
  htm_CombFelt($type='text',$name='swift',    $valu= $swift,    $labl='@SWIFT nr.',       $titl='@SWIFT nummer',            $revi=true,'','','','','SWIFT...');  
  htm_NextFelt('33%');
  htm_CombFelt($type='text',$name='kredkto',  $valu= $kredkto,  $labl='@FI kreditor nr.', $titl='@FI kreditor nr.',         $revi=true,'','','','','FI...');  
  htm_NextFelt('33%');
  htm_CombFelt($type='text',$name='kredmax',  $valu= $kredmax,  $labl='@Kredit max.',     $titl='@Maximal kredit',          $revi=true,'','','','','Max...');  
  htm_lastFelt();                                               
  htm_OptioFlt($type='text',  $name='erhkode',  $valu= $erhkode,   
                    $labl='@ERH kode',  
                    $titl='@ERH kode',  
                    $revi=true, $optlist= ERH_Liste(),$action='');
  htm_nl();
  htm_FrstFelt('50%'); 
  htm_CheckFlt($type='checkbox',$name='lukket', $valu= $lukket, $labl='@Lukket',          $titl='@Kontoen er lukket',       $revi=true);
//  htm_CombFelt($type='text',  $name='inst',   $valu= $instit,   $labl='@Institution',       $titl='@Supplerende oplysning',   $revi=true,'','','',$Erhv);
  htm_NextFelt('50%');
  htm_CombFelt($type='text',  $name='ansv',   $valu= $ansv,     $labl='@Leverandøransvarlig', $titl='@Leverandøransvarlig', $revi=true,'','','','','Ansv...');
  htm_lastFelt();                                               
  htm_CombFelt($type='text',  $name='sprog',  $valu= $formsprog,$labl='@Kommunikationssprog', $titl='@Sproget som skal benyttes til kommunikation',   $revi=true,'','','','placeholder="...'.tolk('@hvis sproget ikke er dansk').'..."');
  htm_CombFelt($type='text',  $name='homeweb',$valu= $homeweb,  $labl='@Hjemmeside',        $titl='@Link til leverandørns hjemmeside',      $revi=true,'','','',$Erhv);
  htm_PanlBund($pmpt='@Gem',$subm=true);
}
######### :KREDITOR:
# Kaldes fra:  [_kreditor/page_Kreditor.php] [_kreditor/page_Ordreliste.php] 
function Panl_Kreditorer($TablData=array()) {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'naviform',$capt= '@Konti - Kreditorer:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-database ','panelW110',__FUNCTION__,'','konti1');
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        ['@Kreditorer: ',   '',    'html',    '', '',      '',    '@alle registrerede']
    ),
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Kontonr.',    '6%','indx','',['center'],'@Kreditor konto nummer', '..auto..'],
        ['@Leverandør', '20%','text','',['left'  ],'@Adressat navn',         '@Navn...'],
        ['@Adresse',    '14%','text','',['left'  ],'@Postadresse',           '@Addr...'],
        ['@Sted',       '12%','text','',['left'  ],'@Suplement til adresse', '@Sted...'],
        ['@Post',        '5%','text','',['left'  ],'@Post nr',               '@Post...'],
        ['@By',         '18%','text','',['left'  ],'@Bynavn',                '@By...'],
        ['@Kontakt',    '10%','text','',['left'  ],'@Navn på tilknyttet kontakt person', '@Kont...'],
        ['@Telefon',    '10%','text','',['left'  ],'@Kontakt telefon',       '@Telf...']
    ),
    $RowSuff= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
    //$DATA=    array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $TablData= array( # DemoData:
        ['1025','Navn','Adresse','Sted','Post nr','By','Kontakt person','Telefon'],
        ['1026','Navn','Adresse','Sted','Post nr','By','Kontakt person','Telefon'],
        ['1027','Navn','Adresse','Sted','Pnr',    'By','Kontakt person','Telefon'],
        ['1028','Navn','Adresse','Sted','Post nr','By','Kontakt person','Telefon']
        ),   
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '200px',   # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );

  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Luk og gå retur til hovedmenu');
}

######### :KREDITOR:
//   Sammensatte Paneler! = "Væg med tapet". Skal ændre til page_...
# Kaldes fra:  [_kreditor/page_Kreditor.php] 
function wall_KreditorKort($kontonr, $kategori, $cvrnr, $eannr, $bankreg, $bankkto, $instit, $ansv, $formsprog, $homeweb,  ## out_PanlsPrim.php
    $navn='', $addr='', $sted='', $ponr='', $by='', $land='', $noter='', $telf='', $att='', $email='', $usemail='', $faktdato='',  //  Adresse
       //  Kontakter
    $felt1='', $felt2='', $felt3='', $felt4='', $felt5=''   //  Ekstrafelter
) {//  Parametre mangler for: Kontakter, Ekstrafelter
  htm_Tapet_Top($name='kredform', $capt='@Kreditorkort', $parms='page_Blindgyden.php', $icon='far fa-file-alt', $klasse='panelWmax',__FUNCTION__);
  SpalteTop(320);
    Panl_Leverandor($kontonr, $kategori, $cvrnr, $eannr, $bankreg, $bankkto, $instit, $ansv, $formsprog, $homeweb);           
    Panl_CVRopslag('kreditor');
  NextSpalte();
  Panl_Adresse($navn='Anders And', $addr='Andedammen 34', $sted='Ved Lunden', $ponr='1234', $by='Eventyrland', $land='Eventyrland', 
                      $noter='', $telf='045 12345678', $att='Rap', $email='anders@and.dk', $usemail='', $faktdato);   
  NextSpalte();
    //  Panl_Betingelser($debigrup, $betaling, $frist, $print2, $kunderef);     
    Panl_Kontakter();  #+ Bemærkning 
    //  Panl_Mailfaktura($emne, $text, $vedhft, $copyto, $bccopy);    
    Panl_Ekstrafelter($felt1, $felt2, $felt3, $felt4, $felt5, $custFelt= array(  #+ LeverandørNr. Hjemmeside  Betalingsbetingelser  Kreditorgruppe
// [Label,             Hint,                       Placeholder  ]
  ['@Levering Felt 1','@Levering - Udfyld Felt 1','@Lev. Felt 1...'],
  ['@Levering Felt 2','@Levering - Udfyld Felt 2','@Lev. Felt 2...'],
  ['@Levering Felt 3','@Levering - Udfyld Felt 3','@Lev. Felt 3...'],
  ['@Levering Felt 4','@Levering - Udfyld Felt 4','@Lev. Felt 4...'],
  ['@Levering Felt 5','@Levering - Udfyld Felt 5','@Lev. Felt 5...'])
);    
  
  SpalteBund();
  htm_TapetBund();
  
/*   
Hjemmeside	
Betalingsbetingelse	 +
Kreditorgruppe	
CVR-nr.	
Telefon	
Telefax	
Bank	
Reg.nr	
Konto	
SWIFT nr	
FI kreditor nr.	
Kreditmax	
Lukket
 */
}

######### :KREDITOR:
# Kaldes fra: Panl_KreditorKort
function Panl_Adresse($navn, $addr, $sted, $ponr, $by, $land, $noter, $telf, $att, $email, $usemail, $addrdato, $erhv=true) {  ## out_PanlsPrim.php
  htm_Panl_Top($name='faktform',$capt='@Leverandør - Adresse:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelWmax',__FUNCTION__,'','');
  htm_CombFelt($type='text',    $name='navn', $valu= $navn,   $labl='@Navn',          $titl='@Angiv Kreditor Navn' ,   $revi=true, '', '','','','Navn...');
  htm_CombFelt($type='text',    $name='addr', $valu= $addr,   $labl='@Adresse',       $titl='@Angiv Adresse'       ,   $revi=true, '', '','','','Addr...');
  htm_CombFelt($type='text',    $name='sted', $valu= $sted,   $labl='@Sted',          $titl='@Angiv Kreditor Sted, suplement til adresse',   $revi=true, '', '','','','Sted...');
  htm_FrstFelt('25%');                                              
    htm_CombFelt($type='text',  $name='ponr', $valu= $ponr,   $labl='@Postnr',        $titl='@Angiv Kreditor postnr',   $revi=true, '', '','','','Post...');
  htm_NextFelt('75%');                                              
    htm_CombFelt($type='text',  $name='by',   $valu= $by,     $labl='@By',            $titl='@Angiv Kreditor Bynavn',   $revi=true, '', '','','','By...');
  htm_lastFelt();                                                   
  htm_CombFelt($type='text',    $name='land', $valu= $land,   $labl='@Land',          $titl='@Angiv Kreditor Land',   $revi=true, '', '','','','Land...');
  htm_CombFelt($type='area',    $name='noter',$valu= $noter,  $labl='@Bemærkninger',  $titl='@Angiv Bemærkninger',    $revi=true, $rows='1', '','','','Note...');
  htm_CombFelt($type='text',    $name='telf', $valu= $telf,   $labl='@Telefon(er)',   $titl='@Angiv Telefon'     ,    $revi=true, '', '','','','Telf...');
  htm_CombFelt($type='text',    $name='att',  $valu= $att,    $labl='@Attention',     $titl='@Angiv Attention'    ,   $revi=true, '', '','','','Att...');
  htm_CombFelt($type='mail',    $name='email',$valu= $email,  $labl='@Email adresse', $titl='@Angiv Email adresse',   $revi=true, '', '','','','email...');
  htm_FrstFelt('50%');  
    htm_CheckFlt($type='checkbox',$name='useMail', $valu= $usemail, $labl='@Benyt mail',      $titl='@Send besked med mail', $revi=true);
  htm_NextFelt('50%');  
    htm_CombFelt($type='date',  $name='addrdato',  $valu= $addrdato, $labl='@Adresse Dato',   $titl='@Adresse Dato',     $revi=true);
  htm_LastFelt();
  if ($erhv==true)
       htm_PanlBund($pmpt='@Gem',$subm=true,$title='@Gem data overnfor, såfremt de er redigeret');
  else htm_PanlBund($pmpt='@Fakturér',$subm=true,$title='@Fakturer og udskriv til den under {Betingelser}, valgte udskriver!');
}


######### :KREDITOR:
# Kaldes fra:  [_kreditor/page_Ordreliste.php] 
function Panl_KredOrdrer($TablData=array()) {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'naviform',$capt= '@Ordrer: Kreditorer - `Leverandørordrer`:',$parms='page_Blindgyden.php',$icon='fas fa-database','panelW110',__FUNCTION__);
  htm_Table(
    $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        ['@Registrerede ordrer',   '80px',    'text',    '', 'left',      '@Vælg blandt ordrer, hvilken du vil inspicere/rette',    '@Vælg...']
    ),
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Ordre nr.',  '7%','indx','', ['left'  ], '@Ordre nummer','..auto..'],
        ['@Modt.nr.',   '7%','text','', ['left'  ], '@Modtager nummer','Modt...'],    
        ['@Fakt.nr.',   '7%','text','', ['left'  ], '@Faktura nummer','Fakt...'],
        ['@Ordre dato', '5%','date','', ['left'  ], '@Datoen for ordrens registrering','YYYY-MM-DD'],
        ['@Modt.dato',  '5%','date','', ['left'  ], '@Datoen for ordrens modtagelse','YYYY-MM-DD'],
        ['@Konto nr.',  '7%','text','', ['left'  ], '@Kreditor konto nummer', 'Kont...'],
        ['@Firma navn','27%','text','', ['left'  ], '@Firmaets navn','Navn...'],
        ['@Telefon',    '7%','text','', ['center'], '@Firmaets telefon nummer','Telf...'],
        ['@Leveres til','7%','text','', ['left'  ], '@Leveres til','Lev...'],
        ['@Vor ref.',   '7%','text','', ['left'  ], '@Vores referance','Ref...'],
        ['@Projekt',    '7%','text','', ['left'  ], '@Angiv evt. projekt nummer','Proj...'],
        ['@Faktura sum','7%','text','', ['right' ], '@Netto sum på fakturaen. Moms tillægges først, når der faktureres.','Beløb...']
    ),
    $RowSuff= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
    //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $TablData= array( # DemoData:
        ['1025','Modt.nr.','Fakt.nr.','Ordre dato','Modt.dato','Konto nr.','Firma navn','Telefon','Leveres til','Vor ref.','Projekt','Faktura sum'],
        ['1026','Modt.nr.','Fakt.nr.','Ordre dato','Modt.dato','Konto nr.','Firma navn','Telefon','Leveres til','Vor ref.','Projekt','Faktura sum'],
        ['1027','Modt.nr.','Fakt.nr.','Ordre dato','Modt.dato','Konto nr.','Firma navn','Telefon','Leveres til','Vor ref.','Projekt','Faktura sum'],
        ['1028','Modt.nr.','Fakt.nr.','Ordre dato','Modt.dato','Konto nr.','Firma navn','Telefon','Leveres til','Vor ref.','Projekt','Faktura sum']
        ),
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '150px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_nl();
  Panl_CopyBoard();
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Luk og gå retur til hovedmenu');
}

######### :KREDITOR:
function Panl_CopyBoard() {  ## out_PanlsPrim.php
  //$ocr= "Felter som kan udpeges: \nOrdrenr. 	Modt.nr. 	Fakt.nr.  Ordredato	  Modt.dato	  Fakt.dato	Kontonr.	Firmanavn	  LeveresTil	Vor.ref.	Fakturasum    Projekt";
  htm_Panl_Top($name= '',$capt= '@Faktura-service:',$parms='',$icon='fas fa-pen-square','panelW110',__FUNCTION__);
  
  function td_knap($ix,$labl,$titl) { $str1= tolk('@Her overfører du ').'<br>'.tolk($titl);
    echo '<td>'.'<button type="button" class="tooltip" id="copyBlock['.$ix.']" onClick="copyText()"'.
         'style="padding:1px 5px; width:80px; box-shadow:none; border: none; background-color:transparent;">'.
          Lbl_Tip($labl,$str1).'</button> <span id="copyAnswer"></span>'.'</td>';
  }
  echo '<table style="width:700px; margin:auto;"><tr>';
  echo '<td colspan="12">'.tolk('@Marker en tekst nedenfor, kopier den med CTRL-c. Indsæt kopien i det tilsvarende felt herunder med CTRL-v:').'</td>';
  echo '</tr><tr>';
  td_knap('0', '@Ordrenr.',    '@Ordrenummer.');          
  td_knap('1', '@Modt.nr.',    '@Modtager nummer.');      
  td_knap('2', '@Fakt.nr.',    '@Faktura nummer.');      
  td_knap('3', '@Ordredato',   '@Ordre dato.');          
  td_knap('4', '@Modt.dato',   '@Modtaget dato.');       
  td_knap('5', '@Fakt.dato',   '@Faktura dato.');        
  td_knap('6', '@Kontonr.',    '@Kreditor konto nummer.');         
  td_knap('7', '@Firmanavn',   '@Firma navn.');          
  td_knap('8', '@Leveres til', '@Modtage destination');
  td_knap('9', '@Vores ref.',  '@Vores reference.');      
  td_knap('10','@Fakturasum',  '@Fakturaens total');     
  td_knap('11','@Projekt',     '@Projekt referance');      
  echo '</tr><tr>';   
  $str1=' style="border: 1px solid #8c8b8b; padding:2px;">'.'<input type= "text" name="Felt[]" ';
  $str2='" style="width:75px;" />'.'</td>';
  echo '<td'.$str1.'value="'.htmlentities(stripslashes('')).'" placeholder="'.tolk('@- ? -').$str2;
  echo '<td'.$str1.'value="'.htmlentities(stripslashes('')).'" placeholder="'.tolk('@- ? -').$str2;
  echo '<td'.$str1.'value="'.htmlentities(stripslashes('')).'" placeholder="'.tolk('@- ? -').$str2;
  echo '<td'.$str1.'value="'.htmlentities(stripslashes('')).'" placeholder="'.tolk('@- ? -').$str2;
  echo '<td'.$str1.'value="'.htmlentities(stripslashes('')).'" placeholder="'.tolk('@- ? -').$str2;
  echo '<td'.$str1.'value="'.htmlentities(stripslashes('')).'" placeholder="'.tolk('@- ? -').$str2;
  echo '<td'.$str1.'value="'.htmlentities(stripslashes('')).'" placeholder="'.tolk('@- ? -').$str2;
  echo '<td'.$str1.'value="'.htmlentities(stripslashes('')).'" placeholder="'.tolk('@- ? -').$str2;
  echo '<td'.$str1.'value="'.htmlentities(stripslashes('')).'" placeholder="'.tolk('@- ? -').$str2;
  echo '<td'.$str1.'value="'.htmlentities(stripslashes('')).'" placeholder="'.tolk('@- ? -').$str2;
  echo '<td'.$str1.'value="'.htmlentities(stripslashes('')).'" placeholder="'.tolk('@- ? -').$str2;
  echo '<td'.$str1.'value="'.htmlentities(stripslashes('')).'" placeholder="'.tolk('@- ? -').$str2;
  echo '</tr></table>';
  htm_hr();   
  htm_Accept('@Gem','@Overfør data fra felterne, til tabellen med leverandørordrer',$width='',$akey);
  
  htm_Rammestart($Caption='@Mellemlager for copy/paste.');
  htm_CombFelt($type='area',  $name='ocr', $valu= $ocr,   
               $labl= '@Kopi af fakturaen:',  
               $titl= tolk('@Her paster du en skannet og OCR-behandlet faktura, som er tekst-baseret, hvorpå du copy/paster de enkelte felter over i programmets data-felter. ').
                      tolk('@Det virker ikke med skanning til bitmap-format!'), 
               $revi=true, $rows='18',$width='300px', $step='', $more='',
               $plho=tolk('@@Her paster du en tekst-baseret faktura, hvorpå du copy/paster de enkelte felter over i programmets data-felter.').str_lf(2).
                     tolk('Du kan også kopiere fra et andet vindue, hvor fakturaen vises. f.eks. Adobe PDF-viser eller et browservindue.')               
              );
  htm_nl(12);
  run_Script('function copyText(){ '.
    'var textarea= document.getElementById("ocr");  '.
    'var answer= document.getElementById("copyAnswer");  '.
    'var copy= document.getElementById("copyBlock");'.
    'copy.addEventListener("click", function(e) {'.
    '   textarea.select();'.    // Select some text (you could also create a range)
    '   try { '.                // Use try & catch for unsupported browser
    '       var ok = document.execCommand("copy");'. // The important part (copy selected text)
    '       if (ok)     answer.innerHTML = "'.tolk('@Kopieret.').'!";'.
    '       else        answer.innerHTML = "'.tolk('@kunne ikke kopiere!').'";'.
    '   } catch (err) { answer.innerHTML = "'.tolk('@Browseren understøtter ikke funktionen!').'"; }'.
  '}) };'
  );
  //  document.execCommand('copy')
  // Setup the variables

  htm_nl();
  htm_CentrOn();
  htm_Plaintxt('@Har du en leverandør-faktura, som du skal have inddateret, kan dette virke, som en integreret faktura-service.');  htm_nl();
  htm_Plaintxt('@Det er en forudsætning at fakturaen foreligger i en tekst-baseret form, f.eks. PDF, email, OCR-skannet.');  htm_nl();
  htm_Plaintxt('@Er det en bitmap/billed-fil, kan du konvertere den mange steder på internettet. Søg efter OCR service.');  htm_nl();
  htm_Plaintxt('@Et par eksempeler: https://www.free-ocr.com/ og http://www.i2ocr.com/free-online-danish-ocr.');  htm_nl();
  htm_Plaintxt('@Nyttige tast-genveje: CTRL-a :Marker alt, CTRL-c :Kopier det markerede, CTRL-v :Indsæt det kopierede.');  htm_nl();
  htm_Plaintxt('@Benytter du knapperne, overtager de arbejdet med kopier og indsæt. (Virker ikke endnu!)');
  htm_CentOff();
  htm_nl(2);
  htm_Rammeslut();
  htm_PanlBund($pmpt='@Gem',$subm=true,$title='');
}

######### :KREDITOR:
# Kaldes fra:  [_kreditor/page_Ordreliste.php] 
function wall_LevBestilling() {   ## out_PanlsPrim.php
//  Skal ændre til page_...
  htm_Tapet_Top($name= 'naviform',$capt= '@Bestilling - `Leverandørordre`:',$parms='page_Blindgyden.php',$icon='far fa-file-alt','panelW110',__FUNCTION__);
  
  SpalteTop(240);
  htm_Panl_Top($name= '',$capt= '@Kreditor:',$parms='',$icon='fas fa-pen-square','panelW240',__FUNCTION__);
  htm_CombFelt($type='text',    $name='levnavn',      $valu= $navn,     $labl='@Konto nr.',         $titl='@Angiv kreditors Kontonr.',                $revi=true, '','','','',$plho='Kont..');
  htm_CombFelt($type='text',    $name='levnavn',      $valu= $navn,     $labl='@Firma navn',        $titl='@Angiv Firma Navn',                        $revi=true, '','','','',$plho='Navn..');
  htm_CombFelt($type='text',    $name='levaddr1',     $valu= $addr,     $labl='@Firma adresse',     $titl='@Angiv Firmaets Adresse',                  $revi=true, '','','','',$plho='Addr..');
  htm_CombFelt($type='text',    $name='sted',         $valu= $sted,     $labl='@Sted',              $titl='@Angiv Firma Sted, suplement til adresse', $revi=true, '','','','',$plho='Sted..');
  htm_FrstFelt('25%');                                                                                                  
    htm_CombFelt($type='text',  $name='levpostnr',    $valu= $ponr,     $labl='@Postnr',            $titl='@Angiv Firma Kunde postnr',                $revi=true, '','','','',$plho='Pnr..');
  htm_NextFelt('75%');                                                                                                  
    htm_CombFelt($type='text',  $name='levby',        $valu= $by,       $labl='@By',                $titl='@Angiv Leveringsstedets Bynavn',           $revi=true, '','','','',$plho='By..');
  htm_lastFelt();                                                                                                       
  htm_CombFelt($type='text',    $name='land',         $valu= $land,     $labl='@Firma Land',        $titl='@Angiv Leverandør Land',                   $revi=true, '','','','',$plho='Land..');
  htm_CombFelt($type='text',    $name='levkont',      $valu= $kont,     $labl='@Att.',              $titl='@Angiv Kontaktpersons Navn',               $revi=true, '','','','',$plho='Navn..');
  //htm_CombFelt($type='area',    $name='levnoter',     $valu= $noter,    $labl='@Noter til bestillingen',         $titl='@Angiv Noter',             $revi=true, $rows='1','','','',$plho='Noter..');
  htm_PanlBund($pmpt='@Gem',$subm=false,$title='');
  
  NextSpalte(320);
  htm_Panl_Top($name= '',$capt= '@Detaljer:',$parms='',$icon='fas fa-pen-square','panelW320',__FUNCTION__,'');
  htm_FrstFelt('50%');  htm_CombFelt(                      $type='text',  $name='cvrnr',      $valu= $cvrnr,      $labl='@CVR',         
          $titl='@CVR - Virksomheds ID. Kan benyttes i CVR-opslag, til at importere Erhvervsstyrelsens offentlige data', $revi=true);
  htm_NextFelt('50%');  htm_CombFelt($type='tal2d', $name='momssats', $valu= $momssats, $labl='@Moms %-sats',     $titl='@Momssats for ydelsen',    $revi=true, $rows='', $width='45',$step='0.25');
  htm_LastFelt();
  htm_FrstFelt('50%');  htm_CombFelt($type='date', $name='ordrdate', $valu= $ordrdate,  $labl='@Ordre dato',      $titl='@Angiv dato',          $revi=true, $rows='', $width='',$step='');
  htm_NextFelt('50%');  htm_CombFelt($type='date', $name='levrdate', $levrdate= $pris,  $labl='@Leverings dato',  $titl='@Angiv dato',          $revi=true, $rows='', $width='');
  htm_LastFelt();
  htm_FrstFelt('80%');  htm_OptioFlt($type='text', $name='betaling',  $valu= $betaling,   
                    $labl='@Betalings metode',    $titl='@Hvordan skal der betales',    $revi=true, $optlist= array(
                    ['@Kontant',    'Kontant',    '@Kontant'],
                    ['@Efterkrav',  'Efterkrav',  '@Efterkrav'],
                    ['@Forud',      'Forud',      '@Forud'],
                    ['@Lb. Md.',    'lobmaaned',  '@Lb. Md.'],
                    ['@Konto',      'Konto',      '@Konto'] ),$action=''); 
  
  htm_NextFelt('20%');  htm_CombFelt($type='text',    $name='dage', $valu= $dage, $labl='Frist',   $titl='@Betalings betingelser',      $revi=true, $rows='', $width='',$step='1');
  htm_LastFelt();
  htm_hr();
  htm_KnapGrup('',true,false);
    textKnap($label='@Importer OIOUBL faktura',    $title='@Klik her for at importere en elektronisk faktura af typen oioubl', $link='../_base/page_Blindgyden.php');    
  htm_KnapGrup('',false);
  
  htm_nl();
  htm_CheckFlt($type='checkbox',$name='godk',$valu='godk',  $labl='@Godkend', $titl='@Afmærk her, når bestillingen kan godkendes.',  $revi=true);
  htm_PanlBund($pmpt='@Gem',$subm=false,$title='');
  
  NextSpalte(240);
  htm_Panl_Top($name= '',$capt= '@Levering:',$parms='',$icon='fas fa-truck','panelW240',__FUNCTION__,'');
  htm_CombFelt($type='text',    $name='levnavn',      $valu= $navn,     $labl='@Firma navn',                  $titl='@Angiv Firma Navn',                            $revi=true, '','','','',$plho='Navn..');
  htm_CombFelt($type='text',    $name='levaddr1',     $valu= $addr,     $labl='@Leverings adresse',           $titl='@Angiv Leverings Adresse',                     $revi=true, '','','','',$plho='Addr..');
  htm_CombFelt($type='text',    $name='sted',         $valu= $sted,     $labl='@Sted',                        $titl='@Angiv Leverings Sted, suplement til adresse', $revi=true, '','','','',$plho='Sted..');
  htm_FrstFelt('25%');                                                                                                  
    htm_CombFelt($type='text',  $name='levpostnr',    $valu= $ponr,     $labl='@Postnr',                      $titl='@Angiv Leverings Kunde postnr',                $revi=true, '','','','',$plho='Pnr..');
  htm_NextFelt('75%');                                                                                                  
    htm_CombFelt($type='text',  $name='levby',        $valu= $by,       $labl='@By',                          $titl='@Angiv Leveringsstedets Bynavn',         $revi=true, '','','','',$plho='By..');
  htm_lastFelt();                                                                                                       
  //htm_CombFelt($type='text',    $name='land',         $valu= $land,     $labl='@Leverings Land',              $titl='@Angiv Leverings Land',                  $revi=true);
  //htm_CombFelt($type='text',    $name='levtelf',      $valu= $telf,     $labl='@Telefon(er)',                 $titl='@Angiv Modtagers Telefon',               $revi=true, '','','','',$plho='Telf..');
  htm_CombFelt($type='text',    $name='levkont',      $valu= $kont,     $labl='@Att.',                        $titl='@Angiv Kontaktpersons Navn',             $revi=true, '','','','',$plho='Att..');
  //htm_CombFelt($type='mail',    $name='levemail',     $valu= $email,    $labl='@Modtagerens Email adresse',   $titl='@Angiv Modtagers Email adresse',         $revi=true);
  //htm_CombFelt($type='text',    $name='forsendelse',  $valu= $forsend,  $labl='@Fragtmetode)',                $titl='@Angiv Forsendelses oplysninger',        $revi=true);
  htm_CombFelt($type='area',    $name='levnoter',     $valu= $noter,    $labl='@Noter til bestillingen',      $titl='@Angiv Noter',             $revi=true, $rows='1','','','',$plho='Noter..');
  // htm_FrstFelt('50%');
  //   htm_CheckFlt($type='checkbox',$name='afsendt',    $valu= $afsendt,  $labl='@Afsendt',                     $titl='@Afmærk her når varen/ydelsen er afsendt', $revi=true);
  // htm_NextFelt('50%');  
  //   htm_CombFelt($type='date',$name='modtdato',        $valu= $levdato,  $labl='@Modtage Dato',              $titl='@evt. forsendelses dato',                $revi=true);
  // htm_LastFelt();
  htm_PanlBund($pmpt='@Gem',$subm=false,$title='','',$simu=true);
  
  SpalteBund(); 
  
  //  SpalteTop(960);
  //  Panl_CopyBoard();
  htm_nl();
  htm_Panl_Top($name= '',$capt= '@Bestillings-poster:',$parms='page_Blindgyden.php',$icon='fas fa-list','panelW960',__FUNCTION__,'');
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
      ['@Status:', '25%','text','','left', '@Her kan skrives en bemærkning til bestillingen', '@Ny bestilling, endnu ikke godkendt'],
    ),
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
      ['@Pos.',        '5%', 'text', '',['left'],'@Position tildeles automatisk.'.' ','Pos...'],
      ['@Varenr',      '7%', 'text', '',['left'],'@Varenummer hentes fra vareregistret.','Vare...'],
      ['@Lev.varenr',  '7%', 'text', '',['left'],'@Leverandørens varenummer.','Leve...'],
      ['@Antal',       '5%', 'text', '',['left'],'@Mængden af den aktuelle leverance.'.' ','Ant...'],
      ['@Enhed',       '5%', 'text', '',['left'],'@Enhedsbeskrivelse af mængden','Enh...'],
      ['@Beskrivelse','45%', 'text', '',['left'],'@Leverance beskrivlse','Beskr...'],
      ['@Pris',       '10%', 'tal2d','',['left'],'@Enhedspris','Pris...'],
      ['@Rabat%',      '6%', 'tal2d','',['left'],'@Rabatsats i %. Angiv 0% og en reduceret enhedspris, hvis der skal ydes en beløbs rabat','Rabat'],
      ['@Moms%',       '6%', 'tal2d','',['left'],'@Moms %-sats for den posterede leverance','Moms...'],
      ['@Linie ialt', '10%', 'tal2d','',['left'],'@Beregnet beløb.'] 
    ),
    $RowSuff= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
    //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $data= array(
      [1,2,3,4,5,6,7,8,9,10],
      [1,2,3,4,5,6,7,8,9,10],
      [1,2,3,4,5,6,7,8,9,10],
      [1,2,3,4,5,6,7,8,9,10],
    ),  # Antal rows ved DEMO
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '200px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
 // Ordresum	0,00	Moms	0,00	I alt	0,00
  htm_FrstFelt('30%');
  htm_NextFelt('10%');  htm_CombFelt($type='tal2d',  $name='osum', $valu= $osum,  $labl='@Ordresum', $titl='@Beregnet sum af linie-beløb', $revi=false, '','','','',$plho='0,00');
  htm_NextFelt('10%');  htm_CombFelt($type='tal2dc',  $name='moms', $valu= $moms,  $labl='@Moms',     $titl='@Beregnet moms',               $revi=false, '','','','',$plho='25%');
  htm_NextFelt('10%');  htm_CombFelt($type='tal2d',  $name='ialt', $valu= $ialt,  $labl='@I alt',    $titl='@Brutto pris inclusive moms',  $revi=false, '','','','',$plho='0.000,00..');
  htm_NextFelt('30%');
  htm_LastFelt();
  htm_PanlBund($pmpt='@Gem',$subm=false,$title='','',$simu=true);
  
  SpalteBund(); 
  
  htm_Accept($pmpt='@Gem',$title='@Opret bestilling, når du er færdig med inddatering',$width='',$akey);
  htm_nl();
  htm_KnapGrup('@Her kan du:',true,false);
    textKnap($label='@Oprette Ny',  $title='@Opret ny bestilling',    $link='../_base/page_Blindgyden.php');
    textKnap($label='@Opslag',    $title='@Opslag af leverandører', $link='../_base/page_Blindgyden.php');    
    textKnap($label='@CSV-eksport',       $title='@CSV - Eksporter til kommasepareret fil, som kan indlæses i regneark.', $link='../_base/page_Blindgyden.php');
  htm_KnapGrup('',false);
  htm_TapetBund($formslut=true);
  PanelMin(4);    //  Detaljer
}


######### :KREDITOR:
# Kaldes fra:  [_kreditor/page_Rapport-kre.php] 
function Panl_KredRapp(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {  ## out_PanlsPrim.php
  set_FormVars(['krkonto','krdatefra']);  // Opdater alle variabler på form 'kredform' :
  
  htm_Panl_Top($name= 'kredform',$capt= '@Kreditor-rapporter:',$parms='#',$icon='fas fa-chart-line','panelW320',__FUNCTION__);
    htm_FrstFelt('04%');  
    htm_NextFelt('36%');  htm_Prompt('@Vælg kriterier:','right');  //echo '<p align="center">'.tolk('@Angiv kriterier:').'</p> ';
    htm_NextFelt('02%');  
    htm_NextFelt('58%');  
    htm_NextFelt('05%');
    htm_LastFelt();
  htm_FrstFelt('0%'); 
  htm_NextFelt('50%');  htm_CombFelt($type='text',$name='krkonto',    $valu= $_SESSION['krkonto'],    $labl='@Konto',     $titl='@Angiv kreditor Konto, som skal rapporteres',  $revi=true);
  htm_NextFelt('50%');  htm_CombFelt($type='date',$name='krdatefra',  $valu= $_SESSION['krdatefra'],  $labl='@Fra Dato',  $titl='@Fra hvilken dato, skal perioden starte med',  $revi=true);
  htm_LastFelt();
  htm_Accept($labl='@Benyt det', $title='@Godkend dine valg, så de benyttes ved rapportdannelse', $width='',$akey='b',$form='kredform');
  htm_KnapGrup('@Vis:',true);
    textKnap($label='@Åbne poster',    $title='@Rapport for kreditor åbne poster',    
                                       $link=  '../_kreditor/page_Rapport-kre.php?job=openpost',   $akey='å');
    textKnap($label='@Konto saldo',    $title='@Viser en liste over saldi på valgt(e) konti pr. den angivne dato',    
                                       $link=  '../_kreditor/page_Rapport-kre.php?job=ktsaldo',    $akey='s');
    textKnap($label='@Konto kort',     $title='@Rapport for kreditor konto kort',     
                                       $link=  '../_kreditor/page_Rapport-kre.php?job=ktkort',     $akey='k');  //  Panl_KredKontoKort
    textKnap($label='@Købs statistik', $title='@Rapport for kreditor købs statistik', 
                                       $link=  '../_kreditor/page_Rapport-kre.php?job=kobstat',    $akey='t');
  htm_KnapGrup('@Vis:',false);
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=false,$title='@Luk og gå retur til hovedmenu');
  dev_show();
}

######### :KREDITOR:
function KredRappTop($rapp='') { //  Data dannes i: Panl_DebRapp
  htm_FrstFelt('40%');  htm_DataFelt('@KRITERIER for rapporten:','');
  htm_NextFelt('40%');  
  htm_NextFelt('20%');  
  htm_LastFelt();
  htm_FrstFelt('40%');  htm_DataFelt('@Kunde(r):',$_SESSION['krkonto']);
  htm_NextFelt('10%');  htm_DataFelt('@Periode:','','right'); 
  htm_NextFelt('25%');  htm_DataFelt('@Fra:',$_SESSION['krdatefra']);
  htm_NextFelt('25%');  htm_DataFelt('@Til:',''.date('Y-m-d'));//htm_DataFelt('@Til:',$_SESSION['datetil']);
  htm_LastFelt();
  htm_LastFelt();
  htm_hr();
}


######### :KREDITOR:
function Panl_KredOpenPost() {
  //Panl_Rapportliste();
  htm_Panl_Top($name= 'rappformopp',$capt= '@Åbne poster (ubetalte):',$parms='../_base/page_Hovedmenu.php',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  //Kriterier('@Leverandør(er):');
  KredRappTop('xxx');
  htm_Table(
    $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
        ['@Her ser du ','15%', 'html', '', 'left', '', '@ubetalte fakturaer'],
      ),
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Løbenr.',    '6%','show','',['center'],'@Løbe nummer','..auto..'],
        ['@PBS',        '8%','show','',['left'  ],'@Reference til PBS','@pbs...'],
        ['@Firmanavn', '28%','show','',['left'  ],'@Firma navn','@Navn...'],
#-       ['@0-7',        '9%','show','',['right' ],'@Faktura alder 0-7 dage','@0.00'],
#-       ['@8-29',       '9%','show','',['right' ],'@Faktura alder 8-29 dage','@0.00'],
#-       ['@30-59',      '9%','show','',['right' ],'@Faktura alder 30-59 dage','@0.00'],
#-       ['@60-89',      '9%','show','',['right' ],'@Faktura alder 60-89 dage','@0.00'],
#-       ['@>=90',       '9%','show','',['right' ],'@Faktura alder >=90 dage','@0.00'],
        ['@I alt',     '10%','show','',['right' ],'@Sum','@0.00...']
      ),
    $RowSuff= array(
        ['@Vælg',       '6%','knap','',['center'],'@Marker de poster, som der skal ske handling på',''],
        
      ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
    //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $TablData= array( # DemoData:
        ['1','','Firmanavn','','','','','',''],
        ['2','','Firmanavn','','','','','',''],
        ['3','','Firmanavn','','','','','',''],
        ['4','','Firmanavn','','','','','','']
      ),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '200px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_KnapGrup('@Med de valgte:',true);
    textKnap($label='@Mail kontoudtog', $title='@Klik her for at maile kontoudtog til de modtagere som er afmærket ovenfor',     $link='../_base/page_Blindgyden.php',$akey='m');
    textKnap($label='@Opret rykker',    $title='@Klik her for at oprette rykker til dem, som er afmærket ovenfor',     $link='../_base/page_Blindgyden.php',$akey='o');    
    textKnap($label='@Ryk alle',        $title=tolk('@Denne funktion gør følgende:').'<ul><li>'.
                                               tolk('@udligner alle konti, hvor saldo er 0.').'</li><li>'.
                                               tolk('@opretter rykkere, hvor betalingsfrist er overskredet med det antal dage, som er valgt under indstillinger -> rykkervalg,').'</li><li>'.
                                               tolk('@bogfører åbne rykkere, hvor betalingsfrist er overskredet, og opretter rykkere på næste niveau for disse').'</li><li>'.
                                               tolk('@Sletter åbne rykkere, som er blevet betalt.').'</li></ul>',      $link='../_base/page_Blindgyden.php',$akey='a');
  htm_KnapGrup('@Med de markerede:',false);
  htm_PanlBund($pmpt='@Gem',$subm=false);
}

######### :KREDITOR:
function Panl_KredKontoListe() {
  //Panl_Rapportliste();
  htm_Panl_Top($name= 'rappformkrkt',$capt= '@Saldo liste:',$parms='#',$icon='far fa-file-alt','panelW480',__FUNCTION__);
  //Kriterier('@Leverandør(er):');
  KredRappTop('xxx');
  htm_Table(
    $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
        ['@Her ser du ','25%', 'html', '', 'left', '', '@ubetalte fakturaer'],
      ),
    $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@kontonr.',   '5%','show','',['center'],'@Løbe nummer','..auto..'],
        ['@Firmanavn', '80%','show','',['left'  ],'@Firma navn','@Navn...'],
        ['@kontosum',  '10%','show','',['right' ],'@Faktura alder 0-7 dage','@0.00'],
      ),
    $RowSuff= array(
      ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
    //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $TablData= array( # DemoData:
        ['1011','Firmanavn',''],
        ['1012','Firmanavn',''],
        ['1013','Firmanavn',''],
        ['1014','Firmanavn','']
      ),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '130px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_FrstFelt('49%');  
  htm_NextFelt('30%');  htm_Prompt('@Skyldig i alt:','right'); 
  htm_NextFelt('20%');  htm_CombFelt($type='tal2d',  $name='ialt',  $valu= $ialt=0,   $labl='',$titl='@Summen af de listede beløb.', $revi=false);
  htm_NextFelt('01%');  
  htm_LastFelt();
  htm_PanlBund($pmpt='@Gem',$subm=false);
}

######### :KREDITOR:
function Panl_KredKoebsStat() {
  //  Panl_Rapportliste();
  htm_Panl_Top($name= 'rappformkrkob',$capt= '@Købs statistik:',$parms='#',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  //Kriterier('@Leverandør(er):');
  KredRappTop('xxx');
  $leverad= ['',''];
  foreach ($leverad as $lev) {
    htm_FrstFelt('04%');  htm_NextFelt('60%');  htm_DataFelt('@Firmanavn:','T. Petersen'); 
    htm_NextFelt('05%');    htm_NextFelt('25%');  htm_DataFelt('@Kontonr:','1000',''); 
    htm_NextFelt('05%');    htm_LastFelt();
    htm_Table(
      $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
        ),
      $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Varenr.' ,    '10%','show','',  ['center'],'@Varenr.','@nr..'],
          ['@Beskrivelse', '55%','show','',  ['left'  ],'@Beskrivelse','@txt...'],
          ['@Antal.',       '4%','show','0d',['center'],'@Antal','@tal...'],
          ['@Pris',        '12%','show','2d',['right' ],'@Pris','@pris...'],
          ['@Sum',         '16%','show','2d',['right' ],'@Sum','@0.00'],
        ),
      $RowSuff= array(
        ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
      //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
      $TablData= array( # DemoData:
          ['100','Udført arbejde','8','375','3000'],
          ['Matr.','Diverse materialer og afdækning','1','400','400'],
          ['Afgift.','Andre afgifter end moms','1','120','120'],
        ),
      $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
      $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
      $CreateRec=false,       # Mulighed for at oprette en record
      $ModifyRec=false,       # Mulighed for at ændre data i en row
      $ViewHeight= '130px',  # Højden af den synlige del af tabellens data
      $CalledFrom= __FUNCTION__
    );
  htm_hr();
  }
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}


######### :KREDITOR:
function Panl_KredKontoKort() {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'rappformkrkk',$capt= '@Konto kort:',$parms='#',$icon='far fa-file-alt','panelW640',__FUNCTION__);
  //Kriterier('@Leverandør(er):');
  KredRappTop('xxx');
  $leverad= ['',''];
  foreach ($leverad as $lev) {
    htm_FrstFelt('04%');  
    htm_NextFelt('60%');  htm_DataFelt('','3.dk'); 

    htm_NextFelt('05%');  
    htm_NextFelt('25%');  htm_DataFelt('@Kontonr:','1003',''); 
    htm_NextFelt('05%');  
    htm_LastFelt();
    htm_FrstFelt('04%');  
    htm_NextFelt('60%');  htm_DataFelt('','Scandiagade 8'); 
    htm_NextFelt('05%');  
    htm_NextFelt('25%');  htm_DataFelt('@Dato:','18-07-2018',''); 
    htm_NextFelt('05%');  
    htm_LastFelt();
    htm_FrstFelt('04%');  
    htm_NextFelt('60%');  htm_DataFelt('','2450'); htm_DataFelt('&nbsp;&nbsp;','København SV'); 
    htm_NextFelt('05%');  
    htm_NextFelt('25%');  htm_DataFelt('@Valuta:','DKK',''); 
    htm_NextFelt('05%');  
    htm_LastFelt();
    htm_Table(
      $TblCapt= array(   #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... 
          //['@Her ser du ','15%', 'text', '', 'left', '', '@ubetalte fakturaer'],
        ),
      $RowPref= array(), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      $RowBody= array(   #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Dato' ,   '12%','date','',['center'],'@Faktura dato','@dato..'],
          ['@Bilag',    '8%','show','',['center'],'@Bilag nummer','@nr...'],
          ['@Faktura',  '8%','show','',['center'],'@Faktura nummer','@nr'],
          ['@Tekst',   '25%','show','',['left'  ],'@Tekst','@txt...'],
          ['@Forfald', '12%','date','',['left'  ],'@Forfald','@dato..'],
          ['@Debet',    '9%','show','',['right' ],'@Debet','@0.00'],
          ['@Kredit',   '9%','show','',['right' ],'@Kredit','@0.00'],
          ['@Saldo',   '12%','show','',['right' ],'@Saldo','@0.00'],
          //  
        ),
      $RowSuff= array(
        ), #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value! '],
      //$DATA=   array(),     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
      $TablData= array( # DemoData:
          [' ',' ',' ','Primosaldo',' ',' ',' ',''],
          ['2017-06-01','bilag','fakt','','','','',''],
          ['','bilag','fakt','','','','',''],
          ['','bilag','fakt','','','','','']
        ),
      $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
      $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
      $CreateRec=false,       # Mulighed for at oprette en record
      $ModifyRec=false,       # Mulighed for at ændre data i en row
      $ViewHeight= '130px',  # Højden af den synlige del af tabellens data
      $CalledFrom= __FUNCTION__
    );
  htm_hr();
  }
  htm_PanlBund($pmpt='@Vis udskrift',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}

######### :KREDITOR:
# Kaldes fra: 
function Panl_Leverandorer() {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'leveform',$capt= '@Leverandøropslag:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-database','panelWmax',__FUNCTION__);
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        ['@Find leverandør ',   '',    'html',    '', '',      '',    '@i databasen']
      ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Kontonr.', '10%','text','',  ['left'],   '@Entydig nummerkode..','@Kont...'],
        ['@Navn',     '20%','text','',  ['left'],   '@Leverandørens navn','@DNavn...'],
        ['@Adresse',  '15%','text','',  ['left'],   '@Leverandørens adresse: Gade & husnr','@Addr...'],
        ['@Sted',     '15%','text','',  ['left'],   '@Supplerende adresse','@Sted...'],
        ['@Postnr',    '5%','text','',  ['left'],   '@Postnummer','@Post...'],
        ['@Bynavn',   '15%','text','',  ['left'],   '@Bynavn','@By...'],
        ['@Land',     '10%','text','',  ['left'],   '@Land','@Land...'],
        ['@Telefon',  '10%','text','',  ['left'],   '@Telefon','Telf...'],
      ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        []
      ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    /* $DATA=   array(
      ), */
    $TablData= [['1003','3.dk','Scandiagade 8	','','2450','København SV','DK Danmark',''],['1002','OK Benzin','Åhaven 11','','8260','Viby J','DK Danmark',''],
                        ['1001','Malergrossisten','Industrivej 12','','8600','Århus C','DK Danmark','']], 
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '120px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
}



######### :KREDITOR: ######### Slut funktioner angående visninger i menu-gruppen KREDITOR



########## :LAGER: ######### Start funktioner angående visninger i menu-gruppen LAGER


######### :LAGER:
function Panl_Vare_Beholdning() { ## out_PanlsSekd.php
  htm_Panl_Top($name= 'varekortform8',$capt= '@Beholdning:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW240',__FUNCTION__);
  htm_CombFelt($type='text',  $name='behlloka', $valu= $behlloka,   $labl='@Lokation',  
          $titl='@Angiv en tekst der beskriver lokation for varen', $revi=true, $rows='2',$width='',$step='', $more='', $plho=tolk('@Lok...'));
  htm_CombFelt($type='text',  $name='behlfolg', $valu= $behlfolg,   $labl='@Følgevare', 
          $titl='@Angiv en tekst der beskriver følgevare', $revi=true, $rows='2',$width='',$step='', $more='', $plho=tolk('@Følg...'));
  htm_FrstFelt('25%');    htm_Caption('@Behold.:'); 
  htm_NextFelt('25%');    htm_CombFelt($type='tal1d',  $name='regn', $valu= $regnskab,  $labl='@Min.',   
      $titl='@Angiv ', $revi=true, $rows='2',$width='',$step='' );
  htm_NextFelt('25%');    htm_CombFelt($type='tal1d',  $name='regn', $valu= $regnskab,  $labl='@Max.',   
      $titl='@Angiv ', $revi=true, $rows='2',$width='',$step='' );
  htm_NextFelt('25%');    htm_CombFelt($type='tal1d',  $name='regn', $valu= $regnskab,  $labl='@Aktuel', 
      $titl='@Angiv ', $revi=true, $rows='2',$width='',$step='' );
  htm_lastFelt(); 
  htm_PanlBund($pmpt='@Gem',$subm=true);
}
######### :LAGER:
function Panl_Vare_Grupper() { ## out_PanlsSekd.php
  htm_Panl_Top($name= 'varekortform9',$capt= '@Grupper:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW240',__FUNCTION__);
  htm_OptioFlt($type='text',  $name='enhed0',     $valu= $enhed0,  
                    $labl='@Varegruppe',          $titl='@Vælg den Varegruppe varen skal være tilknyttet',  
                    $revi=true, $optlist= Grp1Liste(),$action='','','','',$nl=1);
  htm_OptioFlt($type='text',  $name='enhed0',     $valu= $enhed0,  
                    $labl='@Prisgruppe',          $titl='@Vælg den Prisgruppe varen skal være tilknyttet.',  
                    $revi=true, $optlist= PrisListe(),$action='');
  htm_OptioFlt($type='text',  $name='enhed0',     $valu= $enhed0,  
                    $labl='@Tilbudsgruppe',       $titl='@Vælg den Tilbudsgruppe varen skal være tilknyttet',  
                    $revi=true, $optlist= TilbListe(),$action='');
  htm_OptioFlt($type='text',  $name='enhed0',     $valu= $enhed0,  
                    $labl='@Rabatgruppe',         $titl='@Vælg den Rabatgruppe varen skal være tilknyttet',  
                    $revi=true, $optlist= rabtListe(),$action='');
  htm_PanlBund($pmpt='@Gem',$subm=true);
}
######### :LAGER:
function Panl_Vare_Kategorier() { ## out_PanlsSekd.php
  htm_Panl_Top($name= 'varekortform10',$capt= '@Kategorier:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW480',__FUNCTION__);
  htm_CombFelt($type='text',  $name='regn', $valu= $regnskab,     $labl='@Opret ny',         
      $titl=tolk('@Opret en ny kategori: Skriv navnet på kategorien her.').'<br>'.
      tolk('@For at oprette en underkategori skrives id på den overstående kategori foran navnet med | som adskillelse, f.eks 31|Herresokker.').'<br>'.
      tolk('@Id findes ved at holde musen over kategoriens navn.'), 
        $revi=true, $rows='2',$width='',$step='', $more='', $plho=tolk('@Angiv evt. navn på en ny vare kategori...'));
  
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
      ['@Tabel  &nbsp;', '20%','text','' ,'left', '@Produkt kategorier', '@Kategori']
    ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
    ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
      ['@Id',            '8%','data', '',['left'  ], '@Kategoriens index','@id...'],
      ['@Beskrivelse',  '60%','data', '',['left'  ], '@Beskrivelse af kategorien','@Besk...'],
    ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
      ['@Tilknyt',      '10%','knap', '',['center'], '@Sæt flueben her for at knytte $firmanavn til denne kategori','<input type="checkbox" name="kat_valg[$d]" $checked>'],
      ['@Omdøb',        '10%','knap', '',['center'], '@Klik på grønt kryds for at omdøbe kategorien', '<a href="varekort.php?id=$id&rename_category=$kat_id[$d]" onclick="return confirm("Vil du omdøbe denne kategori?")"><ic class="far fa-times-circle" style="color:green; font-size:13px;"></ic></a>'], // <img src=../_assets/icons/rename.png border=0>
      ['@Slet',         '10%','knap', '',['center'], '@Klik på rødt kryds for at slette kategorien', '<a href="varekort.php?id=$id&delete_category=$kat_id[$d]" onclick="return confirm("Vil du slette denne katagori?")"><ic class="far fa-times-circle" style="color:red; font-size:13px;"></ic></a>'], //  <img src=../_assets/icons/delete.png border=0>
    ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON, ]
    //$DATA,#=   array(),
    $data= array(
            [[''],[''],[''],['']],
            [[''],[''],[''],['']],
            [[''],[''],[''],['']],
            ),  #  DEMOdata
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '150px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__ 
  );  
  htm_Plaintxt('Opret underkategori ved at angive hovedkategori-Id foran underkategori-navn, adskilt med tegnet: | ');  
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :LAGER:
function Panl_Vare_Varianter() { ## out_PanlsSekd.php
  htm_Panl_Top($name= 'varekortform11',$capt= '@Varianter:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW480',__FUNCTION__);
//  $temp= $Ønovice;  $Ønovice= false;
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        ['@Tabel  &nbsp; ', '20%','text','','left', '@Produkt varianter', '@Varianter']
      ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
      ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ['@Beskriv.',  '40%','data', '',['left'  ], '@Beskrivelse af varianten','@Besk...'],
        ['@Stregkd.',  '20%','data', '',['center'], '@Variantens stregkode','@Kode...'],
        ['@Beholdning','14%','data', '',['center'], '@Lager beholdning af varianten','@Beh..'],
      ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ['@Slet',      '8%', 'knap', '',['center'],'@Klik på rødt kryds for at slette denne variant fra listen','<ic class="far fa-times-circle" style="color:red; font-size:13px;"></ic>'],  //  <img src=../_assets/icons/delete.png border=0>
        ['@Skjul',     '8%', 'knap', '',['center'],'@Klik på blåt kryds for at skjule denne variant i listen',  '<ic class="far fa-times-circle" style="color:blue; font-size:13px;"></ic>'],
      ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON, ]
    //$DATA,#=   array(),
    $data= array(
        [[''],[''],[''],['']],
        [[''],[''],[''],['']],
        [[''],[''],[''],['']],
        ),  #  DEMOdata
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '150px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_PanlBund($pmpt='@Gem',$subm=true); 
}
######### :LAGER:
function Panl_Vare_Dele() { ## out_PanlsSekd.php
  htm_Panl_Top($name='menuform' ,$capt='@Samlevare -dele', $parms='page_Blindgyden.php', $icon='fas fa-plus', $klasse='panelW400',__FUNCTION__);
    //htm_nl();
 //   htm_FrstFelt('25%');    htm_Caption('@Om varen:'); 
 //   htm_NextFelt('35%');    htm_CheckFlt($type='checkbox',$name='vareudgaa', $valu= $vareudgaa,  
 //                $labl='@Udgået)',  
 //                $titl='@Varen er udgået af sortimentet.',  
 //                $revi=true, $more='');
 //   htm_NextFelt('40%');    htm_CheckFlt($type='checkbox',$name='samlevare', $valu= $samlevare,  
 //                $labl='@Samlevare)',  
 //                $titl='@Varen består af yderligere varedele.',  
 //                $revi=true, $more='');
 //   
 //   htm_lastFelt(); 
    htm_Caption($labl='@Samlevare bestående af:');
    htm_Table(
      $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        ['@Tabel  &nbsp; ', '20%','text','', 'left', '@Produkt dele', '@Vare delposter']
        ),
      $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
      $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Pos.',         '10%','data', '',['left'  ], '@Positions nr af del-vare','@pos...'],
          ['@Leverandør.',  '44%','data', '',['left'  ], '@Leverandør nummer & navn','@Lev...'],
          ['@Varenr.',      '18%','data', '',['center'], '@Leverandørens varenummer','@Vare..'],
          ['@Kostpris',     '18%','data', '',['right' ], '@Delpostens kostpris','@Kost..'],
        ),
      $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
           ['@Slet',        '10%','knap','',['center'],'@Klik på rødt kryds for at slette denne post fra listen?','<ic class="far fa-times-circle" style="color:red; font-size:13px;"></ic>'],  //  <img src=../_assets/icons/delete.png border=0>
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON, ]
      //$DATA,#=   array(),
      $data= array(
        [[''],[''],[''],['']],
        [[''],[''],[''],['']],
        [[''],[''],[''],['']],
        [[''],[''],[''],['']],
        [[''],[''],[''],['']],
        ),  #  DEMOdata

      $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
      $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
      $CreateRec=true,       # Mulighed for at oprette en record
      $ModifyRec=true,       # Mulighed for at ændre data i en row
      $ViewHeight= '200px',  # Højden af den synlige del af tabellens data
      $CalledFrom= __FUNCTION__
    );
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :LAGER:
function Panl_Vare_Enheder() { ## out_PanlsSekd.php
  htm_Panl_Top($name= 'varekortform7',$capt= '@Enheder:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW240',__FUNCTION__);
  htm_OptioFlt($type='text',  $name='enhed0',    $valu= $enhed0,  
                    $labl='@Enhed',         
                    $titl='@Vælg den enhed du ønsker at bruge.',  
                    $revi=true, $optlist= array(
                    ['','Stk','Stk'],
                    ['','Palle','Palle']),$action='','','','',$nl=1);
  htm_OptioFlt($type='text',  $name='enhed1',    $valu= $enhed1,  
                    $labl='@Alternativt',         
                    $titl='@Vælg den alternative enhed du ønsker at bruge.',  
                    $revi=true, $optlist= array(
                    ['','Stk','Stk'],
                    ['','Palle','Palle']),$action='');
  htm_CombFelt($type='text',    $name='enhdindh', $valu= $enhdindh,   $labl='@Indhold/enhed',  
      $titl='@Angiv en tekst der beskriver indholdet pr. enhed', $revi=true, $rows='2',$width='',$step='' );
  htm_CombFelt($type='tal2dc',  $name='enhdpris', $valu= $enhdpris,   $labl='@Pris/enhed',     
      $titl='@Angiv et beløb der beskriver prisen pr. enhed', $revi=true, $rows='2',$width='',$step='' );
  htm_PanlBund($pmpt='@Gem',$subm=true);
}


######### :LAGER:
function Panl_Vare_Rabatter() { ## out_PanlsSekd.php
  htm_Panl_Top($name= 'varekortform5',$capt= '@Mængde-rabatter:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW240',__FUNCTION__);
  htm_OptioFlt($type='text',  $name='enhed0',    $valu= $enhed0,  
                    $labl='@Rabat metode',         
                    $titl='@Vælg den enhed du ønsker at bruge.',  
                    $revi=true, $optlist= array(
                    ['','%','%'],
                    ['','Kr.','Kr.']),$action='','','','',$nl=1);
  htm_FrstFelt('50%');    htm_CombFelt($type='tal2dc',  $name='stkrabat', $valu= $stkrabat,   $labl='@Stk. rabat ved antal',  
      $titl='@Minimumsmængde for at yde mængderabat', $revi=true, $rows='2',$width='',$step='', $more='', $plho=tolk('@Antal...'));
  htm_NextFelt('50%');    htm_CombFelt($type='tal2dc',  $name='antrabat', $valu= $antrabat,   $labl='@%- rabat ved antal',    
      $titl='@Minimumsmængde for at yde procent rabat', $revi=true, $rows='2',$width='',$step='', $more='', $plho=tolk('@Antal...'));
  htm_lastFelt(); 
  htm_PanlBund($pmpt='@Gem',$subm=true);
  
  
  htm_Panl_Top($name= 'varekortform6',$capt= '@Colli:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW240',__FUNCTION__);
  htm_CombFelt($type='text',    $name='collsize', $valu= $collsize, $labl='@Størrelse',        
      $titl='@Angiv en tekst der beskriver dimensionerne',       $revi=true, $rows='2',$width='',$step='');
  htm_CombFelt($type='text',    $name='collydre', $valu= $collydre, $labl='@Ydre størrelse',   
      $titl='@Angiv en tekst der beskriver de ydre dimensioner', $revi=true, $rows='2',$width='',$step='' );
  htm_CombFelt($type='tal2dc',  $name='collanbr', $valu= $collanbr, $labl='@Anbruds kostpris', 
      $titl='@Angiv et beløb der beskriver anbruds kostprisen',  $revi=true, $rows='2',$width='',$step='' );
  htm_CombFelt($type='tal2dc',  $name='collkost', $valu= $collkost, $labl='@Kostpris',         
      $titl='@Angiv et beløb der beskriver kostprisen',          $revi=true, $rows='2',$width='',$step='' );
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :LAGER:
function Panl_Vare_Tilbud() { ## out_PanlsSekd.php
  htm_Panl_Top($name= 'varekortform4',$capt= '@Periode-Tilbud:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW240',__FUNCTION__);
  htm_CombFelt($type='tal2dc',  $name='tilbpris', $valu= $tilbpris, $labl='@Salgspris',  
      $titl='@Angiv enheds Salgsprisen',                     $revi=true, $rows='2',$width='',$step='');
  htm_CombFelt($type='tal2dc',  $name='tilbkost', $valu= $tilbkost, $labl='@Kostpris',   
      $titl='@Angiv enheds Kostprisen',                      $revi=true, $rows='2',$width='',$step='' );
  htm_FrstFelt('50%');    
  htm_CombFelt($type='date',    $name='tilbstrt', $valu= $tilbstrt, $labl='@Dato start', 
      $titl='@Angiv start-dato for tilbudsperioen (incl.)',  $revi=true, $rows='2',$width='',$step='' );
  htm_NextFelt('50%');
  htm_CombFelt($type='date',    $name='tilbslut', $valu= $tilbslut, $labl='@Dato slut',  
      $titl='@Angiv slut-dato for tilbudsperioen (incl.)',   $revi=true, $rows='2',$width='',$step='' );
  htm_lastFelt(); 
  htm_FrstFelt('50%');    
  htm_CombFelt($type='time',    $name='timestrt', $valu= $timestrt=12, $labl='@Tid start', 
      $titl='@Angiv klokkeslet for tilbudsperiodens start-tidspunkt.',  $revi=true, $rows='2',$width='',$step='0.25 ',$more='max=24 min=0 ');
  htm_NextFelt('50%');
  htm_CombFelt($type='time',    $name='timeslut', $valu= $timeslut=12, $labl='@Tid slut',  
      $titl='@Angiv klokkeslet for tilbudsperiodens slut-tidspunkt.',   $revi=true, $rows='2',$width='',$step='0.25 ',$more='max=24 min=0 ');
  htm_lastFelt(); 
  htm_PanlBund($pmpt='@Gem',$subm=true);
}

######### :LAGER:
# Kaldes fra: page_Beholdningsliste.php
function Panl_Beholdningsrapp() { ## out_PanlsPrim.php
  set_FormVars(['varegrp','lgafdel','saelger','frstdato','lastdato','varenumr','varenavn','detaljer','kunsalg']);  // Opdater alle variabler på form 'lagrform' :
  
  htm_Panl_Top($name= 'lagrform',$capt= '@Varerapporter:',$parms='#',$icon='fas fa-chart-line','panelW320',__FUNCTION__);
    htm_FrstFelt('04%'); 
    htm_NextFelt('36%');  htm_Prompt('@Vælg kriterier:','right');  //echo '<p align="center">'.tolk('@Angiv kriterier:').'</p> ';
    htm_NextFelt('02%');  
    htm_NextFelt('58%'); # htm_CheckFlt($type='checkbox',$name='somfakt',$valu='somfakt',
                         # $labl='@Husk dem', $titl='@Afmærk her, hvis kriterier skal genbruges.',  $revi=true);
    htm_NextFelt('05%');
    htm_LastFelt();
    htm_OptioFlt($type='text',  $name='varegrp',  $valu= $_SESSION['varegrp'],
                    $labl='@Varegruppe',         
                    $titl='@Vælg den Varegruppe du ønsker at få oplysninger om.',  
                    $revi=true, $optlist= Grp_Liste(),  $action='', $events='',$maxwd='300px',$onForm='lagrform');
    htm_OptioFlt($type='text',  $name='lgafdel',  $valu= $_SESSION['lgafdel'], 
                    $labl='@Afdeling',         
                    $titl='@Vælg den Afdeling du ønsker at få oplysninger om.',  
                    $revi=true, $optlist= Afd_Liste(),  $action='', $events='',$maxwd='300px',$onForm='lagrform');
    htm_OptioFlt($type='text',  $name='saelger',  $valu= $_SESSION['saelger'], 
                    $labl='@Sælger',         
                    $titl='@Vælg den Sælger du ønsker at få oplysninger om.',  
                    $revi=true, $optlist= Slg_Liste(),  $action='', $events='',$maxwd='300px',$onForm='lagrform');
    htm_FrstFelt('50%');
      htm_CombFelt($type='date',$name='frstdato', $valu= $_SESSION['frstdato'], $labl='@Periode fra', 
          $titl='@Periode fra dato',  $revi=true, $rows='2', $width='20px', $step='',$more='',$plho='@dato [YYYY-MM-DD]');
    htm_NextFelt('50%');  
      htm_CombFelt($type='date',$name='lastdato', $valu= $_SESSION['lastdato'], $labl='@Periode til', 
          $titl='@Periode til dato',  $revi=true, $rows='2', $width='20px', $step='',$more='',$plho='@dato [YYYY-MM-DD]');
    htm_LastFelt();
    htm_FrstFelt('20%');  
      htm_CombFelt($type='text',$name='varenumr', $valu= $_SESSION['varenumr'], $labl='@Varenr',   
          $titl='@Varenr',            $revi=true, $rows='2', $width='20px', $step='',$more='',$plho=' *');
    htm_NextFelt('80%');  
      htm_CombFelt($type='text',$name='varenavn', $valu= $_SESSION['varenavn'], $labl='@Varenavn', 
          $titl='@Varenavn',          $revi=true, $rows='2', $width='20px', $step='',$more='',$plho=' *');
    htm_LastFelt();
    
    htm_FrstFelt('50%');
      htm_CheckFlt($type='checkbox',$name='detaljer', $valu= $_SESSION['detaljer'], $labl='@Detaljeret',  
          $titl='@Detaljeret',        $revi=true, $more=' '.$pg);
    htm_NextFelt('50%');  
      htm_CheckFlt($type='checkbox',$name='kunsalg', $valu= $_SESSION['kunsalg'], $labl='@Kun salg / DB',  
          $titl='@Kun salg / DB',     $revi=true, $more=' '.$pg);
    htm_LastFelt();
    htm_Accept($labl='@Benyt det', $title='@Godkend dine valg, så de benyttes ved rapportdannelse', $width='',$akey='b',$form='lagrform');
  
    htm_KnapGrup('@Vis:',true);
      textKnap($label='@Vare rapport',    $title='@Vis varer, som opfylder de kriterier, du har angivet ovenfor', 
                                          $link=  '../_lager/page_Rapport-lagr.php?job=lgrvalg',   $akey='v');
      textKnap($label='@Lagerstatus',     $title='@Se lagerstatus på en vilkårlig dato',                
                                          $link=  '../_lager/page_Rapport-lagr.php?job=lgrstat',   $akey='s');
      textKnap($label='@Lageroptælling',  $title='@Funktion til optælling og regulering af varelager',  
                                          $link=  '../_lager/page_Rapport-lagr.php?job=lgrcount',   $akey='t');
    htm_KnapGrup('@Vis:',false);
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=false);
  dev_show();
}

######### :LAGER:
# Kaldes fra:  [_lager/page_Beholdningsliste.php] 
function Panl_Beholdningsliste() { ## out_PanlsPrim.php
  htm_Panl_Top($name= 'behlform',$capt= '@Beholdningsliste:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-database','panelW640',__FUNCTION__);
  htm_CentrOn(); 
    echo tolk('@Vælg kriterier i panelet til venstre, så vises resultatet her.'),'<br><br>';
  htm_CentOff();
  htm_PanlBund($pmpt='@Gem',$subm=false);
}

######### :LAGER:
function LagrRappTop($rapp='') { //  Data dannes i: Panl_Beholdningsrapp
  htm_FrstFelt('04%');  htm_NextFelt('15%');  htm_DataFelt('@KRITERIER =>',''); 
  htm_NextFelt('25%');    htm_DataFelt('@Varegruppe:',tolk(ListLookup(Grp_Liste(),$search= $_SESSION['varegrp'],$colsearch=1,$colresult=0)),''); 
  htm_NextFelt('25%');    htm_DataFelt('@Afdeling:',  tolk(ListLookup(Afd_Liste(),$search= $_SESSION['lgafdel'],$colsearch=1,$colresult=0)),''); 
  htm_NextFelt('25%');    htm_DataFelt('@Sælger:',    tolk(ListLookup(Slg_Liste(),$search= $_SESSION['saelger'],$colsearch=1,$colresult=0)),''); 
  htm_NextFelt('05%');    htm_LastFelt();
  
  htm_FrstFelt('04%');  
  htm_NextFelt('22%');    htm_DataFelt('@Fra Dato:',  $_SESSION['frstdato'],''); 
  htm_NextFelt('22%');    htm_DataFelt('@Til Dato:',  $_SESSION['lastdato'],''); 
  htm_NextFelt('20%');    htm_DataFelt('@Varenr.:',   $_SESSION['varenumr'],''); 
  htm_NextFelt('30%');    htm_DataFelt('@Varenavn:',  $_SESSION['varenavn'],''); 
  htm_NextFelt('01%');    htm_LastFelt(); //  $_SESSION['detaljer'] $_SESSION['kunsalg']
  htm_hr();
}

######### :LAGER:
function Panl_LagerVarer($DATA) {
  htm_Panl_Top($name= 'lagrform',$capt= '@Vare rapport:',$parms='#',$icon='fas fa-chart-line','panelW720',__FUNCTION__);
  LagrRappTop();
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Vare ',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '@status']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Varenr.',    '7%', 'keyn','',  ['left']  , '@Varenummer. Entydig nummerkode, som benyttes til sortering, summering mv.','@Numr...'],
          ['@Enhed',      '5%', 'text','',  ['left']  , '@Paknings enhed','@Enh...'],
          ['@Beskrivelse','30%','data','',  ['left']  , '@Beskrivende tekst, som benyttes ved ordre/faktura','@Besk...'],
          ['@Købt',       '6%', 'text','',  ['right'] , '@Produktets xxx','@Købt...'],
          ['@Solgt',      '9%', 'text','',  ['right'] , '@Produktets xxx ','@Solgt...'],
          ['@Antal',      '6%', 'text','',  ['right'] , '@Produktets xxx ','@Antal...'],
          ['@Købspris',   '8%', 'text','',  ['center'], '@Produkt xxx','@Købs...'],
          ['@Kostpris',   '8%', 'text','',  ['center'], '@xxx','@Kost...'],
          ['@Salgspris.', '8%', 'text','',  ['center'], '@xxx','@salg...']
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),
    $DATA, #=    array(     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
          // $TablData= ImportTabFile('../_exchange/varer.tab',1),  // Indlæs data fra TAB-fil
        #),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,       # Mulighed for at oprette en record
    $ModifyRec=false,       # Mulighed for at ændre data i en row
    $ViewHeight= '150px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_KnapGrup('@Her kan du:',true,true);
    textKnap($label='@Eksporter til CSV',         $title='@Klik her for at eksportere til en CSV-fil',$link='../_base/page_Blindgyden.php');
  htm_KnapGrup('@Her kan du:',false,false);
  htm_PanlBund($pmpt='@Gem',$subm=false);
}

######### :LAGER:
function Panl_LagerStat($DATA) {
  htm_Panl_Top($name= 'lagrform',$capt= '@Lagerstatus:',$parms='#',$icon='fas fa-chart-line','panelW720',__FUNCTION__);
  LagrRappTop();
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Produkt ',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '@statistik']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Varenr.',    '7%', 'keyn','',  ['left']  , '@Varenummer. Entydig nummerkode, som benyttes til sortering, summering mv.','@Numr...'],
          ['@Enhed',      '5%', 'text','',  ['left']  , '@Paknings enhed','@Enh...'],
          ['@Beskrivelse','30%','data','',  ['left']  , '@Beskrivende tekst, som benyttes ved ordre/faktura','@Besk...'],
          ['@Købt',       '6%', 'text','',  ['right'] , '@Produktets xxx','@Købt...'],
          ['@Solgt',      '9%', 'text','',  ['right'] , '@Produktets xxx ','@Solgt...'],
          ['@Antal',      '6%', 'text','',  ['right'] , '@Produktets xxx ','@Antal...'],
          ['@Købspris',   '8%', 'text','',  ['center'], '@Produkt xxx','@Købs...'],
          ['@Kostpris',   '8%', 'text','',  ['center'], '@xxx','@Kost...'],
          ['@Salgspris.', '8%', 'text','',  ['center'], '@xxx','@salg...']
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),
    $DATA, #=    array(     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
          // $TablData= ImportTabFile('../_exchange/varer.tab',1),  // Indlæs data fra TAB-fil
        #),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,       # Mulighed for at oprette en record
    $ModifyRec=false,       # Mulighed for at ændre data i en row
    $ViewHeight= '150px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_FrstFelt('40%');    htm_DataFelt('@Samlet lagerværdi pr.','?'); 
  htm_NextFelt('20%');    htm_DataFelt('@Købspris:','0,00',''); 
  htm_NextFelt('20%');    htm_DataFelt('@Kostpris','0,00',''); 
  htm_NextFelt('20%');    htm_DataFelt('@Salgspris','0,00',''); 
  htm_LastFelt();
  htm_KnapGrup('@Her kan du:',true,false);
    textKnap($label='@Eksporter til CSV',         $title='@Klik her for at eksportere til en CSV-fil',$link='../_base/page_Blindgyden.php');
  htm_KnapGrup('@Her kan du:',false,false);
  htm_PanlBund($pmpt='@Vis udskrift (blindgyde)',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}

######### :LAGER:
function Panl_LagerTal($DATA,$optalte=false)  {
  htm_Panl_Top($name= 'lagrform',$capt= '@Lager-optælling:',$parms='#',$icon='fas fa-chart-line','panelW720',__FUNCTION__);
  LagrRappTop();
  if ($optalte) $what= '@uoptalte varer'; else $what= '@optalte varer'; ;
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Liste over ',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    $what]
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Varenr.',         '7%', 'keyn','',  ['center'], '@Varenummer. Entydig nummerkode, som benyttes til sortering, summering mv.','@Numr...'],
          ['@Beskrivelse',    '40%', 'data','',  ['left']  , '@Beskrivende tekst, som benyttes ved ordre/faktura','@Besk...'],
          ['@Beholdning',     '10%', 'text','',  ['right'] , '@Beholdning xxx','@Beh...'],
          ['@Kostpris',       '10%', 'text','',  ['right'] , '@Kostpris','@Kost...'],
          ['@Lagerværdi',     '10%', 'text','',  ['right'] , '@Produktets Lagerværdi ','@Værd...'],
          ['@Σ Lagerværdi', '20%', 'text','',  ['right'] , '@Sum af produktets Lagerværdi ','@Sum...'],
       ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),
    $DATA, #=    array(     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
          // $TablData= ImportTabFile('../_exchange/varer.tab',1),  // Indlæs data fra TAB-fil
        #),
    $FilterOn= false,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=false,       # Mulighed for at oprette en record
    $ModifyRec=false,       # Mulighed for at ændre data i en row
    $ViewHeight= '150px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  //echo 'Dato		Varenummer / Stregkode  Klik her for liste over ikke optalte varer';
  //echo 'Importer';
  //echo 'Dato		Varenummer / Stregkode	----- Ikke optalte varer pr 31-12-2012 -----Varenr	Beskrivelse	Beholdning	Kostpris	Lagerværdi	Lagerværdi sum';
  htm_KnapGrup('@Du kan:',true);  
      if ($optalte)
           textKnap($label='@Se optalte',     $title='@Klik her for liste over optalte varer',                
                                              $link=  '../_base/page_Blindgyden.php',   $akey='i');
      else textKnap($label='@Se ikke optalte', $title='@Klik her for liste over ikke optalte varer',                
                                              $link=  '../_base/page_Blindgyden.php',   $akey='i');
      textKnap($label='@Importere',           $title='@Importer på en vilkårlig dato',                
                                              $link=  '../_base/page_Blindgyden.php',   $akey='i');
      textKnap($label='@Eksportere',           $title='@Eksportere på en vilkårlig dato',                
                                              $link=  '../_base/page_Blindgyden.php',   $akey='i');
  htm_KnapGrup('@Vis:',false);
  htm_PanlBund($pmpt='@Vis udskrift (blindgyde)',$subm=true,'@Vis rapporten på en udskriftsvenlig side');
}


######### :LAGER:
# Kaldes fra:  [_lager/page_Varemodtagelse.php] [_lager/page_Varer.php] [_system/page_Varerelat.php] 
function Panl_Varer(&$DATA/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) { ## out_PanlsPrim.php
  include_once "../_config/connect.php";   #+  Database tilkobling
  htm_Panl_Top($name= 'vareform',$capt= '@Vareliste:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-database','panelWmax',__FUNCTION__);
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Produkter ',   '',    'html',    '', '',      '',    '@i databasen']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Varenr.',    '7%', 'keyn','',  ['left']  , '@Varenummer. Entydig nummerkode, som benyttes til sortering, summering mv.','@Numr...'],
          ['@Enhed',      '5%', 'show','',  ['left']  , '@Paknings enhed','@Enh...'],
          ['@Beskrivelse','33%','data','',  ['left']  , '@Beskrivende tekst, som benyttes ved ordre/faktura','@Besk...'],
          ['@Kostpris',   '6%', 'text','',  ['right'] , '@Produktets kostpris','@Kost...'],
          ['@Salgspris',  '6%', 'text','',  ['right'] , '@Produktets normale salgspris','@Salgs...'],
          ['@Vejl_pris',  '6%', 'text','',  ['right'] , '@Produktets vejledende pris','@Vejl...'],
          ['@Note',      '18%', 'text','',  ['center'], '@Produkt note','@Note...'],
          ['@Gruppe',     '5%', 'text','',  ['center'], '@Varegruppe','@Grup...'],
          ['@Beholdn.',   '6%', 'text','',  ['center'], '@Lagerbeholdning','@Beh...'],
          ['@Lokation.',  '6%', 'text','',  ['center'], '@Hvor varen befinder sig','@Lok...'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),
    $DATA, #=    array(     # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
          // $TablData= ImportTabFile('../_exchange/varer.tab',1),  // Indlæs data fra TAB-fil
        #),
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '200px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );

  htm_nl();
  htm_KnapGrup('@Her kan du:',true,false);
    textKnap($label='@Ny vare',         $title='@Klik her for at oprette en ny vareregistrering',$link='../_base/page_Blindgyden.php');
    textKnap($label='@Indkøbsforslag',  $title='@Klik her for at lave et indkøbsforslag',$link='../_base/page_Blindgyden.php');
    textKnap($label='@Se ordrebeholdning', $title='@Opslag - Se oversigt over ordrebeholdning',$link='../_base/page_Blindgyden.php');
    textKnap($label='@Visning',         $title='@Visning - Vælg hvad der skal vises',$link='../_base/page_Blindgyden.php');
  htm_KnapGrup('@Her kan du:',false,false);
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
}

######### :LAGER:
function Panl_Vare_Specielt() { ## out_PanlsPrim.php
  htm_Panl_Top($name= 'varekortform2',$capt= '@Specielt:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW400',__FUNCTION__);
  htm_CombFelt($type='area',$name='noter',$valu= $noter,        $labl='@Bemærkning',    $titl='@Angiv Bemærkninger',  $revi=true, $rows='2');
  htm_nl();
  htm_FrstFelt('30%');    htm_CheckFlt($type='checkbox',$name='serinr', $valu= $serinr, $labl='@Serienr',   
      $titl='@Serienr',  $revi=false, $more=' '.$pg);
  htm_NextFelt('40%');    htm_CheckFlt($type='checkbox',$name='samlev', $valu= $samlev, $labl='@Samlevare', 
      $titl='@Varen består af flere delvarer. Afmærk her hvis varen er en samlevare. Feltet er låst, hvis beholdningen er forskellig fra 0 eller varen indgår i en uafsluttet ordre',       $revi=false, $more=' '.$pg);
  htm_NextFelt('30%');    htm_CheckFlt($type='checkbox',$name='udgaa',  $valu= $udgaa,  $labl='@Udgået',    
      $titl='@Produktet er udgået, og kan ikke bestilles',      $revi=false, $more=' '.$pg);
  htm_lastFelt(); 
  //  Følgevare	  Provisionsfri
  htm_FrstFelt('60%');    htm_CombFelt($type='text',    $name='flgevare', $valu= $flgevare, $labl='@Følgevare',     
      $titl='@Følgevare',     $revi=true, $more=' '.$pg);
  htm_NextFelt('40%');    htm_CheckFlt($type='checkbox',$name='provfri',  $valu= $provfri,  $labl='@Provisionsfri', 
      $titl='@Provisionsfri', $revi=true, $more=' '.$pg);
  htm_lastFelt(); 
  htm_PanlBund($pmpt='@Gem',$subm=true);
  SpalteBund(); # 1. spalte
}

######### :LAGER:
function Panl_Vare_Priser() { ## out_PanlsPrim.php
  htm_Panl_Top($name= 'varekortform3',$capt= '@Enheds Priser:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW240',__FUNCTION__);
  htm_FrstFelt('70%');
  htm_CombFelt($type='tal2dc',  $name='enhdpris', $valu= $enhdpris,   $labl='@Salgspris',              $titl='@Netto almindelig salgspris', $revi=true, $rows='2',$width='',$step='');
  htm_NextFelt('30%');
  htm_CombFelt($type='tal2dc',  $name='avanc1',   $valu= $avanc1,     $labl='@Avance',                 $titl='@Kalkuleret avance i forhold til kostpris', $revi=false, $rows='2',$width='',$step='');
  htm_lastFelt(); 
  
  htm_FrstFelt('70%');
  htm_CombFelt($type='tal2dc',  $name='enhdengr', $valu= $enhdengr,   $labl='@B2B salgspris',          $titl='@Engros salgspris', $revi=true, $rows='2',$width='',$step='' );
  htm_NextFelt('30%');
  htm_CombFelt($type='tal2dc',  $name='avanc1',   $valu= $avanc1,     $labl='@Avance',                 $titl='@Kalkuleret avance i forhold til kostpris', $revi=false, $rows='2',$width='',$step='');
  htm_lastFelt(); 
  
  htm_FrstFelt('70%');
  htm_CombFelt($type='tal2dc',  $name='enhdlist', $valu= $enhdlist,   $labl='@Vejledende pris',        $titl='@Listepris', $revi=true, $rows='2',$width='',$step='' );
  htm_NextFelt('30%');
  htm_CombFelt($type='tal2dc',  $name='avanc1',   $valu= $avanc1,     $labl='@Avance',                 $titl='@Kalkuleret avance i forhold til kostpris', $revi=false, $rows='2',$width='',$step='');
  htm_lastFelt(); 
  
  htm_FrstFelt('70%');
    htm_CombFelt($type='tal2dc',$name='enhdansk', $valu= $enhdansk,   $labl='@Kostpris',               $titl='@Anskaffelses pris', $revi=true, $rows='2',$width='',$step='' );
  htm_NextFelt('30%');
  htm_lastFelt(); 
  htm_PanlBund($pmpt='@Gem',$subm=true);
}


######### :LAGER:
# Kaldes fra:  [_lager/page_Varemodtagelse.php] 
function Panl_Varemodtagelse(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */) {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'varemodtform',$capt= '@Vare modtagelse:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-pen-square','panelWmax',__FUNCTION__);
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Her kan du vælge',   '200px',    'html',    '', '',      '',    '@blandt tidligere varemodtagelser'],
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Nr.',            '5%','indx','',  ['left'],  '@Entydig nummerkode..','@Id...'],
          ['@Dato',          '12%','date','',  ['left'],  '@Listens oprettelsesdato','@Dato [YYYY-MM-DD]'],
          ['@Oprettet af',   '15%','text','',  ['left'],  '@Initialer for den som har oprettet listen','@Opret...'],
          ['@Bemærkning',    '35%','text','',  ['left'],  '@Tilknyttet note','@Bem...'],
          ['@Modtaget af',   '15%','text','',  ['left'],  '@Initialer for den som har modtaget varerne','@Modt...'],
          ['@Modtaget dato', '14%','date','',  ['left'],  '@Modtagelses datoen','@Dato [YYYY-MM-DD]'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
//    &$DATA=   array(
//       ),
    $TablData= [[1,'Dato','Oprettet','Bemærkning','Modtaget','Modtaget'],
                  [2,'Dato','Oprettet','Bemærkning','Modtaget','Modtaget'],
                  [3,'Dato','Oprettet','Bemærkning','Modtaget','Modtaget']], 
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,      # Mulighed for at oprette en record
    $ModifyRec=true,      # Mulighed for at ændre data i en row
    $ViewHeight= '150px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
//  htm_CentrOn(); htm_nl();
//    textKnap($label='@Ny modtageliste',  $title='@Klik her for at oprette en vareregistrering',$link='../_base/page_Blindgyden.php');
//    textKnap($label='@Vis alle lister',  $title='@Klik her for at se alle lister, (Filteret nulstilles)',$link='../_base/page_Blindgyden.php');
//  htm_CentOff();

  htm_nl();
//  htm_hr();
  Panl_Vareliste();
  VareRegler();
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
}

######### :LAGER:
function VareRegler() {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'lagrform',$capt= '@Gammel forklaring:',$parms='page_Blindgyden.php',$icon='fas fa-pen-square','panelW480',__FUNCTION__);
  echo tolk('@Gammel ikke opdateret forklaring om lagerstyring:'); htm_nl();
//  *********************************** Når en vare leveres og faktureres inden varemodtagelse ******************************************
htm_Caption('@Når en vare leveres og faktureres inden varemodtagelse.');
htm_Plaintxt('@Når en indkøbsordre godkendes skrives der for hver varelinje, en tilsvarende linje (A) i tabellen RESERVATION.');
htm_Plaintxt('@Varelinjens ID angives i [linje_id], varens ID i [vare_id], 0 i [batch_salg_id] og vareantal i [antal]');

htm_Plaintxt('@Når en vare reserveres i en salgsordre, oprettes ligeledes en linje (B) i RESERVATION.');
htm_Plaintxt('@[linje_id] og [vare_id] kopieres fra linjen fra indkøbsordren, varelinjens id angives med negativt fortegn i [batch_salg_id] og reserveret antal angives i [antal]');

htm_Plaintxt('@Når varen leveres oprettes en linje (C) i BATCH_SALG');
htm_Plaintxt('@Her angives salgs ordre ID i [ordre_id], vare_id i [vare_id], ordrelinje ID i [linje_id], leveringsdato i [salgsdate] og leverance nummer i [lev_nr] ');
htm_Plaintxt('@i linje A ændres [batch_salg_id] til linje ID fra C.');

htm_Plaintxt('@Når salgsordren faktureres oprettes en linje (D) i BATCH_KOB. (hvis [batch_kob] i A er tom)');
htm_Plaintxt('@Her angives købs ordre ID i [ordre_id], vare_id i [vare_id] og salgspris i [pris]. Linje ID aflæses. (hvis [batch_kob] i A er tom)');
htm_Plaintxt('@I linje A og alle øvrige linjer med samme værdi i [linje_id] angives linje ID fra D i [batch_kob]. (hvis [batch_kob] i A er tom)');
htm_Plaintxt('@I linje C angives linje ID fra D i [batch_kob], salgspris i [pris], og fakturadato i [fakturadate] ');
htm_Plaintxt('@I tabellen ordrelinjer tilføjes 2 linjer. Her angives ');
htm_Plaintxt('@1. værdien -1 i [posnr], værdien fra [pris] i D i [pris], ordre-id i [ordre_id], "lager afgang" i [bogf_konto] og antal i [antal]');
htm_Plaintxt('@2. værdien -1 i [posnr], værdien fra [pris] i D med negativt fortegn i [pris], ordre-id i [ordre_id], "varekøb" i [bogf_konto] og antal i [antal]');

htm_Plaintxt('@Ved bogføring af salgsordre krediteres værdien fra [pris] i D på "lager afgang" og debiteres på "varekøb". Salgssummen krediteres på varesalg og debiteres på Kunden.');

htm_Plaintxt('@Når varen modtages:');
htm_Plaintxt('@I linje D angives antal i [antal] Reserveret antal fra linjer med samme værdi som A i [linje_id] og [batch_køb]').' ';
htm_Plaintxt('@hvor [batch_salg] er positiv trækkes fra og restantal angives i [rest]. Leveringsdato angives i [salgsdate].');
htm_Plaintxt('@Linje A og alle linjer med samme værdi i [linje_id] og [batch_køb] hvor [batch_salg] er positiv slettes.');
htm_Plaintxt('@I alle linjer med samme værdi i [linje_id] og [batch_køb] hvor [batch_salg] er negativ anføres værdien fra [batch_salg] i linje_id og [batch_salg] rettes til 0.');

htm_Plaintxt('@Når indkøbsordren afsluttes til bogføring:');
htm_Plaintxt('@I linje C beregnes differensen mellem indkøbsprisen og prisen angivet i [pris]. [pris] rettes til indkøbsprisen. Fakturadato angives i [Fakturadate]');
htm_Plaintxt('@I tabellen ordrelinjer tilføjes 2 linjer. Her angives');

htm_Plaintxt('@1. værdien -1 i [posnr], differencen fra [pris] i C med negativt fortegn i [pris], ordre-id i [ordre_id], "varekøb" i [bogf_konto] og antal-rest i [antal]');
htm_Plaintxt('@2. værdien -1 i [posnr], differencen fra [pris] i C i [pris], ordre-id i [ordre_id], "lager afgang" i [bogf_konto] og antal-rest i [antal]');

htm_Plaintxt('@Ved bogføring af salgsordre krediteres differencen på "varekøb" og debiteres på "lager afgang". Købssummen krediteres på kunden og debiteres på "Lager tilgang".');

//  *************************** Når en vare leveres og faktureres efter varemodtagelse og før indkøbsordre bogføres ******************************
htm_Caption('@Når en vare leveres og faktureres efter varemodtagelse og før indkøbsordre bogføres');
htm_Plaintxt('@Når en indkøbsordre godkendes skrives der for hver varelinje, en tilsvarende linje (A) i tabellen RESERVATION.');
htm_Plaintxt('@Varelinjens ID angives i [linje_id], varens ID i [vare_id], 0 i [batch_salg_id] og vareantal i [antal]');

htm_Plaintxt('@Når varen modtages:');
htm_Plaintxt('@Der oprettes en linje (B) i BATCH_KOB.');
htm_Plaintxt('@Her angives købs ordre ID i [ordre_id], vare_id i [vare_id], antal i [antal], antal i [rest], leveringsdato i [salgsdate].');

htm_Plaintxt('@Når en vare reserveres i en salgsordre, oprettes en linje (C) i RESERVATION.');
htm_Plaintxt('@I C angives varelinjens ID i [linje_id], vare ID  i [vare_id], antal i [antal] og ID fra B i [batch_salg_id].');

htm_Plaintxt('@Når varen leveres oprettes en linje (D) i BATCH_SALG');
htm_Plaintxt('@Her angives salgs ordre ID i [ordre_id], vare_id i [vare_id], ordrelinje ID i [linje_id], ID fra B i [batch_kob_id], leveringsdato i [salgsdate] og leverance nummer i [lev_nr] ');

htm_Plaintxt('@Når salgsordren faktureres ');
htm_Plaintxt('@I linje D angives salgspris i [pris], og fakturadato i [fakturadate]');
htm_Plaintxt('@I linje B angives salgspris i [pris] men KUN hvis dette felt er tomt.');
htm_Plaintxt('@I tabellen ordrelinjer tilføjes 2 linjer. Her angives');
htm_Plaintxt('@1. værdien -1 i [posnr], værdien fra [pris] i D i [pris], ordre-id i [ordre_id], "lager afgang" i [bogf_konto] og antal i [antal]');
htm_Plaintxt('@2. værdien -1 i [posnr], værdien fra [pris] i D med negativt fortegn i [pris], ordre-id i [ordre_id], "lager afgang" i [bogf_konto] og antal i [antal]');
 
htm_Plaintxt('@Ved bogføring af salgsordre krediteres værdien fra [pris] i D på "lager afgang" og debiteres på "varekøb". Salgssummen krediteres på varesalg og debiteres på Kunden.');


htm_Plaintxt('@Når indkøbsordren afsluttes til bogføring:');
htm_Plaintxt('@I linje B beregnes differensen mellem indkøbsprisen og prisen angivet i [pris]. [pris] rettes til indkøbsprisen. Fakturadato angives i [Fakturadate]');

htm_Plaintxt('@Ved bogføring af salgsordre krediteres differencen på "varekøb" og debiteres på "lager afgang". Købssummen krediteres på kunden og debiteres på "Lager tilgang".');

//  *************************** Når en vare leveres og faktureres efter varemodtagelse og bogføring af indkøbsordre ******************************
htm_Caption('@Når en vare leveres og faktureres efter varemodtagelse og bogføring af indkøbsordre');
htm_Plaintxt('@Når en indkøbsordre godkendes skrives der for hver varelinje, en tilsvarende linje (A) i tabellen RESERVATION.');
htm_Plaintxt('@Varelinjens ID angives i [linje_id], varens ID i [vare_id], 0 i [batch_salg_id] og vareantal i [antal]');

htm_Plaintxt('@Når varen modtages:');
htm_Plaintxt('@Der oprettes en linje (B) i BATCH_KOB.');
htm_Plaintxt('@Her angives købs ordre ID i [ordre_id], vare_id i [vare_id], antal i [antal], antal i [rest], leveringsdato i [salgsdate].');

htm_Plaintxt('@Når indkøbsordren afsluttes til bogføring:');
htm_Plaintxt('@I linje B angives indkøbsprisen i [pris]. Fakturadato angives i [Fakturadate]');

htm_Plaintxt('@Ved bogføring af salgsordre krediteres købssummen på Leverandøren og debiteres på "Lager tilgang".');

htm_Plaintxt('@Når en vare reserveres i en salgsordre, oprettes en linje (C) i RESERVATION.');
htm_Plaintxt('@I C angives varelinjens ID i [linje_id], vare ID  i [vare_id], antal i [antal] og ID fra B i [batch_salg_id].');

htm_Plaintxt('@Når varen leveres oprettes en linje (D) i BATCH_SALG');
htm_Plaintxt('@Her angives salgs ordre ID i [ordre_id], vare_id i [vare_id], ordrelinje ID i [linje_id], ID fra B i [batch_kob_id], leveringsdato i [salgsdate] og leverance nummer i [lev_nr]');

htm_Plaintxt('@Når salgsordren faktureres ');
htm_Plaintxt('@I linje D angives salgspris i [pris], og fakturadato i [fakturadate]');

htm_Plaintxt('@Ved bogføring af salgsordre krediteres værdien fra [pris] i B på "lager afgang" og debiteres på "varekøb". Salgssummen krediteres på varesalg og debiteres på Kunden.');

//  *************************** Når en vare leveres før varemodtagelse og faktureres før bogføring af indkøbsordre ******************************
htm_Caption('@Når en vare leveres før varemodtagelse og faktureres før bogføring af indkøbsordre');
htm_Plaintxt('@Når en indkøbsordre godkendes skrives der for hver varelinje, en tilsvarende linje (A) i tabellen RESERVATION.');
htm_Plaintxt('@Varelinjens ID angives i [linje_id], varens ID i [vare_id] og vareantal i [antal]');

htm_Plaintxt('@Når en vare reserveres i en salgsordre, oprettes ligeledes en linje (B) i RESERVATION.');
htm_Plaintxt('@[linje_id] og [vare_id] kopieres fra linjen fra indkøbsordren, varelinjens id angives med negativt fortegn i [batch_salg_id] og reserveret antal angives i [antal]');

htm_Plaintxt('@Når varen leveres oprettes en linje (C) i BATCH_SALG');
htm_Plaintxt('@Her angives salgs ordre ID i [ordre_id], vare_id i [vare_id], ordrelinje ID i [linje_id], 0 i [batch_kob_id], leveringsdato i [salgsdate] og leverance nummer i [lev_nr]');
htm_Plaintxt('@i linje B ændres [batch_salg_id] til linje ID fra C.');

htm_Plaintxt('@Når varen modtages oprettes en linje (D) i BATCH_KOB.');
htm_Plaintxt('@Her angives købs ordre ID i [ordre_id], vare_id i [vare_id] og ordrelinje ID i [linje_id]. Linje ID aflæses. (hvis [batch_kob] i A er tom)');
htm_Plaintxt('@Reserveret antal fra linjer med samme værdi som A i [linje_id] og [batch_køb]').' ';
htm_Plaintxt('@hvor [batch_salg] er positiv trækkes fra og restantal angives i [rest]. Leveringsdato angives i [salgsdate].');
htm_Plaintxt('@Linje A og alle linjer med samme værdi i [linje_id] og [batch_køb] hvor [batch_salg] er positiv slettes.');
htm_Plaintxt('@I alle linjer med samme værdi i [linje_id] og [batch_køb] hvor [batch_salg] er negativ ').' ';
htm_Plaintxt('@anføres værdien fra [batch_salg] i linje_id, [batch_kob] rettes til ID fra D og [batch_salg] rettes til 0.');

htm_Plaintxt('@Når salgsordren faktureres: ');
htm_Plaintxt('@I linje C angives linje ID fra D i [batch_kob], salgspris i [pris], og fakturadato i [fakturadate].');
htm_Plaintxt('@I linje D angives salgspris i [pris] (KUN hvis [pris] er tom)');
htm_Plaintxt('@Ved bogføring af salgsordre krediteres værdien fra [pris] i D på "lager afgang" og debiteres på "varekøb". Salgssummen krediteres på varesalg og debiteres på Kunden.');

htm_Plaintxt('@Når indkøbsordren afsluttes til bogføring:');
htm_Plaintxt('@I linje D beregnes differensen mellem indkøbsprisen og prisen angivet i [pris]. [pris] rettes til indkøbsprisen. Fakturadato angives i [Fakturadate]');
htm_Plaintxt('@Ved bogføring af salgsordre krediteres differencen på "varekøb" og debiteres på "lager afgang". Købssummen krediteres på kunden og debiteres på "Lager tilgang".');

htm_PanlBund($pmpt='@Gem',$subm=false);
}

######### :LAGER:
function Panl_Vareliste() {  ## out_PanlsPrim.php
  htm_Panl_Top($name= 'varelistform',$capt= '@Modtage liste:',$parms='../_base/page_Hovedmenu.php',$icon='fas fa-pen-square','panelW480',__FUNCTION__);
  //echo '<tc><b>'.  tolk('@Posteringer:').' &nbsp;'.tolk('@i liste Id: 2').'</b></tc><br>'; 
  htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:Format', '4:horJust',      '5:Tip',    '6:Content'],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
          ['@Viser modtage-liste:', '15%', 'show', '', 'left', '@Her inddaterer du de enkelte varelinier', '@Nr: 2 ']
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
          ['@Varenr.',       '8%','indx','', ['left'  ], '@Entydigt varenummer','@Vare...'],
          ['@Antal',         '6%','text','', ['center'], '@Vare antallet','@Antal...'],
          ['@Beskrivelse',  '36%','text','', ['left'  ], '@Vare beskrivelse, svarende til det angivne varenr.','@auto...'],
          ['@Leveret',      '25%','text','', ['left'  ], '@Dato for levering, udfyldes automatisk med dags dato, men du kan korrigere den.','@auto...'],
          ['@Lager',        '25%','text','', ['left'  ], '@Lageret hvor varen er tilknyttet, ved varens oprettelse','@auto...'],
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
          []
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, SorterON, FilterON, SelectON]
    $TablData= [[1001,'Antal','Beskrivelse','Leveret','Lager'],[1002,'Antal','Beskrivelse','Leveret','Lager'],
                [1003,'Antal','Beskrivelse','Leveret','Lager'],[1004,'Antal','Beskrivelse','Leveret','Lager']], # 'Varenr.','Antal','Beskrivelse','Leveret','Lager'
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter
    $SorterOn= false,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at ændre data i en row
    $ViewHeight= '200px',  # Højden af den synlige del af tabellens data
    $CalledFrom= __FUNCTION__
  );
  htm_CentrOn();
    textKnap($label='@Gem modtageliste',  $title='@Klik her for at gemme vareregistreringen',$link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_PanlBund($pmpt='@Retur til hovedmenu',$subm=true,$title='@Luk og gå retur til hovedmenu');
}


######### :LAGER:
# Kaldes fra:  [_lager/page_Varemodtagelse.php] [_lager/page_Varer.php] 
function wall_Varekort(/*  &$ -  $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='', $xx='' */)  ## out_PanlsSekd.php
{global $Ønovice;   //  Skal ændre til page_...
  $varenr= '80110';
  $enhdpris= '1596.00';
  $enhdlist= '1800';
  $enhdansk= '1500';
  
  htm_Tapet_Top($name= 'varekortform',$capt= '@Varekort: ',$parms='page_Blindgyden.php',$icon='far fa-file-alt','panelW120',__FUNCTION__);
  htm_nl();
  htm_CentrOn(); 
//    textKnap($label='@<= Se forrige',   $title='@Klik her for at vise forrige varenummer',$link='../_base/page_Blindgyden.php');
    htm_Caption('@Varenummer: '.$varenr);
//    textKnap($label='@Se næste =>',     $title='@Klik her for at vise næste varenummer',$link='../_base/page_Blindgyden.php');
  htm_CentOff();
  
  SpalteTop(400); # 1. spalte
  Panl_Vare_Generelt();
  
  NextSpalte(400);
  Panl_Vare_Specielt();
  
  SpalteTop(240); # 2. spalte
  Panl_Vare_Priser();
  Panl_Vare_Tilbud();
  Panl_Vare_Rabatter();  
  NextSpalte(320); # 2. spalte
  Panl_Vare_Enheder();
  Panl_Vare_Beholdning();
  Panl_Vare_Grupper();
  NextSpalte(400); # 3. spalte
  Panl_Vare_Kategorier();
  Panl_Vare_Varianter();
  Panl_Vare_Dele();
  SpalteBund(); # 3. spalte
  
  htm_hr();
  htm_CentrOn();
    textKnap($label='@Ny Modtage liste',  $title='@Klik her for at oprette en ny modtagelse',$link='../_lager/page_Varemodtagelse.php');
    textKnap($label='@Leverandøropslag',  $title='@Opslag - Se ...',$link='../_base/page_Blindgyden.php');
  htm_CentOff();
  htm_TapetBund($pmpt='@Retur til vareliste',$subm=true,$title='@Retur til vareliste');
  htm_hr();
  Panl_Leverandorer();
  htm_hr();
  Panl_Varemodtagelse();
  PanelInitier(2,15);
  //for ($x = 2; $x <= 15; $x++) PanelMin($x);  //  Minimer 3. til 15. panel, så kun 1. og 2. panel er maksimeret
}   //  wall_Varekort

######### :LAGER:
function Panl_Vare_Generelt() { ## out_PanlsSekd.php
  htm_Panl_Top($name= 'varekortform1',$capt= '@Generelt:',$parms='page_Blindgyden.php',$icon='far fa-file-alt','panelW400',__FUNCTION__);
  htm_CombFelt($type='text',  $name='varenumr', $valu= $varenumr=$varenr='80100',   $labl='@Varenummer', 
      $titl='@Ved oprettelse at en ny vare, skal først angives et varenummer. Det frarådes at ændre varenumre, når de er taget i brug.'.'<br>'. 
      tolk('@Hvis varenummer rettes, ændres det i alle uafsluttede ordrer, tilbud, indkøbsforslag og indkøbsordrer.').'<br>'. 
      tolk('@Bemærk at hvis der er brugere, som er ved at redigere en ordre, kan dette bevirke at varenummeret ikke ændres i den pågældende ordre.').'<br>'. 
      tolk('@Det anbefales derfor at tilse at øvrige brugere lukker alle ordrevinduer.').'<br>'. 
      tolk('@Ændring af varenummer har ingen indflydelse på varestatistik eller andet, bortset fra at varen vil figurere med det gamle varenummer i ordrer som er afsluttet før ændringsdatoen.').'<br>'. 
      tolk('@Det er også muligt at sammenlægge 2 varenumre til 1. Her skal du skrive det varenummer, som du vil lægge denne ind i og sætter et lighedstegn foran, f.eks.: "=100", ').'<br>'. 
      tolk('@Så vil al historik mm, varebeholdning og evt.leverandør og shop bindinger blive lagt sammen til 1 vare, og varenr vil blive slettet.'),
      $revi=true, $rows='2',$width='',$step='', $more='required="required"', $plho=tolk('@V.nr......'));
  htm_CombFelt($type='text',  $name='varebesk', $valu= $varebesk='Træbriketter - 96 pk. a 10 kg. = 960 kg ',   $labl='@Beskrivelse', 
      $titl='@Angiv en tekst der beskriver produktet. Det er den tekst, som foreslås på ordrelinjerne i købs- og salgsordrer.',   
      $revi=true, $rows='2',$width='',$step='', $more='required="required"', $plho=tolk('@Beskrivelse...'));
  htm_CombFelt($type='text',  $name='varemrk', $valu= $varemrk,   $labl='@Varemærke',   
      $titl='@Angiv en tekst der beskriver varemærket',  
      $revi=true, $rows='2',$width='',$step='' );
  $genlstrg= 'STREGKODE';
  htm_FrstFelt('50%');    htm_CombFelt($type='text',  $name='genlstrg', $valu= $genlstrg, $labl='@Stregkode', 
      $titl='@Angiv en tekst, som skal benyttes som stregkode, Den vises i feltet til højre herfor.', 
      $revi=true, $rows='2',$width='',$step='' );
  $genlkode= '*'.$genlstrg.'*';
  htm_NextFelt('50%');    htm_CombFelt($type='barc',  $name='genlkode', $valu= $genlkode, $labl='',           
      $titl='@Her vises stregkoden', 
      $revi=true, $rows='2',$width='',$step='', $more='', $plho='--STREGKODE-- vises her.');
  htm_lastFelt(); 
  htm_PanlBund($pmpt='@Gem',$subm=true);
}
  

######### :LAGER: ######### Slut funktioner angående visninger i menu-gruppen LAGER


######### :PRODUKTION: ######### Start funktioner angående visninger i menu-gruppen PRODUKTION
  //  Ingen endnu - Reserveret 
######### :PRODUKTION: ######### Slut funktioner angående visninger i menu-gruppen PRODUKTION









################################################
################################################
################################################
################################################

#+  
?>