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
          $('#recquantity').val($(this).data('recquantity'));
          $('.gasname').text($(this).data('gasname'));
          $('#gasnamevalue').val($(this).data('gasname'));
          $('#myModal').modal('show');
    });
    $('.modal-footer').on('click', '.request', function() {
        $.ajax({
            type: 'post',
            url: '/incharge/order/addquantityrecieve',
            data: {
                //_token:$(this).data('token'),
                '_token': $('input[name=_token]').val(),
                'recdate': $('#addpurchasedate').val(),
                'recquantity': $('#recquantity').val(),
                'recievequantity': $('#recievequantity').val(),
                'unitprice': $('#unitprice').val(),
                'gasname': $('#gasnamevalue').val(),
                'purreqid': $('#fid').val()
            },
            success: function(data) {
                $('#row' + data.id).replaceWith("<tr id='row" + data.id + "'><td>"+ data.gasname +"</td><td>"+ data.reqquantity +"</td><td>"+ data.recquantity +"</td><td class='td-actions'><button class='addquantity-modal btn btn-small btn-success' data-id='" + data.id + "' data-gasname='" + data.gasname + "' data-recquantity='"+data.reqquantity+"'><i class='fa fa-pencil'> </i> Update</button></td></tr>");
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
  