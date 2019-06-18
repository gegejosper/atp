$(document).ready(function() {
    $("#gastype").change(function () {
        var gas = $('select[name=gastype]').val();
         var array = gas.split(',');
         var gasid = array[0];
         var gasname = array[1]; 
         var gasvolume = array[2]; 
       $('#gasid').val(gasid);
       $('#namegas').val(gasname);
       $('#dipopenvolume').val(gasvolume);
        console.log('sss');
    });
    $(document).on('click', '.edit-modal', function() {
          $('#footer_action_button').text("Update");
          $('#footer_action_button').addClass('glyphicon-check');
          $('#footer_action_button').removeClass('glyphicon-trash');
          $('.actionBtn').addClass('btn-success');
          $('.actionBtn').removeClass('btn-danger');
          $('.actionBtn').addClass('edit');
          $('.modal-title').text('Update Pump');
          $('.deleteContent').hide();
          $('.form-horizontal').show();
          $('#fid').val($(this).data('id'));
          $('#pumpedit_name').val($(this).data('name'));
          $('#volumeedit').val($(this).data('volume'));
          $('#gasname').val($(this).data('gasname'));
          
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
                  'pumpname': $('#pumpedit_name').val(),
                  'volume': $('#volumeedit').val(),
                  'gasname': $('#gasname').val()
              },
              success: function(data) {
                  $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>"+ data.pumpname +"</td><td><em>reload page</em></td><td>"+ data.volume +"</td><td class='td-actions'><button class='edit-modal btn btn-xs btn-success' data-id='" + data.id + "' data-name='" + data.pumpname + "'><i class='fa fa-pencil'> </i> Update</button><a class='delete-modal btn btn-danger btn-xs' data-id='" + data.id + "'><i class='fa fa-times'></i>  Remove</a></td></tr>");
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
        var gas = $('select[name=gastype]').val();
        var array = gas.split(',');
        var gasid = array[0];
        var gasname = array[1];
        var gasvolume = array[2]; 
        var dippingtype = $( 'input[name=dippingtype]:checked' ).val();
          $.ajax({
              type: 'post',
              url: '/admin/branches/dipping/add',
              data: {
                  '_token': $('input[name=_token]').val(),
                  'dipopenvolume': $('input[name=dipopenvolume]').val(),
                  'dipclosevolume': $('input[name=dipclosevolume]').val(),
                  'dippingdate': $('input[name=dippingdate]').val(),
                  'branchid': $('input[name=branchid]').val(),
                  'gasid': gasid,
                  'gasname': gasname
              },
              success: function(data) {
                  if ((data.errors)){
                    $('.error').removeClass('hidden');
                      $('.error').text(data.errors.name);
                      new PNotify({
                        title: 'Error',
                        text: 'Please enter Enter Dipping Volume',
                        type: 'warning',
                        delay: 2000,
                        styling: 'bootstrap3'
                    }); 
                  }
                  else {
                      $('.error').addClass('hidden');
                      $('#table').append("<tr class='dippingitem" + data.id + "'><td>"+ data.gasname +"</td><td>" + data.dipopenvolume + " <em> Ltrs.</em> </td><td>" + data.dipclosevolume + "<em> Ltrs.</em> </td><td>" + data.dipvolume + "<em> Ltrs.</em></td><td class='td-actions'><a class='delete-modal btn btn-danger btn-xs' data-id='" + data.id + "'><i class='fa fa-times'></i></a></td></tr>");
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
          $('#dipopenvolume').val('');
          $('#dipclosevolume').val('');
          $('#gastype option:selected').removeAttr('selected');
          $('#norecord').remove();
      });
      $('.modal-footer').on('click', '.delete', function() {
          $.ajax({
              type: 'post',
              url: '/admin/branches/dipping/delete',
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
                $('.dippingitem' + $('.did').text()).remove();
              }
          });
      });
  });
  