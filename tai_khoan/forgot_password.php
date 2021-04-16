<?php
   require_once "../header_small.php" ;
?>

<div class="container mt-3">
    <div class="row">
        <?php include APP_PATH."/header_loai_hang.php" ?>
        <div class="col-md-9">
            <div class="row">
                <div
                    style="width: 100%; text-align: center; background-color: #cc0000;color: white;height: 40px;padding-top: 5px; ">
                    <h3>QUÊN MẬT KHẨU</h3>
                </div>
                <p class="text-danger mt-2" style="margin-left: 280px;">(Vui lòng check Email để biết mật khẩu mới !)
                </p>
                <?php if(isset($_GET['msg'])) : ?>
                <span class="text-danger d-flex justify-content-center align-items-center mt-3"
                    style="margin-left: 350px;"> <?= $_GET['msg'] ?> </span>
                <?php endif ?>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <form action="<?php echo BASE_URL ?>tai_khoan/post_forgot_password.php" method="POST"
                        enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">TÊN ĐĂNG NHẬP</label>
                                    <input type="text" name="id" class="form-control" placeholder="Tên đăng nhập"
                                        value="">
                                    <?php if(isset($_GET['iderr'])):?>
                                    <span class="text-danger"><?php echo $_GET['iderr'] ?></span>
                                    <?php endif ?>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>EMAIL</label>
                                    <input type="text" name="email" class="form-control" placeholder="Email" value="">
                                    <?php if(isset($_GET['emailerr'])):?>
                                    <span class="text-danger"><?php echo $_GET['emailerr'] ?></span>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5" style="margin-left: 320px;">
                            <button type="submit" class="btn btn-info mr-3 ml-5" name="gui">GỬI</button>
                            <a href="<?php echo BASE_URL ?>" class="btn btn-danger">HỦY</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include APP_PATH."/footer.php" ?>