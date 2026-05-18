<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {


    public function __construct()
    
    {
        parent::__construct();
        $this->load->model('M_auth');
        
        
        
    }
 

    public function index()
    {
        $this->load->view('auth/login');
    }

   public function login()
{
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    $user = $this->M_auth->login($username, $password);

    if($user){

        $this->session->set_userdata([
            'login'     => true,
            'logged_in' => true,
            'user_id'   => $user->id,
            'nama'      => $user->nama,
            'role'      => $user->role_id,
            'role_id'   => $user->role_id
        ]);

        redirect('dashboard');

    } else {

        $this->session->set_flashdata('error', 'Username atau Password salah');

        redirect('auth');
    }
}

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
