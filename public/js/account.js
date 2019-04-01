$(document).ready(function() {

    $(document).on('click', '.account-modal', function() {
        
        $('#actionicon').removeClass('fa-times');
        $('#actionicon').addClass('fa-pencil');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('updateAccount');
        $('.modal-title').text('Update Account');
        $('.form-horizontal').show();
        $('#userid').val($(this).data('id'));
        $('#name').val($(this).data('name'));
        $('#dataemail').val($(this).data('eemail'));
        $('#password').val($(this).data('password'));
        $('#accountModal').modal('show');
        //console.log($(this).data('name') + $(this).data('points'));
    });

    // $('.modal-footer').on('click', '.add', function() {
        
    
    //     $.ajax({
    //         type: 'post',
    //         url: '/admin/members/add',
    //         data: {
    //             //_token:$(this).data('token'),
    //             '_token': $('input[name=_token]').val(),

    //             'bloodtype': $("select[name=bloodtype]").val(),
    //             'region': $("select[name=region]").val(),
    //             'club': $("select[name=club]").val(),
    //             'position': $("select[name=position]").val(),
    //             'personalid': $("#personalid").val(),
    //             'clubnumber': $("#clubnumber").val(),
    //             'regnumber': $("#regnumber").val(),
    //             'address': $("#address").val(),
    //             'contactnum': $("#contactnum").val(),
    //             'contactperson': $("#contactperson").val(),
    //             'contactpersonnum': $("#contactpersonnum").val(),
    //             'relation': $("#relation").val(),
    //             'email': $("#email").val(),
    //             'website': $("#website").val(),
    //             'tin': $("#tin").val(),
    //             'philhealth': $("#philhealth").val(),
    //             'sssgsis': $("#sssgsis").val(),
    //             'pagibig': $("#pagibig").val(),
    //             'birthdate': $("#birthdate").val(),
    //             'religion': $("#religion").val(),
    //             'lname': $("#lname").val(),
    //             'mname': $("#mname").val(),
    //             'fname': $('#fname').val()
    //         },
    //         success: function(data) {
    //             new PNotify({
    //                 title: 'Success',
    //                 text: 'Member Successfully Updated',
    //                 type: 'success',
    //                 delay: 2000,
    //                 styling: 'bootstrap3'
    //             });
                
    //         }
    //     });
    // });
    $('.modal-footer').on('click', '.updateAccount', function() {
        $.ajax({
            type: 'post',
            url: '/admin/updateaccount',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('#userid').val(),
                'name': $("#name").val(),
                'email': $("#dataemail").val(),
                'password': $("#password").val()
            },
            success: function(data) {
            
                new PNotify({
                    title: 'Success',
                    text: 'Account Successfully Updates',
                    type: 'success',
                    delay: 2000,
                    styling: 'bootstrap3'
                });
            }
            
        });
    });
});