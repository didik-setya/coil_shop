<?php
defined('BASEPATH')or exit('No direct script access allowed');
class Checkout_model extends CI_Model {
    public function get_history_for_user(){
        $user = get_users();
        $id = $user['decode_id'];

        $data_checkout = $this->get_data_checkout($id)->result();
    

        $output = [];
        foreach($data_checkout as $dc){
            $crt_create_at = date_create($dc->create_at);
            $decode_courier = json_decode($dc->courier);
            $decode_to = json_decode($dc->to);
            $decode_payment = json_decode($dc->payment);
            $sub_checkout = $this->get_sub_checkout($dc->id)->result();
            $payment = $decode_payment->name .' ('.$decode_payment->value.')';

           

            $row = [
                'id' => md5($dc->id),
                'receipt_payment' => $dc->receipt_payment,
                'receipt_courier' => $dc->receipt_courier,
                'proof_transaction' => $dc->proof_transaction,
                'total_all' => $dc->total_all,
                'status' => $dc->status,
                'create_at' => date_format($crt_create_at, 'd F Y H:i:s'),
                'payment' => $payment,
                'courier' => [
                    'name' => $decode_courier->name,
                    'service' => $decode_courier->service,
                    'cost' => $decode_courier->cost
                ],
                'to' => [
                    'name' => $decode_to->name,
                    'phone' => $decode_to->phone,
                    'address' => $decode_to->address,
                    'province' => $decode_to->province,
                    'city' => $decode_to->city,
                    'distric' => $decode_to->distric,
                    'subdistric' => $decode_to->subdistric,
                    'zipcode' => $decode_to->zipcode,
                    'notes' => $decode_to->notes
                ],
                'sub_checkout' => $sub_checkout
            ];
            $output[] = $row;
        }
        return $output;
    }


    private function get_data_checkout($id_user = null, $id_checkout = null){
        if($id_user){
            $this->db->where('id_user', $id_user);
        }

        if($id_checkout){
            $this->db->where('md5(id)', $id_checkout);
        }
        return $this->db->order_by('create_at', 'DESC')->get('checkout');
    }

    private function get_sub_checkout($id_checkout=null, $encode_id=null){
        $this->db->select('
            sub_checkout.qty,
            sub_checkout.price,
            sub_checkout.subtotal,
            product.product_name,
            product.product_images
        ')
        ->from('sub_checkout')
        ->join('product', 'sub_checkout.id_product = product.id');
        if($id_checkout){
            $this->db->where('sub_checkout.id_checkout', $id_checkout);
        }
        if($encode_id){
            $this->db->where('md5(sub_checkout.id_checkout)', $encode_id);
        }
        
        $data = $this->db->get();
        return $data;
    }

    public function get_detail_checkout_all($id){
        $data_checkout = $this->get_data_checkout(null, $id)->row();
        $sub_checkout = $this->get_sub_checkout(null, $id)->result();

        $decode_courier = json_decode($data_checkout->courier);
        $decode_to = json_decode($data_checkout->to);
        $decode_payment = json_decode($data_checkout->payment);

        $data = [
            'receipt_payment'=>$data_checkout->receipt_payment,
            'receipt_courier' => $data_checkout->receipt_courier,
            'proof_transaction' => $data_checkout->proof_transaction,
            'total_all' => $data_checkout->total_all,
            'create_at'=> $data_checkout->create_at,
            'courier' => $decode_courier,
            'to' => $decode_to,
            'payment' => $decode_payment,
            'product' => $sub_checkout
        ];
        return $data;
    }


    private function q_data_checkout(){
        $this->db->select('checkout.*, users.nama, users.email')
        ->from('checkout')
        ->join('users', 'checkout.id_user = users.id')
        ->order_by('checkout.create_at', 'DESC');
    }

    private function f_data_checkout(){
        $this->q_data_checkout();
        $search = ['nama', 'email', 'receipt_payment', 'receipt_courier'];
        $i = 0;
        foreach ($search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($search) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }
    }

    public function get_data(){
        $this->f_data_checkout();
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_all_data(){
        $this->q_data_checkout();
        return $this->db->count_all_results();
    }

    public function filtered_all_data(){
        $this->f_data_checkout();
        $query = $this->db->get();
        return $query->num_rows();
    }
}