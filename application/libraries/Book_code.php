<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book_code {

    protected $CI;

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->database();
    }

    public function generate_code() {
        $query = $this->CI->db->query("SELECT MAX(kode_buku) as max_id FROM tbl_buku");
        $row = $query->row();
        $max_id = $row->max_id;
    
        if (!$max_id) {
            return 'BP01'; // Jika tidak ada kode buku, mulai dari BP01
        }
    
        // Mendapatkan nomor dari kode buku terakhir
        $last_code_number = intval(substr($max_id, 2)); // Mengambil angka dari indeks 2 ke depan
    
        // Membuat kode buku berikutnya
        $new_code_number = $last_code_number + 1;
        $new_code = 'BP' . sprintf('%02d', $new_code_number); // Menggunakan sprintf untuk format nomor dengan leading zero
    
        return $new_code;
    }
    
}
