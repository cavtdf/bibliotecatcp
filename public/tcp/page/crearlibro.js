    $(document).ready(function() {
        pageSetUp();
        var errorClass = 'invalid';
        var errorElement = 'em';
        var $orderForm = $("#order-form").validate({
            errorClass		: errorClass,
            errorElement	: errorElement,
            highlight: function(element) {
                $(element).parent().removeClass('state-success').addClass("state-error");
                $(element).removeClass('valid');
            },
            unhighlight: function(element) {
                $(element).parent().removeClass("state-error").addClass('state-success');
                $(element).addClass('valid');
            },
            // Rules for form validation
            rules : {
                titulo : {
                    required : true
                },
                categoria : {
                    required : true
                },
                tipo: {
                    required : true
                },
                autor : {
                    required : true
                },
                editorial : {
                    required : true
                },
                isbn : {
                    required : true
                },
                ubicacion : {
                    required : true
                },
                estado : {
                    required : true
                }
            },

            // Messages for form validation
            messages : {
                titulo : {
                    required : 'Ingrese el titulo del libro'
                },
                categoria : {
                    required : 'Seleccione una categoria'

                },
                tipo : {
                    required : 'Seleccione el tipo de Material'
                },
                autor : {
                    required : 'Seleccione un autor'
                },
                editorial : {
                    required : 'Seleccione la editorial'
                },
                isbn : {
                    required : 'Ingrese el código ISBN'
                },
                ubicacion : {
                    required : 'Seleccione la ubicación'
                },
                estado : {
                    required : 'Seleccione el estado'
                }
            },
            // Do not change code below
            errorPlacement : function(error, element) {
                error.insertAfter(element.parent());
            }
        });

        $('#foto').fileinput({
            language: 'es',
            allowedFileExtensions: ['jpg', 'jpeg', 'png'],
            maxFileSize: 1000,
            showUpload: false,
            showClose: false,
            initialPreviewAsData: true,
            dropZoneEnabled: false,
            theme: "fa",
        });
    });
