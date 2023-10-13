<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/StarListMaker/assets/services/connection/connection.php";
    include "$root/StarListMaker/assets/services/category/funciones.php";

    if (isset($_POST["id"])) {
        $connection = new Connection();
        $stmt = $connection->prepare("
            UPDATE public.category
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
            echo "Categoria eliminada";
        }
    }