<?php

use PhpParser\ErrorHandler\Throwing;
use PhpParser\Node\VarLikeIdentifier;

class msiswa extends CI_Model
{
    public function check_login($u, $p)
    {
        $this->db->select('id_siswa,nama_siswa,password');
        $this->db->from('tbl_siswa');
        $this->db->where('nama_siswa', $u);
        $query = $this->db->get();

        $user = $query->row_array();

        if ($user) {
            if (password_verify($p, $user['password'])) {
                return $user;
            } else {
                $this->session->set_flashdata('gagal', 'Verifikasi kata sandi gagal.');
                redirect('siswapanel');
            }
        } else {
            $this->session->set_flashdata('gagal', 'Nama siswa tidak ditemukan.');
            redirect('siswapanel');
        }
    }

    public function hash_string($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    public function verify_string($input, $hash)
    {
        return password_verify($input, $hash);
    }

    public function check_kode($kode)
    {
        $this->db->select('id_siswa,nama_siswa,kode_akses');
        $this->db->from('tbl_siswa');
        $this->db->where('kode_akses', $kode);
        $query = $this->db->get();
        return $query->result();
    }


    //dataquery
    public function insert($tabel, $data)
    {
        $this->db->insert($tabel, $data);
    }

    public function get_by_id($tabel, $id)
    {
        return $this->db->get_where($tabel, $id);
    }
    public function update($tabel, $data, $pk, $id)
    {
        $this->db->where($pk, $id);
        $this->db->update($tabel, $data);
    }
    public function delete($tabel, $id, $val)
    {
        $this->db->delete($tabel, array($id => $val));
    }
    ///

    //hirungdata
    public function hitung_jumlahpinjam($id)
    {
        $this->db->where('id_siswa', $id);
        return $this->db->count_all_results('tbl_peminjaman');
    }
    public function hitung_jumlahkembali($id)
    {
        $this->db->where('id_siswa', $id);
        return $this->db->count_all_results('tbl_pengambalian');
    }

    public function get_datasiswa($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_siswa');
        $this->db->where('tbl_siswa.id_siswa', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function cek_kembali_buku($id)
    {
        $this->db->select('tbl_pengambalian.*, tbl_siswa.*, tbl_pengembalianitems.*');
        $this->db->from('tbl_pengambalian');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_pengambalian.id_siswa');
        $this->db->join('tbl_pengembalianitems', 'tbl_pengembalianitems.id_pengembalian = tbl_pengambalian.id_pengembalian');
        $this->db->where('tbl_siswa.id_siswa', $id);
        $this->db->where_in('tbl_pengembalianitems.kondisi_buku', ['2', '3']);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_data_pencarian($kyword)
    {
        $this->db->select('*');
        $this->db->from('tbl_peminjaman');
        $this->db->where('tbl_peminjaman.kode_peminjaman', $kyword);
        $query = $this->db->get();
        return $query->row_array();
    }


    //peminjaman
    public function get_data_peminjaman($id, $limit, $offset)
    {
        $this->db->select('tbl_peminjaman.*,tbl_siswa.*,tbl_admin.*');
        $this->db->from('tbl_peminjaman');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_peminjaman.id_siswa');
        $this->db->join('tbl_admin', 'tbl_admin.id_admin = tbl_peminjaman.id_admin');
        $this->db->where('tbl_siswa.id_siswa', $id);
        $this->db->order_by('tbl_peminjaman.date_pinjam', 'desc');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_detail_peminjaman($id)
    {

        $this->db->select('tbl_peminjaman.*,tbl_admin.nama_admin');
        $this->db->from('tbl_peminjaman');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_peminjaman.id_siswa');
        $this->db->join('tbl_admin', 'tbl_admin.id_admin = tbl_peminjaman.id_admin');
        $this->db->where('tbl_peminjaman.id_peminjaman', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get_detail_peminjamanitems($id)
    {

        $this->db->select('tbl_peminjamanitems.*,tbl_buku.*');
        $this->db->from('tbl_peminjamanitems');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_peminjamanitems.id_buku');
        $this->db->where('tbl_peminjamanitems.id_peminjaman', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function countDatariwayatpeminjaman($id)
    {
        $this->db->where('tbl_peminjaman.id_siswa', $id);
        return $this->db->count_all('tbl_peminjaman');
    }
    //pengembalian 
    public function get_all_riwayatpengembalian($id, $limit, $offset)
    {
        $this->db->select('tbl_pengambalian.*,tbl_siswa.*,tbl_admin.nama_admin');
        $this->db->from('tbl_pengambalian');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_pengambalian.id_siswa');
        $this->db->join('tbl_admin', 'tbl_admin.id_admin = tbl_pengambalian.id_admin');
        $this->db->where('tbl_siswa.id_siswa', $id);
        $this->db->order_by('tbl_pengambalian.date', 'desc');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result();
    }

    public function pengembalian($id)
    {
        $this->db->select('tbl_pengambalian.*,tbl_siswa.*,tbl_admin.nama_admin');
        $this->db->from('tbl_pengambalian');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_pengambalian.id_siswa');
        $this->db->join('tbl_admin', 'tbl_admin.id_admin = tbl_pengambalian.id_admin');
        $this->db->where('tbl_pengambalian.id_pengembalian', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function detail_pengembalian($id)
    {
        $this->db->select('tbl_pengembalianitems.*,tbl_buku.*');
        $this->db->from('tbl_pengembalianitems');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_pengembalianitems.id_buku');
        $this->db->where('tbl_pengembalianitems.id_pengembalian', $id);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_pembayaran($id)
    {
        $this->db->select('tbl_denda.*');
        $this->db->from('tbl_denda');
        $this->db->join('tbl_pengambalian', 'tbl_pengambalian.id_pengembalian = tbl_denda.id_pengembalian');
        $this->db->where('tbl_pengambalian.id_pengembalian', $id);
        $query = $this->db->get();
        return $query->result();
    }
    public function countDatariwayatpengembalian($id)
    {
        $this->db->where('tbl_pengambalian.id_siswa', $id);
        return $this->db->count_all('tbl_pengambalian');
    }

    //denda
    public function get_denda($id)
    {
        $this->db->select('tbl_denda.*, tbl_pengambalian.kode_pengembalian,status, tbl_siswa.nama_siswa');
        $this->db->from('tbl_denda');
        $this->db->join('tbl_pengambalian', 'tbl_pengambalian.id_pengembalian = tbl_denda.id_pengembalian');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_pengambalian.id_siswa');
        $this->db->where('tbl_siswa.id_siswa', $id);
        $query = $this->db->get();
        return $query->result();
    }
    public function hitung_denda($id)
    {
        $this->db->select_sum('total_denda');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_pengambalian.id_siswa');
        $this->db->where('tbl_siswa.id_siswa', $id);
        $query = $this->db->get('tbl_pengambalian');
        return $query->row()->total_denda;
    }
    public function hitung_pembayaran($id)
    {
        $this->db->select_sum('jumlah');
        $this->db->join('tbl_pengambalian', 'tbl_pengambalian.id_pengembalian = tbl_denda.id_pengembalian');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_pengambalian.id_siswa');
        $this->db->where('tbl_siswa.id_siswa', $id);
        $query = $this->db->get('tbl_denda');
        return $query->row()->jumlah;
    }
    //pencarian

    public function get_buku()
    {
        $this->db->select('tbl_buku.*,tbl_kategori.nama_kategori,tbl_rak.*');
        $this->db->from('tbl_buku');
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori= tbl_buku.id_kategori');
        $this->db->join('tbl_rak', 'tbl_rak.id_rak = tbl_buku.id_rak');
       
        $query = $this->db->get();
        return $query->result();
    }

    public function urut_buku($limit, $offset, $urutan)
    {
        $this->db->select('tbl_buku.*,tbl_kategori.nama_kategori,tbl_rak.*,COUNT(tbl_peminjamanitems.id_buku) as borrow_count');
        $this->db->from('tbl_buku');
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori= tbl_buku.id_kategori');
        $this->db->join('tbl_rak', 'tbl_rak.id_rak = tbl_buku.id_rak');
        $this->db->join('tbl_peminjamanitems', 'tbl_peminjamanitems.id_buku = tbl_buku.id_buku', 'left');
        $this->db->group_by('tbl_buku.id_buku');
        switch ($urutan) {
            case '1':
                $this->db->order_by('borrow_count', 'desc');
                break;
            case '2':
                $this->db->order_by('tbl_buku.date_created', 'desc');
                break;
            case '3':
                $this->db->order_by('tbl_buku.date_created', 'asc');
                break;
            default:

                break;
        }
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_kategori()
    {
        $query = $this->db->get('tbl_kategori');
        return $query->result();
    }
    public function get_rak()
    {
        $query = $this->db->get('tbl_rak');
        return $query->result();
    }

    public function get_pencarian($kyword)
    {
        $this->db->select('tbl_buku.*,tbl_kategori.nama_kategori,tbl_rak.*');
        $this->db->from('tbl_buku');
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori= tbl_buku.id_kategori');
        $this->db->join('tbl_rak', 'tbl_rak.id_rak = tbl_buku.id_rak');
        $this->db->like('tbl_buku.judul_buku', $kyword);
        $this->db->or_like('tbl_buku.penulis_buku', $kyword);
        $query = $this->db->get();
        return $query->result();
    }

    public function countDatabuku()
    {

        return $this->db->count_all('tbl_buku');
    }
    public function countDatabukukategori($id)
    {
        $this->db->where('id_kategori', $id);
        return $this->db->count_all_results('tbl_buku');
    }

    //buku
    public function get_buku_bykategori($limit, $offset, $id)
    {
        $this->db->select('tbl_buku.*, tbl_kategori.nama_kategori, tbl_rak.*');
        $this->db->from('tbl_buku');
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_buku.id_kategori');
        $this->db->join('tbl_rak', 'tbl_rak.id_rak = tbl_buku.id_rak');
        $this->db->where('tbl_buku.id_kategori', $id);
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_kategori_by_id($id)
    {
        // Query to retrieve category name by ID
        $this->db->select('nama_kategori');
        $this->db->from('tbl_kategori');
        $this->db->where('id_kategori', $id);
        $query = $this->db->get();

        // Check if a row is returned
        if ($query->num_rows() > 0) {
            // Return the category name
            return $query->row()->nama_kategori;
        } else {
            // Return null if category not found
            return null;
        }
    }
    public function filter_buku($limit, $offset, $kelas = null, $rak = null)
    {
        $this->db->select('tbl_buku.*,tbl_kategori.nama_kategori,tbl_rak.nama_rak');
        $this->db->from('tbl_buku');
        $this->db->join('tbl_kategori', 'tbl_buku.id_kategori = tbl_kategori.id_kategori', 'left');
        $this->db->join('tbl_rak', 'tbl_buku.id_rak = tbl_rak.id_rak', 'left');

        if ($kelas) {
            $this->db->where('tbl_buku.kelas_buku', $kelas);
        }
        if ($rak) {
            $this->db->where('tbl_buku.id_rak', $rak);
        }
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result();
    }
    public function countFilteredDatabuku($kelas = null, $rak = null)
    {
        if ($kelas) {
            $this->db->where('tbl_buku.kelas_buku', $kelas);
        }
        if ($rak) {
            $this->db->where('tbl_buku.id_rak', $rak);
        }
        return $this->db->count_all_results('tbl_buku');
    }

    public function get_detailbuku($id)
    {
        $this->db->select('tbl_buku.*,tbl_kategori.nama_kategori,tbl_rak.*');
        $this->db->from('tbl_buku');
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori= tbl_buku.id_kategori');
        $this->db->join('tbl_rak', 'tbl_rak.id_rak = tbl_buku.id_rak');
        $this->db->where('tbl_buku.id_buku', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function hitung_buku()
    {
        return $this->db->count_all('tbl_buku');
    }
    public function hitung_siswa()
    {
        return $this->db->count_all('tbl_siswa');
    }
    public function hitung_admin()
    {
        return $this->db->count_all('tbl_admin');
    }
    public function hitung_kategori()
    {
        return $this->db->count_all('tbl_kategori');
    }

    //detail buku
    public function get_bukudetail()
    {
        $this->db->select('tbl_buku.*, tbl_kategori.nama_kategori, tbl_rak.*');
        $this->db->from('tbl_buku');
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_buku.id_kategori');
        $this->db->join('tbl_rak', 'tbl_rak.id_rak = tbl_buku.id_rak');
        $this->db->order_by('RAND()');
        $this->db->limit(10);
        $query = $this->db->get();
        return $query->result();
    }
}
