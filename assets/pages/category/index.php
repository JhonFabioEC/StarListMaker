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
                    <h3 class="m-0 me-auto h-100" id="title"><?php echo strtoupper("Categorias"); ?></h3>

                    <!-- Button trigger modal -->
                    <button type="button" class="ms-2 btn btn-primary" data-bs-toggle="modal" title="Nuevo" data-bs-target="#modal_category" id="btnCreate">
                        <i class="fa fa-add"></i>
                    </button>
                </div>

                <div class="card-body p-3 w-100">
                    <div class="table-responsive p-1 w-100">
                        <table class="table table-striped table-hover table-bordered table-condensed display nowrap" id="table_category" style="width: 100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th data-priority="1">Nombre</th>
                                    <th>Estado</th>
                                    <th>Fecha de creación</th>
                                    <th>Fecha de modificación</th>
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

        <!-- Modal -->
        <div class="modal fade" id="modal_category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" id="form_category" enctype="multipart/form-data" class="mw-100">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Tipo de Establecimiento</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="name" class="col-form-label">Nombre</label>
                                            <input type="text" name="name" id="name" placeholder="Nombre de usuario" class="form-control" required='true'>
                                        </div>
                                        <label id="name-error" class="error text-danger" for="name"></label>
                                    </div>

                                    <div class="col-lg-12">
                                        <label for="state_id" class="ml-3 col-sm-3 col-form-label">Estado</label>
                                        <div class="col-sm-12">
                                            <select class="form-select col-sm-12" id="state_id" name="state_id" aria-label="Default select example" required='true'>
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
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="operacion" id="operacion">
                                <input type="submit" name="action" id="action" class="btn btn-success" value="Crear">
                            </div>
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
        $script->GetCategory($url);
    ?>
</body>

</html>