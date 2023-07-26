<?php

use LDAP\Result;

class World extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Mfrontend');
    }
    public function index()
    {
        $data['top_n'] = $this->terlaris();
        $data['produk'] = $this->Mfrontend->get_all_produk_newest()->result();
        if (!empty($this->session->userdata('member'))) {
            $data['like'] = $this->Mfrontend->query("SELECT idproduk FROM tbl_liked WHERE idkonsumen=" . $this->session->userdata('idkonsumen') . "")->result();
        }
        $this->template->load('layout_members', 'world/index', $data);
    }
    public function add_cart($id)
    {
        $data['produk'] = $this->Mfrontend->get_all_data_by_id('tbl_produk', 'idproduk=' . $id)->row_array();
        $data['toko'] = $this->Mfrontend->get_all_data_by_id('tbl_toko', 'idtoko=' . $data['produk']['idtoko'])->row_array();
        $tokoid =  $data['toko']['namatoko'];
        if (empty($this->cart->contents())) {
            $cart = array(
                'id'      => $id,
                'qty'     => 1,
                'price'   =>  $data['produk']['harga'],
                'name'    =>  $data['produk']['namaproduk'],
                'foto' =>  $data['produk']['foto'],
                'namatoko' =>  $data['toko']['namatoko'],
                'idtoko' =>  $data['toko']['idtoko']
            );
            $this->cart->insert($cart);
            redirect('produk/cart');
        } else {
            $i = 0;
            $toko = [];
            foreach ($this->cart->contents() as $items) {
                $toko[$i]['id'] = $items['namatoko'];
                if ($tokoid == $toko[$i]['id']) {
                    continue;
                } else {
                    echo "<script>alert('Toko tidak dapat berbeda!');
                    </script>";
                    redirect('world');
                }
                $i++;
            }
            $cart = array(
                'id'      => $id,
                'qty'     => 1,
                'price'   =>  $data['produk']['harga'],
                'name'    =>  $data['produk']['namaproduk'],
                'foto' =>  $data['produk']['foto'],
                'namatoko' => $tokoid,
                'idtoko' =>  $data['toko']['idtoko']
            );
            $this->cart->insert($cart);
            redirect('produk/cart');
        }
    }
    public function ini()
    {
        $this->load->view('world/client/ini');
    }
    public function search($t = 1)
    {
        $keyword = $this->input->post('keyword');
        $this->load->model('Mfrontend');
        $data = $this->Mfrontend->get_all_data('tbl_produk')->result_array();

        # Membuat array produk id dan deskripsi

        $df = [];
        foreach ($data as $k => $v) {
            $df[$v['idproduk']] = $v['deskripsiproduk'];
        }
        # Pre process deskripsi produk
        foreach ($df as $k => $doc) {
            $d1[$k] = $this->pre_process($doc);
        }
        $this->load->library('ContentBasedRS');
        $cbrs = new ContentBasedRS();

        # Algoritma TFIDF
        $cbrs->create_index($d1);

        $cbrs->idf();
        $cbrs->tfidf($d1);

        # Pencarian berdasarkan keyword
        $key = $this->pre_process($keyword);
        $rec = $cbrs->search($keyword);
        # Generate top-n search result
        $top = [];
        $i = 0;
        foreach ($rec as $k => $r) {
            if ($r < $t)
                continue;

            $top[$i]['id'] = $k;
            $top[$i]['score'] = $r;
            $top[$i]['title'] = $this->Mfrontend->get_by_id('tbl_produk', 'idproduk=' . $k)->row_array();
            $i++;
        }
        $similar = $this->similar($top['title']['']);
        foreach ($similar as $k => $r) {
            $top[$i]['id'] = $k;
            $top[$i]['score'] = $r;
            $top[$i]['title'] = $this->data->get_by_id('tbl_produk', 'idproduk=' . $k)['namaproduk'];
            $i++;
        }
        $data['buku'] = $top;
        $this->load->view('page', $data);
    }

    public function similar($id)
    {
        $this->load->model('Mfrontend');
        $data = $this->Mfrontend->getBuku();

        # Membuat array produk id dan deskripsi
        $df = [];
        foreach ($data as $k => $v) {
            $df[$v['idproduk']] = $v['deskripsiproduk'];
        }

        # Pre process deskripsi produk
        foreach ($df as $k => $doc) {
            $d1[$k] = $this->pre_process($doc);
        }

        $this->load->library('ContentBasedRS');
        $cbrs = new ContentBasedRS();

        # Algoritma TFIDF
        $cbrs->create_index($d1);

        $cbrs->idf();
        $cbrs->tfidf($d1);

        $rec = $cbrs->similarity($id);

        return $rec;
    }

    private function terlaris()
    {
        $this->load->model('data');
        $data = $this->data->getBuku();

        # Membuat array produk id dan deskripsi
        $df = [];
        foreach ($data as $k => $v) {
            $df[$v['idproduk']] = $v['deskripsiproduk'];
        }
        $d1 = [];
        # Pre process deskripsi produk
        foreach ($df as $k => $doc) {
            $d1[$k] = $this->pre_process($doc);
        }

        $this->load->library('ContentBasedRS');
        $cbrs = new ContentBasedRS();

        # Algoritma TFIDF
        $cbrs->create_index($d1);

        $cbrs->idf();
        $cbrs->tfidf($d1);

        $rec = $cbrs->recom();
        $top = [];
        $i = 0;
        foreach ($rec as $k => $r) {
            if ($i == 3)
                break;
            $top[$i]['id'] = $k;
            $top[$i]['score'] = $r;
            $top[$i]['title'] = $this->data->getDetailBuku($k)['namaproduk'];
            $top[$i]['deskripsi'] = $this->data->getDetailBuku($k)['deskripsiproduk'];
            $top[$i]['foto'] = $this->data->getDetailBuku($k)['foto'];
            $i++;
        }

        return $top;
    }
    private function pre_process($str)
    {
        $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
        $stemmer = $stemmerFactory->createStemmer();

        $stopWordRemoverFactory = new \Sastrawi\StopWordRemover\StopWordRemoverFactory();
        $stopword = $stopWordRemoverFactory->createStopWordRemover();

        $str = strtolower($str);
        $str = $stemmer->stem($str);
        $str = $stopword->remove($str);

        return $str;
    }

    public function login()
    {
        $this->session->sess_destroy();
        $data['judul'] = "Login Astronouts";
        $this->load->view('script/header_script',$data);
        $this->load->view('world/login');
        $this->load->view('script/footer_script');
    }
    public function regis()
    {

        $data['kota'] = $this->Mfrontend->get_all_data('tbl_kota')->result();
        $data['judul'] = "Registrasi Astronouts";
        $this->load->view('script/header_script', $data);
        $this->load->view('world/registrasi', $data);
        $this->load->view('script/footer_script');
    }
    public function aksi_regis()
    {
        $this->form_validation->set_rules('nama', 'name', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('username', 'username', 'required|trim');
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|is_unique[tbl_member.email]', array(
            'required'      => 'You have not provided %s.',
            'is_unique'     => 'This %s already exists.'
        ));
        $this->form_validation->set_rules('password', 'password1', 'required|trim|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', 'password2', 'required|trim|matches[password]');
        $this->form_validation->set_rules('alamat', 'alamat', 'required|min_length[20]');
        $this->form_validation->set_rules('no_telpon', 'no_telpon', 'required|trim|max_length[13]|min_length[8]');

        if ($this->form_validation->run() == false) {
            $data['kota'] = $this->Mfrontend->get_all_kota()->result();

            $this->load->view('script/header_script');
            $this->load->view('world/registrasi', $data);
            $this->load->view('script/footer_script');
        } else {
            $data = array(
                'idkonsumen' => '',
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'namakonsumen' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'email' => $this->input->post('email'),
                'idkota' => $this->input->post('kota'),
                'telp' => $this->input->post('no_telpon'),
                'statusaktif' => 'Y'
            );

            $this->Mfrontend->insert('tbl_member', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
            Akun anda berhasil dibuat! silahkan Login
          </div>');
            redirect('world/login');
        }
    }

    public function aksi_login()
    {

        $this->load->model('Mlogin');

        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');

        if ($this->form_validation->run() == false) {
            redirect('world/login');
        } else {
            $u = $this->input->post('username');
            $p = $this->input->post('password');

            $cek = $this->Mlogin->cek_login('tbl_member', $u, $p)->row_array();
            if ($cek) {
                if ($p == $cek['password']) {
                    $data_session = array(
                        'member' => $cek['username'],
                        'idkonsumen' => $cek['idkonsumen']
                    );
                    $ses = $this->session->set_userdata($data_session);
                    redirect('world');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
                        Email atau Password anda salah!
                        </div>');
                    redirect('world/login');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
                    Email atau Password anda salah!
                    </div>');
                redirect('world/login');
            }
        }
    }
    public function dashboard()
    {
        if (empty($this->session->userdata('member') || $this->session->userdata('admin'))) {
            redirect('world/login');
        }
        $this->template->load('layout_members', 'world/client/dashboard');
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('world/login');
    }
    public function toko()
    {
        if (empty($this->session->userdata('member') || $this->session->userdata('admin'))) {
            redirect('world/login');
        }
        $id = $this->session->userdata('idkonsumen');
        $data['toko'] = $this->Mfrontend->get_all_data_by_id('tbl_toko', 'idkonsumen=' . $id)->result();
        $this->template->load('layout_members', 'world/client/toko', $data);
    }
    public function upload_toko()
    {
        if (empty($this->session->userdata('member') || $this->session->userdata('admin'))) {
            redirect('world/login');
        }
        $this->template->load('layout_members', 'world/client/form_toko');
    }
    public function aksi_upload($author)
    {
        if (empty($this->session->userdata('member') || $this->session->userdata('admin'))) {
            redirect('world/login');
        }
        $config['upload_path']          = './assets/assets/img/toko';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 10000;
        $config['max_width']            = 10240;
        $config['max_height']           = 76800;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('logo_toko')) {
            $gambar = $this->upload->data();
            $gambar = $gambar['file_name'];
            $data = [
                'idtoko' => '',
                'idkonsumen' => $author,
                'namatoko' => $this->input->post('nama_toko'),
                'logo' => $gambar,
                'deskripsi' => $this->input->post('deskripsi'),
                'statusaktif' => 'Y'
            ];
            $tabel = "tbl_toko";
            $this->Mfrontend->insert($tabel, $data);

            $kesehatantoko = $this->Mfrontend->get_all_data_by_id('tbl_toko', 'namatoko="' . $this->input->post('nama_toko') . '"')->row_array();

            $sehat = [
                'idkesehatantoko' => '',
                'idtoko' => $kesehatantoko['idtoko'],
                'nilai' => '100',
                'catatan' => ''

            ];
            $cek = $this->Mfrontend->insert('tbl_kesehatantoko', $sehat);

            if ($this->db->affected_rows($cek) >= 0) {
                redirect('world/toko');
            } else {
                echo "gagal";
            }
        }
    }
    public function aksi_upload_produk()
    {
        if (empty($this->session->userdata('member') || $this->session->userdata('admin'))) {
            redirect('world/login');
        }
        $config['upload_path']          = './assets/assets/img/products';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1000000;
        $config['max_width']            = 10240;
        $config['max_height']           = 76800;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('gambar')) {
            $gambar = $this->upload->data();
            $gambar = $gambar['file_name'];
            $data = [
                'idproduk' => '',
                'idkategori' => $this->input->post('kategori'),
                'idtoko' => $this->input->post('idtoko'),
                'namaproduk' => $this->input->post('nama'),
                'foto' => $gambar,
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok'),
                'berat' => $this->input->post('berat'),
                'deskripsiproduk' => $this->input->post('deskripsi'),
            ];
            $tabel = "tbl_produk";
            $this->Mfrontend->insert($tabel, $data);
            redirect('world/dashboard_toko/' . $this->input->post('idtoko'));
        } else {
            echo "gagal";
        }
    }

    public function nilaitoko($idtoko)
    {

        $cek = $this->Mfrontend->query("SELECT idtoko,idproduk,COUNT(iddetailorder) AS 'JumlahOrder' FROM tbl_detail_order JOIN tbl_order tr USING(idorder) WHERE tr.idtoko=" . $idtoko . "")->row_array();
        $ceks = $this->Mfrontend->query("SELECT idtoko,idproduk,COUNT(idreport) AS 'JumlahReport' FROM tbl_report WHERE idtoko=" . $idtoko . "")->row_array();

        if (!$cek) {

            $hasil = $ceks['JumlahReport'] / $cek['JumlahOrder'] * 100;

            $nilai = 100 - $hasil;

            $data = array(

                'nilai' => $nilai,

            );
            $this->Mfrontend->update('tbl_kesehatantoko', $data, 'idkesehatantoko=' . $idtoko);
            return  $nilai;
        } else {

            $nilai = 100;
            $data = array(

                'nilai' => $nilai,

            );
            $this->Mfrontend->update('tbl_kesehatantoko', $data, 'idkesehatantoko=' . $idtoko);
            return  $nilai;
        }
    }
    public function dashboard_toko($id)
    {
        if (empty($this->session->userdata('member') || $this->session->userdata('admin'))) {
            redirect('world/login');
        }
        $data['toko'] = $this->Mfrontend->get_by_id('tbl_toko', 'idtoko =' . $id)->row_object();
        $data['transaksi'] = $this->Mfrontend->get_by_id('tbl_order', 'idtoko =' . $id)->result();
        $data['kesehatantoko'] = $this->Mfrontend->get_by_id('tbl_kesehatantoko', 'idtoko =' . $id)->row_object();

        $data['nilaitoko'] = $this->nilaitoko($id);

        $data['produk'] = $this->Mfrontend->get_all_data_2_table('tbl_produk', 'tbl_kategori', 'idkategori', 'idtoko = ' . $id)->result();

        $this->template->load('layout_toko', 'world/client/dashboard_toko', $data);
    }
    public function produk($id)
    {
        if (empty($this->session->userdata('member') || $this->session->userdata('admin'))) {
            redirect('world/login');
        }
        $data['id'] = array('idtoko' => $id);
        $data['kategori'] = $this->Mfrontend->get_all_data('tbl_kategori')->result();
        $this->template->load('layout_toko', 'world/client/form_produk', $data);
    }
}
