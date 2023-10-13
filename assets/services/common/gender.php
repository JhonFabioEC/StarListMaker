<?php
    $conexion = new Connection();
    $data = [];

    $s = $conexion->prepare("
        SELECT id, name
        FROM gender
        ORDER BY id;
    ");

    $s->execute();

    while ($row = $s->fetch(PDO::FETCH_ASSOC)) {
        $data[] = [
            'id'    => $row['id'],
            'name'  => $row['name']
        ];
    }

    $gender=$data;
