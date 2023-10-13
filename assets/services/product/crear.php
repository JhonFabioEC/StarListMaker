<?php
    session_start();
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/StarListMaker/assets/services/connection/connection.php";
    include "$root/StarListMaker/assets/services/product/funciones.php";

    if ($_POST["operacion"] == "Crear") {
        $image = "";
        if($_FILES["image"]["name"] != ""){
            $image = subir_imagen();
        } else {
            $image = 'default.svg';
        }

        $connection = new Connection();
        $stmt = $connection->prepare("
            INSERT INTO product(
                name, brand_id, price, quantity, barcode, category_id,
                section, image, establishment_id, description, state_id
            ) VALUES (
                :name, :brand_id, :price, :quantity, :barcode, :category_id,
                :section, :image, ".$_SESSION['id'].", :description, :state_id
            );
        ");

        $resultado = $stmt->execute(
            array(
                ':name'                 => $_POST["name"],
                ':brand_id'             => $_POST["brand_id"],
                ':price'                => $_POST["price"],
                ':quantity'             => $_POST["quantity"],
                ':barcode'              => $_POST["barcode"],
                ':category_id'          => $_POST["category_id"],
                ':section'              => $_POST["section"],
                ':image'                => $image,
                ':description'          => $_POST["description"],
                ':state_id'             => $_POST["state_id"]
            )
        );

        if (!empty($resultado)) {
            echo "Registro creado";
        }
    }

    if ($_POST["operacion"] == "Editar") {
        $image = "";
        if($_FILES["image"]["name"] != ""){
            $image_old = obtener_nombre_imagen($_POST["id"]);
            $m=1;
            if($image_old != "default.svg"){
                unlink("$root/StarListMaker/assets/img/product/$image_old");
            }
            $image = subir_imagen();
        } else {
            $image_old = obtener_nombre_imagen($_POST["id"]);

            if($_POST["image_hidden"] != $image_old){
                unlink("$root/StarListMaker/assets/img/product/$image_old");
                $image = $_POST["image_hidden"];
            } else if ($_POST["image_hidden"] == 'default.svg') {
                $image = $_POST["image_hidden"];
            } else {
                $image = $_POST["image_hidden"];
            }
        }

        $connection = new Connection();
        
        $stmt = $connection->prepare("
            UPDATE product SET
                name=:name, brand_id=:brand_id, price=:price, quantity=:quantity,
                barcode=:barcode, category_id=:category_id, section=:section, image=:image,
                description=:description, state_id=:state_id, modification_date=current_timestamp
            WHERE id=:id;
        ");

        $resultado = $stmt->execute(
            array(
                ':name'                 => $_POST["name"],
                ':brand_id'             => $_POST["brand_id"],
                ':price'                => $_POST["price"],
                ':quantity'             => $_POST["quantity"],
                ':barcode'              => $_POST["barcode"],
                ':category_id'          => $_POST["category_id"],
                ':section'              => $_POST["section"],
                ':image'                => $image,
                ':description'          => $_POST["description"],
                ':state_id'             => $_POST["state_id"],
                ':id'                   => $_POST["id"]
            )
        );

        if (!empty($resultado)) {
            echo "Registro actualizado";
        }
    }