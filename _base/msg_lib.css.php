<?php $DocFil= '../_base/msg_lib.css.php';    $DocVer='5.0.0';     $DocRev='2018-07-00';      $DocIni='evs';  $ModulNr=0;   header("Content-type: text/css"); 
/* ## Purpose: 'CSS-regelsaet for modal besked system i function msg_besked()';*/
?>
/*             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2018 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
 *
 * Filer skal gemmes i UTF-8 format uden BOM!
 * 
  Oprettet: 2018-06-00 evs - EV-soft    #: Dette bibliotek er udviklet 2016-1018 af EV-soft.
  Ændrings-Log:
      
 *
 */


*, *:before, *:after {
	box-sizing: border-box;
}

.modlButt {
	display: inline-block;
	padding: 2px 8px;
  margin: 0 6px;
	color: white;
	background: gray;
	transition: background 1150ms ease-out;
	border-radius: 5px;
	cursor: pointer;
}

.modlButt:hover, .modlButt:active {
	background: #ff7960;
	transition: background 1250ms ease-out;
}

.modal {
	position: fixed;
	z-index: 20;
	max-width: 85%;
	width: 30%; /* 400px; */
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	margin: 0 auto;
  box-shadow: 0px 0px 0.4em white; 
  border-radius: 0.4em;
	opacity: 1;
	transition: margin-top 150ms ease-out,  opacity 150ms ease-out;
	background: #eee;
	box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.6);
}

@media screen and (max-height: 500px) {
	.modal {
		width: 80%;
		height: 80vh;
	}
}

.modal__toggler {
	display: none;
}

.modal__toggler:not(:checked) ~ .modal {
	position: absolute;
	overflow: hidden;
	clip: rect(0 0 0 0);
	opacity: 0;
	height: 1px;
	width: 1px;
	margin: -1px;
	padding: 0;
	border: 0;
	margin-top: -10px;
}

.modal__toggler:not(:checked) ~ .modal__mask {
	position: absolute;
	overflow: hidden;
	clip: rect(0 0 0 0);
	opacity: 0;
	height: 1px;
	width: 1px;
	margin: -1px;
	padding: 0;
	border: 0;
}

.modal__mask {
	position: fixed;
	height: 100%;
	width: 100%;
	top: 0;
	left: 0;
	opacity: 1;
	transition: opacity 150ms ease-out;
	background: RGBA(0, 0, 0, 0.7);
	cursor: pointer;
}

.modal__close::after {
	content: "\2715";
	position: absolute;
	display: inline-block;
	top: 5px;
	right: 5px;
	padding: 5px;
	font-size: 15px;
	font-weight: bold;
	cursor: pointer;
}

.modal__title {
	margin: 0;
}

.modal__header {
	padding: 2px 15px 1px;
  border-radius: 0.4em 0.4em 0 0;
	font-size: 15px;
}

.modal__content {
	padding: 5px 20px;
	/* max-height: 30%; */
	max-height: 60vh;
  overflow-y: auto;
  float: left;
}

@media screen and (max-height: 500px) {
	.modal__content {
    max-height: 45vh;
	}
}

.modlwrap {
  min-height: 100%;
  position:relative;
  background-color: white;
}
.modlwrap:after {
  content: "";
  display: block;
}

.modal__footer {
	padding: 10px 16px;
  border-radius: 0 0 0.4em 0.4em;
	text-align: center;
  background-color: #AAAAAA;
  display:table;
  width: 100%;
}

.modal__window {
	max-height: 80vh;
	overflow-y: auto;
	background: #eee;
}

.demo-button {
	position: absolute;
	left: 50%;
	top: 50%;
	transform: translate(-50%, -50%);
}
