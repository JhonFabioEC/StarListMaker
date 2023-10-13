$(document).ready(function () {
    var dataTable = $('#table_user').DataTable({
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
        "processing": false,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "/StarListMaker/assets/services/user/obtener_registros.php",
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
                "targets": [1, 7],
                "orderable": false,
                "searchable": false,
            },
        ],
        "account_statusSave": true,
        "account_statusDuration": -1,
    });

    $(document).on('submit', '#form_user', function (event) {
        event.preventDefault();

        if (isEmpty() === true) {
            $.ajax({
                url: "/StarListMaker/assets/services/user/crear.php",
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
                            $("#form_user")[0].reset();
                            $("#modal_user").modal('hide');
                            dataTable.ajax.reload();
                        }
                        $("#form_user")[0].reset();
                        $("#modal_user").modal('hide');
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
            url: "/StarListMaker/assets/services/user/obtener_registro.php",
            method: "POST",
            data: { id: id },
            dataType: "JSON",
            success: function (data) {
                console.log("data:", data);
                $('#modal_user').modal('show');
                $('#image_upload').html(data.image);
                $('#username').val(data.username);
                $("#account_status_id option:contains(" + data.account_status + ")").attr("selected", true);
                $('.modal-title').text("Editar Usuario");
                $('#id').val(id);
                $('#action').val("Editar");
                $('#operacion').val("Editar");
                console.log("id: ", id);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });

    function isEmpty() {
        const username = $('#username').val();
        const account_status_id = $("#account_status_id").val();

        if (username.trim() === '') {
            return false;
        }

        if (account_status_id.trim() === '') {
            return false;
        }

        return true;
    }
});