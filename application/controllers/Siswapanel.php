<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswapanel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('msiswa');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->view('siswa/login');
    }

    public function login()
    {


        $this->form_validation->set_rules('username', 'Username', 'required', array(
            'required' => 'Isikan username anda'
        ));
        $this->form_validation->set_rules('password', 'Password', 'required', array(
            'required' => 'Isikan password anda'
        ));

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('siswa/login');
        } else {

            $u = $this->input->post('username');
            $p = $this->input->post('password');

            $user = $this->msiswa->check_login($u, $p);

            if ($user) {
                $data_session = array(
                    'id_siswa' => $user['id_siswa'],
                    'nama_siswa' => $user['nama_siswa'],
                    'kode_akses' => $user['kode_akses']
                );

                $this->session->set_userdata('session_siswa', $data_session);

                $this->session->set_flashdata('success', 'Selamat Datang didashboar Siswa');
                redirect('dashboardsiswa');
            } else {
                $this->session->set_flashdata('error', 'Kode Akses tidak valid.');
                redirect('siswapanel/kode_akses');
            }
        }
    }


    public function kode_akses()
    {
        $this->load->view('siswa/kode_akses');
    }

    public function process()
    {

        $this->form_validation->set_rules('kode_akses', 'Kode Akses', 'trim|required', array(
            'required' => 'Masukkan Kode Akses Anda'
        ));

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('siswa/kode_akses');
        } else {
            $kode = $this->input->post('kode_akses');
            $user = $this->msiswa->check_kode($kode);


            if ($user) {
                $user_data = $user[0]; // Mengambil objek pertama dari array

                $data_session = array(
                    'id_siswa' => $user_data->id_siswa,
                    'nama_siswa' => $user_data->nama_siswa,
                    'kode_akses' => $user_data->kode_akses
                );

                $this->session->set_userdata('session_siswa', $data_session);
            
                $this->session->set_flashdata('success', 'Selamat Datang diDashboar Siswa');
                redirect('dashboardsiswa');
            } else {
                $this->session->set_flashdata('error', 'Kode Akses tidak valid.');
                redirect('siswapanel/kode_akses');
            }
        }
    }
}
