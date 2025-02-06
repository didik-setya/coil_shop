<?php
defined('BASEPATH')or exit('No direct script access allowed');
class Ajax_transaction extends CI_Controller {
    public function load_data(){
        cek_ajax();
        $get_data = $this->checkout->get_data();
        $data_output = [];
        foreach($get_data as $gd){
            $row = [];
            $c_date = date_create($gd->create_at);
            if($gd->status == 2){
                $status = 'Menunggu Pembayaran';
            } else if($gd->status == 3){
                $status = 'Menunggu Konfirmasi';
            } else if($gd->status == 4){
                $status = 'Packing';
            } else if($gd->status == 5){
                $status = 'Di kirim';
            } else if($gd->status == 1){
                $status = 'Selesai';
            } else if($gd->status == 0){
                $status = 'Batal';
            } else if($gd->status == 9){
                $status = 'Pengembalian';
            } else {
                $status = 'Unknow'; 
            }

            $button = '
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-cogs"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#" onclick="detail_data(\''.md5($gd->id).'\')">Detail</a>
                        <a class="dropdown-item" href="#" onclick="edit_status(\''.md5($gd->id).'\', \''.$gd->status.'\')">Edit Status</a>
                    </div>
                </div>
            ';
            $img = '';
            if($gd->status != 2 && $gd->proof_transaction != ''){
                $img = '<img src="'.base_url('assets/img/transaction/') . $gd->proof_transaction.'" class="img_transaction" alt="img_payment" width="70%">';
            }

            $row[] = $gd->receipt_payment;
            $row[] = date_format($c_date, 'd/m/Y H:i');
            $row[] = $gd->nama.' ('.$gd->email.')';
            $row[] = 'Rp. '.number_format($gd->total_all);
            $row[] = $img;
            $row[] = $status;
            $row[] = $button;
            $data_output[] = $row;
        }
        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->checkout->count_all_data(),
            "recordsFiltered" => $this->checkout->filtered_all_data(),
            "data" => $data_output,
        ];
        json_output($output, 200);
    }

    public function edit_status(){
        cek_ajax();
        $id = htmlspecialchars($this->input->post('id'));
        $no_resi = htmlspecialchars($this->input->post('resi'));
        $status = htmlspecialchars($this->input->post('status'));

        if($status == 5){
            $update_data = [
                'status' => $status,
                'receipt_courier' => $no_resi
            ];
        } else {
            $update_data = [
                'status' => $status
            ];
        }

        $this->db->where('md5(id)', $id)->update('checkout', $update_data);

        if($this->db->affected_rows() > 0){
            $output = [
                'status' => true,
                'msg' => 'Status berhasil diubah',
                'token' => $this->security->get_csrf_hash()
            ];
        } else {
            $output = [
                'status' => false,
                'msg' => 'Status gagal diubah',
                'token' => $this->security->get_csrf_hash()
            ];
        }
        json_output($output, 200);
    }

    public function get_detail(){
        cek_ajax();
        $id = $this->input->post('id');
    }

    public function detail_checkout(){
        cek_ajax();
        $id = htmlspecialchars($this->input->post('id'));
        $data = $this->checkout->get_detail_checkout_all($id);
        $c_date = date_create($data['create_at']);
        $html_product = '';
        $html_receipt_courier = '';
        foreach($data['product'] as $pr){
            $html_product .= '
                <div class="row my-3 align-items-center">
                            <div class="col-3 col-sm-3 col-md-3 col-lg-2">
                                <img src="'.base_url('assets/img/product/').$pr->product_images.'" class="w-100" alt="image_product">
                            </div>
                            <div class="col-9 col-sm-9 col-md-9">
                                <span> '.$pr->product_name.'</span> <br>
                                <small class="text-muted">'.$pr->qty.' X Rp. '.number_format($pr->price).'</small>
                            </div>
                </div>
            ';
        }

        if($data['receipt_courier'] != ''){
            $html_receipt_courier = ' ['.$data['receipt_courier'].']';
        }




        $html = '
             <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                        <h5>Alamat Pengiriman</h5>
                        <span><i class="fas fa-user mr-2"></i> '.$data['to']->name.' ('.$data['to']->phone.')</span><br>
                        <span><i class="fas fa-map-marker-alt mr-2"></i> '.$data['to']->province. ', '.$data['to']->city.', '.$data['to']->distric.', '.$data['to']->subdistric.' ('.$data['to']->zipcode.') ['.$data['to']->address.']</span> <br>
                        <span><i class="fas fa-box mr-2"></i> '.$data['courier']->name .' ('.$data['courier']->service.') '.$html_receipt_courier.'</span><br>
                        <span><i class="fas fa-calendar mr-2"></i> '.date_format($c_date, 'd/m/Y H:i').'</span> <br>
                        <span><i class="far fa-sticky-note mr-2"></i> '.$data['to']->notes.'</span> <br>
                        <span><i class="fas fa-money-bill-wave mr-2"></i> '.$data['payment']->name.' ('.$data['payment']->value.')</span> <br>

                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                    '.$html_product.'
                    <table class="table table-sm table-bordered">
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-7">Ongkos Kirim</div>
                                    <div class="col-5 text-end">Rp. '.number_format($data['courier']->cost).'</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-7">Total Keseluruhan</div>
                                    <div class="col-5 text-end">Rp. '.number_format($data['total_all']).'</div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    </div>
            </div>
        ';
        echo $html;
    }
}