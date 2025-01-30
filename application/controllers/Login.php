<?php
defined('BASEPATH')or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
require './vendor/autoload.php';


class Login extends CI_Controller {

    protected $googleClient;
    public function __construct(){
        parent::__construct();
      
        $this->googleClient = new Google_Client();
        $this->googleClient->setClientId('1031530001976-l6hrq4enbp6hf1ru6dd4g165jojemv09.apps.googleusercontent.com');
        $this->googleClient->setClientSecret('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');
        $this->googleClient->setRedirectUri('http://localhost/coil_vape/login/verify_google_oauth');

        $this->googleClient->addScope('openid');
        $this->googleClient->addScope('profile');
        $this->googleClient->addScope('email');
    }

    public function index(){
        $user = get_users();

        if($user != null){
            redirect(base_url());
        } else {
            $data = [
                'title' => 'Login | RQ Coil Builders',
                'view' => 'main/login',
                'link' => $this->googleClient->createAuthUrl()
            ];
            $this->load->view('main/index', $data);
        }
    }

   public function verify_google_oauth(){
    if (isset($_GET['code'])) {
        $token = $this->googleClient->fetchAccessTokenWithAuthCode($_GET['code']);

        if(!isset($token['error'])){
            $this->googleClient->setAccessToken($token);

            $service = new Google_Service_Oauth2($this->googleClient);
            $userinfo = $service->userinfo->get();

            $name = $userinfo->name;
            $email = $userinfo->email;
            $picture = $userinfo->picture;

            $this->pv_login($name, $email, $picture);
        } else {
            $this->session->set_flashdata('err_msg', 'Error to login');
            redirect(base_url('login'));
        }
    } else {
        redirect(base_url());
    }
   }

   private function pv_login($name, $email, $picture){
    $get_available_user = $this->db->get_where('users', ['email' =>$email])->row();
    if(!$get_available_user){
        $data = [
            'nama' => $name,
            'email' => $email,
            'image' => $picture,
            'create_at' => date('Y-m-d H:i:s'),
            'last_update' => date('Y-m-d H:i:s'),
        ];
        $this->db->insert('users', $data);
    }

    $sess_data = ['user_email' => $email];
    $this->session->set_userdata($sess_data);
    redirect(base_url());
   }

   public function logout(){
    $this->session->sess_destroy();
    redirect(base_url());
   }
}