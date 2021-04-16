<?php
    include "../layout/header.php";
    require_once APP_PATH."/dao/pdo.php" ; 
 

    $sql = "SELECT 
                 b.id , 
                 h.id as 'ma_hh',
                 h.ten_hh as 'ten',
                 h.hinh,
                 count(b.id) as 'so_bl',
                 max(b.ngay_bl) as 'max' ,
                 min(b.ngay_bl) as 'min'
                 from binh_luan as b join hang_hoa as h on b.ma_hh = h.id
                 group by h.ten_hh" ;
     $binh_luans = select_all($sql) ;  
     
     

?>


    <div class="col-md-10">
        <div style=" width: 100%; background-color: indianred; height: 45px; color: white; margin-right: 40px;" class="text-center mb-5 mt-4">
            <span><h2 style="text-transform: uppercase;">Quản lý bình luận</h2></span>
        </div> 
        
        <div class="row">
            <div class="col-md-12">
                <form action="#" method="POST">
                    <table class="table" style="font-size: 13px;">
                        <thead  style="background-color: indianred;">
                            <!-- <th width="20"><i class="fa fa-check-square-o" aria-hidden="true"></i></th> -->
                            <th>STT</th>
                            <th style="display: none;">MÃ HÀNG HÓA</th>
                            <th>TÊN SẢN PHẨM</th>
                            <th>ẢNH SẢN PHẨM</th>
                            <th>TỔNG SỐ BÌNH LUẬN</th>
                            <th>MỚI NHẤT</th>
                            <th>CŨ NHẤT</th>
                            <th>QUẢN LÍ</th>
                        </thead>

                        <tbody>
                             <?php foreach ($binh_luans as $key) { ?>
                                  <tr>
                                      <!-- <td><input type="checkbox" name="delete[]" value="<?php echo $key['id'] ?>"></td> -->
                                      <td><?php echo $key['id'] ?></td>
                                      <td style="display: none;"><?php echo $key['ma_hh'] ?></td>
                                      <td><?php echo $key['ten'] ?></td>
                                      <td>
                                          <img src="<?php echo BASE_URL. $key['hinh'] ?>" class="img-fluid" width="70" alt="">
                                      </td>
                                      <td><?php echo $key['so_bl'] ?></td>
                                      <td><?php echo $key['max'] ?></td>
                                      <td><?php echo $key['min'] ?></td>
                                      <td>
                                          <a href="<?php echo BASE_URL ?>admin/binh_luan/chi_tiet_bl.php?ma_hh=<?= $key['ma_hh'] ?>" class="btn btn-danger mb-2">Xem chi tiết</a>
                                      </td>
                                  </tr>
                             <?php } ?>

                             
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