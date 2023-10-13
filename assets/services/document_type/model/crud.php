<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/StarListMaker/assets/services/connection/connection.php";

    class Document_type {
        public function Add($name, $state_id) {
            $connection = new Connection();

            $s = $connection->prepare(
                "INSERT INTO document_type(
                    name, state_id
                ) VALUES (
                    :name, :state_id
                );"
            );

            $s->bindValue(":name", $name, PDO::PARAM_STR);
            $s->bindValue(":state_id", $state_id, PDO::PARAM_INT);
            $s->execute();

            $s = $connection->prepare(
                "SELECT
                    id, name, creation_date,
                    modification_date, deletion_date, state
                FROM view_document_type
                ORDER BY id
                DESC LIMIT 1;"
            );

            $s->execute();

            return $s->fetchAll(PDO::FETCH_ASSOC);
        }

        public function Update($id, $name, $state_id) {
            $connection = new Connection();

            $s = $connection->prepare(
                "UPDATE document_type SET
                    name=:name, state_id=:state_id,
                    modification_date=DEFAULT
                WHERE id=:id;"
            );

            $s->bindValue(":id", $id, PDO::PARAM_INT);
            $s->bindValue(":name", $name, PDO::PARAM_STR);
            $s->bindValue(":state_id", $state_id, PDO::PARAM_INT);
            $s->execute();

            $s = $connection->prepare(
                "SELECT
                    id, name, creation_date,
                    modification_date, deletion_date, state
                FROM view_document_type
                ORDER BY id
                DESC LIMIT 1;"
            );

            $s->execute();

            return $s->fetchAll(PDO::FETCH_ASSOC);
        }

        public function Delete($id) {
            $connection = new Connection();

            $s = $connection->prepare(
                "DELETE FROM document_type
                WHERE id=:id;"
            );

            $s->bindValue(":id", $id, PDO::PARAM_INT);
            $s->execute();

            return $s->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>