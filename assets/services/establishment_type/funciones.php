<?php
    function obtener_todos_registros() {
        $connection = new Connection();
        $stmt = $connection->prepare("SELECT * FROM public.view_establishment_type;");
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        return $stmt->rowCount();
    }