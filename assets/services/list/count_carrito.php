<?php
session_start();

if (isset($_SESSION['car'])) {
    $carrito_mio = $_SESSION['car'];
}

$cantidad_final = 0;

if (isset($_SESSION['car'])) {
    $total = 0;
    for ($i = 0; $i <= count($carrito_mio) - 1; $i++) {
        if (isset($carrito_mio[$i])) {
            if ($carrito_mio[$i] != NULL) {
                $total = $total + ($carrito_mio[$i]['price'] * $carrito_mio[$i]['quantity']);
                $cantidad_final += $carrito_mio[$i]['quantity'];
            }
        }
    }
}

if (!isset($total)) {
    $total = 0;
} else {
    $total = $total;
}

echo $cantidad_final;