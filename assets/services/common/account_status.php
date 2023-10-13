<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    include_once "$root/StarListMaker/assets/services/connection/connection.php";

    $connection = new Connection();

    $s = $connection->prepare(
        'SELECT
            id, name
        FROM view_account_status
        ORDER BY name;'
    );

    $s->execute();
    $account_status = $s->fetchAll();
?>