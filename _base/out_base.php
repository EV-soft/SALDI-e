<?php   $DocFil1= '../_base/out_base.php';    $DocVer1='5.0.0';    $DocRev1='2017-02-00';     $modulnr1=0; 
/* ## FORMÅL: Grundbibliotek for kontruktion af moduler, angående udskrivning til skærm. 
 *             ___   _   _    ___  _         
 *            / __| / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            |___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
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
 * Copyright (c) 2004-2017 Saldi.dk ApS 
 * ----------------------------------------------------------------------
 *
 * ## AFHÆNGIGHED:
 * out_base.php er afhængig af: out_init.php og out_style.css.php
 * 
 * htm_*.php  - Grundmoduler (htm_*) egnet for adaptive skærm-output.
 * out_*.php  - Modulerne benyttes KUN i out_ruder.php, hvor system-paneler (ruder) opbygges.
 * out_*.php  - Ruder spalte-opsættes efterfølgende i out_vinduer.php, som er de vinduer brugeren oplever. 
 * page_*.php - Sider bestående af mange vinduer gemmes i filer med prefix: page_*.php f.eks.: page_Layoutdemo.php
 * 
 * ## NOTER:
 * Disse filer er redigeret med tabulator sat til 2 tegn, og ses bedst med det.
 * Fremover tilstræbes det at benytte 2*SPACE i stedet for TAB, som ikke kan justeres på Github.

 * VIGTIGT: Kilde-filer skal gemmes i UTF-8 format uden BOM!  (for ikke konstant at konververe fra ANSI til UTF-8)
 * Givagt: Filnavne er følsomme overfor store/små bogstaver. For læsbarhed er første ord i et filnavn angivet med stort!
 *   f.eks: page_Kladdeliste.php. - PHP-rutiners navne er ufølsomme...
 *
 * StrengAdskiller: Primært benyttes '-tegnet som PHP-tekstafgrænser, og "-tegnet som HTML-tekstafgrænser.
 *   Herved minimeres nødvendigheden af ESC-tegnet: \ og kildetekster bliver mere læsbare.
 *   Eks.: echo '<input type= "hidden" id= "'.$id.'" name= "'.$name.'" value= "'.$valu.'" />';
 *
 * Af hensyn til søg/erstat mulighed, tilstræbes det at benytte "separatorer" og SPACE således: 
 *   $variabel= ['x', 'y', 'z']; dvs. Ingen SPACE foran og en SPACE efter separator/operator. Ikke paranteser.
 *   Kun i lange sekvenser udelades SPACE efter.
 *
 * Funktions-parametre:
 *   Variabelnavne kan udelades i funktions-parametre, men er medtaget for tydeliggørelse, for andre end forfatteren.
 *   Ofte er alle variabler angivet, selvom default-værdier benyttes. Også dette er af hensyn til andres forståelse.
 *   Eks: htm_OptioFlt($type='text', $name='name', $valu= 'Leverandør', $labl='@Leverandør', $titl='@Leverandør', $revi=true, $optlist=[], $action='onchange="getComboA(this)"');
 *   Kunne simplificeres
 *   til: htm_OptioFlt('text', 'name', 'Leverandør', '@Leverandør', '@Leverandør'); --- hvis $revi og flg. er standard
 *
 * Repeter jævnligt disse regler, og efterlev dem, så der opnås ensartethed i kildefilerne!!!
 *
 * ## REVISIONER:
 * 2016.08.00 ev - EV-soft : 1. udgave af filen                                                     
                                                                                                    
 * ***** Grundlæggende Rutiner for layout og visning af data ***************************************

 * ## include("../_base/out_init.php");  // Skal kaldes forinden. (sker i htm_pageHead.php)
 * if ($GLOBALS["$Ødebug"]) debug_log($DocVer1,$DocRev1,$modulnr1,$DocFil1,'');
 * echo "\n<!-- $DocVer1  $DocRev1  $modulnr1  $DocFil1 -->\n";
 */
 
global $ØProgRoot;

if (!function_exists('msg_Dialog')) {
  include($ØProgRoot.$_base.'msg_lib.php');};  

function pretty($testlabl='') {global $Ødebug;
  if ($Ødebug) {echo "\n"; if ($testlabl>'') echo '<!-- '.$testlabl.': -->'."\n";}
} // Indsæt linieskift og evt. label, i den dannede html-kode, så kildekode bliver mere læsbar

# BASISGRANUL:
function Lbl_Tip($lbl,$tip,$plc='',$h='11px') { if ($lbl=='') return ''; else {
    pretty('Lbl_Tip');
    if ($h=='0px') {$h='';}
    switch (strtoupper($plc)) {
      case "W":  $class= 'tooltipL';  break;    # Plac. TV
      case "S":  $class= 'tooltipB';  break;    # Plac. Under
      case "O":  $class= 'tooltipR';  break;    # Plac. TH
      case "N":  $class= 'tooltipT';  break;    # Plac. Over
      case "SW": $class= 'tooltipB1'; break;    # Plac. Retning SW
      case "SO": $class= 'tooltipB2'; break;    # Plac. Retning SØ
      default :  $class= 'tooltiptext'; # Plac. Over
    }
    return '<div class="tooltip" style="height:'.$h.';">'.ucfirst(tolk($lbl)).'<span class="'.$class.'">'.tolk($tip).'</span></div>';
  }
}

# BASISMODUL for data-visning, label, titelTip og input:     ($more giver mulighed for at benytte parametre, som ikke er forud defineret.) // Ændret rækkefølge: $labl ,$titl
function htm_CombFelt($type='',$name='',$valu='',$labl='',$titl='',$revi=true,$rows='2',$width='',$step='',$more='',$plho='')   # Inputfelt kombineret med label
{global $ØblueColor;
  pretty('htm_CombFelt');
  $LablTip= Lbl_Tip($labl,$titl); 
  $eventInvalid= 'oninvalid="this.setCustomValidity(\''.tolk('@Angiv ').tolk($labl).'! '.'\')"';
  if (gettype($valu)== 'Float') $type= 'number' ; 
  if ($revi==true) $aktiv= ''; else $aktiv='disabled';
  if ($type== 'date') //  Firefox: supporterer ikke picker! men disse gør: Opera, Vivaldi, Chrome... (dec.2016)
    echo '<div class="lablInput"> <input type= "date" '.$more.' id="'.$name.'" name="'.$name.'" style="line-height:100%; font-size:smaller; height:14px;" value="'.$valu.
    '" placeholder="åååå-mm-dd"  '.$aktiv.' />  <label for="'.$name.'">'.$LablTip.'</label> </div>';
  if (($name=='posi') or ($name=='antal')) {$align= 'style="text-align:center";';} else $align= ''; //  smaller fordi browser input, er voldsomt bredt!

  if ($type== 'text') 
    echo '<div class="lablInput"> <input type= "text" '.$more.' width="'.$width.'" id="'.$name.'" name="'.$name.'" '.$align.' style="line-height:100%;" value="'.$valu.
    '" '.$eventInvalid.' '.$aktiv.' placeholder="'.$plho.'" /> <label for="'.$name.'">'.$LablTip.'</label> </div>';
      
  if ($type== 'tal1d')  # Antal
    echo '<div class="lablInput"> <input type= "text" '.$more.' style="text-align:right; line-height:100%;" width="'.$width.'" id="'.$name.'" name="'.$name.
    '" value="'.number_format($valu*1,1,',','.').'";  '.$eventInvalid.' '.$aktiv.' placeholder="'.$plho.'"  pattern="^\d*\.?((25)|(50)|(5)|(75)|(0)|(00))?$" /> <label for="'.$name.
    '">'.$LablTip.'</label> </div>';
  
  if ($type== 'tal2d')  # Beløb og %
    echo '<div class="lablInput"> <input type= "text" '.$more.' style="text-align:right; line-height:100%;" width="'.$width.'" id="'.$name.'" name="'.$name.
    '" value="'.number_format($valu*1,2,',','.').'";  '.$eventInvalid.' '.$aktiv.' placeholder="'.$plho.'"  pattern="^\d*\.?((25)|(50)|(5)|(75)|(0)|(00))?$" /> <label for="'.$name.
    '">'.$LablTip.'</label> </div>';
  
  if ($type== 'tal2dc')  # Beløb og % - centerplaceret
    echo '<div class="lablInput"> <input type= "text" '.$more.' style="text-align:center; line-height:100%;" width="'.$width.'" id="'.$name.'" name="'.$name.
    '" value="'.number_format($valu*1,2,',','.').'";  '.$eventInvalid.' '.$aktiv.' placeholder="'.$plho.'"  pattern="^\d*\.?((25)|(50)|(5)|(75)|(0)|(00))?$" /> <label for="'.$name.
    '">'.$LablTip.'</label> </div>';
  
  if ($type== 'number')   /* lang="en" for at tillade "."-tegn som decimal adskiller, foruden dansk ,-tegn */
    echo '<div class="lablInput"> <input type= "number" '.$more.' lang="en" style="text-align: right; line-height:100%;" width="'.$width.'" step="'.$step.'" id="'.$name.
    '" name="'.$name.'" value="'.$valu.'"; '.$eventInvalid.' '.$aktiv.' placeholder="'.$plho.'" pattern="(\d{3})([\.])(\d{2})" />  <label for="'.$name.'">'.$LablTip.'</label> </div>';
    
  if ($type== 'numberL')   /* lang="en" for at tillade "."-tegn som decimal adskiller, foruden dansk ,-tegn */
    echo '<div class="lablInput"> <input type= "number" '.$more.' lang="en" style="text-align: left; line-height:100%;" width="'.$width.'" step="'.$step.'" id="'.$name.
    '" name="'.$name.'" value="'.$valu.'"; '.$eventInvalid.' '.$aktiv.' placeholder="'.$plho.'" pattern="(\d{3})([\.])(\d{2})" />  <label for="'.$name.'">'.$LablTip.'</label> </div>';
    
  if ($type== 'radio')  // Skræddersyet !
    echo '<form action=""><div>&nbsp; <small>'. // Nestet form!
    '<colrlabl>'.$LablTip.':</colrlabl >  '.
    '<input type= "radio" name="'.$name.'" value="privat"> '.   tolk('@Privat').
    ' &nbsp; <font style="color:'.$ØblueColor.'">'.             tolk('@eller').':</font>'.
    '<input type= "radio" name="'.$name.'" value="erhverv"> '.  tolk('@Erhverv').
    '</small></div> </form>';

  if ($type== 'password') 
    echo '<div class="lablInput"> <input type= "password" '.$more.' width="'.$width.'" id="'.$name.'" name="'.$name.'" style="line-height:100%" value="'.$valu.'" '
      .$eventInvalid.' '.$aktiv.' placeholder="'.$plho.'" /> <label for="'.$name.'">'.$LablTip.'</label> </div>';
  
  if ($type== 'passwordpower')  {   # PW med styrke måling:
    echo '<section><div class="lablInput">  '.
//    '<fieldset class="js-password-fieldset">'.
      '<input type= "password" '.$more.' width="'.$width.'" id= "password-strength-code" name="'.$name.'" style="line-height:100%" value="'.$valu.'"  '.
      $eventInvalid.' '.$aktiv.' placeholder="'.$plho.'" />'.
//      '</fieldset>'.
      ' <label for="'.$name.'">'.$LablTip.'</label> </div>';
    echo '<meter max="4" id="password-strength-meter" title="Password Styrke måler: 5 niveauer"></meter>'.
         '<feedback id="password-strength-text" title="Feedback til det angivne password"></feedback></section>';
    }
    
  if ($type== 'mail') 
    echo '<div class="lablInput"> <input type= "email" '.$more.' id="'.$name.'" name="'.$name.'" value="'.$valu.'"  '.$eventInvalid.
  ' '.$aktiv.' placeholder="'.$plho.'" /> <label for="'.$name.'">'.$LablTip.'</label> </div>';
  
  if ($type== 'hidden') 
    echo '<input type= "hidden" id="'.$name.'" name="'.$name.'" value="'.$valu.'" />';
  
  if ($type== 'area') 
    echo '<div class="lablInput"> <textarea rows="'.$rows.'" id="'.$name.'" style="line-height:100%" '.$eventInvalid.
  ' '.$aktiv.' placeholder="'.$plho.'" '.$more.' >'.$valu.'</textarea>   <label for="'.$name.'">'.$LablTip.'</label> </div>  <br/>';
  pretty();
}

function htm_CombList($valu='',$labl='',$titl='',$liste) {global $ØblueColor; // Ændret rækkefølge: $labl ,$titl
  echo '<label style="color:'.$ØblueColor.'; font-weight:400; font-size:smaller"><colrlabl>'.Lbl_Tip($labl,$titl).'</colrlabl>'.  htm_SelectStr($valu,$liste); 
}


# BASISMODUL for checkbox:
function htm_CheckFlt($type='NotUsed',$name='checkboxName',$valu='',$labl='',$titl='',$revi=true,$more='',$nl='<br/>') { // Ændret rækkefølge: $labl ,$titl
  if ($revi==true) {$aktiv= ''; $colr='';} else {$aktiv='disabled'; $colr='#_$888888';};
  if ($valu==true) {$valu= 'on'; } else {$valu=''; };
  pretty('htm_CheckFlt');
  echo '&nbsp;<input type= "checkbox" name="'.$name.'" value="'.$valu.'"  '.$aktiv.' '.$more.'>'.
       '<label for="'.$name.'" style="color:'.$colr.';"  ><colrlabl>'.Lbl_Tip($labl,$titl).'</colrlabl> </label> '.$nl;
  if (isset($_POST[$name])) return($_POST[$name]);
  pretty();
}

# BASISMODUL for <select> Element (option):
function htm_OptioFlt($type='NotUsed',$name='',$valu='',$labl='',$titl='',$revi=true,$optlist=array(),$action='',$events='') {global $ØblueColor; // Ændret rækkefølge: $labl ,$titl
  $eventInvalid= 'oninvalid="this.setCustomValidity(\''.tolk('@Vælg '.$labl.' på listen!').'\')"';
  if ($revi==true) {$aktiv= ''; $colr='';} else {$aktiv='disabled'; $colr='#_$888888';};
  #$array= array(['Fil i pdf-format','pdf','PDF-fil'],['Elektronisk forsendelse','email','email'],['Elektronisk fakturering','ioubl','OIOUBL'],['PBS faktura','pbs','PBS']);
 # echo  '<form><!-- this is a dummy --></form> ';
  echo '<div class="lablInput">';
    pretty('htm_OptioFlt');
    echo ' <form action="'.$action.'">';   # required  // Nestet form!
    echo '<label style="color:'.$ØblueColor.'; font-weight:400; font-size:smaller"><colrlabl>'.Lbl_Tip($labl,$titl).'</colrlabl>'.
    ' <select class="styled-select" name="'.$name.'" '.$events.' '.$eventInvalid.'> <option value="'.$valu.'" >'.Tolk('@Vælg!');  # title="'.$titl.'"     selected="'.$valu.'"
      foreach ($optlist as $rec) {    # $optlist= [0:Tip, 1:value, 2:Label, 3:Action]
        pretty();
        echo '<option value="'.$rec[1].'" title="'.tolk($rec[0]).'" '.$rec[3];
        if ($rec[1]==$valu) echo ' selected';
        echo '>'.$lbl=Tolk($rec[2]).'</option> ';
        }
    echo '</select>&nbsp;&nbsp;&nbsp;</label>';
    //  $rec[3] kan indeholde hændelse
//    if ($action)
//    echo '<input type= "submit" id="Button1" name="submit" value="'.tolk('@Benyt').'"  title= "@Aktiver valget" style="position:absolute;left:70%;top:5px;width:50px;height:22px;z-index:6;">';
  echo '</form>';
  pretty();
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
function htm_RadioGrp($type='vert',$name='',$labl='',$titl='',$optlist=array(),$action='') {global $ØblueColor; // Ændret rækkefølge: $labl ,$titl
  pretty('htm_RadioGrp');
  echo '<form action=""><div style="font-weight:400"><label style="color:'.$ØblueColor.'; font-size:small">'.Lbl_Tip($labl,$titl).'  </label>'; // Nestet form!
    foreach ($optlist as $rec) {
      if ($type=='vert') echo '<br>'; 
      if ($rec[3]) $valgt= 'checked'; else $valgt= '';
      pretty();
      echo '<input type= "radio" name="'.$name.'" value="'.$valu=$rec[0].'" '.$valgt.' title="'.tolk($rec[3]).'">'.
            $lbl= Tolk($rec[1]).' &nbsp; <font style="color:'.$ØblueColor.'">'.
            $suff=Tolk($rec[2]).'</font>&nbsp;'; 
  } 
  echo '</small></div> </form>';  pretty();
}


# BASISMODUL for link-knap med icon:
function iconKnap ($faicon='',$title='',$link='',$akey='') { global $ØButtnBgrd, $ØTastkeys;
  if ($ØTastkeys) {
    if ($akey) $genv=' ´<i>'.$akey.'</i>´'; else $genv='';
    if (!$genv) $ktip=''; else $ktip= '<br>'.tolk('@Tastatur genvej: ').$akey;
  }
  $LablTip= '<div0 class="tooltip" style="margin: 1px 5px;"><span class="tooltiptext">'.$title.$ktip.'</span></div0>';
  pretty('iconKnap');
  echo '<span><a href="'.$link.'" accesskey="'.$akey.'"'.$LablTip.' ';
  echo '  <ic class="fa '.$faicon.'" style="font-size:32px; color:'.$color=$ØButtnBgrd.';"></ic>'.  /* $genv. */ '</a></span>'; 
}
    
# BASISMODUL for link-knap med tekst (på lys baggrund):
function textKnap ($label='',$title='',$link='',$akey='',$more='') { global $ØButtnBgrd, $ØTitleColr, $ØTastkeys;
  if ($ØTastkeys) {
    if ($akey) $genv=' ´<i>'.$akey.'</i>´'; else $genv='';
    if (!$genv) $ktip=''; else $ktip= '<br>'.tolk('@Tastatur genvej: ').$akey;
  }
  if ($link=='../_base/page_Blindgyden.php') {$clr= '#AAAAAA'; $note=' <br> ('.tolk('@En blindgyde endnu!').')';} else {$clr= $ØTitleColr; $note='';};
  $LablTip= '<div0 class="tooltip" style="color:'.$color= $clr.'; padding:2px 6px; border:1px solid gray; box-shadow: 2px 2px 4px #888888; '.$more.'">'.
            '<span class="tooltiptext">'.tolk($title).$ktip.$note.'</span></div0>';
  pretty('textKnap');
  echo '<span class="knap" style="color:'.$color=$ØTitleColr.';"><a href="'.$link.'" accesskey="'.$akey.'"'.$LablTip.' '.ucfirst(tolk($label)).$genv.'</a></span>';  
}
    
# BASISMODUL for link-knap med tekst på farvet baggrund:
function naviKnap ($label='',$title='',$link='',$akey='',$more='') { global $ØButtnBgrd, $ØTitleColr, $ØTastkeys;
  if ($ØTastkeys) {
    if ($akey) $genv=' ´<i>'.$akey.'</i>´'; else $genv='';
    if (!$genv) $ktip=''; else $ktip= '<br>'.tolk('@Tastatur genvej: ').$akey;
  }
  if ($link=='../_base/page_Blindgyden.php') {$clr= '#AAAAAA'; $note=' <br> ('.tolk('@En blindgyde endnu!').')';} else {$clr= 'white'; $note='';};
  $LablTip= '<div0 class="tooltip" style="color:'.$color= $clr.'; padding:2px 6px; border:1px solid gray; box-shadow: 2px 2px 4px #888888; background:'.$ØButtnBgrd.'; '.$more.'">'.
            '<span class="tooltiptext">'.tolk($title).$ktip.$note.'</span></div0>';
  pretty('naviKnap');
  echo '<span class="knap" style="color:'.$color=$ØTitleColr.'; "><a href="'.$link.'" accesskey="'.$akey.'"'.$LablTip.' '.ucfirst(tolk($label)).$genv.'</a></span>';  
}

function menuTitl ($h='32',$w='120',$label='') {
  pretty();
  echo '<titlBg><img src= "../_assets/images/menuShapeTitl.png" alt="" height="'.$h.'" width="'.$w.'" /><a href="'.$link.
  '" class="btnTit" notitle= "'.Tolk('@Kolonne Overskrift').'">'.ucfirst(str_replace(' ','&nbsp;',Tolk($label))).'</a></titlBg>'; }
  
function menuKnap ($h='32',$w='120',$label='',$link='',$title='') { 
  if (strpos($link,'_base/page_Blindgyden.php')) { $flag0= ' style="color:gray" '; $mess= str_lf().' (En blindgyde endnu!)';}
#  if (strpos($link,'page_Syssetup1.php')) $flag1= ' style="color:red" '; else $flag1= ' style="color:#900000" ';
  pretty();
  echo '<menuBg><img src= "../_assets/images/menuShapeButt.png" alt="" height="'.$h.'" width="'.$w.' display:block; margin:auto;" /><a href="'.$link.
  '" class="btn" tip="'.Tolk($title).$mess.'" '.$flag0.$flag1.'>'.ucfirst(str_replace(' ','&nbsp;',Tolk($label))).'</a></menuBg>'; }

 function userTip () { global $Ønovice;
   pretty();
   if (!$Ønovice) $Ønovice='true';
#?? Fejler:  echo '<script> document.getElementByName("tip").checked= '.$Ønovice.'; </script>';
   $Ønovice= htm_CheckFlt($type='checkbox',$name='tip', $valu= $Ønovice, $labl='@noTIP?:', $titl='@Vis tip for begyndere, hvis du er ny i systemet. (Virker ikke endnu)', 
      $revi=true, $more=' '.$Ønovice,' ');
 //  $Ønovice= true;
}

# BASISMODUL for tabel: 
# Visning af data - ingen redigering, udover oprettelse af ny record, og angivelse af filter.
# "RulleTabel" mellem fastlåst TabelTop og Bund, hvis tabellen er højere end $ViewHeight
# Mulighed for: Filtrering / Sortering / Recordvalg / NyRecord
# NyRecord, når $CreateRec=true
function htm_Tabel($RowLabl='',      # htm_TabelInp:  array([0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder])
                   $ColStyle=array(['@Kol0','7%','D','text','left','Tip',''],['...']), # Default! Kolonne-egenskaber. Rec-eksempel erstattes med aktuel parameter!
                   $TablData=array(),   # De data som skal vises
                   $FilterOn=true,      # Default!  Mulighed for at skjule records med filter.
                   $SorterOn=false,     # Default!  Mulighed for at sortere records efter kolonne indhold
                   $CreateRec=true,     # Default!  Mulighed for at oprette en record
                   $ModifyRec=true,     # Default!  Mulighed for at ændre data i en row (ikke aktiv endnu)
                   $ViewHeight='200px', # Default! erstattes af eventuel parameter.
                   $Angaar='')          # Angår forskellig Manipulering/layout af sum-linier: regnskab, budget og kontoplan
{ global $ØButtnBgrd, $ØLineBrun, $Ønovice, $ØFullFilt, $ØRollTabl, $ØBtNewBgrd, $ØTextLight, $Ødimmed;
if ($ØRollTabl==false) $ViewHeight= '99999px';
#+  if ($Angaar!='Rude_LanguageJuster')
#+  userTip();
//  $Ønovice= isset($_POST['tip']);
  $Capt1= '<b> '.tolk('@FILTER').'</b>: ';
  if ($Ønovice) $Capt1.= tolk('@Begræns visning i DATA-tabellen nedenfor, ved at angive søge-kriterier i felterne herunder:');
  $Capt2= '<b> '.tolk('@DATA:').'</b>';
//  if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,__FUNCTION__.':1');

### outputTabel med Filter:
  if ($FilterOn) {  ### Vis filter-felter:
    if (($ØFullFilt) or ($Angaar!='Rude_Kladderedigering')) {
      pretty('htm_Tabel');
      echo '<br> <tc>'.$Capt1.'</tc>';
      echo textKnap($label='@Vis det valgte', $title='@Vis det der matcher filteret herunder',  $link='../_base/page_Blindgyden.php').
           textKnap($label='@Vis alt',        $title='@Slet filter og vis alt',                 $link='../_base/page_Blindgyden.php').  '<br>';
      echo '<div class="fixed-table-container" style= "max-height: '.$ViewHeight.'; max-width:97%; float:left; margin-left:4px;">';  //  <div class="header-background"> </div>';
      pretty();
      echo '<table cellspacing="0">';
      echo '<thead> <tr>';
        foreach ($ColStyle as $Specf) {pretty(); echo '<th style="width:'.$Specf[1].';" title="'.tolk($Specf[5]).'"> <div class="extra-wrap"><div class="th-inner">'.ucfirst(tolk($Specf[0])).'</div></div> </th>';  }
      echo '</tr> ';
      pretty();
      echo '<tr class="row">';
        for ($x= 0; $x < count($ColStyle); $x++) 
          {pretty(); echo '<td><input type= "text" name="Kol'.$x.'" title="'.tolk('@Søg efter...').'" placeholder="...'.tolk('@Søg').'..." style="width:97%; padding-left:4px; background:#CCEDFE;" /></td> ';}
        echo '</tr></thead> </table> </div>'; pretty();
    } else 
    {//  Simpelt filter:
      if ($Angaar!='Rude_Kladderedigering') 
        echo textKnap($label='@Vis egne', $title='@Vis kun egne kladde lister', $link='../_base/page_Blindgyden.php').
             textKnap($label='@Vis alle', $title='@Vis alle kladde lister',     $link='../_base/page_Blindgyden.php').  '<br>';
    }
  }

### outputTabel med data:
  if ($FilterOn) echo ' <tc>'.$Capt2.'</tc>';
  echo '<div class="fixed-table-container"                 style= "max-height:'.$ViewHeight.';">';  //   <div class="header-background"> </div>';
  echo '<div class="fixed-table-container-inner extrawrap" style= "max-height:'.$ViewHeight.';">';
  pretty();
  echo '<table cellspacing="0" style="border: 1px solid '.$ØLineBrun.';"> ';
  foreach ($ColStyle as $Specf) { echo '<col style="width:'.$Specf[1].'">'; }

  ### outputTabel Header med sortering?: 
  pretty();
  echo '<thead> <tr>';
  $SeltRow= '<div1 class="tooltip">⇒<span class="tooltiptext" style="bottom: -12px; left: 65px">'.tolk('@DETALJER: Klik her for at ').tolk($RowLabl).'.</span></div1>';
  $LablTip= '<div0 class="tooltip" style="padding:0; height:23px;"><span class="tooltiptext">'.
            tolk('@Klik her for at ændre sortering af listen. - Kun dit sidste valg har virkning').'<br>'.
            tolk('@ - men ikke endnu!').' </span></div0>';
  # $Up= '↑&nbsp;'; $Dw= '&nbsp;↓'; $UpDw= '↑↓';  # '<small>▲<br><b>▼</b></small>';  # fa-arrow-down '<b>↑↓</b>';  #  ^v ▲<br><b>▼</b>
  $Up=  '<ic class="fa fa-arrow-up"   style="font-size:12px; color:red;"></ic>';
  $Dw=  '<ic class="fa fa-arrow-down" style="font-size:12px; color:red;"></ic>';
  $UpDw='<ic class="fa fa-sort" style="font-size:16px; color:gray;"></ic>';
  if (!$SorterOn) {$sortUp=''; $sortDw=''; $sortUpDw='';}
  else {$sortUp=   '<sorter onclick="this.style.color= \'red\'" '.$LablTip.$Up.  '</sorter>';    # ToDo: relevant onclick javascript skal udvikles!
        $sortDw=   '<sorter onclick="this.style.color= \'red\'" '.$LablTip.$Dw.  '</sorter>'; 
        $sortUpDw= '<sorter onclick="this.style.color= \'red\'" '.$LablTip.$UpDw.'</sorter>';} 

### KolHeader m. evt. Sorterings-valg:
  foreach ($ColStyle as $Specf) {pretty(); echo '<th title="'.tolk($Specf[5]).'" padding-left:1px;> <div class="extra-wrap" padding-left:2px;><div class="th-inner">';
    if ($Specf[2]=='D') echo $sortDw; else if ($Specf[2]=='U') echo $sortUp; else echo $sortUpDw;
    echo ' '.ucfirst(tolk($Specf[0])).'</div></div> </th>';
  }
  echo '</tr> </thead>';
  
### Vis Data:  
  pretty();
  echo '<tbody>';
  #if ($Angaar=='regnskab') $SeltRow= ''; //Ingen rækkevalg ved regnskab
  if ($ModifyRec==false) $SeltRow= ''; // Ingen mulighed for at vælge record som skal rettes/vises med detaljer
  if (!$TablData) {msg_Info('Ingen data','Data tabellen er tom! ('.$Angaar.')');} else
  foreach ($TablData as $Row) { 
    $rowBg= RowDesign($Row,$RowLabl,$Angaar); //  $Row er pointerrefereret og ændrer indhold!
    pretty();
    echo '<tr class="row"; '.$rowBg.'>';    $x= 0;    $bg= 'transparent'; 
    foreach ($Row as $Col) {$x++; // Bestem Baggrund for rækken:
      if ($Angaar=='budget') {}; # Foregår i htm_TabelInp_Budget
      if (($Angaar=='kontoplan') or ($Angaar=='Rude_Varemodtagelse'))
        if  ($x==1) $bg= 'white'; else $bg= 'transparent';     // Hvid: kontonr
      if (($Angaar=='regnskab') and (!strpos($rowBg,'gray')) and (!strpos($rowBg,'green')) and (!strpos($rowBg,'yellow')) )
      if (($x==1) or ($x==5)or ($x==18)) $bg= 'white; opacity:0.66'; else $bg= 'transparent';         // Hvid: kontonr, primo og Ialt
      if ((strpos($Row[1],'<br>'))and ($x==2)) $span= 'colspan=3; '; else $span= '';    // Lange tekster i flere kolonner.
      if ($x==1) $spcSty= 'border:1px solid #CCCCCC;">'.$SeltRow.' ';
      else       $spcSty= ';" '.$span.'>';
      pretty();
      echo '<td style= "background-color:'.$bg.'; text-align:'.$ColStyle[$x-1][4].'; '.$spcSty.$Col.' </td>'; 
    }
    echo $genvej.'</tr>'; }
    
### Opret ny record:
    if ($CreateRec) {
    $x= 0;  foreach ($ColStyle as $Specf) { $x++; 
      pretty();
      echo '<td style="padding:0; vertical-align: bottom;">';
      if ($x==1) { $index= '9998+1';  # "background:'.$ØButtnBgrd.'; color:white;"
      echo '<div1 class="tooltip" style="background:'.$ØBtNewBgrd.'; color:'.$ØTextLight.';'.$Ødimmed.'">'.tolk('@Opret ny:').'<span class="tooltiptext" style="bottom: -12px; left: 65px">'.pretty().
        tolk('@Klik her, når du har udfyldt data-felterne på rækken herunder.').'</span></div1>'; 
      }  # else
      pretty();
      echo '<div style="margin-right: 2px;"> <input type= "'.$Specf[3].'" name="Kol'.$x.'" title="'.tolk($Specf[5]).
            '" placeholder="'.tolk($Specf[6]).'" style="text-align:left; width:98%; padding-left:4px; background-color:#fffa90;" /></div></td> ';
    }}
  echo '</tbody>  </table> </div> </div>';
}

function RowDesign (&$Row,$RowLabl,$Angaar='') { # Row: [0:kontonr, 1:beskrivelse, 2:kontotype, 3:moms, 4:fra_kto, 5:til_kto, 6:lukket]
//  global $genvej;
global $ØprogramSprog;
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
        default : {$ix= 1; /* echo "<colrlabl>Sprog?:".$ØprogramSprog." </colrlabl>"; */};
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
  pretty();
  echo '<td> <div style="margin-right:0; "> <select class="styled-select" name="liste"> <option value="'.$valu.'" title="'.tolk('@Vælg').'" >';
    foreach ($optliste as $rec) {
      pretty();
      echo '<option value="'.$rec[1].'" title="'.$rec[0].'"'.$rec[3];
        if ($rec[1]==$valu) echo ' selected';
      echo '>'.$lbl=$rec[2].'</option> ';
    }
  echo '</select></div></td> '; pretty();
}}

if (!function_exists('htm_SelectStr')) {  # Optimering: Disse lister bør kunne oprettes 1 gang, kun ved opstart!
function htm_SelectStr($valu,$optliste=[]) {
  $Result= '<div style="margin-right:0; "> <select class="styled-select" name="liste"> <option value="'.$valu.'" title="'.tolk('@Vælg').'" >';
  foreach ($optliste as $rec) {
    $Result.= '<option value="'.$rec[1].'" title="'.tolk($rec[0]).'"'.$rec[3];
      if ($rec[1]==$valu) $Result.= ' selected';
    $Result.= '>'.$lbl=tolk($rec[2]).'</option> ';
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
      &$DATA, //  = array(),
      $ViewHeight= '400px'
      ) 
//  FIXIT:  A. Kolonne-summer vises i bold. - B. Kolonneoverskrifter skjules når vinduet rulles.
{ global $ØblueColor, $ØLineBrun, $ØtblRowLgt, $ØRollTabl;
if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$modulnr,$DocFil,__FUNCTION__.':1');
pretty('htm_TabelInp_Budget');
  if ($ØRollTabl==false) $ViewHeight= '99999px';
### "InfoFelter" over kolonne-labels:
      htm_FrstFelt( '5%',0); 
      #htm_NextFelt('10%');  echo tolk('@Nyt budget:');  //  '@ +/- 0% OK', '@Pct. korrektion'
      htm_NextFelt('10%');  htm_CentHead(tolk('@Nyt budget:')); //echo tolk('@Nyt budget:');  //  '@ +/- 0% OK', '@Pct. korrektion'
      htm_NextFelt('8%');   htm_CombFelt($type='number',  $name='pct', $valu= 0,   
                                         $labl='@% Korrektion',  
                                         $titl='@Angiv en +/- pct-sats, som der skal justeres op/ned med', 
                                         $revi=true, $rows='2',$width='44px',$step='1');
      htm_NextFelt('30%');  echo textKnap($label='@Udfyld på grundlag af sidste års tal',  
                                          $title=tolk('@Automatisk budgetlægning på grundlag af sidste års regnskab, korrigeret med den angivne pct. sats!').'<br>'.
                                          tolk('@ADVARSEL: Alle nuværende beløb overskrives! Gem ikke, hvis det er en fejl.'),$link='../_base/page_Blindgyden.php');
      htm_NextFelt('35%');  htm_RadioGrp($type='hori',  $name='krvis',  $labl='@Beløbsvisning:', $titl='@Vælg visnings nøjagtighed for budget beløb', 
                            $optlist= array(['kr','@Hele kroner','@eller',true],['tusind','@Kun tusinder','']),$action='');
      htm_LastFelt();    
  echo '<div class="fixed-table-container-inner" style= "max-height: '.$ViewHeight.';">';  //  Se mere her: https://codepen.io/chiranjeeb/pen/LGsiv
  echo '<table class="formnavi" cellspacing="0" style="border: 1px solid '.$ØLineBrun.';">';
  
  if (!function_exists('LblOut')) { function LblOut ($part1,$part2) {
    echo '<th style="font-size:small; border:0px solid; width:'.$part1.'">'.
         '<div class="extra-wrap"><div class="th-inner-center" align="center">'.ucfirst($part2).'</div></div> </th>';}}

### Kolonne-LABELS:   FIXIT: Labels skal være statiske, ikke rulle med op i tabel-ruden! (som de ikke gør i htm_Tabel() ) Lbl_Tip/tooltiptext skjules, når dern placeres ovenover).
  echo '<tr>'; $n= 0;
    foreach ($ColStyle as $Spec) {
      if ($n==0) {$n++; LblOut($Spec[1], Lbl_Tip($Spec[0],$Spec[5],'SO'));}
      else LblOut($Spec[1], Lbl_Tip($Spec[0],$Spec[5],'S'));
    };
  echo '</tr>';
### Kolonne-DATA-INPUT:   
  echo'<tbody>  ';
  $optlist= FormVars(4); $ordlist= OrdrVars(4); $n= count($DATA); if ($n<1) $n= 20;
  $DatIx=-1;
  //if ($GLOBALS["Ødebug"]) var_dump($DATA);
    foreach ($DATA as $Dat) { $DatIx++;
      $rowBg= RowDesign($Dat,$RowLabl,$Angaar='budget');
      pretty();
      echo '<tr class="row"; '.$rowBg.'>';
### Tabel-BODY:
      $ColIx= -1;  $offset=0;                # htm_TabelInp:  [0:ColLabl, 1:ColWidth, 2:ColJust:U/D/UD, 3:InpType, 4:FeltJust, 5:ColTip, 6:placeholder]
      foreach ($ColStyle as $Specf) {$ColIx++;  # htm_Tabel:  [0:ColLabl, 1:ColWidth, 2:ColJust,        3:InpType,             4:ColTip, 5:placeholder]
        if ($ColIx==2) $offset=6; //  Ix 2 til 7 (som kontoplan), skal ikke udskrives, kun benyttes til layoutstyring!
        if (is_array($Dat[$ColIx+$offset])) $DatFelt= $Dat[$ColIx+$offset][$DatIx]; else $DatFelt= $Dat[$ColIx+$offset];   //  Afhængig af array i 1 eller 2 dimensioner!
        if (($ColIx==0) or ($ColIx==14)) $bg= $ØtblRowLgt; else $bg= 'transparent';                     //  Hvid: Konto og Ialt
        if ($Specf[3]=='data') { pretty();
          echo '<td style= "text-align:'.$Specf[4].'; font-size:small; background-color: '.$bg.';">'.tolk($DatFelt).'</td>';  }   //  Kun TEXT-output
        else  # I alle andre tilfælde Standard: text m.fl.
          if ($rowBg>'')  echo '<td style= "text-align:'.$Specf[4].';">'.tolk($DatFelt).'</td>';    //  Kun TEXT: Overskrifter og sum-rækker
          else  { if ($offset>2) $val= number_format($DatFelt*1,0,',','.'); else $val= tolk($DatFelt);      
                  echo '<td> <input type= "text" name="Kol'.$ColIx.'" '.'value="'.$val.'" placeholder="'.tolk($Specf[6]).
# Brug af rgba-opacity, påvirker ikke forgundsfarve!  '" style= "text-align:'.$Specf[4].'; background-color: '.$bg.'; background-color: white; opacity:0.70; width:100%; width:92%;" /></td> ';
                                 '" style= "text-align:'.$Specf[4].'; background-color: '.$bg.'; background: rgba(255, 255, 255, 0.5); width:100%; width:92%;" /></td> ';
                                 
                }
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
                        &$DATA=array(), # "RowBody"
                        $ViewHeight= '500px',
                        $PadTop='26px'
                      ) 
{ global $ØblueColor, $ØLineBrun, $ØRollTabl;
  pretty('htm_TabelInp'); 
 # $ViewHeight= '';
  echo '<div class="fixed-table-container"                 style= "padding-top:'.$PadTop.'; ">';
  echo '<div class="fixed-table-container-inner extrawrap" style= "max-height: '.$ViewHeight.'; overflow-y: auto;">';
  if ($HeadLine[0][0]>'') { # [0:Label, 1:Width, 2:Just, 3:Type, 4:TitleTip, 5:Value]
    pretty(); echo '<div class="header-background" style="color:'.$ØblueColor.';"> &nbsp;';
      foreach ($HeadLine as $Capt) {
        if ($Capt[3]='show') $forskel= '" disabled value="'; else $forskel= '"    placeholder="';
        pretty(); 
        echo tolk($Capt[0]).' <input type= "'.$Capt[3].'" name="note" title="'.tolk($Capt[4]).$forskel.tolk($Capt[5]).
              '" style="width:'.$Capt[1].'; text-align:'.$Capt[2].';" />&nbsp;&nbsp;';
       }
    echo '</div>';
  }
  pretty(); 
  echo '<table class="formnavi" cellspacing="0" style="border: 1px solid '.$ØLineBrun.';">';
### Kolonne-LABELS:
  pretty();
  echo '<thead><tbody><tr> '; 
  foreach ($RowHead  as $Pref) {pretty(); echo '<th style="width:'.$Pref[1].' align:'.$Pref[2].';"> '.
        '<div class="extra-wrap"><div class="th-inner-center" align="center">'.Lbl_Tip($Pref[0],$Pref[5],'SO','0px').'</div></div> </th>';}
  $kNo= 0;
  foreach ($ColStyle as $Spec) {pretty(); if ($kNo++>1) $plc='SW'; else $plc='SO'; echo '<th style="width:'.$Spec[1].';">'.
        '<div class="extra-wrap"><div class="th-inner-center" align="center">'.Lbl_Tip($Spec[0],$Spec[5],$plc,'0px').'</div></div> </th>';  }
  foreach ($RowTail  as $Suff) {pretty(); echo '<th style="width:'.$Suff[1].
                                                      ' align:'.$Suff[4].';">'.Lbl_Tip($Suff[0],$Suff[5],'S','0px').'</th>';}
  echo '</tbody></thead> </tr> ';
  pretty();
  
### Kolonne-DATA-INPUT:   
  echo' <tbody>  ';
  $optlist= FormVars(4); $ordlist= OrdrVars(4); $n= count($DATA); if ($n<1) $n= 20;
# for ($y= 0; $y < $n; $y++) { $x=0;  // DEMO-data. ToDo: Skal i stedet knyttes til &$DATA array()
  $DatIx=-1;
  foreach ($DATA as $Dat) { $DatIx++;
    pretty();
    echo '<tr class="row">';
    foreach ($RowHead  as $Pref) {pretty(); echo '<td style="width:'.$Pref[1].'; text-align:'.$Pref[2].'">'.tolk($Pref[4]).' </td>';} 
### Tabel-BODY:
    $ColIx= -1;
    $inpBg= ' background-color: white; opacity:0.60; ';
    foreach ($ColStyle as $Specf) {$ColIx++;                # [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:ColTip, 5:placeholder]
      pretty();
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
        case "stat" : echo '<td>'. htm_SelectStr($valu,StatListe()).'</td>';  break;
        case "date" : echo '<td>'. '<input type= "date" id="'.$name.'" name="'.$name.
                      '" style="line-height:100%; text-align:left; width:85%; font-size:small; height:16px; '.$inpBg.' value="'.$valu.
                      '" placeholder="åååå-mm-dd"  '.$aktiv.' />'.
                      '</td>';  break;
        case "show" : //  Kun visning af data:
                      echo '<td style="width:'.$Specf[1].'; margin-right:0; text-align:'.$Specf[4].'; '.$inpBg.'">'.tolk($Dat[$ColIx]).'</td> ';  break;
        case "data" : //  Vis og rediger data: 
        case "area" :
                      if ($Dat[$ColIx][0]=='Nyt felt')  {  # Opret ny record
                        echo '<td> '.tolk('@Nyt felt:').' <div style="margin-right:0; font-size:x-small"> <select class="styled-select" name="liste"> <option value="" >-';
                          foreach ($ordlist as $rec) { echo '<option value="'.$rec[1].'" '.$rec[3];   if ($rec[1]==$valu) echo ' selected';   echo '>'.$lbl=$rec[2].'</option> '; }
                        echo '</select></div></td> ';
                      } else # Vis redigerbart datafelt:
                        echo '<td style="width:'.$Specf[1].';"> <div style="margin-right:0;"> <input type= "'.$Specf[3].'" name="Kol'.$ColIx.'" '.'value="'.tolk($Dat[$ColIx][0]).
                                    '" placeholder="'.tolk($Specf[6]).'" style="text-align:'.$Specf[4].'; '.$inpBg.' width:100%;" /></div></td> ';
                      break;
        default     : echo '<td> <div style="margin-right:0;"> <input type= "'.$Specf[3].'" name="Kol'.$ColIx.'" '.'value="" '.
                          'placeholder="'.tolk($Specf[6]).   '" style="text-align:'.$Specf[4].'; '.$inpBg.' width:100%;" /></div></td> ';
      }
    };
### RowTail: [0:ColLabl, 1:ColWidth, 2:ColJust, 3:InpType, 4:FltContent, 5:ColTip, 6:placeholder]
  foreach ($RowTail as $felt) {pretty(); echo '<td style="text-align:'.$felt[4].'; width:'.$felt[1].'; title:'.$felt[5].'">'.$felt[6].'</td>';}
    echo '</tr>';
  } # Ide: Mulighed for at vise kolonne-summer, eller andet, på en "footer-række" under tabellen.
  echo '</tbody> </table> </div>';    echo '</div>';

#+  NaviTip();
}

function htm_Formstart($name='',$more='') { //  eks: $more= 'action="#"';
  pretty('htm_Formstart');
  echo '<form name="'.$name.'" id="'.$name.'_id" '.$more.' method="post">';
}
function htm_Formslut() {
  echo '</form>';
}
 
# LAYOUT moduler: Rude= Baggrund for en samling datafelter.
function htm_Rude_Top($name='', $capt='', $parms='', $icon='', $klasse='panelWmax', $func='Udefineret', $more='') {  # SKAL efterfølges af htm_RudeBund !
  global $Ødebug, $ØTitleColr, $ØformOn;
  pretty('htm_Rude_Top');
  if ($capt=='') $Ph= 'height:0;';
  if ($name>'') //  Uden navn oprettes ingen form, så lokale(/"indlejrede forms") muliggøres!
    if ($ØformOn) echo '<form name="'.$name.'" id="PanelForm" action="'.$parms.'" method="post">';  //  "ParentForm" - Nestet forms er ikke tilladt, så under-forms skal håndteres specielt!
  if ($Ødebug) {$fn= '&nbsp; <small><small><small>'.$func.'()</small></small></small>';} else $fn='';
  echo '<div class="'.$klasse.'"'.$more.'> <div class="panelTitl" style="'.$Ph.'" max-width:400;>'.
    '<ic class="fa '.$icon.'" style="font-size:22px;color:'.$ØTitleColr.'"></ic> &nbsp;'.ucfirst(Tolk($capt)).$fn.'</div>';
  if ($capt!='') echo '<hr class="style13" style="margin-bottom: 0"/>';
} # Boxens </div> og </form> er placeret i htm_RudeBund, som skal kaldes til slut!

function htm_RudeBund($pmpt='', $subm=false, $title='@Husk at gemme her, hvis du har rettet noget ovenfor, inden du forlader vinduet.',$akey='') { # SKAL følge efter htm_Rude_Top !
  global $ØformOn;
  if ($ØformOn)
    if ($subm==true) {  echo '<hr><div class="centrer">';   htm_accept($pmpt,$title,$width='',$akey); echo '</div>';  }
  echo '</div>';
  if ($ØformOn) echo '</form>';
}

function htm_Accept($labl='', $title='', $width='',$akey='')   //  Kan kun benyttes på PanelForm! (Rude_Top/Rude_Bund)
{global $ØBtNavBgrd, $ØBtNavText, $ØBtSavBgrd, $ØBtSavText, $ØBtDelBgrd, $ØBtNewBgrd, $ØTextLight, $ØTextDark, $Ødimmed, $ØTastkeys;
  if ($ØTastkeys) {
    if ($akey) $genv=' ´<i>'.$akey.'</i>´'; else $genv='';
    if (!$genv) $ktip=''; else $ktip= '<br>'.tolk('@Tastatur genvej: ').$akey;
  }
  if ($width) $width= ' width: '.$width.';';
  pretty('htm_Accept');
  /* Generelt-Navigation  */  $colors= ' background:'.$ØBtNavBgrd.'; color:'.$ØBtNavText.';'.$Ødimmed; # naviger-knap: GRØN
  if (($labl=='@Gem') or ($labl=='@Gem rettelser') or ($labl=='@Fakturér') or ($labl=='@Opret ordre') )
                              $colors= ' background:'.$ØBtSavBgrd.'; color:'.$ØBtSavText.';'.$Ødimmed; # Submit-knap: GUL
  if (($labl=='@Slet') )      $colors= ' background:'.$ØBtDelBgrd.'; color:'.$ØTextLight.';'.$Ødimmed; # Slet: RØD
  if (($labl=='@Opret Ny') )  $colors= ' background:'.$ØBtNewBgrd.'; color:'.$ØTextLight.';'.$Ødimmed; # Ny: BLÅ
  if (($labl=='@Retur til hovedmenu')) {echo textKnap($label='@Retur til hovedmenu',  $title='@Vend tilbage til programmets hovedmenu',
                                 $link='../_base/page_Gittermenu.php', $akey='', 
                                 $more=' background:'.$ØBtNavBgrd.'; color:'.$ØBtNavText.';'.$Ødimmed); 
  } else
  echo '<button form="PanelForm" type= "submit" name="submit" class="tooltip" style="margin: 1px 1px; padding: 1px 3px; height: 22px; '.$width.
        $colors.'" >'. # Submit-knap: GUL
        ucfirst(tolk($labl)).$genv.'<span class="tooltiptext">'.tolk($title).$ktip.'</span></button>';
}


# LAYOUT moduler: Lagen= Baggrund for en gruppe af ruder. (Parametre, som htm_Rude_Top)
function htm_Tapet_Top($name='UnUsed', $capt='', $parms='UnUsed', $icon='', $klasse='tapetWmax', $func='Udefineret') {  //  Problem: lyster ikke tapetWmax
  global $Ødebug, $ØTitleColr;
  if ($Ødebug) {$fn= '&nbsp; <small><small><small>f:'.$func.'()</small></small></small>';} else $fn='';
  echo '<div class="'.$klasse.'" > <div class="panelTitl" style="height:0;" >'.
    '<ic class="fa '.$icon.'" style="font-size:22px;color:'.$ØTitleColr.'"></ic> &nbsp;'.ucfirst(Tolk($capt)).$fn.'</div>';
} # Boxens </div>  er placeret i htm_TapetBund, som skal kaldes til slut!

function htm_TapetBund($pmpt='',$subm=false,$title='') { # SKAL følge efter htm_Tapet_Top !
  echo '</div>';
}

function htm_Rammestart($Caption='',$bor='1px') {
  echo '<fieldset  style="border: '.$bor.' solid #8c8b8b;"> <legend><tc><b>'.tolk($Caption).'</b></tc></legend>';
}
function htm_Rammeslut() {
  echo '</fieldset>';
}
 

function htm_Caption($labl='',$style='') {
  echo '<colrlabl style="'.$style.'">'.tolk($labl).'</colrlabl>';
}  
  
# Felter i en horisontal række:
function htm_FrstFelt($wth,$bord=0,$more='') {echo '<TABLE BORDER="'.$bord.'"  border-collapse: collapse; padding: 0px; width:100%;><TR '.$more.'><TD width="'.$wth.'"> ';}
function htm_NextFelt($wth) {echo '</TD>  <TD style="width:'.$wth.';"> ';}
function htm_LastFelt()     {echo '</TD>  </TR> </TABLE>';}

function Head_Navigation ($sideObjekt, $status, $goPrev, $goHome=true, $goUp, $goFind, $goNew, $goNext) { # Genvejsknapper på siders top.
  global $ØProgRoot;
  $sideObjekt= tolk($sideObjekt).'. ';
  echo '<PanlHead>';
  htm_Rude_Top($name='naviform',$capt='',$parms='',$icon='','panelWmax',__FUNCTION__);
  echo '<div style="text-align: center" ><img src= '.$ØProgRoot.'_assets/images/saldi-e50x170.png" alt="Saldi Logo" style="width:170px;height:50px;"></div>';
//  echo '<p align="center"><b>'.tolk('@Navigation:').'<b></p>';
  echo '<p align="center">';  #<ic class="fa '.$icon.'" style="font-size:22px;color:green"></ic>
  if ($goPrev)  iconKnap($faicon='fa-caret-square-o-left',  $title= tolk('@Vis forrige')  .' '.$sideObjekt    ,$link='../_base/page_Blindgyden.php',$akey='f');
  if ($goHome)  iconKnap($faicon='fa-home',                 $title= tolk('@Luk vinduet og gå til hoved-menu.'),$link='../_base/page_Gittermenu.php'.$goBack,$akey='h');
  if ($goUp  )  iconKnap($faicon='fa-caret-square-o-up',    $title= tolk('@Luk vinduet og gå et niveau op.')  ,$link= $goBack,                      $akey='l');
  if ($goFind)  iconKnap($faicon='fa-search',               $title= tolk('@Søg en anden') .' '.$sideObjekt    ,$link='../_base/page_Blindgyden.php',$akey='s');
  if ($goNew )  iconKnap($faicon='fa-plus-square-o',        $title= tolk('@Opret ny')     .' '.$sideObjekt    ,$link='../_base/page_Blindgyden.php',$akey='o');
  if ($goNext)  iconKnap($faicon='fa-caret-square-o-right', $title= tolk('@Vis næste')    .' '.$sideObjekt    ,$link='../_base/page_Blindgyden.php',$akey='v');
  echo '</p>';
//  if ($status) {
//    $status= '<x1 style="font-weight:300; font-size:smaller"> - Status:<colrlabl> '.$status.'</colrlabl></x1>';
//    echo '<p align="center">'.ucfirst($sideObjekt).$status.'</p> ';
//  }
  htm_RudeBund($pmpt='@Gem',$subm=false,$title='@Gem',$akey='');
  echo '</PanlHead>';
}

# PROGRAM-MODUL;
function SprogValg(&$ØprogramSprog) {
# Disse sprog-fraser skal IKKE oversættes, da valgmuligheder skal forstås af udlændinge!
  #htm_Caption('@Program sprog:');
  echo '<span style="display: inline-block; width:180px">';
  htm_OptioFlt($type='text', $name='progsprog', $valu=$ØprogramSprog, 
      $labl= '@Program sprog:', 
      $titl= tolk('@Hvilket sprog vil du benytte programmet med ?').' <br> (Virker kun delvist!. 2 opdateringer nødvendig!!!)', 
      $revi=true, $optlist= array( # [0]:Tip [1]:value [2]:Text  [3]:events
      ['Vælg dansk sprog',               'da','Dansk',    ],  //  Redigeres noget her, skal der også redigeres i Rude_LanguageJuster()
      ['Select English language',        'en','English',  ],
      ['Wählen Sie deutsche Sprache',    'de','Deutsch',  ],
      ['Choisissez la langue française', 'fr','Français', ],
      ['Türk Dili seçin',                'tr','Türkçe',   ],
      ['Wybierz język duński',           'pl','Polski',   ],  //  pl-PL	Polish (Poland)
      ['Elegir el idioma español',       'es','Español',  ],
      ['Selezionare la lingua italiana', 'it','Italian',  ]),
      $action= $result= $_POST[$name],
      $events='onchange="this.form.submit();"  ');  //   onblur="window.location.reload(true);"  ');  //  onchange="update(this)"
    echo '</span>';
    if (strlen($result)==2) $ØprogramSprog= $result;
    $_SESSION['ØprogramSprog']= $ØprogramSprog;    //  $ØprogramSprog= $_SESSION['ØprogramSprog']; udføres i ../_base/htm_pageHead.php
}
// SprogValg Virker kun delvist! Første gang opdates sprog kun i lokal rude, 2. gang følger de øvrige med!

function Foot_Links ($maxi=false, $arg='', $doPrint, $doErase, $doLookUp, $doAccept, $doExport, $doImport,$OpslLabl='') { global $ØprogramSprog, $ØProgTitl, $Ønovice;
  htm_Rude_Top($name='linkform',$capt='',$parms='',$icon='','panelWmax',__FUNCTION__);
    if (($maxi) and ($OpslLabl>'')) echo '<p align="center"><b>'.tolk('@Handling:').'<b></p>';
    echo '<p align="center">';  #<ic class="fa '.$icon.'" style="font-size:22px;color:green"></ic>
    if ($doPrint)   iconKnap($faicon='fa-print',                $title= tolk('@Udskriv')  .' '.$sideObjekt,     $link='../_base/page_Blindgyden.php');
    if ($doErase)   iconKnap($faicon='fa-minus-square-o',       $title= tolk('@Slet posten'),                   $link='../_base/page_Blindgyden.php'.$goBack);
    if ($doLookUp)  iconKnap($faicon='fa-search-plus',          $title= '? '.tolk($OpslLabl),                   $link='../_base/page_Blindgyden.php');
    if ($doAccept)  iconKnap($faicon='fa-check-square-o',       $title= tolk('@Godkend alt')  .' '.$sideObjekt, $link='../_base/page_Blindgyden.php');
    if ($doExport)  iconKnap($faicon='fa-upload',               $title= tolk('@CSV-Export')   .' '.$sideObjekt, $link='../_base/page_Blindgyden.php');
    if ($doImport)  iconKnap($faicon='fa-download',             $title= tolk('@Fil import')   .' '.$sideObjekt, $link='../_base/page_Blindgyden.php');
    echo '</p>';
    if ($maxi) { 
      htm_FrstFelt('15%',0,'style="text-align:left;"');  
      htm_NextFelt('20%');    echo '<span style="text-align:left">'.SprogValg($ØprogramSprog).'</span>';
      htm_NextFelt('08%');    textKnap($label='@TIPs',  $title='@Her er der nyttige tips, til brugen af SALDI', $link='../_base/page_Blindgyden.php');  // link= 'Tips()');
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
function MenuStart($clas='firstmain',$href='#',$labl='',$titl='') {  //  SKAL efterfølges af MenuSlut()
  echo "\n";
  echo '<div id="container">';
  echo '  <div id="wb_TopMenu" style="position:absolute;left:0px;top:1px;width:1200px;height:24px;z-index:99;">';
  echo '    <ul>';
  echo '      <li class="'.$clas.'"><a href="'.$href.'" target="_self" title="'.tolk($titl).'">'.tolk($labl).'</a> </li>';
}
function MenuGren($clas='',$href='#',$labl='',$titl='') {
  echo "\n";
  $argu= 'href="'.$href.'" target="_self" title="'.tolk($titl).'">'.tolk($labl);
  if ($clas=='withsubmenu') echo "\n".'<li><a class="'.$clas.'"    '.$argu.'</a>  <ul>';
  if ($clas=='firstitem')   echo "\n".'<li    class="'.$clas.'"><a '.$argu.'</a> </li>';
  if ($clas=='')            echo "\n".'<li>                     <a '.$argu.'</a> </li>';
  if ($clas=='lastitem')    echo "\n".'<li    class="'.$clas.'"><a '.$argu.'</a> </li></ul></li>';
}
function MenuSlut() {global $ØProgRoot;
  echo "\n";
  echo '    </ul>';
  echo '  <div style="text-align: center"; title="Designed by EV-soft"><img src= "'.$ØProgRoot.'_assets/images/saldi-e50x170.png" alt="Saldi Logo" height="40" width="150" ></div>';
  echo '  <br>';
  echo '  </div>';  //  wb_TopMenu
  echo '</div>';    //  container
  echo "\n";
}

function Menu_Topdropdown() { //  Menu-placering/størrelse foregår i MenuStart()
global $Ødebug;
  MenuStart($clas='firstmain',      $href='../_base/page_Gittermenu.php',         $labl='@MENU',                $titl='@Gå til Hovedmenu i gammelt layout');
    MenuGren($clas='withsubmenu',   $href='#',                                    $labl='@FINANS',              $titl='@Regnskabs rutiner');
      MenuGren($clas='firstitem',   $href='../_finans/page_Kladdeliste.php',      $labl='@Kasse kladder',       $titl='@Her kan du vælge kassekladde, og redigere den');
      MenuGren($clas='',            $href='../_finans/page_Regnskab.php',         $labl='@Regnskab',            $titl='@Se det aktuelle regnskab her');
      MenuGren($clas='',            $href='../_finans/page_Budget.php',           $labl='@Budget',              $titl='@Se og rediger budget');
      MenuGren($clas='',            $href='../_system/page_Kontoplan.php',        $labl='@Kontoplan',           $titl='@Her vedligeholder du den aktuelle kontoplan');
      MenuGren($clas='',            $href='../_finans/page_Rapport.php',          $labl='@Rapporter',           $titl='@Her vælger du hvad du vil se i en rapport');
      MenuGren($clas='lastitem',    $href='../_finans/page_Kontrol.php',          $labl='@Kontrol spor',        $titl='@Her kan du spore datas oprindelse');
            
    MenuGren($clas='withsubmenu',   $href='#',                                    $labl='@DEBITOR',             $titl='@Rutiner angående debitorer');
      MenuGren($clas='firstitem',   $href='../_debitor/page_Opretordre.php',      $labl='@SALG-daglig...',      $titl='@De hyppigst benyttede rutiner angående salg...');
      MenuGren($clas='',            $href='../_debitor/page_Ordreliste.php',      $labl='@Salgs ordrer',        $titl='@Oversigt over ordrer og deres indhold');
      MenuGren($clas='',            $href='../_debitor/page_Debitor.php',         $labl='@Konti',               $titl='@Oversigt over kunder, og leverancer til disse');
      MenuGren($clas='lastitem',    $href='../_debitor/page_Rapport.php',         $labl='@Rapporter',           $titl='@Analyser af salg');
              
    MenuGren($clas='withsubmenu',   $href='#',                                    $labl='@KREDITOR',            $titl='@Rutiner angående kreditorer');
      MenuGren($clas='firstitem',   $href='../_kreditor/page_Ordreliste.php',     $labl='@KØB-daglig...',       $titl='@De hyppigst benyttede rutiner angående indkøb...');
      MenuGren($clas='',            $href='../_kreditor/page_Ordreliste.php',     $labl='@Købs ordrer',         $titl='@Oversigt over leverandører');
      MenuGren($clas='',            $href='../_kreditor/page_Kreditor.php',       $labl='@Konti',               $titl='@Oversigt over kreditorer og oplysninger om disse');
      MenuGren($clas='lastitem',    $href='../_kreditor/page_Rapport.php',        $labl='@Rapporter',           $titl='@Analyser af køb');
        
    MenuGren($clas='withsubmenu',   $href='#',                                    $labl='@LAGER',               $titl='@Rutiner angående produkter');
      MenuGren($clas='firstitem',   $href='../_lager/page_Varer.php',             $labl='@Vare lister',         $titl='@Oversigt over salgsvarer');
      MenuGren($clas='',            $href='../_lager/page_Varemodtagelse.php',    $labl='@Vare modtagelse',     $titl='@Lister for varemodtagelse');
      MenuGren($clas='lastitem',    $href='../_lager/page_Beholdningsliste.php',  $labl='@Rapporter',           $titl='@Analyser over varer');
        
    if ($vis_prodkt) { 
      MenuGren($clas='withsubmenu', $href='#',                                    $labl='@PRODUKTION',          $titl='@Rutiner angående produktion');
    }
      
    MenuGren($clas='withsubmenu',   $href='#',                                    $labl='@SYSTEM',              $titl='@Rutiner angående indstillinger af systemet');
      MenuGren($clas='firstitem',   $href='../_system/page_Kontoplan.php',        $labl='@Kontoplan',           $titl='@Her vedligeholder du den aktuelle kontoplan');
      MenuGren($clas='withsubmenu', $href='#',                                    $labl='@Indstillinger',       $titl='@Indstillinger for programmet');
        MenuGren($clas='firstitem', $href='../_system/page_Valuta.php',           $labl='@1. indstil-ofte',     $titl='@Her har du de hyppigst benyttede indstillinger');
        MenuGren($clas='',          $href='../_system/page_Divsetup2.php',        $labl='@2. indstil-flere',    $titl='@Her har du de sjældnere benyttede indstillinger');
        MenuGren($clas='lastitem',  $href='../_system/page_Tilvalgsetup3.php',    $labl='@3. indstil-extra',    $titl='@Her aktiverer og indstiller tilvalgs funktioner');
      MenuGren($clas='lastitem',    $href='../_system/page_Backup.php',           $labl='@Sikkerheds kopiering',$titl='@Her kan du sikre dig dine regnskabsdata');
    if ($Ødebug) { 
      MenuGren($clas='withsubmenu', $href='#',                                    $labl='@TOOLS',               $titl='@Udviklerens redskaber');
        MenuGren($clas='firstitem', $href='../_base/_tools/frasescann.php',       $labl='@Frase-skanning',      $titl='@Skanning efter danske fraser, som skal oversættes');
        MenuGren($clas='',          $href='../_base/_tools/funcscann.php',        $labl='@Funktions-skanning',  $titl='@Skanning efter funktions navne, og parametre');
        MenuGren($clas='',          $href='../_base/_tools/wordscann.php',        $labl='@Ord-skanning...',     $titl='@Skanning efter et angivet ord, f.eks. Rude_');
        MenuGren($clas='lastitem',  $href='../_system/page_Syssetup.php',         $labl='@Side test...',        $titl='@Test af sider under udvikling');
    }
  MenuSlut();
}
 
### SPALTER, PANELER m.v.:
// Spalter:
function SpalteTop ($w=240) {pretty('SpalteTop');  echo '<PanlHead> <div id="wrapper"> <column id="spalt'.$w.'">'; } // SpalteTop spalt240, spalt320 (erkl. i Out_style.css.php)
function NextSpalte($w=320) {echo '</column> <column id="spalt'.$w.'">'; }            // SpalteBund/SpalteTop
function SpalteBund() {echo '</column> </div> </PanlHead><div class="clearWrap"/>'; } // erstatter EndSpalter

// Paneler:
function panelStart() {pretty('panelStart');  echo '<PanlFoot>';}
function panelSlut()  {echo '</PanlFoot>';}
function skilleLin () {echo '<hr size="10" color="#AA4D00">';}

// Layout-rutiner:
function htm_CentHead($txt='')  {echo '<div style="text-align:center; font-weight:900;"><colrlabl>'.$txt.'</colrlabl></div>';}
function htm_CentrOn($more='')  {echo '<div style="text-align:center; '.$more.'">';}
function htm_CentOff()          {echo '</div>';}
function htm_Spacer($w='30')    {echo '<div1 style= "width:'.$w.'em">&nbsp; </div1>';}

// Streng-funktioner:
function htm_hr()         {return '<hr>';}
function htm_nl($rept=1)  {return str_repeat('<br>',$rept);}
function str_lf($rept=1)  {return str_repeat(' &#xa;',$rept);}  //  LineFeed i strenge
function htm_Ihead($head) {return htm_nl().'<i>'.$head.'</i> ';}

# SUPPLERENDE moduler:


//////////////////////////////////////////////////////////////////////////////////////////////////////////
# SPROG system:

function sprogDB_import() { # Filen skal være gemt i UTF-8 format!
  global $ØsprogTabl, $ØlanguageTable, $ØProgRoot; //  $ØlanguageTable indeholder ALLE sprog
 // $fp=fopen($fname= $ØProgRoot.$_config.'Sprog_DB.csv',"r");
  $fp=fopen('../_config/Sprog_DB.csv',"r");
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

function found_index($sprogDB, $field, $value) {
  foreach($sprogDB as $key => $row) {
     if ($row[$field] === $value)  
    {return $key; break;}
  }  return false;  # 'TranslateError';
}

function Tolk($FraseKey) {                              # Tolk() benyttes til sprogoversættelse af alle hard-codede program-tekster.
  global $ØsprogTabl, $ØprogramSprog,                   # Fraser med @-prefix er system-tekster, der kan omsættes til andet sprog.
         $ØlanguageTable, $debug;                       # Vær opmærksom på at samme frase, ikke kaldes flere gange f.eks. i rutiner i underniveauer.
 if (substr($FraseKey.' ',0,1)!='@') {return($FraseKey); exit;}  # Kan være tolket tidligere!
 if (($ØprogramSprog) and ($ØlanguageTable))    
  switch ($ØprogramSprog= strtolower($ØprogramSprog)) { # 0 Key             
    case "da" :$result= trim($FraseKey,'@');  break;    # 1 Dansk          da: Vis frasen uden prefix, skal udkommenteres! (ellers lystres ikke brugerrettelser)
    case "da" :$ix= 1;  break;                          # 1 Dansk          sæt index for opslag
    case "en" :$ix= 2;  break;                          # 2 Engelsk        sæt index for opslag
    case "de" :$ix= 3;  break;                          # 3 Deutsch        sæt index for opslag
    case "fr" :$ix= 4;  break;                          # 4 Français       sæt index for opslag
    case "tr" :$ix= 5;  break;                          # 5 Türkçe         sæt index for opslag
    case "pl" :$ix= 6;  break;                          # 6 Polski         sæt index for opslag
    case "es" :$ix= 7;  break;                          # 7 Español        sæt index for opslag
    case "it" :$ix= 8;  break;                          # 8 Italian        sæt index for opslag
                                                        # 9 Grønlandsk       
    default   : {$ix= 1; echo "<colrlabl>Sprog?:".$ØprogramSprog." </colrlabl>"; break;}
  } else $ix= 1;
  $TblRow= found_index($ØlanguageTable, 0, $FraseKey);
  if (substr($FraseKey,0,2)=='@:') {};                                    # Er frasen med @:-prefix: (Angår blanketter/formularer) ikke benyttet endnu!
  if (substr($FraseKey,0,1)=='@')                                         # Er frasen med @-prefix:
       {if ($ØprogramSprog=='da')  {$result= trim($FraseKey,'@');}        #   Er sproget dansk fjernes @-prefix blot i resultatet, skal udkommenteres!
        else if ($TblRow>0) {$result= $ØlanguageTable[$TblRow][$ix];}     #   ellers slås op i sprogtabellen
        else 
        if ($debug) {$result= trim($FraseKey,'@');}
        else #{$result= $FraseKey.'<small><small> (Danish!)</small></small>'; $MissingFrase.='<br>'.$FraseKey;} # Oversættelse mangler: Vis $FraseKey  med @-prefix
          {$result= trim($FraseKey,'@');}
       }  
  else {$result= $FraseKey;}                                              # Fraser uden @-prefix returneres uændret.
  return($result= trim($result,',"'));
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



//- function htm_HiddVari($name='',$val='') {
//-   if ($val=='') {$val= $name;	 global $$val; $valu= $$val; } else $valu= $val;
//-   echo "\n<input type='hidden' name='$name' value='$valu'>";
//- }
function htm_HiddVari($name='',$val='') {
  if ($val=='') {$val= $name;  global $$val; $valu= $$val; } else $valu= $val;
  echo '<input type="hidden" name="'.$name.'" value="'.$valu.'">';
}
function htm_NullVariabler($namelist=['']) { foreach ($namelist as $name) {global $$name; $name = NULL; }}
function htm_GetVariabler($namelist=[''])  { foreach ($namelist as $name) {global $$name; $name = if_isset($_GET[$name]); }}
function htm_PostVariabler($namelist=['']) { foreach ($namelist as $name) {global $$name; $name = if_isset($_POST[$name]); }}




  

$kontoTypeListe= array(['H','@Overskrift'],['D','@Drift'],['S','@Status'],['Z','@Sum'],['R','@Resultat'],['X','@Sideskift'],['L','@Lukket']);

$momsKodeListe= array(['K','@Købsmoms'],['S','@Salgsmoms'],['Y','@Ydelsesmoms'],['E','@EU-varemoms']);

$artsKodeListe= array(['VG','@yyy'],['DG','@yyy'],['KG','@yyy'],['VPG','@yyy'],['VTG','@yyy'],['VRG','@yyy'],['SM','@SalgsMomskonto'],['VK','@ValutaKoder'],['PRJ','@yyy'],
                      ['YM','@YdelsesMomskonto-udland'],['EM','@VareMomskonto-udland'],['KM','@KøbsMomskonto'],['SD','@SamlekontoDebitor'],
                      ['KD','@KreditorSamlekonto'],['RA','@yyy'],['PV','@yyy'],['LG','@LagerGrupper'],['S','@yyy'],['xx','@yyy'],['xx','@yyy']);
                  #     'MR' @MomsRapportkonto
# Diverse lister: [Tip Tekst, Value, Label]
function JustListe () {return( [['@Venstre justeret','V','V'],['@Center justeret','C','C'],['@Højre justeret','H','H']] ); }
function SideListe () {return( [['@Alle sider','A','A'],['@Første side','1','1'],['@IKKE første side','!1','!1'],['@Sidste side','S','S'],['@IKKE Sidste side','!S','!S']] ); }
function FontListe () {return( [['@Sans-serif','Helvetica','Helvetica'],['@Serif','Times','Times'],['@Optisk Læsbar','OCRbb12','OCRbb12']] ); }
function KontListe () {return( [['@Drifts konto','D','D'],['@Status konto','S','S'],['@Sum konto','Z','Z'],['@Overskrift (system!)','H','H'],['@Resultat konto','R','R'],['@Sideskift (system!)','X','X'],['@Lukket konto','L','L']] ); }
function MomsListe () {return( [['@Købs-moms','K1','K1'],['@Salgs-moms','S1','S1'],['@Ydelses-moms','Y1','Y1'],['@E_-moms?','E1','E1']] ); }
function ValuListe () {return( [['@Danske kroner','DKK','DKK'],['@Euro','EUR','EUR'],['@US dollar','$','$'],['@Engelsk pund','£','£']] ); }
function StatListe () {return( [['@Aktiv','1','Aktiv'],['@Lukket','0','Lukket']] ); }
function Aar_Liste () {return( [['2015','2015','2015'],['2016','2016','2016'],['2017','2017','2017']] ); }

#$Ø_ArtList=
function Art_Liste () {return( [['@Kontokort med moms','kontokort_moms','@Kontokort med moms'],
             ['@Kontokort','kontokort','@Kontokort'],
             ['@Balance','balance','@Balance'],
             ['@Resultat/budget','resultatb','@Resultat/budget'],
             ['@Resultat','resultat', '@Resultat'],
             ['@Budget','budget','@Budget'],
             ['@Momsangivelse','momsangivelse','@Momsangivelse'],
             ['@Månedsliste','maanedsliste','@Månedsliste']
            ] ); }
## Husk at Tolk() skal benyttes i kald til @fraser!

// Variabler med prefix: $Ø_ benyttes globalt!

function DanListe($listen,$suff='') {
    $result=[]; $ix=0; foreach ($listen as $elem) array_push($result,[tolk($elem).$suff,$ix++,tolk($elem)]); return($result);  # : [Tip Tekst, Value, Label]
//  $result=[]; $ix=0; foreach ($listen as $elem) array_push($result,[$elem.$suff,$ix++,$elem]); return($result);  # : [Tip Tekst, Value, Label]
}
// Følgende variabler med prefix: $Ø_ er beregnet til global anvendelse. Husk erklæring: global $Ø_varname når de skal kaldes i lokalt scope.
  $mdr= ['@januar','@februar','@marts','@april','@maj','@juni','@juli','@august','@september','@oktober','@november','@december'];
  $Ø_MdrList= DanListe($mdr, ' '.tolk('@måned'));		#	tolk() erklæres først i out_base!

  $dag= ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'];
 $Ø_DagList= DanListe($dag, '. '.tolk('@dag i måneden'));


/*  

OM systemet:
 Al output til skærm, sker via centrale rutiner, som er blok-struktureret, så rettelser kun skal
 udføres et minimum steder. [out_base.php]
 Hvor der benyttes: "echo" skal det vurderes, om subrutiner kan benyttes, eller skal oprettes.
 
 Alle vinduer opbygges af ruder (paneler), som alle er defineret i [our_ruder.php]
 Ruders titel består af en icon og en tekst, og de har ofte en Gem-knap i bunden.
 Alle HTML-sider initieres med filen [htm_pageHead.php] og afsluttes med [htm_pageFoot.php]
 
 Adaptive layout ved Skærmbredde[px]:
 < 320    : 1 spalte med fast bredde. 5-kolonnet Gittermenu ombrydes.
 320.. 640: 1 spalte med varierende bredde. 5-kolonnet Gittermenu ombrydes.
 640..1000: 1 spalte med varierende bredde. Gittermenu i fuld bredde.
 > 1000   : 3-spaltet layout. Fast spalte-bredde: 320px. Gittermenu i fuld bredde.
 
 (En vertikal menu kan reducere bredden til 4 elementer! : 415px)
 
 Tip vises ved mus over tydeligt markeret label, som ikke optager selvstændig plads men er indeholdt i input-felt.
 Der er konsekvent angivet tip for: Knapper for navigation, Knapper for funktioner, Kolonne-overskrifter, Titler, m.fl.
 Der kan angives tast-genveje for alle knapper/links
 
 Tabeller er med fast vindueshøjde, så overskrifter over og knapper under tabellen, altid kan være synlige.
 Der er grundlæggende 2 tabel-rutiner: KunSeData og SeOgRetData. Budget benytter en skræddersyet version.
 Tabeller kan med flag akti-/deaktivere: Filter, Sortering, Opret ny record
 
 Alle labels og tip kan oversættes til et andet program-sprog (7 europæiske sprog), 
 med nem opdatering af alle forekommende fraser, når prefix: @ er benyttet.
 Fraselængden for dansk bør pt. begrænses til max. 200 tegn.
 Er der længere fraser, skal de opdeles i flere, ved at indskyde >'.'@< i frasen,
 på et hensigsmæssig sted (ny sætning) for ikke at sabotere sprogoversættelse.
 Tegn der ikke må benyttes: < > " @ (udover prefixet)' fordi de mistolkes!
 Formaterings tags som: </small> fjernes. De skal i stedet indeholdes i selvstændige strenge omkring fraser.
 Slut ikke en frase med SPACE, da den kan blive fjernet, og key passer da ikke!
 Brugeren kan selv korrigere sprog-tekster i regneark. Finjusteringen kan også udføres i programet.
 
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
 
 Der mulighed for assistance til fejlfinding, når flaget (debug==true)
 
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
