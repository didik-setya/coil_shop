<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
    public function index(){
        cek_login_admin();
        $this->load->view('auth/index');
    }

    public function verify_login(){
        cek_ajax();
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if($this->form_validation->run() == false){
            $output = [
                'type' => 'validation',
                'err_email' => form_error('email'),
                'err_password' => form_error('password'),
                'token' => $this->security->get_csrf_hash()
            ];

            $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($output));
        } else {
            $this->_verify_login();
        }

    }

    private function _verify_login(){
        $email = htmlspecialchars($this->input->post('email', true));
        $password = md5(sha1($this->input->post('password')));

        $data_user = $this->db->get_where('admin', ['email' => $email, 'password' => $password])->row();

        if($data_user){
            $data_session = [
                'email' => $data_user->email
            ];

            $this->session->set_userdata($data_session);

            $output = [
                'type' => 'result',
                'status' => true,
                'message' => 'Login success',
                'redirect' => base_url('dashboard'),
            ];
        } else {
            $output = [
                'type' => 'result',
                'status' => false,
                'message' => 'Invalid email or password',
                'token' => $this->security->get_csrf_hash()
            ];
        }
        $this->output
        ->set_status_header(200)
        ->set_content_type('application/json')
        ->set_output(json_encode($output));
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('auth');
    }
}