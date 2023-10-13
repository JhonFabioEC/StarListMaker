$(document).ready(function () {
    $("#btnCreate").click(function () {
        $("#form_establishment_type")[0].reset();
        $(".modal-title").text("Crear Tipo de Establecimiento");
        $("#action").val("Crear");
        $("#operacion").val("Crear");
    });

    var dataTable = $('#table_establishment_type').DataTable({
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
            "url": "/StarListMaker/assets/services/establishment_type/obtener_registros.php",
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
                "targets": [1, 5],
                "orderable": false,
                "searchable": false,
            },
        ],
        "stateSave": true,
        "stateDuration": -1,
    });

    $(document).on('submit', '#form_establishment_type', function (event) {
        event.preventDefault();
        var name = $('#name').val();
        var state_id = $.trim($("#state_id :selected").val());

        if (name != '' && state_id != '') {
            $.ajax({
                url: "/StarListMaker/assets/services/establishment_type/crear.php",
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
                            $("#form_establishment_type")[0].reset();
                            $("#modal_establishment_type").modal('hide');
                            dataTable.ajax.reload();
                        }
                        $("#form_establishment_type")[0].reset();
                        $("#modal_establishment_type").modal('hide');
                        dataTable.ajax.reload();
                        return false;
                    });
                }
            });
        } else {
            alert("Algunos campos son obligatorios");
        }
    });

    //Funcionalidad de edit
    $(document).on('click', '.edit', function () {
        var id = $(this).attr("id");
        console.log("id: ", id);

        $.ajax({
            url: "/StarListMaker/assets/services/establishment_type/obtener_regitro.php",
            method: "POST",
            data: { id: id },
            dataType: "JSON",
            success: function (data) {
                console.log("data:", data);
                $('#modal_establishment_type').modal('show');
                $('#name').val(data.name);
                console.log("state_id: "+ data.state);
                $("#state_id option:contains(" + data.state + ")").attr("selected", true);
                $('.modal-title').text("Editar Tipo de Establecimiento");
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

    //Funcionalidad de eliminar
    $(document).on('click', '.delete', function () {
        var id = $(this).attr("id");
        Swal.fire({
            title: 'Estas seguro  que deseas eliminar el tipo de  establecimiento',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/StarListMaker/assets/services/establishment_type/eliminar.php",
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
});