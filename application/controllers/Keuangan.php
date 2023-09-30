<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keuangan extends CI_Controller {
    function __construct()
    {
		parent::__construct();
		$this->load->model('m_model');
		$this->load->helper('my_helper');
         if ($this->session->userdata('logged_in') != true && $this->session->userdata('role') != 'keuangan') 
            redirect(base_url() . 'login');
	}
	public function index()
	{
		
		$this->load->view('keuangan/index');
	}
    public function pembayaran() 
    { 
        $data['siswa'] = $this->m_model->get_data('siswa')->result(); 
        $data['pembayaran'] = $this->m_model->get_data('pembayaran')->result(); 
        $this->load->view('keuangan/pembayaran', $data); 
    }
    public function tambah_pembayaran()
	{

		
		$data['siswa'] = $this->m_model->get_data('siswa')->result();
		$data['pembayaran'] = $this->m_model->get_data('pembayaran')->result();
		$this->load->view('keuangan/tambah_pembayaran', $data);
	}
	// aksi tambah pembayaran
    public function aksi_tambah_pembayaran()
	{
		$data = [
			'id_siswa' => $this->input->post('id_siswa'),
			'jenis_pembayaran' => $this->input->post('jenis_pembayaran'),
			'total_pembayaran' => $this->input->post('total_pembayaran'),
		];

		$this->m_model->tambah_data('pembayaran', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
		Data Berhasil Ditambahkan
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	
	  </div>');
		redirect(base_url('keuangan/pembayaran'));
	}
    public function update_pembayaran($id)
    {
        $data['siswa'] = $this->m_model->get_data('siswa')->result();
        $data['pembayaran'] = $this->m_model->get_by_id('pembayaran', 'id_siswa', $id)->result();
        $this->load->view('keuangan/update_pembayaran', $data);
    }

    // untuk aksi ubah bayar
    public function aksi_update_pembayaran()
    {
        $data = array (
                'id_siswa'         => $this->input->post('nama'),
                'jenis_pembayaran' => $this->input->post('jenis_pembayaran'),
                'total_pembayaran' => $this->input->post('total_pembayaran'),
        );
        $eksekusi=$this->m_model->ubah_data
        ('pembayaran', $data, array('id'=>$this->input->post('id')));
        if ($eksekusi)
        {
            $this->session->set_flashdata('sukses','berhasil');
            redirect(base_url('keuangan/pembayaran'));
        } else {
            $this->session->set_flashdata('error','gagal');
            redirect(base_url('keuangan/pembayaran/'.$this->input->post('id')));
        }
    }
	public function hapus_data($id)
    {
        $this->m_model->delete('pembayaran', 'id', $id);
        redirect(base_url('Keuangan/pembayaran'));
    }
}
?>