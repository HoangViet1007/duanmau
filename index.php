<?php
    include "header.php"  ; 
    require_once APP_PATH."/dao/pdo.php" ; 

   $sql = "SELECT * FROM hang_hoa  ORDER BY id DESC LIMIT 8" ; 
   $hang_hoas = select_all($sql) ; 

   $sql = "SELECT * FROM hang_hoa where ma_loai = '1' LIMIT 5" ; 
   $iphones = select_all($sql) ;

   $sql = "SELECT * FROM hang_hoa where ma_loai = '2' LIMIT 5" ; 
   $samsungs = select_all($sql) ;

   $sql = "SELECT * FROM hang_hoa where ma_loai = '25' LIMIT 5" ; 
   $dong_hos = select_all($sql) ;
 
 ?>

<div class="container mt-3 mb-3">
    <div class="row">
        <?php include "./header_loai_hang.php" ?>
        <!--------------------------------------------------  làm trang chính   ------------------------------------------------------------->
        <div class="col-md-9">
            <div class="list-product-new" style="margin-bottom: 40px;">
                <div class="tt-list-product">
                    <h3>SẢN PHẨM MỚI NHẤT</h3>
                </div>
                <!-- <div class="home-list-product">
                    <?php foreach ($hang_hoas as $key) { ?>
                    <a
                        href="<?php BASE_URL ?>chi_tiet_sp.php?id=<?php echo $key['id'] ?>&ma_loai=<?php echo $key['ma_loai']?>&dg=<?php echo  ($key['so_luot_xem'] - 2)  ?>">
                        <div class="product-home">
                            <div class="product-home-image">
                                <img src="<?php echo BASE_URL. $key['hinh'] ?>" class="img-fluid" width="70" alt="">
                            </div>
                            <div class="product-home-tt">
                                <p><?php echo $key['ten_hh'] ?></p>
                            </div>
                            <div class="product-home-price">
                                <div class="prices">
                                    <span><?php echo number_format($key['don_gia']) ?><u>đ</u></span>
                                </div>
                                <div class="view">
                                    <span><?php echo $key['so_luot_xem'] ?></span> <i class="fa fa-eye"
                                        aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="vote">
                                <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                                <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                                <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                                <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                                <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                                <?php echo ($key['so_luot_xem'] - 2) ?> &ensp; Đánh Giá

                            </div>
                            <div class="detail">
                                <p>[Hot] thu cũ lên đời - giá thu cao - thủ tục nhanh chóng</p>
                            </div>

                            <div class="sale">
                                <span class="aa"><?php echo $key['giam_gia'] ?>%</span>
                                <span class="bb">Giảm</span>
                            </div>

                            <div class="tra-gop">
                                Trả góp 0%
                            </div>
                        </div>
                    </a>
                    <?php } ?>
                </div> -->
                <div class="owl-carousel owl-theme home-list-product">
                    <?php foreach ($hang_hoas as $key) { ?>

                    <a
                        href="<?php BASE_URL ?>chi_tiet_sp.php?id=<?php echo $key['id'] ?>&ma_loai=<?php echo $key['ma_loai']?>">
                        <div class="item">
                            <div class="product-home">
                                <div class="product-home-image">
                                    <img src="<?php echo BASE_URL. $key['hinh'] ?>" class="img-fluid" alt="" style="width: 170px; margin-left: 15px;">
                                </div>
                                <div class="product-home-tt">
                                    <p><?php echo $key['ten_hh'] ?></p>
                                </div>
                                <div class="product-home-price">
                                    <div class="prices">
                                        <span><?php echo number_format($key['don_gia']) ?><u>đ</u></span>
                                    </div>
                                    <div class="view">
                                        <span><?php echo $key['so_luot_xem'] ?></span> <i class="fa fa-eye"
                                            aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="vote">
                                    <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                                    <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                                    <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                                    <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                                    <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                                    <?php echo ($key['so_luot_xem'] - 2) ?> &ensp; Đánh Giá

                                </div>
                                <div class="detail">
                                    <p>[Hot] thu cũ lên đời - giá thu cao - thủ tục nhanh chóng</p>
                                </div>

                                <div class="sale">
                                    <span class="aa"><?php echo $key['giam_gia'] ?>%</span>
                                    <span class="bb">Giảm</span>
                                </div>

                                <div class="tra-gop">
                                    Trả góp 0%
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php } ?>


                </div>


            </div>

            <!--------------------------------------------------  End làm trang chính   ------------------------------------------------------------->
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <div class="list-product">

                <div class="tt-list-product">
                    <h3>SẢN PHẨM IPHONE</h3>
                    <a href="<?php echo BASE_URL ?>/list_sp_kh/list_sp.php?ma_loai=1&product=1" class="all">XEM TẤT CẢ >>></a>
                </div>

                <div class="list-product-home">
                    <?php foreach ($iphones as $key) { ?>
                    <a
                        href="<?php BASE_URL ?>chi_tiet_sp.php?id=<?php echo $key['id'] ?>&ma_loai=<?php echo $key['ma_loai']  ?>">
                        <div class="product-home">
                            <div class="product-home-image">
                                <img src="<?php echo BASE_URL. $key['hinh'] ?>" class="img-fluid" width="70" alt="">
                            </div>
                            <div class="product-home-tt">
                                <p><?php echo $key['ten_hh'] ?></p>
                            </div>
                            <div class="product-home-price">
                                <div class="prices">
                                    <span><?php echo number_format($key['don_gia']) ?><u>đ</u></span>
                                </div>
                                <div class="view">
                                    <span><?php echo $key['so_luot_xem'] ?></span> <i class="fa fa-eye"
                                        aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="vote">
                                <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                                <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                                <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                                <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                                <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                                <?php echo ($key['so_luot_xem'] - 2) ?> &ensp; Đánh Giá

                            </div>
                            <div class="detail">
                                <p>[Hot] thu cũ lên đời - giá thu cao - thủ tục nhanh chóng</p>
                            </div>

                            <div class="sale">
                                <span class="aa"><?php echo $key['giam_gia'] ?>%</span>
                                <span class="bb">Giảm</span>
                            </div>

                            <div class="tra-gop">
                                Trả góp 0%
                            </div>
                        </div>
                    </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <div class="list-product">

                <div class="tt-list-product">
                    <h3>SẢN PHẨM SAMSUNG</h3>
                    <a href="<?php echo BASE_URL ?>/list_sp_kh/list_sp.php?ma_loai=2&product=1" class="all">XEM TẤT CẢ >>></a>
                </div>

                <div class="list-product-home">
                    <?php foreach ($samsungs as $key) { ?>
                    <a
                        href="<?php BASE_URL ?>chi_tiet_sp.php?id=<?php echo $key['id'] ?>&ma_loai=<?php echo $key['ma_loai'] ?>">
                        <div class="product-home">
                            <div class="product-home-image">
                                <img src="<?php echo BASE_URL. $key['hinh'] ?>" class="img-fluid" width="70" alt="">
                            </div>
                            <div class="product-home-tt">
                                <p><?php echo $key['ten_hh'] ?></p>
                            </div>
                            <div class="product-home-price">
                                <div class="prices">
                                    <span><?php echo number_format($key['don_gia']) ?><u>đ</u></span>
                                </div>
                                <div class="view">
                                    <span><?php echo $key['so_luot_xem'] ?></span> <i class="fa fa-eye"
                                        aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="vote">
                                <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                                <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                                <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                                <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                                <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                                <?php echo ($key['so_luot_xem'] - 2) ?> &ensp; Đánh Giá

                            </div>
                            <div class="detail">
                                <p>[Hot] thu cũ lên đời - giá thu cao - thủ tục nhanh chóng</p>
                            </div>

                            <div class="sale">
                                <span class="aa"><?php echo $key['giam_gia'] ?>%</span>
                                <span class="bb">Giảm</span>
                            </div>

                            <div class="tra-gop">
                                Trả góp 0%
                            </div>
                        </div>
                    </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <div class="list-product">

                <div class="tt-list-product">
                    <h3>SẢN PHẨM ĐỒNG HỒ</h3>
                    <a href="<?php echo BASE_URL ?>/list_sp_kh/list_sp.php?ma_loai=25&product=1" class="all">XEM TẤT CẢ >>></a>
                </div>

                <div class="list-product-home">
                    <?php foreach ($dong_hos as $key) { ?>
                    <a
                        href="<?php BASE_URL ?>chi_tiet_sp.php?id=<?php echo $key['id'] ?>&ma_loai=<?php echo $key['ma_loai'] ?>">
                        <div class="product-home">
                            <div class="product-home-image">
                                <img src="<?php echo BASE_URL. $key['hinh'] ?>" class="img-fluid" width="70" alt="">
                            </div>
                            <div class="product-home-tt">
                                <p><?php echo $key['ten_hh'] ?></p>
                            </div>
                            <div class="product-home-price">
                                <div class="prices">
                                    <span><?php echo number_format($key['don_gia']) ?><u>đ</u></span>
                                </div>
                                <div class="view">
                                    <span><?php echo $key['so_luot_xem'] ?></span> <i class="fa fa-eye"
                                        aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="vote">
                                <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                                <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                                <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                                <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                                <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                                <?php echo ($key['so_luot_xem'] - 2) ?> &ensp; Đánh Giá
                            </div>

                            <div class="detail">
                                <p>[Hot] thu cũ lên đời - giá thu cao - thủ tục nhanh chóng</p>
                            </div>

                            <div class="sale">
                                <span class="aa"><?php echo $key['giam_gia'] ?>%</span>
                                <span class="bb">Giảm</span>
                            </div>

                            <div class="tra-gop">
                                Trả góp 0%
                            </div>
                        </div>
                    </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "./footer.php" ?>