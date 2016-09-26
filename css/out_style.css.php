<?php $DocFil= '../css/out_style.css';	 	$DocVer='5.0.0';		 $DocRev='2016-08-00';		 	$modulnr=0;
			header("Content-type: text/css"); 
?>
/*	
//						 ___   _   _    ___  _	       
//						/ __| /_\ | |  |   \| |   ___ 
//						\__ \/ _ \| |__| |) | |__/ -_)
//						|___/_/ \_|____|___/|_|  \___|
//						                               
// Design af out_* elementers udseende.
//
// CSS-Layout af checkbox,textarea,input,label samt submit :
//
// Filer skal gemmes i UTF-8 format uden BOM!
// 2016.08.00 ev - EV-soft

<?php 
	global $PanelBgrd;
	if ($PanelBgrd== '#D4FFFF')	{$PanelBgrd= '#FFFFD4'; }	# Æggeskal
	else												{$PanelBgrd= '#D4FFFF';}	# Turkis
	$PanelBgrd= '#FFFFD4'; 		#							 '#F9F8F8';		# Lysgrå
?>
/* PHP:
highlight.comment	#FF8000	Orange
highlight.default	#0000BB	Blue
highlight.html		#000000	Black
highlight.keyword	#007700	Green
highlight.string	#DD0000 Red
*/

/* Farvepalette: (For at justere benyttede nuancer centralt) */
:root{
    --roedColor: #FF0000;   /* Statiske farvenuancer	  */
		--guulColor: #F3F033;
		--grenColor: #336600;
		--grenColr1: #88DD00;
		--blueColor: #4479ff;
		--oranColor: #F37033;
		--brunColor: #550000;
		--grayColor: #ACA9A8;
		--xx11Color: #3CBC8D;
		--xx22Color: #E6EEF7;		/* 	Tip: Blå baggrund */
		--grColrLgt: #CCCCCC;
		--Saldiblue: #003366;
/* 		--PanelBgrd: #FFFFC4;		/* Panelers baggrund	(æggeskalsfarve)*/
/*		--PanelBgrd: #D4FFFF;		/* Panelers baggrund	(turkis)*/
		--PanelBgrd: <?=$PanelBgrd?>;
		--PageBcgrd: #888888;   /* Side baggrund (mørkgrå)	*/
		--fltBgColr: #FFFFFF;   /* Validerede input felters baggrund	#53a40 */
		--fltTxColr: #550000;   /* Validerede input felters tekster	#53a40 */
		--tblRowDrk: #f0f0f0;   /* Tabellinie med mørk baggrund	*/
		--tblRowLgt: #f8f8f8;   /* Tabellinie med lys baggrund	*/
		
		/* Herudover forekommer green, blue, white, black og grånuancer, samt "importerede".  */
		/* Således kaldes farvekonstanter:		var(--grColrLgt) */
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
  margin: 5px 5px;
  width: 100%;
  max-width: 1200px;
	font-size: 15px;
	line-height: 100%;
	background: var(--PageBcgrd);
}

.center-div
{
  margin: 0 auto;
  width: 1000px;
  height: 1000px;
  background-color: var(--grColrLgt);
  border-radius: 3px;
}

/* for 960px or greater */
@media screen and (min-width: 960px) {
#wrapper	{width: 1030px;	padding: 0px;			margin: 5px 5px;}
#spalte1 	{width: 320px;	padding: 5px 5px;	float: left}
/* #spalte2 	{width: 320px;	padding: 5px 5px;	float: left;	margin: 0px 5px 5px 5px;} */
#spaltex 	{width: 320px;	padding: 5px 5px;	float: left;}
PanlHead	{clear: both;		padding: 0 5px;}
PanlFoot	{clear: both;		padding: 0 5px;}
}

/* for 960px or less */
@media screen and (max-width: 960px) {
	#wrapper	{width: 99%;	}
  #spalte1	{width: 41%;	padding: 5px 5px;		margin: 0px 0px 5px 5px;}
/* 	#spalte2	{width: 41%;	padding: 5px 5px;		margin: 0px 0px 5px 5px;	float: right;	} */
	#spaltex	{width: auto;	padding: 5px 5px;		clear: both;							float: none;	}
	PanlHead, PanlFoot {clear: both;			padding: 1px 5px;	}
}
	
/* for 600px or less */
@media screen and (max-width: 640px) {
	#spalte1 {width: auto;	float: none;		margin-left: 5px;	}
/* 	#spalte2 {width: auto;	float: none;		margin-left: 5px;	} */
	#spaltex {width: auto;	float: none;	}
}

/* for 480px or less */
@media screen and (max-width: 480px) {
	PanlHead {height: auto;	}
	h1 		{font-size: 2em;	}
}

/*************************************/

.panelWmax, .panelW960, .panelW640, .panelW320 {
    border: 1px solid black;
    background: var(--PanelBgrd);
		border-radius: 0.40em;
		margin: 0.4em 0.2em;
		padding: 0.3em 0.5%;
}
.panelWmax { width: 100%;		}
.panelW960 { width: 960px;	}
.panelW640 { width: 640px;	}
.panelW320 { width: 320px;	}
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

.lablInput {
  height: 2.2em;
  margin: 0.1em 0.2em;
  position: relative;
  /* width: 100%; */
}

.lablInput checkbox,
.lablInput textarea,
.lablInput input {
  border: 1px solid var(--grColrLgt);	/* border-width, border-style, and border-color */
  border-radius: 0.20em;
	background: white;
	margin: 0.0em 0.0em;
/* 	width: 200px; */
  cursor: text;
  font-size: 0.95em;
	font-weight: 550;
  padding: 0.8em 1% 0.1em 1%;	/*	top	right	bottom	left	*/
  position: absolute;
  transition: all 0.15s ease;
  width: 98%;
	height: 95%;
}

.lablInput label {
  color: var(--grayColor);
  padding: 0.2em 1%;
  cursor: text;
  font-size: 0.95em;
	font-weight: 550;
  padding: 0.8em 1% 0.1em 1%;	/*	top	right	bottom	left	*/
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
  font-size: 0.7em;
  font-weight: 400;
  text-align: right;
	position: absolute;
	width: 98%;
  color: var(--blueColor);	/* LysBlå */
	padding: 0.005em 0%;
}

.lablInput checkbox.filled,
.lablInput textarea.filled,
.lablInput input[type="date"].filled,
.lablInput input[type="text"].filled,
.lablInput input[type="email"].filled:valid {
  font-weight: 500;
  background: var(--fltBgColr);	/* FeltFarve	*/
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
  font: normal normal normal 14px/1;	/* 	font-style 	font-variant 	font-weight 	font-size/line-height	font-family */
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
  font-size: 1.0em;
/* 	display: table; */
	color: white;			/* Tekst farve */
	text-align: center;
  margin: 0.25em 2% 0.05em 1%;	/*	top	right	bottom	left	*/
	padding: 0.25em 0.25em 0.02em 0.25em;
  transition: all 0.15s ease;
}

input[type="submit"]:hover {
  background: var(--guulColor) ;
	color: black;			/* Tekst farve */
	/* border-width: 0 0 0.1em; */
  /* margin-top: 0.05em; */
}

input[type="submit"]:active {
  border-width: 0 0 0em;
  margin-top: 0.15em;
}

.fa-paragraph:before { font-weight: bold;	content: '§'; }

.styled-select select {
   background: transparent;
   width: 200px;
   padding: 5px;
   font-size: 16px;
   line-height: 1;
   border: 0;
   border-radius: 0;
   height: 34px;
   -webkit-appearance: none;
}
bluelabl 	{ font-style: italic;	font-weight: normal; font-size: 0.90em;	color: blue;}
a 				{ text-decoration: none;}
i 				{ text-decoration: none;} 
test 			{	display: inline;}
big 			{ font-size: larger;}
.centrer	{ text-align: center }
cbutton		{ margin:auto;  display:block;}

menuBg {
  margin: 0.04em 0.10em;
	display: inline-block;
	/*   width: 300px;  or just set a width */
	position: relative;  
}

.btnTit {
  font-size: 0.95em;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: black;
  padding: .5em 1em;  
  border: none;  
  border-radius: 4px;
  letter-spacing: 0em;
  font-weight: 600;
}

.btn {
  font-size: 0.85em;
  position: absolute;
  top: 43%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: black;
  padding: .01em;  
  border: none;  
  border-radius: 4px;
  letter-spacing: 0em;
  font-weight: 300;
}

/*************************************/

.titletip,
.tooltip , .tooltipR
{
    position: relative;
    display: inline-block;
		background: white;
    border-radius:4px;
    box-shadow: 1px 1px 2px #BBB;
		border-bottom: 1px dotted gray;
		padding: 0px 5px 0px 5px;
}

.mytip {
    content: attr(titletip);
		display: inline;
}

.mytip,
.tooltip .tooltiptext, 
.tooltipL, .tooltipR, .tooltipB, .tooltipT 
{
    visibility: hidden;
    min-width: 80px;
    min-width: 160px;
    background-color: var(--xx22Color);
    color: #111;
		font-style:normal;
    font-weight:400;
    font-size: 12px;
    text-align: center;
    border-radius: 6px;
		border: 1px solid #555555;
    padding: 5px 0;
 /* Position the tooltip: */
    position: absolute;
		bottom: 30px;    /* top: -70px; */
    left: -25px;  	 /* right: -30%; */
    z-index: 1;
}

/* .tooltip	{top: -5px;    	left: 105%;} */
.tooltipL	{left: -226px;	margin-top: -28px;}
.tooltipB	{top: 30px;			left: -183px;}
.tooltipR	{right: -226px;	margin-top: -28px;}
.tooltipT	{bottom:26px;		left: -186px;}

.mytip:hover .tooltiptext,
.tooltip:hover .tooltiptext
{
    box-shadow: 3px 3px 5px var(--grColrLgt);
		transition-delay: 0.1s;
		visibility: visible;
}

x-a 			{ color: #900; text-decoration: none;}
x-a:hover { color: red;  position: relative;}
x-a[title]:hover:after {
  content: attr(title);
  padding: 4px 8px;
  color: #333;
  position: absolute;
  left: 0;
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
.fixed-table-container {
	width: 99%;
	table-layout: fixed;
	border: 1px solid black;
	margin: 10px auto;
	background-color: white;
	font-size: 0.8em;	/* 1.0em;	  12px; */
	/* above is decorative or flexible */
	position: relative; /* could be absolute or relative */
	padding-top: 26px; /* header-height */
}

.fixed-table-container-inner {
	overflow-x: hidden;
	overflow-y: auto;
	max-height: 200px;
}

.header-background {
	background-color: #DDDDDD;
	height: 26px; /* header-height */
	position: absolute;
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
  background: 			var(--tblRowDrk);
	background-color: var(--tblRowDrk);
}
.row:nth-of-type(odd) {
  background: var(--tblRowLgt);
	background-color: var(--tblRowLgt);
} 
.fixed-table-container td {
	border-left: 1px dotted #343434;
	padding-left: 6px;
}
tc {
	font-weight:400;
  color: green;
}
th {
	color: var(--blueColor);	/* LysBlå */
}
	
.th-inner {
	position: absolute;
	top: 0;
	line-height: 26px; /* header-height */
	text-align: left;
	border-left: 1px solid black;
	padding-left: 5px;
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

hr.style1{	border-top: 1px solid #8c8b8b;}
hr.style2 {	border-top: 3px double #8c8b8b;}
hr.style3 {	border-top: 1px dashed #8c8b8b;}
hr.style4 {	border-top: 1px dotted #8c8b8b;}
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
	background: url(http://ibrahimjabbari.com/english/images/hr-11.png) repeat-x 0 0;
    border: 0;
}
hr.style12 {
	height: 6px;
	background: url(http://ibrahimjabbari.com/english/images/hr-12.png) repeat-x 0 0;
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
.my-notify-info:before 		{ content:"\f05a";}
.my-notify-success:before { content:'\f00c';}
.my-notify-warning:before { content:'\f071';}
.my-notify-error:before 	{ content:'\f057';}
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