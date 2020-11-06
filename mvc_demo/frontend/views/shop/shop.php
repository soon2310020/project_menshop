<?php
?>

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7">
                    <div class="header__top__left">
                        <p>Free shipping, 30-day return or refund guarantee.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="header__top__right">
                        <div class="header__top__links">
                            <a href="#">Sign in</a>
                            <a href="#">FAQs</a>
                        </div>
                        <div class="header__top__hover">
<!--                            <span>Usd <i class="arrow_carrot-down"></i></span>-->
<!--                            <ul>-->
<!--                                <li>USD</li>-->
<!--                                <li>EUR</li>-->
<!--                                <li>USD</li>-->
<!--                            </ul>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="header__logo">
                    <a href="./index.html"><img src="img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li><a href="index.php?controller=home&action=index">Home</a></li>
                        <li class="active"><a href="index.php?controller=shop&action=shop">Shop</a></li>
                        <li><a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="./about.html">About Us</a></li>
                                <li><a href="./shop-details.html">Shop Details</a></li>
                                <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                                <li><a href="./checkout.html">Check Out</a></li>
                                <li><a href="./blog-details.html">Blog Details</a></li>
                            </ul>
                        </li>
                        <li><a href="./blog.html">Blog</a></li>
                        <li><a href="./contact.html">Contacts</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="header__nav__option">
<!--                    <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>-->
                    <a href="#"><img src="img/icon/heart.png" alt=""></a>
                    <a href="#"><img src="img/icon/cart.png" alt=""> <span>0</span></a>
                    <div class="price">$0.00</div>
                </div>
            </div>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>
<!-- Header Section End -->
<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?php
        echo $_SESSION['error'];
        unset($_SESSION['error']);
        ?>
    </div>
<?php endif; ?>

<?php if (!empty($this->error)): ?>
    <div class="alert alert-danger">
        <?php
        echo $this->error;
        ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success">
        <?php
        echo $_SESSION['success'];
        unset($_SESSION['success']);
        ?>
    </div>
<?php endif; ?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shop</h4>
                    <div class="breadcrumb__links">
                        <a href="index/php?controller=home">Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__search">
                        <form action="" method="post">
                            <input type="text" placeholder="Search..." name="search" value="<?php echo  isset($_POST['search'])?$_POST['search']:''?>">
                            <button type="submit" name="filters" value="filters"><span class="icon_search"></span></button>
                        </form>
                    </div>
                    <div class="shop__sidebar__accordion">
                        <form action="" method="post">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll">
                                                    <?php foreach ($categories as $category): ?>
                                                        <li>
                                                            <?php
                                                            $checked = '';
                                                            if (isset($_POST['categories'])) {
                                                                if (in_array($category['id'], $_POST['categories'])) {
                                                                    $checked = 'checked';
                                                                }
                                                            }
                                                            ?>
                                                            <input <?php echo $checked; ?> type="checkbox"
                                                                                           name="categories[]"
                                                                                           value="<?php echo $category['id']; ?>"/>
                                                            <?php echo $category['name']; ?>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--                                <div class="card">-->
                                <!--                                    <div class="card-heading">-->
                                <!--                                        <a data-toggle="collapse" data-target="#collapseTwo">Branding</a>-->
                                <!--                                    </div>-->
                                <!--                                    <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">-->
                                <!--                                        <div class="card-body">-->
                                <!--                                            <div class="shop__sidebar__brand">-->
                                <!--                                                <ul>-->
                                <!--                                                    <li><a href="#">Louis Vuitton</a></li>-->
                                <!--                                                    <li><a href="#">Chanel</a></li>-->
                                <!--                                                    <li><a href="#">Hermes</a></li>-->
                                <!--                                                    <li><a href="#">Gucci</a></li>-->
                                <!--                                                </ul>-->
                                <!--                                            </div>-->
                                <!--                                        </div>-->
                                <!--                                    </div>-->
                                <!--                                </div>-->
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                    </div>
                                    <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__price">
                                                <?php
                                                $checked_1 = '';
                                                $checked_2 = '';
                                                $checked_3 = '';
                                                $checked_4 = '';
                                                if (isset($_POST['prices'])) {
                                                    if (in_array(0, $_POST['prices'])) {
                                                        $checked_1 = 'checked';
                                                    }
                                                    if (in_array(1, $_POST['prices'])) {
                                                        $checked_2 = 'checked';
                                                    }
                                                    if (in_array(2, $_POST['prices'])) {
                                                        $checked_3 = 'checked';
                                                    }
                                                    if (in_array(3, $_POST['prices'])) {
                                                        $checked_4 = 'checked';
                                                    }
                                                }
                                                ?>
                                                <ul>
                                                    <li><input type="checkbox" name="prices[]" <?php echo $checked_1; ?>
                                                               value="0"/> < <?php echo number_format(200000)?> <small>VND</small>
                                                    </li>

                                                    <li><input type="checkbox" name="prices[]" <?php echo $checked_2; ?>
                                                               value="1"/> Từ <?php echo number_format(200000)?> <small>VND</small> đến 1 tr <small>VND</small>
                                                    </li>

                                                    <li><input type="checkbox" name="prices[]" <?php echo $checked_3; ?>
                                                               value="2"/> Từ 1tr <small>VND</small> đến 3tr <small>VND</small>
                                                    </li>
                                                    <li><input type="checkbox" name="prices[]" <?php echo $checked_4; ?>
                                                               value="3"/> > 3tr <small>VND</small>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<!--                                <div class="card">-->
<!--                                    <div class="card-heading">-->
<!--                                        <a data-toggle="collapse" data-target="#collapseFour">Size</a>-->
<!--                                    </div>-->
<!--                                    <div id="collapseFour" class="collapse show" data-parent="#accordionExample">-->
<!--                                        <div class="card-body">-->
<!--                                            <div class="shop__sidebar__size">-->
<!--                                                <label for="xs">xs-->
<!--                                                    <input type="radio" id="xs">-->
<!--                                                </label>-->
<!--                                                <label for="sm">s-->
<!--                                                    <input type="radio" id="sm">-->
<!--                                                </label>-->
<!--                                                <label for="md">m-->
<!--                                                    <input type="radio" id="md">-->
<!--                                                </label>-->
<!--                                                <label for="xl">xl-->
<!--                                                    <input type="radio" id="xl">-->
<!--                                                </label>-->
<!--                                                <label for="2xl">2xl-->
<!--                                                    <input type="radio" id="2xl">-->
<!--                                                </label>-->
<!--                                                <label for="xxl">xxl-->
<!--                                                    <input type="radio" id="xxl">-->
<!--                                                </label>-->
<!--                                                <label for="3xl">3xl-->
<!--                                                    <input type="radio" id="3xl">-->
<!--                                                </label>-->
<!--                                                <label for="4xl">4xl-->
<!--                                                    <input type="radio" id="4xl">-->
<!--                                                </label>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="card">-->
<!--                                    <div class="card-heading">-->
<!--                                        <a data-toggle="collapse" data-target="#collapseFive">Colors</a>-->
<!--                                    </div>-->
<!--                                    <div id="collapseFive" class="collapse show" data-parent="#accordionExample">-->
<!--                                        <div class="card-body">-->
<!--                                            <div class="shop__sidebar__color">-->
<!--                                                <label class="c-1" for="sp-1">-->
<!--                                                    <input type="radio" id="sp-1">-->
<!--                                                </label>-->
<!--                                                <label class="c-2" for="sp-2">-->
<!--                                                    <input type="radio" id="sp-2">-->
<!--                                                </label>-->
<!--                                                <label class="c-3" for="sp-3">-->
<!--                                                    <input type="radio" id="sp-3">-->
<!--                                                </label>-->
<!--                                                <label class="c-4" for="sp-4">-->
<!--                                                    <input type="radio" id="sp-4">-->
<!--                                                </label>-->
<!--                                                <label class="c-5" for="sp-5">-->
<!--                                                    <input type="radio" id="sp-5">-->
<!--                                                </label>-->
<!--                                                <label class="c-6" for="sp-6">-->
<!--                                                    <input type="radio" id="sp-6">-->
<!--                                                </label>-->
<!--                                                <label class="c-7" for="sp-7">-->
<!--                                                    <input type="radio" id="sp-7">-->
<!--                                                </label>-->
<!--                                                <label class="c-8" for="sp-8">-->
<!--                                                    <input type="radio" id="sp-8">-->
<!--                                                </label>-->
<!--                                                <label class="c-9" for="sp-9">-->
<!--                                                    <input type="radio" id="sp-9">-->
<!--                                                </label>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="card">-->
<!--                                    <div class="card-heading">-->
<!--                                        <a data-toggle="collapse" data-target="#collapseSix">Tags</a>-->
<!--                                    </div>-->
<!--                                    <div id="collapseSix" class="collapse show" data-parent="#accordionExample">-->
<!--                                        <div class="card-body">-->
<!--                                            <div class="shop__sidebar__tags">-->
<!--                                                <a href="#">Product</a>-->
<!--                                                <a href="#">Bags</a>-->
<!--                                                <a href="#">Shoes</a>-->
<!--                                                <a href="#">Fashio</a>-->
<!--                                                <a href="#">Clothing</a>-->
<!--                                                <a href="#">Hats</a>-->
<!--                                                <a href="#">Accessories</a>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
                            </div>
                            <div class="card">
                                <div class="card-body">
                            <button class="btn btn-dark" style="width: 30%" type="submit" name="filter" value="filters">Lọc</button>
                            <a class="btn btn-default" style="width: 30%" type="submit" name="filter" value="filters" href="index.php?controller=shop&action=cancel">Bỏ lọc</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__left">
                                <p>Showing  <?php echo $total ?> results</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">

                        </div>
                    </div>
                </div>
                <div class="row">

                    <!--                    product starrt-->
                    <?php foreach ($products as $product) : ?>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                            <!--                bắt đầu 1 sản phẩm-->
                            <div class="product__item">
                                <div class="product__item__pic set-bg"
                                     data-setbg="../backend/assets/uploads/products_avatar/<?php echo $product['avatar'] ?>">
                                    <ul class="product__hover">
                                        <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                                        <!--                            <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a></li>-->
                                        <!--                            <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>-->
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><?php echo $product['title'] ?></h6>
                                    <a href="#" class="add-cart">+ Add To Cart</a>
                                    <!--                        <div class="rating">-->
                                    <!--                            <i class="fa fa-star-o"></i>-->
                                    <!--                            <i class="fa fa-star-o"></i>-->
                                    <!--                            <i class="fa fa-star-o"></i>-->
                                    <!--                            <i class="fa fa-star-o"></i>-->
                                    <!--                            <i class="fa fa-star-o"></i>-->
                                    <!--                        </div>-->
                                    <h5><?php echo number_format($product['price']); ?>
                                        <small>VND</small>
                                    </h5>
                                    <?php $id = $product['id'];
                                    $cls = $color[$id];

                                    ?>

                                    <div class="product__color__select">
                                        <?php foreach ($cls as $cl): ?>
                                            <label class="black" style="background-color:<?php echo $cl['color']; ?>;">
                                                <input type="radio" style="background-color: #0b090c;ss">
                                            </label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <!--            kết thúc sản phẩm-->
                    <!--                    product end-->
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__pagination">
                            <?php echo $pagination ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->
