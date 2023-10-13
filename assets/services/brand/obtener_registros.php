<?php
    session_start();
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/StarListMaker/assets/services/connection/connection.php";
    include "$root/StarListMaker/assets/services/brand/funciones.php";

    $query = '';
    $salida = array();
    $query = "SELECT * FROM public.view_brand WHERE establishment=".$_SESSION['id']. " ";

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
        $sub_array      = array();
        $sub_array[]    = $fila["id"];
        $sub_array[]    = $fila["name"];
        $sub_array[]    = '
                <span class="" style="color: #000000; background: ' .$fila["state_color"]. '; padding: 0 7px; border-radius: 8px;">' . $fila["state"] . '</span>
            ';
        $sub_array[]    = $fila["creation_date"];
        $sub_array[]    = $fila["modification_date"];
        $sub_array[]    = '
                <button type="button" name="edit" id="' . $fila["id"] . '" class="btn btn-warning  text-white btn-xs edit" title="Editar"><i class="fa fa-edit"></i></button>
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
