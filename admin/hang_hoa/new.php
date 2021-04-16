<?php 
      include "../layout/header.php" ; 
      require_once APP_PATH."/dao/pdo.php" ; 


      // lấy danh mục và in za phần danh mục của lại hàng 
      $sql = "SELECT * FROM loai_hang" ; 
      $loai_hangs = select_all($sql) ; 

?>
<div class="col-md-10">
    <div style=" width: 100%; background-color: indianred; height: 45px; color: white; margin-right: 40px;"
        class="text-center mb-5 mt-4">
        <span>
            <h2 style="text-transform: uppercase;">Thêm mới hàng hóa</h2>
        </span>
    </div>
    <div class="row">
        <div class="col-md-10">
            <form action="<?php echo BASE_URL ?>admin/hang_hoa/post_new.php" method="POST"
                enctype="multipart/form-data">
                <?php if(isset($_GET['msg'])) : ?>
                <span class="text-danger d-flex justify-content-center align-items-center"> <?= $_GET['msg'] ?> </span>
                <?php endif ?>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label> <br>
                            <input type="text" name="ten_hh" placeholder="Tên sản phẩm" class="form-control">
                            <?php if(isset($_GET['ten_hherr'])):?>
                            <span class="text-danger"><?php echo $_GET['ten_hherr'] ?></span>
                            <?php endif ?>
                        </div>

                        <div class="form-group">
                            <label for="price">Giá sản phẩm</label><br>
                            <input type="text" name="don_gia" placeholder="Giá sản phẩm" class="form-control">
                            <?php if(isset($_GET['don_giaerr'])):?>
                            <span class="text-danger"><?php echo $_GET['don_giaerr'] ?></span>
                            <?php endif ?>
                        </div>

                        <div class="form-group">
                            <label for="sale">Giảm giá </label> <br>
                            <input type="text" name="giam_gia" placeholder="Tính theo %" class="form-control">
                            <br><br>
                            <?php if(isset($_GET['giam_giaerr'])):?>
                            <span class="text-danger"><?php echo $_GET['giam_giaerr'] ?></span>
                            <?php endif ?>
                        </div>

                        <div class="form-group">
                            <label>Ảnh sản phẩm</label>
                            <input id="img" type="file" name="hinh" class="form-control">
                            <?php if(isset($_GET['hinherr'])):?>
                            <span class="text-danger"><?php echo $_GET['hinherr'] ?></span>
                            <?php endif ?>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Đặc biệt</label>
                            <div class="form-control">
                                <input name="dac_biet" value="0" type="radio"> Đặc biệt
                                <input name="dac_biet" value="1" type="radio" checked> Bình thường
                                <?php if(isset($_GET['dac_bieterr'])):?>
                                <span class="text-danger"><?php echo $_GET['dac_bieterr'] ?></span>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ma_loai">Danh mục</label>
                            <select name="ma_loai" class="form-control">
                                <?php foreach ($loai_hangs as $key ) { ?>
                                <option value="<?= $key['id'] ?>">
                                    <?= $key['ten_loai']?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Ngày nhập</label>
                            <input type="text" name="ngay_nhap" class="form-control" placeholder="Ngày nhập">
                            <?php if(isset($_GET['ngay_nhaperr'])):?>
                            <span class="text-danger"><?php echo $_GET['ngay_nhaperr'] ?></span>
                            <?php endif ?>
                        </div>

                        <div class="form-group">
                            <label for="details">Mô tả</label><br>
                            <textarea name="mo_ta" id="" cols="70" rows="2" class="form-control"></textarea>
                            <?php if(isset($_GET['mo_taerr'])):?>
                            <span class="text-danger"><?php echo $_GET['mo_taerr'] ?></span>
                            <?php endif ?>
                        </div>

                        <!-- <div class="form-group">
                            <label for="">Người giới thiệu</label><br>
                            <input type="text" name="nguoi_gioi_thieu" class="form-control"
                                placeholder="Người giới thiệu">
                            <?php if(isset($_GET['nguoi_gioi_thieuerr'])):?>
                            <span class="text-danger"><?php echo $_GET['nguoi_gioi_thieuerr'] ?></span>
                            <?php endif ?>
                        </div> -->
                    </div>
                </div>

                <div class="row d-flex justify-content-center align-items-center">
                    <button type="submit" class="btn btn-info mr-3 ml-5" name="addPro">Thêm mới</button>
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