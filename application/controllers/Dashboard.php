<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
    public function index(){
        $admin = get_admin();
        $data = [
            'title' => 'Dashboard',
            'view' => 'dashboard/dashboard',
            'admin' => $admin
        ];
        $this->load->view('dashboard/index', $data);
    }

    
    public function product(){
        $admin = get_admin();
        $data = [
            'title' => 'Produk',
            'view' => 'dashboard/product',
            'admin' => $admin,
            'js' => ['product.js', 'jquery.MultiFile.min.js'],
            'produk' => $this->db->order_by('create_at', 'DESC')->get('product')->result()
        ];
        $this->load->view('dashboard/index', $data);
    }
}