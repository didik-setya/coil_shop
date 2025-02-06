<?php
defined('BASEPATH')or exit('No direct script access allowed');
class Ajax_users extends CI_Controller {
    public function load_data(){
        cek_ajax();
        $data = $this->get_data();
        $data_output = [];
        
        $no = 1;
        foreach($data as $d){
            $c_date = date_create($d->create_at);

            $row = [];
            $row[] = $no++;
            $row[] = '<img src="'.$d->image.'" width="70%">';
            $row[] = $d->nama;
            $row[] = $d->email;
            $row[] = date_format($c_date, 'd/m/Y H:i');

            $data_output[] = $row;
        }
        
        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->count_all_data(),
            "recordsFiltered" => $this->count_filtered_data(),
            "data" => $data_output,
        ];
        json_output($output, 200);
    }

    private function q_data(){
        $this->db->select('*')
        ->from('users')
        ->order_by('create_at', 'DESC');
    }

    private function f_data(){
        $this->q_data();
        $search = ['nama', 'email'];
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

    private function get_data(){
        $this->f_data();
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    private function count_all_data(){
        $this->q_data();
        return $this->db->count_all_results();
    }

    private function count_filtered_data(){
        $this->f_data();
        $query = $this->db->get();
        return $query->num_rows();
    }
}