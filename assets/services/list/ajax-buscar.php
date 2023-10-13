<?php
session_start();
include( 'funciones.php' );
$nombre = $_POST['nombre'];
if( empty($nombre) ) $nombre = NULL;

$numero = $_POST['numero'];

$respuesta = buscar( $nombre, $numero );
echo json_encode( $respuesta );