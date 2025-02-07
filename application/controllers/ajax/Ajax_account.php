<?php
defined('BASEPATH')or exit('No direct script access allowed');
class Ajax_account extends CI_Controller {
    public function edit_profile(){
        cek_ajax();
        $admin = get_admin();
        $new_name = htmlspecialchars($this->input->post('name', true));

        $this->db->set('nama', $new_name)->where('id', $admin['id'])->update('admin');
        if($this->db->affected_rows() > 0){
            $output = [
                'status' => true,
                'msg' => 'Profil berhasil di ubah',
                'token' => $this->security->get_csrf_hash()
            ];
        } else {
            $output = [
                'status' => false,
                'msg' => 'Profil gagal di ubah',
                'token' => $this->security->get_csrf_hash()
            ];
        }
        json_output($output, 200);
    }

    public function validation_password(){
        cek_ajax();
        $this->form_validation->set_rules('old_pass', 'Password Lama', 'required|trim');
        $this->form_validation->set_rules('new_pass', 'Password Baru', 'required|trim|min_length[5]|matches[renew_pass]');
        $this->form_validation->set_rules('renew_pass', 'Ulangi Password Baru', 'required|trim|matches[new_pass]');

        $this->form_validation->set_message('required', '{field} harap di isi');
        $this->form_validation->set_message('min_length', '{field} min {param} digit');
        $this->form_validation->set_message('matches', '{field} harus sama dengan {param}');

        if($this->form_validation->run() == false){
            $output = [
                'type' => 'validation',
                'err_old_pass' => form_error('old_pass'),
                'err_new_pass' => form_error('new_pass'),
                'err_renew_pass' => form_error('renew_pass'),
                'token' => $this->security->get_csrf_hash()
            ];
            echo json_encode($output);
            die;
        } else {
            $this->_edit_password();
        }
    }

    private function _edit_password(){
        $new_password = htmlspecialchars($this->input->post('new_pass'));
        $old_pass = htmlspecialchars($this->input->post('old_pass'));
        $encrypt_new_pass = md5(sha1($new_password));
        $encrypt_old_pass = md5(sha1($old_pass));
        
        $admin = get_admin();

        if($admin['pass'] == $encrypt_old_pass){
            if($admin['pass'] != $encrypt_new_pass){
                $this->db->set('password', $encrypt_new_pass)->where('id', $admin['id'])->update('admin');
                if($this->db->affected_rows() > 0){
                    $output = [
                        'type' => 'result',
                        'status' => true,
                        'msg' => 'Password berhasil di ubah',
                        'token' => $this->security->get_csrf_hash()
                    ];
                } else {
                    $output = [
                        'type' => 'result',
                        'status' => false,
                        'msg' => 'Password gagal di ubah',
                        'token' => $this->security->get_csrf_hash()
                    ];
                }

            } else {
                $output = [
                    'type' => 'result',
                    'status' => false,
                    'msg' => 'Password baru tidak boleh sama dengan password lama',
                    'token' => $this->security->get_csrf_hash()
                ];
            }
        } else {
            $output = [
                'type' => 'result',
                'status' => false,
                'msg' => 'Password lama salah',
                'token' => $this->security->get_csrf_hash()
            ];

        }
        json_output($output, 200);
    }
}