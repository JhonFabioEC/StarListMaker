<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/StarListMaker/assets/services/connection/config.php";

    class TableData {
        public function get($table, $index_column, $columns) {
            $gaSql['user']      = USER;
            $gaSql['password']  = PASSWORD;
            $gaSql['db']        = DATABASE;
            $gaSql['server']    = HOST;
            $gaSql['port']      = PORT;

            /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
            * If you just want to use the basic configuration for DataTables with PHP server-side, there is
            * no need to edit below this line
            */
            
            /*
            * DB connection
            */
            $gaSql['link'] = pg_connect(
                " host=".$gaSql['server'].
                " port=".$gaSql['port'].
                " dbname=".$gaSql['db'].
                " user=".$gaSql['user'].
                " password=".$gaSql['password']
            ) or die('Could not connect: ' . pg_last_error());

            /*
            * Paging
            */
            $sLimit = "";
            if(isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1'){
                $sLimit = "LIMIT ".intval($_GET['iDisplayLength'])." OFFSET ".
                    intval($_GET['iDisplayStart']);
            }
            
            /*
            * Ordering
            */
            if(isset($_GET['iSortCol_0'])){
                $sOrder = "ORDER BY  ";
                for($i=0 ; $i<intval($_GET['iSortingCols']); $i++){
                    if($_GET['bSortable_'.intval($_GET['iSortCol_'.$i])] == "true"){
                        $sOrder .= $columns[intval($_GET['iSortCol_'.$i])]."
                            ".($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc').", ";
                    }
                }
                
                $sOrder = substr_replace($sOrder, "", -2);
                if($sOrder == "ORDER BY"){
                    $sOrder = "";
                }
            }
            
            /*
            * Filtering
            * NOTE This assumes that the field that is being searched on is a string typed field (ie. one
            * on which ILIKE can be used). Boolean fields etc will need a modification here.
            */
            $sWhere = "";
            if($_GET['sSearch'] != "")
            {
                $sWhere = "WHERE (";
                for($i=0 ; $i<count($columns); $i++){
                    if ($_GET['bSearchable_'.$i] == "true" && $i > 0 && $i < count($columns)-1){
                        $sWhere .= $columns[$i]." ILIKE '%".pg_escape_string($_GET['sSearch'])."%' OR ";
                    }
                }
                $sWhere = substr_replace( $sWhere, "", -3 );
                $sWhere .= ")";
            }
            
            /* Individual column filtering */
            for ($i=0; $i<count($columns); $i++){
                if ($_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != ''){
                    if ($sWhere == ""){
                        $sWhere = "WHERE ";
                    }else{
                        $sWhere .= " AND ";
                    }
                    $sWhere .= $columns[$i]." ILIKE '%".pg_escape_string($_GET['sSearch_'.$i])."%' ";
                }
            }
            
            $sQuery = "
                SELECT ".str_replace(" , ", " ", implode(", ", $columns))." FROM $table $sWhere $sOrder $sLimit
            ";

            $rResult = pg_query($gaSql['link'], $sQuery) or die(pg_last_error());
            
            $sQuery = "
                SELECT $index_column FROM $table
            ";

            $rResultTotal = pg_query($gaSql['link'], $sQuery) or die(pg_last_error());
            $iTotal = pg_num_rows($rResultTotal);
            pg_free_result( $rResultTotal );
            
            if($sWhere != ""){
                $sQuery = "
                    SELECT $index_column FROM $table $sWhere
                ";

                $rResultFilterTotal = pg_query($gaSql['link'], $sQuery) or die(pg_last_error());
                $iFilteredTotal = pg_num_rows($rResultFilterTotal);
                pg_free_result($rResultFilterTotal);
            }else{
                $iFilteredTotal = $iTotal;
            }
            
            /*
            * Output
            */
            $output = array(
                "sEcho" => intval($_GET['sEcho']),
                "iTotalRecords" => $iTotal,
                "iTotalDisplayRecords" => $iFilteredTotal,
                "aaData" => array()
            );
            
            while($aRow = pg_fetch_array($rResult, null, PGSQL_ASSOC)){
                $row = array();
                for($i=0; $i<count($columns); $i++){
                    if($columns[$i] == "version"){
                        /* Special output formatting for 'version' column */
                        $row[] = ($aRow[$columns[$i]]=="0") ? '-' : $aRow[$columns[$i]];
                    }else if ($columns[$i] != ' '){
                        /* General output */
                        $row[] = $aRow[$columns[$i]];
                    }
                }
                $output['aaData'][] = $row;
            }
            
            echo json_encode($output);
            
            // Free resultset
            pg_free_result($rResult);
            
            // Closing connection
            pg_close($gaSql['link']);
        }
    }
    header('Pragma: no-cache');
    header('Cache-Control: no-store, no-cache, must-revalidate');
    $table_data = new TableData();
?>