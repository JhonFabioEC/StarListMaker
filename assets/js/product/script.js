$(document).ready(function () {
    const defaultFile = 'default.svg';
    const url = '/StarListMaker/assets/img/product/';
    let image_hidden = $('#image_hidden').val();

    $("#btnCreate").click(function () {
        $("#form_product")[0].reset();
        $(".modal-title").text("Crear Producto");
        $("#action").val("Crear");
        $("#operacion").val("Crear");
        $('#img').attr('src', url + 'default.svg');
        $('#image_hidden').val('default.svg');
    });

    var dataTable = $('#table_product').DataTable({
        "language": {
            "lengthMenu":
                "Mostrar " +
                `<select class="custom-select custom-select-sm form-control form-control-sm">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>`+
                " registros por página",
            "zeroRecords": "Nada encontrado - disculpa",
            "info": "Mostrando la página _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar:",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "processing": "Procesando..."
        },
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "/StarListMaker/assets/services/product/obtener_registros.php",
            "type": "POST"
        },
        "columnDefs": [
            {
                "responsivePriority": 1,
                "targets": 0
            },
            {
                "responsivePriority": 2,
                "targets": -1
            },
            {
                "targets": 0,
                "visible": false,
                "searchable": false,
            },
            {
                "targets": [1, 13],
                "orderable": false,
                "searchable": false,
            },
        ],
        "stateSave": true,
        "stateDuration": -1,
    });

    $(document).on('submit', '#form_product', function (event) {
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

        if (isEmpty() === true) {
            $.ajax({
                url: "/StarListMaker/assets/services/product/crear.php",
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
                            $("#form_product")[0].reset();
                            $("#modal_product").modal('hide');
                            dataTable.ajax.reload();
                        }
                        $("#form_product")[0].reset();
                        $("#modal_product").modal('hide');
                        dataTable.ajax.reload();
                        return false;
                    });
                }
            });
        } else {
            alert("Algunos campos son obligatorios");
        }
    });

    //Funcionalidad de editar
    $(document).on('click', '.edit', function () {
        var id = $(this).attr("id");
        console.log("id: ", id);

        $.ajax({
            url: "/StarListMaker/assets/services/product/obtener_registro.php",
            method: "POST",
            data: { id: id },
            dataType: "JSON",
            success: function (data) {
                console.log("data:", data);
                $('#modal_product').modal('show');
                $('#name').val(data.name);
                $('#barcode').val(data.barcode);
                $('#price').val(data.price);
                $('#quantity').val(data.quantity);
                $("#category_id option:contains(" + data.category + ")").attr("selected", true);
                $("#brand_id option:contains(" + data.brand + ")").attr("selected", true);
                $('#section').val(data.section);
                $('#description').val(data.description);
                $("#state_id option:contains(" + data.state + ")").attr("selected", true);
                $('.modal-title').text("Editar Producto");
                $('#id').val(id);
                $('#img').attr('src', url + data.image)
                $('#image_hidden').val(data.image);
                $('#action').val("Editar");
                $('#operacion').val("Editar");
                console.log("id: ", id);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });

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

    //Funcionalidad de eliminar
    $(document).on('click', '.delete', function () {
        var id = $(this).attr("id");
        Swal.fire({
            title: 'Estas seguro  que deseas eliminar el producto?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/StarListMaker/assets/services/product/eliminar.php",
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
                                dataTable.ajax.reload();
                            }
                            dataTable.ajax.reload();
                            return false;
                        });
                    }
                });
            }
        })
    });

    function isEmpty() {
        const name = $('#name').val();
        const barcode = $('#barcode').val();
        const price = $('#price').val();
        const quantity = $('#quantity').val();
        const category_id = $('#category_id').val();
        const brand_id = $('#brand_id').val();
        const section = $('#section').val();
        const state_id = $("#state_id").val();

        if (name.trim() === '') {
            return false;
        }

        if (barcode.trim() === '') {
            return false;
        }

        if (price.trim() === '') {
            return false;
        }

        if (quantity.trim() === '') {
            return false;
        }

        if (category_id.trim() === '') {
            return false;
        }

        if (brand_id.trim() === '') {
            return false;
        }

        if (section.trim() === '') {
            return false;
        }

        if (state_id.trim() === '') {
            return false;
        }

        return true;
    }
});