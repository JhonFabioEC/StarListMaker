<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    include_once "$root/StarListMaker/assets/common/utils.php";
    $utils = new Utils();
?>

<nav class="navbar fixed-top navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/StarListMaker/">StarListMaker</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/StarListMaker/">
                        <i class="fa-solid fa-house"></i> Inicio
                    </a>
                </li>
                
                <?php $utils->GetLogin(); ?>
                <?php $utils->GetRolType(); ?>
            </ul>

            <?php $utils->GetSearch(); ?>
            <?php $utils->GetAccount(); ?>
        </div>
    </div>
</nav>