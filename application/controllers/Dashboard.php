<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        $data['barang'] = $this->admin->count('barang');
        $data['barang_masuk'] = $this->admin->count('barang_masuk');
        $data['barang_keluar'] = $this->admin->count('barang_keluar');
        $data['harga_awal'] = $this->admin->count('harga_awal');
        $data['harga_promo'] = $this->admin->count('harga_promo');
        $data['supplier'] = $this->admin->count('supplier');
        $data['user'] = $this->admin->count('user');
        //$data['size'] = $this->admin->count('size');
        //$data['bahan'] = $this->admin->count('bahan');
        //$data['warna'] = $this->admin->count('warna');
        //$data['mata'] = $this->admin->count('mata');
        $data['stok'] = $this->admin->sum('barang', 'stok');
        $data['harga'] = $this->admin->sum('barang', 'harga');
        $data['barang_min'] = $this->admin->min('barang', 'stok', 10);
        $data['barang_min'] = $this->admin->min('barang', 'harga', 10);
        $data['transaksi'] = [
            'barang_masuk' => $this->admin->getBarangMasuk(5),
            'barang_keluar' => $this->admin->getBarangKeluar(5)
            //'harga_awal' => $this->admin->getHargaAwal(5),
            //'harga_promo' => $this->admin->getHargaPromo(5)
        ];

        // Line Chart
        $bln = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16'];
        $data['cbm'] = [];
        $data['cbk'] = [];
        $data['cbm'] = [];
        $data['cbk'] = [];

        foreach ($bln as $b) {
            $data['cbm'][] = $this->admin->chartBarangMasuk($b);
            $data['cbk'][] = $this->admin->chartBarangKeluar($b);
            //$data['cbm'][] = $this->admin->chartHargaAwal($b);
            //$data['cbk'][] = $this->admin->chartHargaPromo($b);
        }

        $this->template->load('templates/dashboard', 'dashboard', $data);
    }
}
