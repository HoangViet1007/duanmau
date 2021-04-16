<?php 
     require_once "../../config.php" ; 
     require_once APP_PATH."/dao/pdo.php" ; 
 
    
    // lấy id trên đường dẫn xuống và kiểm tra xem có tồn tại trong dâtbase ko 
    // lấy id trên đường dẫn xuống 
    // lấy id cần sửa trên đường dẫn xuống 
    if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM khach_hang where id = '$id'" ; 
    // kiểm tra xem trong date base có sp này ko 
    $cout = connect()->prepare($sql);
    $cout->execute();
    if ($cout->rowCount() > 0) {
        // kiểm tra xem có tồn tại trong dâtbase ko 
        $sql = "select * from khach_hang where id = '$id'" ; 
        $khach_hang = select_one($sql) ; 
    } else {
        try {
            header('location: ' . BASE_URL . "admin/khach_hang/list.php?msg=Khách hàng này không tồn tại !");      
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
     }
    
    }
    else{
        header('location: ' . BASE_URL . "admin/khach_hang/list.php?msg=Khách hàng này không tồn tại !");      
    }


   include "../layout/header.php" ; 

?>

<div class="col-md-10">
    <div class="row ml-1 mt-3"
        style=" width: 100%;  height: 45px; color: gray; margin-right: 40px; margin-bottom: 170px;"
        class="text-center mb-5 mt-4">
        <span>
            <h2 style="text-transform: uppercase; margin-left: 410px;">thông tin cũ</h2>
        </span>
        <div class="col-md-12 d-flex justify-content-center align-items-center">
            <table class="table" style="font-size: 13px;">
                <thead style="background-color: indianred;">
                    <tr>
                        <th>MÃ</th>
                        <!-- <th>MẬT KHẨU</th> -->
                        <th>HỌ VÀ TÊN </th>
                        <th>KÍCH HOẠT</th>
                        <th>HÌNH ẢNH</th>
                        <th>EMAIL</th>
                        <th>VAI TRÒ</th>

                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><?php echo $khach_hang['id'] ?></td>
                        <!-- <td><?php echo $khach_hang['mat_khau'] ?></td> -->
                        <td><?php echo $khach_hang['ho_ten'] ?></td>
                        <td><?php 
                              if($khach_hang['kich_hoat'] == "1"){
                                 echo "Kích hoạt" ; 
                              }else{
                                 echo "Chưa kích hoạt" ; 
                              }
                        ?></td>
                        <td>
                            <img src="<?php echo BASE_URL. $khach_hang['hinh'] ?>" class="img-fluid" width="70" alt="">
                        </td>
                        <td><?php echo $khach_hang['email'] ?></td>
                        <td><?php 
                              if($khach_hang['vai_tro'] == "1"){
                                 echo "Nhân viên" ; 
                              }else{
                                 echo "Khách hàng" ; 
                              }
                        ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div style=" width: 100%; background-color: indianred; height: 45px; color: white; margin-right: 40px;"
        class="text-center mb-5 mt-5">
        <span>
            <h2 style="text-transform: uppercase;">Sửa mới user</h2>
        </span>
    </div>

    <div class="row">
        <div class="col-md-10">
            <form action="<?php echo BASE_URL ?>admin/khach_hang/post_edit.php?" method="POST" enctype="multipart/form-data">
                <?php if(isset($_GET['msg'])) : ?>
                <span class="text-danger d-flex justify-content-center align-items-center"> <?= $_GET['msg'] ?> </span>
                <?php endif ?>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Mã khách hàng mới</label>
                            <input type="hidden" name="ids" value="<?php echo $id; ?>">
                            <input type="text" name="id" disabled class="form-control" placeholder="Mã khách hàng"
                                value="<?php echo $khach_hang['id'] ?>">
                            <?php if(isset($_GET['iderr'])):?>
                            <span class="text-danger"><?php echo $_GET['iderr'] ?></span>
                            <?php endif ?>
                        </div>

                        <div class="form-group">
                            <label for="">Mật khẩu mới</label><br>
                            <input type="password" name="mat_khau" placeholder="Mật khẩu" class="form-control"
                                value="<?php echo $khach_hang['mat_khau'] ?>">
                            <?php if(isset($_GET['mat_khauerr'])):?>
                            <span class="text-danger"><?php echo $_GET['mat_khauerr'] ?></span>
                            <?php endif ?>
                        </div>

                        <div class="form-group">
                            <label for="">Nhập lại mật khẩu mới</label> <br>
                            <input type="password" name="cf_mat_khau" placeholder="Nhập lại mật khẩu"
                                class="form-control" value="<?php echo $khach_hang['mat_khau'] ?>">
                            <?php if(isset($_GET['cf_mat_khauerr'])):?>
                            <span class="text-danger"><?php echo $_GET['cf_mat_khauerr'] ?></span>
                            <?php endif ?>
                        </div>

                        <div class="form-group">
                            <label>Họ và tên mới</label>
                            <input type="text" name="ho_ten" class="form-control" placeholder="Họ và tên"
                                value="<?php echo $khach_hang['ho_ten']  ?>">
                            <?php if(isset($_GET['ho_tenerr'])):?>
                            <span class="text-danger"><?php echo $_GET['ho_tenerr'] ?></span>
                            <?php endif ?>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Kích hoạt mới</label>
                            <div class="form-control">
                                <?php if($khach_hang['kich_hoat'] == 0){ ?>
                                <input name="kich_hoat" value="0" type="radio" checked> Chưa kích hoạt &ensp;
                                <input name="kich_hoat" value="1" type="radio"> Kích hoạt
                                <?php } elseif ($khach_hang['kich_hoat'] == 1) {?>
                                <input name="kich_hoat" value="0" type="radio"> Chưa kích hoạt &ensp;
                                <input name="kich_hoat" value="1" type="radio" checked> Kích hoạt
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Hình ảnh mới</label>
                            <input type="file" name="hinh" id="hinh" class="form-control">
                            <?php if(isset($_GET['hinherr'])):?>
                            <span class="text-danger"><?php echo $_GET['hinherr'] ?></span>
                            <?php endif ?>
                        </div>

                        <div class="form-group">
                            <label for="">Email mới</label>
                            <input type="text" name="email" class="form-control" placeholder="Email"
                                value="<?php echo $khach_hang['email'] ?>">
                            <?php if(isset($_GET['emailerr'])):?>
                            <span class="text-danger"><?php echo $_GET['emailerr'] ?></span>
                            <?php endif ?>
                        </div>

                        <div class="form-group">
                            <label for="">Vai trò mới</label><br>
                            <div class="form-control">
                                <?php if($khach_hang['vai_tro'] == 0){ ?>
                                <input name="vai_tro" value="0" type="radio" checked> Khách hàng &ensp;
                                <input name="vai_tro" value="1" type="radio"> Nhân viên
                                <?php } elseif ($khach_hang['vai_tro'] == 1) {?>
                                <input name="vai_tro" value="0" type="radio"> Khách hàng &ensp;
                                <input name="vai_tro" value="1" type="radio" checked> Nhân viên
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Kiểu</label>
                            <div class="form-control">
                                <input name="dai_ly" value="1" type="radio" checked> Cá nhân &ensp;
                                <input name="dai_ly" value="2" type="radio"> Đại lý
                            </div>
                            <?php if(isset($_GET['dai_lyerr'])):?>
                            <span class="text-danger"><?php echo $_GET['dai_lyerr'] ?></span>
                            <?php endif ?>
                        </div>
                    </div>
                </div>

                <div class="row d-flex justify-content-center align-items-center">
                    <button type="submit" class="btn btn-info mr-3 ml-5" name="addPro">Lưu</button>
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