<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>Checkout</h2>
        </div>
    </div>


    <?= form_open('validation_checkout', 'id="form_checkout"') ?>
    <div class="row">
        <div class="col-md-12 col-lg-6">
            <div class="form-group my-2">
                <label for="name">Nama Lengkap *</label>
                <input type="text" id="name" name="full_name" class="form-control" placeholder="Nama Lengkap"
                    value="<?= $user['name'] ?>">
                <small class="text-danger" id="err_name"></small>
            </div>

            <div class="form-group my-2">
                <label for="email">Email *</label>
                <input type="text" id="email" name="email" class="form-control" placeholder="Email"
                    value="<?= $user['email'] ?>">
                <small class="text-danger" id="err_email"></small>
            </div>

            <div class="form-group my-2">
                <label for="no_telp">No. Telp *</label>
                <input type="text" id="no_telp" name="telp" class="form-control" placeholder="No. Telp">
                <small class="text-danger" id="err_telp"></small>
            </div>


            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <div class="form-group my-2">
                        <label for="province">Provinsi</label>
                        <select class="form-control" id="province" name="province" required>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="form-group my-2">
                        <label for="city">Kabupaten</label>
                        <select class="form-control" id="city" name="city" required>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="form-group my-2">
                        <label for="distric">Kecamatan</label>
                        <select class="form-control" id="distric" name="distric" required>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="form-group my-2">
                        <label for="subdistric">Desa</label>
                        <select class="form-control" id="subdistric" name="subdistric" required>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group my-2">
                        <label for="zipcode">Kode Pos</label>

                        <input type="hidden" name="hidden_city" id="hidden_city" class="form-control">
                        <input type="hidden" name="hidden_distric" id="hidden_distric" class="form-control">
                        <select name="zipcode" id="zipcode" class="form-control" required></select>
                    </div>
                </div>
            </div>

            <div class="form-group my-2">
                <label for="address">Alamat Lengkap</label>
                <textarea class="form-control" name="address" id="address" rows="3" required></textarea>
            </div>

            <div class="form-group my-2">
                <label for="notes">Catatan</label>
                <textarea class="form-control" name="notes" id="notes" rows="3"></textarea>
            </div>

            <div class="row">

                <div class="col-12">
                    <label for="courir">Kurir</label>
                    <div class="form-group my-2">
                        <select class="form-control" id="courir" name="courir" required>

                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group my-2">
                        <label for="sub_courir">Layanan Kurir</label>
                        <select name="sub_courir" id="sub_courir" class="form-control">
                        </select>
                    </div>


                    <div id="select_courier" class="d-none">
                        <option value="">--pilih--</option>
                        <?php 
                                $decode_courir = json_decode($courir);
                                $selected_courir = json_decode($settings->shipping);
                                foreach($selected_courir as $sc){
                                foreach($decode_courir as $dc){
                                if($sc->code == $dc->code){
                                    echo '<option value="'.$dc->code.'">'.$dc->name.'</option>';
                                }
                            }
                        }
                        ?>
                    </div>

                </div>
            </div>

        </div>
        <div class="col-md-12 col-lg-6">
            <table class="table table-sm table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $weight = 0;
                    $order = 1;
                    $a = 1;
                    $b = 1;
                    $c1 = 1;
                    foreach($cart as $c){ 
                        $weight += $c['options']['weight'] * $c['qty'];    
                    ?>
                    <tr>
                        <input type="hidden" name="rowid[]" value="<?= $c['rowid'] ?>">
                        <td>
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <img src="<?= $c['options']['img'] ?>" alt="image" class="w-100">
                                </div>
                                <div class="col-9">
                                    <h6><?= $c['options']['real_name'] ?></h6>
                                    <small data-price="<?= $c['price'] ?>" id="product_price_<?=$a++?>">Rp.
                                        <?= number_format($c['price']) ?></small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <input type="number" name="qty_product[]" id="qty_product" class="form-control qty_product"
                                value="<?= $c['qty'] ?>" required min="1" max="100" data-ord="<?= $order++ ?>">
                        </td>
                        <td id="product_subtotal_<?=$b++?>">
                            Rp. <?= number_format($c['subtotal']) ?>
                        </td>
                    </tr>
                    <input type="hidden" name="product_subtotal" value="<?= $c['subtotal'] ?>"
                        id="hidden_subtotal_<?=$c1++?>" class="hidden_subtotal">
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2">Total Produk</th>
                        <th id="show_total_product">Rp. <?= number_format($this->cart->total()) ?>
                        </th>
                        <input type="hidden" name="total_product" id="total_product"
                            value="<?= $this->cart->total() ?>">
                    </tr>
                    <tr>
                        <th colspan="2">Ongkos Kirim</th>
                        <th id="show_ongkir"></th>
                    </tr>
                    <tr>
                        <th colspan="2">Total Keseluruhan</th>
                        <th id="show_total_all">
                        </th>
                        <input type="hidden" name="total_all" id="total_all">
                    </tr>
                </tfoot>
            </table>
            <input type="hidden" name="weight" id="weight" value="<?= $weight ?>">
            <input type="hidden" name="cost_courier" id="cost_courier" value="0">
            <input type="hidden" name="service_courier" id="service_courier">

            <div class="form-group my-2">
                <label for="payment">Pembayaran</label>
                <select name="payment" id="payment" class="form-control" required>
                    <option value="">--pilih--</option>
                    <?php 
                    $data_payment = json_decode($settings->payment_account);
                    $decode_payement = json_decode($payment);

                    foreach($data_payment as $dp){
                        foreach($decode_payement as $jp){
                            if($dp->name == $jp->name){
                                echo '<option value="'.$dp->name.'">'.$dp->name.'</option>';
                            }
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="text-center py-4">
                <button class="btn btn-sm btn-primary" type="submit">Buat Pesanan</button>
            </div>

        </div>
    </div>
    <?= form_close() ?>
</div>