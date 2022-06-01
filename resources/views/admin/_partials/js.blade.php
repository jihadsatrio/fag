<script type="text/javascript">
    $(".timepicker").timepicker({showMeridian:false})

    // Select advance
    $(function () {
        $(".select2").select2();
    });
    
    $( "#form-register").validate({
      rules: {
        field: {
          required : true
        },
        email: {
            required    : true,
            EmailFormat : true
        },
        password : {
            minlength: 8
        },
        password_confirmation : {
          minlength: 8,
          equalTo: "#password"
        },
        emailuser : {
            remote: {
                url: "{{ route('ajax.user.email') }}",
                type: "GET",
                data: {
                    emaildealer: function() { return $('#emaildealer').val(); },
                    iduser: function() { return $('#iduser').val(); }
                },
             }
        },
        emailnahkoda : {
            remote: {
                url: "{{ route('ajax.nahkoda.email') }}",
                type: "GET",
                data: {
                    emailnahkoda: function() { return $('#emailnahkoda').val(); },
                    idnahkoda: function() { return $('#idnahkoda').val(); }
                },
             }
        },
        nidnnahkoda : {
            remote: {
                url: "{{ route('ajax.nahkoda.nidn') }}",
                type: "GET",
                data: {
                    nidnnahkoda: function() { return $('#nidnnahkoda').val(); },
                    idnahkoda: function() { return $('#idnahkoda').val(); }
                },
             }
        },
        namekapal : {
            remote: {
                url: "{{ route('ajax.kapal.name') }}",
                type: "GET",
                data: {
                    namekapal: function() { return $('#namekapal').val(); },
                    idkapal: function() { return $('#idkapal').val(); }
                },
             }
        },
        code_kapals : {
            remote: {
                url: "{{ route('ajax.kapal.code') }}",
                type: "GET",
                data: {
                    code_kapals: function() { return $('#code_kapals').val(); },
                    idkapal: function() { return $('#idkapal').val(); }
                },
             }
        },
        code_kapal : {
            remote: {
                url: "{{ route('ajax.kapal.code') }}",
                type: "GET",
                data: {
                    code_kapal: function() { return $('#code_kapal').val(); },
                    idkapal: function() { return $('#idkapal').val(); }
                },
             }
        },
        namekapal : {
            remote: {
                url: "{{ route('ajax.kapal.name') }}",
                type: "GET",
                data: {
                    namekapal: function() { return $('#namekapal').val(); },
                    idkapal: function() { return $('#idkapal').val(); }
                },
             }
        },
        // kapals : {
        //     remote: {
        //         url: "",
        //         type: "GET",
        //         data: {
        //             Teachskapal: function() { return $('#Teachskapal').val(); },
        //             idteachs: function() { return $('#idteachs').val(); }
        //         },
        //      }
        // },
      },
        messages: {
            emailuser: {
                remote: "Email already in use!"
            },
            emailnahkoda: {
                remote: "Email already in use!"
            },
            nidnnahkoda: {
                remote: "Nidn already in use!"
            },
            namekapals: {
                remote: "kapals name already in use!"
            },
            code_kapals: {
                remote: "kapals Code already in use!"
            },
            code_kapal: {
                remote: "kapal Code already in use!"
            },
            namekapal: {
                remote: "kapal name already in use!"
            }
            // kapals: {
            //     remote:"kapals and nahkoda already in use!"
            // }
        },
       invalidHandler: function(event, validator) {
          // 'this' refers to the form
          var errors = validator.numberOfInvalids();
          if (errors) {
            var message = "Periksa kembali field yang wajib diisi";
            $("div.error-message span").html(message).css('color','red');
            $("div.error-message").show();
          } else {
            $("div.error-message").hide();
          }
        }
    });

    $('.to-select').on('change', function () {
        var data = $(this).select2('data')['0']['id'];
        if (data =! false) {
            $(this).next().find('.select2-selection--single').removeClass('error');
            $(this).next().next().hide();
        }
    });

    // create your custom rule
    $.validator.addMethod("EmailFormat", function(value, element) {
        return this.optional( element ) || ( /^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test( value ) && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test( value ) );
    }, 'Please enter valid email address.');

</script>
