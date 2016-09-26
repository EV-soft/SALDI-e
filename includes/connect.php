 
<?php
// ----/includes/connect.php---------------lap 3.1.1-----2011.01.04-----
// LICENS
//
// Dette program er fri software. Du kan gendistribuere det og / eller
// modificere det under betingelserne i GNU General Public License (GPL)
// som er udgivet af The Free Software Foundation; enten i version 2
// af denne licens eller en senere version efter eget valg
//
// Dette program er udgivet med haab om at det vil vaere til gavn,
// men UDEN NOGEN FORM FOR REKLAMATIONSRET ELLER GARANTI. Se
// GNU General Public Licensen for flere detaljer.
//
// En dansk oversaettelse af licensen kan laeses her:
// http://www.fundanemt.com/gpl_da.html
//
// Copyright (c) 2003-2011 DANOSOFT ApS
// ----------------------------------------------------------------------

if (!isset($bg)) $bg='';
if (!isset($title)) $title='';
$db_encode = "UTF8";
$db_type = "mysql";

if (file_exists("../includes/db_func.php")) {
	include("../includes/db_func.php");
	include("../includes/version.php");
	include("../includes/settings.php");
}
elseif (file_exists("../../includes/db_func.php")){
	include("../../includes/db_func.php");
	include("../../includes/version.php");
	include("../../includes/settings.php");
} 
global $exec_path;

$sqhost = "localhost";
$squser	= "root";
$sqpass = "herkules";
$sqdb = "saldi";
define("SERVEREXEC", '/opt/bin');					# EV-soft		Global Initieringsværdi for @exec_path Standard: "/usr/bin"		Synology DSM: SERVEREXEC
$exec_path = SERVEREXEC;

#$login = "";
#$login = "dropdown";
$login = "cookie";

# $brug_timestamp="y";

$font = "<font face='Arial, Helvetica, sans-serif'>";

$connection = db_connect ("$sqhost", "$squser", "$sqpass");
if (!isset($connection)) die( "Unable to connect to database");
elseif (!mysql_select_db("$sqdb")) die( "Unable to connect to MySQL");
else mysql_query("SET storage_engine=INNODB");

?>
