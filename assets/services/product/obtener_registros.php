<?php
    session_start();
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/StarListMaker/assets/services/connection/connection.php";
    include "$root/StarListMaker/assets/services/product/funciones.php";

    $query = '';
    $salida = array();
    $query = "SELECT * FROM view_product WHERE establishment=".$_SESSION['id']. " ";

    if (isset($_POST["search"]["value"])) {
        $query .= "AND (name ILIKE '%" . $_POST["search"]["value"] . "%' ";
        $query .= "OR state ILIKE '%" . $_POST["search"]["value"] . "%') ";
    }

    if (isset($_POST["order"])) {
        $query .= "ORDER BY " . ($_POST["order"][0]["column"] + 1) . " " . $_POST["order"][0]["dir"] . " ";
    } else {
        $query .= "ORDER BY id DESC ";
    }

    if ($_POST["length"] != -1) {
        $query .= "LIMIT " . $_POST["length"] . " OFFSET " . $_POST["start"];
    }

    $connection = new Connection();
    $stmt = $connection->prepare($query);
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    $datos = array();
    $filtered_rows = $stmt->rowCount();

    foreach ($resultado as $fila) {
        $image = '';

        if ($fila['image'] != '') {
            $image = '<img src="/StarListMaker/assets/img/product/'.$fila["image"].'" class="img-fluid img-thumbnail border border-0 bg-transparent" width="50" height="35" />';
        }else {
            $image = '';
        }

        $sub_array      = array();
        $sub_array[]    = $fila["id"];
        $sub_array[]    = $image;
        $sub_array[]    = $fila["name"];
        $sub_array[]    = $fila["barcode"];
        $sub_array[]    = $fila["price"];
        $sub_array[]    = $fila["quantity"];
        $sub_array[]    = $fila["category"];
        $sub_array[]    = $fila["brand"];
        $sub_array[]    = '
                <span class="" style="color: #000000; background: ' .$fila["state_color"]. '; padding: 0 7px; border-radius: 8px;">' . $fila["state"] . '</span>
            ';
        $sub_array[]    = $fila["section"];
        $sub_array[]    = $fila["description"];
        $sub_array[]    = $fila["creation_date"];
        $sub_array[]    = $fila["modification_date"];
        $sub_array[]    = '
                <button type="button"  name="edit" id="' . $fila["id"] . '" class="btn btn-warning text-white btn-xs edit" title="Editar"><i class="fa fa-edit"></i></button>
                <button type="button" name="delete" id="' . $fila["id"] . '" class="btn btn-danger btn-xs delete" title="Eliminar"><i class="fa fa-trash"></i></button>
            ';
        $datos[]        = $sub_array;
    }

    $salida = array(
        'draw'              => intval($_POST["draw"]),
        'recordsTotal'      => $filtered_rows,
        'recordsFiltered'   => obtener_todos_registros(),
        'data'              => $datos
    );

    echo json_encode($salida, JSON_UNESCAPED_UNICODE);
