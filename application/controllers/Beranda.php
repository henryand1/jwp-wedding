<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Katalog_model');
        $this->load->model('Pesanan_model');
        $this->load->helper('text');
    }

    public function index()
    {

        $data = array(
            'title' => 'JeWePe Wedding Organizer',
            'page' => 'landing/beranda',
            'getAllKatalog' => $this->Katalog_model->get_all_katalog_landing()->result_array(),
        );

        $this->load->view('landing/templates/site', $data);
    }

    public function detail()
    {
        if ($this->input->get('id')) {
            $cek_data = $this->Katalog_model->get_katalog_by_id($this->input->get('id'))->num_rows();

            if ($cek_data > 0) {
                $data = array(
                    'title' => 'JiePWe Wedding Organizer',
                    'page' => 'landing/detail',
                    'katalog' => $this->Katalog_model->get_katalog_by_id($this->input->get('id'))->row()
                );
                $this->load->view('landing/templates/site', $data);
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Upsss </strong>Data tidak ditemukan!<i class="remove ti-close" data-dismiss="alert"></i></div>');
                redirect('/');
            }
        } else {
            redirect('/');
        }
    }

    public function pesan()
    {
        if ($this->input->post()) {
            $post = $this->input->post(); 
            
            $datetime = date('Y-m-d H:i:s');
            $fileName = date('Ymd') . '_' . rand();

            $data = array(
                'catalogue_id' => $post['id'],
                'name' => $post['name'],
                'email' => $post['email'],
                'phone_number' => $post['phone'],
                'user_id' => '1',
                'created_at' => $datetime,
                'wedding_date' => $post['subject'],
                'alamat' => $post['message'],
            );

            $insert = $this->Pesanan_model->insert($data);

            if ($insert) {
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success </strong>Berhasil Memesan!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('/');
            }
        } else {
            redirect('/');
        }
    }


}
