<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    include_once "$root/StarListMaker/assets/services/connection/connection.php";

    $connection = new Connection();

    $s = $connection->prepare(
        'SELECT
            id, name
        FROM view_category
        WHERE establishment='.$_SESSION['id'].'
        ORDER BY name;'
    );

    $s->execute();
    $category = $s->fetchAll();
?>