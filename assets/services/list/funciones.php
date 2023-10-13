<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once "$root/StarListMaker/assets/services/connection/connection.php";
// require 'connection.php';
$cant_por_pagina = 16;

function buscar($que = NULL, $pagina = 1) {
    $conexion = new Connection();

    global $cant_por_pagina;

    $where = is_null($que) ? '' : " WHERE NAME ILIKE '%$que%' ";
    $inicio = ($pagina - 1) * $cant_por_pagina;

    $s = $conexion->prepare("
        SELECT * FROM view_product_card $where ORDER BY NAME LIMIT $cant_por_pagina OFFSET $inicio;
    ");

    $registros = [];

    $s->execute();

    while ($r = $s->fetch(PDO::FETCH_ASSOC)) {
        $registros[] = [
            'id'                => $r['id'],
            'image'             => $r['image'],
            'brand'             => $r['brand'],
            'name'              => $r['name'],
            'establishment'     => $r['establishment'],
            'price'             => $r['price'],
            'quantity'          => $r['quantity'],
            'control'           => isset($_SESSION['login']) ? '' : 'd-none hidden disabled invisible'
        ];
    }

    $s2 = $conexion->prepare("
        SELECT COUNT(*) AS CANTIDAD FROM view_product_card $where;
    ");

    $s2->execute();

    $array = $s2->fetch(PDO::FETCH_ASSOC);

    $paginas = ceil($array['cantidad'] / $cant_por_pagina);

    return ['resultados' => $registros, 'paginas' => $paginas, 'actual' => $pagina];
}