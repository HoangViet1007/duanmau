<?php
      include "../layout/header.php" ; 
      require_once APP_PATH."/dao/pdo.php" ; 


    // làm phân trang
    if (!isset($_GET['product'])) {
        $product = 1;
    } else {
        $product = $_GET['product'];
    }
    $data = 6;
    $sql = "SELECT count(*) FROM `hang_hoa`";
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
                $sql = "delete from hang_hoa where id = '$value'" ; 
                insert_update_delete($sql) ; 
            }
        }
   }
  


    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "" ; 
    $sql = "select 
                  hang_hoa.id,
                  hang_hoa.ten_hh,
                  hang_hoa.don_gia,
                  hang_hoa.giam_gia,
                  hang_hoa.hinh,
                  hang_hoa.ngay_nhap,
                  hang_hoa.mo_ta,
                  hang_hoa.dac_biet,
                  hang_hoa.so_luot_xem,
                  hang_hoa.ma_loai,
                  loai_hang.ten_loai as 'TÊN LOẠI'
                  from hang_hoa join loai_hang on hang_hoa.ma_loai = loai_hang.id
                  ORDER BY hang_hoa.id DESC LIMIT $tin , $data" ; 
    
    if($keyword !== ""){
        $sql .= " where hang_hoa.ten_hh like '%$keyword%' or hang_hoa.id like '%$keyword%' ";
    }
    $hang_hoas = select_all($sql) ; 
?>
 <div class="col-md-10">
        <div style=" width: 100%; background-color: indianred; height: 45px; color: white; margin-right: 40px;" class="text-center mb-5 mt-4">
                <span><h2 style="text-transform: uppercase;">Danh sách hàng hóa</h2></span>
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
                        <thead style="background-color: indianred; ">
                            <tr>
                                <th width="20"><i class="fa fa-check-square-o" aria-hidden="true"></i></th>
                                <th>STT</th>
                                <th>TÊN HÀNG HÓA</th>
                                <th>ĐƠN GIÁ</th>
                                <th>GIẢM GIÁ</th>
                                <th>HÌNH ẢNH</th>
                                <th>NGÀY NHẬP</th>
                                <th>MÔ TẢ</th>
                                <th>KIỂU LOẠI</th>
                                <th>SỐ LƯỢT XEM</th>
                                <th>TÊN LOẠI</th>
                                <th>
                                    <a href="<?= BASE_URL?>admin/hang_hoa/new.php" class="btn btn-info">
                                        Tạo mới
                                    </a>
                                </th>
                            
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($hang_hoas as $key) { ?>
                                <tr>
                                <td>
                                        <input type="checkbox" name="delete[]" value="<?php echo $key['id'] ?>">
                                    </td>
                                    <td><?php echo $key['id'] ?></td>
                                    <td><?php echo $key['ten_hh'] ?></td>
                                    <td><?php echo number_format($key['don_gia']) ?>  vnđ</td>
                                    <td><?php echo $key['giam_gia'] ?>%</td>
                                    <td>
                                        <img src="<?php echo BASE_URL. $key['hinh'] ?>" class="img-fluid" width="70" alt="">
                                    </td>
                                    <td><?php echo $key['ngay_nhap'] ?></td>
                                    <td><?php echo $key['mo_ta'] ?></td>
                                    <td>
                                        <?php if ($key['dac_biet'] == "1") {
                                            echo "Bình thường";
                                        } else {
                                            echo "Đặc biệt";
                                        } 
                                    ?>
                                    </td>
                                    <td><?php echo $key['so_luot_xem'] ?></td>
                                    <td><?php echo $key['TÊN LOẠI'] ?></td>
                                    <td>
                                    <a href="<?php echo BASE_URL ?>admin/hang_hoa/edit.php?id=<?= $key['id'] ?>" class="btn btn-danger mb-2">Sửa</a>
                                    <a href="<?php echo BASE_URL ?>admin/hang_hoa/delete.php?id=<?= $key['id'] ?>" class="btn btn-primary" onclick="return confirm('Bạn chắc chắn muốn xóa ?')">Xóa</a>
                                    </td>
                                </tr>
                            <?php } ?> 
                            
                            <tr>  
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td  colspan="6">
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
                &nbsp;<a name="" id="" class="btn btn-primary" href="<?php echo BASE_URL ?>admin/hang_hoa/list.php?product=<?= $t ?>" role="button"> <?= $t ?></a>
            <?php
            }
            ?>
           
   </div>
   

    
   </div>
   </div>
   <script type="text/javascript" src="../../public/js/checkbox.js"></script>
</body>
</html>