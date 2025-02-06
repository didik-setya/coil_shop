<?php
defined('BASEPATH')or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Ajax_product extends CI_Controller {
    public function verify_product(){
        cek_ajax();

        $this->form_validation->set_rules('name', 'Nama Produk', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('price', 'Harga Produk', 'required|trim|numeric');
        $this->form_validation->set_rules('discount', 'Diskon', 'required|trim|numeric|max_length[2]');
        $this->form_validation->set_rules('berat', 'Berat Produk', 'required|trim|numeric');

        
        $this->form_validation->set_message('required', '{field} harap di isi');
        $this->form_validation->set_message('numeric', '{field} harus angka');
        $this->form_validation->set_message('min_length', '{field} min {param} digit');
        $this->form_validation->set_message('max_length', '{field} max {param} digit');

        if($this->form_validation->run() == false){
            $output = [
                'type' => 'validation',
                'err_name' => form_error('name'),
                'err_price' => form_error('price'),
                'err_discount' => form_error('discount'),
                'err_berat' => form_error('berat'),
                'token' => $this->security->get_csrf_hash()
            ];
            $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($output));
        } else {
            $this->pv_product();
        }



    }

    private function pv_product(){
        $action = $this->input->post('action');

        switch($action){
            case 'add':
                
                $config['upload_path']          = './assets/img/product/';
                $config['allowed_types']        = 'jpeg|jpg|png|gif|svg|webp';
                $config['file_name']            = 'product_'.time();

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('images'))
                {
                    $msg = [
                        'msg' => $this->upload->display_errors(),
                        'type' => 'result',
                        'status' => false,
                        'token' => $this->security->get_csrf_hash()
                    ];
                    
                    $this->output
                    ->set_status_header(200)
                    ->set_content_type('application/json')
                    ->set_output(json_encode($msg));
                    die;
                }
                else
                {
                    $images =  $this->upload->data('file_name');
                }

                $data = [
                    'product_name' => htmlspecialchars($this->input->post('name')),
                    'product_desc' => htmlspecialchars($this->input->post('desc')),
                    'product_price' => htmlspecialchars($this->input->post('price')),
                    'product_images' => $images,
                    'product_stock' =>  '',
                    'product_discount' =>  htmlspecialchars($this->input->post('discount')),
                    'product_weight' => htmlspecialchars($this->input->post('berat')),
                    'create_at' => date('Y-m-d H:i:s'),
                    'last_update' => date('Y-m-d H:i:s')
                ];
                $this->db->insert('product', $data);
                
                if($this->db->affected_rows() > 0){
                    $params = [
                        'msg' => 'Produk berhasil di tambahkan',
                        'type' => 'result',
                        'status' => true,
                        'token' => $this->security->get_csrf_hash()
                    ];
                } else {
                    $params = [
                        'msg' => 'Produk gagal di tambahkan',
                        'type' => 'result',
                        'status' => false,
                        'token' => $this->security->get_csrf_hash()
                    ];
                }

                $this->output
                ->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode($params));
                
                break;
            case 'edit':
                $file = $_FILES['images']['name'];
                $id = htmlspecialchars($this->input->post('id'));

                $data = $this->db->where('md5(id)', $id)->get('product')->row();

                if($data){
                    if($file){
                        $config['upload_path']          = './assets/img/product/';
                        $config['allowed_types']        = 'jpeg|jpg|png|gif|svg|webp';
                        $config['file_name']            = 'product_'.time();
    
                        $this->load->library('upload', $config);
    
                        if (!$this->upload->do_upload('images'))
                        {
                            $msg = [
                                'msg' => $this->upload->display_errors(),
                                'type' => 'result',
                                'status' => false,
                                'token' => $this->security->get_csrf_hash()
                            ];
                            
                            echo json_encode($msg);
                            die;
                        }
                        else
                        {
                            $images =  $this->upload->data('file_name');
                            unlink(FCPATH.'assets/img/product/'. $data->product_images);
                        }
                    } else {
                        $images = $data->product_images;
                    }

                    $data = [
                        'product_name' => htmlspecialchars($this->input->post('name')),
                        'product_desc' => htmlspecialchars($this->input->post('desc')),
                        'product_price' => htmlspecialchars($this->input->post('price')),
                        'product_images' => $images,
                        'product_stock' =>  '',
                        'product_discount' =>  htmlspecialchars($this->input->post('discount')),
                        'product_weight' => htmlspecialchars($this->input->post('berat')),
                        'last_update' => date('Y-m-d H:i:s')
                    ];
                    $this->db->where('md5(id)', $id)->update('product', $data);
                    
                    if($this->db->affected_rows() > 0){
                        $params = [
                            'msg' => 'Produk berhasil di update',
                            'type' => 'result',
                            'status' => true,
                            'token' => $this->security->get_csrf_hash()
                        ];
                    } else {
                        $params = [
                            'msg' => 'Produk gagal di update',
                            'type' => 'result',
                            'status' => false,
                            'token' => $this->security->get_csrf_hash()
                        ];
                    }
                } else {
                    $params = [
                        'msg' => 'Produk not found',
                        'type' => 'result',
                        'status' => false,
                        'token' => $this->security->get_csrf_hash()
                    ];
                }
                
                $this->output
                    ->set_status_header(200)
                    ->set_content_type('application/json')
                    ->set_output(json_encode($params));
                break;
        }
    }

    public function form_action(){
        cek_ajax();
        $get_data_edit = $this->input->post('get_data_edit');
        $delete = $this->input->post('delete');

        if($get_data_edit){
            $get_data = $this->db->where('md5(id)', $get_data_edit)->get('product')->row();

            if(isset($get_data)){
                $data = [
                    'id' => md5($get_data->id),
                    'name' => $get_data->product_name,
                    'price' => $get_data->product_price,
                    'stock' => $get_data->product_stock,
                    'discount' => $get_data->product_discount,
                    'desc' => $get_data->product_desc,
                    'weight' => $get_data->product_weight
                ];
                $params= [
                    'status' => true,
                    'data' => $data,
                    'from' => 'get_data_edit',
                    'token' => $this->security->get_csrf_hash()
                ];
            } else {
                $params = [
                    'status' => false,
                    'msg' => 'Data not found',
                    'token' => $this->security->get_csrf_hash()
                ];
            }

            $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($params));
        } else if($delete){
            $get_data = $this->db->where('md5(id)', $delete)->get('product')->row();
            
            if(isset($get_data)){
                $this->db->delete('product', ['md5(id)' => $delete]);
                if($this->db->affected_rows() > 0){
                    $params = [
                        'status' => true,
                        'msg' => 'Data berhasil di hapus',
                        'token' => $this->security->get_csrf_hash(),
                        'from' => 'delete'
                    ];
                } else {
                    $params = [
                        'status' => true,
                        'msg' => 'Data gagal di hapus',
                        'token' => $this->security->get_csrf_hash()
                    ];
                }
            } else {
                $params = [
                    'status' => false,
                    'msg' => 'Data not found',
                    'token' => $this->security->get_csrf_hash()
                ];
            }
            $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($params));
        }

    }
}