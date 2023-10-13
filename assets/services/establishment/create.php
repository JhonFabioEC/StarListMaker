<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/StarListMaker/assets/services/connection/connection.php";

    $name = (isset($_POST["name"])) ? $_POST["name"] : "";
    $establishment_type_id = (isset($_POST["establishment_type_id"])) ? $_POST["establishment_type_id"] : "";
    $municipality_id = (isset($_POST["municipality_id"])) ? $_POST["municipality_id"] : "";
    $zone_type_id = (isset($_POST["zone_type_id"])) ? $_POST["zone_type_id"] : "";
    $address = (isset($_POST["address"])) ? $_POST["address"] : "";
    $phone_number = (isset($_POST["phone_number"])) ? $_POST["phone_number"] : "";
    $email_address = (isset($_POST["email_address"])) ? $_POST["email_address"] : "";
    $username = (isset($_POST["username"])) ? $_POST["username"] : "";
    $password = (isset($_POST["password"])) ? $_POST["password"] : "";

    if($_POST) {
        $connection = new Connection();

        $s = $connection->prepare(
            "WITH inserted_user AS (
                INSERT INTO public.user (
                    username, email_address, password, role_type_id
                ) VALUES (
                    :username, :email_address, md5(md5(:password)), 2
                ) RETURNING id
            ) INSERT INTO public.establishment (
                user_id,
                name,
                municipality_id,
                zone_type_id,
                address,
                phone_number,
                
                establishment_type_id
            ) SELECT 
                id,
                :name, 
                :municipality_id,
                :zone_type_id,
                :address,
                :phone_number,
                :establishment_type_id
            FROM inserted_user;"
        );

        $s->bindValue(':name', $name, PDO::PARAM_STR);
        $s->bindValue(':establishment_type_id', $establishment_type_id, PDO::PARAM_STR);
        $s->bindValue(':municipality_id', $municipality_id, PDO::PARAM_STR);
        $s->bindValue(':zone_type_id', $zone_type_id, PDO::PARAM_STR);
        $s->bindValue(':address', $address, PDO::PARAM_STR);
        $s->bindValue(':phone_number', $phone_number, PDO::PARAM_STR);
        $s->bindValue(':email_address', $email_address, PDO::PARAM_STR);
        $s->bindValue(':username', $username, PDO::PARAM_STR);
        $s->bindValue(':password', $password, PDO::PARAM_STR);
    
        try {
            $s->execute();

            $data = $s->fetchAll(PDO::FETCH_ASSOC);
            print json_encode($data, JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            echo "Error: ".$e;
        }
    }