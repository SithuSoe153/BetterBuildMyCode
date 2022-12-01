<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include('connect.php');
include('cheader.php');


if (isset($_REQUEST['productid'])) {
    $productid = $_REQUEST['productid'];
    $query = "SELECT p.*,c.categoryid,c.categoryname
    FROM product p,category c
    WHERE p.categoryid=c.categoryid
    AND p.productid='$productid'";
    $ret = mysqli_query($connection, $query);
    $arr = mysqli_fetch_array($ret);

    $maxno = $arr['unitquantity'];

    $productid = $arr['productid'];
    $productdes = $arr['productdescription'];
    $productname = $arr['productname'];
    $unitprice = $arr['unitprice'];
    $quantity = $arr['unitquantity'];
    $categoryname = $arr['categoryname'];
    $image1 = $arr['productprofile'];
    $TD = $arr['3D'];
    if (empty($arr['3D'])) {
        $ans = "true";
    } else {
        $ans = "false";
    }
} else {
    echo "<script>window.location='CustomerHome.php'</script>";
}

?>

<form action="cart-page.php" method="get">
    <input type="hidden" name="productid" value="<?php echo $productid ?>" />
    <input type="hidden" name="action" value="buy" />

    <section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="images/bg-blog-2.jpg">
            <div class="breadcrumbs-custom-body parallax-content context-dark">
                <div class="container">
                    <h2 class="breadcrumbs-custom-title">Product Detail</h2>
                </div>
            </div>
        </div>
        <div class="breadcrumbs-custom-footer">
            <div class="container">
                <ul class="breadcrumbs-custom-path">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="grid-shop.php">Shop</a></li>
                    <li class="active">Product Display</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Single Product-->
    <section class="section section-sm section-first bg-default">
        <div class="container">
            <div class="row row-30">
                <div class="col-lg-6">
                    <div class="slick-vertical slick-product">
                        <!-- Slick Carousel-->
                        <div class="slick-slider carousel-parent" id="carousel-parent" data-items="1" data-swipe="<?php echo $ans ?>" data-child="#child-carousel" data-for="#child-carousel">
                            <div class="item">
                                <div class="slick-product-figure">

                                    <?php if (!$TD) { ?>
                                        <img src="<?php echo $image1 ?>" alt="" width="530" height="480" />
                                    <?php } else { ?>

                                    <?php include('enter3D.php');
                                    } ?>


                                </div>
                            </div>
                            <div class="item">
                                <div class="slick-product-figure"><img src="images/single-product-2-530x480.png" alt="" width="530" height="480" />
                                </div>
                            </div>
                            <div class="item">
                                <div class="slick-product-figure"><img src="images/single-product-3-530x480.png" alt="" width="530" height="480" />
                                </div>
                            </div>
                        </div>
                        <div class="slick-slider child-carousel slick-nav-1" id="child-carousel" data-arrows="true" data-items="3" data-sm-items="3" data-md-items="3" data-lg-items="3" data-xl-items="3" data-xxl-items="3" data-md-vertical="true" data-for="#carousel-parent">
                            <div class="item">
                                <div class="slick-product-figure"><img src="<?php echo $image1 ?>" alt="" width="530" height="480" />
                                </div>
                            </div>
                            <div class="item">
                                <div class="slick-product-figure"><img src="images/single-product-2-530x480.png" alt="" width="530" height="480" />
                                </div>
                            </div>
                            <div class="item">
                                <div class="slick-product-figure"><img src="images/single-product-3-530x480.png" alt="" width="530" height="480" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="single-product">
                        <h3 class="text-transform-none fw-medium"><?php echo $productname ?></h3>
                        <div class="group-md group-middle">
                            <div class="single-product-price"><?php echo $unitprice ?> MMK</div>
                            <div class="single-product-rating"><span class="icon mdi mdi-star"></span><span class="icon mdi mdi-star"></span><span class="icon mdi mdi-star"></span><span class="icon mdi mdi-star"></span><span class="icon mdi mdi-star-half"></span></div>
                        </div>
                        <hr class="hr-gray-100">
                        <ul class="list list-description">
                            <li><span>Categories:</span><span><?php echo $categoryname ?></span></li>
                            <li><span>Descriptions:</span><span><?php echo $productdes ?></span></li>
                            <li><span>Stocks:</span>
                                <span>
                                    <?php
                                    if ($quantity < 1) {
                                        echo "Out Of Stock";
                                    } else {

                                        echo $maxno . ' Pcs';
                                    ?>

                                </span>
                            </li>


                        </ul>


                        <div class="group-xs group-middle">
                            <div class="product-stepper">
                                <?php echo '<input class="form-input" type="number" name="txtBuyQuantity" value="1" min="1" max="' . $quantity . '" />'; ?>
                            </div>


                            <div> <input class="btn btn-lg btn-secondary btn-zakaria" type="submit" name="btnAdd" value="Add" /></div>

                        </div>

                        <div>
                            <hr class="hr-gray-100">
                        </div>
                        <div class="group-xs group-middle"><span class="list-social-title">Share</span>
                            <div>
                                <ul class="list-inline list-social list-inline-sm">
                                    <li><a class="icon mdi mdi-facebook" href="#"></a></li>
                                    <li><a class="icon mdi mdi-twitter" href="#"></a></li>
                                    <li><a class="icon mdi mdi-instagram" href="#"></a></li>
                                    <li><a class="icon mdi mdi-google-plus" href="#"></a></li>
                                </ul>
                            </div>
                        </div>
                    <?php } ?>

                    </div>
                </div>
            </div>
            <!-- Bootstrap tabs-->
            <!-- <div class="tabs-custom tabs-horizontal tabs-line" id="tabs-1"> -->
            <!-- Nav tabs-->
            <!-- <div class="nav-tabs-wrap">
                    <ul class="nav nav-tabs nav-tabs-1">
                        <li class="nav-item" role="presentation"><a class="nav-link active" href="#tabs-1-1" data-bs-toggle="tab">Reviews</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-1-2" data-bs-toggle="tab">Additional information</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-1-3" data-bs-toggle="tab">Delivery and payment</a></li>
                    </ul>
                </div> -->
            <!-- Tab panes-->
            <!-- <div class="tab-content tab-content-1">
                    <div class="tab-pane fade show active" id="tabs-1-1">
                        <div class="box-comment">
                            <div class="unit flex-column flex-sm-row unit-spacing-md">
                                <div class="unit-left"><a class="box-comment-figure" href="#"><img src="images/user-1-119x119.jpg" alt="" width="119" height="119" /></a></div>
                                <div class="unit-body">
                                    <div class="group-sm group-justify">
                                        <div>
                                            <div class="group-xs group-middle">
                                                <h5 class="box-comment-author"><a href="#">Jane Doe</a></h5>
                                                <div class="box-rating"><span class="icon mdi mdi-star"></span><span class="icon mdi mdi-star"></span><span class="icon mdi mdi-star"></span><span class="icon mdi mdi-star"></span><span class="icon mdi mdi-star-half"></span></div>
                                            </div>
                                        </div>
                                        <div class="box-comment-time">
                                            <time datetime="2021-11-30">Nov 30, 2021</time>
                                        </div>
                                    </div>
                                    <p class="box-comment-text">Donec nulla mauris, tempor ac velit at, consectetur tempor enim. Donec rutrum faucibus consectetur. Vivamus blandit leo a sodales sagittis. Sed nulla lacus, placerat eget urna in, ultricies scelerisque nunc.</p>
                                </div>
                            </div>
                        </div> -->



            <!-- <h4 class="text-transform-none fw-medium">Leave a Review</h4>
                        <form class="rd-form rd-mailform" data-form-output="form-output-global" data-form-type="contact" method="post" action="bat/rd-mailform.php">
                            <div class="row row-20 row-md-30">
                                <div class="col-lg-8">
                                    <div class="row row-20 row-md-30">
                                        <div class="col-sm-6">
                                            <div class="form-wrap">
                                                <input class="form-input" id="contact-first-name-2" type="text" name="name" data-constraints="@Required" />
                                                <label class="form-label" for="contact-first-name-2">First Name</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-wrap">
                                                <input class="form-input" id="contact-last-name-2" type="text" name="name" data-constraints="@Required" />
                                                <label class="form-label" for="contact-last-name-2">Last Name</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-wrap">
                                                <input class="form-input" id="contact-email-2" type="email" name="email" data-constraints="@Email @Required" />
                                                <label class="form-label" for="contact-email-2">E-mail</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-wrap">
                                                <input class="form-input" id="contact-phone-2" type="text" name="phone" data-constraints="@Numeric" />
                                                <label class="form-label" for="contact-phone-2">Phone</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-wrap">
                                        <label class="form-label" for="contact-message-2">Message</label>
                                        <textarea class="form-input textarea-lg" id="contact-message-2" name="phone" data-constraints="@Required"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-lg btn-secondary btn-zakaria" type="submit">Send Message</button>
                        </form>
                    </div> -->
            <div class="tab-pane fade" id="tabs-1-2">
                <div class="single-product-info">
                    <div class="unit unit-spacing-md flex-column flex-sm-row align-items-sm-center">
                        <div class="unit-left"><span class="icon icon-80 mdi mdi-information-outline"></span></div>
                        <div class="unit-body">
                            <p>In aliquet varius leo, ut convallis ligula consectetur quis. Quisque eu metus est. Praesent tristique mauris urna, sed mattis urna varius quis. Vestibulum fermentum, metus sed eleifend viverra, magna ipsum feugiat
                                sem, id rutrum magna nulla a turpis. Maecenas laoreet, nibh at mattis mattis, nunc ligula scelerisque dolor, ac posuere lorem tellus vel purus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras
                                imperdiet ex et risus elementum pretium.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tabs-1-3">
                <div class="single-product-info">
                    <div class="unit unit-spacing-md flex-column flex-sm-row align-items-sm-center">
                        <div class="unit-left"><span class="icon icon-80 mdi mdi-truck-delivery"></span></div>
                        <div class="unit-body">
                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat . At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd
                                gubergren.Aenean ultrices, metus at placerat venenatis, mi nibh convallis nulla, ut tempor massa risus mollis odio. Donec gravida ante ac ex faucibus auctor.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>

    <!-- Related Products-->
    <section class="section section-sm section-last bg-default">
        <div class="container">
            <h4 class="fw-sbold">Featured Products</h4>
            <div class="row row-lg row-30 row-lg-50 justify-content-center">
                <div class="col-sm-6 col-md-5 col-lg-3">
                    <!-- Product-->
                    <article class="product">
                        <div class="product-body">
                            <div class="product-figure"><img src="images/product-1-129x172.png" alt="" width="129" height="172" />
                            </div>
                            <h5 class="product-title"><a href="single-product.html">Garden table</a></h5>
                            <div class="product-price-wrap">
                                <div class="product-price product-price-old">$30.00</div>
                                <div class="product-price">$23.00</div>
                            </div>
                        </div><span class="product-badge product-badge-sale">Sale</span>
                        <div class="product-button-wrap">
                            <div class="product-button"><a class="btn btn-secondary btn-zakaria fl-bigmug-line-search74" href="single-product.html"></a></div>
                            <div class="product-button"><a class="btn btn-primary btn-zakaria fl-bigmug-line-shopping202" href="cart-page.html"></a></div>
                        </div>
                    </article>
                </div>
                <div class="col-sm-6 col-md-5 col-lg-3">
                    <!-- Product-->
                    <article class="product">
                        <div class="product-body">
                            <div class="product-figure"><img src="images/product-2-160x155.png" alt="" width="160" height="155" />
                            </div>
                            <h5 class="product-title"><a href="single-product.html">Club Chair</a></h5>
                            <div class="product-price-wrap">
                                <div class="product-price">$13.00</div>
                            </div>
                        </div><span class="product-badge product-badge-new">New</span>
                        <div class="product-button-wrap">
                            <div class="product-button"><a class="btn btn-secondary btn-zakaria fl-bigmug-line-search74" href="single-product.html"></a></div>
                            <div class="product-button"><a class="btn btn-primary btn-zakaria fl-bigmug-line-shopping202" href="cart-page.html"></a></div>
                        </div>
                    </article>
                </div>
                <div class="col-sm-6 col-md-5 col-lg-3">
                    <!-- Product-->
                    <article class="product">
                        <div class="product-body">
                            <div class="product-figure"><img src="images/product-3-132x173.png" alt="" width="132" height="173" />
                            </div>
                            <h5 class="product-title"><a href="single-product.html">pendant lamp</a></h5>
                            <div class="product-price-wrap">
                                <div class="product-price">$17.00</div>
                            </div>
                        </div>
                        <div class="product-button-wrap">
                            <div class="product-button"><a class="btn btn-secondary btn-zakaria fl-bigmug-line-search74" href="single-product.html"></a></div>
                            <div class="product-button"><a class="btn btn-primary btn-zakaria fl-bigmug-line-shopping202" href="cart-page.html"></a></div>
                        </div>
                    </article>
                </div>
                <div class="col-sm-6 col-md-5 col-lg-3">
                    <!-- Product-->
                    <article class="product">
                        <div class="product-body">
                            <div class="product-figure"><img src="images/product-4-140x168.png" alt="" width="140" height="168" />
                            </div>
                            <h5 class="product-title"><a href="single-product.html">Dark grey club chair</a></h5>
                            <div class="product-price-wrap">
                                <div class="product-price">$18.00</div>
                            </div>
                        </div>
                        <div class="product-button-wrap">
                            <div class="product-button"><a class="btn btn-secondary btn-zakaria fl-bigmug-line-search74" href="single-product.html"></a></div>
                            <div class="product-button"><a class="btn btn-primary btn-zakaria fl-bigmug-line-shopping202" href="cart-page.html"></a></div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
    <?php include('cfooter.php'); ?>