<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kontak extends CI_Controller
{


    public function index()
    {

        $data = array(
            'title' => 'JeWePe Wedding Organizer',
            'page' => 'landing/kontak'
        );

        $this->load->view('landing/templates/site', $data);
    }
}