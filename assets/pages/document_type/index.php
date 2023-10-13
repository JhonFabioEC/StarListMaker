<?php
    session_start();
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    include_once "$root/StarListMaker/assets/common/utils.php";
    include_once "$root/StarListMaker/assets/common/style.php";
    include_once "$root/StarListMaker/assets/common/script.php";
    include_once "$root/StarListMaker/assets/services/common/state.php";

    $utils = new Utils();
    $style = new Style();
    $script = new Script();

    $url = "/StarListMaker/";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php
        $utils->GetHead("Star List Maker");
        $style->GetCommon($url);
    ?>
</head>

<body>
    <?php $utils->GetSpinner(); ?>

    <header>
        <?php include "$root/StarListMaker/assets/common/navbar.php"; ?>
    </header>

    <main>
        <div class="container--all d-flex justify-content-center align-items-center">
            <div class="card w-100">
                <div class="card-header d-flex flex-row justify-content-center align-items-center p-3 w-100">
                    <h3 class="me-auto" id="title"><?php echo strtoupper("Tipos de documento"); ?></h3>

                    <button id="btnNuevo" type="button" class="ms-2 btn btn-outline-primary" data-toggle="modal" title="Nuevo"><span class="fa fa-add"></span></button>
                </div>

                <div class="card-body p-3 w-100">
                    <div class="table-responsive p-1 w-100">
                        <table class="table table-striped table-bordered table-condensed display nowrap" id="tableDocumentType" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th data-priority="1">Nombre</th>
                                    <th>Fecha de creación</th>
                                    <th>Fecha de modificación</th>
                                    <th>Fecha de eliminación</th>
                                    <th>Estado</th>
                                    <th data-priority="2">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalCRUD" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLable"></h5>
                        <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
                    </div>

                    <form id="formDocumentType">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label">Nombre</label>
                                        <input type="text" name="name" id="name" placeholder="Nombre de usuario" class="form-control" autofocus required>
                                    </div>
                                    <label id="name-error" class="error text-danger" for="name"></label>
                                </div>

                                <div class="col-lg-12">
                                    <label for="state_id" class="ml-3 col-sm-3 col-form-label">Estado</label>
                                    <div class="col-sm-12">
                                        <select class="form-select col-sm-12" id="state_id" name="state_id" aria-label="Default select example" required>
                                            <option value="">Escoger estado...</option>
                                            <?php
                                                foreach ($state as $s) {
                                                    echo '<option value="' . $s["id"] . '">' . $s["name"] . '</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <label id="state_id-error" class="error text-danger" for="state_id"></label>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-primary" id="btnGuardar"><span class="fa fa-save"></span> Guardar</button>
                            <button type="button" class="btn btn-outline-primary" id="btnCancelar" data-bs-dismiss="modal"><span class="fa fa-close"></span> Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer>
    </footer>

    <?php
        $script->GetCommon($url);
        $script->GetDocumentType($url);
    ?>
</body>

</html>