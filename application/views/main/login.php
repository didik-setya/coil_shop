<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-12 col-sm-12 col-md-6 col-lg-5">
            <div class="text-center section__title">
                <h2>Halaman Login</h2>
            </div>
            <div class="text-center">
                <a href="<?= $link ?>" class="default__button"><i class="fa-brands fa-google"></i> Masuk dengan
                    Google</a>
            </div>
            <?php if($this->session->flashdata('err_msg')){ ?>
            <div class="alert alert-warning alert-dismissible fade show mt-5" role="alert">
                <strong>Error : </strong> <?= $this->session->flashdata('err_msg') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php } ?>
        </div>
    </div>
</div>