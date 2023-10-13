<?php
    session_start();
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    include_once "$root/StarListMaker/assets/common/utils.php";
    include_once "$root/StarListMaker/assets/common/style.php";
    include_once "$root/StarListMaker/assets/common/script.php";
    require_once "$root/StarListMaker/assets/services/connection/connection.php";
    include_once "$root/StarListMaker/assets/services/common/department.php";
    include_once "$root/StarListMaker/assets/services/common/gender.php";
    include_once "$root/StarListMaker/assets/services/common/document_type.php";
    include_once "$root/StarListMaker/assets/services/common/zone_type.php";

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
        $style->GetPerson($url);
    ?>
</head>

<body>
    <?php $utils->GetSpinner(); ?>

    <form action="#" method="POST" id="form_person" class="form shadow-lg rounded">
        <!-- Titulo del formulario -->
        <h1 class="text-center">Registrarse</h1>

        <!-- Barra de progreso -->
        <div class="progressbar mb-3">
            <div class="progress" id="progress"></div>

            <div class="progress-step progress-step-active"></div>
            <div class="progress-step"></div>
            <div class="progress-step"></div>
            <div class="progress-step"></div>
            <div class="progress-step"></div>
            <div class="progress-step"></div>
            <div class="progress-step"></div>
        </div>

        <!-- Pasos - step -->

        <!-- Formulario de nombres y apellidos -->
        <div class="form-step form-step-active">
            <div class="form-outline mb-3">
                <div class="form-group">
                    <label class="col-form-label w-100">Nombres</label>
                    <input type="text" name="first_name" id="first_name" class="form-control w-100" required='true' />
                    <div id="response_first_name"></div>
                </div>
            </div>

            <div class="form-outline mb-3">
                <div class="form-group">
                    <label class="col-form-label w-100">Apellidos</label>
                    <input type="text" name="last_name" id="last_name" class="form-control w-100" required='true' />
                    <div id="response_last_name"></div>
                </div>
            </div>

            <div class="mt-4">
                <a href="#" class="btn btn-primary btn-next btn-p1 disabled w-100 btn-block">Siguiente</a>
            </div>
        </div>

        <!-- Formulario de fecha de nacimiento y género -->
        <div class="form-step">
            <div class="form-outline mb-3">
                <div class="form-group">
                    <label class="col-form-label w-100">Fecha de Nacimiento</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control w-100" required='true' />
                    <div id="response_date_of_birth"></div>
                </div>
            </div>

            <div class="form-outline mb-3">
                <label class="col-form-label w-100">Género</label>
                <select id="gender_id" name="gender_id" class="form-control w-100" required='true'>
                    <option value="">Seleccionar género</option>
                    <?php
                    foreach ($gender as $gd) {
                        echo '<option value="' . $gd['id'] . '">' . $gd['name'] . '</option>';
                    }
                    ?>
                </select>
                <div id="response_gender_id"></div>
            </div>

            <div class="btns-group mt-4">
                <a href="#" class="btn btn-primary btn-prev btn-block">Anterior</a>
                <a href="#" class="btn btn-primary btn-next btn-p2 disabled btn-block">Siguiente</a>
            </div>
        </div>

        <!-- Formulario de tipo de documento y número de documento -->
        <div class="form-step">
            <div class="form-outline mb-3">
                <label class="col-form-label w-100">Tipo de documento</label>
                <select id="document_type_id" name="document_type_id" class="form-control w-100" required='true'>
                    <option value="">Seleccionar tipo de documento</option>
                    <?php
                    foreach ($document_type as $dt) {
                        echo '<option value="' . $dt['id'] . '">' . $dt['name'] . '</option>';
                    }
                    ?>
                </select>
                <div id="response_document_type_id"></div>
            </div>

            <div class="form-outline mb-3">
                <div class="form-group">
                    <label class="col-form-label w-100">Número de documento <strong>(6 - 10)</strong></label>
                    <input type="text" name="document_number" id="document_number" class="form-control w-100" required='true' />
                    <div id="response_document_number"></div>
                </div>
            </div>

            <div class="btns-group mt-4">
                <a href="#" class="btn btn-primary btn-prev btn-block">Anterior</a>
                <a href="#" class="btn btn-primary btn-next btn-p3 disabled btn-block">Siguiente</a>
            </div>
        </div>

        <!-- Formulario de departamento y municipio -->
        <div class="form-step">
            <div class="form-outline mb-3">
                <label class="col-form-label w-100">Departamento</label>
                <select id="department_id" name="department_id" class="form-control w-100" required='true'>
                    <option value="">Seleccionar departamento</option>
                    <?php
                    foreach ($department as $dp) {
                        echo '<option value="' . $dp['id'] . '">' . $dp['name'] . '</option>';
                    }
                    ?>
                </select>
                <div id="response_department_id"></div>
            </div>

            <div class="form-outline mb-3">
                <label class="col-form-label w-100">Municipio</label>
                <select id="municipality_id" name="municipality_id" class="form-control w-100" disabled='true' required='true'>
                    <option value="none">Seleccionar municipio</option>
                </select>
                <div id="response_municipality_id"></div>
            </div>

            <div class="btns-group mt-4">
                <a href="#" class="btn btn-primary btn-prev btn-block">Anterior</a>
                <a href="#" class="btn btn-primary btn-next btn-p4 disabled btn-block">Siguiente</a>
            </div>
        </div>

        <!-- Formulario de tipo de zona y dirección -->
        <div class="form-step">
            <div class="form-outline mb-3">
                <label class="col-form-label w-100">Tipo de zona</label>
                <select id="zone_type_id" name="zone_type_id" class="form-control w-100" required='true'>
                    <option value="">Seleccionar tipo de zona</option>
                    <?php
                    foreach ($zone_type as $zt) {
                        echo '<option value="' . $zt['id'] . '">' . $zt['name'] . '</option>';
                    }
                    ?>
                </select>
                <div id="response_zone_type_id"></div>
            </div>

            <div class="form-outline mb-3">
                <div class="form-group">
                    <label class="col-form-label w-100">Dirección</label>
                    <input type="text" name="address" id="address" class="form-control w-100" required='true' />
                    <div id="response_address"></div>
                </div>
            </div>

            <div class="btns-group mt-4">
                <a href="#" class="btn btn-primary btn-prev btn-block">Anterior</a>
                <a href="#" class="btn btn-primary btn-next btn-p5 disabled btn-block">Siguiente</a>
            </div>
        </div>

        <!-- Formulario de número de teléfono y correo electrónico -->
        <div class="form-step">
            <div class="form-outline mb-3">
                <div class="form-group">
                    <label class="col-form-label w-100">Número de Teléfono <strong>(10)</strong></label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control w-100" required='true' />
                    <div id="response_phone_number"></div>
                </div>
            </div>

            <div class="form-outline mb-3">
                <div class="form-group">
                    <label class="col-form-label w-100">Correo Electrónico</label>
                    <input type="text" name="email_address" id="email_address" class="form-control w-100" required='true' />
                    <div id="response_email_address"></div>
                </div>
            </div>

            <div class="btns-group mt-4">
                <a href="#" class="btn btn-primary btn-prev btn-block">Anterior</a>
                <a href="#" class="btn btn-primary btn-next btn-p6 disabled btn-block">Siguiente</a>
            </div>
        </div>

        <!-- Formulario de nombre de usuario, contraseña y confirmar contraseña -->
        <div class="form-step">
            <div class="form-outline mb-3">
                <div class="form-group">
                    <label class="col-form-label w-100">Nombre de Usuario</label>
                    <input type="text" name="username" id="username" class="form-control w-100" required='true' />
                    <div id="response_username"></div>
                </div>
            </div>

            <div class="form-outline mb-3">
                <div class="form-group">
                    <label class="col-form-label w-100">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control w-100" required='true' />
                    <div id="response_password"></div>
                </div>
            </div>

            <div class="form-outline mb-3">
                <div class="form-group">
                    <label class="col-form-label w-100">Confirmar Contraseña</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control w-100" required='true' />
                    <div id="response_confirm_password"></div>
                </div>
            </div>

            <div class="btns-group mt-4">
                <a href="#" class="btn btn-primary btn-prev btn-block">Anterior</a>
                <!-- <input type="submit" class="btn btn-primary btn-p7 disabled btn-block" value="Crear" /> -->
                <button type="submit" class="btn btn-primary btn-p7 disabled btn-block" id="btn_create">Crear</button>
            </div>
        </div>

        <!-- Boton para ir al login -->
        <div class="text-center mt-4">
            <p>¿Ya eres miembro? <a href="../assets/../login/index.php">Inicia Sesión</a></p>
        </div>
    </form>

    <!-- Obtener los script comunes y de usuarios de la clase Script del archivo script.php -->
    <?php
        $script->GetCommon($url);
        $script->GetPersonValidate($url);
        $script->GetPerson($url);
    ?>
</body>

</html>