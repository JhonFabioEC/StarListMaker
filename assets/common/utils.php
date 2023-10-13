<?php
class Utils
{
    function GetHead($title)
    {
        echo '
                <meta charset="UTF-8"/>
                <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <title>' . $title . '</title>
            ';
    }

    function GetSpinner()
    {
        echo '
                <div id="loader">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Cargando...</span>
                    </div>
                </div>
            ';
    }

    function GetLogin()
    {
        if (!isset($_SESSION['login'])) {
            echo '
                    <li class="nav-item">
                        <a class="nav-link" href="/StarListMaker/assets/pages/login/index.php">
                            <i class="fa-solid fa-circle-user"></i> Iniciar Sesión
                        </a>
                    </li>
                ';
        }
    }

    function GetRolType()
    {
        if (isset($_SESSION['login'])) {
            if ($_SESSION['login'] == true and strtoupper($_SESSION['rol_type']) == strtoupper("administrador")) {
                echo '
                        <ul class="navbar-nav me-0 mb-0 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-gear"></i> Administrador
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="/StarListMaker/assets/pages/establishment_type/index.php">
                                            <i class="fa-solid fa-shop"></i> Tipos de establecimientos
                                        </a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item" href="/StarListMaker/assets/pages/vehicle/index.php">
                                            <i class="fa-solid fa-car"></i> Vehículos
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a class="dropdown-item" href="/StarListMaker/assets/pages/user/index.php">
                                            <i class="fa-solid fa-users"></i> Usuarios
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    ';
            } else if ($_SESSION['login'] == true and strtoupper($_SESSION['rol_type']) == strtoupper("Establecimiento")) {
                echo '
                        <ul class="navbar-nav me-0 mb-0 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-gear"></i> Configuracion
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="/StarListMaker/assets/pages/category/index.php">
                                            <i class="fas fa-star"></i> Categorias
                                        </a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item" href="/StarListMaker/assets/pages/brand/index.php">
                                            <i class="fa-solid fa-tag"></i> Marcas
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a class="dropdown-item" href="/StarListMaker/assets/pages/product/index.php">
                                            <i class="fas fa-box"></i> Productos
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    ';
            } else {
                echo '
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modal_cart" style="cursor:pointer;" onclick="consultar_carrito();">
                        <i class="fas fa-shopping-cart"></i> <span id="count_carrito" style="color: red; font-weight:bold;"></span> Mi lista
                    </a>
                </li>
                ';
            }
        }
    }

    function GetCategory()
    {
        if (isset($_SESSION['login'])) {
            if ($_SESSION['login'] == true and strtoupper($_SESSION['rol_type']) == strtoupper("Usuario")) {
                echo '
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-star"></i> Categorías
                        </a>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">...</a></li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li><a class="dropdown-item" href="/StarListMaker/">Todos</a></li>
                        </ul>
                    </li>
                    ';
            }
        } else {
            echo '
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-star"></i> Categorías
                </a>

                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">...</a></li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li><a class="dropdown-item" href="/StarListMaker/">Todos</a></li>
                </ul>
            </li>
            ';
        }
    }

    function GetList()
    {
        if (isset($_SESSION['login'])) {
            if ($_SESSION['login'] == true) {
                echo '
                        <ul class="navbar-nav me-0 mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="/StarListMaker/">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </a>
                            </li>
                        </ul>
                    ';
            }
        }
    }

    function GetSearch()
    {
        if (isset($_SESSION['login'])) {
            if ($_SESSION['login'] == true and strtoupper($_SESSION['rol_type']) == strtoupper("Usuario")) {
                echo '
                    <form class="d-flex me-2 mb-2 mb-lg-0" role="search" method="get" action="index.php">
                        <input class="form-control me-2" type="search" placeholder="¿Qué buscas hoy?" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                    ';
            }
        } else {
            echo '
            <form class="d-flex me-2 mb-2 mb-lg-0" role="search" method="get" action="index.php">
                <input class="form-control me-2" type="search" placeholder="¿Qué buscas hoy?" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
            ';
        }
    }


    function GetAccount()
    {
        if (isset($_SESSION['login'])) {
            if ($_SESSION['login'] == true) {
                $rol_name = strtoupper($_SESSION['rol_type']) == strtoupper("Establecimiento") ? "establishment" : "person";
                $url_img = "/StarListMaker/assets/img/user/$rol_name/" . $_SESSION['image'];


                if ($rol_name == 'person') {
                    echo '
                        <ul class="navbar-nav me-0 mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle fw-bold fs-6" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img class="icono" src="' . $url_img . '" alt="icono">' . $_SESSION['username'] . '
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="/StarListMaker/assets/pages/person/view.php">
                                            <i class="fa-solid fa-user-gear"></i> Ver perfil
                                        </a>
                                    </li>

                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>

                                    <li>
                                        <div id="btnLogout" class="dropdown-item">
                                            <i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesion
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    ';
                } else {
                    echo '
                        <ul class="navbar-nav me-0 mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle fw-bold fs-6" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img class="icono" src="' . $url_img . '" alt="icono">' . $_SESSION['username'] . '
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="/StarListMaker/assets/pages/establishment/view.php">
                                            <i class="fa-solid fa-user-gear"></i> Ver perfil
                                        </a>
                                    </li>

                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>

                                    <li>
                                        <div id="btnLogout" class="dropdown-item">
                                            <i class="fa-solid fa-power-off"></i> Cerrar Sesion
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    ';
                }
            }
        }
    }
}