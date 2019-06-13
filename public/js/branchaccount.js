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
          $('#edit_fname').val($(this).data('fname'));
          $('#edit_lname').val($(this).data('lname'));
          $('#edit_mname').val($(this).data('mname'));
          $('#edit_address').val($(this).data('address'));
          $('#edit_tax').val($(this).data('tax'));
          $('#edit_discount').val($(this).data('discount'));
          
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
              url: '/admin/branches/accounts/edit',
              data: {
                  //_token:$(this).data('token'),
                  '_token': $('input[name=_token]').val(),
                  'id': $("#fid").val(),
                  'fname': $('#edit_fname').val(),
                  'lname': $('#edit_lname').val(),
                  'mname': $('#edit_mname').val(),
                  'address': $('#edit_address').val(),
                  'tax': $('#edit_tax').val(),
                  'discount': $('#edit_discount').val()  
              },
              success: function(data) {
                  $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>"+ data.lname + ', ' + data.fname + ' ' + data.mname +"</td><td>"
                                        + data.address +"</td><td>"+ data.discount +"</td><td>"+ data.tax +"</td><td class='td-actions'><a class='btn btn-info btn-small' href='/admin/branches/account/"+data.id+"'><i class='fa fa-search'></i>  View</a><button class='edit-modal btn btn-small btn-success' data-id='" 
                                        + data.id + "' data-fname='" + data.fname + "' data-mname ='" + data.mname +"' data-fname ='"+ data.fname +"' data-tax='"+ data.tax +"' data-discount='" + data.discount + "' data-address='" +data.address+ "' data-lname='"+ data.lname +"'><i class='fa fa-pencil'> </i> Edit</button></td></tr>");
                  //console.log("success");
                    new PNotify({
                        title: 'Success',
                        text: 'Account successfully updated',
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
              url: '/admin/branches/accounts/add',
              data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'branchid': $('#branchid').val(),
                'fname': $('#fname').val(),
                'lname': $('#lname').val(),
                'mname': $('#mname').val(),
                'address': $('#address').val(),
                'tax': $('#tax').val(),
                'discount': $('#discount').val() 
                  
              },
              success: function(data) {
                  if ((data.errors)){
                    $('.error').removeClass('hidden');
                      $('.error').text(data.errors.name);
                      new PNotify({
                        title: 'Error',
                        // text: 'Please complete the details.',
                        text: 'Please complete the details.<br>' + data.errors.fname + "<br />" + data.errors.lname + "<br />"+ data.errors.tax + "<br />" +data.errors.discount, 
                        type: 'warning',
                        delay: 2000,
                        styling: 'bootstrap3'
                    }); 
                  }
                  else {
                      $('.error').addClass('hidden');
                      $('#table').append("<tr class='item" + data.id + 
                                            "'><td>"+ data.lname + ', ' + data.fname + ', ' + data.fname +"</td><td>" + data.address + 
                                            "</td><td>"+data.discount+"</td><td>"+data.tax+"</td><td class='td-actions'><a class='btn btn-info btn-small' href='/admin/branches/account/"+data.id+
                                            "'><i class='fa fa-search'></i>  View</a><button class='edit-modal btn btn-small btn-success' data-id='" + data.id + 
                                            "' data-fname='" + data.fname + "' data-mname ='" + data.mname +"' data-fname ='"+ data.fname +"' data-tax='"+ data.tax +"' data-discount='" + data.discount + "' data-address='" +data.address+ "' data-lname='"+ data.lname +"'><i class='fa fa-pencil'> Edit</i></button><a class='delete-modal btn btn-danger btn-small' data-id='" + data.id + 
                                            "'><i class='fa fa-times'> Remove</i></a></td></tr>");
                      new PNotify({
                        title: 'Success',
                        text: 'Branch user successfully Added',
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
              url: '/admin/branches/accounts/delete',
              data: {
                  '_token': $('input[name=_token]').val(),
                  'id': $('.did').text()
              },
              success: function(data) {
                new PNotify({
                    title: 'Success',
                    text: 'Account successfully deleted',
                    type: 'danger',
                    delay: 2000,
                    styling: 'bootstrap3'
                });  
                $('.item' + $('.did').text()).remove();
              }
          });
      });
  });
  