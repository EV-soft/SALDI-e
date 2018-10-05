<?php   $DocFil= '../_base/htm_Tableinit.php';   $DocVer='5.0.0';    $DocRev='2018-10-02';   $DocIni='evs';  $ModulNr=0;
/* ## Purpose: 'Initiering af Tablesorter-system'; * Kilde: https://github.com/Mottie/tablesorter
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * ## LICENS & Copyright (c) 2004-2018 Saldi.dk ApS *** Se filen: ../LICENS_Copyright.txt
 *
  Oprettet: 2018-04-00 evs - EV-soft
  Includeres i HEAD
  Ændrings-Log:
    
 *    
 */
 
/*
## Tablesorters indstillinger andre steder:
# i pagePrepare:  $path= './../_assets/tablesorter/';
# i pagePrepare:  // choose a theme file:
# i pagePrepare:  echo '<link rel="stylesheet" href="'.$path.'css/theme.blue.css">';
# i pagePrepare:  
# i pagePrepare:  // Tablesorter script: required 
# i pagePrepare:  echo '	<script src="'.$path.'docs/js/jquery-latest.min.js"></script>';
# i pagePrepare:  echo '	<script src="'.$path.'js/jquery.tablesorter.js"></script>';
# i pagePrepare:  echo '	<script src="'.$path.'js/widgets/widget-filter.js"></script>';
# i pagePrepare:  echo '	<script src="'.$path.'js/widgets/widget-stickyHeaders.js"></script>';
*/
?>
 
<script>
  $(function () {
    $('table').tablesorter({
      theme: 'blue',
   // showProcessing : true, 
      widgets: ['zebra', 'stickyHeaders', 'filter'],  
      widgetOptions: {
        stickyHeaders: '',                  // extra class name added to the sticky header row  
        stickyHeaders_offset: 0,            // number or jquery selector targeting the position:fixed element  
        stickyHeaders_cloneId: '-sticky',   // added to table ID, if it exists  
        stickyHeaders_addResizeEvent: true, // trigger "resize" event on headers  
        stickyHeaders_includeCaption: true, // if false and a caption exist, it won't be included in the sticky header  
        stickyHeaders_zIndex: 2,            // The zIndex of the stickyHeaders, allows the user to adjust this to their needs  
        stickyHeaders_attachTo: '.wrapper', // jQuery selector or object to attach sticky header to  
        stickyHeaders_xScroll: null,        // jQuery selector or object to monitor horizontal scroll position (defaults: xScroll > attachTo > window)  
        stickyHeaders_yScroll: null,        // jQuery selector or object to monitor vertical scroll position (defaults: yScroll > attachTo > window)  
        stickyHeaders_filteredToTop: true,  // scroll table top into view after filtering  
     // filter_columnFilters : false,
        filter_hideFilters : true,
        filter_reset : '.reset',
        filter_functions: {
          0: {
            '{empty}' : function (e, n, f, i, $r, c) {
              return $.trim(e) === '';
            }
          }
        },
        filter_selectSource: {
          0: function (table, column, onlyAvail) {  // get an array of all table cell contents for a table column  
            var array = $.tablesorter.filter.getOptions(table, column, onlyAvail);
            array.push('{empty}');          //  manipulate the array as desired, then return it  
            return array;
          }
        } //,
          // filter_cellFilter: {[]}
          // filter_cellFilter : "tablesorter-filter-cell"
      }
    });
    /*
columnSelector_columns : {
    5 : false,
    6 : false
} */
    // make second table scroll within its wrapper
    $('#smarttabel, #table0, #table1, #table2, #table3, #table4, #table5, #table6').tablesorter({
      widthFixed : true,
      headerTemplate : '{content} {icon}',  /* Add icon for various themes */
      widgets: [ 'zebra', 'stickyHeaders', 'filter' ],
      widgetOptions: {
			// jQuery selector or object to attach sticky header to
			stickyHeaders_attachTo : '.wrapper' // or $('.wrapper')
		}
    });
  });


  /*  assign the sortStart event */
  $("table").bind("sortStart", function() {
      $("#overlay").height($(this).outerHeight()).show();
  }).bind("sortEnd", function() {
      $("#overlay").hide();
  });

  $(function() {
    window.includeCaption = true;
    $('.caption').on('click', function() {
      includeCaption = !includeCaption;
      $(this).html( '' + includeCaption );
      $('#smarttabel, #table0, #table1, #table2, #table3, #table4, #table5, #table6, .nested').each(function() {
        if (this.config) {
          this.config.widgetOptions.stickyHeaders_includeCaption = includeCaption;
          this.config.widgetOptions.$sticky.children('caption').toggle(includeCaption);
        }
      });
    });

    /*  removed jQuery UI theme because of the accordion! */
    $('link.theme').each(function() { this.disabled = true; });
  });
</script>
 
<style>
 /* Globale konstanter/variabler: */ 
:root {
  --creaInpBg: #ffffcc;  /* Create input #ffffcc; Yellow-light */           
}      
 /* Specielle tilretninger: */ 
th input,
tfoot input {
  padding-left:4px; 
  margin-left:2px; 
  height:18px;
}

td input,
input[type=text] {
    padding:3px; 
    /* 
    border:1px solid #ccc;
    -webkit-border-radius: 5px;
    border-radius: 3px; */
}
input[type=text]:focus {
    border-color:#222;
}

tfoot input {
  background: var(--creaInpBg);
}

.tablesorter-blue tfoot td {   /* footer */ 
	font: 12px/18px Arial, Sans-serif;
	font-weight: bold;
	color: #000;
	background-color: #99bfe6;
	border-collapse: collapse;
	padding: 2px;
	text-shadow: 0 1px 0 rgba(204, 204, 204, 0.7);
}
.tablesorter .tablesorter-filter {  /* Forebygger utilsigtet min-width af filter-felter */
    width: 100%;
}
</style>

<style id="css">  /* wrapper of table  */ 
.wrapper {
	position: relative;
  display: block;
	padding: 0 5px;
	height: 300px;   /* Justeres i HTML: $ViewHeight */
	overflow-y: auto;
}

#overlay {
    background: rgba(244,244,244,0.8) url(http: /* mottie.github.com/tablesorter/addons/pager/icons/loading.gif) center center no-repeat; */
    position: absolute;
    z-index: 1000;
    display: none;
    width: 100%;
    height: auto;
    margin: 0;
    top: 0;
    left: 0;
}

$('#smarttabel, #table0, #table1, #table2, #table3, #table4, #table5, #table6').tablesorter-blue input.tablesorter-filter, .tablesorter-blue select.tablesorter-filter {
  width: 99%;
  height: auto;
  margin: 0;
  padding: 1px;
}    
</style>
