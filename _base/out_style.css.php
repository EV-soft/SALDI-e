<?php $DocFil= '../_base/out_style.css.php';    $DocVer='5.0.0';     $DocRev='2018-10-06';      $DocIni='evs';  $ModulNr=0;   header("Content-type: text/css"); 
/* ## Purpose: 'Design af out_* elementers udseende.';  */
  if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$DocFil,'','');
  global $ØPanelBgrd, $ØTapetBgrd, $ØPageBcgrd; 
  if ($ØPanelBgrd=='') $ØPanelBgrd= '#FFEFDF'; 
  $shadowBlur= '3px';
  #DocAlder($DocRev);
?>
/* 
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2018 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 * Design af out_* elementers udseende.
 *
 * CSS-Layout af checkbox,textarea,input,label samt submit :
 *
 * Filer skal gemmes i UTF-8 format uden BOM!
 * 
  Oprettet: 2016-08-00 evs - EV-soft    #: Dette bibliotek er udviklet 2016-1018 af EV-soft.
  Ændrings-Log:
      
 *
/*
  if ($ØPanelBgrd== '#D4FFFF')  {$ØPanelBgrd= '#FFFFD4';}  # Æggeskal
  else                          {$ØPanelBgrd= '#D4FFFF';}  # Turkis
  $ØPanelBgrd= '#FFFFD4';      #              '#F9F8F8';   # Lysgrå
  $ØPanelBgrd= '#EFEFEF';      #              '#EFEFEF';   # Brækket Hvid Tema-light
  $ØPanelBgrd= '#565656';      #              '#565656';   # Mørkgrå      Tema-dark
* /
if (($_SESSION['Øtema']=='dark') or ($Øtema=='dark')) { // Virker tilsyneladende ikke !
  $ØPanelBgrd= '#AAAA80';
  $ØPageBcgrd= '#112233';
  $shadowBlur= '0px';
}
else                {
  $ØPanelBgrd= '#EFEFEF';
  $ØPageBcgrd= '#F4FFF4';
  $shadowBlur= '5px';
}

?>

/* PHP:
highlight.comment #FF8000 Orange
highlight.default #0000BB Blue
highlight.html    #000000 Black
highlight.keyword #007700 Green
highlight.string  #DD0000 Red
*/

/* FARVEPALETTE: (Central justering af benyttede nuancer) */
:root {
    --roedColor: #FF0000;   /* Statiske farvenuancer    */
    --guulColor: #F3F033;
    --grenColor: #336600; 
    --grenColr1: #448800;   /* placeholder-text */
    --blueColor: green; /* #4479ff;   /* LysBlå: Labels Caption */ 
    --oranColor: #F37033;
    --brunColor: #550000;   /*  Tabel kanter  */
    --grayColor: #ACA9A8;
    --xx11Color: #3CBC8D;
/*  --HintsBgrd: #FCFCCC;                  /* Tip: #FCFCCC-Gul baggrund, #E6EEF7-Blå baggrund */
/*  --HintsBgrd: rgba(248, 248, 248, 1.0); /* Ingen transparens!    #FCFCCC;   /*  Tip: #FCFCCC-Gul baggrund, #E6EEF7-Blå baggrund */
    --HintsBgrd: rgba(55, 55, 55, 0.90); 
    --HintsText: #FFFFFF;
    --xx33Color: #CCEDFE;   /*  Filter: Lys-Blå baggrund */
    --grColrLgt: #CCCCCC;
    --Saldiblue: #003366;
    --GradieTop: #eeeeee; 
    --GradiBott: #cccccc;
/*  --PanelBgrd: #FFFFC4;   /* Panelers baggrund  (æggeskalsfarve)*/
/*  --PanelBgrd: #D4FFFF;   /* Panelers baggrund  (turkis)  */
/*  --PanelBgrd: #FFFFFF;   /* Panelers baggrund  (hvid)    */
/*  --PanelBgrd: <?php global $ØPanelBgrd; echo $ØPanelBgrd; ?>;  /* Initieres i ../_base/_base_init.php */
    --PanelBgrd: <?php echo $GLOBALS["ØPanelBgrd"]; ?>;
/*  --TapetBgrd: #44BB44;   /* Tapet baggrund  (æggeskalsfarve)    */
    --TapetBgrd: <?php echo $GLOBALS["ØTapetBgrd"]; ?>;
    --ButtnBgrd: #44BB44;   /* LysGrøn   */
    --ButtnText: #FFFFFF;   /* Hvid   */
    --BtLnkBgrd: #FCFCCC;   /* LysGul   */
    --BtLnkText: #000000;   /* Sort   */
    --ButtnShad: #DDDDDD;   /* Knap skygge (lysgrå)  */
    --PageBcgrd: #333333;   /* Side baggrund (lysblå) F4FFF4  */
    --PageBcgrd: <?php echo $ØPageBcgrd; ?>;  /* Initieres i ../_base/_base_init.php */
    --PageImage: url(../_assets/images/paper_fibers.png);   /* Side baggrundsbillede  */
    /* url understøttes ikke i browsere endnu! (March 29, 2016) https://blog.hospodarets.com/css_properties_in_depth  Images url like url(var(--image-url)) don’t work */
    --PageImage: <?php echo $ØPageImage; ?>;  /* Initieres i _base_init.php /Virker i ../_base/htm_pagePrepare.php */
 /*   --PageImage: '../_assets/images/paper_fibers.png';   /* Side baggrundsbillede  */
    --fltBgColr: #FFFFFF;   /* Validerede input felters baggrund  #53a40 */
    --fltTxColr: #550000;   /* Validerede input felters tekster #53a40 */
    --tblRowDrk: #e0e0e0;   /* Tabellinie med mørk baggrund */
    --tblRowLgt: #f0f0f0;   /* Tabellinie med lys baggrund  */
    --btnTxNorm: #000000;   /* Standard tekst på knap */
    --btnTxOver: #900000;   /* Tekst på knap, når musen er over knappen */
    --SkyTxNorm: #AAF;      /* Tekst med skygge #AAF; */
    
    /* Herudover forekommer green, blue, white, black og grånuancer, samt "importerede".  */
    /* Således kaldes farvekonstanter:    var(--GradiBott) */
}


/* Menu_Topdropdown i toppen af sider */
/* Se filen: htm_TopMenu-head.htm (style/css)  

div#container
{
   width: 970px;
   position: relative;
   margin: 0 auto 0 auto;
   text-align: left;
}


body {
 /*  margin: 5px 5px; */
  margin: auto;
  width: 100%;
  max-width: 1200px;
  text-align: center;
  font-size: 14px;
  font-family: Arial, Helvetica, sans-serif;
  line-height: 100%;
/*  background-color: var(--PageBcgrd); */
  background-color: <?php echo $ØPageBcgrd; ?>;
/*  background: var(--PageBcgrd);  /* Virker! */
/*  background-image: var(--PageImage);  /* Virker ikke! */
/*  background-image: -webkit-var(--PageImage);    /* Virker ikke! */
/*   background-image: url( var(--PageImage, "../_assets/images/paper_fibers.png") );  */   /* Virker ikke! */
/*  background-image: url(../_assets/images/paper_fibers.png)  /* Virker! */
}

.center-div
{
  margin: 0 auto;
  width: 1000px;
  height: 1000px;
  background-color: var(--grColrLgt);
  border-radius: 3px;
}

/* PANELER i SPALTER: (Tilpasning til smalle skærme) */
/* for 960px or greater */
@media screen and (min-width: 960px) {
  #spltwrap  {width: 1280px; padding: 0px;    /*  margin: 5px 5px; */}
  #spalt240  {width: 240px;  padding: 5px 5px; margin: 5px 5px 5px 0px; float: left; }
  #spalt320  {width: 320px;  padding: 5px 5px; margin: 5px 5px 5px 0px; float: left; }
  #spalt400  {width: 400px;  padding: 5px 5px; margin: 5px 5px 5px 0px; float: left; }
  #spalt480  {width: 480px;  padding: 5px 5px; margin: 5px 5px 5px 0px; float: left; }
  #spalt640  {width: 640px;  padding: 5px 5px; margin: 5px 5px 5px 0px; float: left; }
  #spalt720  {width: 720px;  padding: 5px 5px; margin: 5px 5px 5px 0px; float: left; }
  #spalt960  {width: 960px;  padding: 5px 5px; margin: 5px 5px 5px 0px; float: left; }
  #spalt1100 {width:1100px;  padding: 5px 5px; margin: 5px 5px 5px 0px; float: left; }
  #spaltsaut {width: auto;   padding: 5px 0px 5px 5px; margin: 5px 0px 5px 0px; float: left;}
  data-PanlHead, PanlFoot  {clear: both;   padding: 0 5px;}
}

/* for 960px or less */
@media screen and (max-width: 960px) {
  #spltwrap  {width: 99%;  }
  #spalt320  {width: 41%;  padding: 5px 5px;   margin: 0px 0px 5px 5px;}
  #spaltsaut {width: auto; padding: 5px 5px;   margin-left: 0px;   clear: both;    float: none;  }
  data-PanlHead, PanlFoot {padding: 1px 5px;   clear: both;}
}
  
/* for 640px or less */
@media screen and (max-width: 640px) {
  #spalt320  {width: auto;  float: none;  margin-left: 5px; }
  #spaltsaut {width: auto;  float: none;  margin-left: 5px; }
}

/* for 480px or less */
@media screen and (max-width: 480px) {
  data-PanlHead {height: auto; }
  h1    {font-size: 2em;  }
}

@media screen and (max-width: 1280px) { @viewport { width: 1280px; } }

/*************************************/

/* PANELER: (i forskellige bredder) */
.panelWmax, .panelWaut, .panelW120, .panelW110, .panelW100, .panelW960, .panelW720, 
.panelW640, .panelW480, .panelW400, .panelW320, .panelW240, .panelW160 {
    border: 1px solid gray;
    background: var(--PanelBgrd);
    box-shadow: 3px 3px  <?php echo $shadowBlur; ?> var(--ButtnShad);
    border-radius: 0.4em;
    /* margin: 0.4em 0.2em 0.4em 0.2em; /**/
    padding: 0.3em 0.3em 0.4em 0.3em; /**/
}
.panelWmax { /* width: 100%; */   }
.panelWaut { width: auto;   }
.panelW120 { width: 1200px; }
.panelW110 { width: 1100px; }
.panelW100 { width: 1020px; }
.panelW960 { width: 960px;  } 
                 /* 800px; */
.panelW720 { width: 720px;  }
.panelW640 { width: 640px;  }
                 /* 560px; */
.panelW480 { width: 480px;  }
.panelW400 { width: 400px;  }
.panelW320 { width: 320px;  }
.panelW240 { width: 240px;  }
.panelW160 { width: 160px;  }
.panelTitl,.tapetTitl {
  font-family: sans-serif;
  font-size: 0.82em;
  font-weight: 600;
  height: 1.1em;
  margin: 0.0em 0.2em;
  padding: 0.1em 0.1em 0.3em;
  /*background: #FFEEDD;*/
  position: relative;
  width: 100%;
  text-align: center;
}
.tapetTitl {
  font-size: 1.2em;
  font-family: sans-serif;
}

.tapetWmax {
    border: 3px solid gray;
    background: var(--TapetBgrd);
    background-image: url(../_assets/images/eurosymbol60.png);
    box-shadow: 3px 3px  <?php echo $shadowBlur; ?> var(--ButtnShad);
    border-radius: 0.40em;
    margin: 0.4em 0.2em 0.4em 0.2em;
    padding: 0.3em 0.3em 0.3em 0.3em;
    /* max-width: 100%;   */ 
    /* width: 640px;    */
}

.clearWrap {
    /* overflow: auto; */
    clear: both;
}

/*************************************/

textarea {
   font-family: inherit;
   font-size: inherit;
}

form {
    margin-bottom: 0.2em;
}

.inputRow input{
  text-align: right;
  clear: both;
  float:left;
  margin-right:15px;
  color: var(--roedColor);
  background-color: var(--xx11Color);
}

.nyInput input{
  width:98%; 
  padding-left:4px; 
  background-color: var(--guulColor);
  text-align: left;
}

.lablInput {
  height: 2.2em;
  margin: 0.05em 0.05em;
  position: relative;
 /*  padding-top: 8px; /* htm_CombFelt: Gør plads til label */
  /* width: 100%; */
}

.lablInput checkbox,
.lablInput textarea,
.lablInput input {
  border: 1px solid var(--grColrLgt); /* border-width, border-style, and border-color */
  border-radius: 0.20em;
  background: white;
  margin: 0.20em 0.0em;
  height: auto;
/*  width: 200px; */
  cursor: text;
  font-size: 0.850em;
  font-weight: 500;
  /* padding: 0.8em 1% 0.05em 1%; */  /*  top right bottom  left  */
  position: absolute;
  transition: all 0.15s ease;
  width: 98%;
  /* height: 95%; */
  padding: 12px 2px 1px;
 /*  height: 1.2em;  */
}

.lablInput label {
  color: var(--grayColor);
  padding: 0.2em 1%;
  cursor: text;
  font-size: 0.95em;
  font-weight: 500;
  padding: 0.1em 1% 0.1em 1%; /*  top right bottom  left  */
  position: absolute;
  transition: all 0.15s ease;
  /* width: 95%; */
}

.label {
  font-style: italic; 
  font-family: sans-serif;
  font-weight: normal;
  color: blue;
  padding: 0.05em 1%;
}

.lablInput checkbox.filled ~ label,
.lablInput textarea.filled ~ label,
.lablInput input.filled ~ label,
.lablInput checkbox ~ label,
.lablInput textarea ~ label,
.lablInput input ~ label,
.lablInput input:focus ~ label {
  font-size: 0.65em;
  font-weight: 400;
  text-align: right;
  position: absolute;
  width: 99%;
  color: var(--blueColor);  /* LysBlå */
  padding: 0.005em 0 0;
}

.lablInput checkbox.filled,
.lablInput textarea.filled,
.lablInput input[type="date"].filled,
.lablInput input[type="text"].filled,
.lablInput input[type="email"].filled:valid {
  font-weight: 500;
  background: var(--fltBgColr); /* FeltFarve  */
  color: var(--fltTxColr);
}
.lablInput input[type="number"].filled {
  color: var(--roedColor);
/* width: 80px; */
/* text-align: right; */
  position: absolute;
  /* padding: 0.05em 0; */
}

.lablInput checkbox.filled ~label:after,
.lablInput textarea.filled ~label:after,
.lablInput input[type="text"].filled ~label:after,
.lablInput input[type="email"].filled:valid ~label:after {
  color: var(--blueColor);
  display: inline-block;
  font: normal normal normal 14px/1em;  /*  font-style  font-variant  font-weight   font-size/line-height font-family */
  font-size: 2em;
  text-rendering: auto;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  position: absolute;
  top: 0.3em;
  right: 0.3em;
  transform: translate(0, 0);
}

input[type="submit"] {
  background: var(--Saldiblue);
  border: double var(--grayColor);  /* border: solid #101010; /* #DA1D52; */
  border-radius: 0.20em;
  border-width: 0 0.0 0.15em;
  cursor: pointer;
  font-size: 0.9em;
/*  display: table; */
  color: white;     /* Tekst farve */
  text-align: center;
  margin: 0.15em 2% 0.05em 1%;  /*  top right bottom  left  */
  padding: 0.15em 0.15em 0.15em 0.15em;
  transition: all 0.15s ease;
}

input[type="submit"]:hover {
  background: var(--guulColor) ;
  color: black;     /* Tekst farve */
  /* border-width: 0 0 0.1em; */
  /* margin-top: 0.05em; */
}

input[type="submit"]:active {
  border-width: 0 0 0em;
  margin-top: 0.15em;
}

input[type="tal2d"],
input[type="date"],
input[type="text"],
input[type="helt"],
input[type="data"] {
  border: 1px black;
  border-right: 1px gray;
  border-collapse;  */
}


input[type="date"]::-webkit-inner-spin-button { -webkit-appearance: none; }
input[type="date"]::-webkit-calendar-picker-indicator { background: orange; width: 7px;}

input[type="date"]::-webkit-inner-clear-button { -webkit-appearance: none;  }
input::-ms-clear {
    color: red;       /* This sets the cross color as red. */
    /* display: none;    The cross can be hidden by setting the display attribute as "none" */
}
input[type="date"] {
    display: -webkit-inline-flex;
    font-family: monospace;
    overflow: hidden;
   /* padding: 0; */
/*    padding: 0.8em 1% 0.05em 1%;  /*  top right bottom  left  */
/*    width: 100px; */
    -webkit-padding-start: 1px;
    /* 
    -webkit-box-align-items: left;
    -webkit-inner-spin-button: display: none; */
    height: 17px;
}


input::-webkit-datetime-edit {
    -webkit-flex: 1;
    -webkit-user-modify: read-only !important;
    display: inline-block;
    min-width: 0;
    overflow: hidden;
}

input::-webkit-datetime-edit-fields-wrapper {
    -webkit-user-modify: read-only !important;
    display: inline-block;
    padding: 1px 0;
    white-space: pre;
}

input:not([type]), input[type="tel" i], input[type="url" i] { /* input[type="number" i], input[type="password" i],  */
    padding: 1px 2px;
}

option {
  font-family: monospace;
  /* font-style: italic; */
}


.fa-paragraph:before { font-weight: bold; content: '§'; }

.styled-select select {
   background: transparent;
   width: 200px;
   padding: 5px;
   /* font-family: "Andale Mono", "Monotype.com", monospace; */
   font-size: 16px;
   line-height: 1;
   border: 0;
   border-radius: 0;
   height: 34px;
   -webkit-appearance: none;
}
data-colrlabl  { font-family: sans-serif; /* font-style: italic;*/ font-weight: normal; font-size: 0.75em; color: var(--blueColor);}
data-yelllabl  { font-family: sans-serif; /* font-style: italic;*/ font-weight: normal; font-size: 0.75em; color: yellow;}
captlabl       { font-family: sans-serif; font-style: italic; font-weight: normal; font-size: 0.80em; color: brown;}
a              { text-decoration: none;}
i              { text-decoration: none;} 
test           { display: inline;}
big            { font-size: larger;}
.centrer       { text-align: center }
cbutton        { margin:auto;  display:block;}

menuBg, titlBg
{
  margin: 0.04em 0.10em;
  display: inline-block;
  /*   width: 300px;  or just set a width */
  position: relative;  
}
titlBg {
 /*  transform: rotate(270deg); */
}
.btnTit { /* Titler i gittermenuens top-knapper: Vis ingen tooltip! */
/*   content: attr(title); */
  font-size: 0.95em;
  font-family: sans-serif;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: black;
  padding: .5em 1em;  
  border: 2px;  
  border-radius: 4px;
  letter-spacing: 0em;
  font-weight: 600;
}

.btn       { color: var(--btnTxNorm); text-decoration: none;}
.btn:hover { color: var(--btnTxOver); z-index: 777;}
.btn {
  font-size: 0.85em;
  font-family: sans-serif;
  white-space: pre-wrap;
  /* min-width: 220px; */
  position: absolute;
  top: 30%;
  left: 50%;
  z-index: 666;
  transform: translate(-50%, -50%);
  color: var(--btnTxNorm);
  margin-top: 3px;
/*   max-width: 160px; */
  padding: .001em;  
  border: none;  
  border-radius: 4px;
  letter-spacing: 0em;
  font-weight: 300;
}

/* Anvend custom-tip i stedet for browser-tip: */
deaktiv_input[type="submit"][title],
deaktiv_input[type="text"][title],
.text[data-tiptxt]:hover:after,
.th[data-tiptxt]:hover:after,
.th[data-tiptxt]:hover:after { /* Tip på grå gradient baggrund*/
  content: attr(data-tiptxt);
  white-space: pre-wrap; 
  height: 100%;
  /* display: inline-block; */
  min-width: 120px;
  max-width: 240px;
/*  min-height: 32px;   /* Problem med automatisk størrelse!  Baggrund tilpasser sig ikke til tekst */
  padding: 4px 8px;
  color: #333;
  opacity: 0.9;
  position: absolute;
  bottom: 25px;    /* top: -70px; */
  left:  -25px;    /* right: -30%; */
  z-index: 19999;   /* */
  
  -moz-border-radius:     5px;
  -webkit-border-radius:  5px;
  border-radius:          5px;
  
  -moz-box-shadow:    0px 0px 4px #222;
  -webkit-box-shadow: 0px 0px 4px #222;
  box-shadow:         0px 0px 4px #222;
  
  background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0, #ffffff),color-stop(1, #cccccc));
  background-image: -webkit-linear-gradient(top, #ffffff, #cccccc);
  background-image: -moz-linear-gradient(   top, #ffffff, #cccccc);
  background-image: -ms-linear-gradient(    top, #ffffff, #cccccc);
  background-image: -o-linear-gradient(     top, #ffffff, #cccccc);
}

button {
  background-color: var(--ButtnBgrd);
  color: var(--ButtnText);
  border-radius: 6px;
  transition-duration: 0.4s;
/*   min-width: 60px; */
  
  }
.knap {
  margin:1px; 
  padding:2px; 
  font-size:0.80em; 
  font-family: sans-serif;
  font-weight: 500; 
  max-width: 250px;
  border: 2px;  
  border-radius: 6px;
  display: inline;
  /* x            color:'.$color=$ØTitleColr.'; */
  transition: font-size 0.1s;
}

.knap:hover  {font-size:0.85em; }

.fieldset-auto-width {
  display: inline-block;
}

/*************************************/
/* 
Tip-system:  Label [.tooltip .labltip], som kan vise popup-vindue [.tooltip*] 
       med teksten [.tooltiptext] på mørkfarvet shape-baggrund, når musen holdes over label
       Vises med minimal forsinkelse
*/

/* 
Custom data-tiptxt benyttet til program-tip og link-knapper i paneler: */
.tooltip,
.tooltipL, .tooltipR, .tooltipB, .tooltipT,
.tooltipNW, .tooltipSW, .tooltipSØ
{   font-family: sans-serif;
    position: relative;
    cursor: help;
    display: inline-block;
    background: Snow;
    color: black;
    border-radius:3px;
    border: 1px solid var(--GradiBott);
    box-shadow: 2px 2px 1px var(--ButtnShad);
    padding: 0px 3px 1px 3px;
    text-align: center;
    margin-bottom: 2px;
    font-size: 11px;
    /* top: -8px;  /* Kun htm_CombFelt: Hæv label */
}
}
.tooltip{
    text-shadow:0px 0.6px var(--SkyTxNorm); /* 1px 1px var(--SkyTxNorm); */
}

/* .tooltip                                 /* LABEL som musen holdes over */
.tooltiptext,                               /* Hjælpetekst som synliggøres */
.tooltipL, .tooltipR, .tooltipB, .tooltipT, /* Bestemmer placering af Tip  */
.tooltipNW, .tooltipSW, .tooltipSØ
{ /* Skjult tip tekst på farvet baggrund plac ved label */
    visibility: hidden;
    min-width: 160px;
    background-color: var(--HintsBgrd);
    color: var(--btnTxNorm);
    font-style:normal;
    font-weight:400;
    font-size: 12px;
    text-align: center;
    border-radius: 6px;
    border: 1px solid #555555;
    padding: 5px 3px;
    position: absolute;
    z-index: 99999;
}

.tooltiptext,
.tooltipT  {bottom: 20px;  left: -25px;}                      /* Plac over kilde - Inputfelters label */
.tooltipB  {top: 22px;     left: -90px;   min-width: 120px;}  /* Plac under kilde - Kolonneoverskrifter, hvor der ikke er plads ovenover. */
.tooltipNW {bottom: 20px;  left: -180px;  min-width: 160px;}  
.tooltipSW {top: 22px;     left: -280px;  min-width: 160px;}  /* Ved 1. kolonne er der ikke plads tv for feltet*/
.tooltipSØ {top: 22px;     left: 28px;    min-width: 160px;}  /* Ved n. kolonne er der ikke plads th for feltet*/
.tooltipL  {left: -26px;   margin-top: -28px;}
.tooltipR  {right: -26px;  margin-top: -28px;}

/* .tooltipL:hover .tooltiptext,
.tooltipR:hover .tooltiptext,
.tooltipT:hover .tooltiptext, */
.tooltip:hover .tooltipT,
.tooltip:hover .tooltipB,
.tooltip:hover .tooltipNW,
.tooltip:hover .tooltipSW,
.tooltip:hover .tooltipSØ,
.tooltip:hover .tooltipL,
.tooltip:hover .tooltipR,
.tooltip:hover .tooltiptext,
.tooltiptext:hover
{ /* Vis tip tekst */
  box-shadow: 3px 3px 5px var(--grColrLgt);
  transition-delay: 0.2s;
  background-color: var(--HintsBgrd);
  color: var(--HintsText);
  /* opacity: 0.99; */
  visibility: visible;
  z-index: 999;
  text-shadow: 0px 0px  var(--SkyTxNorm);

}


/* 
Custom data-tiptxt benyttet til menuers navigations-knapper: */
img,
ic,
data-ic,
  a, 
 ax        { color: var(--btnTxNorm); text-decoration: none;}

data-ic {
  box-shadow: 2px 2px gray;
  border: 2px solid #000;
}

img:hover,
  a:hover, 
 ax:hover  { 
  color: var(--btnTxOver); 
  }

 img[data-tiptxt]:hover:after,  /* Fremover: Udskift title med data-tiptxt, for at benytte custom-tip   */
   a[data-tiptxt]:hover:after,
  a1[data-tiptxt]:hover:after,  
  ic[data-tiptxt]:hover:after,
data-ic [data-tiptxt]:hover:after,
 div[data-tiptxt]:hover:after, 
  a[title]:hover:after, 
img[title]:hover:after, 
 ax[title]:hover:after {
/*
Forgrund Udseende:     */
  content: attr(data-tiptxt);
  font-size:12px;
  font-weight: normal;
  padding: 4px 8px;
  color: #333;
  overflow-wrap: break-word;
  white-space: pre-line;
/*
Placering:   */  
  position: absolute;
  left: 110px;
  top: 50px;
  min-width: 140px;
  max-width: 240px;
  z-index: 5999;
/*
Baggrund Udseende:   */  
  -moz-border-radius:     5px;
  -webkit-border-radius:  5px;
  border-radius:          5px;
  
  -moz-box-shadow:    0px 0px 4px #222;
  -webkit-box-shadow: 0px 0px 4px #222;
  box-shadow:         0px 0px 4px #222;
  
  background-image: -moz-linear-gradient(top, #ffffff, #dddddd);
  background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0, #ffffff),color-stop(1, #dddddd));
  background-image: -webkit-linear-gradient(top, #ffffff, #dddddd);
  background-image: -moz-linear-gradient(top, #ffffff, #dddddd);
  background-image: -ms-linear-gradient(top, #ffffff, #dddddd);
  background-image: -o-linear-gradient(top, #ffffff, #dddddd);
}

  a1[data-tiptxt]:hover:after
  {left: -5px;}  /*  Log ud: Der er ikke plads nok til venstre */
  
/*************************************/
/* Tablesorter: https://github.com/Mottie/tablesorter/issues/1066 */  
.hidden { display: none; }  
  /* Bør flyttes til htm_Tableinit.php som indeholer alt andet... ? */
  
/*************************************/


div#frm *{display:inline}

.divline {
  display: inline-block;
}

::-webkit-input-placeholder { color: var(--grenColr1); font-size: 90%; }
:-moz-placeholder { color: var(--grenColr1); font-size: 90%; } /* Firefox 18- */
::-moz-placeholder { color: var(--grenColr1); font-size: 90%; }  /* Firefox 19+ */
:-ms-input-placeholder { color: var(--grenColr1); font-size: 90%; }

/*************************************/

hr {margin: 8px;  border-width: 2px; margin: 3px; }
hr.style1{  border-top: 1px solid #8c8b8b;}
hr.style2 { border-top: 3px double #8c8b8b;}
hr.style3 { border-top: 1px dashed #8c8b8b;}
hr.style4 { border-top: 1px dotted #8c8b8b;}
hr.style5 { border-top: 2px dashed #8c8b8b;
  background-color: #fff;
}
hr.style6 { border-top: 2px dotted #8c8b8b;
  background-color: #fff;
}
hr.style7 { border-top: 1px solid #8c8b8b;
  border-bottom: 1px solid #fff;
}
hr.style8 { border-top: 1px solid #8c8b8b;
  border-bottom: 1px solid #fff;
}
hr.style8:after { border-top: 1px solid #8c8b8b;
  content: '';
  display: block;
  margin-top: 2px;
  border-bottom: 1px solid #fff;
}
hr.style9 { border-top: 1px dashed #8c8b8b;
  border-bottom: 1px dashed #fff;
}
hr.style10 { border-top: 1px dotted #8c8b8b;
  border-bottom: 1px dotted #fff;
}
hr.style11 {
  height: 6px;
  background: url(https://ibrahimjabbari.com/english/images/hr-11.png) repeat-x 0 0;
    border: 0;
}
hr.style12 {
  height: 6px;
  background: url(https://ibrahimjabbari.com/english/images/hr-12.png) repeat-x 0 0;
    border: 0;
}
hr.style13 {
  height: 10px;
  border: 0;
  box-shadow: 0 10px 10px -10px #8c8b8b inset;
}
hr.style14 { 
  border: 0; 
  height: 1px; 
  background-image: -webkit-linear-gradient(left, var(--tblRowDrk), #8c8b8b, var(--tblRowDrk));
  background-image: -moz-linear-gradient(left, var(--tblRowDrk), #8c8b8b, var(--tblRowDrk));
  background-image: -ms-linear-gradient(left, var(--tblRowDrk), #8c8b8b, var(--tblRowDrk));
  background-image: -o-linear-gradient(left, var(--tblRowDrk), #8c8b8b, var(--tblRowDrk)); 
}
hr.style15 { border-top: 4px double #8c8b8b;
  text-align: center;
}
hr.style15:after {
  content: '\002665';
  display: inline-block;
  position: relative;
  top: -15px;
  padding: 0 10px;
  background: var(--tblRowDrk);
  color: #8c8b8b;
  font-size: 18px;
}
hr.style16 { border-top: 1px dashed #8c8b8b; } 
hr.style16:after { 
  content: '\002702'; 
  display: inline-block; 
  position: relative; 
  top: -12px; 
  left: 40px; 
  padding: 0 3px; 
  background: var(--tblRowDrk); 
  color: #8c8b8b; 
  font-size: 18px; 
}
hr.style17 { border-top: 1px solid #8c8b8b;
  text-align: center;
}
hr.style17:after {
  content: '§';
  display: inline-block;
  position: relative;
  top: -14px;
  padding: 0 10px;
  background: var(--tblRowDrk);
  color: #8c8b8b;
  font-size: 18px;
  -webkit-transform: rotate(60deg);
  -moz-transform: rotate(60deg);
  transform: rotate(60deg);
}
hr.style18 { 
  height: 30px; 
  border-style: solid; 
  border-color: #8c8b8b; 
  border-width: 1px 0 0 0; 
  border-radius: 20px; 
} 
hr.style18:before { 
  display: block; 
  content: ""; 
  height: 30px; 
  margin-top: -31px; 
  border-style: solid; 
  border-color: #8c8b8b; 
  border-width: 0 0 1px 0; 
  border-radius: 20px; 
}



/* http://stackoverflow.com/questions/1964839/how-can-i-create-a-please-wait-loading-animation-using-jquery */
.modalxxx {
    display:    none; /*?*/
    position:   fixed;    z-index:    9999;
    top:        0;        left:       0;
    height:     100%;     width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
          /*       url('http://i.stack.imgur.com/FhHRx.gif') 50% 50% no-repeat; */
}

body.loading {      /* When the body has the loading class, we turn the scrollbar off with overflow:hidden */
    overflow: hidden;   
}

body.loading .modal {/* Anytime the body has the loading class, our modal element will be visible */
    display: block;
}

.loader {
  margin: auto;
  margin-top: 5px;
  width: 32px;
  height: 32px;
  background: url(../_assets/images/wait.gif);
}
.loader:before {
    content: "\f013";
}

#grid{
    background-color: transparent;
    background-image: linear-gradient(0deg, transparent 24%, rgba(255, 255, 255, .05) 25%, rgba(255, 255, 255, .05) 26%, 
                           transparent 27%, transparent 74%, rgba(255, 255, 255, .05) 75%, rgba(255, 255, 255, .05) 76%, transparent 77%, transparent), 
                     linear-gradient(90deg, transparent 24%, rgba(255, 255, 255, .05) 25%, rgba(255, 255, 255, .05) 26%, 
                           transparent 27%, transparent 74%, rgba(255, 255, 255, .05) 75%, rgba(255, 255, 255, .05) 76%, transparent 77%, transparent);
    height:100%;
    background-size: 10mm 10mm;
}

@media print {  /* https://stackoverflow.com/questions/468881/print-div-id-printarea-div-only */
  body * { visibility: hidden;  }
  #section-to-print, #section-to-print * { visibility: visible; }
  #section-to-print { position: absolute; left: 0; top: 0;  }
}


/*  * { padding:0; margin:0; } */
#showinfo { position:absolute; top:150mm; left:-80px; background-color:black; color:white; border-radius: 5px; padding:8px 16px; width:160px; transform: rotate(270deg); font-size: 14px;
  font-family: sans-serif;  text-align: center;
  }
#showkoor { position:absolute; top:141.5mm; left:-48px; background-color:green; color:white; border-radius: 5px; padding:8px 16px; width:160px; transform: rotate(270deg); font-size: 14px;
  font-family: sans-serif;  text-align: center;
  }

/* JQuery: */  
.ui-tooltip {
/*
    padding: 10px 20px;
    color: white;
    border-radius: 20px;
 */
  content: attr(data-tiptxt);
  font: 12px "Helvetica", Sans-Serif;
  padding: 3px 6px;
  background-color: WhiteSmoke;
/* 
    text-transform: uppercase;
    box-shadow: 0 0 7px black;
 */  
  }
  /*
  .tooltip-inner { white-space: pre-line;}
  /*
  .ui-tooltip-content{
  white-space:pre;
  
  }
  */
  
span { display: block; }
/* div {  display: inline-block  !important; }   /*  pga. Fejl: display: none - på alle div! af ukendt årsag ??? */
/* head, title, link[href][rel], meta, style, script { 	display: block; } /**/