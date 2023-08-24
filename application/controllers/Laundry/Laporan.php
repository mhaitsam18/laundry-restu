<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {
        $data['title'] = "Laporan";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('layouts/topbar', $data);
        $this->load->view('laporan/index', $data);
        $this->load->view('layouts/footer');
    }

    public function print()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->select('laundry.*, user.name, jenis_laundry.jenis_laundry, jenis_laundry.tipe_laundry');
        $this->db->join('member', 'laundry.member_id = member.id', 'left');
        $this->db->join('user', 'member.user_id = user.id', 'left');
        $this->db->join('jenis_laundry', 'laundry.jenis_laundry_id = jenis_laundry.id');
        $this->db->where('MONTH(laundry.created_at)', $this->input->post('bulan'));
        $this->db->where('YEAR(laundry.created_at)', $this->input->post('tahun'));
        $laundrys = $this->db->get('laundry')->result();

        $this->db->select('member_paket.*, user.name, paket.paket, paket.lama');
        $this->db->join('paket', 'member_paket.paket_id = paket.id');
        $this->db->join('member', 'member_paket.member_id = member.id', 'left');
        $this->db->join('user', 'member.user_id = user.id', 'left');
        $this->db->where('MONTH(member_paket.created_at)', $this->input->post('bulan'));
        $this->db->where('YEAR(member_paket.created_at)', $this->input->post('tahun'));
        $member_pakets = $this->db->get_where('member_paket')->result();

        $this->db->where('MONTH(tanggal_transaksi)', $this->input->post('bulan'));
        $this->db->where('YEAR(tanggal_transaksi)', $this->input->post('tahun'));
        $bebans = $this->db->get_where('beban')->result();

        $laporan = [];
        $index = 0;

        if ($this->input->post('aksi') == 'transaksi') {
            $data['judul_laporan'] = "transaksi";
            foreach ($laundrys as $laundry) {
                if ($laundry->harga > 0) {
                    $laporan[$index]['tanggal'] = $laundry->created_at;
                    $laporan[$index]['waktu_transaksi'] = cari_tanggal($laundry->created_at);
                    $laporan[$index]['member'] = $laundry->name;
                    if ($laundry->tipe_laundry == 'laundry berat') {
                        $satuan = 'kg';
                    } elseif ($laundry->tipe_laundry == 'laundry tetap') {
                        $satuan = 'pcs';
                    } else {
                        $satuan = '-';
                    }
                    $laporan[$index]['pembayaran'] = $laundry->jenis_laundry . ' ' . $laundry->berat . ' ' . $satuan;
                    if ($laundry->harga !== null) {
                        $laporan[$index]['harga_rupiah'] = 'Rp.' . number_format($laundry->harga, 2, ',', '.');
                        $laporan[$index]['harga'] = $laundry->harga;
                    } else {
                        $laporan[$index]['harga_rupiah'] = 'Rp. -';
                        $laporan[$index]['harga'] = 0;
                    }
                    $index++;
                }
            }
            foreach ($member_pakets as $member_paket) {
                if ($member_paket->harga_bayar > 0) {
                    $laporan[$index]['tanggal'] = $member_paket->created_at;
                    $laporan[$index]['waktu_transaksi'] = cari_tanggal($member_paket->created_at);
                    $laporan[$index]['member'] = $member_paket->name;
                    $laporan[$index]['pembayaran'] = 'Paket ' . $member_paket->paket . ' ' . $member_paket->lama;
                    $laporan[$index]['harga_rupiah'] = 'Rp.' . number_format($member_paket->harga_bayar, 2, ',', '.');
                    $laporan[$index]['harga'] = $member_paket->harga_bayar;
                    $index++;
                }
            }
            foreach ($bebans as $beban) {
                $laporan[$index]['tanggal'] = $beban->tanggal_transaksi;
                $laporan[$index]['waktu_transaksi'] = cari_tanggal($beban->tanggal_transaksi);
                $laporan[$index]['member'] = '-';
                $laporan[$index]['pembayaran'] = $beban->beban;
                $laporan[$index]['harga_rupiah'] = '- Rp.' . number_format($beban->harga, 2, ',', '.');
                $laporan[$index]['harga'] = -$beban->harga;
                $index++;
            }
        } elseif ($this->input->post('aksi') == 'pemasukan') {
            $data['judul_laporan'] = "pemasukan";
            $_laporan_remap = [];
            $_index = 0;
            foreach ($laundrys as $laundry) {
                if ($laundry->harga > 0 && $laundry->is_active == 1) {
                    $_laporan_remap[$_index]['tanggal'] = $laundry->created_at;
                    $_laporan_remap[$_index]['waktu_transaksi'] = cari_tanggal($laundry->created_at);
                    $_laporan_remap[$_index]['member'] = $laundry->name;
                    if ($laundry->tipe_laundry == 'laundry berat') {
                        $satuan = 'kg';
                    } elseif ($laundry->tipe_laundry == 'laundry tetap') {
                        $satuan = 'pcs';
                    } else {
                        $satuan = '-';
                    }
                    $_laporan_remap[$_index]['pembayaran'] = $laundry->jenis_laundry . ' ' . $laundry->berat . ' ' . $satuan;
                    if ($laundry->harga !== null) {
                        $_laporan_remap[$_index]['harga_rupiah'] = 'Rp.' . number_format($laundry->harga, 2, ',', '.');
                        $_laporan_remap[$_index]['harga'] = $laundry->harga;
                    } else {
                        $_laporan_remap[$_index]['harga_rupiah'] = 'Rp. -';
                        $_laporan_remap[$_index]['harga'] = 0;
                    }
                    $_index++;
                }
            }
            foreach ($member_pakets as $member_paket) {
                if ($member_paket->harga_bayar > 0) {
                    $_laporan_remap[$_index]['tanggal'] = $member_paket->created_at;
                    $_laporan_remap[$_index]['waktu_transaksi'] = cari_tanggal($member_paket->created_at);
                    $_laporan_remap[$_index]['member'] = $member_paket->name;
                    $_laporan_remap[$_index]['pembayaran'] = 'Paket ' . $member_paket->paket . ' ' . $member_paket->lama;
                    $_laporan_remap[$_index]['harga_rupiah'] = 'Rp.' . number_format($member_paket->harga_bayar, 2, ',', '.');
                    $_laporan_remap[$_index]['harga'] = $member_paket->harga_bayar;
                    $_index++;
                }
            }

            $_laporan = [];
            foreach ($_laporan_remap as $_lr) {
                $_tanggal_arr = explode(' ',  $_lr['tanggal']);
                $_tanggal_str = $_tanggal_arr[0];
                $_laporan[$_tanggal_str][$_lr['member']]['tanggal'][] = $_lr['tanggal'];
                $_laporan[$_tanggal_str][$_lr['member']]['waktu_transaksi'][] = $_lr['waktu_transaksi'];
                $_laporan[$_tanggal_str][$_lr['member']]['member'][] = $_lr['member'];
                $_laporan[$_tanggal_str][$_lr['member']]['pembayaran'][] = $_lr['pembayaran'];
                $_laporan[$_tanggal_str][$_lr['member']]['harga_rupiah'][] = $_lr['harga_rupiah'];
                $_laporan[$_tanggal_str][$_lr['member']]['harga'][] = $_lr['harga'];
            }

            $already_date_added = [];
            $already_member_added = [];
            foreach ($_laporan_remap as $_lr) {
                $_tanggal_arr = explode(' ',  $_lr['tanggal']);
                $_tanggal_str = $_tanggal_arr[0];
                $_member = $_lr['member'];
                if (!in_array($_member, $already_member_added)) {
                    $laporan[$index]['tanggal'] = $_lr['tanggal'];
                    $laporan[$index]['waktu_transaksi'] = $_lr['tanggal'];
                    $laporan[$index]['member'] = $_lr['member'];
                    $laporan[$index]['pembayaran'] = implode(', ', $_laporan[$_tanggal_str][$_member]['pembayaran']);
                    $laporan[$index]['harga_rupiah'] = 'Rp.' . number_format(array_sum($_laporan[$_tanggal_str][$_member]['harga']), 2, ',', '.');
                    $laporan[$index]['harga'] = array_sum($_laporan[$_tanggal_str][$_member]['harga']);
                    $index++;
                    $already_date_added[] = $_tanggal_str;
                    $already_member_added[] = $_lr['member'];
                }
            }

        } elseif ($this->input->post('aksi') == 'pengeluaran') {
            $data['judul_laporan'] = "pengeluaran";
            $_laporan = [];
            foreach ($bebans as $beban) {
                $_laporan[$beban->tanggal_transaksi]['tanggal'][] = $beban->tanggal_transaksi;
                $_laporan[$beban->tanggal_transaksi]['waktu_transaksi'][] = cari_tanggal($beban->tanggal_transaksi);
                $_laporan[$beban->tanggal_transaksi]['member'][] = '-';
                $_laporan[$beban->tanggal_transaksi]['pembayaran'][] = $beban->beban;
                $_laporan[$beban->tanggal_transaksi]['harga_rupiah'][] = $beban->harga;
                $_laporan[$beban->tanggal_transaksi]['harga'][] = $beban->harga;
                // $index++;
            }
            
            $already_date_added = [];
            foreach ($bebans as $beban) {
                if (!in_array($beban->tanggal_transaksi, $already_date_added)) {
                    $laporan[$index]['tanggal'] = $beban->tanggal_transaksi;
                    $laporan[$index]['waktu_transaksi'] = cari_tanggal($beban->tanggal_transaksi);
                    $laporan[$index]['member'] = '-';
                    $laporan[$index]['pembayaran'] = implode(', ', $_laporan[$beban->tanggal_transaksi]['pembayaran']);
                    $laporan[$index]['harga_rupiah'] = 'Rp.' . number_format(array_sum($_laporan[$beban->tanggal_transaksi]['harga_rupiah']), 2, ',', '.');
                    $laporan[$index]['harga'] = array_sum($_laporan[$beban->tanggal_transaksi]['harga']);
                    $index++;
                    $already_date_added[] = $beban->tanggal_transaksi;
                }
            }
        }

        // Mengambil kolom 'tanggal' dari array $laporan untuk dijadikan acuan pengurutan
        foreach ($laporan as $key => $row) {
            $tanggal[$key] = $row['tanggal'];
        }

        // Mengurutkan array $laporan berdasarkan tanggal transaksi secara menaik (ASC)
        // Jika ingin mengurutkan secara menurun (DESC), gunakan SORT_DESC
        if($laporan){
            array_multisort($tanggal, SORT_ASC, $laporan);
        }
        $data['laporans'] = $laporan;
        $data['tahun'] = $this->input->post('tahun');
        $data['bulan'] = cari_bulan($this->input->post('bulan'));
        $this->load->view('laporan/print', $data);
    }
}
