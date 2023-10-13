<?php
session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require "$root/StarListMaker/assets/services/connection/connection.php";
include "$root/StarListMaker/assets/services/user/funciones.php";

$query = '';
$salida = array();
$query = "SELECT * FROM view_user WHERE user_id!=" . $_SESSION['id'] . " ";

if (isset($_POST["search"]["value"])) {
    $query .= "AND ( username ILIKE '%" . $_POST["search"]["value"] . "%' ";
    $query .= "OR email_address ILIKE '%" . $_POST["search"]["value"] . "%' ";
    $query .= "OR role_type ILIKE '%" . $_POST["search"]["value"] . "%' ";
    $query .= "OR account_status ILIKE '%" . $_POST["search"]["value"] . "%') ";
}

if (isset($_POST["order"])) {
    $query .= "ORDER BY " . ($_POST["order"][0]["column"] + 1) . " " . $_POST["order"][0]["dir"] . " ";
} else {
    $query .= "ORDER BY user_id DESC ";
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
        $rol_name = strtoupper($fila["role_type"]) == strtoupper("Establecimiento") ? "establishment" : "person";
        $image = '<img src="/StarListMaker/assets/img/user/' . $rol_name . '/' . $fila["image"] . '" class="img-fluid img-thumbnail border border-0 bg-transparent" width="50" height="35" />';
    } else {
        $image = '';
    }

    $sub_array      = array();
    $sub_array[]    = $fila["user_id"];
    $sub_array[]    = $image;
    $sub_array[]    = $fila["username"];
    $sub_array[]    = $fila["email_address"];
    $sub_array[]    = '
                <span class="" style="color: #000000; background: ' . $fila["role_type_color"] . '; padding: 0 7px; border-radius: 8px;">' . $fila["role_type"] . '</span>
            ';
    $sub_array[]    = '
                <span class="" style="color: #000000; background: ' . $fila["account_status_color"] . '; padding: 0 7px; border-radius: 8px;">' . $fila["account_status"] . '</span>
            ';
    $sub_array[]    = $fila["creation_date"];
    $sub_array[]    = '
                <button type="button" name="edit" id="' . $fila["user_id"] . '" class="btn btn-warning text-white btn-xs edit" title="Editar"><i class="fa fa-edit"></i></button>
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
