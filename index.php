<?php
session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once "$root/StarListMaker/assets/common/utils.php";
include_once "$root/StarListMaker/assets/common/style.php";
include_once "$root/StarListMaker/assets/common/script.php";
// require_once "$root/StarListMaker/assets/services/connection/connection.php";
// include_once "$root/StarListMaker/assets/services/common/product.php";

$utils = new Utils();
$style = new Style();
$script = new Script();

$url = "/StarListMaker";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php
    $utils->GetHead("Star List Maker");
    $style->GetCommon($url);
    ?>
</head>

<body>
    <?php $utils->GetSpinner(); ?>

    <header>
        <?php include "$root/StarListMaker/assets/common/navbar.php"; ?>
    </header>

    <main>
        <?php
            if (isset($_SESSION['login'])) {
                if ($_SESSION['login'] == true && strtoupper($_SESSION['rol_type']) == strtoupper("Usuario")) {
                    include_once "$root/StarListMaker/assets/pages/list/card_product.php";
                }else {
                    include_once "$root/StarListMaker/assets/pages/questions/index.php";
                }
            } else {
                include_once "$root/StarListMaker/assets/pages/list/card_product.php";
            }
        ?>
    </main>

    <?php $script->GetCommon($url); ?>
</body>

</html>