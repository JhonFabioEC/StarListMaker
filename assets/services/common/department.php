<?php
    $conexion = new Connection();
    $data = [];

    $s = $conexion->prepare("
        SELECT id, name
        FROM department
        ORDER BY id;
    ");

    $s->execute();

    while ($row = $s->fetch(PDO::FETCH_ASSOC)) {
        $data[] = [
            'id'    => $row['id'],
            'name'  => $row['name']
        ];
    }

    $department=$data;