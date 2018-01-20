  <?php
#  $d = dir("../../saldi-e/'");  ## saldi-e\_base\_tools\docscann.php   ~/.rcinfo
#  $d = basename('./saldi-e');
# Denne fil trænger til en korrektur!
  $d = dir("../../");  //    var_dump($d);
  $paths = glob('../../*/*.{htm,php}',GLOB_BRACE);
  $searchWord= 'out_base.php';  //  '.php\'';
//  echo '<input type= "text" name="soeg" '.'value="'.$searchWord.'" placeholder="..." style= " background-color: yellow; background: rgba(255, 255, 255, 0.5); width:160px; " />';
  $log= "<br>Liste over forekomster.<br>";
  echo "<br>Første runde - Path/Fil, der indeholder teksten: ".$searchWord."<br>";
  foreach ($paths as $file) {
    echo "<br>".$file;
    $fileLines = file($file);  $LinNo=0;
    foreach ($fileLines as $line_num => $line) {  $LinNo++; 
            if ($p=strpos(' '.$line,$searchWord)) { 
            $log.= "<br>".$line;
            if ($p<5) { //  PLACERING i starten af en linie!
                if ($s=strpos($line,"{")) $funcN= substr($line,0,$s); else $funcN= $line;
                $lno= '-----> '.$LinNo;
                echo "<pre>".$dir.' '.$sourceFile.str_repeat("&nbsp;",max(35-strlen($dir.$sourceFile),0)).' '.substr($lno,-6).': '.$funcN."</pre>";
              }
              if ((strpos($sourceFile,'out_')) and (strpos($sourceFile,'.php'))) {   //  2. KRITERIE: Filnavn
                $fras= $line;
                while (strpos($fras,$searchWord)) {
                  $p= strpos($fras,$searchWord);  $fras= substr($fras,$p+1);  $b= strpos($fras,"'");
                  $fras= html_entity_decode($fras);
                  $fras= strip_tags($fras);
                  echo  '<br>"'.substr($fras,0,$b).'"'. str_repeat("&nbsp;",170-strlen(utf8_decode(substr($fras,0,$b)))).',"","","","","",""';  
                  $f= substr($fras,0,$b);
                  $fraser[] = ['"'.$f.'"'];
                } 
              } $count++; $total++;
          }}
    }
  $total= 0;    $buff= array();   $fraser= array();
#  echo "<br>".basename('./../saldi-e')."<br>";
#  echo $_SERVER['SERVER_NAME'] . dirname(__FILE__);
  echo "<br><br><big>".'2. runde - Antal forekomster: '."</big><br>";
  // echo '<p style="font-family:courier; font-size:11; ">';
  // echo '<pre>Folder/        File'.str_repeat("&nbsp;",35-15).'Line: Function </pre>';
  while (false !== ($entry = $d->read())) {
    $dir= $entry.'/';
    if (is_dir($entry) ) {
      $files = scandir($dir);
      if ($files)
      foreach ($files as $sourceFile) { $count= 0; // $searchWord= '$DocFil';     //  1. KRITERIE: Søgeord
        if ( ($sourceFile!=='.') and ($sourceFile!=='..') and (!strpos($sourceFile,'.bak')) ) { //  SPRING DISSE OVER
          $fileLines = file($dir.$sourceFile); 
          $LinNo= 0;
        //echo  "<br>".$sourceFile.':';
          $log.= "<br><b>".$sourceFile.'</b>:';
          foreach ($fileLines as $line_num => $line) { $LinNo++;
            if ($p=strpos(' '.$line,$searchWord)) { 
            $log.= "<br>".$line;
            if ($p<5) { //  PLACERING i starten af en linie!
                if ($s=strpos($line,"{")) $funcN= substr($line,0,$s); else $funcN= $line;
                $lno= '-----> '.$LinNo;
                echo "<pre>".$dir.' '.$sourceFile.str_repeat("&nbsp;",max(35-strlen($dir.$sourceFile),0)).' '.substr($lno,-6).': '.$funcN."</pre>";
                #echo '<br>'.$line;
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
              # $f= strip_tags($f);
              # echo '<br>'.strip_tags($f, '<p><small><b><a><u>');
              # echo '<br>'.htmlspecialchars_decode($f);
                $fraser[] = ['"'.$f.'"'];
              } 
            } $count++; $total++;            $log.= "<br>".$line;
          } }
          $count= substr('000'.$count,-3);
          if ($count>0) $buff[] = '<br>Ialt: '.$count.' forekomst(er) af: "<font color=red>'.$searchWord.'</font>" i <i>'.$dir.'</i><b>'.$sourceFile.'</b>';
      } } }
  }
  echo '</p>';
  echo 'BEMÆRK: listen kan være ukomplet, hvis systematikken i kildefilerne, ikke er konsekvent! (max 4 tegns indrykning af: "function")'."<br>";
  $d->close();
  foreach ($buff as $buf) {echo $buf;};
  echo '<br>Total: '.$total. ' forekomst(er) af: <i>'.$searchWord.'</i> i de undersøgte filer<br>';
  $fraser= array_unique($fraser, SORT_REGULAR);
  sort($fraser);
# var_dump($fraser); echo '<br>';
//  echo '<br>Sorteret liste uden dubletter:';
  $x= 0;
  foreach ($fraser as $frase) {if (strlen($frase[0])>3) echo '<br>'./* $x++.'  '. */trim($frase[0],'"');};
  echo '<pre>'.$log.'</pre><br>SLUT.... Søg nu på: '.$searchWord.' for at få browseren til at markere forekomsterne.';
# var_dump($GLOBALS['system']);
# phpinfo();
// ToDo: Dubletter fjernes, listen sortes og resultatet gemmes i fil.
?>
