<?php
   require_once "../header_small.php" ;
   if(isset($_SESSION['user'])){
      $ids = $_SESSION['user']['id'] ; 
   }
   if(isset($_SESSION['admin'])){
      $ids = $_SESSION['admin']['id'] ; 
   }
   
   // kiểm tra xem có tồn tại ko dâtbase ko 
   $sql = "SELECT * FROM khach_hang where id = '$ids'" ; 
   $kh = select_one($sql) ; 

   if(!$kh){
    header("location".BASE_URL."?msg=khách hàng này không tồn tại !") ; 
    die ; 
 }
?>

<div class="container mt-3">
    <div class="row">
        <?php include APP_PATH."/header_loai_hang.php" ?>
        <div class="col-md-9">
            <!-- <div class="row">
                     <div class="col-md-12">
                        <form action="#">
                           <table class="table mt-3" style="font-size: 13px;">
                               <thead style="background-color: #cc0000; color: white;">
                                  <th>TÊN ĐĂNG NHẬP</th>
                                  <th>HỌ TÊN</th>
                                  <th>EMAIL</th>
                                  <th>HÌNH ẢNH</th>
                               </thead>
                               <tbody>
                                       <tr>
                                          <td><?php echo $kh['id'] ?></td>
                                          <td><?php echo $kh['ho_ten'] ?></td>
                                          <td><?php echo $kh['email'] ?></td>
                                          <td>
                                          <img src="<?php echo BASE_URL. $kh['hinh'] ?>" class="img-fluid" width="50" alt="">
                                          </td>
                                       </tr>
                               </tbody>
                           </table>
                        </form>
                     </div>
                  </div> -->

            <div class="row">
                <div
                    style="width: 100%; text-align: center; background-color: #cc0000;color: white;height: 40px;padding-top: 5px; ">
                    <h3>CẬP NHẬT TÀI KHOẢN</h3>
                </div>
                <?php if(isset($_GET['msg'])) : ?>
                <span class="text-danger d-flex justify-content-center align-items-center mt-3"
                    style="margin-left: 350px;"> <?= $_GET['msg'] ?> </span>
                <?php endif ?>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <form action="<?php echo BASE_URL ?>tai_khoan/post_update.php?id=<?php echo $ids ?>" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">TÊN ĐĂNG NHẬP</label>
                                    <input type="text" name="id" class="form-control" disabled
                                        placeholder="Tên đăng nhập" value="<?php echo $ids ?>">
                                    <?php if(isset($_GET['iderr'])):?>
                                    <span class="text-danger"><?php echo $_GET['iderr'] ?></span>
                                    <?php endif ?>
                                </div>

                                <div class="form-group">
                                    <label for="">HỌ VÀ TÊN</label>
                                    <input type="text" name="ho_ten" placeholder="Họ tên" class="form-control"
                                        value="<?php echo $kh['ho_ten'] ?>">
                                    <?php if(isset($_GET['ho_tenerr'])):?>
                                    <span class="text-danger"><?php echo $_GET['ho_tenerr'] ?></span>
                                    <?php endif ?>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>EMAIL</label>
                                    <input type="text" name="email" class="form-control" placeholder="Email"
                                        value="<?php echo $kh['email'] ?>">
                                    <?php if(isset($_GET['emailerr'])):?>
                                    <span class="text-danger"><?php echo $_GET['emailerr'] ?></span>
                                    <?php endif ?>
                                </div>

                                <div class="form-group">
                                    <label for="">Hình ảnh mới</label>
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
<?php include APP_PATH."/footer.php" ?>