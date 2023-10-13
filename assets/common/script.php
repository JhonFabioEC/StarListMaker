<?php
    class Script {
        function GetCommon($url) {
            echo '
                <script type="text/javascript" src="'.$url.'/assets/js/plugins/jquery-3.7.0.min.js"></script>
                <script type="text/javascript" src="'.$url.'/assets/js/plugins/popper.min.js.map"></script>
                <script type="text/javascript" src="'.$url.'/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
                <script type="text/javascript" src="'.$url.'/assets/plugins/fontawesome/js/all.min.js"></script>
                <script type="text/javascript" src="'.$url.'/assets/plugins/sweetAlert2/dist/sweetalert2.all.min.js"></script>
                <script type="text/javascript" src="'.$url.'/assets/plugins/datatables/datatables.min.js"></script>
                <script type="text/javascript" src="'.$url.'/assets/plugins/datatables/Responsive-2.4.1/js/dataTables.responsive.min.js"></script>
                <script type="text/javascript" src="'.$url.'/assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
                <script type="text/javascript" src="'.$url.'/assets/js/plugins/traducciones.js"></script>
                <script type="text/javascript" src="'.$url.'/assets/js/common/logout.js"></script>
                <script type="text/javascript" src="'.$url.'/assets/js/common/spinner.js"></script>
                <script type="text/javascript" src="'.$url.'/assets/js/common/cart.js"></script>
                <script type="text/javascript" src="'.$url.'/assets/js/common/search.js"></script>
            ';
        }
        
        function GetDocumentType($url) {
            echo '
                <script type="text/javascript" src="'.$url.'/assets/js/document_type/script.js"></script>
            ';
        }

        function GetEstablishmentType($url) {
            echo '
                <script type="text/javascript" src="'.$url.'/assets/js/establishment_type/script.js"></script>
            ';
        }

        function GetVehicle($url) {
            echo '
                <script type="text/javascript" src="'.$url.'/assets/js/vehicle/script.js"></script>
            ';
        }

        function GetCategory($url) {
            echo '
                <script type="text/javascript" src="'.$url.'/assets/js/category/script.js"></script>
            ';
        }

        function GetBrand($url) {
            echo '
                <script type="text/javascript" src="'.$url.'/assets/js/brand/script.js"></script>
            ';
        }

        function GetProduct($url) {
            echo '
                <script type="text/javascript" src="'.$url.'/assets/js/product/script.js"></script>
            ';
        }

        function GetLogin($url) {
            echo '
                <script type="text/javascript" src="'.$url.'/assets/js/login/script.js"></script>
            ';
        }

        function GetRegister($url) {
            echo '
                <script type="text/javascript" src="'.$url.'/assets/js/register/script.js"></script>
            ';
        }

        function GetUser($url) {
            echo '
                <script type="text/javascript" src="'.$url.'/assets/js/user/script.js"></script>
            ';
        }

        function GetPerson($url) {
            echo '
                <script type="text/javascript" src="'.$url.'/assets/js/common/multi_step_form.js"></script>
                <script type="text/javascript" src="'.$url.'/assets/js/person/script.js"></script>
            ';
        }

        function GetPersonValidate($url) {
            echo '
                <script type="text/javascript" src="'.$url.'/assets/js/person/validate.js"></script>
            ';
        }

        function GetEstablishment($url) {
            echo '
                <script type="text/javascript" src="'.$url.'/assets/js/common/multi_step_form.js"></script>
                <script type="text/javascript" src="'.$url.'/assets/js/establishment/script.js"></script>
            ';
        }

        function GetEstablishmentValidate($url) {
            echo '
                <script type="text/javascript" src="'.$url.'/assets/js/establishment/validate.js"></script>
            ';
        }
    }
