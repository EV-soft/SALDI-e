<?php   $DocFil1='../_base/out_base.php';    $DocVer1='5.0.0';    $DocRev1='2018-03-00';     $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Grundbibliotek for kontruktion af moduler, angaaende udskrivning til skaerm. ';
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2018 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 * ## LICENS:  (indføjes når filen er "færdig" og anvendelig i SALDI-systemet.)
 * Dette program er fri software. Du kan gendistribuere det og / eller modificere det under
 * betingelserne i GNU General Public License (GPL), som er udgivet af The Free Software Foundation;
 * enten i version 2 af denne licens eller en senere version efter eget valg.     
 * Fra og med version 3.2.2 dog under iagttagelse af følgende:                    
 * Programmet må ikke uden forudgående skriftlig aftale anvendes i konkurrence med
 * Saldi.dk ApS eller anden rettighedshaver til programmet.                          
 * Programmet er udgivet med håb om at det vil være til gavn, men UDEN NOGEN FORM FOR
 * REKLAMATIONSRET ELLER GARANTI. Se GNU General Public Licensen for flere detaljer. 
 * En dansk oversaettelse af licensen kan læses her:  http://www.saldi.dk/dok/GNU_GPL_v2.html
 * 
 * Copyright (c) 2004-2018 Saldi.dk ApS 
 * ----------------------------------------------------------------------
  Oprettet: 2016-08-00 evs - EV-soft   #: Dette bibliotek er udviklet 2016-1018 af EV-soft.
  Ændrings-Log:
      

 * ## AFHÆNGIGHED:
 * out_base.php er afhængig af: out_init.php og out_style.css.php
 * page_*.php er afhængig af: htm_pagePrepare.php og htm_pageFinalize.php
 * 
 * ## Benyttede prefixer i fil-navne:
 * htm_*.php  - Grundmoduler (htm_*) egnet for adaptive skærm-output.
 * out_*.php  - Modulerne benyttes KUN i out_ruder.php, hvor system-paneler (ruder) opbygges.
 * out_*.php  - Ruder spalte-opsættes efterfølgende i out_vinduer.php, som er de vinduer brugeren oplever. 
 * page_*.php - Sider bestående af et eller mange vinduer gemmes i filer med prefix: page_*.php f.eks.: page_Layoutdemo.php
 * save_*.php - Filer som overfører data til/fra database.
 * ini_*  - Initiering af Database, konstander og variabler
 * fil_*  - Fil-funktioner
 * dbi_*  - DataBase-funktioner
 * spc_*  - Specielle funktioner
 * 
 * ## Andre benyttede prefixer i funktions-navne:
 * dvl_*  - Develop-system
 * msg_*  - Message-system
 * Rude_* - Panel i spaltesystem
 * Lbl_*  - Label i input-system
 * str_*  - String-funktion
 * 
 * ## INFO om kommentarer:
 *  ##  Permanent kommentar til forklaring af funtionalitet:
 *  ##+ benyttes til midlertidig udkommentering. Kode som er nødvendig, men sat ud af kraft.
 *  ##- benyttes til permanent udkommentering. Kode som sandsynligvis ikke skal benyttes.
 * 
 * 
 * ## VIGTIGT: 
 * Kilde-filer skal gemmes i UTF-8 format uden BOM!  (for ikke konstant at konvertere fra ANSI til UTF-8)
 * Givagt: Filnavne er følsomme overfor store/små bogstaver. 
 *   For øget læsbarhed er første ord (efter prefix) i et filnavn angivet med stort!
 *   f.eks: page_Kladdeliste.php. - PHP-rutiners navne er ufølsomme...
 *
 * ## NOTER:
 * Disse filer er redigeret med tabulator sat til 2 tegn, og ses bedst med det.
 * Fremover tilstræbes det at benytte 2*SPACE i stedet for TAB, som ikke kan justeres på Github.
 *
 * StrengAdskiller: Primært benyttes '-tegnet som PHP-tekstafgrænser, og "-tegnet som HTML-tekstafgrænser.
 *   Herved minimeres nødvendigheden af ESC-tegnet: \ og kildetekster bliver mere læsbare.
 *   Eks.: echo '<input type= "hidden" id= "'.$id.'" name= "'.$name.'" value= "'.$valu.'" />';
 *
 * Af hensyn til søg/erstat mulighed, tilstræbes det at benytte "separatorer" og SPACE således: 
 *   $variabel= ['x', 'y', 'z']; dvs. Ingen SPACE foran og en SPACE efter separator/operator. Ikke paranteser.
 *   Kun i lange sekvenser udelades SPACE efter separator/operator.
 *
 * Funktions-parametre:
 *   Variabelnavne kan udelades i funktions-parametre, men er medtaget for tydeliggørelse, for andre end forfatteren.
 *   Ofte er alle variabler angivet, selvom default-værdier benyttes. Også dette er af hensyn til andres forståelse af koden.
 *   Eks: htm_OptioFlt($type='text', $name='name', $valu='Leverandør', $labl='@Leverandør', $titl='@Leverandør', $revi=true, $optlist=[], $action='onchange="getComboA(this)"');
 *   Kunne simplificeres
 *   til: htm_OptioFlt('text', 'name', 'Leverandør', '@Leverandør', '@Leverandør'); --- hvis $revi og flg. er tildelt standardværdier.
 *
 * Repeter jævnligt disse regler, og efterlev dem, så der opnås ensartethed i kildefilerne!!!
 * Se også nyttige noter i starten af ../_base/out_init.php
 *
 * ## REVISIONER:
 * 2016.08.00 evs - EV-soft : 1. udgave af filen                                                     
                                                                                                    
 * ***** Grundlæggende Rutiner for layout og visning af data ***************************************

 * ## include "../_base/out_init.php";  // Skal kaldes forinden. (sker i htm_pagePrepare.php)
 * if ($GLOBALS["$Ødebug"]) debug_log($DocVer1,$DocRev1,$modulnr1,$DocFil1,'');
 * echo "\n<!-- $DocVer1  $DocRev1  $modulnr1  $DocFil1 -->\n";
 */

if ($GLOBALS["$Ødebug"]) debug_log($DocVer1,$DocRev1,$modulnr1,$DocFil1,'');

global $ØProgRoot, $ØHeaderFont;

$currDir= dirname(__FILE__).'/';

if (!function_exists('msg_Dialog')) {
//  include $ØProgRoot.$_base.'msg_lib.php';};  
  include_once $ØProgRoot.'_base/msg_lib.php';
};  

  
  
# dvl ~ DEVELOP - Rutiner til fejlfinding:
if (!function_exists('dvl_pretty')) {
  function dvl_pretty($testlabl='') {
  global $Ødebug;    // Indsæt linieskift og evt. label, i den dannede html-kode, så kildekode bliver mere læsbar
  if ($Ødebug) { echo "\n"; if ($testlabl>'') echo '<!-- '.$testlabl.': -->'."\n"; return "\n"; }
}}

if (!function_exists('dvl_ekko')) {
function dvl_ekko($testlabl='') { 
  global $Ødebug;     // Fejlfindings system - ekstra labels indføjes i html-kildekode
  if (($Ødebug) and ($testlabl>'')) {echo "<br>". $testlabl. "\n";}
}}


 if (!function_exists('Lbl_Tip')) 
{ // Start på gruppe af functions erklæringer:  Forebyg gentagne læsninger!

# BASISGRANUL:
function Lbl_Tip($lbl,$tip,$plc='',$h='13px') { 
  if ($lbl=='') return ''; 
  else {
    dvl_pretty('Lbl_Tip');
    if ($h=='0px') {$h='';}
    switch (strtoupper($plc)) {
      case "W":  $class= 'tooltipL';  break;    # Plac. TV
      case "S":  $class= 'tooltipB';  break;    # Plac. Under
      case "O":  $class= 'tooltipR';  break;    # Plac. TH
      case "N":  $class= 'tooltipT';  break;    # Plac. Over
      case "NW": $class= 'tooltipB0'; break;    # Plac. Retning NW
      case "SW": $class= 'tooltipB1'; break;    # Plac. Retning SW
      case "SO": $class= 'tooltipB2'; break;    # Plac. Retning SØ
      default :  $class= 'tooltiptext'; # Plac. Over
    }
    if (strlen($tip)<140) {$wdth='';} else {$wdth='style ="min-width: 380px;"';}
    return '<div class="tooltip" style="heightxxx:'.$h.';">'.ucfirst(tolk($lbl).' ').'<span class="'.$class.'" '.$wdth.'>'.tolk($tip).'</span></div>';
  //  return 'TESST';
  }
}

# BASISMODUL for data-visning, label, titelTip og input:     ($more giver mulighed for at benytte parametre, som ikke er forud defineret. f.eks: 'min="-99" max="99"') // Ændret rækkefølge: $labl ,$titl
function htm_CombFelt($type='',$name='',$valu='',$labl='',$titl='',$revi=true,$rows='2',$width='',$step='',$more='',$plho='')   # Inputfelt kombineret med label
{global $ØblueColor;
  dvl_pretty('htm_CombFelt');
  $LablTip= Lbl_Tip($labl,$titl); 
  $eventInvalid= 'oninvalid="this.setCustomValidity(\''.tolk('@Angiv ').tolk($labl).'! '.'\')"';
  if (gettype($valu)== 'Float') $type= 'number' ; 
  if ($revi==true) $aktiv= ''; else $aktiv='disabled';
  if ($plho!='') $plh=' placeholder="'.$plho.'"'; else $plh='';
  if ($type== 'date') //  Firefox: supporterer ikke picker! men disse gør: Opera, Vivaldi, Chrome... (dec.2016)
    echo '<div class="lablInput"> <input type= "date" '.$more.' id="'.$name.'" name="'.$name.'" style="line-height:100%; font-size:smaller; height:14px;" value="'.$valu.
    '" placeholder="yyyy-mm-dd"  '.$aktiv.' />  <label for="'.$name.'">'.$LablTip.'</label> </div>';
  if ($type== 'time')
    echo '<div class="lablInput"> <input type= "number" '.$more.' style="text-align: center; step="'.$step.'" id="'.$name.'" name="'.$name.
        '" style="line-height:100%; font-size:smaller; height:14px;" value="'.$valu.'" '.$aktiv.' />  <label for="'.$name.'">'.$LablTip.'</label> </div>';
  if (($name=='posi') or ($name=='antal')or ($name=='varenumr')) 
    {$align= 'style="text-align:center"';} else $align= ''; //  smaller fordi browser input, er voldsomt bredt!

  if ($type== 'text') 
    echo '<div class="lablInput"> <input type= "text" '.$more.' width="'.$width.'" id="'.$name.'" name="'.$name.'" '.$align.' style="line-height:100%; " value="'.$valu.
    '" '.$eventInvalid.' '.$aktiv.$plh.' /> <label for="'.$name.'">'.$LablTip.'</label> </div>';
      
  if ($type== 'tal1d')  # Antal
    echo '<div class="lablInput"> <input type= "text" '.$more.' style="text-align:right; line-height:100%;" width="'.$width.'" id="'.$name.'" name="'.$name.
    '" value="'.number_format($valu*1,1,',','.').'"  '.$eventInvalid.' '.$aktiv.$plh.'  pattern="^\d*\.?((25)|(50)|(5)|(75)|(0)|(00))?$" /> <label for="'.$name.
    '">'.$LablTip.'</label> </div>';
  
  if ($type== 'tal2d')  # Beløb og %
    echo '<div class="lablInput"> <input type= "text" '.$more.' style="text-align:right; line-height:100%;" width="'.$width.'" id="'.$name.'" name="'.$name.
    '" value="'.number_format($valu*1,2,',','.').'"  '.$eventInvalid.' '.$aktiv.$plh.'  pattern="^\d*\.?((25)|(50)|(5)|(75)|(0)|(00))?$" /> <label for="'.$name.
    '">'.$LablTip.'</label> </div>';
  
  if ($type== 'tal2dc')  # Beløb og % - centerplaceret
    echo '<div class="lablInput"> <input type= "text" '.$more.' style="text-align:center; line-height:100%;" width="'.$width.'" id="'.$name.'" name="'.$name.
    '" value="'.number_format($valu*1,2,',','.').'"  '.$eventInvalid.' '.$aktiv.$plh.'  pattern="^\d*\.?((25)|(50)|(5)|(75)|(0)|(00))?$" /> <label for="'.$name.
    '">'.$LablTip.'</label> </div>';
  
  if ($type== 'number')   /* lang="en" for at tillade "."-tegn som decimal adskiller, foruden dansk ,-tegn */
    echo '<div class="lablInput"> <input type="number" '.$more.' lang="en" style="text-align:right; line-height:100%;" width="'.$width.'px" step="'.$step.'" id="'.$name.
    '" name="'.$name.'" value="'.$valu.'" '.$eventInvalid.' '.$aktiv.$plh.' pattern="(\d{3})([\.])(\d{2})" />  <label for="'.$name.'">'.$LablTip.'</label> </div>';
    
  if ($type== 'numberL')  # Beløb og % - venstreplaceret /* lang="en" for at tillade "."-tegn som decimal adskiller, foruden dansk ,-tegn */
    echo '<div class="lablInput" style="width:'.$width.'; display:inline-block; height:1.5em;"> <input type= "number" '.$more.' lang="en" style="text-align:left; line-height:100%;" step="'.$step.'" id="'.$name.
    '" name="'.$name.'" value="'.$valu.'" '.$eventInvalid.' '.$aktiv.$plh.' pattern="(\d{3})([\.])(\d{2})" />  <label for="'.$name.'">'.$LablTip.'</label> </div>';
    
  if ($type== 'barc') 
    echo '<div class="lablInput"> <input type= "text" '.$more.' width="'.$width.'" id="'.$name.'" name="'.$name.'" '.$align.' style="font-family:barcode; font-size:20px; text-align:center; line-height:100%; " value="'.$valu.
    '" '.$eventInvalid.' '.$aktiv.$plh.' /> <label for="'.$name.'">'.$LablTip.'</label> </div>';  //  <font style="font-family:barcode; font-size:32px;">*STREGKODE*</font>
      
  if ($type== 'radio')  // Skræddersyet !
    echo '<form action=""><div>&nbsp; <small>'. // Nestet form!
    '<colrlabl>'.$LablTip.':</colrlabl >  '.
    '<input type= "radio" name="'.$name.'" value="privat"> '.   tolk('@Privat').
    ' &nbsp; <font style="color:'.$ØblueColor.'">'.             tolk('@eller').':</font>'.
    '<input type= "radio" name="'.$name.'" value="erhverv"> '.  tolk('@Erhverv').
    '</small></div> </form>';

  if ($type== 'password') 
    echo '<div class="lablInput"> <input type= "password" '.$more.' width="'.$width.'" id="'.$name.'" name="'.$name.'" style="line-height:100%;" value="'.$valu.'" '
      .$eventInvalid.' '.$aktiv.$plh.' /> <label for="'.$name.'">'.$LablTip.'</label> </div>';
  
  if ($type== 'passwordpower')  {   # PW med styrke måling:
    echo '<section><div class="lablInput">  '.
//    '<fieldset class="js-password-fieldset">'.
      '<input type= "password" '.$more.' width="'.$width.'" id= "password-strength-code" name="'.$name.'" style="line-height:100%;" value="'.$valu.'"  '.
      $eventInvalid.' '.$aktiv.$plh.' />'.
//      '</fieldset>'.
      ' <label for="'.$name.'">'.$LablTip.'</label> </div>';
    echo '<meter max="4" id="password-strength-meter" title="Password Styrke måler: 5 niveauer"></meter>'.
         '<feedback id="password-strength-text" title="Feedback til det angivne password"></feedback></section>';
    }
    
  if ($type== 'mail') 
    echo '<div class="lablInput"> <input type= "email" '.$more.' id="'.$name.'" name="'.$name.'" value="'.$valu.'"  '.$eventInvalid.
  ' '.$aktiv.$plh.' /> <label for="'.$name.'">'.$LablTip.'</label> </div>';
  
  if ($type== 'hidden') 
    echo '<input type= "hidden" id="'.$name.'" name="'.$name.'" value="'.$valu.'" />';
  
  if ($type== 'area') 
    echo '<div class="lablInput"> <textarea rows="'.$rows.'" id="'.$name.'" style="line-height:100%;" '.$eventInvalid.
  ' '.$aktiv.$plh.' '.$more.' >'.$valu.'</textarea>   <label for="'.$name.'">'.$LablTip.'</label> </div>  <br/>';
  dvl_pretty();
}

function htm_CombList($name='ListName',$valu='',$labl='',$titl='',$liste,$more='') {global $ØblueColor; 
  echo '<label style="color:'.$ØblueColor.'; font-weight:400; font-size:smaller"><colrlabl>'.Lbl_Tip($labl,$titl).'</colrlabl>'.  htm_SelectStr($name,$valu,$liste,$more); 
}


# BASISMODUL for checkbox:
function htm_CheckFlt($type='Fixed',$name='checkboxName',$valu='',$labl='',$titl='',$revi=true,$more='',$nl='<br/>') {
  if ($revi==true) {$aktiv= ''; $colr='';}  else {$aktiv='disabled'; $colr='#_$888888';};   //  readonly kan evt. angives i $more
  if ($valu==true) {$valu= 'checked'; } else {$valu=''; };
  dvl_pretty('htm_CheckFlt');
  echo '&nbsp;<input type= "checkbox" name="'.$name.'" value="" '.$valu.' '.$aktiv.' '.$more.'>'.
       '<label for="'.$name.'" style="color:'.$colr.'; ">';     dvl_pretty('htm_CheckFlt');
  echo '<colrlabl>'.Lbl_Tip($labl,$titl).'</colrlabl> </label> '.$nl;
  if (isset($_POST[$name])) return($_POST[$name]);
  dvl_pretty();
}
# SPECMODUL: statusvisning
function htm_StatsFlt($type='UnUsed',$name='UnUsed',$valu='',$labl='',$titl='',$nl='') {
  if ($valu) {$str= htm_DingBat('2714','green'); $title= tolk('@Testet OK');}
  else       {$str= htm_DingBat('2753','red').htm_DingBat('2757','red'); $title= tolk('@Her kan være et problem');};   //  htm_DingBat('2796','red')
  if ($titl=='') $titl= $title;
  dvl_pretty('htm_StatusFlt');
  echo '&nbsp;<xx name="'.$name.'" >'.
       '<label for="'.$name.'" title="'.$title.'">'.$str.'<colrlabl>'.Lbl_Tip($labl,$titl).'</colrlabl> </label> '.$nl;
  dvl_pretty();
}

function htm_DingBat($hex,$clr='black') {
  echo '<big style="color:'.$clr.'; background:#EEEEEE">&#x'.$hex.';</big>';
}

# BASISMODUL for <select> Element (option):
function htm_OptioFlt($type='UnUsed',$name='',$valu='',$labl='',$titl='',$revi=true,$optlist=array(),$action='',$events='',$maxwd='300px') {
  global $ØblueColor;
  $eventInvalid= 'oninvalid="this.setCustomValidity(\''.tolk('@Vælg '.$labl.' på listen!').'\')"';
  if ($revi==true) {$aktiv= ''; $colr='';} else {$aktiv=' disabled'; $colr='color:#888888;';};
  #$array= array(['Fil i pdf-format','pdf','PDF-fil'],['Elektronisk forsendelse','email','email'],['Elektronisk fakturering','ioubl','OIOUBL'],['PBS faktura','pbs','PBS']);
 # echo  '<form><!-- this is a dummy --></form> ';
  echo '<div class="lablInput">';
    dvl_pretty('htm_OptioFlt');
#+    echo ' <form action="'.$action.'">';   # required  // Nestet form!
    echo '<label style="color:'.$ØblueColor.'; font-weight:400; font-size:smaller"><colrlabl>'.Lbl_Tip($labl,$titl).'</colrlabl>'.
    ' <select class="styled-select"  name="'.$name.'" '.$events.' '.$eventInvalid.' style="max-width: '.$maxwd.'; '.$colr.'" '.$aktiv.'> <option value="'.$valu.'" >'.Tolk('@Vælg!');  # title="'.$titl.'"     selected="'.$valu.'"
      foreach ($optlist as $rec) {    # $optlist= [0:Tip, 1:value, 2:Label, 3:Action]
        dvl_pretty();
        echo '<option value="'.$rec[1].'" title="'.tolk($rec[0]).'" '.$rec[3];
        if ($rec[1]==$valu) echo ' selected';
        echo '>'.$lbl=Tolk($rec[2]).'</option> ';
        }
    echo '</select>&nbsp;&nbsp;&nbsp;</label>';
    //  $rec[3] kan indeholde hændelse
//    if ($action)
//    echo '<input type= "submit" id="Button1" name="submit" value="'.tolk('@Benyt').'"  title= "@Aktiver valget" style="position:absolute;left:70%;top:5px;width:50px;height:22px;z-index:6;">';
#+  echo '</form>';
  dvl_pretty();
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
function htm_RadioGrp($type='vert',$name='',$labl='',$titl='',$optlist=array(),$action='') {global $ØblueColor,$ØbrwnColor; // Ændret rækkefølge: $labl ,$titl
  dvl_pretty('htm_RadioGrp');
  echo '<form action="'.$action.'"><div style="font-weight:400"><label style="color:'.$ØblueColor.'; font-size:small">'.
                                       Lbl_Tip($labl,$titl).'  </label>'; // Risiko for nestet form!
    foreach ($optlist as $rec) {
      if ($type=='vert') echo '<br>'; 
      if ($rec[3]) {$valgt= 'checked';} else $valgt= '';
      dvl_pretty();
      echo '<input type= "radio" name="'.$name.'" value="'.$valu=$rec[0].'" '.$valgt.' title="'.tolk($rec[3]).'">'.
            $lbl= ' '.Tolk($rec[1]).' &nbsp; <font style="color:'.$ØbrwnColor.'">'.
            $suff=Tolk($rec[2]).'</font>&nbsp;'; 
  } 
  echo '</small></div> </form>';  dvl_pretty();
}


function htm_Prompt($label,$align) {
  echo '<p style="font-size:16px; text-align:'.$align.'";"> '.tolk($label).'</p>';
}



# BASISMODUL for link-knap med icon:
function iconKnap ($faicon='',$title='',$link='',$akey='') { global $ØButtnBgrd, $ØTastkeys;
  if ($ØTastkeys) {
    if ($akey) $genv=' ´<i>'.$akey.'</i>´'; else $genv='';
    if (!$genv) $ktip=''; else $ktip= '<br>'.tolk('@Tastatur genvej: ').$akey;
  }
  $LablTip= '<div0 class="tooltip" style="margin: 1px 5px;"><span class="tooltiptext">'.$title.$ktip.'</span></div0>';
  dvl_pretty('iconKnap');
  echo '<span><a href="'.$link.'" accesskey="'.$akey.'"'.$LablTip.' ';
  echo '<ic class="'.$faicon.'" style="font-size:32px; color:'.$ØButtnBgrd.';"></ic>'.  /* $genv. */ '</a></span>'; 
}
    
# BASISMODUL for link-knap med tekst (på lys baggrund):
function textKnap ($label='',$title='',$link='',$akey='',$more='', $ToolClass='tooltiptext') { global $ØButtnBgrd, $ØButtnText, $ØTastkeys;
  if ($ØTastkeys) {
    if ($akey) $genv=' ´<i>'.$akey.'</i>´'; else $genv='';
    if (!$genv) $ktip=''; else $ktip= '<br>'.tolk('@Tastatur genvej: ').$akey;
  }
  if (strpos($link, 'page_Blindgyden.php')>0) {$txtclr= '#AAAAAA'; $note=' <br> ('.tolk('@En blindgyde endnu!').')';} else {$txtclr= $ØButtnText; $note='';};
  $LablTip= '<div0 class="tooltip" style="color:'.$txtclr.' padding:2px 6px; border:1px solid gray; box-shadow: 2px 2px 4px #888888; '.$more.'">'.
            '<span class="'.$ToolClass.'">'.tolk($title).$ktip.$note.'</span></div0>';
  dvl_pretty('textKnap');
  echo '<span class="knap"> <a href="'.$link.'" accesskey="'.$akey.'" '.$LablTip.' <div style= "white-space: nowrap; color:'.$txtclr.'; ">'.ucfirst(tolk($label)).$genv.'</div></a></span>';  // wordwrap
}
    
# BASISMODUL for doFunction-knap med tekst på farvet baggrund:
function execKnap ($label='',$title='', $function='doFunction()') { global $ØButtnBgrd, $ØBtSavBgrd, $ØButtnText, $ØTastkeys;
  $KnapClr= 'brown';
  echo '<span class="knap" style="background:'.$KnapClr.'; color:'.$ØButtnText.'; padding:2px 6px; border-radius:6px; border:1px solid gray;" tiptxt="'.tolk($title).'"; onclick="'.$function.';">'.tolk($label).'</span>';
}

# BASISMODUL for set variabel-knap med tekst på farvet baggrund:
function setvKnap ($label='',$title='', $source, &$result, $akey='') { global $ØButtnBgrd, $ØBtSavBgrd, $ØButtnText, $ØTastkeys;
  if ($ØTastkeys==true) {
    if ($akey) $genv=' ´'.$akey.'´'; else $genv='';
    if (!$genv) $ktip=''; else $ktip= '&#xa;'.tolk('@Tastatur genvej: ').$akey;
  }
  $LablTip= '<div0 class="tooltip" style="color:'.$ØButtnText.'; padding:2px 6px; border:1px solid gray; box-shadow: 2px 2px 4px #888888; background:'.$ØBtSavBgrd.'; ">'.
            '<span class="tooltiptext">'.tolk($title).$ktip.'</span></div0>';
  dvl_pretty('setvKnap');
  echo '<form method="post">  <input type="hidden" name="var_name" value="'.$source.'">  <input type="submit" title="'.tolk($title).$ktip.'" value="'.ucfirst(tolk($label)).$genv.'" '.' ></form>';
  if(isset($_POST['var_name']))  { $result = $_POST['var_name']; }
}
    
# BASISMODUL for link-knap med tekst på farvet baggrund:
function naviKnap ($label='',$title='',$link='',$akey='',$more='') { global $ØProgRoot, $ØButtnBgrd, $ØButtnText, $ØTastkeys;
  if ($ØTastkeys) {
    if ($akey) $genv=' ´<i>'.$akey.'</i>´'; else $genv='';
    if (!$genv) $ktip=''; else $ktip= '<br>'.tolk('@Tastatur genvej: ').$akey;
  }
  if ($link==$ØProgRoot.'_base/page_Blindgyden.php') {$clr= '#AAAAAA'; $note=' <br> ('.tolk('@En blindgyde endnu!').')';} else {$clr= 'white'; $note='';};
  $LablTip= '<div0 class="tooltip" style="color:'.$clr.'; padding:2px 6px; border:1px solid gray; box-shadow: 2px 2px 4px #888888; background:'.$ØButtnBgrd.'; '.$more.'">'.
            '<span class="tooltiptext">'.tolk($title).$ktip.$note.'</span></div0>';
  dvl_pretty('naviKnap');
  echo '<span class="knap" style="color:'.$color=$ØButtnText.'; "><a href="'.$link.'" accesskey="'.$akey.'"'.$LablTip.' '.ucfirst(tolk($label)).$genv.'</a></span>';  
}

function menuTitl ($h='32',$w='120',$label='') {global $ØProgRoot;
  dvl_pretty();
  echo '<titlBg><img src= "'.$ØProgRoot.'_assets/images/menuShapeTitl.png" alt="" height="'.$h.'" width="'.$w.'" /><a href="'.$link.
  '" class="btnTit" notitle= "'.tolk('@Kolonne Overskrift').'">'.ucfirst(str_replace(' ','&nbsp;',tolk($label))).'</a></titlBg>'; }
  
function menuKnap ($h='32',$w='120',$label='',$link='',$title='') { global $ØProgRoot;
  if (strpos($link,'_base/page_Blindgyden.php')) { $flag0= ' style="color:gray" '; $mess= str_lf().' (En blindgyde endnu!)';}
  else {$mess=''; $flag0=''; $flag1=''; }
#  if (strpos($link,'page_Syssetup1.php')) $flag1= ' style="color:red" '; else $flag1= ' style="color:#900000" ';
  dvl_pretty();
  echo '<menuBg><img src= "'.$ØProgRoot.'_assets/images/menuShapeButt.png" alt="" height="'.$h.'" width="'.$w.' display:block; margin:auto;" /><a href="'.$link.
  '" class="btn" title="" tiptxt="'.tolk($title).$mess.'" '.$flag0.$flag1.'><div style= "white-space: nowrap;">'.ucfirst(str_replace(' ','&nbsp;',tolk($label))).'</div></a></menuBg>'; }

function userTip () { global $Ønovice;
   dvl_pretty();
   if (!$Ønovice) $Ønovice='true';
#?? Fejler:  echo '<script> document.getElementByName("tip").checked= '.$Ønovice.'; </script>';
   $Ønovice= htm_CheckFlt($type='checkbox',$name='tip', $valu= $Ønovice, $labl='@noTIP?:', $titl='@Vis tip for begyndere, hvis du er ny i systemet. (Virker ikke endnu)', 
      $revi=true, $more=' '.$Ønovice,' ');
 //  $Ønovice= true;
}

function run_Script ($cmdStr) {
  dvl_pretty();
  echo '<script> '.$cmdStr.' </script>';
  dvl_pretty();
}

# BASISMODUL for tabel: 
# Visning af data - ingen redigering, udover oprettelse af ny record, og angivelse af filter.
# "RulleTabel" mellem fastlåst TabelTop og Bund, hvis tabellen er højere end $ViewHeight
# Mulighed for: Filtrering / Sortering / Recordvalg / NyRecord
# NyRecord, når $CreateRec=true
function htm_TabelOut(
           $RowLabl='',      # htm_TabelInp:  array([0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder, 7:HideCol])
           $RowBody= array(['@Kol0','7%','D','text','left','Tip','Plac','Hide'],['...']), # Default! Kolonne-egenskaber. Arr-eksempel erstattes med aktuel parameter!
        // $RowBody= array(['labl0'=>'@Kol0','width1'=>'7%','sort2'=>'D','color3'=>'text','just4'=>'left','tip5'=>'Tip','plachold6'=>''],['...']), # Default! Kolonne-egenskaber. Arr-eksempel erstattes med aktuel parameter!      
        // Hide er ny. Skal benyttes til at springe kolonner over i visning, både filter, overskrifter og data.    #Alt. benytte hidd i $RowBody[3]?
           $TablData= array(),  # De data som skal vises i tabellen
           $FilterOn= true,     # Default! Mulighed for at skjule records med filter.
           $SorterOn= true,     # Default! Mulighed for at sortere records efter kolonne indhold
           $CreateRec=true,     # Default! Mulighed for at oprette en record
           $ModifyRec=true,     # Default! Mulighed for at ændre data i en row (ikke aktiv endnu)
           $ViewHeight='200px', # Default! erstattes af eventuel parameter.
           $Angaar='')          # Angår forskellig Manipulering/layout af sum-linier: regnskab, budget og kontoplan
{ global $ØProgRoot, $ØButtnBgrd, $ØLineBrun, $Ønovice, $ØFullFilt, $ØRollTabl, $ØBtNewBgrd, $ØTextLight, $Ødimmed, $ØHeaderFont;
if ($ØRollTabl==false) $ViewHeight= '99999px';
#+  if ($Angaar!='Rude_LanguageJuster')
#+  userTip();
//  $Ønovice= isset($_POST['tip']);
dvl_ekko('htm_TabelOut  0 ');
  dvl_pretty('htm_TabelOut');
  if (!$FilterOn) { $CaptFilt= '<ic class="fas fa-filter" style="font-size:20px;color:brown;"> </ic><b>'.tolk('@FILTER:').'</b>'; } // fas fa-filter
  else { $CaptFilt= '<b title="'.tolk('@Reducer visning af DATA i tabellen nedenfor, ved at angive søge-kriterier i felterne herunder:').'"> <ic class="fas fa-filter" style="font-size:14px;color:brown;"> </ic> '.tolk('@FILTER:').'</b>';  };
  if ($Ønovice) $CaptFilt.= tolk('@Begræns visning i DATA-tabellen nedenfor, ved at angive søge-kriterier i felterne herunder:');
  if ($SorterOn) $tip= '<small><i>'.tolk('@Sorter data ved at klikke på kolonne overskrifter.').'</i></small>'; else $tip='';;
  if (!$SorterOn) { $CaptSort= '<b>'.tolk('@DATA:').'</b>'; }
  else { $CaptSort= '<b title="'.$tip.'"> <ic class="fas fa-database" style="font-size:14px;color:brown;"> </ic>  '.tolk('@DATA:').'</b>';  };
  
dvl_ekko('htm_TabelOut  1 ');
//  if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,__FUNCTION__.':1');

### outputTabel med Filter:
  if ($FilterOn) {  ### Vis filter-felter:
    htm_Rammestart($Caption=$CaptFilt);
    if (($ØFullFilt) or ($Angaar!='Rude_Kladderedigering')) {
     // echo '<br> <tc>'.$CaptFilt.'</tc>';
      textKnap($label='@Vis det valgte', $title='@Vis det der matcher filteret herunder',  $link='../_base/page_Blindgyden.php');
      textKnap($label='@Vis alt',        $title='@Nulstil filter og vis alt',              $link='../_base/page_Blindgyden.php');
      htm_nl();
      echo '<div class="fixed-table-container" style= "max-height: '.$ViewHeight.'; max-width:97%; float:left; margin-left:4px;">';  //  <div class="header-background"> </div>';
      dvl_pretty();
      echo '<table cellspacing="0">';
      echo '<thead> <tr>';
      $first= 'class="first"';
      foreach ($RowBody as $Body) { dvl_pretty(); 
        //if (strtolower($Body[7])!= 'hide') 
          echo '<th '.$first.' style="width:'.$Body[1].';'.$ØHeaderFont.'" title="'.tolk($Body[5]).'"> <div class="extra-wrap"><div class="th-inner">'.ucfirst(tolk($Body[0])).'</div></div> </th>';  
          $first= '';
      } echo '</tr> ';
      dvl_pretty();
      echo '<tr class="row">';
        for ($x= 0; $x < count($RowBody); $x++) 
          {dvl_pretty(); echo '<td><input type= "text" name="Kol'.$x.'" title="'.tolk('@Søg efter...').'" placeholder="...'.tolk('@Søg').'..." style="width:97%; padding-left:4px; background:#CCEDFE;" /></td> ';}
        echo '</tr></thead> </table> </div>'; dvl_pretty();
    } else 
    {//  Simpelt filter:
      if ($Angaar='Rude_Kladderedigering') {
        textKnap($label='@Vis egne', $title='@Vis kun egne kladde lister', $link='../_base/page_Blindgyden.php');
        textKnap($label='@Vis alle', $title='@Vis alle kladde lister',     $link='../_base/page_Blindgyden.php');
        htm_nl();
      }
    }
    htm_Rammeslut();
  }

  //if ($FilterOn) echo ' <tc>'.$CaptSort.'</tc>';
  htm_Rammestart($Caption=$CaptSort);
  echo '&nbsp; <small>'.$tip.'</small>';
### Reservation af View for tabel i låst max-højde:
  echo '<div class="fixed-table-container"                 style= "max-height:'.$ViewHeight.';">';
  echo '<div class="fixed-table-container-inner extrawrap" style= "max-height:'.$ViewHeight.';">';
  
### outputTabel med sorterbare datakolonner:
  if ($SorterOn) {$sortClas='class="sortable"';} else {$sortClas='';}
  dvl_pretty();
  echo '<table id="sorterbarTable" '.$sortClas.' cellspacing="0" style="border: 1px solid '.$ØLineBrun.';"> ';
//?  echo '<colgroup>';
//?  foreach ($RowBody as $Body) { echo '<col style="width:'.$Body[1].';">'; } # Opret Kolonne-bredder
//?  echo '</colgroup>';
  
### Tabellens Header med sortervalg:  //  FIXIT: HeaderRow starter med et blankt felt, som forskyder alle overskrifter! ? ÅRSAG: <span class="th-inner">
  dvl_pretty();
  echo '<thead><tr>';                 //  FIXIT: Sorterings-pil placeres ikke i den fastlåste HeaderRow (DIV konflikt?)   Samme årsag!
  $RowSelect= '<span class="tooltip"><font style="font-size:115%;">&#x21E8;</font><span class="tooltiptext" style="bottom: -12px; left: 65px">'.
      tolk('@Se mere: ').str_nl(1).tolk('@Klik på pil-knappen, for at ').tolk($RowLabl).'.</span></span>';
  //  OnClick Read RowIx, Getdata(RowIx), ShowDetails(RowIx)
  $first= 'class="first"';
  foreach ($RowBody as $Body) { dvl_pretty(); 
    if ($Body[3]!='hidd')
      echo '<th '.$first.' title="'.tolk($Body[5]).'" style="width:'.$Body[1].'; '.$ØHeaderFont.' cursor:ns-resize;"> '.
              '<div class="th-inner -FIXIT">'.ucfirst(tolk($Body[0])).'</div> '.
           '</th>';
      $first= '';
  } echo '</tr></thead>';
  
### Vis Data:  
  dvl_pretty();
  echo '<tbody>';
  if ($Angaar=='kontoplan') {$goTo= 'href="'.$ØProgRoot.'_base/page_Blindgyden.php?rowix="';}  //  {$goTo= 'href="page_Kontokort.php?rowix=';}
  else $goTo = '';
  if ($ModifyRec==false) {$RowSelect= '';}  // Ingen mulighed for at vælge record som skal rettes/vises med detaljer
  if (!$TablData) {msg_Info('Ingen data','Data tabellen er tom! ('.$Angaar.')');} else
    foreach ($TablData as $Row) { 
      $rowBg= RowDesign($Row,$RowLabl,$Angaar); //  $Row er pointerrefereret og ændrer indhold!
      dvl_pretty();
      echo '<tr class="row" '.$rowBg.'>';    $x= 0;    $bg= 'transparent'; 
      foreach ($Row as $Col)      // Bestem Baggrund og felt-style for rækken:
      {$x++;  
        $fed= ''; //  $fed= ' font-weight:800;';
        if ($Angaar=='budget') {}; # Foregår i htm_TabelInp_Budget
        if (($Angaar=='kontoplan') or ($Angaar=='Rude_Varemodtagelse'))
          {if ($x==1) $bg= 'white'; else $bg= 'transparent';}                                           // Hvid: kontonr
        
        if (($Angaar=='regnskab') and (($x>=3) and ($x<=5))) {$fed='  opacity:0.22;';}  // Type & Valuta
        if (($Angaar=='regnskab') and ($Row[2]=='H')) {   //  HeadLine: Fed overskrift, og ingen tal i kolonner efterfølgende
          if ($x<3) $fed= ' font-weight:600;'; 
          if ($x>2) $Col='';
        }
        if (($Angaar=='regnskab') and (!strpos($rowBg,'gray')) and (!strpos($rowBg,'green')) and (!strpos($rowBg,'yellow')) )
          if (($x==1) or ($x==6) or ($x==19)) {$bg= 'white; opacity:0.66';} 
          else {$bg= 'transparent';}  // Hvid: kontonr, primo og Ialt
        
        if ((strpos($Row[1],'<br>'))and ($x==2)) {$span= 'colspan=3; ';} else {$span= ''; }             // Lange tekster i flere kolonner.
        if (($x==1) and ($Angaar!='regnskab'))                                                          // Valgbar række
              {$spcSty= 'border:1px solid #CCCCCC;">'.$RowSelect.' <a '.$goTo.$Col.';">'; $spcStyend= '</a>';}
        else  {$spcSty= ';" '.$span.'>'; $spcStyend= '';} // Ingen rækkevalg ved regnskab
        
        dvl_pretty();
        if ($Body[3]!='hidd')
          echo '<td style= "background-color:'.$bg.'; text-align:'.$RowBody[$x-1][4].'; '.$fed.$spcSty.$Col.$spcStyend.' </td>'; 
      }
      echo $genvej.'</tr>'; 
    } 
    
### Opret ny record:
    if ($CreateRec) { $x= 0;  
      foreach ($RowBody as $Body) { $x++; 
        dvl_pretty();
        echo '<td style="padding:0; vertical-align: bottom; background:#DDFFFF;">';
        if ($x==1) { $index= '9998+1';  # "background:'.$ØButtnBgrd.'; color:white;"
          echo '<div1 class="tooltip" style="background:'.$ØBtNewBgrd.'; color:'.$ØTextLight.';'.$Ødimmed.'; white-space: word-wrap;">'.
            tolk('@Opret ny:').'<span class="tooltiptext" style="bottom: -12px; left: 35px; ">'.dvl_pretty().
            tolk('@Klik her, når du har udfyldt data-felterne på rækken herunder.').' </span></div1>'; 
        }
        dvl_pretty();
        echo '<div style="margin-right: 2px;"> <input type= "'.$Body[3].'" name="Kol'.$x.'" title="'.tolk($Body[5]).
              '" placeholder="'.tolk($Body[6]).'" style="text-align:left; width:98%; padding-left:4px; background-color:#FCFCCC;" /></div></td> ';
      }
    }
  echo '<tfoot></tfoot></tbody> </table> </div> </div>'; ### Slut Tabel og View
  htm_Rammeslut();
} //  htm_TabelOut


function RowDesign (&$Row,$RowLabl,$Angaar='') { # Row: [0:kontonr, 1:beskrivelse, 2:kontotype, 3:moms, 4:fra_kto, 5:til_kto, 6:lukket]
//  global $genvej;
global $ØprogSprog;
    $rowBg= '';    
    if (($RowLabl=='@redigere denne konto') or ($RowLabl=='@vælge denne post') or ($RowLabl=='')) { // Kontoplan/Regnskab/Budget: Design af rows
### Talformat:
      if (gettype($Row[5])=='double')  {$Row[5]= number_format($Row[5]*1, 2, ',', ' ');} else
### Baggrund og tekst, afhængig af kontotype:
      switch (strtoupper($Row[2])) {
        case 'H': $Row[2]='';  for ($i= 4; $i < 18; $i++) { $Row[$i]='';}; $rowBg= 'style="background:white; vertical-align:bottom; height:2em;"'; break;
        case 'D': $Row[2]=tolk('@Drift' );  $rowBg= ''; break;
        case 'S': $Row[2]=tolk('@Status');  $rowBg= ''; break;
        case 'Z': $Row[2]=tolk('@Sum');     $Row[4].=' - '.$Row[0]; 
                                            $Row[1].='<br>'.$Row[2].': '.$Row[4].' '.tolk('@(uden sum-beløb)'); 
                                            $Row[2] =''; 
                                            if ($Angaar=='budget') {}; 
                                            if ($Angaar=='regnskab') for ($i= 3; $i < 18; $i++) { $Row[$i]= $Row[$i+3];};  // Ryk beløb TV
                                            if ($Angaar=='kontoplan') for ($i= 3; $i < 18; $i++) { $Row[$i]= '';};         // Slet beløb
                                            $rowBg= 'style="background:gray; color:white; vertical-align:top; height:2em;"';  break;
        case 'R': $Row[2]=tolk('@Resultat');   
                                            if ($Row[0]) $Row[4].= ' - '.$Row[0]; 
                                            $Row[1].= '<br>'.$Row[2].': '.$Row[4].' '.tolk('@(uden sum-beløb)'); 
                                            $Row[2]=''; 
                                            for ($i= 4; $i < 18; $i++) { $Row[$i]='';};
                                            $rowBg= 'style="background:green; color:white;"'; break; #  'Resultat = $row[fra_kto]'
        case 'X': $Row[1]=tolk('@Sideskift').' <br>'.tolk('@(Ovenfor:Driftkonti - Herunder:Statuskonti)');  
                          $Row[2]='<br><br><br><br>'; for ($i= 4; $i < 18; $i++) { $Row[$i]='';}; $rowBg= 'style="background:yellow;"';  break;
        default : {$ix= 1; /* echo "<colrlabl>Sprog?:".$ØprogSprog." </colrlabl>"; */};
      }
### Felter med værdi=0 vises blanke:
      if ($Row[4]=='0' ) {$Row[4]='';}     //  Fra_kto 0 vises BLANK
### Kursværdi=100 vises som DKK:    //  if ($Row[6]==100) {$Row[6]='DKK';}  //  Kursværdi! 100 vist som DKK
      $genvej= '<td style= "text-align:center"> </td>';
    } else $genvej= '';
    return $rowBg;
}

if (!function_exists('MakeOptList')) {
function MakeOptList($valu,$optliste=[]) { if ($valu='') $valu= tolk('@?...');
  dvl_pretty();
  echo '<td> <div style="margin-right:0; "> <select class="styled-select" name="liste"> <option value="'.$valu.'" title="'.tolk('@Vælg').'" >';
    foreach ($optliste as $rec) {
      dvl_pretty();
      echo '<option value="'.$rec[1].'" title="'.$rec[0].'"'.$rec[3];
        if ($rec[1]==$valu) echo ' selected';
      echo '>'.$lbl=$rec[2].'</option> ';
    }
  echo '</select></div></td> '; dvl_pretty();
}}

if (!function_exists('htm_SelectStr')) {  # Optimering: Disse lister bør kunne oprettes 1 gang, kun ved opstart!
function htm_SelectStr($name,$valu,$optliste=[],$more='',$nodiv=false) {
  if ($nodiv) $Result= ''; else $Result= '<div style="margin-right:0;"> ';
  $Result.= '<select class="styled-select" id="'.$name.'" name="'.$name.'" style="max-width:120px; background-color:transparent; '.$more.
    '"> <option value="" selected disabled hidden> '.tolk('@Vælg').'...<option value="'.$valu.'" >';
  foreach ($optliste as $rec) {
    $titl= tolk($rec[0]);
    $Result.= '<option value="'.$rec[1].'" title="'.$titl.'"'.$rec[3];
      if ($rec[1]==$valu) $Result.= ' selected';
    if (strpos('dual',' '.$more)>0) {if (strlen(' '.$titl)>15) {$titl= ':'.substr($titl,0,15).'...';}} 
    else {$titl= '';}
    $Result.= '>'.$lbl=tolk($rec[2]).$titl.'</option> ';
  }
  $Result.= '</select>'; if (!$nodiv) {$Result.='</div> ';}
  return($Result);
}}

function PauseKlovn($mess='Indlæser. Hæng på!') {
  echo '<div style="text-align:center;"><i class="far fa-cog fa-spin fa-3x fa-fw" aria-hidden="true"></i><span class="sr-only">'.$mess.'</span></div>';
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
      $RowPref=  array(),      # Ubenyttet i denne funktion!
      $RowBody= array(['@Kol0','7%','','','Tip',''],['@Kol1','10%','','','Tip','']), # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      $RowSuff=  array(),      # Ubenyttet i denne funktion!
      &$DATA, //  = array(),
      $ViewHeight= '400px'
      ) 
//  FIXIT:  A. Kolonne-summer vises i bold. - B. Kolonneoverskrifter skjules når vinduet rulles.
{ global $ØblueColor, $ØLineBrun, $ØtblRowLgt, $ØRollTabl, $ØHeaderFont;
if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,__FUNCTION__.':1');
dvl_pretty('htm_TabelInp_Budget');
  if ($ØRollTabl==false) $ViewHeight= '99999px';
### "InfoFelter" over kolonne-labels:
      htm_FrstFelt( '5%',0); 
      #htm_NextFelt('10%');  echo tolk('@Nyt budget:');  //  '@ +/- 0% OK', '@Pct. korrektion'
      htm_NextFelt('10%');  htm_CentHead(tolk('@Opret nyt budget:')); //echo tolk('@Nyt budget:');  //  '@ +/- 0% OK', '@Pct. korrektion'
      htm_NextFelt('8%');   htm_CombFelt($type='number',  $name='pct', $valu= 0,   
                                         $labl='@% Korrektion',  
                                         $titl='@Angiv en +/- pct-sats, som der skal justeres op/ned med', 
                                         $revi=true, $rows='2',$width='44px',$step='1');
      htm_NextFelt('30%');  textKnap($label='@Udfyld på grundlag af sidste års budget-tal',  
                                          $title=tolk('@Automatisk budgetlægning på grundlag af sidste års regnskab, korrigeret med den angivne pct. sats!').'<br>'.
                                          tolk('@ADVARSEL: Alle nuværende beløb overskrives! Gem ikke, hvis det er en fejl.'),$link='../_base/page_Blindgyden.php','','','tooltipB');
      htm_NextFelt('35%');  htm_RadioGrp($type='hori',  $name='krvis',  $labl='@Beløbsvisning:', $titl='@Vælg visnings nøjagtighed for budget beløb', 
                            $optlist= array(['kr','@Hele kroner','@eller',true],['tusind','@Kun tusinder','']),$action='');
      htm_LastFelt();    
  echo '<div class="fixed-table-container-inner" style= "max-height: '.$ViewHeight.';">';  //  Se mere her: https://codepen.io/chiranjeeb/pen/LGsiv
  echo '<table class="formnavi" cellspacing="0" style="border: 1px solid '.$ØLineBrun.';">';
  
  if (!function_exists('LblOut')) { function LblOut ($part1,$part2) {global $ØHeaderFont;
    echo '<th style="font-size:small; border:0px solid; width:'.$part1.';'.$ØHeaderFont.'">'.
         '<div class="extra-wrap"><div class="th-inner-center" align="center">'.ucfirst($part2).'</div></div> </th>';}}
  
  if (!function_exists('PwrOut')) { function PwrOut ($wdh,$lbl,$tip) {global $ØHeaderFont;
    echo '<th style="font-size:small; border:0px solid; width:'.$wdh.';'.$ØHeaderFont.'">'.
         '<div class="extra-wrap"><div class="north" align="center" title="'.tolk($tip).'">'.ucfirst(tolk($lbl)).'</div></div> </th>'; }}

### Kolonne-LABELS:   FIXIT: Labels skal være statiske, ikke rulle med op i tabel-ruden! (som de ikke gør i htm_TabelOut() ) Lbl_Tip/tooltiptext skjules, når dern placeres ovenover).
  echo '<tr>';
    foreach ($RowBody as $Spec) PwrOut($Spec[1], $Spec[0], $Spec[5]);
  /*   {
      if ($n==0) {$n++; LblOut($Spec[1], Lbl_Tip($Spec[0],$Spec[5],'SO'));}
      else LblOut($Spec[1], Lbl_Tip($Spec[0],$Spec[5],'S'));
    };
   */
   echo '</tr>';
### Kolonne-DATA-INPUT:   
  echo'<tbody>  ';
  $optlist= FormVars(4); $ordlist= OrdrVars(4); $n= count($DATA); if ($n<1) $n= 20;
  $DatIx=-1;
  //if ($GLOBALS["Ødebug"]) var_dump($DATA);
    foreach ($DATA as $Dat) { $DatIx++;
      $rowBg= RowDesign($Dat,$RowLabl,$Angaar='budget');
      dvl_pretty();
      echo '<tr class="row"; '.$rowBg.'>';
### Tabel-BODY:
      $ColIx= -1;  $offset=0;                 # htm_TabelInp:  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
      foreach ($RowBody as $Body) {$ColIx++;  # htm_TabelOut:  [0:ColLabl, 1:ColWidth, 2:ColJust,        3:InpType,             4:ColTip, 5:placeholder]
        if ($ColIx==2) $offset=6; //  Ix 2 til 7 (som kontoplan), skal ikke udskrives, kun benyttes til layoutstyring!
        if (is_array($Dat[$ColIx+$offset])) $DatFelt= $Dat[$ColIx+$offset][$DatIx]; else $DatFelt= $Dat[$ColIx+$offset];   //  Afhængig af array i 1 eller 2 dimensioner!
        if (($ColIx==0) or ($ColIx==14)) $bg= $ØtblRowLgt; else $bg= 'transparent';                     //  Hvid: Konto og Ialt
        if ($Body[3]=='data') { dvl_pretty();
          echo '<td style= "text-align:'.$Body[4].'; font-size:small; background-color: '.$bg.';">'.tolk($DatFelt).'</td>';  }   //  Kun TEXT-output
        else  # I alle andre tilfælde Standard: text m.fl.
          if ($rowBg>'')  echo '<td style= "text-align:'.$Body[4].';">'.tolk($DatFelt).'</td>';    //  Kun TEXT: Overskrifter og sum-rækker
          else  { if ($offset>2) $val= number_format($DatFelt*1,0,',','.'); else $val= tolk($DatFelt);      
                  echo '<td> <input type= "text" name="Kol'.$ColIx.'[]" '.'value="'.$val.'" placeholder="'.tolk($Body[6]).
# Brug af rgba-opacity, påvirker ikke forgundsfarve!  '" style= "text-align:'.$Body[4].'; background-color: '.$bg.'; background-color: white; opacity:0.70; width:100%; width:92%;" /></td> ';
                                 '" style= "text-align:'.$Body[4].'; background-color: '.$bg.'; background: rgba(255, 255, 255, 0.5); width:100%; width:92%;" /></td> ';
                }
      };
      echo '</tr>';
    }
  echo '</tbody> </table> </div>';
} // htm_TabelInp_Budget


# BASISMODUL for tabelInput (Redigerbare data i tabel-celler):
function htm_TabelInp ( $HeadLine= array('0','1','2','3','4','5'),
                        $RowPref= array(['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:disp!      ','6:disp'],   ['Næste record']), # Generel struktur!
                        $RowBody= array(['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:placeholder','6:default'],['Næste record']), # Generel struktur! 
                        $RowSuff= array(['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:value!     ','6:disp'],   ['Næste record']), # Generel struktur! 
                        &$DATA= array(), # "Row-Body"
                        $ViewHeight= '500px',
                        $PadTop='26px',
                        $rowadd=''
                      ) 
{ global $ØblueColor, $ØLineBrun, $ØRollTabl, $ØHeaderFont, $ØIconStyle;
  dvl_pretty('htm_TabelInp'); 
  if ($$GLOBALS["Ødebug"]) $bord= ' border:1px solid brown; '; else $bord= ' border:none; ';
 # $ViewHeight= '';
  echo '<div class="fixed-table-container"                 style= "max-height:'.$ViewHeight.'; padding-top:'.$PadTop.'; ">';
  // if (strlen($PadTop)>'2') {echo '<table>'; foreach ($RowBody  as $Pref) 
  // {echo '<th style="width:'.$Pref[1].' align:'.$Pref[2].';'.$ØHeaderFont.'"> '.''.Lbl_Tip($Pref[0],$Pref[5],'SO','0px').' </th>';} echo '</table>'; }
  echo '<div class="fixed-table-container-inner extrawrap" style= "max-height: '.$ViewHeight.'; overflow-y: auto;">';
### Overskrifts linie:
  if ($HeadLine[0][0]>'') { # [0:Label, 1:Width, 2:Just, 3:Type, 4:Tip, 5:Value]
    dvl_pretty(); 
      echo '<div class="header-background" style="color:'.$ØblueColor.';"> &nbsp;';
      if ($HeadLine) 
        foreach ($HeadLine as $Capt) {
        echo tolk($Capt[0]).' ';  //  Label:
        if ($Capt[3]=='show') $forskel= '" disabled value="'; else $forskel= '"    placeholder="';
        dvl_pretty(); 
        if ($Capt[3]=='html')   //  Raw Html-kode
          echo $Capt[5]; else   //  Input-felt              
          echo '<input type= "'.$Capt[3].'" name="note" title="'.tolk($Capt[4]).
                              $forskel.tolk($Capt[5]). '" style="width:'.$Capt[1].'; text-align:'.$Capt[2].';" />&nbsp;&nbsp;';
       }
    echo '</div>';
  }
  dvl_pretty(); 
  echo '<table class="formnavi" cellspacing="0" style="border: 1px solid '.$ØLineBrun.';">';
### Kolonne-LABELS:
  dvl_pretty();
  echo '<thead><tr> '; 
  foreach ($RowPref  as $Pref) {dvl_pretty(); echo '<th class="south" style="width:'.$Pref[1].' align:'.$Pref[3].';'.$ØHeaderFont.'"> '.  // ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:disp!      ']
        '<div class="extra-wrap"><div class="th-inner-center" align="center">'.Lbl_Tip($Pref[0],$Pref[5],'SO','0px').'</div></div> </th>';}
  $kNo= 0;
  foreach ($RowBody as $Spec) {dvl_pretty(); if ($Spec[2]!='hidd') {if ($kNo++>3) $plc='SW'; else $plc='SO'; if ($kNo==count($RowBody)) $plc='SW';echo '<th style="width:'.$Spec[1].';'.$ØHeaderFont.'">'.  //  ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:placeholder']
        '<div class="extra-wrap"><div class="th-inner-center" align="center">'.Lbl_Tip($Spec[0],$Spec[4],$plc,'0px').'</div></div> </th>';  } else {echo '<th style="width:0px;">';};}
  foreach ($RowSuff  as $Suff) {dvl_pretty(); echo '<th style="width:'.$Suff[1].    //  ['0:ColLabl', '1:ColWidth', '2:InpType', '3:FeltJust', '4:ColTip', '5:value!     ']
                                                      ' align:'.$Suff[3].';'.$ØHeaderFont.'">'.Lbl_Tip($Suff[0],$Suff[4],'SW','0px').'</th>';}
  echo '</tr></thead>  ';
  dvl_pretty();
  
### Kolonne-DATA-INPUT:   
  echo' <tbody>  ';
  $optlist= FormVars(4); $ordlist= OrdrVars(4); $n= count($DATA); if ($n<1) $n= 20;
# for ($y= 0; $y < $n; $y++) { $x=0;  // DEMO-data. ToDo: Skal i stedet knyttes til &$DATA array()
  $DatIx=-1;
  foreach ($DATA as $Dat) { $DatIx++;
    dvl_pretty();
    echo '<tr class="row">';
    foreach ($RowPref  as $Pref) {dvl_pretty(); echo '<td style="width:'.$Pref[1].'; text-align:'.$Pref[3].'; '.$bord.'">'.tolk($Pref[4]).' </td>';} 
### Tabel-BODY:
    $ColIx= -1;
    $inpBg= 'background-color:transparent;'; //' background-color: white; opacity:0.60; ';
    foreach ($RowBody as $Body) {$ColIx++;                # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder, 7:BG-color]
      dvl_pretty();
      if (is_array($Dat[$ColIx]) )
           $valu= $Dat[$ColIx][0];
      else $valu= $Dat[$ColIx];
      echo '<td style="'.$bord.' text-align:center; ';
      switch ($Body[2]) {  # Specielle InpTyper:
        case "vars" : echo '">'.' <div style="margin-right:0; font-size:x-small"> <select class="styled-select" name="liste" style="max-width:120px"> <option value="" >-';
                        foreach ($optlist as $rec) { echo '<option value="'.$rec[1].'" '.$rec[3];   if ($rec[1]==$valu) echo ' selected';   echo '>'.$lbl=$rec[2].'</option> '; }
                      echo '</select></div> ';   break;
        case "chck" : echo '">'.'<input type= "checkbox" name="chck" value="" '.$valu.' ';  break;
        case "bold" : echo '">'.'<input type= "checkbox" name="bold" value="" '.isbold($valu).' ';  break;
        case "ital" : echo '">'.'<input type= "checkbox" name="ital" value="" '.isital($valu).' ';  break;
        case "moms" : echo '">'.htm_SelectStr($name='Kol'.$ColIx.'[]' ,$valu,MomsListe());  break;
        case "just" : echo '">'.htm_SelectStr($name='Kol'.$ColIx.'[]' ,$valu,JustListe());  break;
        case "side" : echo '">'.htm_SelectStr($name='Kol'.$ColIx.'[]' ,$valu,Side_List());  break;
        case "font" : echo '">'.htm_SelectStr($name='Kol'.$ColIx.'[]' ,$valu,FontListe());  break;
        case "kont" : echo '">'.htm_SelectStr($name='Kol'.$ColIx.'[]' ,$valu,KontListe());  break;
        case "valu" : echo '">'.htm_SelectStr($name='Kol'.$ColIx.'[]' ,$valu,ValuListe());  break;
        case "stat" : echo '">'.htm_SelectStr($name='Kol'.$ColIx.'[]' ,$valu,StatListe());  break;
        
        case "date" : echo '">'.'<input type= "date" id="'.$name.'" name="'.$name.'" style="line-height:100%; text-align:left; '.
                              'width:85%; font-size:small; height:16px; '. $inpBg. '" value="'.$valu. '" placeholder="yyyy-mm-dd" '.$aktiv.' />';  break;
        case "show" : //  Kun visning af data:
                      // echo ' width:'.$Body[1].'; margin-right:0; text-align:'.$Body[3].'; '.$inpBg.'" name="Kol'.$ColIx.'[]"> '.(tolk($valu)).' ';  break;
                      echo 'width:'.$Body[1].';"> <input type= "data" name="Kol'.$ColIx.'[]" '.'value="'.$valu. '" style="text-align:'.$Body[3].'; '.$inpBg.' width:100%; " readonly  /> ';  break;
        case "helt" : echo 'width:'.$Body[1].';"> <input type= "'.$Body[2].'" name="Kol'.$ColIx.'[]" '.'value="'.number_format($valu, 0). //  Heltal
                                    '" placeholder="'.tolk($Body[5]).'" style="text-align:'.$Body[3].'; '.$inpBg.' width:100%; padding-left:2px; padding-right:2px;" /> ';
                      break; //number_format($number, 0, '.', '')
        case "data" : //  Vis og rediger data:     (måske fejl her: viser kun 1. bogstav når $Dat ikke er en array?)
        case "area" : if ($valu=='Nyt felt')  {  # Opret ny record
                        echo '"> '.tolk('@Nyt felt:').' <div style="margin-right:0; font-size:x-small"> <select class="styled-select" name="liste"> <option value="" >-';
                          foreach ($ordlist as $rec) { echo '<option value="'.$rec[1].'" '.$rec[3];   if ($rec[1]==$valu) echo ' selected';   echo '>'.$lbl=$rec[2].'</option> '; }
                        echo '</select></div> ';
                      } else # Vis redigerbart datafelt:
                        //echo '<td style="width:'.$Body[1].';"> <div style="margin-right:0;"> <input type= "'.$Body[2].'" name="Kol'.$ColIx.'[]" '.'value="'.htmlentities(stripslashes(tolk($Dat[$ColIx][0]))).
                        echo 'width:'.$Body[1].';"> <input type= "'.$Body[2].'" name="Kol'.$ColIx.'[]" '.'value="'.htmlentities(stripslashes(tolk($valu))).
                                    '" placeholder="'.tolk($Body[5]).'" style="text-align:'.$Body[3].'; '.$inpBg.' width:100%; padding-left:2px; padding-right:2px;" /> ';
                      break;
        case "hidd" : //  Skjulte data medtages for at gøre opdatering nemmere:
                        echo 'width:0; padding:0px; border:none;">  <input type= "hidden" name="Kol'.$ColIx.'[]" '.'value="'.htmlentities(stripslashes(tolk($valu))).
                                    '" placeholder="'.tolk($Body[5]).'" style="text-align:'.$Body[3].'; '.$inpBg.' width:0px;" /> ';
                      break;
        default     : echo '"> <input type= "'.$Body[2].'"  name="Kol'.$ColIx.'[]" '.'value="" '.
                          'placeholder="'.tolk($Body[5]).   '" style="text-align:'.$Body[3].'; '.$inpBg.' width:100%; " /> ';
      }  
      echo '</td>';
    };
### RowTail:
    foreach ($RowSuff as $felt) {dvl_pretty(); 
              if ($felt[0]=='@Slet') {$vises='<button type= "submit" name="btn_del_'.$DatIx.'" class="tooltip" style="height: 20px;" >'.  dvl_pretty().
                                      Lbl_Tip($felt[5],tolk('@Slet pos: ').$DatIx,'SW','0px'). '</button>';}    
              if ($felt[0]=='@Skjul') {$vises='<button type= "submit" name="btn_hid_'.$DatIx.'" class="tooltip" style="height: 20px;" >'.  dvl_pretty().
                                      Lbl_Tip($felt[5],tolk('@Skjul pos: ').$DatIx,'SW','0px'). '</button>';}    // Records som ikke må slettes, kan skjules
              else {$vises= $felt[5];} 
              echo '<td style="'.$bord.'text-align:'.$felt[3].'; width:'.$felt[1].'; title:'.$felt[4].'">'.$vises.'</td>';
              }
    echo '</tr>';
  } # Ide: Mulighed for at vise kolonne-summer, eller andet, på en "footer-række" under tabellen.

### Opret Ny record:
    if (strlen($rowadd)>0) { 
      echo '<tr style="background:#DDFFFF;">';
      foreach ($RowPref  as $Pref) {dvl_pretty(); echo '<td style="width:'.$Pref[1].'; text-align:'.$Pref[3].'; '.$bord.'">'.tolk($Pref[4]).' </td>';} 
      $ColIx= -1;  
      foreach ($RowBody as $Body) { $ColIx++; // Nye Indateringsfelter:
        $valu= '';
        //  if ($ColIx==1) $index= '9998+1';
        if ($Body[2]=='show') $ro= 'readonly'; else $ro='';
        switch ($Body[2]) {  # Specielle InpTyper:
          case "vars" : echo '">'.' <div style="margin-right:0; font-size:x-small"> <select class="styled-select" name="liste" style="max-width:120px"> <option value="" >-';
                          foreach ($optlist as $rec) { echo '<option value="'.$rec[1].'" '.$rec[3];   if ($rec[1]==$valu) echo ' selected';   echo '>'.$lbl=$rec[2].'</option> '; }
                        echo '</select></div> ';   break;
          case "bold" : $content= '<input type= "checkbox" name="bold" value="" '.isbold($valu).'/>';  break;
          case "ital" : $content= '<input type= "checkbox" name="ital" value="" '.isital($valu).'/>';  break;
          case "just" : $content= htm_SelectStr($name='Kol'.$ColIx.'[]' ,$valu=$Body[6],JustListe());  break;
          case "side" : $content= htm_SelectStr($name='Kol'.$ColIx.'[]' ,$valu=$Body[6],Side_List());  break;
          case "font" : $content= htm_SelectStr($name='Kol'.$ColIx.'[]' ,$valu=$Body[6],FontListe());  break;
          default     : $content= '<input type= "'.$Body[2].'" name="Kol'.$ColIx.'[]" '.'value="'.$default=$Body[6].'" placeholder="'.tolk($Body[5]).   '" style="text-align:'.$Body[3].'; '.$inpBg.' width:100%; " '.$ro.' /> ';
        }  
        if ($Body[2]=='hidd') 
          {echo '<td style="width:0; padding:0px; '.$bord.'">  <input type= "hidden" name="Kol'.$ColIx.'[]" '.'value="'.htmlentities(stripslashes(tolk($valu))).
                '" placeholder="'.tolk($Body[5]).'" style="text-align:'.$Body[3].';  width:0px;" /></td> ';}
        else 
          {echo '<td style="padding:0; vertical-align: bottom; background-color:#FCFCCC; '.$bord.' text-align:center; "><div style="margin-right: 2px;">'.$content.' </div></td> '; } 
      }   // OpretNy-knap:
      echo '<td style="padding:0; margin-right: 12px; text-align:right; '.$bord.' padding-right:6px;" colspan="99" >'.
              '<div class="th-inner-center" style="text-align:right; font-size: 0.85em; padding-rigth:0.7em; '.$bord.' ">'.
              Lbl_Tip('@Ny',tolk('@Klik på den Blå icon, for at oprette ny postering, når du har udfyldt datafelterne'),'NW','0px').'</div> '.
              '<button type= "submit" name="btn_new" class="tooltip" style="height: 20px;" title="'.tolk('@Opret postering med de angivne data').'">'.
              '<ic class="fas fa-check-circle" style="color:blue; font-size:14px;"></ic></button></td></tr> ';
    }
    echo '</tbody> </table> </div>';    echo '</div>';
#+  NaviTip();
}

/*
"Submit Table:"
https://stackoverflow.com/questions/10216450/php-loop-through-html-table-elements-from-submit-form

HTML: I have a js function that adds the following to a table dynamically (Button on form)
<tr>
        <td><input type="text" name="name[]" ></td>
        <td><input type="text" name="surname[]" ></td>
        <td><input type="text" name="age[]"> </td>
</tr>

PHP: and this is the way that i process the table within the form
<?php  
  $rowCount =  count($_POST['name']); 
  echo "<table>";
  for($i=0; $i<=$rowCount-1; $i++)
    {
      echo "<tr>";
        echo "<td>".$_POST['name'][$i]."</td>";
        echo "<td>".$_POST['surname'][$i]."</td>";
        echo "<td>".$_POST['age'][$i]."</td>";
      echo "</tr>";
    }
  echo "</table>";?>
*/




function htm_Formstart($name='',$more='') { //  eks: $more= 'action="#"';
  dvl_pretty('htm_Formstart');
  echo '<form name="'.$name.'" id="'.$name.'_id" '.$more.' method="post">';
}
function htm_Formslut() {
  echo '</form>';
}
 
// functioner for Panel håndtering:
function PanelInit() { $maxPaneler= 40;
  echo '<script>';
  echo 'function PanelMinimizeAll() {';
  for ($Ix=1; $Ix<=$maxPaneler; $Ix++) {echo ' var h = document.getElementById("HideDiv'.$Ix.'"); var p = document.getElementById("panel'.$Ix.'");';  
                                        echo ' h.style.display = "none"; p.style.width = "240px"; ';}
  echo ' }';
  echo 'function PanelMaximizeAll() {';
  for ($Ix=1; $Ix<=$maxPaneler; $Ix++) {echo ' var h = document.getElementById("HideDiv'.$Ix.'"); var p = document.getElementById("panel'.$Ix.'");';  
  echo ' h.style.display = "block"; p.style.width = "100%"; ';}
  echo ' }';
  echo '</script>';
}
  
# LAYOUT moduler: Rude= Baggrund for en samling datafelter.
function htm_Rude_Top($frmName='', $capt='', $parms='', $icon='', $klasse='panelWmax', $func='Udefineret', $more='', $BookMark='../_base/page_Blindgyden.php') 
{  # SKAL efterfølges af htm_RudeBund !
  global $Ødebug, $ØTitleColr, $ØRudeForm, $ØProgRoot, $ØPanelIx; 
  $ØPanelIx++;
  echo '<script>';  //  Skjul/vis Panel-Body
  echo 'function PanelSwitch'.$ØPanelIx.'() {';
  echo '    var h = document.getElementById("HideDiv'.$ØPanelIx.'");';
  echo '    var p = document.getElementById("panel'.$ØPanelIx.'");';
  echo '    if (h.style.display === "none") { h.style.display = "block"; p.style.width = "100%"; } else { h.style.display = "none"; p.style.width = "240px"; }}'; //   
  echo 'function PanelMinimize'.$ØPanelIx.'() {';
  echo '    var h = document.getElementById("HideDiv'.$ØPanelIx.'");';  echo '    h.style.display = "none"; p.style.width = "240px"; }';  //h.style.width = "480px"; }';
  echo 'function PanelMaximize'.$ØPanelIx.'() {';
  echo '    var h = document.getElementById("HideDiv'.$ØPanelIx.'");';  echo '    h.style.display = "block"; p.style.width = "100%"; }';
  echo '</script>';
  dvl_pretty('htm_Rude_Top');                       //- dvl_ekko('htm_Rude_Top  XX ');
  if ($capt=='') $Ph= 'height:0px;'; else $Ph= '';  //- dvl_ekko('htm_Rude_Top  XX1 '.$ØRudeForm);
  
  if ($frmName>'') //  Uden navn oprettes ingen form, så lokale(/"indlejrede") forms muliggøres!
    {$ØRudeForm= true;
    echo '<form name="'.$frmName.'" id="'.$frmName.'" action="'.$parms.'" method="post">';  //  "ParentForm" - Nestet forms er ikke tilladt, så under-forms skal håndteres specielt!
    }  else $ØRudeForm= false;
  
  if ($Ødebug) {$fn= '&nbsp; <small><small><small>'.$func.'()</small></small></small>';} else $fn='';
    //    "https://ev-soft.dk/saldi-wiki/doku.php?id=saldi:manualen#konti"
    //    "https://ev-soft.dk/saldi-wiki/doku.php?id=legeplads:lege-side#kontakt"
  $kilde='https://www.ev-soft.dk/saldi-wiki/doku.php?id=';  $book= 'legeplads:';  $mark= '#';
  
  if (strpos('#',$BookMark.' ')>0) $BookMark= $book.$mark.$BookMark;  //  .' ' for at forhindre fejl i strpos(), når $BookMark==NULL
  else
  if (strpos('page_Blindgyden',$BookMark.' ')==0) {
    if ($BookMark=='../_base/page_Blindgyden.php') {$kilde= $BookMark; $BookMark= '';};
    if ($BookMark=='') { $wikilnk= '';  $kilde=''; }
  };
  $wikilnk= '<a href="'.$kilde.$BookMark.'" target="_blank" title="'.tolk('@Online hjælp, Find relevante informationer til dette panel, i SALDI-wiki. (Når Wiki for Saldi-€ er oprettet...) '.
  'Du kan her også være med til at vedligeholde hjælp og vejledning, da WIKIen er redigerbar.').'"><img src= "'.$ØProgRoot.
        '_assets/images/wikilogo.png " alt="Saldi Wiki" style="width:20px;height:20px; margin-right:2px; float:right;" '.'> </a>';
  
  echo '<div class="'.$klasse.'" id="panel'.$ØPanelIx.'" '.$more.' > '.    //  Rude-start
       '<div class="panelTitl" style="'.$Ph.' color:'.$ØTitleColr.'; cursor:row-resize; text-align: left; display: inline-block; width:75%;"  tiptxt="'.
        tolk('@Klik for at åbne/lukke dette panel').'" onclick=PanelSwitch'.$ØPanelIx.'(); >';  //  Rude-Header
  echo '<ic class="'.$icon.'" style="font-size:20px;color:brown;"> </ic> &nbsp;'.ucfirst(Tolk($capt)).$fn;
  echo '</div>';
  echo '<ic class="fas fa-angle-double-up"   style="width:12px;height:12px; margin-top:6px; margin-right:4px; float:right; cursor:zoom-out;" title="'.
        tolk('@Klik for at lukke alle paneler').';" onclick=PanelMinimizeAll(); cursor:row-resize></ic>';
  echo '<ic class="fas fa-angle-double-down" style="width:12px;height:12px; margin-top:6px; margin-right:0px; float:right; cursor:zoom-in;" title="'.
        tolk('@Klik for at åbne alle paneler').';"  onclick=PanelMaximizeAll(); cursor:row-resize></ic>';
  echo  $wikilnk; //  tiptxt virker ikke ovenfor, derfor: title !
  //echo '</div>'; //  Rude-Header
  echo '<div id="HideDiv'.$ØPanelIx.'" style="background:'.$ØBodyBcgrd.';">';   // Klap-sammen herfra! 
  if ($capt!='') echo '<hr class="style13" style="margin-bottom: 0;margin-top: 0;"/>';
} # Panelets < /rudediv>, < /hiding> og < /form> er placeret i htm_RudeBund, som skal kaldes til slut!

function htm_RudeBund($pmpt='', $subm=false, $title='@Husk at gemme her, hvis du har rettet noget ovenfor, inden du forlader vinduet.',$akey='',$simu=false,$frmName='') { # SKAL følge efter htm_Rude_Top !
  global $ØRudeForm;    dvl_pretty('htm_RudeBund  XX ');
  if ($title=='') $title= '@Husk at gemme her, hvis du har rettet noget ovenfor, inden du forlader vinduet.';
  if ($ØRudeForm)
    if ($subm==true) {
      echo '<hr class="style13" style= "height:4px;"><div class="centrer" style="height:25px">';  
      if ($simu) {
        htm_CheckFlt($type='checkbox',$name='sim', $valu= $Ønovice, $labl='@Simuler? ', $titl='@Simuler, dvs. gem ikke straks',$revi=true, $more=' '.$Ønovice,' ');//  Simuler
        htm_sp(3);
      }
      htm_Accept($pmpt,$title,$width='',$akey,$frmName); echo '</div>';  
    }
  echo '</div>';  // Klap-sammen hertil!
  echo '</div>';  // Rude-slut
                        dvl_pretty('htm_RudeBund  YY ');
  if ($ØRudeForm) echo '</form>'; //  PanelForm-slut
}

function PanelMin($nr) {
  echo '<script> PanelMinimize'.$nr.'(); </script>';
}
function PanelMinimer($sidste) {
  echo '<script> ';
  for ($nr=0; $nr<=$sidste; $nr++) echo 'PanelMinimize'.$nr.'(); ';
  echo '</script>';
}
function PanelMax($nr) {
  echo '<script> PanelMaximize'.$nr.'(); </script>';
}
function PanelBetjening() {
  htm_Caption('@Klik på de enkelte panel-overskrifter, for at Vise/Skjule panelers indhold.');
    execKnap($label='@Minimer alle',  $title='@Skjul indhold i alle paneler', $function='PanelMinimizeAll()');
    execKnap($label='@Maksimer alle', $title='@Vis indhold i alle paneler',   $function='PanelMaximizeAll()');
}

function htm_Accept($labl='', $title='', $width='',$akey='',$form='PanelForm')   //  Kan kun benyttes på PanelForm! (Rude_Top/Rude_Bund)
{global $ØBtNavBgrd, $ØBtNavText, $ØBtSavBgrd, $ØBtSavText, $ØBtDelBgrd, $ØBtNewBgrd, $ØTextLight, $ØTextDark, $Ødimmed, $ØTastkeys;
 ## Genvejstaster:
  if ($ØTastkeys) {
    if ($akey>'') $genv=' ´<i>'.$akey.'</i>´'; else $genv='';
    if (!$genv) $ktip=''; else $ktip= '<br>'.tolk('@Tastatur genvej: ').$akey;
  }
  if ($width) $width= ' width: '.$width.';';
#  $overTxt= 'onmouseover="style.background=\'blue\'" onmouseout="style.background=\''.$ØBtSavBgrd.'\'"';
  dvl_pretty('htm_Accept');
## Udseende:
  /* Generelt-Navigation  */  $colors= ' background:'.$ØBtNavBgrd.'; color:'.$ØBtNavText.';'.$Ødimmed; # naviger-knap: GRØN
  if (($labl=='@Gem') or ($labl=='@Gem rettelser') or ($labl=='@Fakturér') or ($labl=='@Opret ordre') or ($labl=='@Rediger det valgte') )
                              {$colors= ' background:'.$ØBtSavBgrd.'; color:'.$ØBtSavText.';'.$Ødimmed  # Submit-knap: GUL
                            #  ' onmouseover="style.background=\''.$ØBtSavText.'\'" onmouseover="style.color="\''.$ØBtSavBgrd.'\'" '.
                            #  ' onmouseout ="style.background=\''.$ØBtSavBgrd.'\'"'.
                              ;}
  if (($labl=='@Slet') )      {$colors= ' background:'.$ØBtDelBgrd.'; color:'.$ØTextLight.';'.$Ødimmed;} # Slet: RØD
  if (($labl=='@Opret Ny') )  {$colors= ' background:'.$ØBtNewBgrd.'; color:'.$ØTextLight.';'.$Ødimmed;} #   Ny: BLÅ
## Funktion:
  if (($labl=='@Retur til hovedmenu')) {textKnap($label='@Retur til hovedmenu',  $title='@Vend tilbage til programmets hovedmenu',
                                 $link= '../_base/page_Hovedmenu.php', $akey='', 
                                 $more= ' background:'.$ØBtNavBgrd.'; color:'.$ØBtNavText.';'.$Ødimmed); 
  } else  
  echo '<button form="'.$form.'" type= "submit" name="btn_'.$form.'" id="btn_'.$form.'" class="tooltip" style="margin: 1px 1px; padding: 1px 3px; height: 22px; '.$width.
  $colors.'" accesskey="'.$akey.'">'. # Submit-knap: GUL
  ucfirst(tolk($labl)).$genv.'<span class="tooltiptext">'.tolk($title).$ktip.'</span></button>';
}


# LAYOUT moduler: Lagen= Baggrund for en gruppe af ruder. (Parametre, som htm_Rude_Top)
function htm_Tapet_Top($name='', $capt='', $parms='#', $icon='', $klasse='tapetWmax', $func='Udefineret') {  //  Problem: lyster ikke tapetWmax
  global $Ødebug, $ØTitleColr, $ØTapetBgrd;
  if ($Ødebug) {$fn= '&nbsp; <small><small><small>f:'.$func.'()</small></small></small>';} else $fn='';
  dvl_pretty('htm_Tapet_Top');
  if ($name>'') echo '<form name="'.$name.'" id="'.$name.'" action="'.$parms.'" method="post">';
  echo '<div class="'.$klasse.'" style= "background:'.$ØTapetBgrd.';" > <div class="panelTitl" style="height:0;" >'.
    '<ic class="'.$icon.'" style="font-size:22px; color:'.$ØTitleColr.'"></ic> &nbsp;'.ucfirst(Tolk($capt)).$fn.'</div>';
} # Boxens </div>  er placeret i htm_TapetBund, som skal kaldes til slut!

function htm_TapetBund($formslut=false) { # SKAL følge efter htm_Tapet_Top !
  dvl_pretty('htm_TapetBund');
  echo '</div>'; if ($formslut) echo '</form>';
}

function htm_Rammestart($Caption='',$bord='1px') {
  echo '<fieldset  style="border: '.$bord.' solid #8c8b8b; padding:2px;"> <legend><tc><b>'.tolk($Caption).'</b></tc></legend>';
}
function htm_Rammeslut() {
  echo '</fieldset>';
}
 

function htm_Caption($labl='',$style='color:#550000; font-weight:600;') {
  echo '<colrlabl style="'.$style.'">'.tolk($labl).'</colrlabl>';
}  

function htm_Plaintxt($labl='',$style='color:#777777; font-weight:400; font-size:14px; ') {
  echo '<div style="display: inline-block; '.$style.'">'.tolk($labl).'</div>';
}  
  
function str_Plaintxt($labl='',$style='color:#777777; font-weight:400; font-size:14px; ') {
  return '<div style="display: inline-block; '.$style.'">'.tolk($labl).'</div>';
}  
  
# Felter i en horisontal række:
function htm_FrstFelt($wth,$bord=0,$more='') 
                            {dvl_pretty('htm_FrstFelt'); echo '<TABLE BORDER="'.$bord.'"  border-collapse: collapse; padding: 0px; width:100%;><TR '.$more.'><TD width="'.$wth.'"> ';}
function htm_NextFelt($wth) {dvl_pretty('htm_NextFelt'); echo '</TD>  <TD style="width:'.$wth.';"> ';}
function htm_LastFelt()     {dvl_pretty('htm_LastFelt'); echo '</TD>  </TR> </TABLE>';}

function Head_Navigation ($sideObjekt, $status, $goPrev, $goHome=true, $goUp, $goFind, $goNew, $goNext) { # Genvejsknapper på siders top.
  global $ØProgRoot;
  $sideObjekt= tolk($sideObjekt).'. ';
  echo '<PanlHead>';
  htm_Rude_Top($name='naviform',$capt='',$parms='',$icon='','panelWmax',__FUNCTION__);
  echo '<div style="text-align: center" ><img src= '.$ØProgRoot.'_assets/images/saldi-e50x170.png " alt="Saldi Logo" style="width:170px;height:50px;"></div>';
//  echo '<p align="center"><b>'.tolk('@Navigation:').'<b></p>';
  echo '<p align="center">';  #<ic class="fa '.$icon.'" style="font-size:22px;color:green"></ic>
  if ($goPrev)  iconKnap($faicon='fas fa-caret-square-left',    $title= tolk('@Vis forrige')  .' '.$sideObjekt    ,$link='../_base/page_Blindgyden.php',$akey='f');
  if ($goHome)  iconKnap($faicon='fas fa-home',                 $title= tolk('@Luk vinduet og gå til hoved-menu.'),$link='../_base/page_Hovedmenu.php'.$goBack,$akey='h');
  if ($goUp  )  iconKnap($faicon='fas fa-caret-square-up',      $title= tolk('@Luk vinduet og gå et niveau op.')  ,$link= $goBack,                      $akey='l');
  if ($goFind)  iconKnap($faicon='fas fa-search',               $title= tolk('@Søg en anden') .' '.$sideObjekt    ,$link='../_base/page_Blindgyden.php',$akey='s');
  if ($goNew )  iconKnap($faicon='fas fa-plus-square',          $title= tolk('@Opret ny')     .' '.$sideObjekt    ,$link='../_base/page_Blindgyden.php',$akey='o');
  if ($goNext)  iconKnap($faicon='fas fa-caret-square-right',   $title= tolk('@Vis næste')    .' '.$sideObjekt    ,$link='../_base/page_Blindgyden.php',$akey='v');
  if ($doUndo)  iconKnap($faicon='fas fa-undo',                 $title= tolk('@Fortryd')      .' '.$sideObjekt    ,$link='../_base/page_Blindgyden.php',$akey='u');
  echo '</p>';
//  if ($status) {
//    $status= '<x1 style="font-weight:300; font-size:smaller"> - Status:<colrlabl> '.$status.'</colrlabl></x1>';
//    echo '<p align="center">'.ucfirst($sideObjekt).$status.'</p> ';
//  }
  htm_RudeBund($pmpt='@Gem',$subm=false,$title='@Gem',$akey='');
  echo '</PanlHead>';
}

# PROGRAM-MODUL;
function SprogValg(&$ØprogSprog) {
  #htm_Caption('@Program sprog:');
  echo '<span style="display: inline-block; width:280px">';
  htm_OptioFlt($type='text', $name='progsprog', $valu=$ØprogSprog, 
      $labl= '@Program sprog:', 
      $titl= tolk('@Hvilket sprog vil du benytte programmet med ?').' <br> (Virker kun delvist!.<br> Klik 2 gange er nødvendig!!!)', 
      $revi=true, $optlist= SPR_Liste(),
      $action= $result= $_POST[$name],
      $events='onchange="this.form.submit();"  ');  //   onblur="window.location.reload(true);"  ');  //  onchange="update(this)"
    echo '</span>';
    if (strlen($result)==2) $ØprogSprog= $result;
    $_SESSION['ØprogSprog']= $ØprogSprog;    //  $ØprogSprog= $_SESSION['ØprogSprog']; udføres i ../_base/htm_pagePrepare.php
}
// SprogValg Virker kun delvist! Første gang opdates sprog kun i lokal rude, 2. gang følger de øvrige med!

function Foot_Links ($maxi=false, $arg='', $doPrint, $doErase, $doLookUp, $doAccept, $doExport, $doImport,$OpslLabl='') { global $ØprogSprog, $ØProgTitl, $Ønovice;
  htm_Rude_Top($name='linkform',$capt='',$parms='',$icon='','panelWmax',__FUNCTION__,'','');
    if (($maxi) and ($OpslLabl>'')) echo '<p align="center"><b>'.tolk('@Handling:').'<b></p>';
    echo '<p align="center">';  #<ic class="fa '.$icon.'" style="font-size:22px;color:green"></ic>
    if ($doPrint)   iconKnap($faicon='fas fa-print',        $title= tolk('@Udskriv')  .' '.$sideObjekt,     $link='../_base/page_Blindgyden.php');
    if ($doErase)   iconKnap($faicon='far fa-minus-square', $title= tolk('@Slet posten'),                   $link='../_base/page_Blindgyden.php'.$goBack);
    if ($doLookUp)  iconKnap($faicon='fas fa-search-plus',  $title= '? '.tolk($OpslLabl),                   $link='../_base/page_Blindgyden.php');
    if ($doAccept)  iconKnap($faicon='far fa-check-square', $title= tolk('@Godkend alt')  .' '.$sideObjekt, $link='../_base/page_Blindgyden.php');
    if ($doExport)  iconKnap($faicon='fas fa-upload',       $title= tolk('@CSV-Export')   .' '.$sideObjekt, $link='../_base/page_Blindgyden.php');
    if ($doImport)  iconKnap($faicon='fas fa-download',     $title= tolk('@Fil import')   .' '.$sideObjekt, $link='../_base/page_Blindgyden.php');
    echo '</p>';
    if ($maxi) { 
      htm_FrstFelt('15%',0,'style="text-align:left;"');  
      htm_NextFelt('20%');    echo '<span style="text-align:left">'.SprogValg($ØprogSprog).'</span>';
      htm_NextFelt('08%');    textKnap($label='@TIPs',  $title='@Her er der nyttige tips, til brugen af SALDI', $link='../_base/page_Tips.php');  // link= 'Tips()');
      htm_NextFelt('16%');    echo '<div style="display:inline-block;">'.$arg.'</div> ';
      htm_NextFelt('16%');    textKnap($label='@Nyheder',  $title='@Her omtales nogle af de nyheder, der er tilføjet i den nye SALDI-€', $link='../_base/page_News.php');
      htm_NextFelt('10%');    echo '<div style="display:inline-block; ">'.htm_accept('@Log ud',tolk('@Log ud og forlad').$ØProgTitl).'</div> ';
      htm_NextFelt('15%');    echo ' ';
      htm_LastFelt();
      echo '<table><tr><td><tc><divline style="margin-left:0.5em">';
#+      userTip();
      if ($Ønovice)
        echo '<small><b>'.tolk('@noTIP:').'</b> '.tolk('@Hold musen over').' <colrlabl>'.tolk('@Blå tekster med skyggeramme, ').
             '</colrlabl>'.tolk('@så får du hjælpetekster og tips.').'</small>';
      echo '</tc></td><td style="text-align:right;">'.
#      '<small><small><i>Design: EV-soft </i></small></small>'.
      '</divline></td></tr></table>';
    }
  htm_RudeBund($pmpt='@Gem',$subm=false,$title='@Gem');
}

// TopMenu-rutiner: (benyttes i Menu_Topdropdown )
// style/css: se filen htm_TopMenu-head.css.htm
function MenuStart($clas='firstmain',$href='#',$labl='',$titl='') {  //  SKAL efterfølges af MenuSlut()
  echo "\n";
  echo '<div id="container" style="display:inline-block;">';
#+ if (logget ind)
    echo '<box style="background:white; border: 1px solid gray; padding-left:4px; padding-right:4px; border-radius:3px; box-shadow: 3px 3px 1px #AAAAAA;">'.
         '<a1 href="../_base/page_Startup.php" target="_self" tiptxt="'.tolk('@Forlad SALDI').str_lf().tolk('@i låst tilstand.').'" style="font-size:14px; color:green;">'.
         '<i class="fas fa-sign-out-alt" style="font-size:16px; color:red" ></i> '.tolk('@Log ud').'</a1></box><br>';
  echo '  <div id="wb_TopMenu" style="position:absolute;left:100px;top:1px;width:1200px;height:24px;z-index:999;">';
  echo '    <ul>';
  echo '      <li class="'.$clas.'" style="width:50px; text-align:left;"><aaa href="'.$href.'" target="_self" tiptxt="'.tolk($titl).'">'.tolk($labl).'</aaa> </li>';
}
function MenuGren($clas='',$href='#',$labl='',$titl='') {
  if ($href=='../_base/page_Blindgyden.php') {$blnd='<i style="font-color:gray;">'; $obs='<small> '.tolk('@påtænkt!').'</small>';} else {$blnd=''; $obs='';};
  if (strpos($labl,'Log ud')>0) {$bold='<bx style="font-color:red; font-weight:800;">'; } else {$bold='';};
  if (strpos($href,'ttp' )>0) $targ='_blank'; else $targ='_self'; //  Test om http forekommer
  $link= 'href="'.$href.'" target="'.$targ.'" title="" tiptxt="'.tolk($titl).'" >'.$blnd.$bold.tolk($labl);
  if ($bold!='') {$link.= '</bx>'.$obs;}
  if ($blnd!='') {$link.= '</i>'.$obs;} else {$link.= $obs;}
  echo "\n\n";
  if ($clas=='withsubmenu') echo '<li><a class="'.$clas.'"    '.$link.'</a>  <ul>';
  if ($clas=='firstitem')   echo '<li    class="'.$clas.'"><a '.$link.'</a> </li>';
  if ($clas=='')            echo '<li>                     <a '.$link.'</a> </li>';
  if ($clas=='lastitem')    echo '<li    class="'.$clas.'"><a '.$link.'</a> </li></ul></li>';
}
function MenuSlut() {global $ØProgRoot, $ØProgTitl, $Øprogvers, $Øcopydate, $Øcopyright, $Ødesigner;
  echo "\n";
  echo '    </ul>';
  echo '';
  echo '  <div style="text-align: center" title="'.$ØProgTitl.' - Version '.$Øprogvers.' - Copyright '.  $Øcopydate.' '.$Øcopyright.' - '.tolk('@Design: ').$Ødesigner.'"><img src= "'.
        $ØProgRoot.'_assets/images/saldi-e50x170.png " alt="Saldi Logo" height="40" width="150" ></div>';
  echo '  <br>';
  echo '  </div>';  //  wb_TopMenu
  echo '</div>';    //  container
  echo "\n";
}

function Menu_Topdropdown($vis_finans=true, $vis_debitor=true, $vis_kreditor=true, $vis_prodkt=false, $vis_lager=true) { //  Menu-placering/størrelse styres i MenuStart()
global $Ødebug, $ØProgTitl;
  MenuStart($clas='firstmain',      $href=''/* '../_base/page_Gittermenu.php' */, $labl='@MENU:',               $titl='Programmets MENU' /* '@Gå til Hovedmenu i gammelt layout' */);
    if ($vis_finans) {
      MenuGren($clas='withsubmenu', $href='#',                                    $labl='@FINANS',              $titl='@Administration af regnskab');
      MenuGren($clas='firstitem',   $href='../_finans/page_Kladdeliste.php',      $labl='@Kasse kladder',       $titl='@Her kan du vælge kassekladde, og redigere den');
      MenuGren($clas='',            $href='../_finans/page_Regnskab.php',         $labl='@Regnskab',            $titl='@Se det aktuelle regnskab her');
      MenuGren($clas='',            $href='../_finans/page_Budget.php',           $labl='@Budget',              $titl='@Se og rediger budget');
      MenuGren($clas='',            $href='../_system/page_Kontoplan.php',        $labl='@Kontoplan',           $titl='@Her vedligeholder du den aktuelle kontoplan');
      MenuGren($clas='',            $href='../_finans/page_Rapport.php',          $labl='@Rapporter',           $titl='@Her vælger du hvad du vil se i en rapport');
      MenuGren($clas='lastitem',    $href='../_finans/page_Kontrol.php',          $labl='@Kontrol spor',        $titl='@Her kan du spore datas oprindelse');
    }      
    if ($vis_debitor) {
    MenuGren($clas='withsubmenu',   $href='#',                                    $labl='@DEBITOR',             $titl='@Her finder du det, der angår dine Kunder');
      MenuGren($clas='firstitem',   $href='../_debitor/page_Opretordre.php',      $labl='@SALG-daglig...',      $titl='@Opret en ny salgs ordre...');
      MenuGren($clas='',            $href='../_debitor/page_Ordreliste.php',      $labl='@Salgs ordrer',        $titl='@Oversigt over ordrer og deres indhold');
      MenuGren($clas='',            $href='../_debitor/page_Debitor.php',         $labl='@Konti',               $titl='@Oversigt over kunder, og leverancer til disse');
      MenuGren($clas='',            $href='../_base/page_Blindgyden.php',         $labl='@Annuller Gebyr',      $titl='@Tilbageføring af rykkergebyr');
      MenuGren($clas='lastitem',    $href='../_debitor/page_Rapport.php',         $labl='@Rapporter',           $titl='@Analyser af salg');
    }      
    if ($vis_kreditor) {
    MenuGren($clas='withsubmenu',   $href='#',                                    $labl='@KREDITOR',            $titl='@Her finder du det, der angår dine Leverandører');
      MenuGren($clas='firstitem',   $href='../_kreditor/page_Ordreliste.php',     $labl='@KØB-daglig...',       $titl='@Opret en ny købs ordre...');
      MenuGren($clas='',            $href='../_kreditor/page_Ordreliste.php',     $labl='@Købs ordrer',         $titl='@Oversigt over leverandører');
      MenuGren($clas='',            $href='../_kreditor/page_Kreditor.php',       $labl='@Konti',               $titl='@Oversigt over kreditorer og oplysninger om disse');
      MenuGren($clas='lastitem',    $href='../_kreditor/page_Rapport.php',        $labl='@Rapporter',           $titl='@Analyser af køb');
        
    }      
    if ($vis_prodkt) { 
      MenuGren($clas='withsubmenu', $href='#',                                    $labl='@PRODUKTION',          $titl='@Rutiner angående produktion');
      MenuGren($clas='lastitem',    $href='../_lager/page_Beholdningsliste.php',  $labl='@Rapporter',           $titl='@Analyser over produktion');
    }
    if ($vis_lager) {
    MenuGren($clas='withsubmenu',   $href='#',                                    $labl='@LAGER',               $titl='@Rutiner angående lagerførte produkter');
      MenuGren($clas='firstitem',   $href='../_lager/page_Varer.php',             $labl='@Vare lager',          $titl='@Oversigt over salgsvarer, samt detaljer på varekort');
      MenuGren($clas='',            $href='../_lager/page_Varemodtagelse.php',    $labl='@Vare modtagelse',     $titl='@Lister for varemodtagelse');
      MenuGren($clas='lastitem',    $href='../_lager/page_Beholdningsliste.php',  $labl='@Rapporter',           $titl='@Analyser af varesalg m.v.');
    }
    if (true) {
    MenuGren($clas='withsubmenu',   $href='#',                                    $labl='@SYSTEM',              $titl='@Her indstiller du programmet og regnskabet');
      MenuGren($clas='firstitem',   $href='../_system/page_Kontoplan.php',        $labl='@Kontoplan',           $titl='@Her vedligeholder du den aktuelle kontoplan');
      MenuGren($clas='withsubmenu', $href='#',                                    $labl='@Indstillinger &nbsp; =>', $titl='@Indstillinger for programmet');
        MenuGren($clas='firstitem', $href='../_system/page_Valuta.php',           $labl='@1. indstil-ofte',     $titl='@Her har du de hyppigst benyttede indstillinger');
        MenuGren($clas='',          $href='../_system/page_Divsetup2.php',        $labl='@2. indstil-flere',    $titl='@Her har du de sjældnere benyttede indstillinger');
        MenuGren($clas='lastitem',  $href='../_system/page_Tilvalgsetup3.php',    $labl='@3. indstil-extra',    $titl='@Her aktiverer og indstiller tilvalgs funktioner');
      MenuGren($clas='',            $href='../_system/page_Backup.php',           $labl='@Sikkerheds kopiering',$titl='@Her kan du sikre dig dine regnskabsdata');
      MenuGren($clas='lastitem',    $href='../_system/page_Licens.php',           $labl='@Om programmet',       $titl='@Her finder du oplysninger om programmet');
      //MenuGren($clas='lastitem',    $href='../_base/page_Blindgyden.php',         $labl='@Log ud',              $titl= tolk('@Log ud og forlad').$ØProgTitl);
    }
    if (true) {
      MenuGren($clas='withsubmenu', $href='#',                                    $labl='@EKSTRA',              $titl='@Bogholderens redskaber');
        MenuGren($clas='firstitem', $href='../_base/page_Blindgyden.php',         $labl='@Lommeregner',         $titl='@Start en simpel kalkulator (strimmelregner)');
        MenuGren($clas='',          $href='../_base/page_Blindgyden.php',         $labl='@Notesblok',           $titl='@Start en simpel skrivemaskine');
        MenuGren($clas='',          $href='../_base/page_Tips.php',               $labl='@Tips',                $titl=tolk('@Her er der nyttige tips, til brugen af').$ØProgTitl);
        MenuGren($clas='',          $href='../_base/page_News.php',               $labl='@Nyheder',             $titl='@Her omtales nogle af de nyheder, der er tilføjet i den nye SALDI-€');
        MenuGren($clas='lastitem',  $href='http://www.ev-soft.dk/saldi-wiki/doku.php?id=saldi:manualen', 
                                                                                  $labl='@DokuWiki - Manual', $titl='@Manual, tips og anden hjælp finder du på'.$ØProgTitl.'-DokuWiki');  
    }
    if ($Ødebug) { 
      MenuGren($clas='withsubmenu', $href='#',                                    $labl='@TOOLS',               $titl='@Udviklerens redskaber');
        MenuGren($clas='firstitem', $href='../_base/_tools/frasescann.php',       $labl='@Frase-skanning',      $titl='@Skanning efter danske fraser, som skal oversættes');
        MenuGren($clas='',          $href='../_base/_tools/funcscann.php',        $labl='@Funktions-skanning',  $titl='@Skanning efter funktions navne, og parametre');
        MenuGren($clas='',          $href='../_base/_tools/docscann.php',         $labl='@Ord-skanning...',     $titl='@Skanning efter et angivet ord, f.eks. $DocFil');
        MenuGren($clas='',          $href='../modulscann.php',                    $labl='@Modul-skanning...',   $titl='@Skanning af alle primære htm/php-filer - vis status mv.');
        MenuGren($clas='',          $href='../pladsforbrug.php',                  $labl='@Mappe-skanning...',   $titl='@Skanning af alle mappers størrelse');
        MenuGren($clas='lastitem',  $href='../_base/page_Printlayout.php',        $labl='@Side test...',        $titl='@Test af sider under udvikling');
    }
  MenuSlut();
}
 
### SPALTER, PANELER m.v.:
// Spalter:
function SpalteTop ($w=240) {dvl_pretty('SpalteTop');  echo '<PanlHead> <div id="wrapper"> <column id="spalt'.$w.'">'; } // SpalteTop spalt240, spalt320 (erkl. i Out_style.css.php)
function NextSpalte($w=320) {echo '</column> <column id="spalt'.$w.'">'; } 
function SpalteBund()       {echo '</column> </div> </PanlHead><div class="clearWrap"/>'; }

// Paneler:
function panelStart() {dvl_pretty('panelStart');  echo '<PanlFoot>';}
function panelSlut()  {echo '</PanlFoot>';}
function skilleLin () {echo '<hr size="10" color="#AA4D00"/>';}

// HTM-Layout-rutiner:
function htm_CentHead($txt='')  {echo '<div style="text-align:center; font-weight:900;"><colrlabl>'.$txt.'</colrlabl></div>';}
function htm_CentrOn($more='')  {echo '<div style="text-align:center; '.$more.'">';}
function htm_CentOff()          {echo '</div>';}
function htm_Spacer($w='30')    {echo '<div1 style= "width:'.$w.'em;">&nbsp; </div1>';}

// En gruppe af elementer på en linie, med en felles overskrift forrest.
function htm_KnapGrup($Pmpt='@Vis:', $Start=true, $ruler=true, $style='text-align:center;') { global $ØbrwnColor;
  if ($Start==true) { if ($ruler) echo '<hr>';
    echo '<div style="margin-left:0.1em; font-weight:normal; color:'.$ØbrwnColor.'; '.$style.'" ><i>'.tolk($Pmpt).'</i> &nbsp;'; // display:inline-block; 
  }
  else  
    echo '</div>';
}

function htm_Ihead($head) {echo '<br/><i>'.$head.'</i> ';}
function htm_hr($c='#0')  {echo '<hr style="color:'.$c.';"/>';}
function htm_nl($rept=1)  {echo str_repeat('<br/>',$rept);}
function htm_lf($rept=1)  {echo str_repeat(' &#xa;',$rept);}  //  LineFeed
function htm_sp($rept=1)  {echo str_repeat('&nbsp;',$rept);}


// Streng-funktioner:
function str_Ihead($head) {return '<br /><i>'.$head.'</i> ';}
function str_hr($c='#0')  {return '<hr style="color:'.$c.';"/>';}
function str_nl($rept=1)  {return str_repeat("<br />",$rept);}
function str_lf($rept=1)  {return str_repeat(' &#xa;',$rept);}  //  LineFeed i strenge  &#010;  &#xa;  \n \u000A  \x0A  &#13;
function str_sp($rept=1)  {return str_repeat('&nbsp;',$rept);}

function isbold($str) {if (strpos(' '.$str,'bold')>0) return 'checked'; else return '';}
function isital($str) {if (strpos(' '.$str,'italic')>0) return 'checked'; else return '';}

  
// Array-funktioner:
function Vis_Data($arr) { //  Vis indhold af en array:
  if ($arr) foreach ($arr as $a) {echo "<br>"; for ($i= 0; $i<= count($a); $i++) echo $a[$i].' '; echo "<br>"; } 
}


# SUPPLERENDE moduler:


//////////////////////////////////////////////////////////////////////////////////////////////////////////
# SPROG system:


function sprogDB_import() { # Filen skal være gemt i UTF-8 format!
  global $ØsprogTabl, $ØlanguageTable, $ØProgRoot, $currDir; //  $ØlanguageTable indeholder ALLE sprog
 // $fp=fopen($fname= $ØProgRoot.$_config.'Sprog_DB.csv',"r");
  $fp=fopen($ØProgRoot.'_config/Sprog_DB.csv',"r");
//  $fp=fopen($currDir.'_config/Sprog_DB.csv',"r");
//  $fp=fopen('../'.'_config/Sprog_DB.csv',"r");
  if ($fp) {  $ØlanguageTable= [];
    while (($line = fgets($fp, 4096)) !== false) { array_push($ØlanguageTable, explode( '","',trim(trim($line),'"'))); }
   fclose($fp); 
  }  
  $x= count($ØlanguageTable);  
  for ($x = 0; $x <= count($ØlanguageTable); $x++) { 
    $str .= trim($ØlanguageTable[$x][0]).'='.$ØlanguageTable[$x][1].'&';
  } $str= trim($str,'&');             # Fjern det sidste &-tegn
  $str = ''.trim(trim($str,','),'"'); # Fjern andre uønskede tegn
  parse_str($str, $ØsprogTabl);       # Dan $sprog-tabel med key og ET sprog
}

} //  Slut på gruppe af functions erklæringer



if (!function_exists('Tolk')) {
  function Tolk($FraseKey) {                              # Tolk() benyttes til sprogoversættelse af alle hard-codede program-tekster.
  global $ØsprogTabl, $ØprogSprog,                   # Fraser med @-prefix er system-tekster, der kan omsættes til andet sprog.
         $ØlanguageTable, $debug;                       # Vær opmærksom på at samme frase, ikke kaldes flere gange f.eks. i rutiner i underniveauer.
if (!function_exists('found_index')) {
  function found_index($sprogDB, $field, $value) {
  if ($sprogDB)
    foreach($sprogDB as $key => $row) {
     if ($row[$field] === $value)  
    {return $key; break;}
  }  return false;  # 'TranslateError';
}}
  #-  {return($FraseKey); exit;}
 if (substr($FraseKey.' ',0,1)!='@') {return($FraseKey); exit;}  # Kan være tolket tidligere!
 if (($ØprogSprog) and ($ØlanguageTable))    
  switch ($ØprogSprog= strtolower($ØprogSprog)) { # 0 Key             
#   case "da" :$result= trim($FraseKey,'@');  break;    # 1 Dansk          da: Vis frasen uden prefix, skal udkommenteres! (ellers lystres ikke brugerrettelser)
    case "da" :$ix= 1;  break;                          # 1 Dansk          sæt index for opslag
    case "en" :$ix= 2;  break;                          # 2 Engelsk        sæt index for opslag
    case "de" :$ix= 3;  break;                          # 3 Deutsch        sæt index for opslag
    case "fr" :$ix= 4;  break;                          # 4 Français       sæt index for opslag
    case "tr" :$ix= 5;  break;                          # 5 Türkçe         sæt index for opslag
    case "pl" :$ix= 6;  break;                          # 6 Polski         sæt index for opslag
    case "es" :$ix= 7;  break;                          # 7 Español        sæt index for opslag
    case "it" :$ix= 8;  break;                          # 8 Italian        sæt index for opslag
                                                        # 9 Grønlandsk       
    default   :{$ix= 1; echo "<colrlabl>Sprog?:".$ØprogSprog." </colrlabl>"; $ØprogSprog='da'; break;} // Er $ØprogSprog ugyldigt, sættes det til 'da'
  } else $ix= 1;
  $TblRow= found_index($ØlanguageTable, 0, $FraseKey);
  if (substr($FraseKey,0,2)=='@:') {};                                    # Er frasen med @:-prefix: (Angår blanketter/formularer) ikke benyttet endnu!
  if (substr($FraseKey,0,1)=='@')                                         # Er frasen med @-prefix:
       {if ($ØprogSprog=='da')  {$result= trim($FraseKey,'@');}        #   Er sproget dansk fjernes @-prefix blot i resultatet, skal udkommenteres!
        else if ($TblRow>0) {$result= $ØlanguageTable[$TblRow][$ix];}     #   ellers slås op i sprogtabellen
        else 
        if ($debug) {$result= trim($FraseKey,'@');}
        else #{$result= $FraseKey.'<small><small> (Danish!)</small></small>'; $MissingFrase.='<br>'.$FraseKey;} # Oversættelse mangler: Vis $FraseKey  med @-prefix
          {$result= trim($FraseKey,'@');}
       }  
  else {$result= $FraseKey;}                                              # Fraser uden @-prefix returneres uændret.
  return($result= trim($result,',"'));
  }
}
//  PLAN: Opdeling så fraser ang. blanketter, holdes adskilt fra programfladens fraser, f.eks. med prefix: @:
//  eller de håndteres i DB-tabeller.

# OBS!  Benyt konsekvent prefix: '@ ikke: "@ så alle fraser kan udtrækkes automatisk!
# Oversættelsen sker automatisk i BASISMODULER med tolk(), når parametre behandles.
# I sjældne tilfælde (lange eller sammensatte tekster), er det nødvendigt at benytte tolk() lokalt.
# Undgå forkortelser og sammensatte ord, som kan forringe oversættelse og liniewrap.
# Undgå indledende og afsluttende SPACE, og <HTML> koder i fraser. Benyt @@ hvis en frase skal starte med @
# Undgå SPACE+SPACE som vil blive ændret til SPACE, og bringe uorden i frasens længde.
# Koder som <br> og &#xa; (svt. LF) bringer også uorden i frasens længde.
# Tegnet: " må ikke forekomme i fraser, det korrumperer csv-formatet. Benyt f.eks. ' i stedet.
//////////////////////////////////////////////////////////////////////////////////////////////////////////

# Specielle dynamiske fraser som ellers ikke forekommer direkte i kildetekster (dannet automatisk f.eks. med periodeoverskrifter() ):
//  '@Skyldig moms i alt'
//  '@Jan'  '@Feb'  '@Mar'  '@Apr'  '@Maj'  '@Jun'  '@Jul'  '@Aug'  '@Sep'  '@Okt'  '@Nov'  '@Dec'
//  '@Januar 2017 (1. regnskabsmåned i regnskabsåret 2017)' $periode_lang er dynamisk og kan ikke tolkes!!!
//  
//////////////////////////////////////////////////////////////////////////////////////////////////////////
# htm_ rutiner:


 if (!function_exists('htm_HiddVari')) 
{ // Start på gruppe af functions erklæringer:  Forebyg gentagne læsninger!

//- function htm_HiddVari($name='',$val='') {
//-   if ($val=='') {$val= $name;  global $$val; $valu= $$val; } else $valu= $val;
//-   echo "\n<input type='hidden' name='$name' value='$valu'>";
//- }
function htm_HiddVari($name='',$val='') {
  if ($val=='') {$val= $name;  global $$val; $valu= $$val; } else $valu= $val;
  echo '<input type="hidden" name="'.$name.'" value="'.$valu.'">';
}
function htm_NullVariabler($namelist=['']) { foreach ($namelist as $name) {global $$name; $name = NULL; }}
function htm_GetVariabler($namelist=[''])  { foreach ($namelist as $name) {global $$name; $name = Øif_isset($_GET[$name]); }}
function htm_PostVariabler($namelist=['']) { foreach ($namelist as $name) {global $$name; $name = Øif_isset($_POST[$name]); }}
function pushed($name) { return (isset($_POST[$name])); } //  En submit-knap er aktiveret
//  function var_PostSet($name) { if (isset($_POST[$name])) $$name=  $_POST[$name]; }
 
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//        Generering af diverse lister:
$kontoTypeListe= array(['H','@Overskrift'],['D','@Drift'],['S','@Status'],['Z','@Sum'],['R','@Resultat'],['X','@Sideskift'],['L','@Lukket']);

$momsKodeListe= array(['K','@Købsmoms'],['S','@Salgsmoms'],['Y','@Ydelsesmoms'],['E','@EU-varemoms']);

$artsKodeListe= array(['VG','@VareGruppe'],['DG','@DebitorGruppe'],['KG','@KreditorGruppe'],['VPG','@yyy'],['VTG','@yyy'],['VRG','@yyy'],
                      ['SM','@SalgsMomskonto'],['VK','@ValutaKoder'],['PRJ','@Projekter'],['YM','@YdelsesMomskonto-udland'],
                      ['EM','@VareMomskonto-udland'],['KM','@KøbsMomskonto'],['SD','@SamlekontoDebitor'],
                      ['KD','@KreditorSamlekonto'],['RA','@Regnskabsår'],['PV','@yyy'],['LG','@LagerGrupper'],
                      ['S','@yyy'],['MR','@MomsRapportkonto'],['xx','@yyy']);

# Diverse lister: [@Tip_Tekst, Value, Label]
#function JustListe () {return( [['@V: Venstre justeret','V','V/L'],['@C: Center justeret','C','C'],['@H: Højre justeret','H','H/R']] ); }
function JustListe () {return( [['@V: Venstre justeret','V','V'],['@C: Center justeret','C','C'],['@H: Højre justeret','H','H']] ); }
function FartListe () {return( [['@0: Generelt - f.eks. papirformat','0','@0: Generelt'],['@1: Grafik= Linier og billeder','1','@1: Grafik'],
                                ['@2: Tekster og variabelnavne ($)','2','@2: Tekster'],['@3: Ordrelinier - Gentagende linier på sidens midte (£)','3','@3: Ordrelinier'],
                                ['@5: Mail tekst - Emne og Beskedtekst i mail forsendelse','5','@5: Mail tekst']] ); }
function SideListe () {return( [['@Alle sider','A','@A: Alle sider',''],['@Kun første side','1','@1: Kun første side',''],['@IKKE første side','!1','@!1: IKKE første side',''],
                                ['@Kun sidste side','S','@S: Kun sidste side',''],['@IKKE sidste side','!S','@!S: IKKE sidste side','']] ); }
function Side_List () {return( [['@Alle sider','A','A'],['@Kun første side','1','1'],['@IKKE første side','!1','!1'],
                                ['@Kun sidste side','S','S'],['@IKKE sidste side','!S','!S']] ); }
function FontListe () {return( [['@Sans-serif','Helvetica','Helvetica'],['@Serif','Times','Times'],['@Optisk Læsbar','OCRbb12','OCRbb12']] ); }
function KontListe () {return( [['@Drifts konto','D','D'],['@Status konto','S','S'],['@Sum konto','Z','Z'],['@Overskrift (system!)','H','H'],
                                ['@Resultat konto','R','R'],['@Sideskift (system!)','X','X'],['@Lukket konto','L','L']] ); }
function MomsListe () {return( [['@Købs-moms','K1','K1'],['@Salgs-moms','S1','S1'],['@Ydelses-moms','Y1','Y1'],['@EU-moms?','E1','E1']] ); }
function ValuListe () {return( [['@Danske kroner','DKK','DKK'],['@Euro','EUR','EUR'],['@US dollar','$','$'],['@Engelsk pund','£','£']] ); }
function StatListe () {return( [['@Aktiv','1','Aktiv'],['@Lukket','0','Lukket']] ); }
function Aar_Liste () {return( [['2016','2016','2016'],['2017','2017','2017'],['2018','2018','2018']] ); }
function Grp0Liste () {return( [['@Alle ','0','@0. Alle','']] ); }
function Grp1Liste () {return( [['@Ydelser ','1','@1. Ydelser',''],['@Handelsvarer','2','@2. Handelsvarer',''],
                                ['@Forbrugsvarer', '3','@3. Forbrugsvarer',''],['@Fragt/Porto','4','@4. Fragt/Porto','']] ); }
function Grp_Liste () {return( [['@Alle ','0','@0. Alle',''],['@Ydelser ','1','@1. Ydelser',''],['@Handelsvarer','2','@2. Handelsvarer',''],
                                ['@Forbrugsvarer', '3','@3. Forbrugsvarer',''],['@Fragt/Porto','4','@4. Fragt/Porto','']] ); }
function PageListe () {return( [['@A5-Højformat ','A5-portrait','A5-p'],['@A5-bredformat ','A5-landscape','A5-l'],['@A4-Højformat ','A4-portrait','A4-p'],
                                ['@A4-bredformat ','A4-landscape','A4-l'],['@A3-Højformat ','A3-portrait','A3-p'],['@A3-bredformat ','A3-landscape','A3-l']] ); }
function PaprListe () {return( [['@A5 Højformat: H:210mm B:148mm', 'A5p', '@A5 portrait',''],
                                ['@A5 Bredformat: H:148mm B:210mm','A5l', '@A5 landscape',''],
                                ['@A4 Højformat: H:297mm B:210mm', 'A4p', '@A4 portrait',''],
                                ['@A4 Bredformat: H:210mm B:297mm','A4l', '@A4 landscape',''],
                                ['@A3 Højformat: H:420mm B:297mm', 'A3p', '@A3 portrait',''],
                                ['@A3 Bredformat: H:297mm B:420mm','A3l', '@A3 landscape','']] ); }
function FormObjkt () {return( [['@Side layout og placering af ordrelinier',                    '0:Layout',       '@Layout'],
                                ['@Tekster og variabler med data',                              '1:Tekster',      '@Tekster'],
                                ['@Grafiske streger og logo-billede',                           '2:Linjer',       '@Grafik'],
                                ['@Gentagne ordre- eller specikations-linier på siders midte',  '3:Ordrelinjer',  '@Ordrelinjer'],
                                ['@Emne og besked benyttet til mailforsendelse',                '5:Mail tekst',   '@Mail tekst']] ); }
# Ikke færdige:                     
function RabtListe () {return( [['@Venstre ','V','V'],['@Center ','C','C'],['@Højre ','H','H']] ); }
function PrisListe () {return( [['@Venstre ','V','V'],['@Center ','C','C'],['@Højre ','H','H']] ); }
function TilbListe () {return( [['@Venstre ','V','V'],['@Center ','C','C'],['@Højre ','H','H']] ); }
function X1xxListe () {return( [['@Venstre ','V','V'],['@Center ','C','C'],['@Højre ','H','H']] ); }
function XxxxListe () {return( [['@Venstre ','V','V'],['@Center ','C','C'],['@Højre ','H','H']] ); }

function Art_Liste () {return( [
             ['@Kontokort med moms','kontokort_moms','@Kontokort med moms'],
             ['@Kontokort','kontokort','@Kontokort'],
             ['@Balance','balance','@Balance'],
             ['@Resultat/budget','resultatb','@Resultat/budget'],
             ['@Resultat','resultat', '@Resultat'],
             ['@Budget','budget','@Budget'],
             ['@Momsangivelse','momsangivelse','@Momsangivelse'],
             ['@Månedsliste','maanedsliste','@Månedsliste']
            ] ); }

function ERH_Liste () {return( [
             ['@ERH351',  'ERH351',   '@ERH351 = FI kort 71'] ,
             ['@ERH352',  'ERH352',   '@ERH352 = FI kort 04 & 15'],
             ['@ERH354',  'ERH354',   '@ERH354 = FI kort 01 & 41'],
             ['@ERH355',  'ERH355',   '@ERH355 = Bankoverf. med straks advisering'],
             ['@ERH356',  'ERH356',   '@ERH356 = Bankoverf. med normal advisering'],
             ['@ERH357',  'ERH357',   '@ERH357 = FI kort 73'],
             ['@ERH358',  'ERH358',   '@ERH358 = FI kort 75'],
             ['@ERH400',  'ERH400',   '@ERH400 = Udenlandsk overførsel'],
             ['@SDC3'  ,  'SDC3'  ,   '@SDC3 = Bankoverf. med kort advisering'],
             ['@SDCK020', 'SDCK020',  '@SDCK020 = FI-kort 71 (SDC)']
            ] ); }

function FRM_Liste () {return( [
            ['@1: Tilbuds blanket',              '1', '@1: Tilbud',''],
            ['@2: formular for ordrebekræftelse','2', '@2: Ordrebekræftelse',''],
            ['@3: følgeseddel blanket',          '3', '@3: Følgeseddel',''],
            ['@4: faktura blanket',              '4', '@4: Faktura',''],
            ['@5: blanket for kreditnota',       '5', '@5: Kreditnota',''],
            ['@6: blanket for 1. rykker',        '6', '@6: Rykker 1',''],
            ['@7: blanket for 2. rykker',        '7', '@7: Rykker 2',''],
            ['@8: blanket for 3. rykker',        '8', '@8: Rykker 3',''],
            ['@9: Plukliste',                    '9', '@9: Plukliste',''],
          # ['@10: POS (Point of Sale ),         '10', '@10: POS (Kasse)',''],   // Point of Sale (POS) 
            ['@11: blanket for kontokort',       '11', '@11: Kontokort',''],
            ['@12: blanket for indkøbsforslag',  '12', '@12: Indkøbsforslag',''],
            ['@13: blanket for rekvisition',     '13', '@13: Rekvisition',''],
            ['@14: blanket for købsfaktura',     '14', '@14: Købsfaktura','']
          ]  ); }   
            
function ShowCol($liste,$col,$sep) { $result=$sep; // Vis en kolonne fra en liste
  foreach ($liste as $row) { $result.= tolk($row[$col]).$sep; }
  return $result;
}

function ListLookup($liste,$search,$colsearch,$colresult) { $result=''; //  Returner en kolonne fra en liste på grundlag af en anden kolonne
  foreach ($liste as $row) {if ($row[$colsearch]==$search) {$result= $row[$colresult]; break;} }
  return $result;
}

function SPR_Liste () {return( [ # [0]:Tip [1]:value [2]:Text  [3]:events
      ['Vælg dansk sprog',               'da','Dansk',    ],  //  Redigeres noget her, skal der også redigeres i Rude_LanguageJuster()
      ['Select English language',        'en','English',  ],
      ['Wählen Sie deutsche Sprache',    'de','Deutsch',  ],
      ['Choisissez la langue française', 'fr','Français', ],
      ['Türk Dili seçin',                'tr','Türkçe',   ],
      ['Wybierz język duński',           'pl','Polski',   ],  //  pl-PL Polish (Poland)
      ['Elegir el idioma español',       'es','Español',  ],
      ['Selezionare la lingua italiana', 'it','Italian'   ]
    ]  ); }   
       
## Husk at funktionen Tolk('@fraser') skal benyttes i kald til @fraser!

// Variabler med prefix: $Ø_ benyttes globalt!

function DanListe($listen,$suff='') {
    $result=[]; $ix=0; foreach ($listen as $elem) array_push($result,[tolk($elem).$suff,$ix++,tolk($elem)]); return($result);  # : [Tip Tekst, Value, Label]
//  $result=[]; $ix=0; foreach ($listen as $elem) array_push($result,[$elem.$suff,$ix++,$elem]); return($result);  # : [Tip Tekst, Value, Label]
}
// Følgende variabler med prefix: $Ø_ er beregnet til global anvendelse. Husk erklæring: global $Ø_varname når de skal kaldes i lokalt scope.
  $mdr= ['@januar','@februar','@marts','@april','@maj','@juni','@juli','@august','@september','@oktober','@november','@december'];
  $Ø_MdrList= DanListe($mdr, ' '.tolk('@måned'));   # tolk() erklæres først i out_base!

  $dag= ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'];
  $Ø_DagList= DanListe($dag, '. '.tolk('@dag i måneden'));

} //  Slut på gruppe af functions erklæringer


### DIVERSE LISTER:

# SUB-FUNCTION:
if (!function_exists('FormVars')) {
function FormVars($form_nr) { # Returner alle de felter, som er relevante for en given formular
  $result= ['eget_firmanavn', 'egen_addr1', 'egen_addr2', 'eget_postnr', 'eget_bynavn', 'eget_land', 'eget_cvrnr', 'egen_tlf', 'egen_fax', 'egen_bank_navn', 'egen_bank_reg', 'egen_bank_konto', 'egen_email', 'egen_web'];
  if ($form_nr<6  || $form_nr==10 || $form_nr>=12) { $result= array_merge($result, ['ansat_initialer', 'ansat_navn', 'ansat_addr1', 'ansat_addr2', 'ansat_postnr', 'ansat_by', 'ansat_email', 'ansat_mobil', 'ansat_tlf', 'ansat_fax', 'ansat_privattlf']);
  } elseif ($form_nr==11) { $result= array_merge($result, ['adresser_firmanavn', 'adresser_addr1', 'adresser_addr2', 'adresser_postnr', 'adresser_bynavn', 'adresser_land', 'adresser_kontakt', 'adresser_cvrnr']); } 
  if ($form_nr!=11) { $result= array_merge($result, ['ordre_firmanavn', 'ordre_addr1', 'ordre_addr2', 'ordre_postnr', 'ordre_bynavn', 'ordre_land', 'ordre_kontakt', 'ordre_cvrnr']); }
  if ($form_nr<6 || $form_nr==10 || $form_nr>=12) {
    $result= array_merge($result, ['ordre_ordredate', 'ordre_levdate', 'ordre_notes', 'ordre_ordrenr', 'ordre_momssats', 'ordre_kundeordnr', 'ordre_projekt', 'ordre_lev_navn', 
                                   'ordre_lev_addr1', 'ordre_lev_addr2', 'ordre_lev_postnr', 'ordre_lev_bynavn', 'ordre_lev_kontakt', 'ordre_ean', 'ordre_institution', 'ordre_lev_kontakt']);
  }
  if ($form_nr==4 || $form_nr==13) { $result= array_merge($result, ['ordre_fakturanr', 'ordre_fakturadate']); };   
  $result= array_merge($result, ['formular_side', 'formular_nextside', 'formular_preside', 'formular_transportsum', 'formular_betalingsid(9,5)']);
  if ($form_nr<6 || $form_nr==10 || $form_nr>=12) { $result= array_merge($result, ['formular_moms', 'formular_momsgrundlag']);  } 
  $result= array_merge($result, ['formular_ialt']);
  if ($form_nr==3) { $result= array_merge($result, ['levering_lev_nr', 'levering_salgsdate']);  } 
  if ($form_nr>=6) { $result= array_merge($result, ['forfalden_sum', 'rykker_gebyr']);  } 
//  if ($form_nr>1 && $form_nr<6) print "<option value = \"kopier_alt|1\">Kopier alt fra tilbud, 
//  if ($form_nr!=2 && $form_nr<6) print "<option value = \"kopier_alt|2\">Kopier alt fra ordrebrkræftelse, 
//  if ($form_nr!=4 && $form_nr<6) print "<option value = \"kopier_alt|4\">Kopier alt fra faktura, 
//  if ($form_nr<5) print "<option value = \"kopier_alt|5\">Kopier alt fra kreditnota,
  
  $r= $result;  $result= array();
  foreach ($r as $rec) {$result= array_merge($result, array([$rec,'$'.$rec,'$'.$rec]));}
  return $result;
}}

# SUB-FUNCTION:
if (!function_exists('OrdrVars')) {
function OrdrVars($form_nr) { # Returner alle de felter, som er relevante for en given formular
  $result= [];
    if ($form_nr<6 || $form_nr==9 || ($form_nr>=12 && $form_nr<=14)) 
      $result= array_merge($result, ['posnr', 'varenr', 'lev_varenr', 'antal', 'enhed', 'beskrivelse', 'pris', 'rabat', 'momssats', 'procent', 'linjemoms', 'varemomssats', 'linjesum', 'projekt'] );
    if ($form_nr==3)   $result= array_merge($result, ['lev_tidl_lev', 'lev_antal', 'lev_rest', 'lokation'] );
    if ($form_nr==9)   $result= array_merge($result, ['leveres', 'lokation', 'Fri tekst'] );
    if ($form_nr==11) {$result= array_merge($result, ['beskrivelse', 'dato', 'debet', 'faktnr', 'forfaldsdato', 'kredit', 'saldo'] ); }
    else              {$result= array_merge($result, ['dato', 'faktnr', 'beskrivelse', 'beløb'] ); }

  $r= $result;  $result= array();
  foreach ($r as $rec) {$result= array_merge($result, array([$rec,'£'.$rec,'£'.$rec]));}
  return $result;
}}

$VareVars= [['@Vare beskrivelse','$beskrivelse','$beskrivelse'],['@Varens pris ialt','$pris','$pris'],['@Varens enhedspris','$enhedspris','$enhedspris'],
              ['@Vare enhed','$enhed','$enhed'],['@Varebillede','$img','$img'],['@Stregkode med varenummer','$stregkode','$stregkode'],['@Vare nummer','$varenr','$varenr',]];

              
/*  


OM systemet:
 Al output til skærm, sker via centrale rutiner, som er blok-struktureret, så rettelser kun skal
 udføres et minimum steder. [out_base.php]
 Hvor der i koden benyttes: "echo" skal det vurderes, om subrutiner kan benyttes, eller skal oprettes.
 
 Alle vinduer opbygges af ruder (paneler), som alle er defineret i [out_ruder.php]
 Ruders titel består af en icon og en tekst, og de har ofte en Gem/opdater-knap i bunden.
 Alle HTML-sider initieres med filen [htm_pagePrepare.php] og afsluttes med [htm_pageFinalize.php]
 
 Adaptive layout ved Skærmbredde[px]:
 < 320    : 1 spalte med fast bredde.
 320.. 640: 1 spalte med varierende bredde.
 640..1000: 1 spalte med varierende bredde.
 > 1000   : 3-spaltet layout.
 
 Tip vises ved mus over tydeligt markeret label, som ikke optager selvstændig plads, men er indeholdt i input-felt.
 Der er konsekvent angivet tip for: Knapper for navigation, Knapper for funktioner, Kolonne-overskrifter, Titler, m.fl.
 Der kan angives tast-genveje for alle knapper/links
 
 Mange tabeller er med fast vindueshøjde, så overskrifter over og knapper under tabellen, altid kan være synlige.
 Der er grundlæggende 2 tabel-rutiner: KunSeData (htm_TabelOut) og SeOgRetData (htm_TabelInp). Budget benytter en skræddersyet version.
 Tabeller kan med flag akti-/deaktivere: Filter, Sortering, Opret ny record
 
 Alle labels og tip kan oversættes til et andet program-sprog (7 europæiske sprog), 
 med nem opdatering af alle forekommende fraser, når prefix: '@ er benyttet.
 Fraselængden for dansk bør pt. begrænses til max. 200 tegn.
 Er der længere fraser, skal de opdeles i flere, ved at indskyde >'.'@< i frasen,
 på et hensigsmæssig sted (ny sætning) for ikke at sabotere sprogoversættelse.
 Tegn der ikke må benyttes: < > " @ (udover prefixet)' fordi de mistolkes!
 Formaterings tags som: </small> fjernes. De skal i stedet indeholdes i selvstændige strenge omkring fraser.
 Slut ikke en frase med SPACE, da den kan blive fjernet, og key passer da ikke!
 Brugeren kan selv korrigere sprog-tekster i regneark. Finjustering kan også udføres i programmet.
 
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
 
 CSS-layout:
 Farver, placeringer. tekststørrelser m.v. kan justeres centralt i CSS-fil. [out_style.css.php]
 
 Der er mulighed for assistance til fejlfinding, når flaget (debug==true)
 
 Systemet omfatter pt. følgende filer:
 page_Layoutdemo.php      - Demo af systemet
 out_javascr.js           - Systemets javascript
 out_style.php (.css)     - Systemets CSS
 out_base.php             - Systemets Modulære Grundsystem
 out_ruder.php            - Systemets Paneler med PROGRAM-moduler
 out_vinduer.php          - Systemets vinduer opbygget af flere Paneler
 user_interface.php       - Modulært Grundsystem
 frasescann.php           - Skanner efter fraser i alle projektfiler, men gemmer pt. kun dem i: user_interface.php og page_Layoutdemo.php
 Sprog_DB.csv             - Importfil, hvor alle sprogvarianter samles manuelt (copy/paste), med hjælp af Google-translate.
 
 I programmets tekster benyttes følgende tegn-prefixer:
 @xxx i starten af fraser, som skal kunne udskifter med fremmedsprog
 $xxx i tekster til formularer, hvor de angiver et variabelnavn
 £xxx i vare-tekster til formularer, hvor de angiver et variabelnavn
 
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
  -function validatePassword(){
    if(password.value != confirm_password.value) 
      {confirm_password.setCustomValidity("Passwords Don't Match"); } 
    else {confirm_password.setCustomValidity('');   }
  }
  password.onchange = validatePassword;
  confirm_password.onkeyup = validatePassword;
</script>
 */
 
//  Uløste problemer:
//  msg_Dialog() - har nogle uforklarlige begrænsninger, når man flytter vinduet sideværts.
//   
//  Sprogskift virker først, når man har skiftet 2 gange.
//   
//  Tips-knap ang. browser-taster, virker ikke.
//   
//  Tip for begyndere kan ikke skiftes.
//   
//   
//   
//   
//   
//   
?>
