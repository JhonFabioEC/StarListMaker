<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);

    require_once "$root/StarListMaker/assets/services/connection/connection.php";

    $connection = new Connection();

    $field = $_GET["field"]; //Recibiendo el nombre del campo enviado por el metodo get
    $field_data = $_GET["field_data"]; //Recibiendo el valor del campo enviado por el metodo get

    //Preparando el arreglo que contendrá toda la información
    $jsonData = array();
    $menssage = '';

    switch ($field) {
        case 'name':
            //Verificando si existe algun usuario en bd ya con dicho número de documento asignado
            $s = $connection->prepare(
                'SELECT
                        name
                    FROM public.establishment
                    WHERE
                        UPPER(name)=UPPER(:name);'
            );

            $s->bindValue(':name', $field_data, PDO::PARAM_INT);

            $menssage = 'nombre de establecimiento ';
            break;

        case 'phone_number':
            //Verificando si existe algun usuario en bd ya con dicho número de teléfono asignado
            $s = $connection->prepare(
                'SELECT
                        phone_number
                    FROM public.establishment
                    WHERE
                        phone_number=:phone_number;'
            );

            $s->bindValue(':phone_number', $field_data, PDO::PARAM_INT);

            $menssage = 'número de teléfono';
            break;

        case 'email_address':
            //Verificando si existe algun usuario en bd ya con dicho correo electrónico asignado
            $s = $connection->prepare(
                'SELECT
                        email_address
                    FROM public.user
                    WHERE
                        UPPER(email_address)=UPPER(:email_address);'
            );

            $s->bindValue(':email_address', $field_data, PDO::PARAM_INT);

            $menssage = 'correo electrónico';
            break;

        case 'username':
            //Verificando si existe algun usuario en bd ya con dicho nombre de usuario asignado
            $s = $connection->prepare(
                'SELECT
                        username
                    FROM public.user
                    WHERE
                        UPPER(username)=UPPER(:username);'
            );

            $s->bindValue(':username', $field_data, PDO::PARAM_INT);

            $menssage = 'nombre de usuario';
            break;

        default:
            break;
    }

    try {
        $s->execute();
        $establishment = $s->fetchAll();

        //Validamos que la consulta haya retornado información
        if (count($establishment) == 0) {
            $jsonData['success'] = 0;
            $jsonData['message'] = '';
        } else {
            //Si hay datos entonces retornas algo
            $jsonData['success'] = 1;
            $jsonData['message'] = '<p class="text-danger">Ya existe el ' . $menssage . '</p>';
        }

        //Mostrando la respuesta en formato Json
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    } catch (Exception $e) {
        error_log("Error: " . $e);
    }
