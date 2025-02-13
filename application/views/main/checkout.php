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
                <label>Alamat Pengiriman</label>
                <div class="bg-dark text-center" id="frame_selected_address">
                    <button type="button" class="btn btn-sm btn-primary my-3" onclick="search_address()">Cari
                        Alamat</button>
                </div>

            </div>
            <div class="form-group my-2">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="full_name" class="form-control" placeholder="Nama Lengkap"
                    value="<?= $user['name'] ?>">
                <small class="text-danger err_form" id="err_name"></small>
            </div>

            <div class="form-group my-2">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" class="form-control" placeholder="Email"
                    value="<?= $user['email'] ?>">
                <small class="text-danger err_form" id="err_email"></small>
            </div>

            <div class="form-group my-2">
                <label for="no_telp">No. Telp</label>
                <input type="text" id="no_telp" name="telp" class="form-control" placeholder="No. Telp">
                <small class="text-danger err_form" id="err_telp"></small>
            </div>




            <div class="form-group my-2">
                <label for="address">Alamat Lengkap</label>
                <textarea class="form-control" name="address" id="address" rows="3" required></textarea>
            </div>

            <div class="form-group my-2">
                <label for="notes">Catatan</label>
                <textarea class="form-control" name="notes" id="notes" rows="3"></textarea>
            </div>

        </div>
        <div class="col-md-12 col-lg-6 table-responsive">
            <?php $weight = 0; ?>
            <table class="table table-sm table-bordered mt-3 w-100" id="table_list_checkout">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_all_weight = 0;
                    $order = 1;
                    $a = 1;
                    $b = 1;
                    $c1 = 1;
                    $c2 = 1;
                    $c3 = 1;
                    foreach($cart as $c){ 
                        $total_weight = $c['options']['weight'] * $c['qty'];  
                        $total_all_weight += $total_weight;
                    ?>
                    <tr>
                        <input type="hidden" name="rowid[]" value="<?= $c['rowid'] ?>">
                        <td>
                            <div class="row align-items-center g-0">
                                <div class="col-4 text-center">
                                    <img src="<?= $c['options']['img'] ?>" alt="image" class="w-100">
                                </div>
                                <div class="col-8">
                                    <b><?= $c['options']['real_name'] ?></b> <br>
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
                    <input type="hidden" name="product_weight_subtotal"
                        value="<?php $weight = $c['options']['weight']; $qty = $c['qty']; $total_weight = $weight * $qty; echo $total_weight; ?>"
                        id="hidden_weight_subtotal_<?=$c2++?>" class="hidden_weight_subtotal">
                    <input type="hidden" name="product_weight" value="<?= $c['options']['weight'] ?>"
                        id="hidden_weight_<?=$c3++?>" class="hidden_weight">
                    <?php } ?>
                </tbody>
            </table>

            <input type="hidden" name="weight" id="weight" value="<?= $total_all_weight ?>">
            <input type="hidden" name="cost_courier" id="cost_courier" value="0">
            <input type="hidden" name="service_courier" id="service_courier">
            <input type="hidden" name="courier" id="hidden_courier">


            <input type="hidden" name="province" id="province">
            <input type="hidden" name="city" id="city">
            <input type="hidden" name="distric" id="distric">
            <input type="hidden" name="subdistric" id="subdistric">
            <input type="hidden" name="zipcode" id="zipcode">



            <div class="form-group my-2">
                <label>Pilih Kurir</label>
                <div class="bg-dark" id="frame_selected_courier">
                    <div class="text-center">
                        <button class="btn btn-sm btn-primary my-3" disabled type="button">Harap pilih
                            alamat
                            pengiriman</button>
                    </div>
                </div>
            </div>


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

            <table class="my-2 table table-sm table-bordered w-100">
                <tr>
                    <th>Total Produk</th>
                    <td id="show_total_product">Rp. <?= number_format($this->cart->total()) ?></td>
                    <input type="hidden" name="total_all_product" id="total_all_product"
                        value="<?=$this->cart->total()?>">
                </tr>
                <tr>
                    <th>Ongkos Kirim</th>
                    <td id="show_ongkir">Rp. 0</td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td id="show_total_all">Rp. <?= number_format($this->cart->total()) ?></td>
                </tr>
            </table>

            <div class="text-center py-4">
                <button class="btn btn-sm btn-primary" type="submit">Buat Pesanan</button>
            </div>

        </div>
    </div>
    <?= form_close() ?>
</div>


<!-- Modal -->
<div class="modal" id="modalSearchAddress" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-md-down modal-lg  modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Cari Alamat</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= form_open('search_address', 'id="form_search_address"'); ?>
                <div class="input-group">
                    <input type="text" class="form-control" aria-describedby="inputGroupFileAddon04" aria-label="Upload"
                        name="input_req" id="input_req" placeholder="Masukan nama wilayah atau kode pos" required>
                    <button class="btn btn-outline-primary" type="submit" id="inputGroupFileAddon04"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </div>
                <?= form_close() ?>

                <div id="search_result">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modalSelectCourier" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-md-down modal-lg  modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Pilih Kurir</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Pilih Kurir</label>
                    <select name="select_courier" id="select_courier" class="form-control">
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
                    </select>
                </div>

                <div id="frame_select_service_courier">

                </div>


            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    const modalCourier = document.getElementById("modalSelectCourier");
    modalCourier.addEventListener("show.bs.modal", function() {
        window.scrollTo(0, 0);
    });
});
</script>