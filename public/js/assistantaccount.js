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

    $('.modal-footer').on('click', '.updateAccount', function() {
        $.ajax({
            type: 'post',
            url: '/assistant/updateaccount',
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