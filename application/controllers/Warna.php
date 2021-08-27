<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Warna extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Warna";
        $data['warna'] = $this->admin->get('warna');
        $this->template->load('templates/dashboard', 'warna/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_warna', 'Nama Warna', 'required|trim');
    }

    public function add()
    {
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Warna";
            $this->template->load('templates/dashboard', 'warna/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('warna', $input);
            if ($insert) {
                set_pesan('data berhasil disimpan');
                redirect('warna');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('warna/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Warna";
            $data['warna'] = $this->admin->get('warna', ['id_warna' => $id]);
            $this->template->load('templates/dashboard', 'warna/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('warna', 'id_warna', $id, $input);
            if ($update) {
                set_pesan('data berhasil disimpan');
                redirect('warna');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('warna/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('warna', 'id_warna', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('warna');
    }
}
