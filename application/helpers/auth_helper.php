<?php

function cek_login()
{
    $CI =& get_instance();

    if(!$CI->session->userdata('login')){

        redirect('auth');
    }
}

function cek_role($role)
{
    $CI =& get_instance();

    if($CI->session->userdata('role_id') != $role){

        redirect('dashboard');
    }
}