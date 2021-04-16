<?php
   require_once "../header_small.php" ;
   $value  = "" ; 
  if(isset($_SESSION['user'])) {
    $value = $_SESSION['user']['id'] ; 
 } elseif(isset($_SESSION['admin'])){ 
   $value = $_SESSION['admin']['id'] ; 
 } 


?>

   <div class="container mt-3">
        <div class="row">
            <?php include APP_PATH."/header_loai_hang.php" ?>
            <div class="col-md-9">  
               <div class="row">
                     <div style="width: 100%; text-align: center; background-color: #cc0000;color: white;height: 40px;padding-top: 5px; ">
                           <h3>ĐỔI MẬT KHẨU</h3>
                     </div>
                     <?php if(isset($_GET['msg'])) { ?>
                            <span class="text-danger mt-3" style="margin-left: 350px;"> <?= $_GET['msg'] ?> </span>
                     <?php } ?>
               </div>
                  
               <div class="row d-flex justify-content-center align-items-center mt-4">
                  <div class="col-md-12">
                     <form action="<?php echo BASE_URL ?>tai_khoan/post_edit_password.php?id=<?php echo $value ?>" method="POST" enctype="multipart/form-data">
                           <div class="row">
                              <div class="col-md-3"></div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="">TÊN ĐĂNG NHẬP</label>
                                    <input type="text" name="id" placeholder="Tên đăng nhập" disabled class="form-control" value="<?php echo $value ?>">
                                 </div>

                                 <div class="form-group">
                                    <label for="">MẬT KHẨU CŨ</label>
                                    <input type="password" name="old_password" placeholder="Mật khẩu cũ" class="form-control"> 
                                    <?php if(isset($_GET['old_passworderr'])) : ?>
                                       <span class="text-danger"> <?= $_GET['old_passworderr'] ?> </span>
                                    <?php endif ?>
                                 </div>

                                 <div class="form-group">
                                    <label for="">MẬT KHẨU MỚI</label>
                                    <input type="password" name="password" placeholder="Mật khẩu mới" class="form-control"> 
                                    <?php if(isset($_GET['passworderr'])) : ?>
                                       <span class="text-danger"> <?= $_GET['passworderr'] ?> </span>
                                    <?php endif ?>
                                 </div>

                                 <div class="form-group">
                                    <label for="">XÁC NHẬN MẬT KHẨU</label>
                                    <input type="password" name="cf_password" placeholder="Nhập lại mật khẩu mới" class="form-control"> 
                                    <?php if(isset($_GET['cf_passworderr'])) : ?>
                                       <span class="text-danger"> <?= $_GET['cf_passworderr'] ?> </span>
                                    <?php endif ?>
                                 </div>
                              </div>
                           </div>

                           <div class="row" style="margin-left: 320px;">
                              <button type="submit" class="btn btn-info mr-3 ml-5" name="doi">Lưu</button>
                              <a href="<?php echo BASE_URL ?>" class="btn btn-danger">Hủy</a>
                           </div>
                    
                     </form>
                  </div>
                 
               </div>
            </div>
         </div>
   </div>
   <?php include "../footer.php" ?>