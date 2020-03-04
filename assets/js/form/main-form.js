var formSubmit = false;
$("form input, form textarea, form select").change(function() {
  $(this).closest('form').attr('changed', true);
});
$('form').submit(function(){
  formSubmit = true;
});

$(window).bind('beforeunload', function(e){
  if(!formSubmit){
    if($('form').attr('changed')) {
      return true;
    } else e=null; // i.e; if form state change show box not.
  }  else e=null;

});
