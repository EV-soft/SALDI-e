<!DOCTYPE html>
<html lang="da" dir="ltr">
<head>
</head>
<body>
Skanning tager tid! <br>
Hav tålmodighed... <br>
</body>
</html>

  <?php
#  $d = dir("../../saldi-e/'");  ## saldi-e\_base\_tools\funcscann.php   ~/.rcinfo
#  $d = basename('./saldi-e');
  $d = dir("../../");  //    var_dump($d);
  $paths = glob('../../*/*.{htm,php}',GLOB_BRACE);
  $Fnavne= array("Liste med functionsnavne: ");
  echo "<br>Først skannes efter functions erklæringer...";
#  var_dump($paths);
  $searchWord= 'function ';
  foreach ($paths as $file) {
    $lastmod= filemtime($file);
    $time= ' <i>'.date (" Y-m-d ", $lastmod)/* .' _ '.date (" H:i:s ", $lastmod) */.'</i>';
    echo "<br>".$file.' _ '.$time;
    $fileLines = file($file);  $LinNo=0;
    foreach ($fileLines as $line_num => $line) {  $LinNo++; 
            if ($p=strpos(' '.$line,$searchWord)) { 
            if ($p<5) { //  PLACERING i starten af en linie!
                if ($s=strpos($line,"{")) $funcN= substr($line,0,$s); else $funcN= $line;
                $lno= '-----> '.$LinNo;
                $stpos= strpos($funcN,trim($searchWord))+9;
                $slpos= strpos($funcN,'(');
                array_push($Fnavne,trim(substr($funcN,$stpos,$slpos-$stpos)));
                $funcN= substr($funcN,0,$stpos).'<b><big>'.substr($funcN,$stpos,$slpos-$stpos).'</big></b><i>'.substr($funcN,$slpos).'</i>';
                echo "<pre style=\"line-height:5px;\">".$dir.' '.$sourceFile.str_repeat("&nbsp;",max(35-strlen($dir.$sourceFile),0)).' '.substr($lno,-6).': '.$funcN."</pre>";
              }
              if ((strpos($sourceFile,'out_')) and (strpos($sourceFile,'.php'))) {   //  2. KRITERIE: Filnavn
                $fras= $line;
                while (strpos($fras,$searchWord)) {
                  $p= strpos($fras,$searchWord);  $fras= substr($fras,$p+1);  $b= strpos($fras,"'");
                  $fras= html_entity_decode($fras);
                  $fras= strip_tags($fras);
                  echo  '<br>"'.substr($fras,0,$b).'"'.
                    str_repeat("&nbsp;",170-strlen(utf8_decode(substr($fras,0,$b)))).',"","","","","",""';  
                  $f= substr($fras,0,$b);
                  $fraser[] = ['"'.$f.'"'];
                } 
              } $count++; $total++;
          }}
    }
    
  echo '<br>Derpå lidt ?';
  $total= 0;    $buff= array();   $fraser= array();
#  echo "<br>".basename('./../saldi-e')."<br>";
#  echo $_SERVER['SERVER_NAME'] . dirname(__FILE__);
//  echo "<br><br><br><big>".'Projektskanning: '."</big><br>";
//  echo '<p style="font-family:courier; font-size:11; ">';
//  echo '<pre>Folder/        File'.str_repeat("&nbsp;",35-15).'Line: Function </pre>';
  while (false !== ($entry = $d->read())) {
    $dir= $entry.'/';
    if (is_dir($entry) ) {
      $files = scandir($dir);
      if ($files)
      foreach ($files as $sourceFile) { $count= 0;  $searchWord= 'function ';  //  1. KRITERIE: Søgeord
        if ( ($sourceFile!=='.') and ($sourceFile!=='..') and (!strpos($sourceFile,'.bak')) ) { //  SPRING OVER
          $fileLines = file($dir.$sourceFile); 
          $LinNo= 0;
          foreach ($fileLines as $line_num => $line) { $LinNo++;
            if ($p=strpos(' '.$line,$searchWord)) { 
            if ($p<5) { //  PLACERING i starten af en linie!
                if ($s=strpos($line,"{")) $funcN= substr($line,0,$s); else $funcN= $line;
                $lno= '-----> '.$LinNo;
       //         echo "<pre>".$dir.' '.$sourceFile.str_repeat("&nbsp;",max(35-strlen($dir.$sourceFile),0)).' '.substr($lno,-6).': '.$funcN."</pre>";
              }
              if ((strpos($sourceFile,'out_')) and (strpos($sourceFile,'.php'))) {   //  2. KRITERIE: Filnavn
                $fras= $line;
                #echo "<br>".$line;
                while (strpos($fras,$searchWord)) {
                  $p= strpos($fras,$searchWord);  $fras= substr($fras,$p+1);  $b= strpos($fras,"'");
                  $fras= html_entity_decode($fras);
                  $fras= strip_tags($fras);
        //          echo  '<br>"'.substr($fras,0,$b).'"'. str_repeat("&nbsp;",170-strlen(utf8_decode(substr($fras,0,$b)))).',"","","","","",""';  
                  $f= substr($fras,0,$b);
                # $f= strip_tags($f);
                # echo '<br>'.strip_tags($f, '<p><small><b><a><u>');
                # echo '<br>'.htmlspecialchars_decode($f);
                  $fraser[] = ['"'.$f.'"'];
                } 
              } $count++; $total++;
            } }
          $count= substr('000'.$count,-3);
          if ($count>0) $buff[] = '<br>Ialt: '.$count.' forekomst(er) af: "<font color=red>'.$searchWord.'</font>" i <i>'.$dir.'</i><b>'.$sourceFile.'</b>';
      } } }
  }
  echo '</p>';
  echo 'BEMÆRK: listen kan være ukomplet, hvis systematikken i kildefilerne, ikke er konsekvent! (max 4 tegns indrykning af: "function")'."<br>";
  $d->close();
  echo '<br>STATISTIK:';
  foreach ($buff as $buf) {echo $buf;};
  echo '<br>Total: '.$total. ' forekomst(er) af: <i>'.$searchWord.'</i> i de undersøgte filer<br>';
  $fraser= array_unique($fraser, SORT_REGULAR);
  sort($fraser);
# var_dump($fraser); echo '<br>';
//  echo '<br>Sorteret liste uden dubletter:';
  $x= 0;
  foreach ($fraser as $frase) {if (strlen($frase[0])>3) echo '<br>'./* $x++.'  '. */trim($frase[0],'"');};
# var_dump($GLOBALS['system']);
# phpinfo();
// ToDo: Dubletter fjernes, listen sortes og resultatet gemmes i fil.


function phpscann($searchWord) {
  echo '<br><b>'.$searchWord.'</b> <small>findes i filerne:</small> ';
  $searchWord= strtolower($searchWord);
  $paths = glob('../../*/*.{htm,php}',GLOB_BRACE);
  foreach ($paths as $file) {
    if (strpos(' '.$file,'page_')) {
      $fileLines = file($file);
      foreach ($fileLines as $line_num => $line) {
        if (strpos(' '.strtolower($line),$searchWord)) { echo ' ['.substr($file,6).'] '; break; } 
    } } } //} } }
}
  sort($Fnavne);
  echo '<br>Til slut en sorteret liste med reference til page_* filer, hvor functions navne forekommer:';
  foreach ($Fnavne as $Fnavn) { phpscann($Fnavn); };  //  Dette kan tage lang tid... !
  echo '<br>SLUT.';
?>
