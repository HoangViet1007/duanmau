<?php
     include "../layout/header.php" ; 
     require_once APP_PATH."/dao/pdo.php" ; 


?>

<div class="col-md-10">
    <div style=" width: 100%; background-color: indianred; height: 45px; color: white; margin-right: 40px;"
        class="text-center mb-5 mt-4">
        <span>
            <h2 style="text-transform: uppercase;">Thêm mới user</h2>
        </span>
    </div>

    <div class="row">
        <div class="col-md-10">
            <form action="<?php echo BASE_URL ?>admin/khach_hang/post_new.php" method="POST"
                enctype="multipart/form-data">
                <?php if(isset($_GET['msg'])) : ?>
                <span class="text-danger d-flex justify-content-center align-items-center"> <?= $_GET['msg'] ?> </span>
                <?php endif ?>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Mã khách hàng</label>
                            <input type="text" name="id" class="form-control" placeholder="Mã khách hàng">
                            <?php if(isset($_GET['iderr'])):?>
                            <span class="text-danger"><?php echo $_GET['iderr'] ?></span>
                            <?php endif ?>
                        </div>

                        <div class="form-group">
                            <label for="">Mật khẩu</label><br>
                            <input type="password" name="mat_khau" placeholder="Mật khẩu" class="form-control">
                            <?php if(isset($_GET['mat_khauerr'])):?>
                            <span class="text-danger"><?php echo $_GET['mat_khauerr'] ?></span>
                            <?php endif ?>
                        </div>

                        <div class="form-group">
                            <label for="">Nhập lại mật khẩu </label> <br>
                            <input type="password" name="cf_mat_khau" placeholder="Nhập lại mật khẩu"
                                class="form-control"> <br><br>
                            <?php if(isset($_GET['cf_mat_khauerr'])):?>
                            <span class="text-danger"><?php echo $_GET['cf_mat_khauerr'] ?></span>
                            <?php endif ?>
                        </div>

                        <div class="form-group">
                            <label>Họ và tên</label>
                            <input type="text" name="ho_ten" class="form-control" placeholder="Họ và tên">
                            <?php if(isset($_GET['ho_tenerr'])):?>
                            <span class="text-danger"><?php echo $_GET['ho_tenerr'] ?></span>
                            <?php endif ?>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Kích hoạt</label>
                            <div class="form-control">
                                <input name="kich_hoat" value="0" type="radio" checked> Chưa kích hoạt &ensp;
                                <input name="kich_hoat" value="1" type="radio"> Kích hoạt
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Hình ảnh</label>
                            <input type="file" name="hinh" id="hinh" class="form-control">
                            <?php if(isset($_GET['hinherr'])):?>
                            <span class="text-danger"><?php echo $_GET['hinherr'] ?></span>
                            <?php endif ?>
                        </div>

                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Email">
                            <?php if(isset($_GET['emailerr'])):?>
                            <span class="text-danger"><?php echo $_GET['emailerr'] ?></span>
                            <?php endif ?>
                        </div>

                        <div class="form-group">
                            <label for="">Vai trò</label><br>
                            <div class="form-control">
                                <input name="vai_tro" value="0" type="radio" checked> Khách hàng &ensp;
                                <input name="vai_tro" value="1" type="radio"> Nhân viên
                            </div>
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
                        <a href="<?php echo BASE_URL ?>admin/khach_hang/list.php" class="btn btn-danger">Hủy</a>
                    </div>
            </form>
        </div>
    </div>


</div>
</div>
</div>
</body>

</html>