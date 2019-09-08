jQuery(document).ready(function($){

  // Render insert record template

  var get_selected_section_template = function(selected_section){
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
         $('#selected-section-container').empty();
         $('#initial-selected-section').append(template_html);
       }
    });
  }

  var get_selected_sell_section_template = function(selected_section){
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
         $('#selected-section-container').empty();
         $('#selected-section-container').append(template_html);
       }
    });
  }

  $('#section-selection :radio[name="section-selection"]').change(function() {
    var selected_section = $(this).filter(':checked').val();

    get_selected_section_template(selected_section);
  });

  $(document).on('change', '#sell-section :radio[name="sell-selection"]', function() {
    var selected_section = $(this).filter(':checked').val();

    console.log(selected_section);

    get_selected_sell_section_template(selected_section);
  });


  // Cement Record

  var cement_template_html = '';

  var check_cement_payment_type_due = function(){
    var amount = $('#cement-create-record #total_quantity').val();
    var rate = $('#cement-create-record #rate').val();
    var price = $('#cement-create-record #price').val();

    if(amount && rate && price){
      var amount = parseInt(amount);
      var rate = parseInt(rate);
      var price = parseInt(price);

      var total_price = amount * rate;
      if(total_price <= price)
        return false;
      else
        return true;
    } else {
      return false;
    }
  };

  var get_cement_customer_information_template = function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    var data = {
      section: 'insert_customer_information'
    };

    $.ajax({
       type:'POST',
       url:'/get-custom-template',
       data: data,
       success:function(data){
         cement_template_html = data.content;

         $('#customer-information').empty();
         $('#customer-information').append(cement_template_html);
       }
    });
  }

  $(document).on('input', '#cement-create-record #total_quantity', function() {
      var payment_type_due = check_cement_payment_type_due();

      if(!payment_type_due){
        cement_template_html = '';
        $('#customer-information').empty();
      }

      if(payment_type_due && cement_template_html == '')
        get_cement_customer_information_template();
  });

  $(document).on('input', '#cement-create-record #rate', function() {
      var payment_type_due = check_cement_payment_type_due();

      if(!payment_type_due){
        cement_template_html = '';
        $('#cement-create-record #customer-information').empty();
      }

      if(payment_type_due && cement_template_html == '')
        get_cement_customer_information_template();
  });

  $(document).on('input', '#cement-create-record #price', function() {
      var payment_type_due = check_cement_payment_type_due();

      if(!payment_type_due){
        cement_template_html = '';
        $('#cement-create-record #customer-information').empty();
      }

      if(payment_type_due && cement_template_html == '')
        get_cement_customer_information_template();
  });

  $(document).on('submit', '#cement-record-form', function(e) {
    e.preventDefault();
    console.log('Form Submitted');

    var form = $(this);
    var url = form.attr('data-url');

    console.log('URL', url);

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      type: "POST",
      url: url,
      data: form.serialize(),
      success: function(data) {
        console.log(data);
      }
    });
  });
})
