$(document).ready(function() {
    $(document).on('click', '.request-modal', function() {
          $('#footer_action_button').text("Add to Request");
          $('.actionBtn').addClass('btn-success');
          $('.actionBtn').removeClass('btn-danger');
          $('.actionBtn').addClass('request');
          $('.modal-title').text('Add Request');
          $('.deleteContent').hide();
          $('.generateContent').hide();
          $('.form-horizontal').show();
          $('#fid').val($(this).data('id'));
          $('.productname').text($(this).data('productname'));
          $('#myModal').modal('show');
          //console.log($(this).data('name') + $(this).data('points'));
      });
      $(document).on('click', '.delete-modal', function() {
          $('#footer_action_button').text(" Delete");
          $('.actionBtn').removeClass('btn-success');
          $('.actionBtn').addClass('btn-danger');
          $('.actionBtn').addClass('delete');
          $('.modal-title').text('Delete');
          $('.did').text($(this).data('id'));
          $('.deleteContent').show();
          $('.generateContent').hide();
          $('.form-horizontal').hide();
          $('.dname').html($(this).data('name'));
          $('#myModal').modal('show');
      });
      $(document).on('click', '.generate-modal', function() {
        $('#footer_action_button').text("Generate");        
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').addClass('generate');
        $('.modal-title').text('Generate Purchase Order');
        $('.purchasenumber').text($(this).data('purchasenumber'));
        $('.generateContent').show();
        $('.deleteContent').hide();
        $('.form-horizontal').hide();
        $('.dname').html($(this).data('name'));
        $('#myModal').modal('show');
    });
  
      $('.modal-footer').on('click', '.request', function() {
  
          $.ajax({
              type: 'post',
              url: '/admin/order/addquantityrequest',
              data: {
                  //_token:$(this).data('token'),
                  '_token': $('input[name=_token]').val(),
                  'purchasenumber': $('#addpurchasenumber').val(),
                  'date': $('#addpurchasedate').val(),
                  'quantity': $('#quantity').val(),
                  'price': $('#price').val(),
                  'skuid': $('#skuid').val(),
                  'itemid': $('#fid').val()
              },
              success: function(data) {
                // $('.modal-title').text('Stock Updated');
                // $('#CartInfo').modal('show');
                location.reload();
                }
          });
      });
      
      $('.modal-footer').on('click', '.delete', function() {
          $.ajax({
              type: 'post',
              url: '/admin/purchase/deletequantityrequest',
              data: {
                  '_token': $('input[name=_token]').val(),
                  'id': $('.did').text()
              },
              success: function(data) {
                location.reload();
              }
          });
      });

      $('.modal-footer').on('click', '.generate', function() {
        $.ajax({
            type: 'post',
            url: '/admin/order/generatepurchaseorder',
            data: {
                '_token': $('input[name=_token]').val(),
                'purchasenumber': $('.purchasenumber').text()
            },
            success: function(data) {
                window.location.href = '/admin/order/history/' + $('.purchasenumber').text(); 
            }
        });
    });
  });
  