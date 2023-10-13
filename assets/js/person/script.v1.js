$(document).ready(function () {
    $("#btnCreate").click(function () {
        $("#form_product")[0].reset();
        $(".modal-title").text("Crear Producto");
        $("#action").val("Crear");
        $("#operacion").val("Crear");
        $("#image_upload").html("");
    });

    $(document).on('submit', '#form_product', function (event) {
        event.preventDefault();
        var extension = $('#image').val().split('.').pop().toLowerCase();
        console.log("extencion: ", extension);

        if (extension != '') {
            if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg', 'svg']) == -1) {
                alert("Formato de imagen inválido");
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
                    alert(data);
                    $("#form_product")[0].reset();
                    $("#modal_product").modal('hide');
                    dataTable.ajax.reload();
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
                $('#image_upload').html(data.image);
                $('#action').val("Editar");
                $('#operacion').val("Editar");
                console.log("id: ", id);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });

    //Funcionalidad de eliminar
    $(document).on('click', '.delete', function () {
        var id = $(this).attr("id");
        console.log("id: ", id);

        if (confirm("Esta seguro de eliminar este registro: " + id)) {
            $.ajax({
                url: "/StarListMaker/assets/services/product/eliminar.php",
                method: "POST",
                data: { id: id },
                success: function (data) {
                    alert(data);
                    dataTable.ajax.reload();
                }
            });
        } else {
            return false;
        }
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