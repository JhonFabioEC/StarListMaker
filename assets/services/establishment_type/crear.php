<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/StarListMaker/assets/services/connection/connection.php";
    include "$root/StarListMaker/assets/services/establishment_type/funciones.php";

    if ($_POST["operacion"] == "Crear") {
        $connection = new Connection();
        $stmt = $connection->prepare("
            INSERT INTO establishment_type(
                name,
                state_id
            )VALUES(
                :name,
                :state_id
            );
        ");

        $resultado = $stmt->execute(
            array(
                ':name'       => $_POST["name"],
                ':state_id'   => $_POST["state_id"]
            )
        );

        if (!empty($resultado)) {
            echo "Registro creado";
        }
    }

    if ($_POST["operacion"] == "Editar") {
        $connection = new Connection();
        $stmt = $connection->prepare("
            UPDATE establishment_type SET
                name=:name,
                state_id=:state_id,
                modification_date=current_timestamp
            WHERE id=:id;
        ");

        $resultado = $stmt->execute(
            array(
                ':name'       => $_POST["name"],
                ':state_id'   => $_POST["state_id"],
                ':id'         => $_POST["id"]
            )
        );

        if (!empty($resultado)) {
            echo "Registro actualizado";
        }
    }