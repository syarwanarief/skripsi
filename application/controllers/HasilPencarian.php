<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class HasilPencarian extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url', 'simple_html_dom');
        $this->load->library('session');
        $this->load->model('Query');
    }

    public function index()
    {
        $data['garuda'] = $this->Query->getAllData('tampunggaruda')->result();
        $data['tekno'] = $this->Query->getAllData('tampungtekno')->result();
        $data['website'] = array("Portal Garuda", "Portal TeknoInfo", "Portal");

        $this->load->view('Template');
        $this->load->view('ViewHasilPencarian', $data);
    }

    public function scraping()
    {
        if ($this->input->post('submitCari')) {
            $inputan = $this->input->post('Cari');

            if (!$sock = @fsockopen('www.google.com', 80, $errorNum, $errorMessage)) {
                $this->load->view('Template');
                $this->load->view('NoInternet');
            } else {

                if ($inputan != "") {

                    $pattern = '/ /';
                    $replace = '%20';

                    $inputanR = preg_replace($pattern, $replace, $inputan);

                    $htmlgaruda = new Simple_html_dom();
                    $htmlgaruda = file_get_html("http://garuda.ristekdikti.go.id/documents?q=" . $inputanR);

                    //ambil judul
                    $judulGaruda = array();
                    $abstractGaruda = array();
                    $penulisGaruda = array();
                    $penerbitGaruda = array();
                    $linkGaruda = array();
                    $sumberGaruda = "Portal Garuda";

                    foreach ($htmlgaruda->find("a[class=title-article]") as $a) {
                        $judulGaruda[] = $a->plaintext;
                        $abstractGaruda[] = $a->href;
                    }

                    //PENULIS
                    foreach ($htmlgaruda->find("p[class=author-article]") as $b) {
                        $penulis = $b->plaintext;
                        $penulisGaruda[] = $penulis;
                    }

                    //penerbit
                    foreach ($htmlgaruda->find("p[class=subtitle-article]") as $c) {
                        $penerbit = $c->plaintext;
                        $penerbitGaruda[] = $penerbit;
                    }

                    //LINK
                    foreach ($htmlgaruda->find("p[class=action-article]") as $d) {
                        $links = $d->find('a');
                        foreach ($links as $link) {
                            if ($links != '') {
                                $tampilLink = $link->href;
                                $linkGaruda[] = $tampilLink;
                            }
                        }
                    }
                    foreach ($judulGaruda as $key => $value) {
                        $this->Query->inputData(array(
                            'judul' => $judulGaruda[$key],
                            'abstract' => "http://garuda.ristekdikti.go.id" . $abstractGaruda[$key],
                            'penulis' => $penulisGaruda[$key],
                            'penerbit' => $penerbitGaruda[$key],
                            'sumber' => $sumberGaruda,
                            'link' => $linkGaruda[$key],
                        ),
                            'tampunggaruda'
                        );
                    }

                    $opts = array('http' => array('header' => "User-Agent:MyAgent/1.0\r\n"));
                    $context = stream_context_create($opts);

                    $htmltekno = new Simple_html_dom();
                    $htmltekno = file_get_html("https://ejurnal.teknokrat.ac.id/index.php/teknoinfo/search/search?query=" . $inputanR);

                    $judultekno = array();
                    $abstractTekno = array();
                    $penulistekno = array();
                    $penerbittekno = array();
                    $linktekno = array();

                    //judul
                    $scrapingTekno = $htmltekno->find("table.listing");

                    foreach ($scrapingTekno as $key => $table) {

                        $fltr = "No Results";
                        $fltrkata = $table->find("td", 4)->plaintext;

                        if (preg_match("/{$fltr}/i", $fltrkata)) {
                            echo "<br><br><b><center>MAAF :( <BR>ARTIKEL JURNAL PADA TEKNO INFO TIDAK DITEMUKAN OLEH SISTEM</center></b><br><br>";
                        } else {
                            $judultekno = $table->find("td", 5)->plaintext;
                        }
                    }

                    //penulis
                    foreach ($htmltekno->find("table.listing ") as $key => $table) {
                        $fltr = "No Results";
                        $fltrkata = $table->find("td", 4)->plaintext;

                        if (preg_match("/{$fltr}/i", $fltrkata)) {

                        } else {
                            $penulistekno = $table->find("td", 7)->plaintext;

                        }
                    }

                    //penerbit
                    foreach ($htmltekno->find("table.listing ") as $key => $table) {

                        $fltr = "No Results";
                        $fltrkata = $table->find("td", 4)->plaintext;

                        if (preg_match("/{$fltr}/i", $fltrkata)) {

                        } else {
                            $penerbittekno = $table->find("td", 4)->plaintext;
                        }
                    }

                    //link
                    foreach ($htmltekno->find("table.listing ") as $key => $table) {
                        $fltr = "No Results";
                        $fltrkata = $table->find("td", 4)->plaintext;

                        if (preg_match("/{$fltr}/i", $fltrkata)) {

                        } else {
                            $td = $table->find("td", 6);
                            if ($td != '') {
                                $absTekno = $td->find("a", 1);
                                if ($absTekno != '') {
                                    $abstractTekno = $absTekno->href;
                                }
                                $link = $td->find("a", 1);
                                if ($link != '') {
                                    $linktekno = $link->href;
                                }
                            }
                        }
                    }
                    if (is_array($judultekno)) {
                        foreach ($judultekno as $key1 => $value) {
                            $this->Query->inputData(array(
                                'judul' => $judultekno[$key1],
                                'abstract' => $abstractTekno[$key1],
                                'penulis' => $penulistekno[$key1],
                                'penerbit' => $penerbittekno[$key1],
                                'sumber' => "Tekno Info",
                                'link' => $linktekno[$key1],
                            ),
                                'tampungtekno'
                            );
                        }
                    } else {
                        $this->Query->inputData(array(
                            'judul' => $judultekno,
                            'abstract' => $abstractTekno,
                            'penulis' => $penulistekno,
                            'penerbit' => $penerbittekno,
                            'sumber' => "Tekno Info",
                            'link' => $linktekno,
                        ),
                            'tampungtekno'
                        );
                    }


                    $htmlIJ = new Simple_html_dom();
                    $htmlIJ = file_get_html("http://ejournal.upi.edu/index.php/ijost/search/search?query=" . $inputanR);

                    $judulIJ = "";
                    $abstractIJ = array();
                    $penulisIJ = "";
                    $penerbitIJ = "";
                    $linkIJ = "";

                    //judul
                    $scrapingIJ = $htmlIJ->find("table.listing");

                    foreach ($scrapingIJ as $key => $tableIJ) {

                        $fltr = "No Results";
                        $fltrkata = $tableIJ->find("td", 4)->plaintext;

                        if (preg_match("/{$fltr}/i", $fltrkata)) {

                        } else {
                            $judulIJ = $tableIJ->find("td", 5)->plaintext;
                        }
                    }

                    //penulis
                    foreach ($htmlIJ->find("table.listing ") as $key => $tableIJ) {
                        $fltr = "No Results";
                        $fltrkata = $tableIJ->find("td", 4)->plaintext;

                        if (preg_match("/{$fltr}/i", $fltrkata)) {

                        } else {
                            $penulisIJ = $tableIJ->find("td", 7)->plaintext;

                        }
                    }

                    //penerbit
                    foreach ($htmlIJ->find("table.listing ") as $key => $tableIJ) {

                        $fltr = "No Results";
                        $fltrkata = $tableIJ->find("td", 4)->plaintext;

                        if (preg_match("/{$fltr}/i", $fltrkata)) {

                        } else {

                            $penerbitIJ = $tableIJ->find("td", 4)->plaintext;

                        }
                    }

                    //link
                    foreach ($htmlIJ->find("table.listing ") as $key => $tableIJ) {
                        $fltr = "No Results";
                        $fltrkata = $tableIJ->find("td", 4)->plaintext;

                        if (preg_match("/{$fltr}/i", $fltrkata)) {

                        } else {
                            $tdIJ = $tableIJ->find("td", 6);
                            if ($tdIJ != '') {
                                $absIJ = $tdIJ->find("a", 0);
                                if ($absIJ != '') {
                                    $abstractIJ = $absIJ->href;
                                }
                                $link_IJ = $tdIJ->find("a", 1);
                                if ($link_IJ != '') {
                                    $linkIJ = $link_IJ->href;
                                }
                            }
                        }
                    }


                    $this->Query->inputData(array(
                        'judul' => $judulIJ,
                        'abstract' => $abstractIJ,
                        'penulis' => $penulisIJ,
                        'penerbit' => $penerbitIJ,
                        'sumber' => "Indonesian Journal of Science and Technology",
                        'link' => $linkIJ,
                    ),
                        'tampung_ij'
                    );
                }

                if ($judultekno == "" && $judulGaruda == "") {
                    echo "<br><br><b><center><marquee>MAAF :( <BR>ARTIKEL JURNAL YANG ANDA CARI TIDAK DITEMUKAN OLEH SISTEM</marquee></center></b><br><br>";
                } elseif ($judultekno == "") {
                    echo "<br><br><b><center>MAAF :( <BR>ARTIKEL JURNAL PADA TEKNO INFO TIDAK DITEMUKAN OLEH SISTEM</center></b><br><br>";
                } elseif ($judulGaruda == "") {
                    echo "<br><br><b><center>MAAF :( <BR>ARTIKEL JURNAL PADA PORTAL GARUDA TIDAK DITEMUKAN OLEH SISTEM</center></b><br><br>";
                }
            }
        }
            $data['garuda'] = $this->Query->getAllData('tampunggaruda')->result();
            $data['tekno'] = $this->Query->getAllData('tampungtekno')->result();
            $data['sd'] = $this->Query->getAllData('tampung_ij')->result();
            $data['website'] = array("Portal Garuda", "Portal TeknoInfo", "Portal IJoST");

            $this->load->view('Template');
            $this->load->view('ViewHasilPencarian', $data);
        }
    }