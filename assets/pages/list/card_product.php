<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
// require_once "$root/StarListMaker/assets/services/connection/connection.php";
include_once "$root/StarListMaker/assets/services/list/funciones.php";

$products = buscar();

echo '<div class="d-flex flex-wrap justify-content-center gap-3" style="margin-top: 100px;" id="publicaciones">';
foreach ($products['resultados'] as $pd) {
    $image_name = $pd['image'] != '' ? $pd['image'] : 'default.svg';

    if (isset($_SESSION['login'])) {
        if ($_SESSION['login'] == true && strtoupper($_SESSION['rol_type']) == strtoupper("Usuario")) {
            $button =  <<<HTML
                <div class="d-flex flex-row mt-2 $pd[control]">
                    <div class="spinner d-flex flex-row gap-1 w-100">
                        <button class="btn btn-secondary" id="btn-decrease" onclick="decrease( $pd[id], 1 );">-</button>
                        <input type="number" name="quantity" id="quantity$pd[id]" class="form-control w-50" step="1" min="1" max="$pd[quantity]" placeholder = "1" value = "1" readonly>
                        <button class="btn btn-secondary" id="btn-increase" onclick="increase($pd[id], $pd[quantity] );">+</button>
                        
                        <button type="submit" class="btn btn-primary w-75" id="btnCallList"
                            onclick="envia_carrito($('#ref'+$pd[id]).val(), $('#title'+$pd[id]).val(),
                            $('#price'+$pd[id]).val(), $('#quantity'+$pd[id]).val(), $pd[id]);
                            setTimeout(function() {count_carrito();}, 500);"
                            title="Agregar"><i class="fa-solid fa-cart-plus"></i>
                        </button>
                    </div>
                </div>
            HTML;

            $data = <<<HTML
                <div class="d-flex gap-2 mt-2 $pd[control]">
                    <input name="ref" type="hidden" id="ref$pd[id]" value="$pd[id]" />
                    <input name="price" type="hidden" id="price$pd[id]" value="$pd[price]" />
                    <input name="title" type="hidden" id="title$pd[id]" value="$pd[name]" />
                </div>
            HTML;
        } else {
            $button =  '';
            $data = '';
        }
    } else {
        $button =  '';
        $data = '';
    }

    echo <<<HTML
        <div class="row">
            <div id="mi_div" class="col-12 d-flex gap-4 justify-content-center flex-wrap">
                <div class="card" style="width: 280px;">
                    <img src="/StarListMaker/assets/img/product/$image_name" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h4 class="card-title">$pd[name]</h4>    
                        <h6 class="card-text">Marca: $pd[brand]</h6>
                        <span class="card-text d-block">Precio: $ $pd[price]</span>
                        <span class="card-text d-block">Cantidad: $pd[quantity]</span>
                        <span class="card-text d-block">De: $pd[establishment]</span>
                        $button
                        $data 
                    </div>
                </div>
            </div>
        </div>
    HTML;
}
echo '</div>';

echo '<div class="d-flex flex-wrap justify-content-center align-content-center pt-4 pb-4">';
    echo '<ul id="paginador">';
    for ($i = 1; $i <= $products['paginas']; $i++) {
        $actual = $i == $products['actual'] ? " class='actual'" : '';
        echo "<li><a data-pagina='$i' href='pagina-$i.html'$actual>$i</a></li>";
    }
    echo '</ul>';
echo '</div>';

if (isset($_SESSION['login'])) {
    if ($_SESSION['login'] == true && strtoupper($_SESSION['rol_type']) == strtoupper("Usuario")) {
        include_once "$root/StarListMaker/assets/pages/list/modal_cart.php";
    }
}

?>