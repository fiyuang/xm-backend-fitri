function removeAction() {
    $('[data-target="#remove-data-popup"]').on('click', function (e) {
      $("#remove-data-popup form").attr("action", $(this).data('action'));
    });
}

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    removeAction();
    $("#form-doctor [name=mobile_number]").mask('0000000000000', {reverse: true});
    $('.js-example-basic-multiple').select2();

    // Handle Submit Document
    if ($("#ModalFormHR").length > 0) {
        $("#FormHR").validate({
            rules: {
                "name": "required",
                "email": "required",
                "mobile_number": "required",
                "dob": "required",
                "education": "required",
                "profile_picture": "required",
                "cv": "required",
                "industries[]": "required",
            },
            messages: {
                "name": "Nama Perlu Diisi",
                "email": "Email Perlu Diisi",
            },
            errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },

            submitHandler: function(form) {

                $(".save-data").attr("disabled", true);
                $('.save-data').html('Sending..');

                var form = $('#FormHR')[0];

                var formDatata = new FormData(form);

                $.ajax({
                    data: formDatata,
                    url: '/members/store/hr',
                    type: "POST",
                    contentType: false,
                    enctype: 'multipart/form-data',
                    processData: false,  // Important!
                    dataType: 'json',
                    success: function (data) {
                        console.log(data.data);
                        if(data.errors){

                            jQuery('.alert-danger').html('');
                            jQuery.each(data.errors, function(key, value){
                                jQuery('.alert-danger').show();
                                    jQuery('.alert-danger').append('<li>'+value+'</li>');
                            });
                            $(".save-data").attr("disabled", false);
                            $('.save-data').html('Submit');

                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Jadwal berhasil dibuat!',
                                showConfirmButton: true,
                            }).then(() => {
                                location.reload(true);
                            })
                        }
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $(".save-data").attr("disabled", false);
                        $('.save-data').html('Submit');
                    }
                });
            }
        });
    }

    $('#status').on('change',function(){
        var status =  $( "select option:selected" ).val();
        var id = $(this).data('id');
        console.log(id);
        Swal.fire({
            title: 'Apa anda yakin?',
            text: "Melakukan perubahan status pada data ini.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Lanjutkan!',
            cancelButtonText: 'Batalkan',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '/admin/members/guru/update',
                    type: 'POST',
                    data: {
                        id: id,
                        status: status,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        console.log(data)
                        if(data.success == true){
                            Swal.fire(
                                'Berhasil!',
                                'Status telah di perbarui!',
                                'success'
                            ).then(function(){ 
                                location.reload();
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 5500
                            })
                        }
                    }
                })
            }
        })
    })
        

    
})