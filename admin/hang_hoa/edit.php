<?php
     require_once "../../config.php" ; 
     require_once APP_PATH."/dao/pdo.php" ; 

    // lấy id trên đường dẫn xuống 
 // lấy id cần sửa trên đường dẫn xuống 
 if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM hang_hoa where id = '$id'" ; 
    // kiểm tra xem trong date base có sp này ko 
    $cout = connect()->prepare($sql);
    $cout->execute();
    if ($cout->rowCount() > 0) {
        // kiểm tra xem có tồn tại trong dâtbase ko 
        $sql = "select 
        hang_hoa.id,
        hang_hoa.ten_hh,
        hang_hoa.don_gia,
        hang_hoa.giam_gia,
        hang_hoa.hinh,
        hang_hoa.ngay_nhap,
        hang_hoa.mo_ta,
        hang_hoa.dac_biet,
        hang_hoa.so_luot_xem,
        hang_hoa.ma_loai,
        loai_hang.ten_loai as 'TÊN LOẠI'
        from hang_hoa join loai_hang on hang_hoa.ma_loai = loai_hang.id
        where hang_hoa.id='$id'" ; 
        $hang_hoa = select_one($sql) ;
    } else {
        try {
            header('location: ' . BASE_URL . "admin/hang_hoa/list.php?msg=Sản phẩm này không tồn tại !");      
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    }else{
        header('location: ' . BASE_URL . "admin/hang_hoa/list.php?msg=Sản phẩm này không tồn tại !");      
    }
  
     // lấy tất cả các danh mục
     $sql = "select * from loai_hang" ; 
     $loai_hangs = select_all($sql) ; 

     include "../layout/header.php" ; 

?>

<div class="col-md-10">
       
        <div class="row ml-1 mt-3" style=" width: 100%;  height: 45px; color: gray; margin-right: 40px; margin-bottom: 170px;" class="text-center mb-5 mt-4">
                <span><h2 style="text-transform: uppercase; margin-left: 410px;">thông tin cũ</h2></span>
                <div class="col-md-12 d-flex justify-content-center align-items-center">
                    <table class="table " style="font-size: 13px;">
                        <thead style="background-color: indianred;">
                            <tr>
                                <th>STT</th>
                                <th>TÊN HÀNG HÓA</th>
                                <th>ĐƠN GIÁ</th>
                                <th>GIẢM GIÁ</th>
                                <th>HÌNH ẢNH</th>
                                <th>NGÀY NHẬP</th>
                                <th>MÔ TẢ</th>
                                <th>KIỂU LOẠI</th>
                                <th>SỐ LƯỢT XEM</th>
                                <th>TÊN LOẠI</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td><?php echo $hang_hoa['id'] ?></td>
                                <td><?php echo $hang_hoa['ten_hh'] ?></td>
                                <td><?php echo number_format($hang_hoa['don_gia']) ?></td>
                                <td><?php echo $hang_hoa['giam_gia'] ?>%</td>
                                <td>
                                    <img src="<?php echo BASE_URL. $hang_hoa['hinh'] ?>" class="img-fluid" width="70" alt="">
                                </td>
                                <td><?php echo datetimeConvert($hang_hoa['ngay_nhap'])?></td>
                                <td><?php echo $hang_hoa['mo_ta'] ?></td>
                                <td>
                                <?php if ($hang_hoa['dac_biet'] == "1") {
                                    echo "Bình thường";
                                } else {
                                    echo "Đặc biệt";
                                } 
                                ?>
                                        
                                </td>
                                <td><?php echo $hang_hoa['so_luot_xem'] ?></td>
                                <td><?php echo $hang_hoa['TÊN LOẠI'] ?></td>
                                <td>
                            </tr>
                        </tbody>

                       
                    </table>
             </div>
        </div>

        <div style=" width: 100%; background-color: indianred; height: 45px; color: white; margin-right: 40px;" class="text-center mb-5 mt-4">
                <span><h2 style="text-transform: uppercase;">Sửa hàng hóa</h2></span>
        </div>


        <div class="row">
            <div class="col-md-10">
                <form action="<?php echo BASE_URL ?>admin/hang_hoa/post_edit.php" method="POST" enctype="multipart/form-data">
                        <?php if(isset($_GET['msg'])) : ?>
                                <span class="text-danger d-flex justify-content-center align-items-center"> <?= $_GET['msg'] ?> </span>
                        <?php endif ?>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="name">Tên sản phẩm mới</label> <br>
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="text" name="ten_hh" placeholder="Tên sản phẩm" class="form-control" value="<?php echo $hang_hoa['ten_hh'] ?>">
                                <?php if(isset($_GET['ten_hherr'])):?>
                                    <span class="text-danger"><?php echo $_GET['ten_hherr'] ?></span>
                                <?php endif ?>
                            </div>

                            <div class="form-group">
                                <label for="price">Giá sản phẩm mới</label><br>
                                <input type="text" name="don_gia"  placeholder="Giá sản phẩm" class="form-control" value="<?php echo $hang_hoa['don_gia'] ?>">
                                <?php if(isset($_GET['don_giaerr'])):?>
                                    <span class="text-danger"><?php echo $_GET['don_giaerr'] ?></span>
                                <?php endif ?>
                            </div>

                            <div class="form-group">
                                <label for="sale">Giảm giá mới</label> <br>
                                <input type="text" name="giam_gia"  placeholder="Tính theo %" class="form-control" value="<?php echo $hang_hoa['giam_gia'] ?>">
                                <?php if(isset($_GET['giam_giaerr'])):?>
                                    <span class="text-danger"><?php echo $_GET['giam_giaerr'] ?></span>
                                <?php endif ?>
                            </div>

                            <div class="form-group">
                                <label>Ảnh sản phẩm mới</label>
                                <input  id="img" type="file" name="hinh" class="form-control">
                                <?php if(isset($_GET['hinherr'])):?>
                                    <span class="text-danger"><?php echo $_GET['hinherr'] ?></span>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Đặc biệt mới</label>
                                <div class="form-control">
                                    <!-- <input name="dac_biet" value="0" type="radio" > Đặc biệt 
                                    <input name="dac_biet" value="1" type="radio" checked> Bình thường   -->

                                    <?php if($hang_hoa['dac_biet'] == 0){ ?>
                                        <input name="dac_biet" value="0" type="radio" checked> Đặc biệt 
                                        <input name="dac_biet" value="1" type="radio"> Bình thường  
                                    <?php } elseif ($hang_hoa['dac_biet'] == 1) {?>
                                        <input name="dac_biet" value="0" type="radio"> Đặc biệt  
                                        <input name="dac_biet" value="1" type="radio" checked> Bình thường 
                                    <?php } ?>   

                                    <?php if(isset($_GET['dac_bieterr'])):?>
                                        <span class="text-danger"><?php echo $_GET['dac_bieterr'] ?></span>
                                    <?php endif ?> 
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="ma_loai">Danh mục mới</label>
                                    <select name="ma_loai"  class="form-control">
                                          <?php foreach ($loai_hangs as $key ) { ?>
                                            <option <?php if($key['id'] == $hang_hoa['ma_loai']) : ?>
                                                    selected
                                               <?php endif ?>
                                       value="<?php echo $key['id'] ?>">
                                             <?php echo $key['ten_loai'] ?>
                                       </option>
                                          <?php } ?>
                                    </select>

                            </div>
                                 
                            <div class="form-group">
                                <label for="">Ngày nhập mới</label>
                                <input type="text" name="ngay_nhap" class="form-control" placeholder="Ngày nhập..." value="<?php echo datetimeConvert($hang_hoa['ngay_nhap']) ?>">
                                <?php if(isset($_GET['ngay_nhaperr'])):?>
                                    <span class="text-danger"><?php echo $_GET['ngay_nhaperr'] ?></span>
                                <?php endif ?>
                            </div>

                            <div class="form-group">
                                <label for="details">Mô tả mới</label><br>
                                    <textarea class="form-control" name="mo_ta" rows="2" cols="70"><?php echo $hang_hoa['mo_ta'] ?></textarea>
                                <?php if(isset($_GET['mo_taerr'])):?>
                                    <span class="text-danger"><?php echo $_GET['mo_taerr'] ?></span>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-center align-items-center">
                                <button type="submit" class="btn btn-info mr-3 ml-5" name="addPro">Lưu</button>
                                <a href="<?php echo BASE_URL ?>admin/hang_hoa/list.php" class="btn btn-danger">Hủy</a>
                        </div>

                </form>
            </div>
        </div> 

      
           
   </div>
   

    
   </div>
   </div>
</body>
</html>