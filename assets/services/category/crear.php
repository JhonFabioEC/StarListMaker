<?php
    session_start();
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/StarListMaker/assets/services/connection/connection.php";
    include "$root/StarListMaker/assets/services/category/funciones.php";

    if ($_POST["operacion"] == "Crear") {
        $connection = new Connection();
        $stmt = $connection->prepare("
            INSERT INTO category(
                name,
                state_id,
                establishment_id
            )VALUES(
                :name,
                :state_id,
                ".$_SESSION['id']."
            );
        ");

        $resultado = $stmt->execute(
            array(
                ':name'         => $_POST["name"],
                ':state_id'     => $_POST["state_id"]
            )
        );

        if (!empty($resultado)) {
            echo "Registro creado";
        }
    }

    if ($_POST["operacion"] == "Editar") {
        $connection = new Connection();
        $stmt = $connection->prepare("
            UPDATE category SET
                name=:name,
                state_id=:state_id,
                modification_date=current_timestamp
            WHERE id=:id;
        ");

        $resultado = $stmt->execute(
            array(
                ':name'         => $_POST["name"],
                ':state_id'     => $_POST["state_id"],
                ':id'           => $_POST["id"]
            )
        );

        if (!empty($resultado)) {
            echo "Registro actualizado";
        }
    }