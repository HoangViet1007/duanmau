<?php
    include "../layout/header.php" ; 
    require_once APP_PATH."/dao/pdo.php" ;   
    require_once APP_PATH."/dao/loai.php" ; 

    // làm phân trang 
    if (!isset($_GET['product'])) {
        $product = 1;
    } else {
        $product = $_GET['product'];
    }
    $data = 3;
    $sql = "SELECT count(*) FROM `loai_hang`";
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
                $sql = "delete from loai_hang where id = '$value'" ; 
                insert_update_delete($sql) ; 
            }
        }
   }

   // lấy keyword và thực hiện in za 
    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";

    $sql = "select * from loai_hang";

    if($keyword !== ""){
        $sql .= " where ten_loai like '%$keyword%' or id like '%$keyword%' LIMIT $tin , $data";
    }

   
    $loai_hangs = select_all($sql) ; 


   
?>
  <div class="col-md-10">
        <div style=" width: 100%; background-color: indianred; height: 45px; color: white; margin-right: 40px;" class="text-center mb-5 mt-4">
            <span><h2 style="text-transform: uppercase;">Quản lý loại hàng</h2></span>
        </div>    
            <div class="row mb-4">
                <div class="col-md-12 text-danger d-flex justify-content-center align-items-center">
                     <form action="" method="GET" class="mt-4">
                         <div class="form-group">
                              <label for=""><button class="btn btn-danger" style="margin-top: -5px;">Tìm Kiếm</button></label>
                              <input type="text" placeholder="Tìm kiếm ..." style="height: 38px;" name="keyword" value="<?= $keyword ?>">
                         </div>
                         <?php if(isset($_GET['msg'])) : ?>
                                        <span class="text-danger d-flex justify-content-center align-items-center"> <?= $_GET['msg'] ?> </span>
                        <?php endif ?>  
                     </form>
                </div>
              
            </div>

            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8 d-flex justify-content-center align-items-center">
                    <form action="#" method="POST">
                    <table class="table" style="font-size: 13px;">
                         <thead style="background-color:indianred ;">
                            <th width="20"><i class="fa fa-check-square-o" aria-hidden="true"></i></th>
                            <th>ID</th>
                              <th>TÊN LOẠI HÀNG</th>
                              <th>
                                    <a href="<?= BASE_URL?>admin/loai_hang/new.php" class="btn btn-sm btn-success">
                                    Tạo mới
                                  </a>
                              </th>
                         </thead>
                         <tbody>
                              <?php foreach ($loai_hangs as $key => $cursor): ?>
                                  <tr>
                                      <td>
                                        <input type="checkbox" name="delete[]" value="<?php echo $cursor['id'] ?>">
                                      </td>
                                      <td><?= $cursor['id'] ?></td>
                                      <td><?= $cursor['ten_loai'] ?></td>
                                      <td width="150">
                                          <a href="<?php echo BASE_URL?>admin/loai_hang/edit.php?id=<?= $cursor['id'] ?>"
                                              class="btn btn-info btn-sm"
                                          >
                                          Sửa
                                          </a>
                                          <a onclick="return confirm('Bạn có chắc chắn muốn xóa loại hàng này không ?')"
                                          href="<?php echo BASE_URL?>admin/loai_hang/delete.php?id=<?= $cursor['id'] ?>"
                                              class="btn btn-danger btn-sm"
                                          >
                                          Xóa
                                          </a>
                                      </td>
                                  </tr>
                              <?php endforeach ?>
                              <tr>
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
                <div class="col-md-2"></div>
            </div>
            
        <?php
            for ($t = 1; $t <= $page; $t++) { ?>
                &nbsp;<a name="" id="" class="btn btn-primary" href="<?php echo BASE_URL ?>admin/loai_hang/list.php?product=<?= $t ?>" role="button"> <?= $t ?></a>
            <?php
            }
            ?>
      
  </div>

</div>
</div>  
<script type="text/javascript" src="../../public/js/checkbox.js"></script>
 
</body>
</html>