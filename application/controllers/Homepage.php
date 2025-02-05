<?php
defined('BASEPATH')or exit('No direct script access allowed');
class Homepage extends CI_Controller {
    public function index(){
        $data_user = get_users();
        $data = [
            'title' => 'RQ Coil Builders',
            'view' => 'main/home',
            'all_product' => $this->db->order_by('create_at', 'DESC')->get('product')->result(),
            'user' => $data_user
        ];
        $this->load->view('main/index', $data);
    }

    public function checkout(){
        $data_user = get_users();
        $cart = $this->cart->contents();
        $web_settings = $this->db->get_where('settings', ['id' => 1])->row();
        $all_courir = file_get_contents('./assets/courir.json');
        $all_payment = file_get_contents('./assets/payment.json');

        
        if($data_user && $cart){
            $data = [
                'title' => 'RQ Coil Builders',
                'view' => 'main/checkout',
                'user' => $data_user,
                'cart' => $cart,
                'settings' => $web_settings,
                'courir' => $all_courir,
                'payment' => $all_payment
            ];
            $this->load->view('main/index', $data);
        } else {
            redirect(base_url());
        }
    }

    public function history(){
        $data_user = get_users();
        if($data_user){
            $data = [
                'title' => 'Riwayat Transaksi',
                'view' => 'main/transaction_history',
                'user' => $data_user,
                'data'=> $this->checkout->get_history_for_user()
            ];
            $this->load->view('main/index', $data);
        } else {
            redirect(base_url());
        }
    }
}