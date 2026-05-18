<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('cek_hak_akses')){

    function cek_hak_akses($roles = [])
    {

        $CI =& get_instance();

        $user_role =
            $CI->session->userdata('role');

        if(empty($user_role)){

            redirect('auth');
        }

        if(!in_array($user_role, $roles)){

            $CI->session->set_flashdata(
                'error',
                'Anda tidak memiliki akses'
            );

            redirect('dashboard');
        }

    }

}