<?php

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function aksi_login()
    {
        $this->load->model('Mlogin');

        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');

        if ($this->form_validation->run() == false) {
            redirect('adminpanel');
        } else {
            $u = $this->input->post('username');
            $p = $this->input->post('password');


            $cek = $this->Mlogin->cek_login('tbl_admin', $u, $p)->row_array();
            if ($cek) {
                if ($p == $cek['password']) {
                    $data = array(
                        'idadmin' => $cek['idadmin'],
                        'member' => $cek['username'],
                        'idkonsumen' => $cek['idadmin']
                    );
                    $ceks = $this->session->set_userdata($data);
                    redirect('adminpanel/dashboard');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
                        Email atau Password anda salah!
                        </div>');
                    redirect('adminpanel');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
                    Email atau Password anda salah!
                    </div>');
                redirect('adminpanel');
            }
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('adminpanel');
    }
}
