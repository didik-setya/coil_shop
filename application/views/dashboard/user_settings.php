<h4>Pengaturan Akun</h4>
<div class="row justify-content-center">
    <div class="col-md-9 col-lg-7">
        <div class="card">
            <div class="card-body">
                <?= form_open('edit_account_admin', 'id="form_account"') ?>
                <div class="form-group my-2">
                    <label><b>Email</b></label>
                    <input type="text" name="email" id="email" disabled class="form-control"
                        value="<?= $admin['email'] ?>">
                </div>

                <div class="form-group my-2">
                    <label><b>Nama</b></label>
                    <input type="text" name="name" id="name" required class="form-control"
                        value="<?= $admin['name'] ?>">
                </div>
                <button class="btn btn-sm btn-dark" type="button" onclick="edit_password()"><i class="fas fa-key"></i>
                    Edit Password</button>
                <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                <?= form_close() ?>
            </div>


        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Password</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('validation_password', 'id="form_password"') ?>
            <div class="modal-body">

                <div class="form-group my-2">
                    <label><b>Password Lama</b></label>
                    <input type="password" name="old_pass" id="old_pass" class="form-control">
                    <small class="text-danger" id="err_old_pass"></small>
                </div>

                <div class="form-group my-2">
                    <label><b>Password Baru</b></label>
                    <input type="password" name="new_pass" id="new_pass" class="form-control">
                    <small class="text-danger" id="err_new_pass"></small>
                </div>

                <div class="form-group my-2">
                    <label><b>Ulangi Password Baru</b></label>
                    <input type="password" name="renew_pass" id="renew_pass" class="form-control">
                    <small class="text-danger" id="err_renew_pass"></small>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            <?=form_close()?>
        </div>
    </div>
</div>