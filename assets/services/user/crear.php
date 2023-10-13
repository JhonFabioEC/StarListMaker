<?php
    session_start();
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/StarListMaker/assets/services/connection/connection.php";
    include "$root/StarListMaker/assets/services/user/funciones.php";



    if ($_POST["operacion"] == "Editar") {

        $connection = new Connection();
        $stmt = $connection->prepare("
            UPDATE public.user SET
                account_status_id=:account_status_id 
            WHERE id=:id;
        ");

        $resultado = $stmt->execute(
            array(
                ':account_status_id'    => $_POST["account_status_id"],
                ':id'                   => $_POST["id"]
            )
        );

        if (!empty($resultado)) {
            echo "Registro actualizado";
        }
    }