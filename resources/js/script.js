jQuery(document).ready(function($){
  var get_selected_template = function(selected_section){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    var data = {
      section: selected_section
    };

    $.ajax({
       type:'POST',
       url:'/get-custom-template',
       data: data,
       success:function(data){
         var template_html = data.content;
         $('#initial-selected-section').empty();
         $('#initial-selected-section').append(template_html);
       }
    });
  }

  $('#section-selection :radio[name="section-selection"]').change(function() {
    var selected_section = $(this).filter(':checked').val();

    get_selected_template(selected_section);
  });
})
