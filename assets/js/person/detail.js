$(document).ready(function () {
    function init() {
        var id = $(this).attr("id");
        console.log("id: ", id);

        $.ajax({
            url: "/StarListMaker/assets/services/product/obtener_registro.php",
            method: "POST",
            data: { id: id },
            dataType: "JSON",
            success: function (data) {
                console.log("data:", data);
                // $('#modal_product').modal('show');
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
                // $('#action').val("Editar");
                // $('#operacion').val("Editar");
                console.log("id: ", id);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }

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
});
