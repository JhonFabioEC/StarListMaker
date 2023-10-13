<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/StarListMaker/assets/services/connection/connection.php";
    include "$root/StarListMaker/assets/services/establishment/funciones.php";

    if (isset($_POST["id"])) {
        $image = obtener_nombre_imagen($_POST["id"]);

        if($image != "default.svg"){
            unlink("$root/StarListMaker/assets/img/user/establishment/$image");
        }

        $connection = new Connection();
        $stmt = $connection->prepare("
            UPDATE public.user
            SET
            image='default.svg',
            deletion_date=current_timestamp,
            delete=:delete
            WHERE id=:id;
        ");

        $resultado = $stmt->execute(
            array(
                ':id'       => $_POST["id"],
                ':delete'   => true
            )
        );

        if (!empty($resultado)) {
            $_SESSION['image'] = "default.svg";
            echo "Registro eliminado";
        }
    }