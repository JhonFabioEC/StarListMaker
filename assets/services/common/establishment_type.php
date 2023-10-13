<?php
    $conexion = new Connection();
    $data = [];

    $s = $conexion->prepare("
        SELECT id, name
        FROM establishment_type
        ORDER BY id;
    ");

    $s->execute();

    while ($row = $s->fetch(PDO::FETCH_ASSOC)) {
        $data[] = [
            'id'    => $row['id'],
            'name'  => $row['name']
        ];
    }

    $establishment_type=$data;
