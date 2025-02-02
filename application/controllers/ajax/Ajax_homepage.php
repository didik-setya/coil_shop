<?php
defined('BASEPATH')or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Ajax_homepage extends CI_Controller {
    

    public function show_product(){
        cek_ajax();
        $id = htmlspecialchars($this->input->post('id'));

        if($id){
            $data = $this->db->get_where('product', ['md5(sha1(id))' => $id])->row();
            if($data){
                if($data->product_discount > 0){
                    $discount = $data->product_discount / 100 * $data->product_price;
                    $real_price = $data->product_price - $discount;
                } else {
                    $real_price = $data->product_price;
                }

                $array_data = [
                    'name' => $data->product_name,
                    'img' => base_url('assets/img/product/') . $data->product_images,
                    'price' => number_format($data->product_price),
                    'discount' => $data->product_discount,
                    'real_price' => number_format($real_price),
                    'desc' => $data->product_desc
                ]; 
                $output = [
                    'status' => true,
                    'data' => $array_data
                ];
            } else {
                $output = [
                    'status' => false,
                    'msg' => 'Data tidak di temukan'
                ];
            }
        } else {
            $output = [
                'status' => false,
                'msg' => 'Invalid parameters'
            ];
        }
        $this->output
        ->set_status_header(200)
        ->set_content_type('application/json')
        ->set_output(json_encode($output));
        
        
    }

    public function add_cart(){
        $product = htmlspecialchars($this->input->post('product', true));
        $get_product = $this->db->where('md5(sha1(id))', $product)->get('product')->row();

        

        $email = $this->session->userdata('user_email');
        if($email){
            $user = $this->db->get_where('users', ['email' => $email])->row();
            if($user){
                if($get_product){
                    $real_price = 0;
                    if($get_product->product_discount > 0){
                        $discount = $get_product->product_discount / 100 * $get_product->product_price;
                        $real_price = $get_product->product_price - $discount;
                    } else {
                        $real_price = $get_product->product_price;
                    }


                    $data = [
                            'id' => $get_product->id,
                            'qty' => 1,
                            'name' => 'lorem',
                            'price' =>$real_price,
                            'options' => [
                                'img' => base_url('assets/img/product/') . $get_product->product_images,
                                'weight' => $get_product->product_weight,
                                'real_name' => $get_product->product_name
                            ]
                        ];
                    

                    
                        $this->cart->insert($data);
                        redirect(base_url());
                    
                } else {
                    redirect(base_url());
                }
            } else {
                redirect(base_url('login'));
            }
        } else {
            redirect(base_url('login'));
        }
    }

    public function destroy_cart(){
        $this->cart->destroy();
        redirect(base_url());
    }

    public function add_cart_get(){
        $product = $this->uri->segment('2');
        $get_product = $this->db->where('md5(sha1(id))', $product)->get('product')->row();

        $data = [
            'id' => $get_product->id,
            'qty' => 1,
            'name' => 'sasss',
            'price' => $get_product->product_price
        ];

        $this->cart->insert($data);
        var_dump($this->cart->total_items(), $this->cart->contents());
    }

    public function remove_cart(){
        $rowid = $this->input->post('rowid');
        $this->cart->remove($rowid);
        redirect(base_url());
    }

    public function get_api_prov(){
        // cek_ajax();
        // $api_url = $this->config->item('rajaongkir_url');
        // $api_key = $this->config->item('rajaongkir_key');

        // $url = $api_url.'province';
        // $curl = curl_init();

        
        // curl_setopt_array($curl, array(
        // CURLOPT_URL => 'https://rajaongkir.komerce.id/api/v1/destination/domestic-destination',
        // CURLOPT_RETURNTRANSFER => true,
        // CURLOPT_ENCODING => "",
        // CURLOPT_CUSTOMREQUEST => "GET",
        // CURLOPT_HTTPHEADER => array(
        //     "key: " . $api_key
        // ),
        // ));

        // $response = curl_exec($curl);
        // $err = curl_error($curl);

        // curl_close($curl);

        // // if ($err) {
        // // echo "cURL Error #:" . $err;
        // // } else {
        // // echo $response;
        // // }

        // var_dump($response);

    }

    public function get_api_city(){

    }
}