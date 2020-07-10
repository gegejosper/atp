$(document).ready(function() {
    $(document).on('click', '.addquantity-modal', function() {
          $('#footer_action_button').text("Add Unit Price");
          $('.actionBtn').addClass('btn-success');
          $('.actionBtn').removeClass('btn-danger');
          $('.actionBtn').addClass('request');
          $('.modal-title').text('Add Unit Price');
          $('.deleteContent').hide();
          $('.form-horizontal').show();
          $('#fid').val($(this).data('id'));
          $('#recquantity').val($(this).data('recquantity'));
          $('#recievequantity').val($(this).data('recievequantity'));
          $('.gasname').text($(this).data('gasname'));
          $('#gasname').val($(this).data('gasname'));
          $('#myModal').modal('show');
    });
    $('.modal-footer').on('click', '.request', function() {
        $.ajax({
            type: 'post',
            url: '/admin/order/addunitprice',
            data: {
                //_token:$(this).data('token'),
                '_token': $('input[name=_token]').val(),
                'recdate': $('#addpurchasedate').val(),
                'recquantity': $('#recquantity').val(),
                'recievequantity': $('#recievequantity').val(),
                'unitprice': $('#unitprice').val(),
                'gasname': $('#gasname').val(),
                'purreqid': $('#fid').val()
            },
            success: function(data) {
                var amount = data.recievequantity * data.price;
                $('#row' + data.id).replaceWith("<tr id='row" + data.id + "'><td>"+ data.gasname +"</td><td>"+ data.reqquantity +"</td><td>"+ data.recievequantity +"</td><td>"+ data.price +"</td><td>"+ amount +"</td><td class='td-actions'><button class='addquantity-modal btn btn-small btn-success' data-id='" + data.id + "' data-gasname='" + data.gasname + "' data-recquantity='"+data.reqquantity+"'><i class='fa fa-pencil'> </i> Update</button></td></tr>");
                console.log(data);
                  new PNotify({
                      title: 'Success',
                      text: 'Unit price added',
                      type: 'info',
                      delay: 2000,
                      styling: 'bootstrap3'
                  }); 
              
              }
        });
    });
});
  