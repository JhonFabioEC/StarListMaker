<?php
    session_start();
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/StarListMaker/assets/services/connection/connection.php";
    include "$root/StarListMaker/assets/services/establishment/funciones.php";

    if ($_POST) {
        $image = "";
        if($_FILES["image"]["name"] != ""){
            $image_old = obtener_nombre_imagen($_SESSION["id"]);
            if($image_old != "default.svg"){
                unlink("$root/StarListMaker/assets/img/user/establishment/$image_old");
            }
            $image = subir_imagen();
        } else {
            $image_old = obtener_nombre_imagen($_SESSION["id"]);

            if($_POST["image_hidden"] != $image_old){
                unlink("$root/StarListMaker/assets/img/user/establishment/$image_old");
                $image = $_POST["image_hidden"];
            } else if ($_POST["image_hidden"] == 'default.svg') {
                $image = $_POST["image_hidden"];
            } else {
                $image = $_POST["image_hidden"];
            }
        }

        $connection = new Connection();

        $encrypted = ($_POST["password"] == '') ? ':password' : 'md5(md5(:password))';

        $stmt = $connection->prepare("
            WITH update_user AS (
                UPDATE public.user
                SET
                    image=:image,
                    email_address=:email_address,
                    password=$encrypted
                WHERE id=:id
                RETURNING id
            )
            UPDATE establishment
            SET
                name=:name,
                phone_number=:phone_number
            FROM update_user
            WHERE establishment.user_id=update_user.id;
        ");

        $resultado = $stmt->execute(
            array(
                ':image'            => $image,
                ':password'         => ($_POST["password"] == '') ? $_POST["verify"] : $_POST["password"],
                ':email_address'    => $_POST["email_address"],
                ':name'             => $_POST["name"],
                ':phone_number'     => $_POST["phone_number"],
                ':id'               => $_SESSION["id"]
            )
        );

        if (!empty($resultado)) {
            $_SESSION['image'] = $image;
            echo "Registro actualizado con exito! ";
        }
    }