$(document).ready(function() {
    
    $(document).on('mouseover', '.quickview', function() {
        $('.memberdetails').addClass("viewdetails"); 
        $('.name').text($(this).data('name'));
        $('.memberpic').attr("src",$(this).data('pic'));
        $('.personalid').text($(this).data('personalid'));
        $('.clubnumber').text($(this).data('clubnumber'));
        $('.regnumber').text($(this).data('regnumber'));
        $('.club').text($(this).data('club'));
        $('.region').text($(this).data('region'));
        $('.position').text($(this).data('position'));
        $('.address').text($(this).data('address'));
        $('.contactnum').text($(this).data('contactnum'));
        $('.bloodtype').text($(this).data('bloodtype'));
        $('.contactperson').text($(this).data('contactperson'));
        $('.contactpersonnum').text($(this).data('contactpersonnum'));
        $('.relation').text($(this).data('relation'));
        $('.email').text($(this).data('email'));
        $('.website').text($(this).data('website'));
        $('.tin').text($(this).data('tin'));
        $('.birthdate').text($(this).data('birthdate'));
        $('.philhealth').text($(this).data('philhealth'));
        $('.sssgsis').text($(this).data('sssgsis'));
        $('.pagibig').text($(this).data('pagibig'));
        $('.religion').text($(this).data('religion'));
        $('.did').text($(this).data('id'));
        $('.edit-modal').attr("data-id",$(this).data('id'));
        $('.edit-modal').attr("data-personalid",$(this).data('personalid'));
        $('.edit-modal').attr("data-pic",$(this).data('pic'));
        $('.edit-modal').attr("data-fname",$(this).data('fname'));
        $('.edit-modal').attr("data-lname",$(this).data('lname'));
        $('.edit-modal').attr("data-mname",$(this).data('mname'));
        $('.edit-modal').attr("data-clubnumber",$(this).data('clubnumber'));
        $('.edit-modal').attr("data-regnumber",$(this).data('regnumber'));
        $('.edit-modal').attr("data-club",$(this).data('club'));
        $('.edit-modal').attr("data-region",$(this).data('region'));
        $('.edit-modal').attr("data-position",$(this).data('position'));
        $('.edit-modal').attr("data-address",$(this).data('address'));
        $('.edit-modal').attr("data-contactnum",$(this).data('contactnum'));
        $('.edit-modal').attr("data-bloodtype",$(this).data('bloodtype'));
        $('.edit-modal').attr("data-contactperson",$(this).data('contactperson'));
        $('.edit-modal').attr("data-contactpersonnum",$(this).data('contactpersonnum'));
        $('.edit-modal').attr("data-relation",$(this).data('relation'));
        $('.edit-modal').attr("data-email",$(this).data('email'));
        $('.edit-modal').attr("data-website",$(this).data('website'));
        $('.edit-modal').attr("data-tin",$(this).data('tin'));
        $('.edit-modal').attr("data-birthdate",$(this).data('birthdate'));
        $('.edit-modal').attr("data-philhealth",$(this).data('philhealth'));
        $('.edit-modal').attr("data-sssgsis",$(this).data('sssgsis'));
        $('.edit-modal').attr("data-pagibig",$(this).data('pagibig'));
        $('.edit-modal').attr("data-religion",$(this).data('religion'));

        //console.log($(this).data('name'));
      });
      

      $(document).on('click', '.edit-modal', function() {
        $('#footer_action_button').text("Update");
        $('#actionicon').removeClass('fa-times');
        $('#actionicon').addClass('fa-pencil');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Edit Member');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        $('#fid').val($(this).data('id'));
        $('#fname').val($(this).data('fname'));
        $('#mname').val($(this).data('mname'));
        $('#lname').val($(this).data('lname'));
        $('#personalid').val($(this).data('personalid'));
        $('#clubnumber').val($(this).data('clubnumber'));
        $('#regnumber').val($(this).data('regnumber'));
        $('#club').val($(this).data('club'));
        $('#club').text($(this).data('club'));
        $('#region').val($(this).data('region'));
        $('#region').text($(this).data('region'));
        $('#position').val($(this).data('position'));
        $('#position').text($(this).data('position'));
        $('#address').val($(this).data('address'));
        $('#contactnum').val($(this).data('contactnum'));
        $('#bloodtype').val($(this).data('bloodtype'));
        $('#bloodtype').text($(this).data('bloodtype'));
        $('#contactperson').val($(this).data('contactperson'));
        $('#contactpersonnum').val($(this).data('contactpersonnum'));
        $('#relation').val($(this).data('relation'));
        $('#email').val($(this).data('email'));
        $('#website').val($(this).data('website'));
        $('#tin').val($(this).data('tin'));
        $('#birthdate').val($(this).data('birthdate'));
        $('#philhealth').val($(this).data('philhealth'));
        $('#sssgsis').val($(this).data('sssgsis'));
        $('#pagibig').val($(this).data('pagibig'));
        $('#religion').val($(this).data('religion'));
        $('#myModal').modal('show');
        //console.log($(this).data('name') + $(this).data('points'));
    });

    $(document).on('click', '.add-modal', function() {
        
        $('#actionicon').removeClass('fa-times');
        $('#actionicon').addClass('fa-pencil');
        $('.addBtn').addClass('btn-success');
        $('.addBtn').removeClass('btn-danger');
        $('.addBtn').addClass('add');
        $('.modal-title').text('Add Member');
        $('.form-horizontal').show();

        $('#addModal').modal('show');
        //console.log($(this).data('name') + $(this).data('points'));
    });
    $(document).on('click', '.delete-modal', function() {
        $('#footer_action_button').text(" Delete");
        $('#actionicon').removeClass('fa-pencil');
        $('#actionicon').addClass('fa-times');
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
    $(document).on('click', '.btn-print', function() {
        $('.memberdetails').removeClass('col-lg-6');
        $('.memberdetails').addClass('col-lg-12');
    });

    $('.modal-footer').on('click', '.edit', function() {
  
        $.ajax({
            type: 'post',
            url: '/admin/members/edit',
            data: {
                //_token:$(this).data('token'),
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'bloodtype': $("select[name=bloodtype]").val(),
                'region': $("select[name=region]").val(),
                'club': $("select[name=club]").val(),
                'position': $("select[name=position]").val(),
                'personalid': $("#personalid").val(),
                'clubnumber': $("#clubnumber").val(),
                'regnumber': $("#regnumber").val(),
                'address': $("#address").val(),
                'contactnum': $("#contactnum").val(),
                'contactperson': $("#contactperson").val(),
                'contactpersonnum': $("#contactpersonnum").val(),
                'relation': $("#relation").val(),
                'email': $("#email").val(),
                'website': $("#website").val(),
                'tin': $("#tin").val(),
                'philhealth': $("#philhealth").val(),
                'sssgsis': $("#sssgsis").val(),
                'pagibig': $("#pagibig").val(),
                'birthdate': $("#birthdate").val(),
                'religion': $("#religion").val(),
                'lname': $("#lname").val(),
                'mname': $("#mname").val(),
                'fname': $('#fname').val()
            },
            success: function(data) {

                $('.name').text(data.lname +  ', ' +data.fname+ '' +data.mname);
                //$('.memberpic').attr("src",$(this).data('pic'));
                $('.personalid').text(data.personalidnumber);
                $('.clubnumber').text(data.clubidnumber);
                $('.regnumber').text(data.regionalidnumber);
                $('.club').text(data.club);
                $('.region').text(data.region);
                $('.position').text(data.position);
                $('.address').text(data.address);
                $('.contactnum').text(data.personalcontact);
                $('.bloodtype').text(data.bloodtype);
                $('.contactperson').text(data.contactperson);
                $('.contactpersonnum').text(data.contactpersonnumber);
                $('.relation').text(data.relation);
                $('.email').text(data.email);
                $('.website').text(data.website);
                $('.tin').text(data.tin);
                $('.birthdate').text(data.bdate);
                $('.philhealth').text(data.philhealth);
                $('.sssgsis').text(data.sssgsis);
                $('.pagibig').text(data.pagibig);
                $('.religion').text(data.religion);
                
                $('.edit-modal').attr("data-personalid",data.personalidnumber);
                // $('.edit-modal').attr("data-pic",data.);
                $('.edit-modal').attr("data-fname",data.fname);
                $('.edit-modal').attr("data-lname",data.lname);
                $('.edit-modal').attr("data-mname",data.mname);
                $('.edit-modal').attr("data-clubnumber",data.clubidnumber);
                $('.edit-modal').attr("data-regnumber",data.regionalidnumber);
                $('.edit-modal').attr("data-club",data.club);
                $('.edit-modal').attr("data-region",data.region);
                $('.edit-modal').attr("data-position",data.position);
                $('.edit-modal').attr("data-address",data.address);
                $('.edit-modal').attr("data-contactnum",data.personalcontact);
                $('.edit-modal').attr("data-bloodtype",data.bloodtype);
                $('.edit-modal').attr("data-contactperson",data.contactperson);
                $('.edit-modal').attr("data-contactpersonnum",data.contactpersonnumber);
                $('.edit-modal').attr("data-relation",data.relation);
                $('.edit-modal').attr("data-email",data.email);
                $('.edit-modal').attr("data-website",data.website);
                $('.edit-modal').attr("data-tin",data.tin);
                $('.edit-modal').attr("data-birthdate",data.bdate);
                $('.edit-modal').attr("data-philhealth",data.philhealth);
                $('.edit-modal').attr("data-sssgsis",data.sssgsis);
                $('.edit-modal').attr("data-pagibig",data.pagibig);
                $('.edit-modal').attr("data-religion",data.religion);
                new PNotify({
                    title: 'Success',
                    text: 'Member Successfully Updated',
                    type: 'success',
                    delay: 2000,
                    styling: 'bootstrap3'
                });
                
            }
        });
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
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'post',
            url: '/admin/deletemember',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.did').text()
            },
            success: function(data) {
                $('.member' + $('.did').text()).remove();
                $('.memberdetails').removeClass("viewdetails");
                new PNotify({
                    title: 'Success',
                    text: 'Member Successfully Deleted',
                    type: 'error',
                    delay: 2000,
                    styling: 'bootstrap3'
                });
            }
            
        });
    });
});