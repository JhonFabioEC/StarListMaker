<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/StarListMaker/assets/services/connection/connection.php";
    include "$root/StarListMaker/assets/services/vehicle/funciones.php";

    if (isset($_POST["id"])) {
        $salida = array();

        $connection = new Connection();
        $stmt = $connection->prepare("SELECT * FROM view_vehicle WHERE id=".$_POST["id"]." LIMIT 1;");
        $stmt->execute();
        $resultado = $stmt->fetchAll();

        foreach($resultado as $fila) {
            $salida["name"] = $fila["name"];
            $salida["state"] = $fila["state"];
        }

        echo json_encode($salida);
    }