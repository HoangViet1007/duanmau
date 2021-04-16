<?php
   require_once "../header_small.php" ;

?>

   <div class="container mt-3">
        <div class="row">
            <?php include APP_PATH."/header_loai_hang.php" ?>
               <div class="col-md-9">  
                    <div class="row">
                        <div style="width: 100%; text-align: center; background-color: #cc0000;color: white;height: 40px;padding-top: 5px; ">
                            <h3>ĐĂNG KÍ THÀNH VIÊN</h3>
                        </div>
                        <?php if(isset($_GET['msg'])) : ?>
                            <span class="text-danger d-flex justify-content-center align-items-center"> <?= $_GET['msg'] ?> </span>
                        <?php endif ?>
                    </div> 

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <form action="<?php echo BASE_URL ?>tai_khoan/post_new.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                                <label for="">TÊN ĐĂNG NHẬP</label>
                                                <input type="text" name="id" class="form-control" placeholder="Tên đăng nhập">
                                                <?php if(isset($_GET['iderr'])):?>
                                                    <span class="text-danger"><?php echo $_GET['iderr'] ?></span>
                                                <?php endif ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="">MẬT KHẨU</label>
                                            <input type="password" name="mat_khau"  placeholder="Mật khẩu" class="form-control">
                                            <?php if(isset($_GET['mat_khauerr'])):?>
                                                <span class="text-danger"><?php echo $_GET['mat_khauerr'] ?></span>
                                            <?php endif ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="">XÁC NHẬN MẬT KHẨU</label>
                                            <input type="password" name="cf_mat_khau"  placeholder="Nhập lại mật khẩu" class="form-control">
                                            <?php if(isset($_GET['cf_mat_khauerr'])):?>
                                                <span class="text-danger"><?php echo $_GET['cf_mat_khauerr'] ?></span>
                                            <?php endif ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Họ và tên</label>
                                            <input type="text" name="ho_ten" class="form-control" placeholder="Họ và tên">
                                            <?php if(isset($_GET['ho_tenerr'])):?>
                                                <span class="text-danger"><?php echo $_GET['ho_tenerr'] ?></span>
                                            <?php endif ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="text" name="email" class="form-control" placeholder="Email" >
                                            <?php if(isset($_GET['emailerr'])):?>
                                                <span class="text-danger"><?php echo $_GET['emailerr'] ?></span>
                                            <?php endif ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Hình ảnh</label>
                                            <input type="file" name="hinh" id="hinh" class="form-control">
                                            <?php if(isset($_GET['hinherr'])):?>
                                                <span class="text-danger"><?php echo $_GET['hinherr'] ?></span>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-5" style="margin-left: 320px;">
                                    <button type="submit" class="btn btn-info mr-3 ml-5" name="addPro">Lưu</button>
                                    <a href="<?php echo BASE_URL ?>" class="btn btn-danger">Hủy</a>
                                </div>

                            </form>
                        </div>
                    </div>                             
               </div>
        </div>
   </div>
   <?php include "../footer.php" ?>