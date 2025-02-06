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
                    'id' => md5(sha1($data->id)),
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
        $qty = $this->input->post('qty');
        

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
                            'qty' => $qty,
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

    public function cost_courir(){
        cek_ajax();
        $courir= htmlspecialchars($this->input->post('courir'));
        $zipcode= htmlspecialchars($this->input->post('zipcode'));
        $weight= htmlspecialchars($this->input->post('weight'));

        if($courir && $zipcode && $weight){
            $settings = $this->db->get_where('settings', ['id' => 1])->row();
            $main_point = json_decode($settings->shipping_point);
            $zip_point = $main_point->zip_code;
            $this->api->calculate_courir_cost($zip_point, $zipcode, $weight, $courir);
        } else {
            $msg = [
                'status' => false,
                'msg' => 'Invalid parameters'
            ];
            json_output($msg);
        }
    }

    public function validation_checkout(){
        cek_ajax();
        $this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('telp', 'No. Telp', 'required|trim|min_length[9]|numeric');

        $this->form_validation->set_message('required', '{field} harap di isi');
        $this->form_validation->set_message('valid_email', '{field} harus valid email');
        $this->form_validation->set_message('min_length', '{field} min {param} digit');
        $this->form_validation->set_message('numeric', '{field} harus angka');

        if($this->form_validation->run() == false){
            $output = [
                'type' => 'validation',
                'err_name' => form_error('name'),
                'err_email' => form_error('email'),
                'err_telp' => form_error('telp'),
                'token' => $this->security->get_csrf_hash()
            ];
            echo json_encode($output);
            die;
        } else {
            $get_user = get_users();
            if($get_user){
                $zipcode = $this->input->post('zipcode');
                $courier = $this->input->post('courir');
                $service_courier = $this->input->post('service_courier');
                $cost_courier = $this->input->post('cost_courier');
                $new_qty = $this->input->post('qty_product');

                if($zipcode && $courier && $service_courier && $cost_courier){
                    if(in_array(0, $new_qty)){
                        $output = [
                            'type' => 'result',
                            'status' => false,
                            'msg' => 'Harap isi jumlah produk dengan benar',
                            'token' => $this->security->get_csrf_hash()
                        ];
                        echo json_encode($output);
                        die;
                    } else {
                        $rowid = $this->input->post('rowid');
                        $count_rowid = count($rowid);
                        $update_cart = [];
                        for($i = 0; $i < $count_rowid; $i++){
                            $row = [
                                'rowid' => $rowid[$i],
                                'qty' => $new_qty[$i]
                            ];
                            $update_cart[] = $row;
                        }
                        $this->cart->update($update_cart);
                        $this->_checkout();
                    }
                } else {
                    $output = [
                        'type' => 'result',
                        'status' => false,
                        'msg' => 'Data is invalid',
                        'token' => $this->security->get_csrf_hash()
                    ];
                    echo json_encode($output);
                    die;
                }   


            } else {
                //logout
                $output = [
                    'type' => 'result',
                    'status' => false,
                    'msg' => 'please login',
                    'redirect' => base_url('login/logout'),
                    'token' => $this->security->get_csrf_hash()
                ];
                json_output($output, 200);
            }


        }

    }

    private function _checkout(){
        $data_user = get_users();
        $settings_payment = $this->db->get_where('settings', ['id' => 1])->row()->payment_account;
        $decode_payment = json_decode($settings_payment);

        $name = htmlspecialchars($this->input->post('full_name'));
        $email = htmlspecialchars($this->input->post('email'));
        $telp = htmlspecialchars($this->input->post('telp'));

        $province = htmlspecialchars($this->input->post('province'));
        $city = htmlspecialchars($this->input->post('city'));
        $distric = htmlspecialchars($this->input->post('distric'));
        $sub_distric = htmlspecialchars($this->input->post('subdistric'));
        $zipcode = htmlspecialchars($this->input->post('zipcode'));
        $address = htmlspecialchars($this->input->post('address'));
        $notes = htmlspecialchars($this->input->post('notes'));

        $courier = htmlspecialchars($this->input->post('courir'));
        $service_courier = htmlspecialchars($this->input->post('service_courier'));
        $cost_courier = htmlspecialchars($this->input->post('cost_courier'));
        $payment = htmlspecialchars($this->input->post('payment'));

        $main_id = time();
        $cart = $this->cart->contents();
        $total_weight = 0;
        $total_product = $this->cart->total();
        $total_items = $this->cart->total_items();
        
        $sub_checkout = [];
        $data_payment = [];
        foreach($cart as $ct){
            $total_weight += $ct['options']['weight'];
            $row = [
                'id_checkout' => $main_id,
                'id_product' => $ct['id'],
                'qty'=>$ct['qty'],
                'price' => $ct['price'],
                'subtotal' => $ct['subtotal'],
                'create_at' => date('Y-m-d H:i:s'),
                'last_update' => date('Y-m-d H:i:s')
            ];
            $sub_checkout[] = $row;
        }

        foreach($decode_payment as $sp){
            if($sp->name == $payment){
                $data_payment = [
                    'name' => $sp->name,
                    'value' => $sp->value
                ];
            }
        }

        
        $check_courier = $this->api->check_courier_cost($zipcode, $total_weight, $courier, $service_courier);
        $courier_cost = $check_courier['cost'];
        $total_all = $courier_cost + $total_product;


        $to = [
            'name' => $name,
            'email' => $email,
            'phone' => $telp,
            'address' => $address,
            'province' => $province,
            'city' => $city,
            'distric' => $distric,
            'subdistric' => $sub_distric,
            'zipcode' => $zipcode,
            'notes' => $notes 
        ];
        
        $data_courier = [
            'code' => $check_courier['code'],
            'name' => $check_courier['name'],
            'service' => $check_courier['service'],
            'cost' => $check_courier['cost'],
        ];

        $data_checkout=[
            'id' => $main_id,
            'receipt_payment' => 'ORD'.time(),
            'id_user' => $data_user['decode_id'],
            'to' => json_encode($to),
            'courier' => json_encode($data_courier),
            'receipt_courier' => '',
            'proof_transaction' => '',
            'total_items' => $total_items,
            'total_weight' => $total_weight,
            'total_all' => $total_all,
            'payment' => json_encode($data_payment),
            'status' => 2,
            'create_at' => date('Y-m-d H:i:s'),
            'last_update' => date('Y-m-d H:i:s'),
        ];
        

        $this->db->trans_begin();
        $this->db->insert('checkout', $data_checkout);
        $this->db->insert_batch('sub_checkout', $sub_checkout);

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $output = [
                'type' => 'result',
                'status' => false,
                'msg' => 'Order gagal, harap coba kembali',
                'token' => $this->security->get_csrf_hash()
            ];
        }
        else
        {
            $this->db->trans_commit();
            $this->cart->destroy();
            $output = [
                'type' => 'result',
                'status' => true,
                'msg' => 'Order berhasil, harap lakukan pembayaran',
                'redirect' => base_url('transaction_history'),
                'token' => $this->security->get_csrf_hash()
            ];
        }
        json_output($output, 200);

    }

    public function proof_payment(){
        cek_ajax();
        $action = $this->input->post('action');
        $id = htmlspecialchars($this->input->post('id'));
        $get_checkout = $this->db->where('md5(id)', $id)->get('checkout')->row();
        if($get_checkout){
            switch($action){
                case 'add':
                    $img = $_FILES['proof_transaction']['name'];
                    if($img){
                        $config['upload_path']          = './assets/img/transaction/';
                        $config['allowed_types']        = 'jpeg|jpg|png|gif|svg';
                        $config['file_name']            = 'py_'.time();
        
                        $this->load->library('upload', $config);

                        if($this->upload->do_upload('proof_transaction')){
                            $file = $this->upload->data('file_name');
                        } else {
                            $output = [
                                'status' => false,
                                'token' => $this->security->get_csrf_hash(),
                                'msg' => $this->upload->display_errors()
                            ];
                            echo json_encode($output);
                            die;
                        }

                        $update = [
                            'proof_transaction' => $file,
                            'status' => 3
                        ];
                        $this->db->where('id', $get_checkout->id)->update('checkout', $update);
                        if($this->db->affected_rows() > 0){
                            $output = [
                                'status' => true,
                                'token' => $this->security->get_csrf_hash(),
                                'msg' => 'Bukti pembayaran berhasil di kirim'
                            ];
                        } else {
                            $output = [
                                'status' => false,
                                'token' => $this->security->get_csrf_hash(),
                                'msg' => 'Bukti pembayaran gagal di kirim'
                            ];
                        }
                    } else {
                        $output = [
                            'status' => false,
                            'token' => $this->security->get_csrf_hash(),
                            'msg' => 'Invalid input'
                        ];
                    }
                    json_output($output, 200);
                    break;
                case 'edit':
                    $img = $_FILES['proof_transaction']['name'];
                    if($img){
                        $config['upload_path']          = './assets/img/transaction/';
                        $config['allowed_types']        = 'jpeg|jpg|png|gif|svg';
                        $config['file_name']            = 'py_'.time();
        
                        $this->load->library('upload', $config);

                        if($this->upload->do_upload('proof_transaction')){
                            unlink(FCPATH .'assets/img/transaction/'. $get_checkout->proof_transaction);
                            $file = $this->upload->data('file_name');
                        } else {
                            $output = [
                                'status' => false,
                                'token' => $this->security->get_csrf_hash(),
                                'msg' => $this->upload->display_errors()
                            ];
                            echo json_encode($output);
                            die;
                        }

                        $update = [
                            'proof_transaction' => $file,
                            'status' => 3
                        ];
                        $this->db->where('id', $get_checkout->id)->update('checkout', $update);
                        if($this->db->affected_rows() > 0){
                            $output = [
                                'status' => true,
                                'token' => $this->security->get_csrf_hash(),
                                'msg' => 'Bukti pembayaran berhasil di update'
                            ];
                        } else {
                            $output = [
                                'status' => false,
                                'token' => $this->security->get_csrf_hash(),
                                'msg' => 'Bukti pembayaran gagal di update'
                            ];
                        }
                    } else {
                        $output = [
                            'status' => false,
                            'token' => $this->security->get_csrf_hash(),
                            'msg' => 'Invalid input'
                        ];
                    }
                    json_output($output, 200);
                    break;
                default:
                    $output = [
                        'status' => false,
                        'token' => $this->security->get_csrf_hash(),
                        'msg' => 'unknow action'
                    ];
                    echo json_encode($output);
                    die;
                break;
            }
        } else {
            $output = [
                'status' => false,
                'token' => $this->security->get_csrf_hash(),
                'msg' => 'action not found'
            ];
            json_output($output, 200);
        }
        
    }
}