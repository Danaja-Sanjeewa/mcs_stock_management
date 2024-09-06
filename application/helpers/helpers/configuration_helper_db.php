<?php
/*connection to application DB*/
if (!function_exists('connect_applicationDB')) {
    function connect_applicationDB($status)
    {

        $CI = &get_instance();
        // $db['hostname'] = 'excalibur-dev-qa-db-instance-1.cpohzq4n3ojn.ap-southeast-1.rds.amazonaws.com';
        // $db['username'] = 'admin';
        // $db['password'] = 'h*zelNut##$$960220';
        // $db['database'] = 'ex_maindb_qa';
        $db['hostname'] = 'localhost';
        $db['username'] = 'chama';      
        $db['password'] = 'Chamath@1234';
        // $db['database'] = 'ex_maindb_leaf_staging';
        $db['database'] = 'ex_maindb_dev';
        // $db['database'] = 'ex_maindb_prod';
        $db['dbdriver'] = 'mysqli';
        $db['dbprefix'] = '';
        $db['pconnect'] = FALSE;
        $db['db_debug'] = TRUE;


        $CI->load->database($db, FALSE, TRUE);
    }
}
