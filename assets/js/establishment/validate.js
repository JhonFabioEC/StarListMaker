$(document).ready(function () {
    $('input#name').on('focusout', function () {
        const field = $(this).attr('id');

        if (isEmpty(field) === false) {
            return false;
        } else {
            verifyField(field);
        }
    });

    $('select#establishment_type_id').on('focusout', function () {
        const field = $(this).attr('id');

        if (isEmpty(field) === false) {
            return false;
        } else {
            isSuccess(field);
        }
    });

    $('select#department_id').on('focusout', function () {
        const field = $(this).attr('id');

        if (isEmpty(field) === false) {
            return false;
        } else {
            isSuccess(field);
        }
    });

    $('select#municipality_id').on('focusout', function () {
        const field = $(this).attr('id');

        if (isEmpty(field) === false) {
            return false;
        } else {
            isSuccess(field);
        }
    });

    $('select#zone_type_id').on('focusout', function () {
        const field = $(this).attr('id');

        if (isEmpty(field) === false) {
            return false;
        } else {
            isSuccess(field);
        }
    });

    $('input#address').on('focusout', function () {
        const field = $(this).attr('id');

        if (isEmpty(field) === false) {
            return false;
        } else {
            isSuccess(field);
        }
    });

    $('input#phone_number').keypress(function (event) {
        // Cuando se produce el evento 'keypress' en el campo de entrada de número de teléfono
        if (event.which < 48 || event.which > 57 || this.value.length === 10) {
            return false;
            // Si el código de tecla presionada (event.which) no está en el rango de dígitos (48-57) o la longitud del valor actual del campo es igual a 10, se retorna false para evitar que se ingrese la tecla.
        }
    });

    $('input#phone_number').on('focusout', function () {
        const field = $(this).attr('id');

        if (isEmpty(field) === false) {
            return false;
        } else if (isLimit(field, 10) === false) {
            return false;
        } else {
            verifyField(field);
        }
    });

    $('input#email_address').on('focusout', function () {
        const field = $(this).attr('id');

        if (isEmpty(field) === false) {
            return false;
        } else if (isEmailValid(field) === false) {
            return false;
        } else {
            verifyField(field);
        }
    });

    $('input#username').on('focusout', function () {
        const field = $(this).attr('id');

        if (isEmpty(field) === false) {
            return false;
        } else {
            verifyField(field);
        }
    });

    $('input#password').on('focusout', function () {
        // Cuando se produce el evento 'focusout' en el campo de entrada de contraseña
        const field = $(this).attr('id');
        // Obtenemos el ID del campo de entrada de contraseña y lo almacenamos en la variable 'field'

        if (isEmpty(field) === false) {
            return false;
            // Si el campo está vacío, llamamos a la función 'isEmpty' pasando el ID del campo y si retorna false (campo vacío), retornamos false para detener la ejecución.
        } else {
            isSuccess(field);
            // Si el campo no está vacío, llamamos a la función 'isSuccess' pasando el ID del campo para marcarlo como válido.
        }
    });

    $('input#confirm_password').on('focusout', function () {
        const field = $(this).attr('id');

        if (isEmpty(field) === false) {
            return false;
        } else if (isDiferent(field) === false) {
            return false;
        } else {
            isSuccess(field);
        }
    });

    function isEmpty(field) {
        const field_value = $('#' + field).val();
        const field_length = field_value.trim();
        const responseContainer = $('#response_' + field);

        if (field_length === '') {
            disableField(field);
            responseContainer.html('<p class="text-danger">El campo es obligatorio</p>');
            return false;
        }
        return true;
    }

    function isLimit(field, limit) {
        const field_value = $('#' + field).val();
        const field_length = field_value.length;
        const responseContainer = $('#response_' + field);

        if (field_length < limit) {
            disableField(field);
            responseContainer.html('<p class="text-danger">Debe ser igual a ' + limit + '</p>');
            return false;
        }
        return true;
    }

    function isEmailValid(field) {
        const field_value = $('#' + field).val();
        const responseContainer = $('#response_' + field);
        const expresionRegular = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!expresionRegular.test(field_value)) {
            disableField(field);
            responseContainer.html('<p class="text-danger">El correo no invalido</p>');
            return false;
        }
        return true;
    }

    function isDiferent(field) {
        const confirm_password = $('#' + field).val();
        const field_length = confirm_password.trim();
        const responseContainer = $('#response_' + field);
        const password = $('#password').val();

        if (!field_length === '' || confirm_password != password) {
            disableField(field);
            responseContainer.html('<p class="text-danger">Las contraseñas son diferentes</p>');
            return false;
        }
        return true;
    }

    function isSuccess(field) {
        const responseContainer = $('#response_' + field);

        enableField(field);
        enableButton();
        responseContainer.html('');
    }

    // Función para verificar si el valor del campo ya ha sido asignado por otro usuario en la BD
    function verifyField(field) {
        const field_value = $('#' + field).val();
        const responseContainer = $('#response_' + field);
        const dataString = 'field=' + field + '&field_data=' + field_value; //Ej: field=username&field_data=pepito03
        const url = '/StarListMaker/assets/services/establishment/verify.php?' + dataString; //Url para enviar los datos por el metodo GET

        fetch(url)
            .then(function (response) {
                if (response.ok) {
                    return response.json();
                }
                throw new Error('Error en la respuesta de la red.');
            })
            .then(function (datos) {
                if (datos.success == 1) {
                    disableField(field);
                    responseContainer.html(datos.message); // Mostrando la respuesta de error
                } else {
                    enableField(field);
                    enableButton();
                    responseContainer.html(datos.message); // Mostrando la respuesta de éxito
                }
            })
            .catch(function (error) {
                console.log('Hubo un problema con la petición Fetch:', error.message);
            });
    }

    function disableField(field) {
        $('input, select').attr('disabled', true);
        $('a').addClass('disabled').off('click');
        $('#' + field).removeClass('is-valid text-success').on('click');
        $('#' + field).addClass('is-invalid text-danger').off('click');
        $('#' + field).attr('disabled', false);
    }

    function enableField(field) {
        $('input, select').attr('disabled', false);
        $('a').removeClass('disabled').on('click');
        $('#' + field).removeClass('is-invalid text-danger').on('click');
        $('#' + field).addClass('is-valid text-success').off('click');
    }

    function enableButton() {
        const name = $.trim($("#name").val());
        const establishment_type_id = $.trim($("#establishment_type_id").val());
        const department_id = $.trim($("#department_id").val());
        const municipality_id = $.trim($("#municipality_id").val());
        const zone_type_id = $.trim($("#zone_type_id").val());
        const address = $.trim($("#address").val());
        const email_address = $.trim($("#email_address").val());
        const phone_number = $.trim($("#phone_number").val());
        const username = $.trim($("#username").val());
        const password = $.trim($("#password").val());
        const confirm_password = $.trim($("#confirm_password").val());

        const response_name = $.trim($("#response_name").text());
        const response_establishment_type_id = $.trim($("#response_establishment_type_id").text());
        const response_department_id = $.trim($("#response_department_id").text());
        const response_municipality_id = $.trim($("#response_municipality_id").text());
        const response_zone_type_id = $.trim($("#response_zone_type_id").text());
        const response_address = $.trim($("#response_address").text());
        const response_email_address = $.trim($("#response_email_address").text());
        const response_phone_number = $.trim($("#response_phone_number").text());
        const response_username = $.trim($("#response_username").text());
        const response_password = $.trim($("#response_password").text());
        const response_confirm_password = $.trim($("#response_confirm_password").text());

        if (name.trim() === '' || establishment_type_id.trim() === '' ||
            !response_name.trim() === '' || !response_establishment_type_id.trim() === '') {
            $('.btn-p1').addClass('disabled').off('click');
        } else {
            $('.btn-p1').removeClass('disabled').on('click');
        }

        if (department_id.trim() === '' || municipality_id.trim() === '' || municipality_id === 'none' ||
            !response_department_id.trim() === '' || !response_municipality_id.trim() === '') {
            $('.btn-p2').addClass('disabled').off('click');
        } else {
            $('.btn-p2').removeClass('disabled').on('click');
        }

        if (zone_type_id.trim() === '' || address.trim() === '' ||
            !response_zone_type_id.trim() === '' || !response_address.trim() === '') {
            $('.btn-p3').addClass('disabled').off('click');
        } else {
            $('.btn-p3').removeClass('disabled').on('click');
        }

        if (phone_number.trim() === '' || email_address.trim() === '' ||
            !response_phone_number.trim() === '' || !response_email_address.trim() === '') {
            $('.btn-p4').addClass('disabled').off('click');
        } else {
            $('.btn-p4').removeClass('disabled').on('click');
        }

        if (username.trim() === '' || password.trim() === '' || confirm_password.trim() === '' || confirm_password != password ||
            !response_username.trim() === '' || !response_password.trim() === '' || !response_confirm_password.trim() === '') {
            $('.btn-p5').addClass('disabled').off('click');
        } else {
            $('.btn-p5').removeClass('disabled').on('click');
        }
    }
});