<?php
    $conexion = new Connection();
    $data = [];

    $s = $conexion->prepare("
        SELECT * FROM view_product_card;
    ");

    $s->execute();

    while ($row = $s->fetch(PDO::FETCH_ASSOC)) {
        $data[] = [
            'id'                => $row['id'],
            'image'             => $row['image'],
            'brand'             => $row['brand'],
            'name'              => $row['name'],
            'establishment'     => $row['establishment'],
            'price'             => $row['price'],
            'quantity'          => $row['quantity']
        ];
    }

    $product=$data;