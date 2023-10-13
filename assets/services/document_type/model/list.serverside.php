<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/StarListMaker/assets/services/common/serverside.php";
    $table_data->get('view_document_type', 'id', array('id', 'name', 'creation_date', 'modification_date', 'deletion_date', 'state'));
?>