<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

    public function index(){
        $kk = "logika Semantik";
        $d[0] = "Program loGika dan Semantik";
        $d[1] = "Keilmuan individu";
        $d[2] = "Pada program ilmu terdapat transfer ilmu semantik";

        print '<h2>Sebelum Pre-processing</h1>';
        print "Kata kunci: ".$kk."<br />";
        print "<pre>";
        print_r($d);
        print "</pre>";

        print '<h2>Setelah Pre-processing</h1>';
        $kk = $this->pre_process($kk);
        foreach($d as $doc){
            $d1[] = $this->pre_process($doc);
        }

        print "Kata kunci: ".$kk."<br />";
        print "<pre>";
        print_r($d1);
        print "</pre>";

        $this->load->library('ContentBasedRS');
        $cbrs = new ContentBasedRS();

        echo "<h3>Create Index</h3>";
		$cbrs->create_index($d1);
		$cbrs->show_index();

        echo "<h3>TFIDF Terms</h3>";
        print "<pre>";
        print_r($cbrs->idf());
        print "</pre>";

        echo "<h3>Document Weight</h3>";
        print "<pre>";
        print_r($cbrs->tfidf($d1));
        print "</pre>";

        echo "<h3>Searching</h3>";
        print "<pre>";
        print_r($cbrs->search($kk));
        print "</pre>";
    }

    private function pre_process($str){
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