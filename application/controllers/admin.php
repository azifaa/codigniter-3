<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_model');
        $this->load->helper('my_helper');
        $this->load->library('upload');
        if ($this->session->userdata('logged_in') != true) {
            redirect(base_url() . 'login');
        }
    }

    public function index()
    {
        $data['siswa'] = $this->m_model->get_data('siswa')->num_rows();
        $data['mapel'] = $this->m_model->get_data('mapel')->num_rows();
        $data['kelas'] = $this->m_model->get_data('kelas')->num_rows();
        $data['guru'] = $this->m_model->get_data('guru')->num_rows();
        $this->load->view('admin/index', $data);
    }

    // upload image
    public function upload_image($value)
    {
        $kode = round(microtime(true) * 1000);
        $config['upload_path'] = './images/siswa/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '30000';
        $config['file_name'] = $kode;
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($value)){
            return array( false, '');
        } else {
            $fn = $this->upload->data();
            $nama = $fn['file_name'];
            return array( true, $nama );
        }
    }
    // siswa
    public function siswa()
    {
        $data['siswa'] = $this->m_model->get_data('siswa')->result();
        $this->load->view('admin/siswa', $data);
    }
    // account
    public function Account()
    {
       $data['user']=$this->m_model->get_by_id('admin', 'id', $this->session->userdata('id'))->result();
        $this->load->view('admin/account', $data);
    }
    // tambaH siswa
    public function tambah_siswa()
    {
        $data['kelas'] = $this->m_model->get_data('kelas')->result();
        $this->load->view('admin/tambah_siswa', $data);
    }
    // tambah account
    public function tambah_account()
    {
        $data['kelas'] = $this->m_model->get_data('kelas')->result();
        $this->load->view('admin/tambah_siswa',$data);
    }

    // aksi tambah siswa 
    public function aksi_tambah_siswa()
    {
        $foto = $this->upload_image('foto');
      if ($foto[0] == false) {
        $data = [
            'foto' => 'user.png',
            'nama_siswa' => $this->input->post('nama'),
            'nisn' => $this->input->post('nisn'),
            'gender' => $this->input->post('gender'),
            'id_kelas' => $this->input->post('id_kelas'),
        ];
        $this->m_model->tambah_data('siswa', $data);
        redirect(base_url('admin/siswa'));
      } else {
        $data = [
            'foto' => $foto[1],
            'nama_siswa' => $this->input->post('nama'),
            'nisn' => $this->input->post('nisn'),
            'gender' => $this->input->post('gender'),
            'id_kelas' => $this->input->post('id_kelas'),
        ];
        $this->m_model->tambah_data('siswa', $data);
        redirect(base_url('admin/siswa'));
      }
      
    }

    public function aksi_tambah_account()
    {
        $data = [
            'password_baru' => $this->input->post('password baru'),
            'konfirmasi_passowrd' => $this->input->post('konfirmasi_passowrd'),
        ];

        $this->m_model->tambah_data('account', $data);
        redirect(base_url('admin/account'));
    }
    // ubah siswa
    public function ubah_siswa($id)
    {
        $data['siswa']=$this->m_model->get_by_id('siswa', 'id_siswa', $id)->result();
        $data['kelas']=$this->m_model->get_data('kelas')->result();
        $this->load->view('admin/ubah_siswa', $data);
    }
    // ubah account
    public function ubah_account($id)
    {
        $data['siswa']=$this->m_model->get_by_id('siswa', 'id_siswa', $id)->result();
        $data['kelas']=$this->m_model->get_data('kelas')->result();
        $this->load->view('admin/ubah_siswa', $data);
    }
    //  aksi ubah siswa
    public function aksi_ubah_siswa()
    {
        $data = array (
            'nama_siswa' => $this->input->post('nama'),
            'nisn' => $this->input->post('nisn'),
            'gender' => $this->input->post('gender'),
            'id_kelas' => $this->input->post('id_kelas'),
        );
        $eksekusi=$this->m_model->ubah_data
        ('siswa', $data, array('id_siswa'=>$this->input->post('id_siswa')));
        if($eksekusi)
        {
            $this->session->set_flashdata('sukses', 'berhasil');
            redirect(base_url('admin/siswa'));
        }else
        {
            $this->session->set_flashdata('error', 'gagal..');
            redirect(base_url('admin/siswa/ubah_siswa/'.$this->input->post('id_siswa')));
        }
    }
    // aksi ubah account
    public function aksi_ubah_account()
    {
         $password_baru = $this->input('password_baru');
         $konfimasi_password = $this->input('konfimasi_password');
         $email = $this->input('email');
         $username = $this->input('username');
        //  
        $data = array (
            'email' => $email,
            'username' => username
        );
        
    //   jika ada password baru
    if (!empty($password_baru)) {
        // pastikan password baru dan konfirmaso password sama
        if ($password_baru === $konfimasi_password) {
            // hash password baru
            $data['password'] = md5($password_baru);
        } else {
            $this->session->set_flashdata('message', 'password baru dan konfirmasi password harus sama');
            redirect(base_url('admin/account'));
        }
    }
    // lakukan pembaruan data
    $this->session->set_userdata($data);
    $update_result = $this->m_model->ubah_data('admin', $data, array('id' => $this->session->userdata('id')));

      if  ($update_result) {
        redirect(base_url('admin/account'));
      } else {
        redirect(base_url('admin/account'));
      }
    // hapus siswa
    }
    public function hapus_siswa($id)
    {
        // model get siswa by id
         $siswa= $this->m_model->get_by_id('siswa', 'id_siswa', $id)->row();
         if ($siswa) {
            if ($siswa->foto !== 'User.pgn') {
                $file_path = './images/siswa/' .$siswa->foto;

                if (file_exists($file_path)) {
                    if (unlink($file_path)) {
                        // hapus file berhasil menggunakan model delete
                        $this->m_model->delete('siswa', 'id_siswa', $id);
                        redirect(base_url('admin/siswa'));                                                                                  
                    } else {
                    //   gagal menghapus file
                     echo "gagal mengahapus file.";
                    }
                } else {
                    // file tidak ditemukan 
                    echo "file tidak ditemukan.";
                }
            } else {
                // jangan hapus file 'user.pgn'
                $this->m_model->delete('siswa', 'id_siswa', $id);
                 redirect(base_url('admin/siswa'));
            }
         } else {
            // siswa tidak ditemukan
            echo "siswa tidak ditemukan.";
         }
    }
    public function hapus_account($id)
    {
        $this->m_model->delete('account', 'id_account', $id);
        redirect(base_url('admin/account'));
    }
}
?>