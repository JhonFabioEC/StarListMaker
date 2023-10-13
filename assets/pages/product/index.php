<?php
    session_start();
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    include_once "$root/StarListMaker/assets/common/utils.php";
    include_once "$root/StarListMaker/assets/common/style.php";
    include_once "$root/StarListMaker/assets/common/script.php";
    include_once "$root/StarListMaker/assets/services/common/state.php";
    include_once "$root/StarListMaker/assets/services/common/category.php";
    include_once "$root/StarListMaker/assets/services/common/brand.php";

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
                    <h3 class="m-0 me-auto h-100" id="title"><?php echo strtoupper("Productos"); ?></h3>

                    <!-- Button trigger modal -->
                    <button type="button" class="ms-2 btn btn-primary" data-bs-toggle="modal" title="Nuevo" data-bs-target="#modal_product" id="btnCreate">
                        <i class="fa fa-add"></i>
                    </button>
                </div>

                <div class="card-body p-3 w-100">
                    <div class="table-responsive p-1 w-100">
                        <table class="table table-striped table-hover table-bordered table-condensed display nowrap" id="table_product" cellspacing="30px" style="width: 100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Imagen</th>
                                    <th data-priority="1">Nombre</th>
                                    <th>Codigo de barras</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Categoría</th>
                                    <th>Marca</th>
                                    <th>Estado</th>
                                    <th>Seccion</th>
                                    <th>Descripcion</th>
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
        <div class="modal fade" id="modal_product" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" id="form_product" enctype="multipart/form-data" class="mw-100">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Producto</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                            <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <div class="form-outline">
                                            <label for="image_upload" class="col-form-label">Imagen</label>
                                            <div class="form-group d-flex w-100 justify-content-center">
                                                <div id="image_upload" class="overflow-hidden" style="width: 200px; height: 200px;">
                                                    <img src="" id="img" class="img-thumbnail border border-1 bg-transparent w-100 h-100" />
                                                    <input type="hidden" name="image_hidden" id="image_hidden" value="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="hr divider">

                                    <div class="col-lg-12 mb-4">
                                        <div class="form-outline">
                                            <div class="form-group text-center">
                                                <input type="file" name="image" id="image" class="form-control d-none" accept="image/*" />
                                                <label for="image" class="btn btn-secondary btn-block" style="width: 30%;">Cambiar foto</label>
                                                <button type="button" id="btnDelete" class="btn btn-danger btn-block" title="Eliminar"><i class='fa fa-trash'></i></button>
                                                <div id="response_image"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="name" class="col-form-label">Nombre</label>
                                            <input type="text" name="name" id="name" placeholder="Nombre del producto" class="form-control" required='true'>
                                        </div>
                                        <label id="name-error" class="error text-danger" for="name"></label>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="barcode" class="col-form-label">Codigo de barras</label>
                                            <input type="text" name="barcode" id="barcode" placeholder="Codigo de barras" class="form-control" required='true'>
                                        </div>
                                        <label id="barcode-error" class="error text-danger" for="barcode"></label>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="price" class="col-form-label">Precio</label>
                                            <input type="text" name="price" id="price" placeholder="Precio" class="form-control" required='true'>
                                        </div>
                                        <label id="price-error" class="error text-danger" for="price"></label>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="quantity" class="col-form-label">Cantidad</label>
                                            <input type="text" name="quantity" id="quantity" placeholder="Cantidad" class="form-control" required='true'>
                                        </div>
                                        <label id="quantity-error" class="error text-danger" for="quantity"></label>
                                    </div>

                                    <div class="col-lg-12">
                                        <label for="category_id" class="ml-3 col-sm-3 col-form-label">Categoría</label>
                                        <div class="col-sm-12">
                                            <select class="form-select col-sm-12" id="category_id" name="category_id" aria-label="Default select example" required='true'>
                                                <option value="">Escoger categoría...</option>
                                                <?php
                                                    foreach ($category as $c) {
                                                        echo '<option value="' . $c["id"] . '">' . $c["name"] . '</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <label id="category_id-error" class="error text-danger" for="category_id"></label>
                                    </div>

                                    <div class="col-lg-12">
                                        <label for="brand_id" class="ml-3 col-sm-3 col-form-label">Marca</label>
                                        <div class="col-sm-12">
                                            <select class="form-select col-sm-12" id="brand_id" name="brand_id" aria-label="Default select example" required='true'>
                                                <option value="">Escoger marca...</option>
                                                <?php
                                                    foreach ($brand as $b) {
                                                        echo '<option value="' . $b["id"] . '">' . $b["name"] . '</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <label id="brand_id-error" class="error text-danger" for="brand_id"></label>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="section" class="col-form-label">Seccion</label>
                                            <input type="text" name="section" id="section" placeholder="Seccion" class="form-control" required='true'>
                                        </div>
                                        <label id="section-error" class="error text-danger" for="section"></label>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="description" class="col-form-label">Descripcion</label>
                                            <input type="text" name="description" id="description" placeholder="Descripcion" class="form-control" required='true'>
                                        </div>
                                        <label id="description-error" class="error text-danger" for="description"></label>
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
        $script->GetProduct($url);
    ?>
</body>

</html>