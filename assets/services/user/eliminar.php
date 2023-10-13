<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/StarListMaker/assets/services/connection/connection.php";
    include "$root/StarListMaker/assets/services/product/funciones.php";

    if (isset($_POST["id"])) {
        $image = obtener_nombre_imagen($_POST["id"]);

        if($image != ""){
            //unlink("img/".$_POST["id"]);
            unlink("$root/StarListMaker/assets/img/product/$image");
        }

        $connection = new Connection();
        $stmt = $connection->prepare("
            DELETE FROM product WHERE id=:id;
        ");

        $resultado = $stmt->execute(
            array(
                ':id'   => $_POST["id"]
            )
        );

        if (!empty($resultado)) {
            echo "Registro eliminado";
        }
    }