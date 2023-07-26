<?php

class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mcrud');
        if (empty($this->session->userdata('idadmin'))) {
            redirect('adminpanel');
        }
    }
    public function index()
    {
        if (empty($this->session->userdata('idadmin'))) {
            redirect('adminpanel');
        }

        $data['kategori'] = $this->Mcrud->get_all_data('tbl_kategori')->result();

        $this->template->load('layout_admin', 'admin/kategori', $data);
    }
    public function add($form, $url, $tabel, $nama)
    {
        $data['info'] = array(
            'form' => $form,
            'url' => $url,
            'tabel' => $tabel,
            'nama' => $nama
        );
        $this->template->load('layout_admin', 'admin/form_add', $data);
    }

    public function save($tabel, $data)
    {
        $namakategori = $this->input->post('nama');
        $datainsert = array($data => $namakategori);
        $this->Mcrud->insert($tabel, $datainsert);
        $this->session->set_flashdata('huruf', '<div class="alert alert-primary" role="alert">
            Successfull!
            </div>)');
        redirect('kategori');
    }

    public function getid($id)
    {
        $datawhere = array('idkategori' => $id);
        $data['kategori'] = $this->Mcrud->get_by_id('tbl_kategori', $datawhere)->row_object();
        $this->template->load('layout_admin', 'admin/form_edit', $data);
    }
    public function edit()
    {
        $id = $this->input->post('id');
        $namakategori = $this->input->post('nama_kategori');
        $dataupdate = array('namakategori' => $namakategori);
        $this->Mcrud->update('tbl_kategori', $dataupdate, 'idkategori', $id);
        redirect('kategori');
    }

    public function delete($id)
    {
        $datadelete = array('idkategori' => $id);
        $this->Mcrud->delete($datadelete, 'tbl_kategori');
        redirect('kategori');
    }
}
