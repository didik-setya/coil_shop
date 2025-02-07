<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Dashboard extends CI_Controller {
    public function index(){
        $admin = get_admin();
        $now_year = date('Y');
        $now_month = date('m');
        $now_date = date('d');


        $jml_product = $this->db->get('product')->num_rows();
        $jml_users = $this->db->get('users')->num_rows();
        $jml_checkout = $this->db->where([
            'day(create_at)' => $now_date,
            'month(create_at)' => $now_month,
            'year(create_at)' => $now_year
        ])->get('checkout')->num_rows();

        
        $data = [
            'title' => 'Dashboard',
            'view' => 'dashboard/dashboard',
            'admin' => $admin,
            'jml_product' => $jml_product,
            'jml_users' => $jml_users,
            'jml_checkout' => $jml_checkout
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

    public function users(){
        $admin = get_admin();
        $data = [
            'title' => 'Dashboard',
            'view' => 'dashboard/users',
            'admin' => $admin,
            'js' => ['users.js']
        ];
        $this->load->view('dashboard/index', $data);
    }

    public function settings(){
        $admin = get_admin();
        $data = [
            'title' => 'Pengaturan Akun',
            'view' => 'dashboard/user_settings',
            'admin' => $admin,
            'js' => ['account.js']
        ];
        $this->load->view('dashboard/index', $data);
    }
}