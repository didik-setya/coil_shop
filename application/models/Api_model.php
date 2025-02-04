<?php
defined('BASEPATH')or exit('No direct script access allowed');
class Api_model extends CI_Model {
    public function calculate_courir_cost($from, $to, $weight, $courir){
        $api_key = $this->config->item('rajaongkir_key');
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_HTTPHEADER => array(
            "key: " . $api_key
        ),
        CURLOPT_POSTFIELDS => array(
            "origin" => $from,
            "destination" => $to,
            "weight" => $weight,
            "courier" => $courir
        )
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        $msg = "cURL Error #:" . $err;
        $output = [
            'status' => true,
            'msg' => $msg
        ];
        } else {
            $decode_response = json_decode($response);
            if($decode_response->meta->code == 200){
                $output = [
                    'status' => true,
                    'data' => $decode_response->data
                ];
            } else {
                $output = [
                    'status' => false,
                    'msg' => $decode_response->meta->message
                ];
            }

        }
    json_output($output, 200);

    }

    public function check_courier_cost($to, $weight, $courir, $service){
        $settings = $this->db->get_where('settings', ['id' => 1])->row()->shipping_point;
        $decode_settings = json_decode($settings);
        $from = $decode_settings->zip_code;

        $api_key = $this->config->item('rajaongkir_key');
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_HTTPHEADER => array(
            "key: " . $api_key
        ),
        CURLOPT_POSTFIELDS => array(
            "origin" => $from,
            "destination" => $to,
            "weight" => $weight,
            "courier" => $courir
        )
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);


        if($err){
            $msg = "cURL Error #:" . $err;
            $output = [
                'type' => 'result',
                'status' => false,
                'msg' => $msg,
                'token' => $this->security->get_csrf_hash()
            ];
            json_output($output, 200);
        
        } else {
            $decode_response = json_decode($response);
            if($decode_response->meta->code == 200){
                $data = $decode_response->data;

                $output_data = [];
                foreach($data as $d){
                    if($d->service == $service){
                        $output_data = [
                            'cost' => $d->cost,
                            'code' => $d->code,
                            'name' => $d->name,
                            'service' => $d->service,
                        ];
                    }
                }
                return $output_data;
                
            } else {
                $output = [
                    'type' => 'result',
                    'status' => false,
                    'msg' => $decode_response->meta->message,
                    'token' => $this->security->get_csrf_hash()
                ];
                json_output($output, 200);
            }
        }

    }
}