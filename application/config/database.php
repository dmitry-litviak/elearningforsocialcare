<?php defined('SYSPATH') OR die('No direct access allowed.');

$whitelist = array('elearningforsocialcare.loc');
if(in_array($_SERVER['HTTP_HOST'], $whitelist)){

    return array
    (
        'default' => array
        (
            'type'       => 'MySQL',
            'connection' => array(
                /**
                 * The following options are available for MySQL:
                 *
                 * string   hostname     server hostname, or socket
                 * string   database     database name
                 * string   username     database username
                 * string   password     database password
                 * boolean  persistent   use persistent connections?
                 * array    variables    system variables as "key => value" pairs
                 *
                 * Ports and sockets may be appended to the hostname.
                 */
                'hostname'   => 'localhost',
                'database'   => 'elearningforsocialcare',
                'username'   => 'root',
                'password'   => 'root',
                'persistent' => FALSE,
            ),
            'table_prefix' => '',
            'charset'      => 'utf8',
            'caching'      => FALSE,
        )
    );

}else{
    return array
    (
        'default' => array
        (
            'type'       => 'MySQL',
            'connection' => array(
                /**
                 * The following options are available for MySQL:
                 *
                 * string   hostname     server hostname, or socket
                 * string   database     database name
                 * string   username     database username
                 * string   password     database password
                 * boolean  persistent   use persistent connections?
                 * array    variables    system variables as "key => value" pairs
                 *
                 * Ports and sockets may be appended to the hostname.
                 */
                'hostname'   => 'localhost',
                'database'   => 'apartments',
                'username'   => 'root',
                'password'   => 'qwerfvbnm321Q',
                'persistent' => FALSE,
            ),
            'table_prefix' => '',
            'charset'      => 'utf8',
            'caching'      => FALSE,
        )
    );

}


