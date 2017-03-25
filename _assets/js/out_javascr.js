$(".lablInput input").on({
										change: 		function() {  if ($(this).val() != "") {	$(this).addClass('filled');  } else {	$(this).removeClass('filled');	} },
							/*   onmouseover: function() {  if ($(this).val() != "") {	$(this).addClass('filled');  } else {	$(this).removeClass('filled');	} }, */
										mouseleave: function() {  if ($(this).val() != "") {	$(this).addClass('filled');  } else {	$(this).removeClass('filled');	} },
									/* click: 		function() {  if ($(this).val() != "") {	$(this).addClass('filled');  } else {	$(this).removeClass('filled');	} },
										onselect: 	function() {  if ($(this).val() != "") {	$(this).addClass('filled');  } else {	$(this).removeClass('filled');	} }, */
										onload: 		function() {  if ($(this).val() != "") {	$(this).addClass('filled');  } else {	$(this).removeClass('filled');	} }
});
/* Kan det ovenfor simplificeres tii:
$(".lablInput input").on({change, mouseenter, mouseleave, click, onselect, onload	:
										function() {  if ($(this).val() != "") {	$(this).addClass('filled');  } else {	$(this).removeClass('filled');	} }
});
 */
$(".lablInput textarea").on({
										change:			function() {  if ($(this).val() != "") {	$(this).addClass('filled');  } else {	$(this).removeClass('filled');  } },	
										mouseleave:	function() {  if ($(this).val() != "") {	$(this).addClass('filled');  } else {	$(this).removeClass('filled');  } },
										onload: 		function() {  if ($(this).val() != "") {	$(this).addClass('filled');  } else {	$(this).removeClass('filled');	} }
});		
$(".lablInput select").change(function() 	 {  if ($(this).val() != "") {	$(this).addClass('filled');  } else {	$(this).removeClass('filled');  }	});




$(document).ready(function() 	{									// wait for the DOM to load
  $('a.trigger').mouseover(function(e) 					// OnMouseOver event
  {
    $(this).append('<div id="tooltip">' + 
		$(this).attr('title') + '</div>'); 					// create the tooltip container
    $(this).attr('title',''); 									// empty the title attribute of the anchor (avoiding default browser reaction)
    $('#tooltip').show(); 											// show the tooltip
  }).mousemove(function(e) 											// OnMouse mode event
  {
    $('#tooltip').css('top', e.pageY + 20 ); 		// tooltip 20px below mouse pointer
    $('#tooltip').css('left', e.pageX - 100);  	// tooltip with mouse pointer  
  }).mouseout(function() 												// OnMouseOut event
  {
    $(this).attr('title',$('#tooltip').html()); // set the title back to initial value
    $(this).children('div#tooltip').remove();  	// get rid of the tooltip container  
  });
})				//	 $('a.trigger').	:	<a class="trigger" title="This is the text of a jQuery tooltip")>if you hover this text</a>
