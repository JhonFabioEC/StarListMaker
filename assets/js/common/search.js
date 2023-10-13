var nombre = '';
scannear_botones(); //carga la pagina y le digo que sea operativo el funcionamiento de los links...

const form = document.querySelector('header form');
form.addEventListener('submit', function (e) {
	nombre = form.querySelector('input[type=search]').value;
	num = 1;

	//const anterior = document.querySelector( '.actual' );
	//if( anterior ) anterior.classList.remove( 'actual' );
	//document.querySelector('#paginador li:first-child a').classList.add( 'actual' );

	buscar(nombre, num);

	e.preventDefault();
});


function scannear_botones() {
	const botones = document.querySelectorAll('#paginador a');
	for (let i = 0; i < botones.length; i++) {
		botones[i].addEventListener('click', function (e) {
			//const anterior = document.querySelector( '.actual' );
			//if( anterior ) anterior.classList.remove( 'actual' );
			//e.target.classList.add( 'actual' );

			const num = e.target.dataset.pagina;
			buscar(nombre, num);
			e.preventDefault();
		});
	}
}



function buscar(que, num) {
	const fd = new FormData();
	fd.append('nombre', que);
	fd.append('numero', num);

	fetch('/StarListMaker/assets/services/list/ajax-buscar.php', { method: 'post', body: fd })
		.then(function (j) { return j.json(); })
		.then(function (d) {
			const publicaciones = document.getElementById('publicaciones');
			const paginador = document.getElementById('paginador');

			//RESETEA EL LISTADO DE RESULTADOS DE ESTA PAGINA....
			publicaciones.innerHTML = '';
			d.resultados.forEach(u => {
				publicaciones.innerHTML += `
					<div class="row">
						<div id="mi_div" class="col-12 d-flex gap-4 justify-content-center flex-wrap">
							<div class="card" style="width: 280px;">
								<img src="/StarListMaker/assets/img/product/${u.image}" class="card-img-top" alt="...">
								<div class="card-body">
									<h4 class="card-title">${u.name}</h4>    
									<h6 class="card-text">Marca: ${u.brand}</h6>
									<span class="card-text d-block">Precio: $ ${u.price}</span>
									<span class="card-text d-block">Cantidad: ${u.quantity}</span>
									<span class="card-text d-block">De: ${u.establishment}</span>
									
									<div class="d-flex flex-row mt-2 ${u.control}">
										<div class="spinner d-flex flex-row gap-1 w-100">
											<button class="btn btn-secondary" id="btn-decrease" onclick="decrease( ${u.id}, 1 );">-</button>
											<input type="number" name="quantity" id="quantity${u.id}" class="form-control w-50" step="1" min="1" max="${u.quantity}" placeholder = "1" value = "1" readonly>
											<button class="btn btn-secondary" id="btn-increase" onclick="increase(${u.id}, ${u.quantity} );">+</button>
											
											<button type="submit" class="btn btn-primary w-75" id="btnCallList"
												onclick="envia_carrito($('#ref'+${u.id}).val(), $('#title'+${u.id}).val(),
												$('#price'+${u.id}).val(), $('#quantity'+${u.id}).val(), ${u.id});
												setTimeout(function() {count_carrito();}, 500);"
												title="Agregar"><i class="fa-solid fa-cart-plus"></i>
											</button>
										</div>
									</div>

									<div class="d-flex gap-2 mt-2 ${u.control}">
										<input name="ref" type="hidden" id="ref${u.id}" value="${u.id}" />
										<input name="price" type="hidden" id="price${u.id}" value="${u.price}" />
										<input name="title" type="hidden" id="title${u.id}" value="${u.name}" />
									</div>
								</div>
							</div>
						</div>
					</div>
				`;
			});

			//RESETEAR LA BOTONERA DEL PAGINADOR...
			paginador.innerHTML = '';
			console.log(d);
			for (let i = 1; i <= d.paginas; i++) {
				let actual = d.actual == i ? " class='actual' " : "";
				paginador.innerHTML += `<li><a href='' ${actual} data-pagina='${i}'>${i}</a></li>`;
			}
			scannear_botones();
		});
}