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
  