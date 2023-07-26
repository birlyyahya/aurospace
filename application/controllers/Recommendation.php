<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Recommendation extends CI_Controller
{

    public function index()
    {

        $data = [];
        if ($this->input->post()) {
            $key = $this->input->post('key');
            $data['buku'] = $this->search_result($key);
            $this->load->view('page', $data);
        } else {

            $this->load->view('page', $data);
        }
    }

    # Menampilkan detail buku dan rekomendasinya (item yg mirip)
    public function detail($id)
    {
        var_dump($id);
        die;
        $this->load->model('data');
        $data['item'] = $this->data->getDetailBuku($id);
        $data['top_n'] = $this->top_n($id, 7);

        $this->load->view('page', $data);
    }

    # parameter t = threshold, dimana jika score kurang dari t tidak ditampilkan
    private function search_result($key, $t = 1)
    {

        $this->load->model('Mfrontend');
        $data = $this->Mfrontend->get_all_data('tbl_produk')->result_array;

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
        $key = $this->pre_process($key);
        $rec = $cbrs->search($key);

        # Generate top-n search result
        $top = [];
        $i = 0;
        foreach ($rec as $k => $r) {
            if ($r < $t)
                continue;

            $top[$i]['id'] = $k;
            $top[$i]['score'] = $r;
            $top[$i]['title'] = $this->data->getDetailBuku($k)['namaproduk'];
            $i++;
        }
        var_dump($top);
        die;
        return $top;
    }

    private function top_n($id, $n = 5)
    {
        $this->load->model('data');
        $data = $this->data->getBuku();

        # Membuat array produk id dan deskripsi
        $df = [];
        foreach ($data as $k => $v) {
            $df[$v['idProduk']] = $v['deskripsiProduk'];
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
        $key = $this->data->getDetailBuku($id);
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
            $top[$i]['title'] = $this->data->getDetailBuku($k)['namaproduk'];
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
}
