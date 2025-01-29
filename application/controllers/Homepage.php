<?php
defined('BASEPATH')or exit('No direct script access allowed');
class Homepage extends CI_Controller {
    public function index(){
        $data = [
            'title' => 'RQ Coil Builders',
            'view' => 'main/home',
            'all_product' => $this->db->order_by('create_at', 'DESC')->get('product')->result()
        ];
        $this->load->view('main/index', $data);
    }
}