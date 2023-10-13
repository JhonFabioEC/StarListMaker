<?php
    function obtener_todos_registros() {
        $connection = new Connection();
        $stmt = $connection->prepare("SELECT * FROM public.view_vehicle;");
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        return $stmt->rowCount();
    }