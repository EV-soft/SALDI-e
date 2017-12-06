 <?php   $DocFil= '../_config/connect.php';   $DocVer='5.0.0';     $DocRev='2017-12-00';    $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Opkobling til saldi programmets Database';
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS      *** Se filen: ../LICENS_Copyright.txt
 *
 * 2016.08.00 evs - EV-soft
 *
 * ----------------------------------------------------------------------
 */
//  include '../../_base/out_base.php';  #+  Grundmoduler, nødvendige for rude-systemet!   
if (!isset($bg)) $bg= '';
if (!isset($title)) $title= tolk('@Forbindelse til Database');
$font= '<font face="Arial, Helvetica, sans-serif">';

if (!function_exists('msg_Dialog')) {include_once('../../_base/msg_lib.php');};

if (file_exists('../_base/dbi_func.php')) {
  include '../_base/dbi_func.php';
  include '../_base/version.php';
  include '../_base/out_init.php';  //  include('../includes/settings.php');
//  msg_Succ($title='Hurra', $messg='includes er indlæst.');
#  include('../_base/msg_lib.php');
} else {msg_Error($title=tolk('@Fejl'), $messg=tolk('@dbi_func.php kan ikke indlæses!'));};


global $Ødb_Encode, $Ødb_Type, $Øsqdb, $Øconnection, $Ødb_Link, $Ødb_Problem;

// Global use (dbi_func.php, ):
$Ødb_Encode= 'UTF8'; 
$Ødb_Type= strtolower('MySQL');
$login= 'cookie';

$sqhost= 'localhost';
$squser= 'root';
$sqpass= 'geheimdb';
$Øsqdb = 'saldi_prog';

$Ødb_Link= dbi_connect($sqhost, $squser, $sqpass, $Øsqdb); // dbi_* funktioner universelle for postgres og mysql . Erstatter mysqli_connect:
//  if (!$Ødb_Link) $Ødb_Link='SkjulFejl';
if (!$Ødb_Link) {
#    var_dump($Ødb_Link);
#    echo "Error: Unable to connect to MySQL." . PHP_EOL;
#    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
#    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    $spor.= str_Ihead('Function:').'dbi_connect()'.str_Ihead('File:'). __FILE__ .str_Ihead('Line:'). __LINE__.str_Ihead('Info:').'[!$Ødb_Link]';
      msg_Dialog('error', tolk('@Retur'),'window.history.back();', '', '', '', '', 
            tolk('@Database tilkobling'), tolk('@STOP ! - fordi oprettelse af link til databasen mislykkes!').str_nl(2).str_hr().$spor);
}
//  else var_dump($Ødb_Link);
    
#+  $Øconnection= mysqli_connect($sqhost, $squser, $sqpass, $Øsqdb);
//  Warning: mysqli_connect() [function.mysqli-connect]: (HY000/2002): No such file or directory in /var/www/advokatfirmaet-viuff.dk/saldi-e/_config/connect.php on line 52
# $spor= 'Sted: '. __FILE__ .' &nbsp; Line: '. __LINE__.' <br>[$Øconnection==false]';
# if (!$Øconnection) msg_Dialog('error', tolk('@Retur'),'window.history.back();', '', '', '', '', tolk('@Database tilkobling'), 
#            tolk('@Afbryder! - fordi der ikke kan oprettes forbindelse til databasen!').'<br><br>'.'File: '. __FILE__ .' &nbsp; Line: '. __LINE__);

#+  if (!isset($Øconnection)) die(tolk('@Unable to connect to database:').' >'.$Øsqdb.'< '.mysql_error());
//  Fatal error: Uncaught Error: Call to undefined function mysql_error() in /var/www/advokatfirmaet-viuff.dk/saldi-e/_config/connect.php:58 Stack trace: #0 /var/www/advokatfirmaet-viuff.dk/saldi-e/_debitor/page_Ordreliste.php(41): include() #1 {main} thrown in /var/www/advokatfirmaet-viuff.dk/saldi-e/_config/connect.php on line 58
#+  else mysql_query('SET storage_engine=INNODB');    //    var_dump($Øconnection);

global $Øexec_path;                 // Global path til PHP-udvidelser på server - Standard: '/usr/bin' 
define('SERVEREXEC', '/opt/bin');   // EV-soft: Initieringsværdi for @Øexec_path   Synology DSM: '/opt/bin'
$Øexec_path= SERVEREXEC;
?>
