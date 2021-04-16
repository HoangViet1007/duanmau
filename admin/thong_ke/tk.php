<?php 
    require_once "../../config.php" ; 
    require_once "../layout/header.php" ; 
    require_once APP_PATH."/dao/pdo.php" ; 

    // lấy tổng số bình luận 
    $sqlbl = "SELECT COUNT(*) as sl from binh_luan" ; 
    $bl = select_one($sqlbl) ;
    
    // lấy tổng số danh mục
    $sqldm = "SELECT COUNT(*) as lh from loai_hang" ; 
    $dm = select_one($sqldm) ;

    // lấy tất cả sản phẩm
    $sqlp = "SELECT COUNT(*) as p from hang_hoa" ; 
    $hh = select_one($sqlp) ;
    
    // lấy tấ cả user 
    $sqlu = "SELECT COUNT(*) as u from khach_hang" ; 
    $u = select_one($sqlu) ;


   // làm biểu đồ tròn
    $sql = "SELECT
                loai_hang.id,
                loai_hang.ten_loai AS 'ten_loai',
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
                
    $tks = select_all($sql) ;   
    
    // làm biểu đồ line 

    // var bienx = ['Tháng 1','Tháng 1','Tháng 1','Tháng 1','Tháng 1','Tháng 1','Tháng 1','Tháng 1','Tháng 1','Tháng 1','Tháng 1','Tháng 1']
  
            
?>
<script type="text/javascript">
          google.charts.load("current", {packages:["corechart"]});
          google.charts.setOnLoadCallback(drawChart);
          function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['Loại', 'Số Lượng'],
                <?php
                foreach ($tks as $item){
                    echo "['$item[ten_loai]',  $item[so_luong]],";
                }
                ?>
            ]);

            var options = { 
                             is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
          }



</script>


     
     <div class="col-md-10" style="padding-left: 35px; padding-right: 35px;">
         <div class="row">
              <div class="tt-tk">
                <p>DASHBOARD</p>
              </div>
              <div class="all-tk">
                 <div class="item">
                    <div class="item-top" style="background-color: #3366cc;">
                        <div class="item-top-left">
                            <p><i class="fa fa-comments" aria-hidden="true"></i></p>
                        </div>
                        <div class="item-top-right">
                           <p class="s"><?php echo $bl['sl'] ?></p>
                           <p class="m">New Comment</p>
                        </div>
                    </div>
                    <div class="item-bottom">
                        <a href="#" style="color:  #3366cc;">
                          <p style="font-weight: 550; margin-left: 20px; padding-top: 7px;">View Details</p>
                          <p style="margin-left: 200px; margin-top: -35px;"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></p>
                        </a>
                    </div>
                 </div>

                 <div class="item">
                    <div class="item-top" style="background-color: #66cc66;">
                         <div class="item-top-left">
                              <p><i class="fa fa-bars" aria-hidden="true"></i></p>
                          </div>
                          <div class="item-top-right">
                           <p class="s"><?php echo $dm['lh'] ?></p>
                           <p class="m">New Categories</p>
                        </div>
                    </div>
                    <div class="item-bottom">
                        <a href="#" style="color:  #66cc66;">
                          <p style="font-weight: 550; margin-left: 20px; padding-top: 7px;">View Details</p>
                          <p style="margin-left: 200px; margin-top: -35px;"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></p>
                        </a>
                    </div>
                 </div>

                 <div class="item">
                    <div class="item-top" style="background-color: #ff9966;">
                      <div class="item-top-left">
                            <p><i class="fa fa-shopping-cart" aria-hidden="true"></i></p>
                        </div>
                        <div class="item-top-right">
                           <p class="s"><?php echo $hh['p'] ?></p>
                           <p class="m" style="margin-left: 20px;">New Product</p>
                        </div>
                    </div>
                    <div class="item-bottom">
                        <a href="#" style="color:  #ff9966;">
                          <p style="font-weight: 550; margin-left: 20px; padding-top: 7px;">View Details</p>
                          <p style="margin-left: 200px; margin-top: -35px;"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></p>
                        </a>
                    </div>
                 </div>

                 <div class="item">
                    <div class="item-top" style="background-color: #cc6666;">
                      <div class="item-top-left">
                            <p><i class="fa fa-user" aria-hidden="true"></i></p>
                        </div>
                        <div class="item-top-right">
                           <p class="s"><?php echo $u['u'] ?></p>
                           <p class="m" style="margin-left: 40px;">New User</p>
                        </div>
                    </div>
                    <div class="item-bottom">
                        <a href="#" style="color:  #cc6666;">
                          <p style="font-weight: 550; margin-left: 20px; padding-top: 7px;">View Details</p>
                          <p style="margin-left: 200px; margin-top: -35px;"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></p>
                        </a>
                    </div>
                 </div> 
              </div>
         </div>

         <div class="row mt-5">
            <!-- <div class="col-md-7">
              <p style="color: gray; font-size: 18px; font-weight: 560; text-transform: uppercase; margin-left: 30px;">Biểu đồ đường line</p>
              <div class="line-chart"></div>
            </div>  -->
            <div class="col-md-3"></div>
            <div class="col-md-8">
                 <p style="color: gray; font-size: 18px; font-weight: 560; text-transform: uppercase; margin-left: 50px;">Biểu đồ thống kê hàng hóa </p>
                 <div id="piechart_3d" style=" height: 300px; margin-top: -20px; width: 500px;"></div>
            </div>
         </div>
     </div>

    
   </div>
   </div>
   <script type="text/javascript" src="../../public/js/checkbox.js"></script>
</body>
</html>