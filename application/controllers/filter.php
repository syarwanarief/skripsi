<?php


class filter extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url', 'Simple_html_dom');
        $this->load->model('Query');
    }

    public function index()
    {
        $pilih = $this->input->post('kat');

        if ($pilih == "Portal Garuda") {
            $data['garuda'] = $this->Query->getAllData('tampunggaruda')->result();
            $data['website'] = array("Tampilkan Semua", "Portal Garuda", "Portal TeknoInfo", "Portal IJoST");

            if ($data['garuda'] != "") {
                $this->load->view('Template');
                $this->load->view('ViewGaruda', $data);
            } else {
                $this->load->view('Template');
                $this->load->view('ViewNotFound', $data);
            }

        } elseif ($pilih == "Portal TeknoInfo") {
            $data['tekno'] = $this->Query->getAllData('tampungtekno')->result();
            $data['website'] = array("Tampilkan Semua", "Portal Garuda", "Portal TeknoInfo", "Portal IJoST");

            if ($data['tekno'] != null) {
                $this->load->view('Template');
                $this->load->view('ViewTekno', $data);
            } else {
                $this->load->view('Template');
                $this->load->view('ViewNotFound', $data);
            }
        } elseif ($pilih == "Portal IJoST") {
            $data['ijost'] = $this->Query->getAllData('tampung_ij')->result();
            $data['website'] = array("Tampilkan Semua", "Portal Garuda", "Portal TeknoInfo", "Portal IJoST");

            if ($data['ijost'] != null) {
                $this->load->view('Template');
                $this->load->view('ViewIJoST', $data);
            } else {
                $this->load->view('Template');
                $this->load->view('ViewNotFound', $data);
            }
        } elseif ($pilih == "Tampilkan Semua") {
            $data['garuda'] = $this->Query->getAllData('tampunggaruda')->result();
            $data['tekno'] = $this->Query->getAllData('tampungtekno')->result();
            $data['sd'] = $this->Query->getAllData('tampung_ij')->result();
            $data['website'] = array("Portal Garuda", "Portal TeknoInfo", "Portal IJoST");

            $this->load->view('Template');
            $this->load->view('ViewHasilPencarian', $data);
        }
    }
}