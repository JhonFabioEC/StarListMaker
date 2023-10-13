<?php
    session_start();

    $root = realpath($_SERVER["DOCUMENT_ROOT"]);

    include_once "$root/StarListMaker/assets/services/connection/connection.php";
    
    $username = $_POST["username"];
    $password = $_POST["password"];

    $connection = new Connection();

    $s = $connection->prepare(
        "SELECT *
        FROM view_authentication_user
        WHERE
            ( UPPER(username) = UPPER(:username) OR
            UPPER(email_address) = UPPER(:username)) AND
            password = md5(md5(:password));"
    );

    $s->bindValue(':username', $username, PDO::PARAM_STR);
    $s->bindValue(':password', $password, PDO::PARAM_STR);

    try {
        $s->execute();
        $user = $s->fetchAll();

        if (count($user) == 1) {
            if (strtoupper($user[0]['account_status']) == strtoupper("ACTIVO")) {
                $_SESSION['id'] = $user[0]['user_id'];

                if (isset($_SESSION['id'])) {
                    if ($_SESSION['id'] == ' ') {
                        $_SESSION['login'] = false;
                    } else {
                        $_SESSION['login'] = true;
                        $_SESSION['username'] = $user[0]['username'];
                        $_SESSION['rol_type'] = $user[0]['role_type'];
                        $_SESSION['image'] = $user[0]['image'];

                        echo json_encode("OK");
                    }
                }
            } else {
                $_SESSION['login'] = false;

                echo json_encode("!El usuario ha sido bloqueado¡");
            }
        } else {
            $_SESSION['login'] = false;

            echo json_encode("!Usuario o contraseña incorrecta¡");
        }
    } catch (Exception $e) {
        error_log("Error: ".$e);
    }
