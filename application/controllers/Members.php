<?php

class Members extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mcrud');
        if (empty($this->session->userdata('member'))) {
            redirect('adminpanel');
        }
    }

    // Fungsi Index halaman
    public function members()
    {
        if (empty($this->session->userdata('member'))) {
            redirect('adminpanel');
        }
        $data['member'] = $this->Mcrud->get_all_data_2_table('tbl_member', 'tbl_kota', 'idkota', 'idkota')->result();

        $this->template->load('layout_admin', 'admin/clients/members', $data);
    }
    public function data_toko()
    {
        $this->load->model('Mfrontend');

        $data['toko'] = $this->Mfrontend->query("SELECT * FROM tbl_toko JOIN tbl_kesehatantoko USING(idtoko) JOIN tbl_member USING (idkonsumen) ORDER BY idkonsumen DESC ")->result();

        $this->template->load('layout_admin', 'admin/clients/datatoko', $data);
    }
    public function users()
    {
        $data['toko'] = $this->Mcrud->get_all_data('tbl_toko')->result();
        $data['member'] = $this->Mcrud->get_all_data_2_table('tbl_member', 'tbl_kota', 'idkota', 'idkota')->result();

        $this->template->load('layout_admin', 'admin/clients/users', $data);
    }

    // Fungsi Action
    public function delete($id, $tabel, $kolom)
    {
        $datadelete = array($kolom => $id);
        $this->Mcrud->delete($datadelete, $tabel);
        redirect('adminpanel/clients/member');
    }
    public function getid($id)
    {
        $datawhere = array('idkonsumen' => $id);
        $data['member'] = $this->Mcrud->get_by_id('tbl_member', $datawhere)->row_object();
        $this->template->load('layout_admin', 'admin/form_edit', $data);
    }

    public function login_user($u, $p)
    {
        $this->load->model('Mlogin');
        $cek = $this->Mlogin->cek_login('tbl_member', $p, $u)->row_array();
        if ($cek) {
            if ($u == $cek['password']) {
                $data_session = array(
                    'member' => $cek['username'],
                    'idkonsumen' => $cek['idkonsumen'],
                    'password' => $cek['idkonsumen']
                );
                $this->session->set_userdata($data_session);
                var_dump($data_session);
                redirect('world/dashboard');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
            Sepertinya ada kesalahan data silahkan cek manual!
            </div>');
                redirect('members/members');
            }
        }
    }

    public function delete_produk($idproduk, $idreport)
    {
        $this->load->model('Mfrontend');

        $cek = $this->Mfrontend->query("DELETE FROM tbl_report WHERE idreport=" . $idreport . "");
        if ($this->db->affected_rows($cek) >= 0) {

            $cek2 = $this->Mfrontend->query("DELETE FROM tbl_produk WHERE idproduk=" . $idproduk . "");
            if ($this->db->affected_rows($cek2)) {
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                Data produk telah dihapus!
            </div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Gagal menghapus data report!
            </div>');
                redirect('adminpanel/data_toko');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Gagal menghapus data produk!
            </div>');
            redirect('adminpanel/data_toko');
        }
    }
}
