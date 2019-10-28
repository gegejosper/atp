$(document).ready(function() {
    $("#accountsale").hide();
    $("#paymentoption input").change(function() {
        var val = $("input[name=payment]:checked").val();  
        if(val != undefined) {
            if (val == "CREDIT") {
            $("#accountsale").show();
            } else {
            $("#accountsale").hide();
            }
            //console.log('dsads');
        }
        //console.log('dsads');
    });
    $(".branchgascredit").change(function () {
        var gas = $('select[name=branchgas]').val();
         var array = gas.split(',');
         var gasname = array[0];
         var gasid = array[1]; 
         var gasprice = array[2]; 
       $('#creditunitprice').val(gasprice);
    });
    $(".salebranchproduct").change(function () {
        var product = $('select[name=salebranchproduct]').val();
         var array = product.split(',');
         var productname = array[0];
         var productid = array[1]; 
         var productprice = array[2]; 
       $('#saleprice').val(productprice);
    });
    $('#creditliters').keyup(function() {  
        updateCreditAmount();
    });
      var updateCreditAmount = function () {
      var creditliters = parseFloat($('#creditliters').val()).toFixed(2);
      var creditunitprice = parseFloat($('#creditunitprice').val()).toFixed(2);
      var creditamount = creditliters *  creditunitprice;
        $('#creditamount').val(parseFloat(creditamount).toFixed(3));
    };

    $('#salequantity').keyup(function() {  
        updateSaleAmount();
    });
      var updateSaleAmount = function () {
      var salequantity = parseFloat($('#salequantity').val()).toFixed(2);
      var saleprice = parseFloat($('#saleprice').val()).toFixed(2);
      var saleamount = salequantity *  saleprice;
        $('#saleamount').val(parseFloat(saleamount).toFixed(3));
    };
      $("#creditadd").click(function() {
          $.ajax({
              type: 'post',
              url: '/incharge/dashboard-creditadd',
              data: {
                  '_token': $('input[name=_token]').val(),
                  'invoice': $('input[name=creditinvoicenum]').val(),
                  'account': $('select[name=accountcredit]').val(),
                  'gasname': $('#branchgas').val(),
                  'creditliters': $('input[name=creditliters]').val(),
                  'branchid': $('input[name=branchid]').val(),
                  'creditplatenum': $('input[name=creditplatenum]').val(),
                  'creditamount': $('input[name=creditamount]').val(),
                  'unitprice': $('input[name=creditunitprice]').val(),
                  'creditdate': $('input[name=creditdate]').val()
              },
              success: function(data) {
                  if ((data.errors)){
                    $('.error').removeClass('hidden');
                      $('.error').text(data.errors.name);
                      new PNotify({
                        title: 'Error',
                        text: 'Please complete the details.',
                        type: 'warning',
                        delay: 2000,
                        styling: 'bootstrap3'
                    }); 
                  }
                  else {
                      $('.error').addClass('hidden');
                      var gasnameValue = data.gasname;
                      var gasname = gasnameValue.split(',');
                      var accountValue = data.account;
                      var account = accountValue.split(',');
                      
                      $('#credittable').append("<tr class='credititem" + data.id + "'><td>"+ data.invoice  +"</td><td>" + account[0] + ", " + account[1] +" </td><td>" + gasname[0]+ " </td><td>" + data.creditplatenum + "</td><td>" + data.liters + "</td><td>" + data.unitprice + "</td><td>" + data.amount + "</td><td class='td-actions'><a class='delete-credit btn btn-danger btn-xs' data-id='" + data.id + "'><i class='fa fa-times'></i></a></td></tr>");
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
          $('#creditinvoicenum').val('');
          $('#creditplatenum').val('');
          $('#creditliters').val('0');
          $('#creditamount').val('0');
          $('#accountcredit option:selected').removeAttr('selected');
          $('#branchgas option:selected').removeAttr('selected');
          $('#nocreditrecord').remove();
      });

      $(document).on('click', '.delete-credit', function() {
        $('#footer_action_button').text(" Delete");
        $('#footer_action_button').removeClass('glyphicon-check');
        $('#footer_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').removeClass('discountdelete');
        $('.actionBtn').removeClass('saledelete');
        $('.actionBtn').removeClass('otherdelete');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').addClass('creditdelete');
        $('.modal-title').text('Delete');
        $('.did').text($(this).data('id'));
        $('.deleteContent').show();
        $('.dname').html($(this).data('name'));
        $('#myModal').modal('show');
     }); 
    $('.modal-footer').on('click', '.creditdelete', function() {
          $.ajax({
              type: 'post',
              url: '/incharge/dashboard-creditdelete',
              data: {
                  '_token': $('input[name=_token]').val(),
                  'id': $('.did').text()
              },
              success: function(data) {
                new PNotify({
                    title: 'Success',
                    text: 'Credit record deleted',
                    type: 'danger',
                    delay: 2000,
                    styling: 'bootstrap3'
                });  
                $('.credititem' + $('.did').text()).remove();
              }
            });
      });
      $("#discountadd").click(function() {
          //console.log('cdsada');
        $.ajax({
            type: 'post',
            url: '/incharge/dashboard-discountadd',
            data: {
                '_token': $('input[name=_token]').val(),
                'account': $('select[name=accountdis]').val(),
                'gasname': $('#branchgasdis').val(),
                'branchid': $('input[name=branchid]').val(),
                'displatenum': $('input[name=displatenum]').val(),
                'disamount': $('input[name=disamount]').val(),
                'disdate': $('input[name=disdate]').val()
            },
            success: function(data) {
                if ((data.errors)){
                  $('.error').removeClass('hidden');
                    $('.error').text(data.errors.name);
                    new PNotify({
                      title: 'Error',
                      text: 'Please complete the details.',
                      type: 'warning',
                      delay: 2000,
                      styling: 'bootstrap3'
                  }); 
                }
                else {
                    $('.error').addClass('hidden');
                    var gasnameValue = data.gasname;
                    var gasname = gasnameValue.split(',');
                    var accountValue = data.account;
                    var account = accountValue.split(',');
                    
                    $('#discounttable').append("<tr class='credititem" + data.id + "'><td>" + account[0] + ", " + account[1] +" </td><td>" + gasname[0]+ " </td><td>" + data.platenum + "</td><td>" + data.amount + "</td><td class='td-actions'><a class='delete-discount btn btn-danger btn-xs' data-id='" + data.id + "'><i class='fa fa-times'></i></a></td></tr>");
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
        
        $('#displatenum').val('');
        $('#disamount').val('0');
        $('#creditamount').val('0');
        $('#accountdis option:selected').removeAttr('selected');
        $('#branchgasdis option:selected').removeAttr('selected');
        $('#nodiscountrecord').remove();
    });
    $(document).on('click', '.delete-discount', function() {
        $('#footer_action_button').text(" Delete");
        $('#footer_action_button').removeClass('glyphicon-check');
        $('#footer_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').removeClass('creditdelete');
        $('.actionBtn').removeClass('saledelete');
        $('.actionBtn').removeClass('otherdelete');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').addClass('discountdelete');
        $('.modal-title').text('Delete');
        $('.did').text($(this).data('id'));
        $('.deleteContent').show();
        $('.dname').html($(this).data('name'));
        $('#myModal').modal('show');
     }); 
    $('.modal-footer').on('click', '.discountdelete', function() {
          $.ajax({
              type: 'post',
              url: '/incharge/dashboard-discountdelete',
              data: {
                  '_token': $('input[name=_token]').val(),
                  'id': $('.did').text()
              },
              success: function(data) {
                new PNotify({
                    title: 'Success',
                    text: 'Discount record deleted',
                    type: 'danger',
                    delay: 2000,
                    styling: 'bootstrap3'
                });  
                $('.discountitem' + $('.did').text()).remove();
              }
            });
      });
////////// Sales JS Code

    $("#salesadd").click(function() {
        $.ajax({
            type: 'post',
            url: '/incharge/dashboard-salesadd',
            data: {
                '_token': $('input[name=_token]').val(),
                'invoice': $('input[name=saleinvoicenum]').val(),
                'account': $('select[name=accountsale]').val(),
                'salebranchproduct': $('#salebranchproduct').val(),
                'saleprice': $('input[name=saleprice]').val(),
                'branchid': $('input[name=branchid]').val(),
                'paymenttype' : $("input[name=payment]:checked").val(),
                'salequantity': $('input[name=salequantity]').val(),
                'saleamount': $('input[name=saleamount]').val(),
                'salesdate': $('input[name=salesdate]').val()
            },
            success: function(data) {
                if ((data.errors)){
                $('.error').removeClass('hidden');
                    $('.error').text(data.errors.name);
                    new PNotify({
                    title: 'Error',
                    text: 'Please complete the details.',
                    type: 'warning',
                    delay: 2000,
                    styling: 'bootstrap3'
                }); 
                }
                else {
                    $('.error').addClass('hidden');
                    var productValue = data.product;
                    var product = productValue.split(',');
                    
                    
                    var accountValue = data.account;
                    var name = "";
                    var account = accountValue.split(',');
                    if(data.paymenttype === 'CASH')
                    {
                        name = "";
                    }
                    else {
                        name = account[0] + ", " + account[1] 
                    }
                    
                    $('#saletable').append("<tr class='saleitem" + data.id + "'><td>"+ data.invoice  +"</td><td>"+ data.paymenttype +"</td><td>" + name + " </td><td>" + product[0]+ " </td><td>" + data.quantity + "</td><td>" + data.price + "</td><td>" + data.amount + "</td><td class='td-actions'><a class='delete-sales btn btn-danger btn-xs' data-id='" + data.id + "'><i class='fa fa-times'></i></a></td></tr>");
                    new PNotify({
                    title: 'Success',
                    text: 'Sales record successfully added!',
                    type: 'success',
                    delay: 2000,
                    styling: 'bootstrap3'
                    }); 
                }
                
            },

        });
        $('#saleinvoicenum').val('');
        $('#saleprice').val('0');
        $('#salequantity').val('0');
        $('#saleamount').val('0');
        $('#accountsale option:selected').removeAttr('selected');
        $('#salebranchproduct option:selected').removeAttr('selected');
        $('#nosalesrecord').remove();
    });

    $(document).on('click', '.delete-sale', function() {
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').removeClass('discountdelete');
    $('.actionBtn').removeClass('creditdelete');
    $('.actionBtn').removeClass('otherdelete');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('saledelete');
    $('.modal-title').text('Delete');
    $('.did').text($(this).data('id'));
    $('.deleteContent').show();
    $('.dname').html($(this).data('name'));
    $('#myModal').modal('show');
    }); 
    $('.modal-footer').on('click', '.saledelete', function() {
        $.ajax({
            type: 'post',
            url: '/incharge/dashboard-salesdelete',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.did').text()
            },
            success: function(data) {
            new PNotify({
                title: 'Success',
                text: 'Sales record deleted',
                type: 'danger',
                delay: 2000,
                styling: 'bootstrap3'
            });  
            $('.saleitem' + $('.did').text()).remove();
            }
        });
    });
//// Others JS Code


$("#othersadd").click(function() {
    $.ajax({
        type: 'post',
        url: '/incharge/dashboard-othersadd',
        data: {
            '_token': $('input[name=_token]').val(),
            'branchid': $('input[name=branchid]').val(),
            'desc' : $("input[name=description]").val(),
            'amount': $('input[name=descamount]').val(),
            'othersdate': $('input[name=salesdate]').val()
        },
        success: function(data) {
            if ((data.errors)){
            $('.error').removeClass('hidden');
                $('.error').text(data.errors.name);
                new PNotify({
                title: 'Error',
                text: 'Please complete the details.',
                type: 'warning',
                delay: 2000,
                styling: 'bootstrap3'
            }); 
            }
            else {
                $('.error').addClass('hidden');
                
                
                $('#otherstable').append("<tr class='otheritem" + data.id + "'><td>"+ data.desc  +"</td><td>"+ data.amount +"</td><td class='td-actions'><a class='delete-others btn btn-danger btn-xs' data-id='" + data.id + "'><i class='fa fa-times'></i></a></td></tr>");
                new PNotify({
                title: 'Success',
                text: 'Others successfully Added',
                type: 'success',
                delay: 2000,
                styling: 'bootstrap3'
                }); 
            }
            
        },

    });
    $('#saleinvoicenum').val('');
    $('#saleprice').val('0');
    $('#salequantity').val('0');
    $('#saleamount').val('0');
    $('#accountsale option:selected').removeAttr('selected');
    $('#salebranchproduct option:selected').removeAttr('selected');
    $('#nootherrecord').remove();
});

$(document).on('click', '.delete-other', function() {
$('#footer_action_button').text(" Delete");
$('#footer_action_button').removeClass('glyphicon-check');
$('#footer_action_button').addClass('glyphicon-trash');
$('.actionBtn').removeClass('btn-success');
$('.actionBtn').removeClass('discountdelete');
$('.actionBtn').removeClass('creditdelete');
$('.actionBtn').removeClass('saledelete');
$('.actionBtn').addClass('btn-danger');
$('.actionBtn').addClass('otherdelete');
$('.modal-title').text('Delete');
$('.did').text($(this).data('id'));
$('.deleteContent').show();
$('.dname').html($(this).data('name'));
$('#myModal').modal('show');
}); 
$('.modal-footer').on('click', '.otherdelete', function() {
    $.ajax({
        type: 'post',
        url: '/incharge/dashboard-othersdelete',
        data: {
            '_token': $('input[name=_token]').val(),
            'id': $('.did').text()
        },
        success: function(data) {
        new PNotify({
            title: 'Success',
            text: 'Others record deleted',
            type: 'danger',
            delay: 2000,
            styling: 'bootstrap3'
        });  
        $('.otheritem' + $('.did').text()).remove();
        }
    });
});
});
  