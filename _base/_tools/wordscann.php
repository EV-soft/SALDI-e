<?php
  $d = dir("./../..");  ## saldi-e\_base\_tools\wordscann.php
  $total= 0;    $buff= array();   $fraser= array();  if (!$ordet) $ordet= 'Rude_';  $CaseCare= true;
  echo "<br><big>".'Projektskanning: '."</big><br>";
  echo "<br>".'<form action="" method="post">'.'<label for="ordet">Søgeord: </label>'.
       '<input type= "text"  style="text-align:left; line-height:100%;" width="90" id="ordet" name="ordet" value="'.$ordet.'"; /> ';
  echo "<br>".'<input type= "checkbox" name="casecare" value="'.$CaseCare.'"  >'.
       '<label for="casecare" style="color:green;"  > Ufølsom for STORE/små bogstaver </label> ';
  echo '<input type= "submit" name="submit" value="Fortsæt">   </form>';
  if(isset($_POST['submit'])){
  $ordet= $_POST['ordet'];;
  echo '<p style="font-family:courier; font-size:11; ">';
  while (false !== ($entry = $d->read())) {
    $dir= $entry.'/';
    if (is_dir($entry) ) {
      $files = scandir($dir);
      if ($files)
      foreach ($files as $sourceFile) { $count= 0;  $searchWord= $ordet;  //  1. KRITERIE: Søgeord
        if ( ($sourceFile!=='.') and ($sourceFile!=='..') and (!strpos($sourceFile,'.bak')) ) { //  SPRING OVER
          $fileLines = file($dir.$sourceFile);  $LinNo=0;
          if ($CaseCare==false) $searchWord= strtolower($searchWord);
          foreach ($fileLines as $line_num => $line) {  $LinNo++; 
            if ($p=strpos(' '.$line,$searchWord)) { 
            if ((strpos($sourceFile,'out_')) and (strpos($sourceFile,'.php'))) {   //  2. KRITERIE: Filnavn
                $fras= $line;
                if ($CaseCare==false) $fras= strtolower($fras); 
                while (strpos($fras,$searchWord)) {
                  $p= strpos($fras,$searchWord);  $fras= substr($fras,$p+1);  $b= strpos($fras,"'");
                  $fras= html_entity_decode($fras);
                  $fras= strip_tags($fras);
                  echo  '<br>'.substr($fras,0,$b);
                  $f= substr($fras,0,$b);
                  $fraser[] = ['"'.$f.'"'];
                } 
              } $count++; $total++;
            } }
          $count= substr('000'.$count,-3);
          if ($count>0) $buff[] = '<br>Ialt: <font color=red>'.$count.'</font> forekomst(er) af: "<font color=red>'.$searchWord.'</font>" i <i>'.$dir.'</i><b>'.$sourceFile.'</b>';
      } } }
  }
  echo '</p>';
  $d->close();
  foreach ($buff as $buf) {echo $buf;};
  echo '<br>Total: '.$total. ' forekomst(er) af: <i>'.$searchWord.'</i> i de undersøgte filer<br>';
  $fraser= array_unique($fraser, SORT_REGULAR);
  sort($fraser);
  }
?>
