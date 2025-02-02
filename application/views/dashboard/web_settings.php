<h4>Pengaturan Web</h4>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-dark text-light">
                <h6>Kebijakan Privasi & Pengembalian</h6>
            </div>
            <div class="card-body">
                <?= form_open('change_settings', 'class="form_settings"') ?>
                <input type="hidden" name="action" value="policy">
                <div class="form-group mb-3">
                    <label><strong>Kebijakan Privasi</strong></label>
                    <textarea name="privacy" id="privacy" class="form-control" rows="4" required><?= $data->privacy_policy ?>
                    </textarea>
                </div>

                <div class="form-group mb-3">
                    <label><strong>Kebijakan Pengembalian</strong></label>
                    <textarea name="refund" id="refund" class="form-control" required
                        rows="4"><?= $data->refund_policy ?></textarea>
                </div>
                <button class="btn btn-sm btn-primary" type="submit">Simpan</button>
                <?= form_close() ?>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header bg-dark text-light">
                <h6>Alamat</h6>
            </div>
            <div class="card-body">
                <?= form_open('change_settings', 'class="form_settings"') ?>
                <input type="hidden" name="action" value="address">
                <div class="form-group">
                    <label><b>Alamat</b></label>
                    <textarea name="address" id="address" class="form-control" rows="4"><?= $data->address ?>
                    </textarea>
                </div>
                <button class="btn btn-sm btn-primary" type="submit">Simpan</button>
                <?= form_close() ?>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header bg-dark text-light">
                <h6>Kontak</h6>
            </div>
            <div class="card-body">
                <button class="btn btn-sm btn-success mb-3" onclick="add_form_contact()">Tambah Form</button>

                <?= form_open('change_settings', 'class="form_settings"') ?>
                <input type="hidden" name="action" value="contact">
                <table class="table table-sm table-bordered" id="table_form">
                    <thead class="table-primary">
                        <tr>
                            <th>Nama</th>
                            <th>Value</th>
                            <th><i class="fa fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $decode_contact = json_decode($data->contact);
                            foreach($decode_contact as $c){
                        ?>
                        <tr>
                            <td>
                                <input type="text" name="name_contact[]" required class="form-control"
                                    value="<?= $c->name ?>">
                            </td>
                            <td>
                                <input type="text" name="value_contact[]" required class="form-control"
                                    value="<?= $c->value ?>">
                            </td>
                            <td>
                                <button class="btn btn-sm btn-danger remove_row_contact" type="button">
                                    <i class="far fa-times-circle"></i>
                                </button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <button class="btn btn-sm btn-primary mt-3" type="submit">Simpan</button>
                <?= form_close() ?>

            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header bg-dark text-light">
                <h6>Akun Pembayaran</h6>
            </div>
            <div class="card-body">
                <?= form_open('change_settings', 'class="form_settings"') ?>
                <input type="hidden" name="action" value="payment_account">

                <button class="btn btn-sm btn-success mb-3" type="button" onclick="add_form_payment()">Tambah
                    Form</button>
                <table class="table table-sm table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th>Name</th>
                            <th>Value</th>
                            <th width="5%"><i class="fa fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody id="tbody_payment">
                        <?php
                            $i = 1;
                            $o = 1;
                            $decode_payment = json_decode($data->payment_account);
                            foreach($decode_payment as $p){
                        ?>
                        <tr>
                            <td>
                                <select name="payment_name[]" id="payment" class="form-control" required>
                                    <option value="">--pilih--</option>
                                    <?php 
                                        $data_payment = json_decode($payment);
                                        foreach($data_payment as $dp){
                                    ?>
                                    <?php if($p->name == $dp->name){ ?>
                                    <option value="<?= $dp->name ?>" selected>
                                        <?= $dp->name ?>
                                    </option>
                                    <?php } else { ?>
                                    <option value="<?= $dp->name ?>">
                                        <?= $dp->name ?>
                                    </option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="payment_value[]" id="value" class="form-control" required
                                    value="<?= $p->value; ?>">
                            </td>
                            <td>
                                <button class="btn btn-sm btn-danger remove_form_payment" type="button"><i
                                        class="far fa-times-circle"></i></button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <button class="btn btn-sm btn-primary mt-3" type="submit">Simpan</button>
                <?= form_close() ?>

                <div id="form_payment" class="d-none">
                    <table>
                        <tr>
                            <td>
                                <select name="payment_name[]" id="payment" class="form-control" required>
                                    <option value="">--pilih--</option>
                                    <?php 
                                        $data_payment = json_decode($payment);
                                        foreach($data_payment as $dp){
                                    ?>
                                    <option value="<?= $dp->name ?>">
                                        <?= $dp->name ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="payment_value[]" id="value" class="form-control" required>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-danger remove_form_payment" type="button"><i
                                        class="far fa-times-circle"></i></button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header bg-dark text-light">
                <h6>Kurir</h6>
            </div>
            <div class="card-body table-responsive">
                <button type="button" class="btn btn-sm btn-success mb-3" onclick="add_form_courir()">Tambah
                    Form</button>
                <?= form_open('change_settings', 'class="form_settings"') ?>
                <input type="hidden" name="action" value="courir">
                <table class="table table-bordered table-sm">
                    <thead class="table-primary">
                        <tr>
                            <th>Kurir</th>
                            <th width="20%"><i class="fa fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody id="tbody_courir">
                        <?php
                            $decode_courir = json_decode($data->shipping);
                            foreach($decode_courir as $c){
                        ?>
                        <tr>
                            <td>
                                <select name="courir_name[]" id="courir_name" class="form-control" selected>
                                    <option value="">--pilih--</option>
                                    <?php
                                    $decode_courir = json_decode($courir);
                                    foreach($decode_courir as $dc){
                                    ?>
                                    <?php if($c->code == $dc->code){ ?>
                                    <option value="<?= $dc->code ?>" selected><?= $dc->name ?></option>
                                    <?php } else { ?>
                                    <option value="<?= $dc->code ?>"><?= $dc->name ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger remove_form_courir"><i
                                        class="far fa-times-circle"></i></button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-sm btn-primary mt-3">Simpan</button>
                <?= form_close() ?>


                <div id="form_courir" class="d-none">
                    <table>
                        <tr>
                            <td>
                                <select name="courir_name[]" id="courir_name" class="form-control" selected>
                                    <option value="">--pilih--</option>
                                    <?php
                                    $decode_courir = json_decode($courir);
                                    foreach($decode_courir as $dc){
                                    ?>
                                    <option value="<?= $dc->code ?>"><?= $dc->name ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger remove_form_courir"><i
                                        class="far fa-times-circle"></i></button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header bg-dark text-light">
                <h6>Titik Pengiriman</h6>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-sm table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th>Provinsi</th>
                            <th>Kabupaten</th>
                            <th>Kecamatan</th>
                            <th>Desa</th>
                            <th>Kode Pos</th>
                            <th><i class="fa fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $decode_point = json_decode($data->shipping_point);
                            
                            foreach($decode_point as $dp){
                        ?>
                            <td><?= $dp ?></td>
                            <?php } ?>
                            <td>
                                <button class="btn btn-sm btn-primary" type="button"><i
                                        class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>