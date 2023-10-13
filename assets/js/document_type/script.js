$('#formDocumentType').validate({
    rules: {
        name: {required: true},
        state_id: {required: true},
    }
});

$(document).ready(function () {
    var url = "/StarListMaker/assets/services/document_type/controller/controller.php";
    var title = "tipo de documento";
    var accion = "";
    var row, id;

    tableDocumentType = $("#tableDocumentType").DataTable({
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ],
        autoWidth: false,

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

        "bProcessing": true,
        "bDeferRender": true,
        "bServerSide": true,
        "sAjaxSource": "/StarListMaker/assets/services/document_type/model/list.serverside.php",
        "columnDefs": [{
            "targets": -1,
            "defaultContent":
                "<div class='text-center'>" +
                "<div class='btn-group'>" +
                "<button class='btn btn-warning btn-sm text-white btnModificar'><span class='fa fa-edit'></span></button>" +
                "<button class='btn btn-danger btn-sm text-white btnEliminar'><span class='fa fa-trash'></span></button>" +
                "</div>" +
                "</div>",
        }],
    });

    $("#formDocumentType").submit(function (e) {
        e.preventDefault();
        name = $.trim($("#name").val());
        state_id = $.trim($("#state_id :selected").val());

        if($('#formDocumentType').valid() == false) {
            return;
        }

        name = $.trim($('#name').val());
        state_id = $.trim($('#state_id').val());

        switch (accion) {
            case "GUARDAR":
                console.log("name: ", name);
                console.log("state_id: ", state_id);
        
                GetStatusBtnGuardar(name, state_id);

                $.ajax({
                    url: url,
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        id: id,
                        name: name,
                        state_id: state_id,
                        accion: accion,
                    },
                    success: function (data) {
                        console.log("data:", data);
                        Swal.fire("¡Guardado!", "", "success");
                        $("#modalCRUD").modal("hide");
                        tableDocumentType.ajax.reload(null, false);

                        $("#btnGuardar").html('<span class="fa fa-save"></span> Guardar');
                        $('#btnGuardar').attr('disabled', false);
                        $('#btnCancelar').attr('disabled', false);
                    }
                });
                break;

            case "MODIFICAR":
                Swal.fire({
                    title: '¿Desea guardar los cambios?',
                    icon: 'question',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    denyButtonText: `No guardar`,
                    cancelButtonText: "Cancelar",
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log("name: ", name);
                        console.log("state_id: ", state_id);
                
                        GetStatusBtnGuardar(name, state_id);

                        $.ajax({
                            url: url,
                            type: "POST",
                            dataType: "JSON",
                            data: {
                                id: id,
                                name: name,
                                state_id: state_id,
                                accion: accion,
                            },
                            success: function (data) {
                                console.log("data:", data);
                                Swal.fire("¡Guardado!", "", "success");
                                $("#modalCRUD").modal("hide");
                                tableDocumentType.ajax.reload(null, false);

                                $("#btnGuardar").html('<span class="fa fa-save"></span> Guardar');
                                $('#btnGuardar').attr('disabled', false);
                                $('#btnCancelar').attr('disabled', false);
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire("¡Los cambios no se han guardado!", "", "info");
                        $("#modalCRUD").modal("hide");

                        $("#btnGuardar").html('<span class="fa fa-save"></span> Guardar');
                        $('#btnGuardar').attr('disabled', false);
                        $('#btnCancelar').attr('disabled', false);
                    }
                });
                break;
        }
    });

    $("#btnNuevo").click(function () {
        OcultarMensajes();
        accion = "GUARDAR";
        id = null;
        $("#formDocumentType").trigger("reset");
        $(".modal-title").text(("Nuevo "+title).toUpperCase());
        $("#modalCRUD").modal("show");
    });

    $(document).on("click", ".btnModificar", function () {
        OcultarMensajes();
        accion = "MODIFICAR";
        row = $(this).closest("tr");
        id = parseInt(row.find("td:eq(0)").text());
        name = row.find("td:eq(1)").text();
        state = row.find("td:eq(5)").text();
        console.log("state: ",state);

        $("#name").val(name);

        $("#state_id option:contains("+state+")").attr("selected",true);

        $(".modal-title").text(("Modificar "+title).toUpperCase());
        $("#modalCRUD").modal("show");
    });

    $(document).on("click", ".btnEliminar", function () {
        row = $(this);
        id = parseInt($(this).closest("tr").find("td:eq(0)").text());
        accion = "ELIMINAR";

        Swal.fire({
            title: "¿Estás seguro?",
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "¡Sí, elimínalo!",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    data: { id: id, accion: accion },
                    type: "POST",
                    dataType: "json",
                    success: function () {
                        Swal.fire("¡Borrado!", "El "+(title).toLowerCase()+" ha sido borrado con exito", "success");
                        tableDocumentType.row(row.parents("tr")).remove().draw();
                    },
                });
            }
        });
    });
});

function OcultarMensajes() {
    $("#name-error").hide();
    $("#state_id-error").hide();
}

function GetStatusBtnGuardar(name, state_id) {
    if (name != "" && state_id != "") {
        console.log("Click");

        $('#btnGuardar').attr('disabled', true);
        $('#btnCancelar').attr('disabled', true);

        $("#btnGuardar").html(`
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Cargando...
        `);
    }
}