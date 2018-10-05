<?php   $DocFil= '../_system/save_Formularer.php';    $DocVer='5.0.0';    $DocRev='2018-09-20';   $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Gem i Database: redigerede formular-data';
 *  // Includeres fra: ../_system/page_Formtext.php
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2018 Saldi.dk ApS      *** Se filen: ../LICENS_Copyright.txt
 *
 * 
  Oprettet: 2018-02-00 evs - EV-soft
  Ændrings-Log:
      
 *
 */

if (($_POST['Kol0'])) { //  Gem/Opdater i DataBase:
  $rowCount =  count($_POST['Kol0']); 
  $analyse= false;
  if (($GLOBALS["Ødebug"]) or ($analyse)) {  //  Vis data i tabel:
    echo ' Data inden der gemmes/opdateres:<br>';
 // echo '<style>table, th, td { padding:0px 3px; border: 0.5px solid gray;}</style>';
    echo '<style>table, th, td { border:2px solid white;}</style>';
    echo '<table style= "width:99%; "><tbody style="font-size: 13px; ">';
    echo '<td>ix</td><td>id</td><td>form</td><td>frm_art</td><td>side</td><td>besk</td><td>just</td><td>x0</td><td>y0</td><td>dx</td>'.
         '<td>dy</td><td>dim</td><td>colr</td><td>font</td><td>style</td><td>imglnk</td><td>lngkey</td><td>note</td>';
    for ($row=0; $row<=$rowCount-1; $row++) {
        echo '<tr><td>'.$row.'</td>';
          echo '<td>'.$_POST['Kol0' ][$row].'</td>';   //  <i>id:'.      '</i>   '<b>'.  </b>
          echo '<td>'.$_POST['Kol1' ][$row].'</td>';   //  <i>form:'.    '</i>   '<b>'.  </b>
          echo '<td>'.$_POST['Kol2' ][$row].'</td>';   //  <i>frm_art:'. '</i>   '<b>'.  </b>
          echo '<td>'.$_POST['Kol3' ][$row].'</td>';   //  <i>side:'.    '</i>   '<b>'.  </b>
          echo '<td>'.$_POST['Kol4' ][$row].'</td>';   //  <i>besk:'.    '</i>   '<b>'.  </b>
          echo '<td>'.$_POST['Kol5' ][$row].'</td>';   //  <i>just:'.    '</i>   '<b>'.  </b>
          echo '<td>'.$_POST['Kol6' ][$row].'</td>';   //  <i>x0:'.      '</i>   '<b>'.  </b>
          echo '<td>'.$_POST['Kol7' ][$row].'</td>';   //  <i>y0:'.      '</i>   '<b>'.  </b>
          echo '<td>'.$_POST['Kol8' ][$row].'</td>';   //  <i>dx:'.      '</i>   '<b>'.  </b>
          echo '<td>'.$_POST['Kol9' ][$row].'</td>';   //  <i>dy:'.      '</i>   '<b>'.  </b>
          echo '<td>'.$_POST['Kol10'][$row].'</td>';   //  <i>dim:'.     '</i>   '<b>'.  </b>
          echo '<td>'.$_POST['Kol11'][$row].'</td>';   //  <i>colr:'.    '</i>   '<b>'.  </b>
          echo '<td>'.$_POST['Kol12'][$row].'</td>';   //  <i>font:'.    '</i>   '<b>'.  </b>
          echo '<td>'.$_POST['Kol13'][$row].'</td>';   //  <i>style:'.   '</i>   '<b>'.  </b>
          echo '<td>'.$_POST['Kol14'][$row].'</td>';   //  <i>imglnk:'.  '</i>   '<b>'.  </b>
          echo '<td>'.$_POST['Kol15'][$row].'</td>';   //  <i>lngkey:'.  '</i>   '<b>'.  </b>
          echo '<td>'.$_POST['Kol16'][$row].'</td>';   //  <i>note:'.    '</i>   '<b>'.  </b>
        echo '</tr>';
      }              
    echo '<tbody></table>';
  }
  
  for ($row=0; $row<=$rowCount-1; $row++)  {
  $assignliste=  
  #-'id= "'.       addslashes($_POST['Kol0'] [$row]).'", '.   //  id serial,           
    'form= "'.     addslashes($_POST['Kol1' ][$row]).'", '.   //  form integer,        
    'frm_art= "'.  addslashes($_POST['Kol2' ][$row]).'", '.   //  frm_art integer,     
    'side= "'.     addslashes($_POST['Kol3' ][$row]).'", '.   //  side varchar(2),     
    'besk= "'.     addslashes($_POST['Kol4' ][$row]).'", '.   //  besk VARCHAR(300),   
    'just= "'.     addslashes($_POST['Kol5' ][$row]).'", '.   //  just VARCHAR(30),    
    'x0= "'.       addslashes($_POST['Kol6' ][$row]).'", '.   //  x0 numeric(15,3),    
    'y0= "'.       addslashes($_POST['Kol7' ][$row]).'", '.   //  y0 numeric(15,3),    
    'dx= "'.       addslashes($_POST['Kol8' ][$row]).'", '.   //  dx numeric(15,3), 
    'dy= "'.       addslashes($_POST['Kol9' ][$row]).'", '.   //  dy numeric(15,3), 
    'dim= "'.      addslashes($_POST['Kol10'][$row]).'", '.   //  dim numeric(15,3),   
    'colr= "'.     addslashes($_POST['Kol11'][$row]).'", '.   //  colr VARCHAR(30),    
    'font= "'.     addslashes($_POST['Kol12'][$row]).'", '.   //  font VARCHAR(99),    
    'style= "'.    addslashes($_POST['Kol13'][$row]).'", '.   //  style VARCHAR(99),   
    'imglnk= "'.   addslashes($_POST['Kol14'][$row]).'", '.   //  imglnk VARCHAR(99),  
    'lngkey= "'.   addslashes($_POST['Kol15'][$row]).'", '.   //  lngkey VARCHAR(300), 
    'note= "'.     addslashes($_POST['Kol16'][$row]).'"';     //  note VARCHAR(99),    
    $id= $_POST['Kol0'][$row];
    if ($row==1) $form= addslashes($_POST['Kol1' ][$row]); //  Skal benyttes ved INSERT ny rec     Den form der aktuelt redigeres.
    if ((pushed('btn_editform')) and ($row<$rowCount-1))    // Gem-knap i Panl_PrintEdit
            sql_write('UPDATE tblA_forms SET '.$assignliste.' WHERE id= '.$id, __FILE__, __LINE__);
    else 
    if ((pushed('btn_new')) and ($_POST['Kol6' ][$row]!=0))  //  Opret ikke ugyldige data
         { $assignliste= str_replace('form= ""','form= "'.$form.'"',$assignliste);    
            if ($analyse) echo '<br>INSERT INTO tblA_forms SET '.$assignliste;
            sql_creat('INSERT INTO tblA_forms SET '.$assignliste.';', __FILE__, __LINE__);
         };
    if ((pushed('btn_del_'.$i)) and ($i==$row)) //  $i tildeles værdi inden include-kald fra page_Printlayout.php
        {if ($analyse) echo ' klar til at slette '.$row.' med id:'.$id.' ';
            sql_erase('DELETE FROM tblA_forms WHERE id= "'.$id.'";', __FILE__, __LINE__);
        }
  }
  if ($analyse) echo 'Gemt. '; //  .$rowCount.' poster i databasen!';
}

?>