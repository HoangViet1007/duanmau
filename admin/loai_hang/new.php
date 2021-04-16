<?php
    include "../layout/header.php" ; 
    require_once APP_PATH."/dao/pdo.php" ;   
    
?>
   <div class="col-md-10">
        <div style=" width: 100%; background-color: indianred; height: 45px; color: white; margin-right: 40px;" class="text-center mb-5 mt-4">
                <span><h2 style="text-transform: uppercase;">Thêm mới loại hàng</h2></span>
        </div>
        

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <form action="<?php echo BASE_URL ?>admin/loai_hang/post_new.php" method="POST">
                        <?php if(isset($_GET['msg'])) : ?>
                                        <span class="text-danger d-flex justify-content-center align-items-center"> <?= $_GET['msg'] ?> </span>
                        <?php endif ?>  
                        <div class="form-group">
                            <label for=""><h6>Mã loại hàng</h6></label>
                            <input type="text" disabled class="form-control" value="Auto number">
                        </div>

                        <div class="form-group">
                            <label for=""><h6>Tên loại hàng</h6></label>
                            <input type="text" class="form-control" placeholder="Nhập tên loại hàng..." name="ten_loai_hang">
                            <?php if(isset($_GET['ten_loai_hangerr'])) : ?>
                                    <span class="text-danger"> <?= $_GET['ten_loai_hangerr'] ?> </span>
                                <?php endif ?>  
                        </div>

                        <div class="d-flex justify-content-center align-items-center">
                            <input type="submit" class="btn btn-primary mr-3" value="Thêm">
                            <input type="reset" class="btn btn-info mr-3" value="Resset">
                            <a href="<?php echo BASE_URL ?>admin/loai_hang/list.php" class="btn btn-danger">Danh sách</a>
                        </div>


                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>
   </div>
   

    
   </div>
   </div>
</body>
</html>