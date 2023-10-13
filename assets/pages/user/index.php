<?php
    session_start();
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    include_once "$root/StarListMaker/assets/common/utils.php";
    include_once "$root/StarListMaker/assets/common/style.php";
    include_once "$root/StarListMaker/assets/common/script.php";
    include_once "$root/StarListMaker/assets/services/common/account_status.php";

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
                    <h3 class="m-0 me-auto h-100" id="title"><?php echo strtoupper("Usuarios"); ?></h3>
                </div>

                <div class="card-body p-3 w-100">
                    <div class="table-responsive p-1 w-100">
                        <table class="table table-striped table-hover table-bordered table-condensed display nowrap" id="table_user" cellspacing="30px" style="width: 100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Imagen</th>
                                    <th data-priority="1">Nombre de usuario</th>
                                    <th>Correo electronico</th>
                                    <th>Tipo de rol</th>
                                    <th>Estado de cuenta</th>
                                    <th>Fecha de creación</th>
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
        <div class="modal fade" id="modal_user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" id="form_user" enctype="multipart/form-data" class="mw-100">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Crear usuario</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group text-center">
                                            <span id="image_upload"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="username" class="col-form-label">Nombre del usuario</label>
                                            <input type="text" name="username" id="username" placeholder="Nombre del usuario" class="form-control" disabled readonly>
                                        </div>
                                        <label id="username-error" class="error text-danger" for="username"></label>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="account_status_id" class="col-form-label">Estado de cuenta</label>
                                            <select class="form-select col-sm-12" id="account_status_id" name="account_status_id" aria-label="Default select example" required='true'>
                                                <option value="">Escoger estado de cuenta...</option>
                                                <?php
                                                    foreach ($account_status as $a) {
                                                        echo '<option value="' . $a["id"] . '">' . $a["name"] . '</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <label id="account_status_id-error" class="error text-danger" for="account_status_id"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="operacion" id="operacion">
                                <input type="submit" name="action" id="action" class="btn btn-success" value="Editar">
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
        $script->GetUser($url);
    ?>
</body>

</html>