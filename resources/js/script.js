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

  var set_autocomplete_user_details = function(ul, item) {
    if(item.mobile && item.address){
      return $('<li>')
          .attr( "data-value", item.value )
          .addClass('customer-autocomplete-li')
          .append('<div class="card autocomplete-customer-card"><div class="card-body autocomplete-customer-container"><h5 class="card-title">' +
          item.label + '</h5><h6 class="card-subtitle mb-2">' +
          item.mobile + '</h6><p>' + item.address + '<p></div></div>')
          .appendTo(ul);
    } else if(item.mobile) {
      return $('<li>')
          .attr( "data-value", item.value )
          .addClass('customer-autocomplete-li')
          .append('<div class="card autocomplete-customer-card"><div class="card-body autocomplete-customer-container"><h5 class="card-title">' +
          item.label + '</h5><h6 class="card-subtitle mb-2">' +
          item.mobile + '</h6></div></div>')
          .appendTo(ul);
    } else if(item.address) {
      return $('<li>')
          .attr( "data-value", item.value )
          .addClass('customer-autocomplete-li')
          .append('<div class="card autocomplete-customer-card"><div class="card-body autocomplete-customer-container"><h5 class="card-title">' +
          item.label + '</h5><p>' + item.address + '<p></div></div>')
          .appendTo(ul);
    } else {
      return $('<li>')
          .attr( "data-value", item.value )
          .addClass('customer-autocomplete-li')
          .append('<div class="card autocomplete-customer-card"><div class="card-body autocomplete-customer-container"><h5 class="card-title">' +
          item.label + '</h5></div></div>')
          .appendTo(ul);
    }
  }

  var get_existing_customer_information = function(user_id){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    var data = {
      user_id: user_id
    };

    $.ajax({
       type:'POST',
       url:'/get-existing-user-information',
       data: data,
       success:function(data){
         var current_user_template_html = data.content;

         $('#customer-information').empty();
         $('#customer-information').append(current_user_template_html);
       }
    });
  }

  var autocompleteOptions = {
    delay: 500,
    source: function(request, response) {
      $.ajax({
        type: "GET",
        url: "autocomplete",
        data: { query: request.term },
        success: function(data) {
          $('#current-user-id').val('');
          response(data);
        }
      });
    },
    create: function( event, ui ) {
      $(this).data('ui-autocomplete')._renderItem = function (ul, item) {
        return set_autocomplete_user_details(ul, item);
      };
    },
    select: function (event, ui) {
      $('#customer_name').val( ui.item.label );
      $(this).val( ui.item.label );
      $(this).prop('disabled', true);
      $('#current-user-id').val(ui.item.value);
      get_existing_customer_information(ui.item.value);
      return false;
    }
  };

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

         $('#selected-section-container')
         .find("#cement-create-record #customer_name")
         .autocomplete(autocompleteOptions).off('blur').on('blur', function() {
            if(document.hasFocus()) {
                $('ul.ui-autocomplete').hide();
            }
         });
       }
    });
  }

  $('#section-selection :radio[name="section-selection"]').change(function() {
    var selected_section = $(this).filter(':checked').val();

    get_selected_section_template(selected_section);
  });

  $(document).on('change', '#sell-section :radio[name="sell-selection"]', function() {
    var selected_section = $(this).filter(':checked').val();

    get_selected_sell_section_template(selected_section);
  });


  // Sell Cement Record

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
    if ($('#current-user-id').val().length != 0){
      return false;
    }

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

         if( $('#customer-information').length ) {
           $('#customer-information').empty();
         }

         $('#customer-information').append(cement_template_html);
       }
    });
  }

  var render_due_customer_information = function(){
    var payment_type_due = check_cement_payment_type_due();

    if(!payment_type_due){
      $('#customer-information').empty();
    } else {
      get_cement_customer_information_template();
    }
  }

  $(document).on('input', '#cement-create-record #total_quantity', function() {
    if ($('#current-user-id').val().length != 0){
      return false;
    }

    render_due_customer_information();
  });

  $(document).on('input', '#cement-create-record #rate', function() {
    if ($('#current-user-id').val().length != 0){
      return false;
    }

    render_due_customer_information();
  });

  $(document).on('input', '#cement-create-record #price', function() {
    if ($('#current-user-id').val().length != 0){
      return false;
    }

    render_due_customer_information();
  });

  $(document).on('submit', '#cement-record-form', function(e) {
    e.preventDefault();

    var form = $(this);
    var url = form.attr('data-url');

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
        if(data.success){
          $('#cement-record-success').removeClass('invisible');
          $('#cement-record-success').addClass('visible');

          $('#customer_name').prop('disabled', false);

          $( form ).each(function(){
              this.reset();
          });

          $('#customer-information').empty();
        }
      }
    });
  });

  $(document).on('click', '#cement-create-record #reset-customer-name', function(e){
    e.preventDefault();
    $('#customer-information').empty();
    $("#cement-create-record #customer_name").prop('disabled', false);
    $('#current-user-id').val('');
    $("#cement-create-record #customer_name").val('');

    render_due_customer_information();
  })

  $("#cement-create-record #customer_name").autocomplete(autocompleteOptions);

})
