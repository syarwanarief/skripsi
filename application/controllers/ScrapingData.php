<?php


class ScrapingData extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url', 'simple_html_dom');
        $this->load->library('session');
        $this->load->model('Query');
    }

    function index()
    {

        $inputan = $this->input->post('Cari');

        $htmlgaruda = new simple_html_dom();
        $htmlgaruda = file_get_html("http://garuda.ristekdikti.go.id/documents?q=" . $inputan);

        //ambil judul
        $judultekno = "";
        $penulistekno = "";
        $penerbittekno = "";
        $linktekno = "";
        $sumber = "Portal Garuda";

        foreach ($htmlgaruda->find("a[class=title-article]") as $a) {
            $judul = $a->plaintext;
            //insert data
            $judultekno = array($judul);
        }

        //PENULIS
        foreach ($htmlgaruda->find("p[class=author-article]") as $key => $b) {
            $penulis = $b->plaintext;
            $penulistekno = array($penulis);
        }

        //penerbit
        foreach ($htmlgaruda->find("p[class=subtitle-article]") as $key => $c) {
            $penerbit = $c->plaintext;
            $penerbittekno = array($penerbit);
        }

        //LINK
        foreach ($htmlgaruda->find("p[class=action-article]") as $key => $d) {
            $links = $d->find('a');
            foreach ($links as $link) {
                if ($links != '') {
                    $tampilLink = $link->href;
                    $linktekno = array($tampilLink);
                }
            }
        }

        $getLink = $a->href;
        $htmlgaruda = file_get_html("http://garuda.ristekdikti.go.id".$getLink);
        foreach ($htmlgaruda->find("div[class=twelve wide column]") as $key => $abb) {
            $abstractTekno = array($abb->plaintext);
        }
        $this->Query->inputData(array(
            'judul' => $judultekno,
            'penulis' => $penulistekno,
            'penerbit' => $penerbittekno,
            'sumber' => $sumber++,
            'link' => $linktekno,
        ),
            'tampunggaruda'
        );
        $this->load->library('../controllers/HasilPencarian');
    }
}