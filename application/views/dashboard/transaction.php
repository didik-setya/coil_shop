<h4>Transaksi</h4>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-sm table-bordered" id="table_main">
                    <thead class="table-dark">
                        <tr>
                            <th>Waktu</th>
                            <th>User</th>
                            <th>Total</th>
                            <th>Bukti Pembayaran</th>
                            <th>Status</th>
                            <th><i class="fa fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal" id="modalEdit" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title " id="staticBackdropLabel">Edit Status</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('edit_status_checkout', 'id="form_status"') ?>
            <input type="hidden" name="id" id="id_status">
            <div class="modal-body">
                <div class="form-group my-2">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="">--pilih--</option>
                        <option value="2">Menunggu Pembayaran</option>
                        <option value="3">Menunggu Konfirmasi</option>
                        <option value="4">Packing</option>
                        <option value="5">Dikirim</option>
                        <option value="1">Selesai</option>
                        <option value="0">Batal</option>
                        <option value="9">Pengembalian</option>
                    </select>
                </div>

                <div class="form-group my-2 d-none" id="form-resi">
                    <label>Resi Pengiriman</label>
                    <input type="text" name="resi" id="resi" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal" id="modalDetail" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title" id="staticBackdropLabel">Detail Transaksi</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal" id="modalPayment" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h5 class="modal-title" id="staticBackdropLabel">Bukti Pembayaran</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>