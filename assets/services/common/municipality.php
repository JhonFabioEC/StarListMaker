<?php
    if (isset($_GET['department_id'])) {
        $root = realpath($_SERVER["DOCUMENT_ROOT"]);
        require "$root/StarListMaker/assets/services/connection/connection.php";

        $municipality = [];

        $conexion = new Connection();
        $department_id = $_GET['department_id'];
        $data = [];

        $s = $conexion->prepare("
                    SELECT id, name
                    FROM municipality
                    WHERE department_id=:department_id
                    ORDER BY id;
                ");

        $s->bindValue(':department_id', $department_id, PDO::PARAM_STR);
        $s->execute();

        while ($row = $s->fetch(PDO::FETCH_ASSOC)) {
            $data[] = [
                'id'    => $row['id'],
                'name'  => $row['name']
            ];
        }

        $municipality = $data;
        echo json_encode(['data' => $municipality]);
    } else {
        $conexion = new Connection();
        $data = [];

        $s = $conexion->prepare("
                SELECT id, name
                FROM municipality
                ORDER BY id;
            ");

        $s->execute();

        while ($row = $s->fetch(PDO::FETCH_ASSOC)) {
            $data[] = [
                'id'    => $row['id'],
                'name'  => $row['name']
            ];
        }

        $municipality = $data;
    }
