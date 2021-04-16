<?php
     require_once 'config.php';
     require_once APP_PATH."/dao/pdo.php" ; 

     $view = 1;
    //  xóa bình luận 
     if(isset($_GET['id_cmt'])){
        $id_cmt = $_GET['id_cmt'];
        $sql = "SELECT * FROM binh_luan where id = '$id_cmt'" ; 
        $count = connect()->prepare($sql) ; 
        $count->execute() ; 
        if ($count->rowCount() > 0) {
            $sqldelete = "DELETE FROM binh_luan WHERE id = '$id_cmt'" ; 
            insert_update_delete($sqldelete) ; 
        } else {
            try {
                header('location:'.BASE_URL."index.php?msg=Bình luận này không tồn tại !");
                die ; 
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
      
    }

    //  lấy id trên đường dẫn xuống vaà tăng luoẹt xem của sản phẩm lên 
    if (isset($_GET['id']) && isset($_GET['ma_loai'])) {
        $id = $_GET['id'];
        $ma_loai = $_GET['ma_loai'];
        $sql = "SELECT * FROM hang_hoa where id = '$id'" ; 
        // kiểm tra xem trong date base có sp này ko 
        $cout = connect()->prepare($sql);
        $cout->execute();
        if ($cout->rowCount() > 0) {
            $hang_hoa = select_one($sql) ;
            $a = $hang_hoa['so_luot_xem'] += $view ; 
            $sqli= "UPDATE hang_hoa set so_luot_xem = '$a' where id = $id" ;  
            insert_update_delete($sqli) ;
        } else {
            try {
                header('location:'.BASE_URL."index.php?msg=Sản phẩm này không tồn tại !");
                die ; 
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }else{
        header('location:'.BASE_URL."index.php");
    }

    // in sản phẩm liên quan 
    if (isset($_GET['id']) && isset($_GET['ma_loai'])) {
        $id = $_GET['id'];
        $ma_loai = $_GET['ma_loai'];
        $sql = "SELECT * FROM hang_hoa where ma_loai = '$ma_loai'" ; 
        // kiểm tra xem trong date base có sp này ko 
        $cout = connect()->prepare($sql);
        $cout->execute();
        if ($cout->rowCount() > 0) {
            $sqllq = "SELECT * FROM hang_hoa where id != '$id' AND ma_loai = '$ma_loai' ORDER BY RAND() LIMIT 4" ; 
            $lq = select_all($sqllq) ; 
        } else {
            try {
                header('location:'.BASE_URL."index.php?msg=Loại hàng này không tồn tại !");
                die ; 
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }else{
        header('location:'.BASE_URL."index.php?msg=Loại hàng này không tồn tại !");
    }
    


    // code bình luận 
    if(isset($_SESSION['user']) && isset($_POST['comment'])){
        $date = date("Y/m/d");
        $ma_kh = $_SESSION['user']['id']  ; 
        $noi_dung = $_POST['commentPro'] ; 
        // bắt đầu ínert bình luận 
        $sqlbl = "INSERT INTO binh_luan
                                      (noi_dung,ma_hh,ma_kh,ngay_bl)
                                      VALUES
                                      ('$noi_dung','$id','$ma_kh','$date') " ; 
        insert_update_delete($sqlbl) ; 

    }
    else if(isset($_SESSION['admin']) && isset($_POST['comment'])){
        $date = date("Y/m/d");
        $ma_kh = $_SESSION['admin']['id']  ; 
        $noi_dung = $_POST['commentPro'] ; 
        // bắt đầu ínert bình luận 
        $sqlbl = "INSERT INTO binh_luan
                                      (noi_dung,ma_hh,ma_kh,ngay_bl)
                                      VALUES
                                      ('$noi_dung','$id','$ma_kh','$date') " ; 
         insert_update_delete($sqlbl) ;                              
    }
    else{
        $err =  "Vui lòng đăng nhập trước khi bình luận !";
    }

    // in bình luận 
    $sqlinbl = "SELECT * FROM binh_luan where ma_hh = '$id'" ; 
    $bls = select_all($sqlinbl) ; 

    
    include "header_small.php" ; 

?>

<style>
#menu_lh ul {
    width: auto;
    padding: 0;
    list-style-type: none;
    text-align: left;
    border: 1px solid #f5f5f5;
    box-shadow: 2px 2px 1px gray;
}

#menu_lh li {
    width: auto;
    height: 40px;
    line-height: 40px;
    border-bottom: 1px solid #e8e8e8;
    padding: 0 1em;
}

#menu_lh li a {
    text-decoration: none;
    color: #333;
    display: block;
    font-size: 13px;
}

#menu_lh li:hover {
    background: #f5f5f5;
}

#menu_lh li a {
    /* font-weight: bold; */
    transition: .3s;
}

#menu_lh li:hover a {
    /* font-weight: bold; */
    transform: scale(1.07);
    transition: .3s;
}

/*==Dropdown Menu==*/
#menu ul li {
    position: relative;
}

#menu_lh .sub-menu {
    position: absolute;
    left: 170px;
    top: 0;
    display: none;
    width: 150px;
    box-shadow: 2px 2px 2px gray;
    z-index: 1;
}

#menu_lh ul li:hover .sub-menu {
    display: block;
}

#menu_lh a {
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
}

.tt-sp {
    text-align: center;
    background-color: #cc0000;
    height: 40px;

}

.tt-sp h4 {
    font-size: 17px;
    color: white;
    padding-top: 10px;
}
</style>

<div class="container mt-5 ct-sp">
    <div class="row ct-sp-top mb-4" style="border-bottom: 2px solid #f5f5f5;">
        <div class="col-md-4">
            <div class="ten-sp mb-2">
                <h3 style="margin-top: 10px;"><?php echo $hang_hoa['ten_hh'] ?> </h3>
                <!-- <div class="sao">
                   <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                        <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                        <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                        <i class="fa fa-star" aria-hidden="true" style="color:#ffcc00 ;"></i>
                        <i class="fa fa-star" aria-hidden="true" style=" color: gray;"></i>
                        <span style="color: red;">(<?php echo ($hang_hoa['so_luot_xem'] - 2) ?> người đánh giá) </span>
                   </div> -->
            </div>
        </div>
        <div class="col-md-6"></div>
        <div class="col-md-2">
            <div class="likeandshare" style="margin-top: 13px;">
                <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-width=""
                    data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>
            </div>
        </div>
        <hr>
    </div>

    <div class="row">
        <div class="col-md-5 text-center" style="border: 3px solid #f5f5f5;">
            <img src="<?php echo BASE_URL. $hang_hoa['hinh'] ?>" alt="" width="350px" height="400px"
                style="margin-top: 30px;">
        </div>
        <div class="col-md-4 ct-sp-mid">
            <div class="ct-sp-mid-top">
                <img src="././public/image/ship2.jpg" alt="" width="100%">
                <img src="././public/image/ship.png" alt="" width="100%">

                <div class="ct-sp-price mt-4">
                    <h3 style="color: red;"><?php echo number_format($hang_hoa['don_gia']) ?><u
                            style="color: red;">đ</u></h3>
                </div>

                <div class="tg">
                    Trả góp 0%
                </div>

                <div class="qua">
                     <button class="btn btn-danger"><i class="fa fa-gift" aria-hidden="true"></i> Mua Online được tặng
                        thêm quà</button>
                </div>

                <div class="dv">
                    <div class="dv-tt">
                        <h3>CÁC DỊCH VỤ MIỄN PHÍ</h3>
                    </div>
                    <form action="#" method="POST">
                        <input type="checkbox" value="Giao ngay từ cửa hàng gần bạn nhất">&ensp;Giao ngay từ cửa hàng
                        gần bạn nhất <br>
                        <input type="checkbox" value="Chuyển danh bạ, dữ liệu qua máy mới">&ensp;Chuyển danh bạ, dữ liệu
                        qua máy mới <br>
                        <input type="checkbox" value="Mang thêm điện thoại khác để bạn xem">&ensp;Mang thêm điện thoại
                        khác để bạn xem <br>
                    </form>
                </div>

                <div class="div">
                    <table>
                        <tr>
                            <td>
                                <a href="<?php echo BASE_URL ?>tt-sp.php?id=<?php echo $hang_hoa['id'] ?>">
                                    <button type="submit" class="btn btn-danger mr-2" style="margin-top: 30px;">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        <span>Mua ngay <span class="ex_subcart">giao hàng tận nơi</span></span>
                                    </button>
                                </a>
                            </td>

                            <td>
                                <a href="">
                                    <button type="submit" class="btn btn-info" style="margin-top: 30px;">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        <span>Mua trả góp <span class="ex_subcart">xét duyệt online</span></span>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
        <div class="col-md-3">
            <div class="ex_rgtbox ex_camket">
                <h3>XSHOP cam kết</h3>
                <div class="boxes-title" style="display:none">
                    <h2>Cam kết iphone cũ</h2>
                </div>
                <div class="textwidget">
                    <ul>
                        <li> <i class="fa fa-thumbs-o-up" aria-hidden="true" style="color: #4cdf12;"></i>&ensp;<span
                                style="color: #ff0000;"><a style="color: #ff0000;"
                                    href="https://clickbuy.com.vn/thay-doi-de-cung-co-chinh-sach-bao-hanh-so-1-vi-nguoi-dung-neu-loi-bao-hanh-lai-tu-dau/"><strong>Bảo
                                        hành phần cứng trọn đời khi mua iPhone cũ</strong> <span
                                        style="color: #008000;">(chỉ tiết)</span></a></span></li>
                        <li> <i class="fa fa-thumbs-o-up" aria-hidden="true" style="color: #4cdf12;"></i>&ensp;<span
                                style="color: #ff0000;"><a style="color: #ff0000;"
                                    href="https://clickbuy.com.vn/thay-doi-de-cung-co-chinh-sach-bao-hanh-so-1-vi-nguoi-dung-neu-loi-bao-hanh-lai-tu-dau/"><strong>Bảo
                                        hành 1 đổi 1 trong vòng 3 tháng</strong> <span style="color: #008000;">(chỉ
                                        tiết)</span></a></span></li>
                        <li> <i class="fa fa-thumbs-o-up" aria-hidden="true" style="color: #4cdf12;"></i>&ensp;<span
                                style="color: #ff0000;"><a style="color: #ff0000;"
                                    href="https://clickbuy.com.vn/thay-doi-de-cung-co-chinh-sach-bao-hanh-so-1-vi-nguoi-dung-neu-loi-bao-hanh-lai-tu-dau/"><strong>Tặng
                                        sim ghép thần thánh cho những máy lock</strong> <span
                                        style="color: #008000;">(chỉ tiết)</span></a></span></li>
                        <li class="p1"> <i class="fa fa-thumbs-o-up" aria-hidden="true"
                                style="color: #4cdf12;">&ensp;</i>Tất cả iPhone cũ|TBH bán ra đều cam kết máy
                            <strong><span style="color: #ff0000;">đẹp – Nguyên bản</span></strong> – tất cả iPhone
                            cũ|TBH đều đã được mở máy kiểm tra zin. Khách hàng có thể mở máy tại shop để check
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-7">
            <!------------ form để bình luận ----------------->
            <h3 style="text-transform: uppercase;">Bình luận</h3>
            <form action="" method="POST">
                <textarea name="commentPro" id="inputcommentPro" class="form-control" rows="4"></textarea> <br>
                <?php if (isset($err)) {
                        echo "<p style='color: red;'>" . $err . "</p>";
                     } ?>
                <button type="submit" name="comment" class="btn btn-danger">Bình luận</button>
            </form>

            <?php
                    foreach ($bls as $row) {
                           $id_user = "" ; 
                           $id_user = $row['ma_kh'];
                        foreach (select_all("SELECT * FROM khach_hang WHERE id= '$id_user'") as $tow) { ?>
            <div style="margin:20px 0px;border-bottom:1px solid #cdcdcd">
                <img src="<?php echo BASE_URL. $tow['hinh'] ?>" class="img-fluid" width="20" alt=""
                    style="border-radius: 50%;">
                <b><?= $tow['ho_ten'] ?></b> <span style="float:right;font-size:10px"><?= $row['ngay_bl'] ?></span>
                <p class="m_text"></i><?= $row['noi_dung'] ?></p>
                <p><i class="fa fa-thumbs-up" style="color: gray;" aria-hidden="true"></i>&ensp;<i style="color: gray;"
                        class="fa fa-thumbs-down" aria-hidden="true"></i>&ensp;<i style="color: gray;"
                        class="fa fa-commenting-o" aria-hidden="true"></i></p>
                <?php
                    if (isset($_SESSION['user'])) {
                        if ($tow['id'] == $_SESSION['user']['id']) { ?>
                <a
                    href="<?php BASE_URL ?>chi_tiet_sp.php?id=<?php echo $id ?>&ma_loai=<?php echo $ma_loai ?>&id_cmt=<?php echo $row['id'] ?>">Xóa</a>
                <?php

                }
                    } else if (isset($_SESSION['admin']))
                            if ($tow['id'] == $_SESSION['admin']['id']) { ?>
                <a
                    href="<?php BASE_URL ?>chi_tiet_sp.php?id=<?php echo $id ?>&ma_loai=<?php echo $ma_loai ?>&id_cmt=<?php echo $row['id'] ?>">Xóa</a>

                <?php } ?>
            </div>
            <?php
                        }
                    }
                    ?>

        </div>

        <div class="col-md-2"></div>
        <div class="col-md-3">
            <div id="menu_lh">
                <ul>
                    <div class="tt-sp">
                        <h4>SẢN PHẨM LIÊN QUAN</h4>
                    </div>
                    <?php foreach ($lq as $key) { ?>
                    <li>
                        <a
                            href="<?php BASE_URL ?>chi_tiet_sp.php?id=<?php echo $key['id'] ?>&ma_loai=<?php echo $key['ma_loai'] ?>">
                            <table>
                                <tr>
                                    <td><img src="<?php echo BASE_URL. $key['hinh'] ?>" alt="" width="35px"
                                            height="35px"></td>
                                    <td style="font-size: 10px;"><?php echo $key['ten_hh'] ?></td>
                                </tr>
                            </table>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php" ?>