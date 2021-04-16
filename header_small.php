<?php
   
    require_once "config.php" ; 
    require_once APP_PATH ."/dao/pdo.php";
    $sql = "select * from loai_hang" ; 
    $loai_hangs = select_all($sql) ; 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include APP_PATH. "/admin/link/link.php" ?>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/header.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/index.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/chi_tiet_sp.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/footer.css">
</head>
<body>

    <div class="container-fluid">
        <div class="row header">
              <div class="logo">
                  <a href="#"><img src="<?php echo BASE_URL; ?>/public/image/logoXSHOP.png" alt=""></a>
              </div>

              <div class="search">
                  <div class="search-top">
                        <form action="" method="GET" class="mt-4">
                                <div class="form-group">
                                    <input type="text" name="keyword" placeholder="Bạn cần tìm gì nào ...?" class="form-control search-input">
                                    <button class="btn btn-danger btn-input"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </div> 
                        </form>
                  </div>
                  
                  <div class="search-bottom">
                      <div>
                          <img src="<?php echo BASE_URL; ?>/public/image/ch.png" alt="">
                          <p>SẢN PHẨM CHÍNH HÃNG</p>
                      </div>

                      <div>
                          <img src="<?php echo BASE_URL; ?>/public/image/free.png" alt="">
                          <p>VẨN CHUYỂN MIỄN PHÍ</p>
                      </div>

                      <div>
                          <img src="<?php echo BASE_URL; ?>/public/image/xc.png" alt="">
                          <p>XỬA CHỮA MIỄN PHÍ</p>
                      </div>

                      <div>
                          <img src="<?php echo BASE_URL; ?>/public/image/tn.png" alt="">
                          <p>SỬA CHỮA TẠI NHÀ</p>
                      </div>
                  </div>
              </div>

              <div class="card-product">
                    <div class="cart-product-top">
                       <a href="#">
                            <img src="<?php echo BASE_URL; ?>/public/image/cart.png" alt="" width="40px">
                            <sup><b class="cs">0</b></sup>
                       </a>
                    </div>
                    <div class="cart-product-bottom">
                        <span style="font-weight: 700;">HOTLINE</span> <br>
                        <span style="font-size: 27px; font-weight: 700;">0355.755.697</span>
                    </div>
              </div>


              <div class="tt">
                  <div class="tt-top">
                      <img src="<?php echo BASE_URL; ?>/public/image/ad2.png" alt="" class="ad">
                  </div>
                  <div class="tt-mid">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                  </div>
                  <div class="tt-bottom">
                       <div class="h">
                       <i class="fa fa-clock-o" aria-hidden="true"></i> 08h00 - 22h30
                       </div>
                  </div>

                  <div class="menu-ad">
                       <?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {?>
                            <ul>
                                <li class="text-white">
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-left: -65px;">
                                         &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp; <?php echo $_SESSION['user']['ho_ten'] ?>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#">
                                                <img src="<?php echo BASE_URL.'/'. $_SESSION['user']['hinh'] ; ?>" alt="" class="image-me mb-2" width="110px" height="100px">   
                                            </a>
                                            <a class="dropdown-item" href="<?php echo BASE_URL ?>tai_khoan/edit_password.php" style="color: black;">Đổi mật khẩu</a>
                                            <a class="dropdown-item" href="<?php echo BASE_URL ?>tai_khoan/update.php" style="color: black;">Cập nhật tài khoản</a>
                                            <a class="dropdown-item" href="<?php echo BASE_URL ?>tai_khoan/forgot_password.php" style="color: black;">Quên mật khẩu</a>

                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <a href="<?php echo BASE_URL ?>tai_khoan/logout.php" onclick="return confirm('Bạn chắc chắn muốn đăng xuất ?')">|&ensp; Đăng xuất</a>
                                </li>
                            </ul> 
                       <?php } else if(isset($_SESSION['admin']) && !empty($_SESSION['admin'])) { ?>
                            <ul>
                                <li class="text-white">
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-left: -65px;">
                                        &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp; <?php echo $_SESSION['admin']['ho_ten'] ?> (AD)
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#">
                                                <img src="<?php echo BASE_URL.'/'. $_SESSION['admin']['hinh'] ; ?>" alt="" class="image-me mb-2" width="110px" height="100px">   
                                            </a>
                                            <a class="dropdown-item" href="<?php echo BASE_URL ?>tai_khoan/edit_password.php" style="color: black;">Đổi mật khẩu</a>
                                            <a class="dropdown-item" href="<?php echo BASE_URL ?>tai_khoan/update.php" style="color: black;">Cập nhật tài khoản</a>
                                            <a class="dropdown-item" href="<?php echo BASE_URL ?>tai_khoan/forgot_password.php" style="color: black;">Quên mật khẩu</a>

                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <a href="<?php echo BASE_URL ?>tai_khoan/logout.php" onclick="return confirm('Bạn chắc chắn muốn đăng xuất ?')">|&ensp;&ensp;  <i class="fa fa-window-close" aria-hidden="true"></i></a>
                                </li>
                                <li>
                                    <a href="<?php echo BASE_URL ?>admin/trang_chinh" onclick="return confirm('Bạn chắc chắn muốn vào trang Admin ?')">|&ensp; <i class="fa fa-refresh" aria-hidden="true"></i></a>
                                </li>
                            </ul>
                        <?php } else { ?>
                            <ul>
                                <li><a href="<?php echo BASE_URL ?>tai_khoan/new.php">Đăng kí</a></li>
                                <li><a href="<?php echo BASE_URL ?>tai_khoan/login.php">Đăng nhập</a></li>
                                <li><a href="#">Admin</a></li>
                            </ul>
                        <?php } ?>
                  </div>
              </div>
        </div>
        
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center align-items-center menu">
                <ul >
                    <li><a href="<?php echo BASE_URL ?>index.php"><i class="fa fa-home" aria-hidden="true"></i> &ensp;Trang chủ</a></li>
                    <li><a href="#"><i class="fa fa-bars" aria-hidden="true"></i>&ensp;Danh mục</a>
                        <ul class="sub-menu">
                            <?php foreach ($loai_hangs as $key) { ?>
                                <li><a href=""><?php echo $key['ten_loai'] ?></a></li>
                            <?php } ?>
                        </ul>
                    

                </li>
                    <li><a href="#"><i class="fa fa-wrench" aria-hidden="true"></i>&ensp;Dịch vụ sửa chữa</a>
                </li>
                    <li><a href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i>&ensp;Tin tức</a></li>
                    <li><a href="#"><i class="fa fa-gift" aria-hidden="true"></i>&ensp;Khuyến mãi</a></li>
                    <li><a href="#"><i class="fa fa-question-circle-o" aria-hidden="true"></i>&ensp;Hỏi đáp</a></li>
                    <li><a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&ensp;Góp ý</a></li>
                    <li><a href="<?php echo BASE_URL ?>lien_he/lien_he.php"><i class="fa fa-phone" aria-hidden="true"></i>&ensp;Liên Hệ</a></li>
                </ul>
            </div>
        </div>
         

        <div class="row mt-2">
            <div class="col d-flex justify-content-center align-items-center">
                <a href="#"> <img src="<?php echo BASE_URL; ?>/public/image/banner.webp" alt=""></a>
            </div>
        </div>
             
    </div> 
    
    <!-------------------------------------------------------  Phần thân   ------------------------------------------------------------->

     
<!--     
</body>
</html> -->