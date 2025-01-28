<h4>Produk</h4>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive">

                <button class="btn btn-sm btn-success mb-2" onclick="add_product()"><i class="fa fa-plus"></i></button>


                <table class="table table-sm table-bordered w-100" id="table_produk">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="10%">Image</th>
                            <th>Nama Poduk</th>
                            <th>Harga</th>
                            <th>Berat (gram)</th>
                            <th>Stock</th>
                            <th>Last Update</th>
                            <th width="10%"><i class="fa fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach($produk as $p){ 
                            $c_date = date_create($p->last_update);
                        ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><img src="<?= base_url('assets/img/product/' . $p->product_images) ?>" alt="images"
                                    class="w-100">
                            </td>
                            <td><?= $p->product_name ?></td>
                            <td>
                                <?php 
                                    if($p->product_discount > 0){
                                        $product_price = $p->product_price;
                                        $product_discount = $p->product_discount;
                                        $discount = $product_discount / 100 * $product_price;
                                        $price_discount = $product_price - $discount;

                                        echo '
                                            <small> <del>Rp. '.number_format($product_price).'</del></small><br>
                                            <span class="text-danger">Rp. '.number_format($price_discount).' (-'.$product_discount.'%)</span>
                                        ';
                                    } else {
                                        echo 'Rp. '. number_format($p->product_price);
                                    }

                                ?>
                            </td>
                            <td><?= $p->product_weight ?></td>
                            <td><?= $p->product_stock ?></td>
                            <td>
                                <?= date_format($c_date, 'd F Y H:i') ?>
                            </td>
                            <td>

                                <?= form_open('action_product', 'class="form_action"') ?>
                                <input type="hidden" name="get_data_edit" value="<?= md5($p->id) ?>">
                                <button type="submit" class="btn btn-sm btn-primary m-1">
                                    <i class="far fa-edit"></i>
                                </button>
                                <?= form_close() ?>

                                <?= form_open('action_product', 'class="form_action"') ?>
                                <input type="hidden" name="delete" value="<?= md5($p->id) ?>">
                                <button type="submit" class="btn btn-sm btn-danger m-1">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <?= form_close() ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal" id="modalProduct" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('verify_product', 'id="form_product"') ?>
            <input type="hidden" name="action" id="act">
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="id" id="id_product">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 form-group my-1">
                        <label>Nama Produk</label>
                        <input type="text" name="name" id="name" class="form-control">
                        <small class="text-danger" id="err_name"></small>
                    </div>

                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 form-group my-1">
                        <label>Harga Produk</label>
                        <input type="number" name="price" id="price" class="form-control" min="0">
                        <small class="text-danger" id="err_price"></small>
                    </div>

                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 form-group my-1">
                        <label>Stok Produk</label>
                        <input type="number" name="stock" id="stock" class="form-control" min="0">
                        <small class="text-danger" id="err_stock"></small>
                    </div>

                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 form-group my-1">
                        <label>Diskon (%)</label>
                        <input type="number" name="discount" id="discount" class="form-control" min="0" max="99">
                        <small class="text-danger" id="err_discount"></small>
                    </div>

                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 form-group my-1">
                        <label>Gambar Produk</label>
                        <input type="file" name="images" id="images" class="form-control multi-upload">
                    </div>

                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 form-group my-1">
                        <label>Berat Produk (gram)</label>
                        <input type="number" name="berat" id="berat" class="form-control" min="1">
                        <small class="text-danger" id="err_berat"></small>
                    </div>

                    <div class="col-12 form-group my-1">
                        <label>Deskripsi Produk</label>
                        <textarea name="desc" id="desc" class="form-control" required></textarea>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>