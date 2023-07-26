<?php

class Mlogin extends CI_Model
{
    public function cek_login($a, $u, $p)
    {
        return $this->db->get_where($a, array('username' => $u, 'password' => $p));
    }
}
