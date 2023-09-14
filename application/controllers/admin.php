<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_model');
        $this->load->helper('my_helper');
        if ($this->session->userdata('logged_in') != true) {
            redirect(base_url() . 'login');
        }
    }

    public function index()
    {

        $this->load->view('admin/index');
    }
    public function daftar_siswa()
    {

        $this->load->view('admin/daftar_siswa');
    }
}