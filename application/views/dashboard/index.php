<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?= base_url('assets/admin/') ?>img/logo/logo.png" rel="icon">
    <title><?= $title ?></title>
    <link href="<?= base_url('assets/admin/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet"
        type="text/css">
    <link href="<?= base_url('assets/admin/') ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"
        type="text/css">
    <link href="<?= base_url('assets/admin/') ?>css/ruang-admin.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/admin/') ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


    <style>
    .MultiFile-list .MultiFile-label {
        margin: 10px 0px 10px 0px;
        outline: 1px solid #707070;
        padding: 10px 5px;
    }

    .MultiFile-list .MultiFile-label span {
        outline: none;
    }

    .MultiFile-list .MultiFile-label a {
        color: #a82525;
    }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center bg-dark"
                href="<?= base_url('dashboard') ?>">
                <div class="sidebar-brand-icon">
                    <img src="<?= base_url('assets/admin/') ?>img/logo/logo2.png">
                </div>
                <div class="sidebar-brand-text mx-3">RuangAdmin</div>
            </a>
            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('dashboard') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('product') ?>">
                    <i class="fas fa-boxes"></i>
                    <span>Produk</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('users') ?>">
                    <i class="fas fa-users"></i>
                    <span>User</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('transaction') ?>">
                    <i class="far fa-money-bill-alt"></i>
                    <span>Transaksi</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('web_settings') ?>">
                    <i class="fas fa-cogs"></i>
                    <span>Pengaturan Web</span></a>
            </li>

            <div id="version-ruangadmin" class="text-center d-none"></div>

        </ul>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top bg-dark">
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle bg-white" src="<?= $admin['image'] ?>"
                                    style="max-width: 60px">
                                <span class="ml-2 d-none d-lg-inline text-white small"><?= $admin['name'] ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

                                <a class="dropdown-item" href="<?= base_url('settings_admin') ?>">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>

                                <a class="dropdown-item" href="<?= base_url('auth/logout') ?>">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>
                </nav>
                <!-- Topbar -->

                <!-- Container Fluid-->
                <div class="container-fluid" id="container-wrapper">

                    <?php $this->load->view($view) ?>

                </div>
                <!---Container Fluid-->
            </div>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>copyright &copy; <script>
                            document.write(new Date().getFullYear());
                            </script> </b>
                        </span>
                    </div>
                </div>
            </footer>
            <!-- Footer -->
        </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="<?= base_url('assets/admin/') ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/admin/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/admin/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?= base_url('assets/admin/') ?>js/ruang-admin.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= base_url('assets/admin/') ?>vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/admin/') ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script>
    const base_url = '<?= base_url() ?>'

    function loading_animation() {
        Swal.fire({
            title: 'Loading..',
            html: 'Please wait..',
            timerProgressBar: true,
            draggable: true,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading()
            },
        })
    }

    function regenerate_token(token) {
        const c_name = '<?= $this->security->get_csrf_token_name() ?>'
        $('input[name="' + c_name + '"]').val(token)
    }
    </script>
    <?php
    if(isset($js)){
        foreach($js as $j){
            echo '<script src="'.base_url('assets/js/').$j.'"></script>';
        }
    }
    ?>

</body>

</html>