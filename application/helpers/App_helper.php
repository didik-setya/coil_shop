<?php
function cek_ajax(){
    $CI = get_instance();
    if (!$CI->input->is_ajax_request()) {
        exit('No direct script access allowed');
    }
}

function cek_login_admin(){
    $CI = get_instance();
    if ($CI->session->userdata('email')) {
        redirect('dashboard');
    }
}

function get_admin(){
    $CI = get_instance();
    $email = $CI->session->userdata('email');
    $admin = $CI->db->get_where('admin', ['email' => $email])->row();

    if($admin){
        $out = [
            'name' => $admin->nama,
            'email' => $admin->email,
            'image' => base_url('assets/img/user/') . $admin->image
        ];
        return $out;
    } else {
        redirect(base_url('auth/logout'));
    }
}


function get_users(){
    $ci = get_instance();
    $email = $ci->session->userdata('user_email');

    if($email){
        $user = $ci->db->get_where('users', ['email' => $email])->row();
        if($user){
            $data = [
                'name' => $user->nama,
                'email' => $user->email,
                'id' => md5(sha1($user->id)),
                'decode_id' => $user->id
            ];
        } else {
           $data = null;
        }
    } else {
        $data = null;
    }
    return $data;
}

function json_output($output, $status){
    $ci = get_instance();
    
    $ci->output
    ->set_status_header($status)
    ->set_content_type('application/json')
    ->set_output(json_encode($output));
}