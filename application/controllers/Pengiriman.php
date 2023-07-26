<?php

class Pengiriman extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mcrud');
        $this->load->library('form_validation');
        if (empty($this->session->userdata('member'))) {
            redirect('adminpanel');
        }
    }

    public function kurir()
    {
        $data['kurir'] = $this->Mcrud->get_all_data('tbl_kurir')->result();

        $this->template->load('layout_admin', 'admin/kurir', $data);
    }
    public function Kota()
    {
        $data['kota'] = $this->Mcrud->get_all_data('tbl_kota')->result();

        $this->template->load('layout_admin', 'admin/kota', $data);
    }
    public function delete($id, $tabel, $kolom)
    {
        $datadelete = array($kolom => $id);
        $this->Mcrud->delete($datadelete, $tabel);
        redirect('adminpanel/dashboard');
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
    public function save($tabel, $data, $form)
    {
        $this->form_validation->set_rules('nama', 'nama', 'required|alpha');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('huruf', '<div class="alert alert-danger" role="alert">
            Input Invalid ! 
            The field must be letters only
            </div>');

            redirect('pengiriman/' . $form);
        } else {
            $nama = $this->input->post('nama');
            $datainsert = array($data => $nama);
            $this->Mcrud->insert($tabel, $datainsert);

            $this->session->set_flashdata('huruf', '<div class="alert alert-primary" role="alert">
            Successfull!
            </div>
            
            ');

            redirect('pengiriman/' . $form);
        }
    }

    public function ongkos()
    {
        //$data['ongkos'] = $this->Mcrud->get_all_data('tbl_biaya_kirim')->result();
        $data['ongkos'] = $this->Mcrud->get_all_data_3_table('tbl_biaya_kirim', 'tbl_kurir', 'tbl_kota', 'idkotaasal', 'idkurir', 'idkota', 'idkotatujuan')->result_array();

        $this->template->load('layout_admin', 'admin/ongkos', $data);
    }
    public function form_biaya_kirim()
    {
        $data['kurir'] = $this->Mcrud->get_all_data('tbl_kurir')->result();
        $data['kota'] = $this->Mcrud->get_all_data('tbl_kota')->result();

        $this->template->load('layout_admin', 'admin/form_add_ongkos', $data);
    }
    public function add_biaya($table)
    {
        $data = array(
            'idbiayakirim' => '',
            'idkurir' => $this->input->post('kurir'),
            'idkotaasal' => $this->input->post('kota-asal'),
            'idkotatujuan' => $this->input->post('kota-tujuan'),
            'biaya' => $this->input->post('biaya'),
        );
        $this->Mcrud->insert($table, $data);
        redirect('pengiriman/ongkos');
    }
}
