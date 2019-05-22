$(document).ready(function() {
    $(document).on('click', '.edit-modal', function() {
          $('#footer_action_button').text("Update");
          $('#footer_action_button').addClass('glyphicon-check');
          $('#footer_action_button').removeClass('glyphicon-trash');
          $('.actionBtn').addClass('btn-success');
          $('.actionBtn').removeClass('btn-danger');
          $('.actionBtn').addClass('edit');
          $('.modal-title').text('Edit');
          $('.deleteContent').hide();
          $('.form-horizontal').show();
          $('#fid').val($(this).data('id'));
          $('#pumpedit_name').val($(this).data('name'));
          
          $('#myModal').modal('show');
          //console.log($(this).data('name') + $(this).data('points'));
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
  
      $('.modal-footer').on('click', '.edit', function() {
  
          $.ajax({
              type: 'post',
              url: '/admin/branches/pumps/edit',
              data: {
                  //_token:$(this).data('token'),
                  '_token': $('input[name=_token]').val(),
                  'id': $("#fid").val(),
                  'pumpname': $('#pumpedit_name').val()
              },
              success: function(data) {
                  $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>"+ data.pumpname +"</td><td> reload page</td><td class='td-actions'><button class='edit-modal btn btn-xs btn-success' data-id='" + data.id + "' data-name='" + data.pumpname + "'><i class='fa fa-pencil'> </i> Update</button><a class='delete-modal btn btn-danger btn-small' data-id='" + data.id + "'><i class='fa fa-times'></i>  Remove</a></td></tr>");
                  //console.log("success");
                    new PNotify({
                        title: 'Success',
                        text: 'Pump Name successfully updated',
                        type: 'info',
                        delay: 2000,
                        styling: 'bootstrap3'
                    }); 
                }
                
          });
      });
      $("#add").click(function() {
  
          $.ajax({
              type: 'post',
              url: '/admin/branches/pumps/add',
              data: {
                  '_token': $('input[name=_token]').val(),
                  'pumpname': $('input[name=pumpname]').val(),
                  'branchid': $('input[name=branchid]').val(),
                  'gasid': $('select[name=gastype]').val()
              },
              success: function(data) {
                  if ((data.errors)){
                    $('.error').removeClass('hidden');
                      $('.error').text(data.errors.name);
                      new PNotify({
                        title: 'Error',
                        text: 'Please enter Pump Name',
                        type: 'warning',
                        delay: 2000,
                        styling: 'bootstrap3'
                    }); 
                  }
                  else {
                      $('.error').addClass('hidden');
                      $('#table').append("<tr class='item" + data.id + "'><td>"+ data.pumpname +"</td><td>" + data.gasid + "</td><td class='td-actions'><button class='edit-modal btn btn-small btn-success' data-id='" + data.id + "' data-name='" + data.pumpname + "'><i class='fa fa-pencil'> Edit</i></button><a class='delete-modal btn btn-danger btn-small' data-id='" + data.id + "'><i class='fa fa-times'> Remove</i></a></td></tr>");
                      new PNotify({
                        title: 'Success',
                        text: 'Pump successfully Added',
                        type: 'success',
                        delay: 2000,
                        styling: 'bootstrap3'
                    }); 
                    }
                  
              },
  
          });
          $('#name').val('');
      });
      $('.modal-footer').on('click', '.delete', function() {
          $.ajax({
              type: 'post',
              url: '/admin/branches/pumps/delete',
              data: {
                  '_token': $('input[name=_token]').val(),
                  'id': $('.did').text()
              },
              success: function(data) {
                new PNotify({
                    title: 'Success',
                    text: 'Pump successfully deleted',
                    type: 'danger',
                    delay: 2000,
                    styling: 'bootstrap3'
                });  
                $('.item' + $('.did').text()).remove();
              }
          });
      });
  });
  