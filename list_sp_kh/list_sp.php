<?php
    require_once "../config.php" ;
    require_once "../header_small.php" ; 
    
    if (!isset($_GET['product'])) {
        $product = 1;
    } else {
        $product = $_GET['product'];
    }
    $data = 6;
    $sql = "SELECT count(*) FROM `hang_hoa`";
    $conn = connect() ; 
    $result = $conn->prepare($sql);
    $result->execute();
    $number = $result->fetchColumn();
    $page = ceil($number / $data);
    $tin = ($product - 1) * $data;
    
    // lấy mã loại trên đường dẫn xuống 
    $ma_loai = isset($_GET['ma_loai']) ? $_GET['ma_loai'] : "" ; 
    $sql = "SELECT * FROM hang_hoa where ma_loai = '$ma_loai' LIMIT $tin , $data" ; 
    $all = select_all($sql) ; 


?>
  <div class="container mt-3">
        <div class="row" style="height: 750px;">
                <?php include APP_PATH."/header_loai_hang.php" ?>
                <!--------------------------------------------------  làm trang chính   ------------------------------------------------------------->
                <div class="col-md-9">
                        <div class="list-product-new">
                        
                            <div class="tt-list-product">
                                <h3>SẢN PHẨM</h3>
                            </div>

                            <?php
                                for ($t = 1; $t <= $page; $t++) { ?>
                                    &nbsp;<a name="" id="" class="btn btn-danger mt-2 mb-2" href="<?php echo BASE_URL ?>list_sp_kh/list_sp.php?ma_loai=<?php echo $ma_loai ?>&product=<?php echo $t ?>" role="button"> <?= $t ?></a>
                                <?php
                                }
                                ?>
                        
                             <div class="home-list-product">
                                <?php foreach ($all as $key) { ?>
                                    <a href="<?php echo BASE_URL ?>chi_tiet_sp.php?id=<?php echo $key['id'] ?>&ma_loai=<?php echo $key['ma_loai'] ?>">
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
                                                <span><?php echo $key['so_luot_xem'] ?></span> <i class="fa fa-eye" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                            <div class="vote">
                                                <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                                                <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                                                <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                                                <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                                                <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                                                <?php echo ($key['so_luot_xem'] - 2) ?>
                                                
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
                    
                <!--------------------------------------------------  End làm trang chính   ------------------------------------------------------------->
            </div>
           
        </div> 
  </div>

<?php include "../footer.php" ?>