<?php $DocFil= '../_base/out_style.css.php';    $DocVer='5.0.0';     $DocRev='2017-02-00';      $modulnr=0;
  header("Content-type: text/css"); 
  if ($GLOBALS["Ødebug"]) debug_log($DocVer,$DocRev,$DocFil,'','');
?>
/* ## Formål: Design af out_* elementers udseende.
 *             ___   _   _    ___  _         
 *            / __| / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            |___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 * Design af out_* elementers udseende.
 *
 * CSS-Layout af checkbox,textarea,input,label samt submit :
 *
 * Filer skal gemmes i UTF-8 format uden BOM!
 * 2016.08.00 ev - EV-soft
 */
<?php 
  global $ØPanelBgrd;
  if ($ØPanelBgrd== '#D4FFFF')  {$ØPanelBgrd= '#FFFFD4';}  # Æggeskal
  else                          {$ØPanelBgrd= '#D4FFFF';}  # Turkis
    $ØPanelBgrd= '#FFFFD4';    #              '#F9F8F8';   # Lysgrå
  $ØPanelBgrd= '#EFEFEF';      #              '#FFFFFF';   # Hvid
?>
/* PHP:
highlight.comment #FF8000 Orange
highlight.default #0000BB Blue
highlight.html    #000000 Black
highlight.keyword #007700 Green
highlight.string  #DD0000 Red
*/

/* FARVEPALETTE: (Central justering af benyttede nuancer) */
:root{
    --roedColor: #FF0000;   /* Statiske farvenuancer    */
    --guulColor: #F3F033;
    --grenColor: #336600; 
    --grenColr1: #88DD00;
    --blueColor: #4479ff;
    --oranColor: #F37033;
    --brunColor: #550000;   /*  Tabel kanter  */
    --grayColor: #ACA9A8;
    --xx11Color: #3CBC8D;
/*  --HintsBgrd: #FCFCCC;   /*  Tip: #FCFCCC-Gul baggrund, #E6EEF7-Blå baggrund */
    --HintsBgrd: rgba(248, 248, 248, 1.0); /* Ingen transparens!    #FCFCCC;   /*  Tip: #FCFCCC-Gul baggrund, #E6EEF7-Blå baggrund */
    --xx33Color: #CCEDFE;   /*  Filter: Lys-Blå baggrund */
    --grColrLgt: #CCCCCC;
    --Saldiblue: #003366;
    --GradieTop: #eeeeee; 
    --GradiBott: #cccccc;
/*  --PanelBgrd: #FFFFC4;   /* Panelers baggrund  (æggeskalsfarve)*/
/*  --PanelBgrd: #D4FFFF;   /* Panelers baggrund  (turkis)  */
    --PanelBgrd: #FFFFFF;   /* Panelers baggrund  (hvid)    */
    --PanelBgrd: <?=$ØPanelBgrd?>;  /* Initieres i ../_base/_base_init.php */
    --TapetBgrd: #44BB44;   /* Tapet baggrund  (æggeskalsfarve)    */
    --ButtnBgrd: #44BB44;   /* LysGrøn   */
    --ButtnText: #FFFFFF;   /* Hvid   */
    --BtLnkBgrd: #FCFCCC;   /* LysGul   */
    --BtLnkText: #000000;   /* Sort   */
    --ButtnShad: #DDDDDD;   /* Knap skygge (lysgrå)  */
    --PageBcgrd: #333333;   /* Side baggrund (lysblå) F4FFF4  */
    --PageBcgrd: <?=$ØPageBcgrd?>;  /* Initieres i ../_base/_base_init.php */
    --PageImage: url(../_assets/images/paper_fibers.png);   /* Side baggrundsbillede  */
    /* url understøttes ikke i browsere endnu! (March 29, 2016) https://blog.hospodarets.com/css_properties_in_depth  Images url like url(var(--image-url)) don’t work */
    --PageImage: <?=$$ØPageImage?>;  /* Initieres i _base_init.php /Virker i ../_base/htm_pageHead.php */
    --PageFile: paper_fibers.png;
 /*   --PageImage: '../_assets/images/paper_fibers.png';   /* Side baggrundsbillede  */
    --fltBgColr: #FFFFFF;   /* Validerede input felters baggrund  #53a40 */
    --fltTxColr: #550000;   /* Validerede input felters tekster #53a40 */
    --tblRowDrk: #e0e0e0;   /* Tabellinie med mørk baggrund */
    --tblRowLgt: #f0f0f0;   /* Tabellinie med lys baggrund  */
    --btnTxNorm: #000000;   /* Standard tekst på knap */
    --btnTxOver: #900000;   /* Tekst på knap, når musen er over knappen */
    
    /* Herudover forekommer green, blue, white, black og grånuancer, samt "importerede".  */
    /* Således kaldes farvekonstanter:    var(--GradiBott) */
}


div#container
{
   width: 970px;
   position: relative;
   margin: 0 auto 0 auto;
   text-align: left;
}
body {
  font-family: sans-serif;
 /*  margin: 5px 5px; */
  margin: 0 auto 0 auto;
  width: 100%;
  max-width: 1200px;
  font-size: 15px;
  line-height: 100%;
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
  #wrapper   {width: 1030px; padding: 0px;    /*  margin: 5px 5px; */}
  #spalt240  {width: 240px;  padding: 5px 5px; margin: 5px 5px 5px 0px; float: left}
  #spalt320  {width: 320px;  padding: 5px 5px; margin: 5px 5px 5px 0px; float: left}
  #spalt480  {width: 480px;  padding: 5px 5px; margin: 5px 5px 5px 0px; float: left}
  #spalt700  {width: 700px;  padding: 5px 5px; margin: 5px 5px 5px 0px; float: left}
  #spaltxxx  {width: auto;   padding: 5px 0px 5px 5px; margin: 5px 0px 5px 0px; float: left;}
  PanlHead, PanlFoot  {clear: both;   padding: 0 5px;}
}

/* for 960px or less */
@media screen and (max-width: 960px) {
  #wrapper   {width: 99%;  }
  #spalt320  {width: 41%;  padding: 5px 5px;   margin: 0px 0px 5px 5px;}
  #spaltxxx  {width: auto; padding: 5px 5px;   margin-left: 0px;   clear: both;    float: none;  }
  PanlHead, PanlFoot {padding: 1px 5px;   clear: both;}
}
  
/* for 600px or less */
@media screen and (max-width: 640px) {
  #spalt320 {width: auto;  float: none;  margin-left: 5px; }
  #spaltxxx {width: auto;  float: none;  margin-left: 5px; }
}

/* for 480px or less */
@media screen and (max-width: 480px) {
  PanlHead {height: auto; }
  h1    {font-size: 2em;  }
}

@media screen and (max-width: 1280px) { @viewport { width: 1280px; } }

/*************************************/

/* PANELER: (i forskellige bredder) */
.panelWmax, .panelWaut, .panelW110, .panelW960, .panelW640, .panelW480, .panelW320, .panelW240, .panelW160 {
    border: 1px solid gray;
    background: var(--PanelBgrd);
    box-shadow: 3px 3px 5px var(--ButtnShad);
    border-radius: 0.40em;
    margin: 0.4em 0.2em 0.4em 0.2em;
    padding: 0.3em 0.3em 0.3em 0.3em;
}
.panelWmax { /* width: 100%; */   }
.panelWaut { width: auto;   }
.panelW110 { width: 1100px; }
.panelW960 { width: 960px;  }
.panelW640 { width: 640px;  }
.panelW480 { width: 480px;  }
.panelW320 { width: 320px;  }
.panelW240 { width: 240px;  }
.panelW160 { width: 160px;  }
.panelTitl {
  font-size: 1.1em;
  font-weight: 600;
  height: 1.4em;
  margin: 0.0em 0.4em;
  padding: 0.1em 0.5% 0.3em;
  position: relative;
  width: 100%;
  text-align: center;
}

.tapetWmax {
    border: 3 solid gray;
    background: var(--TapetBgrd);
    box-shadow: 3px 3px 5px var(--ButtnShad);
    border-radius: 0.40em;
    margin: 0.4em 0.2em 0.4em 0.2em;
    padding: 0.3em 0.3em 0.3em 0.3em;
}
.tapetWmax { width: 100%;   }


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
  padding: 0.8em 1% 0.1em 1%; /*  top right bottom  left  */
  position: absolute;
  transition: all 0.15s ease;
  /* width: 95%; */
}

.label {
  font-style: italic; 
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
  font: normal normal normal 14px/1;  /*  font-style  font-variant  font-weight   font-size/line-height font-family */
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

/* 
Default:
input[type="date"] {
     -webkit-align-items: center;
     display: -webkit-inline-flex;
     font-family: monospace;
     overflow: hidden;
     padding: 0;
     -webkit-padding-start: 1px;
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

input[type="date"] {
  text-align: left;
::-webkit-inner-spin-button { display: none; }
::-webkit-calendar-picker-indicator { background: orange; }
  ::-webkit-inner-spin-button { display: none; }
  width: 90px;
}
 */
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
colrlabl  { font-style: italic; font-weight: normal; font-size: 0.90em; color: blue;}
a         { text-decoration: none;}
i         { text-decoration: none;} 
test      { display: inline;}
big       { font-size: larger;}
.centrer  { text-align: center }
cbutton   { margin:auto;  display:block;}

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
.btnTit {
/*   content: attr(title); */
  font-size: 0.95em;
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
.btn:hover { color: var(--btnTxOver); }
.btn {
  font-size: 0.85em;
  position: absolute;
  top: 43%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: var(--btnTxNorm);
  margin-top: 3;
/*   max-width: 160px; */
  padding: .001em;  
  border: none;  
  border-radius: 4px;
  letter-spacing: 0em;
  font-weight: 300;
}

Deaktiv_input[type="submit"][title],

.btn[tip]:hover:after { /* Tip på grå gradient baggrund*/
  content: attr(tip);
  white-space: pre-wrap;
  min-width: 160px;
  padding: 4px 8px;
  color: #333;
  position: absolute;
  bottom: 25px;    /* top: -70px; */
  left: -25px;     /* right: -30%; */
  z-index: 9999;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  border-radius: 5px;
  -moz-box-shadow: 0px 0px 4px #222;
  -webkit-box-shadow: 0px 0px 4px #222;
  box-shadow: 0px 0px 4px #222;
  background-image: -moz-linear-gradient(top, #ffffff, #cccccc);
  background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0, #ffffff),color-stop(1, #cccccc));
  background-image: -webkit-linear-gradient(top, #ffffff, #cccccc);
  background-image: -moz-linear-gradient(top, #ffffff, #cccccc);
  background-image: -ms-linear-gradient(top, #ffffff, #cccccc);
  background-image: -o-linear-gradient(top, #ffffff, #cccccc);
}

button {
  background-color: var(--ButtnBgrd);
  color: var(--ButtnText);
  border-radius: 6px;
  transition-duration: 0.4s;
/*   min-width: 60px; */
  
  }
.knap {
  margin:6px; 
  padding:4px; 
  font-size:0.80em; 
  font-weight: 700; 
  /* color:'.$color=$ØTitleColr.'; */
}

.fieldset-auto-width {
  display: inline-block;
}

/*************************************/
/* 
Tip-system:  Label [.tooltip .labltip], som kan vise popup-vindue [.tooltip*] med teksten [.tooltiptext] på lysfarvet shape-baggrund, når musen holdes over label
*/

.titletip,
.tooltip,
.tooltipL, .tooltipR, .tooltipB, .tooltipT,
.tooltipB1, .tooltipB2
{   position: relative;
    display: inline-block;
    background: white;
    border-radius:3px;
    border: 1px solid var(--GradiBott);
    box-shadow: 2px 2px 1px var(--ButtnShad);
    padding: 0px 3px 1px 3px;
    margin-bottom: 6px;
}

.mytip 
{   content: attr(titletip);
    display: inline;
}

.mytip,
/* .tooltip                                 /* LABEL som musen holdes over */
.tooltiptext,                               /* Hjælpetekst som synliggøres */
.tooltipL, .tooltipR, .tooltipB, .tooltipT, /* Bestemmer placering af Tip  */
.tooltipB1, .tooltipB2
{ /* Skjult tip tekst på blå baggrund plac ved label */
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
    z-index: 1;
}

.tooltiptext,
.tooltipT  {bottom: 20px;  left: -25px;}                    /* Plac over kilde - Inputfelters label */
.tooltipB  {top: 22px;     left: -75px; min-width: 120px;}  /* Plac under kilde - Kolonneoverskrifter, hvor der ikke er plads ovenover. */
.tooltipB1 {top: 22px;     left: 0px;   min-width: 160px;}  /* Ved 1. kolonne er der ikke plads tv for feltet*/
.tooltipB2 {top: 22px;     left: 28px;  min-width: 160px;}  /* Ved n. kolonne er der ikke plads th for feltet*/
.tooltipL  {left: -26px;   margin-top: -28px;}
.tooltipR  {right: -26px;  margin-top: -28px;}

.mytip:hover .tooltiptext,
/* .tooltipL:hover .tooltiptext,
.tooltipR:hover .tooltiptext,
.tooltipT:hover .tooltiptext, */
.tooltip:hover .tooltipT,
.tooltip:hover .tooltipB,
.tooltip:hover .tooltipB1,
.tooltip:hover .tooltipB2,
.tooltip:hover .tooltipL,
.tooltip:hover .tooltipR,
.tooltip:hover .tooltiptext,
.tooltiptext:hover
{ /* Vis tip tekst */
  box-shadow: 3px 3px 5px var(--grColrLgt);
  transition-delay: 0.2s;
  background-color: var(--HintsBgrd);
  /* opacity: 0.99; */
  visibility: visible;
}

ax        { color: var(--btnTxNorm); text-decoration: none;}
ax:hover  { color: var(--btnTxOver); }
ax[title]:hover:after {
  content: attr(title);
  padding: 4px 8px;
  color: #333;
  position: absolute;
  left: -25px;
  top: 100%;
  white-space: nowrap;
  z-index: 20px;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  border-radius: 5px;
  -moz-box-shadow: 0px 0px 4px #222;
  -webkit-box-shadow: 0px 0px 4px #222;
  box-shadow: 0px 0px 4px #222;
  background-image: -moz-linear-gradient(top, #eeeeee, #cccccc);
  background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0, #eeeeee),color-stop(1, #cccccc));
  background-image: -webkit-linear-gradient(top, #eeeeee, #cccccc);
  background-image: -moz-linear-gradient(top, #eeeeee, #cccccc);
  background-image: -ms-linear-gradient(top, #eeeeee, #cccccc);
  background-image: -o-linear-gradient(top, #eeeeee, #cccccc);
}

/*************************************/

/* Tabel med Fastlåst Header: */
/* Se mere: https://codepen.io/chiranjeeb/pen/LGsiv */
.fixed-table-container {
  width: 99%;
  table-layout: fixed;
  border: 1px solid #8c8b8b;
  margin: 10px auto;
  background-color: white;
  font-size: 0.8em; /* 1.0em;   12px; */
  /* above is decorative or flexible */
  position: relative; /* could be absolute or relative */
  padding-top: 26px; /* header-height */
}

.fixed-table-container-inner {
  overflow-x: hidden;
  overflow-y: auto;
 /*  max-height: 150px; */
}

.header-background {
  background-color: #DDDDDD;
  height: 26px; /* header-height */
  /* position: absolute; */
  top: 0;
  right: 0;
  left: 0;
}

table {
  background-color: var(--PanelBgrd);
  width: 100%;
  overflow-x: hidden;
  overflow-y: auto;
  font-size: 1.1em; 
  font-weight: 200;
}

.row {
  display: table-row;
  background:       var(--tblRowDrk);
  background-color: var(--tblRowDrk);
}
.row:nth-of-type(odd) {
  background: var(--tblRowLgt);
  background-color: var(--tblRowLgt);
} 
.fixed-table-container td {
  border-left: 1px dotted #2223;
  padding-left: 2px;
}
tc {
  font-size: 0.8em; 
  font-weight:400;
  color: var(--btnTxOver);
}
th {
  color: var(--blueColor);  /* LysBlå text*/
}
  
.th-inner {
  position: absolute;
  top: 0;
  line-height: 26px; /* header-height */
  text-align: left;
  border-left: 1px solid #ccc;
  padding-left: 2px;
  margin-left: -1px;
}
.th-inner-center{
  text-align: center;
}

div#frm *{display:inline}

.divline {
  display: inline-block;
}

::-webkit-input-placeholder { color: var(--grenColr1); font-size: 90%; }
:-moz-placeholder { color: var(--grenColr1); font-size: 90%; } /* Firefox 18- */
::-moz-placeholder { color: var(--grenColr1); font-size: 90%; }  /* Firefox 19+ */
:-ms-input-placeholder { color: var(--grenColr1); font-size: 90%; }

/*************************************/

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



/****************** Error, Success, Warning, and Info Messages with CSS *******************/

/**@import url('//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'); **/
.my-notify-info, .my-notify-success, .my-notify-warning, .my-notify-error {
    padding:10px;
    margin:10px 0;
}
.my-notify-info:before, .my-notify-success:before, .my-notify-warning:before, .my-notify-error:before {
    font-family:FontAwesome;
    font-style:normal;
    font-weight:400;
    speak:none;
    display:inline-block;
    text-decoration:inherit;
    width:1em;
    margin-right:.2em;
    text-align:center;
    font-variant:normal;
    text-transform:none;
    line-height:1em;
    margin-left:.2em;
    -webkit-font-smoothing:antialiased;
    -moz-osx-font-smoothing:grayscale
}
.my-notify-info:before    { content:"\f05a";}
.my-notify-success:before { content:'\f00c';}
.my-notify-warning:before { content:'\f071';}
.my-notify-error:before   { content:'\f057';}
.my-notify-info {
    color: #00529B;
    background-color: #BDE5F8;
}
.my-notify-success {
    color: #4F8A10;
    background-color: #DFF2BF;
}
.my-notify-warning {
    color: #9F6000;
    background-color: #FEEFB3;
}
.my-notify-error {
    color: #D8000C;
    background-color: #FFBABA;
}

/* http://stackoverflow.com/questions/1964839/how-can-i-create-a-please-wait-loading-animation-using-jquery */
.modal {
    display:    none;
    position:   fixed;    z-index:    1000;
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
