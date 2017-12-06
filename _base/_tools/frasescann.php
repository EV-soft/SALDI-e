<?php   $DocFil= '../_base/_tools/frasescann.php';    $DocVer='5.0.0';    $DocRev='2017-11-00';   $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Find alle sprog-fraser: '@Strenge med prefix: '@ i alle php-filer, også i undermapper, og udskriv sorteret liste på skærm.';
 *  Efterfølgende benyttes resultatet til oversættelse af SALDI's programflade, til andre sprog.
 * Denne fil er oprettet af EV-soft i 2017.
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2016 DANOSOFT ApS *** Se filen: ../LICENS_Copyright.txt
 *
 *
 * Filer skal gemmes i UTF-8 format uden BOM!
 *  2016.08.00 ev - EV-soft
 */
  $d = dir("./../..");  ## saldi-e\_base\_tools\frasescann.php
  $total= 0;    $buff= array();   $fraser= array(); $longest= 0;
  echo "<br><big>".'Projektskanning: '."</big><br>";
  echo "<br>".'Der skannes efter fraser, dvs. strenge der starter med: \'@ '."<br>";
  echo '<p style="font-family:courier; font-size:11; ">';
//echo '"!SYSTEM-key :Dansk (Med prefix: @)","da:Dansk (Denmark:Danish da-DK)","en:English (United Kingdom:English en-GB)","de:Deutsch (Germany:German de-DE)","fr:Français (France:French fr-FR)","tr:Türkçe (Turkey:Turkish tr-TR)","pl:Polish (Poland pl-PL)","es:Español (Spain:Spanish es-ES)"';  # "Greenland - Greenlandic",    "kl-GL"
  while (false !== ($entry = $d->read())) {
    $dir= $entry.'/';         #'debitor/';
    if (is_dir($entry) ) {
      $files = scandir($dir);
      if ($files)
      foreach ($files as $source) { $count= 0;  $search= "'@";  $search1= '"@';
        if ( ($source!=='.') and ($source!=='..') and (!strpos($source,'.bak')) and (!strpos($source,'scann.php')) and 
            (!strpos($source,'.csv')) and ((strpos($source,'.php')) or (strpos($source,'.htm'))) ) {  
          $lines = file($dir.$source); 
          foreach ($lines as $line_num => $line) {
            $line= ' '.$line; //  Uden SPACE fejler strpos() (=0 =false?)når $search står først på linien
            if (($a=strpos($line,$search)) or ($a=strpos($line,$search1))) {
          #   if (('user_interface.php'== $source) or ('LayoutModuler.php'== $source)) {
              if ((strpos($source,'.php')) or (strpos($source,'.htm'))) {
                $fras= $line;
                while (strpos($fras,$search)) {
                  $a= strpos($fras,$search);  $fras= substr($fras,$a+1);  $b= strpos($fras,"'");
                  $fras= html_entity_decode($fras);
                  $fras= strip_tags($fras);
                  $longest= max($longest,strlen(utf8_decode(substr($fras,0,$b))));
          //        echo  '<br>"'.substr($fras,0,$b).'"'.
          //          str_repeat("&nbsp;",170-strlen(utf8_decode(substr($fras,0,$b)))).',"","","","","",""';  
                  $f= substr($fras,0,$b);
                # $f= strip_tags($f);
                # echo '<br>'.strip_tags($f, '<p><small><b><a><u>');
                # echo '<br>'.htmlspecialchars_decode($f);
                  $fraser[] = ['"'.$f.'"'];
                } 
                while (strpos($fras,$search1)) {
                  $a= strpos($fras,$search1); $fras= substr($fras,$a+1);  $b= strpos($fras,'"');
          //        echo '<br><red>"'.substr($fras,0,$b).'"'.'</red>'.
          //          str_repeat("&nbsp;",170-strlen(utf8_decode(substr($fras,0,$b)))).',"","","","","",""';  
                  $fraser[] = ['"'.substr($fras,0,$b).'"'];
                } 
              } $count++; $total++;
            } }
          $count= substr('000'.$count,-4);
          if ($count>0) $buff[] = '<br>Ialt: '.$count.' forekomst(er) af: "<font color=red>'.$search.'</font>" i <i>'.$dir.'</i><b>'.$source.'</b>';
      } } }
  }
  echo '</p>';
  $d->close();
  foreach ($buff as $buf) {echo $buf;};
  echo '<br>Total: '.$total. ' forekomst(er) af: <i>'.$search.'</i> i de undersøgte filer<br>';
  $fraser= array_unique($fraser, SORT_REGULAR);
  sort($fraser);
# var_dump($fraser); echo '<br>';
  echo '<br>Sorteret liste uden dubletter:';
  $x= 0;
  echo '<p style="font-family:courier; font-size:11; ">';
//      "!SYSTEM-key :Dansk (Med prefix: @)","da:Dansk (Denmark:Danish da-DK)","en:English (United Kingdom:English en-GB)","de:Deutsch (Germany:German de-DE)","fr:Français (France:French fr-FR)","tr:Türkçe (Turkey:Turkish tr-TR)","pl:Polish (Poland pl-PL)","es:Español (Spain:Spanish es-ES)","it:italian","gr:Greenland"
  echo '"!SYSTEM-key :Dansk (Med prefix: @)","da:Dansk (Denmark:Danish da-DK)","en:English (United Kingdom:English en-GB)","de:Deutsch (Germany:German de-DE)","fr:Français (France:French fr-FR)","tr:Türkçe (Turkey:Turkish tr-TR)","pl:Polish (Poland pl-PL)","es:Español (Spain:Spanish es-ES)","it:italian"';
# foreach ($fraser as $frase) {if (strlen($frase[0])>3) echo '<br>'./* $x++.'  '. */trim($frase[0],'"');};
  foreach ($fraser as $frase) {if (strlen($frase[0])>3) echo '<br>'.$frase[0].','.
    str_repeat("&nbsp;",$longest+3-strlen(utf8_decode(substr($frase[0],0)))).'"da","en","de","fr","tr","pl","es","it"'; };

  echo '<br>';  echo '<br>#################################################################### Her følger Danske fraser uden prefix og HeaderLine, klar til Google translate:';  
  echo '<br>';  echo '<br>';
  foreach ($fraser as $frase) {if (strlen($frase[0])>3) echo '<br>'.trim(substr($frase[0],2),'"'); };
  echo '</p>';
  echo '<br>Ialt: '.count($fraser).' fraser i den sorterede liste. Længste frase er på '.$longest.' tegn.';
  echo '<br><br>################################# Her følger en vejledning:'; 
  echo '<br>Hvad nu ?<br>Kopier alle de linier der slutter med: "da","en","de","fr","tr","pl","es","it" til et tekstprogram der kan håndtere kolonne-kopiering og UTF-8 tegnsæt (f.eks. Notepad++)<br>';
  echo '<br>Kontroller at alle kolonner: "da","en","de","fr","tr","pl","es","it" flugter nøjagtiget over hinanden. (Der må ikke være TAB-tegn eller andre spec.-tegn i filen!)<br>Kopier listen med de danske fraser uden @-prefix over i Google translate<br>';
  echo '<br>Start med at oversætte til Italiensk. Indsæt/erstat resultatet i "it"-kolonnen yderst til højre (`it` erstattes af oversat tekst!). <br>Derpå Spansk i næstseneste kolonne, og Italiensk rykker ud til højre.';
  echo '<br>Når alle kolonner er udfyldt, skal overflødige SPACE imellem " og " i første kolonne, fjernes med søg/erstat, så kolonner overalt adskilles med "," <br><br>';
  echo '<br>Kontroller i filens top og bund, at der ikke er overflødige linier. <br>Nu er du klar til at gemme den komma-separerede fil som ../_base/Sprog_DB.csv<br>';
  echo '<br>Det er også muligt at benytte et regneark, til at opnå samme resultat (Se: _exchange/fraseliste.ods)<br><br>';
# var_dump($GLOBALS['system']);
# phpinfo();
// ToDo: resultatet gemmes i fil.
?>
