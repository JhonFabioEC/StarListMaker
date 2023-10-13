$(document).ready(function () {
    $('#department_id').on('change', function (event) {
        fetch('http://localhost/StarListMaker/assets/services/common/municipality.php?department_id=' + event.target.value)
            .then(function (res) {
                if (!res.ok) {
                    throw new Error('Hubo un error en la respuesta');
                }
                return res.json();
            })
            .then(function (datos) {
                const municipality_id = $("select#municipality_id");
                let html = '<option value="none">Seleccionar municipio</option>';

                if (datos.data.length > 0) {
                    html = '<option value="">Seleccionar municipio</option>';

                    for (let i = 0; i < datos.data.length; i++) {
                        html += '<option value="' + datos.data[i].id + '">' + datos.data[i].name + '</option>';

                        municipality_id.attr('disabled', false);
                    }
                } else {
                    municipality_id.attr('disabled', true);
                }

                municipality_id.removeClass('is-valid text-success').on('click');
                municipality_id.removeClass('is-invalid text-danger').off('click');
                municipality_id.html(html);
            })
            .catch(function (error) {
                console.error('Ocurrió un error ' + error);
            });
    });

    $("form#form_establishment").submit(function (e) {
        e.preventDefault();

        const name = $.trim($("#name").val());
        const establishment_type_id = $.trim($("#establishment_type_id :selected").val());
        const municipality_id = $.trim($("#municipality_id :selected").val());
        const zone_type_id = $.trim($("#zone_type_id :selected").val());
        const address = $.trim($("#address").val());
        const phone_number = $.trim($("#phone_number").val());
        const email_address = $.trim($("#email_address").val());
        const username = $.trim($("#username").val());
        const password = $.trim($("#password").val());
        const url = '/StarListMaker/assets/services/establishment/create.php';

        console.log("name: ", name);
        console.log("establishment_type_id ", establishment_type_id);
        console.log("municipality_id: ", municipality_id);
        console.log("zone_type_id: ", zone_type_id);
        console.log("address: ", address);
        console.log("phone_number: ", phone_number);
        console.log("email_address: ", email_address);
        console.log("username: ", username);
        console.log("password: ", password);

        getStatusBtnCreate();

        $.ajax({
            url: url,
            type: "POST",
            dataType: "JSON",
            data: {
                name: name,
                establishment_type_id: establishment_type_id,
                municipality_id: municipality_id,
                zone_type_id: zone_type_id,
                address: address,
                phone_number: phone_number,
                email_address: email_address,
                username: username,
                password: password
            },
            success: function (data) {
                console.log("data:", data);

                Swal.fire({
                    title: '¡Establecimineto registrado con exito!',
                    icon: 'success',
                    showConfirmButton: true,
                    confirmButtonText: 'Ok',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "/StarListMaker/assets/pages/login/index.php";
                    }

                    window.location.href = "/StarListMaker/assets/pages/login/index.php";
                    return false;
                });
            }
        });
    });

    const defaultFile = 'default.svg';
    const url = '/StarListMaker/assets/img/user/establishment/';
    let image_hidden = $('#image_hidden').val();

    $('#image').on('change', function (e) {
        if (e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#img').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        } else {
            $('#img').attr('src', url + image_hidden);
        }
    });

    $(document).on('click', '#btnDelete', function () {
        $('#image_hidden').val(defaultFile);
        image_hidden = $('#image_hidden').val();
        $('#img').attr('src', url + image_hidden);
        console.log("image_hidden: ", image_hidden);
    });

    $(document).on('submit', '#form_establishment_edit', function (event) {
        event.preventDefault();
        var extension = $('#image').val().split('.').pop().toLowerCase();
        console.log("extencion: ", extension);
        if (extension != '') {
            if (jQuery.inArray(extension, ['png', 'jpg', 'jpeg', 'svg', 'webp']) == -1) {
                Swal.fire(
                    'Error!',
                    'Formato de imagen inválido!',
                    'danger'
                );

                $("#image").val('');
                return false;
            }
        }

        $.ajax({
            url: "/StarListMaker/assets/services/establishment/edit.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                Swal.fire({
                    icon: 'success',
                    title: data,
                    showConfirmButton: true,
                    confirmButtonText: 'Ok',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "/StarListMaker/assets/pages/establishment/view.php";
                    }
                    window.location.href = "/StarListMaker/assets/pages/establishment/view.php";
                    return false;
                });
            }
        });
    });

    //Funcionalidad de eliminar
    $(document).on('submit', '#form_establishment_delete', function (event) {
        event.preventDefault();

        var id = $("#id").val();
        Swal.fire({
            title: 'Estas seguro que deseas eliminar la cuenta?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/StarListMaker/assets/services/establishment/delete.php",
                    method: "POST",
                    data: { id: id },
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: data,
                            showConfirmButton: true,
                            confirmButtonText: 'Ok',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "/StarListMaker/assets/services/login/logout.php";
                            }
                            window.location.href = "/StarListMaker/assets/services/login/logout.php";
                            return false;
                        });
                    }
                });
            }
        })
    });

    function getStatusBtnCreate() {
        console.log("Click");

        $('#btn_create').attr('disabled', true);
        $('input, select').attr('disabled', true);
        $('a').addClass('disabled').off('click');

        $("#btn_create").html(`
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Cargando...
        `);
    }
});
