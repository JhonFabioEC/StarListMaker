<?php
    // session_start();
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/StarListMaker/assets/services/connection/connection.php";
    include "$root/StarListMaker/assets/services/user/funciones.php";

    if (isset($_POST["id"])) {
        $salida = array();

        $connection = new Connection();
        $stmt = $connection->prepare("SELECT * FROM view_user WHERE user_id=".$_POST["id"]." LIMIT 1;");

        $stmt->execute();
        $resultado = $stmt->fetchAll();

        foreach($resultado as $fila) {
            $salida["username"] = $fila["username"];
            $rol_name = strtoupper($fila["role_type"] ) == strtoupper("Establecimiento") ? "establishment" : "person";
            $salida["account_status"] = $fila["account_status"];

            if ($fila["image"] != "") {
                $salida["image"] = '<img src="/StarListMaker/assets/img/user/'.$rol_name.'/'.$fila["image"].'" class="img-fluid img-thumbnail border border-0 bg-transparent" width="200" height="150" />
                    <input type="hidden" name="image_hidden" value="'.$fila["image"].'" />';
            } else {
                $salida["image"] = '<input type="hidden" name="image_hidden" value="" />';
            }
        }

        echo json_encode($salida);
    }