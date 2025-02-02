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

        if($data_user && $cart){
            $data = [
                'title' => 'RQ Coil Builders',
                'view' => 'main/checkout',
                'user' => $data_user,
                'cart' => $cart
            ];
            $this->load->view('main/index', $data);
        } else {
            redirect(base_url());
        }
    }
}