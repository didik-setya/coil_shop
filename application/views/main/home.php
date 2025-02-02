<!-- herobanner__start -->
<div class="herobanner">
    <div class=" container-fluid hero__fullwidth__spacing">

        <div class="herobanner__inner">


            <div class="container herobannerarea__slider  slider__default__arrow slider__default__dot">
                <div class="herobannerarea__slider__single">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 herobanner__text__side">
                            <div class="herobanner__text__wraper ltn__slide-animation">
                                <h1 class="herobanner__title herobanner__title__color animated">Rasakan Sensasi
                                    Vape yang Sempurna
                                </h1>
                                <div class="herobanner__text herobanner__text__color  animated">
                                    <p>Coil vape kami dirancang untuk memberikan pengalaman vaping yang tak
                                        terlupakan</p>
                                </div>
                                <div class="herobanner__button herobanner__button__color  animated">
                                    <a href="#" class="default__button" tabindex="0">Beli Sekarang</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 herobanner__img__side">
                            <div class="herobanner__img">
                                <img src="<?= base_url('assets/img/web/coil_4.webp') ?>" alt="img-hero">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="herobannerarea__slider__single">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 herobanner__text__side">
                            <div class="herobanner__text__wraper ltn__slide-animation">
                                <h1 class="herobanner__title herobanner__title__color animated">Coil Vape
                                    Berkualitas, Rasa Maksimal
                                </h1>
                                <div class="herobanner__text herobanner__text__color  animated">
                                    <p>Dengan bahan berkualitas tinggi, coil vape kami menghasilkan rasa yang
                                        kaya dan halus.</p>
                                </div>
                                <div class="herobanner__button herobanner__button__color  animated">
                                    <a href="#" class="default__button" tabindex="0">Beli Sekarang</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 herobanner__img__side">
                            <div class="herobanner__img">
                                <img src="<?= base_url('assets/img/web/coil_3.webp') ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="herobannerarea__slider__single">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 herobanner__text__side">
                            <div class="herobanner__text__wraper ltn__slide-animation">
                                <h1 class="herobanner__title herobanner__title__color animated">Coil Vape Custom
                                    untuk Semua Kebutuhan
                                </h1>
                                <div class="herobanner__text herobanner__text__color  animated">
                                    <p>Coil vape kami mudah disesuaikan untuk memenuhi preferensi vapingmu</p>
                                </div>
                                <div class="herobanner__button herobanner__button__color  animated">
                                    <a href="#" class="default__button" tabindex="0">Beli Sekarang</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 herobanner__img__side">
                            <div class="herobanner__img">
                                <img src="<?= base_url('assets/img/web/coil_1.webp') ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
<!-- herobanner__end -->


<!-- best__selling__start -->
<div class="best__selling sp_bottom_80 mt-3">
    <div class="container">

        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="section__title">
                    <h2>All Product</h2>
                </div>
            </div>
        </div>

        <div class="row">

            <?php foreach($all_product as $ap){ ?>
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="grid__wraper">
                    <div class="grid__wraper__img">
                        <div class="grid__wraper__img__inner">
                            <img class="primary__image"
                                src="<?= base_url('assets/img/product/' . $ap->product_images) ?>" alt="Primary Image">
                            <img class="secondary__image"
                                src="<?= base_url('assets/img/product/' . $ap->product_images) ?>"
                                alt="Secondary Image">
                        </div>
                        <div class="grid__wraper__icon">
                            <ul>

                                <li>
                                    <span>
                                        <button class="btn btn-sm btn-dark"
                                            onclick="view_product('<?= md5(sha1($ap->id)) ?>')">
                                            <i class="far fa-eye"></i>
                                        </button>
                                    </span>
                                </li>

                                <li>
                                    <?= form_open('add_to_cart', 'class="add_to_cart"') ?>
                                    <input type="hidden" name="product" value="<?= md5(sha1($ap->id)) ?>">
                                    <button class="btn btn-sm btn-primary" type="submit"><i
                                            class="fa-solid fa-cart-shopping"></i></button>
                                    <?= form_close() ?>
                                    <!-- <a href="<?= base_url('add_cart/') . md5(sha1($ap->id)) ?>">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                    </a> -->
                                </li>

                            </ul>
                        </div>

                    </div>
                    <div class="grid__wraper__info">
                        <h3 class="grid__wraper__tittle">
                            <a href="single-product.html" tabindex="0"><?= $ap->product_name ?></a>
                        </h3>
                        <div class="grid__wraper__price">
                            <?php
                                        if($ap->product_discount > 0 || $ap->product_discount != '' || $ap->product_discount != null){
                                            $discount = $ap->product_discount / 100 * $ap->product_price;
                                            $price = number_format($ap->product_price - $discount);
                                        } else {
                                            $price = number_format($ap->product_price);
                                        }
                                    ?>
                            <span>Rp. <?= $price ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>

        </div>
    </div>
</div>
<!-- best__selling__start -->

<!-- fetaure__section__start -->
<div class="feature__2 feature__3  sp_bottom_80">
    <div class="container ">
        <div class="row">
            <div class="col-xl-12">

                <div class="feature__border">
                    <div class="feature__2__single feature__3__single">

                        <div class="feature__2__text">
                            <h4>Free Shipping</h4>
                            <p>On orders over $99.</p>
                        </div>
                    </div>

                    <div class="feature__2__single feature__3__single">

                        <div class="feature__2__text">
                            <h4>Money Back</h4>
                            <p>Money back in 15 days..</p>
                        </div>
                    </div>

                    <div class="feature__2__single feature__3__single">

                        <div class="feature__2__text">
                            <h4>Secure Checkout</h4>
                            <p>100% Payment Secure.</p>
                        </div>
                    </div>

                    <div class="feature__2__single feature__3__single">

                        <div class="feature__2__text">
                            <h4>Online Support</h4>
                            <p>Ensure the product quality.</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- fetaure__section__end -->




<!-- modal__section__start -->
<div class="grid__quick__view__modal modalarea modal" id="modalShowProduct" tabindex="-1" aria-labelledby="exampleModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">




            </div>
        </div>
    </div>
</div>