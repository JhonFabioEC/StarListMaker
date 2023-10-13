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

    <form action="#" method="POST" id="formLogin" class="form shadow-lg rounded">
        <div class="col-sm-12 text-center mb-2">
            <h1>Iniciar Sesión</h1>
        </div>

        <!-- Username input -->
        <div class="form-outline mb-2">
            <div class="form-group">
                <label for="username" class="col-form-label">Usuario</label>
                <input type="text" name="username" id="username" placeholder="Ej: pepe@gmail.com" class="form-control is--invalid" required='true'>
            </div>
            <label for="username" id="username-error" class="error text-danger"></label>
        </div>

        <!-- Password input -->
        <div class="form-outline mb-2">
            <div class="form-group">
                <label for="password" class="col-form-label">Contraseña</label>
                <input type="password" name="password" id="password" placeholder="●●●●●●●●" class="form-control is--invalid" required='true'>
            </div>
            <label for="password" id="password-error" class="error text-danger"></label>
        </div>

        <!-- 2 column grid layout for inline styling -->
        <div class="d-flex justify-content-between mb-2">
            <div class="d-flex justify-content-center">
                <!-- Checkbox -->
                <!-- <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remenber" value="true" id="remenber" />
                    <label class="form-check-label" for="remenber"> Recordarme </label>
                </div> -->

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" name="remenber" value="true" id="remenber">
                    <label class="form-check-label" for="remenber">Recordarme</label>
                </div>
            </div>

            <div class="text-center">
                <!-- Simple link -->
                <a href="#!">¿Olvidó su contraseña?</a>
            </div>
        </div>

        <!-- Submit button -->
        <button id="btnLogin" class="btn btn-primary btn-block mb-2 w-100" type="Submit">
        <!-- <button id="btnLogin" class="btn btn-dark btn-block mb-2 w-100" type="Submit"> -->
            Iniciar sesión
        </button>

        <!-- Register buttons -->
        <div class="text-center">
            <p>¿No eres miembro? <a href="/StarListMaker/assets/pages/register/index.php">Registrate</a></p>
        </div>
    </form>

    <!-- Obtener los script comunes y de usuarios de la clase Script del archivo script.php -->
    <?php
        $script->GetCommon($url);
        $script->GetLogin($url);
        // $script->GetPerson($url);
    ?>
</body>

</html>