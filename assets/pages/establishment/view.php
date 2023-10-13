<?php
session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/StarListMaker/assets/common/utils.php";
include_once "$root/StarListMaker/assets/common/style.php";
include_once "$root/StarListMaker/assets/common/script.php";
require_once "$root/StarListMaker/assets/services/connection/connection.php";
include_once "$root/StarListMaker/assets/services/common/department.php";
include_once "$root/StarListMaker/assets/services/common/municipality.php";
include_once "$root/StarListMaker/assets/services/common/establishment_type.php";
include_once "$root/StarListMaker/assets/services/common/document_type.php";
include_once "$root/StarListMaker/assets/services/common/zone_type.php";
include_once "$root/StarListMaker/assets/services/establishment/detail.php";

$utils = new Utils();
$style = new Style();
$script = new Script();

$url = "/StarListMaker";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Obtener el head de la clase Utils del archivo utils.php -->
    <?php $utils->GetHead("Star List Maker"); ?>

    <!-- Obtener el head y los estilos comunes y de usuario de la clase Style del archivo style.php -->
    <?php
    $style->GetCommon($url);
    // $style->Getestablishment($url);
    ?>
</head>

<body>
    <header>
        <?php include "$root/StarListMaker/assets/common/navbar.php"; ?>
    </header>

    <?php $utils->GetSpinner(); ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <form action="#" method="POST" id="form_establishment" class="form shadow-lg rounded">
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <h1 class="text-center fs-1 m-0">Mi perfil</h1>
                            <hr>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="form-outline">
                                <div class="form-group d-flex w-100 justify-content-center">
                                    <div id="image_upload" class="overflow-hidden" style="width: 200px; height: 200px;">
                                        <img src="/StarListMaker/assets/img/user/establishment/<?php echo $establishment['image'] ?>" id="img"
                                            class="img-thumbnail border border-5 bg-transparent rounded-circle w-100 h-100" />
                                        <input type="hidden" name="image_hidden" value="<?php echo $establishment['image'] ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="form-outline">
                                <div class="form-group">
                                    <label class="col-form-label">Nombre</label>
                                    <input type="text" name="name" id="name" class="form-control" value="<?php echo $establishment['name'] ?>" disabled readonly required='true' />
                                    <div id="response_name"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-4">
                            <div class="form-outline">
                                <div class="form-group">
                                <label class="col-form-label w-100">Tipo de establecimiento</label>
                                    <select id="establishment_type_id" name="establishment_type_id" class="form-control w-100" disabled readonly required='true' />
                                        <option value="">Seleccionar esta</option>
                                        <?php
                                        foreach ($establishment_type as $et) {
                                            if ($et["name"] == $establishment['establishment_type']) {
                                                echo '<option selected value="' . $et['id'] . '">' . $et['name'] . '</option>';
                                            } else {
                                                echo '<option value="' . $et['id'] . '">' . $et['name'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <div id="response_establishment_type_id"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="form-outline">
                                <div class="form-group">
                                    <label class="col-form-label w-100">Departamento</label>
                                    <select id="department_id" name="department_id" class="form-control w-100" disabled readonly required='true' />
                                        <option value="">Seleccionar departamento</option>
                                        <?php
                                        foreach ($department as $dp) {
                                            if ($dp["name"] == $establishment['department']) {
                                                echo '<option selected value="' . $dp['id'] . '">' . $dp['name'] . '</option>';
                                            } else {
                                                echo '<option value="' . $dp['id'] . '">' . $dp['name'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <div id="response_department_id"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-4">
                            <div class="form-outline">
                                <div class="form-group">
                                    <label class="col-form-label w-100">Municipio</label>
                                    <select id="municipality_id" name="municipality_id" class="form-control w-100" disabled readonly required='true' />
                                        <option value="none">Seleccionar municipio</option>

                                        <?php
                                        foreach ($municipality as $mt) {
                                            if ($mt["name"] == $establishment['municipality']) {
                                                echo '<option selected value="' . $mt['id'] . '">' . $mt['name'] . '</option>';
                                            } else {
                                                echo '<option value="' . $mt['id'] . '">' . $mt['name'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <div id="response_municipality_id"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="form-outline">
                                <div class="form-group">
                                    <label class="col-form-label w-100">Tipo de zona</label>
                                    <select id="zone_type_id" name="zone_type_id" class="form-control w-100" disabled readonly required='true' >
                                        <option value="">Seleccionar tipo de zona</option>
                                        <?php
                                        foreach ($zone_type as $zt) {
                                            if ($zt["name"] == $establishment['zone_type']) {
                                                echo '<option selected value="' . $zt['id'] . '">' . $zt['name'] . '</option>';
                                            } else {
                                                echo '<option value="' . $zt['id'] . '">' . $zt['name'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <div id="response_zone_type_id"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-4">
                            <div class="form-outline">
                                <div class="form-group">
                                    <label class="col-form-label w-100">Dirección</label>
                                    <input type="text" name="address" id="address" class="form-control w-100" value="<?php echo $establishment['address'] ?>" disabled readonly required='true' />
                                    <div id="response_address"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="form-outline">
                                <div class="form-group">
                                    <label class="col-form-label w-100">Número de Teléfono</label>
                                    <input type="text" name="phone_number" id="phone_number" class="form-control w-100" value="<?php echo $establishment['phone_number'] ?>" disabled readonly required='true' />
                                    <div id="response_phone_number"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-4">
                            <div class="form-outline">
                                <div class="form-group">
                                    <label class="col-form-label w-100">Correo Electrónico</label>
                                    <input type="text" name="email_address" id="email_address" class="form-control w-100" value="<?php echo $establishment['email_address'] ?>" disabled readonly required='true'  />
                                    <div id="response_email_address"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="form-outline">
                                <div class="form-group">
                                    <label class="col-form-label w-100">Nombre de Usuario</label>
                                    <input type="text" name="username" id="username" class="form-control w-100" value="<?php echo $establishment['username'] ?>" disabled readonly required='true' />
                                    <div id="response_username"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-4">
                            <div class="form-outline">
                                <div class="form-group">
                                    <label class="col-form-label w-100">Contraseña</label>
                                    <input type="text" name="password" id="password" class="form-control w-100" value="●●●●●●●●" disabled readonly required='true' />
                                    <div id="response_password"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 m-0 mt-2 ms-auto">
                            <div class="form-outline">
                                <div class="form-group text-right">
                                    <div class="btns-group">
                                        <input type="hidden" name="id" id="id">
                                        <input type="hidden" name="operacion" id="operacion">
                                        <button type="button" onclick="location.href='/StarListMaker/assets/pages/establishment/edit.php';"
                                            class="btn btn-warning text-white btn-block" id="btn_edit"><i class='fa fa-edit'></i> Editar</button>
                                        <button type="button" onclick="location.href='/StarListMaker/assets/pages/establishment/delete.php';"
                                            class="btn btn-danger btn-block" id="btn_delete"><i class='fa fa-trash'></i> Eliminar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    $script->GetCommon($url);
    // $script->Getestablishment($url);
    ?>
</body>

</html>