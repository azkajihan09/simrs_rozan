<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {

    public function login($username, $password)
    {
        $this->db->select('*');
        $this->db->from('users');

        $this->db->where('username', $username);
        $this->db->where('password', md5($password));

        // Jika ada field status
        // $this->db->where('status', 'aktif');

        return $this->db->get()->row();
    }
}