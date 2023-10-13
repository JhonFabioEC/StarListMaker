<?php


    function obtener_nombre_imagen($user_id) {
        $connection = new Connection();
        $stmt = $connection->prepare('SELECT image FROM view_user WHERE user_id='.$user_id.';');
        $stmt->execute();
        $resultado = $stmt->fetchAll();

        foreach($resultado as $fila){
            return $fila['image'];
        }
    }

    function obtener_todos_registros() {
        $connection = new Connection();
        $stmt = $connection->prepare("SELECT * FROM public.view_user WHERE user_id!=".$_SESSION['id'].";");
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        return $stmt->rowCount();
    }