<?php
session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/StarListMaker/assets/common/utils.php";
include_once "$root/StarListMaker/assets/common/style.php";
include_once "$root/StarListMaker/assets/common/script.php";
require_once "$root/StarListMaker/assets/services/connection/connection.php";
include_once "$root/StarListMaker/assets/services/common/department.php";
include_once "$root/StarListMaker/assets/services/common/municipality.php";
include_once "$root/StarListMaker/assets/services/common/gender.php";
include_once "$root/StarListMaker/assets/services/common/document_type.php";
include_once "$root/StarListMaker/assets/services/common/zone_type.php";
include_once "$root/StarListMaker/assets/services/person/detail.php";

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
    // $style->GetPerson($url);
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
                <form method="POST" id="form_person_delete" class="form shadow-lg rounded" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <h1 class="text-center fs-1 m-0">Eliminar perfil</h1>
                            <hr>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="form-group text-center">
                                <span id="image_upload">
                                    <img src="/StarListMaker/assets/img/user/person/<?php echo $person['image'] ?>" class="img-fluid img-thumbnail border border-5 bg-transparent rounded-circle" width="200" height="200" />
                                    <input type="hidden" name="image_hidden" value="<?php echo $person['image'] ?>" />
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="form-outline">
                                <div class="form-group">
                                    <label class="col-form-label">Nombres</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo $person['first_name'] ?>" disabled readonly required='true' />
                                    <div id="response_first_name"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-4">
                            <div class="form-outline">
                                <div class="form-group">
                                    <label class="col-form-label">Apellidos</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo $person['last_name'] ?>" disabled readonly required='true' />
                                    <div id="response_last_name"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="form-outline">
                                <div class="form-group">
                                    <label class="col-form-label w-100">Fecha de Nacimiento</label>
                                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control w-100" value="<?php echo $person['date_of_birth'] ?>" disabled readonly required='true' />
                                    <div id="response_date_of_birth"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-4">
                            <div class="form-outline">
                                <div class="form-group">
                                    <label class="col-form-label w-100">Género</label>
                                    <select id="gender_id" name="gender_id" class="form-control w-100" disabled readonly required='true' />
                                    <option value="">Seleccionar género</option>
                                    <?php
                                    foreach ($gender as $gd) {
                                        if ($gd["name"] == $person['gender']) {
                                            echo '<option selected value="' . $gd['id'] . '">' . $gd['name'] . '</option>';
                                        } else {
                                            echo '<option value="' . $gd['id'] . '">' . $gd['name'] . '</option>';
                                        }
                                    }
                                    ?>
                                    </select>
                                    <div id="response_gender_id"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="form-outline">
                                <div class="form-group">
                                    <label class="col-form-label w-100">Tipo de documento</label>
                                    <select id="document_type_id" name="document_type_id" class="form-control w-100" disabled readonly required='true' />
                                    <option value="">Seleccionar tipo de documento</option>
                                    <?php
                                    foreach ($document_type as $dt) {
                                        if ($dt["name"] == $person['document_type']) {
                                            echo '<option selected value="' . $dt['id'] . '">' . $dt['name'] . '</option>';
                                        } else {
                                            echo '<option value="' . $dt['id'] . '">' . $dt['name'] . '</option>';
                                        }
                                    }
                                    ?>
                                    </select>
                                    <div id="response_document_type_id"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-4">
                            <div class="form-outline">
                                <div class="form-group">
                                    <label class="col-form-label w-100">Número de documento</label>
                                    <input type="text" name="document_number" id="document_number" class="form-control w-100" value="<?php echo $person['document_number'] ?>" disabled readonly required='true' />
                                    <div id="response_document_number"></div>
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
                                        if ($dp["name"] == $person['department']) {
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
                                        if ($mt["name"] == $person['municipality']) {
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
                                    <select id="zone_type_id" name="zone_type_id" class="form-control w-100" disabled readonly required='true'>
                                        <option value="">Seleccionar tipo de zona</option>
                                        <?php
                                        foreach ($zone_type as $zt) {
                                            if ($zt["name"] == $person['zone_type']) {
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
                                    <input type="text" name="address" id="address" class="form-control w-100" value="<?php echo $person['address'] ?>" disabled readonly required='true' />
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
                                    <input type="text" name="phone_number" id="phone_number" class="form-control w-100" value="<?php echo $person['phone_number'] ?>" disabled readonly required='true' />
                                    <div id="response_phone_number"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-4">
                            <div class="form-outline">
                                <div class="form-group">
                                    <label class="col-form-label w-100">Correo Electrónico</label>
                                    <input type="text" name="email_address" id="email_address" class="form-control w-100" value="<?php echo $person['email_address'] ?>" disabled readonly required='true' />
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
                                    <input type="text" name="username" id="username" class="form-control w-100" value="<?php echo $person['username'] ?>" disabled readonly required='true' />
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

                    <div class="row d-none">
                        <div class="col-lg-6 mb-4">
                            <div class="form-outline">
                                <div class="form-group">
                                    <label class="col-form-label w-100">Nueva Contraseña</label>
                                    <input type="text" name="new_password" id="new_password" class="form-control w-100" value="●●●●●●●●" disabled readonly required='true' />
                                    <div id="response_new_password"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-4">
                            <div class="form-outline">
                                <div class="form-group">
                                    <label class="col-form-label w-100">Confirmar Contraseña</label>
                                    <input type="text" name="confirm_password" id="confirm_password" class="form-control w-100" value="●●●●●●●●" disabled readonly required='true' />
                                    <div id="response_confirm_password"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 m-0 mt-2 ms-auto">
                            <div class="form-outline">
                                <div class="form-group text-right">
                                    <div class="btns-group">
                                        <input type="hidden" name="id" id="id" value="<?php echo $person['user_id'] ?>">

                                        <button type="button" onclick="location.href='/StarListMaker/assets/pages/person/view.php';" class="btn btn-secondary btn-block" id="btn_back"><i class="fa-solid fa-caret-left"></i> Atras</button>
                                        <button type="submit" class="btn btn-danger btn-block" id="btn_delete"><i class='fa fa-trash'></i> Aceptar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include_once "$root/StarListMaker/assets/pages/list/modal_cart.php"; ?>

    <?php
    $script->GetCommon($url);
    $script->GetPerson($url);
    ?>
</body>

</html>