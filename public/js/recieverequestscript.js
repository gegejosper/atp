$(document).ready(function() {
    $(document).on('click', '.addquantity-modal', function() {
          $('#footer_action_button').text("Add to Quantity");
          $('.actionBtn').addClass('btn-success');
          $('.actionBtn').removeClass('btn-danger');
          $('.actionBtn').addClass('request');
          $('.modal-title').text('Add Quantity');
          $('.deleteContent').hide();
          $('.form-horizontal').show();
          $('#fid').val($(this).data('id'));
          $('.gasname').text($(this).data('gasname'));
          $('.gasname').text($(this).data('gasname'));
          $('#myModal').modal('show');
    });
    $('.modal-footer').on('click', '.request', function() {
        $.ajax({
            type: 'post',
            url: '/admin/order/addquantityrecieve',
            data: {
                //_token:$(this).data('token'),
                '_token': $('input[name=_token]').val(),
                'recdate': $('#addpurchasedate').val(),
                'recievequantity': $('#recievequantity').val(),
                'gasname': $('#gasname').val(),
                'purreqid': $('#fid').val()
            },
            success: function(data) {
                $('#row' + data.id).replaceWith("<tr id='row" + data.id + "'><td>"+ data.gasname +"</td><td class='td-actions'><button class='editrecieve-modal btn btn-small btn-success' data-id='" + data.id + "' data-gasname='" + $('#gasname').val() + "'><i class='fa fa-pencil'> </i> Update</button></td></tr>");
                console.log(data);
                  new PNotify({
                      title: 'Success',
                      text: 'Recieve quantity added.',
                      type: 'info',
                      delay: 2000,
                      styling: 'bootstrap3'
                  }); 
              
              }
        });
    });
});
  