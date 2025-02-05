<style>
.about_payment span i {
    margin-right: 10px;
}
</style>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>Riwayat Transaksi</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <?php foreach($data as $main_data){ 
                $courier = $main_data['courier'];
                $to = $main_data['to'];
                $c_create_at = date_create($main_data['create_at']);
            ?>
            <div class="card my-2">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <span><?= $main_data['receipt_payment'] ?></span>
                        </div>
                        <div class="col-6 text-end">
                            <?php
                                switch($main_data['status']){
                                    case '2':
                                        echo '<span class="bg-warning px-2">Menunggu Pembayaran</span>';
                                        break;
                                    case '3':
                                        echo '<span class="bg-primary px-2">Menunggu Konfirmasi</span>';
                                        break;
                                    case '4':
                                        echo '<span class="bg-primary px-2">Packing</span>';
                                        break;
                                    case '5':
                                        echo '<span class="bg-primary px-2">Di Kirim</span>';
                                        break;
                                    case '1':
                                        echo '<span class="bg-success px-2">Selesai</span>';
                                        break;
                                    case '0':
                                        echo '<span class="bg-danger px-2">Batal</span>';
                                        break;
                                    case '9':
                                        echo '<span class="bg-danger px-2">Pengembalian</span>';
                                        break;
                                    default:
                                        echo '<span class="bg-secondary px-2">Unknow</span>';
                                        break;
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 about_payment">
                            <h5>Alamat Pengiriman</h5>
                            <span><i class="fa-regular fa-user"></i> <?= $main_data['to']['name'] ?></span> <span
                                class="text-muted">(<?= $main_data['to']['phone'] ?>)</span> <br>
                            <span><i class="fa-solid fa-location-dot"></i> <?php 
                                echo $to['province'] . ', '. $to['city'].', '. $to['distric']. ', '. $to['subdistric']. ', ('.$to['zipcode'].')' . '['.$to['address'].']';
                            ?></span> <br>
                            <span><i class="fa-solid fa-box"></i>
                                <?php
                                    echo $courier['name'] . ' ('.$courier['service'].') ';
                                    if($main_data['receipt_courier'] != null || $main_data['receipt_courier'] != ''){
                                        echo '[ '.$main_data['receipt_courier'].' ]';
                                    }
                                ?>
                            </span><br>
                            <span><i class="fa-solid fa-calendar-days"></i>
                                <?= date_format($c_create_at, 'd/m/Y H:i:s') ?></span>

                            <?php if($to['notes']){ ?>
                            <br>
                            <span><i class="fa-regular fa-clipboard"></i> <?= $to['notes'] ?></span>
                            <?php } ?> <br>
                            <span><i class="fa-solid fa-money-bill-1-wave"></i> <?= $main_data['payment'] ?></span>
                        </div>
                        <div class="col-md-6">
                            <?php foreach($main_data['sub_checkout'] as $md){ ?>
                            <div class="row my-3 align-items-center">
                                <div class="col-3 col-sm-3 col-md-3 col-lg-2">
                                    <img src="<?= base_url('assets/img/product/'). $md->product_images ?>" class="w-100"
                                        alt="image_product">
                                </div>
                                <div class="col-9 col-sm-9 col-md-9">
                                    <span><?= $md->product_name ?> </span> <br>
                                    <small
                                        class="text-muted"><?= $md->qty .' X Rp. '. number_format($md->price) ?></small>
                                </div>
                            </div>
                            <?php } ?>


                            <table class="table table-sm table-bordered">
                                <tr>
                                    <td>
                                        <div class="row">
                                            <div class="col-7">Ongkos Kirim</div>
                                            <div class="col-5 text-end">Rp. <?= number_format($courier['cost']) ?></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="row">
                                            <div class="col-7">Total Keseluruhan</div>
                                            <div class="col-5 text-end">Rp.
                                                <?= number_format($main_data['total_all']) ?></div>
                                        </div>
                                    </td>
                                </tr>

                            </table>

                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <?php if($main_data['status'] == 2){ ?>
                    <?= form_open_multipart('send_proof_payment', 'class="form_payment"') ?>
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="id" value="<?= $main_data['id'] ?>">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <label>Kirim Bukti Pembayaran</label>
                        </div>
                        <div class="col-7">
                            <input type="file" name="proof_transaction" class="form-control" required>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-primary w-100" type="submit"><i
                                    class="fa-regular fa-paper-plane"></i></button>
                        </div>
                    </div>
                    <?= form_close() ?>
                    <?php } else if($main_data['status'] == 3){ ?>
                    <?= form_open_multipart('send_proof_payment', 'class="form_payment"') ?>
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" value="<?= $main_data['id'] ?>">
                    <div class="row align-items-center justify-content-center my-2">
                        <div class="col-3">
                            <label>Bukti Pembayaran</label>
                        </div>
                        <div class="col-3 col-sm-3 col-md-2 col-lg-1">
                            <img src="<?= base_url('assets/img/transaction/') . $main_data['proof_transaction'] ?>"
                                alt="proof_payment" class="w-100">
                        </div>
                        <div class="col-6 col-sm-6 col-md-7 col-lg-8"></div>
                    </div>

                    <div class="row align-items-center my-2">
                        <div class="col-3">
                            <label>Edit Bukti Pembayaran</label>
                        </div>
                        <div class="col-7">
                            <input type="file" name="proof_transaction" class="form-control" required>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-primary w-100" type="submit"><i
                                    class="fa-solid fa-pen-to-square"></i></button>
                        </div>
                    </div>
                    <?= form_close() ?>
                    <?php } else { ?>
                    <div class="row align-items-center justify-content-center my-2">
                        <div class="col-3">
                            <label>Bukti Pembayaran</label>
                        </div>
                        <div class="col-3 col-sm-3 col-md-2 col-lg-1">
                            <img src="<?= base_url('assets/img/transaction/') . $main_data['proof_transaction'] ?>"
                                alt="proof_payment" class="w-100">
                        </div>
                        <div class="col-6 col-sm-6 col-md-7 col-lg-8"></div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

</div>