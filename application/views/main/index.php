<!doctype html>
<html class="no-js is_dark" lang="zxx" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $title ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/img/web/logo.png') ?>">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="<?= base_url('assets/main/') ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/main/') ?>css/animate.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/main/') ?>css/magnific-popup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.cdnfonts.com/css/futura-std-4">
    <link rel="stylesheet" href="<?= base_url('assets/main/') ?>css/slick.css">
    <link rel="stylesheet" href="<?= base_url('assets/main/') ?>css/style.css">
    <link rel="stylesheet" href="@sweetalert2/theme-dark/dark.css">



</head>


<body>


    <main class="main_wrapper body__overlay overflow__hidden">

        <!-- header__topbar__start -->
        <div class="header__topbar desktop__menu__wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7 col-lg-7">
                        <div class="header__topbar__left">
                            <ul>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                        <rect x="48" y="96" width="416" height="320" rx="40" ry="40" fill="none"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="32" />
                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="32" d="M112 160l144 112 144-112" />
                                    </svg>example@example.com
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                        <path
                                            d="M256 48c-79.5 0-144 61.39-144 137 0 87 96 224.87 131.25 272.49a15.77 15.77 0 0025.5 0C304 409.89 400 272.07 400 185c0-75.61-64.5-137-144-137z"
                                            fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="32" />
                                        <circle cx="256" cy="192" r="48" fill="none" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                                    </svg>Jember, Jawa Timur
                                </li>
                            </ul>

                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <div class="header__topbar__right">

                            <div class="header__topbar__social__icon">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-tiktok"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header__topbar__end -->


        <!-- header section start -->
        <header>
            <div class="headerarea header__sticky">
                <div class="container desktop__menu__wrapper">
                    <div class="row common__row position-relative">
                        <div class="col-xl-2 col-lg-2 col-md-6">
                            <div class="headerarea__logo">
                                <a href="<?= base_url() ?>"><img src="<?= base_url('assets/img/web/logo50.png') ?>"
                                        alt="logo"></a>
                            </div>
                        </div>


                        <div class="col-xl-7 col-lg-7 col-md-6 main_menu_wrap">

                            <div class="headerarea__main__menu ">
                                <nav>
                                    <ul>
                                        <li><a href="#">Home</a> </li>
                                        <li><a href="#">New Product</a> </li>
                                        <li><a href="#">All Product</a> </li>
                                        <li><a href="#">About</a> </li>
                                    </ul>
                                </nav>
                            </div>

                        </div>


                        <div class="col-xl-3 col-lg-3 col-md-6">

                            <div class="headerarea__right">

                                <ul class="headerarea__right__nav">
                                    <li>
                                        <div class="setting__wrap cursor__pointer">
                                            <div class="setting__wrap__active">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="ionicon"
                                                    viewBox="0 0 512 512">
                                                    <path
                                                        d="M344 144c-3.92 52.87-44 96-88 96s-84.15-43.12-88-96c-4-55 35-96 88-96s92 42 88 96z"
                                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="32" />
                                                    <path
                                                        d="M256 304c-87 0-175.3 48-191.64 138.6C62.39 453.52 68.57 464 80 464h352c11.44 0 17.62-10.48 15.65-21.4C431.3 352 343 304 256 304z"
                                                        fill="none" stroke="currentColor" stroke-miterlimit="10"
                                                        stroke-width="32" />
                                                </svg>

                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="headermiddle__bar cursor__pointer">
                                            <div class="headermiddle__account">
                                                <div class="headermiddle__account__img">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon"
                                                        viewBox="0 0 512 512">
                                                        <circle cx="176" cy="416" r="16" fill="none"
                                                            stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="32" />
                                                        <circle cx="400" cy="416" r="16" fill="none"
                                                            stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="32" />
                                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="32"
                                                            d="M48 80h64l48 272h256" />
                                                        <path
                                                            d="M160 288h249.44a8 8 0 007.85-6.43l28.8-144a8 8 0 00-7.85-9.57H128"
                                                            fill="none" stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="32" />
                                                    </svg>
                                                    <span class=" bigcounter"><?= $this->cart->total_items() ?></span>
                                                </div>

                                            </div>
                                        </div>


                                    </li>



                                </ul>

                            </div>

                        </div>

                    </div>


                </div>
            </div>

            <div class="container-fluid mob_menu_wrapper headerarea header__sticky">
                <div class="row align-items-center">
                    <div class="col-sm-4 col-2">
                        <div class="mobile-off-canvas">
                            <a class="mobile-aside-button" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-menu">
                                    <line x1="3" y1="12" x2="21" y2="12"></line>
                                    <line x1="3" y1="6" x2="21" y2="6"></line>
                                    <line x1="3" y1="18" x2="21" y2="18"></line>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-4 col-5">
                        <div class="mobile-logo text-center">
                            <a class="logo__mobile" href="<?= base_url() ?>"><img style="width: 100px;"
                                    src="<?= base_url('assets/img/web/logo100.png') ?>" alt="logo"></a>
                        </div>
                    </div>
                    <div class="col-sm-4 col-5">
                        <div class="header-right-wrap">


                            <div class="header__right__inner__wrap d-flex align-items-center justify-content-end">

                                <ul class="headerarea__right headerarea__right__mobail__menu">
                                    <li>
                                        <div class="setting__wrap cursor__pointer">
                                            <div class="setting__wrap__active">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="ionicon"
                                                    viewBox="0 0 512 512">
                                                    <path
                                                        d="M344 144c-3.92 52.87-44 96-88 96s-84.15-43.12-88-96c-4-55 35-96 88-96s92 42 88 96z"
                                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="32" />
                                                    <path
                                                        d="M256 304c-87 0-175.3 48-191.64 138.6C62.39 453.52 68.57 464 80 464h352c11.44 0 17.62-10.48 15.65-21.4C431.3 352 343 304 256 304z"
                                                        fill="none" stroke="currentColor" stroke-miterlimit="10"
                                                        stroke-width="32" />
                                                </svg>

                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="headermiddle__bar cursor__pointer">
                                            <div class="headermiddle__account">
                                                <div class="headermiddle__account__img">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon"
                                                        viewBox="0 0 512 512">
                                                        <circle cx="176" cy="416" r="16" fill="none"
                                                            stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="32" />
                                                        <circle cx="400" cy="416" r="16" fill="none"
                                                            stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="32" />
                                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="32"
                                                            d="M48 80h64l48 272h256" />
                                                        <path
                                                            d="M160 288h249.44a8 8 0 007.85-6.43l28.8-144a8 8 0 00-7.85-9.57H128"
                                                            fill="none" stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="32" />
                                                    </svg>
                                                    <span class=" bigcounter"><?= $this->cart->total_items() ?></span>

                                                </div>

                                            </div>
                                        </div>


                                    </li>

                                </ul>

                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <!-- Mobile Menu Start Here -->
            <div class="mobile-off-canvas-active">
                <a class="mobile-aside-close"><i class="fa fa-close"></i></a>
                <div class="header-mobile-aside-wrap">

                    <div class="mobile__logo text-center">
                        <a href="<?= base_url() ?>">
                            <img src="<?= base_url('assets/img/web/logo30.png') ?>" alt="Logo">
                        </a>
                    </div>

                    <div class="mobile-menu-wrap">

                        <div class="mobile-navigation">

                            <nav>
                                <ul class="mobile-menu">
                                    <li><a href="">Home</a></li>
                                    <li><a href="">New Product</a></li>
                                    <li><a href="">All Product</a></li>
                                    <li><a href="">About</a></li>
                                </ul>
                            </nav>

                        </div>


                    </div>

                    <div class="mobile-social-wrap">
                        <a class="facebook" href="#"><i class="fab fa-facebook"></i></a>
                        <a class="instagram" href="#"><i class="fab fa-instagram"></i></a>
                        <a href=""><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu end Here -->

            <!-- setting__wrap__list__start -->
            <div class="setting__wrap__list">
                <button class="setting__wrap__close">
                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                        <title>Close</title>
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="32" d="M368 368L144 144M368 144L144 368"></path>
                    </svg></button>

                <?php if($user == null){ ?>

                <div class="setting__wrap__heading">
                    <h6>
                        <a href="#">Account</a>
                    </h6>
                </div>
                <div class="setting__wrap__list__inner">
                    <ul>
                        <li>
                            <a href="<?= base_url('login') ?>">Login</a>
                        </li>
                    </ul>
                </div>

                <?php } else { ?>
                <div class="setting__wrap__heading">
                    <h6>
                        <?= $user['name'] ?>
                        <small class="text-primary"><?= $user['email'] ?></small>
                    </h6>
                </div>
                <div class="setting__wrap__list__inner">
                    <ul>
                        <li>
                            <a href="<?= base_url('transaction_history') ?>">Riwayat Transaksi</a>
                        </li>
                        <li>
                            <a href="<?= base_url('login/logout') ?>">Logout</a>
                        </li>
                    </ul>
                </div>
                <?php } ?>



            </div>
            <!-- setting__wrap__list__end -->

            <!-- header__search -->
            <div class="headersearch__active">
                <div class="headersearch__active__icon">
                    <button class="headersearch__active__close">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                            <title>Close</title>
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="32" d="M368 368L144 144M368 144L144 368"></path>
                        </svg></button>
                </div>

            </div>
            <!-- header__search -->

            <!-- minicart__section__start -->
            <section class="minicart">
                <div class="minicart__inner">
                    <div class="minicart__wrapper">
                        <div class="minicart__close__icon">
                            <div class="minicart__cart__text ">
                                <strong>Keranjang</strong>
                            </div>
                            <button class="minicart__close__btn" type="button">
                                <i class="fa fa-close"></i>
                            </button>

                        </div>
                        <?php if($user != null){ ?>
                        <?php if(!empty($this->cart->contents())){ ?>
                        <div class="minicart__single__wraper">

                            <?php foreach ($this->cart->contents() as $items){ ?>
                            <div class="minicart__single">
                                <div class="minicart__single__img">
                                    <a href="#!">
                                        <img src="<?= $items['options']['img'] ?>" alt="product">
                                    </a>
                                    <div class="minicart__single__close">
                                        <?= form_open('remove_cart') ?>
                                        <input type="hidden" name="rowid" value="<?= $items['rowid'] ?>">
                                        <button title="Remove" type="submit"><i class="fa fa-close"></i></button>
                                        <?= form_close() ?>
                                    </div>
                                </div>
                                <div class="minicart__single__content">
                                    <h4><a href="#!"><?= $items['options']['real_name'] ?></a></h4>
                                    <span><?= $items['qty'] ?> x <span class="money">Rp.
                                            <?= number_format($items['price']) ?></span></span>
                                </div>
                            </div>
                            <?php } ?>

                        </div>

                        <div class="minicart__footer">
                            <div class="minicart__subtotal">
                                <span class="subtotal__title">Subtotal:</span>
                                <span class="subtotal__amount">Rp.
                                    <?= number_format($this->cart->total()) ?>
                                </span>
                            </div>
                            <div class="minicart__button">
                                <a href="<?= base_url('destroy_cart') ?>" class="default__button">Hapus</a>
                                <a href="<?= base_url('checkout') ?>" class="default__button">Checkout</a>
                            </div>
                        </div>
                        <?php } else { ?>
                        <div class="minicart__single__wraper">
                            <p class="text-center">Tidak ada item di sini</p>
                        </div>
                        <?php } ?>
                        <?php } ?>

                    </div>
                </div>
            </section>
            <!-- minicart__section__end -->

        </header>
        <!-- header section end -->

        <?php $this->load->view($view) ?>

        <!-- footer__section__start -->
        <div class="footer ">
            <div class="footer__inner sp_top_80">
                <div class="container sp_bottom_60">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="footer__widget">
                                <h4 class="footer__title">About Us.</h4>
                                <div class="footer__content">
                                    <p>Minimal E-Commerce is a dynamic and innovative online retail platform that offers
                                        a wide range of products to customers worldwide.</p>
                                </div>
                                <div class="footer__social__icon">
                                    <ul>
                                        <li><a target="_blank" title="Facebook-f"
                                                href="https://www.facebook.com/shopify"><i
                                                    class="fab fa-facebook-f"></i></a></li>


                                        <li><a target="_blank" title="Twitter" href="https://twitter.com/shopify"><i
                                                    class="fab fa-twitter"></i></a></li>



                                        <li><a target="_blank" title="Youtube"
                                                href="https://www.youtube.com/user/shopify"><i
                                                    class="fab fa-youtube"></i></a></li>


                                        <li><a target="_blank" title="Instagram"
                                                href="https://www.instagram.com/shopify/"><i
                                                    class="fab fa-instagram"></i></a></li>


                                        <li><a target="_blank" title="Tiktok" href="https://www.tiktok.com/@shopify"><i
                                                    class="fab fa-tiktok"></i></a></li>


                                    </ul>
                                </div>
                                <div class="footer__bottom">
                                    <h5>Guaranteed safe checkout</h5>
                                    <div class="footer__img">
                                        <ul>
                                            <li>
                                                <img src="img/footer/footer__1.svg" alt="">
                                            </li>
                                            <li>
                                                <img src="img/footer/footer__2.svg" alt="">
                                            </li>
                                            <li>
                                                <img src="img/footer/footer__3.svg" alt="">
                                            </li>
                                            <li>
                                                <img src="img/footer/footer__4.svg" alt="">
                                            </li>
                                            <li>
                                                <img src="img/footer/footer__5.svg" alt="">
                                            </li>
                                            <li>
                                                <img src="img/footer/footer__6.svg" alt="">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-4 col-6">
                            <div class="footer__widget">
                                <h4 class="footer__title">Quick Link</h4>
                                <div class="footer__menu">
                                    <ul>
                                        <li><a href="/account">My Account</a></li>
                                        <li><a href="/cart">My Cart</a></li>
                                        <li><a href="/pages/wishlist">Wishlist</a></li>
                                        <li><a href="/">Gift Card</a></li>
                                        <li><a href="/pages/contact">Need Help?</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-4 col-6">
                            <div class="footer__widget">
                                <h4 class="footer__title">Information</h4>
                                <div class="footer__menu">
                                    <ul>
                                        <li><a href="/account">About us</a></li>
                                        <li><a href="/cart">Contact</a></li>
                                        <li><a href="/pages/wishlist">Blogs</a></li>
                                        <li><a href="/">Gift Card</a></li>
                                        <li><a href="/pages/contact">Size Chart</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-4 col-6">
                            <div class="footer__widget">
                                <h4 class="footer__title">Policies</h4>
                                <div class="footer__menu">
                                    <ul>
                                        <li><a href="/account">Privacy Policy</a></li>
                                        <li><a href="/cart">Refund Policy</a></li>
                                        <li><a href="/pages/wishlist">Terms of Service</a></li>
                                        <li><a href="/">Gift Card</a></li>
                                        <li><a href="/pages/contact">Shipping Policy</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>

            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="copyright__text">
                                <p>© 2024 <strong>Minimalin</strong>. All rights reserved.</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- footer__section__end -->






    </main>


    <!-- JS here -->
    <script>
    const base_url = '<?= base_url() ?>';
    </script>
    <script src="<?= base_url('assets/main/') ?>js/vendor/modernizr-3.5.0.min.js "></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= base_url('assets/main/') ?>js/popper.min.js "></script>
    <script src="<?= base_url('assets/main/') ?>js/bootstrap.min.js "></script>
    <script src="<?= base_url('assets/main/') ?>js/isotope.pkgd.min.js "></script>
    <script src="<?= base_url('assets/main/') ?>js/one-page-nav-min.js "></script>
    <script src="<?= base_url('assets/main/') ?>js/slick.min.js "></script>
    <script src="<?= base_url('assets/main/') ?>js/jquery.meanmenu.min.js "></script>
    <script src="<?= base_url('assets/main/') ?>js/ajax-form.js "></script>
    <script src="<?= base_url('assets/main/') ?>js/wow.min.js "></script>
    <script src="<?= base_url('assets/main/') ?>js/jquery.scrollUp.min.js "></script>
    <script src="<?= base_url('assets/main/') ?>js/imagesloaded.pkgd.min.js "></script>
    <script src="<?= base_url('assets/main/') ?>js/jquery.magnific-popup.min.js "></script>
    <script src="<?= base_url('assets/main/') ?>js/waypoints.min.js "></script>
    <script src="<?= base_url('assets/main/') ?>js/jquery.counterup.min.js "></script>
    <script src="<?= base_url('assets/main/') ?>js/fontawesome.min.js "></script>
    <script src="<?= base_url('assets/main/') ?>js/plugins.js "></script>
    <script src="<?= base_url('assets/main/') ?>js/main.js "></script>
    <script>
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
    <script src="<?= base_url('assets/js/homepage.js') ?>"></script>

</body>

</html>