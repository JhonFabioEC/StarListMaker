<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/StarListMaker/assets/services/connection/connection.php";

    $first_name = (isset($_POST["first_name"])) ? $_POST["first_name"] : "";
    $last_name = (isset($_POST["last_name"])) ? $_POST["last_name"] : "";
    $date_of_birth = (isset($_POST["date_of_birth"])) ? $_POST["date_of_birth"] : "";
    $gender_id = (isset($_POST["gender_id"])) ? $_POST["gender_id"] : "";
    $document_type_id = (isset($_POST["document_type_id"])) ? $_POST["document_type_id"] : "";
    $document_number = (isset($_POST["document_number"])) ? $_POST["document_number"] : "";
    // $department_id = (isset($_POST["department_id"])) ? $_POST["department_id"] : "";
    $municipality_id = (isset($_POST["municipality_id"])) ? $_POST["municipality_id"] : "";
    $zone_type_id = (isset($_POST["zone_type_id"])) ? $_POST["zone_type_id"] : "";
    $address = (isset($_POST["address"])) ? $_POST["address"] : "";
    $phone_number = (isset($_POST["phone_number"])) ? $_POST["phone_number"] : "";
    $email_address = (isset($_POST["email_address"])) ? $_POST["email_address"] : "";
    $username = (isset($_POST["username"])) ? $_POST["username"] : "";
    $password = (isset($_POST["password"])) ? $_POST["password"] : "";
    // $confirm_password = (isset($_POST["confirm_password"])) ? $_POST["confirm_password"] : "";

    if($_POST) {
        $connection = new Connection();

        $s = $connection->prepare(
            "WITH inserted_user AS (
                INSERT INTO public.user (
                    username, email_address, password, role_type_id
                ) VALUES (
                    :username, :email_address, md5(md5(:password)), 3
                ) RETURNING id
            ) INSERT INTO public.person (
                user_id,
                first_name, last_name,
                date_of_birth, gender_id,
                document_type_id, document_number,
                phone_number,
                municipality_id,
                zone_type_id, address
            ) SELECT 
                id,
                :first_name, :last_name,
                :date_of_birth, :gender_id, 
                :document_type_id, :document_number,
                :phone_number,
                :municipality_id,
                :zone_type_id, :address
            FROM inserted_user;"
        );

        $s->bindValue(':first_name', $first_name, PDO::PARAM_STR);
        $s->bindValue(':last_name', $last_name, PDO::PARAM_STR);
        $s->bindValue(':date_of_birth', $date_of_birth, PDO::PARAM_STR);
        $s->bindValue(':gender_id', $gender_id, PDO::PARAM_STR);
        $s->bindValue(':document_type_id', $document_type_id, PDO::PARAM_STR);
        $s->bindValue(':document_number', $document_number, PDO::PARAM_STR);
        //$s->bindValue(':department_id', $department_id, PDO::PARAM_STR);
        $s->bindValue(':municipality_id', $municipality_id, PDO::PARAM_STR);
        $s->bindValue(':zone_type_id', $zone_type_id, PDO::PARAM_STR);
        $s->bindValue(':address', $address, PDO::PARAM_STR);
        $s->bindValue(':phone_number', $phone_number, PDO::PARAM_STR);
        $s->bindValue(':email_address', $email_address, PDO::PARAM_STR);
        $s->bindValue(':username', $username, PDO::PARAM_STR);
        $s->bindValue(':password', $password, PDO::PARAM_STR);
        //$s->bindValue(':confirm_password', $confirm_password, PDO::PARAM_STR);
    
        try {
            $s->execute();
            //$lr = $s->fetchAll();
            //var_dump($lr);

            $data = $s->fetchAll(PDO::FETCH_ASSOC);
            print json_encode($data, JSON_UNESCAPED_UNICODE);

            //return $s->fetchAll(PDO::FETCH_ASSOC);
    
            //header("Location: /StarListMaker/assets/pages/login/index.php");
        } catch (Exception $e) {
            #header("Location: /mylib/assets/page/parner/error.php");
            echo "Error: ".$e;
        }
    }