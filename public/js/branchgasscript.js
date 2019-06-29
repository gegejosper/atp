$(document).ready(function() {
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
        var gas = $(this).data('gasname');
        $.ajax({
            type: 'post',
            url: '/admin/branches/gas/add',
            data: {
                '_token': $('input[name=_token]').val(),
                'gasid': $(this).data('id'),
                'branchid': $(this).data('branchid')
            },
            success: function(data) {
                if ((data.errors)){
                  $('.error').removeClass('hidden');
                    $('.error').text(data.errors.name);
                    new PNotify({
                      title: 'Error',
                      text: 'Gas Type Already available on the Branch',
                      type: 'warning',
                      delay: 2000,
                      styling: 'bootstrap3'
                  }); 
                }
                else {
                    $('.error').addClass('hidden');
                    $('#table').append("<tr class='item" + data.id + "'><td>" + gas + "</td><td class='td-actions'><a class='delete-modal btn btn-danger btn-small' data-id='" + data.id + "'><i class='fa fa-times'> Remove</i></a></td></tr>");
                    new PNotify({
                      title: 'Success',
                      text: 'Gas Type successfully added to Branch',
                      type: 'success',
                      delay: 2000,
                      styling: 'bootstrap3'
                  }); 
                  //console.log(data.gasid);
                  $('.gasitem' + data.gasid).remove();
                  }    
            },

        });
       
    });
    $(document).on('click', '.update-modal', function() {
        $('#footer_update_button').text("Update");
        $('#footer_update_button').addClass('glyphicon-check');
        $('#footer_update_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('update');
        $('.modal-title').text('Update Petrol');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        $('#branchgasid').val($(this).data('gasid'));
        $('#volumeedit').val($(this).data('volume'));
        $('#priceedit').val($(this).data('price'));

        $('#updateGasModal').modal('show');
        //console.log($(this).data('volume') + $(this).data('price'));
    });
    $('.modal-footer').on('click', '.update', function() {
        $.ajax({
            type: 'post',
            url: '/admin/branches/gas/update',
            data: {
                //_token:$(this).data('token'),
                '_token': $('input[name=_token]').val(),
                'id': $("#branchgasid").val(),
                'volume': $('#volumeedit').val(),
                'price': $('#priceedit').val(),
            },
            success: function(data) {
               // $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>"+ data.pumpname +"</td><td><em>reload page</em></td><td>"+ data.volume +"</td><td class='td-actions'><button class='edit-modal btn btn-xs btn-success' data-id='" + data.id + "' data-name='" + data.pumpname + "'><i class='fa fa-pencil'> </i> Update</button><a class='delete-modal btn btn-danger btn-xs' data-id='" + data.id + "'><i class='fa fa-times'></i>  Remove</a></td></tr>");
                //console.log("success");
                  new PNotify({
                      title: 'Success',
                      text: 'Petrol successfully updated',
                      type: 'info',
                      delay: 2000,
                      styling: 'bootstrap3'
                  }); 
              }
              
        });
    });
      $('.modal-footer').on('click', '.delete', function() {
          $.ajax({
              type: 'post',
              url: '/admin/branches/gas/delete',
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
                $('.item' + $('.did').text()).remove();
              }
          });
      });
    
    
  });
  