<?php
     require_once "config.php" ; 
     require_once APP_PATH."/dao/pdo.php" ; 

     // lấy tất cả các danh mục sản phẩm 
     $sql = "SELECT * FROM loai_hang" ; 
     $loai_hangs = select_all($sql) ; 


?>
<style>
    #menu_lh ul {
            width: auto;
            padding: 0;
            list-style-type: none;
            text-align: left;
            border: 1px solid #f5f5f5;
            box-shadow: 2px 2px 1px  gray;
        }
    #menu_lh li {
            width: auto;
            height: 40px;
            line-height: 40px;
            border-bottom: 1px solid #e8e8e8;
            padding: 0 1em;
         }
    #menu_lh li a {
            text-decoration: none;
            color: #333;
            display: block;
        }
    #menu_lh li:hover {
            background: #f5f5f5;
        }
        #menu_lh li a{
            /* font-weight: bold; */
            transition: .3s;
        }

    #menu_lh li:hover a{
            /* font-weight: bold; */
            transform: scale(1.07);
            transition: .3s;
        }

            /*==Dropdown Menu==*/
    #menu ul li {
            position: relative;
        }
    #menu_lh .sub-menu {
            position: absolute;
            left: 170px;
            top: 0;
            display: none;
            width: 150px;
            box-shadow: 2px 2px 2px gray;
            z-index: 1;
        }
    #menu_lh ul li:hover .sub-menu {
            display: block;
         } 
    #menu_lh a{
             font-weight: 600;
             font-size: 14px;
             text-transform: uppercase;
         }
    .tt-sp{
             text-align: center;
             background-color: #cc0000;
             height: 40px;
             
         }
    .tt-sp h4{
             font-size: 17px;
             color: white;
             padding-top: 10px;
         }
      
</style>
<div class="col-md-3">
    <div id="menu_lh">
        <ul>
            <div class="tt-sp">
                 <h4>DANH MỤC SẢN PHẨM</h4>
            </div>
           <?php foreach ($loai_hangs as $key) { ?>
                 <li>
                     <a href="<?php echo BASE_URL ?>list_sp_kh/list_sp.php?ma_loai=<?php echo $key['id'] ?>&product=1"><?php echo $key['ten_loai']?></a>
                </li>
           <?php } ?>
        </ul>
    </div>
</div>