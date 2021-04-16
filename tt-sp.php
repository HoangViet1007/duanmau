<?php
    require_once 'config.php';
    require_once APP_PATH."/dao/pdo.php" ; 
    include "header_small.php" ; 

   // laays id  
   $id = isset($_GET['id']) ? $_GET['id'] : "" ; 
   $sql = "SELECT * FROM hang_hoa where id = '$id'" ; 
   $hang_hoa = select_one($sql) ; 



?>
<style>
a {
    text-decoration: none;
}

a:hover {
    text-decoration: none;
}

.box {
    width: 100%;
    height: auto;
    margin-top: 30px;
    border: 2px solid #DDDDDD;
    border-radius: 5px;
    box-shadow: 2px 4px 4px #CCCCCC;
    padding: 15px;
}

.box h3 {
    text-transform: uppercase;
    color: gray;
}

.aaa {
    color: gray;
    font-weight: 600;
}

.bb {
    color: gray;
    margin-top: -25px;
    float: right;
    font-weight: 700;
}

.dathang {
    width: 100%;
    background-color: #cc0000;
    padding: 10px;
    text-align: center;
    margin-top: 20px;
    border-radius: 5px;
}

.dathang p {
    color: white;
    font-size: 20px;
    margin-top: 5px;
}
</style>
<div class="container">
    <div class="row  d-flex justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="box">
                <h3 class="text-center">thông tin thanh toán</h3>
                <form action="<?php echo BASE_URL ?>post_tt-sp.php" method="POST" class="pt-4">
                   <input type="hidden" name="id" class="form-control" value="<?php echo $id ?>">
                   <input type="hidden" name="sp" class="form-control" value="<?php echo $hang_hoa['ten_hh'] ?>">
                   <input type="hidden" name="g" class="form-control" value="<?php echo number_format($hang_hoa['don_gia']) ?>">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" placeholder="Họ và tên" class="form-control" name="ho_ten">
                                <?php if(isset($_GET['ho_tenerr'])):?>
                                <span class="text-danger"><?php echo $_GET['ho_tenerr'] ?></span>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" placeholder="Số điện thoại" class="form-control" name="sdt">
                                <?php if(isset($_GET['sdterr'])):?>
                                <span class="text-danger"><?php echo $_GET['sdterr'] ?></span>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" placeholder="Email" class="form-control" name="email">
                                <?php if(isset($_GET['emailerr'])):?>
                                <span class="text-danger"><?php echo $_GET['emailerr'] ?></span>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select name="tinh_tp" id="" class="form-control">
                                    <option value="" selected="selected">Tỉnh / Thành phố</option>
                                    <option value="An Giang">An Giang</option>
                                    <option value="Vũng Tàu">Vũng Tàu</option>
                                    <option value="Bắc Giang">Bắc Giang</option>
                                    <option value="Bắc Kạn">Bắc Kạn</option>
                                    <option value="Bạc Liêu">Bạc Liêu</option>
                                    <option value="Bắc Ninh">Bắc Ninh</option>
                                    <option value="Bến Tre">Bến Tre</option>
                                    <option value="Bình Định">Bình Định</option>
                                    <option value="Bình Dương">Bình Dương</option>
                                    <option value="Bình Phước">Bình Phước</option>
                                    <option value="Bình Thuận">Bình Thuận</option>
                                    <option value="Cà Mau">Cà Mau</option>
                                    <option value="Cần Thơ">Cần Thơ</option>
                                    <option value="Cao Bằng">Cao Bằng</option>
                                    <option value="Đà Nẵng">Đà Nẵng</option>
                                    <option value="Đắk Lắk">Đắk Lắk</option>
                                    <option value="Đắk Nông">Đắk Nông</option>
                                    <option value="Điện Biên">Điện Biên</option>
                                    <option value="Đồng Nai">Đồng Nai</option>
                                    <option value="Đồng Tháp">Đồng Tháp</option>
                                    <option value="Gia Lai">Gia Lai</option>
                                    <option value="Hà Giang">Hà Giang</option>
                                    <option value="Hà Nam">Hà Nam</option>
                                    <option value="Hà Nội">Hà Nội</option>
                                    <option value="Hà Tĩnh">Hà Tĩnh</option>
                                    <option value="Hải Dương">Hải Dương</option>
                                    <option value="Hải Phòng">Hải Phòng</option>
                                    <option value="Hậu Giang">Hậu Giang</option>
                                    <option value="Hòa Bình">Hòa Bình</option>
                                    <option value="Hồ Chí Minh">Hồ Chí Minh</option>
                                    <option value="Hưng Yên">Hưng Yên</option>
                                    <option value="Khánh Hòa">Khánh Hòa</option>
                                    <option value="Kiên Giang">Kiên Giang</option>
                                    <option value="Kon Tum">Kon Tum</option>
                                    <option value="Lai Châu">Lai Châu</option>
                                    <option value="Lâm Đồng">Lâm Đồng</option>
                                    <option value="Lạng Sơn">Lạng Sơn</option>
                                    <option value="Lào Cai">Lào Cai</option>
                                    <option value="Long An">Long An</option>
                                    <option value="Nam Định"> Nam Định</option>
                                    <option value="Nghệ An">Nghệ An</option>
                                    <option value="Ninh Bình">Ninh Bình</option>
                                    <option value="Ninh Thuận">Ninh Thuận</option>
                                    <option value="Phú Thọ">Phú Thọ</option>
                                    <option value="Phú Yên">Phú Yên</option>
                                    <option value="Quảng Bình">Quảng Bình</option>
                                    <option value="Quảng Nam">Quảng Nam</option>
                                    <option value="Quảng Ngãi">Quảng Ngãi</option>
                                    <option value="Quảng Ninh">Quảng Ninh</option>
                                    <option value="Quảng Trị">Quảng Trị</option>
                                    <option value="Sóc Trăng">Sóc Trăng</option>
                                    <option value="Sơn La">Sơn La</option>
                                    <option value="Tây Ninh">Tây Ninh</option>
                                    <option value="Thái Bình">Thái Bình</option>
                                    <option value="Thái Nguyên">Thái Nguyên</option>
                                    <option value="Thanh Hóa">Thanh Hóa</option>
                                    <option value="Thừa Thiên Huế">Thừa Thiên Huế</option>
                                    <option value="Tiền Giang">Tiền Giang</option>
                                    <option value="Trà Vinh">Trà Vinh</option>
                                    <option value="Tuyên Quang">Tuyên Quang</option>
                                    <option value="Vĩnh Long">Vĩnh Long</option>
                                    <option value="Vĩnh Phúc">Vĩnh Phúc</option>
                                    <option value="Yên Bái">Yên Bái</option>
                                </select>
                                <!-- <?php if(isset($_GET['tinh_tperr'])):?>
                                <span class="text-danger"><?php echo $_GET['tinh_tperr'] ?></span>
                                <?php endif ?> -->
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" placeholder="Số nhà / tên đường , phường / xã" class="form-control"
                                    name="dc">
                                <?php if(isset($_GET['dcerr'])):?>
                                <span class="text-danger"><?php echo $_GET['dcerr'] ?></span>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h5 style="color: gray; text-transform: uppercase; margin-top: 10px;">Thông tin sản phẩm
                            </h5>
                            <div class="form-group">
                                <div>
                                    <p class="aaa">Tên sản phẩm : </p>
                                    <p class="bb"><?php echo $hang_hoa['ten_hh'] ?></p>
                                </div>

                                <div>
                                    <p class="aaa">Tổng : </p>
                                    <p class="bb" style="color: red;"><?php echo number_format($hang_hoa['don_gia']) ?>đ
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <input type="checkbox" style="margin-left: 15px;"> <span
                            style="color: gray; margin-top: -4px; margin-left: 15px;">Bạn ca đoan thông tin trên hoàn
                            toàn chính xác !</span>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-danger dathang" name="dat-hang">
                                <p><i class="fa fa-shopping-cart" aria-hidden="true"></i> Đặt Hàng</p>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once "footer.php" ?>