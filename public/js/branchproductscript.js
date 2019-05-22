$(document).ready(function() {
    $(document).on('click', '.edit-modal', function() {
        $('#footer_action_button').text("Update");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Update ' + $(this).data('name'));
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        $('#fid').val($(this).data('id'));
        $('#pumpedit_name').val($(this).data('name'));
        
        $('#myModal').modal('show');
        //console.log($(this).data('name') + $(this).data('points'));
    });
    $('.modal-footer').on('click', '.edit', function() {
  
        $.ajax({
            type: 'post',
            url: '/admin/branches/products/edit',
            data: {
                //_token:$(this).data('token'),
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'price': $('#priceedit_name').val(),
                'quantity': $('#quantityedit_name').val(),
                'productname': $('#productname').val()
            },
            success: function(data) {
                $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>"+ data.productname +"</td><td>"+ data.price +"</td><td>"+ data.quantity +"</td><td class='td-actions'><button class='edit-modal btn btn-small btn-success' data-id='" + data.id + "' data-name='" + data.pumpname + "'><i class='fa fa-pencil'> </i> Edit</button><a class='delete-modal btn btn-danger btn-small' data-id='" + data.id + "'><i class='fa fa-times'></i>  Remove</a></td></tr>");
                //console.log("success");
                  new PNotify({
                      title: 'Success',
                      text: 'Product successfully updated',
                      type: 'info',
                      delay: 2000,
                      styling: 'bootstrap3'
                  }); 
              }
              
        });
    });
    $(document).on('click', '.delete-modal', function() {
        $('#footer_action_button').text(" Delete");
        $('#footer_action_button').removeClass('glyphicon-check');
        $('#footer_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').addClass('delete');
        $('.modal-title').text('Delete');
        $('.did').text($(this).data('id'));
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        $('.dname').html($(this).data('name'));
        $('#myModal').modal('show');
    });
    $(".addbranch").click(function() {
        //console.log($(this).data('id')+" "+ $(this).data('branchid'));
        var productname = $(this).data('productname');
        $.ajax({
            type: 'post',
            url: '/admin/branches/products/add',
            data: {
                '_token': $('input[name=_token]').val(),
                'productid': $(this).data('id'),
                'branchid': $(this).data('branchid')
            },
            success: function(data) {
                if ((data.errors)){
                  $('.error').removeClass('hidden');
                    $('.error').text(data.errors.name);
                    new PNotify({
                      title: 'Error',
                      text: 'Product Already available on the Branch',
                      type: 'warning',
                      delay: 2000,
                      styling: 'bootstrap3'
                  }); 
                }
                else {
                    $('.error').addClass('hidden');
                    $('#table').append("<tr class='item" + data.id + "'><td>" + productname + "</td><td>0</td><td>0</td><button class='edit-modal btn btn-small btn-success' data-id='" + data.id + "' data-productname='" + data.productname    + "'><i class='fa fa-pencil'> </i> Update</button><td class='td-actions'><a class='delete-modal btn btn-danger btn-small' data-id='" + data.id + "'><i class='fa fa-times'> Remove</i></a></td></tr>");
                    new PNotify({
                      title: 'Success',
                      text: 'Product successfully added to Branch',
                      type: 'success',
                      delay: 2000,
                      styling: 'bootstrap3'
                  }); 
                  //console.log(data.gasid);
                  $('.productitem' + data.productid).remove();
                  }    
            },

        });
    });
      $('.modal-footer').on('click', '.delete', function() {
          $.ajax({
              type: 'post',
              url: '/admin/branches/products/delete',
              data: {
                  '_token': $('input[name=_token]').val(),
                  'id': $('.did').text()
              },
              success: function(data) {
                new PNotify({
                    title: 'Success',
                    text: 'Gastype successfully deleted',
                    type: 'danger',
                    delay: 2000,
                    styling: 'bootstrap3'
                });  
                $('.item' + data.gasid).remove();
              }
          });
      });
    
    
  });
  