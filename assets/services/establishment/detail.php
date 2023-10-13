<?php
    $conexion = new Connection();

    $s = $conexion->prepare("
        SELECT *
        FROM view_establishment
        WHERE user_id=:user_id
        LIMIT 1;
    ");

    $s->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_STR);
    $s->execute();

    $establishment = $s->fetchAll()[0];
?>