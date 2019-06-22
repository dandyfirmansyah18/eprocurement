function page_ready() {

  $('#trg_savedata').on('click', function(event){
    event.preventDefault();
  });

  $('#trg_back').on('click', function(event){
    $('form#form-logout').submit();
    event.preventDefault();
  });
}

$(document).ready(function(){
  page_ready();

  $('.dropzone').each(function(){
    var $el = $(this);
    $el.parent().next().next().remove();
    $(this).remove();
  });

  $('.select2-list').each(function(){
    $(this).attr('disabled', 'disabled');
  });

  $('.input-group.date').each(function(){
    $(this).attr('disabled', 'disabled');
  });
});