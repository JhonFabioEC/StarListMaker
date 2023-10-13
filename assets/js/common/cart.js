function increase(id, max) {
    var value = parseInt($('#quantity' + id).val(), 10);
    if (value < max) {
        $('#quantity' + id).val(value + 1);
    }
}

function decrease(id, min) {
    var value = parseInt($('#quantity' + id).val(), 10);
    if (value > min) {
        $('#quantity' + id).val(value - 1);
    }
}

//  mandamos al carrito 
function envia_carrito(ref, title, price, quantity, id) {
    var parametros = {
        "ref": ref,
        "title": title,
        "price": price,
        "quantity": quantity
    };
    $.ajax({
        data: parametros,
        url: '/StarListMaker/assets/services/list/cart.php',
        type: 'POST',
        beforeSend: function () { },
        success: function (response) { },
        error: function (response, error) { }
    });

    $('#quantity' + id).val(1);
}

//  consultamos nuestro carrito 
function consultar_carrito() {
    var parametros = {};
    $.ajax({
        data: parametros,
        type: 'POST',
        url: '/StarListMaker/assets/services/list/modal_carrito.php',
        success: function (data) {
            document.getElementById("mi_carrito").innerHTML = data;
        }
    });
}

// contamos nuestro carrito 
function count_carrito() {
    var parametros = {};
    $.ajax({
        data: parametros,
        type: 'POST',
        url: '/StarListMaker/assets/services/list/count_carrito.php',
        success: function (data) {
            document.getElementById("count_carrito").innerHTML = data;
            console.log(data);
        }
    });
}

// borrar carro
function borrar_carrito() {
    var parametros = {};
    $.ajax({
        data: parametros,
        type: 'POST',
        url: '/StarListMaker/assets/services/list/borrarcarro.php',
        success: function (data) {
            consultar_carrito();
            console.log(data);
        }
    });
}

//ajacutamos el carrito
setTimeout(function () {
    count_carrito();
}, 500);