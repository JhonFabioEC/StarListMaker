<?php
    session_start();
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/StarListMaker/assets/services/connection/connection.php";
    include "$root/StarListMaker/assets/services/product/funciones.php";

    if (isset($_POST["id"])) {
        $salida = array();

        $connection = new Connection();
        $stmt = $connection->prepare("SELECT * FROM view_product WHERE id=".$_POST["id"]." AND establishment=".$_SESSION['id']." LIMIT 1;");

        $stmt->execute();
        $resultado = $stmt->fetchAll();

        foreach($resultado as $fila) {
            $salida["name"] = $fila["name"];
            $salida["barcode"] = $fila["barcode"];
            $salida["price"] = $fila["price"];
            $salida["quantity"] = $fila["quantity"];
            $salida["category"] = $fila["category"];
            $salida["brand"] = $fila["brand"];
            $salida["section"] = $fila["section"];
            $salida["description"] = $fila["description"];
            $salida["state"] = $fila["state"];

            // if ($fila["image"] != "") {
            //     $salida["image"] = '<img src="/StarListMaker/assets/img/product/'.$fila["image"].'" class="img-fluid img-thumbnail border border-0 bg-transparent" width="200" height="150" />
            //         <input type="hidden" name="image_hidden" value="'.$fila["image"].'" />';
            // } else {
            //     $salida["image"] = '<input type="hidden" name="image_hidden" value="" />';
            // }

            if ($fila["image"] != "") {
                $salida["image"] = $fila["image"];
            } else {
                $salida["image"] = 'default.svg';
            }
        }

        echo json_encode($salida);
    }