<?php
defined('BASEPATH') or exit('no direct script allowed');


class adminpanel extends CI_Controller
{
    public function dashboard()
    {
        if ($this->session->userdata('admin')) {
            redirect('adminpanel');
        }
        $this->template->load('layout_admin', 'admin/dashboard');
    }
    public function index()
    {
        $this->session->sess_destroy();
        $data['judul']="Login Astronouts";
        $this->load->view('script/header_script',$data);
        $this->load->view('admin/form_login');
        $this->load->view('script/footer_script');
    }
    public function store()
    {
        # code...
    }
}
