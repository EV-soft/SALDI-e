<?php   $DocFil1= '../includes/out_base.php';    $DocVer1='5.0.0';    $DocRev1='2016-12-00';     $modulnr1=0; 
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
// page_*.php - Sider bestående af mange vinduer gemmes i filer med prefix: page_*.php f.eks.: page_Layoutdemo.php
// 
## NOTER:
// Disse filer er redigeret med tabulator sat til 2 tegn, og ses bedst med det.
// Fremover tilstræbes det at benytte SPACE i stedet for TAB.
// VIGTIGT: Kilde-filer skal gemmes i UTF-8 format uden BOM!  (for ikke konstant at konververe fra ANSI til UTF-8)
// class="lablInput" er et format, der kombinerer forskellige INPUT-felter med LABEL og Popup-TIP på lysblå baggrund.
// Givagt: Filnavne er følsomme overfor store/små bogstaver. For læsbarhed er første ord i et filnavn angivet med stort!
// f.eks: page_Kladdeliste.php. - PHP-rutiners navne er ufølsomme...
// StrengAdskiller: Primært benyttes '-tegnet som PHP-tekstafgrænser, og "-tegnet som HTML-tekstafgrænser.
//  Herved minimeres nødvendigheden af ESC-tegnet: \ og kildetekster bliver mere læsbare.
//  Eks.: echo '<input type= "hidden" id="'.$id.'" name="'.$name.'" value="'.$valu.'" />';

## REVISIONER:
// 2016.08.00 ev - EV-soft : 1. udgave af filen                                                     
                                                                                                    
// ***** Grundlæggende Rutiner for layout og visning af data ***************************************

## include("../_base/base_init.php");  // Skal kaldes forinden. (sker i htm_pageHead.php)
//if ($GLOBALS["Ødebug"]) debug_log($DocVer1,$DocRev1,$modulnr1,$DocFil1,'');

if (!function_exists('msg_Dialog')) {
  include('../includes/msg_lib.php');};  

if ($programSprog== NULL) {$programSprog= 'da';}
# $programSprog= 'en';  # da:Dansk  en:English  de:Deutsch  fr:Français   tr:Türkçe   es:Español

# BASISGRANUL:
function Lbl_Tip($lbl,$tip) { if ($lbl=='') return ''; else return '<div class="tooltip">'.ucfirst(tolk($lbl)).'<span class="tooltiptext">'.tolk($tip).'</span></div>';}

# BASISMODUL for data-visning, label, titelTip og input:
function htm_CombFelt($type='',$name='',$valu='',$titl='',$labl='',$revi=true,$rows='2',$width='',$step='',$more='') {global $ØblueColor;  # Inputfelt kombineret med label
  $LablTip= Lbl_Tip($labl,$titl); 
  $eventInvalid= 'oninvalid="this.setCustomValidity(\''.tolk('@Angiv ').$labl.'! '.'\')"';
  if (gettype($valu)== 'Float') $type= 'number' ; 
  if ($revi==true) $aktiv= ''; else $aktiv='disabled';
  if ($type== 'date') //  Firefox: supporterer ikke picker! men disse gør: Opera, Vivaldi, Chrome... (dec.2016)
    echo '<div class="lablInput"> <input type= "date" '.$more.' id="'.$name.'" name="'.$name.'" style="line-height:100%; font-size:smaller; height:14px;" value="'.$valu.
    '" placeholder="åååå-mm/dd"  '.$aktiv.' />  <label for="'.$name.'">'.$LablTip.'</label> </div>';
  if (($name=='posi') or ($name=='antal')) {$align= 'style="text-align:center";';} else $align= ''; //  smaller fordi browser input, er voldsomt bredt!

  if ($type== 'text') 
    echo '<div class="lablInput"> <input type= "text" '.$more.' width="'.$width.'" id="'.$name.'" name="'.$name.'" '.$align.' style="line-height:100%;" value="'.$valu.
    '" '.$eventInvalid.' '.$aktiv.' /> <label for="'.$name.'">'.$LablTip.'</label> </div>';
//  echo '<div class="lablInput"> <input type= "text" width="'.$width.'" id="'.$name.'" name="'.$name.'" '.$align.' style="line-height:100%;" value="'.$valu.
//  '"  '.$aktiv.' />  <label for="'.$name.'">'.$LablTip.'</label> </div> <script> $(this).addClass("filled"); </script>';
      
  if ($type== 'tal1d')  # Antal
    echo '<div class="lablInput"> <input type= "text" '.$more.' style="text-align:right; line-height:100%;" width="'.$width.'" id="'.$name.'" name="'.$name.
    '" value="'.number_format($valu*1,1,',','.').'";  '.$eventInvalid.' '.$aktiv.'  pattern="^\d*\.?((25)|(50)|(5)|(75)|(0)|(00))?$" /> <label for="'.$name.
    '">'.$LablTip.'</label> </div>';
  
  if ($type== 'tal2d')  # Beløb og %
    echo '<div class="lablInput"> <input type= "text" '.$more.' style="text-align:right; line-height:100%;" width="'.$width.'" id="'.$name.'" name="'.$name.
    '" value="'.number_format($valu*1,2,',','.').'";  '.$eventInvalid.' '.$aktiv.'  pattern="^\d*\.?((25)|(50)|(5)|(75)|(0)|(00))?$" /> <label for="'.$name.
    '">'.$LablTip.'</label> </div>';
  
  if ($type== 'tal2dc')  # Beløb og % - centerplaceret
    echo '<div class="lablInput"> <input type= "text" '.$more.' style="text-align:center; line-height:100%;" width="'.$width.'" id="'.$name.'" name="'.$name.
    '" value="'.number_format($valu*1,2,',','.').'";  '.$eventInvalid.' '.$aktiv.'  pattern="^\d*\.?((25)|(50)|(5)|(75)|(0)|(00))?$" /> <label for="'.$name.
    '">'.$LablTip.'</label> </div>';
  
  if ($type== 'number')   /* lang="en" for at tillade "."-tegn som decimal adskiller, foruden dansk ,-tegn */
    echo '<div class="lablInput"> <input type= "number" '.$more.' lang="en" style="text-align: right; line-height:100%;" width="'.$width.'" step="'.$step.'" id="'.$name.
    '" name="'.$name.'" value="'.$valu.'"; '.$eventInvalid.' '.$aktiv.' pattern="(\d{3})([\.])(\d{2})" />  <label for="'.$name.'">'.$LablTip.'</label> </div>';
    
  if ($type== 'numberL')   /* lang="en" for at tillade "."-tegn som decimal adskiller, foruden dansk ,-tegn */
    echo '<div class="lablInput"> <input type= "number" '.$more.' lang="en" style="text-align: left; line-height:100%;" width="'.$width.'" step="'.$step.'" id="'.$name.
    '" name="'.$name.'" value="'.$valu.'"; '.$eventInvalid.' '.$aktiv.' pattern="(\d{3})([\.])(\d{2})" />  <label for="'.$name.'">'.$LablTip.'</label> </div>';
    
  if ($type== 'radio')  // Skræddersyet !
    echo '<form action=""><div>&nbsp; <small>'.
    '<colrlabl>'.$LablTip.':</colrlabl >  '.
    '<input type= "radio" name="'.$name.'" value="privat"> '.   tolk('@Privat').
    ' &nbsp; <font style="color:'.$ØblueColor.'">'.                tolk('@eller').':</font>'.
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
    echo '<div class="lablInput"> <textarea rows="'.$rows.'" id="'.$name.'" style="line-height:100%" '.$eventInvalid.' '.$aktiv.$more.' >'.$valu.'</textarea>   <label for="'.$name.'">'.$LablTip.'</label> </div>  <br/>';
}

function htm_CombList($valu='',$titl='',$labl='',$liste) {global $ØblueColor;
  echo '<label style="color:'.$ØblueColor.'; font-weight:400; font-size:smaller"><colrlabl>'.Lbl_Tip($labl,$titl).'</colrlabl>'.  htm_SelectStr($valu,$liste); 
}


# BASISMODUL for checkbox:
function htm_CheckFlt($type='NotUsed',$name='',$valu='',$titl='',$labl='',$revi=true,$more='') {
  if ($revi==true) {$aktiv= ''; $colr='';} else {$aktiv='disabled'; $colr='#_$888888';};
  echo '&nbsp;<input type= "checkbox" name="'.$name.'" value="'.$valu.'"  '.$aktiv.' '.$more.'>   <label for="'.$name.'" style="color:'.$colr.';"  ><colrlabl>'.Lbl_Tip($labl,$titl).'</colrlabl> </label>  <br/>';
}

# BASISMODUL for <select> Element (option):
function htm_OptioFlt($type='NotUsed',$name='',$valu='',$titl='',$labl='',$revi=true,$optlist=array(),$action='',$events='') {global $ØblueColor;
  $eventInvalid= 'oninvalid="this.setCustomValidity(\''.tolk('@Vælg '.$labl.' på listen!').'\')"';
  if ($revi==true) {$aktiv= ''; $colr='';} else {$aktiv='disabled'; $colr='#_$888888';};
  #$array= array(['Fil i pdf-format','pdf','PDF-fil'],['Elektronisk forsendelse','email','email'],['Elektronisk fakturering','ioubl','OIOUBL'],['PBS faktura','pbs','PBS']);
  echo '<div class="lablInput">';
/*    echo ' <form action="'.$action.'">'; /* */    # required
    echo '<label style="color:'.$ØblueColor.'; font-weight:400; font-size:smaller"><colrlabl>'.Lbl_Tip($labl,$titl).'</colrlabl>'.
    ' <select class="styled-select" name='.$name.'  '.$events.' '.$eventInvalid.'> <option value="'.$valu.'" >'.Tolk('@Vælg!');  # title="'.$titl.'"     selected="'.$valu.'"
      foreach ($optlist as $rec) {    # $optlist= [0:Tip, 1:value, 2:Label, 3:Action]
        echo '<option value="'.$rec[1].'" title="'.tolk($rec[0]).'"'.$rec[3];
        if ($rec[1]==$valu) echo ' selected';
        echo '>'.$lbl=Tolk($rec[2]).'</option> ';
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
function htm_RadioGrp($type='vert',$name='',$titl='',$labl='',$optlist=array(),$action='') {global $ØblueColor;
  echo '<form action=""><div style="font-weight:400"><label style="color:'.$ØblueColor.'; font-size:small">'.Lbl_Tip($labl,$titl).'  </label>';
    foreach ($optlist as $rec) {if ($type=='vert') echo '<br>'; 
      echo '<input type= "radio" name="'.$name.'" value="'.$valu=$rec[0].'">'.
            $lbl= Tolk($rec[1]).' &nbsp; <font style="color:'.$ØblueColor.'">'.
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
 
function iconKnap ($faicon='',$title='',$link='') { global $ØButtnBgrd;
  $LablTip= '<div0 class="tooltip" style="margin: 1px 5px;"><span class="tooltiptext">'.$title.'</span></div0>';
  echo '<span>';
  echo '<a href="'.$link.'" '.$LablTip.' ';
  echo '  <ic class="fa '.$faicon.'" style="font-size:32px; color:'.$color=$ØButtnBgrd.';"></ic>';
  echo '</a></span>'; 
}
    
function textKnap ($label='',$title='',$link='') { global $ØButtnBgrd, $ØSaldiblue;
  if ($link=='../_base/page_Blindgyden.php') {$clr= '#AAAAAA'; $note=' <br> (En blindgyde endnu!)';} else {$clr= $ØSaldiblue; $note='';};
  $LablTip= '<div0 class="tooltip" style="color:'.$color= $clr.'; padding:5px; border:1px solid gray; box-shadow: 2px 2px 4px #888888;"><span class="tooltiptext">'.tolk($title).$note.'</span></div0>';
  echo '<span style="margin:6px; padding:6px; font-size:0.85em; color:'.$color=$ØSaldiblue.';"><a href="'.$link.'" '.$LablTip.' '.ucfirst(tolk($label)).'</a></span>';  
}

 
# BASISMODUL for tabel: 
# Visning af data - ingen redigering, udover oprettelse af ny record, og angivelse af filter.
# "RulleTabel" mellem fastlåst TabelTop og Bund, hvis tabellen er højere end $ViewHeight
# Mulighed for: Filtrering / Sortering / Recordvalg / NyRecord
# NyRecord, når $CreateRec=true
function htm_Tabel($RowLabl='',      # htm_TabelInp:  array([0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder])
                   $ColStyle=array(['@Kol0','7%','D','text','left','Tip',''],['...']), # Default! Rec-eksempel erstattes med aktuel parameter!
                   $TablData=array(),
                   $FilterOn=true,      # Default!
                   $SorterOn=false,     # Default!
                   $CreateRec=true,     # Default!
                   $ViewHeight='200px') # Default! erstattes af eventuel parameter.
{ global $ØButtnBgrd;
  $Capt1= '<b> '.tolk('@FILTER').'</b>: '.tolk('@Begræns visning i DATA-tabellen nedenfor, ved at angive søge-kriterier i felterne herunder:');
  $Capt2= '<b> '.tolk('@DATA:').'</b>';
//  if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,__FUNCTION__.':1');

### outputTabel med Filter:
  if ($FilterOn) {  ### Vis filter-felter:
    echo ' <tc>'.$Capt1.'</tc>';
    echo textKnap($label='@Vis det valgte', $title='@Vis det der matcher filteret', $link='../_base/page_Blindgyden.php').
         textKnap($label='@Vis alt',        $title='@Slet filter og vis alt',       $link='../_base/page_Blindgyden.php').  '<br>';
    echo '<div class="fixed-table-container" style= "max-height: '.$ViewHeight.';">';  //  <div class="header-background"> </div>';
    echo '<table cellspacing="0">';
    echo '<thead> <tr>';
      foreach ($ColStyle as $Specf) { echo '<th style="width:'.$Specf[1].';" title="'.tolk($Specf[5]).'"> <div class="extra-wrap"><div class="th-inner">'.ucfirst(tolk($Specf[0])).'</div></div> </th>';  }
    echo '</tr> <tr class="row">';
      for ($x= 0; $x < count($ColStyle); $x++) 
        {echo '<td><input type= "text" name="Kol'.$x.'" title="'.tolk('@Søg efter...').'" placeholder="...'.tolk('@Søg').'..." style="width:97%; padding-left:4px; background:#CCEDFE;" /></td> ';}
     echo '</tr></thead> </table> </div>';
  }

### outputTabel med data:
  if ($FilterOn) echo ' <tc>'.$Capt2.'</tc>';
  echo '<div class="fixed-table-container" style= "max-height: '.$ViewHeight.';">';  //   <div class="header-background"> </div>';
  echo '<div class="fixed-table-container-inner extrawrap" style= "max-height: '.$ViewHeight.';">';
  echo '<table cellspacing="0"> ';
  foreach ($ColStyle as $Specf) { echo '<col style="width:'.$Specf[1].'">'; }

  ### outputTabel Header med sortering?: 
  echo '<thead> <tr>';
  $SeltRow= '<div1 class="tooltip">⇒<span class="tooltiptext" style="bottom: -12px; left: 65px">'.tolk('@DETALJER: Klik her for at ').tolk($RowLabl).'.</span></div1>';
  $LablTip= '<div0 class="tooltip" style="padding:0;"><span class="tooltiptext">'.tolk('@Klik her for at ændre sortering af listen. - Kun dit sidste valg har virkning.').' </span></div0>';
  $Up= '↑&nbsp;'; $Dw= '&nbsp;↓'; $UpDw= '↑↓';  
  if (!$SorterOn) {$sortUp=''; $sortDw=''; $sortUpDw='';}
  else {$sortUp=   '<sorter onclick="this.style.color= \'red\'" '.$LablTip.$Up.  '</sorter>';    # ToDo: relevant onclick javascript skal udvikles!
        $sortDw=   '<sorter onclick="this.style.color= \'red\'" '.$LablTip.$Dw.  '</sorter>'; 
        $sortUpDw= '<sorter onclick="this.style.color= \'red\'" '.$LablTip.$UpDw.'</sorter>';} 

### KolHeader m. evt. Sorterings-valg:
  foreach ($ColStyle as $Specf) { echo '<th title="'.tolk($Specf[5]).'"> <div class="extra-wrap"><div class="th-inner">';
    if ($Specf[2]=='D') echo $sortDw; else if ($Specf[2]=='U') echo $sortUp; else echo $sortUpDw;
    echo ' '.ucfirst(tolk($Specf[0])).'</div></div> </th>';
  }
  echo '</tr> </thead>';
  
### Vis Data:  
  echo '<tbody>';
  if ($RowLabl=='@vælge denne post') $SeltRow= '';  //Ingen valg ved regnskab
  foreach ($TablData as $Row) { 
    $rowBg= RowDesign($Row,$RowLabl);
      echo '<tr class="row"; '.$rowBg.'>'; $x= 0;
      foreach ($Row as $Col) {$x++; 
      if ($x==1) echo '<td> '.$SeltRow.' '.$Col.' </td>'; 
      else echo '<td style= "text-align:'.$ColStyle[$x-1][4].';">'.$Col.'</td>';  }
    echo $genvej.'</tr>'; }
    
### Opret ny record:
    if ($CreateRec) {
    $x= 0;  foreach ($ColStyle as $Specf) { $x++; 
      echo '<td style="padding:0; vertical-align: bottom;">';
      if ($x==1) { $index= '9998+1'; 
      echo '<div1 class="tooltip" style="background:'.$ØButtnBgrd.'; color:white;">'.tolk('@Opret ny:').'<span class="tooltiptext" style="bottom: -12px; left: 65px">'.
        tolk('@Klik her, når du har udfyldt data-felterne på rækken herunder.').'</span></div1>'; 
      }  # else
      echo '<div style="margin-right: 2px;"> <input type= "'.$Specf[3].'" name="Kol'.$x.'" title="'.tolk($Specf[5]).
            '" placeholder="'.tolk($Specf[6]).'" style="text-align:left; width:98%; padding-left:4px; background-color:#fffa90;" /></div></td> ';
    }}
  echo '</tbody>  </table> </div> </div>';
}

function RowDesign (&$Row,$RowLabl) { //  global $genvej;
    $rowBg= '';    
    if (($RowLabl=='@redigere denne konto') or ($RowLabl=='@vælge denne post') or ($RowLabl=='')) { // Kontoplan/Regnskab/Budget: Design af rows
### Talformat:
      if (gettype($Row[5])=='double')  {$Row[5]= number_format($Row[5]*1, 2, ',', ' ');} else
### Baggrund afhængig af kontotype:
      if ($Row[2]=='H') {$Row[2]='';  for ($i= 4; $i < 18; $i++) { $Row[$i]='';}; $rowBg= 'style="background:white; font-weight: bold; vertical-align:bottom; height:2em;"'; } else
      if ($Row[2]=='D') {$Row[2]=tolk('@Drift' );     $rowBg= ''; } else
      if ($Row[2]=='S') {$Row[2]=tolk('@Status');     $rowBg= ''; } else
      if ($Row[2]=='Z') {$Row[2]=tolk('@Sum');        $Row[4].=' - '.$Row[0]; $Row[1].= '<br>'.$Row[2].': '.$Row[4].' (uden sum-beløb)'; $Row[2]='';  for ($i= 4; $i < 18; $i++) { $Row[$i]='';};
                            $rowBg= 'style="background:gray; color:white; vertical-align:top; height:2em;"';  } else  # 'Sum $row[fra_kto] - $row[til_kto]'
      if ($Row[2]=='R') {$Row[2]=tolk('@Resultat');   
      if ($Row[0]) $Row[4].= ' - '.$Row[0]; 
      $Row[1].= '<br>'.$Row[2].': '.$Row[4].' (uden sum-beløb)'; 
      $Row[2]=''; 
      for ($i= 4; $i < 18; $i++) { $Row[$i]='';};
                            $rowBg= 'style="background:green; color:white;"'; } else #   'Resultat = $row[fra_kto]'
      if ($Row[2]=='X') {$Row[1]=tolk('@Sideskift').' <br>'.tolk('@(Ovenfor:Driftkonti - Herunder:Statuskonti)');  $Row[2]='<br><br><br><br>'; for ($i= 4; $i < 18; $i++) { $Row[$i]='';}; $rowBg= 'style="background:yellow;"';  };
### Felter med værdi=0 vises blanke:
      if ($Row[4]=='0' ) {$Row[4]='';}     //  Fra_kto 0 vises BLANK
### Kursværdi=100 vises som DKK:
    //  if ($Row[6]==100) {$Row[6]='DKK';}  //  Kursværdi! 100 vist som DKK
      $genvej= '<td style= "text-align:center"> </td>';
    } else $genvej= '';
    return $rowBg;
}

if (!function_exists('MakeOptList')) {
function MakeOptList($valu,$optliste=[]) { if ($valu='') $valu= tolk('?...');
  echo '<td> <div style="margin-right:0; "> <select class="styled-select" name="liste"> <option value="'.$valu.'" title="'.tolk('@Vælg').'" >';
    foreach ($optliste as $rec) {
      echo '<option value="'.$rec[1].'" title="'.$rec[0].'"'.$rec[3];
        if ($rec[1]==$valu) echo ' selected';
      echo '>'.$lbl=$rec[2].'</option> ';
    }
  echo '</select></div></td> ';
}}

if (!function_exists('htmStrOptList')) {  # Optimering: Disse lister bør kunne oprettes 1 gang, kun ved opstart!
function htm_SelectStr($valu,$optliste=[]) {
  $Result= '<div style="margin-right:0; "> <select class="styled-select" name="liste"> <option value="'.$valu.'" title="'.tolk('@Vælg').'" >';
  foreach ($optliste as $rec) {
    $Result.= '<option value="'.$rec[1].'" title="'.$rec[0].'"'.$rec[3];
      if ($rec[1]==$valu) $Result.= ' selected';
    $Result.= '>'.$lbl=$rec[2].'</option> ';
  }
  $Result.= '</select></div> ';
  return($Result);
}}

function PauseKlovn($mess='Indlæser. Hæng på!') {
  echo '<div style="text-align:center;"><i class="fa fa-cog fa-spin fa-3x fa-fw" aria-hidden="true"></i><span class="sr-only">'.$mess.'</span></div>';
  echo '';
}
/* 
.fixed-table-container        { width: 80%;      border: 1px solid black;      margin: 10px auto;      background-color: white;  /* above is decorative or flexible * /
                                position: relative; /* could be absolute or relative * /  
                                padding-top: 30px;                                 /* height of header * / }
.fixed-table-container-inner  { overflow-x: hidden;      overflow-y: auto;      max-height: 200px; }
.header-background            { background-color: #D5ECFF;      height: 30px;      /* height of header * /   position: absolute;      top: 0;      right: 0;      left: 0; }
table                         { background-color: white;        width: 100%;    overflow-x: hidden;     overflow-y: auto; }
.th-inner                     { position: absolute; top: 0;     line-height: 30px; /* height of header * /      text-align: left;      border-left: 1px solid black;      padding-left: 5px;      margin-left: -5px; }
.first .th-inner              { border-left: none;  padding-left: 6px; }
      
<h2>Fixed Header Table using CSS</h2>
<div class="fixed-table-container">
      <div class="header-background"> </div>
      <div class="fixed-table-container-inner extrawrap">
        <table cellspacing="0">
          <thead>
            <tr>
              <th class="first">  <div class="extra-wrap"><div class="th-inner">First</div></div>                     </th>
              <th>                <div class="extra-wrap"><div class="th-inner second">Second and Longer</div></div>  </th>
              <th>                <div class="extra-wrap"><div class="th-inner">Third</div></div>                     </th>
            </tr>
          </thead>
          <tbody>
            <tr>  <td>First</td>  <td>First</td>                        <td>First</td>                  </tr>
            <tr>  <td>First</td>  <td>Second</td>                       <td>Third</td>                  </tr>
            <tr>  <td>First</td>  <td>Second this has longer content and so forth</td>  <td>Third</td>  </tr>
            <tr>  <td>First</td>  <td>Second</td>                       <td>Third</td>                  </tr>            
            <tr>  <td>First</td>  <td>Second this has longer content and so forth</td>  <td>Third</td>  </tr>
            <tr>  <td>First</td>  <td>Second</td>                       <td>Third slightly longer</td>  </tr>
            <tr>  <td>First</td>  <td>Second</td>                       <td>Third</td>                  </tr>
            <tr>  <td>First</td>  <td>Second this has longer content and so forth</td>  <td>Third</td>  </tr>
            <tr>  <td>First</td>  <td>Second</td>                       <td>Third slightly longer</td>  </tr>
          </tbody>
        </table>
      </div>
    </div>
 */
 
# Special-udg af: htm_TabelInp
function htm_TabelInp_Budget ( # $HeadLine= array([0:Labl, 1:Width, 2:Just, 3:InpType, 4:Tip, 5:placeholder])
      $HeadLine= array(['@Kladde notat:', '60%','left','text', '@Her kan skrives en bemærkning til kladden','@Angiv din tekst...']),
      $RowHead=  array(),      # Ubenyttet i denne funktion!
      $ColStyle= array(['@Kol0','7%','','','Tip',''],['@Kol1','10%','','','Tip','']), # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      $RowTail=  array(),      # Ubenyttet i denne funktion!
      &$DATA=    array(),
      $ViewHeight= '400px',
      $KaldFra= ''
      ) 
{ global $ØblueColor;
if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,__FUNCTION__.':1');
### "InfoFelter" over kolonne-labels:
      htm_FrstFelt( '5%',0); 
      htm_NextFelt('10%');  echo tolk('@Nyt budget:');  //  '@ +/- 0% OK', '@Pct. korrektion'
      htm_NextFelt('8%');   htm_CombFelt($type='number',  $name='pct', $valu= 0,   $titl='@Angiv en +/- pct-sats, som der skal justeres op/ned med', $labl='@% Korrektion',  $revi=true, $rows='2',$width='44px',$step='1');
      htm_NextFelt('75%');  echo textKnap($label='@Udfyld med korrektion af sidste års tal',  $title=tolk('@Automatisk budgetlægning på grundlag af sidste års regnskab!').
                            '<br>'.tolk('@ADVARSEL: Alle nuværende beløb overskrives!  Gem ikke, hvis det er en fejl.'),$link='../_base/page_Blindgyden.php');
      htm_LastFelt();    
  echo '<div class="fixed-table-container-inner " style= "max-height: '.$ViewHeight.';">';  //  Se mere her: https://codepen.io/chiranjeeb/pen/LGsiv
  echo '<table class="formnavi" cellspacing="0" style="border: 1px solid black;">';
  if (!function_exists('LblOut')) { function LblOut ($part1,$part2) {
    echo '<th style="font-size:small; width:'.$part1.'"> <div class="extra-wrap"><div class="th-inner-center" align="center">'.ucfirst($part2).'</div></div> </th>';}}
### Kolonne-LABELS:   FIXIT: Labels skal være statiske, ikke rulle med op i tabel-ruden! (som de ikke gør i htm_Tabel() ) Lbl_Tip/tooltiptext virker ikke (eller skjules?).
  echo '<thead><th>'; 
    foreach ($ColStyle as $Spec) LblOut($Spec[1], Lbl_Tip($Spec[0], $Spec[5]));
  echo '</th></thead>';
### Kolonne-DATA-INPUT:   
  echo'<tbody>  ';
  $optlist= FormVars(4); $ordlist= OrdrVars(4); $n= count($DATA); if ($n<1) $n= 20;
  $DatIx=-1;
    foreach ($DATA as $Dat) { $DatIx++;
      $rowBg= RowDesign($Dat,$RowLabl);
      echo '<tr class="row"; '.$rowBg.'>';
### Tabel-BODY:
      $ColIx= -1;                            # htm_TabelInp:  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
      foreach ($ColStyle as $Specf) {$ColIx++;  # htm_Tabel:  [0:ColLabl, 1:ColWidth, 2:ColJust,        3:InpType,             4:ColTip, 5:placeholder]
        if (is_array($Dat[$ColIx])) $DatFelt= $Dat[$ColIx][$DatIx]; else $DatFelt= $Dat[$ColIx];   //  Afhængig af array i 1 eller 2 dimensioner!
        if ($Specf[4]=='date') $smaller= 'text-align="left" width="70%" font-size="x-small" '; else $smaller= '';
        if ($Specf[4]=='vlst') {  # VariabelLister
          echo '<td> <div style="margin-right:0; font-size:x-small"> <select class="styled-select" name="liste"> <option value="" >-';
            foreach ($optlist as $rec) { echo '<option value="'.$rec[1].'" '.$rec[3];   if ($rec[1]==$valu) echo ' selected';   echo '>'.$lbl=$rec[2].'</option> '; }
          echo '</select></div></td> ';
        } 
        else  if ($Specf[4]=='just') { MakeOptList($valu,$optliste1=[['Venstrejusteret','V','V'],['Centerplaceret','C','C'],['Højrejusteret','H','H']]); } 
        else  if ($Specf[4]=='side') { MakeOptList($valu,$optliste2=[['Alle sider','A','A'],['Kun første side','1','1'],['Ikke første side','!1','!1'],['Kun sidste side','S','S'],['Ikke sidste side','!S','!S']]); } 
        else  if ($Specf[4]=='font') { MakeOptList($valu,$optliste3=[['sans-serif','Helvetica','Helvetica'],['serif','Times','Times'],['OptiskLæsbar','OCRbb12','OCRbb12']]); } 
        else  if ($Specf[4]=='data') {  # VariabelListe
          if ($DatFelt=='Nyt felt') { echo '<td style="font-size:small"> '.tolk('@Nyt felt:').' <div style="margin-right:0; font-size:x-small"> <select class="styled-select" name="liste"> <option value="" >-';
                                        foreach ($ordlist as $rec) { echo '<option value="'.$rec[1].'" '.$rec[3];   if ($rec[1]==$valu) echo ' selected';   echo '>'.$lbl=$rec[2].'</option> '; }
                                      echo '</select></div></td> ';
                                    } 
          else echo '<td style= "text-align:'.$Specf[2].'; font-size:small;">'.tolk($DatFelt).'</td>';  }   //  Kun TEXT
        else  # I alle andre tilfælde Standard: text m.fl.
          if ($rowBg>'')  echo '<td style= "text-align:'.$Specf[2].';">'.tolk($DatFelt).'</td>';   //  Kun TEXT
          else            echo '<td> <div style="margin-right:0;"> <input type= "'.$Specf[4].'" name="Kol'.$ColIx.'" '.'value="'. '" placeholder="'.tolk($Specf[6]).'" style="text-align:'.$Specf[2].'; background-color: transparent; width:100%;" /></div></td> ';
      };
      echo '</tr>';
    }
  echo '</tbody> </table> </div>';
} // htm_TabelInp_Budget


# BASISMODUL for tabelInput (Redigerbare data i tabel-celler):
function htm_TabelInp ( #$Capt1='', // $Capt* benyttes kun i htm_Tabel
                        #$Capt2='',     # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
                        $HeadLine= array('0','1','2','3','4','5'),
                        $RowHead= array(['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:disp!  ', '4:disp!   ', '5:ColTip', '6:disp!      '],['Næste record']), # Generel struktur!
                        $ColStyle=array(['0:ColLabl', '1:ColWidth', '2:ColJust:U/D/UD', '3:InpType', '4:FeltJust', '5:ColTip', '6:placeholder'],['Næste record']), # Generel struktur! 
                        $RowTail= array(['0:ColLabl', '1:ColWidth', '2:disp!         ', '3:InpType', '4:FeltJust', '5:ColTip', '6:value!     '],['Næste record']), # Generel struktur! 
                        &$DATA=array(),
                        $PadTop='26px'
                      ) { global $ØblueColor;
  echo '<div class="fixed-table-container" style="padding-top: '.$PadTop.'; ">';    # max-height: 150px;
  if ($HeadLine[0][0]>'') { # [0:Label, 1:Width, 2:Just, 3:Type, 4:TitleTip, 5:Value]
    echo '<div class="header-background" style="color:'.$ØblueColor.';"> &nbsp;';
      foreach ($HeadLine as $Capt) {
        if ($Capt[3]='show') $forskel= '" disabled value="'; else $forskel= '"    placeholder="';
        echo tolk($Capt[0]).' <input type= "'.$Capt[3].'" name="note" title="'.tolk($Capt[4]).$forskel.tolk($Capt[5]).'" style="width:'.$Capt[1].'; text-align:'.$Capt[2].';" />&nbsp;&nbsp;';
       }
    echo '</div>';
  }
  echo '<table class="formnavi" cellspacing="0">';
  
### Kolonne-LABELS:
  echo '<thead><tbody><tr> '; 
  foreach ($RowHead  as $Pref) {echo '<th style="width:'.$Pref[1].' align:'.$Pref[2].';"> <div class="extra-wrap"><div class="th-inner-center" align="center">'.Lbl_Tip($Pref[0],$Pref[5]).'</div></div> </th>';}
  foreach ($ColStyle as $Spec) {echo '<th style="width:'.$Spec[1].';"> <div class="extra-wrap"><div class="th-inner-center" align="center">'.Lbl_Tip($Spec[0],$Spec[5]).'</div></div> </th>';  }
  foreach ($RowTail  as $Suff) {echo '<th style="width:'.$Suff[1].' align:'.$Suff[4].';">'.Lbl_Tip($Suff[0],$Suff[5]).'</th>';}
  echo '</tbody></thead> </tr> ';
  
### Kolonne-DATA-INPUT:   
  echo' <tbody>  ';
  $optlist= FormVars(4); $ordlist= OrdrVars(4); $n= count($DATA); if ($n<1) $n= 20;
# for ($y= 0; $y < $n; $y++) { $x=0;  // DEMO-data. ToDo: Skal i stedet knyttes til &$DATA array()
  $DatIx=-1;
  foreach ($DATA as $Dat) { $DatIx++;
    echo '<tr class="row">';
    foreach ($RowHead  as $Pref) {echo '<td style="width:'.$Pref[1].'; text-align:'.$Pref[2].'">'.tolk($Pref[4]).' </td>';} 
### Tabel-BODY:
    $ColIx= -1;
    foreach ($ColStyle as $Specf) {$ColIx++;                # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      if (($Specf[3])=='date') {$smaller= 'text-align="left" width="70%" font-size="x-small" ';} else $smaller= '';
      switch ($Specf[3]) {  # Specielle InpTyper:
        case "vlst" : echo '<td> <div style="margin-right:0; font-size:x-small"> <select class="styled-select" name="liste"> <option value="" >-';
                        foreach ($optlist as $rec) { echo '<option value="'.$rec[1].'" '.$rec[3];   if ($rec[1]==$valu) echo ' selected';   echo '>'.$lbl=$rec[2].'</option> '; }
                      echo '</select></div></td> ';   break;
        case "moms" : echo '<td>'. htm_SelectStr($valu,MomsListe()).'</td>';  break;
        case "just" : echo '<td>'. htm_SelectStr($valu,JustListe()).'</td>';  break;
        case "side" : echo '<td>'. htm_SelectStr($valu,SideListe()).'</td>';  break;
        case "font" : echo '<td>'. htm_SelectStr($valu,FontListe()).'</td>';  break;
        case "kont" : echo '<td>'. htm_SelectStr($valu,KontListe()).'</td>';  break;
        case "valu" : echo '<td>'. htm_SelectStr($valu,ValuListe()).'</td>';  break;
        case "show" : echo '<td style="margin-right:0; text-align:'.$Specf[4].'; background-color: transparent;" />'.tolk($Dat[$ColIx]).'</td> ';  break;
        case "data" : if ($Dat[$ColIx][0]=='Nyt felt')  {  # Opret ny record
                        echo '<td> '.tolk('@Nyt felt:').' <div style="margin-right:0; font-size:x-small"> <select class="styled-select" name="liste"> <option value="" >-';
                          foreach ($ordlist as $rec) { echo '<option value="'.$rec[1].'" '.$rec[3];   if ($rec[1]==$valu) echo ' selected';   echo '>'.$lbl=$rec[2].'</option> '; }
                        echo '</select></div></td> ';
                      } else echo '<td> <div style="margin-right:0;"> <input type= "'.$Specf[3].'" name="Kol'.$ColIx.'" '.'value="'.tolk($Dat[$ColIx][0]).
                                    '" placeholder="'.tolk($Specf[6]).'" style="text-align:'.$Specf[4].'; background-color: transparent; width:100%;" /></div></td> ';
                      break;
        default     : echo '<td> <div style="margin-right:0;"> <input type= "'.$Specf[3].'" name="Kol'.$ColIx.'" '.'value="" '.
                          'placeholder="'.tolk($Specf[6]).   '" style="text-align:'.$Specf[4].'; background-color: transparent; width:100%;" /></div></td> ';
      }
    };
### RowTail: [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
  foreach ($RowTail as $felt) {echo '<td style="text-align:'.$felt[4].'; width:'.$felt[1].'; title:'.$felt[5].'">'.$felt[6].'</td>';}
    echo '</tr>';
  } # Ide: Mulighed for at vise kolonne-summer, eller andet, på en "footer-række" under tabellen.
  echo '</tbody> </table> </div>';
}

# LAYOUT moduler:
function htm_Rude_Top($name='',$capt='',$parms='',$icon='',$klasse='panelWmax',$func='Udefineret') {  # SKAL efterfølges af htm_RudeBund !
  global $Ødebug, $ØSaldiblue;
  if ($capt=='') $Ph= 'height:0;';
  echo '<form name="'.$name.'" id="'.$name.'" action="'.$parms.'" method="post">';
  if ($Ødebug) {$fn= '&nbsp; <small><small><small>f:'.$func.'()</small></small></small>';} else $fn='';
  echo '<div class="'.$klasse.'"> <div class="panelTitl" style="'.$Ph.'" max-width:400;>'.
    '<ic class="fa '.$icon.'" style="font-size:22px;color:'.$ØSaldiblue.'"></ic> &nbsp;'.ucfirst(Tolk($capt)).$fn.'</div>';
  if ($capt!='') echo '<hr class="style13" style="margin-bottom: 0"/>';
} # Boxens </div> og </form> er placeret i htm_RudeBund som skal kaldes til slut!

function htm_RudeBund($pmpt='',$subm=false,$title='') { # SKAL følge efter htm_Rude_Top !
  if ($subm==true) {  echo '<hr><div class="centrer">';   htm_accept($pmpt,$title); echo '</div>';  }
  echo '</div></form>';
}

function htm_accept($labl='',$title='',$width='') {global $ØButtnBgrd, $ØButtnText;
  if ($width) $width= ' width: '.$width.';';
  echo '<button type= "submit" name="submit" class="tooltip" style="margin: 1px 1px; padding: 1px 3px; '.$width.' background:'.$ØButtnBgrd.'; color:'.$ØButtnText.';" >'.
        ucfirst(tolk($labl)).'<span class="tooltiptext">'.tolk($title).'</span></button>';
}

# Felter i en horisontal række:
function htm_FrstFelt($wth,$bord=0) {echo '<TABLE BORDER="'.$bord.'"  border-collapse: collapse; padding: 0px; width:100%;><TR><TD width="'.$wth.'"> ';}
function htm_NextFelt($wth) {echo '</TD>  <TD style="width:'.$wth.';"> ';}
function htm_LastFelt()     {echo '</TD>  </TR> </TABLE>';}

function Head_Navigation ($sideObjekt, $status, $goPrev, $goHome=true, $goUp, $goFind, $goNew, $goNext) { # Genvejsknapper på siders top.
  $sideObjekt= tolk($sideObjekt);
  echo '<PanlHead>';
  htm_Rude_Top($name='naviform',$capt='',$parms='',$icon='','panelWmax',__FUNCTION__);
  echo '<div style="text-align: center"><img src= "../images/SALDIe50x150.png" alt="Saldi Logo" style="width:150px;height:50px;"></div>';
  echo '<p align="center"><b>'.tolk('@Navigation:').'<b></p>';
  echo '<p align="center">';  #<ic class="fa '.$icon.'" style="font-size:22px;color:green"></ic>
  if ($goPrev)  iconKnap($faicon='fa-caret-square-o-left',  $title= tolk('@Vis forrige')  .' '.$sideObjekt  ,$link='../_base/page_Blindgyden.php');
  if ($goHome)  iconKnap($faicon='fa-home',                 $title= tolk('@Luk vinduet og gå til hoved-menu')       ,$link='../_base/page_Gittermenu.php'.$goBack);
  if ($goUp  )  iconKnap($faicon='fa-caret-square-o-up',    $title= tolk('@Luk vinduet og gå et niveau op')         ,$link= $goBack);
  if ($goFind)  iconKnap($faicon='fa-search',               $title= tolk('@Søg en anden') .' '.$sideObjekt  ,$link='../_base/page_Blindgyden.php');
  if ($goNew )  iconKnap($faicon='fa-plus-square-o',        $title= tolk('@Opret ny')     .' '.$sideObjekt  ,$link='../_base/page_Blindgyden.php');
  if ($goNext)  iconKnap($faicon='fa-caret-square-o-right', $title= tolk('@Vis næste')    .' '.$sideObjekt  ,$link='../_base/page_Blindgyden.php');
  echo '</p>';
  if ($status) {
    $status= '<x1 style="font-weight:300; font-size:smaller"> - Status:<colrlabl> '.$status.'</colrlabl></x1>';
    echo '<p align="center">'.ucfirst($sideObjekt).$status.'</p> ';
  }
  htm_RudeBund($pmpt='@Gem',$subm=false,$title='@Gem');
  echo '</PanlHead>';
}

function Foot_Links ($maxi=false, $arg='', $doPrint, $doErase, $doLookUp, $doAccept, $doExport, $doImport,$OpslLabl='') { global $programSprog;
  htm_Rude_Top($name='linkform',$capt='',$parms='',$icon='','panelWmax',__FUNCTION__);
    if (($maxi) and ($OpslLabl>'')) echo '<p align="center"><b>'.tolk('@Handling:').'<b></p>';
    echo '<p align="center">';  #<ic class="fa '.$icon.'" style="font-size:22px;color:green"></ic>
    if ($doPrint)   iconKnap($faicon='fa-print',                $title= tolk('@Udskriv')  .' '.$sideObjekt  ,$link='../_base/page_Blindgyden.php');
    if ($doErase)   iconKnap($faicon='fa-minus-square-o',       $title= tolk('@Slet posten')                ,$link='../_base/page_Blindgyden.php'.$goBack);
    if ($doLookUp)  iconKnap($faicon='fa-search-plus',          $title= '? '.tolk($OpslLabl)                     ,$link='../_base/page_Blindgyden.php');
    if ($doAccept)  iconKnap($faicon='fa-check-square-o',       $title= tolk('@Godkend alt')  .' '.$sideObjekt  ,$link='../_base/page_Blindgyden.php');
    if ($doExport)  iconKnap($faicon='fa-upload',               $title= tolk('@CSV-Export')   .' '.$sideObjekt  ,$link='../_base/page_Blindgyden.php');
    if ($doImport)  iconKnap($faicon='fa-download',             $title= tolk('@Fil import')   .' '.$sideObjekt  ,$link='../_base/page_Blindgyden.php');
    echo '</p>';
    if ($maxi) {    
      htm_FrstFelt('10%',0);  
      htm_NextFelt('30%');    echo '<div style="display:inline-block; margin-left:1em; align:center">'.SprogValg($programSprog).'</div> ';
      htm_NextFelt('25%');    echo '<div style="display:inline-block; margin-left:1em; align:center">'.$arg.'</div> ';
      htm_NextFelt('30%');    echo '<div style="display:inline-block; margin-left:1em>'.htm_accept('@Log ud','@Forlad SALDI').'</div> ';
      htm_NextFelt('05%');    # Vare-opslag, Udskriv, Fakturer, Slet vist post, 
      htm_LastFelt();
      echo '<table><tr><td><tc><divline style="margin-left:0.5em"><small><b>'.tolk('@TIP:').'</b> '.tolk('@Hold musen over').' <colrlabl>'.tolk('@Blå tekster med skyggeramme, ').'</colrlabl>'.
        tolk('@så får du hjælpetekster og tips.').'</small></tc></td><td style="text-align:right;"><small>Design: EV-soft </small></divline></td></tr></table>';
    }
  htm_RudeBund($pmpt='@Gem',$subm=false,$title='@Gem');
}

# SPALTER OG PANELER:

function SpalteTop ($w=240) {echo '<PanlHead> <div id="wrapper"> <column id="spalt'.$w.'">'; } // SpalteTop spalt240, spalt320 (erkl. i Out_style.css.php)
function NextSpalte($w=320) {echo '</column> <column id="spalt'.$w.'">'; }            // SpalteBund/SpalteTop
function SpalteBund() {echo '</column> </div> </PanlHead><div class="clearWrap"/>'; } // erstatter EndSpalter
// Udfases:
  function Spalte240($w=240)  {echo '<PanlHead> <div id="wrapper"> <column id="spalt'.$w.'">'; } // erstattes af SpalteTop(240); 
  function Spalte320($w=320)  {echo '<PanlHead> <div id="wrapper"> <column id="spalt'.$w.'">'; } // erstattes af SpalteTop(320); 
  function EndSpalter() {echo '</column> </div> </PanlHead><div class="clearWrap"/>'; } // SpalteBund

function panelStart() {echo '<PanlFoot>';}
function panelSlut()  {echo '</PanlFoot>';}
function skilleLin () {echo '<hr size="10" color="#AA4D00">';}

# SUPPLERENDE moduler:


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
 if (substr($FraseKey.' ',0,1)!='@') {return($FraseKey); break;}  # Kan være tolket tidligere!
 if (($programSprog) and ($languageTable))    
  switch ($programSprog=strtolower($programSprog)) {    # 0 Key             
    case "da" :$result= trim($FraseKey,'@');  break;    # 1 Dansk          da: Vis frasen uden prefix
    case "en" :$ix= 2;  break;                          # 2 Engelsk        sæt index for opslag
    case "de" :$ix= 3;  break;                          # 3 Deutsch        sæt index for opslag
    case "fr" :$ix= 4;  break;                          # 4 Français       sæt index for opslag
    case "tr" :$ix= 5;  break;                          # 5 Türkçe         sæt index for opslag
    case "es" :$ix= 6;  break;                          # 6 Español        sæt index for opslag
                                                        # 7 Grønlandsk       
    default   : {$ix= 1; echo "<colrlabl>Sprog?:".$programSprog." </colrlabl>"; break;}
  }
  $TblRow= found_index($languageTable, 0, $FraseKey);
  if (substr($FraseKey,0,2)=='@:') {};                                    # Er frasen med @:-prefix: (Angår blanketter/formularer)
  if (substr($FraseKey,0,1)=='@')                                         # Er frasen med @-prefix:
       {if ($programSprog=='da')  {$result= trim($FraseKey,'@');}         #   Er sproget dansk fjernes @-prefix blot i resultatet
        else if ($TblRow>0) {$result= $languageTable[$TblRow][$ix];}      #   ellers slås op i sprogtabellen
        else {$result= $FraseKey.'<small><small> (Danish!)</small></small>'; $MissingFrase.='<br>'.$FraseKey;} # Oversættelse mangler: Vis $FraseKey  med @-prefix
       }  
  else {$result= $FraseKey;}                                              # Fraser uden @-prefix returneres uændret.
  return($result);
} 
// PLAN: Opdeling så fraser ang. blanketter, holdes adskilt fra programfladens fraser, f.eks. med prefix: @:
//	eller de håndteres i DB-tabeller.

# OBS!  Benyt konsekvent prefix: '@ ikke: "@ så alle fraser kan udtrækkes automatisk!
# Oversættelsen sker automatisk i BASISMODULER med tolk(), når parametre behandles.
# I sjældne tilfælde (lange eller sammensatte tekster), er det nødvendigt at benytte tolk() lokalt.
# Undgå forkortelser og sammensatte ord, som kan forringe oversættelse og liniewrap.
# Undgå indledende og afsluttende SPACE, og <HTML> koder i fraser. Benyt @@ hvis en frase skal starte med @
# Undgå SPACE+SPACE som vil blive ændret til SPACE, og bringe uorden i frasens længde.
# Tegnet: " må ikke forekomme i fraser, det korrumperer csv-formatet. Benyt f.eks. ' i stedet.
//////////////////////////////////////////////////////////////////////////////////////////////////////////


function htm_HiddVari($name='',$val='') {
	if ($val=='') {$val= $name;	 global $$val; $valu= $$val; } else $valu= $val;
	echo "\n<input type='hidden' name='$name' value='$valu'>";
}


  
  
global $Ø_MdrList;
$Ø_MdrList= DanListe($mdr, ' '.tolk('@måned'));


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
 page_Layoutdemo.php   - Demo af systemet
 out_javascr.js           - Systemets javascript
 out_style.php (.css)     - Systemets CSS
 out_base.php             - Systemets Modulære Grundsystem
 out_ruder.php            - Systemets Paneler med PROGRAM-moduler
 out_vinduer.php          - Systemets vinduer opbygget af flere Paneler
 user_interface.php       - Modulært Grundsystem
 frasescann.php           - Skanner efter fraser i alle projektfiler, men gemmer pt. kun dem i: user_interface.php og page_Layoutdemo.php
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
