<?php
session_start();

if (isset($_SESSION['car']) || isset($_POST['title'])) {
    if (isset($_SESSION['car'])) {
        $carrito_mio = $_SESSION['car'];
        if (isset($_POST['title'])) {
            $title = $_POST['title'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'] != '' ? $_POST['quantity'] : 1;
            $ref = $_POST['ref'];

            $donde = -1;
            for ($i = 0; $i <= count($carrito_mio) - 1; $i++) {
                if ($ref == $carrito_mio[$i]['ref']) {
                    $donde = $i;
                }
            }

            if ($donde != -1) {
                $cuanto = $carrito_mio[$donde]['quantity'] + $quantity;
                $carrito_mio[$donde] = array("title" => $title, "price" => $price, "quantity" => $cuanto, "ref" => $ref);
            } else {
                $carrito_mio[] = array("title" => $title, "price" => $price, "quantity" => $quantity, "ref" => $ref);
            }
        }
    } else {
        $title = $_POST['title'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $ref = $_POST['ref'];
        $carrito_mio[] = array("title" => $title, "price" => $price, "quantity" => $quantity, "ref" => $ref);
    }

    if (isset($_POST['quantity'])) {
        $id = $_POST['id'];
        $cuantos = $_POST['quantity'];
        if ($cuantos < 1) {
            $carrito_mio[$id] = NULL;
        } else {
            $carrito_mio[$id]['quantity'] = $cuantos;
        }
    }

    $_SESSION['car'] = $carrito_mio;

    //todo ok

} else {
    //error
}
