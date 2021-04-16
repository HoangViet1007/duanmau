<?php 
    require_once "../../config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include "../link/link.php" ?>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/tk.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <style>
        a{
            font-size: 14px;
        }
        .header-top{
            height: 50px;
            background-color: #6699ff;
        }
        .logo{
            height: 170px;
            margin-top: -60px;
            margin-left: 10px;
        }
        .left{
            width: 100%;
            background-color: #f5f5f5;
        }
        .image-ad{
            border-bottom: 1px solid #29558f ;
            display: grid;
            grid-template-columns: 25% 1fr;
            padding: 5px;
        }
        .image-me{ 
           width: 50px;
           height: 50px;
           border-radius: 50%;
       }
       .dot{
            color: #29b869;
            margin-top: -10px;
        }
        .online{
            margin-top: -15px;
        }
        .form{
            border-bottom: 1px solid #29558f;
        }
        .icon-search{
            position: absolute;
            left: 180px;
            top: 120px;
            color: gray;
        }
        #menu ul {
            background-color: #f3f3f3;
            width: auto;
            padding: 0;
            list-style-type: none;
            text-align: left;
        }
            #menu li {
            width: auto;
            height: 40px;
            line-height: 40px;
            border-bottom: 1px solid #e8e8e8;
            padding: 0 1em;
         }
            #menu li a {
            text-decoration: none;
            color: #333;
            display: block;
        }
            #menu li:hover {
            background: gray;
        }
        #menu li a:hover{
            /* font-weight: bold; */
            color: white;
        }

            /*==Dropdown Menu==*/
            #menu ul li {
            position: relative;
        }
        #menu .sub-menu {
            position: absolute;
            left: 170px;
            top: 0;
            display: none;
            width: 160px;
            box-shadow: 2px 2px 2px gray;
            z-index: 1;
        }
        #menu ul li:hover .sub-menu {
            display: block;
         } 
    </style>
</head>
<body>
    <div class="container-fluid header">
          <div class="row header-top">
               <div class="col-md-2">
                    <img src="../../public/image/logo1.png" alt="" class="logo">
               </div>

               <div class="col-md-1">
                    <a href=""> <i class="fa fa-bars" style="margin-left: 10px; color: white;margin-top: 15px;" aria-hidden="true"></i></a>
               </div>

               <div class="col-md-6">
   
               </div>
               <div class="col-md-3">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#"><i class="fa fa-bell" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#"><i class="fa fa-comment-o" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?php echo BASE_URL ?>tai_khoan/logout.php" onclick="return confirm('Bạn chắc chắn muốn đăng xuất ?')">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>Đăng xuất
                            </a>
                        </li>
                    </ul>
               </div>
          </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 left">
                <div class="row image-ad mb-4 mt-2">
                    <div>
                        <?php if(isset($_SESSION['admin']) && !empty($_SESSION['admin'])): ?>
                            <img src="../../<?php echo $_SESSION['admin']['hinh'] ; ?>" alt="" class="image-me mb-2">
                        <?php endif ?>  
                    </div>
                    <div style="margin-left: 5px;">
                        <p class="mt-1" style="font-weight: 600; font-size: 13px;">
                            <?php if(isset($_SESSION['admin']) && !empty($_SESSION['admin'])): ?>
                                <?php echo $_SESSION['admin']['ho_ten'] ; ?>
                            <?php endif ?>  
                        </p> 
                        <p class="online" style="font-size: 13px;"><i class="fa fa-circle dot" aria-hidden="true"></i>&ensp;Online</p>
                    </div>
                </div>

                <div class="form">
                    <form action="#" class="mb-4">
                            <input type="text" name="search" id="search" placeholder="Tìm Kiếm ..." class="form-control">
                            <!-- <a href=""><i class="fa fa-search icon-search" aria-hidden="true"></i></a> -->
                            
                    </form>
                </div>

                <div id="menu">
                    <ul>
                        <li><a href="<?php echo BASE_URL ?>index.php"><i class="fa fa-home" aria-hidden="true"></i> &ensp;Trang chủ</a></li>
                        <li><a href="<?php echo BASE_URL ?>admin/loai_hang/list.php?product=1"><i class="fa fa-gg" aria-hidden="true"></i>&ensp; Quản lí loại hàng</a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo BASE_URL ?>admin/loai_hang/new.php">thêm loại hàng</a></li>
                                <li><a href="#">Sửa loại hàng</a></li>
                                <li><a href="#">Xóa loại hàng</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo BASE_URL ?>admin/hang_hoa/list.php?product=1"><i class="fa fa-th-large" aria-hidden="true"></i>&ensp; Quản lí hàng hoá</a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo BASE_URL ?>admin/hang_hoa/new.php">thêm hàng hóa</a></li>
                                <li><a href="#">Sửa hàng hóa</a></li>
                                <li><a href="#">Xóa hàng hóa</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo BASE_URL ?>admin/khach_hang/list.php?product=1"><i class="fa fa-user-circle" aria-hidden="true"></i>&ensp; Quản lí k.hàng</a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo BASE_URL ?>admin/khach_hang/new.php">thêm k.hàng</a></li>
                                <li><a href="#">Sửa hàng hóa</a></li>
                                <li><a href="#">Xóa hàng hóa</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo BASE_URL ?>admin/binh_luan/list.php?product=1"><i class="fa fa-comments" aria-hidden="true"></i>&ensp; Quản lí bình luận</a></li>
                        <li><a href="<?php echo BASE_URL ?>admin/thong_ke/tk.php"><i class="fa fa-bar-chart" aria-hidden="true"></i>&ensp; Quản lí thống kê</a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo BASE_URL ?>admin/thong_ke/tk_hh.php">Thống kê hàng hóa</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>

            </div>
           
        <!-- </div>
    </div>
</body>
</html> -->