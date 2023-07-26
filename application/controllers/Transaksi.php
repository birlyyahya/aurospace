<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mfrontend');
        if (empty($this->session->userdata('member') || $this->session->userdata('admin'))) {
            redirect('world/login');
        }
    }
    public function add_order()
    {

        if (empty($this->input->post('ongkir'))) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Tentukan Pengiriman Terlebih Dahulu!
            </div>');
            redirect('produk/cart');
        } else {
            date_default_timezone_set("Asia/jakarta");
            $date = date("Y-m-d h:i:s");
            $order = [
                'idorder' => '',
                'idkonsumen' => $this->input->post('konsumen'),
                'idtoko' => $this->input->post('idtoko'),
                'tglorder' =>  $date,
                'total' =>  $this->input->post('total'),
                'statusorder' =>  'Belum Bayar',
            ];
            $this->Mfrontend->insert('tbl_order', $order);

            $detail = $this->Mfrontend->query("SELECT idorder FROM tbl_order WHERE idkonsumen=" . $this->input->post('konsumen') . " AND tglorder='" . $date . "'")->row_array();
            $cek = $this->cart->contents();

            foreach ($cek as $cart) {
                $detailorder = [
                    'iddetailorder' => '',
                    'idorder' => $detail['idorder'],
                    'idproduk' =>  $cart['id'],
                    'jumlah' =>   $cart['qty'],
                    'harga' =>  $cart['price'],
                    'ongkir' => $this->input->post('ongkir'),
                ];
                $this->Mfrontend->insert('tbl_detail_order', $detailorder);
            }
            redirect('transaksi/order');
        }
    }
    public function order()
    {

        $id = $this->session->userdata['idkonsumen'];
        $data['order'] = $this->Mfrontend->query("SELECT DISTINCT idorder,namakonsumen,statusorder,noresi,idtoko, DATE_FORMAT(tglorder, '%W %e %M %Y')AS'tanggal' FROM `tbl_member` p JOIN tbl_order USING (idkonsumen) LEFT JOIN tbl_detail_order USING(idorder) WHERE p.idkonsumen= " . $id . " AND statusorder NOT IN ('Selesai','Dibatalkan','Reviewed')")->result();

        $this->template->load('layout_members', 'world/client/transaksi', $data);
    }

    //output order pada transaksi pelapak
    public function konfirmasi($idtoko)
    {

        $data['order'] = $this->Mfrontend->query("SELECT DISTINCT idorder,namakonsumen,statusorder,idtoko,DATE_FORMAT(tglorder, '%W %e %M %Y')AS'tanggal' FROM `tbl_member` p JOIN tbl_order USING (idkonsumen) LEFT JOIN tbl_detail_order USING(idorder)  JOIN tbl_toko USING (idtoko) WHERE idtoko= " . $idtoko . " AND statusorder NOT IN ('Selesai','Dibatalkan','Reviewed')")->result();


        $data['toko'] = $this->Mfrontend->get_by_id('tbl_toko', 'idtoko =' . $idtoko)->row_object();
        $data['produk'] = $this->Mfrontend->get_all_data_2_table('tbl_produk', 'tbl_kategori', 'idkategori', 'idtoko = ' . $idtoko)->result();

        $this->template->load('layout_members', 'world/client/transaksi_toko', $data);
    }

    //proses pembayaran
    public function verifikasi()
    {
        $idorder = $this->input->post('idorder');

        $config['upload_path']          = './assets/assets/img/transfer';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1000000;
        $config['max_width']            = 10240;
        $config['max_height']           = 76800;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('gambar')) {
            $gambar = $this->upload->data();
            $gambar = $gambar['file_name'];
            $data = [
                'idkonfirmasi' => '',
                'idorder' => $idorder,
                'buktitf' => $gambar,
                'validasi' => ''
            ];
            $this->Mfrontend->insert('tbl_konfirmasi', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
                Pemabayaran akan segera diproses!
              </div>');
            redirect('transaksi/order');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Gagal Mengirimkan Pembayaran!
              </div>');
            redirect('transaksi/order');
        }
    }



    //proses transaksi berlangsung 

    public function konfirmasi_pembayaran($idorder, $idkonfirmasi, $idtoko)
    {
        $validasi = array(
            'validasi' => 'Y'
        );
        $cek = $this->Mfrontend->update('tbl_konfirmasi', $validasi, 'idkonfirmasi=' . $idkonfirmasi);

        if ($this->db->affected_rows($cek) >= 0) {
            $status = array(
                'statusorder' => 'Dikemas'
            );
            $this->Mfrontend->update('tbl_order', $status, 'idorder=' . $idorder);
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
            Pemabayaran telah dikonfirmasi!
          </div>');
            redirect('transaksi/konfirmasi/' . $idtoko);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Gagal melakukan  konfirmasi!
            </div>');
            redirect('transaksi/konfirmasi/' . $idtoko);
        }
    }
    public function batal_pembayaran($idorder, $idkonfirmasi, $idtoko)
    {
        $validasi = array(
            'validasi' => 'N'
        );
        $cek = $this->Mfrontend->update('tbl_konfirmasi', $validasi, 'idkonfirmasi=' . $idkonfirmasi);
        if ($this->db->affected_rows($cek) >= 0) {
            $status = array(
                'statusorder' => 'Dibatalkan'
            );
            $cek = $this->Mfrontend->update('tbl_order', $status, 'idorder=' . $idorder);
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
            Pemabayaran Dibatalkan!
          </div>');
            redirect('transaksi/konfirmasi/' . $idtoko);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Gagal melakukan  konfirmasi!
            </div>');
            redirect('transaksi/konfirmasi/' . $idtoko);
        }
    }

    public function kirimnoresi()
    {
        $idtoko = $this->input->post('idtoko');
        $idorder = $this->input->post('idorder');
        $noresi = $this->input->post('noresi');
        $validasi = array(
            'statusorder' => 'Dikirim',
            'noresi' => $noresi
        );
        $cek = $this->Mfrontend->update('tbl_order', $validasi, 'idorder=' . $idorder);

        if ($this->db->affected_rows($cek) >= 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
            No Resi Telah Diterbitkan!
          </div>');
            redirect('transaksi/konfirmasi/' . $idtoko);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            No Resi Gagal Diterbitkan!
            </div>');
            redirect('transaksi/konfirmasi/' . $idtoko);
        }
    }
    public function terima_barang($idorder)
    {
        $validasi = array(
            'statusorder' => 'Diterima',
        );
        $cek = $this->Mfrontend->update('tbl_order', $validasi, 'idorder=' . $idorder);
        if ($this->db->affected_rows($cek) >= 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
            Barang telah diterima!, 
            Terima Kasih!
          </div>');
            redirect('transaksi/order');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Gagal konfirmasi barang!
            </div>');
            redirect('transaksi/order');
        }
    }
    public function selesai($idorder)
    {
        $validasi = array(
            'statusorder' => 'Selesai',
        );
        $cek = $this->Mfrontend->update('tbl_order', $validasi, 'idorder=' . $idorder);
        if ($this->db->affected_rows($cek) >= 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
            Transaksi Invoice #' . $idorder . ' telah selesai!
          </div>');
            redirect('transaksi/riwayat_pembelian');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Gagal konfirmasi barang!
            </div>');
            redirect('transaksi/order');
        }
    }

    //fitur report
    public function report()
    {
        $idproduk = $this->input->post('produkreport');
        $jenisreport = $this->input->post('jenisreport');
        $idtoko = $this->input->post('idtoko');
        $catatan = $this->input->post('catatan');
        $idorder = $this->input->post('idorder');



        $cekdata = $this->Mfrontend->query("SELECT idproduk
        FROM tbl_report
        WHERE EXISTS
        (SELECT idproduk FROM tbl_report WHERE idproduk=" . $idproduk . " AND idorder=" . $idorder . ")")->row_array();

        if ($cekdata == null) {
            $data = array(
                'idreport' => '',
                'idorder' => $idorder,
                'idtoko' => $idtoko,
                'idproduk' => $idproduk,
                'jenisreport' => $jenisreport,
                'komentar' => $catatan
            );
            $cek = $this->Mfrontend->insert('tbl_report', $data);
            if ($this->db->affected_rows($cek) >= 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
                Report anda telah dikirim!
              </div>');
                redirect('transaksi/order');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Gagal Mengirimkan Report! Coba lagi
              </div>');
                redirect('transaksi/order');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Anda sudah mengirimkan laporan terkait produk ini!
          </div>');
            redirect('transaksi/order');
        }
    }
    //laporan pembelian dan penjualan

    public function riwayat_pembelian()
    {
        $id = $this->session->userdata['idkonsumen'];
        $data['order'] = $this->Mfrontend->query("SELECT DISTINCT idorder,namakonsumen,statusorder,noresi,idtoko, DATE_FORMAT(tglorder, '%W %e %M %Y')AS'tanggal' FROM `tbl_member` p JOIN tbl_order USING (idkonsumen) LEFT JOIN tbl_detail_order USING(idorder) WHERE p.idkonsumen= " . $id . " AND (statusorder = 'Selesai' OR statusorder = 'Dibatalkan' OR statusorder = 'Reviewed')")->result();

        $this->template->load('layout_members', 'world/client/riwayat_transaksi_pembelian', $data);
    }
    public function laporan_toko($idtoko)
    {
        $data['order'] = $this->Mfrontend->query("SELECT DISTINCT idorder,namakonsumen,statusorder,idtoko,DATE_FORMAT(tglorder, '%W %e %M %Y')AS'tanggal' FROM `tbl_member` p JOIN tbl_order USING (idkonsumen) LEFT JOIN tbl_detail_order USING(idorder)  JOIN tbl_toko USING (idtoko) WHERE idtoko= " . $idtoko . " AND (statusorder = 'Selesai' OR statusorder = 'Dibatalkan' OR statusorder = 'Reviewed')")->result();

        $data['toko'] = $this->Mfrontend->get_by_id('tbl_toko', 'idtoko =' . $idtoko)->row_object();
        $data['produk'] = $this->Mfrontend->get_all_data_2_table('tbl_produk', 'tbl_kategori', 'idkategori', 'idtoko = ' . $idtoko)->result();

        $this->template->load('layout_members', 'world/client/laporan_toko', $data);
    }
}
