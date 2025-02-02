<?php
defined('BASEPATH')or exit('No direct script access allowed');
class Ajax_settings extends CI_Controller {
    public function update_settings(){
        cek_ajax();
        $action = htmlspecialchars($this->input->post('action'));
        switch($action){
            case 'policy':
                $data = [
                    'privacy_policy' => htmlspecialchars($this->input->post('privacy')),
                    'refund_policy' => htmlspecialchars($this->input->post('refund')),
                ];
                $this->_update_settings(1, $data);
                break;
            case 'address':
                $data = [
                    'address' => htmlspecialchars($this->input->post('address')),
                ];
                $this->_update_settings(1, $data);
                break;
            case 'contact':
                $input_name_contact = $this->input->post('name_contact');
                $input_value_contact = $this->input->post('value_contact');

                $jml_contact = count($input_name_contact);

                $data = [];
                for($i = 0; $i < $jml_contact; $i++){
                    $row = [
                        'name' => htmlspecialchars($input_name_contact[$i]),
                        'value' => htmlspecialchars($input_value_contact[$i])
                    ];
                    $data[] = $row;
                }


                $encode_data = json_encode($data);
                $update_data = ['contact'=>$encode_data];
                $this->_update_settings(1, $update_data);
                break;
            case 'payment_account':
                    $payment_name = $this->input->post('payment_name');
                    $payment_value = $this->input->post('payment_value');
                    $count = count($payment_name);
                    $data = [];
                    for($i = 0; $i < $count; $i++){
                        $row = [
                            'name' => htmlspecialchars($payment_name[$i]),
                            'value' =>  htmlspecialchars($payment_value[$i])
                        ];
                        $data[] = $row;
                    }
                  

                    $encode_data = json_encode($data);
                    $data = ['payment_account' => $encode_data];
                    $this->_update_settings(1, $data);
                break;
            case 'courir':
                $courir_code = $this->input->post('courir_name');
                $count = count($courir_code);
                
                $data = [];
                for($i = 0; $i < $count; $i++){
                    $row = [
                        'code' => htmlspecialchars($courir_code[$i])
                    ];
                    $data[] = $row;
                }

                $encode_data = json_encode($data);
                $data = ['shipping' => $encode_data];
                $this->_update_settings(1, $data);
                break;
        }
        
    }

    private function _update_settings($id, $data){
        $this->db->where('id', $id)->update('settings', $data);
        if($this->db->affected_rows() > 0){
            $msg = [
                'status' => true,
                'msg' => 'Pengaturan berhasil di update',
                'token' => $this->security->get_csrf_hash()
            ];
        } else {
            $msg = [
                'status' => false,
                'msg' => 'Pengaturan gagal di update',
                'token' => $this->security->get_csrf_hash()
            ];
        }
        $this->output
        ->set_status_header(200)
        ->set_content_type('application/json')
        ->set_output(json_encode($msg));
    }
}