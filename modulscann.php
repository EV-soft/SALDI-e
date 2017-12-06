<?php   $DocFil= '../modulscann.php';    $DocVer='5.0.0';    $DocRev='2017-10-00';   $DocIni='evs';  $ModulNr=0; 
/* ## Purpose:'Rapportering af alle kilde-filers status.';
 * Denne fil er oprettet af EV-soft i 2017.
*/
function VisVar($line,$name) {
  $line= htmlentities($line);
  $p= strpos(strtolower($line),strtolower($name));
  $v= substr($line,$p);
  $l= strpos($v,';');
  $n= strlen($name);
  if ($p>0) return '<b>'.trim(substr($v,$n+1,$l-$n),'=').'</b><br>';
  else return '<small><small> ~</small></small>';
#  else return '';
}

  // Original PHP code by Chirp Internet: www.chirp.com.au
  // Please acknowledge use of this code by including this header.
  // Source: http://www.the-art-of-web.com/php/dirlist/
  function getFileList($dir, $recurse=false, $depth=false)
  { $retval = array();
    if(substr($dir, -1) != "/") $dir .= "/";    // add trailing slash if missing
    $dirPtr = @dir($dir) or die("getFileList: Failed opening directory $dir for reading");    // open pointer to directory and read list of files
    while (false !== ($entry = $dirPtr->read())) {
      if ($entry[0] == ".") continue;           // skip hidden files
      if (is_dir("$dir$entry")) {
        $retval[] = array( "path" => "$dir", "name" => "$entry/",   "type" => filetype("$dir$entry"),   "size" => 0,    "lastmod" => filemtime("$dir$entry") );
        if ($recurse && is_readable("$dir$entry/"))  {
          if($depth === false) {
            $retval = array_merge($retval, getFileList("$dir$entry/", true));
          } elseif($depth > 0) {
            $retval = array_merge($retval, getFileList("$dir$entry/", true, $depth-1));
          }
        }
      } elseif (is_readable("$dir$entry")) {
        $retval[] = array( "path" => "$dir", "name" => "$entry",    "type" => mime_content_type("$dir$entry"),  "size" => filesize("$dir$entry"), "lastmod" => filemtime("$dir$entry") );
      }
    } $dirPtr->close();
    return $retval;
  }

//  ob_start();
  echo '<!DOCTYPE html>';
  echo '<html lang="da" dir="ltr">';
  echo "<head>";
  echo '  <meta charset="UTF-8">';
  echo '  <title>SALDI-€</title>';
  echo '  <link rel="stylesheet" href= ".\_assets\font-awesome/css/font-awesome.min.css">';    //   emne= "ICON-system"
  echo '  <link rel="stylesheet" href=".\_base\_tools\theme.default.min.css">';
  echo '  <script type="text/javascript" src=".\_base\_tools\jquery-1.2.6.min.js"></script>';                //  <!-- load jQuery and tablesorter scripts -->
  echo '  <script type="text/javascript" src=".\_base\_tools\jquery.tablesorter.min.js"></script>';
  echo '  <script type="text/javascript" src=".\_base\_tools\jquery.tablesorter.widgets.min.js"></script>';   //  <!-- tablesorter widgets (optional) -->
  echo '  <script type="text/javascript">$(function(){  $("#myTable").tablesorter();}); </script>';
  echo '  <script type="text/javascript">$( function() { $( "table" ).tablesorter({    theme : "blue",    duplicateSpan : true, ';
  echo '  widthFixed: true,    widgets : [ "zebra", "filter" ],    widgetOptions : {      filter_external: "input.search",      filter_reset: ".reset"    }  });';

  echo '  $(".sort").click(function() {    $("table").trigger("sorton", [ [[ $(this).text(), "n" ]] ]);  });});';
  echo '  </script>';
  echo '  <style type="text/css"> .tablesorter-blue td[colspan] { color: red; } </style>';
  
#  echo '  $("#wait").show();'; // when you want to show the wait image
#  echo '  $("#wait").hide();'; // when your process is done or don't worry about it if the page is refreshing
  echo '<style type="text/css">';
  echo '  #wait {   position:fixed;   top:50%;   left:50%;   background-color:#dbf4f7;';
  echo '   background-image:url("./_assets/images/wait.gif");';               // path to your wait image
  echo '   background-repeat:no-repeat;   z-index:100;';                      // so this shows over the rest of your content
  echo '   opacity: 0.9;   filter: alpha(opacity=90);   -moz-opacity: 0.9;}'; /* alpha settings for browsers */
  echo '</style>   ';

  echo "</head>";
/* 
$(function(){  $("#myTable").tablesorter();});
$(function(){  $("#myTable").tablesorter({ sortList: [[0,0], [1,0]] });});
*/  
  echo "<br><big>".'SALDI-<small>€</small> Modul-skanning: '."</big><br>";
  echo '<style> table {font-family:courier; font-size:11; border-right: 1px solid gray; border-bottom: 1px solid gray;} '.
               'th, td { border-top: 1px solid gray; border-left: 1px solid gray; padding-left:3px;} </style>';
  echo '<p style="font-family:courier; font-size:11; ">';
  
  //ob_implicit_flush(true);
  //echo 'Vent... Det kan vare ca. 30 sek. at skanne alle mapper!<br>';
//  echo '<BODY onLoad="javascript:alert(\'Vent... Det kan vare ca. 30 sek. at skanne alle mapper!\')">';
//  echo str_repeat(" ", 10240). "\n";
  //ob_end_clean();
  //echo 'header("Location: "'.$_SERVER['REQUEST_URI'].');';
  //echo '<script type="text/javascript">location.reload(true);</script>';
  //echo '<meta http-equiv="refresh" content="10">';
  //header("refresh: 5;");
  //ob_end_flush();
//  ob_flush();  flush();

#+  echo '<input class="search" data-column="all" placeholder="Search all columns" type="search"><sup class="results xsmall">‡</sup>';
#+  echo '<button type="button" class="reset">Reset</button>';
#+  echo '<code id="show-filter"></code>';

#+  echo '<p class="xsmall"><span class="results">†</span> '; //The reason for this issue is that the filter input in the index column has this setting:
#+  echo '<code>data-column="0-1"</code>';                    //, and it has not yet been worked out how to properly target that input.<br>
#+  echo '<span class="results">‡</span>';                    // It is still being investigated as to why the search using the button targeting column 6 and the "all" input have different results (Enter "4" in the input and 4 rows will appear in the result, then click on the "4" to search both index columns - one less row).
#+  echo '</p>';
  
#+  echo '<input type="button" onclick="startTask();" id="btnId" value="Start scanning" title="Skanning kan tage adskillige sekunder..."/>';
  
  echo '<script type="text/javascript"> $("#btnId").click(function(){ $.ajax({url: "yourPhpPage.php?clicked=Y", success: function(){ yourJavaScriptFunction();/* this will call after PHP method execution. */ }}); }); </script>';
/* <?php */ if(isset($_GET['clicked']) && $_GET['clicked']=='Y' ){ $filliste= getFileList("./", true, 3);  /* do your php work */} /* ?> */

  echo '<table id="myTable" class="tablesorter">';
  echo '<thead> <tr class="tablesorter-ignoreRow"> <th colspan="10"> Tabellen nedenfor er sorterbar - Klik på overskrifter.<br> Tabellen indeholder en oversigt over SALDI-€\'s kildefiler</th>    </tr>'.
               '<tr>  <th>Ix</th> <th>Path</th> <th>Filnavn</th>  <th>FilFacts</th>  <th>Link</th> <th>Version</th> <th>Revision</th> <th>Initialer</th> <th>ModulNr</th> <th>Formål</th> </tr> </thead>';
  echo '<tfoot> <tr>  <th style="padding-left:5px">Ix</th> <th style="padding-left:5px">Path</th> <th style="padding-left:5px">Filnavn</th>  <th style="padding-left:5px">FilFacts</th>  <th style="padding-left:5px">Link</th> <th style="padding-left:5px">Version</th> <th style="padding-left:5px">Revision</th> <th style="padding-left:5px">Initialer</th> <th style="padding-left:5px">ModulNr</th> <th style="padding-left:5px">Formål</th> </tr> </tfoot>';
  
  echo '<tbody>';
#+  echo '<i class="fa fa-cog fa-spin fa-2x fa-fw" aria-hidden="true"></i>';
  echo '<div style="display:none;" id="wait">';
  echo '  $("#wait").show();'; // when you want to show the wait image
  
  echo '<span class="sr-only">Loading...</span>';
        
  echo '<script type="text/javascript"> function startTask() { '.$filliste.' = getFileList("./", true, 2); } </script>';// Der søges kun i 2 niveauer under /saldi-e/ for at øge hastidheden.
  if (isset($_GET['btnId'])) { $filliste= getFileList("./", true, 2); }
  $filliste= getFileList("./", true, 2);
  
  echo '  $("#wait").hide();'; // when your process is done or don't worry about it if the page is refreshing
  //ob_start();
  foreach ($filliste as $fList) { 
    if (($fList['name'] !=='Thumbs.db') and ($fList['name'] !=='@eaDir')  //  skjulte Multimedie filer på Synology
        and (strpos(strtolower($fList['path']),strtolower('---RodeKassen')) < 1 )
        and (strpos($fList['path'],'_tools') < 1 )
        and (strpos($fList['path'],'_assets/js') < 1 )
        and (substr($fList['name'],-4) !== '.bak')
        and (substr($fList['name'],-4) !== '.png')
        and (substr($fList['name'],-3) !== '.js' )
        and ((substr($fList['name'],-4)  == '.php') or  (substr($fList['name'],-4)  == '.htm')  or  (substr($fList['name'],-5)  == '.html'))  //or  (substr($fList['name'],-4)  == '.css')
        )
          { $fLines = file($fList['path'].$fList['name']);  $LinNo= 0;  $i++;
            $Lin0= $fLines[0];
            $Lin1= $fLines[1];
            $Lin2= $fLines[2];
            $A= VisVar($Lin0,'$DocFil');  if ($A=='') $A= VisVar($Lin1,'$DocFil');
            $B= VisVar($Lin0,'$DocVer');  if ($B=='') $B= VisVar($Lin1,'$DocVer');
            $C= VisVar($Lin0,'$DocRev');  if ($C=='') $C= VisVar($Lin1,'$DocRev');
            $D= VisVar($Lin0,'$DocIni');  if ($D=='') $D= VisVar($Lin1,'$DocIni');
            $E= VisVar($Lin0,'$ModulNr'); if ($E=='') $E= VisVar($Lin1,'$ModulNr');
            $F= VisVar($Lin1,' Purpose'); if ($F=='') $F= VisVar($Lin2,' Purpose');
            $size= ' Size: '.substr('~~~~~~~~~~~~~'.$fList['size'],-7);
            $time= ' Date:'.date (" Y-m-d ", $fList['lastmod']).' Time:'.date (" H:i:s ", $fList['lastmod']);
            $path= $fList['path'];
            if (strlen($path)>50) {$path= substr($path,0,20).' ... '.substr($path,-25);};
            echo '<tr><td style="text-align:right">'.$i.'</td><td>'.$path.'</td><td> <i><b>'.$fList['name'].'</b></i></td><td>'.$time.$size.
              '<td>'.$A.'</td><td style="text-align:center">'.$B.'</td><td style="text-align:center">'.$C.'</td><td style="text-align:center">'.
                     $D.'</td><td style="text-align:center">'.$E.'</td><td>'.$F.'</td>'.'</tr>';
          }
  };
  echo '</div>';
  echo '</tbody></table>';

  
  
?>
