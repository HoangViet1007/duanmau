<?php 
    include  "../layout/header.php" ;
    require_once APP_PATH."/dao/pdo.php" ; 
 

    if (!isset($_GET['product'])) {
        $product = 1;
    } else {
        $product = $_GET['product'];
    }
    $data = 5;
    $sql = "SELECT count(*) FROM `khach_hang`";
    $conn = connect() ; 
    $result = $conn->prepare($sql);
    $result->execute();
    $number = $result->fetchColumn();
    $page = ceil($number / $data);
    $tin = ($product - 1) * $data;

      // xóa tất cả 
    if(isset($_POST['xoaAll'])){
        if(isset($_POST['delete'])){
            foreach ($_POST['delete'] as $key => $value) {
                $sql = "delete from khach_hang where id = '$value'" ; 
                insert_update_delete($sql) ; 
            }
        }
   }
  

    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "" ; 

    $sql = "SELECT * FROM khach_hang LIMIT $tin, $data" ; 
    
    if($keyword !== ""){
        $sql .= "where id like '%$keyword%' or ho_ten like '%$keyword%' ";
    }
    $khach_hangs = select_all($sql) ; 

?>
<div class="col-md-10">
        <div style=" width: 100%; background-color: indianred; height: 45px; color: white; margin-right: 40px;" class="text-center mb-5 mt-4">
                <span><h2 style="text-transform: uppercase;">Danh sách user</h2></span>
        </div>
        <div class="row">
            <div class="col-md-12 text-danger d-flex justify-content-center align-items-center">
                <form action="" method="GET" class="mt-4">
                    <div class="form-group">
                        <label for=""><button class="btn btn-danger" style="margin-top: -5px;">Tìm Kiếm</button></label>
                        <input type="text" placeholder="Tìm kiếm ..." style="height: 38px;" name="keyword" value="<?= $keyword ?>">
                    </div>

                    <?php if(isset($_GET['msg'])) : ?>
                        <span class="text-danger d-flex justify-content-center align-items-center mb-3"> <?= $_GET['msg'] ?> </span>
                    <?php endif ?>  
                </form>
            </div>
        </div> 

        <div class="row">
             <div class="col-md-12 d-flex justify-content-center align-items-center">
                <form action="" method="POST">
                    <table class="table " style="font-size: 13px;">
                        <thead style="background-color: indianred;">
                            <tr>
                                <th width="20"><i class="fa fa-check-square-o" aria-hidden="true"></i></th>
                                <th>MÃ </th>
                                <!-- <th>MẬT KHẨU</th> -->
                                <th>HỌ VÀ TÊN</th>
                                <th>KÍCH HOẠT</th>
                                <th>HÌNH ẢNH</th>
                                <th>EMAIL</th>
                                <th>VAI TRÒ</th>
                                <th>
                                    <a href="<?= BASE_URL?>admin/khach_hang/new.php" class="btn btn-info">
                                        Tạo mới
                                    </a>
                                </th>
                            
                            </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($khach_hangs as $key) {?>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="delete[]" value="<?php echo $key['id'] ?>">
                                    </td>
                                    <td><?php echo $key['id'] ?></td>
                                    <!-- <td><?php echo $key['mat_khau'] ?></td> -->
                                    <td><?php echo $key['ho_ten'] ?></td>
                                    <td>
                                        <?php if ($key['kich_hoat'] == "1") {
                                            echo "Kích hoat";
                                        } else {
                                            echo "Chưa kích hoạt";
                                        } 
                                        ?>  
                                    </td>
                                    <td>
                                        <img src="<?php echo BASE_URL. $key['hinh'] ?>" class="img-fluid" width="50" alt="">
                                    </td>
                                    <td><?php echo $key['email'] ?></td>
                                    <td>
                                        <?php if ($key['vai_tro'] == "1") {
                                            echo "Nhân viên";
                                        } else {
                                            echo "Khách hàng";
                                        } 
                                        ?>  
                                    </td>

                                    <td>
                                    <a href="<?php echo BASE_URL ?>admin/khach_hang/edit.php?id=<?= $key['id'] ?>" class="btn btn-danger">Sửa</a>
                                    <a href="<?php echo BASE_URL ?>admin/khach_hang/delete.php?id=<?= $key['id'] ?>" class="btn btn-primary" onclick="return confirm('Bạn chắc chắn muốn xóa ?')">Xóa</a>
                                    </td>
                                </tr>
                        <?php } ?>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td colspan="4">
                                        <input type="button" value="Chọn tất cả" id="chonAll" class=" ml-3 btn btn-info">
                                        <input type="button" value=" Bỏ chọn tất cả" id="bochonAll" class="btn btn-danger">
                                        <input type="submit" value=" Xóa các mục chọn" id="xoaAll" name="xoaAll" class="btn btn-info">
                                    </td>  
                                </tr>
                        </tbody>

                    </table>
                </form>
             </div>
        </div>

        <?php
            for ($t = 1; $t <= $page; $t++) { ?>
                &nbsp;<a name="" id="" class="btn btn-primary" href="<?php echo BASE_URL ?>admin/khach_hang/list.php?product=<?= $t ?>" role="button"> <?= $t ?></a>
            <?php
            }
            ?>

           
   </div>
   

    
   </div>
   </div>
 
   <script type="text/javascript" src="../../public/js/checkbox.js"></script>
</body>
</html>