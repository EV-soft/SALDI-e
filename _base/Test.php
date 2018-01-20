<?php   $DocFil= '../_base/Test.php';    $DocVer='5.0.0';    $DocRev='2017-09-00';
/* ## FORMÅL: Redigering af udskrivnings formularer
 * Denne fil er oprettet af EV-soft  i 2017.
 *             ___   _   _    ___  _         
 *            / __| / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            |___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2017 Saldi.dk ApS      *** Se filen: ../LICENS_Copyright.txt
 *
 * 
 *
 * 2016.08.00 evs - EV-soft
 *
 */
  $pageTitl='Test';

  echo '<!DOCTYPE html>';
  echo '<html lang="da" dir="ltr">';
  echo "\n<head>";
  echo '  <meta charset="UTF-8">';
  echo '  <title>'.$pageTitl.'</title>';
  
  echo '<script type="text/javascript">';     //  https://stackoverflow.com/questions/7790725/javascript-track-mouse-position
  echo "var showinfo = document.getElementById('showinfo');";  //  Knyt til objektet showinfo
  echo "function tellPos(p){ showinfo.innerHTML = 'Pos. X,Y: ' + p.pageX + ',' + p.pageY; }"; //  Virker ikke ! ?
  echo "addEventListener('mousemove', tellPos, false); ";   //  Rapporter mouse-pos til function tellPos
  
  // Getting 'Info' div in js hands
  echo "var info = document.getElementById('info');";

  // Creating function that will tell the position of cursor
  // PageX and PageY will getting position values and show them in P
  echo "function tellPos(p){  info.innerHTML = 'Position X : ' + p.pageX + '&lt;br /&gt;Position Y : ' + p.pageY;}";
  echo "addEventListener('mousemove', tellPos, false);";
  
  echo '</script>';
  
echo '<style>';
  echo '  * { padding:0; margin:0; }';
  echo '#showinfo { position:absolute; top:50mm; left:-50px; background-color:black; color:white; border-radius: 5px; padding:8px 16px; width:120px; transform: rotate(270deg); font-size: 12px;';
  echo '  font-family: sans-serif;';
  echo '  }';
  
  echo '* {  padding: 0:  margin: 0; }';
  echo '#info {  position: absolute;  top: 10px;  right: 10px;  background-color: black;  color: white;  padding: 25px 50px;}';
  
echo '</style>';

  echo "\n</head>";
  echo "\n<body>\n";

//  include("../_base/htm_pageHead.php"); # Sidens indledende html-kode
### INDLÆS DATA:

### VIS DATA:
//    Rude_Printlayout($filDATA);
/*  echo '<div id="printpage" style="border: 1px solid #8c8b8b; padding:2px; width:200mm; height:100mm; margin: auto; margin-bottom:20px;'.
   ' position:relative; background:white;"> <legend><tc><b>Papir: A4-Portrait</b></tc></legend>';
 
//  echo '<div id="showinfo">Pos. X,Y:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;?,?&nbsp;px</div>'; //  X:Y-pos:  &nbsp;  ?:?
 
 echo '</div>';   
 */
  echo "<div id='info'></div>";
  
  echo '  </body>';
  echo '</html>';

?>  

<!-- 
<!DOCTYPE html><html lang="da" dir="ltr">
<head>  <meta charset="UTF-8">  <title>Test</title>
<script type="text/javascript">
  var showinfo = document.getElementById('showinfo');
  function tellPos(p){ showinfo.innerHTML = 'Pos. X,Y: ' + p.pageX + ',' + p.pageY; }
  addEventListener('mousemove', tellPos, false); 
</script>
<style> 
  * { padding:0; margin:0; }
  #showinfo { position:absolute; top:50mm; left:-50px; background-color:black; color:white; border-radius: 5px; padding:8px 16px; width:120px; transform: rotate(270deg); font-size: 12px;  font-family: sans-serif;  }
</style>
</head>
<body>
<fieldset id="printpage" style="border: 1px solid #8c8b8b; padding:2px; width:200mm; height:100mm; margin: auto; margin-bottom:20px; position:relative; background:white;"> 
  <legend><tc><b>Papir: A4-Portrait</b></tc></legend>
  <div id="showinfo">Pos. X,Y:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;?,?&nbsp;px</div>
</fieldset>  
</body></html>  
 -->

 <!-- 
<pre class="snippet-code-js lang-js prettyprint-override">
<code>
// Getting 'Info' div in js hands
var info = document.getElementById('info');

// Creating function that will tell the position of cursor
// PageX and PageY will getting position values and show them in P
function tellPos(p){
  info.innerHTML = 'Position X : ' + p.pageX + '&lt;br /&gt;Position Y : ' + p.pageY;
}
addEventListener('mousemove', tellPos, false);
</code>
</pre>
<pre class="snippet-code-css lang-css prettyprint-override">
<code>
* {
  padding: 0:
  margin: 0;
  /*transition: 0.2s all ease;*/
  }
#info {
  position: absolute;
  top: 10px;
  right: 10px;
  background-color: black;
  color: white;
  padding: 25px 50px;
}
</code>
</pre>
<pre class="snippet-code-html lang-html prettyprint-override">
<code>
&lt;!DOCTYPE html&gt;
&lt;html&gt;
  
  &lt;body&gt;
    &lt;div id='info'&gt;&lt;/div&gt;
        &lt;/body&gt;
  &lt;/html&gt;
</code>
</pre>
 -->