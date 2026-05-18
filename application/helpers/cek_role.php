<?php
function cek_role($role)
{

    $CI =& get_instance();

    if(
        $CI->session->userdata(
            'role'
        ) != $role
    ){

        redirect('dashboard');
    }
}