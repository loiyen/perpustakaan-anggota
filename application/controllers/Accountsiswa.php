<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Accountsiswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('msiswa');
        $this->load->model('madmin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if (!$this->session->userdata('session_siswa') || empty($this->session->userdata('session_siswa')['id_siswa'])) {
            redirect('siswapanel');
        }

        $id_siswa = $this->session->userdata('session_siswa')['id_siswa'];
        $data['user'] = $this->db->get_where('tbl_siswa', ['id_siswa' => $id_siswa])->row_array();


        $data['title'] = 'Akun Siswa';
        $this->load->view('siswa/layout/header', $data);
        $this->load->view('siswa/layout/sidebar');
        $this->load->view('siswa/akun/akun_siswa', $data);
        $this->load->view('siswa/layout/footer');
    }

    // public function tambah_foto()
    // {
    //     if (!$this->session->userdata('session_siswa') || empty($this->session->userdata('session_siswa')['id_siswa'])) {
    //         redirect('siswapanel');
    //     }

    //     $id_siswa = $this->session->userdata('session_siswa')['id_siswa'];
    //     $data['user'] = $this->db->get_where('tbl_siswa', ['id_siswa' => $id_siswa])->row_array();
    //     $data['validation_error'] = validation_errors();
    //     $data['title'] = 'Akun Siswa';
    //     $this->load->view('siswa/layout/header', $data);
    //     $this->load->view('siswa/layout/sidebar');
    //     $this->load->view('siswa/akun/akun_siswa', $data);
    //     $this->load->view('siswa/layout/footer');

    //     $id = $this->input->post('id_siswa');

    //     $data['siswa'] = $this->madmin->get_by_id('tbl_siswa', array('id_siswa' => $id))->row();
    //     $gambar = $data['siswa']->foto_siswa;

    //     if (!empty($_FILES['gambar']['name'])) {

    //         $config['upload_path'] = './asset/profilsiswa/';
    //         $config['allowed_types'] = 'jpg|jpeg|png';
    //         $config['max_size'] = 5192;


    //         $this->load->library('upload', $config);

    //         if (!$this->upload->do_upload('gambar')) {

    //             $error = $this->upload->display_errors();

    //             $this->session->set_flashdata('not', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    //             <strong>Gagal!</strong> ' . $error . '
    //             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //             </div>');
    //             redirect('accountsiswa');
    //         }

    //         $gambar = uploadFiles3New('siswa', 'gambar');
    //     }

    //     $this->db->set('foto_siswa', $gambar);
    //     $this->db->set('datecreated', date('Y-m-d H:i:s'));
    //     $this->db->where('id_siswa', $id);
    //     $this->db->update('tbl_siswa');

    //     $this->session->set_flashdata('success', 'Foto Profil Berhasil ditambahkan');
    //     redirect('accountsiswa'); // Redirect to prevent resubmission
    // }

    public function tambah_foto()
    {
        // Check if session exists for the user, if not, redirect to login page
        if (!$this->session->userdata('session_siswa') || empty($this->session->userdata('session_siswa')['id_siswa'])) {
            redirect('siswapanel');
        }

        // Load session data
        $id_siswa = $this->session->userdata('session_siswa')['id_siswa'];
        $data['user'] = $this->db->get_where('tbl_siswa', ['id_siswa' => $id_siswa])->row_array();
        $data['title'] = 'Akun Siswa';

        // Load the views
        $this->load->view('siswa/layout/header', $data);
        $this->load->view('siswa/layout/sidebar');
        $this->load->view('siswa/akun/akun_siswa', $data);
        $this->load->view('siswa/layout/footer');

        // Check if form is submitted
        if ($this->input->post()) {
            $id = $this->input->post('id_siswa');
            $data['siswa'] = $this->madmin->get_by_id('tbl_siswa', array('id_siswa' => $id))->row();
            $gambar = $data['siswa']->foto_siswa;

            // Handle file upload
            if (!empty($_FILES['gambar']['name'])) {
                $config['upload_path'] = './asset/profilsiswa/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 5120; // 5MB max file size
                $this->load->library('upload', $config);

                // Check for upload errors
                if (!$this->upload->do_upload('gambar')) {
                    $error = $this->upload->display_errors('', '');
                    $this->session->set_flashdata('not', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Gagal!</strong> ' . $error . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>');
                    redirect('accountsiswa');
                } else {
                    // If upload successful, store the uploaded file name
                    $gambar = uploadFiles3New('buku', 'gambar');
                }
            }

            // Update database with new image and timestamp
            $this->db->set('foto_siswa', $gambar);
            $this->db->set('datecreated', date('Y-m-d H:i:s'));
            $this->db->where('id_siswa', $id);
            $this->db->update('tbl_siswa');

            // Success notification
            $this->session->set_flashdata('success', 'Foto Profil Berhasil ditambahkan');
            redirect('accountsiswa'); // Redirect to avoid resubmission
        }
    }



    public function tambah_password()
    {
        // $this->form_validation->set_rules('password', 'Password', 'trim|required', array(
        //     'required' => 'Masukkan Password Anda'
        // ));

        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|trim|min_length[7]'
        );

        if ($this->form_validation->run() === FALSE) {
            if (!$this->session->userdata('session_siswa') || empty($this->session->userdata('session_siswa')['id_siswa'])) {
                redirect('siswapanel');
            }

            $data['validation_errors'] = validation_errors();

            $id_siswa = $this->session->userdata('session_siswa')['id_siswa'];
            $data['user'] = $this->db->get_where('tbl_siswa', ['id_siswa' => $id_siswa])->row_array();


            $data['title'] = 'Akun Siswa';
            $this->load->view('siswa/layout/header', $data);
            $this->load->view('siswa/layout/sidebar');
            $this->load->view('siswa/akun/akun_siswa', $data);
            $this->load->view('siswa/layout/footer');
        } else {

            $id = $this->session->userdata('session_siswa')['id_siswa'];

            $dataupdate = array(
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            );

            $this->msiswa->update('tbl_siswa', $dataupdate, 'id_siswa', $id);
            $this->session->set_flashdata('success', 'Password Berhasil Ditambahkan');
            redirect('accountsiswa');
        }
    }

    public function ubah_password()
    {

        $this->form_validation->set_rules('password', 'Password', 'required|trim', array(
            'required' => 'Password tidak boleh kosong'
        ));
        $this->form_validation->set_rules(
            'password_baru',
            'Password Baru',
            'required|trim|min_length[7]|matches[konfirmasi]'
        );
        $this->form_validation->set_rules(
            'konfirmasi',
            'Konfirmasi',
            'required|trim|min_length[7]|matches[password_baru]'
        );

        if ($this->form_validation->run() == false) {
            if (!$this->session->userdata('session_siswa') || empty($this->session->userdata('session_siswa')['id_siswa'])) {
                redirect('siswapanel');
            }
            $id_siswa = $this->session->userdata('session_siswa')['id_siswa'];
            $data['user'] = $this->db->get_where('tbl_siswa', ['id_siswa' => $id_siswa])->row_array();

            $data['validation_errors'] = validation_errors();

            $data['title'] = 'Akun Siswa';
            $this->load->view('siswa/layout/header', $data);
            $this->load->view('siswa/layout/sidebar');
            $this->load->view('siswa/akun/akun_siswa', $data);
            $this->load->view('siswa/layout/footer');
        } else {

            $password  = $this->input->post('password');
            $password_baru  = $this->input->post('password_baru');

            $id = $this->session->userdata('session_siswa')['id_siswa'];
            $data['user'] = $this->db->get_where('tbl_siswa', ['id_siswa' => $id])->row_array();

            if (!password_verify($password, $data['user']['password'])) {

                $this->session->set_flashdata('not', '<div class="alert alert-danger" role="alert">
					Password Tidak Sama.
				</div>');
                redirect('accountsiswa/ubah_password');
            } elseif ($password == $password_baru || empty($password_baru)) {
                $this->session->set_flashdata('not', '<div class="alert alert-danger" role="alert">
					Password baru dan lama tidak boleh sama atau kosong.
				</div>');
                redirect('accountsiswa/ubah_password');
            } else {
                // Password oke, lanjutkan dengan pembaruan
                $password_baru_hashed = $this->madmin->hash_string($password_baru);
                // Update password
                $dataUpdate = array('password' => $password_baru_hashed);
                $this->msiswa->update('tbl_siswa', $dataUpdate, 'id_siswa', $id);

                $this->session->set_flashdata('success', 'Password Berhasil diubah');
                redirect('accountsiswa');
            }
        }
    }
    public function barcode($code)
    {

        $this->load->library('Zend');
        $this->zend->load('Zend/Barcode');

        Zend_Barcode::render('code128', 'image', array('text' => $code));
    }
    public function cetak_kartu()
    {

        if (!$this->session->userdata('session_siswa') || empty($this->session->userdata('session_siswa')['id_siswa'])) {
            redirect('siswapanel');
        }

        $id_siswa = $this->session->userdata('session_siswa')['id_siswa'];
        $data['data_siswa'] = $this->db->get_where('tbl_siswa', ['id_siswa' => $id_siswa])->row_array();

        $this->load->view('siswa/akun/cetak_kartu', $data);
    }
}
