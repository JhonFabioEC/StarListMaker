<?php
    session_start();
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    include_once "$root/StarListMaker/assets/common/utils.php";
    include_once "$root/StarListMaker/assets/common/style.php";
    include_once "$root/StarListMaker/assets/common/script.php";

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
        $style->GetRegister($url);
    ?>
</head>

<body>
    <?php $utils->GetSpinner(); ?>

    <form action="#" method="POST" id="form_register" class="form shadow-lg rounded">
        <!-- Titulo del formulario -->
        <h1 class="text-center">Registrarse</h1>

        <!-- Formulario de nombres y apellidos -->
        <div class="form-step form-step-active">
            <h3 class="text-center mb-4">¿Como?</h3>

            <div class="form-outline mb-3">
                <!-- <div class="btn-group w-100" role="group" aria-label="Basic radio toggle button group"> -->
                <div class="btn-group w-100" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio" id="btnUser" autocomplete="off" checked>
                    <label class="btn btn-primary d-flex justify-content-center align-items-center" for="btnUser" style="width:148px; height: 148px;">
                        <div class="d-flex flex-column">
                            <i class="fas fa-user fs-2"></i>
                            <span>Usuario</span>
                        </div>
                    </label>

                    <input type="radio" class="btn-check" name="btnradio" id="btnEstablishment" autocomplete="off">
                    <label class="btn btn-primary d-flex justify-content-center align-items-center" for="btnEstablishment" style="width:148px; height: 148px;">
                        <div class="d-flex flex-column">
                            <i class="fa-solid fa-shop fs-2"></i>
                            <span>Establecimiento</span>
                        </div>
                    </label>
                </div>
            </div>

            <div class="mt-4">
                <a onclick="location.href='/StarListMaker/assets/pages/person/register.php';" type="reset" class="btn btn-primary w-100 btn-block" id="btnNext">Siguiente</a>
            </div>
        </div>

        <!-- Boton para ir al login -->
        <div class="text-center mt-4">
            <p>¿Ya eres miembro? <a href="/StarListMaker/assets/pages/login/index.php">Inicia Sesión</a></p>
        </div>
    </form>

    <!-- Obtener los script comunes y de usuarios de la clase Script del archivo script.php -->
    <?php
        $script->GetCommon($url);
        $script->GetRegister($url);
    ?>
</body>

</html>