<?php

use LDAP\Result;
use phpDocumentor\Reflection\Types\Null_;

defined('BASEPATH') or exit('no direct script allowed');


class produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Mfrontend');
    }
    public function detailproduk($id)
    {

        //komentar
        $data['komentar'] = $this->Mfrontend->query("SELECT * FROM tbl_komentar JOIN tbl_detail_order USING (iddetailorder) JOIN tbl_order USING (idorder) WHERE idproduk=" . $id . "")->result();

        //Recomendasi
        $data['top_n'] = $this->top_n($id);
        //Product
        $data['detail'] = $this->Mfrontend->get_all_data_by_id('tbl_produk', "idproduk=" . $id)->result();
        $toko = $data['detail'][0]->idtoko;
        $data['toko'] = $this->Mfrontend->get_all_data_2_table('tbl_toko', 'tbl_member', 'idkonsumen', 'idtoko=' . $toko)->result();

        $this->template->load('layout_members', 'world/detailproduk', $data);
    }
    public function komentar()
    {
        $id = $this->input->post('idorder');

        $order = $this->Mfrontend->get_all_data_by_id('tbl_detail_order', 'idorder=' . $id)->result_array();

        $jumlah = count($order);

        $produk = [];
        for ($i = 0; $i < $jumlah; $i++) {
            $produk['produk'][$i] = $this->input->post('idproduk' . $order[$i]['idproduk']);
            $produk['iddetailorder'][$i] = $this->input->post('iddetailorder' . $order[$i]['idproduk']);
            $produk['nilai'][$i] = $this->input->post('nilaiproduk' . $order[$i]['idproduk']);
            $produk['catatan'][$i] = $this->input->post('catatanproduk' . $order[$i]['idproduk']);
        }
        for ($i = 0; $i < $jumlah; $i++) {
            $data = array(
                'idkomentar' => '',
                'iddetailorder' =>  $produk['iddetailorder'][$i],
                'nilai' => $produk['nilai'][$i],
                'komentar' => $produk['catatan'][$i]
            );
            $cek = $this->Mfrontend->insert('tbl_komentar', $data);
        }
        if ($this->db->affected_rows($cek)) {
            $validasi = array(
                'statusorder' => 'Reviewed',
            );
            $this->Mfrontend->update('tbl_order', $validasi, 'idorder=' . $id);

            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
           Penilaian anda berhasil dikirimkan! 
          </div>');
            redirect('transaksi/riwayat_pembelian');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Gagal memberikan penilian! 
            </div>');
            redirect('transaksi/riwayat_pembelian');
        }
    }
    private function top_n($id, $n = 4)
    {
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

        # Pencarian berdasarkan item-id
        $key = $this->Mfrontend->get_by_id('tbl_produk', 'idproduk=' . $id)->row_array();
        $kk = $this->pre_process($key['deskripsiproduk']);
        $rec = $cbrs->similarity($id);

        # Generate top-n recommendation
        $top = [];
        $i = 0;
        foreach ($rec as $k => $r) {
            if ($i == $n)
                break;
            if ($k == $id)
                continue;

            $top[$i]['id'] = $k;
            $top[$i]['score'] = $r;
            $top[$i]['title'] = $this->Mfrontend->get_by_id('tbl_produk', 'idproduk=' . $k)->row_array();
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
    public function add_cart()
    {
        if (empty($this->session->userdata('member'))) {
            redirect('world/login');
        }
        $namatoko = $this->input->post('namatoko');
        $idtoko = $this->input->post('idtoko');
        $id = $this->input->post('idproduk');
        $namaproduk = $this->input->post('namaproduk');
        $harga = $this->input->post('harga');
        $foto =  $this->input->post('foto');
        if (empty($this->cart->contents())) {
            $cart = array(
                'id'      => $id,
                'qty'     => 1,
                'price'   => $harga,
                'name'    => $namaproduk,
                'foto' => $foto,
                'namatoko' => $namatoko,
                'idtoko' => $idtoko,
                'ongkir' => ''
            );
            $data['kota'] = $this->Mfrontend->query('SELECT * FROM tbl_kota')->result();
            $data['pengirim'] = $this->Mfrontend->query('SELECT * FROM tbl_kurir')->result();
            $this->cart->insert($cart);
            redirect('produk/cart');
        } else {
            $i = 0;
            $toko = [];
            foreach ($this->cart->contents() as $items) {
                $toko[$i]['id'] = $items['namatoko'];
                if ($namatoko == $toko[$i]['id']) {
                    continue;
                } else {
                    echo "gagal";
                    die;
                }
                $i++;
            }
            $cart = array(
                'id'      => $id,
                'qty'     => 1,
                'price'   => $harga,
                'name'    => $namaproduk,
                'foto' => $foto,
                'namatoko' => $namatoko,
                'idtoko' => $idtoko,
                'ongkir' => ''
            );
            $this->cart->insert($cart);
            redirect('produk/cart');
        }
    }
    public function remove($id)
    {
        $data = array(
            'rowid' => $id,
            'qty' => 0,
            'price'   => Null,
            'name'    => Null,
            'foto' => Null,
            'namatoko' => Null
        );
        $this->cart->update($data);
        redirect('produk/cart');
    }
    public function update_cart($rowid, $id)
    {
        $data = array(
            'rowid' => $rowid,
            'qty' => $id
        );
        $this->cart->update($data);
        redirect('produk/cart');
    }
    public function cart()
    {
        if (empty($this->session->userdata('member'))) {
            redirect('world/login');
        }
        $this->load->library('form_validation');

        if ($this->input->post()) {
            $data['tujuan'] = $this->input->post('kota');
            $data['kurir'] = $this->input->post('kurir');
            $data['toko'] = $this->input->post('idtoko');
            $this->form_validation->set_rules('kota', 'Kota', 'required');
            $this->form_validation->set_rules('kurir', 'Kurir', 'required');
            if ($this->form_validation->run() == false) {
                header("Refresh:0");
            } else {
                $toko = $this->Mfrontend->get_all_data_2_table('tbl_toko', 'tbl_member', 'idkonsumen', 'idtoko=' . $data['toko'])->row_array();

                $ongkir['kota'] = $this->Mfrontend->query('SELECT * FROM tbl_kota')->result();

                $ongkir['pengirim'] = $this->Mfrontend->query('SELECT * FROM tbl_kurir')->result();

                $ongkir['ongkir'] = $this->Mfrontend->query("SELECT `idbiayakirim`, `b`.`namakota`, c.namakota AS 'Kota Tujuan', `a`.`namakurir`, `biaya` FROM `tbl_biaya_kirim` JOIN `tbl_kurir` AS `a` ON `tbl_biaya_kirim`.`idkurir`=`a`.`idkurir` JOIN `tbl_kota` AS `b` ON `tbl_biaya_kirim`.`idkotaasal`=`b`.`idkota` JOIN `tbl_kota` AS `c` ON `tbl_biaya_kirim`.`idkotatujuan`=`c`.`idkota` where idkotaasal = " . $toko['idkota'] . " and a.idkurir = " . $data['kurir'] . " and idkotatujuan = " . $data['tujuan'] . "")->row_array();

                $this->template->load('layout_members', 'world/cart', $ongkir);
            }
        } else {
            $data['kota'] = $this->Mfrontend->query('SELECT * FROM tbl_kota')->result();
            $data['pengirim'] = $this->Mfrontend->query('SELECT * FROM tbl_kurir')->result();
            $this->template->load('layout_members', 'world/cart', $data);
        }
    }

    public function favorite()
    {
        $idproduk = $this->input->post('idproduk');
        $idkonsumen = $this->input->post('idkonsumen');
        $data = array(
            'idlike' => '',
            'idproduk' => $idproduk,
            'idkonsumen' => $idkonsumen
        );
        $this->Mfrontend->insert('tbl_liked', $data);
    }
    public function delete_favorite()
    {
        $idproduk = $this->input->post('idproduk');
        $idkonsumen = $this->input->post('idkonsumen');

        $this->db->delete('tbl_liked', array('idproduk' => $idproduk, 'idkonsumen' => $idkonsumen));
    }
    public function like()
    {

        $data['like'] = $this->Mfrontend->get_all_data_by_id('tbl_liked', 'idkonsumen=' . $this->session->userdata('idkonsumen'))->result();

        if (!empty($data['like'])) {
            $i = 0;
            foreach ($data['like'] as $suka) {
                $produk['produk'][$i] = $this->Mfrontend->query("SELECT * FROM tbl_produk WHERE idproduk=" . $suka->idproduk . "")->result();
                $i++;
            }
            $this->template->load('layout_members', 'world/like', $produk);
        } else {
            $this->template->load('layout_members', 'world/like');
        }
    }
}
