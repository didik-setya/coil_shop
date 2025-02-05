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

    public function web_settings(){
        $admin = get_admin();
        
        $data = [
            'title' => 'Pengaturan Web',
            'view' => 'dashboard/web_settings',
            'admin' => $admin,
            'js' => ['web_settings.js'],
            'data' => $this->db->get('settings')->row(),
            'payment' => file_get_contents('./assets/payment.json'),
            'courir' => file_get_contents('./assets/courir.json')
        ];
        $this->load->view('dashboard/index', $data);
    }

    public function transaction(){
        $admin = get_admin();
        
        $data = [
            'title' => 'Transaksi',
            'view' => 'dashboard/transaction',
            'admin' => $admin,
            'js' => ['transaction.js']
        ];
        $this->load->view('dashboard/index', $data);
    }
}