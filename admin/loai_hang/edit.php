<?php 
    require_once "../../config.php" ; 
    require_once APP_PATH."/dao/pdo.php" ; 
    require_once APP_PATH."/dao/loai.php" ; 
    // lấy id cần sửa trên đường dẫn xuống 
     if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM loai_hang where id = '$id'" ; 
        // kiểm tra xem trong date base có sp này ko 
        $cout = connect()->prepare($sql);
        $cout->execute();
        if ($cout->rowCount() > 0) {
            $select_one = select_one($sql) ;
        } else {
            try {
                header('location: ' . BASE_URL . "admin/loai_hang/list.php?msg=Loại hàng này không tồn tại !");      
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }else{
        header('location: ' . BASE_URL . "admin/loai_hang/list.php?msg=Loại hàng này không tồn tại !");      
    }
    require_once APP_PATH."/admin/layout/header.php" ; 

    

?>
   <div class="col-md-10">
        <div style=" width: 100%; background-color: indianred; height: 45px; color: white; margin-right: 40px;" class="text-center mb-5 mt-4">
                <span><h2 style="text-transform: uppercase;">Sửa mới loại hàng</h2></span>
        </div>
        

            <div class="row">
                <div class="col-md-6" style="border-right: 5px solid indianred;">
                     <h3 class="d-flex justify-content-center align-items-center" style="color: gray; text-transform: uppercase;">Thông tin cũ</h3>
                     <form action="">
                         <table class="table" style="font-size: 13px;">
                             <thead style="background-color: gray;">
                                  <th width="200">ID</th>
                                  <th >TÊN LOẠI HÀNG</th>
                            </thead>

                            <tbody>
                                <tr>
                                    <td><?php echo $select_one['id'] ?></td>
                                    <td><?php echo $select_one['ten_loai'] ?></td>
                                </tr>   
                            </tbody>
                         </table>
                     </form>

                </div>

                <div class="col-md-6">
                    <form action="<?php echo BASE_URL ?>admin/loai_hang/post_edit.php" method="POST">
                        <?php if(isset($_GET['msg'])) : ?>
                                        <span class="text-danger d-flex justify-content-center align-items-center"> <?= $_GET['msg'] ?> </span>
                        <?php endif ?>  
                        <div class="form-group">
                            <label for=""><h6>Mã loại hàng mới</h6></label>
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="text" disabled class="form-control" value="Auto number">
                        </div>

                        <div class="form-group">
                            <label for=""><h6>Tên loại hàng mới</h6></label>
                            <input type="text" class="form-control" placeholder="Nhập tên loại hàng..." name="ten_loai_hang" value="<?php echo $select_one['ten_loai'] ?>"> 
                            <?php if(isset($_GET['ten_loai_hangerr'])) : ?>
                                    <span class="text-danger"> <?= $_GET['ten_loai_hangerr'] ?> </span>
                                <?php endif ?>  
                        </div>

                        <!-- <div class="form-group">
                            <label for=""><h6>Người nhập</h6></label>
                            <input type="text" class="form-control" placeholder="Nhập tên người nhập" name="nguoi_nhap" value=""> 
                            <?php if(isset($_GET['nguoi_nhaperr'])) : ?>
                                    <span class="text-danger"> <?= $_GET['nguoi_nhaperr'] ?> </span>
                                <?php endif ?>  
                        </div> -->

                        <div class="d-flex justify-content-center align-items-center">
                            <input type="submit" class="btn btn-primary mr-3" value="Lưu">
                            <a href="<?php echo BASE_URL ?>admin/loai_hang/list.php" class="btn btn-danger mr-3">Hủy</a>
                            <a href="<?php echo BASE_URL ?>admin/loai_hang/list.php" class="btn btn-danger">Danh sách</a>
                        </div>


                    </form>
                </div>
            </div>
   </div>
   

    
   </div>
   </div>
</body>
</html>