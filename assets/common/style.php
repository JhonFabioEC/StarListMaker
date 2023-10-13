<?php
    class Style {
        function GetCommon($url) {
            echo '
                <link rel="stylesheet" href="'.$url.'/assets/plugins/bootstrap/css/bootstrap.min.css">
                <link rel="stylesheet" href="'.$url.'/assets/plugins/fontawesome/css/all.min.css">
                <link rel="stylesheet" href="'.$url.'/assets/plugins/sweetAlert2/dist/sweetalert2.min.css">
                <link rel="stylesheet" href="'.$url.'/assets/plugins/datatables/datatables.min.css">
                <link rel="stylesheet" href="'.$url.'/assets/plugins/datatables/DataTables-1.10.18/css/dataTables.bootstrap.min.css">
                <link rel="stylesheet" href="'.$url.'/assets/plugins/datatables/Responsive-2.4.1/css/responsive.dataTables.min.css">
                <link rel="stylesheet" href="'.$url.'/assets/css/style.css">
            ';
        }

        function GetRegister($url) {
            echo '
                <link rel="stylesheet" href="'.$url.'/assets/css/register/style.css">
            ';
        }

        function GetUser($url) {
            echo '
                <link rel="stylesheet" href="'.$url.'/assets/css/user/style.css">
            ';
        }

        function GetPerson($url) {
            echo '
                <link rel="stylesheet" href="'.$url.'/assets/css/person/style.css">
            ';
        }

        function GetEstablishment($url) {
            echo '
                <link rel="stylesheet" href="'.$url.'/assets/css/establishment/register.css">
            ';
        }
    }
