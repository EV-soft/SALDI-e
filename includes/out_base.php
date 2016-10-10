<?php      $DocFil1= '../includes/out_base.php';    $DocVer1='5.0.0';    $DocRev1='2016-10-00';     $modulnr1=0; 
## FORMÅL: Kontruktion af grundmoduler, angående udskrivning til skærm. 
//             ___   _   _    ___  _         
//            / __| /_\ | |  |   \| |   ___  
//            \__ \/ _ \| |__| |) | |__/ -_) 
//            |___/_/ \_|____|___/|_|  \___| 
//                                           
// LICENS & Copyright (c) 2004-2016 DANOSOFT ApS *** Se filen: ../LICENS_Copyright.txt
//
## LICENS:  (indføjes når filen er "færdig" og anvendelig i SALDI-systemet.)
// Dette program er fri software. Du kan gendistribuere det og / eller modificere det under
// betingelserne i GNU General Public License (GPL), som er udgivet af The Free Software Foundation;
// enten i version 2 af denne licens eller en senere version efter eget valg.     
// Fra og med version 3.2.2 dog under iagttagelse af følgende:                    
// Programmet må ikke uden forudgående skriftlig aftale anvendes i konkurrence med
// DANOSOFT ApS eller anden rettighedshaver til programmet.                          
// Programmet er udgivet med håb om at det vil være til gavn, men UDEN NOGEN FORM FOR
// REKLAMATIONSRET ELLER GARANTI. Se GNU General Public Licensen for flere detaljer. 
// En dansk oversaettelse af licensen kan læses her:  http://www.saldi.dk/dok/GNU_GPL_v2.html
// 
// Copyright (c) 2004-2016 DANOSOFT ApS 
// ----------------------------------------------------------------------

## AFHÆNGIGHED:
// out_base.php er afhængig af: base_init.php og out_style.css.php
// 
// htm_*.php  - Grundmoduler (htm_*) egnet for adaptive skærm-output.
// out_*.php  - Modulerne benyttes KUN i out_ruder.php, hvor system-paneler (ruder) opbygges.
// out_*.php  - Ruder spalte-opsættes efterfølgende i out_vinduer.php, som er de vinduer brugeren oplever. 
// page_*.php - Sider bestående af mange vinduer gemmes i filer med prefix: page_*.php f.eks.: page_LayoutModuler.php
// 
## NOTER:
// Disse filer er redigeret med tabulator sat til 2 tegn, og ses bedst med det.
// Fremover tilstræbes det at benytte SPACE i stedet for TAB.
// VIGTIGT: Kilde-filer skal gemmes i UTF-8 format uden BOM!  (for ikke konstant at konververe fra ANSI til UTF-8)
// class="lablInput" er et format, der kombinerer forskellige INPUT-felter med LABEL og Popup-TIP på lysblå baggrund.
// Givagt: Filnavne er følsomme overfor store/små bogstaver. For læsbarhed er første ord i et filnavn angivet med stort!
// f.eks: page_Kladdeliste.php. - PHP-rutiners navne er ufølsomme...

## REVISIONER:
// 2016.08.00 ev - EV-soft : 1. udgave af filen                                                     
                                                                                                    
// ***** Grundlæggende Rutiner for layout og visning af data ***************************************

## include("../_base/base_init.php");  // Skal kaldes forinden. (sker i htm_pageHead.php)
if ($GLOBALS["debug"]) debug_log($DocVer1,$DocRev1,$modulnr1,$DocFil1,'');

if (!function_exists('msg_Dialog')) {
  include('../includes/msg_lib.php');};  

if ($programSprog== NULL) {$programSprog= 'da';}
# $programSprog= 'en';  # da:Dansk  en:English  de:Deutsch  fr:Français   tr:Türkçe   es:Español

# BASISGRANUL:
function Lbl_Tip($lbl,$tip) { if ($lbl=='') return ''; else return '<div class="tooltip">'.tolk($lbl).'<span class="tooltiptext">'.tolk($tip).'</span></div>';}

# BASISMODUL for data-visning, label, titelTip og input:
function htm_CombFelt($type='',$name='',$valu='',$titl='',$labl='',$revi=true,$rows='2',$width='',$step='',$more='') {global $lysBlaa;  # Inputfelt kombineret med label
  $LablTip= Lbl_Tip($labl,$titl); 
  $eventInvalid= 'oninvalid="this.setCustomValidity(\''.tolk('@Angiv ').$labl.'! '.'\')"';
  if (gettype($valu)== 'Float') $type= 'number' ; 
  if ($revi==true) $aktiv= ''; else $aktiv='disabled';
  if ($type== 'date') //  Firefox: supporterer ikke picker!
    echo '<div class="lablInput"> <input type= "date" '.$more.' id="'.$name.'" name="'.$name.'" style="line-height:100%; font-size:smaller;" value="'.$valu.'"   placeholder="åååå-mm-dd"  '.$aktiv.' />  <label for="'.$name.'">'.$LablTip.'</label> </div>';
  if (($name=='posi') or ($name=='antal')) {$align= 'style="text-align:center";';} else $align= '';

  if ($type== 'text') 
    echo '<div class="lablInput"> <input type= "text" '.$more.' width="'.$width.'" id="'.$name.'" name="'.$name.'" '.$align.' style="line-height:100%;" value="'.$valu.'" '.$eventInvalid.' '.$aktiv.' /> <label for="'.$name.'">'.$LablTip.'</label> </div>';
//  echo '<div class="lablInput"> <input type= "text" width="'.$width.'" id="'.$name.'" name="'.$name.'" '.$align.' style="line-height:100%;" value="'.$valu.'"  '.$aktiv.' />  <label for="'.$name.'">'.$LablTip.'</label> </div> <script> $(this).addClass("filled"); </script>';
      
  if ($type== 'tal1d')  # Antal
    echo '<div class="lablInput"> <input type= "text" '.$more.' style="text-align:right; line-height:100%;" width="'.$width.'" id="'.$name.'" name="'.$name.'" value="'.number_format($valu,1,',','.').'";  '.$eventInvalid.' '.$aktiv.'  pattern="^\d*\.?((25)|(50)|(5)|(75)|(0)|(00))?$" /> <label for="'.$name.'">'.$LablTip.'</label> </div>';
  
  if ($type== 'tal2d')  # Beløb og %
    echo '<div class="lablInput"> <input type= "text" '.$more.' style="text-align:right; line-height:100%;" width="'.$width.'" id="'.$name.'" name="'.$name.'" value="'.number_format($valu,2,',','.').'";  '.$eventInvalid.' '.$aktiv.'  pattern="^\d*\.?((25)|(50)|(5)|(75)|(0)|(00))?$" /> <label for="'.$name.'">'.$LablTip.'</label> </div>';
  
  if ($type== 'number')   /* lang="en" for at tillade "."-tegn som decimal adskiller, foruden dansk ,-tegn */
    echo '<div class="lablInput"> <input type= "number" '.$more.' lang="en" style="text-align: right; line-height:100%;" width="'.$width.'" step="'.$step.'" id="'.$name.'" name="'.$name.'" value="'.$valu.'"; '.$eventInvalid.' '.$aktiv.' pattern="(\d{3})([\.])(\d{2})" />  <label for="'.$name.'">'.$LablTip.'</label> </div>';
    
  if ($type== 'numberL')   /* lang="en" for at tillade "."-tegn som decimal adskiller, foruden dansk ,-tegn */
    echo '<div class="lablInput"> <input type= "number" '.$more.' lang="en" style="text-align: left; line-height:100%;" width="'.$width.'" step="'.$step.'" id="'.$name.'" name="'.$name.'" value="'.$valu.'"; '.$eventInvalid.' '.$aktiv.' pattern="(\d{3})([\.])(\d{2})" />  <label for="'.$name.'">'.$LablTip.'</label> </div>';
    
  if ($type== 'radio')  // Skræddersyet !
    echo '<form action=""><div>&nbsp; <small>'.
    '<bluelabl>'.$LablTip.':</bluelabl >  '.
    '<input type= "radio" name="'.$name.'" value="privat"> '.   tolk('@Privat').
    ' &nbsp; <font style="color:'.$lysBlaa.'">'.                tolk('@eller').':</font>'.
    '<input type= "radio" name="'.$name.'" value="erhverv"> '.  tolk('@Erhverv').
    '</small></div> </form>';

  if ($type== 'password') 
    echo '<div class="lablInput"> <input type= "password" '.$more.' width="'.$width.'" id="'.$name.'" name="'.$name.'" style="line-height:100%" value="'.$valu.'" '.$eventInvalid.' '.$aktiv.' /> <label for="'.$name.'">'.$LablTip.'</label> </div>';
  
  if ($type== 'passwordpower')  {   # PW med styrke måling:
    echo '<section><div class="lablInput">  '.
//    '<fieldset class="js-password-fieldset">'.
      '<input type= "password" '.$more.' width="'.$width.'" id= "password-strength-code" name="'.$name.'" style="line-height:100%" value="'.$valu.'"  '.$eventInvalid.' '.$aktiv.' />'.
//      '</fieldset>'.
      ' <label for="'.$name.'">'.$LablTip.'</label> </div>';
    echo '<meter max="4" id="password-strength-meter" title="Password Styrke måler: 5 niveauer"></meter>'.
         '<feedback id="password-strength-text" title="Feedback til det angivne password"></feedback></section>';
    }
    
  if ($type== 'mail') 
    echo '<div class="lablInput"> <input type= "email" '.$more.' id="'.$name.'" name="'.$name.'" value="'.$valu.'"  '.$eventInvalid.' '.$aktiv.' /> <label for="'.$name.'">'.$LablTip.'</label> </div>';
  
  if ($type== 'hidden') 
    echo '<input type= "hidden" id="'.$name.'" name="'.$name.'" value="'.$valu.'" />';
  
  if ($type== 'area') 
    echo '<div class="lablInput"> <textarea rows="'.$rows.'" id="'.$name.'" style="line-height:100%" '.$eventInvalid.' '.$aktiv.' >'.$valu.'</textarea>   <label for="'.$name.'">'.$LablTip.'</label> </div>  <br/>';
}

# BASISMODUL for checkbox:
function htm_CheckFlt($type='NotUsed',$name='',$valu='',$titl='',$labl='',$revi=true,$more='') {
  if ($revi==true) {$aktiv= ''; $colr='';} else {$aktiv='disabled'; $colr='#_$888888';};
  echo '&nbsp;<input type= "checkbox" name="'.$name.'" value="'.$valu.'"  '.$aktiv.' '.$more.'>   <label for="'.$name.'" style="color:'.$colr.';"  ><bluelabl>'.Lbl_Tip($labl,$titl).'</bluelabl> </label>  <br/>';
}

# BASISMODUL for option:
function htm_OptioFlt($type='NotUsed',$name='',$valu='',$titl='',$labl='',$revi=true,$optlist=array(),$action='',$events='') {global $lysBlaa;
  $eventInvalid= 'oninvalid="this.setCustomValidity(\''.tolk('@Vælg '.$labl.' på listen!').'\')"';
  if ($revi==true) {$aktiv= ''; $colr='';} else {$aktiv='disabled'; $colr='#_$888888';};
  #$array= array(['Fil i pdf-format','pdf','PDF-fil'],['Elektronisk forsendelse','email','email'],['Elektronisk fakturering','ioubl','OIOUBL'],['PBS faktura','pbs','PBS']);
  echo '<div class="lablInput">';
/*    echo ' <form action="'.$action.'">'; /* */    # required
    echo '<label style="color:'.$lysBlaa.'; font-weight:400; font-size:smaller"><bluelabl>'.Lbl_Tip($labl,$titl).'</bluelabl>'.
    ' <select class="styled-select" name='.$name.'  '.$events.' '.$eventInvalid.'> <option value="'.$valu.'" >'.Tolk('@Vælg !');  # title="'.$titl.'"     selected="'.$valu.'"
      foreach ($optlist as $rec) {
        echo '<option value="'.$rec[1].'" '.$rec[3];
        if ($rec[1]==$valu) echo ' selected';
        echo '>'.$lbl=Tolk($rec[2]).'</option> '; # "'.$tip=$rec[0].'"
        }
    echo '</select>&nbsp;&nbsp;&nbsp;</label>';
    //  $rec[3] kan indeholde hændelse
//    if ($action)
//    echo '<input type= "submit" id="Button1" name="submit" value="'.tolk('@Benyt').'"  title= "@Aktiver valget" style="position:absolute;left:70%;top:5px;width:50px;height:22px;z-index:6;">';
/*    echo '</form>'; /* */
  echo '</div>';
}
/* 
<SELECT onChange="myFunction(this.options[this.selectedIndex].value)">
  <OPTION value="1">Text 1</OPTION>
  <OPTION value="2">Text 2</OPTION>
</SELECT>

JS: 
function update(obj){ alert(obj.options[obj.selectedIndex].value);}
HTML:
<select name="sprog" onChange="update(this)">
  <option value="da" selected="selected">Dansk  </option>
  <option value="en"                    >Engelsk</option>
  <option value="de"                    >Tysk   </option>
</select>
*/

# BASISMODUL for radio-group:
function htm_RadioGrp($type='vert',$name='',$titl='',$labl='',$optlist=array(),$action='') {global $lysBlaa;
  echo '<form action=""><div style="font-weight:400"><label style="color:'.$lysBlaa.'; font-size:small">'.Lbl_Tip($labl,$titl).'  </label>';
    foreach ($optlist as $rec) {if ($type=='vert') echo '<br>'; 
      echo '<input type= "radio" name="'.$name.'" value="'.$valu=$rec[0].'">'.
            $lbl= Tolk($rec[1]).' &nbsp; <font style="color:'.$lysBlaa.'">'.
            $suff=Tolk($rec[2]).'</font>&nbsp;';        # " title="'.$tip=$rec[3].'"
  } 
  echo '</small></div> </form>';
}

/* 
<div id="wb_logoForm1" style="position:absolute;width:145px;height:93px;">
<form name="logoForm1" method="post" action="mailto:yourname@yourdomain.com" enctype="text/plain" id="logoForm1">
<select name="logoCombobox1" size="1" id="logoCombobox1" style="position:absolute;left:20px;top:17px;width:113px;height:23px;z-index:5;">
<option value="dsfv">fdsd</option>
<option value="wrtr">rtewtw</option>
</select>
<input type="submit" id="logoButton1" name="" value="Submit" style="position:absolute;left:38px;top:53px;width:66px;height:25px;z-index:6;">
</form>
</div>
 */
 
 
# BASISMODUL for tabel:                     #  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
function htm_Tabel($RowLabl='',$ColStyle=array(['@Kol0','7%','D','text','left',''],['@Kol1','10%','UD','date','left',''],['@Kol2','30%','UD','date','left','']), $TablData=array(), $FilterOn=true, $SortOn=false ) {
$Saldiblue= '#003366';
  $Capt1= '<b>'.tolk('@FILTER').'</b>: '.tolk('@Begræns visning i tabellen nedenfor, ved at angive søge-/visnings-kriterier i disse felter:');
  $Capt2= '<b><u>'.tolk('@SLET').':</u></b> '.tolk('@Slet indhold i alle filter-felter (= Vis alt ! )');

### inputTabel med Filter:
  if ($FilterOn) {  ### Vis filter-felter:
    echo '<div class="fixed-table-container">  <div class="header-background"> </div>';
    echo '<table cellspacing="0"><tc>&nbsp;&nbsp;&nbsp;'.$Capt1.'&nbsp;&nbsp;&nbsp;'.$Capt2.'</tc>';
    echo '<thead> <tr>';
      foreach ($ColStyle as $Specf) { echo '<th style="width:'.$Specf[1].'"> <div class="extra-wrap"><div class="th-inner">'.tolk($Specf[0]).'</div></div> </th>';  }
    echo '</tr> <tr class="row"> ';
    for ($x= 0; $x < count($ColStyle); $x++) {echo '<td><input type= "text" name="Kol'.$x.'" title="'.tolk('@Søg efter...').'" placeholder="...'.tolk('@Søg').'..." style="width:100%" /></td> ';}
    echo '</tr></tbody></thead> </table> </div>';
  }
### inputTabel med data:
  echo '<div class="fixed-table-container"> <div class="header-background"> </div>';
  echo '<div class="fixed-table-container-inner extrawrap">';
  echo '<table cellspacing="0"> ';
    foreach ($ColStyle as $Specf) { echo '<col style="width:'.$Specf[1].'">'; }
  echo '<thead> <tr>';
### inputTabel med sortering?: 
  $SeltRow= '<div1 class="tooltip">⇒<span class="tooltiptext" style="bottom: -12px; left: 65px">'.tolk('@Klik her for vælge denne ').tolk($RowLabl).'.</span></div1>';
  $LablTip= '<div0 class="tooltip"><span class="tooltiptext">'.tolk('@Klik her for at ændre sortering af listen. - Kun dit sidste valg har virkning.').' </span></div0>';
  $Up= '↑&nbsp;'; $Dw= '&nbsp;↓'; $UpDw= '↑↓';  
  if (!$SortOn) {$sortUp=''; $sortDw=''; $sortUpDw='';}
  else {$sortUp=   '<sorter onclick="this.style.color= \'red\'" '.$LablTip.$Up. '</sorter>';    # ToDo: relevant onclick javascript skal udvikles!
        $sortDw=   '<sorter onclick="this.style.color= \'red\'" '.$LablTip.$Dw. '</sorter> '; 
        $sortUpDw= '<sorter onclick="this.style.color= \'red\'" '.$LablTip.$UpDw.'</sorter> ';} 
### Sorterings-valg:
  foreach ($ColStyle as $Specf) { echo '<th> <div class="extra-wrap"><div class="th-inner">';
    if ($Specf[2]=='D') echo $sortDw; else if ($Specf[2]=='U') echo $sortUp; else echo $sortUpDw;
    echo tolk($Specf[0]).'</div></div> </th>';
  }
  echo '</tr> </thead>  <tbody>';
### Vis Data:  
  foreach ($TablData as $Row) {echo '<tr class="row">'; $x= 0;
      foreach ($Row as $Col) {$x++; 
      if ($x==1) echo '<td> '.$SeltRow.' '.$Col.' </td>'; 
      else echo '<td style="text-align:'.$xxx.'">'.$Col.'</td>';  }
    echo '</tr>'; }
### Opret ny record:
    echo '<td><div1 class="tooltip" style="background:'.$Saldiblue.'; color:white;">'.tolk('Opret ny:').'<span class="tooltiptext" style="bottom: -12px; left: 65px">'.
    tolk('@Klik her når du har udfyldt data-felterne på denne række.').'</span></div1></td>'; 
    $x= 0;  foreach ($ColStyle as $Specf) { $x++; if ($x==1) $index= '9999'; else
      echo '<td style="padding:0;"> <div style="margin-right: 2px;"> <input type= "'.$Specf[3].'" name="Kol'.$x.'" placeholder="'.$Specf[6].'" style="text-align:left; width:98%;" /></div></td> ';
    }
  echo '</tbody>  </table> </div> </div>';
}

if (!function_exists('MakeOptList')) {
function MakeOptList($valu,$optliste=[]) {
  echo '<td> <div style="margin-right:0; "> <select class="styled-select" name="liste"> <option value="'.$valu.'" >';
    foreach ($optliste as $rec) {
      echo '<option value="'.$rec[1].'" '.$rec[3];
        if ($rec[1]==$valu) echo ' selected';
      echo '>'.$lbl=$rec[2].'</option> ';
    }
  echo '</select></div></td> ';
}}


# BASISMODUL for tabelInput (Redigerbare data i tabel-celler):
function htm_TabelInp ( #$Capt1='',
                        #$Capt2='',     # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
                        $HeadLine= array('0','1','2','3','4','5'),
                        $RowPref=array(['Capt','Label','Tip','width']), 
                        $ColStyle=array(['@Kol0','7%','','','Tip',''],['@Kol1','10%','','','Tip',''],['@Kol2','30%','','','Tip','']), 
                        $RowSuff=array(['tdContent','Value']),
                        &$DATA=array() ) { global $lysBlaa;
  echo '<div class="fixed-table-container">';
  if ($HeadLine[0][0]>'') {
    echo '<div class="header-background" style="color:'.$lysBlaa.';"> &nbsp;';
      foreach ($HeadLine  as $Capt) {
        if ($Capt[3]='show')
        echo tolk($Capt[0]).' <input type= "'.$Capt[3].'" name="note" title="'.tolk($Capt[4]).'" value="'.tolk($Capt[5]).'" style="width:'.$Capt[1].'" disabled />&nbsp;&nbsp;';
        else
        echo tolk($Capt[0]).' <input type= "'.$Capt[3].'" name="note" title="'.tolk($Capt[4]).'" placeholder="'.tolk($Capt[5]).'" style="width:'.$Capt[1].'" />&nbsp;&nbsp;';
      }
    echo '</div>';
  }
  echo '<table class="formnavi" cellspacing="0">';
  
### Kolonne-LABELS:
  echo '<thead><tbody><tr> '; 
  foreach ($RowPref  as $Pref) {echo '<th style="width:'.$Pref[1].' align:'.$Pref[2].'"> <div class="extra-wrap"><div class="th-inner-center" align="center">'.Lbl_Tip($Pref[0],$Pref[5]).'</div></div> </th>';}
  foreach ($ColStyle as $Spec) {echo '<th style="width:'.$Spec[1].'"> <div class="extra-wrap"><div class="th-inner-center" align="center">'.Lbl_Tip($Spec[0],$Spec[4]).'</div></div> </th>';  }
  foreach ($RowSuff  as $Suff) {echo '<th style="width:'.$Suff[1].' align:'.$Suff[2].'">'.Lbl_Tip($Suff[0],$Suff[5]).'</th>';}
  echo '</tbody></thead> </tr> ';
  
### Kolonne-DATA-INPUT:   
  echo'<thead> <tbody>  ';
  $optlist= FormVars(4); $ordlist= OrdrVars(4); $n= count($DATA); if ($n<1) $n= 20;
# for ($y= 0; $y < $n; $y++) { $x=0;  // DEMO-data. ToDo: Skal i stedet knyttes til &$DATA array()
  $DatIx=-1;
  foreach ($DATA as $Dat) { $DatIx++;
    echo '<tr class="row">';
    foreach ($RowPref  as $Pref) {echo '<td style="width:'.$Pref[1].'; text-align:'.$Pref[2].'">'.tolk($Pref[4]).' </td>';} 
### Tabel-BODY:
    $ColIx= -1;
    foreach ($ColStyle as $Specf) {$ColIx++;                # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      if ($Specf[3]=='date') $smaller= 'text-align="left" width="70%" font-size="x-small" '; else $smaller= '';
      if ($Specf[3]=='vlst') {  # VariabelListe
        echo '<td> <div style="margin-right:0; font-size:x-small"> <select class="styled-select" name="liste"> <option value="" >-';
          foreach ($optlist as $rec) { echo '<option value="'.$rec[1].'" '.$rec[3];   if ($rec[1]==$valu) echo ' selected';   echo '>'.$lbl=$rec[2].'</option> '; }
        echo '</select></div></td> ';
      } 
      else  if ($Specf[3]=='just') { MakeOptList($valu,$optliste1=[['Venstre','V','V'],['Center','C','C'],['Højre','H','H']]);   } 
      else  if ($Specf[3]=='side') { MakeOptList($valu,$optliste2=[['Alle','A','A'],['Første','1','1'],['IkkeFørste','!1','!1'],['Sidste','S','S'],['IkkeSidste','!S','!S']]); } 
      else  if ($Specf[3]=='font') { MakeOptList($valu,$optliste3=[['sans-serif','Helvetica','Helvetica'],['serif','Times','Times'],['OptiskLæsbar','OCRbb12','OCRbb12']]); } 
      else  if ($Specf[3]=='data') { if ($Dat[$ColIx][0]=='Nyt felt')  {  # VariabelListe
        echo '<td> '.tolk('@Nyt felt:').' <div style="margin-right:0; font-size:x-small"> <select class="styled-select" name="liste"> <option value="" >-';
          foreach ($ordlist as $rec) { echo '<option value="'.$rec[1].'" '.$rec[3];   if ($rec[1]==$valu) echo ' selected';   echo '>'.$lbl=$rec[2].'</option> '; }
        echo '</select></div></td> ';
        } 
        else echo '<td> <div style="margin-right:0;"> <input type= "'.$Specf[3].'" name="Kol'.$ColIx.'" '.'value="'.tolk($Dat[$ColIx][0]).
                '" placeholder="'.$Specf[5].'" style="text-align:'.$Specf[2].'; background-color: transparent; width:100%;" /></div></td> ';
      } 
      else  # Standard: text m.fl.
          echo '<td> <div style="margin-right:0;"> <input type= "'.$Specf[3].'" name="Kol'.$ColIx.'" '.'value="'.
                '" placeholder="'.$Specf[5].'" style="text-align:'.$Specf[2].'; background-color: transparent; width:100%;" /></div></td> ';
    };
### RowSuff: [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
  foreach ($RowSuff as $felt) {echo '<td style="width:'.$felt[1].'; text-align:'.$felt[2].'">'.$felt[4].'</td>';}
    echo '</tr>';
  } # Ide: Mulighed for at vise kolonne-summer, eller andet, på en "footer-række" under tabellen.
  echo '</tbody></thead> </table> </div>';
}



# LAYOUT moduler:
function htm_Rude_Top($name='',$capt='',$parms='',$icon='',$klasse='panelWmax',$func='Udefineret') {  # SKAL efterfølges af htm_RudeBund !
  global $debug;
  if ($capt=='') $Ph= 'height:0;';
  echo '<form name="'.$name.'" id="'.$name.'" action="'.$parms.'" method="post">';
  if ($debug) {$fn= '&nbsp; <small><small><small>f:'.$func.'()</small></small></small>';} else $fn='';
  echo '<div class="'.$klasse.'"> <div class="panelTitl" style="'.$Ph.'" max-width:400;>'.
    '<ic class="fa '.$icon.'" style="font-size:22px;color:green"></ic> &nbsp;'.ucfirst(Tolk($capt)).$fn.'</div>';
  if ($capt!='') echo '<hr class="style13"/>';
} # Boxens </div> og </form> er placeret i htm_RudeBund som skal kaldes til slut!

function htm_RudeBund($pmpt='',$revi=false,$title='') { # SKAL følge efter htm_Rude_Top !
  if ($revi==true) {  echo '<hr><div class="centrer">';   htm_accept($pmpt,$title); echo '</div>';  }
  echo '</div></form>';
}

function htm_accept($labl='',$title='',$width='') {
  # $LablTip= '<div0 class="tooltip"><span0 class="tooltiptext">'.tolk($title).'</span0></div0>';
  if ($width) $width= ' width: '.$width.';';
# echo '<input type= "submit" class="mytip" titletip="'.tolk($title).'" name="submit" value="'.ucfirst(tolk($labl)).
  echo '<input type= "submit" class="tooltiptext" title="'.tolk($title).'" name="submit" value="'.ucfirst(tolk($labl)).
  '" style="margin: 2px 2px; padding: 4px 8px;'.$width.'" />';  # '.$LablTip.'
}

# Felter i en horisontal række:
function htm_FrstFelt($wth,$bord=0) {echo '<TABLE BORDER="'.$bord.'"  border-collapse: collapse; padding: 0px; width:100%;><TR><TD width="'.$wth.'"> ';}
function htm_NextFelt($wth) {echo '</TD>  <TD style="width:'.$wth.';"> ';}
function htm_LastFelt()     {echo '</TD>  </TR> </TABLE>';}

function iconKnap ($faicon='',$title='',$link='') {
    $LablTip= '<div0 class="tooltip" style="margin: 1px 5px;"><span class="tooltiptext">'.$title.'</span></div0>';
    echo '<span>';
    echo '<a href="'.$link.'" '.$LablTip.' ';
    echo '  <ic class="fa '.$faicon.'" style="font-size:32px; color:'.$color='#003366'.';"></ic>';
    echo '</a></span>'; 
}
    
function textKnap ($label='',$title='',$link='') {
    $LablTip= '<div0 class="tooltip" style="color:'.$color='#003366'.'; padding:5px;"><span class="tooltiptext">'.tolk($title).'</span></div0>';
    echo '<span style="margin:6px; padding:6px; font-size:0.8em; color:'.$color='#003366'.';"><a href="'.$link.'" '.$LablTip.' '.tolk($label).'</a></span>';  
}

function Head_Navigation ($sideObjekt, $status, $goPrev, $goHome=true, $goUp, $goFind, $goNew, $goNext) { # Genvejsknapper på siders top.
  $sideObjekt= tolk($sideObjekt);
  echo '<PanlHead>';
  htm_Rude_Top($name='naviform',$capt='',$parms='',$icon='','panelWmax',__FUNCTION__);
  echo '<div style="text-align: center"><img src= "../images/SALDIe50x150.png" alt="Saldi Logo" style="width:150px;height:50px;"></div>';
  echo '<p align="center"><b>'.tolk('@Navigation:').'<b></p>';
  echo '<p align="center">';  #<ic class="fa '.$icon.'" style="font-size:22px;color:green"></ic>
  if ($goPrev)  iconKnap($faicon='fa-caret-square-o-left',  $title= tolk('@Vis forrige')  .' '.$sideObjekt  ,$link='../_base/blindgyden.php');
  if ($goHome)  iconKnap($faicon='fa-home',                 $title= tolk('@Luk vinduet og gå til hoved-menu')       ,$link='../_base/page_Gittermenu.php'.$goBack);
  if ($goUp  )  iconKnap($faicon='fa-caret-square-o-up',    $title= tolk('@Luk vinduet og gå et niveau op')         ,$link= $goBack);
  if ($goFind)  iconKnap($faicon='fa-search',               $title= tolk('@Søg en anden') .' '.$sideObjekt  ,$link='../_base/blindgyden.php');
  if ($goNew )  iconKnap($faicon='fa-plus-square-o',        $title= tolk('@Opret ny')     .' '.$sideObjekt  ,$link='../_base/blindgyden.php');
  if ($goNext)  iconKnap($faicon='fa-caret-square-o-right', $title= tolk('@Vis næste')    .' '.$sideObjekt  ,$link='../_base/blindgyden.php');
  echo '</p>';
  if ($status) {
    $status= '<x1 style="font-weight:300; font-size:smaller"> - Status:<bluelabl> '.$status.'</bluelabl></x1>';
    echo '<p align="center">'.ucfirst($sideObjekt).$status.'</p> ';
  }
  htm_RudeBund($pmpt='@Gem',$revi=false,$title='@Gem');
  echo '</PanlHead>';
}

function Foot_Links ($maxi=false, $arg='', $doPrint, $doErase, $doLookUp, $doAccept, $doExport, $doImport,$OpslLabl='') { global $programSprog;
  htm_Rude_Top($name='linkform',$capt='',$parms='',$icon='','panelWmax',__FUNCTION__);
    if (($maxi) and ($OpslLabl>'')) echo '<p align="center"><b>'.tolk('@Handling:').'<b></p>';
    echo '<p align="center">';  #<ic class="fa '.$icon.'" style="font-size:22px;color:green"></ic>
    if ($doPrint)   iconKnap($faicon='fa-print',                $title= tolk('@Udskriv')  .' '.$sideObjekt  ,$link='../_base/blindgyden.php');
    if ($doErase)   iconKnap($faicon='fa-minus-square-o',       $title= tolk('@Slet posten')                ,$link='../_base/blindgyden.php'.$goBack);
    if ($doLookUp)  iconKnap($faicon='fa-search-plus',          $title= tolk($OpslLabl)                     ,$link='../_base/blindgyden.php');
    if ($doAccept)  iconKnap($faicon='fa-check-square-o',       $title= tolk('@Godkend alt')  .' '.$sideObjekt  ,$link='../_base/blindgyden.php');
    if ($doExport)  iconKnap($faicon='fa-upload',               $title= tolk('@CSV-Export')   .' '.$sideObjekt  ,$link='../_base/blindgyden.php');
    if ($doImport)  iconKnap($faicon='fa-download',             $title= tolk('@Fil import')   .' '.$sideObjekt  ,$link='../_base/blindgyden.php');
    echo '</p>';
    if ($maxi) {    
      htm_FrstFelt('10%',0);  
      htm_NextFelt('30%');    echo '<div style="display:inline-block; margin-left:1em; align:center">'.SprogValg($programSprog).'</div> ';
      htm_NextFelt('25%');    echo '<div style="display:inline-block; margin-left:1em; align:center">'.$arg.'</div> ';
      htm_NextFelt('30%');    echo '<div style="display:inline-block; margin-left:1em>'.htm_accept('@Log ud','@Forlad SALDI').'</div> ';
      htm_NextFelt('05%');    # Vare-opslag, Udskriv, Fakturer, Slet vist post, 
      htm_LastFelt();
      echo '<tc><divline style="margin-left:0.5em"><small><b>'.tolk('@TIP:').'</b> '.tolk('@Hold musen over').' <bluelabl>'.tolk('@Blå tekster med skyggeramme, ').'</bluelabl>'.tolk('@så får du hjælpetekster og tips.').'</small></divline></tc>';
    }
  htm_RudeBund($pmpt='@Gem',$revi=false,$title='@Gem');
}

function FirstSpalte() {echo '<PanlHead> <div id="wrapper"> <column id="spalte1">'; }
function SmallSpalte() {echo '<PanlHead> <div id="wrapper"> <column id="spalte0">'; }
function NextSpalte()  {echo '</column> <column id="spaltex">'; }
function EndSpalter()  {echo '</column> </div> </PanlHead><div class="clearWrap">' ; }
function panelStart () {echo '<PanlFoot>';}
function panelSlut () {echo '</PanlFoot>';}
function skilleLin () { echo '<hr size="10" color="#AA4D00">';}

function Win_Head ($title='') {   # Ubenyttet! erstattet af ../_base/htm_pageHead.php
  echo  '<!DOCTYPE html>';
  echo  '<html lang="da" dir="ltr">';
  echo  '   <head>';
  echo  '     <meta charset="UTF-8">';
  echo  '     <font face="Helvetica, Arial, sans-serif">';
  echo  '     <title>'.$title.'</title>';
  echo  '     <link rel="stylesheet" href= "../css/out_style.php">';
  echo  '     <link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" emne="ICON-system">';
  echo  '     <link rel="stylesheet" href= "../js/1.12.0/themes/base/jquery-ui.css" emne="jquery Dialog">';
  echo  '     <link rel="stylesheet" href= "../css/meter-style.css">';            // PassWord-styrke måler
  echo  '     <link rel="stylesheet" href= "../css/out_style.css" emne="out-style">';
  echo  '   </head>';
  echo  ' <body>';
}

function Win_Foot ($title='') {   # Ubenyttet!
  echo  ' </body></html>';
}

# SUPPLERENDE moduler:

function  HentData($dat1,$dat2,$dat3,$dat4,$dat5,$dat6) {   # Ubenyttet!
  /* STRATEGI:
  SALDI's variable erklæres som globale.
  De overføres til lokale variable, som kan sammenlignes med de globale,
  så brugerændringer kan signaleres ved at GEM-knap skifter farve fra grøn til gul.
   */
  # Det forudsættes at systemets variabler er opdateret inden benyttelse.
  
  # global $art, $brugsamletpris, $genfakt, $fokus, $hurtigfakt, $id, $incl_moms, $momssats, $valuta, $valutakurs, $vis_projekt, $status, $ny_pos, $procentfakt, $omkunde, $difkto, $rvnr, $vis_saet, $her;
  # ordrelinjer($x, $sum, $dbsum, $blandet_moms, $moms, $antal_ialt, $leveres_ialt, $tidl_lev_ialt, $levdiff, $masterprojekt, $linje_id, $kred_linje_id, $posnr, $varenr, $beskrivelse, $enhed, $pris, $rabat, $rabatart, $procent, $antal, $leveres, $vare_id, $momsfri, $rabatgruppe, $m_rabat, $varemomssats, $serienr, $samlevare, $folgevare, $projekt, $kdo, $kobs_ordre_pris, $ko_ant, $kostpris, $db, $dg, $dk_db, $dk_dg, $readonly, $omvbet, $saet, $saetnr);
  
  # $dkantal=0;$tidl_lev=0;
  # $kontonr, $ordrenr, $email, $lev_navn, $lev_postnr, $lev_bynavn, $lev_addr1, $lev_addr2, $lev_kontakt, $firmanavn, $postnr, $bynavn, $addr1, $addr2, $kontakt, $cvrnr, $landekode, $land, $tlf, $fakturanr, $sum, 
  # Dummy
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
# SPROG system:

function sprogDB_import($fname='../_config/Sprog_DB.csv') { # Filen skal være gemt i UTF-8 format!
  global $sprogTabl, $languageTable;
  $fp=fopen($fname,"r");
  if ($fp) {  $languageTable= [];
    while (($line = fgets($fp, 4096)) !== false) { array_push($languageTable, explode( '","',trim(trim($line),'"'))); }
  } fclose($fp);  
# sort($languageTable);
  $x= count($languageTable);  
  for ($x = 0; $x <= count($languageTable); $x++) { 
    $str .= trim($languageTable[$x][0]).'='.$languageTable[$x][1].'&';
  } $str= trim($str,'&');             # Fjern det sidste &-tegn
  $str = ''.trim(trim($str,','),'"'); # Fjern andre uønskede tegn
  parse_str($str, $sprogTabl);        # Dan $sprog-tabel med key og et sprog
} 

function found_index($sprogDB, $field, $value) {
  foreach($sprogDB as $key => $row) {
     if ($row[$field] === $value)  
    {return $key; break;}
  }  return false;  # 'TranslateError';
}

function Tolk($FraseKey) {                              # Tolk() benyttes til sprogoversættelse af alle hard-codede program-tekster.
  global $sprogTabl, $programSprog, $languageTable;     # Fraser med @-prefix er system-tekster, der kan omsættes til andet sprog.
  # $programSprog='de';                                 # Vær opmærksom på at samme frase, ikke kaldes flere gange f.eks. i rutiner i underniveauer.
 if (substr($FraseKey,0,1)!='@') {return($FraseKey); break;}  # Kan være tolket tidligere!
 if (($programSprog) and ($languageTable))    
  switch ($programSprog=strtolower($programSprog)) {    # 0 Key             
    case "da" :$result= trim($FraseKey,'@');  break;    # 1 Dansk          da: Vis frasen uden prefix
    case "en" :$ix= 2;  break;                          # 2 Engelsk        sæt index for opslag
    case "de" :$ix= 3;  break;                          # 3 Deutsch        sæt index for opslag
    case "fr" :$ix= 4;  break;                          # 4 Français       sæt index for opslag
    case "tr" :$ix= 5;  break;                          # 5 Türkçe         sæt index for opslag
    case "es" :$ix= 6;  break;                          # 6 Español        sæt index for opslag
                                                        # 7 Grønlandsk       
    default   : {$ix= 1; echo "<bluelabl>Sprog?:".$programSprog." </bluelabl>"; break;}
  }
  $TblRow= found_index($languageTable, 0, $FraseKey);
  if (substr($FraseKey,0,1)=='@')                                         # Er frasen med @-prefix:
       {if ($programSprog=='da')  {$result= trim($FraseKey,'@');}         #   Er sproget dansk fjernes @-prefix blot i resultatet
        else if ($TblRow>0) {$result= $languageTable[$TblRow][$ix];}      #   ellers slås op i sprogtabellen
        else {$result= $FraseKey.'<small><small> (Danish!)</small></small>'; $MissingFrase.='<br>'.$FraseKey;} # Oversættelse mangler: Vis $FraseKey  med @-prefix
       }  
  else {$result= $FraseKey;}                                              # Fraser uden @-prefix returneres uændret.
  return($result);
} 

# OBS!  Benyt konsekvent prefix: '@ ikke: "@ så alle fraser kan udtrækkes automatisk!
# Oversættelsen sker automatisk i BASISMODULER med tolk(), når parametre behandles.
# I sjældne tilfælde (lange eller sammensatte tekster), er det nødvendigt at benytte tolk() lokalt.
# Undgå forkortelser og sammensatte ord, som kan forringe oversættelse og liniewrap.
# Undgå indledende og afsluttende SPACE, og <HTML> koder i fraser. Benyt @@ hvis en frase skal starte med @
# Tegnet: " må ikke forekomme i fraser, det korrumperer csv-formatet. Benyt f.eks. ' i stedet.
//////////////////////////////////////////////////////////////////////////////////////////////////////////


/*  

FORDELE ved systemet:

 Adaptive layout ved Skærmbredde[px]:
 < 320    : 1 spalte med fast bredde. 5-kolonnet Gittermenu ombrydes.
 320.. 640: 1 spalte med varierende bredde. 5-kolonnet Gittermenu ombrydes.
 640..1000: 1 spalte med varierende bredde. Gittermenu i fuld bredde.
 > 1000   : 3-spaltet layout. Fast spalte-bredde: 320px. Gittermenu i fuld bredde.
 
 (En vertikal menu kan reducere bredden til 4 elementer! : 415px)
 
 Tip vises ved mus over tydeligt markeret label, som deler plads med input-felt.
 
 Alle labels og tip kan oversættes til et andet program-sprog, 
 med nem opdatering af alle forekommende fraser, når prefix: @ er benyttet.
 Fraselængden for dansk er pt. begrænset til max. 170 tegn. (i frasescann.php)
 Er der længere fraser skal de opdeles i flere, ved at indskyde >'.'@< i frasen,
 på et hensigsmæssig sted (ny sætning) for ikke at sabotere sprogoversættelse.
 Tegn der ikke må benyttes: < > " @ (udover prefixet)' fordi de mistolkes!
 Tags som: </small> fjernes. De skal i stedet indeholdes i strenge omkring fraser.
 Slut ikke en frase med SPACE, da den kan blive fjernet, og key passer da ikke!
 Brugeren kan selv korrigere sprog-tekster i regneark. (Forudsat Up-/Down-load er mulig)
 
 Sprogtekster kan vedligeholdes i LO-regneark:
 Importer fra:  {Sprog_DB.csv}    
                FilType: {Tekst .csv} 
                Tegnsæt {UTF-8}  
                Sprog: {Dansk} 
                Fra række: {1}  
                Adskilt af: {komma} 
                Tekstskilletegn: {"}
 eller Indlæs:  {Sprog_DB.ods}
                Benyt copy/paste fra Google translate (en hel sprogkolonne ad gangen)
 Gem en kopi :  Filnavn {Sprog_DB}  (Benyttet af systemet: Sprog_DB.csv)
                FilType: {.csv} 
                Tegnsæt: {UTF-8} 
                Felt-Afgrænser: {,} 
                Tekst-Afgrænser: {"}  
                Flueben: {Gem cellens indhold som vist}   
                Flueben: {Sæt citationstegn i alle tekstceller}
 
 Farver, placeringer og tekststørrelser kan justeres centralt i CSS-fil.
 
 Systemet omfatter pt. følgende filer:
 page_LayoutModuler.php   - Demo af systemet
 out_javascr.js           - Systemets javascript
 out_style.php (.css)     - Systemets CSS
 out_base.php             - Systemets Modulære Grundsystem
 out_ruder.php            - Systemets Paneler med PROGRAM-moduler
 out_vinduer.php          - Systemets vinduer opbygget af flere Paneler
 user_interface.php       - Modulært Grundsystem
 frasescann.php           - Skanner efter fraser i alle projektfiler, men gemmer pt. kun dem i: user_interface.php og page_LayoutModuler.php
 Sprog_DB.csv             - Importfil, hvor alle sprogvarianter samles manuelt (copy/paste), med hjælp af Google-translate.
 
  */
  
  /*
HTML:
  <form class="pure-form">
    <fieldset>
        <legend>Confirm password with HTML5</legend>
        <input type="password" placeholder="Password" id="password" required>
        <input type="password" placeholder="Confirm Password" id="confirm_password" required>
        <button type="submit" class="pure-button pure-button-primary">Confirm</button>
    </fieldset>
  </form>

JS:
<script>
  var password = document.getElementById("password"), 
    confirm_password = document.getElementById("confirm_password");
  function validatePassword(){
    if(password.value != confirm_password.value) 
      {confirm_password.setCustomValidity("Passwords Don't Match"); } 
    else {confirm_password.setCustomValidity('');   }
  }
  password.onchange = validatePassword;
  confirm_password.onkeyup = validatePassword;
</script>
 */
?>
