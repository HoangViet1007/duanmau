<?php
    include "../layout/header.php"; 
    require_once APP_PATH."/dao/pdo.php" ; 


    // xoas
    if(isset($_GET['id'])){
        $id =  $_GET['id'] ;  
        $sql = "DELETE from binh_luan where id = '$id'" ; 
        insert_update_delete($sql) ; 
    }
   // lấy mã hàng hóa 
   $ma_hhget = isset($_GET['ma_hh']) ? $_GET['ma_hh'] : "" ; 
   $sql = "SELECT
                b.id,
                b.ma_hh,
                h.ten_hh,
                h.hinh,
                b.noi_dung,
                b.ngay_bl,
                k.ho_ten
                from binh_luan b join khach_hang k on b.ma_kh = k.id
                                    join hang_hoa h on b.ma_hh = h.id 
                where b.ma_hh = '$ma_hhget' ; " ; 
     $ct = select_all($sql) ;            
     

?>


    <div class="col-md-10">
        <div style=" width: 100%; background-color: indianred; height: 45px; color: white; margin-right: 40px;" class="text-center mb-5 mt-4">
            <span><h2 style="text-transform: uppercase;">Chi tiết bình luận</h2></span>
        </div> 
        
        <div class="row">
            <div class="col-md-12">
                <form action="#" method="POST">
                    <table class="table" style="font-size: 13px;">
                        <thead  style="background-color: indianred;">
                            <!-- <th width="20"><i class="fa fa-check-square-o" aria-hidden="true"></i></th> -->
                            <th>MÃ BÌNH LUẬN</th>
                            <th style="display: none;">MÃ HÀNG HÓA</th>
                            <th>TÊN SẢN PHẨM</th>
                            <th>ẢNH SẢN PHẨM</th>
                            <th>NỘI DUNG</th>
                            <th>NGÀY</th>
                            <th>TÊN</th>
                            <th>QUẢN LÍ</th>
                        </thead>

                        <tbody>
                             <?php foreach ($ct as $key) { ?>
                                  <tr>
                                      <!-- <td><input type="checkbox" name="delete[]" value="<?php echo $key['id'] ?>"></td> -->
                                      <td><?php echo $key['id'] ?></td>
                                      <td style="display: none;"><?php echo $key['ma_hh'] ?></td>
                                      <td><?php echo $key['ten_hh']  ?></td>
                                      <td>
                                          <img src="<?php echo BASE_URL. $key['hinh'] ?>" class="img-fluid" width="70" alt="">
                                      </td>
                                      <td><?php echo $key['noi_dung'] ?></td>
                                      <td><?php echo $key['ngay_bl'] ?></td>
                                      <td><?php echo $key['ho_ten'] ?></td>
                                      <td>
                                          <a href="<?php echo BASE_URL ?>admin/binh_luan/chi_tiet_bl.php?ma_hh=<?php echo $key['ma_hh'] ?>&id=<?php echo $key['id'] ?>" class="btn btn-primary" onclick="return confirm('Bạn chắc chắn muốn xóa chứ?')">Xóa</a>
                                      </td>
                                  </tr>

                               
                             <?php } ?>
                                 <tr>
                                    <a href="http://localhost/assignment_DAM/admin/binh_luan/list.php?product=1" class="btn btn-danger mb-2">Quay lại</a>
                                  </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
  </div>

</div>
</div>  
<script type="text/javascript" src="../../public/js/checkbox.js"></script>
 
</body>
</html>