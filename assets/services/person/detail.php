<?php
    $conexion = new Connection();

    $s = $conexion->prepare("
        SELECT *
        FROM view_person
        WHERE user_id=:user_id
        LIMIT 1;
    ");

    $s->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_STR);
    $s->execute();

    $person = $s->fetchAll()[0];
?>