<?php
    function obtener_todos_registros() {
        $connection = new Connection();
        $stmt = $connection->prepare("SELECT * FROM public.view_brand WHERE establishment = ".$_SESSION['id']);
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        return $stmt->rowCount();
    }