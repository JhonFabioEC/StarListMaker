<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/StarListMaker/assets/services/connection/connection.php";
    include "$root/StarListMaker/assets/services/establishment_type/funciones.php";

    if (isset($_POST["id"])) {
        $connection = new Connection();
        $stmt = $connection->prepare("
            UPDATE public.establishment_type
            SET
            deletion_date=current_timestamp,
            delete=:delete
            WHERE id=:id;
        ");

        $resultado = $stmt->execute(
            array(
                ':id'   => $_POST["id"],
                ':delete'   => true
            )
        );

        if (!empty($resultado)) {
            echo "El tipo de establecimineto ha sido eliminado";
        }
    }