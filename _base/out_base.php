<?php   $DocFil1='../_base/out_base.php';    $DocVer1='5.0.0';    $DocRev1='2018-10-06';     $DocIni='evs';  $ModulNr=0;
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
  2018-05-12 EVS - Mange <div> ændret til <span> og CSS: span { display: block; } - pga. browser skjuler "automatisk" med display:none på div af ukendt årsag!  (ad-block reklame-spærring?)
      

 * ## AFHÆNGIGHED:
 * out_base.php er afhængig af: out_init.php og out_style.css.php
 * page_*.php er afhængig af: htm_pagePrepare.php og htm_pageFinalize.php
 * 
 * ## Benyttede prefixer i fil-navne:
 * htm_*.php  - Grundmoduler (htm_*) egnet for adaptive skærm-output.
 * out_*.php  - Modulerne benyttes KUN i out_Panls.php, hvor system-paneler opbygges.
 * out_*.php  - Ruder spalte-opsættes efterfølgende i out_vinduer.php, som er de vinduer brugeren oplever. 
 * page_*.php - Sider bestående af et eller mange vinduer gemmes i filer med prefix: page_*.php f.eks.: page_Layoutdemo.php
 * save_*.php - Filer som overfører data til/fra database. ??
 * ini_*  - Initiering af Database, konstander og variabler
 * fil_*  - Fil-funktioner
 * dbi_*  - DataBase-funktioner - nyeste standarder
 * spc_*  - Specielle funktioner
 * 
 * ## Andre benyttede prefixer i funktions-navne:
 * dvl_*  - Develop-system
 * msg_*  - Message-system
 * Panl_* - Panel i spaltesystem
 * Lbl_*  - Label i input-system
 * str_*  - String-funktion
 * set_*  - Tildel variabel(er) deres værdi
 
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
 *   f.eks: page_Kladdeliste.php.
 *   PHP-rutiners navne er ufølsomme overfor store/små bogstaver. 
 *
 * ## NOTER:
 * Alle filer er redigeret med tabulator sat til 2 tegn, og ses bedst med det.
 * Fremover gennemføres det, at benytte 2*SPACE i stedet for TAB, som ikke kan justeres på Github.
 *
 * StrengAdskiller: Primært benyttes '-tegnet som PHP-tekstafgrænser, og "-tegnet som HTML-tekstafgrænser.
 *   Herved minimeres nødvendigheden af ESC-tegnet: \ og kildetekster bliver mere læsbare.
 *   Eks.: echo '<input type= "hidden" id= "'.$id.'" name= "'.$name.'" value= "'.$valu.'" />';
 *   Med syntaks-visning aktiv, fremstår ovennævnte klarest.
 *
 * Af hensyn til søg/erstat mulighed, tilstræbes det at benytte "separatorer" og SPACE således: 
 *   $variabel= ['x', 'y', 'z']; dvs. Ingen SPACE foran og en SPACE efter separator/operator. Ingen SPACE ved paranteser.
 *   Kun i lange sekvenser udelades SPACE efter separator/operator.
 *
 * Funktions-parametre:
 *   Variabelnavne kan udelades i funktions-parametre, men er medtaget for tydeliggørelse, for andre end forfatteren.
 *   Ofte er alle variabler angivet, selvom default-værdier benyttes. Også dette er af hensyn til andres forståelse af koden.
 *   Eks: htm_OptioFlt($type='text', $name='name', $valu='Leverandør', $labl='@Leverandør', $titl='@Leverandør', $revi=true, $optlist=[], $action='onchange="getComboA(this)"');
 *   Kunne simplificeres
 *   til: htm_OptioFlt('text', 'name', 'Leverandør', '@Leverandør', '@Leverandør'); --- hvis $revi og flg. er tildelt standardværdier.
 *
 * Repeter jævnligt disse regler, og efterlev dem, så der opnås ensartethed i kildefilerne !!!
 * Ensartethed er bl.a. vigtig for søg/erstat muligheder.
 * Og ikke mindst, tvetydighed og misforståelser af kode, spilder programmørens tid...
 *
 * Se også nyttige noter i starten af ../_base/out_init.php
 *
 * ## REVISIONER:
 * 2016.08.00 evs - EV-soft : 1. udgave af filen                                                     
                                                                                                    
 * ***** Grundlæggende Rutiner for layout og visning af data ***************************************

 * ## include "../_base/out_init.php";  // Skal kaldes forinden. (sker i htm_pagePrepare.php)
 * if ($GLOBALS["$Ødebug"]) debug_log($DocVer1,$DocRev1,$modulnr1,$DocFil1,'');
 * echo "\n<!-- $DocVer1  $DocRev1  $modulnr1  $DocFil1 -->\n";
                                                                                                    
 * ***** Anvendte begreber for layout og visning af data ***************************************
 * Page_* : HTML-vindue opdelt i Spalter
 *             : indeholdende Paneler
 * Wall_* : gruppe af Paneler på Tapet
 * Panel  : gruppe af tekster og datafelter
 * (Tidligere: Rude_* er erstattet af Panl_* som er mere forståelig af engelsksprogede)

 */

if ($GLOBALS["$Ødebug"]) debug_log($DocVer1,$DocRev1,$modulnr1,$DocFil1,'');

global $ØProgRoot, $ØHeaderFont;
DocAlder($DocRev1,$DocFil1);

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
function Lbl_Tip($lbl,$tip,$plc='',$h='13px') { # Label med popup-tip til brugeren, når musen holdes over label.
  if ($lbl=='') return ''; 
  else {
    dvl_pretty('Lbl_Tip');
    if ($h=='0px') {$h='';}
    switch (strtoupper($plc)) {
      case "W":  $class= 'tooltipL';  break;    # Plac. TV
      case "S":  $class= 'tooltipB';  break;    # Plac. Under
      case "O":  $class= 'tooltipR';  break;    # Plac. TH
      case "N":  $class= 'tooltipT';  break;    # Plac. Over
      case "NW": $class= 'tooltipNW'; break;    # Plac. Retning NW /B0
      case "SW": $class= 'tooltipSW'; break;    # Plac. Retning SW /B1
      case "SO": $class= 'tooltipSØ'; break;    # Plac. Retning SØ /B2
      default :  $class= 'tooltiptext'; # Plac. Over
    }
    if (strlen($tip.' ')<140) {$wdth='';} else {$wdth='style ="min-width: 380px;"';}
    return '<span class="tooltip" style="height:'.$h.';">'.ucfirst(tolk($lbl).' ').'<span class="'.$class.'" '.$wdth.'>'.tolk($tip).'</span></span>';
  //  return 'TESST';
  }
}
// $ØoldStyle= true;
# BASISMODUL for data-visning, label, titelTip og input:     ($more giver mulighed for at benytte parametre, som ikke er forud defineret. f.eks: 'min="-99" max="99"') // Ændret rækkefølge: $labl ,$titl
function htm_CombFelt($type='',$name='',$valu='',$labl='',$titl='',$revi=true,$rows='2',$width='',$step='',$more='',$plho='')   # Inputfelt kombineret med label
{ global $ØblueColor, $ØoldStyle;
  dvl_pretty('htm_CombFelt');
  $LablTip= Lbl_Tip($labl,$titl,'','13px; top: -6px;'); 
  $lhAlign= 'style="line-height:100%; padding-top:6px; text-align:'; //  padding-top: 6px; Label: top: -6px;
  $LBinput= '<span class="lablInput"> <input type= ';
  $patt1= ' pattern="^\d*\.?((25)|(50)|(5)|(75)|(0)|(00))?$" /> <label for="';
  $patt2= ' pattern="(\d{3})([\.])(\d{2})" />  <label for="';
  $eventInvalid= 'oninvalid="this.setCustomValidity(\''.tolk('@Angiv ').tolk($labl).'! '.'\')"';
  if (($name=='posi') or ($name=='antal')or ($name=='varenumr'))     {$align= ' style="text-align:center; ';} else $align= 'style="';
  if (gettype($valu)== 'Float') $type= 'number'; 
  if ($revi==true) $aktiv= ''; else $aktiv=' disabled ';
  if ($browser=='firefox') {$sm= 'font-size:small;'; } else {$sm='';}   //  font-size:small fordi browser input, er voldsomt bredt!
  if ($plho=='')   $plh='';    else $plh=' placeholder="'.$plho.'"';
  switch ($type) {     
    case 'date'    : echo $LBinput.'"date" '.$more.' id="'.$name.'" name="'.$name.'" style="line-height:100%; '.$sm.' height:24px;" value="'.$valu.
                    '" placeholder ="yyyy-mm-dd" '.$aktiv.' />  <label for="'.$name.'">'.$LablTip.'</label> </span>'; break; 
    case 'time'    : echo $LBinput.'"number" '.$more.' style="text-align: center; step="'.$step.'" id="'.$name.'" name="'.$name.
                    '" style="line-height:100%; '.$sm.' height:14px;" value="'.$valu.'" '.$aktiv.' />  <label for="'.$name.'">'.$LablTip.'</label> </span>' ; break; 
    case 'text'    : if ($ØoldStyle) 
                      echo '<span style="text-align:right; width:40%; font-size:50%">'.tolk($labl).':</span><input type="text" width="'.$width.'" id="'.$name.'" name="'.$name.'" '.
                      $align.'" value="'.$valu.'" '.$eventInvalid.' '.$aktiv.$plh.' />';
                    else
                      echo $LBinput.'"text" '.$more.' width="'.$width.'" id="'.$name.'" name="'.$name.'" '.$align.' line-height:100%; padding-top:6px;" value="'.$valu.'" '.
                                  $eventInvalid.' '.$aktiv.$plh.' /> <label for="'.$name.'">'.$LablTip.'</label> </span>';  break; 
                    # Antal:
    case 'tal1d'   : echo $LBinput.'"text" '.$more.' '.$lhAlign.'right;" width="'.$width.'" id="'.$name.'" name="'.$name.'" value="'.number_format((float)$valu,1,',','.').'"  '.
                    $eventInvalid.' '.$aktiv.$plh.$patt1.$name.'">'.$LablTip.'</label> </span>'; break; 
                    # Beløb og %:
    case 'tal2d'   : echo $LBinput.'"text" '.$more.' '.$lhAlign.'right;" width="'.$width.'" id="'.$name.'" name="'.$name.'" value="'.number_format((float)$valu,2,',','.').'"  '.
                    $eventInvalid.' '.$aktiv.$plh.$patt1.$name.'">'.$LablTip.'</label> </span>'; break; 
                    # Beløb og % - centerplaceret:
    case 'tal2dc'  : echo $LBinput.'"text" '.$more.' '.$lhAlign.'center;" width="'.$width.'" id="'.$name.'" name="'.$name.'" value="'.number_format((float)$valu,2,',','.').'"  '.
                    $eventInvalid.' '.$aktiv.$plh.$patt1.$name.'">'.$LablTip.'</label> </span>'; break; 
                    /* lang="en" for at tillade "."-tegn som decimal adskiller, foruden dansk ","-tegn */
    case 'tal0%'   : echo $LBinput.'"text" '.$more.' '.$lhAlign.'center;" width="'.$width.'" id="'.$name.'" name="'.$name.'" value="'.number_format((float)$valu,0,',','.').'%"  '.
                    $eventInvalid.' '.$aktiv.$plh.$patt1.$name.'">'.$LablTip.'</label> </span>'; break; 
                    
    case 'number'  : echo '<span class="lablInput"> <input type="number" '.$more.' lang="en" '.$lhAlign.'right;" width="'.$width.'px" step="'.$step.'" id="'.$name.
                    '" name="'.$name.'" value="'.$valu.'" '.$eventInvalid.' '.$aktiv.$plh.$patt2.$name.'">'.$LablTip.'</label> </span>';  break; 
                    # Beløb og % - venstreplaceret /* lang="en" for at tillade "."-tegn som decimal adskiller, foruden dansk ,-tegn */
    case 'numberL' : echo '<span class="lablInput" style="width:'.$width.'; display:inline-block; height:1.5em;"> <input type= "number" '.$more.' lang="en" '.$lhAlign.'left;" step="'.$step.
                    '" id="'.$name.'" name="'.$name.'" value="'.$valu.'" '.$eventInvalid.' '.$aktiv.$plh.$patt2.$name.'">'.$LablTip.'</label> </span>';  break; 
    case 'barc'    : echo $LBinput.'"text" '.$more.' width="'.$width.'" id="'.$name.'" name="'.$name.'" '.' '.$lhAlign.'center; font-family:barcode; font-size:20px;" value="'.$valu.'" '.
                    $eventInvalid.' '.$aktiv.$plh.' /> <label for="'.$name.'">'.$LablTip.'</label> </span>';  break; 
                    // Skræddersyet ! :
    case 'radio'   : echo '<form action=""><span>&nbsp; <small>'. // Nestet form!
                          '<data-colrlabl>'.$LablTip.':</data-colrlabl>  '.
                          '<input type= "radio" name="'.$name.'" value="privat"/> '.   tolk('@Privat').
                          ' &nbsp; <font style="color:'.$ØblueColor.'">'.              tolk('@eller').':</font>'.
                          '<input type= "radio" name="'.$name.'" value="erhverv"/> '.  tolk('@Erhverv').
                          '</small></span> </form>';  break; 
    case 'password': echo $LBinput.'"password" '.$more.' width="'.$width.'" id="'.$name.'" name="'.$name.'" style="line-height:100%;" value="'.$valu.'" '
                    .$eventInvalid.' '.$aktiv.$plh.' /> <label for="'.$name.'">'.$LablTip.'</label> </span>';  break; // Supplere med mulighed for at vise password
                     # PW med styrke måling:
    case 'passwordpower': {echo '<section><dspaniv class="lablInput">  '.
                                //    '<fieldset class="js-password-fieldset">'.
                                '<input type= "password" '.$more.' width="'.$width.'" id= "password-strength-code" name="'.$name.'" style="line-height:100%;" value="'.$valu.'"  '.
                                $eventInvalid.' '.$aktiv.$plh.' />'.   // Supplere med mulighed for at vise password (se: kommentarer i Panl_DBsetup)
                                //      '</fieldset>'.
                                ' <label for="'.$name.'">'.$LablTip.'</label> </span>';
                              echo '<meter max="4" id="password-strength-meter" title="Password Styrke måler: 5 niveauer"></meter>'.
                                   '<feedback id="password-strength-text" title="Feedback til det angivne password"></feedback></section>';
                          } ; break; 
    case 'mail'    : echo $LBinput.'"email" '.$more.' id="'.$name.'" name="'.$name.'" value="'.$valu.'"  '.
                    $eventInvalid.' '.$aktiv.$plh.' /> <label for="'.$name.'">'.$LablTip.'</label> </span>';  break; 
    case 'hidden'  : echo '<input type= "hidden" id="'.$name.'" name="'.$name.'" value="'.$valu.'" />';  break; 
    
    case 'html'    : echo '<span class="lablInput"> <div contenteditable="true" rows="'.$rows.'" id="'.$name.'" name="'.$name.'" style="line-height:100%;" '. //  Som area, men med html-indhold
                    $eventInvalid.' '.$aktiv.$plh.' '.$more.' >'.$valu.'</div>   <label for="'.$name.'">'.$LablTip.'</label> </span>  <br/>';  break; 
    case 'area'    : echo '<span class="lablInput"> <textarea rows="'.$rows.'" id="'.$name.'" name="'.$name.'" style="line-height:100%;" '.
                    $eventInvalid.' '.$aktiv.$plh.' '.$more.' >'.$valu.'</textarea>   <label for="'.$name.'">'.$LablTip.'</label> </span>  <br/>';  break; 
    default        : echo ' Type ikke defineret! ' ;
    dvl_pretty();
  }
} //  htm_CombFelt

function htm_CombList($name='ListName',$valu='',$labl='',$titl='',$liste, $more='') 
{ global $ØblueColor; 
  echo '<label style="color:'.$ØblueColor.'; font-weight:400; font-size:smaller;"><data-colrlabl>'.Lbl_Tip($labl,$titl).'</data-colrlabl>'.$result=htm_SelectStr($name,$valu,$liste,$more).'</label>'; 
  return $result;
}


# BASISMODUL for HTML checkbox:
function htm_CheckFlt($type='Fixed',$name='checkboxName',$valu='',$labl='',$titl='',$revi=true,$more='',$nl='<br/>') {
  if ($revi==true) {$aktiv= ''; $colr='';}  else {$aktiv=' disabled '; $colr='#_$888888';};   //  readonly kan evt. angives i $more
  if ($valu==true) {$valu= 'checked'; } else {$valu=''; };
  dvl_pretty('htm_CheckFlt');
  echo '&nbsp;<input type= "checkbox" name="'.$name.'" id="'.$name.'" value="" '.$valu.' '.$aktiv.' '.$more='padding-top: 1px;'.'/>'.
       '<label for="'.$name.'" style="color:'.$colr.'; padding:2px; ">';     dvl_pretty('htm_CheckFlt');
  echo '<data-colrlabl>'.Lbl_Tip($labl,$titl,'','13px; top: -2px;').'</data-colrlabl> </label> '.$nl;
  echo '<p id="resultat"></p>';
  run_Script('function GetStatus() {var status= document.getElementById("'.$name.'").checked; document.getElementById("resultat").innerHTML = console.log(status);}'); // [true, false]
  return($res= "<script>document.writeln(resultat);</script>");
  //  FIXIT: Noget mangler, ang. videregivelse og visning af status [tolk('@Ja'), tolk('@Nej')] når der gemmes SESSION variabel f.eks.: '@Medtag lagerbevægelser'
}

# SPECMODUL: statusvisning
function htm_StatsFlt($type='UnUsed',$name='UnUsed',$valu='',$labl='',$titl='',$nl='') {
  if ($valu) {$str= htm_DingBat('2714','green'); $title= tolk('@Testet OK');}
  else       {$str= htm_DingBat('2753','red').htm_DingBat('2757','red'); $title= tolk('@Her kan være et problem');};   //  htm_DingBat('2796','red')
  if ($titl=='') $titl= $title;
  dvl_pretty('htm_StatusFlt');
  echo '&nbsp;<xx name="'.$name.'" >'.
       '<label for="'.$name.'" title="'.$title.'">'.$str.'<data-colrlabl>'.Lbl_Tip($labl,$titl).'</data-colrlabl> </label> '.$nl;
  dvl_pretty();
}

function htm_DingBat($hex,$clr='black') {
  echo '<big style="color:'.$clr.'; background:#EEEEEE">&#x'.$hex.';</big>';
}

# BASISMODUL for HTML <select> Element (option):
function htm_OptioFlt($type='UnUsed',$name='',$valu='',$labl='',$titl='',$revi=true,$optlist=array(),$action='',$events='',$maxwd='300px',$onForm='',$nl=0) 
{ global $ØblueColor;
  dvl_pretty('htm_OptioFlt');
  $eventInvalid= 'oninvalid="this.setCustomValidity(\''.tolk('@Vælg '.$labl.' på listen!').'\')"';
  if ($revi==true) {$aktiv= ''; $colr='';} else {$aktiv=' disabled'; $colr='color:#888888;';}
  #$array= array(['Fil i pdf-format','pdf','PDF-fil'],['Elektronisk forsendelse','email','email'],['Elektronisk fakturering','ioubl','OIOUBL'],['PBS faktura','pbs','PBS']);
 # echo  '<form><!-- this is a dummy --></form> ';
    if ($nl>0) { htm_nl($nl); }
    echo '<span class="lablInput">';    
    echo ' <form'.$onForm.' action="'.$action.'" >';   # required  // Nestet form!
    echo '<label style="color:'.$ØblueColor.'; font-weight:400; font-size:smaller; top:-12px; ">
          <data-colrlabl style=" padding-right:6px;">'.Lbl_Tip($labl,$titl,'','13px; top: -2px;').'</data-colrlabl> ';  dvl_pretty();
    echo '<select class="styled-select" name="'.$name.'" '.$events.' '.$eventInvalid.' style="max-width: '.$maxwd.'; '.$colr.'" '.$aktiv.'> '; dvl_pretty();
    echo '<option label="?" value="'.$valu.'">'.tolk('@Vælg!').'</option> ';  # title="'.$titl.'"     selected="'.$valu.'"
      foreach ($optlist as $rec) {    dvl_pretty();  # $optlist= [0:Tip, 1:value, 2:Label, 3:Action]
        echo '<option '. /* .'label="'.tolk($rec[2]).'" '. */ 'title="'.tolk($rec[0]).'" value="'.$rec[1].'" '.$rec[3]; //  Firefox understøtter ikke Label !
        if ($rec[1]==$valu) echo ' selected ';
        echo '>'.$lbl=Tolk($rec[2]).'</option> ';
      } dvl_pretty();
    echo '</select></label>';
    //  $rec[3] kan indeholde hændelse
//    if ($action)
//    echo '<input type= "submit" id="Button1" name="submit" value="'.tolk('@Benyt').'"  title= "@Aktiver valget" style="position:absolute;left:70%;top:5px;width:50px;height:22px;z-index:6;">';
  if ($onForm=='') echo '</form>';
  dvl_pretty();
  echo '</span>';
}


# BASISMODUL for HTML radio-group:
function htm_RadioGrp($type='vert',$name='',$labl='',$titl='',$optlist=array(),$action='') 
{ global $ØblueColor,$ØbrwnColor; // Ændret rækkefølge: $labl ,$titl
  dvl_pretty('htm_RadioGrp');
#?  echo '<form action="'.$action.'">'; // Risiko for nestet form!
  echo '<span style="font-weight:400">'.
        '<label style="color:'.$ØblueColor.';">'.Lbl_Tip($labl,$titl).'  </label>'; //   font-size:small;
    foreach ($optlist as $rec) {
      if ($type=='vert') echo '<br>'; 
      if ($rec[3]) {$valgt= 'checked';} else $valgt= '';      dvl_pretty();
      echo '<input type= "radio" name="'.$name.'" value="'.$valu=$rec[0].'" '.$valgt.' title="'.tolk($rec[3]).'">'.
            $lbl= ' '.Tolk($rec[1]).' &nbsp; <font style="color:'.$ØbrwnColor.'">'.
            $suff=Tolk($rec[2]).'</font>&nbsp;'; 
  } 
  echo '</span>';  
#?  echo '</form>';
  dvl_pretty();
}


//  Afløser: iconKnap()
function iconButt ($faicon='',$title='',$link='',$akey='',$size='32px',$labl='') 
{ global $ØButtnBgrd, $ØTastkeys, $btnix;
  if ($ØTastkeys) {
    if ($akey) $genv=' ´<i>'.$akey.'</i>´'; else $genv='';
    if (!$genv) $tasttip=''; else $tasttip= '<br>'.tolk('@Tastatur genvej: ').$akey;
    if ($link=='') $targ= 'formtarget="_self"';
  }   dvl_pretty('iconButt');
  $btnix++;
  $fg= 'gray';
  $genv=''; // Vis ikke genvej i knaptekst, kun i tooltip!
  $result = '
  <span class="tooltip" style="display:inline; padding:0; ">
    <button type= "submit" '.$targ.' name="btn_ico_'.$btnix.'" style="color:'.$fg.'; background:white;" accesskey="'.$akey.'" >'.
      '<span class="tooltiptext">'.$title.$tasttip.'</span>'.
      ' <data-ic class="'.$faicon.'" style="font-size:'.$size.'; color:'.$fg.';  '.$ØButtnBgrd.'; "> </data-ic> '
      .tolk($labl). $genv.
    '</button>'.
  '</span>'; 
  if ($size=='32px') echo $result;
  return $result;
}


# BASISMODUL for link-knap med icon:
function iconKnap ($faicon='',$title='',$link='',$akey='',$size='32px',$labl='') 
{ global $ØButtnBgrd, $ØTastkeys;
  if ($ØTastkeys) {
    if ($akey) $genv=' ´<i>'.$akey.'</i>´'; else $genv='';
    if (!$genv) $ktip=''; else $ktip= '<br>'.tolk('@Tastatur genvej: ').$akey;
  }   dvl_pretty('iconKnap');
  $genv=''; // Vis ikke genvej i knaptekst, kun i tooltip!
  $LablTip= '<p class="tooltip" style="margin: 1px 5px;"><span class="tooltiptext">'.$title.$ktip.'</span></p>';
  $result = '
  <span style="box-shadow: 2px 2px lightgray;">
    <a href="'.$link.'" accesskey="'.$akey.'" '.$LablTip.' ';
      $result.= 
      '<ic class="'.$faicon.'" style="font-size:'.$size.'; color:'.$ØButtnBgrd.'; "> </ic>
      <span style="font-size:small; padding:4px;">'.$labl. $genv.'</span>
    </a>
  </span>'; 
  if ($size=='32px') echo $result;
  return $result;
}
    
# BASISMODUL for link-knap med tekst (på lys baggrund):
function textKnap ($label='',$title='',$link='',$akey='',$more='', $ToolClass='tooltiptext') 
{ global $ØButtnBgrd, $ØButtnText, $ØTastkeys;
  if ($ØTastkeys) {
    if ($akey) $genv=' ´<i>'.$akey.'</i>´'; else $genv='';
    if (!$genv) $key=''; else $key= '<br>'.tolk('@Tastatur genvej: ').$akey;
  }
  $genv=''; // Vis ikke genvej i knaptekst, kun i tooltip!
  if (strpos($link, 'page_Blindgyden.php')>0) 
       {$txtclr= '#AAAAAA';   $note=' <br> ('.tolk('@En blindgyde endnu!').')';} 
  else {$txtclr= $ØButtnText; $note='';};
  if (($label=='@Retur til hovedmenu')) $txtclr= 'white';
  dvl_pretty('textKnap');
  $result= '<div class="tooltip" style= "margin:1px 5px; padding:2px 6px; border:2px; box-shadow: 2px 2px 4px #888888; '.$more.'"> '.   //  knap
           '<a href="'.$link.'" accesskey="'.$akey.'"> '.                                                                               //  link
           '<span class="'.$ToolClass.'">'.tolk($title).$key.$note.'</span> '.                                                          //  tip
           '<span style= "white-space:nowrap; color:'.$txtclr.'; display:inline;">'. ucfirst(tolk($label)).$genv.'</span></a></div>';   //  label
  if ($link!='') echo $result;
  return $result;
}
   
# BASISMODUL for doFunction-knap med tekst på farvet baggrund:
function execKnap ($label='',$title='', $function='doFunction()') 
{ global $ØButtnBgrd, $ØBtSavBgrd, $ØButtnText, $ØTastkeys;
  $KnapClr= 'brown';
  echo '<span class="knap" style="background:'.$KnapClr.'; color:'.$ØButtnText.
       '; padding:2px 6px; border-radius:6px; border:1px solid gray;" data-tiptxt="'.
       tolk($title).'"; onclick="'.$function.';">'.tolk($label).'</span>';
}

# BASISMODUL for set variabel-knap med tekst på farvet baggrund:
function setvKnap ($label='',$title='', $source, &$result, $akey='') 
{ global $ØButtnBgrd, $ØBtSavBgrd, $ØButtnText, $ØTastkeys;
  if ($ØTastkeys==true) {
    if ($akey) $genv=' ´'.$akey.'´'; else $genv='';
    if (!$genv) $ktip=''; else $ktip= '&#xa;'.tolk('@Tastatur genvej: ').$akey;
  }
  $genv=''; // Vis ikke genvej i knaptekst, kun i tooltip!
  $LablTip= '<div0 class="tooltip" style="color:'.$ØButtnText.
            '; padding:2px 6px; border:1px solid gray; box-shadow:'.
            ' 2px 2px 4px #888888; background:'.$ØBtSavBgrd.'; ">'.
            '<span class="tooltiptext">'.tolk($title).$ktip.'</span></div0>';
  dvl_pretty('setvKnap');
  echo '<form method="post">  <input type="hidden" name="var_name" value="'.
       $source.'">  <input type="submit" title="'.tolk($title).$ktip.
       '" value="'.ucfirst(tolk($label)).$genv.'" '.' ></form>';
  if(isset($_POST['var_name']))  { $result = $_POST['var_name']; }
}
    
# BASISMODUL for link-knap med tekst på farvet baggrund:
function naviKnap ($label='',$title='',$link='',$akey='',$more='') 
{ global $ØProgRoot, $ØButtnBgrd, $ØButtnText, $ØTastkeys;
  if ($ØTastkeys==true) {
    if ($akey) $genv=' ´<i>'.$akey.'</i>´'; else $genv='';
    if (!$genv) $ktip=''; else $ktip= '<br>'.tolk('@Tastatur genvej: ').$akey;
  }
  $genv=''; // Vis ikke genvej i knaptekst, kun i tooltip!
  if ($link==$ØProgRoot.'_base/page_Blindgyden.php') 
    {$clr= '#AAAAAA'; $note=' <br> ('.tolk('@En blindgyde endnu!').')';} 
  else {$clr= 'white'; $note='';};
  $LablTip= '<div0 class="tooltip" style="color:'.$clr.
            '; padding:2px 6px; border:1px solid gray; '.
            'box-shadow: 2px 2px 4px #888888; background:'.$ØButtnBgrd.'; '.$more.'">'.
            '<span class="tooltiptext">'.tolk($title).$ktip.$note.'</span></div0>';
  dvl_pretty('naviKnap');
  echo '<span class="knap" style="color:'.$color=$ØButtnText.'; "><a href="'.$link.
       '" accesskey="'.$akey.'" '.$LablTip.' '.ucfirst(tolk($label)).$genv.'</a></span>';  
}




function menuTitl ($h='32',$w='120',$label='') 
{ global $ØProgRoot;
  dvl_pretty();
  echo '<titlBg><img src= "'.$ØProgRoot.'_assets/images/menuShapeTitl.png" alt="" height="'.$h.'" width="'.$w.'" /><a href="'.$link.
  '" class="btnTit" notitle= "'.tolk('@Kolonne Overskrift').'">'.ucfirst(str_replace(' ','&nbsp;',tolk($label))).'</a></titlBg>'; }
  
function menuKnap ($h='32',$w='120',$label='',$link='',$title='') 
{ global $ØProgRoot;
  if (strpos($link,'_base/page_Blindgyden.php')) 
    { $flag0= ' style="color:gray" '; $mess= str_lf().' (En blindgyde endnu!)';}
  else {$mess=''; $flag0=''; $flag1=''; }
#  if (strpos($link,'page_Syssetup1.php')) $flag1= ' style="color:red" '; else $flag1= ' style="color:#900000" ';
  dvl_pretty();
  echo '<menuBg><img src= "'.$ØProgRoot.'_assets/images/menuShapeButt.png" alt="" height="'.$h.
       '" width="'.$w.' display:block; margin:auto;" /><a href="'.$link.
       '" class="btn" title="" data-tiptxt="'.tolk($title).$mess.'" '.$flag0.$flag1.
       '><span style= "white-space: nowrap;">'.ucfirst(str_replace(' ','&nbsp;',tolk($label))).'</span></a></menuBg>'; }

       
       
function userTip () 
{ global $Ønovice;
   dvl_pretty();
   if (!$Ønovice) $Ønovice='true';
#?? Fejler:  echo '<script> document.getElementByName("tip").checked= '.$Ønovice.'; </script>';
   $Ønovice= htm_CheckFlt($type='checkbox',$name='tip', $valu= $Ønovice, $labl='@noTIP?:', 
      $titl='@Vis tip for begyndere, hvis du er ny i systemet. (Virker ikke endnu)', 
      $revi=true, $more=' '.$Ønovice,' ');
 //  $Ønovice= true;
}

function run_Script ($cmdStr) {
  echo "\n".'<script> '.$cmdStr.' </script>'."\n";
}





if (!function_exists('MakeOptList')) {  //  Benyttes ?
function MakeOptList($valu,$optliste=[]) { if ($valu='') $valu= tolk('@?...');
  dvl_pretty();
  echo '<td> <div style="margin-right:0; "> <select class="styled-select" name="liste"> <option value="'.$valu.'" title="'.tolk('@Vælg').'" >';
    foreach ($optliste as $rec) { //  0:Tip 1:Value 2:Label 3:Ekstra
      dvl_pretty();
      echo "\n".'<option label="'.$rec[2].'" value="'.$rec[1].'" title="'.$rec[0].'"'.$rec[3];
        if ($rec[1]==$valu) echo ' selected ';
      echo '>'.$lbl=$rec[2].'</option> ';
    }
  echo '</select></div></td> '; dvl_pretty();
}}

if (!function_exists('htm_SelectStr')) {  # Optimering: Disse lister bør kunne oprettes 1 gang, kun ved opstart, eller efter ændring af listindhold!
function htm_SelectStr($name,$valu,$optliste=[],$more='',$indiv=true) {
    dvl_pretty();
    if ($indiv) $Result= '<div style="margin-right:0;"> ';  else  $Result= ''; 
    $Result.= '<select class="styled-select" id="'.$name.'" name="'.$name.
              '" style="max-width:140px; background-color:transparent; '.$more.
              '"> '."\n".'<option label="" value="" > - </option>';  //  selected disabled hidden
    foreach ($optliste as $rec) { dvl_pretty();
      $titl= tolk($rec[0]);
    #+  if (strpos('KtInterval',' '.$more)>0) {if (strlen(' '.$titl)>15) {$titl= ':'.substr($titl,0,15).'...';}} 
    #+  else {$titl= '';}
      $Result.= "\n".'<option label="'.$rec[2].'" value="'.$rec[1].'" title="'.$titl.'"'; //  .$rec[3]
        if ($rec[1]==$valu) $Result.= ' SELECTED ';
      $Result.= '>'.$lbl=tolk($rec[2]).'</option> ';
      }
    $Result.= '</select>'; 
    if ($indiv) {$Result.='</div> ';}
    return($Result);
} }

function PauseKlovn($mess='Indlæser. Hæng på!') {
  echo '<div style="text-align:center;"><i class="far fa-cog fa-spin fa-3x fa-fw" aria-hidden="true"></i><span class="sr-only">'.$mess.'</span></div>';
  echo '';
}



/*
Begreber anvendt i htm_Table:
 -------------------------------------------------------------------------------------------------------
|                                                                                                       |
|                                           TABLE-Caption                                               |
|                                                                                                       |
 -------------------------------------------------------------------------------------------------------
|         |                                   TABLE-HEAD                                      |         |
|         |-----------------------------------------------------------------------------------|         |
|         |                                                                                   |         |
|    R    |                                                                                   |    R    |
|    O    |                                                                                   |    O    |
|    W    |                                                                                   |    W    |
|    P    |                                                                                   |    S    |
|    R    |                                   ROWBody =                                       |    U    |
|    E    |                                   TABLE-BODY                                      |    F    |
|    F    |                                                                                   |    F    |
|    I    |                                                                                   |    I    |
|    X    |                                                                                   |    X    |
|         |                                                                                   |         |
|         |-----------------------------------------------------------------------------------|         |
|         |                                                                                   |         |
|         |                                    TABLE-FOOT                                     |         |
 -------------------------------------------------------------------------------------------------------
*/

### Universal DATA/Tabel-viser, med Fixed Header, RulleVindue, KolonneFilter, KolonneSortering, RækkeBaggrundsfarver, RecordOprettelse, m.v:  
function htm_Table(
    $TblCapt= array( #['0:Label',   '1:Width',    '2:Type',    '3:OutFormat', '4:horJust',      '5:Tip',    '6:placeholder', '7:Content';],... // Gl: 0:Label 1:width 2:align 3:Type 4:title 5:Content
        ),
    $RowPref= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip'                                        ], ['Næste record'],... # Generel struktur!
        ),  // if (($ModifyRec) or ($RowBody[0][2]!='indx')) er 2% benyttet til => knap
    $RowBody= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:placeholder','7:default','8:select'], ['Næste record'],... # Generel struktur! 
        ),
    $RowSuff= array( #['0:ColLabl', '1:ColWidth', '2:InpType', '3:OutFormat', '4:[horJust_mv]', '5:ColTip', '6:value!     '                       ], ['Næste record'],... # Generel struktur! 
        ),            # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON, ]
    &$DATA,#=   array(),
    $FilterOn= true,       # Mulighed for at skjule records som ikke matcher filter   //  Virker ikke med hidd-felter!
    $SorterOn= true,       # Mulighed for at sortere records efter kolonne indhold
    $CreateRec=true,       # Mulighed for at oprette en record
    $ModifyRec=true,       # Mulighed for at vælge og ændre data i en row
    $ViewHeight= '400px',  # Højden af den synlige del af tabellens data
    $CalledFrom, //= __FUNCTION__
    $Kriterie= ['','']    # Test [DataKolonneNr, > grænseværdi] Undlad spec. feltColor
  )                       # Felt 4: ($fieldModes), er sammensat af: [horJust, FeltBgColor, FeltStyle, SorterON, FilterON, SelectON, ]
                          # 0:horJust - Argument(er) til .td: style="text-align:
                          # 1:FeltBgColor - Argument(er) til .td: background-color: 
                          # 2:FeltStyle - komplet udtryk, F.eks.: 'font-style:italic; '
                          # 3:TdColor - som 1: men benyttes til "række-markering"
                          # Kun påvirkning af Body-områder.
#!  FIXIT: Fixed/Sticky header virker kun på 1. tabel, når der er flere tabeller i samme vindue!
#!         Der forekommer også svigt af zebra-striber (Opdateringsproblem!), samt problemer med filter, når der er hidden kolonner.

{ global $Ødebug, $ØblueColor, $ØLineBrun, $ØRollTabl, $ØHeaderFont, $ØIconStyle, $tblix;
  $creaInpBg= '#ffffcc';
  $valgbar= (($ModifyRec) and ($RowBody[0][2]=='indx'));
  if (!$DATA) {msg_Info('Ingen data','Data tabellen er tom! ('.$TblCapt[0][0].')'); exit;};
  if ($Ødebug) dvl_pretty('Start-htm_Table: '.$CalledFrom);
  if (!$valgbar) $RowSelect= '';
  else         { $RowSelect= '<span class="tooltip"><span style="font-size:115%;">&#x21E8;</span>'.
                             '<span class="tooltiptext" style="bottom: -12px; left: 65px">'.tolk('@Valgbar: ').str_nl(1).
                              tolk('@Denne række kan vælges, ved at klikke på Id/Nummer i rækkens første felt.').'</span></span>';
               }
  if ($FilterOn)  {$filt= ' filter-true '; }   else $filt= ' filter-false ';  //  filter-select
  if ($SorterOn)  {$sort= ' sorter-inputs '; } else $sort= ' sorter-false ';
  //  run_Script('function objwidth(id) { var width = document.getElementById(id).offsetWidth; }');
  if (!function_exists('RowKlick')) {
    run_Script( 'function rowLookup(index) { window.alert("Du trykkede på " + index + "\nDet sker der ikke noget ved endnu..."); }');
    // Hent data i "kassekladder" svarende til index, og vis dem i redigerings-tabel "kassekladde"
    // Kaldt fra $CalledFrom='Panl_Kassekladder' rediger i: Panl_KasseRedigering
    function RowKlick($ModifyRec,$rowix) { if (!$ModifyRec) {return $rowix;} else return 
    '<span style="display: inline; text-decoration: underline; cursor:zoom-in; padding:5px;"'.
    ' onclick="rowLookup(\''.$rowix.'\')" >'.$rowix.'</span>'; };
  }
   
### Overskrifts linie:
  if ($TblCapt[0][0]>'') {    dvl_pretty();     htm_nl(1);
    if ($TblCapt) foreach ($TblCapt as $Capt) { // $Capt[x]: 0:Label 1:width 2:type 3:(outFormat) 4:align 5:titletip 6:default 7:value
      echo ' '.tolk($Capt[0]).' ';  //  Label:
      if ($Capt[2]=='show') $forskel= '" disabled value="'; else $forskel= '" placeholder="';
      if ($Capt[2]=='html') echo tolk($Capt[6]);                                    //  Raw Html-kode
      else echo '<input type= "'.$Capt[2].'" name="note" title="'.tolk($Capt[5]).   //  Input-felt    
                  $forskel.tolk($Capt[6]).'" style="width:'.$Capt[1].'; text-align:'.$Capt[4].';" value="'.tolk($Capt[7]).'" />&nbsp;&nbsp;';
    } // foreach-TblCapt
    if ((count($TblCapt)>1) or ($Capt[1]>"40%")) htm_nl(); //  false:Ved smalt panel
    htm_sp(5);
    if ($SorterOn)  {echo $sor= iconButt($faicon='fas fa-sort',       
      $title= tolk('@Klik på kolonne overskrifter, for at sortere data. Hold SHIFT og klik, for at sortere på flere kolonner.'),
      $link='#',$akey='','12px',$labl='@Sortér?'); }
    if ($FilterOn)  {echo $fil= iconButt($faicon='fas fa-search-plus',
      $title= tolk('@Hold musen lige under tabellens overskrifts linie, så vises nogle indtastningsfelter. ').
              tolk('@Angiv her et søge udtryk, for kun at vise data, der svarer til udtrykket.'),
      $link='#',$akey='','12px',$labl='@Filtrér?'); }
    if ($FilterOn)  {echo $fil= iconButt($faicon='fas fa-search-minus',    //<button type="button" class="reset">tolk('@Vis alt')</button>
      $title= tolk('@Nulstil filter, så alle data vises. Med ESC kan du nulstille søge-udtrykket, i det felt du står i.'),
      $link='#',$akey='','12px',$labl='@Vis alt!'); }
    if ($ModifyRec) {echo $ret= iconButt($faicon='fas fa-pen-square', 
      $title= tolk('@I nogle af denne tabels kolonner, kan du rette data. De er markeret med · i kolonne overskriften.').str_nl().
              tolk('@Kan tabellen ikke gemmes, skal rettelsen foregå på et detail-kort.'),
      $link='#',$akey='','12px',$labl='@Rette?'); }
    if ($CreateRec) {echo $til= iconButt($faicon='fas fa-plus',       
      $title= tolk('@Vil du tilføje data: <br>Nederst i tabellen, findes felter du kan udfylde med nye data. ').
              tolk('@Klik på knappen "Opret" over sidste felt, for at gemme de nye data.'),
      $link='#',$akey='','12px',$labl='@Tilføj?'); }
    if (true)  {echo $fil= iconButt($faicon='fas fa-arrows-alt-h',     
      $title= tolk('@Flyt markør i tabeller:').'<br><data-yelllabl>'.tolk('@Tab-tast').'</data-yelllabl> '.
        tolk('@springer til næste felt.').' <data-yelllabl>'.tolk('@SHIFT Tab-tast').'</data-yelllabl> '.tolk('@springer til forrige felt.').
        ' <data-yelllabl>'.tolk('@SPACE-tast').'</data-yelllabl> '.tolk('@ruller side ned').
        ' <data-yelllabl>'.tolk('@SHIFT SPACE-tast').'</data-yelllabl> '.tolk('@ruller side op').'<br>'.
        tolk('@Markøren skal stå i tabellen.')
        /* .'  <br><data-yelllabl>'.tolk('@CTRL Pil-taster').'</data-yelllabl> '.tolk('@virker ikke. ' */
        ,$link='#',$akey='','12px',$labl='@Taster '); }
    htm_nl(1);
  } dvl_pretty();
  
### Tabel-start:  
  $tblix++; //  0..7 på en page
  echo '<span class="wrapper" style="padding:0; border:0px solid brown; height:'.$ViewHeight.'; display: block;">'; //  "Table-window": Container for tabel  display: inline ?
  echo '  <div id="overlay"></div>';
  echo '    <table class="tablesorter" id="table'.$tblix.'" style="margin:0;">'; //  id= smarttabel eller 'table'.$tblix  0..7
//echo '    <table class="tablesorter" id="smarttabel" style="margin:0;">'; //  id= smarttabel eller 'table'.$tblix  0..7
  echo '    <thead>';
  $filter_cellFilter= [];  //  [ '', 'hidden', '', 'hidden' ]
### Kolonne-LABELS med sorterinsmulighed:
  echo '    <tr style="height:32px;">'; 
  foreach ($RowPref as $Pref) { dvl_pretty(); 
      echo '<th class=" filter-false sorter-false" style="width:'.$Pref[1].' align:'.$Pref[4][0].'; '.$ØHeaderFont.'"> '.
            Lbl_Tip($Pref[0],$Pref[5],'SO',$h='0px').' </th>';
  }  $kNo= -1;
  if ($valgbar) echo  '<th class="filter-false sorter-false" > </th>';
  // class="wide" Kolonner, som er smallere end indholdet, kan vises ved at klikke på feltet: http://jsfiddle.net/Mottie/mstoa6cm/
  foreach ($RowBody as $Body) { dvl_pretty(); 
   // if ($Body[4][4]==false) $colfilt= ' filter-false'; else $colfilt= ' ';
    if ($Body[8]==true) $selt= ' filter-select'; else $selt= ' ';  //  FIXIT: sortering af datofelter virker ikke!
    if ($Body[2]=='hidd') // FIXIT: visning af filter-felter, får kolonner ud af takt! - $filter_cellFilter virker tilsyneladende ikke: https://mottie.github.io/tablesorter/docs/#widget-filter-cellfilter
      { array_push($filter_cellFilter, 'hidden');
        $hiddcount++;
        echo '<th class="filter-false sorter-false" style="width:0; display:none;" ></th>'; 
      } //  visibility:hidden;    //  columnSelector_columns : { 5 : false, 6 : false}
    else 
      { $kNo++; array_push($filter_cellFilter, '');   
        if (($Body[2]=='text') or ($Body[2]=='data') or ($Body[2]=='date')) 
          $editmark= '·'; else $editmark= '';
        if ($kNo<1) $tipplc='SO'; else if ($kNo=1) $tipplc='S'; else $tipplc='SW'; // Placering af tip 1. og 2. kolonne
        if ($kNo==count($RowBody)) $tipplc='SW';  //  Sidste kolonne
        echo '<th class="'.$filt.$selt.$sort.$colfilt.'" data-placeholder= "Vis..." style="width:'.$Body[1].'; '.
             $ØHeaderFont.' text-align:center;">'.Lbl_Tip($Body[0].$editmark,$Body[5],$tipplc,$h='0px').' </th>';  //  filter-select
  } }
  foreach ($RowSuff as $Suff) { dvl_pretty(); 
      echo '<th class="filter-false sorter-false" style="width:'.$Suff[1].'; align:'.$Suff[4][0].'; '.$ØHeaderFont.'">'.
            Lbl_Tip($Suff[0],$Suff[5],'SW',$h='0px').'</th>';
  }
  echo '    </tr>';    dvl_pretty();
### Kolonne-FILTER:   (dannes af tablesorter, men der er et problem med hidd-felter!)
  echo '    </thead>';

### Erklæring af tableFooter med mulighed for oprettelse af ny record:
  echo '    <tfoot>';
  if ($CreateRec) {
    echo '  <tr>';
      if ($valgbar) echo  '<td> </td>';
      if (count($RowPref)>2) {$colsp= 'colspan="2"'; $n= 2; } else {$colsp= ''; $n= 1; }
      echo '  <td '.$colsp.'>'.tolk('@Opret ny:').'</td>';
      for ($x= $n+1; $x < count($RowPref)+count($RowBody)-$hiddcount; $x++) {echo '<td> </td>';}
        echo '<td style="text-align:center;">'.
              //textKnap($label='@Opret', 
              htm_AcceptKnap($labl='@Opret', 
                $title=tolk('@Udfyld felterne herunder med data, før du klikker på Opret-knappen!'), $type='save', $form='', $width='', $akey='', $func='rtrn').
              //  $title= tolk('@Udfyld felterne herunder med data, før du klikker på Opret-knappen!'), 
              //  $link='','','','tooltipNW').
              '</td>';
      for ($x= 1; $x <= count($RowSuff); $x++) {echo '<td style="width:'.$RowPref[1].';"> </td>';}
    echo ' </tr>';
    echo '  <tr>';
    if ($valgbar) echo '<td style="width:0.5%;"> </td>';
    if ($RowPref) echo '<td style="text-align:right;">Data:</td>';  
    $ColIx= -1; $RowIx=-1;  $bgclr= 'background-color:'.$creaInpBg.'; ';
    foreach ($RowBody as $Body) { $ColIx++;
      $s1= ' style="width:'.$Body[1].';" title="'.tolk($Body[5]).'">';
      $s2= $name='New_Row'.$RowIx.'Col'.$ColIx.'[]' ;
      switch ($Body[2]) {  # Specielle InpTyper:
      case "moms" : echo '<td'.$s1.htm_SelectStr($s2,$valu,MomsListe(),$bgclr.'width:45px; ').'</td>';  break;
      case "kont" : echo '<td'.$s1.htm_SelectStr($s2,$valu,KontListe(),$bgclr.'width:35px; ').'</td>';  break;
      case "valu" : echo '<td'.$s1.htm_SelectStr($s2,$valu,ValuListe(),$bgclr.'width:55px; ').'</td>';  break;
      case "stat" : echo '<td'.$s1.htm_SelectStr($s2,$valu,StatListe(),$bgclr.'width:65px; ').'</td>';  break;  //  Konto status
      case "osta" : echo '<td'.$s1.htm_SelectStr($s2,$valu,OrdrStatu(),$bgclr.'width:65px; ').'</td>';  break;  //  Ordre status
      case "just" : echo '<td'.$s1.htm_SelectStr($s2,$valu,JustListe(),$bgclr.'width:35px; ').'</td>';  break;
      case "side" : echo '<td'.$s1.htm_SelectStr($s2,$valu,Side_List(),$bgclr.'width:35px; ').'</td>';  break;
      case "font" : echo '<td'.$s1.htm_SelectStr($s2,$valu,FontListe(),$bgclr.'width:75px; ').'</td>';  break;
      case "show" : echo '<td style="width:'.$Body[1].'; text-align:center">'.tolk($Body[6]).'</td>';   break;  //  Kun visning af data:
      case "hidd" : echo '<td style="width:0; padding:0; display:none; '.$bord.'">  <input type= "hidden" name="Kol'.$ColIx.'[]" '.
              'value="'.htmlentities(stripslashes(tolk($valu))).'" style=" width:0; display:none;"/></td> '; break; //  Ingen visning af data:
      //  text, indx, data, :
      default:      echo '<td style="width:'.$Body[1].';"> <input type="text" name="New_Row'.$RowIx.'Col'.$ColIx.'[]'.
              '" style="width:94%; background:'.$creaInpBg.';" placeholder=" ?..." value="" title="'.
              tolk('@Data-felt i ny record').': '.tolk($Body[5]).'" /> </td>';
      }
    }
    $ColIx= -1; foreach ($RowSuff as $Suff) {$ColIx++; if ($ColIx>=0) echo '<td></td>';}
    echo ' </tr>';
  }
  echo '  </tfoot>';

//  $("#table").tablesorter({    widgetOptions : {
    echo '<style> $("#table").tablesorter({ widgetOptions { filter_cellFilter: ["'.implode('","',$filter_cellFilter). '"]}} </style>';  // Skjule filter input-felter for hidden kolonner

### DATA og html-objekter:
  echo '     <tbody>';
  if (!function_exists('RowBg')) {
    function RowBg($clr,$alg,$pos='') { if ($pos>'') $bord= ' border-'.$pos.':3px solid gray; '; else $bord= '';
      return ' background:'.$clr.'; vertical-align:'.$alg.'; height:1.5em; '.$bord.' '; };
  }
  $RowIx=-1;
  foreach ($DATA as $Drow) { $RowIx++; dvl_pretty();
    echo '<tr class="row">';  //  Med Zebra-stribet baggrund
    foreach ($RowPref as $Pref) {
        echo '<td style="width:'.$Pref[1].'; text-align:'.$Pref[4][0].'; ">'.tolk($Pref[6]).' </td>';
    }
    if ($valgbar) echo '<td style="text-align:right; width:2%;">'.$RowSelect.'</td>';
    
### Tabel-BODY-Rows:
    $optlist= FormVars(4); $ordlist= OrdrVars(4); #- $n= count($DATA); if ($n<1) $n= 20;
    $ColIx= -1;
    $rowBg= '';
    $inpBg= ' background-color:transparent;'; //' background-color: white; opacity:0.60; ';
    //$inpBg= ' background-color:rbg(200,200,200,0.3);'; //' background-color: white; opacity:0.60; ';
    foreach ($RowBody as $Body) 
      if ($ColDrop> 0) {/* Kolonne efter colspan springes over */ $ColDrop= $ColDrop-1; $ColIx++;}
      else
      { $ColIx++;    dvl_pretty();
        if (is_array($Drow[$ColIx])) 
              $valu= $Drow[$ColIx][0];
        else  $valu= $Drow[$ColIx];   
        
      ## Specielle Output formater:
        switch ($Body[3]) {  
          case "0d": if ($valu==null) $valu= 0;     else $valu= number_format((float)$valu, 0,',','.'); break;
          case "1d": if ($valu==null) $valu='';     else $valu= number_format((float)$valu, 1,',','.'); break;
          case "2d": if ($valu==' ')  $valu= $valu; else
                       if ($valu==null) $valu='';   else $valu= number_format((float)$valu, 2,',','.'); break;  //  88.888.888,88
          case "2%": if ($valu==' ')  $valu= $valu; else
                       if ($valu==null) $valu='';   else $valu= number_format((float)$valu, 2).'%';     break;
          case ">0": if (!(float)$valu>0) $valu= ' ';       break; //  0 og mindre værdier vises som BLANK
          case "= ": $valu= ' ';                            break; // værdier vises som BLANK
          default: $valu= $valu;
        } 
        
        $flag= substr($valu,1,2);
        if (($flag=='::') or ($flag==':.')) $valu= substr($valu,2).' '; //  feltFlag vises ikke. SPACE så placeholder ikke vises.
      ## Specielle kolonne-formater:
        if (is_string($Body[4][0]))  $txAlign= ' style="text-align:'.$Body[4][0].'; '; else $txAlign= '';
        if (is_string($Body[4][1]))  $bgColor= ' background-color:'. $Body[4][1].'; '; else $bgColor= '';
        if (is_string($Body[4][2]))  $fltStyl= ' '.                  $Body[4][2].' ';  else $fltStyl= '';      //  F.eks.: 'font-style:italic; '
        if (is_string($Body[4][3]))  $tdColor= ' background-color:'. $Body[4][3].'; '; else $tdColor= '';
        
      ## Specielle betingede "række"-formater:
        if ($Kriterie==['','']) $kontotype= '';
        if ($Kriterie[0]=='REGNSKAB')  {
          $tdColor='';
          $kontotype= strtoupper($Drow[2]); 
          switch ($kontotype) {  //  Kontotype: D=Drift, S=Status, Z=Sum, H=Overskrift, R=Resultat, X=Sideskift, L=Lukket',
          case 'H': { if (($ColIx>1)) $valu=' '; 
                      $rowBg= RowBg('lightyellow','bottom','top').' font-weight:600; ';
                      $bgColor= '';
                      if ($Body[2]!='hidd') $Body[2]= 'html';
                    }; break;
          case 'Z': { $rowBg= RowBg('lightcyan','top'). ' border-top:2px solid gray;';
                      $bgColor= '';
                    }; break;
          case 'X': { $rowBg= RowBg('darkgray','center');
                      $bgColor= '';
                      $Drow[1]='Sideskift'; for ($Ix=5; $Ix<=18; $Ix++) $Drow[$Ix]=' ';
                    }; break;
          }
        }
        if ($Kriterie[0]== 'KONTOPLAN') {
          $kontotype= strtoupper($Drow[3]);
          switch ($kontotype) {  //  Kontotype: D=Drift, S=Status, Z=Sum, H=Overskrift, R=Resultat, X=Sideskift, L=Lukket',
          case 'H': { $rowBg= RowBg('lightyellow','bottom','top').' font-weight:600; ';
                      $bgColor= '';                                                          
                      $Drow[3]= ''; $Drow[6]=' '; $Drow[7]=' '; $Drow[8]=' '; $Drow[9]=' '; 
                      if ($Body[2]!='hidd') $Body[2]= 'html';                                
                    }; break;                                                                
          case 'D':   $Drow[3] = tolk('@Drift');   $rowBg= ''; break;                        
          case 'S':   $Drow[3] = tolk('@Status');  $rowBg= ''; break;                        
          case 'Z': { $rowBg= RowBg('lightcyan','top');
                      $bgColor= '';   $Drow[8]=' '; $Drow[9]=' '; 
                      if ($Drow[7]=='') { $Drow[7]='0'; $rowBg.= ' border-top:2px solid gray;'; }
                      $Drow[3] = tolk('@Sum fra:'); //  $row[fra_kto] - $row[til_kto]
                    }; break;
          case 'R': { $rowBg= RowBg('lightgreen','center');
                      $bgColor= '';
                      $Drow[2] = tolk('@Årets resultat'); 
                      $Drow[3] = tolk('@Sum fra:'); 
                      $Drow[8]=' '; $Drow[9]=' '; 
                    }; break;
          case 'X':   // $Drow[1]='';  //  tolk('@Sideskift');  
                      $Drow[2]=' '; $Drow[3]='Sideskift'; $Drow[6]=' '; $Drow[7]=' '; $Drow[8]=' '; $Drow[9]=' '; 
                      $rowBg= ' background:darkgray; '; 
                      break;
            }
        }
        if ($Kriterie[0]== 'BUDGET') { $colsp= '';
          $kontotype= strtoupper($Drow[2]); 
          switch ($kontotype) {  //  Kontotype: D=Drift, S=Status, Z=Sum, H=Overskrift, R=Resultat, X=Sideskift, L=Lukket',
            case 'H': $rowBg= RowBg('lightyellow','bottom','top').' font-weight:600; ';
                      $Drow[2] = '';  
                      break;
            case 'D': $rowBg= '';    $Drow[2] = tolk('@Drift');   
                      break;
            case 'S': $rowBg= '';    $Drow[2] = tolk('@Status');
                      break;
            case 'Z': $rowBg= RowBg('lightcyan','top'). ' border-top:2px solid gray;';
                      $Drow[2] = '';    $Drow[4].= ' - '.$Drow[0]; 
                      $Drow[1].= '<br><small>'.tolk('@Sum').' Kt: '.$Drow[4].' '.tolk('@(uden sum-kt.)').'</small>'; 
                      break;
            case 'R': $rowBg= RowBg('lightgreen','').' font-weight:600; ';
                      $Drow[2]= tolk('@Resultat = '); 
                      $Drow[4].= ' - '.$Drow[0]; 
                      $Drow[1].= '<br><small>'.tolk('@Sum').' Kt: '.$Drow[4].' '.tolk('@(uden sum-kt.)'.'</small>'); 
                      break;
            case 'X': $rowBg= ' background:darkgray; '; 
                      $Drow[1]=tolk('@Sideskift').' <br>'.tolk('@(Ovenfor: Driftkonti - Herunder: Statuskonti)');  
                      $Drow[2]=''; 
                      break;
            default : {}; // echo ' Konto uden gyldig type! '.$Drow[2].' ';};
          }
        }
        if ($Kriterie[0]== 'RAPPORT') {
          $feltFlag= substr($Drow[0],0,2);    $colsp= '';
          if (($feltFlag=='::') or ($feltFlag==':.'))  // 1. eller efterfølgende Headerline
            { $rowBg= ' background:lightyellow; padding: 0px 4px 0px 4px; '; 
              if ($feltFlag=='::') $rowBg.= 'border-top:2px; solid gray; '; // 1. Headerline med top-border
              if ($ColIx==0) $valu= substr($Drow[0],2);     //  Fjern flaget fra felt-indhold
              if ($Body[3]=='col2') { $colsp= '" colspan="2"; '; $txAlign=' style="text-align:left; '; $Body[1]='1%'; $ColDrop= 1;}
              if ($Body[3]=='col3') { $colsp= '" colspan="3"; '; $txAlign=' style="text-align:left; '; $Body[1]='1%'; $ColDrop= 2;}
            }
          if ($feltFlag==':=')   // Sum / ialt linie
            { $rowBg= ' background:lightcyan; padding: 0px 4px 0px 4px; border-top:2px solid gray;'; 
              if ($ColIx==0) $valu= substr($Drow[0],2);     //  Fjern flaget fra felt-indhold
              if ($Body[3]=='col2') { $colsp= '" colspan="2"; '; $txAlign=' style="text-align:left; '; $Body[1]='1%'; $ColDrop= 1;}
            }
          if ($Body[2]=='date') 
            { $Body[2]= 'text'; }   // Type ændres pga. visning af default/placeholder
        }
        
        if ($ColIx<count($Drow)) {  //  Hvis colspan forekommer stoppes her, når rækken er slut
          echo '<td style="text-align:'.$Body[4][0].'; width:'.$Body[1].'; '.$bgColor.$tdColor.$rowBg.$colsp; //  tabelfelt-egenskaber
        ## Specielle InputTyper i tabelfelt:
          switch ($Body[2]) {  
            case "vars" : echo '">'.' <div style="margin-right:0; font-size:x-small">'.
                               '<select class="styled-select" name="liste" style="max-width:120px"> <option value=" " >-';
                            foreach ($optlist as $rec) { 
                              echo "\n".'<option label="'.$rec[2].'" value="'.$rec[1].'" '.$rec[3];   
                              if ($rec[1]==$valu) echo ' selected ';   
                              echo '>'.$lbl=$rec[2].'</option> '; 
                            }
                          echo '</select></div> ';   break;
            case "chck" : echo '">'.'<input type= "checkbox" name="chck" value="" '.$valu.' ';  break;
            case "bold" : echo '">'.'<input type= "checkbox" name="bold" value="" '.isbold($valu).' ';  break;
            case "ital" : echo '">'.'<input type= "checkbox" name="ital" value="" '.isital($valu).' ';  break;
                          //  DropDown-selector:
            case "moms" : echo '">'.htm_SelectStr($name='Row'.$RowIx.'Col'.$ColIx.'[]' ,$valu,MomsListe(),'width:45px; ');  break; 
            case "just" : echo '">'.htm_SelectStr($name='Row'.$RowIx.'Col'.$ColIx.'[]' ,$valu,JustListe(),'width:35px; ');  break;
            case "side" : echo '">'.htm_SelectStr($name='Row'.$RowIx.'Col'.$ColIx.'[]' ,$valu,Side_List(),'width:35px; ');  break;
            case "font" : echo '">'.htm_SelectStr($name='Row'.$RowIx.'Col'.$ColIx.'[]' ,$valu,FontListe(),'width:75px; ');  break;
            case "kont" : echo '">'.htm_SelectStr($name='Row'.$RowIx.'Col'.$ColIx.'[]' ,$valu,KontListe(),'width:35px; ');  break;
            case "valu" : echo '">'.htm_SelectStr($name='Row'.$RowIx.'Col'.$ColIx.'[]' ,$valu,ValuListe(),'width:55px; ');  break;
            case "stat" : echo '">'.htm_SelectStr($name='Row'.$RowIx.'Col'.$ColIx.'[]' ,$valu,StatListe(),'width:65px; ');  break;
            case "osta" : echo '">'.htm_SelectStr($name='Row'.$RowIx.'Col'.$ColIx.'[]' ,$valu,OrdrStatu(),'width:65px; ');  break;  //  Ordre status
            case "sttu" : if ($Drow[9]!=' ') echo '">'.tolk(ListLookup(StatListe(),$search= '',$colsearch=1,$colresult=2)); else echo '">'; break;
            
            case "date" : if ($valu==' ') $clr= 'color: transparent; '; else $clr= ''; // Skjul browserens placeholder ved at angive SPACE
                          echo '">'.'<input type= "date" id="'.$name.'" name="'.$name.'" style="line-height:100%; text-align:left; '.
                                  'font-size:small; height:16px; '.$clr. 
                                   $inpBg. '" value="'.$valu. 
                                  '" placeholder="yyyy-mm-dd" '.$aktiv.' />';  break;   //  Browseren benytter egen placeholder!
            case "html" : //  Kun visning af HTML:
                          echo '">  '.$valu;  break;
            case "show" : //  Kun visning af data:
                          if ($valu==' ') $clr= 'color: transparent; '; else $clr= ''; // Skjul browserens placeholder ved at angive SPACE
                          echo '"> <input type= "text" name="Row'.$RowIx.'Col'.$ColIx.'[]" '.'value="'.$valu. 
                               '" placeholder="'.tolk($Body[6]).'"'.
                               $txAlign.$inpBg.' width:98%; '.$clr.' " readonly /> ';  break;
            case "helt" : echo '"> <input type= "text" name="Row'.$RowIx.'Col'.$ColIx.'[]" '.
                               'value="'.number_format((float)$valu, 0). //  0 dec. = Heltal
                               '" placeholder="'.tolk($Body[6]).'"'.$txAlign.$inpBg.
                               ' width:98%; padding-left:2px; padding-right:2px;" /> ';
                          break;
            case "data" : //  Vis og rediger data: 
            case "area" : if ($valu=='Nyt felt')  {  # Opret ny record
                            echo '"> '.tolk('@Nyt felt:').' <div style="margin-right:0; font-size:x-small">'.
                                 '<select class="styled-select" name="liste"> <option value=" " >-';
                              foreach ($ordlist as $rec) { 
                                echo '<option label="'.$rec[2].'" value="'.$rec[1].'" '.$rec[3];  if ($rec[1]==$valu) echo ' selected';   
                                echo '>'.$lbl=$rec[2].'</option> '; 
                              }
                            echo '</select></div> ';
                          } else # Vis redigerbart datafelt:
                            echo '"> <input type= "text" name="Row'.$RowIx.'Col'.$ColIx.'[]" '.
                                 'value="'.htmlentities(stripslashes(tolk($valu))).'" placeholder="'.tolk($Body[6]).'"'.
                                 $txAlign.$inpBg.' width:98%; padding-left:2px; padding-right:2px;" /> ';
                          break;
            case "keyn" : //  Valgbart, og redigerbart index
                          echo '"><span style="font-size:small" title="'.tolk('@Rækken er valgbar. Klik her').'">'.RowKlick($ModifyRec,$valu).'</span>';  
                          break;
            case "indx" : //  Valgbart, men ikke redigerbart index
                          echo '"><span style="font-size:small" title="'.tolk('@Rækken er valgbar. Klik her').'">'.RowKlick($ModifyRec,$valu).'</span>';  
                          break;
            case "blnk" : //  Værdi vises som BLANK
                          echo '"><span > </span>';  
                          break;
            case "hidd" : //  Skjulte data medtages som skjulte kolonner, for at have en komplet record (gør opdatering simplere):
                          echo 'width:0; padding:0; border:none; display:none;">  <input type= "hidden" name="Row'.$RowIx.'Col'.$ColIx.'[]" '.  //   visibility:hidden;
                               'value="'.htmlentities(stripslashes(tolk($valu))).'" '.$txAlign.$inpBg.' width:0;" /> ';
                          break;
                         // text, 
            default   : { echo '"> <input type= "text" name="Row'.$RowIx.'Col'.$ColIx.'[]" '.'value="'.$valu.'" '.
                               'placeholder="'.tolk($Body[6]).'"'.$txAlign.$inpBg.$fltStyl.' width:98%; font-style:inherit;" /> ';
                        }
          }   // switch InputTyper
          echo '</td>'; //  tabelfelt slut
        }
      };  //  foreach $RowBody

### Tabel-BODY-RowSuffix:
    foreach ($RowSuff as $Suff) { dvl_pretty();
      if ($ModifyRec) {
        $output= $Suff[6];
        if ($Suff[2]=='knap') { // Specielle-knapper:
          if ($Suff[0]=='@Slet')  { $output='<button type= "submit" name="btn_del_'.$RowIx.
                                    '" class="tooltip" style="height:20px; border:0; box-shadow:none; background-color:transparent;" >'. //dvl_pretty().
                                  Lbl_Tip($Suff[6],tolk('@Slet pos: ').$RowIx,'SW','0px'). '</button>'; }    
          if ($Suff[0]=='@Skjul') { $output='<button type= "submit" name="btn_hid_'.$RowIx.
                                    '" class="tooltip" style="height:20px; border:0; box-shadow:none; background-color:transparent;" >'. //dvl_pretty().
                                  Lbl_Tip($Suff[6],tolk('@Skjul pos: ').$RowIx,'SW','0px'). '</button>'; }  // Records som ikke må slettes, kan skjules
          if ($Suff[0]=='@Omdøb') { $output='<button type= "submit" name="btn_ren_'.$RowIx.
                                    '" class="tooltip" style="height:20px; border:0; box-shadow:none; background-color:transparent;" >'. //dvl_pretty().
                                  Lbl_Tip($Suff[6],tolk('@Omdøb pos: ').$RowIx,'SW','0px'). '</button>'; }  //  '10%','data', '',['center'], '@Klik på grønt kryds for at omdøbe kategorien', '<a href="varekort.php?id=$id&rename_category=$kat_id[$d]" onclick="return confirm("Vil du omdøbe denne kategori?")"><ic class="far fa-times-circle" style="color:green; font-size:13px;"></ic></a>'], // <img src=../_assets/icons/rename.png border=0>
           if ($Suff[0]=='@Vælg') { $output='<input type= "checkbox" name="btn_sel_'.$RowIx.
                                    '" class="tooltip" style="height:20px; border:0; box-shadow:none; background-color:transparent;" '. //dvl_pretty().
                                  Lbl_Tip($Suff[6],tolk('@Vælg pos: ').$RowIx,'SW','0px'). ' />'; }
        }
        echo '<td style="text-align:'.$Suff[4][0].'; width:'.$Suff[1].';" >'.$output.'</td>';
      }
    } //  ['@Slet',     '4%',         'text',         '',        'center',   '@Klik på rødt kryds for at slette  ', '<ic class="far fa-times-circle" style="color:red; font-size:13px;"></ic>']
      //  ['0:ColLabl', '1:ColWidth', '2:InpType', '3:Format', '4:FeltJust', '5:ColTip', '6:value!     '            ]
    echo '</tr>';
  } //  foreach $DATA
  
  echo '    </tbody>';
  echo '  </table>';
  echo '</span>';  //  wrapper
  if ($Ødebug) dvl_pretty('Slut-htm_Table: '.$CalledFrom);
} // htm_Table







function htm_Formstart($name='',$more='') { //  eks: $more= 'action="#"';
  dvl_pretty('htm_Formstart');
  echo '<form name="'.$name.'" id="'.$name.'" '.$more.' method="post">';
}
function htm_Formslut() {
  echo '</form>';
}
 
function htm_FormLocal($name='',$more='') { // Anvendes i stedet for ikke lovlige indlejrede forms!
  dvl_pretty('htm_FormLocal');
  echo '<form name="'.$name.'" id="'.$name.'" '.$more.' method="post">';
  //  Elementer i formen tilknyttes med html5 attributen form= "name";
  //  htm_FormLocal($name='sprogform'); kaldes før htm_Panl_Top (når denne starter en form), så formen ikke er indlejret.
  echo '</form>';
} 
 
// JS functioner for Panel håndtering:
function PanelInit() { $maxPaneler= 40;
  echo '<script>';
  echo 'function PanelMinimizeAll() {';
  for ($Ix=1; $Ix<=$maxPaneler; $Ix++) {echo ' var h = document.getElementById("HideDiv'.$Ix.'"); var p = document.getElementById("panel'.$Ix.'");';  
                                        echo ' h.style.display = "none"; p.style.width = "240px"; ';
                                        }
  echo ' }';
  echo 'function PanelMaximizeAll() {';
  for ($Ix=1; $Ix<=$maxPaneler; $Ix++) {echo ' var h = document.getElementById("HideDiv'.$Ix.'"); var p = document.getElementById("panel'.$Ix.'");';  
  echo ' h.style.display = "block"; p.style.width = "100%"; ';}
  echo ' $("table").trigger("applyWidgets"); }';
  echo '</script>';
  //echo ' $("table").trigger("applyWidgets");';
}
  // Når et panel har været klappet sammen, skal Zebra gen-initieres:
  // run_script('$("table").trigger("applyWidgets");');  //  Opdatere Zebra: https://mottie.github.io/tablesorter/docs/example-widget-zebra.html
  // Det virker ikke her!
  
# LAYOUT moduler: Panel= Baggrund for en samling datafelter.
function htm_Panl_Top($frmName='', $capt='', $parms='', $icon='', $klasse='panelWmax', $func='Udefineret', $more='', $BookMark='../_base/page_Blindgyden.php') 
{  # SKAL efterfølges af htm_PanlBund !
  global $Ødebug, $ØTitleColr, $ØPanlForm, $ØProgRoot, $ØPanelIx; 
  $ØPanelIx++;
  echo '<script>';  //  Skjul/vis Panel-Body
  echo 'function PanelSwitch'.$ØPanelIx.'() {';
  echo '    var h = document.getElementById("HideDiv'.$ØPanelIx.'");';
  echo '    var p = document.getElementById("panel'.$ØPanelIx.'");';
  echo '    if (h.style.display === "none") { h.style.display = "block"; p.style.width = "100%"; $("table").trigger("applyWidgets");} else { h.style.display = "none"; p.style.width = "240px"; }}'; //   
  echo 'function PanelMinimize'.$ØPanelIx.'() {';
  echo '    var h = document.getElementById("HideDiv'.$ØPanelIx.'");  var p = document.getElementById("panel'.$ØPanelIx.'");';
  echo '    h.style.display = "none"; p.style.width = "240px"; }';  //h.style.width = "480px"; }';
  echo 'function PanelMaximize'.$ØPanelIx.'() {';
  echo '    var h = document.getElementById("HideDiv'.$ØPanelIx.'");  var p = document.getElementById("panel'.$ØPanelIx.'");';
  echo '    h.style.display = "block"; p.style.width = "100%"; $("table").trigger("applyWidgets");}'; //  $("table").trigger("applyWidgets"); Refresh de tidliger skjulte tablesorter objekter.
  echo '</script>';
  dvl_pretty('htm_Panl_Top');                       //- dvl_ekko('htm_Panl_Top  XX ');
  if ($capt=='') $Ph= 'height:0px;'; else $Ph= '';  //- dvl_ekko('htm_Panl_Top  XX1 '.$ØPanlForm);
  
  if ($frmName>'') //  Uden navn oprettes ingen form, så lokale(/"indlejrede") forms muliggøres!
    {$ØPanlForm= true;  echo '<form name="'.$frmName.'" id="'.$frmName.'" action="'.$parms.'" method="post">'; } //  "ParentForm" - Nestet forms er ikke tilladt, så under-forms skal håndteres specielt!
  else $ØPanlForm= false;
  
  if ($Ødebug) {$fn= '&nbsp; <small><small><small>'.$func.'()</small></small></small>';} else $fn='';
    //   "https://ev-soft.dk/saldi-wiki/doku.php?id=saldi:manualen#konti"
    //   "https://ev-soft.dk/saldi-wiki/doku.php?id=legeplads:lege-side#kontakt"
  $kilde='https://www.ev-soft.dk/saldi-wiki/doku.php?id=';  $book= 'legeplads:';  $mark= '#';
  
  if (strpos('#',$BookMark.' ')>0) $BookMark= $book.$mark.$BookMark;  //  .' ' for at forhindre fejl i strpos(), når $BookMark==NULL
  else
  if (strpos('legeplads',$BookMark.' ')>0) {
    if ($BookMark=='../_base/page_Blindgyden.php') {$kilde= $BookMark; $BookMark= '';};
    if ($BookMark=='') { $wikilnk= '';  $kilde=''; }
  };
  if (strpos($BookMark,'page_Blindgyden.php'))  $wikilnk=''; else
  $wikilnk= '<a href="'.$kilde.$BookMark.'" target="_blank" title="'.
    tolk('@Online hjælp, Find relevante informationer til dette panel, i SALDI-wiki. (Når Wiki for Saldi-€ er oprettet...) ').
    tolk('@Du kan her også være med til at vedligeholde hjælp og vejledning, da WIKIen er redigerbar.').'"><img src= "'.$ØProgRoot.
        '_assets/images/wikilogo.png " alt="Wiki" style="width:20px;height:20px; margin-right:2px; float:right;" '.'> </a>';
  
  echo '<span class="'.$klasse.'" id="panel'.$ØPanelIx.'" '.$more.' > '.    //  Panel-start
       '<span class="panelTitl" style="'.$Ph.' color:'.$ØTitleColr.'; cursor:row-resize; text-align: left; display: inline-block; width:70%; min-height:26px;" '.
       'data-tiptxt="'. tolk('@Klik for at åbne/lukke dette panel').'" '.
       'title="'. tolk('@Klik for at åbne/lukke dette panel').
       '" onclick=PanelSwitch'.$ØPanelIx.'(); >';  //  Panel-Header
  echo '<ic class="'.$icon.'" style="font-size:20px;color:brown;"> </ic> &nbsp;'.ucfirst(Tolk($capt)).$fn;
  echo '</span>';
  echo '<ic class="fas fa-angle-double-up"   style="width:12px;height:12px; margin-top:6px; margin-right:4px; float:right; cursor:zoom-out;" title="'.
        tolk('@Klik for at lukke alle paneler').';" onclick=PanelMinimizeAll(); ></ic>';
  echo '<ic class="fas fa-angle-double-down" style="width:12px;height:12px; margin-top:6px; margin-right:0px; float:right; cursor:zoom-in;" title="'.
        tolk('@Klik for at åbne alle paneler').';"  onclick=PanelMaximizeAll(); ></ic>';
  echo  $wikilnk; //  data-tiptxt virker ikke ovenfor, derfor: title !
  //echo '</ div>'; //  Panel-Header
  echo '<span id="HideDiv'.$ØPanelIx.'" style="background:'.$ØBodyBcgrd.';">';   // Klap-sammen herfra! 
  if ($capt!='') echo '<hr class="style13" style="margin-bottom: 0;margin-top: 0;"/>';
} # Panelets < /Panel-span>, < /hiding> og < /form> er placeret i htm_PanlBund, som skal kaldes til slut!

function htm_PanlBund($pmpt='', $subm=false, $title='@Husk at gemme her, hvis du har rettet noget ovenfor, inden du forlader vinduet.', $akey='', $simu=false, $frmName='') { # SKAL følge efter htm_Panl_Top !
  global $ØPanlForm;    dvl_pretty('htm_PanlBund ');
  if ($title=='') $title= '@Husk at gemme her, hvis du har rettet noget ovenfor, inden du forlader vinduet.';
  if ($ØPanlForm)
    if ($subm==true) {
      echo '<hr class="style13" style= "height:4px;"><span class="centrer" style="height:25px">';  
      if ($simu) {
        htm_CheckFlt($type='checkbox',$name='sim', $valu= $Ønovice, $labl='@Simuler? ', $titl='@Simuler, dvs. gem ikke straks',$revi=true, $more=' '.$Ønovice,' ');//  Simuler
        htm_sp(3);
      }
      htm_Accept($pmpt, $title, $width='', $akey, $frmName); echo '</span>';  
    }
  echo '</span>';  // Klap-sammen hertil!
  echo '</span>';  // Panel-slut
  if ($ØPanlForm) echo '</form>'; //  PanelForm-slut
}

function PanelMin($nr) {
  echo '<script> PanelMinimize'.$nr.'(); </script>';
}
function PanelMinimer($sidste) {
  echo '<script> ';
  for ($nr=0; $nr<=$sidste; $nr++) echo 'PanelMinimize'.$nr.'(); ';
  echo '</script>';
}
function PanelInitier($First,$Last) { //  Minimer et interval
  echo '<script> ';
   for ($nr=$First; $nr<=$Last; $nr++) echo 'PanelMinimize'.$nr.'(); ';
  echo '</script>';
}
function PanelMax($nr) {
  echo '<script> PanelMaximize'.$nr.'(); </script>';
}
function PanelBetjening() { // Pt. ikke i brug
  htm_Caption('@Klik på de enkelte panel-overskrifter, for at Vise/Skjule panelers indhold.');
    execKnap($label='@Minimer alle',  $title='@Skjul indhold i alle paneler', $function='PanelMinimizeAll()');
    execKnap($label='@Maksimer alle', $title='@Vis indhold i alle paneler',   $function='PanelMaximizeAll()');
}

function htm_AcceptKnap($labl='', $title='', $type='', $form='PanelForm', $width='', $akey='', $func='')   //  Afløser for htm_Accept
//  Type: save, navi, erase, create, home
{global $ØBtNavBgrd, $ØBtNavText, $ØBtSavBgrd, $ØBtSavText, $ØBtDelBgrd, $ØBtNewBgrd, $ØTextLight, $ØTextDark, $Ødimmed, $ØTastkeys;
  dvl_pretty('htm_AcceptKnap');
  if ($form) {$navn= $form; $form=' form="'.$form.'" ';}
 ## Genvejstaster:
  if ($ØTastkeys) {
    if ($akey>'') $genv=' ´<i>'.$akey.'</i>´'; else $genv='';
    if (!$genv) $keytip=''; else $keytip= '<br>'.tolk('@Tastatur genvej: ').$akey;
  }
  if ($width) $width= ' width: '.$width.';';

## Udseende:
    switch ($type) {
    case "save"   : {$colors= ' background:'.$ØBtSavBgrd.'; color:'.$ØBtSavText.';'.$Ødimmed;}  break; # Submit-knap: GUL
    case "navi"   : {$colors= ' background:'.$ØBtNavBgrd.'; color:'.$ØBtNavText.';'.$Ødimmed;}  break; # naviger-knap: GRØN 
    case "erase"  : {$colors= ' background:'.$ØBtDelBgrd.'; color:'.$ØTextLight.';'.$Ødimmed;}  break; # Slet: RØD  
    case "create" : {$colors= ' background:'.$ØBtNewBgrd.'; color:'.$ØTextLight.';'.$Ødimmed;}  break; # Ny: BLÅ
    case "home"   : {$colors= ' background:'.$ØBtNavBgrd.'; color:'.$ØBtNavText.';'.$Ødimmed;}  break; # naviger-knap: GRØN 
    default       : {$colors= ' background:'.$ØBtNavBgrd.'; color:'.$ØBtNavText.';'.$Ødimmed;} # naviger-knap: GRØN
  }
## Funktion:
  $result= '<span class="centrer" style="height:25px; ">'; 
  if ($type=='home') 
    {textKnap($label='@Retur til hovedmenu',  $title='@Vend tilbage til programmets hovedmenu'.str_nl().tolk('@(overflødig knap, når topmenuen findes på siden!)'),
                      $link= '../_base/page_Hovedmenu.php', $akey='', $more= $colors);}
  else 
    {$result.= '<button '.$form.' type= "submit" name="btn_'.$navn.'" id="btn_'.$navn.
                      '" class="tooltip" style="margin: 1px 1px; padding: 1px 3px; height: 22px; '.$width.
                      $colors.'" accesskey="'.$akey.'"> '. ucfirst(tolk($labl)).
                      '<span class="tooltiptext">'.tolk($title).$keytip.'</span></button>';
    }
  $result.= '</span>';
  if ($func!='rtrn') echo $result;
  else return $result;
}

function htm_Accept($labl='', $title='', $width='', $akey='', $form='PanelForm')   //  Default kan kun benyttes på PanelForm! (Panl_Top/Panl_Bund)
{global $ØBtNavBgrd, $ØBtNavText, $ØBtSavBgrd, $ØBtSavText, $ØBtDelBgrd, $ØBtNewBgrd, $ØTextLight, $ØTextDark, $Ødimmed, $ØTastkeys;
//if ($form=='') $form=''; else 
{$formname= $form; $form=' form="'.$formname.'" ';}
 ## Genvejstaster:
  if ($ØTastkeys) {
    if ($akey>'') $genv=' ´<i>'.$akey.'</i>´'; else $genv='';
    if (!$genv) $ktip=''; else $ktip= '<br>'.tolk('@Tastatur genvej: ').$akey;
  }
  $genv=''; // Vis ikke genvej i knaptekst, kun i tooltip!
  if ($width) $width= ' width: '.$width.';';
#  $overTxt= 'onmouseover="style.background=\'blue\'" onmouseout="style.background=\''.$ØBtSavBgrd.'\'"';
  dvl_pretty('htm_Accept');
## Udseende:
  /* Generelt-Navigation  */   $colors= ' background:'.$ØBtNavBgrd.'; color:'.$ØBtNavText.';'.$Ødimmed; # naviger-knap: GRØN
  if (($labl=='@Gem') or ($labl=='@Gem rettelser') or ($labl=='@Fakturér') 
                      or ($labl=='@Opret ordre') or ($labl=='@Rediger det valgte') 
                      or ($labl=='@Benyt det') )
                              {$colors= ' background:'.$ØBtSavBgrd.'; color:'.$ØBtSavText.';'.$Ødimmed  # Submit-knap: GUL
                            #  ' onmouseover="style.background=\''.$ØBtSavText.'\'" onmouseover="style.color="\''.$ØBtSavBgrd.'\'" '.
                            #  ' onmouseout ="style.background=\''.$ØBtSavBgrd.'\'"'.
                              ;}
  if (($labl=='@Slet') )      {$colors= ' background:'.$ØBtDelBgrd.'; color:'.$ØTextLight.';'.$Ødimmed;} # Slet: RØD
  if (($labl=='@Opret Ny') )  {$colors= ' background:'.$ØBtNewBgrd.'; color:'.$ØTextLight.';'.$Ødimmed;} #   Ny: BLÅ
## Funktion:
  echo '<span class="centrer" style="height:25px; ">'; 
  if (($labl=='@Retur til hovedmenu')) {textKnap($label='@Retur til hovedmenu',  $title='@Vend tilbage til programmets hovedmenu'.str_nl().tolk('@(overflødig knap, når topmenuen findes på siden!)'),
                                 $link= '../_base/page_Hovedmenu.php', $akey='', 
                                 $more= ' background:'.$ØBtNavBgrd.'; color:'.$ØBtNavText.';'.$Ødimmed); 
  } else  
  echo '<button '.$form.' type= "submit" name="btn_'.$formname.'" id="btn_'.$formname.'" class="tooltip" style="margin: 1px 1px; padding: 1px 3px; height: 22px; '.$width.
  $colors.'" accesskey="'.$akey.'"> '. # Submit-knap: GUL
  ucfirst(tolk($labl)).$genv.'<span class="tooltiptext">'.tolk($title).$ktip.'</span></button>';
  echo '</span>';
}


# LAYOUT moduler: Tapet= Baggrund for en gruppe af Paneler. (Parametre, som htm_Panl_Top)
function htm_Tapet_Top($name='', $capt='', $parms='#', $icon='', $klasse='tapetWmax', $func='Udefineret') {
  global $Ødebug, $ØTitleColr, $ØTapetBgrd, $ØPanelBgrd;
  if ($Ødebug) {$fn= '&nbsp; <small><small><small>f:'.$func.'()</small></small></small>';} else $fn='';
  dvl_pretty('htm_Tapet_Top');
  if ($name>'') echo '<form name="'.$name.'" id="'.$name.'" action="'.$parms.'" method="post"></form>'; //  Elementer på denne form skal angive: form="xxx"
  echo '<span class="'.$klasse.'" style= "background:'.$ØTapetBgrd.';" >'.  //  '; background-image: url(../_assets/images/eurosymbol60.png);" >'.
    ' <span class="tapetTitl" style="display: inline-block; height:30px; background:#FFEEDD;; " >'.
    '<ic class="'.$icon.'" style="font-size:22px; color:'.$ØTitleColr.'"></ic> &nbsp;'.ucfirst(Tolk($capt)).$fn.'</span>';
} # Boxens /span  er placeret i htm_TapetBund, som skal kaldes til slut!

function htm_TapetBund($formslut=false) { # SKAL følge efter htm_Tapet_Top !
  dvl_pretty('htm_TapetBund');
  echo '</span>';//  if ($formslut) echo '</form>';
}

function htm_Rammestart($Caption='',$bord='1px') {
  echo '<fieldset  style="border: '.$bord.' solid #8c8b8b; padding:2px; font-family: sans-serif;"> <legend style="font-size:14px; font-weight:600; "><tc>'.tolk($Caption).'</tc></legend>';
}
function htm_Rammeslut() {
  echo '</fieldset>';
}
 

function htm_Prompt($label,$align) {
  echo '<p style="font-size:16px; text-align:'.$align.';"> '.tolk($label).'</p>';
}

function htm_Caption($labl='',$style='color:#550000; font-weight:600;',$align='') {
  echo '<data-colrlabl style="'.$style.$align.'">'.tolk($labl).'</data-colrlabl>';
}  
function str_Caption($labl='',$style='color:#550000; font-weight:600;') {
  return '<data-colrlabl style="'.$style.'">'.tolk($labl).'</data-colrlabl>';
}  

function htm_Plaintxt($labl='',$style='color:#777777; font-weight:400; font-size:14px; ') {
  echo '<span style="display: inline-block; '.$style.'">'.tolk($labl).'</span>';
}  
function str_Plaintxt($labl='',$style='color:#777777; font-weight:400; font-size:14px; ') {
  return '<span style="display: inline-block; '.$style.'">'.tolk($labl).'</span>';
}  
  
function htm_DataFelt($label,$data,$algn='left') {
  $str= str_Caption($label).'&nbsp;'.$data;
  echo '<span style="display: inline-block; text-align:'.$algn.'">'.$str.'</span>';
}
  
# Felter i en horisontal række:
function htm_FrstFelt($wth,$bord='0',$more='') 
                            {dvl_pretty('htm_FrstFelt'); echo '<table style="border:'.$bord.' border-collapse:collapse; padding:0px; width:100%;"><tr '.$more.'><td style="width:'.$wth.';"> ';}
function htm_NextFelt($wth) {dvl_pretty('htm_NextFelt'); echo '</td>  <td style="width:'.$wth.';"> ';}
function htm_LastFelt()     {dvl_pretty('htm_LastFelt'); echo '</td>  </tr> </table>';}


# PROGRAM-MODUL;
function SprogValg(&$ØprogSp,$formName='') {  # htm_Caption('@Program sprog:');
  global $ØprogSprog;
  if ($formName>'') $onForm= '="'.$formName.'" '; else $onForm= ''; //  $formName benyttes med htm_FormLocal()
  if (isset($_POST['sprog'])) { $Øprogsprog = $_POST['sprog']; }    //  Opfrisk med seneste værdi
  htm_nl(2);
  echo '<span style="display: inline-block; width:280px">';
  htm_OptioFlt($type='text', $name='sprog', $valu= $ØprogSprog, 
      $labl= '@Program sprog:', 
      $titl= tolk('@Hvilket sprog vil du benytte programmet med ?'), 
      $revi= true, 
      $optlist= SPR_Liste(),
      $action= '#', 
      $events= 'onchange="this.form.submit();" ',
      $maxwd= '',
      $onForm,
      '','','',$nl=3
    );
    echo '</span>';
//   if (strlen($Øprogsprog)==2) { // da, en, fr...
//      $GLOBALS['ØprogSprog']= $ØprogSprog; 
//      $_SESSION['ØprogSprog']= $ØprogSprog; 
//    }
}

/*
function valgsprog() {  //  DEMO
  if (isset($_POST['sprog'])) { $sprog = $_POST['sprog']; echo $sprog; }
  echo // HTML:
  '<form action="#">
    <select name="sprog">
      <option value=""  selected disabled hidden>Vælg...</option>
      <option value="da"                        >Dansk  </option>
      <option value="de"                        >Tysk   </option>
      <option value="en"                        >Engelsk</option>
      <option value="fr"                        >Fransk </option>
    </select>
    <input type="submit" value="Submit">
  </form>  ';
}
*/

function Foot_Links ($maxi=false, $arg='', $doPrint, $doErase, $doLookUp, $doAccept, $doExport, $doImport,$OpslLabl='') { global $ØprogSprog, $ØProgTitl, $Ønovice;
  htm_FormLocal($name='sprogform');
  htm_Panl_Top($name='linkform',$capt='',$parms='',$icon='','panelWmax',__FUNCTION__,'','');
    if (($maxi) and ($OpslLabl>'')) echo '<p align="center"><b>'.tolk('@Handling:').'<b></p>';
    echo '<p align="center">';  #<ic class="fa '.$icon.'" style="font-size:22px;color:green"></ic>
    if ($doPrint)   iconKnap($faicon='fas fa-print',        $title= tolk('@Udskriv')      .' '.$sideObjekt, $link='../_base/page_Blindgyden.php');
    if ($doErase)   iconKnap($faicon='far fa-minus-square', $title= tolk('@Slet posten'),                   $link='../_base/page_Blindgyden.php'.$goBack);
    if ($doLookUp)  iconKnap($faicon='fas fa-search-plus',  $title= '? '.tolk($OpslLabl),                   $link='../_base/page_Blindgyden.php');
    if ($doAccept)  iconKnap($faicon='far fa-check-square', $title= tolk('@Godkend alt')  .' '.$sideObjekt, $link='../_base/page_Blindgyden.php');
    if ($doExport)  iconKnap($faicon='fas fa-upload',       $title= tolk('@CSV-Export')   .' '.$sideObjekt, $link='../_base/page_Blindgyden.php');
    if ($doImport)  iconKnap($faicon='fas fa-download',     $title= tolk('@Fil import')   .' '.$sideObjekt, $link='../_base/page_Blindgyden.php');
    echo '</p>';
    if ($maxi) { 
      htm_FrstFelt('15%',0,'style="text-align:left;"');  
      htm_NextFelt('20%');    echo '<span style="text-align:left">'.SprogValg($ØprogSprog,$formName='sprogform').'</span>';
      htm_NextFelt('08%');    textKnap($label='@TIPs',  $title='@Her er der nyttige tips, til brugen af SALDI', $link='../_base/page_Tips.php');  // link= 'Tips()');
      htm_NextFelt('16%');    echo '<div style="display:inline-block;">'.$arg.'</div> ';
      htm_NextFelt('16%');    textKnap($label='@Nyheder',  $title='@Her omtales nogle af de nyheder, der er tilføjet i den nye SALDI-€', $link='../_base/page_News.php');
      htm_NextFelt('10%');    echo '<div style="display:inline-block; ">'.htm_accept('@Log ud',tolk('@Log ud og forlad').$ØProgTitl).'</div> ';
      htm_NextFelt('15%');    echo ' ';
      htm_LastFelt();
      echo '<table><tr><td><tc><divline style="margin-left:0.5em">';
#+      userTip();
      if ($Ønovice)
        echo '<small><b>'.tolk('@noTIP:').'</b> '.tolk('@Hold musen over').' <data-colrlabl>'.tolk('@Blå tekster med skyggeramme, ').
             '</data-colrlabl>'.tolk('@så får du hjælpetekster og tips.').'</small>';
      echo '</tc></td><td style="text-align:right;">'.
#      '<small><small><i>Design: EV-soft </i></small></small>'.
      '</divline></td></tr></table>';
    }
  htm_PanlBund($pmpt='@Gem',$subm=false,$title='@Gem');
}

// TopMenu-rutiner: (benyttes i Menu_Topdropdown )
function MenuStart($clas='firstmain',$href='#',$labl='',$titl='') {  //  SKAL efterfølges af MenuSlut()
  echo "\n";
  echo '<div id="container" style="display:inline-block;">';  // style/css: se filen _base/htm_TopMenu-head.css.htm
// Responsive-menu! if (smal skærm) width:120px; else width:1200px;
// Lavet med CSS i /_base/htm_TopMenu-head.css.htm
  echo '  <data-menu id="wb_TopMenu" style="display:inline-block; position:fixed; left:auto; top:1px;  height:24px; z-index:999;">';  //  width:'.$menuwd.';
  echo '    <ul>';
  echo '      <li class="'.$clas.'" style="color:black; width:20px; text-align:left;"><a href="'.$href.'" target="_self" style="background:#EEEEEE;" data-tiptxt="'.tolk($titl).'">'.tolk($labl).'</a> </li>';
}
function MenuGren($clas='',$href='#',$labl='',$titl='',$more='') {
  if ($href=='../_base/page_Blindgyden.php') {$blnd='<i style="font-color:gray;">'; $obs='<small> '.tolk('@påtænkt!').'</small>';} else {$blnd=''; $obs='';};
  if ($clas=='exit') /*(strpos($labl,'Log ud')>0)*/ {$bold='<span style="color:red; font-weight:600; left: -110px;">'; } else {$bold='';};
  if (strpos($href,'ttp' )>0) $targ='_blank'; else $targ='_self'; //  Test om http forekommer (externt/lokalt link?)
  $link= 'href="'.$href.'" target="'.$targ.'" title="" data-tiptxt="'.tolk($titl).'" >'.$blnd.$bold.ucfirst(tolk($labl));
  if ($bold!='') {$link.= '</span>'.$obs;}
  if ($blnd!='') {$link.= '</i>'.$obs;} else {$link.= $obs;}
  echo "\n\n";
  switch ($clas) {
    case "withsubmenu": echo '<li><a class="'.$clas.'"    '.$more.$link.'</a>  <ul>'; break;
    case "firstitem":   echo '<li    class="'.$clas.'"><a '.$more.$link.'</a> </li>'; break;
    case "exit":        echo '<li    class="'.$clas.'"><a '.$more.$link.'</a> </li>'; break;
    case "":            echo '<li>                     <a '.$more.$link.'</a> </li>'; break;
    case "lastitem":    echo '<li    class="'.$clas.'"><a '.$more.$link.'</a> </li></ul></li>'; break;
    default :           ;
  }
}
function MenuSlut() {global $ØProgRoot, $ØProgTitl, $Øprogvers, $Øcopydate, $Øcopyright, $Ødesigner;
  //echo "\n";
  echo '    </ul>';
  echo Lbl_Tip($labl='@Lokal menu',$titl='@Alle panelers overskrift, virker som lokale menupunkter i det aktuelle vindue. Klik på panel-overskriften, for at vise/skjule panelets indhold.','SW').' ';
  echo '<span style="text-align: center" title="'.$ØProgTitl.' - Version '.$Øprogvers.' - Copyright '. $Øcopydate.' '.$Øcopyright.' - '.tolk('@Design: ').$Ødesigner.'" ><img src= "'.
        $ØProgRoot.'_assets/images/saldi-e50x170.png " alt="Saldi Logo" height="40" style="top:2px; position:absolute;" ></span>';
  echo '  <br>';
  echo '  </data-menu>';
  echo '</div>';
  echo "\n";
}

function Menu_Topdropdown($vis_finans=true, $vis_debitor=true, $vis_kreditor=true, $vis_prodkt=false, $vis_lager=true) { //  Menu-placering/størrelse styres i MenuStart()
global $Ødebug, $ØProgTitl;
  MenuStart($clas='firstmain',      $href='../_base/page_Hovedmenu.php',          $labl='@MENU:',               $titl='Programmets MENU');
    if ($vis_finans) {
      MenuGren($clas='withsubmenu', $href='#',                                    $labl='@FINANS',              $titl='@Administration af regnskab');
      MenuGren($clas='firstitem',   $href='../_finans/page_Kladdeliste.php',      $labl='@Kasse kladder',       $titl='@Her kan du vælge kassekladde, og redigere den');
      MenuGren($clas='',            $href='../_finans/page_Regnskab.php',         $labl='@Regnskab',            $titl='@Se det aktuelle regnskab her');
      MenuGren($clas='',            $href='../_finans/page_Budget.php',           $labl='@Budget',              $titl='@Se og rediger budget');
      MenuGren($clas='',            $href='../_system/page_Kontoplan.php?chg=ok', $labl='@Se kontoplan',        $titl='@Her kan du se den aktuelle kontoplan');
      MenuGren($clas='lastitem',    $href='../_finans/page_Rapport-fin.php',      $labl='@Rapporter',           $titl='@Her vælger du hvad du vil se i en rapport');
    //MenuGren($clas='lastitem',    $href='../_finans/page_Kontrol.php',          $labl='@Kontrol spor',        $titl='@Her kan du spore datas oprindelse');
    }      
    if ($vis_debitor) {
    MenuGren($clas='withsubmenu',   $href='#',                                    $labl='@DEBITOR',             $titl='@Her finder du det, der angår dine Kunder');
      MenuGren($clas='firstitem',   $href='../_debitor/page_Opretordre.php',      $labl='@SALG-daglig...',      $titl='@Opret en ny salgs ordre...');
      MenuGren($clas='',            $href='../_debitor/page_Ordreliste-deb.php',  $labl='@Salgs ordrer',        $titl='@Oversigt over ordrer og deres indhold');
      MenuGren($clas='',            $href='../_debitor/page_Debitor.php',         $labl='@Konti',               $titl='@Oversigt over kunder, og leverancer til disse');
    //MenuGren($clas='',            $href='../_base/page_Blindgyden.php',         $labl='@Annuller Gebyr',      $titl='@Tilbageføring af rykkergebyr');
      MenuGren($clas='lastitem',    $href='../_debitor/page_Rapport-deb.php',     $labl='@Rapporter',           $titl='@Analyser af salg');
    }      
    if ($vis_kreditor) {
    MenuGren($clas='withsubmenu',   $href='#',                                    $labl='@KREDITOR',            $titl='@Her finder du det, der angår dine Leverandører');
      MenuGren($clas='firstitem',   $href='../_kreditor/page_Ordreliste-kre.php', $labl='@KØB-daglig...',       $titl='@Opret en ny købs ordre...');
      MenuGren($clas='',            $href='../_kreditor/page_Ordreliste-kre.php', $labl='@Købs ordrer',         $titl='@Oversigt over leverandører');
      MenuGren($clas='',            $href='../_kreditor/page_Kreditor.php',       $labl='@Konti',               $titl='@Oversigt over kreditorer og oplysninger om disse');
      MenuGren($clas='lastitem',    $href='../_kreditor/page_Rapport-kre.php',    $labl='@Rapporter',           $titl='@Analyser af køb');
        
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
      MenuGren($clas='firstitem',   $href='../_system/page_Kontoplan.php?chg=no', $labl='@Kontoplan',           $titl='@Her vedligeholder du den aktuelle kontoplan');
      MenuGren($clas='withsubmenu', $href='#',                                    $labl='@Indstillinger &nbsp; =>', $titl='@Indstillinger for programmet');
        MenuGren($clas='firstitem', $href='../_system/page_Valuta.php',           $labl='@1. indstil-ofte',     $titl='@Her har du de hyppigst benyttede indstillinger');
        MenuGren($clas='',          $href='../_system/page_Divsetup2.php',        $labl='@2. indstil-flere',    $titl='@Her har du de sjældnere benyttede indstillinger');
        MenuGren($clas='lastitem',  $href='../_system/page_Tilvalgsetup3.php',    $labl='@3. indstil-extra',    $titl='@Her aktiverer og indstiller tilvalgs funktioner');
      MenuGren($clas='',            $href='../_system/page_Backup.php',           $labl='@Sikkerheds kopiering',$titl='@Her kan du sikre dig dine regnskabsdata, bilags filer og programinstallation');
      MenuGren($clas='',            $href='../_system/page_Licens.php',           $labl='@Om programmet',       $titl='@Her finder du oplysninger om programmet, og serveren det kører på');
      MenuGren($clas='lastitem',    $href='../_system/page_Regnskabet.php',       $labl='@Om regnskabet',       $titl='@Her finder du oplysninger om regnskabet, som du aktuelt arbejder på');
      //MenuGren($clas='lastitem',    $href='../_base/page_Blindgyden.php',         $labl='@Log ud',              $titl= tolk('@Log ud og forlad').$ØProgTitl);
    }
    if (true) {
      MenuGren($clas='withsubmenu', $href='#',                                    $labl='@EKSTRA',              $titl='@Bogholderens redskaber');
        MenuGren($clas='firstitem', $href='../_assets/Calculator/strimmelcalc.php?ttp',      $labl='@Strimmelregner',      $titl='@Start en simpel kalkulator');
        MenuGren($clas='',          $href='../_base/page_Blindgyden.php',         $labl='@Notesblok',           $titl='@Start en simpel skrivemaskine');
        MenuGren($clas='',          $href='../_base/page_Tips.php',               $labl='@Tips',                $titl=tolk('@Her er der nyttige tips, til brugen af').$ØProgTitl);
        MenuGren($clas='',          $href='../_base/_intro/intro.html',           $labl='@Introduktion',        $titl='@Her redegøres for de kommende forbedringer i version 5.0 - SALDI-€');
        MenuGren($clas='',          $href='../_base/page_News.php',               $labl='@Nyheder',             $titl='@Her omtales nogle af de nyheder, der er tilføjet i den nye SALDI-€');
        MenuGren($clas='lastitem',  $href='http://www.ev-soft.dk/saldi-wiki/doku.php?id=saldi:manualen', 
                                                                                  $labl='@DokuWiki - Manual',   $titl='@Manual, tips og anden hjælp finder du på'.$ØProgTitl.'-DokuWiki');  
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
    if (true) {
        MenuGren($clas='exit',      $href='../_base/page_Startup.php', 
                                    $labl='<i class="fas fa-sign-out-alt" style="font-size:16px; color: red; " ></i> '.tolk('@Log ud'),  
                                    $titl=tolk('@Forlad SALDI').str_lf().tolk('@i låst tilstand.'),$more=' style="background:white; width:70px; box-shadow:3px 3px 1px #EDEDED;" ');
    }
  MenuSlut();
}
 

/*
Begreber anvendt i SPALTER:
 -------------------------------------------------------------------------------------------------------
|                                                                                                      |
|                                                WINDOW                                                |
|                                                                                                      |
|   |---------------------------|---------------------------|---------------------------|              |
|   |         SpalteTop         |         NextSpalte        |         NextSpalte        |              |
|   |                           |                           |                           |              |
|   |                           |                           |                           |              |
|   |             S             |             S             |             S             |              |
|   |             P             |             P             |             P             |              |
|   |             A             |             A             |             A             |              |
|   |             L             |             L             |             L             |              |
|   |             T             |             T             |             T             |              |
|   |             E             |             E             |             E             |              |
|   |                           |                           |                           |              |
|   |             1             |             2             |             3             |              |
|   |                           |                           |                           |              |
|   |                           |                           |                           |              |
|   |                           |                           |       SpalteBund          |              |
|   |---------------------------|---------------------------|---------------------------|              | 
|                                                                                                      | 
|   |---------------------------|---------------------------|---------------------------|              |
|   |         SpalteTop         |         NextSpalte        |         NextSpalte        |              |
|   |                           |                           |                           |              |
|   |                           |                           |                           |              |
|   |             S             |             S             |             S             |              |
|   |             P             |             P             |             P             |              |
|   |             A             |             A             |             A             |              |
|   |             L             |             L             |             L             |              |
|   |             T             |             T             |             T             |              |
|   |             E             |             E             |             E             |              |
|   |                           |                           |                           |              |
|   |             4             |             5             |             6             |              |
|   |                           |                           |                           |              |
|   |                           |                           |                           |              |
|   |                           |                           |       SpalteBund          |              |
|   |---------------------------|---------------------------|---------------------------|              | 
|                                                                                                      | 
|------------------------------------------------------------------------------------------------------|
*/

### SPALTER, PANELER m.v.:
function SpTest($colr) {if ($GLOBALS["Ødebug"]) return 'style="border: 3px solid '.$colr.';"'; else return '';}
// Spalter, layout i vinduer. Benyttes i page_xxx.php-filer:
function SpalteTop ($w=240) {dvl_pretty('SpalteTop');  echo '<data-SpltHead '.SpTest('yellow').'> <span id="spltwrap" '.SpTest('green').' /> '.
                                  '<data-column id="spalt'.$w.'" '.SpTest('blue').' >'; } // SpalteTop spalt240, spalt320 (erkl. i Out_style.css.php)
function NextSpalte($w=320) {echo '</data-column> <data-column id="spalt'.$w.'" '.SpTest('red').'>'; } 
function SpalteBund()       {echo '</data-column> </div> </data-SpltHead><span class="clearWrap" />'; }

// Paneler, layout i spalter. Benyttes i out_Panls-filen:
function PanelStart() {dvl_pretty('panelStart');  echo '<PanlFoot style="border: 3px solid tomato">';}
function PanelSlut()  {echo '</PanlFoot>';}
function SkilleLin () {echo '<hr size="10" color="#AA4D00"/>';}



// HTML-Layout-rutiner:
function htm_CentHead($txt='')  {echo '<div style="text-align:center; font-weight:900;"><data-colrlabl>'.$txt.'</data-colrlabl></div>';}
function htm_CentrOn($more='')  {echo '<span style="text-align:center; '.$more.'">';}
function htm_CentOff()          {echo '</span>';}
function htm_Spacer($w='30')    {echo '<div1 style= "width:'.$w.'em;">&nbsp; </div1>';}

// En gruppe af elementer på en linie, med en faelles overskrift forrest.
function htm_KnapGrup($Pmpt='@Vis:', $Start=true, $ruler=true, $style='text-align:center;') { global $ØbrwnColor;
  if ($Start==true) { if ($ruler) echo '<hr>';
    echo '<span style="margin-left:0.1em; padding:6px; font-weight:normal; background: #FFEEDD; color:'.$ØbrwnColor.'; '.$style.'" ><i>'.tolk($Pmpt).'</i> &nbsp;'; // display:inline-block; 
  }
  else  
    echo '</span>';
}

// Streng-output:
function htm_Ihead($source) {echo '<br/><i>'.$source.'</i> ';}
function htm_hr($c='#0')    {echo '<hr style="color:'.$c.';"/>';}
function htm_nl($rept=1)    {echo str_repeat('<br />',$rept);}
function htm_lf($rept=1)    {echo str_repeat(' &#xa;',$rept);}  //  LineFeed
function htm_sp($rept=1)    {echo str_repeat('&nbsp;',$rept);}


// Streng-funktioner:
function str_bold($source,$result='',$tail='&nbsp;&nbsp;') {return $result.'<b>'.$source.'</b>'.$tail;}
function str_Ihead($source) {return '<br /><i>'.$source.'</i> ';}
function str_hr($c='#0')    {return '<hr style="color:'.$c.';"/>';}
function str_nl($rept=1)    {return str_repeat('<br />',$rept);}
function str_lf($rept=1)    {return str_repeat(' &#xa;',$rept);}  //  LineFeed i strenge  &#010;  &#xa;  \n \u000A  \x0A  &#13;
function str_sp($rept=1)    {return str_repeat('&nbsp;',$rept);}

// Tilstands-funktioner:
function isital($str) {if (strpos(' '.$str,'italic')>0) return 'checked'; else return '';}

  
// Array-funktioner:
function Vis_Data($arr) { //  Vis indhold af en array:
  if (is_array($arr)) 
    foreach ($arr as $key => $value){
    echo '<br>'."$key => $value"; }
  else {echo "<br>{ ".$arr." }"; }  
  echo '<br>';
} //  mere overskuelig end var_dump

function var_dump_arr($mixed = null) {  //  "PrettyView" af array
  ob_start();  var_dump($mixed);  $content = ob_get_contents();  ob_end_clean();  
  $content= str_replace(' [','<br>  [',$content);;
  return '<pre>'.$content.'</pre>';
}

# SUPPLERENDE moduler:


//////////////////////////////////////////////////////////////////////////////////////////////////////////
# SPROG system:


function sprogDB_import() { # Filen skal være gemt i UTF-8 format!
  global $ØsprogTabl, $ØlanguageTable, $ØProgRoot, $currDir; //  $ØlanguageTable indeholder ALLE sprog
  $fp=fopen($ØProgRoot.'_config/Sprog_DB.csv',"r");
  if ($fp) { $ØlanguageTable= [];
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
  function Tolk($FraseKey) {                         # Tolk() benyttes til sprogoversættelse af alle hard-codede program-tekster.
  global $ØsprogTabl, $ØprogSprog,                   # Fraser med @-prefix er system-tekster, der kan omsættes til andet sprog.
         $ØlanguageTable, $debug;                    # Vær opmærksom på at samme frase, ikke kaldes flere gange f.eks. i rutiner i underniveauer.
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
  switch ($ØprogSprog= strtolower($ØprogSprog)) { # 0 Key - sæt index for opslag
    case "da" :$ix= 1;  break;  # 1 Dansk   
    case "en" :$ix= 2;  break;  # 2 Engelsk 
    case "de" :$ix= 3;  break;  # 3 Deutsch 
    case "fr" :$ix= 4;  break;  # 4 Français
    case "tr" :$ix= 5;  break;  # 5 Türkçe  
    case "pl" :$ix= 6;  break;  # 6 Polski  
    case "es" :$ix= 7;  break;  # 7 Español 
    case "it" :$ix= 8;  break;  # 8 Italian 
                                # 9 Grønlandsk       
    default   :{$ix= 1; echo "<data-colrlabl>Sprog?:".$ØprogSprog." </data-colrlabl>"; $ØprogSprog='da'; break;} // Er $ØprogSprog ugyldigt, sættes det til 'da'
  } else $ix= 1;
  $TblRow= found_index($ØlanguageTable, 0, $FraseKey);
  if (substr($FraseKey,0,2)=='@:') {};                                    # Er frasen med @:-prefix: (Angår blanketter/formularer) ikke benyttet endnu!
  if (substr($FraseKey,0,1)=='@')                                         # Er frasen med @-prefix:
       {if ($ØprogSprog=='da')  {$result= trim($FraseKey,'@');}           # Er sproget dansk fjernes @-prefix blot i resultatet, skal udkommenteres!
        else if ($TblRow>0) {$result= $ØlanguageTable[$TblRow][$ix];}     # ellers slås op i sprog-tabellen
        else 
        if ($debug) {$result= trim($FraseKey,'@');}
        else #{$result= $FraseKey.'<small><small> (Danish!)</small></small>'; $MissingFrase.='<br>'.$FraseKey;} # Oversættelse mangler: Vis $FraseKey  med @-prefix
          {$result= trim($FraseKey,'@');}
       }  
  else {$result= $FraseKey;}                                              # Fraser uden @-prefix returneres uændret.
  return($result= trim($result,',"'));
  }
}
//  PLAN: Opdeling så fraser ang. blanketter, holdes adskilt fra programfladens fraser, 
//  f.eks. med prefix: @: (bemærk kolon), eller de håndteres i DB-tabeller.

# OBS!  Benyt konsekvent prefix: '@ ikke: "@ så alle fraser kan udtrækkes automatisk!
# Oversættelsen sker automatisk i BASISMODULER med tolk(), når parametre behandles.
# I sjældne tilfælde (lange eller sammensatte tekster), er det nødvendigt at benytte tolk() lokalt.
# Undgå forkortelser og sammensatte ord, som kan forringe oversættelse og liniewrap.
# Undgå indledende og afsluttende SPACE, og <HTML> koder i fraser. Benyt @@ hvis en frase skal starte med @
# Undgå SPACE+SPACE som vil blive ændret til SPACE, og bringe uorden i frasens længde.
# Koder som <br> og &#xa; (svt. LF) bringer også uorden i frasens længde.
# Tegnet: " må ikke forekomme i fraser, det korrumperer csv-formatet. Benyt f.eks. ' i stedet.
//////////////////////////////////////////////////////////////////////////////////////////////////////////

# Specielle dynamiske fraser, som ellers ikke forekommer direkte i kildetekster (dannet automatisk f.eks. med periodeoverskrifter() ):
//  '@Skyldig moms i alt'
//  '@Jan'  '@Feb'  '@Mar'  '@Apr'  '@Maj'  '@Jun'  '@Jul'  '@Aug'  '@Sep'  '@Okt'  '@Nov'  '@Dec'
//  '@Januar 2017 (1. regnskabsmåned i regnskabsåret 2017)' $periode_lang er dynamisk og kan ikke tolkes automatisk !!!
//
//  I slutningen af out_init.php angives en del andre fraser, som skal med i sprog-tabellen.
//  
//////////////////////////////////////////////////////////////////////////////////////////////////////////


# htm_ rutiner:

 if (!function_exists('htm_HiddVari')) 
{ // Start på gruppe af functions erklæringer:  Forebyg gentagne læsninger!
function htm_HiddVari($name='',$val='') {
  if ($val=='') {$val= $name;  global $$val; $valu= $$val; } else $valu= $val;
  echo '<input type="hidden" name="'.$name.'" value="'.$valu.'">';
}
function htm_NullVariabler($namelist=['']) { foreach ($namelist as $name) {global $$name; $name = NULL; }}
function htm_GetVariabler($namelist=[''])  { foreach ($namelist as $name) {global $$name; $name = Øif_isset($_GET[$name]); }}
function htm_PostVariabler($namelist=['']) { foreach ($namelist as $name) {global $$name; $name = Øif_isset($_POST[$name]); }}
function pushed($name) {return (isset($_POST[$name])); } //  En submit-knap med navnet: $name er aktiveret: true/false

function set_Var2Nul($namelist=['']) { foreach ($namelist as $name) {global $$name; $name = NULL; }}
function set_Var2Get($namelist=[''])  { foreach ($namelist as $name) {global $$name; $name = Øif_isset($_GET[$name]); }}
function set_ajour($name)  {if (isset($_POST[$name]))  {$_SESSION[$name]= $$name= htmlspecialchars($_POST[$name]); return $$name; } } //  En variabel med navnet: $name er opdateret, og husket i SESSION
function set_FormVars ($names) { foreach ($names as $name) $$name= set_ajour($name); }  //  Ja: $$name er ikke en fejl. Der refereres til værdien af variablen med navnet $name
//function get_FormVars ($names) { foreach ($names as $name) $$name= $_SESSION[$name]; }
function dev_show() { if ($GLOBALS["Ødebug"]) {echo 'SESSIONS variablers indhold: ';  vis_data($_SESSION);} }
//  session_destroy();  //  Slet alle SESSIONS variabler (Luk browser, sletter ikke ! ?)


//////////////////////////////////////////////////////////////////////////////////////////////////////////
//        Generering af diverse lister:

//  Uanset om nogle af disse lister tages ud af brug, fordi de gemmes i databasen, 
//  bør de holdes ajour, så de kan udgøre dokumentation af diverse forkortelser og koder!
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
function FartListe () {return( [['@0: Generelt - f.eks. papirformat','0','@0: Generelt'],['@1: Grafik= Linier og billeder','1','@1: Grafik'], //  FormularArtListe
                                ['@2: Tekster og variabelnavne ($)','2','@2: Tekster'],['@3: Ordrelinier - Gentagende linier på sidens midte (£)','3','@3: Ordrelinier'],
                                ['@5: Mail tekst - Emne og Beskedtekst i mail forsendelse','5','@5: Mail tekst']] ); }
function SideListe () {return( [['@Alle sider','A','@A: Alle sider',''],['@Kun første side','1','@1: Kun første side',''],['@IKKE første side','!1','@!1: IKKE første side',''],
                                ['@Kun sidste side','S','@S: Kun sidste side',''],['@IKKE sidste side','!S','@!S: IKKE sidste side','']] ); }
function Side_List () {return( [['@Alle sider','A','A'],['@Kun første side','1','1'],['@IKKE første side','!1','!1'],
                                ['@Kun sidste side','S','S'],['@IKKE sidste side','!S','!S']] ); }
function FontListe () {return( [['@Sans-serif','Helvetica','Helvetica'],['@Serif','Times','Times'],['@Optisk Læsbar','OCRbb12','OCRbb12']] ); }
function KontListe () {return( [['@Drifts konto','D','D','Drift'],['@Status konto','S','S','Status'],['@Sum konto','Z','Z','Sum fra'],['@Overskrift (system!)','H','H',' '],
                                ['@Resultat konto','R','R','Resultat'],['@Sideskift (system!)','X','X',' '],['@Lukket konto','L','L','Lukket']] ); }
function MomsListe () {return( [['@Købs-moms','K1','K1','Køb 1'],['@Salgs-moms','S1','S1','Salg 1'],['@Ydelses-moms','Y1','Y1','Ydelse 1'],['@EU-moms','E1','E1','Varer 1']] ); }
                             //  '@Momskode: K_:Købs... S_:Salgs... Y_:Ydelses..., E_:Europæisk..., '
function StatListe () {return( [['@Aktiv','','@Aktiv'],['@Lukket','on','@Lukket']] ); } // værdi: "on" svarer til Lukket! Alt andet: Aktiv
function Aar_Liste () {return( [['2016','2016','2016'],['2017','2017','2017'],['2018','2018','2018']] ); }
function Grp0Liste () {return( [['@Alle ','0','@0. Alle','']] ); }
function Grp1Liste () {return( [['@Ydelser ','1','@1. Ydelser',''],['@Handelsvarer','2','@2. Handelsvarer',''],
                                ['@Forbrugsvarer', '3','@3. Forbrugsvarer',''],['@Fragt/Porto','4','@4. Fragt/Porto','']] ); }
function Grp_Liste () {return( [['@Alle ','0','@0. Alle',''],['@Ydelser ','1','@1. Ydelser',''],['@Handelsvarer','2','@2. Handelsvarer',''],
                                ['@Forbrugsvarer', '3','@3. Forbrugsvarer',''],['@Fragt/Porto','4','@4. Fragt/Porto','']] ); }
function Afd_Liste () {return( [['@Alle ',        '0','@0. Alle',''],       ['@Forretning ',  '1','@1. Forretning',''],
                                ['@Lager 1 ',     '2','@2. Lager 1',''],    ['@Lager 2 ',     '3','@3. Lager 2','']] ); }
function Slg_Liste () {return( [['@Alle ',        '0','@0. Alle',''],       ['@Revisor ',     '1','@1. Revisor',''],
                                ['@Bogholder ',   '2','@2. Bogholder',''],  ['@Admin ',       '3','@3. Admin','']] ); }                                
function PageListe () {return( [['@A5-Højformat ','A5-portrait','A5-p'],['@A5-bredformat ','A5-landscape','A5-l'],['@A4-Højformat ','A4-portrait','A4-p'],
                                ['@A4-bredformat ','A4-landscape','A4-l'],['@A3-Højformat ','A3-portrait','A3-p'],['@A3-bredformat ','A3-landscape','A3-l']] ); }
function PaprListe () {return( [['@A5 Højformat: H:210mm B:148mm', 'A5p', '@A5 portrait',''], ['@A5 Bredformat: H:148mm B:210mm','A5l', '@A5 landscape',''],
                                ['@A4 Højformat: H:297mm B:210mm', 'A4p', '@A4 portrait',''], ['@A4 Bredformat: H:210mm B:297mm','A4l', '@A4 landscape',''],
                                ['@A3 Højformat: H:420mm B:297mm', 'A3p', '@A3 portrait',''], ['@A3 Bredformat: H:297mm B:420mm','A3l', '@A3 landscape','']] ); }
function FormObjkt () {return( [['@Side layout og placering af ordrelinier',                    '0:Layout',       '@Layout'],
                                ['@Tekster og variabler med data',                              '1:Tekster',      '@Tekster'],
                                ['@Grafiske streger og logo-billede',                           '2:Linjer',       '@Grafik'],
                                ['@Gentagne ordre- eller specikations-linier på siders midte',  '3:Ordrelinjer',  '@Ordrelinjer'],
                                ['@Emne og besked benyttet til mailforsendelse',                '5:Mail tekst',   '@Mail tekst']] ); }
function ValuListe () {return( [['@Danske kroner','DKK','DKK'],['@Euro','EUR','EUR'],['@US dollar','$','$'],['@Engelsk pund','£','£']] ); }
function ValutaArr () {return( [['@Danske kroner','DKK','@DKK - Danmark - Kroner'],['@Svenske kroner','SEK','@SEK - Sverige - kroner'],  
                                ['@Norske kroner','NOK','@NOK - Norge - Kroner'],['@Europæisk Euro','EUR','@EUR - EU fællesskabet - Euro'],  
                                ['@US dollar','USD','@USD - Amerikansk - Dollar'],['@Pund Sterling','GBP','@GBP - Det Forenede Kongerige - Pund']] ); }

# Ikke færdige:                     
function RabtListe () {return( [['@Venstre ','V','V'],['@Center ','C','C'],['@Højre ','H','H']] ); }
function PrisListe () {return( [['@Venstre ','V','V'],['@Center ','C','C'],['@Højre ','H','H']] ); }
function TilbListe () {return( [['@Venstre ','V','V'],['@Center ','C','C'],['@Højre ','H','H']] ); }
function X1xxListe () {return( [['@Venstre ','V','V'],['@Center ','C','C'],['@Højre ','H','H']] ); }
function XxxxListe () {return( [['@Venstre ','V','V'],['@Center ','C','C'],['@Højre ','H','H']] ); }

function Art_Liste () {return( [
             ['@Kontospecifikation fra valgte momsbelagte konti i valgt periode. Viser moms for posteringer hvor momsen er trukket automatisk.','kontokort_moms','@Kontokort med moms'],
             ['@Kontospecifikation alle valgte konti i valgt periode.','kontokort','@Kontokort'],
             ['@Saldo for statuskonti og summering af disse for valgte konti i valgt periode.','balance','@Balance'],
             ['@Saldo for driftkonti + budgettal og summering af disse for valgte konti i valgt periode og sat i relation til budgettal.','resultatb','@Resultat/budget'],
             ['@Saldo for driftkonti og summering af disse for valgte konti i valgt periode.','resultat', '@Resultat'],
             ['@Saldo for driftkonti + budgettal og summering af disse for valgte konti i valgt periode.','budget','@Budget'],
             ['@Saldo for momskonti og summering i valgt periode.','momsangivelse','@Momsangivelse'],
             ['@MOMS Listeangivelsesfil, som kan lægges op via SKATs hjemmeside','periodeliste','@Periodelister'] 
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
          # ['@10: POS (Point of Sale ),         '10', '@10: POS (Kasse)',''],  //  Kontantsalg 
            ['@11: blanket for kontokort',       '11', '@11: Kontokort',''],
            ['@12: blanket for indkøbsforslag',  '12', '@12: Indkøbsforslag',''],
            ['@13: blanket for rekvisition',     '13', '@13: Rekvisition',''],
            ['@14: blanket for købsfaktura',     '14', '@14: Købsfaktura','']
           ]  ); }   
            
function CVR_Liste () {return( [
            ['@0: Generel søgning: (ikke telf.)',   'search', '@Generelt',''],  //  vat, name, produ, phone, search
            ['@1: Centralt Virksomheds Registernr', 'vat',    '@CVR',''], 
            ['@2: Produktionsenhed-nr',             'produ',  '@P-enh.',''],
            ['@3: Telefonnummer',                   'phone',  '@Telefon',''],
            ['@4: Firma navn',                      'name',   '@Firma','']
           ]  ); 
}
function CVR_Land () {return( [
            ['@1: Søg i det danske register',   'dk', '@DK',''],
            ['@2: Søg i det norske register',   'no', '@NO','']
           ]  ); 
}
function OrdrStatu () {return( [
            ['@0: Ordren er et tilbud',           '0', '@Tilbud',''],
            ['@1: Ordrens tilbud er accepteret',  '1', '@Godkendt',''],
            ['@2: Ordrens ydelser er leveret',    '2', '@Leveret',''],
            ['@3: Ordrens er faktureret',         '3', '@Faktureret',''],
            ['@4: Ordrens er betalt',             '4', '@Betalt',''],
            ['@5: Ordren er annulleret',          '5', '@Annulleret','']
           ]  ); 
}
if ($valg=="tilbud") {$status="status = 0";}
  elseif ($valg=="faktura") {$status="status >= 3";}
  else   {$status="(status = 1 OR status = 2)";}

function ShowCol($liste,$col,$sep='') { $result=$sep; // Vis en kolonne fra en liste
  foreach ($liste as $row) { $result.= tolk($row[$col]).$sep; }
  return $result;
}

function ListLookup($liste,$search,$colsearch,$colresult) { $result=''; //  Returner en kolonne fra en liste på grundlag af en anden kolonne
  foreach ($liste as $row) {if ($row[$colsearch]==$search) {$result= $row[$colresult]; break;} }
  return $result;
}

function SPR_Liste () {return( [ # [0]:Tip [1]:value [2]:Text  [3]:events
      ['Vælg dansk sprog',               'da','Dansk',    ],  //  Redigeres noget her, skal der også redigeres i Panl_LanguageJuster()
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
  $kvt= ['@1. kvartal','@2. kvartal','@3. kvartal','@4. kvartal'];
  $Ø_KvtList= DanListe($kvt, ' '.tolk('@måned'));   # tolk() erklæres først i out_base!

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


OM "out_*" systemet:
 Al output til skærm, sker via centrale rutiner, som er blok-struktureret, så rettelser kun skal
 udføres et minimum steder. [out_base.php]
 Hvor der i ny kode benyttes: "echo"/"print" skal det vurderes, om subrutiner kan benyttes, eller skal oprettes.
 
 Alle vinduer opbygges af paneler, som alle er defineret i [out_Panls.php] (eller del-kopier deraf)
 Panelers titel består af en icon og en tekst, samt 2-3 knapper yderst til højre.
 De har ofte en Gem/opdater-knap i bunden.
 
 Alle HTML-sider initieres med filen [htm_pagePrepare.php] og afsluttes med [htm_pageFinalize.php]
 
 Adaptive layout ved Skærmbredde[px]:
 < 320    : 1 spalte med fast bredde.
 320.. 640: 1 spalte med varierende bredde.
 640..1000: 1 spalte med varierende bredde.
 > 1000   : 3-spaltet layout.
 
 640: Top-menu skifter mellem: Top/Left
 
 Tip vises ved mus over skygge-markeret label. Label optager ikke selvstændig plads, da den er indeholdt i input-felt.
 Der er konsekvent angivet tip for: Knapper for navigation, Knapper for funktioner, Kolonne-overskrifter, Titler, m.fl.
 Der kan angives tast-genveje for alle knapper/links. Visning af genveje kan slås fra/til. (Foretrækkes: Vis kun genveje i tip)
 
 Mange tabeller er med fast vindueshøjde, så overskrifter over og knapper under tabellen, altid kan være synlige.
 Der er grundlæggende 1 tabel-rutine: htm_Table().
 Tabeller kan med flag akti-/deaktivere: Redigerbar, Filter, Sortering, Opret ny record, m.v.
 
 Alle labels og tip kan oversættes til et andet program-sprog (7 europæiske sprog), 
 med nem opdatering af alle forekommende fraser, når prefix: '@ er benyttet.
 Fraselængden for dansk bør pt. begrænses til max. 200 tegn.
 Er der længere fraser, skal de opdeles i flere, ved at indskyde ...').tolk('@... i frasen,
 på et hensigsmæssig sted (ny sætning) for ikke at sabotere sprogoversættelse.
 Tegn der ikke må benyttes: < > " @ (udover prefixet)' fordi de mistolkes!
 Formaterings tags som: </small> fjernes. De skal i stedet angives i selvstændige strenge omkring fraser.
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
 Farver, placeringer. tekststørrelser m.v. kan ofte justeres centralt i CSS-fil. [out_style.css.php]
 Tabel-system (tablesorter) og menu-system, har selvstændige css-filer (htm_Tableinit.php og htm_TopMenu-head.css.htm)
 
 Der er mulighed for assistance til fejlfinding, når flaget (debug==true)
 
 Systemet omfatter pt. (2017) følgende filer:
 (page_Layoutdemo.php     - Demo af systemet)
 (out_javascr.js          - Systemets javascript)
 out_style.php (.css)     - Systemets CSS
 out_base.php             - Systemets Modulære Grundsystem
 out_Panls.php            - Systemets Paneler med PROGRAM-moduler (opsplittes i flere filer: comm, prim og sekd)
 (out_vinduer.php         - Systemets vinduer opbygget af flere Paneler)
 user_interface.php       - Modulært Grundsystem ??
 frasescann.php           - Skanner efter fraser i alle projektfiler, men gemmer pt. kun dem i: user_interface.php og page_Layoutdemo.php
 Sprog_DB.csv             - Importfil, hvor alle sprogvarianter samles manuelt (copy/paste), med hjælp af Google-translate.
 Se opdateret oversigt i htm_pagePrepare.php!
 
 
 I programmets tekstkonstanter, benyttes følgende tegn-prefixer:
 @xxx i starten af fraser, som skal kunne vises/udskives på fremmedsprog
 $xxx i tekster til formularer, hvor de angiver et variabelnavn
 £xxx i vare-tekster til formularer, hvor de angiver et variabelnavn
 :xxx i tekster til formularer, hvor det angiver et flag, f.eks, :GEBYR
 
 Disse forklaringer kan være forældet! Se kildekode og lokale kommentarer, for aktuelle regler.
 
*/


//  Uløste problemer:
//  msg_Dialog() - har nogle uforklarlige begrænsninger, når man flytter vinduet sideværts. 
//  og der er konflikt-problemer, med andre javascript.
//  msg_Besked - css-baseret, erstatter msg_Dialog.
//   
//  Tips-knap ang. browser-taster, virker ikke.
//   
//  Tip for begyndere kan ikke skiftes.
//   
//  Søg iøvrigt stikord: FIXIT
//   
//   
//   
//   
?>
