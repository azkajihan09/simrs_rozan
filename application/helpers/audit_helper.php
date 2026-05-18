<?php

function simpan_log($aktivitas)
{

    $CI =& get_instance();

    $insert = [

        'user_id' =>
            $CI->session->userdata(
                'id_user'
            ),

        'aktivitas' =>
            $aktivitas,

        'ip_address' =>
            $_SERVER['REMOTE_ADDR']

    ];

    if(
        $CI->db->table_exists(
            'audit_log'
        )
    ){

        $CI->db->insert(
            'audit_log',
            $insert
        );
    }

}