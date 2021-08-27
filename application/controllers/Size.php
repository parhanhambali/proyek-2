<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Size extends CI_Controller
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
        $data['title'] = "Size";
        $data['size'] = $this->admin->get('size');
        $this->template->load('templates/dashboard', 'size/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_size', 'Nama Size', '');
    }

    public function add()
    {
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Size";
            $this->template->load('templates/dashboard', 'size/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('size', $input);
            if ($insert) {
                set_pesan('data berhasil disimpan');
                redirect('size');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('size/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Size";
            $data['size'] = $this->admin->get('size', ['id_size' => $id]);
            $this->template->load('templates/dashboard', 'size/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('size', 'id_size', $id, $input);
            if ($update) {
                set_pesan('data berhasil disimpan');
                redirect('size');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('size/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('size', 'id_size', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('size');
    }
}
