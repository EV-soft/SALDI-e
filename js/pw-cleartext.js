$(function(){
  $(document).ready(function(){
    $(".js-password").each(function(){
      var $input=$(this), $hideShowLink=$('<span class="js-password-hide-show">Vis!</span>');
      $hideShowLink.on('click', function(e){ e.preventDefault();
        var inputType=$input.attr("type");
        "text"==inputType?($input.attr("type","password"),$hideShowLink.text("Vis ")):($input.attr("type","text"),$hideShowLink.text("Skjul")),$input.focus()}),$input.parent().append($hideShowLink)
    }) 
  })
})