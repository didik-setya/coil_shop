<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>Checkout</h2>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12 col-lg-6">
            <div class="form-group my-2">
                <label for="name">Nama Lengkap *</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Nama Lengkap">
            </div>

            <div class="form-group my-2">
                <label for="email">Email *</label>
                <input type="text" id="email" email="email" class="form-control" placeholder="Email">
            </div>

            <div class="form-group my-2">
                <label for="no_telp">No. Telp *</label>
                <input type="text" id="no_telp" name="telp" class="form-control" placeholder="No. Telp">
            </div>


            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <div class="form-group my-2">
                        <label for="prov">Provinsi</label>
                        <select class="form-control" id="prov" name="prov">
                            <option value="">--pilih--</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="form-group my-2">
                        <label for="kab">Kabupaten</label>
                        <select class="form-control" id="kab" name="kab">
                            <option value="">--pilih--</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="form-group my-2">
                        <label for="kec">Kecamatan</label>
                        <select class="form-control" id="kec" name="kec">
                            <option value="">--pilih--</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="form-group my-2">
                        <label for="pos">Kode Pos</label>
                        <input type="text" name="pos" id="pos" class="form-control" placeholder="Kode Pos">
                    </div>
                </div>
            </div>

            <div class="form-group my-2">
                <label for="address">Alamat Lengkap</label>
                <textarea class="form-control" name="address" id="address" rows="3"></textarea>
            </div>

            <div class="form-group my-2">
                <label for="notes">Catatan</label>
                <textarea class="form-control" name="notes" id="notes" rows="3"></textarea>
            </div>
        </div>
        <div class="col-md-12 col-lg-6">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($cart as $c){ ?>
                    <tr>
                        <td>
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <img src="<?= $c['options']['img'] ?>" alt="image" class="w-100">
                                </div>
                                <div class="col-9">
                                    <h6><?= $c['options']['real_name'] ?></h6>
                                    <small><?= $c['qty'] ?> X Rp. <?= number_format($c['price']) ?></small>
                                </div>
                            </div>
                        </td>
                        <td>Rp. <?= number_format($c['subtotal']) ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total</th>
                        <th>Rp. <?= number_format($this->cart->total()) ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
</div>