<?php
function subir_imagen()
{
    if (isset($_FILES['image'])) {
        $root = realpath($_SERVER["DOCUMENT_ROOT"]);
        $tmp = $_FILES['image']['tmp_name'];
        $info = exif_imagetype($tmp);
        switch ($info) {
            case IMAGETYPE_PNG:
                $original = imagecreatefrompng($tmp);
                break;
            case IMAGETYPE_JPEG:
                $original = imagecreatefromjpeg($tmp);
                break;
            case IMAGETYPE_GIF:
                $original = imagecreatefromgif($tmp);
                break;
            case IMAGETYPE_WEBP:
                $original = imagecreatefromwebp($tmp);
                break;
            default:
                die('formato no soportado, lo siento');
        }

        $new_width = 200;
        $new_height = 200;
        
        $copia1 = imagescale($original, $new_width, $new_height);

        imagesavealpha($copia1, false);

        imagealphablending($copia1, false);

        $nombre = uniqid();
        $ubicacion = "$root/StarListMaker/assets/img/product/";
        imagewebp($copia1, "$ubicacion/$nombre.webp", 100);

        return $nombre . '.webp';
    }
}

function obtener_nombre_imagen($id)
{
    $connection = new Connection();
    $stmt = $connection->prepare('SELECT image FROM view_product WHERE id=' . $id . ' AND establishment=' . $_SESSION['id'] . ';');
    $stmt->execute();
    $resultado = $stmt->fetchAll();

    foreach ($resultado as $fila) {
        return $fila['image'];
    }
}

function obtener_todos_registros()
{
    $connection = new Connection();
    $stmt = $connection->prepare("SELECT * FROM public.view_product WHERE establishment=" . $_SESSION['id'] . ";");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    return $stmt->rowCount();
}
