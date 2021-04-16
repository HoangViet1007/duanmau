<?php 
    require_once "../../config.php" ; 
    require_once "../layout/header.php" ; 
    require_once APP_PATH."/dao/pdo.php" ; 

    $sql = "SELECT
                loai_hang.id,
                loai_hang.ten_loai AS 'tenLoai',
                COUNT(*) AS so_luong,
                MIN(hang_hoa.don_gia) AS gia_min,
                MAX(hang_hoa.don_gia) AS gia_max,
                AVG(hang_hoa.don_gia) AS gia_avg
            FROM
                hang_hoa
            JOIN loai_hang ON loai_hang.id = hang_hoa.ma_loai
            GROUP BY
                loai_hang.id,
                loai_hang.ten_loai" ;
                
    $tk = select_all($sql) ;             
?>
     
     <div class="col-md-10">
        <div style=" width: 100%; background-color: indianred; height: 45px; color: white; margin-right: 40px;" class="text-center mb-5 mt-4">
            <span><h2 style="text-transform: uppercase;">THÔNG KÊ HÀNG HÓA </h2></span>
        </div>

        <div class="row mt-3">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form action="" method="POST">
                    <table class="table" border="1">
                        <thead style="background-color: indianred;">
                            <th>LOẠI HÀNG</th>
                            <th>SL</th>
                            <th>GIÁ CAO NHẤT</th>
                            <th>GIÁ THẤP NHẤT</th>
                            <th>GIÁ TRUNG BÌNH</th>
                        </thead>
                    

                        <tbody>
                            <?php foreach ($tk as $key) { ?>
                                <tr>
                                    <td><?php echo $key['tenLoai'] ?></td>
                                    <td><?php echo $key['so_luong'] ?></td>
                                    <td><?php echo number_format($key['gia_max']) ?>đ</td>
                                    <td><?php echo number_format( $key['gia_min']) ?>đ</td>
                                    <td><?php echo number_format($key['gia_avg']) ?>đ</td>
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