<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Denda extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('msiswa');
    }

    public function index()
    {
        if (!$this->session->userdata('session_siswa') || empty($this->session->userdata('session_siswa')['id_siswa'])) {
            redirect('siswapanel');
        }

        $id_siswa = $this->session->userdata('session_siswa')['id_siswa'];
        $data['user'] = $this->db->get_where('tbl_siswa', ['id_siswa' => $id_siswa])->row_array();

        $data['denda'] = $this->msiswa->get_denda($id_siswa);
        $data['total_denda'] = $this->msiswa->hitung_denda($id_siswa);
        $data['total_bayar'] = $this->msiswa->hitung_denda($id_siswa);
        $data['pembayaran'] = $this->msiswa->hitung_pembayaran($id_siswa);
        // var_dump($data['total_denda']);
        // die;

        $data['title'] = 'Daftar Denda';
        $this->load->view('siswa/layout/header', $data);
        $this->load->view('siswa/layout/sidebar');
        $this->load->view('siswa/denda/daftar_denda', $data);
        $this->load->view('siswa/layout/footer');
    }
}
