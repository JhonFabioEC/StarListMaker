<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/StarListMaker/assets/services/document_type/model/crud.php";

    $name = (isset($_POST["name"])) ? $_POST["name"] : "";
    $state_id = (isset($_POST["state_id"])) ? $_POST["state_id"] : "";
    $accion = (isset($_POST["accion"])) ? $_POST["accion"] : "";
    $id = (isset($_POST["id"])) ? $_POST["id"] : "";

    if($_POST) {
        $document_type = new Document_type();
        
        switch ($accion) {
            case 'GUARDAR':
                $data = $document_type->Add($name, $state_id);
                print json_encode($data, JSON_UNESCAPED_UNICODE);
                break;

            case 'MODIFICAR':
                $data = $document_type->Update($id, $name, $state_id);
                print json_encode($data, JSON_UNESCAPED_UNICODE);
                break;

            case 'ELIMINAR':
                $data = $document_type->Delete($id);
                print json_encode($data, JSON_UNESCAPED_UNICODE);
                break;
        }
    }
?>