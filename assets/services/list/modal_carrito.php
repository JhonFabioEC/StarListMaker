<?php
session_start();

if (isset($_SESSION['car'])) {
    $carrito_mio = $_SESSION['car'];
}
?>

<ul class="list-group mb-3">
    <?php
    if (isset($_SESSION['car'])) {
        $total = 0;
        for ($i = 0; $i <= count($carrito_mio) - 1; $i++) {
            if (isset($carrito_mio[$i])) {
                if ($carrito_mio[$i] != NULL) {
    ?>
                    <li class="list-group-item justify-content-between px-4">
                        <div class="row">
                            <div class="col-10 p-0" style="text-align: left; color: #000000;">
                                <h6 class="my-0">Cantidad: <?php echo $carrito_mio[$i]['quantity'] ?> : <?php echo $carrito_mio[$i]['title']; ?></h6>
                            </div>
                            <div class="col-2 p-0" style="text-align: right; color: #000000;">
                                <span class="text-muted" style="text-align: right; color: #000000;"><?php echo $carrito_mio[$i]['price'] * $carrito_mio[$i]['quantity'];    ?> $</span>
                            </div>
                        </div>
                    </li>
    <?php
                    $total = $total + ($carrito_mio[$i]['price'] * $carrito_mio[$i]['quantity']);
                }
            }
        }
    }
    ?>
    <li class="list-group-item d-flex justify-content-between">
        <span style="text-align: left; color: #000000;">Total (COP)</span>
        <strong style="text-align: left; color: #000000;">
            <?php
            if (isset($_SESSION['car'])) {
                $total = 0;
                for ($i = 0; $i <= count($carrito_mio) - 1; $i++) {
                    if (isset($carrito_mio[$i])) {
                        if ($carrito_mio[$i] != NULL) {
                            $total = $total + ($carrito_mio[$i]['price'] * $carrito_mio[$i]['quantity']);
                        }
                    }
                }
            }
            if (!isset($total)) {
                $total = 0;
            } else {
                $total = $total;
            }
            echo $total; ?> $
        </strong>
    </li>
</ul>