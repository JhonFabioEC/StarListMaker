<?php
    function obtener_todos_registros() {
        $connection = new Connection();
        $stmt = $connection->prepare("SELECT * FROM public.view_category WHERE establishment = ".$_SESSION['id']);
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        return $stmt->rowCount();
    }